<?php
use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<div class="contact-update">
    <?=
    $this->render('_form', [
        'model' => $model,
        'msg' => $msg
    ])
    ?>
</div>