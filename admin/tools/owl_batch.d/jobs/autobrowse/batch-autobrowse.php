<?php
/**
 * autobrowse (_php) - walk the database and browse all Document objects
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
 */
// *******************************************************************
//
// EDIT - START
$batch_debug_sw = true ;
//
$my_browser_msg_file = "junk-msgs.txt" ;
$my_browser_cmd_1 = "lynx -dump " ;
$my_browser_cmd_2 = "wget --output-file " . $my_browser_msg_file . " --output-document - " ;
if (!isset($my_url_owl_hostname))
{
	echo "\n" . "setting url_owl_root to localhost" ;
	
	$my_url_owl_hostname  = "http://127.0.0.1/" ;
}
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
batch_debug_msg2($my_name, "010 checking batch browser") ;
// 
// $tmp_cmd_array[] = 'lynx -dump "http://127.0.0.1/owl-1.00a/browse.php?sess=$sessid&parent=' . $aFolders['id'] .'&expand=0&order=name&sortname=&curview=0" > /dev/null ';
$tmp_cmd_array[] = $my_browser_cmd_1 . ' "http://127.0.0.1/" > /dev/nul &2>&1 ' ;
$tmp_cmd_array[] = $my_browser_cmd_1 . ' "' . $my_url_owl_hostname . '"' ;
$tmp_cmd_array[] = $my_browser_cmd_1 . ' "' . $my_url_owl_hostname . '" &2>&1 ' ;
$tmp_cmd_array[] = $my_browser_cmd_1 . ' "' . $my_url_owl_hostname . '/"' ;
$tmp_cmd_array[] = $my_browser_cmd_1 . ' "' . $my_url_owl_hostname . '/" &2>&1 ' ;
$tmp_cmd_array[] = $my_browser_cmd_2 . $my_url_owl_hostname ;
//
/*
$tmp_cmd_array[] = array( $my_browser_cmd_1 . ' "', '" > /dev/nul &2>&1 ' ) ;
$tmp_cmd_array[] = array( $my_browser_cmd_1 . ' "', '"' ) ;
$tmp_cmd_array[] = array( $my_browser_cmd_1 . ' "', '" &2>&1 ' ) ;
$tmp_cmd_array[] = array( $my_browser_cmd_1 . ' "', '/"' ) ;
$tmp_cmd_array[] = array( $my_browser_cmd_1 . ' "', '/" &2>&1 ') ;
$tmp_cmd_array[] = array( $my_browser_cmd_2,      , '' );

 */
test_browser_array($tmp_cmd_array) ;
//
// set command to use
$my_browser_cmd_x = $my_browser_cmd_2 ;
// exit ;
$sCommand = $my_browser_cmd_x .  $my_url_owl_hostname  ;
batch_debug_msg2($my_name, "020 browser request is \n" . $sCommand) ;
$tmp_return = submit_browser_request($sCommand);
batch_debug_msg2($my_name, "result=[" . $tmp_return . "]") ;
batch_debug_msg2($my_name, "result len=[" . strlen($tmp_return) . "]" ) ;
if ( strlen($tmp_return) )
{
	batch_debug_msg2($my_name, "031 [" . $my_browser_cmd_x . "] must be working") ;
} else {
	batch_debug_msg2($my_name, "032 [" . $my_browser_cmd_x . "] NOT WORKING") ;
	die("\n" . "Terminating" . "\n") ;
}
//
// *******************************************************************
//
// connect to the database
batch_debug_msg2($my_name, "110 connecting to database") ;
//
// $dblink = mysql_connect($defaults->db_host,$defaults->db_user,$defaults->db_passwd) or die ("could not connect to database");
// mysql_select_db($defaults->db_name);
//
$dblink = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect to database");
batch_debug_msg2($my_name, "112 now selecting database") ;
mysql_select_db($default->owl_db_name[$batch_db_active]) or die("\n" . mysql_error() . "\n" );
//
// *******************************************************************
//
// Create a session
batch_debug_msg2($my_name, "120 creating temporary session") ;
//
$current = time();
$random = $my_name . $current;
$sessid = md5($random);
// $sQuery = "INSERT INTO active_sessions  VALUES ('$sessid', '1', '$current', '$ip', '0')";
$sQuery = "INSERT INTO active_sessions  VALUES ('$sessid', '1', '$current', '127.0.0.1', '0', '0', '0')";
$rReadResult = mysql_query($sQuery);
if (!$rReadResult) 
{
	batch_log_msg2($my_name, '122 query failed [' . mysql_error() ) ;
   die("\n" .'Terminating' . "\n" );
}
batch_debug_msg2($my_name, "129 session id=[" . $sessid . ']') ;
//
// *******************************************************************
//
// Set Look at HD option to true
batch_debug_msg2($my_name, "130 setting Look at HD option to true") ;
//
$sQuery = "UPDATE prefs  set lookathd = 'true'";
$rReadResult = mysql_query($sQuery);
if (!$rReadResult) 
{
	batch_log_msg2($my_name, '132 query failed [' . mysql_error() ) ;
	die("\n" .'Terminating' . "\n" );
}
//
// *******************************************************************
//
batch_debug_msg2($my_name, "300 starting folder walk") ;

// initialize number of passes count
$iNumberPasses = 5;
//
// Walk the database for the number of passes
//
for ($c = 0; $c < $iNumberPasses; $c++)
{
	$tmp_msg_prefix = '(' . "pass [" . $c . "]" . ')' . ' ' ;
	batch_debug_msg2($my_name, $tmp_msg_prefix . "310 starting " ) ;
   $sQuery = "SELECT id FROM folders ";
   $rReadResult = mysql_query($sQuery);

   if (!$rReadResult) 
   {
      die('Invalid query: ' . mysql_error());
   }
    
   while ($aFolders = mysql_fetch_assoc($rReadResult)) 
   {
   		batch_debug_msg2($my_name, $tmp_msg_prefix . 'Checking folder id [' . $aFolders['id'] . ']' ) ;
   		//
		$tmp_url = ""
		. $my_url_owl_hostname 
		. $default->owl_root_url 
		. '/browse.php'
		. '?sess=' . $sessid 
		. '&parent=' . $aFolders['id'] 
		. '&expand=0'
		. '&order=name'
		. '&sortname='
		. '&curview=0'
		. ' '
		;
		batch_debug_msg2($my_name, "320 url \n" . $tmp_url ) ;
		$sCommand = $my_browser_cmd_x . $tmp_url ; 
		submit_browser_request($sCommand);
		//
		$tmp_cmd = "cat " . $my_browser_msg_file ;
		batch_debug_msg2($my_name, "330 cmd \n" . $tmp_cmd ) ;
		exec($tmp_cmd) ;
   }
}
//
// *******************************************************************
// CLEANUP
// *******************************************************************
//
// Reset Look at HD option to false
/*
*/
batch_debug_msg2($my_name, "710 resetting Look at HD option") ;
//
$sQuery = "UPDATE prefs  set lookathd = 'false'";
$rReadResult = mysql_query($sQuery);
if (!$rReadResult) 
{
   die('Invalid query: ' . mysql_error());
}
//
// *******************************************************************
//
// Remove temporary session
//
$sQuery = "DELETE FROM active_sessions  WHERE sessid = '$sessid'";

$rReadResult = mysql_query($sQuery);

if (!$rReadResult) 
{
   die('Invalid query: ' . mysql_error());
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
// *******************************************************************************************
//
function test_browser_array($arg_cmd_array) {
	$my_name = "test_browser_array" ;
	$tmp_count_total = 0 ;
	$tmp_count_good = 0 ;
	$tmp_count_bad = 0 ;
	foreach ($arg_cmd_array as $cmd_nbr=>$sCommand)
	{
		$tmp_count_total++ ;
		//
		batch_debug_msg2($my_name, "020 browser command is \n" . $sCommand) ;
		$tmp_return = submit_browser_request($sCommand);
		batch_debug_msg2($my_name, "result=[" . $tmp_return . "]") ;
		batch_debug_msg2($my_name, "result len=[" . strlen($tmp_return) . "]" ) ;
		if ( strlen($tmp_return) )
		{
			batch_debug_msg2($my_name, "030 this command worked") ;
			$tmp_count_good++ ;
		} else {
			batch_debug_msg2($my_name, "040 NOT WORKING")  ;
			$tmp_count_bad++ ;
		}
	}
	batch_debug_msg2($my_name, "------------------------") ;
	batch_debug_msg2($my_name, "good: " . $tmp_count_good ) ;
	batch_debug_msg2($my_name, "bad : " . $tmp_count_bad ) ;
	batch_debug_msg2($my_name, "all : " . $tmp_count_total ) ;
	
	echo "\n" ;
}
//
// *******************************************************************************************
//
function submit_browser_request($arg_cmd) {
	$my_name = "submit_browser_request" ;
	//
	batch_debug_msg2($my_name, "000 entered") ;
	//
	$tmp_return = exec($arg_cmd) ;
	batch_debug_msg2($my_name, "result=[" . $tmp_return . "]") ;
	batch_debug_msg2($my_name, "result len=[" . strlen($tmp_return) . "]" ) ;
	//
	return($tmp_return) ;
}
//
// *******************************************************************************************
//
// hook gt intentionally omitted
