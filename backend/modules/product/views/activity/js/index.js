layui.config({
    base : "js/"
}).use(['form','layer','jquery','element'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var element = layui.element;

    // 添加分类
    $(".layui-default-add").click(function(){
        var index = layui.layer.open({
            title : "添加活动",
            type : 2,
            area: ['800px', '630px'],
            content : ["<?= yii\helpers\Url::to(['create']); ?>",'yes'],
            end: function () {
                location.reload();
            }
        });
    });

    $(".thumb").mouseover(function () {
        $(this).animate({
            opacity: '0.8'
        });
    }).mouseout(function () {
        $(this).animate({
            opacity: '1'
        });
    })

    //  全选
    form.on('checkbox(allChoose)', function(data){
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
        child.each(function(index, item){
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });

    // 通过判断是否全部选中来确定全选按钮是否选中
    form.on("checkbox(choose)",function(data){
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
        var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
        if(childChecked.length === child.length){
            $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
        }else{
            $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
        }
        form.render('checkbox');
    });

    // 查看分类
    $("body").on("click",".layui-default-view",function(){
        var href = $(this).attr("href");
        var index = layui.layer.open({
            title : "查看活动",
            type: 2,
            area: ['600px', '450px'],
            content : [href, 'yes']
        });
        return false;
    });
    //  启用操作
    $("body").on("click",".layui-default-active",function(){
        var href = $(this).attr("href");
        layer.confirm('确定启用此活动吗？',{icon:3, title:'提示信息'},function(index){
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
    //  禁用操作
    $("body").on("click",".layui-default-copy",function(){
        var href = $(this).attr("href");
        layer.confirm('确定复制此活动吗？',{icon:3, title:'提示信息'},function(index){
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
    //  修改分类
    $("body").on("click",".layui-default-update",function(){
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "修改活动",
            type : 2,
            area:['800px', '630px'],
            content :[href,"yes"],
            end: function () {
                location.reload();
            }
        });
        return false;
    });
    //  删除分类操作
    $("body").on("click",".layui-default-delete",function(){
        var href = $(this).attr("href");
        layer.confirm('确定取消此活动吗？',{icon:3, title:'提示信息'},function(index){
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

    function set_show(obj){
        var Url = obj.data('url');
        parent.layui.index.openTabsPage(Url, obj.attr("data-title"));
    }
});