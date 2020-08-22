<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs($this->render('js/form.js'));
?>
<div class="user-form create_box">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'layui-form']]); ?>
    <?= $form->field($model, 'tag')->textInput()->hiddenInput(['value'=>'tag'])->label(false) ?>
    <?= $form->field($model, 'flag')->textInput(['maxlength' => 128,'class'=>'layui-input']) ?>
    <?= $form->field($model, 'channel')->dropDownList(['fb'=>'facebook', 'tw'=>'twitter']) ?>
    <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭'])?>
    <div align='right'>
        <?= Html::button($model->isNewRecord ? Yii::t('app', 'add') : Yii::t('app', 'edit'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
    <script type="text/javascript">
        <?php $this->beginBlock('js') ?>
        $(document).ready(function(){
            $(".layui-btn").click(function () {
                var flag = $("#tag-flag").val().trim();
                var chan = $("#tag-channel").val().trim();
                $("#tag-tag").val(flag + '-' + chan);
                $("#w0").submit();
            });
        });
        <?php $this->endBlock() ?>
    </script>
<?php
$this->registerJs($this->blocks['js'],\yii\web\View::POS_END);
?>