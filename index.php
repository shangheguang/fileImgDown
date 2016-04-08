<?php 
/**
 * @desc 通过ImageMagick扩展远程获取图片生成到本地
 * @author shangheguang@yeah.net
 * @date 2016-04-07
 */
include 'ImageMagickUpload.php';

$ImageMagickUpload = new ImageMagickUpload();

$img_url = 'https://www.baidu.com/img/bd_logo1.png';
$imgAttr = $ImageMagickUpload->getAttr($img_url);
$imgRoot = '/www/site/img.baidu.com/institution/';

if ($imgAttr) {
   //@todo 新的图片路径（图片路径规则带有宽高方便APP适配）
   $target_img = $imgRoot.date('YmdHis') . rand(100, 999) . '@' . $imgAttr['width'] . 'w' . $imgAttr['height'] . 'h.' .$imgAttr['extension'];

   $url = $ImageMagickUpload->setImageQuality($img_url, $target_img);
   
   var_dump($url);
   
} else {
    die('原始图片不存在!');
}
	   

?>