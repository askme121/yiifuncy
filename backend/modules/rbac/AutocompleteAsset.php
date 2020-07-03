<?php

namespace rbac;

use yii\web\AssetBundle;

class AutocompleteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@rbac/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'jquery-ui.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'jquery-ui.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
