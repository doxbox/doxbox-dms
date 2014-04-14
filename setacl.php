<?php
/*
 * setacl.php
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
 * $Id: setacl.php,v 1.8 2006/09/29 02:28:34 b0zz Exp $
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

if ($action == "file_acl")
{
   $sAclType = "SETTING_FILE_ACL";
   
   $xtpl = new XTemplate("html/setacl_file.xtpl", "templates/$default->sButtonStyle");
   $xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
   $xtpl->assign('ROOT_URL', $default->owl_root_url);
   $xtpl->assign('SETACL_FILE_PAGE_TITLE', $owl_lang->setacl_file_page_title);
}
else
{
   $sAclType = "SETTING_FOLDER_ACL";
   
   $xtpl = new XTemplate("html/setacl_folder.xtpl", "templates/$default->sButtonStyle");
   $xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
   $xtpl->assign('ROOT_URL', $default->owl_root_url);
   $xtpl->assign('SETACL_FOLDER_PAGE_TITLE', $owl_lang->setacl_folder_page_title);
}

if (!is_numeric($id))
{
   $aFileIDs = unserialize(stripslashes($id));
   $id = $aFileIDs[0];
}

$groups = fGetGroups($userid, $sAclType, $id);

$groups[-1][0] = "-1";
$groups[-1][1] = "None";

$aUserList = fGetUserInfoInMyGroups($userid, "disabled = '0'", false, $sAclType, $id);

$aUserList[0]['username'] = "everybody";
$aUserList[0]['name'] = "EVERYBODY";
$aUserList[0]['email'] = "";
$aUserList[0]['id'] = "0";

fSetLogo_MOTD();
fSetPopupHelp();

if($edit == 1)
{
   if ($action == "file_acl" and check_auth($id, "file_acl", $userid) == 1)
   {
      $selectedgroups = array(); 
      $qSetAcl = "SELECT * FROM $default->owl_advanced_acl_table where file_id = '$id'";
      $sql = new Owl_DB;
      $sql->query($qSetAcl);
      while ($sql->next_record())
      {
         if($sql->f("group_id") == null )
         {
            $selectedusers[] = $sql->f("user_id");
         }
         else
         {
            $selectedgroups[] = $sql->f("group_id");
         }
      }
   }
   //elseif (($action == "folder_acl" and fIsFolderCreator($id)) or ($action == "folder_acl" and fisAdmin()))
   elseif ($action == "folder_acl" and check_auth($id, "folder_acl", $userid) == 1)
   {
      $fselectedgroups = array(); 
      $qSetAcl = "SELECT * FROM $default->owl_advanced_acl_table where folder_id = '$id'";
      $sql = new Owl_DB;
      $sql->query($qSetAcl);
      while ($sql->next_record())
      {
         if($sql->f("group_id") == null )
         {
            $fselectedusers[] = $sql->f("user_id");
         }
         else
         {
            $fselectedgroups[] = $sql->f("group_id");
         }
      }
   }
   else
   {
      include_once($default->owl_fs_root ."/lib/header.inc");
      include_once($default->owl_fs_root ."/lib/userheader.inc");
      printError($owl_lang->err_nofilemod);
   }
}

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");
?>
<script type="text/javascript">
var IE = document.all?true:false
if (!IE) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseY;

function getMouseY(e) {
  if (IE) { // grab the x-y pos.s if browser is IE
    tempY = event.clientY + document.body.scrollTop
  } else {  // grab the x-y pos.s if browser is NS
    tempY = e.pageY
  }
  return true;
}

</script>
<?php

if ($sess == "0" && $default->anon_ro > 0)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

if(!isset($type))
{
   $type = "";
}

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
if(!empty($page))
{
   $urlArgs['page']    = $page;
}
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Top");
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}



if ($action == "folder_acl")
{
   if (check_auth($id, "folder_acl", $userid) == 1)
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['expand'] = $expand;
      $urlArgs2['id']     = $id;
      $urlArgs2['action']  = "folder_acl";

      if($edit == 1)
      {
         fPrintNavBarXTPL($id,$owl_lang->acl_edit_folder . " ");
      }
      else
      {
         fPrintNavBarXTPL($id,$owl_lang->acl_adding_folder . " ");
      }


      $xtpl->assign('FORM', "<form action=\"setacl.php\" method=\"post\" name=\"fcombo_box\">");
      $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      $xtpl->assign('FOLDER_SECTION_HEADING', $owl_lang->acl_heading_folders);

if ($default->show_users_in_group == '1')
{
   ?>
<script type="text/javascript">
//Function alerts the index of the selected option within form

var ftooltipContentData = [

<?php

   $qGetUserMember = new Owl_DB;

   foreach($groups as $g)
   {
      if ($g[0] == -1)
      {
         continue;
      }

      if (!empty($fselectedgroups))
      {
         if (!(in_array($g[0], $fselectedgroups)))
         {
            $qSetAcl = "SELECT distinct id,name, username FROM $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id = m.userid where u.groupid = '$g[0]' or m.groupid = '$g[0]'";
            $qGetUserMember->query($qSetAcl);

            print("'<table>");
            if ($qGetUserMember->num_rows() == 0)
            {
               print("<tr><td>None</td></tr>");
            }
            while($qGetUserMember->next_record())
            {
               print("<tr><td>" . $qGetUserMember->f('name') . "</td><td>(" . $qGetUserMember->f('username') . ")</td></tr>");
            }
            print("</table>',\n");
         }
      }
      else
      {
         $qSetAcl = "SELECT distinct id,name, username FROM $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id = m.userid where u.groupid = '$g[0]' or m.groupid = '$g[0]'";
         $qGetUserMember->query($qSetAcl);

         print("'<table>");
	 if ($qGetUserMember->num_rows() == 0)
	 {
	    print("<tr><td>None</td></tr>");
	 }
         while($qGetUserMember->next_record())
         {
            print("<tr><td>" . $qGetUserMember->f('name') . "</td><td>(" . $qGetUserMember->f('username') . ")</td></tr>");
         }
         print("</table>',\n");
      }

   }
   print ("''\n");

?>
];

var ftooltipCaptionData = [

<?php

   $qGetUserMember = new Owl_DB;

   foreach($groups as $g)
   {
      if ($g[0] == -1)
      {
         continue;
      }

      if (!empty($fselectedgroups))
      {
         if (!(in_array($g[0], $fselectedgroups)))
         {
            print("'Users in: $g[1]',");
         }
      }
      else
      {
         print("'Users in: $g[1]',");
      }

   }
   print ("''\n");

?>
];


var ftooltipContentIndex = 0;
function fgetTooltipContent() {
	return ftooltipContentData[ftooltipContentIndex];
}
function fgetTooltipCaption() {
	return ftooltipCaptionData[ftooltipContentIndex];
}

function fgetselectedvalue(gbox){
return(gbox.selectedIndex)
}
</script>
<?php
}

	  $xtpl->assign('FOLDER_SECTION_AVAILABLE_GRPS', $owl_lang->acl_available_groups);
	  $xtpl->assign('FOLDER_SECTION_SELECTED_GRPS', $owl_lang->acl_selected_groups);


if ($default->show_users_in_group == '1')
{
      $xtpl->assign('ON_CHANGE', " onchange=\"ftooltipContentIndex = fgetselectedvalue(this); domTT_activate(this, event, 'content', fgetTooltipContent(), 'type', 'sticky', 'closeLink', '&nbsp; [x] &nbsp;', 'draggable', true, 'closeAction', 'destroy',  'caption' , fgetTooltipCaption(), 'x', 50, 'y', tempY);\"");

}
      foreach($groups as $g)
      {
         if ($g[0] == -1)
         {
            continue;
         }
         $xtpl->assign('ALL_GROUPS_VALUE', '');
         $xtpl->assign('ALL_GROUPS_CAPTION', '');
         $xtpl->assign('ALL_GROUPS_SELECTED', '');
         if (!empty($fselectedgroups))
         {
            if (!(in_array($g[0], $fselectedgroups)))
            {
               $xtpl->assign('ALL_GROUPS_VALUE', $g[0]);
               $xtpl->assign('ALL_GROUPS_CAPTION', $g[1]);
               $xtpl->assign('ALL_GROUPS_SELECTED', '');
               $xtpl->parse('main.fAllGroups');
            }
         }
         else
         {
            $xtpl->assign('ALL_GROUPS_VALUE', $g[0]);
            $xtpl->assign('ALL_GROUPS_CAPTION', $g[1]);
            $xtpl->assign('ALL_GROUPS_SELECTED', '');
            $xtpl->parse('main.fAllGroups');
         }
      }

     if (!empty($groups))
      {
         foreach($groups as $g)
         {
            if ($g[0] == -1)
            {
               continue;
            }
            if (!empty($fselectedgroups))
            {
               $xtpl->assign('SELECTED_GROUPS_VALUE', '');
               $xtpl->assign('SELECTED_GROUPS_CAPTION', '');
               $xtpl->assign('SELECTED_GROUPS_SELECTED', '');
               if ((in_array($g[0], $fselectedgroups)))
               {
                  $xtpl->assign('SELECTED_GROUPS_VALUE', $g[0]);
                  $xtpl->assign('SELECTED_GROUPS_CAPTION', $g[1]);
                  $xtpl->assign('SELECTED_GROUPS_SELECTED', '');
                  $xtpl->parse('main.fSelectedGroups');
               }
            }
         }
      }

      $xtpl->assign('FOLDER_SECTION_AVAILABLE_USERS', $owl_lang->acl_available_users);
      $xtpl->assign('FOLDER_SECTION_SELECTED_USERS', $owl_lang->acl_selected_users);


      if (!empty($aUserList))
      {
         foreach ($aUserList as $aUsers)
         {
            $xtpl->assign('ALL_USERS_VALUE', '');
            $xtpl->assign('ALL_USERS_SELECTED', '');
            $xtpl->assign('ALL_USERS_CAPTION', '');
            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            if (!empty($fselectedusers))
            {
               if (!(in_array($sId, $fselectedusers)))
               {
                  $xtpl->assign('ALL_USERS_VALUE', $sId);
                  $xtpl->assign('ALL_USERS_SELECTED', '');
                  $xtpl->assign('ALL_USERS_CAPTION', $sName .  $sEmail);
                  $xtpl->parse('main.fAllUsers');
               }
            }
            else
            {
               $xtpl->assign('ALL_USERS_VALUE', $sId);
               $xtpl->assign('ALL_USERS_SELECTED', '');
               $xtpl->assign('ALL_USERS_CAPTION', $sName .  $sEmail);
               $xtpl->parse('main.fAllUsers');
            }
         }
      }

      if (!empty($aUserList))
      {
         foreach ($aUserList as $aUsers)
         {
            $xtpl->assign('SELECTED_USERS_VALUE', '');
            $xtpl->assign('SELECTED_USERS_SELECTED', '');
            $xtpl->assign('SELECTED_USERS_CAPTION', '');

            $sUsername = $aUsers["username"];
            $sId = $aUsers["id"];
            $sName = $aUsers["name"];
            if(!empty($aUsers["email"]))
            {
               $sEmail = " (" . $aUsers["email"] . ")";
            }
            else
            {
               $sEmail = "";
            }
            if (!empty($fselectedusers))
            {
               if ((in_array($sId, $fselectedusers)))
               {
                  $xtpl->assign('SELECTED_USERS_VALUE', $sId);
                  $xtpl->assign('SELECTED_USERS_CAPTION', $sName . $sEmail);
                  $xtpl->assign('SELECTED_USERS_SELECTED', '');
                  $xtpl->parse('main.fSelectedUsers');
               }
            }
         }
      }

      if (!fIsAdmin())
      {
         $xtpl->assign('SET_SELECTED', $owl_lang->acl_set_selected);
         $xtpl->assign('ON_CLICK', "onclick=\"selectAll(document.fcombo_box.elements['fselectedusers[]']); selectAll(document.fcombo_box.elements['fselectedgroups[]']);\"");
         $xtpl->parse('main.fFolderSetSel');

      }
      if (fIsAdmin())
      {
         fPrintSelectFileUserGroups("admin");
      }

      $xtpl->assign('SETACL_FORM', "<form action=\"dbmodify.php\" method=\"post\" name=\"set_facl\">");
      $xtpl->assign('SETACL_HIDDEN', fGetHiddenFields($urlArgs2));

      $xtpl->assign('SET_FOLDER_PERM', $owl_lang->acl_set_folder_permissions);
      $xtpl->assign('HEADING_FOLDER_PERM', $owl_lang->acl_heading_folder);

      $owl_lang->acl_folder_properties = $owl_lang->acl_folder_modify;
      $owl_lang->acl_folder_setacl = $owl_lang->acl_folder_set_acl;

      $owl_lang->acl_folder_update = "(FH) " . $owl_lang->acl_file_update;
      $owl_lang->acl_folder_viewlog = "(FH) " . $owl_lang->acl_file_view_log;
      $owl_lang->acl_folder_comment = "(FH) " . $owl_lang->acl_file_comment;
      $owl_lang->acl_folder_checkin = "(FH) " . $owl_lang->acl_file_checkin;
      $owl_lang->acl_folder_email = "(FH) " . $owl_lang->acl_file_email;
      $owl_lang->acl_folder_relsearch = "(FH) " . $owl_lang->acl_file_search;

      foreach($default->acl_folder_types as $aclType)
      {
        $langElement = "acl_folder_" . $aclType;
         $xtpl->assign('FOLDER_TITLE_URL', "javascript:fcheckowl$aclType();");
         $xtpl->assign('FOLDER_TITLE_LABEL', $owl_lang->$langElement);
         $xtpl->parse('main.FolderPermTitle');
      }


      $CountLines = 0;
      if(!empty($fselectedgroups))
      {
         foreach ($fselectedgroups as $val)
         {
            if($val == -1)
            {
               continue;
            }
            $CountLines++;
            $PrintLines = $CountLines % 2;
            if ($PrintLines == 0)
            {
               $xtpl->assign('TR_COLOR', 'file1');
            }
            else
            {
               $xtpl->assign('TR_COLOR', 'file2');
            }

            $xtpl->assign('FILE_USER_GRP_IMG', "group");
            $xtpl->assign('FILE_USER_GRP_TOOLTIP', "G" . $val);
            $xtpl->assign('FOLDER_USER_GRP_URL', "javascript:checkFG" . $val ."()");
            $xtpl->assign('FOLDER_USER_GRP_LABEL', group_to_name($val));

            foreach($default->acl_folder_types as $aclType)
            {
               $xtpl->assign('FOLDER_USER_GRP_NAME', "fgacl_owl" . $aclType . "_" . $val);
               $xtpl->assign('FOLDER_USER_GRP_VALUE', $val);
               $xtpl->assign('FOLDER_USER_GRP_CHECKED', fGetFAclChecked($id, $val, "owl" . $aclType));
               $xtpl->parse('main.FolderPermUsrGrp.FolderPermUsrGrpAcl');
            }
            $xtpl->parse('main.FolderPermUsrGrp');
         }
      }

      if(!empty($fselectedusers))
      {
         foreach ($fselectedusers as $val)
         {
            $CountLines++;
            $PrintLines = $CountLines % 2;
            if ($PrintLines == 0)
            {
               $xtpl->assign('TR_COLOR', 'file1');
            }
            else
            {
               $xtpl->assign('TR_COLOR', 'file2');
            }

            $xtpl->assign('FILE_USER_GRP_IMG', "user");
            $xtpl->assign('FILE_USER_GRP_TOOLTIP', "U" . $val);
            $xtpl->assign('FOLDER_USER_GRP_URL', "javascript:checkFU" . $val ."()");

            $xtpl->assign('FOLDER_USER_GRP_LABEL', 'EVERYBODY');
            if ($val != '0')
            {
               $xtpl->assign('FOLDER_USER_GRP_LABEL', uid_to_name($val));
            }

            foreach($default->acl_folder_types as $aclType)
            {
               $xtpl->assign('FOLDER_USER_GRP_NAME', "facl_owl" . $aclType . "_" . $val);
               $xtpl->assign('FOLDER_USER_GRP_VALUE', $val);
               $xtpl->assign('FOLDER_USER_GRP_CHECKED', fGetFAclChecked($id, $val, "owl" .$aclType, "user"));
               $xtpl->parse('main.FolderPermUsrGrp.FolderPermUsrGrpAcl');
            }
            $xtpl->parse('main.FolderPermUsrGrp');
         }
     }

     if ($default->user_can_propagate_acl or fIsAdmin())
     {
        $xtpl->assign('FOLDER_PROPAGATE_LABEL', $owl_lang->acl_propagate_folders);
        $xtpl->parse('main.FolderPermPropagate');

     }
     if (!fIsAdmin())
     {
        $xtpl->assign('LABEL_ADD_USER', $owl_lang->acl_user);
        $xtpl->assign('LABEL_ADD_GROUP', $owl_lang->acl_group);
        $xtpl->assign('BTN_ADD_USER', $owl_lang->acl_add_user);
        $xtpl->assign('BTN_ADD_GROUP', $owl_lang->acl_add_group);
        $xtpl->assign('BTN_SAVE', $owl_lang->btn_acl_save);
        $xtpl->assign('BTN_SAVE_ALT', $owl_lang->alt_btn_acl_save_file);
        $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
        $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

     }

     if (fIsAdmin())
     {
        fPrintSetFileAcl($id, "admin");
        $xtpl->parse('main.FileSecurity');
     }
   }
}
elseif ($action == "file_acl")
{
   if (check_auth($id, "file_acl", $userid) == 1)
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['expand'] = $expand;
      if(!empty($aFileIDs))
      {
         $urlArgs2['id']     = serialize($aFileIDs);
      }
      else
      {
         $urlArgs2['id']     = $id;
      }

      $urlArgs2['action']  = "file_acl";

      if($edit == 1)
      {
         fPrintNavBarXTPL($parent,$owl_lang->acl_edit_file . " ", $id);
      }
      else
      {
         fPrintNavBarXTPL($parent,$owl_lang->acl_adding_file . " ", $id);
      }

	  $xtpl->assign('FORM', "<form action=\"setacl.php\" method=\"post\" name=\"combo_box\">");
	  $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

      fPrintSelectFileUserGroups();

      $xtpl->assign('SETACL_FORM', "<form action=\"dbmodify.php\" method=\"post\" name=\"set_acl\">");
      $xtpl->assign('SETACL_HIDDEN', fGetHiddenFields($urlArgs2));

      fPrintSetFileAcl($id);
      
      $xtpl->parse('main.FileSecurity');
   }
   else
   {
      printError($owl_lang->err_nofilemod);
   } 
}


if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');


function fPrintSetFileAcl($id, $type = "user")
{
      global $default, $owl_lang, $groups, $selectedgroups, $aUserList, $selectedusers ;
      global $xtpl;

      $xtpl->assign('SET_FILE_PERM', $owl_lang->acl_set_file_permissions);
      $xtpl->assign('HEADING_FILE_PERM', $owl_lang->acl_heading_file);

       $xtpl->assign('ACL_VIEW_MEMBERSHIP', $owl_lang->acl_view_membership);
       $xtpl->assign('ACL_REMOVE_ACL',  $owl_lang->acl_remove_acl);

      $owl_lang->acl_file_properties = $owl_lang->acl_file_modify;
      $owl_lang->acl_file_setacl = $owl_lang->acl_file_set_acl;
      $owl_lang->acl_file_viewlog = $owl_lang->acl_file_view_log;
      $owl_lang->acl_file_relsearch = $owl_lang->acl_file_search;

      foreach($default->acl_file_types as $aclType)
      {
         $langElement = "acl_file_" . $aclType;

         $xtpl->assign('FILE_TITLE_URL', "javascript:checkowl$aclType();");
         $xtpl->assign('FILE_TITLE_LABEL', $owl_lang->$langElement);
         if ($type == "admin")
         {
            $xtpl->parse('main.FilePermTitle');
         }
         else
         {
            $xtpl->parse('main.FileSecurity.FilePermTitle');
         }

      }

      $CountLines = 0;
      if(!empty($selectedgroups))
      {
         foreach ($selectedgroups as $val)
         {
            if($val == -1)
            {
               continue;
            }
            $CountLines++;
            $PrintLines = $CountLines % 2;
            if ($PrintLines == 0)
            { 
              $xtpl->assign('TR_COLOR', 'file1');
            }
            else
            {
              $xtpl->assign('TR_COLOR', 'file2');
            }

            $xtpl->assign('FILE_USER_GRP_IMG', "group");
            $xtpl->assign('FILE_USER_GRP_TOOLTIP', "G" . $val);
            $xtpl->assign('FILE_USER_GRP_URL', "javascript:checkG" . $val ."()");
            $xtpl->assign('FILE_USER_GRP_LABEL', group_to_name($val));

            foreach($default->acl_file_types as $aclType)
            {
               $xtpl->assign('FILE_USER_GRP_NAME', "gacl_owl" . $aclType . "_" . $val);
               $xtpl->assign('FILE_USER_GRP_VALUE', $val);
               $xtpl->assign('FILE_USER_GRP_CHECKED', fGetAclChecked($id, $val, "owl" . $aclType));
               if ($type == "admin")
               {
                  $xtpl->parse('main.FilePermUsrGrp.FilePermUsrGrpAcl');
               }
               else
               {
                  $xtpl->parse('main.FileSecurity.FilePermUsrGrp.FilePermUsrGrpAcl');
               }
            }
            if ($type == "admin")
            {
               $xtpl->parse('main.FilePermUsrGrp');
            }
            else
            {
               $xtpl->parse('main.FileSecurity.FilePermUsrGrp');
            }
         }
      }

      if(!empty($selectedusers))
      {
         foreach ($selectedusers as $val)
         {
            $CountLines++;
            $PrintLines = $CountLines % 2;
            if ($PrintLines == 0)
            {
               $xtpl->assign('TR_COLOR', 'file1');
            }
            else
            {
               $xtpl->assign('TR_COLOR', 'file2');
            }

            $xtpl->assign('FILE_USER_GRP_IMG', "user");
            $xtpl->assign('FILE_USER_GRP_TOOLTIP', "U" . $val);
            $xtpl->assign('FILE_USER_GRP_URL', "javascript:checkU" . $val ."()");
            $xtpl->assign('FILE_USER_GRP_LABEL', 'EVERYBODY');
            if ($val != '0')
            {
               $xtpl->assign('FILE_USER_GRP_LABEL', uid_to_name($val));
            }
            foreach($default->acl_file_types as $aclType)
            {
               $xtpl->assign('FILE_USER_GRP_NAME', "acl_owl" . $aclType . "_" . $val);
               $xtpl->assign('FILE_USER_GRP_VALUE', $val);
               $xtpl->assign('FILE_USER_GRP_CHECKED', fGetAclChecked($id, $val, "owl$aclType", "user"));
               if ($type == "admin")
               {
                  $xtpl->parse('main.FilePermUsrGrp.FilePermUsrGrpAcl');
               }
               else
               {
                  $xtpl->parse('main.FileSecurity.FilePermUsrGrp.FilePermUsrGrpAcl');
               }
            }
            if ($type == "admin")
            {
               $xtpl->parse('main.FilePermUsrGrp');
            }
            else
            {
               $xtpl->parse('main.FileSecurity.FilePermUsrGrp');
            }
         }
      }

      if ($type == "admin")
      {
         $xtpl->assign('FILE_PROPAGATE_LABEL', $owl_lang->acl_propagate_file);
         $xtpl->parse('main.FilePermPropagate');
      }

      $xtpl->assign('LABEL_ADD_USER', $owl_lang->acl_user);
      $xtpl->assign('LABEL_ADD_GROUP', $owl_lang->acl_group);
      $xtpl->assign('BTN_ADD_USER', $owl_lang->acl_add_user);
      $xtpl->assign('BTN_ADD_GROUP', $owl_lang->acl_add_group);
      $xtpl->assign('BTN_SAVE', $owl_lang->btn_acl_save);
      $xtpl->assign('BTN_SAVE_ALT', $owl_lang->alt_btn_acl_save_file);
      $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
      $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);
}

function fPrintSelectFileUserGroups($type = "user")
{
   global $default, $owl_lang, $groups, $selectedgroups, $aUserList, $selectedusers;
   global $xtpl;

   $xtpl->assign('FILE_SECTION_HEADING', $owl_lang->acl_heading_files);
   $xtpl->assign('FILE_SECTION_AVAILABLE_GRPS', $owl_lang->acl_available_groups);
   $xtpl->assign('FILE_SECTION_SELECTED_GRPS', $owl_lang->acl_selected_groups);
   if ($default->show_users_in_group == '1')
   {
?>
<script type="text/javascript">
//Function alerts the index of the selected option within form

var tooltipContentData = [

<?php

   $qGetUserMember = new Owl_DB;
   
   foreach($groups as $g)
   {
      if ($g[0] == -1)
      {
         continue;
      }

      if (!empty($selectedgroups))
      {
         if (!(in_array($g[0], $selectedgroups)))
         {
            $qSetAcl = "SELECT distinct id,name, username FROM $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id = m.userid where u.groupid = '$g[0]' or m.groupid = '$g[0]'";
            $qGetUserMember->query($qSetAcl);

            print("'<table>");
            if ($qGetUserMember->num_rows() == 0)
            {
               print("<tr><td>None</td></tr>");
            }
            while($qGetUserMember->next_record())
            {
               print("<tr><td>" . $qGetUserMember->f('name') . "</td><td>(" . $qGetUserMember->f('username') . ")</td></tr>");
            }
            print("</table>',\n");
         }
      }
      else
      {
         $qSetAcl = "SELECT distinct id,name, username FROM $default->owl_users_table u left join $default->owl_users_grpmem_table m on u.id = m.userid where u.groupid = '$g[0]' or m.groupid = '$g[0]'";
         $qGetUserMember->query($qSetAcl);

         print("'<table>");
         if ($qGetUserMember->num_rows() == 0)
         {
            print("<tr><td>None</td></tr>");
         }
         while($qGetUserMember->next_record())
         {
            print("<tr><td>" . $qGetUserMember->f('name') . "</td><td>(" . $qGetUserMember->f('username') . ")</td></tr>");
         }
         print("</table>',\n");
      }

   }
   print ("''\n");

?>
];

var tooltipCaptionData = [

<?php

   $qGetUserMember = new Owl_DB;

   foreach($groups as $g)
   {
      if ($g[0] == -1)
      {
         continue;
      }

      if (!empty($selectedgroups))
      {
         if (!(in_array($g[0], $selectedgroups)))
         {
            print("'Users in: $g[1]',");
         }
      }
      else
      {
         print("'Users in: $g[1]',");
      }

   }
   print ("''\n");

?>
];


var tooltipContentIndex = 0;
function getTooltipContent() {
	return tooltipContentData[tooltipContentIndex];
}
function getTooltipCaption() {
	return tooltipCaptionData[tooltipContentIndex];
}

function getselectedvalue(gbox){
return(gbox.selectedIndex)
}

</script>
<?php
}
if ($default->show_users_in_group == '1')
{
  $xtpl->assign('ON_CHANGE', " onchange=\"tooltipContentIndex = getselectedvalue(this); domTT_activate(this, event, 'content', getTooltipContent(), 'type', 'sticky', 'closeLink', '&nbsp; [x] &nbsp; ', 'draggable', true, 'closeAction', 'destroy', 'caption' , getTooltipCaption(), 'x', 50, 'y', tempY);\"");
}


   foreach($groups as $g)
   {
      if ($g[0] == -1)
      {
         continue;
      }
      $xtpl->assign('ALL_GROUPS_VALUE', '');
      $xtpl->assign('ALL_GROUPS_SELECTED', '');
      $xtpl->assign('ALL_GROUPS_CAPTION', '');
      if (!empty($selectedgroups))
      {
         if (!(in_array($g[0], $selectedgroups)))
         {
            $xtpl->assign('ALL_GROUPS_VALUE', $g[0]);
            $xtpl->assign('ALL_GROUPS_CAPTION', $g[1]);
            $xtpl->assign('ALL_GROUPS_SELECTED', '');
            if ($type == 'admin')
            {
               $xtpl->parse('main.FileSecurity.AllGroups');
            }
            else
            {
               $xtpl->parse('main.FileSecurity.AllGroups');
            }
         }
      }
      else
      {
            $xtpl->assign('ALL_GROUPS_VALUE', $g[0]);
            $xtpl->assign('ALL_GROUPS_CAPTION', $g[1]);
            $xtpl->assign('ALL_GROUPS_SELECTED', '');
            if ($type == 'admin')
            {
               $xtpl->parse('main.FileSecurity.AllGroups');
            }
            else
            {
               $xtpl->parse('main.FileSecurity.AllGroups');
            }
      }

   }

   if (!empty($groups))
   {
      foreach($groups as $g)
      {
         if ($g[0] == -1)
         {
            continue;
         }
         if (!empty($selectedgroups))
         {
            if ((in_array($g[0], $selectedgroups)))
            {
               $xtpl->assign('SELECTED_GROUPS_VALUE', $g[0]);
               $xtpl->assign('SELECTED_GROUPS_CAPTION', $g[1]);
               $xtpl->assign('SELECTED_GROUPS_SELECTED', '');
               if ($type == 'admin')
               {
                  $xtpl->parse('main.FileSecurity.SelectedGroups');
               }
               else
               {
                  $xtpl->parse('main.FileSecurity.SelectedGroups');
               }
            }
         }
      }
   }

   $xtpl->assign('FILE_SECTION_AVAILABLE_USERS', $owl_lang->acl_available_users);
   $xtpl->assign('FILE_SECTION_SELECTED_USERS', $owl_lang->acl_selected_users);

   if (!empty($aUserList))
   {
      foreach ($aUserList as $aUsers)
      {
         $xtpl->assign('ALL_USERS_VALUE', '');
         $xtpl->assign('ALL_USERS_SELECTED', '');
         $xtpl->assign('ALL_USERS_CAPTION', '');

         $sUsername = $aUsers["username"];
         $sId = $aUsers["id"];
         $sName = $aUsers["name"];
         if(!empty($aUsers["email"]))
         {
            $sEmail = " (" . $aUsers["email"] . ")";
         }
         else
         {
            $sEmail = "";
         }

         if (!empty($selectedusers))
         {
            if (!(in_array($sId, $selectedusers)))
            {
               $xtpl->assign('ALL_USERS_VALUE', $sId);
               $xtpl->assign('ALL_USERS_SELECTED', '');
               $xtpl->assign('ALL_USERS_CAPTION', $sName .  $sEmail);
               if ($type == 'admin')
               {
                  $xtpl->parse('main.FileSecurity.AllUsers');
               }
               else
               {
                  $xtpl->parse('main.FileSecurity.AllUsers');
               }
            }
            else
            {
               $xtpl->assign('SELECTED_USERS_VALUE', $sId);
               $xtpl->assign('SELECTED_USERS_SELECTED', '');
               $xtpl->assign('SELECTED_USERS_CAPTION', $sName .  $sEmail);
               if ($type == 'admin')
               {
                  $xtpl->parse('main.FileSecurity.SelectedUsers');
               }
            }
         }
         else
         {
            $xtpl->assign('ALL_USERS_VALUE', $sId);
            $xtpl->assign('ALL_USERS_SELECTED', '');
            $xtpl->assign('ALL_USERS_CAPTION', $sName .  $sEmail);
            if ($type == 'admin')
            {
               $xtpl->parse('main.FileSecurity.AllUsers');
            }
            else
            {
               $xtpl->parse('main.FileSecurity.AllUsers');
            }
         }
      }
   }

   if (!empty($aUserList))
   {
      foreach ($aUserList as $aUsers)
      {
         $xtpl->assign('SELECTED_USERS_VALUE', '');
         $xtpl->assign('SELECTED_USERS_SELECTED', '');
         $xtpl->assign('SELECTED_USERS_CAPTION', '');

         $sUsername = $aUsers["username"];
         $sId = $aUsers["id"];
         $sName = $aUsers["name"];
         if(!empty($aUsers["email"]))
         {
            $sEmail = " (" . $aUsers["email"] . ")";
         }
         else
         {
            $sEmail = "";
         }
         if (!empty($selectedusers))
         {
            if ((in_array($sId, $selectedusers)))
            {
               $xtpl->assign('SELECTED_USERS_VALUE', $sId);
               $xtpl->assign('SELECTED_USERS_CAPTION', $sName . $sEmail);
               $xtpl->assign('SELECTED_USERS_SELECTED', '');
               if ($type == 'admin')
               {
                  $xtpl->parse('main.AllUsers');
               }
               else
               {
                  $xtpl->parse('main.FileSecurity.SelectedUsers');
               }

            }
         }
      }
   }

   $xtpl->assign('SET_SELECTED', $owl_lang->acl_set_selected);
   if ($type == "admin")
   {
      $xtpl->assign('ON_CLICK', "onclick=\"selectAll(document.fcombo_box.elements['selectedusers[]']); selectAll(document.fcombo_box.elements['selectedgroups[]']); selectAll(document.fcombo_box.elements['fselectedusers[]']); selectAll(document.fcombo_box.elements['fselectedgroups[]']);fcombo_box.submit();\"");
   }
   else
   {
      $xtpl->assign('ON_CLICK', "onclick=\"selectAll(document.combo_box.elements['selectedusers[]']); selectAll(document.combo_box.elements['selectedgroups[]']);combo_box.submit();\"");
   }
}
?>
