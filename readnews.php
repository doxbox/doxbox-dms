<?php
/*
 * readnews.php
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
 * $Id: readnews.php,v 1.2 2006/01/05 19:41:23 b0zz Exp $
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");



$urlArgs = array();
$urlArgs['sess']      = $sess;
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;

$iGroupId = owlusergroup($userid);

if ($default->anon_user == $userid)
{
    header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
} 

$sql = new Owl_DB;

if ($default->allow_popup)
{
   //$xtpl = new XTemplate("templates/$default->sButtonStyle/html/readnews_popup.xtpl");
   $xtpl = new XTemplate("html/readnews_popup.xtpl", "templates/$default->sButtonStyle");
}
else
{
   //$xtpl = new XTemplate("templates/$default->sButtonStyle/html/readnews.xtpl");
   $xtpl = new XTemplate("html/readnews.xtpl", "templates/$default->sButtonStyle");
}
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");

fSetLogo_MOTD();
fSetPopupHelp();

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
//      fPrintPrefs("infobar1", "top");
   fPrintPrefsXTPL("Top");
}

$bLastNews = false;

if (isset($start)) 
{
   $iStartId = $start;
}
// 
// Create the where Clause for user Groups
// 
$sqlmemgroup = new Owl_DB;
$sqlmemgroup->query("select * from $default->owl_users_grpmem_table where userid = '" . $userid . "'");
$sGroupsWhereClause = "( gid = '-1' OR gid = '$iGroupId'";

while ($sqlmemgroup->next_record())
{
   $sGroupsWhereClause .= " OR gid = '" . $sqlmemgroup->f("groupid") . "'";
} 
$sGroupsWhereClause .= ")";
// print("W: $sGroupsWhereClause");
// exit;
// 
// Get the id of the last Viewed Article
// 
$sql->query("SELECT lastnews from $default->owl_users_table where id = '$userid'");
$sql->next_record();

if ($action == "")
{
   $Update = new Owl_DB;
   $iStartId = $sql->f("lastnews");
   if ($iStartId == "")
   {
      $iStartId = 0;
   }
   $bHidePrevious = true;
} 
// 
// Get the Next News Article for this user
// 
if ($action == "prev")
{
   $bHidePrevious = false;
   $iCurrentNewsId = $current - 1; 
   // 
   // If we go down one more is it the
   // first then we need to hide the
   // Prev button.
   // 
   $dNowDate = $sql->now();
   $sql->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id <= '$iCurrentNewsId' and news_end_date >= $dNowDate order by id desc LIMIT 1");
   $sql->next_record();

   $iPreviousOne = $sql->f("id");
   if ($iPreviousOne <= $iStartId)
   {
      $bHidePrevious = true;
   } 
   if ($iCurrentNewsId <= $iStartId)
   {
      $iCurrentNewsId = $iStartId;
      $dNowDate = $sql->now();
      $sql->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id >= '$iStartId'  and news_end_date >= $dNowDate LIMIT 1");
   } 
   else
   {
      $dNowDate = $sql->now();
      $sql->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id <= '$iCurrentNewsId' and news_end_date >= $dNowDate order by id desc LIMIT 1");
   } 
   $sql->next_record();

   $iCurrentNewsId = $sql->f("id");
} 
else
{
   if ($action == "")
   {
      $dNowDate = $sql->now();
      $sql->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id > '$iStartId' and news_end_date >= $dNowDate LIMIT 1");
      $sql->next_record();
      $iStartId = $sql->f("id");
   } 
   else
   {
      $bHidePrevious = false;
      if (isset($current))
      {
         $iCurrentNewsId = $current;
      }
      else
      {
         $iCurrentNewsId = '';
      }
      $dNowDate = $sql->now();
      $sql->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id > '$iCurrentNewsId' and news_end_date >= $dNowDate LIMIT 1");
      //$sql->query($sMyQuery2);
      $sql->next_record();
   } 

   if ($sql->num_rows() == 0)
   {
      //print('<script language="javascript">');
      //print('window.close();');
      //print('</script>');
      $xtpl->assign('JS_CLOSE', '<script language="javascript">window.close();</script>');
   } 
   else
   {
      $iCurrentNewsId = $sql->f("id");
      $UpdateUser = new Owl_DB;
      $bLastNews = false;
      $dNowDate = $UpdateUser->now();
      $UpdateUser->query("SELECT * from $default->owl_news_table where $sGroupsWhereClause and id > '$iCurrentNewsId' and news_end_date >= $dNowDate LIMIT 1");
      $UpdateUser->next_record();

      if ($UpdateUser->num_rows() == 0)
      {
         $bLastNews = true;
      } 

      $UpdateUser->query("UPDATE $default->owl_users_table set lastnews = '" . $iCurrentNewsId . "' where id = '$userid'");
   } 
} 
//print("<table align='center' WIDTH='90%' CELLSPACING='2' CELLPADDING='2' border='0' HEIGHT='100%'>");
//print("<td align=left WIDTH='90%'>\n");
//print("<h4>" . $sql->f("news_title") . "</h4>\n");
//print("</td>\n");
      $xtpl->assign('NEWS_TITLE', $sql->f("news_title"));
      $xtpl->assign('NEWS_PRINT_ALT', $owl_lang->alt_news_print);

if (!$bHidePrevious)
{
   $urlArgs['action']      = 'prev';
   if (isset($iStartId))
   {
      $urlArgs['start']      = $iStartId;
   }
   $urlArgs['current']      = $iCurrentNewsId;
   $url = fGetURL ('readnews.php', $urlArgs);
   $xtpl->assign('PREV_URL', $url); 
   $xtpl->assign('PREV_URL_ALT', $owl_lang->alt_news_prev);
   $xtpl->assign('PREV_IMG', 'prev'); 
   $xtpl->parse('main.newsreader.BtnPrevTop');
} 
else
{
   //print("<td></td>");
} 

?>
<?php
if ($bLastNews)
{
   if ($default->allow_popup)
   {
      $urlArgs['action']      = 'next';
      $urlArgs['start']      = $iStartId;
      $urlArgs['current']      = $iCurrentNewsId;
      $url = fGetURL ('readnews.php', $urlArgs);
      $xtpl->assign('CLOSE_URL', $url); 
      $xtpl->assign('CLOSE_URL_ALT', $owl_lang->alt_news_close);
      $xtpl->assign('CLOSE_IMG', 'close'); 
      $xtpl->parse('main.newsreader.BtnCloseTop');
   } 
   else
   {
      $urlArgs['action']     = '';
      $urlArgs['start']      = '';
      $urlArgs['current']    = '';
      $url = fGetURL ('browse.php', $urlArgs);
      $xtpl->assign('CLOSE_URL', $url); 
      $xtpl->assign('CLOSE_URL_ALT', $owl_lang->alt_news_close);
      $xtpl->assign('CLOSE_IMG', 'close'); 
      $xtpl->parse('main.newsreader.BtnCloseTop');
      //print("<td align='center'><a href='browse.php?sess=$sess'><img src='$default->owl_graphics_url/$default->sButtonStyle/ui_nav/close.gif' alt='$owl_lang->alt_return' title='$owl_lang->alt_return' border='0' /></a> </td>");
   } 
} 
else
{
   $urlArgs['action']      = 'next';
   if (isset($iStartId))
   {
      $urlArgs['start']      = $iStartId;
   }
   if (isset($iCurrentNewsId))
   {
      $urlArgs['current']      = $iCurrentNewsId;
   }
   $url = fGetURL ('readnews.php', $urlArgs);
   $xtpl->assign('NEXT_URL', $url); 
   $xtpl->assign('NEXT_URL_ALT', $owl_lang->alt_news_next);
   $xtpl->assign('NEXT_IMG', 'next'); 
   $xtpl->parse('main.newsreader.BtnNextTop');
} 

$xtpl->assign('NEWS_DESC', nl2br($sql->f("news")));
$xtpl->assign('NEWS_POSTED', "$owl_lang->news_posted_date  " . date($owl_lang->localized_date_format, strtotime($sql->f("news_date"))));

if (!$bHidePrevious)
{
   $urlArgs['action']      = 'prev';
   if (isset($iStartId))
   {
      $urlArgs['start']      = $iStartId;
   }
   $urlArgs['current']      = $iCurrentNewsId;
   $url = fGetURL ('readnews.php', $urlArgs);
   $xtpl->assign('PREV_URL', $url); 
   $xtpl->assign('PREV_URL_ALT', $owl_lang->alt_news_prev);
   $xtpl->assign('PREV_IMG', 'prev'); 
   $xtpl->parse('main.newsreader.BtnPrevBottom');
} 
else
{
   //print("<td></td>");
} 

?>
<?php
if ($bLastNews)
{
   if ($default->allow_popup)
   {
      $urlArgs['action']      = 'next';
      $urlArgs['start']      = $iStartId;
      $urlArgs['current']      = $iCurrentNewsId;
      $url = fGetURL ('readnews.php', $urlArgs);
      $xtpl->assign('NEXT_URL', $url); 
      $xtpl->assign('NEXT_URL_ALT', $owl_lang->alt_news_close);
      $xtpl->assign('NEXT_IMG', 'close');
      $xtpl->parse('main.newsreader.BtnNextBottom');
   } 
   else
   {
      $urlArgs['action']     = '';
      $urlArgs['start']      = '';
      $urlArgs['current']    = '';
      $url = fGetURL ('browse.php', $urlArgs);
      $xtpl->assign('CLOSE_URL', $url); 
      $xtpl->assign('CLOSE_URL_ALT', $owl_lang->alt_return);
      $xtpl->assign('CLOSE_IMG', 'close'); 
      $xtpl->parse('main.newsreader.BtnCloseBottom');
      //print("<td align='center'><a href='browse.php?sess=$sess'><img src='$default->owl_graphics_url/$default->sButtonStyle/ui_nav/close.gif' alt='$owl_lang->alt_return' title='$owl_lang->alt_return' border='0' /></a> </td>");
   } 
} 
else
{
      $urlArgs['action']      = 'next';
      if (isset($iStartId))
      {
         $urlArgs['start']      = $iStartId;
      }
      if (isset($iCurrentNewsId))
      {
         $urlArgs['current']      = $iCurrentNewsId;
      } 
      $url = fGetURL ('readnews.php', $urlArgs);
      $xtpl->assign('NEXT_URL', $url); 
      $xtpl->assign('NEXT_URL_ALT', $owl_lang->alt_news_next);
      $xtpl->assign('NEXT_IMG', 'next');
      $xtpl->parse('main.newsreader.BtnNextBottom');
} 

fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main.newsreader');
$xtpl->parse('main');
$xtpl->out('main');

?>
