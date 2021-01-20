{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Subscribers</h1> 
						<blockquote> 
 
						<h1>Edit a Subscriber</h1> 
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
						<p class="nonstory">Enter your search criteria below. At this time at least one field must be filled in to complete a search.</p> 
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<input type="hidden" name="StartingRow" value="{$StartingRow}"> 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left" colspan="2"><h2>Search Criteria:</h2></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="FirstName" class="body">First Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="FirstName" tabindex="1" id="FirstName" value="{$FirstName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="LastName" class="body">Last Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="LastName" tabindex="2" id="LastName" value="{$LastName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Company" class="body">Company Name:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="Company" tabindex="3" id="Company" value="{$Company}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="StreetNumber" class="body">Street Number:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="5" maxlength="10" name="StreetNumber" tabindex="4" id="StreetNumber" value="{$StreetNumber}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="StreetName" class="body">Street Number:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="40" name="StreetName" tabindex="5" id="StreetName" value="{$StreetName}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="City" class="body">City:&nbsp;</label></td> 
		   				    <td align="left"><input type="text" size="50" maxlength="50" name="City" tabindex="6" id="City" value="{$City}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="State" class="body">State:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="State" size="1" id="State" tabindex="7"> 
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
		   				    <td align="left"><input type="text" size="5" maxlength="5" name="ZipCode" tabindex="8" id="ZipCode" value="{$ZipCode}">&nbsp;-&nbsp;<input type="text" size="4" maxlength="4" name="ZipCodePlus4" tabindex="9" id="ZipCodePlus4" value="{$ZipCodePlus4}"></td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Status" class="body">Status:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="Status" tabindex="10" id="Status"> 
		   				    	  <option value="">Select Status</option> 
		   				    	  <option value="Y"{if $Status == "Y"} selected{/if}>Active</option> 
		   				    	  <option value="N"{if $Status == "N"} selected{/if}>Inactive</option> 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="SubscriptionType" class="body">Subscription Type:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="SubscriptionType" tabindex="11" id="SubscriptionType"> 
		   				    	  <option value="">Select Subscription Type</option> 
{section name=SubscriptionTypes loop=$rstSubscriptionTypes} 
								  <option value="{$rstSubscriptionTypes[SubscriptionTypes].Ident}"{if $SubscriptionType == $rstSubscriptionTypes[SubscriptionTypes].Ident} selected{/if}>{$rstSubscriptionTypes[SubscriptionTypes].Name}</option> 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="MailRoute" class="body">Mail Route:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select size="1" name="MailRoute" tabindex="12" id="MailRoute"> 
		   				    	  <option value="">Select Mail Route</option> 
{section name=MailRoutes loop=$rstMailRoutes} 
								  <option value="{$rstMailRoutes[MailRoutes].Ident}"{if $MailRoute == $rstMailRoutes[MailRoutes].Ident} selected{/if}>{$rstMailRoutes[MailRoutes].RouteName}</option> 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="right" colspan="2"><input type="submit" value="Find Subscriber(s)" name="BTN_SEARCHSUBSCRIBERS" tabindex="13">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="14"></form></td> 
		   				  </tr> 
		   				</table> 
		   				</blockquote> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}