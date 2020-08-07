<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <div class="tabbable">
            <div class="account-menu-container">
                <h4 class="menu_title">FAQ</h4>
                <ul class="nav nav-pills account-menu-list" id="divstyletab">
                    <?php if ($model){?>
                        <?php foreach ($top_all as $product): ?>
                    <li class="active">
                        <a href="#pre-sale" class="account-menu-a" data-toggle="tab">Pre-sale Service</a>
                    </li>
                    <?php }?>
                    <li>
                        <a href="#refund-return" class="account-menu-a" data-toggle="tab">Refund &amp; Return</a>
                    </li>
                    <li>
                        <a href="#privacy-acc" class="account-menu-a" data-toggle="tab">Privacy &amp; Account</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content account-content-container tab-content-container">
                <div class="tab-pane fade active in" id="pre-sale">

                </div>
                <div class="tab-pane fade" id="refund-return">

                </div>
                <div class="tab-pane fade" id="privacy-acc">

                </div>
            </div>
        </div>
    </div>
</div>
