<?php
class ImageMagickUpload {

	private $imagick;

	public function __construct() {
		$this->imagick = new Imagick();
	}

	/**
	 * 获得图片属性
	 * @param String $source_img  图片地址
	 * @return array 返回图片长宽
	 */
	public function getAttr($source_img) {
		$imgSize = @getimagesize($source_img);
		if ($imgSize===false) {
		    return false;
		}
		$imgPathInfo = pathinfo($source_img);
		return array(
			'width' => $imgSize[0],
			'height' => $imgSize[1],
			'dirname' => isset($imgPathInfo['dirname']) ? $imgPathInfo['dirname'] : '',
			'basename' => isset($imgPathInfo['basename']) ? $imgPathInfo['basename'] : '',
			'extension' => isset($imgPathInfo['extension']) ? $imgPathInfo['extension'] : '',
			'filename' => isset($imgPathInfo['filename']) ? $imgPathInfo['filename'] : '',
		);
	}

	/**
	 * 设置jpg图片质量
	 * @param string $source_img 源图片路径
	 * @param string $target_img 要生成的图片的路径
	 * @param number $quality 图片的质量
	 * @return boolean 转换成共返回true 否则false
	 */
	public function setImageQuality($source_img, $target_img = '', $quality = 80)
	{
	    if (!is_object($this->imagick)) {
	        return false;
	    }
	    try {
	        $target_img = empty($target_img) ? $source_img : $target_img;
	        $this->imagick->readImage($source_img);
	        $this->imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
	        $this->imagick->setImageCompressionQuality($quality);
	        if ($this->imagick->writeImage($target_img)) {
	            return $target_img;
	        }
	        return false;
	    } catch (ImagickException $e) {
	        return false;
	    }
	}
	
	
}
