<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Просмотр состава заказа
*////////////////////////////////////////////////////////////////////////////////////////////
class ViewOrderComposition extends InternetShop {
	
	/**
     * Определяем какой метод выполнить
     * 
     */
	function linker() {

		//вызываем метод - обработчик
		switch ($this->action):
		//case (''):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовый метод, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

        $order_id   = $this->gets['id'];
        $page_id    = $this->gets['page_id'];
        $tag_id     = $this->gets['tag_id'];
        //делаем перенапраление
        header('location:/'.SETTINGS_ADMIN_PATH."/index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$this->tablePrefix}orders_composition&search=$order_id&search_by_field=order_id");
	}



}

?>