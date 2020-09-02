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
            'link',
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
            'tag',
            'sign',
            'amount',
            'access_count',
            'reg_count',
            'order_count',
            'trade_count',
            'created_at:datetime',
        ],
        'template' => '<tr><th width="120px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>