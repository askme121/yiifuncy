<?php
if(is_array($gallerys) && !empty($gallerys)):
?>
<div class="col-xs-12 col-sm-12 col-md-3">
    <ul id="detail-img-list">
    <?php
		foreach($gallerys as $gallery):
		?>
        <li>
             <img class="img-responsive cursor" src="<?= $gallery['thumb_image'] ?>">
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div id="outerdiv">
    <div id="innerdiv">
        <img id="bigimg" src="">
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-9">
    <img class="img-responsive pimg" id="banner-img" src="<?= $image ?>" data-zoom-image="<?= $image?>" alt="<?= $name; ?>">
</div>
