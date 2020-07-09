<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use rbac\models\Role;
use backend\models\Team;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
$role_list = Role::getList();
$team_list = Team::getList();
?>

<div class="user-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline layui-form'],
		'fieldConfig' => [
		   'template' => '<div class="layui-inline">{label}：<div class="layui-input-inline">{input}</div></div><span class="help-block" style="display: inline-block;">{hint}</span>',
	   ],
    ]); ?>
    <?= $form->field($model, 'username')->textInput(['class'=>'layui-input search_input']) ?>
    <?= $form->field($model, 'email')->textInput(['class'=>'layui-input search_input']) ?>
    <div class="form-group field-user-role_id">
        <div class="layui-inline">
            <?= Html::label('团队：', 'user-team_id', ['class'=>'control-label'])?>
            <div class="layui-input-inline">
                <?= Html::dropDownList('User[team_id]', null, ArrayHelper::map($team_list,'id','name'), ['id' => 'user-team_id', 'class' => 'dropdownlist', 'prompt' => '全部'])?>
            </div>
        </div>
    </div>
    <div class="form-group field-user-role_id">
        <div class="layui-inline">
            <?= Html::label('角色：', 'user-role_id', ['class'=>'control-label'])?>
            <div class="layui-input-inline">
                <?= Html::dropDownList('User[role_id]', null, ArrayHelper::map($role_list,'id','name'), ['id' => 'user-role_id', 'class' => 'dropdownlist', 'prompt' => '全部'])?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('查找用户', ['class' => 'layui-btn layui-btn-normal']) ?>
		<?= Html::button('添加用户', ['class' => 'layui-btn layui-default-add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
