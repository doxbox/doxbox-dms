<?php

/*

  File: Portuguese-BR/language.inc

  Author: Gilberto dos Santos Alves
  Date: 2008/01/07

  Revision and completion: Denilson Rocha
  Date: 2008/12/10

  Revision for version owl1.0.0: Gilberto dos Santos Alves 
  Date: 2010/03/26 Sexta-Feira
  Translation new functions and screen buttons version
  Owl: auvix.com.br <gsavix@hotmail.com>  são paulo - sp - Brasil

  You should have received a copy of the GNU Public
  License along with this package; if not, write to the
  Free Software Foundation, Inc., 59 Temple Place - Suite 330,
  Boston, MA 02111-1307, USA.

*/


if (!defined('LABEL_TERMINATOR')) 
{
   define('LABEL_TERMINATOR',":&nbsp;");
}

//********************************************************
// Date Formatação Início
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

// Language Code Portuguese-BR (Português do Brasil)
// exemplo: "PT-BR"
$owl_lang->lang_code = "PT-BR";

//********************************************************
// Date Formating BEGIN
//********************************************************


//********************************************************
// Error Messages BEGIN
//********************************************************
$owl_lang->err_adding_comments		= "Você não tem Permissão para Adicionar Comentários a este Arquivo";
$owl_lang->err_backup_file   		= "Erro ao fazer Backup do arquivo existente";
$owl_lang->err_backup_folder_create 	= "Erro ao fazer Backup da Pasta";
$owl_lang->err_bad_url			= "Por Favor digite um URL válido";
$owl_lang->err_bad_version_1 		= "DMS requer no mínimo PHP Versão";
$owl_lang->err_bad_version_2 		= "Você está executando a Versão";
$owl_lang->err_bad_version_3 		= "Instale uma versão mais nova e tente novamente";
$owl_lang->err_comment_empty		= "Comentário não pode estar vazio.";
$owl_lang->err_email         		= "Mensagem não pode ser enviada";
$owl_lang->err_email_required		= "Campo E-Mail é requerido";
$owl_lang->err_fexist1			= "<b>Arquivo Existe:</b>";
$owl_lang->err_fexist2 			= "Já existe um arquivo com o nome <i>";
$owl_lang->err_fexist3 			= "</i> nessa pasta.";
$owl_lang->err_file_exists		= "O arquivo que você está fazendo upload já existe";
$owl_lang->err_file_lock     		= "Você não pode reter o arquivo, ele está retido por";
$owl_lang->err_file_not_exist		= "Arquivo não existe no Sistema de Arquivos";
$owl_lang->err_file_too_big		= "php.ini upload_max_filesize excede e/ou<br />  tamanho máximo de arquivo para Upload do Owl";
$owl_lang->err_file_update		= "Atualizar um arquivo requer que o nome permaneça o mesmo. Por favor use o mesmo nome de arquivo";
$owl_lang->err_fileexists    		= "Move foi Cancelado<br />Arquivo com o mesmo nome já existe.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_filemove_exist           = "O nome de arquivo para o qual você está renomeando já existe";
$owl_lang->err_folder_create 		= "Erro na Criação de Pasta";
$owl_lang->err_folder_exist		= "Essa Pasta já existe";
$owl_lang->err_folderexists  		= "Rename foi Cancelado<br />Pasta com o mesmo nome já existe.";
$owl_lang->err_general 			= "Um erro ocorreu";
$owl_lang->err_please_select_bulk	= "Por favor selecione pelo menos um Arquivo ou Pasta, usando o checkbox";
$owl_lang->err_select_reviewer		= "Por favor selecione pelo menos uma pessoa para Revisar o seu documento";
$owl_lang->err_update_file_lock    	= "Você não pode atualizar este arquivo, ele está retido por";
// NEW CHANGE NOVA ATUALIZACAO INÍCIO
$owl_lang->err_group_delete             = "Você não pode Apagar estre Grupo: <font color=\"red\">%d</font> Arquivo(s),  <font color=\"red\">%d</font> Pasta(s), <font color=\"red\">%d</font> Usuário(s) com este Grupo Primário, <font color=\"red\">%d</font> Usuário(s) é membro deste grupo";
// NEW CHANGE END
$owl_lang->err_cant_del_doc_type	= "Você não pode Apagar este Tipo de Documento, pois ainda existem documentos que o utilizam";
$owl_lang->err_database			= "Erro no Banco de Dados";
$owl_lang->err_doc_field_req            = "Campo requerido inexistente:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_doc_type_name_req	= "Nome de Tipo de Documento é requerido <br />";
$owl_lang->err_field_label_req 		= "Etiqueta do Campo é requerida <br />";
$owl_lang->err_field_name_req		= "Nome do Campo é Requerido <br />";
$owl_lang->err_field_size_req		= "Tamanho do Campo é Requerido <br />";
$owl_lang->err_file_indexing		= "Texto temporário &ldquo;TEXT&rdquo; Falha na Criação do Arquivo";
$owl_lang->err_field_minor_version      = "Campo Versão Secundária precisa ser número inteiro positivo";
$owl_lang->err_field_major_version      = "Campo Versão Principal precisa ser número inteiro positivo";
$owl_lang->err_file_title_too_long      = "Descrição do Arquivo não pode exceder 80 caracteres.";
$owl_lang->err_forbidden_file		= "Tipo de Arquivo Não Permitido";
$owl_lang->err_group_exists		= "Já existe um Grupo com este nome.";
$owl_lang->err_gzip_not_found  		= "Gzip não foi encontrado";
$owl_lang->err_login			= "Por favor faça Login para executar esta ação.";
$owl_lang->err_movecancel    		= "Move foi cancelado<br />";
$owl_lang->err_nameempty    		= "Nome de Pasta não pode estar vazio";
$owl_lang->err_news_required		= "ERRO: Cabeçalho e Conteúdo de News (Notícias) é requerido!";
$owl_lang->err_no_access 		= "Você não tem acesso a nenhum dos arquivos selecionados";
$owl_lang->err_no_access_info 		= "Causas possíveis: <br />1) Você não selecionou nenhum checkbox na frente do Arquivo ou Pasta<br />2) Bulk Delete, Bulk E-Mail, Bulk Checkout não aplicado à(s) Pasta(s)<br />3) Você não tem acesso a nenhum Arquivo ou Pasta que você selecionou.";
$owl_lang->err_noemail			= "Você não tem acesso para enviar Email deste arquivo.";
$owl_lang->err_nofileaccess		= "Você não tem acesso a este Arquivo";
$owl_lang->err_nofiledelete		= "Você não tem acesso para apagar este Arquivo";
$owl_lang->err_nofilemod		= "Você não tem acesso para modificar este Arquivo";
$owl_lang->err_nofolderaccess		= "Você não tem acesso a esta Pasta";
$owl_lang->err_nofolderdelete		= "Você não tem acesso para apagar esta Pasta";
$owl_lang->err_nofoldermod		= "Você não tem acesso para modificar esta Pasta";
$owl_lang->err_nosubfolder		= "Você não tem acesso para criar SubPastas aqui";
$owl_lang->err_not_zip			= "Não é um arquivo ZIP válido";
$owl_lang->err_note_title               = "O título é um campo requerido";
$owl_lang->err_note_title_exists        = "Uma Anotação com este nome já existe";
$owl_lang->err_noupload			= "Você não tem Acesso para upload dessa Pasta";
$owl_lang->err_pass_missmatch		= "Senha nova e senha de confirmação são divergentes";
$owl_lang->err_pass_wrong    		= "Senha antiga está errada";
$owl_lang->err_please_select_bulk       = "Por favor selecione pelo menos um Arquivo ou Pasta, usando o checkbox";
$owl_lang->err_pod2html_not_found       = "ERRO: A ferramenta pod2html não foi encontrada: ";
$owl_lang->err_quota			= "Você não tem espaço e quota suficiente para fazer upload desse arquivo: ";
$owl_lang->err_quota_avail		= " disponível.";
$owl_lang->err_quota_exceed  		= "Você excedeu sua quota";
$owl_lang->err_quota_needed		= " necessário ";
$owl_lang->err_req			= "ERRO: Todos os Campos são requeridos";
$owl_lang->err_root_delete		= "A Pasta Raiz (Root) não pode ser apagada";
$owl_lang->err_sess_notvalid 		= "ID. Sessão não é válido";
$owl_lang->err_sess_write		= "Erro ao gravar informação da sessão no banco de dados";
$owl_lang->err_specialfoldername 	= "&ldquo;backup&rdquo; é um Nome de Pasta reservada pelo Owl. Por favor escolha outro nome";
$owl_lang->err_sql			= "Erro SQL ";
$owl_lang->err_tar_not_found  		= "Ferramenta tar não foi encontrada em ";
$owl_lang->err_trash_can_empty 		= "A Lata de Lixo está Vazia";
$owl_lang->err_unauth_area   		= "Voce não está autorizado a usar esta área";
$owl_lang->err_unauthorized  		= "Não Autorizado";
$owl_lang->err_upload 			= "Erro de Upload";
$owl_lang->err_user_exists		= "Código Username já existe";
// NEW STUFF
$owl_lang->err_captcha_auth		= "Autenticação CAPTCHA falhou";
// NEW STUFF END

//********************************************************
// Error Messages END
//********************************************************

$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Adic. Campo";
$owl_lang->btn_add_file           = "Adic. Documento";
$owl_lang->btn_add_folder         = "Adic. Pasta";
$owl_lang->btn_add_news           = "Adic. Notícia";
$owl_lang->btn_add_note           = "Adic. Anotação";
$owl_lang->btn_add_url            = "Adic. Url";
$owl_lang->btn_add_zip            = "Adic. Arquivo";
$owl_lang->btn_admin              = "Admin";
$owl_lang->btn_admin_groups       = "Novo Grupo";
$owl_lang->btn_admin_news         = "Admin Notícias";
$owl_lang->btn_admin_user_group   = "Admin Usuário/Grupo ";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_admin_users        = "Novo Usuário";
$owl_lang->btn_back               = "Voltar";
$owl_lang->btn_browse             = "Procurar";
$owl_lang->btn_bulk_checkout      = "Bulk Retirado";
$owl_lang->btn_bulk_delete        = "Bulk Apagar";
$owl_lang->btn_bulk_download      = "Bulk Download";
$owl_lang->btn_bulk_email         = "Bulk E-Mail";
$owl_lang->btn_bulk_move          = "Bulk Mover";
$owl_lang->btn_cancel          	  = "Cancelar";
$owl_lang->btn_clickhere          = "Clique Aqui";
$owl_lang->btn_collapse_view      = "Visão Reduzida";
$owl_lang->btn_create             = "Criar";
$owl_lang->btn_default_view       = "Visão Padrão";
$owl_lang->btn_deldoctype         = "Apagar Tipo Doc";
$owl_lang->btn_download_bulk_package	= "para baixar sua seleção";
$owl_lang->btn_edit_group         = "Editar Grupo";
$owl_lang->btn_edit_user          = "Editar Usuário";
$owl_lang->btn_expand_view        = "Visão Exp.";
$owl_lang->btn_go_bottom          = "Ir Para Rodapé";
$owl_lang->btn_go_top             = "Ir Para Topo";
$owl_lang->btn_help               = "Ajuda";
$owl_lang->btn_import_users       = "Importar<br />Usuários";
$owl_lang->btn_login              = "Login";
$owl_lang->btn_logout             = "Logout";
$owl_lang->btn_mail_tool          = "E-Mail";
$owl_lang->btn_register           = "Registrar";
$owl_lang->btn_reset              = "Reset";
$owl_lang->btn_send_email         = "Enviar E-Mail";
$owl_lang->btn_submit             = "Submeter";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_thumb_view         = "Visão Thumbnail";
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

$owl_lang->alt_add_comments       = "Adicionar comentário a esse arquivo";
$owl_lang->alt_add_field	  = "Adicionar o campo acima";
$owl_lang->alt_add_group	  = "Criar este grupo";
$owl_lang->alt_add_news		  = "Adicionar novo item notícias";
$owl_lang->alt_add_user		  = "Criar este Usuário";
$owl_lang->alt_admin_flush        = "Limpar Sessões Interrompidas";
$owl_lang->alt_admin_groups	  = "Criar novo grupo";
$owl_lang->alt_admin_users	  = "Criar novo usuário";
$owl_lang->alt_approve_file 	  = "Aprovar esse documento";
$owl_lang->alt_back      	  = "Retornar Tela Anterior";
$owl_lang->alt_btn_add_file       = "Enviar novo arquivo";
$owl_lang->alt_btn_add_folder	  = "Criar nova pasta";
$owl_lang->alt_btn_add_note       = "Adicionar nova anotação";
$owl_lang->alt_btn_add_url	  = "Criar novo end. Web";
$owl_lang->alt_btn_add_zip     	  = "Enviar um arquivo Zip para ser extraído";
$owl_lang->alt_btn_admin 	  = "Administração Owl";
$owl_lang->alt_btn_browse	  = "Retornar para Pesquisa de Arquivos";
$owl_lang->alt_btn_bulk_checkout  = "Reter Arquivos (seleção)";
$owl_lang->alt_btn_bulk_delete 	  = "Apagar Arquivos (seleção)";
$owl_lang->alt_btn_bulk_download  = "Download de Arquivos (seleção)";
$owl_lang->alt_btn_bulk_email  	  = "E-Mail Arquivos (seleção)";
$owl_lang->alt_btn_bulk_move   	  = "Mover Arquivos e Pastas (seleção)";
$owl_lang->alt_btn_clickhere	  = "Clicar aqui";
$owl_lang->alt_btn_collapse_view  = "Chave para Visão Reduzida";
$owl_lang->alt_btn_default_view   = "Chave para Visão Padrão";
$owl_lang->alt_btn_expand_view    = "Chave para Visão Expandida";
$owl_lang->alt_btn_help		  = "Ajuda Owl Online";
$owl_lang->alt_btn_login	  = "Login no Repositório Owl";
$owl_lang->alt_btn_logout	  = "Logout do Repositório Owl";
$owl_lang->alt_btn_mail_tool   	  = "Ferramenta Simples de E-Mail";
$owl_lang->alt_btn_thumb_view     = "Chave para Visão Thumb Nail";
$owl_lang->alt_cancel		  = "Cancelar esta Ação";
$owl_lang->alt_cancel_move	  = "Cancelar Ação de Mover";
$owl_lang->alt_change		  = "Atualizar esse Registro";
$owl_lang->alt_comments 	  = "Existem Comentários para esse Arquivo";
$owl_lang->alt_copy_file     	  = "Copiar Arquivo";
$owl_lang->alt_copy_folder   	  = "Copiar Pasta";
$owl_lang->alt_del_all		  = "Esvaziar Lixo";
$owl_lang->alt_del_comments       = "Apagar esse Comentário";
$owl_lang->alt_edt_comments       = "Editar esse Comentário";
$owl_lang->alt_del_field	  = "Apagar esse Campo";
$owl_lang->alt_del_file      	  = "Apagar esse Arquivo (S/N)";
$owl_lang->alt_del_folder    	  = "Apagar essa Pasta (S/N)";
$owl_lang->alt_del_group	  = "Apagar esse Grupo";
$owl_lang->alt_del_news		  = "Apagar essa Notícia";
$owl_lang->alt_del_selected	  = "Apagar todos os Arquivos selecionados";
$owl_lang->alt_del_this_folder	  = "Apagar a Pasta &#8211; ";
$owl_lang->alt_del_user		  = "Apagar esse Usuário";
$owl_lang->alt_deldoctype	  = "Apagar o Tipo de Documento Corrente";
$owl_lang->alt_edit_field	  = "Editar essa Definição de Campo";
$owl_lang->alt_edit_group         = "Editar o Grupo selecionado";
$owl_lang->alt_edit_news	  = "Editar essa Notícia";
$owl_lang->alt_edit_user          = "Editar o Usuário selecionado";
$owl_lang->alt_email		  = "E-Mail esse Arquivo";
$owl_lang->alt_email_reminder 	  = "E-Mail Lembrete";
$owl_lang->alt_email_selected	  = "E-Mail todos Arquivos selecionados";
$owl_lang->alt_get_file      	  = "Baixar Arquivo";
$owl_lang->alt_get_folder      	  = "Baixar conteúdo da Pasta";
$owl_lang->alt_go_bottom      	  = "Ir para Rodapé da Página";
$owl_lang->alt_go_top 		  = "Ir para o Topo da Página";
$owl_lang->alt_have_news	  = "Você tem Item(ns) de Notícias para Ver";
$owl_lang->alt_have_no_news	  = "Nenhum Item(ns) de Notícias para Ver";
$owl_lang->alt_home_folder	  = "Votar para Diretório Inicial ";
$owl_lang->alt_link_file     	  = "Ligar este Arquivo a Outro Diretório";
$owl_lang->alt_lock_file          = "Reter Arquivo";
$owl_lang->alt_log_clear          = "Apagar todos os Logs (Y/N)";
$owl_lang->alt_log_file           = "Arquivo de Log";
$owl_lang->alt_log_next		  = "Exibe Registros Seguintes";
$owl_lang->alt_log_prev		  = "Exibe Registros Anteriores";
$owl_lang->alt_log_top		  = "Ir para o Primeiro Registro";
$owl_lang->alt_mod_file      	  = "Modificar Propriedades do Arquivo"; 
$owl_lang->alt_mod_folder    	  = "Modificar Propriedades da Pasta";
$owl_lang->alt_monitor		  = "Ativar Monitor. desse Arquivo";
$owl_lang->alt_monitor_folder     = "Ativar Monitor. dessa Pasta";
$owl_lang->alt_monitored	  = "Parar Monitor. desse Arquivo";
$owl_lang->alt_monitored_folder   = "Parar Monitor. dessa Pasta";
$owl_lang->alt_move_file     	  = "Mover Arquivo";
$owl_lang->alt_move_folder   	  = "Mover Pasta";
$owl_lang->alt_move_selected	  = "Mover todos Arquivos selecionados";
$owl_lang->alt_my_approval	  = "Documento(s) Aguardando minha Aprovação.";
$owl_lang->alt_new_doctype	  = "Criar Novo Tipo de Documento";
$owl_lang->alt_news_close	  = "Fechar Janela de Notícias";
$owl_lang->alt_news_next	  = "Exibir Próximo(s) Item(ns) de Notícias";
$owl_lang->alt_news_prev	  = "Exibir Item(ns) Anterior de Notícias";
$owl_lang->alt_news_print	  = "Imprimir esse Item de Notícias";
$owl_lang->alt_pending_approval	  = "Aprovação Docto(s) Pendente(s) com Outros";
$owl_lang->alt_play_file 	  = "Tocar (Play) Arquivo Media";
$owl_lang->alt_publish_file 	  = "Torne esse Documento Público";
$owl_lang->alt_recycle		  = "Lata Lixo<br />(Vazia)";
$owl_lang->alt_recycle_disable	  = "Lata Lixo<br />(Desabil.)";
$owl_lang->alt_recycle_not_found  = "Lata Lixo<br />(Não Encontrada)";
$owl_lang->alt_refresh_filter	  = "Iniciar Filtro/ Recompor Resultados";
$owl_lang->alt_register		  = "Submeter seu Cadastramento (Registro)";
$owl_lang->alt_reject_file 	  = "Rejeitar esse Documento";
$owl_lang->alt_related		  = "Achar Documentos Relacionados";
$owl_lang->alt_reset_form	  = "Restaurar Valores do Formulário";
$owl_lang->alt_rest_selected	  = "Restaurar todos Arquivos Selecionados";
$owl_lang->alt_search		  = "Iniciar a Pesquisa";
$owl_lang->alt_send_email	  = "Enviar E-Mail";
$owl_lang->alt_sendfile		  = "Enviar Arquivo";
$owl_lang->alt_set_initial_dir	  = "Apontar Diretório Atual como Inicial";
$owl_lang->alt_site_map           = "Mapa do Site";
$owl_lang->alt_submit      	  = "Submeter Formulário";
$owl_lang->alt_toggle_check_box	  = "Marcar Check Boxes";
$owl_lang->alt_tool_status_green  = "Ferramenta está ATIVA";
$owl_lang->alt_tool_status_red	  = "Path (caminho) incorreto e/ou não executável";
$owl_lang->alt_unlock_file        = "Liberar Arquivo";
$owl_lang->alt_upd_field	  = "Atualizar esse Campo";
$owl_lang->alt_upd_file      	  = "Atualizar esse Arquivo";
$owl_lang->alt_view_comments      = "Adic. / Ver Comentários do Arquivo";
$owl_lang->alt_view_file     	  = "Ver o Arquivo";
// NEW STUFF BEGIN
$owl_lang->alt_btn_trash_admin    = "Lata Lixo Administrativa";
$owl_lang->alt_edit_file_inline   = "Edite Arquivo Txt";
$owl_lang->alt_gen_pdf            = "Gerar Versão PDF do Arquivo Acima";
$owl_lang->alt_updated     	  = "Documento foi atualizado desde sua última visita";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new     	          = "Documento foi criado desde sua última visita";
// NEW STUFF END


//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		  = "Contéudo Integral foi apagado";
$owl_lang->log_detail		  = "Não há detalhes adicionais";
$owl_lang->log_file_to		  = "PARA: ";
$owl_lang->log_filter_all	  = "TODOS";
$owl_lang->log_login_det	  = "Nome Usuário: ";
// BEGIN NEW STUFF
$owl_lang->log_admin_changed_group= "Grupo Modificado: ";
$owl_lang->log_admin_changed_user = "Usuário Modificado: ";
$owl_lang->log_admin_created_group= "Grupo Criado: ";
$owl_lang->log_admin_created_user = "Usuário Criado: ";
$owl_lang->log_admin_del_group    = "Grupo Apagado: ";
$owl_lang->log_admin_del_user     = "Usuário Apagado: ";
$owl_lang->log_admin_disabled     = " Usuário Desabilitado: ";
$owl_lang->log_admin_email_restore= "Arquivos enviados via email:";
$owl_lang->log_admin_trash_delfile= "Arquivo Apagado: ";
$owl_lang->log_admin_trash_delfold= "Pasta Apagada: ";
$owl_lang->log_admin_trash_empty  = "Lata lixo esvaziada";
$owl_lang->log_admin_trash_restore= "Restaurada: ";
$owl_lang->log_login_expired      = "Usuário Expirado: ";
$owl_lang->log_login_too_many_attempts = "Desabilitado (Muitas tentativas de login): ";
$owl_lang->log_readhd_feature_add = "Config. Leitura HD adicionada a esse arquivo";
$owl_lang->log_admin_to  = "para";
$owl_lang->log_admin_of  = "de";
// END NEW STUFF
$log_file_actions[1]        	= "LOGIN";
$log_file_actions[10]        	= "ARQUIVO LIBERADO";
$log_file_actions[11]        	= "ARQUIVO ENV. VIA EMAIL";
$log_file_actions[12]        	= "ARQUIVO MOVIDO";
$log_file_actions[13]        	= "PASTA CRIADA";
$log_file_actions[14]        	= "PASTA APAGADA";
$log_file_actions[15]        	= "ARQUIVO MODIFICADO";
$log_file_actions[16]        	= "PASTA MOVIDA";
$log_file_actions[17]        	= "ESQUECEU SENHA";
$log_file_actions[18]        	= "REGIST. USUÁRIO";
$log_file_actions[19]           = "ARQUIVO EXIBIDO";
$log_file_actions[2]        	= "LOGIN FALHOU";
$log_file_actions[20]           = "ARQUIVO VIRUS";
$log_file_actions[21]           = "ARQUIVO COPIADO";
$log_file_actions[22]           = "PASTA COPIADA";
$log_file_actions[23]           = "ARQUIVO LIGADO";
$log_file_actions[3]        	= "LOGOUT";
$log_file_actions[4]        	= "ARQUIVO APAGADO";
$log_file_actions[5]        	= "ARQUIVO ENVIADO";
$log_file_actions[6]        	= "ARQUIVO ATUALIZADO";
$log_file_actions[7]        	= "ARQUIVO BAIXADO";
$log_file_actions[8]        	= "ARQUIVO MODIFICADO";
$log_file_actions[9]        	= "ARQUIVO RETEU";
// BEGIN NEW STUFF
$log_file_actions[24]           = "USUÁRIO ADMIN";
$log_file_actions[25]           = "LATA LIXO";
$log_file_actions[26]           = "ARQUIVO ACL";
$log_file_actions[27]           = "PASTA ACL";
$log_file_actions[28]           = "PASTA DISTRIBUÍDO";
$log_file_actions[29]           = "PASTA LIGADO";
$log_file_actions[30]           = "ARQUIVO REVISADO";
$log_file_actions[31]           = "ARQUIVO APROVADO";
$log_file_actions[32]           = "ARQUIVO-REJEITADO";
$log_file_actions[33]           = "ARQUIVO PUBLICADO";
// END NEW STUFF


//********************************************************
// Owl Logging messages END
//********************************************************


//********************************************************
// index.php  BEGIN
//********************************************************

// BEGIN NEW STUFF
$owl_lang->admin_login_date  = "O usuário admin está logado em: ";
$owl_lang->admin_login_from  = "O usuário admin está logado a partir de";
$owl_lang->admin_login_subject  = "Usuário ADMIN LOG IN";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Acesso Anônimo)";
$owl_lang->engine 		= "Owl Motor Intranet";
$owl_lang->forgot_pass		= "Esqueceu sua senha?";
$owl_lang->like_register	= "Gostaria de se Registrar?";
$owl_lang->login		= "Login";
$owl_lang->logindisabled	= "Conta foi desabilitada, contate o administrador do sistema.";
$owl_lang->loginfail		= "Falha de Conexão";
$owl_lang->password		= "Senha...";
$owl_lang->repository_list      = "Repositório";
$owl_lang->successlogout 	= "Você fez a desconexão com sucesso.";
$owl_lang->toomanysessions	= "Número máximo de sessões ativas, contate o administrador do sistema";
$owl_lang->username		= "Usuário.";
$owl_lang->forgot_username	= "Nome do Usuário ou Endereço de Email";
$owl_lang->version 		= "Versão";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->actions 			= "Ações";
$owl_lang->current_db         		= "Repositório Corrente:";
$owl_lang->current_folder 		= "Pasta Corrente:";
$owl_lang->del_all			= "Esvaziar Lata de Lixo";
$owl_lang->del_selected			= "Apagar Selecionado";
$owl_lang->disk_quota			= "Quota em disco";
$owl_lang->doc_number 			= "Doc. Núm.";
$owl_lang->email_selected		= "E-Mail Selecionado";
$owl_lang->file 			= "Arquivo";
$owl_lang->folder_count_file		= "Arquivo(s)";
$owl_lang->folder_count_folder		= "Pasta(s)";
$owl_lang->folder_count_note		= "Anotação(ões)";
$owl_lang->folder_count_pre		= "Essa Pasta Contém";
$owl_lang->folder_count_url		= "URL(s)";
$owl_lang->folder_policy 		= "Política Pasta Corrente:";
$owl_lang->held                      	= "Retido"; 
$owl_lang->last_logged			= "<br />Último acesso em: ";
$owl_lang->menu_file_action		= "Ações de Arquivo disponíveis";
$owl_lang->menu_folder_action		= "Ações de Pasta disponíveis";
$owl_lang->menu_url_action		= "Ações de Url disponíveis";
$owl_lang->modified 			= "Modificado";
$owl_lang->move_selected		= "Mover Selecionado";
$owl_lang->new_file			= "Novo!";
$owl_lang->no_description		= "Não há descrição disponível";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Página:";
$owl_lang->panel_file_info		= "Informação do arquivo";
$owl_lang->postedby 			= "Postado por";
$owl_lang->reallydelete			= "Confirma apagar";
$owl_lang->reallydelete_logs		= "Confirma limpar o arquivo de log";
$owl_lang->reallydelete_selected	= "Confirma apagar todos arquivos selecionados";
$owl_lang->reallyrestore_selected	= "Confirma restore todos arquivos selecionados";
$owl_lang->rest_selected		= "Restaurar selecionado";
$owl_lang->score 			= "Placar";
$owl_lang->size 			= "Tamanho";
$owl_lang->updated_by 			= "Atualizado por";
$owl_lang->title 			= "Título";
$owl_lang->tot_files			= "Total:";
$owl_lang->tot_monitored		= "Monitorado:";
$owl_lang->tot_my_checked_out		= "Saída Controlada:";
$owl_lang->tot_my_files			= "Meu:";
$owl_lang->tot_my_group			= "Grupo:";
$owl_lang->tot_new_files		= "Novo:";
$owl_lang->tot_updated_files		= "Atualizado:";
$owl_lang->updated_file			= "Atualizado!";
$owl_lang->user               		= "Usuário";
$owl_lang->ver                       	= "Versão"; 
$owl_lang->past_number                  = "Número de dias decorridos :";
// NEW STUFF
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Favoritos";
$owl_lang->favorite_add = "Adic. Pasta Corrente";
$owl_lang->favorite_delete = "Apagar";
$owl_lang->favorite_go = "Ir Para";
$owl_lang->files_in_my_group_title = "Arquivos em Meu(s) Grupo(s)";
$owl_lang->my_files_title= "Meus Arquivos";
$owl_lang->my_monitored_title= "Minha(s) Pasta(s) Monitorado(as)";
$owl_lang->my_special_access_title= "Lista acesso especial";
$owl_lang->special_access_count_alt= "Pastas/Arquivos acesso especial";
$owl_lang->special_access_count= "Acesso especial:";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->adding_comments      = "Adicionando / Visualizando comentários: ";
$owl_lang->addingfile 		= "Adicionando arquivo para ";
$owl_lang->addingfolder 	= "Adicionando pasta para ";
$owl_lang->attach_file		= "Anexando arquivo";
$owl_lang->change		= "Modificar";
$owl_lang->comments      	= "Comentário";
$owl_lang->comments_added       = "Comentário adicionado por: ";
$owl_lang->create		= "Criar";
$owl_lang->description 		= "Descrição";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Canção:<br />Album:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Duração:<br />Genero:<br />Comentário:";
$owl_lang->email_body		= "Mensagem";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Responda para";
$owl_lang->email_subject	= "Assunto";
$owl_lang->email_to		= "E-Mail para";
$owl_lang->emailing		= "enviando email";
$owl_lang->keywords 		= "Palavra-Chave";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Modificando ";
$owl_lang->name               	= "Nome"; 
$owl_lang->none_selected        = "SEM SELEÇÃO";
$owl_lang->note_content         = "Conteúdo da Anotação";
$owl_lang->notify_link          = "Link externo do Owl";
$owl_lang->ownergroup         	= "Proprietário (Grupo)";
$owl_lang->ownership		= "Proprietário";
$owl_lang->permissions 		= "Permissões";
$owl_lang->pick_select		= "&#8211; Selecione um usuário Owl &#8211;";
$owl_lang->policy 		= "Política";
$owl_lang->post_comment		= "Postar Comentário";
$owl_lang->prop_permissions 	= "Propagar permissões para sub-pastas?";
$owl_lang->prop_perms_files 	= "Permissões para propagar para os arquivos";
$owl_lang->sendfile 		= "Enviar arquivo";
$owl_lang->sendthisfile 	= "Enviar esse arquivo";
$owl_lang->sendthisurl       	= "Enviar essa URL";
$owl_lang->updating		= "Atualizando";
$owl_lang->verdescription 	= "Descrição <br />das atualizações";
$owl_lang->vermajor          	= "Revisão Maior";
$owl_lang->verminor          	= "Revisão Menor";
$owl_lang->vertype           	= "Tipo de Revisão";
$owl_lang->save_keyword         = "Salvar palavra-chave?";


//********************************************************
// modify.php  END
//********************************************************


//********************************************************
// register.php  BEGIN
//********************************************************

$owl_lang->email             	= "Endereço de E-Mail";
$owl_lang->full_name		= "Nome completo";
$owl_lang->register		= "Criação de Usuário";
$owl_lang->self_failed		= "Falhou";
$owl_lang->self_passwd		= "Senha enviada para :";
$owl_lang->self_reg_bod		= "Sua senha Owl é:";
$owl_lang->self_reg_rset	= "Sua antiga senha Owl foi inicializada para:";
$owl_lang->self_reg_subj	= "Sua conta OWL ";
$owl_lang->send_pass		= "Senha enviada";
$owl_lang->submit		= "Registrar";
$owl_lang->thank_you_1		= "Muito Obrigado!";
$owl_lang->thank_you_2		= "Sua senha será enviada para o endereço de email informado";
$owl_lang->thank_you_3		= "Sua conta precisa ser ativada pelo administrador antes de você efetuar Login.";

//NEW STUFF

$owl_lang->captcha_typein        = "Digite 5 caracteres";
$owl_lang->change_pass_title	      = "TROQUE A SENHA";
$owl_lang->err_cant_reuse_passwords   = "Você não pode reutilizar senhas anteriores";
$owl_lang->err_new_confirm_different  = "Sua nova senha e a senha de confirmação estão divergentes <br />";
$owl_lang->err_old_pass_ver_failed    = "Sua antiga senha está incorreta<br />";
$owl_lang->err_pass_restriction_1     = "Sua senha precisa ter pelo menos  &ldquo;%s&rdquo; caracteres de tamanho <br />";
$owl_lang->err_pass_restriction_2     = "conter pelo menos &ldquo;%s&rdquo; números [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "e pelo menos &ldquo;%s&rdquo; special character [ ~!@#$%%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ]<br />";
$owl_lang->err_username_not_long_enough = "Você escolheu um nome de usuário &ldquo;%s&rdquo; que tem %d caracteres de tamanho e precisa ser de pelo menos  %d caracteres de tamanho.";
$owl_lang->pass_change_email_1        = "Sua senha não foi inicializada por que você não está usando autenticação OWL.";
$owl_lang->pass_change_email_2        = "Sua autenticação é do tipo: ";
$owl_lang->pass_change_email_3        = "Contate o Administrador do sistema para Auxílio";

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
$owl_lang->moving		= "Movendo";
$owl_lang->moving_file		= "Movendo arquivo";
$owl_lang->moving_folder	= "Movendo pasta";
$owl_lang->select		= "Por favor selecione a nova pasta:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "Visualizando registros (log) para ";
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

$owl_lang->comment_notif= "Notificação comentário";
$owl_lang->confpassword	= "Confirmar Nova Senha";
$owl_lang->email_tool	= "Ferramenta de E-Mail";
$owl_lang->group	= "Grupo Primário";
$owl_lang->groupmember	= "Membro do(s) Grupo(s)";
$owl_lang->last_modified= "Última modificação";
$owl_lang->newpassword	= "Nova senha";
$owl_lang->newsadmin	= "Admin. de Notícias";
$owl_lang->not_member	= "Você não é membro de nenhum dos outros grupos";
$owl_lang->notification	= "Receber notificações";
$owl_lang->oldpassword	= "Senha antiga";
$owl_lang->preference	= "Preferências";
$owl_lang->saved	= "&#8212; M O D I F.&nbsp;&nbsp;&nbsp;S A L V A &#8212;";
$owl_lang->status_no	= "Não";
$owl_lang->status_yes	= "Sim";
$owl_lang->userlang	= "Linguagem";

//NEW STUFF
$owl_lang->useradmin	= "Usuário Administrador";
$owl_lang->viewlogs     = "Pode ver registros (log) do sistema";
$owl_lang->viewreports  = "Pode ver relatórios do sistema";
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
$owl_lang->related_query_empty  = "Não há metadados associados com o documento para fazer  &ldquo;Pesquisa Relacionada&rdquo;";
$owl_lang->search             	= "Pesquisa";
$owl_lang->search_all_word	= "Todas palavras";
$owl_lang->search_any_word	= "Qualquer palavra";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_currentfolder = "Pesquisar Pasta Corrente";
$owl_lang->search_entire_phrase	= "Frase Inteira";
$owl_lang->search_for_files 	= "Pesquisar por arquivos";
$owl_lang->search_for_folders 	= "Pesquisar por pastas";
$owl_lang->search_match 	= "Casar:";
$owl_lang->search_results_for	= "Pesquisar resultados para";
$owl_lang->search_score 	= "Pontuação de arquivos";
$owl_lang->search_winthindocs   = "Pesquisar internamente";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "Visualizando ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->info_panel_width	        = "Exibir Painel de informações arquivo largo";
$owl_lang->allow_track_favorite         = "Permitir usuários rastrear favoritos";
$owl_lang->admin_login_to_browse_page	= "No logon Admin vai para página procura";
$owl_lang->alt_btn_backup		= "Executar Backup SQL Database";
$owl_lang->alt_btn_doctype_admin	= "Admin. de tipo de documento";
$owl_lang->alt_btn_html_prefs		= "Editar HTML de preferências do Site";
$owl_lang->alt_btn_log_viewer		= "Visualizador Owl de registros (log) do sistema";
$owl_lang->alt_btn_news_admin		= "Administrador Owl de notícias";
$owl_lang->alt_btn_site_features	= "Editar Configurações e funcionalidades do Site";
$owl_lang->alt_btn_statistics_viewer	= "Visualizador Owl de estatísticas";
$owl_lang->alt_btn_users_groups		= "Administrar Usuários e Grupos";
$owl_lang->btn_backup			= "Backup<br />DB";
$owl_lang->btn_doctype_admin		= "Tipos de <br /> Doctos";
$owl_lang->btn_html_prefs		= "Prefer.<br /> de HTML";
$owl_lang->btn_log_viewer		= "Visualizador registros (log)<br />";
$owl_lang->btn_news_admin		= "Admin.<br /> de Notícias";
$owl_lang->btn_site_features		= "Funcion.<br/> do Site";
$owl_lang->btn_statistics_viewer	= "Visualizador<br /> Estatíst./Relatórios";
$owl_lang->btn_users_groups		= "Usuários <br />Grupos";
$owl_lang->display_password_override	= "Exibir sobreposição senha arquivo/pasta";
$owl_lang->doc_id_num_digits		= "Doc# Numeros de digitos para exibir";
$owl_lang->doc_id_prefix		= "Doc# Prefixo de composição"; 
$owl_lang->docicon_column		= "Doc Ícone";
$owl_lang->download_folder_zip		= "Baixar pastas formato ZIP (Padrão é tar.gz)";
$owl_lang->save_keywords_to_db		= "Permite Usuários salvar Chaves para reuso";
$owl_lang->status_column		= "Situação";
$owl_lang->vermajor_initial          	= "Revisão inicial maior";
$owl_lang->verminor_initial          	= "Revisão Inicial menor";
$owl_lang->view_doc_in_new_window	= "Ver documentos em nova janela";
// BEGIN NEW STUFF
$owl_lang->edit_user                    = "*** Editar Usuário *************";
$owl_lang->edit_group  			= "*** Editar Grupo ***************";
$owl_lang->enter_new_user               = "*** Adicionar Novo Usuário *****";
$owl_lang->enter_new_group              = "*** Adicionar Novo Grupo *******";
$owl_lang->alt_btn_change_passwd        = "Troque sua senha antiga";
$owl_lang->alt_btn_cln_history          = "Descarte Documentos que são mais velhos que (em dias): ";
$owl_lang->alt_btn_log_viewer           = "Visualisador de log do Sistema Owl";
$owl_lang->alt_btn_report_viewer        = "Visualizador de relatórios Owl";
$owl_lang->btn_change_passwd            = "Troque a senha";
$owl_lang->btn_cln_history              = "Descartar <br /> Base Hist.";
$owl_lang->btn_log_viewer               = "Registros<br />Log Sistema";
$owl_lang->btn_report_viewer            = "Relatórios";
$owl_lang->confirm_cln_history          = "Você deseja Descartar documentos que são mais velhos que (em dias)?: ";
$owl_lang->historical_purge             = "Arquivos históricos apagados.";

// END NEW STUFF
$owl_lang->add				= "Adicione";
$owl_lang->alt_btn_initial_load		= "Carga do BD a partir da Pasta (Documentos)";
$owl_lang->alt_btn_trashcan		= "Clique para ver o conteúdo";
$owl_lang->anonymous_account		= "Conta de acesso anônimo:";
$owl_lang->btn_initial_load		= "Carga <br />Inicial";
$owl_lang->btn_trashcan			= "Lata de lixo";
$owl_lang->buttonstyle                  = "Botão de Estilo";
$owl_lang->confirm_initial_load		= "*** ATENÇÃO ***  Isto só deve ser executado quando o DB estiver vazio";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->deletegroup			= "Apagar Grupo";
$owl_lang->deleteuser			= "Apagar usuário";
$owl_lang->disable_recs_per_page	= "Permitir visão restrita, desabilita registro por página!";
$owl_lang->disableuser			= "Desabilita usuário";
$owl_lang->file_admin_group		= "Procura Adm. Grupo de arquivos:";
$owl_lang->flushed           		= "Tabela de sessão liberada, usuário pode agora acessar novamente.";
$owl_lang->groups			= "Grupos";
$owl_lang->hide_bulk_buttons		= "Esconder botões de seleção:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_bd_bg_image		= "Caminho (path) da imagem de fundo:";
$owl_lang->ht_bd_lnk_cl			= "Cor da Ligação Corpo:";
$owl_lang->ht_bd_txt_cl 		= "Cor do Corpo do Texto:";
$owl_lang->ht_bd_vlnk_cl 		= "Cor dos Links Visitados:";
$owl_lang->ht_collapse_width 		= "Comprimento da visão Limitada:";
$owl_lang->ht_expand_width		= "Expandir comprimento da visão:";
$owl_lang->ht_tbl_border_sz 		= "Tamanho da Borda da tabela:";
$owl_lang->ht_tbl_cell_bg_al 		= "Cor alternada do fundo da célula tabela:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Cor de fundo da célula tabela:";
$owl_lang->ht_tbl_hd_bg			= "Cabeçalho de fundo:";
// Edit Prefs Properties Messages END
$owl_lang->anonymous_access		= "Habilita acesso anônimo";
$owl_lang->header_group_admin           = "Administração de Grupo";
$owl_lang->header_sitefeatures_settings = "Funcionalidades e Configurações do Site";
$owl_lang->header_user_admin           	= "Administração de Usuário";
$owl_lang->hide_folder_doc_count	= "Esconde contador de tipo de arquivo";
$owl_lang->hide_folder_size		= "Esconde tamanho do conteúdo da pasta";
$owl_lang->hide_panel			= "Esconde";
$owl_lang->home_dir			= "Diretório Base do Usuário:";
$owl_lang->initial_dir   		= "Diretório Inicial do Usuário";
$owl_lang->maxsessions			= "Número máximo de Sessões";
$owl_lang->noprefaccess			= "Desabilitar Preferência";
$owl_lang->old_action_icons		= "Usar Ícones versão pré 0.80";
$owl_lang->owl_anon_download     	= "Somente Download";
$owl_lang->owl_anon_full		= "Acesso Integral";
$owl_lang->owl_anon_ro			= "Somente Leitura";
$owl_lang->owl_dbdump_path   		= "Caminho (path) para útilitário DB Dump:";
$owl_lang->owl_def_file_group_owner	= "Proprietário padrão de grupo de arquivo:";
$owl_lang->owl_def_file_meta		= "Arquivo Meta Data padrão:";
$owl_lang->owl_def_file_owner		= "Propr. padrão de arquivos:";
$owl_lang->owl_def_file_perm 		= "Propr. padrão da Política de criação de arquivos:";
$owl_lang->owl_def_file_security	= "Arquivo de segurança padrão:";
$owl_lang->owl_def_file_title		= "Título padrão para arquivo (nihil para tipo arq.):";
$owl_lang->owl_def_fold_group_owner	= "Proprietário padrão para grupo de pastas:";
$owl_lang->owl_def_fold_owner		= "Proprietário padrão para pasta:";
$owl_lang->owl_def_fold_sec		= "Segurança padrão de pasta:";
$owl_lang->owl_def_folder_perm 		= "Política padrão para Criação de pasta:";
$owl_lang->owl_default_tmpdir		= "Localização do diretório Temp: ";
$owl_lang->owl_email_from		= "Do Endereço:";
$owl_lang->owl_email_fromname		= "Do Nome:";
$owl_lang->owl_email_replyto		= "Endereço para resposta:";
$owl_lang->owl_email_server		= "Servidor SMTP:";
$owl_lang->owl_email_smtp		= "Usar método email SMTP";
$owl_lang->owl_email_smtp_auth		= "Usar autenticação SMTP";
$owl_lang->owl_email_smtp_auth_login	= "Usuário (login) para autenticação SMTP:";
$owl_lang->owl_email_smtp_auth_passwd	= "Senha de autenticação SMTP";
$owl_lang->owl_email_subject_pref	= "Prefixo assunto:";
$owl_lang->owl_fogotpass		= "Exibe link esqueceu senha:";
$owl_lang->owl_group_user		= "Usuários que são membros deste grupo";
$owl_lang->owl_gzip_path     		= "Caminho (path) para gzip:";
$owl_lang->owl_hidebackup		= "Esconder o Diretório de Backup:";
$owl_lang->owl_log_file			= "Atividades registros (log) por arquivo:";
$owl_lang->owl_log_login_act		= "Atividades registros (log) Login/Logout:";
$owl_lang->owl_log_rec_page		= "Registros (log) Visualização por Página:";
$owl_lang->owl_logging			= "Habilita registro (log):";
$owl_lang->owl_logo			= "Logo da página de login ([Language]/graphics):";
$owl_lang->owl_lookAtHD			= "Desabilitar Ver no HD:";
$owl_lang->owl_lookAtHDDel		= "Remover e Apagar arquivos do Banco de Dados";
$owl_lang->owl_max_filesize		= "Tamanho máximo de arquivo para carga (em bytes)";
$owl_lang->owl_owl_expand		= "Visão Padrão de Busca (expandida)";
$owl_lang->owl_owl_timeout		= "Tempo de Inatividade de Sessão (em Segundos)";
$owl_lang->owl_pdftotext_path       = "Manter Ã) Body Background Imagem:";
$owl_lang->owl_pdftotext_path		= "Manter Índice de Busca para <br />PDF e arquivos texto.<br />&#8211; em branco desabilitado:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 ou maior requerida.<br />Caminho para pod2html:";
$owl_lang->owl_restrict_view		= "Permite funcionalidade Visão Restrita:";
$owl_lang->owl_self_reg			= "PERMITE AUTO REGISTRAR-SE:";
$owl_lang->owl_self_reg_hd		= "PADRÕES DE AUTO REGISTRO DE USUÁRIO";
$owl_lang->owl_tar_path     		= "Caminho (path) utilitário tar:";
$owl_lang->owl_title_browser		= "FUNCIONALIDADES AS BUSCAS OWL";
$owl_lang->owl_title_custom		= "MODIFICAR COLUNAS DAS BUSCAS";
$owl_lang->owl_title_custom_search      = "MODIFICAR RESULTADOS DAS BUSCAS";
$owl_lang->owl_title_defaults   	= "PADRÕES";
$owl_lang->owl_title_email		= "Configurações do Sistema de E-Mail OWL";
$owl_lang->owl_title_HD			= "OLHAR NO HD PARA NOVAS CONFIGURAÇÔES DE ARQUIVOS";
$owl_lang->owl_title_logging  		= "CONFIGURAÇÕES";
$owl_lang->owl_title_other		= "OUTRAS CONFIGURAÇÕES";
$owl_lang->owl_title_tools   		= "Ferramentas BD BACKUP/GZIP";
$owl_lang->owl_unzip_path     		= "Caminho (path) do unzip:";
$owl_lang->owl_version_control		= "Permite Controle de Versão:";
$owl_lang->owl_wordtotext_path          = "Arquivos MS-WORD <br />&#8211; em branco para desabilitar:";
$owl_lang->quota			= "Quota 0=Desabilitado";
$owl_lang->reallydeluser		= "Este usuário é dono de %numfiles% arquivo(s) e %numfolders% pasta(s). Esse(s) arquivo(s) ou pasta(s) estão sem pai. Prosseguir o a remoção?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "Exibir n registro por página (0 = Desabilitado):";
$owl_lang->recycle_enabled		= "Habilitar Coleta de Lixo:";
$owl_lang->recycle_location		= "Localização da lata de lixo:";
$owl_lang->recycle_title		= "CONFIGURAÇÕES DE LATA DE LIXO";
$owl_lang->remember_me			= "Mostrar o ícone de Lembrar-me";
$owl_lang->remember_me_checkbox		= "Lembrar-me";
$owl_lang->remember_me_title		= "CONFIGURAÇÕES DE LOGIN PERSISTENTES";
$owl_lang->remember_timeout		= "Tempo em dias para reter Cookie";
$owl_lang->restore_file_prefix		= "Constante de Prefixo nos arquivos recuperados";
$owl_lang->search_result_folders	= "Incluir Pasta no(s) Resultado(s) da pesquisa";
$owl_lang->show_action_title		= "Exibir Botões de ação em massa (seleção):";
$owl_lang->show_bulk_title		= "Exibir Botões de seleção:";
$owl_lang->show_folder_title		= "Exibir Pasta de Ferramentas:";
$owl_lang->show_panel			= "Mostrar";
$owl_lang->show_panel_title		= "Exibir Painel de Situação:";
$owl_lang->show_pref_title		= "Exibir barra de Preferências e LOGOUT:";
$owl_lang->show_search_title		= "Exibir barra de pesquisar:";
$owl_lang->status_bar_both              = "Topo e rodapé";
$owl_lang->status_bar_bottom            = "Rodapé somente";
$owl_lang->status_bar_location          = "Exibir a barra de situação em/no:";
$owl_lang->status_bar_not               = "Não exibir";
$owl_lang->status_bar_top               = "Somente topo";
$owl_lang->use_popup			= "Usar balões para exibir Notícias:";
$owl_lang->users           		= "Usuários";
$owl_lang->virus_path			= "Caminho para programa anti-vírus<br />Examplo: &ldquo;/usr/bin/clamscan --quiet&rdquo; <br />&#8211; vazio para desabilitar função:";

// NEW STUF BEGIN
$owl_lang->cust_popup                   = "Descrição em Balões dentro Campos Configurados";
$owl_lang->cust_headpopup     		= "CAMPOS ESPECÍFICOS PARA DOCUMENTOS";
$owl_lang->auth_http                    = "Autenticação HTTP (.htaccess)";
$owl_lang->auth_ldap                    = "Autenticação LDAP";
$owl_lang->users_in_primary_group       = "Usuários que tem este como grupo primário";
$owl_lang->create_user_homedir 		= "Criar Diretório base:";
$owl_lang->use_captcha 			= "Usar CAPTCHA:";
$owl_lang->created_here 		= "<br /> (Criado aqui se diretório base selecionado)";
$owl_lang->auth_owl                     = "Autenticação Owl";
$owl_lang->auth_pop3                    = "Autenticação pop3 ";
$owl_lang->file_desc_required           = "Descrição de arquivo requerida";
$owl_lang->folder_desc_required         = "Descrição de pasta requerida";
$owl_lang->html_title			= "Prefer. HTML ";
$owl_lang->pass_account_lockout         = "Número de tentativas para travamento:";
$owl_lang->pass_change_every            = "Força troca de senha a cada período de dias 0=Disabled:";
$owl_lang->pass_enable_account_lockout  = "permite travamento de conta:";
$owl_lang->pass_min_passwd_length       = "Tamanho mínimo para senhas:";
$owl_lang->pass_min_passwd_numeric      = "Número mínimo de números na senha:";
$owl_lang->pass_min_passwd_special      = "Número mínimo de carac. espec. na senha:";
$owl_lang->pass_min_username_length     = "Tamanho mínimo para nome de usuários:";
$owl_lang->pass_track_old_passwords     = "Número de senhas anteriores para rastrear:";
$owl_lang->rtftotext_path               = "Caminho (path) ferramenta RTF para TXT";
$owl_lang->show_user_info               = "Exibir Nome Usuário como clicável";
$owl_lang->user_admin                   = "Usuário administrador de grupo";
$owl_lang->user_auth_type               = "Tipo de autenticação:";
$owl_lang->user_change_pass_next_login  = "Obrigar troca de senha no próximo acesso:";
$owl_lang->user_expires                 = "Conta expira em:";
$owl_lang->user_gmt_offset              = "Posicionamento do Usuário ref. GMT(UTC)";
$owl_lang->user_group_admin             = "Admin arquivos para Grupo Primário:";
$owl_lang->user_login_to_newrecords     = "Acesso inic. à página novos registros:";
$owl_lang->users_group_admin		= "Usuários que estão no grupo Admin";
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
$owl_lang->owl_log_hd_action	= "Ação";
$owl_lang->owl_log_hd_agent	= "Agente";
$owl_lang->owl_log_hd_dt_tm	= "Data Hora";
$owl_lang->owl_log_hd_dtls	= "Detalhes";
$owl_lang->owl_log_hd_file	= "Arquivo";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Caminho (path) da pasta";
$owl_lang->owl_log_hd_ip	= "IP / Endereço";
$owl_lang->owl_log_hd_user	= "Usuário";
$owl_lang->owl_log_hide      	= "Esconder: ";
$owl_lang->owl_log_no_rec	= " não há registros ";
$owl_lang->owl_log_viewer	= "Ver Registros";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Esvaziar a lata lixo";
$owl_lang->really_empty_trash	= "Confirma esvaziar a lata de lixo?";
$owl_lang->recycle_bin_admin    = "Administração da lata de lixo";
// BEGIN NEW STUFF
$owl_lang->trash_email_body  = "Os arquivos que você requisitou estão anexados.";
$owl_lang->trash_email_subject  = "Os arquivos requisitados foram restaurados.";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->donothing                    = "Nada feito.&#8211; Permissões de arquivos não modificadas.";
$owl_lang->everyoneread			= "Todo mundo pode ler/baixar";
$owl_lang->everyoneread_ad		= "Todo mundo pode ler/baixar";
$owl_lang->everyonewrite		= "Todo mundo pode ler/gravar/baixar";
$owl_lang->everyonewrite_ad		= "Todo mundo pode ler/gravar/baixar";
$owl_lang->everyonewrite_ad_nod		= "Todo mundo pode ler/gravar/baixar, não APAGAR";
$owl_lang->everyonewrite_nod		= "Todo mundo pode ler/gravar/baixar, não APAGAR";
$owl_lang->file_size_byte		= "b";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->geveryoneread		= "Todo mundo pode ler esta pasta";
$owl_lang->geveryoneread_ad		= "Todo mundo pode ler esta pasta";
$owl_lang->geveryonewrite		= "Todo mundo pode enviar arquivos e deletar esta pasta";
$owl_lang->geveryonewrite_ad		= "Todo mundo pode enviar arquivos e deletar esta pasta";
$owl_lang->geveryonewrite_ad_nod	= "Todo mundo pode enviar arquivos para esta pasta";
$owl_lang->geveryonewrite_nod		= "Todo mundo pode enviar arquivos para esta pasta";
$owl_lang->ggroupread			= "Seu grupo pode ler esta pasta";
$owl_lang->ggroupread_ad		= "O grupo selecionado pode ler esta pasta";
$owl_lang->ggroupwrite			= "Seu grupo pode enviar arquivos e deletar esta pasta";
$owl_lang->ggroupwrite_ad    		= "O grupo selecionado pode enviar arquivos e deletar esta pasta";
$owl_lang->ggroupwrite_ad_nod		= "O grupo selecionado pode enviar arquivos para esta pasta";
$owl_lang->ggroupwrite_nod		= "Seu grupo pode enviar arquivos para esta pasta";
$owl_lang->ggroupwrite_worldread 	= "Seu grupo pode enviar arquivos e deletar esta pasta &amp; qualquer um pode ver seu conteúdo";
$owl_lang->ggroupwrite_worldread_ad 	= "O grupo selecionado pode enviar arquivos e deletar esta pasta &amp; qualquer um pode ver seu conteúdo";
$owl_lang->ggroupwrite_worldread_ad_nod	= "O grupo selecionado pode enviar arquivospara esta pasta &amp; qualquer um pode ver seu conteúdo, NÃO DELETAR";
$owl_lang->ggroupwrite_worldread_nod 	= "Seu grupo pode enviar arquivos para esta pasta &amp; qualquer um pode ver seu conteúdo, NÃO DELETAR";
$owl_lang->gonlyyou			= "Somente você pode enviar arquivos e deletar esta pasta";
$owl_lang->gonlyyou_ad			= "Somente você pode enviar arquivos e deletar esta pasta";
$owl_lang->groupread			= "Seu grupo pode ler/baixar";
$owl_lang->groupread_ad			= "O grupo selecionado pode ler/baixar";
$owl_lang->groupwrite			= "Seu grupo pode ler/gravar/baixar";
$owl_lang->groupwrite_ad		= "O grupo selecionado pode ler/gravar/baixar";
$owl_lang->groupwrite_ad_nod		= "O grupo selecionado pode ler/gravar/baixar, NÃO DELETAR";
$owl_lang->groupwrite_nod		= "Seu grupo pode ler/gravar/baixar, NÃO DELETAR";
$owl_lang->groupwrite_worldread 	= "Seu grupo pode ler/gravar/baixar &amp; qualquer um pode ler";
$owl_lang->groupwrite_worldread_ad 	= "O grupo selecionado pode ler/gravar/baixar &amp; qualquer um pode ler";
$owl_lang->groupwrite_worldread_ad_nod 	= "O grupo selecionado pode ler/gravar/baixar (NÃO DELETAR) &amp; qualquer um pode ler";
$owl_lang->groupwrite_worldread_nod 	= "Seu grupo pode ler/gravar/baixar (NÃO DELETAR) &amp; qualquer um pode ler";
$owl_lang->invalidsess			= "Identificação de sessão inválida. Por favor, efetue login a partir do endereço principal.<br />";
$owl_lang->notif_comment_1		= "comentado em";
$owl_lang->notif_comment_2		= "Comentário:";
$owl_lang->notif_msg         		= "ESTA É UMA MENSAGEM AUTOMÁTICA DA INTRANET OWL<br /><br />Encontre o arquivo novo/atualizado anexado a este E-Mail<br /><br />";
$owl_lang->notif_msg_alt         	= "ESTA É UMA MENSAGEM AUTOMÁTICA DA INTRANET OWL\n\nEncontre o arquivo novo/atualizado anexado a este E-Mail\n\n";
$owl_lang->notif_msg_alt_link           = "ESTA É UMA MENSAGEM AUTOMÁTICA DA INTRANET OWL\n\nEncontre um link para um arquivo novo/atualizado neste E-mail\n\n";
$owl_lang->notif_msg_link               = "ESTA É UMA MENSAGEM AUTOMÁTICA DA INTRANET OWL<br /><br />Encontre um link para um arquivo novo/atualizado neste E-mail<br /><br />";
$owl_lang->notif_salutation		= "Prezado";
$owl_lang->notif_subject_comment	= "Um comentário de arquivo no repositório OWL foi adicionado";
$owl_lang->notif_subject_monitor	= "Um arquivo ou pasta do repositório OWL foi atualizado";
$owl_lang->notif_subject_new 		= "Novo arquivo no repositório OWL";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "Um arquivo do repositório OWL foi atualizado";
$owl_lang->notif_subject_file_deleted   = "ARQUIVO REMOVIDO DO REPOSITÓRIO";
$owl_lang->notif_subj_new_account       = "Uma nova conta OWL foi criada para você";
$owl_lang->notif_user			= "Criado / Atualizado por:";
$owl_lang->onlyyou			= "Somente você pode ler/baixar/gravar";
$owl_lang->onlyyou_ad			= "Somente você pode ler/baixar/gravar";
$owl_lang->orphaned			= "&#8211; sem proprietário  &#8211;";
$owl_lang->owl_path			= "Caminho(path) dos Arquivos: ";
$owl_lang->sessinuse			= "Esta sessão está em uso em outro computador, acesso negado<br />";
$owl_lang->sesstimeout			= "Sua sessão expirou, por favor logue-se novamente<br />";
$owl_lang->virus_infected 		= "ARQUIVO INFECTADO POR VÍRUS";
$owl_lang->virus_return_val		= "Valor de retorno do programa antivírus:";
$owl_lang->watermark_string		= "Confidencial";
$owl_lang->watermark_source		= "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Procurar nessa pasta";
$owl_lang->title_browse_site     	= "Procurar nessa URL";
$owl_lang->title_download_view     	= "Baixar / Visualizar esse arquivo";
$owl_lang->title_edit_prefs     	= "Visualizar / Editar prefer. do Usuário";
$owl_lang->title_return_folder     	= "Retornar para";
$owl_lang->title_sort     		= "Ordenar por";
$owl_lang->title_view_my     		= "Visualizar lista dos meus arquivos";
$owl_lang->title_view_new     		= "Visualizar lista dos meus arquivos novos desde a última visita";
$owl_lang->title_view_updated     	= "Visualizar lista dos meus arquivos atualizados desde a última visita";
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

$owl_lang->news_content			= "Conteúdo";
$owl_lang->news_hd			= "Notícias";
$owl_lang->news_hd_audience		= "Audiência Alvo";
$owl_lang->news_hd_created		= "Criado em";
$owl_lang->news_hd_expires		= "Expira em";
$owl_lang->news_heading			= "Manchete";
$owl_lang->news_posted_date		= "Notícia postada em:";
$owl_lang->news_read			= "Leitura";
$owl_lang->news_title			= "Administração de notícias";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_doc_not_exists		= "DEBUG: O diretório de documentos OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." não existe.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: O diretório de documentos OWL: " .$default->owl_fs_root . "/" . fid_to_name(1) ." não é gravável pelo servidor web.";
$owl_lang->debug_file_not_exist		= "DEBUG: O arquivo requerido &ldquo;$default->owl_fs_root/%s &rdquo; não existe.<br /> OU<br />O caminho especificado por \$default->owl_fs_root em config/owl.php está errado.";
$owl_lang->debug_tmp_not_exists		= "DEBUG: O diretório temporário OWL: $default->owl_tmpdir não existe.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: O diretório temporário OWL: $default->owl_tmpdir não é gravável pelo servidor web.";
$owl_lang->debug_webserver_no_access	= "DEBUG: O servidor web não tem acesso de leitura a: <br />&ldquo;$default->owl_fs_root/%s &rdquo;. <br />Por favor, corrija as permissões e tente novamente";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Estatísticas / Visualizador de relatórios";
$owl_lang->stats_files		= "Número de arquivos por usuário";
$owl_lang->stats_folders	= "Número de pastas por usuário";
$owl_lang->stats_information	= "Registro(log) do Owl e registro de arquivo (log) precisa ser ativado para que estas estatísticas possam ser visualizadas.";
$owl_lang->stats_top		= "Top 20 downloads";
$owl_lang->stats_report_users_disabled         = "Usuários (Desabilitados Users)";
$owl_lang->stats_report_users_entitlement         = "Usuários (Usuário Titulares)";
$owl_lang->stats_report_users_filesfolders          = "Usuários (Arquivos e Pastas por Usuário)";
$owl_lang->stats_report_users_inactive          = "Usuários (Usuários Inativos)";
$owl_lang->stats_users          = "Signon/Signoff do usuário falhou. ";
$owl_lang->stats_users_loggedin = "Atualmente em Sessão Ativa";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->doc_administration	= "Administração tipo de documento";
$owl_lang->doc_field_label	= "Rótulo do Campo (por língua)";
$owl_lang->doc_field_name	= "Nome do Campo";
$owl_lang->doc_field_pos	= "Posição do Campo";
$owl_lang->doc_field_required	= "Requerido?";
$owl_lang->doc_field_searchable	= "Pesquisável?";
$owl_lang->doc_field_size	= "Tamanho do campo";
$owl_lang->doc_new_doc_type	= "&#8211; ADIC. novo tipo de Documento &#8211;";
$owl_lang->doc_specific		= "CAMPOS ESPECÍFICOS DO DOCUMENTO:";
$owl_lang->document_type	= "Tipo de documento";
$owl_lang->document_type_name	= "Nome do tipo do documento";
// BEGIN NEW STUFF
$owl_lang->doc_field_popup  = "Inserir descrição no popup?";
$owl_lang->doc_field_disp_label = "RÓTULO DO CAMPO:";
$owl_lang->doc_field_disp_sep = "SEPARADOR DO RÓTULO";
$owl_lang->doc_field_sample	= "&#8211;&nbsp;&nbsp;S&nbsp;A&nbsp;M&nbsp;P&nbsp;L&nbsp;E&nbsp;&nbsp;&nbsp;V&nbsp;I&nbsp;E&nbsp;W&nbsp;&nbsp;&#8211;";
$owl_lang->doc_field_show_in_browse = "Exibir em pesquisas:";
$owl_lang->doc_field_show_in_list = "Exibir campo na visão de pesquisas:";
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
$owl_lang->header_csv_import    = "Importar arquivo de usuários CSV";
$owl_lang->import_inserted      = "INSERIDO";
$owl_lang->import_skipped       = "SALTADO";
$owl_lang->invalid_groupid      = "Ident. do grupo invalida --> ";
$owl_lang->msg_user_exists      = "Usuário já existe";
$owl_lang->sendcsvfile          = "Carregar arquivo delimitado por Vírgula";
$owl_lang->user_created_skipped = "Usuário:";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->owl_peer_review	= "Habilitar Config. Peer de Revisão:";
$owl_lang->owl_peer_review_opt  = "Tornar Peer de Revisão opcional:";
$owl_lang->owl_title_peer_review= "CONFIGURAÇÃO PEER DE REVISÃO DE DOCUMENTOS";
$owl_lang->owl_title_peer_review2= "Peer de Revisão de Documentos";
$owl_lang->peer_approval_title 	= "Documentos aguardando minha Aprovação";
$owl_lang->peer_approved_body	= "Seu arquivo foi aprovado.:";
$owl_lang->peer_file_approved	= "Arquivo aprovado:";
$owl_lang->peer_file_final	= "Aprovação final:";
$owl_lang->peer_file_rejected	= "Arquivo Rejeitado:";
$owl_lang->peer_file_to_review	= "Arquivo para revisão:";
$owl_lang->peer_final_approval	= "[Aprovação Final]: ";
$owl_lang->peer_final_body	= "Seu documento foi aprovado por todos os revisores requisitados.<br />Por favor faça Login e torne o documento público<br />";
$owl_lang->peer_msg_to_reviewer	= "Mensagem para os Revisores";
$owl_lang->peer_my_approval	= "Aguarda minha<br /> Aprovação";
$owl_lang->peer_notif_user	= "Criado/Atualizado por";
$owl_lang->peer_pending_approval= "Minhas Aprovações<br /> Pendentes";
$owl_lang->peer_pending_title 	= "Meus documentos pendentes de aprovação";
$owl_lang->peer_reject_reason   = "Motivo da rejeição";
$owl_lang->peer_rejected_body	= "Seu arquivo foi rejeitado:";
$owl_lang->peer_review_body	= "Sua aprovação foi requisitada para os seguintes documentos:";
$owl_lang->peer_reviewer_list	= "Revisor(es)";
$owl_lang->peer_satus	 	= "Situação";
$owl_lang->peer_satus_approved  = "&#8212; A P R O V A D O  &#8212;";
$owl_lang->peer_satus_pending   = "&#8212; P E N D E N T E  &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; R E J E I T A D O&#8212;";
$owl_lang->peer_subj_approved	= "Seu Documento foi APROVADO";
$owl_lang->peer_subj_rejected	= "Seu Documento foi REJEITADO";
$owl_lang->peer_subj_reminder	= "LEMBRETE: Você tem arquivo OWL para revisar";
$owl_lang->peer_subj_review	= "Você tem um arquivo OWL para revisar";

// NEW STUFF BEGINS
$owl_lang->peer_final_body_auto = "Seu documento foi aprovado por todos os revisores requisitados.<br />Seu arquivo foi tornado público.<br />";
// END NEW STUFF

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_adding_file             = "Adic. ACL de arquivo:";
$owl_lang->acl_adding_folder           = "Adic. ACL de pasta:";
$owl_lang->acl_available_groups        = "Grupo(s) disponível(is)";
$owl_lang->acl_available_users         = "Usuário(s) disponível(is)";
$owl_lang->acl_edit_file               = "Editando ACL de Arquivo:";
$owl_lang->acl_edit_folder             = "Editando ACL de Pasta:";
$owl_lang->acl_file_checkin            = "Entrada/Saída Controlada";
$owl_lang->acl_file_comment            = "Comentário";
$owl_lang->acl_file_copy               = "Cópia";
$owl_lang->acl_file_delete             = "Apagar";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_modify             = "Propriedades";
$owl_lang->acl_file_monitor            = "Monitorar";
$owl_lang->acl_file_move               = "Mover";
$owl_lang->acl_file_read               = "Ler";
$owl_lang->acl_file_search             = "Pesquisa relacionado(s)";
$owl_lang->acl_file_set_acl            = "Configura ACL";
$owl_lang->acl_file_update             = "Atualizar";
$owl_lang->acl_file_view_log           = "Ver Registro";
$owl_lang->acl_folder_copy             = "Copiar";
$owl_lang->acl_folder_delete           = "Apagar";
$owl_lang->acl_folder_modify           = "Modificar Propriedades";
$owl_lang->acl_folder_monitor          = "Monitorar";
$owl_lang->acl_folder_move             = "Mover";
$owl_lang->acl_folder_read             = "Ler (Baixar/Procurar)";
$owl_lang->acl_folder_set_acl          = "Estabelecer ACL";
$owl_lang->acl_folder_write            = "Grave (Crie)";
$owl_lang->acl_heading_file            = "Grupo(s)/Usuário(s)";
$owl_lang->acl_heading_files           = "ARQUIVOS &#8211; SELEC. USUÁRIO(S) e GRUPO(S)";
$owl_lang->acl_heading_folder          = "Grupo(s)/Usuário(s)";
$owl_lang->acl_heading_folders         = "Pastas &#8211; SELEC. USUÁRIO(S)/GRUPO(S) DESEJADOS";
$owl_lang->acl_propagate_file          = "Estab. essa Política sobre \"TODOS\" Arquivos:";
$owl_lang->acl_propagate_folders       = "Propagar para todas Pastas:";
$owl_lang->acl_selected_groups         = "Selecionar Grupo";
$owl_lang->acl_selected_users          = "Selecionar Usuários";
$owl_lang->acl_set_acl                 = "Estabelecer Política Segurança";
$owl_lang->acl_set_acl_now             = "Estabelecer Política Segurança Agora:";
$owl_lang->acl_set_selected            = "Estabelecer Seleção";
$owl_lang->alt_acl_save_file           = "Salvar Política Segurança de Arquivo";
$owl_lang->alt_acl_save_folder         = "Salvar Política Segurança da Pasta";
$owl_lang->btn_acl_save                = "Salvar";
$owl_lang->acl_set_file_permissions    = "Estabelecer Permissões de arquivo";
$owl_lang->acl_set_folder_permissions  = "Estabelecer Permissões na Pasta";
$owl_lang->alt_set_folder_acl	       = "Estabelecer Política de Segurança nessa Pasta";


//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************

$owl_lang->report_available_reports         = "Relatórios Disponíveis:";
$owl_lang->report_file_folder               = "Arquivo/Pasta";
$owl_lang->report_filter                    = "Filtro:";
$owl_lang->report_filter_since              = "Desde:";
$owl_lang->report_full_access               = "ACESSO COMPLETO";
$owl_lang->report_select_report             = "&#8211; Selecione um Relatório &#8211;";
$owl_lang->report_users_disabled_title      = "Usuários Desabilitados";
$owl_lang->report_users_entitlement         = "Listar Acesso de Usuários";
$owl_lang->report_users_inactive_title      = "Usuários Inativos desde";

//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_enable_thumbnails         = "Estabelecer Thumbnail Ver/Geração:";
$owl_lang->thumb_gen_thumb_tool_path       = "Caminho (Path) da Ferramamenta ImageMagick:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Parâmetros Mplayer :";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Caminho (Path) para Mplayer:";
$owl_lang->thumb_image_info                = "Informação para Image";
$owl_lang->thumb_large_width               = "Thumbnail tamanho (longos) Pixels:";
$owl_lang->thumb_med_width                 = "Thumbnail tamanho (médio) Pixels:";
$owl_lang->thumb_number_colums             = "Núm. de Colunas para Visão Thumbnail:";
$owl_lang->thumb_re_generate               = "Gerar Thumbnail";
$owl_lang->thumb_small_width               = "Thumbnail tamanho(curto) 0=Não exibe Pixels:";
$owl_lang->thumb_title                     = "THUMBNAIL OPÇÕES de VISÃO/GERAÇÃO";
$owl_lang->thumb_title_thumb_view          = "THUMBNAIL VISÃO DETALHADA";
$owl_lang->thumb_image_size                = "Tamanho da Imagem:";
$owl_lang->alt_thumb_small                 = "Thumbnail pequeno";
$owl_lang->alt_no_thumb                    = "Não há Thumbnail Disponível";

//********************************************************
// THUMBNAILS END
//********************************************************

//********************************************************
// EXTENDED HELP BEGIN
//********************************************************

$owl_lang->owl_track_favorites_extended         = "Rastrear Favoritos";
$owl_lang->owl_password_override_extended       = "Se ativo então usuários que não tem acesso ao arquivo, podem usar senha para download";
$owl_lang->owl_view_doc_in_new_window_extended  = "Quando você ver um documento usar uma janela separada";
$owl_lang->owl_filedescreq_extended             = "Tornar Descrição de arquivo um Campo REQUERIDO";
$owl_lang->owl_old_action_icons_extended        = "Ícone ações extendidas";
$owl_lang->owl_email_from_extended              = "email remetente";
$owl_lang->owl_email_fromname_extended          = "Email nome do remetente";
$owl_lang->owl_email_replyto_extended           = "Email responder para";
$owl_lang->owl_email_server_extended            = "Email servidor";
$owl_lang->owl_use_smtp_extended                = "Servidor smtp";
$owl_lang->owl_use_smtp_auth_extended           = "Autenticação Servidor smtp";
$owl_lang->owl_smtp_auth_login_extended         = "Login Servidor smtp";
$owl_lang->owl_smtp_passwd_extended             = "Senha smtp";
$owl_lang->owl_email_subject_extended           = "Email Assunto";
$owl_lang->owl_forgot_pass_extended             = "Esqueceu Senha";
$owl_lang->owl_self_reg_extended                = "Auto Registrar-se";
$owl_lang->owl_html2text_path_extended          = "Path do html2text";
$owl_lang->owl_remember_me_extended             = "Lembrar Senha";
$owl_lang->owl_status_bar_location_extended     = "Local da Barra Status";
$owl_lang->owl_info_panel_wide_extended         = "Painel Informações Largo";
$owl_lang->owl_thumbnails_extended              = "Thumbnails (micro-imagens)";
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

$owl_lang->group_set_selected      = "Selecionar ";
$owl_lang->alt_group_set_selected  = "Definir usuários selecionados";

$owl_lang->btn_jupload                          = "Jupload";
$owl_lang->alt_btn_jupload                      = "Adicionar Múltiplos arquivos usando Jupload";

$owl_lang->owl_use_smtp_ssl                     = "SMTP SSL:";
$owl_lang->owl_smtp_port                        = "SMTP Numero da Porta:";
$owl_lang->owl_smtp_max_attachemnt_size         = "Tamanho Máximo dos Anexos -em bytes-:";
$owl_lang->owl_force_browser_to_ssl             = "Forçar Browse a usar HTTPS:";
$owl_lang->owl_file_update_different_name       = "Atualizar Arquivo com Nome diferente:<br />(EXTENÇÃO Precisa permanecer a mesma.)";
$owl_lang->owl_use_wysiwyg_editor               = "Usar Editor (WYSIWYG) para ÁreaTexto:";
$owl_lang->owl_show_folder_desc_popup           = "Exibir Descrição da Pasta como Popup:";
$owl_lang->owl_header_watermarking              = "Opções de Marca D'Água no PDF";
$owl_lang->owl_enable_watermarking              = "Habilita Marca D'Água no PDF:";
$owl_lang->owl_path_to_pdftk                    = "Caminho para pdftk:";
$owl_lang->owl_path_to_pdftk_bg_file            = "Caminho para Marca D'Água configurada :<br />(caminho para arquivo pdf 1 página que será usado <br />como Marca D'Água em vez do padrão";
$owl_lang->owl_pdftk_greater_than_1_40          = "Versão do PDFTK maior que 1.40:";
$owl_lang->owl_indexing_user_selectable         = "Habilitar Indexação de arquivo selecionável pelo usuário:";
$owl_lang->owl_indexing_off                     = "Desabilitar Indexação de arquivo:";
$owl_lang->owl_default_revision_type            = "Tipo de Revisão Padrão:";
$owl_lang->owl_machine_timezone                 = "Zona Horária do Servidor UTC:";
$owl_lang->owl_previous_ver_downloadable        = "Habilitar Versão Prévia como Acessível:";
$owl_lang->owl_auto_checkin_checkout            = "Marcar arquivos como Retirado num Download:";
$owl_lang->owl_user_default_view                = "Visão EXPANDIDA Padrão do Usuário:";
$owl_lang->owl_user_default_revision            = "Tipo de Revisão Padrão:";
$owl_lang->owl_user_major_revision              = "Revisão Inicial Principal do Usuário:";
$owl_lang->owl_user_minor_revision              = "Revisão Inicial Secundária do Usuário:";
$owl_lang->owl_user_pdfwatermark                = "Habilitar Marca D'Água no PDF:";
$owl_lang->owl_user_email_pass                  = "Enviar Email Usuário / Senha:";
$owl_lang->owl_use_email_signature              = "Usar Assinatura?:";
$owl_lang->owl_email_signature                  = "Assinatura do Email:";
$owl_lang->owl_file_link                        = "Ligação Arquivo:";
// $owl_lang->owl_file_link                        = "File Link:"; (em duplicidade desabilitado gsavix 10.03.2009 13:35:00
$owl_lang->alt_hot_link                         = "Exibir URL Direto";
$owl_lang->alt_link_folder                      = "Ligação Pasta";

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
