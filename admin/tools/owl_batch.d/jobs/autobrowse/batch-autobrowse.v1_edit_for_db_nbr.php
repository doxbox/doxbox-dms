<?php
/**
 * admin/tools/owl_batch.d/autobrowse/autobrowse.php
 *
 * @Author: Robert Geleta www.rgeleta.com
 * from original code by Steve Bourgeois <owl@bozzit.com>
 *
 * @Copyright (c) 2006-2011 Bozz IT Consulting Inc
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
 * $Id: autobrowse.php,v 1.00 2009/02/02 17:35:16 b0zz Exp $
 */
// ----------------------------------------------------------------------------
/**
 * batch-autobrowse.php
 * 
 * Prerequisites:
 *    MySQL database
 *    lynx command line browser
 *    /dev/nul (*nix bit bucket location)
 *    
 * @abstract
 * 
 */
// *******************************************************************
//
// EDIT - START
$batch_debug_sw = true ;
$my_db_nbr = 0 ;
$my_browser_name = "lynx" ;
// EDIT - END
//
// *******************************************************************
//
// load batch config file
$my_dir_batch_root = dirname(dirname(dirname(__FILE__) ) ) ;
require($my_dir_batch_root . DIRECTORY_SEPARATOR . "configs" . DIRECTORY_SEPARATOR . "config-batch.inc.php");
//
// *******************************************************************
//
$my_name = "batch-autobrowse.php" ;
batch_debug_msg2($my_name, "000 entered") ;
if ($batch_debug_sw)
{
	error_reporting(E_ALL) ;
}
// 
// *******************************************************************
//
batch_debug_msg2($my_name, "010 checking batch browser") ;
// 
// $sCommand = 'lynx -dump "http://127.0.0.1/owl-1.00a/browse.php?sess=$sessid&parent=' . $aFolders['id'] .'&expand=0&order=name&sortname=&curview=0" > /dev/null ';
$sCommand = $my_browser_name . ' -dump "http://127.0.0.1/" > /dev/nul &2>&1 ' ;
$tmp_return = exec($sCommand);
batch_debug_msg2($my_name, "result=[" . $tmp_return . "]") ;
//
// *******************************************************************
//
// connect to the database
batch_debug_msg2($my_name, "110 connecting to database") ;
//
// $dblink = mysql_connect($defaults->db_host,$defaults->db_user,$defaults->db_passwd) or die ("could not connect to database");
// mysql_select_db($defaults->db_name);
//
$dblink = mysql_connect($default->owl_db_host[$my_db_nbr],$default->owl_db_user[$my_db_nbr],$default->owl_db_pass[$my_db_nbr]) or die ("could not connect to database");
batch_debug_msg2($my_name, "112 now selecting database") ;
mysql_select_db($default->owl_db_name[$my_db_nbr]) or die("\n" . mysql_error() . "\n" );
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
      $sCommand = $my_browser_name . ' -dump "http://127.0.0.1/owl-1.00a/browse.php?sess=$sessid&parent=' . $aFolders['id'] .'&expand=0&order=name&sortname=&curview=0" > /dev/null ';
	  exec($sCommand);
   }
}
//
// *******************************************************************
// CLEANUP
// *******************************************************************
//
// Reset Look at HD option to false
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
// *******************************************************************
//
// done
batch_debug_msg2($my_name, "900 exiting") ;
echo "\n" ;
// hook gt intentionally omitted
