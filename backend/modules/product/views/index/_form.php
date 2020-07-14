<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use backend\assets\LayuiAsset;
use common\models\AttributeGroup;

$this->registerJs($this->render('js/form.js'));
LayuiAsset::addScript($this, 'plugins/kindeditor/kindeditor-all-min.js');
LayuiAsset::addScript($this, 'plugins/kindeditor/lang/zh-CN.js');
$category_parent = Category::formatTree(true);
$attr_group_root['0'] = 'default';
$attr_group = AttributeGroup::formatList();
$attr_group = $attr_group_root + $attr_group;
?>
<style type="text/css">
    .layui-tab-item{
        top: 80px;
        left: 30px;
        padding-right: 20px;
    }
    .product_image{
        position: absolute;
        right: 20px;
        top: 327px;
        z-index: 0;
    }
    .upload_input{
        width: 77.7%;
    }
    .layui-form-select{
        padding: 5px 8px;
    }
</style>
<div class="auth-item-form create_box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>Meta部分</li>
            <li>其他部分</li>
            <li>描述部分</li>
            <li>属性部分</li>
            <li>多图信息</li>
        </ul>
        <div class="layui-tab-content" style="min-height: 550px;">
            <div class="layui-tab-item layui-show">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'sku')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'url_key')->textInput(['class'=>'layui-input']) ?>
                <?= $form->field($model, 'category_id')->dropDownList($category_parent) ?>
                <?= $form->field($model, 'image',['template' => '{label} <div class="row"><div class="col-sm-12">{input}<button type="button" class="layui-btn upload_button" id="test3"><i class="layui-icon"></i>上传图片</button>{error}{hint}</div></div>'])->textInput(['maxlength' => true,'class'=>'layui-input upload_input']) ?>
                <div class="form-group">
                    <?= Html::activeHiddenInput($model,'thumb_image') ?>
                    <?= Html::img(@$model->thumb_image, ['width'=>'50','height'=>'50','class'=>'product_image'])?>
                </div>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 255,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'meta_description')->textarea(['maxlength' => 255,'class'=>'layui-textarea']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'status')->dropDownList(['1'=>'激活', '2'=>'关闭'])?>
                <?= $form->field($model, 'order')->input('number',['value'=>$model->order??100,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'long')->input('number',['value'=>$model->long??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'width')->input('number',['value'=>$model->width??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'high')->input('number',['value' =>$model->high??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'weight')->input('text',['value' =>$model->weight??0,'class'=>'layui-input']) ?>
                <?= $form->field($model, 'volume_weight')->input('text',['value' =>$model->volume_weight??0,'class'=>'layui-input']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'short_description')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:200px;']) ?>
                <?= $form->field($model, 'description')->textarea(['class'=>'layui-textarea', 'style'=>'width:100%;height:230px;']) ?>
            </div>
            <div class="layui-tab-item">
                <?= $form->field($model, 'attr_group')->dropDownList($attr_group)?>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'attr_group_info'), null, [])?>
                </div>
                <div id="attr_info">

                </div>
            </div>
            <div class="layui-tab-item mutil_image">
                <div class="layui-tab currs">
                    <table class="layui-table">
                        <thead class="layui-table-header">
                        <tr>
                            <th style="text-align: center">图片</th>
                            <th style="text-align: center">排序</th>
                            <th style="text-align: center">操作</th>
                        </tr>
                        </thead>
                        <tbody class="layui-table-body">
                        <?php if(!empty($model->mutil_image) && is_array($model->mutil_image)){  ?>
                            <?php foreach($model->mutil_image as $key=>$one){ ?>
                                <tr align="center">
                                    <td>
                                        <input name="Product[mutil_image][<?= $key?>][image]" class="layui-input" type="hidden" value="<?= $one['image'] ?>">
                                        <input name="Product[mutil_image][<?= $key?>][thumb_image]" class="layui-input" type="hidden" value="<?= $one['thumb_image'] ?>">
                                        <img src="<?= $one['thumb_image'] ?>" width="50">
                                    </td>
                                    <td>
                                        <input name="Product[mutil_image][<?= $key?>][order]" class="layui-input" type="number" value="<?= $one['order'] ?>">
                                    </td>
                                    <td>
                                        <i class="fa fa-trash-o"></i>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-upload" style="margin-top: 20px">
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" align='right'>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'create') : Yii::t('app', 'update'), ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    <?php $this->beginBlock('editor') ?>
    function ajaxInfo(group_id, attr_info){
        if (group_id == 0){
            $("#attr_info").html('');
            return;
        }
        var href = '/product/attributegroup/child?id='+group_id;
        $.post(href,{attr_info: attr_info},function(data){
            if(data.code===200){
                $("#attr_info").html(data.data);
            }else{
                layer.msg(data.msg);
            }
        },"json").fail(function(a,b,c){
            if(a.status==403){
                layer.msg('没有权限');
            }else{
                layer.msg('系统错误');
            }
        });
    }
    $(document).ready(function(){
        <?php if ($model->attr_group){?>
        ajaxInfo(<?= $model->attr_group?>, '<?= serialize($model->attr_group_info)?>');
        <?php }?>
        $("body").off("change").on("change","#product-attr_group",function(){
            var val = $(this).val();
            if (val == 0) {
                $("#attr_info").html('');
            } else {
                ajaxInfo(val, '<?= serialize($model->attr_group_info)?>');
            }
        });
    });
    // 关闭过滤模式，保留所有标签
    KindEditor.options.filterMode = false;
    var option = {
        items: [
            'source', 'undo', 'redo', 'preview', 'cut', 'copy', 'paste',
            'plainpaste', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'selectall',
            'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'image', 'multiimage',
            'table', 'hr',
            'anchor', 'link', 'unlink', 'fullscreen'
        ],
        uploadJson : "<?=yii\helpers\Url::to(['/tools/uploadeditor'])?>",
        fileManagerJson : "<?=yii\helpers\Url::to(['/tools/uploadmanage'])?>",
        allowFileManager : true,
    };
    KindEditor.ready(function(K) {
        window.editor = K.create('#product-short_description', option);
        window.editor1 = K.create('#product-description', option);
    });
    <?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['editor'],\yii\web\View::POS_END);
?>