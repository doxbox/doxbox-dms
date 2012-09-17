<?php
/**
 * batch-msg (_lib_php) - message functions for batch job logs
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
 */
// *********************************************************
function batch_debug_msg2($arg_routine, $arg_msg) {
    //
    global $batch_debug_sw ;
    //
    if (!isset($batch_debug_sw)) {
        $batch_debug_sw = 0 ;
    }
    if ($batch_debug_sw) {
    	batch_log_msg2($arg_routine, $arg_msg) ;
    }
}
// *********************************************************
function batch_log_msg2($arg_routine, $arg_msg) {
    //
    echo "\n" ;
    echo date("Y-m-d_H:i:s") ;
	echo " " ;
    echo "[" . $arg_routine . "]" ;
    echo " " ;
    echo $arg_msg ;
}
// *********************************************************
// 'hook gt' intentionally omitted 
