<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
$this->title = '管理登录';
$fieldOptions1 = [
    'options' => ['class' => 'layui-form-item'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-box-body">
        <h1>重置密码</h1>
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form','options'=>['class' => 'layui-form'], 'enableClientValidation' => false]); ?>
        <?= $form
            ->field($model, 'password', $fieldOptions1)
            ->label(false)
            ->textInput(['type'=>'password','class' => 'layui-input','placeholder' => $model->getAttributeLabel('password')]) ?>
        <div class="layui-form-item">
			<?= Html::submitButton('保存', ['class' => 'layui-btn login_btn', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>