<?php
############################################################################
#
# Project: PressPointe
# Filename: archives.php
# File Version: 1.10.01
# Copyright: ©copyright 2004 Timothy J. Finucane
# Author: Timothy J. Finucane <speljamr@speljamr.com>
#
############################################################################

############################################################################
#
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 2 of the License, or
#  (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful, 
#  but WITHOUT ANY WARRANTY; without even the implied warranty of 
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU 
#  General Public License for more details.
#
#  You should have received a copy of the GNU General Public License along 
#  with this program; if not, write to the Free Software Foundation, Inc., 
#  59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
#
############################################################################

############################################################################
#
# File History
#
# 11/16/2003 - HTML removed and put into Smarty template - TJF
#
# 03/23/2004 - Modified to work with new inheritance model and new 
#              error handling collection - TJF
#
# 06/15/2004 - Code added to handle security concerns for magic quotes and 
#              register globals - TJF
#
# 12/08/2004 - Added getbanner.php include to produce the banner array
#              for the smarty template. - TJF
#
############################################################################

$bolLogonRequired = 'N';
$bolLogButton = 'Y';

require_once("includes/constants.php");
require_once(SITEINCLUDEPATH."includes/magic_quotes.php");
require_once(SITEINCLUDEPATH."includes/register_globals.php");
require_once(SITEINCLUDEPATH."includes/classes/ppublisher.class.php");

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrEditions = $objPublisher->GetEditions($C_LongDateFormat);

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);
$CurrentEditionID = $arrCurrentEdition[0][Ident];

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

if ($editionid != "") {

	$bolHistoric = "True";
	$arrCurrentEdition = $objPublisher->GetEdition($editionid,$C_LongDateFormat,$C_ShortDateFormat);
	$CurrentEditionID = $arrCurrentEdition[0][Ident];
	
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
	
}

$arrEditionVolumes = $objPublisher->GetEditionVolumes();

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

$VolumeCount = count($arrEditionVolumes);
sort($arrEditionVolumes);

for ($i = 0; $i <= $VolumeCount; $i++) {

	#echo $arrEditionVolumes[$i][VolumeNo]."<br>";

	if ($arrEditionVolumes[$i][VolumeNo] != 0) {

		$arrEditionVolumes[$i][VolumeEditions] = $objPublisher->GetEditionsByVolume($arrEditionVolumes[$i][VolumeNo],$C_LongDateFormat);

	}

}

$arrSections = $objPublisher->GetSectionsForMenu();

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

require "includes/session.php";
if ($bolLogonRequired == "Y" && $bolSessionGood == "N") {

	header("Location:/logon.php?URL=$PHP_SELF&URLsectionid=$sectionid&URLstoryid=$storyid&sectionid=logon");
	
}

$strPageTitle = "Akron Bugle - View Past Editions";

for ($i=1; $i<=$VolumeCount; $i++) {

	$vvButtonName = "BTN_ViewEdition".$i;
	$vvSelectName = "select_edition".$i;

	if ($$vvButtonName != "") {
	
		header("Location:/index.php?editionid=".$$vvSelectName);
		
	}

}

$objPublisher->objTemplate_API->setTemplate("public/archives.tpl");

$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
$objPublisher->objTemplate_API->assign("strAction",$PHP_SELF);
$objPublisher->objTemplate_API->assign("arrEditionVolumes",$arrEditionVolumes);
$objPublisher->objTemplate_API->assign("cSessionUserName",$cSessionUserName);
$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

$objPublisher->objTemplate_API->displayTemplate();
?>