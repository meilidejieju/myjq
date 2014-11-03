/*
* 业务js
* */

/*
* 单选图片效果
* */
function selectPicSingle(eleclass,is_fill,fill_ele,showpic){
    $("."+eleclass).live("click",function(){
        //变换class，通过css增加样式
      //  if($(this).attr("class")==eleclass){
         $("."+eleclass).attr("class",eleclass);
         $(this).attr("class",eleclass+" selectimg");
//        }else{
//            $(this).attr("class",eleclass);
//        }

        //是否填充
        if(is_fill){
            var fill_data = $(".selectimg").find("img").attr("src");
            fillindata(fill_ele,fill_data);
        }
        showminpic(showpic,fill_data)
    });
}
/*
* 填充选中的路径到指定input
* */
function fillindata(ele,data){
    ele.val(data);
}
/*
* 展示缩略图
* */
function showminpic(showpic,fill_data){

    showpic.attr("src",fill_data);
    showpic.css('display',"");
}