{include file="admin/header.tpl"} 

		    	    	<h1>Sections</h1> 
		    	    	 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<table border="0" cellpadding="3" cellspacing="0" class="data">
						  <tr>
						    <th>Section Name</th>
						    <!--<th>Sort Order</th>-->
						    <th colspan="4"></th>
						  </tr>
{section name=Sections loop=$rstSections}
						  <form action="{$Action}" method="post" name="addedit_section{$smarty.section.Sections.iteration}">
		   				  <tr> 
		   				    <td align="left" valign="top">
		   				    	{$rstSections[Sections].Name}
		   				    	<input type="hidden" name="SortOrder" value="{$rstSections[Sections].SortOrder}">
		   				    	<input type="hidden" name="sectionName" value="{$sectionName}">
		   				    </td>
		   				    <!--<td align="center" valign="top">
		   				    	<input type="text" size="2" maxlength="10" name="SortOrder" tabindex="1" id="SortOrder" value="{$rstSections[Sections].SortOrder}">
		   				    </td>-->
		   				    <td valign="top">
		   				    	<input type="hidden" name="SectionIdent" value="{$rstSections[Sections].Ident}">
{if $rstSections[Sections].SortOrder != 1}
		   				    	<input type="submit" name="BTN_MOVEUP" value="Move Up">
{/if}
		   				    </td>
		   				    <td valign="top">
{if $SectionCount != $smarty.section.Sections.iteration}
		   				    	<input type="submit" name="BTN_MOVEDOWN" value="Move Down">
{/if}
		   				    </td>
		   				    <td valign="top">
		   				    	<input type="submit" name="BTN_EDIT" value="Edit Section">
		   				    </td>
		   				    <td valign="top">
		   				    	<input type="submit" name="BTN_ADD" value="Add New Section Here">
		   				    </td>
		   				  <tr>
		   				  </form>
{/section}
		   				</table>
		   				<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p> 

{include file="admin/footer.tpl"}