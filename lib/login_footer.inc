<?php
/*
 *  File: login_footer.inc
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

//if(!isset($sortname))
//{
   //$sortname = "ASC";
//}
//print("HERE");
//print($_SERVER["PHP_SELF"] . " != "  . $default->owl_root_url . "/index.php");
//if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/index.php")
//{
   //print("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n");
   if ($default->debug == false)
   {
$xtpl->assign('VERSION_URL', 'http://validator.w3.org/check?uri=referer');
$xtpl->assign('VERSION_LABEL', $owl_lang->engine . ", " . $owl_lang->version . " " . $default->version);
      //print("<tr><td class=\"version1\" width=\"100%\"><a class=\"version2\" href=\"http://validator.w3.org/check?uri=referer\">" . $owl_lang->engine . ", " . $owl_lang->version . " " . $default->version . "<br></a></td></tr>\n");
   }
   else
   {
$xtpl->assign('VERSION_URL', 'http://owl.anytimecomm.com');
$xtpl->assign('VERSION_LABEL', $owl_lang->engine . ", " . $owl_lang->version . " " . $default->version);
      //print("<tr><td class=\"version1\" width=\"100%\">" . $owl_lang->engine . ", " . $owl_lang->version . " " . $default->version . "<br /></td></tr>\n");
   }
   //print("</table>\n");
//}
?>
