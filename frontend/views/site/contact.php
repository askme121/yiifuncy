<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg pad15">
        <h2 class="page-title">Contact Us</h2>
        <div class="customer-tip-container">
            <p class="customer-enrty-content">
                <?= $page->content?>
            </p>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <input type="hidden" name="order_id" value="<?= Yii::$app->request->get("order_id")??0?>">
                    <p class="contact-form-title">Write to us here</p>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" <?php if (!Yii::$app->user->isGuest){?>value="<?=Yii::$app->user->identity->firstname?> <?=Yii::$app->user->identity->lastname?>"<?php }else{?>value=""<?php }?> placeholder="* Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" <?php if (!Yii::$app->user->isGuest){?>value="<?=Yii::$app->user->identity->email?>"<?php }else{?>value=""<?php }?> class="form-control" placeholder="* Email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" value="" class="form-control" placeholder="* Subject">
                    </div>
                    <div class="form-group">
                        <textarea rows="9" cols="88" name="body" id="contact-message" class="form-control" placeholder="* Message"></textarea>
                    </div>
                    <div class="form-group" style="line-height: 32px;">
                        <label class="required" aria-required="true"></label>
                        <input type="text" name="verifyCode" class="form-control verify-code" placeholder="* Fill in the verifyCode" style="margin-top: 0 !important;">
                        <img id="captcha" style="cursor: pointer" src="<?= Url::toRoute('/site/captcha');?>" onclick="this.src='/captcha?'+Math.random()">
                    </div>
                    <input type="button" class="btn upOrder-form-btn" id="contact-btn" value="Submit">
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 visible-lg visible-md">
                <img class="aside-img img-responsive" style="margin-top: 100px" src="<?= getImgUrl('images/about_us.jpg') ?>">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(function () {
        $("#contact-btn").click(function(){
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: $("#contact-form").attr('action'),
                dataType: 'json',
                data: $("#contact-form").serialize(),
                success: function(response){
                    if (response.code == 1) {
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
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>