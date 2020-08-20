<?php
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
                <form id="upmsg-form" enctype="multipart/form-data" method="post" action="#">
                    <div class="form-group">
                        <label><span class="error">*</span>Subject:</label>
                        <input class="form-control" type="text" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label><span class="error">*</span>Content:</label>
                        <textarea name="content" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <a type="button" class="btn upOrder-form-btn jq-submit-order" id="msg-submit">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
