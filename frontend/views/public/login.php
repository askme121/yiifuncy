<?php
use yii\helpers\Url;
?>
<div class="modal is-logged-in-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 1px;">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="dialog-title-container">
                <h3 class="get-offf-title">
                    <?php if ($type == 1){?>
                        <?php if ($coupon_type == 1){?>
                            <?= $coupon ?> %
                        <?php }else{?>
                            <?= number_format($coupon/$price*100, 2) ?> % Off
                        <?php }?>
                    <?php } else if ($type == 2){?>
                        <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $cashback ?> CASH BACK!
                    <?php } else if ($type == 3){?>
                        <?php if ($coupon_type == 1){?>
                            <?= $coupon ?> %
                        <?php }else{?>
                            <?= number_format($coupon/$price*100, 2) ?> %
                        <?php }?>
                         Off + <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $cashback ?> CASH BACK!
                    <?php }?>
                </h3>
                <p class="get-offf-tip">Login to enjoy your offer for this product!</p>
            </div>
            <div id="sign-up-block" style="width: 80%; margin: 20px auto; display: none;">
                <form class="form-container" id="register-form"  style="width: auto; padding: 0; max-width: 100%; margin: 0 auto;">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" id="first_name" value="" placeholder="First Name" style="width: 50%; float: left;">
                        <input type="text" name="last_name" class="form-control" id="last_name" value="" placeholder="Last Name" style="width: 50%; float: left; margin-bottom: 15px;">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="reg_username" value="" placeholder="Email">
                        <div class="input-clear">
                            <span>x</span>
                        </div>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <input type="password" name="password" class="form-control" id="register-pass" value="" placeholder="Password">
                        <div class="show-hide-icon" id="register-show-btn">
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </div>
                        <div class="show-hide-icon" id="register-hide-btn" style="display: none">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="captcha"  class="form-control verify-code" placeholder="*Enter code" style="margin-top: 0 !important;width: 150px !important;">
                        <img id="captcha" src="<?php echo Url::toRoute('/site/captcha').'?'.md5(time() . mt_rand(1,10000));?>" onclick="this.src='<?= Url::toRoute('/site/captcha') ?>?'+Math.random()">
                        <span>
                            <a class="change-code-btn" href="javascript:;" onclick="$('#captcha').attr('src', '<?= Url::toRoute('/site/captcha'); ?>?'+Math.random());">Change</a>
                        </span>
                    </div>
                    <div class="form-group">
                        <p style="margin-top: 10px; margin-bottom: 0; font-size: 14px;">By clicking “Sign up”, I agree to CashBackClub's
                            <a class="agreement" target="_blank" href="<?= Url::toRoute('/site/terms') ?>" style="color:#2b95ff;">terms of service</a>
                            and
                            <a class="agreement" target="_blank" href="<?= Url::toRoute(['/site/terms', 'tabtarget'=>'privacy']);?>" style="color:#2b95ff;">privacy statement</a> and I also agree that only open one account per person.
                        </p>
                    </div>
                    <div class="text-center">
                        <button type="button" id="submit-sign-up" class="btn upOrder-form-btn ladda-button" data-style="zoom-in" style="width: 100%; height: 43px; font-weight: 700; font-size: 16px; background-color: #ed5565 !important;">Sign Up</button>
                        <hr style="margin: 15px 0;">
                        <button type="button" id="choose-login" class="btn upOrder-form-btn" style="width: 100%; height: 43px; font-weight: 700; font-size: 16px;">Log In</button>
                    </div>
                </form>
            </div>
            <div id="sign-in-block" style="width: 80%; margin: 20px auto;">
                <form class="form-container" id="login-form"  style="width: auto; padding: 0; max-width: 100%; margin: 0 auto;">
                    <div class="form-group email-container">
                        <input type="text" name="username" class="form-control" id="login_username" autocomplete="false" value="" placeholder="Email">
                        <div class="input-clear">
                            <span>x</span>
                        </div>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <input type="password" name="password" class="form-control" id="password" value="" placeholder="Password">
                        <div class="show-hide-icon" id="show-btn">
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </div>
                        <div class="show-hide-icon" id="hide-btn" style="display: none">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                    </div>
                    <p class="forget-tips" style="text-align: right; margin: 10px 0;">
                        <a href="<?= Url::toRoute('/site/request-password-reset')?>" class="forget_password" style="color: #3399ff;font-size: 12px;">Forgot Password?</a>
                    </p>
                    <button type="button" class="btn upOrder-form-btn ladda-button" id="submit-sign-in" data-style="zoom-in" style="width: 100%; height: 43px; font-weight: 700; font-size: 16px;">Sign In</button>
                    <hr style="margin: 15px 0;">
                    <button type="button" class="btn upOrder-form-btn" id="choose-sign-up-with-email" style="width: 100%; height: 43px; font-weight: 700; font-size: 16px; background-color: #ed5565 !important;">Create a free account</button>
                </form>
            </div>
        </div>
    </div>
</div>