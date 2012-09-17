
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta   www.rgeleta.com
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>Users and Groups</h2>

<br />
<br />
<br />

<h3>Part 1 - User Administration</h3>
To change attributes of an existing user, click on the "Users" dropdown box 
to see a list of users in the system and to select a user to edit.
<br>To add a new users, click on the "New User" button.

<table>
<caption>User Specific Fields</caption>

<tr class="trTitles">
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>
<!-- 

<tr>
	<td class="tdItem">
	</td>

	<td class="tdDesc">
	</td>

    <td class="tdAction">
	</td>
</tr>
 -->

<tr class="trSubsection"><td colspan="3">Option Fields</td></tr>

<tr>
	<td class="tdItem">Full Name
	</td>

	<td class="tdDesc">Full Name for this user.
	</td>

    <td class="tdAction">Enter or change the name.
	</td>
</tr>

<tr>
	<td class="tdItem">Username
	</td>

	<td class="tdDesc">This is the name the user will log in with.
	</td>

    <td class="tdAction">Enter or change the username.
	</td>
</tr>

<tr>
	<td class="tdItem">Primary Group
	</td>

	<td class="tdDesc">This is the home group for this user.
	</td>

    <td class="tdAction">Select this user's home group.
	</td>
</tr>

<tr>
	<td class="tdItem">Language
	</td>

	<td class="tdDesc">This is the default language for this user.  
	<br>The user can change this once they are logged in.
	</td>

    <td class="tdAction">Select the default language for this user.
	</td>
</tr>

<tr>
	<td class="tdItem">Member Group(s)
	</td>

	<td class="tdDesc">These fields are the list of capabilities this user has for each group.
	<br>Each group is listed, along with two checkboxes.
	<br />The Membership checkbox indicates whether this user belongs to that group. 
	<br />(Groups may be used to assign permissions to view certain files or folders in the system.)
	<br />The File Admin checkbox indicates whether this user can do certain file administration functions.
	</td>

    <td class="tdAction">Check the appropriate boxes as desired.
	</td>
</tr>

<tr>
	<td class="tdItem">User's Home Directory
	</td>

	<td class="tdDesc">This is the directory that the user will go to when selecting the "Home" button in browse view.
	</td>

    <td class="tdAction">Select the user's home directory from the dropdown list.
	</td>
</tr>

<tr>
	<td class="tdItem">User's Initial Directory
	</td>

	<td class="tdDesc">This is the directory the user will be in immediately after logging in.
	</td>

    <td class="tdAction">Select the user's initial directory from the dropdown list.
	</td>
</tr>

<tr>
	<td class="tdItem">Button Style
	</td>

	<td class="tdDesc">This is the user's default template. 
	<br />The user can override this on their preferences screen after logging in.
	</td>

    <td class="tdAction">Select this user's default template from the dropdown list.
	</td>
</tr>

<tr>
	<td class="tdItem">Quota
	</td>

	<td class="tdDesc">This is the user's quota (in megabytes) for disk space storage.  
	If this is greater than zero, the size of any files uploaded by this user are added until the quota is reached  
	</td>

    <td class="tdAction">Enter this user's quota, or enter 0 if quotas are not to be enforced.
	</td>
</tr>

<tr>
	<td class="tdItem">Max No. Sessions
	</td>

	<td class="tdDesc">This is the maximum number of simultaneous sessions this user is allowed.
	</td>

    <td class="tdAction">Enter the maximum number of simultaneous sessions allowed for this user.
    <br />Click on the <img src="%THEME%/ui_icons/sessions_hover.png"> image to clear this user's session list.
	</td>
</tr>

<tr>
	<td class="tdItem">Password
	</td>

	<td class="tdDesc">The default password for this user.
	<br />The user can override this on their preferences screen after logging in.
	</td>

    <td class="tdAction">If this is a new user, enter their initial password.
    <br />If you are editing an existing user and do not want to change their password, leave this blank.
	</td>
</tr>

<tr>
	<td class="tdItem">Confirm new password
	</td>

	<td class="tdDesc">The area to re-enter a password if this is a new user, or if an existing user's password is being reset.
	</td>

    <td class="tdAction">Re-enter the password entered above, or leave blank if none was entered.
	</td>
</tr>

<tr>
	<td class="tdItem">E-Mail Address
	</td>

	<td class="tdDesc">This user's email address.
	<br />The user can override this on their preferences screen after logging in.
	</td>

    <td class="tdAction">Enter this user's email address
	</td>
</tr>

<tr>
	<td class="tdItem">Receive notifications
	</td>

	<td class="tdDesc">This checkbox indicates if this user will receive email notifications from the system.
	</td>

    <td class="tdAction">Check this box if the user is to receive email notifications.
	</td>
</tr>

<tr>
	<td class="tdItem">Attach File
	</td>

	<td class="tdDesc">If and when email notifications are sent, this option determines whether a copy of the document affected
	is attached to the email.
	</td>

    <td class="tdAction">Check the checkbox if a copy of the file is to be attached to the notification email.
	</td>
</tr>

<tr>
	<td class="tdItem">User Initial Major Revision
	</td>

	<td class="tdDesc">The default Major Revision value for a new document added by this user.
	</td>

    <td class="tdAction">Enter a number for the default Initial Major Revision.
    <br />Recommended value is 1.
	</td>
</tr>

<tr>
	<td class="tdItem">User Initial Minor Revision
	</td>

	<td class="tdDesc">The default Minor Revision value for a new document added by this user.
	</td>

    <td class="tdAction">Enter a number for the default Initial Major Revision.
    <br />Recommended value is -.
	</td>
</tr>

<tr>
	<td class="tdItem">User Default View EXPANDED
	</td>

	<td class="tdDesc">When a user is viewing lists of documents, this option set the default view.
	</td>

    <td class="tdAction">Check this checkbox to have the default view to be EXPANDED.
    <br />Uncheck this checkbox to have the default view to be COLLAPSED.
	</td>
</tr>

<tr>
	<td class="tdItem">Disable User
	</td>

	<td class="tdDesc">This field determines whether a user can log into the system.
	</td>

    <td class="tdAction">Check this checkbox to prevent this user from logging into the system.
	</td>
</tr>

<tr>
	<td class="tdItem">Default Revision Type
	</td>

	<td class="tdDesc">This option determines which part of a documents revision number gets incremented when the document is updated.
	</td>

    <td class="tdAction">Select the desired value from the dropdown list.
    <br />Note: If NONE SELECTED is chosen, the user must explicitly select the revision level.
	</td>
</tr>

<tr>
	<td class="tdItem">File Admin for Primary Group
	</td>

	<td class="tdDesc">This option determines whether this user can perform administrative file operations on documents in this user's primary group.
	</td>

    <td class="tdAction">Check this checkbox if this user can perform file operations on documents in their primary group.
    <br />Uncheck this checkbox if this user will not be allowed to perform file operations on these documents.
	</td>
</tr>

<tr>
	<td class="tdItem">PDFs get Watermarked
	</td>

	<td class="tdDesc">This option determines whether PDF documents are to be watermarked prior to being downloaded.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Disable Prefs
	</td>

	<td class="tdDesc">When checked, this option will prevent a user from changing any of their options.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Can view System Logs
	</td>

	<td class="tdDesc">When checked, this option will allow a user to view system logs.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Can view System Reports
	</td>

	<td class="tdDesc">When checked, this option will allow a user to view system reports.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">News Administrator
	</td>

	<td class="tdDesc">When checked, this user will be able to add, change, and delete news items.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Login to New Records Page
	</td>

	<td class="tdDesc">When checked, the user's first page after login will be a list of documents and folders added since their last login,
	otherwise their first login screen will be the folder specifed in Initial Folder option above.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">User/Group Administrator
	</td>

	<td class="tdDesc">When checked, this user will be able to administer users and groups.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Comment Notification
	</td>

	<td class="tdDesc">When checked, this user will receive notifications when comments are added to the system.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">E-Mail Tool
	</td>

	<td class="tdDesc">TBD
	</td>

    <td class="tdAction">TBD
	</td>
</tr>

<tr>
	<td class="tdItem">Change password at Next Login
	</td>

	<td class="tdDesc">When checked, the user will be required to change their password the next time they login.
	</td>

    <td class="tdAction">Check this checkbox if yes, uncheck if no.
	</td>
</tr>

<tr>
	<td class="tdItem">Account expires on
	</td>

	<td class="tdDesc">If completed, this user's account will be disabled at the date/time specified.
	</td>

    <td class="tdAction">Leave blank to disable account expiration.
    <br />Enter a date in format yyyy-mm-dd hh:mm:ss to specify an expiration time.
	</td>
</tr>

<tr>
	<td class="tdItem">Authentication type
	</td>

	<td class="tdDesc">The authentication method this account will use to validate login attempts.
	<br />Note: The system administrator must have configured an authentication method.  
	If a method is selected that has not been configured, the user will not be able to log in.
	</td>

    <td class="tdAction">Select the desired authentication method from the dropdown box.
	</td>
</tr>

<tr>
	<td class="tdItem">User GMT Offset
	</td>

	<td class="tdDesc">The user's home time offset.
	<br />The user can override this on their preferences screen after logging in.
	</td>

    <td class="tdAction">Select this user's default time zone from the dropdown list.
	</td>
</tr>

<tr>
	<td class="tdItem">Phone
	</td>

	<td class="tdDesc">This user's telephone number.
	</td>

    <td class="tdAction">Enter the user's telephone number, or leave blank for none.
	</td>
</tr>

<tr>
	<td class="tdItem">Department
	</td>

	<td class="tdDesc">This user's department name.
	</td>

     <td class="tdAction">Enter the user's department name, or leave blank for none.
	</td>
</tr>

<tr>
	<td class="tdItem">Address
	</td>

	<td class="tdDesc">This user's address
	</td>

    <td class="tdAction">Enter the user's address, or leave blank for none.
	</td>
</tr>

<tr>
	<td class="tdItem">Email Signature
	</td>

	<td class="tdDesc">The user's email signature
	</td>

    <td class="tdAction">Enter the user's signature, or leave blank for none.
	</td>
</tr>





<tr class="trSubsection"><td colspan="3">Action Buttons</td></tr>

<tr>
	<td class="tdItem">Change
	</td>

	<td class="tdDesc">Submit the additions or changes for this user
	</td>

    <td class="tdAction">Click on the "Change" button to submit the data.
	</td>
</tr>

<tr>
	<td class="tdItem">Delete User
	</td>

	<td class="tdDesc">Delete this user from the system
	</td>

    <td class="tdAction">Click on the "Delete" button to delete this user from the system.
	</td>
</tr>

<tr>
	<td class="tdItem">Reset
	</td>

	<td class="tdDesc">Resets the form
    <br>For a new item the content will be emptied.
    <br>For an existing item, the content will be restored to its existing value.
	</td>

    <td class="tdAction">Click on "Reset" to reset the news item form.
	</td>
</tr>

</table>

<br />
<br />
<br />

<h3>Part 2 - Group Administration</h3>
This section is to manage user's membership in, and permissions on, groups.
<table>
<caption>Group Maintenance</caption>

<tr class="trTitles">
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>
<!-- 

<tr>
	<td class="tdItem">
	</td>

	<td class="tdDesc">
	</td>

    <td class="tdAction">
	</td>
</tr>
 -->

<tr class="trSubsection"><td colspan="3">Editing Group</td></tr>

<tr>
	<td class="tdItem">Title
	</td>

	<td class="tdDesc">The name of this group
	</td>

    <td class="tdAction">If desired, change the name of this group.
	</td>
</tr>


<tr class="trSubsection">
    <td colspan="3">Users that are members of this Group (x/y)
    <br />where x=members, y=total users</td>
</tr>

<tr>
	<td class="tdItem">Available Users
	</td>

	<td class="tdDesc">List of all users that are not members of this group
	</td>

    <td class="tdAction">If desired, select an individual user to move into this group
	</td>
</tr>

<tr>
	<td class="tdItem">Data Selection Buttons
	</td>

	<td class="tdDesc"><table>
	<tr>
		<td>&lt;</td>
		<td>Removed selected User from this group</td>
	</tr>
	<tr>
	    <td>&gt;</td>
	    <td>Add selected Available User(s) to this group</td>
	</tr>
	<tr>
	    <td>&lt;&lt;</td>
	    <td>Remove all users from this group</td>
	</tr>
	<tr>
	    <td>&gt;&gt;</td>
	    <td>Add all remaining Available User(s) to this group.</td>
	</tr>
	</table></td>

    <td class="tdAction">Select action to be performed on selected users
	</td>
</tr>

<tr>
	<td class="tdItem">Selected Users
	</td>

	<td class="tdDesc">List of all users that are (or are going to be) members of this group
	</td>

    <td class="tdAction">If desired, select an individual user to move into this group
	</td>
</tr>

<tr>
	<td class="tdItem">Form Selection Buttons
	</td>

	<td class="tdDesc"><table>
	    <tr>
	        <td>Set Selected</td>
	        <td>Submit the requested changes</td>
	    </tr>
	    <tr>
	        <td>Reset</td>
	        <td>Reset membership as it was prior to changes.</td>
	    </tr>
	</table>
	</td>

    <td class="tdAction">Click on desired action button.
	</td>
</tr>

<tr>
    <td colspan="3">Users that have this group as PRIMARY Group (x/y)
    <br />where x=members, y=total users</td>
</tr>
<tr>
	<td class="tdItem">Available Users
	</td>

	<td class="tdDesc">List of all users that do not have this group as their PRIMARY group.
	</td>

    <td class="tdAction">If desired, select one or more users to have this group as their PRIMARY group.
	</td>
</tr>

<tr>
	<td class="tdItem">Data Selection Buttons
	</td>

	<td class="tdDesc"><table>
	<tr>
		<td>&lt;</td>
		<td>Remove selected User from this list</td>
	</tr>
	<tr>
	    <td>&gt;</td>
	    <td>Add selected Available User(s) to this list</td>
	</tr>
	<tr>
	    <td>&lt;&lt;</td>
	    <td>Remove all users from this list</td>
	</tr>
	<tr>
	    <td>&gt;&gt;</td>
	    <td>Add all remaining Available User(s) to this list.</td>
	</tr>
	</table></td>

    <td class="tdAction">Select action to be performed on selected users
	</td>
</tr>

<tr>
	<td class="tdItem">Selected Users
	</td>

	<td class="tdDesc">List of all users that have (or are going to have) this group as their PRIMARY group.
	</td>

    <td class="tdAction">If desired, select an individual user to move out of this list.
	</td>
</tr>

<tr>
	<td class="tdItem">Form Selection Buttons
	</td>

	<td class="tdDesc"><table>
	    <tr>
	        <td>Set Selected</td>
	        <td>Submit the requested changes</td>
	    </tr>
	    <tr>
	        <td>Reset</td>
	        <td>Reset membership as it was prior to changes.</td>
	    </tr>
	</table>
	</td>

    <td class="tdAction">Click on desired action button.
	</td>
</tr>




<tr class="trSubsection">
    <td colspan="3">Users who are Group Admins for this group (x/y)
    <br />where x=members, y=total users</td>
</tr>
<tr>
	<td class="tdItem">Available Users
	</td>

	<td class="tdDesc">List of all users that are not Group Admin for this group.
	</td>

    <td class="tdAction">If desired, select one or more users to be Group Admin for this group.
	</td>
</tr>

<tr>
	<td class="tdItem">Data Selection Buttons
	</td>

	<td class="tdDesc"><table>
	<tr>
		<td>&lt;</td>
		<td>Remove Selected User(s) from this list</td>
	</tr>
	<tr>
	    <td>&gt;</td>
	    <td>Add selected Available User(s) to this list</td>
	</tr>
	<tr>
	    <td>&lt;&lt;</td>
	    <td>Remove all users from this list</td>
	</tr>
	<tr>
	    <td>&gt;&gt;</td>
	    <td>Add all remaining Available User(s) to this list.</td>
	</tr>
	</table></td>

    <td class="tdAction">Select action to be performed on selected users
	</td>
</tr>

<tr>
	<td class="tdItem">Selected Users
	</td>

	<td class="tdDesc">List of all users that are (or will be ) Group Admin for this group.
	</td>

    <td class="tdAction">If desired, select one or more users to move out of this list.
	</td>
</tr>

<tr>
	<td class="tdItem">Form Selection Buttons
	</td>

	<td class="tdDesc"><table>
	    <tr>
	        <td>Set Selected</td>
	        <td>Submit the requested changes</td>
	    </tr>
	    <tr>
	        <td>Reset</td>
	        <td>Reset membership as it was prior to changes.</td>
	    </tr>
	</table>
	</td>

    <td class="tdAction">Click on desired action button.
	</td>
</tr>




</table>

</div>
<!-- Help Ends Here -->

