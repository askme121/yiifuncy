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
            'order_id',
            'product.name',
            'product.sku',
            [
                "attribute" => "product.thumb_image",
                "format"=>[
                    "image",
                    [
                        "width"=>"50px",
                    ],
                ],
            ],
            'activity.url_key',
            [
                "attribute" => "order_type",
                "value" => function($model) {
                    if ($model->order_type == 2){
                        return 'cashback';
                    } else {
                        return 'coupon';
                    }
                }
            ],
            'amazon_order_id',
            'user_email',
            [
                "attribute" => "origin_cost",
                "value" => function($model) {
                    return getSymbol($model->site_id).' '.$model->origin_cost;
                }
            ],
            [
                "attribute" => "cashback_cost",
                "value" => function($model) {
                    return getSymbol($model->site_id).' '.$model->cashback_cost;
                }
            ],
            [
                "attribute" => "coupon_cost",
                "value" => function($model) {
                    return getSymbol($model->site_id).' '.$model->coupon_cost;
                }
            ],
            'coupon_code',
            [
                "attribute" => "status",
                "value" => function($model) {
                    $order_status = Yii::$app->params['order_status'];
                    if (isset($order_status[$model->status])){
                        return $order_status[$model->status];
                    } else {
                        return Yii::t('app', 'unkown');
                    }
                }
            ],
            'deals_ip',
        ],
        'template' => '<tr><th width="120px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>
