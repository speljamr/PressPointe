{include file="email/header.tpl"} 

		<table border="0" cellpadding="0" cellspacing="0"> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		  <tr> 
		    <td align="left"> 
		    	<h1>Subscriber Address Change</h1> 
		    	<p class="nonstory">The following individual has indicated that their mailing address has changed. Please use the following information to update your subscription database.</p> 
		    	<p class="nonstory"> 
		    	{$Name}<br> 
		    	{$Address1}<br> 
{if $Address2 != ""}
			{$Address2}<br> 
{/if} 
		    	{$City}, {$State} {$ZipCode}{if $ZipCodePlus4 != ""}-{$ZipCodePlus4}{/if}<br><br>
		    	</p> 
		    </td> 
		  </tr> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		</table>
		
{include file="email/footer.tpl"} 