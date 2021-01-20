{include file="email/header.tpl"} 

		<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		  <tr> 
		    <td align="left" valign="top"><h1>{$strSectionName}</h1></td> 
		    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
{if $bolBreakingNews == "True"}
				<b>Breaking News</b>
{elseif $bolHistoric == "True"}
				<b>Historic Edition:</b>							
{else}
				<b>Current Edition:</b>
{/if}
				<br>{$EditionDate}
			</span></td> 
		  </tr> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		  <tr> 
		    <td align="center" colspan="2"><hr color="#000000"><td> 
		  </tr> 
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
				{$BodyHTML}<a href="/index.php"><img src="http://www.akronbugle.com/images/Emoticons/i-bugle.gif" align="right" border="0"></a></td> 
		  </tr> 
		</table>
{include file="email/footer.tpl"}  