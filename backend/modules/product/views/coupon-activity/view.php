<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\ActivityType;

LayuiAsset::register($this);
?>
<style type="text/css">
    .dd-myself{
        width: 100%;
        clear: both;
    }
    .dd-myself dt, .dd-myself dd{
        font-weight: normal;
        float: left;
        width: 50%;
        text-align: center;
        line-height: 30px;
    }

</style>
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
            [
                "attribute" => "coupon_code",
                "format" => "html",
                "value" => function($model) {
                    if ($model->coupon_code){
                        $str = '<dl class="dd-myself">';
                        $str .= '<dt>优惠码</dt><dt>状态</dt>';
                        $str .= '</dl>';
                        foreach ($model->coupon_code as $vv){
                            $str .= '<dl class="dd-myself">';
                            $str .= '<dd>'.$vv['coupon_code'].'</dd>';
                            switch ($vv['status']){
                                case 0:
                                    $status = '未领取';
                                    break;
                                case 1:
                                    $status = '已领取';
                                    break;
                                case 2:
                                    $status = '已使用';
                                    break;
                                case 3:
                                    $status = '已过期';
                                    break;
                                default:
                                    $status = '未知';
                                    break;
                            }
                            $str .= '<dd>'.$status.'</dd>';
                            $str .= '</dl>';
                        }
                        return $str;
                    }
                }
            ],
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>