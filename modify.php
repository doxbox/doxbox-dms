<?php

/*
 * modify.php
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
 * à
 * $Id: modify.php,v 1.28 2006/10/25 13:32:57 b0zz Exp $
*/

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpid3v2/class.id3.php");

if ($default->owl_maintenance_mode == 1)
{
   if(!fIsAdmin(true))
   {
      header("Location: " . $default->owl_root_url . "/index.php?failure=9");
      exit;
   }
}

session_start();

$xtpl = new XTemplate("html/modify.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

$filenamefield = "userfile";
if ($default->use_ubr_progress_bar == 1)
{
  $filenamefield = "upfile_0";
}


if ($sess == "0" && $default->anon_ro > 0)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

if(!isset($type))
{
   $type = "";
}

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
if(!empty($page))
{
   $urlArgs['page']    = $page;
}
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

/**
 * If we are on php 5.4 or Higher check if the PHP 
 * has session.upload_progress enabled to display File
 * Upload  Progress
 */
if (version_compare(phpversion(), "7.0.0", ">="))
{
   // Only need the progress bar for files and Zip File Upload
   if (ini_get('session.upload_progress.enabled') == 1 and $type == '' and !strpos(php_sapi_name(), 'fcgi'))
   {
      /** Load the supporting elements needed to display the Progress bar */
      if ($action == 'file_upload' or $action == 'file_update' or $action == 'zip_upload')
      {
         $xtpl->parse('main.PhpProgressBar');
      }
   }
}

fSetLogo_MOTD();
fSetPopupHelp();

if ($expand == 1)
{
   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
}
else
{
   $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
}


if ($action == "file_comment")
{
   if (check_auth($id, "file_comment", $userid) == 1)
   {
      $xtpl->assign('COMMENT_FILE_PAGE_TITLE', $owl_lang->comment_file_page_title );
      printModifyHeaderXTPL();
      $sql = new Owl_DB; 


      fPrintNavBarXTPL($parent, $owl_lang->adding_comments . "&nbsp;", $id);
      $urlArgs2 = $urlArgs;
      $urlArgs2['action'] = 'file_comment';
      $urlArgs2['expand'] = $expand;
      $urlArgs2['id']     = $id;
      if(!empty($cid))
      {
         $urlArgs2['cid']     = $cid;
         $sql->query("SELECT * FROM $default->owl_comment_table WHERE id = '$cid'");
         $sql->next_record();
         $sCommentValue = $sql->f("comments");
      }


      $sql->query("SELECT * FROM $default->owl_comment_table where fid = '$id' order by id");

     $xtpl->assign('FORM', "<form name=\"form_comment\" id=\"form_comment\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">");
      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

     $xtpl->assign('FILE_COMMENT_LABEL', $owl_lang->comments);
      $xtpl->assign('FILE_COMMENT_VALUE', $sCommentValue);

      $xtpl->assign('FILE_BTN_POST_COMMENT', $owl_lang->post_comment);
      $xtpl->assign('FILE_BTN_POST_COMMENT_ALT', $owl_lang->alt_add_comments);
      $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);

      $iCountlines = 0;
      while ($sql->next_record())
      {
         $sComment = nl2br($sql->f("comments"));

         $xtpl->assign('FILE_COMMENT_DATE', date($owl_lang->localized_date_format, strtotime($sql->f("comment_date")) + $default->time_offset));
         $iFileOwner = owlfilecreator($sql->f("fid"));
         if (fIsAdmin() || $iFileOwner == $userid)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'del_comment';
            $urlArgs2['cid']    = $sql->f("id");
            $urlArgs2['id']     = $id;
            $url = fGetURL ('dbmodify.php', $urlArgs2);

            $xtpl->assign('FILE_COMMENT_DEL_URL', $url);
            $xtpl->assign('FILE_COMMENT_DEL_CONFIRM', "$owl_lang->reallydelete ?");
            $xtpl->assign('FILE_COMMENT_DEL_ALT', $owl_lang->alt_del_comments);
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_comment';
            $urlArgs2['cid']    = $sql->f("id");
            $urlArgs2['id']     = $id;
            $url = fGetURL ('modify.php', $urlArgs2);
            $xtpl->assign('FILE_COMMENT_EDT_URL', $url);
            $xtpl->assign('FILE_COMMENT_EDT_ALT', $owl_lang->alt_edt_comments);
	        $xtpl->parse('main.CommentFiles.CommentBlock.Data.Edits');
         } 

            $xtpl->assign('FILE_COMMENT_ADDED_LABEL', $owl_lang->comments_added);
            $xtpl->assign('FILE_COMMENT_ADDED_BY', uid_to_name($sql->f("userid")));

         $iCountLines++;
         $iPrintLines = $iCountLines % 2;
         if ($iPrintLines == 0)
         {
            $xtpl->assign('FILE_COMMENT_CLASS', "comment1");
         }
         else
         {  
            $xtpl->assign('FILE_COMMENT_CLASS', "comment2");
         }        
         $xtpl->assign('FILE_COMMENT_COMMENTS', $sComment);
	     $xtpl->parse('main.CommentFiles.CommentBlock.Data');
      } 
	  $xtpl->parse('main.CommentFiles.CommentBlock');

       if ($default->show_prefs == 2 or $default->show_prefs == 3)
       {
          fPrintPrefsXTPL("Bottom");
       }
	  $xtpl->parse('main.CommentFiles');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_adding_comments);
   } 
} 

if ($action == "file_update" or $action == "edit_inline")
{
   if (check_auth($id, "file_update", $userid) == 1)
   {
      $xtpl->assign('UPD_FILE_PAGE_TITLE', $owl_lang->upd_file_page_title);
      $sql = new Owl_DB;
      $sql->query("SELECT checked_out, groupid, description, linkedto FROM $default->owl_files_table WHERE id = '$id'");
      $sql->next_record();
      $sDescription = $sql->f("description");
      $checked_out = $sql->f("checked_out");
                                                                                                                                                                                                   
      if ($action == "edit_inline")
      {
         if (!(($checked_out == 0) || ($checked_out == $userid)))
         {
            printError("THIS FILE IS CURRENTLY BEEN EDIT BY: " . uid_to_name($checked_out));
         }
      }

      printModifyHeaderXTPL();

      $urlArgs2 = $urlArgs;
      $urlArgs2['action'] = 'file_update';
      $urlArgs2['groupid'] = $sql->f("groupid");
      $urlArgs2['linkedto'] = $sql->f("linkedto");
      $urlArgs2[ini_get('session.upload_progress.name')]   = 'upload';

      if ($action == "edit_inline")
      {
         $urlArgs2['inline'] = "1";
         $sql->query("UPDATE $default->owl_files_table set checked_out='$userid' WHERE id='$id'");
         owl_syslog(FILE_LOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE");
      }
      else
      {
         $urlArgs2['MAX_FILE_SIZE VALUE'] = $default->max_filesize;
      }

      $urlArgs2['id']     = $id;

      fPrintNavBarXTPL($parent, $owl_lang->updating . ":&nbsp;", $id);
      if ($default->use_ubr_progress_bar == 1)
      {
         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"#\" method=\"post\">\n");
         print("<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"#\" method=\"post\">\n");

      }
      else if ($default->use_progress_bar == 1)
      {
         $sid = md5(uniqid(rand()));

         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"/cgi-bin/upload.cgi?sid=$sid\" method=\"post\">\n");

         $urlArgs2['sessionid']     = $sid;

      }
      else
      {
         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">\n");
      }

      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      if ($action != "edit_inline")
      {
         $xtpl->assign('FILE_UPLOAD_LABEL', $owl_lang->sendthisfile);
         $xtpl->assign('FILE_UPLOAD_FIELDNAME', $filenamefield);
         $xtpl->parse('main.UpdFiles.FileUploads.UpdOther');

      }

      if ($default->make_file_indexing_user_selectable == 1)
      {
         $xtpl->assign('FILE_INDEXOPTIONAL_LABEL', $owl_lang->optional_file_index);
	 $xtpl->parse('main.AddFiles.index_optional');
      }

      // *****************************
      // PEER Review feature BEGIN
      // *****************************

      if ( $default->document_peer_review == 1 and empty($type))
      {
          $aUserList = fGetUserInfoInMyGroups($userid, "disabled <> '1' and email <> '' and id <> '$userid'");
          $i = 0;
          if (!empty($aUserList))
          {
             foreach ($aUserList as $aUsers)
             {
                $sUsername = $aUsers["username"];
                $sId = $aUsers["id"];
                $sName = $aUsers["name"];
                $sEmail = $aUsers["email"];
                $reviewer[$i][0] = $sId;
                $reviewer[$i][1] = $sName . " (" . $sEmail . ")";
                $i++;
            }
          }

	  $rows = array();
          $rows = fPrintFormSelectBoxXTPL("REVIEWERS", "reviewers[]", $reviewer, array(), 10, true);
          $rowsize = count($rows);
                
          for ($i=1; $i<=$rowsize; $i++)
          {
             $xtpl->assign('SELECT_BOX', $rows[$i]);
             $xtpl->parse('main.UpdFiles.Reviewers.SelectBox');
          }

          $xtpl->assign('FILE_REVIEWER_LIST_LABEL', $owl_lang->peer_reviwer_list);
          $xtpl->assign('FILE_REVIEWER_MSG_LABEL', $owl_lang->peer_msg_to_reviewer);
          $xtpl->parse('main.UpdFiles.Reviewers');

      }

      // *****************************
      // PEER Review feature END
      // *****************************
      if ($default->owl_version_control == 1)
      {
	 $xtpl->assign('FILE_MAJORVERSION_LABEL', $owl_lang->vermajor);
         $xtpl->assign('FILE_MAJORVERSION_VALUE', $default->major_revision);
         
         $xtpl->assign('FILE_MINORVERSION_LABEL', $owl_lang->verminor);
         $xtpl->assign('FILE_MINORVERSION_VALUE', $default->minor_revision);

         $xtpl->assign('FILE_DESC_VALUE',$sDescription);
         $xtpl->assign('FILE_DESC_LABEL',$owl_lang->verdescription);
         $xtpl->assign('FILE_VERSIONTYPE_LABEL',$owl_lang->vertype);
         
         $xtpl->parse('main.UpdFiles.VersionType');
      } 

      if ($action == "edit_inline")
      {
         if ($default->owl_use_fs)
         {
            $filename = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . flid_to_filename($id);
            $handle = fopen ($filename, "r");
            $contents = fread ($handle, filesize ($filename));
            fclose ($handle);
         }
         else
         {
            $path = fGetFileFromDatbase($id);
            $contents = file_get_contents($path);
         }
         $xtpl->assign('FILE_INLINE_LABEL',$owl_lang->document_text);
         $xtpl->assign('FILE_INLINE_VALUE',$contents);
         $xtpl->parse('main.UpdFiles.UpdInLine');

      }

      if ($action == "edit_inline")
      {
         if ($default->use_ubr_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" id=\"upload_button\" name=\"send_file_x\" type=\"button\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"linkUpload();\"></input>");
         }
         else if ($default->use_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" name=\"send_file_x\" type=\"submit\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"postIt();\"></input>");
         }
         else
         {
            $xtpl->assign('FILE_BTN_UPD_FILE_ALT', $owl_lang->alt_sendfile);
            $xtpl->assign('FILE_BTN_UPD_FILE', $owl_lang->sendfile);
         }

         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);

         $xtpl->assign('FILE_BTN_CANCEL_ALT', $owl_lang->alt_btn_cancel);
         $xtpl->assign('FILE_BTN_CANCEL', $owl_lang->btn_cancel);
         
         $xtpl->parse('main.UpdFiles.CancelBtn');

      }
      else
      {
       if ($default->use_ubr_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" id=\"upload_button\" name=\"send_file_x\" type=\"button\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"linkUpload();\"></input>");
         }
         else if ($default->use_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" name=\"send_file_x\" type=\"submit\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"postIt();\"></input>");
         }
         else
         {
            $xtpl->assign('FILE_BTN_UPD_FILE_ALT', $owl_lang->alt_sendfile);
            $xtpl->assign('FILE_BTN_UPD_FILE', $owl_lang->sendfile);
         }
         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
      }

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL("Bottom");
      }

      if ($type <> "note" and $action <> "edit_inline")
      {
         $xtpl->parse('main.UpdFiles.FileUploads');
      }

      $xtpl->parse('main.UpdFiles');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_noupload);
   } 
} 

if ($action == "file_upload" or $action == "zip_upload")
{
   if (check_auth($parent, "folder_create", $userid) == 1)
   {

      if ($action == 'zip_upload')
      {
         $xtpl->assign('ADD_FILE_PAGE_TITLE', $owl_lang->add_archive_page_title);
      }
      else
      {
         $xtpl->assign('ADD_FILE_PAGE_TITLE', $owl_lang->add_file_page_title);
      }
      printModifyHeaderXTPL(); 

      $iFolderParentGroupOwner = owlfoldergroup($parent);

      $groups = fGetGroups($userid);

      fPrintNavBarXTPL($parent, $owl_lang->addingfile . ":&nbsp;");
      $urlArgs2 = $urlArgs;
      $urlArgs2['action'] = $action;
      $urlArgs2['id']     = $id;
      $urlArgs2['type']   = $type;
      $urlArgs2[ini_get('session.upload_progress.name')]   = 'upload';

      if (! $default->owl_version_control == 1)
      {
         $urlArgs2['major_revision'] =  $default->major_revision;
         $urlArgs2['minor_revision'] =  $default->minor_revision;
      }
      if ( $default->advanced_security == 1 )
      {
         $urlArgs2['security']   = "6"; // FILE SECURITY
         $urlArgs2['policy']   = "54"; // FOLDER SECURITY
         if ($default->inherit_acl_from_parent_folder == '1')
         {
            $bIsMemberOfParentFolderGroup = false;
            foreach($groups as $g)
            {
               if ($g[0] == $iFolderParentGroupOwner)
               {
                  $bIsMemberOfParentFolderGroup = true;
               }
            }
            if ($bIsMemberOfParentFolderGroup == true)
            {
               $urlArgs2['groupid']   = $iFolderParentGroupOwner; // FOLDER CREATOR GROUP
            }
            else
            {
               $urlArgs2['groupid']   = owlusergroup($userid); // FOLDER CREATOR GROUP
            }
         }
         else
         {
            $urlArgs2['groupid']   = owlusergroup($userid); // FOLDER CREATOR GROUP
         }
      }
      $urlArgs2['MAX_FILE_SIZE'] = $default->max_filesize;
    
    $xtpl->assign('ERR_TITLE_TOO_LONG', $owl_lang->err_file_title_too_long);
    $xtpl->assign('ERR_MAJOR_VER', $owl_lang->err_field_major_version);
    $xtpl->assign('ERR_MINOR_VER', $owl_lang->err_field_minor_version);

      if ($default->use_ubr_progress_bar == 1)
      {
         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\" onsubmit=\"return isFormOK(this);\">");
      }
      else if ($default->use_progress_bar == 1)
      {
         $sid = md5(uniqid(rand()));
         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"/cgi-bin/upload.cgi?sid=$sid\" method=\"post\" onsubmit=\"return isFormOK(this);\">");
		 $urlArgs2['sessionid'] = $sid;
      }
      else
      {
         $xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\" onsubmit=\"return isFormOK(this); return false;\">");
      }

      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      if ($type == "url")
      {
         $xtpl->assign('ADD_FILE_PAGE_TITLE', $owl_lang->add_url_page_title);
         // if this is a new Document set the document type to DEFAULT
         if (!isset($doctype))
         {
            $doctype = $default->default_url_doctype;
         }

         fPrintDoctypePickListXtpl($doctype);
	 $xtpl->assign('FILE_UPLOAD_LABEL', $owl_lang->sendthisurl);
         $xtpl->assign('FILE_UPLOAD_FIELDNAME', $filenamefield);
         $xtpl->parse('main.AddFiles.FileUploads.AddURL');

      } 
      elseif ($type == "")
      {
         // if this is a new Document set the document type to DEFAULT
         if (!isset($doctype))
         {
            $doctype = $default->default_doctype;
         }

         fPrintDoctypePickListXtpl($doctype);

         $iMaxUploadSize = min( $default->max_filesize, return_bytes(ini_get('post_max_size')), return_bytes(ini_get('upload_max_filesize')), return_bytes(ini_get('memory_limit')));

         if ($default->debug == true)
         {
			$sMaxUpload = "(Owl: " . gen_filesize($default->max_filesize) . 
"<br /> PHP.ini(upload_max_filesize): " . strtolower(ini_get('upload_max_filesize')) .
"<br /> PHP.ini(post_max_size): " . strtolower(ini_get('post_max_size')) .
"<br /> PHP.ini(memory_limit): " . strtolower(ini_get('memory_limit')) .")";

         }
         else
         {
	    $sMaxUpload = "(MAX: " . gen_filesize($iMaxUploadSize) . ")";
         } 
	 $xtpl->assign('FILE_UPLOAD_LABEL', $owl_lang->sendthisfile . ": $sMaxUpload" );

         $xtpl->assign('FILE_UPLOAD_FIELDNAME', $filenamefield);
         $xtpl->parse('main.AddFiles.FileUploads.AddOther');
         $xtpl->assign('FILE_UPLOAD_SCAN_ALT', $owl_lang->btn_scan_alt);
         $xtpl->assign('FILE_UPLOAD_SCAN_URL', "javascript:makelink();");
         $xtpl->assign('FILE_UPLOAD_SCAN_LABEL', $owl_lang->btn_scan);
         $xtpl->assign('FILE_UPLOAD_SCAN_JS', "<script language=\"JavaScript\">function makelink(){ var x=''; if (navigator.userAgent.indexOf(\"Firefox\")!=-1) {x = \" Mozilla Firefox\";} else if (navigator.userAgent.indexOf(\"Maxthon\")!=-1) {x = \" Maxthon Browser\";} else {x = navigator.appName;}; window.location = \"https://www.darchive.co.il/dev/xscan/index.php?title=$default->site_title $default->version\" + '- ' + x;}</script>");

         if ($action == "file_upload" and $default->max_number_of_file_uploads > 0 )
         {
            $xtpl->parse('main.AddFiles.FileUploads.MultiAddFile');
            if ($default->enable_twain_scan_to_pdf)
            {
               $xtpl->parse('main.AddFiles.FileUploads.Scan');
            }
         }
	 else if ($action == "zip_upload")
         {
            $xtpl->assign('FILE_UPLOAD_FIELDNAME', $filenamefield);
         }

         else
         {
	    if ($default->enable_twain_scan_to_pdf)
	    {
               $xtpl->parse('main.AddFiles.FileUploads.Scan');
	    }
         }
      } 

         $xtpl->assign('FILE_TITLE_LABEL', $owl_lang->title);
         $xtpl->assign('FILE_KEYWORDS_LABEL', $owl_lang->keywords);

         if ($default->save_keywords_to_db)
         {
            $xtpl->assign('FILE_KEYWORDS_SAVE_LABEL', $owl_lang->save_keyword);
            $xtpl->assign('FILE_KEYWORDS_SAVED_LABEL', $owl_lang->saved_keywords);

            $xtpl->parse('main.AddFiles.SaveKeyWords');
            $KeyWrd = new Owl_DB;
            $KeyWrd->query("SELECT keyword_text FROM $default->owl_keyword_table ORDER BY keyword_text");
            $i = 0;
            $keywords = array();
            while ($KeyWrd->next_record())
            {
               $keywords[$i][0] = $KeyWrd->f("keyword_text");
               $keywords[$i][1] = $KeyWrd->f("keyword_text");
               $i++;
            }
	    $rows = array();
            $rows = fPrintFormSelectBoxXTPL("KEYWORDS" , "keywordpick[]", $keywords, '', 5, false, true);
            $rowsize = count($rows);

            for ($i=1; $i<=$rowsize; $i++)
            {
              $xtpl->assign('SELECT_BOX', $rows[$i]);
              $xtpl->parse('main.AddFiles.SaveKeyWordPick.SelectBox');
            }
            $xtpl->parse('main.AddFiles.SaveKeyWordPick');
         }

         if ($default->docRel == 1)
         {
            $docRel = new Owl_DB;
            $docRel->query("SELECT id FROM $default->owl_files_table ORDER BY id");

            while ($docRel->next_record())
            {
               $docsRel[$i][0] = $docRel->f("id");
               $docsRel[$i][1] = $default->doc_id_prefix . str_pad($docRel->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
            }

            $rows = array();
            $rows = fPrintFormSelectBoxXTPL("DOCREL", "docRelPick[]", $docsRel, array() , 10, true);
            $rowsize = count($rows);

            for ($i=1; $i<=$rowsize; $i++)
            {
              $xtpl->assign('SELECT_BOX', $rows[$i]);
              $xtpl->parse('main.AddFiles.DocRel.SelectBox');
            }

            $xtpl->assign('FILE_DOCREL_LIST_LABEL', $owl_lang->docRel_list);

            $xtpl->parse('main.AddFiles.DocRel');
         }

      if ($default->owl_version_control == 1)
      {
         $xtpl->assign('FILE_MAJORVERSION_LABEL', $owl_lang->vermajor);
         $xtpl->assign('FILE_MAJORVERSION_VALUE', $default->major_revision);
         
         $xtpl->assign('FILE_MINORVERSION_LABEL', $owl_lang->verminor);
         $xtpl->assign('FILE_MINORVERSION_VALUE', $default->minor_revision);
      } 

      if ($action == "zip_upload")
      {
         $xtpl->assign('FILE_TOCURRENT_LABEL', $owl_lang->archive_extract_current);
         $xtpl->assign('FILE_OVERWRITE_LABEL', $owl_lang->archive_extract_overwrite);
         $xtpl->parse('main.AddFiles.zipupload');
      }
 
      if ($default->make_file_indexing_user_selectable == 1)
      {
	$xtpl->assign('FILE_INDEXOPTIONAL_LABEL', $owl_lang->optional_file_index);
	$xtpl->parse('main.AddFiles.index_optional');
      }

if ($default->use_file_expiry == 1)
{ 
   $xtpl->assign('FILE_EXPIRES_LABEL', $owl_lang->file_expires);
   $xtpl->parse('main.AddFiles.useFileExpiry');
}
      if ( $default->advanced_security == 1)
      {
		$xtpl->assign('FILE_SETACL_LABEL', $owl_lang->acl_set_acl_now);
      }
      // *****************************
      // PEER Review feature BEGIN
      // *****************************

      if ( $default->document_peer_review == 1 and empty($type))
      {
          $aUserList = fGetUserInfoInMyGroups($userid, "disabled <> '1' and email <> '' and id <> '$userid'");

          $i = 0;
          $reviewer = array();
          if (!empty($aUserList))
          {
             foreach ($aUserList as $aUsers)
             {
                $sUsername = $aUsers["username"];
                $sId = $aUsers["id"];
                $sName = $aUsers["name"];
                $sEmail = $aUsers["email"];

                $reviewer[$i][0] = $sId;
                $reviewer[$i][1] = $sName . " (" . $sEmail . ")";
                $i++;
             }
          }

            $rows = array();
            $rows = fPrintFormSelectBoxXTPL("REVIEWERS", "reviewers[]", $reviewer, array(), 10, true);
            $rowsize = count($rows);

            for ($i=1; $i<=$rowsize; $i++)
            {
              $xtpl->assign('SELECT_BOX', $rows[$i]);
              $xtpl->parse('main.AddFiles.Reviewers.SelectBox');
            }

            $xtpl->assign('FILE_REVIEWER_LIST_LABEL', $owl_lang->peer_reviewer_list);
	        $xtpl->assign('FILE_REVIEWER_MSG_LABEL', $owl_lang->peer_msg_to_reviewer);

            $xtpl->parse('main.AddFiles.Reviewers');
      }

      // *****************************
      // PEER Review feature END
      // *****************************


      if ($default->display_password_override == 1)
      {
         $xtpl->assign('FILE_NEWPASS_LABEL', $owl_lang->newpassword);
         $xtpl->assign('FILE_NEWPASS_VALUE', $sql->f("password"));
         $xtpl->assign('FILE_CONFIRM_LABEL', $owl_lang->confpassword);
         $xtpl->assign('FILE_CONFIRM_VALUE', $sql->f("password"));
         $xtpl->parse('main.AddFiles.PassWordOveride');
      }

      if ($type == "note")
      {
         $xtpl->assign('ADD_FILE_PAGE_TITLE', $owl_lang->add_note_page_title);
	 $xtpl->assign('FILE_ADDNOTE_LABEL', $owl_lang->note_content);
         $xtpl->assign('FILE_DESC_LABEL', $owl_lang->description);
         $xtpl->parse('main.AddFiles.AddNote');
      } 
      else
      {
         if (isset($doctype))
         {
            $qFieldLabel = new Owl_DB;

            $sql->query("SELECT id, field_values, field_name, field_type FROM $default->owl_docfields_table WHERE required = '1' ");

            $sDoctypeValidationScript = '';
            while ($sql->next_record())
            {
                   $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql->f('id') . "'");
                   $qFieldLabel->next_record();
                   switch ($sql->f("field_type"))
                   {
                      case "text":
                      case "date":
                      case "textarea":
               $sDoctypeValidationScript .= "
  if ( isEmptyField( formToValidate." . $sql->f("field_name"). ".value ) ) {
    alert( '" . strtoupper($sql->f("field_type")) . " " . $owl_lang->err_doc_field_is_req . " (" .$qFieldLabel->f("field_label") . ")');
    isValid = false;
  }
";
                      break;

                      case "checkbox":
                         $sDoctypeValidationScript .= "
  if(typeof(formToValidate." . $sql->f("field_name") .") !== 'undefined')
   {
      bIsOneisChecked = false;
      if (formToValidate." . $sql->f("field_name") . ".checked)
      {
         bIsOneisChecked = true;
      } 
      if (! bIsOneisChecked)
      {
         alert( '" . strtoupper($sql->f("field_type")) . " " . $owl_lang->err_doc_field_is_req . " (" .$qFieldLabel->f("field_label") . ")');
         isValid = false;
      }
   }
";
                      break;
                      case "mcheckbox":
                         $aMultipleCheckBox = preg_split("/\|/",  $sql->f("field_values"));
                         $i = 0;
                         $sDoctypeValidationScript .= "
  if(typeof(formToValidate." . $sql->f("field_name") ."_0) !== 'undefined')
   {
      bIsOneisChecked = false;";
              foreach ($aMultipleCheckBox as $sValues)
              {
               $sDoctypeValidationScript .= "
      if (formToValidate." . $sql->f("field_name") . "_$i" . ".checked)
      {
         bIsOneisChecked = true;
      } ";
               $i++;
              }

               $sDoctypeValidationScript .= "
          if (! bIsOneisChecked)
          {
             alert( '" . strtoupper($sql->f("field_type")) . " " . $owl_lang->err_doc_field_is_req . " (" .$qFieldLabel->f("field_label") . ")');
             isValid = false;
          }
   }
";
                      break;

                      case "radio":
               $sDoctypeValidationScript .= "
            var isResult = false
            if(typeof(formToValidate." . $sql->f("field_name") . ") !== 'undefined')
            {
               isResult = hasChosenRadio( formToValidate, '" . $sql->f("field_name") . "');
               if (! isResult)
               {
    alert( '" . strtoupper($sql->f("field_type")) . " " . $owl_lang->err_doc_field_is_req . " (" .$qFieldLabel->f("field_label") . ")');
                  isValid = false;
               }
            }
";
                      break;
                   }
            }
            $xtpl->assign('DOCTYPE_REQUIRED_FIELD_VALIDATION', $sDoctypeValidationScript );

         } 

         $xtpl->assign('FILE_DESC_REQUIRED', '');
         if ($default->file_desc_req == "1")
         {
            $xtpl->assign('FILE_DESC_REQUIRED', '*');
         }
         
         $xtpl->assign('FILE_DESC_LABEL', $owl_lang->description);

         if ($default->use_ubr_progress_bar == 1)
         {
            print("<tr><td class=\"form1\" width=\"100%\" colspan=\"2\"><br />");
            include "scripts/ubr_upload/ubr_file_upload_owl_include.php";
            print("<br /></td></tr>\n");
         }

      } 
      if ($type == "note")
      {
	 $xtpl->assign('FILE_BTN_ADD_FILE_ALT', $owl_lang->alt_btn_add_note);
         $xtpl->assign('FILE_BTN_ADD_FILE', $owl_lang->btn_add_note);
         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
      } 
      else if ($type == "url") 
      {
         $xtpl->assign('FILE_BTN_ADD_FILE_ALT', $owl_lang->alt_btn_add_url);
         $xtpl->assign('FILE_BTN_ADD_FILE', $owl_lang->btn_add_url);
         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);

      } 
      else 
      {
         if ($action == "file_upload" and $default->max_number_of_file_uploads > 0 )
         {
            $xtpl->parse('main.AddFiles.MultiAddFileJS');
         }
 
         if ($default->use_ubr_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" id=\"upload_button\" name=\"upload_button\" type=\"button\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"linkUpload();\"></input>");
         }
         else if ($default->use_progress_bar == 1)
         {
            $sJscript = " onClick=\"postIt();\"";
            print("<input  class=\"fbuttonup1\" name=\"send_file_x\" type=\"submit\" value=\"$owl_lang->sendfile\" alt=\"$owl_lang->alt_sendfile\" title=\"$owl_lang->alt_sendfile\" onmouseover=\"highlightButton('fbuttondown1', this)\" onmouseout=\"highlightButton('fbuttonup1', this)\" onClick=\"postIt();\"></input>");
         }
         else
         {
            $xtpl->assign('FILE_BTN_ADD_FILE_ALT', $owl_lang->alt_sendfile);
            $xtpl->assign('FILE_BTN_ADD_FILE', $owl_lang->sendfile);
         }
         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);


      }
      if ($default->show_folder_tools == 2 or $default->show_folder_tools == 3)
      {
         fPrintFolderToolsXTPL('Bottom', $iSaveNextfolders, $inextfiles, $iSaveDisplayFiles, $iSaveFileCount, $iSaveCurrentPage);
      }

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL("Bottom");
      }
      if ($type <> "note")
      {
         $xtpl->parse('main.AddFiles.FileUploads');
      }

      $xtpl->parse('main.AddFiles');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
   } 
   else
   {
      printError($owl_lang->err_noupload);
   } 
} 

if ($action == "file_modify")
{
   if (check_auth($id, "file_property", $userid) == 1)
   {
      $xtpl->assign('MOD_FILE_PAGE_TITLE', $owl_lang->edit_file_page_title);
      printModifyHeaderXTPL();

      /**
       * BEGIN Bozz Change
       * Retrieve Group information if the user is in the
       * Administrator group
       */

      $mygroup = owlusergroup($userid);

      if (fIsAdmin())
      {
         $groups = fGetGroups($userid);

         $sql->query("SELECT id,name FROM $default->owl_users_table ORDER BY name");

         $i = 0;
         while ($sql->next_record())
         {
            $users[$i][0] = $sql->f("id");
            $users[$i][1] = $sql->f("name");
            $i++;
         } 
      } 
      else
      {
         $current_groupid = owlfilegroup($id);
         if (uid_to_name($userid) == fid_to_creator($id) or fIsGroupAdmin($userid, $current_groupid))
         {
            $groups = fGetGroups($userid);
            $mygroup = owlusergroup($userid);

            $sql->query("SELECT id,name FROM $default->owl_users_table WHERE groupid='$mygroup' ORDER BY name");
            $i = 0;
            while ($sql->next_record())
            {
               $users[$i][0] = $sql->f("id");
               $users[$i][1] = $sql->f("name");
               $i++;
            } 
         } 
      } 

      /**
       * END Bozz Change
       */
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_files_table WHERE id = '$id'");
      $sql->next_record();

      $urlArgs2 = $urlArgs;
      $urlArgs2['action']  = 'file_modify';
      $urlArgs2['id']      = $id;
      $urlArgs2['saved_doctype'] = $sql->f("doctype");
      $urlArgs2['filename']  = $sql->f("filename");

      fPrintNavBarXTPL($parent, $owl_lang->modifying . ":&nbsp;", $id);

      //$xtpl->assign('FORM', "<form name=\"form_upload\" id=\"form_upload\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\" onsubmit=\"return isFormOK(this); return false;\">\n");

      $xtpl->assign('FORM', "<form action=\"dbmodify.php\" method=\"post\" onsubmit=\"return isFormOK(this); return false;\">\n");

      if ($sql->f("url") == 1)
      {
         $urlArgs2['type']  = "url";
      }
      if (fIsAdmin() || uid_to_name($userid) == fid_to_creator($id) or fIsGroupAdmin($userid, $current_groupid))
      {
         if ($default->advanced_security == 1)
         {
            $urlArgs2['security']  = $sql->f("security");
         }
      }
      else
      {
         $urlArgs2['file_owner']  = $sql->f("creatorid");
         $urlArgs2['security']  = $sql->f("security");
         $urlArgs2['groupid']  = $sql->f("groupid");
      }


      if ($default->owl_version_control == 1 and ! fIsAdmin())
      {
         $urlArgs2['major_revision']  = $sql->f("major_revision");
         $urlArgs2['minor_revision']  = $sql->f("minor_revision");
      }

      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      fPrintDoctypePickListXtpl($sql->f("doctype"), "EditFiles");

      $xtpl->assign('FILE_TITLE_LABEL', $owl_lang->title);
      $xtpl->assign('FILE_TITLE_VALUE', $sql->f("name"));


      $link = $default->owl_notify_link . "browse.php?sess=0&amp;parent=" . $parent . "&amp;expand=1&amp;fileid=" . htmlentities($id, ENT_COMPAT, $default->charset);

      $xtpl->assign('FILE_LINK_LABEL', $owl_lang->notify_link);
      $xtpl->assign('FILE_LINK_VALUE', $link);


      if ($sql->f("url") == 1)
      {
         $link = "<a href=\"" . $sql->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site\">" . $sql->f("filename") . "</a>";
         //fPrintFormTextLine($owl_lang->modify_url . ":" , "", "",  $link , "", true);
         //fPrintFormTextLine($owl_lang->file . ":" , "new_filename", 60,  $sql->f("filename"));
         $xtpl->assign('FILE_NEWNAME_LABEL', $owl_lang->file);
         $xtpl->assign('FILE_NEWNAME_VALUE', $sql->f("filename"));
         $xtpl->assign('FILE_URL_LABEL', $owl_lang->modify_url);
         $xtpl->assign('FILE_URL_VALUE', $link);
         $xtpl->parse('main.EditFiles.Url');

      } 
      else
      {
         $xtpl->assign('FILE_NEWNAME_LABEL', $owl_lang->file);
         $xtpl->assign('FILE_NEWNAME_VALUE', $sql->f("filename"));
         $xtpl->assign('FILE_NEWNAME_SIZE', '(' . gen_filesize($sql->f("f_size")) . ')');

      } 
      // if a MP3 tag was found Display the information
      $filepath = $default->owl_FileDir . DIR_SEP . get_dirpath($sql->f("parent")) . DIR_SEP . $sql->f("filename");

      if ($sql->f("url") == 0 && file_exists($filepath) and fFindFileExtension($sql->f('filename') == 'mp3'))
      {
         $id3 = new id3($filepath);

         if ($id3->id3v11 | $id3->id3v1)
         {
            $id3->study();
            $xtpl->assign('FILE_MP3_LABEL', $owl_lang->disp_mp3_id);

            $xtpl->assign('FILE_MP3_SONG_LABEL', $owl_lang->disp_mp3_song);
            $xtpl->assign('FILE_MP3_ALBUM_LABEL', $owl_lang->disp_mp3_album);
            $xtpl->assign('FILE_MP3_BITRATE_LABEL', $owl_lang->disp_mp3_bitrate);
            $xtpl->assign('FILE_MP3_DURATION_LABEL', $owl_lang->disp_mp3_duration);
            $xtpl->assign('FILE_MP3_GENRE_LABEL', $owl_lang->disp_mp3_genre);
            $xtpl->assign('FILE_MP3_COMMENT_LABEL', $owl_lang->disp_mp3_comments);

            $xtpl->assign('FILE_MP3_SONG', trim($id3->artists . " - " . $id3->name));
            $xtpl->assign('FILE_MP3_ALBUM', $id3->album);
            $xtpl->assign('FILE_MP3_BITRATE', "$id3->bitrate kbps&nbsp;&nbsp;$id3->frequency Hz&nbsp;$id3->mode");
            $xtpl->assign('FILE_MP3_DURATION', $id3->length);
            $xtpl->assign('FILE_MP3_GENRE', $id3->genre);
            $xtpl->assign('FILE_MP3_COMMENT', $id3->comment);

            $xtpl->parse('main.EditFiles.MP3');
         } 
      } 

      $security = $sql->f("security");
      $current_groupid = owlfilegroup($id);
      $current_owner = owlfilecreator($id);

      if (fIsAdmin() || uid_to_name($userid) == fid_to_creator($id) or fIsGroupAdmin($userid, $current_groupid))
      {
         $xtpl->assign('FILE_OWNER_LABEL', $owl_lang->ownership);

         foreach($users as $g)
         {
            $xtpl->assign('FILE_OWNER_VALUE', $g[0]);
            $xtpl->assign('FILE_OWNER_SELECTED', '');
            if ($g[0] == owlfilecreator($id))
            {
               $xtpl->assign('FILE_OWNER_SELECTED', "selected=\"selected\"");
            }

            $xtpl->assign('FILE_OWNER_CAPTION', $g[1]);
            $xtpl->parse('main.EditFiles.FileOwner.Owner');
         }

         $xtpl->parse('main.EditFiles.FileOwner');
         $xtpl->assign('FILE_GROUPOWNER_LABEL', $owl_lang->ownergroup);
         
         foreach($groups as $g)
         {
            $xtpl->assign('FILE_GROUPOWNER_VALUE', $g[0]);
            $xtpl->assign('FILE_GROUPOWNER_SELECTED', '');
            if ($g[0] == $current_groupid)
            {
               $xtpl->assign('FILE_GROUPOWNER_SELECTED', "selected=\"selected\"");
            }
            $xtpl->assign('FILE_GROUPOWNER_CAPTION', $g[1]);
            $xtpl->parse('main.EditFiles.FileGroupOwner.GroupOwner');
         }
         $xtpl->parse('main.EditFiles.FileGroupOwner');
      } 
      else
      {
         $xtpl->assign('FILE_OWNER_LABEL', $owl_lang->ownership);
         $xtpl->assign('FILE_OWNER_VALUE', fid_to_creator($id) . "&nbsp;(" . group_to_name(owlfilegroup($id)) . ")");
      
         $xtpl->parse('main.EditFiles.OtherUser');
      } 
      if ($default->save_keywords_to_db)
      {         
         $xtpl->assign('FILE_SAVEKEYWORDS_LABEL', $owl_lang->save_keyword);
         $xtpl->parse('main.EditFiles.SaveKeywords');
      } 

      $xtpl->assign('FILE_KEYWORDS_LABEL', $owl_lang->keywords);
      $xtpl->assign('FILE_KEYWORDS_SAVED_LABEL', $owl_lang->saved_keywords);
      $xtpl->assign('FILE_KEYWORDS_VALUE', $sql->f("metadata"));

      if ($default->save_keywords_to_db)
      {
         $found = false;
         $KeyWrd = new Owl_DB;
         $KeyWrd->query("SELECT keyword_text FROM $default->owl_keyword_table ORDER BY keyword_text");
         $i = 0;
         while ($KeyWrd->next_record())
         {
            $val = addcslashes($KeyWrd->f("keyword_text"), '()&');
            if(preg_grep("/$val/", preg_split("/\s+/", strtolower($sql->f("metadata")))))
            {
               $xtpl->assign('FILE_KEYWORD_LIST_SELECTED', " selected=\"selected\"");
               $found = true;
            }
            else
            {
               $xtpl->assign('FILE_KEYWORD_LIST_SELECTED', "");
            }

            $xtpl->assign('FILE_KEYWORD_LIST_LABEL', $KeyWrd->f("keyword_text")); 
            $xtpl->assign('FILE_KEYWORD_LIST_VALUE', $KeyWrd->f("keyword_text")); 
            $xtpl->parse('main.EditFiles.SaveKeywordsList.Options');
            $i++;
         }
         $xtpl->assign('FILE_KEYWORD_LIST_LABEL', $owl_lang->none_selected);
         $xtpl->assign('FILE_KEYWORD_LIST_VALUE', ' '); 
         $xtpl->assign('FILE_KEYWORD_LIST_SELECTED', '');
         if (!$found)
         {
            $xtpl->assign('FILE_KEYWORD_LIST_SELECTED', " selected=\"selected\"");
         } 
         $xtpl->parse('main.EditFiles.SaveKeywordsList.Options');
         $xtpl->parse('main.EditFiles.SaveKeywordsList');
      }
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
      if ($default->docRel == 1)
      {
            $docRel = new Owl_DB;

            $docRel->query("SELECT id FROM $default->owl_files_table WHERE id NOT LIKE $id ORDER BY id");

            while ($docRel->next_record())
            {
               $docsRel[$i][0] = $docRel->f("id");
               $docsRel[$i][1] = $default->doc_id_prefix . str_pad($docRel->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
            }

            if (isset($id))
            {
                $docRel->query("SELECT related_file_id FROM $default->docRel_table WHERE file_id='$id' ORDER BY related_file_id");
                while ($docRel->next_record())
                {
                    $relatedDocs = $relatedDocs . $docRel->f("related_file_id") . " ";
                }
                $rows = array();
                $rows = fPrintFormSelectBoxXTPL("DOCREL", "docRelPick[]", $docsRel, $relatedDocs, 10, true);
            }
            else
            {
                $rows = array();
                $rows = fPrintFormSelectBoxXTPL("DOCREL", "docRelPick[]", $docsRel, array(), 10, true);
            }

            $rowsize = count($rows);

            for ($i=1; $i<=$rowsize; $i++)
            {
              $xtpl->assign('SELECT_BOX', $rows[$i]);
              $xtpl->parse('main.EditFiles.DocRel.SelectBox');
            }

            $xtpl->assign('FILE_DOCREL_LIST_LABEL', $owl_lang->docRel_list);

            $xtpl->parse('main.EditFiles.DocRel');

      }
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************

      if ($default->owl_version_control == 1 and fIsAdmin())
      {
         $xtpl->assign('FILE_MAJORVERSION_LABEL', $owl_lang->vermajor);
         $xtpl->assign('FILE_MAJORVERSION_VALUE', $sql->f("major_revision"));
         $xtpl->assign('FILE_MAJORVERSION_READONLY', '');
         $xtpl->assign('FILE_MINORVERSION_LABEL', $owl_lang->verminor);
         $xtpl->assign('FILE_MINORVERSION_VALUE', $sql->f("minor_revision"));
         $xtpl->assign('FILE_MINORVERSION_READONLY', '');
         $xtpl->assign('FILE_MAJORVERSION_READONLY', '');
         $xtpl->parse('main.EditFiles.Version');
      }
      else
      {
         if ($default->owl_version_control == 1)
         {
            $xtpl->assign('FILE_MAJORVERSION_LABEL', $owl_lang->vermajor);
            $xtpl->assign('FILE_MAJORVERSION_VALUE', $sql->f("major_revision"));
            $xtpl->assign('FILE_MAJORVERSION_READONLY', 'readonly="readonly"');
            $xtpl->assign('FILE_MINORVERSION_LABEL', $owl_lang->verminor);
            $xtpl->assign('FILE_MINORVERSION_VALUE', $sql->f("minor_revision"));
            $xtpl->assign('FILE_MINORVERSION_READONLY', 'readonly="readonly"');
            $xtpl->parse('main.EditFiles.Version');
         }
      }
      if ($default->use_file_expiry == 1)
      {
         $xtpl->assign('FILE_EXPIRES_LABEL', $owl_lang->file_expires);
         $xtpl->assign('FILE_EXPIRES_VALUE', $sql->f("expires"));
         $xtpl->parse('main.EditFiles.useFileExpiry');
      }

      if ($default->display_password_override == 1)
      {
         if (fIsAdmin() || uid_to_name($userid) == fid_to_creator($id))
         {
            $xtpl->assign('FILE_NEWPASS_LABEL', $owl_lang->newpassword);
            $xtpl->assign('FILE_NEWPASS_VALUE', $sql->f("password"));
            $xtpl->assign('FILE_CONFIRM_LABEL', $owl_lang->confpassword);
            $xtpl->assign('FILE_CONFIRM_VALUE', $sql->f("password"));
            $xtpl->parse('main.EditFiles.PassWordOveride');
         }
      }

      if ($sql->f("url") == 2)
      {
         if ($default->owl_use_fs)
         {
            $iRealFileID = fGetPhysicalFileId($id);

            $filename = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($iRealFileID)) . DIR_SEP . flid_to_filename($iRealFileID);
            $contents = file_get_contents($filename);
         } 
         else
         {
            $path = fGetFileFromDatbase($id);
            $contents = file_get_contents($path);
         } 
         $xtpl->assign('FILE_DESC_LABEL', $owl_lang->description);
         $xtpl->assign('FILE_DESC_VALUE', $sql->f("description"));

         $xtpl->assign('OWL_SESS', $sess);

         $xtpl->assign('FILE_NOTE_LABEL', $owl_lang->note_content);
         $xtpl->assign('FILE_NOTE_VALUE', $contents);
         $xtpl->parse('main.EditFiles.NoteContent');
      } 
      else
      {
         $iRealFileID = fGetPhysicalFileId($id);
	 if ($iRealFileID <> $id)
	 {
            $xtpl->assign('OWL_SESS', $sess);
            $xtpl->assign('DOCTYPE_ID', $sql->f("doctype"));
            $xtpl->assign('DOCTYPE_RO', 'RO');
            $xtpl->assign('FILE_ID', $iRealFileID);
	 }
	 else
	 {
            $xtpl->assign('OWL_SESS', $sess);
            $xtpl->assign('DOCTYPE_ID', $sql->f("doctype"));
            $xtpl->assign('FILE_ID', $sql->f("id"));
            fGenDoctypeFieldJSValidation ();
	 }

         $xtpl->assign('FILE_DESC_REQUIRED', '');
         if ($default->file_desc_req == "1")
         {
            $xtpl->assign('FILE_DESC_REQUIRED', '*');
         }
         $xtpl->assign('FILE_DESC_LABEL', $owl_lang->description);
         $xtpl->assign('FILE_DESC_VALUE', $sql->f("description"));
      } 

      $xtpl->assign('FILE_BTN_MOD_FILE_ALT', $owl_lang->alt_change);
      $xtpl->assign('FILE_BTN_MOD_FILE', $owl_lang->change);
      $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
      $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);

      if ($default->thumbnails == 1)
      {
         $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $sql->f("id") . "_large.png";

         $fid = fGetPhysicalFileId($sql->f("id"));
         if ($default->owl_use_fs)
         {
            $path = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($fid)) . DIR_SEP . flid_to_filename($fid);
         }
         else
         {
            $path = fGetFileFromDatbase($sql->f("id"));
         }

         $sFileUrl = "$default->owl_graphics_url/$default->sButtonStyle/ui_misc/thumb_no.png";

         if (file_exists($sThumbLoc))
         {
            $imdata = file_get_contents($path);
            $sFileUrl = 'data:image/png;base64,' . base64_encode($imdata);

            $xtpl->assign('FILE_CUR_FILE_URL', $sFileUrl);

            if (exif_imagetype($sThumbLoc))
            {
               $imdata = file_get_contents($sThumbLoc);
               $sFileUrl = 'data:image/png;base64,' . base64_encode($imdata);
            }
         }

         $xtpl->assign('FILE_LARGE_THUMB_URL', $sFileUrl);

         $xtpl->parse('main.EditFiles.DocLargeThumb');
   }

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL("Bottom");
   }
      $xtpl->parse('main.EditFiles');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
} 
   else
   {
      printError($owl_lang->err_nofilemod);
   } 
} 

if ($action == "folder_create")
{
   if (check_auth($parent, "folder_create", $userid) == 1)
   {

      $xtpl->assign('ADD_FOLDER_PAGE_TITLE', $owl_lang->add_folder_page_title);
      printModifyHeaderXTPL(); 

      $iFolderParentGroupOwner = owlfoldergroup($parent);

      $groups = fGetGroups($userid);

      fPrintNavBarXTPL($parent, $owl_lang->addingfolder . ":&nbsp;");

      $urlArgs2 = $urlArgs;
      $urlArgs2['action']  = 'folder_create';
      if ( $default->advanced_security == 1 )
      {
         $urlArgs2['security']   = "6"; // FILE SECURITY
         $urlArgs2['policy']   = "54"; // FOLDER SECURITY
         $urlArgs2['groupid']   = $usergroupid; // FOLDER SECURITY
      }

      $xtpl->assign('FORM', "<form name=\"modify\" id=\"modify\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">");

      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      if ($default->rss_feed_enabled == 1)
      {
         $xtpl->assign('RSS_YES', $owl_lang->rss_feed_yes_label);
         $xtpl->assign('RSS_YES_VALUE', '1');
         $xtpl->assign('RSS_YES_SELECTED', '');
         $xtpl->assign('RSS_NO', $owl_lang->rss_feed_no_label);
         $xtpl->assign('RSS_NO_VALUE', '0');
         $xtpl->assign('RSS_NO_SELECTED', 'checked="checked"');
         $xtpl->assign('RSS_LABEL', $owl_lang->rss_feed_label);
         $xtpl->parse('main.CreateFolder.RssFeed');

      }

	  $xtpl->assign('FOLDER_NAME_LABEL', $owl_lang->name);

      $xtpl->assign('FOLDER_GROUP_LABEL', $owl_lang->ownergroup);

      foreach($groups as $g)
      {
         $xtpl->assign('FOLDER_GROUP_ID', $g[0]);
         $xtpl->assign('FOLDER_GROUP_ID_SELECTED', '');
         if ($g[0] == $iFolderParentGroupOwner)
         {
            $xtpl->assign('FOLDER_GROUP_ID_SELECTED', 'selected="selected"');
         }

         $xtpl->assign('FOLDER_GROUP_ID_LABEL', $g[1]);
         $xtpl->parse('main.CreateFolder.Groups');
      }

      if ( $default->advanced_security == 1)
      {
         $xtpl->assign('SET_SECURITY_LABEL', $owl_lang->acl_set_acl_now);
      }
      else
      {
         if (fIsAdmin())
         {
            printgroupperm($default->folder_perm, "policy", $owl_lang->policy, "admin");
         }
         else
         {
            printgroupperm($default->folder_perm, "policy", $owl_lang->policy, "user");
         }
      }

      if ($default->display_password_override == 1)
      {
         $xtpl->assign('FOLDER_NEWPASS_LABEL', $owl_lang->newpassword);
         $xtpl->assign('FOLDER_NEWPASS_VALUE', $sql->f("password"));
         $xtpl->assign('FOLDER_CONFIRM_LABEL', $owl_lang->confpassword);
         $xtpl->assign('FOLDER_CONFIRM_VALUE', $sql->f("password"));
         $xtpl->parse('main.CreateFolder.PassWordOveride');
      }
      $xtpl->assign('FOLDER_DESC_REQUIRED', '');
      if ($default->folder_desc_req == "1")
      {
         $xtpl->assign('FOLDER_DESC_REQUIRED', '*');
      }
      $xtpl->assign('FOLDER_DESC_LABEL', $owl_lang->description);

      $xtpl->assign('FOLDER_BTN_CREATE', $owl_lang->create);
      $xtpl->assign('FOLDER_BTN_CREATE_ALT', $owl_lang->alt_btn_add_folder);
      $xtpl->assign('FOLDER_BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('FOLDER_BTN_RESET_ALT', $owl_lang->alt_reset_form);

      if ($default->show_folder_tools == 2 or $default->show_folder_tools == 3)
      {
         fPrintFolderToolsXTPL('Bottom', $iSaveNextfolders, $inextfiles, $iSaveDisplayFiles, $iSaveFileCount, $iSaveCurrentPage);
      }

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL('Bottom');
      }

      $xtpl->parse('main.CreateFolder');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_nosubfolder);
   } 
} 

if ($action == "folder_modify")
{
   if (check_auth($id, "folder_property", $userid) == 1)
   {
     
      $xtpl->assign('MOD_FOLDER_PAGE_TITLE', $owl_lang->edit_folder_page_title);
      printModifyHeaderXTPL(); 
      /**
       * BEGIN Bozz Change
       * Retrieve Group information if the user is in the
       * Administrator group
       */

      if (fIsAdmin() or fIsGroupAdmin($userid, owlfoldergroup($id)))
      {
         $groups = fGetGroups($userid);

         $sql->query("SELECT id,name FROM $default->owl_users_table ORDER BY name");
         $i = 0;
         while ($sql->next_record())
         {
            $users[$i][0] = $sql->f("id");
            $users[$i][1] = $sql->f("name");
            $i++;
         } 
      } 
      else 
      {
         if ($userid == owlfoldercreator($id))
         {
            $groups = fGetGroups($userid);
            $mygroup = owlusergroup($userid);

            $sql->query("SELECT id,name FROM $default->owl_users_table WHERE groupid='$mygroup' ORDER BY name");
            $i = 0;
            while ($sql->next_record())
            {
               $users[$i][0] = $sql->f("id");
               $users[$i][1] = $sql->f("name");
               $i++;
            }

         }
      }

      fPrintNavBarXTPL($id, $owl_lang->modifying . ":&nbsp;");
 
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_folders_table WHERE id = '$id'");
      while ($sql->next_record())
      {
         $security = $sql->f("security");
         $urlArgs2 = $urlArgs;
         $urlArgs2['id']  = $id;
         $urlArgs2['action']  = 'folder_modify';

         if ($default->advanced_security == 1 )
         {
            $urlArgs2['policy']   = $security; // FILE SECURITY
            $urlArgs2['groupid']   = $sql->f("groupid"); // FOLDER SECURITY
         }
                                                                                                                                                                                         
         $xtpl->assign('FORM', "<form name=\"modify\" id=\"modify\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">");

         $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

         if ($default->rss_feed_enabled == 1)
         {
            if  ($sql->f("rss_feed") == '1')
            {
               $xtpl->assign('RSS_YES_SELECTED', 'checked="checked"');
               $xtpl->assign('RSS_NO_SELECTED', '');
            }
            else
            {
               $xtpl->assign('RSS_YES_SELECTED', '');
               $xtpl->assign('RSS_NO_SELECTED', 'checked="checked"');
            }
            $xtpl->assign('RSS_YES', $owl_lang->rss_feed_yes_label);
            $xtpl->assign('RSS_YES_VALUE', '1');
            $xtpl->assign('RSS_NO', $owl_lang->rss_feed_no_label);
            $xtpl->assign('RSS_NO_VALUE', '0');
            $xtpl->assign('RSS_LABEL', $owl_lang->rss_feed_label);
            $xtpl->parse('main.EditFolder.RssFeed');
         }


         $xtpl->assign('FOLDER_NAME_LABEL', $owl_lang->name);
         $xtpl->assign('FOLDER_NAME_VALUE', $sql->f("name"));

         $link = $default->owl_notify_link . "browse.php?sess=0&amp;parent=". $id ."&amp;expand=1&amp;fileid=0";

         $xtpl->assign('FOLDER_LINK_LABEL', $owl_lang->notify_link);
         $xtpl->assign('FOLDER_LINK_VALUE', $link);


         if (fIsAdmin() || $userid == owlfoldercreator($id))
         {
            $xtpl->assign('FOLDER_OWNER_LABEL', $owl_lang->ownership);
            foreach($users as $g)
            {
               $xtpl->assign('FOLDER_OWNER_ID', $g[0]);
               $xtpl->assign('FOLDER_OWNER_ID_SELECTED', '');
               if ($g[0] == owlfoldercreator($id))
               {
                  $xtpl->assign('FOLDER_OWNER_ID_SELECTED', 'selected="selected"');
               }
               $xtpl->assign('FOLDER_OWNER_ID_LABEL', $g[1]);
               $xtpl->parse('main.EditFolder.Owner.Groups');
            }
            $xtpl->parse('main.EditFolder.Owner');
         }

         /**
          * BEGIN Bozz Change
          * Display Retrieved Group information if the user is in the
          * Administrator group
          */
         if ($userid == owlfoldercreator($id) or fIsAdmin() or fIsGroupAdmin($userid, owlfoldergroup($id)))
         {
            $xtpl->assign('FOLDER_GROUP_LABEL', $owl_lang->ownergroup);

            foreach($groups as $g)
            {
               $xtpl->assign('FOLDER_GROUP_ID', $g[0]);
               $xtpl->assign('FOLDER_GROUP_ID_SELECTED', '');
               if ($g[0] == $sql->f("groupid"))
               {
                  $xtpl->assign('FOLDER_GROUP_ID_SELECTED', 'selected="selected"');
               }
               $xtpl->assign('FOLDER_GROUP_ID_LABEL', $g[1]);
               $xtpl->parse('main.EditFolder.GroupOwner.Groups');

            }
            $xtpl->parse('main.EditFolder.GroupOwner');
         }

         if (!$default->advanced_security)
         {
            if (fIsAdmin())
            {
               printgroupperm($security, "policy", $owl_lang->policy, "admin");
            }
            else
            {
               printgroupperm($security, "policy", $owl_lang->policy, "user");
            }
         }

         if ($default->display_password_override == 1)
         {
            if ($userid == owlfoldercreator($id) or fIsAdmin())
            {
               $xtpl->assign('FOLDER_NEWPASS_LABEL', $owl_lang->newpassword);
               $xtpl->assign('FOLDER_NEWPASS_VALUE', $sql->f("password"));
               $xtpl->assign('FOLDER_CONFIRM_LABEL', $owl_lang->confpassword);
               $xtpl->assign('FOLDER_CONFIRM_VALUE', $sql->f("password"));
               $xtpl->parse('main.EditFolder.PassWordOveride');
            }
         }

         $xtpl->assign('FOLDER_DESC_REQUIRED', '');
         if ($default->folder_desc_req == "1")
         {
            $xtpl->assign('FOLDER_DESC_REQUIRED', '*');
            $sRequiredDesc = "<font color=\"red\"><b>&nbsp;*&nbsp;</b></font>";
         }

         $xtpl->assign('FOLDER_DESC_LABEL', $owl_lang->description);
         $xtpl->assign('FOLDER_DESC_VALUE', $sql->f("description"));

         $xtpl->assign('FOLDER_BTN_MOD', $owl_lang->change);
         $xtpl->assign('FOLDER_BTN_MOD_ALT', $owl_lang->alt_change);
         $xtpl->assign('FOLDER_BTN_RESET', $owl_lang->btn_reset);
         $xtpl->assign('FOLDER_BTN_RESET_ALT', $owl_lang->alt_reset_form);

      }

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXTPL("Bottom");
      }

      $xtpl->parse('main.EditFolder');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_nofoldermod);
   } 
} 

if ($action == "bulk_email")
{
   $xtpl->assign('BULK_EMAIL_PAGE_TITLE', $owl_lang->bulk_mail_page_title);
   printModifyHeaderXTPL();
   $disp = unserialize(stripslashes($id));
   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
   $sql->next_record();
   $default_reply_to = $sql->f("email");

   fPrintNavBarXTPL($parent, $owl_lang->emailing . ":&nbsp;");

   $query = "SELECT * FROM $default->owl_files_table WHERE ";
   foreach($disp as $fid)
   {
      if (check_auth($fid, "file_email", $userid) == 1)
      {
               $query .= "id = '" . $fid . "' or ";
      }
   }

   $query .= "id = " . $fid . " and 1=1";
   $sql->query("$query");

   $xtpl->assign("EMAILING_TITLE", $owl_lang->emailing);

   while ($sql->next_record())
   {
      $fname = $sql->f("filename");
      $xtpl->assign("EMAILING_FILE", $fname);
      $xtpl->parse('main.BulkEmailFiles.FilesList');
   }

   $urlArgs2 = $urlArgs;
   $urlArgs2['id']     = $id;
   $urlArgs2['action'] = 'bulk_email';
   $urlArgs2['MAX_FILE_SIZE'] = $default->max_filesize;

   $xtpl->assign("FORM", "<form enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">");
   if (!$default->use_smtp)
   {
       $urlArgs2['ccto']   = '';
   }
   $xtpl->assign("HIDDEN_FIELDS", fGetHiddenFields ($urlArgs2));

   $xtpl->assign("FILE_ATTACH_LABEL", $owl_lang->attach_file);
   $xtpl->assign("FILE_MAILTO_LABEL", $owl_lang->email_to);

   $aEmailList = fGetUserInfoInMyGroups($userid, "disabled <> '1' and email <> ''");

   $xtpl->assign("FILE_PICK_ONE", $owl_lang->pick_select);

   foreach ($aEmailList as $aUsers)
   {
      $sUsername = $aUsers["username"];
      $sName = $aUsers["name"];
      $sEmail = $aUsers["email"];

      $xtpl->assign('FILE_MAILTO_VALUE', $sEmail);

      if ($sName == "")
      {
	     $xtpl->assign('FILE_MAILTO_CAPTION', $sUsername . " &#8211; (" . $sEmail . ")");
      }
      else
      {
         $xtpl->assign('FILE_MAILTO_CAPTION', $sName . " &#8211; (" . $sEmail . ")");
      }
      $xtpl->parse('main.BulkEmailFiles.Recipients.Email');

   }

  $xtpl->parse('main.BulkEmailFiles.Recipients');

   if ($default->use_smtp)
   {
      $xtpl->assign('FILE_EMAIL_CCTO_LABEL', $owl_lang->email_cc);
      $xtpl->parse('main.BulkEmailFiles.Recipients.CCto');
   }

    
   $xtpl->assign('FILE_EMAIL_REPLYTO_LABEL', $owl_lang->email_reply_to);
   $xtpl->assign('FILE_EMAIL_REPLYTO_VALUE', $default_reply_to);
   $xtpl->assign('FILE_EMAIL_SUBJ_LABEL', $owl_lang->email_subject);
   $xtpl->assign('FILE_EMAIL_SUBJ_VALUE', $default->owl_email_subject);
   $xtpl->assign('FILE_EMAIL_MSG_LABEL', $owl_lang->email_body);
   $xtpl->assign('FILE_EMAIL_USESIG_LABEL', $owl_lang->owl_use_email_signature);
   $xtpl->assign('FILE_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
   $aOtherPrefs = fGetUserOtherPrefs($userid);
   $xtpl->assign('FILE_EMAIL_SIG_VALUE',$aOtherPrefs['email_sig']);

   $xtpl->assign('BTN_SEND_EMAIL', $owl_lang->btn_send_email);
   $xtpl->assign('BTN_SEND_EMAIL_ALT', $owl_lang->alt_send_email);

   $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
   $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
     fPrintPrefsXTPL("Bottom");
   }
   
   $xtpl->parse('main.BulkEmailFiles');
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');
} 

if ($action == "file_email")
{
   if (check_auth($id, "file_email", $userid) == 1)
   {
      $xtpl->assign('EMAIL_FILE_PAGE_TITLE', $owl_lang->email_file_page_title );
      printModifyHeaderXTPL();

      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
      $sql->next_record();
      $default_reply_to = $sql->f("email");

      fPrintNavBarXTPL($parent, $owl_lang->emailing . ":&nbsp;", $id);
      $urlArgs2 = $urlArgs;
      $urlArgs2['id']     = $id;
      $urlArgs2['action'] = 'file_email';
      $urlArgs2['type']   = $type;
      $urlArgs2['MAX_FILE_SIZE'] = $default->max_filesize;


      $xtpl->assign('FORM', "<form id=\"form_email\" name=\"form_email\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">\n");
      if (!$default->use_smtp)
      {
         $urlArgs2['ccto']   = '';
      }
	  $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));
      $xtpl->assign('FILE_ATTACH_LABEL', $owl_lang->attach_file);
      $xtpl->assign("FILE_MAILTO_LABEL", $owl_lang->email_to);

      $aEmailList = fGetUserInfoInMyGroups($userid, "disabled <> '1' and email <> ''");

      $xtpl->assign('FILE_PICK_ONE', $owl_lang->pick_select);

      foreach ($aEmailList as $aUsers)
      {
         $sUsername = $aUsers["username"];
         $sName = $aUsers["name"];
         $sEmail = $aUsers["email"];

         $xtpl->assign('FILE_MAILTO_VALUE', $sEmail);

         if ($sName == "")
         {
            $xtpl->assign('FILE_MAILTO_CAPTION', $sUsername . " &#8211; (" . $sEmail . ")");
         }
         else
         {
            $xtpl->assign('FILE_MAILTO_CAPTION', $sName . " &#8211; (" . $sEmail . ")");
         }
         $xtpl->parse('main.EmailFiles.Recipients.Email');
      }
      $xtpl->parse('main.EmailFiles.Recipients');
 
      if ($default->use_smtp)
      {
         $xtpl->assign('FILE_EMAIL_CCTO_LABEL', $owl_lang->email_cc);
         $xtpl->parse('main.EmailFiles.CCto');
      }

      $xtpl->assign('FILE_EMAIL_REPLYTO_LABEL', $owl_lang->email_reply_to);
      $xtpl->assign('FILE_EMAIL_REPLYTO_VALUE', $default_reply_to);
      
      $xtpl->assign('FILE_EMAIL_SUBJ_LABEL', $owl_lang->email_subject);
      $xtpl->assign('FILE_EMAIL_SUBJ_VALUE', $default->owl_email_subject);
      
      $xtpl->assign('FILE_EMAIL_MSG_LABEL', $owl_lang->email_body);
      
      $xtpl->assign('FILE_EMAIL_USESIG_LABEL', $owl_lang->owl_use_email_signature);

      $aOtherPrefs = fGetUserOtherPrefs($userid);
      $xtpl->assign('FILE_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
      $xtpl->assign('FILE_EMAIL_SIG_VALUE',$aOtherPrefs['email_sig']);

      $xtpl->assign('FILE_BTN_EMAIL', $owl_lang->btn_send_email);
      $xtpl->assign('FILE_BTN_EMAIL_ALT', $owl_lang->alt_send_email);
      $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
        fPrintPrefsXTPL("Bottom");
      }
      $xtpl->parse('main.EmailFiles');
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_noemail);
   } 
} 
