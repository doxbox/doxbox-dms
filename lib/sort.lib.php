<?php
/*
 * file: sort.lib.php
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

if (!isset($order))
{
   $order = $default->default_sort_column;
}
if (!isset($sortname))
{
   $sortname = $default->default_sort_order;
}
else 
{
   $sortname = strtoupper($sortname);
   if ($sortname != 'ASC' and $storname != 'DESC')
   {
      $sortname = $default->default_sort_order;
   }
}

if (!isset($sortver) or strlen($sortver) > 24)
{
   $sortver = "ASC, minor_revision ASC";
}

if (!isset($sortcheckedout) or strlen($sortcheckedout) > 4)
{
   $sortcheckedout = $default->default_sort_order;
}
if (!isset($sortfilename) or strlen($sortfilename) > 4)
{
   $sortfilename = $default->default_sort_order;
}
if (!isset($sortsize) or strlen($sortsize) > 4)
{
   $sortsize = $default->default_sort_order;
}
if (!isset($sortposted) or strlen($sortposted) > 4)
{
   $sortposted = $default->default_sort_order;
}
if (!isset($sortupdator) or strlen($sortupdator) > 4)
{
   $sortupdator = $default->default_sort_order;
}
if (!isset($sortmod) or strlen($sortmod) > 4)
{
   $sortmod = $default->default_sort_order;
}
if (!isset($sort) or strlen($sort) > 4)
{
   $sort = $default->default_sort_order;
}
if (!isset($sortid))
{
   $sortid = $default->default_sort_order;
}

switch ($order)
{
   case "id":
      $sortorder = 'id';
      $sort = $sortid;
      break;
   case "name":
      $sortorder = 'sortname';
      $sort = $sortname;
      break;
   case "major_minor_revision":
      $sortorder = 'sortver';
      $sort = $sortver;
      break;
   case "filename" :
      $sortorder = 'sortfilename';
      $sort = $sortfilename;
      break;
   case "f_size" :
      $sortorder = 'sortsize';
      $sort = $sortsize;
      break;
   case "updatorid" :
      $sortorder = 'sortupdator';
      $sort = $sortupdator;
      break;
   case "creatorid" :
      $sortorder = 'sortposted';
      $sort = $sortposted;
      break;
   case "smodified" :
      $sortorder = 'sortmod';
      $sort = $sortmod;
      break;
   case "checked_out":
      $sortorder = 'sortcheckedout';
      $sort = $sortcheckedout;
      break;
   default:
      $order= "name";
      $sortorder= "sortname";
      $sort = "ASC";
      break;
}
?>
