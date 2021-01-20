{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Banner Ad Management</h1> 

{if $enumMode == "UPDATE"} 
		   				<h2>Edit a Banner Ad</h2>
{else}
 		   				<h2>Add a Banner Ad</h2>
{/if}
{if $Message != ""} 
						<p class="message">{$Message}</p> 
{/if} 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
		   				<form action="{$Action}" method="post" name="edit_edition"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<table>
		   				  <tr>
		   				    <td align="left"><label for="adfile" class="body">Ad File:</label>&nbsp;</td>
		   				    <td align="left"><input name="adfile" type="file" size="40" tabindex="1" id="adfile"></td>
		   				  </tr>
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="AdName" class="body">Ad Name:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><input type="text" size="30" maxlength="255" name="AdName" tabindex="2" id="AdName" value="{$AdName}"></td> 
		   				  </tr> 
		   				  <tr>
		   				    <td align="left">Zone:&nbsp;</td>
		   				    <td align="left">
		   						<select size="1" name="BannerAdZoneID" tabindex="3"> 
		   				  		<option value="0">Select Zone</option> 
{section name=Zone loop=$rstZones}
						  		<option value="{$rstZones[Zone].Ident}">{$rstZones[Zone].Name}</option> 
{/section} 
		   						</select> 
		   				    </td>
		   				  </tr>
		   				  <tr>
		   				    <td align="left">Type:&nbsp;</td>
		   				    <td align="left">
		   						<select size="1" name="BannerAdTypeID" tabindex="4"> 
		   				  		<option value="0">Select Type</option> 
{section name=Type loop=$rstTypes}
						  		<option value="{$rstTypes[Type].Ident}">{$rstTypes[Type].Name}</option> 
{/section} 
		   						</select> 
		   				    </td>
		   				  </tr>
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="AdURL" class="body">URL:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><input type="text" size="30" name="AdURL" tabindex="5" id="AdURL" value="{$AdURL}"></td> 
		   				  </tr>
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="Description" class="body">Description:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><textarea rows="5" cols="38" name="Description" id="Description" tabindex="6">{$Description}</textarea></td> 
		   				  </tr> 
		   				  <tr>
		   				    <td colspan="2">&nbsp;</td>
		   				  </tr>
		   				  <tr>
		   				  	<td align="right" valign="top" colspan="2">
{if $enumMode == "UPDATE"} 
		   				  		<input type="submit" name="BTN_UPDATEAD" value="Update Banner Ad">
{else}
		   				  		<input type="submit" name="BTN_ADDAD" value="Add Banner Ad">
{/if}
								<input type="submit" name="BTN_CANCEL" value="Cancel">
		   				  	</td>
		   				  </tr> 
{if $enumMode == "UPDATE"}
		   				  <tr>
		   				    <td colspan="2">&nbsp;</td>
		   				  </tr>
		   				  <tr>
		   				    <td align="left" colspan="2">Banner:</td>
		   				  </tr>
		   				  <tr>
		   				    <td align="left" colspan="2"><img src="{$ImagePath}{$Image}" width="{$Width}" height="{$Height}" border="0"</td>
		   				  </tr>
{/if}
		   				</table>
		   				</form>

{include file="admin/footer.tpl"}