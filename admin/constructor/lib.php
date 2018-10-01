<?php
/**
* Сохраняем историю редактирования
*
* @param int $module_id - модуль
* @param int $operation - тип редактирования
* 	0- удалить
* 	1- вставить
* 	2- обновить
* @param int $object_type - тип объекта
* 	0- модуль
* 	1- блок
*	2- функция
*  3- шаблон
*  4- настройка блока
*  5- таблица
*  6- поле
*  7- настройка поля
*  8- редактируемые таблицы блока
* @param int $object_id  - id редактируемого объекта
*/
function setHistory($module_id, $operation, $object_type, $object_id, $object_name='', $object_name_second='') {
	GLOBAL $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE31, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE24, $MYSQL_CTR_TABLE30, $mysql;

	$obrabotat	= true;
	$not_insert	= 0;

	if ($operation==0) {
		//если удаляемый элемент был добавлен, то выставляем флаг, чтоб не вставлять историю об удалении
		$query				= "SELECT count(*) FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `operation`='1' AND  `object_type`='$object_type' AND `object_id`='$object_id'";
		$result				= $mysql->executeSQL($query);
		list($not_insert)	= $mysql->fetchRow($result);

		//удаляем историю о редактировании объекта
		$query		= "DELETE FROM `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `object_type`='$object_type' AND `object_id`='$object_id'";
		$result		= $mysql->executeSQL($query);
		switch ($object_type) {
			case 1:  //если удаляем блок
			//удаляем историю о редактировании связных шаблонов
			$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE30` WHERE `block_id`='$object_id'";
			$result		= $mysql->executeSQL($query);
			$ids		= '';
			while ($row	= $mysql->fetchAssoc($result)) {
				$ids.=$row['id'].',';
			}
			if ($ids!='')	{
				$ids		= mb_substr($ids,0,-1);
				$query		= "DELETE FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `object_type`='3' AND `object_id` IN ($ids)";
				$result		= $mysql->executeSQL($query);
			}	

			//удаляем историю о редактировании  настроек
			$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE28` WHERE `block_id`='$object_id'";
			$result		= $mysql->executeSQL($query);
			$ids='';
			while ($row	= $mysql->fetchAssoc($result)) {
				$ids.=$row['id'].',';
			}
			if ($ids!='')	{
				$ids		= mb_substr($ids,0,-1);
				$query		= "DELETE FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `object_type`='4' AND `object_id` IN ($ids)";
				$result		= $mysql->executeSQL($query);
			}

			break;
			case 5:  //если удаляем таблицу
			//удаляем историю о редактировании  поля
			$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='$object_id'";
			$result		= $mysql->executeSQL($query);
			$ids='';
			while ($row	= $mysql->fetchAssoc($result)) {
				$ids.=$row['id'].',';
			}

			if ($ids!='')	{
				$ids		= mb_substr($ids,0,-1);
				$query		= "DELETE FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `object_type`='6' AND `object_id` IN ($ids)";
				$result		= $mysql->executeSQL($query);

				//удаляем историю о редактировании настроек поля
				$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE25` WHERE `field_id` IN ($ids)";
				$result		= $mysql->executeSQL($query);
				$ids='';
				while ($row	= $mysql->fetchAssoc($result)) {
					$ids.=$row['id'].',';
				}

				if ($ids!='')	{
					$ids		= mb_substr($ids,0,-1);
					$query		= "DELETE FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `object_type`='7' AND `object_id` IN ($ids)";
					$result		= $mysql->executeSQL($query);
				}
			}

			break;
			case 6:  //если удаляем поле
			//удаляем историю о редактировании настроек поля
			$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE25` WHERE `field_id` IN ($object_id)";
			$result		= $mysql->executeSQL($query);
			$ids='';
			while ($row	= $mysql->fetchAssoc($result)) {
				$ids.=$row['id'].',';
			}
			if ($ids!='')	{
				$ids		= mb_substr($ids,0,-1);
				$query		= "DELETE FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND (`object_type`='7' OR `object_type`='6') AND `object_id` IN ($ids)";
				$result		= $mysql->executeSQL($query);
			}
			break;
		}
	}
	//проверяем нужно ли добавлять обновление, если была вставка этой записи
	elseif ($operation==2) {
		$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `operation`='1' AND `object_type`='$object_type' AND `object_id`='$object_id'";
		$result		= $mysql->executeSQL($query);
		list($rec)	= $mysql->fetchRow($result);
		if ($rec>0) {
			$obrabotat=false;
		}
	}

	if ($obrabotat) {
		$query		= "SELECT `id` FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='$module_id' AND `operation`='$operation' AND  `object_type`='$object_type' AND `object_id`='$object_id'";
		$result		= $mysql->executeSQL($query);
		list($id)	= $mysql->fetchRow($result);
		if ($id) {
			$query		= "UPDATE `$MYSQL_CTR_TABLE31` SET `object_name`='$object_name', `object_name_second`='$object_name_second' WHERE `id`='$id'";
			$result		= $mysql->executeSQL($query);
		}
		else {
			if ($not_insert==0) {
				$query		= "INSERT  INTO `$MYSQL_CTR_TABLE31` (`id`,`module_id`,`operation`,`object_type`,`object_id`,`object_name`,`object_name_second`) VALUES (NULL, '$module_id', '$operation', '$object_type', '$object_id', '$object_name', '$object_name_second')";
				$result		= $mysql->executeSQL($query);
			}
		}
	}
}



/**
 * Обновляет настройки файла config.php
 *
 * @param unknown_type $caption
 * @param unknown_type $value
 * @return unknown
*/
function updateCtrGSettings($caption, $value) {
	GLOBAL $FILE_MANAGER;
	
	//переписываем файл конфигурации
	$filename= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/'.SETTINGS_SELF_PATCH_NAME.'/config.php';
	$text	= file_get_contents($filename);
	$text 	= preg_replace("/define \('$caption',(.*)'(.*)'\);/i", 		"define ('$caption',			'$value');",  			$text);
	if ($fd		= @$FILE_MANAGER->fopen($filename, 'w')) {
		fwrite($fd, $text);
		fclose($fd);
		$out=true;
	}
	else $out=false;
	return $out;
}

?>