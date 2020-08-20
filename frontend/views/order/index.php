<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <?= $this->render('../public/userleftbar.php', ['current'=>$current]) ?>
        <div class="account-content-container">
            <div class="header-line visible-sm visible-xs">
                <a href="javascript:history.back()" class="header-line-back">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <h1 class="header-line-page">Refund Deals</h1>
            </div>
            <div>
                <div class="row deal-list-title visible-lg visible-md">
                    <div class="col-xs-8 col-sm-8 col-lg-7 col-md-7 clear-col">Deal Information</div>
                    <div class="col-xs-2 col-sm-2 col-lg-3 col-md-3" style="padding-left: 0px">Deal Process</div>
                    <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2 clear-col">Action</div>
                </div>
                <?php if (is_array($model) && !empty($model)): ?>
                <?php foreach ($model as $order):  ?>
                <div class="row deal-list-item">
                    <div class="deal-id-time visible-lg visible-md">
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
                                <p class="deals-sold-by">
                                    Sold by <?= $order['activity']['sold_by'] ?>
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
                                <div class="visible-xs visible-sm">
                                    <?= date('M/d/Y H:i', $order['created_at'])?>
                                </div>
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
                                <?php if ($order['status'] < 2){?>
                                    <div class="drop_time" data-id="<?= $order['id']?>">
                                        <span class="t_h"></span>:<span class="t_i"></span>:<span class="t_s"></span>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-2 col-md-2 pd0">
                            <div class="option-list">
                                <?php if ($order['status'] == 1){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                    <a class="operation-btn buy_on_amazon" href="javascript:void(0)" data-href="<?= $order['amazon_url']?>" data-asin="<?= $order['activity']['asin'] ?>" target="_blank">Buy it on Amazon</a>
                                    <button type="button" class="btn btn-lg operation-btn jq-add-refund" data-toggle="modal" data-target=".operation-uporder" data-url="<?= Url::to('/order/upgrade/'.$order['id'])?>">Submit Order info</button>
                                    <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="<?= Url::to('/order/giveup/'.$order['id'])?>">Give Up</button>
                                <?php } else if ($order['status'] == 2){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                    <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                    <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="<?= Url::to('/order/giveup/'.$order['id'])?>">Give Up</button>
                                <?php } else if ($order['status'] == 3){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                    <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                    <button type="button" class="btn btn-lg operation-btn jq-cancel-order" id="operation-cancal" data-toggle="modal" data-target=".cancel-surebox" data-url="<?= Url::to('/order/giveup/'.$order['id'])?>">Give Up</button>
                                <?php } else if ($order['status'] == 4){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                    <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                <?php } else if ($order['status'] == 5){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                    <a class="operation-btn" href="<?= Url::toRoute('/order/deal/'.$order['id'])?>">More Details</a>
                                <?php } else if ($order['status'] == 6){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                <?php } else if ($order['status'] == 7){?>
                                    <a class="btn btn-lg operation-btn btn-w-m" href="<?= Url::to('/contact/'.$order['id'])?>" target="_blank"><i class="fa fa-comments"></i> Contact Us</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php endforeach; ?>
                <div class="page_box">
                    <?php if(is_array($model) && !empty($model)): ?>
                        <?=
                        LinkPager::widget([
                            'pagination' => $pages
                        ]);
                        ?>
                    <?php endif; ?>
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
        $('.jq-cancel-order').click(function () {
            var url = $(this).attr('data-url');
            $('#cancel-yes').attr('data-url', url);
        });
        $('#cancel-yes').click(function() {
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'post',
                url: url,
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
                        window.location.reload();
                    }
                },
                error: function(){
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });
        $('.buy_on_amazon').click(function (){
            var asin = $(this).data('asin'),
                link = $(this).data('href'),
                AMZ_PURCHASE_LINK_WEB = "https://www.amazon.com/dp/",
                AMZ_PURCHASE_LINK_APP = "com.amazon.mobile.shopping.web://www.amazon.com/dp/",
                AMZ_DOMAIN = "amazon.com",
                webLinkTag = "tag=ddddddd-20",
                separator = (link && link.indexOf('?') !== -1) ? "&" : "?",
                webPurchaseLink = link ? link : AMZ_PURCHASE_LINK_WEB + asin,
                appPurchaseLink = AMZ_PURCHASE_LINK_APP + asin;
            if (webPurchaseLink.indexOf(AMZ_DOMAIN) !== -1) {
                //webPurchaseLink += (separator + webLinkTag);
            }
            openWithApp(appPurchaseLink, webPurchaseLink);
        });
        window.setInterval(function () {
            $(".drop_time").each(function () {
                var order_id = $(this).data("id");
                var obj = $(this);
                $.ajax({
                    type: 'get',
                    url: '/order/drop',
                    dataType: 'json',
                    data: {
                        order_id: order_id
                    },
                    success: function(response){
                        if (response.code == 1) {
                            obj.children('.t_h').text(response.data.h);
                            obj.children('.t_i').text(response.data.i);
                            obj.children('.t_s').text(response.data.s);
                        }
                    },
                    error: function(){
                        console.log('error');
                    }
                });
            })
        }, 1000);
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
