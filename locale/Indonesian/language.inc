<?php

/*
 * File: Indonesian/language.inc
 * Author: Ronny as-Salafi <ronny.assalafi@gmail.com>
 * Date: 2007/12/18
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
	$owl_lang->localized_date_format = "l, d M Y \a\\t h:i a";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "id";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "Anda tidak diizinkan untuk Menambahkan Komentar ke Berkas ini";
$owl_lang->err_backup_file   		= "Terjadi kesalahan pada saat membuat cadangan dari berkas yang ada";
$owl_lang->err_backup_folder_create 	= "Terjadi kesalahan pembuatan map cadangan";
$owl_lang->err_bad_url			= "Harap masukkan sebuah URL yang sahih";
$owl_lang->err_bad_version_1 		= "DMS membutuhkan PHP dengan versi minimum";
$owl_lang->err_bad_version_2 		= "Anda sedang menjalankan Versi";
$owl_lang->err_bad_version_3 		= "Instal PHP dengan versi yang lebih baru dan kemudian coba lagi";
$owl_lang->err_comment_empty		= "Komentar tidak boleh kosong";
$owl_lang->err_email         		= "Pesan tidak dapat dikirim";
$owl_lang->err_email_required		= "Bidang isian e-mail diperlukan";
$owl_lang->err_fexist1			= "<b>Berkas sudah ada:</b>";
$owl_lang->err_fexist2 			= "Sudah ada berkas dengan nama <i>";
$owl_lang->err_fexist3 			= "</i> dalam direktori ini.";
$owl_lang->err_file_exists		= "Berkas yang Anda coba untuk upload sudah ada";
$owl_lang->err_file_lock     		= "Anda tidak bisa menyelidiki berkas ini, karena saat ini berkas ini sedang diselidiki oleh";
$owl_lang->err_file_not_exist		= "Berkas tidak ada di sistem berkas";
$owl_lang->err_file_too_big		= "Nilai upload_max_filesize php.ini dan/atau<br />ukuran maksimum upload berkas Owl terlampaui";
$owl_lang->err_file_update		= "Tidak boleh mengubah nama berkas pada saat memutakhirkan sebuah berkas, silakan coba lagi menggunakan nama berkas yang sama";
$owl_lang->err_fileexists    		= "Pemindahan telah dibatalkan<br />Sudah ada berkas dengan nama yang sama.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "Sudah ada nama berkas dengan nama seperti nama berkas yang sedang Anda coba untuk ubah"; //The filename you are trying to rename this file to already exists
$owl_lang->err_folder_create 		= "Kesalahan pembuatan map";
$owl_lang->err_folder_exist		= "Map ini sudah ada";
$owl_lang->err_folderexists  		= "Penggantian nama telah dibatalkan<br />Sudah ada map dengan nama yang sama.";
$owl_lang->err_general 			= "Sebuah kesalahan telah terjadi";
$owl_lang->err_please_select_bulk	= "Mohon pilih setidaknya satu berkas atau map menggunakan kotak cek";
$owl_lang->err_select_reviewer		= "Mohon pilih setidaknya satu orang untuk me-review dokumen Anda";
$owl_lang->err_update_file_lock     	= "Anda tidak bisa memutakhirkan berkas ini, berkas ini saat ini sedang dikelola oleh";
// NEW CHANGE
$owl_lang->err_group_delete             = "Tidak dapat menghapus Grup ini: <font color=\"red\">%d</font> Berkas(-berkas),  <font color=\"red\">%d</font> Map(-map), <font color=\"red\">%d</font> Pengguna(-pengguna) dengan grup Utama ini, <font color=\"red\">%d</font> Pengguna(-pengguna) yang menjadi anggota grup ini";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Tidak dapat menghapus, ada beberapa berkas yang menggunakan Tipe Dokumen ini";
$owl_lang->err_database			= "Kesalahan database";
$owl_lang->err_doc_field_req            = "Bidang Isian yang Diperlukan Tidak Ada:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Nama Tipe Dokumen Diperlukan <br />";
$owl_lang->err_field_label_req 		= "Label Bidang Isian Diperlukan <br />";
$owl_lang->err_field_name_req		= "Nama Bidang Isian Diperlukan <br />";
$owl_lang->err_field_size_req		= "Ukuran Bidang Isian Diperlukan <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Kesalahan Pembuatan Berkas &ldquo;TEKS&rdquo; Sementara";
$owl_lang->err_forbidden_file		= "Tipe Berkas Terlarang";
$owl_lang->err_group_exists		= "Sudah ada grup dengan nama ini.";
$owl_lang->err_gzip_not_found  		= "gzip tidak ditemukan dalam ";
$owl_lang->err_login			= "Silakan log masuk terlebih dahulu untuk dapat melakukan tindakan ini";
$owl_lang->err_movecancel    		= "Pemindahan telah dibatalkan<br />";
$owl_lang->err_nameempty    		= "Nama map tidak boleh kosong";
$owl_lang->err_news_required		= "KESALAHAN: Judul dan Isi Berita diperlukan!";
$owl_lang->err_no_access 		= "Anda tidak mempunyai akses ke berkas-berkas yang dipilih";
$owl_lang->err_no_access_info 		= "Kemungkinan hal ini terjadi karena: <br />1) Anda tidak mengklik satu kotak cek pun di depan nama Berkas atau Map<br />2) Penghapusan Sekaligus, Kirim E-Mail Sekaligus, Penyelidikan Sekaligus tidak diterapkan ke Map-map<br />3) Anda tidak mempunyai hak akses ke berkas-berkas atau map-map yang telah Anda pilih.";
$owl_lang->err_noemail			= "Anda tidak memiliki hak untuk mengirimkan berkas ini lewat e-mail";
$owl_lang->err_nofileaccess		= "Anda tidak memiliki hak akses ke berkas ini";
$owl_lang->err_nofiledelete		= "Anda tidak memiliki hak untuk menghapus berkas ini";
$owl_lang->err_nofilemod		= "Anda tidak memiliki hak untuk memodifikasi berkas ini";
$owl_lang->err_nofolderaccess		= "Anda tidak memiliki hak akses ke map ini";
$owl_lang->err_nofolderdelete		= "Anda tidak memiliki hak untuk menghapus map ini";
$owl_lang->err_nofoldermod		= "Anda tidak memiliki hak untuk memodifikasi map ini";
$owl_lang->err_nosubfolder		= "Anda tidak memiliki hak untuk membuat map-map di dalam map ini";
$owl_lang->err_not_zip			= "Buka sebuah Arsip ZIP yang valid";
$owl_lang->err_note_title               = "Judul adalah bidang isian yang harus diisi";
$owl_lang->err_note_title_exists        = "Sudah ada sebuah catatan dengan nama seperti ini";
$owl_lang->err_noupload			= "Anda tidak memiliki hak untuk meng-upload berkas-berkas ke map ini";
$owl_lang->err_pass_missmatch		= "Kata Sandi Baru dan Kata Sandi Konfirmasi tidak sama";
$owl_lang->err_pass_wrong    		= "Kata Sandi Lama salah";
$owl_lang->err_please_select_bulk       = "Silakan pilih paling tidak astu Berkas atau Map menggunakan kotak cek";
$owl_lang->err_pod2html_not_found       = "KESALAHAN: Alat pod2html tidak ditemukan:";
$owl_lang->err_quota			= "Anda tidak memiliki cukup ruang kuota untuk meng-upload berkas ini: ";
$owl_lang->err_quota_avail		= " tersedia.";
$owl_lang->err_quota_exceed  		= "Anda telah melampaui kuota Anda";
$owl_lang->err_quota_needed		= " dibutuhkan ";
$owl_lang->err_req			= "KESALAHAN: Semua bidang isian harus diisi";
$owl_lang->err_root_delete		= "Map Paling Atas (Root Folder) tikda dapat dihapus";
$owl_lang->err_sess_notvalid 		= "ID Sesi tidak valid";
$owl_lang->err_sess_write		= "Kesalahan terjadi pada saat menulis informasi sesi ke database";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; adalah sebuah Nama Map Terpesan Owl, silakan pilih nama yang lain";
$owl_lang->err_sql			= "Kesalahan SQL";
$owl_lang->err_tar_not_found  		= "tar tidak ditemukan dalam ";
$owl_lang->err_trash_can_empty 		= " Tempat Sampah kosong";
$owl_lang->err_unauth_area   		= "Anda tidak diizinkan untuk menggunakan wilayah ini";
$owl_lang->err_unauthorized  		= "Tidak Diizinkan";
$owl_lang->err_upload 			= "Kesalahan upload";
$owl_lang->err_user_exists		= "Nama pengguna sudah ada";
// NEW STUFF
$owl_lang->err_captcha_auth		= "Autentikasi CAPTCHA telah gagal";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Tambah Bidang Isian";
$owl_lang->btn_add_file          = "Tambah Dokumen";
$owl_lang->btn_add_folder          = "Tambah Map";
$owl_lang->btn_add_news          = "Tambah Berita";
$owl_lang->btn_add_note          = "Tambah Catatan";
$owl_lang->btn_add_url          = "Tambah URL";
$owl_lang->btn_add_zip           = "Tambah Arsip";
$owl_lang->btn_admin      = "Admin";
$owl_lang->btn_admin_groups          = "Grup Baru";
$owl_lang->btn_admin_news          = "Administrasi Berita"; //News Admin
$owl_lang->btn_admin_user_group          = "Administrasi Pengguna/Grup";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Pengguna Baru";
$owl_lang->btn_back          = "&laquo; Kembali";
$owl_lang->btn_browse     = "Rambah";
$owl_lang->btn_bulk_checkout       = "Selidiki Sekaligus";
$owl_lang->btn_bulk_delete         = "Hapus Sekaligus";
$owl_lang->btn_bulk_download          = "Unduh Sekaligus";
$owl_lang->btn_bulk_email          = "Kirim E-Mail Sekaligus";
$owl_lang->btn_bulk_move          = "Pindahkan Sekaligus";
$owl_lang->btn_cancel          = "Batal";
$owl_lang->btn_clickhere          = "Klik Disini";
$owl_lang->btn_collapse_view          = "Lipat Tampilan";
$owl_lang->btn_create          = "Ciptakan";
$owl_lang->btn_default_view          = "Tampilan Asali";
$owl_lang->btn_deldoctype          = "Hapus Tipe Dokumen";
$owl_lang->btn_download_bulk_package	= "untuk mengunduk paket unduh sekaligus Anda";
$owl_lang->btn_edit_group          = "Edit Grup";
$owl_lang->btn_edit_user          = "Edit Pengguna";
$owl_lang->btn_expand_view          = "Bentangkan Tampilan";
$owl_lang->btn_go_bottom      = "Pergi Ke Bawah";
$owl_lang->btn_go_top      = "Pergi Ke Atas";
$owl_lang->btn_help     = "Bantuan";
$owl_lang->btn_import_users  = "Impor Pengguna";
$owl_lang->btn_login          = "Log Masuk";
$owl_lang->btn_logout     = "Log Keluar";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_register          = "Daftar";
$owl_lang->btn_reset          = "Reset";
$owl_lang->btn_send_email          = "Kirim E-Mail";
$owl_lang->btn_submit          = "Kirim";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Tampilan Thumbnail";
$owl_lang->btn_trash_admin          = "Tempat Sampah";
// NEW STUFF
$owl_lang->btn_export          = "Ekspor";
$owl_lang->btn_gen_pdf          = "Ciptakan PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";


//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Tambahkan Sebuah Komentar ke Berkas ini";
$owl_lang->alt_add_field	= "Tambahkan Sebuah Bidang Isian di Atas";
$owl_lang->alt_add_group	= "Buat Grup Ini";
$owl_lang->alt_add_news		= "Tambahkan Sebuah Berita Baru";
$owl_lang->alt_add_user		= "Buat Pengguna Ini";
$owl_lang->alt_admin_flush      = "BersihkanSesi-sesi Lama dan Kadaluarsa"; //Flush Stale/Expired Sessions
$owl_lang->alt_admin_groups	= "Buat Sebuah Grup Baru";
$owl_lang->alt_admin_users	= "Buat Sebuah Pengguna Baru";
$owl_lang->alt_approve_file 	= "Setujui Dokumen Ini";
$owl_lang->alt_back      	= "Kembali Ke Halaman Sebelumnya";
$owl_lang->alt_btn_add_file     = "Upload Sebuah Berkas Baru";
$owl_lang->alt_btn_add_folder	= "Buat Sebuah Map Baru";
$owl_lang->alt_btn_add_note     = "Buat Sebuah Catatan Baru";
$owl_lang->alt_btn_add_url	= "Buat Sebuah Tautan Web Baru";
$owl_lang->alt_btn_add_zip     	= "Upload sebuah berkas Zip untuk Diekstrak";
$owl_lang->alt_btn_admin 	= "Administrasi Owl";
$owl_lang->alt_btn_browse	= "Kembali ke Perambah Berkas";
$owl_lang->alt_btn_bulk_checkout= "Selidiki Berkas-berkas Sekaligus";
$owl_lang->alt_btn_bulk_delete 	= "Hapus Berhas-berkas Sekaligus";
$owl_lang->alt_btn_bulk_download= "Unduh Berkas-berkas Sekaligus";
$owl_lang->alt_btn_bulk_email  	= "Kirim Berkas-berkas Ini Sekaligus Lewat E-Mail";
$owl_lang->alt_btn_bulk_move   	= "Pindahkan Berkas-berkas dan Map-map Sekaligus";
$owl_lang->alt_btn_clickhere	= "Klik Disini";
$owl_lang->alt_btn_collapse_view= "Beralih ke Tampilan Diperkecil";
$owl_lang->alt_btn_default_view = "Beralih ke Tampilan Asali";
$owl_lang->alt_btn_expand_view  = "Beralih ke Tampilan Diperbesar";
$owl_lang->alt_btn_help		= "Bantuan Online Owl";
$owl_lang->alt_btn_login	= "Log masuk ke DMS";
$owl_lang->alt_btn_logout	= "Log keluar dari DMS";
$owl_lang->alt_btn_mail_tool   	= "Alat E-mail Sederhana";
$owl_lang->alt_btn_thumb_view   = "Beralih ke Tampilan Thumb Nail";
$owl_lang->alt_cancel		= "Batalkan Tindakan Ini";
$owl_lang->alt_cancel_move	= "Batalkan Tindakan Pemindahan";
$owl_lang->alt_change		= "Mutakhirkan Catatan Ini";
$owl_lang->alt_comments 	= "Sudah Ada Komentar untuk Berkas Ini";
$owl_lang->alt_copy_file     	= "Salin Berkas";
$owl_lang->alt_copy_folder   	= "Salin Map";
$owl_lang->alt_del_all		= "Kosongkan Tempat Sampah";
$owl_lang->alt_del_comments     = "Hapus Komentar Ini";
$owl_lang->alt_edt_comments     = "Edit Komentar Ini";
$owl_lang->alt_del_field	= "Hapus Bidang Isian Ini";
$owl_lang->alt_del_file      	= "Hapus Berkas (Ya/Tidak)";
$owl_lang->alt_del_folder    	= "Hapus Map (Ya/Tidak)";
$owl_lang->alt_del_group	= "Hapus Grup Ini";
$owl_lang->alt_del_news		= "Hapus Berita Ini";
$owl_lang->alt_del_selected	= "Hapus Semua Berkas yang Dipilih";
$owl_lang->alt_del_this_folder	= "Hapus Map &#8211; ";
$owl_lang->alt_del_user		= "Hapus Pengguna Ini";
$owl_lang->alt_deldoctype	= "Hapus Tipe Dokumen Saat Ini";
$owl_lang->alt_edit_field	= "Edit Definisi Bidang Isian Ini";
$owl_lang->alt_edit_group       = "Edit Grup yang Telah Dipilih";
$owl_lang->alt_edit_news	= "Edit Berita Ini";
$owl_lang->alt_edit_user        = "Edit Pengguna yang Dipilih";
$owl_lang->alt_email		= "Kirim Berkas Ini Lewat E-Mail";
$owl_lang->alt_email_reminder 	= "Pengingat E-Mail";
$owl_lang->alt_email_selected	= "Kirim Semua Berkas yang Dipilih Lewat E-Mail";
$owl_lang->alt_get_file      	= "Unduh Berkas";
$owl_lang->alt_get_folder      	= "Unduh Isi Map";
$owl_lang->alt_go_bottom      	= "Pergi ke bagian bawah halaman";
$owl_lang->alt_go_top 		= "Pergi ke bagian atas halaman";
$owl_lang->alt_have_news	= "Anda Memiliki Berita-berita untuk Dilihat";
$owl_lang->alt_have_no_news	= "Tidak Ada Berita Baru untuk Dilihat";
$owl_lang->alt_home_folder	= "Kembali ke Direktori Permulaan";
$owl_lang->alt_link_file     	= "Tautkan Berkas Ini ke Direktori Lain";
$owl_lang->alt_lock_file        = "Selidiki berkas";
$owl_lang->alt_log_clear        = "Hapus semua Log (Ya/Tidak)";
$owl_lang->alt_log_file         = "Log Berkas";
$owl_lang->alt_log_next		= "Tampilkan Catatan Berikutnya";
$owl_lang->alt_log_prev		= "Tampilkan Catatan Sebelumnya";
$owl_lang->alt_log_top		= "Pergi ke Catatan Pertama";
$owl_lang->alt_mod_file      	= "Modifikasi Properti Berkas"; 
$owl_lang->alt_mod_folder    	= "Modifikasi Properti Map";
$owl_lang->alt_monitor		= "Awasi Berkas Ini";
$owl_lang->alt_monitor_folder   = "Awasi Map Ini";
$owl_lang->alt_monitored	= "Berhenti Mengawasi Berkas Ini";
$owl_lang->alt_monitored_folder = "Berhenti Mengawasi Map Ini";
$owl_lang->alt_move_file     	= "Pindahkan Berkas";
$owl_lang->alt_move_folder   	= "Pindahkan Map";
$owl_lang->alt_move_selected	= "Pindahkan Semua Berkas yang Dipilih";
$owl_lang->alt_my_approval	= "Dokumen Menunggu Persetujuan Saya";
$owl_lang->alt_new_doctype	= "Buat Sebuah Tipe Dokumen Baru";
$owl_lang->alt_news_close	= "Tutup Jendela Berita";
$owl_lang->alt_news_next	= "Tampilkan Berita Selanjutnya";
$owl_lang->alt_news_prev	= "Tampilkan Berita Sebelumnya";
$owl_lang->alt_news_print	= "Cetak Berita Ini";
$owl_lang->alt_pending_approval	= "Dokumen Menunggu Persetujuan"; // Document(s) Pending Approval
$owl_lang->alt_play_file 	= "Putar Berkas Media";
$owl_lang->alt_publish_file 	= "Jadikan Sebagai Dokumen Publik";
$owl_lang->alt_recycle		= "Tempat Sampah<br />(Kosong)";
$owl_lang->alt_recycle_disable	= "Pengumpulan Sampah<br />(Dinon-aktifkan)";
$owl_lang->alt_recycle_not_found= "Keranjang Sampah<br />(Tidak Ditemukan)";
$owl_lang->alt_refresh_filter	= "Mulai Filter / Segarkan Hasil"; //Initiate Filter / Refresh Results
$owl_lang->alt_register		= "Kirim Pendaftaran Anda";
$owl_lang->alt_reject_file 	= "Tolak Dokumen Ini";
$owl_lang->alt_related		= "Cari Dokumen yang Berkaitan";
$owl_lang->alt_reset_form	= "Reset Nilai-Nilai Formulir";
$owl_lang->alt_rest_selected	= "Pulihkan Semua Berkas yang Dipilih";
$owl_lang->alt_search		= "Mulai Pencarian";
$owl_lang->alt_send_email	= "Kirim E-Mail";
$owl_lang->alt_sendfile		= "Kirim Berkas";
$owl_lang->alt_set_initial_dir	= "Tetapkan Direktori Saat Ini sebagai Direktori Permulaan";
$owl_lang->alt_site_map         = "Peta Situs";
$owl_lang->alt_submit      	= "Kirim Formulir";
$owl_lang->alt_toggle_check_box	= "Balikkan Kotak-kotak  Cek";
$owl_lang->alt_tool_status_green= "Alat Sedang Aktif";
$owl_lang->alt_tool_status_red	= "Jalur Salah DAN/ATAU Tidak Dapat Dijalankan";
$owl_lang->alt_unlock_file      = "Lepaskan Berkas"; //Check file in
$owl_lang->alt_upd_field	= "Mutakhirkan Bidang Isian Ini";
$owl_lang->alt_upd_file      	= "Mutakhirkan Berkas";
$owl_lang->alt_view_comments    = "Tambah / Lihat Komentar Berkas";
$owl_lang->alt_view_file     	= "Lihat Berkas";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Administrasi Tempat Sampah";
$owl_lang->alt_edit_file_inline = "Edit Berkas Teks";
$owl_lang->alt_gen_pdf          = "Ciptakan Versi PDF dari Berkas di Atas";
$owl_lang->alt_updated     	= "Dokumen Telah Dimutakhirkan Semenjak Kunjungan Terakhir Anda";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Dokumen Telah Dibuat Semenjak Kunjungan Terakhir Anda";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Seluruh Isi juga telah dihapus";
$owl_lang->log_detail		= "Tidak Ada Perincian Tambahan";
$owl_lang->log_file_to		= "KE: ";
$owl_lang->log_filter_all	= "SEMUA";
$owl_lang->log_login_det	= "Nama pengguna: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = " Grup yang Diubah: ";
$owl_lang->log_admin_changed_user = "Pengguna yang Diubah: ";
$owl_lang->log_admin_created_group = "Grup yang Dibuat: ";
$owl_lang->log_admin_created_user = "Pengguna yang Dibuat: ";
$owl_lang->log_admin_del_group = "Grup yang Dihapus: ";
$owl_lang->log_admin_del_user = "Pengguna yang Dihapus: ";
$owl_lang->log_admin_disabled = " Pengguna yang Dinon-aktifkan: ";
$owl_lang->log_admin_email_restore = "Berkas yang dikirimkan lewat e-mail:";
$owl_lang->log_admin_trash_delfile= "Berkas yang dihapus: ";
$owl_lang->log_admin_trash_delfold = "Map yang Dihapus: ";
$owl_lang->log_admin_trash_empty = "Tempat Sampah Dikosongkan";
$owl_lang->log_admin_trash_restore = "Dipulihkan: ";
$owl_lang->log_login_expired    = "Pengguna Kadaluarsa: ";
$owl_lang->log_login_too_many_attempts = "Dinon-aktifkan (Terlalu Banyak Kegagalan Log Masuk): ";
$owl_lang->log_readhd_feature_add  = "Fitur baca HD telah menambahkan berkas ini";
$owl_lang->log_admin_to  = "ke";
$owl_lang->log_admin_of  = "dari";
// END NEW STUFF
$log_file_actions[1]        	= "LOG MASUK";
$log_file_actions[10]        	= "KUNCI BERKAS DIBUKA";
$log_file_actions[11]        	= "BERKAS DIKIRIMKAN LEWAT E-MAIL";
$log_file_actions[12]        	= "BERKAS DIPINDAHKAN";
$log_file_actions[13]        	= "MAP DIBUAT";
$log_file_actions[14]        	= "MAP DIHAPUS";
$log_file_actions[15]        	= "MAP DIMODIFIKASI";
$log_file_actions[16]        	= "MAP DIPINDAHKAN";
$log_file_actions[17]        	= "LUPA KATA SANDI";
$log_file_actions[18]        	= "PENGGUNA MENDAFTAR";
$log_file_actions[19]           = "BERKAS DILIHAT";
$log_file_actions[2]        	= "LOG MASUK GAGAL";
$log_file_actions[20]           = "VIRUS BERKAS";  //FILE VIRUS
$log_file_actions[21]           = "BERKAS DISALIN";
$log_file_actions[22]           = "MAP DISALIN";
$log_file_actions[23]           = "BERKAS DITAUTKAN";
$log_file_actions[3]        	= "LOG KELUAR";
$log_file_actions[4]        	= "BERKAS DIHAPUS";
$log_file_actions[5]        	= "BERKAS DI-UPLOAD";
$log_file_actions[6]        	= "BERKAS DIMUTAKHIRKAN";
$log_file_actions[7]        	= "BERKAS DIUNDUH";
$log_file_actions[8]        	= "BERKAS DIUBAH";
$log_file_actions[9]        	= "BERKAS DIKUNCI";
// BEGIN NEW STUFF
$log_file_actions[24]           = "ADMIN PENGGUNA";
$log_file_actions[25]           = "TEMPAT SAMPAH";
$log_file_actions[26]           = "BERKAS ACL";
$log_file_actions[27]           = "MAP ACL";
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
$owl_lang->admin_login_date  = "pengguna admin telah log masuk pada:";
$owl_lang->admin_login_from  = "Pengguna admin telah log masuk dari";
$owl_lang->admin_login_subject  = "PENGGUNA ADMIN LOG MASUK";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Klik Disini untuk Langsung Masuk)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Lupa kata sandi Anda?";
$owl_lang->like_register	= "Ingin Mendaftar?";
$owl_lang->login		= "Log Masuk";
$owl_lang->logindisabled	= "Akun telah DINON-AKTIFKAN, hubungi Administrator Sistem";
$owl_lang->loginfail		= "Log masuk gagal";
$owl_lang->password		= "Kata sandi";
$owl_lang->repository_list      = "Tempat Penyimpanan";
$owl_lang->successlogout 	= "Anda sekarang sudah log keluar.";
$owl_lang->toomanysessions	= "Batas sesi maksimum untuk pengguna telah dicapai, hubungi Administrator Sistem";
$owl_lang->username		= "Nama Pengguna";
$owl_lang->forgot_username	= "Nama Pengguna atau Alamat E-Mail";
$owl_lang->version 		= "Versi";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Tindakan";
$owl_lang->current_db         		= "Tempat Penyimpanan Saat Ini:";
$owl_lang->current_folder 		= "Map Saat Ini:";
$owl_lang->del_all			= "Kosongkan Tempat Sampah";
$owl_lang->del_selected			= "Hapus yang Dipilih";
$owl_lang->disk_quota			= "Kuota Diska";
$owl_lang->doc_number 			= "Dok. #";
$owl_lang->email_selected		= "Kirim E-Mail ke yang Dipilih";
$owl_lang->file 			= "Berkas";
$owl_lang->folder_count_file		= "Berkas";
$owl_lang->folder_count_folder		= "Map";
$owl_lang->folder_count_note		= "Catatan";
$owl_lang->folder_count_pre		= "Map Ini Berisi";
$owl_lang->folder_count_url		= "URL";
$owl_lang->folder_policy 		= "Kebijakan Map yang Aktif:";
$owl_lang->held                      	= "Dikelola"; //held
$owl_lang->last_logged			= "Terakhir Terlihat: ";
$owl_lang->menu_file_action		= "Tindakan-tindakan Berkas yang Tersedia";
$owl_lang->menu_folder_action		= "Tindakan-tindakan Map yang Tersedia";
$owl_lang->menu_url_action		= "tindakan-tindakan URL yang Tersedia";
$owl_lang->modified 			= "Dimodifikasi";
$owl_lang->move_selected		= "Pindahkan yang Dipilih";
$owl_lang->new_file			= "Baru!";
$owl_lang->no_description		= "Tidak ada deskripsi";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Halaman:";
$owl_lang->panel_file_info		= "Informasi Berkas";
$owl_lang->postedby 			= "Dikirim Oleh";
$owl_lang->reallydelete			= "Benar-benar dihapus";//Really delete
$owl_lang->reallydelete_logs		= "Benar-benar Hapus Berkas Log"; //Really Clear the Log File
$owl_lang->reallydelete_selected	= "Benar-benar Hapus Semua Berkas yang Dipilih";
$owl_lang->reallyrestore_selected	= "Benar-benar Pulihkan Semua Berkas yang Dipilih";
$owl_lang->rest_selected		= "Pulihkan yang Dipilih";
$owl_lang->score 			= "Nilai";
$owl_lang->size 			= "Ukuran";
$owl_lang->updated_by 			= "Dimutakhirkan Oleh";
$owl_lang->title 			= "Judul";
$owl_lang->tot_files			= "Total:";
$owl_lang->tot_monitored		= "Diawasi:";
$owl_lang->tot_my_checked_out		= "Diselidiki:";
$owl_lang->tot_my_files			= "Saya:";
$owl_lang->tot_my_group			= "Grup:";
$owl_lang->tot_new_files		= "Baru:";
$owl_lang->tot_updated_files		= "Dimutakhirkan:";
$owl_lang->updated_file			= "Dimutakhirkan!";
$owl_lang->user               		= "Pengguna";
$owl_lang->ver                       	= "Versi"; 
$owl_lang->past_number                  = "Jumlah Hari yang Lalu :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favorit";
$owl_lang->favorite_add = "Tambahkan yang Aktif";
$owl_lang->favorite_delete = "Hapus";
$owl_lang->favorite_go = "Pergi";
$owl_lang->files_in_my_group_title = "Berkas-berkas dalam Grup(-Grup) Saya";
$owl_lang->my_files_title= "Berkas-berkas Saya";
$owl_lang->my_monitored_title= "Berkas-(berkas) / Map(-map) yang Saya Awasi";
$owl_lang->my_special_access_title= "Daftar Akses Spesial";
$owl_lang->special_access_count_alt= "Map-map/Berkas-berkas Akses Spesial";
$owl_lang->special_access_count= "Akses Spesial:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Sedang Menambahkan / Melihat Komentar: ";
$owl_lang->addingfile 		= "Tambahkan sebuah berkas ke ";
$owl_lang->addingfolder 	= "Tambahkan sebuah map ke ";
$owl_lang->attach_file		= "Lampirkan Berkas";
$owl_lang->change		= "Ubah";
$owl_lang->comments      	= "Komentar";
$owl_lang->comments_added       = "Komentar Ditambahkan Oleh: ";
$owl_lang->create		= "Buat";
$owl_lang->description 		= "Deskripsi";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Song:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Duration:<br />Genre:<br />Comments:";
$owl_lang->email_body		= "Pesan";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Balas-ke";
$owl_lang->email_subject	= "Judul";
$owl_lang->email_to		= "E-Mail ke";
$owl_lang->emailing		= "Mailing"; //Mailing
$owl_lang->keywords 		= "Kata kunci-kata kunci";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Memodifikasi ";
$owl_lang->name               	= "Nama"; 
$owl_lang->none_selected        = "TIDAK ADA YANG DIPILIH";
$owl_lang->note_content         = "Isi Catatan";
$owl_lang->notify_link          = "tatan Eksternal Owl";
$owl_lang->ownergroup         	= "Pemilik (Grup)";
$owl_lang->ownership		= "Kepemilikan";
$owl_lang->permissions 		= "Hak Akses";
$owl_lang->pick_select		= "&#8211; Pilih Seorang Pengguna Owl &#8211;";
$owl_lang->policy 		= "Kebijakan";
$owl_lang->post_comment		= "Kirim Komentar"; //Post Comment
$owl_lang->prop_permissions 	= "Propagate Hak Akses ke Map-map Didalamnya?";
$owl_lang->prop_perms_files 	= "Hak akses untuk propagate ke berkas";
$owl_lang->sendfile 		= "Kirim Berkas";
$owl_lang->sendthisfile 	= "Kirim berkas ini";
$owl_lang->sendthisurl       	= "Kirim URL ini";
$owl_lang->updating		= "Memutakhirkan";
$owl_lang->verdescription 	= "Deskripsi<br />perubahan-perubahan";
$owl_lang->vermajor          	= "Revisi Utama";
$owl_lang->verminor          	= "Revisi Kecil";
$owl_lang->vertype           	= "Tipe Revisi";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Simpan Kata Kunci?";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "Alamat E-Mail";
$owl_lang->full_name		= "Nama Lengkap";
$owl_lang->register		= "Pendaftaran Pengguna";
$owl_lang->self_failed		= "Telah Gagal";
$owl_lang->self_passwd		= "Kata Sandi Dikirim ke:";
$owl_lang->self_reg_bod		= "Kata Sandi Anda adalah:"; //Your Owl Password is
$owl_lang->self_reg_rset	= "Kata Sandi Anda telah Disetel Ulang Menjadi:"; //Your Owl Password has been reset to
$owl_lang->self_reg_subj	= "Akun Anda"; //Your OWL Account
$owl_lang->send_pass		= "Kirim Kata Sandi";
$owl_lang->submit		= "Daftar";
$owl_lang->thank_you_1		= "Terima Kasih!";
$owl_lang->thank_you_2		= "Kata sandi Anda akan dikirim ke alamat e-mail Anda";
$owl_lang->thank_you_3		= "Akun Anda harus diaktifkan terlebih dahulu oleh Administrator sebelum Anda dapat log masuk.";

//NEW STUFF

$owl_lang->captcha_typein        = "Ketikkan 5 karakter ini (Segarkan halaman ini jika gambarnya kurang jelas)";
$owl_lang->change_pass_title	      = "UBAH KATA SANDI";
$owl_lang->err_cant_reuse_passwords   = "Anda tidak dapat menggunakan kembali kata sandi-kata sandi yang telah ditetapkan sebelumnya"; //You can't reuse previously set passwords
$owl_lang->err_new_confirm_different  = "Kata Sandi Baru dan Kata Sandi Konfirmasi Anda tidak sama<br />";
$owl_lang->err_old_pass_ver_failed    = "Kata Sandi Lama Anda salah<br />";
$owl_lang->err_pass_restriction_1     = "Kata sandi Anda minimal harus memiliki panjang &ldquo;$default->min_pass_length&rdquo; karakter <br />";
$owl_lang->err_pass_restriction_2     = "mengandung setidaknya  &ldquo;$default->min_pass_numeric&rdquo; angka [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "dan sedikitnya &ldquo;$default->min_pass_special&rdquo; karakter spesial [ ~!@#$%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Anda memilih nama pengguna dengan panjang &ldquo;%s&rdquo; is %d karakter, sedangkan nama pengguna yang diperbolehkan minimal harus terdiri dari %d karakter.";
$owl_lang->pass_change_email_1        = "Kata Sandi Anda tidak di-reset karena Anda tidak menggunakan Otentikasi Owl"; //Your Password was not Reset as you are not using Owl Authentication
$owl_lang->pass_change_email_2        = "Tipe Otentikasi Anda ialah: ";
$owl_lang->pass_change_email_3        = "Hubungi Administrator Sistem Anda untuk meminta bantuan";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Batal";
$owl_lang->copy_file		= "Menyalin berkas";
$owl_lang->copy_folder		= "Menyalin map";
$owl_lang->moving		= "Memindahkan";
$owl_lang->moving_file		= "Memindahkan berkas";
$owl_lang->moving_folder	= "Memindahkan map";
$owl_lang->select		= "Silakan pilih map yang baru:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Sedang Melihat Log untuk ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Diff Dari";
$owl_lang->diff_to	= "Diff Ke";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Pemberitahuan Komentar";
$owl_lang->confpassword	= "Konfirmasi Kata Sandi Baru";
$owl_lang->email_tool	= "Alat E-Mail";
$owl_lang->group	= "Grup Utama";
$owl_lang->groupmember	= "Grup(-grup) Anggota";
$owl_lang->last_modified= "Terakhir Dimodifikasi";
$owl_lang->newpassword	= "Kata Sandi Baru";
$owl_lang->newsadmin	= "Administrator Berita";
$owl_lang->not_member	= "Anda bukan anggota dari grup-grup yang lain";
$owl_lang->notification	= "Menerima Pemberitahuan";
$owl_lang->oldpassword	= "Kata Sandi Lama";
$owl_lang->preference	= "Preferensi";
$owl_lang->saved	= "&#8212; P E R U B A H A N&nbsp;&nbsp;&nbsp;T E L A H&nbsp;&nbsp;&nbsp;D I S I M P A N &#8212;";
$owl_lang->status_no	= "TIDAK";
$owl_lang->status_yes	= "YA";
$owl_lang->userlang	= "Bahasa";

//NEW STUFF
$owl_lang->useradmin	= "PenggunaAdministrator";
$owl_lang->viewlogs     = "Dapat Melihat Log-log Sistem";
$owl_lang->viewreports  = "Dapat Melihat Laporan-laporan Sistem";
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

$owl_lang->elapsed_time       	= "Waktu yang digunakan";//elapsed time
$owl_lang->query_empty       	= "Kata Pencarian Tidak Ada";
$owl_lang->related_query_empty  = "Tidak ada metadata yang diasosiasikan dengan dokumen untuk melakukan &ldquo;Cari yang Berkaitan&rdquo;";
$owl_lang->search             	= "Cari";
$owl_lang->search_all_word	= "Semua Kata";
$owl_lang->search_any_word	= "Salah satu kata";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Cari Map yang Aktif";
$owl_lang->search_entire_phrase	= "Seluruh Kalimat";
$owl_lang->search_for_files 	= "Cari Berkas";
$owl_lang->search_for_folders 	= "Cari Map";
$owl_lang->search_match 	= "Cocok:";
$owl_lang->search_results_for	= "Hasil pencarian untuk";
$owl_lang->search_score 	= "Nilai Berkas"; //Scoring Files
$owl_lang->search_winthindocs   = "Cari di Dalam";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Sedang Melihat";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Tampilkan Panel Info Berkas Lebar";
$owl_lang->allow_track_favorite         = "Izinkan Pengguna untuk Menelusuri  Favorit";
$owl_lang->admin_login_to_browse_page	= "Admin pergi ke Halaman Rambah pada saat Log Masuk";
$owl_lang->alt_btn_backup		= "Buat Cadangan Database SQL";
$owl_lang->alt_btn_doctype_admin	= "Administrator Tipe Dokumen";
$owl_lang->alt_btn_html_prefs		= "Edit Preferensi HTML Situs";
$owl_lang->alt_btn_log_viewer		= "Alat Penglihat Log Sistem Owl";
$owl_lang->alt_btn_news_admin		= "Administrator Berita Owl";
$owl_lang->alt_btn_site_features	= "Edit Fitur dan Pengaturan Situs";
$owl_lang->alt_btn_statistics_viewer	= "Alat Penglihat Statistik Owl";
$owl_lang->alt_btn_users_groups		= "Kelola Pengguna dan Grup"; //Administer Users and Groups
$owl_lang->btn_backup			= "Buat Cadangan<br />Database";
$owl_lang->btn_doctype_admin		= "Tipe<br />Dokumen";
$owl_lang->btn_html_prefs		= "Preferensi<br />HTML";
$owl_lang->btn_log_viewer		= "Alat Penglihat<br />Log";
$owl_lang->btn_news_admin		= "Admin<br />Berita";
$owl_lang->btn_site_features		= "Fitur-fitur<br />Situs";
$owl_lang->btn_statistics_viewer	= "Alat Penglihat <br />Statistik / Laporan";
$owl_lang->btn_users_groups		= "Pengguna &amp;<br />Grup";
$owl_lang->display_password_override	= "Tampilkan Pengabaian Kata Sandi Map/Berkas"; //Display File/Folder Password Override
$owl_lang->doc_id_num_digits		= "Jumlah Nomor Dok# untuk Ditampilkan"; //Doc# Number Digit to display
$owl_lang->doc_id_prefix		= "Kata Awalan Tampilan Dok#";  //Doc# Display Prefix String
$owl_lang->docicon_column		= "Lambang Dok";
$owl_lang->download_folder_zip		= "Unduh Map Sebagai ZIP (Asali adalah tar.gz)";
$owl_lang->save_keywords_to_db		= "Perkenankan Pengguna-pengguna untuk menyimpan kata kunci-kata kunci untuk dipakai ulang";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Revisi Utama Permulaan";
$owl_lang->verminor_initial          	= "Revisi Minor Permulaan";
$owl_lang->view_doc_in_new_window	= "Jendela Baru Ketika Melihat Dokumen";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Mengedit Pengguna *****";
$owl_lang->edit_group  			= "***** Mengedit Grup *****";
$owl_lang->enter_new_user               = "***** Menambahkan Pengguna Baru *****";
$owl_lang->enter_new_group              = "***** Menambahkan Grup Baru *****";
$owl_lang->alt_btn_change_passwd        = "Ganti Kata Sandi Lama Anda";
$owl_lang->alt_btn_cln_history          = "Hapus Dokumen yang berusia lebih lama dari (hari): ";
$owl_lang->alt_btn_log_viewer           = "Alat Penglihat Log Sistem";
$owl_lang->alt_btn_report_viewer        = "Alat penglihat Laporan Owl";
$owl_lang->btn_change_passwd            = "Ganti Kata Sandi";
$owl_lang->btn_cln_history              = "Hapus Riwayat"; //Purge Historical
$owl_lang->btn_log_viewer               = "Log-log Sistem"; //System Logs
$owl_lang->btn_report_viewer            = "Laporan";
$owl_lang->confirm_cln_history          = "Anda yakin ingin menghapus Dokumen yang berusia lebih lama dari (hari): ";
$owl_lang->historical_purge             = "Berkas-berkas riwayat telah dihapus";

// END NEW STUFF
$owl_lang->add				= "tambah";
$owl_lang->alt_btn_initial_load		= "Muat DB Dari map Dokumen";
$owl_lang->alt_btn_trashcan		= "Klik untuk Melihat Isi";
$owl_lang->anonymous_account		= "Akun Akses Anonim:";
$owl_lang->btn_initial_load		= "Muat Permulaan";
$owl_lang->btn_trashcan			= "Tempat Sampah";
$owl_lang->buttonstyle                  = "Gaya Tombol";
$owl_lang->confirm_initial_load		= "*** PERINGATAN *** Hendaknya ini dilakukan hanya ketika database kosong";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Hapus Grup";
$owl_lang->deleteuser			= "Hapus Pengguna";
$owl_lang->disable_recs_per_page	= "Mengaktifkan Tampilan Terbatas akan MENON-AKTIFKAN Catatan Per Halaman"; //Enabling Restricted View Will DISABLE Records Per Page!
$owl_lang->disableuser			= "Non-Aktifkan Pengguna";
$owl_lang->file_admin_group		= "Grup Admin  Perambah/Berkas:"; //File/Browser Admin Group
$owl_lang->flushed           		= "Tabel sesi telah dibersihkan, pengguna sekarang dapat log masuk kembali.";
$owl_lang->groups			= "Grup";
$owl_lang->hide_bulk_buttons		= "Sembunyikan tombol-tombol \"sekaligus\":";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Jalur Gambar Latar Belakang Halaman:";
$owl_lang->ht_bd_lnk_cl			= "Warna Tautan Halaman:";
$owl_lang->ht_bd_txt_cl 		= "Warna Teks Halaman:";
$owl_lang->ht_bd_vlnk_cl 		= "Warna Tautan Terkunjungi Halaman:";
$owl_lang->ht_collapse_width 		= "Lebar Tampilan Terlipat:";
$owl_lang->ht_expand_width		= "Lebar Tampilan Terbentang:";
$owl_lang->ht_tbl_border_sz 		= "Ukuran Garis Tabel:";
$owl_lang->ht_tbl_cell_bg_al 		= "Warna Alternate Latar Belakang Sel Tabel:"; //Table Cell Background Colour Alternate
$owl_lang->ht_tbl_cell_bg_cl 		= "Warna Latar Belakang Sel Tabel:";
$owl_lang->ht_tbl_hd_bg			= "Latar Belakang Header:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Tetapkan Akses Anonim";
$owl_lang->header_group_admin           = "Administrasi Grup";
$owl_lang->header_sitefeatures_settings           = "Pengaturan dan Fitur Situs";
$owl_lang->header_user_admin           	= "Administrasi Pengguna";
$owl_lang->hide_folder_doc_count	= "Sembunyikan Hitungan Tipe Berkas Map"; //Hide Folder File Type Count
$owl_lang->hide_folder_size		= "Sembunyikan Ukuran Isi Map";
$owl_lang->hide_panel			= "Sembunyikan";
$owl_lang->home_dir			= "Direktori \"Rumah\" Pengguna:";
$owl_lang->initial_dir   		= "Direktori Permulaan Pengguna";
$owl_lang->maxsessions			= "Jumlah Sesi Maksimum";
$owl_lang->noprefaccess			= "Non-aktifkan Pref";
$owl_lang->old_action_icons		= "Gunakan Lambang-lambang Tindakan Sebelum Owl 0.80";
$owl_lang->owl_anon_download     	= "Unduh Saja";
$owl_lang->owl_anon_full		= "Akses Penuh";
$owl_lang->owl_anon_ro			= "Baca Saja";
$owl_lang->owl_dbdump_path   		= "Jalur Alat Dump DB:"; //DB Dump Tool Path
$owl_lang->owl_def_file_group_owner	= "Grup Pemilik Berkas Asali :"; //Default File Group Owner
$owl_lang->owl_def_file_meta		= "Meta Data Berkas Asali:"; //Default File Meta Data
$owl_lang->owl_def_file_owner		= "Pemilik Berkas Asali:";
$owl_lang->owl_def_file_perm 		= "Kebijakan Pembuatan Berkas Asali:";
$owl_lang->owl_def_file_security	= "Keamanan Berkas Asali:";
$owl_lang->owl_def_file_title		= "Judul Berkas Asali (None untuk Nama Berkas):";
$owl_lang->owl_def_fold_group_owner	= "Grup Pemilik Map Asali:";
$owl_lang->owl_def_fold_owner		= "Pemilik Map Asali:";
$owl_lang->owl_def_fold_sec		= "Keamanan Map Asali:";
$owl_lang->owl_def_folder_perm 		= "Kebijakan Pembuatan Map Asali:";
$owl_lang->owl_default_tmpdir		= "Lokasi Direktori Berkas Sementara: ";
$owl_lang->owl_email_from		= "Alamat Dari:";
$owl_lang->owl_email_fromname		= "Nama Dari:";
$owl_lang->owl_email_replyto		= "Alamat Balas-Ke:";
$owl_lang->owl_email_server		= "Server SMTP:";
$owl_lang->owl_email_smtp		= "Gunakan Metode Pengiriman E-Mail SMTP";
$owl_lang->owl_email_smtp_auth		= "Gunakan Otentikasi SMTP";
$owl_lang->owl_email_smtp_auth_login	= "Log Masuk Otentikasi SMTP:";
$owl_lang->owl_email_smtp_auth_passwd	= "Kata Sandi Otentikasi SMTP";
$owl_lang->owl_email_subject_pref	= "Awalan Subyek:";
$owl_lang->owl_fogotpass		= "Tampilkan tautan lupa kata sandi:";
$owl_lang->owl_group_user		= "Pengguna-pengguna yang menjadi anggota Grup ini";
$owl_lang->owl_gzip_path     		= "Jalur gzip:";
$owl_lang->owl_hidebackup		= "Sembunyikan Direktori Cadangan:";
$owl_lang->owl_log_file			= "Log Aktifitas Berkas:";
$owl_lang->owl_log_login_act		= "Log Aktifitas Log Masuk/Log Keluar:";
$owl_lang->owl_log_rec_page		= "Jumlah Catatan per Halaman dalan Penglihat Log:";
$owl_lang->owl_logging			= "Aktifkan Pen-logging-an:";
$owl_lang->owl_logo			= "Logo Halaman Login ([Bahasa]/graphics):";
$owl_lang->owl_lookAtHD			= "Matikan Lihat ke hd:";
$owl_lang->owl_lookAtHDDel		= "Hapus Berkas-berkas yang Dihapus dari DB";
$owl_lang->owl_max_filesize		= "Ukuran Maksimum Berkas yang Di-upload (dalam byte)";
$owl_lang->owl_owl_expand		= "Tampilan Perambah Asali (Diperbesar)";
$owl_lang->owl_owl_timeout		= "Batas Waktu Sesi dalam Detik";
$owl_lang->owl_pdftotext_path		= "Kelola Indeks pencarian untuk <br />PDF dan Berkas-berkas teks<br />&#8211; Kosongkan untuk menon-aktifkan:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 atau Lebih Besar Dibutuhkan<br />Jalur ke pod2html:";
$owl_lang->owl_restrict_view		= "Aktifkan Fitur Tampilan Terbatas:";
$owl_lang->owl_self_reg			= "Aktifkan Daftar Mandiri:";
$owl_lang->owl_self_reg_hd		= "NILAI-NILAI ASALI PENGGUNA DAFTAR MANDIRI";
$owl_lang->owl_tar_path     		= "Jalur tar:";
$owl_lang->owl_title_browser		= "FITUR-FITUR PERAMBAH OWL";
$owl_lang->owl_title_custom		= "KUSTOMISASIKAN KOLOM-KOLOM PERAMBAH";
$owl_lang->owl_title_custom_search      = "KUSTOMISASIKAN HASIL PENCARIAN";
$owl_lang->owl_title_defaults   	= "ASALI-ASALI";
$owl_lang->owl_title_email		= "Pengaturan E-mail Sistem OWL";
$owl_lang->owl_title_HD			= "CARI PENGATURAN-PENGATURAN BERKAS-BERKAS DALAM DB";
$owl_lang->owl_title_logging  		= "PENGATURAN PEN-LOGGING-AN";
$owl_lang->owl_title_other		= "PENGATURAN LAINNYA";
$owl_lang->owl_title_tools   		= "PENCADANGAN DB/PERALATAN GZIP";
$owl_lang->owl_unzip_path     		= "Jalur unzip:";
$owl_lang->owl_version_control		= "Aktifkan Fitur Kendali Versi:";
$owl_lang->owl_wordtotext_path          = "Berkas-berkas MS-WORD<br />&#8211;Kosongkan untuk Menon-aktifkan:";
$owl_lang->owl_ppttotext_path          = "Berkas-berkas MS-POWERPOINT<br />&#8211;Kosongkan untuk Menon-aktifkan:";
$owl_lang->quota			= "Kuota 0=Dinon-aktifkan";
$owl_lang->reallydeluser		= "Pengguna ini adalah pemilik dari %numfiles% Berkas dan %numfolders% Map. Berkas-berkas dan Map-map ini nantinya akan tidak mempunyai pemilik. Tetap ingin dihapus?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Jumlah Catatan yang Ditampilkan per Halaman (0 = Dinon-akktifkan):";
$owl_lang->recycle_enabled		= "Aktifkan Pengumpulan Sampah:";
$owl_lang->recycle_location		= "Lokasi Tempat Sampah:";
$owl_lang->recycle_title		= "PENGATURAN PENGUMPULAN SAMPAH";
$owl_lang->remember_me			= "Perlihatkan tautan Ingat Saya";
$owl_lang->remember_me_checkbox		= "Ingat saya";
$owl_lang->remember_me_title		= "PENGATURAN LOG MASUK TERUS-MENERUS";
$owl_lang->remember_timeout		= "Kuki kadaluarsa dalam (hari)";
$owl_lang->restore_file_prefix		= "Teksm yang ditambahkan di awal berkas-berkas yang dipulihkan";
$owl_lang->search_result_folders	= "Sertakan map-map dalam Hasil Pencarian";
$owl_lang->show_action_title		= "Tampilkan tombol-tombol tindakan:";
$owl_lang->show_bulk_title		= "Tampilkan Tombol-tombol \"Sekaligus\":";
$owl_lang->show_folder_title		= "Tampilkan Alat-alat Map:";
$owl_lang->show_panel			= "Tampilkan";
$owl_lang->show_panel_title		= "Tampilkan Panel Status:";
$owl_lang->show_pref_title		= "Tampilkan Bilah Preferensi/log keluar:";
$owl_lang->show_search_title		= "Tampilkan Bilah Pencarian:";
$owl_lang->status_bar_both              = "Atas dan Bawah";
$owl_lang->status_bar_bottom            = "Bawah Saja";
$owl_lang->status_bar_location          = "Tampilkan bilah status di:";
$owl_lang->status_bar_not               = "Jangan Ditampilkan";
$owl_lang->status_bar_top               = "Atas Saja";
$owl_lang->use_popup			= "Gunakan Jendela Munculan untuk menampilkan Berita:";
$owl_lang->users           		= "Pengguna-pengguna";
$owl_lang->virus_path			= "Jalur Perangkat Lunak Pemeriksaan Virus<br />Misal: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Kosongkan untuk menon-aktifkan:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Bidang Isian Kustom di dalam Deskripsi Munculan";
$owl_lang->cust_headpopup     		= "BIDANG-BIDANG ISIAN SPESIFIK";
$owl_lang->auth_http                    = "Otentikasi HTTP (.htaccess)";
$owl_lang->auth_ldap                    = "Otentikasi LDAP";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Pengguna-pengguna yang memiliki grup ini sebagai Grup UTAMA";
$owl_lang->create_user_homedir 		= "Ciptakan Direktori Rumah untuk Tiap Pengguna:";
$owl_lang->use_captcha 			= "Gunakan CAPTCHA:";
$owl_lang->created_here 		= "<br /> (AKAN DIBUAT DISINI JIKA Ciptakan Direktori Rumah untuk Tiap Pengguna Dicentang)";
$owl_lang->auth_owl                     = "Otentikasi Owl";
$owl_lang->auth_pop3                    = "Otentikasi pop3";
$owl_lang->file_desc_required           = "Deskripsi Berkas Diperlukan";
$owl_lang->folder_desc_required         = "Deskripsi Map Diperlukan";
$owl_lang->html_title			= "Preferensi HTML";
$owl_lang->pass_account_lockout         = "Jumlah Usaha Log Masuk Sebelum Penguncian Akun:";
$owl_lang->pass_change_every            = "Paksakan Penggantian Kata Sandi Setiap (Hari) 0=Dinon-aktifkan:";
$owl_lang->pass_enable_account_lockout  = "Aktifkan Penguncian Akun:";
$owl_lang->pass_min_passwd_length       = "Panjang Minumum Kata Sandi Pengguna:";
$owl_lang->pass_min_passwd_numeric      = "Jumlah minimum karakter angka:";
$owl_lang->pass_min_passwd_special      = "Jumlah minimum Karakter Spesial:";
$owl_lang->pass_min_username_length     = "Panjang minimum Nama Pengguna:";
$owl_lang->pass_track_old_passwords     = "Jumlah dari kata sandi sebelumnya untuk dilacak:"; //Number of Previous Password to Keep Track
$owl_lang->rtftotext_path                = "Jalur Alat RTF ke Teks";
$owl_lang->show_user_info           = "Nama Pengguna yang Ditampilkan dapat Diklik";
$owl_lang->user_admin              = "Pengguna/ Grup Administrator"; //User/group Admininstrator
$owl_lang->user_auth_type                   = "Tipe Otentikasi:";
$owl_lang->user_change_pass_next_login      = "Ubah Kata Sandi pada Log Masuk Berikutnya:";
$owl_lang->user_expires                     = "Akun Kadaluarsa Pada:";
$owl_lang->user_gmt_offset              = "Selisih Waktu (GMT) Pengguna";
$owl_lang->user_group_admin                 = "Admin Berkas untuk Grup Utama:"; //File Admin for Primary Group
$owl_lang->user_login_to_newrecords         = "Log Masuk ke Halaman Catatan Baru:";
$owl_lang->users_group_admin		= "Pengguna-pengguna yang Admin Grup";
$owl_lang->time_offsets[0][0] = "-12";
$owl_lang->time_offsets[0][1] = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0] = "-11";
$owl_lang->time_offsets[1][1] = "(GMT-11:00) Midway Island, Samoa";
$owl_lang->time_offsets[2][0] = "-10";
$owl_lang->time_offsets[2][1] = "(GMT-10:00) Hawaii";
$owl_lang->time_offsets[3][0] = "-9";
$owl_lang->time_offsets[3][1] = "(GMT-9:00) Alaska";
$owl_lang->time_offsets[4][0] = "-8";
$owl_lang->time_offsets[4][1] = "(GMT-8:00) Waktu Pasifik (Amerika Serikat &amp; Kanada)";
$owl_lang->time_offsets[5][0] = "-7";
$owl_lang->time_offsets[5][1] = "(GMT-7:00)Waktu Pegunungan (Amerika Serikat &amp; Kanada)";
$owl_lang->time_offsets[6][0] = "-6";
$owl_lang->time_offsets[6][1] = "(GMT-6:00) Waktu Tengah (Amerika Serikat &amp; Kanada), Mexico City";
$owl_lang->time_offsets[7][0] = "-5";
$owl_lang->time_offsets[7][1] = "(GMT-5:00) Waktu Timur (Amerika Serikat &amp; Kanada), Bogota, Lima, Quito";
$owl_lang->time_offsets[8][0] = "-4";
$owl_lang->time_offsets[8][1] = "(GMT-4:00) Waktu Atlantik (Kanada), Karakas, La Paz";
$owl_lang->time_offsets[9][0] = "-3.5";
$owl_lang->time_offsets[9][1] = "(GMT-3:30) Newfoundland";
$owl_lang->time_offsets[10][0] = "-3";
$owl_lang->time_offsets[10][1] = "(GMT-3:00) Brazil, Buenos Aires, Georgetown";
$owl_lang->time_offsets[11][0] = "-2";
$owl_lang->time_offsets[11][1] = "(GMT-2:00) Atlantik Tengah";
$owl_lang->time_offsets[12][0] = "-1";
$owl_lang->time_offsets[12][1] = "(GMT-1:00) Azores, Cape Verde Islands";
$owl_lang->time_offsets[13][0] = "0";
$owl_lang->time_offsets[13][1] = "(GMT) Waktu Eropa Barat, London, Lisbon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) Waktu Eropa Tengah, Brussels, Copenhagen, Madrid, Paris";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) Waktu Eropa Timur, Kaliningrad, Afrika Selatan";
$owl_lang->time_offsets[16][0] = "3";
$owl_lang->time_offsets[16][1] = "(GMT+3:00) Baghdad, Kuwait, Riyadh, Moskow, St. Petersburg, Volgograd, Nairobi";
$owl_lang->time_offsets[17][0] = "3.5";
$owl_lang->time_offsets[17][1] = "(GMT+3:30) Teheran";
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
$owl_lang->time_offsets[24][1] = "(GMT+8:00) Beijing, Perth, Singapura, Hong Kong, Chongqing, Urumqi, Taipei";
$owl_lang->time_offsets[25][0] = "9";
$owl_lang->time_offsets[25][1] = "(GMT+9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk";
$owl_lang->time_offsets[26][0] = "9.5";
$owl_lang->time_offsets[26][1] = "(GMT+9:30) Adelaide, Darwin";
$owl_lang->time_offsets[27][0] = "10";
$owl_lang->time_offsets[27][1] = "(GMT+10:00) Standar Australia Timur, Guam, Papua Nugini, Vladivostok";
$owl_lang->time_offsets[28][0] = "11";
$owl_lang->time_offsets[28][1] = "(GMT+11:00) Magadan, Kepulauan Solomon, Kaledonia Baru";
$owl_lang->time_offsets[29][0] = "12";
$owl_lang->time_offsets[29][1] = "(GMT+12:00) Auckland, Wellington, Fiji, Kamchatka, Marshall Island";

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	= "Filter";
$owl_lang->owl_log_hd_action	= "Tindakan";
$owl_lang->owl_log_hd_agent	= "Agen";
$owl_lang->owl_log_hd_dt_tm	= "Tanggal Waktu";
$owl_lang->owl_log_hd_dtls	= "Perincian";
$owl_lang->owl_log_hd_file	= "Berkas";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Jalur Berkas";
$owl_lang->owl_log_hd_ip	= "IP / Alamat";
$owl_lang->owl_log_hd_user	= "Pengguna";
$owl_lang->owl_log_hide      	= "Sembunyikan: ";
$owl_lang->owl_log_no_rec	= " TIDAK ADA CATATAN YANG DITEMUKAN ";
$owl_lang->owl_log_viewer	= "Alat Penglihat Log";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Kosongkan Tempat Sampah";
$owl_lang->really_empty_trash	= "Anda yakin ingin mengosongkan tempat sampah?";
$owl_lang->recycle_bin_admin    = "Administrasi Tempat Sampah";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Berkas-berkas yang Anda minta \"area attached\".";//The files you requested area attached
$owl_lang->trash_email_subject  = "BERKAS-BERKAS YANG DIPULIHKAN YANG ANDA MINTA";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Tidak lakukan apa-apa &#8211; Biarkan hak-hak akses berkas"; //Leave file permissions alone
$owl_lang->everyoneread			= "Siapa saja dapat membaca/mengunduh";
$owl_lang->everyoneread_ad		= "Siapa saja dapat membaca/mengunduh";
$owl_lang->everyonewrite		= "Siapa saja dapat membaca/menulis/mengunduh";
$owl_lang->everyonewrite_ad		= "Siapa saja dapat membaca/menulis/mengunduh";
$owl_lang->everyonewrite_ad_nod		= "Siapa saja dapat membaca/menulis/mengunduh, TIDAK MENGHAPUS";
$owl_lang->everyonewrite_nod		= "Siapa saja dapat membaca/menulis/mengunduh, TIDAK MENGHAPUS";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Siapa saja dapat membaca map ini";
$owl_lang->geveryoneread_ad		= "Siapa saja dapat membaca map ini";
$owl_lang->geveryonewrite		= "Siapa saja dapat meng-upload berkas-berkas dan menghapus berkas ini";
$owl_lang->geveryonewrite_ad		= "Siapa saja dapat meng-upload berkas-berkas dan menghapus map ini";
$owl_lang->geveryonewrite_ad_nod	= "Siapa saja dapat meng-upload berkas-berkas ke map ini";
$owl_lang->geveryonewrite_nod		= "Siapa saja dapat meng-upload berkas-berkas ke map ini";
$owl_lang->ggroupread			= "Grup Anda dapat membaca map ini";
$owl_lang->ggroupread_ad		= "Grup yang dipilih dapat membaca map ini";
$owl_lang->ggroupwrite			= "Grup Anda dapat meng-upload berkas-berkas dan menghapus map ini";
$owl_lang->ggroupwrite_ad    		= "Grup yang dipilih dapat meng-upload berkas-berkas dan menghapus map ini";
$owl_lang->ggroupwrite_ad_nod		= "Grup yang dipilih dapat meng-upload berkas-berkas ke map ini";
$owl_lang->ggroupwrite_nod		= "Grup Anda dapat meng-upload berkas-berkas ke map ini";
$owl_lang->ggroupwrite_worldread 	= "Grup Anda dapat meng-upload berkas-berkas dan menghapus map ini &amp; orang yang lain dapat melihat isinya";
$owl_lang->ggroupwrite_worldread_ad 	= "Grup yang dipilih dapat meng-upload berkas-berkas dan menghapus map ini &amp; orang yang lain dapat melihat isinya";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Grup yang dipilih dapat meng-upload berkas-berkas ke map ini &amp; orang yang lain dapat melihat isinya, TIDAK MENGHAPUS";
$owl_lang->ggroupwrite_worldread_nod 	= "Grup Anda dapat meng-upload berkas-berkas ke map ini &amp; orang yang lain dapat melihat isinya, TIDAK MENGHAPUS";
$owl_lang->gonlyyou			= "Hanya Anda yang dapat meng-upload berkas-berkas dan menghapus map ini";
$owl_lang->gonlyyou_ad			= "Hanya Anda yang dapat meng-upload berkas-berkas dan menghapus map ini";
$owl_lang->groupread			= "Grup Anda dapat membaca/mengunduh";
$owl_lang->groupread_ad			= "Grup yang dipilih dapat membaca/mengunduh";
$owl_lang->groupwrite			= "Grup Anda dapat membaca/menulis/mengunduh";
$owl_lang->groupwrite_ad		= "Grup yang dipilih dapat membaca/menulis/mengunduh";
$owl_lang->groupwrite_ad_nod		= "Grup yang dipilih dapat membaca/menulis/mengunduh, TIDAK MENGHAPUS";
$owl_lang->groupwrite_nod		= "Grup Anda dapat membaca/menulis/mengunduh, TIDAK MENGHAPUS";
$owl_lang->groupwrite_worldread 	= "Grup Anda dapat membaca/menulis/mengunduh &amp; orang yang lain dapat membaca";
$owl_lang->groupwrite_worldread_ad 	= "Grup yang dipilih dapat membaca/menulis/mengunduh &amp; orang yang lain dapat membaca";
$owl_lang->groupwrite_worldread_ad_nod 	= "Grup yang dipilih dapat membaca/menulis/mengunduh (TIDAK MENGHAPUS) &amp; orang yang lain dapat membaca";
$owl_lang->groupwrite_worldread_nod 	= "Grup Anda dapat membaca/menulis/mengunduh (TIDAK MENGHAPUS) &amp; orang yang lain dapat membaca";
$owl_lang->invalidsess			= "ID sesi taksahih, silakan log masuk dari halaman utama<br />";
$owl_lang->notif_comment_1		= "dikomentari"; //commented on
$owl_lang->notif_comment_2		= "Komentar:";
$owl_lang->notif_msg         		= "INI ADALAH PESAN OTOMATIS DARI OWL Intranet<br /><br />Temukan berkas yang baru/termutakhirkan dilampirkan ke E-Mail ini<br /><br />"; //THIS IS AN AUTOMATED MESSAGE FROM OWL Intranet<br /><br />Find the new/updated file attached to this E-Mail<br /><br />
$owl_lang->notif_msg_alt         	= "INI ADALAH PESAN OTOMATIS DARI OWL Intranet\n\nTemukan berkas yang baru/termutakhirkan dilampirkan ke E-Mail ini\n\n";
$owl_lang->notif_msg_alt_link           = "INI ADALAH PESAN OTOMATIS DARI OWL Intranet\n\nTemukan sebuah tautan ke berkas yang baru/termutakhirkan dalam E-Mail ini\n\n";
$owl_lang->notif_msg_link               = "INI ADALAH PESAN OTOMATIS DARI OWL Intranet<br /><br />Temukan sebuah tautan ke berkas yang baru/termutakhirkan dalam E-Mail ini<br /><br />";
$owl_lang->notif_salutation		= "Assalamu 'alaikum warahmatullahi wabarakatuh";
$owl_lang->notif_subject_comment	= "Sebuah Berkas Intranet OWL -- Komentar Ditambahkan";
$owl_lang->notif_subject_monitor	= "Sebuah Berkas atau Map Intranet OWL yang Anda AWASI telah dimutakhirkan";
$owl_lang->notif_subject_new 		= "Berkas Intranet OWL Baru";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "Sebuah Berkas Intranet OWL telah dimutakhirkan";
$owl_lang->notif_subject_file_deleted   = "BERKAS TELAH DIHAPUS DARI TEMPAT PENYIMPANAN";
$owl_lang->notif_subj_new_account       = "SEBUAH AKUN OWL BARU TELAH DIBUAT UNTUK ANDA";
$owl_lang->notif_user			= "Dibuat/Dimutakhirkan oleh:";
$owl_lang->onlyyou			= "Hanya Anda dapat membaca/mengunduh/menulis";
$owl_lang->onlyyou_ad			= "Hanya Anda dapat membaca/mengunduh/menulis";
$owl_lang->orphaned			= "&#8211; TIDAK ADA Pemilik  &#8211;";
$owl_lang->owl_path			= "Jalur Berkas: ";
$owl_lang->sessinuse			= "Sesi ini sedang digunakan di komputer lain, akses ditolak<br />";
$owl_lang->sesstimeout			= "Sesi Anda telah berakhir, silakan log masuk kembali<br />";
$owl_lang->virus_infected 		= "BERKAS TERINFEKSI VIRUS";
$owl_lang->virus_return_val		= "Nilai Kembalian Program Virus:"; //Virus Program Return value
$owl_lang->watermark_string		= "Pribadi";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Rambah Map Ini";
$owl_lang->title_browse_site     	= "Rambah ke URL ini";
$owl_lang->title_download_view     	= "Unduh / Lihat Berkas Ini";
$owl_lang->title_edit_prefs     	= "Lihat / Edit preferensi Pengguna";
$owl_lang->title_return_folder     	= "Kembali ke";
$owl_lang->title_sort     		= "Urutkan berdasarkan";
$owl_lang->title_view_my     		= "Lihat Daftar Berkas Saya";
$owl_lang->title_view_new     		= "Lihat Daftar Berkas Baru Sejak Kunjungan Terakhir Saya";
$owl_lang->title_view_updated     	= "Lihat Daftar Berkas-berkas yang Dimutakhirkan Sejak Kunjungan Terakhir Saya";
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

$owl_lang->news_content			= "Isi";
$owl_lang->news_hd			= "Berita";
$owl_lang->news_hd_audience		= "Target Pembaca";
$owl_lang->news_hd_created		= "Dibuat Pada";
$owl_lang->news_hd_expires		= "Kadaluarsa Pada";
$owl_lang->news_heading			= "Judul Berita";
$owl_lang->news_posted_date		= "Berita Disampaikan:"; //News Posted
$owl_lang->news_read			= "Baca";
$owl_lang->news_title			= "Administrasi Berita";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: Direktori Documents OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." tidak ada.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: Direktori Documents OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." tidak dapat ditulisi oleh Server Web.";
$owl_lang->debug_file_not_exist		= "DEBUG: Berkas ynag dibutuhkan: &ldquo;$default->owl_fs_root/%s &rdquo; tidak ada.<br /> ATAU<br />jalur yang ditentukan \$default->owl_fs_root dalam config/owl.php salah.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: Direktori sementara OWL: $default->owl_tmpdir tidak ada.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: Direktori sementara OWL: $default->owl_tmpdir tidak dapat ditulisi oleh Server Web.";
$owl_lang->debug_webserver_no_access	= "DEBUG: Server web tidak memiliki hak akses baca ke: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Mohon perbaiki hak izin dan coba lagi";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Statistik / Alat Penglihat Laporan";
$owl_lang->stats_files		= "Jumlah Berkas per Pengguna";
$owl_lang->stats_folders	= "Jumlah Map per Pengguna";
$owl_lang->stats_information	= "Pen-logging-an Owl dan pen-logging-an berkas harus diaktifkan agar statistik ini dapat ditampilkan";
$owl_lang->stats_top		= "20 yang paling banyak diunduh";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Pengguna Masuk (Log masuk / Gagal / Log keluar)";
$owl_lang->stats_users_loggedin = "Sedang Log Masuk";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administrasi Tipe Dokumen";
$owl_lang->doc_field_label	= "Label Bidang Isian (Per Bahasa)";
$owl_lang->doc_field_name	= "Nama Bidang Isian";
$owl_lang->doc_field_pos	= "Posisi Bidang Isian";
$owl_lang->doc_field_required	= "Dibutuhkan?";
$owl_lang->doc_field_searchable	= "Dapat dicari?";
$owl_lang->doc_field_size	= "Ukuran Bidang Isian";
$owl_lang->doc_new_doc_type	= "&#8211; TAMBAHKAN Tipe Dokumen Baru &#8211;";
$owl_lang->doc_specific		= "BIDANG-BIDANG ISIAN SPESIFIK DOKUMEN:";
$owl_lang->document_type	= "Tipe Dokumen";
$owl_lang->document_type_name	= "Nama Tipe Dokumen";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Sisipkan dalam deskripsi munculan?";
$owl_lang->doc_field_disp_label = "LABEL BIDANG ISIAN:";
$owl_lang->doc_field_disp_sep = "LABEL PEMISAH";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;T&nbsp;A&nbsp;M&nbsp;P&nbsp;I&nbsp;L&nbsp;A&nbsp;N&nbsp;&nbsp;&nbsp;C&nbsp;O&nbsp;N&nbsp;T&nbsp;O&nbsp;H&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Tampilkan Perambah:"; //Display Browser
$owl_lang->doc_field_show_in_list = "Tampilkan Bidang Isian dalam Tampilan Rambah:";
$owl_lang->doc_field_type	= "Tipe Bidang Isian:";
$owl_lang->doc_field_values	= "Nilai-nilai Bidang Isian Dipisahkan Dengan | :";
$owl_lang->doc_fields = "Bidang-bidang Isian Kustom";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grup:";
$owl_lang->header_csv_import    = "Impor berkas Pengguna CSV";
$owl_lang->import_inserted      = "DISISIPKAN";
$owl_lang->import_skipped       = "DIABAIKAN"; //SKIPPED
$owl_lang->invalid_groupid      = "groupid taksahih --> ";
$owl_lang->msg_user_exists      = "Pengguna Sudah Ada";
$owl_lang->sendcsvfile          = "Upload berkas berbatas koma (CSV)";
$owl_lang->user_created_skipped = "Pengguna:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Aktifkan Fitur Ulasan Dokumen:"; //Enable Peer Review Feature
$owl_lang->owl_peer_review_opt  = "Buat Ulasan Dokumen Opsional:"; //Make Peer Review Optional
$owl_lang->owl_title_peer_review= "FITUR ULASAN DOKUMEN"; //DOCUMENT PEER REVIEW FEATURE
$owl_lang->owl_title_peer_review2= "Ulasan Dokumen"; //Document Peer Review
$owl_lang->peer_approval_title 	= "Dokumen yang Menunggu Persetujuan Saya";
$owl_lang->peer_approved_body	= "Berkas Anda telah disetujui:";
$owl_lang->peer_file_approved	= "Berkas disetujui:";
$owl_lang->peer_file_final	= "Persetujuan Akhir:";
$owl_lang->peer_file_rejected	= "Berkas Ditolak:";
$owl_lang->peer_file_to_review	= "Berkas untuk diulas:";
$owl_lang->peer_final_approval	= "[Persetujuan Akhir]: ";
$owl_lang->peer_final_body	= "Dokumen Anda telah disetujui oleh semua pengulas yang diminta.<br />Silakan log masuk dan jadikan dokumen menjadi berstatus publik<br />";
$owl_lang->peer_msg_to_reviewer	= "Pesan untuk Pengulas";
$owl_lang->peer_my_approval	= "Menunggu Persetujuan Saya";
$owl_lang->peer_notif_user	= "Dibuat/Dimutakhirkan oleh";
$owl_lang->peer_pending_approval= "Persetujuan Ditunda Saya"; //My Pending Approval
$owl_lang->peer_pending_title 	= "Persetujuan Ditunda Dokumen Saya"; //My Documents Pending Approval
$owl_lang->peer_reject_reason   = "Alasan Penolakan";
$owl_lang->peer_rejected_body	= "Berkas Anda telah ditolak:";
$owl_lang->peer_review_body	= "Persetujuan Anda telah diminta untuk dokumen berikut:";
$owl_lang->peer_reviewer_list	= "Pengulas";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_satus_approved  = "&#8212; D I S E T U J U I &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; D I T U N D A &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; D I T O L A K &#8212;";
$owl_lang->peer_subj_approved	= "Dokumen Anda telah DISETUJUI";
$owl_lang->peer_subj_rejected	= "Dokumen Anda telah DITOLAK";
$owl_lang->peer_subj_reminder	= "PENGNGAT: Anda memiliki sebuah berkas untuk diulas";
$owl_lang->peer_subj_review	= "Anda memiliki sebuah berkas untuk diulas";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Dokumen Anda telah disetujui oleh semua pengulas yang diminta.<br />Berkas Anda telah dijadikan berstatus publik.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Menambahkan Berkas ACL:";
$owl_lang->acl_adding_folder           = "menambahkan Map ACL:";
$owl_lang->acl_available_groups        = "Grup(-grup) yang Tersedia";
$owl_lang->acl_available_users         = "Pengguna(-pengguna) yang Tersedia";
$owl_lang->acl_edit_file               = "Mengedit Berkas ACL:";
$owl_lang->acl_edit_folder             = "Mengedit Map ACL:";
$owl_lang->acl_file_checkin            = "Selidiki/Lepaskan"; //Check In/Out
$owl_lang->acl_file_comment            = "Komentar";
$owl_lang->acl_file_copy               = "Salin";
$owl_lang->acl_file_delete             = "Hapus";
$owl_lang->acl_file_email              = "E-Mail";
$owl_lang->acl_file_modify             = "Properti";
$owl_lang->acl_file_monitor            = "Awasi";
$owl_lang->acl_file_move               = "Pindah";
$owl_lang->acl_file_read               = "Baca";
$owl_lang->acl_file_search             = "Cari yang Berkaitan";
$owl_lang->acl_file_set_acl            = "TetapkanACL";
$owl_lang->acl_file_update             = "Mutakhirkan";
$owl_lang->acl_file_view_log           = "Lihat Log";
$owl_lang->acl_folder_copy             = "Salin";
$owl_lang->acl_folder_delete           = "Hapus";
$owl_lang->acl_folder_modify           = "Modifikasi Properti";
$owl_lang->acl_folder_monitor          = "Awasi";
$owl_lang->acl_folder_move             = "Pindah";
$owl_lang->acl_folder_read             = "Baca (Unduh/Rambah)";
$owl_lang->acl_folder_set_acl          = "Tetapkan ACL";
$owl_lang->acl_folder_write            = "Tulis (Buat)";
$owl_lang->acl_heading_file            = "Grup(-grup)/Pengguna(-pengguna)";
$owl_lang->acl_heading_files           = "BERKAS-BERKAS &#8211; PILIH PENGGUNA(-PENGGUNA) DAN GRUP(-GRUP) YANG DIKEHENDAKI";
$owl_lang->acl_heading_folder          = "Grup(-grup)/Pengguna(-pengguna)";
$owl_lang->acl_heading_folders         = "MAP-MAP &#8211; PILIH PENGGUNA(-PENGGUNA) DAN GRUP(-GRUP) YANG DIKEHENDAKI";
$owl_lang->acl_propagate_file          = "Tetapkan Kebijakan Ini pada \"SEMUA\" Berkas:";
$owl_lang->acl_propagate_folders       = "Propagate ke semua map didalamnya:"; //Propagate to all subfolder(s)
$owl_lang->acl_selected_groups         = "Grup(-grup) yang Dipilih";
$owl_lang->acl_selected_users          = "Pengguna(-pengguna) yang Dipilih";
$owl_lang->acl_set_acl                 = "Tetapkan Kebijakan Keamanan";
$owl_lang->acl_set_acl_now             = "Tetapkan Kebijakan Keamanan Sekarang:";
$owl_lang->acl_set_selected            = "Tetapkan yang Dipilih";
$owl_lang->alt_acl_save_file           = "Simpan Kebijakan Keamanan Berkas";
$owl_lang->alt_acl_save_folder         = "Simpan Kebijakan Keamanan Map";
$owl_lang->btn_acl_save                = "Simpan";
$owl_lang->acl_set_file_permissions    = "Tetapkan Hak Akses Berkas";
$owl_lang->acl_set_folder_permissions  = "Tetapkan Hak Akses Map";
$owl_lang->alt_set_folder_acl	       = "Tetapkan Kebijakan Keamanan Map Saat Ini";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Laporan yang Tersedia:";
$owl_lang->report_file_folder               = "Berkas/Map";
$owl_lang->report_filter                    = "Filter:";
$owl_lang->report_filter_since              = "Sejak:";
$owl_lang->report_full_access               = "AKSES PENUH";
$owl_lang->report_select_report             = "&#8211; Pilih sebuah Laporan &#8211;";
$owl_lang->report_users_disabled_title      = "Pengguna(-pengguna) yang Dinon-aktifkan";
$owl_lang->report_users_entitlement         = "Daftar Akses Pengguna";
$owl_lang->report_users_inactive_title      = "Pengguna(-pengguna) yang Tidak Aktif Sejak";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Aktifkan Tampilan/Pembuatan Thumbnail:";
$owl_lang->thumb_gen_thumb_tool_path       = "Jalur ke Alat pengubah ImageMagick:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Parameter-parameter Mplayer:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Jalur ke Mplayer:";
$owl_lang->thumb_image_info                = "Info Gambar";
$owl_lang->thumb_large_width               = "Lebar Thumbnail  (BESAR) Piksel:";
$owl_lang->thumb_med_width                 = "Lebar Thumbnail(SEDANG) Piksel:";
$owl_lang->thumb_number_colums             = "Jumlah Kolom untuk Tampilan Thumbnail:";
$owl_lang->thumb_re_generate               = "Ciptakan Thumbnail";
$owl_lang->thumb_small_width               = "Lebar Thumbnail (KECIL) 0=Jangan Tampilkan Piksel:";
$owl_lang->thumb_title                     = "OPSI-OPSI TAMPILAN/PEMBUATAN THUMBNAIL";
$owl_lang->thumb_title_thumb_view          = "PERINCIAN TAMPILAN THUMBNAIL";
$owl_lang->thumb_image_size                = "Ukuran Gambar:";
$owl_lang->alt_thumb_small                 = "Thumb Nail Kecil";
$owl_lang->alt_no_thumb                    = "Tidak Ada Thumb Nail yang Tersedia";

//********************************************************
// THUMBNAILS END
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
