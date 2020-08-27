<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;

LayuiAsset::register($this);
$this->registerJs($this->render('js/index.js'));
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="user-index layui-form news_list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
        'tableOptions'=> ['class'=>'layui-table'],
        'pager' => [
            'options'=>['class'=>'layuipage pull-right'],
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'firstPageLabel'=>'首页',
            'lastPageLabel'=>'尾页',
            'maxButtonCount'=>5,
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => [
                    'width' => '50px',
                    'style'=> 'text-align: center;'
                ],
            ],
            'ip',
            [
                'attribute' => 'url',
                'headerOptions' => ['style'=> 'text-align: center; width: 200px;'],
                'contentOptions' => ['style'=> 'text-align: left; width: 200px;white-space: inherit;overflow: hidden;text-overflow: ellipsis;'],
            ],
            'event_name',
            'event_type',
            'country_code',
            'country_name',
            'state_name',
            'city_name',
            'device',
            'browser',
            'operate',
            [
                'attribute' => 'refer_url',
                'headerOptions' => ['style'=> 'text-align: center; width: 200px;'],
                'contentOptions' => ['style'=> 'text-align: left; width: 200px;white-space: inherit;overflow: hidden;text-overflow: ellipsis;'],
            ],
            'tag',
            'sign',
            'created_at:datetime',
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'width' => '10%',
                    'style'=> 'text-align: center;'
                ],
                'template' =>'{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                        return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>