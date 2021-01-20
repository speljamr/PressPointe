<? 
############################################################################ 
# 
# Project: PressPointe 
# Filename: ppublisher.class.php 
# File Version: 1.10.03
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
# 09/14/2003 - File created - TJF 
# 
# 09/20/2003 - Added CleanUp() method - TJF 
# 
# 09/21/2003 - Added extension of Template_API - TJF 
#            - Added call to Template_API constructor - TJF 
# 
# 11/17/2003 - Changed GetCurrentEdition call to GetAll method - TJF 
# 
# 01/26/2003 - Removed session methods to their own object -TJF 
#            - Put GetObituarysByEdition method back in; it was forgotten 
#              during the last refactoring - TJF 
#
# 02/21/2003 - Refactoring code to use new DB calls in db.class.php - TJF
#            - Mimiced multiple inheritance with the classInstantiation class - TJF
#
# 06/15/2004 - Added code to escape quotes on variables used in 
#              SQL statements - TJF
#
# 10/19/2004 - Added Section methods for adding, editing, and managing sections - TJF
#
# 11/16/2004 - Added methods for emailing stories, managing email settings,
#              changing passwords, and submitting address changes. They are:
#                 
#                 SubmitAddressChange
#                 EmailStory
#                 EmailWeeklyNews
#                 ConfirmPassword
#                 ChangePassword
#
#				-TJF
#
# 12/08/2004 - Added method to get a random banner ad image called GetRandomBanner - TJF
# 
############################################################################

require_once(SITEINCLUDEPATH."includes/classes/classinstantiation.class.php"); 
require_once(SITEINCLUDEPATH."includes/classes/session.class.php"); 
require_once(SITEINCLUDEPATH."includes/classes/template.class.php"); 
require_once(SITEINCLUDEPATH."includes/classes/db.class.php"); 
 
class ppublisher extends classInstantiation { 
 
######################################################## 
# 
# Class Properties 
# 
######################################################## 
 
	var $DB_Host; 
	var $DB_User; 
	var $DB_Pass; 
	var $DB_Name; 
	var $SQL; 
	var $Errors; 
	var $objTemplate_API;
	var $objSession_API;
	var $objDB_API;
 
######################################################## 
# 
# Class Constructor 
# 
######################################################## 
 
	function ppublisher($dbHost,$dbUser,$dbPass,$dbName) { 
	
		$this->Errors = array();
		$this->SQL = ""; 
		$this->objTemplate_API = parent::callClass('template',''); 
		$this->objDB_API = parent::callDBClass('db',$dbHost,$dbUser,$dbPass,$dbName);
		$this->objSession_API = parent::callSessionClass('session',$this->objDB_API,$this->objTemplate_API);
 
		if ($dbName == "") { 
		
			array_push($this->Errors,"Database Name was not passed"); 
			
		} 
		
		if ($dbHost == "") { 
		
			array_push($this->Errors,"Database Host was not passed"); 
			
		} 
		
		if ($dbUser == "") { 
		
			array_push($this->Errors,"Database User was not passed"); 
			
		} 
		
		if ($dbPass == "") { 
		
			array_push($this->Errors,"Database Password was not passed"); 
			
		} 
 
	} 
 
######################################################## 
# 
# General Methods 
# 
######################################################## 
 
	function GetErrors() { 
		
		$arrErrors = $this->Errors;
		unset($this->Errors); 
		$this->Errors = array();
		return $arrErrors; 
		
	} 
 
	function SendEmail($strMailTo,$strSubject,$strBody,$strHeaders) { 
		if (!mail($strMailTo,$strSubject,$strBody,$strHeaders,"")) { 
			array_push($this->Errors,"Email message could not be sent"); 
		} 
	} 

	function GetSessionObject() {
	
		$this->objSession_API;

	}	
	
	function GetTemplateObject() {

		return $this->objTemplate_API;

	}
	
	function GetDBObject() {

		return $this->objDB_API;

	}	
 
	function BuildFormFields($arrFieldArray) { 
		while ($field = each($arrFieldArray)) { 
			if (!strstr($field["key"],"BTN_")) { 
				$strType = gettype($field["value"]); 
				if ($strType != "array") { 
					echo "<input type=\"hidden\" name=\"".$field["key"]."\" value=\"".$field["value"]."\">\n"; 
				} else { 
					while($field2 = each($field["value"])) { 
						$strVar_Name = $field["key"].$field2["key"]; 
						echo "<input type=\"hidden\" name=\"".$strVar_Name."\" value=\"".$field2["value"]."\">\n"; 
					} 
				} 
			} 
		} 
	} 
 
	function CalculatePages($intTotalNumberOfRows,$intRowsPerPage,$intCurrentPage) { 
		$arrPageResults[0] = ceil($intTotalNumberOfRows/$intRowsPerPage); 
		$arrPageResults[1] = $intCurrentPage + 1; 
		$arrPageResults[2] = $intCurrentPage - 1; 
		$arrPageResults[3] = $intCurrentPage; 
		return $arrPageResults; 
	} 
 
	function CleanUp() { 
 
		$this->SQL = ""; 
 
	} 
 
######################################################## 
# 
# Access Log Methods 
# 
######################################################## 
 
	function AddLogEntry ($StoryIdent,$SectionIdent,$EditionIdent,$remote_addr,$http_user_agent,$request_uri,$request_method,$query_string,$script_name,$script_filename,$DateTimeRequest,$UserID) { 
	
		$remote_addr = $this->objDB_API->EscapeQuote($remote_addr);
		$http_user_agent = $this->objDB_API->EscapeQuote($http_user_agent);
		$request_uri = $this->objDB_API->EscapeQuote($request_uri);
		$request_method = $this->objDB_API->EscapeQuote($request_method);
		$query_string = $this->objDB_API->EscapeQuote($query_string);
		$script_name = $this->objDB_API->EscapeQuote($script_name);
		$script_filename = $this->objDB_API->EscapeQuote($script_filename);
		$DateTimeRequest = $this->objDB_API->EscapeQuote($DateTimeRequest);
		
		if ($UserID != "") { 
		
			$this->SQL = " 
INSERT INTO 
	AccessLog 
	(StoryIdent, 
	SectionIdent, 
	EditionIdent, 
	REMOTE_ADDR, 
	HTTP_USER_AGENT, 
	REQUEST_URI, 
	REQUEST_METHOD, 
	QUERY_STRING, 
	SCRIPT_NAME, 
	SCRIPT_FILENAME, 
	DateTimeRequest, 
	UserID) 
VALUES 
	($StoryIdent, 
	$SectionIdent, 
	$EditionIdent, 
	'$remote_addr', 
	'$http_user_agent', 
	'$request_uri', 
	'$request_method', 
	'$query_string', 
	'$script_name', 
	'$script_filename', 
	'$DateTimeRequest', 
	$UserID) 
			"; 
			
		} else { 
		
			$this->SQL = " 
INSERT INTO 
	AccessLog 
	(StoryIdent, 
	SectionIdent, 
	EditionIdent, 
	REMOTE_ADDR, 
	HTTP_USER_AGENT, 
	REQUEST_URI, 
	REQUEST_METHOD, 
	QUERY_STRING, 
	SCRIPT_NAME, 
	SCRIPT_FILENAME, 
	DateTimeRequest) 
VALUES 
	($StoryIdent, 
	$SectionIdent, 
	$EditionIdent, 
	'$remote_addr', 
	'$http_user_agent', 
	'$request_uri', 
	'$request_method', 
	'$query_string', 
	'$script_name', 
	'$script_filename', 
	'$DateTimeRequest') 
			"; 
			
		} 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);	
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to add this log entry to the database"); 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function GetMostPopularStory($strLongDateFormat) { 
 
		srand((double)microtime()*1000000); 
		$intRandomNumber = rand(0,100000); 
 
		$this->SQL = " 
CREATE TABLE Stats_$intRandomNumber ( 
	HitCount INT(10) UNSIGNED NOT NULL, 
	StoryIdent INT(10) UNSIGNED NOT NULL, 
	SectionIdent INT(10) UNSIGNED NOT NULL, 
	EditionIdent INT(10) UNSIGNED NOT NULL, 
	StoryTitle VARCHAR(200) NOT NULL 
) 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
 		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to create the temporary table Stats_$intRandomNumber"); 
		
		} else { 
 
			$this->SQL = " 
INSERT INTO 
	Stats_$intRandomNumber 
	SELECT 
		COUNT(al.StoryIdent) AS Counter, 
		al.StoryIdent, 
		s.SectionIdent, 
		s.EditionIdent, 
		s.Title 
	FROM 
		AccessLog al 
		INNER JOIN Story s 
			ON al.StoryIdent = s.Ident 
	WHERE 
		al.StoryIdent != '' 
	GROUP BY 
		al.StoryIdent 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
 			
 			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable insert results into the temporary table Stats_$intRandomNumber"); 
			
			} else { 
 
				$this->SQL = " 
SELECT 
	st.HitCount, 
	st.StoryIdent, 
	st.SectionIdent, 
	st.EditionIdent, 
	st.StoryTitle, 
	e.Date AS EditionDate, 
	DATE_FORMAT(e.Date, '$strLongDateFormat') AS EditionLongDate, 
	e.Volume, 
	e.Number, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate 
FROM 
	Stats_$intRandomNumber st 
	INNER JOIN Story s 
		ON st.StoryIdent = s.Ident 
	INNER JOIN Editions e 
		ON st.EditionIdent = e.Ident 
ORDER BY 
	st.HitCount DESC 
LIMIT 0,10 
				";
				#echo "<pre>".$this->SQL."</pre><br>"; 
 
				$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
				
				if ($arrResult == "error" ) { 
				
					array_push($this->Errors,"The system was unable to select the Most Popular Stories"); 
					
				} 
 
			} 
 
			$this->SQL = " 
DROP TABLE Stats_$intRandomNumber 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable to drop the temporary table Stats_$intRandomNumber"); 
				
			} 
		} 
		
		if ($arrResult == "error") {
		
			$arrResult = "";
		
		}
		
		$this->CleanUp();
		return $arrResult; 
	} 
 
	function GetMostPopularStoryByEdition($EditionIdent,$strLongDateFormat) { 
 
		srand((double)microtime()*1000000); 
		$intRandomNumber = rand(0,100000); 
 
		$this->SQL = " 
CREATE TABLE Stats_$intRandomNumber ( 
	HitCount INT(10) UNSIGNED NOT NULL, 
	StoryIdent INT(10) UNSIGNED NOT NULL, 
	SectionIdent INT(10) UNSIGNED NOT NULL, 
	EditionIdent INT(10) UNSIGNED NOT NULL, 
	StoryTitle VARCHAR(200) NOT NULL 
) 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to create the temporary table Stats_$intRandomNumber"); 
			
		} else { 
 
			$this->SQL = " 
INSERT INTO 
	Stats_$intRandomNumber 
	SELECT 
		COUNT(al.StoryIdent) AS Counter, 
		al.StoryIdent, 
		s.SectionIdent, 
		s.EditionIdent, 
		s.Title 
	FROM 
		AccessLog al 
		INNER JOIN Story s 
			ON al.StoryIdent = s.Ident 
	WHERE 
		al.StoryIdent != '' 
		AND al.EditionIdent = $EditionIdent 
		AND s.EditionIdent = $EditionIdent 
	GROUP BY 
		al.StoryIdent 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
 
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable insert results into the temporary table Stats_$intRandomNumber"); 
				
			} else { 
 
				$this->SQL = " 
SELECT 
	s.HitCount, 
	s.StoryIdent, 
	s.SectionIdent, 
	s.EditionIdent, 
	s.StoryTitle, 
	e.Date AS EditionDate, 
	DATE_FORMAT(e.Date, '$strLongDateFormat') AS EditionLongDate, 
	e.Volume, 
	e.Number 
FROM 
	Stats_$intRandomNumber s 
	INNER JOIN Editions e 
		ON s.EditionIdent = e.Ident 
ORDER BY 
	s.HitCount DESC 
LIMIT 0,10 
				"; 
				#echo "<pre>".$this->SQL."</pre><br>"; 
 
				$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
				if ($arrResult == "error") { 
				
					array_push($this->Errors,"The system was unable to select the Most Popular Stories by Edition"); 
					
				} 
 
			} 
 
			$this->SQL = " 
DROP TABLE Stats_$intRandomNumber 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
 
 			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable to drop the temporary table Stats_$intRandomNumber"); 
			
			} 
		} 
		
		if ($arrResult == "error") {
		
			$arrResult = "";
		
		}
		
		$this->CleanUp($objConn); 
		return $arrResult; 
	} 
 
######################################################## 
# 
# Edition Methods 
# 
######################################################## 
 
	function GetEditions($strLongDateFormat) { 
 
		$this->SQL = " 
SELECT 
	ed.Ident, 
	ed.Volume, 
	ed.Number, 
	DATE_FORMAT(ed.Date, '$strLongDateFormat') AS EditionDate, 
	ed.Notes 
FROM 
	Editions ed 
ORDER BY 
	ed.Date DESC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain a list of editions"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult;
		
		}
		
		$this->CleanUp(); 
 
	} 
 
	function GetEdition($intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	ed.Ident, 
	ed.Volume, 
	ed.Number, 
	ed.Date, 
	UNIX_TIMESTAMP(ed.Date) AS EditionDate, 
	DATE_FORMAT(ed.Date, '$strLongDateFormat') AS EditionLongDate, 
	DATE_FORMAT(ed.Date, '$strShortDateFormat') AS EditionShortDate, 
	ed.Notes 
FROM 
	Editions ed 
WHERE 
	ed.Ident = $intEditionIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
 		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain edition $intEditionIdent from the database"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp(); 
 
	} 
 
	function AddEdition($intVolume,$intNumber,$dtmDate,$strNotes) { 
 
 		$strNotes = $this->objDB_API->EscapeQuote($strNotes);
 		$dtmDate = $this->objDB_API->EscapeQuote($dtmDate);
 
		$this->SQL = " 
INSERT INTO 
	Editions 
	(Volume, 
	Number, 
	Date, 
	Notes) 
VALUES 
	($intVolume, 
	$intNumber, 
	'$dtmDate', 
	'$strNotes') 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$intEditionID = $this->objDB_API->ExecuteSQLReturnInsertID($this->SQL);
		if ($intEditionID == "error") { 
		
			array_push($this->Errors,"The system was unable to add this edition to the database"); 
			
		}  else {
 
 			$this->CleanUp(); 
 			return $intEditionID; 
 		
 		}
 		
 		$this->CleanUp();
 
	} 
 
	function EditEdition($intEditionIdent,$intVolume,$intNumber,$dtmDate,$strNotes) { 
 
 		$strNotes = $this->objDB_API->EscapeQuote($strNotes);
 		$dtmDate = $this->objDB_API->EscapeQuote($dtmDate);
 
		$this->SQL = " 
UPDATE 
	Editions 
SET 
	Volume = $intVolume, 
	Number = $intNumber, 
	Date = '$dtmDate', 
	Notes = '$strNotes' 
WHERE 
	Ident = $intEditionIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to update edition $intEditionIdent in the database"); 
		
		}
		
		$this->CleanUp(); 
	} 
 
	function GetCurrentEdition($strLongDateFormat,$strShortDateFormat) { 
	
		$this->SQL = " 
SELECT 
	ce.EditionIdent AS Ident, 
	ed.Volume, 
	ed.Number, 
	UNIX_TIMESTAMP(ed.Date) AS EditionDate, 
	DATE_FORMAT(ed.Date, '$strLongDateFormat') AS EditionLongDate, 
	DATE_FORMAT(ed.Date, '$strShortDateFormat') AS EditionShortDate, 
	ed.Notes 
FROM 
	CurrentEdition ce, 
	Editions ed 
WHERE 
	ce.EditionIdent = ed.Ident 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain current edition from the database"); 
			
		}  else {

			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
	} 
 
	function SetCurrentEdition($intEditionIdent) { 
 
		$this->SQL = " 
DELETE FROM 
	CurrentEdition 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
 		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "false") { 
			$this->SQL = " 
INSERT INTO 
	CurrentEdition(EditionIdent) 
VALUES 
	($intEditionIdent) 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
 
 			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"Could not insert current edition into the database"); 
				
			} 
			
		} else { 
		
			array_push($this->Errors,"Could not delete current edition from the database"); 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function GetEditionVolumes() { 
 
		$this->SQL = " 
SELECT 
	DISTINCT(ed.Volume) AS VolumeNo 
FROM 
	Editions ed 
ORDER BY 
	ed.Volume 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>";
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain volumes from the database"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult;
		
		}
		
		$this->CleanUp();
	} 
 
	function GetEditionsByVolume($intVolumeNumber,$strLongDateFormat) { 
 
		$this->SQL = " 
SELECT 
	ed.Ident, 
	ed.Volume, 
	ed.Number, 
	DATE_FORMAT(ed.Date, '$strLongDateFormat') AS EditionDate, 
	ed.Notes 
FROM 
	Editions ed 
WHERE 
	ed.Volume = $intVolumeNumber 
ORDER BY 
	ed.Date ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain volume editions from the database"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}

		$this->CleanUp();
		
	} 
 
######################################################## 
# 
# Obituary Methods 
# 
######################################################## 
 
	function AddObituary($strFirstName,$strMiddleInitial,$strLastName,$dtmDOB,$dtmDOD,$strSummary,$strObituary,$intEditionIdent) { 
	
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strMiddleInitial = $this->objDB_API->EscapeQuote($strMiddleInitial);
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$strSummary = $this->objDB_API->EscapeQuote($strSummary);
		$strObituary = $this->objDB_API->EscapeQuote($strObituary);
		$dtmDOB = $this->objDB_API->EscapeQuote($dtmDOB);
		$dtmDOD = $this->objDB_API->EscapeQuote($dtmDOD);
 
		if ($dtmDOB == "1900-1-1") { 
			$dtmDOB = "0000-00-00"; 
		} 
 
		$this->SQL = " 
INSERT INTO 
	Obituary 
	(FirstName, 
	LastName, 
	DOB, 
	DOD, 
	Obituary, 
	DateAdded, 
	MiddleInitial, 
	EditionIdent, 
	Summary) 
VALUES 
	('$strFirstName', 
	'$strLastName', 
	'$dtmDOB', 
	'$dtmDOD', 
	'$strObituary', 
	NOW(), 
	'$strMiddleInitial', 
	$intEditionIdent, 
	'$strSummary') 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$intObituaryID = $this->objDB_API->ExecuteSQLReturnInsertID($this->SQL);	
		if ($intObituaryID == "error") { 
			
			array_push($this->Errors,"The system was unable to add this death notice to the database."); 
		
		}  else {
 
			$this->CleanUp(); 
			return $intObituaryID; 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function EditObituary($intObituaryIdent,$strFirstName,$strMiddleInitial,$strLastName,$dtmDOB,$dtmDOD,$strSummary,$strObituary,$intEditionIdent) { 
	
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strMiddleInitial = $this->objDB_API->EscapeQuote($strMiddleInitial);
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$strSummary = $this->objDB_API->EscapeQuote($strSummary);
		$strObituary = $this->objDB_API->EscapeQuote($strObituary);
		$dtmDOB = $this->objDB_API->EscapeQuote($dtmDOB);
		$dtmDOD = $this->objDB_API->EscapeQuote($dtmDOD);
 
		$this->SQL = " 
UPDATE 
	Obituary 
SET 
	FirstName = '$strFirstName', 
	LastName = '$strLastName', 
	DOB = '$dtmDOB', 
	DOD = '$dtmDOD', 
	Obituary = '$strObituary', 
	MiddleInitial = '$strMiddleInitial', 
	EditionIdent = $intEditionIdent, 
	Summary = '$strSummary' 
WHERE 
	Ident = $intObituaryIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to update this death notice in the database."); 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function GetObituary($intObituaryIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	o.Ident, 
	o.FirstName, 
	o.LastName, 
	o.DOB, 
	UNIX_TIMESTAMP(o.DOB) AS DOBUnixDate, 
	DATE_FORMAT(o.DOB, '$strLongDateFormat') AS DOBLongDate, 
	DATE_FORMAT(o.DOB, '$strShortDateFormat') AS DOBShortDate, 
	UNIX_TIMESTAMP(o.DOD) AS DODUnixDate, 
	DATE_FORMAT(o.DOD, '$strLongDateFormat') AS DODLongDate, 
	DATE_FORMAT(o.DOD, '$strShortDateFormat') AS DODShortDate, 
	o.Obituary, 
	UNIX_TIMESTAMP(o.DateAdded) AS ObituaryUnixDate, 
	DATE_FORMAT(o.DateAdded, '$strLongDateFormat') AS ObituaryLongDate, 
	DATE_FORMAT(o.DateAdded, '$strShortDateFormat') AS ObituaryShortDate, 
	o.MiddleInitial, 
	o.EditionIdent, 
	o.Summary 
FROM 
	Obituary o 
WHERE 
	o.Ident = $intObituaryIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"The system was unable to get the death notice from the database."); 
			
		}  else {
 
 			return $arrResult; 
			$this->CleanUp(); 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function SearchObituaries($intEditionIdent,$strFirstName,$strLastName,$dtmDOB,$dtmDOD,$strLongDateFormat,$strShortDateFormat) { 
	
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$dtmDOB = $this->objDB_API->EscapeQuote($dtmDOB);
		$dtmDOD = $this->objDB_API->EscapeQuote($dtmDOD);
 
		$this->SQL = " 
SELECT 
	o.Ident, 
	o.FirstName, 
	o.LastName, 
	UNIX_TIMESTAMP(o.DOB) AS DOBUnixDate, 
	DATE_FORMAT(o.DOB, '$strLongDateFormat') AS DOBLongDate, 
	DATE_FORMAT(o.DOB, '$strShortDateFormat') AS DOBShortDate, 
	UNIX_TIMESTAMP(o.DOD) AS DODUnixDate, 
	DATE_FORMAT(o.DOD, '$strLongDateFormat') AS DODLongDate, 
	DATE_FORMAT(o.DOD, '$strShortDateFormat') AS DODShortDate, 
	o.Obituary, 
	UNIX_TIMESTAMP(o.DateAdded) AS ObituaryUnixDate, 
	DATE_FORMAT(o.DateAdded, '$strLongDateFormat') AS ObituaryLongDate, 
	DATE_FORMAT(o.DateAdded, '$strShortDateFormat') AS ObituaryShortDate, 
	o.MiddleInitial, 
	o.EditionIdent, 
	o.Summary 
FROM 
	Obituary o 
WHERE 
	o.Ident > 0\n"; 
		if ($strLastName != "") { 
			$strSQLWhere .= "	AND o.LastName = '$strLastName'\n"; 
			$strSQLOrderBy .= "	o.LastName,\n"; 
		} 
		if ($strFirstName != "") { 
			$strSQLWhere .= "	AND o.FirstName = '$strFirstName'\n"; 
			$strSQLOrderBy .= "	o.FirstName,\n"; 
		} 
		if ($dtmDOB != "--") { 
			$strSQLWhere .= "	AND o.DOB = '$dtmDOB'\n"; 
			$strSQLOrderBy .= "	o.DOB,\n"; 
		} 
		if ($dtmDOD != "--") { 
			$strSQLWhere .= "	AND o.DOD = '$dtmDOD'\n"; 
			$strSQLOrderBy .= "	o.DOD,\n"; 
		} 
		if ($intEditionIdent != 0) { 
			$strSQLWhere .= "	AND o.EditionIdent = $intEditionIdent\n"; 
			$strSQLOrderBy .= "	o.EditionIdent,\n"; 
		} 
		if (strSQLWhere != "") { 
			$this->SQL .= $strSQLWhere; 
		} 
		$this->SQL .= "ORDER BY\n"; 
		if ($strSQLOrderBy != "") { 
			$this->SQL .= $strSQLOrderBy; 
		} 
		$this->SQL .= "	o.Ident"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 

			array_push($this->Errors,"The system was unable to search the death notices in the database."); 
			
		}  else {
 
			return $arrResult; 
			$this->CleanUp(); 

		}
		
		$this->CleanUp();	
 
	} 
 
	function GetObituariesByEdition($intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	o.Ident, 
	o.FirstName, 
	o.LastName, 
	UNIX_TIMESTAMP(o.DOB) AS DOBUnixDate, 
	DATE_FORMAT(o.DOB, '$strLongDateFormat') AS DOBLongDate, 
	DATE_FORMAT(o.DOB, '$strShortDateFormat') AS DOBShortDate, 
	UNIX_TIMESTAMP(o.DOD) AS DODUnixDate, 
	DATE_FORMAT(o.DOD, '$strLongDateFormat') AS DODLongDate, 
	DATE_FORMAT(o.DOD, '$strShortDateFormat') AS DODShortDate, 
	o.Obituary, 
	UNIX_TIMESTAMP(o.DateAdded) AS ObituaryUnixDate, 
	DATE_FORMAT(o.DateAdded, '$strLongDateFormat') AS ObituaryLongDate, 
	DATE_FORMAT(o.DateAdded, '$strShortDateFormat') AS ObituaryShortDate, 
	o.MiddleInitial, 
	o.EditionIdent, 
	o.Summary 
FROM 
	Obituary o 
WHERE 
	o.EditionIdent = $intEditionIdent 
ORDER BY 
	o.LastName ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);	
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"The system was unable to get the death notices from the database."); 
			
		}  else {
 
			return $arrResult; 
			$this->CleanUp(); 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function GetCurrentObituarys($strLongDateFormat,$strShortDateFormat) { 
 
		$dtmCurrentDate = date("Y-m-d"); 
 
		$this->SQL = " 
SELECT 
	e.Date 
FROM 
	Editions e, 
	CurrentEdition ce 
WHERE 
	ce.EditionIdent = e.Ident 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);	
		if ($arrResult != "error") { 
		
			$dtmCurrentEditionDate = $arrResult[0][Date]; 
			
			$this->SQL = " 
SELECT 
	o.Ident, 
	o.FirstName, 
	o.LastName, 
	UNIX_TIMESTAMP(o.DOB) AS DOBUnixDate, 
	DATE_FORMAT(o.DOB, '$strLongDateFormat') AS DOBLongDate, 
	DATE_FORMAT(o.DOB, '$strShortDateFormat') AS DOBShortDate, 
	UNIX_TIMESTAMP(o.DOD) AS DODUnixDate, 
	DATE_FORMAT(o.DOD, '$strLongDateFormat') AS DODLongDate, 
	DATE_FORMAT(o.DOD, '$strShortDateFormat') AS DODShortDate, 
	o.Obituary, 
	UNIX_TIMESTAMP(o.DateAdded) AS ObituaryUnixDate, 
	DATE_FORMAT(o.DateAdded, '$strLongDateFormat') AS ObituaryLongDate, 
	DATE_FORMAT(o.DateAdded, '$strShortDateFormat') AS ObituaryShortDate, 
	o.MiddleInitial, 
	o.EditionIdent, 
	o.Summary 
FROM 
	Obituary o, 
	Editions e 
WHERE 
	e.Ident = o.EditionIdent 
	AND e.Date >= '$dtmCurrentEditionDate' 
ORDER BY 
	o.LastName ASC 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
			if ($arrResult == "error") { 
			
				array_push($this->Errors,"The system was unable to get the death notices from the database."); 
				
			}  else {
			
				return $arrResult; 
				$this->CleanUp(); 
			
			}
			
		} else { 
		
			array_push($this->Errors,"The system was unable to get the date of the Current Edition."); 
			
		} 
		
		$this->CleanUp(); 
 
	} 
 
	function GetObituarysByEdition($intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	o.Ident, 
	o.FirstName, 
	o.LastName, 
	UNIX_TIMESTAMP(o.DOB) AS DOBUnixDate, 
	DATE_FORMAT(o.DOB, '$strLongDateFormat') AS DOBLongDate, 
	DATE_FORMAT(o.DOB, '$strShortDateFormat') AS DOBShortDate, 
	UNIX_TIMESTAMP(o.DOD) AS DODUnixDate, 
	DATE_FORMAT(o.DOD, '$strLongDateFormat') AS DODLongDate, 
	DATE_FORMAT(o.DOD, '$strShortDateFormat') AS DODShortDate, 
	o.Obituary, 
	UNIX_TIMESTAMP(o.DateAdded) AS ObituaryUnixDate, 
	DATE_FORMAT(o.DateAdded, '$strLongDateFormat') AS ObituaryLongDate, 
	DATE_FORMAT(o.DateAdded, '$strShortDateFormat') AS ObituaryShortDate, 
	o.MiddleInitial, 
	o.EditionIdent, 
	o.Summary 
FROM 
	Obituary o 
WHERE 
	o.EditionIdent = $intEditionIdent 
ORDER BY 
	o.LastName ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"The system was unable to get the death notices from the database."); 
			
		}  else {
 
		return $arrResult; 
		$this->CleanUp(); 
		
		}
		
		$this->CleanUp(); 
 
	} 
 
######################################################## 
# 
# Search Methods 
# 
######################################################## 
 
	function SearchSite($strKeywords,$intDeathNoticeID,$intClassifiedID,$intStartingRow,$intRowsPerPage,$intCurrentPage,$strLongDateFormat,$strShortDateFormat) { 
	
		$strKeywords = $this->objDB_API->EscapeQuote($strKeywords);
 
		srand((double)microtime()*1000000); 
		$intRandomNumber = rand(0,100000); 
 
		$this->SQL = " 
CREATE TABLE Search_$intRandomNumber( 
	EditionIdent INT(10) UNSIGNED NOT NULL, 
	SectionIdent INT(10) UNSIGNED NOT NULL, 
	StoryIdent INT(10) UNSIGNED NOT NULL, 
	Title VARCHAR(200) NOT NULL, 
	Summary TEXT NOT NULL, 
	SummaryPic VARCHAR(255) NULL, 
	Relevance VARCHAR(255) NULL, 
	DateEntered DATETIME NOT NULL 
) 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);	
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to create the temporary table required for the search.");
			 
		} else { 
		
			$this->SQL = " 
INSERT INTO 
	Search_$intRandomNumber 
	SELECT 
		s.EditionIdent, 
		s.SectionIdent, 
		s.Ident, 
		s.Title, 
		s.Summary, 
		s.SummaryPic, 
		MATCH (s.Author,s.Title,s.Summary,s.Story) AGAINST ('$strKeywords') AS relevance, 
		s.DateAdded 
	FROM 
		Story s 
	WHERE 
		MATCH (s.Author,s.Title,s.Summary,s.Story) AGAINST ('$strKeywords') 
		AND s.SectionIdent != $intClassifiedID 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable to insert the story search results into to temporary table."); 
				break; 
				
			} 
 
			$this->SQL = " 
INSERT INTO 
	Search_$intRandomNumber 
	SELECT 
		o.EditionIdent, 
		$intDeathNoticeID, 
		o.Ident, 
		CONCAT(o.FirstName,' ',o.MiddleInitial,' ',o.LastName) as Title, 
		o.Summary, 
		'', 
		MATCH (o.FirstName,o.LastName,o.Summary,o.Obituary) AGAINST ('$strKeywords') AS relevance, 
		o.DateAdded 
	FROM 
		Obituary o 
	WHERE 
		MATCH (o.FirstName,o.LastName,o.Summary,o.Obituary) AGAINST ('$strKeywords') 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable to insert the obituary search results into to temporary table."); 
				break; 
				
			} 
 
			$this->SQL = " 
SELECT 
	StoryIdent 
FROM 
	Search_$intRandomNumber 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
			if ($arrResult != "error") { 
			
				$intTotalNumberOfRows = count($arrResult); 
				
			} else { 
			
				array_push($this->Errors,"The system was unable to compute the total number of rows returned from your search."); 
				
			} 
 
			$this->SQL = " 
SELECT 
	search.EditionIdent, 
	search.SectionIdent, 
	search.StoryIdent, 
	search.Title, 
	search.Summary, 
	search.SummaryPic, 
	search.Relevance, 
	UNIX_TIMESTAMP(search.DateEntered) AS StoryUnixDate, 
	DATE_FORMAT(search.DateEntered, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(search.DateEntered, '$strShortDateFormat') AS StoryShortDate, 
	e.Volume, 
	e.Number, 
	UNIX_TIMESTAMP(e.Date) AS EditionUnixDate, 
	DATE_FORMAT(e.Date, '$strLongDateFormat') AS EditionLongDate, 
	DATE_FORMAT(e.Date, '$strShortDateFormat') AS EditionShortDate, 
	s.Name AS SectionName 
FROM 
	Search_$intRandomNumber search, 
	Editions e, 
	Section s 
WHERE 
	e.Ident = search.EditionIdent 
	AND s.Ident = search.SectionIdent 
ORDER BY 
	search.Relevance DESC 
LIMIT $intStartingRow,$intRowsPerPage 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
			if ($arrResult != "error") { 
			
				$intReturnedNumberOfRows = count($arrResult); 
				
				$this->SQL = " 
DROP TABLE Search_$intRandomNumber 
				"; 
				#echo "<pre>".$this->SQL."</pre><br>"; 
				
				$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
				if ($bolSQLError == "true") { 
				
					array_push($this->Errors,"The system was unable to drop the temporary search table."); 
					
				} 
 
				$arrPageInfo = $this->CalculatePages($intTotalNumberOfRows,$intRowsPerPage,$intCurrentPage); 
				$arrPageInfo[4] = $intTotalNumberOfRows; 
				$arrPageInfo[5] = $intStartingRow + 1; 
				$arrPageInfo[6] = $intStartingRow + $intReturnedNumberOfRows; 
				$ReturnArray[0] = $arrPageInfo; 
				$ReturnArray[1] = $arrResult; 
				$this->CleanUp(); 
				return $ReturnArray; 
				
			} else { 
			
				array_push($this->Errors,"The system was unable to get the search results from the temporary table."); 
				
			} 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
 
######################################################## 
# 
# Section Methods 
# 
######################################################## 
 
	function GetSections() { 
 
		$this->SQL = " 
SELECT 
	sect.Ident, 
	sect.Name,
	sect.SortOrder
FROM 
	Section sect 
ORDER BY 
	sect.SortOrder ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") {  
			
			array_push($this->Errors,"Could not obtain a list of sections"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult;
		
		}
		
		$this->CleanUp();
 
	} 
 
	function GetSectionsForMenu() { 

		$this->SQL = " 
SELECT 
	sect.Ident, 
	sect.Name 
FROM 
	Section sect 
ORDER BY 
	sect.SortOrder ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);

		if ($arrResult == "error") { 
			
			array_push($this->Errors,"Could not obtain a list of menu sections"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function GetSection($intSectionIdent) { 
 
		$this->SQL = " 
SELECT 
	sect.Ident, 
	sect.Name 
FROM 
	Section sect 
WHERE 
	sect.Ident = $intSectionIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"Could not obtain the details of this section"); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
 
	} 

	function EditSectionName($intSectionIdent,$strName){

		$this->SQL = "
UPDATE
	Section
SET
	Name = '$strName'
WHERE
	Ident = $intSectionIdent
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to update this section in the database."); 
			
		} 

		$this->CleanUp(); 

	}
	
	function AddSection($intSortOrder,$strName){
	
		$this->SQL = "
SELECT
	MAX(SortOrder) AS MaxSortOrder
FROM
	Section
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"Could not obtain the maximun sort order for table Section."); 
			
		} else {
		
			$intMaxSort = $arrResult[0][MaxSortOrder];
			
			for ($i=$intMaxSort; $i >= $intSortOrder; $i--) {

				$this->SQL = "
UPDATE
	Section
SET
	SortOrder = $i + 1
WHERE
	SortOrder = $i
				";
				#echo "<pre>".$this->SQL."</pre><br>"; 

				$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

				if ($bolSQLError == "true") { 

					array_push($this->Errors,"The system was unable to update the sort order on this section."); 

				} 
			
			}

			$this->SQL = "
INSERT INTO
	Section
	(Name,
	SortOrder,
	Active)
VALUES
	('$strName',
	$intSortOrder,
	'Y')
			";
			echo "<pre>".$this->SQL."</pre><br>"; 

			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

			if ($bolSQLError == "true") { 

				array_push($this->Errors,"The system was unable to add this section in the database."); 

			} 
		
		}

		$this->CleanUp(); 

	}
	
	function MoveSectionUp($intSectionIdent,$intSortOrder){
	
		$this->SQL = "
UPDATE
	Section
SET
	SortOrder = $intSortOrder
WHERE
	SortOrder = $intSortOrder - 1
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to move this section in the database."); 
			
		} 
		
		$this->SQL = "
UPDATE
	Section
SET
	SortOrder = $intSortOrder - 1
WHERE
	Ident = $intSectionIdent
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to complete the move this section in the database. Please contact the system administrator."); 
			
		} 

		$this->CleanUp(); 
	
	}
	
	function MoveSectionDown($intSectionIdent,$intSortOrder){

		$this->SQL = "
UPDATE
	Section
SET
	SortOrder = $intSortOrder
WHERE
	SortOrder = $intSortOrder + 1
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to move this section in the database."); 
			
		} 
		
		$this->SQL = "
UPDATE
	Section
SET
	SortOrder = $intSortOrder + 1
WHERE
	Ident = $intSectionIdent
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to complete the move this section in the database. Please contact the system administrator.");  
			
		} 

		$this->CleanUp(); 

	}
 
 
######################################################## 
# 
# Story Methods 
# 
######################################################## 
 
	function AddStory($intSectionIdent,$strAuthor,$strTitle,$strStory,$strSummary,$strSummaryPic,$enumShowOnHP,$enumProtectedContent,$intEditionIdent,$dtmDateAdded,$dtmExpirationDate) { 
	
		$strAuthor = $this->objDB_API->EscapeQuote($strAuthor);
		$strTitle = $this->objDB_API->EscapeQuote($strTitle);
		$strStory = $this->objDB_API->EscapeQuote($strStory);
		$strSummary = $this->objDB_API->EscapeQuote($strSummary);
		$strSummaryPic = $this->objDB_API->EscapeQuote($strSummaryPic);
		$dtmExpirationDate = $this->objDB_API->EscapeQuote($dtmExpirationDate);
 
		$this->SQL = " 
INSERT INTO 
	Story 
	(SectionIdent, 
	Author, 
	Title, 
	Story, 
	Summary, 
	SummaryPic, 
	ShowOnHP, 
	ProtectedContent, 
	EditionIdent, 
	DateAdded, 
	ExpirationDate) 
VALUES 
	($intSectionIdent, 
	'$strAuthor', 
	'$strTitle', 
	'$strStory', 
	'$strSummary', 
	'$strSummaryPic', 
	'$enumShowOnHP', 
	'$enumProtectedContent', 
	$intEditionIdent, 
	'$dtmDateAdded', 
	'$dtmExpirationDate') 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$intStoryID = $this->objDB_API->ExecuteSQLReturnInsertID($this->SQL);	
		if ($intStoryID == "error") { 
		
			array_push($this->Errors,"The system was unable to add this story to the database."); 
			
		} else { 
		
			$this->CleanUp(); 
			return $intStoryID; 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function EditStory($intStoryIdent,$intSectionIdent,$strAuthor,$strTitle,$strStory,$strSummary,$strSummaryPic,$enumShowOnHP,$enumProtectedContent,$intEditionIdent,$dtmExpirationDate) { 
	
		$strAuthor = $this->objDB_API->EscapeQuote($strAuthor);
		$strTitle = $this->objDB_API->EscapeQuote($strTitle);
		$strStory = $this->objDB_API->EscapeQuote($strStory);
		$strSummary = $this->objDB_API->EscapeQuote($strSummary);
		$strSummaryPic = $this->objDB_API->EscapeQuote($strSummaryPic);
		$dtmExpirationDate = $this->objDB_API->EscapeQuote($dtmExpirationDate);
 
		$this->SQL = " 
UPDATE 
	Story 
SET 
	SectionIdent = $intSectionIdent, 
	Author = '$strAuthor', 
	Title = '$strTitle', 
	Story = '$strStory', 
	Summary = '$strSummary', 
	SummaryPic = '$strSummaryPic', 
	ShowOnHP = '$enumShowOnHP', 
	ProtectedContent = '$enumProtectedContent', 
	EditionIdent = $intEditionIdent, 
	ExpirationDate = '$dtmExpirationDate' 
WHERE 
	Ident = $intStoryIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);

		if ($bolSQLError == "true") { 
			
			array_push($this->Errors,"The system was unable to update this story in the database."); 
			
		} 

		$this->CleanUp(); 
 
	} 
 
	function GetStoriesByEdition($intSectionIdent,$intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.SectionIdent, 
	s.Author, 
	s.Title, 
	s.Story, 
	s.Summary, 
	s.SummaryPic, 
	s.ShowOnHP, 
	s.ProtectedContent, 
	s.EditionIdent, 
	s.DateAdded, 
	UNIX_TIMESTAMP(s.DateAdded) AS StoryUnixDate, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(s.DateAdded, '$strShortDateFormat') AS StoryShortDate 
FROM 
	Story s 
WHERE 
	s.EditionIdent = $intEditionIdent 
	AND s.SectionIdent = $intSectionIdent 
ORDER BY 
	s.SummaryPic DESC, 
	s.Title ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
 
			array_push($this->Errors,"The system was unable to get stories from the database."); 
 
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function GetStory($intStoryIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.SectionIdent, 
	st.Name AS SectionName,
	s.Author, 
	s.Title, 
	s.Story, 
	s.Summary, 
	s.SummaryPic, 
	s.ShowOnHP, 
	s.ProtectedContent, 
	s.EditionIdent, 
	s.DateAdded, 
	UNIX_TIMESTAMP(s.DateAdded) AS StoryUnixDate, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(s.DateAdded, '$strShortDateFormat') AS StoryShortDate, 
	s.ExpirationDate, 
	UNIX_TIMESTAMP(s.ExpirationDate) AS UnixExpiarationDate ,
	UNIX_TIMESTAMP(e.Date) AS EditionUnixDate, 
	DATE_FORMAT(e.Date, '$strLongDateFormat') AS EditionLongDate, 
	DATE_FORMAT(e.Date, '$strShortDateFormat') AS EditionShortDate
FROM 
	Story s 
	INNER JOIN
	Section st
		ON st.Ident = s.SectionIdent
	INNER JOIN
	Editions e
		ON e.Ident = s.EditionIdent
WHERE 
	s.Ident = $intStoryIdent 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"The system was unable to get the story from the database."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
		
	} 
 
	function GetCurrentStoriesBySection($intSectionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.SectionIdent, 
	s.Author, 
	s.Title, 
	s.Story, 
	s.Summary, 
	s.SummaryPic, 
	s.ShowOnHP, 
	s.ProtectedContent, 
	s.EditionIdent, 
	s.DateAdded, 
	UNIX_TIMESTAMP(s.DateAdded) AS StoryUnixDate, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(s.DateAdded, '$strShortDateFormat') AS StoryShortDate 
FROM 
	Story s, 
	CurrentEdition ce 
WHERE 
	s.EditionIdent = ce.EditionIdent 
	AND s.SectionIdent = $intSectionIdent 
ORDER BY 
	s.SummaryPic DESC, 
	s.Title ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"The system was unable to get stories from the database."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 

		}
		
		$this->CleanUp();	
 
	} 
 
	function GetHomePageStoriesByEdition($intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.SectionIdent, 
	s.Author, 
	s.Title, 
	s.Story, 
	s.Summary, 
	s.SummaryPic, 
	s.ShowOnHP, 
	s.ProtectedContent, 
	s.EditionIdent, 
	s.DateAdded, 
	UNIX_TIMESTAMP(s.DateAdded) AS StoryUnixDate, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(s.DateAdded, '$strShortDateFormat') AS StoryShortDate 
FROM 
	Story s, 
	CurrentEdition ce 
WHERE 
	s.EditionIdent = $intEditionIdent 
	AND s.ShowOnHP = 'Y' 
ORDER BY 
	s.SummaryPic DESC, 
	s.Title ASC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>";
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"The system was unable to get stories from the database."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
 
	} 
 
	function GetBreakingNews($intEditionIdent,$strLongDateFormat,$strShortDateFormat) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.SectionIdent, 
	s.Author, 
	s.Title, 
	s.Story, 
	s.Summary, 
	s.SummaryPic, 
	s.ShowOnHP, 
	s.ProtectedContent, 
	s.EditionIdent, 
	s.DateAdded, 
	UNIX_TIMESTAMP(s.DateAdded) AS StoryUnixDate, 
	DATE_FORMAT(s.DateAdded, '$strLongDateFormat') AS StoryLongDate, 
	DATE_FORMAT(s.DateAdded, '$strShortDateFormat') AS StoryShortDate 
FROM 
	Story s 
WHERE 
	s.EditionIdent = $intEditionIdent 
	AND s.ExpirationDate >= NOW() 
ORDER BY 
	s.DateAdded DESC 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"The system was unable to get breaking news from the database."); 
			
		}  else {

			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp();
		
	} 
 
 
######################################################## 
# 
# Subscriber Methods 
# 
######################################################## 
 
	function CheckSubscriberRegistration($strRegCode,$intZipCode,$intZipCodePlus4,$strUsername) { 
	
		$strRegCode = $this->objDB_API->EscapeQuote($strRegCode);
		$strUsername = $this->objDB_API->EscapeQuote($strUsername);
		$intZipCode = $this->objDB_API->EscapeQuote($intZipCode);
		$intZipCodePlus4 = $this->objDB_API->EscapeQuote($intZipCodePlus4);
 
		$this->SQL = " 
SELECT 
	s.Username, 
	s.Active 
FROM 
	subscribers s 
WHERE 
	s.RegistrationCode = 'REG".$strRegCode."' 
	AND s.ZipCode = $intZipCode"; 
		if ($intZipCodePlus4 != "") { 
			$this->SQL .= " 
	AND s.ZipCodePlus4 = $intZipCodePlus4 
			"; 
		} 
		#echo "<pre>".$this->SQL."</pre><br>"; 
 
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrResult == "error") {

			array_push($this->Error,"Unable to complete the subscriber registration at this time.");

		} else {
		
			if ($arrResult[0][Active]== 'Y') { 
			
				array_push($this->Errors,"The user with registration code REG$strRegCode is already registered in our database"); 
				
			} 
			
			if ($arrResult[0][Username] == $strUsername) { 
			
				array_push($this->Errors,"The username you selected is already used by another user. Please choose a different username."); 
				
			} 
			
			if (count($this->Errors) <= 0) { 
			
				$this->SQL = " 
SELECT 
	s.FirstName, 
	s.LastName, 
	s.MiddleInitial, 
	s.Salutation, 
	s.CompanyName, 
	s.City, 
	s.State, 
	s.ZipCode, 
	s.ZipCodePlus4, 
	s.Active, 
	s.StreetNumber, 
	s.StreetName 
FROM 
	subscribers s 
WHERE 
	s.RegistrationCode = 'REG".$strRegCode."' 
	AND s.ZipCode = $intZipCode"; 
	
				if ($intZipCodePlus4 != "") { 
				
				$this->SQL .= " 
	AND s.ZipCodePlus4 = $intZipCodePlus4 
					"; 
					#echo "<pre>".$this->SQL."</pre><br>"; 
					
				} 
				
				$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
				if ($arrResult == "error") { 
					
					array_push($this->Errors,"The registration code and zip code entered do not exist in our database"); 
					
				}  else {
				
					$this->CleanUp(); 
					return $arrResult; 
		
				}
				
			} 
		
		}
 
		$this->CleanUp(); 
 
	} 
 
	function RegisterSubscriber($strRegCode,$intZipCode,$intZipCodePlus4,$strUsername,$strPassword,$strEncodePass) { 
	
		$strRegCode = $this->objDB_API->EscapeQuote($strRegCode);
		$strUsername = $this->objDB_API->EscapeQuote($strUsername);
		$strPassword = $this->objDB_API->EscapeQuote($strPassword);
		$intZipCode = $this->objDB_API->EscapeQuote($intZipCode);
		$intZipCodePlus4 = $this->objDB_API->EscapeQuote($intZipCodePlus4);
 
		$this->SQL = " 
UPDATE 
	subscribers 
SET 
	Username = '$strUsername', 
	Password = ENCODE('$strPassword','$strEncodePass'), 
	Active = 'Y' 
WHERE 
	RegistrationCode = 'REG".$strRegCode."' 
	AND ZipCode = '$intZipCode'"; 
	
		if ($intZipCodePlus4 != "") { 
		
			$this->SQL .= " 
	AND ZipCodePlus4 = '$intZipCodePlus4' 
			"; 
			
		} 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system could not activate your account. Please contact the system administrator."); 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function GetSubscriptionTypes() { 
 
		$this->SQL = " 
SELECT 
	Ident, 
	Name 
FROM 
	SubscriptionTypes 
ORDER BY 
	Name 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
				
			array_push($this->Errors,"Could not obtain a list of subscription types from the database."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult;
		
		}
		
		$this->CleanUp(); 
	} 
 
	function GetMailRoutes() { 
 
		$this->SQL = " 
SELECT 
	Ident, 
	RouteName 
FROM 
	MailRoutes 
ORDER BY 
	RouteName 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"Could not obtain a list of mail routes from the database."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult; 
		
		}
		
		$this->CleanUp(); 
 
	} 
 
	function SearchSubscriber($strLastName,$strFirstName,$strStreetNumber,$strStreetName,$strCity,$strState,$strZipCode,$strZipCodePlus4,$strCompanyName,$enumStatus,$intSubscriptionType,$intMailRoute,$intStartingRow,$intRowsPerPage,$intCurrentPage) { 
	
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strStreetNumber = $this->objDB_API->EscapeQuote($strStreetNumber);
		$strStreetName = $this->objDB_API->EscapeQuote($strStreetName);
		$strCity = $this->objDB_API->EscapeQuote($strCity);
		$strState = $this->objDB_API->EscapeQuote($strState);
		$strZipCode = $this->objDB_API->EscapeQuote($strZipCode);
		$strZipCodePlus4 = $this->objDB_API->EscapeQuote($strZipCodePlus4);
		$strCompanyName = $this->objDB_API->EscapeQuote($strCompanyName);
 
		if ($strLastName != "") { 
			$strSQLWhere .= "	AND s.LastName LIKE '$strLastName%'\n"; 
			$strSQLOrderBy .= "	s.LastName,\n"; 
		} 
		if ($strFirstName != "") { 
			$strSQLWhere .= "	AND s.FirstName LIKE '$strFirstName%'\n"; 
			$strSQLOrderBy .= "	s.FirstName,\n"; 
		} 
		if ($strCompanyName != "") { 
			$strSQLWhere .= "	AND s.CompanyName LIKE '$strCompanyName%'\n"; 
			$strSQLOrderBy .= "	s.CompanyName,\n"; 
		} 
		if ($strStreetNumber != "") { 
			$strSQLWhere .= "	AND s.StreetNumber = '$strStreetNumber'\n"; 
			$strSQLOrderBy .= "	s.StreetNumber,\n"; 
		} 
		if ($strStreetName != "") { 
			$strSQLWhere .= "	AND s.StreetName LIKE '$strStreetName%'\n"; 
			$strSQLOrderBy .= "	s.StreetName,\n"; 
		} 
		if ($strCity != "") { 
			$strSQLWhere .= "	AND s.City LIKE '$strCity%'\n"; 
			$strSQLOrderBy .= "	s.City,\n"; 
		} 
		if ($strState != "") { 
			$strSQLWhere .= "	AND s.State = '$strState'\n"; 
			$strSQLOrderBy .= "	s.State,\n"; 
		} 
		if ($strZipCode != "") { 
			$strSQLWhere .= "	AND s.ZipCode = '$strZipCode'\n"; 
			$strSQLOrderBy .= "	s.ZipCode,\n"; 
		} 
		if ($strZipCodePlus4 != "") { 
			$strSQLWhere .= "	AND s.ZipCodePlus4 = '$strZipCodePlus4'\n"; 
			$strSQLOrderBy .= "	s.ZipCodePlus4,\n"; 
		} 
		if ($enumStatus != "") { 
			$strSQLWhere .= "	AND s.Active = '$enumStatus'\n"; 
			$strSQLOrderBy .= "	s.Active,\n"; 
		} 
		if ($intSubscriptionType != "") { 
			$strSQLWhere .= "	AND s.SubscriptionTypeIdent = $intSubscriptionType\n"; 
			$strSQLOrderBy .= "	s.SubscriptionTypeIdent,\n"; 
		} 
		if ($intMailRoute != "") { 
			$strSQLWhere .= "	AND s.MailRouteIdent = $intMailRoute\n"; 
			$strSQLOrderBy .= "	s.MailRouteIdent,\n"; 
		} 
 
		$this->SQL = " 
SELECT 
	s.Ident 
FROM 
	subscribers s 
WHERE 
	s.Ident > 0 
$strSQLWhere 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult != "error") { 
		
			$intTotalNumberOfRows = count($arrResult); 
			
			$this->SQL = " 
SELECT 
	s.Ident, 
	s.EmailAddress, 
	s.FirstName, 
	s.LastName, 
	s.Active, 
	s.MiddleInitial, 
	s.CompanyName, 
	s.City, 
	s.State, 
	s.ZipCode, 
	s.ZipCodePlus4, 
	s.StreetNumber, 
	s.StreetName, 
	mr.RouteName AS MailRouteName, 
	st.Name AS SubTypeName 
FROM 
	subscribers s, 
	MailRoutes mr, 
	SubscriptionTypes st 
WHERE 
	mr.Ident = s.MailRouteIdent 
	AND st.Ident = s.SubscriptionTypeIdent 
$strSQLWhere 
ORDER BY 
$strSQLOrderBy 
	s.Ident 
LIMIT $intStartingRow,$intRowsPerPage 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
			if ($arrResult != "error") { 
			
				$arrPageInfo = $this->CalculatePages($intTotalNumberOfRows,$intRowsPerPage,$intCurrentPage); 
				$ReturnArray[0] = $arrPageInfo; 
				$ReturnArray[1] = $arrResult; 
				$this->CleanUp($objConn); 
				return $ReturnArray; 
				
			} else { 
			
				array_push($this->Errors,"Could not execute search."); 
				
			} 
			
		} else { 
		
			array_push($this->Errors,"Could not execute search."); 
			
		} 
 
		$this->CleanUp(); 
 
	} 
 
	function GetSubscriber($intSubscriberID) { 
 
		$this->SQL = " 
SELECT 
	s.Ident, 
	s.Username, 
	s.EmailAddress, 
	s.FirstName, 
	s.LastName, 
	s.SignupDate, 
	s.Active, 
	s.LastLogin, 
	s.MiddleInitial, 
	s.Salutation, 
	s.CompanyName, 
	s.City, 
	s.State, 
	s.ZipCode, 
	s.RegistrationCode, 
	s.ZipCodePlus4, 
	s.PreSortRT, 
	s.Stars, 
	UNIX_TIMESTAMP(s.ExpirationDate) AS ExpUnixDate, 
	DATE_FORMAT(s.ExpirationDate, '$strLongDateFormat') AS ExpLongDate, 
	DATE_FORMAT(s.ExpirationDate, '$strShortDateFormat') AS ExpShortDate, 
	s.GiftGiver, 
	s.AddressSequence, 
	s.Office, 
	s.StreetNumber, 
	s.StreetName, 
	s.Zone, 
	s.Sort, 
	s.SubscriptionTypeIdent, 
	s.MailRouteIdent, 
	s.BreakingNewsAlert,
	s.WeeklyNewsAlert,
	s.Title 
FROM 
	subscribers s 
WHERE 
	s.Ident = $intSubscriberID 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL);
		if ($arrResult == "error") { 
			
			array_push($this->Errors,"Could get subscriber number $intSubscriberID."); 
			
		}  else {
 
			$this->CleanUp(); 
			return $arrResult;
		
		}
		
		$this->CleanUp(); 
 
	} 
 
	function EditSubscriber($intSubscriberID,$strEmailAddress,$strFirstName,$strLastName,$enumActive,$strMiddleInitial,$strSalutation,$strCompanyName,$strCity,$strState,$strZipCode,$strZipCodePlus4,$strPreSortRT,$strStars,$dtmExpirationDate,$strGiftGiver,$strAddressSequence,$strOffice,$strStreetNumber,$strStreetName,$strZone,$strSort,$intSubscriptionTypeIdent,$intMailRouteIdent,$strTitle) { 
	
		$strEmailAddress = $this->objDB_API->EscapeQuote($strEmailAddress);
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$strMiddleInitial = $this->objDB_API->EscapeQuote($strMiddleInitial);
		$strSalutation = $this->objDB_API->EscapeQuote($strSalutation);
		$strCompanyName = $this->objDB_API->EscapeQuote($strCompanyName);
		$strCity = $this->objDB_API->EscapeQuote($strCity);
		$strState = $this->objDB_API->EscapeQuote($strState);
		$strZipCode = $this->objDB_API->EscapeQuote($strZipCode);
		$strZipCodePlus4 = $this->objDB_API->EscapeQuote($strZipCodePlus4);
		$strPreSortRT = $this->objDB_API->EscapeQuote($strPreSortRT);
		$strStars = $this->objDB_API->EscapeQuote($strStars);
		$strGiftGiver = $this->objDB_API->EscapeQuote($strGiftGiver);
		$strAddressSequence = $this->objDB_API->EscapeQuote($strAddressSequence);
		$strOffice = $this->objDB_API->EscapeQuote($strOffice);
		$strStreetNumber = $this->objDB_API->EscapeQuote($strStreetNumber);
		$strStreetName = $this->objDB_API->EscapeQuote($strStreetName);
		$strZone = $this->objDB_API->EscapeQuote($strZone);
		$strSort = $this->objDB_API->EscapeQuote($strSort);
		$strTitle = $this->objDB_API->EscapeQuote($strTitle);
 
		$this->SQL = " 
UPDATE 
	subscribers 
SET 
	EmailAddress = '$strEmailAddress', 
	FirstName = '$strFirstName', 
	LastName = '$strLastName', 
	Active = '$enumActive', 
	MiddleInitial = '$strMiddleInitial', 
	Salutation = '$strSalutation', 
	CompanyName = '$strCompanyName', 
	City = '$strCity', 
	State = '$strState', 
	ZipCode = '$strZipCode', 
	ZipCodePlus4 = '$strZipCodePlus4', 
	PreSortRT = '$strPreSortRT', 
	Stars = '$strStars', 
	ExpirationDate = '$dtmExpirationDate', 
	GiftGiver = '$strGiftGiver', 
	AddressSequence = '$strAddressSequence', 
	Office = '$strOffice', 
	StreetNumber = '$strStreetNumber', 
	StreetName = '$strStreetName', 
	Zone = '$strZone', 
	Sort = '$strSort', 
	SubscriptionTypeIdent = $intSubscriptionTypeIdent, 
	MailRouteIdent = $intMailRouteIdent, 
	Title = '$strTitle' 
WHERE 
	Ident = $intSubscriberID 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to update this subscriber in the database."); 
			
		} 
 
		$this->CleanUp(); 
	} 
 
	function AddSubscriber($strEmailAddress,$strFirstName,$strLastName,$enumActive,$strMiddleInitial,$strSalutation,$strCompanyName,$strCity,$strState,$strZipCode,$strZipCodePlus4,$strPreSortRT,$strStars,$dtmExpirationDate,$strGiftGiver,$strAddressSequence,$strOffice,$strStreetNumber,$strStreetName,$strZone,$strSort,$intSubscriptionTypeIdent,$intMailRouteIdent,$strTitle) { 
	
		$strEmailAddress = $this->objDB_API->EscapeQuote($strEmailAddress);
		$strFirstName = $this->objDB_API->EscapeQuote($strFirstName);
		$strLastName = $this->objDB_API->EscapeQuote($strLastName);
		$strMiddleInitial = $this->objDB_API->EscapeQuote($strMiddleInitial);
		$strSalutation = $this->objDB_API->EscapeQuote($strSalutation);
		$strCompanyName = $this->objDB_API->EscapeQuote($strCompanyName);
		$strCity = $this->objDB_API->EscapeQuote($strCity);
		$strState = $this->objDB_API->EscapeQuote($strState);
		$strZipCode = $this->objDB_API->EscapeQuote($strZipCode);
		$strZipCodePlus4 = $this->objDB_API->EscapeQuote($strZipCodePlus4);
		$strPreSortRT = $this->objDB_API->EscapeQuote($strPreSortRT);
		$strStars = $this->objDB_API->EscapeQuote($strStars);
		$strGiftGiver = $this->objDB_API->EscapeQuote($strGiftGiver);
		$strAddressSequence = $this->objDB_API->EscapeQuote($strAddressSequence);
		$strOffice = $this->objDB_API->EscapeQuote($strOffice);
		$strStreetNumber = $this->objDB_API->EscapeQuote($strStreetNumber);
		$strStreetName = $this->objDB_API->EscapeQuote($strStreetName);
		$strZone = $this->objDB_API->EscapeQuote($strZone);
		$strSort = $this->objDB_API->EscapeQuote($strSort);
		$strTitle = $this->objDB_API->EscapeQuote($strTitle);
 
		$this->SQL = " 
SELECT 
	NextRegCode 
FROM 
	RegCode 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>";
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult != "error") { 
			$CurrentRegCode = $arrResult[0][NextRegCode]; 
			$NextRegCode = $CurrentRegCode+1; 
 
			$this->SQL = " 
UPDATE 
	RegCode 
SET 
	NextRegCode = $NextRegCode 
WHERE 
	NextRegCode = $CurrentRegCode 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>";
			
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 
			
				array_push($this->Errors,"The system was unable to update the next registration code in the database."); 
			
			} else { 
			
				$this->SQL = " 
INSERT INTO 
	subscribers 
	(EmailAddress, 
	FirstName, 
	LastName, 
	SignupDate, 
	Active, 
	MiddleInitial, 
	Salutation, 
	CompanyName, 
	City, 
	State, 
	ZipCode, 
	RegistrationCode, 
	ZipCodePlus4, 
	PreSortRT, 
	Stars, 
	ExpirationDate, 
	GiftGiver, 
	AddressSequence, 
	Office, 
	StreetNumber, 
	StreetName, 
	Zone, 
	Sort, 
	SubscriptionTypeIdent, 
	MailRouteIdent, 
	Title) 
VALUES 
	('$strEmailAddress', 
	'$strFirstName', 
	'$strLastName', 
	NOW(), 
	'$enumActive', 
	'$strMiddleInitial', 
	'$strSalutation', 
	'$strCompanyName', 
	'$strCity', 
	'$strState', 
	'$strZipCode', 
	'REG$CurrentRegCode', 
	'$strZipCodePlus4', 
	'$strPreSortRT', 
	'$strStars', 
	'$dtmExpirationDate', 
	'$strGiftGiver', 
	'$strAddressSequence', 
	'$strOffice', 
	'$strStreetNumber', 
	'$strStreetName', 
	'$strZone', 
	'$strSort', 
	$intSubscriptionTypeIdent, 
	$intMailRouteIdent, 
	'$strTitle') 
				"; 
				#echo "<pre>".$this->SQL."</pre><br>"; 
				
				$intInsertID = $this->objDB_API->ExecuteSQLReturnInsertID($this->SQL);
				if ($intInsertID == "error") { 
				
					array_push($this->Errors,"The system was unable to add this subscriber in the database."); 
					
				} else {
				
					$this->SQL = "
INSERT INTO
	subscribersessions
	(InSession,
	UserID)
VALUES
	('N',
	$intInsertID)
					";
					#echo "<pre>".$this->SQL."</pre><br>"; 
					
					$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
					if ($bolSQLError == "true") {
					
						array_push($this->Errors,"The system was unable to add the subscriber session table entry in the database. This may cause problems with your login. Please inform the <a href=\"mailto:webmaster@akronbugle.com\">System Administrator</a>."); 
						
					}
				
				}
				
			} 
			
		} else { 
		
			array_push($this->Errors,"Could not obtain the next registration code from the database."); 
			
		} 
 
		$this->CleanUp(); 
	}
	
	function ConfirmPassword($strEncodePass,$strPassword,$intUserID) {
	
		$this->SQL = " 
SELECT 
	s.Ident 
FROM 
	subscribers s
WHERE 
	s.Password = ENCODE('$strPassword','$strEncodePass') 
	AND s.Ident = $intUserID
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
		if ($arrResult == "error") { 
		
			array_push($this->Errors,"The system cannot confirm the entered password."); 
		
		} else {
		
			$this->CleanUp(); 
			return $arrResult;
		}
		
		$this->CleanUp(); 
	
	}
	
	function ChangePassword($strEncodePass,$strPassword,$intUserID) {
	
		$this->SQL = " 
UPDATE 
	subscribers
SET
	Password = ENCODE('$strPassword','$strEncodePass') 
WHERE
	Ident = $intUserID
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to change the password for this account."); 
		
		}
	
		$this->CleanUp(); 
	
	}
	
	function ForgotPassword($strUsername,$strEncodePass) { 
 
		$this->SQL = " 
SELECT 
	Password, 
	EmailAddress, 
	FirstName, 
	LastName 
FROM 
	subscribers 
WHERE 
	Username = '$strUsername' 
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 

		$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 	
		
		if ($arrResult != "error") { 
		
			$strPasswordBlob = $arrResult[0][Password]; 
			$strEmailAddress = $arrResult[0][EmailAddress]; 
			$strFirstName = $arrResult[0][FirstName]; 
			$strLastName = $arrResult[0][LastName]; 
			
			$this->SQL = " 
SELECT 
	DECODE('$strPasswordBlob','$strEncodePass') AS Password 
			"; 
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$arrResult = $this->objDB_API->GetDatasetArray($this->SQL); 
			
			if ($arrResult != "error") {
			 
				$strPassword = $arrResult[0][Password]; 
				
				$this->$objTemplate_API->setTemplate("email/lostpassword.tpl"); 
				$this->$objTemplate_API->assign("strUsername",$strUsername); 
				$this->$objTemplate_API->assign("strPassword",$strPassword); 
				$strBody = $this->$objTemplate_API->getTemplateContents();
				
				$strHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Akron Bugle Account Information <akronbugle@aol.com>\r\n"; 
				
				$this->SendEmail("$strFirstName $strLastName<$strEmailAddress>","Akron Bugle Account Information",$strBody,$strHeaders); 
				
			} else { 
			
				array_push($this->Errors,"Could not decrypt this password"); 
				
			} 
			
		} else { 
		
			array_push($this->Errors,"The username you entered does not exist in the database"); 
			
		} 
 
		$this->CleanUp(); 
		return $strEmailAddress; 
 
	} 
	
	function UpdateEmailSettings ($strEmailAddress,$strBreakingNewsAlert,$strWeeklyNewsAlert,$intUserID) {
	
		$this->SQL = " 
UPDATE
	subscribers
SET
	EmailAddress = '$strEmailAddress',
	BreakingNewsAlert = '$strBreakingNewsAlert',
	WeeklyNewsAlert = '$strWeeklyNewsAlert'
WHERE
	Ident = $intUserID
		"; 
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 
		
			array_push($this->Errors,"The system was unable to update your email settings."); 
		
		}
	
		$this->CleanUp(); 
	
	}
 
 
######################################################## 
# 
# Email Methods 
# 
######################################################## 
 
	function SubscriptionInquiry($Name,$Address1,$Address2,$City,$State,$ZipCode,$Phone,$Fax,$Email,$ToEmail) { 
		
		$this->objTemplate_API->setTemplate("email/subscriptioninquiry.tpl"); 
		
		$this->objTemplate_API->assign("strPageTitle","Subscription Inquiry");
		$this->objTemplate_API->assign("Name",$Name); 
		$this->objTemplate_API->assign("Address1",$Address1); 
		$this->objTemplate_API->assign("Address2",$Address2);
		$this->objTemplate_API->assign("City",$City);
		$this->objTemplate_API->assign("State",$State);
		$this->objTemplate_API->assign("ZipCode",$ZipCode);
		$this->objTemplate_API->assign("Phone",$Phone);
		$this->objTemplate_API->assign("Fax",$Fax);
		$this->objTemplate_API->assign("Email",$Email);
		$this->objTemplate_API->assign("arrBanners",$arrBanners);
		
		$strHTML = $this->objTemplate_API->getTemplateContents(); 
 
		$strHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Future Subscriber <$Email>\r\n"; 
 
		$this->SendEmail("$ToEmail","Akron Bugle Subscription Inquiry",$strHTML,$strHeaders); 
		
	} 
	
	function SubmitAddressChange($intUserID,$strAddress1,$strAddress2,$strCity,$strState,$strZipCode,$strZipCodePlus4,$ToEmail) {
	
		$arrSubscriber = $this->GetSubscriber($intUserID);
		$strName = $arrSubscriber[0][FirstName]." ".$arrSubscriber[0][LastName];
		$strEmail = $arrSubscriber[0][EmailAddress];
	
		$this->objTemplate_API->setTemplate("email/changeaddress.tpl"); 
		
		$this->objTemplate_API->assign("strPageTitle","Subscriber Address Change");
		$this->objTemplate_API->assign("Name",$strName); 
		$this->objTemplate_API->assign("Address1",$strAddress1); 
		$this->objTemplate_API->assign("Address2",$strAddress2);
		$this->objTemplate_API->assign("City",$strCity);
		$this->objTemplate_API->assign("State",$strState);
		$this->objTemplate_API->assign("ZipCode",$strZipCode);
		$this->objTemplate_API->assign("ZipCodePlus4",$strZipCodePlus4);
		$this->objTemplate_API->assign("arrBanners",$arrBanners);
		
		$strHTML = $this->objTemplate_API->getTemplateContents(); 
 
		$strHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Akron Bugle Subscriber <$strEmail>\r\n"; 
 
		$this->SendEmail("$ToEmail","Akron Bugle Subscriber Address Change",$strHTML,$strHeaders);
	
	}
	
	function EmailStory($StoryID,$strLongDateFormat,$strShortDateFormat,$intBreakingNewsIdent,$strWebmasterEmail,$strBannerLocation,$intBannersPerPage,$strDefaultURL) {
	
		$arrStory = $this->GetStory($StoryID,$strLongDateFormat,$strShortDateFormat);
		
		$arrCurrentEdition = $this->GetCurrentEdition($strLongDateFormat,$strShortDateFormat);
		
		if ($arrStory[0][EditionIdent] != $intBreakingNewsIdent) {
		
			if ($$arrCurrentEdition[0][Ident] != $arrStory[0][EditionIdent]) {

				$bolHistoric = "True";

			} else {

				$bolHistoric = "False";

			}
			
			$bolBreakingNews = "False";
			$EditionDate =  $arrStory[0][EditionLongDate];
		
		} else {
		
			$bolBreakingNews = "True";
			$EditionDate =  $arrStory[0][StoryLongDate];
		
		}
		
		$strSectionName = $arrStory[0][SectionName];
		$strPageTitle = $arrStory[0][Title];
		$strBodyHTML = preg_replace("/\/images/","http://www.akronbugle.com/images",$arrStory[0][Story]);
		$strBodyHTML = preg_replace("/href=\"\//","href=\"http://www.akronbugle.com/",$strBodyHTML);
		
		$arrBanners = array();
		for ($i=1; $i<=$intBannersPerPage; $i++) {

			array_push($arrBanners,$this->GetRandomBanner(1,$strBannerLocation,$strDefaultURL));

		}
		
		$this->objTemplate_API->setTemplate("email/story.tpl"); 
		
		$this->objTemplate_API->assign("strPageTitle",$strPageTitle);
		$this->objTemplate_API->assign("bolHistoric",$bolHistoric); 
		$this->objTemplate_API->assign("bolBreakingNews",$bolBreakingNews); 
		$this->objTemplate_API->assign("strSectionName",$strSectionName);
		$this->objTemplate_API->assign("EditionDate",$EditionDate);
		$this->objTemplate_API->assign("rstStory",$arrStory);
		$this->objTemplate_API->assign("BodyHTML",$strBodyHTML);
		$this->objTemplate_API->assign("arrBanners",$arrBanners);
		
		$strHTML = $this->objTemplate_API->getTemplateContents(); 
		
		$this->SQL = "
SELECT
	s.EmailAddress
FROM
	subscribers AS s
WHERE
	s.BreakingNewsAlert = 'Y'
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrEmail = $this->objDB_API->GetDatasetArray($this->SQL); 
					
		if ($arrEmail == "error") {
		
			array_push($this->Errors,"The system failed to retrieve Breaking News Alert email addresses."); 
		
		} else {
		
			$intArrayCount = count($arrEmail);
			for ($i=0; $i<=$intArrayCount-1; $i++) {
			
				$strEmail = $arrEmail[$i][EmailAddress];
			
				$strHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Akron Bugle Breaking News <$strWebmasterEmail>\r\n"; 
 
				$this->SendEmail("$strEmail",$strPageTitle,$strHTML,$strHeaders);
			
			}
		
		}
		
		$this->CleanUp();
	
	}
	
	function EmailWeeklyNews($arrCurrentEdition,$EditionID,$strLongDateFormat,$strShortDateFormat,$strWebmasterEmail,$strBannerLocation,$intBannersPerPage,$strDefaultURL) {
		
		$arrHPStories = $this->GetHomePageStoriesByEdition($EditionID,$strLongDateFormat,$strShortDateFormat);
		
		$EditionDate =  $arrCurrentEdition[0][EditionLongDate]."<br>Vol. ".$arrCurrentEdition[0][Volume]."&nbsp;&nbsp;No. ".$arrCurrentEdition[0][Number];

		$strPageTitle = "Akron Bugle Vol. ".$arrCurrentEdition[0][Volume].", No. ".$arrCurrentEdition[0][Number]." ".$arrCurrentEdition[0][EditionLongDate]." is now available online";
		
		$arrBanners = array();
		for ($i=1; $i<=$intBannersPerPage; $i++) {

			array_push($arrBanners,$this->GetRandomBanner(1,$strBannerLocation,$strDefaultURL));

		}
		
		$this->objTemplate_API->setTemplate("email/storysummary.tpl"); 
		
		$this->objTemplate_API->assign("strPageTitle",$strPageTitle);
		$this->objTemplate_API->assign("EditionDate",$EditionDate);
		$this->objTemplate_API->assign("rstHPStories",$arrHPStories);
		$this->objTemplate_API->assign("CurrentEditionID",$EditionID);
		$this->objTemplate_API->assign("arrBanners",$arrBanners);
		
		$strHTML = $this->objTemplate_API->getTemplateContents(); 
		
		$this->SQL = "
SELECT
	s.EmailAddress
FROM
	subscribers AS s
WHERE
	s.WeeklyNewsAlert = 'Y'
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrEmail = $this->objDB_API->GetDatasetArray($this->SQL); 
					
		if ($arrEmail == "error") {
		
			array_push($this->Errors,"The system failed to retrieve Weekly News Alert email addresses."); 
		
		} else {
		
			$intArrayCount = count($arrEmail);
			for ($i=0; $i<=$intArrayCount-1; $i++) {
			
				$strEmail = $arrEmail[$i][EmailAddress];
			
				$strHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Akron Bugle Weekly News <$strWebmasterEmail>\r\n"; 
 
				$this->SendEmail("$strEmail",$strPageTitle,$strHTML,$strHeaders);
			
			}
		
		}
		
		$this->CleanUp();
		
	}
	
######################################################## 
# 
# Banner Ad Methods 
# 
######################################################## 
 
	function GetRandomBanner($intZoneIdent,$strBannerLocation,$strDefaultURL) {
		
		$this->SQL = "
SELECT 
	Ident,
	Image,
	Height,
	Width,
	Description,
	URL
FROM 
	BannerAds 
WHERE 
	BannerAdZoneIdent=$intZoneIdent 
	AND Active='Y' 
ORDER BY 
	RAND() LIMIT 1
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrBanner = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrBanner == "error") {
		
			array_push($this->Errors,"The system failed to retrieve a banner ad."); 
				
		} else {

			$intBanID = $arrBanner[0][Ident];
			$strImage = $arrBanner[0][Image];
			$intHeight = $arrBanner[0][Height];
			$intWidth = $arrBanner[0][Width];
			$strAlt = $arrBanner[0][Description];
			$strURL = $arrBanner[0][URL];

			if ($strURL == '') {

				$strBannerHTML = "<img src=\"".$strDefaultURL.$strBannerLocation.$strImage."\" height=\"".$intHeight."\" width=\"".$intWidth."\" alt=\"".$strAlt."\" border=\"0\">";

			} else {

				$bolPos = strpos($strURL, "mailto");
				if ($bolPos === false) {

					$strBannerHTML = "<a href=\"".$strDefaultURL."/click.php?banid=".$intBanID."&link=".$strURL."\" target=\"new\">";
					$strBannerHTML .= "<img src=\"".$strDefaultURL.$strBannerLocation.$strImage."\" height=\"".$intHeight."\" width=\"".$intWidth."\" alt=\"".$strAlt."\" border=\"0\">";
					$strBannerHTML .= "</a>";

				} else {

					$strBannerHTML = "<a href=\"".$strDefaultURL."/click.php?banid=".$intBanID."&link=".$strURL."\">";
					$strBannerHTML .= "<img src=\"".$strDefaultURL.$strBannerLocation.$strImage."\" height=\"".$intHeight."\" width=\"".$intWidth."\" alt=\"".$strAlt."\" border=\"0\">";
					$strBannerHTML .= "</a>";

				}

			}

			$this->SQL = "
	UPDATE 
		BannerAds 
	SET 
		Hits = Hits+1 
	WHERE 
		Ident = $intBanID
			";
			#echo "<pre>".$this->SQL."</pre><br>"; 
			
			$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
			if ($bolSQLError == "true") { 

				array_push($this->Errors,"The system failed to update stats for this banner ad."); 

			}

			$this->CleanUp();
			return $strBannerHTML;
	
		}
		
		$this->CleanUp();
	
	}
	
	function UpdateBannerClick($intBannerIdent) {
	
		$this->SQL = "
UPDATE 
	BannerAds 
SET 
	Clicks = Clicks+1 
WHERE 
	Ident = $intBannerIdent
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
	
		$bolSQLError = $this->objDB_API->ExecuteSQL($this->SQL);
		if ($bolSQLError == "true") { 

			array_push($this->Errors,"The system failed to update clicks for this banner ad."); 

		}
		
		$this->CleanUp();
	
	}
	
	function GetAllBanners($strLongDateFormat,$strShortDateFormat) {
	
		$this->SQL = "
SELECT
	ba.Ident,
	ba.Name,
	ba.Description,
	ba.Image,
	ba.Width,
	ba.Height,
	ba.URL,
	ba.BannerAdZoneIdent,
	baz.Name AS ZoneName,
	ba.BannerAdTypeIdent,
	bat.Name AS TypeName,
	ba.Hits,
	ba.Clicks,
	ROUND((ba.Clicks / ba.Hits) * 100, 2) AS PerClicks,
	ba.DateCreated,
	DATE_FORMAT(ba.DateCreated, '$strLongDateFormat') AS BannerLongDate, 
	DATE_FORMAT(ba.DateCreated, '$strShortDateFormat') AS BannerShortDate,
	ba.Active
FROM
	BannerAds AS ba
	INNER JOIN
	BannerAdZone AS baz
		ON baz.Ident = ba.BannerAdZoneIdent
	INNER JOIN
	BannerAdType AS bat
		ON bat.Ident = ba.BannerAdTypeIdent
ORDER BY
	ba.Name
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrBanner = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrBanner == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all banner ads."); 
				
		} else {
		
			$this->CleanUp();
			return $arrBanner;
		
		}
		
		$this->CleanUp();
	
	}
	
	function GetAllActiveBanners ($strLongDateFormat,$strShortDateFormat) {
	
		$this->SQL = "
SELECT
	ba.Ident,
	ba.Name,
	ba.Description,
	ba.Image,
	ba.Width,
	ba.Height,
	ba.URL,
	ba.BannerAdZoneIdent,
	baz.Name AS ZoneName,
	ba.BannerAdTypeIdent,
	bat.Name AS TypeName,
	ba.Hits,
	ba.Clicks,
	ROUND((ba.Clicks / ba.Hits) * 100, 2) AS PerClicks,
	ba.DateCreated,
	DATE_FORMAT(ba.DateCreated, '$strLongDateFormat') AS BannerLongDate, 
	DATE_FORMAT(ba.DateCreated, '$strShortDateFormat') AS BannerShortDate,
	ba.Active
FROM
	BannerAds AS ba
	INNER JOIN
	BannerAdZone AS baz
		ON baz.Ident = ba.BannerAdZoneIdent
	INNER JOIN
	BannerAdType AS bat
		ON bat.Ident = ba.BannerAdTypeIdent
WHERE
	ba.Active = 'Y'
ORDER BY
	ba.Name
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrBanner = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrBanner == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all active banner ads."); 
				
		} else {
		
			$this->CleanUp();
			return $arrBanner;
		
		}
		
		$this->CleanUp();
	
	}
	
	function GetAllInactiveBanners($strLongDateFormat,$strShortDateFormat) {
	
		$this->SQL = "
SELECT
	ba.Ident,
	ba.Name,
	ba.Description,
	ba.Image,
	ba.Width,
	ba.Height,
	ba.URL,
	ba.BannerAdZoneIdent,
	baz.Name AS ZoneName,
	ba.BannerAdTypeIdent,
	bat.Name AS TypeName,
	ba.Hits,
	ba.Clicks,
	ROUND((ba.Clicks / ba.Hits) * 100, 2) AS PerClicks,
	ba.DateCreated,
	DATE_FORMAT(ba.DateCreated, '$strLongDateFormat') AS BannerLongDate, 
	DATE_FORMAT(ba.DateCreated, '$strShortDateFormat') AS BannerShortDate,
	ba.Active
FROM
	BannerAds AS ba
	INNER JOIN
	BannerAdZone AS baz
		ON baz.Ident = ba.BannerAdZoneIdent
	INNER JOIN
	BannerAdType AS bat
		ON bat.Ident = ba.BannerAdTypeIdent
WHERE
	ba.Active = 'N'
ORDER BY
	ba.Name
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrBanner = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrBanner == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all inactive banner ads."); 
				
		} else {
		
			$this->CleanUp();
			return $arrBanner;
		
		}
		
		$this->CleanUp();
	
	}
	
	function GetBanner($intBannerIdent,$strLongDateFormat,$strShortDateFormat) {
	
		$this->SQL = "
SELECT
	ba.Ident,
	ba.Name,
	ba.Description,
	ba.Image,
	ba.Width,
	ba.Height,
	ba.URL,
	ba.BannerAdZoneIdent,
	'ZoneName' = baz.Name,
	ba.BannerAdTypeIdent,
	'TypeName' = bat.Name,
	ba.Hits,
	ba.Clicks,
	ba.DateCreated,
	DATE_FORMAT(ba.DateCreated, '$strLongDateFormat') AS BannerLongDate, 
	DATE_FORMAT(ba.DateCreated, '$strShortDateFormat') AS BannerShortDate,
	ba.Active
FROM
	BannerAds AS ba
	INNER JOIN
	BannerAdZone AS baz
		ON baz.Ident = ba.BannerAdZoneIdent
	INNER JOIN
	BannerAdType AS bat
		ON bat.Ident = ba.BannerAdTypeIdent
WHERE
	ba.Ident = $intBannerIdent
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrBanner = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrBanner == "error") {
		
			array_push($this->Errors,"The system failed to retrieve  banner id#".$intBannerIdent."."); 
				
		} else {
		
			$this->CleanUp();
			return $arrBanner;
		
		}
		
		$this->CleanUp();
	
	}
	
	function GetBannerSummaryStats() {
	
		$this->SQL = "
SELECT
	SUM(Clicks) AS ClickSum,
	SUM(Hits) AS HitSum
FROM
	BannerAds
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
		
		$arrSummaryStats = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrSummaryStats == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all inactive banner ads."); 
				
		} else {
		
			$this->CleanUp();
			return $arrSummaryStats;
		
		}
		
		$this->CleanUp();
	
	}
	
	function GetActiveBannerAdZones() {
	
		$this->SQL = "
SELECT
	baz.Ident,
	baz.Name,
	baz.Description,
	baz.Active
FROM
	BannerAdZone AS baz
WHERE
	baz.Active = 'Y'
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
	
		$arrZones = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrZones == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all active banner ad zones."); 
				
		} else {
		
			$this->CleanUp();
			return $arrZones;
		
		}
		
		$this->CleanUp();

	}
	
	function GetActiveBannerAdTypes() {
	
		$this->SQL = "
SELECT
	bat.Ident,
	bat.Name,
	bat.Description,
	bat.Active
FROM
	BannerAdType AS bat
WHERE
	bat.Active = 'Y'
		";
		#echo "<pre>".$this->SQL."</pre><br>"; 
	
		$arrTypes = $this->objDB_API->GetDatasetArray($this->SQL); 
		
		if ($arrTypes == "error") {
		
			array_push($this->Errors,"The system failed to retrieve all active banner ad types."); 
				
		} else {
		
			$this->CleanUp();
			return $arrTypes;
		
		}
		
		$this->CleanUp();

	}
 
} 
?>