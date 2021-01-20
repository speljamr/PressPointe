{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Subscribers</h1> 
						<blockquote> 
 
						<h1>Subscriber Export</h1> 
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
 
						<table border="0" cellpadding="0" cellspacing="0"> 
						  <tr> 
						    <td align="left" valign="top"> 
{php} 
#passthru("/home/virtual/site119/fst/var/www/cgi-bin/SubscriberDump.pl",$intReturn); 
virtual("../cgi-bin/SubscriberDump.pl"); 
#echo $intReturn;
{/php} 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left" valign="top">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="right" valign="top"> 
								<form action="{$Action}" name="Export" id="Export" method="post"> 
								  <input type="submit" value="Return to Subscriber Menu" name="BTN_RETURNMENU" tabindex="1"> 
								  <input type="hidden" name="sectionName" value="{$sectionName}"> 
								</form> 
						    </td> 
						  </tr> 
						</table> 
						</blockquote> 
						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}