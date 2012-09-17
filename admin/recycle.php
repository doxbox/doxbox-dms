<?php

/**
 * recycle.php
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


require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");

require_once($default->owl_fs_root . "/lib/readhd.php");


if (!fIsAdmin(true))
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
   exit;
}

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/recycle.xtpl");
$xtpl = new XTemplate("html/admin/recycle.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

$clean = ob_get_contents();
ob_end_clean();

if (isset($bemptyaction_x))
{
   $action = $owl_lang->empty_trash;
} 
elseif (isset($bdeleteaction_x))
{
   $action = $owl_lang->del_selected;
}
elseif (isset($bemailaction_x))
{
   $action = "email_selected";
}
elseif (isset($brestoreaction_x))
{
   $action = $owl_lang->rest_selected;
}
else
{
   $action = 'recycle';
}

$urlArgs = array();

if (isset($folder))
{
   $folder = stripslashes($folder);
}
else
{
   $folder  ='';
}

$sql = new Owl_DB; //create new db connection
$sql->query("SELECT name from $default->owl_folders_table where id = '1'");
$sql->next_record();
$sRootFolderName = $sql->f("name");
// 
// Email all Selected Files
// 
if ($action == "email_selected")
{
   if(!empty($batch))
   {
      $mail = new phpmailer();
      if ($default->use_smtp)
      {
         $mail->IsSMTP(); // set mailer to use SMTP
         if ($default->use_smtp_auth)
         {
            $mail->SMTPAuth = "true"; // turn on SMTP authentication
            $mail->Username = "$default->smtp_auth_login"; // SMTP username
            $mail->Password = "$default->smtp_passwd"; // SMTP password
         }
      }
      if (isset($default->smtp_port))
      {
         $mail->Port = $default->smtp_port;
      }

      if ($default->use_smtp_ssl)
      {
         $mail->SMTPSecure = "ssl";
      }
      $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset
      $mail->Host = "$default->owl_email_server"; // specify main and backup server
      $mail->From = "$default->owl_email_from";
      $mail->FromName = "$default->owl_email_fromname";
      $mail->AddAddress("$mailto");
      $mail->AddReplyTo("$default->owl_email_replyto", "OWL Intranet");
      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $mail->Subject = $owl_lang->trash_email_subject;
      $mail->Body = "<html><body>";
      $mail->Body .= $owl_lang->trash_email_body;
      
      $sLogFilesRestored = "<br />";
      foreach($batch as $sEmailThis)
      {
         $sFilePath = $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sEmailThis;
         $mimeType = fGetMimeType($sEmailThis);
         $sLogFilesRestored .= $sFilePath ."<br />";
         $mail->AddAttachment("$sFilePath", "" , "base64" , "$mimeType");
      } 
   
      $mail->Body .= "</body></html>";

      if (!$mail->Send())
      {
         printError("$owl_lang->err_email", $mail->ErrorInfo);
      }
      owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_email_restore . $sLogFilesRestored, "ADMIN");
   }
   header("Location: recycle.php?sess=$sess&folder=$folder");
   exit;
} 

// 
// Delete all Selected Files
// 
if ($action == "$owl_lang->del_selected")
{
   if (!empty($fbatch) and is_array($fbatch))
   {
      foreach($fbatch as $sDeleteThis)
      {
         myDelete($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sDeleteThis);
         owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_trash_delfile . $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sDeleteThis, "ADMIN");
      } 
   }
   if (!empty($batch) and is_array($batch))
   {
      foreach($batch as $sDeleteThis)
      {
         myDelete($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sDeleteThis);
         owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_trash_delfile . $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sDeleteThis, "ADMIN");
      } 
   }
   header("Location: recycle.php?sess=$sess&folder=$folder");
   exit;
} 
//
// Restore all Selected Files
//
function restoreFile($file,$path,$folderid)
{
   global $owl_lang, $default, $parent;

   $file = stripslashes($file);
   $fileparts = explode(DIR_SEP,$file);
   $srcfile = $fileparts[count($fileparts)-1];

   $destfile = $default->restore_file_prefix . $srcfile;

   if(file_exists("$default->owl_FileDir/$path/$destfile"))
   {
      $i = 2;
      while(file_exists("$default->owl_FileDir/$path/$default->restore_file_prefix$i-file"))
      {
         $i++;
      }
      $destfile = "$default->restore_file_prefix$i-file";
   }

   if (substr(php_uname(), 0, 7) != "Windows")
   {
      $cmd = "mv " . '"' . "$default->trash_can_location/$default->owl_current_db/$file" . '" "' . "$default->owl_FileDir/$path/$destfile" . '"';
      $lines = array();
      $errco = 0;
      $result = myExec($cmd, $lines, $errco);
      if ($errco != 0)
      {
         printError($owl_lang->err_general, $result);
      }
   }
   else
   {
      copy($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $file, $default->owl_FileDir . DIR_SEP . $path . DIR_SEP . $destfile);
      unlink($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $file);
   }

//   function InsertHDFilezInDB($TheFile, $parent, $ThePath, $DBTable);
   chdir("..");
   InsertHDFilezInDB($destfile,$folderid,"$default->owl_FileDir" . DIR_SEP . "$path","trash");
   owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_trash_restore . $default->owl_FileDir. DIR_SEP .$path, "ADMIN");
}

if ($action == "$owl_lang->rest_selected" && isset($batch))
{
   $path = find_path(intval($folder_id));
   foreach($batch as $filename)
   {
      restoreFile($filename,$path,$folder_id);
   }
   header("Location: recycle.php?sess=$sess&folder=$folder");
}
// 
// Delete Folder
// 
if ($action == "del_folder")
{
   myDelete($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $folder);
   owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_trash_delfold . $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $folder, "ADMIN");
   $aFirstpExtension = fFindFileFirstpartExtension ($folder, DIR_SEP);
   $firstpart = $aFirstpExtension[0];

   header("Location: recycle.php?sess=$sess&folder=$firstpart");
} 
// 
// Empty Trash Can
// 
if ($action == $owl_lang->empty_trash)
{
   myDelete($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRootFolderName);
   owl_syslog(TRASH_CAN, $userid, 0, 0, $owl_lang->log_admin_trash_empty , "ADMIN");
   header("Location: index.php?sess=$sess");
} 

include($default->owl_fs_root . "/lib/header.inc");
include($default->owl_fs_root . "/lib/userheader.inc");

if (!isset($folder) || $folder == "")
{
   $sRecyclePath = $sRootFolderName;
} 
else
{
   $sRecyclePath = $folder;
} 

if (!file_exists($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath))
{
   printError($owl_lang->err_trash_can_empty);
}


if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}

if (fIsAdmin(true))
{
   fPrintAdminPanelXTPL('trashcan');
}

$xtpl->assign('FORM', "<form id=\"FileList\" name=\"FileList\" enctype=\"multipart/form-data\" action=\"" . $_SERVER["PHP_SELF"] ."\" method=\"post\">");
$urlArgs['sess']      = $sess;
$urlArgs['folder']      = $folder;
$urlArgs['action']      = 'delete';
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));

$xtpl->assign('RECYCE_ADMIN_TITLE', $owl_lang->recycle_bin_admin);
// Show the Directories in the
// Recycle Bin
// 
$iCountLines = 0;

if ($Dir = opendir($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath))
{
   $xtpl->assign('RECYCE_TRASH_LOCATION', $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath );
   $xtpl->assign('RECYCE_TRASH_PREV_FOLDER_URL', "#");
   $xtpl->assign('RECYCE_TRASH_PREV_FOLDER_LABEL', "&nbsp;");
   if (!($sRecyclePath == $sRootFolderName))
   { 
      $aFirstpExtension = fFindFileFirstpartExtension ($sRecyclePath, DIR_SEP);
      $firstpart = $aFirstpExtension[0];
      $xtpl->assign('RECYCE_TRASH_PREV_FOLDER_URL', "recycle.php?folder=" . urlencode($firstpart) . "&amp;sess=" . $sess);
      $xtpl->assign('RECYCE_TRASH_PREV_FOLDER_LABEL', "..");
   }

   while ($file = readdir($Dir))
   {
      if ($file[0] == '.')
      {
         continue;
      } 
      if (!is_file($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath . DIR_SEP . $file))
      {
         $iCountLines++;
         $iPrintLines = $iCountLines % 2;
         if ($iPrintLines == 0)
         {
            $sTrClass = "file1";
            $sLfList = "lfile1";
         }
         else
         {
            $sTrClass = "file2";
            $sLfList = "lfile1";
         }
         $xtpl->assign('RECYCLE_TD_STYLE', $sTrClass);
         $xtpl->assign('RECYCLE_A_STYLE', $sLfList);

         $xtpl->assign('RECYCLE_FOLDER_CHXBX_VALUE', $sRecyclePath . DIR_SEP . $file);
       
         $xtpl->assign('RECYCLE_FOLDER_DEL_URL', "recycle.php?folder=" . urlencode($sRecyclePath) . DIR_SEP . urlencode($file) . "&amp;sess=" . $sess . "&amp;action=del_folder");
         $xtpl->assign('RECYCLE_FOLDER_DEL_ALT', "$owl_lang->alt_del_this_folder $file");
         $xtpl->assign('RECYCLE_FOLDER_DEL_CONF', $owl_lang->reallydelete);

         $xtpl->assign('RECYCLE_FOLDER_URL', "recycle.php?folder=" . urlencode($sRecyclePath) . DIR_SEP . urlencode($file) . "&amp;sess=" . $sess);
         $xtpl->assign('RECYCLE_FOLDER_LABEL', $file);

         $xtpl->parse('main.Recycle.Folders');
      } 
   } 
} 
else
{
   printError($owl_lang->err_general);
} 
// 
// Show the Files in the
// Recycle Bin
// 
if ($Dir = opendir($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath))
{
   while ($file = readdir($Dir))
   {
      if ($file[0] == '.')
         continue;

      if (is_file($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRecyclePath . DIR_SEP . $file))
      {
         $iCountLines++;
         $iPrintLines = $iCountLines % 2;
         if ($iPrintLines == 0)
         {
            $sTrClass = "file1";
            $sLfList = "lfile1";
         }
         else
         {
            $sTrClass = "file2";
            $sLfList = "lfile1";
         }
         $xtpl->assign('RECYCLE_TD_STYLE', $sTrClass);
         $xtpl->assign('RECYCLE_A_STYLE', $sLfList);

         $xtpl->assign('RECYCLE_FILE_CHXBX_VALUE', $sRecyclePath . DIR_SEP . $file);

      $choped = split("\.", $file);
      $pos = count($choped);
      if ( $pos > 1 )
      {
         $ext = strtolower($choped[$pos-1]);
         $sDispIcon = $ext;
      }
      else
      {
         $sDispIcon = "NoExtension";
      }
                                                                                                                                                                                                  
      if (($ext == "gz") && ($pos > 2))
      {
         $exttar = strtolower($choped[$pos-2]);
         if (strtolower($choped[$pos-2]) == "tar")
            $ext = "tar.gz";
      }
                                                                                                                                                                                                  
         if (!file_exists("$default->owl_fs_root/graphics/$default->sButtonStyle/img/icon_filetype/$sDispIcon.gif"))
         {
            $sDispIcon = "file";
         }
         
         $xtpl->assign('RECYCLE_FILE_TYPE', $sDispIcon);
         $xtpl->assign('RECYCLE_FILE_NAME', $file);
         $xtpl->parse('main.Recycle.Files');
      } 
   } 
} 
else
{
   printError($owl_lang->err_general);
} 

$xtpl->assign('RECYCLE_TG_ALT', $owl_lang->alt_toggle_check_box);
         
$xtpl->assign('RECYCLE_EMAILTO_LABEL', $owl_lang->email_to);
$xtpl->assign('RECYCLE_EMAILTO_BTN_LABEL', $owl_lang->email_selected);
$xtpl->assign('RECYCLE_EMAILTO_BTN_ALT', $owl_lang->alt_email_selected);

$xtpl->assign('RECYCLE_DEL_BTN_LABEL', $owl_lang->del_selected);
$xtpl->assign('RECYCLE_DEL_BTN_ALT', $owl_lang->alt_del_selected);
$xtpl->assign('RECYCLE_DEL_BTN_CONF', $owl_lang->reallydelete_selected);

$xtpl->assign('RECYCLE_EMPTY_BTN_LABEL', $owl_lang->del_all);
$xtpl->assign('RECYCLE_EMPTY_BTN_ALT', $owl_lang->alt_del_all);

$xtpl->assign('RECYCLE_RESTORE_BTN_LABEL', $owl_lang->rest_selected);
$xtpl->assign('RECYCLE_RESTORE_BTN_ALT', $owl_lang->alt_rest_selected);
$xtpl->assign('RECYCLE_RESTORE_BTN_CONF', $owl_lang->reallyrestore_selected);

exploreFolders();

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.Recycle');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');


function exploreFolders($parent = 0, $level = 0)
{
   global $default, $xtpl;
   $s = new Owl_DB;
   $s->query("SELECT id, name FROM $default->owl_folders_table WHERE parent = '".$parent."'");
   while($s->next_record())
   {
      $xtpl->assign('RECYCLE_DEST_VALUE', $s->f('id'));
      
      $sSpacer = '';
      for($i=0; $i<$level*3+1; $i++)
      {
         $sSpacer .= '&nbsp;';
      }
      $xtpl->assign('RECYCLE_DEST_SPACER', $sSpacer);
      $xtpl->assign('RECYCLE_DEST_CAPTION', $s->f('name'));

      $xtpl->parse('main.Recycle.RestLocation');

      exploreFolders($s->f('id'), $level+1);
   }
}

?>
<script language="JavaScript" type="text/javascript">
<!-- 
function CheckAll() {
  for (var i = 0; i < document.FileList.elements.length; i++) {
    if(document.FileList.elements[i].type == "checkbox"){
      document.FileList.elements[i].checked =         !(document.FileList.elements[i].checked);
    }
  }
}
//-->
</script>
