<?php

/**
 * stats.php
 * 
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

require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/Net_CheckIP/CheckIP.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");

if (!fIsAdmin(true) and !fIsReportViewer($userid))
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
   exit;
} 

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/stats.xtpl");
$xtpl = new XTemplate("html/admin/stats.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

$urlArgs = array();

if ($bdelete == $owl_lang->del_selected)
{
   if (is_array($bulkdelete))
   {
      foreach ($bulkdelete as $iFileId )
      {
          delFile($iFileId, "file_delete", 1);
      }
   }
}

if (empty($export))
{
   include_once($default->owl_fs_root . "/lib/header.inc");
   include_once($default->owl_fs_root . "/lib/userheader.inc");
}

$groups[$i][0] = $sql->f("id");
$groups[$i][1] = $sql->f("name");

$ListOfReports["1"]["0"] = 1;
$ListOfReports["1"]["1"] = "User / Files and Folders Per User";
$ListOfReports["1"]["2"] = "file_activity.php";

$ListOfReports["2"]["0"] = 2;
$ListOfReports["2"]["1"] = "Inactive Users report";
$ListOfReports["2"]["2"] = "user_inactive.php";

//$ListOfReports["3"]["0"] = 3;
//$ListOfReports["3"]["1"] = "File Read/Download access Per Folder";
//$ListOfReports["3"]["2"] = "folder_file_read_access.php";

$ListOfReports["4"]["0"] = 4;
$ListOfReports["4"]["1"] = "User Entitlement Report";
$ListOfReports["4"]["2"] = "user_entilement.php";

$ListOfReports["5"]["0"] = 5;
$ListOfReports["5"]["1"] = "Disabled Users report";
$ListOfReports["5"]["2"] = "user_disabled.php";

$ListOfReports["6"]["0"] = 6;
$ListOfReports["6"]["1"] = "List Special Access Files/Folders";
$ListOfReports["6"]["2"] = "user_special_access.php";

$ListOfReports["7"]["0"] = 7;
$ListOfReports["7"]["1"] = $owl_lang->report7_title;
$ListOfReports["7"]["2"] = "duplicate_filename.php";

if (empty($export))
{
   if ($default->show_prefs == 1 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL('Top');
   }

   fPrintAdminPanelXTPL('viewstats');

   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"" . $_SERVER["PHP_SELF"] ."\" method=\"post\">");
   
   $urlArgs['sess']      = $sess;

   $xtpl->assign('STATS_TITLE_HEADING', $owl_lang->owl_stats_viewer);

   $xtpl->assign('STATS_REPORTS_LABEL', $owl_lang->owl_stats_viewer);

   $xtpl->assign('STATS_REPORT_VALUE', '0');
   $xtpl->assign('STATS_REPORT_CAPTION', $owl_lang->report_select_report);
   if (empty($execreport))
   {
      $xtpl->assign('STATS_REPORT_SELECTED', ' selected="selected"');
   }
   else
   {
      $xtpl->assign('STATS_REPORT_SELECTED', '');
   }
   $xtpl->parse('main.Stats.Reports');
   foreach ($ListOfReports as $Report)
   {
      $xtpl->assign('STATS_REPORT_VALUE', $Report["0"]);
      $xtpl->assign('STATS_REPORT_CAPTION', $Report["1"]);
      $xtpl->assign('STATS_REPORT_SELECTED', '');
   
      if ($execreport == $Report["0"])
      {
         $xtpl->assign('STATS_REPORT_SELECTED', ' selected="selected"');
      }
      $xtpl->parse('main.Stats.Reports');
   }
}


if (!empty($execreport))
{
   require_once ("reports/" .$ListOfReports["$execreport"]["2"]);
   $xtpl->parse('main.Stats.Report'.$execreport);
}

if (empty($export))
{

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL('Bottom');
   }
   
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
   $xtpl->parse('main.Stats');
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');

}
?>
