{include file="public/header.tpl"} 
 
						<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
						  <tr> 
						    <td align="left" valign="top"><h1>Search the Akron Bugle</h1></td> 
						  </tr> 
						</table> 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left"> 
								<p class="nonstory">Enter your search criteria below and click search.</p> 
								<p class="nonstory"><span class="error">*</span><b>Required Fields</b></p> 
								<form action="{$strAction}" name="theForm" id="theForm" method="post"> 
								<input type="hidden" name="sectionid" value="{$sectionid}"> 
								<table cellpadding="0" cellspacing="0" border="0"> 
								  <tr> 
									<td align="left"><label for="Keywords" class="body"><span class="error">*</span>Keywords:&nbsp;</label></td> 
									<td align="left"><input type="text" size="75" name="Keywords" tabindex="5" id="Keywords" value="{$Keywords}" maxlength="255"></td> 
								  </tr> 
								  <tr> 
								    <td align="right" colspan="2"><input type="submit" value="Search" name="BTN_SEARCH" tabindex="27"></form></td> 
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