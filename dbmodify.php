<?php
/**
 * dbmodify.php
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
 * $Id: dbmodify.php,v 1.57 2006/09/15 15:08:52 b0zz Exp $
 */


// Functions to read XML post data from ubr_upload

function startElement($parser, $name, $attrs) {
  global $curTag;
  $curTag .= "^$name";
}

function endElement($parser, $name) {
  global $curTag;
  $caret_pos = strrpos($curTag,'^');
  $curTag = substr($curTag,0,$caret_pos);
}


function characterData($parser, $data) {
  global $curTag;
  global $qstr;

  if (substr($curTag, 0, 16) == "^uu_upload^post^")
  {
    $qstr .= "&".substr($curTag,strrpos($curTag,'^')+1)."=".$data;
  }

  if (substr($curTag, 0, 28) == "^uu_upload^file^file_upload^")
  {
    $qstr .= "&file_".substr($curTag,strrpos($curTag,'^')+1)."=".$data;
  }

}

ob_start();
require_once(dirname(__FILE__) ."/config/owl.php");
$out = ob_get_clean();



if ($default->use_ubr_progress_bar == 1)
{
  // main loop
  $xml_parser = xml_parser_create();
  xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);
  xml_set_element_handler($xml_parser, "startElement", "endElement");
  xml_set_character_data_handler($xml_parser, "characterData");

  $uFile = $default->ubr_progress_bar_tmp_dir."/".$_GET['upload_id'].".redirect";
  if (file_exists($uFile)) {

    // read the contents of the redirect file
    $strXML = implode("",file($uFile));

    // parse the redirect file
    xml_parse($xml_parser, $strXML);

    // clean up - we're done
    xml_parser_free($xml_parser);

    $qstr = ereg_replace("ARRAY=","[]=", $qstr);
    //parse_str($qstr);
    parse_str($qstr, $_POST);
  }

}
elseif ($default->use_progress_bar == 1)
{
   $sid = $_GET['sid'];
   if (file_exists($default->progress_bar_tmp_dir . "/{$sid}_qstring"))
   {
      $qstr = join("",file($default->progress_bar_tmp_dir . "/{$sid}_qstring"));
      //parse_str($qstr);
      parse_str($qstr, $_POST);
   }
}



require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");
require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");
// Code to Handle Document Type page refresh

if (!isset($action))
{
   $action = '';
}

if ($default->use_ubr_progress_bar == 1 && ($action == "file_upload" or $action == "zip_upload") && $type == "")
{
   $userfile['name'] = file_basename($file_name);
   $userfile['size'] = $file_size;
   $userfile['tmp_name'] = $default->ubr_progress_bar_upload_dir . "/" . $userfile['name'];
}

if (($action == "file_upload" or $action == "zip_upload") and !isset($send_file_x) and $default->use_ubr_progress_bar == 0)
{
   header("Location: " . $default->owl_root_url . "/modify.php?sess=$sess&action=$action&parent=$parent&expand=$expand&order=$order&sortname=$sort&doctype=$doctype&type=$type");
   exit;
}

// Code to handle the click on the bulk action
// image button;
if (isset($bemailaction_x))
{
   $action = $owl_lang->email_selected;
} elseif (isset($bmoveaction_x))
{
   $action = $owl_lang->move_selected;
} elseif (isset($bcheckout_x))
{
   $action = "bulk_checkout";
} elseif (isset($bdlaction_x))
{
   $action = "bulk_download";
} elseif (isset($bdeleteaction_x))
{
   $action = $owl_lang->del_selected;
} 
if ($sess == "0" && $default->anon_ro > 0)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
   //printError($owl_lang->err_login);
}

if (!isset($type))
{
   $type = "";
}

if (!isset($doctype))
{
   $doctype = "1";
}

if ($default->make_file_indexing_user_selectable == 1)
{
   $index_file = fIntializeCheckBox($index_file);
}
else
{
   $index_file = "1";
}

if ($action == "go_fav")
{
   if (!empty($del_favorite_0) and empty($add_favorite_0))
   {
      $qFavorite = new Owl_DB;
      $qFavorite->query("DELETE FROM $default->owl_user_favorites WHERE userid = '$userid' and folder_id = '$favorite_id_0'");
      displayBrowsePage($parent);
      exit;
   }
   if (empty($del_favorite_0) and !empty($add_favorite_0))
   {
      $qFavorite = new Owl_DB;
      $qFavorite->query("DELETE FROM $default->owl_user_favorites WHERE userid = '$userid' and folder_id = '$parent'");
      $qFavorite->query("INSERT INTO $default->owl_user_favorites VALUES ('$userid','$parent', '$fav_label_0')");
      displayBrowsePage($parent);
      exit;
   }

   $parent = $favorite_id_0;
   displayBrowsePage($favorite_id_0);
   exit;
}

function fSetFileAcl( $file_id )
{
   global $default, $userid;

   $qSetAcl = "DELETE FROM $default->owl_advanced_acl_table where file_id = '$file_id'";
   $sql = new Owl_DB;
   $sql->query($qSetAcl);
   $qSetAcl = "";
 
   $keys=array_keys($_POST);
   $total_fields=count($keys);
 
   $FirstTimeThrough = true;
   $bChangeTypeSameId = false;
 
   for($index=0;$index<$total_fields;$index++)
   {
      $temp_key=$keys[$index];
      $temp=$_POST[$temp_key];
      list ($type, $acl, $gid_uid) = explode("_", $temp_key);
     
      if ( $type == "gacl" or $type == "acl")
      {
         if ($iPrevType != $type)
         {
            $bChangeTypeSameId = true;
         }
         if (($iPrevUidGid != $gid_uid and $FirstTimeThrough == false) or $bChangeTypeSameId == true)
         {
            if ($iPrevType == "gacl")
            {
               $qSetAcl .= ", group_id , file_id )";
               $qSetAclValues .= ", '$iPrevUidGid', '$file_id')";
            }
            if ($iPrevType == "acl")
            {
               $qSetAcl .= ", user_id , file_id )";
               $qSetAclValues .= ", '$iPrevUidGid', '$file_id')";
            }
            $sql->query($qSetAcl . $qSetAclValues);
            $FirstTimeThrough = true;
            $bChangeTypeSameId = false;
         }
 
         if($FirstTimeThrough)
         {
            $qSetAcl = "INSERT INTO $default->owl_advanced_acl_table (";
            $qSetAclValues = " VALUES ( ";
            $FirstTimeThrough = false;
         }
         else
         {
            $qSetAcl .= ", ";
            $qSetAclValues .= ", ";
         }
	 $qSetAcl .= "$acl ";
	 $qSetAclValues .= "'1' ";
         $iPrevType = $type;
         $iPrevUidGid = $gid_uid;
      }
   }
   if ($iPrevType == "gacl")
   {
      $qSetAcl .= ", group_id , file_id )";
      $qSetAclValues .= ", '$iPrevUidGid', '$file_id')";
   }
   if ($iPrevType == "acl")
   {
      $qSetAcl .= ", user_id , file_id )";
      $qSetAclValues .= ", '$iPrevUidGid', '$file_id')";
   }
   $sql->query($qSetAcl . $qSetAclValues);
   owl_syslog(FILE_ACL, $userid, flid_to_filename($file_id), $parent, "", "FILE", flid_to_filesize($file_id));
}

function fSetFolderAcl( $folder_id , $folder_propagate = 0, $file_propagate = 0)
{
   global $default, $userid;

   //print("FOLDER='$folder_id' <br />");
   $qSetAcl = "DELETE FROM $default->owl_advanced_acl_table where folder_id = '$folder_id'";
   $sql = new Owl_DB;
   $sql->query($qSetAcl);
   $qSetAcl = "";
 
   $keys=array_keys($_POST);
   $total_fields=count($keys);
 
   $FirstTimeThrough = true;
   $bChangeTypeSameId = false;
   
   for($index=0;$index<$total_fields;$index++)
   {
      $temp_key=$keys[$index];
      $temp=$_POST[$temp_key];
      list ($type, $acl, $gid_uid) = explode("_", $temp_key);
     
      if ( $type == "fgacl" or $type == "facl")
      {
         if ($iPrevType != $type)
         {
            $bChangeTypeSameId = true;
         }
         if (($iPrevUidGid != $gid_uid and $FirstTimeThrough == false) or $bChangeTypeSameId == true)
         {
            if ($iPrevType == "fgacl")
            {
               $qSetAcl .= ", group_id , folder_id )";
               $qSetAclValues .= ", '$iPrevUidGid', '$folder_id')";
            }
            if ($iPrevType == "facl")
            {
               $qSetAcl .= ", user_id , folder_id )";
               $qSetAclValues .= ", '$iPrevUidGid', '$folder_id')";
            }
            $sql->query($qSetAcl . $qSetAclValues);
            $FirstTimeThrough = true;
            $bChangeTypeSameId = false;
         }
 
         if($FirstTimeThrough)
         {
            $qSetAcl = "INSERT INTO $default->owl_advanced_acl_table (";
            $qSetAclValues = " VALUES ( ";
            $FirstTimeThrough = false;
         }
         else
         {
            $qSetAcl .= ", ";
            $qSetAclValues .= ", ";
         }
	 $qSetAcl .= "$acl ";
	 $qSetAclValues .= "'1' ";
         $iPrevType = $type;
         $iPrevUidGid = $gid_uid;
      }
   }
   if ($iPrevType == "fgacl")
   {
      $qSetAcl .= ", group_id , folder_id )";
      $qSetAclValues .= ", '$iPrevUidGid', '$folder_id')";
   }
   if ($iPrevType == "facl")
   {
      $qSetAcl .= ", user_id , folder_id )";
      $qSetAclValues .= ", '$iPrevUidGid', '$folder_id')";
   }
   $sql->query($qSetAcl . $qSetAclValues);

   if(fIsAdmin() or $default->user_can_propagate_acl) 
   {
      $qSubFolder = new Owl_DB;
      if ($file_propagate == 1)
      {
         $qSubFolder->query("SELECT id from $default->owl_files_table where parent='$folder_id'");
         while($qSubFolder->next_record())
         {
            fSetFileAcl($qSubFolder->f("id"));
         }
      }
      if($folder_propagate == 1) 
      {
         $qSubFolder->query("SELECT id from $default->owl_folders_table where parent='$folder_id'");
         while($qSubFolder->next_record())
         {
            if (fIsAdmin() or check_auth($qSubFolder->f("id"), "folder_acl", $userid) == 1) 
            {
              fSetFolderAcl($qSubFolder->f("id"), $folder_propagate, $file_propagate);
            }
         }
      }
   }
   owl_syslog(FOLDER_ACL, $userid, fid_to_name($folder_id), $parent, "", "FILE");
}

if ($action == "folder_acl")
{
   if (check_auth($id, "folder_acl", $userid) == 1)
   {
      fSetFolderAcl($id, $folder_propagate, $file_propagate);
      displayBrowsePage($parent);
   }
   else
   {
      printError($owl_lang->err_nofoldermod);
   }
}

if ($action == "file_acl")
{
   if (!is_numeric($id))
   {
      $aFileIDs = unserialize(stripslashes($id));
      foreach ($aFileIDs as $id)
      {
         if (check_auth($id, "file_acl", $userid) == 1)
         {
            fSetFileAcl($id);
            notify_monitored($id, $type);
            notify_monitored_folders ($parent, flid_to_filename($id));
         }
         else
         {
            printError($owl_lang->err_nofilemod);
         }
      }
      displayBrowsePage($parent);
   }
   else
   {
      if (check_auth($id, "file_acl", $userid) == 1)
      {
         fSetFileAcl($id);
         notify_monitored($id, $type);
         notify_monitored_folders ($parent, flid_to_filename($id));
         displayBrowsePage($parent);
      }
      else
      {
         printError($owl_lang->err_nofilemod);
      }
   }
}

if ($action == "folder_thumb" and fisAdmin())
{
   fGenFolderThumbNails($id);
   displayBrowsePage($parent);
}
if ($action == "file_thumb" and fisAdmin())
{

   fGenerateThumbNail($id);
   displayBrowsePage($parent);
}

if ( $default->document_peer_review == 1)
{
   if (($action == "approvedoc" or $action == "docreject") and fCheckIfReviewer($id))
   {
      $sql_custom = new Owl_DB;

      // *****************************
      // PEER Review feature END
      // *****************************
      if ($action == "approvedoc")
      {
         $sql_custom->query("SELECT * FROM $default->owl_peerreview_table WHERE file_id ='$id' and status <> '1'");
         if ($sql_custom->num_rows() > 1)
         {
            notify_reviewer (owlfilecreator($id), $id, $message, "approved");
         }
         else
         {
            if($default->peer_auto_publish[$default->owl_current_db] == "true") 
            {
               notify_reviewer (owlfilecreator($id), $id, $message, "final_approved_auto", $owl_lang->peer_final_approval);

               $sql_custom->query("SELECT * FROM $default->owl_files_table WHERE id = '$id'");
               $sql_custom->next_record();

               notify_users($usergroupid, NEW_FILE, $sql_custom->f("id"));
               notify_monitored_folders ($sql_custom->f("parent"), $sql_custom->f("filename"));

               $sql_custom->query("UPDATE $default->owl_files_table SET approved = '1' WHERE id = '$id'");
               $sql_custom->query("DELETE from $default->owl_peerreview_table where file_id = '" . $id . "'");

               owl_syslog(FILE_PUBLISHED, $userid, flid_to_filename($id), owlfileparent($id), "AUTO PUBLISHED", "FILE", flid_to_filesize($id));

            }
            elseif($default->peer_auto_publish[$default->owl_current_db] == "false")
            {
                 notify_reviewer (owlfilecreator($id), $id, $message, "final_approved", $owl_lang->peer_final_approval);
            }
         }
         $docstatus = "1";
      }
      else
      {
         notify_reviewer (owlfilecreator($id), $id, $message, "rejected", $reject_reason);
         $docstatus = "2";
      }

      $result = $sql_custom->query("UPDATE $default->owl_peerreview_table SET status = '$docstatus' WHERE reviewer_id = '$userid' and file_id ='$id'");

      // *****************************
      // PEER Review feature END
      // *****************************
      $urlArgs = array();
      $urlArgs['sess']      = $sess;
      $urlArgs['parent']    = $parent;
      $urlArgs['expand']    = $expand;
      $urlArgs['order']     = $order;
      $urlArgs['sortorder'] = $sortorder;
      $urlArgs['curview']     = $curview;

      $urlArgs2 = $urlArgs;
      $urlArgs2['type'] = "wa";
      $sUrl = fGetURL ('showrecords.php', $urlArgs2);

      header("Location: " . fOwl_ereg_replace("&amp;","&", $sUrl));
      exit;

   }
}


if ($action == "set_intial")
{
   if (check_auth($parent, "folder_view", $userid) != "1")
   {
      printError($owl_lang->err_nofolderaccess);
   }
   else
   {
      $sql = new Owl_DB;
      $sql->query("UPDATE $default->owl_users_table SET firstdir='$parent' WHERE id = '$userid'");
   }
}


if ($action == "file_update")
{
   if (check_auth($id, "file_update", $userid) == 1)
   {
      $sql = new Owl_DB;
      if ($sign_close == "Cancel")
      {
         $sql->query("UPDATE $default->owl_files_table set checked_out='0' WHERE id='$id'");
         owl_syslog(FILE_UNLOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE", flid_to_filesize($id));
         displayBrowsePage($parent);
         exit;
      }

      if ($inline == 1)
      {
         $new_name = flid_to_filename($id);
         $doc_size = strlen($document_content);
      }
      else
      {
         if ($default->use_ubr_progress_bar == 1 && $type == "")
         {
            $userfile['name'] = file_basename($file_name);
            $userfile['size'] = $file_size;
            $userfile['tmp_name'] = $default->ubr_progress_bar_upload_dir . "/" . $userfile['name'];
         }
         else if ($default->use_progress_bar == 1)
         {
            $userfile['name'] = file_basename($file['name'][0]);
            $userfile['size'] = $file['size'][0];
            $userfile['tmp_name'] = $file['tmp_name'][0];
         }
         else
         {
            $userfile = uploadCompat("userfile");
         }
         fVirusCheck($userfile["tmp_name"], $userfile["name"]);
         $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $userfile["name"])));
         $doc_size = $userfile['size'];
      }

      $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $new_name;

      /**
       * Begin Daphne Change - backups of files
       * If user requests automatic backups of files 
       * get current details from db and save file state information
       */
      if ($default->owl_version_control == 1)
      {
         if ($default->owl_use_fs)
         {
            $sql->query("SELECT * FROM $default->owl_files_table WHERE id='$id'");
         } 
         else
         { 
            // this is guaranteed to get the ID of the most recent revision, just in case we're updating a previous rev.
            $sql->query("SELECT distinct b.* FROM $default->owl_files_table a, $default->owl_files_table b WHERE b.id='$id' AND a.name=b.name AND a.parent=b.parent order by major_revision, minor_revision desc");
         } 

         while ($sql->next_record())
         { 
           
            // save state information
            if ($sql->f("checked_out") > 0 and $sql->f("checked_out") <>  $userid)
            {
               printError($owl_lang->err_update_file_lock . " " . uid_to_name($sql->f("checked_out")));
            }

            $major_revision = $backup_major = $sql->f("major_revision");
            $minor_revision = $backup_minor = $sql->f("minor_revision");
            $linkedto = $backup_linkedto = $sql->f("linkedto");
            if (empty($backup_linkedto))
            {
               $backup_linkedto = "0";  // unkown
               $linkedto = "0";  // unkown
            }
            $backup_filename = $sql->f("filename");
            $backup_name = $sql->f("name");

            // Tiian 2004-02-18
            // this stuff prevent errors when title contains apostrophes
            //$backup_name = ereg_replace("[\\]'", "'", $backup_name);
            $backup_name = stripslashes($backup_name);
            //$backup_name = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $backup_name));
            $backup_name = addslashes(fOwl_ereg_replace("[<>]", "", $backup_name));

            $backup_size = $sql->f("f_size");
            $backup_creatorid = $sql->f("creatorid"); 
            $backup_updatorid = $sql->f("updatorid"); 

            $backup_name_search = $sql->f("name_search");
            $backup_filename_search = $sql->f("filename_search");
            $backup_description_search = $sql->f("description_search");
            $backup_metadata_search = $sql->f("metadata_search");

            if (empty($backup_updatorid))
            {
               $backup_updatorid = "0";  // unkown
            }

            // $backup_modified = $sql->f("modified");
            $backup_smodified = $sql->f("smodified");
            //$dCreateDate = date("Y-m-d H:i:s");
            $dCreateDate = $sql->now();
            $backup_description = $sql->f("description"); 
            // This is a hack to deal with ' in the description field
            // on some system the ' is automaticaly changed to \' and that works
            // on other system it stays as ' I have no idea why
            // the 2 lines bellow should take care of any case.
            //$backup_description = ereg_replace("[\\]'", "'", $backup_description);
            $backup_description = stripslashes($backup_description);
            //$backup_description = fOwl_ereg_replace("'", "\\'" , $backup_description);
            $backup_description = addslashes($backup_description);
            $backup_name = stripslashes($backup_name);
            //$backup_name = fOwl_ereg_replace("'", "\\'" , $backup_name);
            $backup_name = addslashes($backup_name);
            $backup_metadata = $sql->f("metadata");
            $backup_metadata = stripslashes($backup_metadata);
            //$backup_metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $backup_metadata));
            $backup_metadata = addslashes(fOwl_ereg_replace("[<>]", "", $backup_metadata));

            $backup_parent = $sql->f("parent");
            $backup_security = $sql->f("security");
            $backup_groupid = $groupid = $sql->f("groupid");

            $new_quota = fCalculateQuota($userfile['size'], $userid, "ADD");
            $filename = $sql->f(filename);
            $title = $sql->f(name);
            $description = $sql->f(description); 

            // This is a hack to deal with ' in the description field
            // on some system the ' is automaticaly changed to \' and that works
            // on other system it stays as ' I have no idea why
            // the 2 lines bellow should take care of any case.
            //$description = ereg_replace("[\\]'", "'", $description);
            $description = stripslashes($description);
            //$description = fOwl_ereg_replace("'", "\\'" , $description);
            $description = addslashes($description);
            //$title = ereg_replace("[\\]'", "'", $title);
            $title = stripslashes($title);
            //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));
            $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));

            if ($default->owl_use_fs)
            {
               if ($default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $sql->f(filename) != $newpath)
               {
                  if ($default->allow_different_filename_update == 1)
                  {
                     $sNewFileExtension = fFindFileExtension ( $new_name);
                     $sOrigFileExtension = fFindFileExtension ( $sql->f(filename));
                     if ($sNewFileExtension == $sOrigFileExtension)
                     {
                        $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $sql->f(filename);
                        $new_name = $sql->f(filename);
                     }
                     else
                     {
                        printError($owl_lang->err_file_extension_update ." Extension / File Type must be the same");
                     }
                  }
                  else
                  {
                     printError("$owl_lang->err_file_update");
                  }

               }
            } 
         } 
      } 

      /**
       * Begin Daphne Change
       * copy old version to backup folder
       * change version numbers, 
       * update database entries
       * upload new file over the old
       * backup filename will be 'name_majorrev-minorrev' e.g. 'testing_1-2.doc'
       */

      if ($default->owl_use_fs)
      {
         if ($default->owl_version_control == 1)
         {
            if (!(file_exists($newpath) == 1) || $backup_filename != $new_name) 
            {
               printError("$owl_lang->err_file_not_exist"); 
            }
            // Get the file extension.
            $extension = explode(".", $new_name); 
            // rename the new, backed up (versioned) filename
            // $version_name = $extension[0]."_$major_revision-$minor_revision.$extension[1]";
            // BUG FIX BEGIN
            // 657896 filenames in backup folder not correct - SOLUTION
            // by: Gerald McMillen (mrshadow76)
            $extensioncounter = 0;
            while ($extension[$extensioncounter + 1] != null)
            { 
               // pre-append a "." separator in the name for each
               // subsequent part of the the name of the file.
               if ($extensioncounter != 0)
               {
                  $version_name = $version_name . ".";
               } 
               $version_name = $version_name . $extension[$extensioncounter];
               $extensioncounter++;
            } 

            if ($extensioncounter != 0)
            {
               $version_name = $version_name . "_$major_revision-$minor_revision.$extension[$extensioncounter]";
            }
            else
            {
               $version_name = $extension[0] . "_$major_revision-$minor_revision"; 
            }
            // BUG FIX END
            // specify path for new file in the /backup/ file of each directory.
            $backuppath = $default->owl_FileDir . DIR_SEP . find_path($parent) . "/$default->version_control_backup_dir_name/$version_name"; 
            // Danilo change
            if (!is_dir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name"))
            {
               mkdir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name", $default->directory_mask); 
               // End Danilo change
               // is there already a backup directory for current dir?
               if (is_dir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name"))
               {
                  $sql->query("INSERT INTO $default->owl_folders_table (name, parent, security, groupid, creatorid, description, linkedto)  values ('$default->version_control_backup_dir_name', '$parent', '" . fCurFolderSecurity($parent) ."', '" . owlfoldergroup($parent) ."', '" . owlfoldercreator($parent) . "', '', '0')");

                  $newParent = $sql->insert_id($default->owl_folders_table, 'id');

                  fSetDefaultFolderAcl($newParent);
                  fSetInheritedAcl($parent, $newParent, "FOLDER");
               } 
               else
               {
                  printError("$owl_lang->err_backup_folder_create");
               } 
            } 
            copy($newpath, $backuppath); // copy existing file to backup folder
         } 

         // End Daphne Change
         if (!file_exists($newpath) == 1) 
         {
           printError("$owl_lang->err_file_update");
         }
         if($inline == 1)
         {
            if ($default->owl_use_fs)
            {
               $iOldSize =  filesize($newpath);
               $iCurrentSize = strlen($document_content);

               $fp = fopen($newpath, "wb");
               fwrite($fp, stripslashes($document_content));
               fclose($fp);
            }
            else
            {
               $sOldSize =  filesize( $default->owl_tmpdir . DIR_SEP . $new_name);
               $iCurrentSize = strlen($document_content);
               $tmpfile = $default->owl_tmpdir . DIR_SEP . $new_name;
               $filedata = addSlashes($document_content);
               $fp = fopen($tmpfile, "wb");
               fwrite($fp, $document_content);
               fclose($fp);
            }

            $new_current_quota = fCalculateQuota($iOldSize, $backup_creatorid, "DEL");

            $new_quota = fCalculateQuota($iCurrentSize, $backup_creatorid, "ADD");

            if (fIsQuotaEnabled($backup_creatorid))
            {
               $sql->query("UPDATE $default->owl_users_table SET quota_current = '$new_quota' WHERE id = '$backup_creatorid'");
            }

         }
         else
         {
            copy($userfile['tmp_name'], $newpath);
            chmod($newpath, $default->file_mask);
            unlink($userfile['tmp_name']);
         }

         if (!file_exists($newpath))
         {
            if ($default->debug == true)
            {
               printError("DEBUG: " . $owl_lang->err_upload, $newpath);
            }
            else
            {
               printError($owl_lang->err_upload); 
            }
         }
         // Begin Daphne Change
         if ($default->owl_version_control == 1)
         {
            if (!file_exists($backuppath))
            {
               printError("$owl_lang->err_backup_file"); 
            }
            // find id of the backup folder you are saving the old file to
            $sql->query("SELECT id FROM $default->owl_folders_table WHERE name='$default->version_control_backup_dir_name' AND parent='$parent'");
            while ($sql->next_record())
            {
                $backup_parent = $sql->f("id");
            } 
         } 
      } 

//print("<br/> Major : $major_revision");
//print("<br/> Minor : $minor_revision");
      if ($versionchange == 'major_revision')
      { 
//print("<br /><br />V MAJOR : $versionchange");
         // if someone requested a major revision, must
         // make the minor revision go back to 0
         // $versionchange = "minor_revision='0', major_revision";
         // $new_version_num = $major_revision + 1;
         $new_major = $major_revision + 1;
         $new_minor = 0;
         $versionchange = "minor_revision='0', major_revision";
         $new_version_num = $major_revision + 1;
      } 
      else
      { 
//print("<br /><br />V MINOR : $versionchange");
         // simply increment minor revision number
         $new_version_num = $major_revision;
         $new_minor = $minor_revision + 1;
         $versionchange = "minor_revision='$new_minor', major_revision";
         $new_major = $major_revision;
      } 

//exit("<br />V: $versionchange =  $new_version_num");
      // End Daphne Change
      $groupid = owlusergroup($userid); 
      $smodified = $sql->now();
      // Begin Daphne Change
      
      $iDocApproved = fIsDocApproved ($reviewers, $newpath);

      if ($default->owl_version_control == 1)
      {
         if ($default->owl_use_fs)
         { 
            // insert entry for backup file
            $result = $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent,created, smodified,groupid,description,metadata,security,major_revision,minor_revision, doctype, linkedto, approved) values ('" . $sql->make_arg_safe($backup_name) . "','" . $sql->make_arg_safe($version_name) . "','$backup_size','$backup_creatorid','$backup_updatorid','$backup_parent',$dCreateDate,'$backup_smodified','$backup_groupid', '$backup_description','$backup_metadata','$backup_security','$backup_major','$backup_minor', '$doctype', '$backup_linkedto', '1')") or unlink($backuppath);
            if (!$result && $default->owl_use_fs) unlink($newpath);

            $idbackup = $sql->insert_id($default->owl_files_table, 'id'); 
            $sql->query("UPDATE $default->owl_files_table SET f_size='$doc_size', smodified=$smodified, $versionchange='$new_version_num',description='$newdesc', approved = '$iDocApproved', updatorid='$userid'  WHERE id='$id'") or unlink($newpath);
            // UPDATE THE VERSION of the linked files as well.

            $sql->query("UPDATE $default->owl_files_table SET f_size='$doc_size', smodified=$smodified, $versionchange='$new_version_num',description='$newdesc', updatorid='$userid'  WHERE linkedto='$id'") or unlink($newpath);

            $sql->query("UPDATE $default->owl_searchidx SET owlfileid='$idbackup'  WHERE owlfileid='$id'");
            fIndexAFile($backup_filename, $newpath, $id);


            fCopyFileAcl($id, $idbackup);

            owl_syslog(FILE_UPDATED, $userid, $userfile["name"], $parent, $version_name, "FILE", $userfile['size']);
         } 
         else
         { 
            // BEGIN wes change
            // insert entry for current version of file
            $compressed = '0';
            $userfile = uploadCompat("userfile");

            $fsize = filesize($userfile['tmp_name']);

            
            $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent, created, smodified,groupid,description,metadata,security,major_revision,minor_revision, doctype, linkedto, approved) VALUES ('$backup_name','" . $userfile['name'] . "','" . $userfile['size'] . "','$backup_creatorid','$userid','$parent',$dCreateDate,$smodified,'$backup_groupid', '$newdesc', '$backup_metadata','$backup_security','$new_major','$new_minor', '$doctype', '$backup_linkedto', '$iDocApproved')");

            $fid = $id;
            $id = $sql->insert_id($default->owl_files_table, 'id');

            $monitorSQL = new Owl_DB;
// Move ACL's for this file
// make them the same as the file Originally updated.
            $sql->query("UPDATE $default->owl_advanced_acl_table SET file_id='$id' WHERE file_id = '$fid'");
// 

            $monitorSQL = new Owl_DB;
            $monitorSQL->query("SELECT * FROM $default->owl_monitored_file_table WHERE fid = $fid and userid = '$userid'");
            if ($monitorSQL->num_rows() != 0)
            {
               $monitorSQL->query("SELECT id FROM $default->owl_files_table WHERE name = '$backup_name' and parent = '$parent' and major_revision = '$new_major' and minor_revision = '$new_minor'");
               $monitorSQL->next_record();
               $newmonitorid = $monitorSQL->f("id");
               $monitorSQL->query("UPDATE $default->owl_monitored_file_table SET fid = '$newmonitorid'");
            } 

            // If pdftotext was set and exists
            // Create a search index for this text file.
            fIndexAFile($userfile['name'], $userfile['tmp_name'], $id);
            if ($default->owl_compressed_database && file_exists($default->gzip_path))
            {
               system(escapeshellarg($default->gzip_path) . " " . escapeshellarg($userfile['tmp_name']));
               $fd = fopen($userfile['tmp_name'] . ".gz", 'rb');
               $userfile['tmp_name'] = $userfile['tmp_name'] . ".gz";
               $fsize = filesize($userfile['tmp_name']);
               $compressed = '1';
            } 
            else
            {
               $fd = fopen($userfile['tmp_name'], 'rb');
            } 
            //$filedata = fread($fd, $fsize);
            $filedata = fEncryptFiledata(fread($fd, $fsize));
            fclose($fd);
            unlink($userfile['tmp_name']);

            if ($id !== null && $filedata)
            {
               $filedatasql = new Owl_DB;
               $filedatasql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$id', '$filedata', '$compressed')", 'latin1');
            } 
            owl_syslog(FILE_UPDATED, $userid, $userfile["name"], $parent, $backup_name, "FILE", $userfile['size']); 
         } 
      } 
      else // versioning not included in the DB update
      {
         $filename = $userfile['name'];
            // BEGIN Bozz Change
         if (getfilepolicy($id) == 5 || getfilepolicy($id) == 6)
         {
            $sql->query("UPDATE $default->owl_files_table SET f_size='" . $userfile['size'] . "',smodified=$smodified, updatorid='$userid', approved='$iDocApproved' WHERE id='$id'") or unlink($newpath);
         } 
         else
         {
            $sql->query("UPDATE $default->owl_files_table SET f_size='" . $userfile['size'] . "',updatorid='$userid', smodified=$smodified, approved='$iDocApproved' WHERE id='$id'") or unlink($newpath);
         } 

         if ($default->owl_use_fs == false)
         { 
            fDeleteFileIndexID($id);
            fIndexAFile($userfile['name'], $userfile['tmp_name'], $id);

            $fsize = filesize($userfile['tmp_name']);
            if ($default->owl_compressed_database && file_exists($default->gzip_path))
            {
               system(escapeshellarg($default->gzip_path) . " " . escapeshellarg($userfile['tmp_name']));
               $fd = fopen($userfile['tmp_name'] . ".gz", 'rb');
               $userfile['tmp_name'] = $userfile['tmp_name'] . ".gz";
               $fsize = filesize($userfile['tmp_name']);
               $compressed = '1';
            }
            else
            {
               $fd = fopen($userfile['tmp_name'], 'rb');
            }
            //$filedata = fread($fd, $fsize);
            $filedata = fEncryptFiledata(fread($fd, $fsize));
            fclose($fd);
            unlink($userfile['tmp_name']);

            if ($filedata)
            {
               $filedatasql = new Owl_DB;
               $filedatasql->query("UPDATE $default->owl_files_data_table set data = '$filedata' where id ='$id'", 'latin1');
            }
         }
            owl_syslog(FILE_UPDATED, $userid, $userfile["name"], $parent, $backup_name, "FILE", $userfile['size']); 
      } 
      // End Daphne Change
      if (fIsQuotaEnabled($userid)) 
      {
         $sql->query("UPDATE $default->owl_users_table SET quota_current = '$new_quota' WHERE id = '$userid'"); 
      }
      // 
      // Yes Yes Yes, I know you may get 3 notification
      // for the same file, I should probably check
      // if a notification was already sent by
      // the previous notification, but I wait and see
      // I'll probably get complaints and feed back
      // and I'll fix this later if need be.
      // 
      // *****************************
      // PEER Review feature END
      // *****************************
      if ( $default->document_peer_review == 1)
      {
         $sql_custom = new Owl_DB;
         // clean up Old review request records
         $sql_custom->query("DELETE from $default->owl_peerreview_table where file_id = '" . $id . "'");
         foreach ($reviewers as $iReviewerId)
         {
            if(!empty($iReviewerId))
            {
               $result = $sql_custom->query("INSERT INTO $default->owl_peerreview_table (reviewer_id, file_id, status) values ('$iReviewerId', '$id', '0')");
               notify_reviewer ($iReviewerId, $id , $message);
            }
         }
      }
      // *****************************
      // PEER Review feature END
      // *****************************
      if ($inline == 1)
      {
          $sql->query("UPDATE $default->owl_files_table set checked_out='0' WHERE id='$id'");
          owl_syslog(FILE_UNLOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE", flid_to_filesize($id));
      }

      if ($iDocApproved == 1)
      {     
         notify_monitored($id, $type);
         notify_users($groupid, UPDATED_FILE, $id, $type);
         notify_monitored_folders ($parent, $filename);
      }
      displayBrowsePage($parent);
      // END BUG FIX: #433932 Fileupdate and Quotas
   } 
   else
   {
      printError($owl_lang->err_noupload);
   } 
} 

if ($action == "zip_upload")
{
   // Progress bar fix
  if ($default->use_ubr_progress_bar == 1 && $type == "")
   {
      $userfile['name'] = file_basename($file_name);
      $userfile['size'] = $file_size;
      $userfile['tmp_name'] = $default->ubr_progress_bar_upload_dir . "/" . $userfile['name'];
   }
   else if ($default->use_progress_bar == 1)
   {
      $userfile['name'] = file_basename($file['name'][0]);
      $userfile['size'] = $file['size'][0];
      $userfile['tmp_name'] = $file['tmp_name'][0];
   }
   else
   {
      $userfile = uploadCompat("userfile");
   }

   fVirusCheck($userfile["tmp_name"], $userfile["name"]);
   // If the File Size is 0 File was too big.
   if ($userfile["size"] == 0)
   {
      if ($default->debug == true)
      {
         printError("DEBUG: " . "  $owl_lang->err_upload   ", $owl_lang->err_file_too_big . " " . $default->max_filesize);
      }
      else
      {
         printError("$owl_lang->err_upload");
      }
   }

   $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $userfile["name"])));

   $dirname = preg_split("/\.zip/", $new_name);

   if(empty($to_current_folder))
   {
      $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $dirname[0];

      if (file_exists($newpath) == 1 and $default->owl_use_fs)
      {
         if ($default->debug == true)
         {
            printError("DEBUG: " . $owl_lang->err_file_exists, $newpath);
         }
         else
         {
            printError($owl_lang->err_file_exists);
         }
      }
   }
   else
   {
      $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent);
   }

   copy($userfile["tmp_name"],  $default->owl_tmpdir . DIR_SEP . $new_name);

   $archive = new PclZip($default->owl_tmpdir . DIR_SEP . $new_name);

   if (($list = $archive->listContent()) == 0) 
   {
      if ($default->debug == true)
      {
         printError($owl_lang->err_not_zip, "DEBUG: " .$archive->errorInfo(true));
      }
      else
      {
         printError($owl_lang->err_not_zip );
      }

   }

   if(empty($to_current_folder))
   {
      if ($default->owl_use_fs )
      {
         mkdir($newpath, $default->directory_mask);
      }
      else
      {
         mkdir($default->owl_tmpdir . DIR_SEP . $dirname[0], $default->directory_mask);
      }

      $FolderPolicy = $policy;
      $smodified = $sql->now();

      $sql->query("INSERT INTO $default->owl_folders_table (name,parent,security,description,groupid,creatorid, smodified, linkedto) values ('$dirname[0]', '$parent', '$FolderPolicy', '$description', '$groupid', '$userid', $smodified, '0')");
      $newParent = $sql->insert_id($default->owl_folders_table, 'id');

      fSetDefaultFolderAcl($newParent);
      fSetInheritedAcl($parent, $newParent, "FOLDER");

      if (!is_dir($newpath) and $default->owl_use_fs)
      {
         if ($default->debug == true)
         {
            printError("DEBUG:" . $owl_lang->err_folder_create, $newpath);
         }
         else
         {
            printError($owl_lang->err_folder_create);
         }
      }
   }
   else
   {
      $newParent = $parent;
   }

   if (!$default->owl_use_fs )
   {
      $newpath = $default->owl_tmpdir . DIR_SEP . $dirname[0];
   }

   if(!empty($to_current_folder) and empty($Overwrite))
   {
      $sSkippedFiles = "";

      foreach ($list as $aFile)
      {
         $sCheckFolderID = $parent;
         $cLastChar =  substr($aFile['filename'], -1);
         $sFolderName = substr($aFile['filename'], 0, strlen($aFile['filename']) - 1 );
         if ($cLastChar == "/")
         {
            $FolderpathArray = explode( "/", $sFolderName );
            $FolderItemCount = count($FolderpathArray);
            if ($FolderItemCount > 1)
            {
               for ($i = 0; $i < $FolderItemCount - 1; $i++)
               {
                  $sql->query("SELECT * from $default->owl_folders_table where name = '" . $FolderpathArray[$i]. "' and parent = '$sCheckFolderID';");
                  if ($sql->num_rows() == 1)
                  {
                     $sql->next_record();
                     $sCheckFolderID = $sql->f("id");
                  }
               }
            }
            else
            {
               $sCheckFolderID = owlfolderparent($parent);
            }

            $sql->query("SELECT * from $default->owl_folders_table where name = '" .  $FolderpathArray[$FolderItemCount - 1] . "' and parent = '$sCheckFolderID';");
            if ($sql->num_rows() == 0)
            {
               $archive->extract(PCLZIP_OPT_PATH, $newpath, PCLZIP_OPT_BY_NAME, $aFile['filename'] );
            }
         }
         else
         {
            // IS it a path?
            $pathArray = explode( "/", $aFile['filename'] );
            $ItemCount = count($pathArray);
            if ($ItemCount > 1)
            {
               for ($i = 0; $i < $ItemCount - 1; $i++) 
               {
                  $sql->query("SELECT * from $default->owl_folders_table where name = '" . $pathArray[$i]. "' and parent = '$sCheckFolderID';");
                  if ($sql->num_rows() == 1)
                  {
                     $sql->next_record();
                     $sCheckFolderID = $sql->f("id");
                  }
               }
               $sql->query("SELECT * from $default->owl_files_table where filename = '" . $pathArray[$ItemCount - 1]. "' and parent = '$sCheckFolderID';");
               if ($sql->num_rows() == 0)
               {
                  //print("EXTRACT: " . $aFile['filename'] . "<br />");
                  $archive->extract(PCLZIP_OPT_PATH, $newpath, PCLZIP_OPT_BY_NAME, $aFile['filename'] );
               }
               else
               {
                  $sSkippedFiles .= $owl_lang->archive_skip_file . " " . $aFile['filename'] . "<br />";
                  //print("SKIP: " . $aFile['filename'] . "<br />");
               }
                
            }
            else
            {
               $sql->query("SELECT * from $default->owl_files_table where filename = '" . $aFile['filename']. "' and parent = '$sCheckFolderID';");
               if ($sql->num_rows() == 0)
               {
                  //print("EXTRACT: " . $aFile['filename'] . "<br />");
                  $archive->extract(PCLZIP_OPT_PATH, $newpath, PCLZIP_OPT_BY_NAME, $aFile['filename'] );
               }
               else
               {
                  $sSkippedFiles .= $owl_lang->archive_skip_file . " " . $aFile['filename'] . "<br />";
                  //print("SKIP: " . $aFile['filename'] . "<br />");
               }
            }
         }
      } 
   }
   else
   {
      if ($archive->extract(PCLZIP_OPT_PATH, $newpath, PCLZIP_CB_PRE_EXTRACT, 'pclzip_convert_filename_cb') == 0)
      {
         if ($default->debug == true)
         {
            printError("DEBUG: " .$archive->errorInfo(true));
         }
      }
   }

   fInsertUnzipedFiles($newpath, $newParent, $FolderPolicy, $security, $description, $groupid, $userid, $metadata, $title, $major_revision, $minor_revision, $doctype, true, $reviewers);


   if (!$default->owl_use_fs )
   {
      myDelete($default->owl_tmpdir . DIR_SEP . $dirname[0]);
   }
   unlink($default->owl_tmpdir . DIR_SEP . $new_name);
   unlink($userfile["tmp_name"]);

   if(!empty($sSkippedFiles))
   {
      printError($owl_lang->archive_skip_message , $sSkippedFiles, "WARNING");
   }

}


if ($action == "file_upload" or $action == "jupload")
{
   if (check_auth($parent, "folder_create", $userid) == 1)
   {
      if ($action == "file_upload")
      { 
         fCheckCustomRequiredFields($doctype);
      }
      $aRev = array();
      $aRev =    fValidateRevision($major_revision,$minor_revision);
      $major_revision = $aRev['major'];
      $minor_revision = $aRev['minor'];


      $sql_custom = new Owl_DB;

      if ($default->file_desc_req == "1" and trim($description) == "")
      {
         if ($action == "jupload")
         {
            $description = "JUpload Uploaded";
         }
         else
         {
            printError("$owl_lang->err_doc_field_req ", "Description");
         }
      }

      if (!isset($groupid))
      {
         $groupid = owlusergroup($userid);
      } 

      if (empty($expires))
      {
         $expires = '0001-01-01 00:00:00';
      }

      $sql = new Owl_DB; 
      // This is a hack to deal with ' in the description field
      // on some system the ' is automaticaly changed to \' and that works
      // on other system it stays as ' I have no idea why
      // the 2 lines bellow should take care of any case.
      //$description = ereg_replace("[\\]'", "'", $description);
      $description = stripslashes($description);
      //$description = fOwl_ereg_replace("'", "\\'" , $description);
      $description = addslashes($description);
      if ($type == "url")
      {
        // $smodified = date("Y-m-d H:i:s");
         $smodified = $sql->now();
         //$dCreateDate = date("Y-m-d H:i:s");
         $dCreateDate = $sql->now();
         $new_name = $userfile;

         if (trim($userfile) == 'http://' or trim($userfile) == '')
         {
            printError("$owl_lang->err_bad_url");
         }
         if ($title == "")
         {
            $title = get_title_tag($userfile); 
            if ($title == false)
            {
               $title = trim($userfile);
            }
         }
         // $title = $userfile;
         // This is a hack to deal with ' in the description field
         // on some system the ' is automaticaly changed to \' and that works
         // on other system it stays as ' I have no idea why
         // the 2 lines bellow should take care of any case.

         $title = stripslashes($title);
         //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));
         $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));

         if ($default->save_keywords_to_db)
         {
            $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
            $metadata = "";
   
            foreach ($currentvalue as $word)
            {   
               $word = addslashes($word);
               if(!preg_grep("/$word/", $keywordpick))
               {
                  $metadata .= " " . $word;
               }
            }
   
            foreach ($keywordpick as $word)
            {
               $metadata .= " " . $word;
            }
         }
         else
         {
            $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
            $metadata = "";
   
            foreach ($currentvalue as $word)
            {
                  $metadata .= " " . $word;
            }
         }

         $metadata = stripslashes($metadata);
         //$metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", strtolower($metadata)));
         $metadata = addslashes(fOwl_ereg_replace("[<>]", "", strtolower($metadata)));

         $userfile = fOwl_ereg_replace('\\\\', "/" , $userfile);
         $userfile = trim($userfile); 
         $userfile = fOwl_ereg_replace(" ", "%20", $userfile);

         if ($checked_out == "") $checked_out = 0; 


         $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid,parent,created, description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, approved, expires, name_search, filename_search, description_search, metadata_search) values ('$title', '" . $userfile . "', '0', '$userid', '$userid', '$parent', $dCreateDate,'$description', '$metadata', '$security', '$groupid',$smodified,'$checked_out','$major_revision','$minor_revision','1','$doctype','1', '$expires', '" . fReplaceSpecial($title) . "', '" . fReplaceSpecial($userfile) . "', '" . fReplaceSpecial($description) . "', '" . fReplaceSpecial($metadata) . "')");
         $id = $sql->insert_id($default->owl_files_table, 'id');  

         $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$doctype'");
         while ($sql_custom->next_record())
         {
             switch ($sql_custom->f("field_type"))
             {
                case "seperator":
                   break;
                case "mcheckbox":
                      $aMultipleCheckBox = split("\|",  $sql_custom->f("field_values"));
                       $i = 0;
                       $sFieldValues = "";
                       foreach ($aMultipleCheckBox as $sValues)
                       {
                          $sFieldName = $sql_custom->f("field_name") . "_".$i;
                                                                                                                                                                                                    
                          if ($i > 0)
                          {
                             $sFieldValues .= "|";
                          }
                          $sFieldValues .= $_POST[$sFieldName];
                          $i++;
                       }
                       $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$id', '" . $sql_custom->f("field_name") ."', '" . $sFieldValues ."');");
                    break;
                 default:
                       $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$id', '" . $sql_custom->f("field_name") ."', '" . $_POST[$sql_custom->f("field_name")] ."');");
                    break;
           }
         }

         $iDocApproved = 1;
      }
      elseif ($type == "note")
      {
         $smodified = $sql->now();
         $dCreateDate = $sql->now();
         $new_name = trim(fOwl_ereg_replace("\.\./", "", $title)) . ".txt";
         $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $new_name)));

         if ($title == "")
         {
            printError("$owl_lang->err_note_title");
         } 
         // This is a hack to deal with ' in the description field
         // on some system the ' is automaticaly changed to \' and that works
         // on other system it stays as ' I have no idea why
         // the 2 lines bellow should take care of any case.
         //$title = ereg_replace("[\\]'", "'", $title);
         $title = stripslashes($title);
         $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));
         //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));

         if ($default->save_keywords_to_db)
         {
            $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
            $metadata = "";
   
            foreach ($currentvalue as $word)
            {      
               $word = addslashes($word);
               if(!preg_grep("/$word/", $keywordpick))
               {
                  $metadata .= " " . $word;
               }
            }
   
            foreach ($keywordpick as $word)
            {
               $metadata .= " " . $word;
            }
         }
         else
         {
            $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
            $metadata = "";
   
            foreach ($currentvalue as $word)
            {
                  $metadata .= " " . $word;
            }
         }

         $metadata = stripslashes($metadata);
         //$metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", strtolower($metadata)));
         $metadata = addslashes(fOwl_ereg_replace("[<>]", "", strtolower($metadata)));
         $note_size = strlen($note_content);

         if (empty($checked_out))
         {
            $checked_out = 0; 
         }

         $tmpfile = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $new_name;
         if (file_exists($tmpfile))
         {
            printError("$owl_lang->err_note_title_exists");
         } 

         $new_quota = fCalculateQuota($note_size, $userid, "ADD");

         $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid, updatorid,parent,created, description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, approved, expires, name_search, filename_search, description_search, metadata_search) values ('" . $sql->make_arg_safe($title) . "', '" . $sql->make_arg_safe($new_name) . "', '$note_size', '$userid', '$userid', '$parent', $dCreateDate,'$description', '" . $sql->make_arg_safe($metadata) . "', '$security', '$groupid',$smodified,'$checked_out','$major_revision','$minor_revision','2', '1', '1', '$expires', '" . fReplaceSpecial($title) . "', '" . fReplaceSpecial($new_name) . "', '" . fReplaceSpecial($description) . "', '" . fReplaceSpecial($metadata) . "')");

         if ($default->owl_use_fs)
         {
            $fp = fopen($tmpfile, "wb");
            fwrite($fp, stripslashes($note_content));
            fclose($fp); 
            $searchid = $sql->insert_id($default->owl_files_table, 'id');
            fIndexAFile($new_name, $tmpfile, $searchid);
         } 
         else
         {
            $tmpfile = $default->owl_tmpdir . DIR_SEP . $new_name;
            $filedata = fEncryptFiledata($note_content);
            $fp = fopen($tmpfile, "wb");
            fwrite($fp, $note_content);
            fclose($fp);
            $searchid = $sql->insert_id($default->owl_files_table, 'id'); 
            fIndexAFile($new_name, $tmpfile, $searchid);
            unlink($tmpfile);
            if ($searchid !== null && $filedata)
            {
               $filedatasql = new Owl_DB;
               $filedatasql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$searchid', '$filedata', '0')", 'latin1');
            } 
         } 
         $id = $searchid;
         if ( fIsQuotaEnabled($userid) )     
         {
            $sql->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '$userid'");
         }

         $iDocApproved = 1;
         notify_users($groupid, NEW_NOTE, $id, $type);
         notify_monitored_folders ($parent, $new_name);
         owl_syslog(FILE_UPLOAD, $userid, $new_name, $parent, $owl_lang->log_detail, "FILE", $note_size);
      } 
      else
//************************************************************
// Start of regular File Upload
// ADD ERROR HANDLING OF FILE
// http://ca.php.net/manual/en/features.file-upload.errors.php
//************************************************************
      {
        if ($default->use_ubr_progress_bar == 1 && ($action == "file_upload" or $action == "zip_upload") && $type == "")
         {
            $_FILES[0] = array("name" => file_basename($file_name), "size" => $file_size, "tmp_name" => $default->ubr_progress_bar_upload_dir . "/" . $userfile['name']);
         }
         else if ($default->use_progress_bar == 1)
         {
            if (count($file['name']) > 1)
            {
               for ($i = 0; $i < count($file['name']); $i++)
               {
                  $_FILES[$i] = array("name" => file_basename($file['name'][$i]), "size" => $file['size'][$i], "tmp_name" => $file['tmp_name'][$i]);
               }
            }
            else
            {
               $_FILES[0] = array("name" => file_basename($file['name'][0]), "size" => $file['size'][0], "tmp_name" => $file['tmp_name'][0]);
            }
         }



         $iInitialParent = $parent;
		 $sql = new Owl_DB;
         $iFileCount = 0;

         foreach ($_FILES as $userfile)
         {

            // Check if the file comes from a a sub Directory
            if ($action == "jupload")
	    {
//fOwlWebDavLog ("JUPLOAD", "START");
	       if (!empty($_POST['relpathinfo'][$iFileCount]))
	       {
                  $sRelPathName = $_POST['relpathinfo'][$iFileCount];

                  $aRelPath = explode('[\\]', $_POST['relpathinfo'][$iFileCount]);
                  
                  foreach ($aRelPath as $sRelPathName)
                  {
                     if (empty($sRelPathName))
                     {
                        continue;
                     }
                     $sql->query("SELECT id FROM $default->owl_folders_table WHERE parent='$parent' and name ='$sRelPathName'");
                     if ($sql->num_rows() > 0)
                     {
                        $sql->next_record();
                        $parent = $sql->f('id');
                     }
                     else
                     {
                        $smodified = $sql->now();
//fOwlWebDavLog ("JUPLOAD", "INSERT FOLDER");
                        $sql->query("INSERT INTO $default->owl_folders_table (name,parent,security,description,groupid,creatorid, password, smodified, linkedto, rss_feed) values ('$sRelPathName', '$parent', '$iSecurity', '', '$groupid', '$userid', '', $smodified , '0', '0')");
   
                        $iOldParent = $parent;
                        $parent = $sql->insert_id($default->owl_folders_table, 'id');
                        $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent);
                        mkdir($newpath, $default->directory_mask);
                        owl_syslog(FOLDER_CREATED, $userid, $sRelPathName, $parent, $owl_lang->log_detail . "JUPLOAD CREATED", "FILE");
   
                        fSetDefaultFolderAcl($parent);
                        fSetInheritedAcl($iOldParent, $parent, "FOLDER");
   
                     }

	          }
                  $iFileCount++;
               }
	   }

			

            if (empty($userfile["tmp_name"]))
            {
               continue;
            }
            if (empty($_POST["title"]))
            {
               $title = "";
            }
   
            if (isset($default->upload_ommit_ext))
            {
               $file_extension = fFindFileExtension ( $userfile["name"]);
               foreach ($default->upload_ommit_ext as $omit)
               {
                  if ($file_extension == $omit)
                  {
                     $bOmitFile = true;
                  }
               }
               if($bOmitFile)
               {
                  printError($owl_lang->err_forbidden_file);
               }
            }
            // If the File Size is 0 File was too big.
            if ($default->display_password_override == 1)
            {
               if ($newpassword <> $confpassword)
               {
                  printError($owl_lang->err_pass_missmatch);
               }
               else
               {
                  if (!empty($newpassword))
                  {
                     $newpassword = md5($newpassword);
                  }
                  else
                  {
    
                  }
               }
            }
            else
            {
               $newpassword = "";
            }
   
            if ($userfile["size"] == 0)
            {
               if ($default->debug == true)
               {
                  if ( $action == "jupload" )
                  {
//fOwlWebDavLog ("JUPLOAD SUCCESS", "THREE");
                     exit("SUCCESS");
                  }
                  else
                  {
                     $iDiskFree = gen_filesize(disk_free_space($userfile["tmp_name"]));

                     printError("DEBUG: " . $owl_lang->err_upload . "PHP tempdir Free Space: $iDiskFree, " . $owl_lang->err_file_too_big . " " . $default->max_filesize);
                  }
               }
               else
               {
                  if ( $action == "jupload" )
                  {
//fOwlWebDavLog ("JUPLOAD SUCCESS", "FOUR");
                     exit("SUCCESS");
                  }
                  else
                  {
                     printError("$owl_lang->err_upload");
                  }
               }
            }


            $aFileHashes = fCalculateFileHash($userfile["tmp_name"]);
            fVirusCheck($userfile["tmp_name"], $userfile["name"]);
   
            $new_quota = fCalculateQuota($userfile["size"], $userid, "ADD");
   
            $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $userfile["name"])));
   
            if ($default->owl_use_fs)
            {
               $newpath = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP . $new_name;
               if (file_exists($newpath) == 1)
               {
                  if ($default->jupload_overwrite == '1')
                  {
                     $JuploadUpdate = '1';
                  }
                  else
                  {
                     if ($default->debug == true)
                     {
                        printError("DEBUG: " . $owl_lang->err_file_exists, $newpath);
                     }
                     else
                     {
                        printError($owl_lang->err_file_exists);
                     }
                  }
               }
   
               //copy($userfile["tmp_name"], $newpath);
               if ($default->use_ubr_progress_bar == 1)
               {
                  copy($userfile["tmp_name"], $newpath);
                  chmod($newpath, $default->file_mask);
                  unlink($userfile['tmp_name']);
               }
               else if ($default->use_progress_bar == 1)
               {
                  copy($userfile["tmp_name"], $newpath);
                  chmod($newpath, $default->file_mask);
               }
               else
               {
                  move_uploaded_file( $userfile['tmp_name'], $newpath );
                  chmod($newpath, $default->file_mask);
               }

   
               if (!file_exists($newpath))
               {
                  if ($default->debug == true)
                  {
                     printError("DEBUG: " . $owl_lang->err_upload, $newpath);
                  }
                  else
                  {
                     printError($owl_lang->err_upload);
                  }
               }
            } 
            else
            { 
               // is name already used?
               $sql->query("SELECT filename FROM $default->owl_files_table WHERE filename = '$new_name' and parent='$parent'");
               while ($sql->next_record())
               {
                  if ($sql->f("filename"))
                  { 
                     // can't move...
                     printError("$owl_lang->err_fexist1", $owl_lang->err_fexist2 . "<i>$new_name</i>" . $owl_lang->err_fexist3);
                  } 
               } 
            } 
   
            $smodified = $sql->now();
            $dCreateDate = $sql->now();
            if ($title == "")
            {
               $title = $new_name;

               $aFirstpExtension = fFindFileFirstpartExtension ($title);
               $title = $aFirstpExtension[0];
               $title = fOwl_ereg_replace("_", " ", $title);
            }

            if (!isset($checked_out) or $checked_out == "")
            {
               $checked_out = 0; 
            }
   
            $title = stripslashes($title);
            //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));
            $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));
   
            if ($default->save_keywords_to_db)
            {
               $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
               $metadata = "";
      
               foreach ($currentvalue as $word)
               {
                  $word = addslashes($word);
                  if (empty($keywordpick))
                  {
                     $metadata .= " " . $word;
                  }
                  else
                  {
                     if(!empty($keywordpick) and is_array($keywordpick))
                     {
                        if(!preg_grep("/$word/", $keywordpick))
                        {
                           $metadata .= " " . $word;
                        }
                     }
                  }
               }
      
               if(!empty($keywordpick) and is_array($keywordpick))
	       {
                  foreach ($keywordpick as $word)
                  {
                     $metadata .= " " . $word;
                  }
	       }
            }
            else
            {
               $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
               $metadata = "";
      
               foreach ($currentvalue as $word)
               {
                     $metadata .= " " . $word;
               }
            }

            $metadata = stripslashes($metadata);
            //$metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", strtolower($metadata)));
            $metadata = addslashes(fOwl_ereg_replace("[<>]", "", strtolower($metadata)));

            $iDocApproved = fIsDocApproved ($reviewers, $newpath);
   
// IF the Folder is in the special folder array
            // Use the values from the array
            $bIsWithinSpecialAccess = false;
            fCheckWithinSpecialAccess($parent);
            if ($bIsWithinSpecialAccess)
            {
               $iCreatorID = $default->special_folder_defaults[$parent]['creatorid'];
               $iGroupID = $default->special_folder_defaults[$parent]['groupid'];
               $iSecurity = $default->special_folder_defaults[$parent]['security'];
               if (empty($description) or strlen(trim($description)) == 0)
               {
                  $sDescription = $default->special_folder_defaults[$parent]['description'];
               }
               else
               {
                  $sDescription = $description;
               }
               if (empty($metadata) or strlen(trim($metadata)) == 0)
               {
                  $sMetadata = $default->special_folder_defaults[$parent]['metadata'];
               }
               else
               {
                  $sMetadata = $metadata;
               }
            }
            else
            {
               $iCreatorID = $userid;
               $iGroupID = $groupid;
               if (empty($security))
               {
                  $security = '0';
               }
               $iSecurity = $security;
               $sDescription = $description;
               $sMetadata = $metadata;
            }
  
//fOwlWebDavLog ("JUPLOAD", "BEFORE FILE");
            if (isset($JuploadUpdate) and $JuploadUpdate == '1')
            {
//fOwlWebDavLog ("JUPLOAD UPDFILE", "BEFORE FILE UPDATE");
               if ($default->owl_version_control == 1)
               {
// ***************  TEST ME Thouroughly ***********************
// ***************  TEST ME Thouroughly ***********************
// ***************  TEST ME Thouroughly ***********************
                  $sql->query("SELECT id FROM  $default->owl_files_table filename='$new_name' and parent='$parent'");
                  $sql->next_record();
                  $iUpdateID = $sql->f('id');
                  if ($default->owl_use_fs)
                   {
                      $sql->query("SELECT * FROM $default->owl_files_table WHERE id='$iUpdateID'");
                   }
                   else
                   {
                      // this is guaranteed to get the ID of the most recent revision, just in case we're updating a previous rev.
                      $sql->query("SELECT distinct b.* FROM $default->owl_files_table a, $default->owl_files_table b WHERE b.id='$iUpdateID' AND a.name=b.name AND a.parent=b.parent order by major_revision, minor_revision desc");
                   }
          
                   while ($sql->next_record())
                   {
            $major_revision = $backup_major = $sql->f("major_revision");
            $minor_revision = $backup_minor = $sql->f("minor_revision");
            $linkedto = $backup_linkedto = $sql->f("linkedto");
            if (empty($backup_linkedto))
            {
               $backup_linkedto = "0";  // unkown
               $linkedto = "0";  // unkown
            }
            $backup_filename = $sql->f("filename");
            $backup_name = $sql->f("name");

            // Tiian 2004-02-18
            // this stuff prevent errors when title contains apostrophes
            //$backup_name = ereg_replace("[\\]'", "'", $backup_name);
            $backup_name = stripslashes($backup_name);
            //$backup_name = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $backup_name));
            $backup_name = addslashes(fOwl_ereg_replace("[<>]", "", $backup_name));

            $backup_size = $sql->f("f_size");
            $backup_creatorid = $sql->f("creatorid");
            $backup_updatorid = $sql->f("updatorid");
            if (empty($backup_updatorid))
            {
               $backup_updatorid = "0";  // unkown
            }

            // $backup_modified = $sql->f("modified");
            $backup_smodified = $sql->f("smodified");
            //$dCreateDate = date("Y-m-d H:i:s");
            $dCreateDate = $sql->now();
            $backup_description = $sql->f("description");
            // This is a hack to deal with ' in the description field
            // on some system the ' is automaticaly changed to \' and that works
            // on other system it stays as ' I have no idea why
            // the 2 lines bellow should take care of any case.
            //$backup_description = ereg_replace("[\\]'", "'", $backup_description);
            $backup_description = stripslashes($backup_description);
            //$backup_description = fOwl_ereg_replace("'", "\\'" , $backup_description);
            $backup_description = addslashes($backup_description);
            $backup_name = stripslashes($backup_name);
            //$backup_name = fOwl_ereg_replace("'", "\\'" , $backup_name);
            $backup_name = addslashes($backup_name);
            $backup_metadata = $sql->f("metadata");
            $backup_metadata = stripslashes($backup_metadata);
            //$backup_metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $backup_metadata));
            $backup_metadata = addslashes(fOwl_ereg_replace("[<>]", "", $backup_metadata));

            $backup_parent = $sql->f("parent");
            $backup_security = $sql->f("security");
            $backup_groupid = $groupid = $sql->f("groupid");

            $new_quota = fCalculateQuota($userfile['size'], $userid, "ADD");
            $filename = $sql->f(filename);
            $title = $sql->f(name);
            $description = $sql->f(description);
            $description = stripslashes($description);
            $description = addslashes($description);
            $extension = explode(".", $new_name);
            $extensioncounter = 0;
            while ($extension[$extensioncounter + 1] != null)
            {
               if ($extensioncounter != 0)
               {
                  $version_name = $version_name . ".";
               }
               $version_name = $version_name . $extension[$extensioncounter];
               $extensioncounter++;
            }
            if ($extensioncounter != 0)            {
               $version_name = $version_name . "_$major_revision-$minor_revision.$extension[$extensioncounter]";
            }
            else
            {
               $version_name = $extension[0] . "_$major_revision-$minor_revision";
            }

            $backuppath = $default->owl_FileDir . DIR_SEP . find_path($parent) . "/$default->version_control_backup_dir_name/$version_name";
            if (!is_dir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name"))            {
               mkdir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name", $default->directory_mask);

               if (is_dir("$default->owl_FileDir/" . find_path($parent) . "/$default->version_control_backup_dir_name"))
               {
                  $sql->query("INSERT INTO $default->owl_folders_table (name, parent, security, groupid, creatorid, description, linkedto)  values ('$defaul
t->version_control_backup_dir_name', '$parent', '" . fCurFolderSecurity($parent) ."', '" . owlfoldergroup($parent) ."', '" . owlfoldercreator($parent) . "',
 '', '0')");

                  $newParent = $sql->insert_id($default->owl_folders_table, 'id');

                  fSetDefaultFolderAcl($newParent);
                  fSetInheritedAcl($parent, $newParent, "FOLDER");
               }
            }
            copy($newpath, $backuppath); // copy existing file to backup folder

         $new_version_num = $minor_revision + 1;
         $new_minor = $minor_revision + 1;
         $versionchange = "minor_revision='$new_minor', major_revision";
         $new_major = $major_revision;

     $groupid = owlusergroup($userid);
      $smodified = $sql->now();

//fOwlWebDavLog ("JUPLOAD", "BEFORE FILE INSERT");
      if ($default->owl_use_fs)
         {
            // insert entry for backup file
            $result = $sql->query("insert into $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent,created, smodified,groupid,description,metadata,security,major_revision,minor_revision, doctype, linkedto, approved, name_search, filename_search, description_search, metadata_search) values ('$backup_name','   $version_name','$backup_size','$backup_creatorid','$backup_updatorid','$backup_parent',$dcreatedate,'$backup_smodified','$backup_groupid', '$backup_description','$backup_metadata','$backup_security','$backup_major','$backup_minor', '$doctype', '$backup_linkedto', '1', '" . fReplaceSpecial($backup_name) . "', '" . fReplaceSpecial($version_name) . "', '" . fReplaceSpecial($backup_description) . "', '" . fReplaceSpecial($backup_metadata) . "','" . $backup_name_search . "','" . $backup_filename_search . "','" . $backup_description_search . "','" . $backup_metadata_search . "')") or unlink($backuppath);
            if (!$result && $default->owl_use_fs) unlink($newpath);

            $idbackup = $sql->insert_id($default->owl_files_table, 'id');
            $sql->query("UPDATE $default->owl_files_table SET f_size='$doc_size', smodified=$smodified, $versionchange='$new_version_num',description='$newdesc', approved = '$iDocApproved', updatorid='$userid', description_search='" . fReplaceSpecial($newdesc) . "' WHERE id='$iUpdateID'") or unlink($newpath);
            // UPDATE THE VERSION of the linked files as well.

            $sql->query("UPDATE $default->owl_files_table SET f_size='$doc_size', smodified=$smodified, $versionchange='$new_version_num',description='$newdesc', updatorid='$userid', description_search='" . fReplaceSpecial($newdesc) . "'  WHERE linkedto='$iUpdateID'") or unlink($newpath);

            $sql->query("UPDATE $default->owl_searchidx SET owlfileid='$idbackup'  WHERE owlfileid='$iUpdateID'");

            fIndexAFile($backup_filename, $newpath, $iUpdateID);


            fCopyFileAcl($iUpdateID, $idbackup);


            owl_syslog(FILE_UPDATED, $userid, $userfile["name"], $parent, $version_name, "FILE", $userfile['size']);
         }
         else
         {
            $compressed = '0';
            $userfile = uploadCompat("userfile");

            $fsize = filesize($userfile['tmp_name']);


            $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent, created, smodified,groupid,description,metadata,security,major_revision,minor_revision, doctype, linkedto, approved, name_search, filename_search, description_search, metadata_search) VALUES ('$backup_name','" . $userfile['name'] . "','" . $userfile['size'] . "','$backup_creatorid','$userid','$parent',$dCreateDate,$smodified,'$backup_groupid', '$newdesc', '$backup_metadata','$backup_security','$new_major','$new_minor', '$doctype', '$backup_linkedto', '$iDocApproved', '" . fReplaceSpecial($backup_name) . "', '" . fReplaceSpecial($userfile['name']) . "', '" . fReplaceSpecial($newdesc) . "', '" . fReplaceSpecial($backup_metadata) . "')");

            $fid = $iUpdateID;
            $id = $sql->insert_id($default->owl_files_table, 'id');

            $monitorSQL = new Owl_DB;
// Move ACL's for this file
// make them the same as the file Originally updated.
            $sql->query("UPDATE $default->owl_advanced_acl_table SET file_id='$id' WHERE file_id = '$fid'");
// 
            $monitorSQL = new Owl_DB;
            $monitorSQL->query("SELECT * FROM $default->owl_monitored_file_table WHERE fid = $fid and userid = '$userid'");
            if ($monitorSQL->num_rows() != 0)
            {
               $monitorSQL->query("SELECT id FROM $default->owl_files_table WHERE name = '$backup_name' and parent = '$parent' and major_revision = '$new_major' and minor_revision = '$new_minor'");
               $monitorSQL->next_record();
               $newmonitorid = $monitorSQL->f("id");
               $monitorSQL->query("UPDATE $default->owl_monitored_file_table SET fid = '$newmonitorid'");
            }

            // If pdftotext was set and exists
            // Create a search index for this text file.
            fIndexAFile($userfile['name'], $userfile['tmp_name'], $id);

            if ($default->owl_compressed_database && file_exists($default->gzip_path))
            {
               system(escapeshellarg($default->gzip_path) . " " . escapeshellarg($userfile['tmp_name']));
               $fd = fopen($userfile['tmp_name'] . ".gz", 'rb');
               $userfile['tmp_name'] = $userfile['tmp_name'] . ".gz";
               $fsize = filesize($userfile['tmp_name']);
               $compressed = '1';
            }
          else
            {
               $fd = fopen($userfile['tmp_name'], 'rb');
            }
            $filedata = fEncryptFiledata(fread($fd, $fsize));
            fclose($fd);
            unlink($userfile['tmp_name']);

            if ($id !== null && $filedata)
            {
               $filedatasql = new Owl_DB;
               $filedatasql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$id', '$filedata', '$compressed')", 'latin1');
            }
            owl_syslog(FILE_UPDATED, $userid, $userfile["name"], $parent, $backup_name, "FILE", $userfile['size']);
         }
             }

                  //exit("PERFORM File UPDATE / MOVE to Backup and Create New Version");

// ***************  TEST ME Thouroughly ***********************
// ***************  TEST ME Thouroughly ***********************
// ***************  TEST ME Thouroughly ***********************
               }
               else
               {
                  $result = $sql->query("UPDATE $default->owl_files_table set f_size='" . $userfile['size'] . "',updatorid='$iCreatorID', smodified=$smodified where filename='$new_name' and parent='$parent'");
               }
            }
            else
            {
//fOwlWebDavLog ("JUPLOAD", "BEFORE FILE INSERT 1");
//fOwlWebDavLog ("JUPLOAD", "SQL: INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent,created,description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, password, linkedto, approved, expires, name_search, filename_search, description_search, metadata_search) values ('$title', '" . $sql->make_arg_safe($new_name) . "', '" . $userfile['size'] . "', '$iCreatorID', '$iCreatorID', '$parent', $dCreateDate, '$sDescription', '$sMetadata', '$security', '$iGroupID',$smodified,'$checked_out','$major_revision','$minor_revision', '0', '$doctype', '$newpassword' ,'0', '$iDocApproved', '$expires', '" . $sql->make_arg_safe(fReplaceSpecial($title)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($new_name)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($description)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($metadata)) . "')");

               $result = $sql->query("INSERT INTO $default->owl_files_table (name,filename,f_size,creatorid,updatorid,parent,created,description,metadata,security,groupid,smodified,checked_out, major_revision, minor_revision, url, doctype, password, linkedto, approved, expires, name_search, filename_search, description_search, metadata_search) values ('$title', '" . $sql->make_arg_safe($new_name) . "', '" . $userfile['size'] . "', '$iCreatorID', '$iCreatorID', '$parent', $dCreateDate, '$sDescription', '$sMetadata', '$security', '$iGroupID',$smodified,'$checked_out','$major_revision','$minor_revision', '0', '$doctype', '$newpassword' ,'0', '$iDocApproved', '$expires', '" . $sql->make_arg_safe(fReplaceSpecial($title)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($new_name)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($description)) . "', '" . $sql->make_arg_safe(fReplaceSpecial($metadata)) . "')") or unlink($newpath);
//fOwlWebDavLog ("JUPLOAD", "AFTER FILE INSERT 1");
               if (!$result and $default->owl_use_fs) 
               {
                  unlink($newpath); 
               }
           } 
            // IF the file was inserted in the database now INDEX it for SEARCH.
            if (!$default->owl_use_fs)
            {
               $newpath = $userfile['tmp_name'];
            } 
   
            $id = $sql->insert_id($default->owl_files_table, 'id');  
   
            $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$doctype'");
            while ($sql_custom->next_record())
            {
                switch ($sql_custom->f("field_type"))
                {
                   case "seperator":
                      break;
                   case "mcheckbox":
                         $aMultipleCheckBox = split("\|",  $sql_custom->f("field_values"));
                          $i = 0;
                          $sFieldValues = "";
                          foreach ($aMultipleCheckBox as $sValues)
                          {
                             $sFieldName = $sql_custom->f("field_name") . "_".$i;
                             if ($i > 0)
                             {
                                $sFieldValues .= "|";
                             }
                             if (isset($_POST[$sFieldName]))
                             {
                                $sFieldValues .= $_POST[$sFieldName];
                             }
                             $i++;
                          }
                          $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$id', '" . $sql_custom->f("field_name") ."', '" . $sFieldValues ."');"); 
                       break;
                    default:
                          $sFieldValues = '';
                          if (isset($_POST[$sql_custom->f("field_name")]))
                          { 
                             $sFieldValues .= $_POST[$sql_custom->f("field_name")];
                          }
                          $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$id', '" . $sql_custom->f("field_name") ."', '" . $sFieldValues ."');"); 
                       break;
              }
            }
   
            // *****************************
            // PEER Review feature END
            // *****************************
            if ( $default->document_peer_review == 1)
            {
               foreach ($reviewers as $iReviewerId)
               {
                  if(!empty($iReviewerId))
                  { 
                     $result = $sql_custom->query("INSERT INTO $default->owl_peerreview_table (reviewer_id, file_id, status) values ('$iReviewerId', '$id', '0')");
                     notify_reviewer ($iReviewerId, $id , $message);
                  }
               }
            }
            // *****************************
            // PEER Review feature END
            // *****************************
   
            // If pdftotext was set and exists
            // Create a search index for this text file.
            if ($default->calculate_file_hash == 1)
            { 
               $sql->query("INSERT INTO $default->owl_file_hash_table (file_id, hash1, hash2, hash3, signature) VALUES ('$id', '" . $aFileHashes[0] . "', '" . $aFileHashes[1] ."', '" . $aFileHashes[2] . "', 'NOT IMPLEMENTED')");
            }

//fOwlWebDavLog ("JUPLOAD INSERT", "AFTER FILE INSERT 1");
            fIndexAFile($new_name, $newpath, $id);
//fOwlWebDavLog ("JUPLOAD INSERT", "AFTER FILE INDEXED");
   
            $compressed = '0';
            $file = uploadCompat("userfile");
            //fVirusCheck($userfile["tmp_name"], $userfile["name"]);
   
            $fsize = $userfile['size'];
            if (!$default->owl_use_fs && $default->owl_compressed_database && file_exists($default->gzip_path))
            {
               system(escapeshellarg($default->gzip_path) . " " . escapeshellarg($userfile['tmp_name']));
               $userfile['tmp_name'] = $userfile['tmp_name'] . ".gz";
               $fsize = filesize($userfile['tmp_name']);
               $compressed = '1';
            } 
            // BEGIN wes change
            if (!$default->owl_use_fs)
            {
               $fd = fopen($userfile['tmp_name'], 'rb');
               //$filedata = fread($fd, $fsize);
               $filedata = fEncryptFiledata(fread($fd, $fsize));
               fclose($fd);
               unlink($userfile['tmp_name']);
   
               if ($id !== null && $filedata)
               {
                  $filedatasql = new Owl_DB;
                  $filedatasql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$id', '$filedata', '$compressed')", 'latin1');
               } 
            } 

            fGenerateThumbNail($id);
//fOwlWebDavLog ("JUPLOAD INSERT", "AFTER THUMBNAIL GEN");
   
            if ( fIsQuotaEnabled($userid) )     
            {
               $sql->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '$userid'");
            }
            $aSetACL[] = $id;

            fSetDefaultFileAcl($id);
            fSetInheritedAcl($parent, $id, "FILE");
   
            if ($iDocApproved == 1)
            {
               notify_users($groupid, NEW_FILE, $id, $type);
               notify_monitored_folders ($parent, $new_name);
            }
            owl_syslog(FILE_UPLOAD, $userid, $new_name, $parent, $owl_lang->log_detail, "FILE", $fsize);
         } 

         if ($savekeyword == 1 and $default->save_keywords_to_db)
         {
            $newkeywords = preg_split("/\s+/", $metadata);
            $sql = new Owl_DB;
            foreach ($newkeywords as $word)
            {
               $word = trim(strtolower($word));
               if (!empty($word))
               {
                  $sql->query("SELECT * FROM $default->owl_keyword_table WHERE keyword_text = '$word' ");
                  if ($sql->num_rows() == 0)
                  {
                     $sql->query("INSERT INTO $default->owl_keyword_table (keyword_text) values ('$word') ");
                  }
               }
            }
         }
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
      if ($default->docRel)
      {
         $sql = new Owl_DB;
            $sql->query("DELETE FROM $default->docRel_table WHERE file_id='$id'");
         foreach ($docRelPick as $word)
         {
            if (!empty($word))
            {
               $sql->query("INSERT INTO $default->docRel_table (file_id, related_file_id) VALUES ('$id', '$word') ");
            }
         }
      }
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
      }

     if ( $action == "jupload" )
     {
        $parent = $iInitialParent;
        print("SUCCESS");
//fOwlWebDavLog ("JUPLOAD SUCCESS", "ONE");
	exit;
     }

      if ($set_acl == 1)
      {
         if (count( $aSetACL) > 1 )
         {
            $id = urlencode(serialize($aSetACL));
         }
         header("Location: " . $default->owl_root_url . "/setacl.php?sess=$sess&expand=$expand&action=file_acl&order=$order&sortname=$sortname&edit=1&id=" . $id . "&parent=" . $parent);
         exit;
      }
      else
      {
         if ( $action == "file_upload" )
         {
            displayBrowsePage($parent);
         }
         else
         {
            print("SUCCESS");
//fOwlWebDavLog ("JUPLOAD SUCCESS", "TWO");
            exit;
         }
      }
   } 
   else
   {
      printError($owl_lang->err_noupload);
   } 
} 

if ($action == "file_modify")
{
   if (check_auth($id, "file_property", $userid) == 1)
   {
      $iRealFileID = fGetPhysicalFileId($id);
      $sql = new Owl_DB; 
      $smodified = $sql->now();
      if ($default->display_password_override == 1)
      {
          if ($newpassword <> $confpassword)
          {
             printError($owl_lang->err_pass_missmatch);
          }
          else
          {
             if (!empty($newpassword))
             {
                $newpassword = md5($newpassword);
             }
             else
             {
                $sql->query("select password FROM " . $default->owl_files_table . " WHERE id='$id'");
                $sql->next_record();
                $newpassword = $sql->f("password");
             }
         
          }
      }
      else
      {
         $newpassword = "";
      }

      if ($default->file_desc_req == "1" and trim($description) == "")
      {
         printError("$owl_lang->err_doc_field_req ", "Description");
      }

      if ($saved_doctype == $doctype and $iRealFileID == $id)
      {
         fCheckCustomRequiredFields($doctype);
         $sql_custom = new Owl_DB;
      }
      // Begin Bozz Change
      if (!isset($groupid))
      {
         if (owlfilecreator($id) ==  $file_owner)
         {
            $groupid = owlusergroup($userid);
         }
         else
         {
            $groupid = owlusergroup($file_owner);
         }
     
      } 
      if (empty($expires))
      {
         $expires = '0001-01-01 00:00:00';
      }

      // BEGIN WES change
      if ($default->save_keywords_to_db)
      {
	     $KeyWrd = new Owl_DB;
         $KeyWrd->query("SELECT keyword_text from $default->owl_keyword_table order by keyword_text");

         $i = 0;
         while ($KeyWrd->next_record())
         {
            $keywords[$i] = $KeyWrd->f("keyword_text");
            $i++;
         }

         $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
         $metadata = "";

         foreach ($currentvalue as $word)
         {
            $word = addslashes($word);
            if (empty($keywordpick))
            {
                  $metadata .= " " . $word;
            }
            else
            {
               if(!in_array($word, $keywords))
               {
                  $metadata .= " " . $word;
               }
            }
         }

         foreach ($keywordpick as $word)
         {
            $metadata .= " " . $word;
         }
      }
      else
      {
         $currentvalue = array_unique(preg_split("/\s+/", strtolower($metadata)));
         $metadata = "";

         foreach ($currentvalue as $word)
         {
               $metadata .= " " . $word;
         }
      }

      $metadata = stripslashes(trim($metadata));

      //$metadata = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", strtolower($metadata)));
      $metadata = addslashes(fOwl_ereg_replace("[<>]", "", strtolower($metadata)));

      if (!$default->owl_use_fs)
      {
         $name = flid_to_name($id);
         if ($name != $title)
         { 
            // we're changing the name ... need to roll this to other revisions
            // is name already used?
            //$title = ereg_replace("[\\]'", "'", $title);
            $title = stripslashes($title);
            //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));
            $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));

            $sql->query("SELECT name FROM $default->owl_files_table WHERE name = '$title' and parent='$parent'");
            while ($sql->next_record())
            {
               if ($sql->f("name"))
               { 
                  // can't move...
                  printError("$owl_lang->err_fexist1", $owl_lang->err_fexist2 . "<i>$new_name</i>" . $owl_lang->err_fexist3);
               } 
            } 
            //$title = ereg_replace("[\\]'", "'", $title);
            $title = stripslashes($title);
            //$title = fOwl_ereg_replace("'", "\\'" , fOwl_ereg_replace("[<>]", "", $title));
            $title = addslashes(fOwl_ereg_replace("[<>]", "", $title));
            $sql->query("UPDATE $default->owl_files_table set smodified = $smodified, name='$title', filename='$filename', filename='$filename', name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($filename) . "' WHERE parent='$parent' AND name = '$name'");
         } 
      } 
      // This is a hack to deal with ' in the description field
      // on some system the ' is automaticaly changed to \' and that works
      // on other system it stays as ' I have no idea why
      // the 2 lines bellow should take care of any case.
      //$description = ereg_replace("[\\]'", "'", $description);
      $description = stripslashes($description);
      //$description = fOwl_ereg_replace("'", "\\'" , $description);
      $description = addslashes($description);

      //$title = ereg_replace("[\\]'", "'", $title);
      $title = stripslashes($title);
      //$title = fOwl_ereg_replace("'", "\\'" , $title);
      $title = addslashes($title);

      if (isset($note_content))
      {
         if (strlen(trim($new_filename)) == 0 or empty($new_filename))
         {
            printError("The filename cannot be empty");
         }

         $tmpfile = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($iRealFileID)) . DIR_SEP . $new_filename;
         $sOldFile = $default->owl_FileDir . DIR_SEP . find_path(owlfileparent($iRealFileID)) . DIR_SEP . flid_to_filename($iRealFileID);


         if ($tmpfile <> $sOldFile and file_exists($tmpfile))
         {
                  printError("$owl_lang->err_fexist1", $owl_lang->err_fexist2 . "<i>$new_filename</i>" . $owl_lang->err_fexist3);
         }

         $note_size = strlen($note_content);
         $updquota = new Owl_DB;
         $updquota->query("SELECT creatorid, f_size FROM $default->owl_files_table WHERE id = '$id'");
         $updquota->next_record();
         $iCurrentCreatorid = $updquota->f("creatorid");
         $iSize = $updquota->f("f_size");

         if ($iCurrentCreatorid != $file_owner)
         {
            $new_current_quota = fCalculateQuota($iSize, $file_owner, "DEL");
            $new_quota = fCalculateQuota($iSize, $file_owner, "ADD");

            if (fIsQuotaEnabled($file_owner))
            {
               $updquota->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '$file_owner'");
            } 
            if (fIsQuotaEnabled($iCurrentCreatorid))
            {
               $updquota->query("UPDATE $default->owl_users_table set quota_current = '$new_current_quota' WHERE id = '$iCurrentCreatorid'");
            } 
         } 
         else
         {
            $new_quota = fCalculateQuota($iSize, $file_owner, "DEL");
            $new_quota = $new_quota + $note_size;
            $updquota->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '$file_owner'");
            
         }

         if ($default->owl_use_fs)
         {
            unlink($sOldFile);
            $fp = fopen($tmpfile, "wb");
            fwrite($fp, stripslashes($note_content));
            fclose($fp);
         } 
         else
         {
            //$filedata = $note_content;
            $filedata = fEncryptFiledata($note_content);
            $filedatasql = new Owl_DB;
            $filedatasql->query("UPDATE $default->owl_files_data_table set data = '$filedata' WHERE id = '$id'", 'latin1');
         } 
         $sql->query("UPDATE $default->owl_files_table SET name='$title', filename='$new_filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner' , updatorid = '$userid', smodified = $smodified, f_size = '$note_size' , password = '$newpassword', major_revision = '$major_revision', minor_revision = '$minor_revision', expires = '$expires', name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($new_filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) .   "'  WHERE id = '$id'");
         if (fisAdmin())
         {
            $sql->query("UPDATE $default->owl_files_table SET smodified=$smodified, major_revision = '$major_revision', minor_revision = '$minor_revision', updatorid='$userid'  WHERE linkedto='$id'");
         }

      } 
      else
      {
         $updquota = new Owl_DB;
         $updquota->query("SELECT creatorid, f_size FROM $default->owl_files_table WHERE id = '$id'");
         $updquota->next_record();
         $iCurrentCreatorid = $updquota->f("creatorid");
         $iSize = $updquota->f("f_size");

         if ($iCurrentCreatorid != $file_owner)
         {
            $current_quota_max = 0;
            $new_current_quota = fCalculateQuota($iSize, $iCurrentCreatorid, "DEL");

            $new_quota = fCalculateQuota($iSize, $file_owner, "ADD");

            if (fIsQuotaEnabled($iCurrentCreatorid))
            {
               $updquota->query("UPDATE $default->owl_users_table set quota_current = '$new_current_quota' WHERE id = '$iCurrentCreatorid'");
            } 
            if (fIsQuotaEnabled($file_owner))
            {
               $updquota->query("UPDATE $default->owl_users_table set quota_current = '$new_quota' WHERE id = '$file_owner'");
            } 
         } 
         // ianm wants to put the file rename code here.  then use the following update command to update the database.
         if ($filename != $new_filename and $type <> "url")
         {
            $new_filename = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $new_filename)));
            if ($default->owl_use_fs) 
            {
               if (!file_exists($default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP .  $new_filename)) 
               {
			      $new_filename_dont_touch = $new_filename;
                  $old_filename_dont_touch = $filename;
                  // Also rename backup versions of the filesA
                  $sql->query("SELECT id FROM $default->owl_folders_table WHERE name='$default->version_control_backup_dir_name' and parent='$parent'");
                  if ($sql->num_rows($sql) != 0)
                  {
                     while ($sql->next_record())
                     {
                        $backup_parent = $sql->f("id");
                     }

                     $aFirstpExtension = fFindFileFirstpartExtension ($filename);
                     $firstpart = $aFirstpExtension[0];
                     $file_extension = $aFirstpExtension[1];

                     $aFirstpExtension = fFindFileFirstpartExtension ($new_filename);
                     $new_firstpart = $aFirstpExtension[0];
                     $new_file_extension = $aFirstpExtension[1];

                     $upd_sql = new Owl_DB; 

                     $sql->query("SELECT * FROM $default->owl_files_table WHERE (filename LIKE '" . $sql->make_arg_safe($firstpart) . "\\\_%" . $file_extension . "' AND parent = '$backup_parent') OR (filename = '" . $sql->make_arg_safe($filename) . "' AND parent = '$parent')");
                     while ($sql->next_record())
                     {
                        $major_revision = $sql->f("major_revision");
                        $minor_revision = $sql->f("minor_revision");
                        $l_filename = $sql->f("filename");
                        if ($l_filename == $firstpart.'_'.$major_revision.'-'.$minor_revision.".".$file_extension)
                        {
                           $new_bckp_filename = str_replace("$firstpart","$new_firstpart", $sql->f("filename"));
                           $sFilePath = $default->owl_FileDir . DIR_SEP . find_path($sql->f("parent"));
                           rename($sFilePath . DIR_SEP . $sql->f("filename"), $sFilePath . DIR_SEP . $new_bckp_filename);
                           $bckp_filename = $new_bckp_filename;
                           $iId = $sql->f("id");
                           $upd_sql->query("UPDATE $default->owl_files_table set smodified = $smodified, name='$title', filename='$bckp_filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner' ,updatorid = '$userid',  password = '$newpassword', name_search='" . fReplaceSpecial($name) . "', filename_search='" . fReplaceSpecial($bckp_filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) .   "' WHERE id = '$iId'");
                        }
                     }
                     $oldWD = getcwd();
                     chdir ($default->owl_FileDir . "/" . find_path($parent));
                     rename($filename, $new_filename);
                     chdir($oldWD);
                     $filename = $new_filename;
                     $sql->query("UPDATE $default->owl_files_table set smodified = $smodified, name='$title', filename='$filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner',updatorid = '$userid',  password = '$newpassword', expires = '$expires',name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) .   "'  WHERE id = '$id'");
                 }   
                 else
                 {
                    $oldWD = getcwd();
                    chdir ($default->owl_FileDir . DIR_SEP . find_path($parent));
                    rename($filename, $new_filename);
                    chdir($oldWD);
                    $filename = $new_filename;
                    $sql->query("UPDATE $default->owl_files_table set smodified = $smodified, name='$title', filename='$filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner',updatorid = '$userid',  password = '$newpassword', expires = '$expires',name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) . "'  WHERE id = '$id'");
                 }
                 // END
               } 
               else 
               {
                  printError($owl_lang->err_filemove_exist);
               }
            } // end owl use fs  nothing in yet for DB only.
            else
            {
               $filename = $new_filename;
               $sql->query("UPDATE $default->owl_files_table set smodified = $smodified, name='$title', filename='$filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner' , updatorid = '$userid', password = '$newpassword', expires = '$expires',name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) . "' WHERE id = '$id'");
            }
         } // end fildname change if.
         // End of ianm change.
         else
         {
            if ($type == "url")
            {
               $filename = $new_filename;
            }

            if (empty($major_revision))
            {
               $major_revision = $default->major_revision;
            }
   
            if (empty($minor_revision))
            {
               $minor_revision = $default->minor_revision;
            }

            $sql->query("UPDATE $default->owl_files_table set name='$title', smodified = $smodified, filename='$filename', security='$security', metadata='$metadata', description='$description',groupid='$groupid', creatorid ='$file_owner' ,updatorid = '$userid',  password = '$newpassword', doctype='$doctype',major_revision = '$major_revision', minor_revision = '$minor_revision', expires = '$expires', name_search='" . fReplaceSpecial($title) . "', filename_search='" . fReplaceSpecial($filename) . "', description_search='" . fReplaceSpecial($description) . "', metadata_search='" . fReplaceSpecial($metadata) .   "' WHERE id = '$id'");
            if (fisAdmin())
            {
               $sql->query("UPDATE $default->owl_files_table SET smodified=$smodified, major_revision = '$major_revision', minor_revision = '$minor_revision', updatorid='$userid', expires = '$expires'  WHERE linkedto='$id'");
            }

            if ($saved_doctype == $doctype and $iRealFileID == $id)
            {
               $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$doctype'");
               while ($sql_custom->next_record())
               {
                   switch ($sql_custom->f("field_type"))
                   {
                      case "seperator":
                         break;
                      case "mcheckbox":
                            $aMultipleCheckBox = split("\|",  $sql_custom->f("field_values"));
                             $i = 0;
                             $sFieldValues = "";
                             foreach ($aMultipleCheckBox as $sValues)
                             {
                                $sFieldName = $sql_custom->f("field_name") . "_".$i;
      
                                if ($i > 0)
                                {
                                   $sFieldValues .= "|";
                                }
                                $sFieldValues .= $_POST[$sFieldName];
                                $i++;
                             }
                             $result = $sql->query("UPDATE $default->owl_docfieldvalues_table set field_value = '" . $sFieldValues . "' WHERE file_id = '$id' and field_name = '" . $sql_custom->f("field_name") ."';");
                          break;
                      case "radio":
		       $result = $sql->query("UPDATE $default->owl_docfieldvalues_table set field_value = '" . $_POST[$sql_custom->f("field_name")] . "' WHERE file_id = '$id' and field_name = '" . $sql_custom->f("field_name") ."';");
                          break;
                       default:
                             $result = $sql->query("UPDATE $default->owl_docfieldvalues_table set field_value = '" . $_POST[$sql_custom->f("field_name")] . "' WHERE file_id = '$id' and field_name = '" . $sql_custom->f("field_name") ."';");
                          break;
                  }
               }
            }
            else
            {
               $sql_custom = new Owl_DB;
               $sql_custom_2 = new Owl_DB;
               $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$doctype'");
               if ($sql_custom->num_rows() > 0)
               {
                  $sWhereClause = " AND (";
                  while ($sql_custom->next_record())
                  {
                     $sWhereClause .= "field_name <> '" . $sql_custom->f('field_name') . "' OR ";
                  }
                  $sWhereClause .= " 1=0)";
               }
               else
               {
                  $sWhereClause = "";
               }
               $sql_custom->query("DELETE FROM $default->owl_docfieldvalues_table  WHERE file_id = '$id' $sWhereClause");

               $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$doctype'");
               if ($sql_custom->num_rows() > 0)
               {
                  while($sql_custom->next_record())
                  {
                     $sql_custom_2->query("SELECT id FROM $default->owl_docfieldvalues_table  WHERE file_id = '$id' and field_name = '" . $sql_custom->f('field_name') . "'");
                     if ($sql_custom_2->num_rows() == 0 )
                     {
                        $sql_custom_2->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name) VALUES ( '$id' , '" . $sql_custom->f("field_name") ."');");
                     }
                  }
               }
            }
         }
      } 

      if ($savekeyword == 1 and $default->save_keywords_to_db)
      {
         $newkeywords = preg_split("/\s+/", $metadata);
         $sql = new Owl_DB;
         foreach ($newkeywords as $word)
         {
            $word = trim(strtolower($word));
            if (!empty($word))
            {
               $sql->query("SELECT * FROM $default->owl_keyword_table WHERE keyword_text = '$word' ");
               if ($sql->num_rows() == 0)
               {
                  $sql->query("INSERT INTO $default->owl_keyword_table (keyword_text) values ('$word') ");
               }
            }
         }
      }
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
      if ($default->docRel)
      {
         $sql = new Owl_DB;
            $sql->query("DELETE FROM $default->docRel_table WHERE file_id='$id'");
         foreach ($docRelPick as $word)
         {
            if (!empty($word))
            {
               $sql->query("INSERT INTO $default->docRel_table (file_id, related_file_id) VALUES ('$id', '$word')");
            }
         }
      }
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
      owl_syslog(FILE_CHANGED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE"); 
      // End Bozz Change
      if ($saved_doctype == $doctype)
      {
         displayBrowsePage($parent);
         exit;
      }
      else
      {
         header("Location: " . $default->owl_root_url . "/modify.php?sess=$sess&expand=$expand&action=file_modify&order=$order&sortname=$sortname&id=" . $id . "&parent=" . $parent);
         exit;
      }
   } 
   else
   {
      printError($owl_lang->err_nofilemod);
   } 
} 
// 
// Delete Requested file
// 
if ($action == "file_delete")
{
   delFile($id, "file_delete");
} 

if ($action == "file_del_rejected")
{
      $CheckOlderVersion = new Owl_DB;
      $qSql = new Owl_DB;

      $aFirstpExtension = fFindFileFirstpartExtension(flid_to_name($id));
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

         //print("DEBUG: $sQuery");

         $CheckOlderVersion->query($sQuery);
      }
      $iNumrows = $CheckOlderVersion->num_rows();

      if ($iNumrows > 0)
      {
         $CheckOlderVersion->next_record();
         // delete version
         $sDeletePath = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP .  flid_to_filename($id);
         $sMovePath = $default->owl_FileDir . DIR_SEP . find_path($CheckOlderVersion->f("parent")) . DIR_SEP .  flid_to_filename($CheckOlderVersion->f("id"));

      
         $sQuery = "UPDATE $default->owl_files_table set major_revision = '" . $CheckOlderVersion->f("major_revision") . "', minor_revision = '" . $CheckOlderVersion->f("minor_revision") . "', f_size = '". $CheckOlderVersion->f("f_size") . "', description = '" . addslashes($CheckOlderVersion->f("description")) . "', approved = '1' where id = '$id'";
         $sql->query($sQuery);
         $sQuery = "DELETE FROM $default->owl_files_table where id = '".  $CheckOlderVersion->f("id") ."'";
         $sql->query($sQuery);
         $sql->query("DELETE FROM $default->owl_peerreview_table WHERE file_id = '$id'");

         unlink($sDeletePath);
         rename($sMovePath, $sDeletePath);
      }
} 
// Begin Daphne Change
// the file policy authorisation has been taken from file_modify
// (it's assumed that if you can't modify the file you can't check it out)
if ($action == "file_lock")
{
   if (check_auth($id, "file_lock", $userid) == 1)
   {
      $sql = new Owl_DB; 
      // Begin Bozz Change
      if (owlusergroup($userid) != 0)
      {
         $groupid = owlusergroup($userid);
      } 
      // check that file hasn't been reserved while updates have gone through
      $sql->query("SELECT checked_out FROM $default->owl_files_table WHERE id = '$id'");

      while ($sql->next_record())
      {
         $file_lock = $sql->f("checked_out");
      } 

      if ($file_lock == 0)
      { 
         // reserve the file
         $sql->query("UPDATE $default->owl_files_table set checked_out='$userid' WHERE id='$id'");
         owl_syslog(FILE_LOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE");
      } 
      else
      {
         if ($file_lock == $userid || fIsAdmin())
         { 
            // check the file back in
            $sql->query("UPDATE $default->owl_files_table set checked_out='0' WHERE id='$id'");
            owl_syslog(FILE_UNLOCKED, $userid, flid_to_filename($id), $parent, $owl_lang->log_detail, "FILE");
         } 
         else
         {
            printError("$owl_lang->err_file_lock " . uid_to_name($file_lock) . ".");
         } 
      } 
	  if ($default->take_ownership_on_checkout == 1)
	  {
	     if (isset($takeownership) and $takeownership == 'Yes')
         {
            if (check_auth($id, "file_update", $userid) == 1)
            {
               // NOTIFY THE Owner that his file changed Ownership
               $iFileCreatorID = owlfilecreator($id);
   
               $getuser = new Owl_DB;
   
               $mail = new phpmailer();
               if ($default->use_smtp)
               {
                  $mail->IsSMTP(); // set mailer to use SMTP
                  if ($default->use_smtp_auth)
                  {
                     $mail->SMTPAuth = "true"; // turn on SMTP authentication
                     $mail->Username = "$default->smtp_auth_login "; // SMTP username
                     $mail->Password = "$default->smtp_passwd"; // SMTP password
                  }
               }
   
               $getuser->query("SELECT id, name, email,language,attachfile FROM $default->owl_users_table WHERE id = '$userid'");
               $getuser->next_record();
   
               $sNewOwner =  $getuser->f('name');
   
               $mail->Host = $default->owl_email_server; // specify main and backup server
               $mail->From = $getuser->f('email');
               $mail->FromName = $sNewOwner;
   
               $getuser->query("SELECT id, name, email,language,attachfile FROM $default->owl_users_table WHERE id = '$iFileCreatorID'");
               $getuser->next_record();
               $DefUserLang = $getuser->f("language");
               require("$default->owl_fs_root/locale/$DefUserLang/language.inc");
               $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset
               $mail->AddAddress($getuser->f('email'));
               $mail->WordWrap = 50; // set word wrap to 50 characters
               $mail->IsHTML(true); // set email format to HTML
			   $sSubject = sprintf($owl_lang->ownership_change_subj, fid_to_filename($id), $NewOwner);
               $mail->Subject = $sSubject;
               $mail->Body = "<html><body>$sSubject</body></html>";
               $mail->altBody = $sSubject;
               if (!$mail->Send())
               {
                  if ($default->debug == true)
                  {
                     printError($owl_lang->err_email, $mail->ErrorInfo);
                  }
               }
               $sql->query("UPDATE $default->owl_files_table set creatorid='$userid' WHERE id='$id'");
            }
         }
	  }
      displayBrowsePage($parent);
   } 
   else
   {
      printError("$owl_lang->err_nofilemod");
   } 
} 
// End Daphne Change
if ($action == "del_comment")
{
   if (check_auth($id, "file_comment", $userid) == 1)
   {
      $sql = new Owl_DB;
      $sql->query("DELETE FROM $default->owl_comment_table WHERE id = '$cid'");

      header("Location: " . $default->owl_root_url . "/modify.php?sess=$sess&expand=$expand&action=file_comment&type=url&order=$order&sortname=$sortname&id=" . $id . "&parent=" . $parent);
      exit;
   } 
} 
if ($action == "file_comment")
{
   if (empty($newcomment))
   {
      printError("ERROR: $owl_lang->err_comment_empty");
   }
   if (check_auth($id, "file_comment", $userid) == 1)
   {
      // This is a hack to deal with ' in the comment field
      // on some system the ' is automaticaly changed to \' and that works
      // on other system it stays as ' I have no idea why
      // the 2 lines bellow should take care of any case.
      //$newcomment = ereg_replace("[\\]'", "'", $newcomment);
      $newcomment = stripslashes($newcomment);
      $newcomment = fOwl_ereg_replace("'", "\\'" , $newcomment);
      $newcomment = addslashes($newcomment);

      $sql = new Owl_DB;
      //$dTimeStamp = date("Y-m-d H:i:s"); 
      $dTimeStamp = $sql->now();
      if (empty($cid))
      {
         $sql->query("INSERT INTO $default->owl_comment_table (userid, fid, comment_date, comments)  values ('$userid', '$id', $dTimeStamp, '$newcomment')");
      }
      else
      {
         $sql->query("UPDATE $default->owl_comment_table set comments = '$newcomment', comment_date = $dTimeStamp where id = '$cid' and fid = '$id' and userid = '$userid'");
      }
      notify_file_owner($id, $newcomment);

      header("Location: " . $default->owl_root_url . "/modify.php?sess=$sess&expand=$expand&action=file_comment&type=url&order=$order&sortname=$sortname&id=" . $id . "&parent=" . $parent);
      exit;
   } 
   else
   {
      printError($lang_nofileaccess);
   }

} 

if ($action == "email" and fIsEmailToolAccess($userid))
{
      $mail = new phpmailer();
      $mail->SetLanguage($owl_lang->lang_code, "scripts/phpmailer/language/");

      if ($default->use_smtp)
      {
         $mail->IsSMTP(); // set mailer to use SMTP
         if ($default->use_smtp_auth)
         {
            $mail->SMTPAuth = "true"; // turn on SMTP authentication
            $mail->Username = "$default->smtp_auth_login"; // SMTP username
            $mail->Password = "$default->smtp_passwd"; // SMTP password 
         } 
      } 
      if (isset($default->smtp_port))
      {
         $mail->Port = $default->smtp_port;
      }

      if ($default->use_smtp_ssl)
      {
         $mail->SMTPSecure = "ssl";
      }

      $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset 
      $mail->Host = "$default->owl_email_server"; // specify main and backup server
      $mail->From = "$default->owl_email_from";
      $mail->FromName = "$default->owl_email_fromname";

      if (trim($mailto) != "")
      {
         $r = preg_split("(\;|\,)", $mailto);
         reset ($r);
         while (list ($occ, $email) = each ($r))
         {
            $mail->AddAddress($email);
         }
      } 

      if (is_array($pick_mailto))
      {
         foreach ($pick_mailto as $sEmailAddress)
         {
            $mail->AddAddress($sEmailAddress);
         }
      }
      else
      {
         $mail->AddAddress($pick_mailto);
      }
      if ($replyto == "")
      {
         $mail->AddReplyTo("$default->owl_email_replyto", $owl_lang->email_reply_to_name);
      }
      else
      {
         $mail->AddReplyTo("$replyto");
      }

      if ($ccto != "")
      {
         $mail->AddCC($ccto);
      }

      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $mail->Subject = "$subject";
     
      $email_sig = iconv("UTF8", "ISO-8859-1",  $email_sig);
      //$mailbody = iconv("UTF8", "ISO-8859-1", $mailbody);

      $mail->Body = "<html><body>" .  fCleanDomTTContent($mailbody);
      if ($use_sig == '1')
      {
         $mail->Body .= "<br /><br />" . fCleanDomTTContent($email_sig);
      }     
      $mail->Body .= "</body></html>";
      $mail->altBody = $mailbody;
      if ($use_sig == '1')
      {
         $mail->altBody .= "\n\n$email_sig";
      }     

      if (!$mail->Send())
      {
         printError($owl_lang->err_email, $mail->ErrorInfo);
      } 
} 

if ($action == "file_email")
{
   if (check_auth($id, "file_email", $userid) == 1)
   //if (check_auth($id, "file_download", $userid) == 1)
   {
      $sql = new Owl_DB;
      $path = "";
      $id = fGetPhysicalFileId($id);
      $disppath = find_path(owlfileparent($id));
      $filename = flid_to_filename($id);
      if ($default->owl_use_fs)
      {
         $fID = owlfileparent($id);
         do
         {
            $sql->query("SELECT name,parent FROM $default->owl_folders_table WHERE id='$fID'");
            while ($sql->next_record())
            {
               $tName = $sql->f("name");
               $fID = $sql->f("parent");
            } 
            $path = $tName . DIR_SEP . $path;
         } 
         while ($fID != 0);
      } 
      $sql->query("SELECT name, filename, description FROM $default->owl_files_table WHERE id='$id'");
      $sql->next_record();
      $name = $sql->f("name");
      $desc = $sql->f("description");
      //$desc = ereg_replace("[\\]", "", $desc);
      $desc = stripslashes($desc);
      $filename = $sql->f("filename");

      $mail = new phpmailer();
      $mail->SetLanguage($owl_lang->lang_code, "scripts/phpmailer/language/");

      if ($default->use_smtp)
      {
         $mail->IsSMTP(); // set mailer to use SMTP
         if ($default->use_smtp_auth)
         {
            $mail->SMTPAuth = "true"; // turn on SMTP authentication
            $mail->Username = "$default->smtp_auth_login"; // SMTP username
            $mail->Password = "$default->smtp_passwd"; // SMTP password 
         } 
      } 
      if (isset($default->smtp_port))
      {
         $mail->Port = $default->smtp_port;
      }

      if ($default->use_smtp_ssl)
      {
         $mail->SMTPSecure = "ssl";
      }

      $mail->Host = "$default->owl_email_server"; // specify main and backup server
      $mail->From = "$default->owl_email_from";
      $mail->FromName = "$default->owl_email_fromname";

      if (trim($mailto) != "")
      {
         $r = preg_split("(\;|\,)", $mailto);
         reset ($r);
         while (list ($occ, $email) = each ($r))
         {
            $mail->AddAddress($email);
         }
         $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset 
      } 
      //else
      //{
         if (is_array($pick_mailto))
         {
            foreach ($pick_mailto as $sEmailAddress)
            {
               $getuser = new Owl_DB;
               $getuser->query("SELECT id, email,language,attachfile FROM $default->owl_users_table WHERE email = '$sEmailAddress'");
               $getuser->next_record();
               $DefUserLang = $getuser->f("language");
               require("$default->owl_fs_root/locale/$DefUserLang/language.inc");
               $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset 
               $mail->AddAddress($sEmailAddress);
            }
         }
         else
         {
            $mail->AddAddress($pick_mailto);
         }
      //} 

      if ($replyto == "")
      {
         $mail->AddReplyTo("$default->owl_email_replyto", $owl_lang->email_reply_to_name);
      }
      else
      {
         $mail->AddReplyTo("$replyto");
      }

      if ($ccto != "")
      {
         $mail->AddCC($ccto);
      }

      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $mail->Subject = "$subject -- $owl_lang->file: $name";


      $aBody = fGetMailBodyText(MAIL_FILE,  $id );
      $aBody['HTML'] = fOwl_ereg_replace("\%MESSAGE\%", $mailbody, $aBody['HTML'] );
      $aBody['TXT'] = fOwl_ereg_replace("\%MESSAGE\%", $mailbody, $aBody['TXT'] );


      if ($type != "url")
      {
	     //$mailbody = $aBody['HTML']
         //$mailbody = "<html><body>" . fCleanDomTTContent($mailbody) . "<br /><br />" . "$owl_lang->description: <br /><br />$desc";
         //$mailbody = "<html><body>" . fCleanDomTTContent($mailbody) . "<br /><br />" . "$owl_lang->description: <br /><br />$desc";
	     //$mailbody = iconv("UTF8", "ISO-8859-1", $mailbody);

         $mail->Body = $aBody['HTML'];

	     //$mailbody = iconv("UTF8", "ISO-8859-1", "$mailbody" . "\n\n" . "$owl_lang->description: \n\n $desc");

         $mail->altBody = $aBody['TXT'];

         if ($fileattached == 1)
         {
            $sFsPath = fCreateWaterMark($id);

            if (! $sFsPath == false)
            {
               $sAttachPath = $sFsPath;
            }
            else
            {
               if (!$default->owl_use_fs)
               {
                  $sAttachPath = fGetFileFromDatbase($id);
               } 
               else
               {
                  $sAttachPath = $default->owl_FileDir . DIR_SEP . $path . $filename;
               }
            }

            if (filesize($sAttachPath) > $default->smtp_max_size and $default->smtp_max_size > 0)
            {
               //$link = $default->owl_notify_link . "browse.php?sess=0&parent=" . $parent . "&expand=1&fileid=" . $id ;
	       $mailbody = iconv("UTF8", "ISO-8859-1", "<br />FILE WAS TOO LARGE<a href=" . $link . ">" . $link . "</a><br /><br />");
               $mail->Body .= $mailbody;
	           //$mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename);
               //$mail->Body .= $mailbody;
            }
            else
            {
               $mimeType = fGetMimeType($filename);
               $mail->AddAttachment($sAttachPath, "" , "base64" , "$mimeType");
	           //$mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename);
               //$mail->Body .= $mailbody;
            }
         } 
         else
         {
            //$link = $default->owl_notify_link . "browse.php?sess=0&parent=" . $parent . "&expand=1&fileid=" . $id ;
	        //$mailbody = iconv("UTF8", "ISO-8859-1", "<br /><a href=" . $link . ">" . $link . "</a><br /><br />");
            //$mail->Body .= $mailbody;
	        //$mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename);
            //$mail->Body .= $mailbody;
         } 
      } 
      else
      {
	     //$mailbody = iconv("UTF8", "ISO-8859-1", "<html><body>" . "<a href=" . $filename . ">" . $filename . "</a><br /><br />" . fCleanDomTTContent($mailbody) . "<br /><br />" . "$owl_lang->description: <br /><br />$desc <br /><br />");
         //$mail->Body = $mailbody;

	     //$mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename);
         //$mail->Body .= $mailbody;

	     //$mailbody = iconv("UTF8", "ISO-8859-1", "$filename" . "\n\n" . "$mailbody" . "\n\n" . "$owl_lang->description: \n\n $desc \n\n");
         //$mail->altBody = $mailbody;
	     //$mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename);
         //$mail->altBody .= $mailbody;
      } 

	  $email_sig = iconv("UTF8", "ISO-8859-1",  $email_sig);
      if ($use_sig == '1')
      {
         $mail->Body .= "<br /><br />" . fCleanDomTTContent($email_sig);
         $mail->altBody .= "\n\n$email_sig";
      }

      //$mail->Body .= "</body></html>";

      if (!$mail->Send())
      {
         printError($owl_lang->err_email, $mail->ErrorInfo);
      } 
      if ($fileattached == 1)
      {
         owl_syslog(FILE_EMAILED, $userid, flid_to_filename($id), $parent, "TO: $mailto $pick_mailto and file was attached", "FILE");
      }
      else
      {
         owl_syslog(FILE_EMAILED, $userid, flid_to_filename($id), $parent, "TO: $mailto $pick_mailto", "FILE");
      }
   } 
   else
   {
      printError($lang_nofileaccess);
   } 
} 

if ($action == "file_monitor")
{
   //if (check_auth($id, "file_download", $userid) == 1)
   if (check_auth($id, "file_monitor", $userid) == 1)
   {
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_monitored_file_table WHERE fid = '$id' and userid = '$userid'");

      if ($sql->num_rows($sql) == 0)
      {
         $sql->query("INSERT INTO $default->owl_monitored_file_table (userid, fid)  values ('$userid', '$id')");
      } 
      else
      {
         $sql->query("DELETE FROM $default->owl_monitored_file_table WHERE fid = '$id' and userid = '$userid'");
      } 
   } 
} 

if ($action == "folder_monitor")
{
   //if (check_auth($id, "folder_view", $userid) == 1)
   if (check_auth($id, "folder_monitor", $userid) == 1)
   {
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_monitored_folder_table WHERE fid = '$id' and userid = '$userid'");

      if ($sql->num_rows($sql) == 0)
      {
         $sql->query("INSERT INTO $default->owl_monitored_folder_table (userid, fid)  values ('$userid', '$id')");
      } 
      else
      {
         $sql->query("DELETE FROM $default->owl_monitored_folder_table WHERE fid = '$id' and userid = '$userid'");
      } 
   } 
} 

if ($action == "folder_create")
{
   $rss_feed = fIntializeCheckBox($rss_feed);
   if (check_auth($parent, "folder_create", $userid) == 1)
   {
      if ($default->display_password_override == 1)
      {
         if ($newpassword <> $confpassword)
         {
            printError($owl_lang->err_pass_missmatch);
         }
         else
         {
            if (!empty($newpassword))
            {
               $newpassword = md5($newpassword);
            }
         }
      }
      else
      {
         $newpassword = "";
      }

      if ($default->folder_desc_req == "1" and trim($description) == "")
      {
         printError("$owl_lang->err_doc_field_req ", "Descrtiption");
      }

      $sql = new Owl_DB; 
      $smodified = $sql->now();
      if (empty($groupid) and fIsAdmin())
      {
      	$groupid = "0";
      }
      // This is a hack to deal with ' in the description field
      // on some system the ' is automaticaly changed to \' and that works
      // on other system it stays as ' I have no idea why
      // the 2 lines bellow should take care of any case.
      //$description = ereg_replace("[\\]'", "'", $description);
      $description = stripslashes($description);
      //$description = fOwl_ereg_replace("'", "\\'" , $description); 
      $description = addslashes($description); 
      // we have to be careful with the name just like with the files
      // Comment this one out TRACKER : 603887, this was not done for renaming a folder
      // So lets see if it causes problems while creating folders.
      // Seems it causes a problem, so I put it back.
      $name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $name)));
      
      $sql->query("SELECT * FROM $default->owl_folders_table WHERE name = '" . $sql->make_arg_safe($name) . "' and parent = '$parent'");
      if ($sql->num_rows() > 0)
      {
         printError("$owl_lang->err_folder_exist");
      }

      if ($name == '')
         printError($owl_lang->err_nameempty);

      if ($default->owl_use_fs)
      {
         if (strtolower($name) == $default->version_control_backup_dir_name)
         {
            printError($owl_lang->err_specialfoldername);
         }

         $path = find_path($parent);

         if (file_exists("$default->owl_FileDir/$path/$name"))
         {
            printError($owl_lang->err_folder_exist);
         }

         mkdir($default->owl_FileDir . DIR_SEP . $path . DIR_SEP . $name, $default->directory_mask);

         if (!is_dir("$default->owl_FileDir/$path/$name"))
         {
            if ($default->debug == true)
            {
               printError("DEBUG:" . $owl_lang->err_folder_create, "$default->owl_FileDir/$path/$name");
            }
            else
            {
               printError($owl_lang->err_folder_create);
            }
         } 
      } 

      $bIsWithinSpecialAccess = false;
      fCheckWithinSpecialAccess($parent);
      if ($bIsWithinSpecialAccess)
      {
         $iCreatorID = $default->special_folder_defaults[$parent]['creatorid'];
         $iGroupID = $default->special_folder_defaults[$parent]['groupid'];
         $iSecurity = 50 + $default->special_folder_defaults[$parent]['security'];
         if (empty($description) or strlen(trim($description)) == 0)
         {
            $sDescription = $default->special_folder_defaults[$parent]['description'];
         }
         else
         {
            $sDescription = $description;
         }
      }
      else
      {
         $iCreatorID = $userid;
         $iGroupID = $groupid;
         $iSecurity = $policy;
         $sDescription = $description;
      }

      $sql->query("INSERT INTO $default->owl_folders_table (name,parent,security,description,groupid,creatorid, password, smodified, linkedto, rss_feed) values ('" . $sql->make_arg_safe($name) . "', '$parent', '$iSecurity', '$sDescription', '$iGroupID', '$iCreatorID', '$newpassword', $smodified , '0', '$rss_feed')");

      $iOldParent = $parent;
      $parent = $sql->insert_id($default->owl_folders_table, 'id');
      owl_syslog(FOLDER_CREATED, $userid, $name, $parent, $owl_lang->log_detail, "FILE");
      //$qAclInsert = new Owl_DB; 

      fSetDefaultFolderAcl($parent);
      fSetInheritedAcl($iOldParent, $parent, "FOLDER");

      if ($set_acl == 1)
      {
         header("Location: " . $default->owl_root_url . "/setacl.php?sess=$sess&expand=$expand&action=folder_acl&order=$order&sortname=$sortname&edit=1&id=" . $parent . "&parent=" . $iOldParent);
         exit;
      }
      else
      {
         displayBrowsePage($parent);
      }
   } 
   else
   {
      printError($owl_lang->err_nosubfolder);
   } 
} 
if ($action == "folder_distribute")
{
   if (check_auth($id, "folder_create", $userid) == 1)
   {
      $SFolderName = fid_to_name($id);
      $sRssName = $SFolderName . ".xml";

      $path = fOwl_ereg_replace(" ", "%20", find_path($id));

      // START A NEW FILE EVERYTINE
      copy($default->RSS_TxtFilePath . "/owlrss.base", $default->RSS_TxtFilePath . DIR_SEP . $sRssName );

      $qGetFiles  = "SELECT * FROM $default->owl_files_table where parent = '$id'";

      $sql = new Owl_DB;
      $sql->query($qGetFiles);

      while ($sql->next_record())
      {
         $sFileName = fid_to_filename($sql->f("id"));
         $sTorrentFileName = fid_to_filename($sql->f("id")) . ".torrent";
         $handle = @fopen($default->RSS_TxtFilePath . "/owlrss.item", "r");

         if ($handle)
         {
            // CREATE the Items

            while (!feof($handle))
            {
               $buffer = fgets($handle, 4096);

               $buffer = fOwl_ereg_replace("\%TORRENTFILE\%", $sTorrentFileName, $buffer);
               $buffer = fOwl_ereg_replace("\%DESCRIPTION\%", html_entity_decode($sql->f("description"),ENT_QUOTES,$default->charset), $buffer);
               $buffer = fOwl_ereg_replace("\%TITLE\%", $sql->f("name"), $buffer);
               $buffer = fOwl_ereg_replace("\%PUBDATE\%", date("r"), $buffer);
               $sRSSFile .= $buffer;
            }
            fclose($handle);
         }

         // Write the itme to the Distribution RSS FILE

         //if (!file_exists($default->RSS_TxtFilePath . DIR_SEP . $sRssName ))
         //{
         //}

         $handle = @fopen($default->RSS_TxtFilePath . DIR_SEP . $sRssName, "r");
         if ($handle)
         {
            while (!feof($handle))
            {
                $buffer = fgets($handle, 4096);
                $sRSSOrigFile .= $buffer;
            }
         }

         $sRSSOrigFile = fOwl_ereg_replace("</channel>", $sRSSFile . "</channel>", $sRSSOrigFile);

         $fp = fopen($default->RSS_TxtFilePath . DIR_SEP . $sRssName , "wb");
         fwrite($fp, $sRSSOrigFile);
         fclose($fp);

         // CLEANUP VARS BEFORE THE NEXT FILE
         $sRSSOrigFile = "";
         $sRSSFile = "";

         $sFilePath = find_path($sql->f("parent"));
         // UNCOMENT $sTorrentFileName = ereg_replace(" ", "%20", $sTorrentFileName);

         // UNCOMMENT $aMakeTorrent = exec("/usr/bin/maketorrent-console http://www.torrenttyger.com:7000/announce \"" . $default->owl_FileDir . DIR_SEP . $sFilePath . DIR_SEP . $sFileName . "\" --target \"/home/bozz/RSSTorrent/" . $sFileName . ".torrent\" 2>&1 > /dev/null &");

         //$sFilePath = ereg_replace(" ", "%20", find_path($sql->f("parent")));

         //$aSeedTorrent = system("(cd /tmp; /usr/bin/bittorrent-console http://www.bozzit.com/RSSTorrent/" . $sTorrentFileName . " --save_as \"" . $default->owl_FileDir . DIR_SEP . $sFilePath . DIR_SEP . $new_name . "\" 2>&1) > /dev/null &");
         // UNCOMMENT $aSeedTorrent = system("(cd /tmp; /usr/bin/bittorrent-console http://www.torrentbozzit.com/RSSTorrent/" . $sTorrentFileName . " --save_as \"" . $default->owl_FileDir . DIR_SEP . $sFilePath . DIR_SEP . $sFileName . "\" 2>&1) > /dev/null &");
     }


      owl_syslog(FOLDER_DISTRIBUTE, $userid, fid_to_name($id), $parent, "", "FILE");
      displayBrowsePage($parent);
   }
   else
   {
      printError($owl_lang->err_nofoldermod);
   }
}

if ($action == "folder_modify")
{
   if (check_auth($id, "folder_property", $userid) == 1)
   {
      $rss_feed = fIntializeCheckBox($rss_feed);
      if ($default->folder_desc_req == "1" and trim($description) == "")
      {
         printError("$owl_lang->err_doc_field_req ", "Description");
      }

      $sql = new Owl_DB;
      $smodified = $sql->now();

      if (empty($groupid) and fIsAdmin())
      {
      	$groupid = "0";
      }

      if ($default->display_password_override == 1)
      {
         if ($newpassword <> $confpassword)
         {
            printError($owl_lang->err_pass_missmatch);
         }
         else
         {
            if (!empty($newpassword))
            {
               $newpassword = md5($newpassword);
            }
         }
      }
      else
      {
         $newpassword = "";
      }

      $origname = fid_to_name($id); 
      // This is a hack to deal with ' in the description field
      // on some system the ' is automaticaly changed to \' and that works
      // on other system it stays as ' I have no idea why
      // the 2 lines bellow should take care of any case.
      //$description = ereg_replace("[\\]'", "'", $description);

      $description = stripslashes($description);
      //$description = fOwl_ereg_replace("'", "\\'" , $description);
      $description = addslashes($description);

      $sql->query("SELECT parent FROM $default->owl_folders_table WHERE id = '$id'");
      while ($sql->next_record()) 
      {
         if ( $sql->f("parent") > 0 )
         {
            $parent = $sql->f("parent");
            $path = $default->owl_FileDir . DIR_SEP . find_path($parent) . DIR_SEP;
         }
         else
         {
            $parent = 1;
            $path = $default->owl_FileDir . DIR_SEP ;
         }
      }
        
      $source = $path . $origname;
      $name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $name)));

      $dest = $path . $name;

      if ($default->owl_use_fs)
      {
         if (!file_exists($path . $name) == 1 || $source == $dest)
         {
            if (substr(php_uname(), 0, 7) != "Windows")
            {
               if ($source != $dest)
               {
                  $cmd = "mv \"$path$origname\" \"$path$name\" 2>&1";
                  $lines = array();
                  $errco = 0;
                  $result = myExec($cmd, $lines, $errco);
                  if ($errco != 0)
                  {
                     printError($owl_lang->err_movecancel, $result);
                  }
               } 
            } 
            else
            { 
               // IF Windows just do a rename and hope for the best
               if ($source != $dest)
               {
                  rename ("$path$origname", "$path$name");
               } 
            } 
         } 
         else
         {
            printError($owl_lang->err_folderexists);
         }
      } 
      else
      {
         if ($source != $dest)
         {
            $sql->query("SELECT * FROM $default->owl_folders_table WHERE parent = '$parent' and name = '$name'");
            if ($sql->num_rows($sql) != 0)
            {
               printError($owl_lang->err_folderexists);
            }
         } 
      } 
      /**
       * BEGIN Bozz Change
       * If your not part of the Administartor Group
       * the Folder will have your group ID assigned to it
       */
      //if (owlusergroup($userid) == 0 || owlusergroup($userid) == $default->file_admin_group || $userid == owlfoldercreator($id))
      if (fIsAdmin() || $userid == owlfoldercreator($id))
      {
         $sql->query("UPDATE $default->owl_folders_table set smodified =$smodified, name='$name', security='$policy', creatorid ='$folder_owner', description='$description' , groupid='$groupid', password = '$newpassword', rss_feed='$rss_feed'  WHERE id = '$id'");
      } 
      else
      {
         $sql->query("UPDATE $default->owl_folders_table set smodified =$smodified, name='$name', security='$policy', description='$description' , password = '$newpassword', rss_feed='$rss_feed' WHERE id = '$id'");
      } 

      // Changes by ianm -- allowing permissions to propagate
      if ($propagate)
      {
         change_ownership_perms($name, $id, $parent, $folder_owner, $groupid, $policy, $prop_file_sec);
      }
      // End changes by ianm

      owl_syslog(FOLDER_MODIFIED, $userid, $name, $parent, $owl_lang->log_detail, "FILE"); 
      // Bozz change End
      displayBrowsePage($parent);
   } 
   else
   {
      printError($owl_lang->err_nofoldermod);
   } 
} 

if ($action == "folder_delete")
{
   if ($id == 1) // Document Folder
   {
      printError("$owl_lang->err_root_delete");
   } 

   if (check_auth($id, "folder_delete", $userid) == 1)
   {
      $sql = new Owl_DB;
      $sql->query("SELECT linkedto FROM $default->owl_folders_table where id = '$id'");
      $sql->next_record();
      $iLinkedto = $sql->f('linkedto');
      $sql->query("SELECT id,name,parent FROM $default->owl_folders_table order by name");
      $fCount = ($sql->nf());
      $i = 0;
      while ($sql->next_record())
      {
         $folderList[$i][0] = $sql->f("id");
         $folderList[$i][2] = $sql->f("parent");
         $i++;
      }

      if ($default->owl_use_fs and $iLinkedto == 0 )
      {
         // This is WHERE we move the file to
         // the trash can
         if ($default->collect_trash == 1)
         {
            $path = find_path($id);
            $sTrashDir = explode(DIR_SEP, $path);
            $sCreatePath = $default->trash_can_location . DIR_SEP . $default->owl_current_db;
            if (!file_exists($sCreatePath))
            {
               mkdir("$sCreatePath", $default->directory_mask);
            }
            foreach($sTrashDir as $sDir)
            {
               $sDestPath = $sCreatePath;
               $sCreatePath .= DIR_SEP . $sDir;
               if (!file_exists($sCreatePath))
               {
                  mkdir("$sCreatePath", $default->directory_mask);
               } 
            } 
            if (substr(php_uname(), 0, 7) != "Windows")
            {
               $cmd = "cp -r " . '"' . $default->owl_FileDir . DIR_SEP . $path . '" "' . $sDestPath . '" 2>&1';
               $lines = array();
               $errco = 0;
               $result = myExec($cmd, $lines, $errco);
               if ($errco != 0)
               {
                  printError($owl_lang->err_general, $result);
               }
            } 
            else
            {
               fWindowsMoveFolders($default->owl_FileDir . DIR_SEP . $path, $default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $path);
            } 
         } 

         myDelete($default->owl_FileDir . DIR_SEP . find_path($id));
      } 

      $log_name = fid_to_name($id);
      delTree($id);
      owl_syslog(FOLDER_DELETED, $userid, $log_name, $parent, $owl_lang->log_del_det, "FILE");
      sleep(.5);
      displayBrowsePage($parent);
   } 
   else
   {
      printError($owl_lang->err_nofolderdelete);
   } 
} 

if ($action == $owl_lang->email_selected)
{
   $bIsAnyFiles = false;
   if (isset($_POST['batch']))
   {
      foreach($_POST['batch'] as $fid)
      {
         if (check_auth($fid, "file_email", $userid) == 1)
         {
            $bIsAnyFiles = true;
         } 
      } 
   } 

   $fa = urlencode(serialize($_POST['batch']));

   if ($bIsAnyFiles)
   {
      header("Location: " . $default->owl_root_url . "/modify.php?sess=$sess&expand=$expand&action=bulk_email&type=url&order=$order&sortname=$sortname&id=" . $fa . "&parent=" . $parent);
      exit();
   } 
   else
   {
      printError($owl_lang->err_no_access, $owl_lang->err_no_access_info);
   } 
} 
//***************************************************************
//  Bulk Download files and Folders
//***************************************************************
 
if ($action == "bulk_download")
{
   $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
   if (file_exists($tmpDir))
   {
      myDelete($tmpDir);
   }
   mkdir($tmpDir, $default->directory_mask);

   $bIsAnyFiles = false;
   if (isset($_POST['batch']))
   {
      foreach($_POST['batch'] as $fid)
      {
         $oldid = $fid;
         $fid = fGetPhysicalFileId($fid);

         if (check_auth($fid, "file_download", $userid) == 1)
         {
            $path = fCreateWaterMark($fid);

            if (! $path == false)
            {
               $fspath = $path;
// Currently these files are ommited if Watermark is turned on
// as the path to those files are very different from the 
// files that are in the Documents directory.
// Will have to fix that
               $pdffilelist[] = $fspath;
            }
            else
            {
               $fspath = $default->owl_FileDir . DIR_SEP . get_dirpath(owlfileparent($fid)) . DIR_SEP .  flid_to_filename($fid);
               if ($oldid == $fid)
               {
                  $filelist[] = $fspath;
               }
               else
               {
                  $aLinkedFileList[$fid] = array($fspath => $oldid);
               }
            }
            
         }
      }
   }

   if (isset($_POST['fbatch']))
   {
      foreach($_POST['fbatch'] as $ffid)
      {
// files here are not watermarked either.
// This could be a problem
         fGetBulkDownloadFiles($ffid);
      }
   }

//print("<pre>ABC");
//print_r($filelist);
//print_r($aLinkedFileList);
//print_r($pdffilelist);
//print("</pre>");

   if (count($filelist) > 0 or count($aLinkedFileList) > 0 or count($pdffilelist) > 0)
   {

      if ($default->use_zip_for_folder_download)
      {
         $sSourceFolderName = find_path($parent);

         if (file_exists($tmpDir . DIR_SEP . fid_to_name($parent) . ".zip"))
         {
            unlink($tmpDir . DIR_SEP . fid_to_name($parent) . ".zip");
         }
         $archive = new PclZip($tmpDir . DIR_SEP . fid_to_name($parent) . ".zip");
         $v_list = $archive->create($filelist, PCLZIP_OPT_REMOVE_PATH, $default->owl_FileDir . DIR_SEP . $sSourceFolderName);
         if (count($pdffilelist) > 0)
         {
            $v_pdflist = $archive->add($pdffilelist, PCLZIP_OPT_REMOVE_PATH, $tmpDir);
         }
         if (count($aLinkedFileList) > 0)
         {
            foreach($aLinkedFileList as $iFileid => $sFileInfo)
            {
               foreach($sFileInfo as $sPath => $iOldid)
               { 
                  $sRemovePath = $default->owl_FileDir . DIR_SEP . get_dirpath(owlfileparent($iFileid));
                  $v_linkedFilelist = $archive->add($sPath, PCLZIP_OPT_REMOVE_PATH, $sRemovePath);
               }
            }
         }

         if ($default->debug == true)
         {
            if ($v_list == 0 and $v_linkedFilelist == 0 and $v_pdflist == 0) 
            {
               printError("DEBUG: " . $archive->errorInfo(true));
            }
         } 
      }
      else
      {
         if (file_exists($default->tar_path))
         {
            if (file_exists($default->gzip_path))
            {
               $sTarAchiveName = $tmpDir . DIR_SEP . fid_to_name(1) . ".tar";
               foreach($filelist as $file)
               { 

                  system(escapeshellarg($default->tar_path) . " -rf " . escapeshellarg($sTarAchiveName) . " -C " . escapeshellarg($default->owl_FileDir) . "  " .  escapeshellarg(substr_replace($file, '', 0, strlen($default->owl_FileDir) + 1)));
                  owl_syslog(FILE_DOWNLOADED, $userid, $file, $parent, "", "FILE");
               }
               system(escapeshellarg($default->gzip_path) . ' "' . $sTarAchiveName . '"');
            }
            else
            {
                  printError("$owl_lang->err_gzip_not_found $default->gzip_path");
            }
         }
         else
         {
            myDelete($tmpdir);
            printError("$owl_lang->err_tar_not_found $default->tar_path");
         } 
      } 

      $clean = ob_get_contents();
      ob_end_clean();
      header ("Location: download.php?sess=$sess&action=bulk_download&parent=$parent");
      print(" ");
      exit;
   }
   else
   {
      printError($owl_lang->err_no_access, $owl_lang->err_no_access_info);
   }
}


if ($action == $owl_lang->move_selected)
{
   $bIsAnyFiles = false;
   $aFileBatch = array();
   $aFolderBatch = array();

   if (isset($_POST['batch']))
   {
      foreach($_POST['batch'] as $fid)
      {
         if (check_auth($fid, "file_move", $userid) == 1)
         {
            $aFileBatch[] = $fid;
            $bIsAnyFiles = true;
         } 
      } 
   } 

   if (isset($_POST['fbatch']))
   {
      foreach($_POST['fbatch'] as $fid)
      {
         if (check_auth($fid, "folder_move", $userid) == 1)
         {
            $bIsAnyFiles = true;
            $aFolderBatch[] = $fid;
         } 
      } 
   } 

   $fa = "";
   $ffa = "";
   if (!empty($aFileBatch))
   {
      $fa = "&id=" . urlencode(serialize($aFileBatch));
   }
   if (!empty($aFolderBatch))
   {
      $ffa = "&folders=" . urlencode(serialize($aFolderBatch));
   }

  
   if ($bIsAnyFiles)
   {
      header("Location: " . $default->owl_root_url . "/move.php?sess=$sess&db=" . $default->owl_current_db . "&expand=$expand&action=bulk_move&type=url&order=$order&sortname=$sortname". $fa . $ffa . "&parent=" . $parent);
      exit();
   } 
   else
   {
      printError($owl_lang->err_no_access, $owl_lang->err_no_access_info);
   } 
} 
// 
// Batch Delete Selected files
// 
if ($action == "bulk_checkout")
{
   $bIsAnyFiles = false;
   if (isset($_POST['batch']))
   {
      foreach($_POST['batch'] as $fid)
      {
         if (check_auth($fid, "file_lock", $userid) == 1)
         {
            $sql->query("SELECT checked_out FROM $default->owl_files_table WHERE id = '$fid'");
                                                                                                                                                                                            
            while ($sql->next_record())
            {
               $file_lock = $sql->f("checked_out");
            }
                                                                                                                                                                                            
            if ($file_lock == 0)
            {
               // reserve the file
               $sql->query("UPDATE $default->owl_files_table set checked_out='$userid' WHERE id='$fid'");
               owl_syslog(FILE_LOCKED, $userid, flid_to_filename($fid), $parent, $owl_lang->log_detail, "FILE");
            }
            else
            {
               if ($file_lock == $userid || fIsAdmin())
               {
                  // check the file back in
                  $sql->query("UPDATE $default->owl_files_table set checked_out='0' WHERE id='$fid'");
                  owl_syslog(FILE_UNLOCKED, $userid, flid_to_filename($fid), $parent, $owl_lang->log_detail, "FILE");
               }
            }
            $bIsAnyFiles = true;
         }
      }
   }

   if (!$bIsAnyFiles)
   {
      printError($owl_lang->err_no_access, $owl_lang->err_no_access_info);
   }
}

if ($action == $owl_lang->del_selected)
{
   $bIsAnyFiles = false;
   if (isset($_POST['batch']))
   {
      foreach($_POST['batch'] as $fid)
      {
         if (check_auth($fid, "file_delete", $userid) == 1)
         {
            delFile($fid, "Delete Selected");
            $bIsAnyFiles = true;
         } 
      } 
   } 
   if (!$bIsAnyFiles)
   {
      printError($owl_lang->err_no_access, $owl_lang->err_no_access_info);
   } 
} 
if ($action == "user")
{ 
   // the following should prevent users from changing others passwords.
   if (!isset($notify))
   {
      $notify = 0;
   }
   if (!isset($logintonewrec))
   {
      $logintonewrec = 0;
   }
   if (!isset($comment_notify))
   {
      $comment_notify = 0;
   }
   if (!isset($attachfile))
   {
      $attachfile = 0;
   }

   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_sessions_table WHERE usid = '$id' AND sessid = '$sess'");
   if ($sql->num_rows() <> 1)
   {
      printError($owl_lang->err_unauthorized);
   } 

   if ($newpassword <> '')
   {
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$id' AND password = '" . md5(stripslashes($oldpassword)) . "'");
      if ($sql->num_rows() == 0)
      {
         printError($owl_lang->err_pass_wrong);
      }
      if ($newpassword == $confpassword)
      {
         if (!fbValidPassword($newpassword))
         {
            $sMsg .= $owl_lang->err_pass_restriction_1;
            $sMsg .= $owl_lang->err_pass_restriction_2;
            $sMsg .= $owl_lang->err_pass_restriction_3;
            printError($sMsg);
         }

         if (fbCheckForPasswdReuse($newpassword, $id) == true)
         {
            printError("CANT RE USE PASSWORS");
         }
         $dNow = $sql->now();
         $sql->query("UPDATE $default->owl_users_table SET  passwd_last_changed = $dNow, name='$name',password='" . md5("$newpassword") . "' WHERE id = '$id'");
      }
      else
      {
         printError($owl_lang->err_pass_missmatch);
      }
   } 
   else
   {
      if ($oldpassword <> '')
      {
         printError($owl_lang->err_pass_restriction_1);
      }
   }


   if (trim($email) == "")
   {
      printError($owl_lang->err_email_required);
   } 

   $logintonewrec = fIntializeCheckBox($logintonewrec);
   $user_default_view = fIntializeCheckBox($user_default_view);
   $comment_notify = fIntializeCheckBox($comment_notify);

   $sql->query("UPDATE $default->owl_users_table SET name='$name', buttonstyle='$newbuttons', email='$email', notify='$notify', attachfile='$attachfile', language='$newlanguage', comment_notify = '$comment_notify', logintonewrec='$logintonewrec',user_default_view='$user_default_view', user_major_revision='$user_major_revision', user_minor_revision='$user_minor_revision' WHERE id = '$id'");
   
   $sql->query("SELECT user_id FROM $default->owl_user_prefs WHERE user_id = '$id'");
   if ($sql->num_rows() == 0)
   {
      $sql->query("INSERT INTO $default->owl_user_prefs (user_id, email_sig, user_phone, user_department, user_address, user_note) VALUES ('$id',  '" . $sql->make_arg_safe($email_sig) . "','" . $sql->make_arg_safe($user_phone) . "', '" . $sql->make_arg_safe($user_department) . "', '" . $sql->make_arg_safe($user_address) . "', '" . $sql->make_arg_safe($user_note) . "')");
   }
   else
   { 
      $sql->query("UPDATE $default->owl_user_prefs SET 
         user_phone='" . $sql->make_arg_safe($user_phone) . "',
         user_address='" . $sql->make_arg_safe($user_address) . "',
         user_note='" . $sql->make_arg_safe($user_note) . "',
         user_department='" . $sql->make_arg_safe($user_department) . "',
         email_sig='" . $sql->make_arg_safe($email_sig) . "' WHERE user_id = '$id'");
   }
} 

if ($action == "bulk_email")
{
   $aFileid = array();
   $aFileid = unserialize(stripslashes(stripslashes($id)));

   $sql = new Owl_DB;
   $mail = new phpmailer();
   $mail->SetLanguage($owl_lang->lang_code, "scripts/phpmailer/language/");

   if ($default->use_smtp)
   {
      $mail->IsSMTP(); // set mailer to use SMTP
      if ($default->use_smtp_auth)
      {
         $mail->SMTPAuth = "true"; // turn on SMTP authentication
         $mail->Username = "$default->smtp_auth_login"; // SMTP username
         $mail->Password = "$default->smtp_passwd"; // SMTP password
      } 
   }  
   if (isset($default->smtp_port))
   {
      $mail->Port = $default->smtp_port;
   }

   if ($default->use_smtp_ssl)
   {
      $mail->SMTPSecure = "ssl";
   }

   $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset 
   $mail->Host = "$default->owl_email_server"; // specify main and backup server
   $mail->From = "$default->owl_email_from";
   $mail->FromName = "$default->owl_email_fromname";

   if (trim($mailto) != "")
   {
      $r = preg_split("(\;|\,)", $mailto);
      reset ($r);
      while (list ($occ, $email) = each ($r))
      {
         $mail->AddAddress($email);
      }
      $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset
   }

   if (is_array($pick_mailto))
   {
      foreach ($pick_mailto as $sEmailAddress)
      {
         $getuser = new Owl_DB;
         $getuser->query("SELECT id, email,language,attachfile FROM $default->owl_users_table WHERE email = '$sEmailAddress'");
         $getuser->next_record();
         $DefUserLang = $getuser->f("language");
         require("$default->owl_fs_root/locale/$DefUserLang/language.inc");
         $mail->CharSet = "$owl_lang->charset"; // set the email charset to the language file charset
         $mail->AddAddress($sEmailAddress);
      }
   }
   else
   {
      $mail->AddAddress($pick_mailto);
   }

   if ($replyto == "")
   {
      $mail->AddReplyTo("$default->owl_email_replyto", $owl_lang->email_reply_to_name);
   }
   else
   {
      $mail->AddReplyTo("$replyto");
   }

   if ($ccto != "")
   {
      $mail->AddCC("$ccto");
   }

   $mail->WordWrap = 50; // set word wrap to 50 characters
   $mail->IsHTML(true); // set email format to HTML
   $mail->Subject = "$default->owl_email_subject -- $subject -- ";
   $mailbody = iconv("UTF8", "ISO-8859-1", "<html><body>" . "$mailbody" . "<br /><br />");
   $mail->Body = $mailbody;

   foreach($aFileid as $fileid)
   {
      $sql->query("select name, parent FROM $default->owl_files_table WHERE id='$fileid'");
      $sql->next_record();
      $name = $sql->f("name");
      $parent = $sql->f("parent");

      if (check_auth($fileid, "file_email", $userid) == 1)
      {
         $path = "";
         $disppath = find_path($parent);
         $filename = flid_to_filename($fileid);
         $sql->query("SELECT url FROM $default->owl_files_table WHERE id='$fileid'");
         $sql->next_record();
         if ($sql->f("url") == 1)
         {
            $type = "url";
         } 
         else
         {
            $type = "";
         } 

         if ($default->owl_use_fs)
         {
            $fID = $parent;
            do
            {
               $sql->query("SELECT name,parent FROM $default->owl_folders_table WHERE id='$fID'");
               while ($sql->next_record())
               {
                  $tName = $sql->f("name");
                  $fID = $sql->f("parent");
               } 
               $path = $tName . DIR_SEP . $path;
            } 
            while ($fID != 0);
         } 
         $sql->query("SELECT name, filename, description FROM $default->owl_files_table WHERE id='$fileid'");
         $sql->next_record();
         $name = $sql->f("name");
         $desc = $sql->f("description");
         //$desc = ereg_replace("[\\]", "", $desc);
         $desc = stripslashes($desc);
         $filename = $sql->f("filename");

         if ($type != "url")
         {
            $mailbody = iconv("UTF8", "ISO-8859-1", "$owl_lang->description: <br />$desc<br /><br />");
            $mail->Body .= $mailbody;
            $mailbody = iconv("UTF8", "ISO-8859-1", "$owl_lang->description: \n $desc \n\n"); 
	    $mail->altBody .= $mailbody;

            // BEGIN wes change
            if ($fileattached == 1)
            {
                  $sFsPath = fCreateWaterMark($fileid);

                  if (! $sFsPath == false)
                  {
                     $sAttachPath = $sFsPath;
                  }
                  else
                  {
                     if (!$default->owl_use_fs)
                     {
                        $sAttachPath = fGetFileFromDatbase($fileid);
                     }
                     else
                     {
                        $sAttachPath = "$default->owl_FileDir/$path$filename";
                     }
                  }

                  if (filesize($sAttachPath) > $default->smtp_max_size and $default->smtp_max_size > 0)
                  {
                     $link = $default->owl_notify_link . "browse.php?sess=0&parent=" . $parent . "&expand=1&fileid=" . $fileid ;
                     $mailbody = iconv("UTF8", "ISO-8859-1", "FILE WAS TOO LARGE: <a href=" . $link . ">" . $filename . "</a><br /><br />");
                     $mail->Body .= $mailbody;
                     $mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename . "<br /><br />");
                     $mail->Body .= $mailbody;

                  }
                  else
                  {
                     $mimeType = fGetMimeType($filename);
                     $mail->AddAttachment($sAttachPath, "" , "base64" , "$mimeType"); 
                     $mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename . "<br /><br />");
                     $mail->Body .= $mailbody;
                  }
            } 
            else
            {
               $link = $default->owl_notify_link . "browse.php?sess=0&parent=" . $parent . "&expand=1&fileid=" . $fileid ;
               $mailbody = iconv("UTF8", "ISO-8859-1", "<a href=" . $link . ">" . $filename . "</a><br /><br />");
               $mail->Body .= $mailbody;
               $mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $disppath . DIR_SEP . $filename . "<br /><br />");
               $mail->Body .= $mailbody;
            } 
         } 
         else
         {
            $mailbody = iconv("UTF8", "ISO-8859-1", "<a href=" . $filename . ">" . $filename . ": </a><br /><br />" . "$mailbody" . "<br /><br />" . "$owl_lang->description: <br /><br />$desc<br /><br />");
            $mail->Body .= $mailbody;

            $mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $path . DIR_SEP . $filename . "<br /><br />");
            $mail->Body .= $mailbody;
            $mailbody = iconv("UTF8", "ISO-8859-1", "$filename" . "\n\n" . "$mailbody" . "\n\n" . "$owl_lang->description: \n\n $desc\n\n");
            $mail->altBody .= $mailbody;
            $mailbody = iconv("UTF8", "ISO-8859-1", $owl_lang->owl_path . $path . DIR_SEP . $filename . "\n\n");
            $mail->altBody .= $mailbody;
         } 
      } 
   }    

   $email_sig = iconv("UTF8", "ISO-8859-1",  $email_sig);

   if ($use_sig == '1')
   {
      $mail->Body .= "<br /><br />" . fCleanDomTTContent($email_sig);
      $mail->altBody .= "\n\n$email_sig";
   }

   $mail->Body .= "</body></html>";

   if (!$mail->Send())
   {
      if ($default->debug == true)
      {
         printError("DEBUG: $owl_lang->err_email", $mail->ErrorInfo);
      } 
   } 

   foreach($aFileid as $fileid)
   {
      if ($fileattached == 1)
      {
         owl_syslog(FILE_EMAILED, $userid, flid_to_filename($fileid), $parent, "TO: $mailto and file was attached", "FILE");
      }
      else
      {
         owl_syslog(FILE_EMAILED, $userid, flid_to_filename($fileid), $parent, "TO: $mailto", "FILE");
      }

      if (!$default->owl_use_fs)
      {
         $path = "";
         $filename = flid_to_filename($fileid);
         $sql->query("SELECT url FROM $default->owl_files_table WHERE id='$fileid'");
         $sql->next_record();
         if ($sql->f("url") == 1)
         {
            $type = "url";
         } 
         else
         {
            $type = "";
         } 

         if ($default->owl_use_fs)
         {
            $fID = $parent;
            do
            {
               $sql->query("SELECT name,parent FROM $default->owl_folders_table WHERE id='$fID'");
               while ($sql->next_record())
               {
                  $tName = $sql->f("name");
                  $fID = $sql->f("parent");
               } 
               $path = $tName . DIR_SEP . $path;
            } 
            while ($fID != 0);
         } 

         if (file_exists("$default->owl_FileDir/$path$filename"))
         {
            unlink("$default->owl_FileDir/$path$filename");
         } 
      } 
   } 
} 

displayBrowsePage($parent);
?>
