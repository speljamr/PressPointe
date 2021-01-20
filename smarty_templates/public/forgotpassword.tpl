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
						    <td align="left" valign="top"><h1>Forgot Password</h1></td> 
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
						    	<p>If your current account information is up-to-date you may retrieve your current password by entering your username below and clicking the 'Email My Password' button. The password will be emailed to the email address on file in your account information. If your account information is not up-to-date or does not contain an email address please write to <a href="">{mailto address="webmaster@akronbugle.com" encode="javascript"}</a></p>
						    	<form action="{$strAction}" name="ForgotPassword" id="ForgotPassword" method="post">
						    	<table cellpadding="0" cellspacing="0" border="0">
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="Email"><span class="nonstory"><b>Username:&nbsp;</b></span></label><br> 
										</td> 
									<td align="right"> 
										<input type="text" size="20" name="Email" tabindex="3" id="Email" value="{$Email}"></td> 
								  </tr>
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Email My Password" name="BTN_GETPASS" tabindex="4"></form></td> 
								  </tr> 
						    	</table>
						    </td>
						  </tr>
						</table>
						
{include file="public/footer.tpl"}