<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="config-view">
    <?= DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'name',
            'title',
            'value:ntext',
            'remark',
            'created_at:datetime',
            'updated_at:datetime',
            'order',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return $model->status==0?'<font color="red">系统内置参数</font>':'用户定义参数';
                },
            ],
        ],
    ]) ?>
</div>
