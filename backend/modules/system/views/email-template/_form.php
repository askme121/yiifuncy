<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\LayuiAsset;

$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
?>
<div class="user-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'scene')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'content')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:250px;']) ?>
    <div align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
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
            fileManagerJson : "<?=yii\helpers\Url::to(['/tools/uploadmanage'])?>",
            allowFileManager : true,
        };
        KindEditor.ready(function(K) {
            window.editor = K.create('#emailtemplate-content', option);
        });
        <?php $this->endBlock() ?>
    </script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>