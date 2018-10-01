<?php /* Smarty version 2.6.26, created on 2014-09-14 10:34:09
         compiled from compiler/performance_block.tpl */ ?>
<?php echo '<?php'; ?>

/*///////////////////////////////////////////////////////////////////////////////////////////
<?php echo $this->_tpl_vars['block']['description']; ?>

*////////////////////////////////////////////////////////////////////////////////////////////
class <?php echo $this->_tpl_vars['block']['name']; ?>
 extends <?php echo $this->_tpl_vars['module']['name']; ?>
<?php echo ' {
	
	/**
     * Определяем какой метод выполнить
     * 
     */
	function linker() {

		//вызываем метод - обработчик
		switch ($this->action):
		//case (\'\'):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовый метод, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		//$this->smarty->assign(\'some_data\', $some_data);
		//$this->contentOUT = $this->smarty->fetch($this->tplLocation.\'show_some.tpl\');
	}



}

?>'; ?>