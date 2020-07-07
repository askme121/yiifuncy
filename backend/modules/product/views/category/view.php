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
            'name',
            'url_key',
            [
                "attribute" => "parent_id",
                "value" => function($model) {
                    if ($model->parent_id == 0)
                    {
                        return Yii::t('app', 'root');
                    }
                    $category_parent = $model::formatTree();
                    foreach ($category_parent as $k=>$v){
                        if ($model->parent_id == $k){
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
            [
                "attribute" => "menu_show",
                "value" => function($model) {
                    switch ($model->menu_show)
                    {
                        case 1:
                            return '显示';
                            break;
                        case 2:
                            return '不显示';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            'sort_order',
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>