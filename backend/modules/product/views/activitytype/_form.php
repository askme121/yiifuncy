<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>