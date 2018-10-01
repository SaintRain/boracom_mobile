<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Перенаправляет на десктопную-версию
*////////////////////////////////////////////////////////////////////////////////////////////
class redirectToDesktop extends DetectMobile {
	
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

        require_once (__DIR__.'/../../../tools/mobiledetect/Mobile_Detect.php');
        $detect = new Mobile_Detect;


        if (!$detect->isMobile() ) {
            $url= 'http://boracom.ru'.$_SERVER['REQUEST_URI'];

            return header("location: $url", true, 301);
        }
	}



}

?>