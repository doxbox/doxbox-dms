/* 
 * PHP File Uploader with progress bar Version 1.20
 * Copyright (C) Raditha Dissanyake 2003
 * http://www.raditha.com

 * Licence:
 * The contents of this file are subject to the Mozilla Public
 * License Version 1.1 (the "License"); you may not use this file
 * except in compliance with the License. You may obtain a copy of
 * the License at http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS
 * IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
 * implied. See the License for the specific language governing
 * rights and limitations under the License.
 * 
 * The Initial Developer of the Original Code is Raditha Dissanayake.
 * Portions created by Raditha are Copyright (C) 2003
 * Raditha Dissanayake. All Rights Reserved.
 * 
 */
 

var postLocation="/owl-0.96/scripts/megaupload/pgbar.php";

/* 
 * add any extension that you do no want to upload to the list 
 * below they should be placed with in the /^ and / characters
 * separate each extension by a pipe symbol |
 */
 
var re = /^(\.php)|(\.sh)/;  // disallow shell scripts and php


/**
 * dofilter = true; to enable filtering
 */
var dofilter=true;

/**
 * this method will match each of the filenames with a
 * given list of banned extension. If any one of the
 * extensions match, an alert will be popped up and the
 * upload will not continue;
 */
 
function check_types() {
	if(dofilter==false)
		return true;
	with(document.forms[0])
	{
		/*
		 * with who uses with?
		 * i do, i am an ancient. ok?
		 */
		
		for(i=0 ; i < elements.length ; i++)
		{
			if(elements[i].value.match(re))
			{
				alert('Sorry ' + elements[i].value + ' is not allowed');
				return false;
			}
		}
	}
	return true;
}

function popUP(mypage, myname, w, h, scroll, titlebar)
{

	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable=no,satus=no,titlebar=no';
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) {
		win.window.focus();
	}
}

function postIt()
{

	if(check_types() == false)
	{
		return false;
	}
	baseUrl = postLocation;
	sid = document.forms[0].sessionid.value;
	iTotal = escape("-1");
	baseUrl += "?iTotal=" + iTotal;
	baseUrl += "&iRead=0";
	baseUrl += "&iStatus=1";
	baseUrl += "&sessionid=" + sid;

	popUP(baseUrl,"Uploader",460,162,false,false);
	document.forms[0].submit();
}
