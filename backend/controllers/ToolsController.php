<?php

namespace backend\controllers;

use common\models\SmallImage;
use Yii;
use yii\web\Controller;
use common\models\Config;
use backend\models\ServiceJson;

class ToolsController extends Controller
{
    public $enableCsrfValidation = false;
    public $order;
    public $cmp_func;

    public function actionUploadWangEditor()
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

    public function actionUploadeditor()
    {
        $save_path = '../../uploads/attached/';
        $save_url =  Config::getConfig('web_site_resources_url').'attached/';
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
        $max_size = 1000000;
        $save_path = realpath($save_path) . '/';
        if (!empty($_FILES['imgFile']['error']))
        {
            switch ($_FILES['imgFile']['error'])
            {
                case '1':
                    $error = '超过php.ini允许的大小';
                    break;
                case '2':
                    $error = '超过表单允许的大小';
                    break;
                case '3':
                    $error = '图片只有部分被上传';
                    break;
                case '4':
                    $error = '请选择图片';
                    break;
                case '6':
                    $error = '找不到临时目录';
                    break;
                case '7':
                    $error = '写文件到硬盘出错';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = '未知错误';
            }
            $this->alert($error);
        }

        if (empty($_FILES) === false)
        {
            $file_name = $_FILES['imgFile']['name'];
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            $file_size = $_FILES['imgFile']['size'];
            if (!$file_name)
            {
                $this->alert("请选择文件");
            }
            if (@is_dir($save_path) === false)
            {
                $this->alert("上传目录不存在");
            }
            if (@is_writable($save_path) === false)
            {
                $this->alert("上传目录没有写权限");
            }
            if (@is_uploaded_file($tmp_name) === false)
            {
                $this->alert("上传失败");
            }
            if ($file_size > $max_size)
            {
                $this->alert("上传文件大小超过限制");
            }
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name]))
            {
                $this->alert("目录名不正确");
            }
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            if (in_array($file_ext, $ext_arr[$dir_name]) === false)
            {
                $this->alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式");
            }
            if ($dir_name !== '')
            {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path))
                {
                    mkdir($save_path);
                }
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path))
            {
                mkdir($save_path);
            }
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false)
            {
                $this->alert("上传文件失败");
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;
            header('Content-type: text/html; charset=UTF-8');
            $json = new ServiceJson();
            echo $json->encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    public function actionUploadmanage()
    {
        $root_path = '../../uploads/attached/';
        $root_url = Config::getConfig('web_site_resources_url').'attached/';
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file')))
        {
            echo "Invalid Directory name.";
            exit;
        }
        if ($dir_name !== '')
        {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path))
            {
                mkdir($root_path);
            }
        }

        if (empty($_GET['path']))
        {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        }
        else
        {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        $this->order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
        if (preg_match('/\.\./', $current_path))
        {
            echo 'Access is not allowed.';
            exit;
        }
        if (!preg_match('/\/$/', $current_path))
        {
            echo 'Parameter is not valid.';
            exit;
        }
        if (!file_exists($current_path) || !is_dir($current_path))
        {
            echo 'Directory does not exist.';
            exit;
        }

        $file_list = array();
        if ($handle = opendir($current_path))
        {
            $i = 0;
            while (false !== ($filename = readdir($handle)))
            {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file))
                {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                }
                else
                {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }
        $this->cmp_func = function ($a, $b){
            if ($a['is_dir'] && !$b['is_dir'])
            {
                return -1;
            }
            else if (!$a['is_dir'] && $b['is_dir'])
            {
                return 1;
            }
            else
            {
                if ($this->order == 'size')
                {
                    if ($a['filesize'] > $b['filesize'])
                    {
                        return 1;
                    }
                    else if ($a['filesize'] < $b['filesize'])
                    {
                        return -1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                else if ($this->order == 'type')
                {
                    return strcmp($a['filetype'], $b['filetype']);
                }
                else
                {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        };
        usort($file_list, $this->cmp_func);
        $result = array();
        $result['moveup_dir_path'] = $moveup_dir_path;
        $result['current_dir_path'] = $current_dir_path;
        $result['current_url'] = $current_url;
        $result['total_count'] = count($file_list);
        $result['file_list'] = $file_list;
        header('Content-type: application/json; charset=UTF-8');
        $json = new ServiceJson();
        echo $json->encode($result);
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

    private function alert($msg)
    {
        header('Content-type: text/html; charset=UTF-8');
        $json = new ServiceJson();
        echo $json->encode(array('error' => 1, 'message' => $msg));
        exit;
    }
}
