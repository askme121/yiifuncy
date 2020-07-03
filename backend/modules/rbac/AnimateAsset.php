<?php

namespace rbac;

use yii\web\AssetBundle;

class AnimateAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@rbac/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'animate.css',
    ];

}
