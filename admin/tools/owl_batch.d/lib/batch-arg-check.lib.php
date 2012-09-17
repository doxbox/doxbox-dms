<?php
/**
 * batch-arg (_lib_php) - library functions for script arguments
 *
 * @Author: Robert Geleta www.rgeleta.com , adapted from bigindex.php authored by Steve Bourgeois <owl@bozzit.com>
 *
 * @Copyright (c) 1999-2011 The Owl Project Team
 * 
 * @license Licensed under the GNU GPL. For full terms see the file /DOCS/COPYING.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * See the GNU General Public License for more details.
 *
 */
// *********************************************************
function batch_arg_check_count(array $arg_array, $arg_min, $arg_max = -1)   
{
	$my_name = "batch_arg_check_count" ;
	// 
	batch_debug_msg2($my_name, "000 entered") ;
	//
	// you always get at least one, that's the caller, subtract that one out
	$tmp_count_args = count($arg_array) - 1;
	//
	batch_debug_msg2($my_name, "210 looking for [" . $arg_min . "] args") ;
	batch_debug_msg2($my_name, "220 found [" . $tmp_count_args . '] args') ;
	batch_debug_msg2($my_name, "230 args=<pre>\n" . print_r($arg_array, true) . "\n" . '</pre>' ) ;
	//
	// start clean
	$tmp_error_status = false ;
	//
	// check minimum required is available
	if (	$tmp_count_args < $arg_min)
	{
		$tmp_error_status = true ;
	} 
	//
	// if good so far
	if ( !$tmp_error_status )
	{
		// if a maximum was specified
		if ($arg_max > 0)
		{
			// check maximum was not exceeded
			if ($tmp_count_args > $arg_max)
			{
				$tmp_error_status = true ;
			}
		}
	}
	//
	//
	batch_debug_msg2($my_name, "800 error status=[" . $tmp_error_status . "]" ) ;
	batch_debug_msg2($my_name, "900 exiting") ;
	//
	return($tmp_error_status) ;
}
//
// *********************************************************
//
function batch_arg_check_numeric($arg_value)
{
	$my_name = "batch_arg_check_numeric" ;
	//
	batch_debug_msg2($my_name, "000 entered") ;
	//
	if ( is_numeric($arg_value) )
	{
		$tmp_error_status = false ;
	} else {
		$tmp_error_status = true ;
	}
	batch_debug_msg2($my_name, "800 error status=[" . $tmp_error_status . "]" ) ;
	batch_debug_msg2($my_name, "900 exiting") ;
	//
	return($tmp_error_status) ;
}
//
// *********************************************************
//
function batch_arg_check_options(array $arg_options, $arg_value )
{
	$my_name = "batch_arg_check_options" ;
	//
	batch_debug_msg2($my_name, "000 entered") ;
	batch_debug_msg2($my_name, "010 Valid options are <pre>" . print_r($arg_options, true) . "</pre>" ) ;
	batch_debug_msg2($my_name, "020 Option supplied is [" . $arg_value . "]") ;
	//
	if ( in_array($arg_value, $arg_options) )
	{
		$tmp_error_status = 0 ;
	} else {
		$tmp_error_status = 1 ;
	}
	batch_debug_msg2($my_name, "800 error status=[" . $tmp_error_status . "]" ) ;
	batch_debug_msg2($my_name, "900 exiting") ;
	//
	return($tmp_error_status) ;
}
//
// *********************************************************
//
function batch_arg_format_array(array $arg_args, array $arg_names)
{
	$my_name = "batch_arg_format_array" ;
	//
	batch_debug_msg2($my_name, "000 entered") ;
	batch_debug_msg2($my_name, "010 args passed \n" . print_r($arg_args, true) . "\n") ;
	batch_debug_msg2($my_name, "020 arg_names \n" . print_r($arg_names, true) . "\n") ;
	//
	$tmp_return = array() ;
	$tmp_unknown_count = 0 ;
	$tmp_count_names = count($arg_names) ;
	$tmp_count_args  = count($arg_args) ;
	//
	$tmp_return["caller"] = $arg_args[0] ;
	//
	batch_debug_msg2($my_name, "200 starting loop") ;
	for ($loop_nbr=1; $loop_nbr < $tmp_count_args; $loop_nbr++  )
	{
		batch_debug_msg2($my_name, "210 checking arg [" . $loop_nbr . "]") ;
		batch_debug_msg2($my_name, "220 value=[" . $arg_args[$loop_nbr] . "]") ;
		$tmp_name_nbr = $loop_nbr - 1 ;
		//
		// if I have any arg names left
		if ($loop_nbr <= $tmp_count_names)
		{
			$tmp_arg_name = $arg_names[$tmp_name_nbr] ;
			// if the name hasn't already been used 
			if ( !array_key_exists($tmp_arg_name, $tmp_return))
			{
				$tmp_return[$tmp_arg_name] = $arg_args[$loop_nbr] ;
			} else {
				die("\n" . "Argument name [" . $tmp_arg_name . "] has already been used") ;
			}
		} else {
			$tmp_unknown_count++ ;
			$tmp_return["arg_" . $loop_nbr] = "unknown_" . $tmp_unknown_count ;
		}
	}
	//
	batch_debug_msg2($my_name, "300 loop done") ;
	batch_debug_msg2($my_name, "310 loop_nbr [" .$loop_nbr . "] count_args [" . count($arg_args) . "]") ;
	if ( $loop_nbr < $tmp_count_args ) 
	{
		batch_debug_msg2($my_name, "390 additional arguments [" . $loop_nbr . "]-[" . $tmp_count_args . "] ignored") ;
	}
	//
	batch_debug_msg2($my_name, "800 result \n" . print_r($tmp_return, true) . "\n") ;
	return($tmp_return) ;
}
//
// *********************************************************
//
// hook gt intentionally omitted