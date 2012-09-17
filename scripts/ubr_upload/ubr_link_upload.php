<?php
//******************************************************************************************************
//   ATTENTION: THIS FILE HEADER MUST REMAIN INTACT. DO NOT DELETE OR MODIFY THIS FILE HEADER.
//
//   Name: ubr_link_upload.php
//   Revision: 1.6
//   Date: 5/25/2008 12:34:10 PM
//   Link: http://uber-uploader.sourceforge.net
//   Initial Developer: Peter Schmandra  http://www.webdice.org
//   Description: Create a link file in the temp directory
//
//   Licence:
//   The contents of this file are subject to the Mozilla Public
//   License Version 1.1 (the "License"); you may not use this file
//   except in compliance with the License. You may obtain a copy of
//   the License at http://www.mozilla.org/MPL/
//
//   Software distributed under the License is distributed on an "AS
//   IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
//   implied. See the License for the specific language governing
//   rights and limitations under the License.
//
//***************************************************************************************************************

//***************************************************************************************************************
//   ATTENTION
//
// If you need to debug this file, set the $DEBUG_AJAX = 1 in ubr_ini.php and use the showDebugMessage function.  eg.
// showDebugMessage("He There");
//***************************************************************************************************************

//***************************************************************************************************************
// The following possible query string formats are assumed
//
// 1. No query string
// 2. ?about=1
//***************************************************************************************************************

$THIS_VERSION = '1.6';         // Version of this file
$UPLOAD_ID = '';               // Initialize upload id

require 'ubr_ini.php';
require 'ubr_lib.php';

if($PHP_ERROR_REPORTING){ error_reporting(E_ALL); }

if(isset($_GET['about']) && $_GET['about'] == 1){ kak("<u><b>UBER UPLOADER LINK UPLOAD</b></u><br>UBER UPLOADER VERSION =  <b>" . $UBER_VERSION . "</b><br>UBR_LINK_UPLOAD = <b>" . $THIS_VERSION . "<b><br>\n", 1, __LINE__); }
else{
	/////////////////////////////////////////////////////
	//   ATTENTION
	//   Put your authentication code here. eg.
	//   if(!authUser($_COOKIE['uber_user'] ){ exit; }
	/////////////////////////////////////////////////////
}

// Set config file
if($MULTI_CONFIGS_ENABLED){
	/////////////////////////////////////////////////////////////////////////
	//   ATTENTION
	//   Put your multi config file code here. eg
	//   if($_SESSION['user_name'] == 'TOM'){ $config_file = 'tom_config.php'; }
	//   if($_COOKIE['user_name'] == 'TOM'){ $config_file = 'tom_config.php'; }
	/////////////////////////////////////////////////////////////////////////
}
else{ $config_file = $DEFAULT_CONFIG; }

// Load config file
require $config_file;

/////////////////////////////////////////////////////////////////////////
//   ATTENTION
//   Put your config over-ride or create code here. eg.
//   $config_file['max_upload_size'] = $_SESSION['new_max_upload_size'];
//   $config_file['employee_num'] = $_SESSION['employee_num'];
/////////////////////////////////////////////////////////////////////////

// Create directories
if(!create_dir($TEMP_DIR)){
	if($DEBUG_AJAX){ showDebugMessage('Failed to create temp_dir ' . $TEMP_DIR); }
	showAlertMessage("<font color='red'>ERROR</font>: Failed to create temp_dir", 1);
}
if(!create_dir($_CONFIG['upload_dir'])){
	if($DEBUG_AJAX){ showDebugMessage('Failed to create upload_dir ' . $_CONFIG['upload_dir']); }
	showAlertMessage("<font color='red'>ERROR</font>: Failed to create upload_dir", 1);
}
if($_CONFIG['log_uploads']){
	if(!create_dir($_CONFIG['log_dir'])){
		if($DEBUG_AJAX){ showDebugMessage('Failed to create log_dir ' . $_CONFIG['log_dir']); }
		showAlertMessage("<font color='red'>ERROR</font>: Failed to create log_dir", 1);
	}
}

// Purge old link files
if($PURGE_LINK_FILES){ purge_ubr_files($TEMP_DIR, $PURGE_LINK_LIMIT, '.link', $DEBUG_AJAX); }

// Purge old redirect files
if($PURGE_REDIRECT_FILES){ purge_ubr_files($TEMP_DIR, $PURGE_REDIRECT_LIMIT, '.redirect', $DEBUG_AJAX); }

// Generate upload id
$UPLOAD_ID = generateUploadID();

// Format link file  path
$PATH_TO_LINK_FILE = $TEMP_DIR . $UPLOAD_ID . ".link";

// Show debug message
if($DEBUG_AJAX){ showDebugMessage("Upload ID = $UPLOAD_ID"); }

// Write link file
if(write_link_file($TEMP_DIR, $UPLOAD_ID, $PATH_TO_LINK_FILE, $DEBUG_UPLOAD, $DELETE_LINK_FILE, $PURGE_TEMP_DIRS, $PURGE_TEMP_DIRS_LIMIT, $_CONFIG)){
	if($DEBUG_AJAX){ showDebugMessage('Created link file ' . $PATH_TO_LINK_FILE); }
	startUpload($UPLOAD_ID, $DEBUG_UPLOAD);
}
else{
	if($DEBUG_AJAX){ showDebugMessage('Failed to create link file ' . $PATH_TO_LINK_FILE); }
	showAlertMessage("<font color='red'>ERROR</font>: Failed to create link file: $UPLOAD_ID.link", 1);
}

//////////////////////////////////////////////////////////FUNCTIONS //////////////////////////////////////////////////////////////////

// Create a directory
function create_dir($dir){
	if(is_dir($dir)){ return true; }
	else{
		umask(0);
		if(@mkdir($dir, 0777)){ return true; }
		else{ return false; }
	}
}

//Purge old redirect and link files
function purge_ubr_files($temp_dir, $purge_time_limit, $file_type, $debug_ajax){
	$now_time = mktime();

	if(is_dir($temp_dir)){
		if($dp = @opendir($temp_dir)){
			while(false !== ($file_name = readdir($dp))){
				if($file_name != '.' && $file_name != '..' && strcmp(substr($file_name, strrpos($file_name, '.')), $file_type) == 0){
					if($file_time = @filectime($temp_dir . $file_name)){
						if(($now_time - $file_time) > $purge_time_limit){ @unlink($temp_dir . $file_name); }
					}
				}
			}
			closedir($dp);
		}
		else{
			if($debug_ajax){ showDebugMessage('Failed to open temp_dir ' . $temp_dir); }
			showAlertMessage("<font color='red'>ERROR</font>: Failed to open temp_dir", 1);
		}
	}
	else{
		if($debug_ajax){ showDebugMessage('Failed to find temp_dir ' . $temp_dir); }
		showAlertMessage("<font color='red'>ERROR</font>: Failed to find temp_dir", 1);
	}
}

//Write 'upload_id.link' file
function write_link_file($temp_dir, $upload_id, $path_to_link_file, $debug_upload, $delete_link_file, $purge_temp_dirs, $purge_temp_dirs_limit, $_config){
	$fp = @fopen($path_to_link_file, "wb");

	if(is_resource($fp)){
		fwrite($fp, "temp_dir<=>". $temp_dir . "\n");
		fwrite($fp, "upload_id<=>". $upload_id . "\n");
		fwrite($fp, "path_to_link_file<=>". $path_to_link_file . "\n");
		fwrite($fp, "debug_upload<=>". $debug_upload . "\n");
		fwrite($fp, "delete_link_file<=>". $delete_link_file . "\n");
		fwrite($fp, "purge_temp_dirs<=>". $purge_temp_dirs . "\n");
		fwrite($fp, "purge_temp_dirs_limit<=>". $purge_temp_dirs_limit . "\n");

		// Write all the config settings to the link file
		foreach($_config as $config_setting=>$config_value){ fwrite($fp, $config_setting . "<=>". $config_value . "\n"); }

		fclose($fp);
		umask(0);
		chmod($path_to_link_file, 0666);

		return true;
	}
	else{ return false; }
}

?>