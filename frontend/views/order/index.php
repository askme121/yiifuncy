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
            <div>
                <div class="deal-content-nav">
                    <a href="<?= Url::toRoute('/order/index')?>" class="deal-nav-a">
                        <span class="deal-nav-active">ALL</span>
                    </a>
                    <a href="?type=confirmed" class="deal-nav-a">
                        <span class="">CONFIRMED</span>
                    </a>
                    <a class="deal-nav-a" href="?type=order_uploaded">
                        <span class="">ORDER UPLOADED</span>
                    </a>
                    <a class="deal-nav-a" href="?type=receipted">
                        <span class="">REVIEW SHARED</span>
                    </a>
                    <a class="deal-nav-a" href="?type=refunded">
                        <span class="">REFUNDED</span>
                    </a>
                    <a class="deal-nav-a" href="?type=pause">
                        <span class="">PAUSE</span>
                    </a>
                    <a class="deal-nav-a" href="?type=closed">
                        <span class="">CLOSED</span>
                    </a>
                </div>
                <div class="row deal-list-title">
                    <div class="col-xs-8 col-sm-8 col-lg-7 col-md-7 clear-col">Deal Information</div>
                    <div class="col-xs-2 col-sm-2 col-lg-3 col-md-3">Deal Process</div>
                    <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2 clear-col">Action</div>
                </div>
                <?php if (is_array($model) && !empty($model)): ?>
                <?php foreach ($model as $order):  ?>
                <div class="row deal-list-item">
                    <div class="deal-id-time">
                        <span class="deal-id">
                            <span>Deal ID: </span><?= $order['order_id']?>
                        </span>
                        <span class="deal-time">Deal Time: <?= date('M/d/Y H:i', $order['created_at'])?></span>
                    </div>
                    <div class="deal-content-container">
                        <div class="col-xs-12 col-sm-12 col-lg-7 col-md-7 pd0">
                            <div class="deals-item-img">
                                <a href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>" target="_blank">
                                    <img src="<?= $order['product']['thumb_image'] ?>">
                                </a>
                            </div>
                            <div class="deals-item-content">
                                <p class="deals-item-title">
                                    <a href="<?= Url::to('/offer/'.$order['activity']['url_key'].'/'.$order['activity']['id']);?>" target="_blank"><?= $order['product']['name'] ?></a>
                                </p>
                                <ul class="deals-item-info">
                                    <li class="dealRequest-price">
                                        <div class="text-center">Price</div>
                                        <div class="text-center">
                                            <span class="final-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['origin_cost'] - $order['cashback_cost'] - $order['coupon_cost']?></span>
                                            <span class="origin-price new-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['origin_cost']?></span>
                                        </div>
                                    </li>
                                    <li class="space-vertical-lines"></li>
                                    <li class="dealRequest-cashback">
                                        <div class="text-center">Cashback</div>
                                        <div class="text-center"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $order['cashback_cost']?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-3 pd0 process-status-container">
                            <div class="process-status">
                                <div>
                                    <span class="list-dot processing"></span>
                                    <?php
                                    $order_status = Yii::$app->params['order_status'];
                                    if (isset($order_status[$order['status']])){
                                        echo $order_status[$order['status']];
                                    } else {
                                        echo 'unkown';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-2 col-md-2 pd0">
                            <?php if ($order['status'] == 1){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                                <a class="operation-btn" href="<?= $order['amazon_url']?>" target="_blank">Buy it on Amazon</a>
                                <button type="button" class="btn btn-lg operation-btn jq-add-refund" data-toggle="modal" data-target=".operation-uporder" data-url="<?= Url::to('/order/upgrade/'.$order['id'])?>">Submit Order info</button>
                                <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="">Give Up</button>
                            <?php } else if ($order['status'] == 2){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                                <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="">Give Up</button>
                            <?php } else if ($order['status'] == 3){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                                <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="">Give Up</button>
                            <?php } else if ($order['status'] == 4){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                                <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                            <?php } else if ($order['status'] == 5){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                                <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                            <?php } else if ($order['status'] == 6){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                            <?php } else if ($order['status'] == 7){?>
                                <a class="btn btn-lg operation-btn btn-w-m" href=""><i class="fa fa-comments"></i> Contact Us</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                    <?php endforeach; ?>
                <div>
                    <br>
                    <nav aria-label="Page navigation" class="text-center">
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('../public/uporder'); ?>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(document).ready(function(){
        $('.jq-add-refund').click(function (){
            var url = $(this).attr('data-url');
            $('#upOrder-form').attr('action', url);
        });
        $("#order-id-tips").html("");
        $("#user-submitted-post").click(function(){
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
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
