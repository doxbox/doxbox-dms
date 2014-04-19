<?php

/**
 * admin/index.php
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
 * $Id: index.php,v 1.35 2006/10/25 13:32:57 b0zz Exp $
 */
ob_start();
require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
$out = ob_get_clean();


require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");


$xtpl = new XTemplate("html/admin/index.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

if (isset($_COOKIE["AdminPanel"]))
{
   if (isset($_SERVER['HTTP_REFERER']) and !strpos($_SERVER['HTTP_REFERER'],'admin')) 
   { 
      setcookie ("AdminPanel", "", time() - 3600);
   }
}

if (empty($action))
{
   $action = "users";
}

if (isset($id) and !is_numeric($id))
{
   $id = '-1';
}

$bGrantAccess = false;

if (!fIsAdmin(true))
{
  $bGrantAccess = false;
}
else
{
  $bGrantAccess = true;
}

if ($bGrantAccess == false)
{
   if (fIsUserAdmin($userid) and ($action == "users" or $action == "groups" or $action == "newuser" or $action == "newgroup"))
   {
      $bGrantAccess = true;
   }
}

if ($bGrantAccess == false)
{
    header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
   //die("<br /><center>$owl_lang->err_unauthorized</center><br />");
}

if ($action == "backup") 
{
   dobackup();
}

if (!empty($group))
{  
   $i = 0;
   $aGroups = fGetGroups($userid);
   foreach($aGroups as $g)
   {
      if ($g[0] == $group)
      {
         continue;
      }
      $groups[$i][0] = $g[0];
      $groups[$i][1] = $g[1];
      $i++;
   }
}

if (fIsUserAdmin($userid) and $owluser== 1)
{
   printError($owl_lang->err_unauthorized);
}

if (isset($maint) and is_numeric($maint))
{
   if ($maint == 1 and $default->owl_maintenance_mode == 0)
   {
      $sql = new Owl_DB;
      $qUpdateQuery = "UPDATE  $default->owl_prefs_table SET owl_maintenance_mode =  '1'";
      $sql->query("$qUpdateQuery");
      $default->owl_maintenance_mode = 1;
   }
   else if ($maint == 0 and $default->owl_maintenance_mode == 1)
   {
      $sql = new Owl_DB;
      $qUpdateQuery = "UPDATE  $default->owl_prefs_table SET owl_maintenance_mode =  '0'";
      $sql->query("$qUpdateQuery");
      $default->owl_maintenance_mode = 0;
   }
}   
//sun2earth
$aUserList = fGetUserInfoInMyGroups($userid);
$aMainUserList = $aUserList;
$aAdminUserList = $aUserList;
//sun2earth END


include($default->owl_fs_root . "/lib/header.inc");
include($default->owl_fs_root . "/lib/userheader.inc");

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}

if ($action == "clnhist")
{
   $sql = new Owl_DB;
   $dTargetDate = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")-$default->purge_historical_documents_days,  date("Y")));
   $qPurgeQuery = "select id from $default->owl_files_table where smodified < '$dTargetDate'";
   $sql->query("$qPurgeQuery");
  
   $iPurgeFileCount = 0; 
   while ($sql->next_record())
   {
       delFile($sql->f("id"), "file_delete", 1); 
       $iPurgeFileCount++; 
   }
   $action = "JUNK";

   print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n");
   fPrintSectionHeader($iPurgeFileCount . " " . $owl_lang->historical_purge, "admin3");
   print("</tr></td></table>\n");
}

if (fIsAdmin(true))
{
   fPrintAdminPanelXTPL($action);
}

if (!isset($action)) 
{
   $action = "JUNK";
}

function printusers()
{
   global $sess, $default, $owl_lang, $owluser, $userid;
   global $xtpl;

   $sql = new Owl_DB;
   $sql_active_sess = new Owl_DB;

   $sql->query("select username,name,id,maxsessions FROM $default->owl_users_table order by name");

   $xtpl->assign('USER_ADMIN_TITLE', $owl_lang->header_user_admin);
   $xtpl->assign('USERS_LABEL', $owl_lang->users);

   while ($sql->next_record())
   {
      if (fIsUserAdmin($userid) and $sql->f("id") == 1)
      {
         continue;
      }
      $uid = $sql->f("id");
      $username = $sql->f("username");
      $name = $sql->f("name");
      $maxsess = $sql->f("maxsessions") + 1;
      $numrows = 0;

      $sql_active_sess->query("SELECT * FROM $default->owl_sessions_table WHERE usid='$uid'");
      $sql_active_sess->next_record();
      $numrows = $sql_active_sess->num_rows($sql_active_sess);

      if ($uid == $owluser)
      {
         $xtpl->assign('USER_VALUE', $uid);
         $xtpl->assign('USER_SELECTED', " selected=\"selected\"");
         $xtpl->assign('USER_LABEL', $name . "&nbsp;(". $username . ")&nbsp;&nbsp;&#8211;&nbsp;&nbsp;(" . $numrows . "/" . $maxsess . ")");
      }
      else
      {
         $xtpl->assign('USER_VALUE', $uid);
         $xtpl->assign('USER_SELECTED', '');
         $xtpl->assign('USER_LABEL', $name . "&nbsp;(". $username . ")&nbsp;&nbsp;&#8211;&nbsp;&nbsp;(" . $numrows . "/" . $maxsess . ")");
      }
      $xtpl->parse('main.Users.UserOptions');
   } 

   $xtpl->assign('BTN_DEL_USER_LABEL', $owl_lang->deleteuser);
   $xtpl->assign('BTN_DEL_USER_ALT', $owl_lang->alt_del_user);
   $xtpl->assign('BTN_DEL_USER_CONFIRM', $owl_lang->reallydeleteuser);

   $xtpl->assign('BTN_DEL_GROUP', $owl_lang->deletegroup);
   $xtpl->assign('BTN_DEL_GROUP_ALT', $owl_lang->alt_del_group);
   $xtpl->assign('BTN_DEL_GROUP_CONFIRM', $owl_lang->reallydeletegroup);

   $xtpl->assign('BTN_NEW_USER_LABEL', $owl_lang->btn_admin_users);
   $xtpl->assign('BTN_NEW_USER_TITLE', $owl_lang->alt_btn_admin_users);
   $xtpl->assign('BTN_NEW_USER_URL', "index.php?sess=$sess&amp;action=newuser");

   $xtpl->assign('BTN_EDIT_USER_LABEL', $owl_lang->btn_edit_user);
   $xtpl->assign('BTN_EDIT_USER_TITLE', $owl_lang->alt_edit_user);
   
   $xtpl->parse('main.Users');
} 

   function printgroups()
   {
      global $sess, $owl_lang, $default, $group, $userid;

      global $xtpl;

      $sql = new Owl_DB;
      $sql->query("SELECT name,id FROM $default->owl_groups_table order by name");

      $xtpl->assign('GROUP_ADMIN_TITLE', $owl_lang->header_group_admin);

      $xtpl->assign('GROUPS_LABEL', $owl_lang->groups);

      while ($sql->next_record())
      {
         if (fIsUserAdmin($userid) and $sql->f("id") == 0)
         {
            continue;
         }

         $xtpl->assign('GROUP_VALUE', $sql->f("id"));
         $xtpl->assign('GROUP_LABEL', $sql->f("name")); 

         if ($group == $sql->f("id"))
         {
            $xtpl->assign('GROUP_SELECTED', ' selected="selected"');
         } 
         else
         {
            $xtpl->assign('GROUP_SELECTED', '');
         } 
         $xtpl->parse('main.Groups.GroupOptions');
      } 

      $xtpl->assign('BTN_NEW_GROUP_LABEL', $owl_lang->btn_admin_groups);
      $xtpl->assign('BTN_NEW_GROUP_TITLE', $owl_lang->alt_btn_admin_groups);
      $xtpl->assign('BTN_NEW_GROUP_URL', "index.php?sess=$sess&amp;action=newgroup");

      $xtpl->assign('BTN_EDIT_GROUP_LABEL', $owl_lang->btn_edit_group);
      $xtpl->assign('BTN_EDIT_GROUP_TITLE', $owl_lang->alt_edit_group);

      $xtpl->parse('main.Groups');
   } 

   function printuser($id)
   {
      global $sess, $change, $default, $flush, $userid;
      global $xtpl, $urlArgs;
      global $owl_lang;

      if ($change == 1) 
      {
         $xtpl->assign('STATUS_MSG', $owl_lang->saved);
         $xtpl->parse('main.User.StatusMsg');
      }

      if ($flush == 1)
      {
         flushsessions($id, $sess);
         $xtpl->assign('STATUS_MSG', $owl_lang->flushed);
         $xtpl->parse('main.User.StatusMsg');
      } 

      $groups = fGetGroups($userid);

      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$id'");
      while ($sql->next_record())
      {
         $urlArgs['id']      = $sql->f("id");;
         $urlArgs['sess']      = $sess;
         $urlArgs['oldlanguage']      = $sql->f("language");;
         $urlArgs['action']      = 'user';

         $xtpl->assign('USER_FULL_NAME_LABEL', $owl_lang->full_name);
         $xtpl->assign('USER_FULL_NAME_VALUE', $sql->f("name"));
         $xtpl->assign('USER_USERNAME_LABEL', $owl_lang->username);
         $xtpl->assign('USER_USERNAME_VALUE', $sql->f("username"));

         if ( $sql->f("id") > 1)
         {
            $xtpl->assign('USER_GROUP_LABEL', $owl_lang->group);
            foreach($groups as $g) 
            {
               $xtpl->assign('USER_GROUP_VALUE', $g[0]);
               $xtpl->assign('USER_GROUP_CAPTION', $g[1]);
               $xtpl->assign('USER_GROUP_SELECTED', '');
               if ($g[0] == $sql->f("groupid"))
               {
                  $xtpl->assign('USER_GROUP_SELECTED', " selected=\"selected\"");
               }
               $xtpl->parse('main.User.Groups.Items');
            }
            $xtpl->parse('main.User.Groups');

         }
         else
         {
            $urlArgs['groupid']      = $sql->f("groupid");
         }
         // 
         // Display the Language dropdown
         // 

         $xtpl->assign('USER_LANG_LABEL', $owl_lang->userlang);
         $aLanguages = fGetLocales();
         foreach ($aLanguages as $file)
         {
            $xtpl->assign('USER_LANG_VALUE', $file);
            $xtpl->assign('USER_LANG_CAPTION', $file);
            $xtpl->assign('USER_LANG_SELECTED', '');
            if ($file == $sql->f("language"))
            {
               $xtpl->assign('USER_LANG_SELECTED', " selected=\"selected\"");
            }
            $xtpl->parse('main.User.Locales');
         }

         // 
         // Display the Button Styles dropdown
         // 

         $xtpl->assign('USER_BTN_STYLE_LABEL', $owl_lang->buttonstyle);
         if (file_exists($default->owl_fs_root . "/templates"))
	 {
            if (is_readable($default->owl_fs_root . "/templates"))
	    {
               $dir = dir($default->owl_fs_root . "/templates");
               $dir->rewind();
               while ($file = $dir->read())
               {
                  if (is_dir($default->owl_fs_root . "/templates/" . $file))
                  {
                     if ($file[0] != "." and $file != "CVS" and $file != "favicon.ico" and $file[0] != "_")
                     {
                        $xtpl->assign('USER_BTN_STYLE_VALUE', $file);
                        $xtpl->assign('USER_BTN_STYLE_CAPTION', $file);
                        $xtpl->assign('USER_BTN_STYLE_SELECTED', '');
                        if ($file == $sql->f("buttonstyle"))
                        {
                           $xtpl->assign('USER_BTN_STYLE_SELECTED', " selected=\"selected\"");
                        }
                        $xtpl->parse('main.User.BtnStyle');
                     }
                  }
               } 
               $dir->close();
	    }
	    else
	    {
		       print("TEMPLATE DIRETORY is not readable");
   	    }
         }
	 else
	 {
	    print("TEMPLATE DIRETORY is missing");
	 }

         // Bozz Change  begin
         // This is to allow a user to be part of more than one group
         $xtpl->assign('USER_MEMB_GROUP_LABEL', $owl_lang->groupmember);
         $xtpl->assign('USER_MEMB_MEMB_TITLE', $owl_lang->member_membership);
         $xtpl->assign('USER_MEMB_FILEADMIN_TITLE', $owl_lang->member_fileadmin);
         $xtpl->assign('USER_MEMB_GROUP_TITLE', $owl_lang->member_group);

         $i = 0;
         $sqlmemgroup = new Owl_DB;
         if(fIsUserAdmin($userid))
         {
            $sqlmemgroup->query("SELECT userid FROM $default->owl_users_grpmem_table WHERE userid='$id' and groupid='0'");
            $sqlmemgroup->next_record(); 
            if ($sqlmemgroup->num_rows($sqlmemgroup) > 0)
            {
               $urlArgs['group'.$i]      = $i;
               $i++;
            }
         }

         foreach($groups as $g)
         {
            $is_set_gid = $g[0];
            $xtpl->assign('USER_MEMB_GROUP_NAME', 'group' . $i);
            $xtpl->assign('USER_MEMB_GROUP_VALUE', $g[0]);
            $xtpl->assign('USER_MEMB_GROUP_CHECKED', '');
            $xtpl->assign('USER_MEMB_ADMINGROUP_NAME', 'mgroupadmin' . $i);
            $xtpl->assign('USER_MEMB_ADMINGROUP_VALUE', $g[0]);
            $xtpl->assign('USER_MEMB_ADMINGROUP_CHECKED', '');
            $xtpl->assign('USER_MEMB_GROUP_CAPTION', $g[1]);

            $sqlmemgroup->query("SELECT userid FROM $default->owl_users_grpmem_table WHERE userid='$id' and groupid='$is_set_gid'");
            $sqlmemgroup->next_record(); 
            if ($sqlmemgroup->num_rows($sqlmemgroup) > 0)
            {
               $xtpl->assign('USER_MEMB_GROUP_CHECKED',  " checked=\"checked\"");
            }

            $sqlmemgroup->query("SELECT userid FROM $default->owl_users_grpmem_table WHERE userid='$id' and groupadmin='$is_set_gid'");
            $sqlmemgroup->next_record(); 
            if ($sqlmemgroup->num_rows($sqlmemgroup) > 0)
            {
               $xtpl->assign('USER_MEMB_ADMINGROUP_CHECKED',  " checked=\"checked\"");
            }

            $i++;
            $xtpl->parse('main.User.GroupMember');
         }

         // This hidden field is to store the nubmer of displayed groups for future use
         // when the records are saved to the db
         $urlArgs['no_groups_displayed']      = $i;
         // Bozz Change End

         // Display the Directories so a Home Directory may be chosen.

         $xtpl->assign('USER_HOMEDIR_LABEL', $owl_lang->home_dir);
         $xtpl->assign('USER_HOMEDIR_VALUE', '1');
         $xtpl->assign('USER_HOMEDIR_CAPTION', fid_to_name("1"));
         $xtpl->assign('USER_HOMEDIR_SELECTED', " selected=\"selected\"");
         $xtpl->parse('main.User.HomeDir');
         fPrintHomeDirXtpl("1", "--|", $sql->f("homedir"), '---','main.User.HomeDir', 'HOMEDIR');


         $xtpl->assign('USER_FIRSTDIR_LABEL', $owl_lang->initial_dir);
         $xtpl->assign('USER_FIRSTDIR_VALUE', '1');
         $xtpl->assign('USER_FIRSTDIR_CAPTION', fid_to_name("1"));
         $xtpl->assign('USER_FIRSTDIR_SELECTED', " selected=\"selected\"");
         $xtpl->parse('main.User.FirstDir');
         fPrintHomeDirXtpl("1", "--|", $sql->f("firstdir"), '---','main.User.FirstDir', 'FIRSTDIR');

         $xtpl->assign('USER_QUOTA_LABEL', $owl_lang->quota .  ": &nbsp; &nbsp; " . gen_filesize($sql->f("quota_current")) . " / " . gen_filesize($sql->f("quota_max")));
         $xtpl->assign('USER_QUOTA_VALUE', $sql->f("quota_max"));

         $sql_active_sess = new Owl_DB;
         $sql_active_sess->query("SELECT * FROM $default->owl_sessions_table WHERE usid='$id'");
         $sql_active_sess->next_record();
         $numrows = $sql_active_sess->num_rows($sql_active_sess);

         $xtpl->assign('USER_MAXSESS_LABEL', $owl_lang->maxsessions . ": &nbsp; &nbsp; &nbsp;" . $numrows . " /");
         $xtpl->assign('USER_MAXSESS_VALUE', $sql->f("maxsessions") + 1);

         $xtpl->assign('FLUSH_URL', "index.php?sess=$sess&amp;action=user&amp;owluser=$id&amp;change=0&amp;flush=1");
         $xtpl->assign('FLUSH_ALT', $owl_lang->alt_admin_flush);

         $xtpl->parse('main.User.FlushActiveSessions');
         if ($default->auth == 0)
         {
            $xtpl->assign('USER_EDIT_PASSWD_LABEL', $owl_lang->password);
            $xtpl->assign('USER_EDIT_PASSWD_VALUE', $sql->f("password"));
            $xtpl->assign('USER_CONF_PASSWD_LABEL', $owl_lang->confpassword);
            $xtpl->assign('USER_CONF_PASSWD_VALUE', '');
            $xtpl->parse('main.User.DefaultAuth');
         }
         $xtpl->assign('USER_EMAIL_LABEL', $owl_lang->email);
         $xtpl->assign('USER_EMAIL_VALUE', $sql->f("email")); 

         $xtpl->assign('USER_NOTIFY_LABEL', $owl_lang->notification);
         $xtpl->assign('USER_NOTIFY_SELECTED', '');
         if ($sql->f("notify") == 1)
         {
            $xtpl->assign('USER_NOTIFY_SELECTED', " checked=\"checked\"");
         }

         $xtpl->assign('USER_ATTACH_LABEL', $owl_lang->attach_file);
         $xtpl->assign('USER_ATTACH_SELECTED', '');
         if ($sql->f("attachfile") == 1)
         {
            $xtpl->assign('USER_ATTACH_SELECTED', " checked=\"checked\"");
         }

         $xtpl->assign('USER_MAJ_REVISION_LABEL', $owl_lang->owl_user_major_revision);
         $xtpl->assign('USER_MAJ_REVISION_VALUE', $sql->f("user_major_revision"));

         $xtpl->assign('USER_MIN_REVISION_LABEL', $owl_lang->owl_user_minor_revision);
         $xtpl->assign('USER_MIN_REVISION_VALUE', $sql->f("user_minor_revision"));

            $aRevisionType[0][0] = "0";
            $aRevisionType[0][1] = $owl_lang->none_selected;
            $aRevisionType[1][0] = "1";
            $aRevisionType[1][1] = $owl_lang->vermajor;
            $aRevisionType[2][0] = "2";
            $aRevisionType[2][1] = $owl_lang->verminor;

            $xtpl->assign('USER_DEF_REVISION_LABEL', $owl_lang->owl_user_default_revision);
            foreach($aRevisionType as $g)
            {
               $xtpl->assign('USER_DEF_REVISION_VALUE', $g[0]);
               $xtpl->assign('USER_DEF_REVISION_CAPTION', $g[1]);
               $xtpl->assign('USER_DEF_REVISION_SELECTED', '');
               if ($g[0] == $sql->f("user_default_revision"))
               {
                  $xtpl->assign('USER_DEF_REVISION_SELECTED', ' selected="selected"');
               }
               $xtpl->parse('main.User.Revisions');
            }


         $xtpl->assign('USER_DEF_VIEW_LABEL', $owl_lang->owl_user_default_view);
         $xtpl->assign('USER_DEF_VIEW_SELECTED', '');
         if ($sql->f("user_default_view") == 1)
         {
            $xtpl->assign('USER_DEF_VIEW_SELECTED', ' checked="checked"');
         }
         $xtpl->assign('USER_PREF_ACCESS_LABEL', $owl_lang->noprefaccess);
         $xtpl->assign('USER_PREF_ACCESS_SELECTED', '');
         if ($sql->f("noprefaccess") == 1)
         {
            $xtpl->assign('USER_PREF_ACCESS_SELECTED', ' checked="checked"');
         }


         $aUserAccess[0] = $owl_lang->user_access_webdav_label;
         $aUserAccess[1] = $owl_lang->user_access_interface_label;
         $aUserAccess[2] = $owl_lang->user_access_both_label;

         $xtpl->assign('USER_DL_COUNT_EXCLUDED_LABEL', $owl_lang->user_dl_count_excluded_label);
         $xtpl->assign('USER_DL_COUNT_EXCLUDED_EXTENDED', $owl_lang->user_dl_count_excluded_extended);
         $xtpl->assign('USER_DL_COUNT_EXCLUDED_CHECKED', '');
         if ($sql->f('dl_count_excluded') == 1)
         {
            $xtpl->assign('USER_DL_COUNT_EXCLUDED_CHECKED', ' checked="checked"');
         }

         $xtpl->assign('USER_ACCESS_LABEL', $owl_lang->user_access_label);
         $xtpl->assign('USER_ACCESS_HELP_TEXT',  sprintf($default->domtt_popup , $owl_lang->user_access_label, addslashes($owl_lang->user_access_extended), $default->popup_lifetime));
         $i = 0;
         foreach($aUserAccess as $g)
         {
            $xtpl->assign('USER_ACCESS_VALUE', $i);
            $xtpl->assign('USER_ACCESS_CAPTION', $g);
            $xtpl->assign('USER_ACCESS_SELECTED', '');
            if ($i == $sql->f("user_access"))
            {
               $xtpl->assign('USER_ACCESS_SELECTED', " checked=\"checked\"");
            }
            $i++;
            $xtpl->parse('main.User.UserAccess');
         }

         if ($id != 1)
         {
            $urlArgs['old_disabled']      = $sql->f("disabled");
            $xtpl->assign('USER_DISABLE_LABEL', $owl_lang->disableuser);
            $xtpl->assign('USER_DISABLE_SELECTED', '');
            if ($sql->f("disabled") == 1)
            {
               $xtpl->assign('USER_DISABLE_SELECTED', ' checked="checked"');
            }
            $xtpl->parse('main.User.RegularUserOnly.Disabled');


            $aRevisionType[0][0] = "0";
            $aRevisionType[0][1] = $owl_lang->none_selected;
            $aRevisionType[1][0] = "1";
            $aRevisionType[1][1] = $owl_lang->vermajor;
            $aRevisionType[2][0] = "2";
            $aRevisionType[2][1] = $owl_lang->verminor;

            $xtpl->assign('USER_DEF_REVISION_LABEL', $owl_lang->owl_user_default_revision);
            foreach($aRevisionType as $g)
            {
               $xtpl->assign('USER_DEF_REVISION_VALUE', $g[0]);
               $xtpl->assign('USER_DEF_REVISION_CAPTION', $g[1]);
               $xtpl->assign('USER_DEF_REVISION_SELECTED', '');
               if ($g[0] == $sql->f("user_default_revision"))
               {
                  $xtpl->assign('USER_DEF_REVISION_SELECTED', ' selected="selected"');
               }
               $xtpl->parse('main.User.RegularUserOnly.Revisions');
            }

            $xtpl->assign('USER_MAJ_REVISION_LABEL', $owl_lang->owl_user_major_revision);
            $xtpl->assign('USER_MAJ_REVISION_VALUE', $sql->f("user_major_revision"));
      
            $xtpl->assign('USER_MIN_REVISION_LABEL', $owl_lang->owl_user_minor_revision);
            $xtpl->assign('USER_MIN_REVISION_VALUE', $sql->f("user_minor_revision"));

            $xtpl->assign('USER_PDF_WATERMARK_LABEL', $owl_lang->owl_user_pdfwatermark);
            $xtpl->assign('USER_PDF_WATERMARK_SELECTED', '');
            if ($sql->f("pdf_watermarks") == 1)
            {
               $xtpl->assign('USER_PDF_WATERMARK_SELECTED', ' checked="checked"');
            }


            if (fIsUserAdmin($userid))
            {
               $urlArgs['useradmin'] = $sql->f("useradmin");
            }
            else
            {
               $xtpl->assign('USER_USER_ADMIN_LABEL', $owl_lang->user_admin);
               $xtpl->assign('USER_USER_ADMIN_SELECTED', '');
               if ($sql->f("useradmin") == 1)
               {
                  $xtpl->assign('USER_USER_ADMIN_SELECTED', ' checked="checked"');
               }
               $xtpl->parse('main.User.UserAdmin');
            }
            $xtpl->assign('USER_VIEW_LOG_LABEL', $owl_lang->viewlogs);
            $xtpl->assign('USER_VIEW_LOG_SELECTED', '');
            if ($sql->f("viewlogs") == 1)
            {
               $xtpl->assign('USER_VIEW_LOG_SELECTED', ' checked="checked"');
            }

            $xtpl->assign('USER_VIEW_REPORTS_LABEL', $owl_lang->viewreports);
            $xtpl->assign('USER_VIEW_REPORTS_SELECTED', '');
            if ($sql->f("viewreports") == 1)
            {
               $xtpl->assign('USER_VIEW_REPORTS_SELECTED', ' checked="checked"');
            }

            $xtpl->assign('USER_NEWS_ADMIN_LABEL', $owl_lang->newsadmin);
            $xtpl->assign('USER_NEWS_ADMIN_SELECTED', '');
            if ($sql->f("newsadmin") == 1)
            {
               $xtpl->assign('USER_NEWS_ADMIN_SELECTED', ' checked="checked"');
            }

            $xtpl->assign('USER_GROUP_ADMIN_LABEL', $owl_lang->user_group_admin);
            $xtpl->assign('USER_GROUP_ADMIN_SELECTED', '');
            if ($sql->f("groupadmin") == 1)
            {
               $xtpl->assign('USER_GROUP_ADMIN_SELECTED', ' checked="checked"');
            }
            $xtpl->parse('main.User.RegularUserOnly');
         } 

         $xtpl->assign('USER_NEW_REC_PAGE_LABEL', $owl_lang->user_login_to_newrecords);
         $xtpl->assign('USER_NEW_REC_PAGE_SELECTED', '');
         if ($sql->f("logintonewrec") == 1)
         {
            $xtpl->assign('USER_NEW_REC_PAGE_SELECTED', ' checked="checked"');
         }

         $xtpl->assign('USER_COMMENT_NOTIFY_LABEL', $owl_lang->comment_notif);
         $xtpl->assign('USER_COMMENT_NOTIFY_SELECTED', '');
         if ($sql->f("comment_notify") == 1)
         {
            $xtpl->assign('USER_COMMENT_NOTIFY_SELECTED', ' checked="checked"');
         }

         $xtpl->assign('USER_EMAIL_TOOL_LABEL', $owl_lang->email_tool);
         $xtpl->assign('USER_EMAIL_TOOL_SELECTED', '');
         if ($sql->f("email_tool") == 1)
         {
            $xtpl->assign('USER_EMAIL_TOOL_SELECTED', ' checked="checked"');
         }

         $xtpl->assign('USER_CHANGE_PASSWD_LABEL', $owl_lang->user_change_pass_next_login);
         $xtpl->assign('USER_CHANGE_PASSWD_SELECTED', '');
         if ($sql->f("change_paswd_at_login") == 1)
         {
            $xtpl->assign('USER_CHANGE_PASSWD_SELECTED', ' checked="checked"');
         }

         $xtpl->assign('USER_EXPIRES_LABEL', $owl_lang->user_expires);
         $xtpl->assign('USER_EXPIRES_VALUE', $sql->f("expire_account"));

         $xtpl->assign('USER_AUTH_TYPE_LABEL', $owl_lang->user_auth_type);
         foreach($default->auth_type as $g)
         {
            $xtpl->assign('USER_AUTH_TYPE_VALUE', $g[0]);
            $xtpl->assign('USER_AUTH_TYPE_CAPTION', $g[1]);
            $xtpl->assign('USER_AUTH_TYPE_SELECTED', '');
            if ($g[0] == trim($sql->f("user_auth")))
            {
               $xtpl->assign('USER_AUTH_TYPE_SELECTED', " selected=\"selected\"");
            }
            $xtpl->parse('main.User.AuthType');
         }

         $xtpl->assign('USER_GMT_OFFSET_LABEL', $owl_lang->user_gmt_offset);
         foreach($owl_lang->time_offsets as $g)
         {
            $xtpl->assign('USER_GMT_OFFSET_VALUE', $g[0]);
            $xtpl->assign('USER_GMT_OFFSET_CAPTION', $g[1]);
            $xtpl->assign('USER_GMT_OFFSET_SELECTED', '');
            if ($g[0] == trim($sql->f("user_offset")))
            {
               $xtpl->assign('USER_GMT_OFFSET_SELECTED', " selected=\"selected\"");
            }
            $xtpl->parse('main.User.GmtOffset');
         }

         $aOtherPrefs = fGetUserOtherPrefs($id);

         $xtpl->assign('PREFS_PHONE_LABEL', $owl_lang->owl_prefs_phone);
         $xtpl->assign('PREFS_PHONE_VALUE', $aOtherPrefs['user_phone']);
         $xtpl->assign('PREFS_DEPT_LABEL', $owl_lang->owl_prefs_department);
         $xtpl->assign('PREFS_DEPT_VALUE', $aOtherPrefs['user_department']);
         $xtpl->assign('PREFS_ADDRESS_LABEL', $owl_lang->owl_prefs_address);
         $xtpl->assign('PREFS_ADDRESS_VALUE', $aOtherPrefs['user_address']);
         $xtpl->assign('PREFS_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
         $xtpl->assign('PREFS_EMAIL_SIG_VALUE', $aOtherPrefs['email_sig']);



      $xtpl->assign('BTN_CHANGE', $owl_lang->change);
      $xtpl->assign('BTN_CHANGE_ALT', $owl_lang->alt_change);


         $qItemCount = new Owl_DB;
         $qItemCount->query("SELECT count(*) as num_files FROM $default->owl_files_table WHERE creatorid='$id'");
         $qItemCount->next_record();
         $iNumFiles = $qItemCount->f("num_files");
         $qItemCount->query("SELECT count(*) as num_folders FROM $default->owl_folders_table WHERE creatorid='$id'");
         $qItemCount->next_record();
         $iNumFolders = $qItemCount->f("num_folders");

         $xtpl->assign('BTN_DEL_USER_LABEL', $owl_lang->deleteuser);
         $xtpl->assign('BTN_DEL_USER_ALT', $owl_lang->alt_del_user);
         if ($sql->f("id") != 1 && $sql->f("id") != $default->anon_user)
         {
            if ( $iNumFolders > 0 or $iNumFiles > 0 )
            {
               $sDeleteMessage = ereg_replace('%numfiles%', $iNumFiles ,ereg_replace('%numfolders%', $iNumFolders, $owl_lang->reallydeluser));
               $xtpl->assign('BTN_DEL_USER_CONFIRM', $sDeleteMessage);
            }
            else
            {
               $xtpl->assign('BTN_DEL_USER_CONFIRM', $owl_lang->reallydeleteuser);
            }
            $xtpl->parse('main.User.DeleteUser');
         } 
      $xtpl->assign('BTN_RESET_LABEL', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);
      } 
      $xtpl->parse('main.User.ChangeUser');
      $xtpl->parse('main.User');
   } 

   function flushsessions($id, $sess)
   {
      global $default;
      $sql = new Owl_DB;
      $sql->query("delete FROM $default->owl_sessions_table WHERE usid='$id' AND sessid!='$sess'");
   } 

   function printgroup($id)
   {
      global $sess, $change, $default;
      global $owl_lang, $groups; //, $fselectedgroups;
      //sun2earth
      global $aUserList, $aMainUserList, $aAdminUserList;
      global $fselectedusers, $xtpl, $urlArgs;
      //sun2earth end

      if (isset($change)) 
      {
         //fPrintSectionHeader($owl_lang->saved, "admin3");
         $xtpl->assign('HEADING_SAVED', $owl_lang->saved);
         $xtpl->parse('main.EditGroup.Saved');
      }
      $sql = new Owl_DB;
      $sql->query("SELECT id,name FROM $default->owl_groups_table WHERE id = '$id'");
      while ($sql->next_record())
      {
         $xtpl->assign('GROUP_TITLE', $owl_lang->title);
         $xtpl->assign('GROUP_VALUE', $sql->f('name'));
         //fPrintFormTextLine($owl_lang->title . ":" , "name", 40, $sql->f("name"));
         $urlArgs['id']          = $sql->f("id");;
         $urlArgs['sess']        = $sess;
         $urlArgs['action']      = 'group';
         $urlArgs['subaction']      = 'group';

         $xtpl->assign('BTN_CHANGE', $owl_lang->change);
         $xtpl->assign('BTN_CHANGE_ALT', $owl_lang->alt_change);

         $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
         $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

         if ($sql->f("id") != 0 && $sql->f("id") != 1)
         {
            $xtpl->assign('BTN_DEL_GROUP', $owl_lang->deletegroup);
            $xtpl->assign('BTN_DEL_GROUP_ALT', $owl_lang->alt_del_group);
            $xtpl->parse('main.EditGroup.DelGroup');
         } 
      } 

   $sql->query("SELECT userid FROM $default->owl_users_grpmem_table WHERE groupid = '$id'");
   $sWhereClause = " WHERE ";
   while ($sql->next_record())
   {
      $sWhereClause .=  " id <> '" . $sql->f("userid") . "' AND ";
   }
   if ($sWhereClause <> " WHERE ")
   {
   
      $sWhereClause .=  " 1 = 1";
   }
   else
   {
      $sWhereClause = "";
   }

   $sql->query("SELECT username,name,id FROM $default->owl_users_table $sWhereClause order by name");

// Loads the users, mainusers and adminusers from the DB

      $qSetUsers = "SELECT DISTINCT id,username,name,email from $default->owl_users_table,$default->owl_users_grpmem_table WHERE $default->owl_users_grpmem_table.userid=$default->owl_users_table.id AND $default->owl_users_grpmem_table.groupid='$id'"; $sql = new Owl_DB;
      $sql->query($qSetUsers);
      while ($sql->next_record())
      {
         $fselectedusers[] = $sql->f("id");
      }

      $qSetUsers = "SELECT id,username,name,email FROM $default->owl_users_table WHERE groupid='$id' ORDER BY username,name";
      $sql = new Owl_DB;
      $sql->query($qSetUsers);
      while ($sql->next_record())
      {
         $fselectedmainusers[] = $sql->f("id");
      }

      $qSetUsers = "SELECT distinct id,username,name,email,u.groupid FROM $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id=m.userid WHERE (u.groupadmin='1' and u.groupid='$id')  OR m.groupadmin = '$id' order by u.id";
      $sql = new Owl_DB;
      $sql->query($qSetUsers);
      while ($sql->next_record())
      {
         $fselectedadminusers[] = $sql->f("id");
      }


// Section for members of a group

      $xtpl->assign('HEADING_MEMBER_GROUP', $owl_lang->owl_group_user . " (".count($fselectedusers)."/".count($aUserList) . ")");
      $xtpl->assign('TITLE_AVAILABLE', $owl_lang->acl_available_users);
      $xtpl->assign('TITLE_SELECTED', $owl_lang->acl_selected_users);

      if (!empty($aUserList))
      {
         foreach ($aUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            $xtpl->assign('MEMB_USER_AVAIL_VALUE', $sId);
            if (!empty($fselectedusers))
            {
               if (!(in_array($sId, $fselectedusers)))
               {
                  $xtpl->assign('MEMB_USER_AVAIL_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.MembUsersAvail');
               }
            }
            else
            {
               $xtpl->assign('MEMB_USER_AVAIL_CAPTION', $sName . $sEmail);
               $xtpl->parse('main.EditGroup.MembUsersAvail');
            }
         }
      }

      if (!empty($aUserList))
      {
         foreach ($aUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            $xtpl->assign('MEMB_USER_SELECTED_VALUE', $sId);
            if (!empty($fselectedusers))
            {
               if ((in_array($sId, $fselectedusers)))
               {
                  $xtpl->assign('MEMB_USER_SELECTED_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.MembUsersSelected');
               }
            }
         }
      }

      $xtpl->assign('BTN_SET_SELECTED', $owl_lang->group_set_selected);
      $xtpl->assign('BTN_SET_SELECTED_ALT', $owl_lang->alt_group_set_selected);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      $iCountSelectedMainUsers = 0;
      if (isset($fselectedmainusers))
      {
         $iCountSelectedMainUsers = count($fselectedmainusers);
      }
      $iCountSMainUserList = 0;
      if (isset($aMainUserList))
      {
         $iCountMainUserList = count($aMainUserList);
      }
     
      $xtpl->assign('HEADING_PRIMARY_GROUP', $owl_lang->users_in_primary_group . " (".$iCountSelectedMainUsers ."/".count($aMainUserList). ")");

      if (!empty($aMainUserList))
      {
         foreach ($aMainUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            $xtpl->assign('PRIM_USER_AVAIL_VALUE', $sId);
            if (!empty($fselectedmainusers))
            {
               if (!(in_array($sId, $fselectedmainusers)))
               {
                  $xtpl->assign('PRIM_USER_AVAIL_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.PrimUserAvail');
               }
            }
            else
            {
               $xtpl->assign('PRIM_USER_AVAIL_CAPTION', $sName . $sEmail);
               $xtpl->parse('main.EditGroup.PrimUserAvail');
            }
         }
      }

      if (!empty($aMainUserList))
      {
         foreach ($aMainUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            $xtpl->assign('PRIM_USER_SELECTED_VALUE', $sId);
            if (!empty($fselectedmainusers))
            {
               if ((in_array($sId, $fselectedmainusers)))
               {
                  $xtpl->assign('PRIM_USER_SELECTED_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.PrimUserSelected');
               }
            }
         }
      }

      $xtpl->assign('BTN_SET_SELECTED', $owl_lang->group_set_selected);
      $xtpl->assign('BTN_SET_SELECTED_ALT', $owl_lang->alt_group_set_selected);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

// Section for adminuser of a group
      $iCountSelectedAdminUsers = 0;
      if (isset($fselectedadminusers))
      {
         $iCountSelectedAdminUsers = count($fselectedadminusers);
      }

      $iCountSAdminUserList = 0;
      if (isset($aAdminUserList))
      {
         $iCountAdminUserList = count($aAdminUserList);
      }

      $xtpl->assign('HEADING_GROUP_ADMIN', $owl_lang->users_group_admin . " (".$iCountSelectedAdminUsers ."/".$iCountAdminUserList. ")");

      if (!empty($aAdminUserList))
      {
         foreach ($aAdminUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }

            $xtpl->assign('GROUPADM_USER_AVAIL_VALUE', $sId);
            if (!empty($fselectedadminusers))
            {
               if (!(in_array($sId, $fselectedadminusers)))
               {
                  $xtpl->assign('GROUPADM_USER_AVAIL_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.GroupAdmUserAvail');
               }
            }
            else
            {
               $xtpl->assign('GROUPADM_USER_AVAIL_CAPTION', $sName . $sEmail);
               $xtpl->parse('main.EditGroup.GroupAdmUserAvail');
            }
         }
      }

      if (!empty($aAdminUserList))
      {
         foreach ($aAdminUserList as $aUsers)
         {
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            $xtpl->assign('GROUPADM_USER_SELECTED_VALUE', $sId);
            if (!empty($fselectedadminusers))
            {
               if ((in_array($sId, $fselectedadminusers)))
               {
                  $xtpl->assign('GROUPADM_USER_SELECTED_CAPTION', $sName . $sEmail);
                  $xtpl->parse('main.EditGroup.GroupAdmUserSelected');
               }
            }
         }
      }
      $xtpl->assign('BTN_SET_SELECTED', $owl_lang->group_set_selected);
      $xtpl->assign('BTN_SET_SELECTED_ALT', $owl_lang->alt_group_set_selected);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      $xtpl->parse('main.EditGroup');
   } 

   function printnewgroup()
   {
      global $default, $sess, $owl_lang;
      global $xtpl;
      $xtpl->assign('NEW_GROUP_TITLE', $owl_lang->title);
      $xtpl->assign('NEW_GROUP_ADD_BTN', $owl_lang->add);
      $xtpl->assign('NEW_GROUP_ADD_BTN_ALT', $owl_lang->alt_add_group);
      $xtpl->assign('NEW_GROUP_RESET_BTN', $owl_lang->btn_reset);
      $xtpl->assign('NEW_GROUP_RESET_BTN_ALT', $owl_lang->alt_reset_form);
      $xtpl->parse('main.NewGroup');
   } 

   function printnewuser()
   {
      global $sess, $owl_lang, $default, $userid;
      global $xtpl, $urlArgs;

      $groups = fGetGroups($userid);

      $xtpl->assign('USER_FULL_NAME_LABEL', $owl_lang->full_name);
      $xtpl->assign('USER_USERNAME_LABEL', $owl_lang->username);

      $xtpl->assign('USER_GROUP_LABEL', $owl_lang->group);
      foreach($groups as $g)
      {
         $xtpl->assign('USER_GROUP_VALUE', $g[0]);
         $xtpl->assign('USER_GROUP_CAPTION', $g[1]);
         $xtpl->parse('main.User.Groups.Items');
      }
      $xtpl->parse('main.User.Groups');

      $xtpl->assign('USER_LANG_LABEL', $owl_lang->userlang);

         $aLanguages = fGetLocales();
         foreach ($aLanguages as $file)
         {
            $xtpl->assign('USER_LANG_VALUE', $file);
            $xtpl->assign('USER_LANG_CAPTION', $file);
            $xtpl->assign('USER_LANG_SELECTED', '');

            if ($file == $default->owl_lang)
            {
               $xtpl->assign('USER_LANG_SELECTED', " selected=\"selected\"");
            }
            $xtpl->parse('main.User.Locales');
         }

         $xtpl->assign('USER_MEMB_GROUP_LABEL', $owl_lang->groupmember);
         $xtpl->assign('USER_MEMB_MEMB_TITLE', $owl_lang->member_membership);
         $xtpl->assign('USER_MEMB_FILEADMIN_TITLE', $owl_lang->member_fileadmin);
         $xtpl->assign('USER_MEMB_GROUP_TITLE', $owl_lang->member_group);

      $i = 0;
      foreach($groups as $g)
      {
         $xtpl->assign('USER_MEMB_GROUP_NAME', 'group' . $i);
         $xtpl->assign('USER_MEMB_GROUP_VALUE', $g[0]);
         $xtpl->assign('USER_MEMB_ADMINGROUP_NAME', 'mgroupadmin' . $i);
         $xtpl->assign('USER_MEMB_ADMINGROUP_VALUE', $g[0]);
         $xtpl->assign('USER_MEMB_GROUP_CAPTION', $g[1]);
         $i++;
         $xtpl->parse('main.User.GroupMember');
      }
      // This hidden field is to store the nubmer of displayed groups for future use
      // when the records are saved to the db
      $urlArgs['no_groups_displayed']      = $i;
      // Bozz Change End

      // Display the Directories so a Home Directory may be chosen.

      $xtpl->assign('USER_HOMEDIR_LABEL', $owl_lang->home_dir);
      $xtpl->assign('USER_HOMEDIR_VALUE', '1');
      $xtpl->assign('USER_HOMEDIR_CAPTION', fid_to_name("1"));
      $xtpl->assign('USER_HOMEDIR_SELECTED', " selected=\"selected\"");
      $xtpl->parse('main.User.HomeDir');
      fPrintHomeDirXtpl("1", "--|", '', '---','main.User.HomeDir', 'HOMEDIR');

      $xtpl->assign('USER_FIRSTDIR_LABEL', $owl_lang->initial_dir);
      $xtpl->assign('USER_FIRSTDIR_VALUE', '1');
      $xtpl->assign('USER_FIRSTDIR_CAPTION', fid_to_name("1"));
      $xtpl->assign('USER_FIRSTDIR_SELECTED', " selected=\"selected\"");
      $xtpl->parse('main.User.FirstDir');
      fPrintHomeDirXtpl("1", "--|", '', '---','main.User.FirstDir', 'FIRSTDIR');

         $xtpl->assign('USER_BTN_STYLE_LABEL', $owl_lang->buttonstyle);
         if (file_exists($default->owl_fs_root . "/templates"))
	 {
            if (is_readable($default->owl_fs_root . "/templates"))
	    {
               $dir = dir($default->owl_fs_root . "/templates");
               $dir->rewind();

               while ($file = $dir->read())
               {
                  if (is_dir($default->owl_fs_root . "/templates/" . $file))
                  {
                     if ($file[0] != "." and $file != "CVS" and $file != "favicon.ico" and $file[0] != "_")
                     {
                        $xtpl->assign('USER_BTN_STYLE_VALUE', $file);
                        $xtpl->assign('USER_BTN_STYLE_CAPTION', $file);
                        $xtpl->assign('USER_BTN_STYLE_SELECTED', '');
                        
                        if ($file == $default->system_ButtonStyle)
                        {
                           $xtpl->assign('USER_BTN_STYLE_SELECTED', " selected=\"selected\"");
                        }
                        $xtpl->parse('main.User.BtnStyle');
                     }
                  }
               } 
               $dir->close();
	    }
	    else
	    {
		       print("TEMPLATE DIRETORY is not readable");
   	    }
         }
	 else
	 {
	    print("TEMPLATE DIRETORY is missing");
	 }

      $xtpl->assign('USER_QUOTA_LABEL', $owl_lang->quota);
      $xtpl->assign('USER_QUOTA_VALUE', '0');
      
      $xtpl->assign('USER_MAXSESS_LABEL', $owl_lang->maxsessions);
      $xtpl->assign('USER_MAXSESS_VALUE', '1');
      
      if ($default->auth == 0)
      {
         $xtpl->assign('USER_EDIT_PASSWD_LABEL', $owl_lang->password);
         $xtpl->assign('USER_EDIT_PASSWD_VALUE', '');
         $xtpl->assign('USER_CONF_PASSWD_LABEL', $owl_lang->confpassword);
         $xtpl->assign('USER_CONF_PASSWD_VALUE', '');
         $xtpl->parse('main.User.DefaultAuth');
      }
      $xtpl->assign('USER_EMAIL_LABEL', $owl_lang->email);
      $xtpl->assign('USER_EMAIL_VALUE', '');

      $xtpl->assign('USER_NOTIFY_LABEL', $owl_lang->notification);
      $xtpl->assign('USER_NOTIFY_SELECTED', '');

      $xtpl->assign('USER_ATTACH_LABEL', $owl_lang->attach_file);
      $xtpl->assign('USER_ATTACH_SELECTED', '');
      
      $xtpl->assign('USER_DISABLE_LABEL', $owl_lang->disableuser);
      $xtpl->assign('USER_DISABLE_SELECTED', '');
      $xtpl->parse('main.User.Disabled');

      
      $xtpl->assign('USER_DEF_VIEW_LABEL', $owl_lang->owl_user_default_view);
      $xtpl->assign('USER_DEF_VIEW_SELECTED', '');
      
      $aRevisionType[0][0] = "";
      $aRevisionType[0][1] = $owl_lang->none_selected;
      $aRevisionType[1][0] = "1";
      $aRevisionType[1][1] = $owl_lang->vermajor;
      $aRevisionType[2][0] = "2";
      $aRevisionType[2][1] = $owl_lang->verminor;

      $xtpl->assign('USER_DEF_REVISION_LABEL', $owl_lang->owl_user_default_revision);
      $xtpl->assign('USER_DEF_REVISION_SELECTED', '');
      foreach($aRevisionType as $g)
      {
         $xtpl->assign('USER_DEF_REVISION_VALUE', $g[0]);
         $xtpl->assign('USER_DEF_REVISION_CAPTION', $g[1]);
         $xtpl->parse('main.User.Revisions');
      }

      $xtpl->assign('USER_MAJ_REVISION_LABEL', $owl_lang->owl_user_major_revision);
      $xtpl->assign('USER_MAJ_REVISION_VALUE', $default->major_revision);

      $xtpl->assign('USER_MIN_REVISION_LABEL', $owl_lang->owl_user_minor_revision);
      $xtpl->assign('USER_MIN_REVISION_VALUE', $default->minor_revision);

      $xtpl->assign('USER_GROUP_ADMIN_LABEL', $owl_lang->user_group_admin);
      $xtpl->assign('USER_GROUP_ADMIN_SELECTED', '');
      
      $xtpl->assign('USER_NEW_REC_PAGE_LABEL', $owl_lang->user_login_to_newrecords);
      $xtpl->assign('USER_NEW_REC_PAGE_SELECTED', '');
      
      $xtpl->assign('USER_PDF_WATERMARK_LABEL', $owl_lang->owl_user_pdfwatermark);
      $xtpl->assign('USER_PDF_WATERMARK_SELECTED', '');
      
      $xtpl->assign('USER_PREF_ACCESS_LABEL', $owl_lang->noprefaccess);
      $xtpl->assign('USER_PREF_ACCESS_SELECTED', '');


      $aUserAccess[0] = $owl_lang->user_access_webdav_label;
      $aUserAccess[1] = $owl_lang->user_access_interface_label;
      $aUserAccess[2] = $owl_lang->user_access_both_label;

      $xtpl->assign('USER_ACCESS_LABEL', $owl_lang->user_access_label);
      $xtpl->assign('USER_ACCESS_HELP_TEXT',  sprintf($default->domtt_popup , $owl_lang->user_access_label, addslashes($owl_lang->user_access_extended), $default->popup_lifetime));
      $i = 0;
      foreach($aUserAccess as $g)
      {
         $xtpl->assign('USER_ACCESS_VALUE', $i);
         $xtpl->assign('USER_ACCESS_CAPTION', $g);
         $xtpl->assign('USER_ACCESS_SELECTED', '');
         if ($i == 1)
         {
            $xtpl->assign('USER_ACCESS_SELECTED', " checked=\"checked\"");
         }
         $i++;
         $xtpl->parse('main.User.UserAccess');
      }

      $xtpl->assign('USER_DL_COUNT_EXCLUDED_LABEL', $owl_lang->user_dl_count_excluded_label);
      $xtpl->assign('USER_DL_COUNT_EXCLUDED_EXTENDED', $owl_lang->user_dl_count_excluded_extended);
      $xtpl->assign('USER_DL_COUNT_EXCLUDED_CHECKED', '');

      if (!fIsUserAdmin($userid))
      {
         $xtpl->assign('USER_USER_ADMIN_LABEL', $owl_lang->user_admin);
         $xtpl->assign('USER_USER_ADMIN_SELECTED', '');
         $xtpl->parse('main.User.UserAdmin');
      }
      
      $xtpl->assign('USER_NEWS_ADMIN_LABEL', $owl_lang->newsadmin);
      $xtpl->assign('USER_NEWS_ADMIN_SELECTED', '');
      
      $xtpl->assign('USER_VIEW_LOG_LABEL', $owl_lang->viewlogs);
      $xtpl->assign('USER_VIEW_LOG_SELECTED', '');
      $xtpl->assign('USER_VIEW_REPORTS_LABEL', $owl_lang->viewreports);
      $xtpl->assign('USER_VIEW_REPORTS_SELECTED', '');
      
      $xtpl->assign('USER_COMMENT_NOTIFY_LABEL', $owl_lang->comment_notif);
      $xtpl->assign('USER_COMMENT_NOTIFY_SELECTED', '');
      
      $xtpl->assign('USER_EMAIL_TOOL_LABEL', $owl_lang->email_tool);
      $xtpl->assign('USER_EMAIL_TOOL_SELECTED', '');
      
      $xtpl->assign('USER_CHANGE_PASSWD_LABEL', $owl_lang->user_change_pass_next_login);
      $xtpl->assign('USER_CHANGE_PASSWD_SELECTED', '');
      
      $xtpl->assign('USER_EXPIRES_LABEL', $owl_lang->user_expires);
      $xtpl->assign('USER_EXPIRES_VALUE', '');

      $xtpl->assign('USER_AUTH_TYPE_LABEL', $owl_lang->user_auth_type);
      foreach($default->auth_type as $g)
      {
         $xtpl->assign('USER_AUTH_TYPE_VALUE', $g[0]);
         $xtpl->assign('USER_AUTH_TYPE_CAPTION', $g[1]);
         $xtpl->assign('USER_AUTH_TYPE_SELECTED', '');
         if ($g[0] == $default->auth)
         {
            $xtpl->assign('USER_AUTH_TYPE_SELECTED', " selected=\"selected\"");
         }
         $xtpl->parse('main.User.AuthType');
      }
      
      $xtpl->assign('USER_GMT_OFFSET_LABEL', $owl_lang->user_gmt_offset);
      foreach($owl_lang->time_offsets as $g)
      {
         $xtpl->assign('USER_GMT_OFFSET_VALUE', $g[0]);
         $xtpl->assign('USER_GMT_OFFSET_CAPTION', $g[1]);
         $xtpl->assign('USER_GMT_OFFSET_SELECTED', '');
         if ($g[0] == $default->machine_time_zone)
         {
            $xtpl->assign('USER_GMT_OFFSET_SELECTED', " selected=\"selected\"");
         }
         $xtpl->parse('main.User.GmtOffset');
      }

      $xtpl->assign('PREFS_PHONE_LABEL', $owl_lang->owl_prefs_phone);
      $xtpl->assign('PREFS_DEPT_LABEL', $owl_lang->owl_prefs_department);
      $xtpl->assign('PREFS_ADDRESS_LABEL', $owl_lang->owl_prefs_address);
      $xtpl->assign('PREFS_EMAIL_SIG_LABEL', $owl_lang->owl_email_signature);
   
      $xtpl->assign('USER_EMAIL_PASS_LABEL', $owl_lang->owl_user_email_pass);



      $xtpl->assign('BTN_ADD_USER_LABEL', $owl_lang->add);
      $xtpl->assign('BTN_ADD_USER_TITLE', $owl_lang->alt_add_user);

      $xtpl->assign('BTN_RESET_LABEL', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      $xtpl->parse('main.User.AddNewUser');
      $xtpl->parse('main.User');
   } 

   function printhtml()
   {
      global $default, $sess, $owl_lang, $change, $xtpl;

      if (isset($change)) 
      {
         $xtpl->assign('STATUS_MSG', $owl_lang->saved);
         $xtpl->parse('main.edhtml.StatusMsg');
      }
      $xtpl->assign('EDHTML_TITLE', $owl_lang->html_title);
      $urlArgs= array();
      $urlArgs['sess']      = $sess;
      $urlArgs['type']      = 'html';
      $urlArgs['action']      = 'edhtml';
   
      $xtpl->assign('EDHTML_EXPAND_TITLE', $owl_lang->ht_expand_width);
      $xtpl->assign('EDHTML_EXPAND_VALUE', $default->table_expand_width);

      $xtpl->assign('EDHTML_COLLAPSE_TITLE', $owl_lang->ht_collapse_width);
      $xtpl->assign('EDHTML_COLLAPSE_VALUE', $default->table_collapse_width);
      
      $xtpl->assign('EDHTML_BODY_TITLE', $owl_lang->ht_bd_bg_image);
      $xtpl->assign('EDHTML_BODY_VALUE', $default->body_background);
      
      $xtpl->assign('EDHTML_LOGO_TITLE', $owl_lang->owl_logo);
      $xtpl->assign('EDHTML_LOGO_VALUE', $default->owl_logo);
      
      
      $xtpl->assign('BTN_CHANGE', $owl_lang->change);
      $xtpl->assign('BTN_CHANGE_ALT', $owl_lang->alt_change);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      if (file_exists("../templates/$default->sButtonStyle/info.txt"))
      {
         $sFileContent = file_get_contents("../templates/$default->sButtonStyle/info.txt");
         $xtpl->assign('EDHTML_VERINFO', $sFileContent);
         $xtpl->parse('main.edhtml.VerInfo');
      }
      $xtpl->parse('main.edhtml');
   } 

   function printprefs()
   {
      global $default, $sess, $owl_lang, $change, $userid, $xtpl, $urlArgs;

      getprefs();

      if (isset($change)) 
      {
         $xtpl->assign('STATUS_MSG', $owl_lang->saved);
         $xtpl->parse('main.SiteFeatures.StatusMsg');
      }
      // 
      // Load all users to an array
      // 
      $sql = new Owl_DB;
      $sql->query("SELECT id,name FROM $default->owl_users_table");
      $i = 0;
      while ($sql->next_record())
      {
         $users[$i][0] = $sql->f("id");
         $users[$i][1] = $sql->f("name");
         $i++;
      } 
      // 
      // Load all groups to an array
      // 
      $groups = fGetGroups($userid);

      $urlArgs['sess']      = $sess;
      $urlArgs['action']      = 'edprefs';

      $xtpl->assign('MOTD_HEADING', $owl_lang->motd_headding);
      $xtpl->assign('MOTD_LABEL', $owl_lang->motd_label);
      $xtpl->assign('MOTD_VALUE', $default->owl_motd);
      $xtpl->assign('EMAIL_HEADING', $owl_lang->owl_title_email);

      $xtpl->assign('EMAIL_USE_SMTP_LABEL', $owl_lang->owl_email_smtp);
      $xtpl->assign('EMAIL_USE_SMTP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_smtp, addslashes($owl_lang->owl_use_smtp_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_USE_SMTP_CHECKED', '');
      if ($default->use_smtp == 1)
      {
         $xtpl->assign('EMAIL_USE_SMTP_CHECKED', ' checked="checked"');
      }

      $xtpl->assign('EMAIL_USE_SMTP_AUTH_LABEL', $owl_lang->owl_email_smtp_auth);
      $xtpl->assign('EMAIL_USE_SMTP_AUTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_smtp_auth, addslashes($owl_lang->owl_use_smtp_auth_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_USE_SMTP_AUTH_CHECKED', '');
      if ($default->use_smtp_auth == 1)
      {
         $xtpl->assign('EMAIL_USE_SMTP_AUTH_CHECKED', ' checked="checked"');
      }

      $xtpl->assign('EMAIL_USE_SMTP_SSL_LABEL', $owl_lang->owl_use_smtp_ssl);
      $xtpl->assign('EMAIL_USE_SMTP_SSL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_use_smtp_ssl, addslashes($owl_lang->owl_use_smtp_ssl_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_USE_SMTP_SSL_CHECKED', '');
      if ($default->use_smtp_ssl == 1)
      {
         $xtpl->assign('EMAIL_USE_SMTP_SSL_CHECKED', ' checked="checked"');
      }

      $xtpl->assign('EMAIL_SMTP_PORT_LABEL', $owl_lang->owl_smtp_port);
      $xtpl->assign('EMAIL_SMTP_PORT_VALUE', $default->smtp_port);
      $xtpl->assign('EMAIL_SMTP_PORT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_smtp_port, addslashes($owl_lang->owl_smtp_port_extended), $default->popup_lifetime
));

      $xtpl->assign('EMAIL_SMTP_MAX_SIZE_LABEL', $owl_lang->owl_smtp_max_attachemnt_size);
      $xtpl->assign('EMAIL_SMTP_MAX_SIZE_VALUE', $default->smtp_max_size);
      $xtpl->assign('EMAIL_SMTP_MAX_SIZE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_smtp_max_attachemnt_size, addslashes($owl_lang->owl_smtp_max_size_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_SMTP_SERVER_LABEL', $owl_lang->owl_email_server);
      $xtpl->assign('EMAIL_SMTP_SERVER_VALUE', $default->owl_email_server);
      $xtpl->assign('EMAIL_SMTP_SERVER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_server, addslashes($owl_lang->owl_email_server_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_SMTP_EMAIL_FROM_LABEL', $owl_lang->owl_email_from);
      $xtpl->assign('EMAIL_SMTP_EMAIL_FROM_VALUE', $default->owl_email_from);
      $xtpl->assign('EMAIL_SMTP_EMAIL_FROM_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_from, addslashes($owl_lang->owl_email_from_extended), $default->popup_lifetime));

      $xtpl->assign('EMAIL_SMTP_AUTH_LOGIN_LABEL', $owl_lang->owl_email_smtp_auth_login);
      $xtpl->assign('EMAIL_SMTP_AUTH_LOGIN_VALUE', $default->smtp_auth_login);
      $xtpl->assign('EMAIL_SMTP_AUTH_LOGIN_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_smtp_auth_login, addslashes($owl_lang->owl_smtp_auth_login_extended), $default->popup_lifetime));
      
      $xtpl->assign('EMAIL_SMTP_AUTH_PASSWD_LABEL', $owl_lang->owl_email_smtp_auth_passwd);
      $xtpl->assign('EMAIL_SMTP_AUTH_PASSWD_VALUE', $default->smtp_passwd);
      $xtpl->assign('EMAIL_SMTP_AUTH_PASSWD_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_smtp_auth_passwd, addslashes($owl_lang->owl_smtp_passwd_extended), $default->popup_lifetime));
      
      $xtpl->assign('EMAIL_SMTP_FROM_NAME_LABEL', $owl_lang->owl_email_fromname);
      $xtpl->assign('EMAIL_SMTP_FROM_NAME_VALUE', $default->owl_email_fromname);
      $xtpl->assign('EMAIL_SMTP_FROM_NAME_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_fromname, addslashes($owl_lang->owl_email_fromname_extended), $default->popup_lifetime));
      
      $xtpl->assign('EMAIL_SMTP_REPLY_TO_LABEL', $owl_lang->owl_email_replyto);
      $xtpl->assign('EMAIL_SMTP_REPLY_TO_VALUE', $default->owl_email_replyto);
      $xtpl->assign('EMAIL_SMTP_REPLY_TO_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_replyto, addslashes($owl_lang->owl_email_replyto_extended), $default->popup_lifetime));
      
      $xtpl->assign('EMAIL_SMTP_SUBJ_PREFIX_LABEL', $owl_lang->owl_email_subject_pref);
      $xtpl->assign('EMAIL_SMTP_SUBJ_PREFIX_VALUE', $default->owl_email_subject);
      $xtpl->assign('EMAIL_SMTP_SUBJ_PREFIX_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_email_subject_pref, addslashes($owl_lang->owl_email_subject_extended), $default->popup_lifetime));
      
      if ($default->owl_use_fs)
      {
         $xtpl->assign('LOOKHD_HEADING', $owl_lang->owl_title_HD);

         $xtpl->assign('LOOKHD_CHECKED', '');
         $xtpl->assign('LOOKHD_LABEL', $owl_lang->owl_lookAtHD);
         $xtpl->assign('LOOKHD_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_lookAtHD, addslashes($owl_lang->owl_lookAtHD_extended), $default->popup_lifetime));
         if ($default->owl_LookAtHD == "false")
         {
            $xtpl->assign('LOOKHD_CHECKED', ' checked="checked"');
            $urlArgs['lookAtHD_del'] = $default->owl_lookAtHD_del;
            $urlArgs['def_file_group_owner'] = $default->owl_def_file_group_owner;
            $urlArgs['def_file_owner'] = $default->owl_def_file_owner;
            $urlArgs['def_file_title'] = $default->owl_def_file_title;
            $urlArgs['def_file_meta'] = $default->owl_def_file_meta;
            $urlArgs['def_fold_group_owner'] = $default->owl_def_fold_group_owner;
            $urlArgs['def_fold_owner'] = $default->owl_def_fold_owner;
            $xtpl->parse('main.SiteFeatures.LookAtHdHeading');
            $xtpl->parse('main.SiteFeatures.LookAtHd');
         } 
         else
         {
            $xtpl->assign('LOOKHD_DEL_LABEL', $owl_lang->owl_lookAtHDDel);
            $xtpl->assign('LOOKHD_DEL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_lookAtHDDel, addslashes($owl_lang->owl_lookAtHD_del_extended), $default->popup_lifetime));
            $xtpl->assign('LOOKHD_DEL_SELECTED', '');
            if ($default->owl_lookAtHD_del == 1)
            {
               $xtpl->assign('LOOKHD_DEL_SELECTED', " checked=\"checked\"");
            }
            $xtpl->assign('LOOKHD_FILE_GROUP_OWNER_LABEL', $owl_lang->owl_def_file_group_owner);
            foreach($groups as $g)
            {
               $xtpl->assign('LOOKHD_FILE_GROUP_OWNER_VALUE', $g[0]);
               $xtpl->assign('LOOKHD_FILE_GROUP_OWNER_CHECKED', '');
               $xtpl->assign('LOOKHD_FILE_GROUP_OWNER_CAPTION', $g['1']);
               if ($g[0] == $default->owl_def_file_group_owner)
               {
                  $xtpl->assign('LOOKHD_FILE_GROUP_OWNER_CHECKED', ' selected="selected"');
               }
               $xtpl->parse('main.SiteFeatures.LookAtHd.LookAtHdOptions.DefFileGroupOwnerOption');
            }

            $xtpl->assign('LOOKHD_FILE_OWNER_LABEL', $owl_lang->owl_def_file_owner);
            foreach($users as $g)
            {
               $xtpl->assign('LOOKHD_FILE_OWNER_VALUE', $g[0]);
               $xtpl->assign('LOOKHD_FILE_OWNER_CHECKED', '');
               $xtpl->assign('LOOKHD_FILE_OWNER_CAPTION', $g['1']);
               if ($g[0] == $default->owl_def_file_owner)
               {
                  $xtpl->assign('LOOKHD_FILE_OWNER_CHECKED', ' selected="selected"');
               }
               $xtpl->parse('main.SiteFeatures.LookAtHd.LookAtHdOptions.DefFileOwnerOption');
            }


            $xtpl->assign('LOOKHD_FILE_TITLE_LABEL', $owl_lang->owl_def_file_title);
            $xtpl->assign('LOOKHD_FILE_TITLE_VALUE', $default->owl_def_file_title);
            $xtpl->assign('LOOKHD_FILE_TITLE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_def_file_title, addslashes($owl_lang->owl_def_file_title_extended), $default->popup_lifetime));
      
            $xtpl->assign('LOOKHD_FILE_META_LABEL', $owl_lang->owl_def_file_meta);
            $xtpl->assign('LOOKHD_FILE_META_VALUE', $default->owl_def_file_meta);
            $xtpl->assign('LOOKHD_FILE_META_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_def_file_meta, addslashes($owl_lang->owl_def_file_meta_extended), $default->popup_lifetime));
            $xtpl->assign('LOOKHD_FOLDER_GROUP_OWNER_LABEL', $owl_lang->owl_def_fold_group_owner);
            foreach($groups as $g)
            {
               $xtpl->assign('LOOKHD_FOLDER_GROUP_OWNER_VALUE', $g[0]);
               $xtpl->assign('LOOKHD_FOLDER_GROUP_OWNER_CHECKED', '');
               $xtpl->assign('LOOKHD_FOLDER_GROUP_OWNER_CAPTION', $g['1']);
               if ($g[0] == $default->owl_def_fold_group_owner)
               {
                  $xtpl->assign('LOOKHD_FOLDER_GROUP_OWNER_CHECKED', ' selected="selected"');
               }
               $xtpl->parse('main.SiteFeatures.LookAtHd.LookAtHdOptions.DefFolderGroupOwnerOption');
            }

            $xtpl->assign('LOOKHD_FOLDER_OWNER_LABEL', $owl_lang->owl_def_fold_owner);
            foreach($users as $g)
            {
               $xtpl->assign('LOOKHD_FOLDER_OWNER_VALUE', $g[0]);
               $xtpl->assign('LOOKHD_FOLDER_OWNER_CHECKED', '');
               $xtpl->assign('LOOKHD_FOLDER_OWNER_CAPTION', $g['1']);
               if ($g[0] == $default->owl_def_fold_owner)
               {
                  $xtpl->assign('LOOKHD_FOLDER_OWNER_CHECKED', ' selected="selected"');
               }
               $xtpl->parse('main.SiteFeatures.LookAtHd.LookAtHdOptions.DefFolderOwnerOption');
            }

            $xtpl->parse('main.SiteFeatures.LookAtHd.LookAtHdOptions');
            $xtpl->parse('main.SiteFeatures.LookAtHdHeading');
            $xtpl->parse('main.SiteFeatures.LookAtHd');
         } 
      } 
      else
      { 
         // 
         // IF owl Use Fs is fals the LookAtHd feature is not
         // shown the following lines are to preserve the values
         // in the database when something else is changed.
         // 
         $urlArgs['lookAtHD'] = $default->owl_lookAtHD;
         $urlArgs['lookAtHD_del'] = $default->owl_lookAtHD_del;
         $urlArgs['def_file_group_owner'] = $default->owl_def_file_group_owner;
         $urlArgs['def_file_owner'] = $default->owl_def_file_owner;
         $urlArgs['def_file_title'] = $default->owl_def_file_title;
         $urlArgs['def_file_meta'] = $default->owl_def_file_meta;
         $urlArgs['def_fold_group_owner'] = $default->owl_def_fold_group_owner;
         $urlArgs['def_fold_owner'] = $default->owl_def_fold_owner;
      } 
      // 
      // OWL BROWSER FEATURES
      // 
 
    $xtpl->assign('BROWSER_FEATURES_HEADING', $owl_lang->owl_title_browser);

   $xtpl->assign('BF_INFO_PANEL_LABEL', $owl_lang->info_panel_width);
   $xtpl->assign('BF_INFO_PANEL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->info_panel_width, addslashes($owl_lang->owl_info_panel_wide_extended), $default->popup_lifetime));

   $xtpl->assign('BF_INFO_PANEL_CHECKED', '');
   if ($default->display_file_info_panel_wide == 1)
   {
      $xtpl->assign('BF_INFO_PANEL_CHECKED', " checked=\"checked\"");
   }

   $status_bar[0] = $owl_lang->status_bar_not;
   $status_bar[1] = $owl_lang->status_bar_top;
   $status_bar[2] = $owl_lang->status_bar_bottom;
   $status_bar[3] = $owl_lang->status_bar_both;

   $xtpl->assign('BF_STATBAR_LOCATION_LABEL', $owl_lang->show_panel_title);
   $xtpl->assign('BF_STATBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_panel_title, addslashes($owl_lang->owl_status_bar_location_extended), $default->popup_lifetime));
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_STATBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_STATBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_STATBAR_LOCATION_CHECKED', '');
      if ($default->show_file_stats == $iValue)
      {
         $xtpl->assign('BF_STATBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.StatBarOptions');
   }
   $xtpl->assign('BF_PREFBAR_LOCATION_LABEL', $owl_lang->show_pref_title);
   $xtpl->assign('BF_PREFBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_pref_title, addslashes($owl_lang->owl_pref_bar_extended), $default->popup_lifetime));
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_PREFBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_PREFBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_PREFBAR_LOCATION_CHECKED', '');
      if ($default->show_prefs == $iValue)
      {
         $xtpl->assign('BF_PREFBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.PrefBarOptions');
   }
   
   $xtpl->assign('BF_SEARCHBAR_LOCATION_LABEL', $owl_lang->show_search_title);
   $xtpl->assign('BF_SEARCHBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_search_title, addslashes($owl_lang->owl_search_bar_extended), $default->popup_lifetime));
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_SEARCHBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_SEARCHBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_SEARCHBAR_LOCATION_CHECKED', '');
      if ($default->show_search == $iValue)
      {
         $xtpl->assign('BF_SEARCHBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.SearchBarOptions');
   }
   
   $xtpl->assign('BF_BULKBAR_LOCATION_LABEL', $owl_lang->show_bulk_title);
   $xtpl->assign('BF_BULKBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_bulk_title, addslashes($owl_lang->owl_bulk_buttons_extended), $default->popup_lifetime));
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_BULKBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_BULKBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_BULKBAR_LOCATION_CHECKED', '');
      if ($default->show_bulk == $iValue)
      {
         $xtpl->assign('BF_BULKBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.BulkBarOptions');
   }
   
   $xtpl->assign('BF_ACTIONBAR_LOCATION_LABEL', $owl_lang->show_action_title);
   $xtpl->assign('BF_ACTIONBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_action_title, addslashes($owl_lang->owl_action_buttons_extended), $default->popup_lifetime)); 
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_ACTIONBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_ACTIONBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_ACTIONBAR_LOCATION_CHECKED', '');
      if ($default->show_action == $iValue)
      {
         $xtpl->assign('BF_ACTIONBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.ActionBarOptions');
   }
   
   $xtpl->assign('BF_FOLDERBAR_LOCATION_LABEL', $owl_lang->show_folder_title);
   $xtpl->assign('BF_FOLDERBAR_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_folder_title, addslashes($owl_lang->owl_folder_tools_extended), $default->popup_lifetime));
   foreach ($status_bar as $iValue => $sCaption)
   {
      $xtpl->assign('BF_FOLDERBAR_LOCATION_VALUE', $iValue);
      $xtpl->assign('BF_FOLDERBAR_LOCATION_CAPTION', $sCaption);
      $xtpl->assign('BF_FOLDERBAR_LOCATION_CHECKED', '');
      if ($default->show_folder_tools == $iValue)
      {
         $xtpl->assign('BF_FOLDERBAR_LOCATION_CHECKED', ' checked="checked"');
      }
      $xtpl->parse('main.SiteFeatures.FolderBarOptions');
   }

   $xtpl->assign('BF_PASSWD_OVERRIDE_LABEL', $owl_lang->display_password_override);
   $xtpl->assign('BF_PASSWD_OVERRIDE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->display_password_override, addslashes($owl_lang->owl_password_override_extended), $default->popup_lifetime));
   $xtpl->assign('BF_PASSWD_OVERRIDE_CHECKED', '');
   if ($default->display_password_override == 1)
   {
      $xtpl->assign('BF_PASSWD_OVERRIDE_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_HIDE_FLD_DOC_COUNT_LABEL', $owl_lang->hide_folder_doc_count);
   $xtpl->assign('BF_HIDE_FLD_DOC_COUNT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->hide_folder_doc_count, addslashes($owl_lang->owl_hide_folder_doc_count_extended), $default->popup_lifetime));
   $xtpl->assign('BF_HIDE_FLD_DOC_COUNT_CHECKED', '');
   if ($default->hide_folder_doc_count == 1)
   {
      $xtpl->assign('BF_HIDE_FLD_DOC_COUNT_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_HIDE_FLD_SIZE_LABEL', $owl_lang->hide_folder_size);
   $xtpl->assign('BF_HIDE_FLD_SIZE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->hide_folder_size, addslashes($owl_lang->owl_hide_folder_size_extended), $default->popup_lifetime));

   $xtpl->assign('BF_HIDE_FLD_SIZE_CHECKED', '');
   if ($default->hide_folder_size == 1)
   {
      $xtpl->assign('BF_HIDE_FLD_SIZE_CHECKED', ' checked="checked"');
   }
   
   $xtpl->assign('BF_USE_ZIP_LABEL', $owl_lang->download_folder_zip);
   $xtpl->assign('BF_USE_ZIP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->download_folder_zip, addslashes($owl_lang->owl_use_zip_extended), $default->popup_lifetime));

   $xtpl->assign('BF_USE_ZIP_CHECKED', '');
   if ($default->use_zip_for_folder_download == 1)
   {
      $xtpl->assign('BF_USE_ZIP_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_FORCE_SSL_LABEL', $owl_lang->owl_force_browser_to_ssl);
   $xtpl->assign('BF_FORCE_SSL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_force_browser_to_ssl, addslashes($owl_lang->owl_force_ssl_extended), $default->popup_lifetime));
   $xtpl->assign('BF_FORCE_SSL_CHECKED', '');
   if ($default->force_ssl == 1)
   {
      $xtpl->assign('BF_FORCE_SSL_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_ALLOW_DIFF_NAME_UPD_LABEL', $owl_lang->owl_file_update_different_name);
   $xtpl->assign('BF_ALLOW_DIFF_NAME_UPD_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_file_update_different_name, addslashes($owl_lang->owl_allow_different_filename_update_extended), $default->popup_lifetime));
   $xtpl->assign('BF_ALLOW_DIFF_NAME_UPD_CHECKED', '');
   if ($default->allow_different_filename_update == 1)
   {
      $xtpl->assign('BF_ALLOW_DIFF_NAME_UPD_CHECKED', ' checked="checked"');
   }
   
   $xtpl->assign('BF_USE_WYSIWYG_LABEL', $owl_lang->owl_use_wysiwyg_editor);
   $xtpl->assign('BF_USE_WYSIWYG_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_use_wysiwyg_editor, addslashes($owl_lang->owl_use_wysiwyg_for_textarea_extended), $default->popup_lifetime));
   $xtpl->assign('BF_USE_WYSIWYG_CHECKED', '');
   if ($default->use_wysiwyg_for_textarea == 1)
   {
      $xtpl->assign('BF_USE_WYSIWYG_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_OLD_ACTION_ICONS_LABEL', $owl_lang->old_action_icons);
   $xtpl->assign('BF_OLD_ACTION_ICONS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->old_action_icons, addslashes($owl_lang->owl_old_action_icons_extended), $default->popup_lifetime));
   $xtpl->assign('BF_OLD_ACTION_ICONS_CHECKED', '');
   if ($default->old_action_icons == 1)
   {
      $xtpl->assign('BF_OLD_ACTION_ICONS_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_SEARCH_RESULT_FOLDERS_LABEL', $owl_lang->search_result_folders);
   $xtpl->assign('BF_SEARCH_RESULT_FOLDERS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->search_result_folders, addslashes($owl_lang->owl_search_result_folders_extended), $default->popup_lifetime));
   $xtpl->assign('BF_SEARCH_RESULT_FOLDERS_CHECKED', '');
   if ($default->search_result_folders == 1)
   {
      $xtpl->assign('BF_SEARCH_RESULT_FOLDERS_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_SHOW_USER_INFO_LABEL', $owl_lang->show_user_info);
   $xtpl->assign('BF_SHOW_USER_INFO_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->show_user_info, addslashes($owl_lang->owl_show_user_info_extended), $default->popup_lifetime));
   $xtpl->assign('BF_SHOW_USER_INFO_CHECKED', '');
   if ($default->show_user_info == 1)
   {
      $xtpl->assign('BF_SHOW_USER_INFO_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_FILE_DESC_REQ_LABEL', $owl_lang->file_desc_required);
   $xtpl->assign('BF_FILE_DESC_REQ_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->file_desc_required, addslashes($owl_lang->owl_filedescreq_extended), $default->popup_lifetime));
   $xtpl->assign('BF_FILE_DESC_REQ_CHECKED', '');
   if ($default->file_desc_req == 1)
   {
      $xtpl->assign('BF_FILE_DESC_REQ_CHECKED', ' checked="checked"');
   }
   
   $xtpl->assign('BF_FLD_DESC_REQ_LABEL', $owl_lang->folder_desc_required);
   $xtpl->assign('BF_FLD_DESC_REQ_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->folder_desc_required, addslashes($owl_lang->owl_folderdescreq_extended), $default->popup_lifetime));
   $xtpl->assign('BF_FLD_DESC_REQ_CHECKED', '');
   if ($default->folder_desc_req == 1)
   {
      $xtpl->assign('BF_FLD_DESC_REQ_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_FLD_DESC_POPUP_LABEL', $owl_lang->owl_show_folder_desc_popup);
   $xtpl->assign('BF_FLD_DESC_POPUP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_show_folder_desc_popup, addslashes($owl_lang->owl_show_folder_desc_as_popup_extended), $default->popup_lifetime));
   $xtpl->assign('BF_FLD_DESC_POPUP_CHECKED', '');
   if ($default->show_folder_desc_as_popup == 1)
   {
      $xtpl->assign('BF_FLD_DESC_POPUP_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BF_TRACK_FAV_LABEL', $owl_lang->allow_track_favorite);
   $xtpl->assign('BF_TRACK_FAV_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->allow_track_favorite, addslashes($owl_lang->owl_track_favorites_extended), $default->popup_lifetime));
   $xtpl->assign('BF_TRACK_FAV_CHECKED', '');
   if ($default->allow_track_favorites == 1)
   {
      $xtpl->assign('BF_TRACK_FAV_CHECKED', ' checked="checked"');
   }

   // **************
   // CUSTOM FIELDS
   // **************
   $xtpl->assign('BROWSER_CUSTOM_HEADING', $owl_lang->owl_title_custom);

   $xtpl->assign('BC_EXPAND_LABEL', $owl_lang->owl_owl_expand);
   $xtpl->assign('BC_EXPAND_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_owl_expand, addslashes($owl_lang->owl_owl_expand_extended), $default->popup_lifetime));
   $xtpl->assign('BC_EXPAND_CHECKED', '');
   if ($default->expand == 1)
   {
      $xtpl->assign('BC_EXPAND_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('BC_EXPAND_VIEW_LABEL', $owl_lang->btn_expand_view);

   $xtpl->assign('BC_STATUS_COLUMN_LABEL', $owl_lang->status_column);
   $xtpl->assign('BC_DOC_NUM_COLUMN_LABEL', $owl_lang->doc_number);
   $xtpl->assign('BC_DOC_ICON_COLUMN_LABEL', $owl_lang->docicon_column);
   $xtpl->assign('BC_DOC_FIELDS_COLUMN_LABEL', $owl_lang->doc_fields);
   $xtpl->assign('BC_TITLE_COLUMN_LABEL', $owl_lang->title);
   $xtpl->assign('BC_VER_COLUMN_LABEL', $owl_lang->ver);
   $xtpl->assign('BC_FILE_COLUMN_LABEL', $owl_lang->file);
   $xtpl->assign('BC_SIZE_COLUMN_LABEL', $owl_lang->size);
   $xtpl->assign('BC_POSTEDBY_COLUMN_LABEL', $owl_lang->postedby);
   $xtpl->assign('BC_UPDATEDBY_COLUMN_LABEL', $owl_lang->updated_by);
   $xtpl->assign('BC_MODIFIED_COLUMN_LABEL', $owl_lang->modified);
   $xtpl->assign('BC_ACTION_COLUMN_LABEL', $owl_lang->actions);
   $xtpl->assign('BC_HELD_COLUMN_LABEL', $owl_lang->held);

   $xtpl->assign('BC_EXPAND_DISP_STATUS_CHECKED', fIsCheckBoxChecked($default->expand_disp_status));
   $xtpl->assign('BC_EXPAND_DISP_DOC_NUM_CHECKED', fIsCheckBoxChecked($default->expand_disp_doc_num));
   $xtpl->assign('BC_EXPAND_DISP_DOC_TYPE_CHECKED', fIsCheckBoxChecked($default->expand_disp_doc_type));
   $xtpl->assign('BC_EXPAND_DISP_DOC_FIELDS_CHECKED', fIsCheckBoxChecked($default->expand_disp_doc_fields));
   $xtpl->assign('BC_EXPAND_DISP_TITLE_CHECKED', fIsCheckBoxChecked($default->expand_disp_title));
   $xtpl->assign('BC_EXPAND_DISP_VERSION_CHECKED', fIsCheckBoxChecked($default->expand_disp_version));
   $xtpl->assign('BC_EXPAND_DISP_FILE_CHECKED', fIsCheckBoxChecked($default->expand_disp_file));
   $xtpl->assign('BC_EXPAND_DISP_SIZE_CHECKED', fIsCheckBoxChecked($default->expand_disp_size));
   $xtpl->assign('BC_EXPAND_DISP_POSTED_CHECKED', fIsCheckBoxChecked($default->expand_disp_posted));
   $xtpl->assign('BC_EXPAND_DISP_UPDATED_CHECKED', fIsCheckBoxChecked($default->expand_disp_updated));
   $xtpl->assign('BC_EXPAND_DISP_MODIFIED_CHECKED', fIsCheckBoxChecked($default->expand_disp_modified));
   $xtpl->assign('BC_EXPAND_DISP_ACTION_CHECKED', fIsCheckBoxChecked($default->expand_disp_action));
   $xtpl->assign('BC_EXPAND_DISP_HELD_CHECKED', fIsCheckBoxChecked($default->expand_disp_held));

   $xtpl->assign('BC_COLLAPSE_VIEW_LABEL', $owl_lang->btn_collapse_view);

   $xtpl->assign('BC_COLLAPSE_DISP_STATUS_CHECKED', fIsCheckBoxChecked($default->collapse_disp_status));
   $xtpl->assign('BC_COLLAPSE_DISP_DOC_NUM_CHECKED', fIsCheckBoxChecked($default->collapse_disp_doc_num));
   $xtpl->assign('BC_COLLAPSE_DISP_DOC_TYPE_CHECKED', fIsCheckBoxChecked($default->collapse_disp_doc_type));
   $xtpl->assign('BC_COLLAPSE_DISP_DOC_FIELDS_CHECKED', fIsCheckBoxChecked($default->collapse_disp_doc_fields));
   $xtpl->assign('BC_COLLAPSE_DISP_TITLE_CHECKED', fIsCheckBoxChecked($default->collapse_disp_title));
   $xtpl->assign('BC_COLLAPSE_DISP_VERSION_CHECKED', fIsCheckBoxChecked($default->collapse_disp_version));
   $xtpl->assign('BC_COLLAPSE_DISP_FILE_CHECKED', fIsCheckBoxChecked($default->collapse_disp_file));
   $xtpl->assign('BC_COLLAPSE_DISP_SIZE_CHECKED', fIsCheckBoxChecked($default->collapse_disp_size));
   $xtpl->assign('BC_COLLAPSE_DISP_POSTED_CHECKED', fIsCheckBoxChecked($default->collapse_disp_posted));
   $xtpl->assign('BC_COLLAPSE_DISP_UPDATED_CHECKED', fIsCheckBoxChecked($default->collapse_disp_updated));
   $xtpl->assign('BC_COLLAPSE_DISP_MODIFIED_CHECKED', fIsCheckBoxChecked($default->collapse_disp_modified));
   $xtpl->assign('BC_COLLAPSE_DISP_ACTION_CHECKED', fIsCheckBoxChecked($default->collapse_disp_action));
   $xtpl->assign('BC_COLLAPSE_DISP_HELD_CHECKED', fIsCheckBoxChecked($default->collapse_disp_held));

   $xtpl->assign('BROWSER_SEARCH_RESULT_HEADING', $owl_lang->owl_title_custom_search);

   $xtpl->assign('SR_SCORE_COLUMN_LABEL', $owl_lang->score);
   $xtpl->assign('SR_FOLDER_PATH_COLUMN_LABEL', $owl_lang->owl_log_hd_fld_path);

   $xtpl->assign('SR_EXPAND_SEARCH_DISP_SCORE_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_score));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_FOLDER_PATH_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_folder_path));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_DOC_NUM_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_doc_num));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_DOC_TYPE_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_doc_type));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_DOC_FIELDS_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_doc_fields));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_FILE_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_file));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_SIZE_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_size));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_POSTED_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_posted));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_UPDATED_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_updated));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_MODIFIED_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_modified));
   $xtpl->assign('SR_EXPAND_SEARCH_DISP_ACTION_CHECKED', fIsCheckBoxChecked($default->expand_search_disp_action));
   
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_SCORE_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_score));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_FOLDER_PATH_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_folder_path));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_DOC_NUM_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_doc_num));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_DOC_TYPE_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_doc_type));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_DOC_FIELDS_CHECKED', fIsCheckBoxChecked($default->colps_search_disp_doc_fields));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_FILE_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_file));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_SIZE_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_size));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_POSTED_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_posted));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_UPDATED_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_updated));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_MODIFIED_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_modified));
   $xtpl->assign('SR_COLLAPSE_SEARCH_DISP_ACTION_CHECKED', fIsCheckBoxChecked($default->collapse_search_disp_action));

   // **************
   // THUMB NAIL
   // **************
    $xtpl->assign('THUMBNAIL_HEADING', $owl_lang->thumb_title);

   $xtpl->assign('THUMB_ENABLED_LABEL', $owl_lang->thumb_enable_thumbnails);   
   $xtpl->assign('THUMB_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_enable_thumbnails, addslashes($owl_lang->owl_thumbnails_extended), $default->popup_lifetime));
   $xtpl->assign('THUMB_ENABLED_CHECKED', '');
   if ($default->thumbnails == 1)
   {
      $xtpl->assign('THUMB_ENABLED_CHECKED', ' checked="checked"');
   }

   if ($default->thumbnails == 1)
   {
      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->thumbnails_tool_path);
      $xtpl->assign('THUMB_TOOLPATH_LABEL', $owl_lang->thumb_gen_thumb_tool_path);   
      $xtpl->assign('THUMB_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_gen_thumb_tool_path, addslashes($owl_lang->owl_thumbnails_tool_path_extended), $default->popup_lifetime));

      $xtpl->assign('THUMB_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('THUMB_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('THUMB_TOOLPATH_VALUE', $default->thumbnails_tool_path);
      
      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->thumbnails_video_tool_path);
      $xtpl->assign('THUMB_VID_TOOLPATH_LABEL', $owl_lang->thumb_gen_thumb_vid_tool_path);   
      $xtpl->assign('THUMB_VID_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_gen_thumb_vid_tool_path, addslashes($owl_lang->owl_thumbnails_video_tool_path_extended), $default->popup_lifetime));
      $xtpl->assign('THUMB_VID_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('THUMB_VID_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('THUMB_VID_TOOLPATH_VALUE', $default->thumbnails_video_tool_path);
      
      $xtpl->assign('THUMB_VID_TOOLOPT_LABEL', $owl_lang->thumb_gen_thumb_vid_tool_parms);   
      $xtpl->assign('THUMB_VID_TOOLOPT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_gen_thumb_vid_tool_parms, addslashes($owl_lang->owl_thumbnails_video_tool_opt_extended), $default->popup_lifetime));
      $xtpl->assign('THUMB_VID_TOOLOPT_VALUE', $default->thumbnails_video_tool_opt);
      
      $xtpl->assign('THUMB_SMALL_WIDTH_LABEL', $owl_lang->thumb_small_width);   
      $xtpl->assign('THUMB_SMALL_WIDTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_small_width, addslashes($owl_lang->owl_thumbnails_small_width_extended), $default->popup_lifetime));
      $xtpl->assign('THUMB_SMALL_WIDTH_VALUE', $default->thumbnails_small_width);
      
      $xtpl->assign('THUMB_MED_WIDTH_LABEL', $owl_lang->thumb_med_width);   
      $xtpl->assign('THUMB_MED_WIDTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_med_width, addslashes($owl_lang->owl_thumbnails_med_width_extended), $default->popup_lifetime)); 
      $xtpl->assign('THUMB_MED_WIDTH_VALUE', $default->thumbnails_med_width);
      
      $xtpl->assign('THUMB_LARGE_WIDTH_LABEL', $owl_lang->thumb_large_width);   
      $xtpl->assign('THUMB_LARGE_WIDTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_large_width, addslashes($owl_lang->owl_thumbnails_large_width_extended), $default->popup_lifetime));
      $xtpl->assign('THUMB_LARGE_WIDTH_VALUE', $default->thumbnails_large_width);
      
      $xtpl->assign('THUMB_COLUMNS_LABEL', $owl_lang->thumb_number_colums);   
      $xtpl->assign('THUMB_COLUMNS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->thumb_number_colums, addslashes($owl_lang->owl_thumbnail_view_columns_extended), $default->popup_lifetime));
      $xtpl->assign('THUMB_COLUMNS_VALUE', $default->thumbnail_view_columns);
      
      $xtpl->assign('THUMB_VIEW_COLUMNS_LABEL', $owl_lang->thumb_title_thumb_view);   
   
      $xtpl->assign('THUMB_VIEW_COLUMN_STATUS_LABEL', $owl_lang->status_column);   
      $xtpl->assign('THUMB_VIEW_COLUMN_DOCNO_LABEL', $owl_lang->doc_number);   
      $xtpl->assign('THUMB_VIEW_COLUMN_THUMB_LABEL', $owl_lang->thumb_image_info);   
      $xtpl->assign('THUMB_VIEW_COLUMN_VER_LABEL', $owl_lang->ver);   
      $xtpl->assign('THUMB_VIEW_COLUMN_SIZE_LABEL', $owl_lang->size);   
      $xtpl->assign('THUMB_VIEW_COLUMN_POSTEDBY_LABEL', $owl_lang->postedby);   
      $xtpl->assign('THUMB_VIEW_COLUMN_UPDATEDBY_LABEL', $owl_lang->updated_by);   
      $xtpl->assign('THUMB_VIEW_COLUMN_MODIFIED_LABEL', $owl_lang->modified);   
      $xtpl->assign('THUMB_VIEW_COLUMN_ACTIONS_LABEL', $owl_lang->actions);   
      $xtpl->assign('THUMB_VIEW_COLUMN_HELD_LABEL', $owl_lang->held);
      
      $xtpl->assign('THUMB_DISP_STATUS_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_status));
      $xtpl->assign('THUMB_DISP_DOC_NUM_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_doc_num));
      $xtpl->assign('THUMB_DISP_IMAGE_INFO_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_image_info));
      $xtpl->assign('THUMB_DISP_VERSION_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_version));
      $xtpl->assign('THUMB_DISP_SIZE_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_size));
      $xtpl->assign('THUMB_DISP_POSTED_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_posted));
      $xtpl->assign('THUMB_DISP_UPDATED_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_updated));
      $xtpl->assign('THUMB_DISP_MODIFIED_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_modified));
      $xtpl->assign('THUMB_DISP_ACTION_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_action));
      $xtpl->assign('THUMB_DISP_HELD_CHECKED',  fIsCheckBoxChecked($default->thumb_disp_held));
      
      $xtpl->parse('main.SiteFeatures.ThumbOptions');
   }
   else
   {
      $urlArgs['thumbnails_tool_path'] = $default->thumbnails_tool_path;
      $urlArgs['thumbnails_video_tool_path'] = $default->thumbnails_video_tool_path;
      $urlArgs['thumbnails_video_tool_opt'] = $default->thumbnails_video_tool_opt;
      $urlArgs['thumbnails_small_width'] = $default->thumbnails_small_width;
      $urlArgs['thumbnails_med_width'] = $default->thumbnails_med_width;
      $urlArgs['thumbnails_large_width'] = $default->thumbnails_large_width;
      $urlArgs['thumbnail_view_columns'] = $default->thumbnail_view_columns;
      $urlArgs['thumb_disp_status'] = $default->thumb_disp_status;
      $urlArgs['thumb_disp_doc_num'] = $default->thumb_disp_doc_num;
      $urlArgs['thumb_disp_image_info'] = $default->thumb_disp_image_info;
      $urlArgs['thumb_disp_version'] = $default->thumb_disp_version;
      $urlArgs['thumb_disp_size'] = $default->thumb_disp_size;
      $urlArgs['thumb_disp_posted'] = $default->thumb_disp_posted;
      $urlArgs['thumb_disp_updated'] = $default->thumb_disp_updated;
      $urlArgs['thumb_disp_modified'] = $default->thumb_disp_modified;
      $urlArgs['thumb_disp_action'] = $default->thumb_disp_action;
      $urlArgs['thumb_disp_held'] = $default->thumb_disp_held;
   }

   // *****************
   // PDF WATERMARKING
   // *****************
    $xtpl->assign('WATERMARK_HEADING', $owl_lang->owl_header_watermarking);

   $xtpl->assign('WATERMARKING_ENABLED_LABEL', $owl_lang->owl_enable_watermarking);
   $xtpl->assign('WATERMARKING_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_enable_watermarking, addslashes($owl_lang->owl_pdf_watermarks_extended), $default->popup_lifetime));
   $xtpl->assign('WATERMARKING_ENABLED_CHECKED', '');

   if ($default->pdf_watermarks == 1)
   {
      $xtpl->assign('WATERMARKING_ENABLED_CHECKED', ' checked="checked"');
   }

   if ($default->pdf_watermarks == 1)
   {
      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->pdf_watermark_path);
      $xtpl->assign('WATERMARK_TOOLPATH_LABEL', $owl_lang->owl_path_to_pdftk);
      $xtpl->assign('WATERMARK_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_path_to_pdftk, addslashes($owl_lang->owl_pdf_watermark_path_extended), 
$default->popup_lifetime));
      $xtpl->assign('WATERMARK_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('WATERMARK_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('WATERMARK_TOOLPATH_VALUE', $default->pdf_watermark_path);
      
      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->pdf_custom_watermark_filepath);
      $xtpl->assign('WATERMARK_CUST_FILEPATH_LABEL', $owl_lang->owl_path_to_pdftk_bg_file);
      $xtpl->assign('WATERMARK_CUST_FILEPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_path_to_pdftk_bg_file, addslashes($owl_lang->owl_pdf_custom_watermark_filepath_extended), $default->popup_lifetime));
      $xtpl->assign('WATERMARK_CUST_FILEPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('WATERMARK_CUST_FILEPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('WATERMARK_CUST_FILEPATH_VALUE', $default->pdf_custom_watermark_filepath);
      
      $xtpl->assign('WATERMARK_TOOL_VER_LABEL', $owl_lang->owl_pdftk_greater_than_1_40);
      $xtpl->assign('WATERMARK_TOOL_VER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_pdftk_greater_than_1_40, addslashes($owl_lang->owl_pdf_pdftk_tool_greater_than_1_40_extended), $default->popup_lifetime));
      $xtpl->assign('WATERMARK_TOOL_VER_CHECKED', '');
         if ($default->pdf_pdftk_tool_greater_than_1_40 == 1)
         {
            $xtpl->assign('WATERMARK_TOOL_VER_CHECKED', ' checked="checked"');
         }
        $xtpl->parse('main.SiteFeatures.WaterMarkOptions');
   }
   else
   {
      $urlArgs['pdf_watermark_path'] = $default->pdf_watermark_path;
      $urlArgs['pdf_custom_watermark_filepath'] = $default->pdf_custom_watermark_filepath;
      $urlArgs['pdf_pdftk_tool_greater_than_1_40'] = $default->pdf_pdftk_tool_greater_than_1_40;
   }

   // *****************
   // OTHER SETTINGS
   // *****************
   $xtpl->assign('OTHER_SETTINGS_HEADING', $owl_lang->owl_title_other);

   $xtpl->assign('OTHER_ALLOW_CUST_POPUP_LABEL', $owl_lang->cust_popup);
   $xtpl->assign('OTHER_ALLOW_CUST_POPUP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->cust_popup, addslashes($owl_lang->owl_allow_custpopup_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_ALLOW_CUST_POPUP_CHECKED', '');

   if ($default->allow_custfieldspopup == 1)
   {
      $xtpl->assign('OTHER_ALLOW_CUST_POPUP_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_ALLOW_POPUP_LABEL', $owl_lang->use_popup);
   $xtpl->assign('OTHER_ALLOW_POPUP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->use_popup, addslashes($owl_lang->owl_allow_popup_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_ALLOW_POPUP_CHECKED', '');
   if ($default->allow_popup == 1)
   {
      $xtpl->assign('OTHER_ALLOW_POPUP_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_VER_CONTROL_LABEL', $owl_lang->owl_version_control);
   $xtpl->assign('OTHER_VER_CONTROL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_version_control, addslashes($owl_lang->owl_version_control_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_VER_CONTROL_CHECKED', '');
   if ($default->owl_version_control == 1)
   {
      $xtpl->assign('OTHER_VER_CONTROL_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_INDEXING_SELECTABLE_LABEL', $owl_lang->owl_indexing_user_selectable);
   $xtpl->assign('OTHER_INDEXING_SELECTABLE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_indexing_user_selectable, addslashes($owl_lang->owl_make_file_indexing_user_selectable_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_INDEXING_SELECTABLE_CHECKED', '');
   if ($default->make_file_indexing_user_selectable == 1)
   {
      $xtpl->assign('OTHER_INDEXING_SELECTABLE_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_INDEXING_OFF_LABEL', $owl_lang->owl_indexing_off);
   $xtpl->assign('OTHER_INDEXING_OFF_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_indexing_off, addslashes($owl_lang->owl_turn_file_index_off_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_INDEXING_OFF_CHECKED', '');
   if ($default->turn_file_index_off == 1)
   {
      $xtpl->assign('OTHER_INDEXING_OFF_CHECKED', ' checked="checked"');
   }

//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
   $xtpl->assign('OTHER_FILE_REL_LABEL', $owl_lang->docRel_activateFunction);
   $xtpl->assign('OTHER_FILE_REL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->docRel_activateFunction, addslashes($owl_lang->owl_docRel_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_FILE_REL_CHECKED', '');
   if ($default->docRel == 1)
   {
      $xtpl->assign('OTHER_FILE_REL_CHECKED', ' checked="checked"');
   }
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************

   $aRevisionType[0][0] = "0";
   $aRevisionType[0][1] = $owl_lang->none_selected;
   $aRevisionType[1][0] = "1";
   $aRevisionType[1][1] = $owl_lang->vermajor;
   $aRevisionType[2][0] = "2";
   $aRevisionType[2][1] = $owl_lang->verminor;

   $xtpl->assign('OTHER_DEF_REVISION_LABEL', $owl_lang->owl_user_default_revision);
   $xtpl->assign('OTHER_DEF_REVISION_HELP_TEXT',  sprintf($default->domtt_popup , $owl_lang->owl_user_default_revision, addslashes($owl_lang->owl_default_revision_extended), $default->popup_lifetime));
   foreach($aRevisionType as $g)
   {
      $xtpl->assign('OTHER_DEF_REVISION_VALUE', $g[0]);
      $xtpl->assign('OTHER_DEF_REVISION_CAPTION', $g[1]);
      $xtpl->assign('OTHER_DEF_REVISION_SELECTED', '');
      if ($default->default_revision == $g[0])
      {
         $xtpl->assign('OTHER_DEF_REVISION_SELECTED', ' selected="selected"');
      }
      $xtpl->parse('main.SiteFeatures.Revisions');
   }

   $xtpl->assign('OTHER_GMT_OFFSET_LABEL', $owl_lang->owl_machine_timezone);
   $xtpl->assign('OTHER_GMT_OFFSET_HELP_TEXT',  sprintf($default->domtt_popup , $owl_lang->owl_machine_timezone, addslashes($owl_lang->owl_machine_time_zone_extended), $default->popup_lifetime));
   foreach($owl_lang->time_offsets as $g)
   {
      $xtpl->assign('OTHER_GMT_OFFSET_VALUE', $g[0]);
      $xtpl->assign('OTHER_GMT_OFFSET_CAPTION', $g[1]);
      $xtpl->assign('OTHER_GMT_OFFSET_SELECTED', '');
      if ($g[0] == $default->machine_time_zone)
      {
         $xtpl->assign('OTHER_GMT_OFFSET_SELECTED', " selected=\"selected\"");
      }
      $xtpl->parse('main.SiteFeatures.GmtOffset');
   }

   $xtpl->assign('OTHER_MAJ_REVISION_LABEL', $owl_lang->vermajor_initial);
   $xtpl->assign('OTHER_MAJ_REVISION_VALUE', $default->major_revision);
   $xtpl->assign('OTHER_MAJ_REVISION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->vermajor_initial, addslashes($owl_lang->owl_major_revision_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_MIN_REVISION_LABEL', $owl_lang->verminor_initial);
   $xtpl->assign('OTHER_MIN_REVISION_VALUE', $default->minor_revision);
   $xtpl->assign('OTHER_MIN_REVISION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->verminor_initial, addslashes($owl_lang->owl_minor_revision_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_RESTRICT_VIEW_LABEL', $owl_lang->owl_restrict_view);
   $xtpl->assign('OTHER_RESTRICT_VIEW_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_restrict_view, addslashes($owl_lang->owl_restrict_view_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_RESTRICT_VIEW_CHECKED', '');
   if ($default->restrict_view == 1)
   {
      $xtpl->assign('OTHER_RESTRICT_VIEW_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_HIDE_BACKUP_LABEL', $owl_lang->owl_hidebackup);
   $xtpl->assign('OTHER_HIDE_BACKUP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_hidebackup, addslashes($owl_lang->owl_hide_backup_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_HIDE_BACKUP_CHECKED', '');
   if ($default->hide_backup == 1)
   {
      $xtpl->assign('OTHER_HIDE_BACKUP_CHECKED', ' checked="checked"');
   }
   
   $xtpl->assign('OTHER_FORGOT_PASS_LABEL', $owl_lang->owl_fogotpass);
   $xtpl->assign('OTHER_FORGOT_PASS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_fogotpass, addslashes($owl_lang->owl_forgot_pass_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_FORGOT_PASS_CHECKED', '');
   if ($default->forgot_pass == 1)
   {
      $xtpl->assign('OTHER_FORGOT_PASS_CHECKED', ' checked="checked"');
   }
   
   $xtpl->assign('OTHER_MIN_PASS_LENGTH_LABEL', $owl_lang->pass_min_passwd_length);
   $xtpl->assign('OTHER_MIN_PASS_LENGTH_VALUE', $default->min_pass_length);
   $xtpl->assign('OTHER_MIN_PASS_LENGTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_min_passwd_length, addslashes($owl_lang->owl_min_pass_length_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_MIN_USER_LENGTH_LABEL', $owl_lang->pass_min_username_length);
   $xtpl->assign('OTHER_MIN_USER_LENGTH_VALUE', $default->min_username_length);
   $xtpl->assign('OTHER_MIN_USER_LENGTH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->min_username_length, addslashes($owl_lang->owl_min_username_length_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_MIN_PASS_NUMERIC_LABEL', $owl_lang->pass_min_passwd_numeric);
   $xtpl->assign('OTHER_MIN_PASS_NUMERIC_VALUE', $default->min_pass_numeric);
   $xtpl->assign('OTHER_MIN_PASS_NUMERIC_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_min_passwd_numeric, addslashes($owl_lang->owl_min_pass_numeric_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_MIN_PASS_SPECIAL_LABEL', $owl_lang->pass_min_passwd_special);
   $xtpl->assign('OTHER_MIN_PASS_SPECIAL_VALUE', $default->min_pass_special);
   $xtpl->assign('OTHER_MIN_PASS_SPECIAL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_min_passwd_special, addslashes($owl_lang->owl_min_pass_special_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_ENABLE_LOCKOUT_LABEL', $owl_lang->pass_enable_account_lockout);
   $xtpl->assign('OTHER_ENABLE_LOCKOUT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_enable_account_lockout, addslashes($owl_lang->owl_enable_lock_account_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_ENABLE_LOCKOUT_CHECKED', '');
   if ($default->enable_lock_account == 1)
   {
      $xtpl->assign('OTHER_ENABLE_LOCKOUT_CHECKED', ' checked="checked"');
      
   }
   
   $xtpl->assign('OTHER_PASS_LOCKOUT_LABEL', $owl_lang->pass_account_lockout);
   $xtpl->assign('OTHER_PASS_LOCKOUT_VALUE', $default->lock_account_bad_password);
   $xtpl->assign('OTHER_PASS_LOCKOUT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_account_lockout, addslashes($owl_lang->owl_lock_account_bad_password_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_PASS_TRACK_LABEL', $owl_lang->pass_track_old_passwords);
   $xtpl->assign('OTHER_PASS_TRACK_VALUE', $default->track_user_passwords);
   $xtpl->assign('OTHER_PASS_TRACK_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_track_old_passwords, addslashes($owl_lang->owl_track_user_passwords_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_PASS_CHANGE_LABEL', $owl_lang->pass_change_every);
   $xtpl->assign('OTHER_PASS_CHANGE_VALUE', $default->change_password_every);
   $xtpl->assign('OTHER_PASS_CHANGE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->pass_change_every, addslashes($owl_lang->owl_change_password_every_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_REC_PER_PAGE_LABEL', $owl_lang->recs_per_page);
   $xtpl->assign('OTHER_REC_PER_PAGE_VALUE', $default->records_per_page);
   $xtpl->assign('OTHER_REC_PER_PAGE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->recs_per_page, addslashes($owl_lang->owl_rec_per_page_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_DOC_ID_PREFIX_LABEL', $owl_lang->doc_id_prefix);
   $xtpl->assign('OTHER_DOC_ID_PREFIX_VALUE', $default->doc_id_prefix);
   $xtpl->assign('OTHER_DOC_ID_PREFIX_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->doc_id_prefix, addslashes($owl_lang->owl_doc_id_prefix_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_DOC_ID_DIGITS_LABEL', $owl_lang->doc_id_num_digits);
   $xtpl->assign('OTHER_DOC_ID_DIGITS_VALUE', $default->doc_id_num_digits);
   $xtpl->assign('OTHER_DOC_ID_DIGITS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->doc_id_num_digits, addslashes($owl_lang->owl_doc_id_num_digits_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_VIEW_NEW_WINDOW_LABEL', $owl_lang->view_doc_in_new_window);
   $xtpl->assign('OTHER_VIEW_NEW_WINDOW_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->view_doc_in_new_window, addslashes($owl_lang->owl_view_doc_in_new_window_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_VIEW_NEW_WINDOW_CHECKED', '');
   if ($default->view_doc_in_new_window == 1)
   {
      $xtpl->assign('OTHER_VIEW_NEW_WINDOW_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_ADMIN_TO_BROWSE_LABEL', $owl_lang->admin_login_to_browse_page);
   $xtpl->assign('OTHER_ADMIN_TO_BROWSE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->admin_login_to_browse_page, addslashes($owl_lang->owl_admin_login_to_browse_page_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_ADMIN_TO_BROWSE_CHECKED', '');
   if ($default->admin_login_to_browse_page == 1)
   {
      $xtpl->assign('OTHER_ADMIN_TO_BROWSE_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_SAVE_KEYWORDS_LABEL', $owl_lang->save_keywords_to_db);
   $xtpl->assign('OTHER_SAVE_KEYWORDS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->save_keywords_to_db, addslashes($owl_lang->owl_save_keywords_to_db_extended), $default->popup_lifetime));
   $xtpl->assign('OTHER_SAVE_KEYWORDS_CHECKED', '');
   if ($default->save_keywords_to_db == 1)
   {
      $xtpl->assign('OTHER_SAVE_KEYWORDS_CHECKED', ' checked="checked"');
   }

   $xtpl->assign('OTHER_MAX_FILESIZE_LABEL', $owl_lang->owl_max_filesize);
   $xtpl->assign('OTHER_MAX_FILESIZE_VALUE', $default->max_filesize);
   $xtpl->assign('OTHER_MAX_FILESIZE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_max_filesize, addslashes($owl_lang->owl_max_filesize_extended), $default->popup_lifetime));

   $xtpl->assign('OTHER_TIMEOUT_LABEL', $owl_lang->owl_owl_timeout);
   $xtpl->assign('OTHER_TIMEOUT_VALUE', $default->owl_timeout);
   $xtpl->assign('OTHER_TIMEOUT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_owl_timeout, addslashes($owl_lang->owl_owl_timeout_extended), $default->popup_lifetime));
   
   $xtpl->assign('OTHER_TMPDIR_LABEL', $owl_lang->owl_default_tmpdir);
   $xtpl->assign('OTHER_TMPDIR_VALUE', $default->owl_tmpdir);
   $xtpl->assign('OTHER_TMPDIR_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_default_tmpdir, addslashes($owl_lang->owl_owl_tmpdir_extended), $default->popup_lifetime));
   

   $anon[0] = $owl_lang->owl_anon_full;
   $anon[1] = $owl_lang->owl_anon_ro;
   $anon[2] = $owl_lang->owl_anon_download;

   $xtpl->assign('OTHER_ANON_RO_LABEL', $owl_lang->anonymous_access);
   $xtpl->assign('OTHER_ANON_RO_HELP_TEXT',  sprintf($default->domtt_popup , $owl_lang->anonymous_access, addslashes($owl_lang->owl_anon_ro_extended), $default->popup_lifetime));
   $i = 0;
   foreach($anon as $g)
   {
      $xtpl->assign('OTHER_ANON_RO_VALUE', $i);
      $xtpl->assign('OTHER_ANON_RO_CAPTION', $g);
      $xtpl->assign('OTHER_ANON_RO_SELECTED', '');
      if ($i == $default->anon_access)
      {
         $xtpl->assign('OTHER_ANON_RO_SELECTED', " checked=\"checked\"");
      }
      $i++;
      $xtpl->parse('main.SiteFeatures.AnonRo');
   }


   $xtpl->assign('OTHER_ANON_USER_LABEL', $owl_lang->anonymous_account);
   $xtpl->assign('OTHER_ANON_USER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->anonymous_account, addslashes($owl_lang->owl_def_anon_user_extended), $default->popup_lifetime));
   foreach($users as $g)
   {
      $xtpl->assign('OTHER_ANON_USER_VALUE', $g[0]);
      $xtpl->assign('OTHER_ANON_USER_CHECKED', '');
      $xtpl->assign('OTHER_ANON_USER_CAPTION', $g['1']);
      if ($g[0] == $default->anon_user)
      {
         $xtpl->assign('OTHER_ANON_USER_CHECKED', ' selected="selected"');
      }
      $xtpl->parse('main.SiteFeatures.AnonUser');
   }
 
   $xtpl->assign('OTHER_FILE_ADMIN_LABEL', $owl_lang->file_admin_group);
   $xtpl->assign('OTHER_FILE_ADMIN_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->file_admin_group, addslashes($owl_lang->owl_file_admin_group_extended), $default->popup_lifetime));
   foreach($groups as $g)
   {
      $xtpl->assign('OTHER_FILE_ADMIN_VALUE', $g[0]);
      $xtpl->assign('OTHER_FILE_ADMIN_CHECKED', '');
      $xtpl->assign('OTHER_FILE_ADMIN_CAPTION', $g['1']);
      if ($g[0] == $default->anon_user)
      {
         $xtpl->assign('OTHER_FILE_ADMIN_CHECKED', ' selected="selected"');
      }
      $xtpl->parse('main.SiteFeatures.FileAdmin');
   }
 

   // *****************
   // TRASH CAN OPTIONS
   // *****************
      if ($default->owl_use_fs)
      {
         $xtpl->assign('TRASH_SETTINGS_HEADING', $owl_lang->recycle_title);
         
         $xtpl->assign('TRASH_ENABLED_LABEL', $owl_lang->recycle_enabled);
         $xtpl->assign('TRASH_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->recycle_enabled, addslashes($owl_lang->owl_collect_trash_extended), $default->popup_lifetime));
         $xtpl->assign('TRASH_ENABLED_CHECKED', '');
         if ($default->collect_trash == 1)
         {
            $xtpl->assign('TRASH_ENABLED_CHECKED', ' checked="checked"');
         }

         if ($default->collect_trash == 1)
         {
            $xtpl->assign('TRASH_LOCATION_LABEL', $owl_lang->recycle_location);
            $xtpl->assign('TRASH_LOCATION_VALUE', $default->trash_can_location);
            $xtpl->assign('TRASH_LOCATION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->recycle_location, addslashes($owl_lang->owl_trash_can_location_extended), $default->popup_lifetime));

            $xtpl->assign('TRASH_RESTORE_PREFIX_LABEL', $owl_lang->restore_file_prefix);
            $xtpl->assign('TRASH_RESTORE_PREFIX_VALUE', $default->restore_file_prefix);
            $xtpl->assign('TRASH_RESTORE_PREFIX_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->restore_file_prefix, addslashes($owl_lang->owl_restore_file_prefix_extended), $default->popup_lifetime));
            $xtpl->parse('main.SiteFeatures.TrashOptions');
         } 
         else
         {
            $urlArgs['restore_file_prefix']      = $default->restore_file_prefix;
            $urlArgs['trash_can_location']       = $default->trash_can_location;
         } 

      } 

      // **********************************
      // DOCUMENT PEER REVIEW
      // **********************************
      // 
      $xtpl->assign('REVIEW_SETTINGS_HEADING', $owl_lang->owl_title_peer_review);

      $xtpl->assign('REVIEW_ENABLED_LABEL', $owl_lang->owl_peer_review);
      $xtpl->assign('REVIEW_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_peer_review, addslashes($owl_lang->owl_peer_review_extended), $default->popup_lifetime));
      $xtpl->assign('REVIEW_ENABLED_CHECKED', '');
      if ($default->document_peer_review == 1)
      {
         $xtpl->assign('REVIEW_ENABLED_CHECKED', ' checked="checked"');
      }

      if ($default->document_peer_review == 1)
      {
         $xtpl->assign('REVIEW_OPTIONAL_LABEL', $owl_lang->owl_peer_review_opt);
         $xtpl->assign('REVIEW_OPTIONAL_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_peer_review_opt, addslashes($owl_lang->owl_peer_opt_extended), $default->popup_lifetime));
         $xtpl->assign('REVIEW_OPTIONAL_CHECKED', '');
         if ($default->document_peer_review_optional == 1)
         {
            $xtpl->assign('REVIEW_OPTIONAL_CHECKED', ' checked="checked"');
         }

         $xtpl->assign('REVIEW_OLD_VERSION_LABEL', $owl_lang->owl_previous_ver_downloadable);
         $xtpl->assign('REVIEW_OLD_VERSION_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_previous_ver_downloadable, addslashes($owl_lang->owl_leave_old_file_accessible_extended), $default->popup_lifetime));
         $xtpl->assign('REVIEW_OLD_VERSION_CHECKED', '');
         if ($default->peer_review_leave_old_file_accessible == 1)
         {
            $xtpl->assign('REVIEW_OLD_VERSION_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('REVIEW_AUTO_CHECKOUT_LABEL', $owl_lang->owl_auto_checkin_checkout);
         $xtpl->assign('REVIEW_AUTO_CHECKOUT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_auto_checkin_checkout, addslashes($owl_lang->owl_auto_checkout_checking_extended), $default->popup_lifetime));
         $xtpl->assign('REVIEW_AUTO_CHECKOUT_CHECKED', '');
         if ($default->auto_checkout_checking == 1)
         {
            $xtpl->assign('REVIEW_AUTO_CHECKOUT_CHECKED', ' checked="checked"');
         }
         $xtpl->parse('main.SiteFeatures.PeerReviewOptions');
      }
      else
      {
            $urlArgs['peer_opt']      = $default->document_peer_review_optional;
            $urlArgs['auto_checkout_checking']      = $default->auto_checkout_checking;
            $urlArgs['leave_old_file_accessible']       = $default->peer_review_leave_old_file_accessible;
      }

      // **********************************
      // LOGGING Options
      // **********************************
      // 
      $xtpl->assign('LOG_SETTINGS_HEADING', $owl_lang->owl_title_logging);

      $xtpl->assign('LOG_ENABLED_LABEL', $owl_lang->owl_logging);
      $xtpl->assign('LOG_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_logging, addslashes($owl_lang->owl_logging_extended), $default->popup_lifetime));
      $xtpl->assign('LOG_ENABLED_CHECKED', '');
      if ($default->logging == 1)
      {
         $xtpl->assign('LOG_ENABLED_CHECKED', ' checked="checked"');
      }
      
      if ($default->logging == 1)
      {
         $xtpl->assign('LOG_FILE_ACT_LABEL', $owl_lang->owl_log_file);
         $xtpl->assign('LOG_FILE_ACT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_log_file, addslashes($owl_lang->owl_log_file_extended), $default->popup_lifetime));
         $xtpl->assign('LOG_FILE_ACT_CHECKED', '');
         if ($default->log_file == 1)
         {
            $xtpl->assign('LOG_FILE_ACT_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('LOG_LOGIN_ACT_LABEL', $owl_lang->owl_log_login_act);
         $xtpl->assign('LOG_LOGIN_ACT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_log_login_act, addslashes($owl_lang->owl_log_login_extended), $default->popup_lifetime));
         $xtpl->assign('LOG_LOGIN_ACT_CHECKED', '');
         if ($default->log_login == 1)
         {
            $xtpl->assign('LOG_LOGIN_ACT_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('LOG_REC_PER_PAGE_LABEL', $owl_lang->owl_log_rec_page);
         $xtpl->assign('LOG_REC_PER_PAGE_VALUE', $default->log_rec_per_page);
         $xtpl->assign('LOG_REC_PER_PAGE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_log_rec_page, addslashes($owl_lang->owl_log_rec_per_page_extended), $default->popup_lifetime));

         $xtpl->parse('main.SiteFeatures.LoggingOptions');
      } 
      else
      {
         $urlArgs['log_file']      = $default->log_file;
         $urlArgs['log_login']      = $default->log_login;
         $urlArgs['log_rec_per_page']       = $default->log_rec_per_page;
      } 

      // ***************************
      // SELF REGISTER Options
      // ***************************
      // 
      $xtpl->assign('SELFREG_SETTINGS_HEADING', $owl_lang->owl_self_reg_hd);
         
      $maxsess = $default->self_reg_maxsessions + 1;
      $xtpl->assign('SELFREG_ENABLED_LABEL', $owl_lang->owl_self_reg);
      $xtpl->assign('SELFREG_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_self_reg, addslashes($owl_lang->owl_self_reg_extended), $default->popup_lifetime));
      $xtpl->assign('SELFREG_ENABLED_CHECKED', '');
      if ($default->self_reg == 1)
      {
         $xtpl->assign('SELFREG_ENABLED_CHECKED', ' checked="checked"');
      }

      if ($default->self_reg == 1)
      {
         $xtpl->assign('SELFREG_QUOTA_LABEL', $owl_lang->quota);
         $xtpl->assign('SELFREG_QUOTA_VALUE', $default->self_reg_quota);
         $xtpl->assign('SELFREG_QUOTA_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->quota, addslashes($owl_lang->owl_self_reg_quota_extended), $default->popup_lifetime));
         
         $xtpl->assign('SELFREG_NOTIFY_LABEL', $owl_lang->notification);
         $xtpl->assign('SELFREG_NOTIFY_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->notification, addslashes($owl_lang->owl_self_reg_notify_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_NOTIFY_CHECKED', '');
         if ($default->self_reg_notify == 1)
         {
            $xtpl->assign('SELFREG_NOTIFY_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('SELFREG_ATTACHFILE_LABEL', $owl_lang->attach_file);
         $xtpl->assign('SELFREG_ATTACHFILE_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->attach_file, addslashes($owl_lang->owl_self_reg_attachfile_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_ATTACHFILE_CHECKED', '');
         if ($default->self_reg_attachfile == 1)
         {
            $xtpl->assign('SELFREG_ATTACHFILE_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('SELFREG_DISABLEUSER_LABEL', $owl_lang->disableuser);
         $xtpl->assign('SELFREG_DISABLEUSER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->disableuser, addslashes($owl_lang->owl_self_reg_disabled_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_DISABLEUSER_CHECKED', '');
         if ($default->self_reg_disabled == 1)
         {
            $xtpl->assign('SELFREG_DISABLEUSER_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('SELFREG_NOPREFACCESS_LABEL', $owl_lang->noprefaccess);
         $xtpl->assign('SELFREG_NOPREFACCESS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->noprefaccess, addslashes($owl_lang->owl_self_reg_noprefacces_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_NOPREFACCESS_CHECKED', '');
         if ($default->self_reg_noprefacces == 1)
         {
            $xtpl->assign('SELFREG_NOPREFACCESS_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('SELFREG_MAXSESS_LABEL', $owl_lang->maxsessions);
         $xtpl->assign('SELFREG_MAXSESS_VALUE', $maxsess);
         $xtpl->assign('SELFREG_MAXSESS_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->maxsessions, addslashes($owl_lang->owl_self_reg_maxsessions_extended), $default->popup_lifetime));

         $xtpl->assign('SELFREG_CREATE_HOMEDIR_LABEL', $owl_lang->create_user_homedir);
         $xtpl->assign('SELFREG_CREATE_HOMEDIR_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->create_user_homedir, addslashes($owl_lang->owl_self_create_homedir_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_CREATE_HOMEDIR_CHECKED', '');
         if ($default->self_create_homedir == 1)
         {
            $xtpl->assign('SELFREG_CREATE_HOMEDIR_CHECKED', ' checked="checked"');
         }

         $xtpl->assign('SELFREG_CAPTCHA_LABEL', $owl_lang->use_captcha);
         $xtpl->assign('SELFREG_CAPTCHA_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->use_captcha, addslashes($owl_lang->owl_self_captcha_extended), $default->popup_lifetime));
         $xtpl->assign('SELFREG_CAPTCHA_CHECKED', '');
         if ($default->registration_using_captcha == 1)
         {
            $xtpl->assign('SELFREG_CAPTCHA_CHECKED', ' checked="checked"');
         }
         
         $xtpl->assign('SELFREG_GROUP_LABEL', $owl_lang->group);
         $xtpl->assign('SELFREG_GROUP_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->group, addslashes($owl_lang->owl_self_reg_group_extended), $default->popup_lifetime));
         foreach($groups as $g)
         {
               $xtpl->assign('SELFREG_GROUP_VALUE', $g[0]);
               $xtpl->assign('SELFREG_GROUP_CHECKED', '');
               $xtpl->assign('SELFREG_GROUP_CAPTION', $g['1']);
               if ($g[0] == $default->self_reg_group)
               {
                  $xtpl->assign('SELFREG_GROUP_CHECKED', ' selected="selected"');
               }
               $xtpl->parse('main.SiteFeatures.SelfRegOptions.SelfRegGroup');
         }

         $xtpl->assign('USER_HOMEDIR_LABEL', $owl_lang->home_dir . $owl_lang->created_here);
         $xtpl->assign('USER_HOMEDIR_VALUE', '1');
         $xtpl->assign('USER_HOMEDIR_CAPTION', fid_to_name("1"));
         $xtpl->assign('USER_HOMEDIR_SELECTED', " selected=\"selected\"");
         $xtpl->parse('main.SiteFeatures.SelfRegOptions.HomeDir');
         fPrintHomeDirXtpl("1", "--|", $default->self_reg_homedir, '---','main.SiteFeatures.SelfRegOptions.HomeDir', 'HOMEDIR');

         $xtpl->assign('USER_FIRSTDIR_LABEL', $owl_lang->initial_dir);
         $xtpl->assign('USER_FIRSTDIR_VALUE', '1');
         $xtpl->assign('USER_FIRSTDIR_CAPTION', fid_to_name("1"));
         $xtpl->assign('USER_FIRSTDIR_SELECTED', " selected=\"selected\"");
         $xtpl->parse('main.SiteFeatures.SelfRegOptions.FirstDir');
         fPrintHomeDirXtpl("1", "--|", $default->self_reg_firstdir, '---','main.SiteFeatures.SelfRegOptions.FirstDir','FIRSTDIR');

         $xtpl->parse('main.SiteFeatures.SelfRegOptions');
      } 
      else
      {
         $urlArgs['self_reg_quota']      = $default->self_reg_quota;
         $urlArgs['self_reg_notify']      = $default->self_reg_notify;
         $urlArgs['self_reg_attachfile']      = $default->self_reg_attachfile;
         $urlArgs['self_reg_disabled']      = $default->self_reg_disabled;
         $urlArgs['self_reg_noprefacces']      = $default->self_reg_noprefacces;
         $urlArgs['self_reg_maxsessions']      = $maxsess;
         $urlArgs['self_reg_group']      = $default->self_reg_group;
         $urlArgs['self_reg_homedir']      = $default->self_reg_homedir;
         $urlArgs['self_reg_firstdir']      = $default->self_reg_firstdir;
         $urlArgs['self_create_homedir']      = $default->self_create_homedir;
      } 

      // ***************************
      // REMEMBER ME OPTIONS
      // ***************************
      // 
      $xtpl->assign('PERSISTLOGIN_SETTINGS_HEADING', $owl_lang->remember_me_title);

      $xtpl->assign('PERSISTLOGIN_ENABLED_LABEL', $owl_lang->remember_me);
      $xtpl->assign('PERSISTLOGIN_ENABLED_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->remember_me, addslashes($owl_lang->owl_self_reg_extended), $default->popup_lifetime));
      $xtpl->assign('PERSISTLOGIN_ENABLED_CHECKED', '');

      if ($default->remember_me == 1)
      {
         $xtpl->assign('PERSISTLOGIN_ENABLED_CHECKED', ' checked="checked"');
      }

      if ($default->remember_me == 1)
      {
         $xtpl->assign('PERSISTLOGIN_COOKIE_TIMEOUT_LABEL', $owl_lang->remember_timeout);
         $xtpl->assign('PERSISTLOGIN_COOKIE_TIMEOUT_VALUE', $default->cookie_timeout);
         $xtpl->assign('PERSISTLOGIN_COOKIE_TIMEOUT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->remember_timeout, addslashes($owl_lang->owl_cookie_timeout_extended), $default->popup_lifetime));

         $xtpl->parse('main.SiteFeatures.PersistenLoginOptions');
      }
      else
      {
         $urlArgs['cookie_timeout']      = $default->cookie_timeout;
      }

      // ***************************
      // EXTERNAL TOOLS
      // ***************************
      // 
      $xtpl->assign('TOOLS_SETTINGS_HEADING', $owl_lang->owl_title_tools);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->virus_path);
      $xtpl->assign('VIRUS_TOOLPATH_LABEL', $owl_lang->virus_path);
      $xtpl->assign('VIRUS_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->virus_path, addslashes($owl_lang->owl_virus_path_extended), $default->popup_lifetime));
      $xtpl->assign('VIRUS_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('VIRUS_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('VIRUS_TOOLPATH_VALUE', $default->virus_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->dbdump_path);
      $xtpl->assign('DBDUMP_TOOLPATH_LABEL', $owl_lang->owl_dbdump_path);
      $xtpl->assign('DBDUMP_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_dbdump_path, addslashes($owl_lang->owl_dbdump_path_extended), $default->popup_lifetime));
      $xtpl->assign('DBDUMP_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('DBDUMP_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('DBDUMP_TOOLPATH_VALUE', $default->dbdump_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->gzip_path);
      $xtpl->assign('GZIP_TOOLPATH_LABEL', $owl_lang->owl_gzip_path);
      $xtpl->assign('GZIP_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_gzip_path, addslashes($owl_lang->owl_gzip_path_extended), $default->popup_lifetime));
      $xtpl->assign('GZIP_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('GZIP_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('GZIP_TOOLPATH_VALUE', $default->gzip_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->tar_path);
      $xtpl->assign('TAR_TOOLPATH_LABEL', $owl_lang->owl_tar_path);
      $xtpl->assign('TAR_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_tar_path, addslashes($owl_lang->owl_tar_path_extended), $default->popup_lifetime));
      $xtpl->assign('TAR_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('TAR_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('TAR_TOOLPATH_VALUE', $default->tar_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->unzip_path);
      $xtpl->assign('UNZIP_TOOLPATH_LABEL', $owl_lang->owl_unzip_path);
      $xtpl->assign('UNZIP_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_unzip_path, addslashes($owl_lang->owl_unzip_path_extended), $default->popup_lifetime));
      $xtpl->assign('UNZIP_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('UNZIP_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('UNZIP_TOOLPATH_VALUE', $default->unzip_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->pod2html_path);
      $xtpl->assign('POD2HTML_TOOLPATH_LABEL', $owl_lang->owl_pod2html_path);
      $xtpl->assign('POD2HTML_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_pod2html_path, addslashes($owl_lang->owl_pod2html_path_extended), $default->popup_lifetime));
      $xtpl->assign('POD2HTML_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('POD2HTML_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('POD2HTML_TOOLPATH_VALUE', $default->pod2html_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->rtftotext_path);
      $xtpl->assign('RTFTOTEXT_TOOLPATH_LABEL', $owl_lang->rtftotext_path);
      $xtpl->assign('RTFTOTEXT_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->rtftotext_path, addslashes($owl_lang->owl_rtftotext_path_extended), $default->popup_lifetime));
      $xtpl->assign('RTFTOTEXT_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('RTFTOTEXT_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('RTFTOTEXT_TOOLPATH_VALUE', $default->rtftotext_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->pdftotext_path);
      $xtpl->assign('PDFTOTEXT_TOOLPATH_LABEL', $owl_lang->owl_pdftotext_path);
      $xtpl->assign('PDFTOTEXT_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_pdftotext_path, addslashes($owl_lang->owl_pdftotext_path_extended), $default->popup_lifetime));
      $xtpl->assign('PDFTOTEXT_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('PDFTOTEXT_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('PDFTOTEXT_TOOLPATH_VALUE', $default->pdftotext_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->wordtotext_path);
      $xtpl->assign('WORDTOTEXT_TOOLPATH_LABEL', $owl_lang->owl_wordtotext_path);
      $xtpl->assign('WORDTOTEXT_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_wordtotext_path, addslashes($owl_lang->owl_wordtotext_path_extended), $default->popup_lifetime));
      $xtpl->assign('WORDTOTEXT_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('WORDTOTEXT_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('WORDTOTEXT_TOOLPATH_VALUE', $default->wordtotext_path);

      $aStatusImage = array();
      $aStatusImage = fXtplStatusImage($default->ppttotext_path);
      $xtpl->assign('PPTTOTEXT_TOOLPATH_LABEL', $owl_lang->owl_ppttotext_path);
      $xtpl->assign('PPTTOTEXT_TOOLPATH_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->owl_ppttotext_path, addslashes($owl_lang->owl_ppttotext_path_extended), $default->popup_lifetime));
      $xtpl->assign('PPTTOTEXT_TOOLPATH_ALT', $aStatusImage['alt_tag']);
      $xtpl->assign('PPTTOTEXT_TOOLPATH_IMG', $aStatusImage['image']);
      $xtpl->assign('PPTTOTEXT_TOOLPATH_VALUE', $default->ppttotext_path);
/** DOWNLOAD COUNT FEATURE */

      $xtpl->assign('DL_COUNT_HEADING', $owl_lang->maximum_download_title);
      $xtpl->assign('DL_COUNT_ENABLE', $owl_lang->maximum_download_feature);
      $xtpl->assign('DL_COUNT_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->maximum_download_feature, addslashes($owl_lang->maximum_download_feature_extended), $default->popup_lifetime));

      $xtpl->assign('DL_COUNT_CHECKED', '');
      if ($default->use_download_count == 1)
      {
         $xtpl->assign('DL_COUNT_CHECKED', ' checked="checked"');
      }

      $xtpl->assign('DL_BLOCK_LABEL', $owl_lang->maximum_download_block);
      $xtpl->assign('DL_BLOCK_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->maximum_download_block, addslashes($owl_lang->maximum_download_block_extended), $default->popup_lifetime));

      $xtpl->assign('DL_BLOCK_CHECKED', '');
      if ($default->download_block_user == 1)
      {
         $xtpl->assign('DL_BLOCK_CHECKED', ' checked="checked"');
      }

      $xtpl->assign('DL_COUNT_TRIGGER_LABEL', $owl_lang->maximum_download_trigger);
      $xtpl->assign('DL_COUNT_TRIGGER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->maximum_download_trigger, addslashes($owl_lang->maximum_download_trigger_extended), $default->popup_lifetime));
      $xtpl->assign('DL_COUNT_TRIGGER_VALUE', $default->download_count_trigger);

      $xtpl->assign('DL_SIZE_TRIGGER_LABEL', $owl_lang->maximum_download_size_trigger);
      $xtpl->assign('DL_SIZE_TRIGGER_HELP_TEXT', sprintf($default->domtt_popup , $owl_lang->maximum_download_size_trigger, addslashes($owl_lang->maximum_download_size_trigger_extended), $default->popup_lifetime));
      $xtpl->assign('DL_SIZE_TRIGGER_VALUE', $default->download_size_trigger);

      $xtpl->assign('DL_NOTIFICATION_LIST_LABEL', $owl_lang->maximum_download_notify);
      $xtpl->assign('DL_NOTIFICATION_LIST_VALUE', implode(',', $default->download_notify_list));

      $xtpl->assign('DL_LEN_LABEL', $owl_lang->maximum_download_len);
      $xtpl->assign('DL_LEN_VALUE', $default->download_sess_length);


      $xtpl->assign('BTN_CHANGE', $owl_lang->change);
      $xtpl->assign('BTN_CHANGE_ALT', $owl_lang->alt_change);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

      $xtpl->parse('main.SiteFeatures');
   } 

function fGetProgram ( $path )
{
   $aSplitPath = explode(" ", $path);

   $sReturnPath = "";

   foreach ($aSplitPath as $piece)
   {
     $sReturnPath .= $piece . " ";

      if (file_exists(trim($sReturnPath)))
      {
         return trim($sReturnPath);
      }
   }
   return "";
}


function fXtplStatusImage ( $path )
{
   global $default, $owl_lang;
   
   $path = fGetProgram ($path);

   if (substr(php_uname(), 0, 7) != "Windows")
   {
      if(is_executable($path) and is_file($path))
      {
         $sStatusImage['image'] = "gstatus.gif";
         $sStatusImage['alt_tag'] = $owl_lang->alt_tool_status_green;
      }
      else
      {
         $sStatusImage['image'] = "rstatus.gif";
         $sStatusImage['alt_tag'] = $owl_lang->alt_tool_status_red;
      }
   }
   else
   {
      if(file_exists($path) and is_file($path))
      {
         $sStatusImage['image'] = "gstatus.gif";
         $sStatusImage['alt_tag'] = $owl_lang->alt_tool_status_green;
      }
      else
      {
         $sStatusImage['image'] = "rstatus.gif";
         $sStatusImage['alt_tag'] = $owl_lang->alt_tool_status_red;
      }
   }
   return $sStatusImage;
}

function fStatusImage ( $path )
{
   global $default, $owl_lang;
   
   $path = fGetProgram ($path);

   if (substr(php_uname(), 0, 7) != "Windows")
   {
      if(is_executable($path) and is_file($path))
      {
         $sStatusImage = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/gstatus.gif\" alt=\"$owl_lang->alt_tool_status\" title=\"$owl_lang->alt_tool_status_green\" border=\"0\"></img>";
      }
      else
      {
         $sStatusImage = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/rstatus.gif\" alt=\"$owl_lang->alt_tool_status\" title=\"$owl_lang->alt_tool_status_red\" border=\"0\"></img>";
      }
   }
   else
   {
      if(file_exists($path) and is_file($path))
      {
         $sStatusImage = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/gstatus.gif\" alt=\"$owl_lang->alt_tool_status\" title=\"$owl_lang->alt_tool_status_green\" border=\"0\"></img>";
      }
      else
      {
         $sStatusImage = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/rstatus.gif\" alt=\"$owl_lang->alt_tool_status\" title=\"$owl_lang->alt_tool_status_red\" border=\"0\"></img>";
      }
   }
   return $sStatusImage;
}

function fPrintHomeDir ( $currentparent, $level , $homedir, $stoplevel = "---")
{
   global $default;

   $sql = new Owl_DB;
   $sql->query("SELECT id,name FROM $default->owl_folders_table WHERE parent='$currentparent' order by name");

   while ($sql->next_record())
   {
      print("<option value=\"" . $sql->f("id") ."\"");
      if ($sql->f("id") == $homedir)
      {
         print (" selected=\"selected\"");
      }
      print(">" . $level . $sql->f("name") . "</option>\n");
      // if the level is 2 deep Stop
      if ($level == "-----|") // ADD --- for each additional level you want to see
      {
         continue;
      }
      else
      {
         fPrintHomeDir($sql->f("id"), $stoplevel . $level, $homedir);
      }
   }
}

   function dobackup()
   {
      global $sess, $default, $owl_lang;

      $date = date("Ymd.Hms");

      if (substr(php_uname(), 0, 7) != "Windows")
      {
         if (strpos($default->dbdump_path, "pg_dump") == false)
         {
            $command = $default->dbdump_path . " --opt --host=" . $default->owl_db_host[$default->owl_current_db] . " --user=" . $default->owl_db_user[$default->owl_current_db] . " --password=" . $default->owl_db_pass[$default->owl_current_db] . " " . $default->owl_db_name[$default->owl_current_db] . " | " . $default->gzip_path . " -fc";
         }
         else
         {
            putenv("PGPASSWORD=" . $default->owl_db_pass[$default->owl_current_db]);
            $command = $default->dbdump_path . " -d --host=" . $default->owl_db_host[$default->owl_current_db] . " --username=" . $default->owl_db_user[$default->owl_current_db] . " " . $default->owl_db_name[$default->owl_current_db] . " | " . $default->gzip_path . " -fc";
            //print("PGPASSWORD=" . $default->owl_db_pass[$default->owl_current_db] ."<br />");
            //exit($command);
         }
      } 
      else
      {
         $tmpdir = $default->owl_FileDir . "\\owltmpfld_$sess";

         if (file_exists($tmpdir)) 
         {
            myDelete($tmpdir);
         }

         mkdir("$tmpdir", $default->directory_mask);

         if (strpos($default->dbdump_path, "pg_dump") == false)
         {
            $command = escapeshellarg($default->dbdump_path) . " --opt --host=" . $default->owl_db_host[$default->owl_current_db] . " --user=" . $default->owl_db_user[$default->owl_current_db] . " --password=" . $default->owl_db_pass[$default->owl_current_db] . " " . $default->owl_db_name[$default->owl_current_db] . " > \"" . $tmpdir . '\\' . $default->owl_db_name[$default->owl_current_db] . "-$date.sql\"";
         }
         else
         {
            putenv("PGPASSWORD=" . $default->owl_db_pass[$default->owl_current_db]);
            $command = escapeshellarg($default->dbdump_path) . " -d --host=" . $default->owl_db_host[$default->owl_current_db] . " --username=" . $default->owl_db_user[$default->owl_current_db] . " " . $default->owl_db_name[$default->owl_current_db] . "  > \"" . $tmpdir . '\\' . $default->owl_db_name[$default->owl_current_db] . "-$date.sql\"";
         }

         system($command);
         $command = escapeshellarg($default->gzip_path) . ' -c -9 "' . $tmpdir . "\\" . $default->owl_db_name[$default->owl_current_db] . "-$date.sql\"";
      } 

      header("Content-Disposition: attachment; filename=\"" . $default->owl_db_name[$default->owl_current_db] . "-$date.sql.gz\"");
      header("Content-Location: " . $default->owl_db_name[$default->owl_current_db] . "-$date.sql.gz");
      header("Content-Type: application/octet-stream"); 
      // header("Content-Length: $fsize");
      // header("Pragma: no-cache");
      header("Expires: 0");
      passthru($command);

      if (substr(php_uname(), 0, 7) == "Windows")
      {
         myDelete($tmpdir);
      } 
      exit();
   } 

   if ($action)
   {
      $urlArgs = array();
      $urlArgs['sess']      = $sess;
// V4B RNG End

      if ($action == "newuser")
      {
         $urlArgs['action']    = 'add';
         $urlArgs['type']      = 'user';
      }
      elseif ($action == "newgroup")
      {
         $urlArgs['action']    = 'add';
         $urlArgs['type']      = 'group';
      } 
      else
      {
         $urlArgs['action']    = $action;
      }

      if ($action == "edprefs")
      {
         $xtpl->assign('HEADING_TITLE', $owl_lang->header_sitefeatures_settings);
      }

      if ($action <> "JUNK" and $action <> "users" and $action <> "newgroup" and $action <> "newuser" and $action <> "groups")
      {

         if ($action  == "edprefs")
         {
            $xtpl->assign('BTN_CHANGE', $owl_lang->change);
            $xtpl->assign('BTN_CHANGE_ALT', $owl_lang->alt_change);
            $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
            $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);
         }
      }
      $usersgroup = false;
      if ($action == "users" or $action == "newuser") 
      {
         $usersgroup = true;
         printusers();
         printgroups();
      }
      if (isset($owluser)) 
      {
         if(!$usersgroup)
         {
            printusers();
            printgroups();
         }
         $xtpl->assign('HEADING_TITLE', $owl_lang->edit_user);
         printuser($owluser);
      }
      if (isset($group)) 
      {
         printusers();
         printgroups();
         $xtpl->assign('HEADING_TITLE', $owl_lang->edit_group);
         printgroup($group);
      }

      if ($action == "newgroup") 
      {
         printusers();
         printgroups();
         $xtpl->assign('NEW_GROUP_HEADING', $owl_lang->enter_new_group);
         printnewgroup();
         print('<script type="text/javascript">');
         print('document.admin.name.focus();');
         print('</script> ');
      }
      if ($action == "newuser") 
      {
         $xtpl->assign('HEADING_TITLE', $owl_lang->enter_new_user);
         printnewuser(); 
      }
      if ($action == "edhtml") 
      {
         printhtml();
      }
      if ($action == "edprefs") 
      { 
         printprefs();
      }
   } 
   else
   {
      exit("$owl_lang->err_general");
   } 


   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL('Bottom');
   }

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');
?>
