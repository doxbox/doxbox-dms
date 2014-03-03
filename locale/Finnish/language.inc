<?php
/*
 * File: Finnish/language.inc
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
	$owl_lang->localized_date_format = "d-M-Y H:i";
}

// Character Encoding used 
// default: "UTF-8"
$owl_lang->charset = "UTF-8";

// Language Code
// example: "en"
$owl_lang->lang_code = "fi";

//********************************************************
// Date Formating BEGIN
//********************************************************



//********************************************************
// Error Messages BEGIN
//********************************************************

$owl_lang->err_select_reviewer		= "Valitse v&auml;hint&auml;&auml;n yksi k&auml;ytt&auml;j&auml; tarkistamaan asiakirjasi";
$owl_lang->err_adding_comments		= "Sinulle ei ole annettu oikeuksia lis&auml;t&auml; kommentteja t&auml;h&auml;n tiedostoon";
$owl_lang->err_comment_empty		= "Kommentti ei voi olla tyhj&auml;";
$owl_lang->err_backup_file   		= "Olemassaolevan tiedososton varmistus ep&auml;onnistui";
$owl_lang->err_backup_folder_create 	= "Varmistukansion luonti ep&auml;onnistui";
$owl_lang->err_bad_url			= "Sy&ouml;t&auml; toimiva URL";
$owl_lang->err_bad_version_1 		= "DMS vaati PHP ohjelmasta v&auml;hint&auml;&auml;n version";
$owl_lang->err_bad_version_2 		= "T&auml;m&auml; versio on";
$owl_lang->err_bad_version_3 		= "Asenna uudempi versio ja yrit&auml; uudelleen";
$owl_lang->err_email         		= "Viestin l&auml;hetys ep&auml;onnistui";
$owl_lang->err_email_required		= "E-Mail kentt&auml; on pakollinen";
$owl_lang->err_fexist1			= "<b>Tiedosto on jo olemassa:</b>";
$owl_lang->err_fexist2 			= "T&auml;m&auml;n niminen tiedosto l&ouml;ytyy jo <i>";
$owl_lang->err_fexist3 			= "</i> t&auml;st&auml; kansiosta.";
$owl_lang->err_file_exists		= "Palvelimelle lataamasi tiedosto l&ouml;ytyy ennest&auml;&auml;n";
$owl_lang->err_fileexists    		= "Siirto peruttu<br />Samananniminen tiedosto l&ouml;ytyi jo.";
$owl_lang->err_move_failed              = "Filesystem File Move Failed! Aborting Move.";
$owl_lang->err_file_lock     		= "Et voi varata tiedostoa, sen on jo varannut: ";
$owl_lang->err_update_file_lock     	= "Et voi p&auml;ivitt&auml;&auml; t&auml;t&auml; tiedostoa sen on varannut: ";
$owl_lang->err_filemove_exist           = "Uudelleen nimett&auml;ess&auml; nimi on jo toisen tiedoston k&auml;yt&ouml;ss&auml;";
$owl_lang->err_file_not_exist		= "Tiedostoa ei l&ouml;ydy tiedostoj&auml;rjestelm&auml;st&auml;";
$owl_lang->err_file_too_big		= "php.ini upload_max_filesize arvo ylitetty ja/tai<br>Owl Maksimi ladattavan tiedostokoko";
$owl_lang->err_file_update		= "P&auml;ivitys vaati ett&auml; tiedostonimi s&auml;ilyy samana, yrit&auml; k&auml;ytt&auml;en samaa tiedostonime&auml;";
$owl_lang->err_folder_create 		= "kansion luominen ep&auml;onnistui";
$owl_lang->err_folder_exist		= "T&auml;m&auml;n niminen kansio l&ouml;ytyi jo";
$owl_lang->err_folderexists  		= "Uudelleennime&auml;minen peruttu<br />T&auml;m&auml;nniminen kansio l&ouml;ytyi jo.";
$owl_lang->err_general 			= "On tapahtunut virhe";
$owl_lang->err_group_delete             = "Ei voi poistaa t&auml;t&auml; ryhm&auml;&auml;: <font color=\"red\">%d</font> tiedosto(ja),  <font color=\"red\">%d</font> kansio(ta/oita), <font color=\"red\">%d</font> K&auml;ytt&auml;j(&auml;/i&auml;) t&auml;ss&auml; ensisijaisessa ryhm&auml;ss&auml;, <font color=\"red\">%d</font> K&auml;ytt&auml;j(&auml;/i&auml;) jotka ovat ryhm&auml;n j&auml;seni&auml;";
$owl_lang->err_group_exists		= "T&auml;m&auml;n niminen ryhm&auml; on jo olemassa.";
$owl_lang->err_gzip_not_found  		= "gzip ohjelmaa ei l&ouml;ytynyt sijainnista ";
$owl_lang->err_login			= "Kirjaudu sis&auml;&auml;n suorittaaksesi t&auml;m&auml;n toiminnon";
$owl_lang->err_movecancel    		= "Siirto peruttu<br/>";
$owl_lang->err_nameempty    		= "Hakemstonnimi ei voi olla tyhj&auml;";
$owl_lang->err_news_required		= "VIRHE: Uutisen otsikko ja sis&auml;lt&ouml; ovat pakollisia!";
$owl_lang->err_no_access 		= "Sinulla ei ole oikeuksia mihink&auml;&auml;n valitsemaasi tiedostoon";
$owl_lang->err_no_access_info 		= "Mahdollisia syit&auml;: <br />1) Et valinnut yht&auml;&auml;n tiedostoa tai kansiota valintaruudusta<br />2) Massa poisto, Massa E-Mail, Massa varaus ei onnistu kansioille />3) Sinulla ei ole oikeuksia yhteenk&auml;&auml;n valitsemaasi tiedostoon tai kansioon.";
$owl_lang->err_noemail			= "Sinulla ei ole oikeutta postittaa t&auml;t&auml; tiedostoa";
$owl_lang->err_nofileaccess		= "Sinulla ei ole oikeuksia t&auml;h&auml;n tiedostoon";
$owl_lang->err_nofiledelete		= "Sinulla ei ole oikeutta poistaa t&auml;t&auml; tiedostoa";
$owl_lang->err_nofilemod		= "Sinulla ei ole oikeutta muokata t&auml;t&auml; tiedostoa";
$owl_lang->err_nofolderaccess		= "Sinulla ei ole p&auml;&auml;sy&auml; t&auml;h&auml;n kansioon";
$owl_lang->err_nofolderdelete		= "Sinulla ei ole oikeutta poistaa t&auml;t&auml; kansiota";
$owl_lang->err_nofoldermod		= "Sinulla ei ole oikeutta muokata t&auml;t&auml; kansiota";
$owl_lang->err_nosubfolder		= "Sinulla ei ole oikeutta luoda alikansioita t&auml;h&auml;n";
$owl_lang->err_note_title               = "Otsikko on pakollinen kentt&auml;";
$owl_lang->err_note_title_exists        = "T&auml;m&auml;n niminen muistiinpano on jo olemassa";
$owl_lang->err_noupload			= "Sinulla ei ole oikeutta lis&auml;t&auml; tiedostoa t&auml;h&auml;n kansioon";
$owl_lang->err_pass_missmatch		= "Uusi salasana ja uuden salasanan varmistus eiv&auml;t vastaa toisiaan";
$owl_lang->err_pass_wrong    		= "Nykyinen salasana on v&auml;&auml;rin";
$owl_lang->err_pod2html_not_found       = "VIRHE: pod2html ty&ouml;kalua ei l&ouml;ytynyt:";
$owl_lang->err_quota			= "Tilank&auml;ytt&ouml;rajasi ei riit&auml; t&auml;m&auml;n tiedoston lis&auml;&auml;miseen: ";
$owl_lang->err_quota_needed		= " tarvitaan ";
$owl_lang->err_quota_avail		= " saatavilla.";
$owl_lang->err_quota_exceed  		= "Olet ylitt&auml;nyt tilank&auml;ytt&ouml;rajasi";
$owl_lang->err_req			= "VIRHE: Kaikki kent&auml;t ovat pakollisia";
$owl_lang->err_root_delete		= "Ylint&auml; kansiota ei voi poistaa";
$owl_lang->err_sess_notvalid 		= "Istunnon tunnus ei kelpaa";
$owl_lang->err_sess_write		= "Istunnon tietojen kirjoitus tietokantaan ep&auml;onnistui";
$owl_lang->err_specialfoldername 	= "'backup' on Owl:in varaama kansionnimi k&auml;yt&auml; jotain muuta";
$owl_lang->err_tar_not_found  		= "tar ohjelmaa ei l&ouml;ytynyt polusta ";
$owl_lang->err_trash_can_empty 		= "Roskakori on tyhj&auml;";
$owl_lang->err_unauth_area   		= "Sinulla ei ole k&auml;ytt&ouml;oikeuksia t&auml;h&auml;n alueeseen";
$owl_lang->err_unauthorized  		= "Ei k&auml;ytt&ouml;oikeutta";
$owl_lang->err_upload 			= "Lis&auml;ys virhe";
$owl_lang->err_user_exists		= "K&auml;ytt&auml;j&auml;nimi k&auml;yt&ouml;ss&auml;";
$owl_lang->err_cant_del_doc_type	= "Ei voida poistaa jotkut tiedostot ovat t&auml;t&auml; asiakirja tyyppi&auml;";
$owl_lang->err_doc_type_name_req	= "Asiakirjan tyyppi vaaditaan <br />";
$owl_lang->err_field_name_req		= "Kent&auml;n nimi vaaditaan<br />";
$owl_lang->err_doc_field_req            = "Vaadittava kentt&auml; puuttuu:";
$owl_lang->err_doc_field_is_req         = "Field is Required";
$owl_lang->err_field_label_req 		= "Kent&auml;n nimike vaaditaan<br />";
$owl_lang->err_field_size_req		= "Kent&auml;n koko vaaditaan <br />";
$owl_lang->err_field_minor_version      = "Minor version field must be a positive integer";
$owl_lang->err_field_major_version      = "Major version field must be a posivite integer";
$owl_lang->err_file_title_too_long      = "File Description may not exceed 80 Characters";
$owl_lang->err_forbidden_file		= "Kielletty tiedosto tyyppi";
$owl_lang->err_file_indexing		= "V&auml;liaikainen 'TEXT' Tiedoston luonti virhe";
$owl_lang->err_not_zip			= "Viallinen ZIP arkisto";
$owl_lang->err_database			= "Tietokantavirhe";
$owl_lang->err_sql			= "SQL Virhe";
$owl_lang->err_please_select_bulk       = "Valitse v&auml;hint&auml;&auml;n yksi tiedosto tai kansio valintalaatikolla";

// NEW STUFF
$owl_lang->err_captcha_auth		= "CAPTCHA tunnistus ep&auml;onnistui";
// NEW STUFF END


//********************************************************
// Error Messages END
//********************************************************

$owl_lang->btn_import_users  = "Tuo k&auml;ytt&auml;j&auml;t";
$owl_lang->btn_go_top      = "Yl&ouml;s";
$owl_lang->btn_go_bottom      = "Alas";
$owl_lang->btn_admin      = "Yll&auml;pito";
$owl_lang->btn_logout     = "Poistu";
$owl_lang->btn_browse     = "Selaa";
$owl_lang->btn_mail_tool     = "E-Mail";
$owl_lang->btn_help     = "Apua";
$owl_lang->actionbtn_main_menu         = "Main Menu";
$owl_lang->btn_add_field          = "Lis&auml;&auml; kentt&auml;";
$owl_lang->btn_add_url          = "Lis&auml;&auml; Url";
$owl_lang->btn_create          = "Luo";
$owl_lang->btn_register          = "Rekister&ouml;i";
$owl_lang->btn_add_file          = "Lis&auml;&auml; Asiakirja";
$owl_lang->btn_add_zip           = "Lis&auml;&auml; Arkisto";
$owl_lang->btn_admin_users          = "Uusi k&auml;ytt&auml;j&auml;";
$owl_lang->btn_admin_groups          = "Uusi ryhm&auml;";
$owl_lang->btn_deldoctype          = "Poista Asiak. tyyppi";
$owl_lang->btn_expand_view          = "Laajenna n&auml;kym&auml;";
$owl_lang->btn_thumb_view          = "Pikkukuva n&auml;kym&auml;";
$owl_lang->btn_default_view          = "Oletus n&auml;kym&auml;";
$owl_lang->btn_add_folder          = "Lis&auml;&auml; Kansio";
$owl_lang->btn_cancel          = "Peru";
$owl_lang->btn_login          = "Kirjaudu";
$owl_lang->btn_send_email          = "L&auml;het&auml; E-Mail";
$owl_lang->btn_admin_news          = "Uutisten yll&auml;pit&ouml;";
$owl_lang->btn_admin_user_group          = "K&auml;ytt&auml;j&auml;/Ryhm&auml; Yll&auml;pito";
$owl_lang->alt_btn_admin_user_group      = "Adminstartor for Users and Groups";
$owl_lang->alt_btn_admin_news          = "Administartor for System News";
$owl_lang->btn_trash_admin          = "Roskakori";
$owl_lang->btn_add_news          = "Lis&auml;&auml; uutinen";
$owl_lang->btn_clickhere          = "Paina t&auml;t&auml;";
$owl_lang->btn_edit_group          = "Muokkaa ryhm&auml;&auml;";
$owl_lang->btn_add_note          = "Lis&auml;&auml; muistiinpano";
$owl_lang->btn_collapse_view          = "Supista n&auml;kym&auml;";
$owl_lang->btn_edit_user          = "Muokkaa k&auml;ytt&auml;j&auml;&auml;";
$owl_lang->btn_bulk_move          = "Massa siirto";
$owl_lang->btn_bulk_delete         = "Massa poisto";
$owl_lang->btn_bulk_checkout       = "Massa varaus";
$owl_lang->btn_bulk_email          = "Massa E-Mail";
$owl_lang->btn_bulk_download          = "Massa Lataus";
$owl_lang->btn_reset          = "Resetoi";
$owl_lang->btn_submit          = "Hyv&auml;ksy";
$owl_lang->alt_btn_submit          = "Submit Form";
$owl_lang->btn_back          = "Takaisin";
$owl_lang->btn_download_bulk_package	= "ladataksesi massa latauksesi paketin";
$owl_lang->btn_export          = "Vienti";
$owl_lang->btn_gen_pdf          = "Luo PDF";
$owl_lang->user_tool_menu_label         = "User Tools";
$owl_lang->admins_tool_menu_label       = "Admin Tools";

//********************************************************
// Image Alternate popup Messages BEGIN
//********************************************************

$owl_lang->alt_tool_status_red	= "Polku on virheellinen tai ei ole suoritettava tiedosto";
$owl_lang->alt_tool_status_green= "Ty&ouml;kalu on k&auml;yt&ouml;ss&auml;";
$owl_lang->alt_my_approval	= "Asiakirja/oja odottaa hyv&auml;ksynt&auml;&auml;ni";
$owl_lang->alt_pending_approval	= "Asiakirja/oja odottaa hyv&auml;ksynt&auml;&auml;";
$owl_lang->alt_email_reminder 	= "E-Mail muistutus";
$owl_lang->alt_approve_file 	= "Hyv&auml;ksy t&auml;m&auml; asiakirja";
$owl_lang->alt_reject_file 	= "Hylk&auml;&auml; t&auml;m&auml; asiakirja";
$owl_lang->alt_publish_file 	= "Julkista asiakirja";
$owl_lang->alt_go_top 		= "Sirry sivun yl&auml;osaan";
$owl_lang->alt_go_bottom      	= "Siirry sivun alaosaan";
$owl_lang->alt_btn_add_zip     	= "Talleta Zip tiedosto purettavaksi";
$owl_lang->alt_btn_mail_tool   	= "Pieni E-Mail Ohjelma";
$owl_lang->alt_btn_bulk_move   	= "Tiedostojen ja massasiirto";
$owl_lang->alt_btn_bulk_delete 	= "Poista tiedostoja massana";
$owl_lang->alt_btn_bulk_checkout= "Varaa tiedostoja massana";
$owl_lang->alt_btn_bulk_email  	= "Postita tiedostoja massana";
$owl_lang->alt_btn_bulk_download= "Lataa tiedostoja massana";
$owl_lang->alt_reset_form	= "Resetoi lomakeen arvot";
$owl_lang->alt_gen_pdf          = "Luo yll&auml;olevasta tiedostosta PDF versio";
$owl_lang->alt_add_comments     = "Lis&auml;&auml; kommentti tiedostoon";
$owl_lang->alt_updated          = "Asiakirjaa on p&auml;ivitetty viimeisen k&auml;yntisi j&auml;lkeen";
$owl_lang->alt_indexed          = "Document is Indexed and Content Can Be Searched";
$owl_lang->alt_new              = "Asiakirja on luotu viimeisen k&auml;yntisi j&auml;lkeen";
$owl_lang->alt_btn_add_file     = "Tallenna uusi tiedosto";
$owl_lang->alt_btn_add_folder	= "Luo uusi kansio";
$owl_lang->alt_add_group	= "Luo t&auml;m&auml; ryhm&auml;";
$owl_lang->alt_add_news		= "Lis&auml;&auml; uutisia";
$owl_lang->alt_btn_add_note     = "Lis&auml;&auml; muistiinpano";
$owl_lang->alt_add_user		= "Luo t&auml;m&auml; k&auml;ytt&auml;j&auml;";
$owl_lang->alt_btn_add_url	= "Luo uusi Web linkki";
$owl_lang->alt_cancel		= "Peru t&auml;m&auml; toiminto";
$owl_lang->alt_cancel_move	= "Peru siirto";
$owl_lang->alt_change		= "P&auml;ivit&auml; t&auml;m&auml; tietue";
$owl_lang->alt_btn_clickhere	= "Klikkaa t&auml;st&auml;";
$owl_lang->alt_btn_collapse_view = "Vaihda suppeaan n&auml;kym&auml;&auml;n";
$owl_lang->alt_comments 	= "Tiedostoon on liitetty kommentteja";
$owl_lang->alt_del_comments     = "Poista t&auml;m&auml; kommentti";
$owl_lang->alt_edt_comments     = "Muokkaa t&auml;t&auml; kommenttia";
$owl_lang->alt_del_file      	= "Poista tiedosto (Y/N)";
$owl_lang->alt_del_folder    	= "Poista kansio (Y/N)";
$owl_lang->alt_del_group	= "Poista ryhm&auml;";
$owl_lang->alt_del_news		= "Poista t&auml;m&auml; uutinen";
$owl_lang->alt_del_selected	= "Poista kaikki valitut tiedostot";
$owl_lang->alt_del_all		= "Tyhjenn&auml; roskakori";
$owl_lang->alt_rest_selected	= "Palauta kaikki valitut tiedostot";
$owl_lang->alt_del_this_folder	= "Poista kansio &#8211; ";
$owl_lang->alt_del_user		= "Poista t&auml;m&auml; k&auml;ytt&auml;j&auml;";
$owl_lang->alt_edit_group       = "Muokkaa valittua ryhm&auml;&auml;";
$owl_lang->alt_edit_news	= "Muokkaa t&auml;t&auml; uutista";
$owl_lang->alt_edit_user        = "Muokkaa valittua k&auml;ytt&auml;j&auml;&auml;";
$owl_lang->alt_email		= "Postita t&auml;m&auml; tiedosto";
$owl_lang->alt_email_selected	= "Postita kaikki valitut tiedostot";
$owl_lang->alt_btn_expand_view  = "Vaihda laajennettuun n&auml;kym&auml;&auml;n";
$owl_lang->alt_btn_thumb_view   = "Vaihda pikkukuva n&auml;kym&auml;&auml;n";
$owl_lang->alt_btn_default_view = "Vaihda oletusn&auml;kym&auml;&auml;n";
$owl_lang->alt_admin_flush      = "Pyyhi vanhentuneet istunnot";
$owl_lang->alt_get_file      	= "Lataa tiedosto";
$owl_lang->alt_get_folder      	= "Lataa kansion sis&auml;lt&ouml;";
$owl_lang->alt_have_news	= "Uusia uutisia saatavilla";
$owl_lang->alt_have_no_news	= "Ei uusia uutisia";
$owl_lang->alt_home_folder	= "Takaisin aloitus kansioon";
$owl_lang->alt_set_initial_dir	= "Aseta nykyinen kansio aloituskansioksi";
$owl_lang->alt_site_map         = "Sivuston kartta";
$owl_lang->alt_lock_file        = "Varaa tiedosto";
$owl_lang->alt_log_clear        = "Poista kaikki lokit (Y/N)";
$owl_lang->alt_log_file         = "Tiedosto loki";
$owl_lang->alt_log_next		= "N&auml;yt&auml; seuraavat tietueet";
$owl_lang->alt_log_prev		= "N&auml;yt&auml; edelliset tietueet";
$owl_lang->alt_log_top		= "Siirry ensimm&auml;iseen tietueeseen";
$owl_lang->alt_btn_login	= "Kirjaudu DMS ohjemaan";
$owl_lang->alt_btn_logout	= "Poistu DMS ohjelmasta";
$owl_lang->alt_btn_help		= "Owl k&auml;yt&ouml;naikainen Apu";
$owl_lang->alt_mod_file      	= "Muokkaa tiedoston ominaisuuksia"; 
$owl_lang->alt_mod_folder    	= "Muokkaa kansion ominaisuuksia";
$owl_lang->alt_move_file     	= "Siirr&auml; tiedosto";
$owl_lang->alt_copy_file     	= "Kopioi tiedosto";
$owl_lang->alt_link_file     	= "Linkit&auml; t&auml;m&auml; tiedosto toiseen kansioon";
$owl_lang->alt_move_folder   	= "Siirr&auml; kansio";
$owl_lang->alt_copy_folder   	= "Kopioi kansio";
$owl_lang->alt_move_selected	= "Siirr&auml; kaikki valitut tiedostot";
$owl_lang->alt_admin_groups	= "Luo uusi ryhm&auml;";
$owl_lang->alt_news_close	= "Sulje uutisikkuna";
$owl_lang->alt_news_next	= "N&auml;yt&auml; seuraava uutinen";
$owl_lang->alt_news_prev	= "N&auml;yt&auml; edellinen uutinen";
$owl_lang->alt_news_print	= "Tulosta t&auml;m&auml; uutinen";
$owl_lang->alt_admin_users	= "Luo uusi k&auml;ytt&auml;j&auml;";
$owl_lang->alt_monitor_folder	= "Seuraa t&auml;t&auml; kansiota";
$owl_lang->alt_monitored_folder	= "Lopeta t&auml;m&auml;n kansion seuraaminen";
$owl_lang->alt_monitor		= "Seuraa t&auml;t&auml; tiedostoa";
$owl_lang->alt_monitored	= "Lopeta t&auml;m&auml;n tiedoston seuraaminen";
$owl_lang->alt_btn_admin 	= "Owl Yll&auml;pito";
$owl_lang->alt_play_file 	= "Soita media tiedosto";
$owl_lang->alt_recycle		= "Roskakori<br />(Tyhj&auml;)";
$owl_lang->alt_recycle_disable	= "Roskien ker&auml;ily<br />(Ei k&auml;yt&ouml;ss&auml;)";
$owl_lang->alt_recycle_not_found= "Roskakori<br />(Ei l&ouml;ydy)";
$owl_lang->alt_refresh_filter	= "K&auml;ynnist&auml; suodatus / P&auml;ivit&auml; tulokset";
$owl_lang->alt_register		= "Suorita rekister&ouml;intisi";
$owl_lang->alt_btn_browse	= "Palaa tiedostoselaimeen";
$owl_lang->alt_search		= "K&auml;ynnist&auml; etsint&auml;";
$owl_lang->alt_send_email	= "L&auml;het&auml; postia";
$owl_lang->alt_sendfile		= "L&auml;het&auml; tiedosto";
$owl_lang->alt_toggle_check_box	= "Vaihda valintaruudun tila";
$owl_lang->alt_unlock_file      = "Vapauta tiedosto";
$owl_lang->alt_upd_file      	= "P&auml;ivit&auml; tiedosto";
$owl_lang->alt_view_comments    = "Lis&auml;&auml; / N&auml;yt&auml; tiedoston kommentteja";
$owl_lang->alt_view_file     	= "N&auml;yt&auml; tiedosto";
$owl_lang->alt_edit_field	= "Muokkaa t&auml;m&auml;n kent&auml;n m&auml;&auml;rittely&auml;";
$owl_lang->alt_del_field	= "Poista t&auml;m&auml; kentt&auml;";
$owl_lang->alt_add_field	= "Lis&auml;&auml; kentt&auml; ylle";
$owl_lang->alt_deldoctype	= "Poista nykyinen asiakirja tyyppi";
$owl_lang->alt_upd_field	= "P&auml;ivit&auml; t&auml;m&auml; kentt&auml;";
$owl_lang->alt_new_doctype	= "Luo uusi asiakirja tyyppi";
$owl_lang->alt_related		= "Etsi liittyvi&auml; asiakirjoja";
$owl_lang->alt_back      	= "Palaa edelliseen n&auml;ytt&ouml;&ouml;n";
$owl_lang->alt_submit      	= "Hyv&auml;ksy lomake";
// NEW STUFF BEGIN
$owl_lang->alt_edit_file_inline = "Muokkaa tekstitiedostoa";
$owl_lang->alt_btn_trash_admin = "Roskakorin hallinta";
// NEW STUFF END

//********************************************************
// Image Alternate popup Messages END
//********************************************************


//********************************************************
// Owl Logging messages BEGIN
//********************************************************

$owl_lang->log_del_det		= "Koko sis&auml;lt&ouml; poistettiin";
$owl_lang->log_detail		= "Ei lis&auml;tietoja";
$owl_lang->log_file_to		= "MIHIN: ";
$owl_lang->log_filter_all	= "KAIKKI";
$owl_lang->log_login_det	= "K&auml;ytt&auml;j&auml;tunnus: ";
// BEGIN NEW STUFF
$owl_lang->log_login_expired    = "Vanhentunut tunnus: ";
$owl_lang->log_login_too_many_attempts = "Lukittu (Liian monta virheellist&auml; kirjautumista): ";
$owl_lang->log_admin_disabled = " Lukittu tunnus: ";
$owl_lang->log_admin_changed_user = "Muutettu tunnus: ";
$owl_lang->log_admin_changed_group = "Muutettu ryhm&auml;: ";
$owl_lang->log_admin_created_user = "Luotu tunnus: ";
$owl_lang->log_admin_created_group = "Luotu ryhm&auml;: ";
$owl_lang->log_admin_del_user = "Poistettu tunnus: ";
$owl_lang->log_admin_del_group = "Poistettu ryhm&auml;: ";
$owl_lang->log_admin_trash_delfile= "Poistettu tiedosto: ";
$owl_lang->log_admin_trash_restore = "Palautettu: ";
$owl_lang->log_admin_trash_delfold = "Poistettu kansio: ";
$owl_lang->log_admin_trash_empty = "Roskakori voidaan tyhjent&auml;&auml;";
$owl_lang->log_admin_email_restore = "Postettu tiedostoja:";
$owl_lang->log_readhd_feature_add  = "Lue kovalevylt&auml; ominaisuus lis&auml;tty tiedostoon";
$owl_lang->log_admin_to  = "to";
$owl_lang->log_admin_of  = "of";
// END NEW STUFF
$log_file_actions[1]        	= "KIRJAUTUMINEN";
$log_file_actions[2]        	= "EP&Auml;ONNISTUNUT KIRJAUTUMINEN";
$log_file_actions[3]        	= "ULOSKIRJAUTUMINEN";
$log_file_actions[4]        	= "POISTETTU TIEDOSTO";
$log_file_actions[5]        	= "TALLENNETTU TIEDOSTO";
$log_file_actions[6]        	= "TIEDOSTON P&Auml;IVITYS";
$log_file_actions[7]        	= "TIEDOSTO LADATTU";
$log_file_actions[8]        	= "TIEDOSTO MUUTETTU";
$log_file_actions[9]        	= "TIEDOSTO LUKITTU";
$log_file_actions[10]        	= "TIEDOSTO AVATTU";
$log_file_actions[11]        	= "TIEDOSTO POISTETTU";
$log_file_actions[12]        	= "TIEDOSTO SIIRRETTY";
$log_file_actions[13]        	= "TIEDOSTO LUOTU";
$log_file_actions[14]        	= "KANSIO POISTETTU";
$log_file_actions[15]        	= "KANSIOTA MUOKATTU";
$log_file_actions[16]        	= "KANSIOTA SIIRRETTY";
$log_file_actions[17]        	= "UNOHTUNUT SALASANA";
$log_file_actions[18]        	= "K&Auml;YTT&Auml;J&Auml;N REKISTER&Ouml;ITYMINEN";
$log_file_actions[19]           = "TIEDOSTO KATSOTTU";
$log_file_actions[20]           = "TIEDOSTOSSA VIRUS";
$log_file_actions[21]           = "TIEDOSTO KOPIOITU";
$log_file_actions[22]           = "KANSIO KOPIOITU";
$log_file_actions[23]           = "TIEDOSTOLINKKI";
// BEGIN NEW STUFF
$log_file_actions[24]           = "K&Auml;YTT&Auml;J&Auml;HALLINTA";
$log_file_actions[25]           = "ROSKAKORI";
$log_file_actions[26]           = "TIEDOSTO ACL";
$log_file_actions[27]           = "KANSIO ACL";
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
$owl_lang->admin_login_subject  = "P&auml;&auml;K&auml;YTT&auml;J&auml;N KIRJAUTUMINEN";
$owl_lang->admin_login_date  = "P&auml;&auml;k&auml;ytt&auml;j&auml; kirjautuneena:: ";
$owl_lang->admin_login_from  = "P&auml;&auml;k&auml;ytt&auml;j&auml; kirjautunut";
// BEGIN NEW STUFF
$owl_lang->anonymous 		= "(Anonyymi k&auml;ytt&ouml;)";
$owl_lang->repository_list      = "Tietovarasto:";
$owl_lang->engine 		= "DMS";
$owl_lang->forgot_pass		= "Unohditko salasanasi?";
$owl_lang->like_register	= "Haluaisitko rekister&ouml;ity&auml;?";
$owl_lang->login		= "Kirjautuminen";
$owl_lang->loginfail		= "Kirjautumisvirhe";
$owl_lang->logindisabled	= "Tili on LUKITTU, ota yhteytt&auml; j&auml;rjestelm&auml;n yll&auml;pit&auml;j&auml;&auml;n";
$owl_lang->password		= "Salasana";
$owl_lang->successlogout 	= "Olet kirjautunut ulos";
$owl_lang->toomanysessions	= "K&auml;ytt&auml;j&auml;n Maksimi istuntom&auml;&auml;r&auml; t&auml;ynn&auml;e, ota yhteytt&auml; j&auml;rjestelm&auml;n yll&auml;pit&auml;j&auml;&auml;n";
$owl_lang->username		= "K&auml;ytt&auml;j&auml;tunnus";
$owl_lang->forgot_username	= "K&auml;ytt&auml;j&auml;tunnus or Email";
$owl_lang->version 		= "Versio";

//********************************************************
// index.php  END
//********************************************************


//********************************************************
// browse.php  BEGIN
//********************************************************

$owl_lang->menu_url_action		= "Mahdolliset Url toiminnot";
$owl_lang->menu_file_action		= "Mahdolliset tiedosto toiminnot";
$owl_lang->menu_folder_action		= "Mahdolliset kansio toiminnot";
$owl_lang->panel_file_info		= "Tietopaneeli";
$owl_lang->actions 			= "Toiminnot";
$owl_lang->del_selected			= "Poista valitut";
$owl_lang->del_all			= "Tyhjenn&auml; roskakori";
$owl_lang->rest_selected		= "Palauta valitut";
$owl_lang->disk_quota			= "Levynk&auml;ytt&ouml;raja";
$owl_lang->email_selected		= "Postita valitut";
$owl_lang->file 			= "Tiedosto";
$owl_lang->folder_policy 		= "Nykyisen kansion s&auml;&auml;nt&ouml;:";
$owl_lang->current_folder 		= "Nykyinen kansio:";
$owl_lang->held                      	= "Varaaja"; 
$owl_lang->last_logged			= "Viimeksi: ";
$owl_lang->current_db         		= "Nykyinen tietovarasto:";
$owl_lang->modified 			= "Muokattu";
$owl_lang->move_selected		= "Siirr&auml; valitut";
$owl_lang->new_file			= "Uusi!";
$owl_lang->no_description		= "Ei kuvausta saatavilla";
$owl_lang->owner                        = "User";
$owl_lang->page				= "Sivu:";
$owl_lang->postedby 			= "L&auml;hett&auml;j&auml;";
$owl_lang->reallydelete			= "Oletko varma poistamisesta";
$owl_lang->reallydelete_logs		= "Oletko varma, ett&auml; haluat tyhjent&auml;&auml; lokitiedosto";
$owl_lang->reallydelete_selected	= "Oletko varma, ett&auml; haluat poistaa kaikki valitut tiedostot";
$owl_lang->reallyrestore_selected	= "Oletko varma, ett&auml; haluat palautaa kaikki valitut tiedostot";
$owl_lang->size 			= "Koko";;
$owl_lang->updated_by                   = "P&auml;vitt&auml;nyt";
$owl_lang->score 			= "Pisteet";
$owl_lang->title 			= "Nimi";
$owl_lang->doc_number 			= "Asiak #";
$owl_lang->tot_files			= "Yhteens&auml;:";
$owl_lang->tot_my_checked_out		= "Varattuna:";
$owl_lang->tot_my_files			= "Omat:";
$owl_lang->tot_my_group			= "Ryhm&auml;n:";
$owl_lang->tot_new_files		= "Uusia:";
$owl_lang->tot_updated_files		= "P&auml;ivitettyj&auml;:";
$owl_lang->tot_monitored		= "Seurattuja:";
$owl_lang->updated_file			= "P&auml;ivitetty!";
$owl_lang->user               		= "K&auml;ytt&auml;j&auml;tunnus";
$owl_lang->ver                       	= "Ver."; 
$owl_lang->past_number                  = "Past number of Days :";
$owl_lang->folder_count_pre		= "T&auml;m&auml; kansio sis&auml;lt&auml;&auml;";
$owl_lang->folder_count_folder		= "Kansio(ita)";
$owl_lang->folder_count_file		= "Tiedosto(ja)";
$owl_lang->folder_count_url		= "URL(ia)";
$owl_lang->folder_count_note		= "Muistiinpano(ja)";
// NEW STUFF
$owl_lang->special_access_count= "Erikoisoikeudet:";
$owl_lang->special_access_count_alt= "Erikoisoikeudet tiedostoihin/Kansioihin";
$owl_lang->files_in_my_group_title = "Tiedostot omassa ryhm&auml;ss&auml;ni/ryhmiss&auml;ni";
$owl_lang->my_files_title= "Omat tiedostoni";
$owl_lang->my_monitored_title= "Seuraamani tiedosto(t)/Kansio(t)";
$owl_lang->my_special_access_title= "Erikoisoikeuksien luettelo";
$owl_lang->favorite_label = "Label:";
$owl_lang->favorite = "Suosikit";
$owl_lang->favorite_add = "Lis&auml;&auml; nykyinen";
$owl_lang->favorite_go = "Siirry";
$owl_lang->favorite_delete = "Poista";
// END NEW STUFF

//********************************************************
// browse.php  END
//********************************************************


//********************************************************
// modify.php  BEGIN
//********************************************************

$owl_lang->none_selected        = "EI YHT&Auml;&Auml;N VALITTUNA";
$owl_lang->adding_comments      = "Kommentin lis&auml;&auml;minen/n&auml;ytt&auml;minen: ";
$owl_lang->comments      	= "Kommentti";
$owl_lang->post_comment		= "Postita kommentti";
$owl_lang->addingfile 		= "Lis&auml;&auml; tiedosto ";
$owl_lang->addingfolder 	= "Lis&auml;&auml; kansio ";
$owl_lang->attach_file		= "Liit&auml; tiedosto";
$owl_lang->change		= "Muuta";
$owl_lang->create		= "Luo";
$owl_lang->comments_added       = "Kommentoinut: ";
$owl_lang->description 		= "Kuvaus";
$owl_lang->email_body		= "Viesti";
$owl_lang->email_cc          	= "CC";
$owl_lang->email_reply_to	= "Vastaus";
$owl_lang->email_subject	= "Aihe";
$owl_lang->email_to		= "Postita kenelle";
$owl_lang->emailing		= "Postitus";
$owl_lang->disp_mp3		= "MP3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Esitys:<br />Albumi:<br />Bitrate&nbsp;-&nbsp;Samplerate:<br />Kesto:<br />Genre:<br />Kommnetit:";
$owl_lang->keywords 		= "Avainsanat";
$owl_lang->saved_keywords       = "Saved Keywords:";
$owl_lang->modify_url		= "URL";
$owl_lang->modifying		= "Muokkaaminen ";
$owl_lang->name               	= "Nimi"; 
$owl_lang->notify_link          = "Owl Ulkoinen linkki";
$owl_lang->note_content         = "Muistiinpanon sis&auml;lt&ouml;";
$owl_lang->ownergroup         	= "Omistaja (Ryhm&auml;)";
$owl_lang->ownership		= "Omistajuus";
$owl_lang->permissions 		= "Oikeudet";
$owl_lang->prop_permissions 	= "Levit&auml; oikeudet alikansioihin?";
$owl_lang->prop_perms_files 	= "Tiedostoihin levitett&auml;v&auml;t oikeudet";
$owl_lang->policy 		= "S&auml;&auml;nt&ouml;";
$owl_lang->pick_select		= "&#8211; Valitse Owl k&auml;ytt&auml;j&auml; &#8211;";
$owl_lang->sendfile 		= "L&auml;het&auml; tiedosto";
$owl_lang->sendthisfile 	= "L&auml;het&auml; t&auml;m&auml; tiedosto";
$owl_lang->sendthisurl       	= "L&auml;het&auml; t&auml;m&auml; URL";
$owl_lang->updating		= "P&auml;ivitt&auml;minen";
$owl_lang->verdescription 	= "Kuvaus<br />muutoksista";
$owl_lang->vermajor          	= "Iso versionumero";
$owl_lang->verminor          	= "Pieni versionumero";
$owl_lang->vertype           	= "Version tyyppi";  
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

$owl_lang->email             	= "S&auml;hk&ouml;postiosoite";
$owl_lang->full_name		= "Koko nimi";
$owl_lang->register		= "K&auml;ytt&auml;j&auml;n rekister&ouml;ityminen";
$owl_lang->self_failed		= "Ep&auml;onnistui";
$owl_lang->self_passwd		= "Salasana l&auml;hetetty:";
$owl_lang->self_reg_bod		= "Owl salasanasi on:";
$owl_lang->self_reg_rset	= "Owl salasanasi on vaihdettu uusi on:";
$owl_lang->self_reg_subj	= "DMS Tunnuksesi";
$owl_lang->send_pass		= "L&auml;het&auml; salasana";
$owl_lang->submit		= "Rekister&ouml;idy";
$owl_lang->thank_you_1		= "Kiitoksia!";
$owl_lang->thank_you_2		= "S&auml;hk&ouml;posti l&auml;hetet&auml;&auml;n s&auml;hk&ouml;postiosoitteeseesi siin&auml; on UUSI salasana K&auml;YTT&auml;J&auml;TUNNUKSELLE:";
$owl_lang->thank_you_3          = "Your account needs to be enabled by the administrator before you can log in.";
//NEW STUFFS

$owl_lang->err_username_not_long_enough = "Valitsemasi k&auml;ytt&auml;j&auml;tunnus '%s' on %d merkki&auml; pitk&auml; sen pit&auml;&auml; kuitenkin olla v&auml;hint&auml;&auml;n %d merkki&auml;.";
$owl_lang->change_pass_title	      = "MUUTA SALASANA";
$owl_lang->err_old_pass_ver_failed    = "Nykyinen salasanasi v&auml;&auml;rin<br />";
$owl_lang->err_new_confirm_different  = "Uusi salasanasi ja salasanan vahvistus eiv&auml;t vastaa toisiaan<br />";
$owl_lang->err_pass_restriction_1     = "Salasana pit&auml;&auml; olla v&auml;hint&auml;&auml;n '%s' merkki&auml; pitk&auml; <br />";
$owl_lang->err_pass_restriction_2     = "sis&auml;lt&auml;&auml; v&auml;hint&auml;&auml;n '%s' numeroa [0-9] <br />";
$owl_lang->err_pass_restriction_3     = "ja v&auml;hint&auml;&auml;n '%s' erikoismerkki&auml; [ ~!@#$%%^&*()-=+_|{}][\";:<>.,?/\\ ]<br />";
$owl_lang->err_cant_reuse_passwords   = "Et voi k&auml;ytt&auml;&auml; aikaisemmin k&auml;ytt&auml;m&auml;&auml;si salasanaa";
$owl_lang->pass_change_email_1        = "Salasanaasi ei vaihdettu koska et k&auml;yt&auml; Owl j&auml;rjestelm&auml;n omaa k&auml;ytt&auml;j&auml;tunnistusta";
$owl_lang->pass_change_email_2        = "K&auml;ytt&auml;j&auml;tunnistusmallisi on: ";
$owl_lang->pass_change_email_3        = "Ota yhteytt&auml; j&auml;rjestelm&auml;si yll&auml;pit&auml;j&auml;&auml;n saadaksesi lis&auml;apua";
$owl_lang->captcha_typein        = "Kirjoita 5 merkki&auml;";

//NEW STUFF
//********************************************************
// register.php  END
//********************************************************


//********************************************************
// move.php  BEGIN
//********************************************************

$owl_lang->cancel_button	= "Peru";
$owl_lang->moving		= "Siirt&auml;minen";
$owl_lang->moving_file		= "Tiedoston siirt&auml;minen";
$owl_lang->moving_folder	= "Kansion siirt&auml;minen";
$owl_lang->copy_file		= "Tiedoston kopioiminen";
$owl_lang->copy_folder		= "Kansion kopioiminen";
$owl_lang->select		= "Valitse uusi kansio:";

//********************************************************
// move.php  END
//********************************************************


//********************************************************
// log.php  BEGIN
//********************************************************

$owl_lang->viewlog	= "N&auml;yt&auml; loki: ";
// BEGIN NEW STUFF
$owl_lang->diff_from	= "Erot mist&auml;";
$owl_lang->diff_to	= "Erot mihin";
$owl_lang->btn_diff     = "Show Diff";
$owl_lang->btn_diff_alt = "Show the differences between the selected files";
// END NEW STUFF


//********************************************************
// log.php  END
//********************************************************


//********************************************************
// prefs.php  BEGIN
//********************************************************

$owl_lang->confpassword	= "Vahvista uusi salasana";
$owl_lang->comment_notif= "Kommenteista ilmoitus";
$owl_lang->email_tool	= "S&auml;hk&ouml;posti";
$owl_lang->last_modified = "Muokattu viimeksi";
$owl_lang->group	= "Ensisijainen ryhm&auml;";
$owl_lang->groupmember	= "Ryhm&auml;t joissa j&auml;sen";
$owl_lang->newpassword	= "Uusi salasana";
$owl_lang->newsadmin	= "Uutisten yll&auml;pit&auml;j&auml;";
$owl_lang->not_member	= "Et kuulu mihink&auml;&auml;n muuhun ryhm&auml;&auml;n";
$owl_lang->notification	= "Vastaanota ilmoituksia";
$owl_lang->oldpassword	= "Nykyinen salasana";
$owl_lang->preference	= "Asetukset";
$owl_lang->saved	= "&#8212; M U U T O K S E T&nbsp;&nbsp;&nbsp;T A L L E T E T T U &#8212;";
$owl_lang->status_no	= "EI";
$owl_lang->status_yes	= "KYLL&Auml;";
$owl_lang->userlang	= "Kieli";

//NEW STUFF
$owl_lang->useradmin	= "K&auml;ytt&auml;jien yll&auml;pito";
$owl_lang->viewlogs     = "Voi katsoa j&auml;rjestelm&auml;n lokeja";
$owl_lang->viewreports  = "Voi katsoa j&auml;rjestelm&auml;n raportteja";
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

$owl_lang->elapsed_time       	= "suoritusaika";
$owl_lang->search             	= "Etsi";
$owl_lang->search_any_word	= "Mik&auml; tahansa sana";
$owl_lang->search_exact_match   = "Exact Match";
$owl_lang->search_stats_with    = "Starts With";
$owl_lang->search_ends_with     = "Ends With";
$owl_lang->search_all_word	= "Kaikki sanat";
$owl_lang->search_entire_phrase	= "Koko fraasi";
$owl_lang->search_match 	= "Osumat:";
$owl_lang->search_currentfolder = "Etsi nykyisest&auml; kansiosta";
$owl_lang->search_for_folders 	= "Etsii kansioista";
$owl_lang->search_for_files 	= "Etsii tiedostoista";
$owl_lang->search_score 	= "Pisteytt&auml;&auml; tiedostoja";
$owl_lang->search_results_for	= "Etsinn&auml;n tulokset ehdoilla";
$owl_lang->search_winthindocs   = "Hae sis&auml;ll&ouml;ist&auml;";
$owl_lang->related_query_empty  = "Ei metatietoa asiakirjassa ei voi suorittaa 'Etsi liittyvi&auml; asiakirjoja'";
$owl_lang->query_empty       	= "Etsitt&auml;v&auml; merkkijono tyhj&auml;";

//********************************************************
// search.php  END
//********************************************************


//********************************************************
// view.php  BEGIN
//********************************************************

$owl_lang->viewing	= "N&auml;ytt&auml;&auml; ";
$owl_lang->view_diff_heading = "Difference(s) between %s and %s";

//********************************************************
// view.php  END
//********************************************************


//********************************************************
// admin/index.php  BEGIN
//********************************************************

$owl_lang->display_password_override	= "N&auml;yt&auml; Tiedosto/Kansiokohtainen salasanamahdollisuus";
$owl_lang->download_folder_zip		= "Lataa kansiot ZIP muodossa (oletus on tar.gz)";
$owl_lang->doc_id_prefix		= "Asiak# N&auml;yt&auml; etuliite"; 
$owl_lang->doc_id_num_digits		= "Asiak# Numerojen m&auml;&auml;r&auml;";
$owl_lang->view_doc_in_new_window	= "Uusi ikkuna kun katselee asiakirjoja";
$owl_lang->edit_user                    = "***** Muokkaa k&auml;ytt&auml;j&auml;&auml; *****";
$owl_lang->edit_group                   = "***** Muokkaa ryhm&auml;&auml; *****";
$owl_lang->enter_new_user               = "***** Lis&auml;&auml; uusi k&auml;ytt&auml;j&auml; *****";
$owl_lang->enter_new_group              = "***** Lis&auml;&auml; uusi ryhm&auml; *****";
$owl_lang->info_panel_width             = "N&auml;t&auml; Leve&auml; tiedosto Info Paneeli";
$owl_lang->allow_track_favorite         = "Salli k&auml;ytt&auml;jien j&auml;ljit&auml;&auml; suosikkeja";
$owl_lang->admin_login_to_browse_page	= "Yll&auml;pit&auml;j&auml;n kirjautuessa n&auml;ytet&auml;&auml;n selaa n&auml;kym&auml;";
$owl_lang->save_keywords_to_db		= "Salli k&auml;ytt&auml;jien tallentaa avainsanoja uudelleenk&auml;ytett&auml;v&auml;ksi";
$owl_lang->status_column		= "Tila";
$owl_lang->vermajor_initial          	= "Aloitus iso versionumero";
$owl_lang->verminor_initial          	= "Aloitus pieni versionumero";
$owl_lang->docicon_column		= "Asiak. ikoni";
$owl_lang->btn_users_groups		= "K&auml;ytt&auml;j&auml;t &amp;<br />Ryhm&auml;t";
$owl_lang->alt_btn_users_groups		= "Hallitse K&auml;ytt&auml;ji&auml; ja Ryhmi&auml;";
$owl_lang->btn_html_prefs		= "HTML<br />Asetukset";
$owl_lang->alt_btn_html_prefs		= "Muokkaa sivuston HTML asetuksia";
$owl_lang->btn_site_features		= "Sivuston<br />Ominaisuudet";
$owl_lang->alt_btn_site_features	= "Muokkaa sivuston ominaisuuksia ja asetuksia";
$owl_lang->btn_statistics_viewer	= "Tilasto / Raportti <br />Selain";
$owl_lang->alt_btn_statistics_viewer	= "Owl Tilasto selain";
$owl_lang->btn_news_admin		= "Uutisten<br />Yll&auml;pito";
$owl_lang->alt_btn_news_admin		= "Owl Uutisten yll&auml;pit&auml;j&auml;";
$owl_lang->btn_doctype_admin		= "Asiakirja<br />Tyypit";
$owl_lang->alt_btn_doctype_admin	= "Asiakirjatyypien yll&auml;pito";
$owl_lang->btn_backup			= "Varmista<br />Tietokanta";
$owl_lang->alt_btn_backup		= "Varmista SQL Tietokanta";
// BEGIN NEW STUFF
$owl_lang->btn_cln_history              = "H&auml;vit&auml; vanhat";
$owl_lang->alt_btn_cln_history          = "H&auml;vit&auml; asiakirjat jotka ovat (p&auml;iv&auml;&auml;) vanhempia kuin: ";
$owl_lang->confirm_cln_history          = "Oletko varma ett&auml; haluat h&auml;vitt&auml;&auml; (p&auml;iv&auml;&auml;) vanhemmat asiakirjat: ";
$owl_lang->historical_purge             = "Vanhat tiedostot poistettu";
$owl_lang->btn_change_passwd            = "Vaihda salasana";
$owl_lang->alt_btn_change_passwd        = "Vaihda nykyinen salasanasi";
$owl_lang->btn_report_viewer            = "Raportit";
$owl_lang->alt_btn_report_viewer        = "Owl raporttien katselu";
$owl_lang->btn_log_viewer               = "J&auml;rjestelm&auml; lokit";
$owl_lang->alt_btn_log_viewer           = "Owl J&auml;rjestelm&auml; lokien katselu";
// END NEW STUFF
$owl_lang->btn_trashcan			= "Roskakori";
$owl_lang->alt_btn_trashcan		= "Katso t&auml;st&auml; n&auml;hd&auml;ksesi sis&auml;ll&ouml;n";
$owl_lang->btn_initial_load		= "Aloitus lataus";
$owl_lang->alt_btn_initial_load		= "Lataa DB Documents kansiosta";
$owl_lang->confirm_initial_load		= "*** VAROITUS ***  T&auml;t&auml; ei pit&auml;isi ajaa kuin kerran kun tietokanta on viel&auml; tyhj&auml;!";
$owl_lang->confirm_maint_mode           = "Are you sure you want to turn maintenance Mode on? This will prevent users from login in.";
$owl_lang->add				= "Lis&auml;&auml;";
$owl_lang->anonymous_account		= "Anonyymin k&auml;yt&ouml;n tunnus:";
$owl_lang->buttonstyle                  = "Nappien tyyli";
$owl_lang->deletegroup			= "Poista ryhm&auml;";
$owl_lang->deleteuser			= "Poista k&auml;ytt&auml;j&auml;";
$owl_lang->disableuser			= "Lukitse k&auml;ytt&auml;j&auml;";
$owl_lang->disable_recs_per_page	= "Rajoitetun n&auml;kym&auml;n k&auml;ytt&ouml; est&auml;&auml; alikansioiden n&auml;kymisen!";
$owl_lang->file_admin_group		= "Tiedosto/Selaus Yll&auml;pito ryhm&auml;:";
$owl_lang->flushed           		= "Istuntojen taulu pyyhitty, k&auml;ytt&auml;j&auml; voi taas kirjautua.";
$owl_lang->groups			= "Ryhm&auml;t";
$owl_lang->hide_bulk_buttons		= "Piilota massatoiminnot:";
// Edit HTML Properties Messages BEGIN
$owl_lang->ht_tbl_border_sz 		= "Taulun reunan koko:";
$owl_lang->ht_tbl_hd_bg			= "Yl&auml;otsikon tausta:";
$owl_lang->ht_tbl_cell_bg_cl 		= "Taulun solun taustav&auml;ri:";
$owl_lang->ht_tbl_cell_bg_al 		= "Taulun solun vaihtoehtoinen taustav&auml;ri:";
$owl_lang->ht_expand_width		= "Laajennetun n&auml;kym&auml;n leveys:";
$owl_lang->ht_collapse_width 		= "Kootun n&auml;kym&auml;n leveys:";
$owl_lang->ht_bd_bg_image		= "Rungon taustakuvanpolku:";
$owl_lang->ht_bd_txt_cl 		= "Rungon tekstin v&auml;ri:";
$owl_lang->ht_bd_lnk_cl			= "Rungon Linkkien v&auml;ri:";
$owl_lang->ht_bd_vlnk_cl 		= "Rungon k&auml;ytyjen linkkien v&auml;ri:";
// Edit Prefs Properties Messages END
$owl_lang->home_dir			= "K&auml;ytt&auml;j&auml;n Kotihakemisto:";
$owl_lang->initial_dir   		= "K&auml;ytt&auml;j&auml;n aloitus hakemisto";
$owl_lang->maxsessions			= "Istuntojen Maksimim&auml;&auml;r&auml;";
$owl_lang->noprefaccess			= "Poista asetukset";
$owl_lang->owl_anon_full		= "T&auml;ydet oikeudet";
$owl_lang->owl_anon_ro			= "Vain luku";
$owl_lang->owl_anon_download     	= "Vain lataus";
$owl_lang->anonymous_access		= "Aseta anonyymi k&auml;ytt&ouml;";
$owl_lang->owl_dbdump_path   		= "DB Dump ty&ouml;kalun polku:";
$owl_lang->owl_def_file_group_owner	= "Oletus tiedoston omistajaryhm&auml;:";
$owl_lang->owl_def_file_meta		= "Oletus tiedoston metatieto:";
$owl_lang->owl_def_file_owner		= "Oletus tiedoston omistaja:";
$owl_lang->owl_def_file_perm 		= "Oletus tiedoston luontis&auml;&auml;nt&ouml;:";
$owl_lang->owl_def_file_security	= "Oletus tiedoston suojaus:";
$owl_lang->owl_def_file_title		= "Oletus Tiedoston otsikko (Tyhj&auml; k&auml;ytt&auml;&auml; tiedoston nime&auml;):";
$owl_lang->owl_def_fold_group_owner	= "Oletus kansion omistajaryhm&auml;:";
$owl_lang->owl_def_fold_owner		= "Oletus kansion omistaja:";
$owl_lang->owl_def_fold_sec		= "Oletus kansion suojaus:";
$owl_lang->owl_def_folder_perm 		= "Oletus kansion luontis&auml;&auml;nt&ouml;:";
$owl_lang->owl_default_tmpdir		= "V&auml;liaikaistiedostojen hakemiston sijainti: ";
$owl_lang->owl_email_from		= "Kenelt&auml; osoite:";
$owl_lang->owl_email_fromname		= "Kenelt&auml; nimi:";
$owl_lang->owl_email_replyto		= "Vastaukset osoitteeseen:";
$owl_lang->owl_email_server		= "SMTP palvelin:";
$owl_lang->owl_email_smtp		= "K&auml;yt&auml; SMTP ohjelmaa postin l&auml;hetykseen";
$owl_lang->owl_email_smtp_auth		= "k&auml;yt&auml; SMTP tunnistusta";
$owl_lang->owl_email_smtp_auth_login	= "SMTP tunnistus tunnus:";
$owl_lang->owl_email_smtp_auth_passwd	= "SMTP tunnistus salasana";
$owl_lang->owl_email_subject_pref	= "Aiheen etuliite:";
$owl_lang->owl_fogotpass		= "N&auml;yt&auml; unohtuiko salasana linkki";
$owl_lang->owl_group_user		= "K&auml;ytt&auml;j&auml;t jotka ovat t&auml;m&auml;n ryhm&auml;n j&auml;seni&auml;";
$owl_lang->owl_gzip_path     		= "gzip polku:";
$owl_lang->owl_hidebackup		= "Piilota Backup hakemisto";
$owl_lang->owl_log_file			= "Lokita tiedostoa koskevat";
$owl_lang->owl_log_login_act		= "Lokita sis&auml;&auml;n ja ulos kirjautumiset";
$owl_lang->owl_log_rec_page		= "Tietueet loki selaimessa sivua kohti:";
$owl_lang->owl_logging			= "K&auml;ynnist&auml; lokitus";
$owl_lang->owl_logo			= "Kirjautumisikkunan logo ([Language]/graphics):";
$owl_lang->owl_lookAtHD			= "Poista hakemiston seuranta:";
$owl_lang->owl_lookAtHDDel		= "Poista poistetut tiedostot tietokannasta";
$owl_lang->hide_folder_doc_count	= "Piilota kansion tiedosto tyyppien m&auml;&auml;r&auml;";
$owl_lang->hide_folder_size		= "Piilota kansion Sis&auml;ll&ouml;n kokotiedot";
$owl_lang->old_action_icons		= "K&auml;yt&auml; aikaisemman Owl 0.80 version toimintoikoneita";
$owl_lang->search_result_folders	= "Sis&auml;llyt&auml; kansiot etsinn&auml;n tuloksiin";
$owl_lang->restore_file_prefix		= "Palautettujen tiedostojen etuliite";
$owl_lang->owl_max_filesize		= "Tallennettavien tiedostojen maksimi koko (tavuina)";
$owl_lang->owl_owl_expand		= "Selaa toiminnon oletusn&auml;kym&auml; (Laajennettu)";
$owl_lang->owl_owl_timeout		= "Istuntojen vanheneminen sekunneissa";
$owl_lang->virus_path			= "Virustarkitus ohjelman polku<br />Esimerkki: '/usr/bin/clamscan --quiet' <br />&#8211; Tyhj&auml; jos ei k&auml;yt&ouml;ss&auml;:";
$owl_lang->owl_pdftotext_path		= "Yll&auml;pid&auml; etsint&auml; indeksi&auml; <br />PDF ja teksti tiedostoille<br />&#8211; Tyhj&auml; jos ei k&auml;yt&ouml;ss&auml;:";
$owl_lang->owl_wordtotext_path          = "MS-WORD tiedostot <br />&#8211; Tyhj&auml; jos ei k&auml;yt&ouml;ss&auml;:";
$owl_lang->owl_ppttotext_path          = "MS-POWERPOINT tiedostot <br />&#8211; Tyhj&auml; jos ei k&auml;yt&ouml;ss&auml;:";
$owl_lang->owl_pod2html_path            = "Perl 5.8.0 tai uudempi tarvitaan<br />Polku ohjelmaan pod2html:";
$owl_lang->owl_restrict_view		= "Ota k&auml;ytt&ouml;&ouml;n rajoitettu n&auml;kym&auml; toiminto";
$owl_lang->owl_self_reg			= "Salli itse rekister&ouml;ityminen";
$owl_lang->owl_self_reg_hd		= "ITSE REKISTER&Ouml;ITYNEEN K&Auml;YTT&Auml;J&Auml;N OLETUKSET";
$owl_lang->owl_tar_path     		= "tar polku:";
$owl_lang->owl_title_custom		= "MUUTA SELAUKSEN SARAKKEITA";
$owl_lang->owl_title_custom_search      = "MUUTA ETSINN&Auml;N TULOKSIA";
$owl_lang->owl_title_browser		= "DMS SELAUKSEN OMINAISUUDET";
$owl_lang->owl_title_defaults   	= "OLETUKSET";
$owl_lang->owl_title_email		= "DMS j&auml;rjestelm&auml;n s&auml;hk&ouml;posti asetukset";
$owl_lang->owl_title_HD			= "KATSO HAKEMISTOSTA UUSIEN TIEDOSTOJA JA NIIDEN ASETUKSIA";
$owl_lang->owl_title_logging  		= "LOKI ASETUKSET";
$owl_lang->owl_title_other		= "MUUT ASETUKSET";
$owl_lang->owl_title_tools   		= "DB BACKUP/GZIP TY&Ouml;KALUT";
$owl_lang->owl_unzip_path     		= "unzip Polku:";
$owl_lang->owl_version_control		= "k&auml;yt&auml; versionhallinta ominaisuutta:";
$owl_lang->quota			= "Levytilanrajoitus 0=ei k&auml;yt&ouml;ss&auml;";
$owl_lang->reallydeluser		= "T&auml;m&auml; k&auml;ytt&auml;j&auml; on merkitty omistajaksi %numfiles% tiedostoon %numfolders% kansioon. N&auml;m&auml; Tiedosto(t) ja Kansio(t) j&auml;&auml;v&auml; orvoiksi. Onko silti Ok poistaa k&auml;ytt&auml;j&auml;?";
$owl_lang->reallydeleteuser             = "Really Delete this User?";
$owl_lang->recs_per_page		= "N&auml;yt&auml; tietueita sivua kohti (0 = Ei k&auml;yt&ouml;ss&auml;):";
$owl_lang->remember_me_title		= "S&Auml;ILYV&Auml;N KIRJAUTUMISEN ASETUKSET";
$owl_lang->remember_me			= "N&auml;yt&auml; muista minut linkki";
$owl_lang->remember_timeout		= "Keksin vanhememinen p&auml;iviss&auml;";
$owl_lang->remember_me_checkbox		= "Muista minut";
$owl_lang->recycle_title		= "ROSKIEN KOKOAMISEN ASETUKSET";
$owl_lang->recycle_enabled		= "Ota roskien kokoaminen k&auml;ytt&ouml;&ouml;n";
$owl_lang->recycle_location		= "Roskakorin sijainti:";
$owl_lang->show_panel_title		= "N&auml;yt&auml; tila paneeli:";
$owl_lang->show_search_title		= "N&auml;yt&auml; etsint&auml; palkki:";
$owl_lang->show_pref_title		= "N&auml;yt&auml; Asetukset/Poistu palkki:";
$owl_lang->show_bulk_title		= "N&auml;yt&auml; massanappulat:";
$owl_lang->show_action_title		= "N&auml;yt&auml; toimintonappulat:";
$owl_lang->show_folder_title		= "N&auml;yt&auml; kansio ty&ouml;kalut:";
$owl_lang->show_panel			= "N&auml;yt&auml;";
$owl_lang->hide_panel			= "Piilota";
$owl_lang->status_bar_both              = "Ylh&auml;&auml;ll&auml; ja alhaalla";
$owl_lang->status_bar_bottom            = "Vain alhaalla";
$owl_lang->status_bar_location          = "N&auml;yt&auml; tilapalkki:";
$owl_lang->status_bar_not               = "&auml;l&auml; n&auml;yt&auml;";
$owl_lang->status_bar_top               = "Vain ylh&auml;&auml;ll&auml;";
$owl_lang->cust_popup                                   = "Mukautetut kent&auml;t ponnahdusikkunan kuvauksissa";
$owl_lang->cust_headpopup     = "ASIAKIRJA KOHTAISET KENT&Auml;T";
$owl_lang->use_popup			= "K&auml;yt&auml; ponnahdusikkunaa uutisten n&auml;ytt&auml;miseen";
$owl_lang->users           		= "K&auml;ytt&auml;j&auml;t";
$owl_lang->header_user_admin           	= "K&auml;ytt&auml;jien yll&auml;pito";
$owl_lang->header_group_admin           = "Ryhmien yll&auml;pito";
$owl_lang->header_sitefeatures_settings           = "Sivuston ominaisuudet ja asetukset";
// NEW STUF BEGIN

$owl_lang->show_user_info           = "N&auml;ytett&auml;v&auml;t k&auml;ytt&auml;j&auml;nimet ovat valittavissa";
$owl_lang->file_desc_required           = "Tiedostojen kuvaus vaaditaan";
$owl_lang->folder_desc_required         = "Kansion kuvaus vaaditaan";
$owl_lang->rtftotext_path                = "RTF:st&auml; tekstiksi ty&ouml;kalun polku";
$owl_lang->user_admin              = "K&auml;ytt&auml;j&auml;/ryhm&auml; Yll&auml;pit&auml;j&auml;";
$owl_lang->user_gmt_offset              = "K&auml;ytt&auml;j&auml;n GMT aikavy&ouml;hyke";
$owl_lang->users_group_admin		= "K&auml;ytt&auml;j&auml;t jotka ovat Ryhm&auml; yll&auml;pit&auml;ji&auml;";
$owl_lang->html_title		= "HTML Asetukset";
$owl_lang->pass_min_passwd_length           = "K&auml;ytt&auml;j&auml;n asettaman salasanan minimipituus:";
$owl_lang->pass_min_username_length         = "K&auml;ytt&auml;j&auml;n asettaman k&auml;ytt&auml;j&auml;tunnuksen minimipituus:";
$owl_lang->pass_min_passwd_numeric          = "Numeroita v&auml;hint&auml;&auml; salasanassa:";
$owl_lang->pass_min_passwd_special          = "Erikoismerkkej&auml; v&auml;hint&auml;&auml;n salasanassa:";
$owl_lang->pass_enable_account_lockout      = "Salli tunnuksen lukittuminen:";
$owl_lang->pass_account_lockout      	    = "Kuinka monta yrityst&auml; ennen kuin lukittuu:";
$owl_lang->pass_track_old_passwords   	    = "Montako aikaisempaa salasanaa muistetaan:";
$owl_lang->pass_change_every                = "Pakota salasanan vaihto joka (p&auml;iv&auml;&auml;):";

$owl_lang->user_login_to_newrecords         = "Kirjaudu uudet tietueet sivulle:";
$owl_lang->user_group_admin                 = "Tiedostojen yll&auml;pit&auml;j&auml; ensisijaiselle ryhm&auml;lle:";
$owl_lang->user_change_pass_next_login      = "Muuta salasana seuraavan kirjautumisen yhteydess&auml;:";
$owl_lang->user_expires                     = "Tili vanhenee:";
$owl_lang->user_auth_type                   = "Tunnistusk&auml;yt&auml;nt&ouml;:";


$owl_lang->auth_owl                         = "Owl Tunnistus";
$owl_lang->auth_http                        = "HTTP tunnistus (.htaccess)";
$owl_lang->auth_pop3                        = "pop3 Tunnistus";
$owl_lang->auth_ldap                        = "LDAP Tunnistus";
$owl_lang->auth_radius                  = "Radius Authentication";
$owl_lang->users_in_primary_group           = "K&auml;ytt&auml;j&auml;t joilla t&auml;m&auml; ryhm&auml; ENSISIJAINEN ryhm&auml;";
$owl_lang->create_user_homedir 		    = "Create User HomeDir:";
$owl_lang->use_captcha 			    = "Use CAPTCHA:";
$owl_lang->created_here 		    = "<br /> (CREATED HERE IF create homedir checked)";
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

$owl_lang->owl_log_viewer	= "LOKI selain";
$owl_lang->owl_log_hd_action	= "Toiminto";
$owl_lang->owl_log_hd_file	= "Tiedosto";
$owl_lang->owl_log_hd_file_size = "File Size";
$owl_lang->owl_log_hd_fld_path	= "Kansiopolku";
$owl_lang->owl_log_hd_user	= "K&auml;ytt&auml;j&auml;";
$owl_lang->owl_log_hd_dt_tm	= "PVM aika";
$owl_lang->owl_log_hd_ip	= "IP / Osoite";
$owl_lang->owl_log_hd_agent	= "Agentti";
$owl_lang->owl_log_hd_dtls	= "Yksityiskohdat";
$owl_lang->owl_log_no_rec	= " EI TIETUEITA ";
$owl_lang->owl_log_hide      	= "Piilota: ";
$owl_lang->owl_log_filter	= "Suodata";

//********************************************************
// admin/log.php  END
//********************************************************


//********************************************************
// admin/recycle.php  BEGIN
//********************************************************

$owl_lang->empty_trash          = "Tyhjenn&auml; roskakori";
$owl_lang->really_empty_trash	= "Oletko varma roskakorin tyhjent&auml;misest&auml;?";
$owl_lang->recycle_bin_admin    = "Roskakorin yll&auml;pito";
// BEGIN NEW STUFF
$owl_lang->trash_email_subject  = "PYYT&Auml;M&Auml;SI TIEDOSTOT ON PALAUTETTU";
$owl_lang->trash_email_body  = "Pyyt&auml;m&auml;si tiedostot on liitetty.";
// END NEW STUFF

//********************************************************
// admin/recycle.php  END
//********************************************************


//********************************************************
// lib/owl.lib.php  BEGIN
//********************************************************

$owl_lang->file_size_byte		= "t";
$owl_lang->file_size_gigabyte		= "g";
$owl_lang->file_size_kilobyte		= "k";
$owl_lang->file_size_megabyte		= "m";
$owl_lang->notif_subject_new 		= "Uusi tiedosto DMS intranetiss&auml;";
$owl_lang->notif_subject_new_note       = "New DMS Note Added";
$owl_lang->notif_subject_upd 		= "Tiedosto DMS intranetissa p&auml;vitetty";
$owl_lang->notif_subject_file_deleted   = "FILE DELETED FROM REPOSITORY";
$owl_lang->notif_subj_new_account       = "A NEW DMS ACCOUNT WAS CREATED FOR YOU";
$owl_lang->notif_subject_monitor	= "Seuraamasi DMS intanetin tiedostoa tai kansiota on p&auml;vitetty";
$owl_lang->notif_subject_comment	= "DMS intranetin tiedostoon -- Lis&auml;tty kommentti";
$owl_lang->notif_comment_1		= "kommentoitu";
$owl_lang->notif_comment_2		= "Kommentti:";
$owl_lang->notif_msg         		= "T&Auml;M&Auml; ON AUTOMAATTINEN VIESTI DMS&auml;<br /><br />Etsi uusi/p&auml;ivitetty tiedosto joka on postin liitteen&auml;<br /><br />";
$owl_lang->notif_msg_link               = "T&Auml;M&Auml; ON AUTOMAATTINEN VIESTI DMS&auml;<br /><br />Etsi linkki uuteen/p&auml;vitettyyn tiedostoon t&auml;st&auml; postista<br /><br />";
$owl_lang->notif_msg_alt_link           = "T&Auml;M&Auml; ON AUTOMAATTINEN VIESTI DMS&auml;\n\nEtsi linkki uuteen/p&auml;vitettyyn tiedostoon t&auml;st&auml; postista\n\n";
$owl_lang->notif_msg_alt         	= "T&Auml;M&Auml; ON AUTOMAATTINEN VIESTI DMS&auml;\n\nEtsi uusi/p&auml;ivitetty tiedosto joka on postin liitteen&auml;\n\n";
$owl_lang->notif_salutation		= "Hyv&auml;";
$owl_lang->notif_user			= "Luonut/P&auml;ivitt&auml;nyt:";
$owl_lang->owl_path			= "Tiedoston polku: ";
$owl_lang->sessinuse			= "T&auml;m&auml; istunto on k&auml;yt&ouml;ss&auml; toisessa tietokoneessa, k&auml;ytt&ouml; estetty<br />";
$owl_lang->invalidsess			= "Virheellinen istunto tunnus, kirjaudu sis&auml;&auml;n p&auml;&auml;sivulta<br />";
$owl_lang->sesstimeout			= "Istuntosi on vanhentunut, kirjaudu uudelleen<br />";
$owl_lang->everyoneread			= "Kuka tahansa voi lukea/ladata";
$owl_lang->everyonewrite		= "Kuka tahansa voi lukea/kirjoittaa/ladata";
$owl_lang->everyonewrite_nod		= "Kuka tahansa can lukea/kirjoittaa/ladata, EI POISTAA";
$owl_lang->groupread			= "Oma ryhm&auml;si voi lukea/ladata";
$owl_lang->groupwrite			= "Oma ryhm&auml;si voi lukea/kirjoittaa/ladata";
$owl_lang->groupwrite_nod		= "Oma ryhm&auml;si voi lukea/kirjoittaa/ladata, EI POISTAA";
$owl_lang->onlyyou			= "vain sin&auml; voit ukea/kirjoittaa/ladata";
$owl_lang->donothing                    = "&auml;l&auml; tee mit&auml;&auml;n &#8211; J&auml;t&auml; tiedostojen oikeudet rauhaan";
$owl_lang->groupwrite_worldread 	= "Oma ryhm&auml;si voi lukea/kirjoittaa/ladata &amp; kaikki muut voivat lukea";
$owl_lang->groupwrite_worldread_nod 	= "Oma ryhm&auml;si voi lukea/kirjoittaa/ladata (EI POISTAA) &amp; kaikki muut voivat lukea";
$owl_lang->ggroupwrite_worldread 	= "Oma ryhm&auml;si voi tallettaa tiedostoja ja poistaa t&auml;m&auml;n kansion &amp; kaikki muut voivat n&auml;hd&auml; sis&auml;ll&ouml;n";
$owl_lang->ggroupwrite_worldread_nod 	= "Oma ryhm&auml;si voi tallettaa tiedostoja kansioon &amp; kaikki muut voivat n&auml;hd&auml; sis&auml;ll&ouml;n, EI POISTAA";
$owl_lang->everyoneread_ad		= "Kuka tahansa voi lukea/ladata";
$owl_lang->everyonewrite_ad		= "Kuka tahansa voi lukea/kirjoittaa/ladata";
$owl_lang->everyonewrite_ad_nod		= "Kuka tahansa voi lukea/kirjoittaa/ladata, EI POISTAA";
$owl_lang->groupread_ad			= "Valittu ryhm&auml; voi lukea/ladata";
$owl_lang->groupwrite_ad		= "Valittu ryhm&auml; voi lukea/kirjoittaa/ladata";
$owl_lang->groupwrite_ad_nod		= "Valittu ryhm&auml; voi lukea/kirjoittaa/ladata, EI POISTAA";
$owl_lang->onlyyou_ad			= "Vain sin&auml; voit lukea/kirjoittaa/ladata";
$owl_lang->groupwrite_worldread_ad 	= "Valittu ryhm&auml; voi lukea/kirjoittaa/ladata &amp; kaikki muut voivat lukea";
$owl_lang->groupwrite_worldread_ad_nod 	= "Valittu ryhm&auml; voi lukea/kirjoittaa/ladata, EI POISTAA &amp; kaikki muut voivat lukea";
$owl_lang->ggroupwrite_worldread_ad 	= "Valittu ryhm&auml; voi tallettaa tiedostoja ja poistaa t&auml;m&auml;n kansion &amp; kaikki muuut voivat n&auml;hd&auml; sis&auml;ll&ouml;n";
$owl_lang->ggroupwrite_worldread_ad_nod	= "Valittu ryhm&auml; voi tallettaa tiedostoja kansioon &amp; kaikki muuut voivat n&auml;hd&auml; sis&auml;ll&ouml;n, EI POISTAA";
$owl_lang->geveryoneread		= "Kuka tahansa voi lukea t&auml;t&auml; kansiota";
$owl_lang->geveryonewrite		= "Kuka tahansa voi tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->geveryonewrite_nod		= "Kuka tahansa voi tallentaa tiedostoja t&auml;h&auml;n kansioon";
$owl_lang->ggroupread			= "Oma ryhm&auml;si voi lukea t&auml;m&auml;n kansion";
$owl_lang->ggroupwrite			= "Oma ryhm&auml;si voi tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->ggroupwrite_nod		= "Oma ryhm&auml;si voi tallentaa tiedostoja t&auml;h&auml;n kansioon";
$owl_lang->gonlyyou			= "Vain sin&auml; voit tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->geveryoneread_ad		= "Kuka tahansa voi lukea t&auml;m&auml;n kansion";
$owl_lang->geveryonewrite_ad		= "Kuka tahansa voi tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->geveryonewrite_ad_nod	= "Kuka tahansa voi tallentaa tiedostoja t&auml;h&auml;n kansioon";
$owl_lang->ggroupread_ad		= "Valittu ryhm&auml; voi lukea t&auml;m&auml;n kansion";
$owl_lang->ggroupwrite_ad    		= "Valittu ryhm&auml; voi tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->ggroupwrite_ad_nod		= "Valittu ryhm&auml; voi tallentaa tiedostoja t&auml;h&auml;n kansioon";
$owl_lang->gonlyyou_ad			= "Vain sin&auml; voit tallentaa tiedostoja ja poistaa t&auml;m&auml;n kansion";
$owl_lang->orphaned			= "&#8211; Ei omistajaa  &#8211;";
$owl_lang->virus_infected 		= "TIEDOSTOSSA ON VIRUS";
$owl_lang->virus_return_val		= "Virus ohjelma palautti arvon:";
$owl_lang->watermark_string             = "Confidential";
$owl_lang->watermark_source             = "DoxBox " . DOXBOX_VERSION;

//********************************************************
// lib/owl.lib.php  END
//********************************************************


//********************************************************
// HREF TITLE messages  BEGIN
//********************************************************

$owl_lang->title_browse_folder     	= "Selaa t&auml;t&auml; kansiota";
$owl_lang->title_browse_site     	= "Selaa t&auml;h&auml;n URL:iin";
$owl_lang->title_download_view     	= "Lataa / N&auml;yt&auml; t&auml;m&auml; tiedosto";
$owl_lang->title_edit_prefs     	= "N&auml;yt&auml; / Muokkaa k&auml;ytt&auml;j&auml;n asetuksia";
$owl_lang->title_return_folder     	= "Palaa";
$owl_lang->title_sort     		= "J&auml;rjestys";
$owl_lang->title_view_new     		= "N&auml;yt&auml; luettelo uusista tiedostoista edellisen vierailuni j&auml;lkeen";
$owl_lang->title_view_updated     	= "N&auml;yt&auml; luettelo p&auml;ivitetyist&auml; tiedostoista edellisen vierailuni j&auml;lkeen";
$owl_lang->title_view_my     		= "N&auml;yt&auml; luettelo omista tiedostoistani";
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

$owl_lang->news_title			= "Uutisten yll&auml;pito";
$owl_lang->news_hd			= "Uutiset";
$owl_lang->news_hd_created		= "Luotu";
$owl_lang->news_hd_expires		= "Vanhenee";
$owl_lang->news_hd_audience		= "Osoitettu";
$owl_lang->news_heading			= "Uutisotsikko";
$owl_lang->news_content			= "Sis&auml;lt&ouml;";
$owl_lang->news_posted_date		= "Julkaistu:";
$owl_lang->news_read			= "Luettu";

//********************************************************
// admin/news.php and newsread.php  END
//********************************************************


//********************************************************
// DEBUG MESSAGES BEGIN
//********************************************************

$owl_lang->debug_tmp_not_exists		= "DEBUG: DMS:in v&auml;li&auml;aikaishakemisto: %s puuttuu.";
$owl_lang->debug_tmp_not_writeable	= "DEBUG: DMS:in v&auml;li&auml;aikaishakemisto: %s Web serveri ei voi kirjoittaa.";
$owl_lang->debug_doc_not_exists		= "DEBUG: DMS Documents hakemisto: " .$default->owl_FileDir . "/" . fid_to_name(1) ." puuttuu.";
$owl_lang->debug_doc_not_writeable	= "DEBUG: DMS Documents hakemisto: " .$default->owl_FileDir . "/" . fid_to_name(1) ." Web serveri ei voi kirjoittaa.";
$owl_lang->debug_webserver_no_access	= "DEBUG: Web serverill&auml; ei ole luku oikeutta: <br />'$default->owl_FileDir/%s'. <br />korjaa oikeudet ja yrit&auml; uudelleen";
$owl_lang->debug_file_not_exist		= "DEBUG: Vaadittava tiedosto '$default->owl_FileDir/%s' puutuu.<br /> OR<br />M&auml;&auml;ritelty polku \$default->owl_FileDir  config/owl.php:ssa on v&auml;&auml;r&auml;.";

//********************************************************
// DEBUG MESSAGES END
//********************************************************


//********************************************************
// admin/stats.php BEGIN
//********************************************************

$owl_lang->owl_stats_viewer	= "Tilastot / Raportti selain";
$owl_lang->stats_files		= "Tiedostojen m&auml;&auml;r&auml; k&auml;ytt&auml;j&auml;&auml; kohden";
$owl_lang->stats_folders	= "Kansioden m&auml;&auml;r&auml; k&auml;ytt&auml;j&auml;&auml; kohden";
$owl_lang->stats_top		= "Top 20 lataukset";
$owl_lang->stats_report_users_disabled         = "Users (Disabled Users)";
$owl_lang->stats_report_users_entitlement         = "Users (User Entitlement)";
$owl_lang->stats_report_users_filesfolders          = "Users (Files and Folders Per User)";
$owl_lang->stats_report_users_inactive          = "Users (Inactive Users)";
$owl_lang->stats_users          = "K&auml;YTT&auml;JIEN kirjautuminen (kirjautuminen / Virheet / Poistuminen)";
$owl_lang->stats_users_loggedin = "T&auml;ll&auml; hetkell&auml; kirjautuneena";
$owl_lang->stats_information	= "Owl Lokitus ja tiedosto lokitus pit&auml;&auml; olla k&auml;yt&ouml;ss&auml; jotta t&auml;t&auml; tilastoa voi n&auml;ytt&auml;&auml;";

//********************************************************
// admin/stats.php END
//********************************************************

//********************************************************
// admin/doctype.php BEGIN
//********************************************************

$owl_lang->document_type	= "Asiakirjan tyyppi";
$owl_lang->document_type_name	= "Asiakirjan tyypin nimi";
$owl_lang->doc_field_name	= "Kent&auml;n nimi";
$owl_lang->doc_field_pos	= "Kent&auml;n sijainti";
$owl_lang->doc_field_label	= "Kent&auml;n nimi&ouml; (Kielivaihtoehdot)";
$owl_lang->doc_field_size	= "Kent&auml;n koko";
$owl_lang->doc_field_searchable	= "Haettava?";
$owl_lang->doc_field_popup  = " Lis&auml;&auml; ponnahdusikkuna kuvaus?";
$owl_lang->doc_field_required	= "Pakollinen?";
$owl_lang->doc_new_doc_type	= "&#8211; Lis&auml;&auml; uusi asiakirja tyyppi &#8211;";
$owl_lang->doc_specific		= "ASIAKIRJAKOHTAISET KENT&auml;T:";
$owl_lang->doc_administration	= "Asiakirja tyyppien yll&auml;pito";
// BEGIN NEW STUFF
$owl_lang->doc_field_type	= "Kent&auml;n tyyppi:";
$owl_lang->doc_field_sample	= "---&nbsp;&nbsp;M&nbsp;A&nbsp;L&nbsp;L&nbsp;I&nbsp;N&nbsp;&nbsp;&nbsp;&auml;&nbsp;K&nbsp;Y&nbsp;M&nbsp;&nbsp;&auml;&nbsp;&nbsp;---";
$owl_lang->doc_field_values	= "Kent&auml;n arvot eroitetaan merkill&auml; | :";
$owl_lang->doc_field_show_in_list = "N&auml;yt&auml; kentt&auml; selausn&auml;kym&auml;ss&auml;:";
$owl_lang->doc_field_show_in_browse = "N&auml;yt&auml; selatessa:";
$owl_lang->doc_field_disp_label = "KENT&auml;N NIMI&ouml;:";
$owl_lang->doc_field_disp_sep = "EROITIN NIMI&ouml;";
$owl_lang->doc_fields = "Mukautetut kent&auml;t";
// END NEW STUFF

//********************************************************
// admin/doctype.php END
//********************************************************

//********************************************************
// admin/import_users.php  BEGIN
//********************************************************

$owl_lang->sendcsvfile          = "Tallenna Pilkulla eroiteltu tiedosto";
$owl_lang->invalid_groupid      = "Virheellinen ryhm&auml;n ID --> ";
$owl_lang->group_create         = "Ryhm&auml;:";
$owl_lang->msg_user_exists      = "K&auml;ytt&auml;j&auml; l&ouml;ytyy jo";
$owl_lang->user_created_skipped = "K&auml;ytt&auml;j&auml;:";
$owl_lang->import_inserted      = "LIS&auml;TTY";
$owl_lang->import_skipped       = "OHITETTU";
$owl_lang->header_csv_import    = "Tuo CSV k&auml;ytt&auml;j&auml;t tiedosto";

//********************************************************
// admin/import_users.php END
//********************************************************

//********************************************************
// DOC PEER Review  BEGIN
//********************************************************

$owl_lang->peer_reviewer_list	= "Tarkistaja(t)";
$owl_lang->peer_msg_to_reviewer	= "Viesti tarkistajille";
$owl_lang->peer_final_approval	= "[Lopullinen hyv&auml;ksynt&auml;]: ";
$owl_lang->peer_subj_review	= "Sinulla on DMS tiedosto tarkistettavaksi";
$owl_lang->peer_subj_approved	= "Asiakirjasi on hyv&auml;ksytty";
$owl_lang->peer_subj_rejected	= "Asiakirjasi on HYL&Auml;TTY";
$owl_lang->peer_subj_reminder	= "MUISTUTUS: Sinulla on DMS tiedosto tarkistettavaksi";
$owl_lang->peer_notif_user	= "Luonut/P&auml;ivitt&auml;nyt";
$owl_lang->peer_file_to_review	= "Tarkistettava tiedosto:";
$owl_lang->peer_file_approved	= "Tiedosto hyv&auml;ksytty:";
$owl_lang->peer_file_rejected	= "Tiedosto hyl&auml;tty:";
$owl_lang->peer_file_final	= "Lopullinen hyv&auml;ksynt&auml;:";
$owl_lang->peer_final_body	= "Kaikki tarkistajat ovat hyv&auml;ksyneet asiakirjasi.<br />Kirjaudu ja tee asiakirjastasi julkinen<br />";
$owl_lang->peer_final_body_auto = "Kaikki tarkistajat ovat hyv&auml;ksyneet asiakirjasi.<br />Tiedostosi on julkistettu.<br />";
$owl_lang->peer_review_body	= "Sinulta on pyydetty hyv&auml;ksynt&auml;&auml; seuraavan asiakirjaan:";
$owl_lang->peer_approved_body	= "Asiakirjasi on hyv&auml;ksytty:";
$owl_lang->peer_rejected_body	= "Asiakirjasi on hyl&auml;tty:";
$owl_lang->peer_my_approval	= "Odottaa hyv&auml;ksynt&auml;&auml;ni";
$owl_lang->peer_pending_approval= "Hyv&auml;ksynt&auml;&auml; odottavat";
$owl_lang->peer_satus_pending   = "&#8212; O D O T T A A &#8212;";
$owl_lang->peer_satus_rejected  = "&#8212; H Y L &auml; T T Y &#8212;";
$owl_lang->peer_satus_approved  = "&#8212; H Y V &auml; K S Y T T Y &#8212;";
$owl_lang->peer_satus	 	= "Tila";
$owl_lang->peer_reject_reason   = "Hylk&auml;yksen syy";
$owl_lang->peer_pending_title 	= "Omat hyv&auml;ksymist&auml; odottavat asiakirjani";
$owl_lang->peer_approval_title 	= "Hy&auml;ksymist&auml;ni odottavat asiakirjat";
$owl_lang->owl_title_peer_review= "ASIAKIRJAN HYV&Auml;KSYMISJ&Auml;RJESTELM&Auml; OMINAISUUS";
$owl_lang->owl_title_peer_review2= "Asiakirjan hyv&auml;ksymismenettely";
$owl_lang->owl_peer_review	= "K&auml;yt&auml; hyv&auml;ksymismenettely&auml;:";
$owl_lang->owl_peer_review_opt  = "Tee hyv&auml;ksymismenettely vapaaehtoiseksi:";

//********************************************************
// DOC PEER Review  END
//********************************************************

//********************************************************
// setacl.php BEGIN
//********************************************************

$owl_lang->acl_edit_folder             = "Muokkaa kansio ACL:";
$owl_lang->acl_adding_folder           = "Lis&auml;&auml; kansio ACL:";
$owl_lang->acl_heading_folders         = "VALITSE HALUTUT K&auml;YTT&auml;J&auml;(T) ja RYHM&auml;(T) KANSIOILLE";
$owl_lang->acl_heading_files           = "VALITSE HALUTUT K&auml;YTT&auml;J&auml;(T) ja RYHM&auml;(T) TIEDOSTOILLE";
$owl_lang->acl_available_groups        = "K&auml;ytett&auml;viss&auml; olevat ryhm&auml;(t)";
$owl_lang->acl_selected_groups         = "Valitut ryhm&auml;(t)";
$owl_lang->acl_available_users         = "K&auml;ytett&auml;viss&auml; olevat k&auml;ytt&auml;j&auml;(t)";
$owl_lang->acl_selected_users          = "Valitut k&auml;ytt&auml;j&auml;(t)";
$owl_lang->acl_heading_folder          = "Ryhm&auml;(t)/K&auml;ytt&auml;j&auml;(t)";
$owl_lang->acl_folder_read             = "Luku (Lataa/Selaa)";
$owl_lang->acl_folder_write            = "Kirjoitus (Luo)";
$owl_lang->acl_folder_delete           = "Poista";
$owl_lang->acl_folder_copy             = "Kopioi";
$owl_lang->acl_folder_move             = "Siirr&auml;";
$owl_lang->acl_folder_modify           = "Muokkaa ominaisuuksia";
$owl_lang->acl_folder_set_acl          = "Aseta ACL";
$owl_lang->acl_folder_monitor          = "Seuraa";
$owl_lang->btn_acl_save                = "Tallenna";
$owl_lang->alt_acl_save_folder         = "Tallenna kansion Security Policy";
$owl_lang->acl_propagate_folders       = "Levit&auml; kaikkiin alikansioihin";
$owl_lang->acl_edit_file               = "Muokkaa tiedoston ACL:";
$owl_lang->acl_adding_file             = "Lis&auml;&auml; tiedoston ACL:";
$owl_lang->acl_heading_file            = "Ryhm&auml;(t)/K&auml;ytt&auml;j&auml;(t)";
$owl_lang->acl_file_read               = "Luku";
$owl_lang->acl_file_update             = "P&auml;ivitys";
$owl_lang->acl_file_set_acl            = "Aseta ACL";
$owl_lang->acl_file_delete             = "Poista";
$owl_lang->acl_file_copy               = "Kopioi";
$owl_lang->acl_file_move               = "Siirr&auml;";
$owl_lang->acl_file_modify             = "Ominaisuudet";
$owl_lang->acl_file_view_log           = "N&auml;yt&auml; loki";
$owl_lang->acl_file_comment            = "Kommentti";
$owl_lang->acl_file_checkin            = "Varaa/vapauta";
$owl_lang->acl_file_email              = "Email";
$owl_lang->acl_file_search             = "Etsi liittyvi&auml;";
$owl_lang->acl_file_monitor            = "Seuraa";
$owl_lang->acl_propagate_file          = "Aseta t&auml;m&auml; Policy  \"KAIKKIIN\" Tiedostoihin:";
$owl_lang->alt_acl_save_file           = "Talleta tiedoston Security Policy";
$owl_lang->acl_set_acl_now             = "Aseta Security Policy Nyt:";
$owl_lang->acl_set_acl                 = "Aseta Security Policy";
$owl_lang->acl_set_selected            = "Aseta valitut";
$owl_lang->acl_set_file_permissions    = "Aseta tiedoston oikeudet";
$owl_lang->acl_set_folder_permissions  = "Aseta kansion oikeudet";
$owl_lang->alt_set_folder_acl          = "Asea nykyisen kansion Security Policy";

//********************************************************
// setacl.php END
//********************************************************

//********************************************************
// admin/reports BEGIN
//********************************************************
                                                                                                                              
$owl_lang->report_filter                    = "Suodata:";
$owl_lang->report_filter_since              = "J&auml;lkeen:";
$owl_lang->report_users_inactive_title      = "K&auml;ytt&auml;j&auml;(t) jotka eiv&auml;t aktiivisia sitten";
$owl_lang->report_users_disabled_title      = "Lukitut k&auml;ytt&auml;j&auml;(t)";
$owl_lang->report_users_entitlement         = "K&auml;ytt&auml;jien p&auml;&auml;syoikeus luettelo";
$owl_lang->report_file_folder               = "Tiedosto/Kansio";
$owl_lang->report_full_access               = "T&Auml;YDET OIKEUDET";
$owl_lang->report_select_report             = "--- Valitse raportti ---";
$owl_lang->report_available_reports         = "Saatavilla olevat raportit:";
                                                                                                                              
//********************************************************
// admin/reports END
//********************************************************


//********************************************************
// THUMBNAILS BEGIN
//********************************************************

$owl_lang->thumb_re_generate               = "Luo pikkukuva";
$owl_lang->thumb_title                     = "PIKKUKUVIEN N&Auml;YTT&Ouml;/LUOMINEN";
$owl_lang->thumb_enable_thumbnails         = "Salli pikkukuvan n&auml;ytt&ouml;/luominen:";
$owl_lang->thumb_gen_thumb_tool_path       = "Polku ImageMagick convert ty&ouml;kaluun:";
$owl_lang->thumb_gen_thumb_vid_tool_path   = "Mplayerin polku:";
$owl_lang->thumb_gen_thumb_vid_tool_parms  = "Mplayer Parametrit:";
$owl_lang->thumb_small_width               = "Pikkukuvan leveys (PIENI) pikselein&auml;:";
$owl_lang->thumb_med_width                 = "Pikkukuvan leveys (KESK) pikselein&auml;:";
$owl_lang->thumb_large_width               = "Pikkukuvan leveys (ISO) pikselein&auml;:";
$owl_lang->thumb_number_colums             = "Sarakkeiden m&auml;&auml;r&auml; pikkukuvan&auml;kym&auml;ss&auml;:";
$owl_lang->thumb_title_thumb_view          = "PIKKUKUVA N&Auml;KYM&Auml;N YKSITYISKOHDAT";
$owl_lang->thumb_image_info                = "Kuvan tiedot";
$owl_lang->thumb_image_size                = "Kuvan koko:";
$owl_lang->alt_thumb_small                 = "Pieni pikkukuva";
$owl_lang->alt_no_thumb                    = "Ei pikkukuvaa saatavilla";

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
