<?php
/**
 * batch-bigindex.php --  Job that RE-Indexes all files
 *
 * @Author: Robert Geleta www.rgeleta.com
 * adapted from bigindex.php authored by Steve Bourgeois <owl@bozzit.com>
 *
 * @Copyright (c) 1999-2011 The Owl Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 */
// *********************************************************
// EDIT - START
$batch_debug_sw = false ;
// EDIT - END
// *********************************************************
// verify this is only being run in batch mode, exit if not
if (	!empty($_SERVER['HTTP_USER_AGENT']) 
	or  !empty($_SERVER['HTTP_REFERER'])
	)
{
   exit("Sorry");
}
// *********************************************************
// initialize variables
$my_name = basename(__FILE__) ;
// set a start time
$dStartTime = time();
// *********************************************************
//
// load batch config files
$my_dir_batch_root = dirname(dirname(dirname(__FILE__))) ;
require ($my_dir_batch_root . DIRECTORY_SEPARATOR . '/configs/config-batch.inc.php') ;
// this was done in batch_config
// require_once(dirname($my_dir_web_root . "/config/owl.php");
// initialize variables
$my_name = basename(__FILE__) ;
batch_debug_msg2($my_name, "010 starting") ;
// *********************************************************
//
// load additional owl libraries
batch_debug_msg2($my_name, "100 load additional owl libraries") ;
//
batch_debug_msg2($my_name, "110 load alternate disp.lib.php") ;
// require_once($default->owl_fs_root . "/lib/disp.lib.php");
$tmp_file = $my_dir_batch_lib . '/batch-disp.lib.php' ; 
batch_debug_msg2($my_name, "111 requiring file [" . $tmp_file . ']') ;
// require($tmp_file) ;
//
batch_debug_msg2($my_name, "110 load owl.lib.php") ;
require_once($default->owl_fs_root . "/lib/owl.lib.php");
batch_debug_msg2($my_name, "110 load pclzip.lib.php") ;
require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");
//
// *********************************************************
$iVerbose = 1;

// Force DEBUG to FALSE To ensure that the job don't bail out 
$default->debug = false;
//error_reporting (0);
// *********************************************************
// check arguments
batch_debug_msg2($my_name, "200 checking argument counts") ;
$tmp_count_argv = count($argv) ;
batch_debug_msg2($my_name, "210 found [" . $tmp_count_argv . '] args') ;

if (count($argv) == 1 or count($argv) > 4)
{
   die("\nUsage: bigindex.php <mode> <from docid> <to docid>
\tfull\t= Re-Index all documents
\tmissing\t= Re-Index Missing
\tthumbnails\t= Re-Create Thumbnails
\torphan\t= Move Orphaned files to Documents/ORPHANED\n\n");
}
//
$sAction = $argv[1];
// *********************************************************
// check arguments
batch_debug_msg2($my_name, "220 validating arguments") ;
$bFromArg = false;
$bToArg = false;
$sWhere = '';

if (isset($argv[2]))
{
  if (!is_numeric($argv[2]))
  {
     die ("[ERROR]:  From Argument must be Numeric");
  }
  $bFromArg = true;
}

if (isset($argv[3]))
{
  if (!is_numeric($argv[3]))
  {
     die ("[ERROR]:  TO Argument must be Numeric");
  }
  $bTOArg = true;
}
// *********************************************************
// arguments ok, continue
batch_debug_msg2($my_name, "230 args count and type ok, continuing") ;
if ($bFromArg and $bTOArg)
{
   $sWhere = " WHERE id >= '$argv[2]' and id <= '$argv[3]'";
}
else if ($bFromArg)
{
   $sWhere = " WHERE id >= '$argv[2]'";
}

global $default, $index_file;

$index_file = 1;

// *************************************************
// Cron Job configuration
// *************************************************

$default->logging = 1; // Owl logging
$default->log_file = 1; // Cron Job log file
// *********************************************************
// arguments ok, continue
batch_debug_msg2($my_name, "240 check action [" . $sAction . "] against owl config") ;
//
if (strtolower($sAction) == 'full')
{
	batch_debug_msg2($my_name, "241 checking full") ;
    if ($default->turn_file_index_off == 1)
    {
       exit("File Indexing Is NOT Turned ON, Bailing out");
    }
}
else {
	batch_debug_msg2($my_name, "241 not full") ;
}
// -----
if (strtolower($sAction) == 'missing')
{
   $dbCheck = new Owl_DB;
    if ($default->turn_file_index_off == 1)
    {
       exit("File Indexing Is NOT Turned ON, Bailing out");
    }
}
else {
	batch_debug_msg2($my_name, "242 not missing") ;
}
//
batch_debug_msg2($my_name, "250 making qBigIndex from new Owl_DB") ;
$qBigIndex = new Owl_DB;
//
batch_debug_msg2($my_name, "260 checking orphan") ;
if (strtolower($sAction) == 'orphan')
{
	batch_debug_msg2($my_name, "261 action orphan, submitting select") ;
   $dbCheck = new Owl_DB;
   $qBigIndex->query("SELECT id FROM $default->owl_folders_table where name ='ORPHANED' and parent = '1'");
   if ($qBigIndex->num_rows() == 0)
   {
      $sCreated = $qBigIndex->now();
      $qBigIndex->query("INSERT INTO folders (name, parent, security, groupid, creatorid, smodified) VALUES ('ORPHANED',1,'51',0,1,$sCreated)");
      $iDestinationFolderID = $qBigIndex->insert_id($default->owl_folders_table, 'id');
      $qBigIndex->query("INSERT INTO advanced_acl VALUES (NULL,0,NULL,$iDestinationFolderID,1,1,0,0,0,0,0,0,0,0,0,0,0,0)");
      print("\nORPHAN FOLDER CREATED");

   }
   else
   {
      print("\nORPHAN FOLDER ALREADY EXISTS will use this one");
      $qBigIndex->next_record();
      $iDestinationFolderID = $qBigIndex->f("id");
   }
}
batch_debug_msg2($my_name, "269 continuing") ;
// *********************************************************
/*
print("\nStarted On: ");
echo date('l jS \of F Y h:i:s A');
print("\nTYPE: $sAction");
*/
batch_log_msg2($my_name, "300 started, action=[" . $sAction . ']') ;
// *********************************************************
$iPrintFirstID = true;
$qBigIndex->query("SELECT * FROM $default->owl_files_table $sWhere");
while ($qBigIndex->next_record())
{
   if ($iPrintFirstID)
   {
      $iPrintFirstID = false;
      print("\n FIRST ID PROCESSED: " . $qBigIndex->f('id') );
   }
   if (strtolower($sAction) == 'missing')
   {
      $dbCheck->query("SELECT * FROM $default->owl_searchidx where owlfileid ='" . $qBigIndex->f('id') . "'");
      if ($dbCheck->num_rows() > 0)
      {
         if ($iVerbose == 1)
         {
            print("\nSkipping FILE ID(" . $qBigIndex->f('id') . ") Already Indexed");
         }
         continue;
      }
   }
 
  if ($default->owl_use_fs)
  {
    $path = $default->owl_FileDir  . DIR_SEP . get_dirpath($qBigIndex->f('parent')) . "/" . $qBigIndex->f('filename');
  }
  else
  {
    $path = fGetFileFromDatbase($qBigIndex->f('id'));
  }

  $sRepoPath = find_path($qBigIndex->f('parent')) . "/" . $qBigIndex->f('filename');

  if (strtolower($sAction) == 'orphan')
  {
     if (substr($sRepoPath, 0,12) == '[ ORPHANED ]')
     {
        if ($iVerbose == 1)
        {
           print("\n[ MOVING ORPHANED ] (" . $qBigIndex->f('id') . "): " . $qBigIndex->f('filename'));
        }
        $dbCheck->query("UPDATE $default->owl_files_table set parent = '$iDestinationFolderID' where id ='" . $qBigIndex->f('id') . "'");
     }
     else
     {
        if ($iVerbose == 1)
        {
           print("\n[ OK ] (" . $qBigIndex->f('id') . "): $sRepoPath");
        }
     }
  }

  if (strtolower($sAction) == 'full' or strtolower($sAction) == 'missing')
  {
     if ($iVerbose == 1)
     {
        print("\nINDEXING(" . $qBigIndex->f('id') . "): $sRepoPath");
     }
     fIndexAFile($qBigIndex->f('filename'), $path, $qBigIndex->f('id'));
  }
  else
  {
     if ($iVerbose == 1)
     {
        print("\nGEN THUMBNAIL(" . $qBigIndex->f('id') . "): $sRepoPath");
     }
     fGenerateThumbNail($qBigIndex->f('id'));
  }



  if (!$default->owl_use_fs)
  {
     if (file_exists($path))
     {
        unlink($path);
     }
  }
  $iLastID = $qBigIndex->f('id');
}
// *********************************************************
// ended, print statistics
// print("\n LAST ID PROCESSED: " . $iLastID);
echo "\n" ;
batch_log_msg2($my_name, "810 Last ID Processed = [" . $iLastID . ']') ;
//
$diff = time()-$dStartTime;
$minsDiff = floor($diff/60);
$diff -= $minsDiff*60;
$secsDiff = $diff;
/*
print("\nEnded On: ");
echo date('l jS \of F Y h:i:s A');
print("\nElapsed Time: ".$minsDiff.'m '.$secsDiff.'s');
*/
batch_log_msg2($my_name, "820 Elapsed time: " . $minsDiff .'m '. $secsDiff .'s') ;
// print("\n");
batch_log_msg2($my_name, "999 done") ;
echo "\n" ;
?>
