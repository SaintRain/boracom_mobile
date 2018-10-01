<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод формы голосования
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowVoiting extends Voiting {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('add_voiting'):			$this->add_voiting(); 	break;
		default:						$this->START(); 		break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		$answers			= array();
		$answers_ids		= array();
		$query					= "SELECT t.* FROM `{$this->tablePrefix}questions` AS `t` WHERE t.main='1' AND t.enable='1'";
		$result					= $this->mysql->executeSQL($query);
		if ($question			= $this->mysql->fetchAssoc($result)) {
			$query				= "SELECT t.* FROM `{$this->tablePrefix}answers` AS `t` WHERE t.question_id='{$question['id']}' AND t.enable='1'";
			$result				= $this->mysql->executeSQL($query);
			while ($row			= $this->mysql->fetchAssoc($result)) {
				$answers[$row['id']]	= $row;
				$answers_ids[]			= $row['id'];
			}

			$total_summ_voiting	= 0;
			if (count($answers_ids)>0) {
				$answers_ids	= implode(',', $answers_ids);
				$query			= "SELECT t.* FROM `{$this->tablePrefix}results` AS `t` WHERE t.answer_id IN ($answers_ids)";
				$result			= $this->mysql->executeSQL($query);
				while ($row		= $this->mysql->fetchAssoc($result)) {

					if (!isset($answers[$row['answer_id']]['summ_ball'])) $answers[$row['answer_id']]['summ_ball']=0;
					if (!isset($answers[$row['answer_id']]['summ_voiting'])) $answers[$row['answer_id']]['summ_voiting']=0;
					
					$answers[$row['answer_id']]['summ_ball']+=$row['ball'];		//считаем общее количество баллов
					if ($row['ball']>0) {
						$answers[$row['answer_id']]['summ_voiting']+=1;			//считаем количество проголосовавших за данный вариант ответа
					}
					$total_summ_voiting++;										//считаем общее количество проголосовавших
				}

				foreach ($answers as $key=>$q) {

					if (isset($q['summ_ball']))  {						
						$answers[$key]['percent']	= round(($q['summ_ball']/$total_summ_voiting)*100, 0);		//вычисляем процент 
						$answers[$key]['width']		= $answers[$key]['percent']*($this->settings['width']/100); //вычисляем ширину взависимости от настройки
					}
					else {
						$answers[$key]['width']			= 1;
						$answers[$key]['summ_voiting']	= 0;
						$answers[$key]['summ_ball']		= 0;
						$answers[$key]['percent']		= 0;
					}
				}
			}
		}
		
		if (isset($_SESSION['user_is_voited'])) {
			$user_is_voited	= true;
		}
		else {
			//отсчитываем текущее время, минус 12 минут назад
			$now			= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), -0.2, 'Y-m-d H:i:s');

			//проверяем голосовал пользователь раньше или нет
			$query			= "SELECT t.* FROM `{$this->tablePrefix}results` AS `t` WHERE t.ip='{$_SERVER['REMOTE_ADDR']}' AND t.datetime>'$now'";
			$result			= $this->mysql->executeSQL($query);
			list($user_voit)= $this->mysql->fetchRow($result);
			if ($user_voit) {			
				$user_is_voited	= true;
			}
			else {
				$user_is_voited	= false;
			}
		}
		
		$this->smarty->assign('user_is_voited', 	   	$user_is_voited);
		$this->smarty->assign('question', 	   			$question);
		$this->smarty->assign('answers', 				$answers);
		$this->smarty->assign('settings',  				$this->settings);
		$this->smarty->assign('question_table_name', 	$this->tablePrefix.'questions');
		$this->smarty->assign('table_name', 			$this->tablePrefix.'answers');
		$this->smarty->assign('moduleInfo', 			$this->moduleInfo);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_form.tpl');
	}


	
	/**
	 * добавление отзыва
	 *
	 */
	function add_voiting() {
		GLOBAL $FRAME_FUNCTIONS;
		
		//отсчитываем текущее время, минус 12 минут назад
		$now					= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), -0.2, 'Y-m-d H:i:s');

		//проверяем голосовал пользователь раньше или нет
		$query					= "SELECT t.* FROM `{$this->tablePrefix}results` AS `t` WHERE t.ip='{$_SERVER['REMOTE_ADDR']}' AND t.datetime>'$now'";
		$result					= $this->mysql->executeSQL($query);
		list($user_is_voited)	= $this->mysql->fetchRow($result);
		 						
		if (!isset($_SESSION['user_is_voited']) && isset($this->posts['answer_id']) && !$user_is_voited) {
			$posts						= $this->posts;
			$posts['ip']				= $_SERVER['REMOTE_ADDR'];
			$posts['datetime']			= gmdate('Y-m-d H:i:s');
			$api						= $this->getApiObject($this->tablePrefix.'results', $posts);
			$api->dataInsert();

			$_SESSION['user_is_voited']	= true;			
		}
		$this->START();
	}



}

?>