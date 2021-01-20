{include file="public/header.tpl"} 
 
{if $Errors != ""} 
						<ul class="error">
	{section name=Error loop=$Errors} 
						  <li>{$Errors[Error]}</li>
	{/section}
						</ul> 
{/if} 
						<table cellpadding="0" cellspacing="0" border="0"> 
						  <tr> 
						    <td align="left" valign="top"><h1>View Past Editions</h1></td> 
						    <td align="right" valign="top"><span class="nonstory" style="text-align: right;">&nbsp;</span></td> 
						  </tr> 
						  <tr> 
						    <td align="center" colspan="2"><hr color="#000000"><td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
						    	<p class="nonstory">Below are all the past editions available at AkronBugle.com. They are broken down by Volume number for easy selection. Simply choose the edition you wish to view and click on it.</p> 
						    	<p class="nonstory">While you are viewing one of the past editions you can return to the current edition at any time by clicking the <b>'Return to the Current Edition'</b> button in the top right corner.</p> 
{section name=EditionVolumes loop=$arrEditionVolumes} 
	{if $arrEditionVolumes[EditionVolumes].VolumeNo != 0} 
								<blockquote> 
								<p><b>Volume {$arrEditionVolumes[EditionVolumes].VolumeNo}</b><br> 
		{section name=Editions loop=$arrEditionVolumes[EditionVolumes].VolumeEditions} 
								<a href="/index.php?editionid={$arrEditionVolumes[EditionVolumes].VolumeEditions[Editions].Ident}">Vol. {$arrEditionVolumes[EditionVolumes].VolumeEditions[Editions].Volume} No. {$arrEditionVolumes[EditionVolumes].VolumeEditions[Editions].Number} - {$arrEditionVolumes[EditionVolumes].VolumeEditions[Editions].EditionDate}</a><br> 
		{/section} 
								</p> 
								</form> 
								</blockquote> 
	{/if} 
{/section} 
						    </td> 
						  </tr> 
						  <tr> 
						    <td align="left" colspan="2"> 
		   						<p class="hide">-------- --------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- -</p></td> 
		   				  </tr> 
		   				</table> 
 
{include file="public/footer.tpl"}