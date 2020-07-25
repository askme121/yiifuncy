<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<?= $this->render('../public/topbar.php') ?>
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
                                    <div class="product-img-container lazy" data-bg="url(<?= $product['product']['thumb_image'] ?>)" data-was-processed="true">
                                    </div>
                                    <p class="deal-entity-title">
                                        <?= $product['product']['name'] ?>
                                    </p>
                                    <ul class="deal-account-list">
                                        <li>
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                            <p class="prime-tile">Price</p>
                                        </li>
                                        <li class="deal-price-cotainer">
                                            <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                            <p class="prime-tile">Cashback</p>
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
            <?php if (isset($meta['top_desc']) && !empty($meta['top_desc'])){ ?>
            <p style="margin-bottom: 20px;"><?= $meta['top_desc']?></p>
            <?php }?>
            <?php if (is_array($model) && !empty($model)):  ?>
                <?php foreach ($model as $product):  ?>
                    <a class="hot-deal-entry" href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>">
                        <div style="position: relative;">
                            <div class="cashback-circle-tip">
                                <div style="display: inline-block; height: 28px; vertical-align: middle; line-height: 15px; transform:rotate(-15deg);">
                                    <p style="margin: 0;">Cashback</p>
                                    <p style="margin: 0;"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                </div>
                            </div>
                            <div class="product-img-container lazy shade-container"  data-bg="url(<?= $product['product']['thumb_image'] ?>)">

                            </div>

                            <p class="hot-entity-title">
                                <span href="<?= Url::toRoute('/offer/'.$product['url_key'].'/'.$product['id']);?>"><?= $product['product']['name'] ?></span>
                            </p>
                            <ul class="prime-acount-list normal-account-list" style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                                <li class="account-left">
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['price'] ?></p>
                                    <p class="prime-tile">Price</p>
                                </li>
                                <li class="account-off">
                                    <p class="prime-value"><?= getSymbol(Yii::$app->params['site_id']) ?> <?= $product['cashback'] ?></p>
                                    <p class="prime-tile">Cashback</p>
                                </li>
                                <li class="account-fullfill">
                                    <p class="fullfill-methed">Fullfilled by</p>
                                    <p class="prime-tile">
                                        <img class="prime-amz-logo img-responsive" src="<?= getImgUrl('images/v3-amz-logo.jpg'); ?>">
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