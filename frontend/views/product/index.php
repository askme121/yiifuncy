<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<?= $this->render('../public/topbar.php', ['curr' => $curr]) ?>
<div class="split"></div>
<div class="container">
    <div class="row visible-sm visible-xs">
        <?php if (is_array($model) && !empty($model)):  ?>
            <div class="col-xs-12 bg-white">
                <div class="deal-entry-ul">
                    <?php foreach ($model as $product):  ?>
                        <div class="col-xs-6 padd0 deal-entry-container">
                            <a href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                                <div class="deal-entry">
                                    <div class="circle-tip">
                                        <div class="circle-tip-body">
                                            <p style="margin: 0;"><?= $product['total_off'] ?> %</p>
                                            <p style="margin: 0;">Off</p>
                                        </div>
                                    </div>
                                    <div class="product-img-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)" data-was-processed="true">
                                    </div>
                                    <p class="deal-entity-title">
                                        <?= $product['product']['name'] ?>
                                    </p>
                                    <ul class="deal-account-list">
                                        <li>
                                            <p class="prime-value">
                                                <?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['final_price'] ?>
                                                <span class="origin-price new-origin-price"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></span>
                                            </p>
                                            <p class="prime-tile">Price</p>
                                        </li>
                                        <li class="deal-price-cotainer">
                                            <p class="prime-value"><?= $product['total_off'] ?> %</p>
                                            <p class="prime-tile">Off</p>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="row visible-lg visible-md">
        <div class="col-md-12 col-sm-12 col-xs-12 search-marketing-dd">
            <h3 class="deal-type-title page-main-title" style="margin-bottom: 10px;">
                <?= $meta['top_title']??''?>
            </h3>
            <p style="margin-bottom: 20px;"></p>
            <?php if (is_array($model) && !empty($model)):  ?>
                <?php foreach ($model as $product):  ?>
                    <a class="hot-deal-entry" href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                        <div style="position: relative;">
                            <div class="circle-tip">
                                <div class="circle-tip-body">
                                    <p style="margin: 0;"><?= $product['total_off'] ?> %</p>
                                    <p style="margin: 0;">Off</p>
                                </div>
                            </div>
                            <div class="product-img-container lazy shade-container"  data-bg="url(<?= $product['product']['thumb_image'] ?>)">

                            </div>
                            <p class="hot-entity-title">
                                <span href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>"><?= $product['product']['name'] ?></span>
                            </p>
                            <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                                <li class="account-left" style="width: 20%">
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <?php if (!is_null($product['cashback']) && $product['cashback']>0){ ?>
                                    <li class="account-off" style="width: 30%">
                                        <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                        <p class="prime-tile">Cashback</p>
                                    </li>
                                <?php }?>
                                <?php if (!is_null($product['coupon']) && $product['coupon']>0){ ?>
                                    <li class="account-off" style="width: 25%">
                                        <p class="prime-value">
                                            <?php if ($product['coupon_type'] == 1){?>
                                                <?= number_format($product['coupon'], 0) ?> %
                                            <?php }else{?>
                                                <?= number_format($product['coupon']/$product['price']*100, 0) ?> %
                                            <?php }?>
                                        </p>
                                        <p class="prime-tile">Off</p>
                                    </li>
                                <?php }?>
                                <li class="account-fullfill" style="width: 25%">
                                    <p class="fullfill-methed">Fullfilled by</p>
                                    <p class="prime-tile">
                                        <img class="prime-amz-logo img-responsive center-block" src="<?= getImgUrl('images/v3-amz-logo.jpg'); ?>">
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="page_box">
        <?php if(is_array($model) && !empty($model)): ?>
            <?=
            LinkPager::widget([
                'pagination' => $pages
            ]);
            ?>
        <?php endif; ?>
    </div>
</div>
    <script type="text/javascript">
        <?php $this->beginBlock('js_block') ?>
        $(document).ready(function(){
            clearRowLastMargin($('.hot-deal-entry'), 4);
        });
        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>