<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container visible-lg visible-md">
    <div class="container-bg">
        <?= $this->render('../public/userleftbar.php') ?>
        <div class="account-content-container">

        </div>
    </div>
</div>

<div class="container visible-sm visible-xs">
    <div class="user-img-container row mt55">
        <div class="col-xs-3" style="padding-top: 20px;">
            <button type="button" class="upload-img jq-upload-img" style="background: url(<?= getImgUrl('images/user.png') ?>) no-repeat;">
            </button>
        </div>
        <div class="col-xs-9" style="padding-top: 20px;overflow: hidden;">
            <div class="user-email"><?= Yii::$app->user->identity->username?></div>
            <!--<div class="point-mess-container">
                <div class="point-container">
                    <a href="/account/points">
                        <img src="<?= getImgUrl('images/points.png') ?>">
                        <span class="point-amount" id="point-amount">2,000</span>
                    </a>
                </div>
                <div class="news-container">
                    <a href="/account/notify">
                        <img src="<?= getImgUrl('images/news.png') ?>">
                        <div class="news-amount">6</div>
                    </a>
                </div>
            </div>-->
        </div>
    </div>

    <div class="account-nav-container row">
        <ul>
            <li class="account-nav-li">
                <a href="<?= Url::toRoute('/order/index')?>">
                    Refund Deals
                    <span class="account-nav-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
            <li class="account-nav-li">
                <a href="<?= Url::toRoute('/order/coupon')?>">
                    Coupon Deals
                    <span class="account-nav-icon">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                </a>
            </li>
            <li class="account-nav-li">
                <a href="<?= Url::toRoute('/user/message')?>">
                    Message Center
                    <i class="fa fa-angle-right account-nav-icon" aria-hidden="true"></i>
                </a>
            </li>
            <li class="account-nav-li">
                <a href="<?= Url::toRoute('/user/profile')?>">
                    Account &amp; Profile
                    <i class="fa fa-angle-right account-nav-icon" aria-hidden="true"></i>
                </a>
            </li>
            <li class="account-nav-li" style="margin-top: 10px;">
                <a href="/contact">
                    Contact Us
                    <i class="fa fa-angle-right account-nav-icon" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
        <?php if (!Yii::$app->user->isGuest) {?>
        <div class="col-sm-12 col-xs-12 text-center">
            <button id="sign-out" class="btn upOrder-form-btn sign-out">Sign Out</button>
        </div>
        <?php }?>
    </div>
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
        $("#sign-out").click(function(){
            $.ajax({
                type: 'post',
                url: '/site/logout',
                dataType: 'json',
                data: {},
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
                        swal({
                            type: 'error',
                            title: 'Oops',
                            text: response.message,
                            html: true
                        });
                    }
                },
                error: function(){
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });
    });
    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END); ?>
</script>