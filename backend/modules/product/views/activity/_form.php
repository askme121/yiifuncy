<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\models\ActivityType;
use common\models\Product;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
$this->registerJs($this->render('js/form.js'));
$activity_type = ActivityType::formatList();
$product_list = Product::getList();
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'url_key')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map($product_list,'id','name'))?>
    <?= $form->field($model, 'type')->dropDownList($activity_type)?>
    <?= $form->field($model, 'price')->input('text', ['class'=>'layui-input'])?>
    <?= $form->field($model, 'cashback')->input('text', ['class'=>'layui-input'])?>
    <?= $form->field($model, 'coupon')->input('text', ['class'=>'layui-input'])?>
    <?= $form->field($model, 'amazon_url')->textInput(['maxlength' => 255, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'qty')->input('number', ['class'=>'layui-input'])?>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>