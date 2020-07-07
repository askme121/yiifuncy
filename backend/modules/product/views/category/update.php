<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="category-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>