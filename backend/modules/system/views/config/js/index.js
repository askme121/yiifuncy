layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;

	$(window).one("resize",function(){
		$(".layui-default-add").click(function(){
			var index = layui.layer.open({
				title : "添加配置项",
				type : 2,
                area: ['600px', '500px'], //宽高
				content : "<?= yii\helpers\Url::to(['create']); ?>",
                end: function () {
                    location.reload();
                }
			});	
		});
	}).resize();

    $(window).one("resize",function(){
        $(".layui-basic-add").click(function(){
            var index = layui.layer.open({
                title : "添加配置项",
                type : 2,
                area: ['600px', '500px'], //宽高
                content : "<?= yii\helpers\Url::to(['createbasic']); ?>",
                end: function () {
                    location.reload();
                }
            });
        });
    }).resize();

	//全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

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
 
	//操作
	$("body").on("click",".layui-default-view",function(){  //查看
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "查看配置项",
            type : 2,
            area: ['600px', '500px'], //宽高
            content : href
        });	
        return false;
	});
    
	$("body").on("click",".layui-default-update",function(){  //修改
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "修改配置项",
            type : 2,
            area: ['600px', '500px'],
            content : href,
            end: function () {
                location.reload();
            }
        });	
        return false;
	});

	$("body").on("click",".layui-default-delete",function(){  //删除
        var href = $(this).attr("href");
		layer.confirm('确定删除此配置项吗？',{icon:3, title:'提示信息'},function(index){
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

    $(".addLanguage").click(function(){
        str = "<tr>";
        str += "<td><input class=\"layui-input lang_name\" type=\"text\" /></td>";
        str += "<td><input class=\"layui-input lang_code\" type=\"text\" /></td>";
        str += "<td><i class='fa fa-trash-o'></i></td>";
        str += "</tr>";
        $(".langs table tbody").append(str);
    });
    $(".systemConfig").off("click").on("click",".langs table tbody tr td .fa-trash-o",function(){
        $(this).parent().parent().remove();
    });

    $(".addCurrency").click(function(){
        str = "<tr>";
        str += "<td><input class=\"layui-input currency_code\" type=\"text\" /></td>";
        str += "<td><input class=\"layui-input currency_symbol\" type=\"text\" /></td>";
        str += "<td><input class=\"layui-input currency_rate\" type=\"text\" /></td>";
        str += "<td><i class='fa fa-trash-o'></i></td>";
        str += "</tr>";
        $(".currs table tbody").append(str);
    });
    $(".systemConfig").off("click").on("click",".currs table tbody tr td .fa-trash-o",function(){
        $(this).parent().parent().remove();
    });
});
