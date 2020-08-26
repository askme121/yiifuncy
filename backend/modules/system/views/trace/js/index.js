layui.config({
    base : "js/"
}).use(['form','layer','jquery'],function() {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;

    $("body").on("click",".layui-default-view",function(){  //查看
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "查看",
            type : 2,
            area: ['600px', '600px'], //宽高
            content : href
        });
        return false;
    });
});