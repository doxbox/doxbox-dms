<?php
/*
 * File: footer.inc
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

if(!isset($sortname)) 
{
   $sortname = "ASC";
}

print("<!-- BEGIN: Footer -->\n");
print("<a name=\"bottom\"></a>\n");

if ($_SERVER["PHP_SELF"] != $default->owl_root_url . "/index.php")
{
   print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   print("<tr>\n");
   if ($default->debug == true)
   {
      print("<td class=\"owlbar1\" align=\"right\"><a class=\"lbutton1\" href=\"http://validator.w3.org/check?uri=referer\">$owl_lang->engine $default->version</a></td>\n");
   }
   else
   {
      print("<td class=\"owlbar1\" align=\"right\">$owl_lang->engine $default->version</td>\n");
   }
   print("</tr>\n");
   print("</table>\n");
}
else
{
   print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
   print("<tr>\n<td class=\"owlbar1\" align=\"right\">&nbsp;</td>\n</tr>\n");
   print("</table>\n");
}

include_once($default->owl_fs_root . "/lib/userfooter.inc");

print("<!-- END: Footer -->\n");

	print("</td></tr></table></center>");
if (("browse.php" == basename($_SERVER["PHP_SELF"]) or "showrecords.php" == basename($_SERVER["PHP_SELF"])) and !$default->old_action_icons)
{
?>
<div id="trailimageid" style="position:absolute;visibility:visible;left:0px;top:0px;width:1px;height:1px;z-index:50;"></div>
<script type="text/javascript">
<!--
document.onmousemove=followmouse
// -->
</script>
<?php
}
?>
</body>
</html>
