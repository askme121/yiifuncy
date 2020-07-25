<?php
use yii\helpers\Url;
?>
<div class="top-nav-container visible-xs-block visible-sm-block hidden-lg hidden-md">
    <div>
        <nav class="mydeal-nav-brand">
            <div class="deal-content-nav index-nav-ul">
                <a href="<?= Url::toRoute('/product');?>" class="deal-nav-a">
                    All Deals
                </a>
                <a href="<?= Url::toRoute('/product/coupon&cashback');?>" class="deal-nav-a">
                    Coupon & Cashback
                </a>
                <a href="<?= Url::toRoute('/product/cashback');?>" class="deal-nav-a">
                    Cashback Deals
                </a>
                <a href="<?= Url::toRoute('/product/coupon');?>" class="deal-nav-a">
                    Coupon Deals
                </a>
            </div>
        </nav>
    </div>
</div>