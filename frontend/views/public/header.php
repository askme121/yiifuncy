<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<header id="header" class="hidden-lg hidden-md">
    <div>
        <?php if (Yii::$app->user->isGuest) {?>
            <a href="<?= Url::toRoute('/site/login');?>" class="user-icon-container" style="margin-left:14px;">
                <img src="<?= getImgUrl('images/user-icon-phone.png') ?>" style="height: 23px;margin-top: 16px;">
                <span class="info-circel" style="display:none;"></span>
            </a>
        <?php } else {?>
            <a href="<?= Url::toRoute('/user/index');?>" class="user-icon-container" style="margin-left:14px;">
                <img src="<?= getImgUrl('images/user-icon-phone.png') ?>" style="height: 23px;margin-top: 16px;">
                <span class="info-circel" style="display:none;"></span>
            </a>
        <?php }?>
    </div>
    <a href="<?= Url::home()?>" class="nav-logo-container">
        <img class="nav-logo-icon" src="<?= getImgUrl('images/mylogo.png') ?>">
    </a>
    <div>
        <?php if (!Yii::$app->user->isGuest) {?>
        <a href="<?= Url::toRoute('/user/message')?>" class="nav-msg-container">
            <span class="nav-msg-icon">
                <img src="<?= getImgUrl('images/nav-news.png'); ?>">
            </span>
            <span class="message-count">0</span>
        </a>
        <?php }?>
    </div>
</header>
<header id="pc_header" class="hidden-sm hidden-xs">
    <nav class="navbar navbar-static-top main-navbar">
        <div class="container" style="padding: 0; margin: 0 auto">
            <nav class="navbar-collapse collapse" id="bs-navbar" aria-expanded="false">
                <div class="navbar-header">
                    <div id="logo" style="background: url(<?= getImgUrl('images/mylogo.png'); ?>) no-repeat center center; background-size: contain;">
                        <h1 class="logo-keyword">
                            <a href="<?= Url::home()?>">Deals on Amazon</a>
                        </h1>
                    </div>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= Url::toRoute('/product');?>" target="_self">All Deals</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/product/coupon&cashback');?>" target="_self">Coupon + Cashback</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/product/cashback');?>">Cashback Deals</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/product/coupon');?>" target="_self">Coupon Deals</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/site/faq');?>" target="_self">FAQ</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/site/contact');?>" target="_self">Contacts</a>
                    </li>
                    <li style="float: right;overflow: hidden;">

                    </li>
                </ul>
                <?php if (Yii::$app->user->isGuest) {?>
                    <ul class="nav navbar-nav navbar-right cbb-check-login" style="padding-right: 0;">
                        <li style="float: right; margin-left: 20px;">
                            <a class="btn btn-sm btn-w-m join-for-free" style="background-color: white; color: #f93 !important; height: 36px; line-height: 2.5; margin-top: 18px; padding-left: 8px !important; padding-right: 8px !important;" href="<?= Url::toRoute('/site/signup');?>">Join for free</a>
                        </li>
                        <li style="float: right;">
                            <a class="register-login-a" href="<?= Url::toRoute('/site/login');?>" target="_self" style="padding: 0 !important;">Login</a>
                        </li>
                    </ul>
                <?php } else {?>
                    <ul class="nav navbar-nav navbar-right cbb-check-login" style="padding-right: 0;">
                        <li class="dropdown right-nav" id="account-nav" style="float: right;">
                            <a href="" class="dropdown-toggle" style="padding: 0 !important;">
                                <img class="nav-user-img" src="<?= getImgUrl('images/user.png'); ?>">
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="account-dropdown-menu" style="width: 200px;">
                                <li class="caret-bottom">
                                    <span></span>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/order/index')?>">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/my-deal.png'); ?>"> Refund Deals
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/order/coupon')?>">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/my-deal.png'); ?>"> Coupon Deals
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/user/profile')?>">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/account-profile.png'); ?>"> Account & Profile
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <?=
                                    Html::beginForm(['/site/logout'], 'post').
                                    Html::submitButton(
                                        '<img class="nav-dropdown-icon" src="'.getImgUrl('images/sign-out.png').'"> Sign Out',
                                        ['class' => 'btn btn-link logout']
                                    ).
                                    Html::endForm();
                                    ?>
                                </li>
                            </ul>
                        </li>
                        <li id="news-nav" class="right-nav" style="float: right;">
                            <a href="<?= Url::toRoute('/user/message')?>" class="dropdown-toggle">
                                <img src="<?= getImgUrl('images/nav-news.png'); ?>" style="width: 80%;">
                            </a>
                            <div class="message-count" data-count="2">
                                0
                            </div>
                            <ul class="dropdown-menu nav-news-entry" id="nav-news-entry">
                                <li class="caret-bottom news-caret">
                                    <span></span>
                                </li>
                                <li class="new-entry">
                                    <a href="" style="background-color: #fff">
                                        <div class="news-content-container">
                                            <div class="new-content" title="Earn 30 points by completing daily check-in.">Earn 30 points by completing daily check-in.</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="news-cross"></li>
                                <li class="new-entry">
                                    <a href="">
                                        <div class="news-content-container">
                                            <div class="new-content" title="Earn 30 points by completing daily check-in.">Earn 30 points by completing daily check-in.</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="news-cross"></li>
                            </ul>
                        </li>
                    </ul>
                <?php }?>
            </nav>
        </div>
    </nav>
</header>
