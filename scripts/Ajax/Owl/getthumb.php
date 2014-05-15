<?php

/**
 * getthumb.php
 * 
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2006-2014 Bozz IT Consulting Inc
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

   $sThumbLoc = $default->thumbnails_location . DIR_SEP . $default->owl_current_db . "_" . $fileid . "_" . $size . ".png";

   if (file_exists($sThumbLoc))
   {
      $imdata = file_get_contents($sThumbLoc);
      $sThumbUrl = 'data:image/png;base64,' . base64_encode($imdata);
      print $sThumbUrl;
  }
  else
  {
     print '&nbsp;';
  }
}
