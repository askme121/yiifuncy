<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div id="newsletter" class="hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 newsletter-tip-block">
                <h4 class="">
                    Get Updates for <span class="color-orange">free</span>
                </h4>
                <p>
                    Subscribe to our newsletter for latest deals.
                </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="newsletter-form">
                    <div class="input-group">
                        <input class="form-control" id="newsletter-email" type="text" name="newsletter" placeholder="<?= Yii::t('app', 'enter_email'); ?>" value="">
                        <span class="input-group-btn">
                            <button type="button" class="btn" id="newsletter-submit">Subscribe</button>
                        </span>
                    </div>
                </div>
                <span class="help-block" id="newsletter-tips"></span>
            </div>
        </div>
    </div>
</div>
<footer id="footer">
    <div class="container hidden-sm hidden-xs">
        <div class="row">
            <div class="col-sm-4">
                <div class="footer-logo">
                    <a href="/">
                        <img class="img-responsive logo lazy" data-src="<?= getImgUrl('images/logo-cover.png'); ?>" alt="">
                    </a>
                    <p>A community to help you get the latest deals on Amazon.com and help you save up to 100%!</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-section" style="width: 75%;">
                    <p class="footer-title">HELPFUL LINKS</p>
                    <div style="width: 50%; float: left;">
                        <a class="help-link" href="<?= Url::toRoute('/site/faq');?>" target="_blank">Faq &amp; Help</a>
                        <a class="help-link" href="<?= Url::toRoute('/site/about');?>" target="_blank">About Us</a>
                        <a class="help-link" href="<?= Url::toRoute('/site/contact');?>" target="_blank">Contact Us</a>
                    </div>
                    <div style="width: 50%; float: right;">

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-section">
                    <p class="footer-title title-accept">WE ACCEPT</p>
                    <img class="lazy" data-src="<?= getImgUrl('images/we_accept.png'); ?>" alt="Cashback accept">
                </div>
            </div>
        </div>
        <div class="copyright">
            © 2020 CashBackClub &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= Url::toRoute('/site/terms');?>">Terms</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?= Url::toRoute(['/site/terms', 'tabtarget'=>'privacy']);?>">Privacy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="mailto:support@theclubofcashback.com">support@theclubofcashback.com</a>
        </div>
    </div>
    <div class="hidden-md hidden-lg">
        <ul class="footer-nav-list col-xs-12">
            <li>
                <a href="<?= Url::toRoute('/site/about');?>">About Us</a>
            </li>
            <li>
                <a href="<?= Url::toRoute('/site/faq');?>">Faq</a>
            </li>
            <li>
                <a href="<?= Url::toRoute('/site/terms');?>">Terms&amp;Privacy</a>
            </li>
        </ul>
        <p class="copyright-txt">© 2020 CashBackClub All Rights Reserved.</p>
    </div>
</footer>
<a id="back-top" href="">
    <span class="fa fa-arrow-up" aria-hidden="true"></span>
</a>