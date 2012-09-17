<?php

/**
 * import_users.php
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
require_once($default->owl_fs_root . "/lib/security.lib.php");

if (!fIsAdmin(true))
{
    header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
} 

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/import_users.xtpl");
$xtpl = new XTemplate("html/admin/import_users.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

include_once($default->owl_fs_root . "/lib/header.inc");
include_once($default->owl_fs_root . "/lib/userheader.inc");

fSetLogo_MOTD();
fSetPopupHelp();

if (!empty($_FILES))
{
   $userfile = uploadCompat("userfile");
}

//print("<center>");
//print("<table class=\"border1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"$default->table_expand_width\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">\n");
//fPrintButtonSpace(12, 1);
//print("<br />\n");
//print("<table class=\"border2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">\n");

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   //fPrintPrefs("infobar1", "top");
   fPrintPrefsXTPL('Top');
}

//fPrintButtonSpace(12, 1);
//print("<br />\n");

fPrintAdminPanelXTPL("importusers");

$xtpl->assign('FORM', '<form enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '" method="post">');
$urlArgs['sess']      = $sess;

//print("<form enctype=\"multipart/form-data\" action=\"" . $_SERVER["PHP_SELF"] ."\" method=\"post\">\n");
//print("<input type=\"hidden\" name=\"sess\" value=\"$sess\"></input>");
//print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
//fPrintSectionHeader($owl_lang->header_csv_import, "admin2");
$xtpl->assign('IMPUSER_PAGE_TITLE', $owl_lang->header_csv_import);
//print("<tr>\n");
//print("<td align=\"left\" valign=\"top\">\n");
//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
//print("<tr>\n");
$xtpl->assign('IMPUSER_SEND_FILE', $owl_lang->sendcsvfile);
//print("<td class=\"form1\">$owl_lang->sendcsvfile:</td>\n");
//print("<td class=\"form1\" width=\"100%\"><input class=\"finput1\" type=\"file\" name=\"userfile\" size=\"24\" maxlength=\"512\"></input></td>\n");
//print("</tr>\n");
//print("<td class=\"form1\">");
//fPrintButtonSpace(1, 1);
//print("</td>\n");
//print("<td class=\"form2\" width=\"100%\">");
//fPrintSubmitButton($owl_lang->sendfile, $owl_lang->alt_sendfile, "submit", "send_file_x");
//fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");

$xtpl->assign('IMPUSER_BTN_SEND_VALUE', $owl_lang->sendfile);
$xtpl->assign('IMPUSER_BTN_SEND_ALT', $owl_lang->alt_sendfile);

$xtpl->assign('IMPUSER_BTN_RESET_VALUE', $owl_lang->btn_reset);
$xtpl->assign('IMPUSER_BTN_RESET_ALT', $owl_lang->alt_reset_form);

//print("</td>\n");
//print("</tr>\n");

if (!empty($userfile))
{
   define( 'GROUPID', '0');
   define( 'USERNAME', '1');
   define( 'FULLNAME', '2');
   define( 'PASSWORD', '3');
   define( 'MAXSESSION', '12');
    
   $handle = fopen ($userfile["tmp_name"],"r");
   $qSQL = new OWL_db;
   $dNowDate = $qSQL->now();
   $row = 0;
   $CountLines = 0;
   
   while ($data = fgetcsv ($handle, 5000, ",")) 
   {
      if ($row == 0)
      {
         $row++;
         continue;
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
      $xtpl->assign('TD_CLASS', $sTrClass);

      $query = "INSERT INTO $default->owl_users_table (login_failed, passwd_last_changed, lastlogin,curlogin,groupid,username,name,password,quota_max,quota_current,email,notify,attachfile,disabled,noprefaccess,language,maxsessions,newsadmin,comment_notify,buttonstyle,homedir,firstdir,email_tool, change_paswd_at_login, expire_account, user_auth, logintonewrec, user_minor_revision, user_major_revision, user_default_revision) VALUES ('0', $dNowDate, $dNowDate, $dNowDate, ";
   
      $num = count ($data);
   
      //print "<p> $num fields in line $row: <br>\n";
      $row++;
      $bSkipUser = false;
      $xtpl->assign('IMPUSER_MSG', '&nbsp;');
      for ($c=0; $c < $num; $c++)  
      {
         if ($c > GROUPID )
         {
            $query .= ", ";
         }
   
         if ( $c == GROUPID )
         {
            if (is_numeric($data[$c]))
            {
               $iSaveGroupid = $data[$c];
               $qSQL->query("SELECT * FROM $default->owl_groups_table WHERE id = '$data[$c]'");
               if ($qSQL->num_rows() == 0)
               {
                  $sMessage = $owl_lang->invalid_groupid . "'$data[$c]'";
                  $bSkipUser = true;
               }
            }
            else
            {
               $qSQL->query("SELECT * FROM $default->owl_groups_table WHERE name = '$data[$c]'");
               if ($qSQL->num_rows() == 0)
               {
                  $qSQL->query("INSERT INTO $default->owl_groups_table (name) VALUES ('$data[$c]')");

                  $xtpl->assign('IMPUSER_LABEL', $owl_lang->group_create);
                  $xtpl->assign('IMPUSER_VALUE', $data[$c] . ' => ' . $owl_lang->import_inserted); 
                  $xtpl->parse('main.userimport.Row');
 
                  //print("<tr>\n");
                  //print("<td class=\"$sTrClass\">$owl_lang->group_create</td>\n");
                  //print("<td class=\"$sTrClass\" width=\"100%\">$data[$c]</td>\n");
                  //print("</tr>\n");

                  $data[$c] = $qSQL->insert_id($default->owl_groups_table, 'id');
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
                  $xtpl->assign('TD_CLASS', $sTrClass);
               }
               else
               {
                  $qSQL->next_record();
                  $data[$c] = $qSQL->f("id");
               }
               $iSaveGroupid = $data[$c];
            }
         }
         elseif ( $c == PASSWORD )
         {
            $data[$c] = md5($data[$c]);
         }
         elseif ( $c == MAXSESSION )
         {
            $data[$c] = $data[$c] - 1;
         }
         elseif ( $c == USERNAME )
         {
            $sUserName = $data[$c];
            $qSQL->query("SELECT * FROM $default->owl_users_table WHERE username = '$sUserName'");
            if ($qSQL->num_rows() > 0)
            {
                  $bSkipUser = true;
                  $sMessage = $owl_lang->msg_user_exists;
            }
         }
         elseif ( $c == FULLNAME )
         {
            $sFullName = $data[$c];
         }
         $newdata = ereg_replace("'","\'",$data[$c]);
         $query .= "'$newdata'";
       }
       $query .= ")";
   
       //print("<tr>\n");
       //print("<td class=\"$sTrClass\">$owl_lang->user_created_skipped</td>\n");
       $xtpl->assign('IMPUSER_LABEL', $owl_lang->user_created_skipped);
       if (!$bSkipUser)
       {
          $qSQL->query($query);
          $iUserID = $qSQL->insert_id();
          $qSQL->query("INSERT INTO $default->owl_users_grpmem_table (userid,groupid) VALUES ('$iUserID', '$iSaveGroupid')");

          //print("<td class=\"$sTrClass\" width=\"100%\">$sUserName ($sFullName) $owl_lang->import_inserted</td>\n");
          $xtpl->assign('IMPUSER_VALUE', "$sUserName ($sFullName)" . ' => ' . $owl_lang->import_inserted); 
          $xtpl->parse('main.userimport.Row');
       }
       else
       {
          //print("<td class=\"$sTrClass\" width=\"100%\">$sUserName ($sFullName) $owl_lang->import_skipped $sMessage</td>\n");
          $xtpl->assign('IMPUSER_VALUE', "$sUserName ($sFullName)" . ' => ' . $owl_lang->import_skipped); 
          $xtpl->assign('IMPUSER_MSG', $sMessage); 
          $xtpl->parse('main.userimport.Row');
       }
       //print("</tr>\n");
    
   }
   fclose ($handle);
   unlink($userfile["tmp_name"]);
}
//print("</table>\n");
//print("</td></tr></table>\n");
//print("</form>\n");

//fPrintButtonSpace(12, 1);
if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
   //fPrintPrefs("infobar2");
}
//print("</td></tr></table>\n");
//print("</center>");

//include($default->owl_fs_root .  "/lib/footer.inc");

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.userimport');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');


?>
