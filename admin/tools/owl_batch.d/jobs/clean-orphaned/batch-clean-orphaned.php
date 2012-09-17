<?php
/**
 * batch-clean-orphaned (_php) - relocates orphaned files and folders
 * 
 * @Author: Robert Geleta, www.rgeleta.com, from original code by Steve Bourgeois <owl@bozzit.com>
 *
 * @Copyright (c) 2006-2011 Bozz IT Consulting Inc
 *
 * @license Licensed under the GNU GPL. For full terms see the file /DOCS/COPYING.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * See the GNU General Public License for more details.
 *
 *
 *
 * @uses
 *     MySQL database
 *     
 * @see bottom of script for backup table definitions
 * 
 */
// 
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
// INITIALIZE SCRIPT SPECIFIC VARIABLES
//
global $bIsOrphaned;

$CountLines = 0;
//
// *******************************************************************
//
// connect to database
batch_debug_msg2($my_name, "110 connecting to database") ; 
//  
$dblink = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect to database");
//
batch_debug_msg2($my_name, "120 selecting database") ;   
mysql_select_db($default->owl_db_name[$batch_db_active]);


// **************************************************************************
// CLEANUP FOLDERS
// **************************************************************************
//
batch_debug_msg2($my_name, "200 processing folders"); 
//
batch_debug_msg2($my_name, "210 getting list of folders"); 
//$sQuery = "SELECT * FROM folders where id > 1;";
$sQuery = "SELECT * FROM $default->owl_folders_table where id > 1;";
$rReadResult = mysql_query($sQuery);

if (!$rReadResult) 
   {
   		
      die('Invalid query: ' . mysql_error());
   }
//
batch_debug_msg2($my_name, "220 starting folder loop") ;
//
while ($aFolders = mysql_fetch_assoc($rReadResult)) 
   {
  //    print("F: " . $aFolders['name'] . " ID: " . $aFolders['id'] . " Parent: " . $aFolders['parent'] . "");
      $bIsOrphaned = true;
      fCheckIfFolderOrphaned ( $aFolders['parent'] );
      if ($bIsOrphaned)
      {

      // **************************************************************************
      // SAVE THE FOLDER We are about to delete to a backup table
      // **************************************************************************

         $qSaveQuery = "INSERT INTO bckp_folders ( id, name, parent, description, security, groupid, creatorid, password, smodified, linkedto) VALUES (";
         $qSaveQuery .= "'" . $aFolders['id'] . "',";
         $qSaveQuery .= "'" . $aFolders['name'] . "',";
         $qSaveQuery .= "'" . $aFolders['parent'] . "',";
         $qSaveQuery .= "'" . $aFolders['description'] . "',";
         $qSaveQuery .= "'" . $aFolders['security'] . "',";
         $qSaveQuery .= "'" . $aFolders['groupid'] . "',";
         $qSaveQuery .= "'" . $aFolders['creatorid'] . "',";
         $qSaveQuery .= "'" . $aFolders['password'] . "',";
         $qSaveQuery .= "'" . $aFolders['smodified'] . "',";
         $qSaveQuery .= "'" . $aFolders['linkedto'] . "')";

         mysql_query($qSaveQuery);
         if ($default->debug)
         {
            print($qSaveQuery . "\n");
         }

      // **************************************************************************
      // SAVE THE FOLDER ACL's
      // **************************************************************************

//       $qGetAcls = "SELECT * from advanced_acl where folder_id = '" . $aFolders['id'] . "'";
         $qGetAcls = "SELECT * from $default->owl_advanced_acl_table where folder_id = '" . $aFolders['id'] . "'";
         $rReadFolderACL = mysql_query($qGetAcls);
         while ($aFolderACL = mysql_fetch_assoc($rReadFolderACL)) 
         {
            $qSaveQuery = "INSERT INTO bckp_advanced_acl (group_id, user_id, file_id, folder_id, owlread, owlwrite, owlviewlog, owldelete, owlcopy, owlmove, owlproperties, owlupdate, owlcomment, owlcheckin, owlemail, owlrelsearch, owlsetacl, owlmonitor) VALUES (";

            $qSaveQuery .= "'" . $aFolderACL['group_id'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['user_id'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['file_id'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['folder_id'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlread'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlwrite'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlviewlog'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owldelete'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlcopy'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlmove'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlproperties'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlupdate'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlcomment'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlcheckin'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlemail'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlrelsearch'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlsetacl'] . "', ";
            $qSaveQuery .= "'" . $aFolderACL['owlmonitor'] . "')";
            mysql_query($qSaveQuery);

            if ($default->debug)
            {
               print($qSaveQuery . "\n");
            }

         }

//       $qDeleteQuery = "DELETE from advanced_acl where folder_id = '" . $aFolders['id'] . "'";
         $qDeleteQuery = "DELETE from $default->owl_advanced_acl_table where folder_id = '" . $aFolders['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
            print($qDeleteQuery . "\n");
         }
//       $qDeleteQuery = "DELETE FROM folders where id = '" . $aFolders['id'] . "'";
         $qDeleteQuery = "DELETE FROM $default->owl_folders_table where id = '" . $aFolders['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
            print($qDeleteQuery . "\n");
         }

      }

}
batch_debug_msg2($my_name, "290 ending folders") ;
batch_debug_msg2($my_name, "-----------------------------") ;
//
// **************************************************************************
// CLEANUP FILES
// **************************************************************************
batch_debug_msg2($my_name, "300 starting files") ;
//
batch_debug_msg2($my_name, "310 getting list of files") ;
$sQuery = "SELECT * FROM files;";
$rReadResult = mysql_query($sQuery);

if (!$rReadResult) 
{
	die('Invalid query: ' . mysql_error());
}
//
batch_debug_msg2($my_name, "320 looping file list") ;

while ($aFile = mysql_fetch_assoc($rReadResult)) 
   {
      $bIsOrphaned = true;
      if (fCheckIfFileOrphaned ( $aFile['parent'] ))
      {

      // **************************************************************************
      // SAVE THE File We are about to delete to a backup table
      // **************************************************************************

         $qSaveQuery = "INSERT INTO bckp_files (id, name, filename, f_size, creatorid, parent, created, description, metadata, security, groupid, smodified, checked_out, major_revision, minor_revision, url, password, doctype, updatorid, linkedto, approved) VALUES (";
         $qSaveQuery .= "'" . $aFile['id'] . "', ";
         $qSaveQuery .= "'" . $aFile['name'] . "', ";
         $qSaveQuery .= "'" . $aFile['filename'] . "', ";
         $qSaveQuery .= "'" . $aFile['f_size'] . "', ";
         $qSaveQuery .= "'" . $aFile['creatorid'] . "', ";
         $qSaveQuery .= "'" . $aFile['parent'] . "', ";
         $qSaveQuery .= "'" . $aFile['created'] . "', ";
         $qSaveQuery .= "'" . $aFile['description'] . "', ";
         $qSaveQuery .= "'" . $aFile['metadata'] . "', ";
         $qSaveQuery .= "'" . $aFile['security'] . "', ";
         $qSaveQuery .= "'" . $aFile['groupid'] . "', ";
         $qSaveQuery .= "'" . $aFile['smodified'] . "', ";
         $qSaveQuery .= "'" . $aFile['checked_out'] . "', ";
         $qSaveQuery .= "'" . $aFile['major_revision'] . "', ";
         $qSaveQuery .= "'" . $aFile['minor_revision'] . "', ";
         $qSaveQuery .= "'" . $aFile['url'] . "', ";
         $qSaveQuery .= "'" . $aFile['password'] . "', ";
         $qSaveQuery .= "'" . $aFile['doctype'] . "', ";
         $qSaveQuery .= "'" . $aFile['updatorid'] . "', ";
         $qSaveQuery .= "'" . $aFile['linkedto'] . "', ";
         $qSaveQuery .= "'" . $aFile['approved'] . "') ";

         mysql_query($qSaveQuery);
         if ($default->debug)
         {
            print($qSaveQuery . "\n");
         }

      // **************************************************************************
      // SAVE THE FILE ACL's
      // **************************************************************************

         //GetAcls = "SELECT * from advanced_acl where file_id = '" . $aFile['id'] . "'";
         $qGetAcls = "SELECT * from $default->owl_advanced_acl_table where file_id = '" . $aFile['id'] . "'";
         $rReadFileACL = mysql_query($qGetAcls);
         while ($aFileACL = mysql_fetch_assoc($rReadFileACL)) 
         {
            $qSaveQuery = "INSERT INTO bckp_advanced_acl (group_id, user_id, file_id, folder_id, owlread, owlwrite, owlviewlog, owldelete, owlcopy, owlmove, owlproperties, owlupdate, owlcomment, owlcheckin, owlemail, owlrelsearch, owlsetacl, owlmonitor) VALUES (";

            $qSaveQuery .= "'" . $aFileACL['group_id'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['user_id'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['file_id'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['folder_id'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlread'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlwrite'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlviewlog'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owldelete'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlcopy'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlmove'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlproperties'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlupdate'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlcomment'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlcheckin'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlemail'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlrelsearch'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlsetacl'] . "', ";
            $qSaveQuery .= "'" . $aFileACL['owlmonitor'] . "')";
            mysql_query($qSaveQuery);
            if ($default->debug)
            {
               print($qSaveQuery . "\n");
            }

         }


      // **************************************************************************
      // SAVE THE FILE Checksum
      // **************************************************************************
//       $qGetChecksum = "SELECT * from file_checksum where file_id = '" . $aFile['id'] . "'";
         $qGetChecksum = "SELECT * from $default->owl_file_hash_table where file_id = '" . $aFile['id'] . "'";
         $rReadFileCheckSum = mysql_query($qGetChecksum);
         while ($aFileCheckSum = mysql_fetch_assoc($rReadFileCheckSum))
         {
            $qSaveQuery = "INSERT INTO bckp_file_checksum (file_id, hash1, hash2, hash3, signature) VALUES (";
            $qSaveQuery .= "'" . $aFileCheckSum['file_id'] . "', ";
            $qSaveQuery .= "'" . $aFileCheckSum['hash1'] . "', ";
            $qSaveQuery .= "'" . $aFileCheckSum['hash2'] . "', ";
            $qSaveQuery .= "'" . $aFileCheckSum['hash3'] . "', ";
            $qSaveQuery .= "'" . $aFileCheckSum['signature'] . "')";
            mysql_query($qSaveQuery);
            if ($default->debug)
            {
               print($qSaveQuery . "\n");
            }
         }

      // **************************************************************************
      // SAVE THE FILE DATA
      // **************************************************************************

//       $qGetData = "SELECT * from filedata where id = '" . $aFile['id'] . "'";
         $qGetData = "SELECT * from $default->owl_files_data_table where id = '" . $aFile['id'] . "'";
         $rReadFileData = mysql_query($qGetData);
         while ($aFileData = mysql_fetch_assoc($rReadFileData))
         {
            $qSaveQuery = "INSERT INTO bckp_filedata (id, compressed, data) VALUES (";
            $qSaveQuery .= "'" . $aFileData['id'] . "', ";
            $qSaveQuery .= "'" . $aFileData['compressed'] . "', ";
            $qSaveQuery .= "'" . addslashes($aFileData['data']) . "')";
            mysql_query($qSaveQuery);
            if ($default->debug)
            {
               print($qSaveQuery . "\n");
            }
         }


//       $qDeleteQuery = "DELETE from filedata where id = '" . $aFile['id'] . "'";
         $qDeleteQuery = "DELETE from $default->owl_files_data_table where id = '" . $aFile['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
            print($qDeleteQuery . "\n");
         }
//       $qDeleteQuery = "DELETE from advanced_acl where file_id = '" . $aFile['id'] . "'";
         $qDeleteQuery = "DELETE from $default->owl_advanced_acl_table where file_id = '" . $aFile['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
           print($qDeleteQuery . "\n");
         }
//       $qDeleteQuery = "DELETE from file_checksum where file_id = '" . $aFile['id'] . "'";
         $qDeleteQuery = "DELETE from $default->owl_file_hash_table where file_id = '" . $aFile['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
            print($qDeleteQuery . "\n");
         }
//       $qDeleteQuery = "DELETE FROM files where id = '" . $aFile['id'] . "'";
         $qDeleteQuery = "DELETE FROM $default->owl_files_table where id = '" . $aFile['id'] . "'";
         mysql_query($qDeleteQuery);
         if ($default->debug)
         {
            print($qDeleteQuery . "\n");
         }

      }

}
//
batch_debug_msg2($my_name, "390 ending files") ;
//
// **************************************************************************
//
batch_debug_msg2($my_name, "400 freeing up database") ;
mysql_free_result($rReadResult);
//
// *******************************************************************************************
//
// FINALIZE LOGS
//
// finalize script log
batch_log_msg2($my_name, "900 exiting") ;
echo "\n" ;
//
// **************************************************************************
//
function fCheckIfFileOrphaned ( $currentparent )
{
   global $default, $bIsOrphaned;
   global $batch_db_active ;
   //
   $dblink = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect to database");
   mysql_select_db($default->owl_db_name[$batch_db_active]);

// $sQuery ="select id from folders where id='$currentparent' ";
   $sQuery ="select id from $default->owl_folders_table where id='$currentparent' ";
   $rReadResult = mysql_query($sQuery);
   $num_rows = mysql_num_rows($rReadResult); 
   if ($num_rows == 1)
   {
      return false;
   }
   else
   {
      return true;
   }
}
//
// **************************************************************************
//
function fCheckIfFolderOrphaned ( $currentparent )
{
   global $default, $bIsOrphaned;
   global $batch_db_active ;

   if ($currentparent == 1)
   {
         $bIsOrphaned = false;
         return;
   }

   $dblink = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect to database");
   mysql_select_db($default->owl_db_name[$batch_db_active]);

// $sQuery ="select id,name,parent from folders where id='$currentparent' ";
   $sQuery ="select id,name,parent from $default->owl_folders_table where id='$currentparent' ";
   $rReadResult = mysql_query($sQuery);

   if (!$rReadResult) 
   {
      die('Invalid query: ' . mysql_error());
   }
    
   while ($aFolders = mysql_fetch_assoc($rReadResult)) 
   {
      if (!$bIsOrphaned)
      {
         break;
      }
      if ($aFolders['parent'] == 1 or ($aFolders['id'] == 1 and $aFolders['parent'] == 0))
      {
         $bIsOrphaned = false;
         break;
      }
      fCheckIfFolderOrphaned ($aFolders['parent']);
   }
}
//
// **************************************************************************
//

/**
 * tables required to use the backup feature:
 * 
The follow files have to be created they are copies of the owl tables


CREATE TABLE bckp_advanced_acl (
  group_id int(4) default NULL,
  user_id int(4) default NULL,
  file_id int(4) default NULL,
  folder_id int(4) default NULL,
  owlread int(4) default '0',
  owlwrite int(4) default '0',
  owlviewlog int(4) default '0',
  owldelete int(4) default '0',
  owlcopy int(4) default '0',
  owlmove int(4) default '0',
  owlproperties int(4) default '0',
  owlupdate int(4) default '0',
  owlcomment int(4) default '0',
  owlcheckin int(4) default '0',
  owlemail int(4) default '0',
  owlrelsearch int(4) default '0',
  owlsetacl int(4) default '0',
  owlmonitor int(4) default '0',
  KEY acl_folderid (folder_id),
  KEY acl_fileid (file_id),
  KEY acl_userid (user_id),
  KEY acl_groupid_index (group_id)
) TYPE=MyISAM;

CREATE TABLE bckp_comments (
  id int(4) NOT NULL auto_increment,
  fid int(4) NOT NULL default '0',
  userid int(4) default NULL,
  comment_date datetime NOT NULL default '0000-00-00 00:00:00',
  comments text NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE bckp_docfieldvalues (
  id int(4) NOT NULL auto_increment,
  file_id int(4) NOT NULL default '0',
  field_name varchar(80) NOT NULL default '',
  field_value text NOT NULL,
  PRIMARY KEY  (id),
  KEY docvalue_fileid (file_id)
) TYPE=MyISAM;

CREATE TABLE bckp_file_checksum (
  file_id int(4) NOT NULL default '0',
  hash1 text,
  hash2 text,
  hash3 text,
  signature text,
  PRIMARY KEY  (file_id)
) TYPE=MyISAM;

-- Table structure for table `filedata`
--

CREATE TABLE bckp_filedata (
  id int(4) NOT NULL default '0',
  compressed int(4) NOT NULL default '0',
  data longblob,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Dumping data for table `filedata`
--


--
-- Table structure for table `files`
--

CREATE TABLE bckp_files (
  id int(4) NOT NULL auto_increment,
  name varchar(255) default NULL,
  filename varchar(255) NOT NULL default '',
  f_size bigint(20) NOT NULL default '0',
  creatorid int(4) NOT NULL default '0',
  parent int(4) NOT NULL default '0',
  created datetime NOT NULL default '0000-00-00 00:00:00',
  description text NOT NULL,
  metadata text NOT NULL,
  security int(4) NOT NULL default '0',
  groupid int(4) NOT NULL default '0',
  smodified datetime NOT NULL default '0000-00-00 00:00:00',
  checked_out int(4) NOT NULL default '0',
  major_revision int(4) NOT NULL default '0',
  minor_revision int(4) NOT NULL default '1',
  url int(4) NOT NULL default '0',
  password varchar(50) NOT NULL default '',
  doctype int(4) default NULL,
  updatorid int(4) default NULL,
  linkedto int(4) default NULL,
  approved int(4) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY fileid_index (id),
  KEY parentid_index (parent),
  KEY files_filetype (url)
) TYPE=MyISAM;

--
-- Dumping data for table `files`
--


CREATE TABLE bckp_folders (
  id int(4) NOT NULL auto_increment,
  name varchar(255) NOT NULL default '',
  parent int(4) NOT NULL default '0',
  description text NOT NULL,
  security varchar(5) NOT NULL default '',
  groupid int(4) NOT NULL default '0',
  creatorid int(4) NOT NULL default '0',
  password varchar(50) NOT NULL default '',
  smodified datetime default NULL,
  linkedto int(4) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY folderid_index (id)
) TYPE=MyISAM;

 *
 */
