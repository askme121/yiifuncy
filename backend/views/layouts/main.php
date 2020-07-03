<?php
use backend\assets\AppAsset;
use backend\assets\LayuiAsset;

$action_list = [
    'site/login'
];

if (in_array(Yii::$app->controller->id . '/' . Yii::$app->controller->action->id, $action_list)) {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
}else{
    $bootstrp_list = [
        'site/index',
        'tools/ico'
    ];
    //只需要在首页的时候加载某些资源
    if(in_array(Yii::$app->controller->id . '/' . Yii::$app->controller->action->id, $bootstrp_list)){
        LayuiAsset::register($this);
        LayuiAsset::addScript($this, "@web/resources/js/index.js");
    }else{
        AppAsset::register($this);
    }
    echo $this->render(
        'main-index',
        ['content' => $content]
    );
}