<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<section class="login_box">
    <div class="container">
        <div class="row" style="margin-bottom: 30px;">
            <div class="signin-container col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="ibox" style="max-width: 400px; margin: 0 auto 50px;">
                    <div class="ibox-title text-center" style="background-color: #f93; color: white; border: 1px solid #f2f2f2; padding: 15px 0; border-bottom: 0; font-size: 1.6em;">
                        Login
                    </div>
                    <div class="ibox-content" style="border: 1px solid #f2f2f2;">
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-container']); ?>
                        <div class="form-group email-container">
                            <input type="text" name="username" class="form-control" id="username" autocomplete="false" value="" placeholder="Email">
                            <div class="input-clear">
                                <span>x</span>
                            </div>
                            <div id="mailBox" style="top:44px;left:0px;width:336px"></div>
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
                        <?= Html::button('Sign In', ['class' => 'btn upOrder-form-btn ladda-button', 'id' => 'submit-sign-in', 'style' => 'width: 100%;']) ?>
                        <!--<hr>
                        <button type="button" class="btn upOrder-form-btn" id="LoginWithAmazon" style="width: 100%; height: 32px; background-color: #f98;">Sign In With Amazon</button>-->
                        <p style="margin: 10px 0 0 0;">
                            <span style="font-size: 12px; margin-right: 10px;">Not a member?</span><a href="<?= Url::toRoute('/site/signup');?>" style="color: #3399ff; font-size: 12px;">Join for free</a>
                        </p>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-sm hidden-xs" style="border-left: 1px solid #EEEEEE">
                <img src="<?= getImgUrl('images/sigin-icon.png'); ?>" style="margin: 0px auto 0;max-width: 100%;margin-bottom: 50px;display: block;">
            </div>
        </div>
    </div>
</section>
<script>
    <?php $this->beginBlock('js') ?>
    $(document).ready(function(){
        $("#submit-sign-in").click(function(){
            var username = $('input[name="username"][id="username"]').val();
            var password = $('input[name="password"][id="password"]').val();
            if (username == '')
            {
                $("#username").focus();
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
                url: $("#login-form").attr("action"),
                dataType: 'json',
                data: {
                    username: username,
                    password: password
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
    });
    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END); ?>
</script>