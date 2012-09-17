<?php
//
// load main owl configuration file
require_once "../config/owl.php";
//
// load additional owl configuration files
require_once($default->owl_fs_root ."/lib/disp.lib.php");
$default->WebDAV = true;
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
//
require_once "HTTP/WebDAV/Server/owldav.php";
// 
// instantiate owl WebDAV class
$server = new HTTP_WebDAV_Server_owl();
//
// set active database
$my_db_WebDAV = $default->owl_default_db ;
//
// set WebDAV debug to owl debug value
$server->owl_debug = $default->debug;
//
// define debug output file
$server->owl_debugfile = "/tmp/WebDAV.DBG";
//
// define database connection variables
$server->db_host = $default->owl_db_host[$my_db_WebDAV] ;
$server->db_name = $default->owl_db_name[$my_db_WebDAV] ;
$server->db_user = $default->owl_db_user[$my_db_WebDAV] ;
$server->db_passwd = $default->owl_db_pass[$my_db_WebDAV] ;
//
// define documents directory location
$server->base = $default->owl_db_FileDir[$my_db_WebDAV] ;
//
// define WebDAV variables
$server->http_auth_realm = "OWL WebDav Authentication";
$server->dav_powered_by = "OWL Intranet Knowledgebase";
//
// submit the request
$server->ServeRequest($server->base . '/Documents');
//
// hook gt intentionally omitted
