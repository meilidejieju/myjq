
/*
yangyiyin
* 改变背景
* */

function changeBg(ele,bg){
    ele.css("background",bg);
}

/*
* 背景移动
* */
function moveBg(ele,mode){
    //逐渐上升
    if(mode==1){
       // alert(11);
        var top=parseInt(ele.attr("cnt"));
        if(top<-999){
            top=0;
        }
        top--;
        top=String(top);
        ele.css("background-position","1px "+top+"px");
        ele.attr("cnt",top);
    }
}

/*
* 获得内容
* */

function getContent($url,position,changge_class_name,data_out){
    var data = {"data":1,"position":position};
    if(data_out){
        $.extend(data,data_out);
    }

    if(!changge_class_name){
        changge_class_name='#maincontent';
    }
    $(changge_class_name).html("");
    $(".loading").css("display","");
    $.ajax({
        url:$url,
        type: "POST",
        data:data,
        dataType:'text',
        success:function(e){
            //  alert(e)
           $(".loading").css("display","none");
          //  setTimeout("",2000);
            $(".position").text(position);

            $(changge_class_name).html(e);
        },
        error:
            function(){
                alert("error");
            }
    });
}
/*
 * 获得当前位置
 * */

function getPosition($url){
   // $(".loading").css("display","");
    $.ajax({
        url:$url,
        type: "POST",
        data:{"num":1,"act":"addcart"},
        dataType:'text',
        success:function(e){
            //  alert(e)
         //   $(".loading").css("display","none");
        //    setTimeout("",2000);
         //   $('#maincontent').html(e);
        },
        error:
            function(){
                alert("error");
            }
    });
}
