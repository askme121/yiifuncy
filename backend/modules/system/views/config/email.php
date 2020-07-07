<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
$this->registerJs($this->render('js/index.js'));
?>
<style type="text/css">
    .layui-table td{
        border: none;
    }
</style>
<div class="layui-input-block systemConfig">
    <form method="post" action="<?= Url::to(['saveemail']); ?>" class="pageForm required-validate">
        <input name="<?= Yii::$app->request->csrfParam?>" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="layui-box" style="margin-top: 15px">
            <h5><?= Yii::t('app', 'email_config') ?></h5>
        </div>
        <input type="hidden" name="id" value="<?=$data['id']?>">
        <table class="layui-table">
            <tbody class="layui-table-body">
                <tr>
                    <td width="15%" align="right">
                        <?= Html::label('Smtp服务器：', 'default_smtp_host', ['class'=>'control-label'])?>
                    </td>
                    <td>
                        <?= Html::textInput("default_smtp_host", $list['default_smtp_host']??'', ['id'=>'default_smtp_host','class'=>'layui-input'])?>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?= Html::label('Smtp账户：', 'default_smtp_username', ['class'=>'control-label'])?>
                    </td>
                    <td>
                        <?= Html::textInput("default_smtp_username", $list['default_smtp_username']??'', ['id'=>'default_smtp_username','class'=>'layui-input'])?>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?= Html::label('Smtp密码：', 'default_smtp_password', ['class'=>'control-label'])?>
                    </td>
                    <td>
                        <?= Html::textInput("default_smtp_password", $list['default_smtp_password']??'', ['id'=>'default_smtp_password','class'=>'layui-input'])?>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?= Html::label('Smtp端口：', 'default_smtp_port', ['class'=>'control-label'])?>
                    </td>
                    <td>
                        <?= Html::textInput("default_smtp_port", $list['default_smtp_port']??'', ['id'=>'default_smtp_port','class'=>'layui-input'])?>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?= Html::label('Smtp加密方式：', 'default_smtp_encryption', ['class'=>'control-label'])?>
                    </td>
                    <td>
                        <?= Html::textInput("default_smtp_encryption", $list['default_smtp_encryption']??'', ['id'=>'default_smtp_encryption','class'=>'layui-input'])?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="layui-tab">
            <?=
            Html::SubmitButton(Yii::t('app', 'save_config'), ['class' => 'layui-btn', 'style'=>'margin-left:16%'])
            ?>
        </div>
    </form>
</div>
