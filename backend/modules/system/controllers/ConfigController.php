<?php

namespace system\controllers;

use Yii;
use common\models\Config;
use common\models\searchs\ConfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class ConfigController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBasic()
    {
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->basic_search(Yii::$app->request->queryParams);
        return $this->render('basic', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreatebasic()
    {
        $model = new Config();
        $model->site_id = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdatebasic($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('basic', [
                'model' => $model,
            ]);
        }
    }

    public function actionCurrency()
    {
        $res = Config::find()->where(['group'=>3, 'site_id'=>0,'name'=>'currency'])->asArray()->one();
        if ($res)
        {
            if (isset($res['value']))
            {
                $res['value'] = unserialize($res['value']);
            }
        }
        return $this->render('currency', ['data'=>$res, 'list'=>$res['value']]);
    }

    public function actionSavecurrency()
    {
        $param = Yii::$app->request->post();
        $id = isset($param['id'])? $param['id']: null;
        $curr = isset($param['curr'])? $param['curr']: null;
        if (empty($id) || empty($curr))
        {
            return json_encode(['code'=>500, "msg"=>"参数缺失"]);
        }
        if (!empty($curr))
        {
            $arr = [];
            $currArr = explode('||', $curr);
            foreach ($currArr as $one)
            {
                if ($one)
                {
                    list($currency_code, $currency_symbol, $currency_rate) = explode('##', $one);
                    if ($currency_code && $currency_symbol && $currency_rate)
                    {
                        $arr[] = [
                            'currency_code' => $currency_code,
                            'currency_symbol' => $currency_symbol,
                            'currency_rate' => $currency_rate
                        ];
                    }
                }
            }
            $basic_currency = Config::getConfig("basic_currency");
            if ($basic_currency && $arr)
            {
                $curr_arr = ArrayHelper::getColumn($arr,'currency_code');
                if (!in_array($basic_currency, $curr_arr))
                {
                    return json_encode(['code'=>403, "msg"=>'you can not delete basic currency code:'.$basic_currency]);
                }
            }
            $model = $this->findModel($id);
            $model->value = serialize($arr);
            $model->updated_at = time();
            if($model->save()){
                return $this->redirect(['currency']);
            }
        }
    }

    public function actionEmail()
    {
        $res = Config::find()->where(['group'=>4, 'site_id'=>0, 'name'=>'email'])->asArray()->one();
        if ($res)
        {
            if (isset($res['value']))
            {
                $res['value'] = unserialize($res['value']);
            }
        }
        return $this->render('email', ['data'=>$res, 'list'=>$res['value']]);
    }

    public function actionSaveemail()
    {
        $param = Yii::$app->request->post();
        $id = isset($param['id'])? $param['id']: null;
        if (empty($id))
        {
            return json_encode(['code'=>500, "msg"=>"参数缺失"]);
        }
        $data['default_smtp_host'] = isset($param['default_smtp_host'])? $param['default_smtp_host']: '';
        $data['default_smtp_username'] = isset($param['default_smtp_username'])? $param['default_smtp_username']: '';
        $data['default_smtp_password'] = isset($param['default_smtp_password'])? $param['default_smtp_password']: '';
        $data['default_smtp_port'] = isset($param['default_smtp_port'])? $param['default_smtp_port']: '';
        $data['default_smtp_encryption'] = isset($param['default_smtp_encryption'])? $param['default_smtp_encryption']: '';
        $model = $this->findModel($id);
        $model->value = serialize($data);
        $model->updated_at = time();
        if($model->save()){
            return $this->redirect(['email']);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Config();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		if($model->status==0){
			return json_encode(['code'=>400,"msg"=>"系统配置项禁止删除"]);
		}else{
			if($model->delete()){
				return json_encode(['code'=>200,"msg"=>"删除成功"]);
			}else{
				$errors = $model->firstErrors;
				return json_encode(['code'=>400,"msg"=>reset($errors)]);
			}
		}
    }

    public function actionDeleteAll()
    {
        $data = Yii::$app->request->post();
        if($data){
            $model = new Config;
			$system_config = $model::find()->select('id')->where(['status'=>0])->asArray()->all();
			$system_config_id = ArrayHelper::getColumn($system_config, 'id');
			foreach ($data['keys'] as $value) {
				if(in_array($value, $system_config_id)){
					return json_encode(['code'=>400,"msg"=>"批量删除中有系统配置项，删除失败"]);
				}
			}
            $count = $model->deleteAll(["in","id",$data['keys']]);
            if($count>0){
                return json_encode(['code'=>200,"msg"=>"删除成功"]);
            }else{
				$errors = $model->firstErrors;
                return json_encode(['code'=>400,"msg"=>reset($errors)]);
            }
        }else{
            return json_encode(['code'=>400,"msg"=>"请选择数据"]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
