<? 
############################################################################ 
# 
# Project: PressPointe 
# Filename: classinstantiation.class.php 
# File Version: 1.10.00 
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
# 01/28/2003 - File created - TJF 
# 
############################################################################ 
 
class classInstantiation { 
 
   function callClass($objClass) { 
 
       return new $objClass(); 
 
   } 

   function callDBClass($objClass,$dbHost,$dbUser,$dbPass,$dbName) { 
 
       return new $objClass($dbHost,$dbUser,$dbPass,$dbName); 
 
   }  

   function callSessionClass($objClass,&$objDB,&$objTemplate) { 
 
       return new $objClass($objDB,$objTemplate); 
 
   }  
 
} 
?>