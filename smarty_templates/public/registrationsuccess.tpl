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
 
						    	<p class="nonstory">Your registration is complete.</p> 
						    	<p class="nonstory">Enter your username and password below to begin reading the Akron Bugle online.</p> 
						    	<form action="/logon.php?URL=/index.php" name="Logon" id="Logon" method="post"> 
						    	<input type="hidden" name="editionid" value="{$CurrentEditionID}"> 
								<table border="0" cellpadding="0" cellspacing="0"> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="UserName"><span class="nonstory"><b>Username:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="32" maxlength="32" name="Username" tabindex="1" id="UserName" value="{$Username}"></td> 
								  </tr> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="Password"><span class="nonstory"><b>Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="password" size="32" maxlength="32" name="Password" tabindex="2" id="Password" value=""></td> 
								  </tr> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Login" name="BTN_LOGIN" tabindex="3"></form></td> 
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