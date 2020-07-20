<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;
use common\models\ActivityType;

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
        border: 1px solid #d2d2d2;
        border-radius: 2px;
        padding: 5px 15px;
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
        margin: 5px auto;
    }
    .nav-myself-dl dd a{
        color: #333;
    }
</style>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="user-index layui-form news_list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view', 'style' => 'overflow:auto; padding-bottom:90px', 'id' => 'grid'],
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
            [
                'attribute' => 'product_sku',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'coupon_code',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'status',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 0:
                            return 'init';
                            break;
                        case 1:
                            return 'fetched';
                            break;
                        case 2:
                            return 'used';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            'customer_id',
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'width' => '10%',
                    'style'=> 'text-align: center;'
                ],
                'template' => '<ul class="nav-myself-ul">
                             <li class="nav-myself-li">
                                 <a href="javascript:;">管理<span class="layui-nav-mored"></span></a>
                                 <dl class="nav-myself-dl">
                                     <dd>{view}</dd>
                                     {update}
                                     <dd>{delete}</dd>
                                 </dl>
                             </li>
                             {activate}
                          </ul>',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                        return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-default-view"]);
                    },
                    'update' => function ($url, $model, $key) {
                        if ($model->status == 0) {
                            return '<dd>'.Html::a('编辑', Url::to(['update','id'=>$model->id]), ['class' => "layui-default-update"]).'</dd>';
                        } else {
                            return '';
                        }
                    },
                    'activate' => function ($url, $model, $key) {
                        if ($model->status == 0) {
                            return '<li class="nav-myself-li">'.Html::a('启用', Url::to(['active','id'=>$model->id]), ['class' => "layui-default-active"]).'</li>';
                        }else{
                            return '';
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('取消', Url::to(['delete','id'=>$model->id]), ['class' => "layui-default-delete"]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>