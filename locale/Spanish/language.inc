<?php

/*
 * File: Spanish/language.inc
 * Author: Milton Peña Sarmiento
 * Date: 2006/08/18
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
$owl_lang->lang_code = "es";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments		= "No esta autorizado para Agregar Comentarios a este Archivo";
$owl_lang->err_backup_file   		= "Error creando copia de seguridad al archivo actual";
$owl_lang->err_backup_folder_create 	= "Copia de seguridad en Creaci&oacute;n de Carpeta error";
$owl_lang->err_bad_url			= "Por favor ingrese un URL v&aacute;lido";
$owl_lang->err_bad_version_1 		= "Intranet Owl requiere como m&iacute;nimo PHP Versi&oacute;n";
$owl_lang->err_bad_version_2 		= "Ud est&aacute; ejecutando la Versi&oacute;n";
$owl_lang->err_bad_version_3 		= "Instale una nueva versi&oacute;n de php e int&eacute;ntelo de nuevo";
$owl_lang->err_comment_empty		= "El comentario no puede ser vac&iacute;o";
$owl_lang->err_email         		= "El mensaje no se puede enviar";
$owl_lang->err_email_required		= "El campo Correo es requerido";
$owl_lang->err_fexist1			= "<b>El archivo existe:</b>";
$owl_lang->err_fexist2 			= "Ya existe un archivo con el nombre <i>";
$owl_lang->err_fexist3 			= "</i> en este directorio.";
$owl_lang->err_file_exists		= "El archivo que ud esta tratando de subir ya existe";
$owl_lang->err_file_lock     		= "Ud no puede consultar este archivo, actualmente esta siendo utilizado por";
$owl_lang->err_file_not_exist		= "El archivo no existe en el sistema";
$owl_lang->err_file_too_big		= "ha excedido el l&iacute;mite m&aacute;ximo de carga en el php.ini(upload_max_filesize) y/o<br />el l&iacute;mite m&aacute;ximo de Owl";
$owl_lang->err_file_update		= "Para actualizar un archivo es necesario que su nombre permanezca igual, por favor int&eacute;ntelo de nuevo utilizando el mismo nombre";
$owl_lang->err_fileexists    		= "Movimiento cancelado<br />Existe un archivo con el mismo nombre.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "El nombre de archivo para renombrar este archivo ya existe";
$owl_lang->err_folder_create 		= "Error en Creacion de Carpeta";
$owl_lang->err_folder_exist		= "Esta carpeta ya existe";
$owl_lang->err_folderexists  		= "Renombre cancelado<br />Existe una carpeta con el mismo nombre.";
$owl_lang->err_general 			= "Ha ocurrido un error";
$owl_lang->err_select_reviewer		= "Por favor seleccione al menos una Persona para revisar su documento";
$owl_lang->err_update_file_lock     	= "Ud no puede actualizar este archivo, est&aacute; siendo actualmente utilizado por";
// NEW CHANGE
$owl_lang->err_group_delete             = "No se puede borrar este Grupo: <font color=\"red\">%d</font> Archivos(s),  <font color=\"red\">%d</font> Carpeta(s), <font color=\"red\">%d</font> Usuarios(s) con este grupo Primario, <font color=\"red\">%d</font> Usuario(s) que son miembros de este grupo";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "No se puede Eliminar hay archivos utilizando este Tipo de Documento";
$owl_lang->err_database			= "Error de la Base de Datos";
$owl_lang->err_doc_field_req            = "Campo Requerido faltante:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Nombre del Tipo de Documento es requerido <br />";
$owl_lang->err_field_label_req 		= "Campo Etiqueta es requerido <br />";
$owl_lang->err_field_name_req		= "Campo Nombre es requerido <br />";
$owl_lang->err_field_size_req		= "Campo Tama&ntilde;o es requerido <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing		= "Falla temporal en Creaci&oacute;n de Archivo &ldquo;TEXTO&rdquo; ";
$owl_lang->err_forbidden_file		= "Tipo de Archivo Prohibido";
$owl_lang->err_group_exists		= "Ya existe un grupo con este nombre.";
$owl_lang->err_gzip_not_found  		= "gzip no ha sido encontrado en ";
$owl_lang->err_login			= "Por favor ingresar al sistema para ejecutar esta acci&oacute;n";
$owl_lang->err_movecancel    		= "Movimiento Cancelado<br />";
$owl_lang->err_nameempty    		= "Nombre de la Carpeta no puede ser vac&iacute;o";
$owl_lang->err_news_required		= "ERROR: Encabezamiento y Contenido de Noticias son requeridos!";
$owl_lang->err_no_access 		= "Ud no tiene acceso a ninguno de los archivos seleccionados";
$owl_lang->err_no_access_info 		= "Posibles causas: <br />1) Ud no seleccion&oacute; ninguna casilla al frente del Archivo o Carpeta<br />2) Eliminaci&oacute;n Masiva, Correo Masivo, Verificaci&oacute;n Masiva no aplican a Carpetas<br />3) Ud no tiene acceso a ninguno de los archivos o Carpetas que ha seleccionado.";
$owl_lang->err_noemail			= "Ud no tiene acceso para enviar por correo este archivo";
$owl_lang->err_nofileaccess		= "Ud no tiene acceso a este archivo";
$owl_lang->err_nofiledelete		= "Ud no tiene acceso para eliminar este archivo";
$owl_lang->err_nofilemod		= "Ud no tiene acceso para modificar este archivo";
$owl_lang->err_nofolderaccess		= "Ud no tiene acceso a este archivo";
$owl_lang->err_nofolderdelete		= "Ud no tiene acceso para borrar esta carpeta";
$owl_lang->err_nofoldermod		= "Ud no tiene acceso para modificar esta carpeta";
$owl_lang->err_nosubfolder		= "Ud no tiene acceso para crear subcarpetas aqui";
$owl_lang->err_not_zip			= "No es un archivo ZIP v&aacute;lido";
$owl_lang->err_note_title               = "El Titulo es un campo requerido";
$owl_lang->err_note_title_exists        = "Ya existe una Nota con este nombre";
$owl_lang->err_noupload			= "Ud no tiene acceso para subir archivos a esta carpeta";
$owl_lang->err_pass_missmatch		= "Nueva Contrase&ntilde;a y Confirmar Contrase&ntilde;a no coinciden";
$owl_lang->err_pass_wrong    		= "Contrase&ntilde;a Antigua incorrecta";
$owl_lang->err_please_select_bulk       = "Por favor seleccione al menos un Archivo o Carpeta usando la casilla de seleccion";
$owl_lang->err_pod2html_not_found       = "ERROR: No ha sido encontrada la herramienta pod2html:";
$owl_lang->err_quota			= "Ud no tiene suficiente espacio estipulado para subir este archivo: ";
$owl_lang->err_quota_avail		= " disponible.";
$owl_lang->err_quota_exceed  		= "Ud ha excedido su cupo";
$owl_lang->err_quota_needed		= " necesario ";
$owl_lang->err_req			= "ERROR: Todos los Campos son requeridos";
$owl_lang->err_root_delete		= "La Carpeta Principal no puede ser eliminada";
$owl_lang->err_sess_notvalid 		= "El Id de sesi&oacute;n no es v&aacute;lido";
$owl_lang->err_sess_write		= "Error escribiendo informaci&aacute;n de sesi&aacute;n a la base de datos";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; es un Nombre de Carpeta reservado para Owl por favor escoja otro nombre";
$owl_lang->err_sql			= "Error SQL";
$owl_lang->err_tar_not_found  		= "tar no ha sido encontrado en ";
$owl_lang->err_trash_can_empty 		= "La Papelera esta vac&iacute;a";
$owl_lang->err_unauth_area   		= "Ud no est&aacute; autorizado para usar esta &aacute;rea";
$owl_lang->err_unauthorized  		= "No autorizado";
$owl_lang->err_upload 			= "error en transferencia";
$owl_lang->err_user_exists		= "El Nombre de Usuario ya existe";
// NEW STUFF
$owl_lang->err_captcha_auth		= "Autenticaci&oacute;n CAPTCHA fallida";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Agregar Campo";
$owl_lang->btn_add_file          = "Agregar Documento";
$owl_lang->btn_add_folder          = "Agregar Carpeta";
$owl_lang->btn_add_news          = "Agregar Noticia";
$owl_lang->btn_add_note          = "Agregar Nota";
$owl_lang->btn_add_url          = "Agregar Url";
$owl_lang->btn_add_zip           = "Agregar Archivo";
$owl_lang->btn_admin      = "Administrar";
$owl_lang->btn_admin_groups          = "Nuevo Grupo";
$owl_lang->btn_admin_news          = "Administrar Noticias";
$owl_lang->btn_admin_user_group          = "Administrar Usuario/Grupo";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users          = "Nuevo Usuario";
$owl_lang->btn_back          = "Regresar";
$owl_lang->btn_browse     = "Navegar";
$owl_lang->btn_bulk_checkout       = "Verificaci&oacute;n Masiva";
$owl_lang->btn_bulk_delete         = "Eliminaci&oacute;n Masiva";
$owl_lang->btn_bulk_download          = "Descarga Masiva";
$owl_lang->btn_bulk_email          = "Correo Masivo";
$owl_lang->btn_bulk_move          = "Movimiento Masivo";
$owl_lang->btn_cancel          = "Cancelar";
$owl_lang->btn_clickhere          = "Clic aqui";
$owl_lang->btn_collapse_view          = "Vista Contraida";
$owl_lang->btn_create          = "Crear";
$owl_lang->btn_default_view          = "Vista por defecto";
$owl_lang->btn_deldoctype          = "Eliminar Tipo Doc";
$owl_lang->btn_download_bulk_package	= "para descargar su Paquete de Desgarga Masiva";
$owl_lang->btn_edit_group          = "Editar Grupo";
$owl_lang->btn_edit_user          = "Editar Usuario";
$owl_lang->btn_expand_view          = "Vista Expandida";
$owl_lang->btn_go_bottom      = "Ir al final";
$owl_lang->btn_go_top      = "Ir al comienzo";
$owl_lang->btn_help     = "Ayuda";
$owl_lang->btn_import_users  = "Importar Usuarios";
$owl_lang->btn_login          = "Ingresar";
$owl_lang->btn_logout     = "Salir";
$owl_lang->btn_mail_tool     = "Correo";
$owl_lang->btn_register          = "Registrar";
$owl_lang->btn_reset          = "Restaurar";
$owl_lang->btn_send_email          = "Enviar Correo";
$owl_lang->btn_submit          = "Enviar";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view          = "Vista Miniatura";
$owl_lang->btn_trash_admin          = "Papelera";
// NEW STUFF
$owl_lang->btn_export          = "Exportar";
$owl_lang->btn_gen_pdf          = "Generar PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";


//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments     = "Agregar un comentario a este Archivo";
$owl_lang->alt_add_field	= "Agregar el Campo Superior";
$owl_lang->alt_add_group	= "Crear este Grupo";
$owl_lang->alt_add_news		= "Agregar Nueva Noticia";
$owl_lang->alt_add_user		= "Crear este Usuario";
$owl_lang->alt_admin_flush      = "Limpiar Sesiones Antiguas/Expiradas";
$owl_lang->alt_admin_groups	= "Crear un nuevo grupo";
$owl_lang->alt_admin_users	= "Crear un nuevo usuario";
$owl_lang->alt_approve_file 	= "Aprobar este Documento";
$owl_lang->alt_back      	= "Regresar a la Interfaz Anterior";
$owl_lang->alt_btn_add_file     = "Descargar un Nuevo Archivo";
$owl_lang->alt_btn_add_folder	= "Crear una Nueva Carpeta";
$owl_lang->alt_btn_add_note     = "Agregar una Nueva Nota";
$owl_lang->alt_btn_add_url	= "Crear un Nuevo Hipervinculo";
$owl_lang->alt_btn_add_zip     	= "Descargar un archivo Zip para ser extraido";
$owl_lang->alt_btn_admin 	= "Administraci&oacute;n Owl";
$owl_lang->alt_btn_browse	= "Regresar al Navegador de Archivo";
$owl_lang->alt_btn_bulk_checkout= "Archivos de Verificaci&oacute;n Masiva";
$owl_lang->alt_btn_bulk_delete 	= "Archivos de Eliminaci&oacute;n Masiva";
$owl_lang->alt_btn_bulk_download= "Archivos de Descarga Masiva";
$owl_lang->alt_btn_bulk_email  	= "Archivos de Correo Masivo";
$owl_lang->alt_btn_bulk_move   	= "Archivos y Carpetas de Movimiento Masivo";
$owl_lang->alt_btn_clickhere	= "Clic aqui";
$owl_lang->alt_btn_collapse_view= "Cambiar a Vista Reducida";
$owl_lang->alt_btn_default_view = "Cambiar a Vista por Defecto";
$owl_lang->alt_btn_expand_view  = "Cambiar a Vista Expandida";
$owl_lang->alt_btn_help		= "Ayuda en Linea Owl";
$owl_lang->alt_btn_login	= "Ingresar a la Intranet Owl";
$owl_lang->alt_btn_logout	= "Salir de la Intranet Owl";
$owl_lang->alt_btn_mail_tool   	= "Herramienta Simple de Correo";
$owl_lang->alt_btn_thumb_view   = "Cambiar a Vista Miniatura";
$owl_lang->alt_cancel		= "Cancelar esta Acci&oacute;n";
$owl_lang->alt_cancel_move	= "Cancelar Acci&oacute;n de Movimiento";
$owl_lang->alt_change		= "Actualizar este Registro";
$owl_lang->alt_comments 	= "Existen Comentarios para este Archivo";
$owl_lang->alt_copy_file     	= "Copiar Archivo";
$owl_lang->alt_copy_folder   	= "Copiar Carpeta";
$owl_lang->alt_del_all		= "Vaciar Papelera";
$owl_lang->alt_del_comments     = "Eliminar este Comentario";
$owl_lang->alt_edt_comments     = "Editar este Comentario";
$owl_lang->alt_del_field	= "Eliminar este Campo";
$owl_lang->alt_del_file      	= "Eliminar Campo (S/N)";
$owl_lang->alt_del_folder    	= "Eliminar Carpeta (S/N)";
$owl_lang->alt_del_group	= "Eliminar este Grupo";
$owl_lang->alt_del_news		= "Eliminar esta Noticia";
$owl_lang->alt_del_selected	= "Eliminar todos los Archivos Seleccionados";
$owl_lang->alt_del_this_folder	= "Eliminar Carpeta &#8211; ";
$owl_lang->alt_del_user		= "Eliminar este Usuario";
$owl_lang->alt_deldoctype	= "Eliminar Tipo de Documento Actual";
$owl_lang->alt_edit_field	= "Editar esta Definici&oacute;n de Campo";
$owl_lang->alt_edit_group       = "Editar el Grupo Seleccionado";
$owl_lang->alt_edit_news	= "Editar esta Noticia";
$owl_lang->alt_edit_user        = "Editar el Usuario Seleccionado";
$owl_lang->alt_email		= "Enviar por Correo este Archivo";
$owl_lang->alt_email_reminder 	= "Recordatorio por Correo";
$owl_lang->alt_email_selected	= "Enviar por Correo todos los Archivos Seleccionados";
$owl_lang->alt_get_file      	= "Descargar Archivo";
$owl_lang->alt_get_folder      	= "Descargar Contenido de la Carpeta";
$owl_lang->alt_go_bottom      	= "Ir al Final de la p&aacute;gina";
$owl_lang->alt_go_top 		= "Ir al Inicio de la p&aacute;gina";
$owl_lang->alt_have_news	= "Ud tiene Noticia(s) por Ver";
$owl_lang->alt_have_no_news	= "No hay Nueva(s) Noticias por Ver";
$owl_lang->alt_home_folder	= "Regresar al Directorio Inicial ";
$owl_lang->alt_link_file     	= "Vincular este Archivo a otro Directorio";
$owl_lang->alt_lock_file        = "Verificar Archivo";
$owl_lang->alt_log_clear        = "Eliminar todos los Logs (S/N)";
$owl_lang->alt_log_file         = "Archivar Log";
$owl_lang->alt_log_next		= "Mostrar Registros Siguientes";
$owl_lang->alt_log_prev		= "Mostrar Registros Anteriores";
$owl_lang->alt_log_top		= "Ir al Primer Registro";
$owl_lang->alt_mod_file      	= "Modificar Propiedades de Archivo"; 
$owl_lang->alt_mod_folder    	= "Modificar Propiedades de Carpeta";
$owl_lang->alt_monitor		= "Monitorear este Archivo";
$owl_lang->alt_monitor_folder   = "Monitorear esta Carpeta";
$owl_lang->alt_monitored	= "Detener Monitoreo de este Archivo";
$owl_lang->alt_monitored_folder = "Detener Monitoreo de esta Carpeta";
$owl_lang->alt_move_file     	= "Mover Archivo";
$owl_lang->alt_move_folder   	= "Mover Carpeta";
$owl_lang->alt_move_selected	= "Mover todos los Archivos Seleccionados";
$owl_lang->alt_my_approval	= "Documentos(s) Esperando mi Aprobaci&oacute;n";
$owl_lang->alt_new_doctype	= "Crear Nuevo Tipo de Documento";
$owl_lang->alt_news_close	= "Cerrar la Ventana de Noticias";
$owl_lang->alt_news_next	= "Mostrar Siguiente Noticia";
$owl_lang->alt_news_prev	= "Mostrar Anterior Noticia";
$owl_lang->alt_news_print	= "Imprimir esta Noticia";
$owl_lang->alt_pending_approval	= "Documento(s) Pendientes de Aprobaci&oacute;n";
$owl_lang->alt_play_file 	= "Reproducir Archivo Multimedia";
$owl_lang->alt_publish_file 	= "Hacer P&uacute;blico el Documento";
$owl_lang->alt_recycle		= "Papelera<br />(Vac&iacute;a)";
$owl_lang->alt_recycle_disable	= "Recolecci&oacute;n<br />(Deshabilitado)";
$owl_lang->alt_recycle_not_found= "Papelera<br />(No encontrada)";
$owl_lang->alt_refresh_filter	= "Iniciar Filtro / Refrescar Resultados";
$owl_lang->alt_register		= "Enviar su registro";
$owl_lang->alt_reject_file 	= "Rechzar este Documento";
$owl_lang->alt_related		= "Encontrar Documentos Relacionados";
$owl_lang->alt_reset_form	= "Restablecer Valores de Formulario";
$owl_lang->alt_rest_selected	= "Restituir todos los Archivos Seleccionados";
$owl_lang->alt_search		= "Iniciar la Busqueda";
$owl_lang->alt_send_email	= "Enviar el Correo";
$owl_lang->alt_sendfile		= "Enviar el Archivo";
$owl_lang->alt_set_initial_dir	= "Establecer el Directorio Actual como Inicial";
$owl_lang->alt_site_map         = "Mapa del Sitio";
$owl_lang->alt_submit      	= "Enviar Formulario";
$owl_lang->alt_toggle_check_box	= "Alternar Cajones de Selecci&oacute;n";
$owl_lang->alt_tool_status_green= "La Herramienta esta Activa";
$owl_lang->alt_tool_status_red	= "La ruta es incorrecta Y/O no es ejecutable";
$owl_lang->alt_unlock_file      = "Inscribir Archivo";
$owl_lang->alt_upd_field	= "Actualizar este Campo";
$owl_lang->alt_upd_file      	= "Actualizar Archivo";
$owl_lang->alt_view_comments    = "Agregar / Ver Comentarios del Archivo";
$owl_lang->alt_view_file     	= "Ver Archivo";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin = "Administraci&oacute;n Papelera de Reciclaje";
$owl_lang->alt_edit_file_inline = "Editar Archivo de Texto";
$owl_lang->alt_gen_pdf          = "Generar Versi&oacute;n PDF del Archivo Actual";
$owl_lang->alt_updated     	= "El Documento fu&eacute; Actualizado desde su &uacute;ltima Visita";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	        = "El Documento fu&eacute; creado desde su &uacute;ltima Visita";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Todo el Contenido tambien ha sido eliminado";
$owl_lang->log_detail		= "No hay Detalles Adicionales";
$owl_lang->log_file_to		= "PARA: ";
$owl_lang->log_filter_all	= "TODOS";
$owl_lang->log_login_det	= "Usuario: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group = "Grupo Modificado: ";
$owl_lang->log_admin_changed_user = "Usuario Modificado: ";
$owl_lang->log_admin_created_group = "Grupo Creado: ";
$owl_lang->log_admin_created_user = "Usuario Creado: ";
$owl_lang->log_admin_del_group = "Grupo Eliminado: ";
$owl_lang->log_admin_del_user = "Usuario Eliminado: ";
$owl_lang->log_admin_disabled = " Usuario Desahabilitado: ";
$owl_lang->log_admin_email_restore = "Archivos enviados por correo:";
$owl_lang->log_admin_trash_delfile= "Archivo Eliminado: ";
$owl_lang->log_admin_trash_delfold = "Carpeta Eliminada: ";
$owl_lang->log_admin_trash_empty = "Papelera Desocupada";
$owl_lang->log_admin_trash_restore = "Restituida: ";
$owl_lang->log_login_expired    = "Usuario Expirado: ";
$owl_lang->log_login_too_many_attempts = "Deshabilitado (Demasiados Intentos Fallidos): ";
$owl_lang->log_readhd_feature_add  = "Leer caracter&iacute;stica HD agregada a este archivo";
$owl_lang->log_admin_to  = "para";
$owl_lang->log_admin_of  = "de";
// END NEW STUFF
$log_file_actions[1]        	= "INGRESO";
$log_file_actions[10]        	= "ARCHIVO ABIERTO";
$log_file_actions[11]        	= "ARCHIVO ENVIADO POR CORREO";
$log_file_actions[12]        	= "ARCHIVO MOVIDO";
$log_file_actions[13]        	= "CARPETA CREADA";
$log_file_actions[14]        	= "CARPETA ELIMINADA";
$log_file_actions[15]        	= "CARPETA MODIFICADA";
$log_file_actions[16]        	= "CARPETA MOVIDA";
$log_file_actions[17]        	= "OLVIDO CONTRASE&Ntilde;A";
$log_file_actions[18]        	= "REGISTRO USUARIO";
$log_file_actions[19]           = "ARCHIVO VISTO";
$log_file_actions[2]        	= "INGRESO FALLIDO";
$log_file_actions[20]           = "VIRUS DE ARCHIVO";
$log_file_actions[21]           = "ARCHIVO COPIADO";
$log_file_actions[22]           = "CARPETA COPIADA";
$log_file_actions[23]           = "ARCHIVO VINCULADO";
$log_file_actions[3]        	= "SALIR";
$log_file_actions[4]        	= "ARCHIVO ELIMINADO";
$log_file_actions[5]        	= "SUBIR ARCHIVO";
$log_file_actions[6]        	= "ARCHIVO ACTUALIZADO";
$log_file_actions[7]        	= "ARCHIVO DESCARGADO";
$log_file_actions[8]        	= "ARCHIVO CAMBIADO";
$log_file_actions[9]        	= "ARCHIVO CERRADO";
// BEGIN NEW STUFF
$log_file_actions[24]           = "ADMIN USUARIO";
$log_file_actions[25]           = "PAPELERA";
$log_file_actions[26]           = "ARCHIVO ACL";
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
$owl_lang->admin_login_date  = "El administrador ingres&oacute; el: ";
$owl_lang->admin_login_from  = "El administrador ingres&oacute; desde";
$owl_lang->admin_login_subject  = "ENTRADA USUARIO ADMINISTRADOR";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Acceso An&oacute;nimo)";
$owl_lang->engine 		= "Motor Owl de Intranet";
$owl_lang->forgot_pass		= "Olvid&oacute; su contrase&ntilde;a?";
$owl_lang->like_register	= "Desea Registrarse?";
$owl_lang->login		= "Ingresar";
$owl_lang->logindisabled	= "La cuenta ha sido DESHABILITADA, contacte al Administrador del Sistema";
$owl_lang->loginfail		= "Ingreso fallido";
$owl_lang->password		= "Contrase&ntilde;a";
$owl_lang->repository_list      = "Repositoria";
$owl_lang->successlogout 	= "Ud ha salido exitosamente del sistema";
$owl_lang->toomanysessions	= "Maximo n&uacute;mero de sesiones por usuario alcanzado, contacte el Administrador del Sistema";
$owl_lang->username		= "Usuario";
$owl_lang->version 		= "Versi&oacute;n";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Acciones";
$owl_lang->current_db         		= "Repositorio Actual:";
$owl_lang->current_folder 		= "Current Folder:";
$owl_lang->del_all			= "Papelera Vac&iacute;a";
$owl_lang->del_selected			= "Eliminar Seleccionado";
$owl_lang->disk_quota			= "Cupo en Disco";
$owl_lang->doc_number 			= "Doc #";
$owl_lang->email_selected		= "Correo Seleccionado";
$owl_lang->file 			= "Archivo";
$owl_lang->folder_count_file		= "Archivo(s)";
$owl_lang->folder_count_folder		= "Carpeta(s)";
$owl_lang->folder_count_note		= "Nota(s)";
$owl_lang->folder_count_pre		= "Esta Carpeta Contiene";
$owl_lang->folder_count_url		= "URL(s)";
$owl_lang->folder_policy 		= "Pol&iacute;tica Actual de la Carpeta:";
$owl_lang->held                      	= "Bloqueado por"; 
$owl_lang->last_logged			= "&Uacute;ltima Entrada: ";
$owl_lang->menu_file_action		= "Acciones de Archivo Disponibles";
$owl_lang->menu_folder_action		= "Acciones de Carpeta Disponibles";
$owl_lang->menu_url_action		= "Acciones de Url Disponibles";
$owl_lang->modified 			= "Modificado por";
$owl_lang->move_selected		= "Mover Seleccionado";
$owl_lang->new_file			= "Nuevo!";
$owl_lang->no_description		= "No hay descripci&oacute;n Disponible";
$owl_lang->owner                        = "User";
$owl_lang->page				= "P&aacute;gina:";
$owl_lang->panel_file_info		= "Informaci&oacute;n de Archivo";
$owl_lang->postedby 			= "Publicado por";
$owl_lang->reallydelete			= "Realmente desea eliminar";
$owl_lang->reallydelete_logs		= "Realmente desea limpiar el Archivo Log";
$owl_lang->reallydelete_selected	= "Realmente desea eliminar todos los archivos seleccionados";
$owl_lang->reallyrestore_selected	= "Realmente desea restaurar todos los archivos seleccionados";
$owl_lang->rest_selected		= "Restaurar Seleccionado";
$owl_lang->score 			= "Puntuaci&oacute;n";
$owl_lang->size 			= "Tama&ntilde;o";
$owl_lang->updated_by 			= "Actualizado por";
$owl_lang->title 			= "T&iacute;tulo";
$owl_lang->tot_files			= "Total:";
$owl_lang->tot_monitored		= "Monitoreado:";
$owl_lang->tot_my_checked_out		= "Revisado:";
$owl_lang->tot_my_files			= "Mi:";
$owl_lang->tot_my_group			= "Grupo:";
$owl_lang->tot_new_files		= "Nuevo:";
$owl_lang->tot_updated_files		= "Actualizado:";
$owl_lang->updated_file			= "Actualizado!";
$owl_lang->user               		= "Usuario";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favoritos";
$owl_lang->favorite_add = "Agregar Actual";
$owl_lang->favorite_delete = "Eliminar";
$owl_lang->favorite_go = "Ir";
$owl_lang->files_in_my_group_title = "Archivos en mi(s) Grupo(s)";
$owl_lang->my_files_title= "Mis Archivos";
$owl_lang->my_monitored_title= "Mi(s) Archivo(s)/Carpeta(s) Monitoreado(s)";
$owl_lang->my_special_access_title= "Lista de Acceso Especial";
$owl_lang->special_access_count_alt= "Archivos/Carpetas de Acceso Especial";
$owl_lang->special_access_count= "Acceso Especial:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Agreando / Viendo Comentarios: ";
$owl_lang->addingfile 		= "Agregando un archivo a ";
$owl_lang->addingfolder 	= "Agreando una carpeta a ";
$owl_lang->attach_file		= "Adjuntar Archivo";
$owl_lang->change		= "Cambiar";
$owl_lang->comments      	= "Comentar";
$owl_lang->comments_added       = "Comentarios Agregados por: ";
$owl_lang->create		= "Crear";
$owl_lang->description 		= "Descripci&oacute;n";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Canci&oacute;n:<br />Album:<br />Velocidad&nbsp;-&nbsp;Tasa de muestra:<br />Duraci&oacute;n:<br />G&eacute;nero:<br />Comentarios:";
$owl_lang->email_body		= "Mensaje";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Responder a";
$owl_lang->email_subject	= "Asunto";
$owl_lang->email_to		= "Correo a";
$owl_lang->emailing		= "Enviando";
$owl_lang->keywords 		= "Pal&aacute;bras claves";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Modificando ";
$owl_lang->name               	= "Nombre"; 
$owl_lang->none_selected        = "NINGUNO SELECCIONADO";
$owl_lang->note_content         = "Contenido de Nota";
$owl_lang->notify_link          = "Vinculo Externo a Owl";
$owl_lang->ownergroup         	= "Propietario (Grupo)";
$owl_lang->ownership		= "Propiedad";
$owl_lang->permissions 		= "Permisos";
$owl_lang->pick_select		= "&#8211; Seleccione un Usuario Owl &#8211;";
$owl_lang->policy 		= "Pol&iacute;tica";
$owl_lang->post_comment		= "Publicar Comentario";
$owl_lang->prop_permissions 	= "Propagar Permisos a subcarpetas?";
$owl_lang->prop_perms_files 	= "Permisos a propagar a archivos";
$owl_lang->sendfile 		= "Enviar Archivo";
$owl_lang->sendthisfile 	= "Enviar este archivo";
$owl_lang->sendthisurl       	= "Enviar este URL";
$owl_lang->updating		= "Actualizando";
$owl_lang->verdescription 	= "Descripci&oacute;n<br />de cambios";
$owl_lang->vermajor          	= "Revisi&oacute;n Mayor";
$owl_lang->verminor          	= "Revisi&oacute;n Menor";
$owl_lang->vertype           	= "Tipo de Revisi&oacute;n";
$owl_lang->document_text        = "Content";  
$owl_lang->save_keyword         = "Save Keyword?";
$owl_lang->archive_skip_file    = "SKIPPED: ";
$owl_lang->archive_skip_message = "The Following Files Have been Skipped they already exist";
$owl_lang->archive_extract_current  = "Extract to Current Folder?";
$owl_lang->archive_extract_overwrite  = "Overwrite Existing Files (Update)?";
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

$owl_lang->email             	= "Direcci&oacute;n de Correo";
$owl_lang->full_name		= "Nombre Completo";
$owl_lang->register		= "Registro de Usuario";
$owl_lang->self_failed		= "Fall&oacute;";
$owl_lang->self_passwd		= "Contrase&ntilde;a enviada a:";
$owl_lang->self_reg_bod		= "Su contrase&ntilde;a Owl es:";
$owl_lang->self_reg_rset	= "Su contrase&ntilde;a Owl ha sido restaurada a:";
$owl_lang->self_reg_subj	= "Su cuenta OWL";
$owl_lang->send_pass		= "Enviar Contrase&ntilde;a";
$owl_lang->submit		= "Registrar";
$owl_lang->thank_you_1		= "Gracias!";

//NEW STUFF

$owl_lang->captcha_typein        = "Dig&iacute;te los 5 caracteres";
$owl_lang->change_pass_title	      = "CAMBIAR CONTRASE&Ntilde;A";
$owl_lang->err_cant_reuse_passwords   = "Ud no puede reutilizar contrase&ntilde;as previamente establecidas";
$owl_lang->err_new_confirm_different  = "Su Nueva Contrase&ntilde;a y Contrase&ntilde;a de Confirmaci&oacute;n no coinciden <br />";
$owl_lang->err_old_pass_ver_failed    = "Su Contrase&ntilde;a Ant&iacute;gua es incorrecta <br />";
$owl_lang->err_pass_restriction_1     = "Su contrasena debe tener al menos &ldquo;%s&rdquo; caracteres <br />";
$owl_lang->err_pass_restriction_2     = "contener al menos &ldquo;%s&rdquo; n&uacute;meros [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "y al menos &ldquo;%s&rdquo; caracteres especiales [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "El nombre de usuario que ha escogido &ldquo;%s&rdquo; tiene %d caracteres, y debe tener al menos %d caracteres.";
$owl_lang->pass_change_email_1        = "Su contrase&ntilde;a no ha sido restituida ya que no esta utilizando autenticaci&oacute;n Owl";
$owl_lang->pass_change_email_2        = "Su tipo de Autenticaci&oacute;n es: ";
$owl_lang->pass_change_email_3        = "Contacte su Administrador del Sistema para Ayuda";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Cancelar";
$owl_lang->copy_file		= "Copiando archivo";
$owl_lang->copy_folder		= "Copiando carpeta";
$owl_lang->moving		= "Moviendo";
$owl_lang->moving_file		= "Moviendo archivo";
$owl_lang->moving_folder	= "Moviendo carpeta";
$owl_lang->select		= "Por favor seleccione una nueva carpeta:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Viendo Log Para ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Dif De";
$owl_lang->diff_to	= "Dif A";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Notificaci&oacute;n de Comentario";
$owl_lang->confpassword	= "Confirmar Nueva Contrase&ntilde;a";
$owl_lang->email_tool	= "Herramienta de Correo";
$owl_lang->group	= "Grupo Primario";
$owl_lang->groupmember	= "Miembro de Grupo(s)";
$owl_lang->last_modified= "&Uacute;ltima Modificaci&oacute;n";
$owl_lang->newpassword	= "Nueva Contrase&ntilde;a";
$owl_lang->newsadmin	= "Administrador de Noticias";
$owl_lang->not_member	= "Ud no es miembro de alg&uacute;n otro grupo";
$owl_lang->notification	= "Recibir Notificaciones";
$owl_lang->oldpassword	= "Contrase&ntilde;a Ant&iacute;gua";
$owl_lang->preference	= "Preferencias";
$owl_lang->saved	= "&#8212; C A M B I O S&nbsp;&nbsp;&nbsp;G U A R D A D O S &#8212;";

$owl_lang->status_no	= "NO";
$owl_lang->status_yes	= "SI";
$owl_lang->userlang	= "Lenguaje";

//NEW STUFF
$owl_lang->useradmin	= "Administrador de Usuarios";
$owl_lang->viewlogs     = "Puede Ver los Logs del Sistema";
$owl_lang->viewreports  = "Puede Ver los Reportes del Sistema";
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

$owl_lang->elapsed_time       	= "tiempo trascurrido";
$owl_lang->query_empty       	= "Cadena de B&uacute;squeda Vac&iacute;a";
$owl_lang->related_query_empty  = "No hay metadatos asociados al documento para ejecutar una &ldquo;B&uacute;squeda Relacionada&rdquo;";
$owl_lang->search             	= "B&uacute;squeda";
$owl_lang->search_all_word	= "Todas Las Pal&aacute;bras";
$owl_lang->search_any_word	= "Alg&uacute;nas Pal&aacute;bras";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "B&uacute;squeda en Carpeta Actual";
$owl_lang->search_entire_phrase	= "Frase Completa";
$owl_lang->search_for_files 	= "Buscando por Archivos";
$owl_lang->search_for_folders 	= "Buscando por Carpetas";
$owl_lang->search_match 	= "Coincidencias:";
$owl_lang->search_results_for	= "Buscar resultados por";
$owl_lang->search_score 	= "Marcando Archivos";
$owl_lang->search_winthindocs   = "Buscar dentro de Docs";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Mostrando ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Mostrar Panel de informaci&oacute;n de Archivo";
$owl_lang->allow_track_favorite         = "Permitir a Usuarios Rastrear Favoritos";
$owl_lang->admin_login_to_browse_page	= "Admin se dirige a la P&aacute;gina de Navegaci&oacute;n al Ingresar";
$owl_lang->alt_btn_backup		= "Copia de Seguridad de Base de Datos SQL";
$owl_lang->alt_btn_doctype_admin	= "Administrador de Tipos de Documentos";
$owl_lang->alt_btn_html_prefs		= "Editar preferencias HTML del sitio";
$owl_lang->alt_btn_news_admin		= "Administrador de Noticias Owl";
$owl_lang->alt_btn_site_features	= "Editar las caracter&iacute;sticas y preferencias del Sitio";
$owl_lang->alt_btn_statistics_viewer	= "Visor de Estad&iacute;sticas Owl";
$owl_lang->alt_btn_users_groups		= "Administrar Usuarios y Grupos";
$owl_lang->btn_backup			= "Copia de Seguridad<br />Base de Datos";
$owl_lang->btn_doctype_admin		= "Tipos de<br />Documentos";
$owl_lang->btn_html_prefs		= "Preferencias<br />HTML";
$owl_lang->btn_news_admin		= "Administrar<br />Noticias";
$owl_lang->btn_site_features		= "Caracter&iacute;sticas<br />del Sitio";
$owl_lang->btn_statistics_viewer	= "Visor de <br />Estad&iacute;sticas / Reportes";
$owl_lang->btn_users_groups		= "Usuarios &amp;<br />Grupos";
$owl_lang->display_password_override	= "Mostrar Anulaci&oacute;n Manual de Contrase&ntilde;a de Archivo/Carpeta";
$owl_lang->doc_id_num_digits		= "N&uacute;mero de D&iacute;gitos Doc# a mostrar";
$owl_lang->doc_id_prefix		= "Mostrar Cadena Prefija Doc#"; 
$owl_lang->docicon_column		= "Icono Doc";
$owl_lang->download_folder_zip		= "Descargar Carpeta como ZIP (Por Defecto es tar.gz)";
$owl_lang->save_keywords_to_db		= "Permitir a Usuarios guardar Palabras Claves para Reutilizar";
$owl_lang->status_column		= "Status";
$owl_lang->vermajor_initial          	= "Revisi&oacute;n Mayor Inicial";
$owl_lang->verminor_initial          	= "Revisi&oacute;n Menor Inicial";
$owl_lang->view_doc_in_new_window	= "Abrir una Ventana Nueva al Visualizar Documentos";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "***** Editando Usuario *****";
$owl_lang->edit_group  			= "***** Editando Grupo *****";
$owl_lang->enter_new_user               = "***** Agregando Nuevo Usuario *****";
$owl_lang->enter_new_group              = "***** Agregando Nuevo Grupo *****";
$owl_lang->alt_btn_change_passwd        = "Cambiar su Ant&iacute;gua Contrase&ntilde;a";
$owl_lang->alt_btn_cln_history          = "Remover Documentos mas ant&iacute;guos de (d&iacute;as): ";
$owl_lang->alt_btn_log_viewer           = "Visor de la bit&aacute;cora (LOG) del Sistema Owl";
$owl_lang->alt_btn_report_viewer        = "Visor de Reportes Owl";
$owl_lang->btn_change_passwd            = "Cambiar Contrase&ntilde;a";
$owl_lang->btn_cln_history              = "Remover Hist&oacute;rico";
$owl_lang->btn_log_viewer               = "Logs del Sistema";
$owl_lang->btn_report_viewer            = "Reportes";
$owl_lang->confirm_cln_history          = "Esta seguro que desea remover Documentos mas ant&iacute;guos de (d&iacute;as): ";
$owl_lang->historical_purge             = "Hist&oacute;rico de Archivos Eliminado";

// END NEW STUFF
$owl_lang->add				= "Agregar";
$owl_lang->alt_btn_initial_load		= "Cargar BD de una Carpeta de Documentos";
$owl_lang->alt_btn_trashcan		= "Clic para Ver el Contenido";
$owl_lang->anonymous_account		= "Cuenta de Acceso An&oacute;nima:";
$owl_lang->btn_initial_load		= "Carga Inicial";
$owl_lang->btn_trashcan			= "Papelera";
$owl_lang->buttonstyle                  = "Estilo de Bot&oacute;n";
$owl_lang->confirm_initial_load		= "*** &iexcl;PRECAUCION! ***  Esta acci&oacute;n &uacute;nicamente deber&iacute;a de ejecutarse una sola vez cuando la base de datos est&eacute; vac&iacute;a";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Eliminar Grupo";
$owl_lang->deleteuser			= "Eliminar Usuario";
$owl_lang->disable_recs_per_page	= "Habilitar la vista restringida DESHABILITAR&Aacute; los Registros por P&aacute;gina!";
$owl_lang->disableuser			= "Deshabilitar Usuario";
$owl_lang->file_admin_group		= "Navegador/Archivo de Grupo Admin:";
$owl_lang->flushed           		= "Tabla de Sesion limpia, el usuario puede volver a ingresar de nuevo ahora.";
$owl_lang->groups			= "Grupos";
$owl_lang->hide_bulk_buttons		= "Ocultar botones de selecci&oacute;n m&uacute;ltiple:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Ruta para Imagen de Fondo:";
$owl_lang->ht_bd_lnk_cl			= "Color de V&iacute;nculos:";
$owl_lang->ht_bd_txt_cl 		= "Color de Texto:";
$owl_lang->ht_bd_vlnk_cl 		= "Color de V&iacute;nculos Visitados:";
$owl_lang->ht_collapse_width 		= "Ancho de Vista Contraida:";
$owl_lang->ht_expand_width		= "Ancho de Vista Expandida:";
$owl_lang->ht_tbl_border_sz 		= "Tama&ntilde;o Borde de Tabla:";
$owl_lang->ht_tbl_cell_bg_al 		= "Color de Fondo Alternativo de Celdas de Tabla:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Color de Fondo de Celdas de Tabla:";
$owl_lang->ht_tbl_hd_bg			= "Fondo de Cabecera:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Establecer Acceso An&oacute;mimo";
$owl_lang->header_group_admin           = "Administraci&oacute;n de Grupos";
$owl_lang->header_sitefeatures_settings           = "Caracter&iacute;sticas y Configuraci&oacute;n del Sitio";
$owl_lang->header_user_admin           	= "Administraci&oacute;n de Usuarios";
$owl_lang->hide_folder_doc_count	= "Ocultar Tipo de Archivo de Carpeta";
$owl_lang->hide_folder_size		= "Ocultar Tama&ntilde;o de Contenido de Carpeta";
$owl_lang->hide_panel			= "Ocultar";
$owl_lang->home_dir			= "Directorio Principal de Usuario:";
$owl_lang->initial_dir   		= "Directorio Inicial de Usuario";
$owl_lang->maxsessions			= "M&aacute;ximo Num. de Sesiones";
$owl_lang->noprefaccess			= "Deshabilitar Preferencias";
$owl_lang->old_action_icons		= "Usar pre Owl 0.80 Iconos";
$owl_lang->owl_anon_download     	= "Solo Descarga";
$owl_lang->owl_anon_full		= "Acceso Completo";
$owl_lang->owl_anon_ro			= "Solo Lectura";
$owl_lang->owl_dbdump_path   		= "Ruta de Herramienta de Volcado BD:";
$owl_lang->owl_def_file_group_owner	= "Grupo de Propietario de Archivos por Defecto:";
$owl_lang->owl_def_file_meta		= "Metadatos de Archivos por Defecto:";
$owl_lang->owl_def_file_owner		= "Propietario de Archivos por Defecto:";
$owl_lang->owl_def_file_perm 		= "Pol&iacute;tica de Creaci&oacute;n de Archivos por Defecto:";
$owl_lang->owl_def_file_security	= "Seguridad de Archivos por Defecto:";
$owl_lang->owl_def_file_title		= "T&iacute;tulo del Archivo por Defecto (Ninguno para Nombre de Archivo):";
$owl_lang->owl_def_fold_group_owner	= "Crupo Propietario de Carpeta por Defecto:";
$owl_lang->owl_def_fold_owner		= "Propietario de Carpeta por Defecto:";
$owl_lang->owl_def_fold_sec		= "Seguridad de Carpeta por Defecto:";
$owl_lang->owl_def_folder_perm 		= "Pol&iacute;tica de Creaci&oacute;n de Carpetas por Defecto:";
$owl_lang->owl_default_tmpdir		= "Directorio Ubicaci&oacute;n de Archivo Temp: ";
$owl_lang->owl_email_from		= "Direcci&oacute;n de Correo Remitente:";
$owl_lang->owl_email_fromname		= "Nombre Remitente:";
$owl_lang->owl_email_replyto		= "Responder a Direcci&oacute;n de Correo:";
$owl_lang->owl_email_server		= "Servidor SMTP:";
$owl_lang->owl_email_smtp		= "Env&iacute;o de Correos usando M&eacute;todo SMTP";
$owl_lang->owl_email_smtp_auth		= "Usar Autorizaci&oacute;n de SMTP";
$owl_lang->owl_email_smtp_auth_login	= "Usuario de Autorizaci&oacute;n SMTP:";
$owl_lang->owl_email_smtp_auth_passwd	= "Contrase&ntilde;a de Autorizaci&oacute;n SMTP";
$owl_lang->owl_email_subject_pref	= "Prefijo de Asunto:";
$owl_lang->owl_fogotpass		= "Mostrar vinculo Olvid&oacute; Contrase&ntilde;a:";
$owl_lang->owl_group_user		= "Usuarios que son miembros de este Grupo";
$owl_lang->owl_gzip_path     		= "Ruta gzip:";
$owl_lang->owl_hidebackup		= "Ocultar el Directorio de Copia de Seguridad:";
$owl_lang->owl_log_file			= "Actividades de Archivo Log:";
$owl_lang->owl_log_login_act		= "Actividades Log de Entrada/Salida:";
$owl_lang->owl_log_rec_page		= "Visor de Registros Log por P&aacute;gina:";
$owl_lang->owl_logging			= "Habilitar Registro en Logs:";
$owl_lang->owl_logo			= "Logo de P&aacute;gina de Ingreso ([Lenguaje]/Gr&aacute;ficos):";
$owl_lang->owl_lookAtHD			= "Deshabilitar Buscar en Disco Local:";
$owl_lang->owl_lookAtHDDel		= "Remover Archivos Eliminados de la BD";
$owl_lang->owl_max_filesize		= "Tama&ntilde;o M&aacute;ximo de Archivos Subidos (en bytes)";
$owl_lang->owl_owl_expand		= "Vista de Navegaci&oacute;n por Defecto (Expandida)";
$owl_lang->owl_owl_timeout		= "Expiraci&oacute;n de la Sesi&oacute;n en Segundos";
$owl_lang->owl_pdftotext_path		= "Mantener Indice de B&uacute;squeda para <br />Archivos PDF y texto <br />&#8211; Dejar en Blanco para Deshabilitar:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 o Superior Requerido<br />Ruta para pod2html:";
$owl_lang->owl_restrict_view		= "Habilitar la Visualizaci&oacute;n Restringida:";
$owl_lang->owl_self_reg			= "Habilitar Autoregistro:";
$owl_lang->owl_self_reg_hd		= "PROPIEDADES PARA USUARIOS AUTOREGISTRADOS";
$owl_lang->owl_tar_path     		= "Ruta tar:";
$owl_lang->owl_title_browser		= "PROPIEDADES DEL NAVEGADOR OWL";
$owl_lang->owl_title_custom		= "PERSONALIZAR COLUMNAS DEL NAVEGADOR";
$owl_lang->owl_title_custom_search      = "PERSONALIZAR RESULTADOS DE BUSQUEDA";
$owl_lang->owl_title_defaults   	= "VALORES POR DEFECTO";
$owl_lang->owl_title_email		= "Propiedades del Sistema de Correo OWL";
$owl_lang->owl_title_HD			= "PROPIEDADES DE BUSQUEDA POR NUEVOS ARCHIVOS EN DISCO LOCAL";
$owl_lang->owl_title_logging  		= "PROPIEDADES DE REGISTRO EN LOGS";
$owl_lang->owl_title_other		= "OTRAS PROPIEDADES";
$owl_lang->owl_title_tools   		= "HERRAMIENTAS BD COPIA DE SEGURIDAD/GZIP";
$owl_lang->owl_unzip_path     		= "Ruta unzip:";
$owl_lang->owl_version_control		= "Habilitar el Control de Revisiones:";
$owl_lang->owl_wordtotext_path          = "Archivos MS-WORD<br />&#8211; Dejar en Blanco para Deshabilitar:";
$owl_lang->owl_ppttotext_path          = "Archivos MS-POWERPOINT<br />&#8211; Dejar en Blanco para Deshabilitar:";
$owl_lang->quota			= "Cuota 0=Deshabilitado";
$owl_lang->reallydeluser		= "Este usuario es propietario de %numfiles% Archivo(s) y %numfolders% Carpetas(s). Estos Archivos(s) y Carpetas(s) quedar&aacute;n hu&eacute;rfanos. &iquest;En realidad desea Eliminarlo?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->reallydeletegroup            = "Really Delete this Group?";
$owl_lang->recs_per_page		= "Mostrar Registros por P&aacute;gina (0 = Deshabilitado):";
$owl_lang->recycle_enabled		= "Habilitar Recolecci&oacute;n en Papelera:";
$owl_lang->recycle_location		= "Ubicaci&oacute;n de la Papelera:";
$owl_lang->recycle_title		= "PROPIEDADES DE RECOLECCION EN PAPELERA";
$owl_lang->remember_me			= "Mostrar V&iacute;nculo de Recordarme";
$owl_lang->remember_me_checkbox		= "Recordarme";
$owl_lang->remember_me_title		= "PROPIEDADES PARA RECORDAR INGRESO";
$owl_lang->remember_timeout		= "Expiraci&oacute;n de Cookie en D&iacute;as";
$owl_lang->restore_file_prefix		= "Cadena Prefija para Archivos Restaurados";
$owl_lang->search_result_folders	= "Incluir Carpetas en Resultados de B&uacute;squeda";
$owl_lang->show_action_title		= "Mostrar Botones de Acci&oacute;n:";
$owl_lang->show_bulk_title		= "Mostrar Botones M&uacute;ltiples:";
$owl_lang->show_folder_title		= "Mostrar Herramientas de Carpeta:";
$owl_lang->show_panel			= "Mostrar";
$owl_lang->show_panel_title		= "Mostrar Panel de Status:";
$owl_lang->show_pref_title		= "Mostrar Barra de Preferencias/Salir:";
$owl_lang->show_search_title		= "Mostrar Barra de B&uacute;squeda:";
$owl_lang->status_bar_both              = "Inicio Y Final";
$owl_lang->status_bar_bottom            = "&Uacute;nicamente Final";
$owl_lang->status_bar_location          = "Mostrar la barra de estado en:";
$owl_lang->status_bar_not               = "No Mostrar";
$owl_lang->status_bar_top               = "&Uacute;nicamente Inicio";
$owl_lang->use_popup			= "Usar ventana emergente para mostrar Noticias:";
$owl_lang->users           		= "Usuarios";
$owl_lang->virus_path			= "Ruta del Software AntiVirus<br />Ejemplo: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; Dejar en Blanco para Deshabilitar:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Campos Personalizados dentro de Descripci&oacute;n de Ventana Emergente";
$owl_lang->cust_headpopup     		= "CAMPOS ESPECIFICOS DE DOCUMENTOS";
$owl_lang->auth_http                    = "Autenticaci&oacute;n HTTP (.htaccess)";
$owl_lang->auth_ldap                    = "Autenticaci&oacute;n LDAP";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Usuarios que tienen este grupo como Grupo PRIMARIO";
$owl_lang->create_user_homedir 		= "Create User HomeDir:";
$owl_lang->use_captcha 			= "Use CAPTCHA:";
$owl_lang->created_here 		= "<br /> (CREATED HERE IF create homedir checked)";
$owl_lang->auth_owl                     = "Autenticaci&oacute;n Owl";
$owl_lang->auth_pop3                    = "Autenticaci&oacute;n pop3";
$owl_lang->file_desc_required           = "Requerida Descripci&oacute;n de Archivo";
$owl_lang->folder_desc_required         = "Requerida Descripci&oacute;n de Carpeta";
$owl_lang->html_title		= "Preferencias HTML";
$owl_lang->pass_account_lockout      	    = "N&uacute;mero de Intentos para Bloquear:";
$owl_lang->pass_change_every                = "Forzar Cambio de Contrase&ntilde;a cada (en D&iacute;as) 0=Deshabilitado:";
$owl_lang->pass_enable_account_lockout      = "Habilitar Bloqueo de Cuenta:";
$owl_lang->pass_min_passwd_length           = "Longitud M&iacute;nima en Contrase&ntilde;as de Usuario:";
$owl_lang->pass_min_passwd_numeric          = "Cantidad M&iacute;nima de Caracteres Num&eacute;ricos:";
$owl_lang->pass_min_passwd_special          = "Cantidad M&iacute;nima de Caracteres Especiales:";
$owl_lang->pass_min_username_length         = "Longitud M&iacute;nima en Nombres de Usuario:";
$owl_lang->pass_track_old_passwords   	    = "N&uacute;mero de Contrase&ntilde;as Anteriores a Tener en Cuenta:";
$owl_lang->rtftotext_path                = "Ruta de Herramienta Conversor RTF a Texto";
$owl_lang->show_user_info           = "Usuarios Desplegados son Seleccionables";
$owl_lang->user_admin              = "Administradir Usuario/Grupo";
$owl_lang->user_auth_type                   = "Tipo de Autenticaci&oacute;n:";
$owl_lang->user_change_pass_next_login      = "Cambiar Contrase&ntilde;a al Siguiente Ingreso:";
$owl_lang->user_expires                     = "La Cuenta Expira en:";
$owl_lang->user_gmt_offset              = "Zona Horaria GMT del Usuario";
$owl_lang->user_group_admin                 = "Administrador de Archivos para Grupo Primario:";
$owl_lang->user_login_to_newrecords         = "Ingreso a P&aacute;gina de Nuevos Registros:";
$owl_lang->users_group_admin		= "Usuarios que son Administradores de Grupo";
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

$owl_lang->owl_log_filter	= "Filtro";
$owl_lang->owl_log_hd_action	= "Acci&oacute;n";
$owl_lang->owl_log_hd_agent	= "Agente";
$owl_lang->owl_log_hd_dt_tm	= "Fecha Tiempo";
$owl_lang->owl_log_hd_dtls	= "Detalles";
$owl_lang->owl_log_hd_file	= "Archivo";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Ruta de Archivo";
$owl_lang->owl_log_hd_ip	= "Direcci&oacute;n / IP";
$owl_lang->owl_log_hd_user	= "Usuario";
$owl_lang->owl_log_hide      	= "Ocultar: ";
$owl_lang->owl_log_no_rec	= " NO SE ENCONTRARON REGISTROS ";
$owl_lang->owl_log_viewer	= "Visor de LOGS";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Vaciar Papelera";
$owl_lang->really_empty_trash	= "&iquest;Realmente desea vaciar la Papelera?";
$owl_lang->recycle_bin_admin    = "Administraci&oacute;n de Papelera";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Los Archivos que ha solicitado han sido adjuntados.";
$owl_lang->trash_email_subject  = "ARCHIVOS RESTAURADOS SOLICITADOS";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "No hacer nada &#8211; Dejar los permisos del archivo como est&aacute;n";
$owl_lang->everyoneread			= "Cualquiera puede leer/descargar";
$owl_lang->everyoneread_ad		= "Cualquiera puede leer/descargar";
$owl_lang->everyonewrite		= "Cualquiera puede leer/escribir/descargar";
$owl_lang->everyonewrite_ad		= "Cualquiera puede leer/escribir/descargar";
$owl_lang->everyonewrite_ad_nod		= "Cualquiera puede leer/escribir/descargar, NO ELIMINAR";
$owl_lang->everyonewrite_nod		= "Cualquiera puede leer/escribir/descargar, NO ELIMINAR";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Cualquiera puede leer esta carpeta";
$owl_lang->geveryoneread_ad		= "Cualquiera puede leer esta carpeta";
$owl_lang->geveryonewrite		= "Cualquiera puede subir archivos y eliminar esta carpeta";
$owl_lang->geveryonewrite_ad		= "Cualquiera puede subir archivos y eliminar esta carpeta";
$owl_lang->geveryonewrite_ad_nod	= "Cualquiera puede subir archivos y eliminar esta carpeta";
$owl_lang->geveryonewrite_nod		= "Cualquiera puede subir archivos y eliminar esta carpeta";
$owl_lang->ggroupread			= "Su grupo puede leer esta carpeta";
$owl_lang->ggroupread_ad		= "El grupo seleccionado puede leer esta carpeta";
$owl_lang->ggroupwrite			= "Su grupo puede subir archivos y eliminar esta carpeta";
$owl_lang->ggroupwrite_ad    		= "El grupo seleccionado puede subir archivos y eliminar esta carpeta";
$owl_lang->ggroupwrite_ad_nod		= "El grupo seleccionado puede subir archivos a esta carpeta";
$owl_lang->ggroupwrite_nod		= "Su grupo puede subir archivos a esta carpeta";
$owl_lang->ggroupwrite_worldread 	= "Su grupo puede subir archivos y eliminar esta carpeta &amp; cualquiera puede ver su contenido";
$owl_lang->ggroupwrite_worldread_ad 	= "El grupo seleccionado puede subir archivos y eliminar esta carpeta &amp; cualquiera puede ver su contenido";
$owl_lang->ggroupwrite_worldread_ad_nod	= "El grupo seleccionado puede subir archivos y eliminar esta carpeta &amp; cualquiera puede ver su contenido, NO ELIMINAR";
$owl_lang->ggroupwrite_worldread_nod 	= "Su grupo puede subir archivos &amp; cualquiera puede ver su contenido, NO ELIMINAR";
$owl_lang->gonlyyou			= "Solo ud puede subir archivos y eliminar esta carpeta";
$owl_lang->gonlyyou_ad			= "Solo ud puede subir archivos y eliminar esta carpeta";
$owl_lang->groupread			= "Su grupo puede leer/descargar";
$owl_lang->groupread_ad			= "El grupo seleccionado puede leer/descargar";
$owl_lang->groupwrite			= "puede leer/escribir/descargar";
$owl_lang->groupwrite_ad		= "El grupo seleccionado puede leer/escribir/descargar";
$owl_lang->groupwrite_ad_nod		= "El grupo seleccionado puede leer/escribir/descargar, NO ELIMINAR";
$owl_lang->groupwrite_nod		= "Su grupo puede leer/escribir/descargar, NO ELIMINAR";
$owl_lang->groupwrite_worldread 	= "Su grupo puede leer/escribir/descargar &amp; cualquiera puede leer";
$owl_lang->groupwrite_worldread_ad 	= "El grupo seleccionado puede leer/escribir/descargar &amp; cualquiera puede leer";
$owl_lang->groupwrite_worldread_ad_nod 	= "El grupo seleccionado puede leer/escribir/descargar (NO ELIMINAR) &amp; cualquiera puede leer";
$owl_lang->groupwrite_worldread_nod 	= "Su grupo puede leer/escribir/descargar (NO ELIMINAR) &amp; cualquiera puede leer";
$owl_lang->invalidsess			= "Identificador de sesi&oacute;n invalido, por favor intente acceder nuevamente en la p&aacute;gina principal<br />";
$owl_lang->notif_comment_1		= "Comentado en";
$owl_lang->notif_comment_2		= "Comentario:";
$owl_lang->notif_msg         		= "ESTE ES UN MENSAJE GENERADO AUTOMATICAMENTE DESDE OWL Intranet<br /><br />Encuentre el archivo nuevo/actualizado adjuntado a este Correo Electr&oacute;nico<br /><br />";
$owl_lang->notif_msg_alt         	= "ESTE ES UN MENSAJE GENERADO AUTOMATICAMENTE DESDE OWL Intranet\n\nEncuentre el archivo nuevo/actualizado adjuntado a este Correo Electr&oacute;nico\n\n";
$owl_lang->notif_msg_alt_link           = "ESTE ES UN MENSAJE GENERADO AUTOMATICAMENTE DESDE OWL Intranet\n\nEncuentre el v&iacute;nculo al archivo nuevo/actualizado en este Correo Electr&oacute;nico\n\n";
$owl_lang->notif_msg_link               = "ESTE ES UN MENSAJE GENERADO AUTOMATICAMENTE DESDE OWL Intranet<br /><br />Encuentre el v&iacute;nculo al archivo nuevo/actualizado en este Correo Electr&oacute;nico<br /><br />";
$owl_lang->notif_salutation		= "Estimado";
$owl_lang->notif_subject_comment	= "Archivo de Intranet OWL -- Comentario Agregado";
$owl_lang->notif_subject_monitor	= "El archivo o carpeta de Intranet OWL que esta MONITORIZANDO ha sido actualizado";
$owl_lang->notif_subject_new 		= "Nuevo Archivo de Intranet OWL";
$owl_lang->notif_subject_upd 		= "El archivo de Intranet OWL ha sido actualizado";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_file_deleted   = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account       = "A NEW OWL ACCOUNT WAS CREATED FOR YOU";
$owl_lang->notif_user			= "Creado/Actualizado por:";
$owl_lang->onlyyou			= "Solo ud puede leer/descargar/escribir";
$owl_lang->onlyyou_ad			= "Solo ud puede leer/descargar/escribir";
$owl_lang->orphaned			= "&#8211; NO tiene propietario  &#8211;";
$owl_lang->owl_path			= "Ruta del archivo: ";
$owl_lang->sessinuse			= "La sesi&oacute;n esta activa en otro computador, acceso denegado<br />";
$owl_lang->sesstimeout			= "Su sesi&oacute;n ha expirado, por favor acceda nuevamente<br />";
$owl_lang->virus_infected 		= "ARCHIVO INFECTADO DE VIRUS";
$owl_lang->virus_return_val		= "Mensaje del Programa Antivirus:";
$owl_lang->watermark_string             = "Confidential";
$owl_lang->watermark_source             = "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Examinar esta Carpeta";
$owl_lang->title_browse_site     	= "Examinar este URL";
$owl_lang->title_download_view     	= "Descargar / Ver este Archivo";
$owl_lang->title_edit_prefs     	= "Ver / Editar Preferencias de Usuario";
$owl_lang->title_return_folder     	= "Regresar a";
$owl_lang->title_sort     		= "Ordenar por";
$owl_lang->title_view_my     		= "Ver lista de Mis Archivos";
$owl_lang->title_view_new     		= "Ver Lista de Archivos Nuevos desde Mi &Uacute;ltima Visita";
$owl_lang->title_view_updated     	= "Ver lista de Archivos Actualizados desde Mi &Uacute;ltima Visita";
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

$owl_lang->news_content			= "Contenido";
$owl_lang->news_hd			= "Noticia";
$owl_lang->news_hd_audience		= "Audiencia Objetivo";
$owl_lang->news_hd_created		= "Creada en";
$owl_lang->news_hd_expires		= "Expira en";
$owl_lang->news_heading			= "Encabezado de Noticia";
$owl_lang->news_posted_date		= "Noticias Publicadas:";
$owl_lang->news_read			= "Leer";
$owl_lang->news_title			= "Administraci&oacute;n de Noticias";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEPURAR: El Directorio de Documentos OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." no existe.";
$owl_lang->debug_doc_not_writeable	= "DEPURAR: El Directorio de Documentos OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." no tiene permisos de escritura para el Servidor Web.";
$owl_lang->debug_file_not_exist		= "DEPURAR: El archivo requerido &ldquo;$default->owl_fs_root/%s &rdquo; no existe.<br /> OR<br />La ruta espeficada por \$default->owl_fs_root in config/owl.php es incorrecta.";
$owl_lang->debug_tmp_not_exists		= "DEPURAR: El Directorio Temporal de OWL: %s no existe.";
$owl_lang->debug_tmp_not_writeable	= "DEPURAR: El Directorio Temporal de OWL: %s no tiene permisos de escritura para el Servidor Web.";
$owl_lang->debug_webserver_no_access	= "DEPURAR: El Servidor Web no tiene acceso de lectura a: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Porfavor revise los permisos e intente nuevamente";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Visor de Estad&iacute;sticas / Reportes";
$owl_lang->stats_files		= "N&uacute;mero de Archivos por Usuario";
$owl_lang->stats_folders	= "N&uacute;mero de Carpetas por Usuario";
$owl_lang->stats_information	= "Logs OWL y Logs de archivos deben ser habilitados para poder ver estas estad&iacute;sticas";
$owl_lang->stats_top		= "Top 20 de descargas";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "Sesi&oacute;n de Usuario (Ingreso / Fallo / Salida)";
$owl_lang->stats_users_loggedin = "Actualmente dentro del Sistema";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administracion de Tipo de Documento";
$owl_lang->doc_field_label	= "Campo Etiqueta (Por Idioma)";
$owl_lang->doc_field_name	= "Campo Nombre";
$owl_lang->doc_field_pos	= "Campo Pos";
$owl_lang->doc_field_required	= "Requerido?";
$owl_lang->doc_field_searchable	= "Permite Busqueda?";
$owl_lang->doc_field_size	= "Tama&ntilde;o del Campo";
$owl_lang->doc_new_doc_type	= "&#8211; AGREGAR Nuevo Tipo de Documento &#8211;";
$owl_lang->doc_specific		= "CAMPOS ESPECIFICOS DEL DOCUMENTO:";
$owl_lang->document_type	= "Tipo de Documento";
$owl_lang->document_type_name	= "Nombre Tipo de Documento";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Insertar en Descripci&oacute;n Emergente?";
$owl_lang->doc_field_disp_label = "CAMPO ETIQUETA:";
$owl_lang->doc_field_disp_sep = "ETIQUETA SEPARADOR";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;V&nbsp;I&nbsp;S&nbsp;T&nbsp;A&nbsp;&nbsp;&nbsp;E&nbsp;J&nbsp;E&nbsp;M&nbsp;P&nbsp;L&nbsp;O&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Mostrar Explorador:";
$owl_lang->doc_field_show_in_list = "Mostrar Campo en Vista de Explorador:";
$owl_lang->doc_field_type	= "Tipo de Campo:";
$owl_lang->doc_field_values	= "Valoes de Campo Separados con | :";
$owl_lang->doc_fields = "Campos Personalizados";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grupo:";
$owl_lang->header_csv_import    = "Imporar Archivo de Usuario CSV";
$owl_lang->import_inserted      = "INSERTADO";
$owl_lang->import_skipped       = "SALTADO";
$owl_lang->invalid_groupid      = "Identificador de Grupo Inv&aacute;lido --> ";
$owl_lang->msg_user_exists      = "El Usuario ya existe";
$owl_lang->sendcsvfile          = "Cargar archivo delimitado por comas";
$owl_lang->user_created_skipped = "Usuario:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Habilitar la Funcionalidad de Revisi&oacute;n:";
$owl_lang->owl_peer_review_opt  = "Hacer que la Revisi&oacute;n de Documentos sea Opcional:";
$owl_lang->owl_title_peer_review= "FUNCIONALIDAD DE REVISI&Oacute;N DE DOCUMENTOS";
$owl_lang->owl_title_peer_review2= "Revisi&oacute;n de Documentos";
$owl_lang->peer_approval_title 	= "Documentos esperando Mi Aprobaci&oacute;n";
$owl_lang->peer_approved_body	= "Su archivo ha sido aprobado:";
$owl_lang->peer_file_approved	= "Archivo Aprobado:";
$owl_lang->peer_file_final	= "Aprobaci&oacute;n Final:";
$owl_lang->peer_file_rejected	= "Archivo Rechazado:";
$owl_lang->peer_file_to_review	= "Archivo para revisar:";
$owl_lang->peer_final_approval	= "[Aprobaci&oacute;n Final]: ";
$owl_lang->peer_final_body	= "Su documento ha sido aprobado por todos los revisores solicitados.<br />Porfavor accese al sistema para publicar su documento<br />";
$owl_lang->peer_msg_to_reviewer	= "Mensaje a Revisores";
$owl_lang->peer_my_approval	= "Esperando para Mi Aprobaci&oacute;n";
$owl_lang->peer_notif_user	= "Creado/Actualizado por";
$owl_lang->peer_pending_approval= "Mis Aprobaciones Pendientes";
$owl_lang->peer_pending_title 	= "Mis Documentos Pendientes de Aprobaci&oacute;n";
$owl_lang->peer_reject_reason   = "Raz&oacute;n del Rechazo";
$owl_lang->peer_rejected_body	= "Su archivo ha sido rechazado:";
$owl_lang->peer_review_body	= "Su aprobaci&oacute;n ha sido solicitada para el siguiente documento:";
$owl_lang->peer_reviewer_list	= "Revisor(es)";
$owl_lang->peer_satus	 	= "Status";
$owl_lang->peer_satus_approved  = "&#8212; A P R O B A D O &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; P E N D I E N T E &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; R E C H A Z A D O &#8212;";
$owl_lang->peer_subj_approved	= "Su documento ha sido APROBADO";
$owl_lang->peer_subj_rejected	= "Su documento ha sido RECHAZADO";
$owl_lang->peer_subj_reminder	= "RECORDATORIO: Tiene un archivo OWL para revisar";
$owl_lang->peer_subj_review	= "Tiene un archivo OWL pendiente de revisi&oacute;n";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Su documento ha sido aprobado por todos los revisores solicitados.<br />Su archivo se ha hecho p&uacute;blico.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Agregando Archivo ACL:";
$owl_lang->acl_adding_folder           = "Agregando Carpeta ACL:";
$owl_lang->acl_available_groups        = "Grupo(s) Disponible(s)";
$owl_lang->acl_available_users         = "Usuarios(s) Disponible(s)";
$owl_lang->acl_edit_file               = "Editando Archivo ACL:";
$owl_lang->acl_edit_folder             = "Editando Carpeta ACL:";
$owl_lang->acl_file_checkin            = "Inscribir/Retirar";
$owl_lang->acl_file_comment            = "Comentario";
$owl_lang->acl_file_copy               = "Copiar";
$owl_lang->acl_file_delete             = "Eliminar";
$owl_lang->acl_file_email              = "Correo Electr&oacute;nico";
$owl_lang->acl_file_modify             = "Propiedades";
$owl_lang->acl_file_monitor            = "Monitorear";
$owl_lang->acl_file_move               = "Mover";
$owl_lang->acl_file_read               = "Leer";
$owl_lang->acl_file_search             = "Buscar Relacionado";
$owl_lang->acl_file_set_acl            = "Establecer ACL";
$owl_lang->acl_file_update             = "Actualizar";
$owl_lang->acl_file_view_log           = "Ver Log";
$owl_lang->acl_folder_copy             = "Copiar";
$owl_lang->acl_folder_delete           = "Eliminar";
$owl_lang->acl_folder_modify           = "Modificar Propiedades";
$owl_lang->acl_folder_monitor          = "Monitorear";
$owl_lang->acl_folder_move             = "Mover";
$owl_lang->acl_folder_read             = "Leer (Descargar/Explorar)";
$owl_lang->acl_folder_set_acl          = "Establecer ACL";
$owl_lang->acl_folder_write            = "Escribir (Crear)";
$owl_lang->acl_heading_file            = "Grupo(s)/Usuarios(s)";
$owl_lang->acl_heading_files           = "ARCHIVOS &#8211; SELECCIONE USUARIO(s) y GRUPO(s) DESEADOS(s)";
$owl_lang->acl_heading_folder          = "Grupo(s)/Usuario(s)";
$owl_lang->acl_heading_folders         = "CARPETAS &#8211; SELECCIONE USUARIO(s) y GRUPO(s) DESEADOS(s)";
$owl_lang->acl_propagate_file          = "Establecer esta Pol&iacute;tica en \"TODOS\" los Archivos:";
$owl_lang->acl_propagate_folders       = "Propagar a toda(s) la(s) subcarpeta(s):";
$owl_lang->acl_selected_groups         = "Grupo(s) Seleccionado(s)";
$owl_lang->acl_selected_users          = "Usuarios(s) Seleccionado(s)";
$owl_lang->acl_set_acl                 = "Establecer Pol&iacute;tica de Seguridad";
$owl_lang->acl_set_acl_now             = "Establecer Pol&iacute;tica de Seguridad Ahora:";
$owl_lang->acl_set_selected            = "Establecer Seleccionado";
$owl_lang->alt_acl_save_file           = "Guardar Pol&iacute;tica de Seguridad de Archivos";
$owl_lang->alt_acl_save_folder         = "Guardar Pol&iacute;tica de Seguridad de Carpetas";
$owl_lang->btn_acl_save                = "Guardar";
$owl_lang->acl_set_file_permissions    = "Establecer Permisos de Archivo";
$owl_lang->acl_set_folder_permissions  = "Establecer Permisos de Carpeta";
$owl_lang->acl_view_membership         = "View<br />Membership";
$owl_lang->acl_remove_acl              = "Remove<br /> ACL";
$owl_lang->acl_membership_header       = "Member of Group(%s)";
$owl_lang->acl_membership_special_user = " Special User that represents ALL USERS ";
$owl_lang->acl_no_users_available      = " --- No Users Available ---";
$owl_lang->acl_no_groups_available     = " --- No Groups Available ---";
$owl_lang->acl_add_user                = "Add User";
$owl_lang->acl_add_group               = "Add Group";
$owl_lang->acl_user                    = "User ACL" . LABEL_TERMINATOR;
$owl_lang->acl_group                   = "Group ACL" . LABEL_TERMINATOR;
$owl_lang->alt_set_folder_acl	       = "Establecer Pol&iacute;tica de Seguridad de la Carpeta Actual";

//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Reportes Disponibles:";
$owl_lang->report_file_folder               = "Archivo/Carpeta";
$owl_lang->report_filter                    = "Filtro:";
$owl_lang->report_filter_since              = "Desde:";
$owl_lang->report_full_access               = "ACCESO COMPLETO";
$owl_lang->report_select_report             = "&#8211; Seleccione un Reporte &#8211;";
$owl_lang->report_users_disabled_title      = "Usuario(s) Deshabilitado(s)";
$owl_lang->report_users_entitlement         = "Lista de Acceso de Usuarios";
$owl_lang->report_users_inactive_title      = "Usuario(s) Inactivo(s) Desde";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Habilitar Vista /Generaci&oacute;n Miniatura:";
$owl_lang->thumb_gen_thumb_tool_path       = "Ruta de Herramienta Conversor ImageMagic:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Parametros Reproductor Mplayer:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Ruta de Reproductor Mplayer:";
$owl_lang->thumb_image_info                = "Informaci&oacute;n De im&aacute;gen";
$owl_lang->thumb_large_width               = "Tama&ntilde;o de Vista Miniatura(GRANDE) en Pixeles:";
$owl_lang->thumb_med_width                 = "Tama&ntilde;o de Vista Miniatura(MEDIA) en Pixeles:";
$owl_lang->thumb_number_colums             = "Numero de Columnas por Vista Miniatura:";
$owl_lang->thumb_re_generate               = "Generar Vista Miniatura";
$owl_lang->thumb_small_width               = "Tama&ntilde;o de Vista Miniatura(PEQUE&Ntilde;A) en Pixeles 0=No Mostrar:";
$owl_lang->thumb_title                     = "OPCIONES DE VISTA/GENERACI&Oacute;N MINIATURA";
$owl_lang->thumb_title_thumb_view          = "DETALLES DE VISTA EN MINIATURA";
$owl_lang->thumb_image_size                = "Tama&ntilde;o de la Im&aacute;gen:";
$owl_lang->alt_thumb_small                 = "Peque&ntilde;a Vista en Miniatura";
$owl_lang->alt_no_thumb                    = "No hay Vista en Miniatura Disponible";

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
