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
						    <td align="left" valign="top"><h1>Top Stories</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
{include file="public/editiontype.tpl"} 
						    <br>{$CurrentEdition}</span></td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2">&nbsp;<td> 
						  </tr> 
{if $intBreakingNewsCount > 0 && $bolHistoric != "True"} 
						  <tr> 
						    <td align="center" colspan="2"> 
						    	<table width="100%" cellpadding="4" cellspacing="0" border="0" class="breakingnews"> 
						    	  <tr> 
						    	    <th align="right" valign="middle" style="background-image:url(/images/mouse-red-30pxtall.gif);background-repeat:no-repeat;">{$C_BN_Title}</th> 
						    	  </tr> 
	{section name=BNStories loop=$rstBNStories} 
								  <tr> 
									<td align="left"> 
		{if $rstBNStories[BNStories].SummaryPic != ""} 
										<a href="/story.php?sectionid={$rstBNStories[BNStories].SectionIdent}&storyid={$rstBNStories[BNStories].Ident}&editionid={$C_BreakingNewsID}"><img src="{$rstBNStories[BNStories].SummaryPic}" width="100" height="120" class="summary" align="left" hspace="5" vspace="3"></a> 
		{/if} 
										<a href="/story.php?sectionid={$rstBNStories[BNStories].SectionIdent}&storyid={$rstBNStories[BNStories].Ident}&editionid={$C_BreakingNewsID}" class="title">{$rstBNStories[BNStories].Title}</a> 
										<p class="nonstory">{$rstBNStories[BNStories].Summary}</p> 
									</td> 
								  </tr> 
								  <tr> 
									<td>&nbsp;</td> 
								  </tr> 
	{/section} 
								</table></td> 
						  </tr> 
{/if} 
{section name=HPStories loop=$rstHPStories} 
	{if $smarty.section.HPStories.iteration == 1 && $intBreakingNewsCount > 0} 
						  <tr> 
						    <td align="center" colspan="2">&nbsp;<td> 
						  </tr> 
	{else} 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
	{/if} 
						  <tr> 
						    <td align="left" colspan="2"> 
	{if $rstHPStories[HPStories].SummaryPic != ""} 
								<a href="/story.php?sectionid={$rstHPStories[HPStories].SectionIdent}&storyid={$rstHPStories[HPStories].Ident}&editionid={$CurrentEditionID}"><img src="{$rstHPStories[HPStories].SummaryPic}" width="100" height="120" class="summary" align="left" hspace="5" vspace="3"></a> 
	{/if} 
								<a href="/story.php?sectionid={$rstHPStories[HPStories].SectionIdent}&storyid={$rstHPStories[HPStories].Ident}&editionid={$CurrentEditionID}" class="title">{$rstHPStories[HPStories].Title}</a> 
								<p class="nonstory">{$rstHPStories[HPStories].Summary}</p> 
						    </td> 
						  </tr> 
{/section} 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- <a href="/edition_archives.php?sectionid=archives" style="color: #EEEEEE;">-</a></p></td> 
		   				  </tr> 
		   				</table> 
		   				 
{include file="public/footer.tpl"}