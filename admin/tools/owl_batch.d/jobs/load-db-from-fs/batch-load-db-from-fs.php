<?php
/**
 * batch-load-db-from-fs (_php) - load database info from filesystem files
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

// *******************************************************************
/*
 * OWL Intranet Library - batch-load-db-from-fs.php
 *  
 * Purpose:  
 *     Populate OWL files and folders tables 
 *         from existing filesystem objects
 * 
 * Software Prerequisites:
 *     $defaults - variable defined by caller
 *     $defaults->(database values) set by caller
 *     $owl_work array defined 
 *     batch-debug.lib.php
 * 
 * Preparation
 *     
 *     1. Remove all Thumbnails from $defaults->owl_dir . "/Thumbnails"
 *     2. Start with an empty database
 *     3. Set "Look at HD" variables
 *        a.     
 */
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
	batch_debug_msg2($my_name, "010 setting default db") ;
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
//
// *******************************************************************************************
//
// INITIALIZE SCRIPT SPECIFIC VARIABLES
//
// initialize timer
$my_time_start = batch_time_get_now() ;
//
global $index_file;
$index_file = "1";
//
// *******************************************************************
// this is probably left over from online version
// batch_debug_msg2($my_name, "100 check authorization") ;
// if (!fIsAdmin(true)) die($my_name . ":$owl_lang->err_unauthorized\n");

batch_debug_msg2($my_name, "200 calling fInsertUnzipedFiles") ;
batch_debug_msg2($my_name, "201 ***** Warning! *****") ;
batch_debug_msg2($my_name, "202 If there are a lot of files and folders,") ;
batch_debug_msg2($my_name, "203    this may take a long time ...") ;
echo "\n" ;
//fInsertUnzipedFiles($default->owl_FileDir . DIR_SEP . fid_to_name(1) 
// function is in functions.lib.php
fInsertUnzipedFiles($default->owl_db_FileDir[$batch_db_active] . DIR_SEP . fid_to_name(1) 
					, 1
					, $default->owl_def_fold_security
					, $default->owl_def_file_security
					, ""
					, $default->owl_def_file_group_owner
					, $default->owl_def_file_owner
					, $default->owl_def_file_meta
					, ""
					, 1
					, 0
					, 1
					, $default->use_fs_false_remove_files_on_load
					);
//
// *******************************************************************
//
// Write Job Duration to log
$my_time_end = batch_time_get_now() ;
batch_log_msg2($my_name, "810 " . batch_time_format_time($my_time_end) . " Ended") ;
batch_log_msg2($my_name, "820 " . batch_time_format_time($my_time_start) . " Started") ;
batch_log_msg2($my_name, "890 Elapsed time: " . batch_time_get_duration($my_time_start, $my_time_end) ) ;
//
// *******************************************************************
//
// FINALIZE LOGS
//
// finalize script log
batch_log_msg2($my_name, "900 exiting") ;
echo "\n" ;
//
// *******************************************************************************************
// 'hook gt' omitted intentionally
