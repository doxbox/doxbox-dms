<?php
/**
 * ewsc.lib.php -- External Web Services Calls
 * 
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2010-2011 Bozz IT Consulting Inc
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

/**************************************************************
@desc , this function kis used to get 
@param username, string, moodle username   
@return bool ,if true - can access, false - cannot access
-> IF new user, then create with predefined rights
roles:
user: -> defined directory and below to read
teacher: -> edit there from the directory
**************************************************************/
function get_token($username,$md5)
{
}



/**************************************************************
@This function will read directory and return listing of this directory (files and folders) 
@param  token, string , secret token . 
@param username, string ,moodle username 
@param rootfolder , root directory to be returned  
@return array of user folders and files

note: returned list should contain the full file info (size, name, type,permissions,owner …. ) and also type (file or folder)
**************************************************************/
function get_user_directory_listing($token ,$rootfolder, $username )
{
}

/**************************************************************
@Get file permissions and return array with permission data
@param  token, string, secret token . 
@param fullfilename, string, file name   
@return array of permisions
**************************************************************/
function get_file_permissions($token , $fullfilename)
{
}

/**************************************************************
@Get OWL file information data
@param  token, string, secret token . 
@param fullfilename, string, file name   
@return array of MOWL file info
**************************************************************/
function get_file_info($token , $fullfilename)
{
}

/**************************************************************
@The same as for file but for folder
@param  token, string, secret token . 
@param folder, string, folder   
@return array of permisions
**************************************************************/
function get_folder_permissions($token , $folder)
{
}


/**************************************************************
@Set folder permissions, will get same data structure that returned by get_folder_permissions
@function
@param  token, string, secret token . 
@param folder, string, folder  
@param permisions, string,  new permisions 
@return bool 
**************************************************************/
function set_folder_permissions($token , $folder, $permisions)
{
}


/**************************************************************
@Same as for set_folder_permissions but for file
@param  token, string, secret token . 
@param file, string, file name   
@param permisions, string,  new permisions 
@return bool
**************************************************************/
function set_file_permissions($token , $fullfilename, $permisions)
{
}

/**************************************************************
@Deleting some file in user directory
@param  token, string, secret token . 
@param fullfilename, string, file name   
@return bool
**************************************************************/
function delete_file ($token , $fullfilename)
{
}

/**************************************************************
@Deleting some folder in user directory
@param  token, string, secret token . 
@param folder, string, file name   
@return bool
**************************************************************/
function delete_folder($token , $folder)
{
}

/**************************************************************
@Creating some folder in user directory
@param  token, string, secret token . 
@param parentfolder, string, parent folder
@param foldername, string, name of new folder
@return bool
**************************************************************/
function create_folder($token , $parentfolder, $foldername)
{
}


/**************************************************************
@Creating some file in user directory
@param  token, string, secret token . 
@param parentfolder, string, parent folder
@param filename, string, name of new file
@return bool
**************************************************************/
function create_file ($token, $parentfolder, $filename)
{
}

/**************************************************************
@Same functionality like shell copy function
@param  token, string, secret token . 
@param from string, from file
@param to, string, destination folder
@return bool
**************************************************************/
function copy_file($token, $from, $to)
{
}
/**************************************************************
@Same functionality like shell copy function
@param  token, string, secret token . 
@param from string, from folder 
@param to, string, destination folder
@return bool
**************************************************************/
function copy_folder($token, $from, $to)
{
}

/**************************************************************
@Changing name of folder
@param  token, string, secret token . 
@param oldname, string, old name
@param newname, string, new name
@return bool
**************************************************************/
function rename_folder ($token, $oldname, $newname)
{
}

/**************************************************************
@Changing name of file
@param  token, string, secret token . 
@param oldname, string, old name
@param newname, string, new name 
@return bool
**************************************************************/
function rename_file ($token, $oldname, $newname)
{
}
