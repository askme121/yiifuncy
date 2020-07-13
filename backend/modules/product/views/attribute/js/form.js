layui.config({
    base : "js/"
}).use(['form','layer','jquery','element','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery,
        element = layui.element;
    var upload = layui.upload;

    $(".addItems").click(function(){
        str = "<tr>";
        str +="<td><input name='Attribute[display_data][]' class='layui-input' type='text' /></td>";
        str +="<td><i class='fa fa-trash-o'></i></td>";
        str +="</tr>";
        $(".items table tbody").append(str);
    });
    $("body").off("click").on("click",".items table tbody tr td .fa-trash-o",function(){
        $(this).parent().parent().remove();
    });
    $("body").off("change").on("change","#attribute-display_type",function(){
        var val = $(this).val();
        if (val != 'select' && val != 'editSelect' ) {
            $(".items").hide();
        } else {
            $(".items").show();
        }
    });
});