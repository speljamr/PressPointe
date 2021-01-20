<?php
############################################################################
#
# Project: PressPointe
# Filename: subscribe.php
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
# 01/12/2004 - HTML removed and put into Smarty template - TJF
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

$bolLogButton = "Y";

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrEditions = $objPublisher->GetEditions($C_LongDateFormat);

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);

$CurrentEditionID = $arrCurrentEdition[0][Ident];

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

if ($editionid != "") {

	if ($CurrentEditionID == $editionid) {
	
		$bolHistoric = "False";
		
	} else {
	
		$bolHistoric = "True";
		$arrCurrentEdition = $objPublisher->GetEdition($editionid,$C_LongDateFormat,$C_ShortDateFormat);
		$CurrentEditionID = $CurrentEditionRow[0][Ident];
		
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
	}
	
	$CurrentEdition = $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];
	
} else {

	$CurrentEdition = $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];
	$bolHistoric = "False";
	
}

$arrSections = $objPublisher->GetSectionsForMenu();
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

require "includes/session.php";
if ($bolLogonRequired == "Y" && $bolSessionGood == "N") {

	header("Location:/logon.php?URL=$PHP_SELF&URLsectionid=$sectionid&URLstoryid=$storyid&sectionid=logon");
	
}

$strPageTitle = "Akron Bugle - Subscribe to the Akron Bugle";


if($BTN_SUBMIT != "") {

	if ($FirstName == "") {

		array_push($arrErrors,"Please enter your First Name");

	}

	if ($LastName == "") {

		array_push($arrErrors,"Please enter your Last Name");

	}

	if (($ZipCode != "" && !preg_match("([0-9]{5})",$ZipCode)) || ($ZipCodePlus4 != "" && !preg_match("([0-9]{4})",$ZipCodePlus4))) {

		array_push($arrErrors,"Please enter a valid Zip Code");

	}

	if (($PhoneAreaCode != "" || $PhonePrefix != "" || $PhoneSuffix != "") && (!preg_match("([0-9]{3})",$PhoneAreaCode) || !preg_match("([0-9]{3})",$PhonePrefix) || !preg_match("([0-9]{4})",$PhoneSuffix))) {

		array_push($arrErrors,"Please enter a valid Phone Number");

	}

	if (($FaxAreaCode != "" || $FaxPrefix != "" || $FaxSuffix != "") && (!preg_match("([0-9]{3})",$FaxAreaCode) || !preg_match("([0-9]{3})",$FaxPrefix) || !preg_match("([0-9]{4})",$FaxSuffix))) {

		array_push($arrErrors,"Please enter a valid Fax Number");

	}

	if ($Email == "") {

		array_push($arrErrors,"Please enter an Email Address");

	}

	if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $Email) && $Email != "") {

		array_push($arrErrors,"Please enter a valid Email Address");

	}

	if (count($arrErrors) > 0) {

		SubscriptionForm($CurrentEdition,$arrErrors,$FirstName,$MiddleInitial,$LastName,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$PhoneAreaCode,$PhonePrefix,$PhoneSuffix,$FaxAreaCode,$FaxPrefix,$FaxSuffix,$Email,$PHP_SELF,$sectionid,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners);

	} else {

		if($MiddleInitial == "") {

			$Name = $FirstName." ".$LastName;

		} else {

			$Name = $FirstName." ".$MiddleInitial.". ".$LastName;

		}

		if($ZipCodePlus4 == "") {

			$Zip = $ZipCode;

		} else {

			$Zip = $ZipCode."-".$ZipCodePlus4;

		}

		if ($PhoneAreaCode != "" && $PhonePrefix != "" && $PhoneSuffix != "") {

			$Phone = "(".$PhoneAreaCode.") ".$PhonePrefix."-".$PhoneSuffix;

		} else {

			$Phone = "";

		}

		if ($FaxAreaCode != "" && $FaxPrefix != "" && $FaxSuffix != "") {

			$Fax = "(".$FaxAreaCode.") ".$FaxPrefix."-".$FaxSuffix;

		} else {

			$Fax = "";

		}

		$objPublisher->SubscriptionInquiry($Name,$Address1,$Address2,$City,$State,$Zip,$Phone,$Fax,$Email,$C_SubscriptionEmail);
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
		if (count($arrErrors) == 0) {

			FormSubmitted($CurrentEdition,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners);

		} else {

			SubscriptionForm($CurrentEdition,$arrErrors,$FirstName,$MiddleInitial,$LastName,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$PhoneAreaCode,$PhonePrefix,$PhoneSuffix,$FaxAreaCode,$FaxPrefix,$FaxSuffix,$Email,$PHP_SELF,$sectionid,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners);

		}

	}

} else {

	SubscriptionForm($CurrentEdition,$arrErrors,$FirstName,$MiddleInitial,$LastName,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$PhoneAreaCode,$PhonePrefix,$PhoneSuffix,$FaxAreaCode,$FaxPrefix,$FaxSuffix,$Email,$PHP_SELF,$sectionid,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners);

}




function SubscriptionForm($CurrentEdition,$arrErrors,$FirstName,$MiddleInitial,$LastName,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$PhoneAreaCode,$PhonePrefix,$PhoneSuffix,$FaxAreaCode,$FaxPrefix,$FaxSuffix,$Email,$strAction,$sectionid,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/subscribeform.tpl");

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
	$objPublisher->objTemplate_API->assign("FirstName",$FirstName);
	$objPublisher->objTemplate_API->assign("MiddleInitial",$MiddleInitial);
	$objPublisher->objTemplate_API->assign("LastName",$LastName);
	$objPublisher->objTemplate_API->assign("Address1",$Address1);
	$objPublisher->objTemplate_API->assign("Address2",$Address2);
	$objPublisher->objTemplate_API->assign("City",$City);
	$objPublisher->objTemplate_API->assign("State",$State);
	$objPublisher->objTemplate_API->assign("ZipCode",$ZipCode);
	$objPublisher->objTemplate_API->assign("ZipCodePlus4",$ZipCodePlus4);
	$objPublisher->objTemplate_API->assign("PhoneAreaCode",$PhoneAreaCode);
	$objPublisher->objTemplate_API->assign("PhonePrefix",$PhonePrefix);
	$objPublisher->objTemplate_API->assign("PhoneSuffix",$PhoneSuffix);
	$objPublisher->objTemplate_API->assign("FaxAreaCode",$FaxAreaCode);
	$objPublisher->objTemplate_API->assign("FaxPrefix",$FaxPrefix);
	$objPublisher->objTemplate_API->assign("FaxSuffix",$FaxSuffix);
	$objPublisher->objTemplate_API->assign("Email",$Email);
	$objPublisher->objTemplate_API->assign("cSessionUserName",$cSessionUserName);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}



function FormSubmitted($CurrentEdition,$bolHistoric,$arrSections,$CurrentEditionID,$bolLogButton,$bolSessionGood,$bolBreakingNews,$sectionid,$strPageTitle,$cSessionUserName,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/subscribesuccess.tpl");

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
	$objPublisher->objTemplate_API->assign("cSessionUserName",$cSessionUserName);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}
