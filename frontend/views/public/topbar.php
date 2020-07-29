<?php
use yii\helpers\Url;
?>
<div class="top-nav-container visible-xs-block visible-sm-block hidden-lg hidden-md">
    <div>
        <nav class="mydeal-nav-brand">
            <div class="deal-content-nav index-nav-ul">
                <a href="<?= Url::toRoute('/product');?>" class="deal-nav-a <?php if (isset($curr) && $curr == 0){?>active<?php }?>">
                    All Deals
                </a>
                <a href="<?= Url::toRoute('/product/coupon&cashback');?>" class="deal-nav-a <?php if (isset($curr) && $curr == 3){?>active<?php }?>">
                    Coupon & Cashback
                </a>
                <a href="<?= Url::toRoute('/product/cashback');?>" class="deal-nav-a <?php if (isset($curr) && $curr == 2){?>active<?php }?>">
                    Cashback Deals
                </a>
                <a href="<?= Url::toRoute('/product/coupon');?>" class="deal-nav-a <?php if (isset($curr) && $curr == 1){?>active<?php }?>">
                    Coupon Deals
                </a>
            </div>
        </nav>
    </div>
</div>