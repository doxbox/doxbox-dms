<?php

/*
 * file : Bosnian/language.inc
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Author: Nermin Kantic <nerko@jelah.ba>
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
// POCETAK Formatiranja Datuma i Vremena
//********************************************************

// If config/owl.php   $default->generic_date_format is set USE That one if not
// use the one in this file

if (isset($default->generic_date_format) && trim($default->generic_date_format) != "") {

	$owl_lang->localized_date_format = $default->generic_date_format;
} else {
	$owl_lang->localized_date_format = "d.m.Y H:i";
}

// Koristeni Encoding  
// osnovni: "UTF-8"
$owl_lang->charset = "UTF-8";

// Sifra (Code) Jezika
// primjer: "en"
$owl_lang->lang_code = "bs";

//********************************************************
// KRAJ Formatiranja Datuma i Vremena
//********************************************************

//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "Nemate prava za dodavanje komentara za ovaj FAJL";
$owl_lang->err_backup_file   		= "Greska u BACKUPu postojeceg fajla";
$owl_lang->err_backup_folder_create 	= "Greska u kreiranju BACKUP direktorija";
$owl_lang->err_bad_url			= "Molim unesite ispravan URL";
$owl_lang->err_bad_version_1 		= "Najniza podrzana PHP verzija za OWL";
$owl_lang->err_bad_version_2 		= "Instalirana verzija";
$owl_lang->err_bad_version_3 		= "Molim instalirajte noviju verziju PHPa i pokusajte ponovo";
$owl_lang->err_comment_empty		= "Polje za Komentar ne moze biti prazno";
$owl_lang->err_email         		= "Poruka ne moze biti poslana";
$owl_lang->err_email_required		= "E-Mail polje je neophodno";
$owl_lang->err_fexist1			= "<b>FAJL postoji:</b>";
$owl_lang->err_fexist2 			= "Vec postoji FAJL sa imenom <i>";
$owl_lang->err_fexist3 			= "</i> u ovom DIREKTORIJU.";
$owl_lang->err_file_exists		= "FAJL koji pokusavate usnimiti vec postoji";
$owl_lang->err_file_lock     		= "NE MOZETE zakljucati ovaj fajl, trenutno je zauzet od strane : ";
$owl_lang->err_file_not_exist		= "FAJL NE POSTOJI u sistemu";
$owl_lang->err_file_too_big		= "php maksimalna velicina fajla je prekoracena i/ili<br />Owl Max Upload velicina fajla";
$owl_lang->err_file_update		= "Nadogradnja fajla zahtijeva da ime fajla ostane isto, pokusajte ponovo koristeci isto ime";
$owl_lang->err_fileexists    		= "Premjestanje je prekinuto<br />FAJL sa istim imenom vec postoji.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "IME koje pokusavate dati ovom fajlu, vec postoji";
$owl_lang->err_folder_create 		= "Greska u kreiranju DIREKTORIJA";
$owl_lang->err_folder_exist		= "DIREKTORIJ vec postoji";
$owl_lang->err_folderexists  		= "Doslo je do greske prilikom promjene imena<br />DIREKTORIJ sa tim imenom vec postoji.";
$owl_lang->err_general 			= "Doslo je do greske";
$owl_lang->err_select_reviewer		= "Molim oznacite barem jednu osobu za koja ce ocijeniti vas dokument";
$owl_lang->err_update_file_lock     	= "NE MOZETE nadograditi ovaj fajl, trenutno je zauzet od strane : ";
$owl_lang->err_group_delete             = "Ne mogu izbrisati ovu Grupu: <font color=\"red\">%d</font> Fajl(ova),  <font color=\"red\">%d</font> Direktorij(a), <font color=\"red\">%d</font> Korisnik(s) sa ovom Grupom kao Primarnom, <font color=\"red\">%d</font> Korisnik(a) clanova ove grupe";
$owl_lang->err_cant_del_doc_type	= "NE MOZETE BRISATI, postoje dokumenti koji koriste ovu oznaku";
$owl_lang->err_database			= "Greska kod baze podataka";
$owl_lang->err_doc_field_req            = "Nedostaje neophodno polje:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Naziv TIPA DOKUMENTA je neophodan <br />";
$owl_lang->err_field_label_req 		= "Polje LABELA je neophodno <br />";
$owl_lang->err_field_name_req		= "Polje IME je neophodno <br />";
$owl_lang->err_field_size_req		= "Polje VELICINA je neophodno <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Greska u kreiranju privremenog 'TEXT' Fajla";
$owl_lang->err_forbidden_file		= "ZABRANJEN tip fajla";
$owl_lang->err_group_exists		= "Vec postoji grupa sa tim imenom.";
$owl_lang->err_gzip_not_found  		= "gzip nije pronadjen u ";
$owl_lang->err_login			= "Molim logirajte se za ovu operaciju";
$owl_lang->err_movecancel    		= "Premjestanje je prekinuto<br />";
$owl_lang->err_nameempty    		= "IME DIREKTORIJA ne moze biti prazno";
$owl_lang->err_news_required		= "GRESKA: Naslov i sadrzaj novosti su neophodni!";
$owl_lang->err_no_access 		= "Nemate pravo pristupa ni jednom od oznacenih fajlova";
$owl_lang->err_no_access_info 		= "Moguci uzroci: <br />1) Niste oznacili ni jedan fajl ili direktorij<br />2) MASS Brisanje, MASS E-mail, MASS Zakljucavanje se ne odnose na DIREKTORIJE<br />3) Jednostavno nemate pravo pristupa.";
$owl_lang->err_noemail			= "Nemate pravo slati ovaj fajl na mail";
$owl_lang->err_nofileaccess		= "Nemate pravo pristupa ovom fajlu";
$owl_lang->err_nofiledelete		= "Nemate pravo izbrisati ovaj fajl";
$owl_lang->err_nofilemod		= "Nemate pravo mijenjati ovaj fajl";
$owl_lang->err_nofolderaccess		= "Nemate pravo pristupa ovom direktoriju";
$owl_lang->err_nofolderdelete		= "Nemate pravo brisati ovaj direktorij";
$owl_lang->err_nofoldermod		= "Nemate pravo mijenjati ovaj direktorij";
$owl_lang->err_nosubfolder		= "Nemate pravo kreirati poddirektorije ovdje";
$owl_lang->err_not_zip			= "Neispravna ZIP arhiva";
$owl_lang->err_note_title               = "NAZIV je neophodno polje";
$owl_lang->err_note_title_exists        = "Napomena pod ovom oznakom vec postoji";
$owl_lang->err_noupload			= "Nemate pravo usnimavanja dokumenata u ovaj direktorij";
$owl_lang->err_pass_missmatch		= "NOVA SIFRA i POTVRDNA SIFRA se ne slazu";
$owl_lang->err_pass_wrong    		= "Stara sifra nije ispravna";
$owl_lang->err_please_select_bulk	= "Molim oznacite barem, jedan FAJL ili DIREKTORIJ koristeci kukice";
$owl_lang->err_pod2html_not_found       = "GRESKA: pod2html alat nije pronadjen:";
$owl_lang->err_quota			= "Nemate dovoljno prostora sa usnimavanje ovog fajla: ";
$owl_lang->err_quota_needed		= " potrebno ";
$owl_lang->err_quota_avail		= " slobodno.";
$owl_lang->err_quota_exceed  		= "Prekoracili ste svoj limit";
$owl_lang->err_req			= "GRESKA: Sva polja su neophodna";
$owl_lang->err_root_delete		= "NE MOZETE IZBRISATI GLAVNI DIREKTORIJ";
$owl_lang->err_sess_notvalid 		= "ID broj sesije nije validan";
$owl_lang->err_sess_write		= "Greska pri upisu podataka o sesiji u bazu";
$owl_lang->err_specialfoldername 	= "'backup' je rezervisan naziv FODLERA od strane OWL-a, izaberite drugo ime";
$owl_lang->err_sql			= "SQL greska";
$owl_lang->err_tar_not_found  		= "tar nije pronadjen u ";
$owl_lang->err_trash_can_empty 		= "Kanta za Smece je prazna";
$owl_lang->err_unauth_area   		= "Niste ovlasteni za koristenje ove zone";
$owl_lang->err_unauthorized  		= "NEOVLASTEN PRISTUP";
$owl_lang->err_upload 			= "Greska pri usnimavanju";
$owl_lang->err_user_exists		= "Korisnicko ime postoji";
$owl_lang->err_captcha_auth		= "CAPTCHA sigurnosna provjera nije zadovoljena";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Dodaj Polje";
$owl_lang->btn_add_file          = "Dodaj Dokument";
$owl_lang->btn_add_folder          = "Dodaj Direktorij";
$owl_lang->btn_add_news          = "Dodaj Novost";
$owl_lang->btn_add_note          = "Dodaj Napomenu";
$owl_lang->btn_add_url          = "Dodaj Url";
$owl_lang->btn_add_zip           = "Dodaj Arhivu";
$owl_lang->btn_admin      = "Admin";
$owl_lang->btn_admin_groups          = "Nova Grupa";
$owl_lang->btn_admin_news          = "Admin <br />Novosti ";
$owl_lang->btn_admin_user_group          = "Administrator Korisnika/Grupa";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Novi korisnik";
$owl_lang->btn_back          = "Nazad";
$owl_lang->btn_browse     = "Browse";
$owl_lang->btn_bulk_checkout       = "MASS Zakljucavanje";
$owl_lang->btn_bulk_delete         = "Mass brisanje";
$owl_lang->btn_bulk_download          = "Mass Download";
$owl_lang->btn_bulk_email          = "Mass E-Mail";
$owl_lang->btn_bulk_move          = "Mass Premjestanje";
$owl_lang->btn_cancel          = "Prekini";
$owl_lang->btn_clickhere          = "Klikni ovdje";
$owl_lang->btn_collapse_view          = "Smanjeni Pogled";
$owl_lang->btn_create          = "Kreiraj";
$owl_lang->btn_default_view          = "Osnovni Pogled";
$owl_lang->btn_deldoctype          = "Izbrisi TIP Dokumenta";
$owl_lang->btn_download_bulk_package	= "za preuzimanje MASS download paketa";
$owl_lang->btn_edit_group          = "Ispravi Grupu";
$owl_lang->btn_edit_user          = "Ispravi Korisnika";
$owl_lang->btn_expand_view          = "Prosireni Pogled";
$owl_lang->btn_go_bottom      = "Idi na DNO";
$owl_lang->btn_go_top      = "Idi na VRH";
$owl_lang->btn_help     = "Pomoc";
$owl_lang->btn_import_users  = "Uvoz (Import) korisnika";
$owl_lang->btn_login          = "Login";
$owl_lang->btn_logout     = "Logout";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_register          = "Registruj";
$owl_lang->btn_reset          = "Ponisti";
$owl_lang->btn_send_email          = "Posalji E-Mail";
$owl_lang->btn_submit          = "Proslijedi";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Thumbnail";
$owl_lang->btn_trash_admin          = "Smece";
$owl_lang->btn_export          = "Export (Izvoz)";
$owl_lang->btn_gen_pdf          = "Generiraj PDF";
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_updated          = "Dokument je NADOGRADJEN od vase zadnje posjete";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new              = "Dokument KREIRAN poslije vase zadnje posjete";
$owl_lang->alt_add_comments     = "Dodaj komentar za ovaj FAJL";
$owl_lang->alt_add_field	= "Dodaj Polje IZNAD";
$owl_lang->alt_add_news		= "Dodaj novu Novost";
$owl_lang->alt_add_user		= "Kreiraj ovog KORISNIKA";
$owl_lang->alt_admin_flush      = "Izbrisi Zaostale/Istekle SESIJE";
$owl_lang->alt_add_group	= "Kreiraj Novu Grupu";
$owl_lang->alt_admin_users	= "Kreiraj Novog Korisnika";
$owl_lang->alt_approve_file 	= "Odobri ovaj DOKUMENT";
$owl_lang->alt_back      	= "Nazad na prethodni ekran";
$owl_lang->alt_btn_add_file     = "Usnimi novi fajl";
$owl_lang->alt_btn_add_folder	= "Kreiraj novi DIREKTORIJ";
$owl_lang->alt_btn_add_note     = "Dodaj novu NAPOMENU";
$owl_lang->alt_btn_add_url	= "Kreiraj novi WEB link";
$owl_lang->alt_btn_add_zip     	= "Usnimi ZIP fajl koji ce biti raspakovan";
$owl_lang->alt_btn_admin 	= "OWL Administracija";
$owl_lang->alt_btn_browse	= "Povratak na Preglednik";
$owl_lang->alt_btn_bulk_checkout= "MASS zakljucavanje fajlova";
$owl_lang->alt_btn_bulk_delete 	= "MASS Brisanje fajlova";
$owl_lang->alt_btn_bulk_download= "MASS download fajlova";
$owl_lang->alt_btn_bulk_email  	= "MASS slanje fajlova na mail";
$owl_lang->alt_btn_bulk_move   	= "MASS premjestanje fajlova i/ili direktorija";
$owl_lang->alt_btn_clickhere	= "Klikni ovdje";
$owl_lang->alt_btn_collapse_view= "Prebaci na reducirani pogled";
$owl_lang->alt_btn_default_view = "Prebaci na Standardni pogled";
$owl_lang->alt_btn_expand_view  = "Prebaci na prosireni pogled";
$owl_lang->alt_btn_help		= "OWL OnLine Pomoc";
$owl_lang->alt_btn_login	= "Logiraj se na OWL";
$owl_lang->alt_btn_logout	= "OD-Logiraj se sa OWL-a";
$owl_lang->alt_btn_mail_tool   	= "Prosti E-mail alat";
$owl_lang->alt_btn_thumb_view   = "Prebaci na THUMBNAIL pogled";
$owl_lang->alt_cancel		= "Prekini ovu Akciju";
$owl_lang->alt_cancel_move	= "Prekini akciju premjestanja";
$owl_lang->alt_change		= "Nadogradi ovaj zapis";
$owl_lang->alt_comments 	= "Postoje komentari za ovaj fajl";
$owl_lang->alt_copy_file     	= "Kopiraj fajl";
$owl_lang->alt_copy_folder   	= "Kopiraj direktorij";
$owl_lang->alt_del_all		= "Baci smece";
$owl_lang->alt_del_comments     = "Brisi ovaj komentar";
$owl_lang->alt_del_field	= "Brisi ovo polje";
$owl_lang->alt_del_file      	= "Brisi fajl (Y/N)";
$owl_lang->alt_del_folder    	= "Brisi direktorij (Y/N)";
$owl_lang->alt_del_group	= "Brisi ovu grupu";
$owl_lang->alt_del_news		= "Brisi ovu Novost";
$owl_lang->alt_del_selected	= "Brisi sve oznacene fajlove";
$owl_lang->alt_del_this_folder	= "Brisi direktorij &#8211; ";
$owl_lang->alt_del_user		= "Izbrisi ovog korisnika";
$owl_lang->alt_deldoctype	= "Brisi sadasnji TIP dokumenta";
$owl_lang->alt_edit_field	= "Izmjeni definiciju ovog polja";
$owl_lang->alt_edit_group       = "Izmjeni oznacenu grupu";
$owl_lang->alt_edit_news	= "Izmjeni ovu Novost";
$owl_lang->alt_edit_user        = "Izmijeni podatke oznacenog korisnika";
$owl_lang->alt_email		= "Posalji ovaj fajl na E-Mail";
$owl_lang->alt_email_reminder 	= "E-Mail Podsjetnik";
$owl_lang->alt_email_selected	= "Posalji sve oznacene fajlove na e-mail";
$owl_lang->alt_get_file      	= "Preuzmi Fajl";
$owl_lang->alt_get_folder      	= "Preuzmi sadrzaj direktorija";
$owl_lang->alt_go_bottom      	= "Idi na dno stranice";
$owl_lang->alt_go_top 		= "Idi na vrh stranice";
$owl_lang->alt_have_news	= "Imate Novost(i) za pregled";
$owl_lang->alt_have_no_news	= "Nemate novih Novosti";
$owl_lang->alt_home_folder	= "Nazad na inicijalni direktorij ";
$owl_lang->alt_link_file     	= "Linkuj ovaj fajl na drugi direktorij";
$owl_lang->alt_lock_file        = "Zakljucaj fajl";
$owl_lang->alt_log_clear        = "Izbsiri LOG-ove (Y/N)";
$owl_lang->alt_log_file         = "LOG Fajla";
$owl_lang->alt_log_next		= "Prikazi sljedece zapise";
$owl_lang->alt_log_prev		= "Prikazi prethodne zapise";
$owl_lang->alt_log_top		= "Idi na prvi zapis";
$owl_lang->alt_mod_file      	= "Izmjeni osobine FAJLA"; 
$owl_lang->alt_mod_folder    	= "Izmjeni osobine DIREKTORIJA";
$owl_lang->alt_monitor_folder	= "Nadgledaj ovaj direktorij";
$owl_lang->alt_monitored_folder	= "Stopiraj nadgledanje ovog direktorija";
$owl_lang->alt_monitor		= "Nadgledaj ovaj fajl";
$owl_lang->alt_monitored	= "Stopiraj nadgledanje ovog fajla";
$owl_lang->alt_move_file     	= "Premjesti FAJL";
$owl_lang->alt_move_folder   	= "Premjesti Direktorij";
$owl_lang->alt_move_selected	= "Premjesti sve oznacene fajlove";
$owl_lang->alt_my_approval	= "Dokument(i) Cekaju moje odobrenje";
$owl_lang->alt_new_doctype	= "Kreiraj novi tip dokumenta";
$owl_lang->alt_news_close	= "Zatvori prozor NOVOSTI";
$owl_lang->alt_news_next	= "Sljedeca Novost";
$owl_lang->alt_news_prev	= "Prethodna Novost";
$owl_lang->alt_news_print	= "Stampaj ovu Novost";
$owl_lang->alt_pending_approval	= "Dokument(i) U procesu odobravanja";
$owl_lang->alt_play_file 	= "EMITUJ Media Fajl";
$owl_lang->alt_publish_file 	= "Neka dokument bude JAVAN";
$owl_lang->alt_recycle		= "Kanta za smece<br />(isprazni)";
$owl_lang->alt_recycle_disable	= "Cuvanje izbrisanih dokumenata (kanta za smece)<br />(onemoguceno)";
$owl_lang->alt_recycle_not_found= "Kanta za smece<br />(nije nadjena)";
$owl_lang->alt_refresh_filter	= "Inicijalizacija filtera / Osvjezi rezultate";
$owl_lang->alt_register		= "Posalji svoji registraciju";
$owl_lang->alt_reject_file 	= "Odbij ovaj dokument";
$owl_lang->alt_related		= "Pronadji slicne dokumente";
$owl_lang->alt_reset_form	= "Ponisti vrijednosti forme";
$owl_lang->alt_rest_selected	= "Vrati sve oznacene fajlove";
$owl_lang->alt_search		= "Iniciraj pretragu";
$owl_lang->alt_send_email	= "Posalji E-Mail";
$owl_lang->alt_sendfile		= "Posalji fajl";
$owl_lang->alt_set_initial_dir	= "Postavi trenutni direktorij kao inicijalni";
$owl_lang->alt_site_map         = "MAPA sajta";
$owl_lang->alt_submit      	= "Proslijedi Formu";
$owl_lang->alt_toggle_check_box	= "Toggle Check Boxes";
$owl_lang->alt_tool_status_red	= "PATH je neispravan i/ili neIZVRSIV";
$owl_lang->alt_tool_status_green= "Alat je aktivan";
$owl_lang->alt_unlock_file      = "Otkljucaj fajl";
$owl_lang->alt_upd_field	= "Nadogradi ovo polje";
$owl_lang->alt_upd_file      	= "Nadogradi fajl";
$owl_lang->alt_view_comments    = "Dodaj / Vidi komentare Fajla";
$owl_lang->alt_view_file     	= "Vidi Fajl";
$owl_lang->alt_btn_trash_admin = "Administracija Kante Za Smece";
$owl_lang->alt_edit_file_inline = "Izmijeni tekstualni fajl";
$owl_lang->alt_gen_pdf          = "Generiraj PDF verziju gornjeg Fajla";

//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Cijeli sadrzaj je takodje izbrisan";
$owl_lang->log_detail		= "Nema dodatnih detalja";
$owl_lang->log_file_to		= "ZA: ";
$owl_lang->log_filter_all	= "SVE";
$owl_lang->log_login_det	= "Korisnicko ime: ";
$owl_lang->log_admin_changed_group = "Izmjenjena Grupa: ";
$owl_lang->log_admin_changed_user = "Izmjenjen Korisnik: ";
$owl_lang->log_admin_created_group = "Kreirana Grupa: ";
$owl_lang->log_admin_created_user = "Kreiran Korisnik: ";
$owl_lang->log_admin_del_group = "Izbrisana Grupa: ";
$owl_lang->log_admin_del_user = "Izbrisan Korisnik: ";
$owl_lang->log_admin_disabled = " Onemogucen Korisnik: ";
$owl_lang->log_admin_email_restore = "Fajlovi poslani na Mail:";
$owl_lang->log_admin_trash_delfile= "Izbrisan Fajl: ";
$owl_lang->log_admin_trash_delfold = "Izbrisan DIREKTORIJ: ";
$owl_lang->log_admin_trash_empty = "Baceno Smece";
$owl_lang->log_admin_trash_restore = "Vraceno: ";
$owl_lang->log_login_expired    = "Korisnik sa isteklim vremenom: ";
$owl_lang->log_login_too_many_attempts = "Onemogucen (previse neuspijesnih pokusaja logiranja): ";
$owl_lang->log_readhd_feature_add  = "Read HD Mogucnost je Dodala ovaj fajl";
$owl_lang->log_admin_to  = "za";
$owl_lang->log_admin_of  = "od";
$log_file_actions[1]        	= "LOGIN";
$log_file_actions[2]        	= "LOGIN NEUSPJESAN";
$log_file_actions[3]        	= "LOGOUT";
$log_file_actions[4]        	= "FAJL IZBRISAN";
$log_file_actions[5]        	= "USNIMAVANJE FAJLA";
$log_file_actions[6]        	= "FAJL NADOGRADJEN";
$log_file_actions[7]        	= "FAJL PREUZET";
$log_file_actions[8]        	= "FAJL IZMIJENJEN";
$log_file_actions[9]        	= "FAJL ZAKLJUCAN";
$log_file_actions[10]        	= "FAJL OTKLJUCAN";
$log_file_actions[11]        	= "FAJL POSLAN NA MAIL";
$log_file_actions[12]        	= "FAJL PREMJESTEN";
$log_file_actions[13]        	= "DIREKTORIJ KREIRAN";
$log_file_actions[14]        	= "DIREKTORI IZBRISAN";
$log_file_actions[15]        	= "DIREKTORIJ IZMJENJEN";
$log_file_actions[16]        	= "DIREKTORIJ PREMJESTEN";
$log_file_actions[17]        	= "ZABORAVILI SIFRU";
$log_file_actions[18]        	= "REGISTRACIJA KORISNIKA";
$log_file_actions[19]           = "FAJL PREGLEDAN";
$log_file_actions[20]           = "FAJL VIRUS";
$log_file_actions[21]           = "FAJL KOPIRAN";
$log_file_actions[22]           = "DIREKTORIJ KOPIRAN";
$log_file_actions[23]           = "FAJL_LINKAN";
$log_file_actions[24]           = "ADMIN Korisnika";
$log_file_actions[25]           = "Kanta za Smece";
$log_file_actions[26]           = "FAJL Sigurnosne opcije";
$log_file_actions[27]           = "DIREKTORIJ Sigurnosne opcije";
$log_file_actions[28]           = "FOLDER DISTRIBUTE";
$log_file_actions[29]           = "FOLDER LINKED";
$log_file_actions[30]           = "FILE REVIEW";
$log_file_actions[31]           = "FILE APPROVED";
$log_file_actions[32]           = "FILE REJECTED";
$log_file_actions[33]           = "FILE PUBLISHED";


//********************************************************
// Owl Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

$owl_lang->admin_login_date  = "ADMIN Korisnik logiran: ";
$owl_lang->admin_login_from  = "ADMIN Korisnik logoran sa";
$owl_lang->admin_login_subject  = "Logiranje ADMIN Korisnika";
$owl_lang->anonymous 		= "(Anonimni pristup)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Zaboravili ste sifru?";
$owl_lang->like_register	= "Zelite se registrovati?";
$owl_lang->login		= "Login";
$owl_lang->loginfail		= "Greska u logiranju";
$owl_lang->logindisabled	= "Korisnicko ime je blokirano, kontaktirajte administratora";
$owl_lang->password		= "Sifra";
$owl_lang->repository_list      = "Box:";
$owl_lang->successlogout 	= "Uspjesno ste OD-Logirani";
$owl_lang->toomanysessions	= "Dostignut je broj maksimalnih sesija za korisnika, kontaktirajte administratora";
$owl_lang->username		= "Korisnik";
$owl_lang->version 		= "Verzija";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Akcije";
$owl_lang->current_db         		= "Trenutni Box:";
$owl_lang->current_folder 		= "Trenutni Direktorij:";
$owl_lang->del_selected			= "Izbrisi oznaceno";
$owl_lang->del_all			= "Izbaci smece";
$owl_lang->disk_quota			= "Disk limit";
$owl_lang->doc_number 			= "Dok. broj";
$owl_lang->email_selected		= "Posalji oznaceno na E-Mail";
$owl_lang->file 			= "Fajl";
$owl_lang->folder_count_pre		= "Ovaj DIREKTORIJ sadrzi";
$owl_lang->folder_count_folder		= "Direktorij(a)";
$owl_lang->folder_count_file		= "Fajl(ova)";
$owl_lang->folder_count_url		= "URL(ova)";
$owl_lang->folder_count_note		= "Napomena";
$owl_lang->folder_policy 		= "Prava trenutnog direktorija:";
$owl_lang->held                      	= "Zakljucao"; 
$owl_lang->last_logged			= "Zad.login: ";
$owl_lang->menu_url_action		= "Dostupne Url Akcije";
$owl_lang->menu_file_action		= "Dostupne Fajl Akcije";
$owl_lang->menu_folder_action		= "Dostupne direktorij Akcije";
$owl_lang->modified 			= "Izmjena";
$owl_lang->move_selected		= "Premjesti oznaceno";
$owl_lang->new_file			= "Novi(h)!";
$owl_lang->no_description		= "Opis nije dostupan";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Strana:";
$owl_lang->panel_file_info		= "L e g e n d a :";
$owl_lang->postedby 			= "Poslao";
$owl_lang->reallydelete			= "Zaista izbrisati";
$owl_lang->reallydelete_logs		= "Zaista izbrsati LOG fajl";
$owl_lang->reallydelete_selected	= "Zaista izbrsati sve oznacene fajlove";
$owl_lang->reallyrestore_selected	= "Zaista vratiti sve oznacene fajlove ";
$owl_lang->rest_selected		= "Vrati oznaceno";
$owl_lang->size 			= "Velicina";
$owl_lang->updated_by                   = "Nadogradio";
$owl_lang->score 			= "Rezultat";
$owl_lang->title 			= "Naslov";
$owl_lang->tot_files			= "Ukupno:";
$owl_lang->tot_my_checked_out		= "Oznacenih:";
$owl_lang->tot_my_files			= "Moj(i):";
$owl_lang->tot_my_group			= "Grupa:";
$owl_lang->tot_new_files		= "Novih:";
$owl_lang->tot_updated_files		= "Nadogradjenih:";
$owl_lang->tot_monitored		= "Pracenih:";
$owl_lang->updated_file			= "Nadogradjen!";
$owl_lang->user               		= "Korisnik";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favorites";
$owl_lang->favorite_add = "Dodaj Trenutni";
$owl_lang->favorite_delete = "Brisi";
$owl_lang->favorite_go = "Idi";
$owl_lang->files_in_my_group_title = "Fajlova u Mojim Grupama";
$owl_lang->my_files_title= "Mojih Fajlova";
$owl_lang->my_monitored_title= "Mojih Nadgledanih Fajlova / Direktorija";
$owl_lang->my_special_access_title= "Lista Specijalnog Pristupa";
$owl_lang->special_access_count_alt= "Fajlovi / Direktoriji sa specijalnim pristupom";
$owl_lang->special_access_count= "Specijalni Pristup:";

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Dodavanje / Pregled komentara: ";
$owl_lang->addingfile 		= "Dodavanje fajla u ";
$owl_lang->addingfolder 	= "Dodavanje direktorija u  ";
$owl_lang->attach_file		= "Prikaci fajl";
$owl_lang->change		= "Promjeni";
$owl_lang->comments      	= "Komentar";
$owl_lang->comments_added       = "Komentare dodao: ";
$owl_lang->create		= "Kreiraj";
$owl_lang->description 		= "Opis";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pjesma:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Trajanje:<br />Zanr:<br />Komentar:";
$owl_lang->email_body		= "Poruka";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Reply to";
$owl_lang->email_subject	= "Subjekt";
$owl_lang->email_to		= "E-Mail za";
$owl_lang->emailing		= "Mailing";
$owl_lang->keywords 		= "Kljucne rijeci";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Izmjena ";
$owl_lang->name               	= "Ime"; 
$owl_lang->none_selected        = "NISTA NIJE OZNACENO";
$owl_lang->note_content         = "Napomena (sadrzaj)";
$owl_lang->notify_link          = "OWL Eksterni link";
$owl_lang->ownergroup         	= "Vlasnik (Grupe)";
$owl_lang->ownership		= "Vlasnistvo";
$owl_lang->permissions 		= "Dozvole";
$owl_lang->pick_select		= "&#8211; Odaberite OWL korisnika &#8211;";
$owl_lang->policy 		= "Prava";
$owl_lang->post_comment		= "Posalji komentar";
$owl_lang->prop_permissions 	= "Podijeli dozvole direktorijima?";
$owl_lang->prop_perms_files 	= "Dozvole za podijeliti fajlovima";
$owl_lang->sendfile 		= "Posalji fajl";
$owl_lang->sendthisfile 	= "Posalji ovaj fajl";
$owl_lang->sendthisurl       	= "Posalji ovaj URL";
$owl_lang->updating		= "Nadogradnja";
$owl_lang->verdescription 	= "Opis<br />promjena";
$owl_lang->vermajor          	= "Glavna revizija";
$owl_lang->verminor          	= "Sporedna revizija";
$owl_lang->vertype           	= "Tip revizije";  
$owl_lang->document_text        = "Content";  

//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "E-Mail adresa";
$owl_lang->full_name		= "Puno ime";
$owl_lang->register		= "Registracija korisnika";
$owl_lang->self_failed		= "Neuspjesno";
$owl_lang->self_passwd		= "Sifra poslana :";
$owl_lang->self_reg_bod		= "Vasa OWL sifra je:";
$owl_lang->self_reg_rset	= "Vasa OWL sifra je resetovana u :";
$owl_lang->self_reg_subj	= "Vas OWL account";
$owl_lang->send_pass		= "Posalji sifru";
$owl_lang->submit		= "Registruj";
$owl_lang->thank_you_1		= "Hvala lijepo!";
$owl_lang->thank_you_2		= "E-mail je poslan na vasu email adresu sa novom sifrom za korisnika :";
$owl_lang->captcha_typein        = "Upisite 5 karaktera";
$owl_lang->change_pass_title	      = "PROMJENA SIFRE";
$owl_lang->err_cant_reuse_passwords   = "Ne mozete ponovo koristiti ranije postavljane sifre";
$owl_lang->err_new_confirm_different  = "Vasa Nova i Potvrdna sifra se ne slazu <br />";
$owl_lang->err_old_pass_ver_failed    = "Vasa stara sifra nije ispravna <br />";
$owl_lang->err_pass_restriction_1     = "Vasa sifra mora biti namjanje '%s' karakter(a) duga, <br />";
$owl_lang->err_pass_restriction_2     = "da sadrzi najmanje '%s' numerickih znakova [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "i bar '%s' specijalnih znakova [ ~!@#$%%^&*()-=+_|{}][\";:<>.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Vase odabrano korisnicko ime '%s' je %d karaktera dugo, a treba da bude bar %d znakova.";
$owl_lang->pass_change_email_1        = "Vasa sifra nije resetovana jer ne koristite OWL INTRANET sigurnosnu provjeru";
$owl_lang->pass_change_email_2        = "Vasa sigurnosna provjera je : ";
$owl_lang->pass_change_email_3        = "Kontaktirajte sistem-administratora za pomoc";


//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Odustani";
$owl_lang->moving		= "Premjestam";
$owl_lang->moving_file		= "Premjestam FAJL";
$owl_lang->moving_folder	= "Premjestam DIREKTORIJ";
$owl_lang->copy_file		= "Kopiram FAJL";
$owl_lang->copy_folder		= "Kopiram DIREKTORIJ";
$owl_lang->select		= "Molim oznacite novi direktorij :";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Pregled log fajla za ";
$owl_lang->diff_from	= "razlika Od";
$owl_lang->diff_to	= "Razlika Do";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Obavijest o komentaru";
$owl_lang->confpassword	= "Potvrdi novu sifru";
$owl_lang->email_tool	= "E-Mail alat";
$owl_lang->group	= "Primarna grupa";
$owl_lang->groupmember	= "Clan Grupe/Grupa";
$owl_lang->last_modified= "Zadnju put izmjenjen";
$owl_lang->newpassword	= "Nova sifra";
$owl_lang->newsadmin	= "Administrator novosti";
$owl_lang->not_member	= "Ne pripadate niti jednoj drugoj grupi";
$owl_lang->notification	= "Preuzmi upozorenja";
$owl_lang->oldpassword	= "Stara sifra";
$owl_lang->preference	= "Osobine";
$owl_lang->saved	= "&#8212; P R O M J E N E&nbsp;&nbsp;&nbsp;S N I M LJ E N E &#8212;";
$owl_lang->status_no	= "NE";
$owl_lang->status_yes	= "DA";
$owl_lang->userlang	= "Jezik";
$owl_lang->useradmin	= "Administracija Korisnika";
$owl_lang->viewlogs     = "Moze pregledati Sistemske LOG-ove";
$owl_lang->viewreports  = "Moze pregledati Sistemske Izvjestaje";

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

$owl_lang->elapsed_time       	= "vrijeme koje je proslo";
$owl_lang->query_empty       	= "Prazno polje za pretragu";
$owl_lang->related_query_empty  = "Ne postoje METADATA asocirani sa dokumentom da bi se preduzela pretraga  NADJI SLICNE";
$owl_lang->search             	= "Trazi";
$owl_lang->search_any_word	= "Bilo koju rijec";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_all_word	= "Sve rijeci";
$owl_lang->search_currentfolder = "Trazi unutar sadasnjeg direktorija";
$owl_lang->search_entire_phrase	= "Cijelu frazu";
$owl_lang->search_for_folders 	= "Trazi direktorije";
$owl_lang->search_for_files 	= "Trazi fajlove";
$owl_lang->search_match 	= "Nadjeno:";
$owl_lang->search_results_for	= "Rezulati pretrage za ";
$owl_lang->search_score 	= "Rezultati";
$owl_lang->search_winthindocs   = "Trazi unutar";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Pregled ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************************************************************************
// admin/index.php  BEGIN
//********************************************************************************************************************

$owl_lang->edit_user                    = "***** Izmjena Korisnika *****";
$owl_lang->edit_group                   = "***** Izmjena Grupe *****";
$owl_lang->enter_new_user               = "***** Dodavanje Novog Korisnika *****";
$owl_lang->enter_new_group              = "***** Dodavanje Nove Grupe *****";
$owl_lang->info_panel_width             = "Prikazi Siroki FAJL-Info Panel";
$owl_lang->allow_track_favorite         = "Omoguci korisnicima da prate Favorite";
$owl_lang->admin_login_to_browse_page	= "Administrator kod logiranja ide direktno na PREGLED";
$owl_lang->alt_btn_backup		= "Backup SQL Baze";
$owl_lang->alt_btn_doctype_admin	= "Administracija tipova dokumenata";
$owl_lang->alt_btn_html_prefs		= "HTML opcije";
$owl_lang->alt_btn_news_admin		= "OWL Administracija Novosti";
$owl_lang->alt_btn_site_features	= "Izmjena opcija stranice";
$owl_lang->alt_btn_statistics_viewer	= "OWL Pregled statistika";
$owl_lang->alt_btn_users_groups		= "Administracija korisnika i grupa";
$owl_lang->btn_backup			= "Backup<br />Baze podataka";
$owl_lang->btn_doctype_admin		= "Tipovi<br />Dokumenata";
$owl_lang->btn_html_prefs		= "HTML";
$owl_lang->btn_news_admin		= "NOVOSTI";
$owl_lang->btn_site_features		= "Opcije<br />Stranice";
$owl_lang->btn_statistics_viewer	= "Preglednik <br />Statistike";
$owl_lang->btn_users_groups		= "Korisnici &amp;<br />Grupe";
$owl_lang->display_password_override	= "Prikazi Fajl/Direktorij prekoracenje sifre";
$owl_lang->doc_id_num_digits		= "Broj cifara za prikaz broja dokumenta";
$owl_lang->doc_id_prefix		= "PREFIX int. broja dokumenta"; 
$owl_lang->docicon_column		= "Ikona Dokumenta";
$owl_lang->download_folder_zip		= "Preuzmi direktorije kao ZIP (Default je tar.gz)";
$owl_lang->save_keywords_to_db		= "Dozvoli korisnicima da sacuvaju kljucne rijeci za ponovno koristenje";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Inicijalna glavna revizija";
$owl_lang->verminor_initial          	= "Inicijalna sporedna revizija";
$owl_lang->view_doc_in_new_window	= "Novi prozor kod pregleda dokumenata";
$owl_lang->alt_btn_change_passwd        = "Primijeni staru sifru";
$owl_lang->alt_btn_cln_history          = "Brisi dokumente koji su stariji od (dana): ";
$owl_lang->alt_btn_log_viewer           = "OWL Sistemski LOG preglednik";
$owl_lang->alt_btn_report_viewer        = "OWL Preglednik Izvjestaja";
$owl_lang->btn_change_passwd            = "Promijeni sifru";
$owl_lang->btn_cln_history              = "Brisi historiju";
$owl_lang->btn_log_viewer               = "Sistemski <br />LOGovi";
$owl_lang->btn_report_viewer            = "Izvjestaji";
$owl_lang->confirm_cln_history          = "Jeste li sigurni da zelite brisati dokumente koji su stariji od (dana): ";
$owl_lang->historical_purge             = "Historijski fajlovi izbrisani";
$owl_lang->add				= "Dodaj";
$owl_lang->alt_btn_initial_load		= "Stvori bazu na osnovu sadrzaja direktorija DOCUMENTS";
$owl_lang->alt_btn_trashcan		= "Klikni za prergled sadrzaja";
$owl_lang->anonymous_account		= "Account za anonimni pristup:";
$owl_lang->btn_initial_load		= "Inicijalno punjenje"; // inicijalizacija
$owl_lang->btn_trashcan			= "KantaZaSmece";
$owl_lang->buttonstyle                  = "Tema";
$owl_lang->confirm_initial_load		= "*** U P O Z O R E NJ E ***  Ovo smije biti uradjeno samo jednom i to kada je baza prazna";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Brisi Grupu";
$owl_lang->deleteuser			= "Brisi Korisnika";
$owl_lang->disable_recs_per_page	= "Omogucavanje ogranicenog pregleda ce onemoguciti ZAPISE PO STRANICI!";
$owl_lang->disableuser			= "Onemoguci korisnika";
$owl_lang->file_admin_group		= "Fajl/Preglednik administratorske grupe:";
$owl_lang->flushed           		= "Tabela sesija ociscena, korisnici se sada mogu ponovo logirati.";
$owl_lang->groups			= "Grupe";
$owl_lang->hide_bulk_buttons		= "Sakrij MASS linkove:";

// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Put do slike za pozadinu:";
$owl_lang->ht_bd_lnk_cl			= "Osnovna boja LINKA:";
$owl_lang->ht_bd_txt_cl 		= "Osnovna boja TEKSTA:";
$owl_lang->ht_bd_vlnk_cl 		= "Osnovna boja posjecenog LINKA:";
$owl_lang->ht_collapse_width 		= "Sirina SMANJENOG Pregleda:";
$owl_lang->ht_expand_width		= "Sirina PROSIRENOG Pregleda:";
$owl_lang->ht_tbl_border_sz 		= "Debljina OKVIRA tabele:";
$owl_lang->ht_tbl_cell_bg_al 		= "Zamjenska boja za celiju tabele:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Boja za celiju tabele:";
$owl_lang->ht_tbl_hd_bg			= "Pozadina zaglavlja:";
// Edit Prefs Properties Messages END

$owl_lang->anonymous_access		= "Postavi Anonimni Pristup";
$owl_lang->header_group_admin           = "Administracija Grupa";
$owl_lang->header_sitefeatures_settings           = "Postavke STRANICE";
$owl_lang->header_user_admin           	= "Administracija Korisnika";
$owl_lang->hide_folder_doc_count	= "Sakrij brojac tipa dokumenata";
$owl_lang->hide_folder_size		= "Sakrij velicinu sadrzaja direktorija";
$owl_lang->hide_panel			= "Sakrij";
$owl_lang->home_dir			= "Korisnikov HOME direktorij";
$owl_lang->initial_dir   		= "Korisnikov INICIJALNI direktorij";
$owl_lang->maxsessions			= "Max. broj sesija";
$owl_lang->noprefaccess			= "Onemoguci osobine";
$owl_lang->old_action_icons		= "Koristi OWL akcijske ikone od verzije <0.80";
$owl_lang->owl_anon_download     	= "Samo Preuzimanje";
$owl_lang->owl_anon_full		= "Potpuni pristup";
$owl_lang->owl_anon_ro			= "Samo gledanje";
$owl_lang->owl_dbdump_path   		= "Put do alata za DB Dump:";
$owl_lang->owl_def_file_group_owner	= "Inicijalni Vlasnik Grupe Fajlova:";
$owl_lang->owl_def_file_meta		= "Inicijalna Fajl Meta Data:";
$owl_lang->owl_def_file_owner		= "Inicijalni Vlasnik Fajla:";
$owl_lang->owl_def_file_perm 		= "Inicijalna Polisa kod kreiranja Fajla:";
$owl_lang->owl_def_file_security	= "Inicijalna Fajl Sigurnost:";
$owl_lang->owl_def_file_title		= "Inicijalni Fajl Titl (ostaviti prazno da to bude IME FAJLA):";
$owl_lang->owl_def_fold_group_owner	= "Inicijalni Vlasnik Grupe Direktorija:";
$owl_lang->owl_def_fold_owner		= "Inicijalni Vlasnik Direktorija:";
$owl_lang->owl_def_fold_sec		= "Inicijalna Sigurnost Direktorija:";
$owl_lang->owl_def_folder_perm 		= "Inicijalna Polica kod kreiranja Direktorija:";
$owl_lang->owl_default_tmpdir		= "Lokacija Direktorija za Temp fajl: ";
$owl_lang->owl_email_from		= "Sa Adrese:";
$owl_lang->owl_email_fromname		= "Od (Ime):";
$owl_lang->owl_email_replyto		= "Reply Adresa:";
$owl_lang->owl_email_server		= "SMTP Server:";
$owl_lang->owl_email_smtp		= "koristi SMTP Mailing Metod";
$owl_lang->owl_email_smtp_auth		= "Koristi SMTP Autorizaciju";
$owl_lang->owl_email_smtp_auth_login	= "SMTP Login:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP Sifra";
$owl_lang->owl_email_subject_pref	= "Subjekt Prefix:";
$owl_lang->owl_fogotpass		= "Prikazi link za zaboravljenu sifru:";
$owl_lang->owl_group_user		= "Korisnici clanovi ove grupe";
$owl_lang->owl_gzip_path     		= "putanja do -gzip- aplikacije (Path):";
$owl_lang->owl_hidebackup		= "Sakrij BACKUP direktorij:";
$owl_lang->owl_log_file			= "Aktivnosti LOG Fajla:";
$owl_lang->owl_log_login_act		= "LOG Login/Logout Aktivnosti:";
$owl_lang->owl_log_rec_page		= "LOG Preglednik - zapisa po stranici:";
$owl_lang->owl_logging			= "Ukljuci LOG Fajl:";
$owl_lang->owl_logo			= "Logo na naslovnoj stranici ([Language]/graphics):";
$owl_lang->owl_lookAtHD			= "Onemoguci POGLEDATI NA HD:";
$owl_lang->owl_lookAtHDDel		= "Ukloni izbrisane fajlove iz BAZE";
$owl_lang->owl_max_filesize		= "Maksimalna velicina usnimljenog fajla (bajta)";
$owl_lang->owl_owl_expand		= "Osnovni PREGLED (PROSIRENO)";
$owl_lang->owl_owl_timeout		= "Sesija istice za (sekundi)";
$owl_lang->owl_pdftotext_path		= "Odrzavaj index pretrage za <br />PDF i text Fajlove <br />&#8211; Prazno za iskljuceno:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 ili noviji je potreban<br />Put do pod2html:";
$owl_lang->owl_restrict_view		= "Ukljuci opciju ogranicenog pregleda:";
$owl_lang->owl_self_reg			= "Dozvoli SAMOREGISTRACIJU:";
$owl_lang->owl_self_reg_hd		= "OSNOVNE POSTAVKE ZA SAMOREGISTROVANOG KORISNIKA";
$owl_lang->owl_tar_path     		= "putanja do -tar- aplikacije (Path):";
$owl_lang->owl_title_browser		= "OSOBINE OWL PREGLEDNIKA";
$owl_lang->owl_title_custom		= "PODESAVANJE KOLONA PREGLEDNIKA";
$owl_lang->owl_title_custom_search      = "PODESAVANJE REZULTATA PRETRAGE";
$owl_lang->owl_title_defaults   	= "OSNOVNE POSTAVKE";
$owl_lang->owl_title_email		= "OWL Sistemske E-mail postavke";
$owl_lang->owl_title_HD			= "POGLEDATI NA HD ZA NOVE FAJL POSTAVKE";
$owl_lang->owl_title_logging  		= "POSTAVKE LOGa";
$owl_lang->owl_title_other		= "OSTALE POSTAVKE";
$owl_lang->owl_title_tools   		= "DB BACKUP/GZIP ALATI";
$owl_lang->owl_unzip_path     		= "putanja do -unzip- aplikacije (Path):";
$owl_lang->owl_version_control		= "Omoguci mogucnost kontrole Verzije:";
$owl_lang->owl_wordtotext_path          = "MS-WORD Fajlovi <br />&#8211; Prazno za ONEMOGUCENO:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPOINT Fajlovi <br />&#8211; Prazno za ONEMOGUCENO:";
$owl_lang->quota			= "Kvota 0=Iskljuceno";
$owl_lang->reallydeluser		= "Ovaj korisnik je vlasnikf %numfiles% Fajl(ova) i %numfolders% Direktorij(a). Isti ce ovom akcijom ostati bez vlasnika. Da li jos uvijek zelite brisati?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Zapisa po stranici (0 = Neograniceno):";
$owl_lang->recycle_enabled		= "Omoguci cuvanje Smeca:";
$owl_lang->recycle_location		= "Lokacija Kante Za Smece:";
$owl_lang->recycle_title		= "POSTAVKE ZA SMECE";
$owl_lang->remember_me			= "Prikazi ZAPAMTI ME link";
$owl_lang->remember_me_checkbox		= "Zapamti me";
$owl_lang->remember_me_title		= "STALNE LOGIN POSTAVKE";
$owl_lang->remember_timeout		= "Cookiji isticu za (dana)";
$owl_lang->restore_file_prefix		= "PREFIX STRING Vracenih Fajlova";
$owl_lang->search_result_folders	= "Ukljuci DIREKTORIJ u rezultate pretrage";
$owl_lang->show_action_title		= "Prikazi AKCIJSKE Liknove:";
$owl_lang->show_bulk_title		= "Prikazi MASS Linkove:";
$owl_lang->show_folder_title		= "Prikazi DIREKTORIJ Alate:";
$owl_lang->show_panel			= "Prikazi";
$owl_lang->show_panel_title		= "Prikazi Status Panel:";
$owl_lang->show_pref_title		= "Prikazi traku sa Osobinama/Logout-om:";
$owl_lang->show_search_title		= "Omoguci pretrazivanje:";
$owl_lang->status_bar_both              = "Na vrhu i dnu";
$owl_lang->status_bar_bottom            = "Samo na dnu";
$owl_lang->status_bar_location          = "Prikazi statusnu traku na:";
$owl_lang->status_bar_not               = "Ne prikazuj";
$owl_lang->status_bar_top               = "Samo na vrhu";
$owl_lang->use_popup			= "Koristi POPUP za prikaz Novosti:";
$owl_lang->users           		= "Korisnici";
$owl_lang->virus_path			= "Put do antivirusnog alata<br />primjer: '/usr/bin/clamscan --quiet' <br />&#8211; prazno=iskljuceno:";
$owl_lang->cust_popup                                   = "Rucno podesena polja unutar Popup Opisa";
$owl_lang->cust_headpopup     = "ODREDJENA POLJA DOKUMENTA";
$owl_lang->auth_http                        = "HTTP provjera (.htaccess)";
$owl_lang->auth_ldap                        = "LDAP Sigurnosna provjera";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Korisnici koji imaju ovu Grupu kao Primarnu";
$owl_lang->auth_owl                         = "OWL sigurnosna provjera";
$owl_lang->auth_pop3                        = "pop3 sigurnosna provjera";
$owl_lang->file_desc_required           = "Neophodan OPIS Fajla";
$owl_lang->folder_desc_required         = "Neophodan OPIS Direktorija";
$owl_lang->html_title		= "HTML Osobine";
$owl_lang->pass_account_lockout      	    = "Broj pokusaja DO Zakljucavanja:";
$owl_lang->pass_change_every                = "Zahtjevaj promjenu sifre svakih (Dana):";
$owl_lang->pass_enable_account_lockout      = "Omoguci zakljucavanje Accounta:";
$owl_lang->pass_min_passwd_length           = "Minimalna duzina korisnicki postavljene sifre:";
$owl_lang->pass_min_passwd_numeric          = "Najmanje brojeva u sifri:";
$owl_lang->pass_min_passwd_special          = "Najmanje specijalnih karaktera:";
$owl_lang->pass_min_username_length         = "Minimalna duzina korisnicki postavljenog korisnickog imena:";
$owl_lang->pass_track_old_passwords   	    = "Broj prethodnoh sifri za pamcenje:";
$owl_lang->rtftotext_path                = "Put do RTF to Text Alata";
$owl_lang->show_user_info           = "Na prikazana korisnicka imena se moze kliknuti";
$owl_lang->user_admin              = "Admininstrator Korisnika/Grupa";
$owl_lang->user_auth_type                   = "TIP Sigurnosne provjere:";
$owl_lang->user_change_pass_next_login      = "Promijeni sifru na sljedecem logiranju:";
$owl_lang->user_expires                     = "Account Istice (datum):";
$owl_lang->user_gmt_offset              = "Koristi GMT Offset";
$owl_lang->user_group_admin                 = "FAJL ADMINISTRATOR za primarnu grupu:";
$owl_lang->user_login_to_newrecords         = "Login to New Records Page:";
$owl_lang->users_group_admin		= "Korisnici koji su Administratori Grupe";
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

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	= "Filter";
$owl_lang->owl_log_hd_action	= "Akcija";
$owl_lang->owl_log_hd_agent	= "Agent";
$owl_lang->owl_log_hd_dt_tm	= "Datum Vrijeme";
$owl_lang->owl_log_hd_dtls	= "Detalji";
$owl_lang->owl_log_hd_file	= "Fajl";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Put direktorija";
$owl_lang->owl_log_hd_ip	= "IP / Adresa";
$owl_lang->owl_log_hd_user	= "Korisnik";
$owl_lang->owl_log_hide      	= "Sakrij: ";
$owl_lang->owl_log_no_rec	= " NEMA ZAPISA ";
$owl_lang->owl_log_viewer	= "Preglednik LOGa";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Baci smece";
$owl_lang->really_empty_trash	= "Zaista zelite baciti smece?";
$owl_lang->recycle_bin_admin    = "Administracija Kante za Smece";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Fajlovi koje ste trazili su u prilogu.";
$owl_lang->trash_email_subject  = "FAJLOVI KOJE STE TRAZILI SU VRACENI";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Nista &#8211; Ne diraj FAJL - Dozvole";
$owl_lang->everyoneread			= "Svi mogu citati/preuzeti";
$owl_lang->everyoneread_ad		= "Svi mogu citati/preuzeti";
$owl_lang->everyonewrite		= "Svi mogu citati/pisati/preuzeti";
$owl_lang->everyonewrite_ad		= "Svi mogu citati/pisati/preuzeti";
$owl_lang->everyonewrite_ad_nod		= "Svi mogu citati/pisati/preuzeti, NE BRISATI";
$owl_lang->everyonewrite_nod		= "Svi mogu citati/pisati/preuzeti, NE BRISATI";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Svi mogu citati ovaj Direktorij";
$owl_lang->geveryoneread_ad		= "Svi mogu citati ovaj Direktorij";
$owl_lang->geveryonewrite		= "Svi mogu usnimavati fajlove i brisati ovaj Direktorij";
$owl_lang->geveryonewrite_ad		= "Svi mogu usnimavati fajlove i brisati ovaj Direktorij";
$owl_lang->geveryonewrite_ad_nod	= "Svi mogu usnimavati fajlove u ovaj Direktorij";
$owl_lang->geveryonewrite_nod		= "Svi mogu usnimavati fajlove u ovaj Direktorij";
$owl_lang->ggroupread			= "Vasa grupa moze citati ovaj Direktorij";
$owl_lang->ggroupread_ad		= "Oznacena grupa moze citati ovaj Direktorij";
$owl_lang->ggroupwrite			= "Vasa grupa moze usnimavati fajlove i brisati ovaj Direktorij";
$owl_lang->ggroupwrite_ad    		= "Oznacena grupa moze usnimavati fajlove i brisati ovaj Direktorij";
$owl_lang->ggroupwrite_ad_nod		= "Oznacena grupa moze usnimavati fajlove u ovaj Direktorij";
$owl_lang->ggroupwrite_nod		= "Vasa grupa moze usnimavati fajlove u ovaj Direktorij";
$owl_lang->ggroupwrite_worldread 	= "Vasa grupa moze usnimavati fajlove i brisati ovaj Direktorij &amp; svi ostali mogu vidjeti sadrzaj";
$owl_lang->ggroupwrite_worldread_ad 	= "Oznacena grupa moze usnimavati fajlove i brisati ovaj Direktorij &amp; svi ostali mogu vidjeti sadrzaj";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Oznacena grupa moze usnimavati fajlove u ovaj Direktorij &amp; svi ostali mogu vidjeti sadrzaj, NE BRISATI";
$owl_lang->ggroupwrite_worldread_nod 	= "Vasa grupa moze usnimavati fajlove u ovaj Direktorij &amp; svi ostali mogu vidjeti sadrzaj, NE BRISATI";
$owl_lang->gonlyyou			= "Samo VI mozete usnimiti fajlove i brisati ovaj Direktorij";
$owl_lang->gonlyyou_ad			= "Samo VI mozete usnimiti fajlove i brisati ovaj Direktorij";
$owl_lang->groupread			= "Vasa grupa moze citati / preuzimati";
$owl_lang->groupread_ad			= "Oznacena grupa moze citati / preuzimati";
$owl_lang->groupwrite			= "Vasa grupa moze citati / pisati / preuzimati";
$owl_lang->groupwrite_ad		= "Oznacena grupa moze citati / pisati / preuzimati";
$owl_lang->groupwrite_ad_nod		= "Oznacena grupa moze citati / pisati / preuzimati, NE BRISATI";
$owl_lang->groupwrite_nod		= "Vasa grupa moze citati / pisati / preuzimati, NE BRISATI";
$owl_lang->groupwrite_worldread 	= "Vasa grupa moze citati / pisati / preuzimati &amp; svi ostali mogu citati";
$owl_lang->groupwrite_worldread_ad 	= "Oznacena grupa moze citati / pisati / preuzimati &amp; svi ostali mogu citati";
$owl_lang->groupwrite_worldread_ad_nod 	= "Oznacena grupa moze citati / pisati / preuzimati (NE BRISATI) &amp; svi ostali mogu citati";
$owl_lang->groupwrite_worldread_nod 	= "Vasa grupa moze citati / pisati / preuzimati (NE BRISATI) &amp; svi ostali mogu citati";
$owl_lang->invalidsess			= "Pogresan ID sesije, Molim logirajte se na glavnoj stranici<br />";
$owl_lang->notif_comment_1		= "komentirano";
$owl_lang->notif_comment_2		= "Komentar:";
$owl_lang->notif_msg         		= "OVO JE OWL AUTOMATIZIRANA PORUKA<br /><br />Potrazite novi/izmijenjeni fajl u prilogu ove E-mail poruke<br /><br />";
$owl_lang->notif_msg_alt         	= "OVO JE OWL AUTOMATIZIRANA PORUKA\n\nPotrazite novi/izmijenjeni fajl u prilogu ove E-mail poruke\n\n";
$owl_lang->notif_msg_alt_link           = "OVO JE OWL AUTOMATIZIRANA PORUKA\n\nPotrazite LINK do novog/izmijenjenog fajla u ovoj E-mail poruci\n\n";
$owl_lang->notif_msg_link               = "OVO JE OWL AUTOMATIZIRANA PORUKA<br /><br />Potrazite LINK do novog/izmijenjenog fajla u ovoj E-mail poruci<br /><br />";
$owl_lang->notif_salutation		= "Postovani/a";
$owl_lang->notif_subject_comment	= "OWL Intranet Fajl -- Komentar Dodan";
$owl_lang->notif_subject_monitor	= "OWL Intranet Fajl ili FOLDER koji NADGLEDATE je nadogradjen";
$owl_lang->notif_subject_new 		= "Novi OWL Intranet Fajl";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "OWL Intranet Fajl je nadogradjen";
$owl_lang->notif_user			= "Kreirao/Nadogradio:";
$owl_lang->onlyyou			= "Samo vi mozete citati / preuzimati / pisati";
$owl_lang->onlyyou_ad			= "Samo vi mozete citati / preuzimati / pisati";
$owl_lang->orphaned			= "&#8211; NEMA Vlasnika  &#8211;";
$owl_lang->owl_path			= "Put do fajla: ";
$owl_lang->sessinuse			= "Ova sesija je u upotrebi na drugom racunaru, PRISTUP ODBIJEN<br />";
$owl_lang->sesstimeout			= "Vasa sesija je istekla, molim logirajte se ponovo<br />";
$owl_lang->virus_infected 		= "FAJL ZARAZEN VIRUSOM";
$owl_lang->virus_return_val		= "Antivirusni program je vratio sljedecu vrijednost:";

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Pregledaj ovaj DIREKTORIJ";
$owl_lang->title_browse_site     	= "Pregledaj ovaj URL";
$owl_lang->title_download_view     	= "Preuzmi / Vidi ovaj Fajl";
$owl_lang->title_edit_prefs     	= "Vidi / Ispravi Osobine Korisnika";
$owl_lang->title_return_folder     	= "Povratak na";
$owl_lang->title_sort     		= "Sortiraj";
$owl_lang->title_view_my     		= "Vidi listu mojih fajlova";
$owl_lang->title_view_new     		= "Vidi listu novopostavljenih fajlova od moje zadnje posjete";
$owl_lang->title_view_updated     	= "Vidi listu nadogradjenih fajlova od moje zadnje posjete";
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

$owl_lang->news_content			= "Sadrzaj";
$owl_lang->news_hd			= " Novost";
$owl_lang->news_hd_audience		= "Odnosi se na";
$owl_lang->news_hd_created		= "Kreirano";
$owl_lang->news_hd_expires		= "Istice";
$owl_lang->news_heading			= "Naslov";
$owl_lang->news_posted_date		= "Postavljeno:";
$owl_lang->news_read			= "Citaj";
$owl_lang->news_title			= "Administracija Novosti";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_tmp_not_exists		= "DEBUG: OWL privremeni direktorij : %s ne postoji.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: U OWL privremeni direktorij: %s server nema pravo zapisivanja.";
$owl_lang->debug_doc_not_exists		= "DEBUG: OWL Documents direktorij: " .$default->owl_FileDir . "/" . fid_to_name(1) ." ne postoji.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: U OWL Documents direktorij: " .$default->owl_FileDir . "/" . fid_to_name(1) ." server nema pravo zapisivanja.";
$owl_lang->debug_webserver_no_access	= "DEBUG: Server nema pravo CITANJA u: <br />'$default->owl_FileDir/%'. <br />Popravite dozvole i pokusajte ponovo";
$owl_lang->debug_file_not_exist		= "DEBUG: Neophodan fajl '$default->owl_FileDir/%' ne postoji.<br /> ILI<br />PUT \$default->owl_FileDir naveden u config/owl.php nije ispravan.";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Preglednik Statistike / Izvjestaja";
$owl_lang->stats_files		= "Broj Fajlova po Korisniku";
$owl_lang->stats_folders	= "Broj Direktorija po Korisniku";
$owl_lang->stats_information	= "Vodjenje generalnog OWL i FAJL OWL LOG-a moraju biti ukljuceni da bi ova statistika bila prikazana";
$owl_lang->stats_top		= "Top 20 preuzimanja";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Korisnicka logiranja (Login / GRESKA / Logout)";
$owl_lang->stats_users_loggedin = "Trenutno logirani";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administracija tipova dokumenata";
$owl_lang->doc_field_label	= "Field Label (Per Locale)";
$owl_lang->doc_field_name	= "Ime polja";
$owl_lang->doc_field_pos	= "Pozicija polja";
$owl_lang->doc_field_required	= "Neophodno?";
$owl_lang->doc_field_searchable	= "Pretrazivo?";
$owl_lang->doc_field_size	= "Velicina polja";
$owl_lang->doc_new_doc_type	= "&#8211; Dodaj novi TIP dokumenta &#8211;";
$owl_lang->doc_specific		= "POLJA KARAKTERISTICNA ZA DOKUMENTE:";
$owl_lang->document_type	= "Tip Dokumenta";
$owl_lang->document_type_name	= "Naziv Tipa Dokumenta";
$owl_lang->doc_field_disp_label = "Labela POLJA:";
$owl_lang->doc_field_disp_sep = "Oznaka SEPERATORA";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;P&nbsp;R&nbsp;I&nbsp;M&nbsp;J&nbsp;E&nbsp;R&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Prikazi PREGLEDNIK:";
$owl_lang->doc_field_show_in_list = "Prikazi polje u PREGLEDNIKU:";
$owl_lang->doc_field_type	= "Tip Polja:";
$owl_lang->doc_field_values	= "Vrijednosti polja odvojene sa | :";
$owl_lang->doc_fields = "Posebna polja";
$owl_lang->doc_field_popup  = "Ubaci u POPUP opis?";

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grupa:";
$owl_lang->header_csv_import    = "Uvezi (Import) CSV korisnicki fajl";
$owl_lang->import_inserted      = "UMETNUT";
$owl_lang->import_skipped       = "PRESKOCEN";
$owl_lang->invalid_groupid      = "Neispravan ID grupe --> ";
$owl_lang->msg_user_exists      = "Korisnik Vec postoji";
$owl_lang->sendcsvfile          = "Usnimi COMA DELIMITED fajl ";
$owl_lang->user_created_skipped = "Korisnik:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->peer_reviewer_list	= "Revizor(i)";
$owl_lang->peer_msg_to_reviewer	= "Poruka revizorima";
$owl_lang->peer_final_approval	= "[Finalna Ocjena]: ";
$owl_lang->peer_subj_review	= "Imate OWL fajl za reviziju";
$owl_lang->peer_subj_approved	= "Vas dokument je ODOBREN";
$owl_lang->peer_subj_rejected	= "Vas dokument je ODBIJEN";
$owl_lang->peer_subj_reminder	= "PODSJETNIK: Imate OWL fajl za reviziju";
$owl_lang->peer_notif_user	= "Kreirao/Nadogradio";
$owl_lang->peer_file_to_review	= "Fajl za reviziju:";
$owl_lang->peer_file_approved	= "Fajl odobren:";
$owl_lang->peer_file_rejected	= "Fajl odbijen:";
$owl_lang->peer_file_final	= "Finalna ocjena:";
$owl_lang->peer_final_body	= "Vas dokument je odobren od svih trazenih revizora.<br />Molim logirajte se i objavite dokument<br />";
$owl_lang->peer_review_body	= "Vasa revizija je trazena za sljedeci dokument:";
$owl_lang->peer_approved_body	= "Vas fajl je odobren:";
$owl_lang->peer_rejected_body	= "Vas fajl je odbijen:";
$owl_lang->peer_my_approval	= "Ceka moje odobrenje";
$owl_lang->peer_pending_approval= "Moja odobrenja u toku";
$owl_lang->peer_satus_pending   = "&#8212; U &nbsp;t o k u &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; O D B I J E N O &#8212;";
$owl_lang->peer_satus_approved  = "&#8212; O D O B R E N O &#8212;";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_reject_reason   = "Razlog odbijanja";
$owl_lang->peer_pending_title 	= "Moji Dokumenti koji cekaju odobrenje";
$owl_lang->peer_approval_title 	= "Dokumenti koji cekaju MOJE odobrenje";
$owl_lang->owl_title_peer_review= "MOGUCNOST REVIZIJE DOKUMENATA";
$owl_lang->owl_title_peer_review2= "Revizija dokumenata";
$owl_lang->owl_peer_review	= "Ukljuci mogucnost revizije dokumenata:";
$owl_lang->owl_peer_review_opt  = "Revizija kao opcija:";
$owl_lang->peer_final_body_auto = "Vas dokument je odobren od svih trazenih revizora.<br />Vas fajl je objavljen.<br />";

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Dodavanje FAJL sigurnosnih opcija:";
$owl_lang->acl_adding_folder           = "Dodavanje DIREKTORIJ sigurnosnih opcija:";
$owl_lang->acl_available_groups        = "Postojece grupe";
$owl_lang->acl_available_users         = "Postojeci korisnici";
$owl_lang->acl_edit_file               = "Ispravljanje FAJL sigurnosnih opcija:";
$owl_lang->acl_edit_folder             = "Ispravljanje DIREKTORIJ sigurnosnih opcija:";
$owl_lang->acl_file_checkin            = "Zakljucavanje/Otkljucavanje";
$owl_lang->acl_file_comment            = "Komentar";
$owl_lang->acl_file_copy               = "Kopiraj";
$owl_lang->acl_file_delete             = "Brisi";
$owl_lang->acl_file_email              = "Salji na E-mail";
$owl_lang->acl_file_modify             = "Osobine";
$owl_lang->acl_file_monitor            = "Nadgledaj";
$owl_lang->acl_file_move               = "Premjesti";
$owl_lang->acl_file_read               = "Citaj";
$owl_lang->acl_file_search             = "Pretraziv";
$owl_lang->acl_file_set_acl            = "Postavi sigurnosne opcije";
$owl_lang->acl_file_update             = "Nadogradi";
$owl_lang->acl_file_view_log           = "Vidi LOG";
$owl_lang->acl_folder_copy             = "Kopiraj";
$owl_lang->acl_folder_delete           = "Brisi";
$owl_lang->acl_folder_modify           = "Ispravi Osobine";
$owl_lang->acl_folder_monitor          = "Nadgledaj";
$owl_lang->acl_folder_move             = "Premjesti";
$owl_lang->acl_folder_read             = "Citaj (Preuzmi/Pregledaj)";
$owl_lang->acl_folder_set_acl          = "Postavi sigurnosne opcije";
$owl_lang->acl_folder_write            = "Pisi (Kreiraj)";
$owl_lang->acl_heading_file            = "Grupe/Korisnici";
$owl_lang->acl_heading_files           = "FAJLOVI &#8211; OZNACITE ZELJENE KORISNIKE i GRUPE";
$owl_lang->acl_heading_folder          = "Grupe/Korisnici";
$owl_lang->acl_heading_folders         = "DIREKTORIJI &#8211; OZNACITE ZELJENE KORISNIKE i GRUPE";
$owl_lang->acl_propagate_file          = "Postavi ovu polisu \"NA SVE\" Fajlove:";
$owl_lang->acl_propagate_folders       = "Podijeli svim poddirektorijima:";
$owl_lang->acl_selected_groups         = "Odabrane grupe";
$owl_lang->acl_selected_users          = "Odabrani korisnici";
$owl_lang->acl_set_acl                 = "Postavi sigurnosnu polisu";
$owl_lang->acl_set_acl_now             = "Postavi sigurnosnu polisu SADA:";
$owl_lang->acl_set_selected            = "Postavi odabrano";
$owl_lang->alt_acl_save_file           = "SACUVAJ FAJL Sigurnosnu Polisu";
$owl_lang->alt_acl_save_folder         = "SACUVAJ DIREKTORIJ Sigurnosnu Polisu";
$owl_lang->btn_acl_save                = "SACUVAJ";
$owl_lang->acl_set_file_permissions    = "POSTAVI Fajl Dozvole";
$owl_lang->acl_set_folder_permissions  = "POSTAVI Direktorij Dozvole";
$owl_lang->alt_set_folder_acl          = "Postavi sadasnju DIREKTORIJ SIGURNOSU POLISU";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Dostupni izvjestaji:";
$owl_lang->report_file_folder               = "Fajl/Direktorij";
$owl_lang->report_filter                    = "Filter:";
$owl_lang->report_filter_since              = "Od:";
$owl_lang->report_full_access               = "PUNI PRISTUP";
$owl_lang->report_select_report             = "&#8211; Oznaci IZVJESTAJ &#8211;";
$owl_lang->report_users_disabled_title      = "Iskljuceni korisnici";
$owl_lang->report_users_entitlement         = "Lista prava korisnika";
$owl_lang->report_users_inactive_title      = "Neaktivni korisnici";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Omoguci THUMBNAIL pregled:";
$owl_lang->thumb_gen_thumb_tool_path       = "putanja do IMAGEMAGCK-a (path):";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Mplayer Parametri:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "putanja do do Mplayer-a (path):";
$owl_lang->thumb_image_info                = "Informacija o Slici";
$owl_lang->thumb_large_width               = "Thumbnail Sirina (VELIKI) / Piksela:";
$owl_lang->thumb_med_width                 = "Thumbnail Sirina (SREDNJI) / Piksela:";
$owl_lang->thumb_number_colums             = "Broj kolona kod THUMBNAIL pregleda:";
$owl_lang->thumb_re_generate               = "Generiraj Thumbnail";
$owl_lang->thumb_small_width               = "Thumbnail Sirina (MALI) / Piksela:";
$owl_lang->thumb_title                     = "THUMBNAIL PREGLED - OPCIJE";
$owl_lang->thumb_title_thumb_view          = "THUMBNAIL PREGLED - DETALJI";
$owl_lang->thumb_image_size                = "Velicina:";
$owl_lang->alt_thumb_small                 = "Mali Thumbnail";
$owl_lang->alt_no_thumb                    = "THUMBNAIL nije dostupan";

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
$owl_lang->watermark_string     = "Confidential";
$owl_lang->watermark_source     = "DoxBox " . DOXBOX_VERSION;

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
