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
{if $sectionid == $DeathNoticeID} 
	{if $ObituaryCount > 0} 
		{section name=Obituaries loop=$rstObituaries} 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<a href="/story.php?sectionid={$DeathNoticeID}&storyid={$rstObituaries[Obituaries].Ident}&editionid={$CurrentEditionID}" class="title">{$rstObituaries[Obituaries].FullName}</a> 
						    	<p>{$rstObituaries[Obituaries].Summary}</p> 
						    </td> 
						  </tr> 
		{/section} 
	{else} 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
								<p class="nonstory">There are no Death Notices for this edition of the Akron Bugle.</p></td> 
						  </tr> 
	{/if} 
{else} 
	{if $StoryCount <= 0} 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<p class="nonstory">There are no articles for the {$strSectionName} section in this edition of the Akron Bugle.</p></td> 
						  </tr> 
	{elseif $StoryCount > 1} 
		{section name=Stories loop=$rstStories} 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
			{if $rstStories[Stories].SummaryPic != ""} 
								<a href="/story.php?sectionid={$rstStories[Stories].SectionIdent}&storyid={$rstStories[Stories].Ident}&editionid={$CurrentEditionID}"><img src="{$rstStories[Stories].SummaryPic}" width="100" height="120" class="summary" align="left" hspace="5" vspace="3"></a> 
			{/if} 
								<a href="/story.php?sectionid={$rstStories[Stories].SectionIdent}&storyid={$rstStories[Stories].Ident}&editionid={$CurrentEditionID}" class="title">{$rstStories[Stories].Title}</a> 
								<p class="nonstory">{$rstStories[Stories].Summary}</p></td> 
						  </tr> 
		{/section} 
	{else} 
						  <tr> 
						    <td align="left" colspan="2"> 
		{if $rstStories[0].Title != $strSectionName} 
						    	<h1>{$rstStories[0].Title}</h1> 
		{/if} 
		{if $rstStories[0].Author != ""} 
								<span class="nonstory">by {$rstStories[0].Author}</span> 
		{/if} 
						    	</td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	{$rstStories[0].Story} 
						    	<a href="/index.php"><img src="http://akronbugle.com/images/Emoticons/i-bugle.gif" align="right" border="0"></a></td> 
						  </tr> 
	{/if} 
{/if} 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}