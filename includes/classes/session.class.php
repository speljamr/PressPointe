<?
############################################################################
#
# Project: PressPointe
# Filename: session.class.php
# File Version: 1.10.10
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
# 01/26/2004 - Modified file to use ADOdb methods - TJF
#            - Changed name from session_class.php to session.class.php - TJF
#
# 02/11/2004 - Added Cleanup method - TJF
#            - Added objDB_API parameter to constructor - TJF
#            - Changed error handler to add error to Error array - TJF
#            - Modified calls to DB to use objDB_API methods - TJF
#
############################################################################

class session {

############################################################################
#
# Class Properties
#
############################################################################

	var $objDB_API;
	var $objTemplate_API;
	var $Errors;
	var $SQL;

############################################################################
#
# Class Constructor
#
############################################################################

	function session(&$objDB,&$objTemplate) {

		$this->Errors = array();
		$this->SQL = "";
		$this->objDB_API = $objDB;
		$this->objTemplate_API = $objTemplate;

	}

############################################################################
#
# General Methods
#
############################################################################


	function GetErrors() {

		$arrErrors = $this->Errors;
		unset($this->Errors);
		$this->Errors = array();
		return $arrErrors;

	}

	function CleanUp() {

		$this->SQL = "";

	}

############################################################################
#
# Session Methods
#
############################################################################

	function Logon($strUsername,$strPassword,$strEncodePass) {

		$this->SQL = "
SELECT
	s.Ident AS UserID,
	s.Username,
	ss.Ident AS SessionID
FROM
	subscribers s,
	subscribersessions ss
WHERE
	s.Username = '$strUsername'
	AND s.Password = ENCODE('$strPassword','$strEncodePass')
	AND s.Active = 'Y'
	AND ss.UserID = s.Ident
		";
		#echo "<pre>".$this->SQL."</pre><br>";

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		#echo $arrResult;

		if ($arrResult == "error") {

			array_push($this->Errors,"Failed on check login information");

		} else {

			$intSessionUserID = $arrResult[0][UserID];
			$intSessionID = $arrResult[0][SessionID];
			$strSessionUsername = $arrResult[0][Username];

			if($intSessionUserID != "") {

				$this->SQL = "
UPDATE
	subscribersessions
SET
	InSession = 'Y',
	SessionUpdated = NOW()
WHERE
	UserID = $intSessionUserID
	AND Ident = $intSessionID
				";
				#echo "<pre>".$this->SQL."</pre><br>";

				$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

				if ($bolSQLError == "false") {

					$this->SQL = "
UPDATE
	subscribers
SET
	LastLogin = NOW()
WHERE
	Ident = $intSessionUserID
					";
					#echo "<pre>".$this->SQL."</pre><br>";

					$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

					if ($bolSQLError == "true") {

						array_push($this->Errors,"Failed to update LastLogin in users table");

					}

					$dtmSessionLogonTime = date("Y-m-d H:i:s");
					setcookie("cSessionID",$intSessionID,0,"/");
					setcookie("cSessionUserID",$intSessionUserID,0,"/");
					setcookie("cSessionUserName",$strSessionUsername,0,"/");

				} else {

					array_push($this->Errors,"The system could not log you on at this time");

				}

			} else {

				array_push($this->Errors,"Username and Password combination are invalid");

			}

		}

		$this->CleanUp();

	}

	function Logoff($intUserID,$intSessionID) {

		$this->SQL = "
UPDATE
	subscribersessions
SET
	InSession = 'N',
	SessionUpdated = NOW()
WHERE
	UserID = $intUserID
	AND Ident = $intSessionID
		";
		#echo "<pre>".$this->SQL."</pre><br>";

		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "false") {

			setcookie("cSessionID","");
			setcookie("cSessionUserID","");

		} else {

			array_push($this->Errors,"Could not log user off system");

		}

		$this->CleanUp();

	}

	function CheckSession($intUserID,$intSessionID,$dtmTimeOut_Period) {

		$this->SQL = "
SELECT
	ss.InSession,
	UNIX_TIMESTAMP(ss.SessionUpdated) AS UpdateTime
FROM
	subscribers s,
	subscribersessions ss
WHERE
	ss.UserID = $intUserID
	AND ss.Ident = $intSessionID
	AND s.Ident = ss.UserID
	AND s.Active = 'Y'
		";
		#echo "<pre>".$this->SQL."</pre><br>";

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);

		if ($arrResult == "error") {

			array_push($this->Errors,"Database error: Unable to check session");
			$bolSessionGood = 'N';

		} else {

			$bolInSession = $arrResult[0][InSession];
			$dtmSessionUpdated = $arrResult[0][UpdateTime];

			if ($bolInSession == "Y") {

				$dtmNow = time();
				$dtmLastSessionCheck = $dtmNow - $dtmSessionUpdated;

				if ($dtmLastSessionCheck <= $dtmTimeOut_Period) {

					$this->SQL = "
UPDATE
	subscribersessions
SET
	InSession = 'Y',
	SessionUpdated = NOW()
WHERE
	UserID = $intUserID
	AND Ident = $intSessionID
					";
					#echo "<pre>".$this->SQL."</pre><br>";

					$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

					if ($bolSQLError == "false") {

						$bolSessionGood = 'Y';

					} else {

						array_push($this->Errors,"Could not update session");
						$bolSessionGood = 'N';

					}

				} else {

					$bolSessionGood = 'N';
					$this->Logoff($intUserID,$intSessionID);

				}

			} else {

				$bolSessionGood = 'N';

			}

		}

		$this->CleanUp();
		return $bolSessionGood;

	}


	function AdminLogon($strUsername,$strPassword,$strEncodePass) {

		$this->SQL = "
SELECT
	s.Ident AS UserID,
	s.Username,
	ss.Ident AS SessionID
FROM
	subscribers s,
	subscribersessions ss
WHERE
	s.Username = '$strUsername'
	AND s.Password = ENCODE('$strPassword','$strEncodePass')
	AND s.SubscriptionTypeIdent = 1
	AND s.Active = 'Y'
	AND ss.UserID = s.Ident
		";
		#echo "<pre>".$this->SQL."</pre><br>";

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		#echo $arrResult;

		if ($arrResult == "error") {

			array_push($this->Errors,"Failed on check login information");

		} else {

			$intSessionUserID = $arrResult[0][UserID];
			$intSessionID = $arrResult[0][SessionID];
			$strSessionUsername = $arrResult[0][Username];

			if($intSessionUserID != "") {

				$this->SQL = "
UPDATE
	subscribersessions
SET
	InSession = 'Y',
	SessionUpdated = NOW()
WHERE
	UserID = $intSessionUserID
	AND Ident = $intSessionID
				";
				#echo "<pre>".$this->SQL."</pre><br>";

				$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

				if ($bolSQLError == "false") {

					$this->SQL = "
UPDATE
	subscribers
SET
	LastLogin = NOW()
WHERE
	Ident = $intSessionUserID
					";
					#echo "<pre>".$this->SQL."</pre><br>";

					$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

					if ($bolSQLError == "true") {

						array_push($this->Errors,"Failed to update LastLogin in users table");

					}

					$dtmSessionLogonTime = date("Y-m-d H:i:s");
					setcookie("cSessionID",$intSessionID,0,"/");
					setcookie("cSessionUserID",$intSessionUserID,0,"/");
					setcookie("cSessionUserName",$strSessionUsername,0,"/");

				} else {

					array_push($this->Errors,"The system could not log you on at this time");

				}

			} else {

				array_push($this->Errors,"Username and Password combination are invalid");

			}

		}

		$this->CleanUp();

	}

}
?>