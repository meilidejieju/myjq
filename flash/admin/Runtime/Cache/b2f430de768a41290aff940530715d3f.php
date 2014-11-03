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
        <script type="text/javascript">
            /*随即背景*/
            $(document).ready(function(){
                changeBg($(".background"),'url("<?php echo ($base_url); ?>/flash/admin/images/bg1.jpg")');
                $(".yanzhengma_img").click(function(){
                    $(this).attr("src","<?php echo ($base_url); ?>/admin.php/Index/yanzhengma?w="+Math.random());
                });

            });


        </script>
        <div class="background"></div>
        <form method="post" action="./admin.php/Index/login" id="login_form">
        <div class="login">
            <div class="login_info">
                <div class="item">
                    <div class="info"><?php echo ($langZh["login"]); ?>：</div><input class="username" name = "username" value=""/>
                </div>
                <div class="item">
                    <div class="info"><?php echo ($langZh["password"]); ?>：</div><input type="password" class="password" name = "password" value=""/>
                </div>
                <div class="item">
                    <div class="info"><?php echo ($langZh["yanzhengma"]); ?>：</div>
                    <div>
                        <li>
                            <input class="yanzhengma" name = "yanzhengma" value=""/>
                        </li>
                        <li>
                            <img class="yanzhengma_img" style="width:78px;height:28px;border: 1px solid #999;border-radius:3px;margin-left: 10px;" src="<?php echo ($base_url); ?>/admin.php/Index/yanzhengma"/>
                        </li>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="login_area">
               <input style="display: none" type="button" class="login_bt" onclick="javascript:this.form.submit()" name = "login_bt" value="<?php echo ($langZh["login"]); ?>"/>
                <script>
                    $(document).ready(function(){
                        $(document).keypress(function(event){
                            var keycode = (event.keyCode ? event.keyCode : event.which);

                            if(keycode == '13'){
                                $("#login_form").submit();
                            }
                        })
                    })
                </script>
            </div>


        </div>
        </form>

        </body>

</html>