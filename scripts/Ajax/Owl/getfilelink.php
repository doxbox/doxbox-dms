<?php

/**
 * getfilelink.php
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

require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

if (isset($sess) and (!$sess == 0))
{
   // ONLY UPDATE 
   $sql->query("SELECT * FROM $default->owl_files_table where id = '$fileid'");
   $sql->next_record();
// IF $default->generate_notify_link_session  = 1
// We should probably generate a session?
// What session should we genereate here?
//
   print ($default->owl_notify_link . "browse.php?sess=0&parent=" . $sql->f("parent") . "&expand=1&fileid=" . $sql->f("id"));
   print ("<br />" . $default->owl_notify_link . "download.php?sess=0&parent=" . $sql->f("parent") . "&expand=1&dlfileid=" . $sql->f("id"));
}
?>
