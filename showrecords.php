<?php
/**
 * showrecords.php -- Browse page
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
 * $Id: showrecords.php,v 1.8 2006/09/29 02:28:34 b0zz Exp $
*/

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/lib/readhd.php");

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/showrecords.xtpl");
$xtpl = new XTemplate("html/showrecords.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

if ($default->anon_user == $userid)
{
   die("$owl_lang->err_unauthorized");
} 

if (!isset($parent) || $parent == "" || !is_numeric($parent))
{
   $parent = $default->HomeDir;
}

if (!isset($expand) or !is_numeric($expand))
{
   $expand = $default->expand;
}
if (check_auth($parent, "folder_view", $userid) != "1")
{
   printError($owl_lang->err_nofolderaccess);
   exit;
} 

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sort;
$urlArgs['curview']     = $curview;
// V4B RNG End

fSetLogo_MOTD();
fSetPopupHelp();

$CountLines = 0;

$getlastlogin = new Owl_DB;
$getlastlogin->query("SELECT lastlogin FROM $default->owl_users_table where id = '" . $userid . "'");
$getlastlogin->next_record();
$lastlogin = $getlastlogin->f("lastlogin");

$qSqlQuery = '';
// **************************************
// SETTING UP QUERY FOR FILES
// **************************************

if ($order == "major_minor_revision")
{
   $order_clause = "major_revision $sort, minor_revision $sort";
}
else
{
   $order_clause = "$order $sort";
}

if (!isset($filter))
{
   $filter = '';
}

if ($type == "n")
{
   if (!empty($filter))
   {
      $dSince =  date("Y-m-d H:i:s", (mktime(0, 0, 0, date("m")  , date("d") - $filter, date("Y")))); 
   }
   else
   {
      $dSince =  $lastlogin;
   }

   $qFileQuery = "SELECT * FROM $default->owl_files_table where approved = '1' and created > '$dSince' order by $order_clause";
} elseif ($type == "u")
{
   if (!empty($filter))
   {
      $dSince =  date("Y-m-d H:i:s", (mktime(0, 0, 0, date("m")  , date("d") - $filter, date("Y")))); 
   }
   else
   {
      $dSince =  $lastlogin;
   }
   $qFileQuery = "SELECT * FROM $default->owl_files_table where approved = '1' and smodified > '$dSince' and created < '$dSince' order by $order_clause ";
} elseif ($type == "c")
{
   $qFileQuery = "SELECT * FROM $default->owl_files_table where checked_out = '$userid'  order by $order $sort";
} elseif ($type == "pa")
{
   $qFileQuery = "SELECT * FROM $default->owl_files_table where creatorid = '$userid' and approved = '0' order by $order $sort";
} elseif ($type == "wa")
{
   $qSqlQuery = "(id ='-1' ";
   $glue = "";
   $sql->query("SELECT file_id from $default->owl_peerreview_table where reviewer_id = '$userid' and status ='0'");
   while ($sql->next_record())
   {
     $qSqlQuery .= " OR id ='" . $sql->f('file_id') . "'";
   }
   $qSqlQuery .= ")";

   $qFileQuery = "SELECT * FROM $default->owl_files_table where  $qSqlQuery order by $order_clause ";
} elseif ($type == "t")
{
   $qSqlQuery = "(id ='-1' ";
   $glue = "";
   $sql->query("SELECT fid FROM $default->owl_monitored_file_table  where userid = '$userid'");
   while ($sql->next_record())
   {
     $qSqlQuery .= " OR id ='" . $sql->f('fid') . "'";
   }
   $qSqlQuery .= ")";

   $qFileQuery = "SELECT * FROM $default->owl_files_table where  $qSqlQuery order by $order_clause ";
} elseif ($type == "br")
{
      $groups = fGetGroups($userid);
      $glue = "";
      $qQuery = "SELECT distinct id, parent FROM $default->owl_files_table f, $default->owl_advanced_acl_table a where a.file_id = id and (a.user_id = '0' or a.user_id = '$userid'";
      
      foreach ($groups as $aGroups)
      {
        $qQuery .= " or a.group_id ='" .$aGroups["0"] . "'";
      }
      $qQuery .= ")";

      $qSqlQuery = "('1'='0' ";
 
      $sql->query($qQuery);

      while ($sql->next_record())
      {
         
         $bIsInBrokenTree = false;
         fIsInBrokenTree($sql->f('parent'));

         if ($bIsInBrokenTree == false)
         {
            continue;
         }

         $glue = " OR ";
         $qSqlQuery .= $glue . " id ='" . $sql->f('id') . "'";
      }
      $qSqlQuery .= ")";

      $qFileQuery = "SELECT * FROM $default->owl_files_table where $qSqlQuery order by $order_clause ";

} 
elseif ($type == "m")
{
   $qFileQuery = "SELECT * FROM $default->owl_files_table where creatorid = '$userid' order by $order_clause ";

} 
elseif ($type == "g")
{
   $sqlmemgroup = new Owl_DB;
   $sqlmemgroup->query("select * from $default->owl_users_grpmem_table where groupid is not null and userid = '" . $userid . "'");
   $sFilesGroupsWhereClause = "( groupid = '-1' OR groupid = '$usergroupid'";
                                                                                                                                                                                        
   while($sqlmemgroup->next_record())
   {
      $sFilesGroupsWhereClause .= " OR groupid = '" . $sqlmemgroup->f("groupid") . "'";
   }
   $sFilesGroupsWhereClause .= ")";

   $qFileQuery = "SELECT * from $default->owl_files_table where $sFilesGroupsWhereClause order by $order_clause ";

} 

// **************************************
// SETTING UP QUERY FOR FILES
// **************************************

   if ($type == "t")
   {   
      $qSqlQuery = "('1'='0' ";
      $sql->query("SELECT fid FROM $default->owl_monitored_folder_table  where userid = '$userid'");
      $glue = "";
      while ($sql->next_record())
      {
        $glue = " OR ";
        $qSqlQuery .= $glue . " id ='" . $sql->f('fid') . "'";
      }
      $qSqlQuery .= ")";
   }
   if ($type == "br")
   {  
      $qQuery = "SELECT distinct id FROM $default->owl_folders_table f, $default->owl_advanced_acl_table a where a.folder_id=id and a.folder_id <> '1' and (a.user_id = '0' or a.user_id = '$userid'";
      foreach ($groups as $aGroups)
      {
        $qQuery .= " or a.group_id ='" .$aGroups["0"] . "'";
      }
      $qQuery .= ")";

      $qSqlQuery = "('1'='0' ";
      $glue = "";
 
      $sql->query($qQuery);


      while ($sql->next_record())
      {  
         $bIsInBrokenTree = false;
         fIsInBrokenTree($sql->f('id'));
         if ($bIsInBrokenTree == false)
         {
            continue;
         }
         $glue = " OR ";
         $qSqlQuery .= $glue . " id ='" . $sql->f('id') . "'";
      }


      $qSqlQuery .= ")";
    }

   $qFolderQuery = "SELECT * FROM $default->owl_folders_table where  $qSqlQuery";

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

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

fPrintNavBarXTPL($parent);

fGetStatusBarCount();
$iFileCount = $iFolderCount + $iFileCount;

if ($default->show_file_stats == 1 or $default->show_file_stats == 3)
{
   fPrintPanelXTPL('Top', $default->display_file_info_panel_wide);
}

switch ($type)
{
  case "u":
     $sPageTitle = $owl_lang->title_view_updated;
     $urlArgs = array();
     $urlArgs['sess']      = $sess;
     $urlArgs['type']    = $type;
     $urlArgs['expand']    = $expand;
     $urlArgs['curview']     = $curview;
     $xtpl->assign('SHOWREC_HIDDEN', fGetHiddenFields ($urlArgs));
     $xtpl->assign('SHOWREC_NUM_DAY_LABEL', $owl_lang->past_number);
     $xtpl->assign('SHOWREC_NUM_DAY_VALUE', $filter);
     $xtpl->assign('SHOWREC_SUBMIT_VALUE', $owl_lang->btn_submit);
     $xtpl->assign('SHOWREC_SUBMIT_ALT', $owl_lang->alt_btn_submit);
     $xtpl->assign('SHOWREC_RESET_VALUE', $owl_lang->btn_reset);
     $xtpl->assign('SHOWREC_RESET_ALT', $owl_lang->alt_reset_form);
     $xtpl->parse('main.ShowRecFilter');
     break;
  case "n":
     $sPageTitle = $owl_lang->title_view_new;
     $urlArgs = array();
     $urlArgs['sess']      = $sess;
     $urlArgs['type']    = $type;
     $urlArgs['expand']    = $expand;
     $urlArgs['curview']     = $curview;

     $xtpl->assign('SHOWREC_HIDDEN', fGetHiddenFields ($urlArgs));
     $xtpl->assign('SHOWREC_NUM_DAY_LABEL', $owl_lang->past_number);
     if (isset($filter))
     {
        $xtpl->assign('SHOWREC_NUM_DAY_VALUE', $filter);
     }
     $xtpl->assign('SHOWREC_SUBMIT_VALUE', $owl_lang->btn_submit);
     $xtpl->assign('SHOWREC_SUBMIT_ALT', $owl_lang->alt_btn_submit);
     $xtpl->assign('SHOWREC_RESET_VALUE', $owl_lang->btn_reset);
     $xtpl->assign('SHOWREC_RESET_ALT', $owl_lang->alt_reset_form);
     $xtpl->parse('main.ShowRecFilter');
     break;
  case "g":
     $sPageTitle = $owl_lang->files_in_my_group_title;
     break;
  case "m":
     $sPageTitle = $owl_lang->my_files_title;
     break;
  case "t":
     $sPageTitle = $owl_lang->my_monitored_title;
     break;
  case "br":
     $sPageTitle = $owl_lang->my_special_access_title;
     break;
  case "pa":
     $sPageTitle = $owl_lang->peer_pending_title;
     break;
  case "wa":
     $sPageTitle = $owl_lang->peer_approval_title;
     break;
  default:
     $sPageTitle = "";
     break;
}

$xtpl->assign('PAGE_TITLE', $sPageTitle);
$xtpl->parse('main.ShowRecTitle');


if ($default->show_search == 1 or $default->show_search == 3 or (fIsAdmin() and $default->show_search == 0))
{
   fPrintSearchXTPL("Top");
}
         

   if (($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {  
      $xtpl->assign('TITLE_STATUS', "&nbsp;");
      $xtpl->parse('main.DataBlock.Title.Status');
   }  

   if ($default->thumbnails == 1)
   {
      $xtpl->parse('main.DataBlock.Title.Thumb');
   }
      
   if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {  
      show_linkXTPL("id", "sortid", $sortid, $order, $sess, $expand, $parent, $owl_lang->doc_number, $filter);
   }
   
   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Title.DocType');
   }
   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      show_linkXTPL("name", "sortname", $sortname, $order, $sess, $expand, $parent, $owl_lang->title, $filter);
   }
   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         show_linkXTPL("major_minor_revision", "sortver", $sortver, $order, $sess, $expand, $parent, $owl_lang->ver, $filter);
      }
   }
   if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
   {
      show_linkXTPL("filename", "sortfilename", $sortfilename, $order, $sess, $expand, $parent, $owl_lang->file, $filter);
   }
   if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
   {
      show_linkXTPL("f_size", "sortsize", $sortsize, $order, $sess, $expand, $parent, $owl_lang->size, $filter);
   }
   if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
   {
      show_linkXTPL("creatorid", "sortposted", $sortposted, $order, $sess, $expand, $parent, $owl_lang->postedby, $filter);
   }
   if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
   {
      show_linkXTPL("updatorid", "sortupdator", $sortupdator, $order, $sess, $expand, $parent, $owl_lang->updated_by);
   }

   if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
   {
      show_linkXTPL("smodified", "sortmod", $sortmod, $order, $sess, $expand, $parent, $owl_lang->modified, $filter);
   }
   if($type == "wa" or $type == "pa" or $default->old_action_icons) 
   {
      $xtpl->assign('TITLE_ACTIONS', $owl_lang->actions);
      $xtpl->parse('main.DataBlock.Title.Actions');
   }
  
   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
      {
         show_linkXTPL("checked_out", "sortcheckedout", $sortcheckedout, $order, $sess, $expand, $parent, $owl_lang->held, $filter);
      }
   }
   if ( $default->document_peer_review == 1 and $type == "pa")
   {
      $xtpl->assign('PEER_STATUS_TITLE', $owl_lang->peer_satus);
      $xtpl->parse('main.DataBlock.Title.peerreview');
   }

$sql = new Owl_DB;

if ($type == "t" or $type == "br")
{
   if ($glue == " OR ")
   {
      $sql->query("SELECT * FROM $default->owl_folders_table where  $qSqlQuery ");
      while ($sql->next_record())
      {
         // Looping out Folders
         $GetItems = new Owl_DB;
   
         $iFolderCount = 0;
         $iParent = $sql->f("parent");
         $GetItems->query("SELECT id from $default->owl_folders_table where parent = '" . $sql->f("id") . "'" . $whereclause);
 
         if ($default->restrict_view == 1)
         {
            while ($GetItems->next_record())
            {
               $bFileDownload = check_auth($GetItems->f("id"), "folder_view", $userid);
               if ($bFileDownload)
               {
                  $iFolderCount++;
               }
            }
         }
         else
         {
            $iFolderCount = $GetItems->num_rows();
         }
   
         $iFileCount = fCountFileType ($sql->f("id"), '0');
         $iUrlCount = fCountFileType ($sql->f("id"), '1');
         $iNoteCount = fCountFileType ($sql->f("id"), '2');
 
         $CountLines++;
         $PrintLines = $CountLines % 2;

         if ($PrintLines == 0)
         {
            $sTrClass = "hover1";
            $sLfList = "lfile1";
            $sTrClassHilite = "mouseover1";
            $sTrClassHiliteAlt = "mouseover3";
         }
         else
         {
            $sTrClass = "hover2";
            $sLfList = "lfile1";
            $sTrClassHilite = "mouseover2";
            $sTrClassHiliteAlt = "mouseover3";
         }

         $xtpl->assign('FOLDER_TR_ID', "foldertr" . $sql->f("id"));
         $xtpl->assign('FOLDER_TR_CLASS', $sTrClassHilite);
         $xtpl->assign('FOLDER_TR_MOUSOVER', "class=\"$sTrClassHilite\" onmouseover=\"alt_css_style('fcheckid" . $sql->f("id") . "', this, '$sTrClassHiliteAlt')\"  onmouseout=\"alt_css_style('fcheckid" . $sql->f("id") . "', this, '$sTrClassHilite')\"");

         $xtpl->assign('FOLDER_TD_CLASS', $sTrClass);
      

      //*******************************************************************************************************

   if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Folder.Status');
   }

   if ($default->thumbnails == 1)
   {
      $xtpl->parse('main.DataBlock.Folder.Thumb');
   }

   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $parent;
   // 0 = View File Details
   // 1 = Download File
   // 2 = Modify File Properties
   if ($default->folder_action_click_title_column == 0)
   {
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
      $sAltString = $owl_lang->title_browse_folder;
   }
   else if ($default->folder_action_click_title_column == 1)
   {
      $urlArgs2['binary'] = '1';
      $urlArgs2['id'] = $sql->f('id');
      $urlArgs2['action'] = 'folder';
      $url = fGetURL ('download.php', $urlArgs2);
      $sAltString = $owl_lang->alt_get_folder;
   }
   else if ($default->folder_action_click_title_column == 2)
   {
      $urlArgs2['action'] = 'folder_modify';
      $urlArgs2['id'] = $sql->f('id');
      $url = fGetURL ('modify.php', $urlArgs2);
   }
   else
   {
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
      $sAltString = $owl_lang->title_browse_folder;
   }


   if(($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $xtpl->assign('FOLDER_DOCTYPE_URL', $url);
      $xtpl->assign('FOLDER_DOCTYPE_TITLE', $sAltString);
      $xtpl->parse('main.DataBlock.Folder.DocType');
   }


   if(($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Folder.id');
   }
   if(($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      if ($default->show_folder_desc_as_popup == '1')
      {
         $sPopupDescription= htmlentities(strip_tags(fCleanDomTTContent($sql->f("description")), '<br><br />'), ENT_QUOTES, "UTF-8");
         if (trim($sPopupDescription) == "")
         {
            $sPopupDescription = $owl_lang->no_description;
         }

         $sPopupCode = " onmouseover=" . '"' . sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime) . '"'; 
      }
      else
      {
         $sPopupCode = "";
         $sPopupDescription = strip_tags($sql->f("description"), '<br><br />');
      }


      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);

      $xtpl->assign('FOLDER_NAME_URL', $url);
      $xtpl->assign('FOLDER_NAME_TITLE', $sAltString);
      $xtpl->assign('FOLDER_NAME_MOUSEOVER', $sPopupCode);
      $xtpl->assign('FOLDER_NAME_NAME', $sql->f("name"));


      if(!$default->hide_folder_doc_count)
      {
         $sCounts = '';
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $sCounts .= "&nbsp;(";
         }
         if ($iFolderCount > 0 )
         {
            $sCounts .= "<a href=\"#\" class=\"cfolders1\" title=\"$owl_lang->folder_count_pre $iFolderCount $owl_lang->folder_count_folder\">$iFolderCount</a>";
         }
         if ($iFileCount > 0 )
         {
            if ($iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"cfiles1\" title=\"$owl_lang->folder_count_pre $iFileCount $owl_lang->folder_count_file\">$iFileCount</a>";
         }
         if ($iUrlCount  > 0 )
         {
            if ($iFileCount > 0 or $iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"curl1\" title=\"$owl_lang->folder_count_pre $iUrlCount $owl_lang->folder_count_url\">$iUrlCount</a>";
         }
         if ($iNoteCount > 0)
         {
            if ($iUrlCount  > 0 or $iFileCount > 0 or $iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"cnotes1\" title=\"$owl_lang->folder_count_pre $iNoteCount $owl_lang->folder_count_note\">$iNoteCount</a>";
         }
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $sCounts .= ")";
         }
         $xtpl->assign('FOLDER_NAME_COUNTS', $sCounts);
      }

      if (trim($sql->f("description")) and $default->show_folder_desc_as_popup == '0')
      {
         $sDescription = strip_tags($sql->f("description"), '<br><br />');
         $xtpl->assign('FOLDER_NAME_DESC_POP', "<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\"><a class=\"desc\">" . "<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\" />$sDescription</a>");
      }
      $xtpl->parse('main.DataBlock.Folder.Name');

   }

      if ($default->owl_version_control == 1)
      {
         if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.major_minor_revision');
         }

       if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if(!$default->old_action_icons)
            {
               fSetupFolderActionMenusXTPL($sql->f("id"), $sql->f("name"));
               $xtpl->parse('main.DataBlock.Folder.filename');
            }
            else
            {
               $xtpl->assign('FOLDER_MENU', '&nbsp;');
               $xtpl->parse('main.DataBlock.Folder.filename');
            }
         }

         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            if ($default->hide_folder_size)
            {
               $xtpl->assign('FOLDER_SIZE', '&nbsp;');
            }
            else
            {
               $FolderSize = fGetFolderSize($sql->f("id"));
               $xtpl->assign('FOLDER_SIZE', gen_filesize($FolderSize));
            }
            $xtpl->parse('main.DataBlock.Folder.f_size');

         }

         if( $default->show_user_info == 1)
         {
            $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\">" . flid_to_creator($sql->f("id")) . "</a>";
         }
         else
         {
            $sLinkToUser =  uid_to_name($sql->f("creatorid"));
         }

         if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
         {
            $xtpl->assign('FOLDER_CREATOR', $sLinkToUser);
            $xtpl->parse('main.DataBlock.Folder.creatorid');

         }
         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.updatorid');
         }
         if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
         {
            if ($sql->f("smodified"))
            {
               $xtpl->assign('FOLDER_MODIFIED', date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset));
            }
            else
            {
               $xtpl->assign('FOLDER_MODIFIED', '&nbsp;');
            }
            $xtpl->parse('main.DataBlock.Folder.smodified');
         }

      } 
      else
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if(!$default->old_action_icons)
            {
               fSetupFolderActionMenusXTPL($sql->f("id"), $sql->f("name"));
               $xtpl->parse('main.DataBlock.Folder.filename');
            }
            else
            {
               $xtpl->assign('FOLDER_MENU', '&nbsp;');
               $xtpl->parse('main.DataBlock.Folder.filename');
            }

         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            if ($default->hide_folder_size)
            {
               $xtpl->assign('FOLDER_SIZE', '&nbsp;');
            }
            else
            {
               $FolderSize = fGetFolderSize($sql->f("id"));
               $xtpl->assign('FOLDER_SIZE', gen_filesize($FolderSize));
            }
            $xtpl->parse('main.DataBlock.Folder.f_size');

         }
         if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
         {
            $xtpl->assign('FOLDER_CREATOR', $sLinkToUser);
            $xtpl->parse('main.DataBlock.Folder.creatorid');

         }
         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.updatorid');
         }
         if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
         {
            if ($sql->f("smodified"))
            {
               $xtpl->assign('FOLDER_MODIFIED', date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset));
            }
            else
            {
               $xtpl->assign('FOLDER_MODIFIED', '&nbsp;');
            }
            $xtpl->parse('main.DataBlock.Folder.smodified');
         }
      } 

      //if (($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) // DISABLED FOR NOW
      if (1 == 0)
      {

         $sSpacer = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/x_clear.gif\" height=\"1\" width=\"17\" alt=\"\" />";
         $xtpl->assign('FOLDER_ACTION_LOG', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_HOTLINK', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_DEL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MOD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_INLINE', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_ACL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_LINK', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_COPY', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MOVE', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_UPD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_DNLD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_COMMENT', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_CHECKOUT', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_EMAIL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MON', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_RELATED', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_VIEW', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_GENTHUMB', $sSpacer);

         // *****************************************
         // Display the Delete Icons For the Folders
         // *****************************************
    
         if (check_auth($sql->f("id"), "folder_delete", $userid, false, false) == 1)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['action'] = 'folder_delete';
            $url = fGetURL ('dbmodify.php', $urlArgs2);
   
            $xtpl->assign('FOLDER_ACTION_DEL', "<a href=\"$url\" onclick=\"return confirm('$owl_lang->reallydelete " . htmlspecialchars($sql->f("name"), ENT_QUOTES) . "?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" title=\"$owl_lang->alt_del_folder\" border=\"0\" /></a>");
         }

         // *****************************************
         // Display the Property Icons For the Folders
         // *****************************************
    
         if (check_auth($sql->f("id"), "folder_property", $userid, false, false) == 1)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['action'] = 'folder_modify';
            $url = fGetURL ('modify.php', $urlArgs2);
   
            $xtpl->assign('FOLDER_ACTION_MOD', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_folder\" title=\"$owl_lang->alt_mod_folder\" /></a>");
         }

         if ( $default->advanced_security == 1 )
         {
            if (check_auth($sql->f("id"), "folder_acl", $userid, false, false) == 1)
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $sql->f("id");
               $urlArgs2['parent'] = $parent;
               $urlArgs2['edit'] = 1;
               $urlArgs2['action'] = "folder_acl";
               $sUrl = fGetURL ('setacl.php', $urlArgs2);
               $xtpl->assign('FOLDER_ACTION_ACL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->alt_set_folder_acl\" title=\"$owl_lang->alt_set_folder_acl\" /></a>");
            }
         }
 
         // *****************************************
         // Display the move Icons For the Folders
         // *****************************************
 
         //if (check_auth($sql->f("id"), "folder_modify", $userid, false, false) == 1 and check_auth($sql->f("id"), "folder_delete", $userid, false, false) == 1)
         if (check_auth($sql->f("id"), "folder_cp", $userid, false, false) == 1)
         {
             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'cp_folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);
   
             $xtpl->assign('FOLDER_ACTION_COPY', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_folder\" title=\"$owl_lang->alt_copy_folder\" /></a>");
   
         }
         
         if (check_auth($sql->f("id"), "folder_move", $userid, false, false) == 1)
         {

             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);

             $xtpl->assign('FOLDER_ACTION_MOVE', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_folder\" title=\"$owl_lang->alt_move_folder\" /></a>");
             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'lnk_folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);

             $xtpl->assign('FOLDER_ACTION_LINK', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/fld_link.gif\" border=\"0\" alt=\"LINK THIS FOLDER\" title=\"LINK THIS FOLDER\" /></a>");

         } 
   

         //if (check_auth($sql->f("id"), "folder_view", $userid, false, false) == 1)
         if (check_auth($sql->f("id"), "folder_monitor", $userid, false, false) == 1)
         {
            $folder_id = $sql->f("id");
            $checksql = new Owl_DB;
            $checksql->query("select * from $default->owl_monitored_folder_table where fid = '$folder_id' and userid = '$userid'");
            $checknumrows = $checksql->num_rows($checksql);
   
            $checksql->query("SELECT * from $default->owl_users_table where id = '$userid'");
            $checksql->next_record();
            if (trim($checksql->f("email")) != "")
            {
               if ($checknumrows == 0)
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['id'] = $folder_id;
                  $urlArgs2['parent'] = $parent;
                  $urlArgs2['action'] = 'folder_monitor';
                  $url = fGetURL ('dbmodify.php', $urlArgs2);
   
                  $xtpl->assign('FOLDER_ACTION_MON', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor_folder\" title=\"$owl_lang->alt_monitor_folder\" /></a>");
               } 
               else
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['id'] = $folder_id;
                  $urlArgs2['parent'] = $parent;
                  $urlArgs2['action'] = 'folder_monitor';
                  $url = fGetURL ('dbmodify.php', $urlArgs2);
   
                  $xtpl->assign('FOLDER_ACTION_MON', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored_folder\" title=\"$owl_lang->alt_monitored_folder\" /></a>");
               } 
            } 
         } 

         if (check_auth($sql->f("id"), "folder_view", $userid, false, false) == 1)
         {
            $urlArgs2 = array();
            $urlArgs2['sess']   = $sess;
            $urlArgs2['id']     = $sql->f("id");
            $urlArgs2['parent'] = $sql->f("parent");
            $urlArgs2['action'] = 'folder';
            $urlArgs2['binary'] = 1;
            $urlArgs2['expand']    = $expand;
            $urlArgs2['order']     = $order;
            $urlArgs2['sortorder'] = $sort;
            $url = fGetURL ('download.php', $urlArgs2);
   
            if (file_exists($default->tar_path) && trim($default->tar_path) != "" && file_exists($default->gzip_path) && trim($default->gzip_path) != "")
            {
               $xtpl->assign('FOLDER_ACTION_DNLD', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/zip.gif\" border=\"0\" alt=\"$owl_lang->alt_get_folder\" title=\"$owl_lang->alt_get_folder\" /></a>");
            }
         } 
         if ($default->thumbnails == 1 and fisAdmin())
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['parent'] = $sql->f("parent");
            $urlArgs2['action'] = 'folder_thumb';
            $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
            $xtpl->assign('FOLDER_ACTION_GENTHUMB', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
         }  
         $xtpl->parse('main.DataBlock.Folder.Action');
      }

      if ($default->owl_version_control == 1)
      {
         if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.checked_out');
         }
      }

      $xtpl->parse('main.DataBlock.Folder');
   }
   }
}  
         


// 
// BEGIN Print Files
// 

// Looping out files from DB!
$qGetFile = new Owl_DB;
$qGetFile->query($qFileQuery);

while ($qGetFile->next_record())
{
   $iRealFileID = fGetPhysicalFileId($qGetFile->f('id'));
   $bPrintNew = false;
   $bPrintUpdated = false;
   $bHasComments = false;
   $bWasIndexed = false;

   if ($fileid == $qGetFile->f("id"))
   {
      $sBoldBegin = '<b class="hilite">';
      $sBoldEnd = '</b>';
   }
   else
   {
      $sBoldBegin = '';
      $sBoldEnd = '';
   }

   $sDirectoryPath = get_dirpath($qGetFile->f("parent"));
   $pos = strpos($sDirectoryPath, "$default->version_control_backup_dir_name");
   if (is_integer($pos) && $pos)
   {
      $is_backup_folder = true;
   }
   else
   {
      $is_backup_folder = false;
   }

   if ($type == "n")
   {
      $sDirectoryPath = get_dirpath($qGetFile->f("parent"));
      $pos = strpos($sDirectoryPath, "$default->version_control_backup_dir_name");
      if (is_integer($pos) && $pos)
      {
         continue;
      } 
   } 

   if ($default->restrict_view == 1 and $type != "wa")
   {
      
      if (!check_auth($qGetFile->f("id"), "file_download", $userid))
      {
         continue;
      }
   } 
   // 
   // Find New files
   // 
   if (check_auth($qGetFile->f("id"), "file_download", $userid) == 1)
   {
      if ($qGetFile->f("created") > $lastlogin)
      {
         $bPrintNew = true;
         $iNewFileCount++;
      } 
      if ($qGetFile->f("smodified") > $lastlogin && $qGetFile->f("created") < $lastlogin)
      {
         $bPrintUpdated = true;
         $iUpdatedFileCount++;
      } 
   } 
   else
   {
      if ($type <> "wa" and $type <> "br")
      {
         continue;
      }
   }

   $CountLines++;
   $PrintLines = $CountLines % 2;
 if ($PrintLines == 0)
   {
      $sTrClass = "hover1";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover1";
      $sTrClassHiliteAlt = "mouseover3";
   }
   else
   {
      $sTrClass = "hover2";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover2";
      $sTrClassHiliteAlt = "mouseover3";
   }

   $xtpl->assign('FILE_TR_ID', "filetr" . $qGetFile->f("id"));
   $xtpl->assign('FILE_TR_CLASS', $sTrClassHilite);
   $xtpl->assign('FILE_TR_MOUSOVER', "class=\"$sTrClassHilite\" onmouseover=\"alt_css_style('checkid" . $qGetFile->f("id") . "', this, '$sTrClassHiliteAlt')\"  onmouseout=\"alt_css_style('checkid" . $qGetFile->f("id") . "', this, '$sTrClassHilite')\"");

   $xtpl->assign('FILE_TD_CLASS', $sTrClass);



   if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      if ($bHasComments)
      {
         if ($bPrintNewComment)
         {
            $iImage = "newcomment";
         }
         else
         {
            $iImage = "comment";
         }

         
         $urlArgs2 = $urlArgs;
         $urlArgs2['id']     = $qGetFile->f("id");
         $urlArgs2['parent'] = $parent;
         $urlArgs2['action'] = 'file_comment';
         $url = fGetURL ('modify.php', $urlArgs2);
   
         $xtpl->assign('FILE_STATUS_COMMENT_IMG', "<a class=\"$sLfList\" href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/$iImage.gif\" border=\"0\" alt=\"$iTotalComments --- $owl_lang->alt_comments\" title=\"$iTotalComments --- $owl_lang->alt_comments\" /></a>");

      } 
      if ($default->anon_user <> $userid)
      {

         $xtpl->assign('FILE_STATUS_INDEXED', '');
         $xtpl->assign('FILE_STATUS_NEW', '');
         $xtpl->assign('FILE_STATUS_UPDATED', '');
         $xtpl->assign('FILE_STATUS_INFECTED', '');

         if ($bPrintNew)
         {
            $xtpl->assign('FILE_STATUS_NEW', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/new.gif\" border=\"0\" alt=\"$owl_lang->alt_new\" title=\"$owl_lang->alt_new\" />");
         } 
         if ($bPrintUpdated)
         {
            $xtpl->assign('FILE_STATUS_UPDATED', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/updated.gif\" border=\"0\" alt=\"$owl_lang->alt_updated\" title=\"$owl_lang->alt_updated\" />");
         } 
         if ($bWasIndexed)
         {
            $xtpl->assign('FILE_STATUS_INDEXED', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/indexed.png\" border=\"0\" alt=\"$owl_lang->alt_indexed\" title=\"$owl_lang->alt_indexed\" />");
         }
      } 
      $xtpl->parse('main.DataBlock.File.Status');
   }
   if ($default->thumbnails == 1)
   {
	  $sThumbUrl = $default->thumbnails_url . '/' . $default->owl_current_db . "_" . $iRealFileID . "_small.png";
      $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_small.png";

      $sMedThumbUrl = $default->thumbnails_url . '/' . $default->owl_current_db . "_" . $iRealFileID . "_med.png";
      $sMedThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_med.png";

      if (file_exists($sThumbLoc))
      {
         $xtpl->assign('FILE_THUMBNAIL', "<img src=\"$sThumbUrl\" border=\"1\" alt=\"$owl_lang->alt_thumb_small\" title=\"$owl_lang->alt_thumb_small\" />");
      }
      else
      {
         $xtpl->assign('FILE_THUMBNAIL', "&nbsp;");
      }
      $xtpl->parse('main.DataBlock.File.Thumb');
   }

   if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      $sZeroFilledId = str_pad($qGetFile->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
      $xtpl->assign('FILE_ID_VALUE', $sBoldBegin . $default->doc_id_prefix . $sZeroFilledId . $sBoldEnd);
      $xtpl->parse('main.DataBlock.File.id');
   }

   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $ext = fFindFileExtension($qGetFile->f('filename'));
      
      if (!empty($ext))
      {
         if ($iRealFileID == $qGetFile->f('id'))
         {
            $sDispIcon = $ext;
         }
         else
         {
            $sDispIcon = $ext . "_lnk";
         }
      }
      else
      {
         $sDispIcon = "NoExtension";
      }
   
   $urlArgs2 = $urlArgs;
   $urlArgs2['sess']   = $sess;
   $urlArgs2['id']     = $qGetFile->f("id");
   $urlArgs2['parent'] = $parent;

   if ($default->file_action_click_title_column == 0)
   {
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_view_file;
   }
   else if ($default->file_action_click_title_column == 1)
   {
      $urlArgs2['binary'] = '1';
      $url = fGetURL ('download.php', $urlArgs2);
      $sAltString = $owl_lang->alt_get_file;
   }
   else if ($default->file_action_click_title_column == 2)
   {
      $urlArgs2['action'] = 'file_modify';
      $url = fGetURL ('modify.php', $urlArgs2);
      $sAltString = $owl_lang->alt_mod_file;
   }
   else if ($default->file_action_click_title_column == 3)
   {

      $urlArgs2['action'] = fGetViewFileAction($qGetFile->f("id"),$qGetFile->f("filename"));
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_mod_file;
   }
   else
   {
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_view_file;
   }


      if ($qGetFile->f("url") == "1")
      {
         $xtpl->assign('FILE_DOCTYPE_IMG', 'url');
         $xtpl->assign('FILE_DOCTYPE_URL_OPEN', '');
         $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', '');;
      }
      else
      {
         if (!file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.gif") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpg") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpeg") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.png"))
         {
            if ($iRealFileID == $qGetFile->f('id'))
            {
               $sDispIcon = "file";
            }
            else
            {
               $sDispIcon = "file_lnk";
            }
         }
         $xtpl->assign('FILE_DOCTYPE_IMG', $sDispIcon);
         $xtpl->assign('FILE_DOCTYPE_URL_OPEN', "<a class=\"$sLfList\" href=\"$url\" title=\"$sAltString: " . $qGetFile->f("filename") ."\">");
         $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', "</a>");
      }
      $xtpl->parse('main.DataBlock.File.DocType');
   }

   
   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      $sPopupDescription = fCleanDomTTContent($qGetFile->f("description"));

      if ($sPopupDescription == "") 
      {
         $sPopupDescription = $owl_lang->no_description;
      }

      $urlArgs2 = $urlArgs;
      $urlArgs2['sess']   = $sess;
      $urlArgs2['id']     = $qGetFile->f("id");
      //$urlArgs2['parent'] = $parent;
      $urlArgs2['parent'] = $qGetFile->f("parent");
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
   
      $sTitle = $sBoldBegin . $qGetFile->f("name") . $sBoldEnd . "</a>";
      $xtpl->assign('FILE_NAME', "<a class=\"$sLfList\" href=\"$url\" onmouseover=" . '"' . sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime) . "\"  title=\"$sAltString: " . $qGetFile->f("filename") ."\"" . '">' . $sTitle);
      $xtpl->parse('main.DataBlock.File.Name');


   }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         $xtpl->assign('FILE_VERSION', $sBoldBegin . $qGetFile->f("major_revision") . "." . $qGetFile->f("minor_revision") . $sBoldEnd);
         $xtpl->parse('main.DataBlock.File.major_minor_revision');
      }
   } 

   if ($qGetFile->f("url") == "1")
   {
      if (check_auth($qGetFile->f("id"), "file_download", $userid))
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
             $xtpl->assign('FILE_FILENAME', "<a class=\"$sLfList\" href=\"" . $qGetFile->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $qGetFile->f("filename") . "\">" . $qGetFile->f("filename") . "</a>");

         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            $xtpl->assign('FILE_SIZE', "&nbsp;");
         }
      } 
      else
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            $xtpl->assign('FILE_FILENAME', $qGetFile->f("filename"));
         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            $xtpl->assign('FILE_SIZE', "&nbsp;");
         }
      } 
      $xtpl->parse('main.DataBlock.File.simplefilename');
      $xtpl->parse('main.DataBlock.File.f_size');
   }
   else
   {
      if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
      {
         if (check_auth($qGetFile->f("id"), "file_download", $userid))
         {
            if($default->old_action_icons)
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id']     = $qGetFile->f("id");
               $urlArgs2['parent'] = $qGetFile->f("parent");
               $url = fGetURL ('download.php', $urlArgs2);
               $xtpl->assign('FILE_FILENAME', "<a class=\"$sLfList\" href=\"" . $url  . "\" title=\"$owl_lang->title_download_view\">" . $qGetFile->f("filename") . "</a>");
               $xtpl->parse('main.DataBlock.File.simplefilename');
            }
            else
            {
               fSetupFileActionMenusXTPL($qGetFile->f("id"), $qGetFile->f("filename"), $qGetFile->f("creatorid"), $qGetFile->f("approved"), $qGetFile->f("checked_out"), $qGetFile->f("url"), $qGetFile->f("parent"), $qGetFile->f("infected"));
               $xtpl->parse('main.DataBlock.File.filename');
            }
         }
         else
         {
            $xtpl->assign('FILE_FILENAME', $qGetFile->f("filename"));
            $xtpl->parse('main.DataBlock.File.filename');
         }
      }
      if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
      {
         $xtpl->assign('FILE_SIZE', gen_filesize($qGetFile->f("f_size")));
         $xtpl->parse('main.DataBlock.File.f_size');
      }
   }

      if( $default->show_user_info == 1)
      {         $dDateLastLoging =  date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($qGetFile->f("id"))) + $default->time_offset);
         $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $qGetFile->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " .  $dDateLastLoging  . "\">$sBoldBegin" . uid_to_name($qGetFile->f("creatorid")) . "$sBoldEnd</a>";
         $sLinkToUpdator = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $qGetFile->f("updatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " . $dDateLastLoging  . "\">$sBoldBegin" . uid_to_name($qGetFile->f("updatorid")) . "$sBoldEnd</a>";
      }
      else
      {  
         $sLinkToUser = $sBoldBegin . uid_to_name($qGetFile->f("creatorid")) . $sBoldEnd;
         $sLinkToUpdator = $sBoldBegin . uid_to_name($qGetFile->f("updatorid")) . $sBoldEnd;
      }


      if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
      {
         $xtpl->assign('FILE_CREATOR', $sLinkToUser);
         $xtpl->parse('main.DataBlock.File.creatorid');
      }
         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->assign('FILE_UPDATOR', $sLinkToUpdator);
            $xtpl->parse('main.DataBlock.File.updatorid');
         }

      if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
      {
         $xtpl->assign('FILE_MODIFIED', $sBoldBegin . date($owl_lang->localized_date_format, strtotime($qGetFile->f("smodified")) + $default->time_offset) . $sBoldEnd);
         $xtpl->parse('main.DataBlock.File.smodified');
      }

         if ($type == "wa")
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['binary'] = 1;
            $urlArgs2['id'] = $qGetFile->f("id");
            $urlArgs2['parent'] = $parent;

            $sUrl = fGetURL ('download.php', $urlArgs2);

            $xtpl->assign('PEER_DOWNLOAD_URL', $sUrl);
            $xtpl->assign('PEER_DOWNLOAD_ALT', $owl_lang->alt_get_file);

            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $qGetFile->f("id");
            $urlArgs2['action'] = "approvedoc";
            $urlArgs2['parent'] = $parent;
            $sUrl = fGetURL ('peerreview.php', $urlArgs2);

            $xtpl->assign('PEER_APPROVED_URL', $sUrl);
            $xtpl->assign('PEER_APPROVED_ALT', $owl_lang->alt_approve_file);

            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $qGetFile->f("id");
            $urlArgs2['action'] = "docreject";
            $urlArgs2['parent'] = $parent;
            $sUrl = fGetURL ('peerreview.php', $urlArgs2);

            $xtpl->assign('PEER_REJECTED_URL', $sUrl);
            $xtpl->assign('PEER_REJECTED_ALT', $owl_lang->alt_reject_file);

            $xtpl->parse('main.DataBlock.File.PeerAction.WaitApproval');
            $xtpl->parse('main.DataBlock.File.PeerAction');
         }
         elseif ($type == "pa")
         {
            $qGetDocReviewer = new Owl_DB;
            $qGetDocReviewer->query("SELECT * from $default->owl_peerreview_table where file_id = '" . $qGetFile->f("id") . "' and status <> '1'");
            $iReviewersLeft = $qGetDocReviewer->num_rows();
            
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'reminder';
            $urlArgs2['id'] = $qGetFile->f("id");
            $urlArgs2['type'] = $type;
            $urlArgs2['parent'] = $qGetFile->f("parent");
            $sUrl = fGetURL ('peerreview.php', $urlArgs2);

            $xtpl->assign('PEER_REMINDER_URL', $sUrl);
            $xtpl->assign('PEER_REMINDER_ALT', $owl_lang->alt_email_reminder);

            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_del_rejected';
            $urlArgs2['id']     = $qGetFile->f("id");
            $urlArgs2['type'] = $type;
            $urlArgs2['parent'] = $qGetFile->f("parent");
            $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

            $xtpl->assign('PEER_DELETE_URL', $sUrl);
            $xtpl->assign('PEER_DELETE_CONFIRM', $owl_lang->reallydelete . " " . $qGetFile->f("filename")."?");
            $xtpl->assign('PEER_DELETE_ALT', $owl_lang->alt_del_file);

            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_update';
            $urlArgs2['id'] = $qGetFile->f("id");
            $urlArgs2['parent'] = $qGetFile->f("parent");
            $sUrl = fGetURL ('modify.php', $urlArgs2);

            $xtpl->assign('PEER_UPDATE_URL', $sUrl);
            $xtpl->assign('PEER_UPDATE_ALT', $owl_lang->alt_upd_file);
 
            if ($iReviewersLeft == 0)
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'publish';
               $urlArgs2['id'] = $qGetFile->f("id");
               $urlArgs2['type'] = $type;
               $urlArgs2['parent'] = $qGetFile->f("parent");
               $sUrl = fGetURL ('peerreview.php', $urlArgs2);
               
               $xtpl->assign('PEER_PUB_URL', $sUrl);
               $xtpl->assign('PEER_PUB_ALT', $owl_lang->alt_publish_file);
               $xtpl->parse('main.DataBlock.File.PeerAction.PendApproval.Publish');
            }
            $xtpl->parse('main.DataBlock.File.PeerAction.PendApproval');
            $xtpl->parse('main.DataBlock.File.PeerAction');
      }
      else
      {
         if($default->old_action_icons)
         {
            fPrintFileIconsXtpl($qGetFile->f("id"), $qGetFile->f("filename"), $qGetFile->f("checked_out"), $qGetFile->f("url"), $default->owl_version_control, $ext, $parent, $is_backup_folder);
            $xtpl->parse('main.DataBlock.File.Action');
         }
      }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
      {
         if (($holder = uid_to_name($qGetFile->f("checked_out"))) == "Owl")
         {
            $xtpl->assign('FILE_CHECKEDOUT', $sBoldBegin . '-' . $sBoldEnd);
         } 
         else
         {
           $xtpl->assign('FILE_CHECKEDOUT', $sLinkToUser);
         } 
         $xtpl->parse('main.DataBlock.File.checked_out');
      }
   } 

   if ( $default->document_peer_review == 1 and $type == "pa")
   {
      $qGetDocReviewer = new Owl_DB;
      $qGetDocReviewer->query("SELECT * from $default->owl_peerreview_table where file_id = '" . $qGetFile->f("id") . "' ");

      while($qGetDocReviewer->next_record())
      {
        $xtpl->assign('PEER_STATUS_REVIEWER',  uid_to_name($qGetDocReviewer->f("reviewer_id")));

        switch ($qGetDocReviewer->f("status"))
        {
           case 1:
              $xtpl->assign('PEER_STATUS_CLASS',  'capproved');
              $xtpl->assign('PEER_STATUS_LABEL',  $owl_lang->peer_satus_approved);
              break;
           case 2:
              $xtpl->assign('PEER_STATUS_CLASS',  'crejected');
              $xtpl->assign('PEER_STATUS_LABEL',  $owl_lang->peer_satus_rejected);
              break;
           default:
              $xtpl->assign('PEER_STATUS_CLASS',  'cpending');
              $xtpl->assign('PEER_STATUS_LABEL',  $owl_lang->peer_satus_pending);
              break;
        }
      }
     $xtpl->parse('main.DataBlock.File.PeerStatus');
   }
   $xtpl->parse('main.DataBlock.File');
}  


   $xtpl->parse('main.DataBlock.Title');
   $xtpl->parse('main.DataBlock');

   if ($default->show_search == 2 or $default->show_search == 3)
   {
      fPrintSearchXTPL("Bottom");
   }


   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL("Bottom");
   }

fSetElapseTime();
fSetOwlVersion();

$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
