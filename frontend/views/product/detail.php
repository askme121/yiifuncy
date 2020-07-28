<?php
use yii\helpers\Url;

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
<div class="split"></div>
<div id="detail-banner">
    <section class="container">
        <div class="row detail-contents">
            <input type="hidden" class="product_view_id" value="<?= $model['id']?>">
            <div class="visible-sm visible-xs">
                <ul>
                    <li class="deal-detail-content col-xs-12 detail-contents-1" style="padding: 0;">
                        <div id="deal-detail-content" style="position: relative;top: -100px;"></div>
                        <div id="detail-arousel" class="carousel slide">
                            <?= $this->render('image', ['gallerys'=>$model['product']['mutil_image']]); ?>
                            <h1 class="banner-title-detail">
                                <?= $model['product']['name']; ?>
                            </h1>

                            <div style="overflow: hidden;">
                                <ul class="prime-acount-list carousel-acount-list" style="font-size: 13px;">
                                    <li class="account-left" style="width: 24%">
                                        <span class="origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span><br>
                                        <span class="now-price" style="margin-left:5px;font-size: 16px;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= ($model['price']-$model['cashback']) ?></span>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="account-left" style="width: 26%;">
                                        <p class="prime-value"><?= $model['qty'] ?></p>
                                        <p class="prime-tile">Left</p>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="account-off" style="width: 25%;">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                        <p class="prime-tile">Cashback</p>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="account-fullfill" style="width: 23%;">
                                        <p class="fullfill-methed">Fullfilled by</p>
                                        <p class="prime-tile">
                                            <img class="prime-amz-logo" src="<?= getImgUrl('images/v3-amz-logo.jpg') ?>" style="height: 18px;">
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="col-xs-12 describe-container detail-contents-2" style="overflow: hidden;">
                        <div class="detai-steps">
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
            <div class="visible-lg visible-md">
                <div class="col-md-8 col-sm-7 col-xs-12 deal-detail-content">
                    <div class="row">
                        <div class="banner-content details-mobile">
                            <h1 class="banner-title-detail"><?= $model['product']['name']; ?></h1>
                            <?= $this->render('pc_image', ['gallerys'=>$model['product']['mutil_image'], 'image'=>$model['product']['image'], 'name'=>$model['product']['name']]); ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 describe-container" style="min-height: 100px;">

                            </div>
                        </div>
                        <div style="height: 15px; background: rgba(242, 245, 247, 1);"></div>
                        <div class="banner-content details-mobile" style="padding: 20px 0;">
                            <div class="col-sm-12" style="margin-bottom: 15px;">
                                <h4 style="margin: 0;"><strong>Customer reviews</strong></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12 deal-detail-price">
                    <div class="row">
                        <div class="banner-content v3-banner-right details-mobile" id="v3-banner-right" style="position: static; top: 0px; width: 390px;">
                            <div class="detail-banner-right" style="margin: 35px 20px 23px;">
                                <div class="v3-detail-price">
                                    <p class="v3-price-container">
                                        <span class="v3-relprice"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['price'] ?></span>
                                        <span class="v3-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></span>
                                    </p>
                                    <div id="wish-btn-container">
                                        <?php if (Yii::$app->user->isGuest) {?>
                                            <img class="wish-icon" src="<?= getImgUrl('images/wish-icon.png'); ?>" data-toggle="modal" data-target=".is-logged-in-modal">
                                        <?php } else {?>
                                            <img class="wish-icon" id="collect" data-url="<?= Url::toRoute('favo') ?>"  src="<?= getImgUrl('images/wish-icon.png'); ?>">
                                            <img class="wish-icon" id="uncollect" data-url="<?= Url::toRoute('favo') ?>" src="<?= getImgUrl('images/wish-icon-active.png'); ?>" style="display: none;">
                                        <?php }?>
                                        <font id="total-collect">1</font>
                                    </div>
                                </div>
                                <ul class="prime-acount-list detail-acount-list" style="margin-bottom: 20px;">
                                    <li class="account-left" style="width: 25% !important;">
                                        <p class="prime-value" style="color: #666;"><?= $model['qty'] ?></p>
                                        <p class="prime-tile">Left</p>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="account-off" style="width: 35% !important;">
                                        <p class="prime-value" style="color: #666;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $model['cashback'] ?></p>
                                        <p class="prime-tile">Cashback</p>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="account-fullfill">
                                        <p class="fullfill-methed">Fullfilled by</p>
                                        <p class="prime-tile">
                                            Amazon
                                        </p>
                                    </li>
                                </ul>
                                <?php if ($model['qty'] > 0){?>
                                    <button type="button" class="cashback_deal btn btn-lg v3-detail-btn" data-toggle="modal" <?php if (Yii::$app->user->isGuest) {?>data-target=".is-logged-in-modal"<?php }else{?>data-target=".check-deal-review"<?php }?>>
                                        <span class="v3-detail-btn-content">Deal Request</span>
                                    </button>
                                    <div style="width: 0px; border-style: solid solid solid solid; border-width: 0px 8px 8px 8px; border-color: #fff #fff #1ab394 #fff; margin: 0 auto; margin-top: 2px; margin-bottom: -1px;"></div>
                                    <p class="detail-points-left" style="color: #1ab394; margin: 0px 0 10px 0; padding: 5px 0; border: 1px dashed #1ab394; border-radius: 5px;">
                                        <i class="fa fa-exclamation-circle"></i> Buy to amazon and earn cashback,you can save <?= getSymbol(Yii::$app->params['site_id']) ?> <?//= $saveTotal?>
                                    </p>
                                <?php }else{?>
                                    <button type="button" class="btn btn-lg v3-detail-btn" disabled>
                                        <span class="v3-detail-btn-content">Sold Out</span>
                                    </button>
                                    <div style="width: 0px; border-style: solid solid solid solid; border-width: 0px 8px 8px 8px; border-color: #fff #fff #ed5565 #fff; margin: 0 auto; margin-top: 2px; margin-bottom: -1px;"></div>
                                    <p class="detail-points-left" style="color: #ed5565; margin: 0px 0 10px 0; padding: 5px 0; border: 1px dashed #ed5565; border-radius: 5px;">
                                        <i class="fa fa-exclamation-circle"></i> Available Tomorrow
                                    </p>
                                <?php }?>
                                <div class="social-sharing text-center index_social_link" data-permalink="http://labs.carsonshold.com/social-sharing-buttons" style="margin-top: 20px;">
                                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>" class="share-facebook">
                                        <span class="fa fa-facebook-official icon"></span>
                                        <span class="share-title">Share</span>
                                    </a>
                                    <a target="_blank" href="http://twitter.com/share?url=<?= $currentUrl ?>" class="share-twitter">
                                        <span class="fa fa-twitter icon"></span>
                                        <span class="share-title">Tweet</span>
                                    </a>
                                </div>

                                <div class="v3-detai-steps">
                                    <h2 class="detail-steps-title">4 Steps to Get Cash Back</h2>
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-add-icon.png'); ?>">
                                        Click the 'Deal Request' button
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-finish-icon.png'); ?>">
                                        Get seller's confirmation and buy it on Amazon
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-fill-icon.png'); ?>">
                                        Fill in Amazon order info and approved by the seller
                                    </div>
                                    <img class="step-line-icon" src="<?= getImgUrl('images/step-line-icon.jpg'); ?>">
                                    <div class="detail-step-item">
                                        <img class="step-item-icon" src="<?= getImgUrl('images/step-back-icon.png'); ?>">
                                        Get the cash back to your PayPal account
                                    </div>
                                </div>
                                <p style="margin: 20px 0 0;color: #888;">
                                    <span class="error">Tips</span>: The amount of the coupon will be deducted from the cashback if you use a coupon.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-bottom:20px">
                    &nbsp;
                </div>
            </div>
        </div>
    </section>
</div>

<div class="detail-requestbtn-container visible-sm visible-xs">
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

<?php if (Yii::$app->user->isGuest) {
    $param = [
        'cashback'=> $model['cashback']
    ];
    ?>
    <?= $this->render('../public/login', $param); ?>
<?php } else {?>
    <?= $this->render('../public/is_login'); ?>
<?php }?>

    <script type="text/javascript">
        <?php $this->beginBlock('js_block') ?>
        $(document).ready(function(){
            $('#detail-arousel').carousel({
                pause: true,
                interval: 5000
            });
            $("#detail-arousel").on('slide.bs.carousel', function (obj) {
                var index = $(this).find('.item').index(obj.relatedTarget);
                $("#currentItem").text(index+1);
            });
            $("#banner-img").elevateZoom({
                gallery:'gal1',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                preloading: 1,
                loadingIcon: '<?= getImgUrl('images/lazyload.gif'); ?>',
            });
            function touchCarousel() {
                var isTouch=('ontouchstart' in window);
                if(isTouch){
                    $(".carousel").on('touchstart', function(e){
                        var that=$(this);
                        var touch = e.originalEvent.changedTouches[0];
                        var startX = touch.pageX;
                        var startY = touch.pageY;
                        $(document).on('touchmove',function(e){
                            touch = e.originalEvent.touches[0] ||e.originalEvent.changedTouches[0];
                            var endX=touch.pageX - startX;
                            var endY=touch.pageY - startY;
                            if(Math.abs(endY)<Math.abs(endX)){
                                if(endX > 10){
                                    $(this).off('touchmove');
                                    that.carousel('prev');
                                }else if (endX < -10){
                                    $(this).off('touchmove');
                                    that.carousel('next');
                                }
                                return false;
                            }
                        });
                    });
                    $(document).on('touchend',function(){
                        $(this).off('touchmove');
                    });
                }
            }
            touchCarousel();
        });

        $('#choose-sign-up-with-email').click(function(){
            $('#choose-block').hide();
            $('#sign-up-block').show();
            $('#sign-in-block').hide();
        });

        $('#choose-login').click(function(){
            $('#choose-block').hide();
            $('#sign-up-block').hide();
            $('#sign-in-block').show();
        });

        $('.back').click(function(){
            $('#choose-block').show();
            $('#sign-up-block').hide();
            $('#sign-in-block').hide();
        });

        $('#submit-sign-up').click(function(){
            var first_name = $('input[name="first_name"][id="first_name"]').val();
            var last_name = $('input[name="last_name"][id="last_name"]').val();
            var username = $('input[name="username"][id="reg_username"]').val();
            var password = $('input[name="password"][id="register-pass"]').val();
            var captcha = $('input[name="captcha"]').val();
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
                $("#reg_username").focus();
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
                url: '/account/register',
                dataType: 'json',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    username: username,
                    password: password,
                    captcha: captcha
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
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

        $('#submit-sign-in').click(function(){
            console.log('ok')
            var username = $('input[name="username"][id="login_username"]').val();
            var password = $('input[name="password"][id="password"]').val();
            if (username == '')
            {
                $("#login_username").focus();
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
                url: '/account/login',
                dataType: 'json',
                data: {
                    username: username,
                    password: password
                },
                success: function(response){
                    if (response.code == 1) {
                        $('.is-logged-in-modal').modal('hide');
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
        var collectSwitch = true;
        $('#collect').click(function(){
            if (!collectSwitch) {
                return false;
            }

            requestUrl = $(this).data('url');
            collectSwitch = false;

            $.ajax({
                type: 'get',
                url: requestUrl,
                dataType: 'json',
                data: {
                    "product_id": $('.product_view_id').val()
                },
                success: function(response){
                    collectSwitch = true;
                    if (response.code == 1) {
                        $('#collect').hide();
                        $('#uncollect').show();

                        var totalCount = parseInt($('#total-collect').text());
                        $('#total-collect').text(totalCount+1);
                    }
                },
                error: function(){
                    collectSwitch = true;
                }
            });
        });

        var uncollectSwitch = true;
        $('#uncollect').click(function(){
            if (!uncollectSwitch) {
                return false;
            }

            requestUrl = $(this).data('url');
            uncollectSwitch = false;

            $.ajax({
                type: 'get',
                url: requestUrl,
                dataType: 'json',
                data: {
                    "product_id": $('.product_view_id').val()
                },
                success: function(response){
                    uncollectSwitch = true;
                    if (response.code == 1) {
                        $('#collect').show();
                        $('#uncollect').hide();

                        var totalCount = parseInt($('#total-collect').text());
                        if (totalCount - 1 <= 0) {
                            $('#total-collect').text(0);
                        } else {
                            $('#total-collect').text(totalCount-1);
                        }
                    }
                },
                error: function(){
                    uncollectSwitch = true;
                }
            });
        });

        $('#detail-btn1').click(function (){
            $.ajax({
                type: "post",
                url: "<?= Url::to('catalog/product/coupondeal') ?>",
                data: {
                    "product_id": $('.product_view_id').val(),
                },
                dataType: "json",
                success: function(response){
                    var status = response.status;
                    $('.model-close').css('color', '#ccc');
                    switch(status) {
                        case 5:
                            $('.modal-body').hide();
                            $('.jq-no-points').show();
                            break;
                        case 3:
                            $('.modal-body').hide();
                            break;
                        case 1:
                            $('.modal-body').hide();
                            $('.jq-get-quota').show();
                            $('.amazon_link').attr('href', response.amz_url);
                            $('.deal-expires-time').attr('data-expired-time', response.expired_at);
                            $('#upOrder-form').attr('action', response.order_form_url);
                            $('.jq-cancel-order').attr('data-href', response.order_cancel_url);
                            $('#date-now').attr('data-now-time', response.datanow_at);
                            break;
                        case 2:
                            time = setInterval(loadingcheck, 2000);
                            break;
                        case 0:
                            $('.modal-body').hide();
                            $('.jq-noquota').show();
                            break;
                        case 4:
                            $('.modal-body').hide();
                            $('.model-close').css('cssText', 'color:#fff !important;');
                            $('.jq-seller-deal').show();
                            break;
                        case 6:
                            $('.modal-body').hide();
                            $('.jq-waiting-one-deal').show();
                            break;
                        case '7':
                            window.location.href = '/customer/profile?tabtarget=amazon-profile';
                            break;
                    }
                },
                error: function(){
                    $('.modal-body').hide();
                    $('.jq-error').show();
                }
            });
        });

        $('.jq-dismiss-modal').click(function(){
            $('.is-logged-in-modal').modal('hide');
        });

        $('.is-logged-in-modal').on('hidden.bs.modal', function (e) {
            $('.modal-body').hide();
            $('.jq-loading').show();
        });
        // COPY
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        //var clipboard = new ClipboardJS('#show-coupon-code');
        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>