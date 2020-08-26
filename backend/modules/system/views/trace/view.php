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
            'ip',
            'url',
            'country_code',
            'country_name',
            'state_name',
            'city_name',
            'device',
            'user_agent',
            'browser',
            'browser_version',
            'browser_date',
            'browser_lang',
            'operate',
            'operate_relase',
            'refer_url',
            'first_referrer_url',
            [
                'attribute' => 'is_new',
                'value' => function($model) {
                    return $model->is_new == 1? '是':'否';
                }
            ],
            [
                'attribute' => 'first_page',
                'value' => function($model) {
                    return $model->first_page == 1? '是':'否';
                }
            ],
            'device_pixel_ratio',
            'resolution',
            'color_depth',
            'channel',
            'tag',
            'sign',
            'times',
            'created_at:datetime',
        ],
    ]) ?>
</div>