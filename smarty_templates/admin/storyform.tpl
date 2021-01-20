{include file="admin/header.tpl"} 
 
{if $enumMode == "Add"} 
						<h1>Add a Story</h1> 
{else} 
						<h1>Edit a Story</h1> 
{/if} 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul>  
{/if} 
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
{if $enumMode != "Add"} 
						<input type="hidden" name="StoryID" value="{$StoryID}"> 
{/if} 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left"><label for="Title" class="body">Title:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="200" name="Title" tabindex="1" id="Title" value="{$Title}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Author" class="body">Author:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="100" name="Author" tabindex="2" id="Author" value="{$Author}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Section" class="body">Section:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Section" size="1" id="Section" tabindex="3"> 
		   				    	  <option value="0">Select Section</option> 
{section name=Sections loop=$rstSections} 
	{if $rstSections[Sections].Ident != $DeathNoticeSectionIdent} 
						  		  <option value="{$rstSections[Sections].Ident}"{if $Section == $rstSections[Sections].Ident} selected{/if}>{$rstSections[Sections].Name}</option> 
	{/if} 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr>	   
		   				  <tr> 
		   				    <td align="left"><label for="Edition" class="body">Edition:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Edition" size="1" id="Edition" tabindex="4"> 
		   				    	  <option value="0">Select Edition</option> 
		   				    	  <option value="{$BreakingNewsEditionIdent}"{if $Edition == $BreakingNewsEditionIdent} selected{/if}>Breaking News</option> 
{section name=Editions loop=$rstEditions} 
	{if $rstEditions[Editions].Ident != $BreakingNewsEditionIdent} 
						  		  <option value="{$rstEditions[Editions].Ident}"{if $Edition == $rstEditions[Editions].Ident} selected{/if}>Vol. {$rstEditions[Editions].Volume} No. {$rstEditions[Editions].Number} - {$rstEditions[Editions].EditionDate}</option> 
	{/if} 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td>&nbsp;</td> 
		   				  </tr> 
		   				  <tr class="storyimage"> 
		   				    <td align="left" valign="top"><label for="ExpirationDateMonth" class="body">Expiration Date:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="ExpirationDateMonth" tabindex="20" id="ExpirationDateMonth"> 
								  <option value=""{if $ExpirationDateMonth == ""} selected{/if}>&nbsp;</option> 
								  <option value="1"{if $ExpirationDateMonth == 1} selected{/if}>January</option> 
								  <option value="2"{if $ExpirationDateMonth == 2} selected{/if}>February</option> 
								  <option value="3"{if $ExpirationDateMonth == 3} selected{/if}>March</option> 
								  <option value="4"{if $ExpirationDateMonth == 4} selected{/if}>April</option> 
								  <option value="5"{if $ExpirationDateMonth == 5} selected{/if}>May</option> 
								  <option value="6"{if $ExpirationDateMonth == 6} selected{/if}>June</option> 
								  <option value="7"{if $ExpirationDateMonth == 7} selected{/if}>July</option> 
								  <option value="8"{if $ExpirationDateMonth == 8} selected{/if}>August</option> 
								  <option value="9"{if $ExpirationDateMonth == 9} selected{/if}>September</option> 
								  <option value="10"{if $ExpirationDateMonth == 10} selected{/if}>October</option> 
								  <option value="11"{if $ExpirationDateMonth == 11} selected{/if}>November</option> 
								  <option value="12"{if $ExpirationDateMonth == 12} selected{/if}>December</option> 
								</select> 
								<select size="1" name="ExpirationDateDay" tabindex="21"> 
								  <option value=""{if $ExpirationDateDay == ""} selected{/if}>&nbsp;</option> 
{section name=ExpirationDateDay loop=$arrExpirationDateDays} 
								  <option value="{$arrExpirationDateDays[ExpirationDateDay]}"{if $ExpirationDateDay == $arrExpirationDateDays[ExpirationDateDay]} selected{/if}>{$arrExpirationDateDays[ExpirationDateDay]}</option> 
{/section} 
								</select> 
								<select size="1" name="ExpirationDateYear" tabindex="22"> 
								  <option value=""{if $ExpirationDateYear == ""} selected{/if}>&nbsp;</option> 
{section name=ExpirationDateYear loop=$arrExpirationDateYears} 
								  <option value="{$arrExpirationDateYears[ExpirationDateYear]}"{if $ExpirationDateYear == $arrExpirationDateYears[ExpirationDateYear]} selected{/if}>{$arrExpirationDateYears[ExpirationDateYear]}</option> 
{/section} 
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								<select size="1" name="ExpirationDateHour" tabindex="21"> 
								  <option value=""{if $ExpirationDateHour == ""} selected{/if}>&nbsp;</option> 
{section name=ExpirationDateHour loop=$arrExpirationDateHours} 
								  <option value="{$arrExpirationDateHours[ExpirationDateHour]}"{if $ExpirationDateHour == $arrExpirationDateHours[ExpirationDateHour]} selected{/if}>{$arrExpirationDateHours[ExpirationDateHour]}</option> 
{/section} 
								</select>: 
								<select size="1" name="ExpirationDateMinute" tabindex="21"> 
								  <option value=""{if $ExpirationDateMinute == ""} selected{/if}>&nbsp;</option> 
{section name=ExpirationDateMinute loop=$arrExpirationDateMinutes} 
								  <option value="{$arrExpirationDateMinutes[ExpirationDateMinute]}"{if $ExpirationDateMinute == $arrExpirationDateMinutes[ExpirationDateMinute]} selected{/if}>{$arrExpirationDateMinutes[ExpirationDateMinute]}</option> 
{/section} 
								</select> 
								<select size="1" name="ExpirationDateAMPM" tabindex="21"> 
								  <option value=""{if $ExpirationDateAMPM == ""} selected{/if}>&nbsp;</option> 
								  <option value="AM"{if $ExpirationDateAMPM == "AM"} selected{/if}>AM</option> 
								  <option value="PM"{if $ExpirationDateAMPM == "PM"} selected{/if}>PM</option> 
								</select> 
								<br><span class="error">* Only choose this date if entering Breaking News stories!</span> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td>&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="StorySummary" class="body">Story Summary:&nbsp;</label></td> 
		   				    <td align="left"><textarea name="StorySummary" cols="87" rows="8" id="StorySummary" tabindex="5">{$StorySummary}</textarea></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="SummaryImage" class="body">Summary Image:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="255" name="SummaryImage" tabindex="6" id="SummaryImage" value="{$SummaryImage}"><br><br></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="middle"><label for="SubscriberOnly" class="body">Subscriber Only?</label>&nbsp;</td> 
		   				    <td align="left" valign="middle"><input type="checkbox" name="SubscriberOnly" value="Y" tabindex="7" id="SubscriberOnly"{if $SubscriberOnly == "Y"} checked{/if}>&nbsp;<br><br></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="middle"><label for="ShowHP" class="body">Show On Home Page?</label>&nbsp;</td> 
		   				    <td align="left" valign="middle"><input type="checkbox" name="ShowHP" value="Y" tabindex="8" id="ShowHP"{if $ShowHP == "Y"} checked{/if}>&nbsp;<br><br></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2"> 
		   				    	<span class="body">Full Story:</span><br> 
								{$Editor} 
								</td> 
						  </tr> 
						  <tr> 
{if $enumMode == "Add"} 
						    <td align="right" colspan="2"><input type="submit" value="Add Story" name="BTN_ADDSTORY" tabindex="10">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="11">&nbsp;&nbsp;</form></td> 
{else} 
						    <td align="right" colspan="2"><input type="submit" value="Update Story" name="BTN_UPDATESTORY" tabindex="10">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="11">&nbsp;&nbsp;</form></td>							 
{/if} 
						  </tr> 
						</table> 
		   				</p> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
		   				 
{include file="admin/footer.tpl"}