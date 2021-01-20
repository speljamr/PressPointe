{include file="admin/header.tpl"} 
 
{if $enumMode == "Add"} 
						<h1>Add a Death Notice</h1> 
{else} 
						<h1>Edit a Death Notice</h1> 
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
{if $enumMode != "Add"} 
						<input type="hidden" name="StoryID" value="{$StoryID}"> 
{/if} 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left"><label for="FirstName" class="body">First Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="FirstName" tabindex="1" id="FirstName" value="{$FirstName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="MiddleInitial" class="body">Middle Initial:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="1" maxlength="1" name="MiddleInitial" tabindex="2" id="MiddleInitial" value="{$MiddleInitial}"></td> 
		   				  </tr>		   				   
		   				  <tr> 
		   				    <td align="left"><label for="LastName" class="body">Last Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="LastName" tabindex="3" id="LastName" value="{$LastName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="DOB_Month" class="body">Date of Birth:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="DOB_Month" tabindex="4" id="DOB_Month"> 
								  <option value="1"{if $DOB_Month == 1} selected{/if}>January</option> 
								  <option value="2"{if $DOB_Month == 2} selected{/if}>February</option> 
								  <option value="3"{if $DOB_Month == 3} selected{/if}>March</option> 
								  <option value="4"{if $DOB_Month == 4} selected{/if}>April</option> 
								  <option value="5"{if $DOB_Month == 5} selected{/if}>May</option> 
								  <option value="6"{if $DOB_Month == 6} selected{/if}>June</option> 
								  <option value="7"{if $DOB_Month == 7} selected{/if}>July</option> 
								  <option value="8"{if $DOB_Month == 8} selected{/if}>August</option> 
								  <option value="9"{if $DOB_Month == 9} selected{/if}>September</option> 
								  <option value="10"{if $DOB_Month == 10} selected{/if}>October</option> 
								  <option value="11"{if $DOB_Month == 11} selected{/if}>November</option> 
								  <option value="12"{if $DOB_Month == 12} selected{/if}>December</option> 
								</select> 
								<select size="1" name="DOB_Day" tabindex="5"> 
{section name=Days loop=$arrDays} 
								  <option value="{$arrDays[Days]}"{if $DOB_Day == $arrDays[Days]} selected{/if}>{$arrDays[Days]}</option> 
{/section} 
								</select> 
								<select size="1" name="DOB_Year" tabindex="6"> 
{section name=DOBYears loop=$arrDOBYears} 
								  <option value="{$arrDOBYears[DOBYears]}"{if $DOB_Year == $arrDOBYears[DOBYears]} selected{/if}>{$arrDOBYears[DOBYears]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="DOD_Month" class="body">Date of Death:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="DOD_Month" tabindex="7" id="DOD_Month"> 
								  <option value="1"{if $DOD_Month == 1} selected{/if}>January</option> 
								  <option value="2"{if $DOD_Month == 2} selected{/if}>February</option> 
								  <option value="3"{if $DOD_Month == 3} selected{/if}>March</option> 
								  <option value="4"{if $DOD_Month == 4} selected{/if}>April</option> 
								  <option value="5"{if $DOD_Month == 5} selected{/if}>May</option> 
								  <option value="6"{if $DOD_Month == 6} selected{/if}>June</option> 
								  <option value="7"{if $DOD_Month == 7} selected{/if}>July</option> 
								  <option value="8"{if $DOD_Month == 8} selected{/if}>August</option> 
								  <option value="9"{if $DOD_Month == 9} selected{/if}>September</option> 
								  <option value="10"{if $DOD_Month == 10} selected{/if}>October</option> 
								  <option value="11"{if $DOD_Month == 11} selected{/if}>November</option> 
								  <option value="12"{if $DOD_Month == 12} selected{/if}>December</option> 
								</select> 
								<select size="1" name="DOD_Day" tabindex="8"> 
{section name=Days loop=$arrDays} 
								  <option value="{$arrDays[Days]}"{if $DOD_Day == $arrDays[Days]} selected{/if}>{$arrDays[Days]}</option> 
{/section} 
								</select> 
								<select size="1" name="DOD_Year" tabindex="9"> 
{section name=DODYears loop=$arrDODYears} 
								  <option value="{$arrDODYears[DODYears]}"{if $DOD_Year == $arrDODYears[DODYears]} selected{/if}>{$arrDODYears[DODYears]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Edition" class="body">Edition:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Edition" size="1" id="Edition" tabindex="10"> 
		   				    	  <option value="0">Select Edition</option> 
{section name=Editions loop=$rstEditions} 
		{if $rstEditions[Editions].Ident != $BreakingNewsEditionIdent} 
						  		  <option value="{$rstEditions[Editions].Ident}"{if $Edition == $rstEditions[Editions].Ident} selected{/if}>Vol. {$rstEditions[Editions].Volume} No. {$rstEditions[Editions].Number} - {$rstEditions[Editions].EditionDate}</option> 
		{/if} 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="ObitSummary" class="body">Quick Summary:&nbsp;</label></td> 
		   				    <td align="left"><textarea name="ObitSummary" cols="87" rows="8" id="ObitSummary" tabindex="5">{$ObitSummary}</textarea></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2"> 
		   				    	<span class="body">Death Notice:</span><br> 
{$Editor} 
								</td> 
						  </tr> 
		   				  <tr> 
{if $enumMode == "Add"} 
						    <td align="right" colspan="2"><input type="submit" value="Add Death Notice" name="BTN_ADDOBITUARY" tabindex="12">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="13">&nbsp;</form></td> 
{else} 
						    <td align="right" colspan="2"><input type="submit" value="Update Death Notice" name="BTN_UPDATEOBITUARY" tabindex="12">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="13">&nbsp;</form></td>							 
{/if} 
		   				  </tr> 
		   				</table> 
		   				</p> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}