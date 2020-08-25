<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\captcha\Captcha;

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
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" id="first_name" value="" placeholder="First Name">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control" id="last_name" value="" placeholder="Last Name">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>
                            </div>
                            <div class="form-group email-container">
                                <input type="text" name="username" class="form-control" id="username" value="" placeholder="Email">
                                <div class="input-clear">
                                    <span>x</span>
                                </div>
                            </div>
                            <div class="form-group" style="position: relative;">
                                <input type="password" name="password" class="form-control" id="register-pass" value="" placeholder="Password">
                                <div class="show-hide-icon" id="show-btn">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </div>
                                <div class="show-hide-icon" id="hide-btn" style="display: none">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="captcha" class="form-control verify-code" placeholder="*Enter code on the right" style="margin-top: 0 !important;">
                                <img id="captcha" src="<?= Url::toRoute('/site/captcha');?>" onclick="this.src='/captcha?'+Math.random()">
                                <br>
                                <span style="margin-top: 3px">
                                        Click on the picture to change one.
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="login-read">
                                    <input type="checkbox" name="subscribe" id="is_subscribe" checked>
                                    <i id="toggle">✓</i>
                                    Subscribe to the CashBackClub Newsletter
                                </label>
                            </div>
                            <div class="form-group">
                                <p style="margin-top: 10px;margin-bottom: 30px;font-size: 14px;">By clicking “Sign up”, I agree to CashBackClub's
                                    <a class="agreement" target="_blank" href="<?= Url::toRoute('/site/terms');?>" style="color:#2b95ff;">terms of service</a>
                                    and
                                    <a class="agreement" target="_blank" href="<?= Url::toRoute(['/site/terms', 'tabtarget'=>'privacy']);?>" style="color:#2b95ff;">privacy statement</a> and I also agree that only open one account per person.
                                </p>
                            </div>
                            <div class="text-center">
                                <?= Html::button('Sign Up', ['class' => 'btn upOrder-form-btn ladda-button', 'id' => 'submit-sign-up', 'style' => 'width: 100%;height: 43px;']) ?>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="btn upOrder-form-btn" href="<?= Url::toRoute('/site/login');?>" style="width: 100%;height: 43px; line-height: 40px;">Login</a>
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
<div class="modal inmodal fade in" id="first-access-register-tips" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInDown">
            <div class="modal-body" style="padding: 0 0 20px;">
                <p class="offer-ends-container">
                    <span class="secured-title">
                        NOTICE!
                    </span>
                </p>
                <p class="sorry-tip-content" style="text-align: left; line-height: 24px; padding: 0 20px">
                    1.Please follow our order process. Check the <a href="/faq" target="_blank" style="color: #f93">User Guide</a> for detail.<br>
                    2.If you have any questions about the product on CashBackClub, please contact CashBackClub’s customer service first instead of leaving a negative review directly on amazon.
                </p>
                <p style="text-align: center">
                    <a class="btn upOrder-form-btn my-btn" id="skip-register-popup" href="#">Confirm</a>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('js') ?>
    var flag = localStorage.getItem('shown-register-popup');
    if (!flag){
        $('#first-access-register-tips').modal('show');
    }
    $(document).ready(function(){
        var params = getTrace();
        if (window.requestIdleCallback) {
            requestIdleCallback(function () {
                fpid(params);
            });
        } else {
            setTimeout(function () {
                fpid(params);
            }, 500);
        }
        $('#username').autoMail({
            emails:['gmail.com','yahoo.com','hotmail.com','outlook.com']
        });
        showHidePassword('#password');
        inputClear('#username');
        $('#skip-register-popup').click(function(){
            $('#first-access-register-tips').modal('hide');
            localStorage.setItem('shown-register-popup', 'true');
        });
        $("#submit-sign-up").click(function(){
            var first_name = $('input[name="first_name"][id="first_name"]').val();
            var last_name = $('input[name="last_name"][id="last_name"]').val();
            var username = $('input[name="username"][id="username"]').val();
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
                $("#username").focus();
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
                url: $("#form-signup").attr("action"),
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
                        swal({
                            type: 'success',
                            title: 'Oops',
                            text: response.message,
                            timer: 2000,
                            html: true
                        });
                        window.location.href = response.href;
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
        $("#toggle").click(function () {
            var is = $("#is_subscribe").prop("checked");
            if (is) {
                $("#is_subscribe").attr("checked", false);
                $(this).css({color:'#f93'});
            } else {
                $("#is_subscribe").attr("checked", true);
                $(this).css({color:'#fff'});
            }
        })
    });
    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END); ?>
</script>