<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container mt25">
    <section>
        <div class="row" id="first_step">
            <form class="form-container form-bg-container" id="recover-password" method="post" action="<?= Url::toRoute('/site/request-password-reset')?>">
                <h3>Reset Your Password?</h3>
                <div class="form-content-container">
                    <p style="font-size: 16px;color: #999;">Enter your <b style="color: #333;">email address</b> and we'll email you a link to reset your passwod.</p>
                    <?= Html::textInput('email','', ['id' => 'email', 'autofocus' => true, 'class' => 'reset-input form-control', 'placeholder'=>'Email', 'aria-required'=>'true', 'aria-invalid'=>'false']) ?>
                    <?= Html::button('Submit', ['id' => 'reset-password','class' => 'btn upOrder-form-btn reset-btn']) ?>
                    <p class="login-tips">
                        <a class="reset-tip" href="<?= Url::toRoute('/site/login');?>" target="_self">&lt; Go back to Login</a>
                    </p>
                </div>
            </form>
        </div>
        <div class="row forget-password-container" id="second_step" style="display: none">
            <div class="col-sm-12">
                <div class="white-block">
                    <h3 class="email-send-title">Email sent!</h3>
                    <p>
                        Check your email for a message with a link to update your password. This link will expire in 1 hours.
                    </p>
                    <p>
                        <a class="login-btn forget-login-btn" href="<?= Url::toRoute('/site/login');?>" target="_self">Go back to Login</a>
                    </p>
                    <div class="text-center">
                        <a class="back-upstep" href="javascript:history.go(-1);">&lt;- Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    <?php $this->beginBlock('js') ?>
    $(document).ready(function(){
        $('#email').autoMail({
            emails:['gmail.com','yahoo.com','hotmail.com','outlook.com']
        });
        $("#reset-password").click(function(){
            var email = $('input[name="email"][id="email"]').val().trim();
            if (email == '')
            {
                $("#email").focus();
                return false;
            }
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: $("#recover-password").attr("action"),
                dataType: 'json',
                data: {
                    email: email,
                },
                success: function(response){
                    if (response.code == 1) {
                        $("#first_step").hide();
                        $("#second_step").show();
                    } else {
                        btn.removeClass("onused");
                        swal({
                            type: 'error',
                            title: 'Oops',
                            text: response.message,
                            timer: 3000,
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