<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<?= $this->render('../public/topbar.php') ?>
<style type="text/css">
    @media (max-width:768px) {

    }
</style>
<div class="split"></div>
<div class="container visible-sm visible-xs" style="background: #fff">
    <div class="index_tops">
        <?php if (is_array($top_all) && !empty($top_all)): ?>
        <?php foreach ($top_all as $product): ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 deal-entry-container">
            <a href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                <div class="deal-entry">
                    <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                        <?php if ($product['qty'] <= 0){?>
                            <div class="shade-layer"></div>
                            <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                                <font style="line-height: 40px">Sold Out</font>
                                <font style="font-size: 14px;line-height: 22px"><br>Available Tomorrow</font>
                            </span>
                        <?php }?>
                    </div>
                    <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                    <ul class="deal-account-list">
                        <li>
                            <p class="prime-value">
                                <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['final_price'] ?>
                                <span class="origin-price new-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></span>
                            </p>
                            <p class="prime-tile">Price</p>
                        </li>
                        <li class="deal-price-cotainer">
                            <p class="prime-value"><?= $product['total_off'] ?>%</p>
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
        <a class="freebies-entry" href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
            <div style="position: relative;">
                <div class="circle-tip">
                    <div class="circle-tip-body">
                        <p style="margin: 0;"><?= $product['total_off'] ?> %</p>
                        <p style="margin: 0;">Off</p>
                    </div>
                </div>
                <div class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)" data-was-processed="true">
                    <?php if ($product['qty'] <= 0){?>
                    <div class="shade-layer"></div>
                    <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                        <font style="line-height: 40px">Sold Out</font>
                        <font style="font-size: 16px;line-height: 22px"><br>Available Tomorrow</font>
                    </span>
                    <?php }?>
                </div>
                <p class="hot-entity-title"><span><?= $product['product']['name'] ?></span></p>
                <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                    <li class="account-left" style="width: 20%">
                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                        <p class="prime-tile">Price</p>
                    </li>
                    <?php if (!is_null($product['cashback']) && $product['cashback']>0){ ?>
                        <li class="account-off" style="width: 30%">
                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                            <p class="prime-tile">Cashback</p>
                        </li>
                    <?php }?>
                    <?php if (!is_null($product['coupon']) && $product['coupon']>0){ ?>
                        <li class="account-off" style="width: 25%">
                            <p class="prime-value">
                                <?php if ($product['coupon_type'] == 1){?>
                                    <?= $product['coupon'] ?> %
                                <?php }else{?>
                                    <?= number_format($product['coupon']/$product['price']*100, 2) ?> %
                                <?php }?>
                            </p>
                            <p class="prime-tile">Off</p>
                        </li>
                    <?php }?>
                    <li class="account-fullfill" style="width: 25%">
                        <p class="fullfill-methed">Fullfilled by</p>
                        <p class="prime-tile">
                            <img class="prime-amz-logo img-responsive center-block" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>">
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
                <a href="<?= Url::toRoute('/product/coupon&cashback');?>">Coupon + Cashback Deals</a>
                <a class="inline-view-all" href="<?= Url::toRoute('/product/coupon&cashback');?>" style="float: none; font-size: 16px;">View All</a>
            </h3>
            <div>
                <?php if (is_array($cashbackCouponProducts) && !empty($cashbackCouponProducts)):  $i=0;?>
                    <?php foreach ($cashbackCouponProducts as $product):  $i++;?>
                        <a href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>" class="new-deal-entry">
                            <div style="position: relative;">
                                <div class="circle-tip">
                                    <div class="circle-tip-body">
                                        <p style="margin: 0;"><?= $product['total_off'] ?> %</p>
                                        <p style="margin: 0;">Off</p>
                                    </div>
                                </div>
                                <div class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                                    <?php if ($product['qty'] <= 0){?>
                                        <div class="shade-layer"></div>
                                        <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                                            <font style="line-height: 40px">Sold Out</font>
                                            <font style="font-size: 16px;line-height: 22px"><br>Available Tomorrow</font>
                                        </span>
                                    <?php }?>
                                </div>
                                <p class="new-entity-title">
                                    <span href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>"><?= $product['product']['name'] ?></span>
                                </p>
                                <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                                    <li class="account-left" style="width: 20%">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                        <p class="prime-tile">Price</p>
                                    </li>
                                    <?php if (!is_null($product['cashback']) && $product['cashback']>0){ ?>
                                        <li class="account-off" style="width: 30%">
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                    <?php }?>
                                    <?php if (!is_null($product['coupon']) && $product['coupon']>0){ ?>
                                        <li class="account-off" style="width: 25%">
                                            <p class="prime-value">
                                                <?php if ($product['coupon_type'] == 1){?>
                                                    <?= $product['coupon'] ?> %
                                                <?php }else{?>
                                                    <?= number_format($product['coupon']/$product['price']*100, 2) ?> %
                                                <?php }?>
                                            </p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                    <?php }?>
                                    <li class="account-fullfill" style="width: 25%">
                                        <p class="fullfill-methed">Fullfilled by</p>
                                        <p class="prime-tile">
                                            <img class="prime-amz-logo img-responsive center-block" src="<?= getImgUrl('images/v3-amz-logo.jpg'); ?>">
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
                <a href="<?= Url::toRoute('/product/cashback');?>">Cashback Deals</a>
                <a class="inline-view-all" href="<?= Url::toRoute('/product/cashback');?>" style="float: none; font-size: 16px;">View All</a>
            </h3>
            <div>
                <?php if (is_array($cashbackProducts) && !empty($cashbackProducts)):  $i=0;?>
                    <?php foreach ($cashbackProducts as $product):  $i++;?>
                        <a class="freebies-entry" href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                            <div style="position: relative;">
                                <div class="circle-tip">
                                    <div class="circle-tip-body">
                                        <p style="margin: 0;"><?= $product['total_off'] ?> %</p>
                                        <p style="margin: 0;">Off</p>
                                    </div>
                                </div>
                                <div class="product-img-container shade-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                                    <?php if ($product['qty'] <= 0){?>
                                        <div class="shade-layer"></div>
                                        <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                                            <font style="line-height: 40px">Sold Out</font>
                                            <font style="font-size: 16px;line-height: 22px"><br>Available Tomorrow</font>
                                        </span>
                                    <?php }?>
                                </div>
                                <p class="hot-entity-title">
                                    <span href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>"><?= $product['product']['name'] ?></span>
                                </p>
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
    </section>

<section id="page" class="container visible-sm visible-xs">
    <div class="deals-classify-section row">
        <h3 class="deal-type-title" style="margin-top: 0;">
            <a href="<?= Url::toRoute('/product/coupon&cashback');?>">Coupon + Cashback Deals</a>
            <a class="inline-view-all" href="<?= Url::toRoute('/product/coupon&cashback');?>">View All <i class="fa fa-angle-right view-all-icon" aria-hidden="true"></i></a>
        </h3>
        <?php if (is_array($cashbackCouponProducts) && !empty($cashbackCouponProducts)): ?>
            <?php foreach ($cashbackCouponProducts as $product): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 coupon-entry-container">
                    <a href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                        <div class="deal-entry">
                            <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                                <?php if ($product['qty'] <= 0){?>
                                    <div class="shade-layer"></div>
                                    <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                                       <font style="line-height: 40px">Sold Out</font>
                                       <font style="font-size: 14px;line-height: 22px"><br>Available Tomorrow</font>
                                    </span>
                                <?php }?>
                            </div>
                            <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                            <ul class="deal-account-list">
                                <li>
                                    <p class="prime-value">
                                        <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['final_price'] ?>
                                        <span class="origin-price new-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></span>
                                    </p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <li class="deal-price-cotainer">
                                    <p class="prime-value"><?= $product['total_off'] ?>%</p>
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
            <a href="<?= Url::toRoute('/product/cashback');?>">Cashback Deals</a>
            <a class="inline-view-all" href="<?= Url::toRoute('/product/cashback');?>">View All <i class="fa fa-angle-right view-all-icon" aria-hidden="true"></i></a>
        </h3>
        <?php if (is_array($cashbackProducts) && !empty($cashbackProducts)): ?>
        <?php foreach ($cashbackProducts as $product): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padd0 coupon-entry-container">
                    <a href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                        <div class="deal-entry">
                            <div class="product-img-container lazy shade-container" data-bg="url(<?= $product['product']['thumb_image'] ?>)">
                                <?php if ($product['qty'] <= 0){?>
                                    <div class="shade-layer"></div>
                                    <span class="shade-tip" style="line-height: 20px;padding: 60px 0;">
                                        <font style="line-height: 40px">Sold Out</font>
                                        <font style="font-size: 14px;line-height: 22px"><br>Available Tomorrow</font>
                                    </span>
                                <?php }?>
                            </div>
                            <p class="deal-entity-title"><?= $product['product']['name'] ?></p>
                            <ul class="deal-account-list">
                                <li>
                                    <p class="prime-value">
                                        <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['final_price'] ?>
                                        <span class="origin-price new-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></span>
                                    </p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <li class="deal-price-cotainer">
                                    <p class="prime-value"><?= $product['total_off'] ?>%</p>
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