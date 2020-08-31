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
    <form class="form-container form-bg-container" id="reset-pass-form" method="post" action="<?= Url::to('/account/password/reset/'.Yii::$app->request->get("token"))?>">
        <h3 class="dark-grey">Reset Passowrd </h3>
        <div class="form-content-container">
            <div class="form-group">
                <sapn class="form-control reset-padding"><?= $model->email?></sapn>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control reset-input" id="password" value="" placeholder="Password" style="margin-bottom: 0;">
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control reset-input" id="confirm_password" value="" placeholder="Confirm Password">
            </div>
            <input type="button" class="reset-pass-btn reset-btn" id="register_btn" value="Save">
            <p style="text-align: center;text-decoration: underline;">
                <a class="back-upstep" style="color: #337ab7;" href="<?= Url::toRoute('/site/login');?>">Back</a>
            </p>
        </div>
    </form>
</div>
<script>
    <?php $this->beginBlock('js') ?>
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
        $("#register_btn").click(function(){
            var password = $('input[name="password"][id="password"]').val().trim();
            var confirm_password = $('input[name="confirm_password"][id="confirm_password"]').val().trim();
            if (password == '')
            {
                $("#password").focus();
                return false;
            }
            if (confirm_password == '')
            {
                $("#confirm_password").focus();
                return false;
            }
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: $("#reset-pass-form").attr("action"),
                dataType: 'json',
                data: {
                    password: password,
                    confirm_password: confirm_password
                },
                success: function(response){
                    if (response.code == 1) {
                        swal({
                            type: 'success',
                            title: 'Oops',
                            text: response.message,
                            timer: 3000,
                            html: true
                        });
                        window.location.href = '/account/login';
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