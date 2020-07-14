<?php

namespace product\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\AttributeGroup;
use common\models\Attribute;
use common\models\searchs\AttributeGroupSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;

class AttributegroupController extends Controller
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
        $searchModel = new AttributeGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new AttributeGroup();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $model->role_id = Yii::$app->user->identity->role_id;
                $model->team_id = Yii::$app->user->identity->team_id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->site_id = \Yii::$app->session['default_site_id'];
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        if($model->status == AttributeGroup::STATUS_ENABLE){
            return json_encode(['code'=>400,"msg"=>"该属性组已经是启用状态"]);
        }
        $model->status = AttributeGroup::STATUS_ENABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"启用成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionInactive($id)
    {
        $model = $this->findModel($id);
        if($model->status == AttributeGroup::STATUS_DISABLE){
            return json_encode(['code'=>400,"msg"=>"该属性组已经是禁用状态"]);
        }
        $model->status = AttributeGroup::STATUS_DISABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"禁用成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()){
            return json_encode(['code'=>200,"msg"=>"删除成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionChild($id)
    {
        $attr_info = Yii::$app->request->post("attr_info");
        if ($attr_info){
            $attr_info = unserialize($attr_info);
        }
        $model = $this->findModel($id);
        if ($model){
            $attr_ids = $model->attr_ids;
            $str = '';
            if ($attr_ids){
                foreach ($attr_ids as $vv){
                    $item = Attribute::findOne(['id'=>$vv]);
                    if ($item->display_type == 'select' || $item->display_type == 'editSelect'){
                        $str .= '<div class="form-group" style="margin-left: 15px">';
                        $str .= Html::label($item->name, null, ['style'=>'margin-right:5px; width:20%; text-align:right']);
                        $str .= '<select name="Product[attr_group_info]['.$item->name.']" class="layui-input-inline layui-form-select">';
                        if ($item->is_require != 1){
                            $str .= '<option value="">please select</option>';
                        }
                        if ($item->display_data){
                            foreach ($item->display_data as $vo){
                                $str .= '<option value="'.$vo.'" ';
                                if (isset($attr_info[$item->name]) && $vo == $attr_info[$item->name]){
                                    $str .= 'selected';
                                }
                                $str .= '>'.$vo.'</option>';
                            }
                        }
                        $str .= '</select>';
                        $str .= '</div>';
                    } else {
                        $str .= '<div class="form-group" style="margin-left: 15px">';
                        $str .= Html::label($item->name, null, ['style'=>'margin-right:5px; width:20%; text-align:right']);
                        $str .= '<input name="Product[attr_group_info]['.$item->name.']" type="text" value="'.($attr_info[$item->name]??'').'" class="layui-input" style="display: inline-block; width:auto">';
                        $str .= '</div>';
                    }
                }
            }
            return json_encode(['code'=>200,'msg'=>'获取成功','data'=>$str]);
        } else {
            return json_encode(['code'=>400,'msg'=>'不存在的属性组']);
        }
    }

    protected function findModel($id)
    {
        if (($model = AttributeGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}