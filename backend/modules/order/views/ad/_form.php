<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="user-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
    <?= $form->field($model, 'link')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'channel')->dropDownList(['fb'=>'facebook', 'tw'=>'twitter']) ?>
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>