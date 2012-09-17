<?php
/**
 * sitemap.php
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
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");


//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/sitemap.xtpl");
$xtpl = new XTemplate("html/sitemap.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

fSetLogo_MOTD();
fSetPopupHelp();

if ($sess == "0" && $default->anon_ro > 0)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

if (empty($parent) || !is_numeric($parent))
{
   $parent = $default->HomeDir;
}

include($default->owl_fs_root ."/lib/header.inc");
include($default->owl_fs_root ."/lib/userheader.inc");

if ($expand == 1)
{
   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
}
else
{
   $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
}

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Top");
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent, "&nbsp;");

$xtpl->assign('SITEMAP_TITLE', $owl_lang->alt_site_map);

function fShowSiteMapTree($fid, $folder)
{
   global $owl_lang, $folderList, $fCount, $fDepth, $sess, $id, $default, $userid, $expand, $sort, $sortorder, $sortname, $order, $curview, $sFolderTreeList ;
   global $bIsInBrokenTree;

   // If restricted view is in effect only show the folders you do have access to
   $showfolder = 1;
   $bFolderView = false;
   if ($default->restrict_view == 1)
   {
           $bIsInBrokenTree = false;
           fIsInBrokenTree($fid);
           if ($bIsInBrokenTree == true)
            {
               return;
            }

      if (check_auth($fid, "folder_create", $userid) != 0 && $fid != 0)
      {
         $showfolder = 1;
      }
      else
      {
         if (check_auth($fid, "folder_view", $userid) == 1 && $fid != 0)
         {
            $showfolder = 1;
         }
         else
         {
            $bFolderView = true;
            $showfolder = 0;
         }
      }
   }

   if ($showfolder == 1)
   {
      //if (check_auth($fid, "folder_modify", $userid) == 0 and check_auth($fid, "folder_upload", $userid) == 0)
      if ($bFolderView == true)
      {
         $gray = 1;
      }
      else
      {
         if ($default->restrict_view == 0)
         {
            if (check_auth($fid, "folder_view", $userid) == 0)
            {
               $gray = 1; //       check for permissions
            }
         }
      }

      for ($c = 0 ;$c < ($fDepth+1) ; $c++)
      {
        $sFolderTreeList .= ".";
      }
      if ($gray)
      {
         $sFolderTreeList .= "|$folder||$owl_lang->title_return_folder $folder|||\n";
      }
      else
      {
            $sFolderTreeList .= "|$folder|$default->owl_root_url/browse.php?sess=$sess&amp;parent=$fid&amp;expand=$expand&amp;order=$order&amp;curview=$curview|$owl_lang->title_return_folder $folder|||0\n";
      }
   }


   for ($c = 0; $c < $fCount; $c++)
   {
      if ($folderList[$c][2] == $fid)
      {
         //$sFolderTreeList .= "<br />";
         $fDepth++;
         fShowSiteMapTree($folderList[$c][0] , $folderList[$c][1]);
         $fDepth--;
      }
   }
}


// Get list of folders sorted by name
$whereclause = "";

if ($default->hide_backup == 1 and !fIsAdmin())
{
   $whereclause = " WHERE name <> '$default->version_control_backup_dir_name'";
} 

$sql->query("select id,name,parent from $default->owl_folders_table $whereclause order by name");

$i = 0;
while ($sql->next_record())
{
   $folderList[$i][0] = $sql->f("id");
   $folderList[$i][1] = $sql->f("name");
   $folderList[$i][2] = $sql->f("parent");
   $i++;
} 

$fCount = count($folderList);

$fDepth = 0;

fShowSiteMapTree($default->HomeDir, fid_to_name($default->HomeDir));
//print("<pre>$sFolderTreeList</pre>");
//exit;
if ($default->old_action_icons)
{
   require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/PHPLIB.php");
   require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/layersmenu-common.inc.php");
   require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/layersmenu.inc.php");
}

require_once ($default->owl_fs_root . "/scripts/phplayersmenu/lib/treemenu.inc.php");

$mid = new TreeMenu();
$mid->setDirroot($default->owl_fs_root . "/scripts/phplayersmenu/");
$mid->setImgwww($default->owl_root_url . '/scripts/phplayersmenu/menuimages/');
$mid->setIconwww($default->owl_root_url . '/scripts/phplayersmenu/menuicons/');

$mid->setMenuStructureString($sFolderTreeList);
$mid->setIconsize(16, 16);
$mid->parseStructureForMenu('treemenu1');
$mid->setSelectedItemByUrl('treemenu1', basename(__FILE__));

$xtpl->assign('SITE_TREE', $mid->newTreeMenu('treemenu1'));

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL("Bottom");
}

$xtpl->parse('main.SiteMap');
fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
