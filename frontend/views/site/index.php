<?php
$this->title = 'Get the Latest Deals on Amazon丨Cashbackbase';
?>
<?php $this->registerMetaTag(array("name"=>"description","content"=>"Cashbackbase Collects Latest Deals From All Amazon Product Categories, Helps Amazon Buyers Save Time And Money.")); ?>
<?php $this->registerMetaTag(array("name"=>"keywords","content"=>"Cashbackbase Deals Deal 100%off Amazon")); ?>
<div class="top-nav-container visible-xs-block visible-sm-block hidden-lg hidden-md">
    <div>
        <nav class="mydeal-nav-brand">
            <div class="deal-content-nav index-nav-ul">
                <a href="" class="deal-nav-a">
                    All Deals
                </a>
                <a href="" class="deal-nav-a">
                    Cashback Deals
                </a>
                <a href="" class="deal-nav-a">
                    Coupon Deals
                </a>
                <a href="" class="deal-nav-a">
                    Coupon + Cashback
                </a>
            </div>
        </nav>
    </div>
</div>
<div class="split"></div>
<div class="container visible-sm visible-xs" style="background: #fff">
    <div class="index_tops">
        <?php if (is_array($top_all) && !empty($top_all)): ?>
        <?php foreach ($top_all as $product): ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 deal-entry-container">
            <a href="#">
                <div class="deal-entry">
                    <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                    </div>
                    <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                    <ul class="deal-account-list">
                        <li>
                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                            <p class="prime-tile">Price</p>
                        </li>
                        <li class="deal-price-cotainer">
                            <p class="prime-value"><?= $product['coupon'] ?>%</p>
                            <p class="prime-tile">Off</p>
                        </li>
                    </ul>
                </div>
            </a>
        </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="container visible-lg visible-md">
    <div class="index_tops">
        <?php if (is_array($top_all) && !empty($top_all)): ?>
        <?php foreach ($top_all as $product): ?>
        <a class="freebies-entry" href="" style="display: block; overflow: hidden;">
            <div style="position: relative;">
                <div class="cashback-circle-tip">
                    <div style="display: inline-block; height: 28px; vertical-align: middle; line-height: 15px; transform:rotate(-15deg);">
                        <p style="margin: 0;">Cashback</p><p style="margin: 0;">100%</p>
                    </div>
                </div>
                <div href="" class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)" data-was-processed="true">
                </div>
                <p class="hot-entity-title"><span><?= $product['product']['name'] ?></span></p>
                <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                    <li class="account-left">
                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                        <p class="prime-tile">Price</p>
                    </li>
                    <li class="account-off">
                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                        <p class="prime-tile">Cashback</p>
                    </li>
                    <li class="account-fullfill">
                        <p class="fullfill-methed">Fullfilled by</p>
                        <p class="prime-tile">
                            <img class="prime-amz-logo img-responsive" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>">
                        </p>
                    </li>
                </ul>
            </div>
        </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

    <section id="page" class="container visible-lg visible-md" style="padding: 0;">
        <div class="step-tips">
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
        <div class="deals-classify-section" style="margin-bottom: 20px;">
            <h3 class="deal-type-title">
                <a href="#">Coupon Deals</a>
                <a class="inline-view-all" href="#" style="float: none; font-size: 16px;">View All</a>
            </h3>
            <div>
                <?php if (is_array($couponProducts) && !empty($couponProducts)):  $i=0;?>
                    <?php foreach ($couponProducts as $product):  $i++;?>
                        <a href="" class="new-deal-entry">
                            <div>
                                <div class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)"></div>
                                <p class="new-entity-title"><span href=""><?= $product['product']['name'] ?></span></p>
                                <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                                    <li class="account-left">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                        <p class="prime-tile">Price</p>
                                    </li>
                                    <?php if (!is_null($product['cashback']) && $product['cashback']>0){ ?>
                                        <li class="account-off">
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                    <?php }?>
                                    <?php if (!is_null($product['coupon']) && $product['coupon']>0){ ?>
                                        <li class="account-off">
                                            <p class="prime-value"><?= $product['coupon'] ?>%</p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                    <?php }?>
                                    <li class="account-fullfill">
                                        <p class="fullfill-methed">Fullfilled by</p>
                                        <p class="prime-tile">
                                            <img class="prime-amz-logo img-responsive" src="<?= getImgUrl('images/v3-amz-logo.jpg'); ?>">
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="deals-classify-section">
            <h3 class="deal-type-title" style="margin-bottom: 10px;">
                <a href="/cashback">Cash Back</a>
                <a class="inline-view-all" href="/cashback" style="float: none; font-size: 16px;">View All</a>
            </h3>
            <p style="margin-bottom: 20px;">Cashback to you paypal account.</p>
            <div>
                <?php if (is_array($cashbackProducts) && !empty($cashbackProducts)):  $i=0;?>
                    <?php foreach ($cashbackProducts as $product):  $i++;?>
                        <a class="freebies-entry" href="">
                            <div style="position: relative;">
                                <div class="cashback-circle-tip">
                                    <div style="display: inline-block; height: 28px; vertical-align: middle; line-height: 15px; transform:rotate(-15deg);">
                                        <p style="margin: 0;">Cashback</p><p style="margin: 0;"><?= $product['cashback'] ?></p>
                                    </div>
                                </div>
                                <div href="" class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                                </div>
                                <p class="hot-entity-title"><span href=""><?= $product['product']['name'] ?></span></p>
                                <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                                    <li class="account-left">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                        <p class="prime-tile">Price</p>
                                    </li>
                                    <li class="account-off">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?><?= $product['cashback'] ?></p>
                                        <p class="prime-tile">Cashback</p>
                                    </li>
                                    <li class="account-fullfill">
                                        <p class="fullfill-methed">Fullfilled by</p>
                                        <p class="prime-tile">
                                            <img class="prime-amz-logo img-responsive" src="<?= getImgUrl('images/v3-amz-logo.jpg'); ?>">
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="deals-classify-section" style="background-color: #fff;">
            <h3 class="text-center" style="font-weight: 500;margin: 0 0 20px;padding-top: 20px;">
                <a href="#" style="color: #f93;">Testimonial</a>
            </h3>
            <p class="text-center" style="font-size: 18px;margin-bottom: 0.75rem;">What our customers say</p>
            <div style="    width: 100%;display: inline-block;">
                <div style="width: 33%;float: left;padding-left: 19px;">
                    <div class="testimonial-customer" style="float: left;width: 100%;padding-bottom: 10px; border-bottom: solid 2px;margin-bottom:10px">
                        <img alt="image" class="img-circle" style="float: left;" src="<?= getImgUrl('images/default-icon.png'); ?>" width="40px">
                        <p style="line-height: 40px; margin: 0; font-size: 14px; float: left; margin-left: 10px;">
                            wwk311y02
                        </p>
                    </div>
                    <div class="testimonial-rating" style="width: 100%;margin-bottom:5px;">
                        <div style="float: left;">
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                        </div>
                        <p style="text-align: right; margin-bottom: 0; font-size: 13px; color: rgb(103, 106, 108);">Nov 18, 2019</p>
                    </div>
                    <div class="testimonial-text" style="float: left;width: 100%;">
                        <p style="font-size: 13px;">Cashbackbase has amazing deals on some great products found on Amazon, especially if you have a Prime account. Youd be an idiot not to check CBB first to see if you can score a partial or even a full refund on items youre already planning to purchase. What I love most about this site is that they dont make you wait 30+ days to get your money back like the other sites. Your cashback is sent to your PayPal account as soon as your order ships. Theres also lots of ways to earn the points required to make a purchase, especially if you can remember to login daily. Theres really no excuse not to...</p>
                    </div>
                </div>
                <div style="width: 33%;float: left;padding-left: 19px;">
                    <div class="testimonial-customer" style="float: left;width: 100%;padding-bottom: 10px; border-bottom: solid 2px;margin-bottom:10px">
                        <img alt="image" class="img-circle" style="float: left;" src="<?= getImgUrl('images/default-icon.png'); ?>" width="40px">
                        <p style="line-height: 40px; margin: 0; font-size: 14px; float: left; margin-left: 10px;">
                            Kannon Hossain
                        </p>
                    </div>
                    <div class="testimonial-rating" style="width: 100%;margin-bottom:5px;">
                        <div style="float: left;">
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                        </div>
                        <p style="text-align: right; margin-bottom: 0; font-size: 13px; color: rgb(103, 106, 108);">Nov 16, 2019</p>
                    </div>
                    <div class="testimonial-text" style="float: left;width: 100%;">
                        <p style="font-size: 13px;">I am very much pleased write about Cashbackbase that it is a good website to buy some products at a very low price. I am using this site for the last 1 year and I am very satisfied by using Cashbackbases tons of good offer. I highly recommend this site to other people.</p>

                    </div>
                </div>
                <div style="width: 33%;float: left;padding-left: 19px;">
                    <div class="testimonial-customer" style="float: left;width: 100%;padding-bottom: 10px; border-bottom: solid 2px;margin-bottom:10px">
                        <img alt="image" class="img-circle" style="float: left;" src="<?= getImgUrl('images/default-icon.png'); ?>" width="40px">
                        <p style="line-height: 40px; margin: 0; font-size: 14px; float: left; margin-left: 10px;">
                            Rick
                        </p>
                    </div>
                    <div class="testimonial-rating" style="width: 100%;margin-bottom:5px;">
                        <div style="float: left;">
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                        </div>
                        <p style="text-align: right; margin-bottom: 0; font-size: 13px; color: rgb(103, 106, 108);">Nov 15, 2019</p>
                    </div>
                    <div class="testimonial-text" style="float: left;width: 100%;">
                        <p style="font-size: 13px;">I have had an amazing experience with cashbackbase. The products available for review are amazing; Its pretty much guaranteed that you will find something you like! My experience with the sellers has been great so far. They have been very friendly and respond quite fast! Overall, I am very impressed, and I think a lot of you will be too!<br />
                            <br />
                            - Rick</p>

                    </div>
                </div>
            </div>
            <div>
            <span class="text-center" style="display: block;margin-bottom: 20px;font-size: 18px;
    font-weight: 600;">
                <a href="#">View More</a>
            </span>
            </div>
        </div>
    </section>

<section id="page" class="container visible-sm visible-xs">
    <div class="deals-classify-section row">
        <h3 class="deal-type-title" style="margin-top: 0;">
            <a href="">Coupon Deals</a>
            <a class="inline-view-all" href="">View All <i class="fa fa-angle-right view-all-icon" aria-hidden="true"></i></a>
        </h3>
        <?php if (is_array($couponProducts) && !empty($couponProducts)): ?>
            <?php foreach ($couponProducts as $product): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 coupon-entry-container">
                    <a href="#">
                        <div class="deal-entry">
                            <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                            </div>
                            <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                            <ul class="deal-account-list">
                                <li>
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <li class="deal-price-cotainer">
                                    <p class="prime-value"><?= $product['coupon'] ?>%</p>
                                    <p class="prime-tile">Off</p>
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="deals-classify-section row">
        <h3 class="deal-type-title" style="margin-top: 0;">
            <a href="">Cashback</a>
            <a class="inline-view-all" href="">View All <i class="fa fa-angle-right view-all-icon" aria-hidden="true"></i></a>
        </h3>
        <?php if (is_array($cashbackProducts) && !empty($cashbackProducts)): ?>
        <?php foreach ($cashbackProducts as $product): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 coupon-entry-container">
                    <a href="#">
                        <div class="deal-entry">
                            <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                            </div>
                            <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                            <ul class="deal-account-list">
                                <li>
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <li class="deal-price-cotainer">
                                    <p class="prime-value"><?= $product['coupon'] ?>%</p>
                                    <p class="prime-tile">Off</p>
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
        <?php endforeach; ?>
        <?php endif?>
    </div>
</section>
    <script type="text/javascript">
        <?php $this->beginBlock('js_block') ?>
        $(document).ready(function(){
            clearRowLastMargin($('.freebies-entry'), 4);
            clearRowLastMargin($('.coupon-entry'), 4);
            clearRowLastMargin($('.new-deal-entry'), 4);
        });
        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>