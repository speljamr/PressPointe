	{if $intTotalRecords > $SearchResultsPerPage}
 								<table border="0" class="search">
 								  <tr>
		{if $intPreviousPage > 0}
								    <td align="left"><span class="nonstory"><a href="{$strAction}?BTN_SEARCHPAGE=PreviousPage&Page={$intPreviousPage}&Keywords={$Keywords}&sectionid=search">< Previous</a></span></td>
		{/if}

		{section name=Page loop=$arrPages}
			{if $arrPages[Page] != $intCurrentPage}
								    <td><span class="nonstory"><a href="{$strAction}?BTN_SEARCHPAGE=PageNumber&Page={$arrPages[Page]}&Keywords={$Keywords}&sectionid=search">{$arrPages[Page]}</a></span></td>
			{else}
								    <td class="searchSel"><span class="nonstory"><b>{$arrPages[Page]}</b></span></td>
			{/if}
		{/section}
 
		{if $intNextPage <= $intTotalPages} 
								    <td align="right"><span class="nonstory"><a href="{$strAction}?BTN_SEARCHPAGE=NextPage&Page={$intNextPage}&Keywords={$Keywords}&sectionid=search">Next ></a></span></td>
		{/if}
								  </tr>
								</table>
	{/if}