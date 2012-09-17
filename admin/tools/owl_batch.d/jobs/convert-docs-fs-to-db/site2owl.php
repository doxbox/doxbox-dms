<?php
/**
 * Name:          site2owl.php
 * 
 * Author:        Steve Bourgeois
 * 
 * Date:          2003-07-18
 * 
 * Copyright (c) 2003-2004 Bozz IT Consulting Inc.
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 * 
 * Steps Taken to Migrate the sitescape database to Owl
 *
 * 1) If this is a SiteScape 6 Forum you need to upgrade it to 
 *    Sitescape 7, you can get your free demo from the SiteScape site.
 *    During the migration I selected to migrate to an MS SQL Server 7.0
 *
 * 2) I then purchased a tool called MSSQL-TO-MYSQL by Intelligent Converters
 *    www.convert-in.com to convert the MS SQL Server 7.0 to a mysql dump file
 *
 * 3) created the Mysql SiteScape datbase.
 * 
 * 4) Used this script to migrate the Sitescape Database to an empty Owl Database
 *
 *
 *
 */

// uncomment this to see plaintext output in your browser
// header("Content-Type: text/plain");

require("DB.php");


global $sForumPrefix, $sPrimaryGroup, $DEBUG, $sSiteScapeHiddenLocation, $sOwlDocumentLocation, $iAttachmentID;

$sForumPrefix = "tat_";
$sPrimaryGroup = "tat_user";
$DEBUG = false;
$sSiteScapeHiddenLocation = '/var/opt/tat';
$sOwlDocumentLocation = '/var/opt';
$iAttachmentID = 100;


// main()
fMigrateGroups();
fMigrateUsers();
fMigrateGroupMemberShip();
fMigrateData();


function fMigrateData()
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG;


   $iForumOffset = 0;


   print("<H1> Migrating DATA ....</H1>");
      //fMakeFolders("f_tat12a", $iForumOffset);
      //fMakeFolders("f_tat03", $iForumOffset);
      //fMakeFolders("f_tat00", $iForumOffset);
   //exit;
   $SiteScape = DB::connect("mysql://root:@localhost/sitescape",true);
   $query = "select forumName, propVal from ". $sForumPrefix ."_props where propId = 'title' and forumName LIKE 'f_%';";
   $result = $SiteScape->query($query);

   $Owl = DB::connect("mysql://root:@localhost/intranet");

   while($row = $result->fetchRow(DB_FETCHMODE_OBJECT))
   {
      print("Migrating '$row->forumName'...<br />");
      fMakeFolders($row->forumName, $iForumOffset);
      $iForumOffset = $iForumOffset + 1000;
   }

}




function fMoveDocToOwl($sForum, $iOwlParentId, $iSiteScapedocId, $filename, $iOwlDocId) 
{

   global $sForumPrefix, $sPrimaryGroup, $DEBUG, $sSiteScapeHiddenLocation, $sOwlDocumentLocation;

   $iFileExist = true;

   $sSourceFile = $sSiteScapeHiddenLocation . "/" . $sForum . "/" . $iSiteScapedocId . "/" . $filename;
   $sOriginalSourceFile = $sSiteScapeHiddenLocation . "/" . $sForum . "/" . $iSiteScapedocId . "/" . $filename;
   $sDestFile = $sOwlDocumentLocation . "/" . fGetDirPath($iOwlParentId);

   if(!file_exists($sSourceFile)) 
   {
      $sSourceFile = $sOwlDocumentLocation . "/tmp/" . $filename;
      if(!file_exists($sSourceFile))
      {
         print("<font color=red>--- NOT EXIST --- </font>Could Not Copy $sOriginalSourceFile ----->> $sDestFile<br />");
         $iFileExist = false;
      }
   }



   if($iFileExist)
   {
      $iFileSize = filesize ( $sSourceFile );
      $Owl = DB::connect("mysql://root:@localhost/intranet",true);
      $query = "Update files set size='$iFileSize' where id ='$iOwlDocId'";
      $result = $Owl->query($query);

      $sFullDestFilename = $sDestFile . "/" . $filename; 
      if(file_exists($sFullDestFilename))
      {
        $sDestFile = $sDestFile . "/" . $iOwlDocId . "_" . $filename;
      }
      $sCommand = "mv \"" . $sSourceFile . "\"  \"" . $sDestFile . "\"";
      //if ($iSiteScapedocId == "100035" )
      //{
         //print("ID: $iSiteScapedocId COMMAND: $sCommand <br />");
      //}
      system($sCommand);
   }
}



function fGetOwlGroupId($GroupName)
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   $Owl = DB::connect("mysql://root:@localhost/intranet",true);
   $query = "SELECT id FROM groups where name='$GroupName'";
   $result = $Owl->query($query);
   $row = $result->fetchRow(DB_FETCHMODE_OBJECT);
 
   return $row->id;

}

function fGetOwlUserId($UserName)
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   $Owl = DB::connect("mysql://root:@localhost/intranet",true);
   $query = "SELECT id FROM users where username='$UserName'";
   $result = $Owl->query($query);
   $row = $result->fetchRow(DB_FETCHMODE_OBJECT);
 
   return $row->id;

}


function fGetAbstract($Id, $sForum)
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape",true);
   $query = "select kvpVal from ". $sForumPrefix .$sForum ."_k where docId = '$Id'";
   $result = $SiteScape->query($query);                                  
      
   $row = $result->fetchRow(DB_FETCHMODE_OBJECT);
   return $row->kvpVal;
}




function fInsertDocuments($iParentFolder, $sForum, $iForumOffset) 
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG, $iAttachmentID;

   

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape",true);
   $query = "select attachmentFiles, uploadFileInfo, createdBy, modifiedOn, createdOn, docContent, subRoots, docId, parentId, documentType docLevel, title, parentFolder from ". $sForumPrefix .$sForum ."_d where subRoots is NULL and parentFolder = '$iParentFolder' and documentType<>'message'";
   $result = $SiteScape->query($query);

   $Owl = DB::connect("mysql://root:@localhost/intranet");

   while($row = $result->fetchRow(DB_FETCHMODE_OBJECT))
   {

      list($filename,$junk)= split ("\}", $row->uploadFileInfo, 2);
      $filename = ereg_replace('\}', "", $filename);
      $filename = ereg_replace('\{', "", $filename);

      if( strlen(trim($row->uploadFileInfo)) == strlen(trim($filename))) 
      {
           list($mime,$OLDfilename)= split (" ", $row->docContent, 2);
           $filename = ereg_replace('\}', "", $OLDfilename);
           $filename = ereg_replace('\{', "", $filename);
      }

      $description = fGetAbstract($row->docId, $sForum);

      if( $row->createdBy == '_none_')
      {
         $iOwlCreatorId = 1;
      }
      else
      {
         $iOwlCreatorId = fGetOwlUserId($row->createdBy);
      }


      $iOwlDocId = $row->docId + $iForumOffset;
      $iOwlParentId = $row->parentFolder + $iForumOffset;
      $iOwlGroupId = fGetOwlGroupId($sPrimaryGroup);
      $description = ereg_replace("'","\\'", $description);
      $title = ereg_replace("'","\\'", $row->title);
      $sOwlName  = trim($title);
      $sOwlName = ereg_replace("\/", "-", $sOwlName);

      
      $sInsertQuery = "INSERT INTO files set id='$iOwlDocId', name='$sOwlName', security='0', filename='$filename', parent='$iOwlParentId', created='$row->createdOn', description='$description', smodified='$row->modifiedOn', checked_out='0', major_revision='1', minor_revision='0', url='0', creatorid='$iOwlCreatorId', groupid='$iOwlGroupId'"; 

      $result3 = $Owl->query($sInsertQuery);
      //if ( $row->docId == "100035")
      //{
         //print("Q: $sInsertQuery <br />");
      //}

      fMoveDocToOwl($sForum, $iOwlParentId, $row->docId, $filename, $iOwlDocId);



      //**  IF this DOCUMENT HAS ATTACHMENTS

      if(strlen(trim($row->attachmentFiles)) <> 0)
      {
          
         $sTitle = $sOwlName . " -- Attachment --";

         $chars = preg_split( '//' , $row->attachmentFiles, -1, PREG_SPLIT_OFFSET_CAPTURE); 
         $bWordWithSpaces = false;
         $sFilename = "";

         foreach ($chars as $cChar)
         {
            //print $cChar; 
            if ($cChar == "{" || $cChar == " ")
            {
              if ($cChar == "{")
              {
                 $bWordWithSpaces = true;
              }
              else
              {
                 if(!$bWordWithSpaces) 
                 {
                    $sInsertQuery = "INSERT INTO files set id='$iAttachmentID', name='$sTitle', security='0', filename='$sFilename', parent='$iOwlParentId', created='$row->createdOn', description='$description', smodified='$row->modifiedOn', checked_out='0', major_revision='1', minor_revision='0', url='0', creatorid='$iOwlCreatorId', groupid='$iOwlGroupId'"; 
                    $result3 = $Owl->query($sInsertQuery);
                    fMoveDocToOwl($sForum, $iOwlParentId, $row->docId, $sFilename, $iAttachmentID);
                    $iAttachmentID++;
                    $sFilename = "";
                 }
                 else
                 {
                    $sFilename .= $cChar;
                 }
              }
            }
            else
            {
              if ($cChar == "}")
              {
                 $bWordWithSpaces = false;
              }
              else
              {
                    $sFilename .= $cChar;
              }
            }
         }
         $sInsertQuery = "INSERT INTO files set id='$iAttachmentID', name='$sTitle', security='0', filename='$sFilename', parent='$iOwlParentId', created='$row->createdOn', description='$description', smodified='$row->modifiedOn', checked_out='0', major_revision='1', minor_revision='0', url='0', creatorid='$iOwlCreatorId', groupid='$iOwlGroupId'"; 
         $result3 = $Owl->query($sInsertQuery);
         fMoveDocToOwl($sForum, $iOwlParentId, $row->docId, $sFilename, $iAttachmentID);
      }
      //**
      
      if ($DEBUG)
      {
         print("<br />DEBUG: InsertQuery -> $sInsertQuery<br />");
      }
     
     


   }

}


function fid_to_name($parent)
{
      global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   $Owl = DB::connect("mysql://root:@localhost/intranet",true);
   $query = "select name from folders where id = '$parent'";
   $result = $Owl->query($query);
   $row = $result->fetchRow(DB_FETCHMODE_OBJECT);

   return $row->name;
}



function fGetDirPath($parent)
{     
   $name = fid_to_name($parent);
   $navbar = "$name";
   $new = $parent;
   $Owl = DB::connect("mysql://root:@localhost/intranet",true);
   $query = "SELECT id FROM groups where name='$GroupName'";

   while ($new != "1")
   {
      $query = "select parent from folders where id = '$new'";
      $result = $Owl->query($query);
      $row = $result->fetchRow(DB_FETCHMODE_OBJECT);
      $newparentid = $row->parent;
      if ($newparentid == "") break;
      $name = fid_to_name($newparentid);
      $navbar = "$name/" . $navbar;
      $new = $newparentid;
   } 
   return $navbar;
}


function fMakeFolders($sForum, $iForumOffset)
{
   global $sForumPrefix, $sPrimaryGroup, $DEBUG, $sSiteScapeHiddenLocation, $sOwlDocumentLocation;

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape",true);
   $query = "select subRoots, createdBy, docId, parentId, documentType docLevel, title, parentFolder from ". $sForumPrefix .$sForum ."_d where subRoots is not NULL";
   $result = $SiteScape->query($query);

   $Owl = DB::connect("mysql://root:@localhost/intranet");

   while($row = $result->fetchRow(DB_FETCHMODE_OBJECT))
   {
         $iOwlDocId = $row->docId + $iForumOffset;
         $iOwlParentId = $row->parentFolder + $iForumOffset;
         if( $row->createdBy == '_none_')
         {
            $iOwlCreatorId = 1;
         }
         else
         {
            $iOwlCreatorId = fGetOwlUserId($row->createdBy);
         }

         $description = fGetAbstract($row->docId, $sForum);
         $description = ereg_replace("'","\\'", $description);
         $iOwlGroupId = fGetOwlGroupId($sPrimaryGroup);
         $title = ereg_replace("'","\\'", $row->title);
         $sOwlName  = trim($title);
         $sOwlName = ereg_replace("\/", "-", $sOwlName);


         $sInsertQuery = "INSERT INTO folders set id='$iOwlDocId', name='$sOwlName', description='$description', security='51', creatorid='$iOwlCreatorId',groupid='$iOwlGroupId',  ";
         
         if ($row->parentFolder) 
         {
            //$sInsertQuery .= "parent='$row->parentFolder'";
            $sInsertQuery .= "parent='$iOwlParentId'";
            $result3 = $Owl->query($sInsertQuery);
         }
         else
         {
            $sInsertQuery .= "parent='1'";
            $result3 = $Owl->query($sInsertQuery);
         }
         
         $sOsCommand = "mkdir \"" . $sOwlDocumentLocation . "/" . fGetDirPath($iOwlDocId) . "\"";
         system($sOsCommand);
         
         fInsertDocuments($row->docId, $sForum, $iForumOffset);
         if ($DEBUG)
         {
            print("DEBUG: InsertQuery -> $sInsertQuery<br />");
         }
   }

}
function fMigrateGroupMemberShip()
{
    global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   // tat__group_m (groupName, memberName)

   print("<H1> Migrating User Group Membership ....</H1>");


   $Owl = DB::connect("mysql://root:@localhost/intranet", true);
   $query = "SELECT id, username FROM users";
   $result = $Owl->query($query);

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape");

   while($row = $result->fetchRow(DB_FETCHMODE_OBJECT))
   {
    
      $query = "SELECT groupName FROM " .$sForumPrefix ."_group_m where memberName='$row->username'";
      $result1 = $SiteScape->query($query);

      while($row1 = $result1->fetchRow(DB_FETCHMODE_OBJECT))
      {
          
         $iOwlGroupId = fGetOwlGroupId($row1->groupName);
         //$query2 = "SELECT id FROM groups where name='$row1->groupName'";
         //$result2 = $Owl->query($query2);
         //$row3 = $result2->fetchRow(DB_FETCHMODE_OBJECT);

         //$sInsertQuery = "INSERT INTO membergroup set userid='$row->id', groupid='$row3->id'";
         $sInsertQuery = "INSERT INTO membergroup set userid='$row->id', groupid='$iOwlGroupId'";
         $result3 = $Owl->query($sInsertQuery);
         if ($DEBUG)
         {
             print("<br />DEBUG: InsertQuery =  $sInsertQuery<br />");
         }
      }
   }

   // close database connection
   $SiteScape->disconnect();
   $Owl->disconnect();
}

function fMigrateGroups()
{
    global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   // tat__group (modifiedBy, userName, createdOn, userType, title, createdBy, lcUserName)

   print("<H1> Migrating Groups ....</H1>");

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape");
   // execute query
   $query = "SELECT userName FROM ".$sForumPrefix."_group";
   $result1 = $SiteScape->query($query);

   $Owl = DB::connect("mysql://root:@localhost/intranet");

   while($row = $result1->fetchRow(DB_FETCHMODE_OBJECT))
   {

      $sInsertQuery = "INSERT INTO groups set name = '$row->userName'";
      $result2 = $Owl->query($sInsertQuery);
   }

   // get and print number of rows in resultset
   echo "\n[" . $result1->numRows() . " Groups Imported]\n";

   // close database connection
   $SiteScape->disconnect();
   $Owl->disconnect();
}


function fMigrateUsers()
{
    global $sForumPrefix, $sPrimaryGroup, $DEBUG;

   // tat__user (displayDebugInfo, userType, firstName, createdBy, ntAccountInfo, lastLogin, lastName, lcUserName, userName, org, sortName, title, pass_word, nativeLanguage, modifiedBy, IRC_client, photograph, createdOn)

   $primaryGroup = DB::connect("mysql://root:@localhost/intranet");
   // execute query
   $query = "SELECT * FROM groups where name='$sPrimaryGroup'";
   $result0 = $primaryGroup->query($query);
   $row0 = $result0->fetchRow(DB_FETCHMODE_OBJECT);
   $iPrimaryGroupid = $row0->id;
   $primaryGroup->disconnect();


   print("<H1> Migrating Users ....</H1>");

   $SiteScape = DB::connect("mysql://root:@localhost/sitescape");
   // execute query
   $query = "SELECT * FROM ". $sForumPrefix ."_user where userName <> 'admin' and userName <> 'anonymous'";
   $result1 = $SiteScape->query($query);

   $Owl = DB::connect("mysql://root:@localhost/intranet");

   while($row = $result1->fetchRow(DB_FETCHMODE_OBJECT))
   {

      switch ($row->nativeLanguage)
      {
         case "en":
            $language = 'English';
            break;
         case "fr":
            $language = 'Francais';
            break;
         case "de" :
            $language = 'Deutsch';
            break;
         default:
            $language = 'English';
            break;
      }
 

      $sInsertQuery = "INSERT INTO users set groupid ='$iPrimaryGroupid', username = '$row->userName', name='" . $row->firstName  . " " . $row->lastName . "', password='5f4dcc3b5aa765d61d8327deb882cf99', quota_max='0', quota_current='0', email='" .  $row->email . "', notify='0', attachfile='0', disabled='0', language='" . $language . "', maxsessions='2', noprefaccess='0', lastlogin='" . $row->lastLogin . "', curlogin='" . $row->lastLogin . "', lastnews='0', newsadmin='0', comment_notify='0'";
      if ($DEBUG)
      {
          print("<br />DEBUG: Query =  $sInsertQuery<br />");
      }
      $result2 = $Owl->query($sInsertQuery);
   }

   // get and print number of rows in resultset
   echo "\n[" . $result1->numRows() . " Users Imported]\n";

   // close database connection
   $SiteScape->disconnect();
   $Owl->disconnect();
}

?>
