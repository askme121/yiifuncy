function changeTableVal(table,id_name,id_value,field,obj)
{
    var src = "";
    if($(obj).hasClass('no'))
    {
        $(obj).removeClass('no').addClass('yes');
        $(obj).html("<i class='fa fa-check-circle'></i>YES");
        var value = 1;
    }
    else if($(obj).hasClass('yes'))
    {
        $(obj).removeClass('yes').addClass('no');
        $(obj).html("<i class='fa fa-ban'></i>NO");
        var value = 0;
    }
    else
    {
        var value = $(obj).val();
    }
    $.ajax({
        url:"/site/dump?table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,
        dataType: 'json',
        success: function(data)
        {
            if (data.code == 200) {
                layer.msg(data.msg, {icon: 1,time:2000});
            } else {
                layer.msg(data.msg, {icon: 2,time:2000});
            }
        }
    });
}