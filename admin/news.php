<?php

/**
 * news.php
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

global $default;

require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");


if (!fIsAdmin(true) && !fIsNewsAdmin($userid)) 
{
    header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
}

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/news.xtpl");
$xtpl = new XTemplate("html/admin/news.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

include_once($default->owl_fs_root . "/lib/header.inc");
include_once($default->owl_fs_root . "/lib/userheader.inc");


$sql = new Owl_DB;
if (!isset($nid) or !is_numeric($nid))
{
   $nid = 0;
}

$urlArgs = array();

if (fIsNewsAdmin($userid))
{
   $sql->query("SELECT g.id, g.name from $default->owl_users_table u, $default->owl_groups_table g where u.groupid = g.id and u.id = '$userid';");
   $sql->next_record();
   $iPrimaryGroup = $sql->f("id");
   $groups[0][0] = $sql->f("id");
   $groups[0][1] = $sql->f("name");

   $sql->query("SELECT m.groupid, g.name from $default->owl_users_grpmem_table m, $default->owl_groups_table g where m.userid = '$userid' and m.groupid = g.id");
   $i = 1;
   while ($sql->next_record())
   {
      if (!($sql->f("groupid") == $iPrimaryGroup))
      {
         $groups[$i][0] = $sql->f("groupid");
         $groups[$i][1] = $sql->f("name");
         $i++;
      } 
   } 
} 
else
{
   $sql->query("SELECT id,name from $default->owl_groups_table order by name");
   $i = 0;
   while ($sql->next_record())
   {
      $groups[$i][0] = $sql->f("id");
      $groups[$i][1] = $sql->f("name");
      $i++;
   } 
} 

if ($action == "del_news")
{
   $del = new Owl_DB;
   $del->query("delete from $default->owl_news_table where id = '$nid'");
   $nid = 0;
} 

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}

if (fIsAdmin(true))
{
   fPrintAdminPanelXTPL("newsadmin");
}
 

if ($action == "edit_news")
{
   $edit = new Owl_DB;
   $edit->query("SELECT * from $default->owl_news_table where id = '$nid'");
   $edit->next_record();

   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"admin_dbmodify.php\" method=\"post\">");

   $urlArgs['sess']      = $sess;
   $urlArgs['action']      = 'edit_news';
   $urlArgs['nid']      = $edit->f("id");

   $xtpl->assign('NEWS_PAGE_TITLE', $owl_lang->news_title);
   if ($change == 1)
   {
      $xtpl->assign('STATUS_MSG_TEXT', $owl_lang->saved);
      $xtpl->parse('main.News.StatusMsg');
 
   }
   $xtpl->assign('NEWS_TITLE_LABEL', $owl_lang->news_heading);
   $xtpl->assign('NEWS_TITLE_VALUE', $edit->f("news_title"));

   $xtpl->assign('NEWS_CONTENT_LABEL', $owl_lang->news_content);
   $xtpl->assign('NEWS_CONTENT_VALUE', $edit->f("news"));

   $xtpl->assign('NEWS_EXPIRES_LABEL', $owl_lang->news_hd_expires);

   $xtpl->assign('NEWS_EXPIRES_VALUE', $edit->f("news_end_date"));

//   fPrintDatePickerXTPL($edit->f("news_end_date"));

   $xtpl->assign('NEWS_AUDIENCE_LABEL', $owl_lang->news_hd_audience);
   
   if ($usergroupid == "0")
   {
      $xtpl->assign('NEWS_AUDIENCE_VALUE', '-1');
      if ($edit->f("gid") == '-1')
      {
         $xtpl->assign('NEWS_AUDIENCE_SELECTED', ' selected="selected"');
      }
      $xtpl->assign('NEWS_AUDIENCE_CAPTION', $owl_lang->log_filter_all);
      $xtpl->parse('main.News.Audience');

   } 

   foreach($groups as $g)
   {
      if ($g[0] == $edit->f("gid"))
      {
         $xtpl->assign('NEWS_AUDIENCE_SELECTED', ' selected="selected"');
      }
      else
      {
         $xtpl->assign('NEWS_AUDIENCE_SELECTED', '');
      }
      $xtpl->assign('NEWS_AUDIENCE_VALUE', $g['0']);
      $xtpl->assign('NEWS_AUDIENCE_CAPTION', $g['1']);
      $xtpl->parse('main.News.Audience');

   } 

   $xtpl->assign('NEWS_CREATEDON_LABEL', $owl_lang->news_hd_created);
   $xtpl->assign('NEWS_CREATEDON_VALUE', date($owl_lang->localized_date_format, strtotime($edit->f("news_date"))));
   $xtpl->parse('main.News.CreatedOn');

   $xtpl->assign('NEWS_BTN_CHANGE_VALUE', $owl_lang->change);
   $xtpl->assign('NEWS_BTN_CHANGE_ALT', $owl_lang->alt_change);

   $xtpl->assign('NEWS_BTN_CANCEL_VALUE', $owl_lang->btn_cancel);
   $xtpl->assign('NEWS_BTN_CANCEL_ALT', $owl_lang->alt_cancel);

   $xtpl->parse('main.News.EditNewsBTN');

   $xtpl->assign('NEWS_BTN_RESET_VALUE', $owl_lang->btn_reset);
   $xtpl->assign('NEWS_BTN_RESET_ALT', $owl_lang->alt_reset_form);
} 
else
{
   $edit = new Owl_DB;
   $edit->query("SELECT * from $default->owl_news_table where id = '$nid'");
   $edit->next_record();
   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"admin_dbmodify.php\" method=\"post\">");
   
   $urlArgs['sess']      = $sess;
   $urlArgs['action']      = 'add_news';

   if ($change == 1)
   {
      $xtpl->assign('STATUS_MSG_TEXT', $owl_lang->saved);
      $xtpl->parse('main.News.StatusMsg');
   }

   $xtpl->assign('NEWS_PAGE_TITLE', $owl_lang->news_title);

   $xtpl->assign('NEWS_TITLE_LABEL', $owl_lang->news_heading);
   $xtpl->assign('NEWS_CONTENT_LABEL', $owl_lang->news_content);
   
   $xtpl->assign('NEWS_EXPIRES_LABEL', $owl_lang->news_hd_expires);
   fPrintDatePickerXTPL();
   $xtpl->assign('NEWS_AUDIENCE_LABEL', $owl_lang->news_hd_audience);
   
   if ($usergroupid == "0")
   {
      $xtpl->assign('NEWS_AUDIENCE_VALUE', '-1');
      $xtpl->assign('NEWS_AUDIENCE_SELECTED', '');
      $xtpl->assign('NEWS_AUDIENCE_CAPTION', $owl_lang->log_filter_all);
      $xtpl->parse('main.News.Audience');
   } 

   foreach($groups as $g)
   {
      if ($g[0] == $edit->f("gid"))
      {
         $xtpl->assign('NEWS_AUDIENCE_SELECTED', ' selected="selected"');
      }
      else
      {
         $xtpl->assign('NEWS_AUDIENCE_SELECTED', '');
      }
      $xtpl->assign('NEWS_AUDIENCE_VALUE', $g['0']);
      $xtpl->assign('NEWS_AUDIENCE_CAPTION', $g['1']);
      $xtpl->parse('main.News.Audience');
   } 
   
   $xtpl->assign('NEWS_BTN_ADD_VALUE', $owl_lang->btn_add_news);
   $xtpl->assign('NEWS_BTN_ADD_ALT', $owl_lang->alt_add_news);

   $xtpl->parse('main.News.AddNewsBTN');

   $xtpl->assign('NEWS_BTN_RESET_VALUE', $owl_lang->btn_reset);
   $xtpl->assign('NEWS_BTN_RESET_ALT', $owl_lang->alt_reset_form);
  
} 

$xtpl->assign('NEWS_TITLE_HD', $owl_lang->news_hd);
$xtpl->assign('NEWS_TITLE_HD_CREATED', $owl_lang->news_hd_created);
$xtpl->assign('NEWS_TITLE_HD_EXPIRES', $owl_lang->news_hd_expires);
$xtpl->assign('NEWS_TITLE_HD_AUDIENCE', $owl_lang->news_hd_audience);

$dbCountRead = new Owl_DB;
$dbGetUser = new Owl_DB;

$sWhereClause = "";
if (fIsNewsAdmin($userid))
{
   $sWhereClause = "where ";
   foreach($groups as $g)
   {
      $sWhereClause .= " gid = '$g[0]' or";
   } 
   $sWhereClause .= " 0 = 1";
} 

$sql->query("SELECT * from $default->owl_news_table $sWhereClause order by id desc");

while ($sql->next_record())
{
   $iNewsGid = $sql->f("gid");
   $iNewsId = $sql->f("id"); 
   // 
   // Get the number of Users that have Read this
   // 
   $dbCountRead->query("SELECT distinct username,name,id,maxsessions,u.groupid from $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id=m.userid where u.groupid='$iNewsGid' or m.groupid='$iNewsGid' order by name");
   $iCountRead = 0;
   $iCountTotalUser = 0;
   while ($dbCountRead->next_record())
   {
      $dbGetUser->query("SELECT lastnews from $default->owl_users_table where id ='" . $dbCountRead->f("id") . "' and disabled ='0'");
      $dbGetUser->next_record();
      if ($dbGetUser->f("lastnews") >= $iNewsId)
      {
         $iCountRead++;
      } 
      $iCountTotalUser++;
   } 
   if ($iCountTotalUser == 0)
   {
      $iCountTotalUser = 0;
      $dbCountRead->query("SELECT id,lastnews from $default->owl_users_table where disabled = '0'");
      while ($dbCountRead->next_record())
      {
         if ($dbCountRead->f("lastnews") >= $iNewsId)
         {
            $iCountRead++;
         } 
         $iCountTotalUser++;
      } 
   } 

   $CountLines++;
   $PrintLines = $CountLines % 2;
   if ($PrintLines == 0)
   {
      $xtpl->assign('TD_CLASS', 'newspreview1');
   }
   else
   {
      $xtpl->assign('TD_CLASS', 'newspreview2');
   }

   $urlArgs2 = array();
   $urlArgs2['sess']      = $sess;
   $urlArgs2['action']      = 'edit_news';
   $urlArgs2['nid']      = $sql->f("id");
   $xtpl->assign('NEWS_EDIT_BTN_URL', fGetURL('admin/news.php', $urlArgs2));
   $xtpl->assign('NEWS_EDIT_BTN_ALT', $owl_lang->alt_edit_new);

   $urlArgs2['action']      = 'del_news';
   $xtpl->assign('NEWS_DEL_BTN_URL', fGetURL('admin/news.php', $urlArgs2));
   $xtpl->assign('NEWS_DEL_BTN_ALT', $owl_lang->alt_del_new);
   $xtpl->assign('NEWS_DEL_BTN_CONFIRM', "return confirm('$owl_lang->reallydelete " . $sql->f("news_title") . " ?');");

   $xtpl->assign('NEWS_READ_LABEL', $owl_lang->news_read);
   $xtpl->assign('NEWS_READ_NUMBERS', " (" . $iCountRead . " / " . $iCountTotalUser . ")");

   $xtpl->assign('NEWS_ITEM_TITLE', $sql->f("news_title"));
   $xtpl->assign('NEWS_ITEM_CONTENT', nl2br($sql->f("news")));
   
   $xtpl->assign('NEWS_ITEM_START', date($owl_lang->localized_date_format, strtotime($sql->f("news_date"))));
   $xtpl->assign('NEWS_ITEM_END', date($owl_lang->localized_date_format, strtotime($sql->f("news_end_date"))));
   
   if ($sql->f("gid") == -1)
   {
      $xtpl->assign('NEWS_ITEM_AUDIENCE', $owl_lang->log_filter_all);
   } 
   else
   {
      $xtpl->assign('NEWS_ITEM_AUDIENCE', group_to_name($sql->f("gid")));
   } 
   $xtpl->parse('main.News.Rows');
} 

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}
                                                                                                                   
fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.News');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');


function fPrintDatePickerXTPL ($date = "")
{
   global $xtpl;
   if ($date == "")
   {
      $iCurrentYear = date("Y", mktime(0,0,0,date("m"),date("d")+7,date("y")));
      $iCurrentMonth = date("m", mktime(0,0,0,date("m"),date("d")+7,date("y")));
      $iCurrentDay = date("d", mktime(0,0,0,date("m"),date("d")+7,date("y")));
      $iCurrentHour = date("H");
      $iCurrentMinute = date("i");
   } 
   else
   {
      $iCurrentYear = substr($date, 0, 4);
      $iCurrentMonth = substr($date, 5, 2);
      $iCurrentDay = substr($date, 8, 2);
      $iCurrentHour = substr($date, 11, 2);
      $iCurrentMinute = substr($date, 14, 2);
   } 
   // 
   // Display the Year
   // 

   for ($i = $iCurrentYear;$i <= $iCurrentYear + 5;$i++)
   {
      if ($iCurrentYear == $i)
      {
         $xtpl->assign('NEWS_EXPIRES_YEAR_SELECTED', ' selected="selected"');
      } 
      else
      {
         $xtpl->assign('NEWS_EXPIRES_YEAR_SELECTED', '');
      }
      $xtpl->assign('NEWS_EXPIRES_YEAR_CAPTION', $i);
      $xtpl->assign('NEWS_EXPIRES_YEAR_VALUE', $i);
      $xtpl->parse('main.News.YearValues');
   } 
   // 
   // Display the Month
   // 
   for ($i = 1;$i < 13;$i++)
   {
      if ($i < 10)
      {
         $sString = "0" . $i;
      } 
      else
      {
         $sString = $i;
      } 
      if ($iCurrentMonth == $sString)
      {
         $xtpl->assign('NEWS_EXPIRES_MONTH_SELECTED', ' selected="selected"');
      } 
      else
      {
         $xtpl->assign('NEWS_EXPIRES_MONTH_SELECTED', '');
      }
      $xtpl->assign('NEWS_EXPIRES_MONTH_CAPTION', $sString);
      $xtpl->assign('NEWS_EXPIRES_MONTH_VALUE', $sString);
      $xtpl->parse('main.News.MonthValues');
   } 
   // 
   // Display the Day
   // 
   for ($i = 1;$i < 32;$i++)
   {
      if ($i < 10)
      {
         $sString = "0" . $i;
      } 
      else
      {
         $sString = $i;
      } 
      if ($iCurrentDay == $sString)
      {
         $xtpl->assign('NEWS_EXPIRES_DAY_SELECTED', ' selected="selected"');
      } 
      else
      {
         $xtpl->assign('NEWS_EXPIRES_DAY_SELECTED', '');
      }
      $xtpl->assign('NEWS_EXPIRES_DAY_CAPTION', $sString);
      $xtpl->assign('NEWS_EXPIRES_DAY_VALUE', $sString);
      $xtpl->parse('main.News.DayValues');
   } 
   // 
   // Display the Hour
   // 
   for ($i = 0;$i < 24;$i++)
   {
      if ($i < 10)
      {
         $sString = "0" . $i;
      } 
      else
      {
         $sString = $i;
      } 
      if ($iCurrentHour == $sString)
      {
         $xtpl->assign('NEWS_EXPIRES_HOUR_SELECTED', ' selected="selected"');
      } 
      else
      {
         $xtpl->assign('NEWS_EXPIRES_HOUR_SELECTED', '');
      }
      $xtpl->assign('NEWS_EXPIRES_HOUR_CAPTION', $sString);
      $xtpl->assign('NEWS_EXPIRES_HOUR_VALUE', $sString);
      $xtpl->parse('main.News.HourValues');
   } 
   // 
   // Display the Hour
   // 
   for ($i = 0;$i < 60;$i++)
   {
      if ($i < 10)
      {
         $sString = "0" . $i;
      } 
      else
      {
         $sString = $i;
      } 
      if ($iCurrentMinute == $sString)
      {
         $xtpl->assign('NEWS_EXPIRES_MIN_SELECTED', ' selected="selected"');
      } 
      else
      {
         $xtpl->assign('NEWS_EXPIRES_MIN_SELECTED', '');
      }
      $xtpl->assign('NEWS_EXPIRES_MIN_CAPTION', $sString);
      $xtpl->assign('NEWS_EXPIRES_MIN_VALUE', $sString);
      $xtpl->parse('main.News.MinuteValues');
   } 
} 

?>
