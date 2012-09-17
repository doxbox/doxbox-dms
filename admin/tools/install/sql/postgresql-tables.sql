-- TOC entry 5 (OID 55445)
-- Name: active_sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE active_sessions (
    sessid character varying(32) NOT NULL,
    usid character varying(25),
    lastused bigint,
    ip character varying(16),
    currentdb integer
);


--
-- TOC entry 6 (OID 55449)
-- Name: membergroup; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE membergroup (
    userid integer NOT NULL,
    groupid integer,
    groupadmin integer
);


--
-- TOC entry 7 (OID 55451)
-- Name: favorites; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE favorites (
    userid integer DEFAULT 0 NOT NULL,
    folder_id integer DEFAULT 1 NOT NULL,
    fav_label character varying(255)
);


--
-- TOC entry 8 (OID 55457)
-- Name: folders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE folders (
    id serial NOT NULL,
    name character varying(255) NOT NULL,
    parent integer NOT NULL,
    description text,
    "security" character varying(5) NOT NULL,
    groupid integer NOT NULL,
    creatorid integer NOT NULL,
    "password" character varying(50) DEFAULT ''::character varying NOT NULL,
    smodified timestamp without time zone,
    linkedto integer,
    rss_feed integer
);


--
-- TOC entry 9 (OID 55469)
-- Name: files; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE files (
    id serial NOT NULL,
    name character varying(80) NOT NULL,
    filename character varying(255) NOT NULL,
    f_size bigint NOT NULL,
    creatorid integer NOT NULL,
    parent integer NOT NULL,
    created timestamp without time zone NOT NULL,
    description text NOT NULL,
    metadata text NOT NULL,
    "security" integer NOT NULL,
    groupid integer NOT NULL,
    smodified timestamp without time zone NOT NULL,
    checked_out integer DEFAULT 0 NOT NULL,
    major_revision integer DEFAULT 0 NOT NULL,
    minor_revision integer DEFAULT 1 NOT NULL,
    url integer DEFAULT 0 NOT NULL,
    "password" character varying(50) DEFAULT ''::character varying NOT NULL,
    doctype integer DEFAULT 0,
    updatorid integer DEFAULT 1,
    linkedto integer DEFAULT 0,
    approved integer DEFAULT 0,
    expires timestamp without time zone,
    infected integer DEFAULT 0
);


--
-- TOC entry 10 (OID 55489)
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE comments (
    id serial NOT NULL,
    fid integer NOT NULL,
    userid integer,
    comment_date timestamp without time zone NOT NULL,
    comments text NOT NULL
);


--
-- TOC entry 11 (OID 55499)
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE news (
    id serial NOT NULL,
    gid integer NOT NULL,
    news_title character varying(255) NOT NULL,
    news_date timestamp without time zone NOT NULL,
    news text NOT NULL,
    news_end_date timestamp without time zone NOT NULL
);


--
-- TOC entry 12 (OID 55509)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id serial NOT NULL,
    groupid character varying(10) NOT NULL,
    username character varying(20) NOT NULL,
    name character varying(50) NOT NULL,
    "password" character varying(50) NOT NULL,
    quota_max bigint NOT NULL,
    quota_current bigint NOT NULL,
    email character varying(255),
    "notify" integer,
    attachfile integer,
    disabled integer,
    noprefaccess integer,
    "language" character varying(15),
    maxsessions integer NOT NULL,
    lastlogin timestamp without time zone NOT NULL,
    curlogin timestamp without time zone NOT NULL,
    lastnews integer,
    newsadmin integer NOT NULL,
    comment_notify integer,
    buttonstyle character varying(255),
    homedir integer,
    firstdir integer,
    email_tool integer,
    change_paswd_at_login integer,
    login_failed integer,
    passwd_last_changed timestamp without time zone,
    expire_account character varying(80),
    user_auth character(2),
    logintonewrec integer,
    groupadmin integer,
    user_offset character varying(4),
    useradmin integer,
    viewlogs integer,
    viewreports integer,
    user_default_view integer,
    user_major_revision integer,
    user_minor_revision integer,
    pdf_watermarks integer
);

--
-- TOC entry 13 (OID 55518)
-- Name: html; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE html (
    id serial NOT NULL,
    table_expand_width character varying(15),
    table_collapse_width character varying(15),
    body_background character varying(255),
    owl_logo character varying(255),
    body_textcolor character varying(15),
    body_link character varying(15),
    body_vlink character varying(15)
);

INSERT INTO html VALUES (1,'90%','50%','','owl_logo1.gif','#000000','#000000','#000000');

--
-- TOC entry 14 (OID 55524)
-- Name: prefs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE prefs (
    id serial NOT NULL,
    email_from character varying(80),
    email_fromname character varying(80),
    email_replyto character varying(80),
    email_server character varying(80),
    email_subject character varying(60),
    lookathd character varying(15),
    lookathddel integer,
    def_file_security integer,
    def_file_group_owner integer,
    def_file_owner integer,
    def_file_title character varying(40),
    def_file_meta character varying(40),
    def_fold_security integer,
    def_fold_group_owner integer,
    def_fold_owner integer,
    max_filesize integer,
    tmpdir character varying(255),
    timeout integer,
    expand integer,
    version_control integer,
    restrict_view integer,
    hide_backup integer,
    dbdump_path character varying(80),
    gzip_path character varying(80),
    tar_path character varying(80),
    unzip_path character varying(80),
    pod2html_path character varying(80),
    pdftotext_path character varying(80),
    wordtotext_path character varying(80),
    file_perm integer,
    folder_perm integer,
    logging integer,
    log_file integer,
    log_login integer,
    log_rec_per_page integer,
    rec_per_page integer,
    self_reg integer,
    self_reg_quota integer,
    self_reg_notify integer,
    self_reg_attachfile integer,
    self_reg_disabled integer,
    self_reg_noprefacces integer,
    self_reg_maxsessions integer,
    self_reg_group integer,
    anon_ro integer,
    anon_user integer,
    file_admin_group integer,
    forgot_pass integer,
    collect_trash integer,
    trash_can_location character varying(80),
    allow_popup integer,
    allow_custpopup integer,
    status_bar_location integer,
    remember_me integer,
    cookie_timeout integer,
    use_smtp integer,
    use_smtp_auth integer,
    smtp_passwd character varying(40),
    search_bar integer,
    bulk_buttons integer,
    action_buttons integer,
    folder_tools integer,
    pref_bar integer,
    smtp_auth_login character varying(50),
    expand_disp_status integer,
    expand_disp_doc_num integer,
    expand_disp_doc_type integer,
    expand_disp_title integer,
    expand_disp_version integer,
    expand_disp_file integer,
    expand_disp_size integer,
    expand_disp_posted integer,
    expand_disp_modified integer,
    expand_disp_action integer,
    expand_disp_held integer,
    collapse_disp_status integer,
    collapse_disp_doc_num integer,
    collapse_disp_doc_type integer,
    collapse_disp_title integer,
    collapse_disp_version integer,
    collapse_disp_file integer,
    collapse_disp_size integer,
    collapse_disp_posted integer,
    collapse_disp_modified integer,
    collapse_disp_action integer,
    collapse_disp_held integer,
    expand_search_disp_score integer,
    expand_search_disp_folder_path integer,
    expand_search_disp_doc_type integer,
    expand_search_disp_file integer,
    expand_search_disp_size integer,
    expand_search_disp_posted integer,
    expand_search_disp_modified integer,
    expand_search_disp_action integer,
    collapse_search_disp_score integer,
    colps_search_disp_fld_path integer,
    collapse_search_disp_doc_type integer,
    collapse_search_disp_file integer,
    collapse_search_disp_size integer,
    collapse_search_disp_posted integer,
    collapse_search_disp_modified integer,
    collapse_search_disp_action integer,
    hide_folder_doc_count integer,
    old_action_icons integer,
    search_result_folders integer,
    restore_file_prefix character varying(50),
    major_revision integer,
    minor_revision integer,
    doc_id_prefix character varying(10),
    doc_id_num_digits integer,
    view_doc_in_new_window integer,
    admin_login_to_browse_page integer,
    save_keywords_to_db integer,
    self_reg_homedir integer,
    self_reg_firstdir integer,
    virus_path character varying(80),
    peer_review integer,
    peer_opt integer,
    folder_size integer,
    download_folder_zip integer,
    display_password_override integer,
    thumb_disp_status integer,
    thumb_disp_doc_num integer,
    thumb_disp_image_info integer,
    thumb_disp_version integer,
    thumb_disp_size integer,
    thumb_disp_posted integer,
    thumb_disp_modified integer,
    thumb_disp_action integer,
    thumb_disp_held integer,
    thumbnails_tool_path character varying(255),
    thumbnails_video_tool_path character varying(255),
    thumbnails_video_tool_opt character varying(255),
    thumbnails integer,
    thumbnails_small_width integer,
    thumbnails_med_width integer,
    thumbnails_large_width integer,
    thumbnail_view_columns integer,
    rtftotext_path character varying(250),
    min_pass_length integer,
    min_username_length integer,
    min_pass_numeric integer,
    min_pass_special integer,
    enable_lock_account integer,
    lock_account_bad_password integer,
    track_user_passwords integer,
    change_password_every integer,
    folderdescreq integer,
    show_user_info integer,
    filedescreq integer,
    collapse_search_disp_doc_num integer,
    expand_search_disp_doc_num integer,
    colps_search_disp_doc_fields integer,
    expand_search_disp_doc_fields integer,
    collapse_disp_doc_fields integer,
    expand_disp_doc_fields integer,
    self_create_homedir integer,
    self_captcha integer,
    info_panel_wide integer,
    track_favorites integer,
    expand_disp_updated integer,
    collapse_disp_updated integer,
    expand_search_disp_updated integer,
    collapse_search_disp_updated integer,
    thumb_disp_updated integer,
    motd text,
    pdf_watermark_path character varying(255),
    pdf_custom_watermark_filepath character varying(255),
    pdf_watermarks integer,
    pdf_pdftk_tool_greater_than_1_40 integer,
    machine_time_zone integer,
    show_folder_desc_as_popup integer,
    use_wysiwyg_for_textarea integer,
    make_file_indexing_user_selectable integer,
    turn_file_index_off integer,
    force_ssl integer,
    leave_old_file_accessible integer,
    auto_checkout_checking integer,
    different_filename_update integer,
    default_revision integer,
    smtp_ssl integer,
    smtp_port integer,
    smtp_max_size integer,
    pdf_thumb_path character varying(255)
);

--
-- TOC entry 15 (OID 55533)
-- Name: monitored_file; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE monitored_file (
    id serial NOT NULL,
    userid integer NOT NULL,
    fid integer NOT NULL
);


--
-- TOC entry 16 (OID 55540)
-- Name: monitored_folder; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE monitored_folder (
    id serial NOT NULL,
    userid integer NOT NULL,
    fid integer NOT NULL
);


--
-- TOC entry 17 (OID 55547)
-- Name: groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE groups (
    id serial NOT NULL,
    name character varying(30) NOT NULL
);

--
-- TOC entry 18 (OID 55554)
-- Name: filedata; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE filedata (
    id serial NOT NULL,
    compressed integer DEFAULT 0 NOT NULL,
    data bytea
);


--
-- TOC entry 19 (OID 55565)
-- Name: owl_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE owl_log (
    id serial NOT NULL,
    userid integer,
    filename character varying(255),
    parent integer,
    "action" character varying(40),
    details text,
    ip character varying(16),
    agent character varying(255),
    logdate timestamp without time zone NOT NULL,
    "type" character varying(20),
    filesize bigint
);


--
-- TOC entry 20 (OID 55573)
-- Name: wordidx; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE wordidx (
    wordid integer,
    word character varying(128) NOT NULL
);


--
-- TOC entry 21 (OID 55576)
-- Name: searchidx; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE searchidx (
    wordid integer,
    owlfileid integer
);


--
-- TOC entry 22 (OID 55579)
-- Name: mimes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE mimes (
    filetype character varying(10) NOT NULL,
    mimetype character varying(250) NOT NULL
);
INSERT INTO mimes VALUES ('ai', 'application/postscript');
INSERT INTO mimes VALUES ('aif', 'audio/x-aiff');
INSERT INTO mimes VALUES ('aifc', 'audio/x-aiff');
INSERT INTO mimes VALUES ('aiff', 'audio/x-aiff');
INSERT INTO mimes VALUES ('asc', 'text/plain');
INSERT INTO mimes VALUES ('au', 'audio/basic');
INSERT INTO mimes VALUES ('avi', 'video/x-msvideo');
INSERT INTO mimes VALUES ('bcpio', 'application/x-bcpio');
INSERT INTO mimes VALUES ('bin', 'application/octet-stream');
INSERT INTO mimes VALUES ('bmp', 'image/bmp');
INSERT INTO mimes VALUES ('cdf', 'application/x-netcdf');
INSERT INTO mimes VALUES ('class', 'application/octet-stream');
INSERT INTO mimes VALUES ('cpio', 'application/x-cpio');
INSERT INTO mimes VALUES ('cpt', 'application/mac-compactpro');
INSERT INTO mimes VALUES ('csh', 'application/x-csh');
INSERT INTO mimes VALUES ('css', 'text/css');
INSERT INTO mimes VALUES ('dcr', 'application/x-director');
INSERT INTO mimes VALUES ('dir', 'application/x-director');
INSERT INTO mimes VALUES ('dms', 'application/octet-stream');
INSERT INTO mimes VALUES ('doc', 'application/msword');
INSERT INTO mimes VALUES ('dvi', 'application/x-dvi');
INSERT INTO mimes VALUES ('dxr', 'application/x-director');
INSERT INTO mimes VALUES ('eps', 'application/postscript');
INSERT INTO mimes VALUES ('etx', 'text/x-setext');
INSERT INTO mimes VALUES ('exe', 'application/octet-stream');
INSERT INTO mimes VALUES ('ez', 'application/andrew-inset');
INSERT INTO mimes VALUES ('gif', 'image/gif');
INSERT INTO mimes VALUES ('gtar', 'application/x-gtar');
INSERT INTO mimes VALUES ('hdf', 'application/x-hdf');
INSERT INTO mimes VALUES ('hqx', 'application/mac-binhex40');
INSERT INTO mimes VALUES ('htm', 'text/html');
INSERT INTO mimes VALUES ('html', 'text/html');
INSERT INTO mimes VALUES ('ice', 'x-conference/x-cooltalk');
INSERT INTO mimes VALUES ('ief', 'image/ief');
INSERT INTO mimes VALUES ('iges', 'model/iges');
INSERT INTO mimes VALUES ('igs', 'model/iges');
INSERT INTO mimes VALUES ('jpe', 'image/jpeg');
INSERT INTO mimes VALUES ('jpeg', 'image/jpeg');
INSERT INTO mimes VALUES ('jpg', 'image/jpeg');
INSERT INTO mimes VALUES ('js', 'application/x-javascript');
INSERT INTO mimes VALUES ('kar', 'audio/midi');
INSERT INTO mimes VALUES ('latex', 'application/x-latex');
INSERT INTO mimes VALUES ('lha', 'application/octet-stream');
INSERT INTO mimes VALUES ('lzh', 'application/octet-stream');
INSERT INTO mimes VALUES ('man', 'application/x-troff-man');
INSERT INTO mimes VALUES ('me', 'application/x-troff-me');
INSERT INTO mimes VALUES ('mesh', 'model/mesh');
INSERT INTO mimes VALUES ('mid', 'audio/midi');
INSERT INTO mimes VALUES ('midi', 'audio/midi');
INSERT INTO mimes VALUES ('mif', 'application/vnd.mif');
INSERT INTO mimes VALUES ('mov', 'video/quicktime');
INSERT INTO mimes VALUES ('movie', 'video/x-sgi-movie');
INSERT INTO mimes VALUES ('mp2', 'audio/mpeg');
INSERT INTO mimes VALUES ('mp3', 'audio/mpeg');
INSERT INTO mimes VALUES ('mpe', 'video/mpeg');
INSERT INTO mimes VALUES ('mpeg', 'video/mpeg');
INSERT INTO mimes VALUES ('mpg', 'video/mpeg');
INSERT INTO mimes VALUES ('mpga', 'audio/mpeg');
INSERT INTO mimes VALUES ('ms', 'application/x-troff-ms');
INSERT INTO mimes VALUES ('msh', 'model/mesh');
INSERT INTO mimes VALUES ('nc', 'application/x-netcdf');
INSERT INTO mimes VALUES ('oda', 'application/oda');
INSERT INTO mimes VALUES ('pbm', 'image/x-portable-bitmap');
INSERT INTO mimes VALUES ('pdb', 'chemical/x-pdb');
INSERT INTO mimes VALUES ('pdf', 'application/pdf');
INSERT INTO mimes VALUES ('pgm', 'image/x-portable-graymap');
INSERT INTO mimes VALUES ('pgn', 'application/x-chess-pgn');
INSERT INTO mimes VALUES ('png', 'image/png');
INSERT INTO mimes VALUES ('pnm', 'image/x-portable-anymap');
INSERT INTO mimes VALUES ('ppm', 'image/x-portable-pixmap');
INSERT INTO mimes VALUES ('ppt', 'application/vnd.ms-powerpoint');
INSERT INTO mimes VALUES ('ps', 'application/postscript');
INSERT INTO mimes VALUES ('qt', 'video/quicktime');
INSERT INTO mimes VALUES ('ra', 'audio/x-realaudio');
INSERT INTO mimes VALUES ('ram', 'audio/x-pn-realaudio');
INSERT INTO mimes VALUES ('ras', 'image/x-cmu-raster');
INSERT INTO mimes VALUES ('rgb', 'image/x-rgb');
INSERT INTO mimes VALUES ('rm', 'audio/x-pn-realaudio');
INSERT INTO mimes VALUES ('roff', 'application/x-troff');
INSERT INTO mimes VALUES ('rpm', 'audio/x-pn-realaudio-plugin');
INSERT INTO mimes VALUES ('rtf', 'text/rtf');
INSERT INTO mimes VALUES ('rtx', 'text/richtext');
INSERT INTO mimes VALUES ('sgm', 'text/sgml');
INSERT INTO mimes VALUES ('sgml', 'text/sgml');
INSERT INTO mimes VALUES ('sh', 'application/x-sh');
INSERT INTO mimes VALUES ('shar', 'application/x-shar');
INSERT INTO mimes VALUES ('silo', 'model/mesh');
INSERT INTO mimes VALUES ('sit', 'application/x-stuffit');
INSERT INTO mimes VALUES ('skd', 'application/x-koan');
INSERT INTO mimes VALUES ('skm', 'application/x-koan');
INSERT INTO mimes VALUES ('skp', 'application/x-koan');
INSERT INTO mimes VALUES ('skt', 'application/x-koan');
INSERT INTO mimes VALUES ('smi', 'application/smil');
INSERT INTO mimes VALUES ('smil', 'application/smil');
INSERT INTO mimes VALUES ('snd', 'audio/basic');
INSERT INTO mimes VALUES ('spl', 'application/x-futuresplash');
INSERT INTO mimes VALUES ('src', 'application/x-wais-source');
INSERT INTO mimes VALUES ('sv4cpio', 'application/x-sv4cpio');
INSERT INTO mimes VALUES ('sv4crc', 'application/x-sv4crc');
INSERT INTO mimes VALUES ('swf', 'application/x-shockwave-flash');
INSERT INTO mimes VALUES ('t', 'application/x-troff');
INSERT INTO mimes VALUES ('tar', 'application/x-tar');
INSERT INTO mimes VALUES ('tcl', 'application/x-tcl');
INSERT INTO mimes VALUES ('tex', 'application/x-tex');
INSERT INTO mimes VALUES ('texi', 'application/x-texinfo');
INSERT INTO mimes VALUES ('texinfo', 'application/x-texinfo');
INSERT INTO mimes VALUES ('tif', 'image/tiff');
INSERT INTO mimes VALUES ('tiff', 'image/tiff');
INSERT INTO mimes VALUES ('tr', 'application/x-troff');
INSERT INTO mimes VALUES ('tsv', 'text/tab-separated-values');
INSERT INTO mimes VALUES ('txt', 'text/plain');
INSERT INTO mimes VALUES ('ustar', 'application/x-ustar');
INSERT INTO mimes VALUES ('vcd', 'application/x-cdlink');
INSERT INTO mimes VALUES ('vrml', 'model/vrml');
INSERT INTO mimes VALUES ('wav', 'audio/x-wav');
INSERT INTO mimes VALUES ('wrl', 'model/vrml');
INSERT INTO mimes VALUES ('xbm', 'image/x-xbitmap');
INSERT INTO mimes VALUES ('xls', 'application/vnd.ms-excel');
INSERT INTO mimes VALUES ('xml', 'text/xml');
INSERT INTO mimes VALUES ('xpm', 'image/x-xpixmap');
INSERT INTO mimes VALUES ('xwd', 'image/x-xwindowdump');
INSERT INTO mimes VALUES ('xyz', 'chemical/x-pdb');
INSERT INTO mimes VALUES ('zip', 'application/zip');
INSERT INTO mimes VALUES ('gz', 'application/x-gzip');
INSERT INTO mimes VALUES ('tgz', 'application/x-gzip');
INSERT INTO mimes VALUES ('sxw','application/vnd.sun.xml.writer');
INSERT INTO mimes VALUES ('stw','application/vnd.sun.xml.writer.template');
INSERT INTO mimes VALUES ('sxg','application/vnd.sun.xml.writer.global');
INSERT INTO mimes VALUES ('sxc','application/vnd.sun.xml.calc');
INSERT INTO mimes VALUES ('stc','application/vnd.sun.xml.calc.template');
INSERT INTO mimes VALUES ('sxi','application/vnd.sun.xml.impress');
INSERT INTO mimes VALUES ('sti','application/vnd.sun.xml.impress.template');
INSERT INTO mimes VALUES ('sxd','application/vnd.sun.xml.draw');
INSERT INTO mimes VALUES ('std','application/vnd.sun.xml.draw.template');
INSERT INTO mimes VALUES ('sxm','application/vnd.sun.xml.math');
INSERT INTO mimes VALUES ('wpd','application/wordperfect');
INSERT INTO mimes VALUES ('docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
INSERT INTO mimes VALUES ('xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
INSERT INTO mimes VALUES ('pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');


--
-- TOC entry 23 (OID 55724)
-- Name: docfieldslabel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE docfieldslabel (
    doc_field_id integer DEFAULT 0 NOT NULL,
    field_label character varying(80) DEFAULT ''::character varying NOT NULL,
    locale character varying(80) DEFAULT ''::character varying NOT NULL
);


--
-- TOC entry 24 (OID 55731)
-- Name: doctype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE doctype (
    doc_type_id serial NOT NULL,
    doc_type_name character varying(255) NOT NULL
);


--
-- TOC entry 25 (OID 55739)
-- Name: docfields; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE docfields (
    id serial NOT NULL,
    doc_type_id integer NOT NULL,
    field_name character varying(80) NOT NULL,
    field_position integer NOT NULL,
    field_type character varying(80) NOT NULL,
    field_values text NOT NULL,
    field_size integer NOT NULL,
    searchable integer NOT NULL,
    show_desc integer NOT NULL,
    required integer NOT NULL,
    show_in_list integer
);


--
-- TOC entry 26 (OID 55749)
-- Name: docfieldvalues; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE docfieldvalues (
    id serial NOT NULL,
    file_id integer NOT NULL,
    field_name character varying(80) NOT NULL,
    field_value text NOT NULL
);


--
-- TOC entry 27 (OID 55757)
-- Name: peerreview; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE peerreview (
    reviewer_id integer,
    file_id integer,
    status integer
);


--
-- TOC entry 28 (OID 55761)
-- Name: metakeywords; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE metakeywords (
    keyword_id serial NOT NULL,
    keyword_text character(255) NOT NULL
);


--
-- TOC entry 29 (OID 55768)
-- Name: trackoldpasswd; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE trackoldpasswd (
    id serial NOT NULL,
    userid integer,
    "password" character varying(50) DEFAULT ''::character varying NOT NULL
);


--
-- TOC entry 30 (OID 55774)
-- Name: advanced_acl; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE advanced_acl (
    group_id integer,
    user_id integer,
    file_id integer,
    folder_id integer,
    owlread integer DEFAULT 0,
    owlwrite integer DEFAULT 0,
    owlviewlog integer DEFAULT 0,
    owldelete integer DEFAULT 0,
    owlcopy integer DEFAULT 0,
    owlmove integer DEFAULT 0,
    owlproperties integer DEFAULT 0,
    owlupdate integer DEFAULT 0,
    owlcomment integer DEFAULT 0,
    owlcheckin integer DEFAULT 0,
    owlemail integer DEFAULT 0,
    owlrelsearch integer DEFAULT 0,
    owlsetacl integer DEFAULT 0,
    owlmonitor integer DEFAULT 0
);

INSERT INTO advanced_acl VALUES (NULL,0,NULL,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0);

--
-- TOC entry 31 (OID 55799)
-- Name: file_checksum; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE file_checksum (
    file_id integer DEFAULT 0 NOT NULL,
    hash1 text,
    hash2 text,
    hash3 text,
    signature text
);


COPY folders (id, name, parent, description, "security", groupid, creatorid, "password", smodified, linkedto, rss_feed) FROM stdin;
1	Documents	0		51	0	0		2004-10-17 08:11:50	\N	\N
\.


COPY users (id, groupid, username, name, "password", quota_max, quota_current, email, "notify", attachfile, disabled, noprefaccess, "language", maxsessions, lastlogin, curlogin, lastnews, newsadmin, comment_notify, buttonstyle, homedir, firstdir, email_tool, change_paswd_at_login, login_failed, passwd_last_changed, expire_account, user_auth, logintonewrec, groupadmin, user_offset, useradmin, viewlogs, viewreports, user_default_view, user_major_revision, user_minor_revision, pdf_watermarks) FROM stdin;
2	1	guest	Anonymous	823f67f159b22b4c9a6a96999d1dea57	0	0		0	0	0	1	English	19	2004-11-10 05:02:42	2005-10-23 08:22:16	0	0	0	rsdx_blue1	1	1	0	0	0	2005-10-23 08:22:16		0 	0	0		0	0	0	\N	\N	\N	\N
1	0	admin	Administrator	21232f297a57a5a743894a0e4a801fc3	0	230648	dms-admin@example.com	0	0	0	0	English	0	2005-11-15 18:56:06	2009-03-07 07:57:18	8	0	1	rsdx_blue1	1	1	1	0	0	2005-04-10 22:28:40		  	0	0		0	0	0	\N	\N	\N	\N
\.

COPY html (id, table_expand_width, table_collapse_width, body_background, owl_logo, body_textcolor, body_link, body_vlink) FROM stdin;
1	90%	50%		owl_logo1.gif	#000000	#000000	#000000
\.


--
-- Data for TOC entry 85 (OID 55524)
-- Name: prefs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY prefs (id, email_from, email_fromname, email_replyto, email_server, email_subject, lookathd, lookathddel, def_file_security, def_file_group_owner, def_file_owner, def_file_title, def_file_meta, def_fold_security, def_fold_group_owner, def_fold_owner, max_filesize, tmpdir, timeout, expand, version_control, restrict_view, hide_backup, dbdump_path, gzip_path, tar_path, unzip_path, pod2html_path, pdftotext_path, wordtotext_path, file_perm, folder_perm, logging, log_file, log_login, log_rec_per_page, rec_per_page, self_reg, self_reg_quota, self_reg_notify, self_reg_attachfile, self_reg_disabled, self_reg_noprefacces, self_reg_maxsessions, self_reg_group, anon_ro, anon_user, file_admin_group, forgot_pass, collect_trash, trash_can_location, allow_popup, allow_custpopup, status_bar_location, remember_me, cookie_timeout, use_smtp, use_smtp_auth, smtp_passwd, search_bar, bulk_buttons, action_buttons, folder_tools, pref_bar, smtp_auth_login, expand_disp_status, expand_disp_doc_num, expand_disp_doc_type, expand_disp_title, expand_disp_version, expand_disp_file, expand_disp_size, expand_disp_posted, expand_disp_modified, expand_disp_action, expand_disp_held, collapse_disp_status, collapse_disp_doc_num, collapse_disp_doc_type, collapse_disp_title, collapse_disp_version, collapse_disp_file, collapse_disp_size, collapse_disp_posted, collapse_disp_modified, collapse_disp_action, collapse_disp_held, expand_search_disp_score, expand_search_disp_folder_path, expand_search_disp_doc_type, expand_search_disp_file, expand_search_disp_size, expand_search_disp_posted, expand_search_disp_modified, expand_search_disp_action, collapse_search_disp_score, colps_search_disp_fld_path, collapse_search_disp_doc_type, collapse_search_disp_file, collapse_search_disp_size, collapse_search_disp_posted, collapse_search_disp_modified, collapse_search_disp_action, hide_folder_doc_count, old_action_icons, search_result_folders, restore_file_prefix, major_revision, minor_revision, doc_id_prefix, doc_id_num_digits, view_doc_in_new_window, admin_login_to_browse_page, save_keywords_to_db, self_reg_homedir, self_reg_firstdir, virus_path, peer_review, peer_opt, folder_size, download_folder_zip, display_password_override, thumb_disp_status, thumb_disp_doc_num, thumb_disp_image_info, thumb_disp_version, thumb_disp_size, thumb_disp_posted, thumb_disp_modified, thumb_disp_action, thumb_disp_held, thumbnails_tool_path, thumbnails_video_tool_path, thumbnails_video_tool_opt, thumbnails, thumbnails_small_width, thumbnails_med_width, thumbnails_large_width, thumbnail_view_columns, rtftotext_path, min_pass_length, min_username_length, min_pass_numeric, min_pass_special, enable_lock_account, lock_account_bad_password, track_user_passwords, change_password_every, folderdescreq, show_user_info, filedescreq, collapse_search_disp_doc_num, expand_search_disp_doc_num, colps_search_disp_doc_fields, expand_search_disp_doc_fields, collapse_disp_doc_fields, expand_disp_doc_fields, self_create_homedir, self_captcha, info_panel_wide, track_favorites, expand_disp_updated, collapse_disp_updated, expand_search_disp_updated, collapse_search_disp_updated, thumb_disp_updated, motd, pdf_watermark_path, pdf_custom_watermark_filepath, pdf_watermarks, pdf_pdftk_tool_greater_than_1_40, machine_time_zone, show_folder_desc_as_popup, use_wysiwyg_for_textarea, make_file_indexing_user_selectable, turn_file_index_off, force_ssl, leave_old_file_accessible, auto_checkout_checking, different_filename_update, default_revision, smtp_ssl, smtp_port, smtp_max_size, pdf_thumb_path) FROM stdin;
1	dms-system@example.com	DMS	dms-admin@example.com	localhost	[DMS] : AUTOMATED MAIL	false	1	0	0	1	<font color=red>No Info</font>	not in	0	0	1	151200000	/tmp	9000	1	1	0	1	/usr/bin/mysqldump	/usr/bin/gzip	/bin/tar	/usr/bin/unzip		/usr/bin/pdftotext	/usr/local/bin/antiword	0	0	0	1	1	25	0	0	0	0	0	0	0	0	1	0	2	2	0	0		1	1	1	0	30	0	0		1	1	1	1	1		1	0	1	1	1	1	1	1	1	1	1	1	0	1	1	1	1	1	0	0	0	1	1	1	1	1	1	1	1	1	1	1	1	1	1	0	0	0	1	0	1	0	1	0	ABC-	3	0	1	1	1	1		1	1	1	1	0	1	1	1	1	1	1	1	1	1	/usr/bin/convert	/usr/local/bin/mplayer	 -vo png -ss 0:05 -frames 2 -nosound -really-quiet	1	25	50	100	4	/usr/local/bin/unrtf	8	2	0	0	0	4	10	90	0	0	0	1	0	0	1	0	0	0	0	1	1	0	0	0	0	0				0	0	0	0	0	0	0	0	0	0	0	0	0	25	0	
\.


--
-- Data for TOC entry 86 (OID 55533)
-- Name: monitored_file; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY monitored_file (id, userid, fid) FROM stdin;
\.


--
-- Data for TOC entry 87 (OID 55540)
-- Name: monitored_folder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY monitored_folder (id, userid, fid) FROM stdin;
\.


--
-- Data for TOC entry 88 (OID 55547)
-- Name: groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups (id, name) FROM stdin;
0	Administrators
1	Anonymous
2	File Admin
\.


COPY doctype (doc_type_id, doc_type_name) FROM stdin;
1	Default
\.


-- TOC entry 50 (OID 55466)
-- Name: folderid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX folderid_index ON folders USING btree (id);


--
-- TOC entry 52 (OID 55486)
-- Name: fileid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX fileid_index ON files USING btree (id);


--
-- TOC entry 63 (OID 55575)
-- Name: word_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX word_index ON wordidx USING btree (word);


--
-- TOC entry 64 (OID 55578)
-- Name: search_fileid; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX search_fileid ON searchidx USING btree (owlfileid);


--
-- TOC entry 54 (OID 55723)
-- Name: parentid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX parentid_index ON files USING btree (parent);


--
-- TOC entry 73 (OID 55790)
-- Name: acl_groupid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acl_groupid_index ON advanced_acl USING btree (group_id);


--
-- TOC entry 74 (OID 55791)
-- Name: acl_userid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acl_userid_index ON advanced_acl USING btree (user_id);


--
-- TOC entry 71 (OID 55792)
-- Name: acl_fileid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acl_fileid_index ON advanced_acl USING btree (file_id);


--
-- TOC entry 72 (OID 55793)
-- Name: acl_folderid_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acl_folderid_index ON advanced_acl USING btree (folder_id);


--
-- TOC entry 49 (OID 55447)
-- Name: active_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY active_sessions
    ADD CONSTRAINT active_sessions_pkey PRIMARY KEY (sessid);


--
-- TOC entry 51 (OID 55464)
-- Name: folders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY folders
    ADD CONSTRAINT folders_pkey PRIMARY KEY (id);


--
-- TOC entry 53 (OID 55484)
-- Name: files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT files_pkey PRIMARY KEY (id);


--
-- TOC entry 55 (OID 55495)
-- Name: comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- TOC entry 56 (OID 55505)
-- Name: news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- TOC entry 57 (OID 55512)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 58 (OID 55536)
-- Name: monitored_file_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY monitored_file
    ADD CONSTRAINT monitored_file_pkey PRIMARY KEY (id);


--
-- TOC entry 59 (OID 55543)
-- Name: monitored_folder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY monitored_folder
    ADD CONSTRAINT monitored_folder_pkey PRIMARY KEY (id);


--
-- TOC entry 60 (OID 55550)
-- Name: groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- TOC entry 61 (OID 55561)
-- Name: filedata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY filedata
    ADD CONSTRAINT filedata_pkey PRIMARY KEY (id);


--
-- TOC entry 62 (OID 55571)
-- Name: owl_log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY owl_log
    ADD CONSTRAINT owl_log_pkey PRIMARY KEY (id);


--
-- TOC entry 65 (OID 55581)
-- Name: mimes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mimes
    ADD CONSTRAINT mimes_pkey PRIMARY KEY (filetype);


--
-- TOC entry 66 (OID 55734)
-- Name: doctype_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY doctype
    ADD CONSTRAINT doctype_pkey PRIMARY KEY (doc_type_id);


--
-- TOC entry 67 (OID 55745)
-- Name: docfields_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docfields
    ADD CONSTRAINT docfields_pkey PRIMARY KEY (id);


--
-- TOC entry 68 (OID 55755)
-- Name: docfieldvalues_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docfieldvalues
    ADD CONSTRAINT docfieldvalues_pkey PRIMARY KEY (id);


--
-- TOC entry 69 (OID 55764)
-- Name: metakeywords_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metakeywords
    ADD CONSTRAINT metakeywords_pkey PRIMARY KEY (keyword_id);


--
-- TOC entry 70 (OID 55772)
-- Name: trackoldpasswd_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY trackoldpasswd
    ADD CONSTRAINT trackoldpasswd_pkey PRIMARY KEY (id);


--
-- TOC entry 75 (OID 55805)
-- Name: file_checksum_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY file_checksum
    ADD CONSTRAINT file_checksum_pkey PRIMARY KEY (file_id);


--
-- TOC entry 32 (OID 55455)
-- Name: folders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('folders_id_seq', 2, true);


--
-- TOC entry 33 (OID 55467)
-- Name: files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_seq', 5, true);


--
-- TOC entry 34 (OID 55487)
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comments_id_seq', 1, false);


--
-- TOC entry 35 (OID 55497)
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('news_id_seq', 1, false);


--
-- TOC entry 36 (OID 55507)
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- TOC entry 37 (OID 55516)
-- Name: html_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('html_id_seq', 1, false);


--
-- TOC entry 38 (OID 55522)
-- Name: prefs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('prefs_id_seq', 1, false);


--
-- TOC entry 39 (OID 55531)
-- Name: monitored_file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('monitored_file_id_seq', 1, false);


--
-- TOC entry 40 (OID 55538)
-- Name: monitored_folder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('monitored_folder_id_seq', 1, false);


--
-- TOC entry 41 (OID 55545)
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_id_seq', 3, true);


--
-- TOC entry 42 (OID 55552)
-- Name: filedata_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('filedata_id_seq', 1, false);


--
-- TOC entry 43 (OID 55563)
-- Name: owl_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('owl_log_id_seq', 1, false);


--
-- TOC entry 44 (OID 55729)
-- Name: doctype_doc_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('doctype_doc_type_id_seq', 1, true);


--
-- TOC entry 45 (OID 55737)
-- Name: docfields_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docfields_id_seq', 1, false);


--
-- TOC entry 46 (OID 55747)
-- Name: docfieldvalues_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docfieldvalues_id_seq', 1, false);


--
-- TOC entry 47 (OID 55759)
-- Name: metakeywords_keyword_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('metakeywords_keyword_id_seq', 1, false);


--
-- TOC entry 48 (OID 55766)
-- Name: trackoldpasswd_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('trackoldpasswd_id_seq', 1, false);

