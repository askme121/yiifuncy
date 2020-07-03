layui.config({
    base : "js/"
}).use(['form','layer','jquery'],function(){
    var layer = layui.layer, $ = layui.jquery;

    $("body").on("change",".group_resource input[type='checkbox']",function(){
        var checked = $(this).is(':checked');
        if (!checked){
            $(this).parent().parent().find('ul').find("input[type='checkbox']").prop("checked", false);
        }
    });
});