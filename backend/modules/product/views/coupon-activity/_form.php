<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\models\ActivityType;
use common\models\Product;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

AppAsset::register($this);
$this->registerJs($this->render('js/form.js'));
$activity_type = ActivityType::formatList();
$product_list = Product::getList();
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'url_key')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map($product_list,'id','name'))?>
    <?= $form->field($model, 'price')->input('text', ['class'=>'layui-input', 'placeholder'=>getSymbol()])?>
    <?= $form->field($model, 'coupon_type')->dropDownList([1=>'按比例折扣', 2=>'按金额折扣'])?>
    <?= $form->field($model, 'coupon')->input('text', ['class'=>'layui-input', 'placeholder'=>getSymbol()])?>
    <?= $form->field($model, 'coupon_code')->textarea(['class'=>'layui-textarea', 'style'=>'min-height:300px']) ?>
    <?= $form->field($model, 'amazon_url')->textInput(['maxlength' => 255, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'qty')->input('number', ['class'=>'layui-input'])?>
    <?= $form->field($model, 'start')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true,
            'startDate' => date('Y-m-d'),
            'readonly' => false,
        ]
    ])?>
    <?= $form->field($model, 'end')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true,
            'startDate' => date('Y-m-d'),
            'readonly' => false,
        ]
    ])?>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>