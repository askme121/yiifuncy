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
            <ul id="deal-detal-tab" class="nav nav-tabs">
                <li role="presentation" id="tab-inbox" class="in active">
                    <a href="#inbox" data-toggle="tab">Inbox</a>
                </li>
                <li role="presentation" id="tab-sent">
                    <a href="#sent" data-toggle="tab">Sent items</a>
                </li>
            </ul>
            <div id="account-tab-content" class="tab-content">
                <div class="tab-pane fade in active" id="inbox">
                    inbox
                </div>
                <div class="tab-pane fade" id="sent">
                    sent items
                </div>
            </div>
        </div>
    </div>
</div>