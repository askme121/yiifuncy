<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="article-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>