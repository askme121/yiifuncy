<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayuiAsset;
use yii\grid\GridView;
use common\models\Activity;
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
        background: #d2d2d2;
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
                'attribute' => 'id',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => [
                    'width' => '50px',
                    'style'=> 'text-align: center;'
                ],
            ],
            [
                'attribute' => 'product.thumb_image',
                'contentOptions' => ['style'=> 'text-align: center;width: 80px'],
                'headerOptions' => ['style'=> 'text-align: center;width: 80px'],
                "format"=>[
                    "image",
                    [
                        "width" => "80px",
                        "class" => 'thumb',
                    ],
                ],
            ],
            [
                'attribute' => 'product.name',
                'headerOptions' => ['style'=> 'text-align: center;width: 200px;'],
                'contentOptions' => ['style'=> 'text-align: left;width: 200px;white-space: inherit;overflow: hidden;text-overflow: ellipsis;'],
                'format' => 'raw',
                'value' => function($model){
                    if (Yii::$app->user->identity->role_id != 3) {
                        $url = getSiteUrl($model->site_id).'/offer/'.$model->url_key.'/'.$model->id;
                        return Html::a($model->product->name, $url, ['target' => '_blank']);
                    } else {
                        return $model->product->name;
                    }
                }
            ],
            [
                'attribute' => 'product.sku',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: left;'],
            ],
            [
                'attribute' => 'type',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "value" => function($model) {
                    if ($model->type == 0)
                    {
                        return Yii::t('app', 'undefined');
                    }
                    $activity_type = ActivityType::formatList();
                    foreach ($activity_type as $k=>$v){
                        if ($model->type == $k){
                            return $v;
                        }
                    }
                    return Yii::t('app', 'unkown');
                },
            ],
            [
                'attribute' => 'qty',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;'],
            ],
            [
                'attribute' => 'start',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;'],
                'format' => 'datetime'
            ],
            [
                'attribute' => 'end',
                'headerOptions' => ['style'=> 'text-align: center;'],
                'contentOptions' => ['style'=> 'text-align: center;'],
                'format' => 'datetime'
            ],
            [
                'attribute' => 'price',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                'format' => 'html',
                'value' => function($model) {
                    $str = getSymbol().' '.floatval($model->price);
                    if ($model->cashback){
                        $str .= "<br>返现金额：".getSymbol().' '.floatval($model->cashback);
                    }
                    if ($model->coupon_type == 1){
                        $str .= "<br>折扣：".floatval($model->coupon).'%';
                    } else if ($model->coupon_type == 2){
                        $str .= "<br>折扣：".getSymbol().' '.floatval($model->coupon);
                    }
                    return $str;
                },
            ],
            [
                'attribute' => 'status',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                "value" => function($model) {
                    switch ($model->status)
                    {
                        case 0:
                            return '未启用';
                            break;
                        case 1:
                            $time = time();
                            if ($model->start <= $time && $model->end >= $time){
                                return '生效中';
                            } else if ($model->start > $time){
                                return '待生效';
                            } else {
                                return '已过期';
                            }
                            break;
                        case 2:
                            return '已取消';
                            break;
                        default:
                            return Yii::t('app', 'unkown');
                            break;
                    }
                },
            ],
            [
                'attribute' => 'is_hot',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->is_hot == 1) {
                        return '<span class="yes" onclick="changeTableVal(\'activity\',\'id\','.$model->id.',\'is_hot\',this)"><i class="fa fa-check-circle"></i>YES</span>';
                    } else {
                        return '<span class="no" onclick="changeTableVal(\'activity\',\'id\','.$model->id.',\'is_hot\',this)"><i class="fa fa-ban"></i>NO</span>';
                    }
                }
            ],
            [
                'attribute' => 'order',
                'contentOptions' => ['style'=> 'text-align: center;'],
                'headerOptions' => ['style'=> 'text-align: center;'],
                'format' => 'raw',
                'value' => function($model) {
                    return '<input type="text" class="my-input" onkeyup="this.value=this.value.replace(/[^\d]/g,\'\')" onpaste="this.value=this.value.replace(/[^\d]/g,\'\')" onblur="changeTableVal(\'activity\',\'id\','.$model->id.',\'order\',this)" size="4" value="'.$model->order.'">';
                }
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
                                     {tag}
                                     {copy}
                                     {del}
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
                    'copy' => function ($url, $model, $key){
                        if ($model->status != 1 || ($model->status == 1 && $model->end < time())) {
                            return '<dd>'.Html::a('复制', Url::to(['copy','id'=>$model->id]), ['class' => "layui-default-copy"]).'</dd>';
                        } else {
                            return '';
                        }
                    },
                    'activate' => function ($url, $model, $key) {
                        if (Yii::$app->user->identity->role_id == 1 && $model->status == 0) {
                            return '<li class="nav-myself-li">'.Html::a('启用', Url::to(['active','id'=>$model->id]), ['class' => "layui-default-active"]).'</li>';
                        }else{
                            return '';
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('取消', Url::to(['delete','id'=>$model->id]), ['class' => "layui-default-delete"]);
                    },
                    'del' => function ($url, $model, $key) {
                        if (Yii::$app->user->identity->role_id == 1 && $model->status == Activity::STATUS_CANCEL) {
                            return '<dd>'.Html::a('删除', Url::to(['del','id'=>$model->id]), ['class' => "layui-default-del"]).'</dd>';
                        } else {
                            return '';
                        }
                    },
                    'tag' => function ($url, $model, $key) {
                        if ((Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->team_id == $model->team_id) && $model->status == Activity::STATUS_ENABLE && ($model->start <= time() && $model->end >= time())) {
                            return '<dd>'.Html::a('推广', Url::to(['tag','id'=>$model->id]), ['class' => "layui-default-tag"]).'</dd>';
                        } else {
                            return '';
                        }
                    }
                ]
            ],
        ],
    ]); ?>
</div>