{include file="public/header.tpl"} 

						<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
						  <tr> 
						    <td align="left" valign="top"><h1>Subscribe to the Akron Bugle</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
{include file="public/editiondisplay.tpl"} 
						    	</span></td> 
						  </tr> 
						</table> 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr>  
						  <tr>
						    <td align="left" valign="top">
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						    </td>
						  </tr>
						  <tr> 
						    <td align="left"> 
								<p class="nonstory">If you would like to subscribe to the Akron Bugle please fill out the form below and an Akron Bugle staff member will contact you.</p> 
								<p class="nonstory"><span class="error">*</span><b>Required Fields</b></p> 
								<form action="{$strAction}" name="theForm" id="theForm" method="post"> 
								<input type="hidden" name="sectionid" value="{$sectionid}"> 
								<input type="hidden" name="editionid" value="{$CurrentEditionID}"> 
								<table cellpadding="0" cellspacing="0" border="0"> 
								  <tr> 
									<td align="left"><label for="FirstName" class="body"><span class="error">*</span>First Name:&nbsp;</label></td> 
									<td align="left"><input type="text" size="50" maxlength="50" name="FirstName" tabindex="6" id="FirstName" value="{$FirstName}"></td> 
								  </tr> 
								  <tr> 
									<td align="left"><label for="MiddleInitial" class="body">Middle Initial:&nbsp;</label></td> 
									<td align="left"><input type="text" size="1" maxlength="1" name="MiddleInitial" tabindex="7" id="MiddleInitial" value="{$MiddleInitial}"></td> 
								  </tr> 
								  <tr> 
									<td align="left"><label for="LastName" class="body"><span class="error">*</span>Last Name:&nbsp;</label></td> 
									<td align="left"><input type="text" size="50" maxlength="50" name="LastName" tabindex="8" id="LastName" value="{$LastName}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="Address1" class="body">Address 1:</label></td> 
								    <td align="left"><input type="text" size="50" maxlength="40" name="Address1" tabindex="9" id="Address1" value="{$Address1}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="Address2" class="body">Address 2:</label></td> 
								    <td align="left"><input type="text" size="50" maxlength="40" name="Address2" tabindex="10" id="Address2" value="{$Address2}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="City" class="body">City:&nbsp;</label></td> 
								    <td align="left"><input type="text" size="50" maxlength="50" name="City" tabindex="11" id="City" value="{$City}"></td> 
								  </tr> 
								  <tr> 
									<td align="left"><label for="State" class="body">State:&nbsp;</label></td> 
									<td align="left"> 
										<select name="State" size="1" id="State" tabindex="12"> 
										  <option value=""{if $State == ""} selected{/if}>Select State</option> 
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
										</select> 
									</td> 
								  </tr> 
								  <tr> 
									<td align="left"><label for="ZipCode" class="body">Zip Code:&nbsp;</label></td> 
									<td align="left"><input type="text" size="5" maxlength="5" name="ZipCode" tabindex="13" id="ZipCode" value="{$ZipCode}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="ZipCodePlus4" tabindex="14" id="ZipCodePlus4" value="{$ZipCodePlus4}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="PhoneAreaCode" class="body">Phone:&nbsp;</label></td> 
								    <td align="left">(&nbsp;<input type="text" size="3" maxlength="3" name="PhoneAreaCode" tabindex="15" id="PhoneAreaCode" value="{$PhoneAreaCode}">&nbsp;)&nbsp;<input type="text" size="3" maxlength="3" name="PhonePrefix" tabindex="16" id="PhonePrefix" value="{$PhonePrefix}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="PhoneSuffix" tabindex="17" id="PhoneSuffix" value="{$PhoneSuffix}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="FaxAreaCode" class="body">Fax:&nbsp;</label></td> 
								    <td align="left">(&nbsp;<input type="text" size="3" maxlength="3" name="FaxAreaCode" tabindex="18" id="FaxAreaCode" value="{$FaxAreaCode}">&nbsp;)&nbsp;<input type="text" size="3" maxlength="3" name="FaxPrefix" tabindex="19" id="FaxPrefix" value="{$FaxPrefix}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="FaxSuffix" tabindex="20" id="FaxSuffix" value="{$FaxSuffix}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left"><label for="Email" class="body"><span class="error">*</span>Email:&nbsp;</label></td> 
								    <td align="left"><input type="text" size="50" maxlength="50" name="Email" tabindex="21" id="Email" value="{$Email}"></td> 
								  </tr> 
								  <tr> 
								    <td align="left" colspan="2">&nbsp;</td> 
								  </tr> 
								  <tr> 
								    <td align="right" colspan="2"><input type="submit" value="Submit" name="BTN_SUBMIT" tabindex="22"></form></td> 
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