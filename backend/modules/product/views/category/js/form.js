layui.config({
    base : "js/"
}).use(['form','layer','jquery','element','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery,
        element = layui.element;
    var upload = layui.upload;

    upload.render({
        elem: '#test3',
        url: "<?=yii\helpers\Url::to(['/tools/uploadthumb?is_thumb=1&width=50&height=50'])?>",
        done: function(res){
            if(res.code==200){
                $("#category-image").val(res.data);
                $("#category-thumb_image").val(res.thumb_data);
                $(".category_image").attr('src',res.thumb_data);
                layer.msg("上传成功");
            }else{
                layer.msg("上传失败");
            }
        },
        error: function(){
            layer.msg("请求异常");
        }
    });
});