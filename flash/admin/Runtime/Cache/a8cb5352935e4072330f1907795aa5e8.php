<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>MYLOG</title>
    <link href="<?php echo ($base_url); ?>/flash/admin/css/style.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ($base_url); ?>/flash/admin/css/login.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ($base_url); ?>/flash/admin/css/main.css" type="text/css" rel="stylesheet">
    <script src="<?php echo ($base_url); ?>/flash/admin/js/jquery.1.4.2.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/js/base.js"></script>

</head>

        <body>
        <script>
            $(document).ready(function(){
                setInterval("moveBg($('.topbg'),1)",60);
            })
        </script>

        <div class="topbox">
            <div class="topbg" cnt='0'>
                <li>
                    <img width="20" src="<?php echo ($base_url); ?>/flash/admin/images/user.png"/>

                    <span><?php echo ($langZh["welcome"]); ?>,<?php echo ($admin_username); ?>！<a class="exit" href="<?php echo ($base_url); ?>/admin.php"><?php echo ($langZh["exit"]); ?></a></span>
                </li>
            </div>
        </div>
        <div class="body">
            <div class="bg">

            </div>
            <div class="main">
                <ul class="dropdown">
    <?php echo ($left_menu); ?>
</ul>

<script src="<?php echo ($base_url); ?>/flash/admin/js/jquery_2.1.min.js" type="text/javascript"></script>
<script src="<?php echo ($base_url); ?>/flash/admin/js/tendina.js"></script>
<script>


    $('.dropdown').tendina({
        animate: true,
        speed: 500,
        openCallback: function($clickedEl) {
            console.log($clickedEl);
        },
        closeCallback: function($clickedEl) {
            console.log($clickedEl);
        }
    });

   $(document).ready(function(){
       $('.dropdown a').click(function(){
           if(!$(this).parent().find("ul").attr("class")&&$(this).attr('class')!='cur'){
               $('.dropdown a').attr("class","");
               $(this).attr("class","cur");
               var url=$(this).attr("au");
               var level=$(this).attr("level");
               var position= new Array();
               var parent='.';
               for(var i=1;i<=level;i++){
                  // alert (eval("$(this)"+parent+"text()"));
                   position[i]=eval("$(this)"+parent+"text()");
                   parent+='parent("li").parent("ul").prev().';
               }
               var position_str='';
               for(i=level;i>=1;i--){
                   position_str+= position[i]+'>';
               }

               if(position_str){
                   position_str = position_str.substring (0,position_str.length-1);
               }

               if(url&&url!='#'){
                   getContent(url,position_str);

               }



           }
       })
   })
</script>
                <div class="maincontent">
                    <div id="maincontent">
                    </div>

                    <div class="loading" style="display: none;block;width:200px;color:#999;margin: 0 auto;margin-top: 200px;font-size: 12px;"><img width="20px;" src="<?php echo ($base_url); ?>/flash/admin/images/loading2.gif">我正在努力加载...</div>
                    <script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/js/jquery.reveal.js"></script>
<link href="<?php echo ($base_url); ?>/flash/admin/css/reveal.css" type="text/css" rel="stylesheet">
<div id="poping" class="reveal-modal">

    <div class="poping_content">

    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>
                    <!--CONTENT-->
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--缓存-->
        <input id = "img_url" value="" type="hidden"/>
        </body>

</html>