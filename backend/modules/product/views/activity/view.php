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
            'url_key',
            'amazon_url',
            'price',
            'cashback',
            'coupon'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>