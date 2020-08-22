<?php

use backend\assets\LayuiAsset;

LayuiAsset::register($this);
?>
<style type="text/css">
    .select-tag{
        padding: 15px;
    }
    .list_item{
        margin-bottom: 10px;
        clear: both;
    }
    .list_item .pic{
        float: left;
        padding: 5px;
    }
    .list_item .pic img{
        width: 100px;
        height: 100px;
    }
    .list_item .title{
        float: left;
        line-height: 25px;
        padding: 5px 10px;
    }
    .list_item .title .pro_title{
        max-height: 50px;
        overflow: hidden;
    }
    .list_item .title p{
        margin-bottom: 0;
    }
    .tag{
        margin-top: 10px;
    }
    .tag select{
        padding: 5px;
        border-radius: 2px;
    }
    .share_item{
        text-align: center;
        padding: 15px 0;
    }
    .share_btn{
        padding: 10px 20px;
        background-color: #f93;
        color: #fff;
        border-radius: 5px;
        display: none;
    }
    .share_btn:link, .share_btn:visited, .share_btn:hover, .share_btn:active{
        color: #fff;
        text-decoration: none;
    }
</style>
<div class="select-tag">
    <dl class="list_item">
        <input type="hidden" id="link_code" value="<?= $link_code?>">
        <input type="hidden" id="activity_url" value="<?= getSiteUrl($model->site_id).'/offer/'.$model->url_key.'/'.$model->id?>">
        <dt class="pic">
            <img src="<?= $model->product->thumb_image?>">
        </dt>
        <dd class="title">
            <p class="pro_title">
                <?= $model->product->name?>
            </p>
            <p>
                库存：<?= $model->qty?>
            </p>
            <p>
                状态：
                <span style="color: red">
                    <?php
                    switch ($model->status)
                    {
                        case 0:
                            echo '未启用';
                            break;
                        case 1:
                            $time = time();
                            if ($model->start <= $time && $model->end >= $time){
                                echo '生效中';
                            } else if ($model->start > $time){
                                echo '待生效';
                            } else {
                                echo '已过期';
                            }
                            break;
                        case 2:
                            echo '已取消';
                            break;
                        default:
                            echo Yii::t('app', 'unkown');
                            break;
                    }
                    ?>
                </span>
            </p>
            <p>
                活动期限：<?= date("Y-m-d H:i:s", $model->start)?> ~ <?= date("Y-m-d H:i:s", $model->end)?>
            </p>
        </dd>
    </dl>
    <div class="clearfix"></div>
    <dl class="tag">
        标签：<select id="change_tag">
            <option value="">请选择标签</option>
            <?php if ($tag_list) {?>
                <?php foreach ($tag_list as $vv) {?>
                    <option value="<?= $vv->tag?>"><?= $vv->tag?></option>
                <?php }?>
            <?php }?>
        </select>
    </dl>
    <dl class="share_item">
        <a class="share_btn" id="share-btn" href="#" target="_blank">
            <i class="fa"></i> Share
        </a>
    </dl>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('js') ?>
    $(document).ready(function(){
        $("#change_tag").change(function () {
            var tag = $(this).val();
            if (tag == ''){
                $("#share-btn").attr('href', '#');
                $("#share-btn").hide();
            } else {
                var tag_arr = tag.split("-");
                var channel = tag_arr[tag_arr.length-1];
                var link = $("#activity_url").val();
                link += '?tag=' + tag;
                var sign = $("#link_code").val();
                if (sign.length > 0){
                    link += '&code=' + sign
                }
                var pre = '';
                var pre_fa = '';
                if (channel == 'fb'){
                    pre = 'http://www.facebook.com/sharer/sharer.php?u=';
                    pre_fa = 'fa fa-facebook';
                } else if (channel == 'tw') {
                    pre = 'http://twitter.com/share?url=';
                    pre_fa = 'fa fa-twitter';
                }
                var final_link = pre + link;
                $("#share-btn").attr('href', final_link);
                $("#share-btn").children('i').attr('class', pre_fa);
                $("#share-btn").show();
            }
        });
    });
    <?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['js'],\yii\web\View::POS_END);
?>
