<?php
use yii\helpers\Url;

$this->title = $meta['title'];
$this->registerMetaTag(array("name"=>"description","content"=>$meta['description']));
$this->registerMetaTag(array("name"=>"keywords","content"=>$meta['keyword']));
?>
<div class="split"></div>
<div class="container">
    <div class="container-bg">
        <div class="tabbable">
            <div class="account-menu-container">
                <h4 class="menu_title">FAQ</h4>
                <ul class="nav nav-pills account-menu-list" id="divstyletab">
                    <?php if ($model){?>
                        <?php foreach ($model as $key=>$item): ?>
                    <li <?php if ($key==0){?>class="active"<?php }?>>
                        <a href="#<?= $item->url_key?>" class="account-menu-a" data-toggle="tab"><?= $item->title?></a>
                    </li>
                        <?php endforeach; ?>
                    <?php }?>
                </ul>
            </div>
            <div class="tab-content account-content-container tab-content-container">
                <?php if ($model){?>
                    <?php foreach ($model as $key=>$item): ?>
                        <div class="tab-pane fade <?php if ($key==0){?>active<?php }?> in" id="<?= $item->url_key?>">
                            <?= $item->content?>
                        </div>
                    <?php endforeach; ?>
                <?php }?>
            </div>
        </div>
    </div>
</div>
