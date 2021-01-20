{include file="admin/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
 
{if $ResultCount <= 0} 
						<p class="nonstory">No death notices were found using the search criteria you supplied.</p> 
						<form action="{$Action}" name="NewSearch" id="NewSearch" method="post"> 
						<input type="hidden" name="sectionName" value="{$sectionName}"> 
						<input type="submit" value="New Search" name="BTN_EDIT" tabindex="1"> 
						</form> 
{else} 
						<p class="nonstory">Obituaries found based on your supplied search criteria:</p> 
		   				<table border="0" cellpadding="4" cellspacing="0" class="data"> 
		   				  <tr> 
		   				    <th align="left" valign="top">First Name</th> 
		   				    <th align="left" valign="top">Last Name</th> 
		   				    <th align="left" valign="top">Date of Birth</th> 
		   				    <th align="left" valign="top">Date of Death</th> 
		   				    <form action="{$Action}" name="NewSearch" id="NewSearch" method="post"> 
		   				    <input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				    <th align="left" valign="top"><input type="submit" value="New Search" name="BTN_EDIT" tabindex="0"></th> 
		   				    </form> 
		   				  </tr> 
{section name=Obituaries loop=$rstObituaries} 
						  <tr> 
						    <td align="left" valign="middle">{$rstObituaries[Obituaries].FirstName}</td> 
						    <td align="left" valign="middle">{$rstObituaries[Obituaries].LastName}</td> 
						    <td align="left" valign="middle">{$rstObituaries[Obituaries].DOBShortDate}</td> 
						    <td align="left" valign="middle">{$rstObituaries[Obituaries].DODShortDate}</td> 
						    <form action="{$Action}" name="EditObituary{$smarty.section.Obituaries.iteration}" id="EditObituary{$smarty.section.Obituaries.iteration}" method="post"> 
						    <td align="left" valign="top"> 
						    <input type="hidden" value="{$rstObituaries[Obituaries].Ident}" name="StoryID"> 
						    <input type="hidden" name="sectionName" value="{$sectionName}"> 
						    <input type="submit" value="Edit Death Notice" name="BTN_EDITOBITUARY" tabindex="{$smarty.section.Obituaries.iteration}"></td> 
						    </form> 
						  </tr> 
{/section} 
		   				</table> 
{/if} 
						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}