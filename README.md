# resizeImg
裁剪图片脚本

```
require(__DIR__ . '/vendor/autoload.php');
$resizeImg = new cmhc\ResizeImage\ResizeImage;
$resizeImg->resize($inputfile, $outputfile,$width,$height);

```