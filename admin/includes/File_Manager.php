<?php
/**
 * Файловый менеджер
 *
 */
class FILE_MANAGER {

	/**
	 * Хост
	 *
	 * @var string
	 */
	private $host;

	/**
     * Порт FTP-сервера
     * @var int
     */
	private $port = 21;

	/**
	 * Логин
     * @var string
     */
	private $username;

	/**
     * Пароль
     * @var string
     */
	private $password;

	/**
     * Таймаут
     * @var int
     */
	private $timeout = 10;

	/**
     * Пасивный режим
     * @var bool
     */
	private $passive = false;


	/**
     * Стартовая директория
     * @var string
     */
	private $startDir = '';

	/**
     * Режим копирования
     * @var string
     */
	private $copyMode ;

	/**
     * Массив ошибок
     * @var array
     */
	private $errors = array();

	/**
     * Флаг подключения к серверу содержит ID подключения
     * @var bool
     */
	private $isConnect;

	/**
     * Флаг авторизации
     * @var bool
     */
	private $login;

	/**
     * Флаг доступности библиотеки ftp
     * @var bool
     */
	private $isFTPSet;

	/**
     * Допустимые имена настроек
     * @var array
     */
	protected $_allowedOptions 	= array('host', 'port', 'username' ,'password', 'startDir', 'passive', 'timeout' , 'raiseErrors' , 'copyMode');

	/**
     * Не копируемые элементы
     *
     * @var array
     */
	private $not_copied_elements	= array();



	/**
     * Конструктор
     *
     * @param array $options
     */
	function __construct($options) {

		if (!extension_loaded('ftp')) {
			$this->isFTPSet	= false;
		}
		else {
			$this->copyMode = FTP_BINARY;
			$this->isFTPSet	= true;
			if ($options) {
				$this->setOptions($options);
			}
		}
	}



	/**
     * Устанавливает настройки
     *
     * @param array $options
     */
	function setOptions(array $options) {
		foreach ($options as $name => $value) {
			if (in_array($name, $this->_allowedOptions)) {
				$this->{$name} = $value;
			}
		}
	}



	/**
     * Создает соединение
     * @return bool;
     */
	function connect() {
		if ($this->isFTPSet) {
			clearstatcache();
			if ($this->isConnect) return $this->isConnect;
			if ($this->host!='') {
				$this->isConnect = @ftp_connect($this->host,$this->port, $this->timeout);
			}
			else return false;
			if ($this->isConnect) {
				if ($this->passive) $this->passiv('enabled');
				else $this->passiv('disabled');
				return true;
			}
			else {
				$this->raiseError('Not connect to FTP server');
				return false;
			}
		}
		else return false;
	}



	/**
     * Регистрация на сервере
     * 
     * @return bool
     */
	function login() {
		if ($this->connect()) {
			if (!$this->login) {
				if ($this->login = @ftp_login($this->isConnect, $this->username, $this->password)) {

					return true;
				}
				else {
					return false;
				}
			}
			else {
				return true;
			}
		}
		else {
			$this->raiseError('Not connect');
			return false;
		}
	}



	/**
     * Получить файл с сервера
     * 
     * @param string $local_file
     * @param string $remote_file
     * @return bool
     */
	function get($local_file, $remote_file) {
		if ($this->login()) {
			$res = @ftp_get($this->isConnect, $local_file,$remote_file, $this->copyMode);
			if ($res) {
				return true;
			}
			else {
				$this->raiseError("Can't get file from server");
				return false;
			}
		} else {
			$this->raiseError("Can't login into the server");
		}
	}



	/**
	 * Вспомагательная функция
	 *
	 * @param array $rawlist
	 * @param string $path
	 * @return array
	 */
	function RawlistToNlist($rawlist, $path) {
		$array = array();
		foreach ($rawlist as $item) {
			$filename = trim(mb_substr($item, 55, mb_strlen($item) - 55));
			if ($filename != "." || $filename != "..") {
				$array[] = $path . $filename;
			}
		}
		return $array;
	}



	/**
     * Установить пассивный режим
     * 
     * @param string $pasv_flag
     * @return bool
     */
	function passiv($pasv_flag = 'enabled') {
		if ($this->login()) {
			$res = @ftp_pasv($this->isConnect, $pasv_flag);
			if (!$res) {
				$this->raiseError("Can't set passive mode.");
				return false;
			}
			else {
				return true;
			}
		}
		else {
			$this->raiseError("Can't login into the server");
		}
	}



	/**
     * Отпраить команду на сервер
     * 
     * @param string $command
     * @return bool
     */
	function cmd($command) {
		if ($this->login()) {
			$res = @ftp_site($this->isConnect, $command);
			if (!$res) {
				$this->raiseError("Can't execute a commande: '".$command."'");
				return false;
			}
			else {
				return true;
			}
		}
		else {
			$this->raiseError("Can't login into the server");
		}
	}



	/**
     * Установить директорию
     * 
     * @param string $dir
     * @return bool
     */
	function setdir($dir) {
		if ($this->login()) {
			$result = @ftp_chdir($this->isConnect, $dir);
			if (!empty($result)) {
				$startDir = $result;
				return true;
			}
			else {
				$this->raiseError('Not setup new dir: '.$dir);
				return false;
			}
		}
		else {
			$this->raiseError("Can't login into the server");
		}
	}



	/**
     * Закрыть соединение
     * @return bool
     */
	function close() {
		if ($this->isConnect) {
			return @ftp_quit($this->isConnect);
		}
		else return false;
	}



	/**
     * Получить список файлов в папке
     * 
     * @param string $local_Path 
     * @param bool 	$checkSubFolders - если выставленно, тогда функция проверяет все вложенные директории
     * @return array 
     */
	function getArrayFolderFiles($local_Path, $checkSubFolders=true) {
		$local_str	= array();
		$local 		= scandir($local_Path);
		foreach ($local as $key => $value) {
			if ($value == '.' || $value == '..') {
				unset($local[$key]);
			}
			elseif (is_dir($local_Path.'/'.$value)) {

				$local_str[]['dir'] = $local_Path.'/'.$value;
				if ($checkSubFolders) {
					$tmp_arr = $this->getArrayFolderFiles($local_Path.'/'.$value, $checkSubFolders);

					if (is_array($tmp_arr))
					foreach ($tmp_arr as $item) {
						$local_str[]=$item;
					}
				}
			}
			else {
				if (mb_substr($local_Path,-1)=='/') {
					$local_str[]['file']		= $local_Path.$value;
				}
				else {
					$local_str[]['file']		= $local_Path.'/'.$value;
				}
			}
		}
		return $local_str;
	}



	/**
     * Копирует папку
     * @param string $local_path 
     * @param string $remote_path 
     * @return bool
     */
	function copyFolder($local_Path, $remote_Path = null, $not_copied_elements = array()) {

		$this->not_copied_elements	= $not_copied_elements;

		if ($this->copy_dir($local_Path, $remote_Path)) {
			return true;
		}
		else {
			if ($this->login()) {
				return $this->ftp_copyAll($this->isConnect, $local_Path, $remote_Path);
			}
		}
	}



	/**
     * Создает копию папки
     *
     * @param int $conn_id
     * @param string $src_dir
     * @param string $dst_dir
     * @return bool
     */
	function ftp_copyAll($conn_id, $src_dir, $dst_dir) {

		$res		= true;
		if(is_dir($dst_dir)){
			$res	= false;
		}
		else {
			$d = dir($src_dir);

			if (!$this->mkdir($dst_dir)) $res	= false;

			while($file = $d->read()) {
				if ($file != "." && $file != "..") {
					if (is_dir($src_dir."/".$file)) {
						$res = $this->ftp_copyAll($conn_id, $src_dir."/".$file, $dst_dir."/".$file);
					}
					else {
						if (!@ftp_put($conn_id,  $this->getCleanDirectory($dst_dir)."/".$file,  $src_dir."/".$file, FTP_BINARY))  $res	= false;
					}
				}
			}
			$d->close();
		}

		return $res;
	}



	/**
	* Копирует папку при отключеном безопасном режиме
 	*
 	* @param string $dir копируемая папку
 	* @param string $dest_dir папка, куда копировать
 	* @return boolean
 	*/

	function copy_dir($source, $target ) {
		$result = true;

		if (is_dir($source)) {
			if (!@mkdir($target, SETTINGS_CHMOD_FOLDERS)) {

                $result=false;
            }

			$d = dir($source);

			while (FALSE !== ($entry = $d->read()))  {

				if ( $entry == '.' || $entry == '..' ) {
					continue;
				}

				//если найден не копируемый элемент, тогда выходим из цикла
				if (in_array($entry, $this->not_copied_elements)) {
					break;
				}

				$Entry = $source . '/' . $entry;
				if (is_dir($Entry)) {
					$this->copy_dir( $Entry, $target . '/' . $entry );

					continue;
				}
				if (!copy( $Entry, $target . '/' . $entry )) {

					$result=false;
				}
				else {
					$fileHand = fopen($target . '/' . $entry, 'r');
					fclose($fileHand);
				}
			}

			$d->close();
		}
		else	{
			if (!copy( $source, $target )) {

				$result=false;
			}
			else {
				$fileHand = fopen($target, 'r');
				fclose($fileHand);
			}
		}

		return $result;
	}



	/**
     * Копирует файл
     * 
     * @param string $local_file - путь к локальному файлу
     * @param string $remote_file - путь к удалённому файлу
     * @return bool
     */
	function copy($local_file, $remote_file = null) {

		if (@copy($local_file, $remote_file)) {
			return true;
		}
		else {

			if ($this->login()) {
				$remote_file	= $this->getCleanDirectory($remote_file);
				if (!$remote_file) {
					$remote_file= $local_file;
				}

				$result = @ftp_nb_put($this->isConnect, $remote_file, $local_file, $this->copyMode);
				while ($result == FTP_MOREDATA) {
					$result = @ftp_nb_continue($this->isConnect);
				}
				switch ($result) {
					case FTP_FAILED:
						$this->raiseError("Can't copy file to the server: " . $local_file . " -> " . $remote_file);
						return false;
						break;
					case FTP_FINISHED: return true;
					break;
				}
				$this->raiseError("Can't copy file to the server: " . $local_file . " -> " . $remote_file);
				return false;
			}
			else {
				$this->raiseError("Can't login into the server");
				return false;
			}
		}
	}



	/**
     * Открывает файл 
     * 
     * @param string $remote_file
     * @param string $open_mode
     * @return bool
     */
	function fopen($remote_file, $open_mode=false) {

		if (!$open_mode)  {
			$open_mode		= 'r';
		}

		if ($handle 		= @fopen($remote_file, $open_mode)) {
			return $handle;
		}
		else {

			if (file_exists($remote_file)) {
				$this->chmod($this->getCleanDirectory($remote_file), SETTINGS_CHMOD_FILES);  		//пытается поставить права на запись
			}

			if ($handle = @fopen(($remote_file), $open_mode)) {
				return $handle;
			}
			else return false;
		}
	}



	/**
     * Удаляет файл
     * 
     * @param string $remote_file
     * @return bool
     */
	function unlink($remote_file) {

		if (@unlink($remote_file)) {
			return true;
		}
		else {

			if ($this->login()) {
				$remote_file	= $this->getCleanDirectory($remote_file);
				$res 			= @ftp_delete($this->isConnect, $remote_file);
				if (!$res) {
					$this->raiseError("Can't delete a file: " . $remote_file);
					return false;
				}
				else {
					return true;
				}
			}
			else {
				$this->raiseError("Can't login into the server");
				return false;
			}
		}
	}



	/**
     * Удаляет папку с вложениями
     * 
     * @param string $remote_folder
     * @return bool
     */
	function removeFolder($remote_folder) {

		if ($this->remove_dir($remote_folder)) {
			return true;
		}
		else {
			return $this->removeFolderByFTP($this->getCleanDirectory($remote_folder));
		}
	}



	/**
	 * Удаляет папку через FTP
	 *
	 * @param string $remote_folder
	 * @return bool
	 */
	function removeFolderByFTP($remote_folder) {

		if ($this->login()) {
			$result_message='';
			$list = @ftp_nlist ($this->isConnect, $remote_folder);
			if (empty($list)) {
				$list = $this->RawlistToNlist(@ftp_rawlist($this->isConnect, $remote_folder), $remote_folder . ( mb_substr($remote_folder, mb_strlen($remote_folder) - 1, 1) == "/" ? "" : "/" ) );
			}
			if ($list[0] != $remote_folder) {
				$remote_folder .= (mb_substr($remote_folder, mb_strlen($remote_folder)-1, 1) == "/" ? "" : "/" );
				foreach ($list as $item) {
					if ($item != $remote_folder.".." && $item != $remote_folder.".") {
						$result_message .= $this->removeFolderByFTP($item);
					}
				}
				if (@ftp_rmdir($this->isConnect, $remote_folder)) {
					$result_message .= "Successfully deleted $remote_folder <br />\n";
					return true;
				}
				else {
					$this->raiseError("There was a problem while deleting $remote_folder <br />\n");
					return false;
				}
			}
			else {
				if (@ftp_delete($this->isConnect, $remote_folder)) {
					$result_message .= "Successfully deleted $remote_folder <br />\n";
					return true;
				}
				else {
					$this->raiseError("There was a problem while deleting $remote_folder <br />\n");
					return false;
				}
			}
		}
		else {
			$this->raiseError("Can't login into the server");
			return false;
		}
	}



	/**
     * Удаляет непустую папку локально
     *
     * @param string $dir
     * @return boolean
     */
	function remove_dir($dir) {
		if (!file_exists($dir)) return true;

		if (!is_dir($dir) || is_link($dir)) return unlink($dir);
		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') continue;
			if (!$this->remove_dir($dir . '/' . $item)) {
				$this->chmod($dir.'/'.$item, SETTINGS_CHMOD_FOLDERS);
				if (!$this->remove_dir($dir . '/' . $item)) return false;
			}
		}
		return rmdir($dir);
	}


	/**
     * Создает папку на сервере
     *
     * @param string $directory
     * @param int $mode
     * @param bool $flag
     * @return bool
     */
	function  mkdir($directory, $mode=false, $flag=NULL) {

		if (!$mode) {
			$mode = SETTINGS_CHMOD_FOLDERS;
		}

		if (@mkdir($directory, $mode, $flag)) {
			return true;
		}
		else {
			if ($this->login()) {
				$directory	= $this->getCleanDirectory($directory);
				$res 		= @ftp_mkdir($this->isConnect, $directory);
				if (!$res) {
					$this->raiseError("Can't create folder: ".$directory);
					return false;
				}
				else {
					$this->chmod($directory, $mode);
					return true;
				}
			}
			else {
				$this->raiseError("Can't login into the server");
				return false;
			}
		}
	}



	/**
     * Переименовывает файл или директорию
     * 
     * @param string $oldname
     * @param string $newname
     * @return bool;
     */
	function rename($oldname, $newname) {

		if (rename($oldname, $newname)) {
			return true;
		}
		else {
			if ($this->login()) {
				$oldname	= $this->getCleanDirectory($oldname);
				$newname	= $this->getCleanDirectory($newname);
				$res 		= @ftp_rename($this->isConnect, $oldname, $newname);

				if (!$res) {
					$this->raiseError("Can't rename file: " . $oldname . ' -> '. $newname);
					return false;
				}
				else {
					return true;
				}
			}
			else {
				$this->raiseError("Can't login into the server");
				return false;
			}
		}
	}



	/**
	 * Формирует правильный путь для FTP
	 *
	 * @param unknown_type $dir
	 * @return unknown
	 */
	function getCleanDirectory($dir) {

		if (($pos	 = mb_strpos($dir, "/{$_SERVER['HTTP_HOST']}/"))!==false) {
			$ftp_dir = mb_substr($dir, $pos);
		}
		if (($pos	 = mb_strpos($dir,'/public_html/'))!==false) {
			$ftp_dir = mb_substr($dir, $pos);
		}
		elseif (($pos = mb_strpos($dir,'/www/'))!==false) {
			$ftp_dir  = mb_substr($dir, $pos);
		}
		else $ftp_dir = $dir;

		return $ftp_dir;
	}



	/**
     * Меняет права файла
     * 
     * @param  int $mode - mode 
     * @param  string $filename - расположение файла
     * @return bool
     */
	function chmod($filename, $mode) {

		if (@chmod($filename, $mode)) {
			return true;
		}
		else {

			if ($this->login()) {
				$filename	= $this->getCleanDirectory($filename);

				$res 		= @ftp_chmod($this->isConnect, $mode, $filename);

				if (!$res) {
					$this->raiseError("Can't change mode for file: " . $mode . ' -> '. $filename);
					return false;
				}
				else {
					return true;
				}
			}
			else {
				$this->raiseError("Can't login into the server");
				return false;
			}
		}
	}



	/**
	 * возвращает содержимое файла
	 *
	 * @param string $filename
	 * @return string
	 */
	function getfile($filename) {
		$fcontents = file_get_contents($filename);

		return $fcontents;
	}



	/**
	 * возвращает содержимое файла
	 *
	 * @param string $filename
	 * @return string
	 */
	function putfile($filename, $data) {
		return file_put_contents($filename, $data);
	}



	/**
     * clean all errors
     * @return bool
     */
	function cleanErrors() {
		$this->errors = array();
		return true;
	}



	/**
     * get all errors
     * @return array
     */
	function getErrors() {
		return $this->errors;
	}



	/**
     * set error
     * @return true
     */
	function raiseError($mes) {

		$this->errors[]= $mes;

		return true;
	}



	/**
     * get variables
     * @param strign $name
     * @return string
     */
	function getOptions($name) {
		return $this->{$name};
	}

}
?>