
<!-- Help Begins Here -->
<!--
	Author: Robert Geleta   www.rgeleta.com
	Date:	2011-05-07 
 -->

<div class="scrollbar owlHelp">

<h2>Document Type Administration</h2>

<dl>

<dt>Description</dt>
<dd>Define and maintain custom document types
</dd>

</dl>

<hr width="80%"><!-- ****************************************** -->
<h3>Part 1 - Custom Document Type List</h3>

<dl>
<dt>Description</dt>
<dd>This is where you select the custom document type to work with.
</dd>
<dt>Contents</dt>
<dd>
<table>

<tr class="trTitles">
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>

<tr>
	<td class="tdItem">Document Type
	</td>

	<td class="tdDesc">This is dropdown list of the custom defined document types 
	    that have been defined in the repository.
	    This list will contain:
	<ul>
	<li>The "Default" document type</li>
	<li>An option "- ADD New Document Type - "</li>
	<li>Any custom document types added to this repository</li>
	</ul>
	</td>

    <td class="tdAction">1. Click on the dropdown list to show all options
    <br>2. Select an existing document type or "- ADD New Document Type - "
    <br>
    <br>Note: if you select the "Default" document type it will appear
        that nothing happened.  
        The page will have refreshed and return to the starting point.
    </td>
</tr>


</table>
</dd>

<dt>Options</dt>
<dd>There are no options for this part.</dd>

</dl>


<hr width="80%"><!-- ****************************************** -->
<h3>Part 2 - Custom Document Type Attributes</h3>

<dl>
<dt>Description</dt>
<dd>This is where you set the custom document type attributes.
</dd>
<dt>Contents</dt>
<dd>
<table>
<caption>Section 1 - New custom field attributes</caption>

<tr class="trTitles">
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>

<tr>
	<td class="tdItem">Document Type
	</td>

	<td class="tdDesc">This is dropdown list of the custom defined document types 
	    that have been defined in the repository.
	    This list will contain:
	<ul>
	<li>The "Default" document type</li>
	<li>An option "- ADD New Document Type - "</li>
	<li>Any custom document types added to this repository</li>
	</ul>
	</td>

    <td class="tdAction">1. Click on the dropdown list to show all options
    <br>2. Select an existing document type or "- ADD New Document Type - "
    <br>
    <br>Note: 
    <br>If you select the "Default" document type it will appear
        that nothing happened.  
        The page will have refreshed and return to the starting point.
    </td>
</tr>

<tr>
	<td class="tdItem">Field Name</td>
	<td class="tdDesc">The name of your custom field</td>
	<td class="tdAction">Enter the name for your custom field
	<br>Note: space characters will be replaced by underscore ("_") characters.
	</td>
</tr>

<tr>
	<td class="tdItem">Field Pos</td>
	<td class="tdDesc">The position this field should appear in the list of custom fields.</td>
	<td class="tdAction">Enter a sequence number for this field
	<br>Hint: use multiples of 10 - this will be helpful if you later want 
	    to change the order of fields
	</td>
</tr>

<tr>
	<td class="tdItem">Field Label (Per Locale)
	</td>
	<td class="tdDesc">The label for this field for each language.
	</td>
	<td class="tdAction">Enter the label for this field for the corresponding locale language.
	<br>Notes: Locals can be eliminated by the system administrator by 
	    removing the corresponding locale directory from the locale folder.
	</td>
</tr>

<tr>
	<td class="tdItem">Field Size
	</td>
	<td class="tdDesc">The maximum length for the field contents.
	</td>
	<td class="tdAction">Enter the length for the longest data string to be entered for this field.
	</td>
</tr>

<tr>
	<td class="tdItem">Searchable?
	</td>
	<td class="tdDesc">Whether this field will be included in search results
	</td>
	<td class="tdAction">Check this box if you want terms in this field to be included in search results.
	</td>
</tr>

<tr>
	<td class="tdItem">Required?
	</td>
	<td class="tdDesc">Whether this field required to be to be entered for this custom document type
	</td>
	<td class="tdAction">Check this box if you want to require this field when entering this document type.
	</td>
</tr>

<tr>
	<td class="tdItem">Insert in popup description?
	</td>
	<td class="tdDesc">Whether this field will be part of the document description popup.
	</td>
	<td class="tdAction">Check this box if you want data from this field to show in the popup description.
	</td>
</tr>

<tr>
	<td class="tdItem">Show Field in Browse View.
	</td>
	<td class="tdDesc">Whether this field will be shown in browse view.
	<br>Requires option "Custom Fields" option to be selected in "Customize Browser Columns" site feature.
	</td>
	<td class="tdAction">Check this box if you want data from this field to show in browse view.
	</td>
</tr>

<tr>
	<td class="tdItem">Field Type
	</td>
	<td class="tdDesc">A dropdown box with HTML form field type options.
	</td>
	<td class="tdAction">Select how this field will be displayed on pages
	<br>Note: there is a special option labeled Section Separator that can
	    be helpful in providing a header (or footer) for groups of related
	    fields. 
	</td>
</tr>

<tr>
	<td class="tdItem">Field Values Separated With |:
	</td>
	<td class="tdDesc">The list of valid field values.
	</td>
	<td class="tdAction">To restrict fields to a limited set of values, 
	    enter a list of acceptable values here. 
	    Separate the values with either a ":" character or a "|" character.
	</td>
</tr>

</table>
</dd>


<dt>&nbsp;</dt>
<dd>
<table>
	<caption>Section 2 - Action Buttons</caption>
<tr>
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>

<tr>
	<td class="tdItem">Add Field
	</td>

	<td class="tdDesc">Button to save changes made on the field form.
	</td>
	
	<td class="tdAction">Click this button to save changes (new or updated field definitions)
	</td>
</tr>

<tr>
	<td class="tdItem">Del Doc Type
	</td>

	<td class="tdDesc">Button to delete the currently selected document type.
	</td>
	
	<td class="tdAction">Click this button to delete the current document type.
	<br>Note: <span style="font-weight: bold;">You will NOT receive a delete confirmation when deleting document types.
	<br>Make sure you do not hit this button by mistake.</span>
	</td>
</tr>

<tr>
	<td class="tdItem">Reset
	</td>

	<td class="tdDesc">Reset all form fields.
	</td>
	
	<td class="tdAction">Click this button to reset all form fields to their original values.
	</td>
</tr>

</table>
</dd>

<dt>&nbsp;</dt>
<dd>
<table>
<caption>Section 3 - Existing custom field attributes</caption>

<tr class="trTitles">
	<th class="thItem">Item</th>
	<th class="thDesc">Description</th>
	<th class="thAction">Actions</th>
</tr>

<tr>
	<td class="tdItem">no&nbsp;heading<br>icons
	</td>

	<td class="tdDesc">Perform an action on this field
	</td>

    <td class="tdAction">1. Click on the Edit icon to change this field's attributes
    <br>2. Click on the Delete icon to delete this field.
    </td>
</tr>

<tr>
	<td class="tdItem">Field Name
	</td>

	<td class="tdDesc">The internal field name of this custom field.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Field Pos
	</td>

	<td class="tdDesc">The sequence number of this field in the list.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Label (Per Locale)
	</td>

	<td class="tdDesc">The label shown in browse view for the user's selected locale.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Field Size
	</td>

	<td class="tdDesc">The maximum size of data for this custom field.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Searchable?
	</td>

	<td class="tdDesc">Whether this field will appear in search results.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Required?
	</td>

	<td class="tdDesc">Whether this field is required when maintaining a document of this type.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Insert in pop description?
	</td>

	<td class="tdDesc">Whether this field will appear in the popup description.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">Display Browser
	</td>

	<td class="tdDesc">Whether this field will appear in browse view.
	</td>

    <td class="tdAction">none
    </td>
</tr>

<tr>
	<td class="tdItem">- Sample View -
	</td>

	<td class="tdDesc">A generic view of how a field of with the 
	    selected "Field Type" will appear on the screen.
	<br>Note: This is a generic view, the field label will be "FIELD LABEL" 
	    and the data area will be a generic representation of that
	    html form type.
	</td>

    <td class="tdAction">none
    </td>
</tr>

</table>
</dd>

<dt>Options</dt>
<dd>There are no options for this part.</dd>

</dl>


</div>
<!-- Help Ends Here -->
