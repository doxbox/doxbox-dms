<?php

/**
 * jupload.php
 * 
 * Author: Steve Bourgeois <owl@bozzit.com>
 * Project Founder: Chris Vincent <cvincent@project802.net>
 *
 * Copyright (c) 1999-2005 The Owl Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 * 
 */

require_once(dirname(dirname(__FILE__))."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/jupload.xtpl");
$xtpl = new XTemplate("html/jupload.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

if( $default->enable_jupload_interface == 0)
{
   displayBrowsePage($parent);
}

if ($expand == 1)
{
   $xtpl->assign('VIEW_WIDTH', $default->table_expand_width);
}  
else  
{     
   $xtpl->assign('VIEW_WIDTH', $default->table_collapse_width);
}


fSetLogo_MOTD();
fSetPopupHelp();

if ($sess == "0" && $default->anon_ro > 1)
{
 header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=4&fileid=$fileid&parent=$parent&currentdb=$default->owl_current_db");
   exit;
}

include_once($default->owl_fs_root ."/lib/header.inc");
include_once($default->owl_fs_root ."/lib/userheader.inc");


if(!isset($type))
{
   $type = "";
}

// V4B RNG Start
$urlArgs = array();
$urlArgs['sess']      = $sess;
$urlArgs['parent']    = $parent;
$urlArgs['expand']    = $expand;
$urlArgs['order']     = $order;
$urlArgs['sortorder'] = $sortorder;
$urlArgs['curview']     = $curview;
// V4B RNG End

$urlArgs['action'] = 'jupload';
$sPostUrl = fGetURL ('dbmodify.php', $urlArgs);


$urlArgs['action'] = 'jupload';

$sPostUploadUrl = fGetURL ('browse.php', $urlArgs);


$xtpl->assign('POST_URL', $sPostUrl);
$xtpl->assign('AFTER_UPLOAD_URL', $sPostUploadUrl);

printModifyHeaderXTPL();
fPrintNavBarXTPL($parent, "&nbsp;");

         $xtpl->assign('JUPLOAD_PAGE_TITLE', $owl_lang->jupload_page_title);

         $xtpl->assign('FILE_TITLE_LABEL', $owl_lang->title);
         $xtpl->assign('FILE_KEYWORDS_LABEL', $owl_lang->keywords);

         if ($default->save_keywords_to_db)
         {
            $xtpl->assign('FILE_KEYWORDS_SAVE_LABEL', $owl_lang->save_keyword);
            $xtpl->assign('FILE_KEYWORDS_SAVED_LABEL', $owl_lang->saved_keywords);

            $xtpl->parse('main.Jupload.SaveKeyWords');
            $KeyWrd = new Owl_DB;
            $KeyWrd->query("SELECT keyword_text FROM $default->owl_keyword_table ORDER BY keyword_text");
            $i = 0;
            $keywords = array();
            while ($KeyWrd->next_record())
            {
               $keywords[$i][0] = $KeyWrd->f("keyword_text");
               $keywords[$i][1] = $KeyWrd->f("keyword_text");
               $i++;
            }
            $rows = array();
            $rows = fPrintFormSelectBoxXTPL("KEYWORDS" , "keywordpick[]", $keywords, $parent, 5, false, true);
            $rowsize = count($rows);

            for ($i=1; $i<=$rowsize; $i++)
            {
              $xtpl->assign('SELECT_BOX', $rows[$i]);
              $xtpl->parse('main.Jupload.SaveKeyWordPick.SelectBox');
            }
            $xtpl->parse('main.Jupload.SaveKeyWordPick');
         }

      if ($default->owl_version_control == 1)
      {
         $xtpl->assign('FILE_MAJORVERSION_LABEL', $owl_lang->vermajor);
         $xtpl->assign('FILE_MAJORVERSION_VALUE', $default->major_revision);
         
         $xtpl->assign('FILE_MINORVERSION_LABEL', $owl_lang->verminor);
         $xtpl->assign('FILE_MINORVERSION_VALUE', $default->minor_revision);
      }

      $xtpl->assign('FILE_DESC_LABEL', $owl_lang->description);

      if ($default->debug == false)
      {
         $xtpl->parse('main.Jupload.Debug');
      } 
      else
      {
         $xtpl->parse('main.Jupload.Normal');
      }
       
      $xtpl->parse('main.Jupload');
      fSetElapseTime();
      $xtpl->parse('main.Footer');
      $xtpl->parse('main');
      $xtpl->out('main');
