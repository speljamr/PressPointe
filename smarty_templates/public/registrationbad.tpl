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
 
						    	<p class="nonstory">We are sorry you could not complete your registration.</p> 
						    	<p class="nonstory">If you are experiencing difficulties completing your online registration please contact:<br><a href="mailto:webmaster@akronbugle.com">webmaster@akronbugle.com</a>.</p> 
 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}