<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use rbac\models\Role;

LayuiAsset::register($this);
?>
<div class="user-view">
    <?=DetailView::widget([
        'model' => $model,
		'options' => ['class' => 'layui-table'],
        'attributes' => [
            'username',
			'nickname',
            [
                "attribute"=>"role_id",
                'format' => 'html',
                'value' => function($model) {
                    $role_list = Role::getList();
                    foreach ($role_list as $v){
                        if ($model->role_id == $v['id']){
                            return $v['name'];
                        }
                    }
                    return '未知';
                },
            ],
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
            'created_at:date',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return $model->status==0?'<font color="red">禁用</font>':'<font color="green">启用</font>';
                },
            ],
        ],
		'template' => '<tr><th width="90px;">{label}</th><td>{value}</td></tr>', 
    ])
    ?>

</div>
