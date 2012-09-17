<?php

$sql = array();

// "form_templates" table
$sql[] = "
CREATE TABLE `%PREFIX%form_templates` (
  `field_id` mediumint(8) unsigned NOT NULL auto_increment,
  `form_id` mediumint(8) unsigned NOT NULL default '0',
  `field_name` varchar(255) NOT NULL default '',
  `field_test_value` blob,
  `field_size` enum('tiny','small','medium','large','very_large') default 'small',
  `field_type` enum('select','multi-select','radio-buttons','checkboxes','other') NOT NULL default 'other',
  `field_title` varchar(100) default NULL,
  `col_name` varchar(100) default NULL,
  `list_order` smallint(5) unsigned default NULL,
  `admin_display` enum('yes','no') default 'no',
  `is_sortable` enum('yes','no') NOT NULL default 'yes',
  `include_on_redirect` enum('yes','no') NOT NULL default 'no',
  `option_orientation` enum('vertical','horizontal') NOT NULL default 'vertical',
  PRIMARY KEY  (`field_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 %CHARSET%
	  	 ";

// "forms" table
$sql[] = "
CREATE TABLE `%PREFIX%forms` (
  `form_id` mediumint(9) unsigned NOT NULL auto_increment,
  `user_id` mediumint(9) unsigned NOT NULL default '0',
  `form_type` enum('direct','code') NOT NULL default 'direct',
  `is_active` enum('yes','no') NOT NULL default 'no',
  `is_initialized` enum('yes','no') NOT NULL default 'no',
  `is_complete` enum('yes','no') NOT NULL default 'no',
  `form_name` varchar(255) NOT NULL default '',
  `form_url` varchar(255) NOT NULL default '',
  `redirect_url` varchar(255) default NULL,
  `finalized_submissions` enum('yes','no') NOT NULL default 'yes',
  `auto_email_admin` enum('yes','no') default 'no',
  `auto_email_user` enum('yes','no') NOT NULL default 'no',
  `admin_email_recipients` text,
  `user_email_field` varchar(255) default NULL,
  `user_first_name_field` varchar(255) default NULL,
  `user_last_name_field` varchar(255) default NULL,
  `admin_email_from` enum('admin_email','users_name') default NULL,
  `admin_email_reply_to` enum('admin_email','users_name','none') default NULL,
  `user_email_from` enum('admin_email','users_name') default NULL,
  `user_email_reply_to` enum('admin_email','users_name','none') default NULL,
  `email_format` enum('text','html','both') NOT NULL default 'both',
  `admin_text_email_template` mediumtext,
  `admin_html_email_template` mediumtext,
  `user_text_email_template` mediumtext,
  `user_html_email_template` mediumtext,
  `num_submissions_per_page` smallint(6) NOT NULL default '0',
  `default_sort_field` varchar(255) default 'submission_date',
  `default_sort_field_order` enum('asc','desc') NOT NULL default 'desc',
  `printer_friendly_format` enum('table','one_per_page','one_by_one') NOT NULL default 'table',
  `hide_printer_friendly_empty_fields` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`form_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 %CHARSET%
	  	 ";

// "field_options" table
$sql[] = "
  CREATE TABLE `%PREFIX%field_options` (
    `option_id` mediumint(9) NOT NULL auto_increment,
    `field_id` mediumint(8) unsigned NOT NULL,
    `option_value` varchar(255) NOT NULL,
    `option_name` varchar(255) NOT NULL,
    `option_order` smallint(6) NOT NULL,
    PRIMARY KEY  (`option_id`)
  ) TYPE=MyISAM AUTO_INCREMENT=1 %CHARSET%
            ";

// "settings" table
$sql[] = "
CREATE TABLE `%PREFIX%settings` (
  `setting_id` mediumint(9) NOT NULL auto_increment,
  `setting_name` varchar(50) NOT NULL default '',
  `setting_value` text NOT NULL,
  PRIMARY KEY  (`setting_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 %CHARSET%
	  	 ";

// "user_accounts" table
$sql[] = "
CREATE TABLE `%PREFIX%user_accounts` (
  `user_id` mediumint(8) unsigned NOT NULL auto_increment,
  `account_type` enum('admin','client') NOT NULL default 'client',
  `active` enum('yes','no') NOT NULL default 'no',
  `first_name` varchar(100) default NULL,
  `last_name` varchar(100) default NULL,
  `email` varchar(200) default NULL,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `company` varchar(255) default NULL,
  `page_titles` varchar(255) default NULL,
  `footer_text` varchar(255) default NULL,
  `logo` varchar(255) default NULL,
  `css` text,
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 %CHARSET%
	  	 ";

       
// add default values for "settings" table
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'num_clients_per_page', '10')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'default_css', '/* GENERAL STYLES */\r\np, td, tr, table, div, input, select, textarea { font-family: arial; font-size: 8pt; color: black; }\r\nbody { color: #ffffff; margin: 0px; }\r\na:link, a:visited { color: #336699; }\r\n\r\n/* NAV LINKS */\r\n.nav_link { width: 150px; }\r\n.nav_link a { width: 100%; display: block; padding: 6px; }\r\n.nav_link a:hover { color: black; }\r\n.nav_link_selected { padding: 6px; font-weight: bold; }\r\n\r\n/* PAGE SECTIONS */\r\n.top_banner { background-color: #cccccc; }\r\n.top_row_left { background-color: #000000; }\r\n.top_row_right { background-color: #333333; }\r\n.left_column { background-color: #efefef; }\r\n.footer { background-color: #efefef; height: 30px; text-align: center;}\r\n\r\n.title { font-family: arial; letter-spacing: 4px; font-size: 8pt; color: #336699; padding-bottom: 5px; font-weight: bold; }\r\n.form_status_online { color: green; }\r\n.form_status_offline { color: red; }\r\n\r\n/* TABLES */\r\n.list_table { border: 1px solid #cccccc; width: 550px; }\r\n.list_table th { background-color: #336699; color: white; }\r\n.list_table th a, .list_table th a:visited { color: white; text-decoration: none; }\r\n.list_table td { background-color: #efefef; }\r\n.list_table_th_edit { background-color: #dddddd; }\r\n.list_table_td_edit { background-color: #dddddd; }\r\n\r\n/* MESSAGES */\r\n.notify { border: 1px solid #336699; background-color: #ffffee; color: #336699; padding: 8px; width: 400px; }\r\n.error { border: 1px solid #cc0000; background-color: #ffffee; color: #cc0000; padding: 8px; width: 400px; }\r\n\r\n/* PRINT PREVIEW PAGE */\r\n.print_title { font-family: arial; font-size: 14px; font-weight: bold; }\r\n.print_table { border: 1px solid #dddddd; }\r\n.print_table th { border: 1px solid #cccccc; background-color: #efefef; }\r\n.print_table td { border: 1px solid #cccccc; }\r\n.print_th { text-align: left; }\r\n\r\n/* LOGIN / FORGET PWD PAGES */\r\n.login_outer_table { border: 1px solid #999999; }\r\n.login_inner_table { background-color: #999999; }\r\n.login_table_text { color: #ffffcc; padding-left: 10px; padding-right: 10px; }\r\n.login_error { background-color: #efefef; }\r\n\r\n/* MISC */\r\n.common_width { width: 550px; }\r\n.page_break { page-break-after: always; }\r\n')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'default_num_submissions_per_page', '10')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'program_name', 'Form Tools')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'program_version', '1.2.1')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'footer_text', 'Form Tools')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'logout_url', '$root_url')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'timezone_offset', '0')";
$sql[] = "INSERT INTO `%PREFIX%settings` VALUES (NULL, 'date_format', 'M jS, g:i A')";

?>
