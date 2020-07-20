<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\ActivityType;

LayuiAsset::register($this);
?>
<div class="auth-item-view">
    <?php
    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'attributes' => [
            'product.name',
            [
                "attribute" => "product.thumb_image",
                "format"=>[
                    "image",
                    [
                        "width"=>"50px",
                    ],
                ],
            ],
            'url_key',
            [
                "attribute" => "type",
                "value" => function($model) {
                    return ActivityType::findOne($model->type)->name;
                }
            ],
            'amazon_url',
            'price',
            'cashback',
            'start',
            'end'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>