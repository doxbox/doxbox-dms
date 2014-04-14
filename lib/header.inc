<?php

/*
 *  File: header.inc
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


 // <script type="text/javascript" src="<?php print $default->owl_root_url?>/scripts/tree/tree.js"></script>
  //<script type="text/javascript" src="<?php print $default->owl_root_url?>/scripts/tree/tree_items.js"></script>
  //<script type="text/javascript" src="<?php print $default->owl_root_url?>/scripts/tree/tree_tpl.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo($owl_lang->lang_code) ?>" >


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>


<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
*/

//header("Content-Type: text/html;charset=$default->charset");

if (file_exists("./templates/$default->sButtonStyle/html/html_head.xtpl"))
{
   $xtpl_head = new XTemplate("html/html_head.xtpl", "templates/$default->sButtonStyle");
}
else if (file_exists("../templates/$default->sButtonStyle/html/html_head.xtpl"))
{
   $xtpl_head = new XTemplate("html/html_head.xtpl", "../templates/$default->sButtonStyle");
}
else 
{
   $xtpl_head = new XTemplate("html/html_head.xtpl", $default->owl_fs_root ."/templates/$default->sButtonStyle");
}

$xtpl_head->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);

$xtpl_head->assign('ROOT_URL', $default->owl_root_url);
$xtpl_head->assign('LOCALE_ROOT_URL', $default->owl_root_url . "/locale/" .  $default->owl_lang ) ;
$xtpl_head->assign('OWL_LOCALE_LANG', $owl_lang->lang_code);
$xtpl_head->assign('OWL_SITE_TITLE', $default->site_title . " " . $default->version);
$xtpl_head->assign('OWL_CHAR_SET', $default->charset);

if (bIsMicrosoftBrowser(8))
{
?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"></meta>
<?php
}

if ($default->use_wysiwyg_for_textarea)
{

$jsTinyMCE = "<script language=\"javascript\" type=\"text/javascript\" src=\"$default->owl_root_url/scripts/jscripts/tiny_mce/tiny_mce.js\"></script>\n";
$jsTinyMCE .= "<script type=\"text/javascript\">\n
        tinyMCE.init({\n
                // General options\n
                mode : \"textareas\",\n
                theme : \"advanced\",\n
                plugins : \"autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave\",\n
\n
                // Theme options\n
                theme_advanced_buttons1 : \"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",\n
                theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",\n
                theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",\n
                theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft\",\n
                theme_advanced_toolbar_location : \"top\",\n
                theme_advanced_toolbar_align : \"left\",\n
                theme_advanced_statusbar_location : \"bottom\",\n
                theme_advanced_resizing : true\n
\n
        });\n
</script>\n";

$xtpl_head->assign('DMS_TINY_MCE_JS', $jsTinyMCE);

}
if ($default->use_progress_bar == 1)
{
?>
<script language="javascript" type="text/javascript" src="<?php echo $default->owl_root_url; ?>/scripts/megaupload/script.js"></script>
<?php
}
else if ($default->use_ubr_progress_bar == 1)
{
?>

<script language="javascript" type="text/javascript" src="<?php echo $default->owl_root_url; ?>/scripts/ubr_upload/ubr_file_upload.js"></script>
<?php
}


echo("<!--  " .$_SERVER["PHP_SELF"] . "-->\n");

if ($default->owl_root_url . "/index.php" == $_SERVER["PHP_SELF"])
{
   $xtpl_head->assign('DEFAULT_STYLES_CSS', "$default->owl_graphics_url/" . rawurlencode($default->sButtonStyle) . "/css/login.css");
}
else
{
   $xtpl_head->assign('DEFAULT_STYLES_CSS', $default->styles);
}


if (("setacl.php" == basename($_SERVER["PHP_SELF"])) or (("index.php" == basename($_SERVER["PHP_SELF"])) and (ereg("admin", $_SERVER["PHP_SELF"]))))
{

$sFboxJS ='
<script type="text/javascript">

function move(fbox, tbox) {
        var arrFbox = new Array();
        var arrTbox = new Array();
        var arrLookup = new Array();
        var i;
        for(i=0; i<tbox.options.length; i++) {
                arrLookup[tbox.options[i].text] = tbox.options[i].value;
                arrTbox[i] = tbox.options[i].text;
        }       
        var fLength = 0;
        var tLength = arrTbox.length
        for(i=0; i<fbox.options.length; i++) {
                arrLookup[fbox.options[i].text] = fbox.options[i].value;
                if(fbox.options[i].selected && fbox.options[i].value != "") {
                        arrTbox[tLength] = fbox.options[i].text;
                        tLength++;
                } else {
                        arrFbox[fLength] = fbox.options[i].text;
                        fLength++;
                }       
        }       
        arrFbox.sort();
        arrTbox.sort();
        fbox.length = 0;
        tbox.length = 0;
        var c;
        for(c=0; c<arrFbox.length; c++) {
                var no = new Option();
                no.value = arrLookup[arrFbox[c]];
                no.text = arrFbox[c];
                fbox[c] = no;
        }       
        for(c=0; c<arrTbox.length; c++) {
                var no = new Option();
                no.value = arrLookup[arrTbox[c]];
                no.text = arrTbox[c];
                tbox[c] = no;
        }       
}       
function selectAll(box) {
        for(var i=0; i<box.length; i++) {
                box.options[i].selected = true;
        }       
}       

function selectAllGroups(fbox,tbox) {
         var GroupDesc = new Array(
';

$iFirst = 0;
if (isset($groups) and is_array($groups))
{
   foreach($groups as $g)
   {
      if($iFirst > 0)
      {
$sFboxJS .= ", ";
      }
      $sFboxJS .= "'" . addslashes($g[1]) . "'";
      $iFirst++;
   }
}
$sFboxJS .= ');
         var groupID = new Array(';

if (!empty($groups))
{
$iFirst = 0;
foreach($groups as $g)
         {
            if($iFirst > 0)
            {
$sFboxJS .= ", ";
            }
$sFboxJS .= "$g[0]";
            $iFirst++;
         }
}

$sFboxJS .= '); 

         fbox.length = 0;
         tbox.length = 0;

         var c = 0;
         for (c=0; c<groupID.length; c++) {
                 var no = new Option();
                 no.value = groupID[c];
                 no.text = GroupDesc[c];
                 tbox[c] = no;
         }
}

function selectAllUsers(fbox,tbox) {
         var UserDesc = new Array(';

$iFirst = 0;
          if (!empty($aUserList))
          {
             foreach ($aUserList as $aUsers)
             {
            if($iFirst > 0)
            {
$sFboxJS .= ", ";
               //print(", ");
            }
                $sUsername = $aUsers["username"];
                $sId = $aUsers["id"];
                $sName = $aUsers["name"];
                if(!empty($aUsers["email"]))
                {
                   $sEmail = " (" . $aUsers["email"] . ")";
                }
                else
                {
                   $sEmail = "";
                }
$sFboxJS .= "'" . addslashes($sName) . addslashes($sEmail) . "'";
           // print("'" . addslashes($sName) . addslashes($sEmail) . "'");
            $iFirst++;
   }
             }

$sFboxJS .= '
);
         var userID = new Array(';
          if (!empty($aUserList))
          {
$iFirst = 0;
             foreach ($aUserList as $aUsers)
             {
            if($iFirst > 0)
            {
$sFboxJS .= ', ';
              // print(", ");
               //print(", ");
            }
                $sId = $aUsers["id"];
$sFboxJS .= $sId;
            //print($sId);
            $iFirst++;
   }
             }
//print(");");
$sFboxJS .= ');

         fbox.length = 0;
         tbox.length = 0;

         var c = 0;
         for (c=0; c<userID.length; c++) {
                 var no = new Option();
                 no.value = userID[c];
                 no.text = UserDesc[c];
                 tbox[c] = no;
         }
}

';

       if (("index.php" == basename($_SERVER["PHP_SELF"])) and (ereg("admin", $_SERVER["PHP_SELF"])))
       {
$sFboxJS .= '
function subSelection(txtValue)
{
       hiddenField = document.getElementById("subaction");
       hiddenField.value = txtValue;
}

function reload()
{
       window.location.reload()
}
';
       } // end of selectAllMainUsers, selectAllAdmminUsers, subSelection, reload
$sFboxJS .='//sun2earth end
</script>';
$xtpl_head->assign('FBOX_JAVA_SCRIPT', $sFboxJS);


//print($sFboxJS);
}



if ("setacl.php" == basename($_SERVER["PHP_SELF"]))
{

$aAclList[] = "owlread";
$aAclList[] = "owlwrite";
$aAclList[] = "owldelete";
$aAclList[] = "owlcopy";
$aAclList[] = "owlmove";
$aAclList[] = "owlproperties";
$aAclList[] = "owlsetacl";
$aAclList[] = "owlmonitor";
$aAclList[] = "owlupdate";
$aAclList[] = "owlviewlog";
$aAclList[] = "owlcomment";
$aAclList[] = "owlcheckin";
$aAclList[] = "owlemail";
$aAclList[] = "owlrelsearch";

$sfCheckJS ='
<script type="text/javascript">';

foreach ($aAclList as $sAcl)
{
   $sfCheckJS .= "function fcheck$sAcl(){\n";
   if(!empty($fselectedusers))
   {
      foreach ( $fselectedusers as $user )
      {
         $sfCheckJS .= "document.set_facl.facl_".$sAcl."_$user.checked = !(document.set_facl.facl_".$sAcl."_$user.checked);\n";
      }
   }
   if(!empty($fselectedgroups))
   {
      foreach ( $fselectedgroups as $group )
      {
         if ($group == -1)
         {
            continue;
         }
         $sfCheckJS .= "document.set_facl.fgacl_".$sAcl."_$group.checked = !(document.set_facl.fgacl_".$sAcl."_$group.checked);\n";
      }
   }
   $sfCheckJS .= "}\n";
}

if(!empty($fselectedusers))
{
   foreach ( $fselectedusers as $user )
   {
      $sfCheckJS .= "function checkFU$user(){\n";
      foreach ($aAclList as $sAcl)
      {
         $sfCheckJS .= "document.set_facl.facl_".$sAcl."_$user.checked = !(document.set_facl.facl_".$sAcl."_$user.checked);\n";
      }
      $sfCheckJS .= "}\n";
   }
}

if(!empty($fselectedgroups))
{
   foreach ( $fselectedgroups as $group )
   {
      if ($group == -1)
      {
         continue;
      }
      $sfCheckJS .= "function checkFG$group(){\n";
      foreach ($aAclList as $sAcl)
      {
         $sfCheckJS .= "document.set_facl.fgacl_".$sAcl."_$group.checked = !(document.set_facl.fgacl_".$sAcl."_$group.checked);\n";
      }
      $sfCheckJS .= "}\n";
   }
}

$aAclList = array();
$aAclList[] = "owlread";
$aAclList[] = "owlviewlog";
$aAclList[] = "owldelete";
$aAclList[] = "owlcopy";
$aAclList[] = "owlmove";
$aAclList[] = "owlproperties";
$aAclList[] = "owlupdate";
$aAclList[] = "owlcomment";
$aAclList[] = "owlcheckin";
$aAclList[] = "owlemail";
$aAclList[] = "owlrelsearch";
$aAclList[] = "owlsetacl";
$aAclList[] = "owlmonitor";

if (fIsAdmin() and $action == "folder_acl")
{
   $form = "set_facl";
}
else
{
   $form = "set_acl";
}
foreach ($aAclList as $sAcl)
{
   $sfCheckJS .= "function check$sAcl(){\n";
   if(!empty($selectedusers))
   {
      foreach ( $selectedusers as $user )
      {
         $sfCheckJS .= "document.$form.acl_".$sAcl."_$user.checked = !(document.$form.acl_".$sAcl."_$user.checked);\n";
      }
   }
   if(!empty($selectedgroups))
   {
      foreach ( $selectedgroups as $group )
      {
         if ($group == -1)
         {
            continue;
         }
         $sfCheckJS .= "document.$form.gacl_".$sAcl."_$group.checked = !(document.$form.gacl_".$sAcl."_$group.checked);\n";
      }
   }
   $sfCheckJS .= "}\n";
}

if(!empty($selectedusers))
{
   foreach ( $selectedusers as $user )
   {
      $sfCheckJS .= "function checkU$user(){\n";
      foreach ($aAclList as $sAcl)
      {
         $sfCheckJS .= "document.$form.acl_".$sAcl."_$user.checked = !(document.$form.acl_".$sAcl."_$user.checked);\n";
      }
      $sfCheckJS .= "}\n";
   }
}

if(!empty($selectedgroups))
{
   foreach ( $selectedgroups as $group )
   {
      if ($group == -1)
      {
         continue;
      }
      $sfCheckJS .= "function checkG$group(){\n";
      foreach ($aAclList as $sAcl)
      {
         $sfCheckJS .= "document.$form.gacl_".$sAcl."_$group.checked = !(document.$form.gacl_".$sAcl."_$group.checked);\n";
      }
      $sfCheckJS .= "}\n";
   }
}
$sfCheckJS .= '</script>';
$xtpl_head->assign('FCHECK_JAVA_SCRIPT', $sfCheckJS );
}

?>

<?php

$sPHPLayers = '';

$xtpl_head->assign('PLEASE_SELECT_BULK', $owl_lang->err_please_select_bulk);
// If we are not in browse.php don't load the layers menu js
if (("browse.php" == basename($_SERVER["PHP_SELF"]) or "showrecords.php" == basename($_SERVER["PHP_SELF"])) and !$default->old_action_icons)
{

$sPHPLayers = '
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layersmenu-browser_detection.js"></script>
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layersmenu-library.js"></script>
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layersmenu.js"></script>
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layerstreemenu-cookies.js"></script>';

}
if ("sitemap.php" == basename($_SERVER["PHP_SELF"]))
{
$sPHPLayers = '
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layersmenu-browser_detection.js"></script>
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layersmenu-library.js"></script>
<script type="text/javascript" src="' . $default->owl_root_url . '/scripts/phplayersmenu/libjs/layerstreemenu-cookies.js"></script>';
}

if (version_compare(phpversion(), "5.4.0", ">="))
{
   if (ini_get('session.upload_progress.enabled') == 1 and !strpos(php_sapi_name(), 'fcgi'))
   {
      /** Load the supporting elements needed to display the Progress bar */
      $xtpl_head->assign('PROGRESSBAR_UPLOAD_START', $owl_lang->progressbar_upload_start);
      $xtpl_head->assign('PROGRESSBAR_UPLOADING', $owl_lang->progressbar_uploading);
      $xtpl_head->assign('PROGRESSBAR_UPLOAD_CANCEL', $owl_lang->progressbar_upload_cancel);
      $xtpl_head->assign('PROGRESSBAR_POST_UPLOAD', $owl_lang->progressbar_post_upload);
      $xtpl_head->assign('ERROR_SELECT_FILE', $owl_lang->error_select_file);

      $xtpl_head->parse('html_header.PhpProgressBarCSS');
      $xtpl_head->parse('html_header.PhpProgressBarJS');
   }
}

/**
 * Javascript Localization Variables
 */

$xtpl_head->assign('ACL_NO_USERS_AVAILABLE', $owl_lang->acl_no_users_available);
$xtpl_head->assign('ACL_NO_GROUPS_AVAILABLE', $owl_lang->acl_no_groups_available);

$xtpl_head->parse('html_header');
$xtpl_head->out('html_header');

?>
