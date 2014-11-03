/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-8-26
 * Time: 下午2:06
 * To change this template use File | Settings | File Templates.
 */
var audio = document.createElement("audio");
audio.id = "tishiyin_handle";
audio.src = "http://localhost/myblog/flash/home/music/ruguoyunzhidao.mp3";

    if(window.addEventListener){
        audio.addEventListener("canplaythrough", function () {
            if (audio != null && audio.canPlayType && audio.canPlayType("audio/mpeg"))
            {
                audio.pause();
            }else{
                alert("您的浏览器不支持放音效");
            }

        }, false);
    }else{

        audio.attachEvent("canplaythrough", function () {

            if (audio != null && audio.canPlayType && audio.canPlayType("audio/mpeg"))

            {
                audio.pause();
            }else{
                alert("您的浏览器不支持放音效");
            }

        });
    }

$(document).ready(function(){

    $(".btn_play").click(function(){
        var src=$('.music_item').eq(0).attr("music_name");
        changgeMusic(src);
        $("#music_status").val(1);
        $(this).css("display","none");
        $('.icon_play').css("display","");
    });

    $('.icon_play').mouseover(function(){
        $(".music_list").fadeIn();
    });
    $(".music_list").mouseover(function(){
        $(this).stop();
        $(".music_list").fadeIn();
//        $(".music_list").css("display","");
    })
    $('.icon_play,.music_list').mouseleave(function(){
        $(".music_list").stop();
        $(".music_list").fadeOut();
    });

    $('.music_item').click(function(){
        var src=$(this).attr("music_name");
        changgeMusic(src);
        var nextid=parseInt($(this).attr("item"))+1;
        if(nextid>=$('.music_item').length){
            nextid=0;
        }
        $("#music_status").attr("nextmusic",nextid);



    });

    setInterval("nextmusic($('.music_item').eq($('#music_status').attr('nextmusic')).attr('music_name'),$('#music_status').attr('nextmusic'))",3000);

});
function changgeMusic(src){
    audio.src = src;
    if(window.addEventListener){
        audio.addEventListener("canplaythrough", function () {
            audio.play();
        })
    }else{
        audio.attachEvent("canplaythrough", function () {
            audio.play();
        })
    }
}
function nextmusic(src,id){
    if(audio.ended){
        changgeMusic(src);
        var nextid=parseInt(id)+1;
      //  alert(nextid);
        if(nextid>=$('.music_item').length){
            nextid=0;
        }
        $("#music_status").attr("nextmusic",nextid);
    }
}
