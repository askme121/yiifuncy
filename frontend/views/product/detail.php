<?php
$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div id="detail-banner">
    <section class="container">
        <div class="row detail-contents">
            <input type="hidden" class="product_view_id" value="<?= $model['id']?>">
            <ul>
                <li class="deal-detail-content col-xs-12 detail-contents-1" style="padding: 0;">
                    <div id="deal-detail-content" style="position: relative;top: -100px;"></div>
                    <div id="detail-arousel" class="carousel slide">
                        <div style="position: relative;">
                            <div id="wish-btn-container">
                                <div class="wish-icon-container">
                                    <?php if (Yii::$app->user->isGuest) {?>
                                        <img class="wish-icon" src="<?= getImgUrl('images/wish-icon.png') ?>" data-toggle="modal" data-target=".is-logged-in-modal">
                                    <?php } else {?>
                                        <img class="wish-icon" id="collect" data-url=""  src="<?= getImgUrl('images/wish-icon.png') ?>" style="display: block;">
                                        <img class="wish-icon" id="uncollect" data-url=""  src="<?= getImgUrl('images/wish-icon-active.png') ?>" style="display:none ;">
                                    <?php }?>
                                </div>
                                <font id="total-collect">0</font>
                            </div>
                        </div>

                        <h1 class="banner-title-detail">
                            <?= $model['product']['name']; ?>
                        </h1>

                        <div style="overflow: hidden;">
                            <ul class="prime-acount-list carousel-acount-list col-xs-8" style="font-size: 13px;">
                                <li class="account-left" style="width: 26%;">
                                    <p class="prime-value"><?= $model['qty'] ?></p>
                                    <p class="prime-tile">Left</p>
                                </li>
                                <li class="space-vertical-lines"></li>
                                <li class="account-off" style="width: 36%;">
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                    <p class="prime-tile">Cashback</p>
                                </li>
                                <li class="space-vertical-lines"></li>
                                <li class="account-fullfill" style="width: 36%;">
                                    <p class="fullfill-methed">Fullfilled by</p>
                                    <p class="prime-tile">
                                        <img class="prime-amz-logo" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>" style="height: 18px;">
                                    </p>
                                </li>
                            </ul>
                            <div class="prime-value-info col-xs-4" style="margin-top: 10px;padding: 0 10px 0 0;">
                                <span class="origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span>
                                <span class="now-price" style="margin-left:5px;font-size: 16px;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= ($model['price']-$model['cashback']) ?></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-xs-12 describe-container detail-contents-2" style="overflow: hidden;">
                    <div class="col-xs-12 detai-steps">
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
                        <?//= $description; ?>
                    </div>
                </li>
            </ul>
        </div>
    </section>
</div>

<div class="detail-requestbtn-container">
    <div class="row">
        <?php if ($model['qty']>0){?>
            <button type="button" class="btn btn-lg btn-right-content" data-toggle="modal" <?php if (Yii::$app->user->isGuest) {?>data-target=".is-logged-in-modal"<?php }else{?>data-target=".check-deal-review"<?php }?>>
                <span class="v3-detail-btn-content">Deal Request</span>
            </button>
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
                    <span class="secured-title">Congratulations</span>
                </p>
                <p style="padding: 20px 20px 20px 0; margin: 0;text-align: center;">We’d really appreciate it if you left us an honest review.
                    <br />
                    Reviews are very important for us, and they help other shoppers make informed decisions.</p>
                <div class="upOrder-form-btnss" style="display: inline-block;margin: 0">
                    <a href="/" class="btn upOrder-form-btn operation-btn" data-href="#" style="height: 60px !important;line-height: 60px !important;display: inline-block;float: unset;margin: 0;width: 160px; background-color: #ccc !important;">No thanks</a>
                    <a id="detail-btn1" type="button" class="btn upOrder-form-btn" style="height: 60px !important;line-height: 60px !important;display: inline-block;font-size: 28px;width: 160px;margin-left: 20px;" data-toggle="modal" data-target=".is-logged-in-modal" data-dismiss="modal" aria-label="Close">Sure</a>
                </div>
            </div>
        </div>
    </div>
</div>
