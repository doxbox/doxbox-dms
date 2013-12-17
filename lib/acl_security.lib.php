<?php
/*
 * acl_security.lib.php
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

defined( 'OWL_INCLUDE' ) or die( 'Access Denied' );

//
// This function is simple...it returns either a 1 or 0
// If the authentication is good, it returns 1
// If the authentication is bad, it returns 0
//

function check_auth($id, $action, $checkuserid, $report = false, $recursive = true) 
{
   global $default;
   global $owl_lang;
   global $usergroupid, $userid;
   global $aMyGroupAdmin;

   if ($userid == $checkuserid)
   {
      $usergroup = $usergroupid;
   }
   else
   {
      $usergroup = owlusergroup($checkuserid);
   }


   //print(" FUNCTION CALLED: $action <br />");

	//$filecreator = owlfilecreator($id);
	//$foldercreator = owlfoldercreator($id);

    $bCheckFolder = false;
    list($type, $sub) = split("_", $action);
    if ($type == "folder")
    {
       $bCheckFolder = true;
    }

    switch ($action)
        {
           case "folder_delete":
           case "file_delete":
              $acl = "owldelete";
              break;
           case "folder_property":
           case "file_property":
              $acl = "owlproperties";
              break;
           case "folder_cp":
           case "file_cp":
              $acl = "owlcopy";
              break;
           case "folder_move":
           case "file_move":
           case "file_lnk":
              $acl = "owlmove";
              break;
           case "folder_acl":
              $acl = "owlsetacl";
              $sAclType = "SETTING_FILE_ACL";
              break;
           case "file_acl":
              $acl = "owlsetacl";
              $sAclType = "SETTING_FOLDER_ACL";
              break;
           case "folder_view":
           case "file_download":
              $acl = "owlread";
              break;
           case "folder_create":
              $acl = "owlwrite";
              break;
           case "folder_monitor":
           case "file_monitor":
              $acl = "owlmonitor";
              break;
           case "file_comment":
              $acl = "owlcomment";
              break;
           case "file_update":
              $acl = "owlupdate";
              break;
           case "file_log":
              $acl = "owlviewlog";
              break;
           case "file_lock":
              $acl = "owlcheckin";
              break;
           case "file_email":
              $acl = "owlemail";
              break;
           case "file_all":
              $acl = "file_all";
              break;
           default:
              $acl = "";
              break;
        }

/* $aAclList[] = "owlread";
$aAclList[] = "owlwrite";
$aAclList[] = "owlviewlog";
$aAclList[] = "owldelete";
$aAclList[] = "owlcopy";
$aAclList[] = "owlmove";
$aAclList[] = "owlproperties";
$aAclList[] = "owlupdate";
$aAclList[] = "owlcomment";
$aAclList[] = "owlcheckin";
$aAclList[] = "owlemail";
$aAclList[] = "owlrelsearch";
$aAclList[] = "owlsetacl";
$aAclList[] = "owlmonitor";
*/
   if ($bCheckFolder and empty($sAclType))
   {
      $sAclType = "FOLDER"; 
   }
   if (empty($sAclType))
   {
      $sAclType = "FILE"; 
   } 

   if (fIsAdmin())
   {
      $groups = array();
   }
   else
   {
      $groups = array();
      $groups = fGetGroups($checkuserid, $sAclType, $id);
   }


   if ($acl == "file_all")
   {
      $filegroup = owlfilegroup($id);
      if (in_array($filegroup, $aMyGroupAdmin))
      //if (fIsGroupAdmin($checkuserid, $filegroup))
      {
         $aFileAccess = array();
         $aFileAccess['owlread'] = 1;
         $aFileAccess['owlwrite'] = 1;
         $aFileAccess['owlviewlog'] = 1;
         $aFileAccess['owldelete'] = 1;
         $aFileAccess['owlcopy'] = 1;
         $aFileAccess['owlmove'] = 1;
         $aFileAccess['owlproperties'] = 1;
         $aFileAccess['owlupdate'] = 1;
         $aFileAccess['owlcomment'] = 1;
         $aFileAccess['owlcheckin'] = 1;
         $aFileAccess['owlemail'] = 1;
         $aFileAccess['owlrelsearch'] = 1;
         $aFileAccess['owlsetacl'] = 1;
         $aFileAccess['owlmonitor'] = 1;
         return $aFileAccess;
      }
      else
      {
         return fGetAllAclChecked($id, $groups );
      }
   }

   if ($bCheckFolder)
   {
      if(owlfoldercreator($id) == $checkuserid)
      {
         return PERMIT;
      }

      $foldergroup = owlfoldergroup($id);

      if (in_array($foldergroup, $aMyGroupAdmin))
      //if (fIsGroupAdmin($checkuserid, $foldergroup))
      {
        return PERMIT;
      } 


      //foreach($groups as $g)
      //{
         //$result = fGetFAclChecked($id, $g[0], $acl, "group");

         $result = fGetFAclChecked($id, $groups, $acl, "group");

         if(!empty($result))
         {
           return PERMIT;
         }
      //}

      $result = fGetFAclChecked($id, $checkuserid, $acl, "user_or_everyone");
      if(!empty($result))
      {
         return PERMIT;
      }
      //$result = fGetFAclChecked($id, EVERYONE, $acl, "user");
      //if(!empty($result))
      //{
         //return PERMIT;
      //}
   }
   else
   {
      if(owlfilecreator($id) == $checkuserid)
      {
         return PERMIT;
      }

      $filegroup = owlfilegroup($id);
      if (in_array($filegroup, $aMyGroupAdmin))
      //if (fIsGroupAdmin($checkuserid, $filegroup))
      {
         return PERMIT;
      } 
      //foreach($groups as $g)
      //{
         //$result = fGetAclChecked($id, $g[0], $acl, "group");
         $result = fGetAclChecked($id, $groups, $acl, "group");

         if(!empty($result))
         {
           return PERMIT;
         }
      //}
      $result = fGetAclChecked($id, $checkuserid, $acl, "user_or_everyone");
      if(!empty($result))
      {
         return PERMIT;
      }
      //$result = fGetAclChecked($id, EVERYONE, $acl, "user");
      //if(!empty($result))
      //{
         //return PERMIT;
      //}
   }
  
   if (fIsAdmin()) 
   {
      if( !$report )
      {
         return PERMIT;
      }
   }
   //print("DEBUG: ID: $id UID: $userid ACL: $acl <br />");
   return DENY;
}
?>
