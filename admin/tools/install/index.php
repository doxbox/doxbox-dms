<?php
/**
 * index.php 
 * 
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2005-2006 The Owl Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 * 
 */

require_once(dirname(__FILE__)."/../config/owl.php");
require_once(dirname(__FILE__)."/lib/common.lib.php");
require_once(dirname(__FILE__)."/../lib/disp.lib.php");

if (empty($_POST["next_step"]))
{
   $next_step = "1";
}
else
{
   $next_step = $_POST["next_step"];
}

if (!empty($_POST["prev"]))
{
  $next_step = $next_step - 2 ;
}

if (!empty($_POST["refresh"]))
{
  $next_step = $_POST["current_step"];
}

$install->owl_lang =  fGetBrowserLanguage();

require_once(dirname(__FILE__)."/locale/$install->owl_lang/language.inc");

include_once($default->owl_fs_root . "/install/lib/header.inc");

?>
  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="15">&nbsp;</td>
    <td valign="top" width="180" nowrap="nowrap">

      <?php fPrintMenu($next_step); ?>


    </td>
    <td width="15" style="border-right: 2px solid #dedede">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td valign="top" width="600">
<br />
      <span class="middle_text">
      <p>
      <form action="index.php" method="post">
<?php

if ($next_step > count($install->menu_steps))
{
?>
        INSTALLATION Completed!
        Link to Owl here?
<?php
}
else
{
   $previous_step = $next_step - 1;
   include_once("step" . $next_step . ".php");
   $next_step++; 
?>
        <input type="hidden" name="prev_step" value="<?php echo $previous_step; ?>"></input>
        <input type="hidden" name="next_step" value="<?php echo $next_step; ?>"></input>
<?php
if ($next_step == "2")
{
?>
          <input class="xbutton2" type="submit" name="next" value="Continue"></input>
<?php
}
else
{
?>
          <input class="xbutton2" type="submit" name="prev" value="<< Back"></input>
          <input class="xbutton2" type="submit" name="next" value="Next >>"></input>
  
<?php
}
?>
        </form>
<?php
}
?>
      </p>
      </span>
      
    </td>
  </tr>
  </table>
      
  </td>
<?php
include_once($default->owl_fs_root . "/install/lib/footer.inc");
?>
