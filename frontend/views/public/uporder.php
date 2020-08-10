<div class="modal operation-uporder" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body" style="padding: 0;">
                <p class="offer-ends-container" style="margin-bottom: 0;padding: 15px 0;font-size: 22px;">Your Amazon Order info</p>
                <form id="upOrder-form" enctype="multipart/form-data" method="post" action="#" style="width: 352px;margin: 30px auto 0;">
                    <div class="form-group upOrder-form-group">
                        <label class="form-group-tip" for="order_id"><span class="error">* </span>Order ID:</label>
                        <input class="form-control form-group-input" id="user-submitted-title" type="text" name="order_id" value="" placeholder="e.g. 123-1234567-1234567">
                        <div class="form-group-error error" id="order-id-tips"></div>
                    </div>
                    <div class="upOrder-form-btnss">
                        <a type="button" class="btn upOrder-form-btn jq-submit-order" id="user-submitted-post" style="float: none;" >Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal cancel-surebox" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close model-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body" style="padding: 0;">
                <p class="offer-ends-container" style="margin-bottom: 0;padding: 15px 0;font-size: 22px;">Notice</p>
                <p style="margin: 10px 0 20px; padding: 0 15px">
                    Your quota for purchasing this product will be canceled.
                </p>
                <div style="text-align: center;">
                    <button class="btn upOrder-form-btn" id="cancel-yes" data-url="#">Yes</button>
                    <button class="btn upOrder-form-btn" data-dismiss="modal" aria-label="Close" id="cancel-no" style="margin-left: 60px;">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
