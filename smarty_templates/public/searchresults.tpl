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
						    <td align="left" valign="top"><h1>Search the Akron Bugle</h1></td> 
						  </tr> 
						</table> 
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
									<td align="left"><input type="text" size="75" name="Keywords" tabindex="5" id="Keywords" value="{$Keywords}"></td> 
								  </tr> 
								  <tr> 
								    <td align="right" colspan="2"><input type="submit" value="Search" name="BTN_SEARCH" tabindex="27"></form></td> 
								  </tr> 
								</table> 
							</td> 
						  </tr> 
						  <tr> 
						    <td align="left">&nbsp;</td> 
						  </tr> 
						  <tr> 
						    <td align="left"> 
{if $intResultCount <= 0} 
								<p class="nonstory">There are no stories matching your search criteria.</p> 
{else} 
 								<p class="nonstory"><b>Results {$intFirstResult} - {$intLastResult} of {$intTotalRecords}</b></p> 
 
{include file="public/pagination.tpl"} 
 
								<table border="0" class="search"> 
								  <tr> 
								    <td align="left">&nbsp;</td> 
								  </tr> 
	{section name=SearchResult loop=$rstSearchResults} 
								  <tr> 
								    <td align="left"> 
		{if $rstSearchResults[SearchResult].SummaryPic != ""} 
										<a href="/story.php?sectionid={$rstSearchResults[SearchResult].SectionIdent}&editionid={$rstSearchResults[SearchResult].EditionIdent}&storyid={$rstSearchResults[SearchResult].StoryIdent}"><img src="{$rstSearchResults[SearchResult].SummaryPic}" width="100" height="120" class="summary" align="left" hspace="5" vspace="3"></a> 
		{/if} 
										<p class="nonstory"><a class="search" href="/story.php?sectionid={$rstSearchResults[SearchResult].SectionIdent}&editionid={$rstSearchResults[SearchResult].EditionIdent}&storyid={$rstSearchResults[SearchResult].StoryIdent}">{$rstSearchResults[SearchResult].Title}</a><br> 
		{if $rstSearchResults[SearchResult].EditionIdent == $BreakingNewsID} 
										<b>Edition:</b> Breaking News {$rstSearchResults[SearchResult].StoryLongDate}<br> 
		{else} 
										<b>Edition:</b> Vol. {$rstSearchResults[SearchResult].Volume} No. {$rstSearchResults[SearchResult].Number} {$rstSearchResults[SearchResult].EditionLongDate}<br> 
		{/if} 
										<b>Section:</b> {$rstSearchResults[SearchResult].SectionName}<br> 
										{$rstSearchResults[SearchResult].Summary}</p> 
								    </td> 
								  </tr> 
								  <tr> 
								    <td align="left">&nbsp;</td> 
								  </tr> 
	{/section} 
								</table> 
 
{include file="public/pagination.tpl"} 
 
{/if} 
							</td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}