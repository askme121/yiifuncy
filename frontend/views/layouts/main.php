<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\models\Config;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Config::getConfig('ga_code', Yii::$app->params['site_id'])?>
    <?= Config::getConfig('fb_code', Yii::$app->params['site_id'])?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('../public/header.php') ?>
<?= $content ?>
<?= $this->render('../public/footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
