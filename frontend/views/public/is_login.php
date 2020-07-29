<?php
use yii\helpers\Url;
?>
<div class="modal is-logged-in-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            <div class="modal-body jq-loading" style="padding: 10px 0 30px;">
                <img class="loading-img" src="<?= getImgUrl('images/loading.gif'); ?>">
                <p style="margin: 20px 0 130px; text-align: center;">Getting quota, please wait ...</p>
            </div>

            <div class="modal-body jq-got-coupon-code-success" style="padding: 50px 50px; text-align: center; display: none;">
                <p style="font-size: 18px; margin-bottom: 10px; color: #666;">Congratulations on getting this coupon code!</p>
                <p style="font-size: 18px; margin-bottom: 10px; color: #666;">Uploading an Amazon Order ID to Cashbackbase after purchase gives you more chance to earn points for purchasing cashback deals!</p>
                <p style="font-size: 18px; margin-top: 25px; color: #666;">Your coupon code is as follows:</p>
                <p style="margin-top: 30px;">
                    <label class="label jq-select-code" id="show-coupon-code" style="background-color: #f93; font-size: 22px; padding: 10px;cursor: pointer;"></label>
                </p>
                <a class="btn btn-link" id="purchase-link" href="" target="_blank" style="font-size: 18px; color: #1c84c6; float: left;">Go And Purchase Now</a>
                <a class="btn btn-link" href="/customer/coupondeals" target="_blank" style="font-size: 18px; color: #1c84c6; float: right;">Check My Coupons</a>
            </div>

            <div class="modal-body jq-got-coupon-code-fail" style="padding: 50px 50px; text-align: center; display: none;">
                <p class="sorry-tip-content" style="font-size: 25px;">Oops</p>
                <p class="sorry-tip-content" id="coupon-response-message"></p>
                <button class="btn upOrder-form-btn no-points-btn jq-dismiss-modal">ok</button>
            </div>

            <div class="modal-body get-quota jq-get-quota" style="padding: 0 0 30px;display: none;">
                <p class="offer-ends-container" style="margin-bottom: 0;padding: 24px 0;">
                    <span>
                        <span class="secured-title">A cashback deal has been secured for you.</span>
                        <br>
                        <span class="secured-tip">Follow the steps below to get $ 102.99 cash back.</span>
                    </span>
                </p>
                <p class="secured-expires-tip" style="display: block; line-height: 36px;">
                </p>
                <div class="secured-order-form">
                    <p class="upOrder-step-title">
                        <span>STEP 1:</span>
                        <a href="#" target="_blank" class="btn go-amazon-btn amazon_link">Go to Amazon to buy it now!</a>
                        <span style="font-size: 15px;display: inline-block;margin-left: 98px;margin-top: 5px;font-weight: 400;">
                            Sold by <a href="https://www.amazon.com/sp?_encoding=UTF8&seller=AVL62AP02U78R" target="_blank" style="color: #337ab7;">DT-TECH</a>
                        </span>
                    </p>
                    <div>
                        <p class="upOrder-step-title" style="margin-bottom: 10px;">STEP 2:<span style="margin-left: 20px;">Fill in your Amazon order info.</span></p>
                        <form id="upOrder-form" enctype="multipart/form-data" method="post" action="#">
                            <div class="form-group upOrder-form-group">
                                <label class="form-group-tip" for="order_id"><span class="mandatory-identification">* </span>Order ID:</label>
                                <input class="form-control form-group-input" id="user-submitted-title" type="text" name="order_id" value="" placeholder="e.g. 123-1234567-1234567">
                                <div class="form-group-error error" id="order-id-tips"></div>
                            </div>
                            <div class="form-group upOrder-form-group">
                                <label class="form-group-tip" for="user-submitted-custom"><span class="mandatory-identification">* </span>Phone:</label>
                                <input class="form-control form-group-input" id="user-submitted-custom" type="text" name="phone" value="" placeholder="">
                                <div class="error" id="phone-tips"></div>
                            </div>
                            <div class="form-group upOrder-form-group">
                                <label class="form-group-tip" for="upOrder-paypal"><span class="mandatory-identification">* </span>Your Paypal:</label>
                                <input class="form-control form-group-input" id="upOrder-paypal" type="text" name="paypal" value="" placeholder="For cashback">
                                <div class="error" id="paypal-tips"></div>
                            </div>
                            <div class="form-group upOrder-file-group">
                                <div id="preview-img" style="display: none;width: 100%; height: 100%;"></div>

                                <input id="order-image" name="order_image" type="file" accept="image/png, image/jpeg, image/gif, image/jpg" size="25" onchange="changepic(this)" class="usp-input usp-clone" data-parsley-excluded="true">
                                <div class="file-content-container">
                                    <label for="order-image" class="upOrder-file-tip" style="display: block;">
                                        Upload a screenshot of Amazon order.
                                        <br>
                                        (Size less than 4 M)
                                    </label>
                                    <img class="file-up-icon" src="<?= getImgUrl('images/file-up-icon.png'); ?>">
                                    <div class="error" id="maxsize-error"></div>
                                </div>
                            </div>
                            <div class="form-group-error error" id="image-tips"></div>

                            <div class="upOrder-form-btnss">
                                <a type="button" class="btn upOrder-form-btn jq-cancel-order operation-btn" id="abandon-deal-btn" data-href="#">Cancel this deal</a>
                                <a type="button" class="btn upOrder-form-btn jq-submit-order" id="user-submitted-post" >Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-body no-quota jq-noquota" style="padding: 0 0 30px;display: none;">
                <p class="offer-ends-container" style="margin-bottom: 0;padding: 24px 0;">
                    <span class="secured-title">Sorry. This product is currently out of stock...</span>
                </p>
                <img class="sorry-tip-icon" src="<?= getImgUrl('images/sorry-tip.jpg'); ?>">
                <p class="sorry-tip-content">SORRY.This product is currently out of stock.<br>Please go back to the homepage to grab other deals.
                </p>
                <a class="btn upOrder-form-btn no-points-btn" href="/" style="width: 200px;">Back to Homepage</a>
            </div>

            <div class="modal-body no-points jq-no-points" style="padding: 10px 0 30px; display: none;">
                <p class="sorry-tip-content">
                    Sorry, your available points are not enough.<br>
                    Please find a way to get more points.
                </p>
                <a class="btn upOrder-form-btn no-points-btn" href="/account/mypoints">Get Points</a>
            </div>

            <div class="modal-body jq-error" style="padding: 50px 0 30px;display: none;">
                <p class="modal-tip-point">There was a mistake, try again later!</p>
            </div>

            <div class="modal-body no-points jq-waiting-one-deal" style="padding: 0 0 30px; display: none;">
                <p class="offer-ends-container">
                    <span class="secured-title"></span>
                </p>
                <p class="sorry-tip-content">
                    Congratulations! You have applied this deal successfully.<br />Upload your order info within one day after getting seller's confirmation.
                </p>
                <p style="text-align: center">
                    <a class="btn upOrder-form-btn no-points-btn" href="/customer/cashback">Check My Deal</a>
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
