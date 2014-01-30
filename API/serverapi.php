<?php
/**
 * serverapi.php -- API Server Program 
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

require_once('api.class.php');

/** 
 *  Doxbox & 3rd Party Include Section
 */

require_once('../config/owl.php');

require_once($default->owl_fs_root ."/lib/constants.php");
require_once($default->owl_fs_root ."/lib/owlsess.class.php");
require_once($default->owl_fs_root ."/lib/owldb.class.php");
require_once($default->owl_fs_root ."/lib/functions.lib.php");

require_once($default->owl_fs_root ."/lib/pclzip/pclzip.lib.php");
require_once($default->owl_fs_root ."/lib/indexing.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");
require_once($default->owl_fs_root ."/scripts/phpmailer/class.phpmailer.php");
require_once($default->owl_fs_root ."/locale/English/language.inc");

/**
* Get All Doxbox System Prefs 
* Using the Existing Doxbox Function
*/

getprefs();

/**
* Sample Extend 
* Most Function Have a PostFunction available 
* So If you need to do something special 
* After the file is deleted for example you can do it here
*/

class MyDmsAPI extends DmsAPI 
{
  public function PostDeleteFileProcessing()
   {
     //echo "DO MY POST DELETE PROCESSING HERE";
   }
}

/* Main API Sample Code */

try 
{
   /** Note:  Your Object / Class needs to be declared in the GLOBAL Variable space
    *         So it will be found by the supporting Doxbox functions
    */

   global $oDMS;

   $oDMS = new MyDmsAPI() ;

   $oDMS->SetResponseType('XML');

   if (method_exists($oDMS, $_POST['CallFunction']))
   {
      $aArgs = array();
      foreach ($_POST as $key => $value)
      {
         if ($key == 'Args' and is_array($value))
         {
            $aArgs = $value;
         }
      }
      call_user_func_array(array($oDMS, $_POST['CallFunction']), $aArgs);
   }
   else
   {
      $aError = array();
      $aError['code'] = FATAL_ERROR;
      $aError['msg'] = 'Method Doesn\'t Exists.';

      throw new Exception($oDMS->Response($aError));
    
   }
} 
catch (Exception $e) 
{
   print($e->getMessage());
}
