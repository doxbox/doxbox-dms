<?php
/**
 * readhd.php
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

define( 'creatorid', '0');
define( 'ownergroup', '1');
define( 'description', '2');
define( 'metadata', '3');
define( 'title', '4');
define( 'security', '5');
define( 'userid', '6');
define( 'groupid', '7');
define( 'owlread', '8');
define( 'owlviewlog', '9');
define( 'owldelete', '10');
define( 'owlcopy', '11');
define( 'owlmove', '12');
define( 'owlproperties', '13');
define( 'owlupdate', '14');
define( 'owlcomment', '15');
define( 'owlcheckin', '16');
define( 'owlemail', '17');
define( 'owlrelsearch', '18');
define( 'owlsetacl', '19');
define( 'owlmonitor', '20');

function GetFromHD($GetWhat, $ThePath) 
{
   global $default;

   if(!file_exists($ThePath)) 
   {
      return "NOTEXIST";
   }
   if ($Dir = opendir($ThePath)) 
   {
      $FileCount = 0;
      $DirCount = 0;
      while(false !== ($file = readdir($Dir))) 
      {
         if ($file[0] == '.')
         {
            continue;
         }
   
         $PathFile = $ThePath . DIR_SEP . $file; //must test with full path (is_file etc)
      
         if(($file <> ".") and ($file <> "..")) 
         {
            if (!is_file($PathFile)) 
            {  //check if it is a folder (dir) or file (dont check if it is a link)

               $bOmitFile = false;
               if(isset($default->lookHD_ommit_directory)) 
               {
                  foreach ($default->lookHD_ommit_directory as $omit) 
                  {
                     if ($file == $omit) 
                     {
                        $bOmitFile = true;
                     }
                  }
               }

               if(!$bOmitFile) 
               {
                  $DirCount++;
                  $Dirs[$DirCount] = $file;
               }
            }
            else
            {
               $bOmitFile = false;
               if(isset($default->lookHD_ommit_ext)) 
               {
                  //$filesearch = explode('.',$file);
                  //$extensioncounter=0;
                  //while ($filesearch[$extensioncounter+1] != NULL) 
                  //{
                     //$extensioncounter++;
                  //}
                  //if($extensioncounter == 0) 
                  //{
                     //$file_extension = '';
                  //} 
                  //else 
                  //{
                     //$file_extension = $filesearch[$extensioncounter];
                  //}
                  $file_extension = fFindFileExtension($file);
      
                  foreach ($default->lookHD_ommit_ext as $omit) 
                  {
                     if ($file_extension == $omit) 
                     {
                        $bOmitFile = true;
                     }
                  }
               }
               if(!$bOmitFile) 
               {
                  $FileCount++;
                  $Files[$FileCount] = $file;
               }
            }
         }
      }

      if ($GetWhat == 'file') 
      {
         $FileCount++;
         $Files[$FileCount] = "[END]";  //stop looping @ this
         return $Files;
      }

      if ($GetWhat == 'folder') 
      {
         $DirCount++;
         $Dirs[$DirCount] = "[END]";  //stop looping @ this
         return $Dirs;
      }
   }
}

function GetFileInfo($PathFile) {
  $TheFileSize = filesize($PathFile);  //get filesize
  $TheFileTime = date("Y-m-d H:i:s", filemtime($PathFile));  //get and fix time of last modifikation
  //$TheFileTime2 = date("M d, Y \a\\t h:i a", filemtime($PathFile));  //get and fix time of last modifikation


  $FileInfo[1] = $TheFileSize;
  $FileInfo[2] = $TheFileTime; //s$modified
  //$FileInfo[3] = $TheFileTime2; //modified

  return $FileInfo;
}

function CompareDBnHD($GetWhat, $ThePath, $DBList, $parent, $DBTable) {  //compare files or folders in database with files on harddrive
  global $default, $fCount, $folderList;
//print("<pre>");
//print("<br />GW:" .$GetWhat . "<br />");
//print_r($DBList);

     $RefreshPage = false;  //if filez/Folderz are found the page need to be refreshed in order to see them.
     $somethingwasdeleted = false;

     if ($default->owl_lookAtHD_del == 1) {
//print("<br /> Delete Enabled");

	 $sql = new Owl_DB;
         $sql->query("SELECT id,name,parent from $default->owl_folders_table order by name");
         $fCount = ($sql->nf());
         $i = 0;
         while($sql->next_record()) {
         	$folderList[$i][0] = $sql->f("id");
		$folderList[$i][2] = $sql->f("parent");
		$i++;
	}

	if($GetWhat == "folder") {
     		$somethingwasdeleted = DeleteDBFolderzNotInDB($default->owl_files_table, $parent);
        } else {
		$somethingwasdeleted = DeleteDBFolderzNotInDB($default->owl_folders_table, $parent);
	}
     }
     $F = GetFromHD($GetWhat, $ThePath);

    if ( $F == "NOTEXIST") return true;

   if(is_array($F)) 
   {
      for($HDLoopCount = 1; $F[$HDLoopCount] !== "[END]";$HDLoopCount++) 
      {
         for($DBLoopCount = 1; $DBList[$DBLoopCount] !== "[END]";$DBLoopCount++) 
         {
            if($F[$HDLoopCount] == $DBList[$DBLoopCount]) 
            {
	       unset($F[$HDLoopCount]); //removing file/folder that is in db from list of filez on disc (leaving list of filez on disc but not in db)
	       break;
            }
         }
       } 

//print_r($F);
//exit;
      if(count($F) > 1)
      {
         for($HDLoopCount = 1; $F[$HDLoopCount] !== "[END]";$HDLoopCount++) 
         {
            if(ord($F[$HDLoopCount]) !== 0)  //if not the file/folder name is empty...
            {
               if($GetWhat == "file") 
               {
	          $RefreshPage = true;
                  InsertHDFilezInDB($F[$HDLoopCount], $parent, $ThePath, $DBTable); //call function that inserts the filez-on-disc-but-not-in-db into the db.
               } 
               else
               {
	          $RefreshPage = false;
               }
   
               if($GetWhat == "folder") 
               {
	          $RefreshPage = true;
//print("<br />P: $parent");
//print("<br />PA: $ThePath");
//print("<br />TB: $DBTable<br />");
//print_r($F[$HDLoopCount]);
                  InsertHDFolderzInDB($F[$HDLoopCount], $parent, $ThePath, $DBTable); //call function that inserts the folderz-on-disc-but-not-in-db into the db.
               }
            }
         }
      }
   }

   if($somethingwasdeleted)
   {
      $RefreshPage = $somethingwasdeleted;
   }

  return $RefreshPage;

}

function DeleteDBFolderzNotInDB($table, $parent) {
	global $default;
	$somethingwasdeleted = false;

	$get = new Owl_DB;  //create new db connection
	$del = new Owl_DB;  //create new db connection
	$children = new Owl_DB;  //create new db connection
	$query = "select * from $table ";
	if ($table == $default->owl_files_table) {
		$query .= " where linkedto = '0' and url <> '1' and parent = '$parent' ";
		//$query .= " where url <> 1 ";
		$query .= " order by parent desc ";
	} else {
		$query .= " where linkedto = '0' and parent = '$parent' ";
		$query .= " order by parent desc ";
	}
 	 
	$get->query("$query");
	while($get->next_record()) {
		$newparent = $get->f("parent");
		if ($table == $default->owl_files_table) {
			$dbfolder = $default->owl_FileDir . DIR_SEP . get_dirpath($get->f("parent")) . DIR_SEP . $get->f("filename");
		} else {
			$dbfolder = $default->owl_FileDir . DIR_SEP . get_dirpath($get->f("id"));
		}
	
		if(!file_exists($dbfolder)) {
			$delid = $get->f("id");
			if ($table == $default->owl_files_table) 
                        {
				$del->query("DELETE from $table where id = '$delid'");
		 		// Clean up all monitored files with that id
                     		$del->query("DELETE from $default->owl_monitored_file_table where fid = '$delid'");
                        	// Clean up all comments with this file 
                        	$del->query("DELETE from $default->owl_comment_table where fid = '$delid'");
                                // Clean up all comments with this file
                                $del->query("DELETE from $default->owl_docfieldvalues_table where file_id = '$delid'");
                                // Clean up all linked files
                                $del->query("DELETE from $default->owl_files_table where linkedto = '$delid'");

				fDeleteFileIndexID($delid);
			} 
                        else 
                        {
				delTree($delid);
			}

			$somethingwasdeleted = true;
		}
	}

	return $somethingwasdeleted;
}

function InsertHDFolderzInDB($TheFolder, $parent, $ThePath, $DBTable) 
{
   global $default, $owl_lang ;

   $sql = new Owl_DB;  //create new db connection
   $check = new Owl_DB;  //create new db connection
   $smodified = $sql->now();

   $original_name = $TheFolder;
   $TheFolder = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "",  fOwl_ereg_replace("%20|^-", "_", $TheFolder)));

   $check->query("select name from $DBTable where name='$TheFolder' and parent='$parent'");
 

   while($check->next_record()) 
   {
      if ($check->f("name") == $TheFolder ) 
      {
         $TheFolder .= "-" .date("Ymd-gis");
         if (!rename($ThePath . DIR_SEP . $original_name, $ThePath . DIR_SEP . $TheFolder))
         {
            if ($default->debug == true)
            {
              exit("LOOKATHD: Probably Bad that the rename failed so lets Stop everything before we endup in an endless loop");
            }
         }
      }
   }

   $SQL = "INSERT INTO $DBTable (name,parent,security,groupid,creatorid,description,smodified, linkedto) values ('$TheFolder', '$parent', '$default->owl_def_fold_security', '$default->owl_def_fold_group_owner', '$default->owl_def_fold_owner', '', $smodified , '0')";

   $sql->query($SQL);

   $iOldParent = $sql->insert_id($default->owl_folders_table, 'id');

   owl_syslog(FOLDER_CREATED, $default->owl_def_fold_owner, $TheFolder, $iOldParent, $owl_lang->log_detail . "READ HD FEATURE", "FILE");
   fSetDefaultFolderAcl($iOldParent); 
   fSetInheritedAcl($parent, $iOldParent, "FOLDER");

}


function InsertHDFilezInDB($TheFile, $parent, $ThePath, $DBTable) 
{
   global $default, $owl_lang;
   global $index_file;

   $sql = new Owl_DB;  //create new db connection
   $check = new Owl_DB;  //create new db connection

   $original_name = $TheFile;
   $TheFile = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "",  fOwl_ereg_replace("%20|^-", "_", $TheFile)));
 
   if ($DBTable == "trash")
   {
      $DBTable = $default->owl_files_table;
   }
   else
   {
      $check->query("SELECT * FROM $DBTable WHERE filename='" . $check->make_arg_safe($TheFile) . "' AND parent='$parent'");
      if ($check->num_rows($check) != 0) 
      {
         // if the orignal name and TheFile  are the same then something else added the file to the database, lets skip it
         if ($original_name == $TheFile)
         {
            return; 
         }
         $TheFile .= "-" . date("Ymd-gis");
      }
      rename($ThePath . DIR_SEP . $original_name, $ThePath . DIR_SEP . $TheFile);
   }

   $FileInfo = GetFileInfo($ThePath . DIR_SEP . $TheFile);  //get file size etc. 2=File size, 2=File time (smodified), 3=File time 2 (modified)

   if (empty($FileInfo[1]))
   {
     $iFileSize = "0";
   }
   else
   {
      $iFileSize = $FileInfo[1]; 
   }
   
   if ($default->owl_def_file_title == "")
   {
      $aFirstpExtension = fFindFileFirstpartExtension ($TheFile);
      $firstpart = $aFirstpExtension[0];

      $title_name =  $firstpart;
      $title = fOwl_ereg_replace("_", " ", $title);
      $title_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "",  fOwl_ereg_replace("%20|^-", "_", $title_name)));
   }
   else
   {
      $title_name = $default->owl_def_file_title;
   }

   $sOwlControlFile = $ThePath . DIR_SEP . $TheFile . ".owlctl";
   if (file_exists($sOwlControlFile)) 
   {
      $handle = fopen ($sOwlControlFile,"r");
      while ($data = fgetcsv ($handle, 5000, ",")) 
      {
         if ($data[0]{0} == "#")
         {
            continue;
         }


         // Deal with creators that are typed as strings
         
         if (is_numeric($data[creatorid]))
         {
            $iCreatorID = $data[creatorid];
         }
         else
         {
            $sql->query("SELECT id FROM $default->owl_users_table WHERE username = '" . $data[creatorid] . "'");
            if ($sql->num_rows() == 0)
            {
               $sql->query("SELECT * FROM $default->owl_users_table WHERE name = '" . $data[creatorid] . "'");
               if ($sql->num_rows() == 0)
               {
                  $iCreatorID = $default->owl_def_file_owner;
               }
               else
               {
                  $sql->next_record();
                  $iCreatorID = $sql->f('id');
               }
            }
            else
            {
               $sql->next_record();
               $iCreatorID = $sql->f('id');
               
            }
         }
         // Deal with GROUPS that are typed as strings
         
         if (is_numeric($data[ownergroup]))
         {
            $iGroupOwner = $data[ownergroup];
         }
         else
         {
            $sql->query("SELECT id FROM $default->owl_groups_table WHERE name = '" . $data[ownergroup] . "'");
            if ($sql->num_rows() == 0)
            {
               $iGroupOwner = $default->owl_def_file_group_owner;
            }
            else
            {
               $sql->next_record();
               $iGroupOwner = $sql->f('id');
            }
         }

         $title_name = $data[title];
         $sDescription = $data[description];
         $sMetadata = $data[metadata];
         $iSecurity = $data[security];

      }
      fclose ($handle);
   }
   else
   {
      $iCreatorID = $default->owl_def_file_owner;
      $sDescription = $TheFile;
      $sMetadata = $default->owl_def_file_meta;
      $iSecurity = $default->owl_def_file_security;
      $iGroupOwner = $default->owl_def_file_group_owner;
   }

   $bIsInfected = fVirusCheck($ThePath, $TheFile, true);

   $SQL = "INSERT INTO $DBTable (name,filename,f_size,creatorid, updatorid,parent,created,description,metadata,security,groupid,smodified,approved,linkedto, major_revision,minor_revision, url, doctype, infected, expires, name_search, filename_search, description_search, metadata_search) values ('$title_name', '$TheFile', '$iFileSize', '$iCreatorID',  '$iCreatorID','$parent', '$FileInfo[2]', '$sDescription', '$sMetadata', '$iSecurity', '$iGroupOwner','$FileInfo[2]', '1', '0', '$default->major_revision', '$default->minor_revision', '0', '$default->default_doctype', '$bIsInfected', '0001-01-01 00:00:00', '" . fReplaceSpecial($title_name) . "', '" . fReplaceSpecial($TheFile) . "', '" . fReplaceSpecial($sDescription) . "', '" . fReplaceSpecial($sMetadata) . "' )";

   $sql->query($SQL);

   // index New Files pdf and TXT Files for SEARCH

   $searchid = $sql->insert_id($default->owl_files_table, 'id');

   notify_users($iGroupOwner, 0, $searchid, $TheFile, $title_name, $sDescription);
   notify_monitored_folders ($parent, $TheFile);

   if (file_exists($sOwlControlFile)) 
   {
      $handle = fopen ($sOwlControlFile,"r");
      while ($data = fgetcsv ($handle, 5000, ",")) 
      {
         if ($data[0]{0} == "#")
         {
            continue;
         }
         if(empty($data[groupid]))
         {
            $qSetCustomAclvalues = "NULL,";
         }
         else
         {
            $qSetCustomAclvalues = "'" . $data[groupid] . "',";
         }

         if(empty($data[userid]))
         {
            $qSetCustomAclvalues .= "NULL,'";
         }
         else
         {
            $qSetCustomAclvalues .= "'" . $data[userid] . "','";
         }

         $qSetCustomAclvalues .= $data[owlread] . "','"; 
         $qSetCustomAclvalues .= $data[owlviewlog] . "','"; 
         $qSetCustomAclvalues .= $data[owldelete] . "','"; 
         $qSetCustomAclvalues .= $data[owlcopy] . "','"; 
         $qSetCustomAclvalues .= $data[owlmove] . "','"; 
         $qSetCustomAclvalues .= $data[owlproperties] . "','"; 
         $qSetCustomAclvalues .= $data[owlupdate] . "','"; 
         $qSetCustomAclvalues .= $data[owlcomment] . "','"; 
         $qSetCustomAclvalues .= $data[owlcheckin] . "','"; 
         $qSetCustomAclvalues .= $data[owlemail] . "','"; 
         $qSetCustomAclvalues .= $data[owlrelsearch] . "','"; 
         $qSetCustomAclvalues .= $data[owlsetacl] . "','"; 
         $qSetCustomAclvalues .= $data[owlmonitor] . "')"; 

         $qSetCustomAclFields = "INSERT INTO $default->owl_advanced_acl_table ( file_id, group_id, user_id, owlread, owlviewlog, owldelete, owlcopy, owlmove, owlproperties, owlupdate, owlcomment, owlcheckin, owlemail, owlrelsearch, owlsetacl, owlmonitor) VALUES (";
         if(!empty($qSetCustomAclvalues))
         {
            $qSetCustomAcl = $qSetCustomAclFields  . "'" . $searchid . "', " . $qSetCustomAclvalues;
            $sql->query($qSetCustomAcl);
         }
      }
      fclose ($handle);
      unlink($sOwlControlFile);
   }

   $sql_custom = new Owl_DB;

   $sql_custom->query("SELECT * FROM $default->owl_docfields_table  WHERE doc_type_id = '$default->default_doctype'");
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
                       $sFieldValues .= ",";
                    }
                    $sFieldValues .= ${$sFieldName};
                    $i++;
                 }
                 $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$searchid', '" . $sql_custom->f("field_name") ."', '" . $sFieldValues ."');");
              break;
           default:
                 $result = $sql->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name, field_value) values ('$searchid', '" . $sql_custom->f("field_name") ."', '" . ${$sql_custom->f("field_name")} ."');");
              break;
       }
   }

   owl_syslog(FILE_UPLOAD, $default->owl_def_file_owner, $TheFile, $parent, $owl_lang->log_detail . $owl_lang->log_readhd_feature_add, "FILE", $iFileSize );
  
   fSetDefaultFileAcl($searchid); 
   fSetInheritedAcl($parent, $searchid, "FILE");

   $index_file = "1";
   fIndexAFile($TheFile, $ThePath . DIR_SEP . $TheFile, $searchid);
   fGenerateThumbNail($searchid);
}

?>
