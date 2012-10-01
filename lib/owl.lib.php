<?php

/**
 * owl.lib.php
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
 * $Id: owl.lib.php,v 1.98 2006/11/16 16:02:40 b0zz Exp $
 */
defined( 'OWL_INCLUDE' ) or die( 'Access Denied' );

define('INIT_USERNAME','USERNAME_EMPTY_GT_THAN_20_TAPERRED_WITH');

define ("NEW_FILE", "0");
define ("UPDATED_FILE", "1");
define ("NEW_COMMENT", "2");
define ("DELETED_FILE", "3");
define ("NEW_PASSWORD", "4");
define ("NEW_APPROVED", "5");
define ("REMINDER_APPROVED", "6");
define ("FINAL_APPROVED", "7");
define ("FINAL_AUTO_APPROVED", "8");
define ("REJECT_APPROVED", "9");
define ("ADMIN_PASSWORD", "10");
define ("APPROVED", "11");
define ("SELF_REG_USER", "12");

define ("LOGIN", "1");
define ("LOGIN_FAILED", "2");
define ("LOGOUT", "3");
define ("FILE_DELETED", "4");
define ("FILE_UPLOAD", "5");
define ("FILE_UPDATED", "6");
define ("FILE_DOWNLOADED", "7");
define ("FILE_CHANGED", "8");
define ("FILE_LOCKED", "9");
define ("FILE_UNLOCKED", "10");
define ("FILE_EMAILED", "11");
define ("FILE_MOVED", "12");
define ("FOLDER_CREATED", "13");
define ("FOLDER_DELETED", "14");
define ("FOLDER_MODIFIED", "15");
define ("FOLDER_MOVED", "16");
define ("FORGOT_PASS", "17");
define ("USER_REG", "18");
define ("FILE_VIEWED", "19");
define ("FILE_VIRUS", "20");
define ("FILE_COPIED", "21");
define ("FOLDER_COPIED", "22");
define ("FILE_LINKED", "23");
define ("USER_ADMIN", "24");
define ("TRASH_CAN", "25");
define ("FILE_ACL", "26");
define ("FOLDER_ACL", "27");
define ("FOLDER_DISTRIBUTE", "28");
define ("FOLDER_LINKED", "29");
define ("FILE_REVIEW", "30");
define ("FILE_APPROVED", "31");
define ("FILE_REJECTED", "32");
define ("FILE_PUBLISHED", "33");

require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");
require_once($default->owl_fs_root ."/lib/indexing.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");

require_once($default->owl_fs_root ."/lib/owlsess.class.php");
require_once($default->owl_fs_root ."/lib/owldb.class.php");  
require_once($default->owl_fs_root ."/lib/functions.lib.php");

if (file_exists($default->owl_fs_root ."/install"))
{
   die("Please Remove the Intall Directory");
}


if ($default->debug == true)
{ 
   // I think we have a bit of work to get Owl to run with E_NOTICE turned On ;-(
   error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   error_reporting (E_ERROR | E_WARNING | E_PARSE);
} 
else
{ 
   error_reporting (0);
} 
// 
// Support for reg.globals off 
//

if (!isset($inextfiles))
{
  $iFileCount = '';
  $iCurrentPage = '';
  $inextfiles = '';
  $nextfolders = '';
  $bDisplayFiles = '';
}

if(!empty($_GET[currentdb]) && is_numeric($_GET[currentdb]))
{
   $default->owl_current_db = $_GET[currentdb];
}
else
{
   if(!empty($_POST[currentdb]) && is_numeric($_POST[currentdb]))
   {
      $default->owl_current_db = $_POST[currentdb];
   }
   else
   {
      if(empty($default->owl_current_db))
      {
         $default->owl_current_db = $default->owl_default_db;
      }
   }
}


getprefs();

if (!EMPTY($_POST))
{
   extract(fMagicQuotes($_POST));
}
else if (!empty($HTTP_POST_VARS))
{
   extract(fMagicQuotes($HTTP_POST_VARS));
}
if (!EMPTY($_GET))
{
   extract(fMagicQuotes($_GET));
}
else if (!empty($HTTP_GET_VARS))
{
   extract(fMagicQuotes($HTTP_GET_VARS));
}
if (!EMPTY($_FILE))
{
   extract(fMagicQuotes($_FILE));
}
else if (!empty($HTTP_POST_FILES))
{
   extract(fMagicQuotes($HTTP_POST_FILES));
}

if (isset($username))
{
// Sanitize the sessions for tampering / XSS
   $username = strip_tags($username);
   if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $username))
   { 
      if (strlen($username) > 20 or empty($username))
      {
         $username=INIT_USERNAME;
      }
   }
}
else
{
   unset($username);
}


if (isset($filter) and !is_numeric($filter))
{
   $filter="";
}

if (isset($id) and !is_numeric($id))
{
   $aListofID = unserialize(stripslashes(stripslashes($id)));
   if (!is_array($aListofID))
   {
      // someone tapered with the ID?
      /// redirect to browse Page
      $id=0;
      $action="";
   }
}


require_once($default->owl_fs_root ."/lib/sort.lib.php");

if(!empty($_GET['currentdb']) and is_numeric($_GET['currentdb']))
{
   $default->owl_current_db = $_GET['currentdb'];
}
else
{
   if(!empty($_POST['currentdb']) and is_numeric($_POST['currentdb']))
   {
      $default->owl_current_db = $_POST['currentdb'];
   }
  else
  {
      if(empty($default->owl_current_db))
      {
         $default->owl_current_db = 0;
      }
  }
}

if (!isset($sess)) 
{
   if (!isset($_COOKIE["owl_sessid"]))
   {
      $sess = 0;
   }
   else
   {
      $sess = $_COOKIE["owl_sessid"];
   }
}
else
{
   if (isset($_COOKIE["owl_sessid"]))
   {
     $sess = $_COOKIE["owl_sessid"];
   }

}

  // Sanitize the sessions for tampering
   $sess = fOwl_ereg_replace(" ", "", $sess);

   if (! ereg("^[a-fA-F0-9]", $sess))
   {
      $sess="1";
   }

   if (strlen($sess) > 32)
   {
      $sess="1";
   }

if(!isset($default->owl_FileDir))
{
   $default->owl_FileDir  =  $default->owl_db_FileDir[$default->owl_default_db];
}

if (empty($parent))
{
   if (isset($default->HomeDir))
   {
      $parent = $default->HomeDir;
   }
}
else if (!is_numeric($parent))
{
   if (isset($default->HomeDir))
   {
      $parent = $default->HomeDir;
   }
   else
   {
      $parent = 1;
   }
}

if (!isset($expand) or !is_numeric($expand))
{
   if (isset($default->expand))
   {
      $expand = $default->expand;
   }
   else
   {
      $expand = '1';
   }
}

if (empty($curview) || !is_numeric($curview))
{
   $curview = 0;
}

if (!isset($loginname)) 
{
   $loginname = 0;
}
if (!isset($login))
{
   $login = 0;
}

if(!empty($sess))
{
   $sSaveCurrentDB = $default->owl_current_db;
   foreach ( $default->owl_db_id as $database )
   {
      $default->owl_current_db = $database;

      $sql = new Owl_DB;

      $sql->query("SELECT * from $default->owl_sessions_table where sessid = '$sess'");
      $sql->next_record();
      $numrows = $sql->num_rows($sql);
      if ($numrows == 1)
      {
         break;
      }
      $default->owl_current_db = $sSaveCurrentDB;
   }
}


global $cCommonDBConnection;
$cCommonDBConnection = new Owl_DB;
$cCommonDBConnection->connect();

$sql = $cCommonDBConnection;

if (empty($sql))
{
   $sql = new Owl_DB;
}

getuserprefs();

if ($default->force_ssl == "1")
{
   if($_SERVER['SERVER_PORT'] !== "443" || $_SERVER['HTTPS'] !== "on")
   {
      header("Location: https://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ."?sess=$sess");
      exit;
   }
}

// 
// Set the language from default or from the users file.
// NOTE: the messages here cannot be internationalized
// 
if (!isset($default->sButtonStyle)) 
{
   $default->sButtonStyle = $default->system_ButtonStyle;
}

gethtmlprefs();


if (isset($default->owl_lang))
{
   $langdir = "$default->owl_fs_root/locale/$default->owl_lang";
   if (is_dir("$langdir") != 1)
   {
      die("<br /><font size='4'><center>Path to the 'locale' directory was Not found: $langdir</center></font>");
   } 
   else
   {
      $sql->query("SELECT * from $default->owl_sessions_table where sessid = '$sess'");
      $sql->next_record();
      $numrows = $sql->num_rows($sql);
      $getuid = $sql->f("usid");
      if ($numrows == 1)
      {
         $sql->query("SELECT * from $default->owl_users_table where id = '$getuid'");
         $sql->next_record();
         $language = $sql->f("language"); 
         $default->sButtonStyle = $sql->f("buttonstyle");
         if (!$language)
         {
            $language = $default->owl_lang;
         } 
         if (file_exists("$default->owl_fs_root/locale/$language/language.inc"))
         {
            if (is_readable("$default->owl_fs_root/locale/$language/language.inc"))
            {
               require_once("$default->owl_fs_root/locale/$language/language.inc");
               $default->owl_lang = $language;
               if (!empty($owl_lang->charset))
               {
                  $default->charset = $owl_lang->charset;
               }
   $default->auth_type[0][0] = "0";
   $default->auth_type[0][1] = $owl_lang->auth_owl;
   $default->auth_type[1][0] = "1";
   $default->auth_type[1][1] = $owl_lang->auth_http;
   $default->auth_type[2][0] = "2";
   $default->auth_type[2][1] = $owl_lang->auth_pop3;
   $default->auth_type[3][0] = "3";
   $default->auth_type[3][1] = $owl_lang->auth_ldap;
   $default->auth_type[4][0] = "4";
   $default->auth_type[4][1] = $owl_lang->auth_radius;

            } 
            else
            {
               die("<br /><font size='4'><center>The webserver does not have read access to:
					     <br />The Language file '$default->owl_fs_root/locale/$language/language.inc'
				             <br />Please fix the permissions and try again</center></font>");
            } 
         } 
         else
         {
            die("<br /><font size='4'><center>The Language file '$default->owl_fs_root/locale/$language/language.inc' does not exists.</center></font>");
         } 
      } 
      else
      {
         if ($sess == 0)
         {
            $language = $default->owl_lang;
         } 
         if (file_exists("$default->owl_fs_root/locale/$default->owl_lang/language.inc"))
         {
            if (is_readable("$default->owl_fs_root/locale/$default->owl_lang/language.inc"))
            {
               require_once("$default->owl_fs_root/locale/$default->owl_lang/language.inc");
            } 
            else
            {
               die("<br /><font size='4'><center>The webserver does not have read access to:
				      	<br />The Language file '$default->owl_fs_root/locale/$default->owl_lang/language.inc'.
					<br />Please fix the permissions and try again</center></font>");
            } 
         } 
         else
         {
            die("<br /><font size='4'><center>The Language file '$default->owl_fs_root/locale/$default->owl_lang/language.inc' does not exists.</center></font>");
         } 
      } 
   } 
} 
else
{
   die("<br /><font size='4'><center>Unable to find language, please specify in config/owl.php.</center></font>");
} 

if ($default->use_file_expiry == 1)
{
   $sql = new Owl_DB;
   $dNow = $sql->now();
   $sql->query("SELECT id from $default->owl_files_table where expires < $dNow and expires > '0001-01-01 00:00:00'");
   $iSaveUID = $userid;
   if(isset($usergroupid))
   {
      $iSaveGID = $usergroupid;
   }
   $userid = 1;
   $usergroupid = 0;
   while ($sql->next_record())
   {
      delFile($sql->f('id'), "file_expiry");
   }
   $userid = $iSaveUID;
   if(isset($iSaveGID))
   {
      $usergroupid = $iSaveGID;
   }
}

if ($sess)
{
   $ok = verify_session($sess);
   $temporary_ok = $ok["bit"];
   $userid = $ok["userid"];
   $default->owl_current_db = $ok["currentdb"];
   $default->owl_FileDir  =  $default->owl_db_FileDir[$default->owl_current_db];

   getuserprefs();
   gethtmlprefs();


   $usergroupid = $ok["groupid"];

   if ($ok["bit"] != "1")
   { 
      if ($default->remember_me or isset($_COOKIE['owl_sessid']))
      {
         setcookie ("owl_sessid", "");
      }
      if ($parent == "" || $fileid == "")
      {                    
	     header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=6&currentdb=$default->owl_current_db");
      }                 
      else              
      {                 
	     header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=6&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
      }              
      exit;
   } 
   else
   {
      $lastused = time();
      if (!($default->remember_me))
      {
         $sql->query("UPDATE $default->owl_sessions_table set lastused = '$lastused' where usid = '$userid' and sessid = '$sess'");
      } 
      elseif (!(isset($_COOKIE["owl_sessid"])))
      {
         $sql->query("UPDATE $default->owl_sessions_table set lastused = '$lastused' where usid = '$userid' and sessid = '$sess'");
      }
   } 
} 
else
{
  $usergroupid = "-1";
  $userid = "-1";

  $db = (int) $default->owl_current_db;
  if (!isset($default->owl_db_FileDir[$db]))
  {
    $db = (int) $default->owl_default_db;
  }
  $default->owl_FileDir  =  $default->owl_db_FileDir[$db];
}

global $aMyGroupAdmin;
$aMyGroupAdmin = fGetMyAdminGroups ($userid);



if (!$sess && !$loginname && !$login)
{
   if (!isset($fileid) and !isset($dlfileid))
   {
      $sql = new Owl_DB;
      $sql->query("SELECT * from $default->owl_users_table where id = '$default->anon_user'");
      $sql->next_record();
      if ($sql->num_rows() == 1)
      {
         $accountname = $sql->f("name");
         if ($sql->f("disabled") != 1)
         {
            $ip = fGetClientIP();
            $Resutls = 0;
            foreach($default->anonymous_user_net_access as $sNetworks)
            {
               if (netMatch($sNetworks, $ip) === true)
               {
                  $iResutls++;
               }
            }

            if ($iResutls > 0 or empty($default->anonymous_user_net_access))
            {
               $userid = $default->anon_user;
            }
            else
            {
               if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/index.php")
               {
                  if ($default->debug == true)
                  {
                     printError("DEBUG: ANONYMOUS ACCESS DENIED FROM : $ip ");
                  }
                  else
                  {
                     printError("ANONYMOUS ACCESS DENIED");
                  }
               }
            }
         }
         else
         {
             if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php" and $default->WebDAV === false)
	     {
               if(isset($parent) and is_numeric($parent))
               {
                  header("Location: " . $default->owl_root_url . "/index.php?login=1&parent=$parent&currentdb=$default->owl_current_db");
               }
               else
               {
                  header("Location: " . $default->owl_root_url . "/index.php?login=1&currentdb=$default->owl_current_db");
               }
               exit;
            }
         } 
      } 
      else
      {
         if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
         {
            if(isset($parent) and is_numeric($parent))
            {
               header("Location: " . $default->owl_root_url . "/index.php?login=1&parent=$parent&currentdb=$default->owl_current_db");
            }
            else
            {
               header("Location: " . $default->owl_root_url . "/index.php?login=1&currentdb=$default->owl_current_db");
            }
            exit;
         }
      } 
   } 
   else
   {
      //if ($default->anon_ro > 3)
      //{
         //header("Location: " . $default->owl_root_url . "/index.php?login=1&fileid=$fileid&parent=$parent");
      //}
      //else
      //{
         $sql = new Owl_DB;
         $sql->query("SELECT * from $default->owl_users_table where id = '$default->anon_user'");
         $sql->next_record();
         if ($sql->num_rows() == 1)
         {
            $accountname = $sql->f("name");
            if ($sql->f("disabled") != 1)
            {
               $ip = fGetClientIP();
               $iResutls = 0;
               foreach($default->anonymous_user_net_access as $sNetworks)
               {
                  if (netMatch($sNetworks, $ip) === true)
                  {
                     $iResutls++;
                  }
               }
   
               if ($iResutls > 0 or empty($default->anonymous_user_net_access))
               {
                  $userid = $default->anon_user;
               }
               else
               {
                  if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/index.php")
                  {
                     if ($default->debug == true)
                     {
                        printError("DEBUG: ANONYMOUS ACCESS DENIED FROM : $ip ");
                     }
                     else
                     {
                        printError("ANONYMOUS ACCESS DENIED");
                     }
                  }
               }
               if (isset($fileid) and empty($anon))
               {
                  if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
                  {
                     header("Location: " . $default->owl_root_url . "/index.php?login=1&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db&anon=1");
                  }
               }
               if (isset($dlfileid) and empty($anon))
               {
                  if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
                  {
                     header("Location: " . $default->owl_root_url . "/index.php?login=1&dlfileid=$dlfileid&parent=$parent&currentdb=$default->owl_current_db&anon=1");
                  }
               }
            }
            else
            {
               if (isset($fileid))
			   {
                  if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
                  {
                     header("Location: " . $default->owl_root_url . "/index.php?login=1&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
                  }
			   }
               if (isset($dlfileid))
			   {
                  if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
                  {
                     header("Location: " . $default->owl_root_url . "/index.php?login=1&dlfileid=$dlfileid&parent=$parent&currentdb=$default->owl_current_db");
                  }
			   }
            } 
         } 
         else
         {
            if (isset($fileid))
			{
			   if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
               {	
                  header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
               }
			}
            if (isset($dlfileid))
			{
			   if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/register.php")
               {	
                  header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&dlfileid=$dlfileid&parent=$parent&currentdb=$default->owl_current_db");
               }
			}
         } 
      //}
   } 
} 
//print("DB: $default->owl_current_db") ;
//print("L: $_POST[loginname] -- $_GET[loginname]") ;
//print("<br />S: $sess") ;
//exit;

if (!$sess && $loginname)
{
   $sql = new Owl_DB;
   $sql->query("SELECT * from $default->owl_users_table where id = '$default->anon_user'");
   $sql->next_record();
   if ($sql->num_rows() == 1)
   {
      if ($sql->f("disabled") != 1)
      {
         $userid = $default->anon_user;
      } 
      else
      {
         $verified = verify_login($loginname, $password);
         $sFailiure = '';
         if (!empty($verified['bit']))
         {
            $sFailiure = "&failure=" . $verified['bit'];
         }
         header("Location: " . $default->owl_root_url . "/index.php?login=1$sFailiure");
      } 
   } 
   else
   {
      header("Location: " . $default->owl_root_url . "/index.php?login=1");
   } 
} 

if (!$sess && $login)
{
   if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/index.php")
   {
      header("Location: " . $default->owl_root_url . "/index.php?login=1");
      exit;
   }
} 
?>
