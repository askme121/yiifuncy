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
			$model->updated_at = time();
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
