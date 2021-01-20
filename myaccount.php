<?php
 ############################################################################
 #
 # Project: PressPointe
 # Filename: myaccount.php
 # File Version: 1.00.00
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
 # 10/30/2004 - File created
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
$bolLogonRequired = "Y";

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
$CurrentEditionID = $arrCurrentEdition[0][Ident];
$CurrentEdition = $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];

$arrSections = $objPublisher->GetSectionsForMenu();
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

require "includes/session.php";

if ($bolLogonRequired == "Y" && $bolSessionGood == "N") {

	header("Location:/logon.php?URL=$PHP_SELF&URLsectionid=$sectionid&URLstoryid=$storyid&URLeditionid=$editionid");

}

$strPageTitle = "Akron Bugle - My Account: ".$cSessionUserName;

if ($BTN_CHANGEADDRESS != "") {

	$objPublisher->SubmitAddressChange($UserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,EDITOREMAIL);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
	
	if (count($arrErrors) <= 0) {
	
		$strMessage = "Your new address has been submitted to the editor. The change should take place within 1-2 weeks.";
		
		$Address1 = "";
		$Address2 = "";
		$City = "";
		$State = "";
		$ZipCode = "";
		$ZipCodePlus4 = "";
	
	}
	
	$arrSubscriber = $objPublisher->GetSubscriber($cSessionUserID);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
	
	ShowForms($arrSubscriber,$arrErrors,$arrSections,$arrSubscriber,$strPageTitle,$sectionid,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$PHP_SELF,$strSectionName,$cSessionUserName,$cSessionUserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$strMessage,$arrBanners);

} elseif ($BTN_CHANGEPASSWORD != "") {

	ValidatePasswordForm($NewPassword,$ConfirmNewPassword);
	
	if (count($arrErrors) <= 0) {
		
		$arrPasswordResult = $objPublisher->ConfirmPassword($C_EncodePass,$CurrentPassword,$cSessionUserID);
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
			
		if (count($arrPasswordResult) == 1) {
			
			$objPublisher->ChangePassword($C_EncodePass,$NewPassword,$cSessionUserID);
			$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
				
			if (count($arrErrors) <= 0) {
				
				$strMessage = "Your password has been changed successfully.";
				
			}
			
		}
		
	}
	
	$arrSubscriber = $objPublisher->GetSubscriber($cSessionUserID);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
	ShowForms($arrSubscriber,$arrErrors,$arrSections,$arrSubscriber,$strPageTitle,$sectionid,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$PHP_SELF,$strSectionName,$cSessionUserName,$cSessionUserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$strMessage,$arrBanners);

} elseif ($BTN_CHANGEEMAIL != "") {

	if ($EmailBreakingNews == "") {
	
		$EmailBreakingNews= "N";
	
	}
	
	if ($EmailWeekly == "") {
	
		$EmailWeekly= "N";
	
	}
	
	ValidateEmailForm($Email);
	
	if (count($arrErrors) == 0) {

		$objPublisher->UpdateEmailSettings ($Email,$EmailBreakingNews,$EmailWeekly,$cSessionUserID);
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

		if (count($arrErrors) <= 0) {

			$strMessage = "Your email settings have been changed successfully.";

		}
	
	}
	
	$arrSubscriber = $objPublisher->GetSubscriber($cSessionUserID);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

	ShowForms($arrSubscriber,$arrErrors,$arrSections,$arrSubscriber,$strPageTitle,$sectionid,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$PHP_SELF,$strSectionName,$cSessionUserName,$cSessionUserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$strMessage,$arrBanners);

} else {

	$arrSubscriber = $objPublisher->GetSubscriber($cSessionUserID);
	$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

	ShowForms($arrSubscriber,$arrErrors,$arrSections,$arrSubscriber,$strPageTitle,$sectionid,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$PHP_SELF,$strSectionName,$cSessionUserName,$cSessionUserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$strMessage,$arrBanners);

}

function  ShowForms($arrSubscriber,$arrErrors,$arrSections,$arrSubscriber,$strPageTitle,$sectionid,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$strAction,$strSectionName,$SessionUserName,$SessionUserID,$Address1,$Address2,$City,$State,$ZipCode,$ZipCodePlus4,$strMessage,$arrBanners) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/myaccount.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("strSectionName",$strSectionName);
	$objPublisher->objTemplate_API->assign("UserName",$SessionUserName);
	$objPublisher->objTemplate_API->assign("rstSubscriber",$arrSubscriber);
	$objPublisher->objTemplate_API->assign("UserID",$SessionUserID);
	$objPublisher->objTemplate_API->assign("Address1",$Address1);
	$objPublisher->objTemplate_API->assign("Address2",$Address2);
	$objPublisher->objTemplate_API->assign("City",$City);
	$objPublisher->objTemplate_API->assign("State",$State);
	$objPublisher->objTemplate_API->assign("ZipCode",$ZipCode);
	$objPublisher->objTemplate_API->assign("ZipCodePlus4",$ZipCodePlus4);
	$objPublisher->objTemplate_API->assign("Message",$strMessage);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}

function ValidateEmailForm($EmailAddress) {

	global $arrErrors;
	
	if ($EmailAddress != "") {
	
		if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $EmailAddress)) {

			array_push($arrErrors,"Please enter a valid Email Address.");

		}
		
	}
	
}


function ValidatePasswordForm($Password,$ConfirmPassword) {

	global $arrErrors;

	if (strlen($Password) < 3) {

		array_push($arrErrors,"Your New Password must be at least 3 characters long");

	}

	if ($Password != $ConfirmPassword) {

		array_push($arrErrors,"The Password and Confirm Password fields do not match");

	}

}
?>