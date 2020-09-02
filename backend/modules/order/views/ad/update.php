<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
$this->registerJs($this->render('js/form.js'));
?>
<div class="product-update">
    <div class="user-form create_box">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
        <?= $form->field($model, 'link')->textInput(['maxlength' => 255,'class'=>'layui-input', 'readonly'=>true]) ?>
        <?= $form->field($model, 'amount')->textInput(['maxlength' => 20,'class'=>'layui-input']) ?>
        <div align='right'>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>