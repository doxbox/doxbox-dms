<?php

/**
 * syschk.php
 *
 * Copyright (c) 2007 Bozz IT Consulting Inc
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Version 1.1
 */


global $default, $userid, $bFileCheckPassed, $iRowCount;


$bFileCheckPassed = true;
$iRowCount = 0;

require_once(dirname(dirname(dirname(__FILE__))) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");

$userid = "1";


$sPassedString = "[<font color=\"green\"> PASSED </font>]";
$sFailedString = "[<font color=\"red\"> FAILED </font>]";
$sBypassedString = "[<font color=\"orange\"> BYPASSED </font>]";

$sDocDir = $default->owl_db_FileDir[0] . "/" . fid_to_name(1);

print("<table border=\"1\" cellspacing=\"0\" cellpadding=\"10\">\n");

// ***********************************************************
// php.ini Setting
// ***********************************************************
//
print("<tr>\n");
print("<td bgcolor=\"#38B4E7\" colspan=\"2\" align=\"center\"><h3>***** Checking PHP.ini Settings ---</h3></td>\n");
print("</tr>\n");

if(ini_get('safe_mode'))
{
   print("<tr>\n");
   print("<td>PHP Safe Mode OFF</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr>\n");
   print("<td>PHP Safe Mode OFF</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}

if(ini_get('file_uploads'))
{
   print("<tr bgcolor=\"#BCE7FA\">\n");
   print("<td>File Uploads ON</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr bgcolor=\"#BCE7FA\">\n");
   print("<td>File Uploads ON</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}

print("<tr>\n");
print("<td>Max File Size ('max_upload_max_filesize'):</td>\n");
print("<td>" . ini_get('upload_max_filesize'). "</td>\n");
print("</tr>\n");

print("<tr bgcolor=\"#BCE7FA\">\n");
print("<td>Max File Size ('post_max_size'):</td>\n");
print("<td>" . ini_get('post_max_size'). "</td>\n");
print("</tr>\n");

print("<tr>\n");
print("<td>Max File Size ('max_execution_time'):</td>\n");
print("<td>" . ini_get('max_execution_time'). "</td>\n");
print("</tr>\n");

print("<tr bgcolor=\"#BCE7FA\">\n");
print("<td>Max File Size ('max_input_time'):</td>\n");
print("<td>" . ini_get('max_input_time'). "</td>\n");
print("</tr>\n");

print("<tr>\n");
print("<td>Max File Size ('memory_limit'):</td>\n");
print("<td>" . ini_get('memory_limit'). "</td>\n");
print("</tr>\n");


print("<tr>\n");
print("<td bgcolor=\"#38B4E7\" colspan=\"2\" align=\"center\"><h3>***** Checking Filesystem Permissions ---</h3></td>\n");
print("</tr>\n");

// ***********************************************************
// OWL TMP  Directory
// ***********************************************************
//
if (!file_exists($default->owl_tmpdir))
{
   print("<tr>\n");
   print("<td>TmpDir Directory '$default->owl_tmpdir'  [ N O T  F O U N D ].</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr>\n");
   print("<td>TmpDir Directory '$default->owl_tmpdir'  [ F O U N D ].</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}

$bFailed = $sPassedString;
$bCheck = true;
if (!is_readable($default->owl_tmpdir))
{
   $bFailed = $sFailedString;
   $sReadable = "[<font color=\"red\"> NOT READABLE </font>]";
   $bCheck = false;
}
else
{
   $sReadable = "[<font color=\"green\"> READABLE </font>]";
}
if (!is_writeable($default->owl_tmpdir))
{
   $bFailed = $sFailedString;
   $sWriteable = "[<font color=\"red\"> NOT WRITEABLE </font>]";
   $bCheck = false;
}
else
{
   $sWriteable = "[<font color=\"green\"> WRITEABLE </font>]";
}
print("<tr>\n");
print("<td>TmpDir Directory '$default->owl_tmpdir'  $sReadable $sWriteable</td>\n");
print("<td>$bFailed</td>\n");
print("</tr>\n");

// ***********************************************************
// TRASH Directory
// ***********************************************************
//
if (!file_exists($default->trash_can_location))
{
   print("<tr>\n");
   print("<td>Trash Can Directory '$default->trash_can_location'  [ N O T  F O U N D ].</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr>\n");
   print("<td>Trash Can Directory '$default->trash_can_location'  [ F O U N D ].</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}

$bFailed = $sPassedString;
$bCheck = true;
if (!is_readable($default->trash_can_location))
{
   $bFailed = $sFailedString;
   $sReadable = "[<font color=\"red\"> NOT READABLE </font>]";
   $bCheck = false;
}
else
{
   $sReadable = "[<font color=\"green\"> READABLE </font>]";
}
if (!is_writeable($default->trash_can_location))
{
   $bFailed = $sFailedString;
   $sWriteable = "[<font color=\"red\"> NOT WRITEABLE </font>]";
   $bCheck = false;
}
else
{
   $sWriteable = "[<font color=\"green\"> WRITEABLE </font>]";
}
print("<tr>\n");
print("<td>Trash Can Directory '$default->trash_can_location'  $sReadable $sWriteable</td>\n");
print("<td>$bFailed</td>\n");
print("</tr>\n");

// ***********************************************************
// THUMBNAILS Directory
// ***********************************************************
//
if (!file_exists($default->thumbnails_location))
{
   print("<tr bgcolor=\"#BCE7FA\">\n");
   print("<td>ThumbNails Directory '$default->thumbnails_location'  [ N O T  F O U N D ].</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr bgcolor=\"#BCE7FA\">\n");
   print("<td>ThumbNails Directory '$default->thumbnails_location'  [ F O U N D ].</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}

$bFailed = $sPassedString;
$bCheck = true;
if (!is_readable($default->thumbnails_location))
{
   $bFailed = $sFailedString;
   $sReadable = "[<font color=\"red\"> NOT READABLE </font>]";
   $bCheck = false;
}
else
{
   $sReadable = "[<font color=\"green\"> READABLE </font>]";
}
if (!is_writeable($default->thumbnails_location))
{
   $bFailed = $sFailedString;
   $sWriteable = "[<font color=\"red\"> NOT WRITEABLE </font>]";
   $bCheck = false;
}
else
{
   $sWriteable = "[<font color=\"green\"> WRITEABLE </font>]";
}
print("<tr bgcolor=\"#BCE7FA\">\n");
print("<td>ThumbNails Directory '$default->thumbnails_location'  $sReadable $sWriteable</td>\n");
print("<td>$bFailed</td>\n");
print("</tr>\n");

// ***********************************************************
// DOCUMENTS  Directory
// ***********************************************************
//
if (!file_exists($sDocDir))
{
   print("<tr>\n");
   print("<td>Documents Directory '$sDocDir'  [ N O T  F O U N D ].</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}
else
{
   print("<tr>\n");
   print("<td>Documents Directory '$sDocDir'  [ F O U N D ].</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}


$bFailed = $sPassedString;
$bCheck = true;
if (!is_readable($sDocDir))
{
   $bFailed = $sFailedString;
   $sReadable = "[<font color=\"red\"> NOT READABLE </font>]";
   $bCheck = false;
}
else
{
   $sReadable = "[<font color=\"green\"> READABLE </font>]";
}
if (!is_writeable($sDocDir))
{
   $bFailed = $sFailedString;
   $sWriteable = "[<font color=\"red\"> NOT WRITEABLE </font>]";
   $bCheck = false;
}
else
{
   $sWriteable = "[<font color=\"green\"> WRITEABLE </font>]";
}

print("<tr>\n");
print("<td>Documents Directory '$sDocDir'  $sReadable $sWriteable</td>\n");
print("<td>$bFailed</td>\n");
print("</tr>\n");

if ($bCheck)
{
   print("<tr>\n");
   print("<td bgcolor=\"#38B4E7\" colspan=\"2\" align=\"center\"><h3>***** Checking All Files and Folders Permissions ---</h3></td>\n");
   print("</tr>\n");
   fCheckAllFoldersFiles($sDocDir);
   $iRowCount++;
   $PrintLines = $iRowCount % 2;
   if ($PrintLines == 0)
   {
      $sColor = ' bgcolor="#BCE7FA"';
   }
   else
   {
      $sColor = '';
   }

   if ($bFileCheckPassed)
   {
      print("<tr$sColor>\n");
      print("<td>Check Of All Files and Folders Permissions</td>\n");
      print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
      print("</tr>\n");
   }
   else
   {
      print("<tr$sColor>\n");
      print("<td>Check Of All Files and Folders Permissions</td>\n");
      print("<td>$sFailedString</td>\n");
      print("</tr>\n");
   }
}

// ***********************************************************
// DB vs Files/Folders  
// ***********************************************************
//

print("<tr>\n");
print("<td bgcolor=\"#38B4E7\" colspan=\"2\" align=\"center\"><h3>***** Walk DB, Check that Physical File Exists.---</h3></td>\n");
print("</tr>\n");



// ***********************************************************
// FILES  
// ***********************************************************
//

$sql = new OWL_DB;
$delid = "";
$delquery = "";
$query = "SELECT id,parent,filename FROM  $default->owl_files_table where url <> 1";
$sql->query($query);
$iRowCount = 0;
while($sql->next_record())
{ 
   $iRowCount++;
   $PrintLines = $iRowCount % 2;
   if ($PrintLines == 0)
   {
      $sColor = ' bgcolor="#BCE7FA"';
   }
   else
   {
      $sColor = '';
   }

   $dbfolder = $default->owl_FileDir . "/" . get_dirpath($sql->f('parent')) . "/" . $sql->f('filename');
   $owlFolderPath = get_dirpath($sql->f('parent')) . "/" . $sql->f('filename');
   if(!file_exists($dbfolder)) 
   {
      print("<tr$sColor>\n");
      print("<td>OWL File: '$owlFolderPath' missing from filesystem</td>\n");
      print("<td>$sFailedString</td>\n");
      print("</tr>\n");
      $delid = $sql->f('id');
      $delquery .= "DELETE FROM $default->owl_files_table WHERE id = '$delid';<br />"; 
   }
}

if (empty($delquery))
{
   print("<tr>\n");
   print("<td>FILES Check</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}
else
{
   print("</tr>\n");
   print("<tr>\n");
   print("<td>FILES Check <br /><br /> Correcting SQL SCRIPT:<br /><br />$delquery</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}

// ***********************************************************
// FOLDERS
// ***********************************************************
//

$sql = new OWL_DB;
$delid = "";
$delquery = "";
$query = "SELECT id,parent,name FROM  $default->owl_folders_table";
$sql->query($query);
$iRowCount = 0;
while($sql->next_record())
{ 
   $iRowCount++;
   $PrintLines = $iRowCount % 2;
   if ($PrintLines == 0)
   {
      $sColor = ' bgcolor="#BCE7FA"';
   }
   else
   {
      $sColor = '';
   }

   $dbfolder = $default->owl_FileDir . "/" . get_dirpath($sql->f('parent')) . "/" . $sql->f('name');
   $owlFolderPath = get_dirpath($sql->f('parent')) . "/" . $sql->f('name');
   if(!file_exists($dbfolder)) 
   {
      print("<tr$sColor>\n");
      print("<td>OWL Folder: '$owlFolderPath' missing from filesystem</td>\n");
      print("<td>$sFailedString</td>\n");
      print("</tr>\n");
      $delid = $sql->f('id');
      $delquery .= "DELETE FROM $default->owl_folders_table WHERE id = '$delid';<br />"; 
   }
}

if (empty($delquery))
{
   print("<tr>\n");
   print("<td>FOLDERS Check</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
}
else
{
   print("</tr>\n");
   print("<tr>\n");
   print("<td>FOLDERS Check <br /><br /> Correcting SQL SCRIPT:<br /><br />$delquery</td>\n");
   print("<td>$sFailedString</td>\n");
   print("</tr>\n");
}

// ***********************************************************
// Files/Folders NOT IN DB
// ***********************************************************
//

print("<tr>\n");
print("<td bgcolor=\"#38B4E7\" colspan=\"2\" align=\"center\"><h3>***** Walk FileSystem, Check that Folder Exists.---</h3></td>\n");
print("</tr>\n");

print("</tr>\n");
print("<tr>\n");
print("<td>FOLDERS Check");

$sAddMissingFolders = "";
fCheckFolderExist ($sDocDir);

if (!empty($sAddMissingFolders))
{
   print("<br />You may have to run this check a number of times<br /> Correcting SQL SCRIPT:<br /><br />$sAddMissingFolders</td>\n");
   print("<td nowrap=\"nowrap\">$sFailedString</td>\n");
   print("</tr>\n");
   print("<tr>\n");
   print("<td>FILES Check BYPASSED until All Folder issues are rectified</td>\n");
   print("<td nowrap=\"nowrap\">$sBypassedString</td>\n");
   print("</tr>\n");
}
else
{
   print("</td>\n");
   print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
   print("</tr>\n");
   print("<tr>\n");
   print("<td>FILES Check");
   $sAddMissingFiles = "";
   fCheckFileExist ($sDocDir);
   if (!empty($sAddMissingFiles))
   {
      print("Correcting SQL SCRIPT:<br /><br />$sAddMissingFiles</td>\n");
      print("<td>$sFailedString</td>\n");
      print("</tr>\n");
   }
   else
   {
      print("</td>\n");
      print("<td nowrap=\"nowrap\">$sPassedString</td>\n");
      print("</tr>\n");
   }
}



//***************************************************************
//***************************************************************
//***************************************************************
//   S  U  P  O  R  T  I  N  G      F  U  N  C  T  I  O  N  S
//***************************************************************
//***************************************************************
//***************************************************************

function fCheckFileExist ($sDocDir)
{
   global $sAddMissingFiles;
   $sql = new OWL_DB;
   if (file_exists($sDocDir))
   {
      if (is_dir($sDocDir))
      {
         $handle = @opendir($sDocDir);
         while ($filename = @readdir($handle))
         {
            if ($filename != "." && $filename != "..")
            {
               $iRowCount++;
               $PrintLines = $iRowCount % 2;
               if ($PrintLines == 0)
               {
                  $sColor = ' bgcolor="#BCE7FA"';
               }
               else
               {
                  $sColor = '';
               }
 
			   if (!is_dir($sDocDir . "/" . $filename))
			   {
			     $aResults = fGetFileID($sDocDir . "/" . $filename);
// DEFAULTS
$iCreatorID = '1';  // Admin
$iGroupOwner = '0'; // Administrator
$sDescription = '';
$sMetadata = '';

                 $FileInfo = GetFileInfo($sDocDir . "/" . $filename);
                 if (empty($FileInfo[1]))
                 {
                   $iFileSize = "0";
                 }
                 else
                 {
                    $iFileSize = $FileInfo[1];
                 }

			     if ($aResults['bFound'] == "NOTFOUND")
			     {
					 $sNow = $sql->now();
					 $sAddMissingFiles .= "INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid,parent,created,description,metadata,groupid,smodified,approved,linkedto, major_revision,minor_revision, url, doctype, infected) values ('" . mysql_real_escape_string($filename) . "', '" . mysql_real_escape_string($filename) . "', '$iFileSize', '$iCreatorID',  '$iCreatorID','" . $aResults['iParentID'] . "', '$FileInfo[2]', '$sDescription', '$sMetadata', '$iGroupOwner','$FileInfo[2]', '1', '0', '$default->major_revision', '$default->minor_revision', '0', '$default->default_doctype', '0')";
			     }
			   }
			   else
			   {
					 fCheckFileExist ($sDocDir . "/" . $filename);
			   }
            }
         }
       @closedir($handle);
      }
   }
}   

function fCheckFolderExist ($sDocDir)
{
   global $sAddMissingFolders, $default;
   $sql = new OWL_DB;
   $iRowCount = 0;
   if (file_exists($sDocDir))
   {
      if (is_dir($sDocDir))
      {
         $handle = @opendir($sDocDir);
         while ($filename = @readdir($handle))
         {
            if ($filename != "." && $filename != "..")
            {
               $iRowCount++;
               $PrintLines = $iRowCount % 2;
               if ($PrintLines == 0)
               {
                  $sColor = ' bgcolor="#BCE7FA"';
               }
               else
               {
                  $sColor = '';
               }
 
			   if (is_dir($sDocDir . "/" . $filename))
			   {
			     $aResults = fGetFolderID($sDocDir . "/" . $filename);
			     if ($aResults['bFound'] == "NOTFOUND")
			     {
					 $sNow = $sql->now();
                     $sAddMissingFolders .= "<br />INSERT INTO " . $default->owl_folders_table . " (name, parent, description, security, groupid, creatorid, password, smodified, linkedto, rss_feed)  VALUES ('". mysql_real_escape_string($filename) . "','" . $aResults['iParentID'] . "','','',0,1,'',$sNow,0,NULL);";

			     }
			     else
			     {
					 fCheckFolderExist ($sDocDir . "/" . $filename);
			     }
			   }
            }
         }
       @closedir($handle);
      }
   }
}   


function fGetFileID($sFileName)
{
   global $default;
       $aFolders = array();

       $sActualFileName = basename($sFileName);
       $sFolderDir = dirname($sFileName);

       $aFolders = split('/', $sFolderDir);
       $sql = new Owl_DB;

       $aResult = array();

       $aResult['iParentID'] = 0;

       foreach ($aFolders as $sFileName)
       {
          if (trim($sFileName) <> "")
          {
             $sql->query("SELECT id FROM " . $default->owl_folders_table . " WHERE name = '$sFileName' AND parent = '" . $aResult['iParentID'] . "'");
             $sql->next_record();
			 if ($sql->num_rows() > 0)
			 {
                $aResult['iParentID'] = $sql->f('id');
                $sql->query("SELECT id FROM " . $default->owl_files_table . " WHERE filename = '$sActualFileName' AND parent = '" . $aResult['iParentID'] . "'");
			    if ($sql->num_rows() > 0)
			    {
                   $aResult['bFound'] = "FOUND";
				}
			    else
			    {
                   $aResult['bFound'] = "NOTFOUND";
			    }
			 }
			 else
			 {
                $aResult['bFound'] = "NOTFOUND";
			 }
          }
      }
	  return $aResult;
}


function fGetFolderID($sFolderName)
{
   global $default;

       $aFolders = array();

       $aFolders = split('/', $sFolderName);

       $sql = new Owl_DB;

       $aResult = array();

       $aResult['iParentID'] = 0;

       foreach ($aFolders as $sFolderName)
       {
          if (trim($sFolderName) <> "")
          {
             $sql->query("SELECT id FROM " . $default->owl_folders_table . " WHERE name = '$sFolderName' AND parent = '" . $aResult['iParentID'] . "'");
             $sql->next_record();
			 if ($sql->num_rows() > 0)
			 {
                $aResult['iParentID'] = $sql->f('id');
                $aResult['bFound'] = "FOUND";
			 }
			 else
			 {
                $aResult['bFound'] = "NOTFOUND";
			 }
          }
      }
	  return $aResult;
}

function fCheckAllFoldersFiles($file)
{
   global $bFileCheckPassed, $iRowCount;
   
   if (file_exists($file))
   {
      if (is_dir($file))
      {
         $handle = @opendir($file);

         while ($filename = @readdir($handle))
         {
            if ($filename != "." && $filename != "..")
            {
               if (!is_writeable($file . "/" . $filename))
               {

                  $iRowCount++;
                  $PrintLines = $iRowCount % 2;
                  if ($PrintLines == 0)
                  {
                     $sColor = ' bgcolor="#BCE7FA"';
                  }
                  else
                  {
                     $sColor = '';
                  }

			      if (is_dir($file . "/" . $filename))
				  {
                     print("<tr$sColor>\n");
                     print("<td>FOLDER '$file/$filename':</td>\n");
                     print("<td>[<font color=\"red\"> NOT WRITEABLE </font>]</td>\n");
                     print("</tr>\n");
                     $bFileCheckPassed = false;
                     fCheckAllFoldersFiles($file . "/" . $filename);
				  }
				  else
				  {
                     print("<tr$sColor>\n");
                     print("<td>FILE '$file/$filename':</td>\n");
                     print("<td>[<font color=\"red\"> NOT WRITEABLE </font>]</td>\n");
                     print("</tr>\n");
                     $bFileCheckPassed = false;
				  }
               }
            }
         }
         @closedir($handle);
      }
   }
}

function GetFileInfo($PathFile) {
  $TheFileSize = filesize($PathFile);  //get filesize
  $TheFileTime = date("Y-m-d H:i:s", filemtime($PathFile));  //get and fix time of last modifikation
  //$TheFileTime2 = date("M d, Y \a\\t h:i a", filemtime($PathFile));  //get and fix time of last modifikation


  $FileInfo[1] = $TheFileSize;
  $FileInfo[2] = $TheFileTime; //s$modified
  //$FileInfo[3] = $TheFileTime2; //modified

  return $FileInfo;
}


?>
