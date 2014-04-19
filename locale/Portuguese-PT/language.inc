<?php
/*
 * File: Portuguese-PT/language.inc
 *
 * Author: Filipe Alexandre Castro Lima
 * Date: 2008/03/05
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
// Date Formata&ccedil;&atilde;o In&iacute;cio
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

// Language Code Portuguese-PT (Portugu&ecirc;s de Portugal)
// exemplo: "PT-PT"
$owl_lang->lang_code = "PT-PT";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_adding_comments	= "N&atilde;o tem permiss&atilde;o para adicionar coment&aacute;rios a este arquivo";
$owl_lang->err_backup_file   	= "Erro ao fazer c&oacute;pia de seguran&ccedil;a do arquivo existente";
$owl_lang->err_backup_folder_create	= "Erro ao fazer c&oacute;pia de seguran&ccedil;a da pasta";
$owl_lang->err_bad_url			= "Por favor introduza um URL v&aacute;lido";
$owl_lang->err_bad_version_1 	= "Owl requer no m&iacute;nimo o PHP vers&atilde;o";
$owl_lang->err_bad_version_2 	= "Est&aacute; a executar o PHP vers&atilde;o";
$owl_lang->err_bad_version_3 	= "Instale uma vers&atilde;o mais recente e tente novamente";
$owl_lang->err_comment_empty	= "O coment&aacute;rio n&atilde;o pode estar vazio.";
$owl_lang->err_email         	= "A mensagem n&atilde;o pode ser enviada";
$owl_lang->err_email_required	= "O campo E-Mail &eacute; obirgat&oacute;rio";
$owl_lang->err_fexist1			= "<b>O arquivo j&aacute; existe:</b>";
$owl_lang->err_fexist2 			= "J&aacute; existe um arquivo com o nome <i>";
$owl_lang->err_fexist3 			= "</i> nessa pasta.";
$owl_lang->err_file_exists		= "O arquivo que est&aacute; a enviar j&aacute; existe";
$owl_lang->err_file_lock     	= "N&atilde;o pode fazer a sa&iacute;da do arquivo, ele est&aacute; retido por";
$owl_lang->err_file_not_exist	= "O arquivo n&atilde;o existe no Sistema de Arquivos";
$owl_lang->err_file_too_big		= "php.ini upload_max_filesize excede e/ou<br />  tamanho m&aacute;ximo de arquivo para envio do Owl";
$owl_lang->err_file_update		= "Actualizar um arquivo requer que o nome permane&ccedil;a o mesmo. Por favor use o mesmo nome de arquivo";
$owl_lang->err_fileexists    	= "A ac&ccedil;&atilde;o Mover foi cancelada<br />J&aacute; existe um arquivo com o mesmo nome.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist   = "J&aacute; existe um arquivo com o nome que escolheu";
$owl_lang->err_folder_create 	= "Erro na cria&ccedil;&atilde;o da Pasta";
$owl_lang->err_folder_exist		= "Essa Pasta j&aacute; existe";
$owl_lang->err_folderexists  	= "A ac&ccedil;&atilde;o Renomear foi cancelada<br />J&aacute; existe uma Pasta com o mesmo nome.";
$owl_lang->err_general 			= "Ocorreu um erro. Contacte o administrador de sistema.";
$owl_lang->err_select_reviewer	= "Por favor seleccione pelo menos uma pessoa para Rever o seu documento";
$owl_lang->err_update_file_lock = "N&atilde;o pode atualizar este arquivo, ele est&aacute; retido por";
// NEW CHANGE
$owl_lang->err_group_delete     = "N&atilde;o pode apagar este Grupo: <font color=\"red\">%d</font> Arquivo(s),  <font color=\"red\">%d</font> Pasta(s), <font color=\"red\">%d</font> Utilizador(es) com este Grupo Prim&aacute;rio, <font color=\"red\">%d</font> Utilizador(es) &eacute;(s&atilde;o) membro(s) deste grupo";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type= "N&atilde;o pode apagar este Tipo de Documento, pois ainda existem documentos desse tipo";
$owl_lang->err_database			= "Erro na base de dados";
$owl_lang->err_doc_field_req    = "Campo obrigat&oacute;rio inexistente:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req= "Nome de Tipo de Documento &eacute; obrigat&oacute;rio <br />";
$owl_lang->err_field_label_req 	= "Etiqueta do Campo &eacute; obrigat&oacute;ria <br />";
$owl_lang->err_field_name_req	= "Nome do Campo &eacute; obrigat&oacute;rio <br />";
$owl_lang->err_field_size_req	= "Tamanho do Campo &eacute; obrigat&oacute;rio <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_file_indexing	= "Texto tempor&aacute;rio &ldquo;TEXT&rdquo; Falha na cria&ccedil;&atilde;o do Arquivo";
$owl_lang->err_forbidden_file	= "Tipo de Arquivo proibido";
$owl_lang->err_group_exists		= "J&aacute; existe um Grupo com este nome.";
$owl_lang->err_gzip_not_found  	= "Gzip n&atilde;o foi encontrado";
$owl_lang->err_login			= "Por favor autentique-se para executar esta ac&ccedil;&atilde;o.";
$owl_lang->err_movecancel    	= "A ac&ccedil;&atilde;o Mover foi cancelada<br />";
$owl_lang->err_nameempty    	= "Nome de Pasta n&atilde;o pode estar vazio";
$owl_lang->err_news_required	= "ERRO: Cabe&ccedil;alho e Conte&uacute;do de Not&iacute;cias s&atilde;o obrigat&oacute;rios!";
$owl_lang->err_no_access 		= "N&atilde;o tem acesso a nenhum dos arquivos seleccionados";
$owl_lang->err_no_access_info 	= "Causas poss&iacute;veis: <br />1) N&atilde;o selecionou nenhuma caixa de verifica&ccedil;&atilde;o do Arquivo ou Pasta<br />2) Apagar Conjunto, E-Mail Conjunto, Sa&iacute;da Conjunto n&atilde;o aplicado &agrave;(s) Pasta(s)<br />3) N&atilde;o tem acesso a nenhum Arquivo ou Pasta que seleccionou.";
$owl_lang->err_noemail			= "N&atilde;o tem acesso para enviar E-mail deste arquivo.";
$owl_lang->err_nofileaccess		= "N&atilde;o tem acesso a este Arquivo";
$owl_lang->err_nofiledelete		= "N&atilde;o tem acesso para apagar este Arquivo";
$owl_lang->err_nofilemod		= "N&atilde;o tem acesso para modificar este Arquivo";
$owl_lang->err_nofolderaccess	= "N&atilde;o tem acesso a esta Pasta";
$owl_lang->err_nofolderdelete	= "N&atilde;o tem acesso para apagar esta Pasta";
$owl_lang->err_nofoldermod		= "N&atilde;o tem acesso para modificar esta Pasta";
$owl_lang->err_nosubfolder		= "N&atilde;o tem acesso para criar SubPastas aqui";
$owl_lang->err_not_zip			= "N&atilde;o &eacute; um arquivo ZIP v&aacute;lido";
$owl_lang->err_note_title       = "O t&iacute;tulo &eacute; um campo obrigat&oacute;rio";
$owl_lang->err_note_title_exists= "J&aacute; existe uma Anota&ccedil;&atilde;o com este nome";
$owl_lang->err_noupload			= "N&atilde;o tem acesso para enviar nesta Pasta";
$owl_lang->err_pass_missmatch	= "A Nova Palavra-passe &eacute; diferente da sua confirma&ccedil;&atilde;o";
$owl_lang->err_pass_wrong    	= "A Palavra-passe antiga est&aacute; errada";
$owl_lang->err_please_select_bulk = "Por favor seleccione pelo menos um Arquivo ou Pasta, usando as caixas de verifica&ccedil;&atilde;o";
$owl_lang->err_pod2html_not_found = "ERRO: A ferramenta pod2html n&atilde;o foi encontrada: ";
$owl_lang->err_quota			= "N&atilde;o tem espa&ccedil;o e/ou quota suficiente para enviar o arquivo: ";
$owl_lang->err_quota_avail		= " dispon&iacute;vel.";
$owl_lang->err_quota_exceed  		= "Excedeu a sua quota";
$owl_lang->err_quota_needed		= " necess&aacute;rio ";
$owl_lang->err_req			= "ERRO: Todos os Campos s&atilde;o obrigat&oacute;rios";
$owl_lang->err_root_delete		= "A Pasta Raiz n&atilde;o pode ser apagada";
$owl_lang->err_sess_notvalid 		= "A sess&atilde;o n&atilde;o &eacute; v&aacute;lida";
$owl_lang->err_sess_write		= "Erro ao gravar informa&ccedil;&atilde;o da sess&atilde;o na base de dados";
$owl_lang->err_specialfoldername 	= "&ldquo;c&oacute;pia de seguran&ccedil;a&rdquo; &eacute; um Nome de Pasta reservado pelo Owl. Por favor escolha outro nome";
$owl_lang->err_sql			= "Erro SQL ";
$owl_lang->err_tar_not_found  		= "A ferramenta tar n&atilde;o foi encontrada em ";
$owl_lang->err_trash_can_empty 		= "A Lata de Lixo est&aacute; Vazia";
$owl_lang->err_unauth_area   		= "N&atilde;o est&aacute; autorizado a usar esta &aacute;rea";
$owl_lang->err_unauthorized  		= "N&atilde;o Autorizado";
$owl_lang->err_upload 			= "Erro de envio";
$owl_lang->err_user_exists		= "O Nome de utilizador j&aacute; existe";
$owl_lang->err_captcha_auth		= "Autentica&ccedil;&atilde;o CAPTCHA falhou";

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Adic. Campo";
$owl_lang->btn_add_file           = "Adic. Documento";
$owl_lang->btn_add_folder         = "Adic. Pasta";
$owl_lang->btn_dist_folder       = "Publish Folder";
$owl_lang->btn_add_news           = "Adic. Not&iacute;cia";
$owl_lang->btn_add_note           = "Adic. Anota&ccedil;&atilde;o";
$owl_lang->btn_jupload          = "Jupload";
$owl_lang->btn_add_url            = "Adic. Url";
$owl_lang->btn_add_zip            = "Adic. Arquivo";
$owl_lang->btn_admin              = "Admin.";
$owl_lang->btn_admin_groups       = "Novo Grupo";
$owl_lang->btn_admin_news         = "Admin. Not&iacute;cias";
$owl_lang->btn_admin_user_group   = "Admin. Utilizador/Grupo ";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users        = "Novo Utilizador";
$owl_lang->btn_back               = "Voltar";
$owl_lang->btn_browse             = "Procurar";
$owl_lang->btn_bulk_checkout      = "Sa&iacute;da Conjunto";
$owl_lang->btn_bulk_delete        = "Apagar Conjunto";
$owl_lang->btn_bulk_download      = "Descarregar Conjunto";
$owl_lang->btn_bulk_email         = "E-mail Conjunto";
$owl_lang->btn_bulk_move          = "Mover Conjunto";
$owl_lang->btn_cancel          	  = "Cancelar";
$owl_lang->btn_clickhere          = "Clique Aqui";
$owl_lang->btn_collapse_view      = "Vis&atilde;o Reduzida";
$owl_lang->btn_create             = "Criar";
$owl_lang->btn_default_view       = "Vis&atilde;o Padr&atilde;o";
$owl_lang->btn_deldoctype         = "Apagar Tipo Doc.";
$owl_lang->btn_download_bulk_package	= "para descarregar o seu Pacote de descarga em conjunto";
$owl_lang->btn_edit_group         = "Editar Grupo";
$owl_lang->btn_edit_user          = "Editar Utilizador";
$owl_lang->btn_expand_view        = "Vis&atilde;o Exp.";
$owl_lang->btn_go_bottom          = "Ir Para Rodap&eacute;";
$owl_lang->btn_go_top             = "Ir Para Topo";
$owl_lang->btn_help               = "Ajuda";
$owl_lang->btn_import_users       = "Importar<br />Utilizador(es)";
$owl_lang->btn_login              = "Autenticar";
$owl_lang->btn_logout             = "Sair";
$owl_lang->btn_mail_tool          = "E-Mail";
$owl_lang->btn_register           = "Registar";
$owl_lang->btn_reset              = "Limpar";
$owl_lang->btn_send_email         = "Enviar E-Mail";
$owl_lang->btn_submit             = "Submeter";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view         = "Vis&atilde;o Imagens Reduzidas";
$owl_lang->btn_trash_admin        = "Lixo";
// NEW STUFF
$owl_lang->btn_export             = "Exportar";
$owl_lang->btn_gen_pdf            = "Gerar PDF";
// NEW SUTFF END
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";


//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_add_comments       = "Adicionar coment&aacute;rio neste arquivo";
$owl_lang->alt_add_field	  = "Adicionar o campo acima";
$owl_lang->alt_add_group	  = "Criar este grupo";
$owl_lang->alt_add_news		  = "Adicionar novo item de not&iacute;cias";
$owl_lang->alt_add_user		  = "Criar este Utilizador";
$owl_lang->alt_admin_flush    = "Limpar Sess&otilde;es Interrompidas";
$owl_lang->alt_admin_groups	  = "Criar novo grupo";
$owl_lang->alt_admin_users	  = "Criar novo utilizador";
$owl_lang->alt_approve_file 	  = "Aprovar este documento";
$owl_lang->alt_back      	  = "Voltar ao ecr&atilde; anterior";
$owl_lang->alt_btn_add_file       = "Criar novo arquivo";
$owl_lang->alt_btn_add_folder	  = "Criar nova pasta";
$owl_lang->alt_btn_dist_folder  = "Create RSS Feed / Torrent for this Folder";
$owl_lang->alt_btn_add_note       = "Criar nova anota&ccedil;&atilde;o";
$owl_lang->alt_btn_jupload     = "Add Multiple files using jupload";
$owl_lang->alt_btn_add_url	  = "Crir novo URL";
$owl_lang->alt_btn_add_zip     	  = "Criar um arquivo Zip para ser extra&iacute;do";
$owl_lang->alt_btn_admin 	  = "Administra&ccedil;&atilde;o Owl";
$owl_lang->alt_btn_browse	  = "Voltar para Pesquisa de Arquivos";
$owl_lang->alt_btn_bulk_checkout  = "Reter Conjunto de Arquivos";
$owl_lang->alt_btn_bulk_delete 	  = "Apagar Conjunto de Arquivos";
$owl_lang->alt_btn_bulk_download  = "Descarregar Conjunto de Arquivos";
$owl_lang->alt_btn_bulk_email  	  = "E-Mail Conjunto de Arquivos";
$owl_lang->alt_btn_bulk_move   	  = "Mover Conjunto de Arquivos e Pastas";
$owl_lang->alt_btn_clickhere	  = "Clicar aqui";
$owl_lang->alt_btn_collapse_view  = "Chave para Vis&atilde;o Reduzida";
$owl_lang->alt_btn_default_view   = "Chave para Vis&atilde;o Padr&atilde;o";
$owl_lang->alt_btn_expand_view    = "Chave para Vis&atilde;o Expandida";
$owl_lang->alt_btn_help		  = "Ajuda Owl Online";
$owl_lang->alt_btn_login	  = "Entrar no Reposit&oacute;rio Owl";
$owl_lang->alt_btn_logout	  = "Sair do Reposit&oacute;rio Owl";
$owl_lang->alt_btn_mail_tool   	  = "Ferramenta Simples de E-Mail";
$owl_lang->alt_btn_thumb_view     = "Chave para Vis&atilde;o Imagem Reduzida";
$owl_lang->alt_cancel		  = "Cancelar esta Ac&ccedil;&atilde;o";
$owl_lang->alt_cancel_move	  = "Cancelar Mover";
$owl_lang->alt_change		  = "Actualizar este registo";
$owl_lang->alt_comments 	  = "Existem Coment&aacute;rios para este Arquivo";
$owl_lang->alt_copy_file     	  = "Copiar Arquivo";
$owl_lang->alt_copy_folder   	  = "Copiar Pasta";
$owl_lang->alt_del_all		  = "Esvaziar Lixo";
$owl_lang->alt_del_comments       = "Apagar este Coment&aacute;rio";
$owl_lang->alt_edt_comments       = "Editar este Coment&aacute;rio";
$owl_lang->alt_del_field	  = "Apagar este Campo";
$owl_lang->alt_del_file      	  = "Apagar este Arquivo (S/N)";
$owl_lang->alt_del_folder    	  = "Apagar esta Pasta (S/N)";
$owl_lang->alt_del_group	  = "Apagar este Grupo";
$owl_lang->alt_del_news		  = "Apagar esta Not&iacute;cia";
$owl_lang->alt_del_selected	  = "Apagar todos os Arquivos seleccionados";
$owl_lang->alt_del_this_folder	  = "Apagar a Pasta &#8211; ";
$owl_lang->alt_del_user		  = "Apagar este Utilizador";
$owl_lang->alt_deldoctype	  = "Apagar o Tipo de Documento actual";
$owl_lang->alt_edit_field	  = "Editar esta Defini&ccedil;&atilde;o de Campo";
$owl_lang->alt_edit_group         = "Editar o Grupo seleccionado";
$owl_lang->alt_edit_news	  = "Editar esta Not&iacute;cia";
$owl_lang->alt_edit_user          = "Editar o Utilizador seleccionado";
$owl_lang->alt_email		  = "Enviar E-Mail do Arquivo";
$owl_lang->alt_email_reminder 	  = "E-Mail Lembrete";
$owl_lang->alt_email_selected	  = "E-Mail todos os Arquivos seleccionados";
$owl_lang->alt_get_file      	  = "Descarregar o Arquivo";
$owl_lang->alt_get_folder      	  = "Descarregar o conte&uacute;do da Pasta";
$owl_lang->alt_go_bottom      	  = "Ir para Rodap&eacute; da P&aacute;gina";
$owl_lang->alt_go_top 		  = "Ir para o Topo da P&aacute;gina";
$owl_lang->alt_have_news	  = "Voc&ecirc; tem Item(ns) de Not&iacute;cias para Ver";
$owl_lang->alt_have_no_news	  = "Nenhum Item(ns) de Not&iacute;cias para Ver";
$owl_lang->alt_home_folder	  = "Voltar para o Direct&oacute;rio Inicial ";
$owl_lang->alt_link_file     	  = "Ligar este Arquivo a Outro Direct&oacute;rio";
$owl_lang->alt_lock_file          = "Sa&iacute;da de Arquivo";
$owl_lang->alt_log_clear          = "Apagar todos os Relat&oacute;rios (S/N)";
$owl_lang->alt_log_file           = "Arquivo de Relat&oacute;rios";
$owl_lang->alt_log_next		  = "Exibir Registos Seguintes";
$owl_lang->alt_log_prev		  = "Exibir Registos Anteriores";
$owl_lang->alt_log_top		  = "Ir para o Primeiro Registo";
$owl_lang->alt_mod_file      	  = "Modificar Propriedades do Arquivo"; 
$owl_lang->alt_mod_folder    	  = "Modificar Propriedades da Pasta";
$owl_lang->alt_monitor		  = "Activar Monitor. deste Arquivo";
$owl_lang->alt_monitor_folder     = "Activar Monitor. desta Pasta";
$owl_lang->alt_monitored	  = "Parar Monitor. deste Arquivo";
$owl_lang->alt_monitored_folder   = "Parar Monitor. desta Pasta";
$owl_lang->alt_move_file     	  = "Mover Arquivo";
$owl_lang->alt_move_folder   	  = "Mover Pasta";
$owl_lang->alt_move_selected	  = "Mover todos Arquivos seleccionados";
$owl_lang->alt_my_approval	  = "Documento(s) Aguard. minha Aprova&ccedil;&atilde;o.";
$owl_lang->alt_new_doctype	  = "Criar Novo Tipo de Documento";
$owl_lang->alt_news_close	  = "Fechar Janela de Not&iacute;cias";
$owl_lang->alt_news_next	  = "Exibir Pr&oacute;ximo(s) Item(ns) de Not&iacute;cias";
$owl_lang->alt_news_prev	  = "Exibir Item(ns) Anterior(es) de Not&iacute;cias";
$owl_lang->alt_news_print	  = "Imprimir este Item de Not&iacute;cias";
$owl_lang->alt_pending_approval	  = "Aprova&ccedil;&atilde;o Doc. Pendente(s) com Outros";
$owl_lang->alt_play_file 	  = "Reproduzir Arquivo Media";
$owl_lang->alt_publish_file 	  = "Publicar o Documento";
$owl_lang->alt_recycle		  = "Lixo<br />(Vazio)";
$owl_lang->alt_recycle_disable	  = "Lixo<br />(Desabil.)";
$owl_lang->alt_recycle_not_found  = "Lixo<br />(N&atilde;o Encontrado)";
$owl_lang->alt_refresh_filter	  = "Iniciar Filtro / Actualizar Resultados";
$owl_lang->alt_register		  = "Submeter o Registo";
$owl_lang->alt_reject_file 	  = "Rejeitar este Documento";
$owl_lang->alt_related		  = "Encontrar Documentos Relacionados";
$owl_lang->alt_reset_form	  = "Rep&ocirc;r Valores do Formul&aacute;rio";
$owl_lang->alt_rest_selected	  = "Rp&ocirc;r todos os Arquivos seleccionados";
$owl_lang->alt_search		  = "Iniciar a Pesquisa";
$owl_lang->alt_send_email	  = "Enviar E-Mail";
$owl_lang->alt_sendfile		  = "Enviar Arquivo";
$owl_lang->alt_set_initial_dir	  = "Definir Direct&oacute;rio actual como o Inicial";
$owl_lang->alt_site_map           = "Mapa do s&iacute;tio";
$owl_lang->alt_submit      	  = "Submeter Formul&aacute;rio";
$owl_lang->alt_toggle_check_box	  = "Alterar Caixas de Verifica&ccedil;&atilde;o";
$owl_lang->alt_tool_status_green  = "Ferramenta est&aacute; ACTIVA";
$owl_lang->alt_tool_status_red	  = "Caminho incorreto e/ou n&atilde;o execut&aacute;vel";
$owl_lang->alt_unlock_file        = "Entrada de Arquivo";
$owl_lang->alt_upd_field	  = "Actualizar este Campo";
$owl_lang->alt_upd_file      	  = "Actualizar este Arquivo";
$owl_lang->alt_view_comments      = "Adic. / Ver Coment&aacute;rios do Arquivo";
$owl_lang->alt_view_file     	  = "Ver o Arquivo";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin    = "Lixo Administrativo";
$owl_lang->alt_edit_file_inline   = "Editar Arquivo Texto";
$owl_lang->alt_gen_pdf            = "Gerar vers&atilde;o PDF do Arquivo acima";
$owl_lang->alt_updated     	  = "O Documento foi actualizado desde a sua &uacute;ltima visita";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	          = "O Documento foi criado desde a sua &uacute;ltima visita";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		  = "Foi apagado todo o conte&uacute;do";
$owl_lang->log_detail		  = "N&atilde;o h&aacute; detalhes adicionais";
$owl_lang->log_file_to		  = "PARA: ";
$owl_lang->log_filter_all	  = "TODOS";
$owl_lang->log_login_det	  = "Nome de Utilizador: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group= "Grupo Modificado: ";
$owl_lang->log_admin_changed_user = "Utilizador Modificado: ";
$owl_lang->log_admin_created_group= "Grupo Criado: ";
$owl_lang->log_admin_created_user = "Utilizador Criado: ";
$owl_lang->log_admin_del_group    = "Grupo Apagado: ";
$owl_lang->log_admin_del_user     = "Utilizador Apagado: ";
$owl_lang->log_admin_disabled     = " Utilizador Desactivado: ";
$owl_lang->log_admin_email_restore= "Arquivos enviados via e-mail:";
$owl_lang->log_admin_trash_delfile= "Arquivo Apagado: ";
$owl_lang->log_admin_trash_delfold= "Pasta Apagada: ";
$owl_lang->log_admin_trash_empty  = "Lixo vazio";
$owl_lang->log_admin_trash_restore= "Restaurado: ";
$owl_lang->log_login_expired      = "Utilizador Expirou: ";
$owl_lang->log_login_too_many_attempts = "Desactivado (excesso de tentativas de autentica&ccedil;&atilde;o): ";
$owl_lang->log_readhd_feature_add = "Config. Leitura HD adicionada a esse arquivo";
$owl_lang->log_admin_to  = "para";
$owl_lang->log_admin_of  = "de";
// END NEW STUFF
$log_file_actions[1]        	= "AUTENTICA&Ccedil;&Atilde;O";
$log_file_actions[10]        	= "ARQUIVO DESBLOQUEADO";
$log_file_actions[11]        	= "ARQUIVO ENV. VIA E-MAIL";
$log_file_actions[12]        	= "ARQUIVO MOVIDO";
$log_file_actions[13]        	= "PASTA CRIADA";
$log_file_actions[14]        	= "PASTA APAGADA";
$log_file_actions[15]        	= "ARQUIVO MODIFICADO";
$log_file_actions[16]        	= "PASTA MOVIDA";
$log_file_actions[17]        	= "ESQUECEU SENHA";
$log_file_actions[18]        	= "REGIST. UTILIZADOR";
$log_file_actions[19]           = "ARQUIVO EXIBIDO";
$log_file_actions[2]        	= "AUTENTICA&Ccedil;&Atilde;O FALHOU";
$log_file_actions[20]           = "ARQUIVO VIRUS";
$log_file_actions[21]           = "ARQUIVO COPIADO";
$log_file_actions[22]           = "PASTA COPIADA";
$log_file_actions[23]           = "ARQUIVO LIGADO";
$log_file_actions[3]        	= "SAIR";
$log_file_actions[4]        	= "ARQUIVO APAGADO";
$log_file_actions[5]        	= "ARQUIVO ENVIADO";
$log_file_actions[6]        	= "ARQUIVO ACTUALIZADO";
$log_file_actions[7]        	= "ARQUIVO DESCARREGADO";
$log_file_actions[8]        	= "ARQUIVO MODIFICADO";
$log_file_actions[9]        	= "ARQUIVO BLOQUEADO";
// BEGIN NEW STUFF
$log_file_actions[24]           = "UTILIZADOR ADMIN";
$log_file_actions[25]           = "LIXO";
$log_file_actions[26]           = "ARQUIVO ACL";
$log_file_actions[27]           = "PASTA ACL";
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
$owl_lang->admin_login_date  = "O utilizador admin est&aacute; autenticado em: ";
$owl_lang->admin_login_from  = "O utilizador admin est&aacute; autenticado a partir de";
$owl_lang->admin_login_subject  = "Utilizador ADMIN AUTENTICADO";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Acesso An&oacute;nimo)";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Esqueceu a sua palavra-passe?";
$owl_lang->like_register	= "Gostaria de se registar?";
$owl_lang->login		= "Autenticar";
$owl_lang->logindisabled	= "A conta foi desactivada, contacte o administrador do sistema.";
$owl_lang->loginfail		= "Falha de Liga&ccedil;&atilde;o";
$owl_lang->password		= "Palavra-passe...";
$owl_lang->repository_list      = "Reposit&oacute;rio";
$owl_lang->successlogout 	= "Saiu do sistema com sucesso.";
$owl_lang->toomanysessions	= "N&uacute;mero m&aacute;ximo de sess&otilde;es activas, contacte o administrador do sistema";
$owl_lang->username		= "Utilizador.";
$owl_lang->forgot_username	= "Nome do Utilizador ou Endere&ccedil;o de E-mail";
$owl_lang->version 		= "Vers&atilde;o";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Ac&ccedil;&otilde;es";
$owl_lang->current_db         		= "Reposit&oacute;rio Actual:";
$owl_lang->current_folder 		= "Pasta Actual:";
$owl_lang->del_all			= "Esvaziar Lixo";
$owl_lang->del_selected			= "Apagar Seleccionado";
$owl_lang->disk_quota			= "Quota em disco";
$owl_lang->doc_number 			= "Doc. N&uacute;m.";
$owl_lang->email_selected		= "E-Mail Seleccionado";
$owl_lang->file 			= "Arquivo";
$owl_lang->folder_count_file		= "Arquivo(s)";
$owl_lang->folder_count_folder		= "Pasta(s)";
$owl_lang->folder_count_note		= "Anota&ccedil;&atilde;o(&otilde;es)";
$owl_lang->folder_count_pre		= "Esta Pasta cont&eacute;m";
$owl_lang->folder_count_url		= "URL(s)";
$owl_lang->folder_policy 		= "Pol&iacute;tica da Pasta Actual:";
$owl_lang->held                      	= "Retido"; 
$owl_lang->last_logged			= "<br />&Uacute;ltimo acesso em: ";
$owl_lang->menu_file_action		= "Ac&ccedil;&otilde;es de Arquivo dispon&iacute;veis";
$owl_lang->menu_folder_action		= "Ac&ccedil;&otilde;es de Pasta dispon&iacute;veis";
$owl_lang->menu_url_action		= "Ac&ccedil;&otilde;es de Url dispon&iacute;veis";
$owl_lang->modified 			= "Modificado";
$owl_lang->move_selected		= "Mover Seleccionado";
$owl_lang->new_file			= "Novo!";
$owl_lang->no_description		= "N&atilde;o h&aacute; descri&ccedil;&atilde;o dispon&iacute;vel";
$owl_lang->owner                    = "User";
#$owl_lang->owner                   = "Owner";
$owl_lang->page				= "P&aacute;gina:";
$owl_lang->panel_file_info		= "Informa&ccedil;&atilde;o do arquivo";
$owl_lang->postedby 			= "Enviado por";
$owl_lang->reallydelete			= "Confirma apagar";
$owl_lang->reallydelete_logs		= "Confirma limpar o arquivo de relat&oacute;rio";
$owl_lang->reallydelete_selected	= "Confirma apagar todos os arquivos seleccionados";
$owl_lang->reallyrestore_selected	= "Confirma restaurar todos os arquivos seleccionados";
$owl_lang->rest_selected		= "Restaurar seleccionado";
$owl_lang->score 			= "Pontua&ccedil;&atilde;o";
$owl_lang->size 			= "Tamanho";
$owl_lang->updated_by 			= "Actualizado por";
$owl_lang->title 			= "T&iacute;tulo";
$owl_lang->tot_files			= "Total:";
$owl_lang->tot_monitored		= "Monitorizado:";
$owl_lang->tot_my_checked_out		= "Sa&iacute;da Controlada:";
$owl_lang->tot_my_files			= "Meu:";
$owl_lang->tot_my_group			= "Grupo:";
$owl_lang->tot_new_files		= "Novo:";
$owl_lang->tot_updated_files		= "Actualizado:";
$owl_lang->updated_file			= "Actualizado!";
$owl_lang->user               		= "Utilizador";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "N&uacute;mero de dias decorridos :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favoritos";
$owl_lang->favorite_add = "Adic. Pasta Actual";
$owl_lang->favorite_delete = "Apagar";
$owl_lang->favorite_go = "Ir Para";
$owl_lang->files_in_my_group_title = "Arquivos nos Meu(s) Grupo(s)";
$owl_lang->my_files_title= "Os Meus Arquivos";
$owl_lang->my_monitored_title= "A(s) Minha(s) Pasta(s) Monitorizada(s)";
$owl_lang->my_special_access_title= "Lista de acesso especial";
$owl_lang->special_access_count_alt= "Pastas/Arquivos de acesso especial";
$owl_lang->special_access_count= "Acesso especial:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Adicionar / Visualizar coment&aacute;rios: ";
$owl_lang->addingfile 		= "Adicionar arquivo para ";
$owl_lang->addingfolder 	= "Adicionar pasta para ";
$owl_lang->attach_file		= "Anexar arquivo";
$owl_lang->change		= "Modificar";
$owl_lang->comments      	= "Coment&aacute;rio";
$owl_lang->comments_added       = "Coment&aacute;rio adicionado por: ";
$owl_lang->create		= "Criar";
$owl_lang->description 		= "Descri&ccedil;&atilde;o";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Can&ccedil;&atilde;o:<br />&Aacute;lbum:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Dura&ccedil;&atilde;o:<br />G&eacute;nero:<br />Coment&aacute;rio:";
$owl_lang->email_body		= "Mensagem";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Responder para";
$owl_lang->email_subject	= "Assunto";
$owl_lang->email_to		= "E-Mail para";
$owl_lang->emailing		= "A enviar e-mail";
$owl_lang->keywords 		= "Palavra-Chave";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "A modificar ";
$owl_lang->name               	= "Nome"; 
$owl_lang->none_selected        = "SEM SELEC&Ccedil;&Atilde;O";
$owl_lang->note_content         = "Conte&uacute;do da Anota&ccedil;&atilde;o";
$owl_lang->notify_link          = "Link externo do Owl";
$owl_lang->ownergroup         	= "Propriet&aacute;rio (Grupo)";
$owl_lang->ownership		= "Propriet&aacute;rio";
$owl_lang->permissions 		= "Permiss&otilde;es";
$owl_lang->pick_select		= "&#8211; Selecione um utilizador Owl &#8211;";
$owl_lang->policy 		= "Pol&iacute;tica";
$owl_lang->post_comment		= "Enviar Coment&aacute;rio";
$owl_lang->prop_permissions 	= "Propagar permiss&otilde;es para sub-pastas?";
$owl_lang->prop_perms_files 	= "Permiss&otilde;es para propagar para os arquivos";
$owl_lang->sendfile 		= "Enviar arquivo";
$owl_lang->sendthisfile 	= "Enviar este arquivo";
$owl_lang->sendthisurl       	= "Enviar este URL";
$owl_lang->updating		= "A actualizar";
$owl_lang->verdescription 	= "Descri&ccedil;&atilde;o <br />das actualiza&ccedil;&otilde;es";
$owl_lang->vermajor          	= "Vers&atilde;o";
$owl_lang->verminor          	= "Sub-vers&atilde;o";
$owl_lang->vertype           	= "Tipo de Revis&atilde;o";
$owl_lang->document_text        = "Content";
$owl_lang->save_keyword         = "Guardar palavra-chave?";
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

$owl_lang->email             	= "Endere&ccedil;o de E-mail";
$owl_lang->full_name		= "Nome completo";
$owl_lang->register		= "Cria&ccedil;&atilde;o de Utilizador";
$owl_lang->self_failed		= "Falhou";
$owl_lang->self_passwd		= "Palavra-passe enviada para :";
$owl_lang->self_reg_bod		= "A sua palavra-passe &eacute;:";
$owl_lang->self_reg_rset	= "A sua palavra-passe antiga foi reposta para:";
$owl_lang->self_reg_subj	= "A sua conta ";
$owl_lang->send_pass		= "Palavra-passe enviada";
$owl_lang->submit		= "Registar";
$owl_lang->thank_you_1		= "Muito Obrigado!";
$owl_lang->thank_you_2		= "A sua palavra-passe ser&aacute; enviada para o endere&ccedil;o de e-mail indicado";
$owl_lang->thank_you_3		= "A sua conta precisa de ser activada pelo administrador antes de se poder autenticar no sistema.";

//NEW STUFF

$owl_lang->captcha_typein        = "Digite 5 caracteres";
$owl_lang->change_pass_title	      = "TROQUE A PALAVRA-PASSE";
$owl_lang->err_cant_reuse_passwords   = "N&atilde;o pode reutilizar palavras-passe anteriores";
$owl_lang->err_new_confirm_different  = "A sua nova palavra-passe &eacute; diferente da sua confirma&ccedil;&atilde;o <br />";
$owl_lang->err_old_pass_ver_failed    = "A sua palavra-passe antiga est&aacute; incorrecta<br />";
$owl_lang->err_pass_restriction_1     = "A sua palavra-passe precisa de ter pelo menos  &ldquo;%s&rdquo; caracteres de tamanho <br />";
$owl_lang->err_pass_restriction_2     = "conter pelo menos &ldquo;%s&rdquo; n&uacute;meros [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "e pelo menos &ldquo;%s&rdquo; caracteres especiais [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Escolheu um nome de utilizador &ldquo;%s&rdquo; que tem %d caracteres de tamanho e precisa ser de pelo menos  %d caracteres de tamanho.";
$owl_lang->pass_change_email_1        = "A sua palavra-passe n&atilde;o foi reposta por que voc&ecirc; n&atilde;o est&aacute; a utilizar autentica&ccedil;&atilde;o Owl.";
$owl_lang->pass_change_email_2        = "A sua autentica&ccedil;&atilde;o &eacute; do tipo: ";
$owl_lang->pass_change_email_3        = "Contacte o Administrador do sistema para aux&iacute;lio";

// END NEW STUFF

//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Cancelar";
$owl_lang->copy_file		= "Copiar arquivo";
$owl_lang->copy_folder		= "Copiar pasta";
$owl_lang->moving		= "A Mover";
$owl_lang->moving_file		= "A Mover arquivo";
$owl_lang->moving_folder	= "A Mover pasta";
$owl_lang->select		= "Por favor seleccione a nova pasta:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "A visualizar registos de relat&oacute;rios para ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Dif. De";
$owl_lang->diff_to	= "Dif. Para";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->comment_notif= "Notifica&ccedil;&atilde;o de coment&aacute;rio";
$owl_lang->confpassword	= "Confirmar nova palavra-passe";
$owl_lang->email_tool	= "Ferramenta de E-Mail";
$owl_lang->group	= "Grupo Prim&aacute;rio";
$owl_lang->groupmember	= "Membro do(s) Grupo(s)";
$owl_lang->last_modified= "&Uacute;ltima modifica&ccedil;&atilde;o";
$owl_lang->newpassword	= "Nova palavra-passe";
$owl_lang->newsadmin	= "Admin. de Not&iacute;cias";
$owl_lang->not_member	= "N&atilde;o &eacute; membro de nenhum dos outros grupos";
$owl_lang->notification	= "Receber notifica&ccedil;&otilde;es";
$owl_lang->oldpassword	= "Palavra-passe antiga";
$owl_lang->preference	= "Prefer&ecirc;ncias";
$owl_lang->saved	= "&#8212; M O D I F.&nbsp;&nbsp;&nbsp;G U A R D A D A &#8212;";
$owl_lang->status_no	= "N&atilde;o";
$owl_lang->status_yes	= "Sim";
$owl_lang->userlang	= "Idioma";

//NEW STUFF
$owl_lang->useradmin	= "Utilizador Administrador";
$owl_lang->viewlogs     = "Pode ver registos dos relat&oacute;rios do sistema";
$owl_lang->viewreports  = "Pode ver relat&oacute;rios do sistema";
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

$owl_lang->elapsed_time       	= "tempo decorrido";
$owl_lang->query_empty       	= "argumento de pesquisa vazio";
$owl_lang->related_query_empty  = "N&atilde;o h&aacute; metadados associados com o documento para fazer  &ldquo;Pesquisa Relacionada&rdquo;";
$owl_lang->search             	= "Pesquisa";
$owl_lang->search_all_word	= "Todas as palavras";
$owl_lang->search_any_word	= "Qualquer palavra";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Pesquisar Pasta Actual";
$owl_lang->search_entire_phrase	= "Frase Inteira";
$owl_lang->search_for_files 	= "Pesquisar por arquivos";
$owl_lang->search_for_folders 	= "Pesquisar por pastas";
$owl_lang->search_match 	= "Igual a:";
$owl_lang->search_results_for	= "Pesquisar resultados para";
$owl_lang->search_score 	= "Pontua&ccedil;&atilde;o de arquivos";
$owl_lang->search_winthindocs   = "Pesquisar internamente";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "A Visualizar ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Exibir Painel de informa&ccedil;&otilde;es de arquivo largo";
$owl_lang->allow_track_favorite         = "Permitir aos utilizadores, monitorizar favoritos";
$owl_lang->admin_login_to_browse_page	= "Ap&oacute;s autentica&ccedil;&atilde;o, Admin vai para a p&aacute;gina de procura";
$owl_lang->alt_btn_backup		= "Executar C&oacute;pia de Segurnan&ccedil;a de Base de Dados SQL";
$owl_lang->alt_btn_doctype_admin	= "Admin. de tipo de documento";
$owl_lang->alt_btn_html_prefs		= "Editar HTML de prefer&ecirc;ncias do Site";
$owl_lang->alt_btn_news_admin		= "Administrador de not&iacute;cias";
$owl_lang->alt_btn_site_features	= "Editar Configura&ccedil;&otilde;es e funcionalidades do Site";
$owl_lang->alt_btn_statistics_viewer	= "Visualizador de estat&iacute;sticas";
$owl_lang->alt_btn_users_groups		= "Administrar<br /> Utilizadores e Grupos";
$owl_lang->btn_backup			= "C&oacute;pia de seguran&ccedil;a<br />da BD";
$owl_lang->btn_doctype_admin		= "Tipos de <br /> Documentos";
$owl_lang->btn_html_prefs		= "Prefer.<br /> de HTML";
$owl_lang->btn_news_admin		= "Admin.<br /> de Not&iacute;cias";
$owl_lang->btn_admin_maint_on           = "MAINTENANCE MODE";
$owl_lang->alt_btn_admin_maint_on       = "Blocks User sigon, so the administrator can perform a task without users on the system";
$owl_lang->btn_admin_maint_off          = "NORMAL MODE";
$owl_lang->alt_btn_admin_maint_off = "Turn Maintenace Mode Off (Permit Users to Login)";
$owl_lang->btn_site_features		= "Funcion.<br/> do Site";
$owl_lang->btn_statistics_viewer	= "Visualizador<br /> Estat&iacute;st./Relat&oacute;rios";
$owl_lang->btn_users_groups		= "Utilizadores <br />Grupos";
$owl_lang->display_password_override	= "Exibir sobreposi&ccedil;&atilde;o de palavra-passe arquivo/pasta";
$owl_lang->doc_id_num_digits		= "Doc# N&uacute;mero de d&iacute;gitos para exibir";
$owl_lang->doc_id_prefix		= "Doc# Prefixo de composi&ccedil;&atilde;o"; 
$owl_lang->docicon_column		= "Doc &Iacute;cone";
$owl_lang->download_folder_zip		= "Descarregar pastas em formato ZIP (por defeito &eacute; tar.gz)";
$owl_lang->save_keywords_to_db		= "Permite aos Utilizadores guardar Palavras-chave para reutiliza&ccedil;&atilde;o";
$owl_lang->status_column		= "Estado";
$owl_lang->vermajor_initial          	= "Vers&atilde;o Inicial";
$owl_lang->verminor_initial          	= "Sub-vers&atilde;o inicial";
$owl_lang->view_doc_in_new_window	= "Ver documentos em nova janela";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "*** Editar Utilizador *************";
$owl_lang->edit_group  			= "*** Editar Grupo ***************";
$owl_lang->enter_new_user               = "*** Adicionar Novo Utilizador *****";
$owl_lang->enter_new_group              = "*** Adicionar Novo Grupo *******";
$owl_lang->alt_btn_change_passwd        = "Troque a sua palavra-passe antiga";
$owl_lang->alt_btn_cln_history          = "Apagar Documentos que mais velhos que (em dias): ";
$owl_lang->alt_btn_log_viewer           = "Visualisador de relat&oacute;rios do Sistema Owl";
$owl_lang->alt_btn_report_viewer        = "Visualizador de relat&oacute;rios Owl";
$owl_lang->btn_change_passwd            = "Troque a palavra-passe";
$owl_lang->btn_cln_history              = "Apagar <br /> Base Hist.";
$owl_lang->btn_log_viewer               = "Registos<br />Relat&oacute;rio Sistema";
$owl_lang->btn_report_viewer            = "Relat&oacute;rios";
$owl_lang->confirm_cln_history          = "Deseja apagar documentos que s&atilde;o mais velhos que (em dias)?: ";
$owl_lang->historical_purge             = "Arquivos hist&oacute;ricos apagados.";

// END NEW STUFF
$owl_lang->add				= "Adicione";
$owl_lang->alt_btn_initial_load		= "Preencher BD a partir da Pasta (Documentos)";
$owl_lang->alt_btn_trashcan		= "Clique para ver o conte&uacute;do";
$owl_lang->anonymous_account		= "Conta de acesso an&oacute;nimo:";
$owl_lang->btn_initial_load		= "Carga <br />Inicial";
$owl_lang->btn_trashcan			= "Lixo";
$owl_lang->buttonstyle                  = "Bot&atilde;o de Estilo";
$owl_lang->confirm_initial_load		= "*** ATEN&Ccedil;&Atilde;O ***  Isto s&oacute; deve ser executado quando a BD estiver vazia";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Apagar Grupo";
$owl_lang->deleteuser			= "Apagar utilizador";
$owl_lang->disable_recs_per_page	= "Permitir vis&atilde;o restrita, inactiva registo por p&aacute;gina!";
$owl_lang->disableuser			= "Desactivar utilizador";
$owl_lang->file_admin_group		= "Procura Adm. Grupo de arquivos:";
$owl_lang->flushed           		= "Tabela de sess&atilde;o apagada, o utilizador pode agora fazer a autentica&ccedil;&atilde;o.";
$owl_lang->groups			= "Grupos";
$owl_lang->hide_bulk_buttons		= "Esconder bot&otilde;es de opera&ccedil;&otilde;es de Conjunto:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Caminho para imagem de fundo:";
$owl_lang->ht_bd_lnk_cl			= "Cor para liga&ccedil;&otilde;es:";
$owl_lang->ht_bd_txt_cl 		= "Cor para texto:";
$owl_lang->ht_bd_vlnk_cl 		= "Cor para liga&ccedil;&otilde;es visitadas:";
$owl_lang->ht_collapse_width 		= "Comprimento da vis&atilde;o Limitada:";
$owl_lang->ht_expand_width		= "Expandir comprimento da vis&atilde;o:";
$owl_lang->ht_tbl_border_sz 		= "Tamanho do limite da tabela:";
$owl_lang->ht_tbl_cell_bg_al 		= "Cor alternada de fundo da c&eacute;lula da tabela:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Cor de fundo da c&eacute;lula da tabela:";
$owl_lang->ht_tbl_hd_bg			= "Cor de fundo do Cabe&ccedil;alho:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Habilita acesso an&oacute;nimo";
$owl_lang->header_group_admin           = "Administra&ccedil;&atilde;o de Grupo";
$owl_lang->header_sitefeatures_settings = "Funcionalidades e Configura&ccedil;&otilde;es do S&iacute;tio";
$owl_lang->header_user_admin           	= "Administra&ccedil;&atilde;o de Utilizador";
$owl_lang->hide_folder_doc_count	= "Esconde contador de tipo de arquivo";
$owl_lang->hide_folder_size		= "Esconde tamanho do conte&uacute;do da pasta";
$owl_lang->hide_panel			= "Esconde";
$owl_lang->home_dir			= "Diret&oacute;rio Base do Utilizador:";
$owl_lang->initial_dir   		= "Diret&oacute;rio Inicial do Utilizador";
$owl_lang->maxsessions			= "N&uacute;mero m&aacute;ximo de Sess&otilde;es";
$owl_lang->noprefaccess			= "Desabilitar Prefer&ecirc;ncias";
$owl_lang->old_action_icons		= "Usar &Iacute;cones de vers&atilde;o menor que 0.80";
$owl_lang->owl_anon_download     	= "Apenas Descarregar";
$owl_lang->owl_anon_full		= "Acesso Total";
$owl_lang->owl_anon_ro			= "Apenas Leitura";
$owl_lang->owl_dbdump_path   		= "Caminho para utilit&aacute;rio DB Dump:";
$owl_lang->owl_def_file_group_owner	= "Propriet&aacute;rio pr&eacute;-definido de grupo de arquivo:";
$owl_lang->owl_def_file_meta		= "Arquivo Metadata pr&eacute;-definido:";
$owl_lang->owl_def_file_owner		= "Propr. pr&eacute;-definido de arquivos:";
$owl_lang->owl_def_file_perm 		= "Propr. pr&eacute;-definido da Pol&iacute;tica de cria&ccedil;&atilde;o de arquivos:";
$owl_lang->owl_def_file_security	= "Arquivo de seguran&ccedil;a pr&eacute;-definido:";
$owl_lang->owl_def_file_title		= "T&iacute;tulo pr&eacute;-definido para arquivo:";
$owl_lang->owl_def_fold_group_owner	= "Propriet&aacute;rio pr&eacute;-definido para grupo de pastas:";
$owl_lang->owl_def_fold_owner		= "Propriet&aacute;rio pr&eacute;-definido para pasta:";
$owl_lang->owl_def_fold_sec		= "Seguran&ccedil;a pr&eacute;-definida de pasta:";
$owl_lang->owl_def_folder_perm 		= "Pol&iacute;tica pr&eacute;-definida para Cria&ccedil;&atilde;o de pasta:";
$owl_lang->owl_default_tmpdir		= "Localiza&ccedil;&atilde;o do diret&oacute;rio Temp: ";
$owl_lang->owl_email_from		= "Do Endere&ccedil;o:";
$owl_lang->owl_email_fromname		= "Do Nome:";
$owl_lang->owl_email_replyto		= "Endere&ccedil;o para resposta:";
$owl_lang->owl_email_server		= "Servidor SMTP:";
$owl_lang->owl_email_smtp		= "Usar m&eacute;todo e-mail SMTP";
$owl_lang->owl_email_smtp_auth		= "Usar autentica&ccedil;&atilde;o SMTP";
$owl_lang->owl_email_smtp_auth_login	= "Utilizador para autentica&ccedil;&atilde;o SMTP:";
$owl_lang->owl_email_smtp_auth_passwd	= "Palavra-passe de autentica&ccedil;&atilde;o SMTP";
$owl_lang->owl_email_subject_pref	= "Prefixo assunto:";
$owl_lang->owl_fogotpass		= "Exibir liga&ccedil;&atilde;o para recupera&ccedil;&atilde;o de palavra-passe:";
$owl_lang->owl_group_user		= "Utilizadores que s&atilde;o membros deste grupo";
$owl_lang->owl_gzip_path     		= "Caminho para gzip:";
$owl_lang->owl_hidebackup		= "Esconder o Diret&oacute;rio de C&oacute;pias de Seguran&ccedil;a:";
$owl_lang->owl_log_file			= "Relat&oacute;rio de Atividades por arquivo:";
$owl_lang->owl_log_login_act		= "Relat&oacute;rio de Atividades de Autentica&ccedil;&atilde;o:";
$owl_lang->owl_log_rec_page		= "Relat&oacute;rios de Visualiza&ccedil;&atilde;o por P&aacute;gina:";
$owl_lang->owl_logging			= "Activar relat&oacute;rios:";
$owl_lang->owl_logo			= "Logotipo da p&aacute;gina de autentica&ccedil;&atilde;o ([Language]/graphics):";
$owl_lang->owl_lookAtHD			= "Desactivar Ver no HD:";
$owl_lang->owl_lookAtHDDel		= "Apagar arquivos da Base de Dados";
$owl_lang->owl_max_filesize		= "Tamanho m&aacute;ximo de arquivo para envio (em bytes)";
$owl_lang->owl_owl_expand		= "Vis&atilde;o Pr&eacute;-definida de Busca (expandida)";
$owl_lang->owl_owl_timeout		= "Tempo de Inatividade de Sess&atilde;o (em Segundos)";
$owl_lang->owl_pdftotext_path		= "Manter &Iacute;ndice de Busca para <br />PDF e arquivos texto.<br />&#8211; em branco desactivado:";
$owl_lang->owl_pod2html_path            = "Necessita de Perl 5.8.0 ou superior.<br />Caminho para pod2html:";
$owl_lang->owl_restrict_view		= "Permite funcionalidade Vis&atilde;o Restrita:";
$owl_lang->owl_self_reg			= "PERMITE AUTO REGISTAR-SE:";
$owl_lang->owl_self_reg_hd		= "PADR&Otilde;ES DE AUTO REGISTO DE UTILIZADOR";
$owl_lang->owl_tar_path     		= "Caminho para utilit&aacute;rio tar:";
$owl_lang->owl_title_browser		= "FUNCIONALIDADES AS BUSCAS Owl";
$owl_lang->owl_title_custom		= "MODIFICAR COLUNAS DAS BUSCAS";
$owl_lang->owl_title_custom_search      = "MODIFICAR RESULTADOS DAS BUSCAS";
$owl_lang->owl_title_defaults   	= "PADR&Otilde;ES";
$owl_lang->owl_title_email		= "Configura&ccedil;&otilde;es do Sistema Owl E-Mail";
$owl_lang->owl_title_HD			= "VER HD PARA NOVAS CONFIGURA&Ccedil;&Ocirc;ES DE ARQUIVOS";
$owl_lang->owl_title_logging  		= "CONFIGURA&Ccedil;&Otilde;ES";
$owl_lang->owl_title_other		= "OUTRAS CONFIGURA&Ccedil;&Otilde;ES";
$owl_lang->owl_title_tools   		= "Ferramentas C&Oacute;PIA DE SEGURAN&Ccedil;A DE BD / GZIP";
$owl_lang->owl_unzip_path     		= "Caminho do unzip:";
$owl_lang->owl_version_control		= "Permite Controlo de Vers&atilde;o:";
$owl_lang->owl_wordtotext_path          = "Arquivos MS-WORD <br />&#8211; em branco para desactivar:";
$owl_lang->owl_ppttotext_path          = "Arquivos MS-POWERPOINT<br />&#8211; em branco para desactivar:";
$owl_lang->quota			= "Quota 0=Inactivo";
$owl_lang->reallydeluser		= "Este utilizador &eacute; dono de %numfiles% arquivo(s) e %numfolders% pasta(s). Este(s) arquivo(s) ou pasta(s) ficar&atilde;o sem dono. Prosseguir com a remo&ccedil;&atilde;o?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->reallydeletegroup            = "Really Delete this Group?";
$owl_lang->recs_per_page		= "Exibir n registos por p&aacute;gina (0 = Inactivo):";
$owl_lang->recycle_enabled		= "Activar recolha de Lixo:";
$owl_lang->recycle_location		= "Localiza&ccedil;&atilde;o do lixo:";
$owl_lang->recycle_title		= "CONFIGURA&Ccedil;&Otilde;ES DE LIXO";
$owl_lang->remember_me			= "Mostrar o &iacute;cone de Lembrar-me";
$owl_lang->remember_me_checkbox		= "Lembrar-me";
$owl_lang->remember_me_title		= "CONFIGURA&Ccedil;&Otilde;ES DE AUTENTICA&Ccedil;&Atilde;O PERSISTENTES";
$owl_lang->remember_timeout		= "Tempo em dias para reter Cookie";
$owl_lang->restore_file_prefix		= "Constante de Prefixo nos arquivos recuperados";
$owl_lang->search_result_folders	= "Incluir Pasta no(s) Resultado(s) da pesquisa";
$owl_lang->show_action_title		= "Exibir Bot&otilde;es de opera&ccedil;&otilde;es de Conjunto:";
$owl_lang->show_bulk_title		= "Exibir Bot&otilde;es de Conjunto:";
$owl_lang->show_folder_title		= "Exibir Pasta de Ferramentas:";
$owl_lang->show_panel			= "Mostrar";
$owl_lang->show_panel_title		= "Exibir Painel de Situa&ccedil;&atilde;o:";
$owl_lang->show_pref_title		= "Exibir barra de Prefer&ecirc;ncias e SAIDA:";
$owl_lang->show_search_title		= "Exibir barra de pesquisar:";
$owl_lang->status_bar_both              = "Topo e rodap&eacute;";
$owl_lang->status_bar_bottom            = "Rodap&eacute; somente";
$owl_lang->status_bar_location          = "Exibir a barra de situa&ccedil;&atilde;o em/no:";
$owl_lang->status_bar_not               = "N&atilde;o exibir";
$owl_lang->status_bar_top               = "Somente topo";
$owl_lang->use_popup			= "Usar bal&otilde;es para exibir Not&iacute;cias:";
$owl_lang->users           		= "Utilizadores";
$owl_lang->virus_path			= "Caminho para programa anti-v&iacute;rus<br />Exemplo: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; vazio para desactivar fun&ccedil;&atilde;o:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Descri&ccedil;&atilde;o em Bal&otilde;es dentro de Campos Configurados";
$owl_lang->cust_headpopup     		= "CAMPOS ESPEC&Iacute;FICOS PARA DOCUMENTOS";
$owl_lang->auth_http                    = "Autentica&ccedil;&atilde;o HTTP (.htaccess)";
$owl_lang->auth_ldap                    = "Autentica&ccedil;&atilde;o LDAP";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group       = "Utilizadores que t&ecirc;m este como grupo prim&aacute;rio";
$owl_lang->create_user_homedir 		= "Criar Diret&oacute;rio base:";
$owl_lang->use_captcha 			= "Usar CAPTCHA:";
$owl_lang->created_here 		= "<br /> (Criado aqui se diret&oacute;rio base selecionado)";
$owl_lang->auth_owl                     = "Autentica&ccedil;&atilde;o Owl";
$owl_lang->auth_pop3                    = "Autentica&ccedil;&atilde;o POP3 ";
$owl_lang->file_desc_required           = "Descri&ccedil;&atilde;o de arquivo obrigat&oacute;ria";
$owl_lang->folder_desc_required         = "Descri&ccedil;&atilde;o de pasta obrigat&oacute;ria";
$owl_lang->html_title			= "Prefer. HTML ";
$owl_lang->pass_account_lockout         = "N&uacute;mero de tentativas para bloquear conta:";
$owl_lang->pass_change_every            = "For&ccedil;ar troca de palavra-passe a cada per&iacute;odo de dias 0=Inactivo:";
$owl_lang->pass_enable_account_lockout  = "permite bloquear conta:";
$owl_lang->pass_min_passwd_length       = "Tamanho m&iacute;nimo para palavras-passe:";
$owl_lang->pass_min_passwd_numeric      = "N&uacute;mero m&iacute;nimo de algarismos na palavra-passe:";
$owl_lang->pass_min_passwd_special      = "N&uacute;mero m&iacute;nimo de carac. espec. na palavra-passe:";
$owl_lang->pass_min_username_length     = "Tamanho m&iacute;nimo para nome de utilizadores:";
$owl_lang->pass_track_old_passwords     = "N&uacute;mero de palavras-passe anteriores para manter em hist&oacute;rico:";
$owl_lang->rtftotext_path               = "Caminho para ferramenta RTF para TXT";
$owl_lang->show_user_info               = "Exibir Nome de Utilizador como clic&aacute;vel";
$owl_lang->user_admin                   = "Utilizador administrador de grupo";
$owl_lang->user_auth_type               = "Tipo de autentica&ccedil;&atilde;o:";
$owl_lang->user_change_pass_next_login  = "Obrigar a trocar de palavra-passe no pr&oacute;ximo acesso:";
$owl_lang->user_expires                 = "A conta expira em:";
$owl_lang->user_gmt_offset              = "Posicionamento do Utilizador ref. GMT";
$owl_lang->user_group_admin             = "Admin arquivos para Grupo Prim&aacute;rio:";
$owl_lang->user_login_to_newrecords     = "Acesso inic. &agrave; p&aacute;gina novos registos:";
$owl_lang->users_group_admin		= "Utilizadores que est&atilde;o no grupo Admin";
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
$owl_lang->owl_log_hd_action	= "Ac&ccedil;&atilde;o";
$owl_lang->owl_log_hd_agent	= "Agente";
$owl_lang->owl_log_hd_dt_tm	= "Data / Hora";
$owl_lang->owl_log_hd_dtls	= "Detalhes";
$owl_lang->owl_log_hd_file	= "Arquivo";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Caminho da pasta";
$owl_lang->owl_log_hd_ip	= "IP / Endere&ccedil;o";
$owl_lang->owl_log_hd_user	= "Utilizador";
$owl_lang->owl_log_hide      	= "Esconder: ";
$owl_lang->owl_log_no_rec	= " n&atilde;o h&aacute; registos ";
$owl_lang->owl_log_viewer	= "Ver Registos";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Esvaziar o lixo";
$owl_lang->really_empty_trash	= "Confirma esvaziar o lixo?";
$owl_lang->recycle_bin_admin    = "Administra&ccedil;&atilde;o do lixo";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Os arquivos que requisitou est&atilde;o anexados.";
$owl_lang->trash_email_subject  = "Os arquivos requisitados foram restaurados.";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Sem altera&ccedil;&otilde;es.&#8211; Permiss&otilde;es de arquivos n&atilde;o modificadas.";
$owl_lang->everyoneread			= "Todos podem ler/descarregar";
$owl_lang->everyoneread_ad		= "Todos podem ler/descarregar";
$owl_lang->everyonewrite		= "Todos podem ler/gravar/descarregar";
$owl_lang->everyonewrite_ad		= "Todos podem ler/gravar/descarregar";
$owl_lang->everyonewrite_ad_nod		= "Todos podem ler/gravar/descarregar, n&atilde;o APAGAR";
$owl_lang->everyonewrite_nod		= "Todos podem ler/gravar/descarregar, n&atilde;o APAGAR";
$owl_lang->file_size_byte		= "B";
$owl_lang->file_size_gigabyte		= "GB";
$owl_lang->file_size_kilobyte		= "KB";
$owl_lang->file_size_megabyte		= "MB";
$owl_lang->geveryoneread		= "Todos podem ler esta pasta";
$owl_lang->geveryoneread_ad		= "Todos podem ler esta pasta";
$owl_lang->geveryonewrite		= "Todos podem enviar arquivos e apagar esta pasta";
$owl_lang->geveryonewrite_ad		= "Todos podem enviar arquivos e apagar esta pasta";
$owl_lang->geveryonewrite_ad_nod	= "Todos podem enviar arquivos para esta pasta";
$owl_lang->geveryonewrite_nod		= "Todos podem enviar arquivos para esta pasta";
$owl_lang->ggroupread			= "O seu grupo pode ler esta pasta";
$owl_lang->ggroupread_ad		= "O grupo seleccionado pode ler esta pasta";
$owl_lang->ggroupwrite			= "O seu grupo pode enviar arquivos e apagar esta pasta";
$owl_lang->ggroupwrite_ad    		= "O grupo seleccionado pode enviar arquivos e apagar esta pasta";
$owl_lang->ggroupwrite_ad_nod		= "O grupo seleccionado pode enviar arquivos para esta pasta";
$owl_lang->ggroupwrite_nod		= "O seu grupo pode enviar arquivos para esta pasta";
$owl_lang->ggroupwrite_worldread 	= "O seu grupo pode enviar arquivos e apagar esta pasta &amp; Os restantes podem ver os conte&uacute;dos";
$owl_lang->ggroupwrite_worldread_ad 	= "O grupo seleccionado pode enviar arquivos e apagar esta pasta &amp; Os restantes podem ver os conte&uacute;dos";
$owl_lang->ggroupwrite_worldread_ad_nod	= "O grupo seleccionado pode enviar arquivos para esta pasta &amp; Os restantes podem ver os conte&uacute;dos, N&Atilde;O PODEM APAGAR";
$owl_lang->ggroupwrite_worldread_nod 	= "O seu grupo pode enviar arquivos para esta pasta &amp; Os restantes podem ver os conte&uacute;dos, N&Atilde;O PODEM APAGAR";
$owl_lang->gonlyyou			= "Apenas voc&ecirc; pode enviar arquivos e apagar esta pasta";
$owl_lang->gonlyyou_ad			= "Apenas voc&ecirc; pode enviar arquivos e apagar esta pasta";
$owl_lang->groupread			= "O seu grupo pode ler/descarregar";
$owl_lang->groupread_ad			= "O grupo seleccionado pode ler/descarregar";
$owl_lang->groupwrite			= "O seu grupo pode ler/gravar/descarregar";
$owl_lang->groupwrite_ad		= "O grupo seleccionado pode ler/gravar/descarregar";
$owl_lang->groupwrite_ad_nod		= "O grupo seleccionado pode ler/gravar/descarregar, N&Atilde;O PODE APAGAR";
$owl_lang->groupwrite_nod		= "O seu grupo pode ler/gravar/descarregar, N&Atilde;O PODE APAGAR";
$owl_lang->groupwrite_worldread 	= "O seu grupo pode ler/gravar/descarregar &amp; Os restantes podem ler";
$owl_lang->groupwrite_worldread_ad 	= "O grupo seleccionado pode ler/gravar/descarregar &amp; Os restantes podem ler";
$owl_lang->groupwrite_worldread_ad_nod 	= "O grupo seleccionado pode ler/gravar/descarregar (N&Atilde;O PODE APAGAR) &amp; Os restantes podem ler";
$owl_lang->groupwrite_worldread_nod 	= "O seu grupo pode ler/gravar/descarregar (N&Atilde;O PODE APAGAR) &amp; Os restantes podem ler";
$owl_lang->invalidsess			= "Identifica&ccedil;&atilde;o de sess&atilde;o inv&aacute;lida. Por favor efectue a autentica&ccedil;&atilde;o a partir do endere&ccedil;o principal.<br />";
$owl_lang->notif_comment_1		= "Comentado em";
$owl_lang->notif_comment_2		= "Coment&aacute;rio:";
$owl_lang->notif_msg         		= "ESTA &Eacute; UMA MENSAGEM AUTOM&Aacute;TICA DO DMS<br /><br />Encontre o novo/actualizado arquivo anexado a este e-mail<br /><br />";
$owl_lang->notif_msg_alt         	= "ESTA &Eacute; UMA MENSAGEM AUTOM&Aacute;TICA DO DMS\n\nEncontre o novo/actualizado arquivo anexado a este e-mail\n\n";
$owl_lang->notif_msg_alt_link           = "ESTA &Eacute; UMA MENSAGEM AUTOM&Aacute;TICA DO DMS\n\nEncontre a liga&ccedil;&atilde;o para o novo/actualizado arquivo neste e-mail\n\n";
$owl_lang->notif_msg_link               = "ESTA &Eacute; UMA MENSAGEM AUTOM&Aacute;TICA DO DMS<br /><br />Encontre a liga&ccedil;&atilde;o para o novo/actualizado arquivo neste e-mail<br /><br />";
$owl_lang->notif_salutation		= "Estimado";
$owl_lang->notif_subject_comment	= "Foi adicionado um coment&aacute;rio de arquivo no reposit&oacute;rio Owl";
$owl_lang->notif_subject_monitor	= "Foi actualizado um arquivo ou pasta do reposit&oacute;rio Owl";
$owl_lang->notif_subject_new 		= "Novo arquivo no reposit&oacute;rio Owl";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "Foi actualizado um arquivo do reposit&oacute;rio Owl";
$owl_lang->notif_subject_file_deleted   = "ARQUIVO APAGADO DO REPOSIT&Oacute;RIO";
$owl_lang->notif_subj_new_account       = "Uma nova conta Owl foi criada para si";
$owl_lang->notif_user			= "Criado / Atualizado por:";
$owl_lang->onlyyou			= "Apenas voc&ecirc; pode ler/gravar/descarregar";
$owl_lang->onlyyou_ad			= "Apenas voc&ecirc; pode ler/gravar/descarregar";
$owl_lang->orphaned			= "&#8211; sem propriet&aacute;rio  &#8211;";
$owl_lang->owl_path			= "Caminho dos Arquivos: ";
$owl_lang->sessinuse			= "Esta sess&atilde;o est&aacute; activa noutro computador. Acesso Negado.<br />";
$owl_lang->sesstimeout			= "A sua sess&atilde;o expirou, por favor fa&ccedil;a uma nova autentica&ccedil;&atilde;o<br />";
$owl_lang->virus_infected 		= "ARQUIVO INFECTADO COM VIRUS";
$owl_lang->virus_return_val		= "O programa anti-virus devolveu o seguinte:";
$owl_lang->watermark_string		= "Confidencial";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Procurar nesta pasta";
$owl_lang->title_browse_site     	= "Procurar neste URL";
$owl_lang->title_download_view     	= "Descarregar / Visualizar este arquivo";
$owl_lang->title_edit_prefs     	= "Visualizar / Editar prefer. do Utilizador";
$owl_lang->title_return_folder     	= "Voltar para";
$owl_lang->title_sort     		= "Ordenar por";
$owl_lang->title_view_my     		= "Visualizar lista dos meus arquivos";
$owl_lang->title_view_new     		= "Visualizar lista dos meus arquivos novos desde a &uacute;ltima visita";
$owl_lang->title_view_updated     	= "Visualizar lista dos meus arquivos actualizados desde a &uacute;ltima visita";
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

$owl_lang->news_content			= "Conte&uacute;do";
$owl_lang->news_hd			= "Not&iacute;cias";
$owl_lang->news_hd_audience		= "Audi&ecirc;ncia Alvo";
$owl_lang->news_hd_created		= "Criado em";
$owl_lang->news_hd_expires		= "Expira em";
$owl_lang->news_heading			= "T&iacute;tulo";
$owl_lang->news_posted_date		= "Not&iacute;cia submetida em:";
$owl_lang->news_read			= "Leitura";
$owl_lang->news_title			= "Administra&ccedil;&atilde;o de not&iacute;cias";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: O direct&oacute;rio de documentos Owl: " .$default->owl_fs_root . "/" . fid_to_name(1) ." n&atilde;o existe.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: O direct&oacute;rio de documentos Owl: " .$default->owl_fs_root . "/" . fid_to_name(1) ." n&atilde;o tem permiss&otilde;es de escrita para o Servidor Web.";
$owl_lang->debug_file_not_exist		= "DEBUG: O arquivo obrigat&oacute;rio &ldquo;$default->owl_fs_root/%s &rdquo; n&atilde;o existe.<br /> OU<br />O caminho especificado por \$default->owl_fs_root em config/owl.php est&aacute; errado.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: O direct&oacute;rio tempor&aacute;rio do Owl: %s n&atilde;o existe.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: O direct&oacute;rio tempor&aacute;rio do Owl: %s n&atilde;o tem permiss&otilde;es de escrita para o Servidor Web.";
$owl_lang->debug_webserver_no_access	= "DEBUG: O Servidor Web n&atilde;o tem permiss&otilde;es de leitura para: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Por favor altere as permiss&otilde;es e tente novamente";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Estat&iacute;sticas / Visualizador de relat&oacute;rios";
$owl_lang->stats_files		= "N&uacute;mero de arquivos por utilizador";
$owl_lang->stats_folders	= "N&uacute;mero de pastas por utilizador";
$owl_lang->stats_information	= "Relat&oacute;rio do Owl e relat&oacute;rio de arquivo precisa de ser activado para que estas estat&iacute;sticas possam ser visualizadas.";
$owl_lang->stats_top		= "20 mais descarregados";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "A autentica&ccedil;&atilde;o do utilizador falhou. ";
$owl_lang->stats_users_loggedin = "Actualmente com Sess&atilde;o activa";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administra&ccedil;&atilde;o tipo de documento";
$owl_lang->doc_field_label	= "R&oacute;tulo do Campo (por idioma)";
$owl_lang->doc_field_name	= "Nome do Campo";
$owl_lang->doc_field_pos	= "Posi&ccedil;&atilde;o do Campo";
$owl_lang->doc_field_required	= "Obrigat&oacute;rio?";
$owl_lang->doc_field_searchable	= "Pesquis&aacute;vel?";
$owl_lang->doc_field_size	= "Tamanho do campo";
$owl_lang->doc_new_doc_type	= "&#8211; Adicionar novo tipo de Documento &#8211;";
$owl_lang->doc_specific		= "CAMPOS ESPEC&Iacute;FICOS DO DOCUMENTO:";
$owl_lang->document_type	= "Tipo de documento";
$owl_lang->document_type_name	= "Nome do tipo do documento";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Inserir descri&ccedil;&atilde;o no popup?";
$owl_lang->doc_field_disp_label = "R&Oacute;TULO DO CAMPO:";
$owl_lang->doc_field_disp_sep = "SEPARADOR DO R&Oacute;TULO";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;E&nbsp;X&nbsp;E&nbsp;M&nbsp;P&nbsp;L&nbsp;O&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Exibir em pesquisas:";
$owl_lang->doc_field_show_in_list = "Exibir campo na vis&atilde;o de pesquisas:";
$owl_lang->doc_field_type	= "Tipo de campo:";
$owl_lang->doc_field_values	= "Valores do campo separados com | :";
$owl_lang->doc_fields = "Campos criados";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->group_create         = "Grupo:";
$owl_lang->header_csv_import    = "Importar arquivo de utilizadores CSV";
$owl_lang->import_inserted      = "INTRODUZIDO";
$owl_lang->import_skipped       = "IGNORADO";
$owl_lang->invalid_groupid      = "Ident. do grupo inv&aacute;lida --> ";
$owl_lang->msg_user_exists      = "Utilizador j&aacute; existe";
$owl_lang->sendcsvfile          = "Carregar arquivo separado por v&iacute;rgulas (CSV)";
$owl_lang->user_created_skipped = "Utilizador:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Habilitar Config. Par de Revis&atilde;o:";
$owl_lang->owl_peer_review_opt  = "Tornar Par de Revis&atilde;o opcional:";
$owl_lang->owl_title_peer_review= "CONFIGURA&Ccedil;&Atilde;O DE PAR DE REVIS&Atilde;O DE DOCUMENTOS";
$owl_lang->owl_title_peer_review2= "Par de Revis&atilde;o de Documentos";
$owl_lang->peer_approval_title 	= "Documentos a aguardar a minha Aprova&ccedil;&atilde;o";
$owl_lang->peer_approved_body	= "O seu arquivo foi aprovado.:";
$owl_lang->peer_file_approved	= "Arquivo aprovado:";
$owl_lang->peer_file_final	= "Aprova&ccedil;&atilde;o final:";
$owl_lang->peer_file_rejected	= "Arquivo Rejeitado:";
$owl_lang->peer_file_to_review	= "Arquivo para revis&atilde;o:";
$owl_lang->peer_final_approval	= "[Aprova&ccedil;&atilde;o Final]: ";
$owl_lang->peer_final_body	= "O seu documento foi aprovado por todos os revisores indicados.<br />Por favor autentique-se e publique o documento<br />";
$owl_lang->peer_msg_to_reviewer	= "Mensagem para os Revisores";
$owl_lang->peer_my_approval	= "Aguarda a minha<br /> Aprova&ccedil;&atilde;o";
$owl_lang->peer_notif_user	= "Criado/Actualizado por";
$owl_lang->peer_pending_approval= "Minhas Aprova&ccedil;&otilde;es<br /> Pendentes";
$owl_lang->peer_pending_title 	= "Meus documentos em Aprova&ccedil;&atilde;o";
$owl_lang->peer_reject_reason   = "Motivo da rejei&ccedil;&atilde;o";
$owl_lang->peer_rejected_body	= "O seu arquivo foi rejeitado:";
$owl_lang->peer_review_body	= "A sua aprova&ccedil;&atilde;o foi pedida para os seguintes documentos:";
$owl_lang->peer_reviewer_list	= "Revisor(es)";
$owl_lang->peer_satus	 	= "Situa&ccedil;&atilde;o";
$owl_lang->peer_satus_approved  = "&#8212; A P R O V A D O  &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; P E N D E N T E  &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; R E J E I T A D O &#8212;";
$owl_lang->peer_subj_approved	= "O seu Documento foi APROVADO";
$owl_lang->peer_subj_rejected	= "O seu Documento foi REJEITADO";
$owl_lang->peer_subj_reminder	= "LEMBRETE: Voc&ecirc; tem um arquivo para rever";
$owl_lang->peer_subj_review	= "Voc&ecirc; tem um arquivo para rever";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "O seu documento foi aprovado por todos os revisores indicados.<br />O seu arquivo foi publicado.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Adic. ACL de arquivo:";
$owl_lang->acl_adding_folder           = "Adic. ACL de pasta:";
$owl_lang->acl_available_groups        = "Grupo(s) dispon&iacute;vel(is)";
$owl_lang->acl_available_users         = "Utilizador(es) dispon&iacute;vel(is)";
$owl_lang->acl_edit_file               = "Editar ACL de Arquivo:";
$owl_lang->acl_edit_folder             = "Editar ACL de Pasta:";
$owl_lang->acl_file_checkin            = "Entrada/Saida Controlada";
$owl_lang->acl_file_comment            = "Coment&aacute;rio";
$owl_lang->acl_file_copy               = "C&oacute;pia";
$owl_lang->acl_file_delete             = "Apagar";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_modify             = "Propriedades";
$owl_lang->acl_file_monitor            = "Monitorizar";
$owl_lang->acl_file_move               = "Mover";
$owl_lang->acl_file_read               = "Ler";
$owl_lang->acl_file_search             = "Pesquisar relacionado(s)";
$owl_lang->acl_file_set_acl            = "Configurar ACL";
$owl_lang->acl_file_update             = "Actualizar";
$owl_lang->acl_file_view_log           = "Ver Registo";
$owl_lang->acl_folder_copy             = "Copiar";
$owl_lang->acl_folder_delete           = "Apagar";
$owl_lang->acl_folder_modify           = "Modificar Propriedades";
$owl_lang->acl_folder_monitor          = "Monitorizar";
$owl_lang->acl_folder_move             = "Mover";
$owl_lang->acl_folder_read             = "Ler (Descarregar/Procurar)";
$owl_lang->acl_folder_set_acl          = "Estabelecer ACL";
$owl_lang->acl_folder_write            = "Criar";
$owl_lang->acl_heading_file            = "Grupo(s)/Utilizador(es)";
$owl_lang->acl_heading_files           = "ARQUIVOS &#8211; SELEC. UTILIZADOR(ES) e GRUPO(S)";
$owl_lang->acl_heading_folder          = "Grupo(s)/Utilizador(es)";
$owl_lang->acl_heading_folders         = "Pastas &#8211; SELEC. UTILIZADOR(ES)/GRUPO(S) DESEJADOS";
$owl_lang->acl_propagate_file          = "Estab. esta Pol&iacute;tica sobre \"TODOS\" Arquivos:";
$owl_lang->acl_propagate_folders       = "Propagar para todas Pastas:";
$owl_lang->acl_selected_groups         = "Seleccionar Grupo";
$owl_lang->acl_selected_users          = "Seleccionar Utilizadores";
$owl_lang->acl_set_acl                 = "Estab. Pol&iacute;tica Seguran&ccedil;a";
$owl_lang->acl_set_acl_now             = "Estab. Pol&iacute;tica Seguran&ccedil;a Agora:";
$owl_lang->acl_set_selected            = "Estab. Selec&ccedil;&atilde;o";
$owl_lang->alt_acl_save_file           = "Guardar Pol&iacute;tica Seguran&ccedil;a de Arquivo";
$owl_lang->alt_acl_save_folder         = "Guardar Pol&iacute;tica Seguran&ccedil;a da Pasta";
$owl_lang->btn_acl_save                = "Guardar";
$owl_lang->acl_set_file_permissions    = "Estabelecer Permiss&otilde;es de arquivo";
$owl_lang->acl_set_folder_permissions  = "Estabelecer Permiss&otilde;es na Pasta";
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
$owl_lang->alt_set_folder_acl	       = "Estabelecer Pol&iacute;tica de Seguran&ccedil;a nesta Pasta";

//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Relat&oacute;rios Dispon&iacute;veis:";
$owl_lang->report_file_folder               = "Arquivo/Pasta";
$owl_lang->report_filter                    = "Filtro:";
$owl_lang->report_filter_since              = "Desde:";
$owl_lang->report_full_access               = "ACESSO COMPLETO";
$owl_lang->report_select_report             = "&#8211; Seleccione um Relat&oacute;rio &#8211;";
$owl_lang->report_users_disabled_title      = "Utilizadores Desactivados";
$owl_lang->report_users_entitlement         = "Listar Acesso de Utilizadores";
$owl_lang->report_users_inactive_title      = "Utilizadores Inativos desde";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Activar Visualiza&ccedil;&atilde;o/Cria&ccedil;&atilde;o de Imagens Reduzidas:";
$owl_lang->thumb_gen_thumb_tool_path       = "Caminho da Ferramamenta ImageMagick:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Par&acirc;metros Mplayer :";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Caminho para Mplayer:";
$owl_lang->thumb_image_info                = "Informa&ccedil;&atilde;o para Imagem";
$owl_lang->thumb_large_width               = "Tamanho da Imagem Reduzida (grande) em pixel:";
$owl_lang->thumb_med_width                 = "Tamanho da Imagem Reduzida (m&eacute;dio) em pixel:";
$owl_lang->thumb_number_colums             = "N&uacute;m. de Colunas para Vis&atilde;o de Imagem Reduzida:";
$owl_lang->thumb_re_generate               = "Gerar Imagem Reduzida";
$owl_lang->thumb_small_width               = "Tamanho de Imagem Reduzida (pequeno) 0=N&atilde;o exibe pixel:";
$owl_lang->thumb_title                     = "IMAGEM REDUZIDA OP&Ccedil;&Otilde;ES DE VISUALIZA&Ccedil;&Atilde;O/CRIA&Ccedil;&Atilde;O";
$owl_lang->thumb_title_thumb_view          = "IMAGEM REDUZIDA VISUALIZA&Ccedil;&Atilde;O DETALHADA";
$owl_lang->thumb_image_size                = "Tamanho da Imagem:";
$owl_lang->alt_thumb_small                 = "Imagem Reduzida pequena";
$owl_lang->alt_no_thumb                    = "N&atilde;o h&aacute; Imagem Reduzida Dispon&iacute;vel";

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
$owl_lang->owl_email_fromname_extended      = "Extended Help";
$owl_lang->owl_email_replyto_extended       = "Extended Help";
$owl_lang->owl_email_server_extended            = "Extended Help";
$owl_lang->owl_use_smtp_extended                = "Extended Help";
$owl_lang->owl_use_smtp_auth_extended           = "Extended Help";
$owl_lang->owl_smtp_auth_login_extended         = "Extended Help";
$owl_lang->owl_smtp_passwd_extended             = "Extended Help";
$owl_lang->owl_email_subject_extended           = "Extended Help";
$owl_lang->owl_forgot_pass_extended             = "Extended Help";
$owl_lang->owl_self_reg_extended                = "Extended Help";
$owl_lang->owl_html2text_path_extended      = "Extended Help";
$owl_lang->owl_remember_me_extended             = "Extended Help";
$owl_lang->owl_status_bar_location_extended     = "Extended Help";
$owl_lang->owl_info_panel_wide_extended     = "Extended Help";
$owl_lang->owl_thumbnails_extended          = "Extended Help";
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
$owl_lang->alt_group_set_selected  = "Sets the selceted users";

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
$owl_lang->field_type_text = "Texto (uma linha)";
$owl_lang->field_type_picklist = "Campo de selec&ccedil;&atilde;o";
$owl_lang->field_type_textarea = "Texto (multi-linha)";
$owl_lang->field_type_checkbox = "Caixa de verifica&ccedil;&atilde;o";
$owl_lang->field_type_mcheckbox = "Caixa de verifica&ccedil;&atilde;o (m&uacute;ltipla)";
$owl_lang->field_type_radio = "Escolha exclusiva";
$owl_lang->field_type_separator = "Separador";
$owl_lang->field_type_table = "Tabela";
$owl_lang->field_type_URL = "URL";
$owl_lang->field_type_Date = "Data";
//********************************************************
// Field Types END
//********************************************************

//********************************************************
// Extensions Text BEGIN
//********************************************************
$owl_lang->tables_btn = "Tabelas do Utilizador";
$owl_lang->tables_header = "Gest&atilde;o de Tabelas do Utilizador";
$owl_lang->table = "Tabela";
$owl_lang->tuple = "Registo";
$owl_lang->tables_tupleView = "Ver Registos";
$owl_lang->tables_tupleAdd = "Adicionar Registo";
$owl_lang->tables_tableEdit = "Editar Tabela";
$owl_lang->tables_tableAdd = "Adicionar Tabela";
$owl_lang->tables_descr = "Descri&ccedil;&atilde;o";
$owl_lang->tables_descr2 = "Descri&ccedil;&atilde;o Detalhada";
$owl_lang->tables_tupleEdit = "Editar";
$owl_lang->tables_tupleDelete = "Apagar";
$owl_lang->tables_actions = "Ac&ccedil;&otilde;es";
$owl_lang->tables_tupleDeleted = "O registo foi apagado com sucesso!";
$owl_lang->tables_tupleAdded = "O registo foi adicionado com sucesso!";
$owl_lang->tables_tupleEdited = "O registo foi editado com sucesso!";
$owl_lang->tables_back = "Voltar";
$owl_lang->tables_quickAdd = "Adicionar";
$owl_lang->tables_refresh = "Actualizar";

$owl_lang->calendar_title = "Calend&aacute;rio";

$owl_lang->docRel_title = "CONFIGURAR RELA&Ccedil;&Otilde;ES ENTRE DOCUMENTOS";
$owl_lang->docRel_activateFunction = "Activar rela&ccedil;&otilde;es entre documentos";
$owl_lang->docRel_list = "Documentos relacionados";
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
