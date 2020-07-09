<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="user-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'order')->input('number',['class'=>'layui-input', 'value'=>$model->order??50]) ?>
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>