<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;
use common\models\Category;

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
                'class' => 'backend\widgets\CheckboxColumn',
                'checkboxOptions' => ['lay-skin'=>'primary','lay-filter'=>'choose'],
                'headerOptions' => ['width'=>'50','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;']
            ],
            [
                'attribute' => 'thumb_image',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "format"=>[
                    "image",
                    [
                        "width"=>"50px",
                    ],
                ],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['width'=>'10%','style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;']
            ],
            [
                'attribute' => 'url_key',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['width'=>'15%','style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'sku',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['width'=>'15%','style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'category_id',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "value" => function($model) {
                    if ($model->category_id == 0)
                    {
                        return Yii::t('app', 'undefined');
                    }
                    $category_parent = Category::formatTree();
                    foreach ($category_parent as $k=>$v){
                        if ($model->category_id == $k){
                            return $v;
                        }
                    }
                    return Yii::t('app', 'unkown');
                },
            ],
            [
                'attribute' => 'status',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 1:
                            return '激活';
                            break;
                        case 2:
                            return '关闭';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'width' => '10%',
                    'style'=> 'text-align: center;'
                ],
                'template' =>'{view} {update} {activate} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                        return Html::a('查看', Url::to(['view','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', Url::to(['update','id'=>$model->id]), ['class' => "layui-btn layui-btn-normal layui-btn-xs layui-default-update"]);
                    },
                    'activate' => function ($url, $model, $key) {
                        if($model->status == 2){
                            return Html::a('激活', Url::to(['active','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-btn-normal layui-default-active"]);
                        }else{
                            return Html::a('关闭', Url::to(['inactive','id'=>$model->id]), ['class' => "layui-btn layui-btn-xs layui-btn-warm layui-default-inactive"]);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', Url::to(['delete','id'=>$model->id]), ['class' => "layui-btn layui-btn-danger layui-btn-xs layui-default-delete"]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
