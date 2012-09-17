#!/usr/bin/php -q
<?php
/**
 * batch-parse-rsync (_php) - use *nix rsync command to synchronize two Owl databases
 * 
 * @Author: Robert Geleta, www.rgeleta.com, from original code by Steve Bourgeois <owl@bozzit.com>
 *
 * @Copyright (c) 2006-2011 Bozz IT Consulting Inc., The Owl Project Team
 *
 * @license Licensed under the GNU GPL. For full terms see the file /(owl_fs_root)a/DOCS/COPYING.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * See the GNU General Public License for more details.
 *
 * @uses
 *    MySQL database
 *    lynx command line browser
 *    /dev/nul (*nix bit bucket location)
 * 
 * @Version 1.2 2011-09-10
 * 
 */
//
global $default, $userid;
// *******************************************************************
//
// EDIT - START 
$batch_debug_sw = true ;
// EDIT - END
//
// *******************************************************************
//
// INITIALIZE SCRIPT
//
// Load config file
$my_dir_batch_root = dirname(dirname(dirname(__FILE__) ) ) ;
require($my_dir_batch_root . DIRECTORY_SEPARATOR . "configs" . DIRECTORY_SEPARATOR . "config-batch.inc.php");
//
// set error reporting
if ($batch_debug_sw)
{
	error_reporting(E_ALL) ;
}
//
// make sure active database is set
if ( !isset($batch_db_active) ) // it should have been in configs
{
	$batch_db_active = 0 ;
}
//
// *******************************************************************************************
//
// INITIALIZE LOGS
//
// initialize script log
$my_name = basename(__FILE__) ;
batch_log_msg2($my_name, "000 started") ;
//
// *******************************************************************
//
// LOAD SCRIPT SPECIFIC LIBRARIES
//
batch_debug_msg2($my_name, "020 get additional owl libraries") ;
// require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");
//
// *********************************************************
// check arguments
batch_debug_msg2($my_name, "200 checking argument counts") ;
$tmp_count_argv = count($argv) ;
batch_debug_msg2($my_name, "210 found [" . $tmp_count_argv . '] args') ;
//
if (count($argv) == 1)
{
	die("\nUsage: ./parse.php <full path to Rsync Log File>\n");
}
// *********************************************************
// 
// try to open the rsync log file
batch_debug_msg2($my_name, "300 checking rsync log file") ;
// set it from first argument
$sRsyncLogFile = $argv[1];
batch_debug_msg2($my_name, "310 log filename is [" . $sRsyncLogFile . ']') ;
// try to open it
if (($handle = @fopen ($sRsyncLogFile,"r")) == false)
{
	die("\nERROR: Failed to open file $sRsyncLogFile for Reading!\n\nUsage: ./parse.php <full path to Rsync Log File>\n");
}
batch_debug_msg2($my_name, "390 file opened ok") ;
//
// *******************************************************************
//
$userid = "1";

$iLineCounter = 0;
$bBeginProcessing = false;
while ($data = fgets ($handle))
{
      #print("BEGIN----\n'$data'\n");
      #$data = trim($data);
      #$data = trim($data, "\x00..\x1F");
      #print("'$data'\nEND\n");

     $aWords = explode(" ", $data);

     if ($bBeginProcessing == false)
     {

        if ($aWords[0] == "#-----" and $aWords[1] == "LOCAL" and $aWords[2] == "SYNC" and trim($aWords[3]) == "BEGIN")
        {
           $bBeginProcessing = true;
        } 
        else
        {
           continue;
        }
     }

	//print_r($data);
	//continue;
	//********************************************************
	// Skip comment lines, informational lines and statistics
	//********************************************************

      $iLineCounter++;
      $cUnixComment = $data[0];
      if ($cUnixComment == "#" or $cUnixComment == ".")
      { 
         continue;
      }

  

      if ($aWords[0] == "sent" or
          $aWords[0] == "total" or
          $aWords[0] == "building" or
          trim($aWords[0]) == "")
      {
         continue;
      }

	//********************************************************
	// WE NEED TO Delete the Folder From Owl as well
	//********************************************************

      if ($aWords[0] == "deleting" and $aWords[1] == "directory")
      {
        list($sAction, $sPath) = split("deleting directory", $data);
        $sPath = trim($sPath);
        $iParent = fParentFolder($sPath);

        $pathArray = explode( "/", $sPath);
        $iNumberOfLevels = count($pathArray);

//      $sql->query("SELECT id FROM folders WHERE name = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
        $sql->query("SELECT id FROM $default->owl_folders_table WHERE name = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
        if ($sql->num_rows() == 1)
        {
           $sql->next_record();
           $iID = $sql->f("id");
           fDeleteFolder($iID);
        }
        else
        {
           $iID = "0";
        }
 
        // print("<DELETING DIRECTORY>\t $sPath  <FOLDER ID:> $iID \n");
        batch_log_msg2($my_name, "<DELETING DIRECTORY>\t $sPath  <FOLDER ID:> $iID \n");
      }

	//********************************************************
	// WE NEED TO Delete the file From Owl as well
	//********************************************************
      else if ($aWords[0] == "deleting" OR ($aWords[0] == "file" and $aWords[1] == "has"))
      {

        $sql = new Owl_DB;

        list($sAction, $sPath) = split("deleting", $data);
        $sPath = trim($sPath);
        $iParent = fParentFolder($sPath);

        $pathArray = explode( "/", $sPath);
        $iNumberOfLevels = count($pathArray);

        #print("SELECT id FROM files WHERE filename = '" . $pathArray[$iNumberOfLevels - 1] ."' AND parent = '$iParent'\n\n");
//      $sql->query("SELECT id FROM files WHERE filename = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
        $sql->query("SELECT id FROM $default->owl_files_table WHERE filename = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
        if ($sql->num_rows() == 1)
        {
           $sql->next_record();
           $iID = $sql->f("id");
           fDeleteFile($iID);
        }
        else
        {
           $iID = "0";
        }

        // print("<DELETING FILE>\t$sPath <FILE ID:> $iID \n");
        batch_log_msg2($my_name, "<DELETING FILE>\t$sPath <FILE ID:> $iID \n");
      }
      else
      {

        if (substr(trim($data), -1, 1) == '/')
        {
           // We are dealing with a folder
           $iID = fParentFolder(trim($data));
           if ( $iID == 0)
           {
              // print("<CREATE FOLDER>\t" . trim($data) . "\n");
              batch_log_msg2($my_name, "<CREATE FOLDER>\t" . trim($data) . "\n");
              fCreateFolder($data);
           }
           else
           {
              //print("<FOLDER SKIPPED>\t" . trim($data) . "\n");
              batch_log_msg2($my_name,"<FOLDER SKIPPED>\t" . trim($data) . "\n");
           } 
        }
        else
        {
           $sPath = trim($data);
           $iParent = fParentFolder($sPath);

           $pathArray = explode( "/", $sPath);
           $iNumberOfLevels = count($pathArray);

//         $sql->query("SELECT id FROM files WHERE filename = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
           $sql->query("SELECT id FROM $default->owl_files_table WHERE filename = '" . mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]) ."' AND parent = '$iParent'");
           //exit("SELECT id FROM files WHERE filename = '" . $pathArray[$iNumberOfLevels - 1] ."' AND parent = '$iParent'");

           if ($sql->num_rows() == 1)
           {
              $sql->next_record();
              $iID = $sql->f("id");
              // print("<UPDATED FILE>\t\t" . $sPath. "\n");
              batch_log_msg2($my_name,"<UPDATED FILE>\t\t" . $sPath. "\n");
              fUpdateFile($sPath, $iParent, $iID);
              //$sql->next_record();
           }
           else
           {
              $iParent = fParentFolder($sPath);
              // print("<NEW FILE>\t\t" . trim($sPath) . "\n");
              batch_log_msg2($my_name, "<NEW FILE>\t\t" . trim($sPath) . "\n");
              fCreateFile($sPath, $iParent);
           }
        }
      }
      //print("$data");
   }
//
// *******************************************************************************************
//
// FINALIZE LOGS
//
// finalize script log
batch_log_msg2($my_name, "900 exiting") ;
echo "\n" ;
//
// *******************************************************************
//
function fUpdateFile($sPath, $parent, $id)
{
   global $default, $owl_lang;

   $sql = new Owl_DB;
   $smodified = $sql->now();
   $sRootFolder = "/" . fid_to_name(1) . "/" ;

   $FileInfo = GetFileInfo($default->owl_FileDir . $sRootFolder . $sPath);  

   $pathArray = explode( "/", $sPath);

   $iNumberOfLevels = count($pathArray);
   $iParent = 1;
   $iPreviousParent = 1;

   $TheFile = $pathArray[$iNumberOfLevels - 1];

   $ThePath = $sRootFolder . $sPath;

   if (empty($FileInfo[1]))
   {
     $iFileSize = "0";
   }
   else
   {
      $iFileSize = $FileInfo[1];
   }

   $sql->query("UPDATE $default->owl_files_table SET f_size='$iFileSize', smodified=$smodified WHERE id='$id'");

   fDeleteFileIndexID($id);
   fIndexAFile($TheFile, $ThePath, $id);
   fGenerateThumbNail($id);
}
//
// *******************************************************************
//
function fCreateFile($sPath, $parent)
{
   global $default, $owl_lang;

   $sql = new Owl_DB;
   $smodified = $sql->now();

   $sRootFolder = "/" . fid_to_name(1) . "/" ;

   $FileInfo = GetFileInfo($default->owl_FileDir . $sRootFolder . $sPath);  

   $pathArray = explode( "/", $sPath);

   $iNumberOfLevels = count($pathArray);
   $iParent = 1;
   $iPreviousParent = 1;

   $TheFile = mysql_real_escape_string($pathArray[$iNumberOfLevels - 1]);

   $ThePath = $sRootFolder . $sPath;

   if (empty($FileInfo[1]))
   {
     $iFileSize = "0";
   }
   else
   {
      $iFileSize = $FileInfo[1];
   }

   if ($default->owl_def_file_title == "")
   {
      $aFirstpExtension = fFindFileFirstpartExtension ($TheFile);
      $firstpart = $aFirstpExtension[0];

      $title_name =  $firstpart;
      $title_name = trim(ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "",  ereg_replace("%20|^-", "_", $title_name)));
   }
   else
   {
      $title_name = $default->owl_def_file_title;
   }

   $iCreatorID = $default->owl_def_file_owner;
   $sDescription = $TheFile;
   $sMetadata = $default->owl_def_file_meta;
   $iSecurity = $default->owl_def_file_security;
   $iGroupOwner = $default->owl_def_file_group_owner;

// $SQL = "INSERT INTO files (name,filename,f_size,creatorid, updatorid,parent,created,description,metadata,security,groupid,smodified,approved,linkedto, major_revision,minor_revision, url) values ('$title_name', '$TheFile', '$iFileSize', '$iCreatorID',  '$iCreatorID','$parent', '$FileInfo[2]', '$sDescription', '$sMetadata', '$iSecurity', '$iGroupOwner','$FileInfo[2]', '1', '0', '$default->major_revision', '$default->minor_revision', '0')";
   $SQL = "INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid,parent,created,description,metadata,security,groupid,smodified,approved,linkedto, major_revision,minor_revision, url) values ('$title_name', '$TheFile', '$iFileSize', '$iCreatorID',  '$iCreatorID','$parent', '$FileInfo[2]', '$sDescription', '$sMetadata', '$iSecurity', '$iGroupOwner','$FileInfo[2]', '1', '0', '$default->major_revision', '$default->minor_revision', '0')";
   $sql->query($SQL);

   // index New Files pdf and TXT Files for SEARCH

   $searchid = $sql->insert_id($default->owl_files_table, 'id');

   notify_users($iGroupOwner, 0, $searchid, $TheFile, $title_name, $sDescription);
   notify_monitored_folders ($parent, $TheFile);

   owl_syslog(FILE_UPLOAD, $default->owl_def_file_owner, $TheFile, $parent, $owl_lang->log_detail . $owl_lang->log_readhd_feature_add, "FILE");

   fSetDefaultFileAcl($searchid);
   fSetInheritedAcl($parent, $searchid, "FILE");

   $index_file = "1";
   fIndexAFile($TheFile, $ThePath , $searchid);
   fGenerateThumbNail($searchid);

}
//
// *******************************************************************
//
function fCreateFolder($sPath)
{
   global $default, $owl_lang;

   $sql = new Owl_DB;
   $sRootFolder = "/" . fid_to_name(1);

   $pathArray = explode( "/", $sPath);

   $iNumberOfLevels = count($pathArray);
   $iParent = 1;
   $iPreviousParent = 1;
   for($i = 0; $i < $iNumberOfLevels - 1; $i++)
   {
      #print("SELECT id FROM folders WHERE name = '$pathArray[$i]' AND parent = '$iParent' \n");
//    $sql->query("SELECT id FROM folders WHERE name = '" . mysql_real_escape_string($pathArray[$i]) . "' AND parent = '$iParent'");
      $sql->query("SELECT id FROM $default->owl_folders_table WHERE name = '" . mysql_real_escape_string($pathArray[$i]) . "' AND parent = '$iParent'");
      if ($sql->num_rows() == 1)
      {
         $sCurrentPath .= "/" . $pathArray[$i]; 
         $iPreviousParent = $iParent;
         $sql->next_record();
         $iParent = $sql->f("id");
      }
      else
      {
         $sCurrentPath .= "/" . $pathArray[$i]; 
         //print("mkdir " . $default->owl_FileDir  . $sCurrentPath . " -- $iPreviousParent\n");
         //mkdir($default->owl_FileDir  . $sRootFolder . $sCurrentPath);
         $smodified = $sql->now();
//       $SQL = "INSERT INTO folders (name,parent,security,groupid,creatorid,description,smodified) values ('" . mysql_real_escape_string($pathArray[$i]) . "', '$iParent', '$default->owl_def_fold_security', '$default->owl_def_fold_group_owner', '$default->owl_def_fold_owner', '', $smodified)";
         $SQL = "INSERT INTO $default->owl_folders_table (name,parent,security,groupid,creatorid,description,smodified) values ('" . mysql_real_escape_string($pathArray[$i]) . "', '$iParent', '$default->owl_def_fold_security', '$default->owl_def_fold_group_owner', '$default->owl_def_fold_owner', '', $smodified)";
         $sql->query($SQL);
         $parent = $iParent;
         $iParent = $sql->insert_id($default->owl_folders_table, 'id');

         owl_syslog(FOLDER_CREATED, $default->owl_def_fold_owner, $pathArray[$i], $iParent, $owl_lang->log_detail . "RSYNC PARSE FEATURE", "FILE");
         fSetDefaultFolderAcl($iParent);
         fSetInheritedAcl($parent, $iParent, "FOLDER");

      }
   }
   return $iParent;
}
//
// *******************************************************************
//
function fDeleteFile($id)
{
   global $default, $owl_lang;

   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_files_table WHERE id = '$id'");

   while ($sql->next_record())
   {
      $path = find_path($sql->f("parent"));
      $filename = $sql->f("filename");
      $filesize = $sql->f("f_size");
      $owner = $sql->f("creatorid");
      $parent = $sql->f("parent");
   }

   if (file_exists($default->thumbnails_location))
   {
      $handle = opendir($default->thumbnails_location);
      while(false !== ($file = readdir($handle)))
      {
         //print("F: $file Sub:" . substr($file, 0, 3) . "<br />");
         list($sThumbFileDb, $sThumbFileId, $sThumbFileName) = split("_", $file);


         $sDelFileCheck = $sThumbFileDb . "_". $sThumbFileId;
         if ($sDelFileCheck == $default->owl_current_db . "_" .$id)
         {
            unlink($default->thumbnails_location . "/" .$file);
         }
      }
   }
   if (file_exists($default->owl_FileDir . "/" . $path . "/" . $filename))
   {
      unlink($default->owl_FileDir . "/" . $path . "/" . $filename);
   }

   $sql->query("DELETE FROM $default->owl_files_table WHERE id = '$id'");
   // Clean up all monitored files with that id
   $sql->query("DELETE FROM $default->owl_monitored_file_table WHERE fid = '$id'");
   // Clean up all comments with this file
   $sql->query("DELETE FROM $default->owl_comment_table WHERE fid = '$id'");
   // Clean up all comments with this file
   $sql->query("DELETE FROM $default->owl_docfieldvalues_table WHERE file_id = '$id'");
   // Clean up all linked files
   $sql->query("DELETE FROM $default->owl_files_table WHERE linkedto = '$id'");
   // Clean up all linked files
   $sql->query("DELETE FROM $default->owl_peerreview_table WHERE file_id = '$id'");
   // Clean up all Acls for this file
   $sql->query("DELETE FROM $default->owl_advanced_acl_table where file_id = '$id'");
   // Clean Up SEARCH Indexes for this file
   fDeleteFileIndexID($id);
   // Clean up all previous versions as well
   $sql->query("SELECT id FROM $default->owl_folders_table WHERE name='$default->version_control_backup_dir_name' and parent='$parent'");
   if ($sql->num_rows($sql) != 0)
   {
      while ($sql->next_record())
      {
         $backup_parent = $sql->f("id");
      }
      $aFirstpExtension = fFindFileFirstpartExtension ($filename);
      $firstpart = $aFirstpExtension[0];
      $file_extension = $aFirstpExtension[1];

      $Quota = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_files_table WHERE filename LIKE '" . $firstpart . "\\_%" . $file_extension . "' OR filename = '$filename' AND (parent = $backup_parent OR parent = $parent) order by major_revision desc, minor_revision desc");
      while ($sql->next_record())
      {
         $path = find_path($sql->f("parent"));
         $filename = $sql->f("filename");
         // Clean Up SEARCH Indexes for the Backup files
        fDeleteFileIndexID($sql->f("id"));
         // Update the Quota for the Backup files
         if (fIsQuotaEnabled($sql->f("creatorid")))
         {
            $new_quota = fCalculateQuota($sql->f("f_size"), $sql->f("creatorid"), "DEL");
            $Quota->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '". $sql->f("creatorid") . "'");
         }

         if (file_exists($default->owl_FileDir . "/" . $path . "/" . $filename))
         {
            unlink($default->owl_FileDir . "/" . $path . "/" . $filename);
         }
      }
      $sql->query("DELETE FROM $default->owl_files_table WHERE filename LIKE '" . $firstpart . "\\_%" . $file_extension . "' OR filename = '$filename' AND (parent = $backup_parent OR parent = $parent)");
   }
   owl_syslog(FILE_DELETED, "1", $filename, $parent, $owl_lang->log_detail, "FILE");
}
//
// *******************************************************************
//
function fDeleteFolder($fid)
{
   global $default;
   // delete from database
   $path = find_path($fid);

   $sql = new Owl_DB;
   $sql->query("DELETE FROM $default->owl_folders_table WHERE id = '$fid'");
   $sql->query("DELETE FROM $default->owl_monitored_folder_table WHERE fid = '$fid'");
  // Clean up Folder ACL's
   $sql->query("DELETE FROM $default->owl_advanced_acl_table WHERE folder_id = '$fid'");

   if (is_dir($default->owl_FileDir . "/" . $path)) 
   {
      rmdir($default->owl_FileDir . "/" . $path);
   }
}
//
// *******************************************************************
//
function fParentFolder($sPath)
{
   global $default, $owl_lang;
   $sql = new Owl_DB;

   $pathArray = explode( "/", $sPath);

   $iNumberOfLevels = count($pathArray);
   $iParent = 1;
   for($i = 0; $i < $iNumberOfLevels - 1; $i++)
   {
      #print("SELECT id FROM folders WHERE name = '$pathArray[$i]' AND parent = '$iParent' \n");
//    $sql->query("SELECT id FROM folders WHERE name = '" . mysql_real_escape_string($pathArray[$i]) . "' AND parent = '$iParent'");
      $sql->query("SELECT id FROM $default->owl_folders_table WHERE name = '" . mysql_real_escape_string($pathArray[$i]) . "' AND parent = '$iParent'");
      if ($sql->num_rows() == 1)
      {
         $sql->next_record();
         $iParent = $sql->f("id");
      }
      else
      {
         $iParent = "0";
      }
   }
   return $iParent;
}
//
// *******************************************************************
//
function GetFileInfo($PathFile) {

  $TheFileSize = filesize($PathFile);  //get filesize
  $TheFileTime = date("Y-m-d H:i:s", filemtime($PathFile));  //get and fix time of last modifikation
  //$TheFileTime2 = date("M d, Y \a\\t h:i a", filemtime($PathFile));  //get and fix time of last modifikation


  $FileInfo[1] = $TheFileSize;
  $FileInfo[2] = $TheFileTime; //s$modified
  //$FileInfo[3] = $TheFileTime2; //modified

  return $FileInfo;
}
//
// *******************************************************************
//
// hook gt intentionally omitted