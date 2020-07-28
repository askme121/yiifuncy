<?php
?>
<div>
    <a href="javascript:history.back(-1)" class="detail-func-container" style="left: 4px;font-size: 22px;">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </a>
    <button type="button" class="detail-func-container" data-toggle="modal" data-target=".share-modal" style="right: 4px;">
        <i class="fa fa-share-alt" aria-hidden="true"></i>
    </button>
</div>
<ol class="carousel-indicators" style="display: none;">
    <?php if (is_array($gallerys) && !empty($gallerys)):  $i=0;?>
        <?php foreach ($gallerys as $gallery):  $i++;?>
            <li data-target="#detail-arousel" data-slide-to="<?=$i?>" <?php if ($i==1){?>class="active"<?php }?>></li>
        <?php endforeach; ?>
    <?php endif; ?>
</ol>
<div class="carousel-inner">
    <?php if(is_array($gallerys) && !empty($gallerys)): $i=0 ?>
        <?php foreach($gallerys as $gallery): $i++ ?>
            <?php $image = $gallery['image']; ?>
            <div class="item <?php if ($i==1){?>active<?php }?>">
                <div style="overflow: hidden;">
                    <div class="detail-product-img" style="background: url(<?= $image ?>) no-repeat;">
                        <img alt="" style="visibility: hidden;">
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif; ?>
</div>

<a class="left carousel-control" href="#detail-arousel" role="button" data-slide="prev" style="visibility: hidden;">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#detail-arousel" role="button" data-slide="next" style="visibility: hidden;">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
<div style="position: relative;">
    <div class="detail-img-count">
        <span id="currentItem">1</span>/<span id="item-count"><?= count($gallerys)?></span>
    </div>
    <div id="wish-btn-container" class="hidden">
        <div class="wish-icon-container">
            <?php if (Yii::$app->user->isGuest) {?>
                <img class="wish-icon" src="<?= getImgUrl('images/wish-icon.png') ?>" data-toggle="modal" data-target=".is-logged-in-modal">
            <?php } else {?>
                <img class="wish-icon" id="collect" data-url=""  src="<?= getImgUrl('images/wish-icon.png') ?>" style="display: block;">
                <img class="wish-icon" id="uncollect" data-url=""  src="<?= getImgUrl('images/wish-icon-active.png') ?>" style="display:none ;">
            <?php }?>
        </div>
        <font id="total-collect">0</font>
    </div>
</div>
