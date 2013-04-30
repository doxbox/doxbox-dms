<?php
/**
 * view_default.php -- Default view for Browse page
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
   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ( $sess == "0" && $default->anon_ro == 0 ))
      {
         $xtpl->assign('TITLE_BULK_URL', '#');
         $xtpl->assign('TITLE_BULK_TITLE', $owl_lang->alt_toggle_check_box);
         $xtpl->assign('TITLE_BULK_ONCLICK', ' onclick="CheckAll(); return false;"');
         $urlArgs = array();
         $urlArgs['sess']      = $sess;
         $urlArgs['parent']    = $parent;
         $urlArgs['expand']    = $expand;
         $urlArgs['order']     = $order;
         $urlArgs['sort']  = $sortname;
         $urlArgs['curview']     = $curview;
         $urlArgs[${$sortorder}]  = $sort;

         $xtpl->assign('BULKBUTTONS_HIDDEN', fGetHiddenFields ($urlArgs));

         $xtpl->parse('main.DataBlock.BulkFormStart');
         $xtpl->parse('main.DataBlock.BulkFormEnd');
         $xtpl->parse('main.DataBlock.Title.Bulk');
      }
   }
   if (($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      if ($default->show_bulk == 0 and ! fIsAdmin())
      {
         $xtpl->assign('TITLE_STATUS', "<input id=\"fcheckid" .  $sql->f("id") . "\" type=\"hidden\" name=\"fstyle_change\" value=\"" . $sql->f("id") . "\" />");
      }
      $xtpl->parse('main.DataBlock.Title.Status');
   }

   if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      show_linkXTPL("id", "sortid", $sortid, $order, $sess, $expand, $parent, $owl_lang->doc_number);
   }
   if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
   {
      $xtpl->parse('main.DataBlock.Title.Thumb');
   }

   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Title.DocType');
   }
   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      show_linkXTPL("name", "sortname", $sortname, $order, $sess, $expand, $parent, $owl_lang->title);
   }

   if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
   {
      $xtpl->assign('TITLE_DOCFIELDS', $owl_lang->doc_fields);
      $xtpl->parse('main.DataBlock.Title.DocFields');
   }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         show_linkXTPL("major_minor_revision", "sortver", $sortver, $order, $sess, $expand, $parent, $owl_lang->ver);
      }
   } 
   if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
   {
      show_linkXTPL("filename", "sortfilename", $sortfilename, $order, $sess, $expand, $parent, $owl_lang->file);
   }


/*
Show DocType Fields that have Been Selected to be viewed as a column
TO BE ADDED 
*/

   if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
   {
      show_linkXTPL("f_size", "sortsize", $sortsize, $order, $sess, $expand, $parent, $owl_lang->size);
   }
   if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
   {
      show_linkXTPL("creatorid", "sortposted", $sortposted, $order, $sess, $expand, $parent, $owl_lang->postedby);
   }
   if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
   {
      show_linkXTPL("updatorid", "sortupdator", $sortupdator, $order, $sess, $expand, $parent, $owl_lang->updated_by);
   }
   if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
   {
      show_linkXTPL("smodified", "sortmod", $sortmod, $order, $sess, $expand, $parent, $owl_lang->modified);
   }

   if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
   {
      $xtpl->assign('TITLE_ACTIONS', $owl_lang->actions);
      $xtpl->parse('main.DataBlock.Title.Actions');
   }
   if ($default->owl_version_control == 1)
   {  
      if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
      {
         show_linkXTPL("checked_out", "sortcheckedout", $sortcheckedout, $order, $sess, $expand, $parent, $owl_lang->held);
      }
   } 

// Looping out Folders

   if ($default->owl_LookAtHD != "false")
   {
      $sql->query("SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause");
      //exit("SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause");
      while ($sql->next_record())
      {
// LOOKATHDDEBUG
         //if ($default->records_per_page == 0)
         //if ($default->records_per_page > 0)
         //{
            if ($sql->f("linkedto") == 0)
            {
               $DBFolderCount++; //count number of filez in db 2 use with array
               $DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
            }
         //}
      }
   }

$sql = new Owl_DB;
$sql->query($FolderQuery);

// **********************
// BEGIN Print Folders
// **********************
if ($default->records_per_page > 0)
{
   if ($default->restrict_view == 1)
   {
      $iPageStartCount = $default->records_per_page * $iCurrentPage;
      $iPageEndCount = $default->records_per_page * ($iCurrentPage + 1);
      $iRecordCounter = 0;
   }
}

$iIsOneRecPrinted = 0;
while ($sql->next_record())
{
   if ($default->restrict_view == 1)
   {
      if (!check_auth($sql->f("id"), "folder_view", $userid, false, false))
      {
         //if ($default->records_per_page == 0) 
         //{
            //if ($sql->f("linkedto") == 0)
            //{
               //$DBFolderCount++; //count number of filez in db 2 use with array
               //$DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
            //}
         //}
         continue;
      } 
   } 

   if ($default->records_per_page > 0)
   {
      if ($default->restrict_view == 1)
      {
         $iRecordCounter++;
         if ($iRecordCounter > $iPageEndCount or $iRecordCounter <= $iPageStartCount)
         {
            continue;
         }
      }
   }

   $iIsOneRecPrinted++;
   // *******************************************
   // Find out how many items (Folders and Files)
   // *******************************************
   if(!$default->hide_folder_doc_count)
   {
      $GetItems = new Owl_DB;

      $iFolderCount = 0;
      $iParent = $sql->f("parent");
      $GetItems->query("SELECT id from $default->owl_folders_table where parent = '" . $sql->f("id") . "'" . $whereclause);
   
      if ($default->restrict_view == 1)
      {
         while ($GetItems->next_record())
         {
            $bFileDownload = check_auth($GetItems->f("id"), "folder_view", $userid, false, false);
            if ($bFileDownload)
            {
               $iFolderCount++;
            }
        }
      }
      else
      {
         $iFolderCount = $GetItems->num_rows();
      }
   
      $iFileCount = fCountFileType ($sql->f("id"), '0');
      $iUrlCount = fCountFileType ($sql->f("id"), '1');
      $iNoteCount = fCountFileType ($sql->f("id"), '2');
   }
   
   $CountLines++;
   $PrintLines = $CountLines % 2;
   
   if ($PrintLines == 0)
   {
      $sTrClass = "hover1";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover1";
      $sTrClassHiliteAlt = "mouseover3";
   }
   else
   {
      $sTrClass = "hover2";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover2";
      $sTrClassHiliteAlt = "mouseover3";
   }

   /** This code is only used when debugging customer issues, it creates the missing
    *  Directories based on the database 
    */
   // $fix_path = find_path($sql->f("id"));
   // if (!file_exists($fix_path))
   // {
      // mkdir($fix_path);
   // }

  $xtpl->assign('FOLDER_TR_ID', "foldertr" . $sql->f("id"));
  $xtpl->assign('FOLDER_TR_CLASS', $sTrClassHilite);
  $xtpl->assign('FOLDER_TR_MOUSOVER', "class=\"$sTrClassHilite\" onmouseover=\"alt_css_style('fcheckid" . $sql->f("id") . "', this, '$sTrClassHiliteAlt')\"  onmouseout=\"alt_css_style('fcheckid" . $sql->f("id") . "', this, '$sTrClassHilite')\"");

  $xtpl->assign('FOLDER_TD_CLASS', $sTrClass);

   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {
         $xtpl->assign('FOLDER_BULK_CHECKBOX', "<input id=\"fcheckid" .  $sql->f("id") . "\" type=\"checkbox\" name=\"fbatch[]\" value=\"" . $sql->f("id") . "\" onclick=\"mark_selected('foldertr" . $sql->f("id") . "', this, '$sTrClassHilite')\" />");
         $xtpl->parse('main.DataBlock.Folder.Bulk');

      } 
   } 

   if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      if (fIsFolderRSSFeed($sql->f("id")) == true and $default->rss_feed_enabled == 1)
      {
         $sRssName = $sql->f("name") . ".xml";
         if (file_exists($default->RSS_TxtFilePath . DIR_SEP . $sRssName ))
         {
            if ($default->show_bulk == 0 and ! fIsAdmin())
            {
               $xtpl->assign('FOLDER_STATUS', "<input id=\"fcheckid" .  $sql->f("id") . "\" type=\"hidden\" name=\"fstyle_change\" value=\"" . $sql->f("id") . "\" />");
            }
            $xtpl->assign('FOLDER_STATUS_RSS_IMG', "<a href=\"https://" . $_SERVER['SERVER_NAME'] . $default->owl_root_url . "/RSS/". $sRssName ."\" class=\"\" title=\"Right Click Save AS\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/rss.gif\" border=\"0\" alt=\"Right Click Save AS\" title=\"Right Click Save AS\"><br /></a>");
            $xtpl->parse('main.DataBlock.Folder.Status');
         }
         else
         {
            if ($default->show_bulk == 0 and ! fIsAdmin())
            {
               $xtpl->assign('FOLDER_STATUS', "<input id=\"fcheckid" .  $sql->f("id") . "\" type=\"hidden\" name=\"fstyle_change\" value=\"" . $sql->f("id") . "\" />");
            }
            $xtpl->assign('FOLDER_STATUS_RSS_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/rss_gray.gif\" border=\"0\" alt=\"Feed has not been Created Yet\" title=\"Feed has not been Created Yet\">");
            $xtpl->parse('main.DataBlock.Folder.Status');
         }
      }
      else
      {
         if ($default->show_bulk == 0 and ! fIsAdmin())
         {
            $xtpl->assign('FOLDER_STATUS', "<input id=\"fcheckid" .  $sql->f("id") . "\" type=\"hidden\" name=\"fstyle_change\" value=\"" . $sql->f("id") . "\" />");
         }
         $xtpl->parse('main.DataBlock.Folder.Status');
      }

   }
   if(($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Folder.id');
   }

   if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
   {
      $xtpl->parse('main.DataBlock.Folder.Thumb');
   }

   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $parent;
   // 0 = View File Details
   // 1 = Download File
   // 2 = Modify File Properties
   if ($default->folder_action_click_title_column == 0)
   {
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
      $sAltString = $owl_lang->title_browse_folder;
   }
   else if ($default->folder_action_click_title_column == 1)
   {
      $urlArgs2['binary'] = '1';
      $urlArgs2['id'] = $sql->f('id');
      $urlArgs2['action'] = 'folder';
      $url = fGetURL ('download.php', $urlArgs2);
      $sAltString = $owl_lang->alt_get_folder;
   }
   else if ($default->folder_action_click_title_column == 2)
   {
      $urlArgs2['action'] = 'folder_modify';
      $urlArgs2['id'] = $sql->f('id');
      $url = fGetURL ('modify.php', $urlArgs2);
   }
   else
   {
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
      $sAltString = $owl_lang->title_browse_folder;
   }

   if(($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $xtpl->assign('FOLDER_DOCTYPE_URL', $url); 
      $xtpl->assign('FOLDER_DOCTYPE_TITLE', $sAltString);
      $xtpl->parse('main.DataBlock.Folder.DocType');
   }
 

   if(($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {

      if ($default->show_folder_desc_as_popup == '1')
      {
         $sPopupDescription= htmlentities(strip_tags(fCleanDomTTContent($sql->f("description")), $default->permited_html_tags ), ENT_QUOTES, "UTF-8");
         if (trim($sPopupDescription) == "")
         {
            $sPopupDescription = $owl_lang->no_description;
         }

         $sPopupCode = " onmouseover=" . '"' . "return makeTrue(domTT_activate(this, event, 'caption', '" . $owl_lang->description . "', 'content', '" . $sPopupDescription . "', 'lifetime', " . $default->popup_lifetime . ", 'fade', 'both', 'delay', 10, 'maxWidth', '400', 'direction', 'north', 'statusText', ' ', 'trail', true));" . '"';
      }
      else
      {
         $sPopupCode = "";
         $sPopupDescription = strip_tags($sql->f("description"), $default->permited_html_tags);
      }

   
      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $sql->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
   
      $xtpl->assign('FOLDER_NAME_URL', $url);
      $xtpl->assign('FOLDER_NAME_TITLE', $sAltString);
      $xtpl->assign('FOLDER_NAME_MOUSEOVER', $sPopupCode);
      $xtpl->assign('FOLDER_NAME_NAME', $sql->f("name"));

   
      if(!$default->hide_folder_doc_count)
      {
         $sCounts = '';
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $sCounts .= "&nbsp;(";
         } 
         if ($iFolderCount > 0 )
         {
            $sCounts .= "<a href=\"#\" class=\"cfolders1\" title=\"$owl_lang->folder_count_pre $iFolderCount $owl_lang->folder_count_folder\">$iFolderCount</a>";
         }
         if ($iFileCount > 0 )
         {
            if ($iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"cfiles1\" title=\"$owl_lang->folder_count_pre $iFileCount $owl_lang->folder_count_file\">$iFileCount</a>";
         }
         if ($iUrlCount  > 0 )
         {
            if ($iFileCount > 0 or $iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"curl1\" title=\"$owl_lang->folder_count_pre $iUrlCount $owl_lang->folder_count_url\">$iUrlCount</a>";
         }
         if ($iNoteCount > 0)
         {
            if ($iUrlCount  > 0 or $iFileCount > 0 or $iFolderCount > 0)
            {
               $sCounts .= ":";
            }
            $sCounts .= "<a href=\"#\" class=\"cnotes1\" title=\"$owl_lang->folder_count_pre $iNoteCount $owl_lang->folder_count_note\">$iNoteCount</a>";
         }
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $sCounts .= ")";
         }
         $xtpl->assign('FOLDER_NAME_COUNTS', $sCounts);
      }
   
      if (trim($sql->f("description")) and $default->show_folder_desc_as_popup == '0')
      {
         $sDescription = strip_tags($sql->f("description"), $default->permited_html_tags);
         //$xtpl->assign('FOLDER_NAME_DESC_POP', "<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\"><a class=\"desc\">" . "<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\" />$sDescription</a>");
         $xtpl->assign('FOLDER_NAME_DESC', nl2br($sDescription));
         $xtpl->parse('main.DataBlock.Folder.Name.Description');
      }
      $xtpl->parse('main.DataBlock.Folder.Name');

   }

   //if ($default->records_per_page == 0)
   //{
      //if ($sql->f("linkedto") == 0)
      //{
         //$DBFolderCount++; //count number of filez in db 2 use with array
         //$DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
      //}
   //}
   if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
   {
      $xtpl->parse('main.DataBlock.Folder.DocFields');
   }


      if ($default->owl_version_control == 1)
      {
         if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.major_minor_revision');
         }
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if(!$default->old_action_icons)
            {
               //$xtpl->assign('FOLDER_MENU', $mid->getMenu('vermenuf' .$sql->f("id")));
               fSetupFolderActionMenusXTPL($sql->f("id"), $sql->f("name"));
               $xtpl->parse('main.DataBlock.Folder.filename');
            }
            else
            {
               $xtpl->parse('main.DataBlock.Folder.oldaction_filename');
            }
         }

         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            if ($default->hide_folder_size)
            {
               $xtpl->assign('FOLDER_SIZE', '&nbsp;');
            }
            else
            {
               $FolderSize = fGetFolderSize($sql->f("id"));
               $xtpl->assign('FOLDER_SIZE', gen_filesize($FolderSize));
            }
            $xtpl->parse('main.DataBlock.Folder.f_size');
         }

         if( $default->show_user_info == 1)
         {
            $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\">" . flid_to_creator($sql->f("id")) . "</a>";
         }
         else
         {
            $sLinkToUser =  uid_to_name($sql->f("creatorid"));
         }

         if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
         {
            $xtpl->assign('FOLDER_CREATOR', $sLinkToUser);
            $xtpl->parse('main.DataBlock.Folder.creatorid');
         }
         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.updatorid');
         }
         if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
         {
            if ($sql->f("smodified"))
            {
               $xtpl->assign('FOLDER_MODIFIED', date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset));
            }
            else
            {
               $xtpl->assign('FOLDER_MODIFIED', '&nbsp;');
            }
            $xtpl->parse('main.DataBlock.Folder.smodified');
         }
      } 
      else
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if(!$default->old_action_icons)
            {
               //$xtpl->assign('FOLDER_MENU', $mid->getMenu('vermenuf' .$sql->f("id")));
               fSetupFolderActionMenusXTPL($sql->f("id"), $sql->f("name"));
               $xtpl->parse('main.DataBlock.Folder.filename');
            }
            else
            {
               $xtpl->parse('main.DataBlock.Folder.oldaction_filename');
            }
         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            if ($default->hide_folder_size)
            {
               $xtpl->assign('FOLDER_SIZE', '&nbsp;');
            }
            else
            {
               $FolderSize = fGetFolderSize($sql->f("id"));
               $xtpl->assign('FOLDER_SIZE', gen_filesize($FolderSize));
            }
            $xtpl->parse('main.DataBlock.Folder.f_size');
         }
         if( $default->show_user_info == 1)
         {
            $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\">" . flid_to_creator($sql->f("id")) . "</a>";
         }
         else
         {
            $sLinkToUser =  uid_to_name($sql->f("creatorid"));
         }

         if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
         {
            $xtpl->assign('FOLDER_CREATOR', $sLinkToUser);
            $xtpl->parse('main.DataBlock.Folder.creatorid');
         }

         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.updatorid');
         }
         if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
         {
            if ($sql->f("smodified"))
            {
               $xtpl->assign('FOLDER_MODIFIED', date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset));
            }
            else
            {
               $xtpl->assign('FOLDER_MODIFIED', '&nbsp;');
            }
            $xtpl->parse('main.DataBlock.Folder.smodified');
         }
      } 

      if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
      {
         $sSpacer = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/x_clear.gif\" height=\"1\" width=\"17\" alt=\"\" />";
         $xtpl->assign('FOLDER_ACTION_LOG', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_HOTLINK', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_DEL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MOD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_INLINE', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_ACL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_LINK', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_COPY', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MOVE', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_UPD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_DNLD', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_COMMENT', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_CHECKOUT', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_EMAIL', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_MON', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_RELATED', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_VIEW', $sSpacer);
         $xtpl->assign('FOLDER_ACTION_GENTHUMB', $sSpacer);

         // *****************************************
         // Display the Delete Icons For the Folders
         // *****************************************
    
         if (check_auth($sql->f("id"), "folder_delete", $userid, false, false) == 1)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['action'] = 'folder_delete';
            $url = fGetURL ('dbmodify.php', $urlArgs2);
   
            $xtpl->assign('FOLDER_ACTION_DEL', "<a href=\"$url\" onclick=\"return confirm('$owl_lang->reallydelete " . htmlspecialchars($sql->f("name"), ENT_QUOTES) . "?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" title=\"$owl_lang->alt_del_folder\" border=\"0\" /></a>");
         }

         // *****************************************
         // Display the Property Icons For the Folders
         // *****************************************
    
         if (check_auth($sql->f("id"), "folder_property", $userid, false, false) == 1)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['action'] = 'folder_modify';
            $url = fGetURL ('modify.php', $urlArgs2);
   
            $xtpl->assign('FOLDER_ACTION_MOD', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_folder\" title=\"$owl_lang->alt_mod_folder\" /></a>");
         }

         if ( $default->advanced_security == 1 )
         {
            if (check_auth($sql->f("id"), "folder_acl", $userid, false, false) == 1)
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $sql->f("id");
               $urlArgs2['parent'] = $parent;
               $urlArgs2['edit'] = 1;
               $urlArgs2['action'] = "folder_acl";
               $sUrl = fGetURL ('setacl.php', $urlArgs2);
               $xtpl->assign('FOLDER_ACTION_ACL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->alt_set_folder_acl\" title=\"$owl_lang->alt_set_folder_acl\" /></a>");
            }
         }
 
         // *****************************************
         // Display the move Icons For the Folders
         // *****************************************
 
         //if (check_auth($sql->f("id"), "folder_modify", $userid, false, false) == 1 and check_auth($sql->f("id"), "folder_delete", $userid, false, false) == 1)
         if (check_auth($sql->f("id"), "folder_cp", $userid, false, false) == 1)
         {
             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'cp_folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);
   
             $xtpl->assign('FOLDER_ACTION_COPY', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_folder\" title=\"$owl_lang->alt_copy_folder\" /></a>");
   
         }
         
         if (check_auth($sql->f("id"), "folder_move", $userid, false, false) == 1)
         {

             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);

             $xtpl->assign('FOLDER_ACTION_MOVE', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_folder\" title=\"$owl_lang->alt_move_folder\" /></a>");
             $urlArgs2 = $urlArgs;
             $urlArgs2['id'] = $sql->f("id");
             $urlArgs2['action'] = 'lnk_folder';
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('move.php', $urlArgs2);

             $xtpl->assign('FOLDER_ACTION_LINK', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/fld_link.gif\" border=\"0\" alt=\"LINK THIS FOLDER\" title=\"LINK THIS FOLDER\" /></a>");

         } 
   

         //if (check_auth($sql->f("id"), "folder_view", $userid, false, false) == 1)
         if (check_auth($sql->f("id"), "folder_monitor", $userid, false, false) == 1)
         {
            $folder_id = $sql->f("id");
            $checksql = new Owl_DB;
            $checksql->query("select * from $default->owl_monitored_folder_table where fid = '$folder_id' and userid = '$userid'");
            $checknumrows = $checksql->num_rows($checksql);
   
            $checksql->query("SELECT * from $default->owl_users_table where id = '$userid'");
            $checksql->next_record();
            if (trim($checksql->f("email")) != "")
            {
               if ($checknumrows == 0)
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['id'] = $folder_id;
                  $urlArgs2['parent'] = $parent;
                  $urlArgs2['action'] = 'folder_monitor';
                  $url = fGetURL ('dbmodify.php', $urlArgs2);
   
                  $xtpl->assign('FOLDER_ACTION_MON', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor_folder\" title=\"$owl_lang->alt_monitor_folder\" /></a>");
               } 
               else
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['id'] = $folder_id;
                  $urlArgs2['parent'] = $parent;
                  $urlArgs2['action'] = 'folder_monitor';
                  $url = fGetURL ('dbmodify.php', $urlArgs2);
   
                  $xtpl->assign('FOLDER_ACTION_MON', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored_folder\" title=\"$owl_lang->alt_monitored_folder\" /></a>");
               } 
            } 
         } 

         if (check_auth($sql->f("id"), "folder_view", $userid, false, false) == 1)
         {
            $urlArgs2 = array();
            $urlArgs2['sess']   = $sess;
            $urlArgs2['id']     = $sql->f("id");
            $urlArgs2['parent'] = $sql->f("parent");
            $urlArgs2['action'] = 'folder';
            $urlArgs2['binary'] = 1;
            $urlArgs2['expand']    = $expand;
            $urlArgs2['order']     = $order;
            $urlArgs2['sortorder'] = $sort;
            $url = fGetURL ('download.php', $urlArgs2);
   
            if (file_exists($default->tar_path) && trim($default->tar_path) != "" && file_exists($default->gzip_path) && trim($default->gzip_path) != "")
            {
               $xtpl->assign('FOLDER_ACTION_DNLD', "<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/zip.gif\" border=\"0\" alt=\"$owl_lang->alt_get_folder\" title=\"$owl_lang->alt_get_folder\" /></a>");
            }
         } 
         if ($default->thumbnails == 1 and fisAdmin())
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $sql->f("id");
            $urlArgs2['parent'] = $sql->f("parent");
            $urlArgs2['action'] = 'folder_thumb';
            $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
            $xtpl->assign('FOLDER_ACTION_GENTHUMB', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
         }  
         $xtpl->parse('main.DataBlock.Folder.Action');
      }

      if ($default->owl_version_control == 1)
      {
         if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
         {
            $xtpl->parse('main.DataBlock.Folder.checked_out');
         }
      }
      $xtpl->parse('main.DataBlock.Folder');
} 

if ($default->owl_LookAtHD != "false")
{
   $DBFolders[$DBFolderCount + 1] = "[END]"; //end DBfolder array
   $RefreshPage = CompareDBnHD('folder', $default->owl_FileDir . DIR_SEP . get_dirpath($parent), $DBFolders, $parent, $default->owl_folders_table);
} 


//$midf->printFooter();
//*************************************
// BEGIN Print Files
//*************************************
// 

$DBFileCount = 0;

   if ($default->records_per_page > 0)
   {
      $sql->query("select * from $default->owl_files_table where parent = '$parent'");
      while ($sql->next_record())
      {
         $DBFileCount++; //count number of filez in db 2 use with array
         $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
      }
   }


$sql->query($FileQuery);

while ($sql->next_record())
{
   $bPrintNew = false;
   $bPrintUpdated = false;
   $bFileDownload = check_auth($sql->f("id"), "file_download", $userid, false, false);
   if ($default->restrict_view == 1)
   {
      if (!$bFileDownload)
      {
         if ($default->records_per_page == 0)
         {
            $DBFileCount++; //count number of filez in db 2 use with array
            $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
         }
         continue;
      } 
   } 

   $iIsOneRecPrinted++;
   if ($default->peer_review_leave_old_file_accessible)
   {
      $CheckOlderVersion = new Owl_DB;

      $aFirstpExtension = fFindFileFirstpartExtension ($sql->f("filename"));
      $firstpart = $aFirstpExtension[0];
      $file_extension = $aFirstpExtension[1];
      $haveextension = $aFirstpExtension[2];
      if ($default->owl_use_fs)
      {
         $CheckOlderVersion->query("SELECT id FROM $default->owl_folders_table WHERE name='$default->version_control_backup_dir_name' and parent='$parent'");
         if ($CheckOlderVersion->num_rows($CheckOlderVersion) != 0)
         {
            while ($CheckOlderVersion->next_record())
            {
               $backup_parent = $CheckOlderVersion->f("id");
            }
         }
         else
         {
            $backup_parent = $parent;
         }
         $sQuery = "SELECT * FROM $default->owl_files_table WHERE (filename LIKE '" . $firstpart . "\\_%" . $file_extension . "' OR filename = '$filename') AND (parent = '$backup_parent' OR parent = '$parent') ORDER BY major_revision desc, minor_revision desc";
         $CheckOlderVersion->query($sQuery);
      }
      else
      {
         // name based query -- assuming that the given name for the file doesn't change...
         // at some point, we should really look into creating a "revision_id" field so that all revisions can be linked.
         // in the meanwhile, the code for changing the Title of the file has been altered to go back and
         $name = flid_to_name($id);
         $sQuery = "select * from $default->owl_files_table where name='$name' AND parent='$parent' order by major_revision desc, minor_revision desc";

         $CheckOlderVersion->query($sQuery);
      }
      $iNumrows = $CheckOlderVersion->num_rows();
   }


   if ($sql->f("approved") == 0 and !$default->peer_review_leave_old_file_accessible)
   {
     if ($iNumrows == 0)
      {
         $DBFileCount++; //count number of filez in db 2 use with array
         $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
         continue;
      }
   } 

   if ($default->records_per_page > 0)
   {
      if ($default->restrict_view == 1)
      {
         $iRecordCounter++;
         if ($iRecordCounter > $iPageEndCount or $iRecordCounter <= $iPageStartCount )
         {
            continue;
         }
      }
   }

   // 
   // Find New files
   // 
   
   if ($bFileDownload == 1)
   {
      if ($sql->f("created") > $lastlogin)
      {
         $bPrintNew = true;
      } 
      if ($sql->f("smodified") > $lastlogin and $sql->f("created") < $lastlogin)
      {
         $bPrintUpdated = true;
      } 
   } 

   // ******************************************
   // Check to see if this file as any comments
   // ******************************************

   $bHasComments = true;
   $bPrintNewComment = false;

   $CheckComments = $cCommonDBConnection;

   if (empty($CheckComments))
   {
      $CheckComments = new Owl_DB;
   }

   $CheckComments->query("SELECT comment_date from $default->owl_comment_table where fid = '" . $sql->f("id") . "' order by comment_date desc");

   $iTotalComments = $CheckComments->num_rows();

   $CheckComments->next_record();

   if ($CheckComments->f("comment_date") > $lastlogin)
   {
      $bPrintNewComment = true;
   }


   if ($iTotalComments == 0)
   {
      $bHasComments = false;
   } 

   // ******************************************
   // Check to see if this file is Word Indexed 
   // ******************************************

   $CheckComments->query("SELECT owlfileid from $default->owl_searchidx where owlfileid = '" . $sql->f("id") . "'");

   if ($CheckComments->num_rows() > 0)
   {
      $bWasIndexed = true;
   }
   else
   {
      $bWasIndexed = false;
   }

   $iRealFileID = fGetPhysicalFileId($sql->f('id'));

   $CountLines++;
   $PrintLines = $CountLines % 2;

   if ($PrintLines == 0)
   {
      $sTrClass = "hover1";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover1";
      $sTrClassHiliteAlt = "mouseover3";
   }
   else
   {
      $sTrClass = "hover2";
      $sLfList = "lfile1";
      $sTrClassHilite = "mouseover2";
      $sTrClassHiliteAlt = "mouseover3";
   }

   $xtpl->assign('FILE_TR_ID', "filetr" . $sql->f("id"));
   $xtpl->assign('FILE_TR_CLASS', $sTrClassHilite);
   $xtpl->assign('FILE_TR_MOUSOVER', "class=\"$sTrClassHilite\" onmouseover=\"alt_css_style('checkid" . $sql->f("id") . "', this, '$sTrClassHiliteAlt')\"  onmouseout=\"alt_css_style('checkid" . $sql->f("id") . "', this, '$sTrClassHilite')\"");

   $xtpl->assign('FILE_TD_CLASS', $sTrClass);
 
   if ($fileid == $sql->f("id"))
   {
      $sBoldBegin = '<b class="hilite">';
      $sBoldEnd = '</b>';
   }
   else
   {
      $sBoldBegin = '';
      $sBoldEnd = '';
   }



   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {

         $xtpl->assign('FILE_BULK_CHECKBOX', "<input id=\"checkid" .  $sql->f("id") . "\" type=\"checkbox\" name=\"batch[]\" value=\"" . $sql->f("id") . "\" onclick=\"mark_selected('filetr" . $sql->f("id") . "', this, '$sTrClassHilite')\" />");
         $xtpl->parse('main.DataBlock.File.Bulk');
      } 
   } 
   
   if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      if ($default->show_bulk == 0 and ! fIsAdmin())
      {
         $xtpl->assign('FILE_STATUS', "<input id=\"checkid" .  $sql->f("id") . "\" type=\"hidden\" name=\"style_change\" value=\"" . $sql->f("id") . "\" />");
      }
      $xtpl->assign('FILE_STATUS_COMMENT_IMG', '');
      if ($bHasComments)
      {
         if ($bPrintNewComment)
         {
            $iImage = "newcomment";
         }
         else
         {
            $iImage = "comment";
         }
         
         $urlArgs2 = $urlArgs;
         $urlArgs2['id']     = $sql->f("id");
         $urlArgs2['parent'] = $parent;
         $urlArgs2['action'] = 'file_comment';
         $url = fGetURL ('modify.php', $urlArgs2);
   
         $xtpl->assign('FILE_STATUS_COMMENT_IMG', "<a class=\"$sLfList\" href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/$iImage.gif\" border=\"0\" alt=\"$iTotalComments --- $owl_lang->alt_comments\" title=\"$iTotalComments --- $owl_lang->alt_comments\" /></a>");
      } 
      if ($default->anon_user <> $userid)
      {
         $xtpl->assign('FILE_STATUS_INDEXED', '');
         $xtpl->assign('FILE_STATUS_NEW', '');
         $xtpl->assign('FILE_STATUS_UPDATED', '');
         $xtpl->assign('FILE_STATUS_INFECTED', '');

         if ($bWasIndexed)
         {
              $xtpl->assign('FILE_STATUS_INDEXED', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/indexed.png\" border=\"0\" alt=\"$owl_lang->alt_indexed\" title=\"$owl_lang->alt_indexed\" />");
         }
         if ($bPrintNew)
         {
            $xtpl->assign('FILE_STATUS_NEW', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/new.gif\" border=\"0\" alt=\"$owl_lang->alt_new\" title=\"$owl_lang->alt_new\" />");
         } 
         if ($bPrintUpdated)
         {
            $xtpl->assign('FILE_STATUS_UPDATED', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/updated.gif\" border=\"0\" alt=\"$owl_lang->alt_updated\" title=\"$owl_lang->alt_updated\" />");
         } 
         if ($sql->f("infected") == '1')
         {
            $xtpl->assign('FILE_STATUS_INFECTED', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/infected.png\" border=\"0\" alt=\"File Is Infected with a Virus\" title=\"File Is Infected with a Virus\" />");
         } 

      } 
      $xtpl->parse('main.DataBlock.File.Status');
   }

   if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      $sZeroFilledId = str_pad($sql->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
      $xtpl->assign('FILE_ID_VALUE', $sBoldBegin . $default->doc_id_prefix . $sZeroFilledId . $sBoldEnd);
      $xtpl->parse('main.DataBlock.File.id');
   }

   if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
   {
      $sThumbUrl = $default->thumbnails_url . '/' . $default->owl_current_db . "_" . $iRealFileID . "_small.png";
      $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_small.png";

      $sMedThumbUrl = $default->thumbnails_url . '/' . $default->owl_current_db . "_" . $iRealFileID . "_med.png";
      $sMedThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_med.png";

      if (file_exists($sThumbLoc))
      {
         $xtpl->assign('FILE_THUMBNAIL', "<img src=\"$sThumbUrl\" border=\"1\" alt=\"$owl_lang->alt_thumb_small\" title=\"$owl_lang->alt_thumb_small\" />");
      }
      else
      {
         $xtpl->assign('FILE_THUMBNAIL', "&nbsp;");
      }
      $xtpl->parse('main.DataBlock.File.Thumb');
   }

   $urlArgs2 = $urlArgs;
   $urlArgs2['sess']   = $sess;
   $urlArgs2['id']     = $sql->f("id");
   $urlArgs2['parent'] = $parent;
   // 0 = View File Details
   // 1 = Download File
   // 2 = Modify File Properties
   // 3 = View File
   if ($default->file_action_click_title_column == 0)
   {
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_view_file;
   }
   else if ($default->file_action_click_title_column == 1)
   {
      $urlArgs2['binary'] = '1';
      $url = fGetURL ('download.php', $urlArgs2);
      $sAltString = $owl_lang->alt_get_file;
   }
   else if ($default->file_action_click_title_column == 2)
   {
      $urlArgs2['action'] = 'file_modify';
      $url = fGetURL ('modify.php', $urlArgs2);
      $sAltString = $owl_lang->alt_mod_file;
   }
   else if ($default->file_action_click_title_column == 3)
   {

      $urlArgs2['action'] = fGetViewFileAction($sql->f("id"),$sql->f("filename"));
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_mod_file;
   }
   else
   {
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
      $sAltString = $owl_lang->alt_view_file;
   }



   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $ext = fFindFileExtension($sql->f('filename'));

      //$choped = explode("\.", $sql->f("filename"));
      //$pos = count($choped);
      if (!empty($ext))
      {
         //$ext = strtolower($choped[$pos-1]);
         if ($iRealFileID == $sql->f('id'))
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
   
      //if (($ext == "gz") && ($pos > 2))
      //{
         //$exttar = strtolower($choped[$pos-2]);
         //if (strtolower($choped[$pos-2]) == "tar")
            //$ext = "tar.gz";
      //} 
   
      if ($sql->f("url") == "1")
      {
         //$xtpl->assign('FILE_DOCTYPE', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/url.gif\" border=\"0\" alt=\"\" />");
         $xtpl->assign('FILE_DOCTYPE_IMG', 'url');
         $xtpl->assign('FILE_DOCTYPE_URL_OPEN', '');
         $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', '');;
      }
      else
      {
         if (!file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.gif") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpg") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpeg") and
             !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.png"))
         {
            if ($iRealFileID == $sql->f('id'))
            {
               $sDispIcon = "file";
            }
            else
            {
               $sDispIcon = "file_lnk";
            }
         }
         $xtpl->assign('FILE_DOCTYPE_IMG', $sDispIcon);
         $xtpl->assign('FILE_DOCTYPE_URL_OPEN', "<a class=\"$sLfList\" href=\"$url\" title=\"$sAltString: " . $sql->f("filename") ."\">");
         $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', "</a>");
      } 
      $xtpl->parse('main.DataBlock.File.DocType');
   }

   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {


     //check if display custom fields in description window is allowed - added by maurizio (madal2005)
      if ($default->allow_custfieldspopup == 1)
      {
         //build a string with custom fields to add at description string
         if (strlen(fPopCustomFields ($sql->f("doctype"), $iRealFileID)) == 0)
         {
            $sPopupDescription= strip_tags(fCleanDomTTContent($sql->f("description")), $default->permited_html_tags );
            $sPopupDescription= htmlentities($sPopupDescription, ENT_QUOTES, "UTF-8");
         }
         else
         {
            $sCustPopupDescription = fCleanDomTTContent(fPopCustomFields ($sql->f("doctype"), $iRealFileID));
            $sPopupDescription = strip_tags(fCleanDomTTContent($sql->f("description")), $default->permited_html_tags );
            $sPopupDescription= htmlentities($sPopupDescription, ENT_QUOTES, "UTF-8");
            $sPopupDescription = $sCustPopupDescription . $sPopupDescription;
         }
      }
      else
      {
          $sPopupDescription= fCleanDomTTContent($sql->f("description"));
          $sPopupDescription= htmlentities(strip_tags($sPopupDescription, $default->permited_html_tags), ENT_QUOTES, "UTF-8");      
      }

      // end check

      if (trim($sPopupDescription) == "") 
      {
         $sPopupDescription = $owl_lang->no_description;
      }

  

      $sTitle = $sBoldBegin . $sql->f("name") . $sBoldEnd . "</a>";
      
      $xtpl->assign('FILE_NAME', "<a class=\"$sLfList\" href=\"$url\" onmouseover=" . '"' . "return makeTrue(domTT_activate(this, event, 'caption', '" . $owl_lang->description . "', 'content', '" . $sPopupDescription . "', 'lifetime', " . $default->popup_lifetime . ", 'fade', 'both', 'delay', 10, 'direction', 'north', 'maxWidth', '400', 'statusText', ' ', 'trail', true));\"  title=\"$sAltString: " . $sql->f("filename") . '">' . $sTitle);
      $xtpl->parse('main.DataBlock.File.Name');
   }

   if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
   {
      fPrintCustomFields ($sql->f("doctype"), $iRealFileID, 0, "visible", "readonly");
      //$xtpl->parse('main.DataBlock.File.DocFields');
   }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         $xtpl->assign('FILE_VERSION', $sBoldBegin . $sql->f("major_revision") . "." . $sql->f("minor_revision") . $sBoldEnd);
         $xtpl->parse('main.DataBlock.File.major_minor_revision');
      }
   } 

   if ($sql->f("url") == "1")
   {
      if ($fileid == $sql->f("id"))
      {
         if ($bFileDownload == 1)
         {
            if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
            {
               $xtpl->assign('FILE_FILENAME', "<a class=\"$sLfList\" href=\"" . $sql->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $sql->f("filename") . "\"><b class=\"hilite\">" . $sql->f("filename") . " </b></a>");
            }
            if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
            {
               $xtpl->assign('FILE_SIZE', "<b class=\"hilite\">&nbsp;</b>");
            }
         } 
         else
         {
            if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
            {
               $xtpl->assign('FILE_FILENAME', $sql->f("filename"));
            }
            if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
            {
               $xtpl->assign('FILE_SIZE', "<b class=\"hilite\">&nbsp;</b>");
            }
         } 

         $xtpl->parse('main.DataBlock.File.filename');
         $xtpl->parse('main.DataBlock.File.f_size');
      } 
      else
      {
         //if ($bFileDownload == 1)
         //{
            if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
            {
               if($default->old_action_icons)
               {
                  $xtpl->assign('FILE_FILENAME', "<a class=\"$sLfList\" href=\"" . $sql->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $sql->f("filename") . "\">" . $sql->f("filename") . "</a>");
                  $xtpl->parse('main.DataBlock.File.oldaction_filename');
               }
               else
               {
                     fSetupFileActionMenusXTPL($sql->f("id"), $sql->f("filename"), $sql->f("creatorid"), $sql->f("approved"), $sql->f("checked_out"), $sql->f("url"), $sql->f("parent"), $sql->f("infected"));
                     $xtpl->parse('main.DataBlock.File.filename');
               }
            }
            if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
            {
               $xtpl->parse('main.DataBlock.File.f_size');
            }
      } 
   }
   else
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['id']     = $sql->f("id");
      $urlArgs2['parent'] = $sql->f("parent");
      $url = fGetURL ('download.php', $urlArgs2);

         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if($default->old_action_icons)
            {
               $xtpl->assign('FILE_FILENAME', "<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_download_view\">$sBoldBegin" . $sql->f("filename") . "$sBoldEnd</a>");
               $xtpl->parse('main.DataBlock.File.oldaction_filename');
            }
            else
            {
               fSetupFileActionMenusXTPL($sql->f("id"), $sql->f("filename"), $sql->f("creatorid"), $sql->f("approved"), $sql->f("checked_out"), $sql->f("url"), $sql->f("parent"), $sql->f("infected"));
               $xtpl->parse('main.DataBlock.File.filename');
            }
         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            $xtpl->assign('FILE_SIZE', $sBoldBegin . gen_filesize($sql->f("f_size")) . $sBoldEnd);
            $xtpl->parse('main.DataBlock.File.f_size');
         }
      if ($default->records_per_page == 0)
      {
         if ($sql->f("linkedto") == 0)
         {
            $DBFileCount++; //count number of filez in db 2 use with array
            $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
         }
      }
   }
// SET THE user link if requested if not thne just the name is shown
      if( $default->show_user_info == 1)
      {
         $dDateLastLoging =  date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql->f("id"))) + $default->time_offset); 
         $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " .  $dDateLastLoging  . "\">$sBoldBegin" . uid_to_name($sql->f("creatorid")) . "$sBoldEnd</a>";
         $sLinkToUpdator = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("updatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " . $dDateLastLoging  . "\">$sBoldBegin" . uid_to_name($sql->f("updatorid")) . "$sBoldEnd</a>";
      }
      else
      {
         $sLinkToUser = $sBoldBegin . uid_to_name($sql->f("creatorid")) . $sBoldEnd;
         $sLinkToUpdator = $sBoldBegin . uid_to_name($sql->f("updatorid")) . $sBoldEnd;
      }

         if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
         {
            $xtpl->assign('FILE_CREATOR', $sLinkToUser);
            $xtpl->parse('main.DataBlock.File.creatorid');
         }
         if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
         {
            $xtpl->assign('FILE_UPDATOR', $sLinkToUpdator);
            $xtpl->parse('main.DataBlock.File.updatorid');
         }
         if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
         {
            if ($sql->f("smodified"))
            {
               $xtpl->assign('FILE_MODIFIED', $sBoldBegin . date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset) . $sBoldEnd);
            }
            else
            {
               $xtpl->assign('FILE_MODIFIED', '&nbsp;');
            }
            $xtpl->parse('main.DataBlock.File.smodified');
         }
      if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
      {
         fPrintFileIconsXtpl($sql->f("id"), $sql->f("filename"), $sql->f("checked_out"), $sql->f("url"), $default->owl_version_control, $ext, $parent, $is_backup_folder, $sql->f("approved"));
         $xtpl->parse('main.DataBlock.File.Action');
      }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
      {
         if (($holder = uid_to_name($sql->f("checked_out"))) == "Owl")
         {
            $xtpl->assign('FILE_CHECKEDOUT', $sBoldBegin . '-' . $sBoldEnd);
         } 
         else
         {      
            if( $default->show_user_info == 1)
            {
               $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("checked_out") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\" title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql->f("id"))) + $default->time_offset)  . "\"$sBoldBegin>" . $holder . "$sBoldEnd</a>";
            }
            else
            {
               $sLinkToUser = $sBoldBegin . $holder . $sBoldEnd;
            }
            $xtpl->assign('FILE_CHECKEDOUT', $sLinkToUser);
         } 
         $xtpl->parse('main.DataBlock.File.checked_out');
      }
   } 
   $xtpl->parse('main.DataBlock.File');
} 

   $DBFiles[$DBFileCount + 1] = "[END]"; //end DBfile array

if ($iIsOneRecPrinted == 0)
{
   $xtpl->assign('EMPTY_FOLDER', $owl_lang->empty_folder);
   $xtpl->parse('main.DataBlock.NoRecs');
}
$xtpl->parse('main.DataBlock.Title');
$xtpl->parse('main.DataBlock');

?>
