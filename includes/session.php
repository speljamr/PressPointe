<? 
######################################################## 
# 
# Project: PressPointe 
# Filename: session.php 
# Version: 1.10.01
# Copyright: ©copyright 2004 Timothy J. Finucane 
# Author: Timothy J. Finucane <speljamr@speljamr.com> 
# 
######################################################## 
 
######################################################## 
# 
# History 
# 
# 01/26/2004 - Modified file to use new session object - TJF 
# 
######################################################## 

 
if ($cSessionID != "" && $cSessionUserID != "") { 
 
	if ($BTN_LOGOUT != "") { 
 
		Logoff($cSessionID,$cSessionUserID,$C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name); 
		$bolSessionGood = 'N'; 
 
	} else { 

		$bolSessionGood = SessionCheck($cSessionID,$cSessionUserID,$C_DB_Hostname,$C_DB_Username,$C_DB_Password,$C_DB_Name,$C_TimeOut_Period); 

	} 
 
} else { 
 
	$bolSessionGood = 'N'; 
 
} 
 
function SessionCheck($intSessionID,$intUserID,$DB_Hostname,$DB_Username,$DB_Password,$DB_Name,$C_TimeOut_Period) { 
  
	global $objPublisher,$arrErrors; 
 
	$bolSessionGood = $objPublisher->objSession_API->CheckSession($intUserID,$intSessionID,$C_TimeOut_Period); 

	if ($objPublisher->objSession_API->GetErrors() != "") { 
 
		$arrErrors = $objPublisher->objSession_API->GetErrors(); 
 
	}
 
	return $bolSessionGood; 
 
} 
 
function Logoff($intSessionID,$intUserID,$DB_Hostname,$DB_Username,$DB_Password,$DB_Name) { 
 
	global $objPublisher; 
 
	$objPublisher->objSession_API->Logoff($intUserID,$intSessionID); 
 
	if ($objPublisher->objSession_API->GetErrors() != "") { 
 
		$arrErrors .= $objPublisher->objSession_API->GetErrors(); 
 
	} 
 
} 
?>