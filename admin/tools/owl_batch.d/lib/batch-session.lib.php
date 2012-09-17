<?php
/**
 * batch-session (_lib_php) - Batch session utilities
 * 
 * @Author: Robert Geleta www.rgeleta.com
 *
 * @Copyright (c) 2011 Robert Geleta www.rgeleta.com
 *
 * @license Licensed under the GNU GPL. For full terms see the file /(owl_fs_root)a/DOCS/COPYING.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * See the GNU General Public License for more details.
 *
 * @uses
 *     $default - Owl variable class
 *     batch-msg.lib.php - batch log message utilities 
 * 
*/
// *******************************************************************
function        batch_session_create($batch_db_active) {
    $my_name = "batch_session_create" ;
    //
    global $default ; 
    //
    batch_debug_msg2($my_name, "000 entered") ;
    //
    $my_caller = $argv[0] ;
    batch_debug_msg2($my_name, "010 called from [" . $my_caller . "]") ;
    //
    batch_debug_msg2($my_name, "100 checking default db_link") ;
    if (!isset($default->db_link))  {
        batch_debug_msg2($my_name, "110 creating default db_link");
    	// $default->db_link = mysql_connect($default->db_host,$defaults->db_user,$defaults->db_passwd) or die ($my_name . ": could not connect to database");
		$default->db_link = mysql_connect($default->owl_db_host[$batch_db_active],$default->owl_db_user[$batch_db_active],$default->owl_db_pass[$batch_db_active]) or die ("could not connect to database");
    }
    //
    batch_debug_msg2($my_name, "100 connect to database");
    mysql_select_db($default->owl_db_name[$batch_db_active]);
    
    batch_debug_msg2($my_name, "200 build session_id string");
    $tmp_current_time = time();
    $tmp_random_string = $my_caller . $tmp_current_time;
    $tmp_session_id = md5($tmp_random_string);
    batch_debug_msg2($my_name, "290 session is [" . $tmp_session_id . "]");
    
    batch_debug_msg2($my_name, "300 load session_id into database");
    //
    $tmp_query_sql = "INSERT INTO active_sessions "
            . "\n" . "VALUES ( '$tmp_session_id'
                             , '1'
                             , '$tmp_current_time'
                             , '$ip'
                             , '0'
                             )"
            ;
    $tmp_query_result = mysql_query($tmp_query_sql);
    if (!$tmp_query_result) 
    {
       die($my_name . ': Invalid query: ' . mysql_error());
    }
    
    batch_debug_msg2($my_name, "900 exiting");
    return($tmp_session_id) ;
}
// *******************************************************************
function        batch_session_delete($arg_session) {
    $my_name = "batch_session_delete" ;
    //
    global $defaults ;
    //
    batch_debug_msg2($my_name, "000 entered") ;
  
    $tmp_query_sql = "DELETE FROM active_sessions "
            . "\n" . "WHERE sessid = '" . $arg_session . "'"
            . "\n"
            ;    
        
    $tmp_query_result = mysql_query($tmp_query_sql);    
        
    if (!$tmp_query_result)     
    {    
       die($my_name . ': Invalid query: ' . mysql_error());    
    }    
    batch_debug_msg2($my_name, "900 exiting") ;
         
}        
// *******************************************************************
// 'hook gt' intentionally omitted 
