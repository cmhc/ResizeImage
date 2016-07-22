<?php
namespace cmhc\ResizeImage;

/*------------------------------
 * 缩略图脚本
 * 支持 jpg，png，gif 缩略图不变形生成
 * author:huchao <hu_chao@139.com>
-------------------------------*/

class ResizeImage
{
    public function resize($img_path, $new_path, $width, $height)
    {

        /**
         * 取出合适的裁减比例
         */
        $imgInfo = getimagesize($img_path);
        $imgWidth = $imgInfo[0]; //宽度
        $imgHeight = $imgInfo[1]; //高度
        $imgType = $imgInfo[2]; //类型

        /* auto width */
        if ($width == 'auto') {
            $heightScale = $imgHeight / $height; //高度比例
            $targetWidth = $imgWidth / $heightScale;
            $targetHeight = $height;
        } else if ($height == 'auto') {
            $widthScale = $imgWidth / $width;
            $targetHeight = $imgHeight / $widthScale;
            $targetWidth = $width;
        } else {
            //获取最适合大小比例
            $widthScale = $imgWidth / $width; //宽度比例
            $heightScale = $imgHeight / $height; //高度比例
            $scale = ($widthScale > $heightScale) ? $heightScale : $widthScale; //取比例最小的
            $targetWidth = $imgWidth / $scale; //最终宽度
            $targetHeight = $imgHeight / $scale; //最终高度
        }

        $resultImage = imagecreatetruecolor($targetWidth, $targetHeight); //建立给出的图形

        //根据原图像创建资源
        switch ($imgType) {
            case 1:
                $imgage = imagecreatefromgif($img_path);
                break;
            case 2:
                $image = imagecreatefromjpeg($img_path);
                break;
            case 3:
                $image = imagecreatefrompng($img_path);
                break;
            case 4:
                $image = imagecreatefromwbmp($img_path);
                break;
            default:
                die('文件类型不支持');
                break;
        }

        imagecopyresampled($resultImage, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $imgWidth, $imgHeight); //拷贝部分图
        /*
        	$resultImage   需要输出的图像数据
        	$image 根据图像的路径获取的图片数据
        	0 目标 x
        	0 目标 Y
        	0 源 X
        	0 源Y
        	$targetWidth 最终宽度
        	$targetHeight 最终高度
        	$imgWidth 输入文件的宽度
        	$imgHeight 输入文件的高度
         */
        switch ($imgType) {
            case 1:imagegif($resultImage, $new_path);
                break;
            case 2:imagejpeg($resultImage, $new_path);
                break;
            case 3:imagepng($resultImage, $new_path);
                break;
            case 4:imagewbmp($resultImage, $new_path);
                break;
        }

        imagedestroy($resultImage);
        imagedestroy($image);
    }
}
