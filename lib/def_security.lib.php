<?php

/*
 * def_security.lib.php
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
//
// This function is simple...it returns either a 1 or 0
// If the authentication is good, it returns 1
// If the authentication is bad, it returns 0
//
// Policy key for FILES:
//
// 0 = World read
// 1 = World edit
// 6 = World edit no delete
// 2 = Group read
// 3 = Group edit
// 5 = Group edit no delete
// 4 = Creator edit
// 7 = Group edit, World read 
// 8 = Group edit, World read - no delete 
//
// Policy key for FOLDERS:
//
// 50 = Anyone can read
// 51 = Anyone can upload/create folders
// 56 = Anyone can upload/create folders but not delete
// 52 = Only the group can read
// 53 = Only the group can upload/create folders
// 55 = Only the group can upload/create folders but not delete; except the creator 
// 54 = Only the creator can upload/create folders
// 57 = Only the group can upload/create folders but anyone can read 
// 58 = Only the group can upload/create folders (no delete) but anyone can read 
// 59 = anyone can upload files to this Folder
//

function check_auth($id, $action, $checkuserid, $report = false, $recursive = true) {
	global $default;
	global $owl_lang;
        global $usergroupid, $userid;

   	if ($userid == $checkuserid)
   	{
      		$usergroup = $usergroupid;
   	}
   	else
   	{
      		$usergroup = owlusergroup($checkuserid);
        }

        switch ($action)
        {
           case "folder_cp":
              $action = "folder_move";
              break;
           case "folder_monitor":
              $action = "folder_view";
              break;
           case "folder_acl":
              $action = "folder_modify";
              break;
           case "file_acl":
           case "file_copy":
              $action = "file_modify";
              break;
        }

        static $dbOwlQueries;
        if(empty($dbOwlQueries))
        { 
           $dbOwlQueries=new Owl_DB;
        }
  
	//$filecreator = owlfilecreator($id);
	//$filegroup = owlfilegroup($id);
	//$foldercreator = owlfoldercreator($id);
	//$foldergroup = owlfoldergroup($id);

		//print "Action is $action<br>";
		//print "ID is $id<br>";
		//print "filecreation username is $filecreator<br>";
  		//print "filecreation groupname is $filegroup<br>";
	 	//print "folder group is $foldergroup<br>";
		//print "userid is $userid<br>";
		//print "dbusername is $dbuser<br>";
		//print "usergroup is $usergroup<br>";

	if (($action == "folder_modify") || 
            ($action == "folder_view")   || 
            ($action == "folder_delete") ||
            ($action == "folder_move") ||
            ($action == "folder_upload") ||
            ($action == "folder_property")) {
		$foldercreator = owlfoldercreator($id);
		$foldergroup = owlfoldergroup($id);
		$policy = getfolderpolicy($id);
	} else {
		$filecreator = owlfilecreator($id);
		$filegroup = owlfilegroup($id);
		$policy = getfilepolicy($id);
	}
	//print "Policy is $policy -- $id<br>";
	if(!isset($policy)) {
                        if ($default->debug == true)
 	   			print("<br /> $owl_lang->err_general <br />ID: ".  htmlentities($id) . " File or Folder probably doesn't exist");
                        else
 	   			print("<br /> $owl_lang->err_general <br />");
			exit();
	}

  switch($policy)
  {
    case "0" : {
		if (($action == "file_delete") || ($action == "file_modify")) {
			if ($checkuserid != $filecreator) {
				$authorization = "0";
			} else {
				$authorization = "1";
			}
		} else {
			$authorization = "1";
		}	

		if ($action == "file_all") {
			if ($checkuserid != $filecreator) {
				$authorization = array("file_delete" => 0, "file_modify" => 0, "file_download" => 1);
			} else {
				$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1);
			}
		}
	}
  break;
  case "1": {
		$authorization = "1";
		if ($action == "file_all") {
			$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1);
		}
	}
  break;
  case "2" : {
		if (($action == "file_delete") || ($action == "file_modify")) {
			if ($checkuserid != $filecreator) {
                                $authorization = "0";
                        } else {
                                $authorization = "1";
			}
		} else {
                        // Bozz Change Begin
                 	$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
			if ($filegroup == $usergroup || $dbOwlQueries->num_rows($dbOwlQueries) > 0) {
                        // Bozz Change End
				$authorization = "1";
			} else {
				$authorization = "0";
			}
		}
		if ($action == "file_all") {
			if ($checkuserid != $filecreator) {
				$authorization = array("file_delete" => 0, "file_modify" => 0);
			} else {
				$authorization = array("file_delete" => 1, "file_modify" => 1);
			}
			// Bozz Change Begin
                        $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
                        if ($filegroup == $usergroup || $dbOwlQueries->num_rows($dbOwlQueries) > 0) {
                        // Bozz Change End
				$authorization["file_download"] = 1;
                        } else {
				$authorization["file_download"] = 0;
                        }
		}

	}
  break;
  case "3" : {
		if (($action == "file_delete") || ($action == "file_modify") || ($action == "file_download") || ($action == "file_all")) {
                // Bozz Change Begin
                $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
                // Bozz Change End
			if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
				if ($action == "file_all") {
					$authorization = array("file_delete" => 0, "file_modify" => 0, "file_download" => 0);
				} else {
                                	$authorization = "0";
				}
                        } else {
				if ($action == "file_all") {
					$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1);
				} else {
                                	$authorization = "1";
				}
			}

		}
	}
  break;
  case "4" : {
		if ($filecreator == $checkuserid) {
			if ($action == "file_all") {
                             	$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1);
                   	} else {
				$authorization = "1";
			}
		} else {
			if ($action == "file_all") {
                             	$authorization = array("file_delete" => 0, "file_modify" => 0, "file_download" => 0);
                   	} else {
				$authorization = "0";
			}
		}
	}
  break;
  case "5": {
		if (($action == "file_modify") || ($action == "file_download")) {
                	// Bozz Change Begin
                	$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
                	// Bozz Change End
				if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
                                	$authorization = "0";
                        	} else {
                                	$authorization = "1";
				}
                }
              	if ($action == "file_delete") {
                      if ($filecreator == $checkuserid) {
                           $authorization = "1";
                      } else {
                           $authorization = "0";
                      }
               	}

		if ($action == "file_all") {
                	// Bozz Change Begin
                	$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
                	// Bozz Change End
			if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
				$authorization = array("file_delete" => 0, "file_modify" => 0, "file_download" => 0);
                        } else {
				$authorization = array("file_delete" => 0, "file_modify" => 1, "file_download" => 1);
			}
		  	if ($filecreator == $checkuserid) {
				$authorization["file_delete"] = 1;
  			}
		}
		
	}
  break;
  case "6" : {
		$authorization = "1";
                 if ($action == "file_delete")  {
                      if ($filecreator == $checkuserid) {
                           $authorization = "1";
                      } else {
                           $authorization = "0";
                      }
                 }
		if ($action == "file_all") {
                      	if ($filecreator == $checkuserid) {
				$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1, "file_modify" => 1);
			} else {
				$authorization = array("file_delete" => 0, "file_modify" => 1, "file_download" => 1, "file_modify" => 1);
			}	
		}
	}
  break;
  case "7" : {
		if (($action == "file_delete") || ($action == "file_modify")) { 
			$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'"); 
			if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) { 
				$authorization = "0"; 
			} else { 
				$authorization = "1"; 
			} 

		} 
		if ($action == "file_download") { 
			$authorization = "1"; 
		} 

		if ($action == "file_all") {
			$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'"); 
			if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) { 
				$authorization = array("file_delete" => 0, "file_modify" => 0, "file_download" => 1);
			} else { 
				$authorization = array("file_delete" => 1, "file_modify" => 1, "file_download" => 1);
			} 
		}
	} 
  break;
  case "8" : {
		if ($action == "file_modify") { 
			$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'"); 
			if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) { 
				$authorization = "0"; 
			} else { 
				$authorization = "1"; 
			} 
		} 
		if ($action == "file_download") { 
			$authorization = "1"; 
		} 
		if ($action == "file_delete") { 
			if ($filecreator == $checkuserid) { 
				$authorization = "1"; 
			} else { 
				$authorization = "0"; 
			} 
		} 
		if ($action == "file_all") {
                        $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$filegroup'");
                        if ($usergroup != $filegroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
				$authorization = array("file_modify" => 0, "file_download" => 1);
                        } else { 
				$authorization = array("file_modify" => 1, "file_download" => 1);
                        }
			if ($filecreator == $checkuserid) {
				$authorization["file_delete"] = 1;
                        } else {
				$authorization["file_delete"] = 0;
                        }
		}
	}
  break;

  case "50" : {
		if (($action == "folder_delete")   || 
                    ($action == "folder_property") ||
                    ($action == "folder_move") ||
                    ($action == "folder_upload") ||
                    ($action == "folder_modify")) {
			if ($checkuserid != $foldercreator) {
				$authorization = "0";
			} else {
				$authorization = "1";
			}
		} else {
			$authorization = "1";
		}
	}
  break;
  
	case "51" : {
		$authorization = "1";
	}
  break;
  case "52" : {
		if (($action == "folder_delete")   || 
                    ($action == "folder_property") ||
                    ($action == "folder_upload") ||
                    ($action == "folder_move") ||
                    ($action == "folder_modify")) {
			if ($checkuserid != $foldercreator) {
                                $authorization = "0";
                        } else {
                                $authorization = "1";
			}
		} else {
                // Bozz Change Begin
                $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$foldergroup'");
			if ($foldergroup == $usergroup || $dbOwlQueries->num_rows($dbOwlQueries) > 0) {
                // Bozz Change End
				$authorization = "1";
			} else {
				$authorization = "0";
			}
		}
    }
    break;

    case "53" : {
		if (($action == "folder_delete") || 
                    ($action == "folder_modify") || 
                    ($action == "folder_move") ||
                    ($action == "folder_property") || 
                    ($action == "folder_view")) {
                // Bozz Change Begin
                $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$foldergroup'");
			if ($usergroup != $foldergroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
                // Bozz Change End
                                $authorization = "0";
                        } else {
                                $authorization = "1";
			}
		}
	}
  break;
  case "54" : {
		if ($foldercreator == $checkuserid) {
			$authorization = "1";
		} else {
			$authorization = "0";
		}
	}
  break;
  case "55" : {
		if (($action == "folder_modify") || 
                    ($action == "folder_move") ||
                    ($action == "folder_view") || 
                    ($action == "folder_upload")) {
		//if (($action == "folder_view")) {  <-- this is before bug "972060 Permission problem"
                // not sure why the check for folder_modify was changed this way lets wait and see
                // Bozz Change Begin
                $dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$foldergroup'");
			if ($usergroup != $foldergroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) {
                // Bozz Change End
                                $authorization = "0";
                        } else {
                                $authorization = "1";
			}
		}
                if (($action == "folder_delete")  ||
                    ($action == "folder_move") ||
                    ($action == "folder_property")) {
                   if ($foldercreator == $checkuserid) {
                           $authorization = "1";
                   } else {
                           $authorization = "0";
                   }
               }
        }
  break;
  case "56" : {
		$authorization = "1";
                if (($action == "folder_delete")  || ($action == "folder_modify")  ||
                    ($action == "folder_move") ||
                    ($action == "folder_property")) {
                   if ($foldercreator == $checkuserid) {
                           $authorization = "1";
                   } else {
                      if ($action == "folder_upload") 
                      {
                           $authorization = "1";
                      }
                      else
                      {
                           $authorization = "0";
                      }
                   }
               }
	}
  break;
  
	case "57" : {
		if (($action == "folder_modify") || 
                    ($action == "folder_move") ||
                    ($action == "folder_delete")) { 
				$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$foldergroup'"); 
				if (($usergroup != $foldergroup) && ($dbOwlQueries->num_rows($dbOwlQueries) == 0)) { 
						$authorization = "0"; 
				} else { 
						$authorization = "1"; 
				} 
		} 
		if ($action == "folder_property") { 
				if ($foldercreator == $checkuserid) { 
						$authorization = "1"; 
				} else { 
						$authorization = "0"; 
				} 
		} 
		if ($action == "folder_view") { 
				$authorization = "1"; 
		} 
	} 
  break;
  case "58" : {
		if (($action == "folder_modify") ||
                    ($action == "folder_move"))
                 { 
			$dbOwlQueries->query("SELECT * FROM $default->owl_users_grpmem_table WHERE userid = '$checkuserid' and groupid = '$foldergroup'"); 
			if ($usergroup != $foldergroup && $dbOwlQueries->num_rows($dbOwlQueries) == 0) { 
				$authorization = "0"; 
			} else { 
				$authorization = "1"; 
			} 
		} 
		if ($action == "folder_property") { 
			if ($foldercreator == $checkuserid) { 
				$authorization = "1"; 
			} else { 
				$authorization = "0"; 
			} 
		} 
		if (($action == "folder_delete") ||
                    ($action == "folder_move")) { 
			if ($foldercreator == $checkuserid) { 
				$authorization = "1"; 
			} else { 
				$authorization = "0"; 
			} 
		} 
		if ($action == "folder_view") { 
			$authorization = "1"; 
		} 
	} 
  break;
 } //endswitch
// Bozz Change Begin
// I Think that the Admin Group should 
// have the same rights as the admin user
// if the user is in the file Admin group (SUPERUSER) then return 1 for authorization
	//if ($userid == 1 || $usergroup == 0 || $usergroup == $default->file_admin_group ) {
	if (fIsAdmin()) {
// Bozz Change End
                if( !$report )
                {
		   $authorization = "1";
                }
	}
// cv change bug #504298
// this call must be recursive through the parent directories

	// continue recursion?
	if( $authorization == 1 and $recurse) {
		if( ($policy > 49) && ($id == 1) ) {
			// stop if we are at the doc root
			return $authorization;
		} else {
			// continue;
			if($policy < 50) {
				$parent = owlfileparent($id);
			} else 
                        {
				$parent = owlfolderparent($id);
			}
			return check_auth($parent, "folder_view", $checkuserid);
		}
	} else {
		// dont continue because authorization is 0
		return $authorization;
	}
}
?>
