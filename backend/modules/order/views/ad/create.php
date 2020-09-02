<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="product-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>