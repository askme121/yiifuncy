<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="auth-item-view">
    <?php
    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'attributes' => [
            'name',
            'email',
            'title',
            'ip',
            [
                "attribute" => "type",
                "value" => function($model) {
                    switch ($model->type)
                    {
                        case 1:
                            return '接收';
                            break;
                        case 2:
                            return '发送';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                "attribute" => "status",
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 0:
                            return '未读';
                            break;
                        case 1:
                            return '已读';
                            break;
                        case 2:
                            return '已回复';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                "attribute" => "content",
                "format"=>'html',
            ],
            'created_at:datetime'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>