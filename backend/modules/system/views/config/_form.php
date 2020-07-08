<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Config;
?>
<div class="config-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
	<?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=> Config::getHtmlStatus($model->id),'class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'value')->textarea(['rows' => 6,'class'=>'layui-textarea']) ?>
    <?= $form->field($model, 'remark')->textInput(['maxlength' => true,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'order')->textInput(['class'=>'layui-input', 'value'=>50]) ?>
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
