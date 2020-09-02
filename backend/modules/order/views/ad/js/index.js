layui.config({
    base : "js/"
}).use(['form','layer','jquery','element'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var element = layui.element;

    // 查看订单
    $("body").on("click",".layui-default-view",function(){
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "查看广告",
            type: 2,
            area: ['600px', '450px'],
            content : [href, 'yes']
        });
        return false;
    });

    //  修改订单
    $("body").on("click",".layui-default-update",function(){
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "修改广告",
            type : 2,
            area:['600px', '450px'],
            content :[href,"yes"],
            end: function () {
                location.reload();
            }
        });
        return false;
    });

    // 删除订单操作
    $("body").on("click",".layui-default-delete",function(){
        var href = $(this).attr("href");
        layer.confirm('确定删除此广告吗？',{icon:3, title:'提示信息'},function(index){
            $.post(href,function(data){
                if(data.code===200){
                    layer.msg(data.msg);
                    layer.close(index);
                    setTimeout(function(){
                        location.reload();
                    },500);
                }else{
                    layer.close(index);
                    layer.msg(data.msg);
                }
            },"json").fail(function(a,b,c){
                if(a.status==403){
                    layer.msg('没有权限');
                }else{
                    layer.msg('系统错误');
                }
            });
        });
        return false;
    });
});