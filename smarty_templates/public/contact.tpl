{include file="public/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
						  <tr> 
						    <td align="left" valign="top"><h1>Contact the Akron Bugle</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
{include file="public/editiontype.tpl"} 
						    <br>{$CurrentEdition}</span></td> 
						  </tr> 
						</table> 
						<blockquote><table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left"> 
						    <p class="nonstory"><b>Mailing Address:</b><br> 
						    Akron Bugle<br> 
						    7263 Downey Road<br> 
						    Akron, New York 14001</p> 
						    <p><b>Phone:</b><br> 
						    (716) 542-9615</p> 
						    <p><b>Editor/Publisher:</b><br> 
						    Marilyn J. Kasperek<br> 
						    {mailto address="editor@akronbugle.com" encode="javascript"}</p> 
						    <p><b>Advertising Manager:</b><br> 
						    Ken Kasperek<br> 
						    {mailto address="advertising@akronbugle.com" encode="javascript"}</p> 
						    <p><b>News Article Submissions:</b><br> 
						    {mailto address="news@akronbugle.com" encode="javascript"}</p> 
						    <p><b>Classified Ads:</b><br> 
						    {mailto address="classifieds@akronbugle.com" encode="javascript"}</p> 
						    <p><b>Subscription Information:</b><br> 
						    {mailto address="subscriptions@akronbugle.com" encode="javascript"}</p> 
						    <p><b>Advertising Specialilties and Social Stationary:</b><br> 
						    {mailto address="BuglePromotions@akronbugle.com" encode="javascript"}</p> 
						    <p><b>General Information:</b><br> 
						    {mailto address="info@akronbugle.com" encode="javascript"}</p> 
						    <p><b>Webmaster:</b><br> 
						    {mailto address="webmaster@akronbugle.com" encode="javascript"}</p> 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table></blockquote> 
 
{include file="public/footer.tpl"}