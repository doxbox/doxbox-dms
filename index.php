<?php
/**
 * index.php -- Main page -- Login Page
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
 * à
 * $Id: index.php,v 1.17 2006/09/28 17:35:16 b0zz Exp $
 */

ob_start();
if (bcheckLibExists(dirname(__FILE__)."/config/owl.php")) require_once(dirname(__FILE__)."/config/owl.php");
$out = ob_get_clean();

if (bcheckLibExists($default->owl_fs_root ."/lib/disp.lib.php")) require_once($default->owl_fs_root ."/lib/disp.lib.php");
if (bcheckLibExists($default->owl_fs_root ."/lib/xtpl.lib.php")) require_once($default->owl_fs_root ."/lib/xtpl.lib.php");

$default->owl_lang =  fGetBrowserLanguage();


if (bcheckLibExists($default->owl_fs_root ."/lib/security.lib.php")) require_once($default->owl_fs_root ."/lib/security.lib.php"); 
if (bcheckLibExists($default->owl_fs_root ."/lib/owl.lib.php")) require_once($default->owl_fs_root ."/lib/owl.lib.php"); 

if (bcheckLibExists($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php")) require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/index.xtpl");
$xtpl = new XTemplate("html/index.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

if ($default->debug == true)
{
   bcheckLibExists($default->owl_tmpdir, "(Site Feature) Owl TmpDir: " . $default->owl_tmpdir . " is not accessible or is not writeable<br /> (Create IT, or Changed the location in the admin Site Features Section)");
}

if (isset($_COOKIE["owl_sessid"]) and $default->remember_me)
{
   if ($login ==  "0")
   {
      if (!(strcmp($login, "logout") == 0))
      {
         if ( isset($_POST['loginname']) and isset($_POST['password']))
         {
            $sql = new Owl_DB;

            $sess = $_COOKIE["owl_sessid"];

            if ($default->active_session_ip) 
            {
               $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip <> '0'");
            } 
            else 
            {
               $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip = '0'");
            }
            setcookie ("owl_sessid", "");
         }
         else
         {
            $sess = $_COOKIE["owl_sessid"];
            $sql = new Owl_DB;
            $sql->query("SELECT usid FROM $default->owl_sessions_table WHERE sessid = '$sess'");
            $sql->next_record();
            $uid = $sql->f("usid");

            $sql->query("SELECT curlogin FROM $default->owl_users_table WHERE id = '$uid'");
            $sql->next_record();
            $curlogin = $sql->f("curlogin");

            $sql->query("update $default->owl_users_table set lastlogin = '" . $curlogin . "' WHERE id = '$uid'");
            $dNow = $sql->now();
            $sql->query("update $default->owl_users_table set curlogin = $dNow WHERE id = '$uid'");

            
            if (isset($parent) and is_numeric($parent))
            {
               header("Location: browse.php?sess=$sess&parent=$parent");
            }
            else
            {
               header("Location: browse.php?sess=$sess");
            }
            exit;
         }
      }
   }
}
else
{
   setcookie ("owl_sessid", "");
}

// 
// Function to check if the required libraries exists
// and are readable by the web server.
// and issue a more significant message
// Maybe we need this in other files as well, I'll wait and
// see.


function fPrintLoginPage($message = "", $severity)
{
   global $default, $owl_lang, $language, $parent, $fileid, $dlfileid, $anon_disabled, $folderid ;
   global $xtpl;


   $xtpl->assign('MOTD', fGetMOTD());
   $xtpl->assign('LOGO_LEFT', "&nbsp;");
   $xtpl->assign('LOGO_CENTER', "&nbsp;");
   $xtpl->assign('LOGO_RIGHT', "&nbsp;");

   if ($default->logo_location == 1)
   {
      $xtpl->assign('LOGO_LEFT', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/$default->owl_logo\" border=\"0\" alt=\"$default->site_title\" />");

   }

   if ($default->logo_location == 2)
   {
      $xtpl->assign('LOGO_CENTER', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/$default->owl_logo\" border=\"0\" alt=\"$default->site_title\" />");
   }

   if ($default->logo_location == 3)
   {
      $xtpl->assign('LOGO_RIGHT', "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/$default->owl_logo\" border=\"0\" alt=\"$default->site_title\" />");
   
   }

   $xtpl->assign("INFO_MESSAGE", "&nbsp;");
   if (!empty($message))
   {
      $xtpl->assign("INFO_MESSAGE", $message);
      $xtpl->assign("SEVERITY", $severity);
      $xtpl->parse('main.infomsg');
   }

   $urlArgs = array();
   if (isset($fileid) and is_numeric($fileid))
   {
      $urlArgs['fileid']    = $fileid;
   }
   if (isset($dlfileid) and is_numeric($dlfileid))
   {
      $urlArgs['dlfileid']    = $dlfileid;
   }
   if (isset($parent) and is_numeric($parent))
   {
      $urlArgs['parent']    = $parent;
   }
   if (isset($folderid) and is_numeric($folderid))
   {
      $urlArgs['folderid']    = $folderid;
   }

   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
   $xtpl->assign('SITE_TITLE', $default->site_title);
   
   if (count($default->owl_db_display_name) > 1)
   {
      $xtpl->assign('REPOSITORY_LABEL', $owl_lang->repository_list);

      $i = 0;
      if (isset($_COOKIE["owl_dbid"]))
      {
         $iDefaultDB = $_COOKIE["owl_dbid"];
      }
      elseif (isset($_POST['currentdb']) and is_numeric($_POST['currentdb']))
      {
         $iDefaultDB = $_POST['currentdb'];
      }
      elseif (isset($default->owl_current_db))
      {
         $iDefaultDB = $default->owl_current_db;
      }
      else
      {
         $iDefaultDB = $default->owl_default_db;
      }

      foreach($default->owl_db_display_name as $database)
      {
	     
         $xtpl->assign('SELECT_VALUE', $i);

         if ( $i == $iDefaultDB)
         {
            $xtpl->assign('SELECT_SELECTED', " selected=\"selected\"");
         }
		 else
		 {
            $xtpl->assign('SELECT_SELECTED', "");
		 }
         $xtpl->assign('SELECT_LABEL', $database);
         $i++;
	 $xtpl->parse('main.Databases.Options');
      }
      $xtpl->parse('main.Databases');
   }
   else
   {
      $iDefaultDB = $default->owl_default_db;
   }

   $xtpl->assign("USERNAME_LABEL", $owl_lang->username);
   $xtpl->assign("PASSWORD_LABEL", $owl_lang->password);

   $xtpl->assign("BTN_LOGIN_VALUE", $owl_lang->btn_login);
   $xtpl->assign("BTN_LOGIN_ALT", $owl_lang->alt_btn_login);

   if ($default->remember_me)
   {
      $xtpl->assign("REMEMBERME_LABEL", $owl_lang->remember_me_checkbox);
      $xtpl->parse('main.RememberMe');
   }

   if ($anon_disabled != 1)
   {
      $ip = fGetClientIP();

      $iResults = 0;
      foreach($default->anonymous_user_net_access as $sNetworks)
      {
         if (netMatch($sNetworks, $ip) == true)
         {
            $iResults++;
         }
      }

      if ($iResults > 0 or empty($default->anonymous_user_net_access))
      {
         if(isset($fileid))
         {
            $sHilite = "browse.php?fileid=$fileid&anon=1&currentdb=$default->owl_current_db";
         }
         else if(isset($dlfileid))
         {
            $sHilite = "download.php?dlfileid=$dlfileid&parent=$parent&anon=1&currentdb=$default->owl_current_db";
         }
         else
         {
            $sHilite = "browse.php?anon=1&currentdb=$default->owl_current_db";
         }

         $xtpl->assign("ANON_LABEL", $owl_lang->anonymous);
         $xtpl->assign("ANON_SCRIPT", " onclick=\"delete_cookie ( 'owl_sessid' );\"");
         $xtpl->assign("ANON_URL", "$sHilite");
         $xtpl->parse('main.AnonAccess');
      }
   }

   if ($default->self_reg == 1)
   {
      $xtpl->assign("REGISTER_URL", "register.php?myaction=register&c=$iDefaultDB");
      $xtpl->assign("REGISTER_LABEL", $owl_lang->like_register);
      $xtpl->parse('main.SelfHelp.Register');
   }

   if ($default->self_reg == 1 and $default->forgot_pass == 1)
   {
      $xtpl->parse('main.SelfHelp.Separator');
   }

   if ($default->forgot_pass == 1)
   {
      $xtpl->assign("FORGOT_URL", "register.php?myaction=forgot&c=$iDefaultDB");
      $xtpl->assign("FORGOT_LABEL", $owl_lang->forgot_pass);
      $xtpl->parse('main.SelfHelp.ForgotPass');
   }
   $xtpl->parse('main.SelfHelp');
}

function bcheckLibExists ($filename, $sSubMessage = "")
{
   global $default, $owl_lang;
   if (file_exists("$filename"))
   {
      if (is_readable("$filename"))
      {
         return true;
      } 
      else
      {
         if (empty($sSubMessage))
         { 
            $sSubMessage =  $sSubject = sprintf($owl_lang->debug_webserver_no_access, $filename);
         }
         die("<br /><font size=\"4\"><center>$sSubMessage</center></font>");
      } 
   } 
   else
   {
      if (empty($sSubMessage))
      { 
         $sSubMessage =  $sSubject = sprintf($owl_lang->debug_file_not_exist, $filename);
      }
      die("<br /><font size=\"4\"><center>$sSubMessage</center></font>");
   } 
} 
if (!isset($failure)) $failure = 0;
if (!$login) $login = 1;

if($default->auth == 1 and isset($_SERVER['PHP_AUTH_USER']))
{
   $_POST['loginname'] = $_SERVER['PHP_AUTH_USER'];
}

if (($_POST['loginname'] and ($default->auth == 0 or $default->auth == 3)) or ($default->auth == 1 and isset($_POST['loginname']) and $_GET['login'] <> "logout"))
{
//exit("");
   $verified["bit"] = 0;
   $verified = verify_login($_POST['loginname'], $_POST['password']);
			//print("<pre>HERE");
			//print_r($_POST);
			//print_r($verified);

   if ($verified["bit"] == 1)
   {
       if ($default->auth == 0)
       {
          $sql = new Owl_DB;
          $sql->query("SELECT change_paswd_at_login, passwd_last_changed, expire_account FROM $default->owl_users_table WHERE id = '" . $verified["uid"] . "'");
          $sql->next_record();
          $sExpiredAccount = $sql->f("expire_account");
          if (empty($sExpiredAccount))
          {
             $dAccountExpire = 0;
          }
          else
          {
             $dAccountExpire = date("d-m-Y H:i:s", strtotime($sql->f("expire_account")));
          } 
          $sPasswdLastChanged = $sql->f("passwd_last_changed");
          if (isset($sPasswdLastChanged))
          {
             if ($sPasswdLastChanged == '0000-00-00 00:00:00')
             {
                $dLastChanged = 0;
             }
             else
             {
                $dLastChanged = date("d-m-Y H:i:s", strtotime($sPasswdLastChanged));
             }
          }
          else
          {
             $dLastChanged = 0;
          } 
          $dateTo = date("d-m-Y H:i:s", strtotime('now'));
    
          $diffd = getDateDifference($dLastChanged, $dateTo, 'd');
          $dExpireDiff = getDateDifference($dAccountExpire, $dateTo, 'd');
    
          $userid = $verified["uid"];
          $usergroupid = $verified["group"];
          if ($dExpireDiff > 0 and $sql->f("expire_account") != "")
          {
             owl_syslog(LOGIN_FAILED, $verified["uid"], 0, 0, $owl_lang->log_login_expired . $verified["user"], "LOGIN");
             header("Location: index.php?login=1&failure=2");
             exit;
          }
          
          if (isset($parent) and is_numeric($parent))
          {
             $verified["homedir"] = $parent;
          }
          if ( $sql->f("change_paswd_at_login") == 1 or $diffd > $default->change_password_every)
          {
             if ( $sql->f("change_paswd_at_login") == 1)
             {
                header("Location: register.php?myaction=changepass&uid=" . $verified["uid"] . "&parent=" . $verified["homedir"] . "&c=" . $default->owl_current_db);
                exit;
             }
             else
             {
                if (!fIsAdmin() and $default->change_password_every > 0)
                {
                   header("Location: register.php?myaction=changepass&uid=" . $verified["uid"] . "&parent=" . $verified["homedir"] . "&c=" . $default->owl_current_db);
                   exit;
                }
             }
          } 
          $userid = $verified["uid"];
          $usergroupid = $verified["group"];
       }
       else
       {
          $userid = $verified["uid"];
          $usergroupid = $verified["group"];
       }

      $session = new Owl_Session;
      $uid = $session->Open_Session(0, $verified["uid"]);
      $id = 1;

      /**
       * If an admin signs on We want to se the admin menu
       * Not the File Browser.
       */
      owl_syslog(LOGIN, $verified["uid"], 0, 0, $owl_lang->log_login_det . $verified["user"], "LOGIN");

     if ($default->notify_of_admin_login == 1 and $verified["uid"] == 1) // uid 1 = Administrator
     {
        $ip = fGetClientIP();
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
        $mail->AddAddress("$default->notify_of_admin_login_email");
        $mail->AddReplyTo("$default->owl_email_replyto", "OWL Intranet");
                                                                                                                                                                                                    
        $mail->WordWrap = 50; // set word wrap to 50 characters
        $mail->IsHTML(true); // set email format to HTML
        $mail->Subject = $owl_lang->admin_login_subject;
        $mail->Body = "<html><body>";
        $mail->Body .= $owl_lang->admin_login_date  . date($owl_lang->localized_date_format, mktime()) . "<br />";
        $mail->Body .= $owl_lang->admin_login_from . " " . $ip . " (" .  fGetHostByAddress($ip) . ")<br /><br />";
        $mail->Body .= "</body></html>";

        if (!$mail->Send())
        {
           printError("$owl_lang->err_email", $mail->ErrorInfo);
        }
     }  


      $sql->query("SELECT curlogin, logintonewrec FROM $default->owl_users_table WHERE id = '" . $verified["uid"] . "'");
      $sql->next_record();
      $curlogin = $sql->f("curlogin");
      $logintonewrec = $sql->f("logintonewrec");
      $sql->query("UPDATE $default->owl_users_table SET lastlogin = '" . $curlogin . "' WHERE id = '" . $verified["uid"] . "'");
      $dNow = $sql->now();
      $sql->query("UPDATE $default->owl_users_table SET login_failed = '0' , curlogin = $dNow WHERE id = '" . $verified["uid"] . "'");

      //$usergroupid = $verified["group"];
      //$userid = $verified["uid"];

      $clean = ob_get_contents(); 
      ob_end_clean();  

      global $bAdminCache;
      $bAdminCache = false;

      if (fIsAdmin(true))
      {
         if (!isset($fileid) and !isset($dlfileid))
         {
            if($default->admin_login_to_browse_page)
            {
               header("Location: browse.php?sess=" . $uid->sessdata["sessid"] . "&parent=" . $verified["homedir"]);
               exit;
            }
            else
            {
               header("Location: admin/index.php?sess=" . $uid->sessdata["sessid"]);
               exit;
            }
         }
         else if (!isset($dlfileid))
         {
            header("Location: browse.php?sess=" . $uid->sessdata["sessid"] . "&parent=$parent&fileid=$fileid");
            exit;
         }
         else
         {
            header("Location: download.php?sess=" . $uid->sessdata["sessid"] . "&parent=$parent&dlfileid=$dlfileid");
            exit;
         }
      } 
      else
      {
         if ($logintonewrec == 1)
         {
            $bNewFiles = 0;
            $sql->query("SELECT id, parent FROM $default->owl_files_table where created > '$curlogin' AND approved = '1'");
            while($sql->next_record())
            {
               if(check_auth($sql->f("id"), "file_download", $userid, false, false) == 1)
               {
                  $sDirectoryPath = get_dirpath($sql->f("parent"));
                  $pos = strpos($sDirectoryPath, "$default->version_control_backup_dir_name");
                  if (!(is_integer($pos) && $pos))
                  {
                     $bNewFiles = 1;
                     break;
                  }
               }
            }

            if ($bNewFiles)
            {
               header("Location: showrecords.php?sess=" . $uid->sessdata["sessid"] . "&type=n");
               exit;
            }
         }
         if (!isset($fileid) and !isset($dlfileid))
         {
            header("Location: browse.php?sess=" . $uid->sessdata["sessid"] . "&parent=" . $verified["homedir"] );
            exit;
         }
         else if (!isset($dlfileid))
         {
            header("Location: browse.php?sess=" . $uid->sessdata["sessid"] . "&parent=$parent&fileid=$fileid");
            exit;
         }
         else
         {
            header("Location: download.php?sess=" . $uid->sessdata["sessid"] . "&parent=$parent&dlfileid=$dlfileid");
            exit;
         }
      } 
   } 
   else
   {
      if ($default->enable_lock_account == 1 and is_numeric($verified["uid"]))
      {
         $sql->query("SELECT login_failed FROM $default->owl_users_table WHERE disabled = '0' AND id = '" . $verified["uid"] . "'");
         while($sql->next_record())
         {
            $iFailures = $sql->f("login_failed") + 1;
            if ($iFailures >=  $default->lock_account_bad_password)
            {
               $sql->query("UPDATE $default->owl_users_table SET disabled = '1', login_failed = '0' WHERE id = '" . $verified["uid"] . "'");
               owl_syslog(LOGIN_FAILED, $verified["uid"], 0, 0, $owl_lang->log_login_too_many_attempts . $verified["user"], "LOGIN");
            }
            else
            {
               $sql->query("UPDATE $default->owl_users_table SET login_failed = '" . $iFailures . "' WHERE id = '" . $verified["uid"] . "'");
            }
         }
      }

     $sUrlMod = '';
      if (isset($parent) and is_numeric($parent))
      {
         $sUrlMod = "&parent=$parent";
         $sSep = "&";
      }
      if (isset($fileid) and is_numeric($fileid))      
	  {
         $sUrlMod .= $sSep . "fileid=$fileid";
      }

      if ($verified["bit"] == 2)
      {
         owl_syslog(LOGIN_FAILED, $verified["uid"], 0, 0, $owl_lang->log_login_det . $verified["user"] . " " . $owl_lang->logindisabled, "LOGIN");
         header("Location: index.php?login=1&failure=2" . $sUrlMod);
      }
      else
      {
         if ($verified["bit"] == 3)
         {
            if ($default->auth == 0)
            {
               owl_syslog(LOGIN_FAILED, $verified["uid"], 0, 0, $owl_lang->log_login_det . $verified["user"] . " " . $owl_lang->toomanysessions, "LOGIN");
               header("Location: index.php?login=1&failure=3" . $sUrlMod);
            }
            else
            {
               printError("$owl_lang->toomanysessions");
            }
         }
         else
         {
            owl_syslog(LOGIN_FAILED, $verified["uid"], 0, 0, $owl_lang->log_login_det . $verified["user"] , "LOGIN");
            header("Location: index.php?login=1&failure=1" . $sUrlMod);
         }
      }
   }
} 

// CHECK IF THE ANONYMOUS USER IS DISABLELD
$sql = new Owl_DB;
$anon_disabled = 1;


$sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$default->anon_user'");
if ($sql->num_rows() == 1)
{
   $sql->next_record();
   $anon_disabled = $sql->f("disabled");
} 

if (($login == 1) or ($failure > 0))
{
   include_once($default->owl_fs_root . "/lib/header.inc");
   include_once($default->owl_fs_root . "/lib/login_header.inc");

   switch ($failure)
   {
      case 1: 
         $message = "$owl_lang->loginfail<br />\n";
         $severity = 'msg_warning';
         break;
      case 2: 
         $message = "$owl_lang->logindisabled<br /><br />\n";
         $severity = 'msg_error';
         break;
      case 3: 
         $message = "$owl_lang->toomanysessions<br />\n";
         $severity = 'msg_error';
         break;
      case 4: 
         $message = "$owl_lang->err_login<br />\n";
         $severity = 'msg_warning';
         break;
      case 5: 
         $message = "$owl_lang->sesstimeout\n";
         $severity = 'msg_error';
         break;
      case 6: 
         $message = "$owl_lang->invalidsess\n";
         $severity = 'msg_error';
         break;
      case 7: 
         $message = "$owl_lang->sessinuse\n";
         $severity = 'msg_error';
         break;
      case 8: 
         $message = "$owl_lang->err_unauthorized\n";
         $severity = 'msg_error';
         break;
      case 9: 
         $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess'");
         $message = "SYSTEM IS MAINTENANCE MODE TRY AGAIN LATER\n";
         $severity = 'msg_error';
         break;
      default:
         $message = "";
         $severity = 'msg_info';
         break;
   }
?>
<?php
/*
<! -- span style:text-align="left";>
<xmp>
   1. Code to add the Number of New Comments or new Files or Updated Files etc.
   2. // Path to our font file
   3. $font = 'arial.ttf';
   4. $fontsize = 10;
   5.
   6. // array of random quotes
   7. $quotes = array(
   8. "Did you hear about the guy whose whole left side was cut off? He's all right now.",
   9. "There was a sign on the lawn at a drug re-hab center that said 'Keep off the Grass'.",
  10. "Police were called to a daycare where a three-year-old was resisting a rest.",
  11. "A hole has been found in the nudist camp wall. The police are looking into it.",
  12. "When a clock is hungry it goes back four seconds.",
  13. "Time flies like an arrow. Fruit flies like a banana.",
  14. "Local Area Network in Australia: the LAN down under.",
  15. "Alcohol and calculus don't mix so don't drink and derive.");
  16.
  17. // generate a random number with range of # of array elements
  18. $pos = rand(0,count($quotes)-1);
  19. // get the quote and word wrap it
  20. $quote = wordwrap($quotes[$pos],20);
  21.
  22. // create a bounding box for the text
  23. $dims = imagettfbbox($fontsize, 0, $font, $quote);
  24.
  25. // make some easy to handle dimension vars from the results of imagettfbbox
  26. // since positions aren't measures in 1 to whatever, we need to
  27. // do some math to find out the actual width and height
  28. $width = $dims[4] - $dims[6]; // upper-right x minus upper-left x
  29. $height = $dims[3] - $dims[5]; // lower-right y minus upper-right y
  30.
  31. // Create image
  32. $image = imagecreatetruecolor($width,$height);
  33.
  34. // pick color for the background
  35. $bgcolor = imagecolorallocate($image, 100, 100, 100);
  36. // pick color for the text
  37. $fontcolor = imagecolorallocate($image, 255, 255, 255);
  38.
  39. // fill in the background with the background color
  40. imagefilledrectangle($image, 0, 0, $width, $height, $bgcolor);
  41.
  42. // x,y coords for imagettftext defines the baseline of the text: the lower-left corner
  43. // so the x coord can stay as 0 but you have to add the font size to the y to simulate
  44. // top left boundary so we can write the text within the boundary of the image
  45. $x = 0;
  46. $y = $fontsize;
  47. imagettftext($image, $fontsize, 0, $x, $y, $fontcolor, $font, $quote);
  48.
  49. // tell the browser that the content is an image
  50. header('Content-type: image/png');
  51. // output image to the browser
  52. imagepng($image);
  53.
  54. // delete the image resource
  55. imagedestroy($image);
  56.
</xmp>
</span>
-->
*/
if ($_SERVER['HTTP_HOST'] == 'foss.bozzit.com')
{
?>
<table border="1">
   <tr>
      <td> <H3>PHP (Bozz)</H3> </td>
      <td> <H3>CSS / HTML (Killo)</H3> </td>
   </tr>
   <tr>
      <td>use convert instead of pdftoppm to generate pdf thumnails</td>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td>FINISH html_head.xtpl + Cleanup [head][/head] move all scripts to the header replace with jquery / css?</td>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td> mod_add_file  Doctype Admin Add row to Table</td>
      <td> &nbsp;</td>
   </tr>
   <tr>
      <td> Use JQuery Ajax instead?  Workspace/jQAjax.html</td>
      <td> &nbsp;</td>
   </tr>
   <tr>
      <td>  JUPLOAD UPDATE WITH VERSION CONTROL </td>
      <td> &nbsp;</td>
   </tr>
   <tr>
      <td>  FIX ALL NOTICES </td>
      <td> &nbsp; </td>
   </tr>
   <tr>
      <td>  http://speckyboy.com/2009/12/17/10-useful-jquery-form-validation-techniques-and-tutorials-2/ </td>
      <td> &nbsp;</td>
   </tr>
   <tr>
      <td>  IE issue with AJAX Doctypes Load, if you change the value of a select box in modify.php, and go back to modify.php the old value is still shown:https://groups.google.com/group/comp.lang.javascript/browse_frm/thread/f5213cbae40229cf/552cbda3521fab6e?q=IE+name+dynamic+element&rnum=2&hl=en </td>
      <td> &nbsp;</td>
   </tr>
</table>
<?php
}
   if(!isset($message))
   {
      $message = '';
      $severity = 'msg_info';
   }
   else
   {
      $message = strip_tags($message);
   }
   fPrintLoginPage($message, $severity);
   include_once($default->owl_fs_root . "/lib/login_footer.inc");
   $xtpl->parse('main');
   $xtpl->out('main');
   exit;
} 

if ($login == "logout")
{
   include_once($default->owl_fs_root . "/lib/header.inc");
   include_once($default->owl_fs_root . "/lib/login_header.inc");
   if ($default->auth == 0 or $default->auth == 2)
   {
      if (!isset($_COOKIE["owl_sessid"]))
      {
         $sql = new Owl_DB;
         if ($default->active_session_ip) 
         {
            $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip <> '0'");
         } 
         else 
         {
            $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip = '0'");
         }
      }
      $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
      if (file_exists($tmpDir))
      {
         myDelete($tmpDir);
      }

      $message = "$owl_lang->successlogout<br />\n";

      owl_syslog(LOGOUT, $userid, 0, 0, $owl_lang->log_detail, "LOGIN");
   
      fPrintLoginPage($message, 'msg_info');

      include_once($default->owl_fs_root . "/lib/login_footer.inc");
      $xtpl->parse('main');
      $xtpl->out('main');
   }
   else
   {
      if (!isset($_COOKIE["owl_sessid"]))
      {
         $sql = new Owl_DB;
         if ($default->active_session_ip) 
         {
            $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip <> '0'");
         } 
         else 
         {
            $sql->query("DELETE FROM $default->owl_sessions_table WHERE sessid = '$sess' and ip = '0'");
         }
      }
      $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
      if (file_exists($tmpDir))
      {
         myDelete($tmpDir);
      }

      $message = "$owl_lang->successlogout<br />\n";
      owl_syslog(LOGOUT, $userid, 0, 0, $owl_lang->log_detail, "LOGIN");

      fPrintLoginPage($message, 'msg_info');
      include_once($default->owl_fs_root . "/lib/login_footer.inc");
      $xtpl->parse('main');
      $xtpl->out('main');
   }
   exit;
} 
?>
