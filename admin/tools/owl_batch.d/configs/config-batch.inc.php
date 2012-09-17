<?php
/**
 * config-batch (_inc_php) - batch job main configuration file
 * 
 * @Author: Robert Geleta, www.rgeleta.com
 *
 * @Copyright (c) 2011 Robert Geleta
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
//
//  initialize variables
//
$my_name = "config-batch.inc.php" ; // aka __FILE__
// ********************************************************
if (!isset($batch_debug_sw) )
{
	// EDIT - START
	$batch_debug_sw = false ;
	// EDIT - END
}
// ********************************************************
// define directory structure variables
$my_dir_batch_root = dirname(dirname(__FILE__)) ;
$my_dir_batch_configs = $my_dir_batch_root . DIRECTORY_SEPARATOR . "configs" ;
$my_dir_batch_lib     = $my_dir_batch_root . DIRECTORY_SEPARATOR . "lib" ;
//
// ----------------------------------------------------------------------------
//
// load owl batch libraries
require($my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-db.lib.php") ;
require($my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-msg.lib.php");
require($my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-session.lib.php");
require($my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-time.lib.php");
//
// ----------------------------------------------------------------------------
//
// debug routines are now defined, use them to document progress
batch_debug_msg2($my_name, "100 started" ) ;
batch_debug_msg2($my_name, "110 called from (" . $argv[0] . ')' ) ;
/*
batch_debug_msg2($my_name, "120 batch-configs [" . $my_dir_batch_configs . "]") ;
batch_debug_msg2($my_name, "130 batch-lib [" . $my_dir_batch_lib . "]");
batch_debug_msg2($my_name, "130 batch-root [" . $my_dir_batch_root . "]");
*/
//
// ----------------------------------------------------------------------------
//
// get batch configuration for:  php specific settings
batch_debug_msg2($my_name, "200 getting PHP settings") ;
$tmp_file = $my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-php.inc.php" ;
// batch_debug_msg2($my_name, "201 requiring file [" . $tmp_file . ']') ;
require( $tmp_file ) ;
//
// ----------------------------------------------------------------------------
//
// get batch configuration for:  owl application directories 
batch_debug_msg2($my_name, "300 loading Owl directory definitions") ;
require($my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-dir-tmp.inc.php") ;
require($my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-dir-web-root.inc.php") ;
//
// ----------------------------------------------------------------------------
//
// get batch configuration for:  active database
require($my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-db-active.inc.php") ;
//
// ----------------------------------------------------------------------------
//
// get batch configuration for:  date/time formatting
require($my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-date-time-format.inc.php") ;
//
// ----------------------------------------------------------------------------
//
// get batch configuration for:  url for the owl site's hostname
require($my_dir_batch_configs . DIRECTORY_SEPARATOR . "config-batch-url-owl-hostname.inc.php") ;
//
// ----------------------------------------------------------------------------
//
// load the standard owl config file
$tmp_file = $my_dir_web_root . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "owl.php" ;
require($tmp_file);
//
// ----------------------------------------------------------------------------
//
// load owl debug from script debug
if ($batch_debug_sw)
{
	$default->debug_sw = true ;
}
//
// ----------------------------------------------------------------------------
//
// load functions for batch routines to replace online routines
batch_debug_msg2($my_name, "320 load batch-disp.lib.php") ;
// replacement for require_once($default->owl_fs_root . "/lib/disp.lib.php");
$tmp_file = $my_dir_batch_lib . DIRECTORY_SEPARATOR . "batch-disp.lib.php" ;
// batch_debug_msg2($my_name, "321 requiring file [" . $tmp_file . ']') ;
require_once( $tmp_file ) ;
//
// ----------------------------------------------------------------------------
//
// load the Owl general library 
batch_debug_msg2($my_name, "330 load owl.lib.php");
$tmp_file = $default->owl_fs_root. DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "owl.lib.php" ;
// batch_debug_msg2($my_name, "331 requiring file [" . $tmp_file . ']') ;
require_once($tmp_file) ;
//
// ----------------------------------------------------------------------------
//
// load the owl security library
batch_debug_msg2($my_name, "340 load security.lib.php") ;
$tmp_file = $default->owl_fs_root . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "security.lib.php" ;
// batch_debug_msg2($my_name, "341 requiring file [" . $tmp_file . ']') ;
require_once( $tmp_file );
//
// ----------------------------------------------------------------------------
// done
batch_debug_msg2($my_name, '900 exiting') ;
// 'hook gt' purposely omitted
