<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->registerJs($this->render('js/form.js'));
?>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
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
        <?= Html::submitButton(Yii::t('app', 'create'), ['class' => 'layui-btn'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>