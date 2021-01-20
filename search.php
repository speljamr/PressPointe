<?php
############################################################################
#
# Project: PressPointe
# Filename: search.php
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
# 12/14/2003 - HTML removed and put into Smarty template - TJF
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

$bolLogButton = "Y";

require_once("includes/constants.php");
require_once(SITEINCLUDEPATH."includes/magic_quotes.php");
require_once(SITEINCLUDEPATH."includes/register_globals.php");
require_once(SITEINCLUDEPATH."includes/classes/ppublisher.class.php");

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);

$arrSections = $objPublisher->GetSectionsForMenu();

$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

require "includes/session.php";
if ($bolLogonRequired == "Y" && $bolSessionGood == "N") {

	header("Location:/logon.php?URL=$PHP_SELF&URLsectionid=$sectionid&URLstoryid=$storyid&sectionid=logon");
	
}

$CurrentEditionID = $CurrentEditionRow[Ident];

$strPageTitle = "Akron Bugle - Search the Akron Bugle";

if ($BTN_SEARCH != "") {

	if ($Keywords == "") {

		$strErrors .= "\t<li>Please enter some Keywords</li>\n";
		SearchForm($arrErrors,$PHP_SELF,$sectionid,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$Keywords,$cSessionUserName);
	} else {

		$arrSearchInfo = $objPublisher->SearchSite($Keywords,$C_DeathNoticeID,$C_ClassifiedsID,0,$C_SearchResultsPerPage,1,$C_LongDateFormat,$C_ShortDateFormat);
		
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
		SearchResults($arrErrors,$arrSearchInfo[1],$arrSearchInfo[0],$Keywords,$PHP_SELF,$sectionid,$C_BreakingNewsID,$C_SearchResultsPerPage,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$cSessionUserName);

	}

} elseif ($BTN_SEARCHPAGE != "") {

	if ($Keywords == "") {

		$strErrors .= "\t<li>Please enter some Keywords</li>\n";
		SearchForm($arrErrors,$PHP_SELF,$sectionid,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$Keywords,$cSessionUserName);

	} else {

		$intStartingRow = ($Page * $C_SearchResultsPerPage) - $C_SearchResultsPerPage;
		$arrSearchInfo = $objPublisher->SearchSite($Keywords,$C_DeathNoticeID,$C_ClassifiedsID,$intStartingRow,$C_SearchResultsPerPage,$Page,$C_LongDateFormat,$C_ShortDateFormat);
		
		$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
		
		SearchResults($arrErrors,$arrSearchInfo[1],$arrSearchInfo[0],$Keywords,$PHP_SELF,$sectionid,$C_BreakingNewsID,$C_SearchResultsPerPage,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$cSessionUserName);

	}

} else {

	SearchForm($strErrors,$PHP_SELF,$sectionid,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,"",$cSessionUserName);

}


function SearchForm($arrErrors,$strAction,$sectionid,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$Keywords,$cSessionUserName) {

	global $objPublisher;

	$objPublisher->objTemplate_API->setTemplate("public/searchform.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$strErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("Keywords",$Keywords);
	$objPublisher->objTemplate_API->assign("cSessionUserName",$cSessionUserName);

	$objPublisher->objTemplate_API->displayTemplate();

}



function SearchResults($arrErrors,$arrSearchResults,$arrPageInfo,$Keywords,$strAction,$sectionid,$BreakingNewsID,$SearchResultsPerPage,$strPageTitle,$arrSections,$CurrentEditionID,$CurrentEdition,$bolLogButton,$bolSessionGood,$cSessionUserName) {

	global $objPublisher;

	$intTotalPages = $arrPageInfo[0];
	$intNextPage = $arrPageInfo[1];
	$intPreviousPage = $arrPageInfo[2];
	$intCurrentPage = $arrPageInfo[3];
	$intTotalRecords = $arrPageInfo[4];
	$intFirstResult = $arrPageInfo[5];
	$intLastResult = $arrPageInfo[6];

	$intResultCount = count($arrSearchResults);

	$index = 0;
	for($counter = 1; $counter <= $intTotalPages; $counter++) {
		$arrPages[$index] = $counter;
		$index++;
	}

	$objPublisher->objTemplate_API->setTemplate("public/searchresults.tpl");

	$objPublisher->objTemplate_API->assign("strPageTitle",$strPageTitle);
	$objPublisher->objTemplate_API->assign("sectionid",$sectionid);
	$objPublisher->objTemplate_API->assign("Errors",$arrErrors);
	$objPublisher->objTemplate_API->assign("rstSections",$arrSections);
	$objPublisher->objTemplate_API->assign("CurrentEditionID",$CurrentEditionID);
	$objPublisher->objTemplate_API->assign("CurrentEdition",$CurrentEdition);
	$objPublisher->objTemplate_API->assign("bolLogButton",$bolLogButton);
	$objPublisher->objTemplate_API->assign("bolSessionGood",$bolSessionGood);
	$objPublisher->objTemplate_API->assign("strAction",$strAction);
	$objPublisher->objTemplate_API->assign("intResultCount",$intResultCount);
	$objPublisher->objTemplate_API->assign("intFirstResult",$intFirstResult);
	$objPublisher->objTemplate_API->assign("intLastResult",$intLastResult);
	$objPublisher->objTemplate_API->assign("intTotalRecords",$intTotalRecords);
	$objPublisher->objTemplate_API->assign("intTotalPages",$intTotalPages);
	$objPublisher->objTemplate_API->assign("SearchResultsPerPage",$SearchResultsPerPage);
	$objPublisher->objTemplate_API->assign("intPreviousPage",$intPreviousPage);
	$objPublisher->objTemplate_API->assign("intNextPage",$intNextPage);
	$objPublisher->objTemplate_API->assign("arrPages",$arrPages);
	$objPublisher->objTemplate_API->assign("intCurrentPage",$intCurrentPage);
	$objPublisher->objTemplate_API->assign("arrSearchResults",$rstSearchResults);
	$objPublisher->objTemplate_API->assign("BreakingNewsID",$BreakingNewsID);
	$objPublisher->objTemplate_API->assign("rstSearchResults",$arrSearchResults);
	$objPublisher->objTemplate_API->assign("Keywords",$Keywords);
	$objPublisher->objTemplate_API->assign("cSessionUserName",$cSessionUserName);
	$objPublisher->objTemplate_API->assign("arrBanners",$arrBanners);

	$objPublisher->objTemplate_API->displayTemplate();

}
?>