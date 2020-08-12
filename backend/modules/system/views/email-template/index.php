<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;

LayuiAsset::register($this);
$this->registerJs($this->render('js/index.js'));
?>
<style type="text/css">
    .layui-input-inline{
        max-width: 150px;
    }
    .nav-myself-ul{
        width: 100px;
        color: #666;
        list-style: none;
    }
    .nav-myself-li{
        float: left;
        padding: 5px 8px;
        position: relative;
    }
    .nav-myself-dl{
        display: none;
        position: absolute;
        top:30px;
        border-radius: 2px;
        box-shadow: 0 2px 4px rgba(0,0,0,.12);
        z-index: 9999;
    }
    .nav-myself-li:hover .nav-myself-dl{
        display: block;
    }
    .nav-myself-li a{
        color: #666;
        text-decoration: none;
    }
    .nav-myself-dl dd{
        border: 1px solid #d2d2d2;
        padding: 5px 15px;
        background: #d2d2d2;
    }
    .nav-myself-dl dd a{
        color: #666;
    }
</style>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="user-index layui-form news_list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view','style'=>'overflow:auto; padding-bottom:90px', 'id' => 'grid'],
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
                'class' => 'backend\widgets\CheckboxColumn',
                'checkboxOptions' => ['lay-skin'=>'primary','lay-filter'=>'choose'],
                'headerOptions' => ['width'=>'50','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;']
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['width'=>'100','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: left;']
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['width'=>'100','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: left;']
            ],
            [
                'attribute' => 'scene',
                'headerOptions' => ['width'=>'100','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;']
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s", $model->created_at);
                },
                'headerOptions' => [
                    'width' => '10%'
                ]
            ],
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'width' => '10%',
                    'style'=> 'text-align: center;'
                ],
                'template' =>'<ul class="nav-myself-ul">
                             <li class="nav-myself-li">
                                 {view}
                                 <dl class="nav-myself-dl">
                                     {update}
                                     <dd>{delete}</dd>
                                 </dl>
                             </li>
                          </ul>',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                        return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-default-view"]);
                    },
                    'update' => function ($url, $model, $key) {
                        return '<dd>'.Html::a('编辑', Url::to(['update','id'=>$model->id]), ['class' => "layui-default-update"]).'</dd>';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Url::to(['delete','id'=>$model->id]), ['class' => "layui-default-delete"]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>