<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<section class="aboutus-banner" style="background:url(<?= getImgUrl('images/about-banner.png') ?>) no-repeat">
    <div class="container">
        <h1 class="aboutus-title"><?= $model->title?></h1>
        <?= $model->content?>
        <div>
            <div class="aboutus-tip-container">
                <img class="aboutus-banner-icon" src="<?= getImgUrl('images/SelectiveBrands.png') ?>">
                <p class="aboutus-banner-tip">Selective Brands</p>
            </div>
            <div class="sept-line">

            </div>
            <div class="aboutus-tip-container">
                <img class="aboutus-banner-icon" src="<?= getImgUrl('images/BigDiscounts.png') ?>">
                <p class="aboutus-banner-tip">Big Discounts</p>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="about-panel">
        <p class="our-mission">
            <span class="septal-row"></span>
            <span style="margin: 0 24px;">Our Mission</span>
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
                Shop on Amazon directly with no need to pay other fees.
            </p>
        </div>
    </div>
</div>
<div class="abouus-banner-bottom" style="background: url(<?= getImgUrl('images/about-banner-2.png') ?>) no-repeat;">
    <p class="banner-bottom-title">
        <span class="septal-row" style="background-color: #fff;"></span>
        <span style="margin: 0 24px;">Meet the Team</span>
        <span class="septal-row" style="background-color: #fff;"></span>
    </p>
    <p class="banner-bottom-content">
        CashBackClub was created by a group of young, tasteful individuals who have a mission to help users improve their life quality. Our talented leadership team has extensive experience and knowledge of the market. Together, we share the spirit of continuously optimizing our services through the latest data and technologies to maximize value for our users.
    </p>
</div>