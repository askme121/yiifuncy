<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\Attribute;

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
                "attribute" => "attr_ids",
                "value" => function($model) {
                    if ($model->attr_ids){
                        $str = '';
                        foreach ($model->attr_ids as $vv){
                            $str .= Attribute::findOne(['id'=>$vv])->name."\n\r";
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