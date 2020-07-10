<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\Category;

LayuiAsset::register($this);
?>
<div class="auth-item-view">
    <?php
    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'attributes' => [
            'name',
            'url_key',
            'sku',
            [
                "attribute" => "category_id",
                "value" => function($model) {
                    if ($model->category_id == 0)
                    {
                        return Yii::t('app', 'undefind');
                    }
                    $category_parent = Category::formatTree();
                    foreach ($category_parent as $k=>$v){
                        if ($model->category_id == $k){
                            return $v;
                        }
                    }
                    return Yii::t('app', 'unkown');
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
                "attribute" => "thumb_image",
                "format"=>[
                    "image",
                    [
                        "width"=>"50px",
                    ],
                ],
            ],
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>