----------------------------------------------------------
|			 README                          |
----------------------------------------------------------
Thanks for trying your patience on the Owl Intranet Engine :)

The code is not finished, and is not perfect.  If you spot 
a bug that you feel should be reported or if you have any 
comments, concerns, or questions feel free to e-mail me or 
post in the forums. If you are sure its a bug post it in tracker's
bug section. 

You are encountering a problem check the TROUBLE SHOOTING Section
below.

Additional Documentation can be found at:
http://owl.sourceforge.net/

-Steve Bourgeois aka B0zz
Current Lead developer
owl@bozzit.com

----------------------------------------------------------
|                     INSTALLATION                       |
----------------------------------------------------------
Known working configurations:

Apache          - 1.2.x and 1.3.x and 2.x
IIS             - 4.x 5.x
MySQL           - 3.2x.x
Oracle          - 9i
PHP             - >= 5.1.6
PostgreSQL      - 7.x

Current Development Environment:

Apache          - Apache/2.2.15 (Unix)
MySQL           - Server version: 5.1.47
PHP             - 5.3.3

Untested:

PHP CGI Version

--------------------------------
|     Fresh Install - MySQL    |
--------------------------------
1. Move the Intranet folder to where it is going to live
        'mv Intranet /path/to/your/html/directory/'

2. Create a database.
        'mysqladmin -p create intranet'

3. Enter the info into the database.
        'mysql -p intranet < admin/tools/install/sql/mysql-tables.sql'

   NOTE: For those of you that do not have shell access, you can use
         admin/tools/ctable.php to create the tables from the web
	 change the script to reflect your host, username and password.

4. Edit owl.php in /config/
        -> change database type to mysql
        -> change any other things you may need.

5. Edit owl.php in /config/
	-> change database user, host, and password

6. Check permissions on Documents folder
        -> The "/Documents" folder MUST be able to be written to by your web server.
           If your web server is running as user "nobody" and group "nobody" (apache default)
           then cd to the files directory and type:

			*nix: 'chown -R nobody.nobody Documents'
			Windows: Check the permissions and security tabs

7. Login to your Intranet.
        -> in a web browser goto http://<yourhost>/Intranet/
        -> default user is "admin" with password "admin"


--------------------------------
|  Fresh Install - PostgreSQL  |
--------------------------------
1. Move the intranet folder to where it is going to live
        'mv intranet /path/to/your/html/directory/'

2. Create a database.
	'su postgres'
	'createdb intranet'

3. Enter the info into the database.
	'psql intranet < admin/tools/install/sql/postgresql-tables.sql'

4. Give your user that owl is going to use access to the database.
	'psql intranet'
        'grant all on doctype,docfields, docfieldslabel, docfieldvalues, filedata,html,prefs,active_sessions,groups,users,files,folders, mimes,membergroup,news,comments,owl_log,monitored_folder, monitored_file,wordidx, searchidx, peerreview, advanced_acl, metakeywords, trackoldpasswd, favorites  to <owl_username>;'

        'grant all on comments_id_seq, filedata_id_seq, files_id_seq, folders_id_seq, groups_id_seq, html_id_seq, monitored_file_id_seq, monitored_folder_id_seq, news_id_seq, owl_log_id_seq, prefs_id_seq, users_id_seq, doctype_doc_type_id_seq, docfields_id_seq, trackoldpasswd_id_seq, docfieldvalues_id_seq, metakeywords_keyword_id_seq to <owl_username>;' 

5. Edit owl.php in /config/
	-> change the database type to pgsql
        -> change any other things you may need.

6. Edit owl.php in /config/
	-> change database user, host, and password

7. Check permissions on Documents folder
        -> The "/Documents" folder MUST be able to be written to by your web server.
           If your web server is running as user "nobody" and group "nobody" (apache default)
           then cd to the files directory and type:

			*nix: 'chown -R nobody.nobody Documents'
			Windows: Check the permissions and security tabs

8. Login to your Intranet.
        -> in a web browser goto http://<yourhost>/Intranet/
        -> default user is "admin" with password "admin"

-------------------------------- 
|     Fresh Install - Oracle 9i | 
-------------------------------- 
1. Make sure php is compiled with OCI8 support (http://www.php.net/oci8).

2. Move the intranet folder to where it is going to live 
        'mv intranet /path/to/your/html/directory/' 

3. Login to SQLPlus with a valid user (problems with SQLPlus? ->
http://www.orafaq.org/faqplus.htm). 

4. Enter the info into the database. 
        SQL >@{path to intranet}admin/tools/install/sql/oracle-tables.sql
        SQL >commit;
   
5. Edit owl.php in /config/
        -> change database type to oracle (db_oci8.inc)
        -> change any other things you may need. 

6. Edit owl.php in /config/ 
        -> change database user, host, and password

7. Check permissions on Documents folder 
        -> The "/Documents" folder MUST be able to be written to by your 
web server. 
           If your web server is running as user "nobody" and group 
"nobody" (apache default) 
           then cd to the files directory and type: 

                        *nix: 'chown -R nobody.nobody Documents' 
                        Windows: Check the permissions and security tabs 

8. Login to your Intranet. 
        -> in a web browser goto http://<yourhost>/Intranet/ 
        -> default user is "admin" with password "admin" 

--------------------------------
|          Thumb Nails         |
--------------------------------

Owl depends on external tools to generate Thumb Nails.

ImageMagik

And mplayer.

Tested Versions of mplayer.
MPlayer 0.90rc5-3.2.2 (C) 2000-2003 Arpad Gereoffy (see DOCS)
--------------------------------
|          Upgrading           |
--------------------------------
You MUST have Owl version 0.7 OR higher to upgrade.  If you have

Use one of the following Scrips to upgrade your Owl Database from your current version:

admin/tools/install/sql

mysql-from-0.71.sql  
mysql-from-0.72.sql  
mysql-from-0.73.sql  
mysql-from-0.80.sql  

pg-up-from-0.71.sql  
pg-up-from-0.72.sql  
pg-up-from-0.73.sql
pg-up-from-0.80.sql    


1. Backup your database.

2. Enter the appropriate file into your database.
	PostgreSQL -> 'pgsql intranet < pg-up-from-0.xx.sql'
	MySQL -> 'mysql intranet < mysql-from-0.xx.sql'

3. Replace all files except your Documents directory.

4. Edit owl.php in /config/
        -> change the database type to pgsql if you must.
        -> change any other things you may need.
        -> change database user, host, and password

5.  After upgrading your database make sure you go to the admin section, 
    and set the USER That will act as Anonymous usually Anonymous, as well as the GROUP
    that will Admin the File Repository usually 'File Admin'

----------------------------------------------------------
|		 SECURITY CONSIDERATIONS                 |
----------------------------------------------------------

NOBODY should be able to access the Documents directory from the web.

You can make this change to the httpd.conf file and restart your apache server to 
implement this necessity.

<Directory "/path/to/your/documents/directory">
  Deny all
</Directory>

OR For newer version of apache

<Directory "/path/to/your/documents/directory">
  Deny From all
</Directory>

OR EVEN BETTER

Don't put your Owl Documents directory in the web space.

OR

in a .htaccess file inthe Documents directory:

order allow,deny
deny from all

This only works when you have the "AllowOveride limit" directive in place in your configuration.

And I guess you would also need to put in a "AllowOveride none" directive in the server config or in a .htaccess file for the Documents folder, so that the Owl users will not be able to create a .htaccess file in the folder.

----------------------------------------------------------
|     CONFIGURATION PDF FILE Search Index FEATURE        |
----------------------------------------------------------

Windows:

Included in the DOCS/tools Directory is Windows_pdftotext.zip

This file includes GNU pdftotext.exe, these files are required for 
this feature to work under a windows environment.

Once intalled: (I installed them in C:\bin)

Go to the admin Section of OWL, and set the pdftotext path as follows:

C:/bin/pdftotext.exe  <- Notice the .exe 

Unix:

Ensure that pdftotext is installed on your machine. From the command 
line:

	# pdftotext -v

	pdftotext version 2.01
	Copyright 1996-2002 Glyph & Cog, LLC

	# which pdftotext
        /usr/bin/pdftotext


Then:

Go to the admin Section of OWL, and set the pdftotext path as follows:

/usr/bin/pdftotext

Thats it.

----------------------------------------------------------
|     CONFIGURATION WORD FILE Search Index FEATURE        |
----------------------------------------------------------
                                                                                                                                                                                            
Windows (NOT TESTED):
                                                                                                                                                                                            
Included in the DOCS/tools Directory is antiword.zip
                                                                                                                                                                                            
This file includes GNU antiword.exe, these files are required for
this feature to work under a windows environment.
                                                                       
                                                                                                                    
Once intalled: (I installed them in C:\bin)
                                                                                                                                                                                            
Go to the admin Section of OWL, and set the wordtotext path as follows:
                                                                                                                                                                                            
C:/bin/antiword.exe  <- Notice the .exe
                                                                                                                                                                                            
Unix:

Using DOCS/tools/antiword-0.35.tar.gz.

Extract the archive, compile and install as per the install instruction.
                                                                                                                                                                                            
Then:
                                                                                                                                                                                            
Go to the admin Section of OWL, and set the wordtotext path as follows:
                                                                                                                                                                                            
/usr/local/bin/antiword
                                                                                                                                                                                            
Thats it.


----------------------------------------------------------
|	   CONFIGURATION ZIP FOLDER FEATURE              |
----------------------------------------------------------

Included in the DOCS Directory is Windows_tar_gzip.zip

This file includes GNU tar.exe and GNU gzip.exe, these files
are required for this feature to work under a windows environment.

Once intalled: (I installed them in C:\bin)

Go to the admin Section of OWL, and set the gzip path and tar path 
as follows:

C:/bin/gzip.exe and C:/bin/tar.exe  <- Notice the .exe 

Thats it.


----------------------------------------------------------
|	   	     CUSTOMIZATION                       |
----------------------------------------------------------

HTML Settings can be customized from the admin page.

There are two files called lib/userheader.inc and lib/userfooter.inc
that allow you to add custom site headers and footers to all the 
pages execept the login page. Add Standard HTML in the file.

----------------------------------------------------------
|  FAQ 						 	 |
|  TROUBLE SHOOTING SECTION			 	 |
----------------------------------------------------------



      Antiword Resolution For Windows (adamtaylor)

      Create a .cmd file. In it put 

      @echo 
      SET HOME=your\antiword\path (don't include the \antiword dir) 
      your\antiword\path\antiword\antiword.exe %1 %2 
       
      In your preferences in owl, point your antiword path to this file. 
       
      in the in lib/indexing.lib.ph
       
      Find this code:  
       
      $command = $default->wordtotext_path . ' "' . $newpath . '" > "' . $default->owl_tmpdir . "/" . $new_name . '.text"';  
       
      and replace the > with a space. 
       
      Regards 
       
      ajt 


SME Server NOTES:

By: Rick - ckconsulting

Install on SME 6.01  
2004-07-28 12:38
If anyone would like to edit these please do, these are just my notes. I'm new to Linux and I know I have some rights issues as I had to give everyone full control over the Documents dir to get it to work. chmod -R 777 Documents

Build an SME 6.0.1-01 server
Open /server-manager
Remote access
Set “Secure Shell Settings” to “Allow access only from local networks”
Allow Administrative command line...YES
Create Ibay OWL
Delete index.html from ibay
Copy contents of OWL to the new IBAY/html
Set MySql password
# mysqladmin password pass
Create data base
# 2011-09-08 rg directory updated
cd /home/e-smith/files/ibays/owl/html/admin/tools/install/sql
mysqladmin -p create intranet
mysql -p intranet < mysql-tables.sql
Edit /html/admin/owl.php
$default->owl_root_url = "/owl";
$default->owl_fs_root = "/home/e-smith/files/ibays/owl/html";
$default->owl_FileDir = "/home/e-smith/files/ibays/owl/html";
$default->owl_db_pass = "zoom";
$default->debug = true;
$default->admin_login_to_browse_page = true;

Set Permissions
cd /cd /home/e-smith/files/ibays/owl/html
mkdir Documents
cd /home/e-smith/files/ibays/owl
chmod -R 775 html
chown -R root.root html
cd html
chown -R nobody.nobody Documents
chmod -R 777 Documents
Edit /etc/httpd/conf/httpd.conf
From:

< Directory /home/e-smith/files/ibays/owl/html>
AddType application/x-httpd-php .php .php3 .phtml
AddType application/x-httpd-php-source .phps
php_admin_value open_basedir /home/e-smith/files/ibays/owl
</Directory>

To:

<Directory /home/e-smith/files/ibays/owl/html>
AddType application/x-httpd-php .php .php3 .phtml
AddType application/x-httpd-php-source .phps
</Directory>



Problem:		French Characters are stripped out of Folder and File Names

Solution:		in your PHP.ini file default_charset = "UTF-8"   Match default_charset to the charset specified in your language.inc file

Problem:		Problem of encoding for French  

Solution:		Fixed by saving language.inc in UTF-8 and adding <meta http-equiv="content-type" content="text/html; charset=UTF-8"> in the head of header.inc


Problem:		Apparently when you are using IE with MS-Office (word,excel,powerpoint,etc) it can only open documents from 
			out of the IE cache folder - this becomes a problem with SSL because any "no cache" directives are obeyed by IE, 
			and no such file is saved - even though a tcp trace will show the document is successfully downloaded.
			
			see: http://support.microsoft.com/default.aspx?scid=http://support.microsoft.com:80/support/kb/articles/q316/4/31.asp&NoWebContent=1

			It gets worse because php.ini and httpd.conf (apache) both default to no-cache in one way or another.

Solution: 
			1. /usr/local/lib/php.ini (suse linux - use phpinfo() to find yours)

			; Set to {nocache,private,public,} to determine HTTP caching aspects
			; or leave this empty to avoid sending anti-caching headers.
			;session.cache_limiter = nocache
			session.cache_limiter =
			
			2. /usr/local/apache/conf/httpd.conf (may be in /etc/httpd/conf, or wherever)
			
			#
			# CacheNegotiatedDocs: By default, Apache sends "Pragma: no-cache" with each
			# document that was negotiated on the basis of content. This asks proxy
			# servers not to cache the document. Uncommenting the following line disables
			# this behavior, and proxies will be allowed to cache the documents.
			#
			
			CacheNegotiatedDocs
			
			Cheers,
			John.

			
Problem: 	Fatal error: Call to undefined function: mysql_pconnect() in 
		/var/www/html/intranet/phplib/db_mysql.inc on line 73

Solution: 	1) Edited /etc/php.ini and added the following Line to extension section
		extension=mysql.so
		restarted apache (/etc/rc.d/init.d/httpd restart)
	
		2) make sure mysql is actually installed.
		3) make sure php-mysql is also installed.


Problem: 	I can create folders, but when I upload I get sent back to the login
	 	Screen?!?!@#$%^&*()
	
Solution:  	In the php.ini file Turn file_uploads to On by default its Off


Problem: 	I have mail notification turned on, it used to work in owl-0.6 and now I get
	 	Fatal error: Allowed memory size of 8388608 bytes exhausted (tried to alocate 12 bytes)

Solution: 	Now owl-0.7 sends the files as attachments. So the default memory_limit = 8M in php.ini
	  	may not be sufficient to run owl and sends large attachments. Increase this value and 
	  	restart apache.

Problem: 	I get error messages like the following on index.php
		Notice: Undefined variable: sess in C:\www\intranet\lib\owl.lib.php on line 41
		Notice: Undefined variable: sess in C:\www\intranet\lib\owl.lib.php on line 438 

Solution:	Insure that error_reporting in your php.ini doesn't show notices.
		error_reporting = E_ALL & ~E_NOTICE and restart apache.

Problem:	I'm getting the following error message when uploading large files:

		Warning: Unable to open '' for reading: 
		No such file or directory in /var/www/html/owl/dbmodify.php on line 412 

		Warning: unlink() failed (No such file or directory) 
		in /var/www/html/owl/dbmodify.php on line 413 

Solution:	In php.ini Increase the file size to something bigger than the largest 
		file been uploaded and restart apache.

		;;;;;;;;;;;;;;;;
		; File Uploads ;
		;;;;;;;;;;;;;;;;

		; Whether to allow HTTP file uploads.
		file_uploads = On
		
		; Temporary directory for HTTP uploaded files (will use 
		system default if not
		; specified).
		;upload_tmp_dir =
		
		; Maximum allowed size for uploaded files.
----->		upload_max_filesize = 10M


Problem:  	Can't upload any files larger than 512kB and my php.ini is set
		as follows:

		memory_limit = 128M
		post_max_size = 64M
		upload_max_filesize = 32M

			
		Redhat 8.0
		Apache 2.0
		PHP4.2.2

Solution:  	The insiduous php.conf (/etc/httpd/conf.d/php.conf) file used 
		by default RPM install of Redhat httpd has a LimitRequestBody 
		set to 512kB ("524288" ). Adjust this to 32MB ("33554432") or higher.


Problem:	By: sn00per ( Paul Berdal )
		RE: Double size for uploaded file with apache  


Solution:	I have figured out why the uploaded files double in size. For the benefit of others upgrading from RH7.x to RH8.x, 
		please watch out for you settings in the httpd.conf and php.conf. Don't assume that the old defaults work within RH8.x 
		and apache 2.x (like I did). It is best to start with a clean install and add back each option one at at time. 
		In this case, watch out for the "Addtype" option. No need to add .php3, .php4 etc anymore as this is now built in. 				 
                Doing so will cause the above problem.

		For the record, I have tested the following settings which give users a practical working file size of 50MB, 
		seems to work fine.

		1. OWL settings, values set via the admin web form.
		Maximum Upload File Size: 51200000
		Session Timeout in Seconds: 90

		2. /etc/php.ini
		upload_max_filesize=64M
		post_max_size=64M
		memory_limit=128M
		max_execution_time = 60
		short_open_tag = On
		register_globals = On

		3. /etc/httpd/conf.d/php.conf
		LimitRequestBody 67108864
		
		4. /etc/httpd/conf/httpd.conf (Watch out for superfluous statements here)
		#
		# AddType allows you to add to or override the MIME configuration
		# file mime.types for specific file types.
		#
		AddType application/x-tar .tgz 

		I've also solved the probelm by deleting the following lines in httpd.conf file.
		<Files *.php>
			SetOutputFilter PHP
			SetInputFilter PHP
		</Files>
		(I don't think these lines are in a default setting. I myself added these lines.)
		
		The following line remains in the httpd.conf file:
		AddType application/x-httpd-php .php
		
		I haven't been using 'AddType' for php3 and php4.

		I'm running apache 2.0.43 and php 4.3.0 on Solaris 8.

		Hiroshi Tamada 


Problem:	Upon upload and/or emailing file I receive this error:
		Warning: Failed opening 'class.smtp.php' for inclusion (include_path='') in /home/alamo/public_html/intranet/phpmailer/class.phpmailer.php on line 655
		Fatal error: Cannot instantiate non-existent class: smtp in /home/alamo/public_html/intranet/phpmailer/class.phpmailer.php on line 657

Solution:
      		Find the following section in class.phpmailer.php

      /*** Path to phpmailer plugins. This is now only useful if the SMTP class
      * is in a different directory than the PHP include path.
      * @access public
      * @var string
      */
      var $PluginDir = "";



      change PluginDir to:

      var $PluginDir = "/full/path/to/where/you/have/intranet/phpmailer/";


Problem:	In Owl Debug mode I'm getting: php.ini upload_max_filesize exceeded and/or
		Exceeded Owl Max Upload file size.  upload_max_filesize is set high enough, 	
		as well as the Owl Max upload. and file_uploads = On. 

Solution:	It's the upload_tmp_dir in the php.ini file.  It's default is the system temp dir. 
		However if you're webserver is chrooted the system tmp dir may not be available 
		within the chrooted environment.  The solution was to change the upload_tmp_dir 
		to a path within the chrooted environment which is writable for the user the 
		webserver is running as. 

Problem:	When I use owl_use_fs=false with mysql I cannot upload any file bigger than 1MB.   

Solution: 	There is a mysql default limit for the size of blob fields. This limit is set by
		`max_allowed_packet'.  You must increase this value to match the maximum file size
		that you will allow owl to upload since Owl stores the file data in a blob. 
	
		You should change the value of "max_allowed_packet" in /etc/my.cnf to anything 
		reasonable big enough. The default value is 1MB.  

                NOTE:  For Mysql 4 and above you may need to use the syntax set-variable=max_allowed_packet=16M
		       Instead of max_allowed_packet=16M


Problem: 	Apache was saying 413 Error with the following message:

		Request Entity Too Large
		The requested resource /intranet/dbmodify.php does not allow request data with POST requests, 
		or the amount of data provided in the request exceeds the capacity limit.

Solution: 	This was cause by a http.conf entry LimitRequestBody. I have fixed this to 32MB because of a 
		recommendation by another script. This was forcing the upload to be less than 32MB. For anyone 
		who is interested, setting to 0 (zero) will allow unlimited and the restriction at the php.ini applies. 
		 
		
----------------------------------------------------------
|		  PHP 5 Config Issues   		 |
----------------------------------------------------------

Problem:	Problem with Moving Files   

		When I click to move the file, the webpage comes up correctly displaying the top level view 
 		of folders under the Documents root. I don't know if this is the expected behaviour, but I can click 
                on the plus symbols if present and also the folder icon, but not the folder name. 
 
		However, when I click on a plus symbol or folder icon, the same page reloads and nothing happens. 
		No errors are being produced (and Owl is set in debug mode) and it looks as if the links themselves on 
		the page are set to reload the same page as they contain the same URL which loaded the move page initially. 

Solution:	By default PHP5 has 'Register_Long_Arrays' set to off. I changed this to ON and the move function now works! 



----------------------------------------------------------
|			  TIPS 				 |
----------------------------------------------------------

1) By default any User has Folder and File Creation capabilities to the ROOT Folder (Documents).

You may wish to change that to Read Only, and have the Aministrator pre Create the folders for 
each groups.

Here is how you change the permissions on the root folder after Owl is installed:

mysql> select * from folders where id = 1;
+----+-----------+--------+----------+---------+-----------+
| id | name      | parent | security | groupid | creatorid |
+----+-----------+--------+----------+---------+-----------+
| 1  | Documents | 0      | 51 	     | 0       | 0         |
+----+-----------+--------+----------+---------+-----------+
1 row in set (0.00 sec)

As you can see Security is set to 51 Change that to 50?

mysql> update folders set security = 50 where id = 1;
Query OK, 1 row affected (0.01 sec)
Rows matched: 1 Changed: 1 Warnings: 0

mysql> select * from folders where id = 1;
+----+-----------+--------+----------+---------+-----------+
| id | name 	 | parent | security | groupid | creatorid |
+----+-----------+--------+----------+---------+-----------+
| 1  | Documents | 0      | 50 	     | 0       | 0         |
+----+-----------+--------+----------+---------+-----------+
1 row in set (0.00 sec) 


2) Some people have requested that the name of the root folder be changed:
   
   This can be acomplished very much like the above tip for security:

   update folders set name = 'yourfoldernamehere' where id = 1;

3) Antiword.exe on Windows causing you problems? (Contributed by Phil)

	This is what you have to do :
	- First : have msword installed on the server
	- Second : download http://plaza27.mbn.or.jp/~satomii/software/cui/doc2txt-1.6beta1.zip
	- Third : unzip into the directory you wish.
	- Fourth : modifiy owl.lib.php line $command = $default->wordtotext_path . ' "' . $newpath . '" > "' . $default->owl_tmpdir . "/" . $new_name . '.text"';
	into :
	$command = $default->wordtotext_path . ' "' . $newpath . '" -n "' . $default->owl_tmpdir . "/" . $new_name . '.text"';
	- Fifth : go to admin and replace the path to antiword.exe by the path to doc2txt.exe
	
	And here you are.. I tested the result , all word files I tested were indexed...

	Have fun,

4) Performance Problems with Browsing and Searching?

	To enhance performance :
	delete recursive part of check_auth() function in security.lib.php.
	
	replace this :
	// -------------------------
	/* if( $authorization == 1 ) {
	if( ($policy > 49) && ($id == 1) ) {
	// stop if we are at the doc root
	return $authorization;
	} else {
	// continue;
	if($policy < 50) {
	$parent = owlfileparent($id);
	} else {
	$parent = owlfolderparent($id);
	}
	return check_auth($parent, "folder_view", $userid);
	}
	} else {
	// dont continue because authorization is 0
	return $authorization;
	}
	*/
	// -------------------------
	
	bye this :
	// -------------------------
	return $authorization;
	// -------------------------
	

5) adding OCR to the bidindex.pl file: (contributed by derkardina)
 
you nedd to install the following packages and find out where they are located: 
"imagemagick" (converts image formats) and "gocr" (the ocr engine) 
 
I modified the bigindex.pl file at the following positions: 
 
I added two location lines: 
 
my $convert_location = "/usr/bin/convert";  
my $gocr_location = "/usr/bin/gocr"; 
 
then I modified the filepath line to: 
 
if (($filepath=~/\.txt/) || ($filepath=~/\.pdf/) || ($filepath=~/\.doc/) || ($filepath=~/\.tiff/)) 
 
finally I added the following lines: 
 
elsif ($filename=~/\.tiff/) #tiff file?  
{  
`$convert_location -monochrome "$filename" gif:- | convert -limit memory 64 -append - - | convert - pnm:- | $gocr_location -d 15 - -o "$filename.text"`; 
$filename=$filename.'.text'; 
$deletefileafter=1; 
} 
 
I run the bigindex.pl like I described in the eralier post. 
this example only handles .tiff files. these files can be in multipage format. 
I recommend using linescans with 300dpi to get a good result.


6) SAFE_MODE ISSUES:

[15 Oct 2004 10:28am CEST] paulo dot matos at fct dot unl dot pt

A workaround/solution to this problem on *nix

Assuming that httpd server runs as apache/apache (uid/gid), and php
script is user/group. 

1) php.ini
safe_mode = On
safe_mode_gid = On

2) Create initial data directory, on install phase as:

mkdir /path/to/datadir
chown user.group /path/to/datadir
chmod 2777 /path/to/datadir

3) Create all subdirectories (within php), like:
mkdir(/path/to/datadir/subdir, 02777);

This way all subdirectry will inherit group from initial parent dir and
SAFE_MODE won't complain, since all subdirs
and files will be apache.group.

IMPORTANT NOTE: After any subdirectory creation you shouldn't change
directory permissions, otherwise it will loose
the GID bit and all files/subdirectories created afterwards won't have
group inherited!

7) Forcing Owl to be used only in ssl mode

add this to the .htaccess of the intranet directory:
SSLRequireSSL
SSLOptions +StrictRequire +OptRenegotiate
ErrorDocument 403 https://hostingsite.com/intranet/index.php



----------------------------------------------------------
|			  HELP 				 |
----------------------------------------------------------

1) Have a look at the documentation at http://owl.sourceforge.net/

2) Please search the forums on http://sourceforge.net/projects/owl
for answers on your question.

3) You may go to the forums on http://sourceforge.net/projects/owl
and post a question should you still have any problems.

----------------------------------------------------------
|			  TRANSLATIONS			 |
----------------------------------------------------------

How do I translate Owl into another language?

1) Take all files in 
	locale/English/
	locale/English/help
	locale/English/help/admin
and translate it into the language of your choice.
2) Please send your results to the developers.


The Owl Development Team
September, 2011
