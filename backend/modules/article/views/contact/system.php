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
        width: 130px;
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
        padding: 5px 15px;
        border: 1px solid #d2d2d2;
        background: #d2d2d2;
    }
    .nav-myself-dl dd a{
        color: #666;
    }
</style>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
    <?php  echo $this->render('_system', ['model' => $searchModel]); ?>
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
                'headerOptions' => ['width'=>'10%','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: left;']
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: left;'],
            ],
            [
                'attribute' => 'email',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'status',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                'value' => function($model){
                    switch ($model->status)
                    {
                        case 0:
                            return '未读';
                            break;
                        case 1:
                            return '已读';
                            break;
                        case 2:
                            return '已回复';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                'format' => 'datetime'
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
                             </li>
                          </ul>',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                        return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-default-view"]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>