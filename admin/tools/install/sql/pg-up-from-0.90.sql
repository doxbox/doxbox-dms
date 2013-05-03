alter table users add column user_default_view int4;
alter table users add column user_minor_revision  int4;
alter table users add column user_major_revision int4;
alter table users add column user_default_revision  int4;


alter table files add column expires timestamp;
alter table files add column infected int4;
alter table files alter column infected set default '0';

alter table prefs add column motd text;

alter TABLE folders add column linkedto int4;
alter TABLE folders add column rss_feed int4;


CREATE TABLE file_checksum (
  file_id int4 NOT NULL default '0',
  hash1 text,
  hash2 text,
  hash3 text,
  signature text,
  PRIMARY KEY  (file_id)
);


alter TABLE prefs add column pdf_watermark_path varchar(255);
alter TABLE prefs add column pdf_custom_watermark_filepath varchar(255);
alter TABLE prefs add column pdf_watermarks int4;
alter TABLE prefs add column pdf_pdftk_tool_greater_than_1_40 int4;
alter TABLE prefs add column machine_time_zone int4;
alter TABLE prefs add column show_folder_desc_as_popup int4;
alter TABLE prefs add column use_wysiwyg_for_textarea int4;
alter TABLE prefs add column make_file_indexing_user_selectable int4;
alter table prefs add column  owl_maintenance_mode int4;
alter TABLE prefs add column turn_file_index_off int4;
alter TABLE prefs add column force_ssl int4;
alter table prefs add column leave_old_file_accessible int4;
alter table prefs add column auto_checkout_checking int4;
alter table prefs add column different_filename_update int4;
alter table prefs add column smtp_ssl int4;
alter table prefs add column smtp_port int4;
alter table prefs add column smtp_max_size int4;

alter table owl_log add column filesize bigint;
alter table prefs add column default_revision  int4;

alter TABLE users add column pdf_watermarks int4;


INSERT INTO mimes VALUES ('docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
INSERT INTO mimes VALUES ('xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
INSERT INTO mimes VALUES ('pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');

alter table favorites add column fav_label varchar(255);


CREATE TABLE other_userprefs (
  upref_id int4 NOT NULL auto_increment,
  user_id int4 default NULL,
  email_sig text,
  PRIMARY KEY  (upref_id)

);

