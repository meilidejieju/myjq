//换背景
/*
 * 参数设置
 * */
var myColor = $("#my_color").text();

function changeBackgroundPic(new_path,ele){
    ele.css("background",new_path);
}

//如果有字输入，输入框字体颜色加深，默认值消失
function textChange(ele,index_text,value){
   if(value==1){
        if(ele.val()==index_text){
            ele.css("color","#000");
            ele.val("");
        }
    }else{
       if(ele.val()==''){
           ele.css("color","#ddd");
           ele.val(index_text);
       }else{

       }
   }
}

//向下翻转box
function downBox(ele,time,height){
    var a=0;
   // var end_height = parseInt(start_height)+parseInt(height);
    var s = setInterval(function(){
        ele.css("margin-top",a+"px");
        a++;
//        if(a>=end_height){
//            a = 0;
//            setTimeout(s)
//        }
    },time/height);
//    if(ele.animate({top:height+"px"},time)){
//       return 1;
    }

    //ele.css("margin-top",0);





