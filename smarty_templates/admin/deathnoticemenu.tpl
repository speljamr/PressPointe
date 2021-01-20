{include file="admin/header.tpl"} 
 
						<h1>Death Notice Management</h1> 
{if $Message != ""} 
						<p class="message">{$Message}</p> 
{/if} 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<blockquote> 
						<p class="nonstory"><a href="{$Action}?BTN_ADD=add&sectionName=obituaries">Add a New Death Notice</a></p> 
						<p class="nonstory"><a href="{$Action}?BTN_EDIT=edit&sectionName=obituaries">Edit an Existing Death Notice</a></p> 
						</blockquote> 
						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}