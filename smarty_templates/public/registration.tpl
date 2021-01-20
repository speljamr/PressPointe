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
 
						    	<!--<p class="nonstory">As a subscriber to the Akron Bugle you are entitled to full access of the Akron Bugle web site. During our trial period please use the username <b>guest</b> and the password <b>guest</b>. We will begin integrating the subscriber list with the web site very soon.</p>--> 
						    	<p class="nonstory">All subscribers of the Akron Bugle print edition are entitled to full access on the Akron Bugle web site. The online edition of the Akron Bugle will include additional content, pictures and breaking news not always found in the print edition. If you don't have a subscription to the Akron Bugle <a href="/subscribe.php?sectionid=subscribe&editionid={$CurrentEditionID}">sign up today</a> to get your local news 24/7.</p> 
						    	<p><img src="/images/MailLabel.gif" width="304" height="170" border="0"></p> 
						    	<p class="nonstory">Enter the registration code and zip code found on the mailing label of your Akron Bugle.</p> 
						    	<form action="{$strAction}" name="Registration" id="Registration" method="post"> 
						    	<input type="hidden" name="editionid" value="{$CurrentEditionID}"> 
								<table border="0" cellpadding="0" cellspacing="0"> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="RegCode"><span class="nonstory"><b>Registration Code:&nbsp;</b></span></label><br> 
										</td> 
									<td align="right"> 
										REG<input type="text" size="4" name="RegCode" tabindex="3" id="RegCode" value="{$RegCode}" maxlength="4"></td> 
								  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="ZipCode"><span class="nonstory"><b>Zip Code:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="5" maxlength="5" name="ZipCode" tabindex="4" id="ZipCode" value="{$ZipCode}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="ZipCodePlus4" tabindex="5" id="ZipCodePlus4" value="{$ZipCodePlus4}"></td> 
								  </tr> 
						  		</table> 
						    	<p class="nonstory">Enter a username and password. You will use this to login to the Akron Bugle web site each time.</p> 
								<table border="0" cellpadding="0" cellspacing="0"> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="UserName"><span class="nonstory"><b>Username:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="32" maxlength="32" name="Username" tabindex="6" id="UserName" value="{$Username}"></td> 
								  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="Password"><span class="nonstory"><b>Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="password" size="32" maxlength="32" name="Password" tabindex="7" id="Password" value=""></td> 
								  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="ConfirmPassword"><span class="nonstory"><b>Confirm Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="password" size="32" maxlength="32" name="ConfirmPassword" tabindex="8" id="ConfirmPassword" value=""></td> 
								  </tr> 
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Register" name="BTN_REGISTER" tabindex="9"></form></td> 
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