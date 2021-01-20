{include file="email/header.tpl"}
		<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		  <tr> 
		    <td align="left" valign="top"><h1>Top Stories</h1></td> 
		    <td align="right" valign="top"><span class="nonstory" style="text-align: right;"> 
				<strong>Current Edition:</strong><br>{$EditionDate}</span></td>
		  </tr> 
		  <tr> 
		    <td align="center" colspan="2">&nbsp;<td>
		  </tr> 
		  <tr> 
		    <td align="center" colspan="2"><hr color="#000000"><td> 
		  </tr> 
		  <tr> 
		    <td align="left" colspan="2"> 
{section name=HPStories loop=$rstHPStories} 
	{if $smarty.section.HPStories.iteration != 1} 
		  <tr> 
		    <td align="center" colspan="2"><hr color="#000000"><td> 
		  </tr> 
	{/if} 
		  <tr> 
		    <td align="left" colspan="2"> 
	{if $rstHPStories[HPStories].SummaryPic != ""}
				<a href="http://www.akronbugle.com/story.php?sectionid={$rstHPStories[HPStories].SectionIdent}&storyid={$rstHPStories[HPStories].Ident}&editionid={$CurrentEditionID}"><img src="http://www.akronbugle.com{$rstHPStories[HPStories].SummaryPic}" width="100" height="120" class="summary" align="left" hspace="5" vspace="3"></a> 
	{/if}
				<a href="http://www.akronbugle.com/story.php?sectionid={$rstHPStories[HPStories].SectionIdent}&storyid={$rstHPStories[HPStories].Ident}&editionid={$CurrentEditionID}" class="title">{$rstHPStories[HPStories].Title}</a> 
				<p class="nonstory">{$rstHPStories[HPStories].Summary}</p> 
		    </td> 
		  </tr> 
{/section} 
			</td> 
		  </tr> 
		  <tr> 
		    <td align="center" colspan="2">&nbsp;<td>
		  </tr>
		</table>
{include file="email/footer.tpl"}  