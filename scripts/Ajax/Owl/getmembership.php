<?php
/**
 * getmembership.php -- Get Membership ToolTips
 *
 * Description: If it's a User show what groups he is in and if it
 *              is a group show the Users that Are in the Group or
 *              are a member of this group
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 * 
 * Copyright (c) 2014-2015 Bozz IT Consulting Inc
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


require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");


$sTheme = $default->owl_graphics_url . "/" . $default->sButtonStyle;

$sTableHeader = '<table class="log_table" cellspacing="0" cellpadding="0" style="border-left: 0px solid !important;">
    <tr>
       <td class="browse0" style="border-left: 1px solid !important;">%s</td>
    </tr>';

$sTableFooter = '   <tr>
      <td class="table_footer">&nbsp;</td>
   </tr>
</table>';

if (isset($sess) and (!$sess == 0))
{

   $sID = substr($_GET['get'], 1);

   $CountLines = 0;
   if ($_GET['get'][0] == 'U')
   {
      print(sprintf($sTableHeader, sprintf($owl_lang->acl_membership_header, 's')));
      if ($sID == 0)
      {
         print(sprintf('<tr class="file%s"><td style="border-left: 1px solid !important;">%s</td></tr>', 1, $owl_lang->acl_membership_special_user));
         print($sTableFooter);
      }
      else
      {
         $aMyGroups = fGetGroupsForUser($sID);
         foreach($aMyGroups as $aGroup)
         {
            print(sprintf('<tr class="file%s"><td style="border-left: 1px solid !important;"><img src="%s/ui_misc/group.png" style="padding-right: 5px">%s</td></tr>',  ($CountLines % 2) + 1,  $sTheme, $aGroup['1']));
            $CountLines++;
         }
         print($sTableFooter);
      }
   }
   else if ($_GET['get'][0] == 'G')
   {
         $aUsersInGroup = fGetUserInfoInMyGroups($sID);

         print(sprintf($sTableHeader, sprintf($owl_lang->acl_membership_header, group_to_name($sID))));
         foreach($aUsersInGroup as $aUser)
         {
            $sEmail = '';
            if (!empty($aUser['email']))
            {
               $sEmail = sprintf('(%s)', $aUser['email']);
            }

            print(sprintf('<tr class="file%s"><td style="border-left: 1px solid !important;"><img src="%s/ui_misc/user.png" style="padding-right: 5px">%s %s</td></tr>',  ($CountLines % 2) + 1,  $sTheme, $aUser['name'], $sEmail));
            $CountLines++;
         }
         print($sTableFooter);
   }
}
