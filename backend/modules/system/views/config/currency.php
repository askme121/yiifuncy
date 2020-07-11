<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
$this->registerJs($this->render('js/index.js'));
?>
<div class="layui-input-block systemConfig">
    <form method="post" action="<?= Url::to(['savecurrency']); ?>" class="pageForm required-validate" onsubmit="return thissubmit(this);">
        <input name="<?= Yii::$app->request->csrfParam?>" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <label class="layui-form-label"><?= Yii::t('app', 'mutil_currency') ?></label>
        <input type="hidden" name="curr" class="curr_input"  />
        <input type="hidden" name="id" value="<?=$data['id']?>">
        <div class="layui-tab currs">
            <table class="layui-table">
                <thead class="layui-table-header">
                <tr>
                    <th><?= Yii::t('app', 'currency_code') ?></th>
                    <th><?= Yii::t('app', 'currency_symbol') ?></th>
                    <th><?= Yii::t('app', 'currency_rate') ?></th>
                    <th><?= Yii::t('app', 'operation') ?></th>
                </tr>
                </thead>
                <tbody class="layui-table-body">
                <?php if(!empty($list) && is_array($list)){  ?>
                    <?php foreach($list as $one){ ?>
                        <tr>
                            <td>
                                <input class="layui-input currency_code" type="text" value="<?= $one['currency_code'] ?>">
                            </td>
                            <td>
                                <input class="layui-input currency_symbol" type="text" value="<?= $one['currency_symbol'] ?>">
                            </td>
                            <td>
                                <input class="layui-input currency_rate" type="text" value="<?= $one['currency_rate'] ?>">
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
            Html::SubmitButton(Yii::t('app', 'save_currency'), ['class' => 'layui-btn'])
            ?>
            <?=
            Html::Button(Yii::t('app', 'add_currency'), ['class' => 'layui-btn layui-btn-normal addCurrency'])
            ?>
        </div>
    </form>
</div>
    <script type="text/javascript">
<?php $this->beginBlock('js_block') ?>
    function thissubmit(){
    var fill = true;
    currs_input = "";
    $(".currs table tbody tr").each(function(){
        curr_code = $(this).find(".currency_code").val();
        curr_symbol = $(this).find(".currency_symbol").val();
        curr_rate = $(this).find(".currency_rate").val();
        if (curr_code && curr_symbol && curr_rate){
            currs_input += curr_code + '##' + curr_symbol + '##' + curr_rate + "||";
        } else {
            fill = false
        }
    });
    if (fill == false) {
        return false;
    }
    $(".curr_input").val(currs_input);
    return true;
    }
<?php $this->endBlock() ?>
    </script>
<?php
$this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END);
?>