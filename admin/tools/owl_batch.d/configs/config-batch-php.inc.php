<?php
// config-batch-php.inc.php - set up php level settings
//
$my_subconfig_name = basename(__FILE__) ;
batch_debug_msg2($my_subconfig_name, "000 entered") ;
//
// batch_debug_msg2($my_subconfig_name, "110 setting error reporting") ;
// this does not appear to be taking effect from include
// add it in individual script
// error_reporting(E_ALL);
//
batch_debug_msg2($my_subconfig_name, "120 setting display_errors") ;
ini_set("display_errors",true);
//
// batch_debug_msg2($my_subconfig_name, "110 setting error reporting") ;
// this does not appear to be taking effect from include
// we even tried to move it after the display_errors setting
// add it in individual script
error_reporting(E_ALL);
//
batch_debug_msg2($my_subconfig_name, "310 for owl.php - dummy up \$_SERVER vars") ;
$_SERVER = array() ;
// now fill $_SERVER array with values used by scripts
$_SERVER['HTTP_HOST'] = "batch_localhost" ;
//
batch_debug_msg2($my_subconfig_name, "900 exiting") ;
//
// hook gt intentionally omitted
