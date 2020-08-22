<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
    <style type="text/css">
        @media (max-width:768px) {
            #footer{
                margin-bottom: 50px;
            }
        }
    </style>
<div class="split"></div>
<div id="detail-banner">
    <section class="container">
        <div class="row detail-contents">
            <input type="hidden" id="activity_view_id" value="<?= $model['id']?>">
            <input type="hidden" id="product_view_id" value="<?= $model['product']['id']?>">
            <input type="hidden" id="tag" value="<?= Yii::$app->request->get('tag')?>">
            <input type="hidden" id="sign" value="<?= Yii::$app->request->get('code')?>">
            <div class="visible-sm visible-xs">
                <ul>
                    <li class="deal-detail-content col-xs-12 detail-contents-1" style="padding: 0;">
                        <div id="deal-detail-content" style="position: relative;top: -100px;"></div>
                        <div id="detail-arousel" class="carousel slide">
                            <?= $this->render('image', ['gallerys'=>$model['product']['mutil_image']]); ?>
                            <h1 class="banner-title-detail">
                                <?= $model['product']['name']; ?>
                            </h1>
                            <?php if ($model['type'] == 3){?>
                                <div style="margin-top: 10px; margin-bottom: 10px; padding-left: 10px;">
                                    <span class="now-price" style="margin-left:5px;font-size: 16px;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['final_price'] ?></span>
                                    <span class="origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span>
                                </div>
                            <?php }?>
                            <div style="overflow: hidden;">
                                <ul class="prime-acount-list carousel-acount-list" style="font-size: 13px;">
                                    <?php if ($model['type'] == 2){?>
                                        <li class="account-left" style="width: 24%">
                                            <span class="origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span><br>
                                            <span class="now-price" style="margin-left:5px;font-size: 16px;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['final_price'] ?></span>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-left" style="width: 20%;">
                                            <p class="prime-value"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 26%;">
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill" style="width: 28%;">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                <img class="prime-amz-logo" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>" style="height: 18px;">
                                            </p>
                                        </li>
                                    <?php }else if ($model['type'] == 1){?>
                                        <li class="account-left" style="width: 24%">
                                            <span class="origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span><br>
                                            <span class="now-price" style="margin-left:5px;font-size: 16px;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= ($model['final_price']) ?></span>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-left" style="width: 20%;">
                                            <p class="prime-value"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 26%;">
                                            <p class="prime-value">
                                                <?php if ($model['coupon_type'] == 1){?>
                                                    <?= number_format($model['coupon'], 0) ?> %
                                                <?php }else{?>
                                                    <?= number_format($model['coupon']/$model['price']*100, 0) ?> %
                                                <?php }?>
                                            </p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill" style="width: 28%;">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                <img class="prime-amz-logo" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>" style="height: 18px;">
                                            </p>
                                        </li>
                                    <?php }else if ($model['type'] == 3){?>
                                        <li class="account-left" style="width: 20%;">
                                            <p class="prime-value"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 25%;">
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 25%;">
                                            <p class="prime-value">
                                                <?php if ($model['coupon_type'] == 1){?>
                                                    <?= number_format($model['coupon'], 0) ?> %
                                                <?php }else{?>
                                                    <?= number_format($model['coupon']/$model['price']*100, 0) ?> %
                                                <?php }?>
                                            </p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill" style="width: 28%;">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                <img class="prime-amz-logo" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>" style="height: 18px;">
                                            </p>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                            <div class="detail-points-container earn-points" style="margin: 0 20px;">
                                <?php if ($model['type'] == 2){?>
                                    Buy it on amazon and earn cashback,you can save <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['save_price']?>
                                <?php } else {?>
                                    Buy it on amazon by coupon then earn cashback, you can save <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['save_price']?> in total
                                <?php }?>
                            </div>
                        </div>
                    </li>
                    <li class="col-xs-12 describe-container detail-contents-2" style="overflow: hidden;">
                        <div class="detai-steps">
                            <h2 class="function-block-title">4 step to get cashback</h2>

                            <div class="col-xs-3 detail-step">
                                <img class="step-item-icon lazy loaded" data-src="<?= getImgUrl('images/step-add-icon.png'); ?>" data-was-processed="true">
                                Deal request
                            </div>

                            <div class="col-xs-3 detail-step">
                                <img class="step-item-icon lazy loaded" data-src="<?= getImgUrl('images/step-finish-icon.png'); ?>" data-was-processed="true">
                                Purchase on amazon
                            </div>

                            <div class="col-xs-3 detail-step">
                                <img class="step-item-icon lazy loaded" data-src="<?= getImgUrl('images/step-fill-icon.png'); ?>" data-was-processed="true">
                                Submit order info
                            </div>

                            <div class="col-xs-3 detail-step">
                                <img class="step-item-icon lazy loaded" data-src="<?= getImgUrl('images/step-back-icon.png'); ?>" data-was-processed="true">
                                Get cash back
                            </div>

                            <p class="col-xs-12" style="margin: 20px 0 0;color:#888;">
                                <span class="error">Tips</span>: The amount of the coupon will be deducted from the cashback if you use a coupon.
                            </p>
                        </div>
                    </li>
                    <li class="col-xs-12 describe-container detail-contents-2" style="overflow: hidden;">
                        <div id="describe-container" style="position: relative;top: -100px;"></div>
                        <h2 class="function-block-title" style="margin-top: 0;">Description</h2>
                        <div class="detail-deal-description">
                            <?= $model['product']['description']?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="visible-lg visible-md">
                <div class="col-md-8 col-sm-7 col-xs-12 deal-detail-content">
                    <div class="row">
                        <div class="banner-content details-mobile">
                            <h1 class="banner-title-detail"><?= $model['product']['name']; ?></h1>
                            <?= $this->render('pc_image', ['gallerys'=>$model['product']['mutil_image'], 'image'=>$model['product']['image'], 'name'=>$model['product']['name']]); ?>
                        </div>
                        <div style="height: 15px; background: rgba(242, 245, 247, 1);"></div>
                        <div class="banner-content details-mobile" style="padding: 20px 0;">
                            <div class="col-sm-12" style="margin-bottom: 15px;">
                                <h4 style="margin: 0;"><strong>Description</strong></h4>
                                <?= $model['product']['description']?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12 deal-detail-price">
                    <div class="row">
                        <div class="banner-content v3-banner-right details-mobile" id="v3-banner-right" style="position: static; top: 0px;">
                            <div class="detail-banner-right" style="margin: 35px 20px 23px;">
                                <div class="v3-detail-price">
                                    <p class="v3-price-container">
                                        <span class="v3-relprice"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['final_price'] ?></span>
                                        <span class="v3-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span>
                                    </p>
                                    <div id="wish-btn-container" class="hidden">
                                        <?php if (Yii::$app->user->isGuest) {?>
                                            <img class="wish-icon" src="<?= getImgUrl('images/wish-icon.png'); ?>" data-toggle="modal" data-target=".is-logged-in-modal">
                                        <?php } else {?>
                                            <img class="wish-icon" id="collect" data-url="<?= Url::toRoute('favo') ?>"  src="<?= getImgUrl('images/wish-icon.png'); ?>">
                                            <img class="wish-icon" id="uncollect" data-url="<?= Url::toRoute('favo') ?>" src="<?= getImgUrl('images/wish-icon-active.png'); ?>" style="display: none;">
                                        <?php }?>
                                        <font id="total-collect">1</font>
                                    </div>
                                </div>
                                <ul class="prime-acount-list detail-acount-list" style="margin-bottom: 20px;">
                                    <?php if ($model['type'] == 2){?>
                                        <li class="account-left" style="width: 25% !important;">
                                            <p class="prime-value" style="color: #666;"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 35% !important;">
                                            <p class="prime-value" style="color: #666;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                Amazon
                                            </p>
                                        </li>
                                    <?php }else if ($model['type'] == 1){?>
                                        <li class="account-left" style="width: 25% !important;">
                                            <p class="prime-value" style="color: #666;"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 35% !important;">
                                            <p class="prime-value" style="color: #666;">
                                                <?php if ($model['coupon_type'] == 1){?>
                                                    <?= number_format($model['coupon'], 0) ?> %
                                                <?php }else{?>
                                                    <?= number_format($model['coupon']/$model['price']*100, 0) ?> %
                                                <?php }?>
                                            </p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                Amazon
                                            </p>
                                        </li>
                                    <?php }else if ($model['type'] == 3){?>
                                        <li class="account-left" style="width: 20% !important;">
                                            <p class="prime-value" style="color: #666;"><?= $model['qty'] ?></p>
                                            <p class="prime-tile">Left</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 27% !important;">
                                            <p class="prime-value" style="color: #666;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-off" style="width: 25% !important;">
                                            <p class="prime-value" style="color: #666;">
                                                <?php if ($model['coupon_type'] == 1){?>
                                                    <?= number_format($model['coupon'], 0) ?> %
                                                <?php }else{?>
                                                    <?= number_format($model['coupon']/$model['price']*100, 0) ?> %
                                                <?php }?>
                                            </p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                        <li class="space-vertical-lines"></li>
                                        <li class="account-fullfill" style="width: 27% !important;">
                                            <p class="fullfill-methed">Fullfilled by</p>
                                            <p class="prime-tile">
                                                Amazon
                                            </p>
                                        </li>
                                    <?php }?>
                                </ul>
                                <?php if ($model['qty'] > 0 && $model['end'] >= time()){?>
                                    <?php if ($model['type'] == 2){ ?>
                                        <button type="button" class="cashback_deal btn btn-lg v3-detail-btn" data-toggle="modal" <?php if (Yii::$app->user->isGuest) {?>data-target=".is-logged-in-modal"<?php }else{?>data-target=".check-deal-review"<?php }?>>
                                            <span class="v3-detail-btn-content">Deal Request</span>
                                        </button>
                                        <div style="width: 0px; border-style: solid solid solid solid; border-width: 0px 8px 8px 8px; border-color: #fff #fff #1ab394 #fff; margin: 0 auto; margin-top: 2px; margin-bottom: -1px;"></div>
                                        <p class="detail-points-left" style="color: #1ab394; margin: 0px 0 10px 0; padding: 5px 0; border: 1px dashed #1ab394; border-radius: 5px;">
                                            <i class="fa fa-exclamation-circle"></i>Buy it on amazon and earn cashback,you can save <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['save_price']?>
                                        </p>
                                    <?php }else{?>
                                        <?php if (Yii::$app->user->isGuest) {?>
                                            <button type="button" class="cashback_deal btn btn-lg v3-detail-btn" data-toggle="modal" data-target=".is-logged-in-modal">
                                                <span class="v3-detail-btn-content">Get Coupon</span>
                                            </button>
                                        <?php }else{?>
                                            <button type="button" class="cashback_deal btn btn-lg v3-detail-btn" data-toggle="modal" data-target=".check-deal-review">
                                                <span class="v3-detail-btn-content">Get Coupon</span>
                                            </button>
                                        <?php }?>
                                        <div style="width: 0px; border-style: solid solid solid solid; border-width: 0px 8px 8px 8px; border-color: #fff #fff #1ab394 #fff; margin: 0 auto; margin-top: 2px; margin-bottom: -1px;"></div>
                                        <p class="detail-points-left" style="color: #1ab394; margin: 0px 0 10px 0; padding: 5px 0; border: 1px dashed #1ab394; border-radius: 5px;">
                                            <i class="fa fa-exclamation-circle"></i>Buy it on amazon by coupon then earn cashback, you can save <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['save_price']?> in total.
                                        </p>
                                    <?php }?>
                                <?php }else{?>
                                    <button type="button" class="btn btn-lg v3-detail-btn" disabled>
                                        <span class="v3-detail-btn-content">Sold Out</span>
                                    </button>
                                    <div style="width: 0px; border-style: solid solid solid solid; border-width: 0px 8px 8px 8px; border-color: #fff #fff #ed5565 #fff; margin: 0 auto; margin-top: 2px; margin-bottom: -1px;"></div>
                                    <p class="detail-points-left" style="color: #ed5565; margin: 0px 0 10px 0; padding: 5px 0; border: 1px dashed #ed5565; border-radius: 5px;">
                                        <i class="fa fa-exclamation-circle"></i> Available Tomorrow
                                    </p>
                                <?php }?>
                                <div class="social-sharing text-center index_social_link" data-permalink="http://labs.carsonshold.com/social-sharing-buttons" style="margin-top: 20px;">
                                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>" class="share-facebook">
                                        <span class="fa fa-facebook-official icon"></span>
                                        <span class="share-title">Share</span>
                                    </a>
                                    <a target="_blank" href="http://twitter.com/share?url=<?= $currentUrl ?>" class="share-twitter">
                                        <span class="fa fa-twitter icon"></span>
                                        <span class="share-title">Tweet</span>
                                    </a>
                                </div>

                                <div class="v3-detai-steps">
                                    <h2 class="detail-steps-title">4 Steps to Get Cash Back</h2>
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-add-icon.png'); ?>">
                                        Click the 'Deal Request' button
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-finish-icon.png'); ?>">
                                        Buy it on Amazon
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-fill-icon.png'); ?>">
                                        Fill in Amazon order info and approved by us
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-back-icon.png'); ?>">
                                        Get the cash back to your PayPal account
                                    </div>
                                </div>
                                <p style="margin: 20px 0 0;color: #888;">
                                    <span class="error">Tips</span>: The amount of the coupon will be deducted from the cashback if you use a coupon.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom:20px">
                </div>
            </div>
        </div>
    </section>
</div>

<div class="detail-requestbtn-container visible-sm visible-xs">
    <div class="row">
        <?php if ($model['qty'] > 0 && $model['end'] >= time()){?>
            <?php if ($model['type'] == 2){ ?>
                <button type="button" class="btn btn-lg btn-right-content" data-toggle="modal" <?php if (Yii::$app->user->isGuest) {?>data-target=".is-logged-in-modal"<?php }else{?>data-target=".check-deal-review"<?php }?>>
                    <span class="v3-detail-btn-content">Deal Request</span>
                </button>
            <?php }else{?>
                <?php if (Yii::$app->user->isGuest) {?>
                    <button class="btn btn-lg btn-right-content" type="button" data-toggle="modal" data-target=".is-logged-in-modal">
                        <span class="v3-detail-btn-content">Get Coupon</span>
                    </button>
                <?php }else{?>
                    <button class="btn btn-lg btn-right-content" type="button" data-toggle="modal" data-target=".check-deal-review">
                        <span class="v3-detail-btn-content">Get Coupon</span>
                    </button>
                <?php }?>
            <?php }?>
        <?php }else{?>
            <button type="button" class="btn btn-lg btn-right-content" disabled>
                <span class="v3-detail-btn-content">Sold Out</span>
            </button>
        <?php }?>
    </div>
</div>

<div class="modal share-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document" style="width: 100%;margin: 0 !important;">
        <div class="modal-content" style="padding: 1px;border-radius: 0 !important;">
            <div class="detail-social-link">
                <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>" class="share-facebook" style="margin-right: 80px;">
                    <i class="fa fa-facebook-f" aria-hidden="true"></i>
                </a>
                <a target="_blank" href="http://twitter.com/share?url=<?= $currentUrl ?>" class="share-twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            </div>

            <button type="button" class="share-cancel-btn" data-dismiss="modal" aria-label="Close">
                Cancel
            </button>
        </div>
    </div>
</div>

<div class="modal check-deal-review" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body jq-loading" style="padding: 0px;text-align: center;">
                <p class="offer-ends-container" style="margin-bottom: 0;padding: 12px 0;">
                    <span class="secured-title">Try-me Invitation!</span>
                </p>
                <p style="padding: 20px 20px 20px 20px; margin: 0;text-align: left;">
                    We invite you to participate in our Cashback Deals to trial our products, and We'd really appreciate if if you left us an honest review.Reviews are very important for us,and they help other shoppers make informed decisions.
                </p>
                <div class="upOrder-form-btnss" style="display: inline-block;margin: 0">
                    <a href="/" class="btn upOrder-form-btn no-thanks" data-href="#">No thanks</a>
                    <a id="detail-btn" type="button" class="btn upOrder-form-btn make-sure" data-toggle="modal" data-target=".is-logged-in-modal" data-dismiss="modal" aria-label="Close">Sure</a>
                </div>
            </div>
            <div class="check-my-dealss modal-body no-points jq-waiting-one-deal" style="padding: 0 0 30px;display: none;">
                <p class="offer-ends-container">
                    <span class="secured-title"></span>
                </p>
                <p class="sorry-tip-content">
                    Congratulations! You have applied this deal successfully.<br>Upload your order info within one day after getting seller's confirmation.
                </p>
                <a class="btn upOrder-form-btn no-points-btn" href="<?= Url::toRoute('/order/cashback') ?>">Check My Deal</a>
            </div>
            <div class="modal-body jq-got-coupon-code-fail" style="padding: 50px 50px;text-align: center;display: none;">
                <p class="sorry-tip-content" style="font-size: 25px;">Oops</p>
                <p class="sorry-tip-content" id="coupon-response-message"></p>
                <button class="btn upOrder-form-btn no-points-btn jq-dismiss-modal">ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal notice-review" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body jq-loading" style="padding: 0px;text-align: center;">
                <i class="fa fa-check col-xs-12 col-sm-12 col-lg-12" aria-hidden="true" style="font-size: 46px;text-align:center;color:#6c6; display: block; margin: 10px auto"></i>
                <p style="padding: 20px 10px; margin: 0;text-align: center; line-height: 25px">
                    <i class="review-under">The order is under review. </i>
                    Your order will be verified in 4 days. <br>
                    Any questions, Please contact us by <a href="mailto:support@theclubofcashback.com" style="color: #0b72b8">support@theclubofcashback.com</a>
                </p>
                <div class="upOrder-form-btnss" style="display: inline-block;margin: 0">
                    <a id="review-btn" type="button" class="btn upOrder-form-btn my-btn" data-dismiss="modal" aria-label="Close">I've read it</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (Yii::$app->user->isGuest) {
    $param = [
            'type' => $model['type'],
            'cashback' => $model['cashback'],
            'coupon_type' => $model['coupon_type'],
            'coupon' => $model['coupon'],
            'price' => $model['price']
    ];
    ?>
    <?= $this->render('../public/login', $param); ?>
<?php } else {?>
    <?= $this->render('../public/is_login'); ?>
<?php }?>

    <script type="text/javascript">
        <?php $this->beginBlock('js_block') ?>
        showHidePassword('#password');
        showHideRegisterPassword('#register-pass');
        $(document).ready(function(){
            $('#detail-arousel').carousel({
                pause: true,
                interval: 5000
            });
            $("#detail-arousel").on('slide.bs.carousel', function (obj) {
                var index = $(this).find('.item').index(obj.relatedTarget);
                $("#currentItem").text(index+1);
            });
            $("#banner-img").elevateZoom({
                gallery:'gal1',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                preloading: 1,
                loadingIcon: '<?= getImgUrl('images/lazyload.gif'); ?>',
            });
            function touchCarousel() {
                var isTouch=('ontouchstart' in window);
                if(isTouch){
                    $(".carousel").on('touchstart', function(e){
                        var that=$(this);
                        var touch = e.originalEvent.changedTouches[0];
                        var startX = touch.pageX;
                        var startY = touch.pageY;
                        $(document).on('touchmove',function(e){
                            touch = e.originalEvent.touches[0] ||e.originalEvent.changedTouches[0];
                            var endX=touch.pageX - startX;
                            var endY=touch.pageY - startY;
                            if(Math.abs(endY)<Math.abs(endX)){
                                if(endX > 10){
                                    $(this).off('touchmove');
                                    that.carousel('prev');
                                }else if (endX < -10){
                                    $(this).off('touchmove');
                                    that.carousel('next');
                                }
                                return false;
                            }
                        });
                    });
                    $(document).on('touchend',function(){
                        $(this).off('touchmove');
                    });
                }
            }
            touchCarousel();
        });

        $('#choose-sign-up-with-email').click(function(){
            $('#choose-block').hide();
            $('#sign-up-block').show();
            $('#sign-in-block').hide();
        });

        $('#choose-login').click(function(){
            $('#choose-block').hide();
            $('#sign-up-block').hide();
            $('#sign-in-block').show();
        });

        $('.back').click(function(){
            $('#choose-block').show();
            $('#sign-up-block').hide();
            $('#sign-in-block').hide();
        });

        $('#submit-sign-up').click(function(){
            var first_name = $('input[name="first_name"][id="first_name"]').val();
            var last_name = $('input[name="last_name"][id="last_name"]').val();
            var username = $('input[name="username"][id="reg_username"]').val();
            var password = $('input[name="password"][id="register-pass"]').val();
            var captcha = $('input[name="captcha"]').val();
            var is_status = $("#is_subscribe").attr("checked");
            var is_subscribe = is_status == 'checked'?1:0;
            if (first_name == '')
            {
                $("#first_name").focus();
                return false;
            }
            if (last_name == '')
            {
                $("#last_name").focus();
                return false;
            }
            if (username == '')
            {
                $("#reg_username").focus();
                return false;
            }
            if (password == '')
            {
                $("#register-pass").focus();
                return false;
            }
            if (captcha == '')
            {
                $('input[name="captcha"]').focus();
                return false;
            }
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: '/account/register',
                dataType: 'json',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    username: username,
                    password: password,
                    captcha: captcha,
                    is_subscribed: is_subscribe
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Oops',
                            text: response.message,
                            timer: 2000,
                            html: true
                        });
                        window.location.href = location.href;
                    } else {
                        btn.removeClass("onused");
                        swal({
                            type: 'error',
                            title: 'Oops',
                            text: response.message,
                            html: true
                        });
                    }
                },
                error: function(){
                    btn.removeClass("onused");
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });

        $('#submit-sign-in').click(function(){
            var username = $('input[name="username"][id="login_username"]').val();
            var password = $('input[name="password"][id="password"]').val();
            if (username == '')
            {
                $("#login_username").focus();
                return false;
            }
            if (password == '')
            {
                $("#password").focus();
                return false;
            }
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: '/account/login',
                dataType: 'json',
                data: {
                    username: username,
                    password: password
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Oops',
                            text: response.message,
                            timer: 2000,
                            html: true
                        });
                        window.location.href = location.href;
                    } else {
                        btn.removeClass("onused");
                        swal({
                            type: 'error',
                            title: 'Oops',
                            text: response.message,
                            html: true
                        });
                    }
                },
                error: function(){
                    btn.removeClass("onused");
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });
        var collectSwitch = true;
        $('#collect').click(function(){
            if (!collectSwitch) {
                return false;
            }

            requestUrl = $(this).data('url');
            collectSwitch = false;

            $.ajax({
                type: 'get',
                url: requestUrl,
                dataType: 'json',
                data: {
                    "product_id": $('.product_view_id').val()
                },
                success: function(response){
                    collectSwitch = true;
                    if (response.code == 1) {
                        $('#collect').hide();
                        $('#uncollect').show();

                        var totalCount = parseInt($('#total-collect').text());
                        $('#total-collect').text(totalCount+1);
                    }
                },
                error: function(){
                    collectSwitch = true;
                }
            });
        });

        var uncollectSwitch = true;
        $('#uncollect').click(function(){
            if (!uncollectSwitch) {
                return false;
            }

            requestUrl = $(this).data('url');
            uncollectSwitch = false;

            $.ajax({
                type: 'get',
                url: requestUrl,
                dataType: 'json',
                data: {
                    "product_id": $('.product_view_id').val()
                },
                success: function(response){
                    uncollectSwitch = true;
                    if (response.code == 1) {
                        $('#collect').show();
                        $('#uncollect').hide();

                        var totalCount = parseInt($('#total-collect').text());
                        if (totalCount - 1 <= 0) {
                            $('#total-collect').text(0);
                        } else {
                            $('#total-collect').text(totalCount-1);
                        }
                    }
                },
                error: function(){
                    uncollectSwitch = true;
                }
            });
        });

        $('#order-post').click(function(){
            if ($('#current_order_id').val() == ''){
                return false;
            }
            var orderid = $("#order_id").val().trim();
            var reg_order = /^\d{3}-\d{7}-\d{7}\s*$/;
            if(orderid.indexOf('ORDER #') != -1){
                orderid = orderid.split('#')[1].trim();
            }
            if(orderid.length == "0"){
                $('#order_id').focus();
                $("#order-id-tips").html("Order ID can't be empty!");
                return false;
            }else if(!reg_order.test(orderid)){
                $('#order_id').focus();
                $("#order-id-tips").html("Please enter the correct Order ID.<br>e.g. 123-1234567-1234567");
                return false;
            }
            $.ajax({
                type: 'post',
                url: '/order/submit',
                dataType: 'json',
                data: {
                    "order_id": $('#current_order_id').val(),
                    "amz_order_id": orderid
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
                        $('.notice-review').modal('show');
                    } else if (response.code == 205) {
                        window.location.href = '/account/profile?tabtarget=amazon-profile&redirect=<?= $currentUrl ?>';
                    } else {
                        $("#order-id-tips").text(response.message);
                    }
                },
                error: function(){
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });

        $('#coupon-order-post').click(function(){
            if ($('#current_order_id').val() == ''){
                return false;
            }
            var orderid = $("#coupon_order_id").val().trim();
            var reg_order = /^\d{3}-\d{7}-\d{7}\s*$/;
            if(orderid.indexOf('ORDER #') != -1){
                orderid = orderid.split('#')[1].trim();
            }
            if(orderid.length == "0"){
                $('#coupon_order_id').focus();
                $("#coupon-order-id-tips").html("Order ID can't be empty!");
                return false;
            }else if(!reg_order.test(orderid)){
                $('#coupon_order_id').focus();
                $("#coupon-order-id-tips").html("Please enter the correct Order ID.<br>e.g. 123-1234567-1234567");
                return false;
            }
            $.ajax({
                type: 'post',
                url: '/order/submit',
                dataType: 'json',
                data: {
                    "order_id": $('#current_order_id').val(),
                    "amz_order_id": orderid
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
                        $('.notice-review').modal('show');
                    } else if (response.code == 205) {
                        window.location.href = '/account/profile?tabtarget=amazon-profile&redirect=<?= $currentUrl ?>';
                    } else {
                        $("#coupon-order-id-tips").text(response.message);
                    }
                },
                error: function(){
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });

        $("#review-btn").click(function () {
            $('.notice-review').modal('hide');
        });

        $('#detail-btn').click(function (){
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: "post",
                url: "<?= Url::toRoute('order/deal') ?>",
                data: {
                    "activity_id": $('#activity_view_id').val(),
                    "product_id": $('#product_view_id').val(),
                    "tag": $("#tag").val(),
                    "sign": $("#sign").val()
                },
                dataType: "json",
                success: function(response){
                    btn.removeClass("onused");
                    var status = response.status;
                    $('.model-close').css('color', '#ccc');
                    switch(status) {
                        case 0:
                            $('.modal-body').hide();
                            $('.jq-error').show();
                            break;
                        case 1:
                            $('.modal-body').hide();
                            $('.jq-get-quota').show();
                            $('#purchase-link').attr('href', response.link);
                            $('#purchase-link').data('href', response.link);
                            $('#purchase-link').data('asin', response.asin);
                            $('.deal-expires-time').attr('data-expired-time', response.expired_at);
                            $('#current_order_id').val(response.order_id);
                            $('#sold-by').text(response.sold_by);
                            break;
                        case 2:
                            $('.modal-body').hide();
                            $('#show-coupon-code').text(response.coupon_code);
                            $('#coupon-purchase-link').attr('href', response.link);
                            $('#coupon-purchase-link').data('href', response.link);
                            $('#coupon-purchase-link').data('asin', response.asin);
                            $('#current_order_id').val(response.order_id);
                            $('#coupon-sold-by').text(response.sold_by);
                            $('.jq-got-coupon-code-success').show();
                            var clipboard = new ClipboardJS('#show-coupon-code', {
                                text: function() {
                                    return response.coupon_code;
                                }
                            });
                            clipboard.on('success', function(e) {
                                swal({
                                    type: 'success',
                                    title: '',
                                    text: 'Copied the code successfully. Buy it on Amazon now!'
                                });
                            });
                            break;
                        case 3:
                            $('.modal-body').hide();
                            $('.jq-noquota').show();
                            break;
                        case 4:
                            $('.modal-body').hide();
                            $('.jq-seller-deal').show();
                            $('#seller_deal_url').attr('href', response.deals_url);
                            break;
                        case 5:
                            $('.modal-body').hide();
                            $('.jq-no-points').show();
                            break;
                        case 6:
                            $('.modal-body').hide();
                            $('.jq-waiting-one-deal').show();
                            $('#waiting_deal_url').attr('href', response.deals_url);
                            break;
                        case 7:
                            $('.modal-body').hide();
                            $('.jq-hover-one-deal').show();
                            $('#hover_deal_url').attr('href', response.deals_url);
                            break;
                        case 8:
                            $('.modal-body').hide();
                            $('.jq-no-review-deal').show();
                            $('#review_product_img').attr('src', response.product_image);
                            $('#review_product_name').text(response.product_name);
                            $('#amazon_review_url').attr('href', response.amazon_url);
                            break;
                    }
                },
                error: function(){
                    btn.removeClass("onused");
                    $('.modal-body').hide();
                    $('.jq-error').show();
                }
            });
        });

        $("#toggle").click(function () {
            var is = $("#is_subscribe").prop("checked");
            if (is) {
                $("#is_subscribe").attr("checked", false);
                $(this).css({color:'#f93'});
            } else {
                $("#is_subscribe").attr("checked", true);
                $(this).css({color:'#fff'});
            }
        });

        /*$('#coupon-purchase-link,#purchase-link').click(function (){
            var asin = $(this).data('asin'),
                link = $(this).data('href'),
                AMZ_PURCHASE_LINK_WEB = "https://www.amazon.com/dp/",
                AMZ_PURCHASE_LINK_APP = "com.amazon.mobile.shopping.web://www.amazon.com/dp/",
                AMZ_DOMAIN = "amazon.com",
                webLinkTag = "tag=ddddddd-20",
                separator = (link && link.indexOf('?') !== -1) ? "&" : "?",
                webPurchaseLink = link ? link : AMZ_PURCHASE_LINK_WEB + asin,
                appPurchaseLink = AMZ_PURCHASE_LINK_APP + asin;
            if (webPurchaseLink.indexOf(AMZ_DOMAIN) !== -1) {
                //webPurchaseLink += (separator + webLinkTag);
            }
            openWithApp(appPurchaseLink, webPurchaseLink);
        });*/

        $('.jq-dismiss-modal').click(function(){
            $('.is-logged-in-modal').modal('hide');
        });

        $('.is-logged-in-modal').on('hidden.bs.modal', function (e) {
            $('.modal-body').hide();
            $('.jq-loading').show();
        });
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>