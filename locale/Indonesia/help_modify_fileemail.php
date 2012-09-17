
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>E-Mail Tool</h2>
 
<dl>

<dt>Description
</dt>
<dd>The e-mail tool of Owl Intranet lets you send an e-mail 
with or without a file to anybody.
</dd>

<dt>Usage</dt>
<dd>
<p>To send an e-mail you need to do the following:</p>

<ol>
<li>If you got to the e-mail tool by choosing &ldquo;Sendfile&rdquo; you can decide whether to attach the file or just send the weblink to the file.</li>
<li>In the field &ldquo;E-mail_to&rdquo; fill in the correct e-mail address, e.g. user@example.com. If you want to send your e-mail to another Owl user let the field &ldquo;E-Mmail_to&rdquo; empty and choose this user from the list.</li>
<li>If you want to send a copy of your mail to another person fill in the address into the field &ldquo;E-Mmail_cc&rdquo;</li>
<li>Check if your own e-mail address is correctly written in the field &ldquo;E-Mail_reply_to&rdquo;. If this is not the case fill in your correct e-mail address and don't forget to update your address in your preferences. It is very important that your correct e-mail address appears in the &ldquo;Reply to&rdquo; field as this permits the recipient to answer your mail.</li>
<li>Fill in the subject of your mail into the field &ldquo;Subject&rdquo;.</li>
<li>In the field &ldquo;Message&rdquo; write your e-mail. You can write in any language you like. The e-mail will be displayed correctly.</li>
<li>Check the &ldquo;Use Signature?&rdquo; checkbox if you want to add your signature (defined in your preferences) to the bottom of the email.</li>
<li>To send your e-mail push the button &ldquo;Send E-Mail&rdquo;. You will be brought back to the browser. If you want to reset the whole form click on &ldquo;Reset&rdquo;.</li>
</ol>
</dd>
<dt>Contents</dt>
<dd>
<table>
<caption>Section 1 - Email data fields</caption>

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

</table>
 -->

<tr>
	<td class="tdItem">Attach File
	</td>

	<td class="tdDesc">Whether or not to include file as an attachment to the email.
	</td>

    <td class="tdAction">Select desired action
    <br />Check this box to include the file as an attachment.
	</td>
</tr>

<tr>
	<td class="tdItem">Email to:
	</td>

	<td class="tdDesc">Recipient's email address
	</td>

    <td class="tdAction">Enter email address for person to receive email
    <br>If you want to send your e-mail to another Owl user let the field &ldquo;<?php echo $owl_lang->email_to  ?>&rdquo; empty and choose this user from the list.
	</td>
</tr>

<tr>
	<td class="tdItem">
	</td>

	<td class="tdDesc">List of Owl users that can receive email
	</td>

    <td class="tdAction">Leave empty or
    Select one or more owl users.
	</td>
</tr>

<tr>
	<td class="tdItem">CC
	</td>

	<td class="tdDesc">Courtesy Copy addressee
	</td>

    <td class="tdAction">Leave blank or
    enter email address of email cc recipient.
	</td>
</tr>

<tr>
	<td class="tdItem">Reply to
	</td>

	<td class="tdDesc">Email address to use if recipient selects Reply
	</td>

    <td class="tdAction">Check if your own e-mail address is correctly written 
    in the field 
    &ldquo;<?php echo $owl_lang->email_reply_to  ?>&rdquo;. 
    If this is not the case fill in your correct e-mail address and 
    don't forget to update your address in your 
    <?php echo $owl_lang->preference  ?>. 
    It is very important that your correct e-mail address appears in the 
    &ldquo;<?php echo $owl_lang->email_reply_to  ?>&rdquo; 
    field as this permits the recipient to answer your mail.
	</td>
</tr>

<tr>
	<td class="tdItem">Subject:
	</td>

	<td class="tdDesc">Email subject line
	</td>

    <td class="tdAction">Leave as is or
    Enter alternate email subject line
	</td>
</tr>

<tr>
	<td class="tdItem">Message
	</td>

	<td class="tdDesc">Text to go in the body of the email message.
	</td>

    <td class="tdAction">write your e-mail. 
    You can write in any language you like. 
    The e-mail will be displayed correctly.
	</td>
</tr>

<tr>
	<td class="tdItem">Use Signature?
	</td>

	<td class="tdDesc">Checkbox to determine if signature block 
	will be added to the bottom of the message
	</td>

    <td class="tdAction">Select desired option
    <br>Check this box if you want the Signaure Block below to be added to the message.
    <br>Uncheck this box if do do not want the signature block added.
	</td>
</tr>

<tr>
	<td class="tdItem">Use Signature? (2nd occurance)
	</td>

	<td class="tdDesc">Signature block contents
	</td>

    <td class="tdAction">If Use Signature block above is checked, ignore, otherwise
    <br>Leave as is or
    <br>Change contents of signature block 
	</td>
</tr>

</table>

<br>
<br>

<table>
<caption>Section 2 - Buttons</caption>

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

<tr>
	<td class="tdItem">Send E-Mail
	</td>

	<td class="tdDesc">Send the email
	</td>

    <td class="tdAction">Click this button when you are ready to send the email.
	</td>
</tr>

<tr>
	<td class="tdItem">Reset
	</td>

	<td class="tdDesc">Resets the form
	</td>

    <td class="tdAction">Click this button to eliminat all your changes 
    and reset the email form to its initial state. 
	</td>
</tr>

</table>

</dl>

</div>
<!-- Help Ends Here -->
