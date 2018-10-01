<?php

/**
 * Класс соединения с СУБД MУSQL
 */
class DbConnectionCTR {

	/**
	 * Идентификатор свзязувающий с БД
	 * @var resource|boolean
	 */
	public  $connection	= null;

	/**
	 * Имя сервера
	 * @var string
	 */
	public  $host		= MYSQL_CTR_HOST;

	/**
	 * Имя пользователя для подключения к БД
	 * @var string
	 */
	public  $user		= MYSQL_CTR_USER;

	/**
	 * Пароль доступа к БД
	 * @var string
	 */
	public  $pass		= MYSQL_CTR_PASSWORD;

	/**
	 * Имя рабочей БД
	 * @var string
	 */
	public  $database	= MYSQL_CTR_DATABASE;


	/**
	 * создавать новое соединение
	 * @var bool
	 */
	public  $new_link	= true;



	/**
	 * конструктор - создаёт соединение с БД
	 */
	function __construct() {
		GLOBAL $MSGTEXT;
		if ($conn = mysql_connect($this->host, $this->user, $this->pass, $this->new_link=true)) {
			if (mysql_select_db($this->database,$conn)) {
				$this->connection = $conn;
			}
			else	 {
				if (!REQUIRE_ADDITIONAL_FILES) {
					require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;	//подключаем язык
				}
				die ($MSGTEXT['DbConnectionCTR_no_sel_db'].' : '.$this->getError());
			}
		}
		else {
			if (!REQUIRE_ADDITIONAL_FILES) {
				require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;	//подключаем язык
			}
			die ($MSGTEXT['DbConnectionCTR_no_connect'].' : '.$this->getError());
		}

		mysql_query('SET NAMES utf8');
	}



	/**
	 * Открываем соединение с предварительной проверкой
	 * @return resourse|boolean
	 */
	function getInstance() {
		if ($this->connection == null)
		$this->connection = new DbConnectionCTR();
		return $this->connection;
	}



	/**
	 * возвращает текст ошибки
	 *
	 * @return string
	 */
	function getError() {
		if ($this->connection) {
			$error=mysql_errno($this->connection).': '.mysql_error($this->connection);
		}
		else {
			$error=mysql_errno().': '.mysql_error();
		}
		return $error;
	}



	/**
	 * Выполняет запрос к БД
	 * @param string $query
	 * @param array $params 
	 * @return resourse|boolean
	 */
	function executeSQL($query) {

		//если пользователь не обладает правами записи, тогда проверяем его запрос
		if (!$this->checkAdminStatus($query)) return false;

		if (!$result=mysql_query($query, $this->connection)) {
			echo ('Error in query: '.$this->getError()." query=$query");
		}
		return $result;
	}



	/**
	 * Выполняет запрос к БД без отображения ошибок
	 * @param string $query
	 * @param array $params 
	 * @return resourse|boolean
	 */
	function executeSQLErrorNo($query) {

		//если пользователь не обладает правами записи, тогда проверяем его запрос
		if (!$this->checkAdminStatus($query)) return false;

		$result=@mysql_query($query, $this->connection);
		return $result;
	}



	/**
	 * Извлекает ряд как массив
	 * @param resource $result
	 * @param int $fetchType 
	 * @return array|boolean
	 */
	function fetchArray($result) {
		$row=mysql_fetch_array($result);
		return $row;
	}



	/**
	 * Извлекает ряд как массив. Возвращает все записи
	 * @param resource $result
	 * @param unknown_type $result
	 * @return array|boolean
	 */
	function fetchArrayAll($result) {
		$rows	= array();
		while ($row=mysql_fetch_array($result)) {
			$rows[]=$row;
		}

		return $rows;
	}



	/**
	 * Обрабатывает ряд результата запроса и возвращает объект
	 *
	 * @param resource $result
	 * @return object
	 */
	function fetchObject($result) {
		$row	= mysql_fetch_object($result);
		return $row;
	}



	/**
	 *получает результирующий ряд как перечислимый массив.
	 * @param resource $result
	 * @param int $fetchType 
	 * @return array|boolean
	 */
	function fetchRow($result) {
		$row=mysql_fetch_row($result);
		return $row;
	}



	/**
	 *получает результирующий ряд как перечислимый массив. Возвращает все записи
	 * 
	 * @param resource $result
	 * @param int $fetchType 
	 * @return array|boolean
	 */
	function fetchRowAll($result) {
		$rows	= array();
		while ($row=mysql_fetch_row($result)) {
			$rows[]=$row;
		}

		return $rows;
	}



	/**
	 *извлекает все ряды результата как ассоциативный массив.
	 * 
	 * @param resource $result
	 * @param int $fetchType 
	 * @return array|boolean
	 */
	function fetchAssocAll($result) {
		$rows	= array();
		while ($row=mysql_fetch_assoc($result)) {
			$rows[]=$row;
		}

		return $rows;
	}



	/**
	 * получает результирующий ряд как перечислимый массив.
	 * @param resource $result
	 * @param int $fetchType 
	 * @return array|boolean
	 */
	function fetchAssoc($result) {
		$row=mysql_fetch_assoc($result);
		return $row;
	}



	/**
	 * возвращает количество рядов, задействованных в предыдущих запросах
	 * @return int|boolean
	 */
	function affectedRows() {

		$res=mysql_affected_rows($this->connection);

		return $res;
	}



	/**
	 * возвращает количество рядов, задействованных в предыдущих запросах
	 * @param resource $result
	 * @return int|boolean
	 */
	function numRows($result) {

		$res=mysql_num_rows($result);

		return $res;
	}



	/**
	 * возвращает id после вставки
	 * @return int|boolean
	 */
	function insertID() {
		$res=mysql_insert_id($this->connection);
		return $res;
	}



	/**
	 * освобождает результирующую память
	 * @param resource $result
	 * @return boolean
	 */
	function freeResult($result) {
		$res=mysql_free_result($result);
		return $res;
	}



	/**
	 * Возвращает информацию о последнем запросе 
	 * 
	 * @return string|boolean
	 */
	function mysqlInfo($result) {
		$res	= mysql_info($result, $this->connection);
		return $res;
	}



	/**
	 * мнемонизирует/Escape строку для использования в mysql_query.
	 * @param string $sql
	 * @return string
	 */
	function escapeString($sql) {
		$res =	mysql_escape_string	($sql);
		return $res;
	}



	/**
	 * mysql_real_escape_string - мнемонизирует специальные символы в строке для использования в 
	 * операторе SQL с учётом текущего набора символов/charset соединения.
	 * @param string $result
	 * @return string
	 */
	function realEscapeString($text) {
		$res =	mysql_real_escape_string($text);
		return $res;
	}



	/**
	 * возвращает список таблиц
	 * @param string $database
	 * @return array
	 */
	function listTables($database=MYSQL_DATABASE) {
		return mysql_list_tables($database,$this->connection);
	}



	/**
	 * получение информации о поле записи
	 * @param resource $result
	 * @return array
	 */
	function fetchField($result) {
		return mysql_fetch_field($result);
	}



	/**
	 * получение информации о всех полях записи
	 * 
	 * @param resource $result
	 * @return array
	 */
	function fetchFieldAll($result) {
		$rows	= array();
		while ($row=mysql_fetch_field($result)) {
			$rows[]=$row;
		}

		return $rows;
	}



	/**
	 * закрывает соединение
	 *
	 * @return unknown
	 */
	function close() {

		return mysql_close($this->connection);
	}




	////////////////////////////Вспомогательные функции/////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * если пользователь не обладает правами записи, тогда проверяем его запрос
	 *
	 * @param string $query
	 * @return bool
	 */
	function checkAdminStatus($query) {

		if (isset($_SESSION['___GoodCMS']['read_only']) && $_SESSION['___GoodCMS']['read_only']) {
			$q				= ltrim($query);
			$pos			= mb_strpos($q, ' ', 1);
			$qs				= mb_strtoupper(mb_substr($query, 0, $pos));
			$forbidden_sqls	= array('INSERT', 'DELETE', 'UPDATE', 'REPLACE');
			if (in_array($qs, $forbidden_sqls)) {
				return false;
			}
			else return true;
		}
		else return true;
	}

}
?>