<?php
/**
 * quickAdd.php
 *
 * Author: Filipe Lima (filipe.aclima@gmail.com)
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
 * $Id: quickAdd.php,v 1.01 2009/03/28 17:35:16 b0zz Exp $
 */

 
ob_start();
require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
$out = ob_get_clean();
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");

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
//if ($bGrantAccess === false)
//{
   //die("<br /><center>$owl_lang->err_unauthorized</center><br />");
//}
//if (fIsUserAdmin($userId) and $owluser == 1)
//{
   //printError($owl_lang->err_unauthorized);
//}

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/usertables.xtpl");
$xtpl = new XTemplate("html/admin/usertables.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);

include($default->owl_fs_root . "/lib/header.inc");
include($default->owl_fs_root . "/lib/userheader.inc");
print("<center>");
print("<br />\n");
function printUserTables()
{
	global $sess, $default, $owl_lang, $userid, $table;
	$sql = new Owl_DB;
	$sql->query("SELECT tableName, description FROM $default->userTables_dictionary ORDER BY description");
	fPrintSectionHeader("$owl_lang->tables_header");
	print("<tr>\n");
   print("<td class=\"form1\">$owl_lang->table:</td>\n");
   print("<td class=\"form1\" width=\"100%\">");
   print("<select class=\"fpull1\" name=\"table\" size=\"1\">\n");
	while ($sql->next_record())
	{
		print("\t\t\t\t\t\t\t\t<option value=\"" . $sql->f("tableName") . "\"");
		if ($sql->f("tableName") == $table)
		{
			 print(" selected=\"selected\"");
		}
		print(">" . $sql->f("description") . "</option>\n");
	}
   print("</select></td></tr>");
   print("<tr>");
   print("<td class=\"form1\">");
   fPrintButtonSpace(1, 1);
   print("</td>");
   print("<td class=\"form2\" width=\"100%\">");
   print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   print("\t<tr>\n");
	print("<td width=\"100%\">\n");
	fPrintSubmitButton($owl_lang->tables_tupleView, $owl_lang->tables_tupleView, "submit", "tables_tupleView");
	print("<td>");
	fPrintButton("quickAdd.php?sess=$sess&amp;action=addTuple&amp;table=$table", "tables_tupleAdd");
   print("</td>");
	/*print("<td>");
   fPrintButton("quickAdd.php?sess=$sess&amp;action=editTable", "tables_tableEdit");
   print("</td><td>");
   fPrintButton("quickAdd.php?sess=$sess&amp;action=addTable", "tables_tableAdd");
   print("</td>");*/
   print("\t</tr></table>\n");
   print("</td></tr>");
}
function printViewTuples()
{
	global $sess, $default, $owl_lang, $userid, $table;
	$sql = new Owl_DB;
	$sql->query("SELECT id, descr, descr2 FROM $table ORDER BY descr");
	print("<table width=\"100%\"><tr>\n");
	print("<td class=\"title1\">$owl_lang->tables_descr</td>\n");
   print("<td class=\"title1\">$owl_lang->tables_descr2</td>\n");
	print("<td class=\"title1\" colspan=\"2\">$owl_lang->tables_actions</td>\n");
   while ($sql->next_record())
	{
		$id = $sql->f("id");
		$descr = $sql->f("descr");
		$descr2 = $sql->f("descr2");
		print("<tr><td class=\"form1\">$descr</td>");
		print("<td class=\"form1\">$descr2</td>");
		print("<td class=\"form1\"><a href=\"quickAdd.php?sess=$sess&amp;action=editTuple&amp;table=$table&amp;id=$id\">$owl_lang->tables_tupleEdit</td>");
		print("<td class=\"form1\"><a href=\"quickAdd.php?sess=$sess&amp;action=deleteTuple&amp;table=$table&amp;id=$id\">$owl_lang->tables_tupleDelete</td>");
	}
}
function printAddTuple()
{
	global $sess, $owl_lang, $default, $userid, $table;
	fPrintFormTextLine($owl_lang->tables_descr . ":" , "descr", 50);
	fPrintFormTextLine($owl_lang->tables_descr2 . ":" , "descr2", 150);
	print("<tr><td class=\"form2\" width=\"100%\" colspan=\"2\">\n");
	fPrintSubmitButton($owl_lang->tables_tupleAdd, $owl_lang->tables_tupleAdd);
	fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");
	print("</td></tr>\n");
}
function printEditTuple()
{
	global $sess, $owl_lang, $default, $userid, $table;
	$action = "updateTuple";
	$id = $_GET["id"];
	$sql = new Owl_DB;
	$sql->query("SELECT id, descr, descr2 FROM $table WHERE id=$id");
	fPrintFormTextLine($owl_lang->tables_descr . ":" , "descr", 50, $sql->f("descr"));
	fPrintFormTextLine($owl_lang->tables_descr2 . ":" , "descr2", 150, $sql->f("descr2"));
	print("<tr><td class=\"form2\" width=\"100%\" colspan=\"2\">\n");
	fPrintSubmitButton($owl_lang->tables_tupleEdit, $owl_lang->tables_tupleEdit);
	fPrintSubmitButton($owl_lang->btn_reset, $owl_lang->alt_reset_form, "reset");
	print("</td></tr>\n");
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
?>
	<script type="text/javascript">
		function CheckAll()
		{
			for (var i = 0; i < document.admin.elements.length; i++)
			{
				if(document.admin.elements[i].type == "checkbox")
				{
					document.admin.elements[i].checked = !(document.admin.elements[i].checked);
				}
			}
		}
	</script>
<?php
	print("<form name=\"admin\" action=\"quickAdd.php\" method=\"post\">\n");
	print("<input type=\"hidden\" name=\"sess\" value=\"$sess\"></input>\n");
	print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n");
	print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
	$usersgroup = false;
	if ($action == "viewTuple" or $action == "addTuple" or $action == "insertTuple" or $action == "editTuple" or $action == "updateTuple" or $action == "deleteTuple") 
	{
		printUserTables();
		switch ($action)
		{
			case "viewTuple":
				print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
				fPrintSectionHeader($owl_lang->tables_tupleView);
				printViewTuples();
				break;
			case "addTuple":
				print("<input type=\"hidden\" name=\"action\" value=\"insertTuple\"></input>");
				fPrintSectionHeader($owl_lang->tables_tupleAdd);
				printAddTuple();
				break;
			case "insertTuple":
				print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
				if (!empty($table))
				{
					$descr = $_POST["descr"];
					$descr2 = $_POST["descr2"];
					$sql->query("INSERT INTO $table (descr, descr2) VALUES('$descr', '$descr2')");
					print("<table width=\"100%\">\n");
					print("<tr><td><br /></td></tr>\n");
					print("<tr><td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleAdded</td></tr>\n");
					print("<tr><td><br /></td></tr>\n");
					print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
					fPrintSectionHeader($owl_lang->tables_tupleView);
					printViewTuples();
				}
				break;
			case "editTuple":
				print("<input type=\"hidden\" name=\"action\" value=\"updateTuple\"></input>");
				print("<input type=\"hidden\" name=\"id\" value=\"$id\"></input>\n");
				fPrintSectionHeader($owl_lang->tables_tupleEdit);
				printEditTuple();
				break;
			case "updateTuple":
				print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
				if (!empty($table))
				{
					$id = $_POST["id"];
					$descr = $_POST["descr"];
					$descr2 = $_POST["descr2"];
					$sql->query("UPDATE $table SET descr='$descr', descr2='$descr2' WHERE id='$id'");
					if (empty($_GET["id"]))
					{
						print("<table width=\"100%\"><tr /><tr>\n");
						print("<td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleEdited</td></tr>\n");
						print("<tr><td><br /></td></tr>\n");
						print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
						fPrintSectionHeader($owl_lang->tables_tupleView);
						printViewTuples();
					}
				}
				break;
			case "deleteTuple":
				print("<input type=\"hidden\" name=\"id\" value=\"$id\"></input>\n");
				$id = $_GET["id"];
				$sql->query("DELETE FROM $table WHERE id='$id'");
				print("<table width=\"100%\">\n");
				print("<tr><td><br /></td></tr>\n");
				print("<tr><td class=\"form1\" width=\"100%\" colspan=\"3\">$owl_lang->tables_tupleDeleted</td></tr>\n");
				print("<tr><td><br /></td></tr>\n");
				print("<input type=\"hidden\" name=\"action\" value=\"viewTuple\"></input>");
				fPrintSectionHeader($owl_lang->tables_tupleView);
				printViewTuples();
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
	print('<script type="text/javascript">');
	print('document.admin.name.focus();');
	print('</script> ');
} 
else
{
	exit("$owl_lang->err_general");
} 
print("</table>\n");
print("</td></tr></table>\n");
print("</form>\n");
fPrintButtonSpace(12, 1);
if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
	fPrintPrefs("infobar2");
}
print("</td></tr></table>\n");
include($default->owl_fs_root . "/lib/footer.inc");
?>
