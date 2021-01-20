{include file="admin/header.tpl"} 
 
		    	    	<h1>Top Statistics</h1> 
		    	    	 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
 
{if $rstMostPopularStory != ""} 
 
		   				<p><b>Top 10 Most Popular Stories of All Time:</b><br> 
		   				<table class="data" cellpadding="3" cellspacing="0"> 
		   				  <tr> 
		   				    <th align="left">Title</th> 
		   				    <th align="left">Edition</th> 
		   				    <th align="center">Number of Views</th> 
		   				  </tr> 
 
	{section name=MostPopularStory loop=$rstMostPopularStory} 
		 
		   				  <tr> 
		   				    <td align="left"><a href="http://www.akronbugle.com/story.php?sectionid={$rstMostPopularStory[MostPopularStory].SectionIdent}&editionid={$rstMostPopularStory[MostPopularStory].EditionIdent}&storyid={$rstMostPopularStory[MostPopularStory].StoryIdent}" target="_blank">{$rstMostPopularStory[MostPopularStory].StoryTitle}</a></td> 
		{if $rstMostPopularStory[MostPopularStory].EditionIdent == $BreakingNewsIdent} 
							<td align="left">Breaking News<br> 
							{$rstMostPopularStory[MostPopularStory].StoryLongDate}</td> 
		{else} 
		   				    <td align="left">Vol.{$rstMostPopularStory[MostPopularStory].Volume} No.{$rstMostPopularStory[MostPopularStory].Number}<br>{$rstMostPopularStory[MostPopularStory].EditionLongDate}</td> 
		{/if} 
		   				    <td align="center">{$rstMostPopularStory[MostPopularStory].HitCount}</td> 
		   				  </tr> 
		   				   
	{/section} 
 
		   				</table></p> 
{/if} 
 
{if $rstMostPopularStoryByEdition != ""} 
 
		   				<p><b>Top 10 Most Popular Stories In the Current Edition<br>({$CurrentEdition}):</b><br> 
		   				<table class="data" cellpadding="3" cellspacing="0"> 
		   				  <tr> 
		   				    <th align="left">Title</th> 
		   				    <th align="center">Number of Views</th> 
		   				  </tr> 
	{section name=MostPopularStoryCE loop=$rstMostPopularStoryByEdition} 
		   				  <tr> 
		   				    <td align="left"><a href="http://www.akronbugle.com/story.php?sectionid={$rstMostPopularStoryByEdition[MostPopularStoryCE].SectionIdent}&editionid={$rstMostPopularStoryByEdition[MostPopularStoryCE].EditionIdent}&storyid={$rstMostPopularStoryByEdition[MostPopularStoryCE].StoryIdent}" target="_blank">{$rstMostPopularStoryByEdition[MostPopularStoryCE].StoryTitle}</a></td> 
		   				    <td align="center">{$rstMostPopularStoryByEdition[MostPopularStoryCE].HitCount}</td> 
		   				  </tr> 
	{/section} 
		   				</table></p> 
 
{/if} 
 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}