<?php
use yii\helpers\Url;
?>
<header id="header" class="hidden-lg hidden-md">
    <div>
        <a href="" class="user-icon-container" style="margin-left:14px;">
            <img src="<?= getImgUrl('images/user-icon-phone.png') ?>" style="height: 23px;margin-top: 16px;">
            <span class="info-circel" style="display:none;"></span>
        </a>
    </div>
    <a href="" class="nav-logo-container">
        <img class="nav-logo-icon" src="<?= getImgUrl('images/logo.png') ?>" style="width: 120px;">
    </a>
    <div>
        <a href="#" class="nav-msg-container">
            <span class="nav-msg-icon glyphicon glyphicon-bell"></span>
            <span class="message-count">3</span>
        </a>
    </div>
</header>
<header id="pc_header" class="hidden-sm hidden-xs">
    <nav class="navbar navbar-static-top main-navbar">
        <div class="container" style="padding: 0; margin: 0 auto">
            <nav class="navbar-collapse collapse" id="bs-navbar" aria-expanded="false">
                <div class="navbar-header">
                    <div id="logo" style="background: url(<?= getImgUrl('images/logo.png'); ?>) no-repeat center center; background-size: contain;">
                        <h1 class="logo-keyword">
                            <a href="#">Deals on Amazon</a>
                        </h1>
                    </div>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="" target="_self">All Deals</a>
                    </li>
                    <li>
                        <a href="" target="_self">Cashback Deals</a>
                    </li>
                    <li>
                        <a href="" target="_self">Coupon Deals</a>
                    </li>
                    <li>
                        <a href="" target="_self">Coupon + Cashback</a>
                    </li>
                    <li>
                        <a href="" target="_self">faq</a>
                    </li>
                    <li>
                        <a href="" target="_self">Contacts</a>
                    </li>
                    <li style="float: right;overflow: hidden;">

                    </li>
                </ul>
                <?php if (!Yii::$app->user->isGuest) {?>
                    <ul class="nav navbar-nav navbar-right cbb-check-login" style="padding-right: 0;">
                        <li style="float: right; margin-left: 20px;">
                            <a class="btn btn-sm btn-w-m join-for-free" style="background-color: white; color: #f93; height: 36px; line-height: 2.5; margin-top: 18px; padding-left: 8px !important; padding-right: 8px !important;" href="">Join for free</a>
                        </li>
                        <li style="float: right;">
                            <a class="register-login-a" href="" target="_self" style="padding: 0 !important;">Login</a>
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
                                    <a href="">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/my-deal.png'); ?>"> Refund Deals
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/my-deal.png'); ?>"> Coupon Deals
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/my-wishlist.png'); ?>"> My Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/account-profile.png'); ?>"> Account & Profile
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="<?= Url::to('/site/logout');?>" target="_self">
                                        <img class="nav-dropdown-icon" src="<?= getImgUrl('images/sign-out.png'); ?>"> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="news-nav" class="right-nav" style="float: right;">
                            <a href="" class="dropdown-toggle">
                                <img src="<?= getImgUrl('images/nav-news.png'); ?>" style="width: 80%;">
                            </a>
                            <div class="message-count" data-count="2">
                                0
                            </div>
                            <ul class="dropdown-menu nav-news-entry" id="nav-news-entry">
                                <li class="caret-bottom news-caret">
                                    <span></span>
                                </li>
                                <li class="no-news">
                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #FF9933;"></span> There are no new messages yet!
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php }?>
            </nav>
        </div>
    </nav>
</header>
