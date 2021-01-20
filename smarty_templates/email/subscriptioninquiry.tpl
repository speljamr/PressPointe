{include file="email/header.tpl"} 

		<table border="0" cellpadding="0" cellspacing="0"> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		  <tr> 
		    <td align="left"> 
		    	<h1>Subscription Inquiry</h1> 
		    	<p class="nonstory">The following individual has indicated they have an interest in subscribing to the Akron Bugle. Please contact them immediately.</p> 
		    	<p class="nonstory"> 
		    	{$Name}<br> 
		    	{$Address1}<br> 
{if $Address2 != ""}
			{$Address2}<br> 
{/if} 
		    	{$City}, {$State} {$ZipCode}<br><br> 
		    	Phone: {$Phone}<br> 
		    	Fax:   {$Fax}<br> 
		    	Email: <a href="mailto:{$Email}">{$Email}</a> 
		    	</p> 
		    </td> 
		  </tr> 
		  <tr> 
		    <td align="left">&nbsp;</td> 
		  </tr> 
		</table>
		
{include file="email/footer.tpl"} 