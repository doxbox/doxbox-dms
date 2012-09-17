<?php
/**
 * batch-del-fs-not-in-db (_php) - delete filesystem files not found in database
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
 */

// *******************************************************************************************
// This script is NOT desiged to work with
// DB only stored files ie owl_use_fs = false
// 
// This script will NOT work with Postgresql
//
// You can run this from your browser on demand or
// you  can setup a cron job to run this script
// at your leisure.
//
// This script was designer to replace the LookAtHD Delete
// Feature. As at some very large site, the LookAtHD Delete
// Feature can degrade the webservers performance. 
//
// Here is an examble of a cron job that runs every half hour.
//
// 59,29 * * * * lynx -dump http://localhost/intranet/admin/tools/hddelcron.php?type=both > /dev/null
//
// This would clean up all delete files and folders from that database
// that have been deleted from the file system.
//
// Hope this is usefull to someone.
//
//	Usage: hddelcron.php?type=ActionType&verbose=DetailLevel
//
//	DetailLevel
//	1 Display Deleted Items
//	0 Silent
//
//	Action Type
// 	file	To delete files from the Database that have been removed from the File System
//	folder 	To delete folders from the Database that have been removed from the File System
//	both 	To delete files and Folders from the Database that have been removed from the File System
//
//
// 	PLEASE BACKUP YOUR DATABASE THIS SCRIPT HAS THE POTENTIAL TO
//   	DELETE ALL FILES AND ALL FOLDER ENTRIES IN YOUR DATABASE.
//
//	mysqldump -u username -p > mydbdump.sql
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
// initialize script logs
$my_name = basename(__FILE__) ;
batch_log_msg2($my_name, "000 started") ;
//
$my_time_start = batch_time_get_now() ;
//
// *******************************************************************************************
//
// CHECK PASSED ARGUMENTS
// load argument check library
require($my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-arg-check.lib.php") ;
// require("batch-arg-check.lib.php") ;
//
// ----------------------------------------------------
//
batch_debug_msg2($my_name, "010 formtting argument names") ;
batch_debug_msg2($my_name, "011 arguments \n" . print_r($argv, true) . "\n") ;
$my_arg_names[] = "action_type" ;
$my_arg_names[] = "detail_level" ;
$my_arg_names[] = "action_type" ;
//
$my_arg_values = batch_arg_format_array($argv, $my_arg_names) ;
// batch_debug_msg2($my_name, "019 arg values \n" . print_r($my_arg_values, true) . "\n") ;
// exit;
//
// ----------------------------------------------------
//
batch_debug_msg2($my_name, "020 checking arguments count") ;
//
if ( batch_arg_check_count($argv, 2) )
{
	echo "\n" . "Program requires options" ;
	print_usage() ;
	die("\n" . "Terminating" . "\n") ;
}
//
// ----------------------------------------------------
//
batch_debug_msg2($my_name, "030 checking <Action Type>") ;
// batch_debug_msg2($my_name, "031 value is [" . $my_arg_values["action_type"] . "]") ;
$my_actions = array("files", "folders", "both") ;
if ( batch_arg_check_options($my_actions, $my_arg_values["action_type"]) )
{
	echo "\n" . "Invalid <Action Type>" ;
	print_usage() ;
	die("\n" . "Terminating" . "\n") ;
}
$type = $my_arg_values["action_type"] ;
//
// ----------------------------------------------------
//
batch_debug_msg2($my_name, "040 checking <Detail Level>") ;
$my_actions = array("Q", "V") ;
if ( batch_arg_check_options($my_actions, $my_arg_values["detail_level"] ) )
{
	echo "\n" . "Invalid <Detail Level>" ;
	print_usage() ;
	die("\n" . "Terminating" . "\n") ;
}
$verbose = $my_arg_values["detail_level"] ;
//
// *******************************************************************************************
//
/*
batch_debug_msg2($my_name, "100 checking php") ;
//
if (substr(phpversion(),0,5) >= "4.1.0")
        import_request_variables('pgc');
 else {
        if (!EMPTY($_POST)) {
                extract($_POST);
        } else {
                extract($HTTP_POST_VARS);
        }
        if (!EMPTY($_GET)) {
                extract($_GET);
        } else {
                extract($HTTP_GET_VARS);
        }
        if (!EMPTY($_FILE)) {
                extract($_FILE);
        } else {
                extract($HTTP_POST_FILES);
        }
}
*/
//
// *******************************************************************************************
//
// check the Documents directory
batch_debug_msg2($my_name, "200 checking documents directory") ;
$tmp_docs_dir = $default->owl_db_FileDir[$batch_db_active] ;
batch_debug_msg2($my_name, "210 looking for \n" . $tmp_docs_dir) ;
if ( !file_exists($tmp_docs_dir) ) 
{
	print("\n" . "Cannot find documents directory") ;
	die("\n" . "Terminating" . "\n") ;
} else {
	batch_debug_msg2($my_name, "290 found it") ;
}
//
// *******************************************************************************************
//
batch_debug_msg2($my_name, "300 main begin") ;
/*
if(isset($type)) {
	if($type == "file") {
		$somethingwasdeleted = delete_db_items_not_found($default->owl_files_table,$verbose,$type);
	} elseif ($type == "folder") {
		$somethingwasdeleted = delete_db_items_not_found($default->owl_folders_table,$verbose,$type);
	} elseif ($type == "both") {
		$somethingwasdeleted = delete_db_items_not_found($default->owl_files_table,$verbose,$type);
		$somethingwasdeleted = delete_db_items_not_found($default->owl_folders_table,$verbose,$type);
	} else {
		print_usage(); 
	}
} else {
	print_usage(); 
}
*/
switch( $my_arg_values["action_type"])
{
	case "files":
		batch_debug_msg2($my_name, "310 option files, starting") ;
		$somethingwasdeleted = delete_db_items_not_found($default->owl_files_table,$verbose,$type);
		break;
	
	case "folders" :
		batch_debug_msg2($my_name, "320 option folders, starting") ;
		$somethingwasdeleted = delete_db_items_not_found($default->owl_folders_table,$verbose,$type);
		break;
	
	case "both" ;
		batch_debug_msg2($my_name, "331 option both, starting files") ;
		$somethingwasdeleted = delete_db_items_not_found($default->owl_files_table,$verbose,$type);
		batch_debug_msg2($my_name, "332 option both, starting folders") ;
		$somethingwasdeleted = delete_db_items_not_found($default->owl_folders_table,$verbose,$type);
		break ;
		
	default:
		echo "\n" . "350 Logic error" ;
		die("\n" . "Terminating" . "\n") ;
}
$my_check_end_time = batch_time_get_now() ;
//
// *******************************************************************************************
//
// SHOW ELAPSED TIME
$my_time_end = batch_time_get_now() ;
batch_log_msg2($my_name, "810 " . batch_time_format_time($my_time_end) . " Ended") ;
batch_log_msg2($my_name, "820 " . batch_time_format_time($my_time_start) . " Started") ;
batch_log_msg2($my_name, "890 Elapsed time: " . batch_time_get_duration($my_time_start, $my_time_end) ) ;
//
// *******************************************************************************************
//
// FINALIZE LOGS
//
// finalize script log
batch_log_msg2($my_name, "900 exiting") ;
echo "\n" ;
//
// *******************************************************************************************
// Functions Section BEGIN
// *******************************************************************************************
//
//
// *******************************************************************************************
//
function print_usage () {
//	print("\n" . "<B>Usage:<B> hd-del.php?type=ActionType&verbose=DetailLevel<br /><br />");

	// print("\n" . "USAGE GOES HERE" . "\n") ;
	// return;
	//
	print("\n" ) ;
	print("\n" . "Usage:");
	print("\n" . "\t" . "hd-del.php <action type> <Detail Level>");

	print("\n" ) ;
	print("\n" . "Where:");
	
	print("\n" ) ;
	print("\n" . "<Action Type> is:");
	print("\n" . "\t" . "what to check in the database and ");
	print("\n" . "\t" . "delete from the Database what is not found");
	print("\n" . "Valid values are:") ;
	print("\n" . "\t" . "files = check only files") ;
	print("\n" . "\t" . "folders = check only folders") ;
	print("\n" . "\t" . "both = check both files and folders") ;

	print("\n" ) ;
	print("\n" . "<Detail Level> is ") ;
	print("\n" . "\t" . "V = Verbose, Display Deleted Items");
	print("\n" . "\t" . "Q = Quiet, Do not display deletions");
	
	print("\n" ) ;
}
//
// *******************************************************************************************
//
function print_usage_online () {
//	print("<B>Usage:<B> hd-del.php?type=ActionType&verbose=DetailLevel<br /><br />");
	print("\n") ;
	print("<B>Usage:<B>hd-del.php <action type> <Detail Level><br /><br />");
	print("<B>DetailLevel<B><br />");
	print("<TABLE>\n");
	print("<TR><TD width=90 align=left><B><font color=red>1</font></B></TD><TD>Display Deleted Items</TD></TR>");
	print("<TR><TD width=90 align=left><B><font color=red>0</font></B></TD><TD>Silent</TD></TR>");
	print("</TABLE><br />");
	
	print("<B>Action Type<B><br />");
	print("<TABLE>\n");
	print("<TR><TD width=90 align=left><B><font color=red>file</font></B></TD><TD>To delete files from the Database that have been removed from the File System </TD></TR>");
	print("<TR><TD width=90 align=left><B><font color=red>folder</font></B></TD><TD>To delete folders from the Database that have been removed from the File System </TD></TR>");
	print("<TR><TD width=90 align=left><B><font color=red>both</font></B></TD><TD>To delete files and Folders from the Database that have been removed from the File System </TD></TR>");
	print("</TABLE>");
}
// *******************************************************************************************
/**
 * Main function that does the work
 * @param unknown_type $table
 * @param unknown_type $verbose
 * @param unknown_type $type
 */
function delete_db_items_not_found($table, $arg_verbose,$type) {
	$my_name = ""
//	. basename(__FILE__) 
//	. '->' 
	. "fn:"
	. "delete_db_items_not_found" 
	;
	//
	global $default;
	global $batch_db_active ;
	//
	batch_debug_msg2($my_name, "000 started") ;
	//
	$tmp_count_deleted = 0 ;
	$tmp_count_checked = 0 ;
	//
	$verbose = strtoupper($arg_verbose) ;
	//
	if($default->owl_files_table == $table) 
	{
		$tmp_checking_what = "Files" ;
	} elseif ($default->owl_folders_table == $table) {
		$tmp_checking_what = "Folders" ;
	} else {
		$tmp_checking_what = "Unknowns" ;
	}
	
	if($verbose == "V") {
		batch_debug_msg2($my_name, "010 " . $tmp_checking_what . " Checking: Begin ...") ;
	}
  	$somethingwasdeleted = false;

	$dblink = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect") ;

  	if ($table == $default->owl_files_table) {
  		$query = "select id,parent,filename from $table where url <> 1";
	} else {
  		$query = "select id,name from $table order by parent desc";
	}

	$get = mysql_db_query($default->owl_db_name[$batch_db_active],$query,$dblink) or die ("GET QUERY FAILED");

	batch_debug_msg2($my_name, "300 starting loop") ;
	while($getrow = mysql_fetch_row ($get)) {
		$tmp_count_checked++ ;
		batch_debug_msg2($my_name, "310 checking item [" . $tmp_count_checked . "]" ) ;
		if ($table == $default->owl_files_table) {
      			$dbfolder = $default->owl_db_FileDir[$batch_db_active] . "/" . get_dirpath($getrow[1]) . "/" . $getrow[2];
   		} else {
      			$dbfolder = $default->owl_db_FileDir[$batch_db_active] . "/" . get_dirpath($getrow[0]);
   		}
   		batch_debug_msg2($my_name, "310 dbfolder=\n" . $dbfolder  ) ;
   		if(!file_exists($dbfolder)) {
     		$delid = $getrow[0];
			$db_del_link = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect") ;
  			$delquery = "delete from $table where id = '$delid'";
			$del = mysql_db_query($default->owl_db_name[$batch_db_active],$delquery,$db_del_link) 
				or die ("DELETE QUERY FAILED");
			if ($table == $default->owl_files_table) 
			{
                // Clean up all monitored files with that id
                $delquery = "DELETE from $default->owl_monitored_file_table where fid = '$delid'";
				$del = mysql_db_query($default->owl_db_name[$batch_db_active],$delquery,$db_del_link) 
					or die ("DELETE MONITORED FILE QUERY FAILED");
                // Clean up all comments with this file 
                $delquery = "DELETE from $default->owl_comment_table where fid = '$delid'";
				$del = mysql_db_query($default->owl_db_name[$batch_db_active],$delquery,$db_del_link) 
					or die ("DELETE COMMENT QUERY FAILED");
            } else {
            	$delquery = "DELETE from $default->owl_monitored_folder_table where fid = '$delid'";
				$del = mysql_db_query($default->owl_db_name[$batch_db_active],$delquery,$db_del_link) 
					or die ("DELETE MONITORED FOLDERQUERY FAILED");
            }
			$somethingwasdeleted = true;
     		$tmp_count_deleted++ ;
			if($verbose == "V") {
					
				if($default->owl_files_table == $table) {
					// print("Deleted file '$dbfolder' from the database<br />");
					batch_log_msg2($my_name, "300 Deleted file '$dbfolder' from the database") ;
				}
				if($default->owl_folders_table == $table) {
					print("Deleted file '$dbfolder' from the database<br />");
				}
			}
   		} else {
   			batch_debug_msg2($my_name, "319 found [" . get_dirpath($getrow[0]) . "]" ) ;
   		}
  	}
    //
    mysql_free_result($get);
    //
    batch_log_msg2($my_name, "800 " . $tmp_checking_what . " Checked [" . $tmp_count_checked . "], Deleted [" . $tmp_count_deleted . "]") ;
	if($verbose == "V") {
		batch_debug_msg2($my_name, "900 " . $tmp_checking_what . " Checking: End") ;
	}

  return $somethingwasdeleted;
}
/*
*/
//
// *******************************************************************************************
//
/**
 * Function that returns the path of the file or folder
 */
/*
function get_dirpath($parent) {
        global $default;
        $name = fid_to_name($parent);
        $navbar = "$name";
        $new = $parent; 
        while ($new != "1") {
        	$dblink = mysql_connect("$default->owl_db_host","$default->owl_db_user","$default->owl_db_pass") or die ("could not connect") ;
		$query = "select parent from $default->owl_folders_table where id = '$new'";
        	$getparent = mysql_db_query($default->owl_db_name,$query,$dblink) or die ("QUERY FAILED");
		$row = mysql_fetch_row ($getparent);
    		mysql_free_result($getparent);
    		mysql_close($dblink);
                $newparentid = $row[0];
                if($newparentid == "") break;
                $name = fid_to_name($newparentid);
                $navbar = "$name/" . $navbar;
                $new = $newparentid;
        }
        return $navbar;
}
*/
//
// *******************************************************************************************
//
/*
 * 2011-09-07 geleta deleted this because of name conflict with owl.lib.php
 */
/*
function fid_to_name($parent) {
        global $default;

        $dblink = mysql_connect("$default->owl_db_host","$default->owl_db_user","$default->owl_db_pass") or die ("could not connect") ;
	$query = "select name from $default->owl_folders_table where id = '$parent'";
        $getname = mysql_db_query($default->owl_db_name,$query,$dblink) or die ("QUERY FAILED");
	$row = mysql_fetch_row ($getname);
    	mysql_free_result($getname);
    	mysql_close($dblink);
        return $row[0];;
}
*/
//
// *******************************************************************************************
//
// hook gt intentionally omitted
