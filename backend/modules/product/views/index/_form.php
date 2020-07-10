<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use backend\assets\LayuiAsset;

$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
$category_parent = Category::formatTree(true);
?>
<style type="text/css">
    .layui-tab-item{
        top: 90px;
        left: 30px;
        padding-right: 20px;
    }
    .category_image{
        position: absolute;
        right: 20px;
        top: 343px;
        z-index: 0;
    }
    .upload_input{
        width: 77.7%;
    }
</style>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>Meta部分</li>
            <li>描述部分</li>
            <li>图片信息</li>
        </ul>
        <div class="layui-tab-content" style="min-height: 520px;">
            <div class="layui-tab-item layui-show">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'sku')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'category_id')->dropDownList($category_parent) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'order')->input('number',['value'=>$model->order??100,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭'])?>
                <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'short_description')->textarea(['class'=>'layui-textarea', 'style'=>'width:400px;height:200px;']) ?>
                <?= $form->field($model, 'description')->textarea(['class'=>'layui-textarea']) ?>
            </div>
            <div class="layui-tab-item">

            </div>
        </div>
    </div>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('editor') ?>
    KindEditor.ready(function(K) {
        window.editor = K.create('#product-short_description');
    });
    <?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>