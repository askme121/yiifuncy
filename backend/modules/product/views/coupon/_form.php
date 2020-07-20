<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->registerJs($this->render('js/form.js'));
?>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model,'product_id') ?>
    <?= $form->field($model, 'coupon_type')->dropDownList([1=>'按比例折扣', 2=>'按金额折扣'])?>
    <?= $form->field($model, 'coupon')->input('text', ['class'=>'layui-input', 'placeholder'=>''])?>
    <?= $form->field($model, 'expired_at')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true,
            'startDate' => date('Y-m-d'),
            'readonly' => false,
        ]
    ])?>
    <?= $form->field($model, 'coupon_code')->textarea(['class'=>'layui-textarea', 'style'=>'min-height:300px']) ?>
    <div class="form-group" align='right'>
        <?= Html::button(Yii::t('app', 'create'), ['class' => 'layui-btn add-button'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>