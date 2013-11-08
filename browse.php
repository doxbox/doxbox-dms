<?php
/**
 * browse.php -- Browse page
 * 
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2006-2009 Bozz IT Consulting Inc
 *
 * Licensed under the GNU GPL. For full terms see the file LICENSE.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

require_once(dirname(__FILE__) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/readhd.php");



if ($default->owl_maintenance_mode == 1)
{
   if(!fIsAdmin(true))
   {
      header("Location: " . $default->owl_root_url . "/index.php?failure=9&sess=$sess");
      exit;
   }
}

//$xtpl = new XTemplate("templates/$default->sButtonStyle" , "html/browse.xtpl");
$xtpl = new XTemplate("html/browse.xtpl", "templates/$default->sButtonStyle" );
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);


if (!isset($expand) or !is_numeric($expand)) 
{
   $expand = $default->expand;
}

include_once($default->owl_fs_root . "/lib/header.inc");
include_once($default->owl_fs_root . "/lib/userheader.inc");

fSetLogo_MOTD();
fSetPopupHelp();

$xtpl->assign('SITE_TITLE', $default->site_title);

if (empty($parent) || !is_numeric($parent)) 
{
   $iHomeDir = $default->HomeDir;
   $iFirstDir = $default->FirstDir;
                                                                                                                                                                             
   if (  $iHomeDir <>  $iFirstDir)
   {
      $sql->query("SELECT * from $default->owl_folders_table where id = '$iFirstDir'");
      $numrows = $sql->num_rows($sql);
      if ($numrows == "1")
      {
         $parent = $iFirstDir;
      }
      else
      {
         $parent = $iHomeDir;
      }
   }
   else
   {
      $parent= $iHomeDir;
   }

   if(isset($fileid))
   {
      $parent =  owlfileparent($fileid);
   }
}
else
{
   // Check to see if the user tried to go outside his home directory
   if ($parent != $default->HomeDir )
   {
      $bIsWithinHomeDir = false;
      fCheckWithinHomeDir ( $parent );
      if (!$bIsWithinHomeDir)
      {
        printError($owl_lang->err_unauthorized);
      }
   } 

}

$parent =  fGetPhysicalFolderId ( $parent );

if (empty($curview) || !is_numeric($curview))
{
   $curview = 0;
}


$CheckPass = $cCommonDBConnection;

if (empty($CheckPass))
{
   $CheckPass = new Owl_DB;
}

$CheckPass->query("select password from " . $default->owl_folders_table . " where id='$parent'");
$CheckPass->next_record();
$password = $CheckPass->f("password");


$bPasswordFailed = false;

if (isset($docpassword))
{
   if ($password == md5($docpassword))
   {
     $bDownloadAllowed = true;
   }
   else
   {
     if(!empty($docpassword))
     {
        $bPasswordFailed = true;
     }
     $bDownloadAllowed = false;
   }
}



if (!isset($nextfiles)) 
{
   $nextfiles = 0;
}
if (!isset($nextfolders)) 
{
   $nextfolders = 0;
}

if (!isset($bDisplayFiles))
{
 $bDisplayFiles = false;
}

// Initialize Page count Variables

if (!isset($iCurrentPage))
{
   $iCurrentPage = 0;
}

if (!isset($next))
{
   $next = 0;
}

if (!isset($prev))
{
   $prev = 0;
}

if ($next == 1) 
{
      $iCurrentPage++;
      $nextfiles = $nextfiles + $default->records_per_page;
      $nextfolders = $nextfolders + $default->records_per_page;
}
if ($prev == 1)
{
      $iCurrentPage--;
      $nextfiles = $nextfiles - $default->records_per_page;
      if ($nextfiles < 0)
      {
         $nextfiles = 0;
      }
      $nextfolders = $nextfolders - $default->records_per_page;
      if ($nextfolders < 0)
      {
         $nextfolders = 0;
      }
}

// V4B RNG Start
   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;
// V4B RNG End

if (check_auth($parent, "folder_view", $userid, false, false) != "1" and !$bDownloadAllowed)
{
   $sql->query("select password from " . $default->owl_folders_table . " where id='$parent'");
   $sql->next_record();

   $password = $sql->f("password");

   if (empty($password) or (!empty($password) and $bPasswordFailed))
   {
      printError($owl_lang->err_nofolderaccess);
   }
   else
   {
      //$xtpl = new XTemplate("templates/$default->sButtonStyle/html/download.xtpl");
      $xtpl = new XTemplate("html/download.xtpl", "templates/$default->sButtonStyle");
      $xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
      $xtpl->assign('ROOT_URL', $default->owl_root_url);

      include_once($default->owl_fs_root . "/lib/header.inc");
      include_once($default->owl_fs_root . "/lib/userheader.inc");

      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }

      if ($default->show_prefs == 1 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL("Top");
      }
      if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
      {
         fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
      }
      fPrintNavBarXTPL($parent, "&nbsp;");


      $urlArgs = array();
      $urlArgs['sess']      = $sess;
      if(!empty($page))
      {
         $urlArgs['page']    = $page;
      }
      $urlArgs['parent']    = $parent;
      $urlArgs['expand']    = $expand;
      $urlArgs['order']     = $order;
      $urlArgs['sort']  = $sortname;
      $urlArgs['sortorder']  = $sortorder;
      $urlArgs['curview']     = $curview;
      $urlArgs['id']  = $id;


      $xtpl->assign('PASSWD_PAGE_TITLE', $owl_lang->password);
      $xtpl->assign('FORM', '<form action="browse.php" method="post">');
      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));

      $xtpl->assign('DOC_PASSWORD_LABEL', $owl_lang->password);

      $xtpl->assign('BTN_SUBMIT', $owl_lang->btn_submit);
      $xtpl->assign('BTN_SUBMIT_ALT', $owl_lang->alt_btn_submit);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL("Bottom");
      }
      $xtpl->parse('main.PassOveride');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
   }
   exit;
}


// Tiian changes 2003-07-31
$sql_bro = $cCommonDBConnection;

if (empty($sql_bro))
{
   $sql_bro = new Owl_DB;
}



$sql_bro->query("SELECT id FROM $default->owl_folders_table WHERE id = '$parent' AND name = '$default->version_control_backup_dir_name'");
("SELECT id FROM $default->owl_folders_table WHERE id = '$parent' AND name = '$default->version_control_backup_dir_name'");
if ($sql_bro->num_rows() > 0)
{
    $is_backup_folder = true; 
}
else
{
    $is_backup_folder = false;
}

// **************************************
// Get File statistics for the status bar
// and for controling Pages
// **************************************

$lastlogin =  fGetLastLogin();


if ($default->show_file_stats == 1)
{
   fGetStatusBarCount();
}

$iFileCount = $iFolderCount + $iFileCount;
   
$whereclause = "";
$DBFolderCount = 0;


if ($default->hide_backup == 1 and !fIsAdmin())
{
   $sql->query("SELECT * from $default->owl_folders_table where parent = '$parent' AND name = '$default->version_control_backup_dir_name'");
   if ($sql->num_rows() > 0)
   {
      $DBFolderCount++; //count number of filez in db 2 use with array
      $DBFolders[$DBFolderCount] = $default->version_control_backup_dir_name; //create list if files in
   } 

   $whereclause = " AND name <> '$default->version_control_backup_dir_name'";
} 
if (isset($page))
{
   $iCurrentPage = $page;
   $nextfolders = ($default->records_per_page * $page);
}

if (!isset($inextfiles) or !is_numeric($inextfiles))
{
  $inextfiles = '0';
  $inextfolder = '0';
}

if(!is_numeric($nextfolders))
{
  $nextfolders = '0';
  $nextfiles = '0';
}

if ($default->records_per_page > 0)
{
   if ($default->restrict_view == 0)
   {
      $sLimit = "LIMIT " . $nextfolders . "," . $default->records_per_page;
      $sql->query("SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause order by name $sLimit");
      $iNumberFoldersDisplayed = $sql->num_rows();
      $iSaveNextfolders = $nextfolders;
      $iSaveNextfiles = $nextfiles  - $iNumberFoldersDisplayed;
      $iSaveDisplayFiles = $bDisplayFiles;
      $iSaveFileCount = $iFileCount;
      $iSaveCurrentPage = $iCurrentPage;
      
      if ($iNumberFoldersDisplayed < $default->records_per_page)
      {
         $bDisplayFiles = true;
         if (isset($page))
         {
            $iNumberOfPages = (int) (($iFolderCount / $default->records_per_page));
            //$iNumberOfPages = ($iNumberOfPages == 0) ? 1 :((int) round($iNumberOfPages + 0.4999));
            $iNumberOfPages = ($iNumberOfPages == 0) ? 1 :((int) round($iNumberOfPages + 0.51111));
            
            $iPageLeft = $page - $iNumberOfPages;
            
            if ($iFolderCount == 0 );
            {
               if($iPageLeft < 0)
               {
                 $iPageLeft = 0;
               } 
               else
               {
                 $iPageLeft++;
               } 
            }
   
            $iCorrection = 0;
   
            if($iFolderCount <> 0)
            {
              $iCorrection = $iFolderCount % $default->records_per_page;
            }
   
            if ($nextfiles == 0 and $iNumberFoldersDisplayed > 0)
            {
               $nextfiles = 0;
            }
            else
            {
               $nextfiles = ($default->records_per_page * $iPageLeft) - $iNumberFoldersDisplayed - $iCorrection ;
            }
   
            if ($nextfiles < 0)
            {
               $nextfiles = $nextfiles + $default->records_per_page;
            }
         }
      }
      else
      {
         $bDisplayFiles = false;
      }
   
      if ($iNumFilesPerPage != $default->records_per_page)
      {
         $inextfiles = $nextfiles - $iNumberFoldersDisplayed;
      }
   }
}   
   
// *********************************
// Display the Header Tool Bar BEGIN
// *********************************

if ($default->owl_version_control == 1 && ! $default->owl_use_fs)
{           
   if ($order == "major_minor_revision")
   {
      $order = "major_revision $sort, f1.minor_revision ";
      $forder = "major_revision $sort, minor_revision ";
   }
   else
   {
      $forder = $order;
   }

   if ($default->peer_review_leave_old_file_accessible)
   {
      $sApproved = "";
   }
   else
   {
      $sApproved = "AND f1.approved ='1'";
   }

   $qGetFiles = "SELECT f1.id as file_id , f1.major_revision, f1.minor_revision, f1.major_revision+(f1.minor_revision/1000.0) AS mval FROM $default->owl_files_table f1, $default->owl_files_table f2 WHERE f1.name=f2.name AND f1.parent=f2.parent AND f1.parent='$parent' $sApproved GROUP BY f1.id, f1.major_revision, f1.minor_revision, f1.$order HAVING f1.major_revision+(f1.minor_revision/1000.0) = max(f2.major_revision+(f2.minor_revision/1000.0)) ORDER BY f1.$order $sort";

    $sql->query($qGetFiles);

    $FileQuery = ("SELECT * FROM $default->owl_files_table where '1' = '0' ");

    while ($sql->next_record())
    {
      $FileQuery .= " OR id = '" . $sql->f("file_id") ."'"; 
    }

    $FileQuery .= " ORDER BY $forder $sort";

   //$FileQuery = "select f1.*, f1.major_revision+(f1.minor_revision/1000.0) as mval from $default->owl_files_table f1, $default->owl_files_table f2 where f1.approved = '1' and f1.name=f2.name AND f1.parent=f2.parent AND f1.parent=$parent group by f1.id having f1.major_revision+(f1.minor_revision/1000.0) = max(f2.major_revision+(f2.minor_revision/1000.0)) order by f1.$order $sort";
   //$FileQuery = "select f1.*, f1.major_revision+(f1.minor_revision/1000.0) as mval from $default->owl_files_table f1, $default->owl_files_table f2 where f1.name=f2.name AND f1.parent=f2.parent AND f1.parent=$parent group by f1.id having f1.major_revision+(f1.minor_revision/1000.0) = max(f2.major_revision+(f2.minor_revision/1000.0)) order by f1.$order $sort";

   $MenuFileQuery = $FileQuery;

}           
else        
{
   if ($order == "major_minor_revision")
   {
      $order_clause = "major_revision $sort, minor_revision $sort";
   }
   else
   {

      switch ($order)
      {
         case 'updatorid':
         case 'creatorid':
               $order_clause = "u.name $sort";
               $sLeftJoin =  " LEFT OUTER JOIN $default->owl_users_table u ON $order = u.id";
            break;
         default:
               $order_clause = "$order $sort";
               $sLeftJoin =  "";
            break;
      }


   }

   $sLimit = "";

   if ($default->records_per_page > 0)
   {
      if ($default->restrict_view == 0)
      {
         $iNumFilesPerPage = $default->records_per_page - $iNumberFoldersDisplayed;
         $sLimit = "LIMIT $nextfiles,$iNumFilesPerPage";
      }
   }

   if ($default->peer_review_leave_old_file_accessible)
   {
      $sApproved = "";
   }
   else
   {
      $sApproved = "and approved = '1'";
   }

   // Query TO retreive the Files in the current Folder
   $FileQuery = "select f.* from $default->owl_files_table f $sLeftJoin where parent = '$parent' order by $order_clause $sLimit";
   $MenuFileQuery = "select * from $default->owl_files_table where parent = '$parent' $sApproved order by $order_clause $sLimit";
}
//print("<br />FQ: $FileQuery");
$CountLines = 0;
$sLimit = '';
if ($default->records_per_page > 0)
{
   if ($default->restrict_view == 0)
   {
      $sLimit = "LIMIT $nextfolders,$default->records_per_page";
   }
}


if ($order == "creatorid" or $order == "smodified")
{
     switch ($order)
      {
         case 'creatorid':
               $order_clause = "u.name $sort";
               $sLeftJoin =  " LEFT OUTER JOIN $default->owl_users_table u ON $order = u.id";
            break;
         default:
               $order_clause = "$order $sort";
               $sLeftJoin =  "";
            break;
      }

   $FolderQuery = "SELECT f.* from $default->owl_folders_table f $sLeftJoin where parent = '$parent' $whereclause order by $order_clause $sLimit";
}
else if ($order == "major_minor_revision")
{
   $FolderQuery = "SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause order by name ASC $sLimit";
   //$FolderQuery = "SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause order by name $sortname $sLimit";
}
else
{
   $FolderQuery = "SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause order by name $sort $sLimit";
   //$FolderQuery = "SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause order by name $sortname $sLimit";
}

//FOR_FOLDERS

if ($expand == 1)
{
   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
}
else
{
   $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
}

                                                                                                                                                                                       
if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}


// *******************************
// Display the Header Tool Bar END
// *******************************


if ($default->show_file_stats == 1 or $default->show_file_stats == 3)
{
   fPrintPanelXTPL('Top', $default->display_file_info_panel_wide);
}
else
{
}

$xtpl->assign('FILELINK_LABEL', $owl_lang->owl_file_link);
$xtpl->parse('main.FileLink');

if ($default->show_search == 1 or $default->show_search == 3 or (fIsAdmin() and $default->show_search == 0))
{
   fPrintSearchXTPL("Top");
}

fPrintFavoriteLinkXTPL();

if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
{
   //if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
   //{
      if ($default->show_bulk == 1 or $default->show_bulk == 3 or (fIsAdmin() and $default->show_bulk == 0 ))
      {     
         if (check_auth($parent, "folder_view", $userid, false, false) == 1)
         {
            fPrintBulkButtonsXTPL("Top");
         }
      }
      if ($default->show_action == 1 or $default->show_action == 3 or (fIsAdmin() and $default->show_action == 0))
      {
         //if (check_auth($parent, "folder_create", $userid, false, false) == 1)
         //{
            fPrintActionButtonsXTLP();
         //}
      }
   //}
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent);

if ($curview == 0)
{
   if ($default->view_files_then_folders_alpha == 1)
   {
      require_once ($default->owl_fs_root . "/view_default.php");
   }
   else
   {
      require_once ($default->owl_fs_root . "/view_filefolder.php");
   }
}
else
{
   require_once ($default->owl_fs_root . "/view_thumb.php");
   if ($iIsOneRecPrinted == 0)
   {
      $xtpl->assign('EMPTY_FOLDER', $owl_lang->empty_folder);
      $xtpl->parse('main.ThumbsView.NoRecs');
   }
   $xtpl->parse('main.ThumbsView');
}


if ($default->show_folder_tools == 2 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Bottom', $iSaveNextfolders, $inextfiles, $iSaveDisplayFiles, $iSaveFileCount, $iSaveCurrentPage);
}
if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
//if (check_auth($parent, "folder_modify", $userid, false, false) == 1 or  check_auth($parent, "folder_upload", $userid, false, false) == 1  && !$is_backup_folder)
{
   //if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
   //{
      if ($default->show_action == 2 or $default->show_action == 3 )
      {
         //if (check_auth($parent, "folder_create", $userid, false, false) == 1)
         //{
            fPrintActionButtonsXTLP(1);
         //}
      }
      //if ($default->show_bulk > 0)
      if ($default->show_bulk == 2 or $default->show_bulk == 3)
      {
         if (check_auth($parent, "folder_view", $userid, false, false) == 1)
         {

            fPrintBulkButtonsXTPL("Bottom", 1);
         }
      }
   //}
}

if ($default->show_search == 2 or $default->show_search == 3)
{
   fPrintSearchXTPL('Bottom', 1);
}

if ($default->show_file_stats == 2 or $default->show_file_stats == 3)
{
   fPrintPanelXTPL('Bottom', $default->display_file_info_panel_wide);
}
else
{
}

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
}

// *******************************
// If the refresh from hard drive
// feature is enabled
// *******************************
// 
if ($default->owl_use_fs)
{
   if ($default->owl_LookAtHD != "false")
   {
      if ($RefreshPage == true)
      {
         CompareDBnHD('file', $default->owl_FileDir . DIR_SEP . get_dirpath($parent), $DBFiles, $parent, $default->owl_files_table);
      } 
      else
      {
         $RefreshPage = CompareDBnHD('file', $default->owl_FileDir . DIR_SEP . get_dirpath($parent), $DBFiles, $parent, $default->owl_files_table);
      } 
      if ($RefreshPage == true)
      {

print('<script type="text/javascript">');
print('window.location.reload(true);');
print('</script>');
      } 
   } 
} 

fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
