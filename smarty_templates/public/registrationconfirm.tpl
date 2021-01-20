{include file="public/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left" valign="top"><h1>Subscriber Registration</h1></td> 
						    <td align="right" valign="top"> 
						    <span class="nonstory" style="text-align: right;"> 
{include file="public/editiondisplay.tpl"} 
						    </span></td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
 
						    	<p class="nonstory">Please confirm that the person listed below is you.</p> 
						    	<form action="{$strAction}" name="Registration" id="Registration" method="post"> 
						    	<input type="hidden" name="editionid" value="{$CurrentEditionID}"> 
						    	<input type="hidden" name="RegCode" value="{$RegCode}"> 
						    	<input type="hidden" name="ZipCode" value="{$ZipCode}"> 
						    	<input type="hidden" name="ZipCodePlus4" value="{$ZipCodePlus4}"> 
						    	<input type="hidden" name="Username" value="{$Username}"> 
						    	<input type="hidden" name="Password" value="{$Password}"> 
						    	<input type="hidden" name="ConfirmPassword" value="{$ConfirmPassword}"> 
						    	<br><br> 
								<table border="0" cellpadding="2" cellspacing="0" class="data"> 
						  		  <tr> 
						  		    <th align="left">&nbsp;Name:&nbsp;&nbsp;</th> 
						  		    <td align="left">&nbsp;&nbsp;{$strName}</td> 
						  		  </tr> 
						  		  <tr> 
						  		    <th align="left">&nbsp;Address:&nbsp;&nbsp;</th> 
						  		    <td align="left">&nbsp;&nbsp;{$arrSubcriberInfo[0].StreetNumber}&nbsp;{$arrSubcriberInfo[0].StreetName}<br> 
						  		    &nbsp;&nbsp;{$arrSubcriberInfo[0].City},{$arrSubcriberInfo[0].State}&nbsp;{$arrSubcriberInfo[0].ZipCode}{if $arrSubcriberInfo[0].ZipCodePlus4 != ""}-{$arrSubcriberInfo[0].ZipCodePlus4}{/if}</td> 
						  		  </tr> 
						  		</table> 
						  		<table border="0" cellpadding="0" cellspacing="0"> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Yes, This Is Me" name="BTN_CONFIRMREGINFO" tabindex="6"><input type="submit" value="No, This Is Not Me" name="BTN_NOCONFIRMREGINFO" tabindex="7"></form></td> 
								  </tr> 
								</table> 
 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}