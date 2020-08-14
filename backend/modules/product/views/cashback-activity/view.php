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
            'asin',
            'sold_by',
            'price',
            'cashback',
            'qty',
            'start:datetime',
            'end:datetime',
            [
                "attribute" => "status",
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 0:
                            return '未启用';
                            break;
                        case 1:
                            $time = time();
                            if ($model->start <= $time && $model->end >= $time){
                                return '生效中';
                            } else if ($model->start > $time){
                                return '待生效';
                            } else {
                                return '已过期';
                            }
                            break;
                        case 2:
                            return '已取消';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                }
            ],
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>