{include file="admin/header.tpl"} 

		    	    	<h1>Sections</h1> 
{if $enumMode == "UPDATE"}
		    	    	<h2>Edit Section</h2>
{else}
		    	    	<h2>Add Section</h2>
{/if}

{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 

						<form action="{$Action}" method="post" name="addedit_section"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
		   				<input type="hidden" name="SortOrder" value="{$SortOrder}"> 
{if $enumMode == "UPDATE"} 
		   				<input type="hidden" name="EditSectionID" value="{$EditSectionID}"> 
{/if} 
						<table border="0" cellpadping="1" cellspacing="1">
		   				  <tr> 
		   				    <td align="left" valign="top"><label for="EditSectionName" class="body">Section Name:&nbsp;</label></td> 
		   				    <td align="left" valign="top"><input type="text" size="20" maxlength="100" name="EditSectionName" tabindex="1" id="EditSectionName" value="{$EditSectionName}"></td> 
		   				  </tr> 
		   				  <tr>
		   				    <td>&nbsp;</td>
		   				  </tr>
		   				  <tr>
		   				  	<td align="right" valign="top" colspan="2">
{if $enumMode == "UPDATE"} 
		   				  		<input type="submit" name="BTN_UPDATESECTION" value="Update Section">
{else}
		   				  		<input type="submit" name="BTN_ADDSECTION" value="Add Section">
{/if}
								<input type="submit" name="BTN_CANCEL" value="Cancel">
		   				  	</td>
		   				  </tr>
						</table>
						</form>
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 

{include file="admin/footer.tpl"} 
