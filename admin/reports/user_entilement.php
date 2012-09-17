<?php
/**
 * file: user_entitlement.php
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
$sql = new Owl_DB;
$filter = $_POST['filter'];

if (is_numeric($filter))
{
  $sSubQuery = " where id = '$filter'";
}
else
{
  $sSubQuery = " where username like '%" . $sql->make_arg_safe($filter) . "%' or name like '%" . $sql->make_arg_safe($filter) . "%'";
}

$sql->query("SELECT id, groupid, name, username from $default->owl_users_table $sSubQuery union select '0' as id, '-1' as groupid, ' EVERYBODY' as name, 'EVERYBODY' as username ORDER BY name");

if (empty($export))
{

   $xtpl->assign('REPORT_FILTER_LABEL', $owl_lang->report_filter);
   $xtpl->assign('REPORT_FILTER_VALUE', ereg_replace("'", "",$filter));

   $xtpl->assign('REPORT_BTN_SUBMIT_LABEL', $owl_lang->btn_submit);
   $xtpl->assign('REPORT_BTN_SUBMIT_ALT', $owl_lang->btn_submit_alt);

   $xtpl->assign('REPORT_BTN_EXPORT_LABEL', $owl_lang->btn_export);
   $xtpl->assign('REPORT_BTN_EXPORT_ALT', $owl_lang->btn_export_alt);

   //print("<tr>\n");
   //print("<td class=\"form1\">$owl_lang->report_filter</td>\n");
   //print("<td colspan=\"16\" class=\"form1\" width=\"100%\">");
   //print("<input type=\"text\" name=\"filter\" value=\"" . ereg_replace("'", "",$filter) ."\"></input>");
   //fPrintSubmitButton($owl_lang->btn_submit, "Submit");
   //fPrintSubmitButton($owl_lang->btn_export, "Export", "submit", "export");
   //print("</td>");
   //print("</tr>\n");
   
   //print("<tr>\n");
   //print("<td align=\"left\" colspan=\"16\">&nbsp;</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");

   // 
   // User File Stats BEGIN
   // 
   $xtpl->assign('REPORT_TITLE', $owl_lang->report_users_entitlement);
 
   $xtpl->assign('REPORT_NAME_TITLE', $owl_lang->name);
   $xtpl->assign('REPORT_USERNAME_TITLE', $owl_lang->username);
   $xtpl->assign('REPORT_FILEFOLDER_TITLE', $owl_lang->report_file_folder);
   $xtpl->assign('REPORT_READ_TITLE', $owl_lang->acl_file_read);
   $xtpl->assign('REPORT_FLD_WRITE_TITLE', $owl_lang->acl_folder_write);
   $xtpl->assign('REPORT_VIEWLOG_TITLE', $owl_lang->acl_file_view_log);
   $xtpl->assign('REPORT_DELETE_TITLE', $owl_lang->acl_file_delete);
   $xtpl->assign('REPORT_COPY_TITLE', $owl_lang->acl_file_copy);
   $xtpl->assign('REPORT_MOVE_TITLE', $owl_lang->acl_file_move);
   $xtpl->assign('REPORT_MODIFY_TITLE', $owl_lang->acl_file_modify);
   $xtpl->assign('REPORT_UPDATE_TITLE', $owl_lang->acl_file_update);
   $xtpl->assign('REPORT_COMMENT_TITLE', $owl_lang->acl_file_comment);
   $xtpl->assign('REPORT_CHECKIN_TITLE', $owl_lang->acl_file_checkin);
   $xtpl->assign('REPORT_EMAIL_TITLE', $owl_lang->acl_file_email);
   $xtpl->assign('REPORT_SEARCH_TITLE', $owl_lang->acl_file_search);
   $xtpl->assign('REPORT_SETACL_TITLE', $owl_lang->acl_file_set_acl);
   $xtpl->assign('REPORT_MONITOR_TITLE', $owl_lang->acl_file_monitor);
   //print("<td class=\"admin2\" align=\"left\" colspan=\"19\">$owl_lang->report_users_entitlement</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td align=\"left\" colspan=\"19\">&nbsp;</td>\n");
   //print("<td align=\"left\">&nbsp;</td>\n");
   //print("</tr>\n");
   //print("<tr>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->name</td>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->username</td>\n");
   //print("<td align=\"left\" class=\"title1\">$owl_lang->report_file_folder</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_read</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_folder_write</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_view_log</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_delete</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_copy</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_move</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_modify</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_update</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_comment</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_checkin</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_email</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_search</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_set_acl</td>\n");
   //print("<td align=\"center\" class=\"title1\">$owl_lang->acl_file_monitor</td>\n");
   //print("</tr>\n");
}
else
{
   header( 'Pragma: ' );
   header( 'Cache-Control: ' );
   header( 'Content-Type: application/vnd-ms.excel' );
   $aDate = getdate();
   $sExportFilename = 'User_Access_' . $aDate[ 'month' ] . '_' . $aDate[ 'mday' ] . '_' . $aDate[ 'year' ] . '.xls';
   header( 'Content-Disposition: attachment; filename="' . $sExportFilename . '"' );

   print($owl_lang->name . "\t");
   print($owl_lang->username . "\t");
   print($owl_lang->report_file_folder . "\t");
   print($owl_lang->acl_file_read . "\t"); 
   print($owl_lang->acl_folder_write . "\t");
   print($owl_lang->acl_file_view_log . "\t");
   print($owl_lang->acl_file_delete . "\t");
   print($owl_lang->acl_file_copy . "\t");
   print($owl_lang->acl_file_move . "\t");
   print($owl_lang->acl_file_modify . "\t");
   print($owl_lang->acl_file_update . "\t");
   print($owl_lang->acl_file_comment . "\t");
   print($owl_lang->acl_file_checkin . "\t");
   print($owl_lang->acl_file_email . "\t");
   print($owl_lang->acl_file_search . "\t");
   print($owl_lang->acl_file_set_acl . "\t");
   print($owl_lang->acl_file_monitor . "\t\n");

}

$CurrentGroup = $usergroupid;
$CurrentUser = $userid;


while ($sql->next_record())
{
   $usergroupid = $sql->f("groupid");
   $userid = $sql->f("id");

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
      
   if (empty($export))
   {
      $xtpl->assign('REPORT_NAME_VALUE', $sql->f("name"));
      $xtpl->assign('REPORT_USERNAME_VALUE', $sql->f("username"));
      //print("\t\t\t\t<tr>\n");
      //print("<td class=\"$sTrClass\">" . $sql->f("name") . "</td>\n");
      //print("<td class=\"$sTrClass\">" . $sql->f("username") . "</td>\n");
      //print("<td class=\"$sTrClass\" colspan=\"16\">");
   }
   else
   {
      $sExportFullname = $sql->f("name");
      $sExportUsername = $sql->f("username");
   }

   if (fIsAdmin(false, true))
   {
      if(empty($export))
      {
         $xtpl->assign('REPORT_ACCESS_VALUE', $owl_lang->report_full_access);
         //print($owl_lang->report_full_access);
         $xtpl->parse('main.Stats.Report'.$execreport.'.User.UserInfo');
      }
      else
      {
         print($sExportFullname . "\t");
         print($sExportUsername . "\t");
         print($owl_lang->report_full_access ."\n");

      }
   }
   else
   {
      $aFolderAccess = array();
      $aFileAccess = array();
      $aMyGroups = array();
      $AclQuery = new Owl_DB;
      if (fIsGroupAdmin($userid, $usergroupid))
      {
         $sGroupWhere =   " groupid = '" . $usergroupid . "' ";

         $AclQuery->query("SELECT id FROM $default->owl_files_table WHERE $sGroupWhere");
         while ($AclQuery->next_record())
         {
            $sId = $AclQuery->f("id");
            $aFileAccess[$sId][owlread] += 1;
            $aFileAccess[$sId][owlwrite] += 1;
            $aFileAccess[$sId][owlviewlog] += 1;
            $aFileAccess[$sId][owldelete] += 1;
            $aFileAccess[$sId][owlcopy] += 1;
            $aFileAccess[$sId][owlmove] += 1;
            $aFileAccess[$sId][owlproperties] += 1;
            $aFileAccess[$sId][owlupdate] += 1;
            $aFileAccess[$sId][owlcomment] += 1;
            $aFileAccess[$sId][owlcheckin] += 1;
            $aFileAccess[$sId][owlemail] += 1;
            $aFileAccess[$sId][owlrelsearch] += 1;
            $aFileAccess[$sId][owlsetacl] += 1;
            $aFileAccess[$sId][owlmonitor] += 1;
         }

         $AclQuery->query("SELECT id FROM $default->owl_folders_table WHERE $sGroupWhere");
         while ($AclQuery->next_record())
         {
            $sId = $AclQuery->f("id");
            $aFolderAccess[$sId][owlread] += 1;
            $aFolderAccess[$sId][owlwrite] += 1;
            $aFolderAccess[$sId][owlviewlog] += 1;
            $aFolderAccess[$sId][owldelete] += 1;
            $aFolderAccess[$sId][owlcopy] += 1;
            $aFolderAccess[$sId][owlmove] += 1;
            $aFolderAccess[$sId][owlproperties] += 1;
            $aFolderAccess[$sId][owlupdate] += 1;
            $aFolderAccess[$sId][owlcomment] += 1;
            $aFolderAccess[$sId][owlcheckin] += 1;
            $aFolderAccess[$sId][owlemail] += 1;
            $aFolderAccess[$sId][owlrelsearch] += 1;
            $aFolderAccess[$sId][owlsetacl] += 1;
            $aFolderAccess[$sId][owlmonitor] += 1;
         }
      } 

      $AclQuery->query("SELECT * FROM $default->owl_advanced_acl_table WHERE group_id = '$usergroupid' OR user_id = '$userid'");
      while ($AclQuery->next_record())
      {
         $iFolderId = $AclQuery->f("folder_id");
         $iFileId = $AclQuery->f("file_id");

         if (empty($iFolderId))
         {
            $sId = $AclQuery->f("file_id");
            $aFileAccess[$sId][owlread] += $AclQuery->f("owlread");
            $aFileAccess[$sId][owlwrite] += $AclQuery->f("owlwrite");
            $aFileAccess[$sId][owlviewlog] += $AclQuery->f("owlviewlog");
            $aFileAccess[$sId][owldelete] += $AclQuery->f("owldelete");
            $aFileAccess[$sId][owlcopy] += $AclQuery->f("owlcopy");
            $aFileAccess[$sId][owlmove] += $AclQuery->f("owlmove");
            $aFileAccess[$sId][owlproperties] += $AclQuery->f("owlproperties");
            $aFileAccess[$sId][owlupdate] += $AclQuery->f("owlupdate");
            $aFileAccess[$sId][owlcomment] += $AclQuery->f("owlcomment");
            $aFileAccess[$sId][owlcheckin] += $AclQuery->f("owlcheckin");
            $aFileAccess[$sId][owlemail] += $AclQuery->f("owlemail");
            $aFileAccess[$sId][owlrelsearch] += $AclQuery->f("owlrelsearch");
            $aFileAccess[$sId][owlsetacl] += $AclQuery->f("owlsetacl");
            $aFileAccess[$sId][owlmonitor] += $AclQuery->f("owlmonitor");
            //print("<td align=\"left\" class=\"title1\">$sId</td>\n");
            //print("File ID:" . $AclQuery->f("file_id") . "<br />");
         }
         else
         {
            $sId = $AclQuery->f("folder_id");
            $aFolderAccess[$sId][owlread] += $AclQuery->f("owlread");
            $aFolderAccess[$sId][owlwrite] += $AclQuery->f("owlwrite");
            $aFolderAccess[$sId][owlviewlog] += $AclQuery->f("owlviewlog");
            $aFolderAccess[$sId][owldelete] += $AclQuery->f("owldelete");
            $aFolderAccess[$sId][owlcopy] += $AclQuery->f("owlcopy");
            $aFolderAccess[$sId][owlmove] += $AclQuery->f("owlmove");
            $aFolderAccess[$sId][owlproperties] += $AclQuery->f("owlproperties");
            $aFolderAccess[$sId][owlupdate] += $AclQuery->f("owlupdate");
            $aFolderAccess[$sId][owlcomment] += $AclQuery->f("owlcomment");
            $aFolderAccess[$sId][owlcheckin] += $AclQuery->f("owlcheckin");
            $aFolderAccess[$sId][owlemail] += $AclQuery->f("owlemail");
            $aFolderAccess[$sId][owlrelsearch] += $AclQuery->f("owlrelsearch");
            $aFolderAccess[$sId][owlsetacl] += $AclQuery->f("owlsetacl");
            $aFolderAccess[$sId][owlmonitor] += $AclQuery->f("owlmonitor");
         }
      }
    
      //print("<pre>");
      //print("<br />FILE");
      //print_r($aFileAccess);
      //print("----------------------------------------------------------------------");
      //print("<br />FOLDER");
      //print_r($aFolderAccess);
      //print("</pre>");

      if (empty($export))
      {
         $xtpl->assign('REPORT_ACCESS_VALUE', '');
         if (empty($aFileAccess) and empty($aFolderAccess))
         {
            $xtpl->assign('REPORT_ACCESS_VALUE', 'NO ACL SPECIFIED FOR THIS USER');
         }
         $xtpl->parse('main.Stats.Report'.$execreport.'.User.UserInfo');

         foreach ( $aFolderAccess as $iFolderId => $key)
         {
            //print("<tr>");
            //print("<td align=\"left\" colspan=\"2\" class=\"$sTrClass\">&nbsp;</td>\n");
            $xtpl->assign('REPORT_FILEFOLDER_IMG', 'folder_closed');

            $sFolderPath = find_path(owlfolderparent($iFolderId));
            if ($sFolderPath == '[ ORPHANED ]')
            {
               $sFolderPath .= ": folder_id => $iFolderId";
            }
            else
            {
               if ($iFolderId > 1)
               {
                  $sFolderPath .=  "/" . fid_to_name($iFolderId);
               }
            }
            $xtpl->assign('REPORT_FILEFOLDER_PATH', $sFolderPath);
            //print("<td align=\"left\" class=\"$sTrClass\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_closed.gif\" border=\"0\" alt=\"\"></img>&nbsp;" . find_path(owlfolderparent($iFolderId)) . "/" . fid_to_name($iFolderId) . "</td>\n");
            foreach ($key as $iFolderAccess => $value)
            {
               $sAccess = $owl_lang->status_no;
               if ($value > 0)
               {
                  $sAccess = $owl_lang->status_yes;
               }
               //print("<td align=\"center\" class=\"$sTrClass\">$sAccess</td>\n");
               $xtpl->assign('ACL', $sAccess);
               $xtpl->parse('main.Stats.Report'.$execreport.'.User.Access.ACL');
            }
            //print("</tr>");
            $xtpl->parse('main.Stats.Report'.$execreport.'.User.Access');
         }
         foreach ( $aFileAccess as $iFileId => $key)
         {
            $sFilePath = find_path(owlfileparent($iFileId));
            if ($sFilePath == '[ ORPHANED ]')
            {
               $sFilePath .= ": file_id => $iFileId";
            }
            else
            {
               $sFilePath .=  "/" . flid_to_name($iFileId);
            }
            $xtpl->assign('REPORT_FILEFOLDER_IMG', 'file');
            $xtpl->assign('REPORT_FILEFOLDER_PATH', $sFilePath);
            //print("<tr>");
            //print("<td align=\"left\" colspan=\"2\" class=\"$sTrClass\">&nbsp;</td>\n");
            //print("<td align=\"left\" class=\"$sTrClass\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/file.gif\" border=\"0\" alt=\"\"></img>&nbsp;" . $sFilePath . "</td>\n");

            foreach ($key as $iFileAccess => $value)
            {
               $sAccess = $owl_lang->status_no;
               if ($value > 0)
               {
                  $sAccess = $owl_lang->status_yes;
               }
               $xtpl->assign('ACL', $sAccess);
               $xtpl->parse('main.Stats.Report'.$execreport.'.User.Access.ACL');
               //print("<td align=\"center\" class=\"$sTrClass\">$sAccess</td>\n");
            }
            //print("</tr>");
            $xtpl->parse('main.Stats.Report'.$execreport.'.User.Access');
         }
   
      //print("</td>\n");
      //print("</tr>\n");
      $xtpl->parse('main.Stats.Report'.$execreport.'.User');
      }
      else
      {
         // EXPORT VALUES HERE

         foreach ( $aFileAccess as $iFileId => $key)
         {
            print($sExportFullname . "\t");
            print($sExportUsername . "\t");
            print(find_path(owlfileparent($iFileId)) . "/" . flid_to_name($iFileId) . "\t");
            foreach ($key as $iFileAccess => $value)
            {
               $sAccess = $owl_lang->status_no;
               if ($value > 0)
               {
                  $sAccess = $owl_lang->status_yes;
               }
               print($sAccess . "\t");
            }
            print("\n");
         }
         foreach ( $aFolderAccess as $iFolderId => $key)
         {
            print($sExportFullname . "\t");
            print($sExportUsername . "\t");
            print(find_path(owlfolderparent($iFolderId)) . "/" . fid_to_name($iFolderId) . "\t");
            foreach ($key as $iFolderAccess => $value)
            {
               $sAccess = $owl_lang->status_no;
               if ($value > 0)
               {
                  $sAccess = $owl_lang->status_yes;
               }
               print($sAccess . "\t");
            }
            print("\n");
         }
      }
   }
} 

$usergroupid = $CurrentGroup;
$userid = $CurrentUser;

// 
// User File Stats END
?>
