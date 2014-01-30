<?php

/*
 * File: English/language.inc
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
*/

if (!defined('LABEL_TERMINATOR')) 
{
   define('LABEL_TERMINATOR',":&nbsp;");
}

//********************************************************
// Date Formating BEGIN
//********************************************************

// If config/owl.php   $default->generic_date_format is set USE That one if not
// use the one in this file

if (isset($default->generic_date_format) && trim($default->generic_date_format) != "") {

	$owl_lang->localized_date_format = $default->generic_date_format;
} else {
	$owl_lang->localized_date_format = "M d, Y \a\\t h:i a";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "en";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "You are not permitted to Add Comments to this File";
$owl_lang->err_backup_file   		= "Error backing up existing file";
$owl_lang->err_backup_folder_create 	= "Backup Folder Creation error";
$owl_lang->err_bad_url			= "Please enter a valid URL";
$owl_lang->err_bad_version_1 		= "Document Manaugement System Requires as a minimum PHP Version";
$owl_lang->err_bad_version_2 		= "You are running Version";
$owl_lang->err_bad_version_3 		= "Install a newer version of php and try again";
$owl_lang->err_comment_empty		= "Comment cannot be empty";
$owl_lang->err_email         		= "Message could not be sent";
$owl_lang->err_email_required		= "E-Mail field is required";
$owl_lang->err_fexist1			= "<b>File Exists" . LABEL_TERMINATOR . "</b>";
$owl_lang->err_fexist2 			= "There is already a file with the name <i>";
$owl_lang->err_fexist3 			= "</i> in this directory.";
$owl_lang->err_file_exists		= "The file you are trying to upload already exists";
$owl_lang->err_file_lock     		= "You cannot check this file out, it is currently held by";
$owl_lang->err_file_not_exist		= "File does not exist on the file system";
$owl_lang->err_file_too_big		= "php.ini upload_max_filesize exceeded and/or<br />DMS Max Upload file size";
$owl_lang->err_file_update		= "Updating a file requires the filename to remain the same, please try again using the same filename";
$owl_lang->err_fileexists    		= "Move was Canceled<br />File with the same name already exists.";
$owl_lang->err_move_failed    		= "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "The filename you are trying to rename this file to already exists";
$owl_lang->err_folder_create 		= "Folder Creation error";
$owl_lang->err_folder_exist		= "This folder already exists";
$owl_lang->err_folderexists  		= "Rename was Canceled<br />Folder with the same name exists.";
$owl_lang->err_general 			= "An Error has occurred";
$owl_lang->err_please_select_bulk	= "Please select at least one File or Folder using the checkbox";
$owl_lang->err_select_reviewer		= "Please select at least one Person to review your document";
$owl_lang->err_update_file_lock     	= "You cannot update this file, it is currently held by";
// NEW CHANGE
$owl_lang->err_group_delete             = "Can't delete this Group" . LABEL_TERMINATOR . " <font color=\"red\">%d</font> File(s),  <font color=\"red\">%d</font> Folder(s), <font color=\"red\">%d</font> User(s) with this Primary group, <font color=\"red\">%d</font> User(s) that are a member of this group";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Cannot Delete there are files using this Document Type";
$owl_lang->err_database			= "Database error";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_field_req            = "Missing Required Field" . LABEL_TERMINATOR;
$owl_lang->err_doc_type_name_req	= "Document Type Name is Required <br />";
$owl_lang->err_field_label_req 		= "Field Label is Required <br />";
$owl_lang->err_field_name_req		= "Field Name is Required <br />";
$owl_lang->err_field_size_req		= "Field Size is Required <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Temporary &ldquo;TEXT&rdquo; File Creation Failure";
$owl_lang->err_forbidden_file		= "Forbidden File Type";
$owl_lang->err_group_exists		= "There is already a group with this name.";
$owl_lang->err_gzip_not_found  		= "gzip was not found in ";
$owl_lang->err_login			= "Please Login to perform this action";
$owl_lang->err_movecancel    		= "Move was Canceled<br />";
$owl_lang->err_nameempty    		= "Folder name cannot be empty";
$owl_lang->err_news_required		= "ERROR" . LABEL_TERMINATOR . " News Heading and Content are required!";
$owl_lang->err_no_access 		= "You do not have access to any of the files selected";
$owl_lang->err_no_access_info 		= "Possible causes" . LABEL_TERMINATOR . " <br />1) You did not click any checkbox in front of a File or Folder<br />2) Bulk Delete, Bulk E-Mail, Bulk Checkout do not apply to Folders<br />3) You do not have access to any of the files or folders you have selected.";
$owl_lang->err_noemail			= "You do not have access to mail this file";
$owl_lang->err_nofileaccess		= "You do not have access to this file";
$owl_lang->err_nofiledelete		= "You do not have access to delete this file";
$owl_lang->err_nofilemod		= "You do not have access to modify this file";
$owl_lang->err_nofolderaccess		= "You do not have access to this folder";
$owl_lang->err_nofolderdelete		= "You do not have access to delete this folder";
$owl_lang->err_nofoldermod		= "You do not have access to modify this folder";
$owl_lang->err_nosubfolder		= "You do not have access to create subfolders here";
$owl_lang->err_not_zip			= "Not a Valid ZIP Archive";
$owl_lang->err_note_title               = "The Title is a required field";
$owl_lang->err_note_title_exists        = "A Note with this name Already exists";
$owl_lang->err_noupload			= "You do not have access to upload to this folder";
$owl_lang->err_pass_missmatch		= "New Password and Confirm Password don't Match";
$owl_lang->err_pass_wrong    		= "Old Password is wrong";
$owl_lang->err_please_select_bulk       = "Please select at least one File or Folder using the checkbox";
$owl_lang->err_pod2html_not_found       = "ERROR" . LABEL_TERMINATOR . " The pod2html tool was not found" . LABEL_TERMINATOR;
$owl_lang->err_quota			= "You do not have enough quota space to upload this file" . LABEL_TERMINATOR;
$owl_lang->err_quota_avail		= " available.";
$owl_lang->err_quota_exceed  		= "You have exceeded your quota";
$owl_lang->err_quota_needed		= " needed ";
$owl_lang->err_req			= "ERROR" . LABEL_TERMINATOR . " All Fields are required";
$owl_lang->err_root_delete		= "The Root Folder cannot be deleted";
$owl_lang->err_sess_notvalid 		= "Session id is not valid";
$owl_lang->err_sess_write		= "Error writing session information to database";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; is a reserved Folder Name please choose another name";
$owl_lang->err_sql			= "SQL error";
$owl_lang->err_tar_not_found  		= "tar was not found in ";
$owl_lang->err_unauth_area   		= "You are not authorized to use this area";
$owl_lang->err_unauthorized  		= "Unauthorized";
$owl_lang->err_upload 			= "Upload error";
$owl_lang->err_user_exists		= "Username exists";
$owl_lang->err_captcha_auth		= "CAPTCHA authentication failed";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field         = "Add Field";
$owl_lang->btn_add_file          = "Add Document";
$owl_lang->btn_add_folder        = "Add Folder";
$owl_lang->btn_dist_folder       = "Publish Folder";
$owl_lang->btn_add_news          = "Add News";
$owl_lang->btn_add_note          = "Add Note";
$owl_lang->btn_jupload          = "Bulk Upload";
$owl_lang->btn_add_url           = "Add Url";
$owl_lang->btn_add_zip           = "Add Archive";
$owl_lang->btn_admin      = "Admin";
$owl_lang->btn_admin_groups          = "New Group";
$owl_lang->btn_admin_news          = "News Admin";
$owl_lang->btn_admin_user_group          = "User/Group Admin";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "New User";
$owl_lang->btn_back          = "Go Back";
$owl_lang->btn_browse     = "Browse";
$owl_lang->btn_bulk_checkout       = "Bulk Checkout";
$owl_lang->btn_bulk_delete         = "Bulk Delete";
$owl_lang->btn_bulk_download          = "Bulk Download";
$owl_lang->btn_bulk_email          = "Bulk E-Mail";
$owl_lang->btn_bulk_move          = "Bulk Move";
$owl_lang->btn_cancel          = "Cancel";
$owl_lang->btn_clickhere          = "Click Here";
$owl_lang->btn_collapse_view          = "Collapse View";
$owl_lang->btn_create          = "Create";
$owl_lang->btn_default_view          = "Default View";
$owl_lang->btn_deldoctype          = "Del Doc Type";
$owl_lang->btn_download_bulk_package	= "to download your bulk download Package";
$owl_lang->btn_edit_group          = "Edit Group";
$owl_lang->btn_edit_user          = "Edit User";
$owl_lang->btn_expand_view          = "Expand View";
$owl_lang->btn_go_bottom      = "Go To Bottom";
$owl_lang->btn_go_top      = "Go To Top";
$owl_lang->btn_help     = "Help";
$owl_lang->btn_import_users  = "Import Users";
$owl_lang->btn_login          = "Login";
$owl_lang->btn_logout     = "Logout";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_register          = "Register";
$owl_lang->btn_reset          = "Reset";
$owl_lang->btn_send_email          = "Send E-Mail";
$owl_lang->btn_submit          = "Submit";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Thumb Nail View";
$owl_lang->btn_trash_admin          = "Trash";
// NEW STUFF
$owl_lang->btn_export          = "Export";
$owl_lang->btn_gen_pdf          = "Generate PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";



//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Add a Comment to this File";
$owl_lang->alt_add_field	= "Add The Field Above";
$owl_lang->alt_add_group	= "Create This Group";
$owl_lang->alt_add_news		= "Add a New News Item";
$owl_lang->alt_add_user		= "Create This User";
$owl_lang->alt_admin_flush      = "Flush Stale/Expired Sessions";
$owl_lang->alt_admin_groups	= "Create a new group";
$owl_lang->alt_admin_users	= "Create a new user";
$owl_lang->alt_approve_file 	= "Approve This Document";
$owl_lang->alt_back      	= "Return To Previous Screen";
$owl_lang->alt_btn_add_file     = "Upload a New File";
$owl_lang->alt_btn_add_folder	= "Create a New Folder";
$owl_lang->alt_btn_dist_folder  = "Create RSS Feed / Torrent for this Folder";
$owl_lang->alt_btn_add_note     = "Add a New Note";
$owl_lang->alt_btn_jupload     = "Add Multiple files using jupload";
$owl_lang->alt_btn_add_url	= "Create a New Web link";
$owl_lang->alt_btn_add_zip     	= "Upload a Zip file to Be Extracted";
$owl_lang->alt_btn_admin 	= "DMS Administration";
$owl_lang->alt_btn_browse	= "Return to File Browser";
$owl_lang->alt_btn_bulk_checkout= "Bulk Checkout Files";
$owl_lang->alt_btn_bulk_delete 	= "Bulk Delete Files";
$owl_lang->alt_btn_bulk_download= "Bulk Download Files";
$owl_lang->alt_btn_bulk_email  	= "Bulk E-Mail Files";
$owl_lang->alt_btn_bulk_move   	= "Bulk Move Files and Folders";
$owl_lang->alt_btn_clickhere	= "Click Here";
$owl_lang->alt_btn_collapse_view= "Switch to a Reduced View";
$owl_lang->alt_btn_default_view = "Switch to Default View";
$owl_lang->alt_btn_expand_view  = "Switch to an Expanded View";
$owl_lang->alt_btn_help		= "Online Help";
$owl_lang->alt_btn_login	= "Log in to DMS";
$owl_lang->alt_btn_logout	= "Log out of DMS";
$owl_lang->alt_btn_mail_tool   	= "Simple E-Mail Tool";
$owl_lang->alt_btn_thumb_view   = "Switch to Thumb Nail View";
$owl_lang->alt_cancel		= "Cancel This Action";
$owl_lang->alt_cancel_move	= "Cancel Move Action";
$owl_lang->alt_change		= "Update this Record";
$owl_lang->alt_comments 	= "Comments Exist for this File";
$owl_lang->alt_copy_file     	= "Copy File";
$owl_lang->alt_copy_folder   	= "Copy Folder";
$owl_lang->alt_del_all		= "Empty Trash";
$owl_lang->alt_del_comments     = "Delete This Comment";
$owl_lang->alt_edt_comments     = "Edit This Comment";
$owl_lang->alt_del_field	= "Delete This Field";
$owl_lang->alt_del_file      	= "Delete File (Y/N)";
$owl_lang->alt_del_folder    	= "Delete Folder (Y/N)";
$owl_lang->alt_del_group	= "Delete This Group";
$owl_lang->alt_del_news		= "Delete This News";
$owl_lang->alt_del_selected	= "Delete all Selected Files";
$owl_lang->alt_del_this_folder	= "Delete Folder &#8211; ";
$owl_lang->alt_del_user		= "Delete This User";
$owl_lang->alt_deldoctype	= "Delete Current Document Type";
$owl_lang->alt_edit_field	= "Edit This Field Definition";
$owl_lang->alt_edit_group       = "Edit The Selected Group";
$owl_lang->alt_edit_news	= "Edit This News";
$owl_lang->alt_edit_user        = "Edit The Selected User";
$owl_lang->alt_email		= "E-Mail this File";
$owl_lang->alt_email_reminder 	= "E-Mail Reminder";
$owl_lang->alt_email_selected	= "E-Mail all Selected Files";
$owl_lang->alt_get_file      	= "Download File";
$owl_lang->alt_get_folder      	= "Download Folder Content";
$owl_lang->alt_go_bottom      	= "Go to the bottom of the page";
$owl_lang->alt_go_top 		= "Go to the top of the page";
$owl_lang->alt_have_news	= "You Have News Item(s) To View";
$owl_lang->alt_have_no_news	= "No New News Item(s) To View";
$owl_lang->alt_home_folder	= "Back to Initial Directory ";
$owl_lang->alt_link_file     	= "Link This File to Another Directory";
$owl_lang->alt_lock_file        = "Check file out";
$owl_lang->alt_log_clear        = "Delete all Logs (Y/N)";
$owl_lang->alt_log_file         = "File Log";
$owl_lang->alt_log_next		= "Display Next Records";
$owl_lang->alt_log_prev		= "Display Previous Records";
$owl_lang->alt_log_top		= "Go to the First Record";
$owl_lang->alt_mod_file      	= "Modify File Properties"; 
$owl_lang->alt_mod_folder    	= "Modify Folder Properties";
$owl_lang->alt_monitor		= "Monitor this File";
$owl_lang->alt_monitor_folder   = "Monitor this Folder";
$owl_lang->alt_monitored	= "Stop Monitoring this File";
$owl_lang->alt_monitored_folder = "Stop Monitoring this Folder";
$owl_lang->alt_move_file     	= "Move File";
$owl_lang->alt_move_folder   	= "Move Folder";
$owl_lang->alt_move_selected	= "Move all Selected Files";
$owl_lang->alt_my_approval	= "Document(s) Waiting my Approval";
$owl_lang->alt_new_doctype	= "Create New Document Type";
$owl_lang->alt_news_close	= "Close the News Window";
$owl_lang->alt_news_next	= "Display Next News Item";
$owl_lang->alt_news_prev	= "Display Previous News Item";
$owl_lang->alt_news_print	= "Print This News Item";
$owl_lang->alt_pending_approval	= "Document(s) Pending Approval";
$owl_lang->alt_play_file 	= "Play Media File";
$owl_lang->alt_publish_file 	= "Make The Document Public";
$owl_lang->alt_refresh_filter	= "Initiate Filter / Refresh Results";
$owl_lang->alt_register		= "Submit your Registration";
$owl_lang->alt_reject_file 	= "Reject This Document";
$owl_lang->alt_related		= "Find Related Documents";
$owl_lang->alt_reset_form	= "Reset Form Values";
$owl_lang->alt_rest_selected	= "Restore all Selected Files";
$owl_lang->alt_search		= "Initiate The Search";
$owl_lang->alt_send_email	= "Send The E-Mail";
$owl_lang->alt_sendfile		= "Send The File";
$owl_lang->alt_set_initial_dir	= "Set Current Directory as Initial";
$owl_lang->alt_site_map         = "Site Map";
$owl_lang->alt_submit      	= "Submit Form";
$owl_lang->alt_toggle_check_box	= "Toggle Check Boxes";
$owl_lang->alt_tool_status_green= "Tool is Active";
$owl_lang->alt_tool_status_red	= "Path is Incorrect AND/OR is not Executable";
$owl_lang->alt_unlock_file      = "Check file in";
$owl_lang->alt_upd_field	= "Update This Field";
$owl_lang->alt_upd_file      	= "Update File";
$owl_lang->alt_view_comments    = "Add / View File Comments";
$owl_lang->alt_view_file     	= "View File";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Recycle Bin Administration";
$owl_lang->alt_edit_file_inline = "Edit Text File";
$owl_lang->alt_gen_pdf          = "Generate PDF Version of the above File";
$owl_lang->alt_updated     	= "Document Was Updated Since Your Last Visit";
$owl_lang->alt_indexed     	= "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Document Was Created Since Your Last Visit";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// DMS Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Entire Content was also deleted";
$owl_lang->log_detail		= "No Additional Details";
$owl_lang->log_file_to		= "TO" . LABEL_TERMINATOR;
$owl_lang->log_filter_all	= "ALL";
$owl_lang->log_login_det	= "Username" . LABEL_TERMINATOR;
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Changed Group" . LABEL_TERMINATOR;
$owl_lang->log_admin_changed_user = "Changed User" . LABEL_TERMINATOR;
$owl_lang->log_admin_created_group = "Created Group" . LABEL_TERMINATOR;
$owl_lang->log_admin_created_user = "Created User" . LABEL_TERMINATOR;
$owl_lang->log_admin_del_group = "Deleted Group" . LABEL_TERMINATOR;
$owl_lang->log_admin_del_user = "Deleted User" . LABEL_TERMINATOR;
$owl_lang->log_admin_disabled = " Disabled User" . LABEL_TERMINATOR;
$owl_lang->log_admin_email_restore = "Files mailed" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_delfile= "Deleted File" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_delfold = "Deleted Folder" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_empty = "Trash Can Emptied";
$owl_lang->log_admin_trash_restore = "Restored" . LABEL_TERMINATOR;
$owl_lang->log_login_expired    = "Expired User" . LABEL_TERMINATOR;
$owl_lang->log_login_too_many_attempts = "Disabled (Too Many Failed Login)" . LABEL_TERMINATOR;
$owl_lang->log_readhd_feature_add  = "Read HD Feature Added this file";
$owl_lang->log_admin_to  = "to";
$owl_lang->log_admin_of  = "of";
// END NEW STUFF
$log_file_actions[1]        	= "LOGIN";
$log_file_actions[10]        	= "FILE UNLOCKED";
$log_file_actions[11]        	= "FILE MAILED";
$log_file_actions[12]        	= "FILE MOVED";
$log_file_actions[13]        	= "FOLDER CREATED";
$log_file_actions[14]        	= "FOLDER DELETED";
$log_file_actions[15]        	= "FOLDER MODIFIED";
$log_file_actions[16]        	= "FOLDER MOVED";
$log_file_actions[17]        	= "FORGOT PASS";
$log_file_actions[18]        	= "USER REG";
$log_file_actions[19]           = "FILE VIEWED";
$log_file_actions[2]        	= "LOGIN FAILED";
$log_file_actions[20]           = "FILE VIRUS";
$log_file_actions[21]           = "FILE COPIED";
$log_file_actions[22]           = "FOLDER COPIED";
$log_file_actions[23]           = "FILE LINKED";
$log_file_actions[3]        	= "LOGOUT";
$log_file_actions[4]        	= "FILE DELETED";
$log_file_actions[5]        	= "FILE UPLOAD";
$log_file_actions[6]        	= "FILE UPDATED";
$log_file_actions[7]        	= "FILE DOWNLOADED";
$log_file_actions[8]        	= "FILE CHANGED";
$log_file_actions[9]        	= "FILE LOCKED";
// BEGIN NEW STUFF
$log_file_actions[24]           = "USER ADMIN";
$log_file_actions[25]           = "TRASH CAN";
$log_file_actions[26]           = "FILE ACL";
$log_file_actions[27]           = "FOLDER ACL";
$log_file_actions[28]           = "FOLDER DISTRIBUTE";
$log_file_actions[29]           = "FOLDER LINKED";
$log_file_actions[30]           = "FILE REVIEW";
$log_file_actions[31]           = "FILE APPROVED";
$log_file_actions[32]           = "FILE REJECTED";
$log_file_actions[33]           = "FILE PUBLISHED";
// END NEW STUFF


//********************************************************
// DMS Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

// BEGIN NEW STUFF
$owl_lang->admin_login_date  = "The admin user logged in on" . LABEL_TERMINATOR;
$owl_lang->admin_login_from  = "The admin user logged in from";
$owl_lang->admin_login_subject  = "ADMIN USER LOGIN";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Anonymous Access)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Forgot your password?";
$owl_lang->like_register	= "Would Like to Register?";
$owl_lang->login		= "Login";
$owl_lang->logindisabled	= "Account has been DISABLED, contact the System Adminstrator";
$owl_lang->loginfail		= "Login failure";
$owl_lang->password		= "Password";
$owl_lang->repository_list      = "Repository";
$owl_lang->successlogout 	= "You have successfully logged out";
$owl_lang->toomanysessions	= "Maximum sessions for user reached, contact the System Administrator";
$owl_lang->username		= "Username";
$owl_lang->forgot_username	= "Username or Email Address";
$owl_lang->version 		= "Version";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Actions";
$owl_lang->current_db         		= "Current Repository" . LABEL_TERMINATOR;
$owl_lang->current_folder 		= "Current Folder" . LABEL_TERMINATOR;
$owl_lang->del_all			= "Empty Trash";
$owl_lang->del_selected			= "Delete Selected";
$owl_lang->disk_quota			= "Disk Quota";
$owl_lang->doc_number 			= "Doc #";
$owl_lang->email_selected		= "E-Mail Selected";
$owl_lang->file 			= "File";
$owl_lang->folder_count_file		= "File(s)";
$owl_lang->folder_count_folder		= "Folder(s)";
$owl_lang->folder_count_note		= "Note(s)";
$owl_lang->folder_count_pre		= "This Folder Contains";
$owl_lang->folder_count_url		= "URL(s)";
$owl_lang->folder_policy 		= "Current Folder Policy" . LABEL_TERMINATOR;
$owl_lang->held                      	= "Held"; 
$owl_lang->last_logged			= "Last on" . LABEL_TERMINATOR;
$owl_lang->menu_file_action		= "Available File Actions";
$owl_lang->menu_folder_action		= "Available Folder Actions";
$owl_lang->menu_url_action		= "Available Url Actions";
$owl_lang->modified 			= "Modified";
$owl_lang->move_selected		= "Move Selected";
$owl_lang->new_file			= "New!";
$owl_lang->no_description		= "No description Available";
$owl_lang->owner              		= "User";
#$owl_lang->owner              		= "Owner";
$owl_lang->page				= "Page" . LABEL_TERMINATOR;
$owl_lang->panel_file_info		= "File Information";
$owl_lang->postedby 			= "Posted by";
$owl_lang->reallydelete			= "Really delete";
$owl_lang->reallydelete_logs		= "Really Clear the Log File";
$owl_lang->reallydelete_selected	= "Really Delete all selected files";
$owl_lang->reallyrestore_selected	= "Really Restore all selected files";
$owl_lang->rest_selected		= "Restore Selected";
$owl_lang->score 			= "Score";
$owl_lang->size 			= "Size";
$owl_lang->updated_by 			= "Updated By";
$owl_lang->title 			= "Title";
$owl_lang->tot_files			= "Total" . LABEL_TERMINATOR;
$owl_lang->tot_monitored		= "Monitored" . LABEL_TERMINATOR;
$owl_lang->tot_my_checked_out		= "Checked Out" . LABEL_TERMINATOR;
$owl_lang->tot_my_files			= "My" . LABEL_TERMINATOR;
$owl_lang->tot_my_group			= "Group" . LABEL_TERMINATOR;
$owl_lang->tot_new_files		= "New" . LABEL_TERMINATOR;
$owl_lang->tot_updated_files		= "Updated" . LABEL_TERMINATOR;
$owl_lang->updated_file			= "Updated!";
$owl_lang->user               		= "User";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days " . LABEL_TERMINATOR;
// NEW STUFF
$owl_lang->favorite_label = "Label" . LABEL_TERMINATOR;
$owl_lang->favorite = "Favorites" . LABEL_TERMINATOR;
$owl_lang->favorite_add = "Add Current";
$owl_lang->favorite_delete = "Delete";
$owl_lang->favorite_go = "Go";
$owl_lang->files_in_my_group_title = "Files In My Group(s)";
$owl_lang->my_files_title= "My Files";
$owl_lang->my_monitored_title= "My Monitored File(s)/Folder(s)";
$owl_lang->my_special_access_title= "Special Access List";
$owl_lang->special_access_count_alt= "Special Access Files/Folders";
$owl_lang->special_access_count= "Special Access" . LABEL_TERMINATOR;
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Adding / Viewing Comments" . LABEL_TERMINATOR;
$owl_lang->addingfile 		= "Adding a file to ";
$owl_lang->addingfolder 	= "Adding a folder to ";
$owl_lang->attach_file		= "Attach File";
$owl_lang->change		= "Change";
$owl_lang->comments      	= "Comment";
$owl_lang->comments_added       = "Comments Added By" . LABEL_TERMINATOR;
$owl_lang->create		= "Create";
$owl_lang->description 		= "Description";
$owl_lang->disp_mp3_id		= "MP3 ID";
$owl_lang->disp_mp3_song	= "Song" . LABEL_TERMINATOR;
$owl_lang->disp_mp3_album	= "Album" . LABEL_TERMINATOR;
$owl_lang->disp_mp3_bitrate	= "Bitrate - Samplerate" . LABEL_TERMINATOR;
$owl_lang->disp_mp3_duration	= "Duration" . LABEL_TERMINATOR;
$owl_lang->disp_mp3_genre	= "Genre" . LABEL_TERMINATOR;
$owl_lang->disp_mp3_comments	= "Comments" . LABEL_TERMINATOR;
$owl_lang->email_body		= "Message";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Reply to";
$owl_lang->email_subject	= "Subject";
$owl_lang->email_to		= "E-Mail to";
$owl_lang->emailing		= "Mailing";
$owl_lang->keywords 		= "Keywords";
$owl_lang->saved_keywords       = "Saved Keywords" . LABEL_TERMINATOR;
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Modifying ";
$owl_lang->name               	= "Name"; 
$owl_lang->none_selected        = "NONE SELECTED";
$owl_lang->note_content         = "Note Content";
$owl_lang->notify_link          = "DMS External Link";
$owl_lang->ownergroup         	= "Owner (Group)";
$owl_lang->ownership		= "Ownership";
$owl_lang->permissions 		= "Permissions";
$owl_lang->pick_select		= "&#8211; Select an DMS User &#8211;";
$owl_lang->policy 		= "Policy";
$owl_lang->post_comment		= "Post Comment";
$owl_lang->prop_permissions 	= "Propagate Permissions to subfolders?";
$owl_lang->prop_perms_files 	= "Permissions to propagate to files";
$owl_lang->sendfile 		= "Send File";
$owl_lang->sendthisfile 	= "Send this file";
$owl_lang->sendthisurl       	= "Send this URL";
$owl_lang->updating		= "Updating";
$owl_lang->verdescription 	= "Description<br />of changes";
$owl_lang->vermajor          	= "Major Revision";
$owl_lang->verminor          	= "Minor Revision";
$owl_lang->vertype           	= "Revision type";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Save Keyword?";
$owl_lang->archive_skip_file    = "SKIPPED" . LABEL_TERMINATOR;
$owl_lang->archive_skip_message = "The Following Files Have been Skipped they already exist";
$owl_lang->archive_extract_current  = "Extract to Current Folder?";
$owl_lang->archive_extract_overwrite  = "Overwrite Existing Files (Update)?";
$owl_lang->optional_file_index  = "Index file?" . LABEL_TERMINATOR;


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "E-Mail Address";
$owl_lang->full_name		= "Full Name";
$owl_lang->register		= "User Registration";
$owl_lang->self_failed		= "Failed";
$owl_lang->self_passwd		= "Password Sent to" . LABEL_TERMINATOR;
$owl_lang->self_reg_bod		= "Your DMS Password is" . LABEL_TERMINATOR;
$owl_lang->self_reg_rset	= "Your DMS Password has been reset to" . LABEL_TERMINATOR;
$owl_lang->self_reg_subj	= "Your DMS Account";
$owl_lang->send_pass		= "Send Password";
$owl_lang->submit		= "Register";
$owl_lang->thank_you_1		= "Thank You!";
$owl_lang->thank_you_2		= "Your password will be sent to your e-mail address";
$owl_lang->thank_you_3		= "Your account needs to be enabled by the administrator before you can log in.";

//NEW STUFF

$owl_lang->captcha_typein        = "Type the 5 characters";
$owl_lang->change_pass_title	      = "CHANGE PASSWORD";
$owl_lang->err_cant_reuse_passwords   = "You can't reuse previously set passwords";
$owl_lang->err_new_confirm_different  = "Your New and Confirm Password do not match <br />";
$owl_lang->err_old_pass_ver_failed    = "Your Old Password is incorrect <br />";
$owl_lang->err_pass_restriction_1     = "Your password needs to be at least &ldquo;%s&rdquo; characters long <br />";
$owl_lang->err_pass_restriction_2     = "contain at least &ldquo;%s&rdquo; numeric [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "and at least &ldquo;%s&rdquo; special character [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Your chosen username &ldquo;%s&rdquo; is %d chars long, and has to be at least %d characters long.";
$owl_lang->pass_change_email_1        = "Your Password was not Reset as you are not using DMS Authentication";
$owl_lang->pass_change_email_2        = "Your Authentication type is" . LABEL_TERMINATOR;
$owl_lang->pass_change_email_3        = "Contact Your System Administrator for Help";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Cancel";
$owl_lang->copy_file		= "Copying file";
$owl_lang->copy_folder		= "Copying Folder";
$owl_lang->moving		= "Moving";
$owl_lang->moving_file		= "Moving file";
$owl_lang->moving_folder	= "Moving Folder";
$owl_lang->select		= "Please select new folder" . LABEL_TERMINATOR;

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Viewing Log For ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Diff From";
$owl_lang->diff_to	= "Diff To";
$owl_lang->btn_diff	= "Show Diff";
$owl_lang->btn_diff_alt	= "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Comment Notification";
$owl_lang->confpassword	= "Confirm New Password";
$owl_lang->email_tool	= "E-Mail Tool";
$owl_lang->group	= "Primary Group";
$owl_lang->groupmember	= "Member Group(s)";
$owl_lang->last_modified= "Last Modified";
$owl_lang->newpassword	= "New Password";
$owl_lang->newsadmin	= "News Administrator";
$owl_lang->not_member	= "You are not member of any other groups";
$owl_lang->notification	= "Receive Notifications";
$owl_lang->oldpassword	= "Old Password";
$owl_lang->preference	= "Preferences";
$owl_lang->saved	= "&#8212; C H A N G E S&nbsp;&nbsp;&nbsp;S A V E D &#8212;";
$owl_lang->status_no	= "NO";
$owl_lang->status_yes	= "YES";
$owl_lang->userlang	= "Language";

//NEW STUFF
$owl_lang->useradmin	= "User Administrator";
$owl_lang->viewlogs     = "Can View System Logs";
$owl_lang->viewreports  = "Can View System Reports";
//NEW STUFF END

$owl_lang->owl_prefs_phone = "Phone";
$owl_lang->owl_prefs_department = "Department";
$owl_lang->owl_prefs_address = "Address";
$owl_lang->owl_prefs_note = "Notes";

//********************************************************
// prefs.php  END
//********************************************************


//********************************************************
// search.php  BEGIN
//********************************************************

$owl_lang->elapsed_time       	= "elapsed time";
$owl_lang->query_empty       	= "Empty Search String";
$owl_lang->related_query_empty  = "No metadata associated with document to perform &ldquo;Search Related&rdquo;";
$owl_lang->search             	= "Search";
$owl_lang->search_all_word	= "All Words";
$owl_lang->search_any_word	= "Any Words";
$owl_lang->search_currentfolder = "Search Current Folder";
$owl_lang->search_entire_phrase	= "Entire Phrase";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_for_files 	= "Searching For Files";
$owl_lang->search_for_folders 	= "Searching For Folders";
$owl_lang->search_match 	= "Match" . LABEL_TERMINATOR;
$owl_lang->search_results_for	= "Search results for";
$owl_lang->search_score 	= "Scoring Files";
$owl_lang->search_winthindocs   = "Search Within";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Viewing ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Display Wide File Info Panel";
$owl_lang->allow_track_favorite         = "Allow Users To Track Favorites";
$owl_lang->admin_login_to_browse_page	= "Admin goes to Browse Page on Logon";
$owl_lang->alt_btn_backup		= "Backup SQL Database";
$owl_lang->alt_btn_doctype_admin	= "Document Type Administrator";
$owl_lang->alt_btn_log_viewer		= "DMS System Log Viewer";
$owl_lang->alt_btn_news_admin		= "DMS News Administrator";
$owl_lang->alt_btn_site_features	= "Edit Site Features and Settings";
$owl_lang->alt_btn_statistics_viewer	= "DMS Statistics Viewer";
$owl_lang->alt_btn_users_groups		= "Administer Users and Groups";
$owl_lang->btn_backup			= "Backup<br />Database";
$owl_lang->btn_doctype_admin		= "Document<br />Types";
$owl_lang->btn_log_viewer		= "Log<br />Viewer";
$owl_lang->btn_news_admin		= "News<br />Admin";
$owl_lang->btn_site_features		= "Site<br />Features";
$owl_lang->btn_statistics_viewer	= "Statistics / Report <br />Viewer";
$owl_lang->btn_users_groups		= "Users &amp;<br />Groups";
$owl_lang->display_password_override	= "Display File/Folder Password Override";
$owl_lang->doc_id_num_digits		= "Doc# Number Digit to display";
$owl_lang->doc_id_prefix		= "Doc# Display Prefix String"; 
$owl_lang->docicon_column		= "Doc Icon";
$owl_lang->download_folder_zip		= "Download Folders as ZIP (Default is tar.gz)";
$owl_lang->save_keywords_to_db		= "Allow Users to save Keywords for Reuse";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Initial Major Revision";
$owl_lang->verminor_initial          	= "Initial Minor Revision";
$owl_lang->view_doc_in_new_window	= "New Window when Viewing Documents";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Editing User *****";
$owl_lang->edit_group  			= "***** Editing Group *****";
$owl_lang->enter_new_user               = "***** Adding New User *****";
$owl_lang->enter_new_group              = "***** Adding New Group *****";
$owl_lang->alt_btn_change_passwd        = "Change Your Old Password";
$owl_lang->alt_btn_cln_history          = "Purge Documents that are older (days) than" . LABEL_TERMINATOR;
$owl_lang->alt_btn_log_viewer           = "DMS System Log Viewer";
$owl_lang->alt_btn_report_viewer        = "DMS Reports Viewer";
$owl_lang->btn_change_passwd            = "Change Pass";
$owl_lang->btn_log_viewer               = "System Logs";
$owl_lang->btn_report_viewer            = "Reports";

// END NEW STUFF
$owl_lang->add				= "Add";
$owl_lang->alt_btn_trashcan		= "Click to View the Contents";
$owl_lang->anonymous_account		= "Anonymous Access Account" . LABEL_TERMINATOR;
$owl_lang->btn_trashcan			= "TrashCan";
$owl_lang->buttonstyle                  = "Button Style";
$owl_lang->confirm_initial_load		= "*** WARNING ***  This should only be run once when the database is empty";
$owl_lang->confirm_maint_mode		= "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Delete Group";
$owl_lang->deleteuser			= "Delete User";
$owl_lang->disable_recs_per_page	= "Enabling Restricted View Will DISABLE Records Per Page!";
$owl_lang->disableuser			= "Disable User";
$owl_lang->file_admin_group		= "File/Browser Admin Group" . LABEL_TERMINATOR;
$owl_lang->flushed           		= "Session table flushed, user can now log in again.";
$owl_lang->groups			= "Groups";
$owl_lang->hide_bulk_buttons		= "Hide the bulk buttons" . LABEL_TERMINATOR;
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_lnk_cl			= "Body Link Colour" . LABEL_TERMINATOR;
$owl_lang->ht_bd_txt_cl 		= "Body Text Colour" . LABEL_TERMINATOR;
$owl_lang->ht_bd_vlnk_cl 		= "Body Visited Link Colour" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_border_sz 		= "Table Border Size" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_cell_bg_al 		= "Table Cell Background Colour Alternate" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_cell_bg_cl 		= "Table Cell Background Colour" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_hd_bg			= "Header Background" . LABEL_TERMINATOR;
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Set Anonymous Access";
$owl_lang->header_group_admin           = "Group Administration";
$owl_lang->header_sitefeatures_settings           = "Site Features and Settings";
$owl_lang->header_user_admin           	= "User Administration";
$owl_lang->hide_folder_doc_count	= "Hide Folder File Type Count";
$owl_lang->hide_folder_size		= "Hide Folder Content Size";
$owl_lang->hide_panel			= "Hide";
$owl_lang->home_dir			= "User's Home Directory" . LABEL_TERMINATOR;
$owl_lang->initial_dir   		= "User's Initial Directory";
$owl_lang->maxsessions			= "Max No. Sessions";
$owl_lang->noprefaccess			= "Disable Pref";
$owl_lang->old_action_icons		= "Display Action icons instead of list";
$owl_lang->owl_anon_download     	= "Download Only";
$owl_lang->owl_anon_full		= "Full Access";
$owl_lang->owl_anon_ro			= "Read Only";
$owl_lang->owl_def_file_group_owner	= "Default File Group Owner" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_meta		= "Default File Meta Data" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_owner		= "Default File Owner" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_perm 		= "Default File Creation Policy" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_security	= "Default File Security" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_title		= "Default File Title (None for Filename)" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_group_owner	= "Default Folder Group Owner" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_owner		= "Default Folder Owner" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_sec		= "Default Folder Security" . LABEL_TERMINATOR;
$owl_lang->owl_def_folder_perm 		= "Default Folder Creation Policy" . LABEL_TERMINATOR;
$owl_lang->owl_default_tmpdir		= "Temp file Directory Location" . LABEL_TERMINATOR;
$owl_lang->owl_fogotpass		= "Show forgot password link" . LABEL_TERMINATOR;
$owl_lang->owl_group_user		= "Users that are member of this Group";
$owl_lang->owl_hidebackup		= "Hide the Backup Directory" . LABEL_TERMINATOR;
$owl_lang->owl_log_file			= "Log File Activities" . LABEL_TERMINATOR;
$owl_lang->owl_log_login_act		= "Log Login/Logout Activities" . LABEL_TERMINATOR;
$owl_lang->owl_log_rec_page		= "Log Viewer Records Per Page" . LABEL_TERMINATOR;
$owl_lang->owl_logging			= "Enable Logging" . LABEL_TERMINATOR;
$owl_lang->owl_logo			= "Login Page logo ([Language]/graphics)" . LABEL_TERMINATOR;
$owl_lang->owl_lookAtHDDel		= "Remove Deleted Files From DB";
$owl_lang->owl_max_filesize		= "Maximum Upload File Size (in bytes)";
$owl_lang->owl_owl_expand		= "Default Browser View (Expand)";
$owl_lang->owl_owl_timeout		= "Session Timeout in Seconds";
$owl_lang->owl_restrict_view		= "Enable Restricted View Feature" . LABEL_TERMINATOR;
$owl_lang->owl_self_reg			= "Enable Self Register" . LABEL_TERMINATOR;
$owl_lang->owl_self_reg_hd		= "SELF REGISTERED USER DEFAULTS";
$owl_lang->owl_title_browser		= "DMS BROWSER FEATURES";
$owl_lang->owl_title_custom		= "CUSTOMIZE BROWSER COLUMNS";
$owl_lang->owl_title_custom_search      = "CUSTOMIZE SEARCH RESULTS";
$owl_lang->owl_title_defaults   	= "DEFAULTS";
$owl_lang->owl_version_control		= "Enable Version Control Feature" . LABEL_TERMINATOR;
$owl_lang->quota			= "Quota 0=Disabled";
$owl_lang->reallydeluser		= "This user is owner of %numfiles% File(s) and %numfolders% Folder(s). These File(s) and Folder(s) will be orphaned. Is it Still Ok to Delete?";
$owl_lang->reallydeleteuser		= "Really Delete this User?";
$owl_lang->recs_per_page		= "Display Records Per Page (0 = Disabled)" . LABEL_TERMINATOR;
$owl_lang->remember_me			= "Show the Remember Me link";
$owl_lang->remember_me_checkbox		= "Remember me";
$owl_lang->remember_me_title		= "PERSISTENT LOGIN SETTINGS";
$owl_lang->remember_timeout		= "Cookie timeout in Days";
$owl_lang->search_result_folders	= "Include Folders in Search Results";
$owl_lang->show_action_title		= "Display action Buttons" . LABEL_TERMINATOR;
$owl_lang->show_bulk_title		= "Display Bulk Buttons" . LABEL_TERMINATOR;
$owl_lang->show_folder_title		= "Display Folder Tools" . LABEL_TERMINATOR;
$owl_lang->show_panel			= "Show";
$owl_lang->show_panel_title		= "Display Status Panel" . LABEL_TERMINATOR;
$owl_lang->show_pref_title		= "Display Pref/logout Bar" . LABEL_TERMINATOR;
$owl_lang->show_search_title		= "Display Search Bar" . LABEL_TERMINATOR;
$owl_lang->status_bar_both              = "Top And Bottom";
$owl_lang->status_bar_bottom            = "Bottom Only";
$owl_lang->status_bar_location          = "Display the status bar at the" . LABEL_TERMINATOR;
$owl_lang->status_bar_not               = "Do Not Display";
$owl_lang->status_bar_top               = "Top Only";
$owl_lang->use_popup			= "Use popup to display News" . LABEL_TERMINATOR;
$owl_lang->users           		= "Users";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Custom Fields inside Popup Description";
$owl_lang->cust_headpopup     		= "SPECIFIC DOCUMENT FIELDS";
$owl_lang->auth_http                    = "HTTP Auth (.htaccess)";
$owl_lang->auth_ldap                    = "LDAP Authentication";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Users that have this group as PRIMARY Group";
$owl_lang->create_user_homedir 		= "Create User HomeDir" . LABEL_TERMINATOR;
$owl_lang->use_captcha 			= "Use CAPTCHA" . LABEL_TERMINATOR;
$owl_lang->created_here 		= "<br /> (CREATED HERE IF create homedir checked)";
$owl_lang->auth_owl                     = "DMS Authentication";
$owl_lang->auth_pop3                    = "pop3 Authentication";
$owl_lang->file_desc_required           = "File Description Required";
$owl_lang->folder_desc_required         = "Folder Description Required";
$owl_lang->pass_account_lockout         = "Number of attempts to Lockout" . LABEL_TERMINATOR;
$owl_lang->pass_change_every            = "Force Password Change Every (in Days) 0=Disabled" . LABEL_TERMINATOR;
$owl_lang->pass_enable_account_lockout  = "Enable Account Lockout" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_length       = "Minimum Length of User set Passwords" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_numeric      = "Minimum number of numeric" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_special      = "Minimum number of Special Chars" . LABEL_TERMINATOR;
$owl_lang->pass_min_username_length     = "Minimum Length of User set Usernames" . LABEL_TERMINATOR;
$owl_lang->pass_track_old_passwords     = "Number of Previous Password to Keep Track" . LABEL_TERMINATOR;
$owl_lang->show_user_info           = "Displayed Usernames are Clickable";
$owl_lang->user_admin              = "User/group Admininstrator";
$owl_lang->user_auth_type                   = "Authentication Type" . LABEL_TERMINATOR;
$owl_lang->user_change_pass_next_login      = "Change Password at Next Login" . LABEL_TERMINATOR;
$owl_lang->user_expires                     = "Account Expires On" . LABEL_TERMINATOR;
$owl_lang->user_gmt_offset              = "User GMT Offset";
$owl_lang->user_group_admin                 = "File Admin for Primary Group" . LABEL_TERMINATOR;
$owl_lang->user_login_to_newrecords         = "Login to New Records Page" . LABEL_TERMINATOR;
$owl_lang->users_group_admin		= "Users that are Group Admin";

// -------------------------------------------------------
// Admin Tools - HTML Preferences
$owl_lang->btn_html_prefs		= "HTML<br />Preferences";
$owl_lang->html_title			= "HTML Preferences";
$owl_lang->alt_btn_html_prefs		= "Edit Site HTML Preferences";
$owl_lang->ht_collapse_width 		= "Collapse View Width" . LABEL_TERMINATOR;
$owl_lang->ht_expand_width		= "Expanded View Width" . LABEL_TERMINATOR;
$owl_lang->ht_bd_bg_image		= "Body Background Image Path" . LABEL_TERMINATOR;

// -------------------------------------------------------
// Admin Tools - Site Features and Settings
// -------------------------------------------------------

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - Message of the Day
$owl_lang->motd_headding = "Message of the Day MOTD";
$owl_lang->motd_label    = "Message (Blank For None)";

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - System E-Mail Settings
$owl_lang->owl_title_email			    = "System E-Mail Settings";

$owl_lang->owl_email_smtp			    = "Use SMTP Mailing Method";
$owl_lang->owl_use_smtp_extended                = "(to be supplied)";

$owl_lang->owl_email_smtp_auth		    = "Use SMTP Auth";
$owl_lang->owl_use_smtp_auth_extended           = "(to be supplied)";

$owl_lang->owl_use_smtp_ssl             = "SMTP SSL" . LABEL_TERMINATOR;
$owl_lang->owl_use_smtp_ssl_extended          = "(to be supplied)";

$owl_lang->owl_smtp_port                = "SMTP Port Number" . LABEL_TERMINATOR;
$owl_lang->owl_smtp_port_extended          = "(to be supplied)";

$owl_lang->owl_smtp_max_attachemnt_size = "Maximum Attachent Size (bytes)" . LABEL_TERMINATOR;
$owl_lang->owl_smtp_max_size_extended          = "(to be supplied)";

$owl_lang->owl_email_server             = "SMTP Server" . LABEL_TERMINATOR;
$owl_lang->owl_email_server_extended            = "(to be supplied)";

$owl_lang->owl_email_from               = "From Address" . LABEL_TERMINATOR;
$owl_lang->owl_email_from_extended              = "(to be supplied)";

$owl_lang->owl_email_smtp_auth_login    = "SMTP Auth Login" . LABEL_TERMINATOR;
$owl_lang->owl_smtp_auth_login_extended         = "(to be supplied)";

$owl_lang->owl_email_smtp_auth_passwd   = "SMTP Auth Password";
$owl_lang->owl_smtp_passwd_extended           	= "(to be supplied)";

$owl_lang->owl_email_fromname           = "From Name" . LABEL_TERMINATOR;
$owl_lang->owl_email_fromname_extended  	= "(to be supplied)";

$owl_lang->owl_email_replyto            = "Reply To Address" . LABEL_TERMINATOR;
$owl_lang->owl_email_replyto_extended   	= "(to be supplied)";

$owl_lang->owl_email_subject_pref       = "Subject Prefix" . LABEL_TERMINATOR;
$owl_lang->owl_email_subject_extended           = "(to be supplied)";

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - LOOK AT HD FOR NEW FILES
$owl_lang->owl_title_HD			= "LOOK AT HD FOR NEW FILES SETTINGS";

$owl_lang->owl_lookAtHD			= "Disable Look at hd" . LABEL_TERMINATOR;
$owl_lang->owl_lookAtHD_extended          = "Check this box to disable LookAtHD feature";

$owl_lang->owl_lookAtHD_del_extended            = "";

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - LOGGING SETTINGS
$owl_lang->owl_title_logging  		= "LOGGING SETTINGS";

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - OTHER SETTINGS
$owl_lang->owl_title_other		= "OTHER SETTINGS";
$owl_lang->time_offsets[0][0] = "-12";
$owl_lang->time_offsets[0][1] = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0] = "-11";
$owl_lang->time_offsets[1][1] = "(GMT-11:00) Midway Island, Samoa";
$owl_lang->time_offsets[2][0] = "-10";
$owl_lang->time_offsets[2][1] = "(GMT-10:00) Hawaii";
$owl_lang->time_offsets[3][0] = "-9";
$owl_lang->time_offsets[3][1] = "(GMT-9:00) Alaska";
$owl_lang->time_offsets[4][0] = "-8";
$owl_lang->time_offsets[4][1] = "(GMT-8:00) Pacific Time (US &amp; Canada)";
$owl_lang->time_offsets[5][0] = "-7";
$owl_lang->time_offsets[5][1] = "(GMT-7:00) Mountain Time (US &amp; Canada)";
$owl_lang->time_offsets[6][0] = "-6";
$owl_lang->time_offsets[6][1] = "(GMT-6:00) Central Time (US &amp; Canada), Mexico City";
$owl_lang->time_offsets[7][0] = "-5";
$owl_lang->time_offsets[7][1] = "(GMT-5:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito";
$owl_lang->time_offsets[8][0] = "-4";
$owl_lang->time_offsets[8][1] = "(GMT-4:00) Atlantic Time (Canada), Caracas, La Paz";
$owl_lang->time_offsets[9][0] = "-3.5";
$owl_lang->time_offsets[9][1] = "(GMT-3:30) Newfoundland";
$owl_lang->time_offsets[10][0] = "-3";
$owl_lang->time_offsets[10][1] = "(GMT-3:00) Brazil, Buenos Aires, Georgetown";
$owl_lang->time_offsets[11][0] = "-2";
$owl_lang->time_offsets[11][1] = "(GMT-2:00) Mid-Atlantic";
$owl_lang->time_offsets[12][0] = "-1";
$owl_lang->time_offsets[12][1] = "(GMT-1:00) Azores, Cape Verde Islands";
$owl_lang->time_offsets[13][0] = "0";
$owl_lang->time_offsets[13][1] = "(GMT) Western Europe Time, London, Lisbon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) Central Europe Time, Brussels, Copenhagen, Madrid, Paris";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) Eastern Europe Time, Kaliningrad, South Africa";
$owl_lang->time_offsets[16][0] = "3";
$owl_lang->time_offsets[16][1] = "(GMT+3:00) Baghdad, Kuwait, Riyadh, Moscow, St. Petersburg, Volgograd, Nairobi";
$owl_lang->time_offsets[17][0] = "3.5";
$owl_lang->time_offsets[17][1] = "(GMT+3:30) Tehran";
$owl_lang->time_offsets[18][0] = "4";
$owl_lang->time_offsets[18][1] = "(GMT+4:00) Abu Dhabi, Muscat, Baku, Tbilisi";
$owl_lang->time_offsets[19][0] = "4.5";
$owl_lang->time_offsets[19][1] = "(GMT+4:30) Kabul";
$owl_lang->time_offsets[20][0] = "5";
$owl_lang->time_offsets[20][1] = "(GMT+5:00) Ekaterinburg, Islamabad, Karachi, Tashkent";
$owl_lang->time_offsets[21][0] = "5.5";
$owl_lang->time_offsets[21][1] = "(GMT+5:30) Bombay, Calcutta, Madras, New Delhi";
$owl_lang->time_offsets[22][0] = "6";
$owl_lang->time_offsets[22][1] = "(GMT+6:00) Almaty, Dhaka, Colombo";
$owl_lang->time_offsets[23][0] = "7";
$owl_lang->time_offsets[23][1] = "(GMT+7:00) Bangkok, Hanoi, Jakarta";
$owl_lang->time_offsets[24][0] = "8";
$owl_lang->time_offsets[24][1] = "(GMT+8:00) Beijing, Perth, Singapore, Hong Kong, Chongqing, Urumqi, Taipei";
$owl_lang->time_offsets[25][0] = "9";
$owl_lang->time_offsets[25][1] = "(GMT+9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk";
$owl_lang->time_offsets[26][0] = "9.5";
$owl_lang->time_offsets[26][1] = "(GMT+9:30) Adelaide, Darwin";
$owl_lang->time_offsets[27][0] = "10";
$owl_lang->time_offsets[27][1] = "(GMT+10:00) East Australian Standard, Guam, Papua New Guinea, Vladivostok";
$owl_lang->time_offsets[28][0] = "11";
$owl_lang->time_offsets[28][1] = "(GMT+11:00) Magadan, Solomon Islands, New Caledonia";
$owl_lang->time_offsets[29][0] = "12";
$owl_lang->time_offsets[29][1] = "(GMT+12:00) Auckland, Wellington, Fiji, Kamchatka, Marshall Island";

// -------------------------------------------------------
// Admin Tools - Site Features - TRASH COLLECTION SETTINGS
$owl_lang->recycle_title		= "TRASH COLLECTION SETTINGS";
$owl_lang->recycle_enabled		= "Enable Trash Collection" . LABEL_TERMINATOR;
$owl_lang->recycle_location		= "Trash Can Location" . LABEL_TERMINATOR;
$owl_lang->owl_trash_can_location_extended          = "(to be supplied)";

$owl_lang->restore_file_prefix	= "String Prefixed to Restored Files";

// -------------------------------------------------------
// Admin Tools - Site Features and Settings - External Tool Names and Paths
$owl_lang->owl_title_tools   		= "EXTERNAL TOOL PATHS AND NAMES";
$owl_lang->admin_tools_external_leave_blank = "<br />Leave blank to disable" ;
//
$owl_lang->virus_path			= "Path to Virus Checking Software<br />Example: &ldquo;/usr/bin/clamscan --quiet&rdquo; " . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_virus_path_extended          = "(to be supplied)";

$owl_lang->owl_dbdump_path   	= "Path to DB Dump tool " . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_dbdump_path_extended          = "(to be supplied)";

$owl_lang->owl_gzip_path     	= "Path to gzip" . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_gzip_path_extended          = "(to be supplied)";

$owl_lang->owl_tar_path     	= "Path to tar" . $owl_lang->admin_tools_external_leave_blank  ;
$owl_lang->owl_tar_path_extended          = "(to be supplied)";

$owl_lang->owl_unzip_path     	= "Path to unzip" . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_unzip_path_extended          = "(to be supplied)";

$owl_lang->owl_pod2html_path    = "Path to pod2html <br />Perl 5.8.0 or Greater required" . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_pod2html_path_extended          = "(to be supplied)";

$owl_lang->rtftotext_path       = "Path to RTF to text tool " . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_rtftotext_path_extended          = "(to be supplied)";

$owl_lang->owl_pdftotext_path	= "Path to PDF to text tool<br />Maintains Search Index for PDF and text Files " . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_pdftotext_path_extended          = "(to be supplied)";

$owl_lang->owl_wordtotext_path  = "Path to MS-WORD to text tool" . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_wordtotext_path_extended          = "(to be supplied)";

$owl_lang->owl_ppttotext_path   = "Path to MS-POWERPOINT to text tool" . $owl_lang->admin_tools_external_leave_blank ;
$owl_lang->owl_ppttotext_path_extended          = "(to be supplied)";

$owl_lang->owl_pdf_pdftk_tool_greater_than_1_40_extended          = "(to be supplied)";

// -------------------------------------------------------
// Admin Tools - TrashCan
$owl_lang->alt_recycle		= "Trash Can<br />(Empty)";
$owl_lang->alt_recycle_disable	= "Trash Collection<br />(Disabled)";
$owl_lang->alt_recycle_not_found= "Trash Can<br />(Not Found or Not Writeable)";
$owl_lang->err_trash_can_empty 		= "The Trash Can is Empty";

// -------------------------------------------------------
// Admin Tools - Import Users
$owl_lang->alt_btn_import_users    = "Import users From CSV File";

$owl_lang->group_create         = "Group" . LABEL_TERMINATOR;
$owl_lang->header_csv_import    = "Import CSV User file";
$owl_lang->import_inserted      = "INSERTED";
$owl_lang->import_skipped       = "SKIPPED";
$owl_lang->invalid_groupid      = "Invalid groupid --> ";
$owl_lang->msg_user_exists      = "User Already Exists";
$owl_lang->sendcsvfile          = "Upload Comma delimited file";
$owl_lang->user_created_skipped = "User" . LABEL_TERMINATOR;

// -------------------------------------------------------
// Admin Tools - Initial Load
$owl_lang->btn_initial_load		= "Initial Load";
$owl_lang->alt_btn_initial_load		= "Load DB From Documents Folder";

// -------------------------------------------------------
// Admin Tools - Purge Historical
$owl_lang->btn_cln_history              = "Purge Historical";
$owl_lang->confirm_cln_history          = "Are You Sure you want to Purge Documents that are older (days) than" . LABEL_TERMINATOR;
$owl_lang->historical_purge             = "Historical Files Deleted";

// -------------------------------------------------------
// Admin Tools - Maintenance Mode
$owl_lang->btn_admin_maint_on		= "MAINTENANCE MODE";
$owl_lang->alt_btn_admin_maint_on	= "Blocks User sigon, so the administrator can perform a task without users on the system";
$owl_lang->btn_admin_maint_off		= "NORMAL MODE";
$owl_lang->alt_btn_admin_maint_off = "Turn Maintenace Mode Off (Permit Users to Login)";

// -------------------------------------------------------
// Admin Tools - User Tables

// -------------------------------------------------------
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	= "Filter";
$owl_lang->owl_log_hd_action	= "Action";
$owl_lang->owl_log_hd_agent	= "Agent";
$owl_lang->owl_log_hd_dt_tm	= "Date Time";
$owl_lang->owl_log_hd_dtls	= "Details";
$owl_lang->owl_log_hd_file	= "File";
$owl_lang->owl_log_hd_file_size	= "File Size";
$owl_lang->owl_log_hd_fld_path	= "Folder Path";
$owl_lang->owl_log_hd_ip	= "IP / Address";
$owl_lang->owl_log_hd_user	= "User";
$owl_lang->owl_log_hide      	= "Hide" . LABEL_TERMINATOR;
$owl_lang->owl_log_no_rec	= " NO RECORDS FOUND ";
$owl_lang->owl_log_viewer	= "LOG Viewer";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Empty Trash";
$owl_lang->really_empty_trash	= "Really Empty The Trash Can?";
$owl_lang->recycle_bin_admin    = "Trash Can Administration";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "The files you requested area attached.";
$owl_lang->trash_email_subject  = "RESTORED FILES YOU REQUESTED";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Do nothing &#8211; Leave file permissions alone";
$owl_lang->everyoneread			= "Everyone can read/download";
$owl_lang->everyoneread_ad		= "Everyone can read/download";
$owl_lang->everyonewrite		= "Everyone can read/write/download";
$owl_lang->everyonewrite_ad		= "Everyone can read/write/download";
$owl_lang->everyonewrite_ad_nod		= "Everyone can read/write/download, NO DELETE";
$owl_lang->everyonewrite_nod		= "Everyone can read/write/download, NO DELETE";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Everyone can read this folder";
$owl_lang->geveryoneread_ad		= "Everyone can read this folder";
$owl_lang->geveryonewrite		= "Everyone can upload files and delete this folder";
$owl_lang->geveryonewrite_ad		= "Everyone can upload files and delete this folder";
$owl_lang->geveryonewrite_ad_nod	= "Everyone can upload files to this folder";
$owl_lang->geveryonewrite_nod		= "Everyone can upload files to this folder";
$owl_lang->ggroupread			= "Your group can read this folder";
$owl_lang->ggroupread_ad		= "The selected group can read this folder";
$owl_lang->ggroupwrite			= "Your group can upload files and delete this folder";
$owl_lang->ggroupwrite_ad    		= "The selected group can upload files and delete this folder";
$owl_lang->ggroupwrite_ad_nod		= "The selected group can upload files to this folder";
$owl_lang->ggroupwrite_nod		= "Your group can upload files to this folder";
$owl_lang->ggroupwrite_worldread 	= "Your group can upload files and delete this folder &amp; everyone else can view contents";
$owl_lang->ggroupwrite_worldread_ad 	= "Selected group can upload files and delete this folder &amp; everyone else can view contents";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Selected group can upload files to this folder &amp; everyone else can view contents, NO DELETE";
$owl_lang->ggroupwrite_worldread_nod 	= "Your group can upload files to this folder &amp; everyone else can view contents, NO DELETE";
$owl_lang->gonlyyou			= "Only you can uploadfiles and delete this folder";
$owl_lang->gonlyyou_ad			= "Only you can uploadfiles and delete this folder";
$owl_lang->groupread			= "Your group can read/download";
$owl_lang->groupread_ad			= "The selected group can read/download";
$owl_lang->groupwrite			= "Your group can read/write/download";
$owl_lang->groupwrite_ad		= "The selected group can read/write/download";
$owl_lang->groupwrite_ad_nod		= "The selected group can read/write/download, NO DELETE";
$owl_lang->groupwrite_nod		= "Your group can read/write/download, NO DELETE";
$owl_lang->groupwrite_worldread 	= "Your group can read/write/download &amp; everyone else can read";
$owl_lang->groupwrite_worldread_ad 	= "The selected group can read/write/download &amp; everyone else can read";
$owl_lang->groupwrite_worldread_ad_nod 	= "The selected group can read/write/download (NO DELETE) &amp; everyone else can read";
$owl_lang->groupwrite_worldread_nod 	= "Your group can read/write/download (NO DELETE) &amp; everyone else can read";
$owl_lang->invalidsess			= "Invalid session id, please login<br />";
$owl_lang->notif_comment_1		= "commented on";
$owl_lang->notif_comment_2		= "Comment" . LABEL_TERMINATOR;
$owl_lang->notif_msg         		= "THIS IS AN AUTOMATED MESSAGE FROM DMS<br /><br />Find the new/updated file attached to this E-Mail<br /><br />";
$owl_lang->notif_msg_alt         	= "THIS IS AN AUTOMATED MESSAGE FROM DMS\n\nFind the new/updated file attached to this E-Mail\n\n";
$owl_lang->notif_msg_alt_link           = "THIS IS AN AUTOMATED MESSAGE FROM DMS\n\nFind a link to a new/updated file in this E-Mail\n\n";
$owl_lang->notif_msg_link               = "THIS IS AN AUTOMATED MESSAGE FROM DMS<br /><br />Find a link to a new/updated file in this E-Mail<br /><br />";
$owl_lang->notif_salutation		= "Dear";
$owl_lang->notif_subject_comment	= "A DMS File -- Comment Added";
$owl_lang->notif_subject_monitor	= "A DMS File or Folder you are MONITORING was updated";
$owl_lang->notif_subject_new 		= "New DMS File";
$owl_lang->notif_subject_new_note 	= "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "A DMS File was updated";
$owl_lang->notif_subject_file_deleted   = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account       = "A NEW ACCOUNT WAS CREATED FOR YOU";
$owl_lang->notif_user			= "Created/Update by" . LABEL_TERMINATOR;
$owl_lang->onlyyou			= "Only you can read/download/write";
$owl_lang->onlyyou_ad			= "Only you can read/download/write";
$owl_lang->orphaned			= "&#8211; NO Owner  &#8211;";
$owl_lang->owl_path			= "File Path" . LABEL_TERMINATOR;
$owl_lang->sessinuse			= "This session is in use on another computer, access denied<br />";
$owl_lang->sesstimeout			= "Your session has timed out, please re-login<br />";
$owl_lang->virus_infected 		= "VIRUS INFECTED FILE";
$owl_lang->virus_return_val		= "Virus Program Return value" . LABEL_TERMINATOR;
$owl_lang->watermark_string		= "Confidential";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Browse This Folder";
$owl_lang->title_browse_site     	= "Browse to this URL";
$owl_lang->title_download_view     	= "Download / View This File";
$owl_lang->title_edit_prefs     	= "View / Edit User Preferences";
$owl_lang->title_return_folder     	= "Return to";
$owl_lang->title_sort     		= "Order by";
$owl_lang->title_view_my     		= "View List of My Files";
$owl_lang->title_view_new     		= "View List of New Files Since My Last Visit";
$owl_lang->title_view_updated     	= "View List of Updated Files Since My Last Visit";

$owl_lang->alt_my     		        = "View a List of My Files";
$owl_lang->alt_group     		= "View of My Files in My Groups";
$owl_lang->alt_checked_out              = "View List of Files I Currently have Checheked out";
$owl_lang->alt_news                     = "Unread News items";
$owl_lang->alt_special_access           = "List of Files that I have access to outside my Folder Browse access";

//********************************************************
// HREF TITLE messages  END
//********************************************************


//********************************************************
// admin/news.php and newsread.php BEGIN
//********************************************************

$owl_lang->news_content			= "Content";
$owl_lang->news_hd			= "News";
$owl_lang->news_hd_audience		= "Target Audience";
$owl_lang->news_hd_created		= "Created On";
$owl_lang->news_hd_expires		= "Expires On";
$owl_lang->news_heading			= "News Heading";
$owl_lang->news_posted_date		= "News Posted" . LABEL_TERMINATOR;
$owl_lang->news_read			= "Read";
$owl_lang->news_title			= "News Administration";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: The Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." does not exists.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: The Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." is not writeable by the Web Server.";
$owl_lang->debug_file_not_exist		= "DEBUG: The required file &ldquo;$default->owl_fs_root" . "/%s &rdquo; does not exists.<br /> OR<br />The path specified by \$default->owl_fs_root in config/owl.php is wrong.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: The temporary Directory: %s does not exists.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: The temporary Directory: %s is not writeable by the Web Server.";
$owl_lang->debug_webserver_no_access	= "DEBUG: The webserver does not have read access to: <br />&ldquo;$default->owl_fs_root/%s&rdquo;. <br />Please fix the permissions and try again";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Statistics / Report Viewer";
$owl_lang->stats_files		= "Number of Files Per Users";
$owl_lang->stats_folders	= "Number of Folders Per Users";
$owl_lang->stats_information	= "DMS Logging and File logging needs to be turned on for this statistics to be displayed";
$owl_lang->stats_top		= "Top 20 downloads";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "USER Signon (Login / Failure / Logout)";
$owl_lang->stats_users_loggedin = "Currently Logged In";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Document Type Admininstration";
$owl_lang->doc_field_label	= "Field Label (Per Locale)";
$owl_lang->doc_field_name	= "Field Name";
$owl_lang->doc_field_pos	= "Field Pos";
$owl_lang->doc_field_required	= "Required?";
$owl_lang->doc_field_searchable	= "Searchable?";
$owl_lang->doc_field_size	= "Text Box: Field Size<br />Text Area: Number of Rows<br />Multiple Check Box: Number of Columns<br />";
$owl_lang->doc_new_doc_type	= "&#8211; ADD New Document Type &#8211;";
$owl_lang->doc_specific		= "DOCUMENT SPECIFIC FIELDS" . LABEL_TERMINATOR;
$owl_lang->document_type	= "Document Type";
$owl_lang->document_type_name	= "Document Type Name";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Insert in popup description?";
$owl_lang->doc_field_disp_label = "FIELD LABEL" . LABEL_TERMINATOR;
$owl_lang->doc_field_disp_sep = "SEPERATOR LABEL";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Display Browser" . LABEL_TERMINATOR;
$owl_lang->doc_field_show_in_list = "Show Field in Browse View" . LABEL_TERMINATOR;
$owl_lang->doc_field_type	= "Field Type" . LABEL_TERMINATOR;
$owl_lang->doc_field_values	= "Field Values Seperated With | " . LABEL_TERMINATOR;
$owl_lang->doc_fields = "Custom Fields";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Enable Peer Review Feature" . LABEL_TERMINATOR;
$owl_lang->owl_peer_review_opt  = "Make Peer Review Optional" . LABEL_TERMINATOR;
$owl_lang->owl_title_peer_review= "DOCUMENT PEER REVIEW FEATURE";
$owl_lang->owl_title_peer_review2= "Document Peer Review";
$owl_lang->peer_approval_title 	= "Documents Awaiting My Approval";
$owl_lang->peer_approved_body	= "Your file has been approved" . LABEL_TERMINATOR;
$owl_lang->peer_file_approved	= "File Approved" . LABEL_TERMINATOR;
$owl_lang->peer_file_final	= "Final Approval" . LABEL_TERMINATOR;
$owl_lang->peer_file_rejected	= "File Rejected" . LABEL_TERMINATOR;
$owl_lang->peer_file_to_review	= "File to review" . LABEL_TERMINATOR;
$owl_lang->peer_final_approval	= "[Final Approval]" . LABEL_TERMINATOR;
$owl_lang->peer_final_body	= "Your document has been approved by all requested reviewers.<br />Please login and make the document public<br />";
$owl_lang->peer_msg_to_reviewer	= "Message to Reviewers";
$owl_lang->peer_my_approval	= "Waiting my Approval";
$owl_lang->peer_notif_user	= "Created/Update by";
$owl_lang->peer_pending_approval= "My Pending Approval";
$owl_lang->peer_pending_title 	= "My Documents Pending Approval";
$owl_lang->peer_reject_reason   = "Rejection Reason";
$owl_lang->peer_rejected_body	= "Your file has been rejected" . LABEL_TERMINATOR;
$owl_lang->peer_review_body	= "Your approval has been requested for the following document" . LABEL_TERMINATOR;
$owl_lang->peer_reviewer_list	= "Reviewer(s)";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_satus_approved  = "&#8212; A P P R O V E D &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; P E N D I N G &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; R E J E C T E D &#8212;";
$owl_lang->peer_subj_approved	= "Your Document has been APPROVED";
$owl_lang->peer_subj_rejected	= "Your Document has been REJECTED";
$owl_lang->peer_subj_reminder	= "REMINDER: You have a file to review";
$owl_lang->peer_subj_review	= "You have a file to review";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Your document has been approved by all requested reviewers.<br />Your file has been made public.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Adding File ACL" . LABEL_TERMINATOR;
$owl_lang->acl_adding_folder           = "Adding Folder ACL" . LABEL_TERMINATOR;
$owl_lang->acl_available_groups        = "Available Group(s)";
$owl_lang->acl_available_users         = "Available User(s)";
$owl_lang->acl_edit_file               = "Editing File ACL" . LABEL_TERMINATOR;
$owl_lang->acl_edit_folder             = "Editing Folder ACL" . LABEL_TERMINATOR;
$owl_lang->acl_file_checkin            = "Check In/Out";
$owl_lang->acl_file_comment            = "Comment";
$owl_lang->acl_file_copy               = "Copy";
$owl_lang->acl_file_delete             = "Delete";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_modify             = "Properties";
$owl_lang->acl_file_monitor            = "Monitor";
$owl_lang->acl_file_move               = "Move";
$owl_lang->acl_file_read               = "Read";
$owl_lang->acl_file_search             = "Search Related";
$owl_lang->acl_file_set_acl            = "Set ACL";
$owl_lang->acl_file_update             = "Update";
$owl_lang->acl_file_view_log           = "View Log";
$owl_lang->acl_folder_copy             = "Copy";
$owl_lang->acl_folder_delete           = "Delete";
$owl_lang->acl_folder_modify           = "Modify Properties";
$owl_lang->acl_folder_monitor          = "Monitor";
$owl_lang->acl_folder_move             = "Move";
$owl_lang->acl_folder_read             = "Read (Download/Browse)";
$owl_lang->acl_folder_set_acl          = "Set ACL";
$owl_lang->acl_folder_write            = "Write (Create)";
$owl_lang->acl_heading_file            = "Group(s)/User(s)";
$owl_lang->acl_heading_files           = "FILES &#8211; SELECT DESIRED USER(s) and GROUP(s)";
$owl_lang->acl_heading_folder          = "Group(s)/User(s)";
$owl_lang->acl_heading_folders         = "FOLDERS &#8211; SELECT DESIRED USER(s) and GROUP(s)";
$owl_lang->acl_propagate_file          = "Set This Policy on \"ALL\" Files" . LABEL_TERMINATOR;
$owl_lang->acl_propagate_folders       = "Propagate to all subfolder(s)" . LABEL_TERMINATOR;
$owl_lang->acl_selected_groups         = "Selected Group(s)";
$owl_lang->acl_selected_users          = "Selected User(s)";
$owl_lang->acl_set_acl                 = "Set Security Policy";
$owl_lang->acl_set_acl_now             = "Set Security Policy Now" . LABEL_TERMINATOR;
$owl_lang->acl_set_selected            = "Set Selected";
$owl_lang->alt_acl_save_file           = "Save File Security Policy";
$owl_lang->alt_acl_save_folder         = "Save Folder Security Policy";
$owl_lang->btn_acl_save                = "Save";
$owl_lang->acl_set_file_permissions    = "Set File Permissions";
$owl_lang->acl_set_folder_permissions  = "Set Folder Permissions";
$owl_lang->alt_set_folder_acl	       = "Set Current Folder Security Policy";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Available Reports" . LABEL_TERMINATOR;
$owl_lang->report_file_folder               = "File/Folder";
$owl_lang->report_filter                    = "Filter" . LABEL_TERMINATOR;
$owl_lang->report_filter_since              = "Since" . LABEL_TERMINATOR;
$owl_lang->report_full_access               = "FULL ACCESS";
$owl_lang->report_select_report             = "&#8211; Select a Report &#8211;";
$owl_lang->report_users_disabled_title      = "Disabled User(s)";
$owl_lang->report_users_entitlement         = "User Access List";
$owl_lang->report_users_inactive_title      = "User(s) Inactive Since";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Enable Thumbnail View/Generation" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_tool_path       = "Path to ImageMagick convert Tool" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Mplayer Parameters" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Path to Mplayer" . LABEL_TERMINATOR;
$owl_lang->thumb_image_info                = "Image Info";
$owl_lang->thumb_large_width               = "Thumbnail Width(LARGE) Pixels" . LABEL_TERMINATOR;
$owl_lang->thumb_med_width                 = "Thumbnail Width(MED) Pixels" . LABEL_TERMINATOR;
$owl_lang->thumb_number_colums             = "Number of Columns for Thumbnail View" . LABEL_TERMINATOR;
$owl_lang->thumb_re_generate               = "Generate Thumbnail";
$owl_lang->thumb_small_width               = "Thumbnail Width(SMALL) 0=Do not Display Pixels" . LABEL_TERMINATOR;
$owl_lang->thumb_title                     = "THUMBNAIL VIEW/GENERATION OPTIONS";
$owl_lang->thumb_title_thumb_view          = "THUMB VIEW DETAILS";
$owl_lang->thumb_image_size                = "Image Size" . LABEL_TERMINATOR;
$owl_lang->alt_thumb_small                 = "Small Thumb Nail";
$owl_lang->alt_no_thumb                    = "No Thumb Nail Available";

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// EXTENDED HELP BEGIN
//********************************************************


$owl_lang->owl_action_buttons_extended          = "(to be supplied)";
$owl_lang->owl_admin_login_to_browse_page_extended          = "(to be supplied)";
$owl_lang->owl_allow_custpopup_extended          = "(to be supplied)";
$owl_lang->owl_allow_different_filename_update_extended          = "(to be supplied)";
$owl_lang->owl_allow_popup_extended          = "(to be supplied)";
$owl_lang->owl_anon_ro_extended          = "(to be supplied)";
$owl_lang->owl_auto_checkout_checking_extended          = "(to be supplied)";
$owl_lang->owl_bulk_buttons_extended          = "(to be supplied)";
$owl_lang->owl_change_password_every_extended          = "(to be supplied)";
$owl_lang->owl_collect_trash_extended          = "(to be supplied)";
$owl_lang->owl_cookie_timeout_extended          = "(to be supplied)";
$owl_lang->owl_def_anon_user_extended          = "(to be supplied)";
$owl_lang->owl_def_file_meta_extended           = "(to be supplied)";
$owl_lang->owl_def_file_title_extended           = "(to be supplied)";
$owl_lang->owl_default_revision_extended          = "(to be supplied)";
$owl_lang->owl_doc_id_num_digits_extended          = "(to be supplied)";
$owl_lang->owl_doc_id_prefix_extended          = "(to be supplied)";
$owl_lang->owl_docRel_extended          = "(to be supplied)";
$owl_lang->owl_enable_lock_account_extended          = "(to be supplied)";
$owl_lang->owl_file_admin_group_extended          = "(to be supplied)";
$owl_lang->owl_filedescreq_extended             = "Make the File Description a REQUIRED Field";
$owl_lang->owl_folder_tools_extended          = "(to be supplied)";
$owl_lang->owl_folderdescreq_extended          = "(to be supplied)";
$owl_lang->owl_force_ssl_extended          = "(to be supplied)";
$owl_lang->owl_forgot_pass_extended             = "(to be supplied)";
$owl_lang->owl_hide_backup_extended          = "(to be supplied)";
$owl_lang->owl_hide_folder_doc_count_extended          = "(to be supplied)";
$owl_lang->owl_hide_folder_size_extended          = "(to be supplied)";
$owl_lang->owl_html2text_path_extended  	= "(to be supplied)";
$owl_lang->owl_info_panel_wide_extended 	= "(to be supplied)";
$owl_lang->owl_leave_old_file_accessible_extended          = "(to be supplied)";
$owl_lang->owl_lock_account_bad_password_extended          = "(to be supplied)";
$owl_lang->owl_log_file_extended          = "(to be supplied)";
$owl_lang->owl_log_login_extended          = "(to be supplied)";
$owl_lang->owl_log_rec_per_page_extended          = "(to be supplied)";
$owl_lang->owl_logging_extended          = "(to be supplied)";
$owl_lang->owl_machine_time_zone_extended          = "(to be supplied)";
$owl_lang->owl_major_revision_extended          = "(to be supplied)";
$owl_lang->owl_make_file_indexing_user_selectable_extended          = "(to be supplied)";
$owl_lang->owl_max_filesize_extended          = "(to be supplied)";
$owl_lang->owl_min_pass_length_extended          = "(to be supplied)";
$owl_lang->owl_min_pass_numeric_extended          = "(to be supplied)";
$owl_lang->owl_min_pass_special_extended          = "(to be supplied)";
$owl_lang->owl_min_username_length_extended          = "(to be supplied)";
$owl_lang->owl_minor_revision_extended          = "(to be supplied)";
$owl_lang->owl_old_action_icons_extended        = "(to be supplied)";
$owl_lang->owl_owl_expand_extended          = "(to be supplied)";
$owl_lang->owl_owl_timeout_extended          = "(to be supplied)";
$owl_lang->owl_owl_tmpdir_extended          = "(to be supplied)";
$owl_lang->owl_password_override_extended       = "If this is set then users that don't have access to the file can use a password to download";
$owl_lang->owl_pdf_custom_watermark_filepath_extended          = "(to be supplied)";
$owl_lang->owl_pdf_watermark_path_extended          = "(to be supplied)";
$owl_lang->owl_pdf_watermarks_extended          = "(to be supplied)";
$owl_lang->owl_peer_opt_extended          = "(to be supplied)";
$owl_lang->owl_peer_review_extended          = "(to be supplied)";
$owl_lang->owl_pref_bar_extended          = "(to be supplied)";
$owl_lang->owl_rec_per_page_extended          = "(to be supplied)";
$owl_lang->owl_remember_me_extended             = "(to be supplied)";
$owl_lang->owl_restore_file_prefix_extended          = "(to be supplied)";
$owl_lang->owl_restrict_view_extended          = "(to be supplied)";
$owl_lang->owl_save_keywords_to_db_extended          = "(to be supplied)";
$owl_lang->owl_search_bar_extended          = "(to be supplied)";
$owl_lang->owl_search_result_folders_extended          = "(to be supplied)";
$owl_lang->owl_self_captcha_extended          = "(to be supplied)";
$owl_lang->owl_self_create_homedir_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_attachfile_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_disabled_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_extended                = "(to be supplied)";
$owl_lang->owl_self_reg_group_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_maxsessions_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_noprefacces_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_notify_extended          = "(to be supplied)";
$owl_lang->owl_self_reg_quota_extended          = "(to be supplied)";
$owl_lang->owl_show_folder_desc_as_popup_extended          = "(to be supplied)";
$owl_lang->owl_show_user_info_extended          = "(to be supplied)";
$owl_lang->owl_status_bar_location_extended     = "(to be supplied)";
$owl_lang->owl_thumbnail_view_columns_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_extended         	= "(to be supplied)";
$owl_lang->owl_thumbnails_large_width_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_med_width_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_small_width_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_tool_path_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_video_tool_opt_extended          = "(to be supplied)";
$owl_lang->owl_thumbnails_video_tool_path_extended          = "(to be supplied)";
$owl_lang->owl_track_favorites_extended         = "Track Favorites";
$owl_lang->owl_track_user_passwords_extended          = "(to be supplied)";
$owl_lang->owl_turn_file_index_off_extended          = "(to be supplied)";
$owl_lang->owl_use_wysiwyg_for_textarea_extended          = "(to be supplied)";
$owl_lang->owl_use_zip_extended          = "(to be supplied)";
$owl_lang->owl_version_control_extended          = "(to be supplied)";
$owl_lang->owl_view_doc_in_new_window_extended 	= "When you View A document the document is viewed in a seperate window";


//********************************************************
// EXTENDED HELP END
//********************************************************

$owl_lang->group_set_selected      = "Set Selected";
$owl_lang->alt_group_set_selected  = "Sets the selceted users";

$owl_lang->owl_force_browser_to_ssl             = "Force Browser to use HTTPS" . LABEL_TERMINATOR;
$owl_lang->owl_file_update_different_name       = "File Update with Different Name:<br />(EXTENSION Must remain the same.)";
$owl_lang->owl_use_wysiwyg_editor               = "Use WYSIWYG Editor for TextArea" . LABEL_TERMINATOR;
$owl_lang->owl_show_folder_desc_popup           = "Show Folder Description as Popup" . LABEL_TERMINATOR;
$owl_lang->owl_header_watermarking              = "PDF WATER MARKING OPTIONS";
$owl_lang->owl_enable_watermarking              = "Enable Pdf Watermarking" . LABEL_TERMINATOR;
$owl_lang->owl_path_to_pdftk                    = "Path to pdftk" . LABEL_TERMINATOR;
$owl_lang->owl_path_to_pdftk_bg_file            = "Path to custom watermark:<br />(path to a 1 page pdf file that will be used <br />as the watermark instead of the default";
$owl_lang->owl_pdftk_greater_than_1_40          = "PDFTK version Greater than 1.40" . LABEL_TERMINATOR;
$owl_lang->owl_indexing_user_selectable         = "Make File Indexing User Selectable" . LABEL_TERMINATOR;
$owl_lang->owl_indexing_off                     = "Turn File Indexing OFF" . LABEL_TERMINATOR;
$owl_lang->owl_default_revision_type            = "Default Revision Type" . LABEL_TERMINATOR;
$owl_lang->owl_machine_timezone                 = "Machine Time zone" . LABEL_TERMINATOR;
$owl_lang->owl_previous_ver_downloadable        = "Make Previous Version Accesible" . LABEL_TERMINATOR;
$owl_lang->owl_auto_checkin_checkout            = "Mark Files as Checked out on Download" . LABEL_TERMINATOR;
$owl_lang->owl_user_default_view                = "User Default View EXPANDED" . LABEL_TERMINATOR;
$owl_lang->owl_user_default_revision            = "Default Revision Type" . LABEL_TERMINATOR;
$owl_lang->owl_user_major_revision              = "User Initial Major Revision" . LABEL_TERMINATOR;
$owl_lang->owl_user_minor_revision              = "User Initial Minor Revision" . LABEL_TERMINATOR;
$owl_lang->owl_user_pdfwatermark                = "PDF get Watermarked" . LABEL_TERMINATOR;
$owl_lang->owl_user_email_pass                  = "Email User / Password" . LABEL_TERMINATOR;
$owl_lang->owl_use_email_signature              = "Use Signature?" . LABEL_TERMINATOR;
$owl_lang->owl_email_signature                  = "Email Signature" . LABEL_TERMINATOR;
$owl_lang->owl_file_link                        = "File Link" . LABEL_TERMINATOR;
$owl_lang->alt_hot_link                         = "Display Direct URL";
$owl_lang->alt_link_folder                      = "Link This Folder";

//********************************************************
// Field Types BEGIN
//********************************************************
$owl_lang->field_type_text = "Text";
$owl_lang->field_type_picklist = "Pick List";
$owl_lang->field_type_textarea = "Text Area";
$owl_lang->field_type_checkbox = "Check Box";
$owl_lang->field_type_mcheckbox = "Multiple Check Box";
$owl_lang->field_type_radio = "Radio Button";
$owl_lang->field_type_separator = "Separator";
$owl_lang->field_type_table = "Select Box FROM Table";
$owl_lang->field_type_URL = "URL";
$owl_lang->field_type_Date = "Date";
//********************************************************
// Field Types END
//********************************************************

//********************************************************
// Extensions Text BEGIN
//********************************************************
$owl_lang->tables_btn = "User Tables";
$owl_lang->tables_header = "User Tables Management";
$owl_lang->table = "Table";
$owl_lang->tuple = "Tuple";
$owl_lang->tables_tupleView = "View Tuples";
$owl_lang->tables_tupleAdd = "Add Tuple";
$owl_lang->tables_tableEdit = "Modify Table";
$owl_lang->tables_tableAdd = "Add Table";
$owl_lang->tables_descr = "Description";
$owl_lang->tables_descr2 = "Extended Description";
$owl_lang->tables_tupleEdit = "Edit";
$owl_lang->tables_tupleDelete = "Delete";
$owl_lang->tables_actions = "Actions";
$owl_lang->tables_tupleDeleted = "The tuple was successfully deleted!";
$owl_lang->tables_tupleAdded = "The tuple was successfully added!";
$owl_lang->tables_tupleEdited = "The tuple was successfully edited!";
$owl_lang->tables_back = "Back";
$owl_lang->tables_quickAdd = "Add";
$owl_lang->tables_refresh = "Refresh";

$owl_lang->calendar_title = "Calendar";

$owl_lang->docRel_title = "CONFIGURE DOCUMENT RELATIONSHIPS";
$owl_lang->docRel_activateFunction = "Activate relationships between files";
$owl_lang->docRel_list = "Related documents";
//********************************************************
// Extensions Text END
//********************************************************

$owl_lang->rss_feed_label = "RSS Tracking On Folder?";
$owl_lang->rss_feed_yes_label = "Yes";
$owl_lang->rss_feed_no_label = "No";

$owl_lang->file_expires = "File Expires on" . LABEL_TERMINATOR;
$owl_lang->btn_scan = "Scan";
$owl_lang->btn_scan_alt = "Upload From Twain Device";

$owl_lang->past_number = "Past number of Days " . LABEL_TERMINATOR;

$owl_lang->ownership_change_1 = "You do not own this file.";
$owl_lang->ownership_change_2 = "Would you like to take ownership on Checkout?";
$owl_lang->ownership_change_subj = "File: %s -- Take Ownership (%s)";

$owl_lang->member_membership = "Membership";
$owl_lang->member_fileadmin = "File Admin";
$owl_lang->member_group = "Group";

$owl_lang->user_created = "Created.";
$owl_lang->err_bad_username	= "Please enter a valid username or email address";


$owl_lang->mtool_page_title   = "E-Mail Tool";
$owl_lang->add_folder_page_title   = "Create New Folder";
$owl_lang->add_archive_page_title  = "Upload Zip File";
$owl_lang->add_file_page_title     = "Upload New Document";
$owl_lang->add_url_page_title     = "Add a URL";
$owl_lang->add_note_page_title     = "Add a New Note";
$owl_lang->edit_folder_page_title     = "Modify Folder Properties";
$owl_lang->copy_folder_page_title     = "Copy a Folder";
$owl_lang->move_folder_page_title     = "Move a Folder";
$owl_lang->link_folder_page_title     = "Link a Folder to Another Directory";
$owl_lang->setacl_folder_page_title     = "Set Folder Security Policy";
$owl_lang->setacl_file_page_title     = "Set File Security Policy";
$owl_lang->edit_file_page_title     = "Modify File Properties";
$owl_lang->copy_file_page_title     = "Copy a File";
$owl_lang->move_file_page_title     = "Move a File";
$owl_lang->upd_file_page_title     = "Update a File";
$owl_lang->email_file_page_title     = "E-Mail a File";
$owl_lang->comment_file_page_title     = "Add / View / Edit A Comment to a File";
$owl_lang->link_file_page_title     = "Link a File to Another Directory";
$owl_lang->jupload_page_title     = "Bulk File Upload";
$owl_lang->bulk_move_page_title   = "Bulk Moving...";
$owl_lang->bulk_mail_page_title   = "Bulk Emailing...";
$owl_lang->view_page_title   = "View File Details...";
$owl_lang->viewing_page_title   = "Viewing...";
$owl_lang->playing_page_title   = "Playing...";
$owl_lang->searching_page_title   = "Searching...";

$owl_lang->syslog_filename = "File Name" . LABEL_TERMINATOR;
$owl_lang->syslog_date_from = "Date From (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_date_to = "Date to   (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_ip_host = "IP Address(HostName)" . LABEL_TERMINATOR;
$owl_lang->alt_gen_csv     = "Generate CSV Version of the above File";
$owl_lang->btn_gen_csv     = "Generate CSV";
$owl_lang->empty_folder   = " E M P T Y &nbsp;  F O L D E R ";


$owl_lang->alt_tables_btn = "Table";
$owl_lang->alt_btn_admin_users = "User Administration";
$owl_lang->alt_btn_admin_groups = "Group Administration";

$owl_lang->alt_btn_main_menu_collapse = "Collapse/Open The Main Menu";

$owl_lang->email_reply_to_name = "Document Management System";

// *********************************
// report/duplicate_filename.php
// **********************************

$owl_lang->report7_title = "List Files with Duplicate File Name";
$owl_lang->report7_report_title = "List of Duplicate Files Repository Wide";
$owl_lang->report7_title_fileid = "File ID";
$owl_lang->report7_title_docnum = "Doc#";
$owl_lang->report7_title_file_name = "File Name";
$owl_lang->report7_title_file_size = "File Size";
$owl_lang->report7_title_file_count = "File Count";
$owl_lang->report7_title_file_path = "File path";

// *********************************
// Maximumn Download Count Feature
// *********************************
$owl_lang->maximum_download_title = "DOWNLOAD COUNT FEATURE";
$owl_lang->maximum_download_feature = "Enable Download Count Feature" . LABEL_TERMINATOR;
$owl_lang->maximum_download_feature_extended = "Feature that Tracks the number of downloaded files and the total number of Bytes downloated, and blocks the user if Tresholds are reached.  This feature is to prevent Download abuse";
$owl_lang->maximum_download_trigger = "Max # File Download Trigger" . LABEL_TERMINATOR;
$owl_lang->maximum_download_trigger_extended = "Maximun number of downloads in a set number of seconds";
$owl_lang->maximum_download_size_trigger = "Max Size in bytes Download Trigger" . LABEL_TERMINATOR;
$owl_lang->maximum_download_size_trigger_extended = "Total Size in bytes a user can download before he will be blocked from downloading any files";
$owl_lang->maximum_download_block = "Block User when Limits Reached" . LABEL_TERMINATOR;
$owl_lang->maximum_download_block_extended = "Account gets Disabled when the either of the threshold gets Reached, except users that are marked excluded from this feature in their Profile";
$owl_lang->maximum_download_len = "Session Length in Minutes" . LABEL_TERMINATOR;
$owl_lang->maximum_download_notify = "Comma separated Notification List" . LABEL_TERMINATOR;

$owl_lang->maximum_download = "Your account has been Disabled. Contact your Administrator. ";

$owl_lang->user_dl_count_excluded_label = "User Excluded From Download Count Feature" . LABEL_TERMINATOR;;
$owl_lang->user_dl_count_excluded_extended = "Exclude this user from the Download Count Feature";

$owl_lang->user_access_webdav_label     = "Web Dav";
$owl_lang->user_access_interface_label  = "Web Interface";
$owl_lang->user_access_both_label       = "Both";
$owl_lang->user_access_label            = "User Interface Access" . LABEL_TERMINATOR;;
$owl_lang->user_access_extended         = "Type of Acccess This user is granted";
$owl_lang->user_access_msg            = "Web Interface Access Denied";

$owl_lang->user_dl_count_subject        = "Download Threshold Notification";
$owl_lang->user_dl_count_disabled       = "User Account was DISABLED";

?>
