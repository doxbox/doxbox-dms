<?php

/*
 * File: Deutsch/language.inc
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Last modified by: Carlo Strub 2005/11/25 <cs@carlostrub.ch>
 *
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

// If config/owl.php   $default->generic_date_format is 
// set USE That one if not
// use the one in this file

if (isset($default->generic_date_format) && trim($default->generic_date_format) != "") {

        $owl_lang->localized_date_format = $default->generic_date_format;
} else {
        $owl_lang->localized_date_format = "d.m.Y \u\\m H:i \U\h\\r";
}


// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "de";

//********************************************************
// Date Formating END
//********************************************************

//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments          = "Sie haben keine Berechtigung um Kommentare hinzuzuf&uuml;gen.";
$owl_lang->err_backup_file    		= "Fehler beim Erzeugen der Sicherungsdatei.";
$owl_lang->err_backup_folder_create 	= "Fehler beim Erzeugen des Backup-Verzeichnisses.";
$owl_lang->err_bad_url                  = "Geben Sie bitte eine korrekte URL ein.";
$owl_lang->err_bad_version_1  		= "Document Management System ben&ouml;tigt mindestens PHP Version";
$owl_lang->err_bad_version_2  		= "Sie verwenden Version";
$owl_lang->err_bad_version_3  		= "Installieren Sie eine neuere PHP Version und versuchen Sie es erneut";
$owl_lang->err_cant_del_doc_type        = "Dieser Document Type kann nicht gel&ouml;scht werden, da er in Gebrauch ist";
$owl_lang->err_captcha_auth		= "Fehler: Falsche Zeichen Eingegeben";
$owl_lang->err_comment_empty		= "Kommentarfeld darf nicht leer sein";
$owl_lang->err_database			= "Datenbankfehler";
$owl_lang->err_doc_field_req            = "Es fehlt das ben&ouml;tigte Feld" . LABEL_TERMINATOR;
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req        = "Geben Sie f&uuml;r den Document Type einen Namen ein <br />";
$owl_lang->err_email          		= "Die Nachricht konnte nicht gesendet werden.";
$owl_lang->err_email_required   	= "E-Mail Feld wird ben&ouml;tigt";
$owl_lang->err_fexist1 			= "<b>Datei existiert bereits:</b>";
$owl_lang->err_fexist2 			= "Es existiert bereits eine Datei mit diesem Namen <i>";
$owl_lang->err_fexist3 			= "</i> in diesem Verzeichnis.";
$owl_lang->err_field_label_req          = "Ein Field Label wird ben&ouml;tigt <br />";
$owl_lang->err_field_name_req           = "Ein Feldname wird ben&ouml;tigt <br />";
$owl_lang->err_field_size_req           = "Eine Gr&ouml;sse f&uuml;r das Feld wird ben&ouml;tigt <br />";
$owl_lang->err_field_minor_version	= "Minor version field must be a positive integer"; 
$owl_lang->err_field_major_version	= "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_exists         	= "Die Datei, die Sie versuchen einzustellen, existiert bereits";
$owl_lang->err_file_indexing		= "Fehler bei der tempor&auml;ren Erstellung einer Textdatei";
$owl_lang->err_file_lock      		= "Sie k&ouml;nnen diese Datei nicht auschecken, da sie bereits verwendet wird von ";
$owl_lang->err_file_not_exist 		= "Diese Datei existiert nicht auf der Festplatte";
$owl_lang->err_file_too_big     	= "php.ini upload_max_filesize &uuml;berschritten und/oder<br />Maximale Upload Gr&ouml;sse f&uuml;r Owl &uuml;berschritten";
$owl_lang->err_file_update    		= "Um eine Datei zu aktualisieren, m&uuml;ssen die Dateinamen &uuml;bereinstimmen. Benutzen Sie bitte den in DMS gespeicherten Dateinamen";
$owl_lang->err_fileexists     		= "Verschieben abgebrochen.<br />Eine Datei mit diesem Namen existiert bereits!";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "Der neue Name, den Sie dieser Datei geben m&ouml;chten, existiert bereits";
$owl_lang->err_folder_create  		= "Verzeichnis konnte nicht angelegt werden";
$owl_lang->err_folder_exist   		= "Das Verzeichnis existiert bereits";
$owl_lang->err_folderexists   		= "Umbenennen abgebrochen.<br />Ein Verzeichnis mit diesem Namen existiert bereits!";
$owl_lang->err_forbidden_file		= "Verbotener Dokumententyp";
$owl_lang->err_general        		= "Ein Fehler ist aufgetreten";
$owl_lang->err_group_delete             = "Diese Gruppe kann nicht gel&ouml;scht werden: <font color=\"red\">%d</font> Datei(en),  <font color=\"red\">%d</font> Verzeichnis(sse), <font color=\"red\">%d</font> Benutzer mit dieser Hauptgruppe, <font color=\"red\">%d</font> Benutzer welche Gruppenmitglieder sind";
$owl_lang->err_group_exists             = "Gruppe existiert bereits";
$owl_lang->err_gzip_not_found   	= "gzip nicht gefunden in ";
$owl_lang->err_login   			= "Um diese Funktion auszuf&uuml;hren m&uuml;ssen Sie sich anmelden!";
$owl_lang->err_movecancel     		= "Verschieben wurde abgebrochen.<br />";
$owl_lang->err_nameempty      		= "Der Verzeichnisname darf nicht leer sein.";
$owl_lang->err_news_required            = "FEHLER: Sie m&uuml;ssen f&uuml;r die Mitteilungen einen Titel und einen Text eingeben!";
$owl_lang->err_no_access       		= "Sie haben keinen Zugriff auf die ausgew&auml;hlten Dateien";
$owl_lang->err_no_access_info           = "M&ouml;gliche Gr&uuml;nde: <br />1) Sie haben keine Checkbox angeklickt, die sich vor einer Datei oder einem Verzeichnis befindet<br />2) Auswahl l&ouml;schen, Auswahl mailen und Auswahl ein-/auschecken geht f&uuml;r Verzeichnisse nicht<br />3) Sie haben keine Berechtigung f&uuml;r die von Ihnen ausgew&auml;hlten Dateien oder Verzeichnisse.";
$owl_lang->err_noemail            	= "Sie haben keine Berechtigung, diese Datei zu versenden";
$owl_lang->err_nofileaccess       	= "Sie haben keinen Zugriff auf die Datei";
$owl_lang->err_nofiledelete       	= "Sie haben keine Berechtigung zum L&ouml;schen dieser Datei";
$owl_lang->err_nofilemod          	= "Sie haben keine Berechtigung zum &auml;ndern dieser Datei";
$owl_lang->err_nofolderaccess     	= "Sie haben keinen Zugriff auf das Verzeichnis";
$owl_lang->err_nofolderdelete     	= "Sie haben keine Berechtigung, dieses Verzeichnis zu l&ouml;schen";
$owl_lang->err_nofoldermod        	= "Sie haben keine Berechtigung, dieses Verzeichnis zu ver&auml;ndern";
$owl_lang->err_nosubfolder        	= "Sie haben hier keine Berechtigung, Unterverzeichnisse zu erstellen";
$owl_lang->err_not_zip			= "Dies ist kein g&uuml;ltiges ZIP Archiv";
$owl_lang->err_note_title               = "Bitte geben Sie einen Titel an";
$owl_lang->err_note_title_exists        = "Dateiname schon vorhanden";
$owl_lang->err_noupload           	= "Sie haben keine Berechtigung Dateien in dieses Verzeichnis hochzuladen";
$owl_lang->err_pass_missmatch 		= "Das neue und das Best&auml;tigungspasswort stimmen nicht &uuml;berein.";
$owl_lang->err_pass_wrong     		= "Das alte Passwort ist falsch!";
$owl_lang->err_please_select_bulk       = "Bitte w&auml;hlen Sie mindestens ein Verzeichnis oder eine Datei aus, wenn Sie die Checkboxen verwenden.";
$owl_lang->err_pod2html_not_found       = "FEHLER: Das Programm pod2html wurde nicht gefunden" . LABEL_TERMINATOR;
$owl_lang->err_quota          		= "Sie haben nicht genug Speicherplatz, um die Datei hochzuladen" . LABEL_TERMINATOR;
$owl_lang->err_quota_avail    		= " verf&uuml;gbar.";
$owl_lang->err_quota_exceed   		= "Sie haben keinen Speicherplatz mehr zur Verf&uuml;gung ";
$owl_lang->err_quota_needed   		= " ben&ouml;tigt ";
$owl_lang->err_req      		= "Fehler: Bitte alle Felder ausf&uuml;llen.";
$owl_lang->err_root_delete              = "Das Root-Verzeichnis kann nicht gel&ouml;scht werden";
$owl_lang->err_select_reviewer          = "Bitte w&auml;hlen Sie mindestens eine Person, um Ihr Dokument bewerten zu lassen";
$owl_lang->err_sess_notvalid  		= "Session-ID ist ung&uuml;ltig";
$owl_lang->err_sess_write     		= "Konnte Session Informationen nicht in die Datenbank schreiben";
$owl_lang->err_specialfoldername 	= "'backup' ist ein f&uuml;r Owl reservierter Verzeichnisname. Bitte einen anderen Namen w&auml;hlen!";
$owl_lang->err_sql			= "SQL Fehler";
$owl_lang->err_tar_not_found    	= "tar nicht gefunden in ";
$owl_lang->err_trash_can_empty          = "Der Papierkorb<br />ist leer";
$owl_lang->err_unauth_area    		= "Sie haben keine Berechtigung f&uuml;r diesen Bereich";
$owl_lang->err_unauthorized   		= "Nicht autorisiert";
$owl_lang->err_update_file_lock         = "Sie k&ouml;nnen diese Datei nicht aktualisieren, da sie bereits verwendet wird von ";
$owl_lang->err_upload         		= "Fehler beim Hochladen der Datei";
$owl_lang->err_user_exists    		= "Benutzername existiert bereits";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu          = "Main Menu";
$owl_lang->btn_add_field          	= "Neues Feld";
$owl_lang->btn_add_file          	= "Neue Datei";
$owl_lang->btn_add_folder          	= "Neues Verzeichnis";
$owl_lang->btn_add_news          	= "Neue Mitteilung";
$owl_lang->btn_add_note          	= "Neue Notiz";
$owl_lang->btn_add_url          	= "Neue Url";
$owl_lang->btn_add_zip           	= "Neues Archiv";
$owl_lang->btn_admin      		= "Administration";
$owl_lang->btn_admin_groups          	= "Neue Gruppe";
$owl_lang->btn_admin_news          	= "Mitteilungen Admin";
$owl_lang->btn_admin_user_group         = "Benutzer-/Gruppenverwaltung";
$owl_lang->alt_btn_admin_user_group     = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news           = "Administartor for System News";
$owl_lang->btn_admin_users          	= "Neuer Benutzer";
$owl_lang->btn_back          		= "Zur&uuml;ck";
$owl_lang->btn_browse     		= "Dateimanager";
$owl_lang->btn_bulk_checkout       	= "Auswahl ein-/auschecken";
$owl_lang->btn_bulk_delete          	= "Auswahl l&ouml;schen";
$owl_lang->btn_bulk_download          	= "Auswahl herunterladen";
$owl_lang->btn_bulk_email          	= "Auswahl mailen";
$owl_lang->btn_bulk_move          	= "Auswahl verschieben";
$owl_lang->btn_cancel          		= "Abbrechen";
$owl_lang->btn_clickhere          	= "Hier klicken";
$owl_lang->btn_collapse_view          	= "Einfache Ansicht";
$owl_lang->btn_create          		= "Erstellen";
$owl_lang->btn_deldoctype          	= "Dokumententyp l&ouml;schen";
$owl_lang->btn_download_bulk_package	= "um Ihre Auswahl als Archiv herunterzuladen";
$owl_lang->btn_edit_group          	= "Gruppe anpassen";
$owl_lang->btn_edit_user          	= "Benutzer anpassen";
$owl_lang->btn_expand_view          	= "Erweiterte Ansicht";
$owl_lang->btn_export          		= "Export";
$owl_lang->btn_go_bottom                = "Zum Seitenende";
$owl_lang->btn_go_top                   = "Zum Seitenanfang";
$owl_lang->btn_help     		= "Hilfe";
$owl_lang->btn_import_users             = "Benutzer<br />Importieren";
$owl_lang->btn_login          		= "Anmelden";
$owl_lang->btn_logout     		= "Abmelden";
$owl_lang->btn_mail_tool     		= "E-Mail";
$owl_lang->btn_register          	= "Registrieren";
$owl_lang->btn_reset          		= "Zur&uuml;cksetzen";
$owl_lang->btn_send_email          	= "E-Mail senden";
$owl_lang->btn_submit          		= "Senden";
$owl_lang->alt_btn_submit               = "Submit Form";
$owl_lang->btn_trash_admin              = "Papierkorb";
$owl_lang->btn_gen_pdf                  = "PDF Erstellen";
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_gen_pdf     		= "Von der obigen Datei eine PDF Version erstellen";
$owl_lang->alt_add_comments     	= "Kommentar hinzuf&uuml;gen";
$owl_lang->alt_add_field        	= "Feld einf&uuml;gen";
$owl_lang->alt_add_group        	= "Diese Gruppe erstellen";
$owl_lang->alt_add_news         	= "Neue Mitteilung hinzuf&uuml;gen";
$owl_lang->alt_add_user         	= "Benutzer erstellen";
$owl_lang->alt_admin_backup     	= "SQL-Datenbank sichern";
$owl_lang->alt_admin_flush   		= "H&auml;ngen gebliebene Sessions l&ouml;schen";
$owl_lang->alt_admin_groups     	= "Gruppe anlegen";
$owl_lang->alt_admin_users      	= "Benutzer anlegen";
$owl_lang->alt_approve_file             = "Sie genehmigen dieses Dokument";
$owl_lang->alt_back          		= "Zur&uuml;ck zur vorherigen Seite";
$owl_lang->alt_backup_dis     		= "Sicherungs-Tool oder gzip nicht gefunden";
$owl_lang->alt_btn_add_file     	= "Neue Datei hochladen";
$owl_lang->alt_btn_add_folder   	= "Neues Verzeichnis erstellen";
$owl_lang->alt_btn_add_note     	= "Neue Textdatei erstellen";
$owl_lang->alt_btn_add_url      	= "Neuen Link erstellen";
$owl_lang->alt_btn_add_zip           	= "Eine Zip-Datei hochladen, um sie anschliessend zu extrahieren";
$owl_lang->alt_btn_admin        	= "Owl Administration";
$owl_lang->alt_btn_browse       	= "Zum Dateimanager";
$owl_lang->alt_btn_bulk_checkout       	= "Ausgew&auml;hlte Dateien ein-/auschecken";
$owl_lang->alt_btn_bulk_delete         	= "Ausgew&auml;hlte Dateien l&ouml;schen";
$owl_lang->alt_btn_bulk_download       	= "Ausgew&auml;hlte Dateien herunterladen";
$owl_lang->alt_btn_bulk_email          	= "Ausgew&auml;hlte Dateien mailen";
$owl_lang->alt_btn_bulk_move          	= "Ausgew&auml;hlte Dateien und Verzeichnisse verschieben";
$owl_lang->alt_btn_clickhere    	= "Hier klicken";
$owl_lang->alt_btn_collapse_view	= "Auf einfache Ansicht umschalten";
$owl_lang->alt_btn_expand_view  	= "Auf erweiterte Ansicht umschalten";
$owl_lang->alt_btn_help			= "Owl Hilfe";
$owl_lang->alt_btn_login        	= "Bei DMS anmelden";
$owl_lang->alt_btn_logout       	= "Bei DMS abmelden";
$owl_lang->alt_btn_mail_tool     	= "E-Mail Programm";
$owl_lang->alt_btn_trash_admin 		= "Verwaltung des Papierkorbes";
$owl_lang->alt_cancel_move      	= "Verschiebung abbrechen";
$owl_lang->alt_change           	= "Eintrag aktualisieren";
$owl_lang->alt_updated          	= "Dieses Dokument wurde seit Ihrem letzten Besuch aktualisiert";
$owl_lang->alt_indexed                  = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new             		= "Dieses Dokument wurde seit Ihrem letzten Besuch neu erstellt";
$owl_lang->alt_comments        		= "Kommentare existieren f&uuml;r diese Datei";
$owl_lang->alt_copy_file     		= "Datei kopieren";
$owl_lang->alt_copy_folder   		= "Verzeichnis kopieren";
$owl_lang->alt_del_comments    		= "Kommentar l&ouml;schen";
$owl_lang->alt_edt_comments             = "Kommentar &auml;ndern";
$owl_lang->alt_del_field        	= "Dieses Feld l&ouml;schen";
$owl_lang->alt_del_file       		= "Datei l&ouml;schen";
$owl_lang->alt_del_folder     		= "Verzeichnis l&ouml;schen";
$owl_lang->alt_del_group        	= "Diese Gruppe l&ouml;schen";
$owl_lang->alt_del_news         	= "Mitteilung l&ouml;schen";
$owl_lang->alt_del_selected     	= "Markierte Dateien l&ouml;schen";
$owl_lang->alt_del_this_folder  	= "Verzeichnis l&ouml;schen &#8211; ";
$owl_lang->alt_del_user         	= "Benutzer l&ouml;schen";
$owl_lang->alt_deldoctype       	= "Diesen Dokumententyp l&ouml;schen";
$owl_lang->alt_edit_field       	= "Diese Felddefinition &auml;ndern";
$owl_lang->alt_edit_file_inline 	= "Textdatei Editieren";
$owl_lang->alt_edit_group       	= "Ausgew&auml;hlte Gruppe &auml;ndern";
$owl_lang->alt_edit_news        	= "Mitteilung &auml;ndern";
$owl_lang->alt_edit_user        	= "Ausgew&auml;hlten Benutzer &auml;ndern";
$owl_lang->alt_email          		= "Datei per E-Mail versenden";
$owl_lang->alt_email_reminder           = "E-Mail Erinnerung";
$owl_lang->alt_email_selected   	= "Markierte Dateien senden"; 
$owl_lang->alt_get_file       		= "herunterladen";
$owl_lang->alt_get_folder               = "Inhalt des Verzeichnisses herunterladen";
$owl_lang->alt_go_bottom                = "Gehen Sie an das Ende dieser Seite";
$owl_lang->alt_go_top                   = "Gehen Sie an den Beginn dieser Seite";
$owl_lang->alt_have_news       		= "Sie haben neue Mitteilungen";
$owl_lang->alt_have_no_news    		= "Keine neuen Mitteilungen";
$owl_lang->alt_home_folder     		= "Zum Home-Verzeichnis";
$owl_lang->alt_link_file     		= "In einem anderen Verzeichnis einen Link zu dieser Datei setzen";
$owl_lang->alt_lock_file       		= "Datei auschecken";
$owl_lang->alt_log_clear       		= "Logbuch l&ouml;schen";
$owl_lang->alt_log_file        		= "Logbuch dieser Datei";
$owl_lang->alt_log_next        		= "Zu den n&auml;chsten Eintr&auml;gen";
$owl_lang->alt_log_prev        		= "Zu den vorherigen Eintr&auml;gen";
$owl_lang->alt_log_top         		= "Zum ersten Eintrag";
$owl_lang->alt_mod_file       		= "Eigenschaften &auml;ndern";
$owl_lang->alt_mod_folder     		= "Eigenschaften &auml;ndern";
$owl_lang->alt_monitor       		= "Datei beobachten";
$owl_lang->alt_monitor_folder  		= "Verzeichnis beobachten";
$owl_lang->alt_monitored     		= "Beobachtung beenden";
$owl_lang->alt_monitored_folder		= "Beobachtung beenden";
$owl_lang->alt_move_file      		= "Datei verschieben";
$owl_lang->alt_move_folder    		= "Verzeichnis verschieben";
$owl_lang->alt_move_selected   		= "Markierte Dateien verschieben"; 
$owl_lang->alt_my_approval              = "Zu genehmigende Dokumente";
$owl_lang->alt_new_doctype      	= "Einen neuen Dokumententyp erstellen";
$owl_lang->alt_news_close       	= "Fenster schliessen";
$owl_lang->alt_news_next        	= "Weitere Mitteilungen";
$owl_lang->alt_news_prev        	= "Vorherige Mitteilung";
$owl_lang->alt_news_print       	= "Drucken";
$owl_lang->alt_pending_approval         = "Dokumente mit fehlender Genehmigung der Gutachter";
$owl_lang->alt_play_file        	= "Datei Abspielen";
$owl_lang->alt_publish_file             = "Machen Sie dieses Dokument &ouml;ffentlich";
$owl_lang->alt_recycle          	= "Papierkorb<br />leer";
$owl_lang->alt_recycle_disable  	= "Papierkorb<br />(nicht aktiviert)";
$owl_lang->alt_recycle_not_found	= "Papierkorb Verzeichnis nicht gefunden";
$owl_lang->alt_refresh_filter   	= "Filter aktualisieren";
$owl_lang->alt_register         	= "Registrierung senden";
$owl_lang->alt_reject_file              = "Sie weisen dieses Dokument zur&uuml;ck";
$owl_lang->alt_related			= "Nach &auml;hnlichen Dokumenten suchen";
$owl_lang->alt_reset_form		= "Formular zur&uuml;cksetzen";
$owl_lang->alt_search           	= "Suche starten";
$owl_lang->alt_send_email       	= "E-Mail senden";
$owl_lang->alt_sendfile         	= "Datei senden";
$owl_lang->alt_set_initial_dir  	= "Aktuelles Verzeichnis als Home-Verzeichnis festlegen";
$owl_lang->alt_site_map         	= "Verzeichnisplan";
$owl_lang->alt_submit           	= "Absenden";
$owl_lang->alt_toggle_check_box		= "Auswahl umkehren";
$owl_lang->alt_tool_status_green        = "Tool ist Aktiv";
$owl_lang->alt_tool_status_red          = "Pfad ist falsch UND/ODER nicht Executable";
$owl_lang->alt_unlock_file      	= "Datei einchecken";
$owl_lang->alt_upd_field        	= "Dieses Feld updaten";
$owl_lang->alt_upd_file       		= "Datei aktualisieren";
$owl_lang->alt_view_comments    	= "Kommentar";
$owl_lang->alt_view_file      		= "Datei ansehen";

//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$log_file_actions[1]           		= "ANMELDUNG";
$log_file_actions[10]          		= "DATEI EINGECHECKT";
$log_file_actions[11]          		= "DATEI GESENDET";
$log_file_actions[12]          		= "DATEI VERSCHOBEN";
$log_file_actions[13]          		= "VERZEICHNIS ERSTELLT";
$log_file_actions[14]          		= "VERZEICHNIS GEL&Ouml;SCHT";
$log_file_actions[15]          		= "VERZEICHNIS GE&Auml;NDERT";
$log_file_actions[16]          		= "VERZEICHNIS VERSCHOBEN";
$log_file_actions[17]          		= "PASSWORT VERGESSEN";
$log_file_actions[18]          		= "BENUTZER REGISTRIERUNG";
$log_file_actions[19]          		= "DATEI ANGESEHEN";
$log_file_actions[2]           		= "ANMELDUNG FEHLGESCHLAGEN";
$log_file_actions[20]          		= "DATEI VIRUS";
$log_file_actions[21]          		= "DATEI KOPIERT";
$log_file_actions[22]          		= "VERZEICHNIS KOPIERT";
$log_file_actions[23]          		= "DATEI VERLINKT";
$log_file_actions[24]          	 	= "BENUTZER ADMINISTRATION";
$log_file_actions[25]          		= "PAPIERKORB";
$log_file_actions[26]          		= "DATEI ACL";
$log_file_actions[27]          		= "VERZEICHNIS ACL";
$log_file_actions[3]           		= "ABMELDUNG";
$log_file_actions[4]           		= "DATEI GEL&Ouml;SCHT";
$log_file_actions[5]           		= "DATEI ERSTELLT";
$log_file_actions[6]           		= "DATEI AKTUALISIERT";
$log_file_actions[7]           		= "DATEI HERUNTERGELADEN";
$log_file_actions[8]           		= "DATEI GE&Auml;NDERT";
$log_file_actions[9]           		= "DATEI AUSGECHECKT";
$log_file_actions[28]                   = "VERZEICHNIS VERTEILT";
$log_file_actions[29]                   = "VERZEICHNIS VERLINKT";
$log_file_actions[30]                   = "DATEI PR&Uuml;FEN";
$log_file_actions[31]                   = "DATEI FREIGEGEBEN";
$log_file_actions[32]                   = "DATEI ABGELEHNT";
$log_file_actions[33]                   = "DATEI VER&Ouml;FFENTLICHT";

$owl_lang->log_admin_changed_group      = "Ver&auml;nderte Gruppe" . LABEL_TERMINATOR;
$owl_lang->log_admin_changed_user       = "Ver&auml;nderter Benutzer" . LABEL_TERMINATOR;
$owl_lang->log_admin_created_group      = "Neue Gruppe" . LABEL_TERMINATOR;
$owl_lang->log_admin_created_user       = "Neuer Benutzer" . LABEL_TERMINATOR;
$owl_lang->log_admin_del_group          = "Gel&ouml;schte Gruppe" . LABEL_TERMINATOR;
$owl_lang->log_admin_del_user           = "Gel&ouml;schter Benutzer" . LABEL_TERMINATOR;
$owl_lang->log_admin_disabled           = "Gesperrter Benutzer" . LABEL_TERMINATOR;
$owl_lang->log_admin_email_restore      = "Versendete Dateien" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_delfile      = "Gel&ouml;schte Datei" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_delfold      = "Gel&ouml;schtes Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->log_admin_trash_empty        = "Papierkorb kann geleert werden";
$owl_lang->log_admin_trash_restore      = "Wiederhergestellt" . LABEL_TERMINATOR;
$owl_lang->log_del_det  		= "Inhalt gel&ouml;scht";
$owl_lang->log_detail   		= "Keine weiteren Details";
$owl_lang->log_file_to  		= "AN" . LABEL_TERMINATOR;
$owl_lang->log_filter_all       	= "ALLE";
$owl_lang->log_login_det        	= "Benutzername" . LABEL_TERMINATOR;
$owl_lang->log_login_expired            = "Benutzer mit abgelaufenem Zugang" . LABEL_TERMINATOR;
$owl_lang->log_login_too_many_attempts  = "Gesperrt (Zuviele fehlgeschlagene Anmeldungen)" . LABEL_TERMINATOR;
$owl_lang->log_readhd_feature_add       = "Datei wurde von der automatischen Erkennung hinzugef&uuml;gt";
$owl_lang->log_admin_to                 = "bis";
$owl_lang->log_admin_of                 = "von";

//********************************************************
// Owl Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

$owl_lang->admin_login_date  		= "Der Administrator meldete sich an um" . LABEL_TERMINATOR;
$owl_lang->admin_login_from  		= "Der Administrator meldete sich an von";
$owl_lang->admin_login_subject  	= "ADMINISTRATOR ANMELDUNG";
$owl_lang->anonymous          		= "(Anonymer Zugriff m&ouml;glich)";
$owl_lang->engine             		= "DMS";
$owl_lang->forgot_pass        		= "Passwort vergessen?";
$owl_lang->like_register      		= "M&ouml;chten Sie sich registrieren?";
$owl_lang->login              		= "Anmelden";
$owl_lang->logindisabled      		= "Der Benutzername wurde deaktiviert, bitte kontaktieren Sie den Systemadministrator";
$owl_lang->loginfail          		= "Falscher Benutzername oder falsches Passwort";
$owl_lang->password           		= "Passwort";
$owl_lang->repository_list    		= "Datenbank" . LABEL_TERMINATOR;
$owl_lang->successlogout      		= "Sie haben sich erfolgreich abgemeldet.";
$owl_lang->toomanysessions    		= "Die maximale Anzahl an Sessions f&uuml;r diesen Benutzer ist erreicht, kontaktieren Sie bitte den Systemadministrator";
$owl_lang->username           		= "Benutzername";
$owl_lang->forgot_username           	= "Benutzername oder E-Mail";
$owl_lang->version 			= "Version";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions            		= "Aktionen";
$owl_lang->current_db         		= "Datenbank" . LABEL_TERMINATOR;
$owl_lang->current_folder 		= "Aktuelles Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->del_all			= "Papierkorb leeren";
$owl_lang->del_selected          	= "Markiert L&ouml;schen";
$owl_lang->disk_quota                  	= "Verwendeter Speicher";
$owl_lang->doc_number 			= "Register-<br />nummer";
$owl_lang->email_selected        	= "Markiert Senden";
$owl_lang->favorite_label               = "Label" . LABEL_TERMINATOR;
$owl_lang->favorite                     = "Favoriten";
$owl_lang->favorite_add                 = "Hinzuf&uuml;gen";
$owl_lang->favorite_delete              = "L&ouml;schen";
$owl_lang->favorite_go                  = "W&auml;hlen";
$owl_lang->file               		= "Datei";
$owl_lang->files_in_my_group_title 	= "Dateien in meinen Gruppen";
$owl_lang->folder_count_file           	= "Datei(en)";
$owl_lang->folder_count_folder         	= "Verzeichnis(se)";
$owl_lang->folder_count_note           	= "Notiz(en)";
$owl_lang->folder_count_pre            	= "Dieses Verzeichnis enth&auml;lt";
$owl_lang->folder_count_url            	= "URL";
$owl_lang->folder_policy               	= "Sicherheitseinstellungen f&uuml;r dieses Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->held               		= "Ausgecheckt";
$owl_lang->last_logged              	= "Letzter Besuch" . LABEL_TERMINATOR;
$owl_lang->menu_file_action            	= "Verf&uuml;gbare Datei Aktionen";
$owl_lang->menu_folder_action          	= "Verf&uuml;gbare Verzeichnis Aktionen";
$owl_lang->menu_url_action             	= "Verf&uuml;gbare URL Aktionen";
$owl_lang->modified           		= "Ge&auml;ndert";
$owl_lang->move_selected         	= "Markiert Verschieben";
$owl_lang->my_files_title		= "Meine Dateien";
$owl_lang->my_monitored_title		= "Meine Beobachteten Dateien/Verzeichnisse";
$owl_lang->my_special_access_title	= "Sonderzugangsliste";
$owl_lang->new_file                    	= "Neu!";
$owl_lang->no_description              	= "Keine Beschreibung verf&uuml;gbar";
$owl_lang->owner                       	= "User";
$owl_lang->page                        	= "Seite";
$owl_lang->panel_file_info		= "Information zu den Dateien";
$owl_lang->postedby           		= "Erstellt";
$owl_lang->reallydelete      		= "Wirklich l&ouml;schen";
$owl_lang->reallydelete_logs           	= "Wirklich das Logbuch l&ouml;schen";
$owl_lang->reallydelete_selected	= "M&ouml;chten Sie die markierte(n) Datei(en) wirklich l&ouml;schen";
$owl_lang->reallyrestore_selected      	= "M&ouml;chten Sie die markierte(n) Datei(en) wirklich wiederherstellen";
$owl_lang->rest_selected		= "Auswahl wiederherstellen";
$owl_lang->score                       	= "Bewertung";
$owl_lang->size               		= "Gr&ouml;sse";
$owl_lang->updated_by                  	= "Aktualisiert von";
$owl_lang->special_access_count		= "Sonderzugang" . LABEL_TERMINATOR;
$owl_lang->special_access_count_alt	= "Dateien/Verzeichnisse mit Sonderzugang";
$owl_lang->title              		= "Name";
$owl_lang->tot_files                   	= "Total" . LABEL_TERMINATOR;
$owl_lang->tot_monitored		= "Beobachtet" . LABEL_TERMINATOR;
$owl_lang->tot_my_checked_out          	= "Ausgecheckt" . LABEL_TERMINATOR;
$owl_lang->tot_my_files         	= "Eigene" . LABEL_TERMINATOR;
$owl_lang->tot_my_group                	= "Gruppe" . LABEL_TERMINATOR;
$owl_lang->tot_new_files               	= "Neu" . LABEL_TERMINATOR;
$owl_lang->tot_updated_files           	= "Ge&auml;ndert" . LABEL_TERMINATOR;
$owl_lang->updated_file         	= "Aktualisiert!";
$owl_lang->user               		= "Benutzer";
$owl_lang->ver                		= "Ver.";
$owl_lang->past_number                 	= "Anzahl vergangener Tage " . LABEL_TERMINATOR;

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments    		= "Kommentar hinzuf&uuml;gen/&auml;ndern" . LABEL_TERMINATOR;
$owl_lang->addingfile         		= "Hinzuf&uuml;gen einer Datei zu ";
$owl_lang->addingfolder       		= "Hinzuf&uuml;gen eines Verzeichnisses zu ";
$owl_lang->attach_file        		= "Mit Attachment versenden";
$owl_lang->change             		= "&Auml;ndern";
$owl_lang->comments           		= "Kommentar";
$owl_lang->comments_added     		= "Kommentar von" . LABEL_TERMINATOR;
$owl_lang->create             		= "Anlegen";
$owl_lang->description        		= "Beschreibung";
$owl_lang->disp_mp3           		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Song" . LABEL_TERMINATOR . "<br />Album" . LABEL_TERMINATOR . "<br />Bitrate&nbsp;-&nbsp;Samplerate" . LABEL_TERMINATOR . "<br />Dauer" . LABEL_TERMINATOR . "<br />Genre" . LABEL_TERMINATOR . "<br />Kommentare" . LABEL_TERMINATOR;
$owl_lang->email_body         		= "Mitteilung";
$owl_lang->email_cc           		= "Kopie an";
$owl_lang->email_reply_to     		= "Antwort an";
$owl_lang->email_subject      		= "Betreff";
$owl_lang->email_to           		= "E-Mail an";
$owl_lang->emailing           		= "Versende";
$owl_lang->keywords           		= "Schlagwort(e)";
$owl_lang->saved_keywords      		= "Saved Keywords" . LABEL_TERMINATOR;
$owl_lang->modify_url         		= "URL";
$owl_lang->modifying          		= "&auml;ndern ";
$owl_lang->name               		= "Name";
$owl_lang->none_selected      		= "NICHTS GEW&Auml;HLT";
$owl_lang->note_content       		= "Inhalt der Notiz";
$owl_lang->notify_link        		= "Owl externer Link";
$owl_lang->ownergroup         		= "Gruppe";
$owl_lang->ownership          		= "Besitzer";
$owl_lang->permissions        		= "Berechtigungen";
$owl_lang->pick_select        		= "&#8211; Einen Owl Benutzer w&auml;hlen &#8211;";
$owl_lang->policy             		= "Berechtigung" . LABEL_TERMINATOR;
$owl_lang->post_comment	      		= "Kommentar hinzuf&uuml;gen";
$owl_lang->prop_permissions   		= "Berechtigung auf die Unterverzeichnisse &uuml;bertragen";
$owl_lang->prop_perms_files   		= "Auf die Dateien zu &uuml;bertragende Berechtigung";
$owl_lang->sendfile           		= "Datei senden";
$owl_lang->sendthisfile       		= "Diese Datei senden";
$owl_lang->sendthisurl        		= "Diese URL senden";
$owl_lang->updating           		= "Aktualisieren";
$owl_lang->verdescription     		= "Beschreibung<br />der &Auml;nderungen";
$owl_lang->vermajor           		= "Komplette &Uuml;berarbeitung";
$owl_lang->verminor           		= "Kleinere &Auml;nderungen";
$owl_lang->vertype            		= "Art der &Uuml;berarbeitung";
$owl_lang->document_text                = "Inhalt";
$owl_lang->save_keyword                 = "Schlagwort speichern?";
$owl_lang->archive_skip_file            = "&Uuml;BERSPRUNGEN" . LABEL_TERMINATOR;
$owl_lang->archive_skip_message         = "Folgende Dateien wurden &uuml;bersprungen - sie sind bereits vorhanden";
$owl_lang->archive_extract_current      = "Ins aktuelle Verzeichnis entpacken?";
$owl_lang->archive_extract_overwrite    = "&uuml;berschreiben vorhandener Dateien (Update)?";
$owl_lang->optional_file_index          = "Datei indizieren?" . LABEL_TERMINATOR;

//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->captcha_typein        	= "Geben Sie die 5 Zeichen ein";
$owl_lang->change_pass_title	      	= "PASSWORT &Auml;NDERN";
$owl_lang->email             		= "E-Mail";
$owl_lang->err_cant_reuse_passwords   	= "Sie k&ouml;nnen bereits einmal verwendete Passw&ouml;rter nicht wiederverwenden";
$owl_lang->err_new_confirm_different  	= "Ihr neues Passwort und die Best&auml;tigung des neuen Passwortes stimmen nicht &uuml;berein <br />";
$owl_lang->err_old_pass_ver_failed    	= "Ihr Passwort ist falsch <br />";
$owl_lang->err_pass_restriction_1     	= "Ihr Passwort muss mindestens '$default->min_pass_length' Zeichen lang sein, <br />";
$owl_lang->err_pass_restriction_2     	= "mindestens '$default->min_pass_numeric' Ziffern zwischen 0 und 9 <br />";
$owl_lang->err_pass_restriction_3     	= "und mindestens '$default->min_pass_special' Sonderzeichen, wie [ ~!@#$%^&*()-=+_|{}][\";:<>.,?/\\ ] enthalten <br />";
$owl_lang->err_username_not_long_enough	= "Ihr Benutzername '%s' ist %d Zeichen lang, muss aber mindestens %d Zeichen lang sein.";
$owl_lang->full_name         		= "Name &#8211; Vorname";
$owl_lang->pass_change_email_1        	= "Ihr Passwort wurde nicht zur&uuml;ckgesetzt, da Sie nicht die Owl Authentifizierung verwenden";
$owl_lang->pass_change_email_2        	= "Ihr Authentifizierungssystem ist" . LABEL_TERMINATOR;
$owl_lang->pass_change_email_3        	= "Bitte kontaktieren Sie den Systemadministrator f&uuml;r weitere Hilfe";
$owl_lang->register          		= "Registrierung";
$owl_lang->self_failed         		= "Kein Erfolg";
$owl_lang->self_passwd         		= "Passwort gesendet an" . LABEL_TERMINATOR;
$owl_lang->self_reg_bod        		= "Ihr Owl Passwort ist" . LABEL_TERMINATOR;
$owl_lang->self_reg_rset       		= "Ihr Owl Passwort wurde zur&uuml;ckgesetzt. Das neue Passwort lautet" . LABEL_TERMINATOR;
$owl_lang->self_reg_subj       		= "Ihr Owl Konto";
$owl_lang->send_pass         		= "Neues Passwort Senden";
$owl_lang->submit            		= "Registrieren";
$owl_lang->thank_you_1          	= "Danke!";
$owl_lang->thank_you_2          	= "Sie erhalten in K&uuml;rze ein E-Mail mit dem Passwort";
$owl_lang->thank_you_3          	= "Vor dem Einloggen muss ihr Account erst von einem Administrator freigeschaltet werden.";

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button      		= "Abbrechen";
$owl_lang->copy_file			= "Datei kopieren";
$owl_lang->copy_folder			= "Ordner kopieren";
$owl_lang->moving             		= "Verschieben";
$owl_lang->moving_file			= "Datei verschieben";
$owl_lang->moving_folder		= "Ordner verschieben";
$owl_lang->select             		= "W&auml;hlen Sie ein neues Verzeichnis" . LABEL_TERMINATOR;

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->diff_from			= "Differenz von";
$owl_lang->diff_to			= "Differenz zu";
$owl_lang->btn_diff                     = "Show Diff";
$owl_lang->btn_diff_alt                 = "Show the differences between the selected files";
$owl_lang->viewlog            		= "Zeige Log f&uuml;r ";

//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif		= "Neue Kommentare per E-Mail melden";
$owl_lang->confpassword 		= "Neues Passwort best&auml;tigen";
$owl_lang->email_tool   		= "E-Mail Tool";
$owl_lang->group        		= "Hauptgruppe";
$owl_lang->groupmember  		= "Mitglied bei";
$owl_lang->last_modified		= "Ge&auml;ndert von";
$owl_lang->newpassword  		= "Neues Passwort";
$owl_lang->newsadmin    		= "Mitteilungen Administrator";
$owl_lang->not_member   		= "Sie sind nicht Mitglied anderer Gruppen.";
$owl_lang->notification 		= "Benachrichtigungen empfangen";
$owl_lang->oldpassword  		= "Altes Passwort";
$owl_lang->preference   		= "Einstellungen";
$owl_lang->saved        		= "&#8212; &Auml; N D E R U N G E N&nbsp;&nbsp;&nbsp;G E S P E I C H E R T &#8212;";
$owl_lang->status_no    		= "Nein";
$owl_lang->status_yes   		= "Ja";
$owl_lang->useradmin	                = "Benutzer Administrator";
$owl_lang->userlang     		= "Sprache";
$owl_lang->viewlogs     		= "Kann Systemlogs ansehen";
$owl_lang->viewreports  		= "Kann Systemberichte ansehen";

$owl_lang->owl_prefs_phone              = "Phone";
$owl_lang->owl_prefs_department         = "Department";
$owl_lang->owl_prefs_address            = "Address";
$owl_lang->owl_prefs_note               = "Notes";

//********************************************************
// prefs.php  END
//********************************************************


//********************************************************
// search.php  BEGIN
//********************************************************

$owl_lang->elapsed_time         	= "Ben&ouml;tigte Zeit" . LABEL_TERMINATOR;
$owl_lang->query_empty          	= "Bitte geben Sie einen Suchbegriff ein.";
$owl_lang->related_query_empty  	= "Mit diesem Dokument sind keine Metadaten (Schlagworte) verkn&uuml;pft, um nach &auml;hnlichen Dokumenten zu suchen.";
$owl_lang->search               	= "Suchen";
$owl_lang->search_all_word      	= "Alle W&ouml;rter";
$owl_lang->search_any_word      	= "Jedes Wort";
$owl_lang->search_exact_match           = "Exact Match";
$owl_lang->search_stats_with            = "Starts With";
$owl_lang->search_ends_with             = "Ends With";
$owl_lang->search_currentfolder 	= "Aktuelles Verzeichnis durchsuchen";
$owl_lang->search_entire_phrase 	= "Ganzer Satz";
$owl_lang->search_for_files     	= "Nach Dateien suchen&#133;";
$owl_lang->search_for_folders   	= "Nach Verzeichnissen suchen&#133;";
$owl_lang->search_match         	= "Treffer" . LABEL_TERMINATOR;
$owl_lang->search_results_for   	= "Suchergebnisse f&uuml;r";
$owl_lang->search_score         	= "Resultate bewerten&#133;";
$owl_lang->search_winthindocs   	= "In Dateien suchen";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing            		= "Anzeige ";
$owl_lang->view_diff_heading            = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->add                		= "Hinzuf&uuml;gen";
$owl_lang->edit_user                   	= "***** Benutzer &Auml;ndern *****";
$owl_lang->edit_group                  	= "***** Gruppe &Auml;ndern *****";
$owl_lang->enter_new_user              	= "***** Benutzer Hinzuf&uuml;gen *****";
$owl_lang->enter_new_group             	= "***** Gruppe Hinzuf&uuml;gen *****";
$owl_lang->info_panel_width            	= "Breites Infopanel anzeigen (nebeneinander statt untereinander)";
$owl_lang->allow_track_favorite        	= "Benutzern individuelle Favoriten erlauben";
$owl_lang->admin_login_to_browse_page  	= "Bei Anmeldung als Administrator erscheint Dateimanager";
$owl_lang->alt_btn_backup		= "SQL Datenbank Backup";
$owl_lang->alt_btn_cln_history         	= "Dateien l&ouml;schen, die &auml;lter (in Tagen) sind als" . LABEL_TERMINATOR;
$owl_lang->alt_btn_initial_load		= "Die Datenbank erstellen aufgrund des Dokumentenverzeichnisses";
$owl_lang->alt_btn_log_viewer          	= "Owl Systemlogs";
$owl_lang->alt_btn_report_viewer       	= "Owl Berichte";
$owl_lang->alt_btn_trashcan		= "Klicken Sie, um den Inhalt zu sehen";
$owl_lang->alt_doctype_admin		= "Dokumententyp Administration";
$owl_lang->alt_html_prefs		= "HTML Voreinstellungen editieren";
$owl_lang->alt_log_viewer		= "Owl System Logbuch";
$owl_lang->alt_news_admin		= "Owl Mitteilungen Administration";
$owl_lang->alt_site_features		= "Einstellungen und Eigenschaften editieren";
$owl_lang->alt_statistics_viewer	= "Owl Statistiken";
$owl_lang->alt_users_groups		= "Benutzer und Gruppen administrieren";
$owl_lang->anonymous_account           	= "Anonymes Benutzerkonto" . LABEL_TERMINATOR;
$owl_lang->btn_backup			= "Datenbank<br />Backup";
$owl_lang->btn_cln_history             	= "Alte Dateien<br />L&ouml;schen";
$owl_lang->btn_doctype_admin		= "Dokumenten-<br />typen";
$owl_lang->btn_html_prefs		= "HTML<br />Voreinstellungen";
$owl_lang->btn_initial_load		= "Erstmalige<br />Installation";
$owl_lang->btn_log_viewer              	= "Systemlogs";
$owl_lang->btn_log_viewer		= "Logbuch";
$owl_lang->btn_news_admin		= "Mitteilungen";
$owl_lang->btn_report_viewer           	= "Berichte";
$owl_lang->btn_site_features		= "Owl<br />Eigenschaften";
$owl_lang->btn_statistics_viewer	= "Berichte und<br />Statistiken";
$owl_lang->btn_trashcan			= "Papierkorb";
$owl_lang->btn_users_groups		= "Benutzer und<br />Gruppen";
$owl_lang->buttonstyle                 	= "Stil der Kn&ouml;pfe";
$owl_lang->confirm_cln_history         	= "Sind Sie sicher, dass Sie alle Dateien l&ouml;schen m&ouml;chten, welche &auml;lter (in Tagen) sind als" . LABEL_TERMINATOR;
$owl_lang->confirm_initial_load		= "*** ACHTUNG ***  Diese Installation darf nur bei einer leeren Datenbank und nur einmal durchgef&uuml;hrt werden!";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup        		= "Gruppe l&ouml;schen";
$owl_lang->deleteuser         		= "Benutzer l&ouml;schen";
$owl_lang->disable_recs_per_page       	= "Mit Eingeschr&auml;nkter Ansicht ist die Darstellung des Inhaltes auf mehreren Seiten nicht m&ouml;glich!";
$owl_lang->disableuser        		= "Benutzer deaktivieren";
$owl_lang->display_password_override   	= "&Auml;nderungsfeld des Verzeichnis-/Datei-Passwortes anzeigen";
$owl_lang->doc_id_num_digits           	= "Anzahl Ziffern der Registernummer";
$owl_lang->doc_id_prefix               	= "Pr&auml;fix der Registernummer";
$owl_lang->docicon_column              	= "Doc Icon";
$owl_lang->download_folder_zip         	= "Verzeichnisse als ZIP herunterladen (Standard ist tar.gz)";
$owl_lang->file_admin_group            	= "Dateimanager Admin Gruppe" . LABEL_TERMINATOR;
$owl_lang->flushed            		= "Die Sessiontabelle wurde bereinigt. Der Nutzer kann sich wieder anmelden!";
$owl_lang->groups             		= "Gruppen";
$owl_lang->hide_bulk_buttons           	= "Auswahl-Kn&ouml;pfe nicht anzeigen" . LABEL_TERMINATOR;
$owl_lang->historical_purge            	= "Alte Dateien Gel&ouml;scht";
$owl_lang->save_keywords_to_db         	= "Schlagw&ouml;rter d&uuml;rfen zur Wiederverwendung gespeichert werden";
$owl_lang->status_column               	= "Status";
$owl_lang->vermajor_initial            	= "Grosse Versionsnummer bei neuer Datei";
$owl_lang->verminor_initial            	= "Kleine Versionsnummer bei neuer Datei";
$owl_lang->view_doc_in_new_window      	= "Bei Dokumentenansicht neues Fenster &ouml;ffnen";

// Edit HTML Properties Messages
$owl_lang->ht_bd_bg_image     		= "Pfad zum Hintergrundbild (../graphics/back.jpg)" . LABEL_TERMINATOR;
$owl_lang->ht_bd_lnk_cl       		= "Textfarbe f&uuml;r Links" . LABEL_TERMINATOR;
$owl_lang->ht_bd_txt_cl       		= "Textfarbe" . LABEL_TERMINATOR;
$owl_lang->ht_bd_vlnk_cl      		= "Textfarbe f&uuml;r benutzte Links" . LABEL_TERMINATOR;
$owl_lang->ht_collapse_width  		= "Breite Normalansicht" . LABEL_TERMINATOR;
$owl_lang->ht_expand_width    		= "Breite Erweiterte Ansicht" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_border_sz   		= "Gr&ouml;sse des Tabellenrandes (0 = kein Rand)" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_cell_bg_al  		= "Zweite Hintergrundfarbe der Tabellenfelder" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_cell_bg_cl  		= "Erste Hintergrundfarbe der Tabellenfelder" . LABEL_TERMINATOR;
$owl_lang->ht_tbl_hd_bg       		= "Hintergrundfarbe des Tabellenkopfs" . LABEL_TERMINATOR;

// Edit Prefs Properties Messages
$owl_lang->alt_btn_change_passwd        = "&Auml;ndern Sie Ihr Passwort";
$owl_lang->anonymous_access            	= "Berechtigung f&uuml;r anonyme Benutzer";
$owl_lang->auth_http                    = "HTTP Auth (.htaccess)";
$owl_lang->auth_ldap                    = "LDAP Authentifizierung";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->auth_owl                     = "Owl Authentifizierung";
$owl_lang->auth_pop3                    = "pop3 Authentifizierung";
$owl_lang->btn_change_passwd            = "Passwort &auml;ndern";
$owl_lang->file_desc_required          	= "Dateibeschreibung notwendig";
$owl_lang->folder_desc_required        	= "Verzeichnisbeschreibung notwendig";
$owl_lang->header_group_admin          	= "Administration der Gruppen";
$owl_lang->header_sitefeatures_settings	= "Owl Eigenschaften und Einstellungen";
$owl_lang->header_user_admin           	= "Administration der Benutzer";
$owl_lang->hide_folder_doc_count       	= "Verzeichnis-/Dateiz&auml;hler verbergen";
$owl_lang->hide_folder_size            	= "Verzeichnisgr&ouml;sse verbergen";
$owl_lang->hide_panel			= "Verbergen";
$owl_lang->home_dir                    	= "Hauptverzeichnis des Benutzers" . LABEL_TERMINATOR;
$owl_lang->html_title			= "HTML Voreinstellungen";
$owl_lang->initial_dir                 	= "Home-Verzeichnis des Benutzers";
$owl_lang->maxsessions        		= "Maximale Anzahl an Sessions";
$owl_lang->noprefaccess       		= "Pers&ouml;nliche Einstellungen deaktivieren ";
$owl_lang->old_action_icons            	= "Alte Aktionskn&ouml;pfe (vor Owl 0.80) verwenden";
$owl_lang->owl_anon_download           	= "Nur Herunterladen";
$owl_lang->owl_anon_full               	= "Voller Zugang";
$owl_lang->owl_anon_ro       		= "Nur Lesen";
$owl_lang->owl_dbdump_path    		= "Pfad zum DB-Dump-Tool (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_group_owner 	= "Standardbesitzer f&uuml;r Dateigruppen" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_meta  		= "Standard-Metadaten f&uuml;r Dateien" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_owner 		= "Standardbesitzer f&uuml;r Dateien" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_perm 		= "Standardberechtigung bei neuen Dateien" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_security 	= "Standard-Dateisicherheit" . LABEL_TERMINATOR;
$owl_lang->owl_def_file_title 		= "Standard-Dateititel (leer = Dateiname)" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_group_owner  	= "Standardbesitzer f&uuml;r Verzeichnisgruppen" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_owner        	= "Standardbesitzer f&uuml;r Verzeichnisse" . LABEL_TERMINATOR;
$owl_lang->owl_def_fold_sec   		= "Standard-Verzeichnissicherheit" . LABEL_TERMINATOR;
$owl_lang->owl_def_folder_perm 		= "Standardberechtigung bei neuen Verzeichnissen" . LABEL_TERMINATOR;
$owl_lang->owl_default_tmpdir   	= "Verzeichnis f&uuml;r tempor&auml;re Dateien" . LABEL_TERMINATOR;
$owl_lang->owl_email_from     		= "Absenderadresse" . LABEL_TERMINATOR;
$owl_lang->owl_email_fromname 		= "Absendername" . LABEL_TERMINATOR;
$owl_lang->owl_email_replyto  		= "Antwortadresse" . LABEL_TERMINATOR;
$owl_lang->owl_email_server   		= "E-Mail-Serveradresse" . LABEL_TERMINATOR;
$owl_lang->owl_email_smtp              	= "SMTP System";
$owl_lang->owl_email_smtp_auth         	= "SMTP Auth verwenden";
$owl_lang->owl_email_smtp_auth_login	= "SMTP Auth Login" . LABEL_TERMINATOR;
$owl_lang->owl_email_smtp_auth_passwd  	= "SMTP Auth Passwort";
$owl_lang->owl_email_subject_pref      	= "E-Mail Betreff Pr&auml;fix" . LABEL_TERMINATOR;
$owl_lang->owl_fogotpass             	= "Link f&uuml;r vergessenes Passwort anzeigen";
$owl_lang->owl_group_user    		= "Mitglieder dieser Gruppe";
$owl_lang->owl_gzip_path      		= "Pfad zu gzip (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_hidebackup    		= "Backup-Verzeichnis verbergen";
$owl_lang->owl_log_file      		= "Dateien loggen";
$owl_lang->owl_log_login_act 		= "An/Abmeldung loggen";
$owl_lang->owl_log_rec_page  		= "Logbuch Eintr&auml;ge/Seite" . LABEL_TERMINATOR;
$owl_lang->owl_logging       		= "Logbuch aktivieren";
$owl_lang->owl_logo                  	= "Logo auf der Anmelde Seite (graphics/)" . LABEL_TERMINATOR;
$owl_lang->owl_lookAtHD       		= "Automatische Erkennung der Verzeichnisstruktur deaktiviert";
$owl_lang->owl_lookAtHDDel   		= "Gel&ouml;schte Dateien aus der Datenbank entfernen";
$owl_lang->owl_max_filesize   		= "Maximale Dateigr&ouml;sse f&uuml;r Upload";
$owl_lang->owl_owl_expand     		= "Standardansicht ist die erweiterte Ansicht";
$owl_lang->owl_owl_timeout    		= "Session-Timeout in Sekunden";
$owl_lang->owl_pdftotext_path          	= "Pfad zu pdftotext (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_pod2html_path           	= "Perl 5.8.0 oder neuer wird ben&ouml;tigt<br />Pfad zu pod2html" . LABEL_TERMINATOR;
$owl_lang->owl_restrict_view  		= "Eingeschr&auml;nkte Ansicht erlauben";
$owl_lang->owl_self_reg      		= "Selbstregistrierung erlauben";
$owl_lang->owl_self_reg_hd   		= "SELBSTREGISTRIERUNG VON BENUTZERN";
$owl_lang->owl_tar_path     	 	= "Pfad zu tar (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_title_browser           	= "DATEIMANAGER";
$owl_lang->owl_title_custom            	= "SPALTEN DES DATEIMANAGERS";
$owl_lang->owl_title_custom_search     	= "SPALTEN DER SUCHRESULTATE";
$owl_lang->owl_title_defaults   	= "STANDARD";
$owl_lang->owl_title_email    		= "E-MAIL EINSTELLUNGEN";
$owl_lang->owl_title_HD       		= "NEUE DATEIEN AUTOMATISCH ERKENNEN UND &Uuml;BERNEHMEN";
$owl_lang->owl_title_logging  		= "LOGBUCH";
$owl_lang->owl_title_other    		= "WEITERE EINSTELLUNGEN";
$owl_lang->owl_title_tools    		= "HILFSPROGRAMME";
$owl_lang->owl_unzip_path              	= "Pfad zu unzip (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_version_control 		= "Versionskontrolle einschalten";
$owl_lang->owl_wordtotext_path         	= "Pfad zu antiword (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->owl_ppttotext_path           = "Pfad zu catppt (leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->pass_account_lockout        	= "Anzahl Versuche bis zur Sperrung" . LABEL_TERMINATOR;
$owl_lang->pass_change_every           	= "Zeitabstand bis zum erzwungenen Wechsel des Passwortes (in Tagen)" . LABEL_TERMINATOR;
$owl_lang->pass_enable_account_lockout 	= "Benutzerkontensperrung aktivieren" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_length      	= "Minimale L&auml;nge von Benutzerpassworten" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_numeric     	= "Minimale Anzahl Ziffern" . LABEL_TERMINATOR;
$owl_lang->pass_min_passwd_special     	= "Minimale Anzahl Sonderzeichen" . LABEL_TERMINATOR;
$owl_lang->pass_min_username_length    	= "Minimale L&auml;nge von Benutzernamen" . LABEL_TERMINATOR;
$owl_lang->pass_track_old_passwords   	= "Anzahl Gespeicherter Alter Passw&ouml;rter" . LABEL_TERMINATOR;
$owl_lang->quota              		= "Speicherlimit (0 = kein)";
$owl_lang->reallydeluser               	= "Dieser Benutzer besitzt %numfiles% Datei(en) und %numfolders% Verzeichnis(se). Alle diese Dateien und Verzeichnisse werden verwaist. M&ouml;chten Sie trotzdem L&ouml;schen?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page               	= "Anzahl Eintr&auml;ge pro Seite (0 = Alles auf einer Seite)" . LABEL_TERMINATOR;
$owl_lang->recycle_enabled             	= "Papierkorb aktivieren";
$owl_lang->recycle_location            	= "Papierkorb Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->recycle_title               	= "PAPIERKORB";
$owl_lang->remember_me                 	= "Automatische Anmeldung zulassen";
$owl_lang->remember_me_checkbox        	= "Automatische Anmeldung";
$owl_lang->remember_me_title           	= "AUTOMATISCHE ANMELDUNG";
$owl_lang->remember_timeout            	= "Anzahl Tage bis das Cookie abl&auml;uft";
$owl_lang->restore_file_prefix         	= "Pr&auml;fix f&uuml;r wiederhergestellte Dateien";
$owl_lang->rtftotext_path              	= "RTF zu Text Tool Pfad";
$owl_lang->search_result_folders       	= "Verzeichnisse in die Suchresultate einbeziehen";
$owl_lang->show_action_title		= "Aktionskn&ouml;pfe" . LABEL_TERMINATOR;
$owl_lang->show_bulk_title		= "Auswahlkn&ouml;pfe" . LABEL_TERMINATOR;
$owl_lang->show_folder_title		= "Kn&ouml;pfe f&uuml;r Verzeichniseinstellungen" . LABEL_TERMINATOR;
$owl_lang->show_panel			= "Anzeigen";
$owl_lang->show_panel_title		= "Statusanzeige" . LABEL_TERMINATOR;
$owl_lang->show_pref_title		= "Einstellungen und An-/Abmeldung" . LABEL_TERMINATOR;
$owl_lang->show_search_title		= "Suchbalken" . LABEL_TERMINATOR;
$owl_lang->show_user_info           	= "Benutzernamen k&ouml;nnen angeklickt werden";
$owl_lang->status_bar_both             	= "Oben und unten";
$owl_lang->status_bar_bottom           	= "Unten";
$owl_lang->status_bar_location         	= "Statusanzeige Balken" . LABEL_TERMINATOR;
$owl_lang->status_bar_not              	= "Verbergen";
$owl_lang->status_bar_top              	= "Oben";
$owl_lang->cust_popup                   = "Eigene Felder innerhalb der Popup Beschreibung";
$owl_lang->cust_headpopup               = "SPEZIFISCHE DOKUMENTENFELDER";
$owl_lang->use_popup                   	= "Mitteilungen-Anzeige mit Pop-Up";
$owl_lang->user_admin              	= "Benutzer/Gruppen Administrator";
$owl_lang->user_auth_type               = "Authentifizierungssystem" . LABEL_TERMINATOR;
$owl_lang->user_change_pass_next_login  = "Bei der n&auml;chsten Anmeldung Passwort wechseln" . LABEL_TERMINATOR;
$owl_lang->user_expires                 = "Benutzerkonto verf&auml;lt am" . LABEL_TERMINATOR;
$owl_lang->user_gmt_offset             	= "Abweichung des Benutzers von GMT";
$owl_lang->user_group_admin             = "Datei Administrator f&uuml;r die Hauptgruppe" . LABEL_TERMINATOR;
$owl_lang->user_login_to_newrecords     = "Nach Anmeldung direkt zu den Neuen Eintr&auml;gen" . LABEL_TERMINATOR;
$owl_lang->users              		= "Benutzer";
$owl_lang->users_group_admin		= "Benutzer, welche Administratoren dieser Gruppe sind";
$owl_lang->virus_path                  	= "Pfad zur Antivirussoftware (z.B. '/usr/bin/clamscan --quiet')<br />(leer = deaktiviert)" . LABEL_TERMINATOR;
$owl_lang->users_in_primary_group       = "Benutzer, bei welchen diese Gruppe die Hauptgruppe ist";
$owl_lang->create_user_homedir          = "Erzeuge Benutzer HomeDir" . LABEL_TERMINATOR;
$owl_lang->use_captcha                  = "benutze CAPTCHA" . LABEL_TERMINATOR;
$owl_lang->created_here                 = "<br /> (Hier erstellt - wenn erzeuge Homedir ausgew&auml;hlt)";
$owl_lang->time_offsets[0][0]           = "-12";
$owl_lang->time_offsets[0][1]           = "(GMT-12:00) Eniwetok, Kwajalein";
$owl_lang->time_offsets[1][0]           = "-11";
$owl_lang->time_offsets[1][1]           = "(GMT-11:00) Midway Island, Samoa";
$owl_lang->time_offsets[2][0]           = "-10";
$owl_lang->time_offsets[2][1]           = "(GMT-10:00) Hawaii";
$owl_lang->time_offsets[3][0]           = "-9";
$owl_lang->time_offsets[3][1]           = "(GMT-9:00) Alaska";
$owl_lang->time_offsets[4][0]           = "-8";
$owl_lang->time_offsets[4][1]           = "(GMT-8:00) Pacific Time (US & Canada)";
$owl_lang->time_offsets[5][0]           = "-7";
$owl_lang->time_offsets[5][1]           = "(GMT-7:00) Mountain Time (US & Canada)";
$owl_lang->time_offsets[6][0]           = "-6";
$owl_lang->time_offsets[6][1]           = "(GMT-6:00) Central Time (US & Canada), Mexico City";
$owl_lang->time_offsets[7][0]           = "-5";
$owl_lang->time_offsets[7][1]           = "(GMT-5:00) Eastern Time (US & Canada), Bogota, Lima, Quito";
$owl_lang->time_offsets[8][0]           = "-4";
$owl_lang->time_offsets[8][1]           = "(GMT-4:00) Atlantic Time (Canada), Caracas, La Paz";
$owl_lang->time_offsets[9][0]           = "-3.5";
$owl_lang->time_offsets[9][1]           = "(GMT-3:30) Newfoundland";
$owl_lang->time_offsets[10][0]          = "-3";
$owl_lang->time_offsets[10][1]          = "(GMT-3:00) Brazil, Buenos Aires, Georgetown";
$owl_lang->time_offsets[11][0]          = "-2";
$owl_lang->time_offsets[11][1]          = "(GMT-2:00) Mid-Atlantic";
$owl_lang->time_offsets[12][0]          = "-1";
$owl_lang->time_offsets[12][1]          = "(GMT-1:00) Azores, Cape Verde Islands";
$owl_lang->time_offsets[13][0]          = "0";
$owl_lang->time_offsets[13][1]          = "(GMT) Western Europe Time, London, Lisbon, Casablanca, Monrovia";
$owl_lang->time_offsets[14][0]          = "1";
$owl_lang->time_offsets[14][1]          = "(GMT+1:00) Central Europe Time, Brussels, Copenhagen, Madrid, Paris";
$owl_lang->time_offsets[15][0]          = "2";
$owl_lang->time_offsets[15][1]          = "(GMT+2:00) Eastern Europe Time, Kaliningrad, South Africa";
$owl_lang->time_offsets[16][0]          = "3";
$owl_lang->time_offsets[16][1]          = "(GMT+3:00) Baghdad, Kuwait, Riyadh, Moscow, St. Petersburg, Volgograd, Nairobi";
$owl_lang->time_offsets[17][0]          = "3.5";
$owl_lang->time_offsets[17][1]          = "(GMT+3:30) Tehran";
$owl_lang->time_offsets[18][0]          = "4";
$owl_lang->time_offsets[18][1]          = "(GMT+4:00) Abu Dhabi, Muscat, Baku, Tbilisi";
$owl_lang->time_offsets[19][0]          = "4.5";
$owl_lang->time_offsets[19][1]          = "(GMT+4:30) Kabul";
$owl_lang->time_offsets[20][0]          = "5";
$owl_lang->time_offsets[20][1]          = "(GMT+5:00) Ekaterinburg, Islamabad, Karachi, Tashkent";
$owl_lang->time_offsets[21][0]          = "5.5";
$owl_lang->time_offsets[21][1]          = "(GMT+5:30) Bombay, Calcutta, Madras, New Delhi";
$owl_lang->time_offsets[22][0]          = "6";
$owl_lang->time_offsets[22][1]          = "(GMT+6:00) Almaty, Dhaka, Colombo";
$owl_lang->time_offsets[23][0]          = "7";
$owl_lang->time_offsets[23][1]          = "(GMT+7:00) Bangkok, Hanoi, Jakarta";
$owl_lang->time_offsets[24][0]          = "8";
$owl_lang->time_offsets[24][1]          = "(GMT+8:00) Beijing, Perth, Singapore, Hong Kong, Chongqing, Urumqi, Taipei";
$owl_lang->time_offsets[25][0]          = "9";
$owl_lang->time_offsets[25][1]          = "(GMT+9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk";
$owl_lang->time_offsets[26][0]          = "9.5";
$owl_lang->time_offsets[26][1]          = "(GMT+9:30) Adelaide, Darwin";
$owl_lang->time_offsets[27][0]          = "10";
$owl_lang->time_offsets[27][1]          = "(GMT+10:00) East Australian Standard, Guam, Papua New Guinea, Vladivostok";
$owl_lang->time_offsets[28][0]          = "11";
$owl_lang->time_offsets[28][1]          = "(GMT+11:00) Magadan, Solomon Islands, New Caledonia";
$owl_lang->time_offsets[29][0]          = "12";
$owl_lang->time_offsets[29][1]          = "(GMT+12:00) Auckland, Wellington, Fiji, Kamchatka, Marshall Island";

//********************************************************
// admin/index.php  END
//********************************************************


//********************************************************
// admin/log.php  BEGIN
//********************************************************

$owl_lang->owl_log_filter    		= "Filtern";
$owl_lang->owl_log_hd_action 		= "Aktion";
$owl_lang->owl_log_hd_agent  		= "Browser";
$owl_lang->owl_log_hd_dt_tm  		= "Datum/Zeit";
$owl_lang->owl_log_hd_dtls   		= "Details";
$owl_lang->owl_log_hd_file   		= "Datei";
$owl_lang->owl_log_hd_file_size         = "File Size";
$owl_lang->owl_log_hd_fld_path		= "Verzeichnis";
$owl_lang->owl_log_hd_ip     		= "IP-Adresse";
$owl_lang->owl_log_hd_user   		= "Benutzer";
$owl_lang->owl_log_hide      		= "Nicht anzeigen" . LABEL_TERMINATOR;
$owl_lang->owl_log_no_rec    		= "Nichts gefunden!";
$owl_lang->owl_log_viewer    		= "Logbuch";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          	= "Papierkorb leeren";
$owl_lang->really_empty_trash   	= "Sind Sie sicher?";
$owl_lang->recycle_bin_admin    	= "Papierkorb Administration";
$owl_lang->trash_email_body  		= "Die von Ihnen angeforderten Dateien sind angeh&auml;ngt.";
$owl_lang->trash_email_subject 	 	= "WIEDERHERGESTELLTE DATEIEN";

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                   	= "Nichts tun &#8211; Berechtigungen belassen";
$owl_lang->everyoneread       		= "Jeder kann lesen/herunterladen";
$owl_lang->everyoneread_ad    		= "Jeder kann lesen/herunterladen";
$owl_lang->everyonewrite      		= "Jeder kann lesen/schreiben/herunterladen";
$owl_lang->everyonewrite_ad   		= "Jeder kann lesen/schreiben/herunterladen";
$owl_lang->everyonewrite_ad_nod 	= "Jeder kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen";
$owl_lang->everyonewrite_nod  		= "Jeder kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen";
$owl_lang->file_size_byte               = "B";
$owl_lang->file_size_gigabyte           = "GB";
$owl_lang->file_size_kilobyte           = "kB";
$owl_lang->file_size_megabyte           = "MB";
$owl_lang->geveryoneread      		= "Jeder kann dieses Verzeichnis lesen";
$owl_lang->geveryoneread_ad   		= "Jeder kann dieses Verzeichnis lesen";
$owl_lang->geveryonewrite     		= "Jeder kann Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->geveryonewrite_ad  		= "Jeder kann Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->geveryonewrite_ad_nod 	= "Jeder kann Dateien in dieses Verzeichnis speichern";
$owl_lang->geveryonewrite_nod 		= "Jeder kann Dateien in dieses Verzeichnis speichern";
$owl_lang->ggroupread         		= "Ihre Gruppe kann dieses Verzeichnis lesen";
$owl_lang->ggroupread_ad      		= "Ihre Gruppe kann dieses Verzeichnis lesen";
$owl_lang->ggroupwrite        		= "Ihre Gruppe kann Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->ggroupwrite_ad     		= "Ihre Gruppe kann Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->ggroupwrite_ad_nod 		= "Die ausgew&auml;hlte Gruppe kann Dateien in dieses Verzeichnis speichern";
$owl_lang->ggroupwrite_nod    		= "Ihre Gruppe kann Dateien in dieses Verzeichnis speichern";
$owl_lang->ggroupwrite_worldread 	= "Ihre Gruppe kann Dateien hochladen und dieses Verzeichnis l&ouml;schen, jeder kann den lesen";
$owl_lang->ggroupwrite_worldread_ad 	= "Die ausgew&auml;hlte Gruppe kann Dateien hochladen und dieses Verzeichnis l&ouml;schen, jeder kann den Inhalt lesen";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Die ausgew&auml;hlte Gruppe kann Dateien in dieses Verzeichnis hochladen, jeder kann den Inhalt lesen, aber NICHT l&ouml;schen";
$owl_lang->ggroupwrite_worldread_nod 	= "Ihre Gruppe kann Dateien hochladen und jeder kann den Inhalt lesen, aber NICHT l&ouml;schen";
$owl_lang->gonlyyou           		= "Nur Sie k&ouml;nnen Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->gonlyyou_ad        		= "Nur Sie k&ouml;nnen Dateien erstellen und das Verzeichnis l&ouml;schen";
$owl_lang->groupread          		= "Ihre Gruppe kann lesen/herunterladen";
$owl_lang->groupread_ad       		= "Die ausgew&auml;hlte Gruppe kann lesen/herunterladen";
$owl_lang->groupwrite         		= "Ihre Gruppe kann lesen/schreiben/herunterladen";
$owl_lang->groupwrite_ad      		= "Die ausgew&auml;hlte Gruppe kann lesen/schreiben/herunterladen";
$owl_lang->groupwrite_ad_nod  		= "Die ausgew&auml;hlte Gruppe kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen";
$owl_lang->groupwrite_nod     		= "Ihre Gruppe kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen";
$owl_lang->groupwrite_worldread 	= "Ihre Gruppe kann lesen/schreiben/herunterladen und jeder kann lesen";
$owl_lang->groupwrite_worldread_ad 	= "Die ausgew&auml;hlte Gruppe kann lesen/schreiben/herunterladen, jeder kann lesen";
$owl_lang->groupwrite_worldread_ad_nod 	= "Die ausgew&auml;hlte Gruppe kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen, jeder kann lesen";
$owl_lang->groupwrite_worldread_nod 	= "Ihre Gruppe kann lesen/schreiben/herunterladen, aber NICHT l&ouml;schen, jeder kann lesen";
$owl_lang->invalidsess        		= "Ung&uuml;ltige Anmeldung. Gehen Sie bitte zur Hauptseite<br />";
$owl_lang->notif_comment_1             	= "kommentierte";
$owl_lang->notif_comment_2             	= "Kommentar" . LABEL_TERMINATOR;
$owl_lang->notif_msg          		= "DIES IST EINE AUTOMATISCHE MITTEILUNG VON DMS<br />Die neue/ge&auml;nderte Datei ist angeh&auml;ngt.<br />";
$owl_lang->notif_msg_alt          	= "DIES IST EINE AUTOMATISCHE MITTEILUNG VON DMS\n\nDie neue/ge&auml;nderte Datei ist angeh&auml;ngt.\n\n";
$owl_lang->notif_msg_alt_link           = "DIES IST EINE AUTOMATISCHE MITTEILUNG VON DMS\n\nBitte beachten Sie den Link zur neuen/ge&auml;nderten Datei.\n\n";
$owl_lang->notif_msg_link               = "DIES IST EINE AUTOMATISCHE MITTEILUNG VON DMS<br />Bitte beachten Sie den Link zur neuen/ge&auml;nderten Datei.<br />";
$owl_lang->notif_salutation            	= "Sehr geehrte(r)";
$owl_lang->notif_subject_comment       	= "Neuer Kommentar";
$owl_lang->notif_subject_monitor 	= "Beobachtete(s) Datei/Verzeichnis aktualisiert";
$owl_lang->notif_subject_new     	= "Neue Datei";
$owl_lang->notif_subject_upd  	 	= "Datei aktualisiert";
$owl_lang->notif_subject_file_deleted   = "DATEI WURDE AUS DEM URSPRUNGSORT GEL&Ouml;SCHT";
$owl_lang->notif_subj_new_account       = "EIN NEUES INTRANET-KONTO WURDE F&Uuml;R SIE ANGELEGT";
$owl_lang->notif_user                  	= "Erstellt/Aktualisiert von";
$owl_lang->onlyyou            		= "Nur Sie k&ouml;nnen lesen/schreiben/herunterladen";
$owl_lang->onlyyou_ad         		= "Nur der Besitzer kann lesen/schreiben/herunterladen";
$owl_lang->orphaned                    	= "&#8211; KEIN Besitzer &#8211;";
$owl_lang->owl_path                    	= "Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->sessinuse          		= "Diese Session ist bereits auf einem anderen Computer aktiv. Zugang verweigert.";
$owl_lang->sesstimeout        		= "Zeit&uuml;berschreitung! Bitte melden Sie sich neu an<br />";
$owl_lang->virus_infected 		= "VIRUSINFIZIERTE DATEI";
$owl_lang->virus_return_val		= "Antivirus Programm Ausgabewert" . LABEL_TERMINATOR;
$owl_lang->watermark_string             = "Vertraulich";
$owl_lang->watermark_source             = "DoxBox " . OWL_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder         	= "Verzeichnis &ouml;ffnen";
$owl_lang->title_browse_site           	= "URL &ouml;ffnen";
$owl_lang->title_download_view         	= "Datei herunterladen";
$owl_lang->title_edit_prefs            	= "Ihre pers&ouml;nlichen Einstellungen &auml;ndern";
$owl_lang->title_return_folder         	= "Zum Verzeichnis" . LABEL_TERMINATOR;
$owl_lang->title_sort                  	= "Sortieren nach";
$owl_lang->title_view_my               	= "Liste Ihrer Dateien";
$owl_lang->title_view_new              	= "Neue Dateien seit Ihrem letztem Besuch";
$owl_lang->title_view_updated          	= "Ge&auml;nderte Dateien seit letztem Besuch";
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

$owl_lang->news_content                	= "Mitteilung";
$owl_lang->news_hd                     	= "Mitteilungen";
$owl_lang->news_hd_audience            	= "Zielgruppe";
$owl_lang->news_hd_created             	= "Erstellt am";
$owl_lang->news_hd_expires             	= "Ablaufdatum";
$owl_lang->news_heading			= "Titel";
$owl_lang->news_posted_date            	= "Erstellt";
$owl_lang->news_read                   	= "Gelesen";
$owl_lang->news_title                  	= "Mitteilungen";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists        	= "DEBUG: Das Owl Verzeichnis: " .$default->owl_FileDir . "/" . fid_to_name(1) ." existiert nicht.";
$owl_lang->debug_doc_not_writeable     	= "DEBUG: Das Owl Verzeichnis: " .$default->owl_FileDir . "/" . fid_to_name(1) ." kann vom Web Server nicht beschrieben werden.";
$owl_lang->debug_file_not_exist		= "DEBUG: Die ben&ouml;tigte Datei '$default->owl_FileDir/%s' existiert nicht.<br /> ODER<br />Der durch \$default->owl_FileDir in config/owl.php beschriebene Pfad ist falsch.";
$owl_lang->debug_tmp_not_exists        	= "DEBUG: Das tempor&auml;re Verzeichnis: $default->owl_tmpdir existiert nicht.";
$owl_lang->debug_tmp_not_writeable     	= "DEBUG: Das tempor&auml;re Verzeichnis: $default->owl_tmpdir kann vom Web Server nicht beschrieben werden.";
$owl_lang->debug_webserver_no_access	= "DEBUG: Der Webserver hat keine Leseberechtigung f&uuml;r: <br />'$default->owl_FileDir/%s'. <br />Bitte korrigieren Sie die Berechtigungen und versuchen Sie es erneut.";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer     	   = "Berichte und Statistiken";
$owl_lang->stats_available_reports 	   = "Verf&uuml;gbare Berichte";
$owl_lang->stats_files          	   = "Anzahl Dateien/Benutzer";
$owl_lang->stats_folders        	   = "Anzahl Verzeichnis/Benutzer";
$owl_lang->stats_information    	   = "Owl Logging muss aktiviert sein, damit Statistiken dargestellt werden k&ouml;nnen.";
$owl_lang->stats_select_report 		   = "W&auml;hlen Sie einen Bericht";
$owl_lang->stats_top            	   = "Top 20 Downloads";
$owl_lang->stats_report_users_disabled     = "Benutzer (gesperrte Nutzer)";
$owl_lang->stats_report_users_entitlement  = "Benutzer (berechtigte Nutzer)";
$owl_lang->stats_report_users_filesfolders = "Benutzer (Datei und Verz. pro Nutzer)";
$owl_lang->stats_report_users_inactive     = "Benutzer (Inaktive Nutzer)";
$owl_lang->stats_users           	   = "Benutzer (Angemeldet/Anmeldefehler/Abgemeldet)";
$owl_lang->stats_users_loggedin 	   = "Zurzeit Angemeldet";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration   	= "Dokumententyp Admininstration";
$owl_lang->doc_field_disp_label 	= "FELD NAME" . LABEL_TERMINATOR;
$owl_lang->doc_field_disp_sep 		= "TRENNUNG NAME";
$owl_lang->doc_field_label      	= "Dargestellter Name (Nach Sprache)";
$owl_lang->doc_field_name       	= "Feldname";
$owl_lang->doc_field_pos        	= "Feldposition";
$owl_lang->doc_field_required   	= "Ben&ouml;tigt";
$owl_lang->doc_field_sample		= "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_searchable 	= "Durchsuchbar";
$owl_lang->doc_field_popup  		= "Popup Beschreibung einf&uuml;gen?";
$owl_lang->doc_field_show_in_browse 	= "Dateimanager Anzeigen" . LABEL_TERMINATOR;
$owl_lang->doc_field_show_in_list 	= "Feld im Dateimanager anzeigen" . LABEL_TERMINATOR;
$owl_lang->doc_field_size       	= "Feldgr&ouml;sse";
$owl_lang->doc_field_type		= "Feldtyp" . LABEL_TERMINATOR;
$owl_lang->doc_field_values		= "Eintr&auml;ge getrennt durch | " . LABEL_TERMINATOR;
$owl_lang->doc_fields 			= "Spezielle Felder";
$owl_lang->doc_new_doc_type     	= "&#8211; Neuen Dokumententyp erstellen &#8211;";
$owl_lang->doc_specific         	= "Dokumentenspezifische Felder";
$owl_lang->document_type        	= "Dokumententyp";
$owl_lang->document_type_name   	= "Dokumententyp Name";

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create                 = "Gruppe" . LABEL_TERMINATOR;
$owl_lang->header_csv_import            = "Eine CSV Benutzerdatei hochladen";
$owl_lang->import_inserted              = "EINGEF&Uuml;GT";
$owl_lang->import_skipped               = "&Uuml;BERGANGEN";
$owl_lang->invalid_groupid              = "Ung&uuml;tige Gruppen ID --> ";
$owl_lang->msg_user_exists              = "Benutzer existiert bereits";
$owl_lang->sendcsvfile                  = "Eine Datei hochladen (Komma getrennt)";
$owl_lang->user_created_skipped         = "Benutzer" . LABEL_TERMINATOR;

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review              = "Dokumenten-Begutachtung einschalten" . LABEL_TERMINATOR;
$owl_lang->owl_peer_review_opt          = "Dokumenten-Begutachtung optional" . LABEL_TERMINATOR;
$owl_lang->owl_title_peer_review        = "DOKUMENTEN-BEGUTACHTUNG";
$owl_lang->owl_title_peer_review2       = "Dokumenten-Begutachtung";
$owl_lang->peer_approval_title          = "Auf meine Begutachtung wartende Dokumente";
$owl_lang->peer_approved_body           = "Ihr Dokument wurde genehmigt von" . LABEL_TERMINATOR;
$owl_lang->peer_file_approved           = "Genehmigtes Dokument" . LABEL_TERMINATOR;
$owl_lang->peer_file_final              = "Abschliessende Beurteilung" . LABEL_TERMINATOR;
$owl_lang->peer_file_rejected           = "Zur&uuml;ckgewiesene Datei" . LABEL_TERMINATOR;
$owl_lang->peer_file_to_review          = "Datei zur Begutachtung" . LABEL_TERMINATOR;
$owl_lang->peer_final_approval          = "[Abschliessende Genehmigung]" . LABEL_TERMINATOR;
$owl_lang->peer_final_body              = "Ihr Dokument wurde von allen angefragten Gutachtern genehmigt. Bitte melden Sie sich an und ver&ouml;ffentlichen Sie das Dokument.";
$owl_lang->peer_final_body_auto         = "Ihr Dokument wurde von allen angefragten Gutachtern genehmigt.<br />Ihr Dokument wurde veröffentlicht.<br />";
$owl_lang->peer_msg_to_reviewer         = "Mitteilung an die Gutachter";
$owl_lang->peer_my_approval             = "Zur Genehmigung";
$owl_lang->peer_notif_user              = "Erstellt/Ge&auml;ndert von";
$owl_lang->peer_pending_approval        = "Ausstehende Genehmigungen";
$owl_lang->peer_pending_title           = "Meine Dokumente mit ausstehender Bewertung";
$owl_lang->peer_reject_reason           = "Ablehnungsgrund";
$owl_lang->peer_rejected_body           = "Ihr Dokument wurde zur&uuml;ckgewiesen von" . LABEL_TERMINATOR;
$owl_lang->peer_review_body             = "Sie wurden gebeten, folgendes Dokument zu begutachten" . LABEL_TERMINATOR;
$owl_lang->peer_reviewer_list           = "Gutachter";
$owl_lang->peer_satus                   = "Status";                                                                        
$owl_lang->peer_satus_approved          = "&#8212; G E N E H M I G T &#8212;";
$owl_lang->peer_satus_pending           = "&#8212; A U S S T E H E N D &#8212;";
$owl_lang->peer_satus_rejected          = "&#8212; Z U R &Uuml; C K G E W I E S E N &#8212;";
$owl_lang->peer_subj_approved           = "Ihr Dokument wurde GENEHMIGT";
$owl_lang->peer_subj_rejected           = "Ihr Dokument wurde ZURÜCKGEWIESEN";
$owl_lang->peer_subj_reminder           = "ERINNERUNG: Sie haben ein Owl Dokument zur Begutachtung";
$owl_lang->peer_subj_review             = "Sie haben ein Owl Dokument zur Begutachtung";

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file              = "Datei Zugangsberechtigungen" . LABEL_TERMINATOR;
$owl_lang->acl_adding_folder            = "Verzeichnis Zugangsberechtigungen setzen" . LABEL_TERMINATOR;
$owl_lang->acl_available_groups         = "Verf&uuml;gbare Gruppe(n)";
$owl_lang->acl_available_users          = "Verf&uuml;gbare(r) Benutzer";
$owl_lang->acl_edit_file                = "Datei Zugangsberechtigungen &auml;ndern" . LABEL_TERMINATOR;
$owl_lang->acl_edit_folder              = "Verzeichnis Zugangsberechtigungen" . LABEL_TERMINATOR;
$owl_lang->acl_file_checkin             = "Ein-/<br />Auschecken";
$owl_lang->acl_file_comment             = "Kommentieren";
$owl_lang->acl_file_copy                = "Kopieren";
$owl_lang->acl_file_delete              = "L&ouml;schen";
$owl_lang->acl_file_email               = "E-Mail";
$owl_lang->acl_file_modify              = "Eigenschaften<br />&Auml;ndern";
$owl_lang->acl_file_monitor             = "Datei Beobachten";
$owl_lang->acl_file_move                = "Verschieben";
$owl_lang->acl_file_read                = "Lesen";
$owl_lang->acl_file_search              = "&Auml;hnliche Dateien<br />Suchen";
$owl_lang->acl_file_set_acl             = "Berechtigungen<br />Festlegen";
$owl_lang->acl_file_update              = "Aktualisieren";
$owl_lang->acl_file_view_log            = "Logbuch<br />Ansehen";
$owl_lang->acl_folder_copy              = "Kopieren";
$owl_lang->acl_folder_delete            = "L&ouml;schen";
$owl_lang->acl_folder_modify            = "Eigenschaften<br />&Auml;ndern";
$owl_lang->acl_folder_monitor           = "Verzeichnis Beobachten";
$owl_lang->acl_folder_move              = "Verschieben";
$owl_lang->acl_folder_read              = "Lesen<br />(Herunterladen/Inhalt sehen)";
$owl_lang->acl_folder_set_acl           = "Berechtigungen<br />Festlegen";
$owl_lang->acl_folder_write             = "Schreiben<br />(Erstellen)";
$owl_lang->acl_heading_file             = "Gruppe(n)/<br />Benutzer";
$owl_lang->acl_heading_files            = "DATEIEN &#8211; W&Auml;HLEN SIE DIE GEW&Uuml;NSCHTEN BENUTZER UND GRUPPE(N)";
$owl_lang->acl_heading_folder           = "Gruppe(n)/<br />Benutzer";
$owl_lang->acl_heading_folders          = "VERZEICHNIS &#8211; W&Auml;HLEN SIE DIE GEW&Uuml;NSCHTEN BENUTZER UND GRUPPE(N)";
$owl_lang->acl_propagate_file           = "Diese Berechtigung f&uuml;r<br />ALLE Dateien setzen" . LABEL_TERMINATOR;
$owl_lang->acl_propagate_folders        = "Berechtigungen gelten f&uuml;r<br />ALLE Unterverzeichnisse" . LABEL_TERMINATOR;
$owl_lang->acl_selected_groups          = "Ausgew&auml;hlte Gruppe(e)";
$owl_lang->acl_selected_users           = "Ausgew&auml;hlte(r) Benutzer";
$owl_lang->acl_set_acl                  = "Berechtigungen";
$owl_lang->acl_set_acl_now              = "Zugangsberechtigung jetzt festlegen" . LABEL_TERMINATOR;
$owl_lang->acl_set_selected             = "Auswahl festlegen";
$owl_lang->alt_acl_save_file            = "Datei Zugangsberechtigung Speichern";
$owl_lang->alt_acl_save_folder          = "Datei Zugangsberechtigung Speichern";
$owl_lang->btn_acl_save                 = "Speichern";
$owl_lang->acl_set_file_permissions     = "Datei-Berechtigungen";
$owl_lang->acl_set_folder_permissions   = "Verzeichnis-Berechtigungen";
$owl_lang->alt_set_folder_acl           = "Verzeichnis-Berechtigungen &auml;ndern";

//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports     = "Verf&uuml;gbare Reporte" . LABEL_TERMINATOR;
$owl_lang->report_file_folder           = "Datei/Verzeichnis";
$owl_lang->report_filter                = "Filter" . LABEL_TERMINATOR;
$owl_lang->report_filter_since          = "Seit" . LABEL_TERMINATOR;
$owl_lang->report_full_access           = "FREIER ZUGANG";
$owl_lang->report_select_report         = "&#8211; W&auml;hlen Sie einen Report &#8211;";
$owl_lang->report_users_disabled_title  = "Gesperrte(r) Benutzer";
$owl_lang->report_users_entitlement     = "Benutzer Zugangsliste";
$owl_lang->report_users_inactive_title  = "Benutzer Inaktiv Seit";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->pdf_thumb_path                 = "Path to PDF Thumbnail Generation Tool" . LABEL_TERMINATOR;
$owl_lang->thumb_enable_thumbnails        = "Thumbnail Ansicht/Erstellung aktivieren" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_tool_path      = "Pfad zum ImageMagick Tool" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_vid_tool_parms = "Mplayer Parameter" . LABEL_TERMINATOR;
$owl_lang->thumb_gen_thumb_vid_tool_path  = "Pfad zu Mplayer" . LABEL_TERMINATOR;
$owl_lang->thumb_image_info               = "Bildinformation";
$owl_lang->thumb_large_width              = "Thumbnail Breite(GROSS) in Pixeln" . LABEL_TERMINATOR;
$owl_lang->thumb_med_width                = "Thumbnail Breite(MITTEL) in Pixeln" . LABEL_TERMINATOR;
$owl_lang->thumb_number_colums            = "Anzahl Spalten zur Thumbnail Ansicht" . LABEL_TERMINATOR;
$owl_lang->thumb_re_generate              = "Thumbnail Erstellen";
$owl_lang->thumb_small_width              = "Thumbnail Breite(KLEIN) in Pixeln (0 = Keine Pixel darstellen)" . LABEL_TERMINATOR;
$owl_lang->thumb_title                    = "THUMBNAIL ANSICHT/ERSTELLUNG OPTIONEN";
$owl_lang->thumb_title_thumb_view         = "THUMB ANSICHT DETAILS";
$owl_lang->thumb_image_size               = "Bildgr&ouml;sse" . LABEL_TERMINATOR;
$owl_lang->alt_thumb_small                = "Kleines Thumbnail";
$owl_lang->alt_no_thumb                   = "Kein Thumbnail vorhanden";

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// EXTENDED HELP BEGIN
//********************************************************

$owl_lang->owl_track_favorites_extended                    = "Ein-/Ausschalter des Favoritensystems";
$owl_lang->owl_password_override_extended                  = "Soll man Dateien und Ordner mit Passworten sch&uuml;tzen k&ouml;nnen?";
$owl_lang->owl_view_doc_in_new_window_extended             = "Beim Herunterladen wird das Dokument in einem neuen Fenster/Karteireiter ge&ouml;ffnet";
$owl_lang->owl_filedescreq_extended                        = "Ist immer eine Ordnerbeschreibung notwendig?";
$owl_lang->owl_old_action_icons_extended                   = "Zeigt die einzelnen Aktionskn&ouml;pfe nebeneinander statt im JavaScript Pulldown-Menu";
$owl_lang->owl_email_from_extended                         = "Absenderadresse, die bei automatisch generierten Nachrichten verwendet wird";
$owl_lang->owl_email_fromname_extended                     = "Klartextname der Absenderadresse";
$owl_lang->owl_email_replyto_extended                      = "REPLY-TO Adresse";
$owl_lang->owl_email_server_extended                       = "Geben Sie hier die TCP/IP Adresse oder den DNS-Namen Ihres Mailservers an";
$owl_lang->owl_use_smtp_extended                           = "Soll SMTP verwendet werden?";
$owl_lang->owl_use_smtp_auth_extended                      = "Ben&ouml;tigt das SMTP-System eine Authentifizierung?";
$owl_lang->owl_smtp_auth_login_extended                    = "Benutzernamen der zur Autentifizierung am Mailserver notwendig ist";
$owl_lang->owl_smtp_passwd_extended                        = "Passwort das zur Autentifizierung am Mailserver notwendig ist";
$owl_lang->owl_email_subject_extended                      = "Vorangestellter Text bei automatisierten Nachrichten";
$owl_lang->owl_forgot_pass_extended                        = "Zeigt in der Anmeldemaske den Link Passwort vergessen?";
$owl_lang->owl_self_reg_extended                           = "Zeigt in der Anmeldemaske den Link zur Selbstregistrieung an";
$owl_lang->owl_html2text_path_extended                     = "z.B. Lynx";
$owl_lang->owl_remember_me_extended                        = "Setzt am PC des Benutzers ein Cookie um ihn bei erneutem Zugriff automatisch anzumelden";
$owl_lang->owl_status_bar_location_extended                = "Position der Statusanzeige";
$owl_lang->owl_info_panel_wide_extended                    = "Zeigt die Liste im Quer- statt L&auml;ngsformat";
$owl_lang->owl_thumbnails_extended                         = "Zeigt eine Vorschau des Dokuments";
$owl_lang->owl_use_smtp_ssl_extended                       = "Extended Help";
$owl_lang->owl_smtp_port_extended                          = "Extended Help";
$owl_lang->owl_smtp_max_size_extended                      = "Extended Help";
$owl_lang->owl_lookAtHD_extended                           = "Extended Help";
$owl_lang->owl_pref_bar_extended                           = "Extended Help";
$owl_lang->owl_search_bar_extended                         = "Extended Help";
$owl_lang->owl_bulk_buttons_extended                       = "Extended Help";
$owl_lang->owl_action_buttons_extended                     = "Extended Help";
$owl_lang->owl_folder_tools_extended                       = "Extended Help";
$owl_lang->owl_hide_folder_doc_count_extended              = "Extended Help";
$owl_lang->owl_hide_folder_size_extended                   = "Extended Help";
$owl_lang->owl_use_zip_extended                            = "Extended Help";
$owl_lang->owl_force_ssl_extended                          = "Extended Help";
$owl_lang->owl_allow_different_filename_update_extended    = "Extended Help";
$owl_lang->owl_use_wysiwyg_for_textarea_extended           = "Extended Help";
$owl_lang->owl_search_result_folders_extended              = "Extended Help";
$owl_lang->owl_show_user_info_extended                     = "Extended Help";
$owl_lang->owl_folderdescreq_extended                      = "Extended Help";
$owl_lang->owl_show_folder_desc_as_popup_extended          = "Extended Help";
$owl_lang->owl_owl_expand_extended                         = "Extended Help";
$owl_lang->owl_pdf_thumb_path_extended                     = "Extended Help";
$owl_lang->owl_thumbnails_tool_path_extended               = "Extended Help";
$owl_lang->owl_thumbnails_video_tool_path_extended         = "Extended Help";
$owl_lang->owl_thumbnails_video_tool_opt_extended          = "Extended Help";
$owl_lang->owl_thumbnails_small_width_extended             = "Extended Help";
$owl_lang->owl_thumbnails_med_width_extended               = "Extended Help";
$owl_lang->owl_thumbnails_large_width_extended             = "Extended Help";
$owl_lang->owl_thumbnail_view_columns_extended             = "Extended Help";
$owl_lang->owl_pdf_watermarks_extended                     = "Extended Help";
$owl_lang->owl_pdf_watermark_path_extended                 = "Extended Help";
$owl_lang->owl_pdf_custom_watermark_filepath_extended      = "Extended Help";
$owl_lang->owl_pdf_pdftk_tool_greater_than_1_40_extended   = "Extended Help";
$owl_lang->owl_allow_custpopup_extended                    = "Extended Help";
$owl_lang->owl_allow_popup_extended                        = "Extended Help";
$owl_lang->owl_version_control_extended                    = "Extended Help";
$owl_lang->owl_make_file_indexing_user_selectable_extended = "Extended Help";
$owl_lang->owl_turn_file_index_off_extended                = "Extended Help";
$owl_lang->owl_docRel_extended                             = "Extended Help";
$owl_lang->owl_default_revision_extended                   = "Extended Help";
$owl_lang->owl_machine_time_zone_extended                  = "Extended Help";
$owl_lang->owl_major_revision_extended                     = "Extended Help";
$owl_lang->owl_minor_revision_extended                     = "Extended Help";
$owl_lang->owl_restrict_view_extended                      = "Extended Help";
$owl_lang->owl_hide_backup_extended                        = "Extended Help";
$owl_lang->owl_min_pass_length_extended                    = "Extended Help";
$owl_lang->owl_min_username_length_extended                = "Extended Help";
$owl_lang->owl_min_pass_numeric_extended                   = "Extended Help";
$owl_lang->owl_min_pass_special_extended                   = "Extended Help";
$owl_lang->owl_enable_lock_account_extended                = "Extended Help";
$owl_lang->owl_lock_account_bad_password_extended          = "Extended Help";
$owl_lang->owl_track_user_passwords_extended               = "Extended Help";
$owl_lang->owl_change_password_every_extended              = "Extended Help";
$owl_lang->owl_rec_per_page_extended                       = "Extended Help";
$owl_lang->owl_doc_id_prefix_extended                      = "Extended Help";
$owl_lang->owl_doc_id_num_digits_extended                  = "Extended Help";
$owl_lang->owl_admin_login_to_browse_page_extended         = "Extended Help";
$owl_lang->owl_save_keywords_to_db_extended                = "Extended Help";
$owl_lang->owl_max_filesize_extended                       = "Extended Help";
$owl_lang->owl_owl_timeout_extended                        = "Extended Help";
$owl_lang->owl_owl_tmpdir_extended                         = "Extended Help";
$owl_lang->owl_anon_ro_extended                            = "Extended Help";
$owl_lang->owl_def_anon_user_extended                      = "Extended Help";
$owl_lang->owl_file_admin_group_extended                   = "Extended Help";
$owl_lang->owl_collect_trash_extended                      = "Extended Help";
$owl_lang->owl_trash_can_location_extended                 = "Extended Help";
$owl_lang->owl_restore_file_prefix_extended                = "Extended Help";
$owl_lang->owl_peer_review_extended                        = "Extended Help";
$owl_lang->owl_peer_opt_extended                           = "Extended Help";
$owl_lang->owl_leave_old_file_accessible_extended          = "Extended Help";
$owl_lang->owl_auto_checkout_checking_extended             = "Extended Help";
$owl_lang->owl_logging_extended                            = "Extended Help";
$owl_lang->owl_log_file_extended                           = "Extended Help";
$owl_lang->owl_log_login_extended                          = "Extended Help";
$owl_lang->owl_log_rec_per_page_extended                   = "Extended Help";
$owl_lang->owl_self_reg_quota_extended                     = "Extended Help";
$owl_lang->owl_self_reg_notify_extended                    = "Extended Help";
$owl_lang->owl_self_reg_attachfile_extended                = "Extended Help";
$owl_lang->owl_self_reg_disabled_extended                  = "Extended Help";
$owl_lang->owl_self_reg_noprefacces_extended               = "Extended Help";
$owl_lang->owl_self_reg_maxsessions_extended               = "Extended Help";
$owl_lang->owl_self_create_homedir_extended                = "Extended Help";
$owl_lang->owl_self_captcha_extended                       = "Extended Help";
$owl_lang->owl_self_reg_group_extended                     = "Extended Help";
$owl_lang->owl_cookie_timeout_extended                     = "Extended Help";
$owl_lang->owl_virus_path_extended                         = "Extended Help";
$owl_lang->owl_dbdump_path_extended                        = "Extended Help";
$owl_lang->owl_gzip_path_extended                          = "Extended Help";
$owl_lang->owl_tar_path_extended                           = "Extended Help";
$owl_lang->owl_unzip_path_extended                         = "Extended Help";
$owl_lang->owl_pod2html_path_extended                      = "Extended Help";
$owl_lang->owl_rtftotext_path_extended                     = "Extended Help";
$owl_lang->owl_pdftotext_path_extended                     = "Extended Help";
$owl_lang->owl_wordtotext_path_extended                    = "Extended Help";
$owl_lang->owl_ppttotext_path_extended                     = "Extended Help";
$owl_lang->owl_lookAtHD_del_extended                       = "Extended Help";
$owl_lang->owl_def_file_title_extended                     = "Extended Help";
$owl_lang->owl_def_file_meta_extended                      = "Extended Help";

//********************************************************
// EXTENDED HELP END
//********************************************************

$owl_lang->group_set_selected                   = "gew&auml;hlte festlegen";
$owl_lang->alt_group_set_selected               = "Setzt die gew&auml;ten Benutzer";
$owl_lang->btn_jupload                          = "Jupload";
$owl_lang->alt_btn_jupload                      = "Add Multiple files using jupload";
$owl_lang->owl_use_smtp_ssl                     = "SMTP SSL" . LABEL_TERMINATOR;
$owl_lang->owl_smtp_port                        = "SMTP Port Nummer" . LABEL_TERMINATOR;
$owl_lang->owl_smtp_max_attachemnt_size         = "Maximale Anhang-Gr&ouml;sse (bytes)" . LABEL_TERMINATOR;
$owl_lang->owl_force_browser_to_ssl             = "Erzwinge Browser das HTTPS zu nutzen" . LABEL_TERMINATOR;
$owl_lang->owl_file_update_different_name       = "Datei Update mit unterschiedlichem Namen:<br />(ENDUNG muss die gleiche bleiben.)";
$owl_lang->owl_use_wysiwyg_editor               = "Benutze WYSIWYG Editor f&uuml;r Textbereich" . LABEL_TERMINATOR;
$owl_lang->owl_show_folder_desc_popup           = "Zeige Verzeichnis Bezeichnung als Popup" . LABEL_TERMINATOR;
$owl_lang->owl_header_watermarking              = "PDF WASSERZEICHEN OPTIONEN";
$owl_lang->owl_enable_watermarking              = "Aktiviere PDF Wasserzeichen" . LABEL_TERMINATOR;
$owl_lang->owl_path_to_pdftk                    = "Pfad zu pdftk" . LABEL_TERMINATOR;
$owl_lang->owl_path_to_pdftk_bg_file            = "Pfad zum eigenen Wasserzeichen:<br /><br />(Pfad zu einer einseitigen PDF Datei die als <br />Wasserzeichen verwendet werden soll.)";
$owl_lang->owl_pdftk_greater_than_1_40          = "PDFTK Version gr&ouml;sser als 1.40" . LABEL_TERMINATOR;
$owl_lang->owl_indexing_user_selectable         = "Mache Datei Indizierung f&uuml;r Nutzer w&auml;hlbar" . LABEL_TERMINATOR;
$owl_lang->owl_indexing_off                     = "Schalte Datei Indizierung AUS" . LABEL_TERMINATOR;
$owl_lang->owl_default_revision_type            = "Standard Versionsnummern Typ" . LABEL_TERMINATOR;
$owl_lang->owl_machine_timezone                 = "PC Zeitzone" . LABEL_TERMINATOR;
$owl_lang->owl_previous_ver_downloadable        = "Mache vorherige Versionen zug&auml;nglich" . LABEL_TERMINATOR;
$owl_lang->owl_auto_checkin_checkout            = "Markiere Dateien als ausgecheckt nach dem herunterladen" . LABEL_TERMINATOR;
$owl_lang->owl_user_default_view                = "Benutzers Standard Ansicht ERWEITERT" . LABEL_TERMINATOR;
$owl_lang->owl_user_default_revision            = "Standard Versionsnummern Typ" . LABEL_TERMINATOR;
$owl_lang->owl_user_major_revision              = "Benutzers urspr. Grosse Versionsnummer" . LABEL_TERMINATOR;
$owl_lang->owl_user_minor_revision              = "Benutzers urspr. Kleine Versionsnummer" . LABEL_TERMINATOR;
$owl_lang->owl_user_pdfwatermark                = "PDF mit Wasserzeichen markiert" . LABEL_TERMINATOR;
$owl_lang->owl_user_email_pass                  = "Email Benutzer / Passwort" . LABEL_TERMINATOR;
$owl_lang->owl_use_email_signature              = "Signatur verwenden?" . LABEL_TERMINATOR;
$owl_lang->owl_email_signature                  = "Email Signatur" . LABEL_TERMINATOR;
$owl_lang->owl_file_link                        = "Datei Verkn&uuml;pfung" . LABEL_TERMINATOR;
$owl_lang->alt_hot_link                         = "Zeige direkte URL";
$owl_lang->alt_link_folder                      = "Verlinke dieses Verzeichniss";

//********************************************************
// Field Types BEGIN
//********************************************************

$owl_lang->field_type_text                      = "Text";
$owl_lang->field_type_picklist                  = "Pick List";
$owl_lang->field_type_textarea                  = "Text Area";
$owl_lang->field_type_checkbox                  = "Check Box";
$owl_lang->field_type_mcheckbox                 = "Multiple Check Box";
$owl_lang->field_type_radio                     = "Radio Button";
$owl_lang->field_type_separator                 = "Separator";
$owl_lang->field_type_table                     = "Table";
$owl_lang->field_type_URL                       = "URL";
$owl_lang->field_type_Date                      = "Date";

//********************************************************
// Field Types END
//********************************************************

//********************************************************
// Extensions Text BEGIN
//********************************************************
$owl_lang->tables_btn                           = "User Tables";
$owl_lang->tables_header                        = "User Tables Management";
$owl_lang->table                                = "Table";
$owl_lang->tuple                                = "Tuple";
$owl_lang->tables_tupleView                     = "View Tuples";
$owl_lang->tables_tupleAdd                      = "Add Tuple";
$owl_lang->tables_tableEdit                     = "Modify Table";
$owl_lang->tables_tableAdd                      = "Add Table";
$owl_lang->tables_descr                         = "Description";
$owl_lang->tables_descr2                        = "Extended Description";
$owl_lang->tables_tupleEdit                     = "Edit";
$owl_lang->tables_tupleDelete                   = "Delete";
$owl_lang->tables_actions                       = "Actions";
$owl_lang->tables_tupleDeleted                  = "The tuple was successfully deleted!";
$owl_lang->tables_tupleAdded                    = "The tuple was successfully added!";
$owl_lang->tables_tupleEdited                   = "The tuple was successfully edited!";
$owl_lang->tables_back                          = "Back";
$owl_lang->tables_quickAdd                      = "Add";
$owl_lang->tables_refresh                       = "Refresh";

$owl_lang->calendar_title                       = "Calendar";

$owl_lang->docRel_title                         = "CONFIGURE DOCUMENT RELATIONSHIPS";
$owl_lang->docRel_activateFunction              = "Activate relationships between files";
$owl_lang->docRel_list                          = "Related documents";

//********************************************************
// Extensions Text END
//********************************************************

$owl_lang->ownership_change_1                   = "You do not own this file.";
$owl_lang->ownership_change_2                   = "Would you like to take ownership on Checkout?";
$owl_lang->ownership_change_subj                = "File: %s -- Take Ownership (%s)";

$owl_lang->member_membership                    = "Membership";
$owl_lang->member_fileadmin                     = "File Admin";
$owl_lang->member_group                         = "Group";

$owl_lang->user_created                         = "Created.";
$owl_lang->err_bad_username                     = "Please enter a valid username or email address";

$owl_lang->motd_headding                        = "Message of the Day MOTD";
$owl_lang->motd_label                           = "Message (Blank For None)";
$owl_lang->mtool_page_title                     = "E-Mail Tool";
$owl_lang->add_folder_page_title                = "Create New Folder";
$owl_lang->add_archive_page_title               = "Upload Zip File";
$owl_lang->add_file_page_title                  = "Upload New Document";
$owl_lang->add_url_page_title                   = "Add a URL";
$owl_lang->add_note_page_title                  = "Add a New Note";
$owl_lang->edit_folder_page_title               = "Modify Folder Properties";
$owl_lang->copy_folder_page_title               = "Copy a Folder";
$owl_lang->move_folder_page_title               = "Move a Folder";
$owl_lang->link_folder_page_title               = "Link a Folder to Another Directory";
$owl_lang->setacl_folder_page_title             = "Set Folder Security Policy";
$owl_lang->setacl_file_page_title               = "Set File Security Policy";
$owl_lang->edit_file_page_title                 = "Modify File Properties";
$owl_lang->copy_file_page_title                 = "Copy a File";
$owl_lang->move_file_page_title                 = "Move a File";
$owl_lang->upd_file_page_title                  = "Update a File";
$owl_lang->email_file_page_title                = "E-Mail a File";
$owl_lang->comment_file_page_title              = "Add / View / Edit A Comment to a File";
$owl_lang->link_file_page_title                 = "Link a File to Another Directory";
$owl_lang->jupload_page_title                   = "Bulk File Upload";
$owl_lang->bulk_move_page_title                 = "Bulk Moving...";
$owl_lang->bulk_mail_page_title                 = "Bulk Emailing...";
$owl_lang->view_page_title                      = "View File Details...";
$owl_lang->viewing_page_title                   = "Viewing...";
$owl_lang->playing_page_title                   = "Playing...";
$owl_lang->searching_page_title                 = "Searching...";

$owl_lang->syslog_filename                      = "File Name" . LABEL_TERMINATOR;
$owl_lang->syslog_date_from                     = "Date From (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_date_to                       = "Date to   (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_ip_host                       = "IP Address(HostName)" . LABEL_TERMINATOR;
$owl_lang->alt_gen_csv                          = "Generate CSV Version of the above File";
$owl_lang->btn_gen_csv                          = "Generate CSV";
$owl_lang->empty_folder                         = " E M P T Y &nbsp;  F O L D E R ";
$owl_lang->alt_btn_import_users                 = "Import users From CSV File";
$owl_lang->btn_admin_maint_on                   = "MAINTENANCE MODE";
$owl_lang->alt_btn_admin_maint_on               = "Blocks User sigon, so the administrator can perform a task without users on the system";
$owl_lang->btn_admin_maint_off                  = "NORMAL MODE";
$owl_lang->alt_btn_admin_maint_off              = "Turn Maintenace Mode Off (Permit Users to Login)";
$owl_lang->alt_tables_btn                       = "Table";
$owl_lang->alt_btn_admin_users                  = "User Administration";
$owl_lang->alt_btn_admin_groups                 = "Group Administration";

$owl_lang->alt_btn_main_menu_collapse           = "Collapse/Open The Main Menu";
$owl_lang->email_reply_to_name                  = "Document Management System";

// *********************************
// report/duplicate_filename.php
// **********************************

$owl_lang->report7_title                        = "List Files with Duplicate File Name";
$owl_lang->report7_report_title                 = "List of Duplicate Files Repository Wide";
$owl_lang->report7_title_fileid                 = "File ID";
$owl_lang->report7_title_docnum                 = "Doc#";
$owl_lang->report7_title_file_name              = "File Name";
$owl_lang->report7_title_file_size              = "File Size";
$owl_lang->report7_title_file_count             = "File Count";
$owl_lang->report7_title_file_path              = "File path";

?>
