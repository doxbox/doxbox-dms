<?php

/*
 * disp.lib.php
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
 * $Id: disp.lib.php,v 1.41 2006/11/16 16:02:40 b0zz Exp $
 */

defined( 'OWL_INCLUDE' ) or die( 'Access Denied' );

// *************************************************
// BEGIN DO NOT CHANGE THIS VARIABLE
// *************************************************
$default->WebDAV = false;
// *************************************************
// END: DO NOT CHANGE THIS VARIABLE
// *************************************************


/**
 * Prints the Vaforite
 *
 * Empty e-mail addresses are allowed. See RFC 2822 for details.
 *
 * @param $mail
 *   A string containing an email address.
 * @return
 *   TRUE if the address is in a valid format.
 */


function fIsCheckBoxChecked($iCheckboxValue)
{
   if ($iCheckboxValue == 1)
   {
      return "checked=\"checked\"";
   }
   else
   {
      return "";
   }
}
// ***  Functions contributed by Value 4 Business
// BEGIN

function fGetURL ($file, $args)
{
   global $default;

   $pos = false;
   if ( 0 < strlen($default->owl_root_url))
   {
      $pos = strpos($file, $default->owl_root_url);
   }
   else
   {
      /* the root_url is Zero, remove the leadning / from the PHP_SELF */
      $file = ltrim($file, '/');
   }

   if ( $pos !== false)
   {
      $url = $file; 
   }
   else
   {
      $url = "$default->owl_root_url/$file";

   }
 
   $params = '';
   foreach ($args as $k => $v)
   {
      settype($v, "string");  

      if ($v != "")
      {
         $params .= "$k=$v". "&amp;";
      }
   }
   $params = substr ($params, 0, strlen($params)-5);

   $url .= "?$params&currentdb=$default->owl_current_db";
   return $url;
}


function fGetHiddenFields ($args)
{
   global $default;
   $html = '';
   foreach ($args as $k => $v)
   {
      if ($v or $v == "0")
      {
         $html .= "<input type=\"hidden\" id=\"$k\" name=\"$k\" value=\"" . htmlentities($v, ENT_COMPAT, $default->charset) . "\" />\n";
      }
   }

    return $html;
}

// END

function fPrintFormDoctypeRadio($rowtitle, $fieldname, $value, $option_text , $sReadonly = "", $iFileId = "")
{
//sun2earth begin
   global $owl_lang, $default;
//sun2earth end

   //if ($default->debug_pre_xtemplate_html)
   //{
      print("<tr>\n");
      print("<td class=\"form1\">$rowtitle</td>\n");
   //}

   //if ($xtpl)
   //{
      //$xtpl->assign('DOC_TYPE_RADIO_LABEL', $rowtitle);
   //}
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"return makeTrue(domTT_activate(this,event,'caption','" . addslashes($rowtitle) . "','content','". $owl_lang->{$sExtendedHelpVar} . "','lifetime', 3000, 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true))\";";
   }
   else
   {
       $extended_help="";
   }
   $checked = "";
   //if ($default->debug_pre_xtemplate_html)
   //{
      print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">");
   //}

   //if ($xtpl)
   //{
      //$xtpl->assign('DOC_TYPE_RADIO_EXTENDED', $extended_help);
      //$xtpl->assign('DOC_TYPE_RADIO_READONLY', $sReadonly);
   //}
   if ($value == "0")
   {
         $checked = "checked=\"checked\"";
   }
   foreach ($option_text as $caption)
   {
      if ($caption == $value) 
      {
         $checked = "checked=\"checked\"";
      }
      
      //if ($xtpl)
      //{
         //$xtpl->assign('DOC_TYPE_RADIO_CHECKED', $checked);
         //$xtpl->assign('DOC_TYPE_RADIO_NAME', $fieldname . $iFileId);
         //$xtpl->assign('DOC_TYPE_RADIO_VALUE', $caption);
         //$xtpl->assign('DOC_TYPE_RADIO_VALUE_LABEL', $caption);
         ////$xtpl->parse('main.DataBlock.File.DocFields.Row.Radio.Input');
      //}
      //if ($default->debug_pre_xtemplate_html)
      //{
         print("<input $sReadonly type=\"radio\" value=\"$caption\" name=\"$fieldname" . $iFileId ."\" $checked />$caption\n");
	  //}
      $checked = "";
   }

   //if ($default->debug_pre_xtemplate_html)
   //{
      print("</td>\n</tr>\n");
   //}

   //if ($xtpl)
   //{
      //$xtpl->parse('main.DataBlock.File.DocFields.Row.Radio');
   //}
}

function fPrintSectionHeader($title, $class = 'admin2', $sSlider = '')
{
   if (!empty($sSlider))
   {
      print("<tr><td width=\"1%\" align=\"left\">" . $sSlider . "</td>\n");
      print("    <td class=\"$class\" width=\"99%\">$title<br /></td></tr>\n");
   }
   else
   {
      print("<tr><td class=\"$class\" width=\"100%\" colspan=\"2\">" . $sSlider . "$title<br /></td></tr>\n");
   }
}

function fPrintFormCheckBox($rowtitle, $fieldname, $value, $checked = "", $submit = "", $readonly = "")
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   if (!empty($checked))
   {
      $checked = "checked=\"$checked\"";
   }
   if (!empty($readonly))
   {
      $readonly = "disabled=\"disabled\"";
   }
   if (!empty($submit))
   {
      $submit = "onclick=\"javascript:this.form.submit()\"";
   }
   print("<tr>\n");
   print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"return makeTrue(domTT_activate(this,event,'caption','" . addslashes($rowtitle) . "','content','". $owl_lang->{$sExtendedHelpVar} . "','lifetime', 3000, 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true))\";";
   }
   else
   {
       $extended_help="";
   }
   print("<td class=\"form1\" width=\"100%\"" . $extended_help . "><input class=\"fcheckbox1\" type=\"checkbox\" name=\"$fieldname\" value=\"$value\" $checked $submit $readonly /></td>\n");
//sun2earth end   
   print("</tr>\n");
}

function fPrintFormTextArea($rowtitle, $fieldname, $currentvalue = "" , $row = 10, $sReadonly = '' , $cols = 50)
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   print("<tr>\n");
   print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"return makeTrue(domTT_activate(this,event,'caption','" . addslashes($rowtitle) . "','content','". $owl_lang->{$sExtendedHelpVar} . "','lifetime', 3000, 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true))\";";
   }
   else
   {
       $extended_help="";
   }
   print("<td class=\"form1\" width=\"100%\"" . $extended_help . "><textarea class=\"ftext1\" name=\"$fieldname\" rows=\"$row\" cols=\"$cols\" $sReadonly >$currentvalue</textarea></td>\n");
//sun2earth end
   print("</tr>\n");
}

function fPrintFormTextLine($rowtitle, $name, $size = "24", $value = "", $bytes = "", $readonly = false, $type = 'text')
{
//sun2earth begin
   global $owl_lang;
//sun2earth end
   print("<tr>\n");
   print("<td class=\"form1\">");
   if(!empty($name) and $type == "text")
   {
      print("<label for=\"$name\">");
   }
   print($rowtitle);

   if(!empty($name) and $type == "text")
   {
      print("</label>");
   }
   print("</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $name . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"return makeTrue(domTT_activate(this,event,'caption','" . addslashes($rowtitle) . "','content','". $owl_lang->{$sExtendedHelpVar} . "','lifetime', 3000, 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true))\";";
   }
   else
   {
       $extended_help="";
   }
   if ($readonly)
   {
      print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">$value");      
//sun2earth end
      if(!empty($bytes))
      {
         print(" ($bytes)");
      } 
      print("</td>\n");
   }
   else
   {
      print("<td class=\"form1\" width=\"100%\"><input class=\"finput1\" id=\"$name\" type=\"$type\" name=\"$name\" size=\"$size\" value=\"$value\" />");
      if(!empty($bytes))
      {
         print("($bytes)");
      } 
      print("</td>\n");

   }
   print("</tr>\n");
}


function fPrintFormSelectBox($rowtitle, $fieldname, $values, $currentvalue = "No value", $size = 1, $multiple = false, $standalone = false)
{
   global $owl_lang;
   $found = false;

   if ($standalone == false)
   {
      print("<tr>\n");
      print("<td class=\"form1\">$rowtitle</td>\n");
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";   
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"return makeTrue(domTT_activate(this,event,'caption','" . addslashes($rowtitle) . "','content','". $owl_lang->{$sExtendedHelpVar} . "','lifetime', 3000, 'fade', 'both', 'delay', 10, 'statusText', ' ', 'trail', true))\";";
   }
   else
   {
       $extended_help="";
   }
      print("<td class=\"form1\" width=\"100%\"" . $extended_help . ">");
//sun2earth end      
   }
   print("<select class=\"fpull1\" name=\"$fieldname\" size=\"$size\"");
   if ($multiple)
   {
      print(" multiple=\"multiple\" ");
      $currentvalue = preg_split("/\s+/", strtolower($currentvalue));
   }
   print(">\n");
   if (is_array($values))
   {
      foreach($values as $g)
      {
         $val = addcslashes($g[0], '()&?');
         print("<option value=\"$g[0]\" ");
         if ($multiple)
         {
            if(preg_grep("/$val/", $currentvalue))
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         else
         {
            if ($g[0] == $currentvalue)
            {   
               print("selected=\"selected\"");
               $found = true;
            }   
         }
         print(">$g[1]</option>\n");
      }      
   }
   if (!$found and $currentvalue <> "No value")
   {
      if($multiple)
      {
         print("<option value=\"\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
      else
      {
         print("<option value=\"$currentvalue\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
   }
   print("</select>");
   if ($standalone == false)
   {
      print("</td></tr>");
   }
}
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
function fPrintFormTableSelectBox($rowtitle, $fieldname, $values, $currentvalue = "No value", $size = 1, $multiple = false, $standalone = false)
{
   global $owl_lang;
   $found = false;

   if ($standalone == false)
   {
      print("<tr>\n");
      print("<td class=\"form1\">$rowtitle</td>\n");
      print("<td class=\"form1\" width=\"100%\">");
   }
   print("<select class=\"fpull1\" name=\"$fieldname\" size=\"$size\"");
   if ($multiple)
   {
      print(" multiple=\"multiple\" ");
      $currentvalue = preg_split("/\s+/", strtolower($currentvalue));
   }
   print(">\n");
   if (is_array($values))
   {
      foreach($values as $g)
      {
        $val = addcslashes($g[0], '()&');
         print("<option value=\"$g[0]\" ");
         if ($multiple)
         {
            if(preg_grep("/$val/", $currentvalue))
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         else
         {
            if ($g[0] == $currentvalue)
            {
               print("selected=\"selected\"");
               $found = true;
            }
         }
         print(">$g[1]</option>\n");
      }
   }
   if (!$found and $currentvalue <> "No value")
   {
      if($multiple)
      {
         print("<option value=\"\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
      else
      {
         print("<option value=\"$currentvalue\" selected=\"selected\">$owl_lang->none_selected</option>");
      }
   }
   print("</select>");
    if (fIsAdmin(true))
    {
        $sess = $_GET["sess"];
        print("<input type=\"button\" class=\"form1\" onClick=\"window.open('./extensions/quickAdd.php?sess=$sess', 'Owl', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600,left = 320,top = 150')\" value=\"$owl_lang->tables_quickAdd\" />");
        print("<input type=\"button\" class=\"form1\" onClick=\"location.reload(true)\" value=\"$owl_lang->tables_refresh\" />");
    }
   if ($standalone == false)
   {
      print("</td></tr>");
   }
}

function fPrintURL($rowtitle, $text, $url)
{
    print("<tr><td class=\"form1\">\n");
    if (!empty($rowtitle))
    {
        print("<label for=\"$rowtitle\">");
    }
    print($rowtitle);
    if (!empty($rowtitle))
    {
        print("</label>");
    }
    print("</td>\n");
    $session = $_GET["sess"];
    print("<td class=\"form1\" width=\"100%\"><a href=\"$url?sess=$session\" target=\"_new\">$text</a></td></tr>\n");
}

function fPrintRelatedDocs($rowtitle, $name, $size = "24", $value)
{
    global $default, $sess;
   print("<tr>\n");
   print("<td class=\"form1\">");
   if(!empty($name))
   {
      print("<label for=\"$name\">");
   }
   print($rowtitle);
   if(!empty($name))
   {
      print("</label>");
   }
   print("</td>\n");
    print("<td class=\"form1\" width=\"100%\">");
    if (!empty($value))
    {
       foreach($value as $v)
       {
           $label = $default->doc_id_prefix;
           for ($j = 1; $j < $default->doc_id_num_digits; $j++)
           {
               $label .= "0";
           }
           $label .= $v;
           $parent = owlfileparent($v);
           print("<a href=\"browse.php?sess=$sess&parent=$parent&expand=1&fileid=$v\">$label</a>&nbsp;|&nbsp;");
       }
    }
    print("</td>\n");
   print("</tr>\n");
}
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************


function gethtmlprefs ( )
{
   global $default, $cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }


   $sql->query("SELECT * FROM $default->owl_html_table");
   $sql->next_record();

   // styles sheet
   // this is an absolute URL and not a filesystem reference

   $default->styles                = "$default->owl_graphics_url/". rawurlencode($default->sButtonStyle) . "/css/styles.css";

   $default->table_expand_width    = $sql->f("table_expand_width");
   $default->table_collapse_width  = $sql->f("table_collapse_width");
   $default->body_background       = $sql->f("body_background");
   $default->owl_logo              = $sql->f("owl_logo");
   $default->body_textcolor        = $sql->f("body_textcolor");
   $default->body_link             = $sql->f("body_link");
   $default->body_vlink            = $sql->f("body_vlink");
   $default->table_header_height   = 40;
};

function fPrintSubmitButton($value, $alt, $type = "submit", $name = "", $confirm_text = "", $sBtnUpClass = "fbuttonup1", $sBtnDownClass = "fbuttondown1", $tabindex = "")
{
   global $owl_lang;

   print("<input $tabindex class=\"$sBtnUpClass\" ");
   if(!empty($name))
   {
      print("name=\"$name\" ");
   }
   print("type=\"$type\" value=\"$value\" alt=\"$alt\" title=\"$alt\" onmouseover=\"highlightButton('$sBtnDownClass', this)\" onmouseout=\"highlightButton('$sBtnUpClass', this)\"");

   if(!empty($confirm_text))
   { 
      print(" onclick=\"return confirm('$confirm_text');\"");
   }

   print(" />");

}


function fPrintButton($sHref, $sBtn_name, $sequence = 0, $type = "ui_buttons", $icon = 0)
{
   global $default, $language, $owl_lang;

   if ($language == "")
   {
      $language = $default->owl_lang;
   }

   $sAltstring = 'alt_' . $sBtn_name;
   $sButtonString = $sBtn_name;

   if ($sequence > 0)
   {
      $sImageName = $sBtn_name . "_" . $sequence;
   }
   else
   {
      $sImageName = $sBtn_name;
   }

   if (isset($icon) and file_exists($default->owl_fs_root . "/graphics/" .$default->sButtonStyle ."/custom/$icon"))
   {
      print("\t\t<td class=\"button1\" onclick=\"highlightButton('fbuttonclick_kewill', this)\" onmouseover=\"highlightButton('fbuttondown1_kewill', this)\" onmouseout=\"highlightButton('fbuttonup1_kewill', this)\">");
   }
   else
   {
     print("\t\t<td class=\"button1\">");
   }

   print("<a id=\"$sBtn_name\" class=\"lbutton1\" href=\"$sHref\" title=\"". $owl_lang->{$sAltstring} ."\">&nbsp;" . $owl_lang->{$sButtonString} ."&nbsp;</a>");

   if (isset($icon) and file_exists($default->owl_fs_root . "/graphics/" .$default->sButtonStyle ."/custom/$icon"))
   {
     print("<img src=\"$default->owl_graphics_url/$default->sButtonStyle/custom/$icon\" border=\"0\" alt=\"\" /><br />");
   }

   print("</td>\n");
}


function printFileIcons ($fid, $filename, $checked_out, $url, $allicons, $ext, $backup_parent, $is_backup_folder = false)
{
   global $default;
   global $sess, $expand, $order, $sortorder ,$sortname, $userid, $curview;
   global $owl_lang ;
   global $xtpl;

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $backup_parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${sortorder}]  = $sort;

   $self = $_SERVER["PHP_SELF"];
   $isBackup = fid_to_name($backup_parent);
   $Realid = fGetPhysicalFileId($fid);

   // check to see if the file is checked out
   // to display a the lock or unlock Icon.


   $sSpacer = "<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/x_clear.gif\" height=\"1\" width=\"17\" alt=\"\" />";

   if ($xtpl)
   {
      $xtpl->assign('FILE_ACTION_LOG', $sSpacer);
      $xtpl->assign('FILE_ACTION_HOTLINK', $sSpacer);
      $xtpl->assign('FILE_ACTION_DEL', $sSpacer);
      $xtpl->assign('FILE_ACTION_MOD', $sSpacer);
      $xtpl->assign('FILE_ACTION_INLINE', $sSpacer);
      $xtpl->assign('FILE_ACTION_ACL', $sSpacer);
      $xtpl->assign('FILE_ACTION_LINK', $sSpacer);
      $xtpl->assign('FILE_ACTION_COPY', $sSpacer);
      $xtpl->assign('FILE_ACTION_MOVE', $sSpacer);
      $xtpl->assign('FILE_ACTION_UPD', $sSpacer);
      $xtpl->assign('FILE_ACTION_DNLD', $sSpacer);
      $xtpl->assign('FILE_ACTION_COMMENT', $sSpacer);
      $xtpl->assign('FILE_ACTION_CHECKOUT', $sSpacer);
      $xtpl->assign('FILE_ACTION_EMAIL', $sSpacer);
      $xtpl->assign('FILE_ACTION_MON', $sSpacer);
      $xtpl->assign('FILE_ACTION_RELATED', $sSpacer);
      $xtpl->assign('FILE_ACTION_VIEW', $sSpacer);
      $xtpl->assign('FILE_ACTION_GENTHUMB', $sSpacer);
   }
   
   
   $iCheckedOut = $checked_out;

   $aFileAccess = check_auth($fid, "file_all", $userid, false, false);

   if ( $default->advanced_security == 1 ) 
   {
      if (!in_array('file_log', $default->FileMenuOrder))
      {
         $aFileAccess['owlviewlog'] = 0;
      }
      if (!in_array('file_delete', $default->FileMenuOrder))
      {
         $aFileAccess['owldelete'] = 0;
      }
      if (!in_array('file_edit', $default->FileMenuOrder))
      {
         $aFileAccess['owlproperties'] = 0;
      }
      if (!in_array('file_update',  $default->FileMenuOrder))
      {
         $aFileAccess['owlupdate'] = 0;
      }
      if (!in_array('file_acl',  $default->FileMenuOrder))
      {
         $aFileAccess['owlsetacl'] = 0;
      }
      if (!in_array('file_copy', $default->FileMenuOrder))
      {
         $aFileAccess['owlcopy'] = 0;
      }
      if (!in_array('file_link', $default->FileMenuOrder))
      {
         $aFileAccess['owllink'] = 0;
      }
      else
      {
         $aFileAccess['owllink'] = 1;
      }
      if (!in_array('file_move', $default->FileMenuOrder))
      {
         $aFileAccess['owlmove'] = 0;
      }
      if (!in_array('file_comment', $default->FileMenuOrder))
      {
         $aFileAccess['owlcomment'] = 0;
      }
      if (!in_array('file_lock', $default->FileMenuOrder))
      {
         $aFileAccess['owlcheckin'] = 0;
      }
      if (!in_array('file_email', $default->FileMenuOrder))
      {
         $aFileAccess['owlemail'] = 0;
      }
      if (!in_array('file_monitor', $default->FileMenuOrder))
      {
         $aFileAccess['owlmonitor'] = 0;
      }
      if (!in_array('file_find', $default->FileMenuOrder))
      {
         $aFileAccess['owlrelsearch'] = 0;
      }
      if (!in_array('file_download', $default->FileMenuOrder))
      {
         $aFileAccess['owlread'] = 0;
      }
      if (!in_array('file_view', $default->FileMenuOrder))
      {
         $aFileAccess['owlview'] = 0;
      }
   }

   $bFileModify = $aFileAccess["owlproperties"];
   $bFileDownload = $aFileAccess["owlread"];
   $bFileDelete    = $aFileAccess["owldelete"];

   $bCheckOK = false;

   if (($checked_out == 0) || ($checked_out == $userid) || fIsAdmin()) 
   { 
      $bCheckOK = true; 
   }
   if ($allicons == 1 and $aFileAccess["owlviewlog"] == 1)
   {
      if ($url == "0") 
      {
         $filename = ereg_replace("\&","<amp>", $filename);
         $urlArgs2 = $urlArgs;
         $urlArgs2['id'] = $fid;
         $urlArgs2['filename'] = $filename;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('log.php', $urlArgs2);

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/log.gif\" border=\"0\" alt=\"$owl_lang->alt_log_file\" title=\"$owl_lang->alt_log_file\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_LOG', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/log.gif\" border=\"0\" alt=\"$owl_lang->alt_log_file\" title=\"$owl_lang->alt_log_file\" /></a>");
         }

         fPrintButtonSpace(1, 4);

         $sUrl = "#\" onclick=\"getDocTypeFields('scripts/Ajax/Owl/getfilelink.php?sess=$sess&fileid=$fid');";

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/link.gif\" border=\"0\" alt=\"HOT LINK TO FILE\" title=\"HOT LINK TO FILE\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_HOTLINK', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/link.gif\" border=\"0\" alt=\"HOT LINK TO FILE\" title=\"HOT LINK TO FILE\" /></a>");
         }
         fPrintButtonSpace(1, 4);

      } 
      else 
      {
         fPrintButtonSpace(1, 21);
      }
   }
   else
   {
      fPrintButtonSpace(1, 2);
   }

   // *****************************************************************************
   // Don't Show the delete icon if the user doesn't have delete access to the file
   // *****************************************************************************

   if($bFileDelete == 1)
   {
      if ($url == "1")
      {
         if ($bCheckOK) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_delete';
            $urlArgs2['type']   = 'url';
            $urlArgs2['id']     = $fid;
            $urlArgs2['parent'] = $backup_parent;
            if($self == $default->owl_root_url . "/log.php")
            {
               $urlArgs2['self'] = 'log';
            }

            $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

            print("<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_DEL', "<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
            }
         } 
         fPrintButtonSpace(1, 4);
      }
      else
      {
         if ($bCheckOK) 
         { 
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_delete';
            $urlArgs2['id']     = $fid;
            $urlArgs2['parent'] = $backup_parent;
            if($self == $default->owl_root_url . "/log.php")
            {
               $urlArgs2['self'] = 'log';
            }
            $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
            print("<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_DEL', "<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
            }
         } 
         else 
         {
            fPrintButtonSpace(1, 17);
         }
         fPrintButtonSpace(1, 4);
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }

   // *****************************************************************************
   // Don't Show the modify icon if the user doesn't have modify access to the file
   // *****************************************************************************
   
   if($bFileModify == 1 && !$is_backup_folder) 
   {
      if ($bCheckOK) 
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = 'file_modify';
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('modify.php', $urlArgs2);

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_file\" title=\"$owl_lang->alt_mod_file\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_MOD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_file\" title=\"$owl_lang->alt_mod_file\" /></a>");
         }
      } 
      else 
      {
         fPrintButtonSpace(1, 17);
      }
      fPrintButtonSpace(1, 4);
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }


   $ext = fFindFileExtension($filename);
   if($aFileAccess["owlupdate"] == 1 && !$is_backup_folder and $Realid == $fid and $url == 0)
   {
      if ($bCheckOK)
      {
         if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
         {
            if (!empty ($default->edit_text_files_inline))
            {
               $edit_inline = $default->edit_text_files_inline;
               if ($ext != "" && preg_grep("/\b$ext\b/", $edit_inline))
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'edit_inline';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('modify.php', $urlArgs2);
                  print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit_file.gif\" border=\"0\" alt=\"$owl_lang->alt_edit_file_inline\" title=\"$owl_lang->alt_edit_file_inline\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_INLINE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit_file.gif\" border=\"0\" alt=\"$owl_lang->alt_edit_file_inline\" title=\"$owl_lang->alt_edit_file_inline\" /></a>");
                  }
               }
            }
         }
      }
      else
      {
         fPrintButtonSpace(1, 17);
      }
      fPrintButtonSpace(1, 1);
   }
   //else
   //{
      //fPrintButtonSpace(1, 4);
   //}


 // *****************************************************************************
   // Don't Show the link icon if the user doesn't have move access to the file
   // *****************************************************************************
  if ( $default->advanced_security == 1 ) 
      {      
         if($aFileAccess["owlsetacl"] == 1)
         {      
            if ($bCheckOK) 
            {   
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $fid;               
               $urlArgs2['parent'] = $backup_parent;
               $urlArgs2['edit'] = 1;
               $urlArgs2['action'] = "file_acl";
               $sUrl = fGetURL ('setacl.php', $urlArgs2);
               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->acl_set_acl\" title=\"$owl_lang->acl_set_acl\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_ACL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->acl_set_acl\" title=\"$owl_lang->acl_set_acl\" /></a>");
               }
            }
         }
         else 
         {
            fPrintButtonSpace(1, 17);
         }
         fPrintButtonSpace(1, 4);
      }

   if (!$is_backup_folder and $Realid == $fid and $aFileAccess["owllink"] == 1 and $aFileAccess["owlmove"] == 1)
   {
      if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
      {
         if ($bCheckOK)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'lnk_file';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('move.php', $urlArgs2);
            print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/link.gif\" border=\"0\" alt=\"$owl_lang->alt_link_file\" title=\"$owl_lang->alt_link_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_LINK', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/link.gif\" border=\"0\" alt=\"$owl_lang->alt_link_file\" title=\"$owl_lang->alt_link_file\" /></a>");
            }
         }
         else
         {
            fPrintButtonSpace(1, 17);
         }
         fPrintButtonSpace(1, 4);
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }


   // *****************************************************************************
   // Don't Show the copy icon if the user doesn't have move access to the file
   // *****************************************************************************

   if (!$is_backup_folder and $aFileAccess["owlcopy"] == 1)
   {
      if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
      {
         if ($url == "1")
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'cp_file';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $urlArgs2['type'] = 'url';
               $sUrl = fGetURL ('move.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_COPY', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
               }
            }  
            else 
            {
               fPrintButtonSpace(1, 17);
            }
            fPrintButtonSpace(1, 4);
         }
         else
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'cp_file';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('move.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_COPY', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
               }
            } 
            else 
            {
               fPrintButtonSpace(1, 17);
            }
            fPrintButtonSpace(1, 4);
         }
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }



   // *****************************************************************************
   // Don't Show the move modify icon if the user doesn't have move access to the file
   // *****************************************************************************

   if (!$is_backup_folder and $aFileAccess["owlmove"] == 1)
   {
      if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
      {
         if ($url == "1")
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'file';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $urlArgs2['type'] = 'url';
               $sUrl = fGetURL ('move.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_MOVE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
               }
            }  
            else 
            {
               fPrintButtonSpace(1, 17);
            }
         }
         else
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'file';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('move.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_MOVE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
               }
            } 
            else 
            {
               fPrintButtonSpace(1, 17);
            }
            fPrintButtonSpace(1, 4);
         }
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }


   // *****************************************************************************
   // Don't Show the file update icon if the user doesn't have update access to the file
   // *****************************************************************************

   if (!$is_backup_folder and $aFileAccess["owlupdate"] == 1)
   {
      if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
      {
         if ($url != "1")
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'file_update';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('modify.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/update.gif\" border=\"0\" alt=\"$owl_lang->alt_upd_file\" title=\"$owl_lang->alt_upd_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_UPD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/update.gif\" border=\"0\" alt=\"$owl_lang->alt_upd_file\" title=\"$owl_lang->alt_upd_file\" /></a>");
               }
            } 
            else 
            {
               fPrintButtonSpace(1, 17);
            }
            fPrintButtonSpace(1, 4);
         }
         else
         {
            fPrintButtonSpace(1, 25);
         }
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }
   // *****************************************************************************
   // Don't Show the file dowload icon if the user doesn't have download access to the file
   // *****************************************************************************
 
   if($bFileDownload == 1 and $aFileAccess['owlread'] == 1)
   {
      if ($url != "1")
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['binary'] = 1;
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('download.php', $urlArgs2);

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/bin.gif\" border=\"0\" alt=\"$owl_lang->alt_get_file\" title=\"$owl_lang->alt_get_file\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_DNLD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/bin.gif\" border=\"0\" alt=\"$owl_lang->alt_get_file\" title=\"$owl_lang->alt_get_file\" /></a>");
         }
         fPrintButtonSpace(1, 4);
      }
      else
      {
         fPrintButtonSpace(1, 21);
      }
   }

   // *****************************************************************************
   // Don't Show the comment icon if the user doesn't have download access to the file
   // *****************************************************************************

   if ($aFileAccess["owlcomment"] == 1 and !$is_backup_folder)
   {
      $sql = new Owl_DB;
      $sql->query("SELECT * FROM $default->owl_comment_table WHERE fid = '$fid'");
      if($sql->num_rows() == 0) 
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = 'file_comment';
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('modify.php', $urlArgs2);

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment_dis.gif\" border=\"0\" alt=\"$owl_lang->alt_add_comments\" title=\"$owl_lang->alt_add_comments\" /></a>");
         if ($xtpl)
         {
           $xtpl->assign('FILE_ACTION_COMMENT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment_dis.gif\" border=\"0\" alt=\"$owl_lang->alt_add_comments\" title=\"$owl_lang->alt_add_comments\" /></a>");
         }
         fPrintButtonSpace(1, 4);
      } 
      else 
      { 
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = 'file_comment';
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('modify.php', $urlArgs2);

         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment.gif\" border=\"0\" alt=\"$owl_lang->alt_view_comments\" title=\"$owl_lang->alt_view_comments\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_COMMENT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment.gif\" border=\"0\" alt=\"$owl_lang->alt_view_comments\" title=\"$owl_lang->alt_view_comments\" /></a>");
         }
         fPrintButtonSpace(1, 4);
      }
   }
   else
   {
      fPrintButtonSpace(1, 21);
   }

   if ($allicons == 1)
   {
      // *****************************************************************************
      // Don't Show the lock icon if the user doesn't have access to the file
      // *****************************************************************************
      if ($aFileAccess["owlcheckin"] == 1 and !$is_backup_folder and $Realid == $fid)
      {
         if ($url != "1")
         {
            if ($bCheckOK) 
            {
               if ($iCheckedOut <> 0) 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_lock';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

                  print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/unlock.gif\" border=\"0\" alt=\"$owl_lang->alt_unlock_file\" title=\"$owl_lang->alt_unlock_file\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_CHECKOUT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/unlock.gif\" border=\"0\" alt=\"$owl_lang->alt_unlock_file\" title=\"$owl_lang->alt_unlock_file\" /></a>");
                  }
               } 
               else 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_lock';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

                  print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/lock.gif\" border=\"0\" alt=\"$owl_lang->alt_lock_file\" title=\"$owl_lang->alt_lock_file\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_CHECKOUT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/lock.gif\" border=\"0\" alt=\"$owl_lang->alt_lock_file\" title=\"$owl_lang->alt_lock_file\" /></a>");
                  }
               }
            } 
            else 
            {
               fPrintButtonSpace(1, 16); // not sure why this one needs to be 16, but it does to get things lined up
            }
            fPrintButtonSpace(1, 4);
         }
         else
         {
            fPrintButtonSpace(1, 21);
         }
      }
      else
      {
         fPrintButtonSpace(1, 21);
      }
   }

      // *****************************************************************************
      // Don't Show the email icon if the user doesn't have access to email the file
      // *****************************************************************************

      if ($aFileAccess["owlemail"] == 1 and !$is_backup_folder)
      {
         if ($url == "1") 
         {
            //if ($default->owl_version_control == 1) 
            //{
               //fPrintButtonSpace(17);
            //}
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['type']   = 'url';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);

            print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_EMAIL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         } 
         else 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);

            print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_EMAIL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }
      }
      else
      {
         if ($default->owl_version_control == 0) 
         {
            fPrintButtonSpace(1, 4);
         }
         fPrintButtonSpace(1, 21);
      }

      // *****************************************************************************
      // Don't Show the toggle monitor this file  icon if the user doesn't have access 
      // *****************************************************************************

      if ($aFileAccess["owlmonitor"] == 1)
      {
         $sql = new Owl_DB;
         $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
         $sql->next_record();
         $TestEmail = $sql->f("email");
         if ($url != "1") 
         {
            if (trim($TestEmail) != "") 
            {
               $sql->query("SELECT * FROM $default->owl_monitored_file_table WHERE fid = '$fid' AND userid = '$userid'");
               if ($sql->num_rows($sql) == 0) 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_monitor';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

                  print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor\" title=\"$owl_lang->alt_monitor\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_MON', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor\" title=\"$owl_lang->alt_monitor\" /></a>");
                  }
                  fPrintButtonSpace(1, 4);
               }  
               else 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_monitor';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

                  print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored\" title=\"$owl_lang->alt_monitored\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_MON', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored\" title=\"$owl_lang->alt_monitored\" /></a>");
                  }
                  fPrintButtonSpace(1,4);
               }
            }
         }
         else
         {
            if (! empty($TestEmail) )
            {
               fPrintButtonSpace(1,21);
            }
         }
      }

      if($bFileDownload != 1)
      {
         fPrintButtonSpace(1,21);
      }

      if ($aFileAccess["owlrelsearch"] == 1)
      {        
         $urlArgs2 = $urlArgs;
         $urlArgs2['search_id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('search.php', $urlArgs2);
         print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/related.gif\" border=\"0\" alt=\"$owl_lang->alt_related\" title=\"$owl_lang->alt_related\" /></a>");
         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_RELATED', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/related.gif\" border=\"0\" alt=\"$owl_lang->alt_related\" title=\"$owl_lang->alt_related\" /></a>");
         }
         fPrintButtonSpace(1, 4);
      }
 
      // *****************************************************************************
      // Don't Show the view icon if the user doesn't have download access to the file
      // *****************************************************************************
      if ($default->view_doc_in_new_window)
      {
         $sTarget = "target='_new'";
      }

      if($bFileDownload == 1 or $aFileAccess['owlview'] == 1)
      {
         if ($url != "1") 
         {
            $imgfiles = array("jpg","gif","bmp","png");
            if ($ext != "" && preg_grep("/\b$ext\b/", $imgfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'image_preview';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

               print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {

                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
            $htmlfiles = array("php","php3");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'php_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

               print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
            
            $htmlfiles = array("html","htm","xml");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'html_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

               print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
            if ($ext != "" && $ext == "pod") 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'pod_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

               print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
            $txtfiles = array("tpl", "txt","text","README", "readme", "sh", "c", "h", "cpp", "pl", "perl", "sql", "py");
            if ($ext != "" && preg_grep("/\b$ext\b/", $txtfiles)) 
            {
               if(owlfiletype($fid) == 2) 
               { 
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'note_show';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('view.php', $urlArgs2);

                  print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
                  }
                  fPrintButtonSpace(1, 4);
               }
               else
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'text_show';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('view.php', $urlArgs2);

                  print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
                  }
                   fPrintButtonSpace(1, 4);
               }
            }
         }
      }

      // BEGIN what I added to show PDF, DOC, and TXT special view
      if($bFileDownload == 1 and $url != 1)
      {
         $pdffiles = array("pdf");
         if ($ext != "" && preg_grep("/\b$ext\b/", $pdffiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'pdf_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);

            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }
   
         $mswordfiles = array("doc", "sxw", "docx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $mswordfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'doc_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);

            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }
   
         $msexcelfiles = array("xls", "xlsx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $msexcelfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'xls_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
  
            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }

         $emailfiles = array("eml");
         if ($ext != "" && preg_grep("/\b$ext\b/", $emailfiles))
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'email_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }


         if (!empty ($default->view_other_file_type_inline))
         {
            $inline =$default->view_other_file_type_inline;
            if ($ext != "" && preg_grep("/\b$ext\b/", $inline)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'inline';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);
  
               print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
         } 
         $audiofiles = array("mp3");
         if ($ext != "" && preg_grep("/\b$ext\b/", $audiofiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'mp3_play';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
 
            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/play.gif\" border=\"0\" alt=\"$owl_lang->alt_play_file\" title=\"$owl_lang->alt_play_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/play.gif\" border=\"0\" alt=\"$owl_lang->alt_play_file\" title=\"$owl_lang->alt_play_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }
   
         $pptfiles = array("ppt", "pptx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $pptfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'ppt_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);

            print("<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            fPrintButtonSpace(1, 4);
         }
   
         $zipfiles = array("tar.gz", "tgz", "tar", "gz", "zip");
         $bPrintZipView = false;
         if ($ext != "" && preg_grep("/\b$ext\b/", $zipfiles)) 
         {
            if ($ext == "zip" && file_exists($default->unzip_path) && trim($default->unzip_path) != "") 
            {
                  $bPrintZipView = true;
            }
            if ($ext == "gz" && file_exists($default->gzip_path) && trim($default->gzip_path) != "") 
            {
                  $bPrintZipView = true;
            }
            if (($ext == "tar" || $ext == "tar.gz" || $ext == "tgz") && file_exists($default->tar_path) && trim($default->tar_path) != "") 
            {
               if (substr(php_uname(), 0, 7) != "Windows") 
               {
                  $bPrintZipView = true;
               }
            }
            if (substr($filename, -6) == "tar.gz")
            {
               $ext = "tar.gz";
            }
            if ( $bPrintZipView ) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'zip_preview';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $urlArgs2['filext'] = $ext;
               $sUrl = fGetURL ('view.php', $urlArgs2);

               print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
         }
         if ($default->thumbnails == 1 and fisAdmin())
         {
             $filename = fid_to_filename($fid);
             $sFileExtension = fFindFileExtension($filename);
             $aImageExtensionList = $default->thumbnail_image_type;
             $aVideoExtensionList = $default->thumbnail_video_type;
             if ((preg_grep("/$sFileExtension/", $aImageExtensionList)) or (preg_grep("/$sFileExtension/", $aVideoExtensionList)))
             {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'file_thumb';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
               if ($xtpl)
               {
                  $xtpl->assign('FILE_ACTION_GENTHUMB', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
               }
               fPrintButtonSpace(1, 4);
            }
         }
      }
      if ($xtpl)
      {
         $xtpl->parse('main.Files.Action');
      }
}

function displayBrowsePage($parent) 
{
   global $sess, $expand, $order, $sortorder, $sortname, $parent, $curview, $page, $default;
   // If we are hidding the backup directory
   // then change the directory to return to
   // the parent of this backup  directory
   
   if(fid_to_name($parent) == "$default->version_control_backup_dir_name" && $default->hide_backup == 1) 
   {
      $sql = new Owl_DB;
      $sql->query("SELECT parent FROM $default->owl_folders_table WHERE id = $parent");
      $sql->next_record();
      $parent = $sql->f("parent");
   }
   $sAddPageToUrl = "";
   if (!empty($page))
   {
      $sAddPageToUrl = '&page=' . $page;
   }
   if ($default->use_progress_bar == 1)
   {
      header("Location: " . $default->owl_root_url . "/browse.php?sess=$sess$sAddPageToUrl&parent=$parent&expand=$expand&order=$order&$sortorder=$sortname&curview=$curview");
   }
   else
   {
      header("Location: browse.php?sess=$sess$sAddPageToUrl&parent=$parent&expand=$expand&order=$order&$sortorder=$sortname&curview=$curview");
   }

}

function fGetStatusBarCount() 
{
   global $iUpdatedFileCount, $iNewFileCount, $iMyFileCount, $iTotalFileCount, $iQuotaCurrent, $iQuotaMax, $iNewsCount, $iFolderCount, $iFileCount;
   global $default, $owl_lang, $sess, $expand, $userid, $lastlogin, $parent, $usergroupid, $userid;
   global $iMyCheckedOutCount, $iGroupFileCount, $iMonitoredFiles, $iMonitoredFolders, $aNews; 
   global $iWaitingApproval, $iMyPendingDocs;
   global $iBrokenTreeFileCount, $iBrokenTreeFolderCount, $bIsInBrokenTree;

   global $aFoldersCheckedt;
   global $cCommonDBConnection;

   $sql = new Owl_DB;

   $sqlmemgroup = $cCommonDBConnection;
   if (empty($sqlmemgroup))
   {
      $sqlmemgroup = new Owl_DB;
   }


   $iMonitoredFiles = 0;
   $iMonitoredFolders = 0;
   $iMyCheckedOutCount = 0;
   $iUpdatedFileCount = 0;
   $iNewFileCount = 0;
   $iMyFileCount = 0;
   $iGroupFileCount = 0;
   $iTotalFileCount = 0;
   $iQuotaCurrent = 0;
   $iQuotaMax = 0;
   $iNewsCount = 0;
   $iFolderCount = 0;
   $iWaitingApproval = 0;
   $iBrokenTreeFileCount = 0;
   $iBrokenTreeFolderCount = 0;
   $aFoldersChecked = array();
   $aFilesChecked = array();
   

   // ******* Get Total Number of Broken Tree Files and Folders ********
   if ($default->show_file_stats > 0)
   {
      if ( $default->advanced_security == 1 and $default->count_file_folder_special_access) 
      {
         $groups = fGetGroups($userid);
      
         foreach ($groups as $aGroups)
         {
           $qQuery .= " OR a.group_id ='" .$aGroups["0"] . "'";
         }
    
         $sql->query("SELECT DISTINCT id FROM $default->owl_folders_table f, $default->owl_advanced_acl_table a WHERE a.folder_id=id AND a.folder_id <> '1' and (a.user_id = '0' OR a.user_id = '$userid' $qQuery )");
         while ($sql->next_record())
         {
            $bIsInBrokenTree = false;
            fIsInBrokenTree($sql->f('id'));
            if ($bIsInBrokenTree == false)
            {
               continue;
            }
            $iBrokenTreeFolderCount++;
         }
   
         $sql->query("SELECT DISTINCT id, parent FROM $default->owl_files_table f, $default->owl_advanced_acl_table a WHERE a.file_id=id AND (a.user_id = '0' or a.user_id = '$userid' $qQuery )");
         while($sql->next_record())
         {
            $bIsInBrokenTree = false;
            fIsInBrokenTree($sql->f('parent'));
            if ($bIsInBrokenTree == false)
            {
               continue;
            }
            $iBrokenTreeFileCount++;
         }
      } 
   
      // ******* Get Total Number of Monitored Files and Folders ********
   
      $sql->query("SELECT id FROM $default->owl_monitored_file_table  WHERE userid = '$userid'");
      $iMonitoredFiles =  $sql->num_rows();
   
      $sql->query("SELECT id FROM $default->owl_monitored_folder_table WHERE userid = '$userid'");
      $iMonitoredFolders  =  $sql->num_rows();
      
   
      $sql->query("SELECT id FROM $default->owl_folders_table WHERE parent = '$parent'");
      if ($default->restrict_view == 1)
      {
         while($sql->next_record()) 
         {
            if (check_auth($sql->f("id"), "folder_view", $userid, false, false))
            {
               $iFolderCount++;
            } 
         }
      }
      else
      {
         $iFolderCount = $sql->num_rows();
      }

      // ******* Get Total Number of Files in Current Folder ********
      $iID = "";
      $sql->query("SELECT id from $default->owl_files_table where parent = '$parent' AND approved = '1'");
      if ($default->restrict_view == 1)
      {
         while($sql->next_record())
         {
            $iID = $sql->f("id");
            if (empty($aFilesChecked[$iID]['file_download']))
            {
               $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
            }
            if ($aFilesChecked[$iID]['file_download'] == 1)
            {
               $iFileCount++;
            }
         }
      }
      else
      {
         $iFileCount = $sql->num_rows();
      }



      // ******* Get Count of Updated Files ********
      $iID = "";
      $sql->query("SELECT id FROM $default->owl_files_table where smodified > '$lastlogin' and created < '$lastlogin' AND approved = '1'");
      while($sql->next_record())
      {
         $iID = $sql->f("id");
         if (empty($aFilesChecked[$iID]['file_download']))
         {
            $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
         }
         if ($aFilesChecked[$iID]['file_download'] == 1)
         {
           $iUpdatedFileCount++;
         }
      }

      // ******* Get Count of New Files ********

      $iID = "";
      $sql->query("SELECT id, parent FROM $default->owl_files_table where created > '$lastlogin' AND approved = '1'");
      while($sql->next_record())
      {
         $iID = $sql->f("id");
         $iParent = $sql->f("parent");
         if (empty($aFilesChecked[$iID]['file_download']))
         {
            $aFilesChecked[$iID]['file_download'] = check_auth($iID, "file_download", $userid, false, false);
         }
         if ($aFilesChecked[$iID]['file_download'] == 1)
         {
            $sDirectoryPath = get_dirpath($iParent);
            $pos = strpos($sDirectoryPath, "backup");
            if (!(is_integer($pos) && $pos))
            {
               $iNewFileCount++;
            }
         }
      }
 
      // ******* Get Count of That users Files ********
   
      $sql->query("SELECT id FROM $default->owl_files_table WHERE creatorid = '$userid'");
      $iMyFileCount = $sql->num_rows();
   
      // ****** Get Count that user has checked out*****
      $sql->query("SELECT id FROM $default->owl_files_table WHERE checked_out = '$userid'");
      $iMyCheckedOutCount = $sql->num_rows();
   
      // ******* Get Count of All Files ********
   
      $sql->query("SELECT id FROM $default->owl_files_table WHERE approved = '1'");
      $iTotalFileCount = $sql->num_rows();
   
      // ******* Get Count of All Files ********
   
      $sql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
      $sql->next_record();
      $iQuotaCurrent = $sql->f("quota_current");
      $iQuotaMax = $sql->f("quota_max");
   
      $iPercent = $iQuotaCurrent ;
   }

   // ******* Get Count of New News ********

   $iLastNews = $sql->f("lastnews");
   if (!isset($iLastNews))
   {
       $iLastNews = 0;
   }

   $sqlmemgroup->query("SELECT * FROM $default->owl_users_grpmem_table WHERE groupid is not NULL AND userid = '" . $userid . "'");
   $sGroupsWhereClause = "( gid = '-1' OR gid = '$usergroupid'";
   $sFilesGroupsWhereClause = "( groupid = '-1' OR groupid = '$usergroupid'";

   while($sqlmemgroup->next_record())
   {
      $sGroupsWhereClause .= " OR gid = '" . $sqlmemgroup->f("groupid") . "'";
      $sFilesGroupsWhereClause .= " OR groupid = '" . $sqlmemgroup->f("groupid") . "'";
   }
   $sGroupsWhereClause .= ")";
   $sFilesGroupsWhereClause .= ")";

   $sMyQuery = "SELECT * FROM $default->owl_news_table WHERE $sGroupsWhereClause and id > '$iLastNews'  and news_end_date >= " . $sql->now();
   $sql->query($sMyQuery);
   $iNewsCount = $sql->num_rows();
 
   $i = 0; 
   while($sql->next_record())
   {
      $aNews[$i]['id'] = $sql->f("id");
      $aNews[$i]['news_title'] = $sql->f("news_title");
      $aNews[$i]['news_date'] = $sql->f("news_date");
      $aNews[$i]['news'] = $sql->f("news");
      $i++;
   }
   
   // ******* Get Count of files in My Groups  ********

   $sMyQuery = "SELECT * FROM $default->owl_files_table WHERE $sFilesGroupsWhereClause  AND approved = '1'";
   $sql->query($sMyQuery);
   $iGroupFileCount = $sql->num_rows();


   // ******* Get Count of files for Review********
   if ( $default->document_peer_review == 1)
   {
      $sMyQuery = "SELECT distinct file_id from $default->owl_peerreview_table WHERE reviewer_id = '$userid' AND status='0'";

      $sql->query($sMyQuery);
      $iWaitingApproval = $sql->num_rows();

      $sMyQuery = "SELECT id FROM $default->owl_files_table WHERE creatorid = '$userid' and approved = '0'";
      $sql->query($sMyQuery);
      $iMyPendingDocs = $sql->num_rows();
   }

}

function fPrintCustomFields ($iCurrentDocType, $iFileId, $iRequired = 0 , $sWhereClause = "", $sReadonly = "", $sBlock = "DataBlock.File")
{
   global $default, $language, $owl_lang;
   global $xtpl;

      $sql_custom = new Owl_DB;
      $sql_custom_values = new Owl_DB;

      if(!empty($sReadonly))
      {
         $sDisabled = "disabled=\"disabled\"";
      }

      if(!empty($sWhereClause))
      {
         $sWhereClause = " and show_in_list = '1' ";
      }

      $bPrintInitialHeading = true;

      if (!empty($iCurrentDocType))
      {
               $sql_custom->query("SELECT * from $default->owl_docfields_table where doc_type_id = '" . $iCurrentDocType. "'  $sWhereClause  order by field_position");

               $qFieldLabel = new Owl_DB;

               while ($sql_custom->next_record())
               {

                  $sql_custom_values->query("SELECT  field_value from $default->owl_docfieldvalues_table where file_id = '" . $iFileId . "' and field_name = '" . $sql_custom->f("field_name") ."'");
                  $values_result = $sql_custom_values->next_record();

                  $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql_custom->f("id") . "'");
                  $qFieldLabel->next_record();

                  $iRequired = $sql_custom->f("required");
                  if ($iRequired == "1")
                  {
                     $required = "<font color=red><b>&nbsp;*&nbsp;</b></font>";
                  }
                  else
                  {
                     $required = "<font color=red><b>&nbsp;&nbsp;&nbsp;</b></font>";
                  }

                  if($bPrintInitialHeading)
                  {
                     if ($sql_custom->f("field_position") == 1 and $sql_custom->f("field_type") == "seperator")
                     {
                              $xtpl->assign('DOC_TYPE_SEP_LABEL', $qFieldLabel->f("field_label"));
                              $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Separator');
                     }
                     else
                     {
                           $xtpl->assign('DOC_TYPE_HEADING', $owl_lang->doc_specific);
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Heading');
                     }
                     $bPrintInitialHeading = false;
                 }

                  $sFieldType = $sql_custom->f("field_type");
                  if ($sFieldType == "picklist" and !empty($sReadonly))
                  {
                     $sFieldType = "text";
                  }
                  if ($sFieldType == "date" and !empty($sReadonly))
                  {
                     $sFieldType = "text";
                  }

                  switch ($sFieldType)
                  {
                     case "seperator":
                        if ($sql_custom->f("field_position") > 1)
                        {
                              $xtpl->assign('DOC_TYPE_SEP_LABEL', $qFieldLabel->f("field_label"));
                              $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Separator');
                        }
                     break;

                     case "text":
                        if (!empty($sReadonly))
                        {
                           $sClass = "readonly";
                        }
                        else
                        {
                           $sClass = "finput1";
                        }

     
                           $xtpl->assign('DOC_TYPE_TEXT_LABEL', $qFieldLabel->f("field_label"));
                           $xtpl->assign('DOC_TYPE_TEXT_REQ', $required);
                           $xtpl->assign('DOC_TYPE_TEXT_CLASS', $sClass);
                           $xtpl->assign('DOC_TYPE_TEXT_DISABLED', $sDisabled);
                           //$xtpl->assign('DOC_TYPE_TEXT_TYPE', $sql_custom->f("field_type"));
                           $xtpl->assign('DOC_TYPE_TEXT_TYPE', 'text');
                           $xtpl->assign('DOC_TYPE_TEXT_NAME', $sql_custom->f("field_name"));
                           $xtpl->assign('DOC_TYPE_TEXT_SIZE', $sql_custom->f("field_size"));
                           $xtpl->assign('DOC_TYPE_TEXT_VALUE', $sql_custom_values->f("field_value"));
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Text');
                        break;
                     case "picklist":
                       $aPickListValues = array();
                       $aPickList = array();

                       $aPickList = split("\|",  $sql_custom->f("field_values"));
                       $i = 0;
                       foreach ($aPickList as $sValues)
                       {
                          $aPickListValues[$i][0] = $sValues;
                          $aPickListValues[$i][1] = $sValues;
                          $i++;
                       }
                       if (empty($sReadonly))
                       {
                          fPrintFormSelectBox($qFieldLabel->f("field_label") .": $required", $sql_custom->f("field_name"), $aPickListValues, $sql_custom_values->f("field_value"));
                       }
                       break;
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
                             case "table":
                                $aPickListValues = array();
                                $table = $sql_custom->f("field_values");
                                $xtpl->assign('DOC_TYPE_TABLE_LABEL', $qFieldLabel->f("field_label"));
                                $xtpl->assign('DOC_TYPE_TABLE_NAME', $sql_custom->f("field_label"));
                                $xtpl->assign('DOC_TYPE_TABLE_REQ', $required);
                                $table = 'ut_entities';
                                $qTablePickValue = new Owl_Db;
                                $qTablePickValue->query("SELECT * FROM $table ORDER BY descr");
                       //          $i = 0;
                                // while ($qTablePickValue->next_record())
                                while ($qTablePickValue->next_record())
                                {
                                   $xtpl->assign('DOC_TYPE_TABLE_SELECTED', '');
                                   $xtpl->assign('DOC_TYPE_TABLE_VALUE', $qTablePickValue->f("descr"));

                                   if ($qTablePickValue->f("descr") == $sql_custom_values->f("field_value"))
                                   {
                                      $xtpl->assign('DOC_TYPE_TABLE_SELECTED', ' selected="selected"');
                                   }
                                   $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Table.Value');
                                   //$aPickListValues[$i][0] = $qTablePickValue->f("descr");
                                //   //$aPickListValues[$i][1] = $qTablePickValue->f("descr");
                                   // $i++;
                                }
                                $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Table');
                                //fPrintFormSelectBox($qFieldLabel->f("field_label") .": $required", $sql_custom->f("field_name"), $aPickListValues, $sql_custom_values->f("field_value"));
                                break;
                             case "url":
                                $aURL = split("\|", $sql_custom->f("field_values"));
                                $xtpl->assign('DOC_TYPE_URL_LABEL', $qFieldLabel->f("field_label"));
                                $xtpl->assign('DOC_TYPE_URL_REQUIRED', $required);
                                $xtpl->assign('DOC_TYPE_TYPE_URL_LOC', $aURL[1]);
                                $xtpl->assign('DOC_TYPE_TYPE_URL_LABEL', $aURL[0]);
                                $xtpl->parse('main.' . $sBlock . '.DocFields.Row.Url');
                                //fPrintURL($sql_custom->f("field_label"), $aURL[0], $aURL[1]);
                                break;
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
                  case "mcheckbox":
                    $aMultipleCheckBoxLabel = array();
                    $aMultipleCheckBoxLabel = split("\|",  $sql_custom->f("field_values"));
                    $aMultipleCheckBox = split("\|",  $sql_custom_values->f("field_value"));
                    $i = 0;
                    $iNumberColumns  = $sql_custom->f("field_size");
                    $xtpl->assign('DOC_TYPE_MCHECK_LABEL', $qFieldLabel->f("field_label"));
                    $xtpl->assign('DOC_TYPE_MCHECK_REQ', $required);
                    foreach ($aMultipleCheckBoxLabel as $sLabel)
                    {
                       $sValues = $aMultipleCheckBox[$i];
                       if (!empty($sValues))
                       {
                          $checked = "checked=\"checked\"";

                       }
                       else
                       {
                          $checked = "";
                       }
                       $iColumnCount = $i % $iNumberColumns;
                    if ($default->debug_pre_xtemplate_html)
                    {
                       if ($iColumnCount == 0)
                       {
                         print("<tr>\n");
                       }
                       print("<td class=\"form9\" width=\"1%\">");
                       print("<input class=\"fcheckbox1\" $sDisabled type=\"checkbox\" name=\"" . $sql_custom->f("field_name") . "_$i\" value=\"".$aMultipleCheckBoxLabel[$i]."\" $checked />");
                       print("</td>\n");

                       print("<td  class=\"form9\">");
                       print("$aMultipleCheckBoxLabel[$i]");
                       print("</td>\n");
                       if ($iCoumnCount == ($iNumberColumns - 1))
                       {
                         print("</tr>\n");
                       }
					   }
                       if ($xtpl)
                       {
                          $xtpl->assign('DOC_TYPE_MCHECK_DISABLED', $sDisabled);
                          $xtpl->assign('DOC_TYPE_MCHECK_NAME', $sql_custom->f("field_name") . "_$i");
                          $xtpl->assign('DOC_TYPE_MCHECK_VALUE', $aMultipleCheckBoxLabel[$i]);
                          $xtpl->assign('DOC_TYPE_MCHECK_CHECKED', $checked);
                          $xtpl->parse('main.' . $sBlock . '.DocFields.Row.MultipleCheck.Input');
                       }
                       $aMultipleCheckBox[$i]= $sValues;
                       $i++;
                    }
                    //if ($default->debug_pre_xtemplate_html)
                    //{
                       //for ($c = 0; $c < $iNumberColumns - $iCoumnCount - 1; $c++)
                       //{
                          //print("<td  class=\"form9\">&nbsp;</td>\n");
                          //print("<td  class=\"form9\">&nbsp;</td>\n");
                       //}
                       //print("</tr>\n</table>\n");
                       //print("</td>\n</tr>\n");
					//}
                    //if ($xtpl)
                    //{
                       $xtpl->parse('main.' . $sBlock . '.DocFields.Row.MultipleCheck');
                    //}
                  break;
                     case "radio":
                       $aRadioButtonValues = array();
                       $aRadioButtons = array();
                        $sSelectedValue = '';

                        $aRadioButtons = split("\|",  $sql_custom->f("field_values"));
                        $i = 0;
                        foreach ($aRadioButtons as $sValues)
                        {
                           $aRadioButtonValues[$i]= $sValues;
                           if ($sValues == $sql_custom_values->f("field_value"))
                           {
                              $sSelectedValue = $i;
                           }
                           $i++;
                        }
//print("<BR />sSelectedValue: " . $sSelectedValue);
                        //fPrintFormDoctypeRadioXtpl($qFieldLabel->f("field_label") .": $required" , $sql_custom->f("field_name"), $sSelectedValue, $aRadioButtonValues, $sDisabled , $iFileId, $sBlock);
                        fPrintFormDoctypeRadioXtpl($qFieldLabel->f("field_label") .": $required" , $sql_custom->f("field_name"), $sql_custom_values->f("field_value"), $aRadioButtonValues, $sDisabled , $iFileId, $sBlock);
                     break;
                     case "textarea":
                           $xtpl->assign('DOC_TYPE_TEXTAREA_LABEL', $qFieldLabel->f("field_label"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_REQ', $required);
                           $xtpl->assign('DOC_TYPE_TEXTAREA_NAME', $sql_custom->f("field_name"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_SIZE', $sql_custom->f("field_size"));
                           $xtpl->assign('DOC_TYPE_TEXTAREA_VALUE', $sql_custom_values->f("field_value"));
                           $xtpl->parse('main.' . $sBlock . '.DocFields.Row.TextArea');
                     break;
                      case "checkbox":
                        if($sql_custom_values->f("field_value"))
                        {
                           $checked = "checked";
                        }
                        else
                        {
                           $checked = "";
                        }
                        $xtpl->assign('DOC_TYPE_CHECKBOX_LABEL', $qFieldLabel->f("field_label"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_CHECKED', $checked);
                        $xtpl->assign('DOC_TYPE_CHECKBOX_REQ', $required);
                        $xtpl->assign('DOC_TYPE_CHECKBOX_NAME', $sql_custom->f("field_name"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_VALUE', $sql_custom->f("field_name"));
                        $xtpl->assign('DOC_TYPE_CHECKBOX_DISABLED', $sDisabled);
                        $xtpl->parse('main.' . $sBlock . '.DocFields.Row.CheckBox');
                     break;
                  }
                  $xtpl->parse('main.' . $sBlock . '.DocFields.Row');
               }
      }
         if ($sql_custom->num_rows() > 0)
         {
               $xtpl->parse('main.' . $sBlock . '.DocFields.Footer');
         }
         $xtpl->parse('main.' . $sBlock . '.DocFields');
}
/*
*This Function display the custom field
*inside description popup window
* added by maurizio (madal2005)
*/

function fPopCustomFields ($iCurrentDocType, $iFileId)
{
   global $default, $language, $owl_lang, $cCommonDBConnection;

   $sql_custom = $cCommonDBConnection;

   if (empty($sql_custom))
   {
      $sql_custom = new Owl_DB;
   }

   $sPopCustomField = "";
   $sql_custom_values = new Owl_DB;

   $header_custpopup="<table class=\"title1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">". $owl_lang->cust_headpopup. "</td></tr></table>";
   $footer_custpopup="<table class=\"title1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" height=\"2px\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\"></td></tr></table>";

   if (!empty($iCurrentDocType))
   {
      $sql_custom->query("SELECT * from $default->owl_docfields_table where doc_type_id = '" . $iCurrentDocType. "'  order by field_position");
      $qFieldLabel = new Owl_DB;
      while ($sql_custom->next_record())
      {

         $sql_custom_values->query("SELECT  field_value from $default->owl_docfieldvalues_table where file_id = '" . $iFileId . "' and field_name = '" . $sql_custom->f("field_name") ."'");
         $values_result = $sql_custom_values->next_record();

         $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql_custom->f("id") . "'");
         $qFieldLabel->next_record();

         switch ($sql_custom->f("field_type"))
         {
            case "seperator":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  if ($sql_custom->f("field_position") > 1)
                  {
                     $sPopCustomField =  $qFieldLabel->f("field_label");
                  }
               }
            break;

            case "text":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=  $sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "picklist":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                    $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                    $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "mcheckbox":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $aMultipleCheckBoxLabel = split("\|",  $sql_custom->f("field_values"));
                  $aMultipleCheckBox = split("\|",  $sql_custom_values->f("field_value"));
                  $i = 0;
                  $iNumberColumns  = $sql_custom->f("field_size");
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  foreach ($aMultipleCheckBox as $sValues)
                  {
                     if (!empty($sValues))
                     {
                        $sPopCustomField.=$aMultipleCheckBoxLabel[$i]."|";
                     }
                     $aMultipleCheckBox[$i]= $sValues;
                     $i++;
                  }
                  $sPopCustomField.= substr($sPopCustomField,0,strlen($sPopCustomField)-1);
                  $sPopCustomField.= "<br>";
               }
            break;
            case "radio":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $aRadioButtons = array();
                  $aRadioButtons = split("\|",  $sql_custom->f("field_values"));
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  foreach ($aRadioButtons as $sValues)
                  {
                     if ($sValues == $sql_custom_values->f("field_value"))
                     {
                        $sPopCustomField.= $sValues;
                     }
                  }
               }
            break;
            case "textarea":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
               }
            break;
            case "checkbox":
               if ($sql_custom->f("show_desc") ==" 1")
               {
                  $sPopCustomField.= "<b>". $qFieldLabel->f("field_label") .":</b>&nbsp;";
                  $sPopCustomField.=$sql_custom_values->f("field_value") ."<br>";
                  if($sql_custom_values->f("field_value"))
                  {
                     $checked = "checked";
                  }
                  else
                  {
                     $checked = "";
                  }
               }
            break;
         }
      }
   }
   if (strlen($sPopCustomField)>0)
   {
      $sPopCustomField = $header_custpopup . $sPopCustomField . $footer_custpopup;
   }

   return $sPopCustomField;
}

function fGetBrowserLanguage()
{
   global $default;

   $sBrowserLanguage =  substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

   switch ($sBrowserLanguage)
   {
      case "ar":
         $sOwlLang = "Arabic";
         break;
      case "bg":
         $sOwlLang = "Bulgarian";
         break;
      case "bg":
         $sOwlLang = "Catalan";
         break;
      case "cs":
         $sOwlLang = "Czech";
         break;
      case "da":
         $sOwlLang = "Danish";
         break;
      case "de":
         $sOwlLang = "Deutsch";
         break;
      case "el":
         $sOwlLang = "Hellinic";
         break;
      case "en":
         $sOwlLang = "English";
         break;
      case "es":
         $sOwlLang = "Spanish";
         break;
      case "et":
         $sOwlLang = "Estonian";
         break;
      case "fi":
         $sOwlLang = "Finnish";
         break;
      case "fr":
         $sOwlLang = "French";
         break;
      case "hu":
         $sOwlLang = "Hungarian";
         break;
      case "it":
         $sOwlLang = "Italian";
         break;
      case "ja":
         $sOwlLang = "Japanese";
         break;
      case "nl":
         $sOwlLang = "Dutch";
         break;
      case "no":
         $sOwlLang = "Norwegian";
         break;
      case "pl":
         $sOwlLang = "Polish";
         break;
      case "pt":
         if(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 5 == "pt-br"))
         {
            $sOwlLang = "Brazilian";
         }
         else
         { 
            $sOwlLang = "Portuguese";
         }
         break;
      case "ro":
         $sOwlLang = "Romanian";
         break;
      case "ru":
         $sOwlLang = "Russian";
         break;
      case "sk":
         $sOwlLang = "Slovak";
         break;
      case "sl":
         $sOwlLang = "Slovenian";
         break;
      case "sv":
         $sOwlLang = "Swedish";
      break;
      case "zh":
         $sOwlLang = "Chinese-b5";
         break;
      default:
         $sOwlLang = $default->owl_lang;
         break;
   }

   if(!file_exists($default->owl_LangDir . DIR_SEP . $sOwlLang))
   {
      $sOwlLang = $default->owl_lang;
   }
   return $sOwlLang; 
}
$default->owl_maintenance_mode = NULL;
?>
