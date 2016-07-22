<?php
/*---------------------
 * 生成指定大小图片示例
-----------------------*/
require(__DIR__ . '/vendor/autoload.php');

$resizeImg = new cmhc\ResizeImage\ResizeImage;

$uploads_dir = dirname(__FILE__) .'/images';//这里是放图片的文件夹

$input_dir = $uploads_dir.'/input';//这里是输入文件夹
$output_dir = $uploads_dir .'/output';//这里是输出文件夹

$od = opendir($input_dir);

while($file = readdir($od)){
  if($file!='.' && $file != '..' && $file != 'input_files_here'){
    echo $file.'<br />';
    $resizeImg->resize($input_dir.'/'.$file, $output_dir.'/re'.$file,358,'auto');//300和250分别代表宽度和高度
  }
}
?>