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
            'title',
            'url_key',
            [
                "attribute" => "cate_id",
                "value" => function($model) {
                    if ($model->cate_id == 0) {
                        return 'single';
                    } else if ($model->cate_id == 1) {
                        return 'faq';
                    } else {
                        return Yii::t('app', 'unkown');
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
            'order',
            [
                "attribute" => "content",
                "format"=>'html',
            ]
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>