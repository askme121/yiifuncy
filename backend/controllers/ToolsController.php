<?php

namespace backend\controllers;

use common\models\SmallImage;
use Yii;
use yii\web\Controller;
use common\models\Config;

class ToolsController extends Controller
{
    public function actionUploadEditor()
    {
        $file = $_FILES;
        $file_name = $file['wangEditorH5File']['name'];
        $file_tmp_path = $file['wangEditorH5File']['tmp_name'];
        $dir = "../../uploads/".date("Ymd");
        if (!is_dir($dir)){
            mkdir($dir,0777);
        }
		$type = substr(strrchr($file_name, '.'), 1);
		$mo = Config::getConfig('web_site_allow_upload_type');
		$allow_type = explode(',', $mo);
		if(!in_array($type, $allow_type)){
			die("文件类型为不允许的格式");
		}
        $file_save_name = date("YmdHis",time()) . mt_rand(1000, 9999) . '.' . $type;
        move_uploaded_file($file_tmp_path, $dir.'/'.$file_save_name);
        echo Config::getConfig('web_site_resources_url').date('Ymd').'/'.$file_save_name;
    }

    public function actionUpload()
    {
        $file = $_FILES;
        $file_name = $file['file']['name'];
        $file_tmp_path = $file['file']['tmp_name'];
        $dir = "../../uploads/".date("Ymd");
        if (!is_dir($dir)){
            mkdir($dir,0777);
        }
		$type = substr(strrchr($file_name, '.'), 1);
		$mo = Config::getConfig('web_site_allow_upload_type');
		$allow_type = explode(',', $mo);
		if(!in_array($type, $allow_type)){
			die("文件类型为不允许的格式");
		}
        $file_save_name = date("YmdHis",time()) . mt_rand(1000, 9999) . '.' . $type;
        move_uploaded_file($file_tmp_path, $dir.'/'.$file_save_name);
        echo json_encode(array("code"=>"200","data"=>Config::getConfig('web_site_resources_url').date('Ymd').'/'.$file_save_name));
    }

    public function actionUploadthumb()
    {
        $file = $_FILES;
        $param = Yii::$app->request->GET();
        $width = $param['width']??null;
        $height = $param['height']??null;
        $is_thumb = $param['is_thumb']??0;
        $file_name = $file['file']['name'];
        $file_tmp_path = $file['file']['tmp_name'];
        $date = date("Ymd");
        $dir = "../../uploads/".$date;
        if (!is_dir($dir)) {
            mkdir($dir,0777);
        }
        $type = substr(strrchr($file_name, '.'), 1);
        $mo = Config::getConfig('web_site_allow_upload_type');
        $allow_type = explode(',', $mo);
        if(!in_array($type, $allow_type)){
            die("文件类型为不允许的格式");
        }
        $file_save_name = date("YmdHis",time()) . mt_rand(1000, 9999) . '.' . $type;
        move_uploaded_file($file_tmp_path, $dir.'/'.$file_save_name);
        $data['data'] = Config::getConfig('web_site_resources_url').$date.'/'.$file_save_name;
        if ($is_thumb){
            $thumb_dir = $dir. '/thumb';
            if (!is_dir($thumb_dir)){
                mkdir($thumb_dir,0777);
            }
            $image = new SmallImage();
            $image->setImage($dir.'/'.$file_save_name);
            $image->openImage();
            $image->thumpImage($width, $height);
            $image->saveImage($thumb_dir.'/'.$file_save_name);
            $data['thumb_data'] = Config::getConfig('web_site_resources_url').$date.'/thumb/'.$file_save_name;
        }
        $data['code'] = 200;
        echo json_encode($data);
        exit;
    }

	public function actionIco()
    {
		return $this->render('ico');
	}
}
