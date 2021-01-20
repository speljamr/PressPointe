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
 
{if $ResultCount <= 0} 
						<p class="nonstory">No subscribers were found using the search criteria you supplied.</p> 
						<form action="{$Action} name="NewSearch" id="NewSearch" method="post"> 
						<input type="hidden" name="sectionName" value="{$sectionName}"> 
						<input type="submit" value="New Search" name="BTN_EDIT" tabindex="1"><input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="2"> 
						</form> 
{else} 
						<p class="nonstory">Select the subscriber you wish to edit below:</p> 
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left" width="33%">{if $intPreviousPage > 0}<a href="{$Action}?BTN_PAGE=PreviousPage&Page={$intPreviousPage}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">< Previous</a>{/if}</td> 
		   				    <td align="middle" width="33%"> 
{section name=Page loop=$arrPages} 
	{if $arrPages[Page] != $intCurrentPage} 
								<a href="{$Action}?BTN_PAGE=PageNumber&Page={$arrPages[Page]}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">{$arrPages[Page]}</a> 
	{else} 
								<span class="nonstory"><b>{$arrPages[Page]}</b></span> 
	{/if} 
{/section} 
		   				    </td> 
		   				    <td align="right" width="33%">{if $intNextPage <= $intTotalPages}<a href="{$Action}?BTN_PAGE=NextPage&Page={$intNextPage}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">Next ></a>{/if}</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="3"> 
								<table border="0" cellpadding="4" cellspacing="0" class="data"> 
								  <tr> 
									<th>Name</th> 
									<th>Company</th> 
									<th>Address</th> 
									<th>Status</th> 
									<th>Subscription Type</th> 
									<th>Mailing Route</th> 
									<form action="{$Action}" name="NewSearch" id="NewSearch" method="post"> 
									<input type="hidden" name="sectionName" value="{$sectionName}"> 
									<th align="left" valign="top"><input type="submit" value="New Search" name="BTN_EDIT" tabindex="0"></th> 
									</form> 
								  </tr> 
{section name=Result loop=$rstResults} 
								  <tr> 
									<td>{$rstResults[Result].LastName}, {$rstResults[Result].FirstName}{if $rstResults[Result].MiddleInitial != ""}{$rstResults[Result].MiddleInitial}.{/if}</td> 
									<td>{$rstResults[Result].CompanyName}</td> 
									<td> 
										{$rstResults[Result].StreetNumber} {$rstResults[Result].StreetName}<br> 
										{$rstResults[Result].City}, {$rstResults[Result].State} {$rstResults[Result].ZipCode}{if $rstResults[Result].ZipCodePlus4 != ""}-{$rstResults[Result].ZipCodePlus4}{/if}</td> 
	{if $rstResults[Result].Active == 'Y'} 
									<td>Active</td> 
	{else} 
									<td>Inactive</td> 
	{/if} 
									<td>{$rstResults[Result].SubTypeName}</td> 
									<td>{$rstResults[Result].MailRouteName}</td> 
									<form action="{$Action}" name="EditSubscriber{$smarty.section.Result.iteration}" id="EditSubscriber{$smarty.section.Result.iteration}" method="post"> 
									<td align="left" valign="middle"> 
									<input type="hidden" value="{$rstResults[Result].Ident}" name="SubscriberID"> 
									<input type="hidden" name="sectionName" value="{$sectionName}"> 
									<input type="submit" value="Edit Subscriber" name="BTN_EDITSUBSCRIBER" tabindex="{$smarty.section.Result.iteration}"></td> 
									</form> 
								  </tr> 
{/section} 
								</table></td> 
						  </tr> 
		   				  <tr> 
		   				    <td align="left" width="33%">{if $intPreviousPage > 0}<a href="{$Action}?BTN_PAGE=PreviousPage&Page={$intPreviousPage}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">< Previous</a>{/if}</td> 
		   				    <td align="middle" width="33%"> 
{section name=Page loop=$arrPages} 
	{if $arrPages[Page] != $intCurrentPage} 
								<a href="{$Action}?BTN_PAGE=PageNumber&Page={$arrPages[Page]}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">{$arrPages[Page]}</a> 
	{else} 
								<span class="nonstory"><b>{$arrPages[Page]}</b></span> 
	{/if} 
{/section} 
		   				    </td> 
		   				    <td align="right" width="33%">{if $intNextPage <= $intTotalPages}<a href="{$Action}?BTN_PAGE=NextPage&Page={$intNextPage}&LastName={$LastName}&FirstName={$FirstName}&StreetNumber={$StreetNumber}&StreetName={$StreetName}&City={$City}&State={$State}&ZipCode={$ZipCode}&ZipCodePlus4={$ZipCodePlus4}&CompanyName={$CompanyName}&Status={$Status}&SubscriptionType={$SubscriptionType}&MailRoute={$MailRoute}&sectionName={$sectionName}">Next ></a>{/if}</td> 
		   				  </tr> 
						</table> 
{/if} 
						</blockquote> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}