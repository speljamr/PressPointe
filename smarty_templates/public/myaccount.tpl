{include file="public/header.tpl"} 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left" valign="top"><h1>My Account: {$UserName}</h1></td> 
						    <td align="right" valign="top"> 
						    <span class="nonstory" style="text-align: right;"> 
{include file="public/editiondisplay.tpl"} 
						    </span></td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr>
						    <td align="left">
{if $Errors != ""} 
 						<ul class="error">
	{section name=Error loop=$Errors} 
 						  <li>{$Errors[Error]}</li>
	{/section}
 						</ul> 
{/if} 
{if $Message != ""}
								<p style="color:blue;">{$Message}</p>
{/if}
						    </td>
						  </tr>
						  <tr> 
						    <td align="left" colspan="2"> 
								<fieldset>
								<legend><b>Change My Mailing Address</b></legend>
								<p>&nbsp;</p>
						    	<p>If your mailing address has changed you may correct it below and it will be submitted to the editor for correction. Please allow 1-2 weeks for the change to take effect.</p>
						    	<form action="{$strAction}" name="ChangeAddress" id="ChangeAddress" method="post">
						    	<input type="hidden" name="UserID" id="UserID" value="{$UserID}">
						    	<p><strong>Your Current Address:</strong><br>
						    	{$rstSubscriber[0].StreetNumber}&nbsp;{$rstSubscriber[0].StreetName}<br>
						    	{$rstSubscriber[0].City},{$rstSubscriber[0].State}&nbsp;{$rstSubscriber[0].ZipCode}{if $rstSubscriber[0].ZipCodePlus4 != ""}-{$rstSubscriber[0].ZipCodePlus4}{/if}
						    	</p>
						    	<table cellpadding="0" cellspacing="0" border="0">
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="Address1"><span class="nonstory"><b>Address1:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="20" name="Address1" tabindex="6" id="Address1" value="{$Address1}"></td> 
								  </tr>
								  <tr> 
									<td align="left"> 
										<label for="Address2"><span class="nonstory"><b>Address2:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="20" name="Address2" tabindex="7" id="Address2" value="{$Address2}"></td> 
								  </tr>
								  <tr> 
									<td align="left"><label for="City"><span class="nonstory"><b>City, State, Zip Code:&nbsp;</b></span></label></td> 
									<td align="left"><input type="text" size="20" maxlength="50" name="City" tabindex="8" id="City" value="{$City}">,&nbsp;
									<select name="State" size="1" id="State" tabindex="9"> 
									  <option value=""{if $State == ""} selected{/if}></option> 
									  <option value="AK"{if $State == "AK"} selected{/if}>AK</option> 
									  <option value="AL"{if $State == "AL"} selected{/if}>AL</option> 
									  <option value="AR"{if $State == "AR"} selected{/if}>AR</option> 
									  <option value="AZ"{if $State == "AZ"} selected{/if}>AZ</option> 
									  <option value="CA"{if $State == "CA"} selected{/if}>CA</option> 
									  <option value="CO"{if $State == "CO"} selected{/if}>CO</option> 
									  <option value="CT"{if $State == "CT"} selected{/if}>CT</option> 
									  <option value="DC"{if $State == "DC"} selected{/if}>DC</option> 
									  <option value="DE"{if $State == "DE"} selected{/if}>DE</option> 
									  <option value="FL"{if $State == "FL"} selected{/if}>FL</option> 
									  <option value="GA"{if $State == "GA"} selected{/if}>GA</option> 
									  <option value="HI"{if $State == "HI"} selected{/if}>HI</option> 
									  <option value="IA"{if $State == "IA"} selected{/if}>IA</option> 
									  <option value="ID"{if $State == "ID"} selected{/if}>ID</option> 
									  <option value="IL"{if $State == "IL"} selected{/if}>IL</option> 
									  <option value="IN"{if $State == "IN"} selected{/if}>IN</option> 
									  <option value="KS"{if $State == "KS"} selected{/if}>KS</option> 
									  <option value="KY"{if $State == "KY"} selected{/if}>KY</option> 
									  <option value="LA"{if $State == "LA"} selected{/if}>LA</option> 
									  <option value="MA"{if $State == "MA"} selected{/if}>MA</option> 
									  <option value="MD"{if $State == "MD"} selected{/if}>MD</option> 
									  <option value="ME"{if $State == "ME"} selected{/if}>ME</option> 
									  <option value="MI"{if $State == "MI"} selected{/if}>MI</option> 
									  <option value="MN"{if $State == "MN"} selected{/if}>MN</option> 
									  <option value="MO"{if $State == "MO"} selected{/if}>MO</option> 
									  <option value="MS"{if $State == "MS"} selected{/if}>MS</option> 
									  <option value="MT"{if $State == "MT"} selected{/if}>MT</option> 
									  <option value="NC"{if $State == "NC"} selected{/if}>NC</option> 
									  <option value="ND"{if $State == "ND"} selected{/if}>ND</option> 
									  <option value="NE"{if $State == "NE"} selected{/if}>NE</option> 
									  <option value="NH"{if $State == "NH"} selected{/if}>NH</option> 
									  <option value="NJ"{if $State == "NJ"} selected{/if}>NJ</option> 
									  <option value="NM"{if $State == "NM"} selected{/if}>NM</option> 
									  <option value="NY"{if $State == "NY"} selected{/if}>NY</option> 
									  <option value="NV"{if $State == "NV"} selected{/if}>NV</option> 
									  <option value="OH"{if $State == "OH"} selected{/if}>OH</option> 
									  <option value="OK"{if $State == "OK"} selected{/if}>OK</option> 
									  <option value="OR"{if $State == "OR"} selected{/if}>OR</option> 
									  <option value="PA"{if $State == "PA"} selected{/if}>PA</option> 
									  <option value="RI"{if $State == "RI"} selected{/if}>RI</option> 
									  <option value="SC"{if $State == "SC"} selected{/if}>SC</option> 
									  <option value="SD"{if $State == "SD"} selected{/if}>SD</option> 
									  <option value="TN"{if $State == "TN"} selected{/if}>TN</option> 
									  <option value="TX"{if $State == "TX"} selected{/if}>TX</option> 
									  <option value="UT"{if $State == "UT"} selected{/if}>UT</option> 
									  <option value="VT"{if $State == "VT"} selected{/if}>VT</option> 
									  <option value="VA"{if $State == "VA"} selected{/if}>VA</option> 
									  <option value="WA"{if $State == "WA"} selected{/if}>WA</option> 
									  <option value="WI"{if $State == "WI"} selected{/if}>WI</option> 
									  <option value="WV"{if $State == "WV"} selected{/if}>WV</option> 
									  <option value="WY"{if $State == "WY"} selected{/if}>WY</option> 
									</select>&nbsp;
									<input type="text" size="5" maxlength="5" name="ZipCode" tabindex="10" id="ZipCode" value="{$ZipCode}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="ZipCodePlus4" tabindex="11" id="ZipCodePlus4" value="{$ZipCodePlus4}">
									</td> 
								  </tr>
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Change My Address" name="BTN_CHANGEADDRESS" tabindex="12"></form></td> 
								  </tr> 
						  		</table>
						  		</fieldset>
						  		<p>&nbsp;</p>
								<fieldset>
								<legend><b>Change My Password</b></legend>
								<p>&nbsp;</p>
						    	<p>To change your password enter your current password, and the new password you would like, and click 'Change My Password'.</p>
						    	<form action="{$strAction}" name="ChangePassword" id="ChangePassword" method="post">
						    	<table cellpadding="0" cellspacing="0" border="0">
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="CurrentPassword"><span class="nonstory"><b>Current Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="right"> 
										<input type="password" size="20" name="CurrentPassword" tabindex="13" id="CurrentPassword" value=""></td> 
								  </tr>
								  <tr> 
									<td align="left"> 
										<label for="NewPassword"><span class="nonstory"><b>New Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="right"> 
										<input type="password" size="20" name="NewPassword" tabindex="14" id="NewPassword" value=""></td> 
								  </tr>
								  <tr> 
									<td align="left"> 
										<label for="ConfirmNewPassword"><span class="nonstory"><b>Confirm New Password:&nbsp;</b></span></label><br> 
										</td> 
									<td align="right"> 
										<input type="password" size="20" name="ConfirmNewPassword" tabindex="15" id="ConfirmNewPassword" value=""></td> 
								  </tr>
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="right" colspan="2"><input type="submit" value="Change My Password" name="BTN_CHANGEPASSWORD" tabindex="16"></form></td> 
								  </tr> 
						  		</table>
						  		</fieldset>
						  		<p>&nbsp;</p>
						  		<fieldset>
								<legend><b>Change My Email Address & Email Alerts</b></legend>
								<p>&nbsp;</p>
						    	<p>Modify your current email address and email alert settings.</p>
						    	<form action="{$strAction}" name="ChangeEmail" id="ChangeEmail" method="post">
						    	<table cellpadding="0" cellspacing="0" border="0">
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
									<td align="left"> 
										<label for="Email"><span class="nonstory"><b>Email Address:&nbsp;</b></span></label><br> 
										</td> 
									<td align="left"> 
										<input type="text" size="40" name="Email" tabindex="17" id="Email" value="{$rstSubscriber[0].EmailAddress}"></td> 
								  </tr>
								  <tr> 
									<td align="left">&nbsp;</td> 
									<td align="left"> 
										<input type="checkbox" name="EmailBreakingNews" tabindex="18" id="EmailBreakingNews" value="Y"{if $rstSubscriber[0].BreakingNewsAlert == "Y"} checked{/if}>&nbsp;<label for="EmailBreakingNews"><span class="nonstory">Email me Breaking News alerts.</span></label></td> 
								  </tr>
								  <tr> 
									<td align="left">&nbsp;</td> 
									<td align="left"> 
										<input type="checkbox" name="EmailWeekly" tabindex="19" id="EmailWeekly" value="Y"{if $rstSubscriber[0].WeeklyNewsAlert == "Y"} checked{/if}>&nbsp;<label for="EmailWeekly"><span class="nonstory">Email me when each new weekly edition is available.</span></label></td> 
								  </tr>
								  <tr> 
									<td align="center" colspan="2">&nbsp;<td> 
						  		  </tr> 
								  <tr> 
								    <td>&nbsp;</td>
									<td align="left"><input type="submit" value="Change My Email Settings" name="BTN_CHANGEEMAIL" tabindex="20"></form></td> 
								  </tr> 
						  		</table>
						  		</fieldset>
						    </td>
						  </tr>
						</table>
						
{include file="public/footer.tpl"}