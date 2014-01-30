<?php

/*
 * File: Nederlands/language.inc  
 *
 *  Author: Jeroen Meintjens  <j.meintjens(a)zonnet.nl>
 *  Date: 2007/11/26
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
	$owl_lang->localized_date_format = "d-m-Y (H:i)";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "nl";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "U heeft geen permissie om opmerkingen te plaatsen bij een bestand";
$owl_lang->err_backup_file   		= "Fout bij maken van een backup van een bestaand bestand";
$owl_lang->err_backup_folder_create 	= "Fout bij aanmaken van backup-map";
$owl_lang->err_bad_url			= "Voer a.u.b. een geldige URL in";
$owl_lang->err_bad_version_1 		= "DMS heeft een minimale PHP-versie nodig";
$owl_lang->err_bad_version_2 		= "U draait versie";
$owl_lang->err_bad_version_3 		= "Installeer een nieuwere versie van PHP en probeer opnieuw.";
$owl_lang->err_comment_empty		= "Een opmerking mag niet leeg zijn";
$owl_lang->err_email         		= "Het bericht kon niet worden verzonden";
$owl_lang->err_email_required		= "E-mail veld is verplicht";
$owl_lang->err_fexist1			= "<b>Bestand bestaat al:</b>";
$owl_lang->err_fexist2 			= "Er bestaat al een bestand met de naam <i>";
$owl_lang->err_fexist3 			= "</i> in deze map.";
$owl_lang->err_file_exists		= "Het bestand dat u probeert toe te voegen bestaat al.";
$owl_lang->err_file_lock     		= "U kunt dit bestand niet vergrendelen, het is vergrendeld door";
$owl_lang->err_file_not_exist		= "Bestand bestaat niet op het bestandsysteem";
$owl_lang->err_file_too_big		= "Maximale bestandgrootte overschreden";
$owl_lang->err_file_update		= "Bij het bijwerken van een bestand mag de bestandsnaam niet wijzigen; probeert u het nogmaals a.u.b. met dezelfde bestandsnaam";
$owl_lang->err_fileexists    		= "Verplaatsing is geannuleerd<br />Er bestaat al een bestand met deze naam.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "De nieuwe bestandsnaam die u opgeeft bestaat al";
$owl_lang->err_folder_create 		= "Fout bij het aanmaken van een map";
$owl_lang->err_folder_exist		= "Deze map bestaat al";
$owl_lang->err_folderexists  		= "Naam wijzigen is geannuleerd<br />Een map met deze naam bestaat al.";
$owl_lang->err_general 			= "Er is een fout opgetreden";
$owl_lang->err_please_select_bulk	= "Selecteer a.u.b. ten minste een bestand of map met de vinkjes";
$owl_lang->err_select_reviewer		= "Selecteer a.u.b. ten minste een persoon om uw bestand te beoordelen";
$owl_lang->err_update_file_lock     	= "U kunt dit bestand niet bijwerken, het is vergrendeld door";
// NEW CHANGE
$owl_lang->err_group_delete             = "Deze groep kan niet worden verwijderd: <font color=\"red\">%d</font> Bestand(en),  <font color=\"red\">%d</font> Map(pen), <font color=\"red\">%d</font> Gebruiker(s) met deze Primaire Groep, <font color=\"red\">%d</font> Gebruiker(s) lid van deze groep";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Kan niet verwijderen, er zijn bestanden van dit document type";
$owl_lang->err_database			= "Database fout";
$owl_lang->err_doc_field_req            = "Verplicht veld ontbreekt:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Document Type Naam is verplicht <br />";
$owl_lang->err_field_label_req 		= "Veld Label is verplicht <br />";
$owl_lang->err_field_name_req		= "veld Naam is verplicht <br />";
$owl_lang->err_field_size_req		= "Veld Grootte is verplicht <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Fout bij aanmaken van tijdelijk &ldquo;TEXT&rdquo; bestand";
$owl_lang->err_forbidden_file		= "Verboden bestandstype";
$owl_lang->err_group_exists		= "Er is al een groep met deze naam";
$owl_lang->err_gzip_not_found  		= "gzip werd niet gevonden in ";
$owl_lang->err_login			= "Voor deze handeling moet u zich aanmelden.";
$owl_lang->err_movecancel    		= "verplaatsing geannuleerd<br />";
$owl_lang->err_nameempty    		= "Mapnaam kan niet leeg zijn";
$owl_lang->err_news_required		= "FOUT: Nieuwskop en inhoud zijn verplicht!";
$owl_lang->err_no_access 		= "U heeft geen toegang tot een of meedere geselecteerde bestanden";
$owl_lang->err_no_access_info 		= "Mogelijke oorzaken: <br />1) U heeft geen bestanden of mappen geselecteerd met de vinkjes<br />2) Bulk Verwijderen, Bulk E-mail, en Bulk Vergrendelen gelden niet voor mappen<br />3) U heeft geen toegang tot een of meerdere geselecteerde mappen/bestanden.";
$owl_lang->err_noemail			= "U heeft geen permissie om dit bestand te mailen";
$owl_lang->err_nofileaccess		= "U heeft geen toegang tot dit bestand";
$owl_lang->err_nofiledelete		= "U heeft geen permissie om dit bestand te verwijderen";
$owl_lang->err_nofilemod		= "U heeft geen permissie om dit bestand te wijzigen";
$owl_lang->err_nofolderaccess		= "U heeft geen toegang tot deze map";
$owl_lang->err_nofolderdelete		= "U heeft geen permissie om deze map te verwijderen";
$owl_lang->err_nofoldermod		= "U heeft geen permissie om deze map te wijzigen";
$owl_lang->err_nosubfolder		= "U heeft geen permissie om hier nieuwe mappen aan te maken";
$owl_lang->err_not_zip			= "Geen geldig ZIP Archief";
$owl_lang->err_note_title               = "De Titel is een verplicht veld";
$owl_lang->err_note_title_exists        = "Er bestaat al een notitie met deze naam";
$owl_lang->err_noupload			= "U heeft geen permissie om bestanden in deze map te plaatsen";
$owl_lang->err_pass_missmatch		= "Nieuw Wachtwoord en Bevestig Wachtwoord zijn niet hetzelfde";
$owl_lang->err_pass_wrong    		= "Oude wachtwoord is onjuist";
$owl_lang->err_please_select_bulk       = "Selecteer a.u.b. ten minste een map met de vinkjes";
$owl_lang->err_pod2html_not_found       = "FOUT: pod2html functie niet beschikbaar:";
$owl_lang->err_quota			= "U heeft onvoldoende ruimte ter beschikking om dit bestand te plaatsen: ";
$owl_lang->err_quota_avail		= " beschikbaar.";
$owl_lang->err_quota_exceed  		= "U heeft uw maximale gebruikersruimte overschreden ";
$owl_lang->err_quota_needed		= " nodig ";
$owl_lang->err_req			= "FOUT: Alle velden zijn verplicht";
$owl_lang->err_root_delete		= "De basis-map kan niet worden verwijderd";
$owl_lang->err_sess_notvalid 		= "Ongeldige sessie-ID";
$owl_lang->err_sess_write		= "Fout bij opslaan van sessie-informatie in de database";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; is een gereserveerde map-naam; kies a.u.b. een andere naam";
$owl_lang->err_sql			= "SQL fout";
$owl_lang->err_tar_not_found  		= "tar werd niet gevonden in ";
$owl_lang->err_trash_can_empty 		= "De prullenbak is leeg";
$owl_lang->err_unauth_area   		= "U hebt geen toestemming dit gebied te gebruiken";
$owl_lang->err_unauthorized  		= "Geen toestemming";
$owl_lang->err_upload 			= "Fout bij plaatsen";
$owl_lang->err_user_exists		= "Gebruikersnaam bestaat al";
// NEW STUFF
$owl_lang->err_captcha_auth		= "CAPTCHA controle onjuist";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Veld toevoegen";
$owl_lang->btn_add_file          = "Document toevoegen";
$owl_lang->btn_add_folder          = "Map toevoegen";
$owl_lang->btn_add_news          = "Nieuwsbericht toevoegen";
$owl_lang->btn_add_note          = "Notitie toevoegen";
$owl_lang->btn_add_url          = "Hyperlink toevoegen";
$owl_lang->btn_add_zip           = "Archiefbestand toevoegen";
$owl_lang->btn_admin      = "Beheer";
$owl_lang->btn_admin_groups          = "Nieuwe groep";
$owl_lang->btn_admin_news          = "Nieuws beheer";
$owl_lang->btn_admin_user_group          = "Gebruikers/groepen beheer";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Nieuwe gebruiker";
$owl_lang->btn_back          = "Ga terug";
$owl_lang->btn_browse     = "Bladeren";
$owl_lang->btn_bulk_checkout       = "Bulk Vergrendelen";
$owl_lang->btn_bulk_delete         = "Bulk verwijderen";
$owl_lang->btn_bulk_download          = "Bulk downloaden";
$owl_lang->btn_bulk_email          = "Bulk e-mailen";
$owl_lang->btn_bulk_move          = "Bulk verplaatsen";
$owl_lang->btn_cancel          = "Annuleren";
$owl_lang->btn_clickhere          = "Klik hier";
$owl_lang->btn_collapse_view          = "Beperkte weergave";
$owl_lang->btn_create          = "Aanmaken";
$owl_lang->btn_default_view          = "Standaard weergave";
$owl_lang->btn_deldoctype          = "Verw. Doc Type";
$owl_lang->btn_download_bulk_package	= "om uw bulk download pakket de downloaden";
$owl_lang->btn_edit_group          = "Bewerk groep";
$owl_lang->btn_edit_user          = "Bewerk gebruiker";
$owl_lang->btn_expand_view          = "Uitgebreide weergave";
$owl_lang->btn_go_bottom      = "Ga naar onder";
$owl_lang->btn_go_top      = "Ga naar boven";
$owl_lang->btn_help     = "Help";
$owl_lang->btn_import_users  = "Importeer <br />gebruikersgegevens";
$owl_lang->btn_login          = "Aanmelden";
$owl_lang->btn_logout     = "Afmelden";
$owl_lang->btn_mail_tool     = "E-mail";
$owl_lang->btn_register          = "Registreer";
$owl_lang->btn_reset          = "Herstel";
$owl_lang->btn_send_email          = "Verstuur e-mail";
$owl_lang->btn_submit          = "Instellen";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Voorbeeld weergave";
$owl_lang->btn_trash_admin          = "Prullenbak";
// NEW STUFF
$owl_lang->btn_export          = "Exporteer";
$owl_lang->btn_gen_pdf          = "Maak PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";


//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Opmerking bij dit bestand";
$owl_lang->alt_add_field	= "Add The Field Above";
$owl_lang->alt_add_group	= "Maak deze groep aan";
$owl_lang->alt_add_news		= "Maak nieuw nieuwsbericht";
$owl_lang->alt_add_user		= "Maak deze gebruiker aan";
$owl_lang->alt_admin_flush      = "Ongeldige sessies wissen";
$owl_lang->alt_admin_groups	= "Maak een nieuwe groep aan";
$owl_lang->alt_admin_users	= "Maak een nieuwe gebruiker aan";
$owl_lang->alt_approve_file 	= "Keur dit document goed";
$owl_lang->alt_back      	= "Terug naar vorig scherm";
$owl_lang->alt_btn_add_file     = "Voeg een nieuw bestand toe";
$owl_lang->alt_btn_add_folder	= "Maak een nieuwe map";
$owl_lang->alt_btn_add_note     = "Maak een nieuwe notitie";
$owl_lang->alt_btn_add_url	= "Maak een nieuwe internet-hyperlink";
$owl_lang->alt_btn_add_zip     	= "Voeg een ZIP-archief toe om uit te pakken";
$owl_lang->alt_btn_admin 	= "Owl Beheer";
$owl_lang->alt_btn_browse	= "Terug naar bestandbeheer";
$owl_lang->alt_btn_bulk_checkout= "Bulk bestanden vergrendelen";
$owl_lang->alt_btn_bulk_delete 	= "Bulk bestanden verwijderen";
$owl_lang->alt_btn_bulk_download= "Bulk bestanden downloaden";
$owl_lang->alt_btn_bulk_email  	= "Bulk bestanden e-mailen";
$owl_lang->alt_btn_bulk_move   	= "Bulk bestanden en mappen verplaatsen";
$owl_lang->alt_btn_clickhere	= "Klik hier";
$owl_lang->alt_btn_collapse_view= "Schakel naar beperkte weergave";
$owl_lang->alt_btn_default_view = "Schakel naar standaard weergave";
$owl_lang->alt_btn_expand_view  = "Schakel naar uitgebreide weergave";
$owl_lang->alt_btn_help		= "Owl Online Help";
$owl_lang->alt_btn_login	= "Aanmelden bij DMS";
$owl_lang->alt_btn_logout	= "Afmelden bij DMS";
$owl_lang->alt_btn_mail_tool   	= "Beperkte e-mail functie";
$owl_lang->alt_btn_thumb_view   = "Schakel naar voorbeeldweergave";
$owl_lang->alt_cancel		= "Annuleer deze actie";
$owl_lang->alt_cancel_move	= "Annuleer deze verplaatsing";
$owl_lang->alt_change		= "Werk dit record bij";
$owl_lang->alt_comments 	= "Er is een opmerking bij dit bestand geplaatst";
$owl_lang->alt_copy_file     	= "Kopieer bestand";
$owl_lang->alt_copy_folder   	= "Kopieer naar map";
$owl_lang->alt_del_all		= "Leeg prullenbak";
$owl_lang->alt_del_comments     = "Verwijder deze opmerking";
$owl_lang->alt_edt_comments     = "Bewerk deze opmerking";
$owl_lang->alt_del_field	= "Verwijder dit veld";
$owl_lang->alt_del_file      	= "Bestand verwijderen";
$owl_lang->alt_del_folder    	= "Map verwijderen";
$owl_lang->alt_del_group	= "verwijder deze groep";
$owl_lang->alt_del_news		= "Verwijder dit nieuwsbericht";
$owl_lang->alt_del_selected	= "Verwijder alle geselecteerde bestanden";
$owl_lang->alt_del_this_folder	= "Verwijder map &#8211; ";
$owl_lang->alt_del_user		= "Verwijder deze gebruiker";
$owl_lang->alt_deldoctype	= "Verwijder huidig document type";
$owl_lang->alt_edit_field	= "Bewerk deze veld-definitie";
$owl_lang->alt_edit_group       = "Bewerk de geselecteerde groep";
$owl_lang->alt_edit_news	= "Bewerk dit nieuwsbericht";
$owl_lang->alt_edit_user        = "Bewerk de geselecteerde groep";
$owl_lang->alt_email		= "E-mail dit bestand";
$owl_lang->alt_email_reminder 	= "E-Mail herinnering";
$owl_lang->alt_email_selected	= "E-Mail alle geselecteerde bestanden";
$owl_lang->alt_get_file      	= "Download Bestand";
$owl_lang->alt_get_folder      	= "Download mapinhoud";
$owl_lang->alt_go_bottom      	= "Ga naar het einde van de pagina";
$owl_lang->alt_go_top 		= "Go naar het begin van de pagina";
$owl_lang->alt_have_news	= "U heeft onbekeken nieuwsberichten";
$owl_lang->alt_have_no_news	= "Geen onbekeken nieuwsberichten";
$owl_lang->alt_home_folder	= "Terug naar beginmap ";
$owl_lang->alt_link_file     	= "Koppel dit bestand aan een andere map";
$owl_lang->alt_lock_file        = "Vergrendel bestand";
$owl_lang->alt_log_clear        = "Wis het logboek";
$owl_lang->alt_log_file         = "Bestands-logboek";
$owl_lang->alt_log_next		= "Geef de volgende records weer";
$owl_lang->alt_log_prev		= "Geef de vorige records weer";
$owl_lang->alt_log_top		= "Ga naar het eerste record";
$owl_lang->alt_mod_file      	= "Wijzig bestandskenmerken"; 
$owl_lang->alt_mod_folder    	= "Wijzig mapkenmerken";
$owl_lang->alt_monitor		= "Monitor dit bestand";
$owl_lang->alt_monitor_folder   = "Monitor deze map";
$owl_lang->alt_monitored	= "Stop Monitoring van dit bestand";
$owl_lang->alt_monitored_folder = "Stop Monitoring van deze map";
$owl_lang->alt_move_file     	= "Verplaats bestand";
$owl_lang->alt_move_folder   	= "Verplaats map";
$owl_lang->alt_move_selected	= "Verplaats alle geselecteerde bestanden";
$owl_lang->alt_my_approval	= "Bestand(en) wachten op mijn goedkeuring";
$owl_lang->alt_new_doctype	= "Maak nieuw document type";
$owl_lang->alt_news_close	= "Sluit nieuws venster";
$owl_lang->alt_news_next	= "Geef volgende nieuwsbericht weer";
$owl_lang->alt_news_prev	= "Geef vorige nieuwsbericht weer";
$owl_lang->alt_news_print	= "Print dit nieuwsbericht";
$owl_lang->alt_pending_approval	= "Bestand(en) van mij wachten op goedkeuring";
$owl_lang->alt_play_file 	= "Speel media bestand af";
$owl_lang->alt_publish_file 	= "Maak dit document toegankelijk";
$owl_lang->alt_recycle		= "Prullenbak<br />(Leeg)";
$owl_lang->alt_recycle_disable	= "Prullenbak<br />(Uitgeschakeld)";
$owl_lang->alt_recycle_not_found= "Prullenbak<br />(Niet gevonden)";
$owl_lang->alt_refresh_filter	= "Stel filter in / Resultaten verversen";
$owl_lang->alt_register		= "Registratie indienen";
$owl_lang->alt_reject_file 	= "Keur dit document af";
$owl_lang->alt_related		= "Zoek verwante bestanden";
$owl_lang->alt_reset_form	= "Herstel formulier waarden";
$owl_lang->alt_rest_selected	= "Herstel alle geselecteerde bestanden";
$owl_lang->alt_search		= "Start zoeken";
$owl_lang->alt_send_email	= "Verstuur de e-mail";
$owl_lang->alt_sendfile		= "Verstuur het bestand";
$owl_lang->alt_set_initial_dir	= "Stel deze map in als uitgangsmap";
$owl_lang->alt_site_map         = "Overzicht";
$owl_lang->alt_submit      	= "Formulier versturen";
$owl_lang->alt_toggle_check_box	= "Vinkjes wisselen";
$owl_lang->alt_tool_status_green= "Functie actief";
$owl_lang->alt_tool_status_red	= "Onjuist pad EN/OF niet uitvoerbaar";
$owl_lang->alt_unlock_file      = "Bestand ontgrendelen";
$owl_lang->alt_upd_field	= "Veld bijwerken";
$owl_lang->alt_upd_file      	= "Bestand bijwerken";
$owl_lang->alt_view_comments    = "Opmerkingen bekijken/toevoegen";
$owl_lang->alt_view_file     	= "Bestand bekijken";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Prullenbak beheer";
$owl_lang->alt_edit_file_inline = "Tekstbestand bewerken";
$owl_lang->alt_gen_pdf          = "Maak PDF-versie van dit bestand";
$owl_lang->alt_updated     	= "Document is bijgewerkt na uw vorige bezoek";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Document gemaakt na uw laatste bezoek";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Gehele inhoud ook verwijderd";
$owl_lang->log_detail		= "Geen nadere details";
$owl_lang->log_file_to		= "Aan: ";
$owl_lang->log_filter_all	= "ALLES";
$owl_lang->log_login_det	= "Gebruikersnaam: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Groep gewijzigd: ";
$owl_lang->log_admin_changed_user = "Gebruiker gewijzigd: ";
$owl_lang->log_admin_created_group = "Groep aangemaakt: ";
$owl_lang->log_admin_created_user = "Gebruiker aangemaakt: ";
$owl_lang->log_admin_del_group = "Groep verwijderd: ";
$owl_lang->log_admin_del_user = "Gebruiker verwijderd: ";
$owl_lang->log_admin_disabled = "Gebruiker vergrendeld: ";
$owl_lang->log_admin_email_restore = "Bestanden gemaild:";
$owl_lang->log_admin_trash_delfile= "Bestand verwijderd: ";
$owl_lang->log_admin_trash_delfold = "Map verwijderd: ";
$owl_lang->log_admin_trash_empty = "Prullenbak geleegd";
$owl_lang->log_admin_trash_restore = "Hersteld: ";
$owl_lang->log_login_expired    = "Gebruiker verlopen: ";
$owl_lang->log_login_too_many_attempts = "Vergrendeld (Te vaak onjuist wachtwoord opgegeven): ";
$owl_lang->log_readhd_feature_add  = "Dit bestand werd gevonden en toegevoegd";
$owl_lang->log_admin_to  = "aan";
$owl_lang->log_admin_of  = "van";
// END NEW STUFF
$log_file_actions[1]        	= "AANMELDEN";
$log_file_actions[10]        	= "BESTAND ONTGRENDELD";
$log_file_actions[11]        	= "BESTAND GEMAILD";
$log_file_actions[12]        	= "BESTAND VERPLAATST";
$log_file_actions[13]        	= "MAP GEMAAKT";
$log_file_actions[14]        	= "<I>MAP VERWIJDERD</I>";
$log_file_actions[15]        	= "MAP AANGEPAST";
$log_file_actions[16]        	= "<I>MAP VERPLAATST</I>";
$log_file_actions[17]        	= "<font color=red>WACHTWOORD VERGETEN</font>";
$log_file_actions[18]        	= "<font color=orange>GEBRUIKER GEREGISTREERD</font>";
$log_file_actions[19]           = "BESTAND BEKEKEN";
$log_file_actions[2]        	= "<font color=red>AANMELDEN MISLUKT</font>";
$log_file_actions[20]           = "<font color=red>BESTAND VIRUS</font>";
$log_file_actions[21]           = "BESTAND GEKOPIEERD";
$log_file_actions[22]           = "MAP GEKOPIEERD";
$log_file_actions[23]           = "BESTAND GEKOPPELD";
$log_file_actions[3]        	= "AFMELDEN";
$log_file_actions[4]        	= "BESTAND VERWIJDERD";
$log_file_actions[5]        	= "BESTAND TOEGEVOEGD";
$log_file_actions[6]        	= "BESTAND BIJGEWERKT";
$log_file_actions[7]        	= "BESTAND GEDOWNLOAD";
$log_file_actions[8]        	= "BESTAND GEWIJZIGD";
$log_file_actions[9]        	= "BESTAND VERGRENDELD";
// BEGIN NEW STUFF
$log_file_actions[24]           = "<font color=orange>GEBRUIKERS BEHEER</font>";
$log_file_actions[25]           = "PRULLENBAK";
$log_file_actions[26]           = "<B>BESTAND PERMISSIES</B>";
$log_file_actions[27]           = "<B>MAP PERMISSIES</B>";
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
$owl_lang->admin_login_date  = "Beheerder aangemeld op: ";
$owl_lang->admin_login_from  = "Beheerder aangemeld vanaf";
$owl_lang->admin_login_subject  = "AANMELDEN BEHEERDER";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Anonieme toegang)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Wachtwoord vergeten?";
$owl_lang->like_register	= "Registreren als nieuwe gebruiker";
$owl_lang->login		= "Aanmelden";
$owl_lang->logindisabled	= "Gebruiker VERGRENDELD; neem contact op met de systeembeheerder";
$owl_lang->loginfail		= "Fout bij aanmelden";
$owl_lang->password		= "Wachtwoord";
$owl_lang->repository_list      = "Bestandslijst";
$owl_lang->successlogout 	= "U bent afgemeld";
$owl_lang->toomanysessions	= "Maximum aantal sessies voor deze gebruiker is bereikt; neem contact op met de systeembeheerder";
$owl_lang->username		= "Gebruikersnaam";
$owl_lang->forgot_username	= "Ggebruikersnaam of e-mail adres";
$owl_lang->version 		= "Versie";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Acties";
$owl_lang->current_db         		= "Huidig bestandsarchief:";
$owl_lang->current_folder 		= "Huidige map:";
$owl_lang->del_all			= "Alles verwijderen";
$owl_lang->del_selected			= "Geselecteerde verwijderen";
$owl_lang->disk_quota			= "Disk Quotum";
$owl_lang->doc_number 			= "Doc #";
$owl_lang->email_selected		= "E-mail geselecteerde";
$owl_lang->file 			= "Bestand";
$owl_lang->folder_count_file		= "Bestand(en)";
$owl_lang->folder_count_folder		= "Map(pen)";
$owl_lang->folder_count_note		= "Notitie(s)";
$owl_lang->folder_count_pre		= "Deze map bevat";
$owl_lang->folder_count_url		= "hyperlinks";
$owl_lang->folder_policy 		= "Beleid van deze map:";
$owl_lang->held                      	= "Vergrendeld"; 
$owl_lang->last_logged			= "Laatste keer: ";
$owl_lang->menu_file_action		= "Beschikbare bestands-acties";
$owl_lang->menu_folder_action		= "Beschikbare map-acties";
$owl_lang->menu_url_action		= "Beschikbare hyperlink-acties";
$owl_lang->modified 			= "Gewijzigd";
$owl_lang->move_selected		= "Verplaats selectie";
$owl_lang->new_file			= "Nieuw!";
$owl_lang->no_description		= "Geen beschrijving beschikbaar";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Pagina:";
$owl_lang->panel_file_info		= "Bestand informatie";
$owl_lang->postedby 			= "Geplaatst door";
$owl_lang->reallydelete			= "Echt verwijderen";
$owl_lang->reallydelete_logs		= "Logbestand echt opschonen";
$owl_lang->reallydelete_selected	= "Geselecteerde bestanden echt verwijderen";
$owl_lang->reallyrestore_selected	= "Alle geselecteerde bestanden echt herstellen";
$owl_lang->rest_selected		= "Selectie herstellen";
$owl_lang->score 			= "Score";
$owl_lang->size 			= "Omvang";
$owl_lang->updated_by 			= "Bijgewerkt door";
$owl_lang->title 			= "Titel";
$owl_lang->tot_files			= "Totaal:";
$owl_lang->tot_monitored		= "Gemonitord:";
$owl_lang->tot_my_checked_out		= "Vergrendeld:";
$owl_lang->tot_my_files			= "Mijn bestanden:";
$owl_lang->tot_my_group			= "Mijn groep:";
$owl_lang->tot_new_files		= "Nieuw:";
$owl_lang->tot_updated_files		= "Bijgewerkt:";
$owl_lang->updated_file			= "Bijgewerkt!";
$owl_lang->user               		= "Gebruiker";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Aantal dagen :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favorieten";
$owl_lang->favorite_add = "Huidige toevoegen";
$owl_lang->favorite_delete = "Verwijderen";
$owl_lang->favorite_go = "Ga naar";
$owl_lang->files_in_my_group_title = "Bestanden in mijn groep(en)";
$owl_lang->my_files_title= "Mijn bestanden";
$owl_lang->my_monitored_title= "Door mij gemonitorde bestand(en)/map(pen)";
$owl_lang->my_special_access_title= "Speciale toegang";
$owl_lang->special_access_count_alt= "Bestand(en)/map(pen) met speciale toegang";
$owl_lang->special_access_count= "Speciale toegang:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Opmerking bekijken/toevoegen: ";
$owl_lang->addingfile 		= "Voegt bestand toe aan ";
$owl_lang->addingfolder 	= "Voegt map toe aan ";
$owl_lang->attach_file		= "Bestand bijvoegen:";
$owl_lang->change		= "Wijzigen";
$owl_lang->comments      	= "Opmerkingen";
$owl_lang->comments_added       = "Opmerking toegevoegd door: ";
$owl_lang->create		= "Maken";
$owl_lang->description 		= "Beschrijving";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lied:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Duur:<br />Genre:<br />Opmerkingen:";
$owl_lang->email_body		= "Bericht";
$owl_lang->email_cc          	= "Kopie";
$owl_lang->email_reply_to	= "Antwoord naar";
$owl_lang->email_subject	= "Onderwerp";
$owl_lang->email_to		= "E-mail aan";
$owl_lang->emailing		= "Mailing";
$owl_lang->keywords 		= "Steekwoorden";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "Hyperlink";
$owl_lang->modifying		= "Bewerken ";
$owl_lang->name               	= "Naam"; 
$owl_lang->none_selected        = "GEEN GESELECTEERD";
$owl_lang->note_content         = "Notitie inhoud";
$owl_lang->notify_link          = "Owl Externe Link";
$owl_lang->ownergroup         	= "Eigenaar (Groep)";
$owl_lang->ownership		= "Eigendom";
$owl_lang->permissions 		= "Permissies";
$owl_lang->pick_select		= "&#8211; Selecteer een Gebruiker &#8211;";
$owl_lang->policy 		= "Beleid";
$owl_lang->post_comment		= "Plaats opmerking";
$owl_lang->prop_permissions 	= "Permissies doorgeven aan submappen?";
$owl_lang->prop_perms_files 	= "Permissies om door te geven aan bestanden";
$owl_lang->sendfile 		= "Stuur bestand";
$owl_lang->sendthisfile 	= "Stuur dit bestand";
$owl_lang->sendthisurl       	= "Stuur deze hyperlink";
$owl_lang->updating		= "Bijwerken";
$owl_lang->verdescription 	= "Beschrijving<br />van wijzigingen";
$owl_lang->vermajor          	= "Ggrote wijziging";
$owl_lang->verminor          	= "Kleine wijziging";
$owl_lang->vertype           	= "Wijziging";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Steekwoord(en) opslaan?";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "E-mail adres:";
$owl_lang->full_name		= "Volledige naam";
$owl_lang->register		= "Gebruikers registratie";
$owl_lang->self_failed		= "Mislukt";
$owl_lang->self_passwd		= "Wachtwoord verstuurd naar:";
$owl_lang->self_reg_bod		= "Uw wachtwoord is:";
$owl_lang->self_reg_rset	= "Uw wachtwoord is opnieuw ingesteld op:";
$owl_lang->self_reg_subj	= "Uw Owl account";
$owl_lang->send_pass		= "Verstuur wachtwoord";
$owl_lang->submit		= "Registreer";
$owl_lang->thank_you_1		= "Dank U!";
$owl_lang->thank_you_2		= "Uw wachtwoord wordt naar uw e-mail adres verstuurd";
$owl_lang->thank_you_3		= "Uw toegang moet worden goedgekeurd door de beheerder voordat u kunt inloggen.";

//NEW STUFF

$owl_lang->captcha_typein        = "Typ de 5 tekens";
$owl_lang->change_pass_title	      = "WIJZIG WACHTWOORD";
$owl_lang->err_cant_reuse_passwords   = "U kunt eerder gebruikte wachtwoorden niet opnieuw gebruiken";
$owl_lang->err_new_confirm_different  = "Nieuw Wachtwoord en Bevestig Wachtwoord zijn niet hetzelfde <br />";
$owl_lang->err_old_pass_ver_failed    = "Uw oude wachtwoord in onjuis <br />";
$owl_lang->err_pass_restriction_1     = "Uw wachtwoord moet ten minste &ldquo;%s&rdquo; tekens lang zijn <br />";
$owl_lang->err_pass_restriction_2     = "moet ten minste &ldquo;%s&rdquo; numerieke [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "en ten minste &ldquo;%s&rdquo; speciale tekens [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ] bevatten.<br />";
$owl_lang->err_username_not_long_enough = "De door u gekozen gebruikersnaam &ldquo;%s&rdquo; is %d tekens lang, en moet ten minste %d tekens lang zijn.";
$owl_lang->pass_change_email_1        = "Uw wachtwoord is niet opnieuw ingesteld, omdat u geen gebruik maakt van Owl-wachtwoordcontrole";
$owl_lang->pass_change_email_2        = "Uw wachtwoordcontrole type is: ";
$owl_lang->pass_change_email_3        = "Neem contact op met uw systeembeheerder voor hulp";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Annuleren";
$owl_lang->copy_file		= "Bestand kopieren";
$owl_lang->copy_folder		= "Map kopieren";
$owl_lang->moving		= "Verplaatsen";
$owl_lang->moving_file		= "Bestand verplaatsen";
$owl_lang->moving_folder	= "Map verplaatsen";
$owl_lang->select		= "Selecteer een nieuwe map aub:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Bekijk log voor ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Diff van";
$owl_lang->diff_to	= "Diff naar";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Kennisgeving van opmerkingen:";
$owl_lang->confpassword	= "Bevestig nieuwe wachtwoord";
$owl_lang->email_tool	= "E-mail functie:";
$owl_lang->group	= "Primaire groep";
$owl_lang->groupmember	= "Lidmaatschap<br /> (=Membership)<br /> groep(en)";
$owl_lang->last_modified= "Laatst gewijzigd";
$owl_lang->newpassword	= "Nieuw wachtwoord";
$owl_lang->newsadmin	= "Beheerder nieuwsberichten";
$owl_lang->not_member	= "U bent geen lid van enige groep";
$owl_lang->notification	= "Ontvang kennisgevingen:";
$owl_lang->oldpassword	= "Oude wachtwoord";
$owl_lang->preference	= "Voorkeuren";
$owl_lang->saved	= "&#8212; W IJ Z I G I N G E N&nbsp;&nbsp;&nbsp;O P G E S L A G E N &#8212;";
$owl_lang->status_no	= "Nee";
$owl_lang->status_yes	= "Ja";
$owl_lang->userlang	= "Taal";

//NEW STUFF
$owl_lang->useradmin	= "Gebruikers beheerder";
$owl_lang->viewlogs     = "Kan systeem logboeken zien";
$owl_lang->viewreports  = "Kan systeem rapporten zien";
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

$owl_lang->elapsed_time       	= "verstreken tijd";
$owl_lang->query_empty       	= "Leeg zoekveld";
$owl_lang->related_query_empty  = "Geen aanvullende gegevens bij bestand bekend om verwante bestanden op te zoeken";
$owl_lang->search             	= "Zoek";
$owl_lang->search_all_word	= "Alle woorden";
$owl_lang->search_any_word	= "Een van de woorden";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Zoek in deze map";
$owl_lang->search_entire_phrase	= "Hele zin";
$owl_lang->search_for_files 	= "Zoekt naar bestanden";
$owl_lang->search_for_folders 	= "Zoekt naar mappen";
$owl_lang->search_match 	= "Overeenkomst:";
$owl_lang->search_results_for	= "Zoekresultaten voor";
$owl_lang->search_score 	= "Score bestanden";
$owl_lang->search_winthindocs   = "Zoek in";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "bekijken ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Geef breed bestand-informatie paneel weer";
$owl_lang->allow_track_favorite         = "Sta gebruikers toe favorieten bij te houden";
$owl_lang->admin_login_to_browse_page	= "Beheerder gaat naar bestanden na aanmelden";
$owl_lang->alt_btn_backup		= "Backup SQL Database";
$owl_lang->alt_btn_doctype_admin	= "Document Type Beheerder";
$owl_lang->alt_btn_html_prefs		= "Edit Site HTML Voorkeuren";
$owl_lang->alt_btn_log_viewer		= "Owl System Log Viewer";
$owl_lang->alt_btn_news_admin		= "Owl Nieuwsberichten Beheerder";
$owl_lang->alt_btn_site_features	= "Beheer instellingen van de site";
$owl_lang->alt_btn_statistics_viewer	= "Owl Statistics Viewer";
$owl_lang->alt_btn_users_groups		= "Beheer gebruikers en groepen";
$owl_lang->btn_backup			= "Backup<br />Database";
$owl_lang->btn_doctype_admin		= "Document<br />Types";
$owl_lang->btn_html_prefs		= "HTML<br />Voorkeuren";
$owl_lang->btn_log_viewer		= "Log<br />Viewer";
$owl_lang->btn_news_admin		= "Nieuws<br />Beheer";
$owl_lang->btn_site_features		= "Site<br />Instellingen";
$owl_lang->btn_statistics_viewer	= "Statistieken / <br />Rapportages";
$owl_lang->btn_users_groups		= "Gebruikers <br />&amp; Groepen";
$owl_lang->display_password_override	= "Display File/Folder Password Override";
$owl_lang->doc_id_num_digits		= "Doc# aantal cijfers weergeven";
$owl_lang->doc_id_prefix		= "Doc# weergave Prefix String"; 
$owl_lang->docicon_column		= "Doc Icon";
$owl_lang->download_folder_zip		= "Download mappen als ZIP (standaard is tar.gz)";
$owl_lang->save_keywords_to_db		= "Sta gebruikers toe steekwoorden op te slaan voor hergebruik";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Uitgangswaarde versienummer";
$owl_lang->verminor_initial          	= "Uitgangswaarde subversienummer";
$owl_lang->view_doc_in_new_window	= "Nieuw venster voor weergave van bestanden";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Gebruiker gegevens bewerken *****";
$owl_lang->edit_group  			= "***** Groep gegevens bewerken *****";
$owl_lang->enter_new_user               = "***** Nieuwe gebruiker toevoegen *****";
$owl_lang->enter_new_group              = "***** Nieuwe groep toevoegen *****";
$owl_lang->alt_btn_change_passwd        = "Verander uw oude wachtwoord";
$owl_lang->alt_btn_cln_history          = "Wis bestanden ouder dan (dagen): ";
$owl_lang->alt_btn_log_viewer           = "Owl Systeem Log Viewer";
$owl_lang->alt_btn_report_viewer        = "Owl Rapportage Viewer";
$owl_lang->btn_change_passwd            = "Wijzig wachtwoord";
$owl_lang->btn_cln_history              = "Oude bestanden <br />wissen";
$owl_lang->btn_log_viewer               = "Systeem <br />Logboeken";
$owl_lang->btn_report_viewer            = "Rapportages";
$owl_lang->confirm_cln_history          = "Weet u zeker dat u alle bestanden wilt wissen die ouder zijn dan (dagen): ";
$owl_lang->historical_purge             = "Oude bestanden verwijderd";

// END NEW STUFF
$owl_lang->add				= "Toevoegen";
$owl_lang->alt_btn_initial_load		= "Database instellen op basis van Documents-map";
$owl_lang->alt_btn_trashcan		= "Klik om inhoud te bekijken";
$owl_lang->anonymous_account		= "Anonieme Toegang Account:";
$owl_lang->btn_initial_load		= "Database <br />opzetten";
$owl_lang->btn_trashcan			= "Prullenbak";
$owl_lang->buttonstyle                  = "Opmaakstijl";
$owl_lang->confirm_initial_load		= "*** WAARSCHUWING ***  Deze actie moet alleen eenmalig worden uitgevoerd als de database leeg is!";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Groep verwijderen";
$owl_lang->deleteuser			= "Gebruiker verwijderen";
$owl_lang->disable_recs_per_page	= "Enabling Restricted View Will DISABLE Records Per Page!";
$owl_lang->disableuser			= "Gebruiker blokkeren";
$owl_lang->file_admin_group		= "Bestanden Beheerders-groep:";
$owl_lang->flushed           		= "Sessietabel opgeschoond; gebruiker kan weer inloggen.";
$owl_lang->groups			= "Groepen";
$owl_lang->hide_bulk_buttons		= "Verberg de Bulk-knoppen:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Pad naar achtergrond-afbeelding:";
$owl_lang->ht_bd_lnk_cl			= "Link kleur:";
$owl_lang->ht_bd_txt_cl 		= "Tekst kleur:";
$owl_lang->ht_bd_vlnk_cl 		= "Bekeken link kleur:";
$owl_lang->ht_collapse_width 		= "Breedte beperkte weergave:";
$owl_lang->ht_expand_width		= "Breedte uitgebreide weergave:";
$owl_lang->ht_tbl_border_sz 		= "Tabelrand dikte:";
$owl_lang->ht_tbl_cell_bg_al 		= "Tabel cel achtergrond wisselkleur:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Tabel cel achtergrond kleur:";
$owl_lang->ht_tbl_hd_bg			= "Kop achtergrond:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Instelling anonieme toegang";
$owl_lang->header_group_admin           = "Groep beheer";
$owl_lang->header_sitefeatures_settings           = "Mogelijkheden en instellingen van de site";
$owl_lang->header_user_admin           	= "Gebruikers beheer";
$owl_lang->hide_folder_doc_count	= "Tellingen per map verbergen";
$owl_lang->hide_folder_size		= "Omvang van mapinhoud verbergen";
$owl_lang->hide_panel			= "Verbergen";
$owl_lang->home_dir			= "Gebruikers basis-map";
$owl_lang->initial_dir   		= "Gebruikers standaard-map";
$owl_lang->maxsessions			= "Max aantal sessies";
$owl_lang->noprefaccess			= "Voorkeuren vergrendelen";
$owl_lang->old_action_icons		= "Gebruik pre Owl 0.80 Action Icons";
$owl_lang->owl_anon_download     	= "Alleen downloaden";
$owl_lang->owl_anon_full		= "Volledige toegang";
$owl_lang->owl_anon_ro			= "Alleen bekijken";
$owl_lang->owl_dbdump_path   		= "DB Dump functie locatie:";
$owl_lang->owl_def_file_group_owner	= "Standaard bestand groep eigenaar:";
$owl_lang->owl_def_file_meta		= "Standaard bestand aanvullende gegevens:";
$owl_lang->owl_def_file_owner		= "Standaard bestand eigeneaar:";
$owl_lang->owl_def_file_perm 		= "Standaard bestand beleid:";
$owl_lang->owl_def_file_security	= "Standaard bestand permissies:";
$owl_lang->owl_def_file_title		= "Standaard bestand titel (leeg laten voor bestandsnaam):";
$owl_lang->owl_def_fold_group_owner	= "Standaard map groep eigenaar:";
$owl_lang->owl_def_fold_owner		= "Standaard map eigenaar:";
$owl_lang->owl_def_fold_sec		= "Standaard map permissies:";
$owl_lang->owl_def_folder_perm 		= "Standaard map beleid:";
$owl_lang->owl_default_tmpdir		= "Locatie van map voor tijdelijke bestanden: ";
$owl_lang->owl_email_from		= "Afzender adres:";
$owl_lang->owl_email_fromname		= "Afzender naam:";
$owl_lang->owl_email_replyto		= "Antwoord adres:";
$owl_lang->owl_email_server		= "SMTP Server:";
$owl_lang->owl_email_smtp		= "Gebruik SMTP mailing methode";
$owl_lang->owl_email_smtp_auth		= "Gebruik SMTP wachtwoordcontrole";
$owl_lang->owl_email_smtp_auth_login	= "SMTP controle aanmelden:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP controle wachtwoord";
$owl_lang->owl_email_subject_pref	= "Standaard onderwerp:";
$owl_lang->owl_fogotpass		= "Toon &ldquo;wachtwoord vergeten&rdquo; link:";
$owl_lang->owl_group_user		= "Gebruikers die lid zijn van deze groep";
$owl_lang->owl_gzip_path     		= "gzip pad:";
$owl_lang->owl_hidebackup		= "Verberg de Backup-map:";
$owl_lang->owl_log_file			= "Log bestands-acties:";
$owl_lang->owl_log_login_act		= "Log Aanmelden/Afmelden-acties:";
$owl_lang->owl_log_rec_page		= "Log Viewer Records per pagina:";
$owl_lang->owl_logging			= "Logboek bijhouden:";
$owl_lang->owl_logo			= "Aanmeld-Pagina logo ([Taal]/graphics):";
$owl_lang->owl_lookAtHD			= "Niet automatisch mapinhoud controleren:";
$owl_lang->owl_lookAtHDDel		= "Haal verwijderde bestanden uit database";
$owl_lang->owl_max_filesize		= "Maximum Upload File Size (in bytes)";
$owl_lang->owl_owl_expand		= "Standaard uitgebreide weergave";
$owl_lang->owl_owl_timeout		= "Sessie verloopt na seconden";
$owl_lang->owl_pdftotext_path		= "Maintain Search Index for <br />PDF and text Files <br />&#8211; Blank for Disabled:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 or Greater required<br />Path to pod2html:";
$owl_lang->owl_restrict_view		= "Bestanden &amp; mappen verbergen voor <br />gebruikers zonder permissies:";
$owl_lang->owl_self_reg			= "Zelf-registratie toestaan:";
$owl_lang->owl_self_reg_hd		= "UITGANGSWAARDEN BIJ ZELFREGISTRATIE";
$owl_lang->owl_tar_path     		= "tar Path:";
$owl_lang->owl_title_browser		= "OWL BROWSER INSTELLINGEN";
$owl_lang->owl_title_custom		= "WEERGAVE BROWSER COLOMMEN INSTELLEN";
$owl_lang->owl_title_custom_search      = "WEERGAVE ZOEKRESULTATEN INSTELLEN";
$owl_lang->owl_title_defaults   	= "STANDAARD INSTELLINGEN";
$owl_lang->owl_title_email		= "OWL SYSTEEM E-MAIL INSTELLINGEN";
$owl_lang->owl_title_HD			= "INSTELLINGEN VOOR AUTOMATISCH OPZOEKEN VAN NIEUWE BESTANDEN";
$owl_lang->owl_title_logging  		= "LOGBOEK INSTELLINGEN";
$owl_lang->owl_title_other		= "OVERIGE INSTELLINGEN";
$owl_lang->owl_title_tools   		= "DB BACKUP/GZIP FUNCTIES";
$owl_lang->owl_unzip_path     		= "unzip Path:";
$owl_lang->owl_version_control		= "Versiebeheer gebruiken:";
$owl_lang->owl_wordtotext_path          = "MS-WORD Files <br />&#8211; Blank for Disabled:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPOINT Files <br />&#8211; Blank for Disabled:";
$owl_lang->quota			= "Quotum (bytes) 0=onbeperkt";
$owl_lang->reallydeluser		= "Deze gebruiker is eigenaar van %numfiles% bestand(en) en %numfolders% map(pen). Deze bestanden en mappen blijven staan zonder eigenaar. Desondanks doorgaan met verwijderen?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Toon Records per pagina (0 = onbeperkt):";
$owl_lang->recycle_enabled		= "Verwijderde bestanden bewaren in Prullenbak:";
$owl_lang->recycle_location		= "Locatie van Prullenbak:";
$owl_lang->recycle_title		= "PRULLENBAK INSTELLINGEN";
$owl_lang->remember_me			= "Maak &ldquo;Blijf aangemeld&rdquo; functie mogelijk";
$owl_lang->remember_me_checkbox		= "Blijf aangemeld";
$owl_lang->remember_me_title		= "INSTELLINGEN VOOR DOORLOPEND AANGEMELD BLIJVEN";
$owl_lang->remember_timeout		= "Verlooptijd (dagen) van &ldquo;Blijf aangemeld&rdquo;-cookie";
$owl_lang->restore_file_prefix		= "Herstelde-Doc# weergave Prefix String";
$owl_lang->search_result_folders	= "Mappen weergeven bij zoekresultaten";
$owl_lang->show_action_title		= "Actie-knoppen weergeven:";
$owl_lang->show_bulk_title		= "Bulk-knoppen weergeven:";
$owl_lang->show_folder_title		= "Map-functies weergeven:";
$owl_lang->show_panel			= "Weergeven";
$owl_lang->show_panel_title		= "Status informatie weergeven:";
$owl_lang->show_pref_title		= "Voorkeuren/afmelden-balk weergeven:";
$owl_lang->show_search_title		= "Zoek-balk weergeven:";
$owl_lang->status_bar_both              = "Boven en onder";
$owl_lang->status_bar_bottom            = "Alleen onder";
$owl_lang->status_bar_location          = "Toon de status-balk:";
$owl_lang->status_bar_not               = "Niet weergeven";
$owl_lang->status_bar_top               = "Alleen boven";
$owl_lang->use_popup			= "Nieuwsberichten in nieuw venster weergeven:";
$owl_lang->users           		= "Gebruikers";
$owl_lang->virus_path			= "Virus Checking Software Path<br />Example: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Blank for Disabled:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Aangepaste velden in popup beschrijving";
$owl_lang->cust_headpopup     		= "SPECIFIEKE BESTAND VELDEN";
$owl_lang->auth_http                    = "HTTP wachtwoordcontrole (.htaccess)";
$owl_lang->auth_ldap                    = "LDAP wachtwoordcontrole";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Gebruikers die deze groep als PRIMAIRE groep hebben";
$owl_lang->create_user_homedir 		= "Maak basis-map aan voor gebruiker:";
$owl_lang->use_captcha 			= "Gebruik CAPTCHA:";
$owl_lang->created_here 		= "<br /> (HIER AANMAKEN als voor gebruiker<br /> nieuwe basis-map wordt gemaakt)";
$owl_lang->auth_owl                     = "Owl wachtwoordcontrole";
$owl_lang->auth_pop3                    = "POP3 wachtwoordcontrole";
$owl_lang->file_desc_required           = "Bestandsbeschrijving verplicht";
$owl_lang->folder_desc_required         = "Mapbeschrijving verplicht";
$owl_lang->html_title			= "HTML Voorkeuren";
$owl_lang->pass_account_lockout         = "Aantal inlogpogingen voor vergrendelen:";
$owl_lang->pass_change_every            = "Maximale levensduur van wachtwoord (in dagen) 0=onbeperkt:";
$owl_lang->pass_enable_account_lockout  = "Account-vergrendeling gebruiken:";
$owl_lang->pass_min_passwd_length       = "Minimale lengte van door gebruiker ingesteld wachtwoord:";
$owl_lang->pass_min_passwd_numeric      = "Minimaal aantal numerieke tekens [0-9]:";
$owl_lang->pass_min_passwd_special      = "Minimaal aantal speciale tekens:";
$owl_lang->pass_min_username_length     = "Minimale lengte van door gebruiker ingestelde gebruikersnaam:";
$owl_lang->pass_track_old_passwords     = "Aantal oude wachtwoorden onthouden:";
$owl_lang->rtftotext_path                = "RTF naar Tekst functie locatie";
$owl_lang->show_user_info           = "Weergegeven gebruikersnamen zijn klikbaar";
$owl_lang->user_admin              = "Gebruiker/Groep Beheerder";
$owl_lang->user_auth_type                   = "Wachtwoordcontrole Type:";
$owl_lang->user_change_pass_next_login      = "Wijzig Wachtwoord bij volgende keer aanmelden:";
$owl_lang->user_expires                     = "Account verloopt op:";
$owl_lang->user_gmt_offset              = "Gebruikers tijdzone (t.o.v. GMT):";
$owl_lang->user_group_admin                 = "Bestaandsbeheerder voor Primaire Groep:";
$owl_lang->user_login_to_newrecords         = "Naar nieuwe-bestanden pagina na aanmelden:";
$owl_lang->users_group_admin		= "Gebruikers die Gebruiker/Groep-beheerder zijn";
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
$owl_lang->time_offsets[10][1] = "(GMT-3:00) Brazilie, Buenos Aires, Georgetown";
$owl_lang->time_offsets[11][0] = "-2";
$owl_lang->time_offsets[11][1] = "(GMT-2:00) Mid-Atlantisch";
$owl_lang->time_offsets[12][0] = "-1";
$owl_lang->time_offsets[12][1] = "(GMT-1:00) Azoren, Kaapverdische eilanden";
$owl_lang->time_offsets[13][0] = "0";
$owl_lang->time_offsets[13][1] = "(GMT) West-Europese Tijd, Londen, Lissabon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0] = "1";
$owl_lang->time_offsets[14][1] = "(GMT+1:00) Centraal-Europese Tijd, Amsterdam, Brussel, Kopenhagen, Madrid, Parijs";
$owl_lang->time_offsets[15][0] = "2";
$owl_lang->time_offsets[15][1] = "(GMT+2:00) Oost-Europese Tijd, Kaliningrad, Zuid-Afrika";
$owl_lang->time_offsets[16][0] = "3";
$owl_lang->time_offsets[16][1] = "(GMT+3:00) Bagdad, Koeweit, Riyadh, Moskou, St.Petersburg, Volgograd, Nairobi";
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
$owl_lang->time_offsets[24][1] = "(GMT+8:00) Peking, Perth, Singapore, Hong Kong, Chongqing, Urumqi, Taipei";
$owl_lang->time_offsets[25][0] = "9";
$owl_lang->time_offsets[25][1] = "(GMT+9:00) Tokio, Seoul, Osaka, Sapporo, Yakutsk";
$owl_lang->time_offsets[26][0] = "9.5";
$owl_lang->time_offsets[26][1] = "(GMT+9:30) Adelaide, Darwin";
$owl_lang->time_offsets[27][0] = "10";
$owl_lang->time_offsets[27][1] = "(GMT+10:00) Oost-Australische Standard Tijd, Guam, Papua Nieuw-Guinea, Wladiwostok";
$owl_lang->time_offsets[28][0] = "11";
$owl_lang->time_offsets[28][1] = "(GMT+11:00) Magadan, Salomon-eilanden, Nieuw-Caledonia";
$owl_lang->time_offsets[29][0] = "12";
$owl_lang->time_offsets[29][1] = "(GMT+12:00) Auckland, Wellington, Fiji, Kamchatka, Marshall eiland";

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter	= "Filter";
$owl_lang->owl_log_hd_action	= "Actie";
$owl_lang->owl_log_hd_agent	= "Programma";
$owl_lang->owl_log_hd_dt_tm	= "Datum Tijd";
$owl_lang->owl_log_hd_dtls	= "Details";
$owl_lang->owl_log_hd_file	= "Bestand";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Map pad";
$owl_lang->owl_log_hd_ip	= "IP / Adres";
$owl_lang->owl_log_hd_user	= "Gebruiker";
$owl_lang->owl_log_hide      	= "Verberg ";
$owl_lang->owl_log_no_rec	= " GEEN RECORDS GEVONDEN ";
$owl_lang->owl_log_viewer	= "LOG Viewer";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Prullenbak legen";
$owl_lang->really_empty_trash	= "Prullenbak echt legen?";
$owl_lang->recycle_bin_admin    = "Prullenbak Beheer";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "De door U gevraagde bestanden zijn bijgevoegd.";
$owl_lang->trash_email_subject  = "DOOR U GEVRAAGDE HERSTELDE BESTANDEN";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Niets doen &#8211; Bestands-permissies zo laten";
$owl_lang->everyoneread			= "Iedereen kan lezen/downloaden";
$owl_lang->everyoneread_ad		= "Iedereen kan lezen/downloaden";
$owl_lang->everyonewrite		= "Iedereen kan lezen/plaatsen/downloaden";
$owl_lang->everyonewrite_ad		= "Iedereen kan lezen/plaatsen/downloaden";
$owl_lang->everyonewrite_ad_nod		= "Iedereen kan lezen/plaatsen/downloaden, NIET VEWIJDEREN";
$owl_lang->everyonewrite_nod		= "Iedereen kan lezen/plaatsen/downloaden, NIET VEWIJDEREN";
$owl_lang->file_size_byte		= "Byte";
$owl_lang->file_size_gigabyte		= "GB";
$owl_lang->file_size_kilobyte		= "kB";
$owl_lang->file_size_megabyte		= "MB";
$owl_lang->geveryoneread		= "Iedereen kan deze map inzien";
$owl_lang->geveryoneread_ad		= "Iedereen kan deze map inzien";
$owl_lang->geveryonewrite		= "Iedereen kan bestanden plaatsen en verwijderen";
$owl_lang->geveryonewrite_ad		= "Iedereen kan bestanden plaatsen en verwijderen";
$owl_lang->geveryonewrite_ad_nod	= "Iedereen kan bestanden plaatsen";
$owl_lang->geveryonewrite_nod		= "Iedereen kan bestanden plaatsen";
$owl_lang->ggroupread			= "Uw groep kan deze map inzien";
$owl_lang->ggroupread_ad		= "De geselecteerde groep kan deze map inzien";
$owl_lang->ggroupwrite			= "Uw groep kan bestanden plaatsen en verwijderen";
$owl_lang->ggroupwrite_ad    		= "De geselecteerde groep kan bestanden plaatsen en verwijderen";
$owl_lang->ggroupwrite_ad_nod		= "De geselecteerde groep kan bestanden plaatsen";
$owl_lang->ggroupwrite_nod		= "Uw groep kan bestanden plaatsen";
$owl_lang->ggroupwrite_worldread 	= "Uw groep kan bestanden plaatsen en verwijderen, iedereen kan deze map inzien";
$owl_lang->ggroupwrite_worldread_ad 	= "De geselecteerde groep kan bestanden plaatsen en verwijderen, iedereen kan deze map inzien";
$owl_lang->ggroupwrite_worldread_ad_nod	= "De geselecteerde groep kan bestanden plaatsen (niet verwijderen), iedereen kan deze map inzien";
$owl_lang->ggroupwrite_worldread_nod 	= "Uw groep kan bestanden plaatsen (niet verwijderen), iedereen kan deze map inzien";
$owl_lang->gonlyyou			= "U alleen kunt bestanden plaatsen en verwijderen";
$owl_lang->gonlyyou_ad			= "U alleen kunt bestanden plaatsen en verwijderen";
$owl_lang->groupread			= "Uw groep kan inzien en downloaden";
$owl_lang->groupread_ad			= "De geselecteerde groep kan inzien/downloaden";
$owl_lang->groupwrite			= "Uw groep kan inzien/plaatsen/downloaden";
$owl_lang->groupwrite_ad		= "De geselecteerde groep kan inzien/plaatsen/downloaden";
$owl_lang->groupwrite_ad_nod		= "De geselecteerde groep kan inzien/plaatsen/downloaden, NIET VERWIJDEREN";
$owl_lang->groupwrite_nod		= "Uw groep kan inzien/plaatsen/downloaden, NIET VERWIJDEREN";
$owl_lang->groupwrite_worldread 	= "Uw groep kan inzien/plaatsen/downloaden, iedereen kan inzien";
$owl_lang->groupwrite_worldread_ad 	= "De geselecteerde groep kan inzien/plaatsen/downloaden, iedereen kan inzien";
$owl_lang->groupwrite_worldread_ad_nod 	= "De geselecteerde groep kan inzien/plaatsen/downloaden (niet verwijderen), iedereen kan inzien";
$owl_lang->groupwrite_worldread_nod 	= "Uw groep kan inzien/plaatsen/downloaden (niet verwijderen), iedereen kan inzien";
$owl_lang->invalidsess			= "Ongeldige sessie-informatie; log opnieuw in vanaf de hoofdpagina a.u.b.<br />";
$owl_lang->notif_comment_1		= "Opmerking op";
$owl_lang->notif_comment_2		= "Opmerking:";
$owl_lang->notif_msg         		= "DIT IS EEN AUTOMATISCH VERSTUURD BERICHT<br /> <br />In de bijlage vindt u een nieuw/bijgewerkt bestand.<br /> <br />";
$owl_lang->notif_msg_alt         	= "DIT IS EEN AUTOMATISCH VERSTUURD BERICHT\n\nIn de bijlage vindt u een nieuw/bijgewerkt bestand.\n\n";
$owl_lang->notif_msg_alt_link           = "DIT IS EEN AUTOMATISCH VERSTUURD BERICHT\n\nHier vindt u een link naar een nieuw/bijgewerkt bestand.\n\n";
$owl_lang->notif_msg_link               = "DIT IS EEN AUTOMATISCH VERSTUURD BERICHT<br /> <br />Hier vindt u een link naar een nieuw/bijgewerkt bestand.<br /> <br />";
$owl_lang->notif_salutation		= "Geachte ";
$owl_lang->notif_subject_comment	= "Opmerking toegevoegd bij bestand";
$owl_lang->notif_subject_monitor	= "Een bestand of map die u MONITORT is bijgewerkt";
$owl_lang->notif_subject_new 		= "Nieuw bestand";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "Bestand is bijgewerkt";
$owl_lang->notif_subject_file_deleted   = "Bestand verwijderd";
$owl_lang->notif_subj_new_account       = "ER IS EEN NIEUW ACCOUNT AANGEMAAKT VOOR U";
$owl_lang->notif_user			= "Geplaatst/bijgewerkt door:";
$owl_lang->onlyyou			= "U alleen kunt inzien/downloaden/wijzigen";
$owl_lang->onlyyou_ad			= "U alleen kunt inzien/downloaden/wijzigen";
$owl_lang->orphaned			= "&#8211; GEEN eigenaar  &#8211;";
$owl_lang->owl_path			= "Bestandslocatie: ";
$owl_lang->sessinuse			= "Toegang geweigerd; deze sessie is in gebruik vanaf een anderen computer<br />";
$owl_lang->sesstimeout			= "Uw sessie is verlopen; Log opnieuw in a.u.b.<br />";
$owl_lang->virus_infected 		= "BESTAND MET VIRUS-INFECTIE";
$owl_lang->virus_return_val		= "Uitkomst virus-programma:";
$owl_lang->watermark_string		= "Vertrouwelijk";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Bekijk deze map";
$owl_lang->title_browse_site     	= "Surf naar deze hyperlink";
$owl_lang->title_download_view     	= "Bestand downloaden/inzien";
$owl_lang->title_edit_prefs     	= "Gebruikers-voorkeuren bewerken";
$owl_lang->title_return_folder     	= "Ga terug naar";
$owl_lang->title_sort     		= "Sorteer op";
$owl_lang->title_view_my     		= "Maak een lijst van mijn bestanden";
$owl_lang->title_view_new     		= "Maak een lijst van nieuwe bestanden sinds mijn vorige bezoek";
$owl_lang->title_view_updated     	= "Maak een lijst van nieuwe of bijgewerkte bestanden sinds mijn laatste bezoek";
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

$owl_lang->news_content			= "Inhoud";
$owl_lang->news_hd			= "Nieuwsbericht";
$owl_lang->news_hd_audience		= "Gericht aan";
$owl_lang->news_hd_created		= "Opgesteld op";
$owl_lang->news_hd_expires		= "Verloopt op";
$owl_lang->news_heading			= "Kop nieuwsbericht";
$owl_lang->news_posted_date		= "Geplaatst op:";
$owl_lang->news_read			= "Lezen";
$owl_lang->news_title			= "Nieuwsberichten Beheer";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: De OWL Bestandsmap: " .$default->owl_fs_root . "/" . fid_to_name(1) ." bestaat niet.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: De OWL Bestandsmap: " .$default->owl_fs_root . "/" . fid_to_name(1) ." kan niet worden beschreven door de Web Server.";
$owl_lang->debug_file_not_exist		= "DEBUG: Het bestand &ldquo;$default->owl_fs_root/%s &rdquo; bestaat niet<br /> OF<br />De locatie \$default->owl_fs_root in config/owl.php is onjuist.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: De OWL tijdelijke map: %s bestaat niet.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: De OWL tijdelijke map: %s an niet worden beschreven door de Web Server.";
$owl_lang->debug_webserver_no_access	= "DEBUG: De webserver heeft geen toegang tot: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Herstel a.u.b. de permissies en probeer opnieuw.";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Statistieken / Rapportage Viewer";
$owl_lang->stats_files		= "Aantal bestanden per Gebruiker";
$owl_lang->stats_folders	= "Aantal mappen per Gebruiker";
$owl_lang->stats_information	= "Voor het bijhouden van statistieken is het gebruik van Logboeken noodzakelijk.";
$owl_lang->stats_top		= "Top 20 downloads";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Gebruikers aanmeldingen (Aanmelden / Fout / Afmelden)";
$owl_lang->stats_users_loggedin = "Op dit moment aangemeld";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************


$owl_lang->doc_administration	= "Document Type Beheer";
$owl_lang->doc_field_label	= "Veld Label (Per Locale)";
$owl_lang->doc_field_name	= "Veld Naam";
$owl_lang->doc_field_pos	= "Veld Pos";
$owl_lang->doc_field_required	= "Verplicht?";
$owl_lang->doc_field_searchable	= "Gebruiken voor zoekfunctie?";
$owl_lang->doc_field_size	= "Veld Grootte";
$owl_lang->doc_new_doc_type	= "&#8211; Nieuw Document Type TOEVOEGEN &#8211;";
$owl_lang->doc_specific		= "DOCUMENT-SPECIFIEKE VELDEN:";
$owl_lang->document_type	= "Document Type";
$owl_lang->document_type_name	= "Document Type Naam";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Tonen in popup-beschrijving?";
$owl_lang->doc_field_disp_label = "VELD LABEL:";
$owl_lang->doc_field_disp_sep = "SCHEIDINGSTEKEN LABEL";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;V&nbsp;O&nbsp;O&nbsp;R&nbsp;B&nbsp;E&nbsp;E&nbsp;L&nbsp;D&nbsp; &nbsp;W&nbsp;E&nbsp;E&nbsp;R&nbsp;G&nbsp;A&nbsp;V&nbsp;E&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Toon Browser:";
$owl_lang->doc_field_show_in_list = "Toon Veld in Browse Weergave:";
$owl_lang->doc_field_type	= "Veld Type:";
$owl_lang->doc_field_values	= "Veld Waarden (gescheiden door | ):";
$owl_lang->doc_fields = "Aangepaste velden";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Groep:";
$owl_lang->header_csv_import    = "Import CSV Gebruikers-gegevens-bestand";
$owl_lang->import_inserted      = "INGEVOEGD";
$owl_lang->import_skipped       = "OVERGESLAGEN";
$owl_lang->invalid_groupid      = "Ongeldige Groep-ID --> ";
$owl_lang->msg_user_exists      = "Gebruiker bestaat al";
$owl_lang->sendcsvfile          = "Verstuur komma-gescheiden-tekstbestand";
$owl_lang->user_created_skipped = "Gebruiker:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Onderlinge controle inschakelen:";
$owl_lang->owl_peer_review_opt  = "Onderlinge controle is niet verplicht:";
$owl_lang->owl_title_peer_review= "ONDERLINGE CONTROLE INSTELLINGEN";
$owl_lang->owl_title_peer_review2= "Onderlinge controle";
$owl_lang->peer_approval_title 	= "Bestand(en) die op mijn beoordeling wachten";
$owl_lang->peer_approved_body	= "Uw bestand is goedgekeurd:";
$owl_lang->peer_file_approved	= "Bestand Goedgekeurd:";
$owl_lang->peer_file_final	= "Definitieve Goedkeuring:";
$owl_lang->peer_file_rejected	= "Bestand Afgekeurd:";
$owl_lang->peer_file_to_review	= "Te Beoordelen Bestand:";
$owl_lang->peer_final_approval	= "[Definitieve Goedkeuring]: ";
$owl_lang->peer_final_body	= "Uw document is goedgekeurd door alle geselecteerde gebruikers.<br />Meld u aan a.u.b. om het bestand publiek toegankelijk te maken.<br />";
$owl_lang->peer_msg_to_reviewer	= "Bericht aan controleur:";
$owl_lang->peer_my_approval	= "Bestanden die op mijn <br /> beoordeling wachten";
$owl_lang->peer_notif_user	= "Geplaatst/bijgewerkt door";
$owl_lang->peer_pending_approval= "Mijn bestanden die op <br /> beoordeling wachten";
$owl_lang->peer_pending_title 	= "Mijn bestanden die op beoordeling wachten";
$owl_lang->peer_reject_reason   = "Reden van afkeuring";
$owl_lang->peer_rejected_body	= "Uw bestand is afgekeurd:";
$owl_lang->peer_review_body	= "Uw beoordeling is gevraagd voor het volgende bestand:";
$owl_lang->peer_reviewer_list	= "Controleur(s)";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_satus_approved  = "&#8212; G O E D G E K E U R D &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; W O R D T&nbsp; &nbsp;B E O O R D E E L D &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; A F G E K E U R D &#8212;";
$owl_lang->peer_subj_approved	= "Uw bestand is GOEDGEKEURD";
$owl_lang->peer_subj_rejected	= "Uw bestand is AFGEKEURD";
$owl_lang->peer_subj_reminder	= "HERINNERING: er is nog een bestand dat wacht op uw beoordelen";
$owl_lang->peer_subj_review	= "Er is een bestand dat u moet beoordelen";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Uw document is goedgekeurd door alle geselecteerde gebruikers.<br />Uw bestand is publiek toegankelijk gemaakt.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Bestands-permissies toevoegen:";
$owl_lang->acl_adding_folder           = "Map-permissies toevoegen:";
$owl_lang->acl_available_groups        = "Beschikbare Groep(en)";
$owl_lang->acl_available_users         = "Beschikbare Gebruiker(s)";
$owl_lang->acl_edit_file               = "Bestands-permissies wijzigen:";
$owl_lang->acl_edit_folder             = "Map-permissies wijzigen:";
$owl_lang->acl_file_checkin            = "Vergrendelen";
$owl_lang->acl_file_comment            = "Opmerkingen<br />plaatsen";
$owl_lang->acl_file_copy               = "Kopieren";
$owl_lang->acl_file_delete             = "Verwijderen";
$owl_lang->acl_file_email              = "E-mailen";
$owl_lang->acl_file_modify             = "Kenmerken<br />aanpassen";
$owl_lang->acl_file_monitor            = "Monitoren";
$owl_lang->acl_file_move               = "Verplaatsen";
$owl_lang->acl_file_read               = "Inzien";
$owl_lang->acl_file_search             = "Verwante items<br />zoeken";
$owl_lang->acl_file_set_acl            = "Permissies<br />instellen";
$owl_lang->acl_file_update             = "Bijwerken";
$owl_lang->acl_file_view_log           = "Logboek<br />inzien";
$owl_lang->acl_folder_copy             = "Kopieren";
$owl_lang->acl_folder_delete           = "Verwijderen";
$owl_lang->acl_folder_modify           = "Kenmerken<br />aanpassen";
$owl_lang->acl_folder_monitor          = "Monitoren";
$owl_lang->acl_folder_move             = "Verplaatsen";
$owl_lang->acl_folder_read             = "Inzien<br />(Downloaden/Bekijken)";
$owl_lang->acl_folder_set_acl          = "Permissies<br />instellen";
$owl_lang->acl_folder_write            = "Wijzigen<br />(Plaatsen)";
$owl_lang->acl_heading_file            = "Groep(en)/<br />Gebruiker(s)";
$owl_lang->acl_heading_files           = "BESTANDEN &#8211; SELECTEER GEWENSTE GEBRUIKER(S) en GROEP(EN)";
$owl_lang->acl_heading_folder          = "Groep(en)/<br />Gebruiker(s)";
$owl_lang->acl_heading_folders         = "MAPPEN &#8211; SELECTEER GEWENSTE GEBRUIKER(S) en GROEP(EN)";
$owl_lang->acl_propagate_file          = "Gebruik dit beleid<br/>voor ALLE Bestanden:";
$owl_lang->acl_propagate_folders       = "Doorvoeren op<br/>alle submappen:";
$owl_lang->acl_selected_groups         = "Geselecteerde groep(en)";
$owl_lang->acl_selected_users          = "Geselecteerde gebruiker(s)";
$owl_lang->acl_set_acl                 = "Stel permissies in";
$owl_lang->acl_set_acl_now             = "Stel direct permissies in:";
$owl_lang->acl_set_selected            = "Stel geselecteerde in";
$owl_lang->alt_acl_save_file           = "Bestands permissies beleid opslaan";
$owl_lang->alt_acl_save_folder         = "Mappen permissies beleid opslaan";
$owl_lang->btn_acl_save                = "Opslaan";
$owl_lang->acl_set_file_permissions    = "Stel bestands permissies in";
$owl_lang->acl_set_folder_permissions  = "Stel map permissies in";
$owl_lang->alt_set_folder_acl	       = "Stel permissies in voor deze map";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Beschikbare rapportages:";
$owl_lang->report_file_folder               = "Bestand/Map";
$owl_lang->report_filter                    = "Filter:";
$owl_lang->report_filter_since              = "Sinds:";
$owl_lang->report_full_access               = "VOLLEDIGE TOEGANG";
$owl_lang->report_select_report             = "&#8211; Selecteer een Rapportage &#8211;";
$owl_lang->report_users_disabled_title      = "Vergrendelde Gebruiker(s)";
$owl_lang->report_users_entitlement         = "Gebruikers toegangslijst";
$owl_lang->report_users_inactive_title      = "Gebruiker(s) inactief sinds";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Maak Voorbeeldweergave-functie beschikbaar:";
$owl_lang->thumb_gen_thumb_tool_path       = "ImageMagick conversie functie locatie:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Mplayer parameters:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Mplayer locatie:";
$owl_lang->thumb_image_info                = "Afbeelding Info";
$owl_lang->thumb_large_width               = "Voorbeeld Breedte (GROOT) Pixels:";
$owl_lang->thumb_med_width                 = "Voorbeeld Breedte (MIDDEL) Pixels:";
$owl_lang->thumb_number_colums             = "Aantal kolommen in Voorbeeldweergave:";
$owl_lang->thumb_re_generate               = "Maak voorbeeld";
$owl_lang->thumb_small_width               = "Voorbeeld Breedte (KLEIN) 0=Verbergen Pixels:";
$owl_lang->thumb_title                     = "VOORBEELDWEERGAVE OPTIES";
$owl_lang->thumb_title_thumb_view          = "VOORBEELDWEERGAVE DETAILS";
$owl_lang->thumb_image_size                = "Beeld grootte:";
$owl_lang->alt_thumb_small                 = "Klein voorbeeld";
$owl_lang->alt_no_thumb                    = "Geen voorbeeld beschikbaar";

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
