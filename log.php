<?php
/**
 * log.php
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
 * $Id: log.php,v 1.10 2006/09/12 15:32:53 b0zz Exp $
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

if ($default->owl_maintenance_mode == 1)
{
   if(!fIsAdmin(true))
   {
      header("Location: " . $default->owl_root_url . "/index.php?failure=9");
      exit;
   }
}

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");


//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/log.xtpl");
$xtpl = new XTemplate("html/log.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);


// store file name and extension separately

//$filename = unserialize(stripslashes(stripslashes($filename)));
$filename = preg_replace("/<amp>/","&", $filename);

$aFirstpExtension = fFindFileFirstpartExtension ($filename);
$firstpart = $aFirstpExtension[0];
$file_extension = $aFirstpExtension[1];
$haveextension = $aFirstpExtension[2];

if(empty($expand))
{
   $expand = $default->expand;
}

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

// END 496814 Column Sorts are not persistant
//print("<center>\n");

fSetLogo_MOTD();
fSetPopupHelp();

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

if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
{
   if ($default->show_action == 1 or $default->show_action == 3 or (fIsAdmin() and $default->show_action == 0))
   {
      fPrintActionButtonsXTLP();
   }
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent, $owl_lang->viewlog . ":&nbsp;", $id);

$xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"view.php\" method=\"post\">\n");

$urlArgs2 = $urlArgs;
$urlArgs2['action'] = 'diff_show';
$urlArgs2['expand'] = $expand;
$urlArgs2['id'] = $id;
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

$xtpl->assign('VIEW_LOG_FOR', $filename);

$xtpl->assign('VIEW_LOG_TITLE_VERSION', $owl_lang->ver);
$xtpl->assign('VIEW_LOG_TITLE_OWNER', $owl_lang->owner);

if (!empty ($default->edit_text_files_inline))
{
   $edit_inline = $default->edit_text_files_inline;
   $ext = fFindFileExtension(flid_to_filename($id));
   if ($ext != "" && preg_grep("/\b$ext\b/", $edit_inline))
   {
      $xtpl->assign('VIEW_LOG_TITLE_DIFF_FROM', $owl_lang->diff_from);
      $xtpl->assign('VIEW_LOG_TITLE_DIFF_TO', $owl_lang->diff_to);
      $xtpl->parse('main.ViewFileLog.DiffFromToTitle');
   }
}

$xtpl->assign('VIEW_LOG_TITLE_FILE', $owl_lang->alt_log_file);

if ( $default->document_peer_review == 1)
{
   $xtpl->assign('VIEW_LOG_TITLE_PEER_STATUS', $owl_lang->peer_satus);
   $xtpl->parse('main.ViewFileLog.PeerStatusTitle');
}

$xtpl->assign('VIEW_LOG_TITLE_MODIFIED', $owl_lang->modified);
$xtpl->assign('VIEW_LOG_TITLE_LAST_MOD', $owl_lang->last_modified);

$sql = new Owl_DB; 

// SPECIFIC SQL LOG QUERY -  NOT USED (problematic)
// This SQL log query is designed for repository assuming there is only 1
// digit in major revision, and noone decides to have a "_x-" in their
// filename.

// Has to be changed if the naming structure changes.
// Also a problem that it didn't catch the "current"
// file because of the "_x-" matching (grr)

// $sql->query("select * from $default->owl_files_table where filename LIKE '$filesearch[0]\__-%$filesearch[1]' order by major_revision desc, minor_revision desc");
// GENERIC SQL LOG QUERY - currently used.
// prone to errors when people name a set of docs
// Blah.doc
// Blah_errors.doc
// Blah_standards.doc
// etc. and search for a log on Blah.doc (it brings up all 3 docs)
// $sql->query("select * from $default->owl_files_table where filename LIKE '$filesearch[0]%$filesearch[1]' order by major_revision desc, minor_revision desc");
// $SQL = "select * from $default->owl_files_table where filename LIKE '$filesearch[0]%$filesearch[1]' order by major_revision desc, minor_revision desc";
// Fair portable way ? Filter "Blah_errors.doc" out il the while loo
if ($default->owl_use_fs)
{
   $sql->query("SELECT id FROM $default->owl_folders_table WHERE name='$default->version_control_backup_dir_name' and parent='$parent'");
   if ($sql->num_rows($sql) != 0)
   {
      while ($sql->next_record())
      {
         $backup_parent = $sql->f("id");
      } 
   } 
   else
   {
      $backup_parent = $parent;
   } 
   $sql->query("SELECT * FROM $default->owl_files_table WHERE (filename LIKE '" . $firstpart . "\\_%" . $file_extension . "' AND parent='$backup_parent') OR (filename = '$filename' AND parent = '$parent') ORDER BY major_revision desc, minor_revision desc");
} 
else
{
   // name based query -- assuming that the given name for the file doesn't change...
   // at some point, we should really look into creating a "revision_id" field so that all revisions can be linked.
   // in the meanwhile, the code for changing the Title of the file has been altered to go back and
   $name = flid_to_name($id);
   $sQuery = "select * from $default->owl_files_table where name='$name' AND parent='$parent' order by major_revision desc, minor_revision desc";

   //print("DEBUG: $sQuery");

   $sql->query($sQuery);
} 

$CountLines = 0;
while ($sql->next_record())
{
   $choped = explode("\.", $sql->f("filename"));
   $filename = $sql->f("filename");
   $major_revision = $sql->f("major_revision");
   $minor_revision = $sql->f("minor_revision");
   $ext = $file_extension;
   //$choped = explode("\.", $filename);
   //$pos = count($choped);
   //$ext = strtolower($choped[$pos-1]);

   if (($filename == $firstpart.".".$file_extension) or
       ($filename == $firstpart."_".$major_revision."-".$minor_revision.".".$file_extension)) 
   {

      if ($default->owl_use_fs )
      {
         $sFilePattern =  preg_quote($firstpart) .  "\_[0-9]*\-[0-9]*$haveextension" . preg_quote($file_extension);
   
         if(!preg_match("/$sFilePattern/", $sql->f("filename")) and  $id != $sql->f("id"))
         {
            continue;
         }
      }
   
      $CountLines++;
      $PrintLines = $CountLines % 2;
   
      if ($PrintLines == 0)
      {
         $sTrClass = "file1";
         $sLfList = "lfile1";
      }
      else
      {
         $sTrClass = "file2";
         $sLfList = "lfile1";
      }
 

      $xtpl->assign('FILE_TD_CLASS', $sTrClass);
      $xtpl->assign('FILE_VERSION', $sql->f("major_revision") . "." . $sql->f("minor_revision"));
      $xtpl->assign('FILE_CREATOR', uid_to_name($sql->f("creatorid")));

  
      if (!empty ($default->edit_text_files_inline))
      {
         $edit_inline =$default->edit_text_files_inline;
         $ext = fFindFileExtension(flid_to_filename($sql->f("id")));
         if ($ext != "" && preg_grep("/\b$ext\b/", $edit_inline))
         {
            $xtpl->assign('FILE_ID', $sql->f("id"));
            $xtpl->parse('main.ViewFileLog.FileVersions.DiffFromToRadio');
         }
      }
   
   
      if ($sql->f("parent") == $parent)
      {
          $is_backup_folder = false;
      }
      else
      {
          $is_backup_folder = true;
      }
      
      fPrintFileIconsXtpl($sql->f("id"), $sql->f("filename"), $sql->f("checked_out"), $sql->f("url"), $default->owl_version_control, $ext, $sql->f("parent"), $is_backup_folder);
   
    
   $xtpl->assign('FILE_NAME_VERSION', $sql->f("filename"));
    if (!$default->allow_html_in_popup_description)
    {  
      $xtpl->assign('FILE_DESCRIPTION', fCleanDomTTContent($sql->f("description"), 0));
    }
    else
    {
      $xtpl->assign('FILE_DESCRIPTION', fCleanDomTTContent($sql->f("description"), 1));
    }
      if ( $default->document_peer_review == 1)
      {
         switch ($sql->f("approved"))
         {
            case "0":
               $xtpl->assign('PEER_STATUS_TEXT', $owl_lang->peer_satus_pending);
               $xtpl->assign('STATUS_CLASS', 'cpending');
               break;
            case 1:
               $xtpl->assign('PEER_STATUS_TEXT', $owl_lang->peer_satus_approved);
               $xtpl->assign('STATUS_CLASS', 'capproved');
               break;
            default:
               $xtpl->assign('PEER_STATUS_TEXT', $owl_lang->peer_satus_rejected);
               $xtpl->assign('STATUS_CLASS', 'crejected');
               break;
         }
         $xtpl->parse('main.ViewFileLog.FileVersions.FilePeerStatus');
      }
   
      $xtpl->assign('FILE_DATE_MODIFIED', date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset));
      $xtpl->assign('FILE_UPDATOR', uid_to_name($sql->f("updatorid")));
      $xtpl->parse('main.ViewFileLog.FileVersions');
   }
}  
if (!empty ($default->edit_text_files_inline))
{
   $edit_inline =$default->edit_text_files_inline;
   $ext = fFindFileExtension(flid_to_filename($id));
   if ($ext != "" && preg_grep("/\b$ext\b/", $edit_inline))
   {
      $xtpl->assign('BTN_SHOW_DIFF', $owl_lang->btn_diff);
      $xtpl->assign('BTN_SHOW_DIFF_ALT', $owl_lang->btn_diff_alt);
      $xtpl->parse('main.ViewFileLog.DiffFromToButtons');
   }
}

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('FILELINK_LABEL', $owl_lang->owl_file_link);
$xtpl->parse('main.FileLink');
$xtpl->parse('main.Footer');
$xtpl->parse('main.ViewFileLog');
$xtpl->parse('main');
$xtpl->out('main');
?>
