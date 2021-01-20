<? 
############################################################################ 
# 
# Project: PressPointe 
# Filename: template.class.php 
# File Version: 1.10.00 
# Copyright: ©copyright 2004 Timothy J. Finucane 
# 
# Based on a class by Joao Prado Maia <jcpm@zipmail.com> http://www.oreillynet.com/pub/au/98 
# Modified By Timothy J. Finucane <speljamr@speljamr.com> 
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
# 09-21-2003 - File created - TJF 
# 
############################################################################ 
 
require_once(SMARTY_DIR."Smarty.class.php"); 
 
class template extends Smarty { 
 
    var $smarty; 
    var $tpl_name = ""; 
 
    function template() { 
        $this->smarty = new Smarty; 
        $this->smarty->template_dir = SMARTY_TEMPLATES; 
        $this->smarty->compile_dir = SMARTY_TEMPLATES_C; 
        $this->smarty->config_dir = SMARTY_CONFIGS; 
    } 
 
    function setTemplate($tpl_name) { 
        $this->tpl_name = $tpl_name; 
    } 
 
    function assign($var_name, $value = "") { 
        if (!is_array($var_name)) { 
            $this->smarty->assign($var_name, $value); 
        } else { 
            $this->smarty->assign($var_name); 
        } 
    } 
 
    function bulkAssign($array) { 
        while (list($key, $value) = each($array)) { 
            $this->smarty->assign($key, $value); 
        } 
    } 
 
    function displayTemplate() { 
        $this->smarty->display($this->tpl_name); 
    } 
 
    function getTemplateContents() { 
        return $this->smarty->fetch($this->tpl_name); 
    } 
} 
?>