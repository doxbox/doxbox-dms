<?php 
/*
 * search.php
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
 * $Id: search.php,v 1.28 2006/09/27 11:05:49 b0zz Exp $
 */

require_once(dirname(__FILE__)."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/search.xtpl");
$xtpl = new XTemplate("html/search.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

fSetLogo_MOTD();
fSetPopupHelp();

$sql = new Owl_DB;

$files = array();
$folders = array();

if (isset($search_id))
{
     $sql->query("SELECT metadata_search FROM $default->owl_files_table where id = '$search_id'");
     while($sql->next_record()) 
     {
        $query = $sql->f("metadata_search");
     }

     $sql->query("SELECT field_value FROM $default->owl_docfieldvalues_table where file_id = '$search_id'");
     while($sql->next_record()) 
     {
        $query .= " " . $sql->f("field_value");
     }
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
$urlArgs['sortorder'] = $sort;

$dStartTime = time();

$groupid = owlusergroup($userid);

if (isset($withindocs) and is_numeric($withindocs))
{
   $withindocs = 1;
}
else
{
   $withindocs = 0;
}

if (isset($currentfolder) and is_numeric($currentfolder))
{
   $iCurrentFolder = $currentfolder;
}
else
{
   $iCurrentFolder = '';
}


$query = trim($query);
$query = str_replace("+", "\+", $query);
$query = str_replace("*", "\*", $query);
$query = str_replace("'", "\'", $query);
$query = str_replace("}", "\}", $query);
$query = str_replace("{", "\{", $query);

$xtpl->assign('SEARCH_PAGE_TITLE', $owl_lang->searching_page_title);

if (strlen(trim($query)) == 0) 
{
include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");


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
   fPrintPrefsXtpl("Top");
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent, $owl_lang->search . ":&nbsp;");

if ($default->show_search == 1 or $default->show_search == 3)
{
   $keywords = $query;
   fPrintSearchXTPL('Top', 0, $withindocs, $iCurrentFolder);
}

if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
{
      if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
      {
         if (check_auth($parent, "folder_view", $userid, false, false) == 1)
         {
            fPrintBulkButtonsXTPL("Top");
         }
      }
      if ($default->show_action == 1 or $default->show_action == 3 or (fIsAdmin() and $default->show_action == 0))
      {
            fPrintActionButtonsXTLP();
      }
}


      $iColspan = 0;
      $iColspan = fPrintTitleRowXTPL();

   $xtpl->assign('COLSPAN', $iColspan);
   if (isset($search_id))
   {
      $xtpl->assign('ERROR_MESSAGE', $owl_lang->related_query_empty);
      $xtpl->assign('ERROR_MSG_CLASS', 'error_message');
   }
   else
   {
      $xtpl->assign('ERROR_MESSAGE', $owl_lang->query_empty . ' (1)');
      $xtpl->assign('ERROR_MSG_CLASS', 'error_message');
   }

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {
      fPrintPrefsXtpl("Bottom");
   }
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->parse('main.Search.ErrorMsg');
   $xtpl->parse('main.Search');
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');
   exit;
}

// added by rsa@newtec.be (Ruben Samaey)
// setting up a second db connection to search tables based on a still running query
// needed for searching for matches in comments attached to files
$sql_two = new Owl_DB;
// end add by rsa

if ( $parent == 1)
{
   $currentfolder = 0;
}

function fFolderList( $FolderId )
{
   global $default;
   $qGetFolderList = new Owl_DB;
   $qGetFolderList->query("SELECT id from $default->owl_folders_table where parent = '$FolderId'");

   while ( $qGetFolderList->next_record())
   {
      $sFolderWhereClause .= " or id = '" . $qGetFolderList->f("id") . "'";
      $sFolderWhereClause .= fFolderList($qGetFolderList->f("id"));
   } 
   return $sFolderWhereClause;
}

if ($currentfolder == 1)
{
   // BEGIN OLD SEARCH CURRENT FOLDER ONLY

   $flag = 0;
   $ids = " parent='" . $parent . "'";
   $sFolderWhereClause = "";
   while ($flag != 1)
   {
      $sql->query("SELECT id FROM $default->owl_folders_table WHERE name <> '$default->version_control_backup_dir_name' AND  $ids");
      if ($sFolderWhereClause == "")
      {
          $sFolderWhereClause = $ids;
      }
      else
      {
          $sFolderWhereClause = $sFolderWhereClause . " OR " . $ids;
      }
      $ids = "";
      $sql->next_record();
      $numrows = $sql->num_rows($sql);
      if ($numrows == 0)
      {
         $flag = 1;
      }
      else
      {
         $ids = " parent='" . $sql->f("id") . "'";
         while ($sql->next_record())
         {
            $ids = $ids . " OR parent = " . $sql->f("id");
         }
      }
   }
   $sql->query("SELECT * FROM $default->owl_folders_table WHERE name <> '$default->version_control_backup_dir_name' AND (id = '$parent' or $sFolderWhereClause)"); 
}
else
{
  $sFolderWhereClause = "";
   if ($default->HomeDir <> 1)
   {
      $sFolderWhereClause = " and (id = '$default->HomeDir'";
      $sFolderWhereClause .= fFolderList($default->HomeDir);
      $sFolderWhereClause .= ")";
   }
   $sql->query("SELECT * FROM $default->owl_folders_table WHERE name <> '$default->version_control_backup_dir_name' $sFolderWhereClause");
}



include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");


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
   fPrintPrefsXtpl("Top");
}

if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
{
   fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
}

fPrintNavBarXTPL($parent, $owl_lang->search . ":&nbsp;");

if ($default->show_search == 1 or $default->show_search == 3)
{
   $keywords = $query;
   fPrintSearchXTPL('Top', 0, $withindocs, $iCurrentFolder);
}  

if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
{
      if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
      {
         if (check_auth($parent, "folder_view", $userid, false, false) == 1)
         {
            fPrintBulkButtonsXTPL("Top");
         }
      }
      if ($default->show_action == 1 or $default->show_action == 3 or (fIsAdmin() and $default->show_action == 0))
      {
            fPrintActionButtonsXTLP();
      }
}

$xtpl->assign('SEARCH_FOR_FOLDERS', $owl_lang->search_for_folders);
//
// get all the folders that the user can read

$iCount=0;
$iResults=0;
while($sql->next_record()) 
{
   $id = $sql->f("id");
   $iCreatorID = $sql->f("creatorid");

   $iCount++;
   $PrintDot = $iCount % 50;

   $folders[$id] = $id;

   $sQuery = explode(" ", $query);

   $cleanedup = array(); 

   $sTempVar = '';

   foreach ($sQuery as $searchstring)
   {
      $sTempVar = str_replace('-','', stripslashes($searchstring));
      $sTempvar = preg_replace( '/\s+/', ' ', $sTempVar );
      $cleanedup[] = $sTempVar;
   }

   $sQuery = $cleanedup;


   foreach($sQuery as $keyword)
   {
      if($keyword <> "*")
      {
         if (empty($aFolderCreators[$iCreatorID]))
         {
            $sFolderCreator = uid_to_name($sql->f("creatorid"));
            $aFolderCreators[$iCreatorID] = $sFolderCreator;
         }
         else
         {
            $sFolderCreator = $aFolderCreators[$iCreatorID];
         }

         switch ($boolean)
         {
            case "exact" :
               $sKeyWord = '^' . $keyword . '$';
               break;
            case "startwith" :
               $sKeyWord = '^' . $keyword;
               break;
            case "endwith" :
               $sKeyWord = $keyword . '$';
               break;
            default:
               $sKeyWord = $keyword;
            break;
         }

         if(eregi("$sKeyWord", $sql->f("name")) or eregi("$keyword", $sql->f("description")) or eregi("$keyword", $sFolderCreator))
         {
            if(check_auth($id, "folder_view", $userid, false, false) == 1) 
            {
               $iResults=1;
               if (!isset($aFolderMatchSearch[$id]['score']))
               {
                  $aFolderMatchSearch[$id]['score'] = 2;
               }
               else
               {
                  $aFolderMatchSearch[$id]['score'] += 2;
               }
               $aFolderMatchSearch[$id]['id'] = $id;
               $aFolderMatchSearch[$id]['name'] = $sql->f("name");
               $aFolderMatchSearch[$id]['description'] = $sql->f("description");
               $aFolderMatchSearch[$id]['creator'] = $sFolderCreator;
               $aFolderMatchSearch[$id]['modified'] = $sql->f("smodified");
               $aFolderMatchSearch[$id]['parent'] = $sql->f("parent");
            }
         }
      }
   }
}


$xtpl->assign('SEARCH_FOR_FILES', $owl_lang->search_for_files);
//
// get all the files in those folders that the user can read

$iCount=0;

#Clean up the keywords a bit (remove all commas and duplicate spaces)
$sqlquery = "";
$glue = "";
if ($withindocs == "1")
{
   $keywords = mb_strtolower(fReplaceSpecial($query));
}
else
{ 
   $keywords = $query;
}
$keywords = str_replace(', ', ' ', $keywords);
$keywords = str_replace(',', ' ', $keywords);
$keywords = str_replace('  ', ' ', $keywords);
$keywords = stripslashes($keywords);
$keywords = str_replace('\\\\', '\\', $keywords);

#Replace asterisks with % signs for MySQL wildcards
$keywords = str_replace("*", "%", $keywords);

switch ($boolean)
{
   case "exact" :
      $cBeginSqlWildCard = '';
      $cEndSqlWildCard = '';
      break;
   case "startwith" :
      $cBeginSqlWildCard = '';
      $cEndSqlWildCard = '%';
      break;
   case "endwith" :
      $cBeginSqlWildCard = '%';
      $cEndSqlWildCard = '';
      break;
   default:
      $cBeginSqlWildCard = '%';
      $cEndSqlWildCard = '%';
   break;
}

#Tack the search terms onto the query
if ($withindocs == "1")
{
   $keywordid = "";
   $sqlquery .= " AND (";
   $aWordQuery = array();

   if($boolean == "phrase")
   {
      #Match the entire term
      $keywords = strtolower($keywords);

      $sql->query("SELECT * from $default->owl_wordidx where word like '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."'");
      if ($sql->num_rows() > 0)
      {
         while($sql->next_record())
         {
            $keywordid .= " OR wordid = '" . $sql->f("wordid") . "'";
         }
      }
      else
      {
         $keywordid = " OR wordid = '-1' ";
      }

      $aWordQuery[$tok] = substr($keywordid, 4);

      if(is_numeric($keywords))
      {
         $sCheckForFileId = "f.id = '$keywords' OR ";
      }
      else
      {
         $sCheckForFileId = "";
      }
      $sqlquery .= "$sCheckForFileId name_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR metadata_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR description_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR filename_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' $keywordid";
   }
   else
   {
      #Match any or all words
      $keywordid = '';
      $tok = strtok($keywords, " ");
      $aWordQuery = array();
      $keywordid = " wordid = '-1' ";
      $sOpperator = "";
      while($tok !== false)
      {
         $tok = fReplaceSpecial($tok);

         if($boolean == "all")
         {
            $sql->query("SELECT * from $default->owl_wordidx where word like '" . "$tok" ."'");
            $sOpperator = "OR";
         }
         else
         {
            $sql->query("SELECT * from $default->owl_wordidx where word like '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."'"); 
            $sOpperator = "OR";
         }

         if ($sql->num_rows() > 0)
         {
            while($sql->next_record())
            {
               $keywordid .= " $sOpperator wordid = '" . $sql->f("wordid") . "'";
            }
         }
         else
         {
            if($boolean == "all")
            {
               $aWordQuery = array();
               $keywordid = " wordid = '-1' ";
               $aWordQuery[$tok] = $keywordid;
               break;                  
            }                  
            else
            {
               $keywordid = " wordid = '-1' ";
            }
         }

         $aWordQuery[$tok] = $keywordid;

         if(is_numeric($keywords))
         {
            $sCheckForFileId = "f.id = '$keywords' OR ";
         }
         else
         {
            $sCheckForFileId = "";
         }
         $tok = strtok(" ");
      }

      $glue = "";
      foreach ($aWordQuery as $tok => $keywordid)
      {
         $sqlquery .= "$glue ($sCheckForFileId name_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' OR metadata_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' OR description_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' OR filename_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' ) ";
         $glue = ($boolean == "all") ? " AND" : " OR";
      }
      $sqlquery .= $glue . "($keywordid)";
   }
   $sqlquery .= ")";
}       
else // END Withing Docs = 1
{
   $sqlquery2 = '';
   $sqlquery .= " AND ((";
   if($boolean == "phrase")
   {
      $glue3 = "  ";
      #Match the entire term
      $sql = new Owl_DB;
      if(is_numeric($keywords))
      {
         $sCheckForFileId = "f.id = '$keywords' OR ";
      }
      else
      {
         $sCheckForFileId = "";
      }
      $sqlquery .= "$sCheckForFileId  name_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR metadata_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR description_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' OR filename_search LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."' )";

      $sql_two->query("select field_name from $default->owl_docfields_table");
      $iQueryTwo = $sql_two->num_rows();
      if ( $iQueryTwo > 0)
      {
         $sqlquery2 .= " OR (";
         while($sql_two->next_record())
         {
            $sqlquery2 .= "$glue3 (field_name='". $sql_two->f("field_name") ."' and field_value LIKE '" . $cBeginSqlWildCard . $keywords . $cEndSqlWildCard ."')";
            $glue3 = " OR ";
         }
         $sqlquery2 .= ")";
      }
   }
   else
   {
      #Match any or all words
      $tok = strtok($keywords, " ");

      while($tok !== false)
      {
         $glue3 = "";
         $sql_two->query("select field_name from $default->owl_docfields_table");
         $iQueryTwo = $sql_two->num_rows();
         if ( $iQueryTwo > 0)
         {
            $sqlquery2 .= " OR (";

            while($sql_two->next_record())
            {
               $sqlquery2 .= "$glue3 (field_name='". $sql_two->f("field_name") ."' and field_value LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."')";
               //$glue3 = ($boolean == "all") ? " AND" : " OR";
               $glue3 = " OR ";
            }
            $sqlquery2 .= ")";
         }
         if(is_numeric($keywords))
         {
            $sCheckForFileId = "f.id = '$keywords' OR ";
         }
         else
         {
            $sCheckForFileId = "";
         }

         $cleantok = fReplaceSpecial($tok);

         $sqlquery .= "$glue ($sCheckForFileId 
                      name LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR name LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR name_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR name_search LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR metadata LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR metadata LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR metadata_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR metadata_search LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR description LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR description LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR description_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."' 
                      OR description_search LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."' 
                      OR filename_search LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."'
                      OR filename_search LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."'
                      OR filename LIKE '" . $cBeginSqlWildCard . "$tok" . $cEndSqlWildCard ."'
                      OR filename LIKE '" . $cBeginSqlWildCard . "$cleantok" . $cEndSqlWildCard ."')";

         $glue = ($boolean == "all") ? " AND" : " OR";

         $tok = strtok(" ");
         
      }
      $sqlquery2 .= ")";
   }
   $sqlquery .= ")";
} 

if ($withindocs == "1")
{
  $sql->query("SELECT distinct  f.id as fid, f_size, smodified, parent, name, name_search  metadata, metadata_search, description, description_search, filename, filename_search, checked_out, url, doctype, updatorid, creatorid FROM $default->owl_files_table f left outer join $default->owl_searchidx on owlfileid=f.id where approved = '1' $sqlquery ");

}
else
{
  $sSearchQuery = "SELECT f_size, smodified, f.id as fid, parent, name, name_search, metadata, metadata_search, description, description_search, filename, filename_search, checked_out, url, doctype, updatorid, creatorid  FROM $default->owl_files_table f left outer join $default->owl_docfieldvalues_table d on f.id=file_id where approved = '1' $sqlquery $sqlquery2";
  $sql->query($sSearchQuery);
  $sqlquery2 = "";
}

/* We are done bulding the query for Finding Files now lets have a look a the results */ 
$oldid = '';
while($sql->next_record()) 
{
   $id = $sql->f("fid");
   if ($oldid == $id) 
   {
      $files[$id]['score'] += 1;
      continue;
   } 
   /** IF this file is Not in the User Accesible Folders list then Skip it */
   if (in_array($sql->f("parent"), $folders))
   {
      if(check_auth($id, "file_download", $userid, false, false) == 1) 
      {
         // perform a query to fetch all comments attached to the current file the user is authorized to download
         // all comments found are concattenated in $comment
         $comment = "";
         $sql_two->query("SELECT comments FROM $default->owl_comment_table where fid = '$id'");
         while($sql_two->next_record())  
         {
            $comment .= " ";
            $comment .= $sql_two->f("comments");
         }

         $searchable_custom_fields = "";
          
         $sql_two->query("select * from $default->owl_docfieldvalues_table v left join $default->owl_docfields_table d on v.field_name = d.field_name where file_id = '$id' and searchable = 1;");
         while($sql_two->next_record())  
         {
            $searchable_custom_fields .= " ";
            $searchable_custom_fields .= $sql_two->f("field_value");
         }
 
         $files[$id]['id'] = $id;
         $files[$id]['up_id'] = $sql->f("updatorid");
         $files[$id]['n'] = $sql->f("name");
         $files[$id]['n_s'] = $sql->f("name_search");
         $files[$id]['m'] = explode(" ", $sql->f("metadata"));
         $files[$id]['m_s'] = explode(" ", $sql->f("metadata_search"));
         $files[$id]['d'] = explode(" ", $sql->f("description"));
         $files[$id]['d_s'] = explode(" ", $sql->f("description_search"));
         $files[$id]['f'] = $sql->f("filename");
         $files[$id]['f_s'] = $sql->f("filename_search");
         $files[$id]['c'] = $sql->f("checked_out");
         $files[$id]['u'] = $sql->f("url");
         $files[$id]['p'] = $sql->f("parent");
         $files[$id]['x'] = $sql->f("description");
         $files[$id]['s'] = $sql->f("f_size");
         $files[$id]['doctype'] = $sql->f("doctype");
         $files[$id]['creator'] = $sql->f("creatorid");
         $files[$id]['date'] = $sql->f("smodified");
         $files[$id]['comments'] = explode(" ",$comment);
         $files[$id]['custom'] = explode(" ",$searchable_custom_fields);
 
        $iCount++;
        $PrintDot = $iCount % 50;
        if ($PrintDot == 0)
        {
           print(".");
        }
        $files[$id]['score'] = 0;
        $oldid = $id;
      }
   }
}

$xtpl->assign('SEARCH_SCORE', $owl_lang->search_score);
//
// right now we have the array $files with all possible files that the user has read access to

if (strlen(trim($query))>0) 
{
   //
   // break up our query string
   $query = str_replace('\\\\','\\', stripslashes($query));
   $query = str_replace('-','', stripslashes($query));
   $query = preg_replace( '/\s+/', ' ', $query );

   $query = explode(" ", $query);
   //
   // the is the meat of the matching
   if(sizeof($files) > 0) 
   {
      foreach($query as $keyword) 
      {
         if($keyword <> "*")
         {
            if (isset($aWordQuery))
            {
               $sWordQuery = $aWordQuery[$keyword];
            }
            foreach(array_keys($files) as $key) 
            {
               // BEGIN enhancement Sunil Savkar
               // if the $parent string contains a keyword to be searched, then the score is
               // adjusted.  This takes into account the hierarchy.
               if ($files[$key]['id'] == $keyword)
               {
                  $iResults = 1;
                  $files[$key]['score'] = $files[$key]['score'] + 7;
               }
               if(eregi("$keyword", find_path($files[$key]['p'], true))) 
               {    
                  $iResults = 1;
                  $files[$key]['score'] = $files[$key]['score'] + 4;
               }
               if(eregi("$keyword", $files[$key]['n']) or eregi("$keyword", $files[$key]['n_s']))
               {
                  $iResults = 1;
                  $files[$key]['score'] = $files[$key]['score'] + 4;
               }
               if(eregi("$keyword", $files[$key]['f']) or eregi("$keyword", $files[$key]['f_s']))
               {
                  $iResults = 1;
                  $files[$key]['score'] = $files[$key]['score'] + 3;
               }

               foreach($files[$key]['m'] as $metaitem) 
               {
                  // add 2 to the score if we find it in metadata (key search items)
                  if(eregi("$keyword", $metaitem)) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 2;
                  }
               }
               foreach($files[$key]['m_s'] as $metaitem) 
               {
                  // add 2 to the score if we find it in metadata (key search items)
                  if(eregi("$keyword", $metaitem)) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 2;
                  }
               }
               // added by rsa@newtec.be
               // search the exploded comment array
               foreach($files[$key]['comments'] as $commentitem) 
               {
                  // add 1 to the score if we find it in comments
                  if(eregi("$keyword", $commentitem)) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 1;
                  }
               }
               // end add rsa
               // search the exploded comment array
               foreach($files[$key]['custom'] as $customitem)
               {
                  if(eregi("$keyword", $customitem))
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 5;
                  }
               }

               foreach($files[$key]['d_s'] as $descitem) 
               {
                  // only add 1 for regular description matches
                  if(eregi("$keyword", $descitem)) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 1;
                  }
               }
               foreach($files[$key]['d'] as $descitem) 
               {
                  // only add 1 for regular description matches
                  if(eregi("$keyword", $descitem)) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 1;
                  }
               }
               if ($withindocs == "1")
               {
                  $x = $files[$key]['id'];
                  $keyword = strtolower($keyword);
                  //if(DoesFileIDContainKeyword($files[$key][id], $keyword) > 0) 
                  if(DoesFileIDContainKeyword($files[$key]['id'], $sWordQuery) > 0) 
                  {
                     $iResults = 1;
                     $files[$key]['score'] = $files[$key]['score'] + 5;
                  }
               }
               $iCount++;
               $PrintDot = $iCount % 50;
               if ($PrintDot == 0)
               {
                  //print(".");
               }
            }
         }
      }
   }
$xtpl->assign('SEARCH_SCORE', $owl_lang->search_score);

   $iOnePrinted = 0;
// gotta find order to the scores...any better ideas?
   if ($iResults > 0)
   {
      $diff = time()-$dStartTime;
      $minsDiff = floor($diff/60);
      $diff -= $minsDiff*60;
      $secsDiff = $diff;

      $xtpl->assign('SEARCH_ELAPSE', "(" . $owl_lang->elapsed_time . " ". $minsDiff.'m '.$secsDiff.'s)');
      $xtpl->assign('SEARCH_FOR_QUERY', $owl_lang->search_results_for . " &ldquo;".htmlspecialchars(str_replace('\\\\','\\', stripslashes(implode(" ", $query))))."&rdquo;");

      $max = 90;
      $hit = 1;
      $CountLines = 0;
      $iOnePrinted = 1;

      fPrintTitleRowXTPL();

      if (isset($aFolderMatchSearch) and $default->search_result_folders)
      {
       arsort($aFolderMatchSearch);
       foreach(array_keys($aFolderMatchSearch) as $fkey)
       {
          if(check_auth($aFolderMatchSearch[$fkey]['id'], "folder_view", $userid, false, false) == 0) 
   	  {
             continue;
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

        $xtpl->assign('FOLDER_TR_CLASS', $sTrClassHilite);
        $xtpl->assign('FOLDER_TR_MOUSOVER', "onMouseOver=\"this.className='$sTrClassHiliteAlt'\" onMouseOut=\"this.className='$sTrClassHilite'\"");
        $xtpl->assign('FOLDER_TD_CLASS', $sTrClass);
        $xtpl->assign('FOLDER_AHREF_CLASS', $sLfList);


   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {
         $xtpl->parse('main.Search.Folder.Bulk');
      }
   }


         if (($default->expand_search_disp_score and $expand == 1)  or ($default->collapse_search_disp_score and $expand == 0))
         {
                  $t_score = $aFolderMatchSearch[$fkey]['score']; 
                 $xtpl->assign('FOLDER_SCORE_ALT', $owl_lang->score . " - " . $t_score);
                 $xtpl->assign('FOLDER_SCORE_LABEL', $t_score);
                  for ($c=$max; $c>=1; $c--)
                  {
                     if ( $t_score >= 10)
                     {
                        if ( 0 == ($c % 10))
                        {
                           $xtpl->assign('FOLDER_SCORE_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/star10.gif\" border=\"0\" title=\"10 Points\" />");
                           $xtpl->parse('main.Search.Folder.Score.Image');
                           $t_score = $t_score - 10;
                        }
                     }
                     else
                     {
                        if ( (0 == ($t_score % 2)) and $t_score > 0 )
                        {
                           $xtpl->assign('FOLDER_SCORE_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/star.gif\" border=\"0\" title=\"2 Points\" />");
                           $xtpl->parse('main.Search.Folder.Score.Image');
                        }
                        $t_score = $t_score - 1;
                     }

                  }
                  $xtpl->parse('main.Search.Folder.Score');
             }
         if (($default->expand_search_disp_folder_path and $expand == 1) or ($default->collapse_search_disp_folder_path and $expand == 0))
         {
                  $sPopupDescription = fCleanDomTTContent($aFolderMatchSearch[$fkey]['description']);

                  if ($sPopupDescription == "")
                  {
                     $sPopupDescription = $owl_lang->no_description;
                  }
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['parent'] = $aFolderMatchSearch[$fkey]['id'];
                  $url = fGetURL ('browse.php', $urlArgs2);
                  $xtpl->assign('FOLDER_PATH_URL', $url);
                  $xtpl->assign('FOLDER_DESC_VALUE', sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime));

                  $name = find_path($aFolderMatchSearch[$fkey]['id'], true);

                  $xtpl->assign('FOLDER_PATH', $name);
                  $xtpl->assign('FOLDER_HIT', $hit);
                  $xtpl->parse('main.Search.Folder.FldPath');
         }
 
   $GetItems = new Owl_DB;

   $iItemCount = 0;
   $iParent = $sql->f("parent");
   $GetItems->query("SELECT id from $default->owl_folders_table where parent = '" . $aFolderMatchSearch[$fkey]['id'] . "'");

   if ($default->restrict_view == 1)
   {
      while ($GetItems->next_record())
      {
         $bFileDownload = check_auth($GetItems->f("id"), "folder_view", $userid, false, false);
         if ($bFileDownload)
         {
            $iItemCount++;
         }
     }
   }
   else
   {
      $iItemCount = $GetItems->num_rows();
   }

   $GetItems->query("SELECT id from $default->owl_files_table where parent = '" . $aFolderMatchSearch[$fkey]['id'] . "'");
   if ($default->restrict_view == 1)
   {
      while ($GetItems->next_record())
      {
         $bFileDownload = check_auth($GetItems->f("id"), "file_download", $userid, false, false);
         if ($bFileDownload)
         {
            $iItemCount++;
         }
     }
   }
   else
   {
      $iItemCount = $iItemCount + $GetItems->num_rows();
   }

      if (($default->expand_search_disp_doc_num and $expand == 1) or ($default->collapse_search_disp_doc_num and $expand == 0))
      {
         $xtpl->parse('main.Search.Folder.DocNum');
      }

      if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
      {
         $xtpl->parse('main.Search.Folder.Thumb');
      }
      if (($default->expand_search_disp_doc_fields and $expand == 1) or ($default->colps_search_disp_doc_fields and $expand == 0))
      {
         $xtpl->parse('main.Search.Folder.DocFields');
      }
 
      if (($default->expand_search_disp_doc_type and $expand == 1) or ($default->collapse_search_disp_doc_type and $expand == 0))
      {
         $xtpl->parse('main.Search.Folder.DocType');
      }
      if (($default->expand_search_disp_file and $expand == 1) or ($default->collapse_search_disp_file and $expand == 0))
      {

         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $aFolderMatchSearch[$fkey]['id'];
         $url = fGetURL ('browse.php', $urlArgs2);

         $xtpl->assign('FOLDER_NAME_URL', $url);
         $xtpl->assign('FOLDER_NAME_DESC_VALUE', sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime));
         $xtpl->assign('FOLDER_NAME', $aFolderMatchSearch[$fkey]['name']);


         if ($iItemCount > 0)
         {
            $xtpl->assign('FOLDER_NAME_COUNT', "<font color=\"blue\">&nbsp;($iItemCount)</font>");
         }
         $xtpl->parse('main.Search.Folder.filename');
      }
      if (($default->expand_search_disp_size and $expand == 1) or ($default->collapse_search_disp_size and $expand == 0))
      {
         $xtpl->parse('main.Search.Folder.f_size');
      }

      if (($default->expand_search_disp_posted and $expand == 1) or ($default->collapse_search_disp_posted and $expand == 0))
      {
         $xtpl->assign('FOLDER_CREATOR', $aFolderMatchSearch[$fkey]['creator']);
         $xtpl->parse('main.Search.Folder.creatorid');
      }
      if (($default->expand_search_disp_updated and $expand == 1) or ($default->collapse_search_disp_updated and $expand == 0))
      {
         $xtpl->parse('main.Search.Folder.updatorid');
      }
      if (($default->expand_search_disp_modified and $expand == 1) or ($default->collapse_search_disp_modified and $expand == 0))
      {
         $xtpl->assign('FOLDER_SMODIFIED', date($owl_lang->localized_date_format, strtotime($aFolderMatchSearch[$fkey]['modified']) + $default->time_offset));
         $xtpl->parse('main.Search.Folder.smodified');
      }
      if (($default->expand_search_disp_action and $expand == 1) or ($default->collapse_search_disp_action and $expand == 0))
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

          if (check_auth($aFolderMatchSearch[$fkey]['id'], "folder_delete", $userid, false, false) == 1)
          {
             $urlArgs2 = $urlArgs;
             $urlArgs2['action'] = 'folder_delete';
             $urlArgs2['id'] = $aFolderMatchSearch[$fkey]['id'];
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('dbmodify.php', $urlArgs2);
             $xtpl->assign('FOLDER_ACTION_DEL',"<a class=\"$sLfList\" href=\"$url\"\tonclick='return confirm(\"$owl_lang->reallydelete " . htmlspecialchars($sql->f("name"), ENT_QUOTES) . "?\");'><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_folder\" title=\"$owl_lang->alt_del_folder\"\tborder=\"0'  /></a>");
          }
          if (check_auth($aFolderMatchSearch[$fkey]['id'], "folder_property", $userid, false, false) == 1)
          {           
             $urlArgs2 = $urlArgs;
             $urlArgs2['action'] = 'folder_modify';
             $urlArgs2['id'] = $aFolderMatchSearch[$fkey]['id'];
             $urlArgs2['parent'] = $parent;
             $url = fGetURL ('modify.php', $urlArgs2);

             $xtpl->assign('FOLDER_ACTION_MOD',"<a class=\"$sLfList\" href=\"$url\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_folder\" title=\"$owl_lang->alt_mod_folder\" /></a>");
          }
       $xtpl->parse('main.Search.Folder.Action');
       }
       $xtpl->parse('main.Search.Folder');
       $hit++; 
    }
 }
//print("<pre>");
//print_r($files);
//print("</pre>")
 if(sizeof($files) > 0) 
 {
         while($max > 0) 
         {
            foreach(array_keys($files) as $key) 
            {
               if($files[$key]['score'] == $max) 
               {
                  $iOnePrinted = 1;
                  $iRealFileID = fGetPhysicalFileId($files[$key]['id']);
                  $name = find_path($files[$key]['p'], true).DIR_SEP.$files[$key]['n'];
                  $filename = $files[$key]['f'];
                  $description = $files[$key]['x'];
                  $choped = explode('.', $filename);
                  $pos = count($choped);
                  if ( $pos > 1 )
                  {
                     $ext = strtolower($choped[$pos-1]);
                   }
                  else
                  {
                     $ext = "NoExtension";
                  }
                  if ($files[$key]['id'] != $iRealFileID)
                  {
                     $ext = $ext . "_lnk";
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

                  $xtpl->assign('FILE_TR_ID', "filetr" . $files[$key]['id']);
                  $xtpl->assign('FILE_TR_CLASS', $sTrClassHilite);
                  $xtpl->assign('FILE_TR_MOUSOVER', " onmouseover=\"alt_css_style('filetr" . $files[$key]['id']. "', this, '$sTrClassHiliteAlt')\"  onmouseout=\"alt_css_style('filetr" . $files[$key]['id'] . "', this, '$sTrClassHilite')\"");

                  $xtpl->assign('FILE_TD_CLASS', $sTrClass);
                  $xtpl->assign('FILE_AHREF_CLASS', $sLfList);


   if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
   {
      if ($sess != "0" || ($sess == "0" && $default->anon_ro == 0))
      {
         $xtpl->assign('FILE_BULK_CHECKBOX', "<input id=\"checkid" .  $files[$key]['id'] . "\" type=\"checkbox\" name=\"batch[]\" value=\"" . $files[$key]['id'] . "\" onclick=\"mark_selected('filetr" . $files[$key]['id'] . "', this, '$sTrClassHilite')\" />");
         $xtpl->parse('main.Search.File.Bulk');
      }
   }

         if (($default->expand_search_disp_score and $expand == 1) or ($default->collapse_search_disp_score and $expand == 0))
         {
                 $t_score = $max;
                  
                 $xtpl->assign('FILE_SCORE_ALT', $owl_lang->score . " - " . $t_score);
                 $xtpl->assign('FILE_SCORE_LABEL', $t_score);


                  for ($c=$max; $c>=1; $c--) 
                  {
                     if ( $t_score >= 10) 
                     {
                        if ( 0 == ($c % 10)) 
                        {
                           $xtpl->assign('FILE_SCORE_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/star10.gif\" border=\"0\" title=\"10 Points\" />");
                           $xtpl->parse('main.Search.File.Score.Image');
                           $t_score = $t_score - 10;
                        }
                     } 
                     else 
                     {
                        if ( (0 == ($t_score % 2)) && $t_score > 0 ) 
                        {
                           $xtpl->assign('FILE_SCORE_IMG', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_icons/star.gif\" border=\"0\" title=\"2 Points\" />");
                           $xtpl->parse('main.Search.File.Score.Image');
                        }
                        $t_score = $t_score - 1;
                     }   
   
                  }
                  $xtpl->parse('main.Search.File.Score');
         }

         if (($default->expand_search_disp_folder_path and $expand == 1) or ($default->collapse_search_disp_folder_path and $expand == 0))
         {
                  $sPopupDescription = fCleanDomTTContent($files[$key]['x']);

                  if ($sPopupDescription == "") 
                  {
                     $sPopupDescription = $owl_lang->no_description;
                  }

                  $urlArgs2 = $urlArgs;
                  $urlArgs2['parent'] = $files[$key]['p'];
                  $urlArgs2['fileid'] = $files[$key]['id'];
                  $url = fGetURL ('browse.php', $urlArgs2);
                  $xtpl->assign('FILE_PATH_URL', $url);
                  $xtpl->assign('FILE_DESC_VALUE', sprintf($default->domtt_popup , $owl_lang->description, $sPopupDescription, $default->popup_lifetime));
                  $xtpl->assign('FILE_HIT', $hit);
                  $xtpl->assign('FILE_PATH', $name);
                  $xtpl->parse('main.Search.File.FldPath');

         }

         if (($default->expand_search_disp_doc_num and $expand == 1) or ($default->collapse_search_disp_doc_num and $expand == 0))
         {
            $sZeroFilledId = str_pad($files[$key]['id'],$default->doc_id_num_digits, "0", STR_PAD_LEFT);
            $xtpl->assign('FILE_DOC_NUMBER', $efault->doc_id_prefix . $sZeroFilledId);
            $xtpl->parse('main.Search.File.DocNum');
         }

         if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
         {

            $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $iRealFileID . "_small.png";

            if (file_exists($sThumbLoc))
            {
               $imdata = file_get_contents($sThumbLoc);
               $sThumbUrl = 'data:image/png;base64,' . base64_encode($imdata);

               $xtpl->assign('FILE_THUMBNAIL', "<img data-thumbsize=\"thumb_small_" . $files[$key]['id'] . "\" src=\"$sThumbUrl\" border=\"1\" $sJScript alt=\"$owl_lang->alt_thumb_small\" title=\"$owl_lang->alt_thumb_small\" />");
            }
            else
            {
               $xtpl->assign('FILE_THUMBNAIL', "&nbsp;");
            }
            $xtpl->parse('main.Search.File.Thumb');
         }

         if (($default->expand_search_disp_doc_fields and $expand == 1) or ($default->colps_search_disp_doc_fields and $expand == 0))
         {
            fPrintCustomFields ($files[$key]['doctype'], $files[$key]['id'], 0, "visible", "readonly", "Search.File");
         }


         if (($default->expand_search_disp_doc_type and $expand == 1) or ($default->collapse_search_disp_doc_type and $expand == 0))
         {
                  if ($files[$key]['u'] == "1")
                  {
                     $xtpl->assign('FILE_DOCTYPE_IMG', 'url');
                     $xtpl->assign('FILE_DOCTYPE_URL_OPEN', '');
                     $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', '');;
                  }
                  else 
                  {
                     $sDispIcon = $ext;

                     if (!file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.gif") and
                         !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpg") and
                         !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.jpeg") and
                         !file_exists("$default->owl_fs_root/templates/$default->sButtonStyle/img/icon_filetype/$sDispIcon.png"))
                     {
                        $sDispIcon = "file";
                     }
                       $xtpl->assign('FILE_DOCTYPE_IMG', $sDispIcon);
                       $xtpl->assign('FILE_DOCTYPE_URL_OPEN', '');
                       $xtpl->assign('FILE_DOCTYPE_URL_CLOSE', '');

                  }
                  $xtpl->parse('main.Search.File.DocType');
           }

              if (($default->expand_search_disp_file and $expand == 1) or ($default->collapse_search_disp_file and $expand == 0))
              {
                  if ($files[$key]['u'] == "1") 
                  {
                     $xtpl->assign('FILE_URL', $filename);
                  } 
                  else 
                  {
                     $urlArgs2 = $urlArgs;
                     $urlArgs2['parent'] = $files[$key]['p'];
                     $urlArgs2['id'] = $files[$key]['id'];
                     $url = fGetURL ('download.php', $urlArgs2);
                     $xtpl->assign('FILE_NAME', $filename);
                     $xtpl->assign('FILE_URL', $url);
                  }
                  $xtpl->parse('main.Search.File.filename');
              }

              if (($default->expand_search_disp_size and $expand == 1) or ($default->collapse_search_disp_size and $expand == 0))
              {
                  if ($files[$key]['u'] == "1")
                  {
                     $xtpl->assign('FILE_SIZE', '&nbsp;');
                  }
                  else
                  {
                     $xtpl->assign('FILE_SIZE', gen_filesize($files[$key]['s']));
                  }
                  $xtpl->parse('main.Search.File.f_size');
              }


              if (($default->expand_search_disp_posted and $expand == 1) or ($default->collapse_search_disp_posted and $expand == 0))
              {
                 if( $default->show_user_info == 1)
                 {
                    $dDateLastLoging =  date($owl_lang->localized_date_format , strtotime(fid_to_creator_lastlogon($files[$key]['id'])) + $default->time_offset);
                    $sLinkToUser = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $files[$key]['creator'] . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " .  $dDateLastLoging  . "\">" . uid_to_name($files[$key]['creator']) . "</a>";
                    $sLinkToUpdator = "<a class=\"$sLfList\" href=\"prefs.php?owluser=" . $files[$key]['up_id'] . "&amp;sess=$sess&amp;expand=$expand&amp;parent=$parent&amp;order=$order&amp;sortname=$sortname\"title=\"$owl_lang->last_logged " . $dDateLastLoging  . "\">" . uid_to_name($files[$key]['up_id']) . "</a>";
                 }
                 else
                 {
                    $sLinkToUser = uid_to_name($files[$key]['creator']);
                    $sLinkToUpdator =  uid_to_name($files[$key]['up_id']);
                 }

                  $xtpl->assign('FILE_CREATOR', $sLinkToUser);
                  $xtpl->parse('main.Search.File.creatorid');
              }

              if (($default->expand_search_disp_updated and $expand == 1) or ($default->collapse_search_disp_updated and $expand == 0))
              {
                  $xtpl->assign('FILE_UPDATOR', $sLinkToUpdator);
                  $xtpl->parse('main.Search.File.updatorid');
              }
              if (($default->expand_search_disp_modified and $expand == 1) or ($default->collapse_search_disp_modified and $expand == 0))
              {
                  $xtpl->assign('FILE_SMODIFIED', date($owl_lang->localized_date_format, strtotime($files[$key]['date']) + $default->time_offset));
                  $xtpl->parse('main.Search.File.smodified');
              }
      
              if (($default->expand_search_disp_action and $expand == 1) or ($default->collapse_search_disp_action and $expand == 0))
              {
                 fPrintFileIconsXtpl($files[$key]['id'],$files[$key]['f'],$files[$key]['c'],$files[$key]['u'],$default->owl_version_control,$ext,$files[$key]['p'],false);
                 $xtpl->parse('main.Search.File.Action');
              }

              $xtpl->parse('main.Search.File');
              $hit++;
              }
            }
         $max--;
      }
   }
   else
   {
      if (empty($iOnePrinted))
      {

         $iOnePrinted = 1;
         $xtpl->assign('SEARCH_FOR_QUERY', $owl_lang->search_results_for . " &ldquo;".htmlspecialchars(str_replace('\\\\','\\', stripslashes(implode(" ", $query))))."&rdquo;");
         $iColspan = 0;
         $iColspan = fPrintTitleRowXTPL();
   
         $xtpl->assign('COLSPAN', $iColspan);
         $xtpl->assign('ERROR_MESSAGE', $owl_lang->owl_log_no_rec);
         $xtpl->assign('ERROR_MSG_CLASS', 'info_message');

         if ($default->show_search == 2 or $default->show_search == 3)
         {
            fPrintSearchXTPL('Bottom', 1, $withindocs, $iCurrentFolder);
         }
   
         if ($default->show_prefs == 2 or $default->show_prefs == 3)
         {
            fPrintPrefsXtpl("Bottom");
         }
         fSetElapseTime();
         fSetOwlVersion();
         $xtpl->parse('main.Search.ErrorMsg');
         $xtpl->parse('main.Search');
         $xtpl->parse('main.Footer');
         $xtpl->parse('main');
         $xtpl->out('main');
         exit;
      }
   }
}

   if (empty($iOnePrinted))
   {

      $iColspan = 0;
      $iColspan = fPrintTitleRowXTPL();

      $xtpl->assign('COLSPAN', $iColspan);
      $xtpl->assign('ERROR_MESSAGE', $owl_lang->owl_log_no_rec);
      $xtpl->assign('ERROR_MSG_CLASS', 'info_message');

      if ($default->show_search == 2 or $default->show_search == 3)
      {
         fPrintSearchXTPL('Bottom', 1, $withindocs, $iCurrentFolder);
      }
      if ($default->show_prefs == 2 or $default->show_prefs == 3)
      {
         fPrintPrefsXtpl("Bottom");
      }
      fSetElapseTime();
      fSetOwlVersion();
      $xtpl->parse('main.Search.ErrorMsg');
      $xtpl->parse('main.Search');
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
      exit;
      }
} 

$keywords = str_replace("%", "*", $keywords);

      if ($default->show_action == 2 or $default->show_action == 3 )
      {
            fPrintActionButtonsXTLP(1);
      }
      if ($default->show_bulk > 0)
      {
         if (check_auth($parent, "folder_view", $userid, false, false) == 1)
         {
            fPrintBulkButtonsXTPL("Bottom", 1);
         }
      }

if ($default->show_search == 2 or $default->show_search == 3)
{
   fPrintSearchXTPL('Bottom', 1, $withindocs, $iCurrentFolder);
   //fPrintSearchXTPL('Bottom', $withindocs, $iCurrentFolder);
}

if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXtpl("Bottom");
}

$xtpl->parse('main.Search');
fSetElapseTime();
fSetOwlVersion();
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
