<?php
use yii\widgets\DetailView;
use backend\assets\LayuiAsset;
use rbac\models\Rule;

LayuiAsset::register($this);
?>
<div class="menu-view">
    <?=DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'layui-table'],
        'attributes' => [
            'name',
            'desc',
            'order',
            [
                "attribute" => "purview",
                "format" => "html",
                "value" => function($model) {
                    $rule_list = Rule::getTree();
                    $html = '<ul class="group_resource">';
                    foreach ($rule_list as $v){
                        $html .= '<li>';
                        $sign = in_array($v['id'], $model->purview)? "fa fa-check":"fa fa-minus-circle";
                        $html .= '<label style="font-weight: normal"><span style="margin-right: 3px" class="'.$sign.'"></span><span>'.$v['name'].'</span></label>';
                        if (!empty($v['child']) && is_array($v['child'])){
                            $html .= '<ul class="group_resource" style="margin-left: 20px">';
                            foreach ($v['child'] as $vv){
                                $html .= '<li>';
                                $sign = in_array($vv['id'], $model->purview)? "fa fa-check":"fa fa-minus-circle";
                                $html .= '<label style="font-weight: normal"><span style="margin-right: 3px" class="'.$sign.'"></span><span>'.$vv['name'].'</span></label>';
                                if (!empty($vv['child']) && is_array($vv['child'])){
                                    $html .= '<ul class="group_resource" style="margin-left: 20px">';
                                    foreach ($vv['child'] as $vvv){
                                        $html .= '<li>';
                                        $sign = in_array($vvv['id'], $model->purview)? "fa fa-check":"fa fa-minus-circle";
                                        $html .= '<label style="font-weight: normal"><span style="margin-right: 3px" class="'.$sign.'"></span><span>'.$vvv['name'].'</span></label>';
                                        if (!empty($vvv['child']) && is_array($vvv['child'])){
                                            $html .= '<ul class="group_resource" style="margin-left: 20px">';
                                            foreach ($vvv['child'] as $vvvv){
                                                $html .= '<li>';
                                                $sign = in_array($vvvv['id'], $model->purview)? "fa fa-check":"fa fa-minus-circle";
                                                $html .= '<label style="font-weight: normal"><span style="margin-right: 3px" class="'.$sign.'"></span><span>'.$vvvv['name'].'</span></label>';
                                                $html .= '</li>';
                                            }
                                            $html .= '</ul>';
                                        }
                                        $html .= '</li>';
                                    }
                                    $html .= '</ul>';
                                }
                                $html .= '</li>';
                            }
                            $html .= '</ul>';
                        }
                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                    return $html;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime'
        ],
        'template' => '<tr><th width="100px">{label}</th><td>{value}</td></tr>',
    ])
    ?>
</div>