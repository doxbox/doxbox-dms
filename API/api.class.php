<?php
/**
 * api.class.php -- API Class 
 * 
 * Author: Steve Bourgeois <owl@bozzit.com>
 * 
 * Copyright (c) 2006-2014 Bozz IT Consulting Inc
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

/** 
  3rdParty Include Section
 */

require_once('3rdparty/adodb5/adodb.inc.php');

/** 
  Class Include Section
 */

require_once('config/constants.php');

/* Class API Code */

class DmsAPI
{

   /**
   * Public Property Declaration
   */
   
   /**
   * Private Property Declaration
   * Using openssl rand -base64 33 to generate Keys
   */
   private $sAPIKeys = array();
   private $sDbHost = '';
   private $sDbUser = '';
   private $sDbPass = '';
   private $sDbName = '';

   /**
   * Variable to tell the class to send 
   *  Errors and Status in JSON or XML Format
   */
   private $ResponseType = 'JSON';

   /**
   * Class Construct to Initialize Variables 
   */
   
   function __construct() 
   {
      /**
        DoxBox Global Configuration Variable
      */
      global $default;

      /**
        Initialize Database Parms as Defined in the DoxBox config file 
        Using the First Database
        May need to make this more Dynamic in future
      */
      $default->owl_current_db = 0;
      $this->sDbHost = $default->owl_db_host[0];
      $this->sDbUser = $default->owl_db_user[0];
      $this->sDbPass = $default->owl_db_pass[0]; 
      $this->sDbName = $default->owl_db_name[0];
      $default->owl_FileDir  =  $default->owl_db_FileDir[0];

   }
   
   /***********************************
   * Public method declaration
   ************************************
   */


   /**
   * Authenticates a user to the DMS Support for Doxbox User Password Authentication only at this time
   *
   * @param  string  $sUsername   Username to authenticate
   * @param  string  $sPassword   MD5 Password
   * @throws 
   * @return string  session
   *                 Error Code and Message if not succesfull
   */

   public function VerifyCredential($sUsername, $sPassword, $sUserAPIKey, $fConfig = './config/api.config.php') 
   {
      global $default;

      /**
      * Parse the class INI file
      */

      $aIniFile = parse_ini_file($fConfig);


      $this->sAPIKeys = $aIniFile['key'];


      $aError = array();
      $aError['code'] = '';
      $aError['msg'] = '';
      $aError['ip_address'] = fGetClientIP();

      if (!in_array($sUserAPIKey, $this->sAPIKeys))
      {
         $aError['code'] = ERROR_MISSING_API_KEY;
         $aError['msg'] = 'You API KEY is Missing Access Denied';
         throw new Exception($this->Response($aError));
      }
      else
      {
         $sExpectedAPIKey = sha1($aIniFile['keysalt'].sha1(fGetClientIP().$aIniFile['keysalt']));
         if ($sExpectedAPIKey <> $sUserAPIKey)
         {
            $aError['code'] = ERROR_WRONG_API_IP;
            $aError['msg'] = 'You are Using an invalid API KEY';
            throw new Exception($this->Response($aError));
         }
      }

      /**
      * Call to the Doxbox Verify Login Function
      */ 
      $aVerified = verify_login($sUsername, $sPassword);

      if ($aVerified['bit'] == 2)
      {
         $aError = array();
         $aError['code'] = AUTH_USER_DISABLED;
         $aError['msg'] = 'User is Disabled';

         throw new Exception($this->Response($aError));
      }
      else if ($aVerified['bit'] == 1)
      {
         $session = new Owl_Session;
         $uid = $session->Open_Session(0, $aVerified['uid']);

         $aError = array();
         $aError['sessid'] = $uid->sessdata["sessid"];

         throw new Exception($this->Response($aError));
      }
      else
      {
         $aError = array();
         $aError['code'] = AUTH_FAILED;
         $aError['sql'] = $sSQL;

         throw new Exception($this->Response($aError));
      }
   }

   /**
   * Allows the Client API to Destroy the Doxbox Session
   *
   * @param  string  $sSessID     Valid SessionID to Logout
   * @throws 
   * @return bool    true         On Success
   *                 Error Code and Message On Failiure
   */
    
   public function Logout($sSessID) 
   {
      global $default;

      $sess = $sSessID;

      $aVerified = $this->VerifySession($sSessID);

      $cDB = $this->fGetDBConnect();

      $sSQL =  sprintf("DELETE FROM $default->owl_sessions_table WHERE sessid = %s" ,$cDB->qstr($sSessID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($cDB->Affected_Rows() == 1)
         {
            $tmpDir = $default->owl_tmpdir . "/owltmp.$sSessID";
            if (file_exists($tmpDir))
            {
               myDelete($tmpDir);
            }
   
            owl_syslog(LOGOUT, $aVerified['userid'], 0, 0, 'DMS API CALLED', "LOGIN");
   
            $aError = array();
            $aError['code'] = SUCCESS;
            $aError['msg'] = 'User Successfully Logged Out';
         }
         else
         {
            $aError = array();
            $aError['code'] = SESS_NOT_EXIST;
            $aError['msg'] = 'Session Does Not Exists, User Not Logged Out';
         }
         throw new Exception($this->Response($aError));
      }
   }


   /**
   * Provides a list of Files and Folders within a Given Folder ID
   *
   * @param  string  $iFolderID     Unique Folder ID 
   * @throws 
   * @return bool    array with a list of files and Folders within the requested FolderId
   *                 array with Error Code and Message if not
   */
    
   public function BrowseFolder($iFolderID) 
   {
   }

   /**
   * Deletes a Folder from the DoxBox DMS
   *
   * @param  string  $iFolderID     Unique Folder ID 
   * @throws 
   * @return bool    true if successful 
   *                 array with Error Code and Message if not
   */
    
   public function DeleteFolder($iFolderID) 
   {
   }
   
   /**
   * Deletes a single File from the DoxBox DMS
   *
   * @param  string  $iFileID     Unique File ID 
   * @throws 
   * @return bool    true if successful 
   *                 array with Error Code and Message if not
   */
    
   public function DeleteFile($sSessID, $iFileID) 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin;

      $aVerified = $this->VerifySession($sSessID);

      $cDB = $this->fGetDBConnect();

      $sSQL =  sprintf("SELECT id FROM $default->owl_files_table WHERE id = %s" ,$cDB->qstr($iFileID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() == 1)
         {
            delFile($iFileID, "file_delete", 1);

            $aError = array();
            $aError['code'] = SUCCESS;
            $aError['msg'] = 'File Deleted Succesffully';
            $this->PostDeleteFileProcessing(); 
         }
         else
         {
            $aError = array();
            $aError['code'] = DELETE_FILE_NOT_EXISTS;
            $aError['msg'] = 'File to Delete Does not Exist';
         }
         throw new Exception($this->Response($aError));
      }

   }

   /**
   * Post Delete Processing Function 
   * This Method is put in place to allow 
   * a User Extending this class to add Post Delete 
   * processing without overriding the DeleteFile Method
   *
   * @param  
   * @throws 
   * @return 
   */
   public function PostDeleteFileProcessing() 
   {
   }

   /**
   * Create a folder in the Target Parent Folder
   *
   * @param  string  $sSessID       Session ID String
   * @param  string  $iParentID     ID of the Parent Folder
   * @param  string  $sFolderName   Name of Folder Created
   * @throws 
   * @return XML or Json Message with ID of the new folder on success
   */
    
   public function CreateFolder($sSessID, $iParentID, $sFolderName, $iOwnerUserID = null, $iOwnerGroupID = null) 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      /** if no owner id was passed in, use the ones from the Verified USER */
      if (is_null($iOwnerUserID))
      {
          $iOwnerUserID = $aVerified['userid'];
          $iOwnerGroupID = $aVerified['groupid'];
      }

      $cDB = $this->fGetDBConnect();

      /**
       * Check to make sure the destination Folder exists
       */

      $sSQL =  sprintf("SELECT id FROM $default->owl_folders_table WHERE id=%s" ,$cDB->qstr($iParentID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() == 0)
         {
            $aError['code'] = FOLDER_CREATE_NO_DEST;
            $aError['msg']  = 'The Destination Folder Does not exist';
            throw new Exception($this->Response($aError));
         }
      }

      /**
       * Do we have write access to the destination Folder?
       */

      if (check_auth($iParentID, "folder_create", $aVerified['userid']) == 0)
      {
         $aError['code'] = FOLDER_CREATE_PERM_DENIED;
         $aError['msg']  = sprintf("Your do not have write access to this folder (%s)", $iParentID);
         throw new Exception($this->Response($aError));
      }

      $name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", urldecode($sFolderName))));

      $sSQL =  sprintf("SELECT name FROM $default->owl_folders_table WHERE name=%s AND parent=%s" ,$cDB->qstr($name), $cDB->qstr($iParentID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() == 1)
         {
            $aError['code'] = FOLDER_CREATE_EXISTS;
            $aError['msg']  = 'The folder you are trying to create already exists';
            throw new Exception($this->Response($aError));
         }
      }

      if ($name == '')
      {
         $aError['code'] = FOLDER_CREATE_NAME_EMPTY;
         $aError['msg']  = 'The folder name is required';
         throw new Exception($this->Response($aError));
      }

      if ($default->owl_use_fs)
      {
         if (strtolower($name) == $default->version_control_backup_dir_name)
         {
            $aError['code'] = FOLDER_CREATE_RESERVED_NAME;
            $aError['msg']  = 'The folder name cannot be called ' . $default->version_control_backup_dir_name .'] it is reserved';
            throw new Exception($this->Response($aError));
         }

         $path = find_path($iParentID);

         if (file_exists("$default->owl_FileDir/$path/$name"))
         {
            $aError['code'] = FOLDER_CREATE_EXISTS;
            $aError['msg']  = 'The folder you are trying to create already exists';
            throw new Exception($this->Response($aError));
         }

         mkdir($default->owl_FileDir . DIR_SEP . $path . DIR_SEP . $name, $default->directory_mask);

         if (!is_dir("$default->owl_FileDir/$path/$name"))
         {
            $aError['code'] = FOLDER_CREATE_FAILED;
            $aError['msg']  = 'The folder creation Failed';
            throw new Exception($this->Response($aError));
         }
      }

      $dDateCreated = $cDB->DBTimeStamp(time());

      $sSQL = sprintf("INSERT INTO $default->owl_folders_table (name,parent,groupid,creatorid, smodified, linkedto)
                                 VALUES (%s, '%s', '%s', '%s', %s, '0')", 
                             $cDB->qstr(fReplaceSpecial($name)),
                             $iParentID, 
                             $iOwnerGroupID,
                             $iOwnerUserID,
                             $dDateCreated);

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         unlink($default->owl_FileDir . DIR_SEP . $path . DIR_SEP . $name); // Insert Failed so remove the Directory 

         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();
 
         throw new Exception($this->Response($aError));
      }
      else
      {
         /**
          * Get the ID of the file we just inserted.
          */

         $iOldParent = $iParentID;
         $parent = $cDB->Insert_ID();

         owl_syslog(FOLDER_CREATED, $userid, $name, $iParentID, $owl_lang->log_detail, "FILE");

         fSetDefaultFolderAcl($parent);
         fSetInheritedAcl($iOldParent, $parent, "FOLDER");

         $aError = array();
         $aError['code'] = SUCCESS;
         $aError['new_folder_id'] = $parent;
         $aError['msg'] = 'Folder Succesfully Created ';
         $this->PostFolderCreateProcessing();

         throw new Exception($this->Response($aError));
      }
   }

   /**
   * Post Folder Create Processing Function 
   * This Method is put in place to allow 
   * a User Extending this class to add Post Folder Create 
   * processing without overriding the DeleteFile Method
   *
   * @param  
   * @throws 
   * @return 
   */
   public function PostFolderCreateProcessing()
   {
   }


   /**
   * Download a single File from the DoxBox DMS
   *
   * @param  string  $iFileID     Unique File ID 
   * @throws 
   * @return bool    true if successful 
   *                 array with Error Code and Message if not
   */
    
   public function DownloadFile($sSessID, $iFileID, $aCustomHeaders = array(), $bCompressed = false) 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      $aCustomHeaders = unserialize(gzuncompress(urldecode($aCustomHeaders)));

      $cDB = $this->fGetDBConnect();

      if (check_auth($iFileID, "file_download", $userid) == 1)
      {
         $iFileID = fGetPhysicalFileId($iFileID);
         $filename = flid_to_filename($iFileID);
         $download_name = $filename;
         $mimeType = fGetMimeType($filename);

         $path = find_path(owlfileparent($iFileID)) . DIR_SEP . $filename;
         $fspath = $default->owl_FileDir . DIR_SEP . $path;
         if (!file_exists($fspath))
         {
            $aError = array();
            $aError['code'] = DWNL_FILE_MISSING;
            $aError['msg'] = 'The File you are attempting to download is physically missing from the filesystem';
   
            throw new Exception($this->Response($aError));
         }

         $fsize = filesize($fspath);

         $path = fCreateWaterMark($iFileID);

         if (! $path == false)
         {
            $fspath = $path;
            $fsize = filesize($path);
         }

         if ($bCompressed)
         {
            $tmpdir = $default->owl_tmpdir . sprintf("/owltmpfld_%s", $sSessID);

            if (file_exists($tmpdir))
            {
               myDelete($tmpdir);
            }

            mkdir($tmpdir, $default->directory_mask);

            $aFileInfo = fFindFileFirstpartExtension ($download_name);
            $download_name = $aFileInfo[0] . '.zip';

            $archive = new PclZip($tmpdir . DIR_SEP . $download_name);

            $v_list = $archive->create($fspath, PCLZIP_OPT_REMOVE_ALL_PATH);

            if ($v_list == 0)
            {
               $aError = array();
               $aError['code'] = 'CUST0006B';
               $aError['msg'] = 'An Error Occured while Creating your Zip File.';
               $aError['zip_err'] = $archive->errorInfo(true);

               throw new Exception($this->Response($aError));
            }

            $mimeType = fGetMimeType($download_name);
            $fsize = filesize($tmpdir . DIR_SEP . $download_name);
            $fspath = $tmpdir . DIR_SEP . $download_name;

         }

         header("Content-Disposition: attachment; filename=\"$download_name\"");
         header("Content-Location: $download_name");
         header("Content-Type: $mimeType");
         header("Content-Length: $fsize");
         // Process Custom Headers if Any
         if(count($aCustomHeaders) > 0)
         {
            foreach ($aCustomHeaders as $sHeaderName => $sValue)
            {
               header(sprintf("X-DmsAPI-%s: %s", $sHeaderName, $sValue) );
            }
         }

         header("Expires: 0");

         $fp = fopen("$fspath", "rb");
      
         fpassthru($fp);
         
         fclose($fp);

         if (file_exists($tmpdir))
         {
            myDelete($tmpdir);
         }
      }
      else
      {
         $aError = array();
         $aError['code'] = DWNL_FILE_PERM_DENIED;
         $aError['msg'] = 'You do not have download permission for this file';
 
         throw new Exception($this->Response($aError));
      } // END Check Auth
   }

   /**
   * Update a single File to the DoxBox DMS
   *
   * @param  array  $_FILE     PHP File ARRAY 
   * @throws 
   * @return bool    true if successful 
   *                 array with Error Code and Message if not
   */
    
   public function UpdateFile($sSessID, $iFileID, $sVersionChange = 'minor') 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      $cDB = $this->fGetDBConnect();

      $iParentID =  owlfileparent($iFileID);
      /**
       * Check to make sure the destination Folder exists
       */
      $sSQL =  sprintf("SELECT id FROM $default->owl_folders_table WHERE id=%s" ,$cDB->qstr($iParentID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();
      
         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() == 0)
         {
            $aError['code'] = UPLOAD_NO_DEST;
            $aError['msg']  = 'The Destination Folder Does not exist';
            throw new Exception($this->Response($aError));
         }
      }  

      /**
       * Do we have write access to the destination Folder?
       */
      if (check_auth($iParentID, "folder_create", $aVerified['userid']) == 0)
      {
         $aError['code'] = UPLOAD_PERM_DENIED;
         $aError['msg']  = sprintf("Your do not have write access to this folder (%s)", $iParentID);
         throw new Exception($this->Response($aError));
      }

      /**
       * Do we have write access to the destination Folder?
       */
      if (check_auth($iFileID, "file_update", $userid) == 0)
      {
         $aError['code'] = UPDATE_PERM_DENIED;
         $aError['msg']  = sprintf("Your do not have update access to this file (%s)", $iFileID);
         throw new Exception($this->Response($aError));
      }
  
      if ($_FILES['file_contents']['error'] == UPLOAD_ERR_OK) 
      { 
         /**
          * Cleanup the Incoming Filename using owl's list of permited characters
          */
         $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $_FILES['file_contents']['name'])));
         $newpath = $default->owl_FileDir . DIR_SEP . find_path($iParentID) . DIR_SEP . $new_name;

         if ($default->owl_version_control == 1)
         { 
           /**
            * Lets see about the Backup Directory
            * create it if necessary
            */
            if (!is_dir("$default->owl_FileDir/" . find_path($iParentID) . "/$default->version_control_backup_dir_name"))
            {
               mkdir("$default->owl_FileDir/" . find_path($iParentID) . "/$default->version_control_backup_dir_name", $default->directory_mask);
               
               if (is_dir("$default->owl_FileDir/" . find_path($iParentID) . "/$default->version_control_backup_dir_name"))
               {
   
                  $sSQL =  sprintf("INSERT INTO $default->owl_folders_table (name, parent, groupid, creatorid, linkedto)  
                                           VALUES (%s, %s, '%s', '%s', '0')",
                                        $cDB->qstr($default->version_control_backup_dir_name), 
                                        $cDB->qstr($iParentID),
                                        owlfoldergroup($iParentID),
                                        owlfoldercreator($iParentID));
   
                  $rResultSet = $cDB->Execute($sSQL);
   
                  if (!$rResultSet)
                  {
                     $aError = array();
                     $aError['code'] = DATABASE_ERROR;
                     $aError['msg'] = 'Database Error';
                     $aError['sql'] = $sSQL;
                     $aError['sql_err'] = $cDB->ErrorMsg();
            
                     throw new Exception($this->Response($aError));
                  }
                  else
                  {
                     $newParent = $cDB->Insert_ID();
   
                     fSetDefaultFolderAcl($newParent);
                     fSetInheritedAcl($iParentID, $newParent, "FOLDER");
                  }
               }
               else
               {
                  $aError['code'] = UPDATE_BACKUP_CREATE_FAILED;
                  $aError['msg']  = sprintf("Was Unable to create the backup Directory");
                  throw new Exception($this->Response($aError));
               }
            }
            else
            {
               /**
                * Get teh ID of the existing Backup Folder
                */
               $sSQL =  sprintf("SELECT id FROM $default->owl_folders_table WHERE name=%s AND parent=%s", $cDB->qstr($default->version_control_backup_dir_name), $cDB->qstr($iParentID));

               $rResultSet = $cDB->Execute($sSQL);
   
               if (!$rResultSet)
               {
                     $aError = array();
                     $aError['code'] = DATABASE_ERROR;
                     $aError['msg'] = 'Database Error';
                     $aError['sql'] = $sSQL;
                     $aError['sql_err'] = $cDB->ErrorMsg();
            
                     throw new Exception($this->Response($aError));
               }
               else
               {
                  $newParent = $rResultSet->fields['id'];
               }
            }
            /**
             * Lets Get Information about the file we are updating
             */
            $sSQL =  sprintf("SELECT f_size, filename, major_revision, minor_revision FROM $default->owl_files_table WHERE id='$iFileID'");

            $rResultSet = $cDB->Execute($sSQL);
   
            if (!$rResultSet)
            {
               $aError = array();
               $aError['code'] = DATABASE_ERROR;
               $aError['msg'] = 'Database Error';
               $aError['sql'] = $sSQL;
               $aError['sql_err'] = $cDB->ErrorMsg();
      
               throw new Exception($this->Response($aError));
            }
            else
            {
               /**
                * Check if this is destination file is the same file as we are trying to upload and update
                */
               if ($default->owl_use_fs)
               {
                  if ($default->owl_FileDir . DIR_SEP . find_path($iParentID) . DIR_SEP . $rResultSet->fields['filename'] != $newpath)
                  {
                     if ($default->allow_different_filename_update == 1)
                     {
                        $sNewFileExtension = fFindFileExtension ($new_name);
                        $sOrigFileExtension = fFindFileExtension ($rResultSet->fields['filename']);
                        if ($sNewFileExtension == $sOrigFileExtension)
                        {
                           $newpath = $default->owl_FileDir . DIR_SEP . find_path($iParentID) . DIR_SEP . $rResultSet->fields['filename'];
                           $new_name = $rResultSet->fields['filename'];
                        }
                        else
                        {
                           $aError['code'] = UPDATE_DIFFERENT_EXTENSIONS;
                           $aError['msg']  = sprintf("File Extensions/File Type must be the same to update the File");
                           throw new Exception($this->Response($aError));
                        }
                     }
                     else
                     {
                        $aError['code'] = UPDATE_FAILED;
                        $aError['msg']  = 'Updating a file requires the filename to remain the same, please try again using the same filename';
                        throw new Exception($this->Response($aError));
                     }
                  }
               }

               /**
                * Calculate Quota New Quota  
                */
               $iNewQuota =  fCalculateQuota($_FILES['file_contents']['size'], $aVerified['userid'], "ADD") - $rResultSet->fields['f_size'];

               $aFileInfo = fFindFileFirstpartExtension($new_name);
               $version_name = $aFileInfo[0] . '_' . $rResultSet->fields['major_revision'] . '-' . $rResultSet->fields['minor_revision'] . '.' . $aFileInfo[1];
               $backuppath = $default->owl_FileDir . DIR_SEP . find_path($iParentID) . "/$default->version_control_backup_dir_name/$version_name";

                if (strtolower($sVersionChange) == 'minor')
                {
                   $sNewMinor = $rResultSet->fields['minor_revision'] + 1;
                   $sNewMajor = $rResultSet->fields['major_revision'];
                }
                else
                {
                   $sNewMinor = '0';
                   $sNewMajor = $rResultSet->fields['major_revision'] + 1;
                }

               copy($newpath, $backuppath); // copy existing file to backup folder

               if (!file_exists($newpath))
               {
                  $aError['code'] = UPDATE_FILE_BACKUP_FAILED;
                  $aError['msg']  = $owl_lang->err_file_update;
                  throw new Exception($this->Response($aError));
               }
               
               /** 
                * Copy existing file over the original file
                */
               if ($default->owl_use_fs)
               {
                  $bMoved = move_uploaded_file( $_FILES['file_contents']['tmp_name'], $newpath );
                  if (!$bMoved)
                  {
                     unlink($backuppath); // Remove the backup copy above
                     $aError['code'] = UPLOAD_MOVE_FAILED;
                     $aError['msg']  = 'Moving the file from PHP temp directory Failed';
                     throw new Exception($this->Response($aError));
                  }
               }


               /**
                * insert entry for backup file
                */
               $dDateCreated = $cDB->DBTimeStamp(time());
             
               $sSQL = sprintf("INSERT INTO $default->owl_files_table (name, filename, f_size, creatorid, updatorid, parent, created, smodified, groupid,
                                                                       description, metadata, major_revision, minor_revision, doctype, linkedto, name_search, 
                                                                       filename_search, description_search, metadata_search, approved) 
                                       SELECT name, %s, f_size, creatorid, updatorid, %s, %s, smodified, groupid, description, metadata, major_revision, 
                                              minor_revision, doctype, linkedto, name_search, filename_search, description_search, metadata_search, '1' 
                                       FROM $default->owl_files_table 
                                       WHERE id = %s",
                                          $cDB->qstr($version_name),
                                          $cDB->qstr($newParent),
                                          $dDateCreated,
                                          $cDB->qstr($iFileID));

               $rResultSet = $cDB->Execute($sSQL);
 
               if (!$rResultSet)
               {
                  $aError = array();
                  $aError['code'] = DATABASE_ERROR;
                  $aError['msg'] = 'Database Error';
                  $aError['sql'] = $sSQL;
                  $aError['sql_err'] = $cDB->ErrorMsg();
         
                  throw new Exception($this->Response($aError));
               }
               else
               {

                  $idbackup = $cDB->Insert_ID();
  
                  fIndexAFile($new_name, $newpath, $iFileID);
                  fCopyFileAcl($iFileID, $idbackup);
                  fGenerateThumbNail($iFileID);
                  fGenerateThumbNail($idbackup);

                  if (fIsQuotaEnabled($aVerified['userid']) )
                  {
      
                     $sSQL = sprintf("UPDATE $default->owl_users_table SET quota_current = '%s' WHERE id = '%s'",
                                                    $iNewQuota,
                                                    $aVerified['userid']);
      
                     $rResultSet = $cDB->Execute($sSQL);
      
                     if (!$rResultSet)
                     {
                        $aError = array();
                        $aError['code'] = DATABASE_ERROR;
                        $aError['msg'] = 'Database Error';
                        $aError['sql'] = $sSQL;
                        $aError['sql_err'] = $cDB->ErrorMsg();

                        throw new Exception($this->Response($aError));
                     }
                  }

                  $sSQL = sprintf ("UPDATE $default->owl_files_table SET f_size='%s', smodified=%s, minor_revision='%s', major_revision='%s',  approved = '1', updatorid='%s'  WHERE id= %s OR linkedto = %s", 
                                              $_FILES['file_contents']['size'],
                                              $dDateCreated,
                                              $sNewMinor,
                                              $sNewMajor,
                                              $userid,
                                              $cDB->qstr($iFileID),
                                              $cDB->qstr($iFileID));
  
                  $rResultSet = $cDB->Execute($sSQL);

                  if (!$rResultSet)
                  {
                     $aError = array();
                     $aError['code'] = DATABASE_ERROR;
                     $aError['msg'] = 'Database Error';
                     $aError['sql'] = $sSQL;
                     $aError['sql_err'] = $cDB->ErrorMsg();
          
                     throw new Exception($this->Response($aError));
                  }
                  else
                  {
                     $sSQL = sprintf("UPDATE $default->owl_searchidx SET owlfileid = %s  WHERE owlfileid = %s",  $cDB->qstr($idbackup), $cDB->qstr($iFileID));
                     $rResultSet = $cDB->Execute($sSQL);

                     if (!$rResultSet)
                     {
                        $aError = array();
                        $aError['code'] = DATABASE_ERROR;
                        $aError['msg'] = 'Database Error';
                        $aError['sql'] = $sSQL;
                        $aError['sql_err'] = $cDB->ErrorMsg();
             
                        throw new Exception($this->Response($aError));
                     }
                     else
                     {
                        owl_syslog(FILE_UPDATED, $userid, $_FILES['file_contents']['name'], $iParentID, $version_name, "FILE", $_FILES['file_contents']['size']);
                        $aError = array();
                        $aError['code'] = SUCCESS;
                        $aError['backup_file_id'] = $idbackup;
                        $aError['msg'] = 'File Succesfully Updated ';
                        $this->PostUpdateFileProcessing();
          
                        throw new Exception($this->Response($aError));
                     }
                  }
               }
            }
            
         } // END Version Control 
         else
         {
         } // END Regular File Update
      }
      else
      {
         throw new Exception($this->Response($this->fUploadErrorToMessage($_FILES['file_contents']['error'])));
      }
   }

   /**
   * Post Update Processing Function 
   * This Method is put in place to allow 
   * a User Extending this class to add Post File Update 
   * processing without overriding the UpdateFile Method
   *
   * @param  
   * @throws 
   * @return 
   */
   public function PostUpdateFileProcessing()
   {
   }

   /**
   * Upload a single File to the DoxBox DMS
   *
   * @param  array  $_FILE     PHP File ARRAY 
   * @throws 
   * @return bool    true if successful 
   *                 array with Error Code and Message if not
   */
    
   public function UploadFile($sSessID, $iParentID) 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      $cDB = $this->fGetDBConnect();

      /**
       * Check to make sure the destination Folder exists
       */
      $sSQL =  sprintf("SELECT id FROM $default->owl_folders_table WHERE id=%s" ,$cDB->qstr($iParentID));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();
      
         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() == 0)
         {
            $aError['code'] = UPLOAD_NO_DEST;
            $aError['msg']  = 'The Destination Folder Does not exist';
            throw new Exception($this->Response($aError));
         }
      }  

      /**
       * Do we have write access to the destination Folder?
       */
      if (check_auth($iParentID, "folder_create", $aVerified['userid']) == 0)
      {
         $aError['code'] = UPLOAD_PERM_DENIED;
         $aError['msg']  = sprintf("Your do not have write access to this folder (%s)", $iParentID);
         throw new Exception($this->Response($aError));
      }

      if ($_FILES['file_contents']['error'] == UPLOAD_ERR_OK) 
      { 
         /**
          * Cleanup the Incoming Filename using owl's list of permited characters
          */
         $new_name = trim(fOwl_ereg_replace("[^$default->list_of_valid_chars_in_file_names]", "", fOwl_ereg_replace("%20|^-", "_", $_FILES['file_contents']['name'])));

         /**
          * If We are going to store this file to the File system we need to make sure the destination doesn't 
          * Already Have this file
          */
         if ($default->owl_use_fs)
         {
            $newpath = $default->owl_FileDir . DIR_SEP . find_path($iParentID) . DIR_SEP . $new_name;
            if (file_exists($newpath) == 1)
            {
               /**
                * Lets Return some info about this file
                */ 
               $sSQL =  sprintf("SELECT id, f_size FROM $default->owl_files_table WHERE filename=%s AND parent=%s" ,$cDB->qstr($new_name), $cDB->qstr($iParentID));

               $rResultSet = $cDB->Execute($sSQL);
   
               if (!$rResultSet)
               {
                  $aError = array();
                  $aError['code'] = DATABASE_ERROR;
                  $aError['msg'] = 'Database Error';
                  $aError['sql'] = $sSQL;
                  $aError['sql_err'] = $cDB->ErrorMsg();
   
                  throw new Exception($this->Response($aError));
               }
               else
               {
                  $aError['code'] = UPLOAD_FILE_EXIST;
                  $aError['existing_file_id'] = $rResultSet->fields['id'];
                  $aError['existing_file_size'] = $rResultSet->fields['f_size'];
                  $aError['msg']  = 'The file you are trying to upload already exists';
                  throw new Exception($this->Response($aError));
               }
            }
         }
         else // File is stored to the DB
         {
            // is name already used?

            $sSQL =  sprintf("SELECT filename FROM $default->owl_files_table WHERE filename=%s AND parent=%s" ,$cDB->qstr($new_name), $cDB->qstr($iParentID));

            $rResultSet = $cDB->Execute($sSQL);
      
            if (!$rResultSet)
            {
               $aError = array();
               $aError['code'] = DATABASE_ERROR;
               $aError['msg'] = 'Database Error';
               $aError['sql'] = $sSQL;
               $aError['sql_err'] = $cDB->ErrorMsg();
      
               throw new Exception($this->Response($aError));
            }
            else
            {
               if ($rResultSet->RecordCount() == 1)
               {
                  $aError['code'] = UPLOAD_FILE_EXIST;
                  $aError['msg']  = 'The file you are trying to upload already exists';
                  throw new Exception($this->Response($aError));
               }
            }
         }

         /**
          * Move the file to its Final Location in the Doxbox Directory Structure
          * if the Insert to the Doxbox Database Failes we will delete it
          */

         if ($default->owl_use_fs)
         {
            $bMoved = move_uploaded_file( $_FILES['file_contents']['tmp_name'], $newpath );
            if (!$bMoved)
            {
               $aError['code'] = UPLOAD_MOVE_FAILED;
               $aError['msg']  = 'Moving the file from PHP temp directory Failed';
               throw new Exception($this->Response($aError));
            }
         }

         /**
          * Insert The New File to the Database
          */

         $cDB = $this->fGetDBConnect();

         $aFirstpExtension = fFindFileFirstpartExtension ($new_name);

         $title = fOwl_ereg_replace("_", " ", $aFirstpExtension[0]);

         $dDateCreated = $cDB->DBTimeStamp(time());

         $dDocExpires = $cDB->DBTimeStamp('0001-01-01 00:00:00');

         $aRev = array();
         $aRev =    fValidateRevision('',''); // Pass empty Revison to get the Default

         $sSQL = sprintf("INSERT INTO $default->owl_files_table (name, filename, f_size, creatorid, updatorid, parent, 
                                    created, groupid, smodified,checked_out, major_revision, minor_revision, url, 
                                    doctype, linkedto, approved, expires, name_search, filename_search) 
                                 VALUES (%s, %s, '%s', '%s', '%s', '%s', %s, '%s', %s, '0', '%s','%s', '0', '1', '0', '1', %s, %s, %s)", 
                             $cDB->qstr($title),
                             $cDB->qstr($new_name),
                             $_FILES['file_contents']['size'],
                             $aVerified['userid'],
                             $aVerified['userid'],
                             $iParentID, 
                             $dDateCreated,
                             $aVerified['groupid'],
                             $dDateCreated,
                             $aRev['major'],
                             $aRev['minor'],
                             $dDocExpires,
                             $cDB->qstr(fReplaceSpecial($title)),
                             $cDB->qstr(fReplaceSpecial($new_name)));


         $rResultSet = $cDB->Execute($sSQL);

         if (!$rResultSet)
         {
            unlink($newpath); // Insert Failed so remove the file from the owl Directory Structure

            $aError = array();
            $aError['code'] = DATABASE_ERROR;
            $aError['msg'] = 'Database Error';
            $aError['sql'] = $sSQL;
            $aError['sql_err'] = $cDB->ErrorMsg();
   
            throw new Exception($this->Response($aError));
         }
         else
         {
            /**
             * Get the ID of the file we just inserted.
             */
            $id = $cDB->Insert_ID();

            fIndexAFile($new_name, $newpath, $id);
            
            /**
             * If the file content neews to be inserted to the Database
             */

            $compressed = '0';

            $fsize = $_FILES['file_contents']['size'];

            if (!$default->owl_use_fs && $default->owl_compressed_database && file_exists($default->gzip_path))
            {
               system(escapeshellarg($default->gzip_path) . " " . escapeshellarg($_FILES['file_contents']['tmp_name']));
               $_FILES['file_contents']['tmp_name'] = $_FILES['file_contents']['tmp_name'] . ".gz";
               $fsize = filesize($_FILES['file_contents']['tmp_name']);
               $compressed = '1';
            }
            
            if (!$default->owl_use_fs)
            {
               $fd = fopen($_FILES['file_contents']['tmp_name'], 'rb');
               $filedata = fEncryptFiledata(fread($fd, $fsize));
               fclose($fd);
               unlink($_FILES['file_contents']['tmp_name']);

               if ($id !== null && $filedata)
               {
                  $filedatasql = new Owl_DB;
                  $filedatasql->query("INSERT INTO $default->owl_files_data_table (id, data, compressed) values ('$id', '$filedata', '$compressed')", 'latin1');
               }
            }

            fGenerateThumbNail($id);

            if (fIsQuotaEnabled($aVerified['userid']) )
            {

               $sSQL = sprintf("UPDATE $default->owl_users_table SET quota_current = '%s' WHERE id = '%s'",
                                              fCalculateQuota($_FILES['file_contents']['size'], $aVerified['userid'], "ADD"),
                                              $aVerified['userid']);

               $rResultSet = $cDB->Execute($sSQL);

               if (!$rResultSet)
               {
                  $aError = array();
                  $aError['code'] = DATABASE_ERROR;
                  $aError['msg'] = 'Database Error';
                  $aError['sql'] = $sSQL;
                  $aError['sql_err'] = $cDB->ErrorMsg();
      
                  throw new Exception($this->Response($aError));
               }
            }

            $aSetACL[] = $id;

            fSetDefaultFileAcl($id);
            fSetInheritedAcl($iParentID, $id, "FILE");

            notify_users($aVerified['groupid'], NEW_FILE, $id, $type);
            notify_monitored_folders ($iParentID, $new_name);

            owl_syslog(FILE_UPLOAD, $aVerified['userid'], $new_name, $iParentID, $owl_lang->log_detail, "FILE", $fsize);

            $aError = array();
            $aError['code'] = SUCCESS;
            $aError['new_file_id'] = $id;
            $aError['msg'] = 'File Succesfully Uploaded ';
            $this->PostUploadFileProcessing();

            throw new Exception($this->Response($aError));
         }
      } 
      else 
      { 
         throw new Exception($this->Response($this->fUploadErrorToMessage($_FILES['file_contents']['error'])));
      } 
   }

   /**
   * Post Upload File Processing Function 
   * This Method is put in place to allow 
   * a User Extending this class to add Post File Upload 
   * processing without overriding the UploadFile Method
   *
   * @param  
   * @throws 
   * @return 
   */
   public function PostUploadFileProcessing()
   {
   }


   /**
   * Create a New Group 
   *
   * @param  string  $sSessID     Valid Doxbox Session ID 
   * @param  string  $sGroupName  Doxbox Group Name
   * @throws   
   * @return bool    error on fail   Success message + group_id 
   */

   public function AddGroup($sSessID, $sGroupName)
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      if (!fIsAdmin(true))
      {
         $aError['code'] = ERROR_ACCESS_DENIED;
         $aError['msg'] = 'You Require an Administrator Account to Perform this Action';
         throw new Exception($this->Response($aError));
      }

      $cDB = $this->fGetDBConnect();

      $sSQL = sprintf("SELECT id FROM $default->owl_groups_table WHERE name = %s", $cDB->qstr(urldecode($sGroupName)));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() > 0)
         {
            $aError = array();
            $aError['code'] = ADDGROUP_EXISTS;
            $aError['msg'] = $owl_lang->err_group_exists;

            throw new Exception($this->Response($aError));
         }
      }

      $dDateNow = $cDB->DBTimeStamp(time());

      $sSQL = sprintf("INSERT INTO $default->owl_groups_table (name) VALUES (%s)", $cDB->qstr(urldecode($sGroupName)));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         /**
          * Get the ID of the group we just inserted.
          */
         $iNewID = $cDB->Insert_ID();

         owl_syslog(USER_ADMIN, $userid, 0, 0, $owl_lang->log_admin_created_group . urldecode($sGroupName) , "ADMIN");

         $aError = array();
         $aError['code'] = SUCCESS;
         $aError['new_group_id'] = $iNewID;
         $aError['msg'] = 'Group Succesfully Created ';

         throw new Exception($this->Response($aError));
      }
   }


   /**
   * Create a New user DMS
   *
   * @param  string  $sSessID     Valid Doxbox Session ID 
   * @param  string  $sUsername   Doxbox Username
   * @param  string  $sPassword   Doxbox Password
   * @param  string  $iGroupID    Doxbox Group this User will belong to
   * @param  string  $sFullName   Users Full Name
   * @param  bool    $bHomeDir    Users Home and First Directory ID
   * @param  bool    $bGroupAdmin Is this user a Group Administrator
   * @param  int     $sQuotaMax   Users Max Quota in bytes
   * @throws   
   * @return bool    error on fail   Success message + user_id 
   */

   public function AddUser($sSessID, $sUsername, $sPassword, $iGroupID, $sFullName = '', $iHomeDirID = '1', $bGroupAdmin = '0', $sQuotaMax = '0') 
   {
      global $default, $userid, $usergroupid, $aMyGroupAdmin, $owl_lang;

      $aVerified = $this->VerifySession($sSessID);

      if (!fIsAdmin(true))
      {
         $aError['code'] = ERROR_ACCESS_DENIED;
         $aError['msg'] = 'You Require an Administrator Account to Perform this Action';
         throw new Exception($this->Response($aError));
      }

      $cDB = $this->fGetDBConnect();

      $sSQL = sprintf("SELECT id FROM $default->owl_users_table WHERE username = %s", $cDB->qstr(urldecode($sUsername)));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         if ($rResultSet->RecordCount() > 0)
         {
            $aError = array();
            $aError['code'] = ADDUSER_EXISTS;
            //$aError['msg'] = 'A User With this Username Already Exists';
            $aError['msg'] = $owl_lang->err_user_exists;

            throw new Exception($this->Response($aError));
         }
      }

      $dDateNow = $cDB->DBTimeStamp(time());

      $sSQL = sprintf("INSERT INTO $default->owl_users_table (groupid, username, name, password, quota_max, quota_current, language, maxsessions, curlogin, lastlogin,
                                      buttonstyle, homedir, firstdir, user_auth, groupadmin, user_major_revision, user_minor_revision, user_default_revision, user_default_view, user_access) 
                              VALUES (%s, %s, %s, %s, %s, '0', 'English', '4', %s, %s, 'Roma 2011', %s, %s, '0' , %s, '1', '0', '1', '1', '0')", 
                               $cDB->qstr($iGroupID),
                               $cDB->qstr(urldecode($sUsername)),
                               $cDB->qstr(urldecode($sFullName)),
                               $cDB->qstr(md5(urldecode($sPassword))),
                               $cDB->qstr(urldecode($sQuotaMax)),
                               $dDateNow,
                               $dDateNow,
                               $cDB->qstr(urldecode($iHomeDirID)),
                               $cDB->qstr(urldecode($iHomeDirID)),
                               $cDB->qstr(urldecode($bGroupAdmin)));

      $rResultSet = $cDB->Execute($sSQL);

      if (!$rResultSet)
      {
         $aError = array();
         $aError['code'] = DATABASE_ERROR;
         $aError['msg'] = 'Database Error';
         $aError['sql'] = $sSQL;
         $aError['sql_err'] = $cDB->ErrorMsg();

         throw new Exception($this->Response($aError));
      }
      else
      {
         /**
          * Get the ID of the user we just inserted.
          */
         $iNewID = $cDB->Insert_ID();

         owl_syslog(USER_ADMIN, $userid, 0, 0, $owl_lang->log_admin_created_user . urldecode($sFullName) ."(" . urldecode($sFullName) . ") ", "ADMIN");

         $aError = array();
         $aError['code'] = SUCCESS;
         $aError['new_user_id'] = $iNewID;
         $aError['msg'] = 'User Succesfully Created ';

         throw new Exception($this->Response($aError));
      }
   }

   /**
   * Returns converted PHP Array to Either JSON or XMP 
   * Depending what the Response Type is set to Default JSON
   *
   * @param  array/object  $aArrayToConvert       
   * @throws 
   * @return string    JSON String OR XML Data
   */
    
   public function Response($aArrayToConvert)
   {
      if ($this->GetResponseType() == 'JSON')
      { 
         return(json_encode($aArrayToConvert));
      }
      else
      {
         return($this->ArrayToXml($aArrayToConvert));
      }
   }

   /**
   * Set the Class API Reponse Type to Either JSON or XML 
   *
   * @param  string  $sResponseType     
   * @throws 
   * @return 
   */
    
   public function SetResponseType($sResponseType)
   {
        $this->ResponseType = $sResponseType; 
   }

   /**
   * Get the Currently set Class API Reponse Type 
   *
   * @param  
   * @throws 
   * @return  string  $sResponseType     
   */
    
   public function GetResponseType()
   {
        return $this->ResponseType;
   }

   /**
   * Function to Display The current Version of the API
   *
   * @param  
   * @throws 
   * @return  string  XML Response With The Version Number
   */
   public function Version() 
   {
      global $default;

      $aError['version'] = API_VERSION;
      $aError['msg'] = 'Doxbox API Version ' .  $aError['version'];

      if (!$default->owl_use_fs)
      {
         $aError['owl_use_fs'] = 'Support for Storing files to the Database is not supported a this time';
      }

      throw new Exception($this->Response($aError));
   }

   /***********************************
   * BEGIN DEVELOPMENT STUFF TO BE REMOVED
   ************************************
   */

   public function displayClass() 
   {
      print($this->Response($this));
   }

   /***********************************
   * END DEVELOPMENT STUFF TO BE REMOVED
   ************************************
   */

   /***********************************
   * Protected method declaration
   * Functions that may or Should be called
   * by new Classes that Extend this one
   ************************************
   */

   /**
    * Gets a connection to the Database
    *
    * @param  
    * @throws 
    * @return AodbConnection   $cDbConnection   
    */
   
   protected function fGetDBConnect()
   {
      $cDBConnection = ADONewConnection('mysqlt');
      $cDBConnection->PConnect($this->sDbHost,$this->sDbUser,$this->sDbPass,$this->sDbName);
      $cDBConnection->SetFetchMode(ADODB_FETCH_ASSOC);
   
      return $cDBConnection;
   }

   /**
    * Verifies that the session used is still valid
    *
    * @param  string 	Session ID String
    * @throws           Error with Session Status
    * @return array     Verified Session info on success
    *                   
    */
   
   protected function VerifySession($sSessID) 
   {
      global $sess, $userid, $usergroupid, $aMyGroupAdmin;

      $sess = $sSessID;

      $aVerified = verify_session($sSessID);


      if ($aVerified['bit'] <> 1)
      {
         $aError = array();
         switch ($aVerified['bit'])
         {
            case 0:
               $aError['code'] = SESS_INVALID;
               $aError['msg'] = 'The Doxbox Session is Invalid';
            break;
            case 5:
               $aError['code'] = SESS_EXPIRED;
               $aError['msg'] = 'The Doxbox Session Has Expired';
            break;
            case 7:
               $aError['code'] = SESS_IN_USE;
               $aError['msg'] = 'The Doxbox Session is in Use ';
            break;
            default:
               $aError['code'] = UNKOWN_ERROR;
               $aError['msg'] = 'Unknown Error Occured';
            break;
         }
         throw new Exception($this->Response($aError));
      }
      else
      { 
         $userid = $aVerified['userid'];
         $usergroupid = $aVerified['groupid'];
   
         $aMyGroupAdmin = fGetMyAdminGroups ($userid);
      }
      return $aVerified;
   }


   /***********************************
   * Private method declaration
   ************************************
   */
   
   /**
    * The next 2 functions are tied together
    * The convert a PHP Array to XML 
    * 
    * @param  array    $aArrayToConvert   PHP To convert to XML
    * @throws 
    * @return string   XML Output
    */

   private function ArrayToXml($aArrayToConvert)
   {
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?' . '><dms_response></dms_response>');

      $this->ConvertArrayToXml($aArrayToConvert,$xml);

      return $xml->asXML();
   }
 
   private function ConvertArrayToXml($aArray, &$xml) 
   {
      foreach($aArray as $key => $value) 
      {
         if(is_array($value)) 
         {
             $key = is_numeric($key) ? "item$key" : $key;
             $subnode = $xml->addChild("$key");
             $this->ConvertArrayToXml($value, $subnode);
         }
         else 
         {
             $key = is_numeric($key) ? "item$key" : $key;
             $xml->addChild("$key","$value");
         }
      }
   }

   /**
    * The convert a PHP Upload File Error Codes to a Message 
    * 
    * @param  int    PHP UPLOAD_ERR  codes
    * @throws 
    * @return string   Human Readable message
    */

    private function fUploadErrorToMessage($code) 
    { 
       $aError = array();
       $aError['code'] = '';
       $aError['msg'] = '';

       switch ($code) 
       { 
         case UPLOAD_ERR_INI_SIZE: 
                $aError['code'] = 'UPLOAD_ERR_INI_SIZE';
                $aError['msg'] =  'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
             break; 
         case UPLOAD_ERR_FORM_SIZE: 
                $aError['code'] = 'UPLOAD_ERR_FORM_SIZE';
                $aError['msg'] =  'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
             break; 
         case UPLOAD_ERR_PARTIAL: 
                $aError['code'] = 'UPLOAD_ERR_PARTIAL';
                $aError['msg'] =  'The uploaded file was only partially uploaded'; 
             break; 
         case UPLOAD_ERR_NO_FILE: 
                $aError['code'] = 'UPLOAD_ERR_NO_FILE';
                $aError['msg'] =  'No file was uploaded'; 
             break; 
         case UPLOAD_ERR_NO_TMP_DIR: 
                $aError['code'] = 'UPLOAD_ERR_NO_TMP_DIR';
                $aError['msg'] =  'Missing a temporary folder'; 
             break; 
         case UPLOAD_ERR_CANT_WRITE: 
                $aError['code'] = 'UPLOAD_ERR_CANT_WRITE';
                $aError['msg'] =  'Failed to write file to disk'; 
             break; 
         case UPLOAD_ERR_EXTENSION: 
                $aError['code'] = 'UPLOAD_ERR_EXTENSION';
                $aError['msg'] = ' File upload stopped by extension'; 
             break; 
         default: 
                $aError['code'] = 'UPLOAD_ERR_UNKOWN';
                $aError['msg'] = 'Unknown upload error'; 
             break; 
     } 
     return $aError;
  } 

} // END Class 
