<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);
?>

<div class="menu-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline layui-form'],
        'fieldConfig' => [
            'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
        ],
    ]);
    ?>
    <?= $form->field($model, 'tag')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('通道：', 'tag-channel', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('TagSearch[channel]', Yii::$app->request->get('TagSearch')['channel']??null, ['fb'=>'facebook', 'tw'=>'twitter'], ['id' => 'tag-channel', 'prompt' => '全部'])?>
        </div>
    </div>
    <div class="layui-inline">
        <?= Html::label('状态：', 'tag-status', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('TagSearch[status]', Yii::$app->request->get('TagSearch')['status']??null, ['1'=>'激活', '2'=>'关闭'], ['id' => 'tag-status', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>