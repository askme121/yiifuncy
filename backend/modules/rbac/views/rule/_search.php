<?php

use rbac\models\Rule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<div class="article-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline layui-form'],
		'fieldConfig' => [
		   'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
	   ],
    ]);
    $rule_root['0'] = '根';
    $rule_parent = Rule::formatTree(true);
    $rule_parent = $rule_root + $rule_parent;
    ?>
    <?= $form->field($model, 'name')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="layui-inline">
        <?= Html::label('权限类型：', 'rule-type', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('Rule[type]', null, ['1' => '栏目', '2' => '菜单', '3' => '按钮'], ['id' => 'rule-type', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="layui-inline">
        <?= Html::label('父级：', 'rule-parent', ['class'=>'control-label'])?>
        <div class="layui-input-inline">
            <?= Html::dropDownList('Rule[parent]', null, $rule_parent, ['id' => 'rule-parent', 'prompt' => '全部'])?>
        </div>
    </div>
    <span class="help-block" style="display: inline-block;"></span>
    <div class="form-group">
        <?= Html::submitButton('查找', ['class' => 'layui-btn layui-btn-normal']) ?>
        <?= Html::button('添加', ['class' => 'layui-btn layui-default-add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
