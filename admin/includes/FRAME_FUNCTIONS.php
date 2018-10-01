<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Класс-библиотека общедоступных полезных функций разработчика
*////////////////////////////////////////////////////////////////////////////////////////////

class FRAME_FUNCTIONS extends GeneralFunctions  {


	/**
	 * Формирует дерево категорй
	 *
	 * @param string $pk_field
	 * @param string $selected_filed
	 * @param string $parent_field
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */	
	function makeTree($all_tree_records, $pk_field, $selected_filed, $parent_field,  $ParentID, $lvl) {

		$lvl++;
		$tree		=   array();
		foreach ($all_tree_records as $key=>$row) {
			if ($row[$parent_field]==$ParentID) {
				$row['deep']				= $lvl;
				$tree['id'.$row[$pk_field]]	= $row;
				$tmp						= $this->makeTree($all_tree_records, $pk_field, $selected_filed, $parent_field, $row['id'], $lvl);
				if (is_array($tmp))
				$tree	= array_merge($tree, $tmp);
			}
		}
		return $tree;
	}



	/**
     * Генерирует пароль
     *
     * @param int $number
     * @return string
     */
	function generate_password($number) {
		$arr = array(
		'a','b','c','d','e','f',
		'g','h','i','j','k','l',
		'm','n','o','p','r','s',
		't','u','v','x','y','z',
		'A','B','C','D','E','F',
		'G','H','I','J','K','L',
		'M','N','O','P','R','S',
		'T','U','V','X','Y','Z',
		'1','2','3','4','5','6',
		'7','8','9','0');

		$pass = '';
		for($i = 0; $i < $number; $i++) {
			// Вычисляем случайный индекс массива
			$index = rand(0, count($arr) - 1);
			$pass .= $arr[$index];
		}
		return $pass;
	}



	/**
	 * Число прописью
	 *
	 * @param int $num
	 * @return string
	 */
	function num_propis($num) { 

		// Все варианты написания чисел прописью от 0 до 999 скомпануем в один небольшой массив
		$m=array(
		array('ноль'),
		array('-','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
		array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'),
		array('-','-','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'),
		array('-','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'),
		array('-','одна','две')
		);

		// Все варианты написания разрядов прописью скомпануем в один небольшой массив
		$r=array(
		array('...ллион','','а','ов'), // используется для всех неизвестно больших разрядов
		array('тысяч','а','и',''),
		array('миллион','','а','ов'),
		array('миллиард','','а','ов'),
		array('триллион','','а','ов'),
		array('квадриллион','','а','ов'),
		array('квинтиллион','','а','ов')
		// ,array(... список можно продолжить
		);

		if($num==0)return$m[0][0]; 	// Если число ноль, сразу сообщить об этом и выйти
		$o=array(); 				// Сюда записываем все получаемые результаты преобразования

		// Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
		foreach(array_reverse(str_split(str_pad($num,ceil(mb_strlen($num)/3)*3,'0',STR_PAD_LEFT),3))as$k=>$p){
			$o[$k]=array();

			// Алгоритм, преобразующий трехзначное число в строку прописью
			foreach($n=str_split($p)as$kk=>$pp)
			if(!$pp)continue;else
			switch($kk){
				case 0:$o[$k][]=$m[4][$pp];break;
				case 1:if($pp==1){$o[$k][]=$m[2][$n[2]];break 2;}else$o[$k][]=$m[3][$pp];break;
				case 2:if(($k==1)&&($pp<=2))$o[$k][]=$m[5][$pp];else$o[$k][]=$m[1][$pp];break;
			}$p*=1;if(!$r[$k])$r[$k]=reset($r);

			// Алгоритм, добавляющий разряд, учитывающий окончание руского языка
			if($p&&$k)switch(true){
				case preg_match("/^[1]$|^\d*[0,2-9][1]$/",$p):$o[$k][]=$r[$k][0].$r[$k][1];break;
				case preg_match("/^[2-4]$|\d*[0,2-9][2-4]$/",$p):$o[$k][]=$r[$k][0].$r[$k][2];break;
				default:$o[$k][]=$r[$k][0].$r[$k][3];break;
			}$o[$k]=implode(' ',$o[$k]);
		}

		return implode(' ',array_reverse($o));
	}

}
?>