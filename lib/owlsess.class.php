<?php

/**
 * owlsess.class.php
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

class Owl_Session
{
   var $sessid;
   var $sessuid;
   var $sessdata;

   function Open_Session($sessid = 0, $sessuid = 0)
   {
      global $default;
      global $rememberme;
      $this->sessid = $sessid;
      $this->sessuid = $sessuid;

      if ($sessid == "0") // if there is no user loged in, then create a session for them
      {

         $current = time();
         $random = $this->sessuid . $current;
         $this->sessid = md5($random);


         $OpenSess = new Owl_DB;

         $ip = fGetClientIP();

         if (!$default->active_session_ip)
         {
            $ip = 0;
         }

         if ($rememberme == 1)
         {
            $current = time() +60*60*24*$default->cookie_timeout; 
         }

         if (empty($_POST['currentdb']))
         {
            $iCurrentDB = "0";
         }
         else
         {
            if (!is_numeric($_POST[currentdb]))
            {
               $iCurrentDB = "0";
            }
            else
            {
               $iCurrentDB = $_POST[currentdb];
            }
         }


         // Clean up the Old sessions before a new one is created 
         // this is in case the user deleted his cookie, but the active session
         // is still in the sessions table
         if ($rememberme == 1 and $default->remember_me)
         {
            $OpenSess->query("DELETE FROM $default->owl_sessions_table  where usid = '$this->sessuid' and currentdb = '$iCurrentDB'");
         }

         $CheckSess = new Owl_DB;
         $CheckSess->query("SELECT * FROM $default->owl_sessions_table WHERE sessid = '$this->sessid' and usid = '$this->sessuid'"); 
         // any matching session ids?
         $numrows = $CheckSess->num_rows($CheckSess);
      if (!$numrows) 
      {
         
         $result = $OpenSess->query("INSERT INTO $default->owl_sessions_table  VALUES ('$this->sessid', '$this->sessuid', '$current', '$ip', '$iCurrentDB', '0','0')");
      

         if (!$result) 
         {
            die("$owl_lang->err_sess_write");
         }
      }


         if ($rememberme == 1 and $default->remember_me)
         {
            setcookie("owl_dbid", $iCurrentDB, time()+60*60*24*$default->cookie_timeout);
            setcookie ("owl_sessid", $this->sessid, time()+60*60*24*$default->cookie_timeout);
         }
      } 
      // else we have a session id, try to validate it...
      $CheckSess->query("SELECT * FROM $default->owl_sessions_table WHERE sessid = '$this->sessid'"); 
      // any matching session ids?
      $numrows = $CheckSess->num_rows($CheckSess);
      if (!$numrows) die("$owl_lang->err_sess_notvalid"); 
      // return if we are a.o.k.
      while ($CheckSess->next_record())
      {
         $this->sessdata["sessid"] = $CheckSess->f("sessid");
      } 
      return $this;
   } 
} 

