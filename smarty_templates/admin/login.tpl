{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Administration Login</h1> 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 	
						<form action="{$strAction}" name="Logon" id="Logon" method="post"> 
						<table border="0" cellpadding="0" cellspacing="0"> 
						  <tr> 
							<td align="center" colspan="2">&nbsp;<td> 
						  </tr> 
						  <tr> 
							<td align="left"> 
								<label for="UserName"><span class="nonstory"><b>Username:&nbsp;</b></span></label><br> 
								</td> 
							<td align="left"> 
								<input type="text" size="32" maxlength="32" name="Username" tabindex="3" id="UserName" value="{$Username}"></td> 
						  </tr> 
						  <tr> 
							<td align="center" colspan="2">&nbsp;<td> 
						  </tr> 
						  <tr> 
							<td align="left"> 
								<label for="Password"><span class="nonstory"><b>Password:&nbsp;</b></span></label><br> 
								</td> 
							<td align="left"> 
								<input type="password" size="32" maxlength="32" name="Password" tabindex="4" id="Password" value=""></td> 
						  </tr> 
						  <tr> 
							<td align="center" colspan="2">&nbsp;<td> 
						  </tr> 
						  <tr> 
							<td align="right" colspan="2"><input type="submit" value="Login" name="BTN_LOGIN" tabindex="5"></form></td> 
						  </tr> 
						</table> 
						</form>
	
	
{include file="admin/footer.tpl"}