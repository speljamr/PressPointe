{include file="public/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<form action="{$strAction}" name="Logon" id="Logon" method="post"> 
						<input type="hidden" name="URL" value="{$URL}"> 
						<input type="hidden" name="URLsectionid" value="{$URLsectionid}"> 
						<input type="hidden" name="URLstoryid" value="{$URLstoryid}"> 
						<input type="hidden" name="URLeditionid" value="{$URLeditionid}"> 
						<input type="hidden" name="sectionid" value="{$sectionid}"> 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left" valign="top"><h1>Login</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;">&nbsp;</span></td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
{if $URL != ""} 
						    	<p class="nonstory">The story/section you are attempting to view requires a paid subscription to the Akron Bugle. If you already have a paid subscription enter your username and password below. If you are a subscriber to the Akron Bugle, but have not yet registered for access to this web site <a href="/registration.php?editionid={$URLeditionid}">click here</a>.</p> 
{else} 
						    	<p class="nonstory">Enter your username and password below to login to your account.</p> 
{/if} 
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
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}