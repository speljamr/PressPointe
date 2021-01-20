{include file="admin/header.tpl"} 
 
						<h1>Edit a Death Notice</h1> 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
		   				<p class="nonstory">To find the Death Notice you wish to edit please enter at least one of the criteria below:</p> 
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left"><label for="FirstName" class="body">First Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="FirstName" tabindex="1" id="FirstName" value="{$FirstName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="LastName" class="body">Last Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="LastName" tabindex="2" id="LastName" value="{$LastName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="DOB_Month" class="body">Date of Birth:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="DOB_Month" tabindex="3" id="DOB_Month"> 
								  <option value=""></option> 
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
								<select size="1" name="DOB_Day" tabindex="4"> 
								  <option value=""></option> 
{section name=Days loop=$arrDays} 
								  <option value="{$arrDays[Days]}"{if $DOB_Day == $arrDays[Days]} selected{/if}>{$arrDays[Days]}</option> 
{/section} 
								</select> 
								<select size="1" name="DOB_Year" tabindex="5"> 
								  <option value=""></option> 
{section name=DOBYears loop=$arrDOBYears} 
								  <option value="{$arrDOBYears[DOBYears]}"{if $DOB_Year == $arrDOBYears[DOBYears]} selected{/if}>{$arrDOBYears[DOBYears]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="DOD_Month" class="body">Date of Death:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="DOD_Month" tabindex="6" id="DOD_Month"> 
								  <option value=""></option> 
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
								<select size="1" name="DOD_Day" tabindex="7"> 
								  <option value=""></option> 
{section name=Days loop=$arrDays} 
								  <option value="{$arrDays[Days]}"{if $DOD_Day == $arrDays[Days]} selected{/if}>{$arrDays[Days]}</option> 
{/section} 
								</select> 
								<select size="1" name="DOD_Year" tabindex="8"> 
								  <option value=""></option> 
{section name=DODYears loop=$arrDODYears} 
								  <option value="{$arrDODYears[DODYears]}"{if $DOD_Year == $arrDODYears[DODYears]} selected{/if}>{$arrDODYears[DODYears]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Edition" class="body">Edition:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Edition" size="1" id="Edition" tbindex="9"> 
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
		   				    <td align="right" colspan="2"><input type="submit" value="Find Death Notices" name="BTN_FINDOBITUARIES" tabindex="10">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="11"></form></td> 
		   				  </tr> 
		   				</table> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}