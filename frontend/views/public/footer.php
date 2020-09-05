<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div id="newsletter" class="hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 newsletter-tip-block">
                <h4 class="text-center">
                    Join CashBackClub for Free & Get up to 100% Cash Back Today!
                </h4>
                <p class="text-center" style="margin-top: 40px; margin-bottom: 20px">
                    <a href="<?= Url::toRoute('/site/signup');?>" class="join-btn">Join Now</a>
                </p>
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
                    <p>CashBackClub is a new product testing platform that connects people with up to 100% cashback in exchange for providing their honest opinions
                        and testimonials.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer-section" style="width: 75%;">
                    <p class="footer-title">HELPFUL LINKS</p>
                    <div style="width: 100%">
                        <a class="help-link" href="<?= Url::toRoute('/site/faq');?>" target="_blank">FAQ &amp; Help</a>
                        <a class="help-link" href="<?= Url::toRoute('/site/about');?>" target="_blank">About Us</a>
                        <a class="help-link" href="<?= Url::toRoute('/site/contact');?>" target="_blank">Contact Us</a>
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
            © 2020 shenzhen geruide technology co.,ltd &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= Url::toRoute('/site/terms');?>">Terms</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?= Url::toRoute(['/site/terms', 'tabtarget'=>'privacy']);?>">Privacy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="mailto:support@theclubofcashback.com">support@theclubofcashback.com</a>
        </div>
    </div>
    <div class="hidden-md hidden-lg">
        <ul class="footer-nav-list col-xs-12">
            <li>
                <a href="<?= Url::toRoute('/site/about');?>">About Us</a>
            </li>
            <li>
                <a href="<?= Url::toRoute('/site/faq');?>">FAQ</a>
            </li>
            <li>
                <a href="<?= Url::toRoute('/site/terms');?>">Terms&amp;Privacy</a>
            </li>
        </ul>
        <p class="copyright-txt">© 2020 shenzhen geruide technology co.,ltd All Rights Reserved.</p>
    </div>
</footer>
<a id="back-top" href="">
    <span class="fa fa-arrow-up" aria-hidden="true"></span>
</a>