{include file="admin/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
 
{if $ResultCount <= 0} 
						<p class="nonstory">No stories found for <b>{$StorySectionName}</b> in the <b>{$EditionDate}</b> edition</p> 
						<form action="{$Action}" name="NewSearch" id="NewSearch" method="post"> 
						<input type="hidden" name="sectionName" value="{$sectionName}"> 
						<input type="submit" value="New Search" name="BTN_EDIT" tabindex="1"> 
						</form> 
{else} 
						<p class="nonstory">Stories found for <b>{$StorySectionName}</b> in the <b>{$EditionDate}</b> edition:</p> 
		   				<table border="0" cellpadding="4" cellspacing="0" class="data"> 
		   				  <tr> 
		   				    <th align="left" valign="top">Title</th> 
		   				    <th align="left" valign="top">Author</th> 
		   				    <th align="left" valign="top">Date Entered</th> 
		   				    <form action="{$Action}" name="NewSearch" id="NewSearch" method="post"> 
		   				    <th align="left" valign="top"><input type="hidden" name="sectionName" value="{$sectionName}"><input type="submit" value="New Search" name="BTN_EDIT" tabindex="0"></th> 
		   				    </form> 
		   				  </tr> 
{section name=Stories loop=$rstStories} 
						  <tr> 
						    <td align="left" valign="middle">{$rstStories[Stories].Title}</td> 
						    <td align="left" valign="middle">{$rstStories[Stories].Author}</td> 
						    <td align="left" valign="middle">{$rstStories[Stories].StoryLongDate}</td> 
						    <form action="{$Action}" name="EditStory{$smarty.section.Stories.iteration}" id="EditStory{$smarty.section.Stories.iteration}" method="post"> 
						    <td align="left" valign="top"> 
						    <input type="hidden" value="{$rstStories[Stories].Ident}" name="StoryID"> 
						    <input type="hidden" name="sectionName" value="{$sectionName}"> 
						    <input type="submit" value="Edit Story" name="BTN_EDITSTORY" tabindex="{$smarty.section.Stories.iteration}"></td> 
						    </form> 
						  </tr> 
{/section} 
		   				</table> 
{/if} 
 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
		   				 
{include file="admin/footer.tpl"}