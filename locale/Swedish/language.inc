<?php
/*
 * File: Swedish/language.inc
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Translation:  Daniel Wester
 * Date: 2000/12/14 - 2009/02/15
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
$owl_lang->lang_code = "sv";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "Du har inte behörighet att lägga till kommentarer till denna fil";
$owl_lang->err_backup_file   		= "Ett fel uppstod när filen skulle säkerhetskopieras";
$owl_lang->err_backup_folder_create 	= "Fel vid säkerhetskopiering av katalog";
$owl_lang->err_bad_url			= "Vänligen ange en giltig adress";
$owl_lang->err_bad_version_1 		= "DMS kräver minst PHP Version";
$owl_lang->err_bad_version_2 		= "Du kör PHP Version";
$owl_lang->err_bad_version_3 		= "Installera en nyare version av php och försök igen";
$owl_lang->err_comment_empty		= "Kommentar måste anges";
$owl_lang->err_email         		= "Meddelandet kunde inte sändas";
$owl_lang->err_email_required		= "E-postfältet måste fyllas i";
$owl_lang->err_fexist1			= "<b>Filen finns redan:</b>";
$owl_lang->err_fexist2 			= "Det finns redan en fil med det namnet <i>";
$owl_lang->err_fexist3 			= "</i> i denna katalog.";
$owl_lang->err_file_exists		= "Filen du försöker ladda upp finns redan";
$owl_lang->err_file_lock     		= "Du kan inte checka ut denna fil, den är låst av";
$owl_lang->err_file_not_exist		= "Filen finns inte";
$owl_lang->err_file_too_big		= "maximal uppladdningsstorlek överskriden <br />enligt php.ini och/eller Owl";
$owl_lang->err_file_update		= "Vid uppdatering av fil får filnamnet ej ändras. Vänligen försök igen med bibehållet namn.";
$owl_lang->err_fileexists    		= "Åtgärden avbruten<br />En fil med samma namn finns redan.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "Filnamnet du försöker döpa om denna fil till används redan.";
$owl_lang->err_folder_create 		= "Fel vid skapande av katalog";
$owl_lang->err_folder_exist		= "Denna katalog finns redan";
$owl_lang->err_folderexists  		= "Namnbyte avbrutet<br />En katalog med samma namn finns redan.";
$owl_lang->err_general 			= "Ett fel har uppstått";
$owl_lang->err_select_reviewer		= "Vänligen välj minst en person att revidera ditt dokument";
$owl_lang->err_update_file_lock     	= "Du kan inte uppdatera denna fil, den är för närvarande låst av";
// NEW CHANGE
$owl_lang->err_group_delete             = "Kan inte radera denna grupp: <font color=\"red\">%d</font> File(r),  <font color=\"red\">%d</font> Katalog(er), <font color=\"red\">%d</font> Användare i denna primära grupp, <font color=\"red\">%d</font> Användare som är medlemmar i denna grupp";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Kan inte radera. Det finns filer som använder denna dokumenttyp";
$owl_lang->err_database			= "Databasfel";
$owl_lang->err_doc_field_req            = "Tvingande fält saknas:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Namn för Dokumenttyp krävs <br />";
$owl_lang->err_field_label_req 		= "Fältetikett krävs <br />";
$owl_lang->err_field_name_req		= "Fältnamn krävs <br />";
$owl_lang->err_field_size_req		= "Fältstorlek krävs <br />";
$owl_lang->err_field_minor_version      = "Värdet i fältet mindre revidering måste vara ett positivt heltal";
$owl_lang->err_field_major_version      = "Värdet i fältet större revidering måste vara ett positivt heltal";
$owl_lang->err_file_title_too_long      = "Filbeskrivningen får ej överstiga 80 tecken";
$owl_lang->err_file_indexing		= "Temporär &ldquo;TEXT&rdquo; Filfel";
$owl_lang->err_forbidden_file		= "Otillåten filtyp";
$owl_lang->err_group_exists		= "Det finns redan en grupp med detta namn.";
$owl_lang->err_gzip_not_found  		= "gzip kan inte hittas i ";
$owl_lang->err_login			= "Vänligen Logga in för att utföra denna åtgärd";
$owl_lang->err_movecancel    		= "Åtgärden avbruten<br />";
$owl_lang->err_nameempty    		= "Katalognamn måste anges";
$owl_lang->err_news_required		= "FEL: Nyhetsrubrik och innehåll måste anges!";
$owl_lang->err_no_access 		= "Du har inte behörighet till någon av de markerade filerna";
$owl_lang->err_no_access_info 		= "Möjliga orsaker: <br />1) Du klickade inte i någon kryssruta framför filen eller katalogen<br />2) Radera flera, E-posta flera, Utcheckning av flera kan inte användas på kataloger<br />3) Du har inte behörighet till någon av de filer eller kataloger du markerat.";
$owl_lang->err_noemail			= "Du har inte behörighet att e-posta denna fil.";
$owl_lang->err_nofileaccess		= "Du har inte behörighet till denna fil.";
$owl_lang->err_nofiledelete		= "Du har inte behörighet att radera denna fil.";
$owl_lang->err_nofilemod		= "Du har inte behörighet att ändra denna fil.";
$owl_lang->err_nofolderaccess		= "Du har inte behörighet till denna katalog.";
$owl_lang->err_nofolderdelete		= "Du har inte behörighet att radera denna katalog.";
$owl_lang->err_nofoldermod		= "Du har inte behörighet att ändra denna katalog.";
$owl_lang->err_nosubfolder		= "Du har inte behörighet att skapa underkataloger här.";
$owl_lang->err_not_zip			= "Ogiltigt ZIP-arkiv";
$owl_lang->err_note_title               = "Titel måste anges";
$owl_lang->err_note_title_exists        = "En notering med detta namn finns redan";
$owl_lang->err_noupload			= "Du har inte behörighet att ladda upp till denna katalog.";
$owl_lang->err_pass_missmatch		= "Nytt lösenord och Bekräfta nytt lösenord stämmer inte överens";
$owl_lang->err_pass_wrong    		= "Gammalt lösenord är felaktigt";
$owl_lang->err_please_select_bulk       = "Vänligen markera minst en fil eller katalog med kryssrutan";
$owl_lang->err_pod2html_not_found       = "FEL: Verktyget pod2html hittades inte:";
$owl_lang->err_quota			= "Ditt profilutrymme räcker inte till för att ladda upp denna fil: ";
$owl_lang->err_quota_avail		= " tillgängligt.";
$owl_lang->err_quota_exceed  		= "Du har överskridit ditt profilutrymme";
$owl_lang->err_quota_needed		= " behövs ";
$owl_lang->err_req			= "FEL: Alla fält måste fyllas i";
$owl_lang->err_root_delete		= "Rotkatalogen kan inte raderas";
$owl_lang->err_sess_notvalid 		= "Ditt sessions-id är inte giltigt";
$owl_lang->err_sess_write		= "Fel vid skrivning av sessionsinformation till databasen";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; är ett katalognamn reserverat för Owl. Vänligen välj ett annat namn";
$owl_lang->err_sql			= "SQL-fel";
$owl_lang->err_tar_not_found  		= "tar kunde inte hittas i ";
$owl_lang->err_trash_can_empty 		= "Papperskorgen är tom";
$owl_lang->err_unauth_area   		= "Du är inte behörig att använda denna avdelning";
$owl_lang->err_unauthorized  		= "Icke behörig";
$owl_lang->err_upload 			= "Fel vid uppladdning";
$owl_lang->err_user_exists		= "Användare finns redan";
$owl_lang->err_captcha_auth		= "CAPTCHA-verifiering misslyckades";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Lägg till fält";
$owl_lang->btn_add_file          = "Lägg till dokument";
$owl_lang->btn_add_folder          = "Lägg till katalog";
$owl_lang->btn_dist_folder       = "Publicera katalog";
$owl_lang->btn_add_news          = "Lägg till nyheter";
$owl_lang->btn_add_note          = "Lägg till notering";
$owl_lang->btn_add_url          = "Lägg till Url";
$owl_lang->btn_jupload          = "Jupload";
$owl_lang->btn_add_zip           = "Lägg till arkiv";
$owl_lang->btn_admin      = "Admin";
$owl_lang->btn_admin_groups          = "Ny grupp";
$owl_lang->btn_admin_news          = "Nyheter Admin";
$owl_lang->btn_admin_user_group          = "Användare/Grupp Admin";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Ny användare";
$owl_lang->btn_back          = "Gå tillbaka";
$owl_lang->btn_browse     = "Bläddra";
$owl_lang->btn_bulk_checkout       = "Checka ut flera";
$owl_lang->btn_bulk_delete         = "Radera flera";
$owl_lang->btn_bulk_download          = "Ladda ner flera";
$owl_lang->btn_bulk_email          = "E-posta flera";
$owl_lang->btn_bulk_move          = "Flytta flera";
$owl_lang->btn_cancel          = "Avbryt";
$owl_lang->btn_clickhere          = "Klicka här";
$owl_lang->btn_collapse_view          = "Minimera vy";
$owl_lang->btn_create          = "Skapa";
$owl_lang->btn_default_view          = "Standardvy";
$owl_lang->btn_deldoctype          = "Ta bort dokumenttyp";
$owl_lang->btn_download_bulk_package	= "för att ladda ned ditt paket för nedladdning av flera";
$owl_lang->btn_edit_group          = "Ändra grupp";
$owl_lang->btn_edit_user          = "Ändra användare";
$owl_lang->btn_expand_view          = "Expandera Vy";
$owl_lang->btn_go_bottom      = "Till slutet";
$owl_lang->btn_go_top      = "Till början";
$owl_lang->btn_help     = "Hjälp";
$owl_lang->btn_import_users  = "Importera användare";
$owl_lang->btn_login          = "Logga in";
$owl_lang->btn_logout     = "Logga ut";
$owl_lang->btn_mail_tool     = "E-Post";
$owl_lang->btn_register          = "Registrera";
$owl_lang->btn_reset          = "Återställ";
$owl_lang->btn_send_email          = "Sänd E-Post";
$owl_lang->btn_submit          = "Skicka";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Miniatyrvy";
$owl_lang->btn_trash_admin          = "Papperskorg";
// NEW STUFF
$owl_lang->btn_export          = "Exportera";
$owl_lang->btn_gen_pdf          = "Skapa PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";


//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Skapa en kommentar till denna fil";
$owl_lang->alt_add_field	= "Lägg till fältet ovan";
$owl_lang->alt_add_group	= "Skapa denna grupp";
$owl_lang->alt_add_news		= "Lägg till en nyhetsartikel";
$owl_lang->alt_add_user		= "Skapa denna användare";
$owl_lang->alt_admin_flush      = "Rensa gamla/förfallna sessioner";
$owl_lang->alt_admin_groups	= "Skapa en ny grupp";
$owl_lang->alt_admin_users	= "Skapa en ny användare";
$owl_lang->alt_approve_file 	= "Godkänn detta dokument";
$owl_lang->alt_back      	= "Gå till föregående skärmbild";
$owl_lang->alt_btn_add_file     = "Ladda upp en ny fil";
$owl_lang->alt_btn_add_folder	= "Skapa en ny katalog";
$owl_lang->alt_btn_dist_folder  = "Skapa RSS-flöde / Torrent för denna katalog";
$owl_lang->alt_btn_add_note     = "Skapa en ny notering";
$owl_lang->alt_btn_jupload     = "Lägg till flera filer genom att använda jupload";
$owl_lang->alt_btn_add_url	= "Skapa en ny webblänk";
$owl_lang->alt_btn_add_zip     	= "Ladda upp och extrahera en zip-fil";
$owl_lang->alt_btn_admin 	= "Owl Administration";
$owl_lang->alt_btn_browse	= "Återgå till filbläddrare";
$owl_lang->alt_btn_bulk_checkout= "Checka ut fler filer";
$owl_lang->alt_btn_bulk_delete 	= "Radera fler filer";
$owl_lang->alt_btn_bulk_download= "Ladda ner fler filer";
$owl_lang->alt_btn_bulk_email  	= "E-posta fler filer";
$owl_lang->alt_btn_bulk_move   	= "Flytta fler filer och kataloger";
$owl_lang->alt_btn_clickhere	= "Klicka här";
$owl_lang->alt_btn_collapse_view= "Växla till reducerad vy";
$owl_lang->alt_btn_default_view = "Växla till standardvy";
$owl_lang->alt_btn_expand_view  = "Växla till utökad vy";
$owl_lang->alt_btn_help		= "Owl Onlinehjälp";
$owl_lang->alt_btn_login	= "Logga in på DMS";
$owl_lang->alt_btn_logout	= "Log ut från DMS";
$owl_lang->alt_btn_mail_tool   	= "Enkelt epostverktyg";
$owl_lang->alt_btn_thumb_view   = "Växla till miniatyrvy";
$owl_lang->alt_cancel		= "Avbryt denna åtgärd";
$owl_lang->alt_cancel_move	= "Avbryt flytt";
$owl_lang->alt_change		= "Uppdatera detta inlägg";
$owl_lang->alt_comments 	= "Kommentarer finns redan för denna fil";
$owl_lang->alt_copy_file     	= "Kopiera fil";
$owl_lang->alt_copy_folder   	= "Kopiera katalog";
$owl_lang->alt_del_all		= "Töm papperskorgen";
$owl_lang->alt_del_comments     = "Radera detta dokument";
$owl_lang->alt_edt_comments     = "Redigera detta dokument";
$owl_lang->alt_del_field	= "Radera detta fält";
$owl_lang->alt_del_file      	= "Radera fil (Y/N)";
$owl_lang->alt_del_folder    	= "Radera katalog (Y/N)";
$owl_lang->alt_del_group	= "Radera denna grupp";
$owl_lang->alt_del_news		= "Radera denna nyhet";
$owl_lang->alt_del_selected	= "Radera alla markerade filer";
$owl_lang->alt_del_this_folder	= "Radera katalog &#8211; ";
$owl_lang->alt_del_user		= "Radera denna användare";
$owl_lang->alt_deldoctype	= "Radera aktuell dokumenttyp";
$owl_lang->alt_edit_field	= "Redigera denna fälttyp";
$owl_lang->alt_edit_group       = "Redigera markerad grupp";
$owl_lang->alt_edit_news	= "Redigera denna nyhet";
$owl_lang->alt_edit_user        = "Redigera markerad användare";
$owl_lang->alt_email		= "E-posta denna fil";
$owl_lang->alt_email_reminder 	= "E-postpåminnelse";
$owl_lang->alt_email_selected	= "E-posta alla markerade filer";
$owl_lang->alt_get_file      	= "Ladda ner fil";
$owl_lang->alt_get_folder      	= "Ladda ner katalogens innehåll";
$owl_lang->alt_go_bottom      	= "Gå till botten av sidan";
$owl_lang->alt_go_top 		= "Gå till toppen av sidan";
$owl_lang->alt_have_news	= "Du har nyhet(er) att visa";
$owl_lang->alt_have_no_news	= "Inga olästa nyheter att visa";
$owl_lang->alt_home_folder	= "Tillbaka till ursprunglig katalog ";
$owl_lang->alt_link_file     	= "Länka denna fil till en annan katalog";
$owl_lang->alt_lock_file        = "Checka ut filen";
$owl_lang->alt_log_clear        = "Radera alla loggar (Y/N)";
$owl_lang->alt_log_file         = "Fillog";
$owl_lang->alt_log_next		= "Visa nästa inlägg";
$owl_lang->alt_log_prev		= "Visa föregående inlägg";
$owl_lang->alt_log_top		= "Gå till första inlägget";
$owl_lang->alt_mod_file      	= "Ändra filegenskaper"; 
$owl_lang->alt_mod_folder    	= "Ändra katalogegenskaper";
$owl_lang->alt_monitor		= "Bevaka denna fil";
$owl_lang->alt_monitor_folder   = "Bevaka denna katalog";
$owl_lang->alt_monitored	= "Avbryt bevakning av denna fil";
$owl_lang->alt_monitored_folder = "Avbryt bevakning av denna katalog";
$owl_lang->alt_move_file     	= "Flytta fil";
$owl_lang->alt_move_folder   	= "Flytta katalog";
$owl_lang->alt_move_selected	= "Flytta alla markerare filer";
$owl_lang->alt_my_approval	= "Dokument som skall godkännas av mig";
$owl_lang->alt_new_doctype	= "Skapa ny dokumenttyp";
$owl_lang->alt_news_close	= "Stäng nyhetsfönstret";
$owl_lang->alt_news_next	= "Visa nästa nyhetsartikel";
$owl_lang->alt_news_prev	= "Visa föregående nyhetsartikel";
$owl_lang->alt_news_print	= "Skriv ut denna nyhetsartikel";
$owl_lang->alt_pending_approval	= "Dokument som inväntar godkännande";
$owl_lang->alt_play_file 	= "Spela mediafil";
$owl_lang->alt_publish_file 	= "Gör dokumentet publikt";
$owl_lang->alt_recycle		= "Papperskorg<br />(Tom)";
$owl_lang->alt_recycle_disable	= "Använd papperskorg<br />(Avaktiverad)";
$owl_lang->alt_recycle_not_found= "Papperskorg<br />(Kan ej hittas)";
$owl_lang->alt_refresh_filter	= "Tillämpa filter / Uppdatera resultat";
$owl_lang->alt_register		= "Skicka din registrering";
$owl_lang->alt_reject_file 	= "Avslå detta dokument";
$owl_lang->alt_related		= "Hitta liknande dokument";
$owl_lang->alt_reset_form	= "Återställ fomulärvärden";
$owl_lang->alt_rest_selected	= "Återställ alla markerade filer";
$owl_lang->alt_search		= "Starta sökning";
$owl_lang->alt_send_email	= "Skicka epost";
$owl_lang->alt_sendfile		= "Skicka filen";
$owl_lang->alt_set_initial_dir	= "Ange aktuell katalog som startkatalog";
$owl_lang->alt_site_map         = "Sidöversikt";
$owl_lang->alt_submit      	= "Skicka";
$owl_lang->alt_toggle_check_box	= "Markera kryssrutorna";
$owl_lang->alt_tool_status_green= "Verktyget är aktivt";
$owl_lang->alt_tool_status_red	= "Sökvägen är felaktig OCH/ELLER är inte körbar";
$owl_lang->alt_unlock_file      = "Checka in fil";
$owl_lang->alt_upd_field	= "Uppdatera detta fält";
$owl_lang->alt_upd_file      	= "Uppdatera fil";
$owl_lang->alt_view_comments    = "Lägg till / Visa filkommentarer";
$owl_lang->alt_view_file     	= "Visa fil";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Papperskorgsadministration";
$owl_lang->alt_edit_file_inline = "Redigera textfil";
$owl_lang->alt_gen_pdf          = "Skapa en PDF-version av ovanstående fil";
$owl_lang->alt_updated     	= "Dokumentet har uppdaterats sedan ditt senaste besök";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Dokumentet har skapats sedan ditt senaste besök";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Hela innehållet har också raderats";
$owl_lang->log_detail		= "Inga ytterligare detaljer";
$owl_lang->log_file_to		= "TILL: ";
$owl_lang->log_filter_all	= "ALLA";
$owl_lang->log_login_det	= "Användarnamn: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Ändrad grupp: ";
$owl_lang->log_admin_changed_user = "Ändrad användare: ";
$owl_lang->log_admin_created_group = "Skapad grupp: ";
$owl_lang->log_admin_created_user = "Skapad användare: ";
$owl_lang->log_admin_del_group = "Raderad grupp: ";
$owl_lang->log_admin_del_user = "Raderad användare: ";
$owl_lang->log_admin_disabled = " Inaktiverad användare: ";
$owl_lang->log_admin_email_restore = "Epostade filer:";
$owl_lang->log_admin_trash_delfile= "Raderad fil: ";
$owl_lang->log_admin_trash_delfold = "Raderad katalog: ";
$owl_lang->log_admin_trash_empty = "Papperskorgen tömd";
$owl_lang->log_admin_trash_restore = "Återställd: ";
$owl_lang->log_login_expired    = "Användare vars giltighet gått ut: ";
$owl_lang->log_login_too_many_attempts = "Inaktiverad (för många felaktiga inloggningar): ";
$owl_lang->log_readhd_feature_add  = "Hårddiskläsningsfunktion tillagd för denna fil";
$owl_lang->log_admin_to  = "till";
$owl_lang->log_admin_of  = "av";
// END NEW STUFF
$log_file_actions[1]        	= "INLOGGNING";
$log_file_actions[10]        	= "UPPLÅST FIL";
$log_file_actions[11]        	= "EPOSTAD FIL";
$log_file_actions[12]        	= "FLYTTAD FIL";
$log_file_actions[13]        	= "SKAPAD KATALOG";
$log_file_actions[14]        	= "RADERAD KATALOG";
$log_file_actions[15]        	= "REDIGERAD KATALOG";
$log_file_actions[16]        	= "FLYTTAD KATALOG";
$log_file_actions[17]        	= "GLÖMT LÖSENORD";
$log_file_actions[18]        	= "ANVÄNDARREGISTRERING";
$log_file_actions[19]           = "FIL VISAD";
$log_file_actions[2]        	= "MISSLYCKAD INLOGGNING";
$log_file_actions[20]           = "VIRUSSMITTAD FIL";
$log_file_actions[21]           = "KOPIERAD FIL";
$log_file_actions[22]           = "KOPIERAD KATALOG";
$log_file_actions[23]           = "LÄNKAD FIL";
$log_file_actions[3]        	= "UTLOGGNING";
$log_file_actions[4]        	= "RADERAD FIL";
$log_file_actions[5]        	= "UPPLADDAD FIL";
$log_file_actions[6]        	= "UPPDATERAD FIL";
$log_file_actions[7]        	= "NERLADDAD FIL";
$log_file_actions[8]        	= "ÄNDRAD FIL";
$log_file_actions[9]        	= "LÅST FIL";
// BEGIN NEW STUFF
$log_file_actions[24]           = "ANVÄNDARADMINISTRATÖR";
$log_file_actions[25]           = "PAPPERSKORG";
$log_file_actions[26]           = "FIL ACL";
$log_file_actions[27]           = "KATALOG ACL";
$log_file_actions[28]           = "DISTRIBUERAD KATALOG";
$log_file_actions[29]           = "KATALOG LÄNKAD";
$log_file_actions[30]           = "FILGRANSKNING";
$log_file_actions[31]           = "FIL GODKÄND";
$log_file_actions[32]           = "FIL FÖRKASTAD";
$log_file_actions[33]           = "FIL PUBLICERAD";
// END NEW STUFF


//********************************************************
// Owl Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

// BEGIN NEW STUFF
$owl_lang->admin_login_date  = "Administratören loggade in: ";
$owl_lang->admin_login_from  = "Administratören loggade in från";
$owl_lang->admin_login_subject  = "ADMINISTRATÖRSINLOGGNING";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Anonym åtkomst)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Glömt ditt lösenord?";
$owl_lang->like_register	= "Vill du registrera dig?";
$owl_lang->login		= "Logga in";
$owl_lang->logindisabled	= "Kontot har inaktiverats, kontakta systemadministratören";
$owl_lang->loginfail		= "Inloggning misslyckades";
$owl_lang->password		= "Lösenord";
$owl_lang->repository_list      = "Källa";
$owl_lang->successlogout 	= "Du har loggats ut";
$owl_lang->toomanysessions	= "Maximalt antal sessioner för användaren uppnådd, kontakta systemadministratören";
$owl_lang->username		= "Användarnamn";
$owl_lang->forgot_username	= "Användarnamn eller epostadress";
$owl_lang->version 		= "Version";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Åtgärder";
$owl_lang->current_db         		= "Aktuell källa:";
$owl_lang->current_folder 		= "Aktuell katalog:";
$owl_lang->del_all			= "Töm papperskorgen";
$owl_lang->del_selected			= "Radera markerade";
$owl_lang->disk_quota			= "Diskutrymme";
$owl_lang->doc_number 			= "Dokumentnummer";
$owl_lang->email_selected		= "Epost vald";
$owl_lang->file 			= "Fil";
$owl_lang->folder_count_file		= "Fil(er)";
$owl_lang->folder_count_folder		= "Katalog(er)";
$owl_lang->folder_count_note		= "Anteckning(ar)";
$owl_lang->folder_count_pre		= "Denna katalog innehåller";
$owl_lang->folder_count_url		= "Webbadress(er)";
$owl_lang->folder_policy 		= "Aktuell katalogpolicy:";
$owl_lang->held                      	= "Låst"; 
$owl_lang->last_logged			= "Senast: ";
$owl_lang->menu_file_action		= "Tillgängliga filåtgärder";
$owl_lang->menu_folder_action		= "Tillgängliga katalogåtgärder";
$owl_lang->menu_url_action		= "Tillgängliga webbadressåtgärder";
$owl_lang->modified 			= "Ändrad";
$owl_lang->move_selected		= "Flytta markerade";
$owl_lang->new_file			= "Ny!";
$owl_lang->no_description		= "Ingen beskrivning tillgänglig";
$owl_lang->owner                    = "Användare";
#$owl_lang->owner                   = "Ägare";
$owl_lang->page				= "Sida:";
$owl_lang->panel_file_info		= "Filinformation";
$owl_lang->postedby 			= "Postad av";
$owl_lang->reallydelete			= "Verkligen radera";
$owl_lang->reallydelete_logs		= "Verkligen radera loggfilen";
$owl_lang->reallydelete_selected	= "Verkligen radera alla markerade filer";
$owl_lang->reallyrestore_selected	= "Verkligen återställa alla markerade filer";
$owl_lang->rest_selected		= "Återställ markerade";
$owl_lang->score 			= "Poäng";
$owl_lang->size 			= "Storlek";
$owl_lang->updated_by 			= "Uppdaterad av";
$owl_lang->title 			= "Namn";
$owl_lang->tot_files			= "Totalt:";
$owl_lang->tot_monitored		= "Bevakade:";
$owl_lang->tot_my_checked_out		= "Utcheckade:";
$owl_lang->tot_my_files			= "Mina:";
$owl_lang->tot_my_group			= "Grupp:";
$owl_lang->tot_new_files		= "Nya:";
$owl_lang->tot_updated_files		= "Uppdaterade:";
$owl_lang->updated_file			= "Uppdaterad!";
$owl_lang->user               		= "Användare";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Senast antal dagar :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favoriter";
$owl_lang->favorite_add = "Lägg till aktuell";
$owl_lang->favorite_delete = "Radera";
$owl_lang->favorite_go = "Gå";
$owl_lang->files_in_my_group_title = "Filer i min(a) grupp(er)";
$owl_lang->my_files_title= "Mina filer";
$owl_lang->my_monitored_title= "Mina bevakade fil(er)/katalog(er)";
$owl_lang->my_special_access_title= "Lista över specialåtkomst";
$owl_lang->special_access_count_alt= "Specialåtkomstfiler/kataloger";
$owl_lang->special_access_count= "Specialåtkomst:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Lägger till / visar kommentarer: ";
$owl_lang->addingfile 		= "Lägger till en fil i ";
$owl_lang->addingfolder 	= "lägger till en katalog i ";
$owl_lang->attach_file		= "Bifoga fil";
$owl_lang->change		= "Ändra";
$owl_lang->comments      	= "Kommentar";
$owl_lang->comments_added       = "Kommentar tillagd av: ";
$owl_lang->create		= "Skapa";
$owl_lang->description 		= "Beskrivning";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Song:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Längd:<br />Gengre:<br />Kommentarer:";
$owl_lang->email_body		= "Meddelande";
$owl_lang->email_cc          	= "Kopia";
$owl_lang->email_reply_to	= "Svara till";
$owl_lang->email_subject	= "Ämne";
$owl_lang->email_to		= "Eposta till";
$owl_lang->emailing		= "Epostar";
$owl_lang->keywords 		= "Nyckelord";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Ändrar ";
$owl_lang->name               	= "Namn"; 
$owl_lang->none_selected        = "INGEN MARKERAD";
$owl_lang->note_content         = "Anteckningsinnehåll";
$owl_lang->notify_link          = "Owl Extern länk";
$owl_lang->ownergroup         	= "Ägare (grupp)";
$owl_lang->ownership		= "Ägarskap";
$owl_lang->permissions 		= "Rättigheter";
$owl_lang->pick_select		= "&#8211; Välj en Owl-användare &#8211;";
$owl_lang->policy 		= "Policy";
$owl_lang->post_comment		= "Posta kommentar";
$owl_lang->prop_permissions 	= "Ärva rättigheter till underkataloger?";
$owl_lang->prop_perms_files 	= "Rättigheter att ärva till filer";
$owl_lang->sendfile 		= "Skicka fil";
$owl_lang->sendthisfile 	= "Skicka denna fil";
$owl_lang->sendthisurl       	= "Skicka denna URL";
$owl_lang->updating		= "Uppdaterar";
$owl_lang->verdescription 	= "Beskrivning<br />av ändringar";
$owl_lang->vermajor          	= "Stor revidering";
$owl_lang->verminor          	= "Mindre revidering";
$owl_lang->vertype           	= "Revideringstyp";
$owl_lang->document_text        = "Content";
$owl_lang->save_keyword         = "Spara nyckelord?";
$owl_lang->archive_skip_file    = "ÖVERHOPPAD: ";
$owl_lang->archive_skip_message = "Följande filer har hoppats över, då de redan existerar";
$owl_lang->archive_extract_current  = "Extrahera till aktuell katalog?";
$owl_lang->archive_extract_overwrite  = "Skriva över existerande filer (uppdatera)?";
$owl_lang->optional_file_index  = "Indexfil?:";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "Epostadress";
$owl_lang->full_name		= "Fullständigt namn";
$owl_lang->register		= "Användarregistrering";
$owl_lang->self_failed		= "Misslyckades";
$owl_lang->self_passwd		= "Lösenord skickat till:";
$owl_lang->self_reg_bod		= "Ditt Owl-lösenord är:";
$owl_lang->self_reg_rset	= "Ditt Owl-lösenord har återställt till:";
$owl_lang->self_reg_subj	= "Ditt OWL-konto";
$owl_lang->send_pass		= "Skicka lösenord";
$owl_lang->submit		= "Registrera";
$owl_lang->thank_you_1		= "Tack!";
$owl_lang->thank_you_2		= "Ditt lösenord kommer att skickas till din epostadress";
$owl_lang->thank_you_3		= "Ditt konto måste aktiveras av administratören innan du kan logga in.";

//NEW STUFF

$owl_lang->captcha_typein        = "Skriv in de fem tecknen";
$owl_lang->change_pass_title	      = "ÄNDRA LÖSENORD";
$owl_lang->err_cant_reuse_passwords   = "Du kan inte återanvända tidigare använda lösenord";
$owl_lang->err_new_confirm_different  = "Nytt lösenord och Beräfta lösenord stämmer inte överens <br />";
$owl_lang->err_old_pass_ver_failed    = "Gammalt lösenord är felaktigt <br />";
$owl_lang->err_pass_restriction_1     = "Lösenord måste bestå av minst &ldquo;%s&rdquo; tecken <br />";
$owl_lang->err_pass_restriction_2     = "innehålla minst &ldquo;%s&rdquo; siffror [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "och minst &ldquo;%s&rdquo; specialtecken [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Valt användarnamn  &ldquo;%s&rdquo; består av %d tecken, och måste bestå av minst  %d tecken.";
$owl_lang->pass_change_email_1        = "Ditt lösenord återställdes inte eftersom du inte använder Owl Verifiering";
$owl_lang->pass_change_email_2        = "Din verifieringstyp är: ";
$owl_lang->pass_change_email_3        = "Kontakta systemadministratören för hjälp";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Avbryt";
$owl_lang->copy_file		= "Kopierar fil";
$owl_lang->copy_folder		= "Kopierar katalog";
$owl_lang->moving		= "Flyttar";
$owl_lang->moving_file		= "Flyttar fil";
$owl_lang->moving_folder	= "Flyttar katalog";
$owl_lang->select		= "Välj en ny katalog:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Visar logg för ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Diff från";
$owl_lang->diff_to	= "Diff till";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Kommentarsnotifiering";
$owl_lang->confpassword	= "Bekräfta nytt lösenord";
$owl_lang->email_tool	= "Epostverktyg";
$owl_lang->group	= "Primär grupp";
$owl_lang->groupmember	= "Medlem i grupp(er)";
$owl_lang->last_modified= "Senast ändrad";
$owl_lang->newpassword	= "Nytt lösenord";
$owl_lang->newsadmin	= "Nyhetsadministratör";
$owl_lang->not_member	= "Du är inte medlem i några grupper";
$owl_lang->notification	= "Mottaga notifieringar";
$owl_lang->oldpassword	= "Gammalt lösenord";
$owl_lang->preference	= "Inställningar";
$owl_lang->saved	= "&#8212; Ä N D R I N G &nbsp;&nbsp;&nbsp;S P A R A D &#8212;";
$owl_lang->status_no	= "NEJ";
$owl_lang->status_yes	= "JA";
$owl_lang->userlang	= "Språk";

//NEW STUFF
$owl_lang->useradmin	= "Användaradministratör";
$owl_lang->viewlogs     = "Kan se systemloggar";
$owl_lang->viewreports  = "Kan se systemrapporter";
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

$owl_lang->elapsed_time       	= "förfluten tid";
$owl_lang->query_empty       	= "Töm söksträng";
$owl_lang->related_query_empty  = "Ingen metadata är associerad med dokumentet för att utföra &ldquo;Sökning av liknande&rdquo;";
$owl_lang->search             	= "Sök";
$owl_lang->search_all_word	= "Alla ord";
$owl_lang->search_any_word	= "Något ord";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Sök aktuell katalog";
$owl_lang->search_entire_phrase	= "Hela frasen";
$owl_lang->search_for_files 	= "Söker filer";
$owl_lang->search_for_folders 	= "Söker kataloger";
$owl_lang->search_match 	= "Resultat:";
$owl_lang->search_results_for	= "Sök resultat efter";
$owl_lang->search_score 	= "Poängsatta filer";
$owl_lang->search_winthindocs   = "Sök inom";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Visar ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Visa bred filinformationspanel";
$owl_lang->allow_track_favorite         = "Tillåt användare att spåra favoriter";
$owl_lang->admin_login_to_browse_page	= "Admin startar vid Bläddra vid inloggning";
$owl_lang->alt_btn_backup		= "Säkerhetskopiera SQL-databas";
$owl_lang->alt_btn_doctype_admin	= "Dokumenttypsadministration";
$owl_lang->alt_btn_html_prefs		= "Redigera sidans HTML-inställningar";
$owl_lang->alt_btn_news_admin		= "Owl Nyhetsadministration";
$owl_lang->alt_btn_site_features	= "Redigera sidans funktioner och inställningar";
$owl_lang->alt_btn_statistics_viewer	= "Owl statistikvisare";
$owl_lang->alt_btn_users_groups		= "Administrera användare och grupper";
$owl_lang->btn_backup			= "Säkerhetskopiera<br />databas";
$owl_lang->btn_doctype_admin		= "Dokument<br />typer";
$owl_lang->btn_html_prefs		= "HTML<br />inställningar";
$owl_lang->btn_news_admin		= "Nyhets<br />administration";
$owl_lang->btn_admin_maint_on       = "UNDERHÅLLSLÄGE";
$owl_lang->btn_admin_maint_off      = "NORMALLÄGE";
$owl_lang->alt_btn_admin_maint_on       = "Blocks User sigon, so the administrator can perform a task without users on the system";
$owl_lang->alt_btn_admin_maint_off = "Turn Maintenace Mode Off (Permit Users to Login)";
$owl_lang->btn_site_features		= "Sid<br />funktioner";
$owl_lang->btn_statistics_viewer	= "Statistik / Rapport <br />visare";
$owl_lang->btn_users_groups		= "Användare &amp;<br />Grupper";
$owl_lang->display_password_override	= "Visa fil/katalog lösenordsåsidosättande";
$owl_lang->doc_id_num_digits		= "Antal siffror som visas i dokumentnumret";
$owl_lang->doc_id_prefix		= "Prefix som visas före dokumentnumret"; 
$owl_lang->docicon_column		= "Dokumentsikon";
$owl_lang->download_folder_zip		= "Ladda ned filer som Zipfil (standard är tar.gz)";
$owl_lang->save_keywords_to_db		= "Tillåt användare att spara nyckelord för återanvändning";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Startvärde för Stor revidering";
$owl_lang->verminor_initial          	= "Startvärde för Mindre revidering";
$owl_lang->view_doc_in_new_window	= "Visa dokument i nytt fönster";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Redigerar användare *****";
$owl_lang->edit_group  			= "***** Redigerar grupp *****";
$owl_lang->enter_new_user               = "***** Lägger till ny användare *****";
$owl_lang->enter_new_group              = "***** Lägger till ny grupp *****";
$owl_lang->alt_btn_change_passwd        = "Ändra gammalt lösenord";
$owl_lang->alt_btn_cln_history          = "Radera dokument äldre än (dagar): ";
$owl_lang->alt_btn_log_viewer           = "Owl Systemloggsvisare";
$owl_lang->alt_btn_report_viewer        = "Owl Rapportvisare";
$owl_lang->btn_change_passwd            = "Ändra lösenord";
$owl_lang->btn_cln_history              = "Töm historik";
$owl_lang->btn_log_viewer               = "Systemloggar";
$owl_lang->btn_report_viewer            = "Rapporter";
$owl_lang->confirm_cln_history          = "Är du säker att du vill radera dokument äldre än (dagar): ";
$owl_lang->historical_purge             = "Historik tömd";

// END NEW STUFF
$owl_lang->add				= "Lägg till";
$owl_lang->alt_btn_initial_load		= "Ladda databas från dokumentkatalog";
$owl_lang->alt_btn_trashcan		= "Klicka för att se innehållet";
$owl_lang->anonymous_account		= "Anonymt inloggningskonto:";
$owl_lang->btn_initial_load		= "Ladda startvärden";
$owl_lang->btn_trashcan			= "Papperskorg";
$owl_lang->buttonstyle                  = "Knappstil";
$owl_lang->confirm_initial_load		= "*** VARNING ***  Detta skall endast göras då databasen är tom";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Radera grupp";
$owl_lang->deleteuser			= "Radera användare";
$owl_lang->disable_recs_per_page	= "Aktivera begränsad vy kommer att inaktivera inlägg per sida!";
$owl_lang->disableuser			= "Inaktivera användare";
$owl_lang->file_admin_group		= "Fil/Bläddringsadministratörsgrupp :";
$owl_lang->flushed           		= "Sessionsdata rensad, användaren kan nu logga in igen.";
$owl_lang->groups			= "Grupper";
$owl_lang->hide_bulk_buttons		= "Göm knappar med åtgärder för fler filer/kataloger:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Sökväg till bakgrundsbild:";
$owl_lang->ht_bd_lnk_cl			= "Färg för länkar:";
$owl_lang->ht_bd_txt_cl 		= "Färg för text:";
$owl_lang->ht_bd_vlnk_cl 		= "Färg för besökta länkar:";
$owl_lang->ht_collapse_width 		= "Bredd för minimerad vy:";
$owl_lang->ht_expand_width		= "Bredd för expanderad vy:";
$owl_lang->ht_tbl_border_sz 		= "Storlek för tabellramar:";
$owl_lang->ht_tbl_cell_bg_al 		= "Alternativ bakgrundsfärg för tabellceller:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Bakgrundsfärg för tabellceller:";
$owl_lang->ht_tbl_hd_bg			= "Bakgrund för rubrik:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Ange anonym åtkomst";
$owl_lang->header_group_admin           = "Gruppadministration";
$owl_lang->header_sitefeatures_settings           = "Sidans funktioner och inställningar";
$owl_lang->header_user_admin           	= "Användaradministration";
$owl_lang->hide_folder_doc_count	= "Göm dokumenträknare för kataloger";
$owl_lang->hide_folder_size		= "Göm storlek för kataloginnehåll";
$owl_lang->hide_panel			= "Göm";
$owl_lang->home_dir			= "Användares hemmakatalog:";
$owl_lang->initial_dir   		= "Användares startkatalog";
$owl_lang->maxsessions			= "Max antal sessioner";
$owl_lang->noprefaccess			= "Inaktivera inställningar";
$owl_lang->old_action_icons		= "Använd åtgärdsikoner för Owl ver < 0.80";
$owl_lang->owl_anon_download     	= "Endast nedladdning";
$owl_lang->owl_anon_full		= "Full åtkomst";
$owl_lang->owl_anon_ro			= "Endast läsrättigheter";
$owl_lang->owl_dbdump_path   		= "Sökväg för databasdump:";
$owl_lang->owl_def_file_group_owner	= "Standardvärde för filgruppsägare:";
$owl_lang->owl_def_file_meta		= "Standardvärde för filmetadata:";
$owl_lang->owl_def_file_owner		= "Standardvärde för filägare:";
$owl_lang->owl_def_file_perm 		= "Standardvärde för filskaparpolicy:";
$owl_lang->owl_def_file_security	= "Standardvärde för filsäkerhet:";
$owl_lang->owl_def_file_title		= "Standardvärde för filtitel (blankt=filnamn):";
$owl_lang->owl_def_fold_group_owner	= "Standardvärde för kataloggruppsägare:";
$owl_lang->owl_def_fold_owner		= "Standardvärde för katalogägare:";
$owl_lang->owl_def_fold_sec		= "Standardvärde för katalogsäkerhet:";
$owl_lang->owl_def_folder_perm 		= "Standardvärde för katalogskaparpolicy:";
$owl_lang->owl_default_tmpdir		= "Sökväg till tempkatalog: ";
$owl_lang->owl_email_from		= "Från adress:";
$owl_lang->owl_email_fromname		= "Från namn:";
$owl_lang->owl_email_replyto		= "Svara till adress:";
$owl_lang->owl_email_server		= "SMTP Server:";
$owl_lang->owl_email_smtp		= "Använd SMTP";
$owl_lang->owl_email_smtp_auth		= "Använd SMTP Auth";
$owl_lang->owl_email_smtp_auth_login	= "SMTP Auth inloggning:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP Auth lösenord";
$owl_lang->owl_email_subject_pref	= "Prefix i ämnesfält:";
$owl_lang->owl_fogotpass		= "Visa länk för bortglömt lösenord:";
$owl_lang->owl_group_user		= "Användare som är medlemmar i denna grupp";
$owl_lang->owl_gzip_path     		= "Sökväg till gzip:";
$owl_lang->owl_hidebackup		= "Göm katalog för säkerhetskopior:";
$owl_lang->owl_log_file			= "Logga filaktiviteter:";
$owl_lang->owl_log_login_act		= "Logga in-/utloggningsaktiviteter:";
$owl_lang->owl_log_rec_page		= "Logga visning av inlägg per sida:";
$owl_lang->owl_logging			= "Aktivera loggning:";
$owl_lang->owl_logo			= "Logotyp för inloggningssida ([Språk]/grafik):";
$owl_lang->owl_lookAtHD			= "Avaktivera 'se hårddisk':";
$owl_lang->owl_lookAtHDDel		= "Radera borttagna filer från databasen";
$owl_lang->owl_max_filesize		= "Maximal filstorlek för uppladdning (i bytes)";
$owl_lang->owl_owl_expand		= "Standardvärde för bläddringsvy (Expanderad)";
$owl_lang->owl_owl_timeout		= "Tid för sessionstimeout i sekunder";
$owl_lang->owl_pdftotext_path		= "Behåll sökindex i <br />PDF och textfiler <br />&#8211; Blank = avaktiverad:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 eller högre krävs<br />Sökväg till pod2html:";
$owl_lang->owl_restrict_view		= "Aktivera funktionen begränsad vy:";
$owl_lang->owl_self_reg			= "Aktivera självregistrering:";
$owl_lang->owl_self_reg_hd		= "STANDARDVÄRDEN FÖR SJÄLVREGISTRERING AV ANVÄNDARE";
$owl_lang->owl_tar_path     		= "Sökväg till tar:";
$owl_lang->owl_title_browser		= "OWL WEBBLÄSARFUNKTIONER";
$owl_lang->owl_title_custom		= "ANPASSA WEBBLÄSARKOLUMNER";
$owl_lang->owl_title_custom_search      = "ANPASSA SÖKRESULTAT";
$owl_lang->owl_title_defaults   	= "STANDARDVÄRDEN";
$owl_lang->owl_title_email		= "OWL-Systemets epostinställningar";
$owl_lang->owl_title_HD			= "SE HÅRDDISK FÖR INSTÄLLNING AV NYA FILER";
$owl_lang->owl_title_logging  		= "LOGGNINGSINSTÄLLNINGAR";
$owl_lang->owl_title_other		= "ANDRA INSTÄLLNINGAR";
$owl_lang->owl_title_tools   		= "SÄKERHETSKOPIERING AV DATABAS/GZIP-VERKTYG";
$owl_lang->owl_unzip_path     		= "Sökväg till unzip:";
$owl_lang->owl_version_control		= "Aktivera versionskontrollsfunktion:";
$owl_lang->owl_wordtotext_path          = "MS-WORD filer <br />&#8211; Blank = avaktiverad:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPPOINT filer <br />&#8211; Blank = avaktiverad:";
$owl_lang->quota			= "Profilutrymme 0=avaktiverad";
$owl_lang->reallydeluser		= "Denna användare äger %numfiles% fil(er) och %numfolders% katalog(er). Denna/dessa fil(er) och katalog(er) kommer bli föräldralös(a). Vill du fortfarande radera?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Visa inlägg per sida (0 = avaktiverad):";
$owl_lang->recycle_enabled		= "Aktivera papperskorg:";
$owl_lang->recycle_location		= "Sökväg till papperskorg:";
$owl_lang->recycle_title		= "INSTÄLLNINGAR FÖR PAPPERSKORG";
$owl_lang->remember_me			= "Visa påminnelselänk";
$owl_lang->remember_me_checkbox		= "Påminn mig";
$owl_lang->remember_me_title		= "INSTÄLLNINGAR FÖR KONSTANT INLOGGNING";
$owl_lang->remember_timeout		= "Timeout för kakor, i dagar";
$owl_lang->restore_file_prefix		= "Prefixsträng för återställda filer";
$owl_lang->search_result_folders	= "Inkludera kataloger i sökresultat";
$owl_lang->show_action_title		= "Visa åtgärdsknappar:";
$owl_lang->show_bulk_title		= "Visa fleråtgärdsknappar:";
$owl_lang->show_folder_title		= "Visa katalogverktyg:";
$owl_lang->show_panel			= "Visa";
$owl_lang->show_panel_title		= "Visa statuspanel:";
$owl_lang->show_pref_title		= "Visa installningar/utloggningsfält:";
$owl_lang->show_search_title		= "Visa sökfält:";
$owl_lang->status_bar_both              = "Topp och botten";
$owl_lang->status_bar_bottom            = "Endast botten";
$owl_lang->status_bar_location          = "Visa statuspanelen i:";
$owl_lang->status_bar_not               = "Visa inte";
$owl_lang->status_bar_top               = "Endast toppen";
$owl_lang->use_popup			= "Använd popup för att visa nyheter:";
$owl_lang->users           		= "Användare";
$owl_lang->virus_path			= "Sökväg till program för viruskontroll<br />Example: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Blank = avakiverad:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Användardefinierade fält i popupbeskrivning";
$owl_lang->cust_headpopup     		= "SPECIFIKA DOKUMENTFÄLT";
$owl_lang->auth_http                    = "HTTP Auth (.htaccess)";
$owl_lang->auth_ldap                    = "LDAP Authentication";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Användare som har denna grupp som sin primära";
$owl_lang->create_user_homedir 		= "Skapa hemmakatalog för användare:";
$owl_lang->use_captcha 			= "Använd CAPTCHA:";
$owl_lang->created_here 		= "<br /> (SKAPAD HÄR OM skapa hemmakatalog för användare markerad)";
$owl_lang->auth_owl                     = "Owl Verifiering";
$owl_lang->auth_pop3                    = "pop3 Verifiering";
$owl_lang->file_desc_required           = "Filbeskrivning är obligatoriskt";
$owl_lang->folder_desc_required         = "Katalogbeskrivning är obligatoriskt";
$owl_lang->html_title			= "HTML-inställningar";
$owl_lang->pass_account_lockout         = "Antal försök innan utelåsning:";
$owl_lang->pass_change_every            = "Tvinga byte av lösenord var X (dag) 0 = avaktiverad:";
$owl_lang->pass_enable_account_lockout  = "Aktivera utelåsning av konto:";
$owl_lang->pass_min_passwd_length       = "Minsta godkända längd på användarlösenord:";
$owl_lang->pass_min_passwd_numeric      = "Minsta godkända antal siffror:";
$owl_lang->pass_min_passwd_special      = "Minsta godkända antal specialtecken:";
$owl_lang->pass_min_username_length     = "Minsta godkända längd på användarnamn:";
$owl_lang->pass_track_old_passwords     = "Antal tidigare lösenord att spåra för likhetsjämförelse:";
$owl_lang->rtftotext_path                = "Sökväg till Verktyg för RTF till Text";
$owl_lang->show_user_info           = "Visade användarnamn är klickbara";
$owl_lang->user_admin              = "Användar/gruppadministratör";
$owl_lang->user_auth_type                   = "Verifieringstyp:";
$owl_lang->user_change_pass_next_login      = "Ändra lösenord vid nästa inloggning:";
$owl_lang->user_expires                     = "Kontots giltighetstid löper ut:";
$owl_lang->user_gmt_offset              = "Andvändares avvikelse från GMT";
$owl_lang->user_group_admin                 = "Filadministratör för primärgrupp:";
$owl_lang->user_login_to_newrecords         = "Inloggning till sida med nya inlägg:";
$owl_lang->users_group_admin		= "Användare som är gruppadministratörer";
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
$owl_lang->time_offsets[13][1] = "(GMT) Western Europe Time, London, Lissabon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) Central Europe Time, Bryssel, Stockholm, Madrid, Paris";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) Eastern Europe Time, Kaliningrad, Sydafrika";
$owl_lang->time_offsets[16][0] = "3";
$owl_lang->time_offsets[16][1] = "(GMT+3:00) Bagdad, Kuwait, Riyadh, Moskva, St. Petersburg, Volgograd, Nairobi";
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
$owl_lang->owl_log_hd_action	= "Åtgärd";
$owl_lang->owl_log_hd_agent	= "Agent";
$owl_lang->owl_log_hd_dt_tm	= "Datum Tid";
$owl_lang->owl_log_hd_dtls	= "Detaljer";
$owl_lang->owl_log_hd_file	= "Fil";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Sökväg till katalog";
$owl_lang->owl_log_hd_ip	= "IP / Adress";
$owl_lang->owl_log_hd_user	= "Användare";
$owl_lang->owl_log_hide      	= "Göm: ";
$owl_lang->owl_log_no_rec	= " INGA INLÄGG HITTADES ";
$owl_lang->owl_log_viewer	= "LOGGvisare";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Töm papperskorgeen";
$owl_lang->really_empty_trash	= "Verkligen tömma papperskorgen?";
$owl_lang->recycle_bin_admin    = "Papperskorgsadministration";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Filerna du begärde är bifogade.";
$owl_lang->trash_email_subject  = "ÅTERSTÄLLDA FILER DU BEGÄRT";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Gör ingenting &#8211; Låt filrättigheterna vara";
$owl_lang->everyoneread			= "Alla kan läsa/ladda ner";
$owl_lang->everyoneread_ad		= "Alla kan läsa/ladda ner";
$owl_lang->everyonewrite		= "Alla kan skriva/läsa/ladda ner";
$owl_lang->everyonewrite_ad		= "Alla kan skriva/läsa/ladda ner";
$owl_lang->everyonewrite_ad_nod		= "Alla kan läsa/skriva/ladda ner, EJ RADERA";
$owl_lang->everyonewrite_nod		= "Alla kan läsa/skriva/ladda ner, EJ RADERA";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Alla kan läsa denna katalog";
$owl_lang->geveryoneread_ad		= "Alla kan läsa denna katalog";
$owl_lang->geveryonewrite		= "Alla kan ladda upp filer till och radera denna katalog";
$owl_lang->geveryonewrite_ad		= "Alla kan ladda upp filer till och radera denna katalog";
$owl_lang->geveryonewrite_ad_nod	= "Alla kan ladda upp filer till denna katalog";
$owl_lang->geveryonewrite_nod		= "Alla kan ladda upp filer till denna katalog";
$owl_lang->ggroupread			= "Din grupp kan läsa denna katalog";
$owl_lang->ggroupread_ad		= "Den markerade gruppen kan läsa denna katalog";
$owl_lang->ggroupwrite			= "Din grupp kan ladda upp filer och radera denna katalog";
$owl_lang->ggroupwrite_ad    		= "Den markerade gruppen kan ladda upp filer och radera denna katalog";
$owl_lang->ggroupwrite_ad_nod		= "Den markerade gruppen kan ladda upp filer till denna katalog";
$owl_lang->ggroupwrite_nod		= "Din grupp kan ladda upp filer till denna katalog";
$owl_lang->ggroupwrite_worldread 	= "Din grupp kan ladda upp filer till och radera denna katalog &amp; alla andra kan visa innehållet";
$owl_lang->ggroupwrite_worldread_ad 	= "Den markerade gruppen kan ladda upp filer och radera denna katalog &amp; alla andra kan visa innehållet";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Den markerade gruppen kan ladda upp filer till denna katalog &amp; alla andra kan visa innehållet, INTE RADERA";
$owl_lang->ggroupwrite_worldread_nod 	= "Din grupp kan ladda upp filer till denna katalog &amp; alla andra kan visa innehållet, INTE RADERA";
$owl_lang->gonlyyou			= "Endast du kan ladda upp filer till och radera denna katalog";
$owl_lang->gonlyyou_ad			= "Endast du kan ladda upp filer till och radera denna katalog";
$owl_lang->groupread			= "Din grupp kan läsa/ladda ner";
$owl_lang->groupread_ad			= "Den markerade gruppen kan läsa/ladda ner";
$owl_lang->groupwrite			= "Din grupp kan läsa/skriva/ladda ner";
$owl_lang->groupwrite_ad		= "Den markerade gruppen kan läsa/skriva/ladda ner";
$owl_lang->groupwrite_ad_nod		= "Den markerade gruppen kan läsa/skriva/ladda ner, INTE RADERA";
$owl_lang->groupwrite_nod		= "Din grupp kan läsa/skriva/ladda ner, INTE RADERA";
$owl_lang->groupwrite_worldread 	= "Din grupp kan läsa/skriva/ladda ner &amp; alla andra kan läsa";
$owl_lang->groupwrite_worldread_ad 	= "Den markerade gruppen kan läsa/skriva/ladda ner &amp; alla andra kan läsa";
$owl_lang->groupwrite_worldread_ad_nod 	= "Den markerade gruppen kan läsa/skriva/ladda ner (INTE RADERA) &amp; alla andra kan läsa";
$owl_lang->groupwrite_worldread_nod 	= "Din grupp kan läsa/skriva/ladda ner (INTE RADERA) &amp; alla andra kan läsa";
$owl_lang->invalidsess			= "Ogiltigt sessions-id, vänligen logga in från startsidan<br />";
$owl_lang->notif_comment_1		= "kommenterad den";
$owl_lang->notif_comment_2		= "Kommentar:";
$owl_lang->notif_msg         		= "DETTA ÄR ETT AUTOMATISKT MEDDELANDE FRÅN OWL Intranet<br /><br />Den nya/uppdaterade filen är bifogad i detta epostmeddelande<br /><br />";
$owl_lang->notif_msg_alt         	= "DETTA ÄR ETT AUTOMATISKT MEDDELANDE FRÅN OWL Intranet\n\nDen nya/uppdaterade filen är bifogad i detta epostmeddelande\n\n";
$owl_lang->notif_msg_alt_link           = "DETTA ÄR ETT AUTOMATISKT MEDDELANDE FRÅN OWL Intranet\n\nEn länk till den nya/uppdaterade filen finns i detta epostmeddelande\n\n";
$owl_lang->notif_msg_link               = "DETTA ÄR ETT AUTOMATISKT MEDDELANDE FRÅN OWL Intranet<br /><br />En länk till den nya/uppdaterade filen finns i detta epostmeddelande<br /><br />";
$owl_lang->notif_salutation		= "Bäste";
$owl_lang->notif_subject_comment	= "En OWL Intranet-fil -- Kommentar tillagd";
$owl_lang->notif_subject_monitor	= "En OWL Intranet-fil eller katalog som du BEVAKAR har uppdaterats";
$owl_lang->notif_subject_new 		= "Ny OWL Intranet-fil";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "En OWL Intranet-fil har uppdaterats";
$owl_lang->notif_subject_file_deleted   = "FIL RADERAD FRÅN FÖRRÅD";
$owl_lang->notif_subj_new_account       = "ETT NYTT OWL-KONTO HAR SKAPATS ÅT DIG";
$owl_lang->notif_user			= "Skapad/uppdaterad av:";
$owl_lang->onlyyou			= "Endast du kan läsa/ladda ner/skriva";
$owl_lang->onlyyou_ad			= "Endast du kan läsa/ladda ner/skriva";
$owl_lang->orphaned			= "&#8211; INGEN ägare  &#8211;";
$owl_lang->owl_path			= "Sökväg: ";
$owl_lang->sessinuse			= "Denna session används på en annan dator, åtkomst nekas<br />";
$owl_lang->sesstimeout			= "Du har loggats ut pga inaktivitet, vänligen logga in igen<br />";
$owl_lang->virus_infected 		= "VIRUSINFEKTERAD FIL";
$owl_lang->virus_return_val		= "Svar från Virusprogrammet:";
$owl_lang->watermark_string		= "Konfidentiell";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Bläddra i denna katalog";
$owl_lang->title_browse_site     	= "Bläddra till denna webbadress";
$owl_lang->title_download_view     	= "Ladda ner / Visa denna fil";
$owl_lang->title_edit_prefs     	= "Visa / Redigera användarinställningar";
$owl_lang->title_return_folder     	= "Återgå till";
$owl_lang->title_sort     		= "Sortera på";
$owl_lang->title_view_my     		= "Visa lista över Mina filer";
$owl_lang->title_view_new     		= "Visa lista över Nya filer sedan mitt senaste besök";
$owl_lang->title_view_updated     	= "Visa lista över Uppdaterade filer sedan mitt senaste besök";
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

$owl_lang->news_content			= "Innehåll";
$owl_lang->news_hd			= "Nyheter";
$owl_lang->news_hd_audience		= "Målgrupp";
$owl_lang->news_hd_created		= "Skapad den";
$owl_lang->news_hd_expires		= "Förfaller den";
$owl_lang->news_heading			= "Nyhetsrubrik";
$owl_lang->news_posted_date		= "Nyhet publicerad:";
$owl_lang->news_read			= "Läs";
$owl_lang->news_title			= "Nyhetsadministration";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: OWLs dokumentkatalog: " .$default->owl_fs_root . "/" . fid_to_name(1) ." existerar inte.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: OWLs dokumentkatalog: " .$default->owl_fs_root . "/" . fid_to_name(1) ." är inte skrivbar för webbservern.";
$owl_lang->debug_file_not_exist		= "DEBUG: Den obligatoriska filen &ldquo;$default->owl_fs_root/%s &rdquo; existerar inte.<br /> OR<br />Sökvägen angiven av \$default->owl_fs_root i config/owl.php är felaktig.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: OWLs tempkatalog: %s existerar inte.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: OWLs tempkatalog: %s är inte skrivbar för webbservern.";
$owl_lang->debug_webserver_no_access	= "DEBUG: Webbservern har inte läsrättigheter till: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Ändra behörigheterna och försök igen";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Statistik / Rapportvisare";
$owl_lang->stats_files		= "Antal filer per användare";
$owl_lang->stats_folders	= "Antal kataloger per användare";
$owl_lang->stats_information	= "Owls loggning och filloggning måste vara aktiverad för att kunna visa denna statistik";
$owl_lang->stats_top		= "Topp 20 nerladdningar";
$owl_lang->stats_report_users_disabled         = "Användare (Inaktiverade användare)";
$owl_lang->stats_report_users_entitlement         = "Användare (Användarrättigheter)";
$owl_lang->stats_report_users_filesfolders          = "Användare (Filer och kataloger per användare)";
$owl_lang->stats_report_users_inactive          = "Användare (Inaktiva användare)";
$owl_lang->stats_users          = "ANVÄNDARE Inloggning (Inloggning / Fel / Utloggning)";
$owl_lang->stats_users_loggedin = "Inloggade just nu";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administration av dokumenttyp";
$owl_lang->doc_field_label	= "Fältetikett (Per plats)";
$owl_lang->doc_field_name	= "Fältnamn";
$owl_lang->doc_field_pos	= "Fältposition";
$owl_lang->doc_field_required	= "Obligatorisk?";
$owl_lang->doc_field_searchable	= "Sökbar?";
$owl_lang->doc_field_size	= "Fältstorlek";
$owl_lang->doc_new_doc_type	= "&#8211; LÄGG TILL ny dokumettyp&#8211;";
$owl_lang->doc_specific		= "DOKUMENTSPECIFIKA FÄLT:";
$owl_lang->document_type	= "Dokumenttyp";
$owl_lang->document_type_name	= "Namn för dokumenttyp";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Lägga till i popup-beskrivning?";
$owl_lang->doc_field_disp_label = "FÄLTETIKETT:";
$owl_lang->doc_field_disp_sep = "SEPERATORETIKETT";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Visa i bläddrare:";
$owl_lang->doc_field_show_in_list = "Visa fältet i bläddringsvyn:";
$owl_lang->doc_field_type	= "Fälttyp:";
$owl_lang->doc_field_values	= "Fältvärden separerade med | :";
$owl_lang->doc_fields = "Användardefinierade fält";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grupp:";
$owl_lang->header_csv_import    = "Importera CSV-användarfil";
$owl_lang->import_inserted      = "INFOGAD";
$owl_lang->import_skipped       = "ÖVERHOPPAD";
$owl_lang->invalid_groupid      = "Ogiltigt grupp-id --> ";
$owl_lang->msg_user_exists      = "Användaren finns redan";
$owl_lang->sendcsvfile          = "Ladda upp kommaseparerad fil";
$owl_lang->user_created_skipped = "Användare:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Aktivera sakutlåtandefunktionen:";
$owl_lang->owl_peer_review_opt  = "Gör sakutlåtande valbart:";
$owl_lang->owl_title_peer_review= "SAKUTLÅTANDEFUNKTION";
$owl_lang->owl_title_peer_review2= "Sakutlåtandefunktion för dokument";
$owl_lang->peer_approval_title 	= "Dokument som inväntar mitt godkännande";
$owl_lang->peer_approved_body	= "Din fil har blivit godkänd:";
$owl_lang->peer_file_approved	= "Filen godkänd:";
$owl_lang->peer_file_final	= "Slutgiltigt godkänd:";
$owl_lang->peer_file_rejected	= "Fil ej godkänd:";
$owl_lang->peer_file_to_review	= "Fil att granska:";
$owl_lang->peer_final_approval	= "[Slutgiltigt godkännande]: ";
$owl_lang->peer_final_body	= "Ditt dokument har godkänts av alla angivna granskare.<br />Logga in och gör dokumentet publikt<br />";
$owl_lang->peer_msg_to_reviewer	= "Meddelande till granskare";
$owl_lang->peer_my_approval	= "Inväntar mitt godkännande";
$owl_lang->peer_notif_user	= "Skapad/uppdatead av";
$owl_lang->peer_pending_approval= "Mina vilande godkännanden";
$owl_lang->peer_pending_title 	= "Mina dokument som inväntar godkännande";
$owl_lang->peer_reject_reason   = "Orsak till avslag";
$owl_lang->peer_rejected_body	= "Din fil har inte blivit godkänd:";
$owl_lang->peer_review_body	= "Ditt godkännande har efterfrågats för följande dokument:";
$owl_lang->peer_reviewer_list	= "Granskare";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_satus_approved  = "&#8212; G O D K Ä N D &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; V Ä N T A R &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; E J  G O D K Ä N D &#8212;";
$owl_lang->peer_subj_approved	= "Ditt dokument har blivit GODKÄNT";
$owl_lang->peer_subj_rejected	= "Ditt dokument har INTE blivit GODKÄNT";
$owl_lang->peer_subj_reminder	= "PÅMINNELSE: Du har en OWL-fil att granska";
$owl_lang->peer_subj_review	= "Du har en OWL-fil att granska";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Ditt dokument har godkänts av alla angivna granskare.<br />Din fil har publicerats.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Lägger till fil ACL:";
$owl_lang->acl_adding_folder           = "Lägger till katalog ACL:";
$owl_lang->acl_available_groups        = "Tillgänglig(a) grupp(er)";
$owl_lang->acl_available_users         = "Tillgänglig(a) användare";
$owl_lang->acl_edit_file               = "Redigerar fil ACL:";
$owl_lang->acl_edit_folder             = "Redigerar katalog ACL:";
$owl_lang->acl_file_checkin            = "Checka In/Ut";
$owl_lang->acl_file_comment            = "Kommentar";
$owl_lang->acl_file_copy               = "Kopiera";
$owl_lang->acl_file_delete             = "Radera";
$owl_lang->acl_file_email              = "Eposta";
$owl_lang->acl_file_modify             = "Egenskaper";
$owl_lang->acl_file_monitor            = "Bevaka";
$owl_lang->acl_file_move               = "Flytta";
$owl_lang->acl_file_read               = "Läs";
$owl_lang->acl_file_search             = "Sök liknande";
$owl_lang->acl_file_set_acl            = "Sätt ACL";
$owl_lang->acl_file_update             = "Uppdatera";
$owl_lang->acl_file_view_log           = "Visa logg";
$owl_lang->acl_folder_copy             = "Kopiera";
$owl_lang->acl_folder_delete           = "Radera";
$owl_lang->acl_folder_modify           = "Redigera egenskaper";
$owl_lang->acl_folder_monitor          = "Bevaka";
$owl_lang->acl_folder_move             = "Flytta";
$owl_lang->acl_folder_read             = "Läs (Ladda ner/Bläddra)";
$owl_lang->acl_folder_set_acl          = "Sätt ACL";
$owl_lang->acl_folder_write            = "Skriv (Skapa)";
$owl_lang->acl_heading_file            = "Grupp(er)/Användare";
$owl_lang->acl_heading_files           = "FILER &#8211; VÄLJ ÖNSKAD(e) ANVÄNDARE och GRUPP(er)";
$owl_lang->acl_heading_folder          = "Grupp(er)/Användare";
$owl_lang->acl_heading_folders         = "KATALOGER &#8211; VÄLJ ÖNSKAD(e) ANVÄNDARE och GRUPP(er)";
$owl_lang->acl_propagate_file          = "Sätt denna policy för  \"ALL\" filer:";
$owl_lang->acl_propagate_folders       = "Ärv till alla underkataloger:";
$owl_lang->acl_selected_groups         = "Markerad(e) grupp(er)";
$owl_lang->acl_selected_users          = "Markerad(e) användare";
$owl_lang->acl_set_acl                 = "Sätt säkerhetspolicy";
$owl_lang->acl_set_acl_now             = "Sätt sökerhetspolicy nu:";
$owl_lang->acl_set_selected            = "Sätt markerade";
$owl_lang->alt_acl_save_file           = "Spara säkerhetspolicy för fil";
$owl_lang->alt_acl_save_folder         = "Spara säkerhetspolicy för katalog";
$owl_lang->btn_acl_save                = "Spara";
$owl_lang->acl_set_file_permissions    = "Sätt filrättigheter";
$owl_lang->acl_set_folder_permissions  = "Sätt katalogrättigheter";
$owl_lang->alt_set_folder_acl	       = "Sätt säkerhetspolicy för aktuell katalog";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Tillgängliga rapporter:";
$owl_lang->report_file_folder               = "Fil/katalog";
$owl_lang->report_filter                    = "Filter:";
$owl_lang->report_filter_since              = "Sedan:";
$owl_lang->report_full_access               = "FULL TILLGÅNG";
$owl_lang->report_select_report             = "&#8211; Välj en rapport &#8211;";
$owl_lang->report_users_disabled_title      = "Inaktiverad(e) användare";
$owl_lang->report_users_entitlement         = "Lista över användare";
$owl_lang->report_users_inactive_title      = "Användare inaktiva sedan";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Aktivera miniatyrvy/skapande:";
$owl_lang->thumb_gen_thumb_tool_path       = "Sökväg till ImageMagick konverteringsverktyg:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Parametrar för Mplayer:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Sökväg till Mplayer:";
$owl_lang->thumb_image_info                = "Bildinformation";
$owl_lang->thumb_large_width               = "Bredd för miniatyrbild (STOR) Pixlar:";
$owl_lang->thumb_med_width                 = "Bredd för miniatyrbild (MEDIUM) Pixlar:";
$owl_lang->thumb_number_colums             = "Antal kolumner i miniatyrbildsvy:";
$owl_lang->thumb_re_generate               = "Skapa miniatyrbilder";
$owl_lang->thumb_small_width               = "Bredd för miniatyrbil (LITEN) 0=Visa ej Pixlar:";
$owl_lang->thumb_title                     = "ALTERNATIV FÖR VY/SKAPANDE AV MINIATYRBILDER";
$owl_lang->thumb_title_thumb_view          = "DETALJER FÖR MINIATYRVY";
$owl_lang->thumb_image_size                = "Bildstorlek:";
$owl_lang->alt_thumb_small                 = "Liten miniatyrbild";
$owl_lang->alt_no_thumb                    = "Ingen miniatyrbild tillgänglig";

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// EXTENDED HELP BEGIN
//********************************************************

$owl_lang->owl_track_favorites_extended         = "Spåra favoriter";
$owl_lang->owl_password_override_extended       = "Om denna funktion är vald, kan användare som inte har behörighet till filen ladda ner den genom att ange ett lösenord";
$owl_lang->owl_view_doc_in_new_window_extended  = "När du visare ett dokument öppnas detta i ett nytt fönster";
$owl_lang->owl_filedescreq_extended             = "Gör filbeskrivning till ett obligatoriskt fält";
$owl_lang->owl_old_action_icons_extended        = "Utökad hjälp";
$owl_lang->owl_email_from_extended              = "Utökad hjälp";
$owl_lang->owl_email_fromname_extended      = "Utökad hjälp";
$owl_lang->owl_email_replyto_extended       = "Utökad hjälp";
$owl_lang->owl_email_server_extended            = "Utökad hjälp";
$owl_lang->owl_use_smtp_extended                = "Utökad hjälp";
$owl_lang->owl_use_smtp_auth_extended           = "Utökad hjälp";
$owl_lang->owl_smtp_auth_login_extended         = "Utökad hjälp";
$owl_lang->owl_smtp_passwd_extended             = "Utökad hjälp";
$owl_lang->owl_email_subject_extended           = "Utökad hjälp";
$owl_lang->owl_forgot_pass_extended             = "Utökad hjälp";
$owl_lang->owl_self_reg_extended                = "Utökad hjälp";
$owl_lang->owl_html2text_path_extended      = "Utökad hjälp";
$owl_lang->owl_remember_me_extended             = "Utökad hjälp";
$owl_lang->owl_status_bar_location_extended     = "Utökad hjälp";
$owl_lang->owl_info_panel_wide_extended     = "Utökad hjälp";
$owl_lang->owl_thumbnails_extended          = "Utökad hjälp";
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

$owl_lang->group_set_selected      = "Välj markerad";
$owl_lang->alt_group_set_selected  = "Väljer markerade användare";

$owl_lang->owl_use_smtp_ssl                     = "SMTP SSL:";
$owl_lang->owl_smtp_port                        = "SMTP Portnummer:";
$owl_lang->owl_smtp_max_attachemnt_size         = "Maximal storlek för bilagor (bytes):";
$owl_lang->owl_force_browser_to_ssl             = "Tvinga webbläsare att använda HTTPS:";
$owl_lang->owl_file_update_different_name       = "Uppdatera fil med annat namn:<br />(FILÄNDELSE måste vara samma.)";
$owl_lang->owl_use_wysiwyg_editor               = "Använd WYSIWYG-redigerare för Textarea:";
$owl_lang->owl_show_folder_desc_popup           = "Visa katalogbeskrivning som Popup:";
$owl_lang->owl_header_watermarking              = "INSTÄLLNINGAR FÖR PDF-VATTENMÄRKE";
$owl_lang->owl_enable_watermarking              = "Aktivera Pdf-vattenmärke:";
$owl_lang->owl_path_to_pdftk                    = "Sökväg till pdftk:";
$owl_lang->owl_path_to_pdftk_bg_file            = "Sökväg till alternativt vattenmärke:<br />(sökväg till ett enkelsidigt pdf-dokument som kommer användas <br />som vattenmärke istället för standardvattenmärket";
$owl_lang->owl_pdftk_greater_than_1_40          = "PDFTK-version nyare än 1.40:";
$owl_lang->owl_indexing_user_selectable         = "Gör filindexering valbart för användare:";
$owl_lang->owl_indexing_off                     = "Stäng av filindexering:";
$owl_lang->owl_default_revision_type            = "Standardrevideringstyp:";
$owl_lang->owl_machine_timezone                 = "Tidszon för maskinen:";
$owl_lang->owl_previous_ver_downloadable        = "Gör tidigare version tillgänglig:";
$owl_lang->owl_auto_checkin_checkout            = "Markera filer som utcheckade vid nedladdning:";
$owl_lang->owl_user_default_view                = "Utökad vy standard för användare:";
$owl_lang->owl_user_default_revision            = "Standardrevideringstyp:";
$owl_lang->owl_user_major_revision              = "Användardefinierat startvärde, större revidering:";
$owl_lang->owl_user_minor_revision              = "Användardefinierat startvärde, mindre revidering:";
$owl_lang->owl_user_pdfwatermark                = "Vattenmärke på PDF:";
$owl_lang->owl_user_email_pass                  = "Epost användare / Lösenord:";
$owl_lang->owl_use_email_signature              = "Använd signatur?:";
$owl_lang->owl_email_signature                  = "Epostsignatur:";
$owl_lang->owl_file_link                        = "Fillänk:";
$owl_lang->alt_hot_link                         = "Visa direktlänk (URL)";
$owl_lang->alt_link_folder                      = "Länka denna katalog";

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
