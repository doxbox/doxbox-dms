#!/usr/bin/php
<?php
/**
 * This script generates an API Key for use by the API client
 * from the API directory
 * ./genapikey.php  <IP ADDRESS>
 * OR
 * php -f genapikye.php <IP ADDRESS>
 * IP ADDRESS = the IP Address of the Remote Server that is 
 *              attempting to use this API
 * The Result needs to be added to config/api.config.php file
 */

if (php_sapi_name() <> 'cli')
{
   die("Script Needs to be Run From Command Exiting");
}

if ($argc == 2)
{
   $aIniFile = parse_ini_file("./config/api.config.php");

   $sAPIKey = sha1($aIniFile['keysalt'].sha1($argv[1].$aIniFile['keysalt']));

   /**
    * Lets Echo the key for now.
    * Future could just append to the config file directly
    */
   echo $sAPIKey . "\n";
}
else
{
   echo "\nUsage:  genapikey.php <IP ADDRESS>\n\n";
}
