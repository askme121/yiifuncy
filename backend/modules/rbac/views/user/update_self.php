<?php
use backend\assets\LayuiAsset;
LayuiAsset::register($this);
$this->registerJs($this->render('js/create.js'));
?>
<div class="user-update">
    <?= $this->render('_form_self', [
        'model' => $model,
    ]) ?>
</div>
