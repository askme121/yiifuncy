<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use common\models\UserRank;

LayuiAsset::register($this);
?>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
		'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'username',
			'firstname',
            'lastname',
            [
                "attribute"=>"head_pic",
                "format"=>[
                    "image",
                    [
                        "width"=>"100px",
                        "height"=>"100px",
						"class" => "layui-circle"
                    ],
                ],
            ],
            'email:email',
            [
				'attribute' => 'status',
				'value' => function($model){
					return $model->status == 0 ? '禁用' : '启用';
				}
			],
			[
				'attribute' => 'r_id',
				'value' => function($model){
					return UserRank::findOne($model->r_id)->name;
				}
			],
            [
                "attribute"=>"created_at",
                "value"=>function($data){
                    return date("Y-m-d H:i:s",$data->created_at);
                }
            ],
            [
                "attribute"=>"last_login_date",
                "value"=>function($data){
                    return isset($data->last_login_date)?date("Y-m-d H:i:s",$data->last_login_date):"";
                }
            ],
        ],
		'template' => '<tr><th width="90px;">{label}</th><td>{value}</td></tr>', 
    ]) ?>

</div>
