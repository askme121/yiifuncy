<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<section class="aboutus-banner" style="background:url(<?= getImgUrl('images/about_bg.png') ?>) no-repeat">
    <div class="container">
        <div class="about-info">
            <p class="log-title">CASHBACKCLUB</p>
            <h1 class="aboutus-title">
                SECURELY SHOPPING WITH CASHBACK
            </h1>
            <div class="aboutus-content">
                <?= $model->content?>
            </div>
            <div class="about-join">
                <p class="text-center" style="margin-top: 40px; margin-bottom: 20px">
                    <a href="<?= Url::toRoute('/site/signup');?>" class="join-btn about-btn">Sign Up Free</a>
                </p>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="about-panel">
        <p class="our-mission">
            <span class="septal-row"></span>
            <span style="margin: 0 24px; color: #f93; font-weight: bold">Our Mission</span>
            <span class="septal-row"></span>
        </p>
        <div class="our-mission-entry">
            <img src="<?= getImgUrl('images/SaveTime_Money.png') ?>">
            <p class="mission-title">Save Your Time &amp; Money</p>
            <p class="mission-content">
                We often share our exciting newly discovered products or ideas on our website, which helps users save time when catching up on trends. At the same time, we offer numerous trial opportunities or discounts on products to help them save the wallet.
            </p>
        </div>
        <div class="our-mission-entry our-middle">
            <img src="<?= getImgUrl('images/FashionandLifeQuality.png') ?>">
            <p class="mission-title">Introducing Fashion and Life Quality</p>
            <p class="mission-content">
                We provide products which integrate beauty with practicability, adding more convenience to people’s life. Utilizing strict product control, we satisfy our customers with authentic, high quality products adhering to high safety standards and on track with the latest lifestyle concepts.
            </p>
        </div>
        <div class="our-mission-entry">
            <img src="<?= getImgUrl('images/icon_pc.png') ?>">
            <p class="mission-title">Zero Risk</p>
            <p class="mission-content">
                You will not pay on CashBackClub but on Amazon! That means you can return anytime for no reason and you won't lose even a single penny! Also, you could return the product and get a refound from Amazon if you're not satisfied with the product. <strong>We protect user's privacy, 100% SECURITY!</strong>
            </p>
        </div>
    </div>
    <div class="step-tips hidden-sm hidden-xs">
        <div class="step-detail">
            <img class="step-img" src="<?= getImgUrl('images/step-buy.png'); ?>">
            <div class="steps-content">
                <h4>Grab the deal</h4>
                <p>Click deal request</p>
            </div>
        </div>
        <img class="step-line-img" src="<?= getImgUrl('images/step-line.png'); ?>">
        <div class="step-detail">
            <img class="step-img" src="<?= getImgUrl('images/step-amzon.png'); ?>">
            <div class="steps-content">
                <h4>Buy it on Amazon</h4>
                <p>Go to Amazon</p>
            </div>
        </div>
        <img class="step-line-img" src="<?= getImgUrl('images/step-line.png'); ?>">
        <div class="step-detail">
            <img class="step-img" src="<?= getImgUrl('images/step-order.png'); ?>">
            <div class="steps-content">
                <h4>Fill the order info</h4>
                <p>Order ID & screenshot</p>
            </div>
        </div>
        <img class="step-line-img" src="<?= getImgUrl('images/step-line.png'); ?>">
        <div class="step-detail">
            <img class="step-img" src="<?= getImgUrl('images/step-back.png'); ?>">
            <div class="steps-content">
                <h4>Get money back</h4>
                <p>Up to 100% Cashback</p>
            </div>
        </div>
    </div>
    <div class="hidden-lg hidden-md" style="margin-top: 25px;">
        <h2 class="detail-steps-title">4 Steps to Get Cash Back</h2>
        <div class="detail-step-item text-center">
            <img class="step-item-icon" src="<?= getImgUrl('images/step-add-icon.png'); ?>">
            Click the 'Deal Request' button
        </div>
        <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
        <div class="detail-step-item text-center">
            <img class="step-item-icon" src="<?= getImgUrl('images/step-finish-icon.png'); ?>">
            Buy it on Amazon
        </div>
        <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
        <div class="detail-step-item text-center">
            <img class="step-item-icon" src="<?= getImgUrl('images/step-fill-icon.png'); ?>">
            Fill in Amazon order info and approved by us
        </div>
        <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
        <div class="detail-step-item text-center">
            <img class="step-item-icon" src="<?= getImgUrl('images/step-back-icon.png'); ?>">
            Get the cash back to your PayPal account
        </div>
    </div>
    <div>
        <p class="text-center" style="margin-top: 40px; margin-bottom: 40px">
            <a href="<?= Url::toRoute('/site/faq');?>" class="join-btn" style="background-color: #f93; color: #fff">Learn More</a>
        </p>
    </div>
    <div class="intu">
        <h5>
            Intuitive Features Powerful Results
        </h5>
        <p>
            CashBackClub aim to collects more feedback on products to help both sellers upgrade their products and service and help other customers make better purchase decisions.<br>
            Together, we share the spirit of continuously optimizing our services through the latest data and technologies to maximize value for our users.<br>
            Shopping online and saving money without much effort. There’s no wrong way to use it, and nothing to lose getting started. You’ll be surprised how life-changing something so simple can be.
        </p>
    </div>
</div>
<!--<div class="abouus-banner-bottom" style="background: url(<?= getImgUrl('images/about-banner-2.png') ?>) no-repeat;">
    <p class="banner-bottom-title">
        <span class="septal-row" style="background-color: #fff;"></span>
        <span style="margin: 0 24px;">Meet the Team</span>
        <span class="septal-row" style="background-color: #fff;"></span>
    </p>
    <p class="banner-bottom-content">
        CashBackClub was created by a group of young, tasteful individuals who have a mission to help users improve their life quality. Our talented leadership team has extensive experience and knowledge of the market. Together, we share the spirit of continuously optimizing our services through the latest data and technologies to maximize value for our users.
    </p>
</div>-->