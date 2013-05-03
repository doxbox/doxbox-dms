CREATE TABLE owl.active_sessions
(
    sessid                           VARCHAR2(32)                     NOT NULL
  , usid                             VARCHAR2(25)                    
  , lastused                         NUMBER(10)                      
  , ip                               VARCHAR2(16)                    
  , currentdb                        NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005294 ON owl.active_sessions
(
    sessid
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.advanced_acl
(
    group_id                         NUMBER(4)                       
  , user_id                          NUMBER(4)                       
  , file_id                          NUMBER(4)                       
  , folder_id                        NUMBER(4)                       
  , owlread                          NUMBER(4)                        DEFAULT 0
  , owlwrite                         NUMBER(4)                        DEFAULT 0
  , owlviewlog                       NUMBER(4)                        DEFAULT 0
  , owldelete                        NUMBER(4)                        DEFAULT 0
  , owlcopy                          NUMBER(4)                        DEFAULT 0
  , owlmove                          NUMBER(4)                        DEFAULT 0
  , owlproperties                    NUMBER(4)                        DEFAULT 0
  , owlupdate                        NUMBER(4)                        DEFAULT 0
  , owlcomment                       NUMBER(4)                        DEFAULT 0
  , owlcheckin                       NUMBER(4)                        DEFAULT 0
  , owlemail                         NUMBER(4)                        DEFAULT 0
  , owlrelsearch                     NUMBER(4)                        DEFAULT 0
  , owlsetacl                        NUMBER(4)                        DEFAULT 0
  , owlmonitor                       NUMBER(4)                        DEFAULT 0
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE INDEX owl.acl_folderid ON owl.advanced_acl
(
    folder_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE INDEX owl.acl_fileid ON owl.advanced_acl
(
    file_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE INDEX owl.acl_userid ON owl.advanced_acl
(
    user_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE INDEX owl.acl_groupid_index ON owl.advanced_acl
(
    group_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.comments
(
    id                               NUMBER(4)                        NOT NULL
  , fid                              NUMBER(4)                        NOT NULL
  , userid                           NUMBER(4)                       
  , comment_date                     DATE                             NOT NULL
  , comments                         VARCHAR2(2048)                   DEFAULT 'no comments recorded' NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005295 ON owl.comments
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.comments_id_trigger
BEFORE INSERT  ON owl.COMMENTS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT COMMENTS_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.docfields
(
    id                               NUMBER(4)                        NOT NULL
  , doc_type_id                      NUMBER(4)                        NOT NULL
  , field_name                       VARCHAR2(80)                     NOT NULL
  , field_position                   NUMBER(4)                        NOT NULL
  , field_type                       VARCHAR2(80)                     NOT NULL
  , field_values                     VARCHAR2(80)                     NOT NULL
  , field_size                       NUMBER(38)                       NOT NULL
  , searchable                       NUMBER(4)                        NOT NULL
  , show_desc                        NUMBER(4)                        DEFAULT 0 NOT NULL
  , required                         NUMBER(4)                        NOT NULL
  , show_in_list                     NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005325 ON owl.docfields
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.docfields_id_trigger
BEFORE INSERT  ON owl.DOCFIELDS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT docfields_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.docfieldslabel
(
    doc_field_id                     NUMBER(4)                        NOT NULL
  , field_label                      VARCHAR2(80)                     NOT NULL
  , locale                           VARCHAR2(80)                     NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005311 ON owl.docfieldslabel
(
    doc_field_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.docfieldvalues
(
    id                               NUMBER(4)                        NOT NULL
  , file_id                          NUMBER(4)                        NOT NULL
  , field_name                       VARCHAR2(80)                     NOT NULL
  , field_value                      VARCHAR2(80)                     NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005330 ON owl.docfieldvalues
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.docfieldvalues_id_trigger
BEFORE INSERT  ON owl.DOCFIELDVALUES
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT docfieldvalues_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.doctype
(
    doc_type_id                      NUMBER(4)                        NOT NULL
  , doc_type_name                    VARCHAR2(255)                    NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005314 ON owl.doctype
(
    doc_type_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.doctype_id_trigger
BEFORE INSERT  ON owl.DOCTYPE
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT doctype_ID_SEQ.NEXTVAL INTO :NEW.doc_type_id FROM DUAL;
END;
/

CREATE TABLE owl.favorites
(
    userid                           NUMBER(4)                        DEFAULT 0 NOT NULL
  , folder_id                        NUMBER(4)                        DEFAULT 1 NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.filedata
(
    id                               NUMBER(4)                        NOT NULL
  , compressed                       NUMBER(4)                        NOT NULL
  , "DATA"                           BLOB                            
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005296 ON owl.filedata
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.files
(
    id                               NUMBER(4)                        NOT NULL
  , name                             VARCHAR2(255)                    DEFAULT 'Untitled' NOT NULL
  , filename                         VARCHAR2(255)                    NOT NULL
  , f_size                           NUMBER(20)                       NOT NULL
  , creatorid                        NUMBER(4)                        NOT NULL
  , "PARENT"                         NUMBER(4)                        NOT NULL
  , created                          DATE                             NOT NULL
  , description                      VARCHAR2(2048)                  
  , metadata                         VARCHAR2(2048)                  
  , "SECURITY"                       NUMBER(4)                        NOT NULL
  , groupid                          NUMBER(4)                        NOT NULL
  , smodified                        DATE                             NOT NULL
  , checked_out                      NUMBER(4)                        NOT NULL
  , major_revision                   NUMBER(4)                        NOT NULL
  , minor_revision                   NUMBER(4)                        NOT NULL
  , url                              NUMBER(4)                       
  , "PASSWORD"                       VARCHAR2(50)                    
  , doctype                          NUMBER(4)                       
  , updatorid                        NUMBER(4)                       
  , linkedto                         NUMBER(4)                       
  , approved                         NUMBER(4)                       
  , infected                         NUMBER(4)                        DEFAULT 0
  , expires                          DATE                             DEFAULT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005297 ON owl.files
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE INDEX owl.files_filetype ON owl.files
(
    url
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.files_id_trigger
BEFORE INSERT  ON owl.FILES
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT files_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.folders
(
    id                               NUMBER(4)                        NOT NULL
  , name                             VARCHAR2(255)                    DEFAULT 'Untitled Folder' NOT NULL
  , "PARENT"                         NUMBER(4)                        NOT NULL
  , description                      VARCHAR2(2048)                  
  , "SECURITY"                       VARCHAR2(5)                      NOT NULL
  , groupid                          NUMBER(4)                        NOT NULL
  , creatorid                        NUMBER(4)                        NOT NULL
  , "PASSWORD"                       VARCHAR2(50)                    
  , smodified                        DATE                            
  , linkedto                         NUMBER(4)                       
  , rss_feed                         NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005298 ON owl.folders
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.folders_id_trigger
BEFORE INSERT  ON owl.FOLDERS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT folders_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl."GROUPS"
(
    id                               NUMBER(4)                        NOT NULL
  , name                             VARCHAR2(30)                     NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005299 ON owl."GROUPS"
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.groups_id_trigger
BEFORE INSERT  ON owl.GROUPS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT groups_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.html
(
    id                               NUMBER(4)                        NOT NULL
  , table_expand_width               VARCHAR2(15)                    
  , table_collapse_width             VARCHAR2(15)                    
  , body_background                  VARCHAR2(255)                   
  , owl_logo                         VARCHAR2(255)                   
  , body_textcolor                   VARCHAR2(15)                    
  , body_link                        VARCHAR2(15)                    
  , body_vlink                       VARCHAR2(15)                    
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005300 ON owl.html
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.html_id_trigger
BEFORE INSERT  ON owl.HTML
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT html_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.membergroup
(
    userid                           NUMBER(4)                        NOT NULL
  , groupid                          NUMBER(4)                        DEFAULT NULL
  , groupadmin                       NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.metakeywords
(
    keyword_id                       NUMBER(4)                        NOT NULL
  , keyword_text                     VARCHAR2(255)                    NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.mimes
(
    filetype                         VARCHAR2(10)                     NOT NULL
  , mimetype                         VARCHAR2(50)                     NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005301 ON owl.mimes
(
    filetype
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.monitored_file
(
    id                               NUMBER(4)                        NOT NULL
  , userid                           NUMBER(4)                        NOT NULL
  , fid                              NUMBER(4)                        NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005302 ON owl.monitored_file
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.monitored_file_id_trigger
BEFORE INSERT  ON owl.MONITORED_FILE
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT monitored_file_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.monitored_folder
(
    id                               NUMBER(4)                        NOT NULL
  , userid                           NUMBER(4)                        NOT NULL
  , fid                              NUMBER(4)                        NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005303 ON owl.monitored_folder
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.monitored_folder_id_trigger
BEFORE INSERT  ON owl.MONITORED_FOLDER
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT monitored_folder_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.news
(
    id                               NUMBER(4)                        NOT NULL
  , gid                              NUMBER(4)                        NOT NULL
  , news_title                       VARCHAR2(255)                    DEFAULT 'Untitled' NOT NULL
  , news_date                        DATE                             NOT NULL
  , news                             VARCHAR2(4000)                   DEFAULT 'No news text was recorded for this item' NOT NULL
  , news_end_date                    DATE                             DEFAULT ADD_MONTHS(SYSDATE,1) NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005304 ON owl.news
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.news_id_trigger
BEFORE INSERT  ON owl.NEWS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT news_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.other_userprefs
(
    upref_id                         NUMBER(4)                        NOT NULL
  , user_id                          NUMBER(4)                       
  , email_sig                        VARCHAR2(100)                   
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005348 ON owl.other_userprefs
(
    upref_id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.other_userprefs_id_trigger
BEFORE INSERT  ON owl.OTHER_USERPREFS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN 
  SELECT OTHER_USERPREFS_ID_SEQ.NEXTVAL INTO :NEW.upref_id FROM DUAL; 
END;
/

CREATE TABLE owl.owl_log
(
    id                               NUMBER(4)                        NOT NULL
  , userid                           NUMBER(4)                       
  , filename                         VARCHAR2(255)                   
  , "PARENT"                         NUMBER(4)                       
  , action                           VARCHAR2(40)                    
  , details                          VARCHAR2(4000)                  
  , ip                               VARCHAR2(16)                    
  , agent                            VARCHAR2(255)                   
  , logdate                          DATE                             NOT NULL
  , "TYPE"                           VARCHAR2(20)                    
  , filesize                         NUMBER(20)                      
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005305 ON owl.owl_log
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.owl_log_id_trigger
BEFORE INSERT  ON owl.OWL_LOG
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT owl_log_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.peerreview
(
    reviewer_id                      NUMBER(4)                       
  , file_id                          NUMBER(4)                       
  , status                           NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.prefs
(
    id                               NUMBER(4)                        NOT NULL
  , email_from                       VARCHAR2(80)                    
  , email_fromname                   VARCHAR2(80)                    
  , email_replyto                    VARCHAR2(80)                    
  , email_server                     VARCHAR2(80)                    
  , email_subject                    VARCHAR2(60)                    
  , lookathd                         VARCHAR2(15)                    
  , lookathddel                      NUMBER(4)                       
  , def_file_security                NUMBER(4)                       
  , def_file_group_owner             NUMBER(4)                       
  , def_file_owner                   NUMBER(4)                       
  , def_file_title                   VARCHAR2(40)                    
  , def_file_meta                    VARCHAR2(40)                    
  , def_fold_security                NUMBER(4)                       
  , def_fold_group_owner             NUMBER(4)                       
  , def_fold_owner                   NUMBER(4)                       
  , max_filesize                     NUMBER(15)                      
  , tmpdir                           VARCHAR2(255)                   
  , "TIMEOUT"                        NUMBER(4)                       
  , expand                           NUMBER(4)                       
  , version_control                  NUMBER(4)                       
  , restrict_view                    NUMBER(4)                       
  , hide_backup                      NUMBER(4)                       
  , dbdump_path                      VARCHAR2(80)                    
  , gzip_path                        VARCHAR2(80)                    
  , tar_path                         VARCHAR2(80)                    
  , unzip_path                       VARCHAR2(80)                    
  , pod2html_path                    VARCHAR2(80)                    
  , pdftotext_path                   VARCHAR2(80)                    
  , wordtotext_path                  VARCHAR2(80)                    
  , file_perm                        NUMBER(4)                       
  , folder_perm                      NUMBER(4)                       
  , "LOGGING"                        NUMBER(4)                       
  , log_file                         NUMBER(4)                       
  , log_login                        NUMBER(4)                       
  , log_rec_per_page                 NUMBER(4)                       
  , rec_per_page                     NUMBER(4)                       
  , self_reg                         NUMBER(4)                       
  , self_reg_quota                   NUMBER(4)                       
  , self_reg_notify                  NUMBER(4)                       
  , self_reg_attachfile              NUMBER(4)                       
  , self_reg_disabled                NUMBER(4)                       
  , self_reg_noprefacces             NUMBER(4)                       
  , self_reg_maxsessions             NUMBER(4)                       
  , self_reg_group                   NUMBER(4)                       
  , anon_ro                          NUMBER(4)                       
  , anon_user                        NUMBER(4)                       
  , file_admin_group                 NUMBER(4)                       
  , forgot_pass                      NUMBER(4)                       
  , collect_trash                    NUMBER(4)                       
  , trash_can_location               VARCHAR2(80)                    
  , allow_popup                      NUMBER(4)                       
  , allow_custpopup                  NUMBER(4)                       
  , status_bar_location              NUMBER(4)                       
  , remember_me                      NUMBER(4)                       
  , cookie_timeout                   NUMBER(4)                       
  , use_smtp                         NUMBER(4)                       
  , use_smtp_auth                    NUMBER(4)                       
  , smtp_passwd                      VARCHAR2(40)                    
  , search_bar                       NUMBER(4)                       
  , bulk_buttons                     NUMBER(4)                       
  , action_buttons                   NUMBER(4)                       
  , folder_tools                     NUMBER(4)                       
  , pref_bar                         NUMBER(4)                       
  , smtp_auth_login                  VARCHAR2(50)                    
  , expand_disp_status               NUMBER(4)                       
  , expand_disp_doc_num              NUMBER(4)                       
  , expand_disp_doc_type             NUMBER(4)                       
  , expand_disp_title                NUMBER(4)                       
  , expand_disp_version              NUMBER(4)                       
  , expand_disp_file                 NUMBER(4)                       
  , expand_disp_size                 NUMBER(4)                       
  , expand_disp_posted               NUMBER(4)                       
  , expand_disp_modified             NUMBER(4)                       
  , expand_disp_action               NUMBER(4)                       
  , expand_disp_held                 NUMBER(4)                       
  , collapse_disp_status             NUMBER(4)                       
  , collapse_disp_doc_num            NUMBER(4)                       
  , collapse_disp_doc_type           NUMBER(4)                       
  , collapse_disp_title              NUMBER(4)                       
  , collapse_disp_version            NUMBER(4)                       
  , collapse_disp_file               NUMBER(4)                       
  , collapse_disp_size               NUMBER(4)                       
  , collapse_disp_posted             NUMBER(4)                       
  , collapse_disp_modified           NUMBER(4)                       
  , collapse_disp_action             NUMBER(4)                       
  , collapse_disp_held               NUMBER(4)                       
  , expand_search_disp_score         NUMBER(4)                       
  , expand_search_disp_folder_path   NUMBER(4)                       
  , expand_search_disp_doc_type      NUMBER(4)                       
  , expand_search_disp_file          NUMBER(4)                       
  , expand_search_disp_size          NUMBER(4)                       
  , expand_search_disp_posted        NUMBER(4)                       
  , expand_search_disp_modified      NUMBER(4)                       
  , expand_search_disp_action        NUMBER(4)                       
  , collapse_search_disp_score       NUMBER(4)                       
  , colps_search_disp_fld_path       NUMBER(4)                       
  , collapse_search_disp_doc_type    NUMBER(4)                       
  , collapse_search_disp_file        NUMBER(4)                       
  , collapse_search_disp_size        NUMBER(4)                       
  , collapse_search_disp_posted      NUMBER(4)                       
  , collapse_search_disp_modified    NUMBER(4)                       
  , collapse_search_disp_action      NUMBER(4)                       
  , hide_folder_doc_count            NUMBER(4)                       
  , old_action_icons                 NUMBER(4)                       
  , search_result_folders            NUMBER(4)                       
  , restore_file_prefix              VARCHAR2(50)                    
  , major_revision                   NUMBER(4)                       
  , minor_revision                   NUMBER(4)                       
  , doc_id_prefix                    VARCHAR2(10)                    
  , doc_id_num_digits                NUMBER(4)                       
  , view_doc_in_new_window           NUMBER(4)                       
  , admin_login_to_browse_page       NUMBER(4)                       
  , save_keywords_to_db              NUMBER(4)                       
  , self_reg_homedir                 NUMBER(4)                       
  , self_reg_firstdir                NUMBER(4)                       
  , virus_path                       VARCHAR2(80)                    
  , peer_review                      NUMBER(4)                       
  , peer_opt                         NUMBER(4)                       
  , folder_size                      NUMBER(4)                       
  , download_folder_zip              NUMBER(4)                       
  , display_password_override        NUMBER(4)                       
  , thumb_disp_status                NUMBER(4)                       
  , thumb_disp_doc_num               NUMBER(4)                       
  , thumb_disp_image_info            NUMBER(4)                       
  , thumb_disp_version               NUMBER(4)                       
  , thumb_disp_size                  NUMBER(4)                       
  , thumb_disp_posted                NUMBER(4)                       
  , thumb_disp_modified              NUMBER(4)                       
  , thumb_disp_action                NUMBER(4)                       
  , thumb_disp_held                  NUMBER(4)                       
  , thumbnails_tool_path             VARCHAR2(255)                   
  , thumbnails_video_tool_path       VARCHAR2(255)                   
  , thumbnails_video_tool_opt        VARCHAR2(255)                   
  , thumbnails                       NUMBER(4)                       
  , thumbnails_small_width           NUMBER(4)                       
  , thumbnails_med_width             NUMBER(4)                       
  , thumbnails_large_width           NUMBER(4)                       
  , thumbnail_view_columns           NUMBER(4)                       
  , rtftotext_path                   VARCHAR2(250)                    DEFAULT NULL
  , min_pass_length                  NUMBER(4)                       
  , min_username_length              NUMBER(4)                       
  , min_pass_numeric                 NUMBER(4)                       
  , min_pass_special                 NUMBER(4)                       
  , enable_lock_account              NUMBER(4)                       
  , lock_account_bad_password        NUMBER(4)                       
  , track_user_passwords             NUMBER(4)                       
  , change_password_every            NUMBER(4)                       
  , folderdescreq                    NUMBER(4)                       
  , show_user_info                   NUMBER(4)                       
  , filedescreq                      NUMBER(4)                       
  , collapse_search_disp_doc_num     NUMBER(4)                       
  , expand_search_disp_doc_num       NUMBER(4)                       
  , colps_search_disp_doc_fields     NUMBER(4)                       
  , expand_search_disp_doc_fields    NUMBER(4)                       
  , collapse_disp_doc_fields         NUMBER(4)                       
  , expand_disp_doc_fields           NUMBER(4)                       
  , self_create_homedir              NUMBER(4)                       
  , self_captcha                     NUMBER(4)                       
  , info_panel_wide                  NUMBER(4)                       
  , track_favorites                  NUMBER(4)                       
  , expand_disp_updated              NUMBER(4)                       
  , collapse_disp_updated            NUMBER(4)                       
  , expand_search_disp_updated       NUMBER(4)                       
  , collapse_search_disp_updated     NUMBER(4)                       
  , thumb_disp_updated               NUMBER(4)                       
  , default_revision                 NUMBER(4)                       
  , pdf_watermark_path               VARCHAR2(255)                   
  , pdf_custom_watermark_filepath    VARCHAR2(255)                   
  , pdf_watermarks                   NUMBER(4)                       
  , pdf_pdftk_tool_greater_than140   NUMBER(4)                       
  , machine_time_zone                NUMBER(4)                       
  , show_folder_desc_as_popup        NUMBER(4)                       
  , make_file_indexing_user_select   NUMBER(4)                       
  , turn_file_index_off              NUMBER(4)                       
  , use_wysiwyg_for_textarea         NUMBER(4)                       
  , force_ssl                        NUMBER(4)                       
  , smtp_ssl                         NUMBER(11)                      
  , smtp_port                        VARCHAR2(10)                    
  , leave_old_file_accessible        NUMBER(11)                      
  , auto_checkout_checking           NUMBER(4)                       
  , different_filename_update        NUMBER(4)                       
  , owl_maintenance_mode             NUMBER(4)                       
  , smtp_max_size                    VARCHAR2(15)                    
  , motd                             CLOB                            
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.searchidx
(
    wordid                           NUMBER(4)                        DEFAULT NULL
  , owlfileid                        NUMBER(4)                        DEFAULT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.pk_searchidx ON owl.searchidx
(
    owlfileid
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE TABLE owl.trackoldpasswd
(
    id                               NUMBER(4)                        NOT NULL
  , userid                           NUMBER(4)                        DEFAULT 0 NOT NULL
  , "PASSWORD"                       VARCHAR2(50)                     NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005336 ON owl.trackoldpasswd
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.trackoldpasswd_id_trigger
BEFORE INSERT  ON owl.TRACKOLDPASSWD
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT TRACKOLDPASSWD_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
END;
/

CREATE TABLE owl.users
(
    id                               NUMBER(4)                        NOT NULL
  , groupid                          VARCHAR2(10)                     NOT NULL
  , username                         VARCHAR2(20)                     DEFAULT 'Unnamed' NOT NULL
  , name                             VARCHAR2(50)                     DEFAULT 'Unnamed' NOT NULL
  , "PASSWORD"                       VARCHAR2(50)                     DEFAULT ' ' NOT NULL
  , quota_max                        NUMBER(16)                       NOT NULL
  , quota_current                    NUMBER(16)                       NOT NULL
  , email                            VARCHAR2(255)                   
  , notify                           NUMBER(4)                       
  , attachfile                       NUMBER(4)                       
  , disabled                         NUMBER(4)                       
  , noprefaccess                     NUMBER(4)                       
  , language                         VARCHAR2(15)                    
  , maxsessions                      NUMBER(4)                       
  , lastlogin                        DATE                             NOT NULL
  , curlogin                         DATE                             NOT NULL
  , lastnews                         NUMBER(4)                       
  , newsadmin                        NUMBER(4)                       
  , comment_notify                   NUMBER(4)                       
  , buttonstyle                      VARCHAR2(255)                   
  , homedir                          NUMBER(4)                       
  , firstdir                         NUMBER(4)                       
  , email_tool                       NUMBER(4)                       
  , change_paswd_at_login            NUMBER(4)                       
  , login_failed                     NUMBER(4)                       
  , passwd_last_changed              DATE                            
  , expire_account                   VARCHAR2(80)                    
  , user_auth                        CHAR(2)                         
  , logintonewrec                    NUMBER(4)                       
  , groupadmin                       NUMBER(4)                       
  , user_offset                      VARCHAR2(4)                     
  , useradmin                        NUMBER(4)                       
  , viewlogs                         NUMBER(4)                       
  , viewreports                      NUMBER(4)                       
  , user_default_view                NUMBER(4)                       
  , user_minor_revision              NUMBER(4)                       
  , user_major_revision              NUMBER(4)                       
  , user_default_revision            NUMBER(4)                       
  , pdf_watermarks                   NUMBER(4)                       
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.sys_c005307 ON owl.users
(
    id
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE OR REPLACE TRIGGER owl.users_id_trigger
BEFORE INSERT  ON owl.USERS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT users_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE TABLE owl.wordidx
(
    wordid                           NUMBER(4)                        DEFAULT NULL
  , word                             VARCHAR2(128)                    NOT NULL
)
PCTUSED    40
PCTFREE    10
INITRANS   1
MAXTRANS   255
LOGGING
NOCACHE
NOPARALLEL;

CREATE UNIQUE INDEX owl.pk_wordidx ON owl.wordidx
(
    word
)
LOGGING
NOCACHE
NOPARALLEL;

CREATE SEQUENCE owl.docfields_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.docfieldvalues_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.doctype_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.files_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.folders_id_seq
   START WITH       7
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.groups_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.html_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.monitored_file_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.monitored_folder_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.news_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.other_userprefs_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.owl_log_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.prefs_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.trackoldpasswd_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.users_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE SEQUENCE owl.comments_id_seq
   START WITH       1
   INCREMENT BY     1
   MINVALUE         1
   NOMAXVALUE
   NOCACHE
   NOCYCLE
   NOORDER
;

CREATE OR REPLACE TRIGGER owl.comments_id_trigger
BEFORE INSERT  ON owl.COMMENTS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT COMMENTS_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.docfields_id_trigger
BEFORE INSERT  ON owl.DOCFIELDS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT docfields_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.docfieldvalues_id_trigger
BEFORE INSERT  ON owl.DOCFIELDVALUES
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT docfieldvalues_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.doctype_id_trigger
BEFORE INSERT  ON owl.DOCTYPE
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT doctype_ID_SEQ.NEXTVAL INTO :NEW.doc_type_id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.files_id_trigger
BEFORE INSERT  ON owl.FILES
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT files_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.folders_id_trigger
BEFORE INSERT  ON owl.FOLDERS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT folders_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.groups_id_trigger
BEFORE INSERT  ON owl.GROUPS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT groups_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.html_id_trigger
BEFORE INSERT  ON owl.HTML
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT html_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.monitored_file_id_trigger
BEFORE INSERT  ON owl.MONITORED_FILE
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT monitored_file_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.monitored_folder_id_trigger
BEFORE INSERT  ON owl.MONITORED_FOLDER
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT monitored_folder_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.news_id_trigger
BEFORE INSERT  ON owl.NEWS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT news_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.other_userprefs_id_trigger
BEFORE INSERT  ON owl.OTHER_USERPREFS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN 
  SELECT OTHER_USERPREFS_ID_SEQ.NEXTVAL INTO :NEW.upref_id FROM DUAL; 
END;
/

CREATE OR REPLACE TRIGGER owl.owl_log_id_trigger
BEFORE INSERT  ON owl.OWL_LOG
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT owl_log_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.trackoldpasswd_id_trigger
BEFORE INSERT  ON owl.TRACKOLDPASSWD
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT TRACKOLDPASSWD_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
END;
/

CREATE OR REPLACE TRIGGER owl.users_id_trigger
BEFORE INSERT  ON owl.USERS
REFERENCING NEW AS NEW OLD AS OLD
FOR EACH ROW
BEGIN
  SELECT users_ID_SEQ.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/

COMMIT;

INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,'1','1','1','0','0','0','0','0','0','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','1','0','0','0','0','0','0');
INSERT INTO owl.advanced_acl (GROUP_ID,USER_ID,FILE_ID,FOLDER_ID,OWLREAD,OWLWRITE,OWLVIEWLOG,OWLDELETE,OWLCOPY,OWLMOVE,OWLPROPERTIES,OWLUPDATE,OWLCOMMENT,OWLCHECKIN,OWLEMAIL,OWLRELSEARCH,OWLSETACL,OWLMONITOR) VALUES (NULL,'0',NULL,NULL,'1','1','0','0','0','0','0','0','0','0','0','0','0','0');
COMMIT;

COMMIT;

INSERT INTO owl.doctype (DOC_TYPE_ID,DOC_TYPE_NAME) VALUES ('1','Default');
COMMIT;

INSERT INTO owl.folders (ID,NAME,PARENT,DESCRIPTION,SECURITY,GROUPID,CREATORID,PASSWORD,SMODIFIED,LINKEDTO,RSS_FEED) VALUES ('1','Documents','0',NULL,'51','0','1',NULL,TO_DATE('2012-03-10 09:00:26','YYYY-MM-DD HH24:MI:SS'),'0',NULL);
COMMIT;

INSERT INTO owl."GROUPS" (ID,NAME) VALUES ('0','Administrators');
INSERT INTO owl."GROUPS" (ID,NAME) VALUES ('1','Anonymous');
INSERT INTO owl."GROUPS" (ID,NAME) VALUES ('2','File Admin');
COMMIT;

INSERT INTO owl.html (ID,TABLE_EXPAND_WIDTH,TABLE_COLLAPSE_WIDTH,BODY_BACKGROUND,OWL_LOGO,BODY_TEXTCOLOR,BODY_LINK,BODY_VLINK) VALUES ('1','90%','50%',NULL,'owl_logo1.gif','#000000','#000000','#000000');
COMMIT;

INSERT INTO owl.membergroup (USERID,GROUPID,GROUPADMIN) VALUES ('10','0',NULL);
COMMIT;

COMMIT;

INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ai','application/postscript');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('aif','audio/x-aiff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('aifc','audio/x-aiff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('aiff','audio/x-aiff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('asc','text/plain');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('au','audio/basic');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('avi','video/x-msvideo');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('bcpio','application/x-bcpio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('bin','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('bmp','image/bmp');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('cdf','application/x-netcdf');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('class','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('cpio','application/x-cpio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('cpt','application/mac-compactpro');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('csh','application/x-csh');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('css','text/css');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('dcr','application/x-director');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('dir','application/x-director');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('dms','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('doc','application/msword');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('dvi','application/x-dvi');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('dxr','application/x-director');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('eps','application/postscript');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('etx','text/x-setext');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('exe','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ez','application/andrew-inset');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('gif','image/gif');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('gtar','application/x-gtar');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('hdf','application/x-hdf');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('hqx','application/mac-binhex40');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('htm','text/html');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('html','text/html');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ice','x-conference/x-cooltalk');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ief','image/ief');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('iges','model/iges');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('igs','model/iges');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('jpe','image/jpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('jpeg','image/jpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('jpg','image/jpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('js','application/x-javascript');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('kar','audio/midi');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('latex','application/x-latex');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('lha','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('lzh','application/octet-stream');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('man','application/x-troff-man');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('me','application/x-troff-me');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mesh','model/mesh');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mid','audio/midi');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('midi','audio/midi');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mif','application/vnd.mif');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mov','video/quicktime');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('movie','video/x-sgi-movie');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mp2','audio/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mp3','audio/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mpe','video/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mpeg','video/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mpg','video/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('mpga','audio/mpeg');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ms','application/x-troff-ms');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('msh','model/mesh');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('nc','application/x-netcdf');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('oda','application/oda');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pbm','image/x-portable-bitmap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pdb','chemical/x-pdb');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pdf','application/pdf');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pgm','image/x-portable-graymap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pgn','application/x-chess-pgn');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('png','image/png');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('pnm','image/x-portable-anymap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ppm','image/x-portable-pixmap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ppt','application/vnd.ms-powerpoint');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ps','application/postscript');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('qt','video/quicktime');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ra','audio/x-realaudio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ram','audio/x-pn-realaudio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ras','image/x-cmu-raster');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('rgb','image/x-rgb');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('rm','audio/x-pn-realaudio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('roff','application/x-troff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('rpm','audio/x-pn-realaudio-plugin');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('rtf','text/rtf');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('rtx','text/richtext');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sgm','text/sgml');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sgml','text/sgml');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sh','application/x-sh');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('shar','application/x-shar');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('silo','model/mesh');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sit','application/x-stuffit');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('skd','application/x-koan');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('skm','application/x-koan');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('skp','application/x-koan');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('skt','application/x-koan');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('smi','application/smil');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('smil','application/smil');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('snd','audio/basic');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('spl','application/x-futuresplash');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('src','application/x-wais-source');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sv4cpio','application/x-sv4cpio');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sv4crc','application/x-sv4crc');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('swf','application/x-shockwave-flash');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('t','application/x-troff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tar','application/x-tar');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tcl','application/x-tcl');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tex','application/x-tex');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('texi','application/x-texinfo');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('texinfo','application/x-texinfo');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tif','image/tiff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tiff','image/tiff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tr','application/x-troff');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tsv','text/tab-separated-values');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('txt','text/plain');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('ustar','application/x-ustar');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('vcd','application/x-cdlink');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('vrml','model/vrml');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('wav','audio/x-wav');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('wrl','model/vrml');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xbm','image/x-xbitmap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xls','application/vnd.ms-excel');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xml','text/xml');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xpm','image/x-xpixmap');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xwd','image/x-xwindowdump');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('xyz','chemical/x-pdb');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('zip','application/zip');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('gz','application/x-gzip');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('tgz','application/x-gzip');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxw','application/vnd.sun.xml.writer');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('stw','application/vnd.sun.xml.writer.template');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxg','application/vnd.sun.xml.writer.global');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxc','application/vnd.sun.xml.calc');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('stc','application/vnd.sun.xml.calc.template');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxi','application/vnd.sun.xml.impress');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sti','application/vnd.sun.xml.impress.template');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxd','application/vnd.sun.xml.draw');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('std','application/vnd.sun.xml.draw.template');
INSERT INTO owl.mimes (FILETYPE,MIMETYPE) VALUES ('sxm','application/vnd.sun.xml.math');
COMMIT;

INSERT INTO owl.other_userprefs (UPREF_ID,USER_ID,EMAIL_SIG) VALUES ('1','12',NULL);
COMMIT;

INSERT INTO owl.prefs (ID,EMAIL_FROM,EMAIL_FROMNAME,EMAIL_REPLYTO,EMAIL_SERVER,EMAIL_SUBJECT,LOOKATHD,LOOKATHDDEL,DEF_FILE_SECURITY,DEF_FILE_GROUP_OWNER,DEF_FILE_OWNER,DEF_FILE_TITLE,DEF_FILE_META,DEF_FOLD_SECURITY,DEF_FOLD_GROUP_OWNER,DEF_FOLD_OWNER,MAX_FILESIZE,TMPDIR,TIMEOUT,EXPAND,VERSION_CONTROL,RESTRICT_VIEW,HIDE_BACKUP,DBDUMP_PATH,GZIP_PATH,TAR_PATH,UNZIP_PATH,POD2HTML_PATH,PDFTOTEXT_PATH,WORDTOTEXT_PATH,FILE_PERM,FOLDER_PERM,LOGGING,LOG_FILE,LOG_LOGIN,LOG_REC_PER_PAGE,REC_PER_PAGE,SELF_REG,SELF_REG_QUOTA,SELF_REG_NOTIFY,SELF_REG_ATTACHFILE,SELF_REG_DISABLED,SELF_REG_NOPREFACCES,SELF_REG_MAXSESSIONS,SELF_REG_GROUP,ANON_RO,ANON_USER,FILE_ADMIN_GROUP,FORGOT_PASS,COLLECT_TRASH,TRASH_CAN_LOCATION,ALLOW_POPUP,ALLOW_CUSTPOPUP,STATUS_BAR_LOCATION,REMEMBER_ME,COOKIE_TIMEOUT,USE_SMTP,USE_SMTP_AUTH,SMTP_PASSWD,SEARCH_BAR,BULK_BUTTONS,ACTION_BUTTONS,FOLDER_TOOLS,PREF_BAR,SMTP_AUTH_LOGIN,EXPAND_DISP_STATUS,EXPAND_DISP_DOC_NUM,EXPAND_DISP_DOC_TYPE,EXPAND_DISP_TITLE,EXPAND_DISP_VERSION,EXPAND_DISP_FILE,EXPAND_DISP_SIZE,EXPAND_DISP_POSTED,EXPAND_DISP_MODIFIED,EXPAND_DISP_ACTION,EXPAND_DISP_HELD,COLLAPSE_DISP_STATUS,COLLAPSE_DISP_DOC_NUM,COLLAPSE_DISP_DOC_TYPE,COLLAPSE_DISP_TITLE,COLLAPSE_DISP_VERSION,COLLAPSE_DISP_FILE,COLLAPSE_DISP_SIZE,COLLAPSE_DISP_POSTED,COLLAPSE_DISP_MODIFIED,COLLAPSE_DISP_ACTION,COLLAPSE_DISP_HELD,EXPAND_SEARCH_DISP_SCORE,EXPAND_SEARCH_DISP_FOLDER_PATH,EXPAND_SEARCH_DISP_DOC_TYPE,EXPAND_SEARCH_DISP_FILE,EXPAND_SEARCH_DISP_SIZE,EXPAND_SEARCH_DISP_POSTED,EXPAND_SEARCH_DISP_MODIFIED,EXPAND_SEARCH_DISP_ACTION,COLLAPSE_SEARCH_DISP_SCORE,COLPS_SEARCH_DISP_FLD_PATH,COLLAPSE_SEARCH_DISP_DOC_TYPE,COLLAPSE_SEARCH_DISP_FILE,COLLAPSE_SEARCH_DISP_SIZE,COLLAPSE_SEARCH_DISP_POSTED,COLLAPSE_SEARCH_DISP_MODIFIED,COLLAPSE_SEARCH_DISP_ACTION,HIDE_FOLDER_DOC_COUNT,OLD_ACTION_ICONS,SEARCH_RESULT_FOLDERS,RESTORE_FILE_PREFIX,MAJOR_REVISION,MINOR_REVISION,DOC_ID_PREFIX,DOC_ID_NUM_DIGITS,VIEW_DOC_IN_NEW_WINDOW,ADMIN_LOGIN_TO_BROWSE_PAGE,SAVE_KEYWORDS_TO_DB,SELF_REG_HOMEDIR,SELF_REG_FIRSTDIR,VIRUS_PATH,PEER_REVIEW,PEER_OPT,FOLDER_SIZE,DOWNLOAD_FOLDER_ZIP,DISPLAY_PASSWORD_OVERRIDE,THUMB_DISP_STATUS,THUMB_DISP_DOC_NUM,THUMB_DISP_IMAGE_INFO,THUMB_DISP_VERSION,THUMB_DISP_SIZE,THUMB_DISP_POSTED,THUMB_DISP_MODIFIED,THUMB_DISP_ACTION,THUMB_DISP_HELD,THUMBNAILS_TOOL_PATH,THUMBNAILS_VIDEO_TOOL_PATH,THUMBNAILS_VIDEO_TOOL_OPT,THUMBNAILS,THUMBNAILS_SMALL_WIDTH,THUMBNAILS_MED_WIDTH,THUMBNAILS_LARGE_WIDTH,THUMBNAIL_VIEW_COLUMNS,RTFTOTEXT_PATH,MIN_PASS_LENGTH,MIN_USERNAME_LENGTH,MIN_PASS_NUMERIC,MIN_PASS_SPECIAL,ENABLE_LOCK_ACCOUNT,LOCK_ACCOUNT_BAD_PASSWORD,TRACK_USER_PASSWORDS,CHANGE_PASSWORD_EVERY,FOLDERDESCREQ,SHOW_USER_INFO,FILEDESCREQ,COLLAPSE_SEARCH_DISP_DOC_NUM,EXPAND_SEARCH_DISP_DOC_NUM,COLPS_SEARCH_DISP_DOC_FIELDS,EXPAND_SEARCH_DISP_DOC_FIELDS,COLLAPSE_DISP_DOC_FIELDS,EXPAND_DISP_DOC_FIELDS,SELF_CREATE_HOMEDIR,SELF_CAPTCHA,INFO_PANEL_WIDE,TRACK_FAVORITES,EXPAND_DISP_UPDATED,COLLAPSE_DISP_UPDATED,EXPAND_SEARCH_DISP_UPDATED,COLLAPSE_SEARCH_DISP_UPDATED,THUMB_DISP_UPDATED,DEFAULT_REVISION,PDF_THUMB_PATH,PDF_WATERMARK_PATH,PDF_CUSTOM_WATERMARK_FILEPATH,PDF_WATERMARKS,PDF_PDFTK_TOOL_GREATER_THAN140,MACHINE_TIME_ZONE,SHOW_FOLDER_DESC_AS_POPUP,MAKE_FILE_INDEXING_USER_SELECT,TURN_FILE_INDEX_OFF,USE_WYSIWYG_FOR_TEXTAREA,FORCE_SSL,SMTP_SSL,SMTP_PORT,LEAVE_OLD_FILE_ACCESSIBLE,AUTO_CHECKOUT_CHECKING,DIFFERENT_FILENAME_UPDATE,OWL_MAINTENANCE_MODE,SMTP_MAX_SIZE,MOTD) VALUES ('1','owl@yourdomain.com','OWL','owl@yourdomain.com','localhost','[OWL] : AUTOMATED MAIL','false','1','0','0','1',NULL,NULL,'0','0','1','0','/tmp','9000','1','1','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0','0','0','0','0','0','1','0','0','0','0','0','-1','0','1','2','2','0','0',NULL,'0','0','1','0','9000','1','0',NULL,'1','1','1','1','1',NULL,'1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','0','0','0','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','1','0','1',NULL,'1','0',NULL,'3','0','0','0','1','1',NULL,'0','0','1','1','0','0','0','0','0','0','0','0','0','0','/usr/bin/convert','/usr/local/bin/mplayer',' -vo png -ss 0:05 -frames 2 -nosound -really-quiet','1','100','200','400','4',NULL,'0','0','0','0','0','0','0','0','0','1','0','0','0','0','0','0','0','0','1','1','1','1','0','0','0','0','2','/usr/bin/pdftk',NULL,'1','0','0','1','0','0','0','0','0','25','0','0','1','0','5242880',NULL);
COMMIT;

COMMIT;

INSERT INTO owl.users (ID,GROUPID,USERNAME,NAME,PASSWORD,QUOTA_MAX,QUOTA_CURRENT,EMAIL,NOTIFY,ATTACHFILE,DISABLED,NOPREFACCESS,LANGUAGE,MAXSESSIONS,LASTLOGIN,CURLOGIN,LASTNEWS,NEWSADMIN,COMMENT_NOTIFY,BUTTONSTYLE,HOMEDIR,FIRSTDIR,EMAIL_TOOL,CHANGE_PASWD_AT_LOGIN,LOGIN_FAILED,PASSWD_LAST_CHANGED,EXPIRE_ACCOUNT,USER_AUTH,LOGINTONEWREC,GROUPADMIN,USER_OFFSET,USERADMIN,VIEWLOGS,VIEWREPORTS,USER_DEFAULT_VIEW,USER_MINOR_REVISION,USER_MAJOR_REVISION,USER_DEFAULT_REVISION,PDF_WATERMARKS) VALUES ('10','0','admin','Administrator','21232f297a57a5a743894a0e4a801fc3','0','0','imanol.e@euskalnet.net','0','0','0','0','Spanish','0',TO_DATE('2012-03-15 00:00:00','YYYY-MM-DD HH24:MI:SS'),TO_DATE('2012-03-19 19:42:04','YYYY-MM-DD HH24:MI:SS'),'8','0','1','rsdx_blue1','1','1','1','0','0',TO_DATE('2012-03-11 07:16:36','YYYY-MM-DD HH24:MI:SS'),NULL,NULL,'0','0','-5','0','0','0','1','0','1','2','0');
INSERT INTO owl.users (ID,GROUPID,USERNAME,NAME,PASSWORD,QUOTA_MAX,QUOTA_CURRENT,EMAIL,NOTIFY,ATTACHFILE,DISABLED,NOPREFACCESS,LANGUAGE,MAXSESSIONS,LASTLOGIN,CURLOGIN,LASTNEWS,NEWSADMIN,COMMENT_NOTIFY,BUTTONSTYLE,HOMEDIR,FIRSTDIR,EMAIL_TOOL,CHANGE_PASWD_AT_LOGIN,LOGIN_FAILED,PASSWD_LAST_CHANGED,EXPIRE_ACCOUNT,USER_AUTH,LOGINTONEWREC,GROUPADMIN,USER_OFFSET,USERADMIN,VIEWLOGS,VIEWREPORTS,USER_DEFAULT_VIEW,USER_MINOR_REVISION,USER_MAJOR_REVISION,USER_DEFAULT_REVISION,PDF_WATERMARKS) VALUES ('11','1','guest','Anonymous','21232f297a57a5a743894a0e4a801fc3','0','0',NULL,'0','0','0','1','English','19',TO_DATE('2012-03-11 07:17:48','YYYY-MM-DD HH24:MI:SS'),TO_DATE('2012-03-11 07:17:48','YYYY-MM-DD HH24:MI:SS'),'0','0','0','rsdx_blue1','1','1','0','0','0',TO_DATE('2012-03-11 07:17:48','YYYY-MM-DD HH24:MI:SS'),NULL,'0 ','0','0',NULL,'0','0','0','1','0','1','2','0');
COMMIT;

COMMIT;

