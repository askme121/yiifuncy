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
    <?= $form->field($model, 'product_name')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'product_sku')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('状态：', 'order-status', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('OrderSearch[status]', Yii::$app->request->get('OrderSearch')['status']??null, ['1'=>'待提交信息', '2'=>'待审核', '3'=>'待返现', '4'=>'已返现', '5'=>'已评论', '6'=>'已取消', '7'=>'已作废'], ['id' => 'order-status', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
