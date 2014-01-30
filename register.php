<?php

/**
 * register.php
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
 * $Id: register.php,v 1.1 2006/01/05 19:41:23 b0zz Exp $
*/

ob_start();
require_once(dirname(__FILE__)."/config/owl.php");
$out = ob_get_clean();
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");

$c = $_GET['c'];

if (!empty($c) and is_numeric($c))
{
   $default->owl_current_db = $c;
}

$default->owl_lang =  fGetBrowserLanguage();

require_once($default->owl_fs_root ."/lib/owl.lib.php");


if ($default->registration_using_captcha)
{
   require_once($default->owl_fs_root ."/scripts/hn_captcha/hn_captcha.class.php");
}

//$xtpl = new XTemplate("templates/$default->sButtonStyle/html/register.xtpl");
$xtpl = new XTemplate("html/register.xtpl", "templates/$default->sButtonStyle");
$xtpl->assign('BUTTON_STYLE', $default->sButtonStyle);
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

fSetLogo_MOTD();
fSetPopupHelp();


if ($default->self_reg == 0 && $default->forgot_pass == 0 and ($myaction != "changepass" and $myaction != "verpasschange"))
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1");
   exit;
}
                                                                                                                   
                                                                                                                   
if ($default->self_reg == 0 && $myaction == 'register')
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1");
   exit;
}
                                                                                                                   
if ($default->forgot_pass == 0 && $myaction == 'forgot')
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1");
   exit;
}


if ($default->registration_using_captcha)
{
   $CAPTCHA_INIT = array(
            'tempfolder'     => $default->owl_fs_root . '/scripts/hn_captcha/tmp/',      // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
			'TTF_folder'     => $default->owl_fs_root . '/scripts/hn_captcha/fonts/', // string: absolute path (with trailing slash!) to folder which contains your TrueType-Fontfiles.
			'TTF_RANGE'      => array('Vera.ttf','VeraBd.ttf','VeraBI.ttf','VeraIt.ttf','VeraMoBd.ttf','VeraMoBI.ttf','VeraMoIt.ttf','VeraMono.ttf','VeraSe.ttf','VeraSeBd.ttf'),

            'chars'          => 5,       // integer: number of chars to use for ID
            'minsize'        => 10,      // integer: minimal size of chars
            'maxsize'        => 30,      // integer: maximal size of chars
            'maxrotation'    => 40,      // integer: define the maximal angle for char-rotation, good results are between 0 and 30

            'noise'          => TRUE,    // boolean: TRUE = noisy chars | FALSE = grid
            'websafecolors'  => TRUE,   // boolean
            'refreshlink'    => TRUE,    // boolean
            'lang'           => 'en',    // string:  ['en'|'de']
            'maxtry'         => 3,       // integer: [1-9]

            'badguys_url'    => '/',     // string: URL
            'secretstring'   => 'hbozzUg2pEeouRoV4wOEsTaw6smAtSMa7CsESm2wAdFejOc8B0zzTuDytH6PypuSNi6FulDo',
            'secretposition' => 23,      // integer: [1-32]

            'debug'          => FALSE
	);

   global $captcha;
   $captcha =& new hn_captcha($CAPTCHA_INIT);
}

require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");

unset($userid);


function fPrintHeader ()
{
   global $default, $xtpl, $owl_lang;

   include_once($default->owl_fs_root ."/lib/header.inc");
   include_once($default->owl_fs_root ."/lib/userheader.inc");

   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

   if ($default->show_prefs == 1 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL("Top");
   }

}

function fPrintFooter ($sSection = "Form")
{
   global $default, $xtpl;

   if ($default->show_prefs == 2 or $default->show_prefs == 3)
   {  
      fPrintPrefsXTPL("Bottom");
   }  

   $xtpl->parse('main.Register.' . $sSection);
   $xtpl->parse('main.Register');
   fSetElapseTime();
   fSetOwlVersion();
   $xtpl->parse('main.Footer');
   $xtpl->parse('main');
   $xtpl->out('main');

}

function printThankYou($username, $sAction = '')
{
   global $default, $language;
   global $owl_lang, $xtpl;

   $username = ereg_replace(' ', '', $username);

   $sql = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_users_table WHERE username = '$username' and disabled='1'");
   $sMessage = "";
   if ($sql->num_rows($sql) == 1)
   {
      $sMessage = $owl_lang->thank_you_3;
   }
   
   fPrintHeader();

   $xtpl->assign('THANKYOU_HEADING', $owl_lang->thank_you_1);

   if ($sAction == '')
   {
      $sUserNameMsg = "<b>" . htmlspecialchars($username) . "</b> $owl_lang->user_created<br />";
   }

   $sMessage = $sUserNameMsg . "$owl_lang->thank_you_2<br />$sMessage";
   $xtpl->assign('THANKYOU_MESSAGE', $sMessage);

   fPrintFooter('ThankYou');

}

function printuser($name = "", $username = "", $email = "")
{
   global $owl_lang;
   global $default, $captcha, $xtpl;

   $urlArgs2 = array();
   $urlArgs2['myaction']     = 'newuser';
   $urlArgs2['currentdb'] = $default->owl_current_db;


   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"register.php\" method=\"post\">");
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

   $xtpl->assign('HEADING_USER_REG', $owl_lang->register);

   if ($default->registration_using_captcha)
   {
      $xtpl->assign('CAPTCHA_LABEL', $owl_lang->captcha_typein . " " .$captcha->display_captcha() );
      //fPrintFormTextLine( "$owl_lang->captcha_typein: " .$captcha->display_captcha() , "private_key", "5", "");
      $xtpl->parse('main.Register.Form.Captcha');
   }

   $xtpl->assign('FULLNAME_LABEL', $owl_lang->full_name);
   $xtpl->assign('FULLNAME_VALUE', $name);

   $xtpl->assign('USERNAME_LABEL', $owl_lang->username);
   $xtpl->assign('USERNAME_VALUE', $username);
   
   $xtpl->assign('EMAIL_LABEL', $owl_lang->email);
   $xtpl->assign('EMAIL_VALUE', $email);

   $xtpl->assign('BTN_REGISTER', $owl_lang->register);
   $xtpl->assign('BTN_REGISTER_ALT', $owl_lang->alt_send_email);

   $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
   $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

   fPrintFooter();
} 

function fPrintChangPass()
{
   global $owl_lang, $xtpl;
   global $default;
   global $uid, $parent;

   $urlArgs2 = array();
   $urlArgs2['myaction']  = 'verpasschange';
   $urlArgs2['currentdb'] = $default->owl_current_db;
   $urlArgs2['uid'] = $uid;
   $urlArgs2['parent'] = $parent;

   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"register.php\" method=\"post\">");
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

   $xtpl->assign('HEADING_PASSWD_CHANGE', $owl_lang->change_pass_title);
   
   $sPasswordRestritions = '';
   if ($default->min_pass_length > 0 or $default->min_pass_numeric > 0 OR $default->min_pass_special > 0)
   {
      if ($default->min_pass_length > 0)
      {
         $sPasswordRestritions .= sprintf($owl_lang->err_pass_restriction_1, $default->min_pass_length);
      }
      if ($default->min_pass_numeric > 0)
      {
         $sPasswordRestritions .= sprintf($owl_lang->err_pass_restriction_2, $default->min_pass_numeric);
      }
      if ($default->min_pass_special > 0)
      {
         $sPasswordRestritions .= sprintf($owl_lang->err_pass_restriction_3, $default->min_pass_special);
      }

      $xtpl->assign('HEADING_PASSWD_CHANGE', $owl_lang->change_pass_title);
      $xtpl->parse('main.Register.ChangePass.PasswdRestrict');
   }

   $xtpl->assign('CHGPASS_OLD_PASS', $owl_lang->oldpassword);
   $xtpl->assign('CHGPASS_NEW_PASS', $owl_lang->newpassword);
   $xtpl->assign('CHGPASS_CONF_PASS', $owl_lang->confpassword);
   
   $xtpl->assign('BTN_CHANGEPASS', $owl_lang->btn_change_passwd);
   $xtpl->assign('BTN_CHANGEPASS_ALT', $owl_lang->alt_btn_change_passwd);

   $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
   $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

   fPrintFooter('ChangePass');
} 

function printgetpasswd()
{
   global $owl_lang;
   global $default, $xtpl;

   $urlArgs2 = array();
   $urlArgs2['myaction']     = 'getpasswd';
   $urlArgs2['currentdb'] = $default->owl_current_db;


   $xtpl->assign('FORM', '<form enctype="multipart/form-data" action="register.php" method="post">');
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs2));

   $xtpl->assign('HEADING_USER_FORGOT', $owl_lang->send_pass);

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
                 $xtpl->parse('main.Register.Forgot.Databases.Options');
      }
      $xtpl->parse('main.Register.Forgot.Databases');
   }


   $xtpl->assign('FORGOTNAME_LABEL', $owl_lang->forgot_username);
   $xtpl->assign('FORGOTNAME_VALUE', $username);
   
   $xtpl->assign('BTN_SENDPASS', $owl_lang->send_pass);
   $xtpl->assign('BTN_SENDPASS_ALT', $owl_lang->send_pass);

   $xtpl->assign('BTN_RESET', $owl_lang->btn_reset);
   $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);

   fPrintFooter('Forgot');
} 

if ($myaction == "newuser")
{
   $password = GenRandPassword();

if ($default->registration_using_captcha)
{
   if ($captcha->validate_submit() <> 1)
   {
      fPrintHeader();

      $xtpl->assign('REGISTER_ERROR', $owl_lang->err_captcha_auth);
      $xtpl->parse('main.Register.ErrorMsg');
      printuser($name, $username, $email);
      exit;
   } 
}
   if ($email == "" || $name == "" || $username == "")
   {
      fPrintHeader();
      $xtpl->assign('REGISTER_ERROR', $owl_lang->err_req);
      $xtpl->parse('main.Register.ErrorMsg');
      printuser($name, $username, $email);
   } 
   else
   {
      if (!fbValidUsername( $username ))
      {
         $sErrorMessage = sprintf($owl_lang->err_username_not_long_enough, $username, strlen(trim($username)), $default->min_username_length);
         printError($sErrorMessage, "And Cannot contain Spaces");
      }

      $username = ereg_replace(' ', '', $username);

      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_users_table WHERE username = '$username'");
      if ($sql->num_rows($sql) > 0) 
      {
         printError("$owl_lang->err_user_exists<br />$owl_lang->username");
      }
      $sql->query("SELECT * FROM $default->owl_users_table WHERE name = '$name'");
      if ($sql->num_rows($sql) > 0) 
      {
         printError("$owl_lang->err_user_exists<br />$owl_lang->full_name");
      }

      $dNow = $sql->now();


      if ($default->self_create_homedir == 1)
      {
         $path = find_path($default->self_reg_homedir);

         if (!file_exists("$default->owl_FileDir/$path/$username"))
         {
            mkdir($default->owl_FileDir . DIR_SEP . $path . DIR_SEP . $username, $default->directory_mask);
         }

         $sql->query("INSERT INTO $default->owl_folders_table (name,parent,security,description,groupid,creatorid, password, smodified) values ('$username', '$default->self_reg_homedir', '54', '', '$default->self_reg_group', '-1', '', $dNow)");
                                                                                                                                                                           
         $iHomeDir = $sql->insert_id($default->owl_folders_table, 'id');
         $iInitial = $iHomeDir;
      }
      else
      {
         $iHomeDir = $default->self_reg_homedir;
         $iInitial = $default->self_reg_firstdir;

      }

       $sql->query("INSERT INTO $default->owl_users_table (groupid,username,name,password,quota_max,quota_current,email,notify,attachfile,disabled,noprefaccess,language,maxsessions,curlogin, lastlogin,useradmin,newsadmin,buttonstyle, homedir, firstdir, user_auth ) VALUES ('$default->self_reg_group', '$username', '$name', '" . md5($password) . "', '$default->self_reg_quota', '0', '$email', '$default->self_reg_notify','$default->self_reg_attachfile', '$default->self_reg_disabled', '$default->self_reg_noprefacces', '$default->owl_lang', '$default->self_reg_maxsessions', $dNow, $dNow, '0', '0', '$default->system_ButtonStyle', '$iHomeDir','$iInitial', '$default->auth')");

      $iNewUserID =  $sql->insert_id($default->owl_users_table, 'id');

      if ($default->self_create_homedir == 1)
      {
         $sql->query("UPDATE $default->owl_folders_table set creatorid = '$iNewUserID' where id = '$iHomeDir'");
      }

      $sql->query("SELECT email FROM $default->owl_users_table WHERE username = 'admin'");
      $sql->next_record();
      $ccto = $sql->f("email");
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
         if ($ccto != "")
         {
            $mail->AddCC("$ccto");
         }
      } 
      else
      {
         if ($ccto != "")
         {
            $mail->AddAddress("$ccto");
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
      $mail->AddAddress($email);
      $mail->AddReplyTo("$default->owl_email_replyto", $owl_lang->email_reply_to_name);

      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $aBody = fGetMailBodyText(SELF_REG_USER);

      $mail->Subject = $aBody['SUBJECT'];

      $aBody['HTML'] = ereg_replace("\%USERNAME\%", $username , $aBody['HTML'] );
      $aBody['TXT'] = ereg_replace("\%USERNAME\%", $username , $aBody['TXT'] );

      $aBody['HTML'] = ereg_replace("\%NEW_PASSWORD\%", $password . "<br />$sHtmlLink ", $aBody['HTML'] );
      $aBody['TXT'] = ereg_replace("\%NEW_PASSWORD\%", $password . "\n $link", $aBody['TXT'] );


      $mail->altBody = $aBody['TXT'];
      $mail->Body = $aBody['HTML'];

      if (!$mail->Send() and $default->debug == true)
      {
         $xtpl->assign('DEBUG_MESSAGE', "$owl_lang->err_email<br />$mail->ErrorInfo");
         $xtpl->parse('main.Register.ThankYou.DebugErrorMsg');
         //print("$owl_lang->err_email<br />");
         //print("$mail->ErrorInfo");
         $sql->query("DELETE FROM $default->owl_users_table WHERE username = '$username' AND name = '$name' AND password = '" . md5($password) . "' AND  email='$email'");
      } 
      printThankYou($username);

      owl_syslog(USER_REG, $iNewUserID, 0, 0, "$owl_lang->self_passwd $email", "LOGIN");

      exit;
   } 
} 
elseif ($myaction == "verpasschange")
{
   $bError = false;
   $sMsg = "";
   $sql = new Owl_DB;
   $sql->query("SELECT id FROM $default->owl_users_table WHERE id = '" . $uid ."' and password = '" . md5(stripslashes($oldpassword)) . "'");
   if ($sql->num_rows() == 0)
   {
      $sMsg = $owl_lang->err_old_pass_ver_failed;
      $bError = true;
   }
   if ($newpassword != $confpassword)
   {
      $sMsg .= $owl_lang->err_new_confirm_different;
      $bError = true;
   }
   if (!fbValidPassword($newpassword))
   {
      $sMsg .= sprintf($owl_lang->err_pass_restriction_1, $default->min_pass_length);
      $sMsg .= sprintf($owl_lang->err_pass_restriction_2, $default->min_pass_numeric);
      $sMsg .= sprintf($owl_lang->err_pass_restriction_3, $default->min_pass_special);
      $bError = true;
   }
   if (fbCheckForPasswdReuse($newpassword, $uid) == true)
   {
      $sMsg .= "$owl_lang->err_cant_reuse_passwords";
      $bError = true;
   }

   if ($bError)
   {
      fPrintHeader();
      
      $xtpl->assign('REGISTER_ERROR', $sMsg);

      $xtpl->parse('main.Register.ErrorMsg');
      fPrintChangPass();
   }
   else
   {
      $sql->query("UPDATE $default->owl_users_table SET change_paswd_at_login = '0', password = '" . md5($confpassword) . "' WHERE  id = '$uid' and password = '" . md5($oldpassword) . "'");

      $session = new Owl_Session;
      $vuid = $session->Open_Session(0, $uid);
      $id = 1;
                                                                                                                                                                       
      $sql->query("SELECT name, curlogin, groupid FROM $default->owl_users_table WHERE id = '" . $uid . "'");
      $sql->next_record();
      $curlogin = $sql->f("curlogin");
      $usergroupid = $sql->f("groupid");
      $sUname = $sql->f("name");

      owl_syslog(LOGIN, $uid, 0, 0, $owl_lang->log_login_det . $sUname, "LOGIN");
                                                                                                                                                                       
      $sql->query("UPDATE $default->owl_users_table SET lastlogin = '" . $curlogin . "' WHERE id = '" . $uid . "'");
      $dNow = $sql->now();
      $sql->query("UPDATE $default->owl_users_table SET passwd_last_changed = $dNow, login_failed = '0', curlogin = $dNow WHERE id = '" . $uid . "'");

      $userid = $uid;
                                                                                                                                                                       
      header("Location: browse.php?sess=" . $vuid->sessdata["sessid"] . "&parent=" . $parent );
   }
   exit;
} 
elseif ($myaction == "changepass")
{
   fPrintHeader();
   fPrintChangPass();
   exit;
} 
elseif ($myaction == "forgot")
{
   fPrintHeader();
   printgetpasswd();

} 
elseif ($myaction == "getpasswd")
{

   if ($username == INIT_USERNAME)
   {
     printerror($owl_lang->err_bad_username);
   }
   
   $password = GenRandPassword();

   $username = ereg_replace(' ', '', $username);

   $sql = new Owl_DB;

   $sql->query("SELECT * FROM $default->owl_users_table WHERE username = '$username' or email ='$username' AND id <> '1' AND disabled = '0'");

   $failed = false;

   if ($sql->num_rows() == 0) 
   {
      $failed = true;
   }


   if ($failed == false)
   {
      $sql->query("SELECT id, username, email, user_auth FROM $default->owl_users_table WHERE username = '$username' or email ='$username' AND id <> '1' AND disabled = '0'");
      $sql->next_record();
      $email = $sql->f("email");
      $sUserName = $sql->f("username");
      if (is_null($sql->f("user_auth")))
      {
         $sUserAuth = "0";
      }
      else
      {
         $sUserAuth = trim($sql->f("user_auth"));
      }

      $mail = new phpmailer(true);
  
try { 
      $mail->SetLanguage($owl_lang->lang_code, "scripts/phpmailer/language/");

      $aBody = fGetMailBodyText(NEW_PASSWORD);

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
      $mail->AddAddress($email);
      $mail->AddReplyTo("$default->owl_email_replyto", $owl_lang->email_reply_to_name);
      $mail->WordWrap = 50; // set word wrap to 50 characters
      $mail->IsHTML(true); // set email format to HTML
      $mail->Subject = $aBody['SUBJECT'];

      if ($sUserAuth == "0")
      { 
         $link = $default->owl_notify_link . "index.php" ;
         $sHtmlLink = "<a href=\"" . $link . "\">$owl_lang->login</a>";

         $aBody['HTML'] = ereg_replace("\%USERNAME\%", $sUserName , $aBody['HTML'] );
         $aBody['TXT'] = ereg_replace("\%USERNAME\%", $sUserName , $aBody['TXT'] );

         $aBody['HTML'] = ereg_replace("\%NEW_PASSWORD\%", $password . "<br />$sHtmlLink ", $aBody['HTML'] );
         $aBody['TXT'] = ereg_replace("\%NEW_PASSWORD\%", $password . "\n $link", $aBody['TXT'] );

         $mail->Body =  $aBody['HTML'];
         $mail->altBody =  $aBody['TXT'];
      }
      else
      {
         $mail->Body = "<html><body>" . $owl_lang->pass_change_email_1 . "<br />";
         $mail->Body .= $owl_lang->pass_change_email_2 . $default->auth_type[$sUserAuth][1] ." <br />";
         $mail->Body .= $owl_lang->pass_change_email_3 . "<br /><br />";
         $link = $default->owl_notify_link . "index.php" ;
         $mail->Body .= "<a href=\"" . $link . "\">$owl_lang->login</a>";
         $mail->Body .= "</body></html>";
      }
      $mail->Send();
   } 
   catch (phpmailerException $e) 
   {
      if ($default->debug == true)
      {
         $xtpl->assign('DEBUG_MESSAGE', "$owl_lang->err_email<br />" . $e->errorMessage());
         $xtpl->parse('main.Register.ThankYou.DebugErrorMsg');
      }
   } 
   catch (Exception $e) 
   {
      if ($default->debug == true)
      {
         $xtpl->assign('DEBUG_MESSAGE', "$owl_lang->err_email<br />$e->getMessage()");
         $xtpl->parse('main.Register.ThankYou.DebugErrorMsg');
      } 
   }

      $sql->query("UPDATE $default->owl_users_table set password = '" . md5($password) . "' WHERE username = '$sUserName'");
      $sql->query("SELECT id FROM $default->owl_users_table WHERE username = '$sUserName'");
      $sql->next_record();
      owl_syslog(FORGOT_PASS, $sql->f("id"), 0, 0, "$owl_lang->self_passwd $email", "LOGIN");
   }
   printThankYou($username, $myaction);
   exit;
} 
elseif ($myaction == "register")
{
   fPrintHeader();
   printuser();
   exit;
} 
else
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1");
   exit;
}
?>
