<?php
/**
 * owlcron.php --  Job that reads an XML file 
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Project Founder: Chris Vincent <cvincent@project802.net>
 *
 * Copyright (c) 1999-2006 The Owl Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * $Id: owlcron.php,v 1.1 2006/09/28 17:35:16 b0zz Exp $
 */


//print_r ( $_SERVER['argv']);
$my_dir_batch_root = dirname(dirname(dirname(__FILE__))) ;
//
// set path to web root directory
require($my_dir_batch_root . "/config-batch-dir-web-root.inc.php") ;
// set path to tmp directory
require($my_dir_batch_root . "/config-batch-dir-tmp.inc.php") ;
//
// load owl config file
require_once($my_dir_web_root . "/config/owl.php");


// following not required, $default is defined at script level
global $default;

// *************************************************
// Constants used for Owl Logging
// *************************************************

define ("LOGIN", "1");
define ("LOGIN_FAILED", "2");
define ("LOGOUT", "3");
define ("FILE_DELETED", "4");
define ("FILE_UPLOAD", "5");
define ("FILE_UPDATED", "6");
define ("FILE_DOWNLOADED", "7");
define ("FILE_CHANGED", "8");
define ("FILE_LOCKED", "9");
define ("FILE_UNLOCKED", "10");
define ("FILE_EMAILED", "11");
define ("FILE_MOVED", "12");
define ("FOLDER_CREATED", "13");
define ("FOLDER_DELETED", "14");
define ("FOLDER_MODIFIED", "15");
define ("FOLDER_MOVED", "16");
define ("FORGOT_PASS", "17");
define ("USER_REG", "18");
define ("FILE_VIEWED", "19");
define ("FILE_VIRUS", "20");
define ("FILE_COPIED", "21");
define ("FOLDER_COPIED", "22");
define ("FILE_LINKED", "23");
define ("USER_ADMIN", "24");
define ("TRASH_CAN", "25");
define ("FILE_ACL", "26");
define ("FOLDER_ACL", "27");


// *************************************************
// Cron Job configuration
// *************************************************

$default->logging = 1; // Owl logging
$default->log_file = 1; // Cron Job log file


//$fJobFile = '/var/www/html/Projects/QBE Brasil/job.xml'; 
$fJobFile = '/var/www/html/owl-0.95/admin/tools/job.xml';
$fLogFile = $my_dir_tmp . '/OwlCronJobLog.log';

// --------------------------------------------------------
class Owl_DB extends DB_Sql
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
// --------------------------------------------------------

require_once($default->owl_fs_root . "/locale/" . $default->owl_lang . "/language.inc");
// --------------------------------------------------------
function fid_to_name($parent)
{
   global $default;
   $sql = new Owl_DB;
   if (empty($parent))
   {
      $parent=0;
   }
   $sql->query("SELECT name from $default->owl_folders_table where id = '$parent'");
   while ($sql->next_record())
   {
      return $sql->f("name");
   }
}
// --------------------------------------------------------
function find_path($parent, $bDisplayOnly = false)
{
   global $default;
   $path = fid_to_name($parent);
   $sql = new Owl_DB;

   if ($bDisplayOnly == true)
   {
      $iStopFolder = $default->HomeDir;
   }
   else
   {
      $iStopFolder = 1;
   }

   while ($parent != $iStopFolder)
   {
      $sql->query("SELECT parent from $default->owl_folders_table where id = '$parent' and 1=1");
      while ($sql->next_record())
      {
         $path = fid_to_name($sql->f("parent")) . "/" . $path;
         $parent = $sql->f("parent");
      }
   }
   return $path;
}
// --------------------------------------------------------
function fLogMessage($fFilePointer, $iBlockID, $Message)
{
   fwrite($fFilePointer, date("F j, Y, g:i:s a") . " -- <BLOCKID: $iBlockID> $Message \n");
}
// --------------------------------------------------------
function owl_syslog($action, $userid, $filename, $logparent, $detail, $type)
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
// --------------------------------------------------------

//print_r($default);

$obj->tree = '$obj->xml';
$obj->xml = '';
// --------------------------------------------------------
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
// --------------------------------------------------------
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
// --------------------------------------------------------
function characterData($parser, $data) 
{
   global $obj;
   eval($obj->tree.'->data=\''.$data.'\';');
}
// --------------------------------------------------------
$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");


if (!($fpLogFile = fopen($fLogFile, "a+"))) 
{
   die("could not open LOG FILE");
}

if (!($fp = fopen($fJobFile, "r"))) 
{
   die("could not open XML input: $fJobFile");
}


while ($data = fread($fp, 4096)) 
{
   if (!xml_parse($xml_parser, $data, feof($fp))) 
   {
       die(sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)));
   }
}

xml_parser_free($xml_parser);

         
foreach ($obj->xml->OWLXML->BLOCK as $aBlock)
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
            if ($default->owl_use_fs == true)
            {

               if (file_exists("$default->owl_FileDir/$sFolderPath/$sFolderName"))
               {
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> " . $owl_lang->err_folder_exist . ": " . "$default->owl_FileDir/$sFolderPath/$sFolderName");
               }
               else
               {
                  mkdir($default->owl_FileDir . "/" . $sFolderPath . "/" . $sFolderName, $default->directory_mask);
               }
   
         
               if (!is_dir("$default->owl_FileDir/$sFolderPath/$sFolderName"))
               {
                  fLogMessage($fpLogFile, $iBlockIdentification, "<ERROR> " . $owl_lang->err_folder_create . ": " . "$default->owl_FileDir/$sFolderPath/$sFolderName");
                  break;
               }
            }
          
   
            $sQuery = "SELECT *  FROM $default->owl_folders_table WHERE name = '$sFolderName' AND parent = '$iParentID'";
            $sql->query($sQuery);
   
            if ($sql->num_rows($sQuery) > 0 )
            {
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
               owl_syslog(FOLDER_CREATED, $OwnerGroup, $sFolderName, $iParentID , "OWL CRON JOB", "FILE");
               $iParentID = $iNewParent;
            }
            $sFolderPath = $sFolderPath . "/" . $sFolderName;
         }
      break;
      case "DELETE FOLDER":
         print("DELETE FOLDER HERE \n");
      break;
      case "MOVE FOLDER":
         print("MOVE FOLDER HERE \n");
      break;
      case "ADD FILE":
         print("ADD FILE HERE \n");
      break;
      case "DELETE FILE":
         print("DELETE FILE HERE \n");
      break;
      case "MOVE FILE":
         print("MOVE FILE HERE \n");
      break;
   }
//   print($aBlock->ACTION->data . "\n");
}

fclose($fpLogFile);

// hook gt intentionally omitted
