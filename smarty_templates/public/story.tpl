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
						    <td align="left" valign="top"><h1>{$strSectionName}</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
{include file="public/editiondisplay.tpl"} 
						    	</span></td> 
						  </tr> 
						  <tr> 
						    <td>&nbsp;</td> 
						  </tr> 
{if $sectionid == $DeathNoticeID} 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<h1>{$strDeceasedName}</h1> 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<p> 
	{if $rstObituary[0].DOBLongDate != ""} 
						    	<b>Date of Birth: {$rstObituary[0].DOBLongDate}</b><br> 
	{/if} 
						    	<b>Date of Death: {$rstObituary[0].DODLongDate}</b> 
						    	</p> 
						    	{$rstObituary[0].Obituary}<a href="/index.php"><img src="http://akronbugle.com/images/Emoticons/i-bugle.gif" align="right" border="0"></a></td> 
						  </tr> 
{else} 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<h1>{$rstStory[0].Title}</h1> 
	{if $rstStory[0].Author != ""} 
								<span class="nonstory">by {$rstStory[0].Author}</span> 
	{/if} 
						    	</td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	{$rstStory[0].Story}<a href="/index.php"><img src="http://akronbugle.com/images/Emoticons/i-bugle.gif" align="right" border="0"></a></td> 
						  </tr> 
{/if} 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}