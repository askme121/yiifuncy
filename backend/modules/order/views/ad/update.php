<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="product-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>