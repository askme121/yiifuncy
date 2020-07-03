<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rbac\AutocompleteAsset;
use rbac\models\Rule;

AutocompleteAsset::register($this);
$this->registerJs($this->render('js/form.js'));
$rule_list = Rule::getTree();
?>

<div class="menu-form create_box">
    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'name')->textInput(['maxlength' => 128, 'class'=>'layui-input']) ?>
    <?= $form->field($model, 'desc')->textarea(['maxlength' => 255, 'class'=>'layui-textarea']) ?>
    <?= $form->field($model, 'order')->input('number',['class'=>'layui-input']) ?>
    <div class="form-group field-purview">
        <?= Html::label('权限：', 'purview', ['class'=>'control-label'])?>
        <input type="hidden" name="Role[purview]" value="">
        <div class="layui-input-block" style="margin-left: 20px">
            <ul class="group_resource">
                <?php if (!empty($rule_list) && is_array($rule_list)):  ?>
                    <?php foreach ($rule_list as $groupKey => $resources): ?>
                        <li>
                            <label style="font-weight: normal">
                                <input type="checkbox" name="Role[purview][]"  value="<?= $resources['id'] ?>" <?= in_array($resources['id'], $model->purview) ? 'checked="checked"' : '' ?> />
                                <span><?= $resources['name'] ?></span>
                            </label>
                            <?php if (!empty($resources['child']) && is_array($resources['child'])):  ?>
                            <ul class="group_resource" style="margin-left: 20px">
                                <?php foreach ($resources['child'] as $firstKey => $first): ?>
                                    <li <?php if (empty($first['child'])){ echo 'class="pull-left"';}?>>
                                        <label style="font-weight: normal">
                                            <input type="checkbox" name="Role[purview][]"  value="<?= $first['id'] ?>" <?= in_array($first['id'], $model->purview) ? 'checked="checked"' : '' ?> />
                                            <span><?= $first['name'] ?></span>
                                        </label>
                                        <?php if (!empty($first['child']) && is_array($first['child'])):  ?>
                                        <ul class="group_resource" style="margin-left: 20px">
                                            <?php foreach ($first['child'] as $secondKey => $second): ?>
                                                <li <?php if (empty($second['child'])){ echo 'class="pull-left"';}?>>
                                                    <label style="font-weight: normal">
                                                        <input type="checkbox" name="Role[purview][]"  value="<?= $second['id'] ?>" <?= in_array($second['id'], $model->purview) ? 'checked="checked"' : '' ?> />
                                                        <span><?= $second['name'] ?></span>
                                                    </label>
                                                    <?php if (!empty($second['child']) && is_array($second['child'])):  ?>
                                                    <ul class="group_resource" style="margin-left: 20px">
                                                        <?php foreach ($second['child'] as $thirdKey => $third): ?>
                                                            <li <?php if (empty($third['child'])){ echo 'class="pull-left"';}?>>
                                                                <label style="font-weight: normal">
                                                                    <input type="checkbox" name="Role[purview][]"  value="<?= $third['id'] ?>" <?= in_array($third['id'], $model->purview) ? 'checked="checked"' : '' ?> />
                                                                    <span><?= $third['name'] ?></span>
                                                                </label>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <?php else: ?>
                                                    <li class="clear"></li>
                                                    <?php endif;  ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        <li class="clear"></li>
                                        <?php endif;  ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif;  ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif;  ?>
            </ul>
        </div>
        <div class="help-block"></div>
    </div>
    <div align='right' style="margin-top:15px;">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord? 'layui-btn' : 'layui-btn layui-btn-normal'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
