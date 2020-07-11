layui.config({
    base : "js/"
}).use(['form','layer','jquery','element','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery,
        element = layui.element;
    var upload = layui.upload;

    var total_image = 1000;

    upload.render({
        elem: '#test3',
        url: "<?=yii\helpers\Url::to(['/tools/uploadthumb?is_thumb=1&width=250&height=250'])?>",
        done: function(res){
            if(res.code==200){
                $("#product-image").val(res.data);
                $("#product-thumb_image").val(res.thumb_data);
                $(".product_image").attr('src',res.thumb_data);
                layer.msg("上传成功");
            }else{
                layer.msg("上传失败");
            }
        },
        error: function(){
            layer.msg("请求异常");
        }
    });

    upload.render({
        elem: '#test1',
        url: "<?=yii\helpers\Url::to(['/tools/uploadthumb?is_thumb=1&width=250&height=250'])?>",
        done: function(res){
            if(res.code==200){
                str = "<tr align='center'>";
                str += "<td><input name='Product[mutil_image]["+ total_image +"][image]' class='layui-input' type='hidden' value='"+ res.data +"'><input name='Product[mutil_image]["+ total_image +"][thumb_image]' class='layui-input' type='hidden' value='"+ res.thumb_data +"'><img src='"+ res.thumb_data +"' width='50'></td>";
                str += "<td><input class='layui-input' name='Product[mutil_image]["+ total_image +"][order]' value='10' type='number' /></td>";
                str += "<td><i class='fa fa-trash-o'></i></td>";
                str += "</tr>";
                $(".currs table tbody").append(str);
                total_image++;
                $("#product-image").val(res.data);
                $("#product-thumb_image").val(res.thumb_data);
                $(".product_image").attr('src',res.thumb_data);
                layer.msg("上传成功");
            }else{
                layer.msg("上传失败");
            }
        },
        error: function(){
            layer.msg("请求异常");
        }
    });

    $("#test1").click(function () {

    });
});