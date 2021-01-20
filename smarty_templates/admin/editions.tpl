{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Editions</h1> 
						<blockquote> 
{if $Message != ""} 
						<p class="message">{$Message}</p> 
{/if} 
 
{include file="admin/editions_addedit.tpl"} 
 
{if $enumMode != "UPDATE"} 
 
		   				<h2>Edit An Edition</h2> 
	{if $EditErrors != ""} 
						<ul class="error">
	{section name=Error loop=$EditErrors} 
						  <li>{$EditErrors[Error]}</li>
	{/section}
						</ul> 
	{/if} 
		   				<form action="{$Action}" method="post" name="edit_edition"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<select size="1" name="EditEditionID" tabindex="8"> 
		   				  <option value="0">Select Edition</option> 
	{section name=EditEditions loop=$rstEditions} 
		{if $rstEditions[EditEditions].Ident != $BreakingNewsEditionIdent} 
						  <option value="{$rstEditions[EditEditions].Ident}">Vol. {$rstEditions[EditEditions].Volume} No. {$rstEditions[EditEditions].Number} - {$rstEditions[EditEditions].EditionDate}</option> 
		{/if} 
	{/section} 
		   				</select> 
		   				<input type="submit" value="Edit Edition" class="forminput" name="BTN_EDITEDITION" tabindex="9"> 
		   				</form> 
	{if $SetErrors != ""} 
						<ul class="error">
	{section name=Error loop=$SetErrors} 
						  <li>{$SetErrors[Error]}</li>
	{/section}
						</ul> 
	{/if} 
		   				<h2>Set Current Edition</h2> 
		   				<form action="{$Action}" method="post" name="set_edition"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<select size="1" name="SetEditionID" tabindex="10"> 
		   				  <option value="0">Select Edition</option> 
	{section name=SetEdition loop=$rstEditions} 
		{if $rstEditions[SetEdition].Ident != $BreakingNewsEditionIdent} 
						  <option value="{$rstEditions[SetEdition].Ident}"{if $rstEditions[SetEdition].Ident == $CurrentEditionIdent} selected{/if}>Vol. {$rstEditions[SetEdition].Volume} No. {$rstEditions[SetEdition].Number} - {$rstEditions[SetEdition].EditionDate}</option> 
		{/if} 
	{/section} 
		   				</select> 
		   				<input type="submit" value="Set Current Edition" name="BTN_SETEDITION" tabindex="11"> 
		   				</form> 
{/if} 
		   				</blockquote> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}