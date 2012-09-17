<html>
	<head>
		<title><?php echo $owl_lang->calendar_title; ?></title>
		<style>
			a
			{
				text-decoration:none
			}
			a.lbutton1:link
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.lbutton1:visited
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.lbutton1:active
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.lbutton1:hover
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#FFFFFF;
				white-space: nowrap
			}
			a.loglbutton1:link
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.loglbutton1:visited
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.loglbutton1:active
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				white-space: nowrap
			}
			a.loglbutton1:hover
			{
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#FFFFFF;
				white-space: nowrap
			}
			body
			{
				background-color:#99AEBB;
				margin-top:6px;
				margin-left:6px;
				margin-right:6px;
				margin-bottom:6px;
				scrollbar-face-color:#CCD2D8;
				scrollbar-highlight-color:#E9EEF3;
				scrollbar-shadow-color:#B4BEC8;
				scrollbar-3dlight-color:#B4BEC8;
				scrollbar-arrow-color:#000000;
				scrollbar-track-color:#EAEAEA;
				scrollbar-darkshadow-color:#7A828A;
			}
			.form0
			{
				padding-top:8px;
				padding-bottom:8px;
				padding-left:8px;
				padding-right:8px
			}
			.form1
			{
				white-space: nowrap;
				text-align:left;
				vertical-align:middle;
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				background-color:#D5DFE7;
				border-top-color:#FDFEFF;
				border-bottom-color:#8199AB;
				border-left-color:#FDFEFF;
				border-right-color:#8199AB;
				border-style:solid;
				border-top-width:1px;
				border-bottom-width:1px;
				border-left-width:1px;
				border-right-width:1px;
				padding-top:1px;
				padding-bottom:1px;
				padding-left:4px;
				padding-right:4px
			}
			.form2
			{
				text-align:right;
				vertical-align:middle;
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				background-color:#D5DFE7;
				border-top-color:#FDFEFF;
				border-bottom-color:#8199AB;
				border-left-color:#FDFEFF;
				border-right-color:#8199AB;
				border-style:solid;
				border-top-width:1px;
				border-bottom-width:1px;
				border-left-width:1px;
				border-right-width:1px;
				padding-top:2px;
				padding-bottom:2px;
				padding-left:4px;
				padding-right:4px;
				white-space: nowrap;
			}
			.finput1
			{
				text-align:left;
				vertical-align:top;
				font-family:Arial,Verdana;
				font-size:12px;
				color:#000000;
				background-color:#F3F7FA;
				border-top-color:#83919A;
				border-bottom-color:#83919A;
				border-left-color:#83919A;
				border-right-color:#83919A;
				border-top-width:1px;
				border-left-width:1px;
				border-right-width:1px;
				border-bottom-width:1px;
				border-style:solid;
				padding-top:1px;
				padding-left:1px;
				padding-right:0px;
				padding-bottom:0px;
			}
			*.hilite
			{
				font-size : 10pt;
				font-family : Arial, Verdana;
				font-weight : bold;
				font-style : normal;
				text-decoration: none;
			} 
			.button1
			{
				text-align:center;
				vertical-align:middle;
				font-family:Arial,Verdana;
				font-size:11px;
				font-weight:bold;
				color:#000000;
				border-top-color:#EFF4F9;
				border-bottom-color:#62707D;
				border-left-color:#EFF4F9;
				border-right-color:#62707D;
				border-top-width:1px;
				border-bottom-width:1px;
				border-left-width:1px;
				border-right-width:1px;
				border-style:solid;
				padding-top:0px;
				padding-bottom:0px;
				padding-left:3px;
				padding-right:3px;
				white-space: nowrap;
			}
		</style>
		<script language="javascript">
			var DayInMilliseconds = 24 * 60 * 60 * 1000;
			var TodaysDate = new Date();
			var SelectedDate = TodaysDate;
			var OriginalDate = TodaysDate;
			var ColumnDayMapping = Array( 1, 2, 3, 4, 5, 6, 0 ); // 0-Monday ... 6-Sunday
			var previousYear = SelectedDate.getFullYear();
			/* Show the calendar for the given month */
			function ShowCalendar(pYear, pMonth, pMonthDay)
			{
				// Valid entries only
				pYear  = parseInt( pYear );  pYear = (isNaN( pYear ) || pYear < 1599 || pYear > 2999) ? TodaysDate.getFullYear() : pYear;
				pMonth = parseInt( pMonth ); pMonth = isNaN( pMonth ) ? (TodaysDate.getMonth() + 1) : pMonth;
				pMonthDay = parseInt( pMonthDay ); pMonthDay = isNaN( pMonthDay ) ? TodaysDate.getDate() : pMonthDay;

				previousYear = pYear;

				SelectedDate = new Date();
				SelectedDate.setFullYear( pYear, pMonth - 1, pMonthDay );
				document.frmDateSelection.theDate.value = formatDate( SelectedDate );

				// Get first and last days of the month
				var FirstDayOfMonth = new Date(), FirstDayOfNextMonth = new Date(), LastDayOfMonth = new Date();
				FirstDayOfMonth.setFullYear( pYear, pMonth - 1, 1 );

				if(pMonth < 12) FirstDayOfNextMonth.setFullYear( pYear, pMonth, 1 );
				else FirstDayOfNextMonth.setFullYear( pYear + 1, 0, 1 );

				LastDayOfMonth.setTime( FirstDayOfNextMonth.getTime() - DayInMilliseconds );

				// Loop over TD's and set their values accordingly
				var dayNo = 0;
				for( var r = 0; r < 6; r++ )
				{
					for(var c = 0; c < 7; c++)
					{
						var td = document.getElementById("GridTD_" + r + "_" + c);
						// Clean up the td
						td.innerHTML = "&nbsp;";
						
						// Sundays and Saturdays are different
						// if( c == 5 || c == 6 )
						// 	td.style.backgroundColor ="#F0F0F0";
						// else
						td.style.backgroundColor = "";
						
						td.style.color = "black";
						td.style.fontWeight = "normal";

						// If not started counting, check for start
						if( dayNo == 0 )
							if ( FirstDayOfMonth.getDay() == ColumnDayMapping[c] )
								dayNo = 1;

						if( dayNo > 0 && dayNo <= LastDayOfMonth.getDate() )
						{
							td.innerHTML = "<a href='javascript:void(0);' onclick='javascript:ShowCalendar("+pYear+","+pMonth+","+dayNo+")'>"+ dayNo + "</a>";

							if( (TodaysDate.getFullYear() == pYear) && (TodaysDate.getMonth() == pMonth - 1) && (TodaysDate.getDate() == dayNo) )
							{
								td.style.fontWeight = "bold";
							}

							if( pMonthDay == dayNo )
							{
								td.style.backgroundColor = "Gray";
								td.style.color = "red";
								td.style.fontWeight = "bold";
							}
													
							dayNo++;
						}
					}
				}
			}
			/* Returned Date format */
			function formatDate( dateObject )
			{
				var pMonth = dateObject.getMonth() + 1;
				var pMonthDay = dateObject.getDate();
				var pYear = dateObject.getFullYear();
				// Show day, month and year readings
				var disp_Month = (pMonth < 10) ? "0" + pMonth : pMonth;
				var disp_Day = (pMonthDay  < 10) ? "0" + pMonthDay  : pMonthDay;
				document.frmDateSelection.month.selectedIndex = pMonth - 1;
				document.frmDateSelection.year.value = pYear;
				return disp_Day + "-" + disp_Month + "-" + pYear;
			}
			/* Month changed */
			function MonthOrYearChanged()
			{
				ShowCalendar( document.frmDateSelection.year.value, document.frmDateSelection.month.selectedIndex + 1, 1 );
			}
			// +1/-1 Year change
			function YearChanged( howMuch )
			{
				document.frmDateSelection.year.value = parseInt( document.frmDateSelection.year.value ) + parseInt( howMuch );
				MonthOrYearChanged();
			}
			// Parse a date string and return the object
			function getDateObject( dateString )
			{
				var arr = Array();
				var valid = false;
				var day = -1, month = -1, year = -1;
				// dd-mm-yyyy format
				if( dateString.indexOf("-") > 0 )
				{
					valid = true;
					arr   = dateString.split("/");
					day = parseInt(arr[0],10);
					if(arr.length > 0) month = parseInt(arr[1],10);
					if(arr.length > 1) year  = parseInt(arr[2],10);
				}
				// yyyy-mm-dd
				else if( dateString.indexOf("-") > 0 )
				{
					valid = true;
					arr   = dateString.split("-");
					day = parseInt(arr[2],10);
					if(arr.length > 0) month = parseInt(arr[1],10);
					if(arr.length > 1) year  = parseInt(arr[0],10);
				}
				if(! valid ) return TodaysDate;
				day = parseInt(arr[0],10);
				if(arr.length > 0) month = parseInt(arr[1],10);
				if(arr.length > 1) year  = parseInt(arr[2],10);
				var theDate = new Date();
				theDate.setFullYear( year, month - 1, day );
				return theDate;
			}
			/* Initialize */
			function Initialize( fromDateObj )
			{
				previousYear = SelectedDate.getFullYear();
				if( ! fromDateObj )
				{
					var validSelected = false;
					try
					{
						if(window.opener != null)
							SelectedDate = opener.GetDateSelectorDate();
						if( typeof(SelectedDate) == "object" )
						{
							validSelected = true;
						}
						else
						{
							SelectedDate = getDateObject( SelectedDate );
							validSelected = true;
						}
					}
					catch( ex )
					{
						validSelected = false;
					}
					if( ! validSelected ) SelectedDate = TodaysDate;
					OriginalDate = SelectedDate;
				}
				else
				{
					SelectedDate = fromDateObj;
				}
				document.frmDateSelection.year.focus();
				ShowCalendar( SelectedDate.getFullYear(), SelectedDate.getMonth() + 1, SelectedDate.getDate() );
			}
			function returnDateString()
			{
				try
				{
					if(window.opener != null)
						opener.SetDateSelectorDate( document.frmDateSelection.theDate.value );
				}
				catch( ex )
				{
					alert("Wrong use of returnDateString() function\n" + ex.toString());
				}
				window.close();
			}
		</script>
	</head>
	<body onload="Initialize()">
		<form name="frmDateSelection" method="post" action="">
			<table class="form1">
				<tr align="center">
					<td>
						<a href="javascript:YearChanged(1);"><img src="up.gif" width="12" height="8" border="0" /></a>
					</td>
					<td rowspan="2">
						<input name="year" type="text" class="finput1" style="width:35px" maxlength="4" value="2009" onchange="MonthOrYearChanged()" onkeyup="if(this.value.length == 4 && previousYear != this.value) MonthOrYearChanged()">
					</td>
					<td rowspan="2">
						<select name="month" class="finput1" id="month" onchange="MonthOrYearChanged()" style="width:140px">
							<option value="01">Janeiro</option>
							<option value="02">Fevereiro</option>
							<option value="03">Mar&ccedil;o</option>
							<option value="04">Abril</option>
							<option value="05">Maio</option>
							<option value="06">Junho</option>
							<option value="07">Julho</option>
							<option value="08">Agosto</option>
							<option value="09">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<a href="javascript:YearChanged(-1);"><img src="down.gif" width="12" height="8" border="0" /></a>
					</td>
					<td />
					<td />
				</tr>
			</table>
			<table class="form1">
				<tr>
					<td width="25">Seg</td>
					<td width="25">Ter</td>
					<td width="25">Qua</td>
					<td width="25">Qui</td>
					<td width="25">Sex</td>
					<td width="25">S&aacute;b</td>
					<td width="25">Dom</td>
				</tr>
				<script language="javascript">
					var InlineHTML = "";
					for(var i = 0; i < 6; i++)
					{
						InlineHTML += "<tr align=center>";
						for(var j = 0; j < 7; j++)
							InlineHTML += "<td id='GridTD_"+ i +"_"+ j +"'>&nbsp;</td>";
						InlineHTML += "</tr>"
					}
					document.writeln( InlineHTML );
				</script>
				<tr align="center">
					<td colspan="7">
						<input type="text"   style="width:70px;" name="theDate" readonly="readonly" value="" class="finput1">
					</td>
				</tr>
				<tr align="center">
					<td colspan="7">
						<input type="button" name="btnToday" value="Hoje" onclick="Initialize( TodaysDate )" class="button1">
						<input type="button" name="btnOk" value="Inserir" onclick="returnDateString()" class="button1">
						<input type="button" name="btnCancel" value="Fechar" onclick="window.close()" class="button1">
						<input type="button" name="btnRest" value="Limpar" onclick="Initialize( OriginalDate )" class="button1" ID="Button1">
					</td>
				</tr>
			</table>
		</form>
		  <!--<table class="form1" width="100%">
			<form name="frmDateSelection" method="post" action="">
				<tr>
					<td class="form1">
						<table class="form1">
							<tr>
								<td>
									<table  class="form1">
										<tr>
											<td align="right">
												<table class="form1">
													<tr>
														<td>
															<table class="form1">
																<tr>
																	<td>
																		<a href="javascript:YearChanged(1);"><img src="up.gif" width="12" height="8" border="0" />
																	</td>
																</tr>
																<tr>
																	<td />
																</tr>
																<tr>
																	<td />
																</tr>
																<tr>
																	<td>
																		<a href="javascript:YearChanged(-1);"><img src="down.gif" width="12" height="8" border="0" />
																	</td>
																</tr>
															</table>
														</td>
														<td class="form1">
															<input name="year" type="text" class="finput1" style="width:40px" maxlength="4" value="2009" onchange="MonthOrYearChanged()" onkeyup="if(this.value.length == 4 && previousYear != this.value) MonthOrYearChanged()">
														</td>
													</tr>
												</table>
											</td>
											<td>
												<select name="month" class="finput1" id="month" onchange="MonthOrYearChanged()" style="width:160px">
													<option value="01">Janeiro</option>
													<option value="02">Fevereiro</option>
													<option value="03">Mar&ccedil;o</option>
													<option value="04">Abril</option>
													<option value="05">Maio</option>
													<option value="06">Junho</option>
													<option value="07">Julho</option>
													<option value="08">Agosto</option>
													<option value="09">Setembro</option>
													<option value="10">Outubro</option>
													<option value="11">Novembro</option>
													<option value="12">Dezembro</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table class="form1">
										<tr class="form0">
											<td width="25">Seg</td>
											<td width="25">Ter</td>
											<td width="25">Qua</td>
											<td width="25">Qui</td>
											<td width="25">Sex</td>
											<td width="25">S&aacute;b</td>
											<td width="25">Dom</td>
										</tr>
										<script language="javascript">
											var InlineHTML = "";
											for(var i = 0; i < 6; i++)
											{
												InlineHTML += "<tr align=center>";
												for(var j = 0; j < 7; j++)
												InlineHTML += "<td id='GridTD_"+ i +"_"+ j +"'>&nbsp;</td>";
												InlineHTML += "</tr>"
											}
											document.writeln( InlineHTML );
										</script>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text"   style="width:70px;" name="theDate" readonly="true" value="" class="finput1">
									<input type="button" name="btnOk" value="Inserir" onclick="returnDateString()" class="button1">
									<input type="button" name="btnCancel" value="Fechar" onclick="window.close()" class="button1">
									<input type="button" name="btnToday" value="Hoje" onclick="Initialize( TodaysDate )" class="button1">
									<input type="button" name="btnRest" value="Limpar" onclick="Initialize( OriginalDate )" class="button1" ID="Button1">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</form>
		</table>-->
	</body>
</html>
