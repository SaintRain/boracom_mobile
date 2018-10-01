<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {assign} compiler function plugin
 *
 * Type:     compiler function<br>
 * Name:     assign<br>
 * Purpose:  assign a value to a template variable
 * @link http://smarty.php.net/manual/en/language.custom.functions.php#LANGUAGE.FUNCTION.ASSIGN {assign}
 *       (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com> (initial author)
 * @author messju mohr <messju at lammfellpuschen dot de> (conversion to compiler function)
 * @param string containing var-attribute and value-attribute
 * @param Smarty_Compiler
 */
function smarty_compiler_break($contents, &$smarty){
   return 'break;';
}

/* vim: set expandtab: */

?>
