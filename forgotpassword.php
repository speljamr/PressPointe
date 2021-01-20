  <?php
  ############################################################################
  #
  # Project: PressPointe
  # Filename: forgotpassword.php
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

$arrErrors = array();

$objPublisher = new ppublisher($C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name);

require_once(SITEINCLUDEPATH."includes/getbanner.php");

$arrCurrentEdition = $objPublisher->GetCurrentEdition($C_LongDateFormat,$C_ShortDateFormat);
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());
$CurrentEditionID = $arrCurrentEdition[0][Ident];
$LogEditionIdent = $CurrentEditionID;

$arrSections = $objPublisher->GetSectionsForMenu();
$arrSection = $objPublisher->GetSection($sectionid);
$arrErrors = array_merge($arrErrors,$objPublisher->GetErrors());

require "includes/session.php";

?>