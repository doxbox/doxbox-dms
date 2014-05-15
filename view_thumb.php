<?php
/**
 * view_thumb.php -- Thumb Nail view for Browse page
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

defined( 'LABEL_TERMINATOR' ) or die( 'Access Denied' );

$iColumnWidth = round(100 / $default->thumbnail_view_columns);

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

$dGetFolders = new Owl_DB;
$dGetFolders->query($FolderQuery);

// **********************
// BEGIN Print Folders
// **********************

$aRenderLine = array();
$iIsOneRecPrinted = 0;
$RowCount = 0;

while ($dGetFolders->next_record())
{
   if ($default->restrict_view == 1)
   {
      if (!check_auth($dGetFolders->f("id"), "folder_view", $userid, false, false))
      {
         continue;
      } 
   } 

   $iIsOneRecPrinted++;

   // *******************************************
   // Find out how many items (Folders and Files)
   // *******************************************

   $iFolderId = $dGetFolders->f("id");
   
   if(!$default->hide_folder_doc_count)
   {
      $GetItems = new Owl_DB;
   
      $iFolderCount = 0;
      $iParent = $dGetFolders->f("parent");
      $GetItems->query("SELECT id from $default->owl_folders_table where parent = '" . $dGetFolders->f("id") . "'" . $whereclause);
       
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
    
      $iFileCount = fCountFileType ($dGetFolders->f("id"), '0');
      $iUrlCount = fCountFileType ($dGetFolders->f("id"), '1');
      $iNoteCount = fCountFileType ($dGetFolders->f("id"), '2');
   }
 
   $CountLines++;
   $RowCount++;
   $PrintLines = $CountLines % 2;
   
    
   $aRenderLine['type'][$RowCount] = "FOLDER";
   $aRenderLine['id'][$RowCount] = $dGetFolders->f("id");
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
    
   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {
         $aRenderLine['bulk'][$RowCount] = "<input type=\"checkbox\" name=\"fbatch[]\" value=\"" . $dGetFolders->f("id") . "\" />";
      } 
   } 
   
   if(($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
      $aRenderLine['icon'][$RowCount] = "folder_closed";
      $aRenderLine['icon_href_begin'][$RowCount] =  '';
      $aRenderLine['icon_href_end'][$RowCount] =  '';
   }
    
   
   if(($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      $sPopupDescription = nl2br(trim($dGetFolders->f("description")));
    
      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $dGetFolders->f("id");
      $url = fGetURL ('browse.php', $urlArgs2);
       
      $aRenderLine['name'][$RowCount] = "\n<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_browse_folder\">" . $dGetFolders->f("name") . "</a>";
       
      if(!$default->hide_folder_doc_count)
      {
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $aRenderLine['name'][$RowCount] .= "&nbsp;(";
         } 
         if ($iFolderCount > 0 )
         {
            $aRenderLine['name'][$RowCount] .= "<a href=\"#\" class=\"cfolders1\" title=\"$owl_lang->folder_count_pre $iFolderCount $owl_lang->folder_count_folder\">$iFolderCount</a>";
         }
         if ($iFileCount > 0 )
         {
            if ($iFolderCount > 0)
            {
               $aRenderLine['name'][$RowCount] .= ":";
            }
            $aRenderLine['name'][$RowCount] .= "<a href=\"#\" class=\"cfiles1\" title=\"$owl_lang->folder_count_pre $iFileCount $owl_lang->folder_count_file\">$iFileCount</a>";
         }
         if ($iUrlCount  > 0 )
         {
            if ($iFileCount > 0 or $iFolderCount > 0)
            {
               $aRenderLine['name'][$RowCount] .= ":";
            }
            $aRenderLine['name'][$RowCount] .= "<a href=\"#\" class=\"curl1\" title=\"$owl_lang->folder_count_pre $iUrlCount $owl_lang->folder_count_url\">$iUrlCount</a>";
         }
         if ($iNoteCount > 0)
         {
            if ($iUrlCount  > 0 or $iFileCount > 0 or $iFolderCount > 0)
            {
               $aRenderLine['name'][$RowCount] .= ":";
            }
            $aRenderLine['name'][$RowCount] .= ":<a href=\"#\" class=\"cnotes1\" title=\"$owl_lang->folder_count_pre $iNoteCount $owl_lang->folder_count_note\">$iNoteCount</a>";
         }
         if ($iFolderCount > 0 or $iFileCount > 0 or $iUrlCount  > 0 or $iNoteCount > 0)
         {
            $aRenderLine['name'][$RowCount] .= ")";
         }
      }
    
      if (trim($dGetFolders->f("description")))
      {
            $aRenderLine['description'][$RowCount] = "<br /><img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif\" border=\"0\"><a class=\"desc\">" . str_replace("\n", "<br /><img src=$default->owl_graphics_url/$default->sButtonStyle/ui_misc/transparent.gif border=\"0\" />", $dGetFolders->f("description")) . "</a>";
      }
   
   }
   
   if ($default->owl_version_control == 1)
   {
      if ($default->hide_folder_size)
      {
         $aRenderLine['size'][$RowCount] = "";
      }
      else
      {
         $FolderSize = fGetFolderSize($dGetFolders->f("id"));
         $aRenderLine['size'][$RowCount] = gen_filesize($FolderSize);
      }
   
      $aRenderLine['creator'][$RowCount] = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $dGetFolders->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname&amp;curview=$curview\">" . flid_to_creator($dGetFolders->f("id")) . "</a>";
      if ($dGetFolders->f("smodified"))
      {
         $aRenderLine['smodified'][$RowCount] = date($owl_lang->localized_date_format, strtotime($dGetFolders->f("smodified")) + $default->time_offset);
      }
      else
      {
         $aRenderLine['smodified'][$RowCount] = "&nbsp;";
      }
   } 
   else
   {
      $aRenderLine['creator'][$RowCount] = flid_to_creator($dGetFolders->f("id"));
      if ($dGetFolders->f("smodified"))
      {
         $aRenderLine['smodified'][$RowCount] = date($owl_lang->localized_date_format, strtotime($dGetFolders->f("smodified")) + $default->time_offset);
      }
      else
      {
         $aRenderLine['smodified'][$RowCount] = "&nbsp;";
      }
   } 

   $aRenderLine['status'][$RowCount] = "";
   $aRenderLine['docid'][$RowCount] = "";
   
   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $dGetFolders->f("id");
   $url = fGetURL ('browse.php', $urlArgs2);
   
   $aRenderLine['thumb'][$RowCount] = "\n<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_browse_folder\">";
   $aRenderLine['thumb'][$RowCount] .= "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/thumb_folder.png\" border=\"0\" alt=\"" . $dGetFolders->f("id") ."\" />";
   $aRenderLine['thumb'][$RowCount] .= "</a>";
   
   if($default->old_action_icons)
   {
      $aRenderLine['filename'][$RowCount] = $dGetFolders->f("id");
   }
   $aRenderLine['version'][$RowCount] = "";
   $aRenderLine['checkedout'][$RowCount] = "";
   $aRenderLine['imageattr'][$RowCount] = "";
   
   $PrintRow = $CountLines % $default->thumbnail_view_columns;

   if ($PrintRow == "0")
   {
      $aRenderLine = fRenderThumbNails($aRenderLine, $sTrClass);
      $RowCount = 0;
   }
} 

if ($default->owl_LookAtHD != "false")
{
   $DBFolders[$DBFolderCount + 1] = "[END]"; //end DBfolder array
   $RefreshPage = CompareDBnHD('folder', $default->owl_FileDir . DIR_SEP . get_dirpath($parent), $DBFolders, $parent, $default->owl_folders_table);
} 

//*************************************
// BEGIN Print Files
//*************************************
// 

$DBFileCount = 0;

$sql = new Owl_DB;

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

   if ($sql->f("approved") == 0)
   {
      $DBFileCount++; //count number of filez in db 2 use with array
      $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
      continue;
   } 

   // 
   // Find New files
   // 
   $iIsOneRecPrinted++;
 
   if ($bFileDownload == 1)
   {
      if ($sql->f("created") > $lastlogin)
      {
         $bPrintNew = true;
      } 
      if ($sql->f("smodified") > $lastlogin && $sql->f("created") < $lastlogin)
      {
         $bPrintUpdated = true;
      } 
   } 

   // ******************************************
   // Check to see if this file as any comments
   // ******************************************

   $bHasComments = false;
   $bPrintNewComment = false;
   
   $CheckComments = new Owl_DB;
   
   $CheckComments->query("SELECT * from $default->owl_comment_table where fid = '" . $sql->f("id") . "' order by comment_date desc");
   
   $iTotalComments = $CheckComments->num_rows();
   
   $CheckComments->next_record();
   
   if ($CheckComments->f("comment_date") > $lastlogin)
   {
      $bPrintNewComment = true;
   }


   if ($iTotalComments > 0)
   {
      $bHasComments = true;
   } 
   else
   {
      $bHasComments = false;
   }

   // ******************************************
   // Check to see if this file is Word Indexed 
   // ******************************************

   $CheckComments->query("SELECT * from $default->owl_searchidx where owlfileid = '" . $sql->f("id") . "'");

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
   $RowCount++;
    
   $iFileId     = $sql->f("id");
   $aRenderLine['type'][$RowCount] = "FILE";
   $aRenderLine['id'][$RowCount] = $iFileId;
   $aRenderLine['fname'][$RowCount] = $sql->f("filename");
   $aRenderLine['creatorid'][$RowCount] = $sql->f("creatorid");
   $aRenderLine['approved'][$RowCount] = $sql->f("approved");
   $aRenderLine['checked_out'][$RowCount] = $sql->f("checked_out");
   $aRenderLine['url'][$RowCount] = $sql->f("url");
   $aRenderLine['parent'][$RowCount] = $sql->f("parent");
   $aRenderLine['infected'][$RowCount] = $sql->f("infected");

   
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

   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {
         $aRenderLine['bulk'][$RowCount] = "<input type=\"checkbox\" name=\"batch[]\" value=\"" . $sql->f("id") . "\" />";
      } 
   } 
 
   if(($default->expand_disp_status and $expand == 1) or ($default->collapse_disp_status and $expand == 0))
   {
       $aRenderLine['status'][$RowCount] = "";
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
       
         $aRenderLine['status'][$RowCount] = "<a class=\"$sLfList\" href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/$iImage.gif\" border=\"0\" alt=\"$iTotalComments --- $owl_lang->alt_comments\" title=\"$iTotalComments --- $owl_lang->alt_comments\" /></a>";
      } 
   

      if ($default->anon_user <> $userid)
      {
         if ($bPrintNew)
         {
            $aRenderLine['status'][$RowCount] .= "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/new.gif\" border=\"0\" alt=\"$owl_lang->alt_new\" />";
         } 
         if ($bPrintUpdated)
         {
            $aRenderLine['status'][$RowCount] .= "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/updated.gif\" border=\"0\" alt=\"$owl_lang->alt_updated\" />";
         } 
         if ($bWasIndexed)
         {
            $aRenderLine['status'][$RowCount] .= "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/indexed.png\" border=\"0\" alt=\"$owl_lang->alt_indexed\" title=\"$owl_lang->alt_indexed\" />";
         }
      } 
   }

   $sZeroFilledId = str_pad($sql->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);
   $aRenderLine['docid'][$RowCount] = $default->doc_id_prefix . $sZeroFilledId;

   $urlArgs2 = $urlArgs;
   $urlArgs2['binary'] = 1;
   $urlArgs2['id'] = $sql->f("id");
   $urlArgs2['parent'] = $sql->f("parent");
   $sUrl = fGetURL ('download.php', $urlArgs2);

   $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_med.png";

   if (file_exists($sThumbLoc))
   {
      $imdata = file_get_contents($sThumbLoc);
      $sThumbUrl = 'data:image/png;base64,' . base64_encode($imdata);
      $aRenderLine['thumb'][$RowCount] = "<table border=\"0\" class=\"nostyle_table thumb_minus_2px\"><tr><td class=\"img_thumb\"><a href=\"$sUrl\" title=\"" . $sql->f("filename"). "\">";
      $aRenderLine['thumb'][$RowCount] .= "<img data-thumbsize=\"thumb_med_" .  $sql->f("id") . "\" src=\"$sThumbUrl\" border=\"0\" alt=\"" . $sql->f("filename"). "\" /></tr></td></table>";
   }
   else
   {
      $sThumbLoc = "$default->owl_fs_root/templates/$default->sButtonStyle/ui_misc/thumb_no.png";
      $aRenderLine['thumb'][$RowCount] = "<a href=\"$sUrl\" title=\"$owl_lang->alt_no_thumb\">";
      $aRenderLine['thumb'][$RowCount] .= "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/thumb_no.png\" border=\"0\" alt=\"$owl_lang->alt_no_thumb\" title=\"$owl_lang->alt_no_thumb\" \>";
      $aRenderLine['thumb'][$RowCount] .= "</a>";
   }

   if ($default->debug == true)
   {
      $imagedata = GetImageSize($sThumbLoc);
   }
   else
   {
      $imagedata = @GetImageSize($sThumbLoc);
   }

   $maxwidth  =  max($default->thumbnails_med_width, $imagedata[0], $maxwidth);
   $maxheight =  max($thumbnails_med_height, $imagedata[1], $maxheight);

   $sFileExtension = fFindFileExtension($sql->f("filename"));
   $aImageExtensionList = $default->thumbnail_image_type;
   $aVideoExtensionList = $default->thumbnail_video_type;
   $path = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $sql->f("filename");
   
   $imagedata = array();

   if ((preg_grep("/$sFileExtension/", $aImageExtensionList)) and file_exists($path) and exif_imagetype($path))
   {
      if ($default->debug == true)
      {
         $imagedata = GetImageSize("$path");
      }
      else
      {
         $imagedata = @GetImageSize("$path");
      }
      if($imagedata)
      {
         $aRenderLine['imageattr'][$RowCount] = $imagedata[0] . " x " . $imagedata[1];
      }
      else
      {
         $aRenderLine['imageattr'][$RowCount] = " Unknown";
      }
      
      $exif_data = @exif_read_data ($path);
      if ($exif_data)
      {
        $aRenderLine['imageattr'][$RowCount] .= "<br />Make: " . $exif_data['Make'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />Model: " . $exif_data['Model'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />Exposure:" . $exif_data['ExposureTime'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />EF: " . $exif_data['FNumber'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />ISO: " . $exif_data['ISOSpeedRatings'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />Date: " . $exif_data['DateTime'];
        $aRenderLine['imageattr'][$RowCount] .= "<br />-------------------------------------";
      }
   }
   else
   {
      $aRenderLine['imageattr'][$RowCount] = "";
   }


   if (($default->expand_disp_doc_type and $expand == 1) or ($default->collapse_disp_doc_type and $expand == 0))
   {
    
   $ext = fFindFileExtension($sql->f('filename'));

      if (!empty($ext))
      {
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
 
      if ($sql->f("url") == "1")
      {
         $aRenderLine['icon'][$RowCount] = 'url';
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
         $urlArgs2 = $urlArgs;
         $urlArgs2['sess']   = $sess;
         $urlArgs2['id']     = $sql->f("id");
         $urlArgs2['parent'] = $parent;
         $url = fGetURL ('download.php', $urlArgs2);
                                                                                                                                                                                        
         $aRenderLine['icon_href_begin'][$RowCount] =  "<a class=\"$sLfList\" href=\"$url\" title=\"$owl_lang->title_download_view : " . $sql->f("filename") ."\">";
         $aRenderLine['icon'][$RowCount] =  $sDispIcon;
         $aRenderLine['icon_href_end'][$RowCount] =  "</a>";
      } 
   }

   if (($default->expand_disp_title and $expand == 1) or ($default->collapse_disp_title and $expand == 0))
   {
      $sPopupDescription = fCleanDomTTContent($sql->f("description"));

      if (trim($sPopupDescription) == "") 
      {
         $sPopupDescription = $owl_lang->no_description;
      }
      $urlArgs2 = $urlArgs;
      $urlArgs2['sess']   = $sess;
      $urlArgs2['id']     = $sql->f("id");
      $urlArgs2['parent'] = $parent;
      $urlArgs2['action'] = 'file_details';
      $url = fGetURL ('view.php', $urlArgs2);
    
      $aRenderLine['name'][$RowCount] =  "\n<a class=\"$sLfList\" href=\"$url\" onmouseover=" . '"' . sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime) . '"';
 
      $aRenderLine['name'][$RowCount] .= ">\n\n";
 
      $aRenderLine['name'][$RowCount] .=  $sql->f("name") . "</a>";
   }

   if ($default->owl_version_control == 1)
   {
      if (($default->expand_disp_version and $expand == 1) or ($default->collapse_disp_version and $expand == 0))
      {
         $aRenderLine['version'][$RowCount] = $sql->f("major_revision") . "." . $sql->f("minor_revision");
      }
   } 

   if ($sql->f("url") == "1")
   {
      if ($bFileDownload == 1)
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            if($default->old_action_icons)
            {
               $aRenderLine['filename'][$RowCount] = "<a class=\"$sLfList\" href=\"" . $sql->f("filename") . "\" target=\"new\" title=\"$owl_lang->title_browse_site : " . $sql->f("filename") . "\">" . $sql->f("filename") . "</a>";
            }
         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            $aRenderLine['size'][$RowCount] = "&nbsp;";
         }
      } 
      else
      {
         if (($default->expand_disp_file and $expand == 1) or ($default->collapse_disp_file and $expand == 0))
         {
            $aRenderLine['filename'][$RowCount] = $sql->f("filename");
         }
         if (($default->expand_disp_size and $expand == 1) or ($default->collapse_disp_size and $expand == 0))
         {
            $aRenderLine['size'][$RowCount] = "&nbsp;";
         }
      } 
   }
   else
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['id']     = $sql->f("id");
      $urlArgs2['parent'] = $sql->f("parent");
      $url = fGetURL ('download.php', $urlArgs2);
      $aRenderLine['size'][$RowCount] = gen_filesize($sql->f("f_size"));
   }

   if ($default->records_per_page == 0)
   {
      if ($sql->f("linkedto") == 0)
      {
         $DBFileCount++; //count number of filez in db 2 use with array
         $DBFiles[$DBFileCount] = $sql->f("filename"); //create list if files in
      }
   }

   $aRenderLine['creator'][$RowCount] = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("creatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname&amp;curview=$curview\" title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql->f("id"))) + $default->time_offset)  . "\">" . fid_to_creator($sql->f("id")) . "</a>";
   $aRenderLine['updator'][$RowCount] = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("updatorid") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname&amp;curview=$curview\" title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql->f("id"))) + $default->time_offset)  . "\">" . uid_to_name($sql->f("updatorid")) . "</a>";
   if ($sql->f("smodified"))
   {
      $aRenderLine['smodified'][$RowCount] = date($owl_lang->localized_date_format, strtotime($sql->f("smodified")) + $default->time_offset);
   }
   else
   {
      $aRenderLine['smodified'][$RowCount] = "&nbsp;";
   }
   if ($default->owl_version_control == 1)
   {

      if (($holder = uid_to_name($sql->f("checked_out"))) == "Owl")
      {
         $aRenderLine['checkedout'][$RowCount] = "-";
      } 
      else
      {
         $aRenderLine['checkedout'][$RowCount] = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $sql->f("checked_out") . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname&amp;curview=$curview\" title=\"$owl_lang->last_logged " . date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($sql->f("id"))) + $default->time_offset)  . "\">$holder</a>";
      } 
   } 

   $PrintRow = $CountLines % $default->thumbnail_view_columns;

   if ($PrintRow == "0")
   {
      $aRenderLine = fRenderThumbNails($aRenderLine, $sTrClass);
      $RowCount = 0;
   }
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


if ($PrintRow > 0)
{
   $aRenderLine = fRenderThumbNails($aRenderLine, $sTrClass);
}


$DBFiles[$DBFileCount + 1] = "[END]"; //end DBfile array


function fRenderThumbNails($aRenderLine, $sTrClass)
{
   global $default, $owl_lang, $mid, $iColumnWidth, $xtpl;
   global $maxwidth, $maxheight;

   $xtpl->assign('COLUMN_WIDTH', $iColumnWidth);

   $xtpl->assign('MAX_THUMB_WIDTH', $maxwidth + 20);
   $xtpl->assign('MAX_THUMB_HEIGHT', $maxheight);

   for ($c = 1; $c <= $default->thumbnail_view_columns; $c++)
   {
      if ($aRenderLine['id'][$c] > 0)
      {
         $sTitleTDClass = "title1";
      }
      else
      {
         $sTitleTDClass = "title_empty";
         $aRenderLine['status'][$c] = "";
      }
      $xtpl->assign('BULK_CHECKBOX', $aRenderLine['bulk'][$c]);
      if ($default->thumb_disp_status == 1)
      {
         if (isset($aRenderLine['status'][$c]))
         {
            $xtpl->assign('THUMB_FILE_STATUS', $aRenderLine['status'][$c]);
         }
      }
      $xtpl->assign('THUMB_FILE_HREF_BEGIN', $aRenderLine['icon_href_begin'][$c]);
      if (! isset($aRenderLine['icon'][$c]))
      {
       $xtpl->assign('THUMB_FILE_ICON', 'x_clear');
      }
      else
      {
            $xtpl->assign('THUMB_FILE_ICON', $aRenderLine['icon'][$c]);
      }
      $xtpl->assign('THUMB_FILE_HREF_END', $aRenderLine['icon_href_end'][$c]);
      $xtpl->assign('THUMB_FILE_NAME', $aRenderLine['name'][$c]);
      $xtpl->assign('THUMB_TITLE_TD_CLASS', $sTitleTDClass);
      $xtpl->parse('main.ThumbsView.Items.Title');
   }

   $CountLines = 0;
   for ($c = 1; $c <= $default->thumbnail_view_columns; $c++)
   {
      $CountLines++;
      $PrintLines = $CountLines % 2;
      if ($aRenderLine['id'][$c] > 0)
      {
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
      }
      else
      {
            $sTrClass = "file_empty";
      }
      $xtpl->assign('THUMB_FILE_TD_CLASS', $sTrClass);

 
      $xtpl->assign('THUMB_FILE_MED_THUMBNAIL', $aRenderLine['thumb'][$c]);
      $xtpl->assign('THUMB_FILE_IMAGE_SIZE', '');
      $xtpl->assign('THUMB_FILE_MENU', '');
      $xtpl->assign('THUMB_FILE_VERSION', '');
      $xtpl->assign('THUMB_FILE_FILENAME', '');
      $xtpl->assign('THUMB_FILE_DOCID', '');
      $xtpl->assign('THUMB_FILE_SIZE', '');
      $xtpl->assign('THUMB_FILE_POSTEDBY', '');
      $xtpl->assign('THUMB_FILE_UPDATEDBY', '');
      $xtpl->assign('THUMB_FILE_SMODIFIED', '');
      $xtpl->assign('THUMB_FILE_CHECKEDOUT', '');

      $xtpl->assign('THUMB_FILE_IMAGE_SIZE', '&nbsp');
      if(strlen($aRenderLine['imageattr'][$c]) > 1)
      {
         if ($default->thumb_disp_image_info == 1)
         {
           $xtpl->assign('THUMB_FILE_IMAGE_SIZE', $owl_lang->thumb_image_size . " " . $aRenderLine['imageattr'][$c]);
         }
     
      }

 
      if(!$default->old_action_icons)
      {
         $xtpl->assign('THUMB_TEXT', 'nostyle');
         if ($default->thumb_disp_action == 1 and $aRenderLine['id'][$c] > 0)
         {
           if ($aRenderLine['type'][$c] == "FOLDER")
            {
               $xtpl->assign('MED_THUMB_CLASS', 'nostyle');
               $xtpl->assign('THUMB_TEXT', 'nostyle');
               fSetupFolderActionMenusXTPL($aRenderLine['id'][$c], $aRenderLine['name'][$c], 'ThumbsView.Items.FileFolder');
               $xtpl->parse('main.ThumbsView.Items.FileFolder.Folder.filename');
               $xtpl->parse('main.ThumbsView.Items.FileFolder.Folder');
            }
            else
            {
               $xtpl->assign('MED_THUMB_CLASS', 'med_thumbnail med_thumb_view');
               fSetupFileActionMenusXTPL($aRenderLine['id'][$c] , $aRenderLine['fname'][$c], $aRenderLine['creatorid'][$c], $aRenderLine['approved'][$c], $aRenderLine['checked_out'][$c], $aRenderLine['url'][$c], $aRenderLine['parent'][$c], $aRenderLine['infected'][$c], 'ThumbsView.Items.FileFolder');
               if (empty($aRenderLine['id'][$c]))
               {
                  $xtpl->assign('THUMB_TEXT', 'nostyle');
               }
               else
               {
                  $xtpl->assign('THUMB_TEXT', 'thumb_text');
               }
               $xtpl->parse('main.ThumbsView.Items.FileFolder.Clip');
               $xtpl->parse('main.ThumbsView.Items.FileFolder.FileEdge');
               $xtpl->parse('main.ThumbsView.Items.FileFolder.File.filename');
               $xtpl->parse('main.ThumbsView.Items.FileFolder.File');
            }
         }
      }

      if($default->thumb_disp_version == 1)
      {
         if(strlen($aRenderLine['version'][$c]) > 0)
         {
            $xtpl->assign('THUMB_FILE_VERSION', $owl_lang->ver . ":&nbsp;" . $aRenderLine['version'][$c]);
         }
      }

      if (isset($aRenderLine['filename'][$c]))
      {
         $xtpl->assign('THUMB_FILE_FILENAME', $aRenderLine['filename'][$c]);
      }
   
    
      if(strlen($aRenderLine['docid'][$c]) > 0 and $default->thumb_disp_doc_num == 1)
      {
         $xtpl->assign('THUMB_FILE_DOCID', $owl_lang->doc_number . ":&nbsp;" . $aRenderLine['docid'][$c]);
      }

      if ($default->thumb_disp_size == 1)
      {
         if(strlen($aRenderLine['size'][$c]) > 0)
         {
            $xtpl->assign('THUMB_FILE_SIZE', $owl_lang->size . LABEL_TERMINATOR . $aRenderLine['size'][$c]);
         }
      }
 
      if(strlen($aRenderLine['creator'][$c]) > 0 and $default->thumb_disp_posted == 1)
      {
         $xtpl->assign('THUMB_FILE_POSTEDBY', $owl_lang->postedby . LABEL_TERMINATOR . $aRenderLine['creator'][$c]);
      }
      if (isset($aRenderLine['updator'][$c]))
      {
         if(strlen($aRenderLine['updator'][$c]) > 0 and $default->thumb_disp_updated == 1)
         {
            $xtpl->assign('THUMB_FILE_UPDATEDBY', $owl_lang->updated_by . LABEL_TERMINATOR . $aRenderLine['updator'][$c]);
         }
      }
 
      if(strlen($aRenderLine['smodified'][$c]) > 0 and $default->thumb_disp_modified == 1)
      {
         $xtpl->assign('THUMB_FILE_SMODIFIED', $owl_lang->modified . LABEL_TERMINATOR . $aRenderLine['smodified'][$c]);
      }
 
      if(strlen($aRenderLine['checkedout'][$c]) > 0 and $default->thumb_disp_held == 1)
      {
         $xtpl->assign('THUMB_FILE_CHECKEDOUT', $owl_lang->held . LABEL_TERMINATOR . $aRenderLine['checkedout'][$c]);
      }
 
      $xtpl->parse('main.ThumbsView.Items.FileFolder');
 
   }
   $xtpl->parse('main.ThumbsView.Items');
   $aRenderLine = array();
 
   return $aRenderLine;
}

?>
