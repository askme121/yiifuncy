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
                <h1 class="header-line-page">More Details</h1>
            </div>
            <ul id="deal-detal-tab" class="nav nav-tabs">
                <li role="presentation" class="active" id="tab-detail">
                    <a href="#details" data-toggle="tab" data-type="signin">Details</a>
                </li>
            </ul>
            <div id="account-tab-content" class="tab-content">
                <div class="tab-pane fade in active" id="details">
                    <div class="visible-lg visible-md">
                        <p class="deal-info-title">Deal Information</p>
                        <div class="deal-detail-container">
                            <div class="row deal-detail-theader">
                                <div class="col-xs-4 col-sm-4 col-lg-4 clear-col">Deal Description</div>
                                <div class="col-xs-1 col-sm-1 col-lg-1 clear-col">Price</div>
                                <div class="col-xs-2 col-sm-2 col-lg-2 clear-col">Discount</div>
                                <div class="col-xs-2 col-sm-2 col-lg-2 clear-col">Date</div>
                            </div>
                            <div class="row deal-detail-tbody">
                                <div class="col-xs-4 col-sm-4 col-lg-4 clear-col">
                                    <div class="deal-detail-img">
                                        <a href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>">
                                            <img src="<?= $order['product']['thumb_image'] ?>" width="68" height="68">
                                        </a>
                                    </div>
                                    <div class="col-xs-6" style="width: 230px;">
                                        <p class="deal-detail-title"><a href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>"><?= $order['product']['name'] ?></a></p>
                                        <div class="deal-detail-dealid">Deal ID: <?= $order['order_id']?></div>
                                    </div>
                                </div>
                                <div class="col-xs-1 col-sm-1 col-lg-1 clear-col deal-info-td"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['origin_cost']?>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-lg-2 clear-col deal-info-td">
                                    <span><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['cashback_cost'] + $order['coupon_cost']?></span>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-lg-2 clear-col deal-info-td"><?= date('M/d/Y H:i', $order['created_at'])?></div>
                            </div>
                        </div>
                    </div>
                    <div class="visible-sm visible-xs">
                        <div class="account-nav-mydeal">
                            <div class="col-xs-2">
                                <a class="nav-mydeal-img" href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>" style="background: url(<?= $order['product']['thumb_image'] ?>) no-repeat;">

                                </a>
                            </div>
                            <div class="col-xs-10">
                                <p class="nav-mydeal-title">
                                    <a href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>"><?= $order['product']['name'] ?></a>
                                </p>
                                <ul class="nav-mydeal-content">
                                    <li>
                                        Price
                                        <br>
                                        <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['origin_cost']?>
                                    </li>
                                    <li>
                                        Discount
                                        <br>
                                        <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['cashback_cost'] + $order['coupon_cost']?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12">
                                <div class="account-deal-time" style="margin-top: 10px;">
                                    <div>
                                        Deal ID: <?= $order['order_id']?>
                                    </div>
                                    <div style="color: #666;">
                                        Deal time: <?= date('M/d/Y H:i', $order['created_at'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row detail-review-container">
                        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6 pd0 share-view-left">
                            <p class="detail-review-title">Amazon Order Info</p>
                            <form id="upOrder-form" class="deal-detail-order" enctype="multipart/form-data" method="post" action="<?= Url::to('/order/upgrade/'.$order['id'])?>">
                                <div class="form-group upOrder-form-group">
                                    <label class="form-group-tip" for="order_id"><span class="mandatory-identification">* </span>Order ID:</label>
                                    <input class="form-control form-group-input amz-info-input" id="user-submitted-title" type="text" name="order_id" value="<?= $order['amazon_order_id']?>" <?php if ($order['status'] >= 3){?>disabled<?php }?> placeholder="e.g. 123-1234567-1234567">
                                    <div class="form-group-error error" id="order-id-tips"></div>
                                </div>
                                <div class="form-group-error error" id="image-tips"></div>
                                <div class="upOrder-form-btnss" style="text-align: left;">
                                    <?php if ($order['status'] < 3){?>
                                    <a type="button" class="btn upOrder-form-btn jq-submit-order" id="modify-uporder" style="float: left;">Modify</a>
                                    <?php }?>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6 pd0 share-view-right">
                            <?php if ($order['order_type'] != 2 && $order['coupon_code']){?>
                            <p class="detail-review-title" style="margin-left: 0">Code</p>
                            <p>
                                <font class="jq-select-code" style="font-weight: 800; border: solid #f93 1px; border-radius: 5px; padding: 5px;background-color: #f93;cursor: pointer;color: #fff;"><?= $order['coupon_code']?></font>
                            </p>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="review">
                    <div>
                        <div class="alert alert-info" role="alert" style="margin-top: 20px;">
                            You can get 500 points from writing review for this deal after you receive the goods. Please come back after receiving the goods.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        <?php $this->beginBlock('js_block') ?>
        $(document).ready(function(){
            $("#order-id-tips").html("");
            $("#modify-uporder").click(function(){
                var orderid = $("#user-submitted-title").val().trim();
                var reg_order = /^\d{3}-\d{7}-\d{7}\s*$/;
                var url = $('#upOrder-form').attr('action');
                if(orderid.indexOf('ORDER #') != -1){
                    orderid = orderid.split('#')[1].trim();
                }
                if(orderid.length == "0"){
                    $("#order-id-tips").html("Order ID can't be empty!");
                    return false;
                }else if(!reg_order.test(orderid)){
                    $("#order-id-tips").html("Please enter the correct Order ID.<br>e.g. 123-1234567-1234567");
                    return false;
                }
                $.ajax({
                    type: 'post',
                    url: url,
                    dataType: 'json',
                    data: {
                        "amz_order_id": orderid
                    },
                    success: function(response){
                        if (response.code == 1) {
                            $('.operation-uporder').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Oops',
                                text: response.message,
                                timer: 2000,
                                html: true
                            });
                            window.location.href = location.href;
                        } else if (response.code == 205) {
                            window.location.href = '/account/profile?tabtarget=amazon-profile&redirect=<?= $currentUrl ?>';
                        } else {
                            $("#order-id-tips").html(response.message);
                        }
                    },
                    error: function(){
                        swal('Oops', 'Server error, please try again later.', 'error');
                    }
                });
            });
        });
        var coupon_code = $(".jq-select-code").text();
        var clipboard = new ClipboardJS('.jq-select-code', {
            text: function() {
                return coupon_code;
            }
        });
        clipboard.on('success', function(e) {
            swal({
                type: 'success',
                title: '',
                text: 'Copied the code successfully. Buy it on Amazon now!'
            });
        });
        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>