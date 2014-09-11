<?php

/**
 * move.php
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
 * $Id: move.php,v 1.9 2006/08/16 23:50:55 b0zz Exp $
 */

global $order, $sortorder, $sortname;

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

$xtpl = new XTemplate("html/move.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

if ($sess == "0" && $default->anon_ro > 1)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
   //printError($owl_lang->err_login);
}
if (isset($myaction_x))
{
   displayBrowsePage($parent);
   exit();
} 

fSetLogo_MOTD();
fSetPopupHelp();

if ($action == "file" or $action == "cp_file" or $action == "lnk_file")
{
   if (($action == "cp_file" and check_auth($id, "file_cp", $userid) == 0) or (($action == "file" or $action == "lnk_file") and check_auth($id, "file_move", $userid) == 0))
   {
      include($default->owl_fs_root ."/lib/header.inc");
      include($default->owl_fs_root ."/lib/userheader.inc");
      printError($owl_lang->err_nofilemod);
   } 
} elseif ($action == "bulk_move")
{
   if (isset($id))
   {
      $disp = unserialize(stripslashes(stripslashes(stripslashes(stripslashes(stripslashes(str_replace("%22", "\"",$id)))))));
   }
   
   if (isset($folders))
   {
      $fdisp = unserialize(stripslashes(stripslashes(stripslashes(stripslashes(stripslashes(str_replace("%22", "\"",$folders)))))));
   }
} 
elseif ($action == "cp_folder")
{
   if (check_auth($id, "folder_cp", $userid) == 0)
   {
      include($default->owl_fs_root ."/lib/header.inc");
      include($default->owl_fs_root ."/lib/userheader.inc");
      printError($owl_lang->err_nofilemod);
   } 
} 
else
{
   if (($action == "folder" or $action == "lnk_folder") and check_auth($id, "folder_move", $userid) == 0)
   {
      include($default->owl_fs_root ."/lib/header.inc");
      include($default->owl_fs_root ."/lib/userheader.inc");
      printError($owl_lang->err_nofilemod);
   } 
} 

function checkForNewFolder()
{
   global $_POST, $newFolder, $moreFolder;
   if (!is_array($_POST)) return;
   while (list($key, $value) = each ($_POST))
   {
      if (substr($key, 0, 2) == "ID")
      {
         $key = str_replace("_x", "", $key);
         $newFolder = intval(substr($key, 2));
         break;
      } 
      if (substr($key, 0, 2) == "MO")
      {
         $key = str_replace("_x", "", $key);
         $moreFolder = intval(substr($key, 2));
         break;
      } 
   } 
} 

function showFoldersIn($fid, $folder)
{
   global $folderList, $fCount, $fDepth, $excludeID, $action, $id, $default, $userid, $moreFolder, $folders ; 
   global $xtpl;

   $sql = new Owl_DB;
   

   // If restricted view is in effect only show the folders you do have access to
   $showfolder = 1;
   if ($default->restrict_view == 1)
     if (check_auth($fid, "folder_create", $userid) != 0 && $fid != 0)
      {
         $showfolder = 1;
      }
      else
      {
         if (check_auth($fid, "folder_view", $userid) == 1 && $fid != 0)
         {
            $showfolder = 1;
         }
         else
         {
            $showfolder = 0;
         }
      }

      if ($showfolder == 1)
      {
         for ($c = 0 ;$c < ($fDepth-1) ; $c++) 
         {
            print "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/blank.gif\" alt=\"\" height=\"16\" width=\"16\" align=\"top\" />";
         }
         if ($fDepth) 
         {
            $sql->query("select name,parent from $default->owl_folders_table where parent='$fid'");
			$xtpl->assign('MORE_NAME', '');
            if ($sql->num_rows() > 0)
            {
               //print "<input type=\"image\" src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/more.gif\" align=\"top\" name=\"MO" . $fid ."\"></input>";
			   $xtpl->assign('MORE_IMG', "<input type=\"image\" src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/more.gif\" align=\"top\" name=\"MO" . $fid ."\" />");
			   //$xtpl->assign('MORE_NAME', 'MO' . $fid);
			   //$xtpl->parse('main.MoveFolder.TreeImageMore');
            }
            else
            {
               //print "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/link.gif\" alt=\"\" align=\"top\" />";
			   $xtpl->assign('MORE_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/link.gif\" alt=\"\" align=\"top\" />");
			   //$xtpl->parse('main.MoveFolder.TreeImageMore');
            }
         }

         $gray = 0; //   Work out when to gray out folders ...
         if ($fid == $excludeID) $gray = 1; //   current parent for all moves
         if (($action == "folder" or $action == "cp_folder") && ($fid == $id)) $gray = 1; //   subtree for folder moves

         if (($action == "bulk_move")) 
         {
            $aFolders = array();
            $aFolders = unserialize(stripslashes(stripslashes(stripslashes(stripslashes(stripslashes(str_replace("%22", "\"",$folders)))))));

            if(!empty($aFolders))
            {
               foreach ($aFolders as $iFolder)
               {
                  if ( $fid == $iFolder)
                  {
                     $gray = 1;  // This is one of the folders we are moving
                     break;
                  }
                  $iParentFolder = owlfolderparent($fid);
                  if ($iParentFolder == $iFolder)
                  {
                     $gray = 1;  // This is one of the folders we are moving
                     break;
                  }
                  else
                  {
                     while($iParentFolder != 1)
                     {
                        $iParentFolder = owlfolderparent($iParentFolder);
                        if ($iParentFolder == $iFolder)
                        {
                           $gray = 1;  // This is one of the folders we are moving
                           break;
                        }
                     }
                  }
               }
            }
         }
         if (($moreFolder > 0) && ($fid == $id) and ($action == "folder" or $action == "cp_folder")) $gray = 1; //   subtree for folder moves
         //print("fid: $fid ID: $id G: $gray");
         if (check_auth($fid, "folder_create", $userid) == 0)
         {
            $gray = 1; //   check for permissions
         } 
         
         if ($gray)
         {
            //print "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_gray.gif\" align=\"top\" alt=\"\" />";
            //print " <font color=\"silver\">$folder</font><br />\n";
			//$xtpl->assign('IMG_NAME','folder_gray');
			$xtpl->assign('IMG_ID','');
			$xtpl->assign('IMG_NAME',"<img src=\"$default->owl_graphics_url/$default->sButtonStyle/img/icon_filetype/folder_gray.gif\" align=\"top\" alt=\"\" />");
			$xtpl->assign('FOLDER_NAME', "<font color=\"silver\">$folder</font>");
         } 
         else
         {
            //print "<input type=\"image\" src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_closed.gif\" align=\"top\" name=\"ID";
            //print "$fid\"></input> $folder<br />\n";
			//$xtpl->assign('IMG_NAME','folder_closed');
			$xtpl->assign('IMG_NAME',"<input type=\"image\" src=\"$default->owl_graphics_url/$default->sButtonStyle/img/icon_filetype/folder_closed.gif\" align=\"top\" name=\"ID$fid\" />");
			$xtpl->assign('IMG_ID',"name=\"ID$fid\"");
			$xtpl->assign('FOLDER_IDNAME', 'ID'. $fid);
			$xtpl->assign('FOLDER_NAME', $folder);
         } 
      } 
	  $xtpl->parse('main.MoveFolder.TreeImage');
      if (($action == "folder") && ($fid == $id)) return; //   Don't show subtree of selected folder as target for folder move
      for ($c = 0; $c < $fCount; $c++)
      {
         if ($folderList[$c][2] == $fid)
         {
            $fDepth++;
            if ($fDepth == 1) 
            {
               showFoldersIn($folderList[$c][0] , $folderList[$c][1]);
            }
            $fDepth--;
         } 
      } 
   } 



   checkForNewFolder();

   if (isset($newFolder))
   {
      $sql = new Owl_DB;

      $source = "";
      $fID = $parent;
      do
      {
         $sql->query("SELECT name,parent from $default->owl_folders_table where id='$fID'");
         while ($sql->next_record())
         {
            $tName = $sql->f("name");
            $fID = $sql->f("parent");
         } 
         $source = $tName . DIR_SEP . $source;
      } 
      while ($fID != 0);

      $dest = "";
      $fID = $newFolder;
      do
      {
         $sql->query("SELECT name,parent from $default->owl_folders_table where id='$fID'");
         while ($sql->next_record())
         {
            $tName = $sql->f("name");
            $fID = $sql->f("parent");
         } 
         $dest = $tName . DIR_SEP . $dest;
      } 
      while ($fID != 0);

      if ($action == "file" or $action == "cp_file")
      {
         $sql = new Owl_DB;
         $sql->query("SELECT filename, parent from $default->owl_files_table where id = '$id'");
         while ($sql->next_record())
         {
            $fname = $sql->f("filename");
            $parent = $sql->f("parent");
         } 
      } 
      elseif ($action == "folder" or $action == "cp_folder")
      {
         $sql = new Owl_DB;
         $sql->query("SELECT name, parent from $default->owl_folders_table where id='$id'");
         while ($sql->next_record())
         {
            $fname = $sql->f("name");
            $parent = $sql->f("parent");
         } 
      } 
      if ($action == "lnk_folder")
      {
         $sql->query("SELECT * from  $default->owl_folders_table where id='$id'");
         $sql->next_record();

         $result = $sql->query("INSERT into $default->owl_folders_table (name,parent,security,description,groupid,creatorid, password, smodified, linkedto) values ('" .  $sql->make_arg_safe($sql->f("name")) . "', '$newFolder', '" . $sql->f("security") . "', '" .  $sql->make_arg_safe($sql->f("description")) . "', '" . $sql->f("groupid") . "', '" . $sql->f("creatorid") . "', '" .  $sql->make_arg_safe($sql->f("password")) . "', '" .  $sql->f("smodified")  ."', '$id')");

         $newid = $sql->insert_id($default->owl_folders_table, 'id');

         fSetDefaultFileAcl($newid);
         fSetInheritedAcl($newFolder, $newid, "FILE");

         owl_syslog(FOLDER_LINKED, $userid, $sql->f("name"), $newFolder, fid_to_name($newFolder), "FILE");
         displayBrowsePage($parent);
      }

      if ($action == "lnk_file")
      {
         $sql->query("SELECT * from  $default->owl_files_table where id='$id'");
         $sql->next_record();

         $result = $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,parent,created,description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, updatorid, linkedto, approved, name_search, filename_search, description_search, metadata_search) values ('" .  $sql->make_arg_safe($sql->f("name")) . "', '" .  $sql->make_arg_safe($sql->f("filename")) . "', '" . $sql->f("f_size") . "', '" . $sql->f("creatorid") . "', '$newFolder', '" . $sql->f("created") . "', '" .  $sql->make_arg_safe($sql->f("description")) . "', '" .  $sql->make_arg_safe($sql->f("metadata")) . "', '" . $sql->f("security") . "', '" . $sql->f("groupid") . "','" . $sql->f("smodified") . "','" . $sql->f("checked_out") . "','" . $sql->f("major_revision") . "','" . $sql->f("minor_revision") . "', '" . $sql->f("url") . "', '" . $sql->f("doctype") . "', '" . $sql->f("updatorid") ."' , '$id', '" . $sql->f("approved") ."', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('name_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('filename_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('description_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('metadata_search'))) . "')");
         $newid = $sql->insert_id($default->owl_files_table, 'id');
         fCopyFileAcl($id, $newid);

         owl_syslog(FILE_LINKED, $userid, flid_to_filename($newid), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
         displayBrowsePage($parent);
      }
      if ($action == "bulk_move")
      {
         if (isset($disp))
         {
            foreach($disp as $fid)
            {
               if (check_auth($fid, "file_move", $userid) == 1)
               {
                  if ($default->owl_use_fs)
                  {
                     $sql = new Owl_DB;
                     $sql->query("SELECT filename, parent, url from $default->owl_files_table where id = '$fid'");
                     while ($sql->next_record())
                     {
                        $fname = $sql->f("filename");
                        $parent = $sql->f("parent");
                        $source = find_path($parent) . DIR_SEP;
                        if ($sql->f("url") == 1)
                        {
                           $type = "url";
                        } 
                        else
                        {
                           $type = "";
                        } 
                     } 
                     if ($type != "url")
                     {
                        if (!file_exists("$default->owl_FileDir/$dest$fname"))
                        {
                           if (!rename ("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest$fname"))
                           {
                              printError($owl_lang->err_move_failed);
                           }
                           fMoveBackupVersions ($fname, $source, $dest, $parent);
                        } 
                        else
                        {
                           printError($owl_lang->err_fileexists . "$default->owl_FileDir/$dest$fname", $result);
                        } 
                     } 
                  } 
                  $sql->query("UPDATE $default->owl_files_table SET parent='$newFolder' WHERE id='$fid'");
                  owl_syslog(FILE_MOVED, $userid, flid_to_filename($fid), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
               } 
            } 
         }
         if (isset($fdisp))
         {
            foreach($fdisp as $fid)
            {
               if (check_auth($fid, "folder_create", $userid) == 1)
               {
                  $sql = new Owl_DB;
                  $sql->query("SELECT name, parent from $default->owl_folders_table where id='$fid'");
                  while ($sql->next_record())
                  {
                     $fname = $sql->f("name");
                     $parent = $sql->f("parent");
                  }
                  if ($default->owl_use_fs)
                  {
                     if (!file_exists("$default->owl_FileDir/$dest$fname"))
                     {
                        if (substr(php_uname(), 0, 7) != "Windows")
                        {
                           $cmd = "mv \"$default->owl_FileDir/$source$fname\" \"$default->owl_FileDir/$dest\" 2>&1";
                           $lines = array();
                           $errco = 0;
                           $result = myExec($cmd, $lines, $errco);
                           if ($errco != 0)
                           {
                              printError($owl_lang->err_movecancel, $result);
                           }
                        }
                        else
                        {
                           // IF Windows just do a rename and hope for the best
                           rename ("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest/$fname");
                           fWindowsMoveFolders("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest/$fname");
                        }
                     }
                     else
                     {
                        printError($owl_lang->err_fileexists . "$default->owl_FileDir/$dest$fname", $result);
                     }
                  }
                  else // use_fs = false
                  {
                      $sql->query("SELECT name, parent from $default->owl_folders_table where id='$newFolder' and name = '$fname'");
                      if ($sql->num_rows() > 0)
                      {
                        printError($owl_lang->err_fileexists . "$default->owl_FileDir/$dest$fname");
                      }
                  }
                  $sql->query("update $default->owl_folders_table set parent='$newFolder' where id='$fid'");
                  owl_syslog(FOLDER_MOVED, $userid, fid_to_name($fid), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
               }
            }
         }
      } 
      else
      {
         if ($default->owl_use_fs)
         {
            if (empty($fid) and empty($id))
            {
               $fid = "0";
            }
            else
            {
               $fid = $id;
            }
            $Realid = fGetPhysicalFileId($fid);

            if ($type != "url" and $Realid == $fid)
            {
               if (!file_exists("$default->owl_FileDir/$dest$fname"))
               {
                  if (substr(php_uname(), 0, 7) != "Windows")
                  {
                     if ($action == "cp_file")
                     { 
                        $cmd = "cp \"$default->owl_FileDir/$source$fname\" \"$default->owl_FileDir/$dest\" 2>&1";
                        $lines = array();
                        $errco = 0;
                        $result = myExec($cmd, $lines, $errco);
                        if ($errco != 0)
                        {
                           printError($owl_lang->err_movecancel, $result);
                        }
                     }
                     else if ( $action == "cp_folder")
                     {
                        if (fGetPhysicalFolderId ($id) == $id)
                        {
                           my_dir_copy("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest" . fid_to_name($id) ); 
                        }
                     }
                     else if ( $action == "folder")
                     {

                        if (fGetPhysicalFolderId ($id) == $id)
                        {
                           $cmd = "mv \"$default->owl_FileDir/$source$fname\" \"$default->owl_FileDir/$dest\" 2>&1";
                           $lines = array();
                           $errco = 0;
                           $result = myExec($cmd, $lines, $errco);
                           if ($errco != 0)
                           {  
                              printError($owl_lang->err_movecancel, $result);
                           }
                        }
                     }
                     else 
                     {
                        rename("$default->owl_FileDir/$source$fname" , "$default->owl_FileDir/$dest$fname");
                        fMoveBackupVersions ($fname, $source, $dest, $parent);
                     }
                  } 
                  else
                  { 
                     if ($action == "cp_file")
                     {
                        // IF Windows just do a copy and hope for the best
                        copy ("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest/$fname");
                     }
                     else if ( $action == "cp_folder")
                     {
                        my_dir_copy("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest" . fid_to_name($id) ); 
                     }
                     else
                     {
                        // IF Windows just do a rename and hope for the best
                        rename ("$default->owl_FileDir/$source$fname", "$default->owl_FileDir/$dest/$fname");
                        fMoveBackupVersions ($fname, $source, $dest, $parent);
                     }
                  } 
               } 
               else
               {
                  printError($owl_lang->err_fileexists . "$default->owl_FileDir/$dest$fname", $result);
               }
            } 
         } 
      } 

      if ($action == "file")
      {
         if (!$default->owl_use_fs) 
         {
            // use_fs_false
            $qMoveBackupFiles = new Owl_DB;
            $sql->query("SELECT id FROM $default->owl_files_table WHERE  parent='$parent' AND  filename ='" . fid_to_filename($id) ."'");
            while ($sql->next_record())
            {
               // move all the versions of the file
               $qMoveBackupFiles->query("UPDATE $default->owl_files_table SET parent='$newFolder' WHERE id='" . $sql->f('id') . "'");
            }
         }
         else
         {
            $sql->query("UPDATE $default->owl_files_table SET parent='$newFolder' WHERE id='$id'");
         }
         owl_syslog(FILE_MOVED, $userid, flid_to_filename($id), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
      } 
      else if ($action == "cp_file")
      {
         if (!$default->owl_use_fs) 
         {
            $sql->query("SELECT * from  $default->owl_files_data_table  where id='$id'");
            $sql->next_record();
            $filedata = $sql->f("data");
            $compressed = $sql->f("compressed");
         } 
        
         $sql->query("SELECT * from  $default->owl_files_table where id='$id'");
         $sql->next_record();

         $linkedto = fIntializeCheckBox($sql->f("linkedto"));

         $result = $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid ,parent,created,description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, linkedto, approved, name_search, filename_search, description_search, metadata_search) values ('" .  $sql->make_arg_safe($sql->f("name")) . "', '" .  $sql->make_arg_safe($sql->f("filename")) . "', '" . $sql->f("f_size") . "', '" . $sql->f("creatorid") . "', '$userid', '$newFolder', '" . $sql->f("created") . "', '" .  $sql->make_arg_safe($sql->f("description")) . "', '" .  $sql->make_arg_safe($sql->f("metadata")) . "', '" . $sql->f("security") . "', '" . $sql->f("groupid") . "','" . $sql->f("smodified") . "','" . $sql->f("checked_out") . "','" . $sql->f("major_revision") . "','" . $sql->f("minor_revision") . "', '" . $sql->f("url") . "', '" . $sql->f("doctype") . "', '" . $linkedto . "', '" . $sql->f("approved") ."', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('name_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('filename_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('description_search'))) . "', '" . $sql->make_arg_safe(fReplaceSpecial($sql->f('metadata_search'))) . "')");
         $newid = $sql->insert_id($default->owl_files_table, 'id');                                                                                                                                                                                               
         // Make a copy of the thumbnails
         if (file_exists($default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $id . "_small.png"))
         {
            copy ($default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $id . "_small.png", $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $newid . "_small.png");
            copy ($default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $id . "_med.png", $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $newid . "_med.png");
            copy ($default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $id . "_large.png", $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $newid . "_large.png");
         }

         // INSERT Associated Custom Fields
         $GetDoctype = new Owl_DB;
         $PutDoctype = new Owl_DB;

         $GetDoctype->query("SELECT * from $default->owl_docfieldvalues_table  where file_id ='" . $id . "'");
         while ( $GetDoctype->next_record() )
         {
            $PutDoctype->query("INSERT into $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$newid', '" . $GetDoctype->f("field_name") . "' , '" . $GetDoctype->f("field_value") . "')");
         }

         if (!$default->owl_use_fs) 
         {
            $sql->query("INSERT into $default->owl_files_data_table (id, data, compressed) values ('$newid', '" . addslashes($filedata) ."','$compressed')");
         } 

         if (!$result && $default->owl_use_fs) unlink($newpath);

         fCopyFileAcl($id, $newid);

         owl_syslog(FILE_COPIED, $userid, flid_to_filename($newid), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
      } 
      else if ($action == "cp_folder")
      {
         fCopyFolder($id, $newFolder);
         owl_syslog(FOLDER_COPIED, $userid, fid_to_name($id), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
      }
      else if ($action == "folder")
      {
         $sql->query("update $default->owl_folders_table set parent='$newFolder' where id='$id'");
         owl_syslog(FOLDER_MOVED, $userid, fid_to_name($id), $parent, $owl_lang->log_file_to . fid_to_name($newFolder), "FILE");
      } 

      // if we deleted something that was in the backup directory
      // we want to display the Parent Directory when we are done
      displayBrowsePage($parent);
   } 
   // First time through. Generate screen for selecting target directory

   include($default->owl_fs_root ."/lib/header.inc");
   include($default->owl_fs_root ."/lib/userheader.inc");
   if ($parent == 0 or empty($parent) or !is_numeric($parent))
   {
      $parent = 1;
   }
                                                                                                                                                                                                 
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

   if ($action == "bulk_move")
   {
      fPrintNavBarXTPL($parent, "&nbsp;");
   }
   else
   {
      if ($action == "folder")
      {
         $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->move_folder_page_title);
         fPrintNavBarXTPL($id, $owl_lang->moving_folder . ":&nbsp;");
      }
      elseif ($action == "lnk_file")
      {
         $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->link_file_page_title);
         fPrintNavBarXTPL($parent, "LINKING FILE" . ":&nbsp;", $id);
      }
      elseif ($action == "lnk_folder")
      {
         $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->link_folder_page_title);
         fPrintNavBarXTPL($parent, "LINKING FOLDER" . ":&nbsp;", $id);
      }
      elseif ($action == "cp_file")
      {
         $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->copy_file_page_title);
         fPrintNavBarXTPL($parent, $owl_lang->copy_file . ":&nbsp;", $id);
      }
      elseif ($action == "cp_folder")
      {

          $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->copy_folder_page_title);
         fPrintNavBarXTPL($id, $owl_lang->copy_folder . ":&nbsp;");
      }
      else
      {
         $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->move_file_page_title);
         fPrintNavBarXTPL($parent, $owl_lang->moving_file . ":&nbsp;", $id);
      }
   }
   // Get information about file or directory we want to move
   if ($action == "file")
   {
      $sql = new Owl_DB;
      $sql->query("SELECT filename, parent from $default->owl_files_table where id='$id'");
   } 
   elseif ($action == "bulk_move")
   {
      $xtpl->assign('MOVE_PAGE_TITLE', $owl_lang->bulk_move_page_title);
      $sql = new Owl_DB;
      $sql2 = new Owl_DB;
      $query = "SELECT * from $default->owl_files_table where ";
      $query2 = "SELECT * from $default->owl_folders_table where ";
      if (isset($disp))
      {
         foreach($disp as $fid)
         {
            if (check_auth($fid, "file_move", $userid) == 1)
            {
               $query .= "id = '" . $fid . "' or ";
            } 
         } 
         $query .= "id = " . $fid . " and 1=1";
         $sql->query("$query");
      }

      if (isset($fdisp))
      {
      foreach($fdisp as $fid)
      {
         if (check_auth($fid, "folder_move", $userid) == 1)
         {
            $query2 .= "id = '" . $fid . "' or ";
         } 
      } 
      $query2 .= "id = " . $fid . " and 1=1";
      $sql2->query("$query2");
      }
   } 
   else
   {
      $sql = new Owl_DB;
      $sql->query("SELECT name, parent from $default->owl_folders_table where id='$id'");
   } 
   //print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   //print("<tr>\n");
   //print("<td align=\"left\" valign=\"top\">\n");
   //print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");

   if (isset($fdisp))
   {
   $xtpl->assign('MOVING_FOLDER_LABEL', $owl_lang->moving);
      while ($sql2->next_record())
      {
         $fname = $sql2->f("name");
         $parent = $sql2->f("parent");
         $xtpl->assign('MOVING_FOLDER_VALUE', $fname);
         $xtpl->parse('main.MoveFolder.MovingFolder');
         //print "<tr>\n<td class=\"file1\"><b style=\"color:#0000;\">".$owl_lang->moving."</b></td>\n<td class=\"file1\">&nbsp;<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_closed.gif\" alt=\"\" />$fname</td>\n</tr>\n";
      } 
   }
   if (isset($disp))
   {
      $xtpl->assign('MOVING_FILE_LABEL', $owl_lang->moving);
      while ($sql->next_record())
      {
         if ($action == "file" || $action == "bulk_move") 
         {
            $fname = $sql->f("filename");
         }
         if ($action == "folder") 
         {
            $fname = $sql->f("name");
         }
         $parent = $sql->f("parent");
         $xtpl->assign('MOVING_FILE_VALUE', $fname);
         $xtpl->parse('main.MoveFolder.MovingFile');
	 //print "<tr>\n<td class=\"file1\"><b style=\"color:#0000;\">".$owl_lang->moving."</b></td>\n<td class=\"file1\">&nbsp;<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/16x16.gif\" alt=\"\" />$fname.</td>\n</tr>\n";
      } 
   }

   //print("<tr>\n");
   //print("<td class=\"form1\">$owl_lang->select</td>\n");
   //print("<td class=\"form1\" width=\"100%\">");
   //print("<form method=\"post\" action=\"\">");

if (!empty($_GET['action']))
{
   $urlArgs2['action'] = $_GET['action'];
}
if (!empty($_POST['action']))
{
   $urlArgs2['action'] = $_POST['action'];
}

if (!empty($_GET['id']))
{
   $urlArgs2['id'] = $_GET['id'];
}
if (!empty($_POST['id']))
{
   $urlArgs2['id'] = $_POST['id'];
}


   $urlArgs2 = $urlArgs;
   $urlArgs2['myaction'] = $myaction;
   $urlArgs2['fname'] = $fname;
   $urlArgs2['sess'] = $sess;
   $urlArgs2['folders'] = $folders;
   $urlArgs2['type'] = $type;
   $urlArgs2['parent'] = $parent;
   //print fGetHiddenFields ($urlArgs2);
   $xtpl->assign('FORM', "<form name=\"foldermove\" id=\"foldermove\" action=\"\" method=\"post\">");
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));


   $xtpl->assign('MOVE_NAV_BAR', '');
if (isset($moreFolder))
{
   //print("<!-- BEGIN -->\n");
   //print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   //print("<tr>\n");
   //print("<td align=\"left\" valign=\"top\">\n");
   //print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   //print gen_navbar($moreFolder,0,1);
   $xtpl->assign('MOVE_NAV_BAR', gen_navbarXTPL($moreFolder,1,1));
   //print("<!-- END -->\n");

}
else
{
   $xtpl->assign('MOVE_NAV_BAR', gen_navbarXTPL(1,0,1));
}

//print ("<table cellspacing=\"0\" border=\"1\" cellpadding=\"4\">\n<tr>\n<td align=\"left\" bgcolor=\"white\">\n<p>\n");

   // Get list of folders sorted by name
   $whereclause = " ";

   if ($default->hide_backup == 1 and !fIsAdmin())
   {
      $whereclause = " WHERE name <> '$default->version_control_backup_dir_name'";
   } 
   $sql->query("select id,name,parent from $default->owl_folders_table $whereclause order by name");

   $i = 0;
   while ($sql->next_record())
   {
      $folderList[$i][0] = $sql->f("id");
      $folderList[$i][1] = $sql->f("name");
      $folderList[$i][2] = $sql->f("parent");
      $i++;
   } 

   $fCount = count($folderList);

   $fDepth = 0;
   
   $excludeID = $parent; // current location should not be a offered as a target


   $xtpl->assign('FOLDER_SELECT', $owl_lang->select);
 
   if (isset($moreFolder))
   {
      showFoldersIn($moreFolder, fid_to_name($moreFolder));
   }
   else
   {
      showFoldersIn($default->HomeDir, fid_to_name($default->HomeDir));
   }

   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $parent;
   $urlArgs2['myaction_x'] = "No";
   
   $xtpl->assign('HIDDEN', fGetHiddenFields ($urlArgs2));

   $xtpl->assign('FORMCANCEL', "<form name=\"foldermovecancel\" id=\"foldermovecancel\" action=\"\" method=\"post\">");
   $xtpl->assign('FOLDER_BTN_CANCEL', $owl_lang->cancel_button);
   $xtpl->assign('FOLDER_BTN_CANCEL_ALT', $owl_lang->alt_cancel);

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL("Bottom");
   }

   $xtpl->parse('main.MoveFolder');
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');
?>
