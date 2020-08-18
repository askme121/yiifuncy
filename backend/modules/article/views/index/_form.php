<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\LayuiAsset;

$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
?>
    <style type="text/css">
        .layui-tab-item{
            top: 80px;
            left: 30px;
            padding-right: 20px;
        }
        .product_image{
            position: absolute;
            right: 20px;
            top: 327px;
            z-index: 0;
        }
        .upload_input{
            width: 77.7%;
        }
        .layui-form-select{
            padding: 5px 8px;
        }
    </style>
    <div class="auth-item-form create_box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
                <li class="layui-this">基本信息</li>
                <li>Meta部分</li>
            </ul>
            <div class="layui-tab-content" style="min-height: 550px;">
                <div class="layui-tab-item layui-show">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                    <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
                    <?= $form->field($model, 'cate_id')->dropDownList(['0'=>'single', '1'=>'faq']) ?>
                    <?= $form->field($model, 'content')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:230px;']) ?>
                </div>
                <div class="layui-tab-item">
                    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
                    <?= $form->field($model, 'order')->input('number',['value'=>$model->order??100,'class'=>'layui-input']) ?>
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
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', 'image', 'multiimage',
                'table', 'hr',
                'anchor', 'link', 'unlink', 'fullscreen'
            ],
            uploadJson : "<?=yii\helpers\Url::to(['/tools/uploadeditor'])?>",
            fileManagerJson : "<?=yii\helpers\Url::to(['/tools/uploadmanage'])?>",
            allowFileManager : true,
        };
        KindEditor.ready(function(K) {
            window.editor1 = K.create('#article-content', option);
        });
        <?php $this->endBlock() ?>
    </script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>