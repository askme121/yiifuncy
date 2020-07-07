<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rbac\models\Rule;

$this->registerJs($this->render('js/_script.js'));
$rule_root['0'] = Yii::t('app', 'root');
$rule_parent = Rule::formatTree(true);
$rule_parent = $rule_root + $rule_parent;
?>

<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'rule_name')->textInput(['class'=>'layui-input']) ?>
    <?= $form->field($model, 'parent')->dropDownList($rule_parent) ?>
    <?= $form->field($model, 'type')->dropDownList(['1'=>'栏目', '2'=>'菜单', '3'=>'按钮'])?>
    <?= $form->field($model, 'route')->textInput(['class'=>'layui-input']) ?>
    <div class="layui-input-inline" style='width:240px'>
        <label class="control-label" for="rule-icon">图标</label>
        <input placeholder="请输入或选择图标" id="icon" type="text" name="Rule[icon]" value='<?=$model->icon?>' class="layui-input">
    </div>
    <?php echo \yii\helpers\Html::button('打开图标',['class'=>'layui-btn open-icon','style'=>'margin-top: 25px;']);?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'order')->input('number',['value'=>100,'class'=>'layui-input']) ?>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
