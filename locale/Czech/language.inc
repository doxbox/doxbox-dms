<?php

/*
 * Soubor: Czech/language.inc
 * Autor: Milan Gutveis
 * Datum: 2007/4/23
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

//ini_set('default_charset', 'utf-8');
//mysql_qery("set names 'utf8' collate 'utf8_czech_ci'"); 
//mysql_qery("set charset set 'utf8_czech_ci'");

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
//$owl_lang->lang_code = "en";
$owl_lang->lang_code = "cz";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "Vy nejste oprávněni přidat komentář k tomuto souboru";
$owl_lang->err_backup_file   		= "Chyba při zálohování existujícího soubor";
$owl_lang->err_backup_folder_create 	= "Chyba při vytvoření zálohy složky";
$owl_lang->err_bad_url			= "Prosím vložte validní URL";
$owl_lang->err_bad_version_1 		= "Documement Management System vyžaduje minimální verzi PHP";
$owl_lang->err_bad_version_2 		= "Máte verzi";
$owl_lang->err_bad_version_3 		= "Instalujte novější verzi php a zkuste znova";
$owl_lang->err_comment_empty		= "Komentář nemůže být prázdný";
$owl_lang->err_email         		= "Zpráva nemůže být odeslána";
$owl_lang->err_email_required		= "Vyplňte pole s e-mailem";
$owl_lang->err_fexist1			= "<b>Soubor existuje:</b>";
$owl_lang->err_fexist2 			= "Již existuje soubor s tímto jménem <i>";
$owl_lang->err_fexist3 			= "</i> v tomto adresáři.";
$owl_lang->err_file_exists		= "Soubor které se pokoušíte nahrát již existuje";
$owl_lang->err_file_lock     		= "Nemůžete uzamknout tento soubor je právě se konná";
$owl_lang->err_file_not_exist		= "Soubor neexistuje ve filesystému";
$owl_lang->err_file_too_big		= "php.ini upload_maximální_velikost překročena a/nebo <br />Owl Maximální Upload souboru je velikost";
$owl_lang->err_file_update		= "Aktualizace soubor vyžaduje název souboru se stejným názvem, prosím zkuste znovu použít stejného jména souboru";
$owl_lang->err_fileexists    		= "Přesun se nezdařil<br />Soubor se stejným názvem již existuje.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "Zkuste název souboru přejmenovat soubor s tímto názvem již existuje";
$owl_lang->err_folder_create 		= "Chyba při vytvoření složky";
$owl_lang->err_folder_exist		= "Tato složka již existuje";
$owl_lang->err_folderexists  		= "Přejmenování se nezdařilo<br />Složka s tímto názvem již existuje.";
$owl_lang->err_general 			= "Nastala chyba";
$owl_lang->err_please_select_bulk	= "Prosím vyberte alespoň jeden soubor nebo složku pomocí zatrhávacího rámečku";
$owl_lang->err_select_reviewer		= "Prosím vyberte aspoň jednu osobu, která prohlédne váš dokument";
$owl_lang->err_update_file_lock     	= "Níní nemůžete soubor aktualizovat právě se vykonává";
// NEW CHANGE
$owl_lang->err_group_delete             = "Nemůžete smazat tuto skupinu: <font color=\"red\">%d</font> Soubor(y),  <font color=\"red\">%d</font> Složka(y), <font color=\"red\">%d</font> Uživatel(e) z této primární skupiny, <font color=\"red\">%d</font> Uživatel(e) kterí jsou členy této skupiny";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Nemůžete mazat jsou zde soubory používající tohoto dokumentu";
$owl_lang->err_database			= "Chyba Databaze";
$owl_lang->err_doc_field_req            = "Chyby požadované pole:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Je potřebný název dokumentu<br />";
$owl_lang->err_field_label_req 		= "Je potřebné vyplnit label<br />";
$owl_lang->err_field_name_req		= "Je potrebne zadat jmeno pole <br />";
$owl_lang->err_field_size_req		= "Velikost pole je potřebné zadat<br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Dočasný &ldquo;TEXT&rdquo; soubor nevytvořen";
$owl_lang->err_forbidden_file		= "Zakázaný typ souboru";
$owl_lang->err_group_exists		= "Již existuje skupina s tímto názvem.";
$owl_lang->err_gzip_not_found  		= "gzip nebyl nalezen v ";
$owl_lang->err_login			= "Prosím přihlašte se pro provedení požadované akce";
$owl_lang->err_movecancel    		= "Přesun byl zrušen<br />";
$owl_lang->err_nameempty    		= "Název složky nemůže být prázdný";
$owl_lang->err_news_required		= "CHYBA: Musíte vyplňit záhlaví i obsah!";
$owl_lang->err_no_access 		= "Nemáte povolen přístup k vybraným souborům";
$owl_lang->err_no_access_info 		= "Mohli nastat tyto problémy: <br />1) Nebylo zaškrtnuto zaškrtávácí políčko na začátku souboru či složky<br />2) Hromadné smazání, Hromadný E-Mail, Hromadné Uzamknutí nebylo aplikováno na složku<br />3) Nemáte přístup k jakémukoliv ze souborů nebo složek které jste vybrali.";
$owl_lang->err_noemail			= "Nemáte povolení pro poslání tohoto souboru";
$owl_lang->err_nofileaccess		= " Nemáte povolení pro přístup k tomuto souboru";
$owl_lang->err_nofiledelete		= " Nemáte právo pro smazání tohoto souboru";
$owl_lang->err_nofilemod		= "Nemáte právo upravit tento souboru";
$owl_lang->err_nofolderaccess		= "Nemáte dovolen přístup k této složce";
$owl_lang->err_nofolderdelete		= "Nemíte oprávnění k smazání této složky";
$owl_lang->err_nofoldermod		= "Nemáte právo upravit tento složky";
$owl_lang->err_nosubfolder		= "Nemáte právo pro vytvoření podložek";
$owl_lang->err_not_zip			= "Neplatbý Zip archiv";
$owl_lang->err_note_title               = "Musíte vyplňit nadpis";
$owl_lang->err_note_title_exists        = "Komentář s tímto názvem již existuje";
$owl_lang->err_noupload			= "Nemáte povolen přístup k nahrání této složky";
$owl_lang->err_pass_missmatch		= "Nové heslo se neshoduje se starým heslem";
$owl_lang->err_pass_wrong    		= "Zadali jste spatně staré heslo";
$owl_lang->err_please_select_bulk       = "Prosím zatrhněte alespoň jedno zaškrtavací políčko u souboru nebo složky";
$owl_lang->err_pod2html_not_found       = "CHYBA: pod2html nástroj nebyl nalezen:";
$owl_lang->err_quota			= "Nemáte dostatek místa pro nahrání souboru: ";
$owl_lang->err_quota_avail		= " k dispozici.";
$owl_lang->err_quota_exceed  		= "Překročili jste vaší kvótu";
$owl_lang->err_quota_needed		= " potřebný ";
$owl_lang->err_req			= "CHYBA: Všechna políčka jsou potřebná";
$owl_lang->err_root_delete		= "Kořenová složka nemůže být smazána";
$owl_lang->err_sess_notvalid 		= "Session id není validní";
$owl_lang->err_sess_write		= "Chyba při zápisu session informace do databáze";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; Tento název je rezervován pro produkt OWL";
$owl_lang->err_sql			= "Chyba SQL";
$owl_lang->err_tar_not_found  		= "tar nebyl nalezen v ";
$owl_lang->err_trash_can_empty 		= "Koš je vyprázdněn";
$owl_lang->err_unauth_area   		= "Nemáte právo pro užití této oblasti";
$owl_lang->err_unauthorized  		= "Neautorizovaný";
$owl_lang->err_upload 			= "Nahrávání selhalo";
$owl_lang->err_user_exists		= "Uživatelské jméno již existuje";
// NEW STUFF
$owl_lang->err_captcha_auth		= "CAPTCHA ověření selhalo";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Přidat Pole";//Field
$owl_lang->btn_add_file          = "Přidat Dokument";
$owl_lang->btn_add_folder          = "Přidat Složku";
$owl_lang->btn_add_news          = "Přidat Zprávy";
$owl_lang->btn_add_note          = "Přidat poznámku";
$owl_lang->btn_add_url          = "Přidat Url";
$owl_lang->btn_add_zip           = "Přidat Zip Archiv";
$owl_lang->btn_admin      = "Administrátor";
$owl_lang->btn_admin_groups          = "Nová Skupina";
$owl_lang->btn_admin_news          = "Zprávy pro Administrátora";
$owl_lang->btn_admin_user_group          = "Uživatel/Skupina Administrátor";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Nový Uživatel";
$owl_lang->btn_back          = "Jdi Nazpět";
$owl_lang->btn_browse     = "Prohlížet";
$owl_lang->btn_bulk_checkout       = "Hromadné Uzamknutí";
$owl_lang->btn_bulk_delete         = "Hromadné Smazání";
$owl_lang->btn_bulk_download          = "Hromadné Stažení";
$owl_lang->btn_bulk_email          = "Hromadný E-Mail";//bulk
$owl_lang->btn_bulk_move          = "Hromadný Přesun";
$owl_lang->btn_cancel          = "Zrušit";
$owl_lang->btn_clickhere          = "Klikněte Zde";
$owl_lang->btn_collapse_view          = "Zkrácený Náhled";
$owl_lang->btn_create          = "Vytvořit";
$owl_lang->btn_default_view          = "Defaultní Náhled";
$owl_lang->btn_deldoctype          = "Smazat Doc Typ";
$owl_lang->btn_download_bulk_package	= "Stáhnout Balík Hromadně";
$owl_lang->btn_edit_group          = "Editovat Skupinu";
$owl_lang->btn_edit_user          = "Editovat Uživatele";
$owl_lang->btn_expand_view          = "Rozšířený Náhled";
$owl_lang->btn_go_bottom      = "Přejít Dospod";
$owl_lang->btn_go_top      = "Přejít Do Horní Části";
$owl_lang->btn_help     = "Nápověda";
$owl_lang->btn_import_users  = "Importovat Uživatele";
$owl_lang->btn_login          = "Přihlásit Se";
$owl_lang->btn_logout     = "Odhlásit Se";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_register          = "Registrovat";
$owl_lang->btn_reset          = "Obnovit";
$owl_lang->btn_send_email          = "Poslat E-Mail";
$owl_lang->btn_submit          = "Potvrdit";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Podrobný Náhled";
$owl_lang->btn_trash_admin          = "Koš";
// NEW STUFF
$owl_lang->btn_export          = "Exportovat";
$owl_lang->btn_gen_pdf          = "Vytvořit PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Přidat komentář k tomuto dokumentu";
$owl_lang->alt_add_field	= "Přidat pole nahoře";
$owl_lang->alt_add_group	= "Vytvořit tuto skupinu";
$owl_lang->alt_add_news		= "Přidat novou zprávu";
$owl_lang->alt_add_user		= "Vytvořit tohoto uživatele";
$owl_lang->alt_admin_flush      = "Prošlí/Sešn vypršela";
$owl_lang->alt_admin_groups	= "Vytvořit novou skupinu";
$owl_lang->alt_admin_users	= "Vytvořit nového uživatele ";
$owl_lang->alt_approve_file 	= "Schválit tento dokument";
$owl_lang->alt_back      	= "Návrat na předchozí stránku";
$owl_lang->alt_btn_add_file     = "Nahrát nový soubor";
$owl_lang->alt_btn_add_folder	= "Nahrát novou složku";
$owl_lang->alt_btn_add_note     = "Vytvořit novou poznámku";
$owl_lang->alt_btn_add_url	= "Vytvořit nový Web link";
$owl_lang->alt_btn_add_zip     	= "Nahrát Zip soubor k extrahování";
$owl_lang->alt_btn_admin 	= "Owl Administrace";
$owl_lang->alt_btn_browse	= "Návrat do prohlížeče souborů";
$owl_lang->alt_btn_bulk_checkout= "Hromadné uzamknutí souborů";
$owl_lang->alt_btn_bulk_delete 	= "Hromadné smazání souborů";
$owl_lang->alt_btn_bulk_download= "Hromadné stažení souborů";
$owl_lang->alt_btn_bulk_email  	= "Hromadně E-Mailovat soubory";
$owl_lang->alt_btn_bulk_move   	= "Hromadný přesun souborů a složek";
$owl_lang->alt_btn_clickhere	= "Zde klikněte";
$owl_lang->alt_btn_collapse_view= "Přejít na redukovaný pohled";
$owl_lang->alt_btn_default_view = "Přejít na defaultní pohle";
$owl_lang->alt_btn_expand_view  = "Přejít na rozšířený pohled";
$owl_lang->alt_btn_help		= "Owl Online nápověda";
$owl_lang->alt_btn_login	= "Přihlášení do OWL systému";
$owl_lang->alt_btn_logout	= "Odhlásit z Owl systému";
$owl_lang->alt_btn_mail_tool   	= "Jednoduchý e-mailový nástroj";
$owl_lang->alt_btn_thumb_view   = "Přejít na podrobný pohled";
$owl_lang->alt_cancel		= "Zrušit tuto akci";
$owl_lang->alt_cancel_move	= "Zrušit akci přesun";
$owl_lang->alt_change		= "Aktualizujte tento záznam";
$owl_lang->alt_comments 	= "Komentář k tomuto souboru existuje";
$owl_lang->alt_copy_file     	= "Kopírovat dokument";
$owl_lang->alt_copy_folder   	= "Kopírovat složku";
$owl_lang->alt_del_all		= "Koš je prázdný";
$owl_lang->alt_del_comments     = "Smazat tento komentář";
$owl_lang->alt_edt_comments     = "Editovat tento komentář";
$owl_lang->alt_del_field	= "Smazat toto pole";
$owl_lang->alt_del_file      	= "Smazat dokument (A/N)";
$owl_lang->alt_del_folder    	= "Smazat složku (A/N)";
$owl_lang->alt_del_group	= "Smazat tuto skupinu";
$owl_lang->alt_del_news		= "Smazat tuto zprávu";
$owl_lang->alt_del_selected	= "Smazat všechny vybrané soubory";
$owl_lang->alt_del_this_folder	= "Smazat složku &#8211; ";
$owl_lang->alt_del_user		= "Smazat tohoto uživatele";
$owl_lang->alt_deldoctype	= "Smazat aktuální dokument";
$owl_lang->alt_edit_field	= "Editovat tyto definiční údaje";
$owl_lang->alt_edit_group       = "Editovat vybranou skupinu";
$owl_lang->alt_edit_news	= "Editovat tyto zprávy";
$owl_lang->alt_edit_user        = "Editovat vybrané uživatele";
$owl_lang->alt_email		= "E-Mailovat tento dokument";
$owl_lang->alt_email_reminder 	= "E-Mailovat upomínku";
$owl_lang->alt_email_selected	= "E-Mailovat všechny označené soubory";
$owl_lang->alt_get_file      	= "Stáhnout dokument";
$owl_lang->alt_get_folder      	= "Stáhnout obsah složky";
$owl_lang->alt_go_bottom      	= "Přejít do zápatí";
$owl_lang->alt_go_top 		= "Přejít do záhlaví ";
$owl_lang->alt_have_news	= "Máte zprávu(y) k náhledu";
$owl_lang->alt_have_no_news	= "Nemáté žádné zprávy k náhledu";
$owl_lang->alt_home_folder	= "Zpět do počátečního adresáře";
$owl_lang->alt_link_file     	= "Spojit dokument s jiným adresářem";
$owl_lang->alt_lock_file        = "Uzamknout dokument";
$owl_lang->alt_log_clear        = "Smazat veškeré Logy (A/N)";
$owl_lang->alt_log_file         = "Dokumentový Log";
$owl_lang->alt_log_next		= "Zobrazit další záznamy";
$owl_lang->alt_log_prev		= "Zobrazit předchozí záznamy";
$owl_lang->alt_log_top		= "Přejít na první záznam";
$owl_lang->alt_mod_file      	= "Modifikovat dokumentové vlastnosti"; 
$owl_lang->alt_mod_folder    	= "Modifikovat složkové vlastnosti";
$owl_lang->alt_monitor		= "Kontrolovat tento dokument";
$owl_lang->alt_monitor_folder   = "Kontrolovat tuto složku";
$owl_lang->alt_monitored	= "Přestat kontrolovat tento soubor";
$owl_lang->alt_monitored_folder = "Přestat kontrolovat tuto složku";
$owl_lang->alt_move_file     	= "Přesunout dokument";
$owl_lang->alt_move_folder   	= "Přesunout složku";
$owl_lang->alt_move_selected	= "Přesunout veškeré označené soubory";
$owl_lang->alt_my_approval	= "Dokument(y) čekají na schválení";
$owl_lang->alt_new_doctype	= "Vytvořit nový typ dokumentu";
$owl_lang->alt_news_close	= "Zavřít okno se zprávami";
$owl_lang->alt_news_next	= "Zobraz další zprávy";
$owl_lang->alt_news_prev	= "Zobraz předešlé zprávy";
$owl_lang->alt_news_print	= "Vytisknout tyto zprávy";
$owl_lang->alt_pending_approval	= "Dosud neschválené dokument(y)";
$owl_lang->alt_play_file 	= "Přehrát media dokument";
$owl_lang->alt_publish_file 	= "Publikovat dokument";
$owl_lang->alt_recycle		= "Koš<br />(prázdný)";
$owl_lang->alt_recycle_disable	= "Odpadní sbírka<br />(vyřazený)";
$owl_lang->alt_recycle_not_found= "Koš<br />(nenalezen)";
$owl_lang->alt_refresh_filter	= "Vyfiltorvat/ Obnovit výsledky";
$owl_lang->alt_register		= "Potvrdit vaší registraci";
$owl_lang->alt_reject_file 	= "Zamítnout tento dokument";
$owl_lang->alt_related		= "Najít související dokumenty";
$owl_lang->alt_reset_form	= "Vynulovat hodnoty";
$owl_lang->alt_rest_selected	= "Obnovyt veškeré vybrané soubory";
$owl_lang->alt_search		= "Zahájit vyledávání";
$owl_lang->alt_send_email	= "Poslat E-Mail";
$owl_lang->alt_sendfile		= "Poslat dokument";
$owl_lang->alt_set_initial_dir	= "Nastavit aktuální adresář jako výchozí";
$owl_lang->alt_site_map         = "Adresářová struktura";
$owl_lang->alt_submit      	= "Potvrdit tvar";
$owl_lang->alt_toggle_check_box	= "Přepínáací zaškrtávací boxy";
$owl_lang->alt_tool_status_green= "Nástroj je aktivní";
$owl_lang->alt_tool_status_red	= "Cesta je nesprávná A/NEBO není proveditelná";
$owl_lang->alt_unlock_file      = "Odemknout dokument";
$owl_lang->alt_upd_field	= "Aktualizovat pole";
$owl_lang->alt_upd_file      	= "Aktualizovat dokument";
$owl_lang->alt_view_comments    = "Přidat / nahlédnout na dokumentové komentáře";
$owl_lang->alt_view_file     	= "Náhled";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Recyklovat popelnicovou administraci";
$owl_lang->alt_edit_file_inline = "Editovat textový dokument";
$owl_lang->alt_gen_pdf          = "Generovat do PDF formátu";
$owl_lang->alt_updated     	= "Byla vytvořena nová verze dokumentu od vašeho posledního přihlášení";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Dokument byl vytvořen od vašeho posledního přihlášení";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Celý obsah byl zrušen";
$owl_lang->log_detail		= "Žádné další detaily";
$owl_lang->log_file_to		= "K: ";
$owl_lang->log_filter_all	= "Vše";
$owl_lang->log_login_det	= "Uživatelské jméno: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Skupina změněna: ";
$owl_lang->log_admin_changed_user = "Uživatel změněn: ";
$owl_lang->log_admin_created_group = "Skupina vytvořena: ";
$owl_lang->log_admin_created_user = "Uživatel vytvořen: ";
$owl_lang->log_admin_del_group = "Skupina smazána: ";
$owl_lang->log_admin_del_user = "Uživatel smazán: ";
$owl_lang->log_admin_disabled = " Uživatel vyřazen: ";
$owl_lang->log_admin_email_restore = "Soubory poslány:";
$owl_lang->log_admin_trash_delfile= "Soubory smazány: ";
$owl_lang->log_admin_trash_delfold = "Složky smazány: ";
$owl_lang->log_admin_trash_empty = "Koš vyprázdněn";
$owl_lang->log_admin_trash_restore = "Obnovit: ";
$owl_lang->log_login_expired    = "Prošlý učet uživatele: ";
$owl_lang->log_login_too_many_attempts = "Zrušeno (Mnoho špatných login pokusů): ";
$owl_lang->log_readhd_feature_add  = "Čtení přidáno pro tento soubor";
$owl_lang->log_admin_to  = "k";
$owl_lang->log_admin_of  = "z";
// END NEW STUFF
$log_file_actions[1]        	= "Přihlášení";
$log_file_actions[10]        	= "SOUBOR ODEMKNUT";
$log_file_actions[11]        	= "SOUBOR ODESLÁN";
$log_file_actions[12]        	= "SOUBOR PŘESUNUT";
$log_file_actions[13]        	= "SLOŽKA VYTVO5ENA";
$log_file_actions[14]        	= "SLOŽKA SMAZÁNA";
$log_file_actions[15]        	= "SLOŽKA MODIFIKOVÁNA";
$log_file_actions[16]        	= "SLOŽKA PŘESUNUTA";
$log_file_actions[17]        	= "HESLO ZAPOMENUTO";
$log_file_actions[18]        	= "UŽIVATEL REG";
$log_file_actions[19]           = "FILE VIEWED";
$log_file_actions[2]        	= "Přihlášení se nezdařilo";
$log_file_actions[20]           = "SOUBOR ZAVIROVÁN";
$log_file_actions[21]           = "SOUBOR ZKOPÍROVÁN";
$log_file_actions[22]           = "SLOŽKA ZKOPÍROVÁNA";
$log_file_actions[23]           = "SOUBOR SPOJEN";
$log_file_actions[3]        	= "ODHLÁSIT";
$log_file_actions[4]        	= "SOUBOR SMAZÁN";
$log_file_actions[5]        	= "SOUBOR NAHRÁN";
$log_file_actions[6]        	= "SOUBOR AKTUALIZOVÁN";
$log_file_actions[7]        	= "SOUBOR STAŽEN";
$log_file_actions[8]        	= "SOUBOR ZMĚNĚN";
$log_file_actions[9]        	= "SOUBOR ZAMČEN";
// BEGIN NEW STUFF
$log_file_actions[24]           = "UŽIVATEL ADMIN";
$log_file_actions[25]           = "KOŠ";
$log_file_actions[26]           = "SOUBOR ACL";
$log_file_actions[27]           = "SLOŽKA ACL";
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
$owl_lang->admin_login_date  = "Administrátor přihlášen na: ";
$owl_lang->admin_login_from  = "Administrátor přihlášen in from";
$owl_lang->admin_login_subject  = "ADMINISTRÁTOR LOGGIN";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Anonymní přístup)";
$owl_lang->engine 		= "Owl Engine MG";
$owl_lang->forgot_pass		= "Zopomněli jste heslo?";
$owl_lang->like_register	= "Chtěli by ste se zaregistrovat?";
$owl_lang->login		= "Přihlášení";
$owl_lang->logindisabled	= "Účet byl vyřazený, kontaktuje prosím Adminstratora systému";
$owl_lang->loginfail		= "Přihlášení se nepodařilo";
$owl_lang->password		= "Heslo";
$owl_lang->repository_list      = "Schránka";
$owl_lang->successlogout 	= "Byl(a) jste úspěšně odhlášen(a)";
$owl_lang->toomanysessions	= "Maximální počet uživatelů dosažen, kontaktujte prosím administrátora";
$owl_lang->username		= "Uživatelské jméno";
$owl_lang->forgot_username	= "Uživatelské jméno nebo Emailová adresa";
$owl_lang->version 		= "Verze";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Akce";
$owl_lang->current_db         		= "Aktualní schránka:";
$owl_lang->current_folder 		= "Aktuální složka:";
$owl_lang->del_all			= "Koš vyprázdněn";
$owl_lang->del_selected			= "Označené smazány";
$owl_lang->disk_quota			= "Kvóta disku";
$owl_lang->doc_number 			= "Doc číslo #";
$owl_lang->email_selected		= "E-Mail označen";
$owl_lang->file 			= "Soubor";
$owl_lang->folder_count_file		= "Soubor(y)";
$owl_lang->folder_count_folder		= "Složka(y)";
$owl_lang->folder_count_note		= "Poznámka(y)";
$owl_lang->folder_count_pre		= "Tato složka obsahuje";
$owl_lang->folder_count_url		= "URL(y)";
$owl_lang->folder_policy 		= "Aktuální složková politika:";
$owl_lang->held                      	= "Držet"; 
$owl_lang->last_logged			= "Poslední přihlášení: ";
$owl_lang->menu_file_action		= "Dostupné souborové akce";
$owl_lang->menu_folder_action		= "Dostupné složkové akce";
$owl_lang->menu_url_action		= "Dostupné URL akce";
$owl_lang->modified 			= "Upravený";
$owl_lang->move_selected		= "Vybrané přesunuty";
$owl_lang->new_file			= "Nové!";
$owl_lang->no_description		= "Nic neoznačeno";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Strana:";
$owl_lang->panel_file_info		= "Souborové informace";
$owl_lang->postedby 			= "Posláno od";
$owl_lang->reallydelete			= "Opavdu smazat";
$owl_lang->reallydelete_logs		= "Opravdu vyčistit souborový Log";
$owl_lang->reallydelete_selected	= "Opravdu vymazat všechny vybrané soubory";
$owl_lang->reallyrestore_selected	= "Opravdu obnovit všechny vybrané soubory";
$owl_lang->rest_selected		= "Vybrané obnoveny";
$owl_lang->score 			= "Stav";
$owl_lang->size 			= "Velikost";
$owl_lang->updated_by 			= "Aktualizováno";
$owl_lang->title 			= "Název";
$owl_lang->tot_files			= "Celkem:";
$owl_lang->tot_monitored		= "Kontrolováné:";
$owl_lang->tot_my_checked_out		= "Uzamknuté:";
$owl_lang->tot_my_files			= "Moje:";
$owl_lang->tot_my_group			= "Skupina:";
$owl_lang->tot_new_files		= "Nové:";
$owl_lang->tot_updated_files		= "Aktualizováné:";
$owl_lang->updated_file			= "Aktualizováno!";
$owl_lang->user               		= "Uživatel";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Uplynulí počet dnů :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Oblíbené";
$owl_lang->favorite_add = "Přidat aktuální";
$owl_lang->favorite_delete = "Smazat";
$owl_lang->favorite_go = "Přejít";
$owl_lang->files_in_my_group_title = "Soubory v mé skupině";
$owl_lang->my_files_title= "Moje soubory";
$owl_lang->my_monitored_title= "Můj sledovaný soubor(y)/složka(y)";
$owl_lang->my_special_access_title= "Speciální přístupový seznam";
$owl_lang->special_access_count_alt= "Speciální přístupové soubory/složky";
$owl_lang->special_access_count= "Speciální přístup:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Přidávání / prohlížení komentáře: ";
$owl_lang->addingfile 		= "Přidávání souboru k";
$owl_lang->addingfolder 	= "Přidávání složky k";
$owl_lang->attach_file		= "Připojit soubor";
$owl_lang->change		= "Vyměnit";
$owl_lang->comments      	= "Komentář";
$owl_lang->comments_added       = "Komentář vložen od: ";
$owl_lang->create		= "Vytvořeno";
$owl_lang->description 		= "Popis";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Píseň:<br />Album:<br />Bitoví&nbsp;-&nbsp;Kolekce:<br />Doba:<br />Žánr:<br />Komentáře:";
$owl_lang->email_body		= "Zpráva";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Odpovědět na";
$owl_lang->email_subject	= "Předmět";
$owl_lang->email_to		= "E-Mail komu";
$owl_lang->emailing		= "Pošta";
$owl_lang->keywords 		= "Klíčové slovo";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Modifikování ";
$owl_lang->name               	= "Jméno"; 
$owl_lang->none_selected        = "Nevybráno";
$owl_lang->note_content         = "Vyplňit obsah";
$owl_lang->notify_link          = "Owl Externí spojení";
$owl_lang->ownergroup         	= "Vlastník (Skupiny)";
$owl_lang->ownership		= "Vlastnictví";
$owl_lang->permissions 		= "Oprávnění";
$owl_lang->pick_select		= "&#8211; Vyberte OWL uživatele &#8211;";
$owl_lang->policy 		= "Politika";
$owl_lang->post_comment		= "Vložit komentář";
$owl_lang->prop_permissions 	= "Propafujte povolení podřízeným složkám?";
$owl_lang->prop_perms_files 	= "Povolení propagace souborů";
$owl_lang->sendfile 		= "Poslat soubor";
$owl_lang->sendthisfile 	= "Poslat tento soubor";
$owl_lang->sendthisurl       	= "Poslat toto URL";
$owl_lang->updating		= "Aktualnizace";
$owl_lang->verdescription 	= "Popis<br />změn";
$owl_lang->vermajor          	= "Hlavní změna";
$owl_lang->verminor          	= "Méně důležitá změna";
$owl_lang->vertype           	= "Změna typu";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Uložit klíčové slovo?";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "E-Mailová adresa";
$owl_lang->full_name		= "Celé jméno";
$owl_lang->register		= "Uživatelská registrace";
$owl_lang->self_failed		= "Nezdařilo se";
$owl_lang->self_passwd		= "Poslat heslo na:";
$owl_lang->self_reg_bod		= "Vaše Owl heslo je:";
$owl_lang->self_reg_rset	= "Vaše Owl heslo bylo obnoveno na:";
$owl_lang->self_reg_subj	= "Váš OWL účet";
$owl_lang->send_pass		= "Poslat heslo";
$owl_lang->submit		= "Registr";
$owl_lang->thank_you_1		= "Děkuji!";
$owl_lang->thank_you_2		= "Vaše heslo bylo odesláno na Váši e-mailovou adresu";
$owl_lang->thank_you_3		= "Váš účet musí být povolen administrátorem předtím, než se budete moct přihlásit do systému.";

//NEW STUFF

$owl_lang->captcha_typein        = "Napište 5 znaků";
$owl_lang->change_pass_title	      = "HESLO ZMĚNĚNO";
$owl_lang->err_cant_reuse_passwords   = "Nemůžete znovu použít stejné hesla";
$owl_lang->err_new_confirm_different  = "Vaše nové a potvrzené hesla se neshodují<br />";
$owl_lang->err_old_pass_ver_failed    = "Vaše staré heslo nebylo zadáno správně<br />";
$owl_lang->err_pass_restriction_1     = "Vaše heslo potřebuje být přinejmenším &ldquo;%s&rdquo; znaků dlouhé <br />";
$owl_lang->err_pass_restriction_2     = "Musí obsahovat přinejmenším &ldquo;%s&rdquo; čísla [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "a přinejmenším &ldquo;%s&rdquo; speciálních znaků [ ~!@#$&37;^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Vámy vybraný uživatel &ldquo;%s&rdquo; je %d znaků dlouhý ale musí být přinejmenším %d znaků dlouhý.";
$owl_lang->pass_change_email_1        = "Vaše heslo nebylo resetováno dokud nepoužíváte OWL ověření pravosti";
$owl_lang->pass_change_email_2        = "Váš ověření je: ";
$owl_lang->pass_change_email_3        = "Kontaktujte administrátora, aby Vám pomohl";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Zrušit";
$owl_lang->copy_file		= "Kopírování souboru";
$owl_lang->copy_folder		= "Kopírování složky";
$owl_lang->moving		= "Přesouvání";
$owl_lang->moving_file		= "Přesouvání soboru";
$owl_lang->moving_folder	= "Přesouvání složky";
$owl_lang->select		= "Prosím vyberte novou složku:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Pohled na registraci ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Změny od";
$owl_lang->diff_to	= "Změny k";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Oznamovací komentář";
$owl_lang->confpassword	= "Potvrďtě nové heslo";
$owl_lang->email_tool	= "E-Mailové nástroje";
$owl_lang->group	= "Primární skupina";
$owl_lang->groupmember	= "Člen skupin(y)";
$owl_lang->last_modified= "Poslední modifikace";
$owl_lang->newpassword	= "Nové heslo";
$owl_lang->newsadmin	= "Zprávy od administrátora";
$owl_lang->not_member	= "Nejste členem žádné další skupiny";
$owl_lang->notification	= "Příjmout hlášení";
$owl_lang->oldpassword	= "Staré heslo";
$owl_lang->preference	= "Předvolby";
$owl_lang->saved	= "&#8212; Z M Ě N A S&nbsp;&nbsp;&nbsp;U L O Ž E N A &#8212;";
$owl_lang->status_no	= "NE";
$owl_lang->status_yes	= "ANO";
$owl_lang->userlang	= "Jazyk";

//NEW STUFF
$owl_lang->useradmin	= "Uživatel Administrátor";
$owl_lang->viewlogs     = "Chcete vidět systémové protokoly";
$owl_lang->viewreports  = "Chcete vidět systémové zprávy";
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

$owl_lang->elapsed_time       	= "uplynulá doba";
$owl_lang->query_empty       	= "Prázdný vyhledávací řetezec";
$owl_lang->related_query_empty  = "Žádná metadata související s dokumentem provést &ldquo;Související Hledání&rdquo;";
$owl_lang->search             	= "Vyhledat";
$owl_lang->search_all_word	= "Všechny slova";
$owl_lang->search_any_word	= "Žádná slova";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Vyhledat aktuální složku";
$owl_lang->search_entire_phrase	= "Celý výraz";
$owl_lang->search_for_files 	= "Hledání souborů";
$owl_lang->search_for_folders 	= "Hledání složek";
$owl_lang->search_match 	= "Srovnat:";
$owl_lang->search_results_for	= "Vyhledávací výsledky pro";
$owl_lang->search_score 	= "Vyhodnocovací soubory";
$owl_lang->search_winthindocs   = "Hledání uvnitř";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Prohlížení ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Zobrazit rozšířený souborový informační panel";
$owl_lang->allow_track_favorite         = "Dovolit uživatelům sledovat oblíbené";
$owl_lang->admin_login_to_browse_page	= "administrátorská stránka přihlášených";
$owl_lang->alt_btn_backup		= "Zálohovat SQL Databázi";
$owl_lang->alt_btn_doctype_admin	= "Dokument Typu Administrátor";
$owl_lang->alt_btn_html_prefs		= "Editovat polohu HTML předvolby";
$owl_lang->alt_btn_log_viewer		= "Owl Systém pro přehled logování";
$owl_lang->alt_btn_news_admin		= "Owl administrátorovi zprávy";
$owl_lang->alt_btn_site_features	= "Editovat vzhled a nastavení";
$owl_lang->alt_btn_statistics_viewer	= "Owl přehled statistik";
$owl_lang->alt_btn_users_groups		= "Spravovat uživatele a skupiny";
$owl_lang->btn_backup			= "Záloha<br />Databáze";
$owl_lang->btn_doctype_admin		= "Dokument<br />Typu";
$owl_lang->btn_html_prefs		= "HTML<br />předvolnby";
$owl_lang->btn_log_viewer		= "Logovací<br />prohlížeč";
$owl_lang->btn_news_admin		= "Zprávy<br />Admina";
$owl_lang->btn_site_features		= "Lokalizace<br />vzhledu";
$owl_lang->btn_statistics_viewer	= "<br /> Prohlížeč Statistik / Zpráv ";
$owl_lang->btn_users_groups		= "Uživatelé &amp;<br />Skupiny";
$owl_lang->display_password_override	= "Zobrazit soubor/Potlačit heslo složky";
$owl_lang->doc_id_num_digits		= "Doc# číslici zobrazit";
$owl_lang->doc_id_prefix		= "Doc# Zobrazit Prefix Řetězec"; 
$owl_lang->docicon_column		= "Doc Ikona";
$owl_lang->download_folder_zip		= "Stáhnout složky jako zip (standard je tar.gz)";
$owl_lang->save_keywords_to_db		= "Dovolit uživatelům uložit klíčová slova pro opětovné použití";
$owl_lang->status_column		= "Stav";
$owl_lang->vermajor_initial          	= "Počáteční majoritní oprava";
$owl_lang->verminor_initial          	= "Počáteční minoritní oprava";
$owl_lang->view_doc_in_new_window	= "Otevřít nové okno pro prohlížení dokumentů";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Editace uživatele *****";
$owl_lang->edit_group  			= "***** Editace skupiny *****";
$owl_lang->enter_new_user               = "***** Přidávání nového uživatele *****";
$owl_lang->enter_new_group              = "***** Přidávání nové skupiny  *****";
$owl_lang->alt_btn_change_passwd        = "Změna Vašeho starého hesla";
$owl_lang->alt_btn_cln_history          = "Vymazat dokumenty které jsou starší než(dní): ";
$owl_lang->alt_btn_log_viewer           = "Owl Systém pro přehled logování";
$owl_lang->alt_btn_report_viewer        = "Owl přehled zpráv";
$owl_lang->btn_change_passwd            = "Změna hesla";
$owl_lang->btn_cln_history              = "Vymazat historii";
$owl_lang->btn_log_viewer               = "Systémová Loga";
$owl_lang->btn_report_viewer            = "Zprávy";
$owl_lang->confirm_cln_history          = "Jste si jistí, že chcete vymazat dokumenty stařsí než(dní): ";
$owl_lang->historical_purge             = "Soubory z historie smazány";

// END NEW STUFF
$owl_lang->add				= "Přidat";
$owl_lang->alt_btn_initial_load		= "Nahrát DB z dokumentové složky";
$owl_lang->alt_btn_trashcan		= "Klikněte pro náhled obsahu";
$owl_lang->anonymous_account		= "Anonymní přístupový účet:";
$owl_lang->btn_initial_load		= "Počáteční náplň";
$owl_lang->btn_trashcan			= "Koš";
$owl_lang->buttonstyle                  = "Styl tlačítek";
$owl_lang->confirm_initial_load		= "*** VAROVÁNÍ ***  Toto by mělo běžet pouze když je databáze prázdná";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Smazat skupinu";
$owl_lang->deleteuser			= "Smazat uživatele";
$owl_lang->disable_recs_per_page	= "Zvolený omezený náhled vymění záznamy za stránku!";
$owl_lang->disableuser			= "Vyřadit uživatele";
$owl_lang->file_admin_group		= "Prohlížeč Soubor/Admin skupin:";
$owl_lang->flushed           		= "Sešn tebulka naplněna, nyní se uživatel může znovu přihlásit.";
$owl_lang->groups			= "Skupiny";
$owl_lang->hide_bulk_buttons		= "Schovat hromadná tlačítka:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Cesta podoby pozadí:";
$owl_lang->ht_bd_lnk_cl			= "Barva pro link:";
$owl_lang->ht_bd_txt_cl 		= "Barva textu:";
$owl_lang->ht_bd_vlnk_cl 		= "Barva navštíveného linku:";
$owl_lang->ht_collapse_width 		= "Šířka daného náhledu:";
$owl_lang->ht_expand_width		= "Šířka rozšířeného náhledu:";
$owl_lang->ht_tbl_border_sz 		= "Velikost okraje tabulky:";
$owl_lang->ht_tbl_cell_bg_al 		= "Alternativní barva pozadí buňky tabulky:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Barva pozadí buňky tabulky:";
$owl_lang->ht_tbl_hd_bg			= "Pozadí hlavičky:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Nastavit anonymní přístup";
$owl_lang->header_group_admin           = "Administrace skupin";
$owl_lang->header_sitefeatures_settings           = "Vzhled a nastavení";
$owl_lang->header_user_admin           	= "Administrace  uživatelů";
$owl_lang->hide_folder_doc_count	= "Skrýt čítač složek";
$owl_lang->hide_folder_size		= "Skrýt obsah složek";
$owl_lang->hide_panel			= "Skrýt";
$owl_lang->home_dir			= "Uživatelský domovský adresář:";
$owl_lang->initial_dir   		= "Počáteční uživatelský adresář";
$owl_lang->maxsessions			= "Maximum sešnů";
$owl_lang->noprefaccess			= "Vyřadit předvolby";
$owl_lang->old_action_icons		= "Používáte Owl 0.80 Ikony";
$owl_lang->owl_anon_download     	= "Pouze stáhnutelné";
$owl_lang->owl_anon_full		= "Neomezený přístup";
$owl_lang->owl_anon_ro			= "Pouze ke čtení";
$owl_lang->owl_dbdump_path   		= "DB cesty k nástrojům:";
$owl_lang->owl_def_file_group_owner	= "Defaultní soubor skupiny vlastníků:";
$owl_lang->owl_def_file_meta		= "Defaultní soubor MetaDat:";
$owl_lang->owl_def_file_owner		= "Defaultní soubor vlastníků:";
$owl_lang->owl_def_file_perm 		= "Defaultní soubor vytvoření politiky:";
$owl_lang->owl_def_file_security	= "Defaultní soubor ochrany:";
$owl_lang->owl_def_file_title		= "Defaultní soubor názvů:";
$owl_lang->owl_def_fold_group_owner	= "Defaultní složka skupiny vlastníků:";
$owl_lang->owl_def_fold_owner		= "Defaultní složka vlastníků:";
$owl_lang->owl_def_fold_sec		= "Defaultní složka ochrany:";
$owl_lang->owl_def_folder_perm 		= "Defaultní složka vytvoření politiky:";
$owl_lang->owl_default_tmpdir		= "Soubor temp: ";
$owl_lang->owl_email_from		= "Z adresy:";
$owl_lang->owl_email_fromname		= "Od koho:";
$owl_lang->owl_email_replyto		= "Opovědět na adresu:";
$owl_lang->owl_email_server		= "SMTP Servr:";
$owl_lang->owl_email_smtp		= "Využít metody SMTP Mailing ";
$owl_lang->owl_email_smtp_auth		= "Použít SMTP Autorizaci";
$owl_lang->owl_email_smtp_auth_login	= "SMTP autorizace pro přihlášení:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP autorizace pro heslo";
$owl_lang->owl_email_subject_pref	= "Předmět:";
$owl_lang->owl_fogotpass		= "Zobrazit link, když jste zapomeněli heslo:";
$owl_lang->owl_group_user		= "Uživatelé, kterí jsou členy této skupiny";
$owl_lang->owl_gzip_path     		= "gzip cesta:";
$owl_lang->owl_hidebackup		= "Skrýt záložní adresář:";
$owl_lang->owl_log_file			= "Log souborové aktivity:";
$owl_lang->owl_log_login_act		= "Log přihlašovací/odhlašovací činnosti:";
$owl_lang->owl_log_rec_page		= "Log prohlížeč záznamů na stránku:";
$owl_lang->owl_logging			= "Umožnit přihlášení:";
$owl_lang->owl_logo			= "Přihlašovací logo([Jazyk]/grafika):";
$owl_lang->owl_lookAtHD			= "Vyřadit pohled na hd:";
$owl_lang->owl_lookAtHDDel		= "Odtranit smazané soubory z databáze";
$owl_lang->owl_max_filesize		= "Maximální velikost souboru pro nahrání(v bajtech)";
$owl_lang->owl_owl_expand		= "Defaultní prohlížeč(rozšířšný)";
$owl_lang->owl_owl_timeout		= "Překročení časového limitu pro sešn";
$owl_lang->owl_pdftotext_path		= "Maintain Search Index for <br />PDF and text Files <br />&#8211; Blank for Disabled:";
$owl_lang->owl_pod2html_path            = "Je potřeba Perl verze 5.8.0 nebo vyšší<br />cesta k pod2html:";
$owl_lang->owl_restrict_view		= "Umožnit použití soukromého vzhledu:";
$owl_lang->owl_self_reg			= "Umožnit vlastní registr:";
$owl_lang->owl_self_reg_hd		= "UMOŽNIT VLASTNÍ UŽIVATELSKÉ NASTAVENÍ";
$owl_lang->owl_tar_path     		= "tar cesta:";
$owl_lang->owl_title_browser		= "OWL vzhled prohlížeče";
$owl_lang->owl_title_custom		= "Přizpůsobit sloupce prohlížeče";
$owl_lang->owl_title_custom_search      = "Přizpůsobit vyhledáváč";
$owl_lang->owl_title_defaults   	= "Standartní";
$owl_lang->owl_title_email		= "OWL nastavení systému pro E-Mail";
$owl_lang->owl_title_HD			= "Podívat se na HD pro nové souborové nastavení";
$owl_lang->owl_title_logging  		= "NASTAVENÍ PŘIHLAŠENÍ";
$owl_lang->owl_title_other		= "OSTATNÍ NASTAVENÍ";
$owl_lang->owl_title_tools   		= "ZÁLOHA DB/NÁSTROJE GZIP";
$owl_lang->owl_unzip_path     		= "unzip cesta:";
$owl_lang->owl_version_control		= "Umožnit Control verzovač:";
$owl_lang->owl_wordtotext_path          = "MS-WORD soubory <br />&#8211; blokovány:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPOINT soubory <br />&#8211; blokovány:";
$owl_lang->quota			= "Kvóta 0=zakázána";
$owl_lang->reallydeluser		= "Tento uživatel je vlastníkem %numfiles% souboru(ů) a %numfolders% složky(ek). Tyto soubory a složky budou bez vlastníka. Pořád trváte na smazání?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Zobrazení záznamů na tránku(0 = zakázáno):";
$owl_lang->recycle_enabled		= "Umožnit koš:";
$owl_lang->recycle_location		= "Umístění koše:";
$owl_lang->recycle_title		= "NASTAVENÍ KOŠE";
$owl_lang->remember_me			= "Zobrazit spojení na mě";
$owl_lang->remember_me_checkbox		= "Zapamatovat si mě";
$owl_lang->remember_me_title		= "TRVALÉ NASTAVENÍ PŘIHLÁŠENÍ";
$owl_lang->remember_timeout		= "Cookie čas vypršel ve dnech";
$owl_lang->restore_file_prefix		= "Řetězcoví prefix k obnoveným souborům";
$owl_lang->search_result_folders	= "Zahrnout složky do vyhledávacích výsledků";
$owl_lang->show_action_title		= "Zobrazit tlačítka pro akce:";
$owl_lang->show_bulk_title		= "Zobazit hromadná tlačítka:";
$owl_lang->show_folder_title		= "Zobrazit nástoje složek:";
$owl_lang->show_panel			= "Zobrazit";
$owl_lang->show_panel_title		= "Zobrazit Display panel stavů:";
$owl_lang->show_pref_title		= "Zobrazit předolby/přihlašování:";
$owl_lang->show_search_title		= "Zobrazit vyhledávač:";
$owl_lang->status_bar_both              = "Vrch a spodek";
$owl_lang->status_bar_bottom            = "Pouze spodek";
$owl_lang->status_bar_location          = "Zobrazit stavoví řádek:";
$owl_lang->status_bar_not               = "Nezobrazovat";
$owl_lang->status_bar_top               = "Pouze vrch";
$owl_lang->use_popup			= "Použít roletku k zobrazování zpráv:";
$owl_lang->users           		= "Uživatelé";
$owl_lang->virus_path			= "Cesta k antiviru<br />Například: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Blank for Disabled:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Uživatelské pole uvnitř roletky";
$owl_lang->cust_headpopup     		= "SPECIFICKÉ DOKUMENTOVÉ POLE";
$owl_lang->auth_http                    = "HTTP legalizace (.htaccess)";
$owl_lang->auth_ldap                    = "LDAP legalizace";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Uživatelé, kteří mají tuto skupinu jako PRIMÁRNÍ skupinu";
$owl_lang->create_user_homedir 		= "Vytvořit uživatelský domovský adresář:";
$owl_lang->use_captcha 			= "Použít CAPTCHA:";
$owl_lang->created_here 		= "<br /> (VYTVOŘIT ZDE pokud je vytvořen domovský adresář)";
$owl_lang->auth_owl                     = "Owl legalizace";
$owl_lang->auth_pop3                    = "pop3 legalizace";
$owl_lang->file_desc_required           = "Povolit souboroví popis";
$owl_lang->folder_desc_required         = "Povolit složkoví popis";
$owl_lang->html_title			= "HTML předvolby";
$owl_lang->pass_account_lockout         = "Počet pokusů o uzamčení:";
$owl_lang->pass_change_every            = "Platnost hesla měnit každých (dnů) 0=zakázáno:";
$owl_lang->pass_enable_account_lockout  = "Umožnit účtové uzamčení:";
$owl_lang->pass_min_passwd_length       = "Minimum délka hesla:";
$owl_lang->pass_min_passwd_numeric      = "Minimum počet číslic:";
$owl_lang->pass_min_passwd_special      = "Minimum počet speciálních znaků:";
$owl_lang->pass_min_username_length     = "Minimum délka uživatelského jména:";
$owl_lang->pass_track_old_passwords     = "Počet předchozích hesel, která jsou sledována:";
$owl_lang->rtftotext_path                = "Změna RTF na Text cesta";
$owl_lang->show_user_info           = "Zobrazení uživatelských jmen kliknutím myši";
$owl_lang->user_admin              = "Admininstrátorský Uživatel/skupina";
$owl_lang->user_auth_type                   = "Ověření pravosti:";
$owl_lang->user_change_pass_next_login      = "Změnit heslo při dalším přihlášení do systému:";
$owl_lang->user_expires                     = "Účet vyprší za:";
$owl_lang->user_gmt_offset              = "Uživatel GMT je Offset";
$owl_lang->user_group_admin                 = "Spravovat soubor pro primární skupinu:";
$owl_lang->user_login_to_newrecords         = "Připojit nové záznamy na stránku:";
$owl_lang->users_group_admin		= "Uživatelé, kteří jsou admini skupin";
$owl_lang->time_offsets[0][0] = "-12";
$owl_lang->time_offsets[0][1] = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0] = "-11";
$owl_lang->time_offsets[1][1] = "(GMT-11:00) Midway Island, Samoa";
$owl_lang->time_offsets[2][0] = "-10";
$owl_lang->time_offsets[2][1] = "(GMT-10:00) Hawaii";
$owl_lang->time_offsets[3][0] = "-9";
$owl_lang->time_offsets[3][1] = "(GMT-9:00) Alaska";
$owl_lang->time_offsets[4][0] = "-8";
$owl_lang->time_offsets[4][1] = "(GMT-8:00) Pacifický čas (US &amp; Canada)";
$owl_lang->time_offsets[5][0] = "-7";
$owl_lang->time_offsets[5][1] = "(GMT-7:00) Mountain čas (US &amp; Canada)";
$owl_lang->time_offsets[6][0] = "-6";
$owl_lang->time_offsets[6][1] = "(GMT-6:00) Central čas (US &amp; Canada), Mexico City";
$owl_lang->time_offsets[7][0] = "-5";
$owl_lang->time_offsets[7][1] = "(GMT-5:00) Středoevropský čas , Praha, Pardubice, Litomyšl, Brussels, Copenhagen, Madrid, Paris";//Eastern čas (US &amp; Canada), Bogota, Lima, Quito";
$owl_lang->time_offsets[8][0] = "-4";
$owl_lang->time_offsets[8][1] = "(GMT-4:00) Atlantic čas (Canada), Caracas, La Paz";
$owl_lang->time_offsets[9][0] = "-3.5";
$owl_lang->time_offsets[9][1] = "(GMT-3:30) Newfoundland";
$owl_lang->time_offsets[10][0] = "-3";
$owl_lang->time_offsets[10][1] = "(GMT-3:00) Brazil, Buenos Aires, Georgetown";
$owl_lang->time_offsets[11][0] = "-2";
$owl_lang->time_offsets[11][1] = "(GMT-2:00) Mid-Atlantic";
$owl_lang->time_offsets[12][0] = "-1";
$owl_lang->time_offsets[12][1] = "(GMT-1:00) Azores, Cape Verde Islands";
$owl_lang->time_offsets[13][0] = "0";
$owl_lang->time_offsets[13][1] = "(GMT) Západoevropský čas, London, Lisbon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) Eastern čas (US &amp; Canada), Bogota, Lima, Quito"; //Středoevropský čas , Praha, Pardubice, Brussels, Copenhagen, Madrid, Paris";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) Východoevropský čas, Kaliningrad, South Africa";
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

$owl_lang->owl_log_filter	= "Filtr";
$owl_lang->owl_log_hd_action	= "Akce";
$owl_lang->owl_log_hd_agent	= "Agent";
$owl_lang->owl_log_hd_dt_tm	= "Datum";
$owl_lang->owl_log_hd_dtls	= "Detaily";
$owl_lang->owl_log_hd_file	= "Soubor";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Cesta ke složce";
$owl_lang->owl_log_hd_ip	= "IP / Adresa";
$owl_lang->owl_log_hd_user	= "Uživatel";
$owl_lang->owl_log_hide      	= "Skrýt: ";
$owl_lang->owl_log_no_rec	= " ŽÁDNÉ ZÁZNAMY NENALEZENY ";
$owl_lang->owl_log_viewer	= "Prohlížeč logů";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Koš je prázdný";
$owl_lang->really_empty_trash	= "Opravdu chcete vyprázdnit koš?";
$owl_lang->recycle_bin_admin    = "Administrace koše";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Soubory, které jste požadovali jsou připojeny.";
$owl_lang->trash_email_subject  = "VYŽÁDAT OBNOVENÍ SOUBORů";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Nic nedělejte &#8211; Odejděte ze souborového povolování";
$owl_lang->everyoneread			= "Kdokoliv může číst/stahovat";
$owl_lang->everyoneread_ad		= "Kdokoliv může číst/stahovat";
$owl_lang->everyonewrite		= "Kdokoliv může číst/zapisovat/stahovat";
$owl_lang->everyonewrite_ad		= "Kdokoliv může číst/zapisovat/stahovat";
$owl_lang->everyonewrite_ad_nod		= "Kdokoliv může číst/zapisovat/stahovat, MAZAT NE";
$owl_lang->everyonewrite_nod		= "Kdokoliv může číst/zapisovat/stahovat, MAZAT NE";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Kdokoliv může číst tuto složku";
$owl_lang->geveryoneread_ad		= "Kdokoliv může číst tuto složku";
$owl_lang->geveryonewrite		= "Kdokoliv může nahrát soubory a smazat tuto složku";
$owl_lang->geveryonewrite_ad		= "Kdokoliv může nahrát soubory a smazat tuto složku";
$owl_lang->geveryonewrite_ad_nod	= "Kdokoliv může aktualizovat soubory v této složce";
$owl_lang->geveryonewrite_nod		= "Kdokoliv může aktualizovat soubory v této složce";
$owl_lang->ggroupread			= "Vaše skupina má oprávnění ke čtení této složky";
$owl_lang->ggroupread_ad		= "Označená skupina může číst tuto složku";
$owl_lang->ggroupwrite			= "Vaše skupina může nahrávat soubory do a mazat tuto složku";
$owl_lang->ggroupwrite_ad    		= "Označená skupina může nahrávat soubory a smazat tuto složku";
$owl_lang->ggroupwrite_ad_nod		= "Označená skupina může nahrávat soubory do této složky";
$owl_lang->ggroupwrite_nod		= "Vaše skupina může nahrávat soubory do této složky";
$owl_lang->ggroupwrite_worldread 	= "Vaše skupina může nahrávat soubory a smazat tuto složku &amp; kdokoliv jiný může nahlédnout do obsahu";
$owl_lang->ggroupwrite_worldread_ad 	= "Označená skupina může nahrávat soubory a smazat tuto složku &amp; kdokoliv jiný může nahlédnout do obsahu";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Označená skupina může nahrávat soubory do této složky &amp; kdokoliv jiný může nahlédnout do obsahu, MAZAT NE";
$owl_lang->ggroupwrite_worldread_nod 	= "Vaše skupina může nahrávat soubory do této složky &amp; kdokoliv jiný může nahlédnout do obsahu, MAZAT NE";
$owl_lang->gonlyyou			= "Můžete pouze nahrávat soubory a smazat tuto složku";
$owl_lang->gonlyyou_ad			= "Můžete pouze nahrávat soubory a smazat tuto složku";
$owl_lang->groupread			= "Vaše skupina může číst/stahovat";
$owl_lang->groupread_ad			= "Označená skupina může číst/stahovat";
$owl_lang->groupwrite			= "Vaše skupina může číst/zapisovat/stahovat";
$owl_lang->groupwrite_ad		= "Označená skupina může číst/zapisovat/stahovat";
$owl_lang->groupwrite_ad_nod		= "Označená skupina může číst/zapisovat/stahovat, MAZAT NE";
$owl_lang->groupwrite_nod		= "Vaše skupina může číst/zapisovat/stahovat, MAZAT NE";
$owl_lang->groupwrite_worldread 	= "Vaše skupina může číst/zapisovat/stahovat &amp; kdokoliv jiný může číst";
$owl_lang->groupwrite_worldread_ad 	= "Označená skupina může číst/zapisovat/stahovat &amp; kdokoliv jiný může číst";
$owl_lang->groupwrite_worldread_ad_nod 	= "Označená skupina může číst/zapisovat/stahovat (MAZAT NE) &amp; kdokoliv jiný může číst";
$owl_lang->groupwrite_worldread_nod 	= "Vaše skupina může číst/zapisovat/stahovat (MAZAT NE) &amp; kdokoliv jiný může číst";
$owl_lang->invalidsess			= "Neplatné sešn id, prosím přihlašte se z hlavní stránky<br />";
$owl_lang->notif_comment_1		= "Komentovaný";
$owl_lang->notif_comment_2		= "Komentář:";
$owl_lang->notif_msg         		= "TOTO JE AUTOMATICKÁ ZPRÁVA OD OWL<br /><br />Najít nový/aktualizovaný soubor napojený na E-Mail<br /><br />";
$owl_lang->notif_msg_alt         	= "TOTO JE AUTOMATICKÁ ZPRÁVA OD OWL\n\nNajít nový/aktualizovaný soubor napojený na E-Mail\n\n";
$owl_lang->notif_msg_alt_link           = "TOTO JE AUTOMATICKÁ ZPRÁVA OD OWL\n\nNajít link k novému/aktualizovanému souboru v tomto E-Mailu\n\n";
$owl_lang->notif_msg_link               = "TOTO JE AUTOMATICKÁ ZPRÁVA OD OWL<br /><br />Najít link k novému/aktualizovanému souboru v tomto E-Mailu<br /><br />";
$owl_lang->notif_salutation		= "Vážený";
$owl_lang->notif_subject_comment	= "OWL soubor -- komentář přidán";
$owl_lang->notif_subject_monitor	= "OWL soubor nebo složka, které jsou POZOROVÁNY byly aktualizovány";
$owl_lang->notif_subject_new 		= "Nový OWL soubor";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "OWL soubor byl aktualizován";
$owl_lang->notif_subject_file_deleted   = "SOUBOR BYL SMAZÁN Z ARCHIVU";
$owl_lang->notif_subj_new_account       = "NOVÝ OWL ÚČET BYL VYTVOŘEN";
$owl_lang->notif_user			= "Vytvořeno/Aktualizováno od:";
$owl_lang->onlyyou			= "Můžete pouze číst/stahovat/zapisovat";
$owl_lang->onlyyou_ad			= "Můžete pouze číst/stahovat/zapisovat";
$owl_lang->orphaned			= "&#8211; ŽÁDNÝ VLASTNÍK  &#8211;";
$owl_lang->owl_path			= "Cesta k souboru: ";
$owl_lang->sessinuse			= "Tato sešn je použita na jiném počítači, přístup odmítnut<br />";
$owl_lang->sesstimeout			= "Čas Vaší sešn vypršel, prosím znovu se přihlašte<br />";
$owl_lang->virus_infected 		= "Soubor obsahuje virus";
$owl_lang->virus_return_val		= "Antivirus navrátil hodnotu:";
$owl_lang->watermark_string		= "Důverný";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Prohlížet tuto složku";
$owl_lang->title_browse_site     	= "Prohlžet tuto URL";
$owl_lang->title_download_view     	= "Stáhnout / Nahlížet  soubor";
$owl_lang->title_edit_prefs     	= "Náhled / Edit uživatelské předvolby";
$owl_lang->title_return_folder     	= "Návrat k";
$owl_lang->title_sort     		= "Seřadit podle";
$owl_lang->title_view_my     		= "Seznam náhledu k mím souborům";
$owl_lang->title_view_new     		= "Seznam náhledu nových souborů od mé poslední návštěvi";
$owl_lang->title_view_updated     	= "Seznam náhledu aktualizovaných souborů od poslední návštěvi";
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

$owl_lang->news_content			= "Obsah";
$owl_lang->news_hd			= "Zprávy";
$owl_lang->news_hd_audience		= "Psychologické ovlivnění";
$owl_lang->news_hd_created		= "Vytvořen:";
$owl_lang->news_hd_expires		= "Vyprší:";
$owl_lang->news_heading			= "Titulek zpráv";
$owl_lang->news_posted_date		= "Zprávy poslány:";
$owl_lang->news_read			= "Přečteno";
$owl_lang->news_title			= "Administrátorské zprávy";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "ODLAZENÍ: OWL dokumentový adresář: " .$default->owl_fs_root . "/" . fid_to_name(1) ." neexistuje.";
$owl_lang->debug_doc_not_writeable	= "ODLAZENÍ: OWL dokumentový adresář: " .$default->owl_fs_root . "/" . fid_to_name(1) ." není povolen zápis webovým serverem.";
$owl_lang->debug_file_not_exist		= "ODLAZENÍ: Požadovaný soubor &ldquo;$default->owl_fs_root/%s &rdquo; neexistuje.<br /> NEBO<br />Cesta specifikovná \$default->owl_fs_root in config/owl.php je špatně.";
$owl_lang->debug_tmp_not_exists		= "ODLAZENÍ: OWL dočasný adresář: $default->owl_tmpdir neexistuje.";
$owl_lang->debug_tmp_not_writeable	= "ODLAZENÍ: OWL dočasný adresář: $default->owl_tmpdir není povolen zápis webovým serverem.";
$owl_lang->debug_webserver_no_access	= "ODLAZENÍ: Webserver nemá právo čtení: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Prosím povolte čtení a zkuste znovu";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Prohlížeč Statistik / Reportáží ";
$owl_lang->stats_files		= "Počet souboru od uživatelů";
$owl_lang->stats_folders	= "Počet složek od uživatelů";
$owl_lang->stats_information	= "Owl k zobrazení této statistiky je potřebný zápis a souborový zápis";
$owl_lang->stats_top		= "20 nejvíce stahovaných dokumentů";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Uživatel (přihlášení / neúspěšný pokus / odhlášen)";
$owl_lang->stats_users_loggedin = "Právě přihlášeno v systému";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administrátorský dokument";
$owl_lang->doc_field_label	= "Zapisovací pole(za lokalitu)";
$owl_lang->doc_field_name	= "Pole jmen";
$owl_lang->doc_field_pos	= "Pole Pos";
$owl_lang->doc_field_required	= "Nutný?";
$owl_lang->doc_field_searchable	= "Prohledávatelný?";
$owl_lang->doc_field_size	= "Velikost pole";
$owl_lang->doc_new_doc_type	= "&#8211; VLOŽIT NOVÝ DOKUMENT TYPU&#8211;";
$owl_lang->doc_specific		= "Charakteristické pole dokumentu:";
$owl_lang->document_type	= "Dokument typu";
$owl_lang->document_type_name	= "Název dokumentu";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Vložit do popup popisu?";
$owl_lang->doc_field_disp_label = "Pole štítku:";
$owl_lang->doc_field_disp_sep = "SEPERATOR ŠTÍTKU";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;V&nbsp;Z&nbsp;O&nbsp;R&nbsp;O&nbsp;V&nbsp;Í&nbsp;&nbsp;&nbsp;N&nbsp;Á&nbsp;H&nbsp;L&nbsp;E&nbsp;D&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Zobrazit prohlížeč:";
$owl_lang->doc_field_show_in_list = "Zobrazit pole v prohlížeči náhledů:";
$owl_lang->doc_field_type	= "Pole Typu:";
$owl_lang->doc_field_values	= "Hodnoty pole rozdělit podle | :";
$owl_lang->doc_fields = "Uživatelská pole";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Skupina:";
$owl_lang->header_csv_import    = "Vložit CSV uživatelský soubor";
$owl_lang->import_inserted      = "VLOŽENÝ";
$owl_lang->import_skipped       = "PŘESKOČENO";
$owl_lang->invalid_groupid      = "Špatné ID skupiny --> ";
$owl_lang->msg_user_exists      = "Uživatel již existuje";
$owl_lang->sendcsvfile          = "Náhraný soubor omezený uvozovky";
$owl_lang->user_created_skipped = "Uživatel:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Umožnit přehled charakteristik:";
$owl_lang->owl_peer_review_opt  = "Nastavit přehled jako volitelný:";
$owl_lang->owl_title_peer_review= "PŘEHLED CHARAKTERISTIK DOKUMENTU";
$owl_lang->owl_title_peer_review2= "Přehled Dokumentu";
$owl_lang->peer_approval_title 	= "Dokumenty čekající na schválení";
$owl_lang->peer_approved_body	= "Váš soubor byl schválený:";
$owl_lang->peer_file_approved	= "Soubor schválen:";
$owl_lang->peer_file_final	= "Definitivní schválení:";
$owl_lang->peer_file_rejected	= "Soubor odmítnut:";
$owl_lang->peer_file_to_review	= "Soubor k náhedu:";
$owl_lang->peer_final_approval	= "[Definitivní schválení]: ";
$owl_lang->peer_final_body	= "RejectedRejectedVáš dokument byl schválený všechny podle všech požadovaných kontrolerů.<br />Prosím přihlašte se do systému a publikujte dokument<br />";
$owl_lang->peer_msg_to_reviewer	= "Zpráva ke kontrolerovi";
$owl_lang->peer_my_approval	= "Čekájící na mé schválení";
$owl_lang->peer_notif_user	= "Vytvořeno/Aktualizováno od";
$owl_lang->peer_pending_approval= "Má nevyřešená schválení";
$owl_lang->peer_pending_title 	= "Dokumenty které nemájí vyřešeno schválení";
$owl_lang->peer_reject_reason   = "Důvod zamítnutí";
$owl_lang->peer_rejected_body	= "Vaše soubory byly zamítnuty:";
$owl_lang->peer_review_body	= "Vaše schválení bylo požadováno pro následující dokument:";
$owl_lang->peer_reviewer_list	= "Kotrolor(i)";
$owl_lang->peer_satus	 	= "Stav";
$owl_lang->peer_satus_approved  = "&#8212; S CH V Á L E N O &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; N E V Y Ř E Š E N Ý &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; O D M Í T N U T Ý &#8212;";
$owl_lang->peer_subj_approved	= "Vaše dokumenty byly schváleny";
$owl_lang->peer_subj_rejected	= "Vaše dokumenty byly odmítnuty";
$owl_lang->peer_subj_reminder	= "PŘIPOMÍNKA: Máte OWL soubor zhodnocen";
$owl_lang->peer_subj_review	= "Máte OWL soubor zhodnocen";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Váš dokument byl schválený všemy kontrolory.<br />Váš soubor bude publikován.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Přidat soubor do ACL:";
$owl_lang->acl_adding_folder           = "Přidat složku do ACL:";
$owl_lang->acl_available_groups        = "Přístupná Skupina(y)";
$owl_lang->acl_available_users         = "Přístupný Uživatel(e)";
$owl_lang->acl_edit_file               = "Úprava souboru v ACL:";
$owl_lang->acl_edit_folder             = "Úprava složky v ACL:";
$owl_lang->acl_file_checkin            = "Odemknout/Uzamknout";
$owl_lang->acl_file_comment            = "Komentář";
$owl_lang->acl_file_copy               = "Kopírovat";
$owl_lang->acl_file_delete             = "Smazat";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_modify             = "Vlastnosti";
$owl_lang->acl_file_monitor            = "Kontrolovat";
$owl_lang->acl_file_move               = "Přesunot";
$owl_lang->acl_file_read               = "Číst";
$owl_lang->acl_file_search             = "Hledání týkající se";
$owl_lang->acl_file_set_acl            = "Nastavit ACL";
$owl_lang->acl_file_update             = "Aktualizace";
$owl_lang->acl_file_view_log           = "Náhled Logu";
$owl_lang->acl_folder_copy             = "Kopírovat";
$owl_lang->acl_folder_delete           = "Smazat";
$owl_lang->acl_folder_modify           = "Upravit vlastnosti";
$owl_lang->acl_folder_monitor          = "Kontrolovat";
$owl_lang->acl_folder_move             = "Přesun";
$owl_lang->acl_folder_read             = "Číst (Stáhnout/Prohlížet)";
$owl_lang->acl_folder_set_acl          = "Nastavit ACL";
$owl_lang->acl_folder_write            = "Zápis (Vytořit)";
$owl_lang->acl_heading_file            = "Skupina(y)/Uživatel(é)";
$owl_lang->acl_heading_files           = "SOUBORY &#8211;VYBERTE POŽADOVANÉHO UŽIVATELE a skupinu(y)";
$owl_lang->acl_heading_folder          = "Skupina(y)/Uživatel(é)";
$owl_lang->acl_heading_folders         = "SLOŽKY &#8211; VYBERTE POŽADOVANÉHO UŽIVATELE a skupinu(y)";
$owl_lang->acl_propagate_file          = "Nastavit tuto politiku na \"VŠECHNY\" soubory:";
$owl_lang->acl_propagate_folders       = "Rozšířit na všechny podsložky:";
$owl_lang->acl_selected_groups         = "Vybraná skupina(y)";
$owl_lang->acl_selected_users          = "Vybraný uživatel(é)";
$owl_lang->acl_set_acl                 = "Aktivovat bezpečnostní politiku";
$owl_lang->acl_set_acl_now             = "Nastavit bezpečnostní politiku nyní:";
$owl_lang->acl_set_selected            = "Nastavit vybrané";
$owl_lang->alt_acl_save_file           = "Uložit soubor bezpečnostní politiky";
$owl_lang->alt_acl_save_folder         = "Uložit složku bezpečnostní politiky";
$owl_lang->btn_acl_save                = "Uložit";
$owl_lang->acl_set_file_permissions    = "Nastavit souborová povolení";
$owl_lang->acl_set_folder_permissions  = "Nastavit složková povolení";
$owl_lang->alt_set_folder_acl	       = "Nastavit bezpečnostní politiku na aktuální složce";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Zdostupnit reporty:";
$owl_lang->report_file_folder               = "Soubor/Složka";
$owl_lang->report_filter                    = "Filtr:";
$owl_lang->report_filter_since              = "Od:";
$owl_lang->report_full_access               = "PLNÝ PŘÍSTUP";
$owl_lang->report_select_report             = "&#8211; Vybrat zprávu&#8211;";
$owl_lang->report_users_disabled_title      = "Vyřazený uživatel(é)";
$owl_lang->report_users_entitlement         = "Uživatelský přístupový seznam";
$owl_lang->report_users_inactive_title      = "Uživatel(é) nečinný od";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Umožnit podrobný náhled/generování:";
$owl_lang->thumb_gen_thumb_tool_path       = "Cesta k ImageMagick měnícímu nástroji:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Parametry Mplayeru:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Cesta k Mplayeru:";
$owl_lang->thumb_image_info                = "Info k obrázku";
$owl_lang->thumb_large_width               = "Šířka podrobného náhledu v pixelech:";
$owl_lang->thumb_med_width                 = "Šířka podrobného náhledu v pixelech:";
$owl_lang->thumb_number_colums             = "Počet sloupců v podrobném náhledu:";
$owl_lang->thumb_re_generate               = "Generovat podrobný náhled";
$owl_lang->thumb_small_width               = "Šířka podrobného náhledu 0= nezobrazovat:";
$owl_lang->thumb_title                     = "Podrobný Náhled/Možnosti";
$owl_lang->thumb_title_thumb_view          = "Detaily podrobného náhledu";
$owl_lang->thumb_image_size                = "Veliskot obrázku:";
$owl_lang->alt_thumb_small                 = "Malý napínáček";
$owl_lang->alt_no_thumb                    = "Napínáček není povolen";

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// EXTENDED HELP BEGIN
//********************************************************

$owl_lang->owl_track_favorites_extended         = "Track Favorites";
$owl_lang->owl_password_override_extended       = "If this is set then users that don't have access to the file can use a password to download";
$owl_lang->owl_view_doc_in_new_window_extended  = "When you View A document the document is viewed in a seperate window";
$owl_lang->owl_filedescreq_extended             = "Make the File Description a REQUIRED Field";
$owl_lang->owl_old_action_icons_extended        = "Extended Help";
$owl_lang->owl_email_from_extended              = "Extended Help";
$owl_lang->owl_email_fromname_extended          = "Extended Help";
$owl_lang->owl_email_replyto_extended           = "Extended Help";
$owl_lang->owl_email_server_extended            = "Extended Help";
$owl_lang->owl_use_smtp_extended                = "Extended Help";
$owl_lang->owl_use_smtp_auth_extended           = "Extended Help";
$owl_lang->owl_smtp_auth_login_extended         = "Extended Help";
$owl_lang->owl_smtp_passwd_extended             = "Extended Help";
$owl_lang->owl_email_subject_extended           = "Extended Help";
$owl_lang->owl_forgot_pass_extended             = "Extended Help";
$owl_lang->owl_self_reg_extended                = "Extended Help";
$owl_lang->owl_html2text_path_extended          = "Extended Help";
$owl_lang->owl_remember_me_extended             = "Extended Help";
$owl_lang->owl_status_bar_location_extended     = "Extended Help";
$owl_lang->owl_info_panel_wide_extended         = "Extended Help";
$owl_lang->owl_thumbnails_extended              = "Extended Help";
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
