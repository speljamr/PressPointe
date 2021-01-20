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
						    <td>&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<h1>404 Page Not Found</h1>   
						    	<p>The story or section you have requested does not exist on the Akron Bugle. Try entering some keywords in our site search to find what you are looking for.</p> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
		   				 
{include file="public/footer.tpl"}