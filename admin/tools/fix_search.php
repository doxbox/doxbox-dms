<?php
/**
 * fix_search.php --  
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 1999-2011 The Owl Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 */

//*********************************************************
$iVerbose = 1;

//*********************************************************
$dStartTime = time();

if (!empty($_SERVER['HTTP_USER_AGENT']) or !empty($_SERVER['HTTP_REFERER']))
{
   exit("Sorry");
}

require_once(dirname(dirname(dirname(__FILE__))) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/indexing.lib.php");
//require_once($default->owl_fs_root . "/lib/owl.lib.php");
//$default->debug = false;



class Owl_DB extends DB_Sql
{
   var $classname = "Owl_DB";
   // Server where the database resides
   var $Host = "";
   // Database name
   var $Database = "";
   // User to access database
   var $User = "";
   // Password for database
   var $Password = "";

   function Owl_DB()
   {
      global $default;
      if(!isset($default->owl_current_db))
      {
         $db = $default->owl_default_db;
      }
      else
      {
         $db = $default->owl_current_db;
      }

      $this->Host = $default->owl_db_host[$db];
      $this->Database = $default->owl_db_name[$db];
      $this->User = $default->owl_db_user[$db];
      $this->Password = $default->owl_db_pass[$db];

   }
   function haltmsg($msg)
   {
      printf("$owl_lang->err_database: %s\n", $msg);
      printf("$owl_lang->err_sql: %s (%s)\n",
         $this->Errno, $this->Error);
   }
}
function get_dirpath($parent)
{
   global $default, $cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }

   global $sess, $expand;
   $name = fid_to_name($parent);
   $navbar = "$name";
   $new = $parent;
   while ($new != "1")
   {
      $sql->query("SELECT parent from $default->owl_folders_table where id = '$new'");
      $sql->next_record();
          $newparentid = $sql->f("parent");
      if ($newparentid == "")
          {
             break;
          }
      $name = fid_to_name($newparentid);
      $navbar = "$name/" . $navbar;
      $new = $newparentid;
   }
   return $navbar;
}


function fid_to_name($parent)
{
   global $default, $cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }

   if (empty($parent))
   {
      $parent=0;
   }
   $sql->query("SELECT name from $default->owl_folders_table where id = '$parent'");
   while ($sql->next_record())
   {
      return $sql->f("name");
   }
}

function fFindFileExtension ($filename)
{
   $filesearch = explode('.', $filename);
   $extensioncounter = 0;
   while ($filesearch[$extensioncounter + 1] != null)
   {
      // pre-append a "." separator in the name for each
      // subsequent part of the the name of the file.
      if ($extensioncounter != 0)
      {
         $firstpart = $firstpart . ".";
      }
      $firstpart = $firstpart . $filesearch[$extensioncounter];
      $extensioncounter++;
   }
   if ($extensioncounter == 0)
   {
      $firstpart = $filename;
      $file_extension = '';
   }
   else
   {
      $file_extension = $filesearch[$extensioncounter];
   }
   return strtolower($file_extension);
}


function find_path($parent, $bDisplayOnly = false)
{
   global $default;
   $path = fid_to_name($parent);
   $sql = new Owl_DB;

   if ($bDisplayOnly === true)
   {
      $iStopFolder = $default->HomeDir;
   }
   else
   {
      $iStopFolder = 1;
   }

   if (empty($parent))
   {
     return ("[ ORPHANED ]");
   }

   while ($parent != $iStopFolder and $parent > 0)
   {
      $sql->query("SELECT parent from $default->owl_folders_table where id = '$parent' and 1=1");
      if ( $sql->num_rows() == 1)
      {
         while ($sql->next_record())
         {
            $path = fid_to_name($sql->f("parent")) . DIR_SEP . $path;
            $parent = $sql->f("parent");
         }
      }
      else
      {
         return ("[ ORPHANED ]");
      }

   }
   return $path;
}

function fOwl_ereg_replace ($sPattern, $sSubstitute, $sString)
{
   if (function_exists('mb_ereg_replace'))
   {
      //return addslashes(mb_ereg_replace($sPattern, $sSubstitute, $sString));
      return mb_ereg_replace($sPattern, $sSubstitute, $sString);
   }
   else
   {
      //return addslashes(ereg_replace($sPattern, $sSubstitute, $sString));
      return ereg_replace($sPattern, $sSubstitute, $sString);
   }
}
function getprefs ()
{
   global $default, $userid, $owl_lang, $cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }

   define ("NEW_FILE", "0");
   define ("UPDATED_FILE", "1");
   define ("NEW_COMMENT", "2");
   define ("DELETED_FILE", "3");
   define ("NEW_PASSWORD", "4");
   define ("NEW_APPROVED", "5");
   define ("REMINDER_APPROVED", "6");
   define ("FINAL_APPROVED", "7");
   define ("FINAL_AUTO_APPROVED", "8");
   define ("REJECT_APPROVED", "9");
   define ("ADMIN_PASSWORD", "10");
   define ("APPROVED", "11");
   define ("SELF_REG_USER", "12");

   define ("LOGIN", "1");
   define ("LOGIN_FAILED", "2");
   define ("LOGOUT", "3");
   define ("FILE_DELETED", "4");
   define ("FILE_UPLOAD", "5");
   define ("FILE_UPDATED", "6");
   define ("FILE_DOWNLOADED", "7");
   define ("FILE_CHANGED", "8");
   define ("FILE_LOCKED", "9");
   define ("FILE_UNLOCKED", "10");
   define ("FILE_EMAILED", "11");
   define ("FILE_MOVED", "12");
   define ("FOLDER_CREATED", "13");
   define ("FOLDER_DELETED", "14");
   define ("FOLDER_MODIFIED", "15");
   define ("FOLDER_MOVED", "16");
   define ("FORGOT_PASS", "17");
   define ("USER_REG", "18");
   define ("FILE_VIEWED", "19");
   define ("FILE_VIRUS", "20");
   define ("FILE_COPIED", "21");
   define ("FOLDER_COPIED", "22");
   define ("FILE_LINKED", "23");
   define ("USER_ADMIN", "24");
   define ("TRASH_CAN", "25");
   define ("FILE_ACL", "26");
   define ("FOLDER_ACL", "27");
   define ("FOLDER_DISTRIBUTE", "28");
   define ("FOLDER_LINKED", "29");
   define ("FILE_REVIEW", "30");
   define ("FILE_APPROVED", "31");
   define ("FILE_REJECTED", "32");
   define ("FILE_PUBLISHED", "33");

   $sql->query("SELECT * from $default->owl_prefs_table");
   $sql->next_record();

   $default->owl_email_from = $sql->f("email_from");
   $default->owl_email_fromname = $sql->f("email_fromname");
   $default->owl_email_replyto = $sql->f("email_replyto");
   $default->owl_email_server = $sql->f("email_server");
   $default->owl_email_subject = $sql->f("email_subject");
   $default->use_smtp_ssl = $sql->f("smtp_ssl");
   $default->allow_different_filename_update = $sql->f("different_filename_update");
   $default->smtp_port = $sql->f("smtp_port");
   $default->smtp_max_size = $sql->f("smtp_max_size");
   $default->use_smtp = $sql->f("use_smtp");
   $default->use_smtp_auth = $sql->f("use_smtp_auth");
   $default->smtp_auth_login  = $sql->f("smtp_auth_login");
   $default->smtp_passwd = $sql->f("smtp_passwd");
   // 
   // LookAtHD is not supported with $default->owl_use_fs = false
   // 
   if ($default->owl_use_fs)
   {
      $default->owl_LookAtHD = $sql->f("lookathd");
   }
   else
   {
      if (substr(php_uname(), 0, 7) == "Windows")
      {
         $default->owl_compressed_database = 0;
      }
      $default->owl_LookAtHD = "false";
   }

   $default->owl_lookAtHD_del = $sql->f("lookathddel");
   $default->owl_def_file_security = $sql->f("def_file_security");
   $default->owl_def_file_group_owner = $sql->f("def_file_group_owner");
   $default->owl_def_file_owner = $sql->f("def_file_owner");
   $default->owl_def_file_title = $sql->f("def_file_title");
   $default->owl_def_file_meta = $sql->f("def_file_meta");
   $default->owl_def_fold_security = $sql->f("def_fold_security");
   $default->owl_def_fold_group_owner = $sql->f("def_fold_group_owner");
   $default->owl_def_fold_owner = $sql->f("def_fold_owner");
   $default->max_filesize = $sql->f("max_filesize");
   $default->owl_timeout = $sql->f("timeout");
   if ($sql->f("tmpdir") == "")
   {
      $default->owl_tmpdir = $default->owl_FileDir;
      $default->owl_tmpdir .= DIR_SEP . fid_to_name(1);
   }
   else
   {
      $default->owl_tmpdir = $sql->f("tmpdir");
   }
   $default->expand = $sql->f("expand");
   $default->owl_version_control = $sql->f("version_control");
   $default->default_revision = $sql->f("default_revision");
   $default->major_revision = $sql->f("major_revision");
   $default->minor_revision = $sql->f("minor_revision");
   $default->restrict_view = $sql->f("restrict_view");
   $default->dbdump_path = $sql->f("dbdump_path");
   $default->gzip_path = $sql->f("gzip_path");
   $default->tar_path = $sql->f("tar_path");
   $default->unzip_path = $sql->f("unzip_path");
   $default->pod2html_path = $sql->f("pod2html_path");
   $default->pdftotext_path = $sql->f("pdftotext_path");
   $default->rtftotext_path = $sql->f("rtftotext_path");
   $default->wordtotext_path = $sql->f("wordtotext_path");
   $default->file_perm = $sql->f("file_perm");
   $default->folder_perm = $sql->f("folder_perm");

   $default->anon_ro = $sql->f("anon_ro");
   $default->anon_user = $sql->f("anon_user");
   $default->file_admin_group = $sql->f("file_admin_group");


   $default->machine_time_zone = $sql->f("machine_time_zone");
   $default->use_wysiwyg_for_textarea = $sql->f("use_wysiwyg_for_textarea");
   $default->force_ssl = $sql->f("force_ssl");
   $default->make_file_indexing_user_selectable = $sql->f("make_file_indexing_user_selectable");
   $default->turn_file_index_off = $sql->f("turn_file_index_off");

   $default->show_folder_desc_as_popup = $sql->f("show_folder_desc_as_popup");
   $default->hide_backup = $sql->f("hide_backup");

   $default->collect_trash = $sql->f("collect_trash");
   if ($sql->f("trash_can_location") == "")
   {
      $default->trash_can_location = $default->owl_FileDir . "/TrashCan";
   }
   else
   {
      $default->trash_can_location = $sql->f("trash_can_location");
   }

   $default->allow_popup = $sql->f("allow_popup");
   $default->allow_custfieldspopup=$sql->f("allow_custpopup");
   $default->show_file_stats = $sql->f("status_bar_location");
   $default->display_file_info_panel_wide = $sql->f("info_panel_wide");
   $default->allow_track_favorites = $sql->f("track_favorites");

   $default->show_prefs = $sql->f("pref_bar");
   $default->show_search = $sql->f("search_bar");
   $default->show_bulk = $sql->f("bulk_buttons");
   $default->show_action = $sql->f("action_buttons");
   $default->show_folder_tools = $sql->f("folder_tools");

   //$default->hide_bulk = $sql->f("hide_bulk"); 
   // 
   // Logging options
   // 
   $default->logging = $sql->f("logging");
   $default->log_file = $sql->f("log_file");
   $default->log_login = $sql->f("log_login");
   $default->log_rec_per_page = $sql->f("log_rec_per_page");
   //
   // Sticky loggin (remember me Link)
   //
   $default->remember_me = $sql->f("remember_me");
   $default->cookie_timeout = $sql->f("cookie_timeout");

   // 
   // Self Register options
   // 
   $default->self_reg = $sql->f("self_reg");
   $default->self_reg_quota = $sql->f("self_reg_quota");
   $default->self_reg_notify = $sql->f("self_reg_notify");
   $default->self_reg_attachfile = $sql->f("self_reg_attachfile");
   $default->self_reg_disabled = $sql->f("self_reg_disabled");
   $default->self_reg_noprefacces = $sql->f("self_reg_noprefacces");
   $default->self_reg_maxsessions = $sql->f("self_reg_maxsessions");
   $default->self_reg_group = $sql->f("self_reg_group");
   $default->forgot_pass = $sql->f("forgot_pass");
   $default->records_per_page = $sql->f("rec_per_page");
   $default->self_reg_homedir = $sql->f("self_reg_homedir");
   $default->self_reg_firstdir = $sql->f("self_reg_firstdir");
   $default->self_create_homedir = $sql->f("self_create_homedir");
   $default->registration_using_captcha = $sql->f("self_captcha");

   $default->expand_disp_status = $sql->f("expand_disp_status");
   $default->expand_disp_doc_num = $sql->f("expand_disp_doc_num");
   $default->expand_disp_doc_type = $sql->f("expand_disp_doc_type");
   $default->expand_disp_doc_fields =$sql->f("expand_disp_doc_fields");
   $default->expand_disp_title = $sql->f("expand_disp_title");
   $default->expand_disp_version = $sql->f("expand_disp_version");
   $default->expand_disp_file = $sql->f("expand_disp_file");
   $default->expand_disp_size = $sql->f("expand_disp_size");
   $default->expand_disp_posted = $sql->f("expand_disp_posted");
   $default->expand_disp_updated = $sql->f("expand_disp_updated");
   $default->expand_disp_modified = $sql->f("expand_disp_modified");
   $default->expand_disp_action = $sql->f("expand_disp_action");
   $default->expand_disp_held = $sql->f("expand_disp_held");

   $default->collapse_disp_status = $sql->f("collapse_disp_status");
   $default->collapse_disp_doc_num = $sql->f("collapse_disp_doc_num");
   $default->collapse_disp_doc_type = $sql->f("collapse_disp_doc_type");
   $default->collapse_disp_doc_fields =$sql->f("collapse_disp_doc_fields");
   $default->collapse_disp_title = $sql->f("collapse_disp_title");
   $default->collapse_disp_version = $sql->f("collapse_disp_version");
   $default->collapse_disp_file = $sql->f("collapse_disp_file");
   $default->collapse_disp_size = $sql->f("collapse_disp_size");
   $default->collapse_disp_posted = $sql->f("collapse_disp_posted");
   $default->collapse_disp_updated = $sql->f("collapse_disp_updated");
   $default->collapse_disp_modified = $sql->f("collapse_disp_modified");
   $default->collapse_disp_action = $sql->f("collapse_disp_action");
   $default->collapse_disp_held = $sql->f("collapse_disp_held");
   $default->expand_search_disp_score =  $sql->f("expand_search_disp_score");
   $default->expand_search_disp_folder_path = $sql->f("expand_search_disp_folder_path");
   $default->expand_search_disp_doc_type = $sql->f("expand_search_disp_doc_type");
   $default->expand_search_disp_doc_fields = $sql->f("expand_search_disp_doc_fields");
   $default->expand_search_disp_file = $sql->f("expand_search_disp_file");
   $default->expand_search_disp_size = $sql->f("expand_search_disp_size");
   $default->expand_search_disp_posted = $sql->f("expand_search_disp_posted");
   $default->expand_search_disp_updated = $sql->f("expand_search_disp_updated");
   $default->expand_search_disp_modified = $sql->f("expand_search_disp_modified");
   $default->expand_search_disp_action = $sql->f("expand_search_disp_action");
   $default->expand_search_disp_doc_num = $sql->f("expand_search_disp_doc_num");


   $default->collapse_search_disp_score =  $sql->f("collapse_search_disp_score");
   $default->collapse_search_disp_folder_path = $sql->f("colps_search_disp_fld_path");
   $default->collapse_search_disp_doc_type = $sql->f("collapse_search_disp_doc_type");
   $default->colps_search_disp_doc_fields = $sql->f("colps_search_disp_doc_fields");
   $default->collapse_search_disp_file = $sql->f("collapse_search_disp_file");
   $default->collapse_search_disp_size = $sql->f("collapse_search_disp_size");
   $default->collapse_search_disp_posted = $sql->f("collapse_search_disp_posted");
   $default->collapse_search_disp_updated = $sql->f("collapse_search_disp_updated");
   $default->collapse_search_disp_modified = $sql->f("collapse_search_disp_modified");
   $default->collapse_search_disp_action = $sql->f("collapse_search_disp_action");
   $default->collapse_search_disp_doc_num = $sql->f("collapse_search_disp_doc_num");

   $default->hide_folder_doc_count      = $sql->f("hide_folder_doc_count");
   $default->old_action_icons   = $sql->f("old_action_icons");
   $default->search_result_folders      = $sql->f("search_result_folders");
   $default->restore_file_prefix        = $sql->f("restore_file_prefix");


   $default->doc_id_prefix = $sql->f("doc_id_prefix");
   $default->doc_id_num_digits = $sql->f("doc_id_num_digits");

   $default->view_doc_in_new_window = $sql->f("view_doc_in_new_window");

   $default->admin_login_to_browse_page = $sql->f("admin_login_to_browse_page");

   $default->save_keywords_to_db = $sql->f("save_keywords_to_db");
   $default->anon_access = $sql->f("anon_ro");

   $default->document_peer_review = $sql->f("peer_review");
   $default->document_peer_review_optional = $sql->f("peer_opt");
   $default->peer_review_leave_old_file_accessible = $sql->f("leave_old_file_accessible");
   $default->auto_checkout_checking = $sql->f("auto_checkout_checking");
   $default->hide_folder_size = $sql->f("folder_size");
   $default->use_zip_for_folder_download = $sql->f("download_folder_zip");
   $default->display_password_override = $sql->f("display_password_override");
   $default->virus_path = $sql->f("virus_path");

   $default->thumb_disp_status =  $sql->f("thumb_disp_status");
   $default->thumb_disp_doc_num =  $sql->f("thumb_disp_doc_num");
   $default->thumb_disp_image_info =  $sql->f("thumb_disp_image_info");
   $default->thumb_disp_version =  $sql->f("thumb_disp_version");
   $default->thumb_disp_size =  $sql->f("thumb_disp_size");
   $default->thumb_disp_posted =  $sql->f("thumb_disp_posted");
   $default->thumb_disp_updated =  $sql->f("thumb_disp_updated");
   $default->thumb_disp_modified =  $sql->f("thumb_disp_modified");
   $default->thumb_disp_action =  $sql->f("thumb_disp_action");
   $default->thumb_disp_held =  $sql->f("thumb_disp_held");
   $default->thumbnails_tool_path = $sql->f("thumbnails_tool_path");

   $default->pdf_pdftk_tool_greater_than_1_40 = $sql->f("pdf_pdftk_tool_greater_than_1_40");
   $default->pdf_watermark_path = $sql->f("pdf_watermark_path");
   $default->pdf_custom_watermark_filepath = $sql->f("pdf_custom_watermark_filepath");
   $default->pdf_watermarks = $sql->f("pdf_watermarks");

   $default->thumbnails_video_tool_path = $sql->f("thumbnails_video_tool_path");
   $default->thumbnails_video_tool_opt = $sql->f("thumbnails_video_tool_opt");

   $default->thumbnails_small_width = $sql->f("thumbnails_small_width");
   $default->thumbnails_med_width = $sql->f("thumbnails_med_width");
   $default->thumbnails_large_width = $sql->f("thumbnails_large_width");
   $default->thumbnail_view_columns= $sql->f("thumbnail_view_columns");
   $default->thumbnails= $sql->f("thumbnails");


   $default->min_pass_length = $sql->f("min_pass_length");
   $default->min_username_length = $sql->f("min_username_length");
   $default->min_pass_numeric = $sql->f("min_pass_numeric");
   $default->min_pass_special = $sql->f("min_pass_special");
   $default->enable_lock_account = $sql->f("enable_lock_account");
   $default->lock_account_bad_password = $sql->f("lock_account_bad_password");
   $default->track_user_passwords = $sql->f("track_user_passwords");
   $default->change_password_every = $sql->f("change_password_every");

   $default->file_desc_req = $sql->f("filedescreq");
   $default->folder_desc_req = $sql->f("folderdescreq");
   $default->show_user_info = $sql->f("show_user_info");
   $default->owl_motd = $sql->f("motd");

   $default->owl_maintenance_mode = $sql->f("owl_maintenance_mode");
   // 0 = Old Standard Owl Authentication
   // 1 = .htaccess authentication (username must also exists as the Owl users Table)
   // 2 = pop3 authentication (username must also exists as the Owl users Table)
   // 3 = LDAP authentication (username must also exists as the Owl users Table)

   $default->lookHD_ommit_ext[] = "owlctl";

   if (!$default->old_action_icons)
   {
      require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/PHPLIB.php");
      require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/layersmenu-common.inc.php");
      require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/layersmenu.inc.php");
   }
}






getprefs();


global $default;


$sql = new Owl_DB;
$qUpdate = new Owl_DB;

$sql->query("SELECT * FROM $default->owl_files_table");

while ($sql->next_record())
{
   $qUpdate->query("UPDATE $default->owl_files_table set 
name_search='" . $sql->make_arg_safe(fReplaceSpecial($sql->f('name'))) . "', 
filename_search='" . $sql->make_arg_safe(fReplaceSpecial($sql->f('filename'))) . "', 
metadata_search='" . $sql->make_arg_safe(fReplaceSpecial($sql->f('metadata'))) . "', 
description_search='" . $sql->make_arg_safe(fReplaceSpecial($sql->f('description'))) . "'  
where id='" . $sql->f('id'). "'");
}
?>
