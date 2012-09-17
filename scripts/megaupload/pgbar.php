<html>
 <head>
  <title>Progress Bar</title>
 </head>
<?
/*
 * Set upload start time
 * This is set once as the point in time at which the upload was started
 * Elapsed time, est remaining time, and upload speed need this
 */

	$dtstart = time();


	$iTotal = urlencode($_REQUEST['iTotal']);
	$iRead = urlencode($_REQUEST['iRead']);
	$iStatus = urlencode($_REQUEST['iStatus']);
	$sessionId = urlencode($_REQUEST['sessionid']);
	
/*
 * Set current time
 * This is set on each refresh to measure elapsed time
 * Elapsed time, est remaining time, and upload speed need this
 */
	$dtnow = $dtstart;

/*
 * From version 1.44 onwards there is a user contributed progress bar in php,
 * which you may use instead of progress.cgi
 * Please note that the file upload still passes through a perl handler even
 * if you use progress.cgi
 * $link = "progress.php?iTotal=".$iTotal."&iRead=".$iRead."&iStatus=".$iStatus."&sessionid=".$sessionId."&dtnow=".$dtnow."&dtstart=".$dtstart;
 */

	
	$link = "/cgi-bin/progress.cgi?iTotal=".$iTotal."&iRead=".$iRead."&iStatus=".$iStatus."&sessionid=".$sessionId."&dtnow=".$dtnow."&dtstart=".$dtstart;

?>	
	 
<frameset rows="*,1" scroll="none">
<frame src="<? echo $link; ?>">
</frameset>

<noframes>
 This is the progress bar window for the PHP mega upload. <a href="/php/progress.php">Follow this
 link</a> for the main page.
</noframes>
</html>
