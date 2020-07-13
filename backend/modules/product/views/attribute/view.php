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
            [
                "attribute" => "attr_type",
                "value" => function($model) {
                    switch ($model->attr_type)
                    {
                        case 'general_attr':
                            return '普通属性';
                            break;
                        case 'sku_attr':
                            return 'sku属性';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            'db_type',
            'display_type',
            'default',
            [
                "attribute" => "show_as_img",
                "value" => function($model) {
                    switch ($model->show_as_img)
                    {
                        case 1:
                            return '是';
                            break;
                        case 2:
                            return '否';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                "attribute" => "is_require",
                "value" => function($model) {
                    switch ($model->is_require)
                    {
                        case 1:
                            return '是';
                            break;
                        case 2:
                            return '否';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                "attribute" => "status",
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 1:
                            return '启用';
                            break;
                        case 2:
                            return '禁用';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                "attribute" => "display_data",
                "value" => function($model) {
                    if ($model->display_data){
                        $str = '';
                        foreach ($model->display_data as $vv){
                            $str .= $vv."\n\r";
                        }
                        return $str;
                    } else {
                        return '';
                    }
                },
            ],
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ]);
    ?>
</div>