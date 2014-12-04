$.fn.updownbg=function(options){

    $.options = $.extend({
        bg:$(".bg"),
        bg_height:770,
        bg_move_offset:3,
        bg_width:450
    });
    if(options){
        $.extend($.options,options);
    }

    var bg = $.options.bg;
    //初始化上面一个box
    $.init = function(){
        bg.css({"position":"absolute","top":0});
        if($(".bgclone").attr("class")!=undefined){
            $(".bgclone").css({"position":"absolute","top":-$.options.bg_height+"px"});
        }else{
            var bgclone = bg.clone();
            bgclone.attr("class","bgclone");
            bgclone.css({"position":"absolute","top":-$.options.bg_height+"px","width":$.options.bg_width+"px","height":$.options.bg_height+"px"});
            $("body").append(bgclone);
        }
    }
    //向下移动
    $.move=function(){
        var top = parseFloat(bg.css("top"));
        var clone_top = parseFloat($(".bgclone").css("top"));
      //  console.log(clone_top);
        top+= $.options.bg_move_offset;
        clone_top+=$.options.bg_move_offset;
        bg.css("top",top);
        $(".bgclone").css("top",clone_top);
    }

    //判断是否到达一轮，如果是，删除原来的bg，重新初始化
    $.checkIsLoop = function(){

        if(parseFloat(bg.css("top"))>=$.options.bg_height){
            return true;
        }else{
            return false;
        }
    }

    //入口函数
    $.run = function(){
        if($(".bgclone").attr("class")){

        }else{
            $.init();
        }
   //     $.init();
        var id;
        id = setInterval(function(){
            $.move();
            if($.checkIsLoop()===true){
                $.init();
            }
        },1);
        return id;
    }

    return $.run();



}