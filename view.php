<?php
/**
 * view.php
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
 * $Id: view.php,v 1.19 2006/10/19 19:26:45 b0zz Exp $
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpid3v2/class.id3.php");

if (bIsPearAvailable())
{
   require_once($default->owl_fs_root ."/lib/Mail_Mime/mimeDecode.php");
}


if ($default->owl_maintenance_mode == 1)
{
   if(!fIsAdmin(true))
   {
      header("Location: " . $default->owl_root_url . "/index.php?failure=9");
      exit;
   }
}


 
//$clean = ob_get_contents();  
//ob_end_clean();  

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/view.xtpl");
$xtpl = new XTemplate("html/view.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

fSetLogo_MOTD();
fSetPopupHelp();

if ($sess == "0" && $default->anon_ro == 1)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

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


if (!empty($fileid) and is_numeric($fileid))
{
   if (check_auth($fileid, "file_download", $userid) == 1)
   {
     fGeneratePdfFile($fileid);
   }
   else
   {
       printError($owl_lang->err_nofileaccess);
   }
}

// BEGIN what Richard Bartz added to show PDF, DOC, and TXT special view
// While I was at it I added xls, mp3, and ppt.

if ($action == "pdf_show" || $action == "xls_show" || $action == "doc_show" || $action == "ppt_show" || $action == "mp3_play" or $action == "inline" || $action == "video_play")
{
   if (check_auth($id, "file_download", $userid) == 1)
   {
      if ($default->owl_use_fs)
      {
         $fid = fGetPhysicalFileId($id);
         $path = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($fid)) . DIR_SEP . flid_to_filename($fid);
      } 
      else
      {
         $path = fGetFileFromDatbase($id);
      } 
   } 
   else
   {
      printError($owl_lang->err_nofileaccess);
   } 
} 

if ($action == "pdf_show" || $action == "xls_show" || $action == "doc_show" || $action == "ppt_show" || $action == "mp3_play" || $action == "inline")
{

   $sFileName = flid_to_filename($id);

   if ($action == "pdf_show")
   {
      $fspath = fCreateWaterMark($fid);
   }

   if (! $fspath == false)
   {
      $path = $fspath;
   }

   $mimetyp = fGetMimeType(flid_to_filename($id));

   $len = filesize($path);
   ob_clean();
   header("Content-type: $mimetyp");
   header("Content-Length: $len");
   header("Content-Disposition: inline; filename=" . $sFileName);
   header("Content-Transfer-Encoding: binary");
   readfile($path);

   if (!$default->owl_use_fs)
   {
      unlink($path);
   } 
   owl_syslog(FILE_VIEWED, $userid, flid_to_filename($id), $parent, "", "FILE");
   exit;
} 

// end of what Richard Bartz added to show PDF, DOC, and TXT special view
// cv change for security, should deny documents directory
// added image_show that passes the image through
if ($action != "image_show")
{
   include($default->owl_fs_root ."/lib/header.inc");
   include($default->owl_fs_root ."/lib/userheader.inc");
} 

if ($action == "image_show")
{
   if (check_auth($id, "file_download", $userid) == 1)
   {
      if ($default->owl_use_fs)
      {
         $path = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . flid_to_filename($id);
         readfile("$path");
      } 
      else
      {
         $sql = new Owl_DB;
         $filename = flid_to_filename($id);
         $mimeType = fGetMimeType($filename);
         if ($mimeType)
         {
/* BETTER WAY TO DO THINGS MAYBE?

if (function_exists("imagegif")) {
   header("Content-type: image/gif");
   imagegif($im);
} elseif (function_exists("imagejpeg")) {
   header("Content-type: image/jpeg");
   imagejpeg($im, "", 0.5);
} elseif (function_exists("imagepng")) {
   header("Content-type: image/png");
   imagepng($im);
} elseif (function_exists("imagewbmp")) {
   header("Content-type: image/vnd.wap.wbmp");
   imagewbmp($im);
} else {
   die("No image support in this PHP server");
}

*/
            header("Content-Type: $mimeType");
            $sql->query("SELECT data,compressed FROM " . $default->owl_files_data_table . " WHERE id='$id'");
            while ($sql->next_record())
            {
               if ($sql->f("compressed"))
               {
                  $tmpfile = $default->owl_tmpdir . "/owltmp.$id";
                  if (file_exists($tmpfile)) unlink($tmpfile);
                  $fp = fopen($tmpfile, "wb");
                  fwrite($fp, $sql->f("data"));
                  fclose($fp);
                  flush(passthru($default->gzip_path . " -dfc $tmpfile"));
                  unlink($tmpfile);
               } 
               else
               {
                  print $sql->f("data");
               } 
            } 
         } 
      } 
   } 
   else
   {
      printError($owl_lang->err_nofileaccess);
   } 
   die;
} 
if ($action == "video_play")
{
   if (check_auth($id, "file_download", $userid) == 1)
   {
      $xtpl->assign('VIEW_FILE_TITLE', $owl_lang->playing_page_title);
      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }


      printModifyHeaderXTPL();

     fPrintNavBarXTPL($parent);
         $xtpl->assign('VIDEO_BASE_URL', $default->video_base_url);

if ($default->VideoPlayList == 1)
{
   $sSubQuery = "";
   $sGlue = "";
   foreach ($default->aVideoFiles as $sType)
   {
      $sSubQuery .= "$sGlue filename like '%.$sType'";
      $sGlue = " OR ";
   }

   $sQuery = "SELECT * from $default->owl_files_table where parent = '$parent' and ($sSubQuery)";
}
else
{
   $sQuery = "SELECT * from $default->owl_files_table where parent = '$parent' and id = '$id'";
}
      $qGetVideos = new Owl_DB;
      $qGetVideos->query($sQuery);

      while($qGetVideos->next_record())
      {
         if (check_auth($qGetVideos->f('id'), "file_download", $userid) == 1)
	 {
            
            $iFileId = fGetPhysicalFileId($qGetVideos->f('id'));
            $fspath = get_dirpath(owlfileparent($iFileId)) . DIR_SEP .  flid_to_filename($iFileId);
            if ($id == $qGetVideos->f('id'))
            {
               $xtpl->assign('VIDEO_FIRST_TRACK', $fspath);
            }
            $xtpl->assign('VIDEO_TRACK_URL', $fspath);
            $xtpl->assign('VIDEO_TRACK_CLASS', $sClass);
            $xtpl->assign('VIDEO_TRACK_NAME', $qGetVideos->f('name'));
            $sClass = "";
            $xtpl->parse('main.ViewFile.Video.Track');
         }
      }

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXtpl("Bottom");
      }
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.ViewFile.Video');
      $xtpl->parse('main.ViewFile');
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
   }
}
if ($action == "file_details")
{
   if (check_auth($parent, "folder_view", $userid) == 1)
   {
      $xtpl->assign('VIEW_FILE_TITLE', $owl_lang->view_page_title);
      $xtpl->parse('main.ViewFile.ViewFileTitle');
      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }

      printModifyHeaderXTPL();

      fPrintNavBarXTPL($parent);
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_files_table WHERE id = '$id'");
      $sql->next_record();

      $iRealFileID = fGetPhysicalFileId($id);

         $choped = explode("\.", $sql->f("filename"));
         $pos = count($choped);
         $ext = strtolower($choped[$pos-1]);

         $xtpl->assign('FILE_TITLE_LABEL', $owl_lang->title);
         $xtpl->assign('FILE_TITLE', $sql->f("name"));
         // Tiian change 2003-07-31

         $pos = strpos(get_dirpath($sql->f("parent")), "$default->version_control_backup_dir_name");
         if (is_integer($pos) && $pos)
         {
             $is_backup_folder = true;
         }
         else
         {
             $is_backup_folder = false;
         }
         fPrintFileIconsXtpl($sql->f("id"), $sql->f("filename"), $sql->f("checked_out"), $sql->f("url"), $default->owl_version_control, $ext, $sql->f("parent"),$is_backup_folder);

         $browselink = $default->owl_notify_link . "browse.php?sess=0&parent=" . $parent . "&expand=1&fileid=" . $id;
         $downloadLink = $default->owl_notify_link . "download.php?sess=0&parent=" . $sql->f("parent") . "&expand=1&dlfileid=" . $sql->f("id");
         
         $xtpl->assign('FILE_LINK_LABEL', $owl_lang->notify_link);
         $xtpl->assign('FILE_LINKS', $browselink . "<br />" , $downloadLink);

         $xtpl->assign('FILE_NAME_LABEL', $owl_lang->file);
         $xtpl->assign('FILE_NAME', $sql->f("filename") );
         $xtpl->assign('FILE_SIZE', gen_filesize($sql->f("f_size")));

         // if a MP3 tag was found Display the information
         $filepath = $default->owl_FileDir . DIR_SEP . get_dirpath($sql->f("parent")) . DIR_SEP . $sql->f("filename");
         if ($sql->f("url") != 1 && file_exists($filepath))
         {
            $id3 = new id3($filepath);

            if ($id3->id3v11 || $id3->id3v1 || $id3->id3v2)
            {
               $id3->study();
               $xtpl->assign('FILE_MP3_LABEL', $owl_lang->disp_mp3_id);

               $xtpl->assign('FILE_MP3_SONG_LABEL', $owl_lang->disp_mp3_song);
               $xtpl->assign('FILE_MP3_ALBUM_LABEL', $owl_lang->disp_mp3_album);
               $xtpl->assign('FILE_MP3_BITRATE_LABEL', $owl_lang->disp_mp3_bitrate);
               $xtpl->assign('FILE_MP3_DURATION_LABEL', $owl_lang->disp_mp3_duration);
               $xtpl->assign('FILE_MP3_GENRE_LABEL', $owl_lang->disp_mp3_genre);
               $xtpl->assign('FILE_MP3_COMMENT_LABEL', $owl_lang->disp_mp3_comments);

               $xtpl->assign('FILE_MP3_SONG', trim($id3->artists . " - " . $id3->name));
               $xtpl->assign('FILE_MP3_ALBUM', $id3->album);
               $xtpl->assign('FILE_MP3_BITRATE', "$id3->bitrate kbps&nbsp;&nbsp;$id3->frequency Hz&nbsp;$id3->mode");
               $xtpl->assign('FILE_MP3_DURATION', $id3->length);
               $xtpl->assign('FILE_MP3_GENRE', $id3->genre);
               $xtpl->assign('FILE_MP3_COMMENT', $id3->comment);

               $xtpl->parse('main.ViewFile.Details.MP3');
            } 
         } 

         $xtpl->assign('FILE_OWNER_LABEL', $owl_lang->ownership);
         $xtpl->assign('FILE_OWNER', fid_to_creator($id));
         $xtpl->assign('FILE_OWNER_GROUP', group_to_name(owlfilegroup($id)));

         $xtpl->assign('FILE_METADATA_LABEL', $owl_lang->keywords);
         $xtpl->assign('FILE_METADATA', $sql->f("metadata"));

//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
         if ($default->docRel ==1)
         {
            $docRel = new Owl_DB;
            $docRel->query("SELECT related_file_id FROM $default->docRel_table WHERE file_id='$id' ORDER BY related_file_id");
            $i = 0;
            while ($docRel->next_record())
            {
                $relatedDocuments[$i] = $docRel->f("related_file_id");
                $i++;
            }
            fPrintRelatedDocsXTLP($owl_lang->docRel_list . ":", "", "", $relatedDocuments);
        }
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
         fPrintCustomFields ($sql->f("doctype"), $iRealFileID, $sql->f("required"), "visible", "readonly", 'ViewFile.Details');

         $xtpl->assign('FILE_DESCRIPTION_LABEL', $owl_lang->description);
         $xtpl->assign('FILE_DESCRIPTION', nl2br($sql->f("description")));

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXtpl("Bottom");
      }
      } 
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.ViewFile.Details');
      $xtpl->parse('main.ViewFile');
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
} 

if ($action == "image_preview")
{
   if (check_auth($id, "file_download", $userid) == 1)
   {
      $xtpl->assign('VIEW_FILE_TITLE', $owl_lang->viewing_page_title);
      $xtpl->parse('main.ViewFile.ViewFileTitle');
      owl_syslog(FILE_VIEWED, $userid, flid_to_filename($id), $parent, "", "FILE");
      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }
                                                                                                                                                                                                       
      printModifyHeaderXTPL();

      if ($default->owl_use_fs)
      {
         $fid = fGetPhysicalFileId($id);
         $path = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($fid)) . DIR_SEP . flid_to_filename($fid);
      }
      else
      {
         $path = fGetFileFromDatbase($id);
      }

     fPrintNavBarXTPL($parent, $owl_lang->viewing . ":&nbsp;", $id);

     $fid = fGetPhysicalFileId($id);
     $sImagePreviewLocation = $default->thumbnails_location . DIR_SEP . $default->owl_current_db ."_". $fid ."_". flid_to_filename($fid);
 
     copy($path, $sImagePreviewLocation);

     $xtpl->assign('VIEW_ALIGN', 'center');

     $imdata = file_get_contents($sImagePreviewLocation);
     $sThumbUrl = 'data:image/png;base64,' . base64_encode($imdata);

     $xtpl->assign("VIEW_CONTENT", "<img src=\"" . $sThumbUrl . "\" alt=\"\" />");

     if ($default->show_prefs == 2 or $default->show_prefs == 3)
     {
        fPrintPrefsXTPL("Bottom");
     }
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.ViewFile.Other');
      $xtpl->parse('main.ViewFile');
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_nofileaccess);
   } 
} 

if ($action == "zip_preview")
{
   if (check_auth($id, "file_download", $userid) == 1)
   {
      $xtpl->assign('VIEW_FILE_TITLE', $owl_lang->view_page_title);
      $xtpl->parse('main.ViewFile.ViewFileTitle');
      owl_syslog(FILE_VIEWED, $userid, flid_to_filename($id), $parent, "", "FILE");
      $name = flid_to_filename($id);

      if ($default->owl_use_fs)
      {
         $path = find_path($parent) . DIR_SEP . $name;
      } 
      else
      {
         $path = $name;

         $sql->query("SELECT data,compressed FROM $default->owl_files_data_table WHERE id='$id'");
         while ($sql->next_record())
         {
            if ($sql->f("compressed"))
            {
               $tmpfile = $default->owl_tmpdir . "/owltmp.$id.gz";
               $uncomptmpfile = $default->owl_tmpdir . "/owltmp.$id";
               if (file_exists($tmpfile)) unlink($tmpfile);

               $fp = fopen($tmpfile, "wb");
               fwrite($fp, $sql->f("data"));
               fclose($fp);

               system(escapeshellarg($default->gzip_path) . " -df $tmpfile");

               $fsize = filesize($uncomptmpfile);
               $fd = fopen($uncomptmpfile, 'rb');
               $filedata = fread($fd, $fsize);
               fclose($fd);

               fwrite($file, $filedata);
               unlink($uncomptmpfile);
            } 
            else
            {
               $path = $default->owl_tmpdir . "/owltmp.$id.gz";
               if (file_exists($path)) unlink($path);
               $file = fopen($path, 'wb');
               fwrite($file, $sql->f("data"));
               fclose($file);
            } 
         } 
      } 
   

      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }

      printModifyHeaderXTPL();

      fPrintNavBarXTPL($parent, $owl_lang->viewing . ":&nbsp;", $id);

      if ($filext == "tar")
      {
         $expr = "-tvf ";
         $unzipbin = "$default->tar_path $expr " . "\"" . "./" . $path . "\" ";
         if (substr(php_uname(), 0, 7) != "Windows")
         {
            $unzipbin .= " 2>&1";
         } 
         //passthru("$unzipbin");
            $aResults = array();
            $sOutput = '';
            exec($unzipbin, $aResults);
            foreach($aResults as $sLine)
            {
               $sOutput .= "\n$sLine";
            }
            $xtpl->assign('VIEW_ALIGN', 'left');
            $xtpl->assign('VIEW_CONTENT', "<pre>$sOutput</pre>");
      } 
      else if (($filext == "tar.gz") || ($filext == "tgz"))
      {
         $expr = "-tz ";
         $unzipbin = "$default->tar_path $expr  < " . "\"" . "./" . $path . "\" ";
         if (substr(php_uname(), 0, 7) != "Windows")
         {
            $unzipbin .= " 2>&1";
         } 
         //passthru("$unzipbin");
  $aResults = array();
            $sOutput = '';
            exec($unzipbin, $aResults);
            foreach($aResults as $sLine)
            {
               $sOutput .= "\n$sLine";
            }
            $xtpl->assign('VIEW_ALIGN', 'left');
            $xtpl->assign('VIEW_CONTENT', "<pre>$sOutput</pre>");
      } elseif ($filext == "gz")
      {
         $expr = "-lt";
         if ($default->owl_use_fs)
         {
            $unzipbin = "$default->gzip_path $expr " . "\"" . "./" . $path . "\" ";
         }
         else
         {
            $unzipbin = "$default->gzip_path $expr " . "\"" . "" . $path . "\" ";
         }
         if (substr(php_uname(), 0, 7) != "Windows")
         {
            $unzipbin .= " 2>&1";
         } 
         //passthru("$unzipbin");
  $aResults = array();
            $sOutput = '';
            exec($unzipbin, $aResults);
            foreach($aResults as $sLine)
            {
               $sOutput .= "\n$sLine";
            }
  $aResults = array();
            $sOutput = '';
            exec($unzipbin, $aResults);
            foreach($aResults as $sLine)
            {
               $sOutput .= "\n$sLine";
            }
            $xtpl->assign('VIEW_ALIGN', 'left');
            $xtpl->assign('VIEW_CONTENT', "<pre>$sOutput</pre>");
      } 
      else if ($filext == "zip")
      {
         if (file_exists($default->unzip_path)) 
         {
         $expr = "-l";
         $unzipbin = "$default->unzip_path $expr " . "\"" .  $default->owl_FileDir  . DIR_SEP . $path . "\" ";
         if (substr(php_uname(), 0, 7) != "Windows")
         {
            $unzipbin .= " 2>&1";
         } 
            $aResults = array();
            $sOutput = '';
            exec($unzipbin, $aResults);
            foreach($aResults as $sLine)
            {
               $sOutput .= "\n$sLine";
            }
            $xtpl->assign('VIEW_ALIGN', 'left');
            $xtpl->assign('VIEW_CONTENT', "<pre>$sOutput</pre>");
        }
        else
        {
            $xtpl->assign('VIEW_CONTENT', "MISSING External tool (unzip): $default->unzip_path");
        }
      } 

      if (!$default->owl_use_fs)
      {
         @unlink($path);
      } 

      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXtpl("Bottom");
      }

      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.ViewFile.Other');
      $xtpl->parse('main.ViewFile');
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
   } 
   else
   {
      printError($owl_lang->err_nofileaccess);
   } 
} 
// BEGIN wes change
if ($action == "html_show" || $action == "text_show" || $action == "note_show" || $action == "pod_show" || $action == "php_show" or $action == "email_show" or $action == "diff_show")
{


   if (check_auth($id, "file_download", $userid) == 1)
   {
      owl_syslog(FILE_VIEWED, $userid, flid_to_filename($id), $parent, "", "FILE");
      if ($default->owl_use_fs)
      {
         $fid = fGetPhysicalFileId($id);
         $path = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($fid)) . DIR_SEP . flid_to_filename($fid);
      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }
      printModifyHeaderXTPL();
                                                                                                                                                                                                 

         fPrintNavBarXTPL($parent, $owl_lang->viewing . ":&nbsp;", $id);

         if ($action == "text_show" or $action == "note_show" or $action == "html_show") 
         {
            //print("<table><tr><td style:white-space normal;>"); 
            //print("<table><tr><td>"); 
         }

         if ($action == "pod_show")
         {
            if (file_exists($default->pod2html_path))
            {
               $sOwltmpview = $default->owl_tmpdir . "/owltmpview.$id.$sess";
               $mystring = system(escapeshellarg($default->pod2html_path) . " --cachedir=$default->owl_tmpdir --infile=$path --outfile=$sOwltmpview");
               readfile("$sOwltmpview"); 
               myDelete($sOwltmpview); 
            }
            else 
            {
               print("<H2>$owl_lang->err_pod2html_not_found $default->pod2html_path</H2>");
            }
         }
         elseif ($action == "php_show")
         {
                $xtpl->assign('VIEW_CONTENT', highlight_file($path, true));
         }
         elseif ($action == "diff_show")
         {
            include_once($default->owl_fs_root ."/lib/Text/Diff.php");;
            include_once($default->owl_fs_root ."/lib/Text/Diff/Renderer.php");
            include_once($default->owl_fs_root ."/lib/Text/Diff/Renderer/unified.php");
           
            $sFromFile = flid_to_filename($diff_from);
            $sToFile = flid_to_filename($diff_to);
 
            $xtpl->assign('VIEW_ALIGN', 'left');

            $xtpl->assign('VIEW_FILE_TITLE', sprintf($owl_lang->view_diff_heading , $sFromFile, $sToFile));
            $xtpl->parse('main.ViewFile.ViewFileTitle');

            $from_backup = "/$default->version_control_backup_dir_name/";
            $to_backup = "/$default->version_control_backup_dir_name/";
            if ($diff_from == $id)
            {
               $from_backup = "/";
            }
            if ($diff_to == $id)
            {
               $to_backup = "/";
            }
            $lines1 = file($default->owl_FileDir . DIR_SEP . find_path($parent) . $from_backup . $sFromFile);
            $lines2 = file($default->owl_FileDir . DIR_SEP . find_path($parent) . $to_backup . $sToFile);
                                                                                                                                                                                    
            $diff = new Text_Diff($lines1, $lines2);
            $renderer = new Text_Diff_Renderer_unified();
            $xtpl->assign('VIEW_CONTENT', "<pre>" . htmlentities($renderer->render($diff), ENT_COMPAT, 'UTF-8') . "</pre>");

         }
         elseif ($action == "email_show")
         {

    	    $input = implode('', file($path));

	    $params['include_bodies'] = true;
	    $params['decode_bodies']  = true;
	    $params['decode_headers'] = true;

	    $decoder = new Mail_mimeDecode($input);
	    $structure = $decoder->decode($params);

	    $from = $structure->headers[from];
	    $to = $structure->headers[to];
	    $cc = $structure->headers[cc];
	    $date = $structure->headers[date];
	    $subject = $structure->headers[subject];
	    $message = $structure->parts[0]->body;

            print("<b>To:&nbsp;</b>" .htmlentities($to, ENT_COMPAT, $default->charset). "<br />");
            print("<b>From:&nbsp;</b>" .htmlentities($from, ENT_COMPAT, $default->charset). " <br />");
            if (!empty($cc))
            {
               print("<b>CC:&nbsp;</b>" .htmlentities($cc, ENT_COMPAT, $default->charset). " <br />");
            }
            print("<b>Date:&nbsp;</b>" .htmlentities($date, ENT_COMPAT, $default->charset). " <br />");
            print("<b>Subject:&nbsp;</b>" .htmlentities($subject, ENT_COMPAT, $default->charset). " <br />");
            print("<br /><b>Message:</b><br />");
	    $multipart = strpos($structure->headers['content-type'], 'multipart');

	    if ( $multipart == 1 ) 
            {
            //************************************************
            //* Multipart message
            //****
		foreach ($structure->parts as $part) {
			if ($part->ctype_primary == 'text') {
				if ($part->ctype_secondary == 'plain') {
					print("<xmp>".$part->body."</xmp>");
				}
				elseif ($part->ctype_secondary == 'html') {
					print("<br />______________________________<br /><b>HTML-Message:</b><br /><br />");
					print(strip_tags($part->body,'<p><br><br />'));
				}
			}
			if (isset($part->disposition))
				print("<br />______________________________<br /><b>Attachments:</b><br />");
                           $tmpfilename = $part->d_parameters['filename'];
      $choped = explode("\.", $tmpfilename);
      $pos = count($choped);
      if ( $pos > 1 )
      {
         $ext = strtolower($choped[$pos-1]);
         $sDispIcon = $ext . ".gif";
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

         if (!file_exists("$default->owl_fs_root/graphics/$default->sButtonStyle/img/icon_filetype/$sDispIcon"))
         {
            $sDispIcon = "file.gif";
         }

				if ($part->disposition=='inline') {
					$relpath = $default->owl_fs_root . "/Attachments";
					$savefile = $relpath.DIR_SEP.$id."_inline-file_".$tmpfilename;
					if (file_exists($savefile)) unlink($savefile);
					$fp = fopen($savefile, "wb");
					fwrite($fp, $part->body);
					fclose($fp);
					print('<br />inline object: ');
					print('&nbsp;<a class="lfile1" href='.$default->owl_root_url.'/Attachments/'.$id."_inline-file_".$tmpfilename.' target=_new>'.$part->d_parameters['filename']."</a><br />");
				}
				elseif ($part->disposition=='attachment') {
					$relpath = $default->owl_fs_root . "/Attachments";
					$savefile = $relpath.DIR_SEP.$id."_attachment_".$tmpfilename;
					if (file_exists($savefile)) unlink($savefile);
					$fp = fopen($savefile, "wb");
					fwrite($fp, $part->body);
					fclose($fp);
					print('<br />attachment: ');
                                        print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/img/icon_filetype/$sDispIcon\" border=\"0\" alt=\"\" />");
					print('&nbsp;<a class="lfile1" href='.$default->owl_root_url.'/Attachments/'.$id."_attachment_".$tmpfilename.' target=_new>'.$part->d_parameters['filename']."</a><br />");
				}
			}
	    } else {
            //************************************************
            //* Singlepart message
         //****
	    	if ($structure->ctype_primary == 'text') {
			if ($structure->ctype_secondary == 'plain') {
				print("<xmp>".$structure->body."</xmp>");
			}
			elseif ($structure->ctype_secondary == 'html') {
				print(strip_tags($structure->body,'<p><br />'));
			} else {
				print("Not supported secondary content type to text: ".$structure->ctype_secondary."<br>");
			}
	   	 }
	    }
         }
         else
         {
	    $sFileContent = iconv("ISO-8859-1", "UTF8", file_get_contents("$path"));
            $xtpl->assign('VIEW_ALIGN', 'left');
            $xtpl->assign('VIEW_CONTENT', nl2br(htmlentities($sFileContent, ENT_COMPAT, $default->charset)));
         }
      } 
      else
      {
      if ($expand == 1)
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
      }
      else
      {
         $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
      }
      printModifyHeaderXTPL();

         fPrintNavBarXTPL($parent, $owl_lang->viewing . ":&nbsp;", $id);

         $path = fGetFileFromDatbase($id);

               if ($action == "php_show")
               {
                     $xtpl->assign('VIEW_CONTENT', highlight_file($path, true));
               }
               else
               {
                  //print("<xmp>");
                  //echo nl2br(htmlentities(file_get_contents($path), ENT_COMPAT, $default->charset));
                  //print("</xmp>");
               }
      } 

      if ($action == "text_show" or $action == "note_show" or $action == "html_show") 
      {
 
      $urlArgs2 = $urlArgs;
      $urlArgs2['fileid']     = $id;
      $url = fGetURL ('view.php', $urlArgs2);


$xtpl->assign('GENPDF_URL', $url);
$xtpl->assign('GENPDF_ALT', $owl_lang->alt_gen_pdf);
$xtpl->assign('GENPDF_LABEL', $owl_lang->btn_gen_pdf);
$xtpl->parse('main.ViewFile.GenPDF');
       print fGetHiddenFields ($urlArgs2);
      }


fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.ViewFile.Other');
$xtpl->parse('main.ViewFile');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

   } 
   else
   {
      printError($owl_lang->err_nofileaccess);
   } 
} 
?>
