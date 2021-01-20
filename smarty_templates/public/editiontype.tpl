{if $bolBreakingNews == "True"}
						    <b>Breaking News</b>
{elseif $bolHistoric == "True"}
						    <form action="/index.php" name="CurrentEdition" id="CurrentEdition" method="post">
						    	<input type="submit" name="BTN_ToCurrentEdition" value="Return to the Current Edition">
						    </form>
						    <b>Historic Edition:</b>							
{else}
						    <b>Current Edition:</b>
{/if}