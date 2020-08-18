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
                <button type="button" class=""><i class="fa fa-reply"></i>Reply</button>
            </div>
        </div>
    </div>
</div>