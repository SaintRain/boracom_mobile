<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {ftex} function plugin
 *
 * Type:     function<br>
 * Name:     ftex<br>
 * Purpose:  переводит фразу
 * @author GoodCMS
 * @param string
 * @param Smarty
 */
function smarty_modifier_ftext($string)
{ 
	GLOBAL $GENERAL_FUNCTIONS;	
		
    $numargs 				= func_num_args();   
	$arg_list 				= func_get_args(); 	
   	$data					= array_slice($arg_list, 1); 
	$string					= $GENERAL_FUNCTIONS->ftext($string, $data);	     
			
    return $string; 	
}

/* vim: set expandtab: */

?>
