<?php

/*
 * File: Italian/language.inc   Italian 
 * 
 * Author: Daniele Baudone 
 * Email: d.baudone@virgilio.it
 * Date: 2005/12/09
 * 
 * Author: Luca Barba 
 * Email: angeloluca.barba@virgilio.it
 * Author:  F. Malfatto 
 * Email: fmal@fmal.com
 * Date: 2003/08/05
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

// Character Encoding
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "it";

//********************************************************
// Date Formating END
//********************************************************
//******************************************************** 
// Error Messages BEGIN 
//******************************************************** 
 
$owl_lang->err_adding_comments  	= "Non hai permessi per aggiungere commenti al documento";
$owl_lang->err_backup_file     	= "Errore durante il Backup di un documento";
$owl_lang->err_backup_folder_create = "Errore durante la creazione della cartella di Backup";
$owl_lang->err_bad_url  		= "Inserire un URL valido";
$owl_lang->err_bad_version_1   	= "DMS richiede almeno PHP versione ";
$owl_lang->err_bad_version_2   	= "Stai utilizzando PHP versione ";
$owl_lang->err_bad_version_3   	= "Istalla una versione pi&ugrave; recente di php e ritenta ";
$owl_lang->err_cant_del_doc_type  	= "Non cancellabile: ci sono documenti che stanno utilizzando questo Document Type";
$owl_lang->err_comment_empty  	= "Un Commento non pu&ograve; essere vuoto";
$owl_lang->err_database  		= "Database errore";
$owl_lang->err_doc_field_req        = "Manca un Campo Richiesto:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req  	= "E &egrave; richiesto il Nome del Tipo di Documento<br />";
$owl_lang->err_email           	= "Mail non inviata";
$owl_lang->err_email_required  	= "Indirizzo Email obbligatorio";
$owl_lang->err_fexist1  		= "<b>Documento Esistente:</b>";
$owl_lang->err_fexist2   		= "Esiste gi&agrave; un documento di nome <i>";
$owl_lang->err_fexist3   		= "</i> in questa.";
$owl_lang->err_field_label_req   	= "E &egrave; richiesta la Etichetta del Campo <br />";
$owl_lang->err_field_name_req  	= "E &egrave; richiesto il Nome del Campo <br />";
$owl_lang->err_field_size_req  	= "E &egrave; richiesta la Dimensione del Campo <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_exists  		= "Il documento che cerchi di caricare esiste gia'";
$owl_lang->err_file_indexing  	= "Fallita creazione di documento 'TEXT' temporaneo";
$owl_lang->err_file_lock       	= "Blocco non consentito, bloccato da ";
$owl_lang->err_file_not_exist  	= "Il documento richiesto non esiste sul file system";
$owl_lang->err_file_too_big  		= "php.ini upload_max_filesize superata e/o<br />Max Dim. di upload di DMS superata";
$owl_lang->err_file_update  		= "Per aggiornare un documento il nome del documento deve rimanere lo stesso, ritenta usando lo stesso nome";
$owl_lang->err_fileexists      	= "Spostamento annullato<br />Documento gi&agrave; esistente.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist       = "Il nome che stati tentando di assegnare &egrave; gi&agrave; esistente";
$owl_lang->err_folder_create   	= "Errore durante la creazione della cartella";
$owl_lang->err_folder_exist  		= "Cartella gi&agrave; esistente";
$owl_lang->err_folderexists   	= "Rinomina annullato <br />cartella gi&agrave; esistente.";
$owl_lang->err_forbidden_file  	= "Tipo di Documento non permesso";
$owl_lang->err_general   		= "Si &egrave; verificato un errore";
$owl_lang->err_group_exists  		= "Nome di Gruppo gi&agrave; esistente.";
$owl_lang->err_gzip_not_found    	= "gzip non trovato in ";
$owl_lang->err_login  			= " ";
$owl_lang->err_movecancel      	= "Spostamento annullato<br />";
$owl_lang->err_nameempty      	= "Il nome della cartella non pu&ograve; essere vuoto";
$owl_lang->err_news_required  	= "ERRORE: Specificare intestazione e contenuto della News!";
$owl_lang->err_no_access   		= "Non hai i diritti di accesso per almeno uno dei Documenti selezionati";
$owl_lang->err_no_access_info   	= "Possibili cause: <br />1) Non hai selezionato alcuna checkbox davanti al documento o alla cartella<br />2) Elimina selezionati, Email selezionati, Blocca selezionati non applicabile alle Cartelle<br />3) Non hai accesso ai documenti o folders selezionati.";
$owl_lang->err_noemail  		= "Non hai i permessi per inviare questo documento";
$owl_lang->err_nofileaccess  		= "Non hai permessi di accesso al documento";
$owl_lang->err_nofiledelete  		= "Non hai permessi di cancellazione su questo documento";
$owl_lang->err_nofilemod  		= "Non hai permessi di modifica su questo documento";
$owl_lang->err_nofolderaccess  	= "Non hai permessi di accesso alla cartella";
$owl_lang->err_nofolderdelete  	= "Non hai permessi di cancellazione in questa cartella";
$owl_lang->err_nofoldermod  		= "Non hai permessi di modifica su questa cartella";
$owl_lang->err_nosubfolder  		= "Non hai permessi di scrittura in questa cartella";
$owl_lang->err_not_zip  		= "Archivio zip non valido";
$owl_lang->err_note_title           = "Il campo Title &egrave; obbligatorio";
$owl_lang->err_note_title_exists    = "Una Nota con questo nome gi&agrave; esiste";
$owl_lang->err_noupload  		= "Non hai permessi di scrittura in questa cartella";
$owl_lang->err_pass_missmatch  	= "La Nuova Password e la Password di Conferma non sono uguali";
$owl_lang->err_pass_wrong      	= "La vecchia password &egrave; sbagliata";
$owl_lang->err_please_select_bulk  	= "Selezionare almeno un Documento o una cartella utilizzando la checkbox";
$owl_lang->err_pod2html_not_found   = "ERRORE: Non trovo il tool pod2html :";
$owl_lang->err_quota  			= "Non ti &egrave; rimasto abbastanza spazio di memorizzazione su disco per aggiungere questo documento : ";
$owl_lang->err_quota_avail  		= " disponibile.";
$owl_lang->err_quota_exceed    	= "Hai esaurito il tuo spazio di memorizzazione";
$owl_lang->err_quota_needed  		= " necessario ";
$owl_lang->err_req  			= "ERRORE: Tutti i campi sono obbligatori";
$owl_lang->err_root_delete  		= "La cartella base non pu&ograve; essere cancellato";
$owl_lang->err_select_reviewer  	= "Seleziona almeno una Persona come revisore del tuo documento";
$owl_lang->err_sess_notvalid   	= "Identificativo di sessione non valido ";
$owl_lang->err_sess_write  		= "Si &egrave; verificato un errore : scrittura della sessione sul RDBMS";
$owl_lang->err_specialfoldername   	= "'backup' &egrave; un nome di cartella riservato a Owl, scegli un altro nome";
$owl_lang->err_sql  			= "SQL error";
$owl_lang->err_tar_not_found    	= "tar non trovato in ";
$owl_lang->err_trash_can_empty   	= "Il cestino &egrave; vuoto";
$owl_lang->err_unauth_area     	= "Non sei autorizzato ad utilizzare quest'area";
$owl_lang->err_unauthorized    	= "Non autorizzato ";
$owl_lang->err_update_file_lock     = "Non puoi aggiornare questo documento, perchË Ë attualmente bloccato da";
$owl_lang->err_upload   		= "Errore di Caricamento";
$owl_lang->err_user_exists  		= "Identificativo utente gi&agrave; esistente";
$owl_lang->err_group_delete             = "Can't delete this Group: <font color=\"red\">%d</font> File(s),  <font color=\"red\">%d</font> Folder(s), <font color=\"red\">%d</font> User(s) with this Primary group, <font color=\"red\">%d</font> User(s) that are a member of this group";
$owl_lang->err_captcha_auth  = "CAPTCHA autenticazione fallita";
 
//******************************************************** 
// Error Messages END 
//******************************************************** 
 
$owl_lang->actionbtn_main_menu         = "Men&ugrave; Principale";
$owl_lang->btn_add_field          = "Aggiungi Campo";
$owl_lang->btn_add_file           = "Aggiungi Documento";
$owl_lang->btn_add_folder         = "Aggiungi Cartella";
$owl_lang->btn_add_news           = "Aggiungi News";
$owl_lang->btn_add_note           = "Aggiungi Annotazione";
$owl_lang->btn_add_url            = "Aggiungi URL";
$owl_lang->btn_add_zip            = "Aggiungi Archivio Zippato";
$owl_lang->btn_admin       		= "Admin";
$owl_lang->btn_admin_groups         = "Nuovo Gruppo";
$owl_lang->btn_admin_news           = "Notizie";
$owl_lang->btn_admin_user_group     = "Amministrazione Utenti/Gruppi";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Nuovo Utente";
$owl_lang->btn_back           	= "Torna indietro";
$owl_lang->btn_browse      		= "Sfoglia";
$owl_lang->btn_bulk_checkout        = "Blocca selezionati";
$owl_lang->btn_bulk_delete          = "Elimina selezionati";
$owl_lang->btn_bulk_download        = "Download selezionati";
$owl_lang->btn_bulk_email           = "Email selezionati";
$owl_lang->btn_bulk_move            = "Sposta selezionati";
$owl_lang->btn_cancel           	= "Cancella";
$owl_lang->btn_clickhere            = "Clicca qu&igrave;";
$owl_lang->btn_collapse_view        = "Riduci Visualizzazione";
$owl_lang->btn_create           	= "Crea";
$owl_lang->btn_default_view         = "Vista di default";
$owl_lang->btn_deldoctype           = "Elimina tipologia di documento";
$owl_lang->btn_download_bulk_package  = "Per scaricare il tuo bulk download package";
$owl_lang->btn_edit_group           = "Edita Gruppo";
$owl_lang->btn_edit_user           	= "Edita Utente";
$owl_lang->btn_expand_view          = "Espandi Visualizzazione";
$owl_lang->btn_go_bottom       	= "Vai in fondo";
$owl_lang->btn_go_top       		= "Vai in cima";
$owl_lang->btn_help      		= "Aiuto";
$owl_lang->btn_import_users   	= "Importa Utenti";
$owl_lang->btn_login           	= "Accedi";
$owl_lang->btn_logout      		= "Disconnetti";
$owl_lang->btn_mail_tool      	= "Email";
$owl_lang->btn_register           	= "Registra";
$owl_lang->btn_reset           	= "Reset";
$owl_lang->btn_send_email           = "Invia Email";
$owl_lang->btn_submit           	= "Invia";
$owl_lang->alt_btn_submit          = "Invia modulo";
$owl_lang->btn_thumb_view           = "Vista miniature";
$owl_lang->btn_trash_admin          = "Cestino";
$owl_lang->btn_gen_pdf          = "Genera PDF";
$owl_lang->btn_export           = "Esporta";
$owl_lang->user_tool_menu_label         = "Strumenti utente";
$owl_lang->admins_tool_menu_label       = "Strumenti admin";
 
//******************************************************** 
// Image Alternate popup Messages BEGIN 
//******************************************************** 
 
$owl_lang->alt_updated          = "Il documento &egrave; stato aggiornato dalla tua ultima visita";
$owl_lang->alt_indexed          = "Il documento &egrave; stato indicizzato ed il suo contenuto &egrave; ricercabile";
$owl_lang->alt_new              = "Il documento &egrave; stato creato dopo la tua ultima visita";
$owl_lang->alt_gen_pdf          = "Genera la versione PDF del file";
$owl_lang->alt_add_comments     = "Aggiungi un commento";
$owl_lang->alt_add_field  	= "Aggiungi il Campo sopra";
$owl_lang->alt_add_group  	= "Crea questo Gruppo";
$owl_lang->alt_add_news  	= "Aggiungi una nuova Notizia";
$owl_lang->alt_add_user  	= "Crea questo Utente";
$owl_lang->alt_admin_flush    = "Elimina le sessioni bloccate o scadute";
$owl_lang->alt_admin_groups  	= "Crea un nuovo Gruppo";
$owl_lang->alt_admin_users  	= "Crea un nuovo  Utente";
$owl_lang->alt_approve_file   = "Approva questo Documento";
$owl_lang->alt_back        	= "Ritorna alla schermata precedente";
$owl_lang->alt_btn_add_file   = "Aggiungi nuovo Documento";
$owl_lang->alt_btn_add_folder = "Crea nuova Cartella";
$owl_lang->alt_btn_add_note   = "Aggiungi una nuova Nota";
$owl_lang->alt_btn_add_url  	= "Aggiungi un nuovo Web link";
$owl_lang->alt_btn_add_zip    = "Carica un archivio zippato da estrarre";
$owl_lang->alt_btn_admin   	= "Amministrazione di DMS";
$owl_lang->alt_btn_browse  	= "Ritorna al Browser dei documenti";
$owl_lang->alt_btn_bulk_checkout = "Blocco dei documenti selezionati";
$owl_lang->alt_btn_bulk_delete   = "Cancellazione dei documenti selezionati";
$owl_lang->alt_btn_bulk_download = "Download dei documenti selezionati";
$owl_lang->alt_btn_bulk_email    = "Invia tramite Email i documenti selezionati";
$owl_lang->alt_btn_bulk_move     = "Sposta documenti e cartelle selezionati";
$owl_lang->alt_btn_clickhere  	= "Clicca qui";
$owl_lang->alt_btn_collapse_view 	= "Vista ridotta";
$owl_lang->alt_btn_default_view  	= "Passa alla vista di default";
$owl_lang->alt_btn_expand_view   	= "Vista estesa";
$owl_lang->alt_btn_help  		= "Help Online";
$owl_lang->alt_btn_login  		= "Accedi a DMS";
$owl_lang->alt_btn_logout  		= "Disconnetti da DMS";
$owl_lang->alt_btn_mail_tool     	= "Simple Email Tool";
$owl_lang->alt_btn_thumb_view    	= "Passa alla visualizzazione a miniature";
$owl_lang->alt_cancel  			= "Cancella questa azione";
$owl_lang->alt_cancel_move  		= "Annulla azione Muovi";
$owl_lang->alt_change  			= "Aggiorna questa riga";
$owl_lang->alt_comments   		= "Ci sono Commenti per questo documento";
$owl_lang->alt_copy_file       	= "Copia Documento";
$owl_lang->alt_copy_folder     	= "Copia Cartella";
$owl_lang->alt_del_all  		= "Svuota Cestino";
$owl_lang->alt_edt_comments     = "Edita commento";
$owl_lang->alt_del_comments      	= "Cancella questo commento";
$owl_lang->alt_del_field  		= "Cancella questo campo";
$owl_lang->alt_del_file        	= "Elimina documento (S/N)";
$owl_lang->alt_del_folder      	= "Elimina cartella (S/N)";
$owl_lang->alt_del_group  		= "Cancella questo gruppo";
$owl_lang->alt_del_news  		= "Cancella questa notizia";
$owl_lang->alt_del_selected  		= "Cancella i documenti selezionati";
$owl_lang->alt_del_this_folder  	= "Cancella cartella&#8211; ";
$owl_lang->alt_del_user  		= "Cancella questo utente";
$owl_lang->alt_deldoctype  		= "Cancella il tipo documento corrente";
$owl_lang->alt_edit_field  		= "Edita questa definizione di campo";
$owl_lang->alt_edit_group        	= "Modifica il gruppo selezionato";
$owl_lang->alt_edit_news  		= "Modifica questa notizia";
$owl_lang->alt_edit_user         	= "Modifica l'utente selezionato";
$owl_lang->alt_email  			= "Invia documento tramite email";
$owl_lang->alt_email_reminder   	= "Promemoria Email";
$owl_lang->alt_email_selected  	= "Email dei Documenti selezionati"; 
$owl_lang->alt_get_file        	= "Scarica Documento";
$owl_lang->alt_get_folder        	= "Scarica il contenuto della cartella";
$owl_lang->alt_go_bottom        	= "Vai a fondo pagina";
$owl_lang->alt_go_top   		= "Torna s&ugrave;";
$owl_lang->alt_have_news  		= "Hai delle segnalazioni da vedere";
$owl_lang->alt_have_no_news  		= "Nessuna segnalazione da vedere";
$owl_lang->alt_home_folder  		= "Torna alla cartella iniziale";
$owl_lang->alt_link_file       	= "Collega questo documento ad un'altra cartella";
$owl_lang->alt_lock_file         	= "Blocca documento";
$owl_lang->alt_log_clear         	= "Cancella tutti i log (S/N)";
$owl_lang->alt_log_file          	= "File log";
$owl_lang->alt_log_next  		= "Successivi";
$owl_lang->alt_log_prev  		= "Visualizza precedenti";
$owl_lang->alt_log_top  		= "Vai al primo";
$owl_lang->alt_mod_file        	= "Modifica propriet&agrave; documento";
$owl_lang->alt_mod_folder      	= "Modifica propriet&agrave; cartella";
$owl_lang->alt_monitor  		= "Monitora questo documento";
$owl_lang->alt_monitor_folder    	= "Monitora questa cartella";
$owl_lang->alt_monitored  		= "Smetti di monitorare questo documento";
$owl_lang->alt_monitored_folder  	= "Smetti di monitorare questa cartella";
$owl_lang->alt_move_file       	= "Sposta documento";
$owl_lang->alt_move_folder     	= "Sposta cartella";
$owl_lang->alt_move_selected  	= "Muovi tutti i documenti selezionati";
$owl_lang->alt_my_approval  		= "Documento(i) in attesa della mia approvazione";
$owl_lang->alt_new_doctype  		= "Crea una nuova tipologia di documento";
$owl_lang->alt_news_close  		= "Chiudi la finestra notizie";
$owl_lang->alt_news_next  		= "Visualizza prossima notizia";
$owl_lang->alt_news_prev  		= "Visualizza notizia precedente ";
$owl_lang->alt_news_print  		= "Stampa questa notizia ";
$owl_lang->alt_pending_approval  	= "Documento(i) in attesa di approvazione";
$owl_lang->alt_play_file   		= "Play";
$owl_lang->alt_publish_file   	= "Rendi pubblico il documento";
$owl_lang->alt_recycle  		= "Il tuo Cestino &egrave; vuoto";
$owl_lang->alt_recycle_disable  	= "Il cestino &egrave; disabilitato";
$owl_lang->alt_recycle_not_found 	= "Cestino non trovato";
$owl_lang->alt_refresh_filter  	= "Inizia filtraggio / refresh ";
$owl_lang->alt_register  		= "Conferma registrazione";
$owl_lang->alt_reject_file   		= "Respingi questo documento";
$owl_lang->alt_related  		= "Trova documenti correlati";
$owl_lang->alt_reset_form  		= "Resetta form";
$owl_lang->alt_rest_selected  	= "Ripristina i documenti selezionati";
$owl_lang->alt_search  			= "Inizia ricerca";
$owl_lang->alt_send_email  		= "Invia Email";
$owl_lang->alt_sendfile  		= "Invia documento";
$owl_lang->alt_set_initial_dir  	= "Imposta la cartella corrente come cartella di partenza";                                                                                                
$owl_lang->alt_site_map          	= "Mappa del sito";
$owl_lang->alt_submit        		= "Invia form";
$owl_lang->alt_toggle_check_box  	= "Seleziona check box";
$owl_lang->alt_tool_status_green 	= "Tool attivato";
$owl_lang->alt_tool_status_red  	= "Il path non &egrave; corretto e/o  non &egrave; eseguibile";
$owl_lang->alt_unlock_file       	= "Sblocca documento";
$owl_lang->alt_upd_field  		= "Aggiorna campo";
$owl_lang->alt_upd_file        	= "Aggiorna documento";
$owl_lang->alt_view_comments     	= "Aggiungi / Visualizza commenti";
$owl_lang->alt_view_file       	= "Visualizza documento";
// NEW STUFF BEGIN 
$owl_lang->alt_btn_trash_admin  	= "Opzioni Cestino";
$owl_lang->alt_edit_file_inline  	= "Edita documento di testo";
// NEW STUFF END 
 
 
//******************************************************** 
// Image Alternate popup Messages END 
//******************************************************** 
 
 
//******************************************************** 
// Owl Logging messages BEGIN 
//******************************************************** 
 
$owl_lang->log_del_det  = "Contenuto gi&agrave; cancellato";
$owl_lang->log_detail   = "Nessun dettaglio disponibile.";
$owl_lang->log_file_to  = "A: ";
$owl_lang->log_filter_all  = "Tutti";
$owl_lang->log_login_det  = "Nome utente: ";
 
// BEGIN NEW STUFF 
$owl_lang->log_admin_changed_group  = "Changed Group: ";
$owl_lang->log_admin_changed_user   = "Changed User: ";
$owl_lang->log_admin_created_group  = "Created Group: ";
$owl_lang->log_admin_created_user   = "Created User: ";
$owl_lang->log_admin_del_group  	= "Deleted Group: ";
$owl_lang->log_admin_del_user  	= "Deleted User: ";
$owl_lang->log_admin_disabled  	= " Disabled User: ";
$owl_lang->log_admin_email_restore  = "Documenti mailed:";
$owl_lang->log_admin_trash_delfile 	= "Deleted File: ";
$owl_lang->log_admin_trash_delfold  = "Deleted Folder: ";
$owl_lang->log_admin_trash_empty  	= "Trash Can Emptied";
$owl_lang->log_admin_trash_restore  = "Restored: ";
$owl_lang->log_login_expired     	= "Expired User: ";
$owl_lang->log_login_too_many_attempts  = "Disabled (Too Many Failed Login): ";
$owl_lang->log_readhd_feature_add   = "Read HD Feature Added this file";
$owl_lang->log_admin_to  = "to";
$owl_lang->log_admin_of  = "of";
// END NEW STUFF 
 
$log_file_actions[1]           = "LOGIN";
$log_file_actions[10]          = "DOCUMENTO SBLOCCATO";
$log_file_actions[11]          = "DOCUMENTO SPEDITO";
$log_file_actions[12]          = "DOCUMENTO SPOSTATO";
$log_file_actions[13]          = "CARTELLA CREATA";
$log_file_actions[14]          = "CARTELLA CANCELLATA";
$log_file_actions[15]          = "CARTELLA MODIFICATA";
$log_file_actions[16]          = "CARTELLA SPOSTATA";
$log_file_actions[17]          = "PASS PERDUTA";
$log_file_actions[18]          = "USER REG";                                                                                                                                       
$log_file_actions[19]          = "DOCUMENTO VISUALIZZATO";
$log_file_actions[2]           = "LOGIN FALLITO";
$log_file_actions[20]          = "DOCUMENTO VIRUS";
$log_file_actions[21]          = "DOCUMENTO COPIATO";
$log_file_actions[22]          = "CARTELLA COPIATA";
$log_file_actions[23]          = "DOCUMENTO COLLEGATO";
$log_file_actions[3]           = "LOGOUT";
$log_file_actions[4]           = "DOCUMENTO CANCELLATO";
$log_file_actions[5]           = "CARICA DOCUMENTO";
$log_file_actions[6]           = "DOCUMENTO AGGIORNATO";
$log_file_actions[7]           = "DOCUMENTO SCARICATO";
$log_file_actions[8]           = "DOCUMENTO CAMBIATO";
$log_file_actions[9]           = "DOCUMENTO BLOCCATO";
 
// BEGIN NEW STUFF 
$log_file_actions[24]            = "USER ADMIN";
$log_file_actions[25]            = "CESTINO";
$log_file_actions[26]            = "DOCUMENTO ACL";
$log_file_actions[27]            = "CARTELLA ACL";
$log_file_actions[28]           = "CARTELLA DISTRIBUITA";
$log_file_actions[29]           = "CARTELLA COLLEGATA";
$log_file_actions[30]           = "FILE REVISIONATO";
$log_file_actions[31]           = "FILE APPROVATO";
$log_file_actions[32]           = "FILE RIFIUTATO";
$log_file_actions[33]           = "FILE PUBBLICATO";
// END NEW STUFF 
 
 
//******************************************************** 
// Owl Logging messages END 
//******************************************************** 
 
 
//******************************************************** 
// index.php  BEGIN 
//******************************************************** 
 
// BEGIN NEW STUFF 
$owl_lang->admin_login_date   = "The admin user logged in on: ";
$owl_lang->admin_login_from   = "The admin user logged in from";
$owl_lang->admin_login_subject   = "ADMIN USER LOGGIN";
// END NEW STUFF 
$owl_lang->anonymous    = "(Accesso Anonimo)";
$owl_lang->engine   	= "DMS Engine";
$owl_lang->forgot_pass  = "Hai smarrito la tua Password?";
$owl_lang->like_register  = "Vuoi registrarti?";
$owl_lang->login  	= "Accedi";
$owl_lang->logindisabled  = "Account DISABILITATO, contatta il System Administrator";
$owl_lang->loginfail  	= "Errore di login";
$owl_lang->password  	= "Password";
$owl_lang->repository_list    = "Repository:";
$owl_lang->successlogout  	= "Logout completato";
$owl_lang->toomanysessions  	= "Numero massimo di sessioni per utente raggiunto, contatta l'assistenza ";
$owl_lang->username  		= "Utente";
$owl_lang->forgot_username  	= "Utente";
$owl_lang->version   		= "Versione";
 
//******************************************************** 
// index.php  END 
//******************************************************** 
 
 
//******************************************************** 
// browse.php  BEGIN 
//******************************************************** 
 
$owl_lang->actions   		= "Azioni";
$owl_lang->current_db   	= "Repository corrente:";
$owl_lang->current_folder   	= "Cartella corrente:";
$owl_lang->del_all  		= "Svuota Cestino";
$owl_lang->del_selected  	= "Cancella Selezione";
$owl_lang->disk_quota  		= "Quota disco";
$owl_lang->doc_number   	= "Doc #";
$owl_lang->email_selected  	= "Invia Email ai selezionati";
$owl_lang->file   		= "Documento";
$owl_lang->folder_count_file  = "Documento(i)";
$owl_lang->folder_count_folder  = "Cartella(e)";
$owl_lang->folder_count_note  = "Note(s)";
$owl_lang->folder_count_pre  	= "Questa Cartella contiene";
$owl_lang->folder_count_url  	= "URL(s)";
$owl_lang->folder_policy   	= "Policy per la Cartella corrente:";
$owl_lang->held               = "Bloccato da"; // for version control
$owl_lang->last_logged  	= "Ultima visita: ";
$owl_lang->menu_file_action  	= "Azioni disponibili per i documenti";                                                
$owl_lang->menu_folder_action  = "Azioni disponibili per le cartelle";
$owl_lang->menu_url_action  	= "Azioni disponibili per gli URL";
$owl_lang->modified   		= "Modificato";
$owl_lang->move_selected  	= "Muovi Selezione";
$owl_lang->new_file  		= "Nuovo!";
$owl_lang->no_description  	= "Nessuna Descrizione";
$owl_lang->owner                = "User";
$owl_lang->page  		= "Pagina:";
$owl_lang->panel_file_info  	= "Informazioni sui Documenti";
$owl_lang->postedby   		= "Creato da";
$owl_lang->reallydelete  	= "Conferma cancellazione";
$owl_lang->reallydelete_logs  	= "Conferma cancellazione del Log File";
$owl_lang->reallydelete_selected= "Conferma cancellazione dei Documenti selezionati";
$owl_lang->reallyrestore_selected = "Effettivo Ripristino di tutti i Documenti selezionati";
$owl_lang->rest_selected  	= "Ripristina gli oggetti selezionati";
$owl_lang->score  		= "Punteggio";
$owl_lang->size   		= "Dimensione";;
$owl_lang->updated_by           = "Aggiornato da";
$owl_lang->title   		= "Titolo";
$owl_lang->tot_files  		= "Totale:";
$owl_lang->tot_monitored  	= "Monitorati:";
$owl_lang->tot_my_checked_out   = "Bloccati:";
$owl_lang->tot_my_files  	= "Miei:";
$owl_lang->tot_my_group  	= "Gruppo:";
$owl_lang->tot_new_files  	= "Nuovi:";
$owl_lang->tot_updated_files    = "Modificati:";
$owl_lang->updated_file  	= "Modificato!";
$owl_lang->user                 = "Utente";
$owl_lang->ver                  = "Rev."; // for version control
$owl_lang->past_number          = "Giorni passati :";
 
// NEW STUFF 
$owl_lang->favorite_label = "Etichetta:";
$owl_lang->favorite  	        = "Favoriti";
$owl_lang->favorite_add  	= "Aggiungi corrente";
$owl_lang->favorite_delete  	= "Cancella";
$owl_lang->favorite_go  	= "Vai";
$owl_lang->files_in_my_group_title  = "Documenti nel mio gruppo(i)";
$owl_lang->my_files_title 		= "Miei documenti";
$owl_lang->my_monitored_title 	= "Miei documento(i)/cartella(e) monitorati";
$owl_lang->my_special_access_title 	= "Special access list";
$owl_lang->special_access_count 	= "Accessi speciali:";
$owl_lang->special_access_count_alt = "Accessi speciali documenti/cartelle";
// END NEW STUFF 
 
//******************************************************** 
// browse.php  END 
//******************************************************** 
 
 
//******************************************************** 
// modify.php  BEGIN 
//******************************************************** 
 
//$owl_lang->none_selected    = "NESSUNA SELEZIONE EFFETTUATA";
$owl_lang->adding_comments    = "Aggiungi / Visualizza commenti : ";
$owl_lang->addingfile   	= "Aggiungi documento a ";
$owl_lang->addingfolder   	= "Aggiungi cartella a ";
$owl_lang->attach_file 		= "Allega documento";
$owl_lang->change  		= "Cambia";
$owl_lang->comments        	= "Commenti";
$owl_lang->comments_added        = "Commento aggiunto da: ";
$owl_lang->create  		= "Crea";
$owl_lang->description   	= "Descrizione";
$owl_lang->disp_mp3  		= "MP3&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Song:<br />Album:<br />Bitrate&amp;nbsp;-&amp;nbsp;Samplerate:<br />Duration:<br />Genre:<br />Commenti:";
$owl_lang->email_body  		= "Messaggio";
$owl_lang->email_cc            = "CC";
$owl_lang->email_reply_to  	= "Rispondi a:";
$owl_lang->email_subject  	= "Oggetto";
$owl_lang->email_to  		= "Invia mail";
$owl_lang->emailing  		= "Invio in corso...";
$owl_lang->keywords   		= "Chiavi di ricerca";
$owl_lang->saved_keywords       = "Parole chiave salvate:";
$owl_lang->modify_url  		= "URL";
$owl_lang->modifying  		= "Modifica ";
$owl_lang->name                 = "Nome";                                                                                                                                                   
$owl_lang->none_selected         = "Nessuna selezione";
$owl_lang->note_content          = "Contenuto della nota";
$owl_lang->notify_link           = "Link Esterno:";
$owl_lang->ownergroup           = "Proprietario (Gruppo)";
$owl_lang->ownership  		= "Proprietario";
$owl_lang->permissions   	= "Permessi";
$owl_lang->pick_select  	= "&#8212; Seleziona Utente&#8212;";
$owl_lang->policy   		= "Permessi";
$owl_lang->post_comment  	= "Aggiungi commento";
$owl_lang->prop_permissions   = "Propagare i permessi alle sottodirectory?";
$owl_lang->prop_perms_files   = "Permessi da propagare ai file";
$owl_lang->sendfile   		= "Manda file";
$owl_lang->sendthisfile   	= "Manda questo file";
$owl_lang->sendthisurl         = "Manda questo URL";
$owl_lang->updating  		= "Modifica in corso";
$owl_lang->verdescription   	= "Descrizione<br />dei cambiamenti";
$owl_lang->vermajor            = "Revisione";
$owl_lang->verminor            = "Versione";
$owl_lang->vertype             = "Tipo di Revisione ";  // for modify.php when uploading
$owl_lang->document_text = "Contenuto";  
$owl_lang->save_keyword        = "Salvare parole chiave?";
$owl_lang->archive_skip_file    = "SALTATO: ";
$owl_lang->archive_skip_message = "I seguenti file sono stati saltati in quanto già esistono";
$owl_lang->archive_extract_current  = "Estrarre in questa cartella?";
$owl_lang->archive_extract_overwrite  = "Sovrascrivere i file esistenti (Aggiornamento)?";
$owl_lang->optional_file_index  = "Indicizzare il file?:";


 
//******************************************************** 
// modify.php  END 
//******************************************************** 
 
 
//******************************************************** 
// register.php  BEGIN 
//******************************************************** 
 
$owl_lang->email               = "Email ";
$owl_lang->full_name  		= "Nome Completo";
$owl_lang->register  		= "Registrazione utente";
$owl_lang->self_failed  	= "Fallito";
$owl_lang->self_passwd  	= "Password inviata a:";
$owl_lang->self_reg_bod  	= "Password DMS:";
$owl_lang->self_reg_rset  	= "Password DMS resettata a:";
$owl_lang->self_reg_subj  	= "Identificativo Utente DMS";
$owl_lang->send_pass  		= "Invia Password";
$owl_lang->submit  		= "Conferma";
$owl_lang->thank_you_1  	= "Grazie!";
$owl_lang->thank_you_2 	= "Ti arriver&agrave; una email<br /> con la NUOVA password per <br /><b>l'UTENTE:</b>";
$owl_lang->thank_you_3          = "Your account needs to be enabled by the administrator before you can log in.";

//NEW STUFF 
 
$owl_lang->captcha_typein         	= "Digita i 5 caratteri";
$owl_lang->change_pass_title        = "CAMBIA PASSWORD";
$owl_lang->err_cant_reuse_passwords    = "Non puoi riutilizzare la vecchia passwords";
$owl_lang->err_new_confirm_different   = "La nuova password e la password di conferma non coincidono <br />";
$owl_lang->err_old_pass_ver_failed     = "La tua vecchia password non &egrave; corretta <br />";
$owl_lang->err_pass_restriction_1      = "La tua password deve essere lunga almeno '$default->min_pass_length' caratteri<br />";
$owl_lang->err_pass_restriction_2      = "contenere almeno '$default->min_pass_numeric' carattere numerico [0-9] <br />";
$owl_lang->err_pass_restriction_3      = "ed almeno '$default->min_pass_special' carattere speciale [ ~!@#$%^&*()-=+_|{}][\";:<>.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Your chosen username '%s' is %d chars long, and has to be at least %d characters long.";
$owl_lang->pass_change_email_1         = "La tua Password non &egrave; stata cambiata perch&egrave; non stai utilizzando la DMS Authentication";
$owl_lang->pass_change_email_2         = "Il tuo tipo di Autenticazione &egrave;: ";
$owl_lang->pass_change_email_3         = "Contattare il tuo System Administrator";
 
// END NEW STUFF 
 
//******************************************************** 
// register.php  END 
//******************************************************** 
 
 
//******************************************************** 
// move.php  BEGIN 
//******************************************************** 
 
$owl_lang->cancel_button  	= "Annulla";
$owl_lang->copy_file  		= "Copiatura file";
$owl_lang->copy_folder  	= "Copiatura cartella";
$owl_lang->moving  		= "Spostamento in corso";
$owl_lang->moving_file  	= "Spostamento documento";
$owl_lang->moving_folder  	= "Spostamento cartella";
$owl_lang->select  		= "Seleziona la cartella di destinazione:";
 
//******************************************************** 
// move.php  END 
//******************************************************** 
 
 
//******************************************************** 
// log.php  BEGIN 
//******************************************************** 
 
$owl_lang->viewlog  = "Visualizzazione Log Per ";
// BEGIN NEW STUFF 
$owl_lang->diff_from  = "Diff From";
$owl_lang->diff_to  = "Diff To";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF 
 
 
//******************************************************** 
// log.php  END 
//******************************************************** 
 
 
//******************************************************** 
// prefs.php  BEGIN 
//******************************************************** 
 
$owl_lang->comment_notif = "Notifica dei Commenti ";
$owl_lang->confpassword  = "Conferma nuova Password";
$owl_lang->email_tool  = "Email Tool";
$owl_lang->group  = "Gruppo";
$owl_lang->groupmember  = "Membro";
$owl_lang->last_modified = "Modificato per ultimo";
$owl_lang->newpassword  = "Nuova Password";
$owl_lang->newsadmin  = "Amministratore Notizie";
$owl_lang->not_member  = "Non sei membro di alcun altro gruppo";
$owl_lang->notification  = "Ricevi Notifiche";
$owl_lang->oldpassword  = "Vecchia Password";
$owl_lang->preference  = "Preferenze";
$owl_lang->saved  = "Cambiamenti effettuati";
$owl_lang->status_no  = "No";
$owl_lang->status_yes  = "S&Igrave;";
$owl_lang->userlang  = "Lingua";
 
//NEW STUFF 
$owl_lang->useradmin  = "User Administrator";
$owl_lang->viewlogs      = "Puoi vedere i System Logs";
$owl_lang->viewreports   = "Puoi vedere i System Reports";
//NEW STUFF END 

$owl_lang->owl_prefs_phone = "Telefono";
$owl_lang->owl_prefs_department = "Dipartimento";
$owl_lang->owl_prefs_address = "Indirizzo";
$owl_lang->owl_prefs_note = "Note";
 
//******************************************************** 
// prefs.php  END 
//******************************************************** 
 
 
//******************************************************** 
// search.php  BEGIN 
//******************************************************** 
 
$owl_lang->elapsed_time         = "tempo trascorso";
$owl_lang->query_empty         = "Svuota stringa di ricerca";
$owl_lang->related_query_empty   = "Non ci sono metadati associati al documento per eseguire 'Ricerca Correlati'";
$owl_lang->search               = "Ricerca";
$owl_lang->search_all_word  = "Tutte le parole";
$owl_lang->search_any_word  = "Qualsiasi parola";
$owl_lang->search_currentfolder  = "Cerca nella cartella corrente";
$owl_lang->search_entire_phrase  = "Frase intera";
$owl_lang->search_exact_match   = "Corrispondenza esatta";
$owl_lang->search_stats_with    = "Inizia con";
$owl_lang->search_ends_with     = "Finisce con";
$owl_lang->search_for_files   = "Cerca per Documenti";
$owl_lang->search_for_folders   = "Cerca per Cartelle";
$owl_lang->search_match   = "Corrispondenza:";
$owl_lang->search_results_for  = "Risultati Ricerca per";
$owl_lang->search_score   = "Valutazione Documenti";
$owl_lang->search_winthindocs    = "Cerca all'interno";
 
//******************************************************** 
// search.php  END 
//******************************************************** 
 
 
//******************************************************** 
// view.php  BEGIN 
//******************************************************** 
 
$owl_lang->viewing  = "Visualizzazione in corso ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";
 
//******************************************************** 
// view.php  END 
//******************************************************** 
 
 
//******************************************************** 
// admin/index.php  BEGIN 
//******************************************************** 
 
$owl_lang->add  					= "Aggiungi";
$owl_lang->edit_user                    = "***** Modifica Utente *****";
$owl_lang->edit_group                   = "***** Modifica Gruppo *****";
$owl_lang->enter_new_user               = "***** Aggiunta Utente *****";
$owl_lang->enter_new_group              = "***** Aggiunta Nuovo Gruppo *****";
$owl_lang->info_panel_width             = "Visualizza il pannello informazioni sui files espanso";
$owl_lang->allow_track_favorite         = "Permetti agli utenti di tracciare i favoriti";
$owl_lang->admin_login_to_browse_page  	= "All'accesso l'admin accede direttamente alla documents";
$owl_lang->alt_btn_backup  			= "Backup SQL Database";
$owl_lang->alt_btn_doctype_admin  		= "Document Type Administrator";
$owl_lang->alt_btn_html_prefs  		= "Edita Preferenze HTML";
$owl_lang->alt_btn_initial_load  		= "Load DB From Documents Folder";
$owl_lang->alt_btn_log_viewer  		= "Log di sistema";
$owl_lang->alt_btn_news_admin  		= "Owl News Administrator";
$owl_lang->alt_btn_site_features 		= "Edita impostazioni e settaggi";
$owl_lang->alt_btn_statistics_viewer  	= "Statistiche";
$owl_lang->alt_btn_trashcan  			= "Clicca per visualizzare il contenuto del cestino";
$owl_lang->alt_btn_users_groups  		= "Amministrazione Utenti e Gruppi";
$owl_lang->anonymous_account  		= "Account per Accesso Anonimo:";
$owl_lang->btn_backup  				= "Backup<br />Database";
$owl_lang->btn_doctype_admin  		= "Tipologie<br />documenti";
$owl_lang->btn_html_prefs  			= "Preferenze<br />HTML";
$owl_lang->btn_initial_load  			= "Caricamento iniziale";
$owl_lang->btn_log_viewer  			= "Log<br />visualizzatore";
$owl_lang->btn_news_admin  			= "News<br />admin";
$owl_lang->btn_site_features  		= "Impostazioni<br />Sito";
$owl_lang->btn_statistics_viewer  		= "Visualizzatore<br />Statistiche / Report";
$owl_lang->btn_trashcan  			= "Cestino";
$owl_lang->btn_users_groups  			= "Utenti e<br />Gruppi";
$owl_lang->buttonstyle                   	= "Template";
$owl_lang->confirm_initial_load  		= "*** AVVISO ***  Questo dovrebbe essere eseguito una sola volta quando il database &egrave; vuoto";
$owl_lang->confirm_maint_mode           = "Sei sicuro di voler impostare la modalit&agrave; di mantenimento? Questo impedir&agrave; agli untenti di loggarsi al sito.";
$owl_lang->deletegroup  			= "Cancella Gruppo";
$owl_lang->deleteuser  				= "Cancella Utente";
$owl_lang->disable_recs_per_page  		= "Enabling Restricted View Will DISABLE Records Per Page!";
$owl_lang->disableuser  			= "Disabilita Utente";
$owl_lang->display_password_override  	= "Mostra Documento/Cartella Password Override";
$owl_lang->doc_id_num_digits  		= "Doc# Numero di cifre da mostrare";
$owl_lang->doc_id_prefix  			= "Doc# Mostra Stringa Prefisso";
$owl_lang->docicon_column  			= "Doc Icon";
$owl_lang->download_folder_zip  		= "Scarica Cartella come ZIP (Default tar.gz)";
$owl_lang->file_admin_group  			= "File/Browser Admin Group:";
$owl_lang->flushed             		= "Tabella sessioni ripulita.<br />";
$owl_lang->groups  				= "Gruppi";
$owl_lang->hide_bulk_buttons  		= "Togli pulsanti funzionanti su pi&ugrave; documenti:";
$owl_lang->save_keywords_to_db  		= "Consente agli utenti di salvare le parole chiave da riusare";
$owl_lang->status_column  			= "Stato";
$owl_lang->vermajor_initial            	= "Revisione Iniziale";
$owl_lang->verminor_initial            	= "Versione Iniziale";
$owl_lang->view_doc_in_new_window  		= "Visualizza Documenti in una Nuova Finestra";
// Edit HTML Properties Messages BEGIN 
$owl_lang->ht_bd_bg_image  			= "Percorso immagine di background :";
$owl_lang->ht_bd_lnk_cl  			= "Colore Body Link :";
$owl_lang->ht_bd_txt_cl   			= "Colore Body Text :";
$owl_lang->ht_bd_vlnk_cl   			= "Colore Body Visited Link :";
$owl_lang->ht_collapse_width   		= "Larghezza Collapse View :";
$owl_lang->ht_expand_width  			= "Larghezza Expanded View :";
$owl_lang->ht_tbl_border_sz   		= "Table Border :";
$owl_lang->ht_tbl_cell_bg_al   		= "Table Cell Background Colour Alternativo:";
$owl_lang->ht_tbl_cell_bg_cl   		= "Table Cell Background Colour:";
$owl_lang->ht_tbl_hd_bg  			= "Header Background:";
// Edit Prefs Properties Messages END 
$owl_lang->anonymous_access  			= "Imposta accesso anonimo";
$owl_lang->header_group_admin            	= "Gestione Gruppi";
$owl_lang->header_sitefeatures_settings   = "Impostazioni e Settaggi";
$owl_lang->header_user_admin             	= "Gestione Utenti";
$owl_lang->hide_folder_doc_count  		= "Nascondi conteggio files/cartelle";                                                                                                                        
$owl_lang->hide_folder_size  			= "Nascondi dimensione cartella";
$owl_lang->hide_panel  				= "Nascondi";
$owl_lang->home_dir  				= "Cartella home:";
$owl_lang->initial_dir     			= "Cartella inziale";
$owl_lang->maxsessions  			= "Numero Massimo Sessioni";
$owl_lang->noprefaccess  			= "Disabilita Preferenze";
$owl_lang->old_action_icons  			= "Utilizza Icone pre OWL 0.80";
$owl_lang->owl_anon_download       		= "Scarica solamente";
$owl_lang->owl_anon_full  			= "Accesso completo";
$owl_lang->owl_anon_ro  			= "Imponi utente anonimo in sola lettura:";
$owl_lang->owl_dbdump_path     		= "Path DB Dump Tool :";
$owl_lang->owl_def_file_group_owner  	= "Gruppo proprietario Documento (Default) :";
$owl_lang->owl_def_file_meta  		= "Meta Dati Documento (Default) :";
$owl_lang->owl_def_file_owner  		= "Proprietario Documento (Default) :";
$owl_lang->owl_def_file_perm   		= "Policy Creazione Documento (Default):";
$owl_lang->owl_def_file_security  		= "Sicurezza Documento (Default) :";
$owl_lang->owl_def_file_title  		= "Nome Documento (Nessuno per Filename):";
$owl_lang->owl_def_fold_group_owner  	= "Gruppo proprietario Cartella (Default) :";
$owl_lang->owl_def_fold_owner  		= "Proprietario Cartella (Default) :";
$owl_lang->owl_def_fold_sec  			= "Sicurezza Cartella (Default) :";
$owl_lang->owl_def_folder_perm   		= "Policy Creazione Cartella (Default):";
$owl_lang->owl_default_tmpdir  		= "Posizione Directory Documenti Temporanei: ";
$owl_lang->owl_email_from  			= "From Address / SMTP Auth Login:";
$owl_lang->owl_email_fromname  		= "From Name:";
$owl_lang->owl_email_replyto  		= "Reply To Address:";
$owl_lang->owl_email_server  			= "SMTP Server:";
$owl_lang->owl_email_smtp  			= "Usa Mailing SMTP ";
$owl_lang->owl_email_smtp_auth  		= "Usa autenticazione SMTP ";
$owl_lang->owl_email_smtp_auth_login  	= "SMTP Auth Login:";
$owl_lang->owl_email_smtp_auth_passwd  	= "SMTP Password";
$owl_lang->owl_email_subject_pref  		= "Prefisso a oggetto email:";
$owl_lang->owl_fogotpass  			= "Mostra link per recupero PW dimenticata:";
$owl_lang->owl_group_user  			= "Membri di questo Gruppo";
$owl_lang->owl_gzip_path       		= "Path gzip :";
$owl_lang->owl_hidebackup  			= "Nascondi la Directory di Backup :";
$owl_lang->owl_log_file  			= "Registra attivit&agrave; su Documenti:";
$owl_lang->owl_log_login_act  		= "Registra attivit&agrave; su Login/Logout:";
$owl_lang->owl_log_rec_page  			= "Numero di righe di Log Per Pagina:";
$owl_lang->owl_logging  			= "Abilita Logging:";
$owl_lang->owl_logo  				= "Logo per Pagina di Login ([Language]/graphics):";
$owl_lang->owl_lookAtHD  			= "Disabilita visualizzazione HD:";
$owl_lang->owl_lookAtHDDel  			= "Rimuovi Documenti cancellati dal DB:";
$owl_lang->owl_max_filesize  			= "Max Dimensione di Upload :";
$owl_lang->owl_owl_expand  			= "Vista di Default Browser (Espandi):";
$owl_lang->owl_owl_timeout  			= "Timeout Sessione in Secondi:";
$owl_lang->owl_pdftotext_path  		= "Indicizzazione per <br />PDF e text Documenti <br />&#8211; Blank for Disabled:";
$owl_lang->owl_pod2html_path         	= "Perl 5.8.0 or Greater required<br />Path to pod2html:";
$owl_lang->owl_restrict_view  		= "Nascondi cartelle su cui non si hanno diritti:";
$owl_lang->owl_self_reg  			= "Abilita Autoregistrazione:";
$owl_lang->owl_self_reg_hd  			= "Impostazioni registrazione automatica";
$owl_lang->owl_tar_path       		= "Path tar :";
$owl_lang->owl_title_browser  		= "Caratteristiche DMS browser";
$owl_lang->owl_title_custom  			= "Personalizza colonne visualizzate";
$owl_lang->owl_title_custom_search   	= "Personalizza risultati ricerca";
$owl_lang->owl_title_defaults     		= "Defaults";
$owl_lang->owl_title_email  			= "Impostazioni email";
$owl_lang->owl_title_HD  			= "Look at HD for new file settings";
$owl_lang->owl_title_logging    		= "Impostazioni logging";
$owl_lang->owl_title_other  			= "Altre impostazioni";
$owl_lang->owl_title_tools     		= "Moduli aggiuntivi PHP";
$owl_lang->owl_unzip_path       		= "Path unzip :";
$owl_lang->owl_version_control  		= "Abilita controllo versione :";
$owl_lang->owl_wordtotext_path       	= "MS-WORD Files <br />&#8211; Blank for Disabled:";
$owl_lang->owl_ppttotext_path       	= "MS-POWERPOINT Files <br />&#8211; Blank for Disabled:";
$owl_lang->quota  				= "Quota 0 = Disabilitato";
$owl_lang->reallydeluser  			= "This user is owner of %numfiles% File(s) and %numfolders% Folder(s). These File(s) and Folder(s) will be orphaned. Is it Still Ok to Delete?";
$owl_lang->reallydeleteuser             = "Cancellare questo utente?";
$owl_lang->recs_per_page  			= "Display Records Per Page (0 = Disabilitato)";
$owl_lang->recycle_enabled  			= "Abilita Cestino:";
$owl_lang->recycle_location  			= "Posizione Cestino:";
$owl_lang->recycle_title  			= "Impostazioni cestino";
$owl_lang->remember_me  			= "Visualizza il link 'Ricordami'";
$owl_lang->remember_me_checkbox 	 	= "Ricordami";
$owl_lang->remember_me_title  		= "Settaggi login persistente";
$owl_lang->remember_timeout  			= "Scadenza cookies in giorni";
$owl_lang->restore_file_prefix  		= "Prefisso per i file ripristinati dal cestino";
$owl_lang->search_result_folders  		= "Includi cartelle nei risultati di ricerca";
$owl_lang->show_action_title  		= "Visualizza main menu:";
$owl_lang->show_bulk_title  			= "Visualizza bulk buttons:";
$owl_lang->show_folder_title  		= "Visualizza strumenti cartella:";
$owl_lang->show_panel  				= "Show";
$owl_lang->show_panel_title  			= "Visualizza pannello di stato:";
$owl_lang->show_pref_title  			= "Visualizza barra Pref/Disconnetti Bar:";
$owl_lang->show_search_title  		= "Visualizza barra di ricerca:";
$owl_lang->status_bar_both           	= "Ambedue";
$owl_lang->status_bar_bottom         	= "Base";
$owl_lang->status_bar_location       	= "Visualizza barra di stato a:";
$owl_lang->status_bar_not            	= "Non visualizzare";
$owl_lang->status_bar_top            	= "Testata";
$owl_lang->cust_popup                                   = "Visualizza descrizione campi personalizzati in un popup";
$owl_lang->cust_headpopup     = "SPECIFIC DOCUMENT FIELDS";
$owl_lang->use_popup  				= "Usa popup per Notizie:";
$owl_lang->users             			= "Utenti";
$owl_lang->virus_path  				= "Virus Checking Software Path<br />Example: '/usr/bin/clamscan --quiet' <br />&#8211; Blank for Disabled:";
 
// BEGIN NEW STUFF 
$owl_lang->alt_btn_change_passwd         = "Cambia la tua vecchia Password";
$owl_lang->alt_btn_cln_history           = "Elimina documenti pi&ugrave; vecchi di (giorni): ";
$owl_lang->alt_btn_log_viewer            = "Visualizzatore logs";
$owl_lang->alt_btn_report_viewer         = "Visualizzatore reports";
$owl_lang->btn_change_passwd             = "Cambia Pass";
$owl_lang->btn_cln_history               = "Elimina lo storico";
$owl_lang->btn_log_viewer                = "Log di sistema";
$owl_lang->btn_report_viewer             = "Reports";
$owl_lang->confirm_cln_history           = "Sei sicuro di voler cancellare i documenti che sono pi&ugrave; vecchi di (giorni): ";
$owl_lang->historical_purge              = "Historical Files Deleted";
// END NEW STUFF 
 
// NEW STUF BEGIN 
$owl_lang->auth_http                      = "HTTP Auth (.htaccess)";
$owl_lang->auth_ldap                      = "LDAP Authentication";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->auth_owl                       = "Owl Authentication";
$owl_lang->auth_pop3                      = "pop3 Authentication";
$owl_lang->file_desc_required             = "Descrizione file obbligatoria";
$owl_lang->folder_desc_required           = "Descrizione cartella obbligatoria";
$owl_lang->html_title 				= "HTML Preferences";
$owl_lang->pass_account_lockout           = "Numero di tentativi prima del blocco:";
$owl_lang->pass_change_every              = "Forza cambio password ogni (giorni):";
$owl_lang->pass_enable_account_lockout    = "Abilita il blocco dell'account";
$owl_lang->pass_min_passwd_length         = "Lunghezza minima password:";
$owl_lang->pass_min_passwd_numeric        = "Numero minimo caratteri numerici:";
$owl_lang->pass_min_passwd_special        = "Numero minimo caratteri speciali:";
$owl_lang->pass_min_username_length       = "Lunghezza minima nome utente:";
$owl_lang->pass_track_old_passwords       = "Numero di password precedenti di cui tenere traccia:";
$owl_lang->rtftotext_path                 = "RTF to Text Tool Path";
$owl_lang->show_user_info            	  = "Nomi utente cliccabili";
$owl_lang->user_admin               	  = "Amministratore Utente/Gruppo";
$owl_lang->user_auth_type                 = "Tipo di autenticazione:";
$owl_lang->user_change_pass_next_login    = "Cambia password al prossimo login:";
$owl_lang->user_expires                   = "Scadenza account:";
$owl_lang->user_gmt_offset                = "Fuso orario utente";
$owl_lang->user_group_admin               = "File Admin for Primary Group:";
$owl_lang->user_login_to_newrecords       = "Login to New Records Page:";
$owl_lang->users_group_admin  		  = "Users that are Group Admin";
$owl_lang->users_in_primary_group         = "Users that have this group as PRIMARY Group";
$owl_lang->create_user_homedir 		  = "Create User HomeDir:";
$owl_lang->use_captcha 			  = "Use CAPTCHA:";
$owl_lang->created_here 		  = "<br /> (CREATED HERE IF create homedir checked)";
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
 
$owl_lang->owl_log_filter  	= "Filtra";
$owl_lang->owl_log_hd_action  = "Azione";
$owl_lang->owl_log_hd_agent  	= "Agente";
$owl_lang->owl_log_hd_dt_tm  	= "Data Ora";
$owl_lang->owl_log_hd_dtls  	= "Dettagli";
$owl_lang->owl_log_hd_file  	= "Documento";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path  = "Path Cartella";
$owl_lang->owl_log_hd_ip  	= "IP / Indirizzo";
$owl_lang->owl_log_hd_user  	= "Utente";
$owl_lang->owl_log_hide       = "Nascondi: ";
$owl_lang->owl_log_no_rec  	= " Nessuna Riga Trovata ";
$owl_lang->owl_log_viewer  	= "Visualizzazione LOG";
 
//******************************************************** 
// admin/log.php  END 
//******************************************************** 
 
 
//******************************************************** 
// admin/recycle.php  BEGIN 
//******************************************************** 
 
$owl_lang->empty_trash           = "Svuota il Cestino";
$owl_lang->really_empty_trash  = "Vuoi veramente svuotare il Cestino?";
$owl_lang->recycle_bin_admin     = "Amministrazione Cestino";
 
// BEGIN NEW STUFF 
$owl_lang->trash_email_body   = "I Documenti che hai richiesto sono stati allegati.";
$owl_lang->trash_email_subject   = "I FILES CHE HAI RICHIESTO SONO STATI RIPRISTINATI";
// END NEW STUFF 
 
//******************************************************** 
// admin/recycle.php  END 
//******************************************************** 
 
 
//******************************************************** 
// lib/owl.lib.php  BEGIN 
//******************************************************** 
 
$owl_lang->donothing                     = "Non fare niente &#8211; Lasciare i permessi dei file";
$owl_lang->everyoneread  = "Tutti possono leggere/scaricare";
$owl_lang->everyoneread_ad  = "Tutti possono leggere/scaricare";
$owl_lang->everyonewrite  = "Tutti possono leggere/scrivere/scaricare";
$owl_lang->everyonewrite_ad  = "Tutti possono leggere/scrivere/scaricare";
$owl_lang->everyonewrite_ad_nod  = "Tutti possono leggere/scrivere/scaricare,NON CANCELLARE";
$owl_lang->everyonewrite_nod  = "Tutti possono leggere/scrivere/scaricare, NON CANCELLARE";
$owl_lang->file_size_byte  = "b";
$owl_lang->file_size_gigabyte  = "g";
$owl_lang->file_size_kilobyte  = "k";
$owl_lang->file_size_megabyte  = "m";
$owl_lang->geveryoneread  = "Tutti possono leggere la cartella";
$owl_lang->geveryoneread_ad  = "Tutti possono leggere la cartella";
$owl_lang->geveryonewrite  = "Tutti possono scrivere/cancellare documenti nella cartella";
$owl_lang->geveryonewrite_ad  = "Tutti possono scrivere/cancellare documenti nella cartella";
$owl_lang->geveryonewrite_ad_nod  = "Tutti possono aggiungere documenti a questa cartella ";
$owl_lang->geveryonewrite_nod  = "Tutti possono aggiungere documenti a questa cartella ";
$owl_lang->ggroupread  = "Gli utenti del gruppo possono leggere";
$owl_lang->ggroupread_ad  = "Gli utenti del gruppo possono leggere";
$owl_lang->ggroupwrite  = "Gli utenti del gruppo possono scrivere/cancellare";
$owl_lang->ggroupwrite_ad      = "Gli utenti del gruppo possono scrivere/cancellare";
$owl_lang->ggroupwrite_ad_nod  = "Il gruppo selezionato pu&ograve; aggiungere documenti a questa cartella ";
$owl_lang->ggroupwrite_nod  = "Il tuo gruppo pu&ograve; aggiungere documenti a questa cartella ";
$owl_lang->ggroupwrite_worldread   = "Il tuo gruppo puo' aggiungere documenti e cancellare questa cartella &amp; Tutti possono accedere ai contenuti";
$owl_lang->ggroupwrite_worldread_ad   = "Il gruppo selezionato pu&ograve; aggiungere documenti e cancellare questa cartella &amp; Tutti possono accedere ai contenuti";
$owl_lang->ggroupwrite_worldread_ad_nod  = "Il gruppo selezionato pu&ograve; aggiungere documenti a questa cartella &amp; Tutti possono accedere ai contenuti, NON CANCELLARE";
$owl_lang->ggroupwrite_worldread_nod   = "Il tuo gruppo puo' aggiungere documenti a questa cartella &amp; Tutti possono accedere ai contenuti, NON CANCELLARE";
$owl_lang->gonlyyou  = "Accesso personale (solo il proprietario)";
$owl_lang->gonlyyou_ad  = "Accesso personale (solo il proprietario)";
$owl_lang->groupread  = "Il tuo gruppo puo' leggere/scaricare";
$owl_lang->groupread_ad  = "Il gruppo selezionato pu&ograve; leggere/scaricare";
$owl_lang->groupwrite  = "Il tuo gruppo puo' leggere/scrivere/scaricare";
$owl_lang->groupwrite_ad  = "Il gruppo selezionato pu&ograve; leggere/scrivere/scaricare";
$owl_lang->groupwrite_ad_nod  = "Il gruppo selezionato pu&ograve; leggere/scrivere/scaricare,NON CANCELLARE";
$owl_lang->groupwrite_nod  = "Il tuo gruppo puo' leggere/scrivere/scaricare, NON CANCELLARE";
$owl_lang->groupwrite_worldread   = "Il tuo gruppo puo' leggere/scrivere/scaricare &amp; Tutti possono leggere";
$owl_lang->groupwrite_worldread_ad   = "Il gruppo selezionato pu&ograve; leggere/scrivere/scaricare &amp; Tutti possono leggere";
$owl_lang->groupwrite_worldread_ad_nod   = "Il gruppo selezionato pu&ograve; leggere/scrivere/scaricare(NON CANCELLARE) &amp; Tutti possono leggere";
$owl_lang->groupwrite_worldread_nod   = "Il tuo gruppo puo' leggere/scrivere/scaricare(NON CANCELLARE) &amp; Tutti possono leggere";
$owl_lang->invalidsess  = "Sessione non valida, digitare nome utente e password";
$owl_lang->notif_comment_1  = "commentato il";
$owl_lang->notif_comment_2  = "Commento:";
$owl_lang->notif_msg           = "MESSAGGIO AUTOMATICO DA DMS<br /><br />Verifica il Documento nuovo/modificato che &egrave; collegato a questa mail<br /><br />";
$owl_lang->notif_msg_alt           = "MESSAGGIO AUTOMATICO DA DMS\n\nVerifica il Documento nuovo/modificato che &egrave; collegato a questa mail\n\n";
$owl_lang->notif_msg_alt_link            = "THIS IS AN AUTOMATED MESSAGE FROM DMS\n\nFind a link to a new/updated file in this Email\n\n";
$owl_lang->notif_msg_link                = "THIS IS AN AUTOMATED MESSAGE FROM DMS<br /><br />Find a link to a new/updated file in this Email<br /><br />";
$owl_lang->notif_salutation  = "Salve";
$owl_lang->notif_subject_comment  = "Un Documento in DMS &egrave; stato ";
$owl_lang->notif_subject_monitor  = "Un Documento o Cartella in DMS che stai monitorando &egrave; stato modificato";
$owl_lang->notif_subject_new   = "Nuovo Documento in DMS ";
$owl_lang->notif_subject_upd   = "Un Documento in DMS &egrave; stato modificato";
$owl_lang->notif_subject_file_deleted           = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account               = "UN NUOVO ACCOUNT E' STATO CREATO PER LEI SU DMS";
$owl_lang->notif_user  = "Created/Update by:";
$owl_lang->onlyyou  = "Personale (accesso solo al proprietario)";
$owl_lang->onlyyou_ad  = "Solo tu puoi leggere/scrivere/scaricare";
$owl_lang->orphaned  = "&#8211; NO Owner  &#8211;";
$owl_lang->owl_path  = "Percorso del Documento : ";
$owl_lang->sessinuse  = "Sessione attiva su un altro computer, accesso negato";
$owl_lang->sesstimeout  = "Sessione scaduta, ricollegarsi...<br />";
$owl_lang->virus_infected   = "DOCUMENTO INFETTATO DA VIRUS";
$owl_lang->virus_return_val  = "Virus Program Return value:";
$owl_lang->watermark_string             = "Confidential";
$owl_lang->watermark_source             = "DoxBox " . DOXBOX_VERSION;

 
//******************************************************** 
// lib/owl.lib.php  END 
//******************************************************** 
 
 
//******************************************************** 
// HREF TITLE messages  BEGIN 
//******************************************************** 
 
$owl_lang->title_browse_folder       = "Consulta questa Cartella";
$owl_lang->title_browse_site       = "Vai a questo URL";
$owl_lang->title_download_view       = "Scarica  / Visualizza questo Documento";
$owl_lang->title_edit_prefs       = "Visualizza / Modifica Preferenze";
$owl_lang->title_return_folder       = "Ritorno a ";
$owl_lang->title_sort       = "Ordina per";
$owl_lang->title_view_my       = "Lista dei Miei Documenti";
$owl_lang->title_view_new       = "Lista dei nuovi Documenti dall'ultima visita";
$owl_lang->title_view_updated       = "Lista dei Documenti aggiornati dall'ultima visita";
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
 
$owl_lang->news_content  = "Contenuto";
$owl_lang->news_hd  = "Notizie";
$owl_lang->news_hd_audience  = "Target ";
$owl_lang->news_hd_created  = "Creata il";
$owl_lang->news_hd_expires  = "Scadenza il";
$owl_lang->news_heading  = "Titolo";
$owl_lang->news_posted_date  = "Notizie Inserite il:";
$owl_lang->news_read   = "Letta";
$owl_lang->news_title  = "Gestione Notizie";
 
//******************************************************** 
// admin/news.php and newsread.php  END 
//******************************************************** 
 
 
//******************************************************** 
// DEBUG MESSAGES BEGIN 
//******************************************************** 
 
$owl_lang->debug_doc_not_exists  = "DEBUG: The DMS Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." does not exists.";
$owl_lang->debug_doc_not_writeable  = "DEBUG: The DMS Documents Directory: " .$default->owl_fs_root . "/" . fid_to_name(1) ." is not writeable by the Web Server.";
$owl_lang->debug_file_not_exist  = "DEBUG: The required file '$default->owl_fs_root/%s' does not exists.<br /> OR<br />The path specified by \$default->owl_fs_root in config/owl.php is wrong.";
$owl_lang->debug_tmp_not_exists  = "DEBUG: The DMS temporary Directory: $default->owl_tmpdir does not exists.";
$owl_lang->debug_tmp_not_writeable  = "DEBUG: The DMS temporary Directory: $default->owl_tmpdir is not writeable by the Web Server.";
$owl_lang->debug_webserver_no_access  = "DEBUG: il web server non ha accesso in lettura a: <br />'$default->owl_fs_root/%s'. <br />Aggiorna i permessi d'accesso e prova ancora";
 
//******************************************************** 
// DEBUG MESSAGES END 
//******************************************************** 
 
 
//******************************************************** 
// admin/stats.php BEGIN 
//******************************************************** 
 
$owl_lang->owl_stats_viewer  = "Statistiche";
$owl_lang->stats_files  = "Numero di Documenti per Utente";
$owl_lang->stats_folders  = "Numero di Cartelle per Utente";
$owl_lang->stats_information  = "DMS Logging and File logging devono essere attivi per avere questi dati";
$owl_lang->stats_top  = "Top 20 downloads";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users           = "USER Signon (Login / Failure / Logout)";
$owl_lang->stats_users_loggedin  = "Currently Logged In";
 
//******************************************************** 
// admin/stats.php END 
//******************************************************** 
 
//********************************************************: 
// admin/doctype.php BEGIN 
//******************************************************** 
 
$owl_lang->doc_administration  = "Document Type Admininstration";
$owl_lang->doc_field_label  = "Etichetta del Campo(Per Locale)";
$owl_lang->doc_field_name  = "Nome del campo";
$owl_lang->doc_field_pos  = "Posizione del Campo";
$owl_lang->doc_field_required  = "Richiesto?";
$owl_lang->doc_field_searchable  = "Ricercabile?";
$owl_lang->doc_field_popup  = "Insert in popup description?";
$owl_lang->doc_field_size  = "Dimensione del Campo";
$owl_lang->doc_new_doc_type  = "&#8212; Aggiungi il tipo del nuovo Documento &#8212;";
$owl_lang->doc_specific  = "CAMPI SPECIFICI PER IL DOCUMENTO:";
$owl_lang->document_type  = "Tipo del Documento";
$owl_lang->document_type_name  = "Nome del Tipo di Documento";
 
// BEGIN NEW STUFF 
$owl_lang->doc_field_disp_label  = "ETICHETTA CAMPO:";
$owl_lang->doc_field_disp_sep  = "ETICHETTA SEPARATORE";
$owl_lang->doc_field_sample  = "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse  = "Visualizza Browser:";
$owl_lang->doc_field_show_in_list  = "Mostra Campo nella Vista Browse:";
$owl_lang->doc_field_type  = "TIPO CAMPO:";
$owl_lang->doc_field_values  = "Valori del Campo separati con | :";
$owl_lang->doc_fields  = "Campi personalizzati";
// END NEW STUFF 
 
//******************************************************** 
// admin/doctype.php END 
//******************************************************** 
 
//******************************************************** 
// admin/import_users.php  BEGIN 
//******************************************************** 
 
$owl_lang->group_create          = "Gruppo:";
$owl_lang->header_csv_import     = "Imporat CSV User file";
$owl_lang->import_inserted       = "INSERITO";
$owl_lang->import_skipped        = "SALTATO";
$owl_lang->invalid_groupid       = "Groupid non valido --> ";
$owl_lang->msg_user_exists       = "Utente gi&agrave; esistente";
$owl_lang->sendcsvfile           = "Carica file delimtato da virgola";
$owl_lang->user_created_skipped  = "Utente:";
 
//******************************************************** 
// admin/import_users.php END 
//******************************************************** 
 
//******************************************************** 
// DOC PEER Review  BEGIN 
//******************************************************** 
 
$owl_lang->owl_peer_review  = "Abilita Peer Review Feature:";
$owl_lang->owl_peer_review_opt   ="Rendi Opzionale Peer Review:";
$owl_lang->owl_title_peer_review = "Opzioni peer review";
$owl_lang->owl_title_peer_review2 = "Approvazione Documenti";
$owl_lang->peer_approval_title   = "Documenti in attesa della mia Approvazione";
$owl_lang->peer_approved_body  = "Il tuo file Ë stato approvato:";
$owl_lang->peer_file_approved  = "Documento Approvato:";
$owl_lang->peer_file_final  = "Approvazione Finale:";
$owl_lang->peer_file_rejected  = "Documento Respinto:";
$owl_lang->peer_file_to_review  = "Documento da revisionare:";
$owl_lang->peer_final_approval  = "[Approvazione Finale]: ";
$owl_lang->peer_final_body  = "Il tuo documento &egrave; stato approvato da tutti i revisori richiesti. Rendi pubblico il Documento";
$owl_lang->peer_final_body_auto = "Il tuo documento &egrave; stato approvato da tutti i revisori richiesti.<br />Il tuo documento &egrave; stato reso";
$owl_lang->peer_msg_to_reviewer  = "Messagggio ai Revisori";
$owl_lang->peer_my_approval  = "In attesa della mia approvazione";
$owl_lang->peer_notif_user  = "Creato/Aggiornato da";
$owl_lang->peer_pending_approval = "Mie richieste di approvazione";
$owl_lang->peer_pending_title   = "Miei Documententi in attesa di Approvazione";
$owl_lang->peer_reject_reason    = "Motivazioni del rifiuto";
$owl_lang->peer_rejected_body  = "Il tuo file &egrave; stato respinto:";
$owl_lang->peer_review_body  = "La tua approvazione &egrave; stata richiesta per i seguenti Documenti:";
$owl_lang->peer_reviewer_list  = "Revisore(i)";
$owl_lang->peer_satus    = "Stato";                                                                        
$owl_lang->peer_satus_approved   = "&#8212; A P P R O V A T O &#8212;";
$owl_lang->peer_satus_pending    = "&#8212; P E N D E N T E &#8212;";
$owl_lang->peer_satus_rejected   = "&#8212; R E S P I N T O &#8212;";
$owl_lang->peer_subj_approved  = "Il tuo Documento &egrave; stato APPROVATO";
$owl_lang->peer_subj_rejected  = "Il tuo Documento &egrave; stato RESPINTO";
$owl_lang->peer_subj_reminder  = "SOLLECITO: hai file da revisionare";
$owl_lang->peer_subj_review  = "Hai un file da revisionare";
 
//******************************************************** 
// DOC PEER Review  END 
//******************************************************** 
 
//******************************************************** 
// setacl.php BEGIN 
//******************************************************** 
 
$owl_lang->acl_adding_file              = "Aggiunta Documento ACL:";
$owl_lang->acl_adding_folder            = "Aggiunta Cartella ACL:";
$owl_lang->acl_available_groups         = "Grouppo(i)disponibile(i)";
$owl_lang->acl_available_users          = "Utente(i) disponibile(i)";
$owl_lang->acl_edit_file                = "Editing Documento ACL:";
$owl_lang->acl_edit_folder              = "Editing Cartella ACL:";
$owl_lang->acl_file_checkin             = "Blocca/Sblocca";
$owl_lang->acl_file_comment             = "Commento";
$owl_lang->acl_file_copy                = "Copia";
$owl_lang->acl_file_delete              = "Cancella";
$owl_lang->acl_file_email               = "Email";
$owl_lang->acl_file_modify              = "Propriet&agrave;";
$owl_lang->acl_file_monitor             = "Monitor";
$owl_lang->acl_file_move                = "Sposta";
$owl_lang->acl_file_read                = "Leggi";
$owl_lang->acl_file_search              = "Ricerca correlati";
$owl_lang->acl_file_set_acl             = "Definisci ACL";
$owl_lang->acl_file_update              = "Aggiorna";
$owl_lang->acl_file_view_log            = "Visualizza Log";
$owl_lang->acl_folder_copy              = "Copia";
$owl_lang->acl_folder_delete            = "Cancella";
$owl_lang->acl_folder_modify            = "Modifica Propriet&agrave;";
$owl_lang->acl_folder_monitor           = "Monitor";
$owl_lang->acl_folder_move              = "Sposta";
$owl_lang->acl_folder_read              = "Leggi (Download/Browse)";
$owl_lang->acl_folder_set_acl           = "Definisci ACL";
$owl_lang->acl_folder_write             = "Scrivi (Crea)";
$owl_lang->acl_heading_file             = "Gruppo(i)/Utente(i)";
$owl_lang->acl_heading_files            = "FILES &#8211; SELECT DESIRED USER(s) and GROUP(s)";
$owl_lang->acl_heading_folder           = "Gruppo(i)/Utente(i)";
$owl_lang->acl_heading_folders          = "FOLDERS &#8211; SELECT DESIRED USER(s) and GROUP(s)";
$owl_lang->acl_propagate_file           = "Assegna questa Policy a \"TUTTI\" Documenti:";
$owl_lang->acl_propagate_folders        = "Propaga a tutti i subfolder(s):";
$owl_lang->acl_selected_groups          = "Gruppo(i) Selezionato(i)";
$owl_lang->acl_selected_users           = "Utente(i)Selezionato(i)";
$owl_lang->acl_set_acl                  = "Assegna Security Policy";
$owl_lang->acl_set_acl_now              = "Assegna Security Policy Ora:";
$owl_lang->acl_set_file_permissions     = "Assegna permessi al documento";
$owl_lang->acl_set_folder_permissions   = "Assegna permessi alla cartella";
$owl_lang->alt_set_folder_acl          = "Set Current Folder Security Policy";
$owl_lang->acl_set_selected             = "Assegna ai Selezionati";
$owl_lang->alt_acl_save_file            = "Salva Documento Security Policy";
$owl_lang->alt_acl_save_folder          = "Salva Cartella Security Policy";
$owl_lang->btn_acl_save                 = "Salva";
 
 
//******************************************************** 
// setacl.php END 
//******************************************************** 
 
//******************************************************** 
// admin/reports BEGIN 
//******************************************************** 
 
$owl_lang->report_available_reports          = "Available Reports:";
$owl_lang->report_file_folder                = "File/Folder";
$owl_lang->report_filter                     = "Filter:";
$owl_lang->report_filter_since               = "Since:";
$owl_lang->report_full_access                = "FULL ACCESS";
$owl_lang->report_select_report              = "&#8211; Select a Report &#8211;";
$owl_lang->report_users_disabled_title       = "Disabled User(s)";
$owl_lang->report_users_entitlement          = "User Access List";
$owl_lang->report_users_inactive_title       = "User(s) Inactive Since";
 
//******************************************************** 
// admin/reports END 
//******************************************************** 
 
 
//******************************************************** 
// THUMBNAILS BEGIN 
//******************************************************** 
 
$owl_lang->alt_no_thumb                     = "Nessuna miniatura disponibile";
$owl_lang->alt_thumb_small                  = "Miniatura piccola";
$owl_lang->thumb_enable_thumbnails          = "Abilita miniature:";
$owl_lang->thumb_gen_thumb_tool_path        = "Percorso per lo strumento di conversione ImageMagick:";
$owl_lang->thumb_gen_thumb_vid_tool_parms   = "Mplayer parametri:";
$owl_lang->thumb_gen_thumb_vid_tool_path    = "Percorso per Mplayer:";
$owl_lang->thumb_image_info                 = "Informazioni immagine";
$owl_lang->thumb_image_size                 = "Dimensioni immagine:";
$owl_lang->thumb_large_width                = "Larghezza miniatura grande in pixel:";
$owl_lang->thumb_med_width                  = "Larghezza miniatura media in pixel:";
$owl_lang->thumb_number_colums              = "Numero di colonne per la vista miniature:";
$owl_lang->thumb_re_generate                = "Genera miniatura";
$owl_lang->thumb_small_width                = "Larghezza miniatura piccola in pixel:";
$owl_lang->thumb_title                      = "Opzioni miniature";
$owl_lang->thumb_title_thumb_view           = "Dettagli vista miniature";
 
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

$owl_lang->group_set_selected      = "Imposta selezionati";
$owl_lang->alt_group_set_selected  = "Imposta gli utenti selezionati";

$owl_lang->btn_jupload                          = "Upload massivo";
$owl_lang->alt_btn_jupload                      = "Aggiungi pi&ugrave; documenti usando Jupload";

$owl_lang->owl_use_smtp_ssl                     = "SMTP SSL:";
$owl_lang->owl_smtp_port                        = "SMTP numero porta:";
$owl_lang->owl_smtp_max_attachemnt_size         = "Dimensione massima allegati (bytes):";
$owl_lang->owl_force_browser_to_ssl             = "Forza il browser ad usare il protocollo HTTPS:";
$owl_lang->owl_file_update_different_name       = "File aggiornato con nome differente:<br />(l'ESTENSIONE deve rimanere la stessa.)";
$owl_lang->owl_use_wysiwyg_editor               = "Usa editor WYSIWYG per i campi di testo:";
$owl_lang->owl_show_folder_desc_popup           = "Visualizza descrizione cartella nel popup:";
$owl_lang->owl_header_watermarking              = "Opzioni watermark file pdf";
$owl_lang->owl_enable_watermarking              = "Abilita il watermarking per i files pdf:";
$owl_lang->owl_path_to_pdftk                    = "Percorso per pdftk:";
$owl_lang->owl_path_to_pdftk_bg_file            = "Percorso per watermark personalizzato:<br />(path to a 1 page pdf file that will be used <br />as the watermark instead of the default";
$owl_lang->owl_pdftk_greater_than_1_40          = "PDFTK version Greater than 1.40:";
$owl_lang->owl_indexing_user_selectable         = "Indicizzazione del file a discrezione dell'utente:";
$owl_lang->owl_indexing_off                     = "Disabilita indicizzazione dei files:";
$owl_lang->owl_default_revision_type            = "Tipo di revisione di default:";
$owl_lang->owl_machine_timezone                 = "Fuso orario macchina:";
$owl_lang->owl_previous_ver_downloadable        = "Rendi accessibili le versioni precedenti:";
$owl_lang->owl_auto_checkin_checkout            = "Blocca il file dopo il download:";
$owl_lang->owl_user_default_view                = "Vista di default ESTESA:";
$owl_lang->owl_user_default_revision            = "Tipo di revisione di default:";
$owl_lang->owl_user_major_revision              = "User Initial Major Revision:";
$owl_lang->owl_user_minor_revision              = "User Initial Minor Revision:";
$owl_lang->owl_user_pdfwatermark                = "Il pdf viene filigranato: ";
$owl_lang->owl_user_email_pass                  = "Email Utenza / Password:";
$owl_lang->owl_use_email_signature              = "Aggiungi firma: ";
$owl_lang->owl_email_signature                  = "Firma Email:";
$owl_lang->owl_file_link                        = "Link pubblico:";
$owl_lang->alt_hot_link                         = "Visualizza URL diretto";
$owl_lang->alt_link_folder                      = "Crea collegamento";


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
$owl_lang->tables_btn = "Tabelle utenti";
$owl_lang->tables_header = "Gestione tabelle utenti";
$owl_lang->table = "Tabella";
$owl_lang->tuple = "Riga";
$owl_lang->tables_tupleView = "Vedi righe";
$owl_lang->tables_tupleAdd = "Aggiungi righe";
$owl_lang->tables_tableEdit = "Modifica tabella";
$owl_lang->tables_tableAdd = "Aggiungi tabella";
$owl_lang->tables_descr = "Descrizione";
$owl_lang->tables_descr2 = "Descrizione estesa";
$owl_lang->tables_tupleEdit = "Edita";
$owl_lang->tables_tupleDelete = "Cancella";
$owl_lang->tables_actions = "Azioni";
$owl_lang->tables_tupleDeleted = "La riga &egrave; stata cancellata!";
$owl_lang->tables_tupleAdded = "La riga &egrave; stata aggiunta con successo!";
$owl_lang->tables_tupleEdited = "La riga &egrave; stata editata con successo!";
$owl_lang->tables_back = "Indietro";
$owl_lang->tables_quickAdd = "Aggiungi";
$owl_lang->tables_refresh = "Aggiorna";

$owl_lang->calendar_title = "Calendario";

$owl_lang->docRel_title = "Configura le relazioni tra documenti";
$owl_lang->docRel_activateFunction = "Attiva la relazione tra documenti";
$owl_lang->docRel_list = "Documenti correlati";
//********************************************************
// Extensions Text END
//********************************************************
$owl_lang->ownership_change_1 = "Il file non &egrave; di tua propriet&agrave;.";
$owl_lang->ownership_change_2 = "Would you like to take ownership on Checkout?";
$owl_lang->ownership_change_subj = "File: %s -- Take Ownership (%s)";

$owl_lang->member_membership = "Membership";
$owl_lang->member_fileadmin = "File Admin";
$owl_lang->member_group = "Gruppo";

$owl_lang->user_created = "Creato.";
$owl_lang->err_bad_username     = "Inserisci un nome utente o password validi";

$owl_lang->motd_headding = "Messaggio del giorno";
$owl_lang->motd_label    = "Messaggio (bianco = vuoto)";

$owl_lang->mtool_page_title   = "Email Tool";
$owl_lang->add_folder_page_title   = "Creazione Nuova Cartella";
$owl_lang->add_archive_page_title  = "Carica Archivio Zip";
$owl_lang->add_file_page_title     = "Carica Nuovo Documento";
$owl_lang->add_url_page_title     = "Aggiungi un URL";
$owl_lang->add_note_page_title     = "Aggiungi una Nota";
$owl_lang->edit_folder_page_title     = "Modifica Propriet&agrave; Cartella";
$owl_lang->copy_folder_page_title     = "Copia Cartella";
$owl_lang->move_folder_page_title     = "Sposta Cartella";
$owl_lang->link_folder_page_title     = "Seleziona la cartella nella quale creare il collegamento";
$owl_lang->setacl_folder_page_title     = "Imposta ACL Cartella";
$owl_lang->setacl_file_page_title     = "Imposta ACL File";
$owl_lang->edit_file_page_title     = "Modifica Propriet&agrave; File";
$owl_lang->copy_file_page_title     = "Copia File";
$owl_lang->move_file_page_title     = "Sposta File";
$owl_lang->upd_file_page_title     = "Aggiorna File";
$owl_lang->email_file_page_title     = "Invia un File";
$owl_lang->comment_file_page_title     = "Aggiungi / Visualizza / Edita un Commento ad un File";
$owl_lang->link_file_page_title     = "Collega il File ad un'altra Cartella";
$owl_lang->jupload_page_title     = "Upload Files Massivo";
$owl_lang->bulk_move_page_title   = "Spostamento Massivo";
$owl_lang->bulk_mail_page_title   = "Invio Massivo";
$owl_lang->view_page_title   = "Visualizza dettagli file...";
$owl_lang->viewing_page_title   = "Visualizza...";
$owl_lang->playing_page_title   = "Riproduci...";
$owl_lang->searching_page_title   = "Attendere...";

$owl_lang->syslog_filename = "File Name" . LABEL_TERMINATOR;
$owl_lang->syslog_date_from = "Da (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_date_to = "A   (YYYY-MM-DD HH:MM:SS)" . LABEL_TERMINATOR;
$owl_lang->syslog_ip_host = "Indirizzo IP(HostName)" . LABEL_TERMINATOR;
$owl_lang->alt_gen_csv     = "Genera versione CSV del file";
$owl_lang->btn_gen_csv     = "Genera CSV";
$owl_lang->empty_folder   = " C A R T E L L A &nbsp;  V U O T A ";

$owl_lang->alt_btn_import_users    = "Importa utenti da un file CSV";
$owl_lang->alt_btn_admin_maint_off = "Disattiva modalit&agrave; di manutenzione (Permetti agli utenti di accedere)";
$owl_lang->btn_admin_maint_on       = "Modalit&agrave;<br />di manutenzione";
$owl_lang->btn_admin_maint_off       = "Modalit&agrave; normale";
$owl_lang->alt_btn_admin_maint_on       = "Blocca accesso utenti, cos&igrave; l'amministratore potr&agrave; effettuare delle attivit&agrave; senza la presenza di utenti nel sistema";
$owl_lang->alt_tables_btn = "Tabella";
$owl_lang->alt_btn_admin_users = "Gestione Utenti";
$owl_lang->alt_btn_admin_groups = "Gestione Gruppi";
$owl_lang->alt_btn_main_menu_collapse = "Chiudi/Espandi il men&ugrave; principale";
$owl_lang->file_expires = "Scadenza file" . LABEL_TERMINATOR;

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
