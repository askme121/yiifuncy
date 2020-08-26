<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<style type="text/css">
    .rps_9fbc a
    {text-decoration:none}
    .rps_9fbc a:hover
    {text-decoration:underline}
    .rps_9fbc table, .rps_9fbc table td{
        border: none !important;
    }
    .rps_9fbc .e-btn{
        display:block !important;
        width:230px !important;
        height:41px !important;
        margin:0 auto; background:#f93;
        text-align:center;
        line-height:41px !important;
        color:#fff;
        border-radius:4px !important;
        font-family:Arial,sans-serif;
        font-size:20px
    }
    .rps_9fbc .foot_top{
        border-top: 1px solid #999 !important;
    }
    .rps_9fbc p{
        word-break:break-all !important;
    }
</style>
<div class="config-view">
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'email',
            'scene',
            'title',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 1? '成功':'失败';
                }
            ],
            'content:html',
            'created_at:datetime'
        ],
    ]) ?>
</div>