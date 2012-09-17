<?php
/**
 * file_activity.php
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
 * $Id: file_activity.php,v 1.2 2006/01/04 20:57:50 b0zz Exp $
 */


$CountLines = 0;
$sql = new Owl_DB;
$sql->query("SELECT creatorid, sum(f_size) as total_size , count(id) as num_files from $default->owl_files_table group by creatorid order by num_files desc");

$xtpl->assign('REPORT_TITLE_USERNAME', $owl_lang->username);
$xtpl->assign('REPORT_TITLE_TOTAL', $owl_lang->tot_files);
//print("<tr>\n");
//print("<td class='title1' colspan='3'>$owl_lang->username</td>\n");
//print("<td class='title1'>$owl_lang->tot_files</td>");
//print("</tr>\n");

//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");

// 
// User File Stats BEGIN
// 
$xtpl->assign('REPORT_FILES_TITLE', $owl_lang->stats_files);
//print("<td class='admin2' align='left' colspan='4'>$owl_lang->stats_files</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");

$iGrandFileTotal = 0;
$iGrandSizeTotal = 0;
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

   $xtpl->assign('REPORT_TD_CLASS', $sTrClass);

   $xtpl->assign('REPORT_FILES_USERNAME', uid_to_name($sql->f("creatorid")));
   $xtpl->assign('REPORT_FILES_COUNT', $sql->f("num_files"));
   $xtpl->assign('REPORT_FILES_SIZE', gen_filesize($sql->f("total_size")));
      
   //print("\t\t\t\t<tr>\n");

   //print("<td class='$sTrClass' colspan='2'>" . uid_to_name($sql->f("creatorid")) . "</td>\n");
   //print("<td class='$sTrClass'>" . $sql->f("num_files") . "</td>\n");
   $iGrandFileTotal = $iGrandFileTotal + $sql->f("num_files");
   //print("<td class='$sTrClass'>" . gen_filesize($sql->f("total_size")) . "</td>\n");
   $iGrandSizeTotal = $iGrandSizeTotal + $sql->f("total_size");
   //print("</tr>\n");
   $xtpl->parse('main.Stats.Report'.$execreport.'.Files');
} 
$xtpl->assign('REPORT_FILES_GT_LABEL', $owl_lang->tot_files);
$xtpl->assign('REPORT_FILES_GT_COUNT', $iGrandFileTotal);
$xtpl->assign('REPORT_FILES_GT_SIZE', gen_filesize($iGrandSizeTotal));
//print("<tr>\n");
//print("<td class='title1' colspan='2'>$owl_lang->tot_files</td>\n");
//print("<td class='title1'>$iGrandFileTotal</td>\n");
//print("<td class='title1'>" . gen_filesize($iGrandSizeTotal) . "</td>\n");
//print("</tr>\n");
// 
// User File Stats END
// 
// 
// User Folder Stats BEGIN
// 
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
$xtpl->assign('REPORT_FOLDERS_TITLE', $owl_lang->stats_folders);
//print("<td class='admin2' align='left' colspan='4'>$owl_lang->stats_folders</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");

$sql->query("SELECT creatorid , count(*) as num_folders from $default->owl_folders_table group by creatorid order by num_folders desc");

$iGrandFolderTotal = 0;
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
   $xtpl->assign('REPORT_TD_CLASS', $sTrClass);
      
   $xtpl->assign('REPORT_FOLDERS_USERNAME', uid_to_name($sql->f("creatorid")));
   $xtpl->assign('REPORT_FOLDERS_COUNT', $sql->f("num_folders"));
   //print("\t\t\t\t<tr>\n");
   //print("<td class='$sTrClass' colspan='3'>" . uid_to_name($sql->f("creatorid")) . "</td>\n");
   //print("<td class='$sTrClass'>" . $sql->f("num_folders") . "</td>\n");
   $iGrandFolderTotal = $iGrandFolderTotal + $sql->f("num_folders");
   $xtpl->parse('main.Stats.Report'.$execreport.'.Folders');
   //print("</tr>\n");
} 
$xtpl->assign('REPORT_FOLDERS_GT_LABEL', $owl_lang->tot_files);
$xtpl->assign('REPORT_FOLDERS_GT_COUNT', $iGrandFoldersotal);
//print("<tr>\n");
//print("<td class='title1' colspan='3'>$owl_lang->tot_files</td>\n");
//print("<td class='title1'>$iGrandFolderTotal</td>\n");
//print("</tr>\n");
// 
// User Folder Stats END
// 
if ($default->logging and $default->log_file)
{ 
   // 
   // User Logon Stats BEGIN
   // 
   $xtpl->assign('REPORT_SYSLOG_TITLE', $owl_lang->stats_users);
   //print("<tr>\n");
   //print("<td align='left' colspan='3'>&nbsp;</td>\n");
   //print("<td align='left'>&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td  class='admin2' colspan='4'>$owl_lang->stats_users</td>\n");
   //print("<td align='left'>&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td align='left' colspan='3'>&nbsp;</td>\n");
   //print("<td align='left'>&nbsp;</td>\n");
   //print("</tr>\n");

   $sql->query("select count(*) as num_action, userid, action  from $default->owl_log_table where type='LOGIN' group by userid, action");

   $iGrandLoginTotal = 0;
   $iGrandLogoutTotal = 0;
   $iGrandFailedTotal = 0;
   $SaveUser = -1;
   $iLoginTotal = 0;
   $iLogoutTotal = 0;
   $iFailedTotal = 0;

   while ($sql->next_record())
   {
      if ($SaveUser <> $sql->f("userid"))
      {
         if ($SaveUser <> -1)
         {
            $xtpl->assign('REPORT_SYSLOG_COUNTS', "($iLoginTotal / $iFailedTotal / $iLogoutTotal )");
            $xtpl->parse('main.Stats.Report'.$execreport.'.Syslog.Users');
            //print("($iLoginTotal / $iFailedTotal / $iLogoutTotal )");
            //print("</td>\n");
            //print("</tr>\n");
            $iGrandLoginTotal = $iGrandLoginTotal + $iLoginTotal;
            $iGrandLogoutTotal = $iGrandLogoutTotal + $iLogoutTotal;
            $iGrandFailedTotal = $iGrandFailedTotal + $iFailedTotal;
            $iLoginTotal = 0;
            $iLogoutTotal = 0;
            $iFailedTotal = 0;
         } 
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
         $xtpl->assign('REPORT_TD_CLASS', $sTrClass);
            
         $xtpl->assign('REPORT_SYSLOG_USERNAME', uid_to_name($sql->f("userid")));
         //print("\t\t\t\t<tr>\n");
         //print("<td class='$sTrClass' colspan='3'>" . uid_to_name($sql->f("userid")) . "</td>\n");
         //print("<td class='$sTrClass'>");
      } 

      switch ($sql->f("action"))
      {
         case LOGIN:
            $iLoginTotal = $sql->f("num_action");
            break;
         case LOGIN_FAILED:
            $iFailedTotal = $sql->f("num_action");
            break;
         case LOGOUT:
            $iLogoutTotal = $sql->f("num_action");
            break;
      } 
      $SaveUser = $sql->f("userid");
   } 

   $xtpl->assign('REPORT_SYSLOG_COUNTS', "($iLoginTotal / $iFailedTotal / $iLogoutTotal )");
   $xtpl->parse('main.Stats.Report'.$execreport.'.Syslog.Users');

   $iGrandLoginTotal = $iGrandLoginTotal + $iLoginTotal;
   $iGrandLogoutTotal = $iGrandLogoutTotal + $iLogoutTotal;
   $iGrandFailedTotal = $iGrandFailedTotal + $iFailedTotal;

   //print("($iLoginTotal / $iFailedTotal / $iLogoutTotal )");
   //print("</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td class='title1' colspan='3'>$owl_lang->tot_files</td>\n");
   //print("<td class='title1'>($iGrandLoginTotal / $iGrandFailedTotal / $iGrandLogoutTotal)</td>\n");
   //print("</tr>\n"); 
   $xtpl->assign('REPORT_SYSLOG_GT_TITLE', $owl_lang->tot_files);
   $xtpl->assign('REPORT_SYSLOG_GT_COUNTS', "($iGrandLoginTotal / $iGrandFailedTotal / $iGrandLogoutTotal)");
   $xtpl->parse('main.Stats.Report'.$execreport.'.Syslog');
   // 
   // User Logon Stats END
   // 
} 
// 
// Currently Logged In BEGIN
// 
$xtpl->assign('REPORT_LOGGEDIN_TITLE', $owl_lang->stats_users_loggedin);
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
//print("<td  class='admin2' align='left' colspan='4'>$owl_lang->stats_users_loggedin</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");

$sql->query("select usid, lastused, ip  from $default->owl_sessions_table order by usid");

$iGrandUserTotal = 0;
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
   $xtpl->assign('REPORT_TD_CLASS', $sTrClass);
            
   //print("\t\t\t\t<tr>\n");
   //print("<td class='$sTrClass'>" . uid_to_name($sql->f("usid")) . "</td>\n");

   $xtpl->assign('REPORT_LOGGEDIN_USERNAME', uid_to_name($sql->f("usid")));

   $time = time();
   $xtpl->assign('REPORT_LOGGEDIN_SESSION', 'SESSION EXPIRED');
   if (($time - $sql->f("lastused")) <= $default->owl_timeout)
   {
      $xtpl->assign('REPORT_LOGGEDIN_SESSION', 'SESSION ACTIVE');
      //print("<td class='$sTrClass'>SESSION ACTIVE</td>\n");
   } 
   //else
   //{
      //print("<td class='$sTrClass'>SESSION EXPIRED</td>\n");
   //} 
   $xtpl->assign('REPORT_LOGGEDIN_IP', $sql->f("ip"));
   //print("<td class='$sTrClass'>" . $sql->f("ip") . "</td>\n");
   $xtpl->assign('REPORT_LOGGEDIN_HOST', $sql->f("ip"));
   if (Net_CheckIP::check_ip($sql->f('ip')))
   {
      $xtpl->assign('REPORT_LOGGEDIN_HOST', fGetHostByAddress($sql->f('ip')));
      //print("<td class='$sTrClass'>" . fGetHostByAddress($sql->f('ip')) . "</td>\n");
   }
   //else
   //{
      //print("<td class='$sTrClass'>" . $sql->f('ip') . "</td>\n");
   //}

   $iGrandUserTotal = $iGrandUserTotal + 1;
//   print("</tr>\n");
   $xtpl->parse('main.Stats.Report'.$execreport.'.LoggedinUsers');
} 

$xtpl->assign('REPORT_LOGGEDIN_GT_TITLE', $owl_lang->tot_files);
$xtpl->assign('REPORT_LOGGEDIN_GT_TOTAL', $iGrandUserTotal);

//print("<tr>\n");
//print("<td class='title1' colspan='3'>$owl_lang->tot_files</td>\n");
//print("<td class='title1'>$iGrandUserTotal</td>\n");
//print("</tr>\n");
// 
// User Folder Stats END
// 

$xtpl->assign('REPORT_TOP_DNLD_FILE_TITLE', $owl_lang->file);
$xtpl->assign('REPORT_TOP_DNLD_TOTAL_TITLE', $owl_lang->tot_files);
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>");
//print("<td class='title1' colspan='3'>$owl_lang->file</td>");
//print("<td class='title1'>$owl_lang->tot_files</td>");
//print("</tr>");
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");
$xtpl->assign('REPORT_TOP_DNLD_TITLE', $owl_lang->stats_top);

//print("<tr>\n");
//print("<td class='title1' colspan='3'>$owl_lang->stats_top</td>\n");
//print("<td class='title1'>&nbsp;</td>\n");
//print("</tr>\n");
//print("<tr>\n");
//print("<td align='left' colspan='3'>&nbsp;</td>\n");
//print("<td align='left'>&nbsp;</td>\n");
//print("</tr>\n");

if ($default->logging && $default->log_file)
{
   $sGetAction = FILE_DOWNLOADED;
   $sql->query("select action, parent, filename, count(filename) as download_count from $default->owl_log_table where action = '$sGetAction' group by filename, action, parent order by download_count desc");

   $iTopCount = 0;
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
      $xtpl->assign('REPORT_TD_CLASS', $sTrClass);
      
      $xtpl->assign('REPORT_TOP_DNLD_FILE', $sql->f("filename"));
      $xtpl->assign('REPORT_TOP_DNLD_COUNT', $sql->f("download_count"));
      //print("\t\t\t\t<tr>\n");
      //print("<td class='$sTrClass' colspan='3'>" . $sql->f("filename") . "</td>\n");
      //print("<td class='$sTrClass'>" . $sql->f("download_count") . "</td>\n");
      //print("</tr>\n");
      $xtpl->parse('main.Stats.Report'.$execreport.'.TopFile');
      $iTopCount++;

      if ($iTopCount > 20)
      {
         break; 
      }
   } 
} 
else
{
   //print("<tr>\n");
   //print("<td class='$sTrClass' colspan='3'>$owl_lang->stats_information</td>\n");
   //print("<td class='$sTrClass'>&nbsp;</td>\n");
   //print("</tr>\n");
   $xtpl->assign('REPORT_TOP_DNLD_FILE', $owl_lang->stats_information);
   $xtpl->assign('REPORT_TOP_DNLD_COUNT', '&nbsp;');
   $xtpl->parse('main.Stats.Report'.$execreport.'.TopFile');
} 

?>
