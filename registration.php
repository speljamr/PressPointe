<?php
############################################################################
#
# Project: PressPointe
# Filename: /registration/index.php
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
# 01/23/2003 - HTML removed and put into Smarty template - TJF
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

error_reporting (E_ERROR | E_WARNING | E_PARSE);

require_once("includes/constants.php");
require_once(SITEINCLUDEPATH."includes/magic_quotes.php");
require_once(SITEINCLUDEPATH."includes/register_globals.php");
require_once(SITEINCLUDEPATH."includes/classes/ppublisher.class.php");

#$bolLogonRequired = 'N';
$bolLogButton = 'N';

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

$arrEditions = $objPublisher->GetEditions($C_LongDateFormat);

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

$CurrentEditionID = $arrCurrentEdition[0][Ident];

if ($editionid != "") {

	if ($CurrentEditionID == $editionid) {

		$bolHistoric = "False";

	} else {

		$bolHistoric = "True";
		$arrCurrentEdition = $objPublisher->GetEdition($editionid,$C_LongDateFormat,$C_ShortDateFormat);
		$CurrentEditionID = $arrCurrentEdition[0][Ident];
		
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

	}

	$CurrentEdition = $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];

} else {

	$CurrentEdition = $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];
	$bolHistoric = "False";

}

$arrSections = $objPublisher->GetSectionsForMenu();
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

$strPageTitle = "Akron Bugle - Subscriber Registration";

if ($BTN_REGISTER != "") {

	if ($RegCode == "") {

		array_push($arrErrors,"Please enter a Registration Code");

	}

	if ($RegCode == "REG0000") {

		array_push($arrErrors,"Please enter a valid Registration Code");

	}

	if ($ZipCode == "" || !preg_match("([0-9]{5})",$ZipCode)) {

		array_push($arrErrors,"Please enter a Zip Code");

	}

	if ($ZipCodePlus4 != "" && !preg_match("([0-9]{4})",$ZipCodePlus4)) {

		array_push($arrErrors,"Please correct the Zip Plus 4");

	}

	if ($Username == "") {

		array_push($arrErrors,"Please enter a Username");

	}

	if (strlen($Username) < 3) {

		array_push($arrErrors,"A Username must be at least 3 characters long");

	}

	if ($Password == "") {

		array_push($arrErrors,"Please enter a Password");

	}

	if (strlen($Password) < 3) {

		array_push($arrErrors,"A Password must be at least 3 characters long");

	}

	if ($Password != $ConfirmPassword) {

		array_push($arrErrors,"The Password and Confirm Password fields do not match");

	}

	if (count($arrErrors) > 0) {

		RegForm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

	} else {

		$arrSubcriberInfo = $objPublisher->CheckSubscriberRegistration ($RegCode,$ZipCode,$ZipCodePlus4,$Username);
		#echo $arrSubcriberInfo."::";
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

		if (count($arrErrors) > 0) {
		
			RegForm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

		} else {
		
			RegConfirm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$arrSubcriberInfo,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

		}

	}

} elseif ($BTN_CONFIRMREGINFO != "") {

	$objPublisher->RegisterSubscriber ($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$C_EncodePass);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

	if (count($arrErrors) > 0) {

		$arrSubcriberInfo = $objPublisher->CheckSubscriberRegistration($RegCode,$ZipCode,$ZipCodePlus4,$Username);
		
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
		RegConfirm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$arrSubcriberInfo,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

	} else {

		RegComplete($Username,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

	}

} elseif ($BTN_NOCONFIRMREGINFO != "") {

	RegNotCorrect($PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

} else {

	RegForm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$PHP_SELF,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners);

}


function RegForm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$strAction,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/registration.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("bolBreakingNews",$bolBreakingNews);
	$objPublisher->objTemplate_API->assign("bolHistoric",$bolHistoric);
	$objPublisher->objTemplate_API->assign("RegCode",$RegCode);
	$objPublisher->objTemplate_API->assign("ZipCode",$ZipCode);
	$objPublisher->objTemplate_API->assign("ZipCodePlus4",$ZipCodePlus4);
	$objPublisher->objTemplate_API->assign("Username",$Username);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}



function RegConfirm($RegCode,$ZipCode,$ZipCodePlus4,$Username,$Password,$ConfirmPassword,$arrSubcriberInfo,$strAction,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners) {

	global $objPublisher;

	if ($arrSubcriberInfo[0][MiddleInitial] != "") {
	
		$strName = $arrSubcriberInfo[0][FirstName]." ".$arrSubcriberInfo[0][MiddleInitial].". ".$arrSubcriberInfo[0][LastName];
		
	} else {
	
		$strName = $arrSubcriberInfo[0][FirstName]." ".$arrSubcriberInfo[0][LastName];
		
	}

	$objPublisher->objTemplate_API->setTemplate("public/registrationconfirm.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("bolBreakingNews",$bolBreakingNews);
	$objPublisher->objTemplate_API->assign("bolHistoric",$bolHistoric);
	$objPublisher->objTemplate_API->assign("RegCode",$RegCode);
	$objPublisher->objTemplate_API->assign("ZipCode",$ZipCode);
	$objPublisher->objTemplate_API->assign("ZipCodePlus4",$ZipCodePlus4);
	$objPublisher->objTemplate_API->assign("Username",$Username);
	$objPublisher->objTemplate_API->assign("Password",$Password);
	$objPublisher->objTemplate_API->assign("ConfirmPassword",$ConfirmPassword);
	$objPublisher->objTemplate_API->assign("arrSubcriberInfo",$arrSubcriberInfo);
	$objPublisher->objTemplate_API->assign("strName",$strName);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}


function RegComplete($Username,$strAction,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/registrationsuccess.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("bolBreakingNews",$bolBreakingNews);
	$objPublisher->objTemplate_API->assign("bolHistoric",$bolHistoric);
	$objPublisher->objTemplate_API->assign("Username",$Username);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}


function RegNotCorrect($strAction,$CurrentEditionID,$strPageTitle,$sectionid,$arrErrors,$arrSections,$CurrentEdition,$bolLogButton,$bolSessionGood,$bolBreakingNews,$bolHistoric,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/registrationbad.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("bolBreakingNews",$bolBreakingNews);
	$objPublisher->objTemplate_API->assign("bolHistoric",$bolHistoric);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}
?>