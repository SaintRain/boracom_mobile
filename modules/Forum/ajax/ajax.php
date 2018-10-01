<?php
session_start();

header('Content-Type: text/html; charset=UTF-8');
define('REQUIRE_ADDITIONAL_FILES', 			false);		 //если флаг выставлен, то будует подключен язык админки и файловый менеджер	

/*******************************************************************************
 *
 *  Занимается обработкой присланных объектом XMLHttpRequest запросов.
 *
 ******************************************************************************/
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
require_once '../../../'.SETTINGS_ADMIN_PATH.'/config.php';			//класс для работы с БД
require_once '../../../'.SETTINGS_ADMIN_PATH.'/DbConnection.php';			//класс для работы с БД
$mysql	= new DbConnection();

//$_SESSION['shopingcart']='';

$func = $_GET['func'];

switch ($func) {
	
case 'SetCookie':{	
	print_r($_GET);
	$_SESSION[$_GET['name']]	= $_GET['v'];	
	echo $_GET['name'].'*';
break;	
}	
case 'getCookie':{
	if (isset($_SESSION[$_GET['name']])) echo $_SESSION[$_GET['name']];
	else echo '';
	
break;	
}
case 'getTotalSumm': {
	
	
	//берем валюту
	if (isset($_SESSION['сurrency_id'])) {
		$query 					= "SELECT * FROM `internetshop_currencies` WHERE `id`='{$_SESSION['сurrency_id']}'";
		}
	else {
		$query 					= "SELECT * FROM `internetshop_currencies` ORDER BY `general` DESC LIMIT 1";
		}
							
	$result						= $mysql->executeSQL($query);
	$currency					= $mysql->fetchAssoc($result);
	
	
	//берём курсы продажы валюты
	$courses					= array();
	$query 						= "SELECT * FROM `internetshop_courses` WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
	$result						= $mysql->executeSQL($query);
	while ($row= $mysql->fetchAssoc($result)) {
		$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];											
		}		
			
	$total_summ		= 0;   
	$total_count	= 0;
	if (isset($_SESSION['shopingcart'])) {
         $cookieData	= $_SESSION['shopingcart'];				
       	 $list 			= explode(';', $cookieData);
       	 
       				
       	 if (isset($list[1])) {
       	
       		$zakazList	= array();
       	
       		for ($i=0; $i<count($list)-1; $i=$i+2) {
       			$tmp['id']		= $list[$i];
       			$tmp['count']	= $list[$i+1];       		
	       		$zakazList[]		= $tmp;
		       	}
		       	
 		$total_summ		= 0;   	
	    $total_count	= 0;	    
	    $datalist 		= array();
	    for ($i=0; $i<count($zakazList); $i++) {
	    	
	    	$shitat			= false;
	    	$query			= "SELECT `price`, `сurrency_id` FROM `internetshop_products` WHERE id='{$zakazList[$i]['id']}'";		
    	    $result			= $mysql->executeSQL($query);
	        $tmp			= $mysql->fetchAssoc($result);	        
	        $tmp['count']	= $zakazList[$i]['count'];
	        
       		
       		$datalist[]	= $tmp;
       		$shitat=true;
       		       		   
       		//переводим по курсу
			if ($tmp['сurrency_id']!=$currency['id']) {
				
				//переводим по курсу
				if ($tmp['сurrency_id']!=$currency['id']) {
					if (isset($courses[$currency['id']][$tmp['сurrency_id']])) {
						$course		= $courses[$currency['id']][$tmp['сurrency_id']];
						$tmp['price']	= $tmp['price']/$course;
						/*
						if ($course>1)  {
							$tmp['price']	= $tmp['price']*$course;
							}
						else { 
							$tmp['price']	= $tmp['price']/$course;
							}
							*/
						}
					else {
						$tmp['price']	= 0;
						}
					}
								
				}
				
	       if ($shitat) {	 
	       		if ($tmp['price']>0) {
        			$total_summ+=$tmp['price']*$tmp['count'];	    
		       		}
		       	   $total_count+=$tmp['count'];        		
	    	   }
	   	 	}	         
        }        
	}
	    	    		

if (!is_numeric($total_summ)) $total_summ=0;
 $total_summ=number_format($total_summ, 0, ',', ' ');
 echo $total_summ.'|'.$total_count;
 break;
 }

}





?>