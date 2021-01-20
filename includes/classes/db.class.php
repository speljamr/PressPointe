<? 
############################################################################ 
# 
# Project: PressPointe 
# Filename: db.class.php 
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
# 01/31/2003 - File created - TJF 
# 
############################################################################ 
 
require_once(ADODB_DIR."adodb.inc.php"); 

class db { 

############################################################################ 
# 
# Class Properties 
# 
############################################################################ 
 
	var $DB_Host; 
	var $DB_User; 
	var $DB_Pass; 
	var $DB_Name; 
	var $Errors; 
 
############################################################################ 
# 
# Class Constructor 
# 
############################################################################ 
	
	function db($dbHost,$dbUser,$dbPass,$dbName) {
	
		$this->Errors = array();
	
		if ($dbName != "") { 
		
			$this->SetDB_Name($dbName); 
			
		} else { 
		
			array_push($this->Errors,"Database Name was not passed"); 
			
		} 
		
		if ($dbHost != "") { 
		
			$this->SetDB_Host($dbHost); 
			
		} else { 
		
			array_push($this->Errors,"Database Host was not passed"); 
			
		} 
		
		if ($dbUser != "") { 
		
			$this->SetDB_User($dbUser); 
			
		} else { 
		
			array_push($this->Errors,"Database User was not passed"); 
			
		} 
		
		if ($dbPass != "") { 
		
			$this->SetDB_Pass($dbPass); 
			
		} else { 
		
			$this->SetDB_Pass(""); 
			
		} 
 
		$ADODB_CACHE_DIR = '/www/htdocs/akronbuglecom/adodb_cache'; 
	
	}
	
############################################################################ 
# 
# General Methods 
# 
############################################################################ 

	function GetErrors() { 
		
		$arrErrors = $this->Errors;
		$this->Errors = ""; 
		return $arrErrors; 
		
	} 
	
	function SetDB_Name($dbName) { 
		$this->DB_Name = $dbName; 
	} 
 
	function GetDB_Name() { 
		return $this->DB_Name; 
	} 
 
	function SetDB_Host($dbHost) { 
		$this->DB_Host = $dbHost; 
	} 
 
	function GetDB_Host() { 
		return $this->DB_Host; 
	} 
 
	function SetDB_User($dbUser) { 
		$this->DB_User = $dbUser; 
	} 
 
 
	function SetDB_Pass($dbPass) { 
		$this->DB_Pass = $dbPass; 
	} 
 
	function GetDB_User() { 
		return $this->DB_Pass; 
	} 
	
############################################################################ 
# 
# Database Methods 
# 
############################################################################ 
 
	function OpenDBConnection() { 
 
		$objConn = &ADONewConnection('mysql'); 
		
		$objConn->Connect($this->DB_Host,$this->DB_User,$this->DB_Pass,$this->DB_Name);
		
		if ($objConn->ErrorNo() > 0) { 
				
			array_push($this->Errors,"Could not obtain a connection to the database"); 
			$objConn= "error";
					
		}  else {

			$objConn->SetFetchMode('ADODB_FETCH_ASSOC'); 

		}	
		
		return $objConn; 
 
	} 
 
	function CloseDBConnection($objConn) { 
 
		$objConn->Close(); 
 
	} 

	function ExecuteSQL($strSQL) {
	
		$bolError = "false";
		
		$objConn = $this->OpenDBConnection(); 

		$objConn->Execute($strSQL);
		
		if ($objConn->ErrorNo() > 0) { 
			
			$bolError = "true";
			
		} 

		$this->CloseDBConnection($objConn); 	
		
		return $bolError;

	}
	
	function ExecuteSQLReturnInsertID($strSQL) {
		
		$objConn = $this->OpenDBConnection(); 

		$objConn->Execute($strSQL);
		
		if ($objConn->ErrorNo() > 0) { 
			
			$intInsertID = "error";
			
		}  else {

			$intInsertID = $objConn->Insert_ID(); 
	
		}	

		$this->CloseDBConnection($objConn); 
		
		return $intInsertID;

	}
	
	function GetDatasetArray($strSQL) {	
	
		$objConn = $this->OpenDBConnection(); 
		$arrResult = $objConn->GetAll($strSQL); 
				
		if ($objConn->ErrorNo() > 0) { 
				
			$arrResult = "error";
					
		} 
		
		$this->CloseDBConnection($objConn); 
				
		return $arrResult;

	}
	
	function EscapeQuote($strValue) {

		$strValue = preg_replace("/'/","''",$strValue);
		
		return $strValue;
	
	}
 
} 
?>
