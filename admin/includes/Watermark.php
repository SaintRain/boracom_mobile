<?php
/**
 * Класс наложения водяного знака на изображение
 *
 */
class Watermark {

	/**
	 * Ресурс исходного изображения
	 *
	 * @var resourse
	 */
	private $main_img_res;

	/**
	 * Ресурс водяного знака
	 *
	 * @var resourse
	 */
	private $watermark_img_res;

	/**
	 * Ресурс результата
	 *
	 * @var resourse
	 */
	private $result_img_res;

	/**
	 * Прозрачность наложения
	 *
	 * @var int
	 */
	private $alpha_level = 50;


	/**
	 * Тип выходного изображения по умолчанию
	 *
	 * @var string
	 */
	private $result_type = 'jpg';

	/**
	 * Тип выходного исображения по умолчанию
	 *
	 * @var string
	 */
	private $position = 'center';

	/**
	 * Отступ ватермарка от края изображения
	 *
	 * @var string
	 */
	private $margin = 0;

	/**
	 * Являются ли исходная картинка и ватермарк png-файлами
	 *
	 * @var bool
	 */
	private $is_png=false;

	
	
	/**
	 * Конструктор класса наложения водяных знаков
	 * 
	 * @param path $image Путь до картинки
	 * @param path $watermark Путь до водяного знака
	 */
	public function  __construct($image, $watermark = null, $alpha_level, $position = 'center') {
		$this->alpha_level			= $alpha_level;
		$this->position				= $position;
		
		$type1						= $this->typeimage($image);
		$type2						= $this->typeimage($watermark);
		
		if ($type1=='png') {
			$this->is_png			= true;
			}
					
		$func 						= 'imagecreatefrom' . $type1;
		$this->main_img_res 		= $func($image);
		$func 						= 'imagecreatefrom' . $type2;
		$this->watermark_img_res	= $func($watermark);
		
				
		$this->create();
	}
	
	

	/**
	 * Деструктор для очистки памяти
	 */
	public function  __destruct() {
		imagedestroy($this->main_img_res);
		imagedestroy($this->watermark_img_res);
		
		if (is_resource($this->result_img_res)) imagedestroy($this->result_img_res);
	}


	
	/**
	 * Запись изображения результата на диск
	 * 
	 * @param path $image Путь до файла сохранения
	 * @param int $quality Качество изображения
	 * @return bool
	 */
	public function save($image, $quality = 100) {

		list($func, $quality) = $this->imagefunc(pathinfo($image, PATHINFO_EXTENSION), $quality);
		
		return $func($this->result_img_res, $image, $quality);
	}

	

	/**
	 * Определят функцию и параметры сохранения изображения
	 * 
	 * @param string $type
	 * @param int $quality
	 * @return array
	 */
	private function imagefunc($type = null, $quality = 100) {
		$type = mb_strtolower($type);
		switch ($type) {
			case 'jpg':
			case 'jpeg':
				$result = array('imagejpeg', $quality);
				break;
			case 'png':
				$result = array('imagepng', round($quality/100));
				break;
			case 'gif':
				$result = array('imagegif', null);
				break;
			default:
				$result = array('imagepng', round($quality/100));
				break;
		}

		return $result;
	}

	
	
	/**
	 * Определяет тип изображения
	 * 
	 * @param path $image
	 * @return string
	 */
	private function typeimage($image) {
		$type = mb_strtolower(pathinfo($image, PATHINFO_EXTENSION));

		switch ($type){
			case 'jpg':
			case 'jpeg':
				$result = 'jpeg';
				break;
			case 'png':
				$result = 'png';
				break;
			case 'gif':
				$result = 'gif';
				break;
			default:
				$result = 'png';
				break;
		}
		return $result;
	}


	
	/**
	 * Накладывает водяной знак на изображение
	 * 
	 * @return bool
	 */
	private function create() {

		$main_img_res_w  		= imagesx( $this->main_img_res );
		$main_img_res_h 		= imagesy( $this->main_img_res );
		$watermark_img_res_w 	= imagesx( $this->watermark_img_res );
		$watermark_img_res_h 	= imagesy( $this->watermark_img_res );

		if ($this->position=='right') {
			//если справо
			$dest_x = $main_img_res_w - $watermark_img_res_w - $this->margin;
			$dest_y = $main_img_res_h - $watermark_img_res_h - $this->margin;
		}
		elseif ($this->position=='left') {
			//если слево
			$dest_x =  $this->margin;
			$dest_y = $main_img_res_h - $watermark_img_res_h - $this->margin;
		}
		//если по центру
		else {
			$dest_x = round(($main_img_res_w - $watermark_img_res_w)/2);
			$dest_y = round(($main_img_res_h - $watermark_img_res_h)/2);
		}
		 				
				

		$this->result_img_res	= $this->imagecopymerge_alpha($this->main_img_res, $this->watermark_img_res, $dest_x, $dest_y, 0, 0, $watermark_img_res_w, $watermark_img_res_h, $this->alpha_level);

		return is_resource($this->result_img_res);
	}

	

	/**
	 * Накладывает водяной знак с учетом alpha
	 *
	 * @param resourse $dst_im
	 * @param resourse $src_im
	 * @param int $dst_x
	 * @param int $dst_y
	 * @param int $src_x
	 * @param int $src_y
	 * @param int $src_w
	 * @param int $src_h
	 * @param int $pct
	 */

	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {		  	  		

		//если исходная картинка или ватермарк png
		if ($this->is_png) {	
			$dst_im	= $this->set_alpha($dst_im, $src_im, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
			}
		else {				
			$cut 	= imagecreatetruecolor($src_w, $src_h);															
			imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
			imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
			imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
			}	
				
		imagesavealpha($dst_im, true);  
		
		return $dst_im;
	}
	

	
	/**
	 * Устанавливает правильную прозрачность для png
	 *
	 * @param resourse $dst_im
	 * @param resourse $src_im
	 * @param int $dst_x
	 * @param int $dst_y
	 * @param int $src_x
	 * @param int $src_y
	 * @param int $src_w
	 * @param int $src_h
	 * @param int $pct
	 * @return unknown
	 */
	function set_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		
		if(!isset($pct)){
			return $dst_im;
			}
		
		$pct /= 100;
		
		// получаем высоту и ширину изображения		
		$w = imagesx($src_im);
		$h = imagesy($src_im);
		
		// выключаем alpha blending
		imagealphablending($src_im, false);
		
		//Ищем пиксель с наименьшим alpha значением
		$minalpha = 127;
		for( $x = 0; $x < $w; $x++ )
		for( $y = 0; $y < $h; $y++ ){
			$alpha = (imagecolorat($src_im, $x, $y) >> 24) & 0xFF;
			if( $alpha < $minalpha ){
				$minalpha = $alpha;
			}
		}
		//модифицируем каждый пиксель
		for( $x = 0; $x < $w; $x++ ){
			for( $y = 0; $y < $h; $y++ ){
				//получаем текущее значение alpha
				$colorxy = imagecolorat($src_im, $x, $y);
				$alpha = ($colorxy >> 24) & 0xFF;
				//вычисляем новое значение 
				if( $minalpha !== 127 ){
					$alpha = 127 + 127 * $pct * ($alpha - 127) / (127 - $minalpha);
				} else {
					$alpha += 127 * $pct;
				}
				//получаем цветовой индекс с новым alpha значением
				$alphacolorxy = imagecolorallocatealpha($src_im, ($colorxy >> 16) & 0xFF, ($colorxy >> 8) & 0xFF, $colorxy & 0xFF, $alpha);
				//Устанавливаем новый пиксель с прозрачностью и новым цветом 
				if( !imagesetpixel($src_im, $x, $y, $alphacolorxy)){
					return $dst_im;
				}
			}
		}
		
		//копируем изображение
		imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);

		return $dst_im;
	}


	
	
}
?>