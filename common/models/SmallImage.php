<?php

namespace common\models;

use Yii;
use yii\base\Model;

class SmallImage extends Model
{
    private $src;
    private $imageinfo;
    private $image;
    public  $percent = 0.1;

    public function setImage($src)
    {
        $this->src = $src;
    }

    public function openImage()
    {
        list($width, $height, $type, $attr) = getimagesize($this->src);
        $this->imageinfo = [
            'width'=>$width,
            'height'=>$height,
            'type'=>image_type_to_extension($type,false),
            'attr'=>$attr
        ];
        $fun = 'imagecreatefrom'.$this->imageinfo['type'];
        $this->image = $fun($this->src);
    }

    public function thumpImage($width=null, $height=null)
    {
        if ($width && $height)
        {
            if ($width >= $height)
            {
                if ($height >= $this->imageinfo['height'])
                {
                    $this->percent = 1;
                }
                else
                {
                    $this->percent = round($height/$this->imageinfo['height'],2);
                }
            }
            else
            {
                if ($width >= $this->imageinfo['width'])
                {
                    $this->percent = 1;
                }
                else
                {
                    $this->percent = round($width/$this->imageinfo['width'],2);
                }
            }
        }
        else if ($width)
        {
            if ($width >= $this->imageinfo['width'])
            {
                $this->percent = 1;
            }
            else
            {
                $this->percent = round($width/$this->imageinfo['width'],2);
            }
        }
        else if ($height)
        {
            if ($height >= $this->imageinfo['height'])
            {
                $this->percent = 1;
            }
            else
            {
                $this->percent = round($height/$this->imageinfo['height'],2);
            }
        }
        $new_width = $this->imageinfo['width'] * $this->percent;
        $new_height = $this->imageinfo['height'] * $this->percent;
        $image_thump = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);
        imagedestroy($this->image);
        $this->image =   $image_thump;
    }

    public function showImage()
    {
        header('Content-Type: image/'.$this->imageinfo['type']);
        $funcs = "image".$this->imageinfo['type'];
        $funcs($this->image);
    }

    public function saveImage($sname)
    {
        $funcs = "image".$this->imageinfo['type'];
        $funcs($this->image, $sname);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }
}
