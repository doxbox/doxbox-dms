<?php  
/*
 *  File: owl.php
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2006-2009 Bozz IT Consulting Inc
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
 * Copyright (c) 1999-2011 The Owl Project Team
*/
// **********************************************************************
/*
 *                          Config File Organization
 *                          
 * This file is organized with option groups as follows:
 * 
 * PHP Configuration - General PHP Settings
 * Website Locations - URL Locations of OWL folders
 * Filesystem Locations - Filesystem locations of OWL folders
 * Security Options
 *    PHP Safe Mode workaround
 *    Network Access Permissions
 *    User Authentication 
 * Database Options
 *    Database engine independent options
 *    Database engine dependent options
 *    Multiple Repository Database options
 *    Document Storage Options
 * OWL Application Configuration Options
 *    OWL Fixed - Configuration Options (only set in this config file)
 *    OWL Configurable - defaults that can be overridden by user or application administrator
 * Extensions Configuration Parameters - parameters to be passed to third party applications
 * 
 */
$dStartTime = time();
$default = new stdClass();
// **********************************************************************
// ***                      PHP CONFIGURATION                         ***   
// **********************************************************************
//
// TODO: Define this variable
// This should not have to be changed
define( 'OWL_INCLUDE' , '1');
//
// DIRECTORY SEPARATOR
// PHP has an internal variable called DIRECTORY SEPARATOR that is the character used
// by the host system's filesystem to separate components of a file path.
// for example 
//    in *nix systems the "/" character is used
//    in Windows systems the "\" character is used
// If this is provided by your PHP installation, this should not have to be changed 
define('DIR_SEP', DIRECTORY_SEPARATOR);
//

// **********************************************************************
// ***                      OWL WEBSITE LOCATIONS                     ***
// **********************************************************************
//
// *** Site URL Root
// owl_root_url should just contain the portion of the url from the 
// website root (omit the http://servername portion of the url)
$default->owl_root_url		= "/Projects/owl-intranet/doxbox";
// use this line for modified definition and comment prior line
//  
// use $default->owl_root_url to build subdirectory location names
//
// *** Graphics URL Root
// Each graphics set is stored in a separate subdirectory for that set, 
// by default in the â€œgraphicsâ€� subdirectory of the owl root directory.  
// If you change the default graphics subdirectory name or location, 
// modify this parameter to point to the new location:
$default->owl_graphics_url	= $default->owl_root_url . "/templates";
// use this line for modified definition and comment prior line

// **********************************************************************
// ***                  OWL FILESYSTEM LOCATIONS                      ***
// **********************************************************************
//
// *** Site Filesystem Root
// Directory where owl is located
// this is the full physical path to where Owl was installed
// you should not have to change this location
$default->owl_fs_root		= dirname(dirname(__FILE__));
// use this line for modified definition and comment prior line
//

// *** Site Locale Extensions
// By default, language extensions are stored in the locale subdirectory
// If you relocate this directory, change this parameter to point to the new location
$default->owl_LangDir		= $default->owl_fs_root . "/locale";
// use this line for modified definition and comment line above

// *** Version control backup directory
// TODO: define this variable - e.g. what files are stored in this directory
$default->version_control_backup_dir_name = "backup";

// *** Documents directory 
// Directory where uploaded documents are stored on disk
// This is defined in the section
//     DATABASE OPTIONS - MULTIPLE REPOSITORY DEFINITIONS 
// below.

// **********************************************************************
// ***                      SECURITY OPTIONS                          ***
// **********************************************************************

// **********************************************************************
// *** SECURITY OPTIONS - SAFE MODE ISSUES BEGIN
//
// this was added to workaround issues with SAFE MODE TURNED ON.
// check: http://bugs.php.net/bug.php?id=24604

// Sets the Default MASK when OWL Creates a directory;
// HERE is the important bit:
/*
[15 Oct 2004 10:28am CEST] paulo dot matos at fct dot unl dot pt

A workaround/solution to this problem on *nix

Assuming that httpd server runs as apache/apache (uid/gid), and php
script is user/group. 

1) php.ini
safe_mode = On
safe_mode_gid = On

2) Create initial data directory, on install phase as:

mkdir /path/to/datadir
chown user.group /path/to/datadir
chmod 2777 /path/to/datadir

3) Create all subdirectories (within php), like:
mkdir(/path/to/datadir/subdir, 02777);

This way all subdirectry will inherit group from initial parent dir and
SAFE_MODE won't complain, since all subdirs
and files will be apache.group.

IMPORTANT NOTE: After any subdirectory creation you shouldn't change
directory permissions, otherwise it will loose
the GID bit and all files/subdirectories created afterwards won't have
group inherited!

*/

$default->directory_mask = 0777;
$default->file_mask = 0755;

// *****************************************************************************************
// *** SECURITY OPTIONS - NETWORK ACCESS PERMISSIONS
//
$default->anonymous_user_net_access = array();
// uncoment and change the netmasks to match your environment

//$default->anonymous_user_net_access[] = "192.168.11.11/32"; // match specific IP
//$default->anonymous_user_net_access[] = "80.55.132.218/32"; // match specific IP
//$default->anonymous_user_net_access[] = "192.168.11.0/24"; // match subnet 192.168.11.*

// *** Folder item counts
// When this is turned on the the item in the FILE INFO PANEL that reads 
// Special Access that can be set to true.
// If this var is set to true, the ?:? is replaced by actual file and folder counts
// To get those counts it is necessary to traverse the entire files and folders table
// and check if it is in a location that the user cannot browse to. 
// On a large repository this can be a source of performance degradation
// A default value of false is performance related
$default->count_file_folder_special_access = false;

// *** Notification of Administrator Signon
// Owl can be configured to Notify by email when someone signs on to the admin account. 
// By default this feature is turned Off. 
$default->notify_of_admin_login = 0;
// use this line for modified definition and comment line above
//
// *** Notification of Administrator Signon - destination email address
// Prerequisite: notify_of_admin_login = 1 
// $default->notify_of_admin_login_email = "security_manager@yourdomain.com"; 
// use this line for modified definition and comment line above

// **********************************************************************
// *** SECURITY OPTIONS - USER LOGON AUTHENTICATION 
//
// What authentication should Owl use.
// 0 = Old Standard Owl Authentication
// 1 = .htaccess authentication (username must also exists as the Owl users Table)
// 2 = pop3 authentication (username must also exists as the Owl users Table)
// 3 = LDAP authentication (username must also exists as the Owl users Table)
// 4 = Radius authentication (username must also exists as the Owl users Table)

// *** Define Authentication Protocol to use
$default->auth = 0;
// use this line for modified definition and comment line above

// *** Auth 2 (POP3) Additional Options
// What port to be used for authentication
$default->auth_port = "110";
// use this line for modified definition and comment line above
//
// *** Authorization Host address
// Enter the host name or ip address to be used for authentication
$default->auth_host = "127.0.0.1";
// $default->auth_host = "mail.example.com" ;
// use this line for modified definition and comment lines above

// *** Auth 3 (LDAP) Additional Options
// $default->ldapprotocolversion = "3"; // or 2 to match your ldap
// use this line for modified definition and comment line above

// *** Load-balancing proxy option
// If you are behind a load-balanced proxy, thus the IP
// changes, you get an "session in use" error, because
// active sessions are checked against the triple (sessid,uid,ip). 
//
// DEFAULT
// true ---> track it as yet, i.e. (sessid,uid,ip)
//
// false --> track it alternate, i.e. (sessid,uid)
$default->active_session_ip = true;


// **********************************************************************
// ***                       DATABASE OPTIONS                         ***
// **********************************************************************
//
// *** DATABASE OPTIONS - DATABASE INDEPENDENT OPTIONS
//
// *** Table Prefix
// Change this parameter if you want your table names to be have a common prefix. 
// This is recommended when you are sharing a database with other applications.
$default->owl_table_prefix = "";
//$default->owl_table_prefix = "owl_";
// use this line for modified definition and comment line above

// *** TABLE NAMES
// These should be ok as they are defined here
//
// *** Table with user info
$default->owl_users_table		= $default->owl_table_prefix . "users";

// *** Table with group memebership for users 
$default->owl_users_grpmem_table	= $default->owl_table_prefix . "membergroup";
// use this line for modified definition and comment line above

// *** Table with list of active session tokens
// When a user signs on to Owl a session token is created and stored here
// That token is passed from screen to screen to validate that the user is authenticated 
// and that the user is who he or she is 
// The token can include IP address if variable $default->active_session_ip = true;
$default->owl_sessions_table 		= $default->owl_table_prefix . "active_sessions";
// use this line for modified definition and comment line above

// Table with file info
$default->owl_files_table		= $default->owl_table_prefix . "files";
// use this line for modified definition and comment line above

// Table with folders info
$default->owl_folders_table		= $default->owl_table_prefix . "folders";
// use this line for modified definition and comment line above

// Table with group info
$default->owl_groups_table		= $default->owl_table_prefix . "groups";
// use this line for modified definition and comment line above

// Table with mime info
$default->owl_mime_table		= $default->owl_table_prefix . "mimes";
// use this line for modified definition and comment line above

// Table with html attributes
$default->owl_html_table		= $default->owl_table_prefix . "html";
// use this line for modified definition and comment line above

// Table with html attributes
$default->owl_prefs_table		= $default->owl_table_prefix . "prefs";
// use this line for modified definition and comment line above

// Table with file data info
$default->owl_files_data_table  	= $default->owl_table_prefix . "filedata";
// use this line for modified definition and comment line above

// Table with files that are monitored
$default->owl_monitored_file_table  	= $default->owl_table_prefix . "monitored_file";
// use this line for modified definition and comment line above

// Table with folders that are monitored
$default->owl_monitored_folder_table  	= $default->owl_table_prefix . "monitored_folder";
// use this line for modified definition and comment line above

// Table with all logging
$default->owl_log_table  		= $default->owl_table_prefix . "owl_log";
// use this line for modified definition and comment line above

// Table with all user comments
$default->owl_comment_table  		= $default->owl_table_prefix . "comments";
// use this line for modified definition and comment line above

// Table with all news
$default->owl_news_table  		= $default->owl_table_prefix . "news";
// use this line for modified definition and comment line above

// Table with unique words found in any document
$default->owl_wordidx  			= $default->owl_table_prefix . "wordidx";
// use this line for modified definition and comment line above

// Table with search words in owl_wordidx table and the documents they occur in 
$default->owl_searchidx 		= $default->owl_table_prefix . "searchidx";
// Table to track the users Download count
$default->owl_user_downloads            = $default->owl_table_prefix . "user_downloads";


// Custom document types and associated fields

// Table with Custom Document Type Definitions
$default->owl_doctype_table          	= $default->owl_table_prefix . "doctype";
// use this line for modified definition and comment line above
// Table with Custom Document Field Labels (User specified field names)

// Table with Custom Document Field Definitions  
$default->owl_docfields_table		= $default->owl_table_prefix . "docfields";
// use this line for modified definition and comment line above

// Table with Custom Document Field Labels per Locale
$default->owl_docfieldslabel_table	= $default->owl_table_prefix . "docfieldslabel";
// use this line for modified definition and comment line above

// Table with Custom Document Field Values    
$default->owl_docfieldvalues_table	= $default->owl_table_prefix . "docfieldvalues";
// use this line for modified definition and comment line above


// TODO need definition
// Table with 
$default->owl_keyword_table		= $default->owl_table_prefix . "metakeywords";
// use this line for modified definition and comment line above

// Table with Peer Review Flags 
$default->owl_peerreview_table		= $default->owl_table_prefix . "peerreview";
// use this line for modified definition and comment line above

// Table with Old Passwords 
$default->owl_trackpasswd_table		= $default->owl_table_prefix . "trackoldpasswd";
// use this line for modified definition and comment line above

// Table with Advanced ACLs
$default->owl_advanced_acl_table	= $default->owl_table_prefix . "advanced_acl";
// use this line for modified definition and comment line above

// Table with Favorites
$default->owl_user_favorites		= $default->owl_table_prefix . "favorites";
// use this line for modified definition and comment line above

// Table with Document Checksums
$default->owl_file_hash_table		= $default->owl_table_prefix . "file_checksum";
// use this line for modified definition and comment line above

// Table with User Preferences
$default->owl_user_prefs		= $default->owl_table_prefix . "other_userprefs";
// use this line for modified definition and comment line above

//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************

//**********************************************
//Extensions Tables Names BEGIN
//**********************************************
$default->extensions_table_prefix = "ext_";

$default->docRel_table = "docRel";
//**********************************************
//Extensions Tables Names END
//**********************************************

//**********************************************
//User Tables Extension Config Section BEGIN
//**********************************************
$default->userTables_table_prefix = "ut_";
$default->userTables_dictionary = $default->extensions_table_prefix . "dictionary";
$default->userTables_defaultTable = $default->userTables_table_prefix . "entities";
//**********************************************
//User Tables Extension Config Section END
//**********************************************

//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************


// **********************************************************************
// *** DATABASE OPTIONS - DATABASE DEPENDENT OPTIONS
//
// *** Database Engine
// Change this to reflect the database you are using
// Mysql 
require_once("$default->owl_fs_root/phplib/db_mysql.inc");
// Oracle  
//require_once("$default->owl_fs_root/phplib/db_oci8.inc");
// PostgreSQL  
//require_once("$default->owl_fs_root/phplib/db_pgsql.inc");


// **********************************************************************
// *** DATABASE OPTIONS - DATABASE REPOSITORY DEFINITIONS

// *** Default document database
// This variable is used to point to the appropriate DB when no repository database is selected
// or set to a different database where multiple repository databases are available 
$default->owl_default_db = 0;    

/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
 * Notes on documents directories
 *  
 * 1. For security, each documents directory 
 *    (defined by $default_owl_db_FileDir[n] below)
 *    should be located OUTSIDE of the webserver document structure
 *    otherwise any documents in it can be accessed bypassing the OWL security mechanism
 *    
 * 2. Each document directory must be writable by the webserver
 * 
 * 3. When storing documents in the database (instead of on the filesystem)
 *    The $default->owl_db_FileDir[n] must still be defined and that directory
 *    created on the filesystem.  It will be used as the temporary directory
 *    for uploading files prior to adding them to the database
 * 
 * ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::   
 */

// **********************************************************************
// DATABASE[0] - First Database Information - REQUIRED

// DATABASE[0] - Identifier
$default->owl_db_id[0]           = "0";

// DATABASE[0] - Display Name
$default->owl_db_display_name[0]   = "owl Ver. 1.11";

// DATABASE[0] - Filesystem storage Location
// WARNING: CHANGE THIS LOCATION
// WARNING: IF YOU DO NOT CHANGE THIS LOCATION 
//          YOUR DOCUMENTS WILL BE ACCESSIBLE BYPASSING OWL SECURITY 
// This path should not include the directory name "/Documents"
// only the path leading to it.
$default->owl_db_FileDir[0]        =  $default->owl_fs_root;
// $default->owl_db_FileDir[0]        =  "/home/yoursite/documents_00.d" ;

// DATABASE[0] - TODO: Define
$default->peer_auto_publish[0] 	   = "false";

// DATABASE[0] - SECURITY - Connect String Information
$default->owl_db_user[0]           = "root";
//$default->owl_db_user[0]           = "postgres";
$default->owl_db_pass[0]           = "";
$default->owl_db_host[0]           = "localhost";

$default->owl_db_name[0]           = "owl_development";


// DATABASE[0] - SECURITY - LDAP Info
$default->owl_db_ldapserver[0]     = "your.ldap.server.address";
$default->ldapserverroot[0]        = "ou=People,dc=??????,dc=???";
$default->owl_db_ldapuserattr[0]   = "uid"; // OPENLDAP (whatever holds logon name in your ldap schema)
$default->owl_db_ldapdomain[0]     = ""; // MS ADS

// DATABASE[0] - SECURITY - RADIUS Info
$default->owl_db_radiusserver[0]     = "your.radius.server.here";
$default->owl_db_radiussecret[0]     = "radius secret here";

// *** Multiple Repository Database Definitions


// **********************************************************************
// DATABASE[1] - MULTIPLE REPOSITORIES - Second Database Information - OPTIONAL
/*
// DATABASE[1] - Identifier
$default->owl_db_id[1]           = "1";

// DATABASE[1] - Display Name
$default->owl_db_display_name[1]   = "Second Repository";

// DATABASE[1] - Filesystem storage Location
// WARNING: CHANGE THIS LOCATION
// WARNING: IF YOU DO NOT CHANGE THIS LOCATION YOUR DOCUMENTS WILL BE ACCESSIBLE TO ANYONE 
// This path should not include the directory name "/Documents"
// only the path leading to it.
$default->owl_db_FileDir[1]        =  $default->owl_fs_root;
// $default->owl_db_FileDir[1]        =  "/home/yoursite/documents_01.d" ;

// DATABASE[1] - TODO: Define
$default->peer_auto_publish[1] = "false";

// DATABASE[1] - SECURITY - Connect String Information
$default->owl_db_user[1]           = "root";
$default->owl_db_pass[1]           = "";
$default->owl_db_host[1]           = "localhost";
$default->owl_db_name[1]           = "owl_bobg";
$default->owl_db_display_name[1]   = "SecondDB";

// DATABASE[1] - SECURITY - LDAP Info
$default->owl_db_ldapserver[1]     = "your.ldap.server.address";
$default->ldapserverroot[1]        = "ou=People,dc=??????,dc=???";
$default->owl_db_ldapuserattr[1]   = "uid"; // OPENLDAP (whatever holds logon name in your ldap schema)
$default->owl_db_ldapdomain[1]     = ""; // MS ADS

// DATABASE[1] - SECURITY - RADIUS Info
$default->owl_db_radiusserver[1]     = "your.radius.server.here";
$default->owl_db_radiussecret[1]     = "radius secret here";
*/

// **********************************************************************
// DATABASE[2] - MULTIPLE REPOSITORIES - Third Database Information - OPTIONAL
// and so on and so on....

// **********************************************************************
// *** DATABASE OPTIONS - DOCUMENT STORAGE IN DATABSE
//
// *** MySQL Only *** Document storage in filesystem or database
// Use the file system of the database to store the
// files uploaded.
// Note that temporary files are created to gzip files
// so set to something that is valid, and is writable by the web server
// For Example: $default->owl_FileDir           =  "/tmp/OWLDB";
// 
// NOTE: This feature is only functional with MySql
// I don't plan on fixing this unless there is a big demand
// For this feature and Postgres.
// 

$default->owl_use_fs            = true;		// This stores uploaded files to the Hard Drive
// $default->owl_use_fs            = false;		// This stores uploaded files to a table in the database

// *** MySQL Only *** Compress documents in database
// Prerequisite: valid only when using $default->owl_use_fs = false 
// set this parameter to 1 to compress document data before storing to the database
$default->owl_compressed_database = 0;
// use this line for modified definition and comment line above

// *** MySQL Only *** Encrypt documents in database
// Prerequisite: valid only when using $default->owl_use_fs = false 
// set this parameter to 1 to compresses document data prior to loading in the database 
// The encryption used by Owl is _SHA256
$default->owl_encrypt_database = 0;
// use this line for modified definition and comment line above

// *** MySQL Only = Document encryption key
// Prerequisite: valid only when using $default->owl_encrypt_database = 1 ;
// change the value 'SOME SECRET PHRASE' to  
$default->owl_encrypt_keyphrase = 'SOME SECRET PHRASE';
// use this line for modified definition and comment line above

// *** MySQL Only *** Remove files on load
// This is  only for thte initial load action in the admin section
// If an initial load is performed all files in the Documents
// directory structure are loaded to the database. 
// If this variable is set to true 
// the files are deleted from the file system 
// after they are loaded to the BLOB field in the database
$default->use_fs_false_remove_files_on_load = false;
// use this line for modified definition and comment line above

// *** DATABASE OPTIONS - File Hashing 
// This feature calculates a hash value of the file that was uploaded 
// and stores this value in the file_checksum table for future reference
// PREPREQUISITE: mhash.php extensions must be installed
//    You may see an error on file upload if you don't have the proper libraires and php extensions installed

// ** File Hashing Enabled
// 1 = Enabled
// 0 = Disabled
$default->calculate_file_hash = 0;

// *** File Hashing Algorithm
// Up 2 three algorithm
//
// Possible values:
//
/*      
      MHASH_ADLER32
      MHASH_CRC32
      MHASH_CRC32B
      MHASH_GOST
      MHASH_HAVAL128
      MHASH_HAVAL160
      MHASH_HAVAL192
      MHASH_HAVAL256
      MHASH_MD4
      MHASH_MD5
      MHASH_RIPEMD160
      MHASH_SHA1
      MHASH_SHA256
      MHASH_TIGER
      MHASH_TIGER128
      MHASH_TIGER160 
*/

$default->file_hash_algorithm[1] = "MHASH_MD5";
$default->file_hash_algorithm[2] = "MHASH_SHA1";
$default->file_hash_algorithm[3] = "MHASH_RIPEMD160";


// **********************************************************************
// ***     OWL STATIC CONFIGURATION OPTIONS                            ***
// **********************************************************************
// The following options are specified at software installation time
// These options cannot be changed by the application administrator or users
// This major section has the following subsections
//    General Display Options
//    File and Folder Upload Options
//    File and Folder Viewing Options
//    File and Folder Download Options
//    Additional Parameters

// **********************************************************************
// *** OWL STATIC - GENERAL DISPLAY OPTIONS - Footer Display Information
// This is to display the version information in the footer
$default->version = "DoxBox 1.11 (2012-Sep-22)";
$default->site_title = "Document Management System ";
$default->phpversion = "5.3.3";

// **********************************************************************
// *** OWL STATIC - GENERAL DISPLAY OPTIONS - Display Debug Messages
$default->debug = true;

// **********************************************************************
// *** OWL STATIC - GENERAL DISPLAY OPTIONS - Notify Link
// In notifications OWL includes links to files if so configured
// This variable is used to generate that link.
// This can also be sued to generate a link 
// pointing to https:// instead of the default of http://
$default->owl_notify_link = "http://" . $_SERVER['HTTP_HOST'] . $default->owl_root_url . "/";


// **********************************************************************
// *** OWL STATIC - GENERAL DISPLAY OPTIONS - SHOW The Site Logo on the main page
// 0 == Don't show
// 1 == Show Left
// 2 == Show Middle with the Message of the day
// 3 == Shpw Right
$default->logo_location = 1;

// **********************************************************************
// *** OWL STATIC - GENERAL DISPLAY OPTIONS - Popup lifetime
// This sets the popu lifetime 
// default 3000 = 3 seconds
$default->popup_lifetime = 3000;

// **********************************************************************
// *** OWL STATIC - FILE UPLOAD PARAMETERS


// *** VALID FILENAME CHARACTERS
// TODO: replace value with properly created control characters
// BOZZ: Don't know if this was caused by the editor you are 
// BOZZ: using but the contents of the variable are now incorrect... 
// BOZZ: the Accented charcters are all replaced by control chars
// REFERENCE for Asian Character set ranges http://www.localizingjapan.com/blog/2012/01/
// HIRAGANA:      $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:]ぁあぃいぅうぇえぉおかがきぎくぐけげこごさざしじすずせぜそぞただちぢっつづてでとどなにぬねのはばぱひびぴふぶぷへべぺほぼぽまみむめもゃやゅゆょよらりるれろゎわゐゑをんゔゕゖっ゙っ゚゛゜ゝゞゟ()@#$\{}+,&;";
// KANJI:         $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:][\x3400-\x4DB5\x4E00-\x9FCB\xF900-\xFA6A]()@#$\{}+,&;";
// KATAKANA:      $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:][\x30A0-\x30FF]()@#$\{}+,&;";
// HEBREW:        $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:]אבגדהוזחטיכלמנסעפצקרשתךףץם()@#$\{}+,&;";
// RUSSIAN:       $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:]()@#$\{}+,&;ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁёйцукенгшщзхъфывапролджэячсмитьбю";
// DEFAULT:       $default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÐðÏïÑñÒòÓóÔôÕõÖö×÷ØøÙùÚúÛûÜüÝýßÞþÿ()@#$\{}+,&;";
$default->list_of_valid_chars_in_file_names = "-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÐðÏïÑñÒòÓóÔôÕõÖö×÷ØøÙùÚúÛûÜüÝýßÞþÿ()@#$\{}+,&;§";

// **********************************************************************
// *** OWL STATIC - FILE UPLOAD - INDEX ON ADD ARCHIVE
//
// if you want index your documents on add Archive change this to 1
// This was removed as with large ZIP files with a lot of indexable files
// it would cause the Script to time out and/or run out of resources.
// BOZZ: bigindex.php exists now so changed the line below to reflect that
// Run admin/tools/bigindex.php instead.
$default->index_files_on_archive_add = 1;


$default->charset = "UTF-8";

// **********************************************************************
// *** OWL STATIC - FILE UPLOAD - FILTERS FOR LOOK AT HD FEATURE 
// -------------------------------------
//
// *** Exclude filenames with specified extensions
// You can add as many extention as you need.
// and files with the extensions listed are not added to the LookAtHD feature
// 
// Exclude files ending with ".db"
//$default->lookHD_ommit_ext[] = "db";
//
// Exclude files ending with ".txt"
//$default->lookHD_ommit_ext[] = "txt";
//
//
// *** Exclude files in folders with specified names 
// WARNING this applies to defined folder names IN ANY DIRECTORY
$default->lookHD_ommit_directory[] = "CVS";
// use this line for modified definition and comment line above

// *** Exclude files from upload with specified extensions
// This option will exclude files with specified extensions from being uploaded
//$default->upload_ommit_ext[] = "cpl";
//$default->upload_ommit_ext[] = "exe";

// *************************************************************
// *** OWL STATIC - FILE UPLOAD - List of Special DROP ZONE Folders
// The idea here is to allow anybody to upload a document to one or more
// folders, but not retain ownership of the file or Folder.
// This acts similar to an FTP Upload Folder
//
// Security Reference
// '0' Everyone can read/download
// '1' Everyone can read/write/download
// '2' The selected group can read/download
// '3' The selected group can read/write/download
// '4' Only you can read/download/write
// '5' The selected group can read/write/download, NO DELETE
// '6' Everyone can read/write/download, NO DELETE
// '7' selected='selected'>The selected group can read/write/download &amp; everyone else can read
// '8' The selected group can read/write/download (NO DELETE) &amp; everyone else can read
//
//  $default->special_folder_defaults[<FOLDER ID HERE>]
                                                                                                                                                   
//$default->special_folder_defaults[408] = array ( 
//"creatorid" => "5" , 
//"groupid" => "0",
//"description" => "Default Description",
//"metadata" => "Default metadata",
//"security" => "4"
//);


// **********************************************************************
// *** OWL STATIC - FILE UPLOAD - MONITOR SUBFOLDERS
// Should be 1 or 0, for whether monitoring a folder 
// also monitors subfolders under it 
// $default->owl_monitor_subfolders = 0;       // monitor only specified folder 
$default->owl_monitor_subfolders = 1;        // monitor specified folder and all subfolders 

// **********************************************************************
// *** OWL STATIC - FILE UPLOAD - Zip file character conversion
// When a zipfile that was created on Windows with special
// characters and extracted on linux (UTF-8) the special 
// characters did not come through correctly
//$default->convert_from_charset = "IBM437";
//$default->convert_to_charset = "UTF-8";
$default->extract_convert_from_charset = "cp857";
$default->extract_convert_to_charset = "UTF-8";

// **********************************************************************
// *** OWL STATIC - FILE UPLOAD - Word Indexing Exclusion List
// Prerequisite: This is an Owl feature that requires the use of external tools
// such as pdftotext, antiword and catppt
//
// NOTE: a system enhancement request has been logged 
//       to move the list of exclude words from this config file to the database
//       and enable administration by the application administrator
//
$default->words_to_exclude_from_wordidx[] = "the";
$default->words_to_exclude_from_wordidx[] = "a";
$default->words_to_exclude_from_wordidx[] = "is";
$default->words_to_exclude_from_wordidx[] = "on";
$default->words_to_exclude_from_wordidx[] = "or";
$default->words_to_exclude_from_wordidx[] = "he";
$default->words_to_exclude_from_wordidx[] = "she";
$default->words_to_exclude_from_wordidx[] = "his";
$default->words_to_exclude_from_wordidx[] = "her";


// *** Characters to be removed from documents and not added to word index
// the following are removed
// [:punct:] Punctuation symbols . , " ' ? ! ; : # $ % & ( ) * + - / < > = @ [ ] \ ^ _ { } | ~
//
// any none printing characters are also removed
// ^[:print:]	Any NONE printable character.
//
// any number is removed 
// [:digit:]	Only the digits 0 to 9
//
// any word that is less than 3 characters
//
// all accented characters are replaced by the non accented version for storage to the database 
// and for more case incensitve / accent incesitive seraching
// ´é => e  á => a etc...
//
// any other ones you want 
$default->list_of_chars_to_remove_from_wordidx = "©";

// **********************************************************************
// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING 
//
// 
// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING - Default Sort Field
   $default->default_sort_column = "name"; 
// $default->default_sort_column = "major_minor_revision" ;
// $default->default_sort_column = "filename" ;
// $default->default_sort_column = "f_size" ;
// $default->default_sort_column = "creatorid" ;
// $default->default_sort_column = "smodified" ;
// $default->default_sort_column = "sortchecked_out" ;

// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING - Default Sort Order
$default->default_sort_order = "ASC";  // Values are ASC OR DESC

// **********************************************************************
// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING - Item Sorting

// New view folders and files intermixed
// If you set this to 0 then FILES AND Folders are 
// Sorted intermixed ***** NOT fully functional ***********
$default->view_files_then_folders_alpha = 1;

// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING - FILE TYPES - ADDITIONAL FILE TYPE ICONS
//
// This is for adding a view icon to file types
// that are not currently supported by Owl
// DO NOT ADD FILE Types that already have a view icon 
// (the magnifying glass) Or you will end up with 2 of them

//$default->view_other_file_type_inline[] = "Your-Extension-without-the-dot-here";
$default->view_other_file_type_inline[] = "ext";

// *** File types that can be edited inline
// This is a list of file type CONTENTS that can be edited inline
// The tinymce javascript editor is included with the OWL package
// This is a list of  TEXT based formats that timemce can edit
$default->edit_text_files_inline[] = "txt";
$default->edit_text_files_inline[] = "php";
$default->edit_text_files_inline[] = "tpl";
$default->edit_text_files_inline[] = "sql";
$default->edit_text_files_inline[] = "html";

// ************************************************************
// *** OWL STATIC - FOLDER AND DOCUMENT VIEWING - Thumbnail Icons

$default->thumbnails_url = $default->owl_root_url . "/ThumbNails"; // this directory has to be in the webspace
$default->thumbnails_location = $default->owl_fs_root  . "/ThumbNails"; // this directory has to be in the webspace

// *** Video image types that will be processed with mplayer
$default->thumbnail_video_type[] = "avi";
$default->thumbnail_video_type[] = "mpg";
$default->thumbnail_video_type[] = "mpeg";
$default->thumbnail_video_type[] = "mov";

// Image types that will be processed with convert 
$default->thumbnail_image_type[] = "gif";
$default->thumbnail_image_type[] = "jpg";
$default->thumbnail_image_type[] = "jpeg";
$default->thumbnail_image_type[] = "png";
$default->thumbnail_image_type[] = "tiff";
$default->thumbnail_image_type[] = "tif";
$default->thumbnail_image_type[] = "eps";
$default->thumbnail_image_type[] = "ai";
$default->thumbnail_image_type[] = "pdf";
$default->thumbnail_image_type[] = "psd";
$default->thumbnail_image_type[] = "epub";
$default->thumbnail_image_type[] = "docx";
$default->thumbnail_image_type[] = "xlsx";

// **********************************************************************
// *** OWL STATIC - FILE AND FOLDER DOWNLOAD 
// **********************************************************************
// *** OWL STATIC - FILE AND FOLDER DOWNLOAD - Downloaded Filename version option
// When a file is downloaded this will append the Major, Minor version numbers 
// to the downloaded file name
$default->append_doc_version_to_downloaded_files = 0;


// **********************************************************************
// *** OWL STATIC - FILE AND FOLDER DOWNLOAD - Character Set Conversions
// When owl Creates a ZIP File to be download by users 
// this conversion is done on the filenames before they are added to the archive
// WARNING: These are advanced setings.  
// WARNING: They should only be changed if you know what you are doing :)
$default->add_convert_from_charset = "ISO-8859-1";
//
$default->add_convert_to_charset = "cp850";

// **********************************************************************
// *** OWL STATIC - ADDITIONAL PARAMETERS

// **********************************************************************
// *** OWL STATIC - ADDITIONAL PARAMETERS - Include valid session ID on notification email
//  
// OWL users can request to be notified if a file or folder changes
// If this notification option is turned on and a file is uploaded, updated, or deleted
// OWL will generate a Notification email with a link to the file on the owl repository
//
// If this variable is '1' the link to the file in the email will contain a VALID owl session token 
// that should allow the user to click on the link and get to the file without having to sign on.
//
// If this variable is set to 0, when the user clicks on the link
// they are presented with a login screen. Once authenticated OWL will take them to the file 
//
// WARNING: This is a potential security opening, 
// WARNING: Only change the default to 1 if this is appropriate to your installation.
$default->generate_notify_link_session = 0;


// **********************************************************************
// *** OWL STATIC - ADDITIONAL PARAMETERS - Purge Start Age Default
// Default starting point for purge of historical documents
$default->purge_historical_documents_days = 90;

// **********************************************************************
// *** OWL STATIC - ADDITIONAL PARAMETERS - Auto Expiry
// This is for the fileexpiry function
// when that date is reached, the files are 
// Automatically removed from the Owl Repository 
// *************************************************
// adds a column that allows to set a file expiry date
$default->use_file_expiry = 0;

// **********************************************************************
// ***     OWL CONFIGURABLE - USER DEFAULT OPTIONS                    ***
// **********************************************************************
// The following options are specified at software installation time
// These options can be changed by the application administrator or users

// **********************************************************************
// *** OWL CONFIGURABLE - DEFAULT LOCALE
//
// Pick your installation's default language by uncommenting ONE line below
// $default->owl_lang = "b5" ;
// $default->owl_lang = "Brazilian " ;
// $default->owl_lang = "Bulgarian" ;
// $default->owl_lang = "Chinese" ;
// $default->owl_lang = "CVS" ;
// $default->owl_lang = "Czech" ;
// $default->owl_lang = "Danish" ;
// $default->owl_lang = "Deutsch" ;
// $default->owl_lang = "Dutch" ;
   $default->owl_lang = "English" ;
// $default->owl_lang = "Francais" ;
// $default->owl_lang = "Hungarian" ;
// $default->owl_lang = "Italian" ;
// $default->owl_lang = "Norwegian" ;
// $default->owl_lang = "Polish" ;
// $default->owl_lang = "Portuguese" ;
// $default->owl_lang = "Russian" ;
// $default->owl_lang = "Spanish" ;
// 
// WARNING: if more than one line above is uncommented, the last one uncommented will be the detault
// 
// NOTE each user can pick his language
// if they are allowed by the admin to change their
// preferences.

// **********************************************************************
// *** OWL CONFIGURABLE - DEFAULT BUTTON STYLE
//
// This option will defines the default button style for the system and any new users. 
// The value of this parameter is the name of the subdirectory in the $default->owl_graphics_url subdirectory.
// Ensure that the system_ButtonStyle you choose is a style that exists in 
// all locale subdirectories
//
   $default->system_ButtonStyle = "Roma 2011";
// $default->system_ButtonStyle = "rsdx_blue1";
// use this line for modified definition and comment line above

// **********************************************************************
// *** OWL CONFIGURABLE - DEFAULT GLOBAL DATE FORMAT
//
// If you want one date format for all the language files
// set the variable bellow to the date patern of your
// Choice.   If you require a different pattern for 
// different lanugages, edit each language file
// and set your pattern in the Date Format Section of 
// each file
//
//
// Examples of Valid patterns:
  $default->generic_date_format	= "";
//$default->generic_date_format = "Y-m-d";                // 2003-03-07
//$default->generic_date_format = "Y-m-d H:i:s";          // 2003-03-13 16:46:24
//$default->generic_date_format = "r";                    // Thu, 13 Mar 2003 16:46:24 -0500
//$default->generic_date_format = "d-M-Y h:i:s a";        // 13-Mar-2003 04:46:24 pm
//$default->generic_date_format = "Y-m-d\\<\B\R\\>H:i:s"; // 2003-03-13<br />16:46:24
//$default->generic_date_format = "Y-M-d\\<\B\R\\>H:i ";  // 2003-Mar-09<br>12:29 
//$default->generic_date_format = "d-m-y\\<\B\R\\>H:i ";  // 27-10-02<br>10:58
//$default->generic_date_format	= "D-M-Y\\<\B\R\\>H:i ";  // Sun-Oct-2002<br>10:58 
//
// For more options check the php documentation:
// http://www.php.net/manual/en/function.date.php

// **********************************************************************
// *** OWL CONFIGURABLE - FILE UPLOAD - Max Files  
// This is to set the maximum number of files that can be uploaded
// at one time, this is a new feature of Owl 0.96
// 0 = disabled
$default->max_number_of_file_uploads = 0;
  
// **********************************************************************
// *** OWL CONFIGURABLE - FILE UPLOAD - DEFAULT TYPES
// BOZZ: default doctype changed to 1 because initial install only has 
// BOZZ: the one Default doctype
$default->default_doctype = 1;
$default->default_url_doctype = 1;
  
// **********************************************************************
// *** OWL CONFIGURABLE - FILE UPLOAD - ACLs (Access Control Lists)
// BEGIN NEW ACL Based Security Model

$default->advanced_security = 1;
$default->user_can_propagate_acl = 0;

// User 0 is equal to EVERYBODY
// If the group and user are left blank "" then the creators primary group is used
// ------------------------------
// begin default folder security.
// the first [x]  indicates which database
// this default security will apply to.
// ------------------------------

//$default->folder_security[0][] = array ( "group_id" => "" , "user_id" => "0", 
//"owlread" => "1", 
//"owlwrite" => "0", 
//"owldelete" => "0", 
//"owlcopy" => "0", 
//"owlmove" => "0", 
//"owlproperties" => "0", 
//"owlsetacl" => "0", 
//"owlmonitor" => "1" );

/* 
$default->folder_security[0][] = array ( "group_id" => "" , "user_id" => "", 
"owlread" => "1", 
"owlwrite" => "1", 
"owldelete" => "0", 
"owlcopy" => "0", 
"owlmove" => "0", 
"owlproperties" => "1", 
"owlsetacl" => "0", 
"owlmonitor" => "1" ); */

// ------------------------------
// end default folder security.
// ------------------------------

// ------------------------------
// begin default file security.
// the first [x]  indicates which database 
// this default security will apply to.
// ------------------------------

/* $default->file_security[0][] = array ( "group_id" => "" , "user_id" => "", 
"owlread" => "1", 
"owlwrite" => "1", 
"owlviewlog" => "0",
"owldelete" => "0", 
"owlcopy" => "0", 
"owlmove" => "0", 
"owlproperties" => "1", 
"owlupdate" => "0",
"owlcomment" => "0",
"owlcheckin" => "0",
"owlemail" => "0",
"owlrelsearch" => "0",
"owlsetacl" => "0", 
"owlmonitor" => "1" ); */

// ------------------------------
// end default file security.
// ------------------------------

// ------------------------------
// begin default setacl checkboxes to show.
// for folders and files respectively
// ------------------------------
$default->acl_folder_types = array(
'read',
'write',
'delete',
'copy',
'move',
'properties',
'setacl',
'monitor',
'update',
'viewlog',
'comment',
'checkin',
'email',
'relsearch'
);

$default->acl_file_types = array(
'read',
'update',
'setacl',
'delete',
'copy',
'move',
'properties',
'viewlog',
'comment',
'checkin',
'email',
'relsearch',
'monitor'
);


// *** Inherit ACLs from Parent Folder
// On file and folder creation the ACL's of the parent are applied to the new file or folder
$default->inherit_acl_from_parent_folder =  1;

// *** Show Users in specified group
// this enables a popup window on setacl
// that shows the users that are in the group.
//
$default->show_users_in_group = 1;

// **********************************************************************
// *** OWL CONFIGURABLE - FILE AND FOLDER VIEWING


// **********************************************************************
// *** OWL CONFIGURABLE - FILE AND FOLDER VIEWING - File Action 
// Set:      File Action 
// On Click: Filename
// Under:    Title Column
// 0 = View File / Details
// 1 = Download File 
// 2 = Modify File Properties
// 3 = View File
$default->file_action_click_title_column = 0;

// **********************************************************************
// *** OWL CONFIGURABLE - FILE AND FOLDER VIEWING - File Action 
// Set:      File Action
// On Click: Filename
// Under:    File Column
// 0 = View File / Details
// 1 = Download File 
// 2 = Modify File Properties
// 3 = View File
$default->file_action_click_file_column = 1;

// **********************************************************************
// *** OWL CONFIGURABLE - FILE AND FOLDER VIEWING - Folder Action 
// Set:      Folder Action
// On Click: Folder name
// Under:    Title Column
// 0 = Browse Folder
// 1 = Download Folder Content
// 2 = Modify Folder Properties
$default->folder_action_click_title_column = 0;

// **********************************************************************
// *** OWL CONFIGURABLE - FILE AND FOLDER VIEWING - Folder Action 
// Set:      Folder Action
// On Click: Folder name
// Under:    File Column
// 0 = Browse Folder
// 1 = Download Folder Content
// 2 = Modify Folder Properties
$default->folder_action_click_file_column = 1;

// **********************************************************************
// ***                EXTENSIONS CONFIGUATION OPTIONS                 ***
// **********************************************************************

// **********************************************************************
// *** EXTENSION - antiword
// **********************************************************************
// *** EXTENSION - antiword - commmand line arguments
// argument is "-m <mapping>" where <mapping> is a character mapping file
$default->wordtotext_switches = "-m UTF-8";


// **********************************************************************
// *** EXTENSION - MegaUpload Progress Bar
// **********************************************************************
// *** EXTENSION - MegaUpload Progress Bar - Enabled
$default->use_progress_bar = 0;
//
// *** EXTENSION - MegaUpload Progress Bar - tmp directory
$default->progress_bar_tmp_dir = "/tmp";


// **********************************************************************
// *** EXTENSION - UberUpload Progress Bar
// **********************************************************************
// *** EXTENSION - UberUpload Progress Bar - Enabled
$default->use_ubr_progress_bar = 0;
//
// *** EXTENSION - UberUpload Progress Bar - tmp directory
// this must be writable by the webserver user
$default->ubr_progress_bar_tmp_dir = "/tmp";
//
// *** EXTENSION - UberUpload Progress Bar - temporary upload directory
// this must be writable by the webserver user
$default->ubr_progress_bar_upload_dir = "/tmp/ubr_uploads";


// **********************************************************************
// *** EXTENSION - RSS FEED
// **********************************************************************
// *** EXTENSION - RSS FEED - Enabled
$default->rss_feed_enabled = 0;
// *** EXTENSION - RSS FEED - Feed text file path
// Must be Located in the web space somewhere.
$default->RSS_TxtFilePath = $default->owl_fs_root . "/RSS/";


// **********************************************************************
// *** EXTENSION - JUplaod Java Applet
// **********************************************************************
//
// 0 == Disabled
// 1 == Enabled 
$default->enable_jupload_interface = 1;
$default->jupload_overwrite = 0;

// **********************************************************************
// *** EXTENSION tesseract - OCR (Optical Character Recognition)
// **********************************************************************
//
// *** EXTENSION tesseract - path to bin file
$default->ocr_path = "/usr/bin/tesseract";

// *** EXTENSION tesserach - TODO: need definition of this parameter
$default->enable_twain_scan_to_pdf = 0;


// **********************************************************************
// *** EXTENSION ppttotext - Powerpoint to Text converter
// **********************************************************************
$default->ppttotext_path = "/usr/local/bin/catppt";

// ---------------------- NEW ADDED May 8th -----------------------------

$default->take_ownership_on_checkout = 0;

// **********************************************************************
// *** Admin Syslog reporter max reported rows
// **********************************************************************
$default->max_syslog_reported_rows = 5000;


// *************************************************
//  List of Video file extension that can be played in line
// with Flowplayer Flash Video Player
// *************************************************
$default->aVideoFiles = array("flv", "mov");
$default->video_base_url = "http://www.example.com/doxbox";
$default->video_base_url = "http://bozzit.homelinux.com/Projects/owl-intranet/doxbox";

// If this parameter is set to 1
// On file Play / View a Playlist is displayed of ALL the Video
// Files in the same directory as the file being viewed / played
$default->VideoPlayList = 1;
// *************************************************

$default->wysiwyg_permited_html_tags = '<br><b><h1><h2><h3><h4><font><color><br /><p><strong><em><span>';
$default->default_permited_html_tags = '<br><b><h1><h2><br />';

// **********************************************************************
// *** Popup on mouse over Centralized Configuration
// **********************************************************************
$default->domtt_popup =   "return makeTrue(domTT_activate(this, event, 'caption', '%s', 'content', '%s', 'lifetime', %s, 'fade', 'both', 'delay', 10, 'maxWidth', '400', 'direction', 'north', 'statusText', ' ', 'trail', true));";
?>
