<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);
?>

<div class="menu-search">
    <?php $form = ActiveForm::begin([
        'action' => ['cashbacklist'],
        'method' => 'get',
        'options' => ['class' => 'form-inline layui-form'],
        'fieldConfig' => [
            'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
        ],
    ]);
    ?>
    <?= $form->field($model, 'order_id')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'product_name')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'product_sku')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('类型：', 'order-order_type', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('OrderSearch[order_type]', Yii::$app->request->get('OrderSearch')['order_type']??null, ['1'=>'coupon', '2'=>'cashback'], ['id' => 'order-order_type', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>