<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<section class="login_box">
    <div class="container">
        <div class="row" style="margin-bottom: 30px;">
            <div class="signin-container col-lg-6 col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #EEEEEE">
                <div class="ibox" style="max-width: 400px; margin: 0 auto 50px;">
                    <div class="ibox-title text-center" style="background-color: #f93; color: white; border: 1px solid #f2f2f2; padding: 15px 0; border-bottom: 0; font-size: 1.6em;">
                        Create a free account
                    </div>
                    <div class="ibox-content" style="border: 1px solid #f2f2f2;">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                            <div class="form-group email-container">
                                <input type="text" name="first_name" class="form-control" id="first_name" value="" placeholder="First Name">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>

                                <div id="mailBox" style="top:44px;left:0px;width:336px"></div></div>
                            <div class="form-group email-container">
                                <input type="text" name="last_name" class="form-control" id="last_name" value="" placeholder="Last Name">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>

                                <div id="mailBox" style="top:44px;left:0px;width:336px"></div></div>

                            <div class="form-group email-container">
                                <input type="text" name="email" class="form-control" id="email" value="" placeholder="Email">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>

                                <div id="mailBox" style="top:44px;left:0px;width:336px"></div></div>
                            <div class="form-group" style="position: relative;">
                                <input type="password" name="password" class="form-control" id="register-pass" value="" placeholder="Password">
                                <div class="show-hide-icon" id="show-btn">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </div>
                                <div class="show-hide-icon" id="hide-btn" style="display: none">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="form-group email-container">
                                <input type="text" name="captcha" class="form-control verify-code" placeholder="*Enter code on the right" style="margin-top: 0 !important;">
                                <img id="captcha" src="https://www.cashbackbase.com/captcha/flat?tzARVT10" onclick="this.src='/captcha/flat?'+Math.random()">
                                <br>
                                <span>
                                        Click on the picture to change one.
                                    </span>
                                <div id="mailBox" style="top:44px;left:0px;width:336px"></div></div>
                            <div class="form-group">
                                <p style="margin-top: 10px;margin-bottom: 30px;font-size: 14px;">By clicking “Sign up”, I agree to cashbackbase's
                                    <a class="agreement" target="_blank" href="https://www.cashbackbase.com/terms" style="color:#2b95ff;">terms of service</a>
                                    and
                                    <a class="agreement" target="_blank" href="/terms?tabtarget=privacy" style="color:#2b95ff;">privacy statement</a> and I also agree that only open one account per person.
                                </p>
                            </div>
                            <div class="text-center">
                                <?= Html::button('Sign Up', ['class' => 'btn upOrder-form-btn ladda-button', 'id' => 'submit-sign-up', 'style' => 'width: 100%;height: 43px;']) ?>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="btn upOrder-form-btn" href="/account/login" style="width: 100%;height: 43px; line-height: 40px;">Login</a>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                <img src="<?= getImgUrl('images/sigin-icon.png'); ?>" style="margin: 0px auto 0;max-width: 100%;display: block;">
            </div>
        </div>
    </div>
</section>
