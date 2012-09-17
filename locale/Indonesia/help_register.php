
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>Registration and Password Request</h2>
<h3>Overview</h3>
<ul>
    	<li><a href="#self"><?php echo $owl_lang->register ?></a></li>
    	<li><a href="#pw"><?php echo $owl_lang->forgot_pass ?></a></li>
    	<li><a href="#rm"><?php echo $owl_lang->remember_me_checkbox ?></a></li>
<li><a href="#chpw"><?php echo $owl_lang->change_pass_title ?></a></li>
</ul>

<a name="self"></a>
<h3><?php echo $owl_lang->register ?></h3>
To register with Owl you need to &#64257;ll in the following &#64257;elds.
<table  style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
<tr>
 <td width ="10%"><i><?php echo $owl_lang->captcha_typein ?></i></td>
 <td>If activated you see this &#64257;eld together with an image next to it. Try to identify the &#64257;ve characters displayed in the image an enter them into the &#64257;eld. This is a security feature. If you cannot identify the characters just push the reload button of your browser and a new image will be created.</td>
</tr>
<tr>
 <td width ="10%"><i><?php echo $owl_lang->full_name ?></i></td>
 <td>Enter your full name, e.g. Doe John.</td>
</tr>
<tr>
 <td><i><?php echo $owl_lang->username ?></i></td>
 <td>Enter your preferred username, e.g. john_doe. Later, you can login to Owl using this name.</td>
</tr>
<tr>
 <td><i><?php echo $owl_lang->email  ?></i></td>
 <td>Enter your e-mail address into this &#64257;eld, e.g. john_doe@owl.sourceforge.net. Note that Owl will send you your password to this e-mail address. So, be sure you enter the correct address.</td>
</tr>
</table>
Then push the button &ldquo;<?php echo $owl_lang->submit ?>&rdquo; to register with Owl. After that an e-mail with your password will be sent to you.
<p></p>
<div style="text-align: right;"><a href ="#top"><img src="../../../graphics/<?php echo $default->sButtonStyle ?>/ui_nav/desc.gif" width="7" height="4" border="0" alt="Up"></img></a></div>

<a name="pw"></a>
<h3><?php echo $owl_lang->forgot_pass ?></h3>
If you forgot your password Owl will send you a new one to your e-mail address. Enter your username into the &#64257;eld and push the button &ldquo;<?php echo $owl_lang->send_pass ?>&rdquo;. Your username is the name you use to log into Owl. It is not your full name.
<p></p>
<div style="text-align: right;"><a href ="#top"><img src="../../../graphics/<?php echo $default->sButtonStyle ?>/ui_nav/desc.gif" width="7" height="4" border="0" alt="Up"></img></a></div>

<a name="rm"></a>
<h3><?php echo $owl_lang->remember_me_checkbox ?></h3>
If you check this box you do not have to enter your login information anymore. Instead everytime you browse to Owl you will be redirected directly to the &#64257;le browser. To use this feature you need to activate cookies in your browser.
<p>Do not use this feature on public computers!
</p>
<p></p>
<div style="text-align: right;"><a href ="#top"><img src="../../../graphics/<?php echo $default->sButtonStyle ?>/ui_nav/desc.gif" width="7" height="4" border="0" alt="Up"></img></a></div>

<a name="chpw"></a>
<h3><?php echo $owl_lang->change_pass_title ?></h3>
If this window appears you have to change your password. Thus, enter your old password into the &#64257;eld &ldquo;<?php echo $owl_lang->oldpassword ?>&rdquo;. Then choose a new password and enter it into the &#64257;elds &ldquo;<?php echo $owl_lang->newpassword ?>&rdquo; and &ldquo;<?php echo $owl_lang->confpassword ?>&rdquo;. Your password needs to be at least <?php echo $default->min_pass_length ?> characters long, contain at least <?php echo $default->min_pass_numeric ?> numeric [0-9], and at least <?php echo $default->min_pass_special ?> special character [ ~!@#$%^&amp;*()-=+_|{}][\";:&lt;&gt;.,?/\\ ].

<p></p>
<div style="text-align: right;"><a href ="#top"><img src="../../../graphics/<?php echo $default->sButtonStyle ?>/ui_nav/desc.gif" width="7" height="4" border="0" alt="Up"></img></a></div>

</div>
<!-- Help Ends Here -->
