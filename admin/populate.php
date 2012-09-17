<?php

/**
 * populate.php
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

global $default;

require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");
require_once($default->owl_fs_root . "/lib/security.lib.php");

$clean = ob_get_contents();
ob_end_clean();

if (!fIsAdmin(true)) 
{
      header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
    exit;
}

global $index_file;
$index_file = "1";

fInsertUnzipedFiles($default->owl_FileDir . DIR_SEP . fid_to_name(1) , 1, $default->owl_def_fold_security, $default->owl_def_file_security, "", $default->owl_def_file_group_owner, $default->owl_def_file_owner, $default->owl_def_file_meta, "", 1, 0, 1, $default->use_fs_false_remove_files_on_load);

header("Location: " . "index.php?sess=$sess");
?>
