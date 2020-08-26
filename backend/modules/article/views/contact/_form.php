<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\LayuiAsset;

?>
    <div class="auth-item-form create_box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group field-contact-title">
            <label class="control-label" for="contact-title">姓名</label>
            <div class="custom-control-inline"><?= $msg->name?></div>
            <div class="help-block"></div>
        </div>
        <div class="form-group field-contact-title">
            <label class="control-label" for="contact-title">邮箱</label>
            <div class="custom-control-inline"><?= $msg->email?></div>
            <div class="help-block"></div>
        </div>
        <div class="form-group field-contact-title">
            <label class="control-label" for="contact-title">主题</label>
            <div class="custom-control-inline"><?= $msg->title?></div>
            <div class="help-block"></div>
        </div>
        <div class="form-group field-contact-title">
            <label class="control-label" for="contact-title">内容</label>
            <div class="custom-control-inline"><?= $msg->content?></div>
            <div class="help-block"></div>
        </div>
        <label class="control-label" for="contact-title">回复:</label>
        <hr/>
        <?= $form->field($model, 'parent')->textInput()->hiddenInput(['value'=>$msg->id])->label(false); ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => 255,'class'=>'layui-input','value'=>'Re:'.$msg->title]) ?>
        <?= $form->field($model, 'content')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:230px;']) ?>
        <div class="form-group" align='right'>
            <?= Html::submitButton('回复', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>