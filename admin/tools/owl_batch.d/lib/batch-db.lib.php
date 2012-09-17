<?php
/**
 * batch-db (_lib_php) - batch database library routines
 * 
 * @Author: Robert Geleta, www.rgeleta.com
 *
 * @Copyright (c) 2011 Robert Geleta, The Owl Project Team
 *
 * @license Licensed under the GNU GPL. For full terms see the file /(owl_fs_root)a/DOCS/COPYING.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * See the GNU General Public License for more details.
 *
 * @uses
 * 		batch-msg.lib.php - batch messaging library
 */
// *******************************************************************
function batch_db_table_get_fullname($batch_db_active, $arg_table) 
{
	$my_name = "batch_db_tablename" ;
	//
	global $default ;
	//
	batch_debug_msg2($my_name, "000 entered") ;
	//
	batch_debug_msg2($my_name, "Getting effective name for [" . $arg_table . "] in repository [" . $batch_db_active . "]" ) ;
	$tmp_active_db_tablename = $default->owl_table_prefix . $arg_table ;
	batch_debug_msg2($my_name, "using [" . $tmp_active_db_tablename . "]") ;
	//
	batch_debug_msg2($my_name, "900 exiting") ;
	return($tmp_active_db_tablename) ;
}
// ****************************************************************************
// 'hook gt' purposely omitted: