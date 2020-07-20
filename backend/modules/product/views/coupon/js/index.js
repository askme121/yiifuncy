layui.config({
    base : "js/"
}).use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;

    // 添加分类
    $(".layui-default-add").click(function(){
        var index = layui.layer.open({
            title : "添加优惠券",
            type : 2,
            area: ['800px', '630px'],
            content : ["<?= yii\helpers\Url::to(['create']); ?>",'yes'],
            end: function () {
                location.reload();
            }
        });
    });

    // 查看优惠券
    $("body").on("click",".layui-default-view",function(){
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "查看优惠券",
            type: 2,
            area: ['400px', '450px'],
            content : [href, 'no']
        });
        return false;
    });
});