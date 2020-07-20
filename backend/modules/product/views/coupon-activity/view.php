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
            [
                "attribute" => "coupon_type",
                "value" => function($model) {
                    switch ($model->coupon_type)
                    {
                        case 1:
                            return '按比例折扣';
                            break;
                        case 2:
                            return '按金额折扣';
                            break;
                        default:
                            break;
                    }
                }
            ],
            [
                "attribute" => "coupon",
                "value" => function($model) {
                    if ($model->coupon_type == 1){
                        return $model->coupon.' %';
                    } else if ($model->coupon_type == 2){
                        return $model->coupon.'('.getSymbol().')';
                    }
                }
            ],
            'start',
            'end'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>