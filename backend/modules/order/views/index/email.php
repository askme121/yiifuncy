<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
?>
<div class="product-update">
    <div class="user-form create_box">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
        <div class="form-group field-product-meta_title">
            <label class="control-label" for="product-meta_title">邮件标题</label>
            <input type="text" class="layui-input" name="title" value="<?= $title?>" maxlength="255">
            <div class="help-block"></div>
        </div>
        <div class="form-group field-product-short_description">
            <label class="control-label" for="product-short_description">邮件内容</label>
            <textarea id="email_content" class="layui-textarea" name="content" style="height: 300px"></textarea>
            <div class="help-block"></div>
        </div>
        <div align='right'>
            <?= Html::submitButton('发送', ['class' => 'layui-btn layui-btn-normal']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
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
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat',
        'table', 'hr',
        'anchor', 'link', 'unlink', 'fullscreen'
    ],
    uploadJson : "<?=yii\helpers\Url::to(['/tools/uploadeditor'])?>",
    fileManagerJson : "<?=yii\helpers\Url::to(['/tools/uploadmanage'])?>",
    allowFileManager : true,
};
KindEditor.ready(function(K) {
    window.editor = K.create('#email_content', option);
});
<?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>
