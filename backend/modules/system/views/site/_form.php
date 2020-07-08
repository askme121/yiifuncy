<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs($this->render('js/upload.js'));
?>
<style type="text/css">
    .site_icon{
        position: absolute;
        right: 30px;
        top: 348px;
        z-index: 0;
    }
</style>
<div class="user-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'lang')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'domain')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'icon',['template' => '{label} <div class="row"><div class="col-sm-12">{input}<button type="button" class="layui-btn upload_button" id="test3"><i class="layui-icon"></i>上传文件</button>{error}{hint}</div></div>'])->textInput(['maxlength' => true,'class'=>'layui-input upload_input']) ?>
    <div class="form-group">
        <?= Html::img(@$model->icon, ['width'=>'50','height'=>'50','class'=>'layui-circle site_icon'])?>
    </div>
    <?= $form->field($model, 'order')->input('number',['class'=>'layui-input', 'value'=>50]) ?>
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
