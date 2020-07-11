<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use backend\assets\LayuiAsset;

$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
$category_parent = Category::formatTree(true);
?>
<style type="text/css">
    .layui-tab-item{
        top: 90px;
        left: 30px;
        padding-right: 20px;
    }
    .category_image{
        position: absolute;
        right: 20px;
        top: 343px;
        z-index: 0;
    }
    .upload_input{
        width: 77.7%;
    }
</style>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>Meta部分</li>
            <li>其他部分</li>
            <li>描述部分</li>
            <li>图片信息</li>
        </ul>
        <div class="layui-tab-content" style="min-height: 520px;">
            <div class="layui-tab-item layui-show">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'sku')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'category_id')->dropDownList($category_parent) ?>
                <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭'])?>
                <?= $form->field($model, 'order')->input('number',['value'=>$model->order??100,'class'=>'layui-input']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'long')->input('number',['value'=>$model->long??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'width')->input('number',['value'=>$model->width??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'high')->input('number',['value' =>$model->high??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'weight')->input('number',['value' =>$model->weight??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'volume_weight')->input('number',['value' =>$model->volume_weight??0,'class'=>'layui-input']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'short_description')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:200px;']) ?>
                <?= $form->field($model, 'description')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:230px;']) ?>
            </div>
            <div class="layui-tab-item">

            </div>
        </div>
    </div>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('editor') ?>
    // 关闭过滤模式，保留所有标签
    KindEditor.options.filterMode = false;
    var option = {
        items: [
            'source', 'undo', 'redo', 'preview', 'cut', 'copy', 'paste',
            'plainpaste', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'selectall',
            'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'image', 'multiimage',
            'table', 'hr',
            'anchor', 'link', 'unlink', 'fullscreen'
        ],
        uploadJson : "<?=yii\helpers\Url::to(['/tools/uploadeditor'])?>",
        fileManagerJson : "<?=yii\helpers\Url::to(['/tools/uploadmanage'])?>"
    };
    KindEditor.ready(function(K) {
        window.editor = K.create('#product-short_description', option);
        window.editor1 = K.create('#product-description', option);
    });
    <?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>