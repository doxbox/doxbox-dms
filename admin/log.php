<?php

/**
 * log.php
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
 *
 * $Id: log.php,v 1.10 2006/09/15 17:10:50 b0zz Exp $
 */

global $default, $whereclause;

require_once(dirname(dirname(__FILE__)). "/config/owl.php");
require_once($default->owl_fs_root . "/lib/Net_CheckIP/CheckIP.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/log.xtpl");
$xtpl = new XTemplate("html/admin/log.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

if (!fIsAdmin(true) and !fIsLogViewer($userid))
{
    header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
}

fSetLogo_MOTD();
fSetPopupHelp();

$urlArgs = array();

if (!isset($nextrecord)) $nextrecord = 0;
if (!isset($next)) $next = 0;
if (!isset($prev)) $prev = 0;
if (!isset($hideagent)) $hideagent = 0;
if (isset($fa))
{
   $filteraction = unserialize(stripslashes($fa));
}
else
{
  if (!isset($filteraction))
  {
     $filteraction[0] = '0';
  }
}
if (!isset($hidedetail)) $hidedetail = 0;

if ($next == 1) $nextrecord = $nextrecord + $default->log_rec_per_page;
if ($prev == 1)
{
   $nextrecord = $nextrecord - $default->log_rec_per_page;
   if ($nextrecord < 0)
   {
      $nextrecord = 0;
   } 
} 

$whereclause = " where 1=1";

if (isset($filteraction) && $filteraction[0] != "0")
{
   $whereclause .= " and (";
   foreach($filteraction as $fa)
   {
      $whereclause .= " action='$fa' or";
   } 
   $whereclause .= " action='$fa')";
} 

if (isset($filteruser) && $filteruser != "0")
{
   $whereclause .= " and userid='$filteruser'";
} 
else
{
   $filteruser = '0';
}
if (isset($filtergroup))
{
   if ($filtergroup == "0" and $filtergroup != "-1")
   {
      $whereclause .= " and u.groupid='$filtergroup'";
   }
   else
   {
      $filtergroup = "-1";
   }
}
else
{
      $filtergroup = "-1";
}


if (isset($filter_file) && $filter_file != "0")
{
   $whereclause .= " and filename='$filter_file'";
}
else
{
   $filter_file = '0';
}

if (isset($ip_hostname))
{
   $whereclause .= " and ip like '%$ip_hostname%'";
}
else
{
  $ip_hostname = '';
}

if (isset($filter_from) && $filter_from != "0")
{
   if (strpos($filter_from, ':') > 0 )
   {
      $whereclause .= " and logdate >= '$filter_from'";
   }
   else
   {
      $whereclause .= " and logdate >= '$filter_from 00:00'";
   }

} 
else
{
   $filter_from = '0';
}

if (isset($filter_to) && $filter_to != "0")
{
   if (strpos($filter_to, ':') > 0)
   {
      $whereclause .= " and logdate <= '$filter_to'";
   }
   else
   {
      $whereclause .= " and logdate <= '$filter_to 23:59'";
   }
} 
else
{
   $filter_to = '0';
}




if ($action == "gencsv")
{
   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_log_table left outer join $default->owl_users_table  u on u.id=userid $whereclause ORDER BY logdate DESC");
     header( 'Pragma: ' );
      header( 'Cache-Control: ' );

      header( 'Content-Type: application/vnd-ms.excel' );

      $aDate = getdate();
      $sExportFilename = 'export_' . $aDate[ 'month' ] . '_' . $aDate[ 'mday' ] . '_' . $aDate[ 'year' ] . '.csv';
      header( 'Content-Disposition: attachment; filename="' . $sExportFilename . '"' );


      $sFieldHeadings = '"' . $owl_lang->owl_log_hd_action ."\",";
      $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_file   ."\",";
      $sFieldHeadings .= '"' . "File Size"   ."\",";
      $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_fld_path ."\",";
      $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_user ."\",";
      $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_dt_tm ."\",";
      $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_ip ."\",";

      if ($hideagent == 0 and $hidedetail == 0)
      {
         $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_agent ."\",";
         $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_dtls ."\",";
      }
      else
      {
         if ($hideagent == 0)
         {
            $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_agent ."\",";
         }
         if ($hidedetail == 0)
         {
            $sFieldHeadings .= '"' . $owl_lang->owl_log_hd_dtls ."\",";
         }
      }

      echo $sFieldHeadings . "\n";

      while ($sql->next_record())
      {
         echo "\"<" . $log_file_actions[$sql->f("action")] . ">\",";
         if ($sql->f("type") != "LOGIN")
         {
            echo '"' . $sql->f("filename") . '",' ;
            if ($sql->f("filesize") > 0)
            {
               echo '"' . gen_filesize($sql->f("filesize")) . '",' ;
            }
            else
            {
               echo '"",';
            }
            echo '"' . get_dirpath($sql->f("parent")) , "\",";
         }
         else
         {
            echo '"","","",';
         }
         echo '"' . uid_to_name($sql->f("userid")) . "\",";
         echo '"' . date($owl_lang->localized_date_format, strtotime($sql->f("logdate"))), "\",";
         if (Net_CheckIP::check_ip($sql->f('ip')))
         {
            echo '"' . fGetHostByAddress($sql->f('ip')) . "\",";
         }
         else
         {
            echo '"' . $sql->f('ip') . "\",";
         }
         if ($hideagent == 0 and $hidedetail == 0)
         {
            echo '"' . $sql->f("agent") . "\",";
            echo '"' . $sql->f("details") . "\",";
         }
         else
         {
            if ($hideagent == 0)
            {
               echo '"' . $sql->f("agent") . "\",";
            }
            if ($hidedetail == 0)
            {
               echo '"' . $sql->f("details") . "\",";
            }
         }
         echo "\n";
            
      }
      exit;
}

if ($action == "gen_pdf")
{

   $sName = "owl_syslog_" . date("Ymd") . "_" . date("Gis");


   $txt = "";

   $aFirstpExtension = fFindFileFirstpartExtension ($sName);
   $sFirstPart = $aFirstpExtension[0];

   $pdf=new Owl_PDF("landscape");
   $pdf->SetTitle("Owl Syslog - " . date("Y/m/d") . "  " . date("G:i:s"));
   $pdf->SetAuthor(uid_to_name($userid));
   $pdf->SetCreator($default->version);
   $pdf->SetTextColor(0,0,0);
   $pdf->sFpdfTitle = "                                                                       " . $owl_lang->owl_log_viewer;
   $pdf->sFpdfDocName = $sName;
   $pdf->AliasNbPages();
   $pdf->AddPage();

   $pdf->SetFont('Arial','b',7);
   $pdf->Cell(10,3,"Generated: " . date($owl_lang->localized_date_format));
   $pdf->Ln();

// Display the Filter Parms

   $iCountLines = 0;

   if ($filteraction)
   {
      $pdf->Cell(10,3,"Filter: ");
      foreach($filteraction as $fa)
      {
         $pdf->Cell(10,3,$logactions[$fa][1]);
         $iCountLines++;
         if ($iCountLines == 1)
         {
            if (($filtergroup or $filtergroup == "0") and $filtergroup != "-1")
            {
                $sGroupName = " (" . group_to_name($filtergroup) . ")";
            }
            else
            {
                $sGroupName = " (" . $owl_lang->log_filter_all . ")";
            }

            if ($filteruser and $filteruser != "0")
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "User: " . uid_to_name($filteruser) . $sGroupName);
            }
            else
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "User: " . $owl_lang->log_filter_all . $sGroupName);
            }
            if ($filter_from)
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "From Date: " . date($owl_lang->localized_date_format, strtotime($filter_from)));
            }
         }

         if ($iCountLines == 2)
         {

            if ($filter_file)
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "File: " . $filter_file);
               $pdf->Cell(20,3, "");
            }
            else
            {
               $pdf->Cell(60,3, "");
            }
            if ($filter_to)
            {
               $pdf->Cell(20,3, "     To Date: " . date($owl_lang->localized_date_format, strtotime($filter_to)));
            }

         }
         $pdf->Ln();
         $pdf->Cell(10,3,"        ");
      }

      if ($iCountLines < 2)
      {
            if ($filter_file)
            {
               $pdf->Cell(30,3, "");
               $pdf->Cell(20,3, "File: " . $filter_file);
               $pdf->Cell(20,3, "");
            }
            else
            {
               $pdf->Cell(70,3, "");
            }
            if ($filter_to)
            {
               $pdf->Cell(20,3, "     To Date: " . date($owl_lang->localized_date_format, strtotime($filter_to)));
            }
      }
   }
   else
   {
      $pdf->Cell(10,4,"Filter: " . $logactions[0][1]);
            if (($filtergroup or $filtergroup == "0") and $filtergroup != "-1")
            {
                $sGroupName = " (" . group_to_name($filtergroup) . ")";
            }
            else
            {
                $sGroupName = " (" . $owl_lang->log_filter_all . ")";
            }

            if ($filteruser and $filteruser != "0")
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "User: " . uid_to_name($filteruser) . $sGroupName);
            }
            else
            {
               $pdf->Cell(20,3, "");
               $pdf->Cell(20,3, "User: " . $owl_lang->log_filter_all . $sGroupName);
            }

            if ($filter_from)
            {
               $pdf->Cell(20,3, "From Date: " . date($owl_lang->localized_date_format, strtotime($filter_from)));
            }

         $pdf->Ln();
            
            if ($filter_file)
            {
               $pdf->Cell(30,3, "");
               $pdf->Cell(20,3, "File: " . $filter_file);
               $pdf->Cell(20,3, "");
            }
            else
            {
               $pdf->Cell(70,3, "");
            }
            if ($filter_to)
            {
               $pdf->Cell(20,3, "     To Date: " . date($owl_lang->localized_date_format, strtotime($filter_to)));
            }
   }
   $pdf->Ln();
   $pdf->Ln();


// Print Column Headings

   $pdf->SetFont('Arial','b',9);
   $pdf->Cell(30,5,$owl_lang->owl_log_hd_action);
   $pdf->Cell(40,5,$owl_lang->owl_log_hd_file);
   $pdf->Cell(20,5,"File Size");
   $pdf->Cell(40,5,$owl_lang->owl_log_hd_fld_path);
   $pdf->Cell(20,5,$owl_lang->owl_log_hd_user);
   $pdf->Cell(30,5,$owl_lang->owl_log_hd_dt_tm);
   $pdf->Cell(35,5,$owl_lang->owl_log_hd_ip);
   if ($hideagent == 0 and $hidedetail == 0)
   { 
      $pdf->Cell(40,5,$owl_lang->owl_log_hd_agent . " / " . $owl_lang->owl_log_hd_dtls);
   }
   else
   {
      if ($hideagent == 0)
      {
         $pdf->Cell(40,5,$owl_lang->owl_log_hd_agent);
      }
      if ($hidedetail == 0)
      {
         $pdf->Cell(40,5,$owl_lang->owl_log_hd_dtls);
      }
   }
   $pdf->Ln();
   
   $pdf->SetFont('Arial','',7);

   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_log_table left outer join $default->owl_users_table  u on u.id=userid $whereclause ORDER BY logdate DESC");
   while ($sql->next_record())
   {
      $pdf->SetTextColor(0,128,0);
      $pdf->Cell(30,3,"<" . $log_file_actions[$sql->f("action")] . ">");
      $pdf->SetTextColor(0,0,0);
      if ($sql->f("type") != "LOGIN")
      {
         $pdf->Cell(40,3, $sql->f("filename"));
         if ($sql->f("filesize") > 0)
         {
            $pdf->Cell(20,3, gen_filesize($sql->f("filesize")));
         }
         else
         {
            $pdf->Cell(20,3, "");
         }

         $sPath = get_dirpath($sql->f("parent"));
         if (strlen(trim($sPath)) > 30)
         {
            $sPath = substr($sPath, 1,8) . " ... " . substr($sPath, -18);
         }
         $pdf->Cell(40,3, $sPath);
      }
      else
      {
         $pdf->Cell(40,3,"");
         $pdf->Cell(20,3, "");
         $pdf->Cell(40,3,"");
      }
      $pdf->Cell(20,3, uid_to_name($sql->f("userid")));
      $pdf->Cell(30,3, date($owl_lang->localized_date_format, strtotime($sql->f("logdate"))));
      if (Net_CheckIP::check_ip($sql->f('ip')))
      {
         $pdf->Cell(35,3, fGetHostByAddress($sql->f('ip')));
      }
      else
      {
         $pdf->Cell(35,3, $sql->f('ip'));
      }
      if ($hideagent == 0 and $hidedetail == 0)
      { 
         $pdf->Cell(40,3, $sql->f("agent"));
         $pdf->Ln();
         $pdf->Cell(215,3,"");
         $pdf->Cell(40,3, $sql->f("details"));
      }
      else
      {
         if ($hideagent == 0)
         {
            $pdf->Cell(40,3, $sql->f("agent"));
         }
         if ($hidedetail == 0)
         {
            $pdf->Cell(40,3, $sql->f("details"));
         }
      }

         $pdf->Cell(40,3,"");
      $pdf->Ln();
   }

   $pdf->Ln();
   $pdf->Output($sFirstPart . ".pdf", 'D');

}



if ($action == "clear_log")
{
   $sql = new Owl_DB;
   $sql->query("DELETE from $default->owl_log_table");
} 

include_once($default->owl_fs_root . "/lib/header.inc");
include_once($default->owl_fs_root . "/lib/userheader.inc");

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
      fPrintPrefsXTPL('Top');
}

if (fIsAdmin(true))
{
   fPrintAdminPanelXTPL("viewlog");
}

$xtpl->assign('SYSLOG_HEADING', $owl_lang->owl_log_viewer);

$xtpl->assign('SYSLOG_TITLE_ACTION', $owl_lang->owl_log_hd_action);
$xtpl->assign('SYSLOG_TITLE_FILE', $owl_lang->owl_log_hd_file);
$xtpl->assign('SYSLOG_TITLE_FILE_SIZE', $owl_lang->owl_log_hd_file_size);
$xtpl->assign('SYSLOG_TITLE_FLD_PATH', $owl_lang->owl_log_hd_fld_path);
$xtpl->assign('SYSLOG_TITLE_USER', $owl_lang->owl_log_hd_user);
$xtpl->assign('SYSLOG_TITLE_DT_TM', $owl_lang->owl_log_hd_dt_tm);
$xtpl->assign('SYSLOG_TITLE_IP', $owl_lang->owl_log_hd_ip);

if ($hideagent == 0)
{
   $xtpl->assign('SYSLOG_TITLE_AGENT', $owl_lang->owl_log_hd_agent);
   $xtpl->parse('main.SysLogs.TlAgent');
}
if ($hidedetail == 0)
{
   $xtpl->assign('SYSLOG_TITLE_DETAILS', $owl_lang->owl_log_hd_dtls);
   $xtpl->parse('main.SysLogs.TlDetails');
}

$CountLines = 0;
$sql = new Owl_DB;
$getusers = new Owl_DB; 
$groups = fGetGroups($userid);
$groups[-1][0] = "-1";
$groups[-1][1] = "ALL";

$xtpl->assign('SYSLOG_STATUS_MSG', $owl_lang->owl_log_filter);

// Found out how many records we are going to retreive
$sql->query("SELECT * FROM $default->owl_log_table left outer join $default->owl_users_table  u on u.id=userid $whereclause LIMIT $default->max_syslog_reported_rows");
$recordcount = $sql->num_rows($sql); 

// Retreive the log records for display
if ($recordcount == 0)
{
   $xtpl->assign('SYSLOG_STATUS_MSG', $owl_lang->owl_log_no_rec);
} 
else
{
   if ($recordcount == $default->max_syslog_reported_rows)
   {
      $xtpl->assign('SYSLOG_STATUS_MSG', "<h2>Maximum Number of Rows selected ($default->max_syslog_reported_rows) Refine your search</h2>");
   }

   $sql->query("SELECT * FROM $default->owl_log_table left outer join $default->owl_users_table  u on u.id=userid $whereclause ORDER BY logdate DESC LIMIT $nextrecord,$default->log_rec_per_page");
   while ($sql->next_record())
   {
      $CountLines++;
      $PrintLines = $CountLines % 2;
      if ($PrintLines == 0)
      {
         $sTrClass = "file1";
      }
      else
      {
         $sTrClass = "file2";
      }     
      $xtpl->assign('SYSLOG_TD_CLASS', $sTrClass);
      $xtpl->assign('SYSLOG_ACTION', $log_file_actions[$sql->f("action")]);

      if ($sql->f("type") != "LOGIN")
      {
         $xtpl->assign('SYSLOG_FILE', $sql->f("filename"));
         if ($sql->f("filesize") > 0)
         {
            $xtpl->assign('SYSLOG_FILE_SIZE', gen_filesize($sql->f("filesize")));
         }
         else
         {
            $xtpl->assign('SYSLOG_FILE_SIZE', '&nbsp;');
         }
         $xtpl->assign('SYSLOG_FLD_PATH', get_dirpath($sql->f("parent")));
      } 
      else
      {
        $xtpl->assign('SYSLOG_FILE', '&nbsp;');
        $xtpl->assign('SYSLOG_FILE_SIZE', '&nbsp;');
        $xtpl->assign('SYSLOG_FLD_PATH', '&nbsp;');
      } 

      $xtpl->assign('SYSLOG_USER', uid_to_name($sql->f("userid")) );
      $xtpl->assign('SYSLOG_DT_TM', date($owl_lang->localized_date_format, strtotime($sql->f("logdate"))));
      if (Net_CheckIP::check_ip($sql->f('ip')))
      {
         $xtpl->assign('SYSLOG_IP', fGetHostByAddress($sql->f('ip')));
      }
      else
      {
         $xtpl->assign('SYSLOG_IP', $sql->f('ip'));
      }
      $xtpl->assign('SYSLOG_AGENT', '');
      $xtpl->assign('SYSLOG_DETAILS', '');
      if ($hideagent == 0)
      {
         $xtpl->assign('SYSLOG_AGENT', $sql->f('agent'));
         $xtpl->parse('main.SysLogs.Row.TtAgent');
      }
      if ($hidedetail == 0)
      {
         $xtpl->assign('SYSLOG_DETAILS', $sql->f('details'));
         $xtpl->parse('main.SysLogs.Row.TtDetails');
      }
      $xtpl->parse('main.SysLogs.Row');
   } 
} 
// print out the filters
$logactions[0][1] = "$owl_lang->log_filter_all";
$logactions[1][1] = $log_file_actions[LOGIN];
$logactions[2][1] = $log_file_actions[LOGIN_FAILED];
$logactions[3][1] = $log_file_actions[LOGOUT];
$logactions[4][1] = $log_file_actions[FILE_DELETED];
$logactions[5][1] = $log_file_actions[FILE_UPLOAD];
$logactions[6][1] = $log_file_actions[FILE_UPDATED];
$logactions[7][1] = $log_file_actions[FILE_DOWNLOADED];
$logactions[8][1] = $log_file_actions[FILE_CHANGED];
$logactions[9][1] = $log_file_actions[FILE_LOCKED];
$logactions[10][1] = $log_file_actions[FILE_UNLOCKED];
$logactions[11][1] = $log_file_actions[FILE_EMAILED];
$logactions[12][1] = $log_file_actions[FILE_MOVED];
$logactions[19][1] = $log_file_actions[FILE_VIEWED];
$logactions[20][1] = $log_file_actions[FILE_VIRUS];
$logactions[21][1] = $log_file_actions[FILE_COPIED];
$logactions[23][1] = $log_file_actions[FILE_LINKED];
$logactions[26][1] = $log_file_actions[FILE_ACL];
$logactions[13][1] = $log_file_actions[FOLDER_CREATED];
$logactions[14][1] = $log_file_actions[FOLDER_DELETED];
$logactions[15][1] = $log_file_actions[FOLDER_MODIFIED];
$logactions[16][1] = $log_file_actions[FOLDER_MOVED];
$logactions[22][1] = $log_file_actions[FOLDER_COPIED];
$logactions[27][1] = $log_file_actions[FOLDER_ACL];
$logactions[28][1] = $log_file_actions[FOLDER_DISTRIBUTE];
$logactions[29][1] = $log_file_actions[FOLDER_LINKED];
$logactions[17][1] = $log_file_actions[FORGOT_PASS];
$logactions[18][1] = $log_file_actions[USER_REG];
$logactions[24][1] = $log_file_actions[USER_ADMIN];
$logactions[25][1] = $log_file_actions[TRASH_CAN];
$logactions[30][1] = $log_file_actions[FILE_REVIEW];
$logactions[31][1] = $log_file_actions[FILE_APPROVED];
$logactions[32][1] = $log_file_actions[FILE_REJECTED];
$logactions[33][1] = $log_file_actions[FILE_PUBLISHED];


$xtpl->assign('FORM', '<form enctype="multipart/form-data" action="log.php" method="post">');
$urlArgs['sess']      = $sess;
$urlArgs['action']      = 'refresh';
//$urlArgs['id']      = $id;
$urlArgs['whereclause']      = $whereclause;
$urlArgs['expand']      = $expand;
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));

$xtpl->assign('SYSLOG_ACTION_LABEL', $owl_lang->owl_log_hd_action);
foreach($logactions as $key => $fp)
{
   $isSelected = false;
   if ($filteraction[0] != "")
   {
      foreach($filteraction as $fa)
      {
         if ($fa == $key)
         {
            $isSelected = true;
         }
      } 
   } 
   $xtpl->assign('SYSLOG_ACTION_VALUE', $key);
   $xtpl->assign('SYSLOG_ACTION_CAPTION', $fp[1]);
   $xtpl->assign('SYSLOG_ACTION_SELECTED', '');
   if ($isSelected)
   {
      $xtpl->assign('SYSLOG_ACTION_SELECTED', ' selected="selected"');
   }
   $xtpl->parse('main.SysLogs.FilterAction');
} 
// Print Users
$getusers->query("select name,username,id from $default->owl_users_table order by name");

$xtpl->assign('SYSLOG_USER_LABEL', $owl_lang->owl_log_hd_user);

$xtpl->assign('SYSLOG_USER_SELECTED', '');
$xtpl->assign('SYSLOG_USER_VALUE', '0');
$xtpl->assign('SYSLOG_USER_CAPTION', $owl_lang->log_filter_all);

$xtpl->parse('main.SysLogs.FilterUser');

while ($getusers->next_record())
{
   $uid = $getusers->f("id");
   $name = $getusers->f("name");
   $username = $getusers->f("username");

   $xtpl->assign('SYSLOG_USER_SELECTED', '');

   if ($name == "")
   {
      $xtpl->assign('SYSLOG_USER_VALUE', $uid);
      $xtpl->assign('SYSLOG_USER_CAPTION', $username);
   }
   else
   {
      if ($uid == $filteruser)
      {
         $xtpl->assign('SYSLOG_USER_SELECTED', 'selected="selected"');
      }
      $xtpl->assign('SYSLOG_USER_VALUE', $uid);
      $xtpl->assign('SYSLOG_USER_CAPTION', $name);
   }
   $xtpl->parse('main.SysLogs.FilterUser');
} 


$xtpl->assign('SYSLOG_GROUP_LABEL', $owl_lang->group);
foreach($groups as $g)
{
   $xtpl->assign('SYSLOG_GROUP_VALUE', $g[0]);
   $xtpl->assign('SYSLOG_GROUP_CAPTION', $g[1]);
   $xtpl->assign('SYSLOG_GROUP_SELECTED', '');
   if ($g[0] == $filtergroup)
   {
      $xtpl->assign('SYSLOG_GROUP_SELECTED', " selected=\"selected\"");
   }
   $xtpl->parse('main.SysLogs.FilterGroup');
}


$xtpl->assign('SYSLOG_FILENAME_LABEL', $owl_lang->syslog_filename);
$xtpl->assign('SYSLOG_FILENAME_VALUE', $filter_file);

$xtpl->assign('SYSLOG_DATEFROM_LABEL', $owl_lang->syslog_date_from);
$xtpl->assign('SYSLOG_DATEFROM_VALUE', $filter_from);

$xtpl->assign('SYSLOG_DATETO_LABEL', $owl_lang->syslog_date_to);
$xtpl->assign('SYSLOG_DATETO_VALUE', $filter_to);

$xtpl->assign('SYSLOG_IPHOST_LABEL', $owl_lang->syslog_ip_host);
$xtpl->assign('SYSLOG_IPHOST_VALUE', $ip_hostname);

$xtpl->assign('SYSLOG_HIDEAGENT_LABEL', $owl_lang->owl_log_hide . "&nbsp;" .$owl_lang->owl_log_hd_agent);
$xtpl->assign('SYSLOG_HIDEAGENT_SELECTED', '');

if ($hideagent == 1)
{
   $xtpl->assign('SYSLOG_HIDEAGENT_SELECTED', ' checked="checked"');
}

$xtpl->assign('SYSLOG_HIDEDETAILS_LABEL', $owl_lang->owl_log_hide . "&nbsp;" .$owl_lang->owl_log_hd_dtls);
$xtpl->assign('SYSLOG_HIDEDETAILS_SELECTED', '');

if ($hidedetail == 1)
{
   $xtpl->assign('SYSLOG_HIDEDETAILS_SELECTED', ' checked="checked"');
}

$fa = urlencode(serialize($filteraction));

$xtpl->assign('SYSLOG_FILTERBTN_LABEL', $owl_lang->owl_log_filter);
$xtpl->assign('SYSLOG_FILTERBTN_ALT', $owl_lang->alt_refresh_filter);

$urlArgs2 = array();
$urlArgs2['sess']        = $sess;
$urlArgs2['action']      = 'gen_pdf';
$urlArgs2['next']        = '0';
$urlArgs2['nextrecord']  = '0';
$urlArgs2['fa']          = $fa;
$urlArgs2['filter_to']   = $filter_to;
$urlArgs2['filter_from'] = $filter_from;
$urlArgs2['ip_hostname'] = $ip_hostname;
$urlArgs2['filter_file'] = $filter_file;
$urlArgs2['filteruser']  = $filteruser;
$urlArgs2['filtergroup'] = $filtergroup;
$urlArgs2['hideagent']   = $hideagent;
$urlArgs2['hidedetail']  = $hidedetail;

$xtpl->assign('SYSLOG_GENPDF_URL', fGetURL ('admin/log.php', $urlArgs2));
$xtpl->assign('SYSLOG_GENPDF_LABEL', $owl_lang->btn_gen_pdf);
$xtpl->assign('SYSLOG_GENPDF_ALT', $owl_lang->alt_gen_pdf);

$urlArgs2['action']      = 'gen_csv';

$xtpl->assign('SYSLOG_GENCSV_URL', fGetURL ('admin/log.php', $urlArgs2));
$xtpl->assign('SYSLOG_GENCSV_LABEL', $owl_lang->btn_gen_csv);
$xtpl->assign('SYSLOG_GENCSV_ALT', $owl_lang->alt_gen_csv);

// print Footer with Record Count and PREV TOP NEXT

$urlArgs2['action']      = '';
$urlArgs2['prev']        = '1';
$urlArgs2['nextrecord']  = $nextrecord;

$xtpl->assign('SYSLOG_PREVRECS_URL', fGetURL ('admin/log.php', $urlArgs2));
$xtpl->assign('SYSLOG_PREVRECS_ALT', $owl_lang->alt_log_prev);

$urlArgs2['prev']        = '';
$urlArgs2['next']        = '0';
$urlArgs2['nextrecord']  = '0';

$xtpl->assign('SYSLOG_TOPRECS_URL', fGetURL ('admin/log.php', $urlArgs2));
$xtpl->assign('SYSLOG_TOPRECS_ALT', $owl_lang->alt_log_top);

$from = $nextrecord + 1;
if ($recordcount == 0)
{
   $from = $recordcount;
}
$to = $nextrecord + $default->log_rec_per_page;

if ($to > $recordcount)
{
   $to = $recordcount;
}

$urlArgs2['prev']        = '';
$urlArgs2['next']        = '1';
$urlArgs2['nextrecord']  = $nextrecord;

if ($to < $recordcount)
{
   $xtpl->assign('SYSLOG_NEXTRECS_URL', fGetURL ('admin/log.php', $urlArgs2));
   $xtpl->assign('SYSLOG_NEXTRECS_ALT', $owl_lang->alt_log_next);
   $xtpl->parse('main.SysLogs.NextRecs');
} 
else
{
   $xtpl->parse('main.SysLogs.NoMoreRecs');
} 

$urlArgs2 = array();
$urlArgs2['sess']        = $sess;
$urlArgs2['action']      = 'clear_log';

$xtpl->assign('SYSLOG_CLEARLOG_URL', fGetURL ('admin/log.php', $urlArgs2));
$xtpl->assign('SYSLOG_CLEARLOG_CONFIRM', $owl_lang->reallydelete_logs);
$xtpl->assign('SYSLOG_CLEARLOG_ALT', $owl_lang->alt_log_clear);


$xtpl->assign('SYSLOG_RECORD_STATUS', "($from $owl_lang->log_admin_to $to) $owl_lang->log_admin_of $recordcount");

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.SysLogs');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
