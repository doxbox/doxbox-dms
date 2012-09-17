
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>Introduction</h2>

Owl is a multi user document repository or knowledge based system. Users are able to capture documents and assign attributes to them when the document is uploaded into the Owl system. Other users are then able to locate the documents either by using the hierarchy folder structure or by using the built in search facility.
<br />A document can be any type of electronic document or file that the user can access from their computer. Typically theses documents could be a word processing file, spreadsheet, or PDF files. But Owl is not just limited to common office file types you can capture most graphic file types, and display them within the system, audio and video or executable program files. In fact Owl is only limited by your imagination.Once documents have been captured by the owl system users have numerous options:
<ul><li>Ability to e-mail documents directly from Owl</li><li>Users can monitor documents or folders for updates and receive notification by e-mail</li><li>A Version Control System (VCS) can be used to track changes to documents, keep copies of old documents and provide a change log.</li><li>Users can add comments to individual documents</li></ul>

All these facilities are easily available through the use of an Internet Browser.

<h2>File Browser</h2>
The browser is the main method, which you will use to navigate the hierarchical folder structure and to find and use documents that have been captured into the system. You can carry out certain <i>actions</i> on folders and documents such as sorting the displayed order, viewing or downloading the document, or e-mailing the document to some one.

<h2>Folder Structure</h2>
Documents that are uploaded into the Owl system are
stored in folders and each folder can have a series of
sub folders. This type of structure is known as a
hierarchical structure and is typically used for the
storage and organization of files on your computer's
hard drive. In Owl, the start point of the hierarchy
(or root) is known as the <i>documents</i> folder. The
folder structure allows a convenient way to group
documents in a meaningful fashion. For instance, you
may wish to capture all your technical documents for a
number of products. You could create a folder named
technical documents and then a series of sub folders
inside technical documents of each product. For this to
work properly, you must chose sensible and descriptive
folder names that provide the user with a reasonable
description and meaning.

<h3>Title Bar</h3>
<!-- 
<table  style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
 -->
<table>
<caption>Browsing Documents</caption>
 <tr>
 <td><img src="%THEME%/ui_icons/tg_check.gif" width="13" height="16" border="0" alt=""></img></td>
 <td>Checkbox to check or uncheck documents or folders for bulk operation</td>
</tr>

<tr>
 <td>Status</td>
 <td>Anyone of the following icons can be displayed:
 <br />*  
     &nbsp;The document has been indexed, i.e. it is possible to search within this document
 <br /><img src="%THEME%/ui_icons/new.gif" width="13" height="16" border="0" alt=""></img>
     &nbsp;The document has been added since your last visit
 <br /><img src="%THEME%/ui_icons/updated.gif" width="13" height="16" border="0" alt=""></img>
     &nbsp;The document has been updated since your last visit
 <br /><img src="%THEME%/icon_action/comment.gif" width="17" height="20" border="0" alt=""></img>
     &nbsp;The document has a user comment
 </td>
</tr>

<tr>
 <td>doc_number</td>
 <td>The specific number of the document.</td>
</tr>
<tr>
 <td>title</td>
 <td>The title of the document or the folder.</td>
</tr>
<tr>
 <td>ver </td>
 <td>The version of the document or the folder. The number before the dot indicates big changes whereas the number after the dot indicates small modifications.</td>
</tr>
<tr>
 <td>file</td>
 <td>The title of the document or the folder.</td>
</tr>
<tr>
 <td>size</td>
 <td>The title of the document or the folder.</td>
</tr>
<tr>
 <td>postedby</td>
 <td>The user who posted the file to the Owl Intranet System.</td>
</tr>
<tr>
 <td>modified</td>
 <td>The date and time of the last modification of the file.</td>
</tr>
<tr>
 <td>held</td>
 <td>Here you see, who is actually holding and modifying the file. If somebody holds a file you cannot update it unless he checks it out again.</td>
</tr>
</table>


<h3>Actions</h3>
Actions provide functions for various tasks on folders and documents. The number of action icons, which are visible, will depend on your permissions for a folder and document.

<table>
<caption>Action Buttons</caption>

<tr class="trTitles">
    <th>Icon</th>
    <th>Applies to</th>
    <th>Description</th>
</tr>

<tr class="trSubsection"><td colspan="3">Non Destructive Operations</td></tr>
<tr>
    <td><img src="%THEME%/icon_action/mag.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Documents</td>
    <td>View the document in your browser</td>
</tr>

<tr>
    <td><img src="%THEME%/icon_action/log.gif" width="17" height="20" border="0" alt=""></img> </td>
    <td>Documents</td>
    <td>View the document's log</td>
</tr>

<tr>
<td><img src="%THEME%/icon_action/monitor.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Folders and Documents</td>
    <td>Monitor actions done with this folder or document</td>
</tr>

<tr>
<td><img src="%THEME%/icon_action/zip.gif" width="17" height="20" border="0" alt=""></img></td>
<td>Folder</td>
<td>Create a zip file of the folder's contenta and download it in the browser.</td>
</tr>

<tr>
    <td><img src="%THEME%/icon_action/bin.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Documents</td>
    <td>Download the document to the browser.</td>
</tr>

<tr>
    <td><img src="%THEME%/icon_action/email.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Documents</td>
    <td>Create an email and include the document as an attachment.</td>
</tr>

<tr>
    <td><img src="%THEME%/icon_action/related.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Documents</td>
    <td>Find related documents.</td>
</tr>

<tr>
<td><img src="%THEME%/icon_action/play.gif" width="17" height="20" border="0" alt=""></img></td>
    <td>Documents</td>
    <td>(Mulitmedia document) play the file.</td>
</tr>




<tr class="trSubsection"><td colspan="3">Operations that add to file information</td></tr>
<tr>
 <td><img src="%THEME%/icon_action/copy.gif" width="16" height="16" border="0" alt=""></img> </td>
 <td>Folders or Document</td>
 <td>Make a copy.</td>
</tr>

<tr>
 <td><img src="%THEME%/icon_action/comment_dis.gif" width="17" height="20" border="0" alt=""></img></td>
 <td>Document</td>
 <td>Add a comment.</td>
</tr>

<tr>
<td><img src="%THEME%/icon_action/newcomment.gif" width="17" height="20" border="0" alt=""></img></td>
 <td>For a document</td>
 <td>Add a comment.</td>
</tr>



<tr class="trSubsection"><td colspan="3">Operations that change an existing file's information</td></tr>
<tr>
 <td><img src="%THEME%/icon_action/edit.gif" width="17" height="20" border="0" alt=""></img> </td>
 <td>Document or Folders</td>
 <td>Modify its properties.</td>
</tr>

<tr>
 <td><img src="%THEME%/icon_action/link.gif" width="17" height="20" border="0" alt=""></img> </td>
 <td>Folders</td>
 <td>Add a link to this folder to another location.</td>
</tr>

<tr>
 <td><img src="%THEME%/icon_action/move.gif" width="17" height="20" border="0" alt=""></img> </td>
 <td>Documents or Folder</td>
 <td>Move it to another location.</td>
</tr>

<tr>
 <td><img src="%THEME%/icon_action/lock.gif" width="17" height="17" border="0" alt=""></img></td>
 <td>Documents</td>
 <td>Check the document out.
 <br />Note that document cannot already be checked out.</td>
</tr>

<tr>
<td><img src="%THEME%/icon_action/unlock.gif" width="16" height="16" border="0" alt=""></img></td>
 <td>Document</td>
 <td>Check the document back in if checked out.</td>
</tr>

<tr>
 <td><img src="%THEME%/icon_action/update.gif" width="17" height="20" border="0" alt=""></img> </td>
 <td>Document</td>
 <td>Update the document with another copy (increments the version).</td>
</tr>


<tr class="trSubsection"><td colspan="3">Operations that delete a file</td></tr>
<tr>
 <td><img src="%THEME%/icon_action/trash.gif" width="17" height="20" border="0" alt=""></img> </td>
 <td>Documents or Folders</td>
 <td>Delete the document or folder.</td>
</tr>

</table>

<h3>Bulk Buttons</h3>
<p>If activated these buttons let you do actions with multiple files at the same time.
</p>
<table>
<caption>Bulk Button Actions</caption>

<tr class="trTitles">
    <th>Button Name</th>
    <th>Button Purpose</th>
</tr>

<tr>
    <td>Bulk Download</td>
    <td>For selected items - create a zip file and download in browser</td>
</tr>

<tr>
    <td>Bulk Move</td>
    <td>For selected items - move another folder.</td>
</tr>

<tr>
    <td>Bulk E-Mail</td>
    <td>For selected items - create a zip file and create an email with the zip file included as an attachment.
</tr>

<tr>
    <td>Bulk Delete</td>
    <td>For selected items - delete the documents
    <br />Note: selected folders cannot be deleted.</td>
</tr>

<tr>
    <td>Bulk Checkout</td>
    <td>For selected items - mark them as checked out.
    <br />Note that no other user can modify a file that is checked out by another user.</td>
</tr>

<tr>
    <td>Bulk Upload</td>
    <td>TBD</td>
</tr>

</table>
<br />

</div>
<!-- Help Ends Here -->
