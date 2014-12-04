/*
* 抽奖一
* */
$.fn.prize=function(){
    var options={
        boxclass :'prize',
        itemclass:'item',
        itemtopclass:'itemtop',
        delay:1,
        boxheight:50,
        itemtop:-50,
        start_round:31,
        end_round:32,
        round:65,
        speed:0.2
    }
    //最快间隔毫秒数，速度
  //  var speed = options.delay;
    //轮数
    var round = 1;
    //阶段
    var timing = 1;
    //运动函数
//    var  action = function(){
//        var i;
//        i=window.setInterval(function(){
//            downitem(item1,itemtop1);
//        },1);
//        return i;
//    }
    //每一个运动的对象
    var prizebox = $("."+options.boxclass);
   var item = $("."+options.boxclass).find("."+options.itemclass);
    var itemtop = $("."+options.boxclass).find("."+options.itemtopclass);
    //第一个
   var item1= item.eq(0);
    var itemtop1= itemtop.eq(0);

    //向下运动

   var  downitem = function(ele,eletop){
        var item1_top = Math.round(parseFloat(ele.css("top"))*100)/100;
       var itemtop1_top =  Math.round(parseFloat(eletop.css("top"))*100)/100;
       //原始1的高度
        var nextitem1top = item1_top+options.speed;
       //原始1上面box的高度
       var nextitemtop1top = itemtop1_top+options.speed;

       if(nextitem1top>=options.boxheight){
           eletop.css('top','0px');
         //  eletop.css('top',options.itemtop+'px');

           //克隆上面的那个box
           var itemtop1clone = itemtop1.clone(1);
           //把top设置为初始化
           itemtop1clone.css('top',options.itemtop+"px");
           //随机数填充
           itemtop1clone.text(Math.random());
           ele.remove();
           prizebox.append(itemtop1clone);
           item1 = eletop;
           itemtop1 =itemtop1clone;
//            //轮数+1
           round+=1;
           if(round==options.start_round){
               //阶段更换
               timing = '2';
            //   options.speed+=1;

           }
           else if(round==options.round-options.end_round){
               timing = '3';

           }
           else if(round>=options.round){
               timing = '4';

           }

       }else{

           ele.css('top',nextitem1top+'px');
           eletop.css('top',nextitemtop1top+'px');
       }
       if(timing==1){
           options.speed+=0.002;
           if(options.speed>=options.boxheight){
               options.speed=options.boxheight;
           }
       }
       else if(timing==2){

       }
       else if(timing==3){
           options.speed-=0.002;
           if(options.speed<=0.2){
               options.speed=0.2;
           }
       }
       else if(timing==4){
           window.clearInterval(i);
       }

//       console.log(nextitem1top);



    }

//    //执行
    var i = window.setInterval(function(){
        downitem(item1,itemtop1);
    },options.delay);


}