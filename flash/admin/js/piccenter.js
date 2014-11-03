/*
* 业务js
* */

/*
* 单选图片效果
* */
function showPicUrl2(eleclass,showele){
    $("."+eleclass).live("click",function(){

        var url = $(this).find('img').attr('src');
        $("."+eleclass).attr("class",eleclass);
        $(this).attr("class",eleclass+" selectimg");
        showele.text(url);
    });
}

