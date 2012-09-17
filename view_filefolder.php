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

   print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n<tr>\n<td align=\"left\" valign=\"top\">\n");
   print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");

   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ( $sess == "0" && $default->anon_ro == 0 ))
      {
         print("<tr>\n<td class=\"title1\">");
         fPrintButtonSpace(1,4);
         print("<a href=\"#\" onclick=\"CheckAll();\">");
         print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/tg_check.gif\" alt=\"$owl_lang->alt_toggle_check_box\" title=\"$owl_lang->alt_toggle_check_box\" border=\"0\" /></a>");
   print("</td>\n");
      }
   }
   if (($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
      print("<td class=\"title1\">&nbsp;</td>\n"); 
   }

   if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
   {
      show_link("id", "sortid", $sortid, $order, $sess, $expand, $parent, $owl_lang->doc_number);
   }
   if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
   {
      print("<td class=\"title1\">&nbsp;</td>\n"); 
   }

   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      print("<td class=\"title1\">&nbsp;</td>\n"); 
   }
   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      show_link("name", "sortname", $sortname, $order, $sess, $expand, $parent, $owl_lang->title);
   }

   if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
   {
       print("<td class=\"title1\">$owl_lang->doc_fields</td>\n");
   }

// STUARTS'S CHANGE 
   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         show_link("major_minor_revision", "sortver", $sortver, $order, $sess, $expand, $parent, $owl_lang->ver);
      }
   } 
   if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
   {
      show_link("filename", "sortfilename", $sortfilename, $order, $sess, $expand, $parent, $owl_lang->file);
   }
   if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
   {
      show_link("f_size", "sortsize", $sortsize, $order, $sess, $expand, $parent, $owl_lang->size);
   }
   if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
   {
      show_link("creatorid", "sortposted", $sortposted, $order, $sess, $expand, $parent, $owl_lang->postedby);
   }
   if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
   {
      show_link("updatorid", "sortupdator", $sortupdator, $order, $sess, $expand, $parent, $owl_lang->updated_by);
   }
   if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
   {
      show_link("smodified", "sortmod", $sortmod, $order, $sess, $expand, $parent, $owl_lang->modified);
   }
   if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
   {
      print("<td class=\"title1\">$owl_lang->actions</td>\n"); 
   }
   if ($default->owl_version_control == 1)
   {  
      if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
      {
         show_link("checked_out", "sortcheckedout", $sortcheckedout, $order, $sess, $expand, $parent, $owl_lang->held);
      }
   } 
   print("</tr>\n");

// Looping out Folders

   if ($default->owl_LookAtHD != "false")
   {
      $sql->query("SELECT * from $default->owl_folders_table where parent = '$parent' $whereclause");
      while ($sql->next_record())
      {
         $DBFolderCount++; //count number of filez in db 2 use with array
         $DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
      }
   }

$sql->query($FolderQuery);

$DBFileCount = 0;

$sql2 = new Owl_DB;

   if ($default->records_per_page > 0)
   {
      $sql2->query("select * from $default->owl_files_table where parent = '$parent'");
      while ($sql2->next_record())
      {
         $DBFileCount++; //count number of filez in db 2 use with array
         $DBFiles[$DBFileCount] = $sql2->f("filename"); //create list if files in
      }
   }

//print("Q: $FileQuery");
$sql2->query($FileQuery);

// **********************
// BEGIN Print Folders
// **********************
$FoldersLeft = $sql->next_record();
$FilesLeft = $sql2->next_record();
$FilesFoldersLeft = 0;

if (($FoldersLeft) && ($FilesLeft))
{
    $FilesFoldersLeft = 1;
}
    $DisplayFolder = 0;
    $DisplayFile = 0;
    
while ($FileFoldersLeft == 0)
{
    if ($DisplayFolder == 1)
    {
         $FoldersLeft = $sql->next_record();

   }
   if ($DisplayFile == 1)
   {
        $FilesLeft = $sql2->next_record();   
   }
       
    $DisplayFolder = 0;
    $DisplayFile = 0;
    
    if ($FoldersLeft)
    {
        if($FilesLeft)            
        {
            //Files AND folders left to display
            if (($sql2->f("name")) < ($sql->f("name")))
            {
                $DisplayFile = 1;
            }
            else
            {
                $DisplayFolder = 1;
            }            

        } 
        else
        {
            //No more files to display but folders left to display
            $DisplayFolder = 1;
        }              
    }
    else
    {   
        if($FilesLeft)
        {   
            //No folders to display but files left to display
            $DisplayFile = 1;
        }   
        else
        {
            //No more files or folders to display
            $FileFoldersLeft = 1;
        }
    }

    if ($DisplayFolder == 1)
    {
       if ($default->restrict_view == 1)
       {
          if (!check_auth($sql->f("id"), "folder_view", $userid, false, false))
          {
             if ($default->records_per_page == 0) 
             {
                $DBFolderCount++; //count number of filez in db 2 use with array
                $DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
             }
             continue;
          } 
       } 
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
          $sTrClass = "file1";
          $sLfList = "lfile1";
       }
       else
       {
          $sTrClass = "file2";
          $sLfList = "lfile1";
       }
     
       print("\t\t\t\t<tr>\n");
       if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
       {
          if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
          {
             print("<td class=\"$sTrClass\">");
             print("<input type=\"checkbox\" name=\"fbatch[]\" value=\"" . $sql->f("id") . "\"></input>");
             print("</td>");
          } 
       } 
    
       if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
       {
          print("<td class=\"$sTrClass\">&nbsp;<br /></td>");
       }
       if(($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
       {
          print("<td class=\"$sTrClass\">&nbsp;<br /></td>");
       }
    
       if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
       {
          print("<td class=\"$sTrClass\">&nbsp;</td>\n");
       }
    
       if(($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
       {
          $urlArgs2 = $urlArgs;
          $urlArgs2['parent'] = $sql->f("id");
          $url = fGetURL ('browse.php', $urlArgs2);
          print("<td class=\"$sTrClass\">");
          print("<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_browse_folder\">");
          print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/folder_closed.gif\" border=\"0\" alt=\"\" />");
          print("</a>");
          print("</td>");
       }
     
    
       if(($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
       {
          print("<td class=\"$sTrClass\">");
          //$sPopupDescription = ereg_replace("\n", '<br />', trim($sql->f("description")));
          $sPopupDescription = nl2br(trim($sql->f("description")));
       
          $urlArgs2 = $urlArgs;
          $urlArgs2['parent'] = $sql->f("id");
          $url = fGetURL ('browse.php', $urlArgs2);
       
          print("\n<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_browse_folder\">" . $sql->f("name") . "</a>");
       
          if(!$default->hide_folder_doc_count)
          {
             if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
             {
                print("&nbsp;(");
             } 
             if ($iFolderCount > 0 )
             {
                print("<a href=\"#\" class=\"cfolders1\" title=\"$owl_lang->folder_count_pre $iFolderCount $owl_lang->folder_count_folder\">$iFolderCount</a>");
             }
             if ($iFileCount > 0 )
             {
                if ($iFolderCount > 0)
                {
                   print(":");
                }
                print("<a href=\"#\" class=\"cfiles1\" title=\"$owl_lang->folder_count_pre $iFileCount $owl_lang->folder_count_file\">$iFileCount</a>");
             }
             if ($iUrlCount  > 0 )
             {
                if ($iFileCount > 0)
                {
                   print(":");
                }
                print("<a href=\"#\" class=\"curl1\" title=\"$owl_lang->folder_count_pre $iUrlCount $owl_lang->folder_count_url\">$iUrlCount</a>");
             }
             if ($iNoteCount > 0)
             {
                if ($iUrlCount  > 0)
                {
                   print(":");
                }
                print("<a href=\"#\" class=\"cnotes1\" title=\"$owl_lang->folder_count_pre $iNoteCount $owl_lang->folder_count_note\">$iNoteCount</a>");
             }
             if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
             {
                print(")");
             }
          }
       
          if (trim($sql->f("description")))
          {
             print("<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\"><a class=\"desc\">" . str_replace("\n", "<br /><img src=$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif border=\"0\" />", $sql->f("description")) . "</a>");
          }
    
          print("</td>\n");
       }
    
       if ($default->records_per_page == 0)
       {
          $DBFolderCount++; //count number of filez in db 2 use with array
          $DBFolders[$DBFolderCount] = $sql->f("name"); //create list if files in
       }
       if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
       {
           print("<td class=\"$sTrClass\" align=\"left\">&nbsp;</td>\n");
       }
    
    
          if ($default->owl_version_control == 1)
          {
             if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\">&nbsp;</td>\n");
             }
             if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\">");
                if(!$default->old_action_icons)
                {
                   $mid->printMenu('vermenuf' .$sql->f("id"));
                }
                else
                {
                   print("&nbsp;");
                }
                print("</td>\n");
             }
             if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
             {
                if ($default->hide_folder_size)
                {
                   print("\t\t\t\t<td class=\"$sTrClass\">&nbsp;</td>\n");
                }
                else
                {
                   $FolderSize = fGetFolderSize($sql->f("id"));
                   print("\t\t\t\t<td class=\"$sTrClass\">" . gen_filesize($FolderSize) . "</td>\n");
                }
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
                print("<td class=\"$sTrClass\" align=\"left\">$sLinkToUser</td>\n");
             }
             if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
             {
                print("<td class=\"$sTrClass\" align=\"left\">&nbsp;</td>\n");
             }
             if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
             {
                if ($sql->f("smodified"))
                {
                   print("<td class=\"$sTrClass\">" . date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset) . "</td>\n");
                }
                else
                {
                   print("<td class=\"$sTrClass\">&nbsp;</td>\n");
                }
             }
          } 
          else
          {
             if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\">");
                if(!$default->old_action_icons)
                {
                   $mid->printMenu('vermenuf' .$sql->f("id"));
                }
                else
                {
                   print("&nbsp;");
                }
                print("</td>\n");
             }
             if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\">&nbsp;</td>\n");
             }
             if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
             {
                print("<td class=\"$sTrClass\" align=\"left\">" . uid_to_name($sql->f("creatorid")) . "</td>\n");
             }
             if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
             {
                print("<td class=\"$sTrClass\" align=\"left\">" . uid_to_name($sql->f("updatorid")) . "</td>\n");
             }
             if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
             {
                if ($sql->f("smodified"))
                {
                   print("<td class=\"$sTrClass\">" . date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset) . "</td>\n");
                }
                else
                {
                   print("<td class=\"$sTrClass\">&nbsp;</td>\n");
                }
             }
          } 
    
          if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
          {
             print("<td class=\"$sTrClass\" align=\"left\">");
    
             // *****************************************
             // There is not Log Icon for folders so put A space
             // *****************************************
       
             if ($default->owl_version_control == 1)
             {
                fPrintButtonSpace(1,21);
             } 
             else
             {
                fPrintButtonSpace(1,2);
             }
    
             // *****************************************
             // Display the Delete Icons For the Folders
             // *****************************************
        
             if (check_auth($sql->f("id"), "folder_delete", $userid, false, false) == 1)
             {
                $urlArgs2 = $urlArgs;
                $urlArgs2['id'] = $sql->f("id");
                $urlArgs2['action'] = 'folder_delete';
                $url = fGetURL ('dbmodify.php', $urlArgs2);
       
                print("<a href=\"$url\" onclick=\"return confirm('$owl_lang->reallydelete " . htmlspecialchars($sql->f("name"), ENT_QUOTES) . "?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" title=\"$owl_lang->alt_del_folder\" border=\"0\" /></a>");
                fPrintButtonSpace(1,4);
             }
             else
             {
                 fPrintButtonSpace(1,18);
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
       
                print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_folder\" title=\"$owl_lang->alt_mod_folder\" /></a>");
                fPrintButtonSpace(1,4);
             }
             else
             {
                 fPrintButtonSpace(1,21);
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
                   print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->alt_set_folder_acl\" title=\"$owl_lang->alt_set_folder_acl\" /></a>");
                                                                                                                                                                     
                    fPrintButtonSpace(1,25);
                }
             }
             else
             {
                fPrintButtonSpace(1,39);
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
       
                 print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_folder\" title=\"$owl_lang->alt_copy_folder\" /></a>");
       
                 fPrintButtonSpace(1,4);
             }
             
             if (check_auth($sql->f("id"), "folder_move", $userid, false, false) == 1)
             {
    
                 $urlArgs2 = $urlArgs;
                 $urlArgs2['id'] = $sql->f("id");
                 $urlArgs2['action'] = 'folder';
                 $urlArgs2['parent'] = $parent;
                 $url = fGetURL ('move.php', $urlArgs2);
    
                 print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_folder\" title=\"$owl_lang->alt_move_folder\" /></a>");
    
                 fPrintButtonSpace(1,92);
             } 
             else
             {
                 fPrintButtonSpace(1,127);
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
                if ($default->owl_version_control == 1)
                {
                   fPrintButtonSpace(1,18);
                } 
                if (trim($checksql->f("email")) != "")
                {
                   if ($checknumrows == 0)
                   {
                      $urlArgs2 = $urlArgs;
                      $urlArgs2['id'] = $folder_id;
                      $urlArgs2['parent'] = $parent;
                      $urlArgs2['action'] = 'folder_monitor';
                      $url = fGetURL ('dbmodify.php', $urlArgs2);
       
                      print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor_folder\" title=\"$owl_lang->alt_monitor_folder\" /></a>");
                   } 
                   else
                   {
                      $urlArgs2 = $urlArgs;
                      $urlArgs2['id'] = $folder_id;
                      $urlArgs2['parent'] = $parent;
                      $urlArgs2['action'] = 'folder_monitor';
                      $url = fGetURL ('dbmodify.php', $urlArgs2);
       
                      print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored_folder\" title=\"$owl_lang->alt_monitored_folder\" /></a>");
                   } 
                   fPrintButtonSpace(1,40);
                } 
                else
                {
                   fPrintButtonSpace(1,39);
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
                   print("<a href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/zip.gif\" border=\"0\" alt=\"$owl_lang->alt_get_folder\" title=\"$owl_lang->alt_get_folder\" /></a>");
                   fPrintButtonSpace(1,1);
                }
                else
                {
                   fPrintButtonSpace(1,17);
                }
             } 
             if ($default->thumbnails == 1 and fisAdmin())
             {
                $urlArgs2 = $urlArgs;
                $urlArgs2['id'] = $sql->f("id");
                $urlArgs2['parent'] = $sql->f("parent");
                $urlArgs2['action'] = 'folder_thumb';
                $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
             }  
             print("</td>\n");
          }
    
          if ($default->owl_version_control == 1)
          {
             if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
             {
                print ("<td class=\"$sTrClass\">&nbsp;</td>\n");
             }
          }
          print("</tr>\n");
    } 
    

    
    //$midf->printFooter();
    //*************************************
    // BEGIN Print Files
    //*************************************
    // 
       
    if ($DisplayFile == 1)
    {

       $bPrintNew = false;
       $bPrintUpdated = false;
       $bFileDownload = check_auth($sql2->f("id"), "file_download", $userid, false, false);
       if ($default->restrict_view == 1)
       {
          if (!$bFileDownload)
          {
             if ($default->records_per_page == 0)
             {
                $DBFileCount++; //count number of filez in db 2 use with array
                $DBFiles[$DBFileCount] = $sql2->f("filename"); //create list if files in
             }
             continue;
          } 
       } 
       if ($sql2->f("approved") == 0)
       {
          $DBFileCount++; //count number of filez in db 2 use with array

          $DBFiles[$DBFileCount] = $sql2->f("filename"); //create list if files in
          continue;           
       } 
  
       // 
       // Find New files
       // 

       if ($bFileDownload == 1)
       {
          if ($sql2->f("created") > $lastlogin)
          {
             $bPrintNew = true;
          } 
          if ($sql2->f("smodified") > $lastlogin && $sql2->f("created") < $lastlogin)
          {
             $bPrintUpdated = true;
          } 
       } 
    
       // ******************************************
       // Check to see if this file as any comments
       // ******************************************

       $bHasComments = true;
       $bPrintNewComment = false;
    
       $CheckComments = new Owl_DB;
    
       $CheckComments->query("SELECT * from $default->owl_comment_table where fid = '" . $sql2->f("id") . "' order by comment_date desc");
    
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
    
       $CheckComments->query("SELECT * from $default->owl_searchidx where owlfileid = '" . $sql2->f("id") . "'");
    
       if ($CheckComments->num_rows() > 0)
       {
          $bWasIndexed = true;
       }
       else
       {
          $bWasIndexed = false;
       }
    
       $iRealFileID = fGetPhysicalFileId($sql2->f('id'));
    
       $CountLines++;
       $PrintLines = $CountLines % 2;
     
       if ($PrintLines == 0)
       {
          $sTrClass = "file1";
          $sLfList = "lfile1";
       }
       else
       {
          $sTrClass = "file2";
          $sLfList = "lfile1";
       }
          print("\t\t\t\t<tr>");
    
       if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
       {
          if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
          {
             print("<td class=\"$sTrClass\">");
             print("<input type=\"checkbox\" name=\"batch[]\" value=\"" . $sql2->f("id") . "\"></input>");
             print("</td>");
          } 
       } 

       if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
       {
          print("<td class=\"$sTrClass\" align=\"left\">");
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
             $urlArgs2['id']     = $sql2->f("id");
             $urlArgs2['parent'] = $parent;
             $urlArgs2['action'] = 'file_comment';
             $url = fGetURL ('modify.php', $urlArgs2);
       
             print("<a class=\"$sLfList\" href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/$iImage.gif\" border=\"0\" alt=\"$iTotalComments --- $owl_lang->alt_comments\" title=\"$iTotalComments --- $owl_lang->alt_comments\" /></a>");
          } 
          if ($default->anon_user <> $userid)
          {
             if ($bPrintNew)
             {
                print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/new.gif\" border=\"0\" alt=\"$owl_lang->alt_new\" />");
             } 
             if ($bPrintUpdated)
             {
                print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/updated.gif\" border=\"0\" alt=\"$owl_lang->alt_updated\" />");
             } 
             if ($bWasIndexed)
             {
                print("&nbsp;<a class=\"curl1\">*</a>");
             }
          } 
       
          print("<br /></td>");
       }

       if (($default->expand_disp_doc_num and $expand == 1) or ($default->collapse_disp_doc_num and $expand == 0))
       {
          $sZeroFilledId = str_pad($sql2->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
          print("<td class=\"$sTrClass\" align=\"left\">");
          if ($fileid == $sql2->f("id"))
          {
             print("<b class=\"hilite\">" . $default->doc_id_prefix . $sZeroFilledId . "</b>");
          }
          else
          {
             print $default->doc_id_prefix . $sZeroFilledId;
          } 
          print("</td>");
    
       }
       if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
       {
          print("<td class=\"$sTrClass\">");
          $sThumbUrl = $default->thumbnails_url . "/" . $default->owl_current_db . "_" . $iRealFileID . "_small.png";
          $sThumbLoc = $default->thumbnails_location . "/" . $default->owl_current_db . "_" . $iRealFileID . "_small.png";
          if (file_exists($sThumbLoc))
          {
             print("<img src=\"$sThumbUrl\" border=\"1\" alt=\"$owl_lang->alt_thumb_small\" title=\"$owl_lang->alt_thumb_small\" />");
          }
          else
          {
             print("&nbsp;\n");
          }
          print("</td>\n");
       }

       if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
       {
    
          print("<td class=\"$sTrClass\" align=\"left\">");
          $choped = split("\.", $sql2->f("filename"));
          $pos = count($choped);
          if ( $pos > 1 )
          {
             $ext = strtolower($choped[$pos-1]);
             if ($iRealFileID == $sql2->f('id'))
             {
                $sDispIcon = $ext . ".gif";
             }
             else
             {
                $sDispIcon = $ext . "_lnk.gif";
             }
          }
          else
          {
             $sDispIcon = "NoExtension";
          }
       
          if (($ext == "gz") && ($pos > 2))
          {
             $exttar = strtolower($choped[$pos-2]);
             if (strtolower($choped[$pos-2]) == "tar")
                $ext = "tar.gz";
          } 
       
          if ($sql2->f("url") == "1")
          {
             print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/url.gif\" border=\"0\" alt=\"\" />");
          }
          else
          {
             if (!file_exists("$default->owl_fs_root/graphics/$default->sButtonStyle/icon_filetype/$sDispIcon"))
             {
                if ($iRealFileID == $sql2->f('id'))
                {
                   $sDispIcon = "file.gif";
                }
                else
                {
                   $sDispIcon = "file_lnk.gif";
                }
             }
    
             $urlArgs2 = $urlArgs;
             $urlArgs2['id']     = $sql2->f("id");
             $urlArgs2['parent'] = $sql2->f("parent");
             $url = fGetURL ('download.php', $urlArgs2);
    
             print("<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_download_view : " . $sql2->f("filename") ."\">");
             print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_filetype/$sDispIcon\" border=\"0\" alt=\"\" /></a>");
          } 
    
          print("<br /></td>\n"); 
       }

       if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
       {
          print("<td class=\"$sTrClass\" align=\"left\">");
    
    
         //check if display custom fields in description window is allowed - added by maurizio (madal2005)
          if ($default->allow_custfieldspopup == 1)
          {
             //build a string with custom fields to add at description string
             if (strlen(fPopCustomFields ($sql2->f("doctype"), $sql2->f("id"), $sql2->f("required")))==0)
             {
                $sPopupDescription= fCleanDomTTContent($sql2->f("description"));
             }
             else
             {
               $sPopupDescription =   fCleanDomTTContent(fPopCustomFields ($sql2->f("doctype"), $sql2->f("id")));
               $sPopupDescription.= fCleanDomTTContent($sql2->f("description"));
             }
          }
          else
          {
              $sPopupDescription= fCleanDomTTContent($sql2->f("description"));
          }
          // end check
    
          if (trim($sPopupDescription) == "") 
          {
             $sPopupDescription = $owl_lang->no_description;
          }
          $urlArgs2 = $urlArgs;
          $urlArgs2['sess']   = $sess;
          $urlArgs2['id']     = $sql2->f("id");
          $urlArgs2['parent'] = $parent;
          $urlArgs2['action'] = 'file_details';
          $url = fGetURL ('view.php', $urlArgs2);
       
          print("\n<a class=\"$sLfList\" href=\"$url\" onmouseover=" . '"' . "return makeTrue(domTT_activate(this, event, 'caption', '" . $owl_lang->description . "', 'content', '" . $sPopupDescription . "', 'lifetime', " . $default->popup_lifetime . ", 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true));" . '"');
       
          print(">\n");
          print("\n");
       
          if ($fileid == $sql2->f("id"))
          {
             print("<b class=\"hilite\">" . $sql2->f("name") . "</b></a>");
          }
          else
          {
             print $sql2->f("name") . "</a>";
          } 
          print("</td>\n");
       }

       if (($default->expand_disp_doc_fields and $expand == 1) or ($default->collapse_disp_doc_fields and $expand == 0))
       {
          print("<td class=\"$sTrClass\">");
          print("<table>\n");
          fPrintCustomFields ($sql2->f("doctype"), $sql2->f("id"), $sql2->f("required"), "visible", "readonly");
          print("</table>\n");
          print("</td>\n");
       }
    
       if ($default->owl_version_control == 1)
       {
          if ($fileid == $sql2->f("id"))
          {
             if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
             {
                print("\n<td class=\"$sTrClass\" align=\"left\"><b class=\"hilite\">" . $sql2->f("major_revision") . "." . $sql2->f("minor_revision") . "</b></td>");
             }
          }
          else
          {
             if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
             {
                print("\n<td class=\"$sTrClass\" align=\"left\">" . $sql2->f("major_revision") . "." . $sql2->f("minor_revision") . "</td>");
             }
          }
       } 

       if ($sql2->f("url") == "1")
       {
          if ($fileid == $sql2->f("id"))
          {
             if ($bFileDownload == 1)
             {
                if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
                {
                   print("\n<td class=\"$sTrClass\" align=\"left\"><a class=\"$sLfList\" href=\"" . $sql2->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $sql2->f("filename") . "\"><b class=\"hilite\">" . $sql2->f("filename") . " </b></a></td>\n");
                }
                if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
                {
                   print("<td class=\"$sTrClass\" align=\"right\"><b class=\"hilite\">&nbsp;</b></td>\n");
                }
             } 
             else
             {
                if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
                {
                   print("\n<td class=\"$sTrClass\" align=\"left\">" . $sql2->f("filename") . "</td>\n");
                }
                if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
                {
                   print("<td class=\"$sTrClass\" align=\"right\"><b class=\"hilite\">&nbsp;</b></td>");
                }
             } 
          } 
          else
          {
             //if ($bFileDownload == 1)
             //{
                if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
                {
                   if($default->old_action_icons)
                   {
                   print("\n<td class=\"$sTrClass\" align=\"left\"><a class=\"$sLfList\" href=\"" . $sql2->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $sql2->f("filename") . "\">" . $sql2->f("filename") . "</a></td>\n");
                      print("</td>\n");
                   }
                   else
                   {
                      print("\n<td class=\"$sTrClass\" align=\"left\">");
                      if(!$default->old_action_icons)
                      {
                         $mid->printMenu('vermenu'.$sql2->f("id"));
                      }
                      else
                      {
                         print("&nbsp;");
                      }
                      print("</td>\n");
                   }
                }
                if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
                {
                   print("<td class=\"$sTrClass\" align=\"right\">&nbsp;</td>\n");
                }
             //} 
             //else
             //{
                //if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
                //{
                   //print("\n<td class=\"$sTrClass\" align=\"left\">" . $sql2->f("filename") . "</td>\n");
                //}
                //if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
                //{
                   //print("<td class=\"$sTrClass\" align=\"right\">&nbsp;</td>\n");
                //}
             //} 
          } 
       }
       else
       {
          $urlArgs2 = $urlArgs;
          $urlArgs2['id']     = $sql2->f("id");
          $urlArgs2['parent'] = $sql2->f("parent");
          $url = fGetURL ('download.php', $urlArgs2);
    
          if ($fileid == $sql2->f("id"))
          {
             if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
             {
                if(!$default->old_action_icons)
                {
                   print("\n<td class=\"$sTrClass\" align=\"left\"><b class=\"hilite\">");
                   $mid->printMenu('vermenu'.$sql2->f("id"));
                   print("</b></a>");
                }
                else
                {
                   print("\n<td class=\"$sTrClass\"  align=\"left\"><a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_download_view\"><b class=\"hilite\">" . $sql2->f("filename") . "</b></a>");
                }
                print("</td>\n");
             }
             if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
             {
                print("<td class=\"$sTrClass\" align=\"right\"><b class=\"hilite\">" . gen_filesize($sql2->f("f_size")) . "</b></td>\n");
             }
          }
          else
          { 
             if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
             {
                if($default->old_action_icons)
                {
                   print("\n<td class=\"$sTrClass\" align=\"left\"><a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_download_view\">" . $sql2->f("filename") . "</a>");
                   print("</td>\n");
                }
                else
                {
                   print("\n<td class=\"$sTrClass\" align=\"left\">");
                if(!$default->old_action_icons)
                {
                   $mid->printMenu('vermenu'.$sql2->f("id"));
                }
                   print("</td>\n");
                }
             }
             if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
             {
                print("<td class=\"$sTrClass\" align=\"right\">" . gen_filesize($sql2->f("f_size")) . "</td>");
             }
          }
          if ($default->records_per_page == 0)
          {
             if ($sql2->f("linkedto") == 0)
             {
                $DBFileCount++; //count number of filez in db 2 use with array
                $DBFiles[$DBFileCount] = $sql2->f("filename"); //create list if files in
             }
          }
       }

    // SET THE user link if requested if not thne just the name is shown
          if( $default->show_user_info == 1)
          {
             $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql2->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql2->f("id")) + $default->time_offset))  . "\">" . uid_to_name($sql2->f("creatorid")) . "</a>";
             $sLinkToUpdator = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql2->f("updatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql2->f("id")) + $default->time_offset))  . "\">" . uid_to_name($sql2->f("updatorid")) . "</a>";
          }
          else
          {
             $sLinkToUser = uid_to_name($sql2->f("creatorid"));
             $sLinkToUpdator = uid_to_name($sql2->f("updatorid"));
          }
    
          if ($fileid == $sql2->f("id"))
          {
             if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\" align=\"left\"><b class=\"hilite\">$sLinkToUser</b></td>\n");
             }
             if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\" align=\"left\"><b class=\"hilite\">$sLinkToUpdator</b></td>\n");
             }
             if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
             {
                if ($sql2->f("smodified"))
                {
                   print("<td class=\"$sTrClass\" align=\"left\"><b class=\"hilite\">" . date($owl_lang->localized_date_format, strtotime($sql2->f("smodified")) + $default->time_offset) . "</b></td>\n");
                }
                else
                {
                   print("<td class=\"$sTrClass\">&nbsp;</td>\n");
                }
             }
          }
          else
          {
             if (($default->expand_disp_posted and $expand == 1) or ($default->collapse_disp_posted and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\" align=\"left\">$sLinkToUser</td>\n");
             }
             if (($default->expand_disp_updated and $expand == 1) or ($default->collapse_disp_updated and $expand == 0))
             {
                print("\t\t\t\t<td class=\"$sTrClass\" align=\"left\">$sLinkToUpdator</td>\n");
             }
             if (($default->expand_disp_modified and $expand == 1) or ($default->collapse_disp_modified and $expand == 0))
             {
                if ($sql2->f("smodified"))
                {
                   print("<td class=\"$sTrClass\" align=\"left\">" . date($owl_lang->localized_date_format, strtotime($sql2->f("smodified")) + $default->time_offset) . "</td>\n");
                }
                else
                {
                   print("<td class=\"$sTrClass\">&nbsp;</td>\n");
                }
             }
          }
          if ((($default->expand_disp_action and $expand == 1) or ($default->collapse_disp_action and $expand == 0)) and $default->old_action_icons)
          {
             print("\t\t\t\t<td class=\"$sTrClass\" align=\"left\">");
             printFileIcons($sql2->f("id"), $sql2->f("filename"), $sql2->f("checked_out"), $sql2->f("url"), $default->owl_version_control, $ext, $parent, $is_backup_folder);
          }
       if ($default->owl_version_control == 1)
       {
          if (($default->expand_disp_held and $expand == 1) or ($default->collapse_disp_held and $expand == 0))
          {
             if (($holder = uid_to_name($sql2->f("checked_out"))) == "Owl")
             {
                print("\t<td class=\"$sTrClass\" align=\"center\">-</td></tr>");
             } 
             else
             {      
                if( $default->show_user_info == 1)
                {
                   $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql2->f("checked_out") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\" title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql2->f("id"))) + $default->time_offset)  . "\">$holder</a>";
                }
                else
                {
                   $sLinkToUser = $holder;
                }
    
                print("\t<td class=\"$sTrClass\" align=\"left\">$sLinkToUser</td></tr>");
             } 

          }
       } 
    }     

}
if ($default->owl_LookAtHD != "false")
{
   $DBFolders[$DBFolderCount + 1] = "[END]"; //end DBfolder array
   $RefreshPage = CompareDBnHD('folder', $default->owl_FileDir . "/" . get_dirpath($parent), $DBFolders, $parent, $default->owl_folders_table);
} 

$DBFiles[$DBFileCount + 1] = "[END]"; //end DBfile array   
   print("</table>");
   print("</td></tr></table>\n");

?>
