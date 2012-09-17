<?php

/**
 * mtool.php
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

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

if ($default->owl_maintenance_mode == 1)
{
   if(!fIsAdmin(true))
   {
      header("Location: " . $default->owl_root_url . "/index.php?failure=9");
      exit;
   }
}



//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/mtool.xtpl");
$xtpl = new XTemplate("html/mtool.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);


if(!fIsEmailToolAccess($userid))
{
   displayBrowsePage($parent);
}


fSetLogo_MOTD();
fSetPopupHelp();

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

if ($sess == "0" && $default->anon_ro > 1)
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
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

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

      $sql = new Owl_DB;
      $sql->query("SELECT * from $default->owl_users_table where id = '$userid'");
      $sql->next_record();
      $default_reply_to = $sql->f("email");

      $urlArgs2 = $urlArgs;
      $urlArgs2['id']     = $id;
      $urlArgs2['action'] = 'email';
      $urlArgs2['type']   = $type;

      $xtpl->assign('FORM', "<form enctype='multipart/form-data' action='dbmodify.php' method='post'>");
      if (!$default->use_smtp)
      {
         $urlArgs2['ccto']   = '';
      }
      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      $xtpl->assign('MTOOL_PAGE_TITLE', $owl_lang->mtool_page_title);

      $xtpl->assign('EMAIL_TO_LABEL', $owl_lang->email_to);

      $sql = new Owl_DB;
      $sQuery = "SELECT distinct username,name ,email from $default->owl_users_table u , $default->owl_users_grpmem_table m where email <> '' and disabled = '0' and (u.groupid = '$usergroupid' or m.groupid = '$usergroupid' ";
      $sql->query("SELECT groupid from $default->owl_users_grpmem_table where userid = '$userid' and groupid is NOT NULL");
      $i = 1;
      while ($sql->next_record())
      {
         if ($sql->f("groupid") != $usergroupid)
         {
            $sQuery .= " or u.groupid = '" . $sql->f("groupid") . "' or m.groupid = '" . $sql->f("groupid") . "'";
         } 
      } 

      $sQuery .= ")  order by name";
      $sql->query("$sQuery");

      $xtpl->assign('SELECT_LABEL', $owl_lang->pick_select);

      while ($sql->next_record())
      {
         $sUsername = $sql->f("username");
         $sName = $sql->f("name");
         $sEmail = $sql->f("email");

         if ($sName == "")
         {
            $xtpl->assign('MAILTO_VALUE', $sEmail);
            $xtpl->assign('MAILTO_LABEL', $sUsername . " &#8211; (" . $sEmail . ")");
         } 
         else
         {
            $xtpl->assign('MAILTO_VALUE', $sEmail);
            $xtpl->assign('MAILTO_LABEL', $sName . " &#8211; (" . $sEmail . ")");
         }
		 $xtpl->parse('main.MailTool.MailTO');
      } 
 
   if ($default->use_smtp)
   {
      $xtpl->assign('EMAIL_CC_LABEL', $owl_lang->email_cc);
      $xtpl->parse('main.MailTool.MailCC');
   }

   $xtpl->assign('EMAIL_REPLY_LABEL', $owl_lang->email_reply_to);
   $xtpl->assign('EMAIL_REPLY_VALUE', $default_reply_to);

   $xtpl->assign('EMAIL_SUBJECT_LABEL', $owl_lang->email_subject);
   $xtpl->assign('EMAIL_SUBJECT_VALUE', $default->owl_email_subject);
   $xtpl->assign('EMAIL_BODY_LABEL', $owl_lang->email_body);
   $xtpl->assign('EMAIL_USE_SIGNATURE_LABEL', $owl_lang->owl_use_email_signature);
   $aOtherPrefs = fGetUserOtherPrefs($userid);
   $xtpl->assign('EMAIL_SIGNATURE_LABEL', $owl_lang->owl_email_signature);
   $xtpl->assign('EMAIL_SIGNATURE_VALUE', $aOtherPrefs['email_sig']);
  
   $xtpl->assign('BTN_SEND_EMAIL', $owl_lang->btn_send_email);
   $xtpl->assign('BTN_SEND_EMAIL_ALT', $owl_lang->alt_send_email);

   $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
   $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL("Bottom");
   }
   $xtpl->parse('main.MailTool');
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');
?>
