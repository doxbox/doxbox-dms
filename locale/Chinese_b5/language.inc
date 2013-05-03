<?php
/*
 * File: Traditional Chinese zh_TW.utf8/language.inc
 * Author: Finjon Kiang [ http://twpug.net ]
 * Date: 2005/12/31
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
	$owl_lang->localized_date_format  = "M d, Y \a\\t h:i a";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset  = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code  = "zh-tw";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		 = "這個檔案您並沒有加入評論的權限";
$owl_lang->err_backup_file   		 = "備份目前的檔案發生錯誤";
$owl_lang->err_backup_folder_create 	 = "備份資料夾的開設動作發生錯誤";
$owl_lang->err_bad_url			 = "請輸入一個正確的網址";
$owl_lang->err_bad_version_1 		 = "Owl 至少需要的 PHP 版本";
$owl_lang->err_bad_version_2 		 = "您安裝的版本是";
$owl_lang->err_bad_version_3 		 = "請安裝一個新版本的PHP後再試試看";
$owl_lang->err_comment_empty		 = "評論不能為空白";
$owl_lang->err_email         		 = "無法傳送訊息";
$owl_lang->err_email_required		 = "Email 位址必須填寫";
$owl_lang->err_fexist1			 = "<b>檔案已存在：</b>";
$owl_lang->err_fexist2 			 = "已有同名檔案 <i>";
$owl_lang->err_fexist3 			 = "</i> 在這個目錄中。";
$owl_lang->err_file_exists		 = "您上傳的檔案已經存在";
$owl_lang->err_file_lock     		 = "您不能點閱這個檔案，它目前已經被鎖定，由";
$owl_lang->err_file_not_exist		 = "檔案不存在";
$owl_lang->err_file_too_big		 = "php.ini 設定檔中的 upload_max_filesize 參數值超過了! 或許<BR>超過了 Owl 規定的上傳檔案大小的上限";
$owl_lang->err_file_update		 = "上傳的檔案名稱與系統保留名稱相同，請改用其它的名稱";
$owl_lang->err_fileexists    		 = "搬移已被取消<BR>發現有同名檔案.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist            = "您欲改名的檔案名稱已存在";
$owl_lang->err_folder_create 		 = "開設新資料夾發生錯誤";
$owl_lang->err_folder_exist		 = "這個資料夾已經存在";
$owl_lang->err_folderexists  		 = "改名動作已被取消<BR>發現有資料夾名稱相同.";
$owl_lang->err_general 			 = "發生錯誤";
$owl_lang->err_please_select_bulk	 = "請至少勾選一個檔案或資料夾";
$owl_lang->err_select_reviewer		 = "請至少選擇一個人來檢視您的文件";
$owl_lang->err_update_file_lock     	 = "您無法更新這個檔案，目前被鎖定，由";
// BEGIN CHANGED STUFF
$owl_lang->err_group_delete		 = "這個群組有檔案以及/或資料夾使用中";
// END CHANGED STUFF
$owl_lang->err_cant_del_doc_type	 = "無法刪除使用這個文件類型的檔案";
$owl_lang->err_database			 = "資料庫錯誤";
$owl_lang->err_doc_field_req             = "缺少必要欄位：";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	 = "文件類型名稱是必填的 <br />";
$owl_lang->err_field_label_req 		 = "欄位標籤是必填的 <br />";
$owl_lang->err_field_name_req		 = "欄位名稱是必填的 <br />";
$owl_lang->err_field_size_req		 = "欄位大小是必填的 <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		 = "建立文字檔案暫時發生錯誤";
$owl_lang->err_forbidden_file		 = "禁止的檔案類型";
$owl_lang->err_group_exists		 = "已經有同名的群組.";
$owl_lang->err_gzip_not_found  		 = "gzip 沒有找到";
$owl_lang->err_login			 = "請登入";
$owl_lang->err_movecancel    		 = "搬移已經取消<BR>";
$owl_lang->err_nameempty    		 = "資料夾的名稱不能空白";
$owl_lang->err_news_required		 = "錯誤: 訊息標題和內容都必須填寫!";
$owl_lang->err_no_access 		 = "您沒有權限使用您選擇的檔案";
$owl_lang->err_no_access_info 		 = "可能的原因：<br />1) 您沒有勾選任何檔案或資料夾<br />2) 資料夾不允許大量刪除、轉寄或是簽出 <br />3) 您沒有存取選擇檔案、資料夾的權限。";
$owl_lang->err_noemail			 = "您沒有傳送這個檔案的權限";
$owl_lang->err_nofileaccess		 = "您沒有權限開啟這個檔案";
$owl_lang->err_nofiledelete		 = "您沒有權限刪除這個檔案";
$owl_lang->err_nofilemod		 = "您沒有權限修改這個檔案";
$owl_lang->err_nofolderaccess		 = "您沒有權限進入這個資料夾";
$owl_lang->err_nofolderdelete		 = "您沒有權限刪除這個資料夾";
$owl_lang->err_nofoldermod		 = "您沒有權限修改這個資料夾";
$owl_lang->err_nosubfolder		 = "您沒有權限在此開設子資料夾";
$owl_lang->err_not_zip			 = "不是一個正確的 ZIP 壓縮檔";
$owl_lang->err_note_title                = "這個標題需要一個字以上";
$owl_lang->err_note_title_exists         = "這個備註說明的名稱已經存在";
$owl_lang->err_noupload			 = "您沒有上傳檔案到這個資料夾的權限";
$owl_lang->err_pass_missmatch		 = "新密碼和驗証密碼不符合";
$owl_lang->err_pass_wrong    		 = "原密碼不正確";
$owl_lang->err_please_select_bulk        = "請至少勾選一個檔案或資料夾";
$owl_lang->err_pod2html_not_found        = "錯誤: 找不到 pod2html 這支工具程式:";
$owl_lang->err_quota			 = "您沒有足夠的磁碟配額空間上傳這個檔案:";
$owl_lang->err_quota_avail		 = "可用.";
$owl_lang->err_quota_exceed  		 = "您超過了磁碟配額空間";
$owl_lang->err_quota_needed		 = "需要";
$owl_lang->err_req			 = "錯誤: 需要填寫所有的內容";
$owl_lang->err_root_delete		 = "根目錄不能刪除";
$owl_lang->err_sess_notvalid 		 = "行程無效";
$owl_lang->err_sess_write		 = "寫入行程訊息到資料庫發生錯誤";
$owl_lang->err_specialfoldername 	 = "'backup' 是 Owl 保留的資料夾名稱，請選擇其他的名稱";
$owl_lang->err_sql			 = "SQL 錯誤";
$owl_lang->err_tar_not_found  		 = "tar 沒有找到";
$owl_lang->err_trash_can_empty 		 = "垃圾桶已清空";
$owl_lang->err_unauth_area   		 = "您沒有點閱這個區域的權限";
$owl_lang->err_unauthorized  		 = "未經授權";
$owl_lang->err_upload 			 = "上傳發生錯誤";
$owl_lang->err_user_exists		 = "已存在使用者";
// NEW STUFF
$owl_lang->err_captcha_auth		 = "圖片驗證錯誤";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field           = "新增欄位";
$owl_lang->btn_add_file           = "新增文件";
$owl_lang->btn_add_folder           = "新增資料夾";
$owl_lang->btn_add_news           = "新增消息";
$owl_lang->btn_add_note           = "新增記事";
$owl_lang->btn_add_url           = "新增網址";
$owl_lang->btn_add_zip            = "新增壓縮檔";
$owl_lang->btn_admin       = "管理";
$owl_lang->btn_admin_groups           = "新群組";
$owl_lang->btn_admin_news           = "新聞管理";
$owl_lang->btn_admin_user_group           = "使用者/群組管理";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users           = "新使用者";
$owl_lang->btn_back           = "回上頁";
$owl_lang->btn_browse      = "瀏覽";
$owl_lang->btn_bulk_checkout        = "大量簽出";
$owl_lang->btn_bulk_delete          = "大量刪除";
$owl_lang->btn_bulk_download           = "大量下載";
$owl_lang->btn_bulk_email           = "大量轉寄";
$owl_lang->btn_bulk_move           = "大量移動";
$owl_lang->btn_cancel           = "取消";
$owl_lang->btn_clickhere           = "點選這裡";
$owl_lang->btn_collapse_view           = "折疊檢視";
$owl_lang->btn_create           = "建立";
$owl_lang->btn_default_view           = "預設檢視";
$owl_lang->btn_deldoctype           = "刪除文件類型";
$owl_lang->btn_download_bulk_package	 = "下載多個檔案的集合";
$owl_lang->btn_edit_group           = "編輯群組";
$owl_lang->btn_edit_user           = "編輯使用者";
$owl_lang->btn_expand_view           = "展開檢視";
$owl_lang->btn_go_bottom       = "到最下方";
$owl_lang->btn_go_top       = "到最上方";
$owl_lang->btn_help      = "說明";
$owl_lang->btn_import_users   = "匯入使用者";
$owl_lang->btn_login           = "登入";
$owl_lang->btn_logout      = "登出";
$owl_lang->btn_mail_tool      = "E-Mail";
$owl_lang->btn_register           = "註冊";
$owl_lang->btn_reset           = "重設";
$owl_lang->btn_send_email           = "寄送 E-Mail";
$owl_lang->btn_submit           = "送出";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view           = "檢視縮圖";
$owl_lang->btn_trash_admin           = "垃圾桶";
$owl_lang->btn_export           = "匯出";
$owl_lang->btn_gen_pdf          = "Generate PDF";
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_updated          = "Document Was Updated Since Your Last Visit";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new              = "Document Was Created Since Your Last Visit";
$owl_lang->alt_gen_pdf                          = "Generate PDF Version of the above File";
$owl_lang->alt_add_comments      = "新增檔案的評論";
$owl_lang->alt_add_field	 = "新增上面欄位";
$owl_lang->alt_add_group	 = "新增群組";
$owl_lang->alt_add_news		 = "發佈新消息";
$owl_lang->alt_add_user		 = "新增使用者";
$owl_lang->alt_admin_flush       = "重設狀態/過期行程";
$owl_lang->alt_admin_groups	 = "新增管理群組";
$owl_lang->alt_admin_users	 = "新增管理者";
$owl_lang->alt_approve_file 	 = "核准這個文件";
$owl_lang->alt_back      	 = "回到上一個畫面";
$owl_lang->alt_btn_add_file      = "上傳新檔";
$owl_lang->alt_btn_add_folder	 = "新增資料夾";
$owl_lang->alt_btn_add_note      = "線上新增文件筆記";
$owl_lang->alt_btn_add_url	 = "新增文件連結位址";
$owl_lang->alt_btn_add_zip     	 = "上傳一個 Zip 壓縮檔案後解壓縮";
$owl_lang->alt_btn_admin 	 = "維護管理";
$owl_lang->alt_btn_browse	 = "回到檔案瀏覽區";
$owl_lang->alt_btn_bulk_checkout = "大量簽出檔案";
$owl_lang->alt_btn_bulk_delete 	 = "大量刪除檔案";
$owl_lang->alt_btn_bulk_download = "大量下載檔案";
$owl_lang->alt_btn_bulk_email  	 = "大量轉寄檔案";
$owl_lang->alt_btn_bulk_move   	 = "大量移動檔案與資料夾";
$owl_lang->alt_btn_clickhere	 = "點按這裡";
$owl_lang->alt_btn_collapse_view = "切換到簡略顯示";
$owl_lang->alt_btn_default_view  = "切換到預設顯示";
$owl_lang->alt_btn_expand_view   = "切換到詳細顯示";
$owl_lang->alt_btn_help		 = "Owl 線上說明";
$owl_lang->alt_btn_login	 = "登入到檔案系統中";
$owl_lang->alt_btn_logout	 = "登出DMS知識管理系統";
$owl_lang->alt_btn_mail_tool   	 = "簡單的郵件工具";
$owl_lang->alt_btn_thumb_view    = "切換到縮圖顯示";
$owl_lang->alt_cancel		 = "取消這個操作";
$owl_lang->alt_cancel_move	 = "取消搬移操作";
$owl_lang->alt_change		 = "更新已記錄";
$owl_lang->alt_comments 	 = "這個檔案已經有說明囉!";
$owl_lang->alt_copy_file     	 = "複製檔案";
$owl_lang->alt_copy_folder   	 = "複製資料夾";
$owl_lang->alt_del_all		 = "清空垃圾桶";
$owl_lang->alt_del_comments      = "刪除說明";
$owl_lang->alt_del_field	 = "刪除這個欄位";
$owl_lang->alt_del_file      	 = "刪除檔案 (Y/N)";
$owl_lang->alt_del_folder    	 = "刪除資料夾 (Y/N)";
$owl_lang->alt_del_group	 = "刪除群組";
$owl_lang->alt_del_news		 = "刪除公告";
$owl_lang->alt_del_selected	 = "刪除所有選擇檔案";
$owl_lang->alt_del_this_folder	 = "刪除資料夾 --";
$owl_lang->alt_del_user		 = "刪除使用者";
$owl_lang->alt_deldoctype	 = "刪除目前文件類型";
$owl_lang->alt_edit_field	 = "編輯這個欄位定義";
$owl_lang->alt_edit_group        = "修改群組";
$owl_lang->alt_edit_news	 = "編修公告";
$owl_lang->alt_edit_user         = "修改使用者";
$owl_lang->alt_email		 = "郵寄這個檔案";
$owl_lang->alt_email_reminder 	 = "透過郵件提醒";
$owl_lang->alt_email_selected	 = "郵寄所有選擇檔案";
$owl_lang->alt_get_file      	 = "下載檔案";
$owl_lang->alt_get_folder      	 = "下載資料夾內容";
$owl_lang->alt_go_bottom      	 = "到頁尾";
$owl_lang->alt_go_top 		 = "到頁首";
$owl_lang->alt_have_news	 = "您有新消息，可以按此查看";
$owl_lang->alt_have_no_news	 = "沒有新消息";
$owl_lang->alt_home_folder	 = "回到初始資料夾";
$owl_lang->alt_link_file     	 = "在其他資料夾連結這個檔案";
$owl_lang->alt_lock_file         = "簽出檔案";
$owl_lang->alt_log_clear         = "刪除所有的記錄 (Y/N)";
$owl_lang->alt_log_file          = "檔案記錄";
$owl_lang->alt_log_next		 = "顯示下個記錄";
$owl_lang->alt_log_prev		 = "顯示上個記錄";
$owl_lang->alt_log_top		 = "跳到第一個記錄";
$owl_lang->alt_mod_file      	= "Modify File Properties"; 
$owl_lang->alt_mod_folder    	 = "修改資料夾屬性";
$owl_lang->alt_monitor		 = "訂閱這個檔案";
$owl_lang->alt_monitor_folder    = "訂閱這個資料夾";
$owl_lang->alt_monitored	 = "停止訂閱這個檔案";
$owl_lang->alt_monitored_folder  = "停止訂閱這個資料夾";
$owl_lang->alt_move_file     	 = "移動檔案";
$owl_lang->alt_move_folder   	 = "移動資料夾";
$owl_lang->alt_move_selected	 = "搬移所有選擇的檔案";
$owl_lang->alt_my_approval	 = "個文件等候您審核";
$owl_lang->alt_new_doctype	 = "建立新文件類型";
$owl_lang->alt_news_close	 = "關閉公告";
$owl_lang->alt_news_next	 = "顯示下個公告";
$owl_lang->alt_news_prev	 = "顯示上個公告";
$owl_lang->alt_news_print	 = "列印這則公告";
$owl_lang->alt_pending_approval	 = "個文件等候審核";
$owl_lang->alt_play_file 	 = "播放多媒體檔案";
$owl_lang->alt_publish_file 	 = "公開文件";
$owl_lang->alt_recycle		 = "您的垃圾桶已經清空了";
$owl_lang->alt_recycle_disable	 = "垃圾桶功能未開啟";
$owl_lang->alt_recycle_not_found = "沒有找到垃圾桶位置";
$owl_lang->alt_refresh_filter	 = "初始化/更新結果";
$owl_lang->alt_register		 = "送出您的註冊資料";
$owl_lang->alt_reject_file 	 = "拒絕這個文件";
$owl_lang->alt_related		 = "找尋相關文件";
$owl_lang->alt_reset_form	 = "重設表單資料";
$owl_lang->alt_rest_selected	 = "還原所有選擇的檔案";
$owl_lang->alt_search		 = "搜尋";
$owl_lang->alt_send_email	 = "傳送 Email";
$owl_lang->alt_sendfile		 = "傳送檔案";
$owl_lang->alt_set_initial_dir	 = "將目前資料夾設定為初始資料夾";
$owl_lang->alt_site_map          = "網站地圖";
$owl_lang->alt_submit      	 = "表單";
$owl_lang->alt_toggle_check_box	 = "切換全選";
$owl_lang->alt_tool_status_green = "工具啟用中";
$owl_lang->alt_tool_status_red	 = "路徑不正確且/或無法執行";
$owl_lang->alt_unlock_file       = "遷入檔案";
$owl_lang->alt_upd_field	 = "更新這個欄位";
$owl_lang->alt_upd_file      	 = "更新檔案";
$owl_lang->alt_view_comments     = "新增/查看檔案評論";
$owl_lang->alt_view_file     	 = "查看檔案";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin  = "垃圾桶管理";
$owl_lang->alt_edit_file_inline  = "編輯文字檔案";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		 = "內容已刪除";
$owl_lang->log_detail		 = "沒有詳細的訊息";
$owl_lang->log_file_to		 = "到:";
$owl_lang->log_filter_all	 = "全部";
$owl_lang->log_login_det	 = "帳號：";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group  = "修改的群組：";
$owl_lang->log_admin_changed_user  = "修改的使用者：";
$owl_lang->log_admin_created_group  = "建立的群組：";
$owl_lang->log_admin_created_user  = "建立的使用者：";
$owl_lang->log_admin_del_group  = "刪除的群組：";
$owl_lang->log_admin_del_user  = "刪除的使用者：";
$owl_lang->log_admin_disabled  = "停用的使用者：";
$owl_lang->log_admin_email_restore  = "寄送的檔案：";
$owl_lang->log_admin_trash_delfile = "刪除的檔案：";
$owl_lang->log_admin_trash_delfold  = "刪除的資料夾：";
$owl_lang->log_admin_trash_empty  = "垃圾桶清空了";
$owl_lang->log_admin_trash_restore  = "還原的：";
$owl_lang->log_login_expired     = "過期的使用者：";
$owl_lang->log_login_too_many_attempts  = "停用的（登入失敗次數太多）：";
$owl_lang->log_readhd_feature_add   = "讀取硬碟功能新增到這個檔案";
// END NEW STUFF
$log_file_actions[1]        	 = "登入";
$log_file_actions[10]        	 = "檔案解鎖";
$log_file_actions[11]        	 = "檔案郵寄";
$log_file_actions[12]        	 = "資料夾搬移";
$log_file_actions[13]        	 = "資料夾開設";
$log_file_actions[14]        	 = "資料夾刪除";
$log_file_actions[15]        	 = "資料夾修改";
$log_file_actions[16]        	 = "資料夾搬移";
$log_file_actions[17]        	 = "忘記密碼";
$log_file_actions[18]        	 = "使用者註冊";
$log_file_actions[19]            = "檔案瀏覽次數";
$log_file_actions[2]        	 = "登入失敗";
$log_file_actions[20]            = "檔案病毒";
$log_file_actions[21]            = "檔案複製次數";
$log_file_actions[22]            = "資料夾複製次數";
$log_file_actions[23]            = "檔案連結次數";
$log_file_actions[3]        	 = "登出";
$log_file_actions[4]        	 = "檔案刪除";
$log_file_actions[5]        	 = "檔案上傳";
$log_file_actions[6]        	 = "檔案更新";
$log_file_actions[7]        	 = "檔案下載";
$log_file_actions[8]        	 = "檔案修改";
$log_file_actions[9]        	 = "檔案鎖定";
// BEGIN NEW STUFF
$log_file_actions[24]            = "使用者管理";
$log_file_actions[25]            = "垃圾桶";
$log_file_actions[26]            = "檔案權限";
$log_file_actions[27]            = "資料夾權限";
$log_file_actions[28]           = "FOLDER DISTRIBUTE";
$log_file_actions[29]           = "FOLDER LINKED";
$log_file_actions[30]           = "FILE REVIEW";
$log_file_actions[31]           = "FILE APPROVED";
$log_file_actions[32]           = "FILE REJECTED";
$log_file_actions[33]           = "FILE PUBLISHED";
// END NEW STUFF


//********************************************************
// Owl Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

// BEGIN NEW STUFF
$owl_lang->admin_login_date   = "管理者登入於：";
$owl_lang->admin_login_from   = "管理者登入自";
$owl_lang->admin_login_subject   = "管理者登入";
// BEGIN NEW STUFF
$owl_lang->anonymous 		 = "(按此可匿名登入)";
$owl_lang->engine 		 = "DMS";
$owl_lang->forgot_pass		 = "忘記密碼?";
$owl_lang->like_register	 = "要註冊嗎?";
$owl_lang->login		 = "登入";
$owl_lang->logindisabled	 = "該帳號已被列入黑名單，請聯絡管理員!";
$owl_lang->loginfail		 = "登入失敗";
$owl_lang->password		 = "密碼";
$owl_lang->repository_list       = "檔案庫";
$owl_lang->successlogout 	 = "您已經成功登出";
$owl_lang->toomanysessions	 = "已經超過最大連接數量，請聯絡管理員";
$owl_lang->username		 = "帳號";
$owl_lang->forgot_username		 = "帳號";
$owl_lang->version 		 = "版本";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			 = "操作";
$owl_lang->current_db         		 = "目前檔案庫：";
$owl_lang->current_folder 		 = "目前資料夾：";
$owl_lang->del_all			 = "清空垃圾桶";
$owl_lang->del_selected			 = "已刪除";
$owl_lang->disk_quota			 = "磁碟空間配額：";
$owl_lang->doc_number 			 = "文件編號";
$owl_lang->email_selected		 = "Email 選取";
$owl_lang->file 			 = "檔案";
$owl_lang->folder_count_file		 = "檔案";
$owl_lang->folder_count_folder		 = "資料夾";
$owl_lang->folder_count_note		 = "記事";
$owl_lang->folder_count_pre		 = "這個資料夾包含";
$owl_lang->folder_count_url		 = "網址";
$owl_lang->folder_policy 		 = "目前目錄權限設定：";
$owl_lang->held                      	 = "Held"; 
$owl_lang->last_logged			 = "上次登入時間：";
$owl_lang->menu_file_action		 = "可以使用的檔案操作";
$owl_lang->menu_folder_action		 = "可以使用的資料夾操作";
$owl_lang->menu_url_action		 = "可以使用的網址操作";
$owl_lang->modified 			 = "修改時間";
$owl_lang->move_selected		 = "搬移選擇";
$owl_lang->new_file			 = "新檔!";
$owl_lang->no_description		 = "沒有檔案說明";
$owl_lang->owner                         = "User";
$owl_lang->page				 = "頁：";
$owl_lang->panel_file_info		 = "檔案資訊";
$owl_lang->postedby 			 = "上傳者";
$owl_lang->reallydelete			 = "確定刪除";
$owl_lang->reallydelete_logs		 = "真的要清除記錄檔";
$owl_lang->reallydelete_selected	 = "確定刪除所有檔案";
$owl_lang->reallyrestore_selected	 = "確定還原所有選擇的檔案";
$owl_lang->rest_selected		 = "還原選擇的項目";
$owl_lang->score 			 = "評分";
$owl_lang->size 			 = "大小";
$owl_lang->title 			 = "名稱";
$owl_lang->tot_files			 = "總共：";
$owl_lang->tot_monitored		 = "訂閱：";
$owl_lang->tot_my_checked_out		 = "簽出：";
$owl_lang->tot_my_files			 = "我的：";
$owl_lang->tot_my_group			 = "群組：";
$owl_lang->tot_new_files		 = "新檔：";
$owl_lang->tot_updated_files		 = "更新：";
$owl_lang->updated_file			 = "更新！";
$owl_lang->user               		 = "使用者";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days :";
// NEW STUFF
$owl_lang->favorite  = "我的最愛";
$owl_lang->favorite_add  = "新增目前的";
$owl_lang->favorite_delete  = "刪除";
$owl_lang->favorite_go  = "衝";
$owl_lang->files_in_my_group_title  = "我的群組檔案";
$owl_lang->my_files_title = "我的檔案";
$owl_lang->my_monitored_title = "我訂閱的檔案/資料夾";
$owl_lang->my_special_access_title = "特別權限清單";
$owl_lang->special_access_count_alt = "特別權限的檔案/資料夾";
$owl_lang->special_access_count = "特別權限：";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments       = "增加/查看 評論：";
$owl_lang->addingfile 		 = "增加一個檔案到";
$owl_lang->addingfolder 	 = "增加一個資料夾到";
$owl_lang->attach_file		 = "增加附件";
$owl_lang->change		 = "修改";
$owl_lang->comments      	 = "評論";
$owl_lang->comments_added        = "評論作者：";
$owl_lang->create		 = "建立";
$owl_lang->description 		 = "簡介";
$owl_lang->disp_mp3		 = "MP3音樂：<br />專輯：<br />取樣頻率：<br />時間：<br />類型：<br />評論：";
$owl_lang->email_body		 = "內容";
$owl_lang->email_cc          	 = "副本";
$owl_lang->email_reply_to	 = "回覆";
$owl_lang->email_subject	 = "主旨";
$owl_lang->email_to		 = "寄給";
$owl_lang->emailing		 = "郵寄中";
$owl_lang->keywords 		 = "關鍵字";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		 = "網址";
$owl_lang->modifying		 = "修改中";
$owl_lang->name               	= "Name"; 
$owl_lang->none_selected         = "沒有選擇項目";
$owl_lang->note_content          = "內容說明";
$owl_lang->notify_link           = "Owl 外部連結";
$owl_lang->ownergroup         	 = "擁有群組";
$owl_lang->ownership		 = "擁有者";
$owl_lang->permissions 		 = "權限";
$owl_lang->pick_select		 = "--- 選擇一個 Owl 使用者 ---";
$owl_lang->policy 		 = "權限設定";
$owl_lang->post_comment		 = "發表評論";
$owl_lang->prop_permissions 	 = "傳送權限至子資料夾?";
$owl_lang->prop_perms_files 	 = "權限套用到檔案";
$owl_lang->sendfile 		 = "傳送檔案";
$owl_lang->sendthisfile 	 = "選擇上傳檔案";
$owl_lang->sendthisurl       	 = "文件位址";
$owl_lang->updating		 = "更新";
$owl_lang->verdescription 	 = "修改<br>內容說明";
$owl_lang->vermajor          	 = "主版本";
$owl_lang->verminor          	 = "次版本";
$owl_lang->vertype           	 = "版次型態";
$owl_lang->document_text         = "Content";  
$owl_lang->save_keyword          = "Save Keyword?";
$owl_lang->archive_skip_file     = "SKIPPED: ";
$owl_lang->archive_skip_message  = "The Following Files Have been Skipped they already exist";
$owl_lang->archive_extract_current  = "Extract to Current Folder?";
$owl_lang->archive_extract_overwrite  = "Overwrite Existing Files (Update)?";
$owl_lang->optional_file_index   = "Index file?:";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	 = "Email 位址";
$owl_lang->full_name		 = "暱稱";
$owl_lang->register		 = "使用者註冊";
$owl_lang->self_failed		 = "失敗";
$owl_lang->self_passwd		 = "密碼傳送到：";
$owl_lang->self_reg_bod		 = "您的密碼：";
$owl_lang->self_reg_rset	 = "您的帳號密碼更新為：";
$owl_lang->self_reg_subj	 = "您的帳號";
$owl_lang->send_pass		 = "傳送密碼";
$owl_lang->submit		 = "確定送出";
$owl_lang->thank_you_1		 = "謝謝!";
$owl_lang->thank_you_2          = "Your password will be sent to your e-mail address";
$owl_lang->thank_you_3          = "Your account needs to be enabled by the administrator before you can log in.";


//NEW STUFF

$owl_lang->captcha_typein         = "輸入五個字元";
$owl_lang->change_pass_title	       = "修改密碼";
$owl_lang->err_cant_reuse_passwords    = "您不能夠輸入之前使用的密碼";
$owl_lang->err_new_confirm_different   = "您的新密碼與重複輸入的密碼不符 <br />";
$owl_lang->err_old_pass_ver_failed     = "您的舊密碼有誤 <br />";
$owl_lang->err_pass_restriction_1      = "您的密碼至少必須有 '$default->min_pass_length' 個字元 <br />";
$owl_lang->err_pass_restriction_2      = "包含至少 '$default->min_pass_numeric' 個數字 [0-9] <br />";
$owl_lang->err_pass_restriction_3      = "且至少要包含 '$default->min_pass_special' 個特殊字元 [ ~!@#$%^&*()-=+_|{}][\";:<>.,?/\\ ]";
$owl_lang->err_username_not_long_enough_1  = "您的帳號";
$owl_lang->err_username_not_long_enough_2  = "至少必須";
$owl_lang->err_username_not_long_enough_2  = "至少必須";
$owl_lang->pass_change_email_1         = "您的密碼沒有重設，因為您沒有使用 Owl 認證";
$owl_lang->pass_change_email_2         = "您的認證類型：";
$owl_lang->pass_change_email_3         = "聯絡管理員來取得協助";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	 = "取消";
$owl_lang->copy_file		 = "複製檔案中";
$owl_lang->copy_folder		 = "複製資料夾中";
$owl_lang->moving		 = "搬移中";
$owl_lang->moving_file		 = "搬移檔案中";
$owl_lang->moving_folder	 = "搬移資料夾中";
$owl_lang->select		 = "請選擇新資料夾：";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	 = "檢視紀錄於";
// BEGIN NEW STUFF
$owl_lang->diff_from	 = "差異比對來源";
$owl_lang->diff_to	 = "差異比對標的";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif = "評論通知";
$owl_lang->confpassword	 = "再打一次";
$owl_lang->email_tool	 = "郵件工具";
$owl_lang->group	 = "群組";
$owl_lang->groupmember	 = "隸屬群組";
$owl_lang->last_modified = "最後更新";
$owl_lang->newpassword	 = "新密碼";
$owl_lang->newsadmin	 = "公告管理權";
$owl_lang->not_member	 = "您不屬於任何群組";
$owl_lang->notification	 = "顯示警告訊息";
$owl_lang->oldpassword	 = "舊密碼";
$owl_lang->preference	 = "偏好設定";
$owl_lang->saved	 = "已經存檔";
$owl_lang->status_no	 = "無";
$owl_lang->status_yes	 = "有";
$owl_lang->userlang	 = "語言";

//NEW STUFF
$owl_lang->useradmin	 = "使用者管理員";
$owl_lang->viewlogs      = "可以檢視系統紀錄";
$owl_lang->viewreports   = "可以檢視系統報表";
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

$owl_lang->elapsed_time       	 = "經過時間";
$owl_lang->query_empty       	 = "搜尋內容是空白的";
$owl_lang->related_query_empty   = "這個文件不包含相關的 metadata 來執行搜尋相關文件功能";
$owl_lang->search             	 = "搜尋";
$owl_lang->search_all_word	 = "所有文字";
$owl_lang->search_any_word	 = "任意文字";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder  = "搜尋目前資料夾";
$owl_lang->search_entire_phrase	 = "整句";
$owl_lang->search_for_files 	 = "檔案搜尋";
$owl_lang->search_for_folders 	 = "資料夾搜尋";
$owl_lang->search_match 	 = "符合：";
$owl_lang->search_results_for	 = "搜尋內容";
$owl_lang->search_score 	 = "搜尋範圍";
$owl_lang->search_winthindocs    = "在 (text 和 pdf 檔) 文件中搜尋";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	 = "觀看";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->edit_user                    = "***** Editing User *****";
$owl_lang->edit_group                   = "***** Editing Group *****";
$owl_lang->enter_new_user               = "***** Adding New User *****";
$owl_lang->enter_new_group              = "***** Adding New Group *****";
$owl_lang->admin_login_to_browse_page	 = "管理者登入後的首頁";
$owl_lang->alt_btn_backup		 = "備份資料庫";
$owl_lang->alt_btn_doctype_admin	 = "文件類型管理";
$owl_lang->alt_btn_html_prefs		 = "編輯網站 HTML 偏好";
$owl_lang->alt_btn_log_viewer		 = "檢視系統紀錄";
$owl_lang->alt_btn_news_admin		 = "新聞管理";
$owl_lang->alt_btn_site_features	 = "編輯網站功能與設定";
$owl_lang->alt_btn_statistics_viewer	 = "檢視統計";
$owl_lang->alt_btn_users_groups		 = "管理使用者與群組";
$owl_lang->btn_backup			 = "備份<br />資料庫";
$owl_lang->btn_doctype_admin		 = "文件<br />類型";
$owl_lang->btn_html_prefs		 = "HTML<br />偏好";
$owl_lang->btn_log_viewer		 = "系統紀錄";
$owl_lang->btn_news_admin		 = "新聞<br />管理";
$owl_lang->btn_site_features		 = "網站<br />功能";
$owl_lang->btn_statistics_viewer	 = "統計<br />報表";
$owl_lang->btn_users_groups		 = "使用者<br />群組";
$owl_lang->display_password_override	 = "顯示檔案/資料夾密碼";
$owl_lang->doc_id_num_digits		 = "要顯示的文件編號數字字數";
$owl_lang->doc_id_prefix		= "Doc# Display Prefix String"; 
$owl_lang->docicon_column		 = "文件圖示";
$owl_lang->download_folder_zip		 = "壓縮資料夾後下載（預設為 tar.gz 格式）";
$owl_lang->save_keywords_to_db		 = "允許使用者儲存關鍵字來重複使用";
$owl_lang->status_column		 = "狀態";
$owl_lang->vermajor_initial          	 = "第一個主要版本";
$owl_lang->verminor_initial          	 = "第一個次要版本";
$owl_lang->view_doc_in_new_window	 = "檢視文件時開啟新視窗";
// BEGIN NEW STUFF
$owl_lang->alt_btn_change_passwd         = "修改您的舊密碼";
$owl_lang->alt_btn_cln_history           = "刪除文件，當他們存在超過幾天：";
$owl_lang->alt_btn_log_viewer            = "檢視系統紀錄";
$owl_lang->alt_btn_report_viewer         = "檢視報表";
$owl_lang->btn_change_passwd             = "修改密碼";
$owl_lang->btn_cln_history               = "清除紀錄";
$owl_lang->btn_log_viewer                = "系統紀錄";
$owl_lang->btn_report_viewer             = "報表";
$owl_lang->confirm_cln_history           = "您確定要刪除存在超過指定天數的文件：";
$owl_lang->historical_purge              = "紀錄檔案刪除了";

// END NEW STUFF
$owl_lang->add				 = "新增";
$owl_lang->alt_btn_initial_load		 = "從文件資料夾讀取資料庫";
$owl_lang->alt_btn_trashcan		 = "點選這裡來檢視內容";
$owl_lang->anonymous_account		 = "匿名帳號：";
$owl_lang->btn_initial_load		 = "最初讀取";
$owl_lang->btn_trashcan			 = "垃圾桶";
$owl_lang->buttonstyle                   = "按鈕風格";
$owl_lang->confirm_initial_load		 = "*** 警告 ***  這個動作應該只有在This should only be run once when the database is empty";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			 = "刪除群組";
$owl_lang->deleteuser			 = "刪除使用者";
$owl_lang->disable_recs_per_page	 = "啟用限制觀看選項，將會取消每一頁面的記錄!";
$owl_lang->disableuser			 = "列入黑名單中";
$owl_lang->file_admin_group		 = "檔案/瀏覽 管理群組:";
$owl_lang->flushed           		 = "行程表更新了, 使用者現在可以重新登入了.<BR>";
$owl_lang->groups			 = "群組";
$owl_lang->hide_bulk_buttons		 = "隱藏批次處理按鈕：";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		 = "畫面背景圖片位置：";
$owl_lang->ht_bd_lnk_cl			 = "畫面連結顏色：";
$owl_lang->ht_bd_txt_cl 		 = "畫面字顏顏色：";
$owl_lang->ht_bd_vlnk_cl 		 = "畫面已點按連結顏色：";
$owl_lang->ht_collapse_width 		 = "縮小顯示寬度：";
$owl_lang->ht_expand_width		 = "擴大顯示寬度：";
$owl_lang->ht_tbl_border_sz 		 = "表格框線寬度：";
$owl_lang->ht_tbl_cell_bg_al 		 = "表格交替背景顏色：";
$owl_lang->ht_tbl_cell_bg_cl 		 = "表格背景顏色：";
$owl_lang->ht_tbl_hd_bg			 = "表格標題背景：";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		 = "設定匿名權限";
$owl_lang->header_group_admin            = "群組管理";
$owl_lang->header_sitefeatures_settings            = "網站功能與設定";
$owl_lang->header_user_admin           	 = "使用者管理";
$owl_lang->hide_folder_doc_count	 = "隱藏資料夾檔案類型數量";
$owl_lang->hide_folder_size		 = "隱藏資料夾內容大小";
$owl_lang->hide_panel			 = "隱藏";
$owl_lang->home_dir			 = "使用者的資料夾";
$owl_lang->initial_dir   		 = "使用者的初始資料夾";
$owl_lang->maxsessions			 = "最大連接數量";
$owl_lang->noprefaccess			 = "禁止修改設定";
$owl_lang->old_action_icons		 = "使用 Owl 0.80 之前版本的操作圖示";
$owl_lang->owl_anon_download     	 = "只能下載";
$owl_lang->owl_anon_full		 = "完整權限";
$owl_lang->owl_anon_ro			 = "設定匿名使用者只能讀取：";
$owl_lang->owl_dbdump_path   		 = "資料庫傾印工具位置：";
$owl_lang->owl_def_file_group_owner	 = "預設的檔案群組：";
$owl_lang->owl_def_file_meta		 = "預設檔案後設資料(File Meta Data)：";
$owl_lang->owl_def_file_owner		 = "預設的使用者：";
$owl_lang->owl_def_file_perm 		 = "預設檔案開設權限：";
$owl_lang->owl_def_file_security	 = "預設檔案安全性：";
$owl_lang->owl_def_file_title		 = "預設檔案標題 (沒有檔案名稱時)：";
$owl_lang->owl_def_fold_group_owner	 = "預設資料夾群組擁有者：";
$owl_lang->owl_def_fold_owner		 = "預設資料夾擁有者：";
$owl_lang->owl_def_fold_sec		 = "預設資料夾安全性：";
$owl_lang->owl_def_folder_perm 		 = "預設資料夾開設權限：";
$owl_lang->owl_default_tmpdir		 = "暫存檔目錄位置：";
$owl_lang->owl_email_from		 = "寄信人位址：";
$owl_lang->owl_email_fromname		 = "寄信人名稱：";
$owl_lang->owl_email_replyto		 = "回覆位址：";
$owl_lang->owl_email_server		 = "SMTP主機名稱：";
$owl_lang->owl_email_smtp		 = "使用SMTP郵寄方法";
$owl_lang->owl_email_smtp_auth		 = "使用SMTP認證";
$owl_lang->owl_email_smtp_auth_login	 = "SMTP認證帳號：";
$owl_lang->owl_email_smtp_auth_passwd	 = "SMTP認證密碼";
$owl_lang->owl_email_subject_pref	 = "主旨前置詞：";
$owl_lang->owl_fogotpass		 = "顯示忘記密碼連結位址：";
$owl_lang->owl_group_user		 = "屬於這個群組的成員";
$owl_lang->owl_gzip_path     		 = "gzip 路徑：";
$owl_lang->owl_hidebackup		 = "隱藏備份路徑：";
$owl_lang->owl_log_file			 = "記錄檔案操作：";
$owl_lang->owl_log_login_act		 = "記錄 登入/登出 動作：";
$owl_lang->owl_log_rec_page		 = "每頁記錄觀看筆數：";
$owl_lang->owl_logging			 = "啟用記錄檔功能：";
$owl_lang->owl_logo			 = "登入畫面 logo 圖示 ([語言別]/圖型)：";
$owl_lang->owl_lookAtHD			 = "關閉查看硬碟：";
$owl_lang->owl_lookAtHDDel		 = "從資料庫清除檔案";
$owl_lang->owl_max_filesize		 = "最大上傳檔案大小：";
$owl_lang->owl_owl_expand		 = "預設瀏覽方式(詳細)：";
$owl_lang->owl_owl_timeout		 = "連接過期時間(秒)：";
$owl_lang->owl_pdftotext_path		 = "維護PDF與文字檔案的搜尋索引 <br />&#8211; 空白表示停用：";
$owl_lang->owl_pod2html_path             = "需 Perl 5.8.0 及以上的版本<BR>pod2html的路徑位置:";
$owl_lang->owl_restrict_view		 = "限制顯示：";
$owl_lang->owl_self_reg			 = "開放使用者註冊:";
$owl_lang->owl_self_reg_hd		 = "預設使用者自動註冊";
$owl_lang->owl_tar_path     		 = "tar 路徑位置:";
$owl_lang->owl_title_browser		 = "DMS 瀏覽功能";
$owl_lang->owl_title_custom		 = "自訂瀏覽欄位";
$owl_lang->owl_title_custom_search       = "自訂搜尋結果";
$owl_lang->owl_title_defaults   	 = "預設";
$owl_lang->owl_title_email		 = "郵件設定";
$owl_lang->owl_title_HD			 = "查看硬碟新檔案設定";
$owl_lang->owl_title_logging  		 = "登入設定";
$owl_lang->owl_title_other		 = "其他設定";
$owl_lang->owl_title_tools   		 = "DB 備份/GZIP 工具";
$owl_lang->owl_unzip_path     		 = "unzip 路徑位置:";
$owl_lang->owl_version_control		 = "啟用版本控制功能:";
$owl_lang->owl_wordtotext_path           = "MS-WORD 檔案 <br />&#8211; 空白表示停用：";
$owl_lang->owl_ppttotext_path           = "MS-POWERPOINT  <br />&#8211; 空白表示停用：";
$owl_lang->quota			 = "空間限制（0=停用）";
$owl_lang->reallydeluser		 = "這個使用者擁有 %numfiles% 個檔案與 %numfolders% 個資料夾，這些檔案與資料夾將會跟著刪除，確定要刪除他？";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		 = "每頁顯示資料量（0 = 停用）：";
$owl_lang->recycle_enabled		 = "啟用垃圾桶回收功能：";
$owl_lang->recycle_location		 = "垃圾桶位址：";
$owl_lang->recycle_title		 = "垃圾桶回收設定";
$owl_lang->remember_me			 = "顯示自動登入連結";
$owl_lang->remember_me_checkbox		 = "自動登入";
$owl_lang->remember_me_title		 = "登入時間設定";
$owl_lang->remember_timeout		 = "Cookie 逾時天數";
$owl_lang->restore_file_prefix		 = "要還原檔案的前置字元";
$owl_lang->search_result_folders	 = "包含搜尋結果的資料夾";
$owl_lang->show_action_title		 = "顯示動作圖示：";
$owl_lang->show_bulk_title		 = "顯示批次圖示：";
$owl_lang->show_folder_title		 = "顯示資料夾工具：";
$owl_lang->show_panel			 = "顯示";
$owl_lang->show_panel_title		 = "顯示狀態列：";
$owl_lang->show_pref_title		 = "顯示偏好/登出列：";
$owl_lang->show_search_title		 = "顯示搜尋列：";
$owl_lang->status_bar_both               = "二者";
$owl_lang->status_bar_bottom             = "底部";
$owl_lang->status_bar_location           = "顯示狀態列於：";
$owl_lang->status_bar_not                = "不要顯示";
$owl_lang->status_bar_top                = "頂部";
$owl_lang->cust_popup                                   = "Custom Fields inside Popup Description";
$owl_lang->cust_headpopup     = "SPECIFIC DOCUMENT FIELDS";
$owl_lang->use_popup			 = "使用跳出畫面顯示公告:";
$owl_lang->users           		 = "使用者";
$owl_lang->virus_path			 = "防毒軟體路徑<br />例如：'/usr/bin/clamscan --quiet' <br />&#8211; 空白表示停用：";

// NEW STUF BEGIN
$owl_lang->auth_http                         = "HTTP 驗證 (.htaccess)";
$owl_lang->auth_ldap                         = "LDAP 驗證";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group        = "以這個群組為主要群組的使用者";
$owl_lang->create_user_homedir = "Create User HomeDir:";
$owl_lang->use_captcha = "Use CAPTCHA:";
$owl_lang->created_here = "<br /> (CREATED HERE IF create homedir checked)";
$owl_lang->auth_owl                          = "Owl 認證";
$owl_lang->auth_pop3                         = "pop3 認證";
$owl_lang->file_desc_required            = "檔案說明必填";
$owl_lang->folder_desc_required          = "資料夾說明必填";
$owl_lang->html_title		 = "HTML 偏好";
$owl_lang->pass_account_lockout      	     = "登入鎖定錯誤次數：";
$owl_lang->pass_change_every                 = "強制修改密碼天數：";
$owl_lang->pass_enable_account_lockout       = "啟用帳號鎖定：";
$owl_lang->pass_min_passwd_length            = "使用者密碼字數下限：";
$owl_lang->pass_min_passwd_numeric           = "使用數字下限：";
$owl_lang->pass_min_passwd_special           = "使用特殊字元下限：";
$owl_lang->pass_min_username_length          = "使用者帳號字數下限：";
$owl_lang->pass_track_old_passwords   	     = "追蹤舊密碼的數量：";
$owl_lang->rtftotext_path                 = "RTF轉換為文字檔案的工具路徑";
$owl_lang->show_user_info            = "顯示的帳號可以點選";
$owl_lang->user_admin               = "使用者/群組管理";
$owl_lang->user_auth_type                    = "認證類型：";
$owl_lang->user_change_pass_next_login       = "在下次登入時修改密碼：";
$owl_lang->user_expires                      = "到期日：";
$owl_lang->user_gmt_offset               = "使用者 GMT 差異";
$owl_lang->user_group_admin                  = "主要群組的檔案管理：";
$owl_lang->user_login_to_newrecords          = "登入到新資料頁面：";
$owl_lang->users_group_admin		 = "管理群組的使用者";
$owl_lang->time_offsets[0][0] = "-12";
$owl_lang->time_offsets[0][1] = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0] = "-11";
$owl_lang->time_offsets[1][1] = "(GMT-11:00) Midway Island, Samoa";
$owl_lang->time_offsets[2][0] = "-10";
$owl_lang->time_offsets[2][1] = "(GMT-10:00) Hawaii";
$owl_lang->time_offsets[3][0] = "-9";
$owl_lang->time_offsets[3][1] = "(GMT-9:00) Alaska";
$owl_lang->time_offsets[4][0] = "-8";
$owl_lang->time_offsets[4][1] = "(GMT-8:00) Pacific Time (US & Canada)";
$owl_lang->time_offsets[5][0] = "-7";
$owl_lang->time_offsets[5][1] = "(GMT-7:00) Mountain Time (US & Canada)";
$owl_lang->time_offsets[6][0] = "-6";
$owl_lang->time_offsets[6][1] = "(GMT-6:00) Central Time (US & Canada), Mexico City";
$owl_lang->time_offsets[7][0] = "-5";
$owl_lang->time_offsets[7][1] = "(GMT-5:00) Eastern Time (US & Canada), Bogota, Lima, Quito";
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
// NEW STUF END

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	 = "過濾條件";
$owl_lang->owl_log_hd_action	 = "操作";
$owl_lang->owl_log_hd_agent	 = "代理";
$owl_lang->owl_log_hd_dt_tm	 = "日期 時間";
$owl_lang->owl_log_hd_dtls	 = "詳情";
$owl_lang->owl_log_hd_file	 = "檔案";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	 = "資料夾位置";
$owl_lang->owl_log_hd_ip	 = "IP 位址";
$owl_lang->owl_log_hd_user	 = "使用者";
$owl_lang->owl_log_hide      	 = "隱藏：";
$owl_lang->owl_log_no_rec	 = "沒有記錄";
$owl_lang->owl_log_viewer	 = "查看記錄";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash           = "清空垃圾桶";
$owl_lang->really_empty_trash	 = "確定要清空垃圾桶嗎?";
$owl_lang->recycle_bin_admin     = "垃圾桶管理";
// BEGIN NEW STUFF
$owl_lang->trash_email_body   = "附加了您選取的檔案。";
$owl_lang->trash_email_subject   = "還原您選擇的檔案";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                     = "不處理 -- 檔案權限不變";
$owl_lang->everyoneread			 = "任何人都可以讀取/下載";
$owl_lang->everyoneread_ad		 = "任何人都可以讀取/下載";
$owl_lang->everyonewrite		 = "任何人都可以讀取/下載/修改";
$owl_lang->everyonewrite_ad		 = "任何人都可以讀取/下載/修改";
$owl_lang->everyonewrite_ad_nod		 = "任何人都可以讀取/下載/修改，但不能刪除";
$owl_lang->everyonewrite_nod		 = "任何人都可以讀取/下載/修改，但不能刪除";
$owl_lang->file_size_byte		 = "b";
$owl_lang->file_size_gigabyte		 = "g";
$owl_lang->file_size_kilobyte		 = "k";
$owl_lang->file_size_megabyte		 = "m";
$owl_lang->geveryoneread		 = "任何人都可以讀取這個資料夾";
$owl_lang->geveryoneread_ad		 = "任何人都可以讀取這個資料夾";
$owl_lang->geveryonewrite		 = "任何人都可以上傳檔案和刪除這個資料夾";
$owl_lang->geveryonewrite_ad		 = "任何人都可以上傳檔案和刪除這個資料夾";
$owl_lang->geveryonewrite_ad_nod	 = "任何人都可以上傳檔案到這個資料夾";
$owl_lang->geveryonewrite_nod		 = "任何人都可以上傳檔案到這個資料夾";
$owl_lang->ggroupread			 = "您的群組可以讀取這個資料夾";
$owl_lang->ggroupread_ad		 = "指定的群組可以讀取這個資料夾";
$owl_lang->ggroupwrite			 = "您的群組可以上傳檔案和刪除這個資料夾";
$owl_lang->ggroupwrite_ad    		 = "指定的群組可以上傳檔案和刪除這個資料夾";
$owl_lang->ggroupwrite_ad_nod		 = "指定的群組可以上傳檔案到這個資料夾";
$owl_lang->ggroupwrite_nod		 = "您的群組可以上傳檔案到這個資料夾";
$owl_lang->ggroupwrite_worldread 	 = "您的群組可以上傳檔案和刪除這個資料夾，其他人都只能讀取";
$owl_lang->ggroupwrite_worldread_ad 	 = "指定的群組可以上傳檔案和刪除這個資料夾，其他人都只能讀取";
$owl_lang->ggroupwrite_worldread_ad_nod	 = "指定的群組可以上傳檔案到這個資料夾，其他人都只能讀取，但不能刪除";
$owl_lang->ggroupwrite_worldread_nod 	 = "您的群組可以上傳檔案到這個資料夾，其他人都只能讀取，但不能刪除";
$owl_lang->gonlyyou			 = "只有您可以上傳檔案和刪除這個資料夾";
$owl_lang->gonlyyou_ad			 = "只有您可以上傳檔案和刪除這個資料夾";
$owl_lang->groupread			 = "您的群組可以讀取/下載";
$owl_lang->groupread_ad			 = "指定的群組可以讀取/下載";
$owl_lang->groupwrite			 = "您的群組可以讀取/下載/修改";
$owl_lang->groupwrite_ad		 = "指定的群組可以讀取/下載/修改";
$owl_lang->groupwrite_ad_nod		 = "指定的群組可以讀取/下載/修改，但不能刪除";
$owl_lang->groupwrite_nod		 = "您的群組可以讀取/下載/修改，但不能刪除";
$owl_lang->groupwrite_worldread 	 = "您的群組可以讀取/下載/修改，其他人都只能讀取";
$owl_lang->groupwrite_worldread_ad 	 = "指定的群組可以讀取/下載/修改，其他人都只能讀取";
$owl_lang->groupwrite_worldread_ad_nod 	 = "指定的群組可以讀取/下載/修改(但不能刪除)，其他人都只能讀取";
$owl_lang->groupwrite_worldread_nod 	 = "您的群組可以讀取/下載/修改(但不能刪除)，其他人都只能讀取";
$owl_lang->invalidsess			 = "無效的連接，請重新由主畫面登入<BR>";
$owl_lang->notif_comment_1		 = "評論於";
$owl_lang->notif_comment_2		 = "評論：";
$owl_lang->notif_msg         		 = "這是一個由 DMS 自動產生的訊息<BR><BR>找到 新的/被更新的 檔案附件<BR><BR>";
$owl_lang->notif_msg_alt         	 = "這是一個由 DMS 自動產生的訊息\n\n找到 新的/被更新的 郵寄附件\n\n";
$owl_lang->notif_msg_alt_link            = "這是一個由 DMS 自動產生的訊息\n\n郵件中包含找到的新增/更新的檔案連結\n\n";
$owl_lang->notif_msg_link                = "這是一個由 DMS 自動產生的訊息<br /><br />郵件中包含找到的新增/更新的檔案連結<br /><br />";
$owl_lang->notif_salutation		 = "親愛的";
$owl_lang->notif_subject_comment	 = "新增一個 DMS 檔案備註說明";
$owl_lang->notif_subject_monitor	 = "一個您正在監控中的 DMS 檔案或資料夾已被更新";
$owl_lang->notif_subject_new 		 = "新檔案";
$owl_lang->notif_subject_upd 		 = "一個檔案更新了";
$owl_lang->notif_subject_file_deleted    = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account        = "A NEW ACCOUNT WAS CREATED FOR YOU";
$owl_lang->notif_user			 = "建立/更新者：";
$owl_lang->onlyyou			 = "只有您可以讀取/下載/修改";
$owl_lang->onlyyou_ad			 = "只有您可以讀取/下載/修改";
$owl_lang->orphaned			 = "– 沒有擁有者  –";
$owl_lang->owl_path			 = "檔案路徑：";
$owl_lang->sessinuse			 = "這個行程已經被另一台主機占用，點閱被禁止<BR>";
$owl_lang->sesstimeout			 = "你連接逾時，請重新登入<BR>";
$owl_lang->virus_infected 		 = "受病毒感染的檔案";
$owl_lang->watermark_string             = "Confidential";
$owl_lang->watermark_source             = "DoxBox " . DOXBOX_VERSION;

$owl_lang->virus_return_val		 = "防毒軟體傳回數值：";

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	 = "進入這個資料夾";
$owl_lang->title_browse_site     	 = "連到這個文件位址!";
$owl_lang->title_download_view     	 = "下載/觀看 這個檔案";
$owl_lang->title_edit_prefs     	 = "查看/編輯 使用者偏好設定";
$owl_lang->title_return_folder     	 = "返回到";
$owl_lang->title_sort     		 = "以此排序";
$owl_lang->title_view_my     		 = "觀看我的檔案列表";
$owl_lang->title_view_new     		 = "觀看在我上次離線後所有新進檔案列表";
$owl_lang->title_view_updated     	 = "觀看在我上次離線後所有更新過的檔案列表";
$owl_lang->alt_my                       = "View a List of My Files";
$owl_lang->alt_group                    = "View of My Files in My Groups";
$owl_lang->alt_checked_out              = "View List of Files I Currently have Checheked out";
$owl_lang->alt_news                     = "Unread News items";
$owl_lang->alt_special_access           = "List of Files that I have access to outside my Folder Browse access";

//********************************************************
// HREF TITLE messages  END
//********************************************************


//********************************************************
// admin/news.php and newsread.php BEGIN
//********************************************************

$owl_lang->news_content			 = "內容";
$owl_lang->news_hd			 = "公告";
$owl_lang->news_hd_audience		 = "對象";
$owl_lang->news_hd_created		 = "公告日期";
$owl_lang->news_hd_expires		 = "公告期限";
$owl_lang->news_heading			 = "公告標題";
$owl_lang->news_posted_date		 = "發表日期:";
$owl_lang->news_read			 = "讀取";
$owl_lang->news_title			 = "發佈公告";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		 = "偵錯： DMS 檔案目錄" .$default->owl_fs_root . "/" . fid_to_name(1) ." 不存在。";
$owl_lang->debug_doc_not_writeable	 = "偵錯： DMS 檔案目錄" .$default->owl_fs_root . "/" . fid_to_name(1) ." 無法寫入。";
$owl_lang->debug_file_not_exist		 = "偵錯：點選的檔案 '$default->owl_fs_root/%s' 不存在，<br /> 或是<br /> 設定檔案 config/owl.php 中 \$default->owl_fs_root 指定的路徑有誤。";
$owl_lang->debug_tmp_not_exists		 = "偵錯: 此臨時目錄: $default->owl_tmpdir 不存在.";
$owl_lang->debug_tmp_not_writeable	 = "偵錯: DMS 臨時目錄: $default->owl_tmpdir 不可寫入.";
$owl_lang->debug_webserver_no_access	 = "偵錯：網頁伺服器無法讀取：<br />'$default->owl_fs_root/%s'. <br />請修正權限後重試";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	 = "查看狀態";
$owl_lang->stats_files		 = "每個使用者的檔案數量";
$owl_lang->stats_folders	 = "每個使用者的資料夾數量";
$owl_lang->stats_information	 = "需要啟用 Owl 檔案記錄功能，這個狀態才會顯示出來";
$owl_lang->stats_top		 = "下載排行榜前20名";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users           = "使用者登錄（登入/錯誤/登出）";
$owl_lang->stats_users_loggedin  = "目前登入";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	 = "文件類型管理";
$owl_lang->doc_field_label	 = "欄位標籤（每個語系）";
$owl_lang->doc_field_name	 = "欄位名稱";
$owl_lang->doc_field_pos	 = "欄位位置";
$owl_lang->doc_field_required	 = "必填？";
$owl_lang->doc_field_searchable	 = "可搜尋？";
$owl_lang->doc_field_popup  = "Insert in popup description?";
$owl_lang->doc_field_size	 = "欄位大小";
$owl_lang->doc_new_doc_type	 = "– 新增文件類型 –";
$owl_lang->doc_specific		 = "文件指定欄位：";
$owl_lang->document_type	 = "文件類型";
$owl_lang->document_type_name	 = "文件類型名稱";
// BEGIN NEW STUFF
$owl_lang->doc_field_disp_label  = "欄位標籤：";
$owl_lang->doc_field_disp_sep  = "分隔標籤";
$owl_lang->doc_field_sample	 = "–  檢視樣本  –";
$owl_lang->doc_field_show_in_browse  = "顯示瀏覽器：";
$owl_lang->doc_field_show_in_list  = "顯示的欄位：";
$owl_lang->doc_field_type	 = "欄位類型：";
$owl_lang->doc_field_values	 = "欄位數值用 |  符號分隔：";
$owl_lang->doc_fields  = "自訂欄位";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create          = "群組：";
$owl_lang->header_csv_import     = "匯入 CSV 格式使用者資料";
$owl_lang->import_inserted       = "插入";
$owl_lang->import_skipped        = "跳過";
$owl_lang->invalid_groupid       = "錯誤的 groupid -->";
$owl_lang->msg_user_exists       = "使用者重複";
$owl_lang->sendcsvfile           = "上傳逗點分隔檔案";
$owl_lang->user_created_skipped  = "使用者：";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	 = "啟用互相評論功能：";
$owl_lang->owl_peer_review_opt   = "讓評論選擇性進行：";
$owl_lang->owl_title_peer_review = "互相評論文件功能";
$owl_lang->owl_title_peer_review2 = "互相評論文件";
$owl_lang->peer_approval_title 	 = "個文件等候您的審核";
$owl_lang->peer_approved_body	 = "您的檔案已經通過審核：";
$owl_lang->peer_file_approved	 = "檔案通過審核：";
$owl_lang->peer_file_final	 = "最後審核：";
$owl_lang->peer_file_rejected	 = "檔案被拒絕了：";
$owl_lang->peer_file_to_review	 = "要評論的檔案：";
$owl_lang->peer_final_approval	 = "[最後審核]：";
$owl_lang->peer_final_body	 = "您的文件已經通過審核，<br />請登入後設定文件是否要公開<br />";
$owl_lang->peer_final_body_auto = "Your document has been approved by all requested reviewers.<br />Your file has been made public.<br />";
$owl_lang->peer_msg_to_reviewer	 = "給評論者的訊息";
$owl_lang->peer_my_approval	 = "等候您的審核";
$owl_lang->peer_notif_user	 = "建立/更新者";
$owl_lang->peer_pending_approval = "您等候審核的項目";
$owl_lang->peer_pending_title 	 = "您等候審核的文件";
$owl_lang->peer_reject_reason    = "拒絕理由";
$owl_lang->peer_rejected_body	 = "您的檔案已經被拒絕了：";
$owl_lang->peer_review_body	 = "下面文件需要您的審核：";
$owl_lang->peer_reviewer_list	 = "評論者";
$owl_lang->peer_satus	 	 = "狀態";
$owl_lang->peer_satus_approved   = "— 核准 —";
$owl_lang->peer_satus_pending    = "— 暫緩 —";
$owl_lang->peer_satus_rejected   = "— 拒絕 —";
$owl_lang->peer_subj_approved	 = "您的文件已經通過審核";
$owl_lang->peer_subj_rejected	 = "您的文件已經被拒絕";
$owl_lang->peer_subj_reminder	 = "提醒：您有一個檔案需要檢視";
$owl_lang->peer_subj_review	 = "您有一個檔案需要檢視";

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file              = "新增檔案權限：";
$owl_lang->acl_adding_folder            = "新增資料夾權限：";
$owl_lang->acl_available_groups         = "現有群組";
$owl_lang->acl_available_users          = "現有使用者";
$owl_lang->acl_edit_file                = "編輯檔案權限：";
$owl_lang->acl_edit_folder              = "編輯資料夾權限：";
$owl_lang->acl_file_checkin             = "簽入/出";
$owl_lang->acl_file_comment             = "評論";
$owl_lang->acl_file_copy                = "複製";
$owl_lang->acl_file_delete              = "刪除";
$owl_lang->acl_file_email               = "Email";
$owl_lang->acl_file_modify              = "屬性";
$owl_lang->acl_file_monitor             = "訂閱";
$owl_lang->acl_file_move                = "移動";
$owl_lang->acl_file_read                = "讀取";
$owl_lang->acl_file_search              = "相關搜尋";
$owl_lang->acl_file_set_acl             = "設定權限";
$owl_lang->acl_file_update              = "更新";
$owl_lang->acl_file_view_log            = "檢視紀錄";
$owl_lang->acl_folder_copy              = "複製";
$owl_lang->acl_folder_delete            = "刪除";
$owl_lang->acl_folder_modify            = "修改屬性";
$owl_lang->acl_folder_monitor           = "訂閱";
$owl_lang->acl_folder_move              = "移動";
$owl_lang->acl_folder_read              = "讀取（下載/瀏覽）";
$owl_lang->acl_folder_set_acl           = "設定權限";
$owl_lang->acl_folder_write             = "寫入（建立）";
$owl_lang->acl_heading_file             = "群組/使用者";
$owl_lang->acl_heading_files            = "檔案&#8211; 選擇需要的使用者與群組";
$owl_lang->acl_heading_folder           = "群組/使用者";
$owl_lang->acl_heading_folders          = "資料夾 &#8211; 選擇需要的使用者與群組";
$owl_lang->acl_propagate_file           = "在所有檔案使用這個規則：";
$owl_lang->acl_propagate_folders        = "在所有子資料夾沿用：";
$owl_lang->acl_selected_groups          = "選擇的群組";
$owl_lang->acl_selected_users           = "選擇的使用者";
$owl_lang->acl_set_acl                  = "設定安全規則";
$owl_lang->acl_set_acl_now              = "現在設定的安全規則：";
$owl_lang->acl_set_selected             = "設定選擇的";
$owl_lang->alt_acl_save_file            = "儲存檔案安全規則";
$owl_lang->alt_acl_save_folder          = "儲存資料夾安全規則";
$owl_lang->btn_acl_save                 = "儲存";
$owl_lang->acl_set_file_permissions     = "設定檔案權限";
$owl_lang->acl_set_folder_permissions   = "設定資料夾權限";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports          = "現有報表：";
$owl_lang->report_file_folder                = "檔案/資料夾";
$owl_lang->report_filter                     = "規則：";
$owl_lang->report_filter_since               = "開始：";
$owl_lang->report_full_access                = "完整權限";
$owl_lang->report_select_report              = "– 選擇一個報表 –";
$owl_lang->report_users_disabled_title       = "停用的使用者";
$owl_lang->report_users_entitlement          = "使用者權限";
$owl_lang->report_users_inactive_title       = "使用者停用開始於";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails          = "啟用縮圖檢視/產生：";
$owl_lang->thumb_gen_thumb_tool_path        = "ImageMagick 轉換工具路徑：";
$owl_lang->thumb_gen_thumb_vid_tool_parms   = "Mplayer 參數：";
$owl_lang->thumb_gen_thumb_vid_tool_path    = "Mplayer路徑：";
$owl_lang->thumb_image_info                 = "圖片資訊";
$owl_lang->thumb_large_width                = "大型縮圖寬度：";
$owl_lang->thumb_med_width                  = "中型縮圖寬度：";
$owl_lang->thumb_number_colums              = "縮圖檢視的欄位數量：";
$owl_lang->thumb_re_generate                = "產生縮圖";
$owl_lang->thumb_small_width                = "小縮圖寬度：";
$owl_lang->thumb_title                      = "縮圖檢視/產生選項";
$owl_lang->thumb_title_thumb_view           = "縮圖檢視細節";
$owl_lang->thumb_image_size                 = "圖片大小：";
$owl_lang->alt_thumb_small                  = "小縮圖";
$owl_lang->alt_no_thumb                     = "沒有縮圖";

//********************************************************
// THUMBNAILS END
//********************************************************


//********************************************************
// EXTENDED HELP BEGIN
//********************************************************

$owl_lang->owl_track_favorites_extended         = "Track Favorites";
$owl_lang->owl_password_override_extended       = "If this is set then users that don't have access to the file can use a password to download";
$owl_lang->owl_view_doc_in_new_window_extended 	= "When you View A document the document is viewed in a seperate window";
$owl_lang->owl_filedescreq_extended             = "Make the File Description a REQUIRED Field";
$owl_lang->owl_old_action_icons_extended        = "Extended Help";
$owl_lang->owl_email_from_extended              = "Extended Help";
$owl_lang->owl_email_fromname_extended  	= "Extended Help";
$owl_lang->owl_email_replyto_extended   	= "Extended Help";
$owl_lang->owl_email_server_extended            = "Extended Help";
$owl_lang->owl_use_smtp_extended                = "Extended Help";
$owl_lang->owl_use_smtp_auth_extended           = "Extended Help";
$owl_lang->owl_smtp_auth_login_extended         = "Extended Help";
$owl_lang->owl_smtp_passwd_extended           	= "Extended Help";
$owl_lang->owl_email_subject_extended           = "Extended Help";
$owl_lang->owl_forgot_pass_extended             = "Extended Help";
$owl_lang->owl_self_reg_extended                = "Extended Help";
$owl_lang->owl_html2text_path_extended  	= "Extended Help";
$owl_lang->owl_remember_me_extended             = "Extended Help";
$owl_lang->owl_status_bar_location_extended     = "Extended Help";
$owl_lang->owl_info_panel_wide_extended 	= "Extended Help";
$owl_lang->owl_thumbnails_extended         	= "Extended Help";
$owl_lang->owl_use_smtp_ssl_extended          = "Extended Help";
$owl_lang->owl_smtp_port_extended          = "Extended Help";
$owl_lang->owl_smtp_max_size_extended          = "Extended Help";
$owl_lang->owl_lookAtHD_extended          = "Extended Help";
$owl_lang->owl_pref_bar_extended          = "Extended Help";
$owl_lang->owl_search_bar_extended          = "Extended Help";
$owl_lang->owl_bulk_buttons_extended          = "Extended Help";
$owl_lang->owl_action_buttons_extended          = "Extended Help";
$owl_lang->owl_folder_tools_extended          = "Extended Help";
$owl_lang->owl_hide_folder_doc_count_extended          = "Extended Help";
$owl_lang->owl_hide_folder_size_extended          = "Extended Help";
$owl_lang->owl_use_zip_extended          = "Extended Help";
$owl_lang->owl_force_ssl_extended          = "Extended Help";
$owl_lang->owl_allow_different_filename_update_extended          = "Extended Help";
$owl_lang->owl_use_wysiwyg_for_textarea_extended          = "Extended Help";
$owl_lang->owl_search_result_folders_extended          = "Extended Help";
$owl_lang->owl_show_user_info_extended          = "Extended Help";
$owl_lang->owl_folderdescreq_extended          = "Extended Help";
$owl_lang->owl_show_folder_desc_as_popup_extended          = "Extended Help";
$owl_lang->owl_owl_expand_extended          = "Extended Help";
$owl_lang->owl_thumbnails_tool_path_extended          = "Extended Help";
$owl_lang->owl_thumbnails_video_tool_path_extended          = "Extended Help";
$owl_lang->owl_thumbnails_video_tool_opt_extended          = "Extended Help";
$owl_lang->owl_thumbnails_small_width_extended          = "Extended Help";
$owl_lang->owl_thumbnails_med_width_extended          = "Extended Help";
$owl_lang->owl_thumbnails_large_width_extended          = "Extended Help";
$owl_lang->owl_thumbnail_view_columns_extended          = "Extended Help";
$owl_lang->owl_pdf_watermarks_extended          = "Extended Help";
$owl_lang->owl_pdf_watermark_path_extended          = "Extended Help";
$owl_lang->owl_pdf_custom_watermark_filepath_extended          = "Extended Help";
$owl_lang->owl_pdf_pdftk_tool_greater_than_1_40_extended          = "Extended Help";
$owl_lang->owl_allow_custpopup_extended          = "Extended Help";
$owl_lang->owl_allow_popup_extended          = "Extended Help";
$owl_lang->owl_version_control_extended          = "Extended Help";
$owl_lang->owl_make_file_indexing_user_selectable_extended          = "Extended Help";
$owl_lang->owl_turn_file_index_off_extended          = "Extended Help";
$owl_lang->owl_docRel_extended          = "Extended Help";
$owl_lang->owl_default_revision_extended          = "Extended Help";
$owl_lang->owl_machine_time_zone_extended          = "Extended Help";
$owl_lang->owl_major_revision_extended          = "Extended Help";
$owl_lang->owl_minor_revision_extended          = "Extended Help";
$owl_lang->owl_restrict_view_extended          = "Extended Help";
$owl_lang->owl_hide_backup_extended          = "Extended Help";
$owl_lang->owl_min_pass_length_extended          = "Extended Help";
$owl_lang->owl_min_username_length_extended          = "Extended Help";
$owl_lang->owl_min_pass_numeric_extended          = "Extended Help";
$owl_lang->owl_min_pass_special_extended          = "Extended Help";
$owl_lang->owl_enable_lock_account_extended          = "Extended Help";
$owl_lang->owl_lock_account_bad_password_extended          = "Extended Help";
$owl_lang->owl_track_user_passwords_extended          = "Extended Help";
$owl_lang->owl_change_password_every_extended          = "Extended Help";
$owl_lang->owl_rec_per_page_extended          = "Extended Help";
$owl_lang->owl_doc_id_prefix_extended          = "Extended Help";
$owl_lang->owl_doc_id_num_digits_extended          = "Extended Help";
$owl_lang->owl_admin_login_to_browse_page_extended          = "Extended Help";
$owl_lang->owl_save_keywords_to_db_extended          = "Extended Help";
$owl_lang->owl_max_filesize_extended          = "Extended Help";
$owl_lang->owl_owl_timeout_extended          = "Extended Help";
$owl_lang->owl_owl_tmpdir_extended          = "Extended Help";
$owl_lang->owl_anon_ro_extended          = "Extended Help";
$owl_lang->owl_def_anon_user_extended          = "Extended Help";
$owl_lang->owl_file_admin_group_extended          = "Extended Help";
$owl_lang->owl_collect_trash_extended          = "Extended Help";
$owl_lang->owl_trash_can_location_extended          = "Extended Help";
$owl_lang->owl_restore_file_prefix_extended          = "Extended Help";
$owl_lang->owl_peer_review_extended          = "Extended Help";
$owl_lang->owl_peer_opt_extended          = "Extended Help";
$owl_lang->owl_leave_old_file_accessible_extended          = "Extended Help";
$owl_lang->owl_auto_checkout_checking_extended          = "Extended Help";
$owl_lang->owl_logging_extended          = "Extended Help";
$owl_lang->owl_log_file_extended          = "Extended Help";
$owl_lang->owl_log_login_extended          = "Extended Help";
$owl_lang->owl_log_rec_per_page_extended          = "Extended Help";
$owl_lang->owl_self_reg_quota_extended          = "Extended Help";
$owl_lang->owl_self_reg_notify_extended          = "Extended Help";
$owl_lang->owl_self_reg_attachfile_extended          = "Extended Help";
$owl_lang->owl_self_reg_disabled_extended          = "Extended Help";
$owl_lang->owl_self_reg_noprefacces_extended          = "Extended Help";
$owl_lang->owl_self_reg_maxsessions_extended          = "Extended Help";
$owl_lang->owl_self_create_homedir_extended          = "Extended Help";
$owl_lang->owl_self_captcha_extended          = "Extended Help";
$owl_lang->owl_self_reg_group_extended          = "Extended Help";
$owl_lang->owl_cookie_timeout_extended          = "Extended Help";
$owl_lang->owl_virus_path_extended          = "Extended Help";
$owl_lang->owl_dbdump_path_extended          = "Extended Help";
$owl_lang->owl_gzip_path_extended          = "Extended Help";
$owl_lang->owl_tar_path_extended          = "Extended Help";
$owl_lang->owl_unzip_path_extended          = "Extended Help";
$owl_lang->owl_pod2html_path_extended          = "Extended Help";
$owl_lang->owl_rtftotext_path_extended          = "Extended Help";
$owl_lang->owl_pdftotext_path_extended          = "Extended Help";
$owl_lang->owl_wordtotext_path_extended          = "Extended Help";
$owl_lang->owl_ppttotext_path_extended          = "Extended Help";
$owl_lang->owl_lookAtHD_del_extended            = "Extended Help";
$owl_lang->owl_def_file_title_extended           = "Extended Help";
$owl_lang->owl_def_file_meta_extended           = "Extended Help";

//********************************************************
// EXTENDED HELP END
//********************************************************

$owl_lang->group_set_selected      = "Set Selected";
$owl_lang->alt_group_set_selected  = "Sets the selected users";

$owl_lang->btn_jupload                          = "Jupload";
$owl_lang->alt_btn_jupload                      = "Add Multiple files using jupload";

$owl_lang->owl_use_smtp_ssl                     = "SMTP SSL:";
$owl_lang->owl_smtp_port                        = "SMTP Port Number:";
$owl_lang->owl_smtp_max_attachemnt_size         = "Maximum Attachent Size (bytes):";
$owl_lang->owl_force_browser_to_ssl             = "Force Browser to use HTTPS:";
$owl_lang->owl_file_update_different_name       = "File Update with Different Name:<br />(EXTENSION Must remain the same.)";
$owl_lang->owl_use_wysiwyg_editor               = "Use WYSIWYG Editor for TextArea:";
$owl_lang->owl_show_folder_desc_popup           = "Show Folder Description as Popup:";
$owl_lang->owl_header_watermarking              = "PDF WATER MARKING OPTIONS";
$owl_lang->owl_enable_watermarking              = "Enable Pdf Watermarking:";
$owl_lang->owl_path_to_pdftk                    = "Path to pdftk:";
$owl_lang->owl_path_to_pdftk_bg_file            = "Path to custom watermark:<br />(path to a 1 page pdf file that will be used <br />as the watermark instead of the default";
$owl_lang->owl_pdftk_greater_than_1_40          = "PDFTK version Greater than 1.40:";
$owl_lang->owl_indexing_user_selectable         = "Make File Indexing User Selectable:";
$owl_lang->owl_indexing_off                     = "Turn File Indexing OFF:";
$owl_lang->owl_default_revision_type            = "Default Revision Type:";
$owl_lang->owl_machine_timezone                 = "Machine Time zone:";
$owl_lang->owl_previous_ver_downloadable        = "Make Previous Version Accesible:";
$owl_lang->owl_auto_checkin_checkout            = "Mark Files as Checked out on Download:";
$owl_lang->owl_user_default_view                = "User Default View EXPANDED:";
$owl_lang->owl_user_default_revision            = "Default Revision Type:";
$owl_lang->owl_user_major_revision              = "User Initial Major Revision:";
$owl_lang->owl_user_minor_revision              = "User Initial Minor Revision:";
$owl_lang->owl_user_pdfwatermark                = "PDF get Watermarked:";
$owl_lang->owl_user_email_pass                  = "Email User / Password:";
$owl_lang->owl_use_email_signature              = "Use Signature?:";
$owl_lang->owl_email_signature                  = "Email Signature:";
$owl_lang->owl_file_link                        = "File Link:";
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
$owl_lang->field_type_table = "Table";
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
$owl_lang->ownership_change_1 = "You do not own this file.";
$owl_lang->ownership_change_2 = "Would you like to take ownership on Checkout?";
$owl_lang->ownership_change_subj = "File: %s -- Take Ownership (%s)";

$owl_lang->member_membership = "Membership";
$owl_lang->member_fileadmin = "File Admin";
$owl_lang->member_group = "Group";

$owl_lang->user_created = "Created.";
$owl_lang->err_bad_username     = "Please enter a valid username or email address";

$owl_lang->motd_headding = "Message of the Day MOTD";
$owl_lang->motd_label    = "Message (Blank For None)";
$owl_lang->favorite_label = "Label:";

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

$owl_lang->alt_btn_import_users    = "Import users From CSV File";
$owl_lang->btn_admin_maint_on           = "MAINTENANCE MODE";
$owl_lang->alt_btn_admin_maint_on       = "Blocks User sigon, so the administrator can perform a task without users on the system";
$owl_lang->btn_admin_maint_off          = "NORMAL MODE";
$owl_lang->alt_btn_admin_maint_off = "Turn Maintenace Mode Off (Permit Users to Login)";
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
