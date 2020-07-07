<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;

$this->registerJs($this->render('js/form.js'));
$category_root['0'] = Yii::t('app', 'root');
$category_parent = Category::formatTree(true);
$category_parent = $category_root + $category_parent;
?>

<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
    <?= $form->field($model, 'parent_id')->dropDownList($category_parent) ?>
    <?= $form->field($model, 'menu_show')->dropDownList(['1'=>'显示', '2'=>'不显示'])?>
    <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭']) ?>
    <?= $form->field($model, 'sort_order')->input('number',['value'=>100,'class'=>'layui-input']) ?>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
