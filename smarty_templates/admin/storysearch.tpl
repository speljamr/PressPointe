{include file="admin/header.tpl"} 
 
						<h1>Edit a Story</h1> 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
		   				<p class="nonstory">Please select an edition and section to find the story you wish to edit:</p> 
		   				<p> 
		   				<form action="{$Action}" name="theForm" id="theForm" method="post"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<table border="0" cellpadding="1" cellspacing="0"> 
		   				  <tr> 
		   				    <td align="left"><label for="Edition" class="body">Edition:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Edition" size="1" id="Edition" tabindex="1"> 
		   				    	  <option value="0">Select Edition</option> 
		   				    	  <option value="{$BreakingNewsEditionIdent}"{if $Edition == $BreakingNewsEditionIdent} selected{/if}>Breaking News</option> 
{section name=Editions loop=$rstEditions} 
	{if $rstEditions[Editions].Ident != $BreakingNewsEditionIdent} 
						  		  <option value="{$rstEditions[Editions].Ident}"{if $Edition == $rstEditions[Editions].Ident} selected{/if}>Vol. {$rstEditions[Editions].Volume} No. {$rstEditions[Editions].Number} - {$rstEditions[Editions].EditionDate}</option> 
	{/if} 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left"><label for="Section" class="body">Section:&nbsp;</label></td> 
		   				    <td align="left"> 
		   				    	<select name="Section" size="1" id="Section" tabindex="2"> 
		   				    	  <option value="0">Select Section</option> 
{section name=Sections loop=$rstSections} 
	{if $rstSections[Sections].Ident != $DeathNoticeSectionIdent} 
						  		  <option value="{$rstSections[Sections].Ident}"{if $Section == $rstSections[Sections].Ident} selected{/if}>{$rstSections[Sections].Name}</option> 
	{/if} 
{/section} 
		   				    	</select> 
		   				    </td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="left" colspan="2">&nbsp;</td> 
		   				  </tr> 
		   				  <tr> 
		   				    <td align="right" colspan="2"><input type="submit" value="Find Stories" name="BTN_FINDSTORIES" tabindex="3">&nbsp;<input type="submit" value="Cancel" name="BTN_CANCEL" tabindex="4">&nbsp;&nbsp;</form></td> 
		   				  </tr> 
		   				</table> 
		   				</p> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}