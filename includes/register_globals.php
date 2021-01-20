<?php
############################################################################ 
# 
# Project: PressPointe 
# Filename: register_globals.php 
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
# 04/30/2004 - File created - TJF 
# 
############################################################################ 

$arrGlobals = array_merge(&$_ENV,&$_GET,&$_POST,&$_COOKIE,&$_SERVER);

# Destroy all variables set by register_globals
while(list($key) = each($arrGlobals)) {

	unset(${$key});
	
}

reset($arrGlobals);

while ($element = each($arrGlobals)) {

 $vvVariable = $element['key'];
 $$vvVariable = $element['value'];

}

?>