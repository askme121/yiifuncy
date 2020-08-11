<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="auth-item-view">
    <?php
    $options = [
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'attributes' => [
            'name',
            'email',
            'title',
            [
                "attribute" => "content",
                "format"=>'html',
            ],
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
            'created_at:datetime',
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
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ];
    if ($model->type == 1 && $model->status == 2 && $model->replay_title && $model->replay_content){
        array_push($options['attributes'], 'replay_title', [
            "attribute" => "replay_content",
            "format"=>'html',
        ]);
    }
    echo DetailView::widget($options);
    ?>
</div>