<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\LayuiAsset;

LayuiAsset::register($this); 
$this->registerJs($this->render('js/index.js'));
?>
<blockquote class="layui-elem-quote" style="font-size: 14px;">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</blockquote>
<div class="role-index">
    <?=GridView::widget([
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
            'name',
            'rule_name',
            'route',
            [
                'attribute' => 'parent',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'style'=> 'text-align: center;'
                ],
                "value" => function($model) {
                    if ($model->parent == 0)
                    {
                        return '根';
                    }
                    $rule_parent = $model::formatTree();
                    foreach ($rule_parent as $k=>$v){
                        if ($model->parent == $k){
                            return $v;
                        }
                    }
                    return '未知';
                },
            ],
            [
                'attribute' => 'type',
                'contentOptions' => ['class'=>'text-center'],
                'headerOptions' => [
                    'style'=> 'text-align: center;'
                ],
                'value' => function($model) {
                    switch ($model->type)
                    {
                        case 1:
                            return '栏目';
                            break;
                        case 2:
                            return '菜单';
                            break;
                        case 3:
                            return '按钮';
                            break;
                        default:
                            return '未知';
                            break;
                    }
                },
            ],
            'order',
            [
				'header' => '操作',
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'headerOptions' => [
					'width' => '10%',
					'style'=> 'text-align: center;'
				],
				'template' =>'{view} {update} {delete}',
				'buttons' => [
                    'view' => function ($url){
						return Html::a('查看', $url, ['class' => "layui-btn layui-btn-xs layui-default-view"]);
                    },
                    'update' => function ($url) {
						return Html::a('修改', $url, ['class' => "layui-btn layui-btn-normal layui-btn-xs layui-default-update"]);
                    },
					'delete' => function ($url) {
						return Html::a('删除', $url, ['class' => "layui-btn layui-btn-danger layui-btn-xs layui-default-delete"]);
					}
				]
			],
        ],
    ]);
    ?>
</div>
