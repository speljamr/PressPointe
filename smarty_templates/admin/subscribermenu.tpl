{include file="admin/header.tpl"} 
 
						<h1>Akron Bugle Subscribers</h1> 
						<blockquote> 
 
						<h1>Subscriber Management</h1> 
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
						<p class="nonstory"><a href="{$strAction}?BTN_ADD=add&sectionName={$sectionName}">Add a New Subscriber</a></p> 
						<p class="nonstory"><a href="{$strAction}?BTN_EDIT=edit&sectionName={$sectionName}">Edit an Existing Subscriber</a></p> 
						<p class="nonstory"><a href="{$strAction}?BTN_EXPORT=export&sectionName={$sectionName}">Export Subscriber Mailing Lists</a></p> 
						</blockquote> 
						</blockquote> 
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 
 
{include file="admin/footer.tpl"}