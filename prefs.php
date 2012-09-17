<?php

/*
 * prefs.php
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
 * $Id: prefs.php,v 1.6 2006/03/06 17:39:34 b0zz Exp $
*/

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/prefs.xtpl");
$xtpl = new XTemplate("html/prefs.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);



if ($sess == "0" && $default->anon_ro > 0)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

fSetLogo_MOTD();
fSetPopupHelp();

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

if(empty($expand))
{
   $expand = $default->expand;
}

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[$sortorder] = $sortname;
if ($expand == 1)
{
   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
}
else
{ 
   $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
}

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Top");
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent, "&nbsp;");

if (!$action) 
{
   $action = "users";
}

function printuser($id)
{
   global $order, $sortname, $sort;
   global $sess, $change, $default, $expand, $parent, $userid;
   global $owl_lang, $urlArgs;
   global $xtpl;

   $showuser = false;
   $aOtherPrefs = fGetUserOtherPrefs($id);
   $sEmailSig = $aOtherPrefs['email_sig'];

   
   if (prefaccess($userid) and $userid == $id)
   {
      $showuser = true;
   }
   if ($default->show_user_info == 0 and $showuser == false)
   {
      printError("$owl_lang->err_general");
   }

   if (isset($change))
   {
       fPrintSectionHeader($owl_lang->saved, "admin3");
   }

   $sql = new Owl_DB;
   $sql->query("SELECT id,name FROM $default->owl_groups_table");
   $i = 0;
   while ($sql->next_record())
   {
      $groups[$i][0] = $sql->f("id");
      $groups[$i][1] = $sql->f("name");
      $i++;
   } 

   $sql->query("SELECT * FROM $default->owl_users_table where id = '$id'");

   while ($sql->next_record())
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['id'] = $sql->f("id");
      $urlArgs2['action'] = 'user';
      $urlArgs2['sortname'] = $sortname;

      $xtpl->assign('FORM', "<form name=\"form_prefs\" id=\"form_prefs\" enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">\n");
      
      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));
      $xtpl->assign('PREF_PAGE_TITLE', $owl_lang->preference);
      // 
      // Show the Title
      // 
      $xtpl->assign('PREF_TITLE_LABEL', $owl_lang->title);
      $xtpl->assign('PREF_TITLE_VALUE', $sql->f("name"));

      if ($showuser)
      {
         $xtpl->parse('main.EditPrefs.Title');
      } 
      else
      {
         $xtpl->parse('main.EditPrefs.TitleRO');
      } 
      // 
      // Display the Primary group
      // and groups the user is a member
      // of
      // 
      $xtpl->assign('PREF_GROUP_LABEL', $owl_lang->group);
      $xtpl->assign('PREF_GROUP_VALUE', group_to_name($sql->f("groupid")));

      $sqlmemgroup = new Owl_DB;
      $sqlmemgroup->query("SELECT * FROM $default->owl_users_grpmem_table where groupid is not NULL and userid = '" . $sql->f("id") . "'");
      $xtpl->assign('PREF_GROUP_MEM_LABEL', $owl_lang->groupmember);
      if ($sqlmemgroup->num_rows() > 0)
      {
         $sGroups = "";
         while ($sqlmemgroup->next_record())
         {
            $sGroups .= "<br />" . group_to_name($sqlmemgroup->f("groupid"));
         }
         $xtpl->assign('PREF_GROUP_MEM_VALUE', $sGroups);
      }
      else
      {
         $xtpl->assign('PREF_GROUP_MEM_VALUE', $owl_lang->not_member);
      }


      // 
      // Display the Language dropdown
      // 
      $xtpl->assign('PREF_USER_LANG_LABEL', $owl_lang->userlang);
      if ($showuser)
      {
         $aLanguages = fGetLocales();
         foreach ($aLanguages as $file)
         {
            $xtpl->assign('PREF_USER_LANG_VALUE', $file);
            $xtpl->assign('PREF_USER_LANG_LABEL', $file);
            if ($file == $sql->f("language"))
            {
               $xtpl->assign('PREF_USER_LANG_SELECTED', " selected=\"selected\"");
            }
            else
            {
               $xtpl->assign('PREF_USER_LANG_SELECTED', "");
            }
            $xtpl->parse('main.EditPrefs.Lang.Values');
         }
         $xtpl->parse('main.EditPrefs.Lang');
      } 
      else
      {
         $xtpl->assign('PREF_USER_LANG_VALUE', $sql->f("language"));
         $xtpl->parse('main.EditPrefs.LangRO');
      } 

      $xtpl->assign('PREF_BUTTON_STYLE_LABEL', $owl_lang->userlang);

      $dir = dir($default->owl_fs_root . "/templates");
      $dir->rewind();

      while ($file = $dir->read())
      {
         if (is_dir($default->owl_fs_root . "/templates/" . $file))
         {
            if ($file[0] != "." and $file != "CVS" and $file != "favicon.ico" and $file[0] != "_")
            {
               $xtpl->assign('PREF_STYLE_VALUE', $file);
               $xtpl->assign('PREF_STYLE_LABEL', $file);
               
               if ($file == $sql->f("buttonstyle"))
               {
                  $xtpl->assign('PREF_STYLE_SELECTED', " selected=\"selected\"");
               }
               else
               {
                  $xtpl->assign('PREF_STYLE_SELECTED', "");
               }
               $xtpl->parse('main.EditPrefs.StyleValues');
            }
         }
      }
      $dir->close();

      // 
      // Display the Password
      // change input text
      // 
      if ($showuser)
      {
         if ($sql->f("user_auth") == 0 )
         {
		    $xtpl->assign('PREFS_OLD_PASS_LABEL', $owl_lang->oldpassword);
            $xtpl->assign('PREFS_NEW_PASS_LABEL', $owl_lang->newpassword);
            $xtpl->assign('PREFS_CONF_PASS_LABEL', $owl_lang->confpassword);
            $xtpl->parse('main.EditPrefs.Passwords');
         }
      } 
      // 
      // Display the Email
      // 
      $xtpl->assign('PREFS_EMAIL_LABEL', $owl_lang->email);
      $xtpl->assign('PREFS_EMAIL_VALUE', $sql->f('email'));

      if ($showuser)
      {
         $xtpl->parse('main.EditPrefs.Email');
      } 
      else
      {
         $xtpl->parse('main.EditPrefs.EmailRO');
      } 

      if ($showuser)
      {
         $xtpl->assign('PREFS_NOTIFY_LABEL', $owl_lang->notification);
         $xtpl->assign('PREFS_NOTIFY_CHECKED', '');
         if ($sql->f("notify") == 1)
         {
            $xtpl->assign('PREFS_NOTIFY_CHECKED', 'checked="checked"');
         }
         $xtpl->parse('main.EditPrefs.Notify');
         $xtpl->assign('PREFS_ATTACH_LABEL', $owl_lang->attach_file);
         $xtpl->assign('PREFS_ATTACH_CHECKED', '');
         if ($sql->f("attachfile") == 1)
         {
            $xtpl->assign('PREFS_ATTACH_CHECKED', 'checked="checked"');
         }
         $xtpl->parse('main.EditPrefs.AttachFile');
         $xtpl->assign('PREFS_VIEW_LABEL', $owl_lang->owl_user_default_view  );
         $xtpl->assign('PREFS_VIEW_CHECKED', '');

         if ($sql->f("user_default_view") == 1)
         {
            $xtpl->assign('PREFS_VIEW_CHECKED', 'checked="checked"');
         }
         $xtpl->parse('main.EditPrefs.PrefsView');

         if ($default->owl_version_control == 1)
         {
            $xtpl->assign('PREFS_MAJOR_REV_LABEL', $owl_lang->vermajor_initial);
            $xtpl->assign('PREFS_MAJOR_REV_VALUE', $sql->f("user_major_revision"));
            $xtpl->assign('PREFS_MINOR_REV_LABEL', $owl_lang->verminor_initial);
            $xtpl->assign('PREFS_MINOR_REV_VALUE', $sql->f("user_minor_revision")); 
            $xtpl->parse('main.EditPrefs.Revision');
         }

         $xtpl->assign('PREFS_LOG_TO_NEWREC_LABEL', $owl_lang->user_login_to_newrecords);
         $xtpl->assign('PREFS_LOG_TO_NEWREC_CHECKED', '');
         if ($sql->f("logintonewrec") == 1)
         {
            $xtpl->assign('PREFS_LOG_TO_NEWREC_CHECKED', 'checked="checked"');
         }
         $xtpl->parse('main.EditPrefs.LoginToNewRec');

         $xtpl->assign('PREFS_COMMENT_NOTIFY_LABEL', $owl_lang->comment_notif);
         $xtpl->assign('PREFS_COMMENT_NOTIFY_CHECKED', '');
         if ($sql->f("comment_notify") == 1)
         {
            $xtpl->assign('PREFS_COMMENT_NOTIFY_CHECKED', 'checked="checked"');
         }
         $xtpl->parse('main.EditPrefs.CommentNotify');
         
         $xtpl->assign('PREFS_USER_ADMIN_LABEL', $owl_lang->useradmin);
         $xtpl->assign('PREFS_USER_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("useradmin") == 1)
         {
            $xtpl->assign('PREFS_USER_ADMIN_VALUE', $owl_lang->status_yes);
         }

         $xtpl->assign('PREFS_NEWS_ADMIN_LABEL', $owl_lang->newsadmin);
         $xtpl->assign('PREFS_NEWS_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("newsadmin") == 1)
         {
            $xtpl->assign('PREFS_NEWS_ADMIN_VALUE', $owl_lang->status_yes);
         }

         $xtpl->assign('PREFS_GROUP_ADMIN_LABEL', $owl_lang->user_group_admin);
         $xtpl->assign('PREFS_GROUP_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("groupadmin") == 1)
         {
            $xtpl->assign('PREFS_GROUP_ADMIN_VALUE', $owl_lang->status_yes);
         }
         $xtpl->assign('PREFS_PHONE_LABEL', $owl_lang->owl_prefs_phone);
         $xtpl->assign('PREFS_PHONE_VALUE', $aOtherPrefs['user_phone']);
         $xtpl->assign('PREFS_DEPT_LABEL', $owl_lang->owl_prefs_department);
         $xtpl->assign('PREFS_DEPT_VALUE', $aOtherPrefs['user_department']);
         $xtpl->assign('PREFS_ADDRESS_LABEL', $owl_lang->owl_prefs_address);
         $xtpl->assign('PREFS_ADDRESS_VALUE', $aOtherPrefs['user_address']);
         $xtpl->assign('PREFS_NOTE_LABEL', $owl_lang->owl_prefs_note);
         $xtpl->assign('PREFS_NOTE_VALUE', $aOtherPrefs['user_note']);
         $xtpl->assign('PREFS_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
         $xtpl->assign('PREFS_EMAIL_SIG_VALUE', $sEmailSig);
      } 
      else
      {
         $xtpl->assign('PREFS_NOTIFY_LABEL', $owl_lang->notification);
         $xtpl->assign('PREFS_NOTIFY_VALUE', $owl_lang->status_no);
         if ($sql->f("notify") == 1)
         {
            $xtpl->assign('PREFS_NOTIFY_VALUE', $owl_lang->status_yes);
         }
         $xtpl->parse('main.EditPrefs.NotifyRO');

         $xtpl->assign('PREFS_ATTACH_LABEL', $owl_lang->attach_file);
         $xtpl->assign('PREFS_ATTACH_VALUE', $owl_lang->status_no);
         if ($sql->f("attachfile") == 1)
         {
            $xtpl->assign('PREFS_ATTACH_VALUE', $owl_lang->status_yes);
         }
         $xtpl->parse('main.EditPrefs.AttachFileRO');
         $xtpl->assign('PREFS_VIEW_LABEL', $owl_lang->owl_user_default_view  );
         $xtpl->assign('PREFS_VIEW_VALUE', $owl_lang->status_no);

         if ($sql->f("user_default_view") == 1)
         {
            $xtpl->assign('PREFS_VIEW_VALUE', $owl_lang->status_yes);
         }
         $xtpl->parse('main.EditPrefs.PrefsViewRO');

         if ($default->owl_version_control == 1)
         {
            $xtpl->assign('PREFS_MAJOR_REV_LABEL', $owl_lang->vermajor_initial);
            $xtpl->assign('PREFS_MAJOR_REV_VALUE', $sql->f("user_major_revision"));
            $xtpl->assign('PREFS_MINOR_REV_LABEL', $owl_lang->verminor_initial);
            $xtpl->assign('PREFS_MINOR_REV_VALUE', $sql->f("user_minor_revision")); 
            $xtpl->parse('main.EditPrefs.RevisionRO');
         }

         $xtpl->assign('PREFS_LOG_TO_NEWREC_LABEL', $owl_lang->user_login_to_newrecords);
         $xtpl->assign('PREFS_LOG_TO_NEWREC_VALUE', $owl_lang->status_no);
         if ($sql->f("logintonewrec") == 1)
         {
            $xtpl->assign('PREFS_LOG_TO_NEWREC_VALUE', $owl_lang->status_yes);
         }

         $xtpl->parse('main.EditPrefs.LoginToNewRecRO');

         $xtpl->assign('PREFS_COMMENT_NOTIFY_LABEL', $owl_lang->comment_notif);
         $xtpl->assign('PREFS_COMMENT_NOTIFY_VALUE', $owl_lang->status_no);
         if ($sql->f("comment_notify") == 1)
         {
            $xtpl->assign('PREFS_COMMENT_NOTIFY_VALUE', $owl_lang->status_yes);
         }
         $xtpl->parse('main.EditPrefs.CommentNotifyRO');
         
         $xtpl->assign('PREFS_USER_ADMIN_LABEL', $owl_lang->useradmin);
         $xtpl->assign('PREFS_USER_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("useradmin") == 1)
         {
            $xtpl->assign('PREFS_USER_ADMIN_VALUE', $owl_lang->status_yes);
         }

         $xtpl->assign('PREFS_NEWS_ADMIN_LABEL', $owl_lang->newsadmin);
         $xtpl->assign('PREFS_NEWS_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("newsadmin") == 1)
         {
            $xtpl->assign('PREFS_NEWS_ADMIN_VALUE', $owl_lang->status_yes);
         }
         
         $xtpl->assign('PREFS_GROUP_ADMIN_LABEL', $owl_lang->user_group_admin);
         $xtpl->assign('PREFS_GROUP_ADMIN_VALUE', $owl_lang->status_no);
         if ($sql->f("groupadmin") == 1)
         {
            $xtpl->assign('PREFS_GROUP_ADMIN_VALUE', $owl_lang->status_yes);
         }
         $xtpl->assign('PREFS_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
         $xtpl->assign('PREFS_EMAIL_SIG_VALUE', $sEmailSig);
      } 

      if ($showuser)
      {
         $xtpl->assign('FILE_BTN_UPD_PREF_ALT', $owl_lang->alt_change);
         $xtpl->assign('FILE_BTN_UPD_PREF', $owl_lang->change);
         $xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);         $xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
         $xtpl->parse('main.EditPrefs.ChangePrefs');
      }
   } 
} 

if ($action)
{
   if (isset($owluser)) 
   { 
      printuser($owluser);
   }
} 
else
{
   printError("$owl_lang->err_general");
} 

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main.EditPrefs');
$xtpl->parse('main');
$xtpl->out('main');

?>
