<?php

/**
 * download.php
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
 * $Id: download.php,v 1.7 2006/09/04 14:04:35 b0zz Exp $
 */

ob_start();
require_once(dirname(__FILE__)."/config/owl.php");
$out = ob_get_clean();
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");

if (isset($dlfileid) and is_numeric($dlfileid))
{
   $id = $dlfileid;
}

if ($sess == "0" and $default->anon_ro == 1 and empty($dlfileid))
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&dlfileid=$dlfileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
   //printError($owl_lang->err_login);
}

if (empty($parent) || !is_numeric($parent))
{
    printError($owl_lang->err_general);
}


if (empty($curview) || !is_numeric($curview))
{
   $curview = 0;
}

if (!isset($action))
{
   $action = '';
}

if ($action == "bulk_download")
{
   if ($default->use_zip_for_folder_download)
   {
      $filename = fid_to_name($parent) . ".zip";
   }
   else
   {
      $filename = fid_to_name(1) . ".tar.gz";
   }
   $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
   $mimeType = fGetMimeType($filename);
   $fspath = $tmpDir . DIR_SEP . $filename;
   $fsize = filesize($fspath);


   if (bIsMicrosoftBrowser() == true)
   {
      $filename = rawurlencode($filename);
   }

   header("Content-Disposition: attachment; filename=\"$filename\"");
   header("Content-Location: $filename");
   header("Content-Type: $mimeType");
   header("Content-Length: $fsize");
   header("Expires: 0");

      if (substr(php_uname(), 0, 7) != "Windows")
      {
         $fp = fopen("$fspath", "r");
      }
      else
      {
         $fp = fopen("$fspath", "rb");
      }
      fpassthru($fp);
   
  myDelete($tmpDir);
  exit;
}

$oldid = $id;
$id = fGetPhysicalFileId($id);

$CheckPass = new Owl_DB;
$CheckPass->query("SELECT password FROM " . $default->owl_files_table . " WHERE id='$id'");
$CheckPass->next_record();
$password = $CheckPass->f("password");

$id = $oldid;

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


function zip_folder($id, $userid)
{
   global $default, $sess, $owl_lang;

   $tmpdir = $default->owl_tmpdir . "/owltmpfld_$sess.$id";
   if (file_exists($tmpdir)) myDelete($tmpdir);

   mkdir("$tmpdir", $default->directory_mask);
   $sql = new Owl_DB;
   $sql2 = new Owl_DB;

   $sql->query("SELECT name, id FROM $default->owl_folders_table WHERE id = '$id'");
   while ($sql->next_record())
   {
      $top = $sql->f("name");
   } 
   $path = "$tmpdir/$top";
   if (!file_exists($path))
   {
      mkdir($path, $default->directory_mask);
   }

   folder_loop($sql, $sql2, $id, $path, $userid); 

   if ($default->use_zip_for_folder_download)
   {
      $filename = $tmpdir . DIR_SEP . $top . ".zip";
      $sDirName = $tmpdir . DIR_SEP . $top;

      $aFileList = array();
      $aFileList = fGetFilesFromDirStruct($sDirName);

      $archive = new PclZip($filename);
      $v_list = $archive->create($aFileList, PCLZIP_OPT_REMOVE_PATH, $tmpdir);
      if ($v_list == 0) 
      {
         if ($default->debug == true)
         {
            printError("DEBUG : ".$archive->errorInfo(true));
         }
         else
         {
            printError("ERROR creating zip File");
         }
      }

      if (bIsMicrosoftBrowser() == true)
      {
         $top = rawurlencode($top);  
      }  
     
      $fsize = filesize($filename);

      header("Content-Disposition: attachment; filename=\"$top.zip\"");
      header("Content-Location: $filename");
      header("Content-Type: application/zip");
      header("Content-Length: $fsize");
      header("Expires: 0");

      if (substr(php_uname(), 0, 7) != "Windows")
      {
         $fp = fopen("$filename", "r");
      }
      else
      {
         $fp = fopen("$filename", "rb");
      }
      fpassthru($fp);
   }
   else
   {
      // get all files in folder
      // GETTING IE TO WORK IS A PAIN!
      if (file_exists($default->tar_path))
      {
         if (file_exists($default->gzip_path))
         {
            if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE"))
               header("Content-Type: application/x-gzip");
            else
               header("Content-Type: application/octet-stream");

            if (substr(php_uname(), 0, 7) != "Windows")
            {
               header("Content-Disposition: attachment; filename=\"$top.tgz\"");
               header("Content-Location: \"$top.tgz\"");
               header("Expires: 0");
               passthru(escapeshellarg($default->tar_path) . " cf - -C " . escapeshellarg($tmpdir) . " " . escapeshellarg($top) . "| " . $default->gzip_path . " -c -9");
            } 
            else
            {
               header("Content-Location: \"$top.tar.gz\"");
               header("Content-Disposition: attachment; filename=\"$top.tar.gz\"");
               header("Expires: 0");
               system(escapeshellarg($default->tar_path) . " cf " . '"' . $tmpdir . DIR_SEP . $top . '.tar"' . " -C " . '"' . $tmpdir . '" "' . $top . '"');
               passthru(escapeshellarg($default->gzip_path) . ' -c -9 "' . $tmpdir . "\\" . $top . '.tar"');
            } 
         } 
         else
         {
            if (substr(php_uname(), 0, 7) != "Windows")
            {
               if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE"))
               {
                  header("Content-Type: application/x-gzip");
               }
               else
               {
                  header("Content-Type: application/octet-stream");
               }
               header("Content-Disposition: attachment; filename=\"$top.tar\"");
               header("Content-Location: \"$top.tgz\"");
               header("Expires: 0");
               passthru(escapeshellarg($default->tar_path) . " cf - -C " . escapeshellarg($tmpdir) . " " . escapeshellarg($top));
            } 
            else
            {
               printError("$owl_lang->err_gzip_not_found $default->gzip_path");
            } 
         } 
      } 
      else
      {
         myDelete($tmpdir);
         printError("$owl_lang->err_tar_not_found $default->tar_path");
      } 
   }
   myDelete($tmpdir);
} 
   
function folder_loop($sql, $sql2, $id, $tmpdir, $userid)
{
   global $default, $parent;
   $bSkipFirstCheck = false;
   if ($parent == $id)
   {
      $bSkipFirstCheck = true;
   }
   

   if (check_auth($id, "folder_view", $userid) == 1 or $bSkipFirstCheck)
   {
      $bSkipFirstCheck = false;
      $sql = new Owl_DB; 
      // write out all the files
      $sql->query("SELECT * FROM $default->owl_files_table WHERE parent = '$id' and url <> '1'");
      while ($sql->next_record())
      {
         $fid = $sql->f("id");
         $fid = fGetPhysicalFileId($fid);
         if ($sql->f("id") != $fid)
         {
            $iFileParent = owlfileparent($fid);
         }
         else
         {
            $iFileParent = $id;
         }
         
         $filename = $tmpdir . DIR_SEP . $sql->f("filename");
         if (check_auth($fid, "file_download", $userid) == 1)
         {
            if ($default->owl_use_fs)
            {
               $source = $default->owl_FileDir . DIR_SEP . get_dirpath($iFileParent) . DIR_SEP . $sql->f("filename");
               copy($source, $filename);
            } 
            else
            {
               $path = fGetFileFromDatbase($fid);
               $sData = file_get_contents($path);

               $fp = fopen($filename, "w");
               fwrite($fp, $sData);
               fclose($fp);
            } 
         } // end if
      } // end while 
      // recurse into directories
      if ($default->hide_backup == 1 and !fIsAdmin())
      {
         $sql->query("SELECT name, id FROM $default->owl_folders_table WHERE parent = '$id' and name <> '$default->version_control_backup_dir_name'");
      }
      else
      {
         $sql->query("SELECT name, id FROM $default->owl_folders_table WHERE parent = '$id'");
      }
      while ($sql->next_record())
      {
         $saved = $tmpdir;
         $tmpdir .= DIR_SEP . $sql->f("name");
         mkdir("$tmpdir", $default->directory_mask);
         folder_loop($sql, $sql2, $sql->f("id"), $tmpdir, $userid);
         $tmpdir = $saved;
      } 
   } 
} 

if ($action == "folder")
{
   $abort_status = ignore_user_abort(true);
   $iRealID =  fGetPhysicalFolderId ( $id );
   zip_folder($iRealID, $userid);
   ignore_user_abort($abort_status);
   exit;
} 


if ((check_auth($id, "file_download", $userid) == 1) or $bDownloadAllowed or fCheckIfReviewer($id) )
{
   if ($default->auto_checkout_checking == 1  and $default->document_peer_review == 1 )
   {
       $sql->query("UPDATE $default->owl_files_table set checked_out='$userid' WHERE id='$id'");
       owl_syslog(FILE_LOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE");
   }

   $id = fGetPhysicalFileId($id);
   $sql = new Owl_DB;
   $filename = flid_to_filename($id);
   $download_name = $filename;

   if ($default->append_doc_version_to_downloaded_files == 1)
   {
      $aFirstpExtension = fFindFileFirstpartExtension ($filename);
      $firstpart = $aFirstpExtension[0];
      $file_extension = $aFirstpExtension[1];

      $sql->query("SELECT major_revision, minor_revision  FROM " . $default->owl_files_table . " WHERE id='$id'");
      $sql->next_record();
      $sAppendVersion =  "-" . $sql->f("major_revision") . "." . $sql->f("minor_revision");
      $download_name = $firstpart . $sAppendVersion . "." . $file_extension;
   }

   if (bIsMicrosoftBrowser() == true)
   {
      $download_name = rawurlencode($download_name);
   }
   
   $mimeType = fGetMimeType($filename);
   // BEGIN wes change

   if ($default->owl_use_fs)
   {
      $path = find_path(owlfileparent($id)) . DIR_SEP . $filename;
      $fspath = $default->owl_FileDir . DIR_SEP . $path;
      if (!file_exists($fspath))
      {
         if ($default->debug == true)
         {
            printError("$owl_lang->err_file_not_exist", $fspath);
         }
         else
         { 
            printError("$owl_lang->err_file_not_exist");
         }
      } 
      $fsize = filesize($fspath);
   } 
   else
   {
      $sql->query("SELECT f_size FROM " . $default->owl_files_table . " WHERE id='$id'");
      while ($sql->next_record()) $fsize = $sql->f("f_size");
   } 

   $path = fCreateWaterMark($id);
   if (! $path == false)
   {
      $fspath = $path;
      $fsize = filesize($path);
   }

// **********************************
// Hahn Download Count + MB Count
// **********************************

$sql->query("SELECT * FROM $default->owl_sessions_table WHERE sessid = '$sess'");
$sql->next_record();


if ($type == 'video')
{
   $iDlSize = 0;
}
else
{
   $iDlSize = $fsize;
}

$iNewCount = $sql->f('dl_count') + 1;
$iNewSize = $sql->f('dl_byte_count') + $iDlSize;

$sql->query("UPDATE $default->owl_sessions_table set dl_count='$iNewCount', dl_byte_count='$iNewSize' WHERE sessid = '$sess'");

if (($iNewCount >= $default->download_count_trigger  or
     $iNewSize  >= $default->download_size_trigger)   and
     $default->use_download_count == 1)
{
      $mail = new phpmailer();
      $mail->SetLanguage($owl_lang->lang_code, "scripts/phpmailer/language/");

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

      //$mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset 
      $mail->CharSet = "UTF-8"; // set the email charset to the language file charset 
      $mail->Host = "$default->owl_email_server"; // specify main and backup server
      $mail->From = "$default->owl_email_from";
      $mail->FromName = "$default->owl_email_fromname";
      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $mail->Subject = $default->owl_email_subject . " Download Threshold Notification";

      foreach($default->download_notify_list as $sEmail)
      {
         $mail->AddAddress($sEmail);
      }

      $mail->Body = "USER:  " . uid_to_uname($userid) . " (id: $userid) has reached Download thresholds for one session<br />";
      $mail->Body .= "<br />Download Count:  $iNewCount / $default->download_count_trigger";
      $mail->Body .= "<br />Download Size:   " . gen_filesize($iNewSize) . " / " . gen_filesize($default->download_size_trigger);
      $mail->Body .= "<br />Sess ID:   " . $sess;

      $mail->altBody = "USER:  " . uid_to_uname($userid) . " (id: $userid) has reached Download thresholds for one session\n";
      $mail->altBody .= "\nDownload Count:  $iNewCount / $default->download_count_trigger";      $mail->altBody .= "\nDownload Size:   " . gen_filesize($iNewSize) . "  / " . gen_filesize($default->download_size_trigger);
      $mail->altBody .= "\nSess ID:   " . $sess;

      if (!$mail->Send())
      {
         printError($owl_lang->err_email, $mail->ErrorInfo);
      }
}


// AEARO PDF WATERMARK END

   // END wes change
   // BEGIN BUG: 495556 File download sends incorrect headers
   // header("Content-Disposition: filename=\"$filename\"");
   header("Content-Disposition: attachment; filename=\"$download_name\"");
   header("Content-Location: $download_name");
   header("Content-Type: $mimeType");
   header("Content-Length: $fsize");
   header("Expires: 0"); 
   // END BUG: 495556 File download sends incorrect headers
   // BEGIN wes change
   if ($default->owl_use_fs)
   {
      if (substr(php_uname(), 0, 7) != "Windows")
      {
         $fp = fopen("$fspath", "r");
      }
      else
      {
         $fp = fopen("$fspath", "rb");
      }

      fpassthru($fp); 
      // print fread($fp,filesize("$fspath"));
      fclose($fp);
   } 
   else
   {
      $path = fGetFileFromDatbase($id);
      //$sql->query("SELECT data,compressed FROM " . $default->owl_files_data_table . " WHERE id='$id'");
      //while ($sql->next_record())
      //{
         //if ($sql->f("compressed"))
         //{
            //$tmpfile = $default->owl_tmpdir . DIR_SEP . "owltmp.$id";
            //if (file_exists($tmpfile)) unlink($tmpfile);
//
            //$fp = fopen($tmpfile, "w");
            //fwrite($fp, $sql->f("data"));
            //fclose($fp);
            //flush(passthru(escapeshellarg($default->gzip_path) . " -dfc $tmpfile"));
            //flush(passthru(escapeshellcmd($default->gzip_path) . " -dfc $path"));
            //unlink($tmpfile);
         //} 
         //else
         //{
            print file_get_contents($path);
            flush();
         //} 
      //} 
   } 
   // END wes change
   
   owl_syslog(FILE_DOWNLOADED, $userid, flid_to_filename($id), $parent, "", "FILE");

   if (isset($dlfileid) and is_numeric($dlfileid))
   {
      $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess'");
   }
} 
else
{
   
   $sql->query("SELECT password FROM " . $default->owl_files_table . " WHERE id='$id'");
   $sql->next_record();

   $password = $sql->f("password");

   if (empty($password) or (!empty($password) and $bPasswordFailed))
   {
      printError($owl_lang->err_nofileaccess);
   } 
   else
   {
      //$xtpl = new XTemplate("templates/$default->sButtonStyle/html/download.xtpl");
     // fSetPopupHelp();
      $xtpl = new XTemplate("html/download.xtpl", "templates/$default->sButtonStyle");
      $xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
      $xtpl->assign('ROOT_URL', $default->owl_root_url);

      fSetLogo_MOTD();
      fSetPopupHelp();

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
      $xtpl->assign('FORM', '<form action="download.php" method="post">');
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
} 
// MAKE SURE THERE IS NOT BLANK LINE THE END OF THE FILE
// CUZ IT MESSES UP THE DOWNLOAD
?>
