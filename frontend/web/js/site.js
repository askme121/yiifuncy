$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $(".lazy").each(function () {
        if ($(this).data('bg')){
            $(this).css("background-image", $(this).data('bg')).animate({opacity: '1'},1000);
        }
        if ($(this).data('src')){
            $(this).attr("src", $(this).data('src'));
        }
    });
    $("#detail-img-list li img").each(function () {
        var src = $(this).attr('src');

    });
});

$(document).ready(function(){
    $("#back-top").hide();
    $(window).scroll(function(){
        if($(this).scrollTop() > 200){
            $("#back-top").fadeIn();
        } else {
            $("#back-top").fadeOut();
        }
    });
    $("#back-top").click(function(){
        $("html,body").animate({scrollTop:0},300);
        return false;
    });
});