<?php
########################################################
#
# Project: PressPointe
# Filename: constants.php
# File Version: 1.10.02
# Copyright: ©copyright 2004 Timothy J. Finucane
# Author: Timothy J. Finucane <speljamr@speljamr.com>
#
########################################################

########################################################
#
# History
#
# 09/14/2003 - File added to version 1.1 - TJF
#
# 12/06/2003 - Modified constants to match new hosting environment -TJF
#
# 12/08/2004 - Added Banner Ad constants - TJF
#
########################################################

########################################################
#
# AkronBugle.com Public Constants
#
########################################################


# Web Site ######################################

define('DEFAULTURL','http://presspointe.speljamr.com');
define('SITEINCLUDEPATH','/home/speljamr/public_html/presspointe/');

#################################################

# Debugging #####################################

define('DEBUG','True');

#################################################



# Database ######################################

$C_DB_Hostname = "DB_Hostname";
$C_DB_Username = "DB_Username";
$C_DB_Password = "DB_Password";
$C_DB_Name = "DB_Name";

$C_EncodePass = "Salt_Value";
$C_TimeOut_Period = 1200;

#################################################



# Special Section ID's ##########################

$C_DeathNoticeID = 8;
$C_ClassifiedsID = 11;

#################################################



# Special Edition ID's ##########################

$C_BreakingNewsID = 9;

#################################################



# Pagination ####################################

$C_PageRows = 25;
$C_SearchResultsPerPage = 10;

#################################################



# Breaking News #################################

$C_BN_Title = "Breaking Online News";

#################################################



# Email #########################################

$C_SubscriptionEmail = "email@yourdomain.com";
define('WEBMASTEREMAIL','email@yourdomain.com');
define('EDITOREMAIL','email@yourdomain.com');
define('SENDMAILPATH','');

#################################################



# Date Formats ##################################

$C_LongDateFormat = "%M %e, %Y";
$C_ShortDateFormat = "%c/%e/%Y";

#################################################



# Template Constants ############################

define('SMARTY_DIR',SITEINCLUDEPATH.'includes/SmartyTemplate/libs/');
define('SMARTY_TEMPLATES','smarty_templates');
define('SMARTY_TEMPLATES_C','smarty_templates_c');
define('SMARTY_CONFIGS','smarty_configs');
define('SMARTY_CACHE','smarty_cache');

#################################################



# ADODB Constants ###############################

define('ADODB_DIR',SITEINCLUDEPATH.'includes/ADOdb/');

#################################################



# Banner Ad Constants ###########################

define('BANNERADSPERPAGE',2);
define('BANNERLOCATION','/banners/');

#################################################
?>