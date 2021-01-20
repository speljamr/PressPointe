{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Subscribers</h1> 
						<blockquote> 
 
{if $enumMode == "Add"} 
						<h1>Add a Subscriber</h1> 
{else} 
						<h1>Edit a Subscriber</h1> 
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
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
{if $enumMode != "Add"} 
						<input type="hidden" name="SubscriberID" value="{$SubscriberID}"> 
{/if} 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left" colspan="2"><h2>Mailing Label Information</h2></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="MailRoute" class="body">Mail Route:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="MailRoute" tabindex="1" id="MailRoute"> 
		   				    	  <option value="">Select Mail Route</option> 
 
{section name=MailRoutes loop=$rstMailRoutes} 
								  <option value="{$rstMailRoutes[MailRoutes].Ident}"{if $MailRoute == $rstMailRoutes[MailRoutes].Ident} selected{/if}>{$rstMailRoutes[MailRoutes].RouteName}</option> 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Stars" class="body">Stars:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="20" name="Stars" tabindex="2" id="Stars" value="{$Stars}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="PreSort" class="body">Pre-Sort:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="30" name="PreSort" tabindex="3" id="PreSort" value="{$PreSort}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Salutation" class="body">Salutation:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Salutation" size="1" id="Salutation" tabindex="4"> 
		   				    	  <option value="NONE">Select Salutation</option> 
		   				    	  <option value="MR"{if $Salutation == "MR"} selected{/if}>MR</option> 
		   				    	  <option value="MS"{if $Salutation == "MS"} selected{/if}>MS</option> 
		   				    	  <option value="MRS"{if $Salutation == "MRS"} selected{/if}>MRS</option> 
		   				    	  <option value="MR & MRS"{if $Salutation == "MR & MRS"} selected{/if}>MR & MRS</option> 
		   				    	  <option value="DR"{if $Salutation == "DR"} selected{/if}>DR</option> 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="FirstName" class="body">First Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="FirstName" tabindex="5" id="FirstName" value="{$FirstName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="MiddleInitial" class="body">Middle Initial:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="1" maxlength="1" name="MiddleInitial" tabindex="6" id="MiddleInitial" value="{$MiddleInitial}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="LastName" class="body">Last Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="LastName" tabindex="7" id="LastName" value="{$LastName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Company" class="body">Company Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="Company" tabindex="8" id="Company" value="{$Company}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Title" class="body">Title:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="40" name="Title" tabindex="9" id="Title" value="{$Title}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Office" class="body">Office:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="40" name="Office" tabindex="10" id="Office" value="{$Office}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="StreetNumber" class="body">Street Number:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="5" maxlength="10" name="StreetNumber" tabindex="11" id="StreetNumber" value="{$StreetNumber}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="StreetName" class="body">Street Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="40" name="StreetName" tabindex="12" id="StreetName" value="{$StreetName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="City" class="body">City:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="City" tabindex="13" id="City" value="{$City}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="State" class="body">State:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="State" size="1" id="State" tabindex="14"> 
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
		   				    <td align="left"><input type="text" size="5" maxlength="5" name="ZipCode" tabindex="15" id="ZipCode" value="{$ZipCode}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="ZipCodePlus4" tabindex="16" id="ZipCodePlus4" value="{$ZipCodePlus4}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="AddressSequence" class="body">Address Sequence:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="4" maxlength="4" name="AddressSequence" tabindex="17" id="AddressSequence" value="{$AddressSequence}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Zone" class="body">Zone:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="10" maxlength="10" name="Zone" tabindex="18" id="Zone" value="{$Zone}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Sort" class="body">Sort:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="5" maxlength="5" name="Sort" tabindex="19" id="Sort" value="{$Sort}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2"><h2>Subscription Information</h2></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="ExpirationDateMonth" class="body">Expiration Date:&nbsp;</label></td> 
		   				    <td align="left" valign="top"> 
								<select size="1" name="ExpirationDateMonth" tabindex="20" id="ExpirationDateMonth"> 
								  <option value="">&nbsp;</option> 
								  <option value="1"{if $ExpirationDateMonth == 1} selected{/if}>January</option> 
								  <option value="2"{if $ExpirationDateMonth == 2} selected{/if}>February</option> 
								  <option value="3"{if $ExpirationDateMonth == 3} selected{/if}>March</option> 
								  <option value="4"{if $ExpirationDateMonth == 4} selected{/if}>April</option> 
								  <option value="5"{if $ExpirationDateMonth == 5} selected{/if}>May</option> 
								  <option value="6"{if $ExpirationDateMonth == 6} selected{/if}>June</option> 
								  <option value="7"{if $ExpirationDateMonth == 7} selected{/if}>July</option> 
								  <option value="8"{if $ExpirationDateMonth == 8} selected{/if}>August</option> 
								  <option value="9"{if $ExpirationDateMonth == 9} selected{/if}>September</option> 
								  <option value="10"{if $ExpirationDateMonth == 10} selected{/if}>October</option> 
								  <option value="11"{if $ExpirationDateMonth == 11} selected{/if}>November</option> 
								  <option value="12"{if $ExpirationDateMonth == 12} selected{/if}>December</option> 
								</select> 
								<select size="1" name="ExpirationDateDay" tabindex="21"> 
								  <option value="">&nbsp;</option> 
{section name=ExpirationDateDay loop=$arrDays} 
								  <option value="{$arrDays[ExpirationDateDay]}"{if $ExpirationDateDay == $arrDays[ExpirationDateDay]} selected{/if}>{$arrDays[ExpirationDateDay]}</option> 
{/section} 
								</select> 
								<select size="1" name="ExpirationDateYear" tabindex="22"> 
								  <option value="">&nbsp;</option> 
{section name=ExpirationDateYear loop=$arrExpirationDateYears} 
								  <option value="{$arrExpirationDateYears[ExpirationDateYear]}"{if $ExpirationDateYear == $arrExpirationDateYears[ExpirationDateYear]} selected{/if}>{$arrExpirationDateYears[ExpirationDateYear]}</option> 
{/section} 
								</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="SubscriptionType" class="body">Subscription Type:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="SubscriptionType" tabindex="23" id="SubscriptionType"> 
		   				    	  <option value="">Select Subscription Type</option> 
{section name=SubscriptionTypes loop=$rstSubscriptionTypes} 
								  <option value="{$rstSubscriptionTypes[SubscriptionTypes].Ident}"{if $SubscriptionType == $rstSubscriptionTypes[SubscriptionTypes].Ident} selected{/if}>{$rstSubscriptionTypes[SubscriptionTypes].Name}</option> 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left">&nbsp;</td> 
		   				    <td align="left"><label for="GiftGiver" class="body">If the subscription is a gift, who gave the gift?&nbsp;</label></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left">&nbsp;</td> 
		   				    <td align="left"><input type="text" size="50" maxlength="100" name="GiftGiver" tabindex="24" id="GiftGiver" value="{$GiftGiver}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2"><h2>Online Account Information</h2></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
{if $enumMode != "Add"} 
		   				  <tr> 
		   				    <td align="left"><label for="Status" class="body">Status:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="Status" tabindex="25" id="Status"> 
		   				    	  <option value="">Select Status</option> 
		   				    	  <option value="Y"{if $Status == "Y"} selected{/if}>Active</option> 
		   				    	  <option value="N"{if $Status == "N"} selected{/if}>Inactive</option> 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
{/if} 
		   				  <tr> 
		   				    <td align="left"><label for="EmailAddress" class="body">Email Address:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="100" name="EmailAddress" tabindex="26" id="EmailAddress" value="{$EmailAddress}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="right" colspan="2"> 
{if $enumMode == "Add"} 
		   				    <input type="submit" value="Add Subscriber" name="BTN_ADDSUBSCRIBER" tabindex="27"> 
{else} 
							<input type="submit" value="Update Subscriber" name="BTN_UPDATESUBSCRIBER" tabindex="27"> 
{/if} 
		   				    &nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="28"></form></td> 
		   				  </tr> 
		   				</table> 
		   				</blockquote> 
						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
						 
{include file="admin/footer.tpl"}