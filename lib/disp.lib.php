<?php

/*
 * disp.lib.php
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
 * $Id: disp.lib.php,v 1.41 2006/11/16 16:02:40 b0zz Exp $
 */

defined( 'OWL_INCLUDE' ) or die( 'Access Denied' );

// *************************************************
// BEGIN DO NOT CHANGE THIS VARIABLE
// *************************************************
$default->WebDAV = false;
// *************************************************
// END: DO NOT CHANGE THIS VARIABLE
// *************************************************


/**
 * Prints the Vaforite
 *
 * Empty e-mail addresses are allowed. See RFC 2822 for details.
 *
 * @param $mail
 *   A string containing an email address.
 * @return
 *   TRUE if the address is in a valid format.
 */


function fIsCheckBoxChecked($iCheckboxValue)
{
   if ($iCheckboxValue == 1)
   {
      return "checked=\"checked\"";
   }
   else
   {
      return "";
   }
}
// ***  Functions contributed by Value 4 Business
// BEGIN

function fGetURL ($file, $args)
{
   global $default;

   $pos = false;
   if ( 0 < strlen($default->owl_root_url))
   {
      $pos = strpos($file, $default->owl_root_url);
   }
   else
   {
      /* the root_url is Zero, remove the leadning / from the PHP_SELF */
      $file = ltrim($file, '/');
   }

   if ( $pos !== false)
   {
      $url = $file; 
   }
   else
   {
      $url = "$default->owl_root_url/$file";

   }
 
   $params = '';
   foreach ($args as $k => $v)
   {
      settype($v, "string");  

      if ($v != "")
      {
         $params .= "$k=$v". "&amp;";
      }
   }
   $params = substr ($params, 0, strlen($params)-5);

   $url .= "?$params&currentdb=$default->owl_current_db";
   return $url;
}


function fGetHiddenFields ($args)
{
   global $default;
   $html = '';
   foreach ($args as $k => $v)
   {
      if ($v or $v == "0")
      {
         $html .= "<input type=\"hidden\" id=\"$k\" name=\"$k\" value=\"" . htmlentities($v, ENT_COMPAT, $default->charset) . "\" />\n";
      }
   }

    return $html;
}

// END

function fPrintFormDoctypeRadio($rowtitle, $fieldname, $value, $option_text , $sReadonly = "", $iFileId = "")
{
   global $owl_lang, $default;

   print("<tr>\n");
   print("<td class=\"form1\">$rowtitle</td>\n");

   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\" " . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
   }
   else
   {
       $extended_help="";
   }
   $checked = "";

   print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">");

   if ($value == "0")
   {
         $checked = "checked=\"checked\"";
   }

   foreach ($option_text as $caption)
   {
      if ($caption == $value) 
      {
         $checked = "checked=\"checked\"";
      }
      
      print("<input $sReadonly type=\"radio\" value=\"$caption\" name=\"$fieldname" . $iFileId ."\" $checked />$caption\n");

      $checked = "";
   }

  print("</td>\n</tr>\n");
}

function fPrintSectionHeader($title, $class = 'admin2', $sSlider = '')
{
   if (!empty($sSlider))
   {
      print("<tr><td width=\"1%\" align=\"left\">" . $sSlider . "</td>\n");
      print("    <td class=\"$class\" width=\"99%\">$title<br /></td></tr>\n");
   }
   else
   {
      print("<tr><td class=\"$class\" width=\"100%\" colspan=\"2\">" . $sSlider . "$title<br /></td></tr>\n");
   }
}

function fPrintFormCheckBox($rowtitle, $fieldname, $value, $checked = "", $submit = "", $readonly = "")
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   if (!empty($checked))
   {
      $checked = "checked=\"$checked\"";
   }
   if (!empty($readonly))
   {
      $readonly = "disabled=\"disabled\"";
   }
   if (!empty($submit))
   {
      $submit = "onclick=\"javascript:this.form.submit()\"";
   }
   print("<tr>\n");
   print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
   }
   else
   {
       $extended_help="";
   }
   print("<td class=\"form1\" width=\"100%\"" . $extended_help . "><input class=\"fcheckbox1\" type=\"checkbox\" name=\"$fieldname\" value=\"$value\" $checked $submit $readonly /></td>\n");
//sun2earth end   
   print("</tr>\n");
}

function fPrintFormTextArea($rowtitle, $fieldname, $currentvalue = "" , $row = 10, $sReadonly = '' , $cols = 50)
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   print("<tr>\n");
   print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
   }
   else
   {
       $extended_help="";
   }
   print("<td class=\"form1\" width=\"100%\"" . $extended_help . "><textarea class=\"ftext1\" name=\"$fieldname\" rows=\"$row\" cols=\"$cols\" $sReadonly >$currentvalue</textarea></td>\n");
//sun2earth end
   print("</tr>\n");
}

function fPrintFormTextLine($rowtitle, $name, $size = "24", $value = "", $bytes = "", $readonly = false, $type = 'text')
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   print("<tr>\n");
   print("<td class=\"form1\">");
   if(!empty($name) and $type == "text")
   {
      print("<label for=\"$name\">");
   }
   print($rowtitle);

   if(!empty($name) and $type == "text")
   {
      print("</label>");
   }
   print("</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $name . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
   }
   else
   {
       $extended_help="";
   }
   if ($readonly)
   {
      print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">$value");      
//sun2earth end
      if(!empty($bytes))
      {
         print(" ($bytes)");
      } 
      print("</td>\n");
   }
   else
   {
      print("<td class=\"form1\" width=\"100%\"><input class=\"finput1\" id=\"$name\" type=\"$type\" name=\"$name\" size=\"$size\" value=\"$value\" />");
      if(!empty($bytes))
      {
         print("($bytes)");
      } 
      print("</td>\n");

   }
   print("</tr>\n");
}


function fPrintFormSelectBox($rowtitle, $fieldname, $values, $currentvalue = "No value", $size = 1, $multiple = false, $standalone = false)
{
   global $owl_lang;
   $found = false;

   if ($standalone == false)
   {
      print("<tr>\n");
      print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
   }
   else
   {
       $extended_help="";
   }
      print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">");
//sun2earth end      
   }
   print("<select class=\"fpull1\" name=\"$fieldname\" size=\"$size\"");
   if ($multiple)
   {
      print(" multiple=\"multiple\" ");
      $currentvalue = preg_split("/\s+/", strtolower($currentvalue));
   }
   print(">\n");
   if (is_array($values))
   {
      foreach($values as $g)
      {
         $val = addcslashes($g[0], '()&?');
         print("<option value=\"$g[0]\" ");
         if ($multiple)
         {
            if(preg_grep("/$val/", $currentvalue))
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         else
         {
            if ($g[0] == $currentvalue)
            {   
               print("selected=\"selected\"");
               $found = true;
            }   
         }
         print(">$g[1]</option>\n");
      }      
   }
   if (!$found and $currentvalue <> "No value")
   {
      if($multiple)
      {
         print("<option value=\"\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
      else
      {
         print("<option value=\"$currentvalue\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
   }
   print("</select>");
   if ($standalone == false)
   {
      print("</td></tr>");
   }
}
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
function fPrintFormTableSelectBox($rowtitle, $fieldname, $values, $currentvalue = "No value", $size = 1, $multiple = false, $standalone = false)
{
   global $owl_lang;
   $found = false;

   if ($standalone == false)
   {
      print("<tr>\n");
      print("<td class=\"form1\">$rowtitle</td>\n");
      print("<td class=\"form1\" width=\"100%\">");
   }
   print("<select class=\"fpull1\" name=\"$fieldname\" size=\"$size\"");
   if ($multiple)
   {
      print(" multiple=\"multiple\" ");
      $currentvalue = preg_split("/\s+/", strtolower($currentvalue));
   }
   print(">\n");
   if (is_array($values))
   {
      foreach($values as $g)
      {
        $val = addcslashes($g[0], '()&');
         print("<option value=\"$g[0]\" ");
         if ($multiple)
         {
            if(preg_grep("/$val/", $currentvalue))
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         else
         {
            if ($g[0] == $currentvalue)
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         print(">$g[1]</option>\n");
      }
   }
   if (!$found and $currentvalue <> "No value")
   {
      if($multiple)
      {
         print("<option value=\"\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
      else
      {
         print("<option value=\"$currentvalue\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
   }
   print("</select>");
    if (fIsAdmin(true))
    {
        $sess = $_GET["sess"];
        print("<input type=\"button\" class=\"form1\" onClick=\"window.open('./extensions/quickAdd.php?sess=$sess', 'Owl', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600,left = 320,top = 150')\" value=\"$owl_lang->tables_quickAdd\" />");
        print("<input type=\"button\" class=\"form1\" onClick=\"location.reload(true)\" value=\"$owl_lang->tables_refresh\" />");
    }
   if ($standalone == false)
   {
      print("</td></tr>");
   }
}

function fPrintURL($rowtitle, $text, $url)
{
    print("<tr><td class=\"form1\">\n");
    if (!empty($rowtitle))
    {
        print("<label for=\"$rowtitle\">");
    }
    print($rowtitle);
    if (!empty($rowtitle))
    {
        print("</label>");
    }
    print("</td>\n");
    $session = $_GET["sess"];
    print("<td class=\"form1\" width=\"100%\"><a href=\"$url?sess=$session\" target=\"_new\">$text</a></td></tr>\n");
}

function gethtmlprefs ( )
{
   global $default, $cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }


   $sql->query("SELECT * FROM $default->owl_html_table");
   $sql->next_record();

   // styles sheet
   // this is an absolute URL and not a filesystem reference

   $default->styles                = "$default->owl_graphics_url/". rawurlencode($default->sButtonStyle) . "/css/styles.css";

   $default->table_expand_width    = $sql->f("table_expand_width");
   $default->table_collapse_width  = $sql->f("table_collapse_width");
   $default->body_background       = $sql->f("body_background");
   $default->owl_logo              = $sql->f("owl_logo");
   $default->body_textcolor        = $sql->f("body_textcolor");
   $default->body_link             = $sql->f("body_link");
   $default->body_vlink            = $sql->f("body_vlink");
   $default->table_header_height   = 40;
};

function displayBrowsePage($parent) 
{
   global $sess, $expand, $order, $sortorder, $sortname, $parent, $curview, $page, $default;
   // If we are hidding the backup directory
   // then change the directory to return to
   // the parent of this backup  directory
   
   if(fid_to_name($parent) == "$default->version_control_backup_dir_name" && $default->hide_backup == 1) 
   {
      $sql = new Owl_DB;
      $sql->query("SELECT parent FROM $default->owl_folders_table WHERE id = $parent");
      $sql->next_record();
      $parent = $sql->f("parent");
   }
   $sAddPageToUrl = "";
   if (!empty($page))
   {
      $sAddPageToUrl = '&page=' . $page;
   }
   if ($default->use_progress_bar == 1)
   {
      header("Location: " . $default->owl_root_url . "/browse.php?sess=$sess$sAddPageToUrl&parent=$parent&expand=$expand&order=$order&$sortorder=$sortname&curview=$curview");
   }
   else
   {
      header("Location: browse.php?sess=$sess$sAddPageToUrl&parent=$parent&expand=$expand&order=$order&$sortorder=$sortname&curview=$curview");
   }

}

function fGetStatusBarCount() 
{
   global $iUpdatedFileCount, $iNewFileCount, $iMyFileCount, $iTotalFileCount, $iQuotaCurrent, $iQuotaMax, $iNewsCount, $iFolderCount, $iFileCount;
   global $default, $owl_lang, $sess, $expand, $userid, $lastlogin, $parent, $usergroupid, $userid;
   global $iMyCheckedOutCount, $iGroupFileCount, $iMonitoredFiles, $iMonitoredFolders, $aNews; 
   global $iWaitingApproval, $iMyPendingDocs;
   global $iBrokenTreeFileCount, $iBrokenTreeFolderCount, $bIsInBrokenTree;

   global $aFoldersCheckedt;
   global $cCommonDBConnection;

   $sql = new Owl_DB;

   $sqlmemgroup = $cCommonDBConnection;
   if (empty($sqlmemgroup))
   {
      $sqlmemgroup = new Owl_DB;
   }


   $iMonitoredFiles = 0;
   $iMonitoredFolders = 0;
   $iMyCheckedOutCount = 0;
   $iUpdatedFileCount = 0;
   $iNewFileCount = 0;
   $iMyFileCount = 0;
   $iGroupFileCount = 0;
   $iTotalFileCount = 0;
   $iQuotaCurrent = 0;
   $iQuotaMax = 0;
   $iNewsCount = 0;
   $iFolderCount = 0;
   $iWaitingApproval = 0;
   $iBrokenTreeFileCount = 0;
   $iBrokenTreeFolderCount = 0;
   $aFoldersChecked = array();
   $aFilesChecked = array();
   

   // ******* Get Total Number of Broken Tree Files and Folders ********
   if ($default->show_file_stats > 0)
   {
      if ( $default->advanced_security == 1 and $default->count_file_folder_special_access) 
      {
         $groups = fGetGroups($userid);
      
         foreach ($groups as $aGroups)
         {
           $qQuery .= " OR a.group_id ='" .$aGroups["0"] . "'";
         }
    
         $sql->query("SELECT DISTINCT id FROM $default->owl_folders_table f, $default->owl_advanced_acl_table a WHERE a.folder_id=id AND a.folder_id <> '1' and (a.user_id = '0' OR a.user_id = '$userid' $qQuery )");
         while ($sql->next_record())
         {
            $bIsInBrokenTree = false;
            fIsInBrokenTree($sql->f('id'));
            if ($bIsInBrokenTree == false)
            {
               continue;
            }
            $iBrokenTreeFolderCount++;
         }
   
         $sql->query("SELECT DISTINCT id, parent FROM $default->owl_files_table f, $default->owl_advanced_acl_table a WHERE a.file_id=id AND (a.user_id = '0' or a.user_id = '$userid' $qQuery )");
         while($sql->next_record())
         {
            $bIsInBrokenTree = false;
            fIsInBrokenTree($sql->f('parent'));
            if ($bIsInBrokenTree == false)
            {
               continue;
            }
            $iBrokenTreeFileCount++;
         }
      } 
   
      // ******* Get Total Number of Monitored Files and Folders ********
   
      $sql->query("SELECT id FROM $default->owl_monitored_file_table  WHERE userid = '$userid'");
      $iMonitoredFiles =  $sql->num_rows();
   
      $sql->query("SELECT id FROM $default->owl_monitored_folder_table WHERE userid = '$userid'");
      $iMonitoredFolders  =  $sql->num_rows();
      
   
      $sql->query("SELECT id FROM $default->owl_folders_table WHERE parent = '$parent'");
      if ($default->restrict_view == 1)
      {
         while($sql->next_record()) 
         {
            if (check_auth($sql->f("id"), "folder_view", $userid, false, false))
            {
               $iFolderCount++;
            } 
         }
      }
      else
      {
         $iFolderCount = $sql->num_rows();
      }

      // ******* Get Total Number of Files in Current Folder ********
      $iID = "";
      $sql->query("SELECT id from $default->owl_files_table where parent = '$parent' AND approved = '1'");
      if ($default->restrict_view == 1)
      {
         while($sql->next_record())
         {
            $iID = $sql->f("id");
            if (empty($aFilesChecked[$iID]['file_download']))
            {
               $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
            }
            if ($aFilesChecked[$iID]['file_download'] == 1)
            {
               $iFileCount++;
            }
         }
      }
      else
      {
         $iFileCount = $sql->num_rows();
      }



      // ******* Get Count of Updated Files ********
      $iID = "";
      $sql->query("SELECT id FROM $default->owl_files_table where smodified > '$lastlogin' and created < '$lastlogin' AND approved = '1'");
      while($sql->next_record())
      {
         $iID = $sql->f("id");
         if (empty($aFilesChecked[$iID]['file_download']))
         {
            $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
         }
         if ($aFilesChecked[$iID]['file_download'] == 1)
         {
           $iUpdatedFileCount++;
         }
      }

      // ******* Get Count of New Files ********

      $iID = "";
      $sql->query("SELECT id, parent FROM $default->owl_files_table where created > '$lastlogin' AND approved = '1'");
      while($sql->next_record())
      {
         $iID = $sql->f("id");
         $iParent = $sql->f("parent");
         if (empty($aFilesChecked[$iID]['file_download']))
         {
            $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
         }
         if ($aFilesChecked[$iID]['file_download'] == 1)
         {
            $sDirectoryPath = get_dirpath($iParent);
            $pos = strpos($sDirectoryPath, "backup");
            if (!(is_integer($pos) && $pos))
            {
               $iNewFileCount++;
            }
         }
      }
 
      // ******* Get Count of That users Files ********
   
      $sql->query("SELECT id FROM $default->owl_files_table WHERE creatorid = '$userid'");
      $iMyFileCount = $sql->num_rows();
   
      // ****** Get Count that user has checked out*****
      $sql->query("SELECT id FROM $default->owl_files_table WHERE checked_out = '$userid'");
      $iMyCheckedOutCount = $sql->num_rows();
   
      // ******* Get Count of All Files ********
   
      $sql->query("SELECT id FROM $default->owl_files_table WHERE approved = '1'");
      $iTotalFileCount = $sql->num_rows();
   
      // ******* Get Count of All Files ********
   
      $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
      $sql->next_record();
      $iQuotaCurrent = $sql->f("quota_current");
      $iQuotaMax = $sql->f("quota_max");
   
      $iPercent = $iQuotaCurrent ;
   }

   // ******* Get Count of New News ********

   $iLastNews = $sql->f("lastnews");
   if (!isset($iLastNews))
   {
       $iLastNews = 0;
   }

   $sqlmemgroup->query("SELECT * FROM $default->owl_users_grpmem_table WHERE groupid is not NULL AND userid = '" . $userid . "'");
   $sGroupsWhereClause = "( gid = '-1' OR gid = '$usergroupid'";
   $sFilesGroupsWhereClause = "( groupid = '-1' OR groupid = '$usergroupid'";

   while($sqlmemgroup->next_record())
   {
      $sGroupsWhereClause .= " OR gid = '" . $sqlmemgroup->f("groupid") . "'";
      $sFilesGroupsWhereClause .= " OR groupid = '" . $sqlmemgroup->f("groupid") . "'";
   }
   $sGroupsWhereClause .= ")";
   $sFilesGroupsWhereClause .= ")";

   $sMyQuery = "SELECT * FROM $default->owl_news_table WHERE $sGroupsWhereClause and id > '$iLastNews'  and news_end_date >= " . $sql->now();
   $sql->query($sMyQuery);
   $iNewsCount = $sql->num_rows();
 
   $i = 0; 
   while($sql->next_record())
   {
      $aNews[$i]['id'] = $sql->f("id");
      $aNews[$i]['news_title'] = $sql->f("news_title");
      $aNews[$i]['news_date'] = $sql->f("news_date");
      $aNews[$i]['news'] = $sql->f("news");
      $i++;
   }
   
   // ******* Get Count of files in My Groups  ********

   $sMyQuery = "SELECT * FROM $default->owl_files_table WHERE $sFilesGroupsWhereClause  AND approved = '1'";
   $sql->query($sMyQuery);
   $iGroupFileCount = $sql->num_rows();


   // ******* Get Count of files for Review********
   if ( $default->document_peer_review == 1)
   {
      $sMyQuery = "SELECT distinct file_id from $default->owl_peerreview_table WHERE reviewer_id = '$userid' AND status='0'";

      $sql->query($sMyQuery);
      $iWaitingApproval = $sql->num_rows();

      $sMyQuery = "SELECT id FROM $default->owl_files_table WHERE creatorid = '$userid' and approved = '0'";
      $sql->query($sMyQuery);
      $iMyPendingDocs = $sql->num_rows();
   }

}

function fPrintCustomFields ($iCurrentDocType, $iFileId, $iRequired = 0 , $sWhereClause = "", $sReadonly = "", $sBlock = "DataBlock.File")
{
   global $default, $language, $owl_lang;
   global $xtpl;

      $sql_custom = new Owl_DB;
      $sql_custom_values = new Owl_DB;

      if(!empty($sReadonly))
      {
         $sDisabled = "disabled=\"disabled\"";
      }

      if(!empty($sWhereClause))
      {
         $sWhereClause = " and show_in_list = '1' ";
      }

      $bPrintInitialHeading = true;

      if (!empty($iCurrentDocType))
      {
               $sql_custom->query("SELECT * from $default->owl_docfields_table where doc_type_id = '" . $iCurrentDocType. "'  $sWhereClause  order by field_position");

               $qFieldLabel = new Owl_DB;

               while ($sql_custom->next_record())
               {

                  $sql_custom_values->query("SELECT  field_value from $default->owl_docfieldvalues_table where file_id = '" . $iFileId . "' and field_name = '" . $sql_custom->f("field_name") ."'");
                  $values_result = $sql_custom_values->next_record();

                  $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql_custom->f("id") . "'");
                  $qFieldLabel->next_record();

                  $iRequired = $sql_custom->f("required");
                  if ($iRequired == "1")
                  {
                     $required = "<font color=red><b>&nbsp;*&nbsp;</b></font>";
                  }
                  else
                  {
                     $required = "<font color=red><b>&nbsp;&nbsp;&nbsp;</b></font>";
                  }

                  if($bPrintInitialHeading)
                  {
                     if ($sql_custom->f("field_position") == 1 and $sql_custom->f("field_type") == "seperator")
                     {
                              $xtpl->assign('DOC_TYPE_SEP_LABEL', $qFieldLabel->f("field_label"));
                              $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Separator');
                     }
                     else
                     {
                           $xtpl->assign('DOC_TYPE_HEADING', $owl_lang->doc_specific);
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Heading');
                     }
                     $bPrintInitialHeading = false;
                 }

                  $sFieldType = $sql_custom->f("field_type");
                  if ($sFieldType == "picklist" and !empty($sReadonly))
                  {
                     $sFieldType = "text";
                  }
                  if ($sFieldType == "date" and !empty($sReadonly))
                  {
                     $sFieldType = "text";
                  }

                  switch ($sFieldType)
                  {
                     case "seperator":
                        if ($sql_custom->f("field_position") > 1)
                        {
                              $xtpl->assign('DOC_TYPE_SEP_LABEL', $qFieldLabel->f("field_label"));
                              $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Separator');
                        }
                     break;

                     case "text":
                        if (!empty($sReadonly))
                        {
                           $sClass = "readonly";
                        }
                        else
                        {
                           $sClass = "finput1";
                        }

     
                           $xtpl->assign('DOC_TYPE_TEXT_LABEL', $qFieldLabel->f("field_label"));
                           $xtpl->assign('DOC_TYPE_TEXT_REQ', $required);
                           $xtpl->assign('DOC_TYPE_TEXT_CLASS', $sClass);
                           $xtpl->assign('DOC_TYPE_TEXT_DISABLED', $sDisabled);
                           //$xtpl->assign('DOC_TYPE_TEXT_TYPE', $sql_custom->f("field_type"));
                           $xtpl->assign('DOC_TYPE_TEXT_TYPE', 'text');
                           $xtpl->assign('DOC_TYPE_TEXT_NAME', $sql_custom->f("field_name"));
                           $xtpl->assign('DOC_TYPE_TEXT_SIZE', $sql_custom->f("field_size"));
                           $xtpl->assign('DOC_TYPE_TEXT_VALUE', $sql_custom_values->f("field_value"));
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Text');
                        break;
                     case "picklist":
                       $aPickListValues = array();
                       $aPickList = array();

                       $aPickList = split("\|",  $sql_custom->f("field_values"));
                       $i = 0;
                       foreach ($aPickList as $sValues)
                       {
                          $aPickListValues[$i][0] = $sValues;
                          $aPickListValues[$i][1] = $sValues;
                          $i++;
                       }
                       if (empty($sReadonly))
                       {
                          fPrintFormSelectBox($qFieldLabel->f("field_label") .": $required", $sql_custom->f("field_name"), $aPickListValues, $sql_custom_values->f("field_value"));
                       }
                       break;
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
                             case "table":
                                $aPickListValues = array();
                                $table = $sql_custom->f("field_values");
                                $xtpl->assign('DOC_TYPE_TABLE_LABEL', $qFieldLabel->f("field_label"));
                                $xtpl->assign('DOC_TYPE_TABLE_NAME', $sql_custom->f("field_label"));
                                $xtpl->assign('DOC_TYPE_TABLE_REQ', $required);
                                $table = 'ut_entities';
                                $qTablePickValue = new Owl_Db;
                                $qTablePickValue->query("SELECT * FROM $table ORDER BY descr");
                       //          $i = 0;
                                // while ($qTablePickValue->next_record())
                                while ($qTablePickValue->next_record())
                                {
                                   $xtpl->assign('DOC_TYPE_TABLE_SELECTED', '');
                                   $xtpl->assign('DOC_TYPE_TABLE_VALUE', $qTablePickValue->f("descr"));

                                   if ($qTablePickValue->f("descr") == $sql_custom_values->f("field_value"))
                                   {
                                      $xtpl->assign('DOC_TYPE_TABLE_SELECTED', ' selected="selected"');
                                   }
                                   $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Table.Value');
                                }
                                $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Table');
                                break;
                             case "url":
                                $aURL = split("\|", $sql_custom->f("field_values"));
                                $xtpl->assign('DOC_TYPE_URL_LABEL', $qFieldLabel->f("field_label"));
                                $xtpl->assign('DOC_TYPE_URL_REQUIRED', $required);
                                $xtpl->assign('DOC_TYPE_TYPE_URL_LOC', $aURL[1]);
                                $xtpl->assign('DOC_TYPE_TYPE_URL_LABEL', $aURL[0]);
                                $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Url');
                                break;
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
                  case "mcheckbox":
                    $aMultipleCheckBoxLabel = array();
                    $aMultipleCheckBoxLabel = split("\|",  $sql_custom->f("field_values"));
                    $aMultipleCheckBox = split("\|",  $sql_custom_values->f("field_value"));
                    $i = 0;
                    $iNumberColumns  = $sql_custom->f("field_size");
                    $xtpl->assign('DOC_TYPE_MCHECK_LABEL', $qFieldLabel->f("field_label"));
                    $xtpl->assign('DOC_TYPE_MCHECK_REQ', $required);
                    foreach ($aMultipleCheckBoxLabel as $sLabel)
                    {
                       $sValues = $aMultipleCheckBox[$i];
                       if (!empty($sValues))
                       {
                          $checked = "checked=\"checked\"";

                       }
                       else
                       {
                          $checked = "";
                       }

                       $iColumnCount = $i % $iNumberColumns;

                       if ($xtpl)
                       {
                          $xtpl->assign('DOC_TYPE_MCHECK_DISABLED', $sDisabled);
                          $xtpl->assign('DOC_TYPE_MCHECK_NAME', $sql_custom->f("field_name") . "_$i");
                          $xtpl->assign('DOC_TYPE_MCHECK_VALUE', $aMultipleCheckBoxLabel[$i]);
                          $xtpl->assign('DOC_TYPE_MCHECK_CHECKED', $checked);
                          $xtpl->parse('main.' . $sBlock . '.DocFields.Row.MultipleCheck.Input');
                       }
                       $aMultipleCheckBox[$i]= $sValues;
                       $i++;
                    }
                    $xtpl->parse('main.' . $sBlock . '.DocFields.Row.MultipleCheck');
                  break;
                     case "radio":
                       $aRadioButtonValues = array();
                       $aRadioButtons = array();
                        $sSelectedValue = '';

                        $aRadioButtons = split("\|",  $sql_custom->f("field_values"));
                        $i = 0;
                        foreach ($aRadioButtons as $sValues)
                        {
                           $aRadioButtonValues[$i]= $sValues;
                           if ($sValues == $sql_custom_values->f("field_value"))
                           {
                              $sSelectedValue = $i;
                           }
                           $i++;
                        }
                        fPrintFormDoctypeRadioXtpl($qFieldLabel->f("field_label") .": $required" , $sql_custom->f("field_name"), $sql_custom_values->f("field_value"), $aRadioButtonValues, $sDisabled , $iFileId, $sBlock);
                     break;
                     case "textarea":
                           $xtpl->assign('DOC_TYPE_TEXTAREA_LABEL', $qFieldLabel->f("field_label"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_REQ', $required);
                           $xtpl->assign('DOC_TYPE_TEXTAREA_NAME', $sql_custom->f("field_name"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_SIZE', $sql_custom->f("field_size"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_VALUE', $sql_custom_values->f("field_value"));
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.TextArea');
                     break;
                      case "checkbox":
                        if($sql_custom_values->f("field_value"))
                        {
                           $checked = "checked";
                        }
                        else
                        {
                           $checked = "";
                        }
                        $xtpl->assign('DOC_TYPE_CHECKBOX_LABEL', $qFieldLabel->f("field_label"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_CHECKED', $checked);
                        $xtpl->assign('DOC_TYPE_CHECKBOX_REQ', $required);
                        $xtpl->assign('DOC_TYPE_CHECKBOX_NAME', $sql_custom->f("field_name"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_VALUE', $sql_custom->f("field_name"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_DISABLED', $sDisabled);
                        $xtpl->parse('main.' . $sBlock . '.DocFields.Row.CheckBox');
                     break;
                  }
                  $xtpl->parse('main.' . $sBlock . '.DocFields.Row');
               }
      }
         if ($sql_custom->num_rows() > 0)
         {
               $xtpl->parse('main.' . $sBlock . '.DocFields.Footer');
         }
         $xtpl->parse('main.' . $sBlock . '.DocFields');
}
/*
*This Function display the custom field
*inside description popup window
* added by maurizio (madal2005)
*/

function fPopCustomFields ($iCurrentDocType, $iFileId)
{
   global $default, $language, $owl_lang, $cCommonDBConnection;

   $sql_custom = $cCommonDBConnection;

   if (empty($sql_custom))
   {
      $sql_custom = new Owl_DB;
   }

   $sPopCustomField = "";
   $sql_custom_values = new Owl_DB;

   $header_custpopup="<table class=\"title1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">". $owl_lang->cust_headpopup. "</td></tr></table>";
   $footer_custpopup="<table class=\"title1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" height=\"2px\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\"></td></tr></table>";

   if (!empty($iCurrentDocType))
   {
      $sql_custom->query("SELECT * from $default->owl_docfields_table where doc_type_id = '" . $iCurrentDocType. "'  order by field_position");
      $qFieldLabel = new Owl_DB;
      while ($sql_custom->next_record())
      {

         $sql_custom_values->query("SELECT  field_value from $default->owl_docfieldvalues_table where file_id = '" . $iFileId . "' and field_name = '" . $sql_custom->f("field_name") ."'");
         $values_result = $sql_custom_values->next_record();

         $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql_custom->f("id") . "'");
         $qFieldLabel->next_record();

         switch ($sql_custom->f("field_type"))
         {
            case "seperator":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  if ($sql_custom->f("field_position") > 1)
                  {
                     $sPopCustomField =  $qFieldLabel->f("field_label");
                  }
               }
            break;

            case "text":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=  $sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "picklist":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                    $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                    $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "mcheckbox":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $aMultipleCheckBoxLabel = split("\|",  $sql_custom->f("field_values"));
                  $aMultipleCheckBox = split("\|",  $sql_custom_values->f("field_value"));
                  $i = 0;
                  $iNumberColumns  = $sql_custom->f("field_size");
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  foreach ($aMultipleCheckBox as $sValues)
                  {
                     if (!empty($sValues))
                     {
                        $sPopCustomField.=$aMultipleCheckBoxLabel[$i]."|";
                     }
                     $aMultipleCheckBox[$i]= $sValues;
                     $i++;
                  }
                  $sPopCustomField.= substr($sPopCustomField,0,strlen($sPopCustomField)-1);
                  $sPopCustomField.= "<br>";
               }
            break;
            case "radio":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $aRadioButtons = array();
                  $aRadioButtons = split("\|",  $sql_custom->f("field_values"));
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  foreach ($aRadioButtons as $sValues)
                  {
                     if ($sValues == $sql_custom_values->f("field_value"))
                     {
                        $sPopCustomField.= $sValues;
                     }
                  }
               }
            break;
            case "textarea":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "checkbox":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
                  if($sql_custom_values->f("field_value"))
                  {
                     $checked = "checked";
                  }
                  else
                  {
                     $checked = "";
                  }
               }
            break;
         }
      }
   }
   if (strlen($sPopCustomField)>0)
   {
      $sPopCustomField = $header_custpopup . $sPopCustomField . $footer_custpopup;
   }

   return $sPopCustomField;
}

function fGetBrowserLanguage()
{
   global $default;

   $sBrowserLanguage =  substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

   switch ($sBrowserLanguage)
   {
      case "ar":
         $sOwlLang = "Arabic";
         break;
      case "bg":
         $sOwlLang = "Bulgarian";
         break;
      case "bg":
         $sOwlLang = "Catalan";
         break;
      case "cs":
         $sOwlLang = "Czech";
         break;
      case "da":
         $sOwlLang = "Danish";
         break;
      case "de":
         $sOwlLang = "Deutsch";
         break;
      case "el":
         $sOwlLang = "Hellinic";
         break;
      case "en":
         $sOwlLang = "English";
         break;
      case "es":
         $sOwlLang = "Spanish";
         break;
      case "et":
         $sOwlLang = "Estonian";
         break;
      case "fi":
         $sOwlLang = "Finnish";
         break;
      case "fr":
         $sOwlLang = "French";
         break;
      case "hu":
         $sOwlLang = "Hungarian";
         break;
      case "it":
         $sOwlLang = "Italian";
         break;
      case "ja":
         $sOwlLang = "Japanese";
         break;
      case "nl":
         $sOwlLang = "Dutch";
         break;
      case "no":
         $sOwlLang = "Norwegian";
         break;
      case "pl":
         $sOwlLang = "Polish";
         break;
      case "pt":
         if(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 5 == "pt-br"))
         {
            $sOwlLang = "Brazilian";
         }
         else
         { 
            $sOwlLang = "Portuguese";
         }
         break;
      case "ro":
         $sOwlLang = "Romanian";
         break;
      case "ru":
         $sOwlLang = "Russian";
         break;
      case "sk":
         $sOwlLang = "Slovak";
         break;
      case "sl":
         $sOwlLang = "Slovenian";
         break;
      case "sv":
         $sOwlLang = "Swedish";
      break;
      case "zh":
         $sOwlLang = "Chinese-b5";
         break;
      default:
         $sOwlLang = $default->owl_lang;
         break;
   }

   if(!file_exists($default->owl_LangDir . DIR_SEP . $sOwlLang))
   {
      $sOwlLang = $default->owl_lang;
   }
   return $sOwlLang; 
}
?>
