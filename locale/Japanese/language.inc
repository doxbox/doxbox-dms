<?php

/*
 * File: Japanese/language.inc
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
$owl_lang->lang_code = "ja";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "あなたにはこのファイルに注釈を追加する権限がありません";
$owl_lang->err_backup_file   		= "既存ファイルのバックアップでエラー";
$owl_lang->err_backup_folder_create 	= "バックアップ用フォルダー作成でエラー";
$owl_lang->err_bad_url			= "正しいURLを入力してください";
$owl_lang->err_bad_version_1 		= "DMS イントラネットが必要とする最小のPHPバージョン";
$owl_lang->err_bad_version_2 		= "あなたのバージョン";
$owl_lang->err_bad_version_3 		= "新しいバージョンのPHPをインストールして、再度実行してみてください。";
$owl_lang->err_comment_empty		= "注釈を空にすることは出来ません";
$owl_lang->err_email         		= "メッセージは送信されませんでした";
$owl_lang->err_email_required		= "電子メールフィールドの入力が必要です";
$owl_lang->err_fexist1			= "<b>ファイルが存在:</b>";
$owl_lang->err_fexist2 			= "そのファイル <i>";
$owl_lang->err_fexist3 			= "</i>  は、このディレクトリに既に存在します";
$owl_lang->err_file_exists		= "アップロードしようとしているファイルは既に存在します";
$owl_lang->err_file_lock     		= "あなたはこのファイルをチェックアウトできません, 他の人が保留しています";
$owl_lang->err_file_not_exist		= "ファイルがこのファイルシステムにありません";
$owl_lang->err_file_too_big		= "php.ini のupload_max_filesize 超過 もしくは<br />DMSシステムの 最大ファイルサイズ超過です";
$owl_lang->err_file_update		= "ファイル更新は、同一のファイル名でなければなりません。同一ファイル名で再度実行して下さい。";
$owl_lang->err_fileexists    		= "移動がキャンセルされました<br />同じ名前のファイルが既に存在します";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "名前を変更しようとしているファイルが既に存在します";
$owl_lang->err_folder_create 		= "フォルダーの作成エラー";
$owl_lang->err_folder_exist		= "このフォルダーは既に存在します";
$owl_lang->err_folderexists  		= "名前の変更がキャンセルされました<br />同じ名前のフォルダーが既に存在します";
$owl_lang->err_general 			= "エラーが発生しました";
$owl_lang->err_select_reviewer		= "文書を検閲する人を少なくとも一人選んでください";
$owl_lang->err_update_file_lock     	= "このファイルを更新することができません、他の人が保留中です";
// NEW CHANGE
$owl_lang->err_group_delete		= "メンバーを含むグループは削除出来ません: <font color=\"red\">%d</font> ファイル,  <font color=\"red\">%d</font> フォルダ, <font color=\"red\">%d</font> ユーザが このグループに関連付けられています, <font color=\"red\">%d</font> ユーザがこのグループの一員です";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "削除できません。この文書タイプを使用中のファイルが存在します";
$owl_lang->err_database			= "データベースエラー";
$owl_lang->err_doc_field_req            = "必要項目が欠落しています:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "文書タイプ名が必要です <br />";
$owl_lang->err_field_label_req 		= "項目ラベルが必要です <br />";
$owl_lang->err_field_name_req		= "項目名が必要です <br />";
$owl_lang->err_field_size_req		= "項目サイズが必要です <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "一時的な 'テキスト' ファイル作成エラー";
$owl_lang->err_forbidden_file		= "使用できないファイルタイプ";
$owl_lang->err_group_exists		= "同じ名前のグループが存在します";
$owl_lang->err_gzip_not_found  		= "gzipが見つかりませんでした ";
$owl_lang->err_login			= "この操作をするにはログインしてください";
$owl_lang->err_movecancel    		= "移動はキャンセルされました<br />";
$owl_lang->err_nameempty    		= "フォルダー名を空にすることは出来ません";
$owl_lang->err_news_required		= "エラー：ニュースの見出しと内容が必要です！";
$owl_lang->err_no_access 		= "ファイル/フォルダーに対してアクセスエラー";
$owl_lang->err_no_access_info 		= "考えられる原因: <br />1) ファイルやフォルダーのチェックボックスを選んでいない<br />2) 一括削除、一括メール、一括チェックアウトはフォルダーに対してできない<br />3) 選択したファイルやフォルダーに対してアクセス権限がない";
$owl_lang->err_noemail			= "あなたはこのファイルをメール送信する権限がありません";
$owl_lang->err_nofileaccess		= "あなたはこのファイルにアクセスする権限がありません";
$owl_lang->err_nofiledelete		= "あなたはこのファイルを削除する権限がありません";
$owl_lang->err_nofilemod		= "あなたはこのファイルを修正する権限がありません";
$owl_lang->err_nofolderaccess		= "あなたはこのフォルダーをアクセスする権限がありません";
$owl_lang->err_nofolderdelete		= "あなたはこのフォルダーを削除する権限がありません";
$owl_lang->err_nofoldermod		= "あなたはこのフォルダーを修正する権限がありません";
$owl_lang->err_nosubfolder		= "あなたはここにサブフォルダーをつくる権限がありません";
$owl_lang->err_not_zip			= "正しいZIPファイルではありません";
$owl_lang->err_note_title               = "タイトルは必須項目です";
$owl_lang->err_note_title_exists        = "その名前のノートは既にあります";
$owl_lang->err_noupload			= "あなたはこのフォルダーへアップロードする権限がありません";
$owl_lang->err_pass_missmatch		= "新しいパスワードと確認のために入力したパスワードが一致しません";
$owl_lang->err_pass_wrong    		= "古いパスワードが間違っています";
$owl_lang->err_please_select_bulk       = "チェックボックスを使ってひとつ以上のファイルかフォルダーを選択してください";
$owl_lang->err_pod2html_not_found       = "ERROR: The pod2html tool was not found:";
$owl_lang->err_quota			= "あなたはこのファイルをアップロードするための十分な領域割当をもっていません: ";
$owl_lang->err_quota_avail		= " 可能.";
$owl_lang->err_quota_exceed  		= "あなたは領域割当制限を越えています";
$owl_lang->err_quota_needed		= " 必要 ";
$owl_lang->err_req			= "エラー: 全フィールドの入力が必須です";
$owl_lang->err_root_delete		= "ルートフォルダーは削除できません";
$owl_lang->err_sess_notvalid 		= "セッションIDが正しくありません";
$owl_lang->err_sess_write		= "セッション情報をデータベースに記録時にエラーが発生しました";
$owl_lang->err_specialfoldername 	= "'backup' はDMSの予約フォルダ名です。違う名前を選んでください";
$owl_lang->err_sql			= "SQL エラー";
$owl_lang->err_tar_not_found  		= "tar が見つかりませんでした ";
$owl_lang->err_trash_can_empty 		= "ゴミ箱が空です";
$owl_lang->err_unauth_area   		= "本領域の使用は許可されません";
$owl_lang->err_unauthorized  		= "許可できませんでした";
$owl_lang->err_upload 			= "アップロードエラー";
$owl_lang->err_user_exists		= "ユーザ名が存在します";
$owl_lang->err_captcha_auth		= "CAPTCHA 認証に失敗しました";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "項目を追加";
$owl_lang->btn_add_file          = "資料を追加";
$owl_lang->btn_add_folder          = "フォルダを追加";
$owl_lang->btn_dist_folder       = "フォルダ公開";
$owl_lang->btn_add_news          = "ニュースを追加";
$owl_lang->btn_add_note          = "注釈を追加";
$owl_lang->btn_jupload          = "Jupload";
$owl_lang->btn_add_url          = "URLを追加";
$owl_lang->btn_add_zip           = "書庫(ZIP)を追加";
$owl_lang->btn_admin      = "管理機能";
$owl_lang->btn_admin_groups          = "新規グループ";
$owl_lang->btn_admin_news          = "ニュース管理者";
$owl_lang->btn_admin_user_group          = "ユーザ・グループ管理";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "新規ユーザ";
$owl_lang->btn_back          = "戻る";
$owl_lang->btn_browse     = "ブラウズ";
$owl_lang->btn_bulk_checkout       = "一括チェックアウト";
$owl_lang->btn_bulk_delete         = "一括削除";
$owl_lang->btn_bulk_download          = "一括ダウンロード";
$owl_lang->btn_bulk_email          = "一括メール送信";
$owl_lang->btn_bulk_move          = "一括移動";
$owl_lang->btn_cancel          = "キャンセル";
$owl_lang->btn_clickhere          = "ここをクリック";
$owl_lang->btn_collapse_view          = "縮小表示";
$owl_lang->btn_create          = "作成";
$owl_lang->btn_default_view          = "通常表示";
$owl_lang->btn_deldoctype          = "文書タイプ削除";
$owl_lang->btn_download_bulk_package	= "to download your bulk download Package";
$owl_lang->btn_edit_group          = "グループ編集";
$owl_lang->btn_edit_user          = "ユーザ編集";
$owl_lang->btn_expand_view          = "拡大表示";
$owl_lang->btn_go_bottom      = "最後へ";
$owl_lang->btn_go_top      = "トップへ";
$owl_lang->btn_help     = "ヘルプ";
$owl_lang->btn_import_users  = "ユーザをインポート";
$owl_lang->btn_login          = "ログイン";
$owl_lang->btn_logout     = "ログアウト";
$owl_lang->btn_mail_tool     = "メール";
$owl_lang->btn_register          = "登録";
$owl_lang->btn_reset          = "リセット";
$owl_lang->btn_send_email          = "メールを送る";
$owl_lang->btn_submit          = "送信";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "サムネイル表示";
$owl_lang->btn_trash_admin          = "ゴミ箱";
// NEW STUFF
$owl_lang->btn_export          = "エクスポート";
$owl_lang->btn_gen_pdf          = "PDFを作成";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "このファイルへ注釈を追加";
$owl_lang->alt_add_field	= "上記項目を追加する";
$owl_lang->alt_add_group	= "このグループを作成";
$owl_lang->alt_add_news		= "新規ニュース項目の追加";
$owl_lang->alt_add_user		= "このユーザを作成";
$owl_lang->alt_admin_flush      = "古い/期限切れのセッションを更新";
$owl_lang->alt_admin_groups	= "新規グループの作成";
$owl_lang->alt_admin_users	= "新規ユーザの作成";
$owl_lang->alt_approve_file 	= "この資料を許可";
$owl_lang->alt_back      	= "前画面へ戻る";
$owl_lang->alt_btn_add_file     = "新規ファイルをアップロード";
$owl_lang->alt_btn_add_folder	= "新規フォルダーの作成";
$owl_lang->alt_btn_dist_folder  = "RSS フィードの作成 / このフォルダをTorrentに登録";
$owl_lang->alt_btn_add_note     = "新規注釈の追加";
$owl_lang->alt_btn_jupload     = "juploadを用いて複数のファイルを追加";
$owl_lang->alt_btn_add_url	= "新規Webリンクを作成";
$owl_lang->alt_btn_add_zip     	= "Zipファイルをアップロードし展開";
$owl_lang->alt_btn_admin 	= "DMS 管理者";
$owl_lang->alt_btn_browse	= "ファイルブラウザへ戻る";
$owl_lang->alt_btn_bulk_checkout= "ファイルの一括チェックアウト";
$owl_lang->alt_btn_bulk_delete 	= "ファイルの一括削除";
$owl_lang->alt_btn_bulk_download= "ファイルの一括ダウンロード";
$owl_lang->alt_btn_bulk_email  	= "ファイルのメール一括送信";
$owl_lang->alt_btn_bulk_move   	= "ファイル・フォルダーの一括移動";
$owl_lang->alt_btn_clickhere	= "ここをクリック";
$owl_lang->alt_btn_collapse_view= "縮小表示へ切替";
$owl_lang->alt_btn_default_view = "通常表示へ切替";
$owl_lang->alt_btn_expand_view  = "拡大表示へ切替";
$owl_lang->alt_btn_help		= "DMS オンラインヘルプ";
$owl_lang->alt_btn_login	= "DMS イントラネットへログイン";
$owl_lang->alt_btn_logout	= "DMS イントラネットからログアウト";
$owl_lang->alt_btn_mail_tool   	= "簡易電子メールツール";
$owl_lang->alt_btn_thumb_view   = "サムネイル表示へ切替";
$owl_lang->alt_cancel		= "このアクションをキャンセル";
$owl_lang->alt_cancel_move	= "移動アクションをキャンセル";
$owl_lang->alt_change		= "このレコードを更新";
$owl_lang->alt_comments 	= "このファイルの注釈があります";
$owl_lang->alt_copy_file     	= "ファイルをコピー";
$owl_lang->alt_copy_folder   	= "フォルダーをコピー";
$owl_lang->alt_del_all		= "ごみ箱を空にすします";
$owl_lang->alt_del_comments     = "この注釈を削除";
$owl_lang->alt_edt_comments     = "この注釈を編集";
$owl_lang->alt_del_field	= "この項目を削除する";
$owl_lang->alt_del_file      	= "ファイルを削除します (Y/N)";
$owl_lang->alt_del_folder    	= "フォルダーを削除します (Y/N)";
$owl_lang->alt_del_group	= "このグループを削除します";
$owl_lang->alt_del_news		= "このニュースを削除します";
$owl_lang->alt_del_selected	= "選択された全ファイルを削除します";
$owl_lang->alt_del_this_folder	= "フォルダーを削除 &#8211; ";
$owl_lang->alt_del_user		= "このユーザを削除";
$owl_lang->alt_deldoctype	= "現在の資料タイプを削除する";
$owl_lang->alt_edit_field	= "この項目定義を編集する";
$owl_lang->alt_edit_group       = "選択したグループを編集";
$owl_lang->alt_edit_news	= "このニュースを編集";
$owl_lang->alt_edit_user        = "選択したユーザを編集";
$owl_lang->alt_email		= "このファイルをメール";
$owl_lang->alt_email_reminder 	= "リマインダーをメール";
$owl_lang->alt_email_selected	= "全選択ファイルをメール送信";
$owl_lang->alt_get_file      	= "ファイルをダウンロード";
$owl_lang->alt_get_folder      	= "フォルダーの内容をダウンロード";
$owl_lang->alt_go_bottom      	= "このページの最後へ行く";
$owl_lang->alt_go_top 		= "このページのトップへ行く";
$owl_lang->alt_have_news	= "ニュースがあります";
$owl_lang->alt_have_no_news	= "ニュースはありません";
$owl_lang->alt_home_folder	= "初期ディレクトリーへ戻る";
$owl_lang->alt_link_file     	= "このファイルを他のディレクトリーへリンク";
$owl_lang->alt_lock_file        = "ファイルをチェックアウト";
$owl_lang->alt_log_clear        = "全ログを削除しますか (Y/N)";
$owl_lang->alt_log_file         = "ファイルログ";
$owl_lang->alt_log_next		= "次のレコードを表示";
$owl_lang->alt_log_prev		= "前のレコードを表示";
$owl_lang->alt_log_top		= "最初のレコードへ";
$owl_lang->alt_mod_file      	= "ファイルの属性を修正"; 
$owl_lang->alt_mod_folder    	= "フォルダーの属性を修正";
$owl_lang->alt_monitor		= "ファイルを監視";
$owl_lang->alt_monitor_folder	= "このフォルダーを監視";
$owl_lang->alt_monitored	= "このファイルの監査を中止";
$owl_lang->alt_monitored_folder	= "このフォルダーの監視を中止";
$owl_lang->alt_move_file     	= "ファイルを移動";
$owl_lang->alt_move_folder   	= "フォルダーを移動";
$owl_lang->alt_move_selected	= "選択した全ファイルを移動";
$owl_lang->alt_my_approval	= "私の承認を待っている資料";
$owl_lang->alt_new_doctype	= "新規資料タイプを作成する";
$owl_lang->alt_news_close	= "ニュースウィンドウを閉じる";
$owl_lang->alt_news_next	= "次のニュース項目を表示";
$owl_lang->alt_news_prev	= "前のニュース項目を表示";
$owl_lang->alt_news_print	= "このニュース項目を印刷";
$owl_lang->alt_pending_approval	= "承認中の資料";
$owl_lang->alt_play_file 	= "メディアファイルをプレイ";
$owl_lang->alt_publish_file 	= "資料を公開する";
$owl_lang->alt_recycle		= "ごみ箱<br />(空)";
$owl_lang->alt_recycle_disable	= "ごみ収集物<br />(使用しない)";
$owl_lang->alt_recycle_not_found= "ゴミ箱<br />（なし）";
$owl_lang->alt_refresh_filter	= "フィルター開始／結果を再表示";
$owl_lang->alt_register		= "登録を送信";
$owl_lang->alt_reject_file 	= "この資料を拒否";
$owl_lang->alt_related		= "関連資料を見つける";
$owl_lang->alt_reset_form	= "フォームをリセット";
$owl_lang->alt_rest_selected	= "選択した全ファイルを復元";
$owl_lang->alt_search		= "検索を開始";
$owl_lang->alt_send_email	= "メールを送信する";
$owl_lang->alt_sendfile		= "ファイルを送信する";
$owl_lang->alt_set_initial_dir	= "現在のディレクトリーを初期ディレクトリーとして設定";
$owl_lang->alt_site_map         = "サイトマップ";
$owl_lang->alt_submit      	= "フォームを送信";
$owl_lang->alt_toggle_check_box	= "チェックボックスをトグル";
$owl_lang->alt_tool_status_green= "ツールが使えます";
$owl_lang->alt_tool_status_red	= "パスが正しくないか実行可能でありません";
$owl_lang->alt_unlock_file      = "ファイルをチェックイン";
$owl_lang->alt_upd_field	= "この項目を更新する";
$owl_lang->alt_upd_file      	= "ファイルを更新";
$owl_lang->alt_view_comments    = "ファイルのコメントを追加または見る";
$owl_lang->alt_view_file     	= "ファイルをみる";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "再利用ビン管理者";
$owl_lang->alt_edit_file_inline = "テキストファイルを編集";
$owl_lang->alt_gen_pdf          = "上記ファイルのPDFを作成する";
$owl_lang->alt_updated     	= "あなたの最終訪問から資料が更新されています";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "あなたの最終訪問から資料が作成されています";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// DMS Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "全コンテンツも削除されました";
$owl_lang->log_detail		= "追加の詳細はありません";
$owl_lang->log_file_to		= "TO: ";
$owl_lang->log_filter_all	= "ALL";
$owl_lang->log_login_det	= "ユーザ名: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "変更されたグループ: ";
$owl_lang->log_admin_changed_user = "変更されたユーザ: ";
$owl_lang->log_admin_created_group = "作成されたグループ: ";
$owl_lang->log_admin_created_user = "作成されたユーザ: ";
$owl_lang->log_admin_del_group = "削除されたグループ: ";
$owl_lang->log_admin_del_user = "削除されたユーザ: ";
$owl_lang->log_admin_disabled = " 使用不可のユーザ: ";
$owl_lang->log_admin_email_restore = "メールされたファイル:";
$owl_lang->log_admin_trash_delfile= "削除されたファイル: ";
$owl_lang->log_admin_trash_delfold = "削除されたフォルダー: ";
$owl_lang->log_admin_trash_empty = "ごみ箱が空になりました";
$owl_lang->log_admin_trash_restore = "復元: ";
$owl_lang->log_login_expired    = "期限切れユーザ: ";
$owl_lang->log_login_too_many_attempts = "使用不可（ログイン失敗オーバ）: ";
$owl_lang->log_readhd_feature_add  = "Read HD Feature Added this file";
$owl_lang->log_admin_to  = "to";
$owl_lang->log_admin_of  = "of";
// END NEW STUFF
$log_file_actions[1]        	= "ログイン";
$log_file_actions[10]        	= "ロックされていない";
$log_file_actions[11]        	= "メールされたファイル";
$log_file_actions[12]        	= "移動されたファイル";
$log_file_actions[13]        	= "作成されたフォルダー";
$log_file_actions[14]        	= "削除されたフォルダー";
$log_file_actions[15]        	= "修正されたフォルダー";
$log_file_actions[16]        	= "移動されたフォルダー";
$log_file_actions[17]        	= "忘れたパスワード";
$log_file_actions[18]        	= "ユーザ登録";
$log_file_actions[19]           = "みたファイル";
$log_file_actions[2]        	= "ログイン失敗";
$log_file_actions[20]           = "ファイルウィルス";
$log_file_actions[21]           = "複写されたファイル";
$log_file_actions[22]           = "複写されたフォルダー";
$log_file_actions[23]           = "リンクされたファイル";
$log_file_actions[3]        	= "ログアウト";
$log_file_actions[4]        	= "削除されたファイル";
$log_file_actions[5]        	= "ファイルアップロード";
$log_file_actions[6]        	= "更新されたファイル";
$log_file_actions[7]        	= "ダウンロードされたファイル";
$log_file_actions[8]        	= "変更されたファイル";
$log_file_actions[9]        	= "ロックされたファイル";
// BEGIN NEW STUFF
$log_file_actions[24]           = "ユーザ管理";
$log_file_actions[25]           = "ごみ箱";
$log_file_actions[26]           = "ファイルACL";
$log_file_actions[27]           = "フォルダACL";
$log_file_actions[28]           = "フォルダ配布";
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
$owl_lang->admin_login_date  = "管理者ログイン日時: ";
$owl_lang->admin_login_from  = "管理者ログイン元";
$owl_lang->admin_login_subject  = "管理者ログイン";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(匿名でアクセス)";
$owl_lang->engine 		= "DMS イントラネットエンジン";
$owl_lang->forgot_pass		= "パスワードを忘れましたか？";
$owl_lang->like_register	= "登録しますか？";
$owl_lang->login		= "ログイン";
$owl_lang->logindisabled	= "アカウントが使用不可です。管理者へ連絡ください。";
$owl_lang->loginfail		= "ログイン失敗";
$owl_lang->password		= "パスワード";
$owl_lang->repository_list      = "情報倉庫:";
$owl_lang->successlogout 	= "ログアウトしました";
$owl_lang->toomanysessions	= "ユーザの最大セッション数。システム管理者へ連絡";
$owl_lang->username		= "UserName";
$owl_lang->forgot_username	= "ユーザ名またはメールアドレス";
$owl_lang->version 		= "バージョン";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "アクション";
$owl_lang->current_db         		= "現在のリポジトリ:";
$owl_lang->current_folder 		= "現在のフォルダ:";
$owl_lang->del_all			= "ごみ箱を空に";
$owl_lang->del_selected			= "選択したものを削除";
$owl_lang->disk_quota			= "ディスク容量";
$owl_lang->doc_number 			= "資料番号";
$owl_lang->email_selected		= "選択したものへメール";
$owl_lang->file 			= "ファイル";
$owl_lang->folder_count_file		= "ファイル";
$owl_lang->folder_count_folder		= "フォルダ";
$owl_lang->folder_count_note		= "注釈";
$owl_lang->folder_count_pre		= "このフォルダの内容は";
$owl_lang->folder_count_url		= "URL";
$owl_lang->folder_policy 		= "フォルダに対する現在のポリシー:";
$owl_lang->held                      	= "保留"; 
$owl_lang->last_logged			= "最終	ログオン: ";
$owl_lang->menu_file_action		= "可能なファイルアクション";
$owl_lang->menu_folder_action		= "可能なフォルダアクション";
$owl_lang->menu_url_action		= "可能なURLアクション";
$owl_lang->modified 			= "修正日付";
$owl_lang->move_selected		= "選択したものを移動";
$owl_lang->new_file			= "新規";
$owl_lang->no_description		= "説明はありません";
$owl_lang->owner                        = "User";
$owl_lang->page				= "ページ:";
$owl_lang->panel_file_info		= "ファイル情報";
$owl_lang->postedby 			= "投稿者";
$owl_lang->reallydelete			= "本当に削除しますか";
$owl_lang->reallydelete_logs		= "ログファイルを本当にクリアしますか";
$owl_lang->reallydelete_selected	= "選択した全ファイルを本当に削除しますか";
$owl_lang->reallyrestore_selected	= "選択した全ファイルを本当に復元しますか";
$owl_lang->rest_selected		= "選択項目を回復";
$owl_lang->score 			= "スコア";
$owl_lang->size 			= "サイズ";
$owl_lang->updated_by 			= "更新者";
$owl_lang->title 			= "名前（タイトル）";
$owl_lang->tot_files			= "合計:";
$owl_lang->tot_monitored		= "監査済み:";
$owl_lang->tot_my_checked_out		= "チェックアウト中:";
$owl_lang->tot_my_files			= "自分:";
$owl_lang->tot_my_group			= "グループ:";
$owl_lang->tot_new_files		= "新規:";
$owl_lang->tot_updated_files		= "更新済み:";
$owl_lang->updated_file			= "更新済み!";
$owl_lang->user               		= "ユーザ";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "お好み";
$owl_lang->favorite_add = "追加";
$owl_lang->favorite_delete = "削除";
$owl_lang->favorite_go = "Go";
$owl_lang->files_in_my_group_title = "グループ内のファイル数";
$owl_lang->my_files_title= "私のファイル";
$owl_lang->my_monitored_title= "私の監視ファイル／フォルダ";
$owl_lang->my_special_access_title= "特別アクセスリスト";
$owl_lang->special_access_count_alt= "特別アクセス ファイル／フォルダ";
$owl_lang->special_access_count= "特別アクセス:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "注釈を追加／閲覧";
$owl_lang->addingfile 		= "ファイルを追加中 ";
$owl_lang->addingfolder 	= "フォルダを追加中 ";
$owl_lang->attach_file		= "添付ファイル";
$owl_lang->change		= "変更";
$owl_lang->comments      	= "注釈";
$owl_lang->comments_added       = "注釈記載者: ";
$owl_lang->create		= "作成";
$owl_lang->description 		= "説明";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ソング:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Duration:<br />Genre:<br />Comments:";
$owl_lang->email_body		= "メッセージ";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "返信先";
$owl_lang->email_subject	= "件名";
$owl_lang->email_to		= "メール宛先";
$owl_lang->emailing		= "メーリング";
$owl_lang->keywords 		= "キーワード";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "修正 ";
$owl_lang->name               	= "名前"; 
$owl_lang->none_selected        = "なにも選択されていません";
$owl_lang->note_content         = "本文の注釈";
$owl_lang->notify_link          = "DMS 外部リンク";
$owl_lang->ownergroup         	= "オーナ(グループ)";
$owl_lang->ownership		= "所有者";
$owl_lang->permissions 		= "許可";
$owl_lang->pick_select		= "&#8211; DMSユーザを選択 &#8211;";
$owl_lang->policy 		= "ポリシー";
$owl_lang->post_comment		= "コメントを投稿";
$owl_lang->prop_permissions 	= "サブフォルダへのパーミッションを継承しますか？";
$owl_lang->prop_perms_files 	= "ファイルにパーミッションの継承";
$owl_lang->sendfile 		= "ファイルを送信";
$owl_lang->sendthisfile 	= "このファイルを送信";
$owl_lang->sendthisurl       	= "このURLを送信";
$owl_lang->updating		= "更新";
$owl_lang->verdescription 	= "変更の<br />説明";
$owl_lang->vermajor          	= "メジャーバージョン";
$owl_lang->verminor          	= "マイナーバージョン";
$owl_lang->vertype           	= "バージョンタイプ";
$owl_lang->document_text        = "Content";
$owl_lang->save_keyword         = "キーワードを保存しますか?";
$owl_lang->archive_skip_file    = "スキップ: ";
$owl_lang->archive_skip_message = "以下のファイルは既に存在するため処理をスキップしました";
$owl_lang->archive_extract_current  = "現在のフォルダを展開しますか?";
$owl_lang->archive_extract_overwrite  = "存在するファイルを上書(更新)しますか?";
$owl_lang->optional_file_index  = "Index file?:";  

$owl_lang->progressbar_upload_start  = "Upload Starting...";
$owl_lang->progressbar_uploading     = "Uploading";
$owl_lang->progressbar_upload_cancel = "Canceling Upload...";
$owl_lang->progressbar_post_upload   = "Post Upload Processing...";
$owl_lang->error_select_file         = "Please Select a File For Upload";

//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "E-Mail アドレス";
$owl_lang->full_name		= "フルネーム";
$owl_lang->register		= "ユーザ登録";
$owl_lang->self_failed		= "失敗した";
$owl_lang->self_passwd		= "パスワード送信先:";
$owl_lang->self_reg_bod		= "あなたのDMS パスワードは:";
$owl_lang->self_reg_rset	= "あなたのDMS パスワードはリセットされました:";
$owl_lang->self_reg_subj	= "あなたのOWL アカウント";
$owl_lang->send_pass		= "パスワードを送信";
$owl_lang->submit		= "登録";
$owl_lang->thank_you_1		= "ありがとうございます!";
$owl_lang->thank_you_2		= "あなたのパスワードはメールアドレスへ送信されます";
$owl_lang->thank_you_3		= "ログインするにはあなたのアカウントが管理者に許可される必要があります。";

//NEW STUFF

$owl_lang->captcha_typein        = "5文字入力してください";
$owl_lang->change_pass_title	      = "パスワードの変更";
$owl_lang->err_cant_reuse_passwords   = "前のパスワードは使えません";
$owl_lang->err_new_confirm_different  = "パスワードと確認が一致しません <br />";
$owl_lang->err_old_pass_ver_failed    = "あなたの古いパスワードが間違っています <br />";
$owl_lang->err_pass_restriction_1     = "パスワードには &ldquo;%s&rdquo; 文字以上必要です <br />";
$owl_lang->err_pass_restriction_2     = "最低 &ldquo;%s&rdquo; の数字 [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "と最低 &ldquo;%s&rdquo; の特殊文字 [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]を含まなければなりません<br />";
$owl_lang->err_username_not_long_enough = "あなたのユーザ名は &ldquo;%s&rdquo;  %d 文字数で、最低 %d 文字数でなければなりません。";
$owl_lang->pass_change_email_1        = "Your Password was not Reset as you are not using DMS Authentication";
$owl_lang->pass_change_email_2        = "あなたの認証タイプは: ";
$owl_lang->pass_change_email_3        = "ヘルプが必要なときはシステム管理者へご連絡ください。";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "キャンセル";
$owl_lang->copy_file		= "ファイル複写中";
$owl_lang->copy_folder		= "フォルダ複写中";
$owl_lang->moving		= "移動中";
$owl_lang->moving_file		= "ファイル移動中";
$owl_lang->moving_folder	= "フォルダ移動中";
$owl_lang->select		= "新しいフォルダを選んでください:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "ログを閲覧 ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "からの差異";
$owl_lang->diff_to	= "対する差異";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "注釈を通知";
$owl_lang->confpassword	= "新しいパスワードの再入力";
$owl_lang->email_tool	= "E-Mail Tool";
$owl_lang->group	= "プライマリグループ";
$owl_lang->groupmember	= "メンバーグループ";
$owl_lang->last_modified= "最終更新";
$owl_lang->newpassword	= "新しいパスワード";
$owl_lang->newsadmin	= "ニュース管理者";
$owl_lang->not_member	= "あなたは他のグループメンバーでありません";
$owl_lang->notification	= "通知を受ける";
$owl_lang->oldpassword	= "古いパスワード";
$owl_lang->preference	= "お好み";
$owl_lang->saved	= "&#8212; 変更を &nbsp;&nbsp;&nbsp;保存しました &#8212;";
$owl_lang->status_no	= "いいえ";
$owl_lang->status_yes	= "はい";
$owl_lang->userlang	= "言語";

//NEW STUFF
$owl_lang->useradmin	= "ユーザ管理者";
$owl_lang->viewlogs     = "システムログ閲覧可能";
$owl_lang->viewreports  = "システム報告閲覧可能";
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

$owl_lang->elapsed_time       	= "経過時間";
$owl_lang->query_empty       	= "検索文字列が空";
$owl_lang->related_query_empty  = "資料に関連付けられた実行するメタデータ &ldquo;Search Related&rdquo;";
$owl_lang->search             	= "検索";
$owl_lang->search_all_word	= "All Words";
$owl_lang->search_any_word	= "Any Words";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "フォルダを検索";
$owl_lang->search_entire_phrase	= "全語句";
$owl_lang->search_for_files 	= "ファイルを検索";
$owl_lang->search_for_folders 	= "フォルダを検索";
$owl_lang->search_match 	= "マッチ:";
$owl_lang->search_results_for	= "検索結果";
$owl_lang->search_score 	= "ファイルのスコアリング";
$owl_lang->search_winthindocs   = "ここを検索";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "閲覧する ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "広いファイル情報パネルを表示";
$owl_lang->allow_track_favorite         = "ユーザにお好みの履歴を許可する";
$owl_lang->admin_login_to_browse_page	= "Admin goes to Browse Page on Logon";
$owl_lang->alt_btn_backup		= "バックアップ SQL データベース";
$owl_lang->alt_btn_doctype_admin	= "ドキュメントタイプ管理者";
$owl_lang->alt_btn_html_prefs		= "サイトHTML お好みの編集";
$owl_lang->alt_btn_news_admin		= "DMS ニュース管理者";
$owl_lang->alt_btn_site_features	= "サイト機能と設定を編集";
$owl_lang->alt_btn_statistics_viewer	= "DMS 統計ビュワー";
$owl_lang->alt_btn_users_groups		= "ユーザとグループの管理";
$owl_lang->btn_backup			= "バックアップ<br />データベース";
$owl_lang->btn_doctype_admin		= "ドキュメント<br />タイプ";
$owl_lang->btn_html_prefs		= "HTML<br />お好み";
$owl_lang->btn_news_admin		= "ニュース<br />管理";
$owl_lang->btn_site_features		= "サイト<br />機能";
$owl_lang->btn_statistics_viewer	= "統計 / 報告 <br />ビュワー";
$owl_lang->btn_users_groups		= "ユーザ &amp;<br />グループ";
$owl_lang->display_password_override	= "ファイル／フォルダ　パスワード上書きを表示";
$owl_lang->doc_id_num_digits		= "表示する資料番号の桁数";
$owl_lang->doc_id_prefix		= "資料番号表示のプレフィックス文字"; 
$owl_lang->docicon_column		= "資料アイコン";
$owl_lang->download_folder_zip		= "ZIPフォルダでダウンロード (省略時は tar.gz)";
$owl_lang->save_keywords_to_db		= "キーワードの再利用を許可する";
$owl_lang->status_column		= "状態";
$owl_lang->vermajor_initial          	= "初期大改訂番号";
$owl_lang->verminor_initial          	= "初期小改訂番号";
$owl_lang->view_doc_in_new_window	= "新しいウィンドウで資料を閲覧";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** ユーザ編集 *****";
$owl_lang->edit_group  			= "***** グループ編集 *****";
$owl_lang->enter_new_user               = "***** 新しいユーザ追加 *****";
$owl_lang->enter_new_group              = "***** 新しいグループ追加 *****";
$owl_lang->alt_btn_change_passwd        = "旧パスワードを変更";
$owl_lang->alt_btn_cln_history          = "Purge Documents that are older (days) than: ";
$owl_lang->alt_btn_log_viewer           = "DMS システムログビュワー";
$owl_lang->alt_btn_report_viewer        = "DMS Reports Viewer";
$owl_lang->btn_change_passwd            = "パスワード変更";
$owl_lang->btn_cln_history              = "古い文書を消去";
$owl_lang->btn_log_viewer               = "システムログ";
$owl_lang->btn_report_viewer            = "報告";
$owl_lang->confirm_cln_history          = "（何日か以上）古い資料の一掃を本当にしますか : ";
$owl_lang->historical_purge             = "履歴ファイルが削除されました";

// END NEW STUFF
$owl_lang->add				= "追加";
$owl_lang->alt_btn_initial_load		= "資料フォルダからDBをロード";
$owl_lang->alt_btn_trashcan		= "内容を閲覧にはここをクリックしてください";
$owl_lang->anonymous_account		= "匿名アクセスアカウント:";
$owl_lang->btn_initial_load		= "初期ロード";
$owl_lang->btn_trashcan			= "ゴミ箱";
$owl_lang->buttonstyle                  = "ボタンのスタイル";
$owl_lang->confirm_initial_load		= "*** 警告 ***  これはデータベースが空のとき一度だけ実行できます";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "グループを削除";
$owl_lang->deleteuser			= "ユーザを削除";
$owl_lang->disable_recs_per_page	= "Enabling Restricted View Will DISABLE Records Per Page!";
$owl_lang->disableuser			= "ユーザを使用禁止";
$owl_lang->file_admin_group		= "File/Browser Admin Group:";
$owl_lang->flushed           		= "セッションテーブルがフラッシュしました、ユーザはいまから再度ログインできます。";
$owl_lang->groups			= "グループ";
$owl_lang->hide_bulk_buttons		= "一括ボタンを隠す:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "本文背景画像パス:";
$owl_lang->ht_bd_lnk_cl			= "本文のリンク色:";
$owl_lang->ht_bd_txt_cl 		= "本文の色:";
$owl_lang->ht_bd_vlnk_cl 		= "訪問済み本文リンク色:";
$owl_lang->ht_collapse_width 		= "縮小表示の幅:";
$owl_lang->ht_expand_width		= "拡張表示の幅:";
$owl_lang->ht_tbl_border_sz 		= "表の境界サイズ:";
$owl_lang->ht_tbl_cell_bg_al 		= "代替表セルの背景色:";
$owl_lang->ht_tbl_cell_bg_cl 		= "表セルの背景色:";
$owl_lang->ht_tbl_hd_bg			= "ヘッダーの背景:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "匿名アクセスの設定";
$owl_lang->header_group_admin           = "グループ管理";
$owl_lang->header_sitefeatures_settings           = "サイト機能と設定";
$owl_lang->header_user_admin           	= "ユーザ管理";
$owl_lang->hide_folder_doc_count	= "フォルダ、ファイルタイプ数を隠す";
$owl_lang->hide_folder_size		= "フォルダ内容の大きさを隠す";
$owl_lang->hide_panel			= "隠す";
$owl_lang->home_dir			= "ユーザのホームディレクトリ";
$owl_lang->initial_dir   		= "ユーザの初期ディレクトリ";
$owl_lang->maxsessions			= "最大セッション数";
$owl_lang->noprefaccess			= "お好みを使用不可";
$owl_lang->old_action_icons		= "Use pre DMS 0.80 Action Icons";
$owl_lang->owl_anon_download     	= "ダウンロードのみ";
$owl_lang->owl_anon_full		= "フルアクセス";
$owl_lang->owl_anon_ro			= "リードオンリー";
$owl_lang->owl_dbdump_path   		= "DB ダンプツールパス:";
$owl_lang->owl_def_file_group_owner	= "省略時ファイルのグループオーナ:";
$owl_lang->owl_def_file_meta		= "省略時ファイルのメタデータ:";
$owl_lang->owl_def_file_owner		= "省略時ファイルの所有者:";
$owl_lang->owl_def_file_perm 		= "省略時ファイルの作成ポリシー:";
$owl_lang->owl_def_file_security	= "省略時ファイルのセキュリティ:";
$owl_lang->owl_def_file_title		= "省略時ファイルのタイトル （省略時はファイル名）:";
$owl_lang->owl_def_fold_group_owner	= "省略時のフォルダグループオーナ:";
$owl_lang->owl_def_fold_owner		= "省略時のフォルダオーナ:";
$owl_lang->owl_def_fold_sec		= "省略時のフォルダ セキュリティ:";
$owl_lang->owl_def_folder_perm 		= "省略時のフォルダ作成ポリシー:";
$owl_lang->owl_default_tmpdir		= "一時ファイルディレクトリ（Temp）の場所: ";
$owl_lang->owl_email_from		= "送信者アドレス:";
$owl_lang->owl_email_fromname		= "送信者:";
$owl_lang->owl_email_replyto		= "返信先:";
$owl_lang->owl_email_server		= "SMTP サーバ:";
$owl_lang->owl_email_smtp		= "SMTP メールを使用";
$owl_lang->owl_email_smtp_auth		= "SMTP 認証を使用";
$owl_lang->owl_email_smtp_auth_login	= "SMTP 認証ログイン:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP 認証パスワード";
$owl_lang->owl_email_subject_pref	= "件名プレフィックス:";
$owl_lang->owl_fogotpass		= "忘れたパスワードリンクを表示:";
$owl_lang->owl_group_user		= "このグループのユーザ";
$owl_lang->owl_gzip_path     		= "gzip パス:";
$owl_lang->owl_hidebackup		= "バックアップディレクトリを隠す:";
$owl_lang->owl_log_file			= "ファイル活動のログ:";
$owl_lang->owl_log_login_act		= "ログイン／ログアウト活動:";
$owl_lang->owl_log_rec_page		= "１ページ当りのログビュワーレコード数:";
$owl_lang->owl_logging			= "ロギングを可能にする:";
$owl_lang->owl_logo			= "ログインページのロゴ ([言語]/画像):";
$owl_lang->owl_lookAtHD			= "Disable Look at hd:";
$owl_lang->owl_lookAtHDDel		= "削除したファイルをDBから消去";
$owl_lang->owl_max_filesize		= "アップロード最大ファイルサイズ（バイト）";
$owl_lang->owl_owl_expand		= "省略時のブラウザービュー（拡張）";
$owl_lang->owl_owl_timeout		= "セッションタイムアウトの秒数";
$owl_lang->owl_pdftotext_path		= "PDFとテキストファイルの検索インデックスの維持<br />&#8211; 空白は使用しない:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 以上が必要です<br />pod2htmlへのパス:";
$owl_lang->owl_restrict_view		= "制限つきビュー機能を可能にする:";
$owl_lang->owl_self_reg			= "自己登録を可能にする:";
$owl_lang->owl_self_reg_hd		= "自己登録のユーザ省略時設定";
$owl_lang->owl_tar_path     		= "tar パス:";
$owl_lang->owl_title_browser		= "OWL ブラウザー機能";
$owl_lang->owl_title_custom		= "ブラウザーカラムのカスタマイズ";
$owl_lang->owl_title_custom_search      = "検索結果のカスタマイズ";
$owl_lang->owl_title_defaults   	= "省略値";
$owl_lang->owl_title_email		= "OWL システムメール設定";
$owl_lang->owl_title_HD			= "LOOK AT HD FOR NEW FILES SETTINGS";
$owl_lang->owl_title_logging  		= "ロギング設定";
$owl_lang->owl_title_other		= "その他の設定";
$owl_lang->owl_title_tools   		= "DB バックアップ／GZIP ツール";
$owl_lang->owl_unzip_path     		= "unzipパス:";
$owl_lang->owl_version_control		= "版管理機能を使用:";
$owl_lang->owl_wordtotext_path          = "MS-WORD ファイル <br />&#8211; 空白のばあいは使用不可:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPOINT ファイル <br />&#8211; 空白のばあいは使用不可:";
$owl_lang->quota			= "クォータ 0=使用しない";
$owl_lang->reallydeluser		= "このユーザは、 %numfiles% ファイル 、 %numfolders% フォルダの所有者です。これらのファイルとフォルダは行方不明になるでしょう。それでも削除しますか？";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "ページ当りの表示レコード数（ = 使用しない）:";
$owl_lang->recycle_enabled		= "ごみ収集を可能にする:";
$owl_lang->recycle_location		= "ごみ箱の場所:";
$owl_lang->recycle_title		= "ごみ収集設定";
$owl_lang->remember_me			= "Show the Remember Me link";
$owl_lang->remember_me_checkbox		= "私を覚えて";
$owl_lang->remember_me_title		= "継続ログイン設定";
$owl_lang->remember_timeout		= "クッキーのタイムアウト（日数）";
$owl_lang->restore_file_prefix		= "String Prefixed to Restored Files";
$owl_lang->search_result_folders	= "検索結果にフォルダを含める";
$owl_lang->show_action_title		= "アクションボタンを表示:";
$owl_lang->show_bulk_title		= "一括ボタンを表示:";
$owl_lang->show_folder_title		= "フォルダツールを表示:";
$owl_lang->show_panel			= "見せる";
$owl_lang->show_panel_title		= "状況パネルを表示:";
$owl_lang->show_pref_title		= "お好み／ログアウトバーを表示:";
$owl_lang->show_search_title		= "検索バーを表示:";
$owl_lang->status_bar_both              = "トップとボトム";
$owl_lang->status_bar_bottom            = "ボトムだけ";
$owl_lang->status_bar_location          = "状態バーを次の場所に表示:";
$owl_lang->status_bar_not               = "表示しない";
$owl_lang->status_bar_top               = "トップだけ";
$owl_lang->use_popup			= "ニュースを閲覧のにポップアップを使う:";
$owl_lang->users           		= "ユーザ";
$owl_lang->virus_path			= "ウィルスチェックソフトウェアパス<br />Example: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Blank for Disabled:";

// NEW STUF BEGIN
$owl_lang->cust_popup                                   = "ポップアップ説明の中のカスタム項目";
$owl_lang->cust_headpopup     = "特別資料項目";
$owl_lang->auth_http                        = "HTTP 認証 (.htaccess)";
$owl_lang->auth_ldap                        = "LDAP 認証";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "このグループをプライマリグループとするユーザ";
$owl_lang->create_user_homedir 		= "ユーザのホームフォルダを作成:";
$owl_lang->use_captcha 			= "CAPTCHA認証を使用する:";
$owl_lang->created_here 		= "<br /> (CREATED HERE IF create homedir checked)";
$owl_lang->auth_owl                         = "DMS 認証";
$owl_lang->auth_pop3                        = "pop3 認証";
$owl_lang->file_desc_required           = "ファイル説明が必要";
$owl_lang->folder_desc_required         = "フォルダの説明が必要です";
$owl_lang->html_title		= "HTML お好み";
$owl_lang->pass_account_lockout      	    = "ロックアウトするまでの試行回数:";
$owl_lang->pass_change_every                = "パスワードを強制変更させる（日数）0=使用しない:";
$owl_lang->pass_enable_account_lockout      = "アカウントロックアウトを可能にする:";
$owl_lang->pass_min_passwd_length           = "ユーザパスワードの最小文字数:";
$owl_lang->pass_min_passwd_numeric          = "数字の最少文字数:";
$owl_lang->pass_min_passwd_special          = "特殊文字の最少文字数:";
$owl_lang->pass_min_username_length         = "ユーザ名の最少文字数:";
$owl_lang->pass_track_old_passwords   	    = "保持する以前のパスワード数:";
$owl_lang->rtftotext_path                = "RTF から Text ツールパス";
$owl_lang->show_user_info           = "表示ユーザ名はクリックできる";
$owl_lang->user_admin              = "ユーザ／グループ管理者";
$owl_lang->user_auth_type                   = "認証タイプ:";
$owl_lang->user_change_pass_next_login      = "次回ログイン時パスワードを変更:";
$owl_lang->user_expires                     = "アカウントの有効:";
$owl_lang->user_gmt_offset              = "ユーザ GMT オフセット";
$owl_lang->user_group_admin                 = "メイングループのファイル管理者:";
$owl_lang->user_login_to_newrecords         = "Login to New Records Page:";
$owl_lang->users_group_admin		= "グループ管理者のユーザ";
$owl_lang->time_offsets[0][0] = "-12";
$owl_lang->time_offsets[0][1] = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0] = "-11";
$owl_lang->time_offsets[1][1] = "(GMT-11:00) ミッドウェー島, サモワ";
$owl_lang->time_offsets[2][0] = "-10";
$owl_lang->time_offsets[2][1] = "(GMT-10:00) ハワイ";
$owl_lang->time_offsets[3][0] = "-9";
$owl_lang->time_offsets[3][1] = "(GMT-9:00) アラスカ";
$owl_lang->time_offsets[4][0] = "-8";
$owl_lang->time_offsets[4][1] = "(GMT-8:00) 太平洋時間 (US &amp; カナダ)";
$owl_lang->time_offsets[5][0] = "-7";
$owl_lang->time_offsets[5][1] = "(GMT-7:00) 山岳時間 (US &amp; カナダ)";
$owl_lang->time_offsets[6][0] = "-6";
$owl_lang->time_offsets[6][1] = "(GMT-6:00) 中央時間 (US &amp; カナダ), メキシコシティ";
$owl_lang->time_offsets[7][0] = "-5";
$owl_lang->time_offsets[7][1] = "(GMT-5:00) 東部時間 (US &amp; カナダ), ボゴタ, リマ, Quito";
$owl_lang->time_offsets[8][0] = "-4";
$owl_lang->time_offsets[8][1] = "(GMT-4:00) 大西洋時間 (カナダ), カラカス, La Paz";
$owl_lang->time_offsets[9][0] = "-3.5";
$owl_lang->time_offsets[9][1] = "(GMT-3:30) ニューファンドランド島";
$owl_lang->time_offsets[10][0] = "-3";
$owl_lang->time_offsets[10][1] = "(GMT-3:00) ブラジル, ブエノスアイレス, ジョージタウン";
$owl_lang->time_offsets[11][0] = "-2";
$owl_lang->time_offsets[11][1] = "(GMT-2:00) 大西洋中心";
$owl_lang->time_offsets[12][0] = "-1";
$owl_lang->time_offsets[12][1] = "(GMT-1:00) Azores, Cape Verde Islands";
$owl_lang->time_offsets[13][0] = "0";
$owl_lang->time_offsets[13][1] = "(GMT) 西ヨーロッパ時間, ロンドン, リスボン, カサブランカ, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) 中央ヨーロッパ時間, ブリュッセル, コペンハーゲン, マドリード, パリ";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) 東ヨーロッパ時間, カリンニグラード, 南アフリカ";
$owl_lang->time_offsets[16][0] = "3";
$owl_lang->time_offsets[16][1] = "(GMT+3:00) バグダッド, クウェート, リヤド, モスクワ, サンクトペテルブルグ, Volgograd, ナイロビ";
$owl_lang->time_offsets[17][0] = "3.5";
$owl_lang->time_offsets[17][1] = "(GMT+3:30) テヘラン";
$owl_lang->time_offsets[18][0] = "4";
$owl_lang->time_offsets[18][1] = "(GMT+4:00) アブダビ, マスカット, バクー, トビリシ";
$owl_lang->time_offsets[19][0] = "4.5";
$owl_lang->time_offsets[19][1] = "(GMT+4:30) カブール";
$owl_lang->time_offsets[20][0] = "5";
$owl_lang->time_offsets[20][1] = "(GMT+5:00) エカテリンブルグ, イスラマバード, カラチ, タシケント";
$owl_lang->time_offsets[21][0] = "5.5";
$owl_lang->time_offsets[21][1] = "(GMT+5:30) ムンバイ, カルカッタ, マドラス, ニューデリー";
$owl_lang->time_offsets[22][0] = "6";
$owl_lang->time_offsets[22][1] = "(GMT+6:00) Almaty, ダッカ, コロンボ";
$owl_lang->time_offsets[23][0] = "7";
$owl_lang->time_offsets[23][1] = "(GMT+7:00) バンコク, ハノイ, ジャカルタ";
$owl_lang->time_offsets[24][0] = "8";
$owl_lang->time_offsets[24][1] = "(GMT+8:00) 北京, パース, シンガポール, 香港, 重慶, ウルムチ, 台北";
$owl_lang->time_offsets[25][0] = "9";
$owl_lang->time_offsets[25][1] = "(GMT+9:00) 東京、韓国、大阪、札幌、ヤクーツク";
$owl_lang->time_offsets[26][0] = "9.5";
$owl_lang->time_offsets[26][1] = "(GMT+9:30) アデレード, ダーウィン";
$owl_lang->time_offsets[27][0] = "10";
$owl_lang->time_offsets[27][1] = "(GMT+10:00) 東オーストラリア標準時, グアム, パプアニューギニア, Vladivostok";
$owl_lang->time_offsets[28][0] = "11";
$owl_lang->time_offsets[28][1] = "(GMT+11:00) Magadan, ソロモン諸島, ニューカレドニア";
$owl_lang->time_offsets[29][0] = "12";
$owl_lang->time_offsets[29][1] = "(GMT+12:00) オークランド, ウェリントン, フィジー, カムチャツカ半島, マーシャル諸島";

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	= "フィルター";
$owl_lang->owl_log_hd_action	= "アクション";
$owl_lang->owl_log_hd_agent	= "Agent";
$owl_lang->owl_log_hd_dt_tm	= "日付時刻";
$owl_lang->owl_log_hd_dtls	= "詳細";
$owl_lang->owl_log_hd_file	= "ファイル";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "フォルダパス";
$owl_lang->owl_log_hd_ip	= "IP / アドレス";
$owl_lang->owl_log_hd_user	= "ユーザ";
$owl_lang->owl_log_hide      	= "隠す: ";
$owl_lang->owl_log_no_rec	= " レコードが見つかりませんでした ";
$owl_lang->owl_log_viewer	= "ログビュワー";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "ごみ箱を空に";
$owl_lang->really_empty_trash	= "ごみ箱を本当に空にしますか？";
$owl_lang->recycle_bin_admin    = "ごみ箱管理";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "The files you requested area attached.";
$owl_lang->trash_email_subject  = "あなたが要求し復元したファイル";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "なにもしない &#8211; ファイル許可をそのままに";
$owl_lang->everyoneread			= "誰でも読み／ダウンロードできる(744)";
$owl_lang->everyoneread_ad		= "誰でも読み／ダウンロードできる(744)";
$owl_lang->everyonewrite		= "誰でも読み／書き／ダウンロードできる(777)";
$owl_lang->everyonewrite_ad		= "誰でも読み／書き／ダウンロードできる(777)";
$owl_lang->everyonewrite_ad_nod		= "誰でも読み／書き／ダウンロードできる, 削除は不可(766)";
$owl_lang->everyonewrite_nod		= "誰でも読み／書き／ダウンロードできる, 削除は不可(766)";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "誰でもこのフォルダを見れる(744)";
$owl_lang->geveryoneread_ad		= "誰でもこのフォルダを見れる(744)";
$owl_lang->geveryonewrite		= "誰でもこのフォルダにファイルをアップロードでき、フォルダを削除できる(777)";
$owl_lang->geveryonewrite_ad		= "誰でもこのフォルダにファイルをアップロードでき、フォルダを削除できる(777)";
$owl_lang->geveryonewrite_ad_nod	= "誰でもこのフォルダにファイルをアップロードできる(766)";
$owl_lang->geveryonewrite_nod		= "誰でもこのフォルダにファイルをアップロードできる(766)";
$owl_lang->ggroupread			= "あなたのグループはこのフォルダを読むことができる(740)";
$owl_lang->ggroupread_ad		= "選択されたグループはこのフォルダを読むことができる(740)";
$owl_lang->ggroupwrite			= "あなたのグループは、ファイルをアップロードし、かつフォルダの削除できる(770)";
$owl_lang->ggroupwrite_ad    		= "選択されたグループは、ファイルをアップロードし、かつフォルダの削除できる(770)";
$owl_lang->ggroupwrite_ad_nod		= "選択されたグループは、このフォルダにファイルをアップロードできる(760)";
$owl_lang->ggroupwrite_nod		= "あなたのグループは、このフォルダにファイルをアップロードできる(760)";
$owl_lang->ggroupwrite_worldread 	= "あなたのグループは、ファイルをアップロードしフォルダを削除できる &amp; その他の人は内容を閲覧できる(774)";
$owl_lang->ggroupwrite_worldread_ad 	= "選択されたグループは、ファイルをアップロードしフォルダを削除できる &amp; その他の人は内容を閲覧できる(774)";
$owl_lang->ggroupwrite_worldread_ad_nod	= "選択されたグループは、このフォルダにファイルをアップロードできる &amp; その他の人は内容を閲覧できる(764)";
$owl_lang->ggroupwrite_worldread_nod 	= "あなたのグループは、このフォルダにファイルをアップロードできる &amp; その他の人は内容を閲覧できる(764)";
$owl_lang->gonlyyou			= "あなただけがファイルをアップロードできかつフォルダを削除できる(700)";
$owl_lang->gonlyyou_ad			= "あなただけがファイルをアップロードできかつフォルダを削除できる(700)";
$owl_lang->groupread			= "あなたのグループは読み／ダウンロードできる(740)";
$owl_lang->groupread_ad			= "選択されたグループは読み／ダウンロードできる(740)";
$owl_lang->groupwrite			= "あなたのグループは読み／書き／ダウンロードできる(770)";
$owl_lang->groupwrite_ad		= "選択されたグループは読み／書き／ダウンロードできる(770)";
$owl_lang->groupwrite_ad_nod		= "選択されたグループは読み／書き／ダウンロードできる, 削除不可(760)";
$owl_lang->groupwrite_nod		= "あなたのグループは読み／書き／ダウンロードできる, 削除不可(760)";
$owl_lang->groupwrite_worldread 	= "選択されたグループは読み／書き／ダウンロードできる &amp; その他の人は読める(774)";
$owl_lang->groupwrite_worldread_ad 	= "選択されたグループは読み／書き／ダウンロードできる &amp; その他の人は読める(774)";
$owl_lang->groupwrite_worldread_ad_nod 	= "選択されたグループは読み／書き／ダウンロードできる (削除不可) &amp; その他の人は読める(764)";
$owl_lang->groupwrite_worldread_nod 	= "あなたのグループは読み／書き／ダウンロードできる（削除不可） &amp; その他の人は読める(764)";
$owl_lang->invalidsess			= "不適切なセッションID、メインページがログインしてください<br />";
$owl_lang->notif_comment_1		= "注釈日時";
$owl_lang->notif_comment_2		= "注釈:";
$owl_lang->notif_msg         		= "OWL イントラネットからの自動メッセージです<br /><br />このメールに添付された新規／更新ファイルを見てください<br /><br />";
$owl_lang->notif_msg_alt         	= "OWL イントラネットからの自動メッセージです\n\nこのメールに添付された新規／更新ファイルを見てください\n\n";
$owl_lang->notif_msg_alt_link           = "OWL イントラネットからの自動メッセージです\n\nこのメールの新規／更新ファイルへのリンクを見てください\n\n";
$owl_lang->notif_msg_link               = "OWL イントラネットからの自動メッセージです<br /><br />このメールの新規／更新ファイルへのリンクを見てください<br /><br />";
$owl_lang->notif_salutation		= "Dear";
$owl_lang->notif_subject_comment	= "OWL イントラネット　ファイル -- コメントか追加されました";
$owl_lang->notif_subject_monitor	= "OWL イントラネット　監視中のファイルまたはフォルダが更新されました";
$owl_lang->notif_subject_new 		= "新規WL イントラネット　ファイル";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "OWL イントラネット　ファイルが更新されました";
$owl_lang->notif_subject_file_deleted   = "リポジトリからファイルを削除しました";
$owl_lang->notif_subj_new_account       = "新しいアカウントを作成しました";
$owl_lang->notif_user			= "作成／更新者:";
$owl_lang->onlyyou			= "あなただけが読み／ダウンロード／書き　できます(700)";
$owl_lang->onlyyou_ad			= "あなただけが読み／ダウンロード／書き　できます(700)";
$owl_lang->orphaned			= "&#8211; 所有者なし  &#8211;";
$owl_lang->owl_path			= "ファイルパス: ";
$owl_lang->sessinuse			= "このセッションは他のコンピュータで使用中です、アクセスが拒否されました<br />";
$owl_lang->sesstimeout			= "あなたのセッションはタイムアウトしました、再度ログインしてください<br />";
$owl_lang->virus_infected 		= "ウィルスに感染したファイル";
$owl_lang->virus_return_val		= "ウィルスプログラムからの戻り値:";
$owl_lang->watermark_string		= "機密";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "このフォルダを閲覧";
$owl_lang->title_browse_site     	= "このURLを閲覧";
$owl_lang->title_download_view     	= "このファイルをダウンロード／閲覧";
$owl_lang->title_edit_prefs     	= "ユーザお好みをみる／編集";
$owl_lang->title_return_folder     	= "戻る";
$owl_lang->title_sort     		= "並び順";
$owl_lang->title_view_my     		= "私のファイル一覧を閲覧";
$owl_lang->title_view_new     		= "最終訪問後の新規ファイル一覧を閲覧";
$owl_lang->title_view_updated     	= "最終訪問後の更新ファイル一覧を閲覧";
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

$owl_lang->news_content			= "内容";
$owl_lang->news_hd			= "ニュース";
$owl_lang->news_hd_audience		= "対象者";
$owl_lang->news_hd_created		= "作成日";
$owl_lang->news_hd_expires		= "期限";
$owl_lang->news_heading			= "ニュース見出し";
$owl_lang->news_posted_date		= "投稿ニュース:";
$owl_lang->news_read			= "既読";
$owl_lang->news_title			= "ニュース管理者";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: The OWL Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." does not exists.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: The OWL Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." is not writeable by the Web Server.";
$owl_lang->debug_file_not_exist		= "DEBUG: The required file &ldquo;$default->owl_fs_root/%s &rdquo; does not exists.<br /> OR<br />The path specified by \$default->owl_fs_root in config/owl.php is wrong.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: The OWL temporary Directory: %s does not exists.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: The OWL temporary Directory: %s is not writeable by the Web Server.";
$owl_lang->debug_webserver_no_access	= "DEBUG: The webserver does not have read access to: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Please fix the permissions and try again";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "統計 / 報告 ビュワー";
$owl_lang->stats_files		= "ユーザ当りファイル数";
$owl_lang->stats_folders	= "ユーザ当りフォルダ";
$owl_lang->stats_information	= "この統計を表示するにはDMSロギングとファイルロギングがオンでなければなりません";
$owl_lang->stats_top		= "トップ 20 ダウンロード";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "ユーザサインオン (ログイン / 失敗 / ログアウト)";
$owl_lang->stats_users_loggedin = "現在のログイン";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "ドキュメントタイプ管理";
$owl_lang->doc_field_label	= "項目ラベル（地域ごと）";
$owl_lang->doc_field_name	= "項目名";
$owl_lang->doc_field_pos	= "項目位置";
$owl_lang->doc_field_required	= "必須?";
$owl_lang->doc_field_searchable	= "検索可能？";
$owl_lang->doc_field_size	= "項目サイズ";
$owl_lang->doc_new_doc_type	= "&#8211; 新しい資料タイプを追加 &#8211;";
$owl_lang->doc_specific		= "資料特別項目:";
$owl_lang->document_type	= "資料タイプ";
$owl_lang->document_type_name	= "資料タイプ名";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "ポップアップ説明に挿入しますか？";
$owl_lang->doc_field_disp_label = "項目ラベル:";
$owl_lang->doc_field_disp_sep = "セパレータラベル";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "ブラウザーを表示:";
$owl_lang->doc_field_show_in_list = "ブラウザービューでの項目を表示:";
$owl_lang->doc_field_type	= "項目タイプ:";
$owl_lang->doc_field_values	= " | 区切られた項目値:";
$owl_lang->doc_fields = "カスタム項目";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "グループ:";
$owl_lang->header_csv_import    = "CSV ユーザファイルをインポート";
$owl_lang->import_inserted      = "挿入されました";
$owl_lang->import_skipped       = "スキップされました";
$owl_lang->invalid_groupid      = "不適切なグループid --> ";
$owl_lang->msg_user_exists      = "ユーザはすでに存在します";
$owl_lang->sendcsvfile          = " , で区切られたファイルをアップロード";
$owl_lang->user_created_skipped = "ユーザ:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "ピアレビュー機能を可能にする:";
$owl_lang->owl_peer_review_opt  = "Make Peer Review Optional:";
$owl_lang->owl_title_peer_review= "資料ピアレビュー機能";
$owl_lang->owl_title_peer_review2= "資料ピアレビュー";
$owl_lang->peer_approval_title 	= "私の承認を待っている資料";
$owl_lang->peer_approved_body	= "あなたのファイルは承認されました:";
$owl_lang->peer_file_approved	= "承認済みファイル:";
$owl_lang->peer_file_final	= "最終承認:";
$owl_lang->peer_file_rejected	= "拒否されたファイル:";
$owl_lang->peer_file_to_review	= "レビューするファイル:";
$owl_lang->peer_final_approval	= "[最終承認]: ";
$owl_lang->peer_final_body	= "あなたの資料はレビュワー全員から承認されました。<br />ログインして資料を公開してください<br />";
$owl_lang->peer_msg_to_reviewer	= "れビュワーへのメッセージ";
$owl_lang->peer_my_approval	= "私の承認待ち";
$owl_lang->peer_notif_user	= "作成／更新者";
$owl_lang->peer_pending_approval= "私の承認中";
$owl_lang->peer_pending_title 	= "承認中の私の資料";
$owl_lang->peer_reject_reason   = "拒否理由";
$owl_lang->peer_rejected_body	= "あなたの資料は拒否されました:";
$owl_lang->peer_review_body	= "次の資料についてあなたの承認が求められています:";
$owl_lang->peer_reviewer_list	= "レビュワー";
$owl_lang->peer_satus	 	= "状態";
$owl_lang->peer_satus_approved  = "&#8212; 承認 &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; 審理中 &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; 拒否 &#8212;";
$owl_lang->peer_subj_approved	= "あなたの資料は承認されました";
$owl_lang->peer_subj_rejected	= "あなたの資料は拒否されました";
$owl_lang->peer_subj_reminder	= "注意: レビューすべきOWL ファイルがあります";
$owl_lang->peer_subj_review	= "あなたはレビューすべきOWL ファイルがあります";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "あなたの資料はレビュワー全員から承認されました。<br />あなたのファイルは公開されました。<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "ファイルACLを追加:";
$owl_lang->acl_adding_folder           = "フォルダACLを追加:";
$owl_lang->acl_available_groups        = "選択可能なグループ";
$owl_lang->acl_available_users         = "選択可能なユーザ";
$owl_lang->acl_edit_file               = "ファイルACLを編集:";
$owl_lang->acl_edit_folder             = "フォルダACLを編集:";
$owl_lang->acl_file_checkin            = "チェックイン／アウト";
$owl_lang->acl_file_comment            = "コメント";
$owl_lang->acl_file_copy               = "複写";
$owl_lang->acl_file_delete             = "削除";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_modify             = "プロパティ";
$owl_lang->acl_file_monitor            = "監視";
$owl_lang->acl_file_move               = "移動";
$owl_lang->acl_file_read               = "読む";
$owl_lang->acl_file_search             = "関連を検索";
$owl_lang->acl_file_set_acl            = "ACLを設定";
$owl_lang->acl_file_update             = "更新";
$owl_lang->acl_file_view_log           = "ログを閲覧";
$owl_lang->acl_folder_copy             = "複写";
$owl_lang->acl_folder_delete           = "削除";
$owl_lang->acl_folder_modify           = "プロパティを修正";
$owl_lang->acl_folder_monitor          = "監視";
$owl_lang->acl_folder_move             = "移動";
$owl_lang->acl_folder_read             = "読む（ダウンロード／ブラウズ）";
$owl_lang->acl_folder_set_acl          = "ACLを設定";
$owl_lang->acl_folder_write            = "書く（作成）";
$owl_lang->acl_heading_file            = "グループ／ユーザ";
$owl_lang->acl_heading_files           = "ファイル &#8211; ユーザとグループを選択してください";
$owl_lang->acl_heading_folder          = "グループ／ユーザ";
$owl_lang->acl_heading_folders         = "フォルダ &#8211;  ユーザとグループを選択してください";
$owl_lang->acl_propagate_file          = "このポリシーを \"全\" ファイルに設定:";
$owl_lang->acl_propagate_folders       = "全サブフォルダに適用:";
$owl_lang->acl_selected_groups         = "選択されたグループ";
$owl_lang->acl_selected_users          = "選択されたユーザ";
$owl_lang->acl_set_acl                 = "セキュリティポリシーを設定";
$owl_lang->acl_set_acl_now             = "すぐセキュリティポリシーを設定する:";
$owl_lang->acl_set_selected            = "選択したものを設定";
$owl_lang->alt_acl_save_file           = "ファイルセキュリティポリシーを保存";
$owl_lang->alt_acl_save_folder         = "フォルダセキュリティポリシーを保存";
$owl_lang->btn_acl_save                = "保存";
$owl_lang->acl_set_file_permissions    = "ファイルのパーミッションの設定";
$owl_lang->acl_set_folder_permissions  = "フォルダのパーミッションの設定";
$owl_lang->alt_set_folder_acl	       = "現フォルダにセキュリティポリシを設定 ";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "使用可能な報告書:";
$owl_lang->report_file_folder               = "ファイル／フォルダ";
$owl_lang->report_filter                    = "フィルター:";
$owl_lang->report_filter_since              = "から:";
$owl_lang->report_full_access               = "フルアクセス";
$owl_lang->report_select_report             = "&#8211; 報告書を選択 &#8211;";
$owl_lang->report_users_disabled_title      = "使用不可になっているユーザ";
$owl_lang->report_users_entitlement         = "ユーザアクセスリスト";
$owl_lang->report_users_inactive_title      = "日から非活動なユーザ";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "サムネイルビュー／生成を可能にする:";
$owl_lang->thumb_gen_thumb_tool_path       = "ImageMagick 変換ツールへのパス:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Mplayer パラメータ:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Mplayerへのパス:";
$owl_lang->thumb_image_info                = "画像情報";
$owl_lang->thumb_large_width               = "サムネイル幅（大）ピクセル数:";
$owl_lang->thumb_med_width                 = "サムネイル幅（中）ピクセル数:";
$owl_lang->thumb_number_colums             = "サムネイルビューのカラム数:";
$owl_lang->thumb_re_generate               = "サムネイルを生成";
$owl_lang->thumb_small_width               = "サムネイル幅（小） 0=ピクセル数を表示しない:";
$owl_lang->thumb_title                     = "サムネイルビュー/生成オプション";
$owl_lang->thumb_title_thumb_view          = "サムネイル詳細";
$owl_lang->thumb_image_size                = "画像サイズ:";
$owl_lang->alt_thumb_small                 = "小サムネイル";
$owl_lang->alt_no_thumb                    = "サムネイルが使用不可です";


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
