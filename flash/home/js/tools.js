$(document).ready(function(){
    /*
    * 参数设置
    * */
    var myColor = $("#my_color").text();

    /*
    * 提交按钮样式一
    * */
    $(".unno_submit_input").mouseover(function(){
        changeBackgroundPic('url("../../images/yes_.png") no-repeat center',$(this));
        $(this).css("border-bottom","1px solid "+myColor);
    });
    $(".unno_submit_input").mouseleave(function(){
        changeBackgroundPic('url("../../images/yes.png") no-repeat center',$(this));
        $(this).css("border-bottom","1px #ddd solid");
    });


    /*
    *
    * 输入框样式一
    * */
    $(".unno_search_input").focus(function(){
        textChange($(this),"请输入...",1);
    });
    $(".unno_search_input").blur(function(){
        textChange($(this),"请输入...",0);
    });






});
