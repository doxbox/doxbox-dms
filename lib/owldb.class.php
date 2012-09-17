<?php

/**
 * owldb.class.php
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

class Owl_DB extends DB_Sql
{
   var $classname = "Owl_DB"; 
   // BEGIN wes changes -- moved these settings to config/owl.php
   // Server where the database resides
   var $Host = ""; 
   // Database name
   var $Database = ""; 
   // User to access database
   var $User = ""; 
   // Password for database
   var $Password = "";

   function Owl_DB()
   {
      global $default;
      if(!isset($default->owl_current_db))
      {
         $db = $default->owl_default_db;
      }
      else
      {
         $db = $default->owl_current_db;
      }
      if (!isset($default->owl_db_host[$db]))
      { 
         $db = $default->owl_default_db;
      } 
      $db = (int) $db;
      $this->Host = $default->owl_db_host[$db];
      $this->Database = $default->owl_db_name[$db];
      $this->User = $default->owl_db_user[$db];
      $this->Password = $default->owl_db_pass[$db];

      //$this->Host = $default->owl_db_host[0];
      //$this->Database = $default->owl_db_name[0];
      //$this->User = $default->owl_db_user[0];
      //$this->Password = $default->owl_db_pass[0];
   } 
   // END wes changes
   function haltmsg($msg)
   {
      global $owl_lang;
      printf("</td></table><b>$owl_lang->err_database:</b> %s<br>\n", $msg);
      printf("<b>$owl_lang->err_sql</b>: %s (%s)<br>\n",
         $this->Errno, $this->Error);
   } 
} 

