<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="category-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>