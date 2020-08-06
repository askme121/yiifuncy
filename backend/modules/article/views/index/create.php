<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="article-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>