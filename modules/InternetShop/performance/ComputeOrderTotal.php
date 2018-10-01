<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вычислить стоимость заказа
*////////////////////////////////////////////////////////////////////////////////////////////
class ComputeOrderTotal extends InternetShop {

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

		//пересчитываем стоимость заказа
		if ($this->after_edit_action!='delete' && isset($this->gets['id'])) {
			if ($this->after_edit_tablename==$this->tablePrefix.'orders') {
				if (isset($this->after_edit_old_fields['id'])) {
					$order_id=$this->after_edit_old_fields['id'];
				}
			}
			else if ($this->after_edit_tablename==$this->tablePrefix.'orders_composition') {
				if (isset($this->after_edit_old_fields['order_id'])) {
					$order_id=$this->after_edit_old_fields['order_id'];
				}
			}

			if ($order_id) {
				//берём выбранную платёжную систему
				$products			= array();
				$query 				= "SELECT  t.product_id, t.amount
				FROM `{$this->tablePrefix}orders_composition` AS `t`
				WHERE t.order_id='$order_id'";

				$result					= $this->mysql->executeSQL($query);
				while (list($product_id, $amount)= $this->mysql->fetchRow($result)) {
					$products[]			= $product_id;
					$products[]			= $amount;
				}

				list($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery)= $this->getOrderSumm($products, false, false);

				$query 					= "UPDATE `{$this->tablePrefix}orders` SET `total_price`='$total_summ', `order_cost_gross`='$total_summ_dustly' WHERE `id`='$order_id'";
				$result					= $this->mysql->executeSQL($query);
			}
		}
	}
}

?>