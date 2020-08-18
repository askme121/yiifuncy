<?php
use yii\helpers\Url;
?>
<div class="account-menu-container visible-lg visible-md">
    <a href="<?= Url::toRoute('/user/profile')?>"><img class="user-photo" src="<?= getImgUrl('images/user.png') ?>">
    </a>
    <div class="user-email"><?= Yii::$app->user->identity->username?></div>
    <!--<div class="point-mess-container">
        <div class="point-container">
            <a href="/account/mypoints">
                <img src="<?= getImgUrl('images/points.png') ?>">
                <span class="point-amount" id="point-amount">2,000</span>
            </a>
        </div>
        <div class="news-container">
            <a href="/account/notify">
                <img src="<?= getImgUrl('images/news.png') ?>">
                <div class="news-amount">6</div>
            </a>
        </div>
    </div>-->
    <div class="cross-line"></div>
    <ul class="account-menu-list">
        <li>
            <a class="account-menu-a <?php if (isset($current) && $current == 'refund'){?>active<?php }?>" href="<?= Url::toRoute('/order/index')?>">Refund Deals</a>
        </li>
        <li>
            <a class="account-menu-a <?php if (isset($current) && $current == 'coupon'){?>active<?php }?>" href="<?= Url::toRoute('/order/coupon')?>">Coupon Deals</a>
        </li>
        <li>
            <a class="account-menu-a <?php if (isset($current) && $current == 'message'){?>active<?php }?>" href="<?= Url::toRoute('/user/message')?>">Message Center</a>
        </li>
        <li>
            <a class="account-menu-a <?php if (isset($current) && $current == 'profile'){?>active<?php }?>" href="<?= Url::toRoute('/user/profile')?>">Account &amp; Profile</a>
        </li>
    </ul>
</div>
