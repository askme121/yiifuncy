<?php
use yii\helpers\Html;
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
            'rule_name',
            'route',
            [
                "attribute" => "parent",
                "value" => function($model) {
                    if ($model->parent == 0)
                    {
                        return '根';
                    }
                    $rule_parent = $model::formatTree();
                    foreach ($rule_parent as $k=>$v){
                        if ($model->parent == $k){
                            return $v;
                        }
                    }
                    return '未知';
                },
            ],
            [
                "attribute" => "type",
                "value" => function($model) {
                    switch ($model->type)
                    {
                        case 1:
                            return '栏目';
                            break;
                        case 2:
                            return '菜单';
                            break;
                        case 3:
                            return '按钮';
                            break;
                        default:
                            return '未知';
                            break;
                    }
                },
            ],
            'order',
        ],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
    ]);
    ?>
</div>
