<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="menu-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>