Problem: File name and Folder name can't use Chinese(big5).

Solution:

1. Extract admin/tools/big5_func-0.21.zip

2. Include big5_func.inc in conifg/owl.php,and change all addslashes,stripslashes functions to big5_addslashes,big5_stripslashes functions.

3. Add a javascript and a HIDDEN field at file_upload,file_update's <FORM> in modify.php,like this
---------------------------------------------------

<SCRIPT language="javascript">
<!--
function realname()
{
var Ary = document.Fileform.userfile.value.split('\\');
document.Fileform.real_userfile_name.value=Ary[Ary.length-1];
return true;
}
//-->
</SCRIPT>

<FORM enctype= 'multipart/form-data' ACTION='dbmodify.php' METHOD=POST
name=Fileform onSubmit=\"return realname()\">
<INPUT TYPE=HIDDEN NAME=real_userfile_name>

---------------------------------------------------

4. modify some in dbmodify.php 

Line number may vary from version to version
---------------------------------------------------
dbmodify.php
/*line 191*/ 
$new_name =
big5_str_replace("[^-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÏïÑñÒòÓóÔôÕõÖöØøÙùÚúÛûÜüÝýÿ()@#$&{}+,]",
"", ereg_replace("%20|^-", "_", $_POST["real_userfile_name"]));// amos modify

/*line 193*/
$newpath =
$default->owl_FileDir."/".find_path($parent)."/".big5_stripslashes($new_name);//amos
mod

/*line 280*/
if(!(file_exists($newpath)==1) || $backup_filename !=
big5_stripslashes($new_name)) printError("$lang_err_file_update","");

/*line 282*/
$extension = explode(".",big5_stripslashes($new_name));//amos mod


/*line 536 */
$new_name =
big5_str_replace("[^-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÏïÑñÒòÓóÔôÕõÖöØøÙùÚúÛûÜüÝýÿ()@#$&{}+,]",
"", ereg_replace("%20|^-", "_", $_POST["real_userfile_name"]));// amos modify

/* line 541 */
$newpath =
$default->owl_FileDir."/".find_path($parent)."/".big5_stripslashes($new_name);//
amos mod

/* line 671 */
$sql->query("UPDATE $default->owl_files_table set
name='".big5_stripslashes($title)."', security='$security',
metadata='$metadata', description='$description',groupid='$groupid', creatorid
='$file_owner' where id = '$id'");// amos mod

/* line 755 */
$desc = big5_str_replace("[\\]","",$desc);//amos modify:
ereg_replace("[\\]","", $desc);// amos mod

/* line 760 */
$mail->CharSet = "big5"; // amos add

/* line 782 */
$mail->Subject = "$lang_file: $name -- ".big5_stripslashes($subject);//amos
modify

/* line 784 */
$mail->Body = "".big5_stripslashes($mailbody). "<br /><br />" .
"$lang_description: <br /><br />$desc";//amos mod
$mail->altBody = "".big5_stripslashes($mailbody) . "\n\n" .
"$lang_description: \n\n $desc";//amos mod

/* line 888 */
$name =
big5_str_replace("[^-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÏïÑñÒòÓóÔôÕõÖöØøÙùÚúÛûÜüÝýÿ()@#$&{}+,]",
"", ereg_replace("%20|^-", "_", $name));//amos modify

/* line 900 */
mkdir($default->owl_FileDir."/".$path."/".big5_stripslashes($name),
0777);//amos mod
if(!is_dir($default->owl_FileDir."/".$path."/".big5_stripslashes($name)))
{//amos mod

/* line 931 */
$name =
big5_str_replace("[^-A-Za-z0-9._[:space:]ÀàÁáÂâÃãÄäÅåÆæÇçÈèÉéÊêËëÌìÍíÎîÏïÑñÒòÓóÔôÕõÖöØøÙùÚúÛûÜüÝýÿ()@#$&{}+,]",
"", ereg_replace("%20|^-", "_", $name));// amos modify

/* line 933 */
$dest = $path . big5_stripslashes($name);//amos mod

/* line 939 */
$cmd="mv \"$path$origname\" \"". $path . big5_stripslashes($name) . "\""
2>&1";//amos mod

/* line 948 */
rename ("$path$origname", "$path".big5_stripslahs($name)."");//amos mod
---------------------------------------------------

Filename and folder name can use Chinese Big5 now.

My environment RH 7.2, apache, php 4.3.0, MySQL 3.23 (default charset is
big5), owl 0.7 20030302($default->owl_use_fs=true)

amos huang
