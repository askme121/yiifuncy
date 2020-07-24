$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $(".lazy").each(function () {
        $(this).css("background-image", $(this).data('bg')).animate({opacity: '1'},1000);
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