<?php

namespace article\controllers;

use common\models\searchs\ContactSearch;
use common\models\Contact;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
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
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSend()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->send(Yii::$app->request->queryParams);
        return $this->render('send', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSystem()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->system(Yii::$app->request->queryParams);
        return $this->render('system', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 0 && $model->type == 1){
            $model->status = 1;
            $model->save();
        }
        if ($model->type == 1 && $model->status == 2){
            $replay = Contact::find()->where(['parent'=>$model->id])->one();
            if ($replay){
                $model->replay_title = $replay->title;
                $model->replay_content = $replay->content;
            }
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $msg = $this->findModel($id);
        $model = new Contact();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $pre = Contact::findOne($model->parent);
                $model->user_id = $pre->user_id;
                $model->name = $pre->name;
                $model->email = $pre->email;
                $model->order_id = $pre->order_id;
                $model->type = 2;
                $model->ip = Yii::$app->getRequest()->getUserIP();
                $model->save();
                $pre->status = 2;
                $pre->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        }
        return $this->render('update', ['model' => $model, 'msg' => $msg]);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}