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
						    <td align="left">&nbsp;</td> 
						  </tr> 
						    <td align="left"> 
						    	<p class="nonstory">Thank you for your interest in the Akron Bugle. A representative will contact you shortly with information on how to subscribe.</p> 
						    </td> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
		   				 
{include file="public/footer.tpl"}