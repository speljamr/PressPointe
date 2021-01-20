{include file="admin/header.tpl"} 
 
						<h1>Banner Ad Management</h1> 

{if $Message != ""} 
						<p class="message">{$Message}</p> 
{/if} 
{if $EditErrors != ""} 
						<ul class="error">
	{section name=Error loop=$EditErrors} 
						  <li>{$EditErrors[Error]}</li>
	{/section}
						</ul> 
{/if} 
		   				<form action="{$Action}" method="post" name="edit_edition"> 
		   				<input type="hidden" name="sectionName" value="{$sectionName}"> 
						<table cellpadding="0" cellspacing="0">
						  <tr>
						    <td align="left">
						    	<fieldset>
						    	  <legend>Summary</legend>
						    	  <table cellpadding="0" cellspacing="0">
						    	    <tr>
						    	      <td align="left">Active Banners:&nbsp;</td>
						    	      <td align="right"><strong>{$ActiveBannerCount}</strong></td>
						    	    </tr>
						    	    <tr>
						    	      <td align="left">Inactive Banners:&nbsp;</td>
						    	      <td align="right"><strong>{$InactiveBannerCount}</strong></td>
						    	    </tr>
						    	    <tr>
						    	      <td align="left">Banner Impresions To Date:&nbsp;</td>
						    	      <td align="right"><strong>{$HitSum}</strong></td>
						    	    </tr>
						    	    <tr>
						    	      <td align="left">Banner Clicks To Date:&nbsp;</td>
						    	      <td align="right"><strong>{$ClickSum}</strong></td>
						    	    </tr>
						    	    <tr>
						    	      <td align="left">% Click Through:&nbsp;</td>
						    	      <td align="right"><strong>{$PercentClickThrough}</strong></td>
						    	    </tr>
						    	  </table>
						    	</fieldset>
						    </td>
						    <td align="left"><img src="/images/cleardot.gif" width="10" height="1"></td>
						    <td align="left">
						    	<input type="submit" name="BTN_ZONES" value="Zones" class="forminput" tabindex="1"><br>
						    	<input type="submit" name="BTN_NEWAD" value="New Ad" class="forminput" tabindex="2"><br>
						    	<input type="submit" name="BTN_SHOWALL" value="Show All Banners" class="forminput" tabindex="3"><br>
						    	<input type="submit" name="BTN_SHOWACTIVE" value="Show Active Banners" class="forminput" tabindex="4"><br>
						    	<input type="submit" name="BTN_SHOWINACTIVE" value="Show Inactive Banners" class="forminput" tabindex="5">
						    </td>
						  </tr>
						</table>
						<p>&nbsp;</p>
						<table cellpadding="3" cellspacing="0" class="data">
						  <tr>
						    <th align="left">Name</th>
						    <th align="left">Zone</th>
						    <th align="left">Type</th>
						    <th align="left">Impressions</th>
						    <th align="left">Clicks</th>
						    <th align="left">Click %</th>
						    <th align="left">% Impressions of Total</th>
						    <th align="left">Date Added</th>
						    <th align="left">Active</th>
						  </tr>
{section name=Banners loop=$arrBannerAds} 
						  <tr>
						    <td align="left">{$arrBannerAds[Banners].Name}</td>
						    <td align="left">{$arrBannerAds[Banners].ZoneName}</td>
						    <td align="left">{$arrBannerAds[Banners].TypeName}</td>
						    <td align="right">{$arrBannerAds[Banners].Hits}</td>
						    <td align="right">{$arrBannerAds[Banners].Clicks}</td>
						    <td align="right">{$arrBannerAds[Banners].PerClicks}</td>
						    <td align="right">{$arrBannerAds[Banners].PerTotalImp}</td>
						    <td align="right">{$arrBannerAds[Banners].BannerShortDate}</td>
						    <td align="left">{$arrBannerAds[Banners].Active}</td>
						  </tr>
{/section}
						</table>
						</form>

{include file="admin/footer.tpl"}