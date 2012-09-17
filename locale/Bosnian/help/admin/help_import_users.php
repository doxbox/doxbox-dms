
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta   www.rgeleta.com
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>Import Users</h2>

<dl>

<dt>Description</dt>
<dd>This option allows the administrator to upload a CSV file that contains the users to be imported.
The script ensures that the user does not exist before inserting the users from the CSV file.
</dd>

<dt>CSV Example</dt>
<dd>
<code>
groupid_name,username,name,password,quota_max,quota_current,email,notify,attachfile,disabled,noprefaccess,language,maxsessions,newsadmin,comment_notify,buttonstyle,homedir,firstdir,email_tool
2,user2,User 2,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
newgroup,user3,User 3,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
10,user4,User 4,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
newgroup,user5,User 5,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
newgroup,user1,User 1,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
Administrators,user6,User 6,password,0,0,myemail@domain.com,1,0,0,0,English,1,0,1,rsdx_blue1,1,1,1;
</code>

<h3>Explanation of the Variables</h3>

<table>
<caption>CSV Field Descriptions</caption>

<tr class="trTitles">
	<th>Field Name</th>
	<th>Field Description</th>
</tr>

<tr>
<td>groupid_name</td>
<td>This column can be a
pre-existing groupid or a string. In the case of an ID a check is done
to the database to ensure that it does in fact exist and if not the
user is skipped. However, in the case of a string, a check is done to
see if the group exist, if
it does this existing group is used to create the user. If it does not
exist the group is created.</td>
</tr>

<tr>
<td>username</td>
<td>A check is done to ensure that
this username does not already exist, if it does the User is skipped.</td>
</tr>

<tr>
<td>name
</td>
<td>Full name of the user.
</td>
</tr>

<tr>
<td>password
</td>
<td>Clear text password.
</td>
</tr>

<tr>
<td>quota_max
</td>
<td>File quota in bytes&nbsp; (0 =
disabled).</td>
</tr>

<tr>
<td>quota_current</td>
<td>0 (obviously this is zero as the
new user has not yet any files on the system)
</td>
</tr>

<tr>
<td>email
</td>
<td>(optional) E-mail address of the
user.
</td>
</tr>

<tr>
<td>notify
</td>
<td>1 = receive notifications, 0 =
disabled
</td>
</tr>

<tr>
<td>attachfile
</td>
<td>1 = attach the file to the email
when notify is turned on, 0 = do not attach the file
</td>
</tr>

<tr>
<td>disabled
</td>
<td>1 = the account is created but
is disabled (i.e. the user cannot login), 0 = account is created and
enabled
</td>
</tr>

<tr>
<td>noprefaccess</td>
<td>1 = the user will not have
access to his preferences, 0 = otherwise
</td>
</tr>

<tr>
<td>language
</td>
<td>Preferred language of the user
(must be installed on the system), e.g. English
</td>
</tr>

<tr>
<td>maxsessions
</td>
<td>Maximum number of concurrent
sessions a user can have (at least 1). Default = 1
</td>
</tr>

<tr>
<td>newsadmin
</td>
<td>1 = user is administrator of Owl
News, 0 = otherwise
</td>
</tr>

<tr>
<td>comment_notify
</td>
<td>1 = user receives notification
when someone adds a comment to one if his files</td>
</tr>

<tr>
<td>buttonstyle
</td>
<td>rsdx_blue1 or one of the
directory name (style) in the graphics directory</td>
</tr>

<tr>
<td>homedir
</td>
<td>The folder id (must exist) of
the folder that will act as the users home directory. Default = 1
</td>
</tr>

<tr>
<td>firstdir
</td>
<td>The folder id (must exist) of
the folder that will act as the users initial directory. Default = 1
</td>
</tr>

<tr>
<td>email_tool</td>
<td>1 = user may use the e-mail
tool, 0 = user may not use the e-mail tool
</td>
</tr>

</tbody>
</table>

</dd>

</dl>

</div>
<!-- Help Ends Here -->
