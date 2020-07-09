<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;

$this->registerJs($this->render('js/form.js'));
$category_root['0'] = Yii::t('app', 'root');
$category_parent = Category::formatTree(true);
$category_parent = $category_root + $category_parent;
?>
<style type="text/css">
    .layui-tab-item{
        top: 90px;
        left: 30px;
        padding-right: 20px;
    }
</style>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>Meta部分</li>
        </ul>
        <div class="layui-tab-content" style="min-height: 560px;">
            <div class="layui-tab-item layui-show">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'description')->textarea(['maxlength' => 255, 'style'=>'min-height:50px', 'class'=>'layui-textarea']) ?>
                <?= $form->field($model, 'parent_id')->dropDownList($category_parent) ?>
                <?= $form->field($model, 'menu_show')->dropDownList(['1'=>'显示', '2'=>'不显示'])?>
                <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭']) ?>
                <?= $form->field($model, 'order')->input('number',['value'=>100,'class'=>'layui-input']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
            </div>
        </div>
    </div>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
