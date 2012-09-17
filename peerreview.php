<?php

/*
 * peerreview.php
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
 * 
*/

ob_start();
require_once(dirname(__FILE__)."/config/owl.php");
$out = ob_get_clean();
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");


if ($sess == "0" && $default->anon_ro > 1)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
   //printError($owl_lang->err_login);
}

$xtpl = new XTemplate("html/peer_approve.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

fSetLogo_MOTD();
fSetPopupHelp();

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

$sql = new Owl_DB;

if ($action == "reminder")
{
   $sql->query("SELECT * from $default->owl_peerreview_table WHERE file_id = '$id' AND status = '0' ");
   while ($sql->next_record())
   {
      notify_reviewer ($sql->f("reviewer_id"), $id, $message, "reminder");
   }
   $urlArgs2 = $urlArgs;
   $urlArgs2['type'] = $type;
   $sUrl = fGetURL ('showrecords.php', $urlArgs2);

   header("Location: " . ereg_replace("&amp;","&", $sUrl));
   exit;
}

if ($action == "publish")
{
   $sql->query("SELECT * from $default->owl_peerreview_table where file_id = '" . $id . "' and status <> '1'");
   if ($sql->num_rows() > 0)
   {
      printError("Sorry This Document has not been Approved Yet");
   }

   $sql->query("SELECT * FROM $default->owl_files_table WHERE id = '$id'");
   $sql->next_record();
   
   notify_users($usergroupid, 0, $sql->f("id"));
   notify_monitored_folders ($sql->f("parent"), $sql->f("filename"));

   $sql->query("UPDATE $default->owl_files_table SET approved = '1' WHERE id = '$id'"); 

   $urlArgs2 = $urlArgs;
   $urlArgs2['type'] = $type;
   $sUrl = fGetURL ('showrecords.php', $urlArgs2);

   owl_syslog(FILE_PUBLISHED, $userid, flid_to_filename($id), owlfileparent($id), "", "FILE");

   header("Location: " . ereg_replace("&amp;","&", $sUrl));
   exit;
}



include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

printModifyHeaderXTPL();
fPrintNavBarXTPL($parent, "", $id);


$sql->query("SELECT * from $default->owl_users_table where id = '$userid'");
$sql->next_record();
$default_reply_to = $sql->f("email");

$urlArgs2 = $urlArgs;
$urlArgs2['id']     = $id;
$urlArgs2['action'] = $action;

$xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"dbmodify.php\" method=\"post\">");
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

if ($action == 'docreject')
{
   $xtpl->assign('PEER_REVIEW_TILE', 'Peer Review - Rejecting Document');
   $xtpl->assign('PEER_REJECT_REASON', $owl_lang->peer_reject_reason);
   $xtpl->parse('main.Peer.Reject');
}
else
{
   $xtpl->assign('PEER_REVIEW_TILE', 'Peer Review - Approving Document');
   $xtpl->assign('PEER_APPROVE_REASON', $owl_lang->post_comment);
   $xtpl->parse('main.Peer.Approve');
}

$xtpl->assign('BTN_SEND_EMAIL', $owl_lang->btn_send_email);
$xtpl->assign('BTN_SEND_EMAIL_ALT', $owl_lang->alt_send_email);
$xtpl->assign('FILE_BTN_RESET', $owl_lang->btn_reset);
$xtpl->assign('FILE_BTN_RESET_ALT', $owl_lang->alt_reset_form);


if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}

$xtpl->parse('main.Peer');
fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');
?>
