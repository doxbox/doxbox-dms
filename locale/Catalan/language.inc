<?php
/*
 *
 * File: Catala/language.inc
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Author: José Antonio Burgueño
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
	$owl_lang->localized_date_format = "d-M-y \a\\t h:i a";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "ca";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "No tens permisos per afegir comentaris a aquest fitxer";
$owl_lang->err_backup_file   		= "El fitxer ja existeix";
$owl_lang->err_backup_folder_create 	= "Error en la creaci&oacute; de la carpeta Backup";
$owl_lang->err_bad_url			= "Si us plau entra una URL v&agrave;lida";
$owl_lang->err_bad_version_1 		= "DMS requereix com a m&iacute;nim la version PHP";
$owl_lang->err_bad_version_2 		= "Est&agrave;s corrent a la Version";
$owl_lang->err_bad_version_3 		= "Instal&middot;la una nova versi&oacute; de php i intenta-ho una altra vegada";
$owl_lang->err_comment_empty		= "El Comentari no pot estar buit";
$owl_lang->err_email         		= "El missatge no pot ser enviat";
$owl_lang->err_email_required		= "Es requereix el camp E-Mail";
$owl_lang->err_fexist1			= "<b>El fitxer existeix:</b>";
$owl_lang->err_fexist2 			= "Ja hi ha un fitxer amb el nom <i>";
$owl_lang->err_fexist3 			= "</i> en aquest directori.";
$owl_lang->err_file_exists		= "El fitxer que est&agrave;s intentant pujar ja existeix";
$owl_lang->err_file_lock     		= "En aquest moment no pots baixar aquest fitxer, l'fitxer es troba bloquejat per";
$owl_lang->err_file_not_exist		= "El fitxer no existeix";
$owl_lang->err_file_too_big		= "php.ini upload_max_filesize excedeix i/o<br /> tamany de fitxer m&agrave;xim d'Owl";
$owl_lang->err_file_update		= "Per actualitzar un fitxer es requreix mantenir el mateix nom, si us plau intenta-ho una altra vegada utilitzant el mateix nom de fitxere";
$owl_lang->err_fileexists    		= "El moviment ha estat Cancel&middot;lat<br />Ja existeix un FITXER amb el mateix nom.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "El nom del fitxer amb qu&egrave; intentes renombrar aquest FITXER ja existeix";
$owl_lang->err_folder_create 		= "Error en la creaci&oacute; de la Carpeta";
$owl_lang->err_folder_exist		= "Aquesta carpeta ja existeix";
$owl_lang->err_folderexists  		= "El renombrament ha estat cancel&middot;lat. Existeix una carpeta amb el mateix nom.";
$owl_lang->err_general          = "Ha hagut un error";
$owl_lang->err_please_select_bulk	= "Si us plau selecciona almenys un fitxer o carpeta utilitzant les caselles de verificaci&oacute;";
$owl_lang->err_select_reviewer		= "Si us plau selecciona almenys una persona com a Revisor del document";
$owl_lang->err_update_file_lock     	= "No pots actualitzar aquest fitxer, actualment est&agrave; bloquejat per";
// NEW CHANGE
$owl_lang->err_group_delete             = "No es pot esborrar aquest Grup: <font color=\"red\">%d</font> Fitxer(s),  <font color=\"red\">%d</font> Carpeta(es), <font color=\"red\">%d</font> Usuari(s) amb aquest grup Primari, <font color=\"red\">%d</font> Usuari(s) que s&oacute;n membres d'aquest grup";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type        = "No pots Esborrar, hi ha fitxers utilitzant aquest tipus de document";
$owl_lang->err_database			= "Error en BDD";
$owl_lang->err_doc_field_req            = "Camp perdut requerit:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req        = "Es requereix el nom del tipus de document <BR>";
$owl_lang->err_field_label_req          = "Es requereix el camp Etiqueta  <BR>";
$owl_lang->err_field_name_req           = "Es requereix el camp Nom <BR>";
$owl_lang->err_field_size_req           = "Es requereix el camp Tamany <BR>";
$owl_lang->err_field_minor_version	= "Minor version field must be a positive integer"; 
$owl_lang->err_field_major_version	= "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Error en Creaci&oacute; del fitxer 'TEXT' Temporal";
$owl_lang->err_forbidden_file		= "Tipus de fitxer No perm&egrave;s";
$owl_lang->err_group_exists             = "Existeix un grup amb aquest nom.";
$owl_lang->err_gzip_not_found       = "gzip no s'ha trobat ";
$owl_lang->err_login            = "Si us plau entra al Sistema per realitzar aquesta acci&oacute;";
$owl_lang->err_movecancel       = "L'operaci&oacute; moure ha estat cancel&middotlada";
$owl_lang->err_nameempty            = "El nom de la carpeta no pot estar en blanc";
$owl_lang->err_news_required            = "ERROR: &iexcl;Es requereix Encap&ccedil;alament de Not&iacute;cies i Contingut!";
$owl_lang->err_no_access            = "No tens acc&eacute;ss a cap fitxer selecionat";
$owl_lang->err_no_access_info 		= "Possibles causes: <br />1) No has marcat cap casella de fitxer o Carpeta<br />2) Eborrat, E-Mail, Bloqueig M&uacute;ltiple no ha estat aplicat a Carpetes<br />3) No tens acc&eacute;s a cap FITXER o carpeta sel&middotleccionats.";
$owl_lang->err_noemail          = "No tens perm&iacute;s per enviar per correu aquest fitxer";
$owl_lang->err_nofileaccess         = "No tens acc&eacute;s a aquest fitxer";
$owl_lang->err_nofiledelete         = "No tens perm&iacute;s per esborrar aquest fitxer";
$owl_lang->err_nofilemod        = "No tens perm&iacute;s per modificar aquest fitxer";
$owl_lang->err_nofolderaccess       = "No tens acc&eacute;s a aquesta carpeta";
$owl_lang->err_nofolderdelete       = "No tens perm&iacute;s per esborrar aquesta carpeta";
$owl_lang->err_nofoldermod      = "No tens perm&iacute;s per modificar aquesta carpeta";
$owl_lang->err_nosubfolder      = "No tens perm&iacute;s per crear carpetes subordinades aqu&iacute;";
$owl_lang->err_not_zip			= "fitxer ZIP No V&agrave;lid";
$owl_lang->err_note_title               = "El T&iacute;tol &eacute;s un camp requerit";
$owl_lang->err_note_title_exists        = "Ja existeix previament una Nota amb aquest nom ";
$owl_lang->err_noupload         = "No tens perm&iacute;s per afegir fitxers a aquesta carpeta";
$owl_lang->err_pass_missmatch       = "La contrasenya nova i la seva confirmaci&oacute; no coincideixen";
$owl_lang->err_pass_wrong       = "La contrasenya anterior &eacute;s incorrecta";
$owl_lang->err_pod2html_not_found       = "ERROR: L'eina pod2html no ha estat trobada:";
$owl_lang->err_quota            = "No tens suficent espai al disc asignat per pujar aquest fitxer: ";
$owl_lang->err_quota_avail		= " disponible.";
$owl_lang->err_quota_exceed  		= "Has excedit la teva quota";
$owl_lang->err_quota_needed		= " necess&agrave;ria ";
$owl_lang->err_req              = "ERROR: Tots els camps s&oacute;n requerits";
$owl_lang->err_root_delete              = "La carpeta Root (Principal) no pot ser esborrada";
$owl_lang->err_sess_notvalid        = "Identificador de sessi&oacute; no v&agrave;lid";
$owl_lang->err_sess_write       = "Error en escriure la informaci&oacute; de la sessi&oacute; en la base de dades";
$owl_lang->err_specialfoldername    = "'backup' &eacute;s una Carpeta reservada per Owl Si us plau tria un altre nom";
$owl_lang->err_sql			= "SQL error";
$owl_lang->err_tar_not_found        = "No s'ha trobat tar";
$owl_lang->err_trash_can_empty          = "La Paperera de Reciclatge est&agrave; buida";
$owl_lang->err_unauth_area      = "No est&agrave;s autoritzat per accedir a aquesta &agrave;rea";
$owl_lang->err_unauthorized         = "Acc&eacute;s no autoritzat";
$owl_lang->err_upload           = "Error en afegir el fitxer";
$owl_lang->err_user_exists      = "L'usuari ja existeix";
// NEW STUFF
$owl_lang->err_captcha_auth		= "Ha fallat l'autentificaci&oacute; CAPTCHA";
// NEW STUFF END


//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Afegir camp";
$owl_lang->btn_add_file          = "Afegir document";
$owl_lang->btn_add_folder          = "Afegir carpeta";
$owl_lang->btn_add_news          = "Afegir not&iacute;cies";
$owl_lang->btn_add_note          = "Afegir nota";
$owl_lang->btn_add_url          = "Afegir Url";
$owl_lang->btn_add_zip           = "Afegir fitxer zip";
$owl_lang->btn_admin      = "Admin";
$owl_lang->btn_admin_groups          = "Nou grup";
$owl_lang->btn_admin_news          = "Admin not&iacute;cies";
$owl_lang->btn_admin_user_group          = "Usuari/Grup Admin";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Nou usuari";
$owl_lang->btn_back          = "Anar enrera";
$owl_lang->btn_browse     = "Veure";
$owl_lang->btn_bulk_checkout       = "Desactivar m&uacute;ltiple";
$owl_lang->btn_bulk_delete         = "Esborrar m&uacute;ltiple";
$owl_lang->btn_bulk_download          = "Desc&agrave;rrega m&uacute;ltiple";
$owl_lang->btn_bulk_email          = "E-Mail m&uacute;ltiple";
$owl_lang->btn_bulk_move          = "Moure m&uacute;ltiple";
$owl_lang->btn_cancel          = "Cancel&middot;lar";
$owl_lang->btn_clickhere          = "Clica Aqu&iacute;";
$owl_lang->btn_collapse_view          = "Colapsar Vista";
$owl_lang->btn_create          = "Crear";
$owl_lang->btn_default_view          = "Vista per defecte";
$owl_lang->btn_deldoctype          = "Esborrar Doc Tipus";
$owl_lang->btn_download_bulk_package	= "Descarregar bloc de fitxers comprimit";
$owl_lang->btn_edit_group          = "Editar grup";
$owl_lang->btn_edit_user          = "Editar usuari";
$owl_lang->btn_expand_view          = "Expandir vista";
$owl_lang->btn_go_bottom      = "Anar abaix";
$owl_lang->btn_go_top      = "Anar amunt";                                                                                                                                                           
$owl_lang->btn_help     = "Ajuda";
$owl_lang->btn_import_users  = "Importar usuaris";
$owl_lang->btn_login          = "Login";
$owl_lang->btn_logout     = "Logout";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_register          = "Registre";
$owl_lang->btn_reset          = "Esborrar";
$owl_lang->btn_send_email          = "Enviar E-Mail";
$owl_lang->btn_submit          = "Enviar";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Vista miniatura";
$owl_lang->btn_trash_admin          = "Paperera";
// NEW STUFF
$owl_lang->btn_export          = "Exportar";
$owl_lang->btn_gen_pdf          = "Generar PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Afegir un comentari a aquest fitxer";
$owl_lang->alt_add_field	= "Afegir el camp de sota";
$owl_lang->alt_add_group	= "Crear aquest grup";
$owl_lang->alt_add_news		= "Afegir una nova not&iacute;cia";
$owl_lang->alt_add_user		= "Crear aquest usuari";
$owl_lang->alt_admin_flush      = "Purgar sessions expirades";
$owl_lang->alt_admin_groups	= "Crear un nou grup";
$owl_lang->alt_admin_users	= "Crear un nou usuari";
$owl_lang->alt_approve_file 	= "Aprovar aquest document";
$owl_lang->alt_back      	= "Tornar a la pantalla anterior";
$owl_lang->alt_btn_add_file     = "Pujar un nou fitxer";
$owl_lang->alt_btn_add_folder	= "Crear una nova carpeta";
$owl_lang->alt_btn_add_note     = "Afegir una nova nota";
$owl_lang->alt_btn_add_url	= "Crear un nou enlla&ccedil; Web";
$owl_lang->alt_btn_add_zip     	= "Actualitzar a fitxer Zip";
$owl_lang->alt_btn_admin 	= "Administraci&oacute;";
$owl_lang->alt_btn_browse	= "Tornar a la vista de fitxers";
$owl_lang->alt_btn_bulk_checkout= "Desmarcar fitxers";
$owl_lang->alt_btn_bulk_delete 	= "Esborrar m&uacute;ltiples fitxers";
$owl_lang->alt_btn_bulk_download= "Descarregar m&uacute;ltiples fitxers";
$owl_lang->alt_btn_bulk_email  	= "E-Mail m&uacute;ltiple";
$owl_lang->alt_btn_bulk_move   	= "Moure m&uacute;ltiples fitxers i carpetes";
$owl_lang->alt_btn_clickhere	= "Clica aqu&iacute;";
$owl_lang->alt_btn_collapse_view= "Canviar a vista reduïda";
$owl_lang->alt_btn_default_view = "Canviar a vista per defecte";
$owl_lang->alt_btn_expand_view  = "Canviar a vista expandida";
$owl_lang->alt_btn_help		= "Ajuda en l&iacute;nia de DMS";
$owl_lang->alt_btn_login	= "Log in";
$owl_lang->alt_btn_logout	= "Log out";
$owl_lang->alt_btn_mail_tool   	= "Eina E-Mail simple";
$owl_lang->alt_btn_thumb_view   = "Canviar a vista de vinyetes";
$owl_lang->alt_cancel		= "Cancel&middot;lar aquesta Acci&oacute;";
$owl_lang->alt_cancel_move	= "Cancel&middot;lar l'acci&oacute; Moure";
$owl_lang->alt_change		= "Actualitzar aquest registre";
$owl_lang->alt_comments 	= "Existeixen comentaris per a aquest fitxer";
$owl_lang->alt_copy_file     	= "Copiar fitxer";
$owl_lang->alt_copy_folder   	= "Copiar carpeta";
$owl_lang->alt_del_all		= "Esborrar paperera";
$owl_lang->alt_del_comments     = "Esborrar aquest comentari";
$owl_lang->alt_edt_comments     = "Editar aquest comentari";
$owl_lang->alt_del_field	= "Esborrar aquest camp";
$owl_lang->alt_del_file      	= "Esborrar fitxer (S/N)";
$owl_lang->alt_del_folder    	= "Esborrar carpeta (S/N)";
$owl_lang->alt_del_group	= "Esborrar aquest Grup";
$owl_lang->alt_del_news		= "Esborrar aquesta not&iacute;cia";
$owl_lang->alt_del_selected	= "Esborrar Tots els fitxers Seleccionats";
$owl_lang->alt_del_this_folder	= "Esborrar carpeta &#8211; ";
$owl_lang->alt_del_user		= "Esborrar aquest usuari";
$owl_lang->alt_deldoctype	= "Esborrar l'actual tipus de document";
$owl_lang->alt_edit_field	= "Editar la definici&oacute; d'aquest camp";
$owl_lang->alt_edit_group       = "Editar el grup seleccionat";
$owl_lang->alt_edit_news	= "Editar aquesta not&iacute;cia";
$owl_lang->alt_edit_user        = "Editar l'usuari seleccionat";
$owl_lang->alt_email		= "E-Mail aquest fitxer";
$owl_lang->alt_email_reminder 	= "Recordatori per E-Mail";
$owl_lang->alt_email_selected	= "Enviar per correu tots els fitxers seleccionats";
$owl_lang->alt_get_file      	= "Descarregar fitxer";                                                                                                                                                 
$owl_lang->alt_get_folder       = "Descarregar contingur de carpeta";
$owl_lang->alt_go_bottom      	= "Anar al final de la p&agrave;gina";
$owl_lang->alt_go_top 		= "Anar al comen&ccedil;ament de la p&agrave;gina";
$owl_lang->alt_have_news	= "Tens Not&iacute;cies per veure";
$owl_lang->alt_have_no_news	= "No hi ha noves not&iacute;cies per veure";
$owl_lang->alt_home_folder	= "Tornar al Directori Inicial";
$owl_lang->alt_link_file     	= "Enlla&ccedil;ar Aquest fitxer a una altra carpeta";
$owl_lang->alt_lock_file        = "Desmarcar fitxers";
$owl_lang->alt_log_clear        = "Esborrar tots els Logs (S/N)";
$owl_lang->alt_log_file         = "Fitxer Log";
$owl_lang->alt_log_next		= "Mostrar registres següents";
$owl_lang->alt_log_prev		= "Mostrar registres anteriors";
$owl_lang->alt_log_top		= "Anar al primer registre";
$owl_lang->alt_mod_file      	= "Modificar propietats del fitxer"; 
$owl_lang->alt_mod_folder    	= "Modificar Propietats de carpeta";
$owl_lang->alt_monitor		= "Monitoritzar aquest fitxer";
$owl_lang->alt_monitor_folder	= "Monitoritzar aquesta carpeta";
$owl_lang->alt_monitored	= "Aturar la monitoritzaci&oacute; d'aquest fitxer";
$owl_lang->alt_monitored_folder	= "Aturar Monitoritzaci&oacute; d'aquesta Carpeta";
$owl_lang->alt_move_file     	= "Moure fitxer";
$owl_lang->alt_move_folder   	= "Moure carpeta";
$owl_lang->alt_move_selected	= "Moure tots els fitxers seleccionats";
$owl_lang->alt_my_approval	= "Document(s) esperant la meva aprovaci&oacute;";
$owl_lang->alt_new_doctype	= "Crear nou tipus de document";
$owl_lang->alt_news_close	= "Tancar la finestra de not&iacute;cies";
$owl_lang->alt_news_next	= "Mostrar les not&iacute;cies següents";
$owl_lang->alt_news_prev	= "Mostrar les not&iacute;cies anterios";
$owl_lang->alt_news_print	= "Imprimir aquesta not&iacute;cia";
$owl_lang->alt_pending_approval	= "Document(s) pendents d'aprovaci&oacute;";
$owl_lang->alt_play_file 	= "Fitxer Play Media";
$owl_lang->alt_publish_file 	= "Publicar el document";
$owl_lang->alt_recycle		= "Paperera<br />(Buidar)";
$owl_lang->alt_recycle_disable	= "Paperera<br />(Deshabilitada)";
$owl_lang->alt_recycle_not_found= "Paperera<br />(No trobada)";
$owl_lang->alt_refresh_filter	= "Iniciar filtre / Refrescar resultats";
$owl_lang->alt_register		= "Enviar el teu registre";
$owl_lang->alt_reject_file 	= "Rebutjar aquest document";
$owl_lang->alt_related		= "Trobar documents relacionats";
$owl_lang->alt_reset_form	= "Esborrar formulari";
$owl_lang->alt_rest_selected	= "Restaurar tots els fitxers seleccionats";
$owl_lang->alt_search		= "Iniciar la cerca";
$owl_lang->alt_send_email	= "Enviar E-Mail";
$owl_lang->alt_sendfile		= "Enviar fitxer";
$owl_lang->alt_set_initial_dir	= "Posar el directori actual com inicial";
$owl_lang->alt_site_map         = "Mapa del lloc";
$owl_lang->alt_submit      	= "Enviar formulari";
$owl_lang->alt_toggle_check_box	= "Canviar marcatge de caselles";
$owl_lang->alt_tool_status_green= "Eina activa";
$owl_lang->alt_tool_status_red	= "La ruta &eacute;s incorrecta I/O no &eacute;s Executable";
$owl_lang->alt_unlock_file      = "Desbloquejar fitxer";
$owl_lang->alt_upd_field	= "Actualitzar aquest camp";
$owl_lang->alt_upd_file      	= "Actualitzar fitxer";
$owl_lang->alt_view_comments    = "Afegir / Veure Comentaris del fitxer";
$owl_lang->alt_view_file     	= "Veure fitxer";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Administrar Paperera";
$owl_lang->alt_edit_file_inline = "Editar fitxer de text";
$owl_lang->alt_gen_pdf          = "Generar versio PDF del fitxer";
$owl_lang->alt_updated     	= "Document actualitzat des de l'&uacute;ltima visita";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "Document pujat des de l'&uacute;ltima visita";
// NEW STUFF END

//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Tot el contingut ha estat esborrat";
$owl_lang->log_detail		= "No hi ha detalls addicionals";
$owl_lang->log_file_to		= "A: ";
$owl_lang->log_filter_all	= "TOT";
$owl_lang->log_login_det	= "Nom d'usuari: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Grup canviat: ";
$owl_lang->log_admin_changed_user = "Usuari canviat: ";
$owl_lang->log_admin_created_group = "Grup creat: ";
$owl_lang->log_admin_created_user = "Usuari creat: ";
$owl_lang->log_admin_del_group = "Grup esborrat: ";
$owl_lang->log_admin_del_user = "Usuari esborrat: ";
$owl_lang->log_admin_disabled = " Usuari deshabilitat: ";
$owl_lang->log_admin_email_restore = "Fitxers enviats per correu:";
$owl_lang->log_admin_trash_delfile= "Fitxer esborrat: ";
$owl_lang->log_admin_trash_delfold = "Carpeta esborrada: ";
$owl_lang->log_admin_trash_empty = "Paperera buidada";
$owl_lang->log_admin_trash_restore = "Restaurat: ";
$owl_lang->log_login_expired    = "Login d'usuari expirat: ";
$owl_lang->log_login_too_many_attempts = "Deshabilitat (Massa Logins fallits): ";
$owl_lang->log_readhd_feature_add  = "Lectura directa des de HD afegit a aquest fitxer";
$owl_lang->log_admin_to  = "a";
$owl_lang->log_admin_of  = "de";
// END NEW STUFF
$log_file_actions[1]        	= "LOGIN";
$log_file_actions[10]        	= "FITXER DESBLOQUEJAT";
$log_file_actions[11]        	= "FITXER ENVIAT PER E-MAIL";
$log_file_actions[12]        	= "FITXER MOGUT";
$log_file_actions[13]        	= "CARPETA CREADA";
$log_file_actions[14]        	= "CARPETA ESBORRADA";
$log_file_actions[15]        	= "CARPETA MODIFICADA";
$log_file_actions[16]        	= "CARPETA MOGUDA";
$log_file_actions[17]        	= "PASS PERDUT";
$log_file_actions[18]        	= "REG USUARI";
$log_file_actions[19]           = "FITXER MOSTRAT";
$log_file_actions[2]        	= "LOGIN INV&Agrave;LID";
$log_file_actions[20]           = "FILE VIRUS";
$log_file_actions[21]           = "FITXER COPIAT";
$log_file_actions[22]           = "CARPETA COPIADA";
$log_file_actions[23]           = "FITXER ENLLA&Ccedil;AT";
$log_file_actions[3]        	= "LOGOUT";
$log_file_actions[4]        	= "FITXER ESBORRAT";
$log_file_actions[5]        	= "FITXER PUJAT";
$log_file_actions[6]        	= "FITXER ACTUALITZAT";
$log_file_actions[7]        	= "FITXER DESCARREGAT";
$log_file_actions[8]        	= "FITXER CANVIAT";
$log_file_actions[9]        	= "FITXER BLOQUEJAT";
// BEGIN NEW STUFF
$log_file_actions[24]           = "ADMIN. USUARIS";
$log_file_actions[25]           = "PAPERERA";
$log_file_actions[26]           = "FITXER ACL";
$log_file_actions[27]           = "CARPETA ACL";
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
$owl_lang->admin_login_date  = "Usuari admin validat el: ";
$owl_lang->admin_login_from  = "Usuari admin validat des de";
$owl_lang->admin_login_subject  = "LOGIN USUARI ADMIN";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Acc&eacute;s An&ograve;nim)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Has perdut el teu password?";
$owl_lang->like_register	= "Vols Registrar-te?";
$owl_lang->login		= "Login";
$owl_lang->logindisabled	= "El compte ha estat DESHABILITAT, contacta amb l'Administrador";
$owl_lang->loginfail		= "Login inv&agrave;lid";
$owl_lang->password		= "Password";
$owl_lang->repository_list      = "Repositori:";
$owl_lang->successlogout 	= "Has sortit correctament";
$owl_lang->toomanysessions	= "Has rebassat el nombre m&agrave;xim de sessions, contacta amb l'administrador";
$owl_lang->username		= "Nom d'usuari";
$owl_lang->version 		= "Versi&oacute;";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Accions";
$owl_lang->current_db         		= "BDD Actual:";
$owl_lang->current_folder 		= "Carpeta actual:";
$owl_lang->del_all			= "Esborrar paperera";
$owl_lang->del_selected			= "Esborrar seleccionats";
$owl_lang->disk_quota			= "Quota de disc:";
$owl_lang->doc_number 			= "Doc #";
$owl_lang->email_selected		= "E-Mail seleccionats";
$owl_lang->file 			= "Fitxer";
$owl_lang->folder_count_file		= "Fitxer(s)";
$owl_lang->folder_count_folder		= "Carpeta(s)";
$owl_lang->folder_count_note		= "Nota(s)";
$owl_lang->folder_count_pre		= "Aquesta Carpeta Cont&eacute;";
$owl_lang->folder_count_url		= "URL(s)";
$owl_lang->folder_policy 		= "Pol&iacute;tiques de la Carpeta Actual:";
$owl_lang->held                      	= "Bloquejat"; 
$owl_lang->last_logged			= "&Uacute;ltim entrat: ";
$owl_lang->menu_file_action		= "Accions amb fitxers disponibles";
$owl_lang->menu_folder_action           = "Accions amb carpetes disponibles";
$owl_lang->menu_url_action		= "Accions URL disponibles";
$owl_lang->modified 			= "Modificat";
$owl_lang->move_selected		= "Moure seleccionats";
$owl_lang->new_file			= "Nou!";
$owl_lang->no_description		= "No hi ha Descripci&oacute; Disponible";
$owl_lang->owner                        = "User";
$owl_lang->page				= "P&agrave;gina:";
$owl_lang->panel_file_info		= "Informaci&oacute; del fitxer";
$owl_lang->postedby 			= "Afegit per";
$owl_lang->reallydelete         	= "Est&agrave;s segur que vols esborrar?";
$owl_lang->reallydelete_logs            = "Realment vols esborrar el fitxer de succesos?";
$owl_lang->reallydelete_selected    	= "Realment vols esborrar els fitxers seleccionats?";
$owl_lang->reallyrestore_selected	= "Realment vols restaurar els fitxers seleccionats?";
$owl_lang->rest_selected		= "Restaurar seleccionats";
$owl_lang->score 			= "Record";
$owl_lang->size 			= "Grand&agrave;ria";
$owl_lang->title 			= "T&iacute;tol";
$owl_lang->tot_files			= "Total:";
$owl_lang->tot_monitored		= "Monitoritzats:";
$owl_lang->tot_my_checked_out		= "Revisats:";
$owl_lang->tot_my_files			= "Meus:";
$owl_lang->tot_my_group			= "Grup:";
$owl_lang->tot_new_files		= "Nous:";
$owl_lang->updated_by 			= "Actualitzat per";
$owl_lang->tot_updated_files		= "Actualitzats:";
$owl_lang->updated_file			= "Actualitzat!";
$owl_lang->user               		= "Usuari";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days :";
// NEW STUFF
$owl_lang->favorite 			= "Favorits";
$owl_lang->favorite_add 		= "Afegir";
$owl_lang->favorite_delete 		= "Esborrar";
$owl_lang->favorite_go 			= "Anar";
$owl_lang->files_in_my_group_title 	= "Fitxers del meu Grup(s)";
$owl_lang->my_files_title= "Els meus fitxers";
$owl_lang->my_monitored_title= "El(s) meu(s) fitxer(s)/carpeta(es) monitoritzat(s)";
$owl_lang->my_special_access_title= "LLista especial d'acc&eacute;s";
$owl_lang->special_access_count_alt= "Fitxers/Carpetes d'acc&eacute;s especial";
$owl_lang->special_access_count= "Acc&eacute;s especial:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Afegir / Veure comentaris: ";
$owl_lang->addingfile       = "Afegir el fitxer a ";
$owl_lang->addingfolder     = "Afegir la carpeta a ";
$owl_lang->attach_file		= "Adjuntar fitxer";
$owl_lang->change		= "Canviar";
$owl_lang->comments      	= "Commentari";
$owl_lang->comments_added       = "Comentaris afegits per: ";
$owl_lang->create		= "Crear";
$owl_lang->description 		= "Descripci&oacute;";
$owl_lang->disp_mp3             = "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Can&ccedil;&oacute;:<BR>Album:<BR>Bitrate&nbsp;-&nbsp;Samplerate:<BR>Duraci&oacute;:<BR>G&egrave;nere:<BR>Comentaris:";
$owl_lang->email_body		= "Missatge";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to   = "Respondre a (Reply To):";
$owl_lang->email_subject	= "Assumpte:";
$owl_lang->email_to		= "Per a:";
$owl_lang->emailing		= "Enviant Correu";
$owl_lang->keywords 		= "Paraules Clau";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Modificant ";
$owl_lang->name               	= "Nom"; 
$owl_lang->none_selected        = "CAP SELECCIONAT";
$owl_lang->note_content         = "Contingut de nota";
$owl_lang->notify_link          = "Enlla&ccedil; extern";
$owl_lang->ownergroup         	= "Propietari (Grup)";
$owl_lang->ownership		= "Propietat de";
$owl_lang->permissions 		= "permisos";
$owl_lang->pick_select		= "&#8211; Seleccionar un usuario de la BDD &#8211;";
$owl_lang->policy 		= "Pol&iacute;tiques";
$owl_lang->post_comment		= "Pos-comentari";
$owl_lang->prop_permissions     = "Propagar permisos a subcarpetes?";
$owl_lang->prop_perms_files     = "permisos a propagar a fitxers:";
$owl_lang->sendfile         = "Enviar fitxer";
$owl_lang->sendthisfile     = "Enviar aquest fitxer";
$owl_lang->sendthisurl          = "Enviar aquesta URL";
$owl_lang->updating		= "Actualitzant";
$owl_lang->verdescription 	= "Descripci&oacute; de canvis (Revisi&oacute;)";
$owl_lang->vermajor          	= "Canvis extensius";
$owl_lang->verminor          	= "Canvis m&iacute;nims";
$owl_lang->vertype           	= "Tipus de canvi";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Save Keyword?";
$owl_lang->archive_skip_file    = "SKIPPED: ";
$owl_lang->archive_skip_message = "The Following Files Have been Skipped they already exist";
$owl_lang->archive_extract_current  = "Extract to Current Folder?";
$owl_lang->archive_extract_overwrite  = "Overwrite Existing Files (Update)?";
$owl_lang->optional_file_index  = "Index file?:";

//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email        = "Adre&ccedil;a de Correu Electr&ograve;nic";
$owl_lang->full_name            = "Nom Complert";
$owl_lang->register         = "Registre de l'usuari";
$owl_lang->self_failed      = "Fallit";
$owl_lang->self_passwd      = "Password enviat a:";
$owl_lang->self_reg_bod     = "El teu Password &eacute;s:";
$owl_lang->self_reg_rset    = "El teu Password ha estat canviat a:";
$owl_lang->self_reg_subj    = "El teu compte";
$owl_lang->send_pass            = "Enviar Password";
$owl_lang->submit               = "Registre";
$owl_lang->thank_you_1          = "Gr&agrave;cies!";

//NEW STUFF

$owl_lang->captcha_typein        = "Escriu els 5 caracters";
$owl_lang->change_pass_title	      = "CANVI DE PASSWORD";
$owl_lang->err_cant_reuse_passwords   = "No pots reutilitzar passwords antics";
$owl_lang->err_new_confirm_different  = "El password nou i el de confimaci&oacute; no coincideixen <br />";
$owl_lang->err_old_pass_ver_failed    = "El teu password antic &eacute;s incorrecte <br />";
$owl_lang->err_pass_restriction_1     = "El teu password ha de tenir almenys &ldquo;%s&rdquo; caracters <br />";
$owl_lang->err_pass_restriction_2     = "cont&eacute; almenys &ldquo;%s&rdquo; caracters num&egrave;rics [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "i almenys &ldquo;%s&rdquo; caracters especials [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "El nom d'usuari escollit &ldquo;%s&rdquo; t&eacute; %d caracters, i n'ha de tenir almenys %d.";
$owl_lang->pass_change_email_1        = "Your Password was not Reset as you are not using Owl Authentication";
$owl_lang->pass_change_email_2        = "El tipus d'autentificaci&oacute; &eacute;s: ";
$owl_lang->pass_change_email_3        = "Si necessites ajuda contacta amb el teu Administrador del sistema";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button        = "Cancel&middot;lar";
$owl_lang->copy_file		= "Copiant fitxer";
$owl_lang->copy_folder		= "Copiant carpeta";
$owl_lang->moving               = "Movent";
$owl_lang->moving_file		= "Movent fitxer";
$owl_lang->moving_folder	= "Movent carpeta";
$owl_lang->select		= "Selecciona una nova carpeta:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Mostrant l'hist&ograve;ric de ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Dif de";
$owl_lang->diff_to	= "Dif a";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF

//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Notificaci&oacute; de comentari";
$owl_lang->confpassword = "Confirma la nova contrasenya";
$owl_lang->email_tool	= "Eina E-Mail";
$owl_lang->group    = "Grup principal";
$owl_lang->groupmember  = "Membre del grup";
$owl_lang->last_modified= "&Uacute;ltim modificat";
$owl_lang->newpassword  = "Nova contrasenya";
$owl_lang->newsadmin    = "Administrador de not&iacute;cies";
$owl_lang->not_member   = "No ets membre de grup";
$owl_lang->notification = "Rebre notificacions";
$owl_lang->oldpassword  = "Contrasenya anterior";
$owl_lang->preference   = "Prefer&egrave;ncies";
$owl_lang->saved	= "&#8212; C A N V I S &nbsp;&nbsp;&nbsp;G U A R D A T S &#8212;";
$owl_lang->status_no	= "NO";
$owl_lang->status_yes	= "S&Iacute;";
$owl_lang->userlang	= "Idioma";

//NEW STUFF
$owl_lang->useradmin	= "Usuari administrador";
$owl_lang->viewlogs     = "Pot veure Logs del sistema";
$owl_lang->viewreports  = "Pot veure informes del sistema";
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

$owl_lang->elapsed_time         = "temps transcorregut";
$owl_lang->query_empty      = "Cadena de cerca buida";
$owl_lang->related_query_empty  = "No hi ha metadada associada amb el document que realitzi 'Cerca Relacionada'";
$owl_lang->search       = "Cercar";
$owl_lang->search_all_word      = "Totes les paraules";
$owl_lang->search_any_word      = "Qualsevol paraula";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Cerca de la carpeta actual";
$owl_lang->search_entire_phrase = "Frase completa";
$owl_lang->search_for_files     = "Cercant fitxers";
$owl_lang->search_for_folders   = "Cercant carpetes";
$owl_lang->search_match         = "Comparar:";
$owl_lang->search_results_for   = "Resultats de la cerca sobre";
$owl_lang->search_score         = "Fitxers trobats";
$owl_lang->search_winthindocs   = "Cerca en Documents(text, pdf i MS-Word)" ;

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Mostrant ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************
$owl_lang->add				= "Afegir";
$owl_lang->admin_login_to_browse_page	= "Admin va a veure documents despr&eacute;s de la identificació";
$owl_lang->alt_btn_backup		= "Backup SQL BDD";
$owl_lang->alt_btn_doctype_admin	= "Administrador de tipus de document";
$owl_lang->alt_btn_html_prefs		= "Editar prefer&egrave;ncies del lloc HTML";
$owl_lang->alt_btn_initial_load		= "Carrega la base SQL de la carpeta Documents";
$owl_lang->alt_btn_log_viewer		= "Mostrar successos";
$owl_lang->alt_btn_news_admin		= "Administraci&oacute; de not&iacute;cies";
$owl_lang->alt_btn_site_features	= "Editar caracter&iacute;stiques i configuracions del lloc";
$owl_lang->alt_btn_statistics_viewer	= "Visor d'estad&iacute;stiques";
$owl_lang->alt_btn_trashcan		= "Visualitza el contingut de la Paperera";
$owl_lang->alt_btn_users_groups		= "Administrar usuaris i grups";
$owl_lang->anonymous_account		= "Compte d'acc&eacute;s an&ograve;nim:";
$owl_lang->btn_backup			= "Backup<br />BDD";
$owl_lang->btn_doctype_admin		= "Typus de<br />documents";
$owl_lang->btn_html_prefs		= "Prefer&egrave;ncies<br />HTML";
$owl_lang->btn_initial_load		= "C&agrave;rrega inicial";
$owl_lang->btn_news_admin		= "Administraci&oacute;<br />de not&iacute;cies";
$owl_lang->btn_site_features		= "Caracter&iacute;stiques<br />del Lloc";
$owl_lang->btn_statistics_viewer	= "Visor de<br />Estad&iacute;stiques/Informes";
$owl_lang->btn_trashcan			= "Paperera";
$owl_lang->btn_users_groups		= "Usuaris<br />i Grups";
$owl_lang->buttonstyle                  = "Estil de bot&oacute;";
$owl_lang->confirm_initial_load		= "*** ATENCI&Oacute; ***  Aix&ograve; nom&eacute;s s'hauria d'executat una vegada quan la BDD estigu&eacute;s buida";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Esborrar grup";
$owl_lang->deleteuser			= "Esborrar usuari";
$owl_lang->disable_recs_per_page	= "Habilitar vista restrictiva DESHABILITAR&Agrave;S Registres per p&agrave;gina!";
$owl_lang->disableuser			= "Deshabilitar usuari";
$owl_lang->display_password_override    = "Anular la vista de Password de fitxer/Carpeta";
$owl_lang->doc_id_num_digits		= "Nombre de d&iacute;gits del prefix Doc#";
$owl_lang->doc_id_prefix		= "Cadena del prefix Doc#"; 
$owl_lang->docicon_column		= "Icona de Doc";
$owl_lang->download_folder_zip          = "Baixar carpetes en format ZIP (tar.gz per defecte)";
$owl_lang->file_admin_group		= "Grup administrador d'fitxers / Examinar:";
$owl_lang->flushed           		= "La taula de les sessions a estat purgada, l'usuari pot tornar a entrar de nou.<BR>";
$owl_lang->groups			= "Grups";
$owl_lang->hide_bulk_buttons		= "Ocultar botons de selecci&oacute; m&uacute;ltiple:";
$owl_lang->save_keywords_to_db		= "Perm&iacute;s per desar paraules clau per a &uacute;s posterior";
$owl_lang->status_column		= "Estat";
$owl_lang->vermajor_initial          	= "Inicial de revisi&oacute; Major";
$owl_lang->verminor_initial          	= "Inicial de revisi&oacute; Menor";
$owl_lang->view_doc_in_new_window	= "Nova finestra per mostrar Documents";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Editant usuari *****";
$owl_lang->edit_group  			= "***** Editant grup *****";
$owl_lang->enter_new_user               = "***** Afegint nou usuari *****";
$owl_lang->enter_new_group              = "***** Afegint nou grup *****";
$owl_lang->alt_btn_change_passwd        = "Canviar Password";
$owl_lang->alt_btn_cln_history          = "Purgar documents m&eacute;s antics(dies) de: ";
$owl_lang->alt_btn_log_viewer           = "Mostrar Successos";
$owl_lang->alt_btn_report_viewer        = "Mostrar informes";
$owl_lang->btn_change_passwd            = "Canviar Password";
$owl_lang->btn_cln_history              = "Purgar Historial";
$owl_lang->btn_log_viewer               = "Mostrar<br />successos";
$owl_lang->btn_report_viewer            = "Informes";
$owl_lang->confirm_cln_history          = "Segur que vols purgar documents m&eacute;s antics(dies) de: ";
$owl_lang->historical_purge             = "Fitxers històrics esborrats";

// END NEW STUFF
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image           = "Ruta per Imatge de fons (body):";
$owl_lang->ht_bd_lnk_cl             = "Color dels links (body):";
$owl_lang->ht_bd_txt_cl             = "Color del text del cos:";
$owl_lang->ht_bd_vlnk_cl            = "Color dels links visitats (body):";
$owl_lang->ht_collapse_width        = "Amplada de la vista comprimida:";
$owl_lang->ht_expand_width          = "Amplada de la vista expandida:";
$owl_lang->ht_tbl_border_sz         = "Grand&agrave;ria de borde de la taula:";
$owl_lang->ht_tbl_cell_bg_al        = "Color de fons alternatiu de les cel&middotles de la taula:";
$owl_lang->ht_tbl_cell_bg_cl        = "Color de fons de les cel&middotles de la taula:";
$owl_lang->ht_tbl_hd_bg             = "Fons de la cap&ccedil;alera:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Establir Acc&eacute;s An&ograve;nim";
$owl_lang->header_group_admin           = "Administraci&oacute; de Grups";
$owl_lang->header_sitefeatures_settings           = "Caracter&iacute;stiques i Configuraci&oacute; del Lloc";
$owl_lang->header_user_admin           	= "Administraci&oacute; d'Usuaris";
$owl_lang->hide_folder_doc_count	= "Ocultar Compte de tipus fitxer i carpeta";
$owl_lang->hide_folder_size		= "Ocultar Tamany de Contingut de carpeta";
$owl_lang->hide_panel			= "Ocultar";
$owl_lang->home_dir			= "Directori arrel de l'usuari:";
$owl_lang->initial_dir   		= "Directori inicial de l'usuari";
$owl_lang->maxsessions			= "No. Max de sessions";
$owl_lang->noprefaccess			= "Deshabilitar prefer&egrave;ncies";
$owl_lang->old_action_icons		= "Usar Icones d'Acci&oacute; de versions anteriors a Owl 0.80";
$owl_lang->owl_anon_download     	= "Nom&eacute;s desc&agrave;rrega";
$owl_lang->owl_anon_full		= "Access total";
$owl_lang->owl_anon_ro			= "Nom&eacute;s lectura";
$owl_lang->owl_dbdump_path   		= "Ruta per al volcat de la BDD (backup):";
$owl_lang->owl_def_file_group_owner	= "Grup per defecte:";
$owl_lang->owl_def_file_meta		= "Meta Data dels fichers per defecte:";
$owl_lang->owl_def_file_owner		= "Propietari per defecte:";
$owl_lang->owl_def_file_perm 		= "Pol&iacute;tiques per defecte:";
$owl_lang->owl_def_file_security	= "Seguretat dels fitxers per defecte:";
$owl_lang->owl_def_file_title		= "T&iacute;tol del fitxer per defecte (Res per a nom de fitxer):";
$owl_lang->owl_def_fold_group_owner	= "Grup de les carpetes per defecte:";
$owl_lang->owl_def_fold_owner		= "Propietari de les carpetes per defecte:";
$owl_lang->owl_def_fold_sec		= "Seguretat de les carpetes per defecte:";
$owl_lang->owl_def_folder_perm 		= "Seguretat de carpetes per defecte:";
$owl_lang->owl_default_tmpdir		= "Directori d'fitxers temporals: ";
$owl_lang->owl_email_from           = "Adre&ccedil;a E-Mail del From / SMTP Autoritz. Login:";
$owl_lang->owl_email_fromname       = "Nom complert:";
$owl_lang->owl_email_replyto        = "Adre&ccedil;a E-Mail del Reply To:";
$owl_lang->owl_email_server         = "Adre&ccedil;a E-Mail del server (es mostra en els avisos emesos):";
$owl_lang->owl_email_smtp               = "M&egrave;tode de correu SMTP ";
$owl_lang->owl_email_smtp_auth		= "Autoritzaci&oacute; SMTP";
$owl_lang->owl_email_smtp_auth_login	= "Login Autoritz. SMTP";
$owl_lang->owl_email_smtp_auth_passwd	= "Password Autoritz. SMTP";
$owl_lang->owl_email_subject_pref	= "Prefix d'assumpte:";
$owl_lang->owl_fogotpass		= "Mostrar link de Password Oblidat:";
$owl_lang->owl_group_user		= "Usuaris que s&oacute;n membres d'aquest grup";
$owl_lang->owl_gzip_path     		= "Ruta de gzip:";
$owl_lang->owl_hidebackup		= "Ocultar carpeta Backup:";
$owl_lang->owl_log_file             = "Activitats del fitxer de successos:";
$owl_lang->owl_log_login_act        = "Activitats de successos de Login/Logout:";
$owl_lang->owl_log_rec_page         = "# de sucessos per p&agrave;gina de registre:";
$owl_lang->owl_logging			= "Habilitar successos:";
$owl_lang->owl_logo			= "Logo per pagrave;gina de Login ([Llenguatge]/gr&agrave;fiques):";
$owl_lang->owl_lookAtHD			= "Deshabilitar cercar en disc dur local:";
$owl_lang->owl_lookAtHDDel		= "Eliminar fitxers esborrats de la BDD:";
$owl_lang->owl_max_filesize		= "M&agrave;xim tamany de fitxer";
$owl_lang->owl_owl_expand		= "Vista per defecte (Expandida)";
$owl_lang->owl_owl_timeout		= "Durada de la sessi&oacute; en segons:";
$owl_lang->owl_pdftotext_path		= "Mantenir Index de Cerca <br />PDF i fitxers de Text <br />&#8211; En blanc deshabilitat:";
$owl_lang->owl_pod2html_path            = "Requereix Perl 5.8.0 o superior<br />Ruta a pod2html:";
$owl_lang->owl_restrict_view		= "Habilitar la visualitzaci&oacute; restringida:";
$owl_lang->owl_self_reg			= "Habilitar autoregistre:";
$owl_lang->owl_self_reg_hd		= "PER DEFECTE PER A USUARIS AUTOREGISTRATS";
$owl_lang->owl_tar_path     		= "Ruta de tar:";
$owl_lang->owl_title_browser		= "CARACTER&Iacute;STIQUES DE LA VISTA DE DOCUMENTS";
$owl_lang->owl_title_custom		= "CONFIGURAR COLUMNES EN VISTA DE DOCUMENTS";
$owl_lang->owl_title_custom_search      = "CONFIGURAR RESULTATS DE CERCA";
$owl_lang->owl_title_defaults   	= "DEFECTE";
$owl_lang->owl_title_email		= "Configuraci&oacute; del sistema E-Mail";
$owl_lang->owl_title_HD			= "Configuraci&oacute; de la descripci&oacute; de la cerca HD per a nous fitxers";
$owl_lang->owl_title_logging  		= "Congiguraci&oacute; de successos";
$owl_lang->owl_title_other		= "Altres configuracions";
$owl_lang->owl_title_tools   		= "Eines BACKUP/GZIP de la BDD";
$owl_lang->owl_unzip_path     		= "Ruta unzip:";
$owl_lang->owl_version_control		= "Habilitar Caracter&iacute;stiques de control de versi&oacute;:";
$owl_lang->owl_wordtotext_path          = "fitxers MS-WORD<br />&#8211; En blanc deshabilitat:";
$owl_lang->owl_ppttotext_path          = "fitxers MS-POWERPOINT<br />&#8211; En blanc deshabilitat:";
$owl_lang->quota			= "Quota 0=Deshabilitat";
$owl_lang->reallydeluser		= "Aquest usuari &eacute;s propietari de %numfiles% fitxers(s) i %numfolders% Carpetes. Aquests FITXER(s) i Carpete(s) seran &ograve;rfans. Els vols esborrar?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Mostrar Registres Per P&agrave;gina (0 = Deshabilitat):";
$owl_lang->recycle_enabled              = "Habilitar la Paperera de Reciclatge:";
$owl_lang->recycle_location             = "Localitzaci&oacute; de Paperera de Reciclatge:";
$owl_lang->recycle_title                = "CONFIGURACI&Oacute; DE LA PAPERERA DE RECICLATGE";
$owl_lang->remember_me                  = "Mostra el vincle Recorda'm";
$owl_lang->remember_me_checkbox         = "Recorda'm";
$owl_lang->remember_me_title            = "CONFIGURACI&Oacute; DE LOGIN PERSISTENT";
$owl_lang->remember_timeout             = "Durada de cookies en dies";
$owl_lang->restore_file_prefix		= "String Prefix de cadena per a fitxers Restaurats";
$owl_lang->search_result_folders	= "Incloure carpetes en resultats de cerca";
$owl_lang->show_action_title		= "Mostrar buttons d'acci&oacute;:";
$owl_lang->show_bulk_title		= "Mostrar buttons de selecci&oacute; m&uacute;ltiple:";
$owl_lang->show_folder_title		= "Mostrar eines de Carpeta:";
$owl_lang->show_panel			= "Mostrar";
$owl_lang->show_panel_title		= "Mostrar panel d'estat:";
$owl_lang->show_pref_title		= "Mostrar barra de pref/logout:";
$owl_lang->show_search_title		= "Mostrar barra de cerca:";
$owl_lang->status_bar_both              = "Bot&oacute; A dalt i a baix";
$owl_lang->status_bar_bottom            = "Nom&eacute;s bot&oacute;";
$owl_lang->status_bar_location          = "Mostrar la barra d'estat en el:";
$owl_lang->status_bar_not               = "No Mostrar";
$owl_lang->status_bar_top               = "Nom&eacute;s a Dalt";
$owl_lang->use_popup			= "Usar popup per mostrar not&iacute;cies:";
$owl_lang->users           		= "Usuaris";
$owl_lang->virus_path			= "Ruta de l'antivirusVirus<br />Exemple: '/usr/bin/clamscan --quiet' <br />&#8211; En blanc deshabilitat:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Camps personalitzats dins la descripci&oacute; al men&uacute; emergent";
$owl_lang->cust_headpopup     		= "CAMPS DE DOCUMENTS ESPEC&Iacute;FICS";
$owl_lang->auth_http                    = "Autenticaci&oacute; HTTP (.htaccess)";
$owl_lang->auth_ldap                    = "Autenticaci&oacute; LDAP";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Usuaris que estan en aquest grup com a Grup PRIMARI";
$owl_lang->create_user_homedir 		= "Create User HomeDir:";
$owl_lang->use_captcha 			= "Use CAPTCHA:";
$owl_lang->created_here 		= "<br /> (CREATED HERE IF create homedir checked)";
$owl_lang->auth_owl                     = "Autenticaci&oacute; Owl";
$owl_lang->auth_pop3                    = "Autenticaci&oacute; pop3";
$owl_lang->file_desc_required           = "Es requereix descripci&oacute; de fitxer";
$owl_lang->folder_desc_required         = "Es requereix descripci&oacute; de carpeta";
$owl_lang->html_title			= "Prefer&egrave;ncies HTML";
$owl_lang->pass_account_lockout         = "Nombre d'intents per al bloqueig:";
$owl_lang->pass_change_every            = "For&ccedil;ar canvi de Password cada (en dies) 0=Deshabilitat:";
$owl_lang->pass_enable_account_lockout  = "Habilitar compte bloquejat:";
$owl_lang->pass_min_passwd_length       = "M&iacute;nima longitud de password d'usuari:";
$owl_lang->pass_min_passwd_numeric      = "M&iacute;nim nombre de caracters num&egrave;rics:";
$owl_lang->pass_min_passwd_special      = "M&iacute;nim nombre de caracters especials:";
$owl_lang->pass_min_username_length     = "M&iacute;nima longitud de login d'usuari:";
$owl_lang->pass_track_old_passwords     = "Nombre de password previos para seguiment:";
$owl_lang->rtftotext_path               = "Path de l'eina RTF a Text";
$owl_lang->show_user_info           = "Mostrar informaci&oacute; d'usuari";
$owl_lang->user_admin              = "Admininstrador usuari/grup ";
$owl_lang->user_auth_type                   = "Tipus d'Autenticaci&oacute;:";
$owl_lang->user_change_pass_next_login      = "Canviar Password al següent login:";
$owl_lang->user_expires                     = "El compte expira el:";
$owl_lang->user_gmt_offset              = "Ajust GMT de l'usuari";
$owl_lang->user_group_admin                 = "Administrador de fitxers per al grup primari:";
$owl_lang->user_login_to_newrecords         = "A la connexi&oacute; anar a la p&agrave;gina de documents nous:";
$owl_lang->users_group_admin		= "Usuaris que s&oacute;n del Grup Admin";
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

$owl_lang->owl_log_filter       = "Filtres";
$owl_lang->owl_log_hd_action    = "Acci&oacute;";
$owl_lang->owl_log_hd_agent     = "Agent";
$owl_lang->owl_log_hd_dt_tm     = "Data Hora";
$owl_lang->owl_log_hd_dtls      = "Detalls";
$owl_lang->owl_log_hd_file      = "FITXER";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path  = "Ruta de carpetes";
$owl_lang->owl_log_hd_ip        = "Adre&ccedil;a IP";
$owl_lang->owl_log_hd_user      = "Usuari";
$owl_lang->owl_log_hide         = "Ocultar: ";
$owl_lang->owl_log_no_rec       = " NO S'HAN TROBAT SUCCESSOS ";
$owl_lang->owl_log_viewer       = "Visor de Successos";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Buidar Paperera";
$owl_lang->really_empty_trash   = "&iquest;Realment vols buidar la Paperera de Reciclatge?";
$owl_lang->recycle_bin_admin    = "Administraci&oacute; de Paperera de Reciclatge";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Els fitxers sol&middot;licitats s'han adjuntat.";
$owl_lang->trash_email_subject  = "RESTAURATS ELS FITXERS SOL&middot;LICITATS";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "No fer res -- Deixar nom&eacute;s els permisos de fitxer";
$owl_lang->everyoneread         = "Qualsevol pot llegir/descarregar";
$owl_lang->everyoneread_ad      = "Qualsevol pot llegir/descarregar";
$owl_lang->everyonewrite        = "Qualsevol pot llegir/escriure/descarregar";
$owl_lang->everyonewrite_ad         = "Qualsevol pot llegir/escriure/descarregar";
$owl_lang->everyonewrite_ad_nod     = "Qualsevol pot llegir/escriure/descarregar, NO ESBORRAR";
$owl_lang->everyonewrite_nod        = "Qualsevol pot llegir/escriure/descarregar, NO ESBORRAR";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread        = "Qualsevol pot llegir aquesta carpeta";
$owl_lang->geveryoneread_ad         = "Qualsevol pot llegir aquesta carpeta";
$owl_lang->geveryonewrite       = "Qualsevol pot afegir fitxers i esborrar aquesta carpeta";
$owl_lang->geveryonewrite_ad        = "Qualsevol pot afegir fitxers i esborrar aquesta carpeta";
$owl_lang->geveryonewrite_ad_nod    = "Qualsevol pot afegir fitxers a aquesta carpeta";
$owl_lang->geveryonewrite_nod       = "Qualsevol pot afegir fitxers a aquesta carpeta";
$owl_lang->ggroupread           = "Qualsevol pot llegir aquesta carpeta";
$owl_lang->ggroupread_ad        = "El grup seleccionat pot llegir aquesta carpeta";
$owl_lang->ggroupwrite          = "El teu grup pot afegir fitxers i esborrar aquesta carpeta";
$owl_lang->ggroupwrite_ad       = "El grup seleccionat pot afegir fitxers i esborrar aquesta carpeta";
$owl_lang->ggroupwrite_ad_nod       = "El grup seleccionat pot afegir fitxers a aquesta carpeta";
$owl_lang->ggroupwrite_nod      = "El teu grup pot afegir fitxers aquesta carpeta";
$owl_lang->ggroupwrite_worldread    = "El grup seleccionat pot afegir fitxers i esborrar aquesta carpeta i qaulsevol pot veure el seu contingut";
$owl_lang->ggroupwrite_worldread_ad     = "El grup seleccionat pot afegir fitxers i esborrar aquesta carpeta i qaulsevol pot veure el seu contingut";
$owl_lang->ggroupwrite_worldread_ad_nod = "El grup seleccionat pot afegir fitxers i esborrar aquesta carpeta i qaulsevol pot veure el seu contingut, NO ESBORRAR";
$owl_lang->ggroupwrite_worldread_nod    = "El grup seleccionat pot afegir fitxers i esborrar aquesta carpeta i qaulsevol pot veure el seu contingut, NO ESBORRAR";
$owl_lang->gonlyyou             = "Nom&eacute;s t&uacute; pots afegir fitxers i esborrar aquesta carpeta";
$owl_lang->gonlyyou_ad          = "Nom&eacute;s t&uacute; pots afegir fitxers i esborrar aquesta carpeta";
$owl_lang->groupread            = "El teu grup pot llegir/descarregar";
$owl_lang->groupread_ad         = "El teu grup pot llegir/descarregar";
$owl_lang->groupwrite           = "El teu grup pot llegir/escriure/descarregar";
$owl_lang->groupwrite_ad        = "El teu grup pot llegir/escriure/descarregar";
$owl_lang->groupwrite_ad_nod        = "El teu grup pot llegir/escriure/descarregar, NO ESBORRAR";
$owl_lang->groupwrite_nod       = "El teu grup pot llegir/escriure/descarregar, NO ESBORRAR";
$owl_lang->groupwrite_worldread     = "El grup seleccionat pot llegir/escriure/descarregar i qualsevol pot llegir";
$owl_lang->groupwrite_worldread_ad  = "El grup seleccionat pot llegir/escriure/descarregar i qualsevol pot llegir";
$owl_lang->groupwrite_worldread_ad_nod  = "El grup seleccionat pot llegir/escriure/descarregar (NO ESBORRAR)i qualsevol pot llegir";
$owl_lang->groupwrite_worldread_nod     = "El grup seleccionat pot llegir/escriure/descarregar (NO ESBORRAR)i qualsevol pot llegir";
$owl_lang->invalidsess          = "Identificador de sessi&oacute; inv&agrave;lid, si us intenta accedir de nou a la p&agrave;gina principal<BR>";
$owl_lang->notif_comment_1              = "Comentat en";
$owl_lang->notif_comment_2              = "Comentari:";
$owl_lang->notif_msg            = "AQUEST &Eacute;S UN MISSATGE GENERAT AUTOMATICAMENT DES DE LA Intranet<BR><BR>Fes Click en l'enll&agrave;&ccedil; per veure el fitxer nou/actualitzat.<BR><BR>";
$owl_lang->notif_msg_alt         	= "THIS IS AN AUTOMATED MESSAGE FROM OWL Intranet\n\nFind the new/updated file attached to this E-Mail\n\n";
$owl_lang->notif_msg_alt_link           = "AQUEST &Eacute;S UN MISSATGE GENERAT AUTOMATICAMENT DES DE LA Intranet\n\nFes Click en l'enll&agrave;&ccedil; per veure el fitxer nou/actualitzat\n\n";
$owl_lang->notif_msg_link               = "AQUEST &Eacute;S UN MISSATGE GENERAT AUTOMATICAMENT DES DE LA Intranet<br /><br />Fes Click en l'enll&agrave;&ccedil; per veure el fitxer nou/actualitzat<br /><br />";
$owl_lang->notif_salutation             = "Benvolgut";
$owl_lang->notif_subject_comment        = "S'han afegit Comentaris a un fitxer de la Intranet";
$owl_lang->notif_subject_monitor    = "El fitxer que est&agrave; monitoritzant-se ha estat actualitzat";
$owl_lang->notif_subject_new        = "Nou fitxer en Intranet";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd        = "Ha estat actualitzat un fitxer a la Intranet";
$owl_lang->notif_subject_file_deleted           = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account               = "A NEW OWL ACCOUNT WAS CREATED FOR YOU";
$owl_lang->notif_user			= "Creat/Actualitzar per:";
$owl_lang->onlyyou          = "Nom&eacute;s t&uacute; pots llegir/escriure/descarregar";
$owl_lang->onlyyou_ad           = "Nom&eacute;s t&uacute; pots llegir/escriure/descarregar";
$owl_lang->orphaned			= "&#8211; Sense propietari  &#8211;";
$owl_lang->owl_path                     = "Ruta del fitxer: ";
$owl_lang->sessinuse            = "La sessi&oacute; est&agrave; activa en una altra m&agrave;quina, acc&eacute;s denegat";
$owl_lang->sesstimeout          = "La teva sessi&oacute; ha expirat, si us plau accedeix de nou<BR>";
$owl_lang->virus_infected 		= "FITXER INFECTAT PER VIRUS";
$owl_lang->virus_return_val		= "Valor retornat per l'antivirus:";
$owl_lang->watermark_string             = "Confidential";
$owl_lang->watermark_source             = "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder          = "Examinar aquesta carpeta";
$owl_lang->title_browse_site            = "Examinar aquesta URL";
$owl_lang->title_download_view          = "Descarregar / Veure aquest fitxer";
$owl_lang->title_edit_prefs             = "Veure / Modificar Prefer&egrave;ncies d'Usuari";
$owl_lang->title_return_folder          = "Tornar a";
$owl_lang->title_sort                   = "Ordenar per";
$owl_lang->title_view_my                = "Veure llista dels meus fitxers";
$owl_lang->title_view_new               = "Veure llista de fitxers nous des de la meva &uacute;ltima visita";
$owl_lang->title_view_updated           = "Veure llista de fitxers actualitzats des de la meva &uacute;ltima visita";
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

$owl_lang->news_content                 = "Contingut";
$owl_lang->news_hd                      = "Not&iacute;cies";
$owl_lang->news_hd_audience             = "Audi&egrave;ncia Objectiu";
$owl_lang->news_hd_created              = "Creat en";
$owl_lang->news_hd_expires              = "Expira en";
$owl_lang->news_heading                 = "Cap&ccedil;alera de not&iacute;cies";
$owl_lang->news_posted_date             = "Not&iacute;cies publicades:";
$owl_lang->news_read                    = "Llegir";
$owl_lang->news_title                   = "Administraci&oacute; de not&iacute;cies";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: El directori de documets OWL: " .$default->owl_FileDir . "/" . fid_to_name(1) ." no existeix.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: El directori de documents OWL: " .$default->owl_FileDir . "/" . fid_to_name(1) ." no t&eacute; acc&eacute;s d'escriptura al servidor Web.";
$owl_lang->debug_file_not_exist		= "DEBUG: El fitxer '$default->owl_FileDir/%s' no existeix.<br /> OR<br />La ruta especificada per \$default->owl_FileDir en config/owl.php &eacute;s err&ograve;nia.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: El directori temporal OWL: %s no existeix.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: El directori temporal OWL: %s no t&eacute; acc&eacute;s d'escriptura al servidor Web.";
$owl_lang->debug_webserver_no_access	= "DEBUG: El servidor WEB no t&eacute; acc&eacute;s de lectura: <br />'$default->owl_FileDir/%s'. <br />Si us plau revisa els permisos i prova un altre cop";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer     = "Visor d'estad&iacute;sitiques";
$owl_lang->stats_files          = "nom d'fitxers per usuari";
$owl_lang->stats_folders        = "nom de carpetes per usuari";
$owl_lang->stats_information	= "Successos i fitxer de successos han de ser habilitats per poder veure aquestes estad&iacute;stiques";
$owl_lang->stats_top            = "20 desc&agrave;rregues m&eacute;s populars";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Validaci&oacute; USUARI (Login / Fallit / Logout)";
$owl_lang->stats_users_loggedin = "Actualment connectats";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration   = " Administraci&oacute; Tipus de Document";
$owl_lang->doc_field_label      = "Camp etiqueta (per local)";
$owl_lang->doc_field_name       = "Camp Nom";
$owl_lang->doc_field_pos        = "Camp Pos";
$owl_lang->doc_field_required   = "Requerit?";
$owl_lang->doc_field_searchable = "Cercable?";
$owl_lang->doc_field_size       = "Camp Tamany";
$owl_lang->doc_new_doc_type     = "--- Afegir nou tipus de document---";
$owl_lang->doc_specific         = "CAMPS ESPEC&Iacute;FICS DE DOCUMENT:";
$owl_lang->document_type        = "Tipus de document";
$owl_lang->document_type_name   = "Nom del tipus de document";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Insertar en la descripci&oacute; del popup?";
$owl_lang->doc_field_disp_label = "CAMP ETIQUETA:";
$owl_lang->doc_field_disp_sep = "ETIQUETA SEPARADOR";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;P&nbsp;R&nbsp;E&nbsp;V&nbsp;I&nbsp;S&nbsp;U&nbsp;A&nbsp;L&nbsp;I&nbsp;T&nbsp;Z&nbsp;A&nbsp;C&nbsp;I&nbsp;&Oacute;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Afegir a l'Explorador:";
$owl_lang->doc_field_show_in_list = "Veure el camp a l'Explorador:";
$owl_lang->doc_field_type	= "Camp tipus:";
$owl_lang->doc_field_values	= "Valors de camp separats amb | :";
$owl_lang->doc_fields = "Camps personalitzats";
// END NEW STUFF


//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grup:";
$owl_lang->header_csv_import    = "Importar fitxer CSV d'usuaris ";
$owl_lang->import_inserted      = "INSERTAT";
$owl_lang->import_skipped       = "IGNORAT";
$owl_lang->invalid_groupid      = "Inv&agrave;lid ID de grup --> ";
$owl_lang->msg_user_exists      = "L'usuari ja existeix";
$owl_lang->sendcsvfile          = "Pujar fitxer CVS";
$owl_lang->user_created_skipped = "Usuari:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Habilitar sistema de revisions:";
$owl_lang->owl_peer_review_opt  = "Fer la Revisi&oacute; opcional:";
$owl_lang->owl_title_peer_review= "SISTEMA DE REVISI&Oacute; DE LA DOCUMENTACI&Oacute;";
$owl_lang->owl_title_peer_review2= "Revisi&oacute; de documents";
$owl_lang->peer_approval_title 	= "Documents Esperant la meva Aprovaci&oacute;";
$owl_lang->peer_approved_body	= "El teu fitxer ha estat Validat:";
$owl_lang->peer_file_approved	= "Fitxer validat:";
$owl_lang->peer_file_final	= "Validaci&oacute; final:";
$owl_lang->peer_file_rejected	= "Fitxer per nova revisi&oacute;:";
$owl_lang->peer_file_to_review	= "Fitxer a revisar:";
$owl_lang->peer_final_approval	= "[Aprovaci&oacute; Final]: ";
$owl_lang->peer_final_body	= "El teu document ha estat aprovat per tots els revisors requerits.<br />Si us plau entra amb el teu login i fes el document public<br />";
$owl_lang->peer_msg_to_reviewer	= "Missatge per als Revisors";
$owl_lang->peer_my_approval	= "Esperant la meva Aprovaci&oacute;";
$owl_lang->peer_notif_user	= "Creat/Actualitzat per";
$owl_lang->peer_pending_approval= "Els meus documents pendents d'aprovaci&oacute;";
$owl_lang->peer_pending_title 	= "Documents meus pendents d'aprovaci&oacute;";
$owl_lang->peer_reject_reason   = "Ra&oacute; del rebuig";
$owl_lang->peer_rejected_body	= "El teu fitxer necessita Revisi&oacute;:";
$owl_lang->peer_review_body	= "Ha estat requerida la teva aprovaci&oacute; per al següent document:";
$owl_lang->peer_reviewer_list	= "Revisors(s)";
$owl_lang->peer_satus	 	= "Estat";
$owl_lang->peer_satus_approved  = "--- V A L I D A T ---";
$owl_lang->peer_satus_pending   = "--- P E N D E N T ---";
$owl_lang->peer_satus_rejected  = "--- A   R E V I S A R ---";
$owl_lang->peer_subj_approved	= "El teu document ha estat APROVAT";
$owl_lang->peer_subj_rejected	= "El teu document necessita una REVISI&Oacute;";
$owl_lang->peer_subj_reminder	= "RECORDA: Tens un fitxer per revisar";
$owl_lang->peer_subj_review	= "Tens un fitxer per Revisar";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "El teu document ha estat aprovat per tots els revisors.<br />S'ha publicat el fitxer.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************
//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Afegir fitxer ACL:";
$owl_lang->acl_adding_folder           = "Afegir carpeta ACL:";
$owl_lang->acl_available_groups        = "Grup(s) disponibles";
$owl_lang->acl_available_users         = "Usuari(s) disponibles";
$owl_lang->acl_edit_file               = "Editant fitxer ACL:";
$owl_lang->acl_edit_folder             = "Editant carpeta ACL:";
$owl_lang->acl_file_checkin            = "Marcar/Desmarcar";
$owl_lang->acl_file_comment            = "Comentar";
$owl_lang->acl_file_copy               = "Copiar";
$owl_lang->acl_file_delete             = "Esborrar";
$owl_lang->acl_file_email              = "Correu";
$owl_lang->acl_file_modify             = "Propietats";
$owl_lang->acl_file_monitor            = "Monitor";
$owl_lang->acl_file_move               = "Moure";
$owl_lang->acl_file_read               = "Llegir";
$owl_lang->acl_file_search             = "Cerca aproximada";
$owl_lang->acl_file_set_acl            = "Definir ACL";
$owl_lang->acl_file_update             = "Actualitzar";
$owl_lang->acl_file_view_log           = "Veure Log";
$owl_lang->acl_folder_copy             = "Copiar";
$owl_lang->acl_folder_delete           = "Esborrar";
$owl_lang->acl_folder_modify           = "Modificar propietats";
$owl_lang->acl_folder_monitor          = "Monitor";
$owl_lang->acl_folder_move             = "Moure";
$owl_lang->acl_folder_read             = "Llegir (Baixar/Mostrar)";
$owl_lang->acl_folder_set_acl          = "Definir ACL";
$owl_lang->acl_folder_write            = "Escriure (Crear)";
$owl_lang->acl_heading_file            = "Grop(s)/Usuari(s)";
$owl_lang->acl_heading_files           = "FITXERS &#8211; SELECCIONAR USUARI(s) i GRUP(s) DESITJATS";
$owl_lang->acl_heading_folder          = "Group(s)/User(s)";
$owl_lang->acl_heading_folders         = "CARPETES &#8211; SELECCIONAR USUARI(s) i GRUP(s) DESITJATS";
$owl_lang->acl_propagate_file          = "Definir aquesta pol&iacute;tica de seguretat a \"TOTS\" els fitxers:";
$owl_lang->acl_propagate_folders       = "Propagar a totes les subcarpetes:";
$owl_lang->acl_selected_groups         = "Grup(s) sel&middot;leccionats";
$owl_lang->acl_selected_users          = "Usuari(s) sel&middot;leccionats";
$owl_lang->acl_set_acl                 = "Definir pol&iacute;tica de seguretat";
$owl_lang->acl_set_acl_now             = "Definir pol&iacute;tica de seguretat ara:";
$owl_lang->acl_set_selected            = "Definir la selecci&oacute;";
$owl_lang->alt_acl_save_file           = "Desar pol&iacute;tiques de seguretat del fitxer";
$owl_lang->alt_acl_save_folder         = "Desar pol&iacute;tiques de seguretat de la carpeta";
$owl_lang->btn_acl_save                = "Desar";
$owl_lang->acl_set_file_permissions    = "Definir permisos de fitxer";
$owl_lang->acl_set_folder_permissions  = "Definir permisos de carpeta";
$owl_lang->alt_set_folder_acl	       = "Definir pol&iacute;tica de seguretat de la carpeta actual";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Informes disponibles:";
$owl_lang->report_file_folder               = "Fitxer/Carpeta";
$owl_lang->report_filter                    = "Filtre:";
$owl_lang->report_filter_since              = "Des de:";
$owl_lang->report_full_access               = "ACC&Eacute;S TOTAL";
$owl_lang->report_select_report             = "&#8211; Selecciona un informe &#8211;";
$owl_lang->report_users_disabled_title      = "Usuaris(s) deshabilitats";
$owl_lang->report_users_entitlement         = "Llistat d'accessos dels usuaris";
$owl_lang->report_users_inactive_title      = "Usuari(s) inactiu des de";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Habilitar vista/generaci&oacute; de vinyetes:";
$owl_lang->thumb_gen_thumb_tool_path       = "Path de la eina de conversi&oacute; ImageMagick:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Par&agrave;metres Mplayer:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Path de Mplayer:";
$owl_lang->thumb_image_info                = "Informaci&oacute; de la imatge";
$owl_lang->thumb_large_width               = "Amplada de la vinyeta (GRAN) en pixels:";
$owl_lang->thumb_med_width                 = "Amplada de la vinyeta (MITJANA) en pixels:";
$owl_lang->thumb_number_colums             = "Nombre de columnes per la vista de la vinyeta:";
$owl_lang->thumb_re_generate               = "Generar vinyeta";
$owl_lang->thumb_small_width               = "Amplada de la vinyeta (PETITA) en pixels, 0=No mostrar:";
$owl_lang->thumb_title                     = "OPCIONS DE VISTA/GENERACI&Oacute; DE VINYETES";
$owl_lang->thumb_title_thumb_view          = "DETALLS DE LES VINYETES";
$owl_lang->thumb_image_size                = "Grand&agrave;ria de la imatge:";
$owl_lang->alt_thumb_small                 = "Vinyeta petita";
$owl_lang->alt_no_thumb                    = "Vinyeta no disponible";

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
