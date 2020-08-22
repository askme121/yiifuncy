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
            'tag',
            [
                "attribute" => "channel",
                "value" => function($model) {
                    switch ($model->channel)
                    {
                        case 'fb':
                            return 'facebook';
                            break;
                        case 'tw':
                            return 'twitter';
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
                        case 1:
                            return '激活';
                            break;
                        case 2:
                            return '关闭';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            'created_at:datetime',
            'updated_at:datetime'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>