<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Обмен данными с 1С
*////////////////////////////////////////////////////////////////////////////////////////////
class Exchange_1C extends InternetShop {

	private $categories	= array();

	public $capt		= array(
	'Document'=>'Документ',
	'Number'=>'Номер',
	'Time'=>'Время',
	'Date'=>'Дата',
	'Contractors'=>'Контрагенты',
	'Contractor'=>'Контрагент',
	'Name'=>'Наименование',
	'ZnacheniyaRekvizitov'=>'ЗначенияРеквизитов',
	'ZnachenieRekvizita'=>'ЗначениеРеквизита',
	'PometkaUdaleniya'=>'ПометкаУдаления',
	'Value'=>'Значение',
	'Products'=>'Товары',
	'Product'=>'Товар',
	'Id'=>'Ид',
	'Article'=>'Артикул',
	'Amount'=>'Количество',
	'Prices'=>'Цены',
	'Price'=>'Цена',
	'PriceForOne'=>'ЦенаЗаЕдиницу',
	'Discounts'=>'Скидки',
	'Discount'=>'Скидка',
	'Percent'=>'Процент',
	'Total'=>'Сумма',
	'HozOperatsiya'=>'ХозОперация',
	'Role'=>'Роль',
	'Course'=>'Курс',
	'Comment'=>'Комментарий',
	'PolnoeNaimenovanie'=>'ПолноеНаименование',
	'UchtenoVSumme'=>'УчтеноВСумме',
	'Classifier'=>'Классификатор',
	'Catalog'=>'Каталог',
	'PaketPredlozheny'=>'ПакетПредложений',
	'Properties'=>'Свойства',
	'Property'=>'Свойство',
	'SvoystvoNomenklatury'=>'СвойствоНоменклатуры',
	'HarakteristikiTovara'=>'ХарактеристикиТовара',
	'HarakteristikaTovara'=>'ХарактеристикаТовара',
	'Groups'=>'Группы',
	'Group'=>'Группа',
	'Status'=>'Статус',
	'Image'=>'Картинка',
	'Offers'=>'Предложения',
	'Offer'=>'Предложение',
	'TipNomenklatury'=>'ТипНоменклатуры',
	'VidNomenklatury'=>'ВидНоменклатуры',
	'Weight'=>'Вес',
	'ZnacheniyaSvoystv'=>'ЗначенияСвойств',
	'ZnacheniyaSvoystva'=>'ЗначенияСвойства',
	'StavkiNalogov'=>'СтавкиНалогов',
	'StavkaNaloga'=>'СтавкаНалога',
	'Stavka'=>'Ставка',
	'VAT'=>'НДС',
	'Currency'=>'Валюта',
	'Unit'=>'Единица',
	'Kind_Of_Product'=>'Вид товара',
	'Distribution_Channel'=>'Канал сбыта',
	'Brand'=>'Производитель',
	'TipyTsen'=>'ТипыЦен',
	'TipTseny'=>'ТипЦены',
	'Tax'=>'Налог',
	'UchtenoVSumme'=>'УчтеноВСумме',
	'Retail'=>'Розничная',
	'IdTipaTseny'=>'ИдТипаЦены',
	'UserName'=>'Имя',
	'UserSecondName'=>'Фамилия',
	'Deleted'=>'Удален',
	'Buyer'=>'Покупатель',
	'Delivery'=>'Доставка',
	'Service'=>'Услуга',
	'OrderStatus'=>'Статус заказа',
	'[N]Adopted'=>'[N] Принят',
	'OrdersPaid'=>'Заказ оплачен',
	'OrderItem'=>'Заказ товара',
	'Seller'=>'Продавец',
	'Description'=>'Описание',
	

	);


	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {
		GLOBAL $FILE_MANAGER;

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('init'):					$this->init(); 			break;
		case ('file'):					$this->file(); 			break;
		case ('import'):				$this->import(); 		break;
		case ('query'):					$this->query(); 		break;
		case ('success'):				$this->query_success(); break;
		default:						$this->START(); 		break;
		endswitch;
	}



	/**
	 * Первая проверка авторизации
	 */
	function START() {
		GLOBAL $FILE_MANAGER;

		//проверяем авторизацию
		if ($this->checkAuthorization()) {
			$unswer				= "success\n".session_name()."\n".session_id();
		}
		else {
			$unswer				= "failure\n";
		}

		//прикрепляем ошибки, если есть
		$unswer.=$this->getErrors();
		
		$this->contentOUT 		= $unswer;
	}



	/**
	 * Запрос параметров передачи данных
	 *
	 */
	function init() {

		if ($this->checkAuthorization()) {
			$unswer			= "zip={$this->settings['1c_zip']}\nfile_limit={$this->settings['1c_file_limit']}";
		}
		else {
			$unswer			= "failure\n";
		}

		//прикрепляем ошибки, если есть
		$unswer.=$this->getErrors();

		$this->contentOUT 	= $unswer;
	}



	/**
	 * Проверка авторизации
	 *
	 * @return bool
	 */
	function checkAuthorization() {

		if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) && $_SERVER['PHP_AUTH_USER']==$this->settings['1c_login'] && $_SERVER['PHP_AUTH_PW']==$this->settings['1c_password']) {
			return true;
		}
		else {
			$this->errors[]	= 'Ошибка авторизации.';
			return false;
		}
	}



	/**
	 * из 1С загружает на сервер файлы обмена в формате CommerceML 2, посылая содержимое файла или его части в виде POST. 
	 *
	 */
	function file() {
		GLOBAL $FILE_MANAGER;

		if ($this->checkAuthorization()) {
			$type			= $this->gets['type'];					//сущность с которой мы работаем
			$filename		= $this->gets['filename'];				//получаем имя передаваемого файла
			$file_content	= file_get_contents('php://input');		//получаем содержимое файла


			//создаем папку, куда будут закачены остальные файлы
			if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/')) {
				$FILE_MANAGER->mkdir($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/', SETTINGS_CHMOD_FOLDERS, true);
			}

			//создаем директории, где будет храниться файл
			if ($pos			= mb_strrpos($filename, '/')) {
				$filename_dir	= mb_substr($filename, 0, $pos);
				if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/'.$filename_dir)) {
					$FILE_MANAGER->mkdir($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/'.$filename_dir, SETTINGS_CHMOD_FOLDERS, true);
				}
			}

			//сохраняем файл на сервер
			$full_filename		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/'.$filename;
			if ($fd				= $FILE_MANAGER->fopen($full_filename, 'w')) {
				fwrite($fd, $file_content);
				fclose($fd);
				$res			= true;
			}
			else {
				$res			= false;
				$this->errors[]	= 'Ошибка записи в файл '.$full_filename;
			}

			//обновление статуса заказа
			if ($type=='sale') {

				if (!$xml 			= simplexml_load_file($full_filename)) {
					$this->errors[]	= "Не удалось прочитать файл $full_filename";
				}
				else {

					//берем список всех статусов
					$statuses		= array();
					$query 			= "SELECT * FROM `{$this->tablePrefix}orders_status` WHERE `code`!=''";
					$result			= $this->mysql->executeSQL($query);
					while ($row		= $this->mysql->fetchAssoc($result)) {
						$statuses[$row['code']]	= $row;
					}

					//берем Валюту
					$currencies		= array();
					$query 			= "SELECT * FROM `{$this->tablePrefix}currencies`";
					$result			= $this->mysql->executeSQL($query);
					while ($row		= $this->mysql->fetchAssoc($result)) {
						$currencies[$row['code']]	= $row;
					}

					if ($res=$this->parce_orders($xml, $statuses, $currencies)) {
						$FILE_MANAGER->removeFolder($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/');
					}
				}

			}

			//проверяем результат
			if ($res) {
				$unswer		= 'success';
			}
			else {
				$unswer		= "failure\n";
			}



		}
		else {
			$unswer			= "failure\n";
		}

		//прикрепляем ошибки, если есть
		$unswer.=$this->getErrors();

		$this->contentOUT 	= $unswer;
	}



	/**
	 * из 1С проводится пошаговая загрузка каталога из файла в CMS
	 *
	 */
	function import() {
		GLOBAL $FILE_MANAGER;

		$in_progress	= false;
		if ($this->checkAuthorization()) {
			$type					= $this->gets['type'];					//сущность с которой мы работаем
			$filename				= $this->gets['filename'];				//получаем имя передаваемого файла
			$full_filename_import	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/import.xml';
			$full_filename_offers	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/offers.xml';

			if ($type=='catalog') {

				//загружаем файл обмена
				if (!isset($_SESSION['offers_1c'])) {

					if (!$xml 			= simplexml_load_file($full_filename_import)) {
						$this->errors[]	= "Не удалось прочитать файл $full_filename_import";
					}
					else {

						//берем список всех категорий
						$query 			= "SELECT `id`, `parent_id`, `caption`, `id_1c`, `active` FROM `{$this->tablePrefix}categories` WHERE `id_1c`!=''";
						$result			= $this->mysql->executeSQL($query);
						while ($row		= $this->mysql->fetchAssoc($result)) {
							$this->categories[$row['id_1c']]	= $row;
						}

						//импорт категорий
						if (!isset($_SESSION['categories_1c'])) {
							if (isset($xml->{$this->capt['Classifier']})) {
								$this->import_categories($xml->{$this->capt['Classifier']}, 0);
								$in_progress				= true;
								$_SESSION['categories_1c']	= true;	//ставим метку, чтоб каждый раз не проверять категории
							}
						}
						else {

							//берем производителей
							$products_brands= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}brands`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$products_brands[$row['name']]	= $row;
							}

							//берем Вид товара
							$products_kinds	= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}products_kinds`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$products_kinds[$row['caption']]	= $row;
							}

							//берем ТипНоменклатуры
							$products_types	= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}products_types`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$products_types[$row['caption']]	= $row;
							}

							//берем ВидНоменклатуры
							$products_types_kinds	= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}products_types_kinds`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$products_types_kinds[$row['caption']]	= $row;
							}


							//берем Каналы сбыта
							$distribution_channel	= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}distribution_channel`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$distribution_channel[$row['caption']]	= $row;
							}

							//получаем ID свойств
							$Properties				= array();
							if (isset($xml->{$this->capt['Classifier']}->{$this->capt['Properties']}->{$this->capt['Property']})) {
								foreach ($xml->{$this->capt['Classifier']}->{$this->capt['Properties']}->{$this->capt['Property']} as $xml_property) {
									$p_id						= strval($xml_property->{$this->capt['Id']});
									$Properties[$p_id]['name'] 	= strval($xml_property->{$this->capt['Name']});
								}
							}

							//парсим товары
							$in_progress	= $this->import_products($xml->{$this->capt['Catalog']}, $Properties, $products_brands, $products_kinds, $products_types, $products_types_kinds, $distribution_channel);
						}
					}
				}
				else {

					if (!$xml_offers 		= simplexml_load_file($full_filename_offers)) {
						$this->errors[]		= "Не удалось прочитать файл $full_filename_offers";
					}
					else {
						if (isset($xml_offers->{$this->capt['PaketPredlozheny']})) {

							//берем Валюту
							$currencies		= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}currencies`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$currencies[$row['code']]	= $row;
							}

							//берем Единицы измерения
							$units			= array();
							$query 			= "SELECT * FROM `{$this->tablePrefix}units`";
							$result			= $this->mysql->executeSQL($query);
							while ($row		= $this->mysql->fetchAssoc($result)) {
								$units[$row['caption']]	= $row;
							}

							//получаем ID цен
							$TipyTsen				= array();
							if (isset($xml_offers->{$this->capt['PaketPredlozheny']}->{$this->capt['TipyTsen']}->{$this->capt['TipTseny']})) {

								foreach ($xml_offers->{$this->capt['PaketPredlozheny']}->{$this->capt['TipyTsen']}->{$this->capt['TipTseny']} as $xml_property) {

									$p_id						= strval($xml_property->{$this->capt['Id']});
									$p_name						= strval($xml_property->{$this->capt['Name']});

									//берём только розничную цену
									if ($p_name==$this->capt['Retail']) {

										$_nalog_name				= strval($xml_property->{$this->capt['Tax']}->{$this->capt['Name']});
										$_nalog_uchtenno			= strval($xml_property->{$this->capt['Tax']}->{$this->capt['UchtenoVSumme']});

										if ($_nalog_name==$this->capt['VAT']) {
											$TipyTsen[$p_id]['name'] 			= strval($xml_property->{$this->capt['Name']});
											$TipyTsen[$p_id]['nds_in_price'] 	= settype($_nalog_uchtenno, 'bool');
										}
										break;
									}
								}
							}

							//парсит торговые предложения
							$in_progress	= $this->parce_offers($xml_offers->{$this->capt['PaketPredlozheny']}, $TipyTsen, $currencies, $units);
						}
					}
				}
			}


			//проверяем результат
			if (count($this->errors)==0) {
				$unswer		= 'success';
			}
			else {
				$unswer		= "failure\n";
			}
		}
		else {
			$unswer			= "failure\n";
		}



		//если не выскочил прогресс, тогда записываем результат
		if (!$in_progress) {
			//прикрепляем ошибки, если есть
			$unswer.=$this->getErrors();

			//удаляем закаченные файлы по завершению импорта
			if (isset($_SESSION['catalog_1c_parse_complete'])) {
				$FILE_MANAGER->removeFolder($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/');
			}

			$this->contentOUT 	= $unswer;
		}
		else {
			//если прогресс, тода проверяем, есть ли ошибки
			$unswer				= "progress\n";
			$this->contentOUT	= $unswer.$this->getErrors();
		}
	}



	/**
	 * Импорт категорий
	 *
	 * @param object $xml
	 * @param int $parent_id
	 */
	function import_categories($xml, $parent_id = 0) {

		$category_id	= $parent_id;

		if (isset($xml->{$this->capt['Groups']}->{$this->capt['Group']})) {
			foreach ($xml->{$this->capt['Groups']}->{$this->capt['Group']} as $xml_group) {

				//массив данных
				$row_data	= array();

				$id_1c		= strval($xml_group->{$this->capt['Id']});

				//делаем вставку
				if (!isset($this->categories[$id_1c])) {
					$row_data['parent_id']			= $parent_id;
					$row_data['id_1c']				= $xml_group->{$this->capt['Id']};
					$row_data['caption']			= addslashes($xml_group->{$this->capt['Name']});
					$row_data['translit']			= '';
					$row_data['title']				= '';
					$row_data['metadescription']	= '';
					$row_data['metakeywords']		= '';
					$row_data['active']				= 1;
					$api							= $this->updateData('insert', 'categories', $row_data);

					//проверяем на ошибки
					if (count($api->errors)==0) {
						$category_id				= $api->inserted_id;
						$row_data['id']				= $category_id;
						$this->categories[$id_1c]	= $row_data;	//запоминаем добавленную категорию
					}
					else {
						$this->errors[]				= 'Ошибка добавления категории '.print_r($row_data, true);
					}
				}
				//делаем обновление
				elseif ($this->categories[$id_1c]['caption']!=$xml_group->{$this->capt['Name']}) {
					$row_data['id']					= $this->categories[$id_1c]['id'];
					$row_data['parent_id']			= $parent_id;
					$row_data['caption']			= addslashes($xml_group->{$this->capt['Name']});
					$row_data['active']				= $this->categories[$id_1c]['active'];
					$category_id					= $row_data['id'];

					$this->updateData('update', 'categories', $row_data);

					//проверяем на ошибки
					if (count($api->errors)>0) {
						$this->errors[]				= 'Ошибка обновления категории '.print_r($row_data, true);
					}
				}

				$this->import_categories($xml_group, $category_id);
			}
		}
	}




	/**
	 * Импорт товаров
	 *
	 * @param object $xml
	 * @param int $parent_id
	 */
	function import_products($xml, $Properties, $products_brands, $products_kinds, $products_types, $products_types_kinds, $distribution_channel) {
		GLOBAL $FRAME_FUNCTIONS;

		$iteration		= 0;
		$iteration_stop	= 20;	//количество итераций за один вызов

		//берем последнюю запись на которой мы остановились
		if (isset($_SESSION['product_1c_id']) && $_SESSION['product_1c_id']!='') {
			$iteration_last = $_SESSION['product_1c_id'];
			$obrabotat		= false;
		}
		else {
			$iteration_last = false;
			$obrabotat		= true;
		}

		if (isset($xml->{$this->capt['Products']}->{$this->capt['Product']})) {
			foreach ($xml->{$this->capt['Products']}->{$this->capt['Product']} as $xml_product) {

				//берём ID товара
				$product_1c_id =  strval($xml_product->{$this->capt['Id']});

				if ($obrabotat) {

					//массив данных
					$row_data		= array();

					//берем ID категории
					if(isset($xml_product->{$this->capt['Groups']}->{$this->capt['Id']})) {

						if (isset($this->categories[strval($xml_product->{$this->capt['Groups']}->{$this->capt['Id']})])) {
							$product_category_id 	= $this->categories[strval($xml_product->{$this->capt['Groups']}->{$this->capt['Id']})]['id'];
						}
						else {
							$product_category_id 	= 0;
						}
					}
					else {
						$product_category_id 		= 0;
					}

					//характеристики товара
					if(isset($xml_product->{$this->capt['HarakteristikiTovara']}->{$this->capt['HarakteristikaTovara']})) {
						$product_small_description	 		= array();
						foreach($xml_product->{$this->capt['HarakteristikiTovara']}->{$this->capt['HarakteristikaTovara']} as $xml_property) {
							$product_small_description[] 	= '<p>'.$xml_property->{$this->capt['Name']}.' '.$xml_property->{$this->capt['Value']}.'</p>';
						}
						$product_small_description			= implode("\r\n", $product_small_description);		//преобразуем в строку
					}
					else {
						$product_small_description			= '';
					}


					//артикул
					$product_article	= $xml_product->{$this->capt['Article']};

					//название
					$product_caption	= $xml_product->{$this->capt['Name']};
					
					//описание товара					
					if (isset($xml_product->{$this->capt['Description']})) {
						$product_description = $xml_product->{$this->capt['Description']};
					}
					else {
						$product_description = '';
					}
					

					//свойства товара
					$product_kind_id					= 0;
					$product_distribution_channel_id	= 0;
					$product_brand_id					= 0;
					if(isset($xml_product->{$this->capt['ZnacheniyaSvoystv']}->{$this->capt['ZnacheniyaSvoystva']})) {
						foreach($xml_product->{$this->capt['ZnacheniyaSvoystv']}->{$this->capt['ZnacheniyaSvoystva']} as $x) {

							$p_id			= strval($x->{$this->capt['Id']});
							$p_value		= strval($x->{$this->capt['Value']});
							if (isset($Properties[$p_id])) {
								$row_data	= array();
								$p_name		= $Properties[$p_id]['name'];

								switch ($p_name) {
									//Вид товара
									case $this->capt['Kind_Of_Product']: 		{
										if (isset($products_kinds[$p_value])) {
											$product_kind_id			= $products_kinds[$p_value]['id'];
										}
										else {
											$row_data['caption']		= addslashes($p_value);
											$api						= $this->updateData('insert', 'products_kinds', $row_data);
											if (count($api->errors)==0) {
												$products_kinds[$p_value]['id']	= $api->inserted_id;
												$product_kind_id				= $api->inserted_id;
											}
										}
										break;
									}
									//Канал сбыта
									case $this->capt['Distribution_Channel']: 		{
										if (isset($distribution_channel[$p_value])) {
											$product_distribution_channel_id	= $distribution_channel[$p_value]['id'];
										}
										else {
											$row_data['caption']		= addslashes($p_value);
											$api						= $this->updateData('insert', 'distribution_channel', $row_data);
											if (count($api->errors)==0) {
												$distribution_channel[$p_value]['id']	= $api->inserted_id;
												$product_distribution_channel_id		= $api->inserted_id;
											}
										}
										break;
									}
									//Производитель
									case $this->capt['Brand']: 		{
										if (isset($products_brands[$p_value])) {
											$product_brand_id			= $products_brands[$p_value]['id'];
										}
										else {
											$row_data['name']			= addslashes($p_value);
											$row_data['translit']		= '';
											$row_data['title']			= '';
											$row_data['metakeywords']	= '';
											$row_data['metadescription']= '';

											$api						= $this->updateData('insert', 'brands', $row_data);
											if (count($api->errors)==0) {
												$products_brands[$p_value]['id']	= $api->inserted_id;
												$product_brand_id					= $api->inserted_id;
											}
										}
										break;
									}
								}
							}
						}
					}


					//парсим значения реквезитов
					$product_weight			= 0;
					$product_type_kind_id	= 0;
					if (isset($xml_product->{$this->capt['ZnacheniyaRekvizitov']})) {

						//предварительно получаем значение реквезитов
						$Rekviziti=array();
						foreach ($xml_product->{$this->capt['ZnacheniyaRekvizitov']}->{$this->capt['ZnachenieRekvizita']} as $x) {

							$r_name					= strval($x->{$this->capt['Name']});
							$r_value				= strval($x->{$this->capt['Value']});
							$Rekviziti[$r_name]		= $r_value ;
						}

						foreach ($Rekviziti as $key => $value) {
							$row_data	= array();
							switch ($key) {
								//вид номенклатуры
								case $this->capt['VidNomenklatury'] :
									if (isset($products_types_kinds[$value])) {
										$product_type_kind_id			= $products_types_kinds[$value]['id'];
									}
									else {

										if (isset($products_types[$Rekviziti[$this->capt['TipNomenklatury']]])) {
											$row_data['type_id']		= $products_types[$Rekviziti[$this->capt['TipNomenklatury']]]['id'];
										}
										//добавляем ТипНоменклатуры
										else {
											$row_data['caption']		= addslashes($Rekviziti[$this->capt['TipNomenklatury']]);
											$api						= $this->updateData('insert', 'products_types', $row_data);
											if (count($api->errors)==0) {
												$products_types[$Rekviziti[$this->capt['TipNomenklatury']]]['id']	= $api->inserted_id;
												$row_data['type_id']												= $api->inserted_id;
											}
										}

										//добавляем ВидНоменклатуры
										$row_data['caption']		= addslashes($value);
										$api						= $this->updateData('insert', 'products_types_kinds', $row_data);
										if (count($api->errors)==0) {
											$products_types_kinds[$value]['id']	= $api->inserted_id;
											$product_type_kind_id				= $api->inserted_id;
										}
									}
									break;

									//вес в граммах
								case $this->capt['Weight']:
									$product_weight	= $value;
									break;
							}
						}
					}

					//парсим СтавкиНалогов
					$product_nds		= 0;
					if (isset($xml_product->{$this->capt['StavkiNalogov']})) {
						foreach ($xml_product->{$this->capt['StavkiNalogov']}->{$this->capt['StavkaNaloga']} as $x) {
							switch ($x->{$this->capt['Name']}) {
								case $this->capt['VAT'] : 		 $product_nds	= strval($x->{$this->capt['Stavka']}); break;	//Ставка НДС
							}
						}
					}


					//картинка
					if (isset($xml_product->{$this->capt['Image']}) && $xml_product->{$this->capt['Image']}!='') {
						$product_image_sourse			= $xml_product->{$this->capt['Image']};
						$product_image 					= basename($product_image_sourse);

						//меняем имя картинки по названию продукта
						$t				= explode('.', $product_image);
						$product_image	= $FRAME_FUNCTIONS->convertKirilToLatin($product_caption.'.'.$t[count($t)-1]);

						$_FILES['image']['type']		= $product_image;
						$_FILES['image']['name']		= $product_image;
						$_FILES['image']['tmp_name']	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/1c_exchange/'.$product_image_sourse;
					}
					else {
						$_FILES			= array();	//обнуляем
						$product_image	= '';
					}

					//проверяем, есть ли такой товар
					$query 			= "SELECT `id`, `article`, `price`, `image`, `caption`, `id_1c`, `active` FROM `{$this->tablePrefix}products` WHERE `id_1c`='$product_1c_id'";
					$result			= $this->mysql->executeSQL($query);
					$product		= $this->mysql->fetchAssoc($result);

					//удаляем товар
					if(strval($xml_product->{$this->capt['Status']}) == $this->capt['Deleted']) {
						if (isset($product['id'])) {
							$row_data['id']					= $product['id'];
							$api							= $this->updateData('delete', 'products', $row_data);

							//проверяем на ошибки
							if (count($api->errors)>0) {
								$this->errors[]				= 'Ошибка удаления товара '.print_r($row_data, true);
							}
						}
					}
					//вставка товара
					else if (!isset($product['id'])) {

						$row_data['category_id']				= $product_category_id;
						$row_data['id_1c']						= $product_1c_id;
						$row_data['caption']					= addslashes($product_caption);
						$row_data['article']					= $product_article;
						$row_data['image']						= $product_image;
						$row_data['small_description']			= addslashes($product_small_description);
						$row_data['description']				= addslashes($product_description);

						$row_data['kind_id']					= $product_kind_id;
						$row_data['distribution_channel_id']	= $product_distribution_channel_id;
						$row_data['brand_id']					= $product_brand_id;

						$row_data['type_kind_id']				= $product_type_kind_id;
						$row_data['weight']						= $product_weight;

						$row_data['nds']						= $product_nds;

						$row_data['date_add']					= '';
						$row_data['translit']					= '';
						$row_data['title']						= '';
						$row_data['metadescription']			= '';
						$row_data['metakeywords']				= '';
						$row_data['active']						= 1;
						$api									= $this->updateData('insert', 'products', $row_data, array('small_description'), array('p'));

						//проверяем на ошибки
						if (count($api->errors)>0) {
							$this->errors[]						= "Ошибка добавления товара ".print_r($row_data, true);
						}
					}
					//обновление товара
					else  {
						$row_data['id']							= $product['id'];
						$row_data['category_id']				= $product_category_id;
						$row_data['caption']					= addslashes($product_caption);
						$row_data['active']						= $product['active'];
						$row_data['image']						= $product_image;
						$row_data['small_description']			= addslashes($product_small_description);
						$row_data['description']				= addslashes($product_description);

						$row_data['kind_id']					= $product_kind_id;
						$row_data['distribution_channel_id']	= $product_distribution_channel_id;
						$row_data['brand_id']					= $product_brand_id;

						$row_data['type_kind_id']				= $product_type_kind_id;
						$row_data['weight']						= $product_weight;

						$row_data['nds']						= $product_nds;

						$api									= $this->updateData('update', 'products', $row_data, array('small_description'), array('p'));

						//проверяем на ошибки
						if (count($api->errors)>0) {
							$this->errors[]						= 'Ошибка обновления товара '.print_r($row_data, true);
						}
					}

					//проверяем количество итераций
					if ($iteration==$iteration_stop) {
						$_SESSION['product_1c_id']	= $product_1c_id;	//сохраняем метку

						return true;
					}
					else {
						$iteration++;
					}

				}
				//проверяем можно ли запускать обработку
				else if (!$iteration_last || $product_1c_id==$iteration_last) {
					$obrabotat=true;
				}
			}
		}


		$_SESSION['offers_1c']=true;	//стави метку на парсинг торговых предложений

		//удаляем временные метки
		unset($_SESSION['product_1c_id']);
		unset($_SESSION['categories_1c']);

		return false;
	}



	/**
	 * парсит торговые предложения
	 *
	 * @param object $xml_offers
	 * @return array
	 */
	function parce_offers($xml_offers, $TipyTsen, $currencies, $units) {

		$iteration		= 0;
		$iteration_stop	= 20;	//количество итераций за один вызов

		//берем последнюю запись на которой мы остановились
		if (isset($_SESSION['offers_1c_id']) && $_SESSION['offers_1c_id']!='') {
			$iteration_last = $_SESSION['offers_1c_id'];
			$obrabotat		= false;
		}
		else {
			$iteration_last = false;
			$obrabotat		= true;
		}


		$products_offers=array();
		if (isset($xml_offers->{$this->capt['Offers']}->{$this->capt['Offer']})) {
			foreach ($xml_offers->{$this->capt['Offers']}->{$this->capt['Offer']} as $xml_offers_product) {

				//берём ID товара
				$product_1c_id	= strval($xml_offers_product->{$this->capt['Id']});

				if ($obrabotat) {

					foreach ($xml_offers_product->{$this->capt['Prices']}->{$this->capt['Price']} AS $x) {

						$p_id					= strval($x->{$this->capt['IdTipaTseny']});

						if (isset($TipyTsen[$p_id])) {

							$row_data					= array();
							$row_data['id_1c']			= $product_1c_id;
							$row_data['price']			= strval($x->{$this->capt['PriceForOne']});
							$row_data['stock']			= strval($xml_offers_product->{$this->capt['Amount']});
							$row_data['nds_in_price']	= $TipyTsen[$p_id]['nds_in_price'];

							//валюта
							$Currency					= strval($x->{$this->capt['Currency']});
							if (isset($currencies[$Currency])) {
								$row_data['currency_id']= $currencies[$Currency]['id'];
							}
							else {
								$row_data['code']		= $Currency;
								$api					= $this->updateData('insert', 'currencies', $row_data);
								if (count($api->errors)==0) {
									$currencies[$Currency]['id']	= $api->inserted_id;
									$row_data['currency_id']		= $api->inserted_id;
								}
							}

							//Единица измерения
							$Unit						= strval($x->{$this->capt['Unit']});
							if (isset($units[$Unit])) {
								$row_data['unit_id']	= $units[$Unit]['id'];
							}
							else {
								$row_data['caption']	= $Unit;
								$api					= $this->updateData('insert', 'units', $row_data);
								if (count($api->errors)==0) {
									$units[$Unit]['id']		= $api->inserted_id;
									$row_data['unit_id']	= $api->inserted_id;
								}
							}

							//проверяем, есть ли такой товар
							$query 			= "SELECT `id`, `article`, `price`, `image`, `caption`, `id_1c`, `active` FROM `{$this->tablePrefix}products` WHERE `id_1c`='$product_1c_id'";
							$result			= $this->mysql->executeSQL($query);
							if ($product	= $this->mysql->fetchAssoc($result)) {

								//обновляем товар
								$row_data['id']					= $product['id'];
								$api							= $this->updateData('update', 'products', $row_data);

								//проверяем на ошибки
								if (count($api->errors)>0) {
									$this->errors[]				= 'Ошибка обновления товара '.print_r($row_data, true);
								}
							}
							//проверяем количество итераций
							if ($iteration==$iteration_stop) {
								$_SESSION['offers_1c_id']		= $product_1c_id;	//сохраняем метку
								return true;
							}
							else {
								$iteration++;
							}
						}
					}
				}
				//проверяем можно ли запускать обработку
				else if (!$iteration_last || $product_1c_id==$iteration_last) {
					$obrabotat	= true;
				}
			}
		}

		unset($_SESSION['offers_1c']);					//удаляем метку
		unset($_SESSION['offers_1c_id']);				//удаляем метку

		$_SESSION['catalog_1c_parse_complete']=true;	//ставим метку об успешном парсинге каталога

		return false;
	}



	/**
	 * Сайт отдает заказы в формате CML 2.
	 *
	 */
	function query() {
		GLOBAL $FRAME_FUNCTIONS, $MYSQL_TABLE13;

		if ($this->checkAuthorization()) {

			$no_spaces 	= '<?xml version="1.0" encoding="utf-8"?>
							<КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="'.date('Y-m-d').'"></КоммерческаяИнформация>';
			$xml 		= new SimpleXMLElement($no_spaces);

			$last_orders_export_date	= $this->settings['last_orders_export_date'];

			//берем заказы
			$query 			= "SELECT t.*, t2.code FROM `{$this->tablePrefix}orders` AS `t` LEFT JOIN `{$this->tablePrefix}currencies` AS `t2` ON (t2.id=t.currency_id) WHERE t.created>'$last_orders_export_date' ORDER BY t.created";
			$result			= $this->mysql->executeSQL($query);
			$orders			= $this->mysql->fetchAssocAll($result);

			foreach($orders as $order) {
				$date = new DateTime($order['created']);

				$doc = $xml->addChild($this->capt['Document']);
				$doc->addChild($this->capt['Id'], 				$order['id']);
				$doc->addChild($this->capt['Number'], 			$order['id']);
				$doc->addChild($this->capt['Date'], 			$date->format('Y-m-d'));
				$doc->addChild($this->capt['HozOperatsiya'], 	$this->capt['OrderItem']);
				$doc->addChild($this->capt['Role'], 			$this->capt['Seller']);
				$doc->addChild($this->capt['Currency'], 		$order['code']);
				$doc->addChild($this->capt['Course'], 			'1');
				$doc->addChild($this->capt['Total'], 			$order['total_price']);
				$doc->addChild($this->capt['Time'],  			$date->format('H:i:s'));
				$doc->addChild($this->capt['Comment'], 			$order['note']);

				// Контрагенты
				$full_name	= $order['second_name'].' '.$order['name'].' '. $order['otchestvo'];
				$k1 		= $doc->addChild($this->capt['Contractors']);
				$k1_1		= $k1->addChild($this->capt['Contractor']);
				$k1_2 		= $k1_1->addChild($this->capt['Id'],					$full_name);
				$k1_2 		= $k1_1->addChild($this->capt['Name'], 					$full_name);
				$k1_2 		= $k1_1->addChild($this->capt['Role'], 					$this->capt['Buyer']);
				$k1_2 		= $k1_1->addChild($this->capt['PolnoeNaimenovanie'], 	$full_name);

				//берём состав заказа
				$query 			= "SELECT t.*, t2.amount, t3.discount, t4.caption AS `types_kinds_caption`, t5.caption AS `types_caption`
				FROM `{$this->tablePrefix}products` AS `t`
				LEFT JOIN `{$this->tablePrefix}orders_composition` AS `t2` ON (t2.order_id='{$order['id']}')
				LEFT JOIN `{$this->tablePrefix}discount` AS `t3` ON (t3.id=t.discount_type)								
				LEFT JOIN `{$this->tablePrefix}products_types_kinds` AS `t4` ON (t4.id=t.type_kind_id)
				LEFT JOIN `{$this->tablePrefix}products_types` AS `t5` ON (t5.id=t4.type_id)								
				WHERE t.id=t2.product_id";
				$result			= $this->mysql->executeSQL($query);
				$purchases		= $this->mysql->fetchAssocAll($result);


				$t1 = $doc->addChild($this->capt['Products']);
				foreach($purchases as $purchase) {

					$id = $purchases['id_1c'];

					$t1_1 = $t1->addChild($this->capt['Product']);
					if($id) {
						$t1_2 = $t1_1->addChild($this->capt['Id'], $id);
					}

					$t1_2 = $t1_1->addChild($this->capt['Article'], 		$purchase['article']);
					$t1_2 = $t1_1->addChild($this->capt['Name'], 			$purchase['caption']);
					$t1_2 = $t1_1->addChild($this->capt['PriceForOne'], 	$purchase['price'] );
					$t1_2 = $t1_1->addChild($this->capt['Amount'], 			$purchase['amount']);
					$t1_2 = $t1_1->addChild($this->capt['Total'], 			$purchase['amount']*$purchase['price']);

					$t1_2 = $t1_1->addChild($this->capt['Discounts']);
					$t1_3 = $t1_2->addChild($this->capt['Discount']);
					$t1_4 = $t1_3->addChild($this->capt['Total'], ($purchase['amount']*$purchase['price'])*$purchase['discount']/100);
					$t1_4 = $t1_3->addChild($this->capt['UchtenoVSumme'], "true");


					if ($purchase['types_kinds_caption']!='') {
						$purchase['types_kinds_caption']	= $this->capt['Product'];
					}

					if ($purchase['types_caption']!='') {
						$purchase['types_caption']			= $this->capt['Product'];
					}

					$t1_2 = $t1_1->addChild($this->capt['ZnacheniyaRekvizitov']);
					$t1_3 = $t1_2->addChild($this->capt['ZnachenieRekvizita']);
					$t1_4 = $t1_3->addChild($this->capt['Name'], 		$this->capt['VidNomenklatury']);
					$t1_4 = $t1_3->addChild($this->capt['Value'], 		$purchase['types_kinds_caption']);

					$t1_2 = $t1_1->addChild($this->capt['ZnacheniyaRekvizitov']);
					$t1_3 = $t1_2->addChild($this->capt['ZnachenieRekvizita']);
					$t1_4 = $t1_3->addChild($this->capt['Name'], 		$this->capt['TipNomenklatury']);
					$t1_4 = $t1_3->addChild($this->capt['Value'], 		$purchase['types_caption']);
				}

				// Доставка
				if($order->delivery_price>0 && !$order->separate_delivery) {
					$t1 = $t1->addChild($this->capt['Product']);
					$t1->addChild($this->capt['Id'], 				'ORDER_DELIVERY');
					$t1->addChild($this->capt['Name'], 				$this->capt['Delivery']);
					$t1->addChild($this->capt['PriceForOne'], 		$order['delivery_cost']);
					$t1->addChild($this->capt['Amount'], 			1);
					$t1->addChild($this->capt['Total'], 			$order['delivery_cost']);

					$t1_2 = $t1->addChild($this->capt['ZnacheniyaRekvizitov']);
					$t1_3 = $t1_2->addChild($this->capt['ZnachenieRekvizita']);
					$t1_4 = $t1_3->addChild($this->capt['Name'], 	$this->capt['VidNomenklatury']);
					$t1_4 = $t1_3->addChild($this->capt['Value'], 	$this->capt['Service']);

					$t1_2 = $t1->addChild($this->capt['ZnacheniyaRekvizitov']);
					$t1_3 = $t1_2->addChild($this->capt['ZnachenieRekvizita']);
					$t1_4 = $t1_3->addChild($this->capt['Name'], 	$this->capt['TipNomenklatury']);
					$t1_4 = $t1_3->addChild($this->capt['Value'], 	$this->capt['Service']);

				}

				//статус заказа
				$s1_2 = $doc->addChild($this->capt['ZnacheniyaRekvizitov']);
				$s1_3 = $s1_2->addChild($this->capt['ZnachenieRekvizita']);
				$s1_3->addChild($this->capt['Name'], $this->capt['OrderStatus']);
				$s1_3->addChild($this->capt['Value'], $this->capt['[N]Adopted']);


				//заказ оплачен
				if ($order['payed']) {
					$payed	= 'true';
				}
				else {
					$payed	= 'false';
				}
				$s1_2 = $doc->addChild($this->capt['ZnacheniyaRekvizitov']);
				$s1_3 = $s1_2->addChild($this->capt['ZnachenieRekvizita']);
				$s1_3->addChild($this->capt['Name'], 		$this->capt['OrdersPaid']);
				$s1_3->addChild($this->capt['Value'], 		$payed );
			}

			if (isset($order)) {
				$_SESSION['last_orders_export_date']	= $order['created'];	//запоминаем дату последнего заказа
			}


			header ("Content-type: text/xml; charset=utf-8");
			$unswer 		= "\xEF\xBB\xBF".$xml->asXML();

			echo $unswer;			
			exit;
		}
		else {
			$unswer			= "failure\n";
		}

		$this->contentOUT	= $unswer;
	}




	/**
	 * В случае успешного получения и записи заказов "1С:Предприятие" передает на сайт запрос 
	 *
	 */
	function query_success() {
		GLOBAL $FRAME_FUNCTIONS;

		if ($this->checkAuthorization() && $this->gets['type']=='sale') {

			//записываем настройку
			if (isset($_SESSION['last_orders_export_date'])) {
				$this->settings['last_orders_export_date']	= $_SESSION['last_orders_export_date'];

				unset($_SESSION['last_orders_export_date']);
			}
			$unswer			= 'success';
		}
		else {
			$unswer			= "failure\n";
		}

		$this->contentOUT 	= $unswer;
	}




	/**
	 * парсит статусы заказов
	 *
	 * @param object $xml_orders
	 * @return array
	 */
	function parce_orders($xml, $statuses, $currencies) {

		$xml_orders				= $xml->{$this->capt['Document']};

		foreach($xml->{$this->capt['Document']} as $xml_order) {

			$row_data 					= array();
			$row_data['id']				= strval($xml_order->{$this->capt['Number']});
			$order_id					= $row_data['id'];
			$row_data['total_price']	= strval($xml_order->{$this->capt['Total']});
			$row_data['currency_id']	= $currencies[strval($xml_order->{$this->capt['Currency']})]['id'];

			//проверяем, есть ли в базе такой заказ
			$query 					= "SELECT count(*) FROM `{$this->tablePrefix}orders` WHERE `id`='$order_id'";
			$result					= $this->mysql->executeSQL($query);
			list($existed_order)	= $this->mysql->fetchRow($result);

			if (isset($xml_order->{$this->capt['ZnacheniyaRekvizitov']}->{$this->capt['ZnachenieRekvizita']})) {
				foreach($xml_order->{$this->capt['ZnacheniyaRekvizitov']}->{$this->capt['ZnachenieRekvizita']} as $r) {
					switch (strval($r->{$this->capt['Name']})) {
						case 'Заказ оплачен':
							$payed = ($r->{$this->capt['Value']} == 'true');
							break;
						case 'Проведен':
							$proveden = (strval($r->{$this->capt['Value']}) == 'true');
							break;
						case 'Финальный статус':
							$finis = ($r->{$this->capt['Value']} == 'true');
							break;
						case 'ПометкаУдаления':
							$udalen = ($r->{$this->capt['Value']} == 'true');
							break;
					}
				}
			}


			//удаляем заказ
			if (isset($udalen) && $udalen) {

				$row_data['id']	= $order_id;

				$api			= $this->updateData('delete', 'orders', $row_data);
			}
			else {
				//обновляем статус заказа
				if (isset($payed)) {
					$row_data['payed']		= $payed;
				}

				if (isset($proveden) && $proveden) {
					$row_data['status_id']	= $statuses['N']['id'];
				}

				if (isset($finis) && $finis) {
					$row_data['payed']		= true;
					$row_data['status_id']	= $statuses['F']['id'];
				}

				//обновляем заказ
				if($existed_order) {
					$api						= $this->updateData('update', 'orders', $row_data);
				}
				//добавляем заказ
				else {
					$row_data['name'] 			= strval($xml_order->{$this->capt['Contractors']}->{$this->capt['Contractor']}->{$this->capt['Name']});
					$row_data['created'] 		= $xml_order->{$this->capt['Date']}.' '.$xml_order->{$this->capt['Time']};
					$api						= $this->updateData('insert', 'orders', $row_data);
					$order_id					= $api->inserted_id;
				}


				// Товары
				$product_ids = array();
				foreach($xml_order->{$this->capt['Products']}->{$this->capt['Product']} as $xml_product) {
					$comp		 = array();

					//берём ID товара
					$product_1c_id			= strval($xml_product->{$this->capt['Id']});

					//Ищем товар
					$query 					= "SELECT `id`, `price`, `currency_id` FROM `{$this->tablePrefix}products` WHERE `id_1c` LIKE '$product_1c_id'";
					$result					= $this->mysql->executeSQL($query);
					if (list($product_id, $product_price, $product_currency_id)	= $this->mysql->fetchRow($result)) {
						$comp['product_id']			= $product_id;
						$comp['order_id']			= $order_id;
						$comp['amount']				= strval($xml_product->{$this->capt['Amount']});
						$comp['price']				= $product_price;
						$comp['currency_id']		= $product_currency_id;

						//находим товар в составе заказа
						$query 						= "SELECT `id` FROM `{$this->tablePrefix}orders_composition` WHERE `product_id`='$product_id' AND `order_id`='$order_id'";
						$result						= $this->mysql->executeSQL($query);
						if (list($composition_id)	= $this->mysql->fetchRow($result)) {
							$comp['id']				= $composition_id;
							$api					= $this->updateData('update', 'orders_composition', $comp);
						}
						else {
							$api					= $this->updateData('insert', 'orders_composition', $comp);
						}

						$product_ids[]				= $product_id;
					}
					else {
						$this->errors[]				= "Товар по ID=$product_1c_id не найден";
						break;
					}
				}

				// Удалим покупки, которых нет в файле
				$query 			= "SELECT `id`, `product_id` FROM `{$this->tablePrefix}orders_composition` WHERE `order_id`='$order_id'";
				$result			= $this->mysql->executeSQL($query);
				$composition	= $this->mysql->fetchAssocAll($result);

				foreach($composition as $purchase) {
					if(!in_array($purchase['product_id'], $product_ids)) {
						$comp['id']		= $purchase['id'];
						$this->updateData('delete', 'orders_composition', $comp);
					}
				}
			}
		}

		if (count($this->errors)==0) {
			return true;
		}
		else {
			return false;
		}
	}



	/**
	 * Обновление записей в базе данных
	 *
	 * @param string $operation 	- тип операции update|insert|delete
	 * @param string $table_name	- имя таблицы (без префикса) с которой работаем
	 * @param array $row_data		- ассоциативный массив, содержит данные из 1С. Ключи массива должны совпадать с именами полей из редактируемой таблицы
	 */
	function updateData($operation, $table_name, $row_data,  $notStripTagsForFields = array(), $allowable_tags = array()) {

		//берём объект
		$api			= $this->getApiObject($this->tablePrefix.$table_name, $row_data, $notStripTagsForFields, $allowable_tags);
		//$api->posts		= $row_data;

		if ($operation=='delete') {
			$api->dataDelete();
		}
		elseif ($operation=='update') {
			$api->dataUpdate();
		}
		elseif ($operation=='insert') {
			$api->dataInsert();
		}

		return $api;
	}



	/**
	 * Возвращает ошибку
	 *
	 * @return string
	 */
	function getErrors() {
		$errors_string='';
		if (count($this->errors)>0) {
			$errors_string=implode("\n", $this->errors);
		}

		return $errors_string;
	}

}

?>