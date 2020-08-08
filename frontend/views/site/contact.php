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
<div class="container mt55">
    <div class="container-bg pad15">
        <h2 class="page-title">Contact Us</h2>
        <div class="customer-tip-container row">
            <p class="customer-enrty-content">
                If you have any questions or concerns, you can visit our <a href="/faq" style="color: #FF9933;text-decoration: underline;">FAQs page</a>.<br>
                If you cannot find the answer to your question, complete the form below to contact us.
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form class="contact-form" id="contact-form" action="" method="post" novalidate="novalidate">
                    <p class="contact-form-title">Write to us here</p>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="" placeholder="* Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" value="" class="form-control" placeholder="* Email">
                    </div>
                    <div class="form-group">
                        <select name="type" value="" class="form-control">
                            <option value="">Please choose your identity</option>
                            <option value="customer">I am a customer</option>
                            <option value="seller">I am a seller</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" value="" class="form-control" placeholder="* Subject">
                    </div>
                    <div class="form-group">
                        <textarea rows="9" cols="88" name="content" id="contact-message" class="form-control" placeholder="* Message"></textarea>
                    </div>

                    <div class="form-group" style="line-height: 32px;">
                        <label class="required" aria-required="true"></label>
                        <input type="text" name="captcha" class="form-control verify-code" placeholder="* Fill in the mathematical result" style="margin-top: 0 !important;">
                        <img id="captcha" src="https://www.cashbackbase.com/captcha/math?WZYB5L1G" onclick="this.src='/captcha/math?'+Math.random()">
                        <span>
                                <a class="change-code-btn" href="javascript:;" onclick="$('#captcha').attr('src', '/captcha/math?'+Math.random());">Change</a>
                            </span>
                    </div>
                    <input type="submit" class="btn upOrder-form-btn" id="contact-btn" value="Submit">
                </form>
            </div>
            <div class="col-sm-6">
                <img class="aside-img img-responsive" src="<?= getImgUrl('images/about_us.jpg') ?>">
            </div>
        </div>
    </div>
</div>