{if $enumMode == "ADD"} 
						<h2>Add An Edition</h2> 
{else} 
						<h2>Edit An Edition</h2> 
{/if} 
{if $AddErrors != ""} 
						<ul class="error">
	{section name=Error loop=$AddErrors} 
						  <li>{$AddErrors[Error]}</li>
	{/section}
						</ul> 
{/if} 
		   				<form action="{$Action}" method="post" name="add_edition"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
{if $enumMode == "UPDATE"} 
		   				<input type="hidden" name="EditEditionID" value="{$EditEditionID}"> 
{/if} 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="Volume" class="body">Volume:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><input type="text" size="3" maxlength="3" name="Volume" tabindex="1" id="Volume" value="{$Volume}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="Number" class="body">Number:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><input type="text" size="3" maxlength="3" name="Number" tabindex="2" id="Number" value="{$Number}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="Date" class="body">Date:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="Month" tabindex="3" id="Date"> 
								  <option value="1"{if $Month == 1} selected{/if}>January</option> 
								  <option value="2"{if $Month == 2} selected{/if}>February</option> 
								  <option value="3"{if $Month == 3} selected{/if}>March</option> 
								  <option value="4"{if $Month == 4} selected{/if}>April</option> 
								  <option value="5"{if $Month == 5} selected{/if}>May</option> 
								  <option value="6"{if $Month == 6} selected{/if}>June</option> 
								  <option value="7"{if $Month == 7} selected{/if}>July</option> 
								  <option value="8"{if $Month == 8} selected{/if}>August</option> 
								  <option value="9"{if $Month == 9} selected{/if}>September</option> 
								  <option value="10"{if $Month == 10} selected{/if}>October</option> 
								  <option value="11"{if $Month == 11} selected{/if}>November</option> 
								  <option value="12"{if $Month == 12} selected{/if}>December</option> 
								</select> 
								<select size="1" name="Day" tabindex="4"> 
{section name=EditionDays loop=$arrEditionDays} 
								  <option value="{$arrEditionDays[EditionDays]}"{if $Day == $arrEditionDays[EditionDays]} selected{/if}>{$arrEditionDays[EditionDays]}</option> 
{/section} 
								</select> 
								<select size="1" name="Year" tabindex="5"> 
{section name=EditionYears loop=$arrEditionYears} 
								  <option value="{$arrEditionYears[EditionYears]}"{if $Year == $arrEditionYears[EditionYears]} selected{/if}>{$arrEditionYears[EditionYears]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="Notes" class="body">Edition Notes:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><textarea rows="5" cols="38" name="Notes" id="Notes" tabindex="6">{$Notes}</textarea></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top">&nbsp;</td> 
		   				    <td align="right" valign="top"> 
{if $enumMode == "ADD"} 
		   				    <input type="submit" value="Add Edition" name="BTN_ADDEDITION" tabindex="7"></form> 
{else} 
							<input type="submit" value="Update Edition" name="BTN_UPDATEEDITION" tabindex="7"></form> 
{/if} 
		   				    </td> 
		   				  </tr> 
		   				</table> 
						</form>