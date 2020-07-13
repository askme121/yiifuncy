<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);
$this->registerJs($this->render('js/form.js'));
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'attr_type')->dropDownList(['general_attr'=>'普通属性', 'sku_attr'=>'sku属性'])?>
    <?= $form->field($model, 'db_type')->dropDownList(['string'=>'string', 'int'=>'int'])?>
    <?= $form->field($model, 'show_as_img')->dropDownList(['1'=>'是', '2'=>'否'])?>
    <?= $form->field($model, 'is_require')->dropDownList(['1'=>'是', '2'=>'否'])?>
    <?= $form->field($model, 'status')->dropDownList(['1'=>'启用', '2'=>'禁用'])?>
    <?= $form->field($model, 'default')->textInput(['maxlength' => 255, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'display_type')->dropDownList(['inputString'=>'inputString', 'inputEmail'=>'inputEmail', 'inputDate'=>'inputDate', 'select'=>'select', 'editSelect'=>'editSelect'])?>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>