<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\models\Attribute;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
$this->registerJs($this->render('js/form.js'));
$attr_list = Attribute::getList();
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'status')->dropDownList(['1'=>'启用', '2'=>'禁用'])?>
    <?= $form->field($model, 'attr_ids')->checkboxList(ArrayHelper::map($attr_list,'id','name'), ['value' => $model->attr_ids,
        'item' => function ($index, $label, $name, $checked, $value) {
            $checkStr = $checked ? "checked" : "";
            return '<label style="margin: 10px"><input type="checkbox" name="' . $name . '" value="' . $value . '" ' . $checkStr . ' class="class' . $index . '" data-uid="user' . $index . '" style="margin-right:3px">' . $label . '</label>';
        }, 'itemOptions' => ['class' => 'myClass']]); ?>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>