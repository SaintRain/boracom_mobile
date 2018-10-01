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
 * Name:     furl<br>
 * Purpose:  Формирует Friendly URL из простой ссылки
 * @author GoodCMS
 * @param string
 * @param Smarty
 */
function smarty_modifier_furl($url)
{ 
	GLOBAL $GENERAL_FUNCTIONS;	
	
	$new_url	= $GENERAL_FUNCTIONS->furl($url);
	
	
    return $new_url; 	
}

/* vim: set expandtab: */

?>
