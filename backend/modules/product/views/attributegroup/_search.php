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
    <?= $form->field($model, 'name')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('状态：', 'attribute-status', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('AttributeGroupSearch[status]', Yii::$app->request->get('AttributeGroupSearch')['status']??null, ['1'=>'启用', '2'=>'禁用'], ['id' => 'attribute-status', 'prompt' => '全部'])?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>