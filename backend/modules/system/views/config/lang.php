<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
$this->registerJs($this->render('js/index.js'));
?>
<div class="layui-input-block systemConfig">
    <form method="post" action="<?= Url::to(['savelang']); ?>" class="pageForm required-validate" onsubmit="return thissubmit(this);">
        <input name="<?= Yii::$app->request->csrfParam?>" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <label class="layui-form-label"><?= Yii::t('app', 'mutil_language') ?></label>
        <input type="hidden" name="langs" class="langs_input"  />
        <input type="hidden" name="id" value="<?=$data['id']?>">
        <div class="layui-tab langs">
            <table class="layui-table">
                <thead class="layui-table-header">
                <tr>
                    <th><?= Yii::t('app', 'lang_name') ?></th>
                    <th><?= Yii::t('app', 'lang_code') ?></th>
                    <th><?= Yii::t('app', 'operation') ?></th>
                </tr>
                </thead>
                <tbody class="layui-table-body">
                <?php if(is_array($langs) && !empty($langs)){  ?>
                    <?php foreach($langs as $one){ ?>
                        <tr>
                            <td>
                                <input class="layui-input lang_name" type="text" value="<?= $one['lang_name'] ?>">
                            </td>
                            <td>
                                <input class="layui-input lang_code" type="text" value="<?= $one['lang_code'] ?>">
                            </td>
                            <td>
                                <i class="fa fa-trash-o"></i>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="layui-tab">
            <?=
            Html::SubmitButton(Yii::t('app', 'save_language'), ['class' => 'layui-btn'])
            ?>
            <?=
            Html::Button(Yii::t('app', 'add_language'), ['class' => 'layui-btn layui-btn-normal addLanguage'])
            ?>
        </div>
    </form>
</div>
<script type="text/javascript">
<?php $this->beginBlock('js_block') ?>
function thissubmit(){
    var fill = true;
    langs_input = "";
    $(".langs table tbody tr").each(function(){
        lang_name = $(this).find(".lang_name").val();
        lang_code = $(this).find(".lang_code").val();
        if (lang_name && lang_code){
            langs_input += lang_name+'##'+lang_code+ "||";
        } else {
            fill = false
        }
    });
    if (fill == false) {
        return false;
    }
    $(".langs_input").val(langs_input);
    return true;
}
<?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END);
?>