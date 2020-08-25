<?php
use yii\helpers\Url;

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
                <h1 class="header-line-page">Message Center</h1>
            </div>
            <ul id="msg-detal-tab" class="nav nav-tabs msg_nav">
                <li <?php if (Yii::$app->request->get('type') != 1){?>class="in active"<? }?>>
                    <a href="<?= Url::toRoute('/user/message') ?>">Inbox</a>
                </li>
                <li <?php if (Yii::$app->request->get('type') == 1){?>class="in active"<? }?>>
                    <a href="<?= Url::toRoute(['/user/message', 'type'=>1]) ?>">Sent items</a>
                </li>
                <button class="create_msg" data-toggle="modal" data-target=".operation-upmsg"><i class="fa fa-plus"></i>New message</button>
            </ul>
            <div id="account-tab-content" class="tab-content">
                <div class="tab-pane fade in active" id="inbox">
                    <?php if ($model){?>
                    <ul class="msg_list">
                        <?php foreach ($model as $vo):  ?>
                        <li>
                            <dl class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <a href="<?= Url::toRoute(['/user/message-view', 'id'=>$vo->id])?>" <?php if ($vo->status != 0){?>class="is_read"<?php }?>><?= $vo->title?></a>
                            </dl>
                            <dd class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <?= date("M/d/Y", $vo->created_at)?>
                            </dd>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <? }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('../public/upmsg'); ?>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(document).ready(function(){
        var params = getTrace();
        if (window.requestIdleCallback) {
            requestIdleCallback(function () {
                fpid(params);
            });
        } else {
            setTimeout(function () {
                fpid(params);
            }, 500);
        }
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
