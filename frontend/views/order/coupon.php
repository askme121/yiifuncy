<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <?= $this->render('../public/userleftbar.php') ?>
        <div class="account-content-container">
            <div class="header-line visible-sm visible-xs">
                <a href="javascript:history.back()" class="header-line-back">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <h1 class="header-line-page">Coupon Deals</h1>
            </div>
            <div>
                <div class="row deal-list-title visible-lg visible-md">
                    <div class="col-xs-9 col-sm-9 col-lg-8 col-md-8 clear-col">Coupon Information</div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3 clear-col">Action</div>
                </div>
                <div class="row deal-list-item" style="padding-bottom: 10px;">
                    <div class="deal-id-time visible-lg visible-md">
                            <span class="deal-id">
                                <span>Coupon ID: </span>94318
                            </span>
                        <span class="deal-time">Coupon Time: Jul/30/2020 08:51</span>
                    </div>
                    <div class="deal-content-container">
                        <div class="col-xs-12 col-sm-12 col-lg-8 col-md-8 pd0">
                            <div class="deals-item-img">
                                <a href="">
                                    <img src="/image/deals/0/b/0b309c0c0730bf32c4385ae66d95ceeb.jpg">
                                </a>
                            </div>
                            <div class="deals-item-content">
                                <p class="deals-item-title">
                                    <a href="">Pampfort Posture Corrector for Men and Women, Unique Armpit Comfort and Wider Adjustable Range Design, Long Wearing Without a Tightly Feeling, Under Clothes Posture Brace for Pain Relief (Large)</a>
                                </p>
                                <ul class="deals-item-info">
                                    <li class="dealRequest-price">
                                        <div>Price</div>
                                        <div>$ 14.98</div>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="dealRequest-cashback">
                                        <div>OFF</div>
                                        <div>70%</div>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="dealRequest-points">
                                        <div>Code</div>
                                        <div class="coupon-code">
                                            <font class="jq-select-code">NMSH-6AWN9E-ZXJHAN</font>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-3 pd0">
                            <a class="operation-btn" href="" target="_blank">Buy it on Amazon</a>
                            <button type="button" class="btn btn-lg operation-btn jq-add-refund" data-toggle="modal" data-target=".operation-uporder" data-url="">Submit Order info</button>
                            <a class="operation-btn" href="https://www.cashbackbase.com/account/dealrequest/94318">More Details</a>
                        </div>
                    </div>
                </div>
                <div>
                    <br>
                    <nav aria-label="Page navigation" class="text-center">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
