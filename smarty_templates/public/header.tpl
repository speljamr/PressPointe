<!-- Begin Header -->
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html lang="en-us">
<head>
<title>{$strPageTitle}</title>
<meta name="description" content="Akron Bugle">
<meta name="keywords" lang="en-us" content="akron bugle newstead ny news death notice obituary">
<meta name="Author" content="Akron Bugle">
<meta name="copyright" content="&copy; 2003 Akron Bugle">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Language" content="en-us">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<script src="/javascript/master.js" language="Javascript" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/css/master.css">
</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF" text="#000000" link="#003366" alink="#0033CC" vlink="#003366">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="left" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
		    <td align="left" valign="top" bgcolor="#595959"><a href="/index.php"><img src="/images/AkronBugleHeaderLogo.gif" width="403" height="49" alt="Akron Bugle" border="0"></a></td>
			<td align="right" valign="top" bgcolor="#595959"><img src="/images/horn_top.jpg" width="158" height="49" alt=""></td>
		  </tr>
		  <tr>
			<td align="left" bgcolor="#990000"><nobr><span class="italicboldwhite">&nbsp;&nbsp;&nbsp;"We're Working For You"</span><span class="boldwhite"> - Since 1981 - </span><span class="italicboldwhite">Your Hometown Newspaper</span></nobr></td>
			<td align="right" valign="top" bgcolor="#990000"><img src="/images/horn_middle.jpg" width="158" height="27" alt=""></td>
		  </tr>
		</table>
    </td>
  </tr>
  <tr>
    <td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
		    <td align="left" valign="top" rowspan="2" bgcolor="#C1C1C1">
		    	<!--<img src="/images/cleardot.gif" width="130" height="10" alt=""><br>-->
		    	<table border="0" cellpadding="0" cellspacing="0" width="100%">
{if $sectionid != "search"}
		    	  <tr>
		    	    <td>
		    	    	<form action="/search.php" name="Search" id="Search" method="post">
		    	    	<div class="SideSearch"><table border="0" cellpadding="0" cellspacing="0" width="127">
		    	    	  <tr>
		    	    	    <td align="center"><input type="hidden" name="sectionid" value="search">&nbsp;<td>
		    	    	  </tr>
		    	    	  <tr>
		    	    	    <td align="right">&nbsp;<input type="text" size="24" maxlength="255" name="Keywords" tabindex="1" id="Keywords" value="">&nbsp;</td>
		    	    	  </tr>
		    	    	  <tr>
		    	    	    <td align="right"><input type="submit" value="Search" name="BTN_SEARCH" tabindex="2">&nbsp;</td>
		    	    	  </tr>
		    	    	  <tr>
		    	    	    <td align="center">&nbsp;<td>
		    	    	  </tr>
		    	    	  <!--<tr>
		    	    	  	<td align="right"><a href="/archives.php" style="color: #E6E6E6; text-decoration: underline;">Select Past Editions</a><td>
		    	    	  </tr>-->
		    	    	</table></div>
		    	    	</form>
		    	    </td>
		    	  </tr>
{/if}
		    	  <tr>
		    	    <td align="right" valign="top">
		    	    	<p{if $sectionid == "home" || ($sectionid == "" && $PHP_SELF != "/registration.php" && $PHP_SELF != "/login.php" && $PHP_SELF != "/404.php")} class="SideNavSel"{else} class="SideNav"{/if}><a href="/index.php?sectionid=home&editionid={$CurrentEditionID}" class="menu">Home</a>&nbsp;</p>
{section name=Section loop=$rstSections}
		    	    	<p{if $sectionid == $rstSections[Section].Ident} class="SideNavSel"{else} class="SideNav"{/if}><a href="/section.php?sectionid={$rstSections[Section].Ident}&editionid={$CurrentEditionID}" class="menu">{$rstSections[Section].Name}</a>&nbsp;</p>
{/section}
		    	    	<p class="SideNav"><a href="/discussion/" class="menu">Discussion</a>&nbsp;</p>
		    	    	<p{if $sectionid == "archives"} class="SideNavSel"{else} class="SideNav"{/if}><a href="/archives.php?sectionid=archives&editionid={$CurrentEditionID}" class="menu">Past Editions</a>&nbsp;</p>
		    	    	<p{if $sectionid == "subscribe"} class="SideNavSel"{else} class="SideNav"{/if}><a href="/subscribe.php?sectionid=subscribe&editionid={$CurrentEditionID}" class="menu">Subscribe</a>&nbsp;</p>
		    	    	<p{if $sectionid == "ratecard"} class="SideNavSel"{else} class="SideNav"{/if}><a href="/ratecard.php?sectionid=ratecard&editionid={$CurrentEditionID}" class="menu">Rate Card</a>&nbsp;</p>
		    	    	<p{if $sectionid == "contact"} class="SideNavSel"{else} class="SideNav"{/if}><a href="/contact.php?sectionid=contact&editionid={$CurrentEditionID}" class="menu">Contact Us</a>&nbsp;</p>
{if $bolSessionGood == 'Y'}
		    	    	<p{if $sectionid == "myaccount"} class="SideNavSel"{else} class="SideNav"{/if}><a href="/myaccount.php?sectionid=myaccount&editionid={$CurrentEditionID}" class="menu">My Account</a>&nbsp;</p>
{/if}
		    	    </td>
		    	  </tr>
				  <tr>
					<td align="center">&nbsp;<td>
				  </tr>
{if $bolLogButton == 'Y'}
				   <tr>
	{if $bolSessionGood == 'N'}
					<td align="left">
						<form action="/logon.php?URL={$strAction}&amp;URLsectionid={$sectionid}&amp;URLstoryid={$storyid}&amp;URLeditionid={$CurrentEditionID}" name="Logon" id="Logon" method="post">
						<div class="SideLogon"><table border="0" cellpadding="0" cellspacing="0" width="127">
						  <tr>
							<td align="center" colspan="2">&nbsp;<td>
						  </tr>
						  <tr>
						    <td align="left"><label for="UserName"><span class="fineprint" style="color: #E6E6E6;">&nbsp;Username:&nbsp;</span></label></td>
						    <td align="right"><input type="text" size="10" maxlength="32" name="Username" tabindex="3" id="UserName" value=""></td>
						  </tr>
						  <tr>
						    <td align="left"><label for="Password"><span class="fineprint" style="color: #E6E6E6;">&nbsp;Password:&nbsp;</span></label></td>
						    <td align="right"><input type="password" size="10" maxlength="32" name="Password" tabindex="4" id="Password" value=""></td>
						  </tr>
						  <tr>
							<td align="right" colspan="2"><input type="submit" value="Login" name="BTN_LOGIN" tabindex="5"></td>
						  </tr>
						  <tr>
							<td align="center" colspan="2">&nbsp;<td>
						  </tr>
						  <tr>
							<td align="left" valign="top" colspan="2"><a href="/registration.php?editionid={$CurrentEditionID}" style="color: #E6E6E6; text-decoration: underline;">Don't have a username?<br>register here!</a><td>
						  </tr>
						  <tr>
							<td align="center" colspan="2">&nbsp;<td>
						  </tr>
						</table></div>
						</form>
	{else}
					<td align="right">
						<form action="{$strAction}" name="Logout" id="Logout" method="post">
						<div class="SideLogon"><table border="0" cellpadding="0" cellspacing="0" width="127">
						  <tr>
							<td align="center" colspan="2">&nbsp;<td>
						  </tr>
						  <tr>
						    <td align="right">
						    <span class="fineprint" style="color: #E6E6E6;">Logged in as {$cSessionUserName}</span><br>
							<input type="hidden" name="sectionid" value="{$sectionid}">
							<input type="hidden" name="storyid" value="{$storyid}">
							<input type="hidden" name="editionid" value="{$CurrentEditionID}">
							<input type="submit" value="Logout" name="BTN_LOGOUT" tabindex="3">&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" colspan="2">&nbsp;<td>
						  </tr>
						</table></div>
						</form>
	{/if}
					<td>
				  </tr>
{/if}
				  <tr>
					<td align="center">
						<a href="http://www.weatherforyou.com/weather/New York/Akron.html" target="_blank"><img src="http://www.weatherforyou.net/fcgi-bin/hw3/hw3.cgi?config=png&forecast=hourly&place=Akron&state=ny&alt=hwihourlyvert2&hwvbg=gray&hwvtc=white" width="95" height="135" style="border:1px solid #000000;"></a>
					</td>
				  </tr>
				  <tr>
					<td align="center">&nbsp;<td>
				  </tr>
		    	</table></td>
		    <td align="left" valign="top" rowspan="2" width="100%">
		    	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		    	  <tr>
		    	    <td align="left" valign="top" colspan="2"><img src="/images/cleardot.gif" width="1" height="10" alt=""></td>
		    	  </tr>
		    	  <tr>
		    	    <td align="left" valign="top"><img src="/images/cleardot.gif" width="15" height="1" alt=""></td>
		    	    <td align="left" valign="top">
<!-- End Header -->