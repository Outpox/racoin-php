/**
 * Created by ponicorn on 21/01/15.
 */
$(".min_img").click(function(){
    $("#main_img").attr("src", $(this).attr("src") );
    $("#zoomImg img").attr("src", $(this).attr("src") );
});

$("#main-img").click(function(){
    $("#zoomImg").css({"visibility":"visible"});
});

$("#zoomClose").click(function(){
    $("#zoomImg").css({"visibility":"hidden"});
});
