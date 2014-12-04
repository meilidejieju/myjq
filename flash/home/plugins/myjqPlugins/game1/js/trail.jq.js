/*
* 赛车游戏
* 碰撞计算
* 碰撞之后的运动
* */



 $.fn.trail=function(){

    $.options= $.extend({
        car:$(".diycar"),
        left:150,
        bottom_line:770,
        speed_:5,
        hindrance_speed:2
    });
    //按键数组
    var keycode=[];
    //主角car
    var car =  $.options.car;
    //系统出现的障碍
    var hindrance ='';
     var hindrance_list =[];

     var left1 = 85;//左边界
     var left2 = 365;//右边界
     var trail_id;

    var speed_ = $.options.speed_;//全局主角速度

     var speed_add_eding=0.1;//全局主角额定加速度
     var speed_add = 0;//全局主角加速度 可以是负数，表示减速度
     var speed_eding = speed_;//全局主角额定速度

    var damage_levle=0;//全局主角毁坏程度

    var hindrance_speed = $.options.hindrance_speed;



    /*
    * 初始化一个障碍
    * 返回这个对象
    * */
    $.init_hindrance= function(num){

        if(hindrance_list.length<3){
            var randleft = Math.floor(Math.random()*224)+85;
            var hindrance_html = '<div class="hindrance'+num+' car3" style="width: 56px;height:90px;position: absolute;top:-40px;left: '+randleft+'px;z-index: 99;"><img style="width: 100%" src="./images/car.png"></div>';
            $("body").append(hindrance_html);
        }
        return $(".hindrance"+num);
      //  return $(".car2");
    }
    /*
    * 障碍向下运动
    * */
    $.downmove = function(ele,speed){
        var top = parseFloat(ele.css("top"));

        top+=speed;

        ele.css("top",top+"px");

    }
    /*
    * 判断是否超过下界限
    * */
    $.checkIsOut = function(ele){
        if(parseInt(ele.css("top"))>= $.options.bottom_line){
            return true;
        }
    }



    /*
     * 碰撞算法,假设物体不会破损
     * 返回两个物体的水平和垂直速度；
     * */
    $.pengzhuang = function(obj1,obj2){
        //弹性系数
        var tanxingxishu = 0.2;
        //动量差
        var dongliang =  obj1.speed*obj1.weight+obj2.speed*obj2.weight;
        //速度差
        var speedcha = obj1.speed-obj2.speed;
        //弹性能量
        var tanxingnengliang
        tanxingnengliang = speedcha*speedcha*tanxingxishu*obj1.weight;

        //假设碰撞不损失动能
        //计算碰撞点，假设上下碰撞,相对于主角来说,按照接触面积的中心点
        var pengzhuangdian = [];
        if((obj2.left-obj1.left)>0){
            if((obj1.left+obj1.width)<(obj2.left+obj2.width)){
                pengzhuangdian[1] =(obj1.width+obj2.left-obj1.left)/(2*obj1.width);
                pengzhuangdian[2] = (obj1.width-obj2.left+obj1.left)/(2*obj2.width);
            }else{
                pengzhuangdian[1] =(obj2.width/2+obj2.left-obj1.left)/obj1.width;
                pengzhuangdian[2] = obj2.width/2;
            }
        }else{
            if((obj1.left+obj1.width)>(obj2.left+obj2.width)){

                pengzhuangdian[1] =(obj2.width-obj1.left+obj2.left)/(2*obj1.width);
                pengzhuangdian[2] =(obj2.width+obj1.left-obj2.left)/(2*obj2.width);
            }else{
                pengzhuangdian[1] =obj1.width/2;
                pengzhuangdian[2] = (obj1.width/2+obj1.left-obj2.left)/obj2.width;
            }
        }
        //质量比
        var weightbi1 = obj1.weight/(obj1.weight+obj2.weight);
        var weightbi2 = obj2.weight/(obj1.weight+obj2.weight);
        //弹性碰撞之后，各自获得动量,计算速度

        obj1.getspeed = Math.sqrt(tanxingnengliang/obj1.weight);
        obj2.getspeed =Math.sqrt(tanxingnengliang/obj2.weight);

        var juedui1=1-pengzhuangdian[1]*2;
        var juedui2=1-pengzhuangdian[2]*2;

        if(juedui1<0){
            juedui1=-juedui1;
        }
        if(juedui2<0){
            juedui2=-juedui2;
        }

        var xspeed1=(1-pengzhuangdian[1]*2)*Math.abs(obj1.getspeed);
     //   var yspeed1=juedui1*obj1.getspeed;
        var yspeed1=obj1.getspeed-Math.abs(xspeed1);
        var xspeed2=(1-pengzhuangdian[2]*2)*Math.abs(obj2.getspeed);
     //   var yspeed2=juedui2*obj2.getspeed;
        var yspeed2=obj2.getspeed-Math.abs(xspeed2);
        return {x1:xspeed1,y1:yspeed1,x2:xspeed2,y2:yspeed2};
    },

    /*
     * 判断物体碰撞，距离判断
     * */
    $.checkpengzhuang = function(obj1,obj2){
//            console.log(obj1);
//            console.log(obj2);
        var TOPjuli = obj1.top-obj2.top;
        var LEFTjuli = obj1.left-obj2.left;
        //    console.log(TOPjuli);
         //   console.log(LEFTjuli);
        if(TOPjuli<=obj2.height&&-TOPjuli<=obj1.height){
            if(LEFTjuli>=0&&LEFTjuli<=obj2.width){

                return true;
            }else{
                if(-LEFTjuli<=obj1.width&&LEFTjuli<=0){
                    //   console.log(3333);
                    return true;
                }
            }
        }
        return false;
    },
    $.movehuandong = function(speed,arg){
        if(speed<0){
            speed=speed+arg;
            if(speed>=0){
                speed=0;
            }
        }else{
            speed=speed-arg;
            if(speed<=0){
                speed=0;
            }
        }
        return speed;
    }

     /*
     * 检测是否在有效区域内
     * */
     $.checkIsInside=function (left,top,returnflag){
         if(left<(left2-56)&&left>left1&&top<840){
             return true;
         }else{
             //返回超出在哪一边
             if(returnflag==1){
                if(left>=(left2-56)){
                    return 'right';
                }
                 else if(left<=left1){
                    return 'left';
                }
                 else{
                    return 'bottom';
                }
             }else{
                 return false;
             }

         }
     }

     /*
     * 初始化物体属性
     * */
     $.initObjAttr = function(top,left,height,width,speed,weight){
         var obj={};
         obj.top=top;

         obj.left=left;
         obj.height=height;
         obj.width=width
         obj.speed=speed;
         obj.weight=weight;
       //  console.log(obj);
         return obj;
     }

    /*
    * 更新界面状态
    * */
     $.updateStatus = function (speed,damage_level,speed_level){
        $('#speed').text("speed:"+speed);
         $('#damage_level').text("damage_level:"+damage_level);
         $('#speed_level').text("speed_level:"+speed_level);
    }
     /*
     * 结束游戏
     * */
     $.gameover = function(){
         alert('游戏结束！');
         clearInterval(bgmoveid);
         clearInterval(trail_id);
         return false;
     }
     /*
     * 初始化游戏
     * */
     $.initGame = function(){

     }

    /*
    * 操作控制
    * */
    $.control=function(){
        var left = parseInt($.options.car.css("left"));
        window.onkeydown  = function(e){
           //向下键无效
            if(e.keyCode==40){
                e.preventDefault();
            }
            keycode[e.keyCode]=true;

        };
        window.onkeyup = function(e){
            keycode[e.keyCode]=false;

           if(e.keyCode==38){
               speed_eding+=0.5;
               speed_add=speed_add_eding;
           }
            if(e.keyCode==40){
                speed_eding-=0.5;
                speed_add=-speed_add_eding;
            }
        }

        if(keycode[39]){

            car.css("left",(left+1)+'px');
        }
        if(keycode[37]){

            car.css("left",(left-1)+'px');
        }
        if(keycode[38]){

        }

    }
    /*
    * 运行函数
    * */
     var bgmoveid=1;
     $.run = function(){
        //背景运动
        bgmoveid=$("body").updownbg({
            bg:$(".bg"),
            bg_height:770,
            bg_move_offset:speed_,
            bg_width:450
        });

         var i=0; //每个一定时间出现一个障碍计数器
         var k=0;//障碍物id
         var hindrance='';//障碍物
         var speedobj=''; //碰撞后的速度对象（包括两个物体各自的横向和纵向速度）
         var speedobjlist=[];//碰撞后需要动画的障碍车数组
         trail_id = setInterval(function(){
            if(i>880){
                hindrance = $.init_hindrance(k);//初始化一个障碍物
                hindrance_list.push(hindrance);//把障碍物放入数组
                //初始化计数器
                i=0;
                k++;
            }
            i+=3;//障碍物产生计数器
            var list=[];
            hindrance_speed=speed_-1;//物体速度
            var aa=0;
            hindrance_list.forEach(function(ele){
                //判断是否在范围以内
                if($.checkIsInside(parseFloat(ele.css("left")),parseFloat(ele.css("top")))){
                    var bb=0;
                    //检测每个车的是否碰撞
                    hindrance_list.forEach(function(ele2){
                        if(bb>aa){
                            var obj1 = $.initObjAttr(parseFloat(ele.css("top")),parseFloat(ele.css("left")),parseFloat(ele.css("height")),parseFloat(ele.css("width")),25,2);
                            var obj2 = $.initObjAttr(parseFloat(ele2.css("top")),parseFloat(ele2.css("left")),parseFloat(ele2.css("height")),parseFloat(ele2.css("width")),25,2);
                            if($.checkpengzhuang(obj1,obj2)&&ele2.attr("class")){
                                ele.css("top",(parseFloat(ele.css('top'))+90)+"px");//把前一个障碍物top+90
                            }
                        }
                        bb++;
                    });

                    $.downmove(ele,hindrance_speed); //障碍物向下运动
                    var is_pengzhuang; //是否碰撞变量
                    //初始化物体属性
                    var obj1 = $.initObjAttr(parseFloat(car.css("top")),parseFloat(car.css("left")),parseFloat(car.css("height")),parseFloat(car.css("width")),(25+speed_),2);
                    var obj2 = $.initObjAttr(parseFloat(ele.css("top")),parseFloat(ele.css("left")),parseFloat(ele.css("height")),parseFloat(ele.css("width")),25,2);
//                    console.log(obj2);
                    //检测是否碰撞
                    is_pengzhuang = $.checkpengzhuang(obj1,obj2);
                //    console.log(is_pengzhuang);
                    //如果碰撞
                    if(is_pengzhuang===true){
                        speedobj=$.pengzhuang(obj1,obj2);//获得速度对象
                        speedobjlist.push({"ele":ele,"speedobj":speedobj,"obj2":obj2,"toplenth":speed_-1});//记录碰撞中的物体到数组
                        damage_levle+=speed_*4;
                        speed_eding=speed_/2;//额定速度减小1
                        speed_=speed_/2+0.1;

                     //   speed_add=-speed_add_eding;//减速度変更
                    }
                    list.push(ele);//新的障碍物数组
                }else{
                    ele.remove();
                }
                aa++;
            });
            hindrance_list = list;//重新获取障碍物数组

            var speedlist=[]; //碰撞状态的障碍物新数组
            speedobjlist.forEach(function(data){
                if(data.speedobj.x2||data.toplenth){
                    data.ele.css("top",(parseInt(data.ele.css("top"))-data.toplenth)+'px');
                    data.toplenth =  $.movehuandong(data.toplenth,0.1);
                    data.ele.css("left",(parseFloat(data.ele.css("left"))+data.speedobj.x2)+'px');
                    data.speedobj.x2 = $.movehuandong(data.speedobj.x2,0.02);
                    speedlist.push(data);
                }
            });
            speedobjlist = speedlist;//赋值碰撞状态的障碍物新数组
            car.css("left",(parseInt(car.css("left"))+speedobj.x1)+'px');   //主角运动
            speedobj.x1 = $.movehuandong(speedobj.x1,0.05);


            //检测主角是否在区域内
            var iscarout = $.checkIsInside(parseFloat(car.css("left")),parseFloat(car.css("top")),1);
           switch (iscarout){
               case 'left':
                   car.css("left",85+"px");
                   damage_levle+=0.01;
                   break;
               case 'right':
                   car.css("left",309+"px");
                   damage_levle+=0.01;
                   break;
               default :
                   break;
           }
            $.updateStatus(speed_,damage_levle,speed_eding);//更新实时速度等界面信息
            if(damage_levle>=100){
                return $.gameover();
            }

            $.control(); //用户输入控制
        },1);
         setInterval(function(){
            //全局速度最小为1
            if(speed_eding<1){
                speed_eding=1;
            }
            //全局速度最大为10
            if(speed_eding>10){
                speed_eding=10;
            }
            //主角全局速度
            if(Math.abs(speed_-speed_eding)>=speed_add_eding||speed_<0){
                speed_+=speed_add;
                //全局速度最小为1
                if(speed_<=0){
                    speed_=0;
                }
                //全局速度最大为10
                if(speed_>10){
                    speed_=10;
                }
                clearInterval(bgmoveid);
                bgmoveid=$("body").updownbg({
                    bg:$(".bg"),
                    bg_height:770,
                    bg_move_offset:speed_,
                    bg_width:450
                });
            }

        },100)


    }
    //运行
    $.run();
}