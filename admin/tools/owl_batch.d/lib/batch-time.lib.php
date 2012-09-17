<?php
/**
 * batch-time (_lib_php) -  batch job timer functions
 * 
 * @Author: Robert Geleta, www.rgeleta.com, adapted from bigindex.php by Steve Bourgeois <owl@bozzit.com>
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
 *    *nix time command
 * 
 */
// *********************************************************
function batch_time_format_time($arg_time) 
{
	global $batch_date_time_format;

	if (!isset($batch_date_time_format) )
	{
		$batch_date_time_format = "Y-m-d_H:i:s (DEFAULT NOT SET IN CONFIG)" ;
	} 
	
	$tmp_time_formatted = date($batch_date_time_format, $arg_time) ;
	//
	return( $tmp_time_formatted ) ;
}
// *********************************************************
function batch_time_get_now() 
{
	return( time() ) ;
}
// *********************************************************
function batch_time_get_duration($arg_start, $arg_end)
{
	// $my_name = "batch_time_get_duration" ;
	//
	// batch_debug_msg2($my_name, "000 entered") ;
	//
	$diff_Time = $arg_end - $arg_start;
	//
	$diff_Mins = floor($diff_Time/60);
	$diff_Time -= $diff_Mins*60;
	$diff_Secs = $diff_Time;
	//
	return($diff_Mins .'m'. ' ' . $diff_Secs .'s');
}
// *********************************************************
// hook gt intentionally omitted