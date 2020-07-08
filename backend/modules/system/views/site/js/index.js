layui.config({
    base : "js/"
}).use(['form','layer','jquery'],function() {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;

    $(window).one("resize",function(){
        $(".layui-default-add").click(function(){
            var index = layui.layer.open({
                title : "添加站点",
                type : 2,
                area: ['400px', '600px'],
                content : "<?= yii\helpers\Url::to(['create']); ?>",
                end: function () {
                    location.reload();
                }
            });
        });
    }).resize();

    $("body").on("click",".layui-default-view",function(){  //查看
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "查看站点",
            type : 2,
            area: ['400px', '600px'], //宽高
            content : href
        });
        return false;
    });

    $("body").on("click",".layui-default-update",function(){  //修改
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "修改站点",
            type : 2,
            area: ['400px', '600px'],
            content : href,
            end: function () {
                location.reload();
            }
        });
        return false;
    });
});