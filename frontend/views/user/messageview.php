<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <?= $this->render('../public/userleftbar.php', ['current'=>$current]) ?>
        <div class="account-content-container">
            <div class="header-line visible-sm visible-xs">
                <a href="javascript:history.back()" class="header-line-back">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <h1 class="header-line-page">Message Center</h1>
            </div>
            <div class="msg_cover">
                Messages
            </div>
            <div class="msg_body">
                <h5 class="msg_title"><?= $model->title?></h5>
                <div class="msg_desc">
                    <?= $model->content?>
                </div>
            </div>
            <div class="msg_foot">
                <a href="javascript:history.back()">back >></a>
                <?php if ($model->type == 2 && $model->status != 2) {?>
                <button type="button" id="reply_btn" data-id="<?= $model->id?>" data-toggle="modal" data-target=".operation-upmsg"><i class="fa fa-reply"></i>Reply</button>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('../public/upmsg'); ?>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(document).ready(function(){
        var params = getTrace();
        if (window.requestIdleCallback) {
            requestIdleCallback(function () {
                fpid(params);
            });
        } else {
            setTimeout(function () {
                fpid(params);
            }, 500);
        }
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
