<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="config-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>