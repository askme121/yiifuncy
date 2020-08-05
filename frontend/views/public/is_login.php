<?php
use yii\helpers\Url;
?>
<div class="modal is-logged-in-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <input type="hidden" id="current_order_id" value="">
            <div class="modal-body jq-loading">
                <img class="loading-img" src="<?= getImgUrl('images/loading.gif'); ?>">
                <p style="margin: 20px 0 15px; text-align: center;">Getting quota, please wait ...</p>
            </div>

            <div class="modal-body jq-got-coupon-code-success" style="padding: 0; display:none;">
                <p class="offer-ends-container" style="margin-bottom: 0; padding: 24px 10px 10px 10px;">
                    <span class="secured-title" style="text-align: center; display: block">Congratulations!</span>
                    <span class="secured-title" style="line-height: 15px; text-align: center; display: block; margin-top: 10px; margin-bottom: 10px">You deal application is successfully.</span>
                    <span class="secured-tip">Follow the guidance below to get your cash back.</span>
                    <br>
                    <span class="secured-tip">Upload your order info within 24 hours!</span>
                </p>
                <p class="secured-expires-tip" style="display: block; line-height: 36px;">
                </p>
                <div class="secured-order-form">
                    <p class="upOrder-step-title">
                        <span>STEP 1:</span>
                    </p>
                    <small style="display:block;margin-top: -15px; text-align: center; color: #999">(click to copy the coupon code)</small>
                    <button class="go-amazon-btn" id="show-coupon-code"></button>
                    <p class="upOrder-step-title">
                        <span>STEP 2:</span>
                    </p>
                    <a id="coupon-purchase-link" href="#" target="_blank" class="go-amazon-btn amazon_link">Buy it on Amazon now!</a>
                    <div>
                        <p class="upOrder-step-title">STEP 3:</p>
                        <form class="upOrder-form" enctype="multipart/form-data" method="post" action="#">
                            <div class="form-group upOrder-form-group">
                                <label class="form-group-tip" for="coupon_order_id"><span class="mandatory-identification">* </span>Order ID:</label>
                                <input class="form-control form-group-input" id="coupon_order_id" type="text" name="coupon_order_id" value="" placeholder="Enter your Amazon order info">
                                <div class="form-group-error error" id="coupon-order-id-tips"></div>
                            </div>
                            <div class="upOrder-form-btnss">
                                <a type="button" class="btn upOrder-form-btn jq-cancel-order operation-btn" id="coupon-abandon-deal-btn" data-href="#" style="background-color: #fff;margin-bottom: 0;color: #f93 !important; float: left">Cancel deal</a>
                                <a type="button" class="btn upOrder-form-btn jq-submit-order" style="float: right" id="coupon-order-post">Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-body jq-got-coupon-code-fail" style="padding: 50px 50px; text-align: center; display:none;">
                <p class="sorry-tip-content" style="font-size: 25px;">Oops</p>
                <p class="sorry-tip-content" id="coupon-response-message"></p>
                <button class="btn upOrder-form-btn no-points-btn jq-dismiss-modal">ok</button>
            </div>

            <div class="modal-body get-quota jq-get-quota" style="padding: 0;display:none;">
                <p class="offer-ends-container" style="margin-bottom: 0; padding: 24px 10px 10px 10px;">
                    <span class="secured-title" style="text-align: center; display: block">Congratulations!</span>
                    <span class="secured-title" style="line-height: 15px; text-align: center; display: block; margin-top: 10px; margin-bottom: 10px">You deal application is successfully.</span>
                    <span class="secured-tip">Follow the guidance below to get your cash back.</span>
                    <br>
                    <span class="secured-tip">Upload your order info within 24 hours!</span>
                </p>
                <p class="secured-expires-tip" style="display: block; line-height: 36px;">
                </p>
                <div class="secured-order-form">
                    <p class="upOrder-step-title">
                        <span>STEP 1:</span>
                    </p>
                    <a id="purchase-link" href="#" target="_blank" class="go-amazon-btn amazon_link">Buy it on Amazon now!</a>
                    <div>
                        <p class="upOrder-step-title" style="margin-bottom: 10px;">STEP 2:</p>
                        <form class="upOrder-form" enctype="multipart/form-data" method="post" action="#">
                            <div class="form-group upOrder-form-group">
                                <label class="form-group-tip" for="order_id"><span class="mandatory-identification">* </span>Order ID:</label>
                                <input class="form-control form-group-input" id="order_id" type="text" name="order_id" value="" placeholder="Enter your Amazon order info">
                                <div class="form-group-error error" id="order-id-tips"></div>
                            </div>
                            <div class="upOrder-form-btnss">
                                <a type="button" class="btn upOrder-form-btn jq-cancel-order operation-btn" id="abandon-deal-btn" data-href="#" style="background-color: #fff;margin-bottom: 0;color: #f93 !important; float: left">Cancel deal</a>
                                <a type="button" class="btn upOrder-form-btn jq-submit-order" id="order-post" >Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-body no-quota jq-noquota" style="padding: 0 0 20px;display: none;">
                <p class="sorry-tip-content">SORRY.This product is currently out of stock.<br>Please go back to the homepage to grab other deals.
                </p>
                <div class="text-center">
                    <a class="btn upOrder-form-btn" href="/" style="width: 200px;">Back to Homepage</a>
                </div>
            </div>

            <div class="modal-body no-points jq-no-points" style="padding: 10px 0 30px; display: none;">
                <p class="sorry-tip-content">
                    Sorry, your available points are not enough.<br>
                    Please find a way to get more points.
                </p>
                <div class="text-center">
                    <a class="btn upOrder-form-btn no-points-btn" href="/account/mypoints">Get Points</a>
                </div>
            </div>

            <div class="modal-body jq-error" style="padding: 50px 0 30px;display: none;">
                <p class="modal-tip-point">There was a mistake, try again later!</p>
            </div>

            <div class="modal-body no-points jq-waiting-one-deal" style="padding: 0 0 30px; display: none;">
                <p class="offer-ends-container">
                    <span class="secured-title"></span>
                </p>
                <p class="sorry-tip-content">
                    Congratulations! You have applied this deal successfully.<br />Upload your order info within 24 hours after getting seller's confirmation.
                </p>
                <p style="text-align: center">
                    <a class="btn upOrder-form-btn no-points-btn" id="waiting_deal_url" href="#">Check My Deal</a>
                </p>
            </div>

            <div class="modal-body jq-hover-one-deal" style="padding: 0 0 30px; display: none;">
                <p class="offer-ends-container">
                    <span class="secured-title"></span>
                </p>
                <p class="sorry-tip-content">
                    Sorry! You have unfinished deals.<br />Upload your order info within 24 hours after getting seller's confirmation.
                </p>
                <p style="text-align: center">
                    <a class="btn upOrder-form-btn no-points-btn" id="hover_deal_url" href="#">Check My Deal</a>
                </p>
            </div>

            <div class="modal-body jq-no-review-deal" style="padding: 0 0 30px; display: none;">
                <p class="offer-ends-container">
                    <span class="secured-title">Your Opinion Matters!</span>
                </p>
                <p class="sorry-tip-content">
                    We'd really appreciate it if you could leave us an honest review of the last order. Your opinion matters to us and they would help other shoppers make informed decisions.
                </p>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 review_product">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <img src="" id="review_product_img" class="img-responsive product_img" />
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                        <p id="review_product_name" class="product_name"></p>
                        <img class="img-responsive star_img" src="<?= getImgUrl('images/star.png') ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
                <p style="text-align: center; margin-top: 30px">
                    <a class="btn upOrder-form-btn no-points-btn" id="amazon_review_url" href="#">Write A Review</a>
                </p>
            </div>

            <div class="modal-body no-points jq-seller-deal" style="padding: 0 0 30px; display: none;">
                <p class="offer-ends-container" style="background-color: #ed5565;">
                    <span class="secured-title"></span>
                </p>
                <p class="sorry-tip-content">
                    Request failed.
                    <br />
                    Buyers cannot buy products from the same seller twice within 30 days
                </p>
            </div>
        </div>
    </div>
</div>
