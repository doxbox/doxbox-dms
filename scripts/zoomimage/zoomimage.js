/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

var offsetfrommouse=[5,5] //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset
var currentimageheight = 10;	// maximum image size.

function gettrailobj(){
	if (document.getElementById)
	{
		return document.getElementById("trailimageid").style
	}
	else if (document.all)
	{
		return document.all.trailimageid.style
	}
}
function truebody(){
	if (
		document.compatMode
		&& document.compatMode!="BackCompat"
		&& (!window.opera)
	)
	{
		return document.documentElement;
	}
	else
	{
		return document.body;
	}
}

function gettrailobj(){
	if (document.getElementById)
	{
		return document.getElementById("trailimageid").style
	}
	else if (document.all)
	{
		return document.all.trailimagid.style
	}
}

function gettrailobjnostyle(){
	if (document.getElementById)
	{
		return document.getElementById("trailimageid")
	}
	else if (document.all)
	{
		return document.all.trailimagid
	}
}

function followmouse(e){

	var xcoord= offsetfrommouse[0]
	var ycoord= offsetfrommouse[1]
	
	if (document.all)
	{
		var docwidth = truebody().scrollLeft + truebody().clientWidth;
		var docheight = Math.max(truebody().scrollHeight, truebody().clientHeight);
	}
	else
	{
		var docwidth = pageXOffset + window.innerWidth - 15;
		var docheight = Math.max(document.body.offsetHeight, window.innerHeight)
	}

	if (typeof e != "undefined"){
		if (docwidth - e.pageX < 200){
			xcoord = e.pageX - xcoord - 200; // Move to the left side of the cursor
		} else {
			xcoord += e.pageX;
		}
		if (docheight - e.pageY < (currentimageheight + 110)){
			ycoord += e.pageY - Math.max(0,(110 + currentimageheight + e.pageY - docheight - truebody().scrollTop));
		} else {
			ycoord += e.pageY;
		}
	}

	else if (typeof window.event !="undefined"){
		if (docwidth - event.clientX < 200){
			xcoord = event.clientX + truebody().scrollLeft - xcoord - 200; // Move to the left side of the cursor
		} else {
			xcoord += truebody().scrollLeft+event.clientX
		}
		if (docheight - event.clientY < (currentimageheight + 110)){
			ycoord += event.clientY + truebody().scrollTop - Math.max(0,(110 + currentimageheight + event.clientY - docheight));
		} else {
			ycoord += truebody().scrollTop + event.clientY;
		}
	}

	gettrailobj().left=xcoord+"px";
	gettrailobj().top=ycoord+"px";
}

function showtrail(imagename, height){

	if (height > 0){
		currentimageheight = height;
	}

	document.onmousemove=followmouse;

	newHTML = '<div><img src="' + imagename + '" border="1"></div>';

	gettrailobjnostyle().innerHTML = newHTML;

	gettrailobjnostyle().style.visibility="visible";

}

function hidetrail(){
	gettrailobj().visibility="hidden";
	document.onmousemove="";
}
