<?php
/**
 * user_special_access.php
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

$CountLines = 0;
$mainsql = new Owl_DB;
$sqlfile = new Owl_DB;
$qSubQuery = new Owl_DB;
$filter = $_POST['filter'];

if (is_numeric($filter))
{
  $sSubQuery = " where id = '$filter'";
}
else
{
  $sSubQuery = " where username like '%" . $sql->make_arg_safe($filter) . "%' or name like '%" . $sql->make_arg_safe($filter) . "%'";
}

//if (empty($filter))
//{
  //$sSubQuery = " where '1' = '0'"
//}


$mainsql->query("SELECT * from $default->owl_users_table $sSubQuery  ORDER BY name");

   $xtpl->assign('REPORT_FILTER_LABEL', $owl_lang->report_filter);
   $xtpl->assign('REPORT_FILTER_VALUE', ereg_replace("'", "",$filter));

   $xtpl->assign('REPORT_BTN_SUBMIT_LABEL', $owl_lang->btn_submit);
   $xtpl->assign('REPORT_BTN_SUBMIT_ALT', $owl_lang->btn_submit_alt);


   //print("<tr>\n");
   //print("<td class=\"form1\">$owl_lang->report_filter</td>\n");
   //print("<td colspan=\"2\" class=\"form1\" width=\"100%\">");
   //print("<input type=\"text\" name=\"filter\" value=\"" . ereg_replace("'", "",$filter) ."\"></input>");
   //fPrintSubmitButton($owl_lang->btn_submit, "Submit");
   //print("</td>");
   //print("</tr>\n");
   
   //print("<tr>\n");
   //print("<td align=\"left\" colspan=\"2\">&nbsp;</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   
   $xtpl->assign('REPORT_TITLE', 'Users Special Access Folders / Files');
   //print("<td class=\"admin2\" align=\"left\" colspan=\"3\">Users Special Access Folders / Files</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td align=\"left\" colspan=\"19\">&nbsp;</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
//   print("<tr>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->name</td>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->username</td>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->report_file_folder</td>\n");
   //print("</tr>\n");

   $xtpl->assign('REPORT_NAME_TITLE', $owl_lang->name);
   $xtpl->assign('REPORT_USERNAME_TITLE', $owl_lang->username);
   $xtpl->assign('REPORT_FILEFOLDER_TITLE', $owl_lang->report_file_folder);



$CurrentGroup = $usergroupid;
$CurrentUser = $userid;

$CountLines =  0;

while ($mainsql->next_record())
{
   $bFileAdminCache = NULL;
   $bAdminCache = NULL;
   $groups = array();

   $userid = $mainsql->f('id');
   $usergroupid = $mainsql->f('groupid');
   $username = $mainsql->f('username');
   $name = $mainsql->f('name');


   $groups = fGetGroups($mainsql->f('id'));
   $qQuery = '';

   //foreach ($groups as $aGroups)
   //{
     //$qQuery .= " OR a.group_id ='" .$aGroups["0"] . "'";
   //}

   // *************************************
   // PROCESS SPECIAL ACCESS FOLDERS
   // *************************************
   //

      $qQuery = "SELECT distinct id FROM $default->owl_folders_table f, $default->owl_advanced_acl_table a where a.folder_id=id and a.folder_id <> '1' and (a.user_id = '0' or a.user_id = '$userid'";
      foreach ($groups as $aGroups)
      {
        $qQuery .= " or a.group_id ='" .$aGroups["0"] . "'";
      }
      $qQuery .= ")";

      //print("DEBUG: Q: $qQuery <br />");

      $qSqlQuery = "('1'='0' ";
      $glue = "";

      $sqlfile->query($qQuery);


      $aFoldersChecked = NULL;
      $aFoldersParentChecked = NULL;

      while ($sqlfile->next_record())
      {
         $bIsInBrokenTree = false;
         fIsInBrokenTree($sqlfile->f('id'));
         if ($bIsInBrokenTree == false)
         {
            continue;
         }
         $glue = " OR ";
         $qSqlQuery .= $glue . " id ='" . $sqlfile->f('id') . "'";
      }


      $qSqlQuery .= ")";

   $qFolderQuery = "SELECT * FROM $default->owl_folders_table where  $qSqlQuery";
   //print("DEBUG: Q: $qFolderQuery <br />");




    $qSubQuery->query($qFolderQuery);

   $sTrClass = "file1";
   $xtpl->assign('REPORT_TD_STYLE', $sTrClass);

   $bPrinted = false;

   while ($qSubQuery->next_record())
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
      
      $xtpl->assign('REPORT_TD_STYLE', $sTrClass);

      $xtpl->assign('REPORT_NAME_VALUE', $name);
      $xtpl->assign('REPORT_USERNAME_VALUE', $username);
      $xtpl->assign('FILE_ICON', 'folder_closed');
      $xtpl->assign('REPORT_FOLDER_PATH', find_path(owlfolderparent($qSubQuery->f('id'))) . "/" . fid_to_name($qSubQuery->f('id')) );
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row.Icon');
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row');


      //print("<tr>\n");
      //print("<td class=\"$sTrClass\">" . $name . "</td>\n");
      //print("<td class=\"$sTrClass\">" . $username . "</td>\n");
      //print("<td class=\"$sTrClass\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_closed.gif\" border=\"0\" alt=\"\"></img>&nbsp;" . find_path(owlfolderparent($qSubQuery->f('id'))) . "/" . fid_to_name($qSubQuery->f('id')) . "</td>");
      //print("</tr>\n");
      $name = '&nbsp;';
      $username = '&nbsp;';
      $bPrinted = true;
   }
   
   if ($bPrinted == false)
   {
      $xtpl->assign('REPORT_NAME_VALUE', $name);
      $xtpl->assign('REPORT_USERNAME_VALUE', $username);
      $xtpl->assign('REPORT_FOLDER_PATH', 'NO FOLDERS');
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row');
      //print("<tr>\n");
      //print("<td class=\"$sTrClass\">" . $name . "</td>\n");
      //print("<td class=\"$sTrClass\">" . $username . "</td>\n");
      //print("<td class=\"$sTrClass\" height=\"22\">NO FOLDERS</td>");
      //print("</tr>\n");
      $name = '&nbsp;';
      $username = '&nbsp;';
   }

   // *************************************
   // PROCESS SPECIAL ACCESS FILES
   // *************************************
   //


      $glue = "";
      $qQuery = "SELECT distinct id, parent FROM $default->owl_files_table f, $default->owl_advanced_acl_table a where a.file_id = id and (a.user_id = '0' or a.user_id = '$userid'";

      foreach ($groups as $aGroups)
      {
        $qQuery .= " or a.group_id ='" .$aGroups["0"] . "'";
      }
      $qQuery .= ")";

      $qSqlQuery = "('1'='0' ";

      $sqlfile->query($qQuery);

      //print("<BR> $qQuery");

      $aFoldersChecked = NULL;
      $aFoldersParentChecked = NULL;

      while ($sqlfile->next_record())
      {
         $bIsInBrokenTree = false;
         fIsInBrokenTree($sqlfile->f('parent'));
         if ($bIsInBrokenTree == false)
         {
            continue;
         }

         $glue = " OR ";
         $qSqlQuery .= $glue . " id ='" . $sqlfile->f('id') . "'";
      }
      $qSqlQuery .= ")";

      $qFileQuery = "SELECT * FROM $default->owl_files_table where $qSqlQuery";
      //print "<br>SELECT * FROM $default->owl_files_table where $qSqlQuery";



   // *************************************
   // *************************************

   $qSubQuery->query($qFileQuery);


   $bPrinted = false;
   $sTrClass = "file2";
   $xtpl->assign('REPORT_TD_STYLE', $sTrClass);

   while ($qSubQuery->next_record())
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

      $xtpl->assign('REPORT_TD_STYLE', $sTrClass);

      $sFilePath = find_path(owlfileparent($qSubQuery->f('id')));
      if ($sFilePath == '[ ORPHANED ]')
      {
         $sFilePath .= ": file_id => " . $qSubQuery->f('id');
      }
      else
      {
         $sFilePath .=  "/" . flid_to_filename($qSubQuery->f('id'));
      }

      $iRealFileID = fGetPhysicalFileId($qSubQuery->f('id'));

      $choped = split("\.", flid_to_filename($qSubQuery->f('id')));
      $pos = count($choped);
      if ( $pos > 1 )
      {
         $ext = strtolower($choped[$pos-1]);
         if ($iRealFileID == $qSubQuery->f('id'))
         {
            $sDispIcon = $ext;
         }
         else
         {
            $sDispIcon = $ext . "_lnk";
         }
      }
      else
      {
         $sDispIcon = "NoExtension";
      }
      if (
         !file_exists("$default->owl_fs_root/graphics/$default->sButtonStyle/icon_filetype/$sDispIcon.gif") 
         and  !file_exists("$default->owl_fs_root/graphics/$default->sButtonStyle/icon_filetype/$sDispIcon.png") 
         )
         {
            if ($iRealFileID == $qSubQuery->f('id'))
            {
               $sDispIcon = "file";
            }
            else
            {
               $sDispIcon = "file_lnk";
            }
         }


      $xtpl->assign('REPORT_NAME_VALUE', $name);
      $xtpl->assign('REPORT_USERNAME_VALUE', $username);
      $xtpl->assign('FILE_ICON', $sDispIcon);
      $xtpl->assign('REPORT_FOLDER_PATH', $sFilePath);
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row.Icon');
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row');
      
      //print("<tr>\n");
      //print("<td class=\"$sTrClass\">" . $name . "</td>\n");
      //print("<td class=\"$sTrClass\">" . $username . "</td>\n");
      //print("<td class=\"$sTrClass\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/$sDispIcon\" border=\"0\" alt=\"\"></img>&nbsp;" . $sFilePath . "</td>");
      //print("</tr>\n");

      $name = '&nbsp;';
      $username = '&nbsp;';
      $bPrinted = true;
   }
   if ($bPrinted == false)
   {
      $xtpl->assign('REPORT_NAME_VALUE', $name);
      $xtpl->assign('REPORT_USERNAME_VALUE', $username);
      $xtpl->assign('REPORT_FOLDER_PATH', 'NO FILES');
      $xtpl->parse('main.Stats.Report'.$execreport.'.Row');
      //print("<tr>\n");
      //print("<td class=\"$sTrClass\">" . $name . "</td>\n");
      //print("<td class=\"$sTrClass\">" . $username . "</td>\n");
      //print("<td class=\"$sTrClass\" height=\"22\">NO FILES</td>");
      //print("</tr>\n");
      $name = '&nbsp;';
      $username = '&nbsp;';
   }
} 

$usergroupid = $CurrentGroup;
$userid = $CurrentUser;

// 
// User File Stats END
?>
