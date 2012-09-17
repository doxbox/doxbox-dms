#!/usr/bin/php -q
<?php
/**
 * owlcron.php --  Job that reads an XML file 
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
 * $Id: owlcron.php,v 1.1 2006/09/28 17:35:16 b0zz Exp $
 */


//print_r ( $_SERVER['argv']);
//
// EDIT - START
$my_dir_web_root = "/home/example/domains/owl.example.lan/public_html/owl-1.10-2011-08-31" ; 
$my_dir_tmp      = "/home/example/domains/owl.example.lan/tmp" ;
// EDIT - END
//
require_once($my_dir_web_root . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
//require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/indexing.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");

global $default, $index_file;

$index_file = 1;

// *************************************************
// Constants used for Owl Logging
// *************************************************

//define ("LOGIN", "1");
//define ("LOGIN_FAILED", "2");
//define ("LOGOUT", "3");
//define ("FILE_DELETED", "4");
//define ("FILE_UPLOAD", "5");
//define ("FILE_UPDATED", "6");
//define ("FILE_DOWNLOADED", "7");
//define ("FILE_CHANGED", "8");
//define ("FILE_LOCKED", "9");
//define ("FILE_UNLOCKED", "10");
//define ("FILE_EMAILED", "11");
//define ("FILE_MOVED", "12");
//define ("FOLDER_CREATED", "13");
//define ("FOLDER_DELETED", "14");
//define ("FOLDER_MODIFIED", "15");
//define ("FOLDER_MOVED", "16");
//define ("FORGOT_PASS", "17");
//define ("USER_REG", "18");
//define ("FILE_VIEWED", "19");
//define ("FILE_VIRUS", "20");
//define ("FILE_COPIED", "21");
//define ("FOLDER_COPIED", "22");
//define ("FILE_LINKED", "23");
//define ("USER_ADMIN", "24");
//define ("TRASH_CAN", "25");
//define ("FILE_ACL", "26");
//define ("FOLDER_ACL", "27");
//

// *************************************************
// Cron Job configuration
// *************************************************

$default->logging = 1; // Owl logging
$default->log_file = 1; // Cron Job log file


//$fJobFile = '/var/www/html/Projects/QBE Brasil/job.xml'; 
if (!empty($argv[1]))
{
   $fJobFile = $argv[1];
}
else
{
   $fJobFile = './owl_job.xml';
}
//$fJobFile = '/var/www/html/owl-0.95/admin/tools/job.xml';
$fLogFile = $my_dir_tmp . '/OwlCronJobLog.log';


/* class Owl_DB extends DB_Sql
{
   var $classname = "Owl_DB";
   // Server where the database resides
   var $Host = "";
   // Database name
   var $Database = "";
   // User to access database
   var $User = "";
   // Password for database
   var $Password = "";

   function Owl_DB()
   {
      global $default;
      if(!isset($default->owl_current_db))
      {
         $db = $default->owl_default_db;
      }
      else
      {
         $db = $default->owl_current_db;
      }

      $this->Host = $default->owl_db_host[$db];
      $this->Database = $default->owl_db_name[$db];
      $this->User = $default->owl_db_user[$db];
      $this->Password = $default->owl_db_pass[$db];

   }
   function haltmsg($msg)
   {
      printf("$owl_lang->err_database: %s\n", $msg);
      printf("$owl_lang->err_sql: %s (%s)\n",
         $this->Errno, $this->Error);
   }
}


require_once($default->owl_fs_root . "/locale/" . $default->owl_lang . "/language.inc");
*/

//function fid_to_name($parent)
//{
   //global $default;
   //$sql = new Owl_DB;
   //if (empty($parent))
   //{
      //$parent=0;
   //}
   //$sql->query("SELECT name from $default->owl_folders_table where id = '$parent'");
   //while ($sql->next_record())
   //{
      //return $sql->f("name");
   //}
//}

function fdelTree($fid)
{
   global $fCount, $folderList, $default;
   // delete from database
   $sql = new Owl_DB;
   $del = new Owl_DB;
   $sql->query("DELETE FROM $default->owl_folders_table WHERE id = '$fid'");
   $sql->query("DELETE FROM $default->owl_monitored_folder_table WHERE fid = '$fid'");

   $sql->query("SELECT id FROM $default->owl_files_table WHERE parent = '$fid'");
   // Clean up Comments and Monitored Files from each file we are going to
   // delete
   while ($sql->next_record())
   {
      $iFileid = $sql->f("id");
      $del->query("DELETE FROM $default->owl_monitored_file_table WHERE fid = '$iFileid'");
      $del->query("DELETE FROM $default->owl_comment_table WHERE fid = '$iFileid'");
      if (!$default->owl_use_fs)
      {
         $del->query("DELETE FROM $default->owl_files_data_table  WHERE id = '$iFileid'");
      }
            // Clean up all comments with this file
      $del->query("DELETE FROM $default->owl_docfieldvalues_table WHERE file_id = '$iFileid'");
      // Clean up all linked files
      $del->query("DELETE FROM $default->owl_files_table WHERE linkedto = '$iFileid'");
      // Clean up all linked files
      $del->query("DELETE FROM $default->owl_peerreview_table WHERE file_id = '$iFileid'");
      // Clean Up SEARCH Indexes for this file
      fDeleteFileIndexID($iFileid);
   }

  // Clean up Folder ACL's
   $sql->query("DELETE FROM $default->owl_advanced_acl_table WHERE folder_id = '$fid'");
                                                                                                                                                                
   // Clean up File ACL's
   $sql->query("SELECT id FROM $default->owl_files_table WHERE parent = '$fid'");
   while ($sql->next_record())
   {
      $iFileid = $sql->f("id");
      $del->query("DELETE FROM $default->owl_advanced_acl_table WHERE file_id = '$iFileid'");
   }



   $sql->query("DELETE FROM $default->owl_files_table WHERE parent = '$fid'");

   for ($c = 0; $c < $fCount; $c++)
   {
      if ($folderList[$c][2] == $fid)
      {
         fdelTree($folderList[$c][0]);
      }
   }
}

//function fDeleteFileIndexID($fidtoremove)
//{
   //global $default;
   //$sql = new Owl_DB;
//
   //$sql->query("DELETE from $default->owl_searchidx where owlfileid = $fidtoremove");
//}
//
//function myDelete($file)
//{
   //if (file_exists($file))
   //{
      //if (is_dir($file))
      //{
         //$handle = @opendir($file);
         //while ($filename = @readdir($handle))
         //{
            //if ($filename != "." && $filename != "..")
            //{
               //myDelete($file . "/" . $filename);
            //}
         //}
         //@closedir($handle);
         //@rmdir($file);
      //}
      //else
      //{
         //@unlink($file);
      //}
   //}
//}

//function find_path($parent, $bDisplayOnly = false)
//{
   //global $default;
   //$path = fid_to_name($parent);
   //$sql = new Owl_DB;
//
   //if ($bDisplayOnly === true)
   //{
      //$iStopFolder = $default->HomeDir;
   //}
   //else
   //{
      //$iStopFolder = 1;
   //}
//
   //while ($parent != $iStopFolder)
   //{
      //$sql->query("SELECT parent from $default->owl_folders_table where id = '$parent' and 1=1");
      //while ($sql->next_record())
      //{
         //$path = fid_to_name($sql->f("parent")) . "/" . $path;
         //$parent = $sql->f("parent");
      //}
   //}
   //return $path;
//}

function fLogMessage($fFilePointer, $iBlockID, $Message)
{
   fwrite($fFilePointer, date("F j, Y, g:i:s a") . " -- <BLOCKID: $iBlockID> $Message \n");
}

function fowl_syslog($action, $userid, $filename, $logparent, $detail, $type)
{
   global $default;

   if ($default->logging == 1)
   {
      $sql = new Owl_DB;
      $log = 0;

      $logdate = date("Y-m-d G:i:s");
      $ip = "0"; 

      $agent = "Cron Job";

      if ($default->log_file == 1 && $type == "FILE")
      {
         $log = 1;
      }

      if ($type == "ADMIN")
      {
         $log = 1;
      }

      if ($log == 1)
      {
         if (empty($logparent))
         {
            $logparent = 0;
         }
         $sql->query("INSERT into $default->owl_log_table (userid, filename, action, parent, details, logdate, ip, agent, type) values ('$userid', '$filename', '$action', '$logparent', '$detail', '$logdate', '$ip', '$agent', '$type')");
      }
   }
}


//print_r($default);

$obj->tree = '$obj->xml';
$obj->xml = '';

function startElement($parser, $name, $attrs) 
{
   global $obj;
   // If var already defined, make array
   eval('$test=isset('.$obj->tree.'->'.$name.');');
   if ($test) 
   {
     eval('$tmp='.$obj->tree.'->'.$name.';');
     eval('$arr=is_array('.$obj->tree.'->'.$name.');');
     if (!$arr) 
     {
       eval('unset('.$obj->tree.'->'.$name.');');
       eval($obj->tree.'->'.$name.'[0]=$tmp;');
       $cnt = 1;
     }
     else 
     {
       eval('$cnt=count('.$obj->tree.'->'.$name.');');
     }
     $obj->tree .= '->'.$name."[$cnt]";
   }
   else 
   {
     $obj->tree .= '->'.$name;
   }
   if (count($attrs)) 
   {
       eval($obj->tree.'->attr=$attrs;');
   }
}

function endElement($parser, $name) 
{
   global $obj;
   // Strip off last ->
   for($a=strlen($obj->tree);$a>0;$a--) 
   {
       if (substr($obj->tree, $a, 2) == '->') 
       {
           $obj->tree = substr($obj->tree, 0, $a);
           break;
       }
   }
}

function characterData($parser, $data) 
{
   global $obj;
   eval($obj->tree.'->data=\''.$data.'\';');
}

$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");


if (!($fpLogFile = @fopen($fLogFile, "a+"))) 
{
   die("<SEVERE> LOG FILE could not be Opened JOB Terminating");
}

fLogMessage($fpLogFile, 0, "<INFO> START JOB for: " . $fJobFile);
if (!($fp = @fopen($fJobFile, "r"))) 
{
   fLogMessage($fpLogFile, 0, "<SEVERE> JOB XML FILE could not be Oppened Job Terminating");
   fLogMessage($fpLogFile, 0, "<INFO> END JOB for: ". $fJobFile);
   fclose($fpLogFile);
   exit;
}


while ($data = fread($fp, 4096)) 
{
   if (!xml_parse($xml_parser, $data, feof($fp))) 
   {
      fLogMessage($fpLogFile, 0, sprintf("<SEVERE> XML error: %s at line %d", xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)));
      fLogMessage($fpLogFile, 0, "<INFO> END JOB for: ". $fJobFile);
      fclose($fpLogFile);
      exit;
   }
}

xml_parser_free($xml_parser);

$aProcces = array();

if (count($obj->xml->OWLXML->BLOCK) == 1)
{
   $aProccess = $obj->xml->OWLXML;
}
else
{
   $aProccess = $obj->xml->OWLXML->BLOCK;
}

foreach ($aProccess as $aBlock)
{
   $sAction = strtoupper($aBlock->ACTION->data);

   //print_r($aBlock);

   $default->owl_current_db = $aBlock->OWLDB->data;
   $default->owl_FileDir  =  $default->owl_db_FileDir[$default->owl_current_db];
   $iBlockIdentification = $aBlock->BLOCKIDENTIFICATION->data;
   switch ($sAction)
   {
      case "ADD FOLDER":
         $sql = new Owl_DB;
         $sql->Halt_On_Error = "no";
         $smodified = $sql->now();
         $sFolderName = $aBlock->NAME->data;
         $iParentID = $aBlock->PARENTID->data;
         $sDescription = $aBlock->DESCRIPTION->data;
         $iOwnerGroup = $aBlock->OWNERGROUP->data;
         $iOwner = $aBlock->OWNER->data;


         $sFolderPath = find_path($iParentID);


         // if we are storing to the file system 
         // do proper error checking

         $sFolderLists = split("\/", $sFolderName);
         foreach ($sFolderLists as $sFolderName)
         {

// if Owl USER FS Check if the file EXISTS on the Filesystem
            if ($default->owl_use_fs === true)
            {

               if (file_exists("$default->owl_FileDir/$sFolderPath/$sFolderName"))
               {
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> Folder Already exists on the File System: " . "$default->owl_FileDir/$sFolderPath/$sFolderName");
               }
               else
               {
                  mkdir($default->owl_FileDir . "/" . $sFolderPath . "/" . $sFolderName, $default->directory_mask);
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> Folder Created" . "$default->owl_FileDir/$sFolderPath/$sFolderName");
               }
   
         
               if (!is_dir("$default->owl_FileDir/$sFolderPath/$sFolderName"))
               {
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> Folder Creation Failed" . "$default->owl_FileDir/$sFolderPath/$sFolderName");
                  break;
               }
            }
          
// Now the folder exists on the file system
// Need to add it to the database
// if it doesn't already exists 


            $sQuery = "SELECT *  FROM $default->owl_folders_table WHERE name = '$sFolderName' AND parent = '$iParentID'";
            $sql->query($sQuery);
   
            if ($sql->num_rows($sQuery) > 0 )
            {
               $sql->next_record($sQuery);
               $iParentID = $sql->f("id");
               fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> " . $owl_lang->err_folder_exist . ": " . "$default->owl_FileDir/$sFolderPath/$sFolderName");
            }
            else
            {
               $sQuery = "INSERT INTO $default->owl_folders_table (name,parent,description,groupid,creatorid, smodified) values ('$sFolderName', '$iParentID', '$sDescription', '$iOwnerGroup', '$iOwner', $smodified)";
   
               $sql->query($sQuery);
               $iNewParent = $sql->insert_id();
   
               fLogMessage($fpLogFile, $iBlockIdentification, "<INFO> " . "($sQuery)");
               if (!empty($sql->Error))
               {
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> " . $owl_lang->err_sql . ": " . $sql->Error);
                  rmdir($default->owl_FileDir . "/" . $sFolderPath . "/" . $sFolderName);
                  break;
               }
               fLogMessage($fpLogFile, $iBlockIdentification, "<INFO> Folder Was Created: " . "$default->owl_FileDir/$sFolderPath/$sFolderName");
               fowl_syslog(FOLDER_CREATED, $OwnerGroup, $sFolderName, $iParentID , "OWL CRON JOB", "FILE");
               $iParentID = $iNewParent;
            }
            $sFolderPath = $sFolderPath . "/" . $sFolderName;
         }
      break;
      case "DELETE FOLDER":
         $sql = new Owl_DB;
         $sql->Halt_On_Error = "no";
         $ID = $aBlock->ID->data;
         $smodified = $sql->now();
         $sFolderName = $aBlock->NAME->data;
         $iParentID = $aBlock->PARENTID->data;


         // If the ID was provided in this block just delete that
         // That Folder ID
         if (!empty($ID))
         {
            $sQuery = "SELECT *  FROM $default->owl_folders_table WHERE id = '$ID'";
            //print("Q: $sQuery \n");
            $sql->query($sQuery);

            if ($sql->num_rows($sQuery) > 0 )
            {
               $iParentID = $ID;
            }
            else
            {
               $iParentID = 0;
            }
         }
         else
         {
            //$sFolderPath = find_path($iParentID);
            $sFolderLists = split("\/", $sFolderName);
            foreach ($sFolderLists as $sFolderName)
            {
               $sQuery = "SELECT *  FROM $default->owl_folders_table WHERE name = '$sFolderName' AND parent = '$iParentID'";
               //print("Q: $sQuery \n");
               $sql->query($sQuery);

               if ($sql->num_rows($sQuery) > 0 )
               {
                  $sql->next_record($sQuery);
                  $iParentID = $sql->f("id");
               }
               else
               {
                  $iParentID = 0;
                  break;
               }
            }
         }
         if ($iParentID > 1)
         {
            $sql = new Owl_DB;
            $sql->query("SELECT id,name,parent FROM $default->owl_folders_table order by name");
            $fCount = ($sql->nf());
            $i = 0;
            while ($sql->next_record())
            {
               $folderList[$i][0] = $sql->f("id");
               $folderList[$i][2] = $sql->f("parent");
               $i++;
            }

            if ($default->owl_use_fs)
            {
               myDelete($default->owl_FileDir . "/" . find_path($iParentID));
            }

            $log_name = fid_to_name($iParentID);
            fLogMessage($fpLogFile, $iBlockIdentification, "<INFO> Folder Was Deleted: " . "$default->owl_FileDir/". find_path($iParentID));
            fdelTree($iParentID);
            fowl_syslog(FOLDER_DELETED, 1, $log_name, $iParentID, "OWL CRON JOB", "FILE");
         }
         else
         {
               fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> Folder Was NOT FOUND");
         }
      break;

      case "MOVE FOLDER":
         print("MOVE FOLDER HERE \n");
      break;
      
      
      case "ADD FILE":
         $sql = new Owl_DB;
         $sql->Halt_On_Error = "no";
         $sPath = $aBlock->PATH->data;
         $iParentID = fParentFolder($sPath);
         if ($iParentID > 0)
         {
            $smodified = $sql->now();
            $iOwner = $aBlock->OWNER->data;
            $iGroup = $aBlock->GROUPOWNER->data;
            $iMajorVer = (string) $aBlock->MAJORREVISION->data;
            $iMinorVer = (string) $aBlock->MINORREVISION->data;
            $sMetaData = mysql_real_escape_string($aBlock->KEYWORDS->data);
            $sTitle = mysql_real_escape_string($aBlock->TITLE->data);
            $sDocTypeId = fGetDocTypeID($aBlock->DOCUMENTTYPE->data);
            $sDescription = mysql_real_escape_string($aBlock->DESCRIPTION->data);
            $iFileSize = filesize($aBlock->UPLOADFILE->data);  //get filesize
   
            $sFileName = mysql_real_escape_string(basename($aBlock->UPLOADFILE->data));

            $sql->query("SELECT id FROM $default->owl_files_table WHERE filename = '$sFileName' and parent = '$iParentID'");
            if ($sql->num_rows() > 0)
            {
               fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> FILE With That Name Already exists in Owl: " . "$default->owl_FileDir/$sPath/$sFileName");
            }
            else
            {
               $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid,parent,created, description,metadata,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, approved) values ('$sTitle', '$sFileName', '$iFileSize', '$iOwner', '$iOwner', '$iParentID', $smodified,'$sDescription', '$sMetaData', '$iGroup',$smodified,'0','$iMajorVer','$iMinorVer','0','$sDocTypeId','1')");
               $id = $sql->insert_id($default->owl_files_table, 'id');

               if (!$default->owl_use_fs)
               {
                  $fsize = filesize($aBlock->UPLOADFILE->data);

                  $fd = fopen($aBlock->UPLOADFILE->data, 'rb');
                  //$filedata = fread($fd, $fsize);
                  $compressed = $default->owl_compressed_database;
                  $filedata = fEncryptFiledata(fread($fd, $fsize));
                  fclose($fd);
                  if ($id !== null && $filedata)
                  {
                     $sql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$id', '$filedata', '$compressed')");
                  }
               }
               else
               {
                  copy($aBlock->UPLOADFILE->data, $default->owl_FileDir . "/" . $sPath . "/" . $sFileName);
               }
      
               fIndexAFile($sFileName, $default->owl_FileDir . "/" . $sPath . "/" . $sFileName, $id);
      
               //fGenerateThumbNail($id);
      
               $aSetACL[] = $id;
      
               fSetDefaultFileAcl($id);
               fSetInheritedAcl($iParentID, $id, "FILE");
      
   
               fLogMessage($fpLogFile, $iBlockIdentification, "<INFO> File Was Created: " . "$default->owl_FileDir/$sPath/$sFileName");
               fowl_syslog(FILE_UPLOAD, 1, $sFileName, $iParentID , "OWL CRON JOB", "FILE");
            }
            //print("\nADD FILE HERE $iParentID\n");
         }
         else
         {
            fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> FOLDER Does not Exists : " . "$sPath");
         }
      break;
      
      case "DELETE FILE":
         print("DELETE FILE HERE \n");
      break;
      
      case "MOVE FILE":
         print("MOVE FILE HERE \n");
      break;
   }
//print($aBlock->ACTION->data . "\n");
}
fLogMessage($fpLogFile, 0, "<INFO> END JOB for: ". $fJobFile);
fclose($fpLogFile);

function fGetDocTypeID($sName)
{  
   global $default, $owl_lang;
   $sql = new Owl_DB;
   $sql->query("SELECT doc_type_id FROM $default->owl_doctype_table where doc_type_name = '$sName'");

   $sql->next_record();
   return $sql->f("doc_type_id");
}

function fParentFolder($sPath)
{
   global $default, $owl_lang;
   $sql = new Owl_DB;

   $pathArray = explode( "/", $sPath);

   $iNumberOfLevels = count($pathArray);
   $iParent = 0;
   for($i = 0; $i < $iNumberOfLevels; $i++)
   {
      $sql->query("SELECT id FROM folders WHERE name = '" . mysql_real_escape_string($pathArray[$i]) . "' AND parent = '$iParent'");
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

?>
