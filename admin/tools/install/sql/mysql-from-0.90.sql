alter TABLE folders add column linkedto int(4);
alter TABLE folders add column rss_feed int(4);

alter TABLE prefs add column pdf_watermark_path varchar(255);
alter TABLE prefs add column pdf_custom_watermark_filepath varchar(255);
alter TABLE prefs add column pdf_watermarks int(4);
alter TABLE prefs add column pdf_pdftk_tool_greater_than_1_40 int(4);
alter TABLE prefs add column machine_time_zone int(4);
alter TABLE prefs add column show_folder_desc_as_popup int(4);
alter TABLE prefs add column use_wysiwyg_for_textarea int(4);
alter TABLE prefs add column make_file_indexing_user_selectable int(4);
alter TABLE prefs add column turn_file_index_off int(4);
alter TABLE prefs add column force_ssl int(4);
alter table prefs add column leave_old_file_accessible int(4);
alter table prefs add column auto_checkout_checking int(4);
alter table prefs add column different_filename_update int(4);
alter table prefs add column  owl_maintenance_mode int(4);
alter table prefs add column motd text;
alter table prefs add column smtp_ssl int(4);
alter table prefs add column smtp_port int(4);
alter table prefs add column smtp_max_size int(4);
alter TABLE prefs add column pdf_thumb_path varchar(255);
alter table owl_log add column filesize bigint(20);

alter TABLE users add column pdf_watermarks int(4);
alter table users add column user_default_view int(4);
alter table users add column user_minor_revision  int(4);
alter table users add column user_major_revision int(4);
alter table users add column user_default_revision  int(4);
alter table prefs add column default_revision  int(4);
update users set user_minor_revision ='0', user_major_revision = '1', user_default_revision='2';
update prefs set owl_maintenance_mode ='0';


INSERT INTO mimes VALUES ('docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
INSERT INTO mimes VALUES ('xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
INSERT INTO mimes VALUES ('pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');

alter table favorites add column fav_label varchar(255);
alter table files add column infected int(4) default '0';
alter table files add column expires datetime default NULL;



CREATE TABLE other_userprefs (
  upref_id int(4) NOT NULL auto_increment,
  user_id int(4) default NULL,
  email_sig text,
  user_phone varchar(30) default NULL,
  user_department varchar(255) default NULL,
  user_address varchar(255) default NULL,
  user_note text default NULL,
  PRIMARY KEY  (upref_id)

);

CREATE TABLE file_checksum (
  file_id int(4) NOT NULL default '0',
  hash1 text,
  hash2 text,
  hash3 text,
  signature text,
  PRIMARY KEY  (file_id)
);

CREATE TABLE `ext_dictionary` (
  `idDictionary` int(11) NOT NULL AUTO_INCREMENT,
  `tableName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`idDictionary`),
  KEY `idDictionary` (`idDictionary`),
  KEY `tableName` (`tableName`),
  KEY `description` (`description`)
);


INSERT INTO `ext_dictionary` (`idDictionary`, `tableName`, `description`) VALUES
(1, 'ut_entities', 'Entities');

CREATE TABLE `ut_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) NOT NULL,
  `descr2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO `ut_entities` (`id`, `descr`, `descr2`) VALUES
(1, 'Betar', ''),
(2, 'Carlos A. Gonçves, Lda.', ''),
(3, 'Orlando Filipe Rodrigues Nunes', ''),
(4, 'PAJ Grupo, Construçs', ''),
(5, 'Loja CDI', ''),
(6, 'Papelaria Fernandes', ''),
(7, 'Profico', ''),
(8, 'J L Câio Martins - Projectos de Estruturas, Lda.', ''),
(9, 'EC - Estudo Civil, Lda.', ''),
(10, 'Auto Estrada do Mar.o, S. A.', '');

alter TABLE active_sessions add column dl_count int(11);
alter TABLE active_sessions add column dl_byte_count int(11);

alter table prefs add column `ppttotext_path` varchar(80) default NULL;
alter table prefs add column `docRel` int(4) default NULL;
alter table files add column `name_search` varchar(255) NOT NULL;
alter table files add column `filename_search` varchar(255) NOT NULL;
alter table files add column `description_search` varchar(255) NOT NULL;
alter table files add column `metadata_search` varchar(255) NOT NULL;

