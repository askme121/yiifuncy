<?php
use yii\helpers\Url;
?>
<div class="modal operation-upmsg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body" style="padding: 0;">
                <p class="offer-ends-container">
                    <span class="secured-title">Submit a request</span>
                </p>
                <form id="upmsg-form" enctype="multipart/form-data" method="post" action="<?= Url::toRoute('/user/ajax-message')?>">
                    <input type="hidden" name="name" value="<?=Yii::$app->user->identity->firstname?> <?=Yii::$app->user->identity->lastname?>">
                    <input type="hidden" name="email" value="<?=Yii::$app->user->identity->email?>">
                    <input type="hidden" id="msg_parent" name="parent" value="">
                    <div class="form-group">
                        <label><span class="error">*</span>Subject:</label>
                        <input class="form-control" type="text" name="subject" value="">
                    </div>
                    <div class="form-group">
                        <label><span class="error">*</span>Content:</label>
                        <textarea name="body" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <a type="button" class="btn upOrder-form-btn jq-submit-order" id="msg-submit">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('js_block') ?>
    $(function () {
        $("#reply_btn").click(function () {
            var id = $(this).data("id");
            $("#msg_parent").val(id);
        })
        $("#msg-submit").click(function() {
            var btn = $(this);
            if (btn.hasClass("onused")){
                return false;
            }
            btn.addClass("onused");
            $.ajax({
                type: 'post',
                url: $("#upmsg-form").attr('action'),
                dataType: 'json',
                data: $("#upmsg-form").serialize(),
                success: function(response){
                    if (response.code == 1) {
                        swal({
                            type: 'success',
                            title: 'Oops',
                            text: response.message,
                            timer: 3000,
                            html: true
                        });
                        window.location.href = location.href;
                    } else {
                        btn.removeClass("onused");
                        swal({
                            type: 'error',
                            title: 'Oops',
                            text: response.message,
                            timer: 3000,
                            html: true
                        });
                    }
                },
                error: function(){
                    btn.removeClass("onused");
                    swal('Oops', 'Server error, please try again later.', 'error');
                }
            });
        });
    });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_block'],\yii\web\View::POS_END); ?>
