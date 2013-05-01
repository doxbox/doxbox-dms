<?php
/**
 * lib.xtpl.php -- Display Functions Converted to XTemplate
 * 
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

include_once($default->owl_fs_root . "/scripts/xtemplate/xtemplate.class.php");


function fPrintPrefsXTPL ($location)
{
   global $default, $language, $userid, $parent;
   global $sess, $expand, $sort, $sortorder, $order, $owl_lang, $action, $type, $curview, $page, $sortname, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $xtpl;
   global $bPasswordPrompt;

   $sAddPageToUrl = "";

   $lastlogin =  fGetLastLogin();

   $urlArgs = array();
   $urlArgs['sess']      = $sess;


   if(!empty($page))
   {
      $urlArgs['page']    = $page;
      $sAddPageToUrl = '&amp;page=' . $page;
   }
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['owluser']   = $userid;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   $sUrl = fGetURL('prefs.php', $urlArgs);

   if (isset($userid) and $userid > 0)
   {
      $xtpl->assign('USERNAME_LABEL', $owl_lang->user);
      $xtpl->assign('USERNAME', uid_to_uname($userid));
      
      $xtpl->assign('FULLNAME_LABEL', $owl_lang->full_name);
      $xtpl->assign('FULLNAME', uid_to_name($userid));

      $xtpl->assign('LASTLOG_LABEL', $owl_lang->last_logged);
      $xtpl->assign('LASTLOG', date($owl_lang->localized_date_format , strtotime($lastlogin) + $default->time_offset));
    
      $xtpl->assign('USERS_TOOLS_MENU', $owl_lang->user_tool_menu_label);
      $xtpl->assign('ADMINS_TOOLS_MENU', $owl_lang->admins_tool_menu_label);

      if (count($default->owl_db_display_name) > 1)
      {
         $xtpl->assign('CURRENTDB_LABEL', $owl_lang->current_db);
         $xtpl->assign('CURRENTDB', $default->owl_db_display_name[$default->owl_current_db] );
      }
   }

   $bAdminButton = false;
   $bOneAdminButton = false;

   if (fIsAdmin(true) and isset($userid))
   {
      $xtpl->assign('BUTTON_ADMIN_URL', "$default->owl_root_url/admin/index.php?sess=$sess$sAddPageToUrl");
      $xtpl->assign('BUTTON_ADMIN_TITLE', $owl_lang->alt_btn_admin);
      $xtpl->assign('BUTTON_ADMIN_LABEL', $owl_lang->btn_admin);
      $bAdminButton = true;
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.Admin');
   }

   if (fIsAdmin() and isset($userid) and $default->collect_trash == 1 and $bAdminButton == false)
   {
      $xtpl->assign('BUTTON_TRASH_URL', "$default->owl_root_url/admin/recycle.php?sess=$sess$sAddPageToUrl");
      $xtpl->assign('BUTTON_TRASH_TITLE', $owl_lang->alt_btn_trash_admin);
      $xtpl->assign('BUTTON_TRASH_LABEL', $owl_lang->btn_trash_admin);
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.Trash');
   }

   if (fIsReportViewer($userid) and isset($userid) and $bAdminButton == false)
   {
      $xtpl->assign('BUTTON_REPVIEW_URL', "$default->owl_root_url/admin/stats.php?sess=$sess", "btn_report_viewer");
      $xtpl->assign('BUTTON_REPVIEW_TITLE', $owl_lang->alt_btn_report_viewer);
      $xtpl->assign('BUTTON_REPVIEW_LABEL', $owl_lang->btn_report_viewer);
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.RepView');
   }

   if (fIsLogViewer($userid) and isset($userid) and $bAdminButton == false)
   {
      $xtpl->assign('BUTTON_LOGVIEW_URL', "$default->owl_root_url/admin/log.php?sess=$sess");
      $xtpl->assign('BUTTON_LOGVIEW_TITLE', $owl_lang->alt_btn_log_viewer);
      $xtpl->assign('BUTTON_LOGVIEW_LABEL', $owl_lang->btn_log_viewer);
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.LogView');
   }

   if (fIsUserAdmin($userid) and isset($userid) and $bAdminButton == false)
   {
      $xtpl->assign('BUTTON_ADMIN_USER_GROUP_URL', "$default->owl_root_url/admin/index.php?sess=$sess$sAddPageToUrl&amp;action=users");
      $xtpl->assign('BUTTON_ADMIN_USER_GROUP_TITLE', $owl_lang->alt_btn_admin_user_group);
      $xtpl->assign('BUTTON_ADMIN_USER_GROUP_LABEL', $owl_lang->btn_admin_user_group);
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.AdminUserGroup');
   }

   if (fIsNewsAdmin($userid) and isset($userid) and $bAdminButton == false)
   {
      $xtpl->assign('BUTTON_ADMIN_NEWS_URL', "$default->owl_root_url/admin/news.php?sess=$sess$sAddPageToUrl");
      $xtpl->assign('BUTTON_ADMIN_NEWS_TITLE', $owl_lang->alt_btn_admin_news);
      $xtpl->assign('BUTTON_ADMIN_NEWS_LABEL', $owl_lang->btn_admin_news);
      $bOneAdminButton = true;
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu.News');
   }

   if ($bOneAdminButton)
   {
      $xtpl->parse('main.PrefsBar' . $location . '.AdminMenu');
   }

   $bIsOneUserTool = false;
   if (prefaccess($userid) and isset($userid) and $userid > 0)
   {
      $xtpl->assign('BUTTON_PREFS_URL', $sUrl);
      $xtpl->assign('BUTTON_PREFS_TITLE', $owl_lang->title_edit_prefs);
      $xtpl->assign('BUTTON_PREFS_LABEL', $owl_lang->preference);
      $xtpl->parse('main.PrefsBar' . $location . '.UserToolsMenu.Prefs');
      $bIsOneUserTool = true;
   }

   if (isset($userid))
   {
      if (!$sess == "0" and $userid > 0)
      {
         $xtpl->assign('BUTTON_LOGINOUT_URL', "$default->owl_root_url/index.php?login=logout&amp;sess=$sess$sAddPageToUrl");
         $xtpl->assign('BUTTON_LOGINOUT_TITLE', $owl_lang->alt_btn_logout);
         $xtpl->assign('BUTTON_LOGINOUT_LABEL', $owl_lang->btn_logout);
      }
      else
      {
         $xtpl->assign('BUTTON_LOGINOUT_URL', "$default->owl_root_url/index.php?login=1", "btn_login");
         $xtpl->assign('BUTTON_LOGINOUT_TITLE', $owl_lang->alt_btn_login);
         $xtpl->assign('BUTTON_LOGINOUT_LABEL', $owl_lang->btn_login);
      }
      $xtpl->parse('main.PrefsBar' . $location . '.LoginOut');
   }

   if(fIsEmailToolAccess($userid))
   {
      $xtpl->assign('BUTTON_MAILTOOL_URL', "$default->owl_root_url/mtool.php?sess=$sess$sAddPageToUrl&amp;parent=$parent&amp;expand=$expand&amp;order=$order&amp;$sortorder=$sortname&amp;curview=$curview");
      $xtpl->assign('BUTTON_MAILTOOL_TITLE', $owl_lang->alt_btn_mail_tool);
      $xtpl->assign('BUTTON_MAILTOOL_LABEL', $owl_lang->btn_mail_tool);
      $xtpl->parse('main.PrefsBar' . $location . '.UserToolsMenu.MailTool');
      $bIsOneUserTool = true;
   }

  if ($bIsOneUserTool)
  {
      $xtpl->parse('main.PrefsBar' . $location . '.UserToolsMenu');
  }

   $xtpl->assign('BUTTON_QUICKLINK_TOP_URL', '#top');
   $xtpl->assign('BUTTON_QUICKLINK_TOP_TITLE', $owl_lang->alt_go_top);
   $xtpl->assign('BUTTON_QUICKLINK_TOP_LABEL', $owl_lang->btn_go_top);

   $xtpl->assign('BUTTON_QUICKLINK_BOTTOM_URL', '#bottom');
   $xtpl->assign('BUTTON_QUICKLINK_BOTTOM_TITLE', $owl_lang->alt_go_bottom);
   $xtpl->assign('BUTTON_QUICKLINK_BOTTOM_LABEL', $owl_lang->btn_go_bottom);

   $xtpl->parse('main.PrefsBar' . $location . '.QuickLink');


   if (! ereg("help_", basename($_SERVER["PHP_SELF"])))
   {
      if (ereg("admin", $_SERVER["PHP_SELF"]) or ereg("jupload", $_SERVER["PHP_SELF"]))
      {
         if (basename(dirname($_SERVER["PHP_SELF"])) == 'admin')
         {     
            $HelpDirectory = "help/admin";
         }
         else
         {
            $HelpDirectory = "help";
         }
         $xtpl->assign('BUTTON_HELP_URL', "../locale/$default->owl_lang/$HelpDirectory/help_". basename($_SERVER["PHP_SELF"]) . "?sess=$sess$sAddPageToUrl&amp;parent=$parent&amp;expand=$expand&amp;order=$order&amp;$sortorder=$sortname&amp;curview=$curview");
         $xtpl->assign('BUTTON_HELP_TITLE', $owl_lang->alt_btn_help);
         $xtpl->assign('BUTTON_HELP_LABEL', $owl_lang->btn_help);
      }
      else
      {
         $HelpDirectory = "help";
         $topic = '';
         if (isset($action))
         {
            $topic = "&amp;action=$action";
         }
         if (isset($type))
         {
            $topic .= "&amp;type=$type";
         }
         if ("dbmodify.php" != basename($_SERVER["PHP_SELF"]))
         {
            $sHelpFile = basename($_SERVER["PHP_SELF"]);
         }
         else
         {
            $sHelpFile = "browse.php";
         }

         $xtpl->assign('BUTTON_HELP_URL', "locale/$default->owl_lang/$HelpDirectory/help_". $sHelpFile . "?sess=$sess$sAddPageToUrl&amp;parent=$parent&amp;curview=$curview&amp;expand=$expand&amp;order=$order&amp;$sortorder=$sortname$topic");
         $xtpl->assign('BUTTON_HELP_TITLE', $owl_lang->alt_btn_help);
         $xtpl->assign('BUTTON_HELP_LABEL', $owl_lang->btn_help);

      }
      if ((isset($userid) and  $_SERVER["PHP_SELF"] != $default->owl_root_url . "/browse.php") or $bPasswordPrompt == true)
      {
         if (empty($expand) and !is_numeric($expand))
         {
            $expand = $default->expand;
         }
         if (empty($order))
         {
            $order = $default->default_sort_column;
         }
         if ($bPasswordPrompt == true)
         {
            $parent =  owlfolderparent($parent);
         }
   if (isset($userid))
   {
      if (!$sess == "0" and $userid > 0)
      {
         $xtpl->assign('BUTTON_BROWSE_URL', $default->owl_root_url . "/browse.php?sess=$sess$sAddPageToUrl&amp;parent=$parent&amp;expand=$expand&amp;order=$order&amp;$sortorder=$sortname&amp;curview=$curview&amp;currentdb=$default->owl_current_db");
         $xtpl->assign('BUTTON_BROWSE_TITLE', $owl_lang->alt_btn_browse);
         $xtpl->assign('BUTTON_BROWSE_LABEL', $owl_lang->btn_browse);
         $xtpl->parse('main.PrefsBar' . $location . '.Browse');
      }
      }
   }
      $xtpl->parse('main.PrefsBar' . $location . '.Help');
   }
   $xtpl->parse('main.PrefsBar' . $location);
}

function fPrintPanelXTPL ($location, $wide)
{
   global $iUpdatedFileCount, $iNewFileCount, $iMyFileCount, $iTotalFileCount, $iQuotaCurrent, $iQuotaMax, $iNewsCount;
   global $iMyCheckedOutCount, $iGroupFileCount, $usergroupid, $aNews;
   global $iMonitoredFiles, $iMonitoredFolders, $iWaitingApproval, $iMyPendingDocs;
   global $default, $owl_lang, $sess, $expand, $userid, $lastlogin, $parent, $order, $sortname, $language, $sortorder, $curview;
   global $iBrokenTreeFileCount, $iBrokenTreeFolderCount;
   global $xtpl;
   global $sort, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;

// V4B RNG Start
   $urlArgs = array();
   $urlArgs['sess']        = $sess;
   $urlArgs['parent']      = $parent;
   $urlArgs['expand']      = $expand;
   $urlArgs['order']       = $order;
   $urlArgs['sort']        = $sortname;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;// V4B RNG End

   if ($wide)
   {
      $wide='Wide';
   }
   else
   {
      $wide='';
   }

   if ($location == 'Top')
   {
      $xtpl->assign('INFOPANEL_ID', '0');
   }
   else
   {
      $xtpl->assign('INFOPANEL_ID', '1');
   }
   

   if ($default->show_file_stats > 0)
   {
      $xtpl->assign('INFOPANEL_TITLE', $owl_lang->panel_file_info);

      //****************
      // NEW FILE COUNT
      //****************
      $urlArgs['type']     = 'n';
      $url = fGetURL ('showrecords.php', $urlArgs);

      $xtpl->assign('INFOPANEL_NEW_IMG_TITLE', $owl_lang->alt_new);
      $xtpl->assign('INFOPANEL_NEW_URL', $url);
      $xtpl->assign('INFOPANEL_NEW_URL_TITLE', $owl_lang->title_view_new);
      $xtpl->assign('INFOPANEL_NEW_LABEL', $owl_lang->tot_new_files);
      $xtpl->assign('INFOPANEL_NEW_TOTAL', $iNewFileCount);

      //*********************
      // UPDATED  FILE COUNT
      //*********************

      $urlArgs['type']     = 'u';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_UPD_IMG_TITLE', $owl_lang->alt_updated);
      $xtpl->assign('INFOPANEL_UPD_URL', $url);
      $xtpl->assign('INFOPANEL_UPD_URL_TITLE', $owl_lang->title_view_updated);
      $xtpl->assign('INFOPANEL_UPD_LABEL', $owl_lang->tot_updated_files);
      $xtpl->assign('INFOPANEL_UPD_TOTAL', $iUpdatedFileCount);

      //*********************
      // MY FILE COUNT
      //*********************

      $urlArgs['type']     = 'm';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_MY_IMG_TITLE', $owl_lang->alt_my);
      $xtpl->assign('INFOPANEL_MY_URL', $url);
      $xtpl->assign('INFOPANEL_MY_URL_TITLE', $owl_lang->title_view_my);
      $xtpl->assign('INFOPANEL_MY_LABEL', $owl_lang->tot_my_files);
      $xtpl->assign('INFOPANEL_MY_TOTAL', $iMyFileCount);

      //*********************
      // MY GROUP FILE COUNT
      //*********************
      $urlArgs['type']     = 'g';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_GRP_IMG_TITLE', $owl_lang->alt_group);
      $xtpl->assign('INFOPANEL_GRP_URL', $url);
      $xtpl->assign('INFOPANEL_GRP_URL_TITLE', $owl_lang->title_view_my);
      $xtpl->assign('INFOPANEL_GRP_LABEL', $owl_lang->tot_my_group);
      $xtpl->assign('INFOPANEL_GRP_TOTAL', $iGroupFileCount);

      //*********************
      // My Checked Out Files
      //*********************

      $urlArgs['type']     = 'c';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_CHK_IMG_TITLE', $owl_lang->alt_checked_out);
      $xtpl->assign('INFOPANEL_CHK_URL', $url);
      $xtpl->assign('INFOPANEL_CHK_URL_TITLE', $owl_lang->title_view_my);
      $xtpl->assign('INFOPANEL_CHK_LABEL', $owl_lang->tot_my_checked_out);
      $xtpl->assign('INFOPANEL_CHK_TOTAL', $iMyCheckedOutCount);

      if ($iMyCheckedOutCount > 0)
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.CheckedOut');
      }
      else
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.CheckedOutZero');
      }

      //*********************
      // My Montitored Files
      //*********************

      $urlArgs['type']     = 't';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_MON_IMG_TITLE', $owl_lang->alt_monitored);
      $xtpl->assign('INFOPANEL_MON_URL', $url);
      $xtpl->assign('INFOPANEL_MON_URL_TITLE', $owl_lang->title_view_my);
      $xtpl->assign('INFOPANEL_MON_LABEL', $owl_lang->tot_monitored);
      $xtpl->assign('INFOPANEL_MONFILE_TOTAL', $iMonitoredFiles);
      $xtpl->assign('INFOPANEL_MONFOLDER_TOTAL', $iMonitoredFolders);

      if ($iMonitoredFolders > 0 or $iMonitoredFiles > 0)
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.Monitor');
      }
      else
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.MonitorZero');
      }

      //*********************
      // Any News Items
      //*********************

      $xtpl->assign('INFOPANEL_NEWS_IMG_TITLE', $owl_lang->alt_news);
      $xtpl->assign('INFOPANEL_NEWS_LABEL', $owl_lang->news_hd);
      $xtpl->assign('INFOPANEL_NEWS_TOTAL', $iNewsCount);

      if($iNewsCount > 0)
      {
         $xtpl->assign('INFOPANEL_NEWS_URL_TITLE', $owl_lang->alt_have_news);
         if($default->allow_popup == 1)
         {
            $xtpl->assign('INFOPANEL_NEWS_URL', "#");
            $xtpl->assign('INFOPANEL_NEWS_ONCLICK', ' onclick="' . "window.open('readnews.php?sess=$sess', 'NewsWindow', 'status=no,directories=no,scrollbars=yes,title=yes,menubar=no,resizable=yes,toolbar=no,location=no,width=400,height=480');" . '"' );
         }
         else
         {
            $xtpl->assign('INFOPANEL_NEWS_ONCLICK', '');
            $xtpl->assign('INFOPANEL_NEWS_URL', "readnews.php?sess=$sess");
         }
      }
      else
      {
            $xtpl->assign('INFOPANEL_NEWS_URL_TITLE', $owl_lang->alt_have_no_news);
            $xtpl->assign('INFOPANEL_NEWS_ONCLICK', '');
            $xtpl->assign('INFOPANEL_NEWS_URL', "#");
      }

      //*********************
      // My Broken Tree
      //*********************

      if ($default->advanced_security == 1 )
      {
         $xtpl->assign('INFOPANEL_SPEC_IMG_TITLE', $owl_lang->alt_special_access);
         $xtpl->assign('INFOPANEL_SPEC_URL_TITLE', $owl_lang->special_access_count_alt);
         $xtpl->assign('INFOPANEL_SPEC_LABEL', $owl_lang->special_access_count);

         if ($default->count_file_folder_special_access)
         {
            $urlArgs['type']     = 'br';
            $url = fGetURL ('showrecords.php', $urlArgs);
	  
            $xtpl->assign('INFOPANEL_SPEC_URL', $url);
            $xtpl->assign('INFOPANEL_SPECFILE_TOTAL', $iBrokenTreeFileCount);
            $xtpl->assign('INFOPANEL_SPECFOLDER_TOTAL', $iBrokenTreeFolderCount);
            if ($iBrokenTreeFileCount > 0 or $iBrokenTreeFolderCount > 0)
            {
               $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.SpecAccess');
            }
            else
            {
               $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.SpecAccessZero');
            }
         }
         else
         {
            $urlArgs['type']     = 'br';
            $url = fGetURL ('showrecords.php', $urlArgs);
	  
            $xtpl->assign('INFOPANEL_SPEC_URL', $url);
            $xtpl->assign('INFOPANEL_SPECFILE_TOTAL', '?');
            $xtpl->assign('INFOPANEL_SPECFOLDER_TOTAL', '?');
            $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.SpecAccess');
         }
      }

     //***********************************************
     // if Quota is enabled show quota information
     //**********************************************

      if($iQuotaMax <> 0)
      {
         $iPercent = round(($iQuotaCurrent / $iQuotaMax), 1) * 100;
         if ($iPercent > 100)
         {
            $iPercent = 100;
         }

         $xtpl->assign('INFOPANEL_QUOTA_IMG_TITLE', htmlentities($owl_lang->disk_quota . " $iPercent " . '%'));
         $xtpl->assign('INFOPANEL_QUOTA_IMG', "quota_$iPercent");
         $xtpl->assign('INFOPANEL_QUOTA_LABEL', $owl_lang->disk_quota);
         $xtpl->assign('INFOPANEL_QUOTA_TOTAL', '(' . gen_filesize($iQuotaCurrent) .' / '.  gen_filesize($iQuotaMax) . ')');
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel.Quota');
      }

      $xtpl->assign('INFOPANEL_TOTAL_LABEL', $owl_lang->tot_files);
      $xtpl->assign('INFOPANEL_TOTAL', $iTotalFileCount);
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanel');
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.FilePanelTab');
   }


   // *********************************
   // NEWS Panel  BEGIN
   // *********************************

   if(count($aNews) > 0)
   {
      $xtpl->assign('INFOPANEL_NEWSPANEL_HEADER', $owl_lang->news_hd . ' (' . count($aNews) . ')');

      foreach ($aNews as $news)
      {
         if($default->allow_popup )
         {
            $xtpl->assign('INFOPANEL_NEWSPANEL_URL', '#');
            $xtpl->assign('INFOPANEL_NEWSPANEL_JAVASCRIPT', "onclick=\"window.open('readnews.php?sess=$sess', 'NewsWindow', 'status=no,directories=no,scrollbars=yes,title=yes,menubar=no,resizable=yes,toolbar=no,location=no,width=400,height=480');\"  onmouseover=" . '"' . sprintf($default->domtt_popup , addslashes($news['news_title']) , fCleanDomTTContent($news['news']), $default->popup_lifetime) . '"');
         }
         else
         {
            $xtpl->assign('INFOPANEL_NEWSPANEL_JAVASCRIPT', '');
           $xtpl->assign('INFOPANEL_NEWSPANEL_URL', "readnews.php?sess=$sess");
         }
         $xtpl->assign('INFOPANEL_NEWSPANEL_TITLE', $news['news_title']);
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.NewsPanel.NewsRow');
      }
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.NewsPanel');
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.NewsPanelTab');
   }
   // *********************************
   // NEWS Panel  END
   // *********************************

   // *********************************
   // PEER Review Panel  BEGIN
   // *********************************

   if ($default->document_peer_review == 1)
   {
      $sPeerRevImage = '';
      if ($iWaitingApproval > 0 or $iMyPendingDocs > 0)
      {
         $sPeerRevImage = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_misc/review.png\" name=\"peerrev_panel_image\" border=\"0\">";
      }

      $xtpl->assign('INFOPANEL_PEERPANEL_STATUS_IMG', $sPeerRevImage);
      $xtpl->assign('INFOPANEL_PEERPANEL_HEADER', $owl_lang->owl_title_peer_review2);
      $xtpl->assign('INFOPANEL_PEERPANEL_MY_APPROVAL', $owl_lang->peer_my_approval);
      $xtpl->assign('INFOPANEL_PEERPANEL_PENDING_APPROVAL', $owl_lang->peer_pending_approval);
      $xtpl->assign('INFOPANEL_PEERPANEL_MY_APPROVAL_TOT', $iWaitingApproval);
      $xtpl->assign('INFOPANEL_PEERPANEL_PENDING_APPROVAL_TOT', $iMyPendingDocs);

      $urlArgs['type']     = 'wa';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_PEERPANEL_MY_APPROVAL_URL', $url);
      $xtpl->assign('INFOPANEL_PEERPANEL_MY_APPROVAL_URL_TITLE', $owl_lang->alt_my_approval);

      $urlArgs['type']     = 'pa';
      $url = fGetURL ('showrecords.php', $urlArgs);
	  
      $xtpl->assign('INFOPANEL_PEERPANEL_PENDING_APPROVAL_URL', $url);
      $xtpl->assign('INFOPANEL_PEERPANEL_PENDING_APPROVAL_URL_TITLE', $owl_lang->alt_pending_approval);

      if ($iWaitingApproval > 0 )
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanel.MyApproval');
      }
      else
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanel.MyApprovalZero');
      }
      if ($iMyPendingDocs > 0 )
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanel.MyPending');
      }
      else
      {
         $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanel.MyPendingZero');
      }
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanel');
      $xtpl->parse('main.InfoPanel' . $location . $wide . '.PeerPanelTab');
   }
    $xtpl->parse('main.InfoPanel' . $location . $wide );
}

function fPrintSearchXTPL ($location, $seq = 0, $iWithinDocs = 0, $iCurrentFolder = 0)
{
   global $default, $owl_lang, $language, $keywords, $sess, $parent, $expand, $order, $sortorder, $sortname, $boolean, $curview, $sort, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $xtpl;

   if (!isset($boolean))
   {
      $boolean = "";
   }

   $keywords = str_replace('\\\\','\\', stripslashes($keywords));

   if (!isset($keywords))
   {
      $keywords = "";
   }

   switch ($boolean)
   {
      case "all":
         $sAnyChecked = "";
         $sAllChecked = "selected=\"selected\"";
         $sPhraseChecked = "";
         $sExactChecked = "";
         $sStartChecked = "";
         $sEndChecked = "";
         break;
      case "phrase" :
         $sAnyChecked = "";
         $sAllChecked = "";
         $sPhraseChecked = "selected=\"selected\"";
         $sExactChecked = "";
         $sStartChecked = "";
         $sEndChecked = "";
         break;
      case "exact" :
         $sAnyChecked = "";
         $sAllChecked = "";
         $sPhraseChecked = "";
         $sExactChecked = "selected=\"selected\"";
         $sStartChecked = "";
         $sEndChecked = "";
         break;
      case "startwith" :
         $sAnyChecked = "";
         $sAllChecked = "";
         $sPhraseChecked = "";
         $sExactChecked = "";
         $sStartChecked = "selected=\"selected\"";
         $sEndChecked = "";
         break;
      case "endwith" :
         $sAnyChecked = "";
         $sAllChecked = "";
         $sPhraseChecked = "";
         $sExactChecked = "";
         $sStartChecked = "";
         $sEndChecked = "selected=\"selected\"";
        break;
      default:
         $sAnyChecked = "selected=\"selected\"";
         $sAllChecked = "";
         $sPhraseChecked = "";
         $sExactChecked = "";
         $sStartChecked = "";
         $sEndChecked = "";
      break;
   }

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['sort']  = $sortname;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   $xtpl->assign('SEARCH_ID', $seq);
   $xtpl->assign('SEARCH_HIDDEN', fGetHiddenFields ($urlArgs));
   $xtpl->assign('SEARCH_VALUE', $keywords);
   $xtpl->assign('SEARCH_BUTTON_LABEL', $owl_lang->search);

   $rows = array();

    // add some data
    $rows[1]=array('SELECT_BOOL_VALUE'=>'any', 'SELECT_BOOL_LABEL'=>$owl_lang->search_any_word, 'SELECT_BOOL_SELECTED'=>$sAnyChecked);
    $rows[2]=array('SELECT_BOOL_VALUE'=>'all', 'SELECT_BOOL_LABEL'=>$owl_lang->search_all_word, 'SELECT_BOOL_SELECTED'=>$sAllChecked);
    $rows[3]=array('SELECT_BOOL_VALUE'=>'phrase', 'SELECT_BOOL_LABEL'=>$owl_lang->search_entire_phrase, 'SELECT_BOOL_SELECTED'=>$sPhraseChecked);
    $rows[4]=array('SELECT_BOOL_VALUE'=>'exact', 'SELECT_BOOL_LABEL'=>$owl_lang->search_exact_match, 'SELECT_BOOL_SELECTED'=>$sExactChecked);
    $rows[5]=array('SELECT_BOOL_VALUE'=>'startwith', 'SELECT_BOOL_LABEL'=>$owl_lang->search_stats_with, 'SELECT_BOOL_SELECTED'=>$sStartChecked);
    $rows[6]=array('SELECT_BOOL_VALUE'=>'endwith', 'SELECT_BOOL_LABEL'=>$owl_lang->search_ends_with, 'SELECT_BOOL_SELECTED'=>$sEndChecked);
   
    $rowsize = count($rows);
 
    for ($i=1; $i<=$rowsize; $i++) 
    {
        $xtpl->assign('SELECT_BOX', $rows[$i]);
        $xtpl->parse('main.SearchPanel' . $location . '.SelectBox');
    }


   if ($iWithinDocs == 0)
   {
      $sCheck = "";
   }
   else
   {
      $sCheck = " checked=\"checked\"";
   }

   $xtpl->assign('SEARCH_WITHIN_SELECTED', $sCheck);
   $xtpl->assign('SEARCH_WITHIN_LABEL', $owl_lang->search_winthindocs);

   if ($iCurrentFolder == 0)
   {
      $sCheck = "";
   }
   else
   {
      $sCheck = " checked=\"checked\"";
   }

   $xtpl->assign('SEARCH_CURRENT_SELECTED', $sCheck);
   $xtpl->assign('SEARCH_CURRENT_LABEL', $owl_lang->search_currentfolder);

   $xtpl->parse('main.SearchPanel' . $location);
}

function fPrintBulkButtonsXTPL($location, $where = 0)
{
   global $default, $sess, $order, $usergroupid, $owl_lang, $parent, $expand, $order, $sortname, $sortorder, $curview, $sort, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $xtpl;
// V4B RNG Start
   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['sort']  = $sortname;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;
// V4B RNG End
   $xtpl->assign('BULKBUTTONS_HIDDEN', fGetHiddenFields ($urlArgs));

   $xtpl->assign('BULKBUTTONS_DOWNLOAD_LABEL', $owl_lang->btn_bulk_download);
   $xtpl->assign('BULKBUTTONS_DOWNLOAD_ALT', $owl_lang->alt_btn_bulk_download);
   $xtpl->assign('BULKBUTTONS_MOVE_LABEL', $owl_lang->btn_bulk_move);
   $xtpl->assign('BULKBUTTONS_MOVE_ALT', $owl_lang->alt_btn_bulk_move);
   $xtpl->assign('BULKBUTTONS_EMAIL_LABEL', $owl_lang->btn_bulk_email);
   $xtpl->assign('BULKBUTTONS_EMAIL_ALT', $owl_lang->alt_btn_bulk_email);
   $xtpl->assign('BULKBUTTONS_DELETE_LABEL', $owl_lang->btn_bulk_delete);
   $xtpl->assign('BULKBUTTONS_DELETE_ALT', $owl_lang->alt_btn_bulk_delete);
   $xtpl->assign('BULKBUTTONS_DELETE_CONFIRM', $owl_lang->reallydelete_selected);
   $xtpl->assign('BULKBUTTONS_CHECKOUT_LABEL', $owl_lang->btn_bulk_checkout);
   $xtpl->assign('BULKBUTTONS_CHECKOUT_ALT', $owl_lang->alt_btn_bulk_checkout);

   if ( (($default->show_bulk == 1 or $default->show_bulk == 3)and $where == 0) or (fIsAdmin() and $default->show_bulk == 0))
   {
      if ($default->owl_use_fs)
      {
         $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".Download");
      }
      if ($default->owl_version_control == 1)
      {
         $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".Checkout");
      }
            // Add jupload Button
            $urlArgs2 = $urlArgs;
            $urlArgs2['parent'] = $parent;
            $url = fGetURL ('jupload/jupload.php', $urlArgs2);

            $xtpl->assign('ACTIONBUTTON_JUPLOAD_URL', $url);
            $xtpl->assign('ACTIONBUTTON_JUPLOAD_TITLE', $owl_lang->alt_btn_jupload);
            $xtpl->assign('ACTIONBUTTON_JUPLOAD_LABEL', $owl_lang->btn_jupload);
           // $xtpl->parse('main.ActionButtons' . $sequence . '.JUpload');
            $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".JUpload");
            $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location);
   }
   if ( ($default->show_bulk == 2 or $default->show_bulk == 3) and $where == 1)
   {
      if ($default->owl_use_fs)
      {
         $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".Download");
      }
      if ($default->owl_version_control == 1)
      {
         $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".Checkout");
      }
        if ($default->enable_jupload_interface == 1)
         {
            // Add jupload Button
            $urlArgs2 = $urlArgs;
            $urlArgs2['parent'] = $parent;
            $url = fGetURL ('jupload/jupload.php', $urlArgs2);

            $xtpl->assign('ACTIONBUTTON_JUPLOAD_URL', $url);
            $xtpl->assign('ACTIONBUTTON_JUPLOAD_TITLE', $owl_lang->alt_btn_jupload);
            $xtpl->assign('ACTIONBUTTON_JUPLOAD_LABEL', $owl_lang->btn_jupload);
           // $xtpl->parse('main.ActionButtons' . $sequence . '.JUpload');
            $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location . ".JUpload");
         }
   //   $xtpl->parse('main.Bulk.BulkButtons' . $location);
        $xtpl->parse('main.Bulk' . $where . '.BulkButtons' . $location);
   }
//print("A: " . $default->show_bulk);
   //if ( $default->show_bulk == 3 and $where == 0)
   //{
    //  $xtpl->parse('main.Bulk' . $where);
   //}
   //else if ($default->show_bulk == 1 and $where == 0)
   //{
     // $xtpl->parse('main.Bulk' . $where);
   //}
   //else if ($default->show_bulk == 2 and $where == 1)
   //{
      $xtpl->parse('main.Bulk' . $where);
   //}
}

function fPrintFavoriteLinkXTPL ($location = 0)
{
   global $default, $userid;
   global $owl_lang, $language, $keywords, $sess, $parent, $expand, $order, $sortorder, $sortname, $boolean, $curview;
   global $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename, $sort;
   global $xtpl;

   $qFavorite = new Owl_DB;

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['sort']  = $sortname;
   $urlArgs['curview']     = $curview;
   $urlArgs['action']     = "go_fav";
   $urlArgs[${$sortorder}]  = $sort;

   if ($default->allow_track_favorites == 1)
   {
      $xtpl->assign('FAVORITE_TEXT', $owl_lang->favorite);
      $xtpl->assign('FAVORITE_HIDDEN', fGetHiddenFields ($urlArgs));
      $xtpl->assign('FAVORITE_ID', $location);
      $xtpl->assign('FAVORITE_GO', $owl_lang->favorite_go);
      $xtpl->assign('FAVORITE_DELETE', $owl_lang->favorite_delete);
      $xtpl->assign('FAVORITE_ADD', $owl_lang->favorite_add);
      $xtpl->assign('FAVORITE_LABEL', 'Label:');

      $qFavorite->query("SELECT * FROM $default->owl_user_favorites WHERE userid = '$userid'");


      $i = 0;
      $aFavoritList = array();
      while ($qFavorite->next_record())
      {
         $aFavoritList[$i][0] = $qFavorite->f("folder_id");

         $sFavLabel = $qFavorite->f('fav_label');

         if (empty($sFavLabel))
         {
            $aFavoritList[$i][1] = fid_to_name($qFavorite->f("folder_id"));
         }
         else
         {
            $aFavoritList[$i][1] = $qFavorite->f("fav_label");
         }
         $i++;
      }

      $rows = array();
      $rows = fPrintFormSelectBoxXTPL("FAVORITE" , "favorite_id_$seq", $aFavoritList, $parent, "1", false, true);
      $rowsize = count($rows);

      for ($i=1; $i<=$rowsize; $i++) 
      {
        $xtpl->assign('SELECT_BOX', $rows[$i]);
        $xtpl->parse('main.Favorite' . $location . '.SelectBox');
      }
      $xtpl->parse('main.Favorite' . $location);
   }
}


function fPrintFormSelectBoxXTPL($rowtitle, $fieldname, $values, $currentvalue = "No value", $size = 1, $multiple = false, $standalone = false)
{
   global $owl_lang;
   global $xtpl;

   $found = false;

   if ($standalone == false)
   {
      $sExtendedHelpVar = "owl_" . $fieldname . "_extended";
      if (!empty($owl_lang->{$sExtendedHelpVar}))
      {
          $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"';
      }
      else
      {
          $extended_help="";
      }
      $xtpl->assign($rowtitle . "_EXTENDED_HELP", $extended_help);
   }

   $rows = array();
   $i = 1;
   if (is_array($values))
   {
      foreach($values as $g)
      {
         $sSelected = '';
         $val = addcslashes($g[0], '()&');
         if ($multiple)
         {
            if(!empty($currenvalue) and preg_grep("/$val/", $currentvalue))
            {
               $sSelected = ' selected="selected"';
               $found = true;
            }
         }
         else
         {
            if ($g[0] == $currentvalue)
            {
               $sSelected = ' selected="selected"';
               $found = true;
            }
         }
         $rows[$i]=array($rowtitle . '_SELECTBOX_VALUE'=>$g[0],
                         $rowtitle . '_SELECTBOX_LABEL'=>$g[1],
                         $rowtitle . '_SELECTBOX_SELECTED'=>$sSelected
                        );
         $i++;
      }
   }

   if (!$found and $currentvalue <> "No value")
   {
      if($multiple)
      {
         $rows[$i]=array($rowtitle . '_SELECTBOX_VALUE'=>'',
                         $rowtitle . '_SELECTBOX_LABEL'=>$owl_lang->none_selected,
                         $rowtitle . '_SELECTBOX_SELECTED'=>' selected="selected"'
                        );
      }
      else
      {
         $rows[$i]=array($rowtitle . '_SELECTBOX_VALUE'=>"$currentvalue",
                         $rowtitle . '_SELECTBOX_LABEL'=>$owl_lang->none_selected,
                         $rowtitle . '_SELECTBOX_SELECTED'=>' selected="selected"'
                        );
      }
   }
   return $rows;
}
function fPrintActionButtonsXTLP( $sequence = 0 )
{
   global $default, $sess, $order, $parent, $sort, $expand, $url, $usergroupid, $owl_lang, $curview, $page, $userid, $query;
   global $sort, $sortorder, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $xtpl;

   $sortname = 'sortname';

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   if(!empty($page))
   {
      $urlArgs['page']      = $page;
   }

   $xtpl->assign('ACTIONBUTTON_MENU_TITLE', $owl_lang->actionbtn_main_menu);

   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   if (check_auth($parent, "folder_create", $userid, false, false) == 1)
   {
      if ($userid <> $default->anon_user or ($userid == $default->anon_user and $default->anon_ro == "0"))
      {
         if (fIsFolderRSSFeed($parent) == true)
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = "folder_distribute";
            $urlArgs2['id'] = $parent;
            $urlArgs2['parent'] = $parent;
            $url = fGetURL ('dbmodify.php', $urlArgs2);

            $xtpl->assign('ACTIONBUTTON_RSSFEED_URL', $url);
            $xtpl->assign('ACTIONBUTTON_RSSFEED_TITLE', $owl_lang->alt_btn_dist_folder);
            $xtpl->assign('ACTIONBUTTON_RSSFEED_LABEL', $owl_lang->btn_dist_folder);
            $xtpl->parse('main.ActionButtons' . $sequence . '.RSSFeed');

         }
         // Add Folder Button
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = "folder_create";
         $urlArgs2['parent'] = $parent;
         $url = fGetURL ('modify.php', $urlArgs2);
         
         $xtpl->assign('ACTIONBUTTON_ADDFOLDER_URL', $url);
         $xtpl->assign('ACTIONBUTTON_ADDFOLDER_TITLE', $owl_lang->alt_btn_add_folder);
         $xtpl->assign('ACTIONBUTTON_ADDFOLDER_LABEL', $owl_lang->btn_add_folder);
         $xtpl->parse('main.ActionButtons' . $sequence . '.AddFolder');

         // Add Archive Button
         if (function_exists('gzopen'))
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = "zip_upload";
            $urlArgs2['parent'] = $parent;
            $url = fGetURL ('modify.php', $urlArgs2);
         
            $xtpl->assign('ACTIONBUTTON_UNZIP_URL', $url);
            $xtpl->assign('ACTIONBUTTON_UNZIP_TITLE', $owl_lang->alt_btn_add_zip);
            $xtpl->assign('ACTIONBUTTON_UNZIP_LABEL', $owl_lang->btn_add_zip);
            $xtpl->parse('main.ActionButtons' . $sequence . '.UnzipFolder');
         }

         // Add Document Button
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['action'] = "file_upload";
         $url = fGetURL ('modify.php', $urlArgs2);
         
         $xtpl->assign('ACTIONBUTTON_ADDFILE_URL', $url);
         $xtpl->assign('ACTIONBUTTON_ADDFILE_TITLE', $owl_lang->alt_btn_add_file);
         $xtpl->assign('ACTIONBUTTON_ADDFILE_LABEL', $owl_lang->btn_add_file);
         $xtpl->parse('main.ActionButtons' . $sequence . '.AddFile');

         // Add URL Button
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = "file_upload";
         $urlArgs2['parent'] = $parent;
         $urlArgs2['type'] = "url";
         $url = fGetURL ('modify.php', $urlArgs2);
         
         $xtpl->assign('ACTIONBUTTON_ADDURL_URL', $url);
         $xtpl->assign('ACTIONBUTTON_ADDURL_TITLE', $owl_lang->alt_btn_add_url);
         $xtpl->assign('ACTIONBUTTON_ADDURL_LABEL', $owl_lang->btn_add_url);
         $xtpl->parse('main.ActionButtons' . $sequence . '.AddUrl');

         // Add Note Button
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = "file_upload";
         $urlArgs2['parent'] = $parent;
         $urlArgs2['type'] = "note";
         $url = fGetURL ('modify.php', $urlArgs2);
         
         $xtpl->assign('ACTIONBUTTON_ADDNOTE_URL', $url);
         $xtpl->assign('ACTIONBUTTON_ADDNOTE_TITLE', $owl_lang->alt_btn_add_note);
         $xtpl->assign('ACTIONBUTTON_ADDNOTE_LABEL', $owl_lang->btn_add_note);
         $xtpl->parse('main.ActionButtons' . $sequence . '.AddNote');

         //if ($default->enable_jupload_interface == 1)
         //{
            //// Add jupload Button
            //$urlArgs2 = $urlArgs;
            //$urlArgs2['parent'] = $parent;
            //$url = fGetURL ('jupload/jupload.php', $urlArgs2);
//
            //$xtpl->assign('ACTIONBUTTON_JUPLOAD_URL', $url);
            //$xtpl->assign('ACTIONBUTTON_JUPLOAD_TITLE', $owl_lang->alt_btn_jupload);
            //$xtpl->assign('ACTIONBUTTON_JUPLOAD_LABEL', $owl_lang->btn_jupload);
            //$xtpl->parse('main.ActionButtons' . $sequence . '.JUpload');
         //}
      }
   }

   $xtpl->assign('MENU_COLLAPSE_BUTTON_TITLE', $owl_lang->alt_btn_main_menu_collapse);

   if ($curview == 1 and $default->thumbnails == 1)
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $parent;
      $urlArgs2['expand'] = "1";
      $urlArgs2['curview'] = "0";
      $url = fGetURL ('browse.php', $urlArgs2);

      $xtpl->assign('ACTIONBUTTON_NORMALVIEW_URL', $url);
      $xtpl->assign('ACTIONBUTTON_NORMALVIEW_TITLE', $owl_lang->alt_btn_default_view);
      $xtpl->assign('ACTIONBUTTON_NORMALVIEW_LABEL', $owl_lang->btn_default_view);
      $xtpl->parse('main.ActionButtons' . $sequence . '.ThumbView');
   }
   else
   {

      $sTarget = basename($_SERVER['PHP_SELF']);
      if ($expand == 1)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['query'] = $query;
         $urlArgs2['expand'] = "0";
         $url = fGetURL ($sTarget, $urlArgs2);
      
         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_URL', $url);
         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_TITLE', $owl_lang->alt_btn_collapse_view);
         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_LABEL', $owl_lang->btn_collapse_view);
      }
      else
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['query'] = $query;
         $urlArgs2['expand'] = "1";
         $url = fGetURL ($sTarget, $urlArgs2);

         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_URL', $url);
         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_TITLE', $owl_lang->alt_btn_expand_view);
         $xtpl->assign('ACTIONBUTTON_NORMALVIEW_LABEL', $owl_lang->btn_expand_view);
         
      }

      if ($default->thumbnails == 1)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['expand'] = "1";
         $urlArgs2['curview'] = "1";
         $url = fGetURL ('browse.php', $urlArgs2);

         $xtpl->assign('ACTIONBUTTON_THUMBVIEW_URL', $url);
         $xtpl->assign('ACTIONBUTTON_THUMBVIEW_TITLE', $owl_lang->alt_btn_thumb_view);
         $xtpl->assign('ACTIONBUTTON_THUMBVIEW_LABEL', $owl_lang->btn_thumb_view);
         $xtpl->parse('main.ActionButtons' . $sequence . '.NormalView.ThumbView');
      }
      $xtpl->parse('main.ActionButtons' . $sequence . '.NormalView');
   }
   $xtpl->parse('main.ActionButtons' . $sequence);
}

function fPrintFolderToolsXTPL ($location, $nextfolders = 0, $nextfiles = 0, $bDisplayFiles, $iFileCount = 0, $iCurrentPage = 0)
{

   global $iUpdatedFileCount, $iNewFileCount, $iMyFileCount, $iTotalFileCount, $iQuotaCurrent, $iQuotaMax, $iNewsCount;
   global $iMyCheckedOutCount, $iGroupFileCount, $usergroupid;
   global $iMonitoredFiles, $iMonitoredFolders, $curview ;
   global $default, $owl_lang, $sess, $expand, $userid, $lastlogin, $parent, $order, $sortname, $language, $sortorder, $sort, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename, $sortname;
   global $xtpl;

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;


   switch ($order)
   {
      case "id":
         $urlArgs['id']  = $sort;
         break;
      case "name":
         $urlArgs['sortname']  = $sort;
         break;
      case "major_minor_revision":
         $urlArgs['sortver']  = $sort;
         break;
      case "filename" :
         $urlArgs['sortfilename']  = $sort;
         break;
      case "f_size" :
         $urlArgs['sortsize']  = $sort;
         break;
      case "creatorid" :
         $urlArgs['sortposted']  = $sort;
         break;
      case "updatorid" :
         $urlArgs['sortupdator'] = $sort;
         break;
      case "smodified" :
         $urlArgs['sortmod']  = $sort;
         break;
      case "checked_out":
         $urlArgs['sortcheckedout']  = $sort;
         //$order = "checked_out";
         break;
   }
   $iNewParent = owlfolderparent($parent);

   if ($parent != $default->HomeDir)
   {
      $urlArgs3 = array();
      $urlArgs3['sess']      = $sess;
      $urlArgs3['parent']    = $iNewParent;
      $urlArgs3['expand']    = $expand;
      $urlArgs3['order']     = $order;
      $urlArgs3[$sortorder] = $sort;
      $sUrl = fGetURL ('browse.php', $urlArgs3);


      $xtpl->assign('FOLDERTOOLS_FOLDER_UP_URL', $sUrl);
      $xtpl->assign('FOLDERTOOLS_FOLDER_UP_ALT', $owl_lang->title_return_folder . " " . fid_to_name($iNewParent));
      $xtpl->parse('main.FolderTools' . $location . '.Up');
   }
   else
   {
      $xtpl->parse('main.FolderTools' . $location . '.UpDisabled');
   }


   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $default->FirstDir;
   $sUrl = fGetURL ('browse.php', $urlArgs2);

   $xtpl->assign('FOLDERTOOLS_HOME_DIR_URL', $sUrl);
   $xtpl->assign('FOLDERTOOLS_HOME_DIR_ALT', $owl_lang->alt_home_folder);

   $urlArgs2 = $urlArgs;
   $urlArgs2['parent'] = $parent;
   $urlArgs2['action'] = 'set_intial';
   $sUrl = fGetURL ('dbmodify.php', $urlArgs2);


   if ($default->anon_user <> $userid)
   {
      $xtpl->assign('FOLDERTOOLS_INITIAL_DIR_URL', $sUrl);
      $xtpl->assign('FOLDERTOOLS_INITIAL_DIR_ALT', $owl_lang->alt_set_initial_dir);
      $xtpl->parse('main.FolderTools' . $location . '.InitialDir');

   }


   $xtpl->assign('FOLDERTOOLS_SITEMAP_URL', "$default->owl_root_url/sitemap.php?sess=$sess&amp;expand=$expand&amp;curview=$curview&amp;order=$order&amp;$sortorder=$sort");
   $xtpl->assign('FOLDERTOOLS_SITEMAP_ALT', $owl_lang->alt_site_map);
   $xtpl->assign('FOLDERTOOLS_SITEMAP_LABEL', 'Site Map');

   if ($default->records_per_page > 0)
   {
       $iNumberOfPages = (int) $iFileCount / $default->records_per_page;

       if ( $iNumberOfPages > 0)
       {
               $urlArgs2 = $urlArgs;
               $urlArgs2['page'] = 0;
               $urlArgs2['bDisplayFiles'] = $bDisplayFiles;
               $sUrl = fGetURL ('browse.php', $urlArgs2);

      if ( $iNumberOfPages > 1)
      {
         $xtpl->assign('FOLDERTOOLS_PAGE_HOME_URL', $sUrl);
         $xtpl->assign('FOLDERTOOLS_PAGE_HOME_TITLE', $owl_lang->page . ' 1');
         $xtpl->assign('FOLDERTOOLS_PAGE_HOME_LABEL', '&lt;&lt;');
         $xtpl->parse('main.FolderTools' . $location . '.Pagination.FirstPage');
      }

      if ($iCurrentPage != 0)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['prev'] = 1;
         $urlArgs2['nextfolders'] = $nextfolders;
         $urlArgs2['nextfiles'] = $nextfiles;
         $urlArgs2['bDisplayFiles'] = $bDisplayFiles;
         $urlArgs2['iCurrentPage'] = $iCurrentPage;
         $sUrl = fGetURL ('browse.php', $urlArgs2);

         $xtpl->assign('FOLDERTOOLS_PAGE_PREV_URL', $sUrl);
         $xtpl->assign('FOLDERTOOLS_PAGE_PREV_TITLE', $owl_lang->alt_log_prev);
         $xtpl->assign('FOLDERTOOLS_PAGE_PREV_LABEL', '&lt;');
         $xtpl->parse('main.FolderTools' . $location . '.Pagination.PrevPage');
      }

      $iNumberOfPages = (int) round($iNumberOfPages + 0.4999);

      if($iNumberOfPages > 1)
      {
         $iMaxButtons = 6;

         $iStartButton = $iCurrentPage - ($iMaxButtons / 2);
         $iEndButton = $iCurrentPage + ($iMaxButtons / 2);


         if ($iStartButton < 0)
         {
            $iStartButton = 0;
            $iEndButton = $iMaxButtons;

         }
         if ($iEndButton > $iNumberOfPages)
         {
            $iEndButton = $iNumberOfPages;
         }

         if ($iEndButton - $iStartButton < $iMaxButtons)
         {
            $iStartButton = $iEndButton - $iMaxButtons;
         }

         for ($c = 0; $c < $iNumberOfPages; $c++)
         {
            $iPrintC = $c + 1;
            if ($iPrintC <= $iStartButton)
            {
               continue;
            }
            if ($iPrintC > $iEndButton)
            {
               continue;
            }

            $urlArgs2 = $urlArgs;
            $urlArgs2['page'] = $c;
            $urlArgs2['bDisplayFiles'] = $bDisplayFiles;
            $sUrl = fGetURL ('browse.php', $urlArgs2);



            if ($iCurrentPage == $c)
            {
               $xtpl->assign('FOLDERTOOLS_PAGE_CLASS', 'ccurrentpage');
               $xtpl->assign('FOLDERTOOLS_PAGE_ONCLICK', ' onclick="return false;"');
               $xtpl->assign('FOLDERTOOLS_PAGE_URL', 'ccurrentpage');
               $xtpl->assign('FOLDERTOOLS_PAGE_TITLE', 'Current Page is: ' . $iPrintC);
               $xtpl->assign('FOLDERTOOLS_PAGE_LABEL', $iPrintC);
            }
            else
            {
               $xtpl->assign('FOLDERTOOLS_PAGE_CLASS', 'lnavbar1');
               $xtpl->assign('FOLDERTOOLS_PAGE_ONCLICK', '');
               $xtpl->assign('FOLDERTOOLS_PAGE_URL', $sUrl);
               $xtpl->assign('FOLDERTOOLS_PAGE_TITLE', $owl_lang->page . ' ' . $iPrintC);
               $xtpl->assign('FOLDERTOOLS_PAGE_LABEL', $iPrintC);
            }
            $xtpl->parse('main.FolderTools' . $location . '.Pagination.Pages');
         }
      }

      if ($iCurrentPage < ($iNumberOfPages - 1))
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['next'] = 1;
         $urlArgs2['nextfolders'] = $nextfolders;
         $urlArgs2['nextfiles'] = $nextfiles;
         $urlArgs2['bDisplayFiles'] = $bDisplayFiles;
         $urlArgs2['iCurrentPage'] = $iCurrentPage;
         $sUrl = fGetURL ('browse.php', $urlArgs2);
         $xtpl->assign('FOLDERTOOLS_PAGE_NEXT_URL', $sUrl);
         $xtpl->assign('FOLDERTOOLS_PAGE_NEXT_TITLE', $owl_lang->alt_log_prev);
         $xtpl->assign('FOLDERTOOLS_PAGE_NEXT_LABEL', '&gt;');
         $xtpl->parse('main.FolderTools' . $location . '.Pagination.NextPage');
      }

      $iCurrentPage++;
      $urlArgs2 = $urlArgs;
      $urlArgs2['page'] = $iPrintC - 1;
      $urlArgs2['bDisplayFiles'] = $bDisplayFiles;
      $sUrl = fGetURL ('browse.php', $urlArgs2);

      if ( $iPrintC > 1 )
      {
         $xtpl->assign('FOLDERTOOLS_PAGE_LAST_URL', $sUrl);
         $xtpl->assign('FOLDERTOOLS_PAGE_LAST_TITLE', $owl_lang->page . " " . $iPrintC);
         $xtpl->assign('FOLDERTOOLS_PAGE_LAST_LABEL', '&gt;&gt;');
         $xtpl->parse('main.FolderTools' . $location . '.Pagination.LastPage');
      }
      if ( $iNumberOfPages > 1 )
      {
         $xtpl->assign('FOLDERTOOLS_PAGE_STATUS_LABEL', $owl_lang->page);
         $xtpl->assign('FOLDERTOOLS_PAGE_STATUS_CUR', $iCurrentPage);
         $xtpl->assign('FOLDERTOOLS_PAGE_STATUS_TOTAL', $iNumberOfPages);

         $xtpl->parse('main.FolderTools' . $location . '.Pagination.Status');
      }
    }
    $xtpl->parse('main.FolderTools' . $location . '.Pagination');
   }
   $xtpl->parse('main.FolderTools' . $location . '');
}

function fPrintNavBarXTPL($parent, $message = "", $fileid = 0, $nextfolders = 0, $inextfiles = 0, $bDisplayFiles = 0, $iFileCount = 0, $iCurrentPage = 0, $bLast = true)
{
   global $default, $sess, $expand, $order, $sortorder, $sort, $language, $owl_lang, $urlArgs;
   global $xtpl;

   //print("<!-- Begin Print Nav Bar -->\n");
   //print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n");
   //print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   //print("\t<tr>\n");
   //print("\t\t<td class=\"dir1\" id=\"ldir1\" width=\"100%\">");

   if (fIsAdmin(true))
   {
      $urlArgs2 = $urlArgs;
      //$urlArgs2['id'] = owlfolderparent($parent);
      $urlArgs2['id'] = $parent;
      $urlArgs2['parent'] = $parent;
      $urlArgs2['edit'] = 1;
      $urlArgs2['action'] = "folder_acl";
      $sUrl = fGetURL ('setacl.php', $urlArgs2);
      $xtpl->assign('NAVBAR_ADMINACL_URL', $sUrl);
      $xtpl->assign('NAVBAR_ADMINACL_TITLE', $owl_lang->alt_set_folder_acl);
      $xtpl->parse('main.NavBar.AdminACL');
      //print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->alt_set_folder_acl\" title=\"$owl_lang->alt_set_folder_acl\" /></a>");
   }

   $xtpl->assign('NAVBAR_LABEL', $owl_lang->current_folder);
   //print(" $owl_lang->current_folder ");

   if ( 0 < strlen($message))
   {
      //print("<b>".$message."</b>");
      $xtpl->assign('NAVBAR_MSG', $message);
   }

   if ( $fileid > 0 )
   {
      //print gen_navbarXTPL($parent, $fileid);
      gen_navbarXTPL($parent, $fileid);
   }
   else
   {
      //print gen_navbarXTPL($parent);
      gen_navbarXTPL($parent);
   }
   //print("<!-- END: Print Nav Bar -->\n");
   $xtpl->parse('main.NavBar');
}


function gen_navbarXTPL($nav_parent , $fileid = 0 , $movenav = 0)
{
   global $default;
   global $sess, $expand, $sort, $sortorder, $order, $owl_lang, $userid, $usergroupid, $action, $moreFolder, $id, $parent, $language, $curview, $folders;
   global $sortname, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $xtpl;

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   $rows = array();
   //$iRows = 1;


   if ($default->advanced_security == 1 )
   {
      $sFolderPolicyLable = "&nbsp;";
   }
   else
   {
      $sFolderPolicyLable = $owl_lang->folder_policy;
   }

   $name = fid_to_name($nav_parent);

   if ($movenav == 0)
   {
   if ( $fileid <> "0"  )
   {
      //$navbar .= DIR_SEP . fid_to_filename($fileid);
	   $rows[]=array('BREADCRUMB_URL'=> '#', 
                       'BREADCRUMB_TITLE'=> '', 
                       'BREADCRUMB_LABEL'=> fid_to_filename($fileid),
                       'BREADCRUMB_SEPARATOR'=>'');
      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $nav_parent;
      $sUrl = fGetURL ('browse.php', $urlArgs2);

      //$navbar .= "<a class=\"lfile1\" href=\"$sUrl\" title=\"$owl_lang->title_return_folder $name\">$name</a>";
      $rows[]=array('BREADCRUMB_URL'=>$sUrl, 
                    'BREADCRUMB_TITLE'=>$owl_lang->title_return_folder . ' '  . $name, 
                    'BREADCRUMB_LABEL'=>$name,
                    'BREADCRUMB_SEPARATOR'=>'/');
   }
   else
   {
      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $nav_parent;
      $sUrl = fGetURL ('browse.php', $urlArgs2);

      //$navbar .= "<a class=\"lfile1\" href=\"$sUrl\" title=\"$owl_lang->title_return_folder $name\">$name</a>";
      $rows[]=array('BREADCRUMB_URL'=>$sUrl, 
                    'BREADCRUMB_TITLE'=>$owl_lang->title_return_folder . ' '  . $name, 
                    'BREADCRUMB_LABEL'=>$name,
                    'BREADCRUMB_SEPARATOR'=>'');
   }
   }
   else
   {
      //$navbar .= "<a class=\"lfile1\" href=\"#\" title=\"$owl_lang->title_return_folder $name\">$name</a>";
      $rows[]=array('BREADCRUMB_URL'=>'#', 
                    'BREADCRUMB_TITLE'=>$owl_lang->title_return_folder . ' '  . $name, 
                    'BREADCRUMB_LABEL'=>$name,
                    'BREADCRUMB_SEPARATOR'=>'');
   }

   $new  = $nav_parent;
   while ($new != "$default->HomeDir")
   {
      $sql = new Owl_DB;
      $sql->query("SELECT parent FROM $default->owl_folders_table WHERE id = '$new'");
      if ($sql->num_rows() == 0)
      {
         break;  // Problem the folder doesn't exists?  Break out to prevent endless loop
      }
      while($sql->next_record())
      {
         $newparentid = $sql->f("parent");
      }
      $name = fid_to_name($newparentid);
      //if ($movenav == 0)
      //{
     if ($movenav == 0)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $newparentid;
         $sUrl = fGetURL ('browse.php', $urlArgs2);

         $rows[]=array('BREADCRUMB_URL'=>$sUrl, 
                       'BREADCRUMB_TITLE'=>$owl_lang->title_return_folder . ' '  . $name, 
                       'BREADCRUMB_LABEL'=>$name,
                       'BREADCRUMB_SEPARATOR'=>'/');

         //$navbar = "<a class=\"lfile1\" href=\"$sUrl\" title=\"$owl_lang->title_return_folder $name\">$name</a>/" . $navbar;
      }
      else
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['moreFolder']= $newparentid;
         $urlArgs2['action']     = $action;
         $sUrl = fGetURL ('move.php', $urlArgs2);

         if(is_numeric($id))
         {
            $sUrl .= "&id=" . $id;
         }
         else
         {
            $id = str_replace("\"","%22",$id); // replace the \"
            $sUrl .= "&id=" . $id;
         }

         if(is_numeric($folders))
         {
            $sUrl .= "&folders=" . $folders;
         }
         else
         {
            $folders = str_replace("\\\"","%22",$folders); // replace the "
            $sUrl .= "&folders=" . $folders;
         }

         //$navbar = "<a class=\"lfile1\" href=\"$sUrl\" title=\"$owl_lang->title_return_folder $name\">$name</a>/" . $navbar;
         $rows[]=array('BREADCRUMB_URL'=>$sUrl, 
                       'BREADCRUMB_TITLE'=>$owl_lang->title_return_folder . ' '  . $name, 
                       'BREADCRUMB_LABEL'=>$name,
                       'BREADCRUMB_SEPARATOR'=>'/');
      }
      $new = $newparentid;
   //}

   $iCurrentParent =  owlfolderparent($nav_parent);
   if ( $fileid <> "0"  )
   {
      //$navbar .= DIR_SEP . fid_to_filename($fileid);
         //BEGIN 2011-02/02  Removed when DOING LOG.PHP TEMPLATE
	   //$rows[]=array('BREADCRUMB_URL'=> '#', 
                       //'BREADCRUMB_TITLE'=> '', 
                       //'BREADCRUMB_LABEL'=> fid_to_filename($fileid),
                       //'BREADCRUMB_SEPARATOR'=>'/');
         //END 2011-02/02  Removed when DOING LOG.PHP TEMPLATE
   }

   /* if ($movenav == 0)
   {
      //$navbar .= "<br /></a></td>\n";
      $navbar .= "<br /></td>\n";
      $navbar .= "\t</tr>\n";
      $navbar .= "</table>\n";
      $navbar .= "</td></tr></table>\n";

      $navbar .= "<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n";
      $navbar .= "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n";
      $navbar .= "\t<tr>\n";
      $navbar .= "\t<td class=\"policy1\" id=\"lpolicy1\" width=\"100%\"><b>$sFolderPolicyLable</b>&nbsp;";


   }

   if (owlusergroup($userid) == 0 || owlusergroup($userid) == $default->file_admin_group)
   {
      $navbar .= "<a href=\"modify.php?sess=$sess&amp;action=folder_modify&amp;id=$nav_parent&amp;parent=$iCurrentParent&amp;expand=$expand&amp;order=$order&amp;$sortorder=$sort&amp;curview=$curview\" title=\"$owl_lang->alt_mod_folder\">";
      if ($movenav == 0)
      {
        $navbar .= fDisplayPolicy($nav_parent);
      }
      $navbar .= "<br /></a></td>\n";
      $navbar .= "\t</tr>\n";
      $navbar .= "</table>\n";
      $navbar .= "</td></tr></table>\n";
   }
   else
   {
      if (check_auth($nav_parent, "folder_property", $userid) == 1 and $nav_parent != $default->HomeDir)
      {

         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $iCurrentParent;
         $urlArgs2['action'] = 'folder_modify';
         $urlArgs2['id'] = $nav_parent;
         $url = fGetURL ('modify.php', $urlArgs2);

         $navbar .= "<a href=\"$url\" title=\"$owl_lang->alt_mod_folder\">";
         if ($movenav == 0)
         {
           $navbar .= fDisplayPolicy($nav_parent);
         }
         $navbar .= "<br /></a></td>\n";
         $navbar .= "\t</tr>\n";
         $navbar .= "</table>\n";
         $navbar .= "</td></tr></table>\n";
      }
      else
      {
         if ($movenav == 0)
         {
           $navbar .= fDisplayPolicy($nav_parent);
         }
         $navbar .= "</td>\n";
         $navbar .= "\t</tr>\n";
         $navbar .= "</table>\n";
         $navbar .= "</td></tr></table>\n";
    }
*/
   } 

   //$navbar .= "\n<!-- END: Generate Nav bar -->\n";
    if ($movenav == 0)
	{
       $rowsize = count($rows) - 1;
//print("<pre>");
//print_r($rows);
       for ($i=$rowsize; $i>=0; $i--)
       {
//print("I: " . $i);
           $xtpl->assign('NAVBAR', $rows[$i]);
           $xtpl->parse('main.NavBar.BreadCrumb');
       }
    }
    else
	{
       $rowsize = count($rows) - 1;
       $navbar = '';
       for ($i=$rowsize; $i>=0; $i--)
       {
          $newArray = array_slice($rows[$i], 0, 4);

          //print("<br />R: " . $newArray['BREADCRUMB_URL']);
          $navbar .= " <span><a class=\"lfile1\" href=\"" . $newArray['BREADCRUMB_URL'] ."\" />" . $newArray['BREADCRUMB_LABEL'] . "</a></span> ";
          $navbar .= '<span class="or_bar_separator">' . $newArray['BREADCRUMB_SEPARATOR'] ."</span>";
          //print("<br />R: " . $newArray['BREADCRUMB_TITLE']);
          //print("<br />R: " .  $newArray['BREADCRUMB_LABEL']);
          //print("<br />R: " . $newArray['BREADCRUMB_SEPARATOR']);
       }
    }

   if(isset($navbar))
   {
      return $navbar;
   }
}

function show_linkXTPL($column,$sortname,$sortvalue,$order,$sess,$expand,$parent,$title)
{
   global $default, $type, $owl_lang, $curview;
   global $xtpl, $sortorder, $sort, $sortfilename, $sortver, $sortsize, $sortposted, $sortupdator, $sortmod, $sortcheckedout;

 //print("<br />$sortname --- $sortvalue ");

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   $self = $_SERVER["PHP_SELF"];

   $urlArgs2 = $urlArgs;
   $urlArgs2['type']     = $type;
   $urlArgs2['order']    = $column;

   if ($sortvalue == "ASC")
   {
      $urlArgs2[$sortname] = 'DESC';
      $sImage = 'asc.gif';
   }
   else
   {
      $urlArgs2[$sortname] = 'ASC';
      $sImage = 'desc.gif';
   }

   $sUrl = fGetURL ($self, $urlArgs2);

   //print("\t\t\t\t<td class=\"title1\" ");
   if ($title == $owl_lang->title or $title == $owl_lang->file)
   {
         //print("width=\"50%\"");
   }
   //print("><a class=\"ltitle1\" href=\"$sUrl\" title=\"$owl_lang->title_sort\">$title");
   $xtpl->assign('TITLE_URL', $sUrl);
   $xtpl->assign('TITLE_TITLE', $owl_lang->title_sort);
   $xtpl->assign('TITLE_LABEL', $title);

   if ($order == $column)
   {
      $xtpl->assign('TITLE_SORT_IMG', "<img border=\"0\" src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_nav/$sImage\" alt=\"\" />");
      //print("</a>&nbsp;<img border=\"0\" src=\"$default->owl_graphics_url/$default->sButtonStyle/ui_nav/asc.gif\" alt=\"\" /><br /></td>\n");
   }
   else
   {
      $xtpl->assign('TITLE_SORT_IMG', '');
      //print("<br /></a></td>\n");
   }

   $xtpl->parse('main.DataBlock.Title.'. $column);
}
function printModifyHeaderXTPL()
{

   global $owl_lang, $default, $sortorder, $userid, $sess, $parent, $expand, $order, $sortname, $language, $curview;
   global $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage;

   // Ensure that the Id of the parent is valid
   if ($parent == 0)
   {
      $parent = 1;
   }

   if ($default->show_prefs == 1 or $default->show_prefs == 3)
   {
      fPrintPrefsXTPL('Top');
   }

   if (check_auth($parent, "folder_create", $userid, false, false) == 1 or  check_auth($parent, "folder_view", $userid, false, false) == 1  && !$is_backup_folder)
   {
      if ($default->show_action == 1 or $default->show_action == 3 or (fIsAdmin() and $default->show_action == 0))
      {
         fPrintActionButtonsXTLP();
      }
   }

   if ($default->show_folder_tools == 1 or $default->show_folder_tools == 3)
   {
      fPrintFolderToolsXTPL('Top', $nextfolders, $inextfiles, $bDisplayFiles, $iFileCount, $iCurrentPage);
   }
}

function fPrintAdminPanelXTPL($action)
{
   global $owl_lang, $sess, $default;
   global $xtpl;

   $xtpl->assign('ADMIN_PANEL_TITLE', $owl_lang->alt_btn_admin);

   $xtpl->assign('BUTTON_USER_GROUP', $owl_lang->btn_users_groups);
   if($action == "users")
   {
      $xtpl->parse('main.AdminPanel.UsersGroupOff');
   }
   else
   {
      $xtpl->assign('BUTTON_USER_GROUP_URL', $default->owl_root_url . "/admin/index.php?sess=$sess&amp;action=users");
      $xtpl->assign('BUTTON_USER_GROUP_TITLE', $owl_lang->alt_btn_users_groups);
      $xtpl->parse('main.AdminPanel.UsersGroupOn');
   }

   $xtpl->assign('BUTTON_EDIT_HTML', $owl_lang->btn_html_prefs);
   if($action == "edhtml")
   {
      $xtpl->parse('main.AdminPanel.EditHtmlOff');
   }
   else
   {
      $xtpl->assign('BUTTON_EDIT_HTML_URL', $default->owl_root_url . "/admin/index.php?sess=$sess&amp;action=edhtml");
      $xtpl->assign('BUTTON_EDIT_HTML_TITLE', $owl_lang->alt_btn_html_prefs);
      $xtpl->parse('main.AdminPanel.EditHtmlOn');
   }


   $xtpl->assign('BUTTON_EDIT_SITE_FEATURES', $owl_lang->btn_site_features);
   if($action == "edprefs")
   {
      $xtpl->parse('main.AdminPanel.EditSiteFeaturesOff');
   }
   else
   {
      $xtpl->assign('BUTTON_EDIT_SITE_FEATURES_URL', $default->owl_root_url . "/admin/index.php?sess=$sess&amp;action=edprefs");
      $xtpl->assign('BUTTON_EDIT_SITE_FEATURES_TITLE', $owl_lang->alt_btn_site_features);
      $xtpl->parse('main.AdminPanel.EditSiteFeaturesOn');
   }

   $xtpl->assign('BUTTON_VIEW_LOG', $owl_lang->btn_log_viewer);
   if($action == "viewlog")
   {
      $xtpl->parse('main.AdminPanel.ViewLogOff');
   }
   else
   {
      $xtpl->assign('BUTTON_VIEW_LOG_URL', $default->owl_root_url . "/admin/log.php?sess=$sess");
      $xtpl->assign('BUTTON_VIEW_LOG_TITLE', $owl_lang->alt_btn_log_viewer);
      $xtpl->parse('main.AdminPanel.ViewLogOn');
   }

   $xtpl->assign('BUTTON_VIEW_STATS', $owl_lang->btn_statistics_viewer);
   if($action == "viewstats")
   {
      $xtpl->parse('main.AdminPanel.ViewStatsOff');
   }
   else
   {
      $xtpl->assign('BUTTON_VIEW_STATS_URL', $default->owl_root_url . "/admin/stats.php?sess=$sess");
      $xtpl->assign('BUTTON_VIEW_STATS_TITLE', $owl_lang->alt_btn_statistics_viewer);
      $xtpl->parse('main.AdminPanel.ViewStatsOn');
   }

   $xtpl->assign('BUTTON_NEWS_ADMIN', $owl_lang->btn_news_admin);
   if($action == "newsadmin")
   {
      $xtpl->parse('main.AdminPanel.NewsAdminOff');
   }
   else
   {
      $xtpl->assign('BUTTON_NEWS_ADMIN_URL', $default->owl_root_url . "/admin/news.php?sess=$sess");
      $xtpl->assign('BUTTON_NEWS_ADMIN_TITLE', $owl_lang->alt_btn_news_admin);
      $xtpl->parse('main.AdminPanel.NewsAdminOn');
   }

   $xtpl->assign('BUTTON_DOCTYPE_ADMIN', $owl_lang->btn_doctype_admin);
   if($action == "doctypes")
   {
      $xtpl->parse('main.AdminPanel.DocTypeAdminOff');
   }
   else
   {
      $xtpl->assign('BUTTON_DOCTYPE_ADMIN_URL', $default->owl_root_url . "/admin/doctype.php?sess=$sess");
      $xtpl->assign('BUTTON_DOCTYPE_ADMIN_TITLE', $owl_lang->alt_btn_doctype_admin);
      $xtpl->parse('main.AdminPanel.DocTypeAdminOn');
   }

   $xtpl->assign('BUTTON_BACKUP', $owl_lang->btn_backup);
   if (file_exists($default->dbdump_path) && file_exists($default->gzip_path))
   {
      $xtpl->assign('BUTTON_BACKUP_URL', $default->owl_root_url . "/admin/index.php?sess=$sess&amp;action=backup");
      $xtpl->assign('BUTTON_BACKUP_TITLE', $owl_lang->alt_btn_backup);
      $xtpl->parse('main.AdminPanel.BackupOn');
      $xtpl->parse('main.AdminPanel.BackupOnDiv');
   }
   else
   {
      $xtpl->parse('main.AdminPanel.BackupOff');
      $xtpl->parse('main.AdminPanel.BackupOffDiv');
   }


   if ($default->collect_trash == 1)
   {
// print("<pre>");
//print_r($default);
 //exit($default->trash_can_location);
      if ($action == 'trashcan')
      {
         $xtpl->assign('BUTTON_RECYCLE', $owl_lang->btn_trashcan);
         $xtpl->parse('main.AdminPanel.RecycleOff');
      }
      else
      {
      $sql = new Owl_DB; //create new db connection
      $sql->query("SELECT name FROM $default->owl_folders_table WHERE id = '1'");
      $sql->next_record();
      $sRootFolderName = $sql->f("name");
      $iFileCounter = 0;
      if ($default->owl_use_fs)
      {
         if (is_dir($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRootFolderName) and is_dir($default->trash_can_location))
         {
            $Dir = @opendir($default->trash_can_location . DIR_SEP . $default->owl_current_db . DIR_SEP . $sRootFolderName);
            while ($file = @readdir($Dir))
            {
               $iFileCounter++;
            }
            if ($iFileCounter > 0)
            {

               $urlArgs2 = array();
               $urlArgs2['sess'] = $sess;
               $sUrl = fGetURL ('admin/recycle.php', $urlArgs2);
               $xtpl->assign('BUTTON_RECYCLE', $owl_lang->btn_trashcan);
               $xtpl->assign('BUTTON_RECYCLE_URL', $sUrl);
               $xtpl->assign('BUTTON_RECYCLE_TITLE', $owl_lang->alt_btn_trashcan);
               $xtpl->parse('main.AdminPanel.RecycleOn');
            }
            else
            {
               $xtpl->assign('BUTTON_RECYCLE', $owl_lang->alt_recycle);
               $xtpl->parse('main.AdminPanel.RecycleOff');
            }
         }
         else if (is_dir($default->trash_can_location) and is_writable($default->trash_can_location))
         {
            $xtpl->assign('BUTTON_RECYCLE', $owl_lang->alt_recycle);
            $xtpl->parse('main.AdminPanel.RecycleOff');
         }
         else
         {
//if (is_dir($default->trash_can_location))
//{
 //exit("$default->trash_can_location");
//}
            $xtpl->assign('BUTTON_RECYCLE', $owl_lang->alt_recycle_not_found);
            $xtpl->parse('main.AdminPanel.RecycleOff');
         }
      }
      }
   }
   else
   {
      $xtpl->assign('BUTTON_RECYCLE', $owl_lang->alt_recycle_disable);
      $xtpl->parse('main.AdminPanel.RecycleOff');
   }


   $xtpl->assign('BUTTON_IMPORT_USERS', $owl_lang->btn_import_users);
   if($action == "importusers")
   {
      $xtpl->parse('main.AdminPanel.ImportUsersOff');
   }
   else
   {
      $xtpl->assign('BUTTON_IMPORT_USERS_URL', $default->owl_root_url . "/admin/import_users.php?sess=$sess");
      $xtpl->assign('BUTTON_IMPORT_USERS_TITLE', $owl_lang->alt_btn_import_users);
      $xtpl->parse('main.AdminPanel.ImportUsersOn');
   }

   $xtpl->assign('BUTTON_INITIAL_LOAD', $owl_lang->btn_initial_load);
   $xtpl->assign('BUTTON_INITIAL_LOAD_URL', "populate.php?sess=$sess");
   $xtpl->assign('BUTTON_INITIAL_LOAD_TITLE', $owl_lang->alt_btn_initial_load);
   $xtpl->assign('BUTTON_INITIAL_LOAD_CONFIRM', $owl_lang->confirm_initial_load);


   $xtpl->assign('BUTTON_PURGE_HIST', $owl_lang->btn_cln_history);
   $xtpl->assign('BUTTON_PURGE_HIST_URL', "index.php?sess=$sess&amp;action=clnhist");
   $xtpl->assign('BUTTON_PURGE_HIST_TITLE', $owl_lang->alt_btn_cln_history . ' ' . $default->purge_historical_documents_days);
   $xtpl->assign('BUTTON_PURGE_HIST_CONFIRM', $owl_lang->confirm_cln_history . ' ' . $default->purge_historical_documents_days);

   if($default->owl_maintenance_mode == 0)
   {
      $xtpl->assign('BUTTON_ADMIN_DIVID', 'maintmode');
      $xtpl->assign('BUTTON_ADMIN_CONF_MAINT', $owl_lang->confirm_maint_mode);
      $xtpl->assign('BUTTON_ADMIN_MAINT', $owl_lang->btn_admin_maint_on);
      $xtpl->assign('BUTTON_ADMIN_MAINT_URL', "index.php?sess=$sess&amp;maint=1");
      $xtpl->assign('BUTTON_ADMIN_MAINT_TITLE', $owl_lang->alt_btn_admin_maint_on);
   }
   else
   {
      $xtpl->assign('BUTTON_ADMIN_DIVID', 'maintmodeoff');
      $xtpl->assign('BUTTON_ADMIN_MAINT', $owl_lang->btn_admin_maint_off);
      $xtpl->assign('BUTTON_ADMIN_MAINT_URL', "index.php?sess=$sess&amp;maint=0");
      $xtpl->assign('BUTTON_ADMIN_MAINT_TITLE', $owl_lang->alt_btn_admin_maint_off);
   }

//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
   $xtpl->assign('BUTTON_ADMIN_USER_TABLE', $owl_lang->tables_btn);
   if ($action == "tables")
   {
      $xtpl->parse('main.AdminPanel.UserTableOff');
   }
   else
   {
      $xtpl->assign('BUTTON_ADMIN_USER_TABLE_URL', "userTables.php?sess=$sess");
      $xtpl->assign('BUTTON_ADMIN_USER_TABLE_TITLE', $owl_lang->alt_tables_btn);
      $xtpl->parse('main.AdminPanel.UserTableOn');
   }
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************

   $xtpl->parse('main.AdminPanel');
}

function fPrintHomeDirXtpl ( $currentparent, $level , $homedir, $stoplevel = "---", $sParseTag, $sVarValue)
{
   global $default, $xtpl;

   $sql = new Owl_DB;
   $sql->query("SELECT id,name FROM $default->owl_folders_table WHERE parent='$currentparent' order by name");

   while ($sql->next_record())
   {
      $xtpl->assign('USER_' . $sVarValue . '_SELECTED', '');
      $xtpl->assign('USER_' . $sVarValue . '_VALUE', $sql->f("id"));
      //print("<option value=\"" . $sql->f("id") ."\"");
      $xtpl->assign('USER_' . $sVarValue . '_CAPTION',  $level . $sql->f("name"));
      if ($sql->f("id") == $homedir)
      {
         $xtpl->assign('USER_' . $sVarValue . '_SELECTED', " selected=\"selected\"");
      }
      //print(">" . $level . $sql->f("name") . "</option>\n");
      $xtpl->parse($sParseTag);
      // if the level is 2 deep Stop
      if ($level == "-----|") // ADD --- for each additional level you want to see
      {
         continue;
      }
      else
      {
         fPrintHomeDirXtpl($sql->f("id"), $stoplevel . $level, $homedir, $stoplevel, $sParseTag, $sVarValue);
      }
   }
}


function fprintFileIconsXtpl ($fid, $filename, $checked_out, $url, $allicons, $ext, $backup_parent, $is_backup_folder = false, $is_approved = '0')
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
      //if (!in_array('file_log', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlviewlog'] = 0;
      //}
      //if (!in_array('file_delete', $default->FileMenuOrder))
      //{
         //$aFileAccess['owldelete'] = 0;
      //}
      //if (!in_array('file_edit', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlproperties'] = 0;
      //}
      //if (!in_array('file_update',  $default->FileMenuOrder))
      //{
         //$aFileAccess['owlupdate'] = 0;
      //}
      //if (!in_array('file_acl',  $default->FileMenuOrder))
      //{
         //$aFileAccess['owlsetacl'] = 0;
      //}
      //if (!in_array('file_copy', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlcopy'] = 0;
      //}
      //if (!in_array('file_link', $default->FileMenuOrder))
      //{
         //$aFileAccess['owllink'] = 0;
      //}
      //else
      //{
         //$aFileAccess['owllink'] = 1;
      //}
      //if (!in_array('file_move', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlmove'] = 0;
      //}
      //if (!in_array('file_comment', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlcomment'] = 0;
      //}
      //if (!in_array('file_lock', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlcheckin'] = 0;
      //}
      //if (!in_array('file_email', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlemail'] = 0;
      //}
      //if (!in_array('file_monitor', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlmonitor'] = 0;
      //}
      //if (!in_array('file_find', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlrelsearch'] = 0;
      //}
      //if (!in_array('file_download', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlread'] = 0;
      //}
      //if (!in_array('file_view', $default->FileMenuOrder))
      //{
         //$aFileAccess['owlview'] = 0;
      //}
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

         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_LOG', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/log.gif\" border=\"0\" alt=\"$owl_lang->alt_log_file\" title=\"$owl_lang->alt_log_file\" /></a>");
         }

         $sUrl = "#\" onclick=\"AjaxGethtml('scripts/Ajax/Owl/getfilelink.php?sess=$sess&fileid=fid', 'file_link_out', '$default->owl_graphics_url/$default->sButtonStyle/ui_misc/ajax-loader1.gif');";

         if ($xtpl)
         {
            $xtpl->assign('FILE_ACTION_HOTLINK', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/fld_link.gif\" border=\"0\" alt=\"HOT LINK TO FILE\" title=\"HOT LINK TO FILE\" /></a>");
         }

      } 
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

            $xtpl->assign('FILE_ACTION_DEL', "<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
         } 
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
            if ($xtpl)
            {
               $xtpl->assign('FILE_ACTION_DEL', "<a href=\"$sUrl\" onclick=\"return confirm('$owl_lang->reallydelete ".$filename."?');\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/trash.gif\" alt=\"$owl_lang->alt_del_file\" title=\"$owl_lang->alt_del_file\" border=\"0\" /></a>");
            }
         } 
      }
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

         $xtpl->assign('FILE_ACTION_MOD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit.gif\" border=\"0\" alt=\"$owl_lang->alt_mod_file\" title=\"$owl_lang->alt_mod_file\" /></a>");
      } 
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
                  //print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit_file.gif\" border=\"0\" alt=\"$owl_lang->alt_edit_file_inline\" title=\"$owl_lang->alt_edit_file_inline\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_INLINE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/edit_file.gif\" border=\"0\" alt=\"$owl_lang->alt_edit_file_inline\" title=\"$owl_lang->alt_edit_file_inline\" /></a>");
                  }
               }
            }
         }
      }
   }


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
               $xtpl->assign('FILE_ACTION_ACL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/setacl.png\" border=\"0\" alt=\"$owl_lang->acl_set_acl\" title=\"$owl_lang->acl_set_acl\" /></a>");
            }
         }
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
            $xtpl->assign('FILE_ACTION_LINK', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/link.gif\" border=\"0\" alt=\"$owl_lang->alt_link_file\" title=\"$owl_lang->alt_link_file\" /></a>");
         }
      }
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

               $xtpl->assign('FILE_ACTION_COPY', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
            }  
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

                  $xtpl->assign('FILE_ACTION_COPY', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/copy.gif\" border=\"0\" alt=\"$owl_lang->alt_copy_file\" title=\"$owl_lang->alt_copy_file\" /></a>");
            } 
         }
      }
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

                  $xtpl->assign('FILE_ACTION_MOVE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
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

                  $xtpl->assign('FILE_ACTION_MOVE', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/move.gif\" border=\"0\" alt=\"$owl_lang->alt_move_file\" title=\"$owl_lang->alt_move_file\" /></a>");
            } 
         }
      }
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

                  $xtpl->assign('FILE_ACTION_UPD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/update.gif\" border=\"0\" alt=\"$owl_lang->alt_upd_file\" title=\"$owl_lang->alt_upd_file\" /></a>");
            } 
         }
      }
   }
   // *****************************************************************************
   // Don't Show the file dowload icon if the user doesn't have download access to the file
   // *****************************************************************************
 
   if (($bFileDownload == 1 and $aFileAccess['owlread'] == 1) or
       ($default->display_password_override == 1 and fIsFilePasswordSet($fid))
      )
   {
      if ($url != "1")
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['binary'] = 1;
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('download.php', $urlArgs2);

            $xtpl->assign('FILE_ACTION_DNLD', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/bin.gif\" border=\"0\" alt=\"$owl_lang->alt_get_file\" title=\"$owl_lang->alt_get_file\" /></a>");
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

           $xtpl->assign('FILE_ACTION_COMMENT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment_dis.gif\" border=\"0\" alt=\"$owl_lang->alt_add_comments\" title=\"$owl_lang->alt_add_comments\" /></a>");
      } 
      else 
      { 
         $urlArgs2 = $urlArgs;
         $urlArgs2['action'] = 'file_comment';
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('modify.php', $urlArgs2);

            $xtpl->assign('FILE_ACTION_COMMENT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/comment.gif\" border=\"0\" alt=\"$owl_lang->alt_view_comments\" title=\"$owl_lang->alt_view_comments\" /></a>");
      }
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

                  //print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/unlock.gif\" border=\"0\" alt=\"$owl_lang->alt_unlock_file\" title=\"$owl_lang->alt_unlock_file\" /></a>");
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

                  //print("<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/lock.gif\" border=\"0\" alt=\"$owl_lang->alt_lock_file\" title=\"$owl_lang->alt_lock_file\" /></a>");
                  if ($xtpl)
                  {
                     $xtpl->assign('FILE_ACTION_CHECKOUT', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/lock.gif\" border=\"0\" alt=\"$owl_lang->alt_lock_file\" title=\"$owl_lang->alt_lock_file\" /></a>");
                  }
               }
            } 
         }
      }
   }

      // *****************************************************************************
      // Don't Show the email icon if the user doesn't have access to email the file
      // *****************************************************************************

      if ($aFileAccess["owlemail"] == 1 and !$is_backup_folder)
      {
         if ($url == "1") 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['type']   = 'url';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);

               $xtpl->assign('FILE_ACTION_EMAIL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
         } 
         else 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);

               $xtpl->assign('FILE_ACTION_EMAIL', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/email.gif\" border=\"0\" alt=\"$owl_lang->alt_email\" title=\"$owl_lang->alt_email\" /></a>");
         }
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

                     $xtpl->assign('FILE_ACTION_MON', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitor.gif\" border=\"0\" alt=\"$owl_lang->alt_monitor\" title=\"$owl_lang->alt_monitor\" /></a>");
               }  
               else 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_monitor';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);

                     $xtpl->assign('FILE_ACTION_MON', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/monitored.gif\" border=\"0\" alt=\"$owl_lang->alt_monitored\" title=\"$owl_lang->alt_monitored\" /></a>");
               }
            }
         }
      }

      if ($aFileAccess["owlrelsearch"] == 1)
      {        
         $urlArgs2 = $urlArgs;
         $urlArgs2['search_id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('search.php', $urlArgs2);
            $xtpl->assign('FILE_ACTION_RELATED', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/related.gif\" border=\"0\" alt=\"$owl_lang->alt_related\" title=\"$owl_lang->alt_related\" /></a>");
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


                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            $htmlfiles = array("php","php3");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'php_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            
            $htmlfiles = array("html","htm","xml");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'html_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
            }
            if ($ext != "" && $ext == "pod") 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'pod_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);

                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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

                     $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
               }
               else
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'text_show';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('view.php', $urlArgs2);

                     $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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

               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
         }
   
         $mswordfiles = array("doc", "sxw", "docx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $mswordfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'doc_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);

               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
         }
   
         $msexcelfiles = array("xls", "xlsx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $msexcelfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'xls_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
  
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
         }

         $emailfiles = array("eml");
         if ($ext != "" && preg_grep("/\b$ext\b/", $emailfiles))
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'email_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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
  
                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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
 
               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/play.gif\" border=\"0\" alt=\"$owl_lang->alt_play_file\" title=\"$owl_lang->alt_play_file\" /></a>");
         }
   
         $pptfiles = array("ppt", "pptx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $pptfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'ppt_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);

               $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\" $sTarget><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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

                  $xtpl->assign('FILE_ACTION_VIEW', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/mag.gif\" border=\"0\" alt=\"$owl_lang->alt_view_file\" title=\"$owl_lang->alt_view_file\" /></a>");
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
                  $xtpl->assign('FILE_ACTION_GENTHUMB', "<a href=\"$sUrl\"><img src=\"$default->owl_graphics_url/$default->sButtonStyle/icon_action/thumb.png\" border=\"0\" alt=\"$owl_lang->thumb_re_generate\" title=\"$owl_lang->thumb_re_generate\" /></a>");
            }
         }
      }
      if ($xtpl)
      {
         $xtpl->parse('main.Files.Action');
      }
}

function fSetLogo_MOTD ()
{
   global $default, $xtpl, $action;

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
}

function fSetPopupHelp ()
{
   global $default, $xtpl, $action, $type;

   if (ereg("admin", $_SERVER["PHP_SELF"]) or ereg("jupload", $_SERVER["PHP_SELF"]))
   {
      if (basename(dirname($_SERVER["PHP_SELF"])) == 'admin')
      {
         $HelpDirectory = "help/admin";
      }
      else
      {
         $HelpDirectory = "help";
      }
   }
   else
   {
      $HelpDirectory = "help";
   }
   
   
   if ("dbmodify.php" != basename($_SERVER["PHP_SELF"]))
   {
   
      $sPathInfo = pathinfo($_SERVER["PHP_SELF"]);
      $sHelpFile = $sPathInfo['filename'];
   }
   else
   {
      $sHelpFile = "browse";
   }


   switch ($action)
   {
     case 'file_upload':
        $sSubSection = '_fileupload';
        switch ($type)
        {
           case 'note':
              $sSubSection .= '_note';
           break;
           case 'url':
              $sSubSection .= '_url';
           break;
           default:
              $sSubSection .= '';
           break;
        }
     break;
     case 'file_email':
        $sSubSection = '_fileemail';
     break;
     case 'file_comment':
        $sSubSection = '_filecomment';
     break;
     case 'cp_file':
        $sSubSection = '_filecopy';
     break;
     case 'file_update':
        $sSubSection = '_fileupdate';
     break;
     case 'file_modify':
        $sSubSection = '_filemodify';
     break;
     case 'folder_create':
        $sSubSection = '_foldercreate';
     break;
     case 'folder_modify':
        $sSubSection = '_foldermodify';
     break;
     case 'edprefs':
        $sSubSection = '_sitefeatures';
     break;
     case 'edhtml':
        $sSubSection = '_htmlprefs';
     break;
     case 'zip_upload':
        $sSubSection = '_archive';
     break;
     case 'users':
        $sSubSection = '_users';
     break;
     default:
        $sSubSection = '';
     break;
   }

   if (file_exists($default->owl_fs_root . "/locale/$default->owl_lang/$HelpDirectory/help_". $sHelpFile . $sSubSection . ".php"  ))
   {
       $buffer = file_get_contents($default->owl_fs_root . "/locale/$default->owl_lang/$HelpDirectory/help_". $sHelpFile . $sSubSection . ".php");
       $sImagePath = $default->owl_graphics_url . "/" . $default->sButtonStyle;

       $buffer = fOwl_ereg_replace("\%THEME\%", $sImagePath, $buffer);
       $xtpl->assign('HELP_TEXT', $buffer);
       $xtpl->assign('PAGE_TITLE', "Online Help - (help_" . $sHelpFile . $sSubSection . ".php)");
   }
   else
   {
       $xtpl->assign('HELP_TEXT', '');
       $xtpl->assign('PAGE_TITLE', 'MISSING HELP FILE - (help_'. $sHelpFile . $sSubSection . ".php)");
   }
}


function fPrintDoctypePickListXtpl($doctype, $sSection = 'AddFiles')
{
   global $default, $owl_lang, $sess, $xtpl;
   $sql = new Owl_DB;
   $sql->query("SELECT * from $default->owl_doctype_table order by doc_type_name");

   if ($sql->num_rows() > 1)
   {
     
      $xtpl->assign('OWL_SESS', $sess);
      $xtpl->assign('DOCTYPE_LABEL', $owl_lang->document_type);
      $xtpl->assign('DOCTYPE_ONCHANGE_WARNING', 'BIG WARNING HERE Save changes to Confirm!');
      while ($sql->next_record())
      {
         $xtpl->assign('DOCTYPE_VALUE', $sql->f("doc_type_id"));
         $xtpl->assign('DOCTYPE_VALUE_LABEL', $sql->f("doc_type_name"));
         $xtpl->assign('DOCTYPE_VALUE_SELECTED', '');
         if ( $sql->f("doc_type_id") == $doctype )
         {
            $xtpl->assign('DOCTYPE_VALUE_SELECTED', ' selected="selected"');
         }
         $xtpl->parse('main.' . $sSection . '.Doctypes.Value');
      }
      $xtpl->parse('main.' . $sSection . '.Doctypes');
   }
}

//function fPrintFormDoctypeRadioXtpl($rowtitle, $fieldname, $value, $option_text , $sReadonly = "", $iFileId = "", $sSection = "ViewFile.Details")
function fPrintFormDoctypeRadioXtpl($rowtitle, $fieldname, $value, $option_text , $sReadonly = "", $iFileId = "", $sSection = "DataBlock.File")
{
//sun2earth begin
   global $owl_lang, $default;
//sun2earth end
   global $xtpl;


   $xtpl->assign('DOC_TYPE_RADIO_LABEL', $rowtitle);
//sun2earth begin
   $sExtendedHelpVar = "owl_" . $fieldname . "_extended";
   if (!empty($owl_lang->{$sExtendedHelpVar}))
   {
       $extended_help=" onmouseover=\"" . sprintf($default->domtt_popup , addslashes($rowtitle), $owl_lang->{$sExtendedHelpVar}, $default->popup_lifetime) . '"'; 
   }
   else
   {
       $extended_help="";
   }
   $checked = "";

   $xtpl->assign('DOC_TYPE_RADIO_EXTENDED', $extended_help);
   $xtpl->assign('DOC_TYPE_RADIO_READONLY', $sReadonly);
   foreach ($option_text as $caption)
   {
      if ($caption == $value)
      {
         $checked = "checked=\"checked\"";
      }
      //if ($xtpl)
      //{
         $xtpl->assign('DOC_TYPE_RADIO_CHECKED', $checked);
         $xtpl->assign('DOC_TYPE_RADIO_NAME', $fieldname . $iFileId);
         $xtpl->assign('DOC_TYPE_RADIO_VALUE', $caption);
         $xtpl->assign('DOC_TYPE_RADIO_VALUE_LABEL', $caption);
         //$xtpl->parse('main.DataBlock.File.DocFields.Row.Radio.Input');
         $xtpl->parse('main.' . $sSection . '.DocFields.Row.Radio.Input');
      //}
      $checked = "";
   }

   //$xtpl->parse('main.DataBlock.File.DocFields.Row.Radio');
   $xtpl->parse('main.' . $sSection . '.DocFields.Row.Radio');
}

function fSetupFolderActionMenusXTPL($iFolderID, $sFolderName, $XTPLTag = 'DataBlock')
{
   global $default, $xtpl;
   global $parent, $sess, $expand, $order, $sortorder ,$sortname, $userid, $curview, $sort, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename;
   global $owl_lang, $mid, $page, $cCommonDBConnection, $iMenuRecordCounter;

   $checksql = $cCommonDBConnection;

   if (empty($checksql))
   {
      $checksql = new Owl_DB;
   }

   $urlArgs = array();
   $urlArgs['sess']      = $sess;
   if (!empty($page))
   {
      $urlArgs['page']      = $page;
   }
   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;


   // *****************************************
   // Display the Delete Icons For the Folders
   // *****************************************

      if ($default->restrict_view == 1)
      {
         if (!check_auth($iFolderID, "folder_view", $userid, false, false))
         {
            return;
         }
      }

      if ($default->records_per_page > 0)
      {
         if ($default->restrict_view == 1)
         {
            $iMenuRecordCounter++;
            //if ($iMenuRecordCounter > $iMenuPageEndCount or $iMenuRecordCounter <= $iMenuPageStartCount)
            //{
               //return;
            //}
         }
      }

      $foldername = $sFolderName;
      $fid     = $iFolderID;


      $urlArgs2 = $urlArgs;
      $urlArgs2['parent'] = $fid;

      // 0 = View File Details
      // 1 = Download File
      // 2 = Modify File Properties
      if ($default->folder_action_click_file_column == 0)
      {
         $url = fGetURL ('browse.php', $urlArgs2);
         $sAltString = $owl_lang->title_browse_folder;
      }
      else if ($default->folder_action_click_file_column == 1)
      {
         $urlArgs2['binary'] = '1';
         $urlArgs2['id'] = $fid;
         $urlArgs2['action'] = 'folder';
         $url = fGetURL ('download.php', $urlArgs2);
         $sAltString = $owl_lang->alt_get_folder;
      }
      else if ($default->folder_action_click_file_column == 2)
      {
         $urlArgs2['action'] = 'folder_modify';
         $urlArgs2['id'] = $fid;
         $url = fGetURL ('modify.php', $urlArgs2);
      }
      else
      {
         $url = fGetURL ('browse.php', $urlArgs2);
         $sAltString = $owl_lang->title_browse_folder;
      }

      $xtpl->assign('FOLDER_MENU_NAME', $foldername);
      $xtpl->assign('FOLDER_MENU_ACTION', $url);
      $xtpl->assign('FOLDER_MENU_ACTION_ALT', $owl_lang->menu_folder_action);


      if ((check_auth($iFolderID, "folder_view", $userid, false, false) == 1) or
          ($default->display_password_override == 1 and fIsFolderPasswordSet($iFolderID))
         )
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['parent'] = $fid;
         $url = fGetURL ('browse.php', $urlArgs2);

         //$aFolderMenuString["folder_view"] = "..|$owl_lang->title_browse_folder|$url|$owl_lang->title_browse_folder|folder_closed.gif\n";
         $xtpl->assign('FOLDER_MENU_BROWSE_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_BROWSE_LABEL', $owl_lang->title_browse_folder);
         $xtpl->assign('FOLDER_MENU_BROWSE_ALT', $owl_lang->title_browse_folder);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Browse');
      }


      if (check_auth($iFolderID, "folder_delete", $userid, false, false) == 1)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['id'] = $iFolderID;
         $urlArgs2['action'] = 'folder_delete';
         $url = fGetURL ('dbmodify.php', $urlArgs2);
         

         //$aFolderMenuString["folder_delete"] = "..|$owl_lang->alt_del_folder|$url|$owl_lang->alt_del_folder|trash.gif\n";
         $xtpl->assign('FOLDER_MENU_DELETE_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_DELETE_LABEL', $owl_lang->alt_del_folder);
         $xtpl->assign('FOLDER_MENU_DELETE_ALT', $owl_lang->alt_del_folder);
         $xtpl->assign('FOLDER_MENU_DELETE_CONFIRM', "return confirm('$owl_lang->reallydelete " .htmlspecialchars($foldername, ENT_QUOTES) ."?');");
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Delete');

      }
      // *****************************************
      // Display the Property Icons For the Folders
      // *****************************************

      if (check_auth($iFolderID, "folder_property", $userid, false, false) == 1)
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['id'] = $iFolderID;
         $urlArgs2['action'] = 'folder_modify';
         $url = fGetURL ('modify.php', $urlArgs2);
         //$aFolderMenuString["folder_edit"] = "..|$owl_lang->alt_mod_folder|$url|$owl_lang->alt_mod_folder|edit.gif\n";
         $xtpl->assign('FOLDER_MENU_EDIT_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_EDIT_LABEL', $owl_lang->alt_mod_folder);
         $xtpl->assign('FOLDER_MENU_EDIT_ALT', $owl_lang->alt_mod_folder);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Edit');

      }

      // *****************************************
      // Display the move Icons For the Folders
      // *****************************************

      //if (check_auth($setmenu->f("id"), "folder_modify", $userid, false, false) == 1 and check_auth($setmenu->f("id"), "folder_delete", $userid, false, false) == 1)
      if (check_auth($iFolderID, "folder_cp", $userid, false, false) == 1)
      {
          $urlArgs2 = $urlArgs;
          $urlArgs2['id'] = $iFolderID;
          $urlArgs2['action'] = 'cp_folder';
          $urlArgs2['parent'] = $parent;
          $url = fGetURL ('move.php', $urlArgs2);

          //$aFolderMenuString["folder_copy"] = "..|$owl_lang->alt_copy_folder|$url|$owl_lang->alt_copy_folder|copy.gif\n";
         $xtpl->assign('FOLDER_MENU_COPY_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_COPY_LABEL', $owl_lang->alt_copy_folder);
         $xtpl->assign('FOLDER_MENU_COPY_ALT', $owl_lang->alt_copy_folder);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Copy');
      }

      if (check_auth($iFolderID, "folder_move", $userid, false, false) == 1)
      {
          $urlArgs2 = $urlArgs;
          $urlArgs2['id'] = $iFolderID;
          $urlArgs2['action'] = 'folder';
          $urlArgs2['parent'] = $parent;
          $url = fGetURL ('move.php', $urlArgs2);
          //$aFolderMenuString["folder_move"] = "..|$owl_lang->alt_move_folder|$url|$owl_lang->alt_move_folder|move.gif\n";
         $xtpl->assign('FOLDER_MENU_MOVE_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_MOVE_LABEL', $owl_lang->alt_move_folder);
         $xtpl->assign('FOLDER_MENU_MOVE_ALT', $owl_lang->alt_move_folder);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Move');

          $urlArgs2 = $urlArgs;
          $urlArgs2['id'] = $iFolderID;
          $urlArgs2['action'] = 'lnk_folder';
          $urlArgs2['parent'] = $parent;
          $url = fGetURL ('move.php', $urlArgs2);
          //$aFolderMenuString["folder_lnk"] = "..|$owl_lang->alt_link_folder|$url|$owl_lang->alt_link_folder|fld_link.gif\n";
         $xtpl->assign('FOLDER_MENU_LINK_ACTION', $url);
         $xtpl->assign('FOLDER_MENU_LINK_LABEL', $owl_lang->alt_link_folder);
         $xtpl->assign('FOLDER_MENU_LINK_ALT', $owl_lang->alt_link_folder);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Link');
      }


      //if (check_auth($setmenu->f("id"), "folder_view", $userid, false, false) == 1)
      if (check_auth($iFolderID, "folder_monitor", $userid, false, false) == 1)
      {
         $folder_id = $iFolderID;
         $checksql->query("SELECT * FROM $default->owl_monitored_folder_table WHERE fid = '$folder_id' AND userid = '$userid'");
         $checknumrows = $checksql->num_rows($checksql);

         $checksql->query("SELECT * FROM $default->owl_users_table WHERE id = '$userid'");
         $checksql->next_record();
         if (trim($checksql->f("email")) != "")
         {
            if ($checknumrows == 0)
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $folder_id;
               $urlArgs2['parent'] = $parent;
               $urlArgs2['action'] = 'folder_monitor';
               $url = fGetURL ('dbmodify.php', $urlArgs2);
               //$aFolderMenuString["folder_monitor"] = "..|$owl_lang->alt_monitor_folder|$url|$owl_lang->alt_monitor_folder|monitor.gif\n";
               $xtpl->assign('FOLDER_MENU_MONITOR_IMG', 'monitor');
               $xtpl->assign('FOLDER_MENU_MONITOR_ACTION', $url);
               $xtpl->assign('FOLDER_MENU_MONITOR_LABEL', $owl_lang->alt_monitor_folder);
               $xtpl->assign('FOLDER_MENU_MONITOR_ALT', $owl_lang->alt_monitor_folder);
            }
            else
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $folder_id;
               $urlArgs2['parent'] = $parent;
               $urlArgs2['action'] = 'folder_monitor';
               $url = fGetURL ('dbmodify.php', $urlArgs2);
               //$aFolderMenuString["folder_monitor"] = "..|$owl_lang->alt_monitored_folder|$url|$owl_lang->alt_monitored_folder|monitored.gif\n";
               $xtpl->assign('FOLDER_MENU_MONITOR_IMG', 'monitored');
               $xtpl->assign('FOLDER_MENU_MONITOR_ACTION', $url);
               $xtpl->assign('FOLDER_MENU_MONITOR_LABEL', $owl_lang->alt_monitored_folder);
               $xtpl->assign('FOLDER_MENU_MONITOR_ALT', $owl_lang->alt_monitored_folder);
            }
            $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Monitor');
         }
      }

      //if (check_auth($setmenu->f("id"), "folder_view", $userid, false, false) == 1)
      if (check_auth($iFolderID, "folder_view", $userid, false, false) == 1)
      {
         $urlArgs2 = array();
         $urlArgs2['sess']   = $sess;
         $urlArgs2['id']     = $iFolderID;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['action'] = 'folder';
         $urlArgs2['binary'] = 1;
         $urlArgs2['expand']    = $expand;
         $urlArgs2['order']     = $order;
         $urlArgs2['sortorder'] = $sort;
         $urlArgs2['curview'] = $curview;
         $url = fGetURL ('download.php', $urlArgs2);

         if($default->use_zip_for_folder_download and function_exists('gzopen'))
         {
            //$aFolderMenuString["folder_download"]= "..|$owl_lang->alt_get_folder|$url|$owl_lang->alt_get_folder|zip.gif\n";
            $xtpl->assign('FOLDER_MENU_DOWNLD_ACTION', $url);
            $xtpl->assign('FOLDER_MENU_DOWNLD_LABEL', $owl_lang->alt_get_folder);
            $xtpl->assign('FOLDER_MENU_DOWNLD_ALT', $owl_lang->alt_get_folder);
            $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Download');
         }
         else
         {
            if (file_exists($default->tar_path) && trim($default->tar_path) != "" && file_exists($default->gzip_path) && trim($default->gzip_path) != "")
            {
               //$aFolderMenuString["folder_download"]= "..|$owl_lang->alt_get_folder|$url|$owl_lang->alt_get_folder|zip.gif\n";
               $xtpl->assign('FOLDER_MENU_DOWNLD_ACTION', $url);
               $xtpl->assign('FOLDER_MENU_DOWNLD_LABEL', $owl_lang->alt_get_folder);
               $xtpl->assign('FOLDER_MENU_DOWNLD_ALT', $owl_lang->alt_get_folder);
               $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.Download');
            }
         }
      }
      // *****************************************************************************
      // Don't Show the modify icon if the user doesn't have modify access to the file
      // *****************************************************************************

      if ( $default->advanced_security == 1 )
      {
         if (check_auth($iFolderID, "folder_acl", $userid, false, false) == 1)
         //if(fIsAdmin(true) or fIsFolderCreator($folder_id))
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $iFolderID;
            $urlArgs2['parent'] = $parent;
            $urlArgs2['edit'] = 1;
            $urlArgs2['action'] = "folder_acl";
            $sUrl = fGetURL ('setacl.php', $urlArgs2);
            //$//aFolderMenuString["folder_acl"] = "..|$owl_lang->acl_set_acl|$sUrl|$owl_lang->acl_set_acl|setacl.png\n";
            $xtpl->assign('FOLDER_MENU_SETACL_ACTION', $sUrl);
            $xtpl->assign('FOLDER_MENU_SETACL_LABEL', $owl_lang->acl_set_acl);
            $xtpl->assign('FOLDER_MENU_SETACL_ALT', $owl_lang->acl_set_acl);
            $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.SetACL');
         }
      }
      if ($default->thumbnails == 1 and fisAdmin())
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['id'] = $folder_id;
         $urlArgs2['parent'] = $parent;
         $urlArgs2['action'] = 'folder_thumb';
         $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
         //$aFolderMenuString["folder_thumb"]= "..|$owl_lang->thumb_re_generate|$sUrl|$owl_lang->thumb_re_generate|thumb.png\n";
         $xtpl->assign('FOLDER_MENU_GENTHUMB_ACTION', $sUrl);
         $xtpl->assign('FOLDER_MENU_GENTHUMB_LABEL', $owl_lang->thumb_re_generate);
         $xtpl->assign('FOLDER_MENU_GENTHUMB_ALT', $owl_lang->thumb_re_generate);
         $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu.GenThumb');
      }

     $xtpl->parse('main.' . $XTPLTag . '.Folder.filename.Menu');
      //$menustring = $aFolderMenuString["folder_name"];

      //foreach ($default->FolderMenuOrder as $key)
      //{
         //$menustring .= $aFolderMenuString[$key];
      //}
//
      //$aFolderMenuString = NULL;
//
      //$mid->setMenuStructureString($menustring);
      //$mid->parseStructureForMenu('vermenuf'.$fid);
      //$mid->newVerticalMenu('vermenuf'.$fid);
   return;
}

function fSetupFileActionMenusXTPL($iFileID, $sFileName, $iCreatorID, $iApproved, $iCheckedOut, $iUrl, $iParent, $iInfected, $XTPLTag = 'DataBlock')
{
   global $default, $xtpl;
   global $parent, $sess, $expand, $order, $sortorder ,$sortname, $userid, $curview, $sortsize, $sortposted, $sortmod, $sortver, $sortupdator, $sortcheckedout, $sortfilename, $sort;
   global $owl_lang, $mid, $url, $page, $cCommonDBConnection, $iMenuRecordCounter, $is_backup_folder;

   $sql = $cCommonDBConnection;

   $sConfirm = '';

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }

   $aItemsToParse = array();

   $urlArgs['sess']      = $sess;

   if (!empty($page))
   {
      $urlArgs['page']      = $page;
   }

   $urlArgs['parent']    = $parent;
   $urlArgs['expand']    = $expand;
   $urlArgs['order']     = $order;
   $urlArgs['curview']     = $curview;
   $urlArgs[${$sortorder}]  = $sort;

   $self = $_SERVER["PHP_SELF"];

   if ($default->records_per_page > 0)
   {
      if ($default->restrict_view == 1)
      {
         $iMenuPageStartCount = $default->records_per_page * $page;
         $iMenuPageEndCount = $default->records_per_page * ($page + 1);
      }
   }

   //while ($setmenu->next_record())
   {
      if ($default->restrict_view == 1)
      {
         $bFileDownload = check_auth($iFileID, "file_download", $userid, false, false);
         if (!$bFileDownload)
         {
            return;
         }
      }

      if ($iCreatorID == $userid)
      {
         $bCreator = true;
      }
      else
      {
         $bCreator = false;
      }

      if ($default->records_per_page > 0)
      {
         if ($default->restrict_view == 1)
         {
            $iMenuRecordCounter++;
            //if ($iMenuRecordCounter > $iMenuPageEndCount or $iMenuRecordCounter <= $iMenuPageStartCount)
            //{
               //return;
            //}
         }
      }

  if ($default->peer_review_leave_old_file_accessible)
   {
      $CheckOlderVersion = new Owl_DB;

      $aFirstpExtension = fFindFileFirstpartExtension ($sFileName);
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
         $CheckOlderVersion->query("SELECT * FROM $default->owl_files_table WHERE (filename LIKE '" . $firstpart . "\\_%" . $file_extension . "' OR filename = '$filename') AND (parent = '$backup_parent' OR parent = '$parent') ORDER BY major_revision desc, minor_revision desc");
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
      $CheckOlderVersion->next_record();
      //$CheckOlderVersion->next_record();
      $fid = $CheckOlderVersion->f("id");
   }

   //print("N: $iNumrows <br />");
   $sSelf = basename($_SERVER["PHP_SELF"]);

   if ($iApproved == 0 and $default->peer_review_leave_old_file_accessible == true and  $sSelf == "browse.php")
   {
      if ($iNumrows == 0)
      {
         return;
      }
      else
      {
        $urlArgs2 = $urlArgs;
         $urlArgs2['binary'] = 1;
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         if(check_auth($fid, "file_download", $userid, false, false) == 1)
         {
            $sUrl = fGetURL ('download.php', $urlArgs2);
         }
         else
         {
            $sUrl = "#";
         }

         //$aFileMenuString["file_name"] = ".|" . $setmenu->f("filename") . "|$sUrl|$owl_lang->menu_file_action||\n";
         //$aFileMenuString["file_download"] = "..|Download Previous Ver.|$sUrl|Current Version Under Review Download Previous Version|bin.gif\n";

      $xtpl->assign('FILE_FILENAME', $sFileName);
      $xtpl->assign('FILE_MENU_ACTION', $sUrl);
      $xtpl->assign('FILE_MENU_ACTION_ALT', $owl_lang->menu_file_action);

      //$xtpl->assign('FILE_MENU_DOWNLD_LABEL', $sUrl);
      //$xtpl->assign('FILE_MENU_DOWNLD_ACTION', 'Download Previous Ver.');
      $xtpl->assign('FILE_MENU_DOWNLD_LABEL', 'Download Previous Ver.');
      $xtpl->assign('FILE_MENU_DOWNLD_ACTION', $sUrl);
      $xtpl->assign('FILE_MENU_DOWNLD_ALT', 'Current Version Under Review Download Previous Version');

      $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Download');
      $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu');


     //$menustring = $aFileMenuString["file_name"];

      //foreach ($default->FileMenuOrder as $key)
      //{
         //$menustring .= $aFileMenuString[$key];
      //}
//
      //$aFileMenuString = NULL;
//
      //iii$mid->setMenuStructureString($menustring);
      //$mid->parseStructureForMenu('vermenu'.$iFileID);
      //$mid->newVerticalMenu('vermenu'.$iFileID);
//
//print("</center><pre>");
//print_r($mid);
//print("</pre>");


         return;
      }
   }


      $fid = $iFileID;
      $filename = $sFileName;
      $checked_out = $iCheckedOut;
      $url = $iUrl;
      $allicons = $default->owl_version_control;
      $backup_parent = $iParent;


      if ( $url == "1" )
      {
         $aFileMenuString["file_name"] = ".|$filename|$filename|$owl_lang->menu_url_action||1\n";
         $xtpl->assign('FILE_FILENAME', $filename);
         $xtpl->assign('FILE_MENU_ACTION', $filename);
         $xtpl->assign('FILE_MENU_TARGET', '_blank');
         $xtpl->assign('FILE_MENU_ACTION_ALT', $owl_lang->menu_url_action);
      }
      else
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['binary'] = 1;
         $urlArgs2['id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;

         $xtpl->assign('FILE_MENU_TARGET', '_self');
         if ($iApproved == 0)
         {
           $xtpl->assign('FILE_FILENAME', $filename);
                 $xtpl->assign('FILE_MENU_ACTION', '#');
           $xtpl->assign('FILE_MENU_ACTION_ALT', '');
           $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu');
           return;
         }

	 // 0 = View File Details
         // 1 = Download File
         // 2 = Modify File Properties
         // 3 = View File
         if ($default->file_action_click_file_column == 0)
         {
            $urlArgs2['action'] = 'file_details';
            $sNewURL = fGetURL ('view.php', $urlArgs2);
            $sAltString = $owl_lang->alt_view_file;
         }
         else if ($default->file_action_click_file_column == 1)
         {
            $urlArgs2['binary'] = '1';
            $sNewURL = fGetURL ('download.php', $urlArgs2);
            $sAltString = $owl_lang->alt_get_file;
         }
         else if ($default->file_action_click_file_column == 2)
         {
            $urlArgs2['action'] = 'file_modify';
            $sNewURL = fGetURL ('modify.php', $urlArgs2);
            $sAltString = $owl_lang->alt_mod_file;
         }
         else if ($default->file_action_click_file_column == 3)
         {

            $urlArgs2['action'] = fViewFileAction($fid,$filename);
            $sNewURL = fGetURL ('view.php', $urlArgs2);
            $sAltString = $owl_lang->alt_mod_file;
         }
         else
         {
            $urlArgs2['action'] = 'file_details';
            $sNewURL = fGetURL ('view.php', $urlArgs2);
            $sAltString = $owl_lang->alt_view_file;
         }

         if(check_auth($fid, "file_download", $userid, false, false) == 1 and $iInfected  == '0')
         {
            $sUrl = $sNewURL;

         }
         else
         {
           if ($default->display_password_override == 1 and $default->file_action_click_file_column == 1)
            {
               if (fIsFilePasswordSet($fid))
               {
                  $sUrl = $sNewURL;
               }
               else
               {
                  $sUrl = "#";
                  $sAltString = '';
               }
            }
            else
            {
               $sUrl = "#";
               $sAltString = '';
            }
         }
        // $aFileMenuString["file_name"] = ".|$filename|$sUrl|$AltString||\n";
         $xtpl->assign('FILE_FILENAME', $filename);
         $xtpl->assign('FILE_MENU_ACTION', $sUrl);
         $xtpl->assign('FILE_MENU_ACTION_ALT', $sAltString);


      }

      $isBackup = fid_to_name($backup_parent);

      // check to see if the file is checked out
      // to display a the lock or unlock Icon.
   
      $iCheckedOut = $checked_out;
   
      //$aFileAccess = check_auth($fid, "file_all", $userid, false, false);
      $aFileAccess = check_auth($fid, "file_all", $userid, false, false);
   
      $bFileModify = $aFileAccess["owlproperties"];
      $bFileDownload = $aFileAccess["owlread"];
      $bFileDelete    = $aFileAccess["owldelete"];

      $bCheckOK = false;

      if (($checked_out == 0) or ($checked_out == $userid) or owlusergroup($userid) == 0 or  owlusergroup($userid) == $default->file_admin_group or fIsAdmin()) 
      { 
         $bCheckOK = true; 
      }
   
      // *****************************************************************************
      // Don't Show the delete icon if the user doesn't have delete access to the file
      // *****************************************************************************
//exit("HERE: u $url  bFdel: $bFileDelete FID: $fid");
   
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
               //$sUrl .= "\" onclick=\"return confirm('$owl_lang->reallydelete ". $filename ."?');";
               $sConfirm .= "return confirm('$owl_lang->reallydelete ". $filename ."?');";
               //$aFileMenuString["file_delete"] = "..|$owl_lang->alt_del_file|$sUrl|$owl_lang->alt_del_file Log|trash.gif\n";
               $xtpl->assign('FILE_MENU_DELETE_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_DELETE_CONFIRM', $sConfirm);
	       $xtpl->assign('FILE_MENU_DELETE_LABEL', $owl_lang->alt_del_file);
               $xtpl->assign('FILE_MENU_DELETE_ALT', $owl_lang->alt_del_file);
               $aItemsToParse['file_delete'] = 'Delete';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Delete');

            } 
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
               //$sUrl .= "\" onclick=\"return confirm('$owl_lang->reallydelete " .$filename ."?');";
               $sConfirm .= "return confirm('$owl_lang->reallydelete ". $filename ."?');";
               //$aFileMenuString["file_delete"] = "..|$owl_lang->alt_del_file|$sUrl|$owl_lang->alt_del_file Log|trash.gif\n";
               $xtpl->assign('FILE_MENU_DELETE_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_DELETE_CONFIRM', $sConfirm);
               $xtpl->assign('FILE_MENU_DELETE_LABEL', $owl_lang->alt_del_file);
               $xtpl->assign('FILE_MENU_DELETE_ALT', $owl_lang->alt_del_file);
               $aItemsToParse['file_delete'] = 'Delete';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Delete');
            } 
         }
      }
  
      if ($allicons == 1 and $aFileAccess["owlviewlog"] == 1 and $iInfected == '0')
      {
         if ($url == "0") 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['id'] = $fid;
            $urlArgs2['filename'] = $filename;
            $urlArgs2['parent'] = $backup_parent;

            $sUrl = fGetURL ('log.php', $urlArgs2);
            //$aFileMenuString["file_log"] = "..|$owl_lang->alt_log_file|$sUrl|$owl_lang->alt_log_file Log|log.gif\n";
            $xtpl->assign('FILE_MENU_FILELOG_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_FILELOG_LABEL', $owl_lang->alt_log_file);
            $xtpl->assign('FILE_MENU_FILELOG_ALT', $owl_lang->alt_log_file);
            $aItemsToParse['file_log'] = 'FileLog';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.FileLog');

         } 
      }
   
      // *****************************************************************************
      // Don't Show the modify icon if the user doesn't have modify access to the file
      // *****************************************************************************
      
      if($bFileModify == 1 && !$is_backup_folder and $iInfected == '0') 
      {
         if ($bCheckOK) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_modify';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);
            //$aFileMenuString["file_edit"] = "..|$owl_lang->alt_mod_file|$sUrl|$owl_lang->alt_mod_file|edit.gif\n";
            //$sUrl = "#\" onclick=\"AjaxGethtml('scripts/Ajax/Owl/getfilelink.php?sess=$sess&fileid=$fid', 'file_link_out', '$default->owl_graphics_url/$default->sButtonStyle/ui_misc/ajax-loader1.gif');\"";
            $xtpl->assign('FILE_MENU_EDIT_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_EDIT_LABEL', $owl_lang->alt_mod_file);
            $xtpl->assign('FILE_MENU_EDIT_ALT', $owl_lang->alt_mod_file);
            $aItemsToParse['file_edit'] = 'Edit';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Edit');

            $sGet = "AjaxGethtml('scripts/Ajax/Owl/getfilelink.php?sess=$sess&fileid=$fid', 'file_link_out', '$default->owl_graphics_url/$default->sButtonStyle/ui_misc/ajax-loader1.gif');";
            //$aFileMenuString["file_hotlink"] = "..|$owl_lang->alt_hot_link|$sUrl|$owl_lang->alt_hot_link|link.gif\n";
            $xtpl->assign('FILE_MENU_HOTLINK_ACTION', '#');
            $xtpl->assign('FILE_MENU_HOTLINK_GET', $sGet);
            $xtpl->assign('FILE_MENU_HOTLINK_LABEL', $owl_lang->alt_hot_link);
            $xtpl->assign('FILE_MENU_HOTLINK_ALT', $owl_lang->alt_hot_link);
            $aItemsToParse['file_hotlink'] = 'HotLink';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.HotLink');
   
         } 
      }

      // *****************************************************************************
      // Don't Show the modify icon if the user doesn't have modify access to the file
      // *****************************************************************************
      
      if ( $default->advanced_security == 1 ) 
      {
         if($aFileAccess["owlsetacl"] == 1 and $iInfected == '0')
         {
            if ($bCheckOK) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $urlArgs2['edit'] = 1;
               $urlArgs2['action'] = "file_acl";
               $sUrl = fGetURL ('setacl.php', $urlArgs2);
               //$aFileMenuString["file_acl"] = "..|$owl_lang->acl_set_acl|$sUrl|$owl_lang->acl_set_acl|setacl.png\n";
               $xtpl->assign('FILE_MENU_SETACL_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_SETACL_LABEL', $owl_lang->acl_set_acl);
               $xtpl->assign('FILE_MENU_SETACL_ALT', $owl_lang->acl_set_acl);
               $aItemsToParse['file_acl'] = 'SetACL';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.SetACL');
            } 
         }
      }
       // *****************************************************************************
      // Don't Show the link icon if the user doesn't have move access to the file
      // *****************************************************************************
   

     $Realid = fGetPhysicalFileId($fid);
                                                                                                                                                                                                    
      //if ($bFileModify == 1 && !$is_backup_folder and $Realid == $fid)
      if (!$is_backup_folder and $Realid == $fid and $aFileAccess["owlmove"] == 1 and $iInfected == '0')
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
               //$aFileMenuString["file_link"] = "..|$owl_lang->alt_link_file|$sUrl|$owl_lang->alt_link_file|link.gif\n";
               $xtpl->assign('FILE_MENU_LINK_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_LINK_LABEL', $owl_lang->alt_link_file);
               $xtpl->assign('FILE_MENU_LINK_ALT', $owl_lang->alt_link_file);
               $aItemsToParse['file_link'] = 'Link';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Link');
            }
         }
      }
   
   
      // *****************************************************************************
      // Don't Show the copy icon if the user doesn't have move access to the file
      // *****************************************************************************
   
      //if ($bFileModify == 1 && !$is_backup_folder)
      if (!$is_backup_folder and $aFileAccess["owlcopy"] == 1 and $iInfected == '0')
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
                  //$aFileMenuString["file_copy"] = "..|$owl_lang->alt_copy_file|$sUrl|$owl_lang->alt_copy_file|copy.gif\n";
                  $xtpl->assign('FILE_MENU_COPY_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_COPY_LABEL', $owl_lang->alt_copy_file);
                  $xtpl->assign('FILE_MENU_COPY_ALT', $owl_lang->alt_copy_file);
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Copy');

               }  
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
                  //$aFileMenuString["file_copy"] = "..|$owl_lang->alt_copy_file|$sUrl|$owl_lang->alt_copy_file|copy.gif\n";
                  $xtpl->assign('FILE_MENU_COPY_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_COPY_LABEL', $owl_lang->alt_copy_file);
                  $xtpl->assign('FILE_MENU_COPY_ALT', $owl_lang->alt_copy_file);
                  $aItemsToParse['file_copy'] = 'Copy';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Copy');
   
               } 
            }
         }
      }
   
      // *****************************************************************************
      // Don't Show the move modify icon if the user doesn't have move access to the file
      // *****************************************************************************
   
      //if ($bFileModify == 1 && !$is_backup_folder)
      if (!$is_backup_folder and $aFileAccess["owlmove"] == 1 and $iInfected == '0')
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
                 // $aFileMenuString["file_move"] = "..|$owl_lang->alt_move_file|$sUrl|$owl_lang->alt_move_file|move.gif\n";
                  $xtpl->assign('FILE_MENU_MOVE_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_MOVE_LABEL', $owl_lang->alt_move_file);
                  $xtpl->assign('FILE_MENU_MOVE_ALT', $owl_lang->alt_move_file);
                  $aItemsToParse['file_copy'] = 'Copy';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Move');

   
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
                  //$aFileMenuString["file_move"] = "..|$owl_lang->alt_move_file|$sUrl|$owl_lang->alt_move_file|move.gif\n";
                  $xtpl->assign('FILE_MENU_MOVE_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_MOVE_LABEL', $owl_lang->alt_move_file);
                  $xtpl->assign('FILE_MENU_MOVE_ALT', $owl_lang->alt_move_file);
                  $aItemsToParse['file_move'] = 'Move';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Move');
   
               } 
            }
         }
      }
   
   
      // *****************************************************************************
      // Don't Show the file update icon if the user doesn't have update access to the file
      // *****************************************************************************
   
      //if($bFileModify == 1 && !$is_backup_folder and $Realid == $fid)
      if(!$is_backup_folder and $Realid == $fid and $aFileAccess["owlupdate"] == 1 and $iInfected == '0')
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
                  //$aFileMenuString["file_update"] = "..|$owl_lang->alt_upd_file|$sUrl|$owl_lang->alt_upd_file|update.gif\n";
                  $xtpl->assign('FILE_MENU_UPDATE_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_UPDATE_LABEL', $owl_lang->alt_upd_file);
                  $xtpl->assign('FILE_MENU_UPDATE_ALT', $owl_lang->alt_upd_file);
                  $aItemsToParse['file_update'] = 'Update';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Update');
               } 
            }
         }
      }
      // *****************************************************************************
      // Don't Show the file dowload icon if the user doesn't have download access to the file
      // *****************************************************************************
      
      if (($bFileDownload == 1 and $iInfected == '0') or 
          ($default->display_password_override == 1 and fIsFilePasswordSet($fid))
         )
      {
         if ($url != "1")
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['binary'] = 1;
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('download.php', $urlArgs2);
            //$aFileMenuString["file_download"] = "..|$owl_lang->alt_get_file|$sUrl|$owl_lang->alt_get_file|bin.gif\n";
            $xtpl->assign('FILE_MENU_DOWNLD_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_DOWNLD_LABEL', $owl_lang->alt_get_file);
            $xtpl->assign('FILE_MENU_DOWNLD_ALT', $owl_lang->alt_get_file);
            $aItemsToParse['file_download'] = 'Download';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Download');
   
         }
      }
   
      // *****************************************************************************
      // Don't Show the comment icon if the user doesn't have download access to the file
      // *****************************************************************************
   
      //if($bFileDownload == 1 && !$is_backup_folder) 
      if ($aFileAccess["owlcomment"] == 1 and !$is_backup_folder and $iInfected == '0')
      {
         $sql->query("SELECT * FROM $default->owl_comment_table WHERE fid = '$fid'");
         if($sql->num_rows() == 0) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_comment';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);
            //$aFileMenuString["file_comment"] =  "..|$owl_lang->alt_add_comments|$sUrl|$owl_lang->alt_add_comments|comment_dis.gif\n";
            $xtpl->assign('FILE_MENU_COMMENT_IMG', 'comment_dis');
            $xtpl->assign('FILE_MENU_COMMENT_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_COMMENT_LABEL', $owl_lang->alt_add_comments);
            $xtpl->assign('FILE_MENU_COMMENT_ALT', $owl_lang->alt_add_comments);
            $aItemsToParse['file_comment'] = 'Comments';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Comments');

         } 
         else 
         { 
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_comment';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);
            //$aFileMenuString["file_comment"] =  "..|$owl_lang->alt_view_comments|$sUrl|$owl_lang->alt_view_comments|comment.gif\n";
            $xtpl->assign('FILE_MENU_COMMENT_IMG', 'comment');
            $xtpl->assign('FILE_MENU_COMMENT_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_COMMENT_LABEL', $owl_lang->alt_view_comments);
            $xtpl->assign('FILE_MENU_COMMENT_ALT', $owl_lang->alt_view_comments);
            $aItemsToParse['file_comment'] = 'Comments';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Comments');
         }
      }

      if ($allicons == 1)
      {
         // *****************************************************************************
         // Don't Show the lock icon if the user doesn't have access to the file
         // *****************************************************************************
         //if($bFileModify == 1 && !$is_backup_folder and $Realid == $fid)
         if ($aFileAccess["owlcheckin"] == 1 and !$is_backup_folder and $Realid == $fid and $iInfected == '0')
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
                     //$aFileMenuString["file_lock"] =  "..|$owl_lang->alt_unlock_file|$sUrl|$owl_lang->alt_unlock_file|unlock.gif\n";
                     $xtpl->assign('FILE_MENU_FILELOCK_IMG', 'unlock');
                     $xtpl->assign('FILE_MENU_FILELOCK_ONCLICK', '');
                     $xtpl->assign('FILE_MENU_FILELOCK_ACTION', $sUrl);
                     $xtpl->assign('FILE_MENU_FILELOCK_LABEL', $owl_lang->alt_unlock_file);
                     $xtpl->assign('FILE_MENU_FILELOCK_ALT', $owl_lang->alt_unlock_file);
                     $aItemsToParse['file_lock'] = 'FileLock';
                     $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.FileLock');
   
                  } 
                  else 
                  {
                     $urlArgs2 = $urlArgs;
                     $urlArgs2['action'] = 'file_lock';
                     $urlArgs2['id'] = $fid;
                     $urlArgs2['parent'] = $backup_parent;
		      if ($default->take_ownership_on_checkout == 1)
		      {
                        if ($bCreator == true)
                        {
                           $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                           $xtpl->assign('FILE_MENU_FILELOCK_ACTION', $sUrl);
                           $xtpl->assign('FILE_MENU_FILELOCK_ONCLICK', '');
                        }
                        else
                        {
                           if ($aFileAccess["owlupdate"] == 1)
                           {
                              $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                              $urlArgs2['takeownership'] = 'Yes';
                              $sLoc = fGetURL ('dbmodify.php', $urlArgs2);
                              //$sUrl = "#\" onclick=\"if (confirm('You do not own this file.\\n\\nWould you like to take ownership on Checkout?')) { window.location = '$sLoc'; } else { window.location = '$sUrl'; }\"";
                              $sConfirm = "onclick=\"if (confirm('You do not own this file.\\n\\nWould you like to take ownership on Checkout?')) { window.location = '$sLoc'; } else { window.location = '$sUrl'; }\"";
                              $xtpl->assign('FILE_MENU_FILELOCK_ONCLICK', $sConfirm);
                              $xtpl->assign('FILE_MENU_FILELOCK_ACTION', '#');
                           }
                           else
                           {
                              $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                           }
                        }
                     }
	             else
		     {
                        $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
		     }
                     //$aFileMenuString["file_lock"] =  "..|$owl_lang->alt_lock_file|$sUrl|$owl_lang->alt_lock_file|lock.gif\n";
                     $xtpl->assign('FILE_MENU_FILELOCK_IMG', 'lock');
                     $xtpl->assign('FILE_MENU_FILELOCK_ACTION', $sUrl);
                     $xtpl->assign('FILE_MENU_FILELOCK_LABEL', $owl_lang->alt_lock_file);
                     $xtpl->assign('FILE_MENU_FILELOCK_ALT', $owl_lang->alt_lock_file);
                     $aItemsToParse['file_lock'] = 'FileLock';
                     $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.FileLock');
		  }
               } 
            }
         }
      }

      // *****************************************************************************
      // Don't Show the email icon if the user doesn't have access to email the file
      // *****************************************************************************

      //if($bFileDownload == 1 && !$is_backup_folder)
      if ($aFileAccess["owlemail"] == 1 and !$is_backup_folder and $iInfected == '0')
      {
         if ($url == "1") 
         {
            //if ($default->owl_version_control == 1) 
            //{
            //}
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['type']   = 'url';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);
            //$aFileMenuString["file_email"] =  "..|$owl_lang->alt_email|$sUrl|$owl_lang->alt_email|email.gif\n";
            $xtpl->assign('FILE_MENU_EMAIL_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_EMAIL_LABEL', $owl_lang->alt_email);
            $xtpl->assign('FILE_MENU_EMAIL_ALT', $owl_lang->alt_email);
            $aItemsToParse['file_email'] = 'Email';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Email');


         } 
         else 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'file_email';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('modify.php', $urlArgs2);
         //   $aFileMenuString["file_email"] =  "..|$owl_lang->alt_email|$sUrl|$owl_lang->alt_email|email.gif\n";
            $xtpl->assign('FILE_MENU_EMAIL_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_EMAIL_LABEL', $owl_lang->alt_email);
            $xtpl->assign('FILE_MENU_EMAIL_ALT', $owl_lang->alt_email);
            $aItemsToParse['file_email'] = 'Email';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Email');
         }
      }


      $ext = fFindFileExtension($filename);
      $sFileAction = fGetViewFileAction($fid, $filename);
      if($aFileAccess["owlupdate"] && !$is_backup_folder and $Realid == $fid and $url == 0 and $iInfected == '0')
      {
         if (($default->hide_backup == 1 && $self != $default->owl_root_url . "/log.php")  || $isBackup != "$default->version_control_backup_dir_name" || $default->hide_backup != 1)
         {
            if ($bCheckOK)
            {
               if (!empty ($default->edit_text_files_inline))
               {
                  $edit_inline =$default->edit_text_files_inline;
                  if ($ext != "" and preg_grep("/\b$ext\b/", $edit_inline) and $sFileAction <> 'text_show')
                  {
                     $urlArgs2 = $urlArgs;
                     $urlArgs2['action'] = $sFileAction;
                     $urlArgs2['id'] = $fid;
                     $urlArgs2['parent'] = $backup_parent;
                     $sUrl = fGetURL ('modify.php', $urlArgs2);
                     //$aFileMenuString["file_inline_edit"] =  "..|$owl_lang->alt_edit_file_inline|$sUrl|$owl_lang->alt_edit_file_inline|edit_file.gif\n";
                     $xtpl->assign('FILE_MENU_INLINE_ACTION', $sUrl);
                     $xtpl->assign('FILE_MENU_INLINE_LABEL', $owl_lang->alt_edit_file_inline);
                     $xtpl->assign('FILE_MENU_INLINE_ALT', $owl_lang->alt_edit_file_inline);
                     $aItemsToParse['file_inline_edit'] = 'Inline';
                     $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Inline');
                  }
               }
            }
         }
      }


      // *****************************************************************************
      // Don't Show the toggle monitor this file  icon if the user doesn't have access 
      // *****************************************************************************

      //if($bFileDownload == 1)
      if ($aFileAccess["owlmonitor"] == 1 and $iInfected == '0')
      {
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
                  //$aFileMenuString["file_monitor"] = "..|$owl_lang->alt_monitor|$sUrl|$owl_lang->alt_monitor|monitor.gif\n";
                  $xtpl->assign('FILE_MENU_MONITOR_IMG', 'monitor');
                  $xtpl->assign('FILE_MENU_MONITOR_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_MONITOR_LABEL', $owl_lang->alt_monitor);
                  $xtpl->assign('FILE_MENU_MONITOR_ALT', $owl_lang->alt_monitor);
                  $aItemsToParse['file_monitor'] = 'Monitor';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Monitor');

               }  
               else 
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'file_monitor';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('dbmodify.php', $urlArgs2);
                  //$aFileMenuString["file_monitor"] = "..|$owl_lang->alt_monitored|$sUrl|$owl_lang->alt_monitored|monitored.gif\n";
                  $xtpl->assign('FILE_MENU_MONITOR_IMG', 'monitored');
                  $xtpl->assign('FILE_MENU_MONITOR_ACTION', $sUrl);
                  $xtpl->assign('FILE_MENU_MONITOR_LABEL', $owl_lang->alt_monitored);
                  $xtpl->assign('FILE_MENU_MONITOR_ALT', $owl_lang->alt_monitored);
                  $aItemsToParse['file_monitor'] = 'Monitor';
                  $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.Monitor');

               }
            }
         }
      }

      if ($aFileAccess["owlrelsearch"] == 1 and $iInfected == '0')
      {
         $urlArgs2 = $urlArgs;
         $urlArgs2['search_id'] = $fid;
         $urlArgs2['parent'] = $backup_parent;
         $sUrl = fGetURL ('search.php', $urlArgs2);
         //$aFileMenuString["file_find"]  = "..|$owl_lang->alt_related|$sUrl|$owl_lang->alt_related|related.gif\n";
         $xtpl->assign('FILE_MENU_FINDRELATED_ACTION', $sUrl);
         $xtpl->assign('FILE_MENU_FINDRELATED_LABEL', $owl_lang->alt_related);
         $xtpl->assign('FILE_MENU_FINDRELATED_ALT', $owl_lang->alt_related);
         $aItemsToParse['file_find'] = 'FindRelated';
         $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.FindRelated');
      }
    
      // *****************************************************************************
      // Don't Show the view icon if the user doesn't have download access to the file
      // *****************************************************************************

      $xtpl->assign('FILE_MENU_VIEW_TARGET', '');
      if ($default->view_doc_in_new_window)
      {
         $sTarget = "_new";
         $xtpl->assign('FILE_MENU_VIEW_TARGET', 'target="_new"');
      }

      if($bFileDownload == 1 and $iInfected == '0')
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

               //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');


            }
            $htmlfiles = array("php","php3");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'php_show';
               $urlArgs2['action'] = $sFileAction;
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);
	       //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
            }
            
            $htmlfiles = array("html","htm","xml");
            if ($ext != "" && preg_grep("/\b$ext\b/", $htmlfiles)) 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'html_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);
	       //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');


            }
            if ($ext != "" && $ext == "pod") 
            {
               $urlArgs2 = $urlArgs;
               $urlArgs2['action'] = 'pod_show';
               $urlArgs2['id'] = $fid;
               $urlArgs2['parent'] = $backup_parent;
               $sUrl = fGetURL ('view.php', $urlArgs2);
	       //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');

            }
            $txtfiles = array("tpl", "txt","text","README", "readme", "sh", "c", "h", "cpp", "pl", "perl", "sql", "py", "tex", "bib");
            if ($ext != "" && preg_grep("/\b$ext\b/", $txtfiles)) 
            {
               if(owlfiletype($fid) == 2) 
               { 
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'note_show';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('view.php', $urlArgs2);
	          //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');

               }
               else
               {
                  $urlArgs2 = $urlArgs;
                  $urlArgs2['action'] = 'text_show';
                  $urlArgs2['id'] = $fid;
                  $urlArgs2['parent'] = $backup_parent;
                  $sUrl = fGetURL ('view.php', $urlArgs2);
	          //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
               $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
               $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
               $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
               $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
               $aItemsToParse['file_view'] = 'View';
               $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
               }
            }
         }
      }

      // BEGIN what I added to show PDF, DOC, and TXT special view

      if($bFileDownload == 1 and $url != 1 and $iInfected == '0')
      {
         $pdffiles = array("pdf");
         if ($ext != "" && preg_grep("/\b$ext\b/", $pdffiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'pdf_show';
            $urlArgs2['action'] = $sFileAction;
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $urlArgs2['filext'] = $ext;
            $sUrl = fGetURL ('view.php', $urlArgs2);
	    //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
         }
   
         $mswordfiles = array("doc", "sxw", "docx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $mswordfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'doc_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
	    $aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
         }
  
         $msexcelfiles = array("xls", "xlsx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $msexcelfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'xls_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
	    $aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
 
         }

         $emailfiles = array("eml");
         if ($ext != "" && preg_grep("/\b$ext\b/", $emailfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'email_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
	    $aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
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
	       $aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
 
            }
         } 
         //$default->aVideoFiles = array("flv");
         if ($ext != "" && preg_grep("/\b$ext\b/", $default->aVideoFiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'video_play';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
            $aFileMenuString["file_view"] =  "..|$owl_lang->alt_play_file|$sUrl|$owl_lang->alt_play_file|play.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'play');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_play_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_play_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');

         }
         $audiofiles = array("mp3");
         if ($ext != "" && preg_grep("/\b$ext\b/", $audiofiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'mp3_play';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
            $aFileMenuString["file_view"] =  "..|$owl_lang->alt_play_file|$sUrl|$owl_lang->alt_play_file|play.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'play');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_play_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_play_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');

         }
  
         $pptfiles = array("ppt", "pptx");
         if ($ext != "" && preg_grep("/\b$ext\b/", $pptfiles)) 
         {
            $urlArgs2 = $urlArgs;
            $urlArgs2['action'] = 'ppt_show';
            $urlArgs2['id'] = $fid;
            $urlArgs2['parent'] = $backup_parent;
            $sUrl = fGetURL ('view.php', $urlArgs2);
            $aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');

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
               //$aFileMenuString["file_view"] =  "..|$owl_lang->alt_view_file|$sUrl|$owl_lang->alt_view_file|mag.gif|$sTarget\n";
            $xtpl->assign('FILE_MENU_VIEW_IMG', 'mag');
            $xtpl->assign('FILE_MENU_VIEW_ACTION', $sUrl);
            $xtpl->assign('FILE_MENU_VIEW_LABEL', $owl_lang->alt_view_file);
            $xtpl->assign('FILE_MENU_VIEW_ALT', $owl_lang->alt_view_file);
            $aItemsToParse['file_view'] = 'View';
            $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.View');
            }
         }
      }

      if ($default->thumbnails == 1 and fisAdmin() and $url == 0 and $iInfected == '0')
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
             //$aFileMenuString["file_thumb"] = "..|$owl_lang->thumb_re_generate|$sUrl|$owl_lang->thumb_re_generate|thumb.png\n";
             $xtpl->assign('FILE_MENU_GENTHUMB_ACTION', $sUrl);
             $xtpl->assign('FILE_MENU_GENTHUMB_LABEL', $owl_lang->thumb_re_generate);
             $xtpl->assign('FILE_MENU_GENTHUMB_ALT', $owl_lang->thumb_re_generate);
             $aItemsToParse['file_thumb'] = 'GenThumb';
             $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.GenThumb');
         }
      }
      
      //$menustring = $aFileMenuString["file_name"];
//
      //foreach ($default->FileMenuOrder as $key) 
      //{
         //if (isset($aItemsToParse[$key]))
         //{
           // print("<br />Key: $key -- " . 'main.' . $XTPLTag . '.File.filename.Menu.' . $aItemsToParse[$key]);
            //$xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu.' . $aItemsToParse[$key]);
         //}
      //}
//
      $xtpl->parse('main.' . $XTPLTag . '.File.filename.Menu');
      //$aFileMenuString = NULL;
//
      //$mid->setMenuStructureString($menustring);
      //$mid->parseStructureForMenu('vermenu'.$fid);
      //$mid->newVerticalMenu('vermenu'.$fid);
   }
   return;
}
function fPrintTitleRowXTPL ()
{
   global $default, $xtpl, $owl_lang, $expand, $sess, $iColspan;

    $iColspan++;
      if ($default->show_bulk > 0 or (fIsAdmin() and $default->show_bulk == 0 ))
      {
         if ($sess != "0" || ( $sess == "0" && $default->anon_ro == 0 ))
         {
            $xtpl->assign('TITLE_BULK_URL', '#');
            $xtpl->assign('TITLE_BULK_TITLE', $owl_lang->alt_toggle_check_box);
            $xtpl->assign('TITLE_BULK_ONCLICK', ' onclick="CheckAll(); return false;"');
            $xtpl->parse('main.Search.Title.Bulk');
            $iColspan++;
         }
      }

      if (($default->expand_search_disp_score and $expand == 1) or ($default->collapse_search_disp_score and $expand == 0))
      {
         $xtpl->assign('SEARCH_SCORE_TITLE', $owl_lang->score);
         $xtpl->parse('main.Search.Title.Score');
         $iColspan++;
      }
      if (($default->expand_search_disp_folder_path and $expand == 1) or ($default->collapse_search_disp_folder_path and $expand == 0))
      {

         $xtpl->assign('SEARCH_FOLDER_PATH_TITLE', $owl_lang->owl_log_hd_fld_path);
         $xtpl->parse('main.Search.Title.FldPath');
         $iColspan++;
      }
      if (($default->expand_search_disp_doc_num and $expand == 1) or ($default->collapse_search_disp_doc_num and $expand == 0))
      {
         $xtpl->assign('SEARCH_DOCNUM_TITLE', $owl_lang->doc_number);
         $xtpl->parse('main.Search.Title.DocNum');
         $iColspan++;
      }
      if ($default->thumbnails == 1 and $default->thumbnails_small_width > 0)
      {
         $xtpl->parse('main.Search.Title.Thumb');
         $iColspan++;
      }
      if (($default->expand_search_disp_doc_fields and $expand == 1) or ($default->colps_search_disp_doc_fields and $expand == 0))
      {
         $xtpl->assign('SEARCH_DOCFIELDS_TITLE', $owl_lang->doc_fields);
         $xtpl->parse('main.Search.Title.DocFields');
         $iColspan++;
      }
      if (($default->expand_search_disp_doc_type and $expand == 1) or ($default->collapse_search_disp_doc_type and $expand == 0))
      {
         $xtpl->parse('main.Search.Title.DocType');
         $iColspan++;
      }
      if (($default->expand_search_disp_file and $expand == 1) or ($default->collapse_search_disp_file and $expand == 0))
      {
         $xtpl->assign('SEARCH_FILENAME_TITLE', $owl_lang->file);
         $xtpl->parse('main.Search.Title.filename');
         $iColspan++;
      }
      if (($default->expand_search_disp_size and $expand == 1) or ($default->collapse_search_disp_size and $expand == 0))
      {
         $xtpl->assign('SEARCH_SIZE_TITLE', $owl_lang->size);
         $xtpl->parse('main.Search.Title.f_size');
         $iColspan++;
      }
      if (($default->expand_search_disp_posted and $expand == 1) or ($default->collapse_search_disp_posted and $expand == 0))
      {
         $xtpl->assign('SEARCH_POSTEDBY_TITLE', $owl_lang->postedby);
         $xtpl->parse('main.Search.Title.creatorid');
         $iColspan++;
      }
      if (($default->expand_search_disp_updated and $expand == 1) or ($default->collapse_search_disp_updated and $expand == 0))
      {
         $xtpl->assign('SEARCH_UPDATEDBY_TITLE', $owl_lang->updated_by);
         $xtpl->parse('main.Search.Title.updatorid');
         $iColspan++;
      }
      if (($default->expand_search_disp_modified and $expand == 1) or ($default->collapse_search_disp_modified and $expand == 0))
      {
         $xtpl->assign('SEARCH_SMODIFIED_TITLE', $owl_lang->modified);
         $xtpl->parse('main.Search.Title.smodified');
         $iColspan++;
      }
      if (($default->expand_search_disp_action and $expand == 1) or ($default->collapse_search_disp_action and $expand == 0))
      {
         $xtpl->assign('SEARCH_ACTIONS_TITLE', $owl_lang->actions);
         $xtpl->parse('main.Search.Title.Actions');
         $iColspan++;
      }

    $xtpl->parse('main.Search.Title');
    return $iColspan;
}

function fPrintRelatedDocsXTLP($rowtitle, $name, $size = "24", $value)
{
    global $xtpl, $default, $sess;

    $xtpl->assign('RELATED_LABEL_ID', $name);
    $xtpl->assign('RELATED_LABEL_NAME', $rowtitle);
    if (!empty($value))
    {
       $sRelatedLink = '';
       foreach($value as $v)
       {
           $label = $default->doc_id_prefix;
           for ($j = 1; $j < $default->doc_id_num_digits; $j++)
           {
               $label .= "0";
           }
           $label .= $v;
           $parent = owlfileparent($v);
           $sRelatedLink .= "<a href=\"browse.php?sess=$sess&parent=$parent&expand=1&fileid=$v\">$label</a>&nbsp;|&nbsp;";
       }
    }

    $xtpl->assign('RELATED_FILE_LINK', $sRelatedLink);
    $xtpl->parse('main.ViewFile.Details.RelatedDocs');
}

?>
