<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container mt55">
    <h1 class="aboutus-title">About Us</h1>
    <p class="aboutus-banner-content" style="font-family: SegoeUIEmoji, Arial, sans-serif, Helvetica, Montserrat;">
        Launched in 2018, Cashbackbase is notably one of the fastest-growing communities for Amazon deals. We are consistently innovating, staying ahead of the curve in tech trends and product ideas. We select the best offers from Amazon and provide discounts and product testing opportunities exclusively for our users.
    </p>
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