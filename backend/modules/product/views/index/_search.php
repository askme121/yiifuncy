<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\models\Category;

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
    $category_parent = Category::formatTree(true);
    ?>
    <?= $form->field($model, 'name')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'sku')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('分类：', 'product-category_id', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('ProductSearch[category_id]', Yii::$app->request->get('ProductSearch')['category_id']??null, $category_parent, ['id' => 'product-category_id', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>