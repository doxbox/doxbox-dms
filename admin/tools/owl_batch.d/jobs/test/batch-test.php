#!/usr/bin/php
<?php
// *******************************************************************
/*
 * OWL Intranet Library - batch-populate.php
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
/*
 * Author: Robert Geleta www.rgeleta.com
 *
 * Copyright (c) 2011 Robert Geleta
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
 * $$
*/
// *******************************************************************
//
// EDIT - START (but don't)
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
// initialize script specific variables
$my_start_time = batch_time_get_now() ;
global $index_file;
$index_file = "1";
//
// *******************************************************************
//
// Dump phpinfo
batch_debug_msg2($my_name, "200 phpinfo ") ;
phpinfo() ;
//
//
// *******************************************************************
//
// Check owl system directories
batch_debug_msg2($my_name, "--------------------------------") ;
batch_debug_msg2($my_name, "300 check owl system directories - start") ;
check_file("\$my_dir_tmp", $my_dir_tmp) ;
check_file("\$my_dir_web_root", $my_dir_web_root) ;
check_file("\$default->owl_fs_root", $default->owl_fs_root) ;
batch_debug_msg2($my_name, "390 check owl system directories - end") ;
//
// *******************************************************************
//
// Check repository document directory locations
batch_debug_msg2($my_name, "--------------------------------") ;
batch_debug_msg2($my_name, "400 check database directories - start") ;
batch_debug_msg2($my_name, "410 batch_active_db=[" . $batch_db_active . "]") ;
check_file("\$default->owl_db_FileDir[$batch_db_active]", $default->owl_db_FileDir[$batch_db_active] ) ;
batch_debug_msg2($my_name, "420 checking all defined Document directories") ;
foreach ( $default->owl_db_FileDir as $db_nbr=>$db_doc_dir)
{
	batch_debug_msg2($my_name, "421 checking db [" . $db_nbr . "]") ;
	check_file("\$default->owl_db_FileDir[" . $db_nbr . "]", $default->owl_db_FileDir[$db_nbr]) ;
}
batch_debug_msg2($my_name, "490 check database directories - done") ;
//
// *******************************************************************
//
// Check time format document directory locations
batch_debug_msg2($my_name, "--------------------------------") ;
batch_debug_msg2($my_name, "500 check time formatting settings - start") ;
$tmp_time_now = batch_time_get_now() ;
batch_debug_msg2($my_name, "Formatted time is [" . batch_time_format_time($tmp_time_now) . "]") ;
batch_debug_msg2($my_name, "590 check time formatting settings - done") ;
//
// *******************************************************************
//
// Check php error reporting settings
batch_debug_msg2($my_name, "--------------------------------");
batch_debug_msg2($my_name, "700 attempting divide by zero") ;
echo "\n" ;
$tmp_zero = 0 ;
$tmp_one  = 1 ;
$tmp_result = $tmp_one / $tmp_zero ;
batch_debug_msg2($my_name, "790 result=[" . $tmp_result . ']') ;
//
// *******************************************************************
//
// Write Job Duration to log
$my_end_time = batch_time_get_now() ;
batch_debug_msg2($my_name,"800 Job duration " . batch_time_get_duration($my_start_time, $my_end_time) ) ;
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
function check_file($arg_parm_name, $arg_parm_value) 
{
	$my_name = basename(__FILE__) . '->' . "check_file" ;
	//
	batch_log_msg2($my_name,"----------------") ;
	batch_debug_msg2($my_name, "000 entered") ;
	batch_log_msg2($my_name, "010 checking [" . $arg_parm_name . "]") ;
	batch_log_msg2($my_name, "020 checking [" . $arg_parm_value . "]") ;
	if (!file_exists($arg_parm_value))
	{
		batch_log_msg2($my_name, "810 checking [" . $arg_parm_name . "] failed") ;
		batch_log_msg2($my_name, "821 looking for [" . $arg_parm_value . "]") ;
		die("\n" . "Terminating" . "\n" ) ;
	} else {
		batch_log_msg2($my_name, "890 Location Found") ;
	}
}
//
// *******************************************************************
//
// 'hook gt' omitted intentionally
