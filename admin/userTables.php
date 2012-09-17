<?php

/**
 * userTables.php
 *
 * Author: Filipe Lima (filipe.aclima@gmail.com) based on index.php by Steve Bourgeois <owl@bozzit.com>
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
 * $Id: userTables.php,v 1.01 2009/03/22 15:08:52 b0zz Exp $
 */


 
ob_start();
require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
$out = ob_get_clean();
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");


$urlArgs  = array();

if (empty($action))
{
	$action = "viewTuple";
}

$table = $default->userTables_defaultTable;

if (empty($_POST["table"]))
{
   if (!empty($_GET["table"]))
   {
      $table = $_GET["table"];
   }
}
else
{
   $table = $_POST["table"];
}

$bGrantAccess = false;
if (!fIsAdmin(true))
{
  $bGrantAccess = false;
}
else
{
  $bGrantAccess = true;
}

if ($bGrantAccess === false)
{
   if (fIsUserAdmin($userid) and ($action == "viewTuple" or $action == "addTuple" or $action == "insertTuple" or $action == "editTuple" or $action == "updateTuple" or $action == "deleteTuple"))
   {
      $bGrantAccess = true;
   }
}
if ($bGrantAccess === false)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
   exit;
   //die("<br /><center>$owl_lang->err_unauthorized</center><br />");
}

if (fIsUserAdmin($userid) and $owluser == 1)
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
   exit;
   //printError($owl_lang->err_unauthorized);
}

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/usertables.xtpl");
$xtpl = new XTemplate("html/admin/usertables.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

include($default->owl_fs_root . "/lib/header.inc");
include($default->owl_fs_root . "/lib/userheader.inc");
//print("<center>");
//print("<table class=\"border1\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"$default->table_expand_width\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">\n");
//fPrintButtonSpace(12, 1);
//print("<br />\n");
//print("<table class=\"border2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\" width=\"100%\">\n");
if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}
//fPrintButtonSpace(12, 1);
//print("<br />\n");
if (fIsAdmin(true))
{
   fPrintAdminPanelXTPL($action);
}

function printUserTables()
{
	global $sess, $default, $owl_lang, $userid, $table;
        global $xtpl;
	$sql = new Owl_DB;
	$sql->query("SELECT tableName, description FROM $default->userTables_dictionary ORDER BY description");
        $xtpl->assign('USERTBL_PAGE_TITLE', $owl_lang->tables_header);
	//fPrintSectionHeader("$owl_lang->tables_header");
        $xtpl->assign('USERTBL_TABLES_LABEL', $owl_lang->table);
	//print("<tr>\n");
   //print("<td class=\"form1\">$owl_lang->table:</td>\n");
   //print("<td class=\"form1\" width=\"100%\">");
   //print("<select class=\"fpull1\" name=\"table\" size=\"1\">\n");
	while ($sql->next_record())
	{
           $xtpl->assign('USERTBL_TABLE_VALUE', $sql->f('tableName'));
           $xtpl->assign('USERTBL_TABLE_SELECTED', '');
		//print("\t\t\t\t\t\t\t\t<option value=\"" . $sql->f("tableName") . "\"");
		if ($sql->f("tableName") == $table)
		{
			 //print(" selected=\"selected\"");
                   $xtpl->assign('USERTBL_TABLE_SELECTED', ' selected="selected"');
		}
		//print(">" . $sql->f("description") . "</option>\n");
           $xtpl->assign('USERTBL_TABLE_CAPTION', $sql->f('description'));
           $xtpl->parse('main.usertables.Table');
	}
   //print("</select></td></tr>");
   //print("<tr>");
   //print("<td class=\"form1\">");
   //fPrintButtonSpace(1, 1);
   //print("</td>");
   //print("<td class=\"form2\" width=\"100%\">");
   //print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   //print("\t<tr>\n");
	//print("<td width=\"100%\">\n");
   $xtpl->assign('BTN_VIEW_LABEL', $owl_lang->tables_tupleView);
   $xtpl->assign('BTN_VIEW_ALT', $owl_lang->tables_tupleView);
	//fPrintSubmitButton($owl_lang->tables_tupleView, $owl_lang->tables_tupleView, "submit", "tables_tupleView");
	//print("<td>");
   $urlArgs2 = array();
   $urlArgs2['sess']        = $sess;
   $urlArgs2['action']      = 'addTuple';
   $urlArgs2['table']        = $table;
   
   $xtpl->assign('BTN_ADD_URL', fGetURL ('admin/userTables.php', $urlArgs2));
   $xtpl->assign('BTN_ADD_LABEL', 'Add Tuples');

   //fPrintButton("userTables.php?sess=$sess&amp;action=addTuple&amp;table=$table", "tables_tupleAdd");
   //print("</td>");
	/*print("<td>");
   fPrintButton("userTables.php?sess=$sess&amp;action=editTable", "tables_tableEdit");
   print("</td><td>");
   fPrintButton("userTables.php?sess=$sess&amp;action=addTable", "tables_tableAdd");
   print("</td>");*/
   //print("\t</tr></table>\n");
   //print("</td></tr>");
}
function printViewTuples()
{
	global $sess, $default, $owl_lang, $userid, $table;
        global $xtpl;

	$sql = new Owl_DB;
	$sql->query("SELECT id, descr, descr2 FROM $table ORDER BY descr");
	//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr>\n");
        $xtpl->assign('USERTBL_TITLE_DESC1', $owl_lang->tables_descr);
        $xtpl->assign('USERTBL_TITLE_DESC2', $owl_lang->tables_descr2);
        $xtpl->assign('USERTBL_TITLE_ACTIONS', $owl_lang->tables_actions);
	//print("<td class=\"title1\">$owl_lang->tables_descr</td>\n");
   //print("<td class=\"title1\">$owl_lang->tables_descr2</td>\n");
	//print("<td class=\"title1\" colspan=\"2\">$owl_lang->tables_actions</td>\n");
  $CountLines = 0;
   while ($sql->next_record())
   {
      $CountLines++;
      $PrintLines = $CountLines % 2;
      if ($PrintLines == 0)
      {
         $sTrClass = "file1";
      }
      else
      {
         $sTrClass = "file2";
      }
      $xtpl->assign('TD_CLASS', $sTrClass);

		//$id = $sql->f("id");
		//$descr = $sql->f("descr");
		//$descr2 = $sql->f("descr2");
   $urlArgs2 = array();
   $urlArgs2['sess']      = $sess;
   $urlArgs2['id']        = $sql->f("id");
   $urlArgs2['action']    = 'editTuple';
   $urlArgs2['table']     = $table;
        $xtpl->assign('USERTBL_DESC1', $sql->f("descr"));
        $xtpl->assign('USERTBL_DESC2', $sql->f("descr2"));
        $xtpl->assign('USERTBL_EDIT_URL', fGetURL ('admin/userTables.php', $urlArgs2));
        $xtpl->assign('USERTBL_EDIT_LABEL', $owl_lang->tables_tupleEdit);

   $urlArgs2['action']    = 'deleteTuple';
        $xtpl->assign('USERTBL_DEL_URL', fGetURL ('admin/userTables.php', $urlArgs2));
        $xtpl->assign('USERTBL_DEL_LABEL', $owl_lang->tables_tupleDelete);
		//print("<tr><td class=\"form1\">$descr</td>");
		//print("<td class=\"form1\">$descr2</td>");
		//print("<td class=\"form1\"><a href=\"userTables.php?sess=$sess&amp;action=editTuple&amp;table=$table&amp;id=$id\">$owl_lang->tables_tupleEdit</td>");
		//print("<td class=\"form1\"><a href=\"userTables.php?sess=$sess&amp;action=deleteTuple&amp;table=$table&amp;id=$id\">$owl_lang->tables_tupleDelete</td>");
           $xtpl->parse('main.usertables.ViewTuples.Rows');
	}
}
function printAddTuple()
{
	global $sess, $owl_lang, $default, $userid, $table, $xtpl;

        $xtpl->assign('USERTBL_DESCR_1', $owl_lang->tables_descr);
        $xtpl->assign('USERTBL_DESCR_2', $owl_lang->tables_descre);
	//fPrintFormTextLine($owl_lang->tables_descr . ":" , "descr", 50);
	//fPrintFormTextLine($owl_lang->tables_descr2 . ":" , "descr2", 150);
	//print("<tr><td class=\"form2\" width=\"100%\" colspan=\"2\">\n");
        $xtpl->assign('BTN_ADD_LABEL', $owl_lang->tables_tupleAdd);
        $xtpl->assign('BTN_ADD_ALT', $owl_lang->tables_tupleAdd);
	//fPrintSubmitButton($owl_lang->tables_tupleAdd, $owl_lang->tables_tupleAdd);
        $xtpl->assign('BTN_RESET_LABEL', $owl_lang->btn_reset);
        $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);
	//fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");
	//print("</td></tr>\n");
}
function printEditTuple()
{
	global $sess, $owl_lang, $default, $userid, $table, $xtpl;
	$action = "updateTuple";
	$id = $_GET["id"];
	$sql = new Owl_DB;
	$sql->query("SELECT id, descr, descr2 FROM $table WHERE id=$id");
        $sql->next_record();
        $xtpl->assign('USERTBL_DESCR_1', $owl_lang->tables_descr);
        $xtpl->assign('USERTBL_DESCR_2', $owl_lang->tables_descre);
        $xtpl->assign('USERTBL_DESCR1_VALUE', $sql->f("descr"));
        $xtpl->assign('USERTBL_DESCR2_VALUE', $sql->f("descr2"));
	//fPrintFormTextLine($owl_lang->tables_descr . ":" , "descr", 50, $sql->f("descr"));
	//fPrintFormTextLine($owl_lang->tables_descr2 . ":" , "descr2", 150, $sql->f("descr2"));
	//print("<tr><td class=\"form2\" width=\"100%\" colspan=\"2\">\n");
	//fPrintSubmitButton($owl_lang->tables_tupleEdit, $owl_lang->tables_tupleEdit);
        $xtpl->assign('BTN_EDIT_LABEL', $owl_lang->tables_tupleEdit);
        $xtpl->assign('BTN_EDIT_ALT', $owl_lang->tables_tupleEdit);
	//fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");
        $xtpl->assign('BTN_RESET_LABEL', $owl_lang->btn_reset);
        $xtpl->assign('BTN_RESET_ALT', $owl_lang->alt_reset_form);
	//print("</td></tr>\n");
}
/*function printEditTable()
{
	table edit screen
}
function printAddTable()
{
	global $default, $sess, $owl_lang;

	fPrintFormTextLine($owl_lang->title . ":" , "name", 40);
	print("<tr>\n");
	print("<td class=\"form2\" width=\"100%\" colspan=\"2\">\n");
	fPrintSubmitButton($owl_lang->add, $owl_lang->alt_add_group);
	fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");
	print("</td>\n");
	print("</tr>\n");
}*/
if ($action)
{

   $xtpl->assign('FORM', '<form name="admin" enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '" method="post">');
   $urlArgs['sess']      = $sess;

	//print("<form name=\"admin\" action=\"userTables.php\" method=\"post\">\n");
	//print("<input type=\"hidden\" name=\"sess\" value=\"$sess\"></input>\n");
	//print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n");
	//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
	$usersgroup = false;
	if ($action == "viewTuple" or $action == "addTuple" or $action == "insertTuple" or $action == "editTuple" or $action == "updateTuple" or $action == "deleteTuple") 
	{
		printUserTables();
		switch ($action)
		{
			case "viewTuple":
				//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
                                $urlArgs['action']      = 'viewTuple';
				//fPrintSectionHeader($owl_lang->tables_tupleView);
                                $xtpl->assign('USERTBL_ACTION_TITLE', $owl_lang->tables_tupleView);
				printViewTuples();
                                $xtpl->parse('main.usertables.ViewTuples');
				break;
			case "addTuple":
				//print("<input type=\"hidden\" name=\"action\" value=\"insertTuple\"></input>");
                                $urlArgs['action']      = 'insertTuple';
                                $xtpl->assign('USERTBL_ACTION_TITLE', $owl_lang->tables_tupleAdd);
				//fPrintSectionHeader($owl_lang->tables_tupleAdd);
				printAddTuple();
                                $xtpl->parse('main.usertables.AddTuples');
				break;
			case "insertTuple":
				//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
                                $urlArgs['action']      = 'viewTuple';
				if (!empty($table))
				{
					$descr = $_POST["descr"];
					$descr2 = $_POST["descr2"];
					$sql->query("INSERT INTO $table (descr, descr2) VALUES('$descr', '$descr2')");
                                        $xtpl->assign('USERTBL_MSG', $owl_lang->tables_tupleAdded);
                                        $xtpl->parse('main.usertables.Msg');
					//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
					//print("<tr><td><br /></td></tr>\n");
					//print("<tr><td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleAdded</td></tr>\n");
					//print("<tr><td><br /></td></tr>\n");
					//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
					//fPrintSectionHeader($owl_lang->tables_tupleView);
					printViewTuples();
                                        $xtpl->parse('main.usertables.ViewTuples');
				}
				break;
			case "editTuple":
                                $urlArgs['action']      = 'updateTuple';
                                $urlArgs['id']      = $id;
				//print("<input type=\"hidden\" name=\"action\" value=\"updateTuple\"></input>");
				//print("<input type=\"hidden\" name=\"id\" value=\"$id\"></input>\n");
				//fPrintSectionHeader($owl_lang->tables_tupleEdit);
                                $xtpl->assign('USERTBL_ACTION_TITLE', $owl_lang->tables_tupleEdit);
				printEditTuple();
                                $xtpl->parse('main.usertables.EditTuples');
				break;
			case "updateTuple":
				//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
                                $urlArgs['action']      = 'viewTuple';
				if (!empty($table))
				{
					$id = $_POST["id"];
					$descr = $_POST["descr"];
					$descr2 = $_POST["descr2"];
					$sql->query("UPDATE $table SET descr='$descr', descr2='$descr2' WHERE id='$id'");
					if (empty($_GET["id"]))
					{
                                           $xtpl->assign('USERTBL_MSG', $owl_lang->tables_tupleEdited);
                                           $xtpl->parse('main.usertables.Msg');
						//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr /><tr>\n");
						//print("<td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleEdited</td></tr>\n");
						//print("<tr><td><br /></td></tr>\n");
						//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
						//fPrintSectionHeader($owl_lang->tables_tupleView);
						printViewTuples();
                                                $xtpl->parse('main.usertables.ViewTuples');
					}
				}
				break;
			case "deleteTuple":
                                $urlArgs['id']      = $id;
                                $xtpl->assign('USERTBL_ACTION_TITLE', $owl_lang->tables_tupleView);
				//print("<input type=\"hidden\" name=\"id\" value=\"$id\"></input>\n");
				$id = $_GET["id"];
				$sql->query("DELETE FROM $table WHERE id='$id'");
				//print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
                                $xtpl->assign('USERTBL_MSG', $owl_lang->tables_tupleDeleted);
				//print("<tr><td><br /></td></tr>\n");
				//print("<tr><td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleDeleted</td></tr>\n");
				//print("<tr><td><br /></td></tr>\n");
				//print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
                                $xtpl->assign('USERTBL_ACTION_TITLE', $owl_lang->tables_tupleView);
				//fPrintSectionHeader($owl_lang->tables_tupleView);
                                $xtpl->parse('main.usertables.Msg');
				printViewTuples();
                                $xtpl->parse('main.usertables.ViewTuples');
				break;
			/*case "addTable":
				fPrintSectionHeader($owl_lang->tables_tableAdd);
				printAddTable();
				break;
			case "editTable":
				print("<input type=\"hidden\" name=\"id\" value=\"$id\"></input>\n");
				fPrintSectionHeader($owl_lang->enter_new_user);
				printEditTable(); 
				break;*/
		}
	}
	//print('<script type="text/javascript">');
	//print('document.admin.name.focus();');
	//print('</script> ');
} 
else
{
	exit("$owl_lang->err_general");
} 
//print("</table>\n");
//print("</td></tr></table>\n");
//print("</form>\n");
//fPrintButtonSpace(12, 1);
if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
	//fPrintPrefs("infobar2");
}
//print("</td></tr></table>\n");
//include($default->owl_fs_root . "/lib/footer.inc");
fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.usertables');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
