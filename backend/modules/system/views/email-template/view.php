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
            'scene',
            'title',
            'content:html',
            'created_at:datetime'
        ],
    ]) ?>
</div>