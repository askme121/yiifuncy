<?php
use yii\helpers\Url;
use common\models\Country;

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
                <h1 class="header-line-page">Account &amp; Profile</h1>
            </div>
            <ul id="deal-detal-tab" class="nav nav-tabs">
                <li role="presentation" id="tab-profile" class="in active">
                    <a href="#my-profile" data-toggle="tab" data-type="signin">My Profile</a>
                </li>

                <li role="presentation" id="tab-profile-link">
                    <a href="#amazon-profile" data-toggle="tab" data-type="signup">Paypal &amp; Amazon Profile</a>
                </li>
                <li role="presentation" id="tab-change-passs">
                    <a href="#change-pass" data-toggle="tab" data-type="signup">Change Password</a>
                </li>
            </ul>
            <div id="account-tab-content" class="tab-content">
                <div class="tab-pane fade in active" id="my-profile">
                    <div class="visible-lg visible-md" style="border-bottom: 1px solid #F6F6F6;overflow: hidden;position: relative;">
                        <button type="button" class="btn btn-lg upload-img jq-upload-img" data-toggle="modal" data-target=".upload-img-modal" style="background: url(<?= getImgUrl('images/user.png') ?>) center center / cover;">
                            <div id="layer-upimg-container" style="display: none;">
                                <div class="layer-masks"></div>
                                <div class="layer-contents" style="font-size:12px;">UPLOAD an IMAGE</div>
                            </div>
                        </button>
                        <div class="uporder-succ-tip">Avatar Upload Success!</div>
                    </div>
                    <form class="public-profile" action="<?= Url::toRoute('/user/profile')?>" method="post" id="public-profile-form">
                        <input name="avatar" type="hidden" value="">
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>First Name(Display on the reviews page)</dt>
                                <dd>
                                    <input name="firstname" type="text" class="form-control" value="<?= $model->firstname?>">
                                </dd>
                                <div class="error" id="firstName-tip" style="display: none;">Please fill out this field</div>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Last Name(Display on the reviews page)</dt>
                                <dd>
                                    <input name="lastname" type="text" class="form-control" value="<?= $model->lastname?>">
                                </dd>
                                <div class="error" id="lastName-tip" style="display: none;">Please fill out this field</div>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Gender</dt>
                                <dd class="radio-container">
                                    <select name="gender" class="form-control">
                                        <option value="0" <?php if ($model->gender == 0){?>selected<?php }?>></option>
                                        <option value="1" <?php if ($model->gender == 1){?>selected<?php }?>>Male</option>
                                        <option value="2" <?php if ($model->gender == 2){?>selected<?php }?>>Female</option>
                                        <option value="3" <?php if ($model->gender == 3){?>selected<?php }?>>Transgender</option>
                                        <option value="4" <?php if ($model->gender == 4){?>selected<?php }?>>Other</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Date of Birth</dt>
                                <dd class="flex-box">
                                    <select class="sel_month form-control birth-select " rel="" name="birth_month">
                                        <option value="">Month</option>
                                        <option value="01" <?php if ($model->birth_month=='01'){?>selected<?}?>>01</option>
                                        <option value="02" <?php if ($model->birth_month=='02'){?>selected<?}?>>02</option>
                                        <option value="03" <?php if ($model->birth_month=='03'){?>selected<?}?>>03</option>
                                        <option value="04" <?php if ($model->birth_month=='04'){?>selected<?}?>>04</option>
                                        <option value="05" <?php if ($model->birth_month=='05'){?>selected<?}?>>05</option>
                                        <option value="06" <?php if ($model->birth_month=='06'){?>selected<?}?>>06</option>
                                        <option value="07" <?php if ($model->birth_month=='07'){?>selected<?}?>>07</option>
                                        <option value="08" <?php if ($model->birth_month=='08'){?>selected<?}?>>08</option>
                                        <option value="09" <?php if ($model->birth_month=='09'){?>selected<?}?>>09</option>
                                        <option value="10" <?php if ($model->birth_month=='10'){?>selected<?}?>>10</option>
                                        <option value="11" <?php if ($model->birth_month=='11'){?>selected<?}?>>11</option>
                                        <option value="12" <?php if ($model->birth_month=='12'){?>selected<?}?>>12</option>
                                    </select>
                                    <select class="sel_day form-control birth-select" rel="" name="birth_day">
                                        <option value="">Day</option>
                                        <option value="01" <?php if ($model->birth_day=='01'){?>selected<?}?>>01</option>
                                        <option value="02" <?php if ($model->birth_day=='02'){?>selected<?}?>>02</option>
                                        <option value="03" <?php if ($model->birth_day=='03'){?>selected<?}?>>03</option>
                                        <option value="04" <?php if ($model->birth_day=='04'){?>selected<?}?>>04</option>
                                        <option value="05" <?php if ($model->birth_day=='05'){?>selected<?}?>>05</option>
                                        <option value="06" <?php if ($model->birth_day=='06'){?>selected<?}?>>06</option>
                                        <option value="07" <?php if ($model->birth_day=='07'){?>selected<?}?>>07</option>
                                        <option value="08" <?php if ($model->birth_day=='08'){?>selected<?}?>>08</option>
                                        <option value="09" <?php if ($model->birth_day=='09'){?>selected<?}?>>09</option>
                                        <option value="10" <?php if ($model->birth_day=='10'){?>selected<?}?>>10</option>
                                        <option value="11" <?php if ($model->birth_day=='11'){?>selected<?}?>>11</option>
                                        <option value="12" <?php if ($model->birth_day=='12'){?>selected<?}?>>12</option>
                                        <option value="13" <?php if ($model->birth_day=='13'){?>selected<?}?>>13</option>
                                        <option value="14" <?php if ($model->birth_day=='14'){?>selected<?}?>>14</option>
                                        <option value="15" <?php if ($model->birth_day=='15'){?>selected<?}?>>15</option>
                                        <option value="16" <?php if ($model->birth_day=='16'){?>selected<?}?>>16</option>
                                        <option value="17" <?php if ($model->birth_day=='17'){?>selected<?}?>>17</option>
                                        <option value="18" <?php if ($model->birth_day=='18'){?>selected<?}?>>18</option>
                                        <option value="19" <?php if ($model->birth_day=='19'){?>selected<?}?>>19</option>
                                        <option value="20" <?php if ($model->birth_day=='20'){?>selected<?}?>>20</option>
                                        <option value="21" <?php if ($model->birth_day=='21'){?>selected<?}?>>21</option>
                                        <option value="22" <?php if ($model->birth_day=='22'){?>selected<?}?>>22</option>
                                        <option value="23" <?php if ($model->birth_day=='23'){?>selected<?}?>>23</option>
                                        <option value="24" <?php if ($model->birth_day=='24'){?>selected<?}?>>24</option>
                                        <option value="25" <?php if ($model->birth_day=='25'){?>selected<?}?>>25</option>
                                        <option value="26" <?php if ($model->birth_day=='26'){?>selected<?}?>>26</option>
                                        <option value="27" <?php if ($model->birth_day=='27'){?>selected<?}?>>27</option>
                                        <option value="28" <?php if ($model->birth_day=='28'){?>selected<?}?>>28</option>
                                        <option value="29" <?php if ($model->birth_day=='29'){?>selected<?}?>>29</option>
                                        <option value="30" <?php if ($model->birth_day=='30'){?>selected<?}?>>30</option>
                                        <option value="31" <?php if ($model->birth_day=='31'){?>selected<?}?>>31</option>
                                    </select>
                                    <select class="sel_year form-control birth-select" rel="" name="birth_year">
                                        <option value="">Year</option>
                                        <?php for ($ii=2019; $ii>=1920; $ii--){?>
                                        <option value="<?=$ii?>" <?php if ($model->birth_year==$ii){?>selected<?}?>><?=$ii?></option>
                                        <?php }?>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Country</dt>
                                <dd>
                                    <select name="country" class="form-control" id="country-select" data-country="">
                                        <option value=""></option>
                                        <?php $country_list = Country::find()->orderBy("name")->all();?>
                                        <?php foreach ($country_list as $vv){?>
                                        <option value="<?= $vv->name?>" <?php if ($model->country == $vv->name){?>selected<?}?>><?= $vv->name?>(<?= $vv->code?>)</option>
                                        <?php }?>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <dt>Marital Status</dt>
                                <dd>
                                    <select name="marital" class="form-control">
                                        <option value="0" <?php if ($model->marital == 0){?>selected<?php }?>></option>
                                        <option value="1" <?php if ($model->marital == 1){?>selected<?php }?>>Married</option>
                                        <option value="2" <?php if ($model->marital == 2){?>selected<?php }?>>Single</option>
                                        <option value="3" <?php if ($model->marital == 3){?>selected<?php }?>>Separated</option>
                                        <option value="4" <?php if ($model->marital == 4){?>selected<?php }?>>Divorced</option>
                                        <option value="5" <?php if ($model->marital == 5){?>selected<?php }?>>Widowed</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">

                        </div>
                        <p class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 !important;margin: 0;">
                            <input type="button" class="btn upOrder-form-btn" id="update-profile" value="Submit">
                        </p>
                    </form>
                </div>

                <div class="tab-pane fade" id="change-pass">
                    <form class="changepassword-form" id="changepassword-form" action="<?= Url::toRoute('/user/change-password')?>" method="post">
                        <div class="form-group">
                            <label><font style="color: red;">*</font>Old Password: </label>
                            <input id="old-password" name="oldPassword" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <div class="form-group">
                            <label><font style="color: red;">*</font>New Password: </label>
                            <input id="new-pass" name="newPassword" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <div class="form-group">
                            <label><font style="color: red;">*</font>Confirm Password: </label>
                            <input id="new-password-confirmation" name="retypePassword" type="password" class="form-control">
                            <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        </div>
                        <span class="help-block m-b-none error" style="margin-left: 174px; color: #ed5565;"></span>
                        <p class="form-group">
                            <label></label>
                            <input type="button" class="btn upOrder-form-btn" id="submit-password" value="Submit" style="margin-top: 10px; line-height: 10px;">
                        </p>
                    </form>
                </div>
                <div class="tab-pane fade" id="amazon-profile">
                    <form class="submit-amazon-profile-form" id="submit-amazon-profile-form" action="/account/amazon_profile_link?type=redirect&amp;url=" method="POST">
                        <?php if (empty($model->paypal_account) || empty($model->amazon_profile_url)){?>
                        <div class="alert alert-success" role="alert" style="margin-top:20px; width: 100%;color: #f00">
                            You need to submit your Amazon Profile Link &amp; Paypal first before requesting a deal
                        </div>
                        <? }?>
                        <p style="margin-top: 20px">
                            <strong>How to find my Amazon public profile page?</strong><br>
                            Your Amazon Profile Page is where you as a user can share information about yourself, your personal tastes, and opinions regarding various products and services. This page is open to the public. By default it will not disclose any personal account information other than your user name. Follow the instructions below to find the link to your Amazon Profile Page.
                        </p>
                        <ul class="profile-list" style="margin-top: 20px;">
                            <li>
                                <span class="method-dot">1</span>
                                Click the Amazon profile URL: <a class="method-link" href="https://www.amazon.com/gp/profile?ref_=ya_d_l_profile" target="_blank">https://www.amazon.com/gp/profile?ref_=ya_d_l_profile</a>
                            </li>
                            <li>
                                <span class="method-dot">2</span>
                                Sign in your amazon account
                            </li>
                            <li>
                                <span class="method-dot">3</span>Copy and submit your Profile Url<br>
                                <img src="<?= getImgUrl('images/profile-link-example.png') ?>" width="72%" style="margin-top: 5px;">
                            </li>
                        </ul>
                        <div class="form-group" style="margin-bottom: 0; position: relative">
                            <label>Amazon Profile URL: </label>
                            <input type="hidden" id="redirect_url" name="redirect_url" value="<?= Yii::$app->request->get("redirect")?>">
                            <input name="amazon_profile_link" required type="text" <?php if (!empty($model->amazon_profile_url)){?>disabled<?php }?> class="form-control" value="<?= $model->amazon_profile_url?>">
                            <?php if (!empty($model->amazon_profile_url)){
                                if ($model->change_times < 1){
                                ?>
                                    <span id="change-url" class="help-block m-b-none open-edit" data-toggle="modal" data-target=".operation-change-url">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                <?php } else {?>
                                    <span id="notice-change-url" class="help-block m-b-none open-edit" data-toggle="modal" data-target=".notice-change-url">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                <?php }?>
                            <? }?>
                        </div>
                        <div class="form-group">
                            <label>Paypal Account:<button type="button" class="btn-default question-icon" data-toggle="tooltip" title="" data-original-title="Refund PayPal Account (can’t be changed), PayPal account must be an email">?</button></label>
                            <input name="paypal" required type="email" class="form-control jq-add-paypal" <?php if (!empty($model->paypal_account)){?>disabled<?php }?> value="<?= $model->paypal_account?>" placeholder="PayPal account must be an email">
                            <span class="help-block m-b-none" style="margin-left: 0px; color: #ed5565;"></span>
                        </div>
                        <p class="form-group">
                            <label></label>
                            <?php if (empty($model->amazon_profile_url) || empty($model->paypal_account)){?>
                            <input type="button" class="btn upOrder-form-btn" id="submit-amazon-link" value="Save" style="margin-top: 10px; line-height: 10px;">
                            <?php }?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal operation-change-url" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body" style="padding: 0;">
                <p class="offer-ends-container">
                    <span class="secured-title">&nbsp;</span>
                </p>
                <form id="update-profile-form" enctype="multipart/form-data" method="post" action="<?= Url::toRoute('/user/change-url') ?>?>">
                    <div class="form-group upOrder-form-group">
                        <p style="margin-bottom: 0;padding: 15px 0;font-size: 22px; text-align: center; color: #f93">Update Amazon Url</p>
                        <input class="form-control" id="amazon_url" type="text" name="amazon_url" value="<?= $model->amazon_profile_url?>">
                        <div class="form-group-error">
                            <small>Notice: you can only update your Amazon profile url for 1 times.</small>
                        </div>
                    </div>
                    <div class="upOrder-form-btnss text-center" style="margin-bottom: 30px">
                        <a type="button" class="btn upOrder-form-btn jq-submit-order" id="update-post">Update</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal notice-change-url" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body" style="padding: 0;">
                <p class="offer-ends-container">
                    <span class="secured-title">NOTICE!</span>
                </p>
                <p class="sorry-tip-content" style="margin-top: 20px">
                    You can only update your amazon profile url for 1 time,please click "Contact Us" to contact our customer service team if you wish to change it again.
                </p>
                <p style="text-align: center; margin-top: 10px">
                    <a class="btn upOrder-form-btn my-btn" href="<?= Url::toRoute('/site/contact')?>">Contact Us</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal upload-img-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 530px !important;">
            <button type="button" class="close model-close" id="close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            <div class="modal-body">
                <p class="upload-img-title">Upload an profile picture</p>
                <div class="modal-content-upimg">
                    <div style="overflow: hidden;">
                        <div class="user-img-containers">
                            <div class="blah-img">
                                <img id="blah" alt="your image" src="<?= getImgUrl('images/mosaic.png') ?>" style="width: 100%;" />
                            </div>
                            <p class="upimg-tip">Tips: Upload an image in the JPEG format, less than 2 MB. Your image will be automatically cropped and resized to 100*100 pixels.</p>
                        </div>

                        <div style="float: right;display: inline-block;width: 120px;">
                            <div class="img-preview img-preview" id="cropped_result"></div>
                            <p style="text-align: center;margin-bottom: 116px;">image preview</p>
                            <a href="javascript:;" class="upload" style="width: 120px;font-size: 14px;">
                                <input type="file" class="change" name="image" id="image"accept="image/png, image/jpeg, image/jpg" size="25" class="usp-input usp-clone" onchange="readURL(this);"/>
                                Upload an Image
                            </a>
                        </div>
                    </div>
                    <div id="maxsize-error" class="error" style=" margin-bottom: 20px;display: none;text-align: center;"></div>
                </div>
                <div style="border-top: 1px solid #F1F1F1;padding-top: 25px;padding-bottom: 15px;">
                    <button type="button" class="btn model-close upOrder-form-btn" id="upimg-cancel" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Cancel</span>
                    </button>
                    <input type="submit" class="btn upOrder-form-btn" id="crop_button" value="Save" style="margin-left: 77px;display: none !important;">
                </div>
            </div>
        </div>
    </div>
</div>



<button type="button" class="btn" id="profile-complete-tip" data-toggle="modal" data-target=".profile-complete-tip" style="display: none;"></button>
<div class="modal profile-complete-tip" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

            <div class="modal-body" style="padding: 40px 68px;">
                <p class="alert alert-info" role="alert" style="margin: 10px 0 30px;text-align: center;">
                    Fill in all the information can get 500 points!
                </p>
                <div style="text-align: center;">
                    <button class="btn operation-btn" id="profile-submit-btn" data-url="#" style="float: none;display: inline-block;margin: 0;line-height: 1;">Submit</button>

                    <button class="btn upOrder-form-btn" data-dismiss="modal" aria-label="Close" id="fill-all-btn" style="width:144px;margin: 0 0 0 60px;font-weight: normal;">Continue to fill</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
<?php $this->beginBlock('js_block') ?>
$(document).ready(function () {
    var urlParam = GetRequest();
    if(urlParam.tabtarget === "changepassword"){
        $('#tab-profile').removeClass('active');
        $('#my-profile').removeClass('active in');
        $('#tab-profile a').attr('aria-expanded','false');

        $('#tab-change-passs').addClass('active');
        $('#change-pass').addClass('active in');
        $('#tab-change-passs a').attr('aria-expanded','true');

        $('#tab-paypal').removeClass('active');
        $('#paypal-account').removeClass('active in');
        $('#tab-paypal a').attr('aria-expanded','false');

        $('#tab-profile-link').removeClass('active');
        $('#amazon-profile').removeClass('active in');
        $('#tab-profile-link a').attr('aria-expanded','false');
    }
    if(urlParam.tabtarget === "amazon-profile"){
        $('#tab-profile').removeClass('active');
        $('#my-profile').removeClass('active in');
        $('#tab-profile a').attr('aria-expanded','false');

        $('#tab-change-passs').removeClass('active');
        $('#change-pass').removeClass('active in');
        $('#tab-change-passs a').attr('aria-expanded','false');

        $('#tab-paypal').removeClass('active');
        $('#paypal-account').removeClass('active in');
        $('#tab-paypal a').attr('aria-expanded','false');

        $('#tab-profile-link').addClass('active');
        $('#amazon-profile').addClass('active in');
        $('#tab-profile-link a').attr('aria-expanded','true');
    }
})
$(function () {
    $('#submit-amazon-link').click(function (){
        var btn = $(this);
        var url = $("#submit-amazon-profile-form").attr('action');
        var amazon_url = $("input[name='amazon_profile_link']").val();
        var paypal = $("input[name='paypal']").val();
        if (amazon_url.trim() == ''){
            $("input[name='amazon_profile_link']").focus();
        }
        if (paypal.trim() == ''){
            $("input[name='paypal']").focus();
        }
        if (btn.hasClass("onused")){
            return false;
        }
        btn.addClass("onused");
        $.ajax({
            type: "post",
            url: url,
            data: {
                "amazon_profile_link": amazon_url,
                "paypal": paypal,
                "redirect_url": $("#redirect_url").val()
            },
            dataType: "json",
            success: function(response){
                if (response.code == 1) {
                    swal({
                        type: 'success',
                        title: 'Oops',
                        text: response.message,
                        timer: 3000,
                        html: true
                    });
                    if (response.redirect_url){
                        window.location.href = response.redirect_url;
                    } else {
                        window.location.href = location.href;
                    }
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

    $('#submit-password').click(function (){
        var btn = $(this);
        var url = $("#changepassword-form").attr('action');
        if (btn.hasClass("onused")){
            return false;
        }
        btn.addClass("onused");
        $.ajax({
            type: "post",
            url: url,
            data: $("#changepassword-form").serialize(),
            dataType: "json",
            success: function(response){
                if (response.code == 1) {
                    swal({
                        type: 'success',
                        title: 'Oops',
                        text: response.message,
                        timer: 3000,
                        html: true
                    });
                    window.location.href = location.href;
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

    $('#update-profile').click(function (){
        var btn = $(this);
        var url = $("#public-profile-form").attr('action');
        if (btn.hasClass("onused")){
            return false;
        }
        btn.addClass("onused");
        $.ajax({
            type: "post",
            url: url,
            data: $("#public-profile-form").serialize(),
            dataType: "json",
            success: function(response){
                if (response.code == 1) {
                    swal({
                        type: 'success',
                        title: 'Oops',
                        text: response.message,
                        timer: 3000,
                        html: true
                    });
                    window.location.href = location.href;
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
    $("#update-post").click(function () {
        var btn = $(this);
        var url = $("#update-profile-form").attr('action');
        var amazon_url = $("#amazon_url").val();
        if (amazon_url.trim() == ''){
            $("#amazon_url").focus();
        }
        if (btn.hasClass("onused")){
            return false;
        }
        btn.addClass("onused");
        $.ajax({
            type: "post",
            url: url,
            data: {
                "amazon_profile_link": amazon_url
            },
            dataType: "json",
            success: function(response){
                if (response.code == 1) {
                    swal({
                        type: 'success',
                        title: 'Oops',
                        text: response.message,
                        timer: 3000,
                        html: true
                    });
                    window.location.href = location.href;
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
    })
});
<?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
