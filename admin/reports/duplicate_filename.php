<?php
/**
 * duplicate_filename.php
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


$CountLines = 0;
$sql = new Owl_DB;
$sql2 = new Owl_DB;

$sql->query("SELECT id, parent, filename, f_size FROM $default->owl_files_table ORDER BY filename DESC");

$xtpl->assign('DUPLICATE_FILE_REPORT_TITLE', $owl_lang->report7_report_title);

$xtpl->assign('REPORT_TITLE_FILEID', $owl_lang->report7_title_fileid);
$xtpl->assign('REPORT_TITLE_DOCNUM', $owl_lang->report7_title_docnum);
$xtpl->assign('REPORT_TITLE_FILENAME', $owl_lang->report7_title_file_name);
$xtpl->assign('REPORT_TITLE_FILESIZE', $owl_lang->report7_title_file_size);
$xtpl->assign('REPORT_TITLE_FILECOUNT', $owl_lang->report7_title_file_count);
$xtpl->assign('REPORT_TITLE_PATH', $owl_lang->report7_title_file_path);

while ($sql->next_record())
{

   $sql2->query("SELECT filename,  COUNT(filename) AS NumOccurrences FROM files WHERE filename = '" . $sql->f('filename') . "' GROUP BY filename HAVING ( NumOccurrences > 1)");

   $sFileCount = '0';
   $sql2->next_record();
   $sFileCount = $sql2->f('NumOccurrences');
   if ($sql2->num_rows() == 0)
   {
      continue;
   }

   $CountLines++;
   $PrintLines = $CountLines % 2;
   if ($PrintLines == 0)
   {
      $sTrClass = "file2";
   }
   else
   {  
      $sTrClass = "file1";
   }

   $xtpl->assign('REPORT_TD_CLASS', $sTrClass);

   $xtpl->assign('REPORT_FILEID', $sql->f("id"));

   $sZeroFilledId = str_pad($sql->f("id"),$default->doc_id_num_digits, "0", STR_PAD_LEFT);

   $xtpl->assign('REPORT_DOCNUM', $default->doc_id_prefix . $sZeroFilledId);
   $xtpl->assign('REPORT_FILENAME', $sql->f("filename"));
   $xtpl->assign('REPORT_FILESIZE', gen_filesize($sql->f("f_size"))); 
   $xtpl->assign('REPORT_FILECOUNT', $sFileCount);

   $name = find_path($sql->f('parent'), true);
   $xtpl->assign('REPORT_PATH', $name);

   $xtpl->parse('main.Stats.Report'.$execreport.'.Files');
} 
$xtpl->assign('DELETE_LABEL', $owl_lang->del_selected);
$xtpl->assign('DELETE_ALT', $owl_lang->alt_del_selected);
$xtpl->assign('DELETE_CONFIRM', $owl_lang->reallydelete_selected );
?>
