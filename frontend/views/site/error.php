<?php

use yii\helpers\Url;

$this->title = $name;
?>
<style type="text/css">
    @media (max-width:768px) {
        .split{
            height: 60px;
        }
    }
</style>
<div class="split"></div>
<section id="page" class="container">
    <div class="row" style="background-color: #fff;">
        <div class="col-sm-12">
            <div style="padding:20px 0 30px; min-height: 510px">
                <div style="text-align: center;margin-bottom:20px;">
                    <img style="width: 200px;" src="<?= getImgUrl('images/404.jpg') ?>">
                </div>

                <h4 class="text-center 450-tip" style="margin-bottom:20px;font-size: 14px;">Sorry, we can't find the page you were trying to reach.</h4>
                <div class="text-center">
                    <a class="btn upOrder-form-btn" style="height: 34px;line-height: 34px;padding: 0;" href="<?= Url::home()?>">Homepage</a>
                    <a class="btn wite-btn" href="javascript:history.go(-1);" style="margin-left:30px;padding:0 14px;height:30px;line-height:28px;">Previous page</a>
                </div>
            </div>
        </div>
    </div>
</section>
