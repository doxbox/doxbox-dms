<?php

 if ($_POST["display_name"])
 {
     $display_name = $_POST["display_name"];
 }
 else
 {
     $display_name = $default->owl_db_display_name[0];
 }
 if ($_POST["db_name"])
 {
     $db_name = $_POST["db_name"];
 }
 else
 {
     $db_name = $default->owl_db_name[0];
 }
 if ($_POST["db_host"])
 {
     $db_host = $_POST["db_host"];
 }
 else
 {
     $db_host = $default->owl_db_host[0];
 }

 if ($_POST["db_user"])
 {
     $db_user = $_POST["db_user"];
 }
 else
 {
     $db_user = $default->owl_db_user[0];
 }

 if ($_POST["db_pass"])
 {
     $db_pass = $_POST["db_pass"];
 }
 else
 {
     $db_pass = $default->owl_db_pass[0];
 }

 if ($_POST["table_prefix"])
 {
     $table_prefix = $_POST["table_prefix"];
 }
 else
 {
     $table_prefix = $default->owl_table_prefix;
 }

 print("<table class=\"margin2\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"top\">\n");
 fPrintSectionHeader("Mysql Configuration", "admin3");
 print("</tr></td></table>\n");
 print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
 fPrintFormTextLine("Database Display Name:" , "display_name", 40, $display_name);
 fPrintFormTextLine("Table Name prefix:" , "table_prefix", 40, $table_prefix);
 fPrintFormTextLine("Database Name:" , "db_name", 30, $db_name);
 fPrintFormTextLine("Database Host:" , "db_host", 45, $db_host);
 fPrintFormTextLine("Database User:" , "db_user", 20, $db_user);
 fPrintFormTextLine("Database Password:" , "db_pass", 20, $db_pass);
 print("</table>");


   $dblink = @mysql_connect($db_host,$db_user,$db_pass);
   if (!$dblink) 
   {
      $sDb_Connectivity = "<font color=\"red\" size=\"2\"><b>[ FAILED ]</b></font>";
      $sDb_Exists = "<font color=\"red\" size=\"2\"><b>[ ?? ]</b></font>";
   }
   else
   {
      $sDb_Connectivity = "<font color=\"green\" size=\"2\"><b>[ OK ]</b></font>";

      $db_selected = @mysql_select_db($db_name);
      if ($db_selected) 
      {
         
         $bSkipDBCreate = false;
         $bSkipDBUpgrade = false;
         $sDb_Exists = "<font color=\"orange\" size=\"2\"><b>[ EXISTS";
     
         if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . $table_prefix . "advanced_acl'"))==1) 
         {
            $sDb_Exists .= " 0.9x Detected";
            $bSkipDBCreate = true;
            $next_step++;
         }
         else if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . $table_prefix . "peerreview'"))==1) 
         {
            $bSkipDBUpgrade = true;
            $sDb_Exists .= " 0.8x Detected";
         }
         else if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . $table_prefix . "'"))==0) 
         {
            $sDb_Exists = "<font color=\"green\" size=\"2\"><b>[ OK";
         }
         $sDb_Exists .= " ]</b></font>";
      }
      else
      {
         $sDb_Exists = "<font color=\"green\" size=\"2\"><b>[ WILL CREATE NEW DB ]</b></font>";
      }
   }
   //$sQuery = "SELECT * FROM folders WHERE business_area IS NOT NULL AND business_area <> '' and project_type = 'Green Belt Lean Sigma'";
   //$rReadResult = mysql_query($sQuery);

?>
<p>
The above configuration was detected in the current owl.php file
</p>
<?php
 print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
 fPrintFormTextLine("Database Connectivity:" , "db_connect", 40, $sDb_Connectivity, "", true);
 fPrintFormTextLine("Database:" , "db_exists", 40, $sDb_Exists, "", true);
 //fPrintFormTextLine("Database Name:" , "db_name", 30, $default->owl_db_name[0]);
 //fPrintFormTextLine("Database Host:" , "db_host", 45, $default->owl_db_host[0]);
 //fPrintFormTextLine("Database User:" , "db_user", 20, $default->owl_db_user[0]);
 //fPrintFormTextLine("Database Password:" , "db_pass", 20, $default->owl_db_pass[0]);
 print("</table>");
 print("<br />");

if ($bSkipDBCreate === true)
{
   $current_step = $next_step - 1;
   print("<p>\n");
   print("The database already exists, and is of the correct version, the Database Creation will be skipped!");
   print("</p>\n");
}
else
{
   $current_step = $next_step;
}

if ($bSkipDBUpgrade === true)
{
   print("<p>\n");
   print("The database already exists as Owl version 0.8x, the Database will be upgraded to version Owl 0.91");
   print("</p>\n");
}
?>
<br />
   <input type="hidden" name="current_step" value="<?php echo $current_step; ?>"></input>
 <input class="xbutton2" type="submit" name="refresh" value="Refresh"></input>
<br />
<br />
<br />
