layui.config({
    base : "js/"
}).use(['form','layer','jquery','element','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery,
        element = layui.element;
    var upload = layui.upload;

    $(".add-button").click(function () {
        var href = $("#w0").attr("action");
        $.post(href,$("#w0").serialize(),function(data){
            if(data.code===200){
                layer.msg(data.msg);
                layer.close();
                setTimeout(function(){
                    location.reload();
                },500);
            }else{
                layer.close();
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

});