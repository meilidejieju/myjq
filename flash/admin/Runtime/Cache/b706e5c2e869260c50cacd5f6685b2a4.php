<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($base_url); ?>/flash/home/css/style_popular.css" media="all" rel="stylesheet" >
<script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/js/works.js"></script>
<div>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>

        <div class="content">
            <li>
                作品名称:
                <input type="text" name="subject" id="subject" value="<?php echo ($workinfo["subject"]); ?>" style="width: 300px;">
            </li>
            <li>
                上传日期:
                <input type="text" name="post_time" id="post_time" style="width: 200px;" value="<?php echo ($time); ?>">
            </li>
            <li>
                作品描述:<br/>
                <textarea  name="description" id = "description" style="width: 500px;" ><?php echo ($workinfo["description"]); ?></textarea>
            </li>


            <li>
                选择图片:<img id="showpic" style="display:<?php echo ($minpic_display); ?>" src="<?php echo ($workinfo["picurl"]); ?>" width="30">
                <input type="hidden" name="picurl"  value="<?php echo ($workinfo["picurl"]); ?>" id="picurl" >
                <div id="picturecenterbox">
                    <link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/images.css" rel="stylesheet"/>
<div class="images" style="margin-top: 20px;">
    <?php if(is_array($imagelist)): foreach($imagelist as $key=>$vo): ?><div class="lie">
            <?php if(is_array($vo)): foreach($vo as $key=>$v): ?><div class="img_item">
                    <img src="<?php echo ($v["value"]); ?>">
                    <div class="tips">已选择</div>
                </div><?php endforeach; endif; ?>
        </div><?php endforeach; endif; ?>
    <div class="clear"></div>
    <div class="page" >
    <ul class="pagebar" >
        <?php if(is_array($pagebar)): foreach($pagebar as $key=>$vo): ?><li class="<?php echo ($vo["cur"]); ?>" onclick="getContent('<?php echo ($vo["url"]); ?>',$('.position').text(),'<?php echo ($vo["box_id"]); ?>')"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
        <div class="clear"></div>
    </ul>
    <div class="clear"></div>
</div>
    <div class="clear"></div>
</div>
                </div>
            </li>
            <li>
                <input type="submit" value="提交" class="normal_submit"  onclick="$(this).attr('disabled','disabled');
                getContent('<?php echo ($base_url); ?>/admin.php/Mainajax/<?php echo ($act); ?>/p/<?php echo ($p); ?>/id/<?php echo ($id); ?>','当前位置:网站首页设置>我的作品','',
                {'subject':$('#subject').val(),'description':$('#description').val(),'post_time':$('#post_time').val(),'picurl':$('#picurl').val()})"/>
                <input type="submit" value="返回" class="normal_submit"  onclick="getContent('<?php echo ($base_url); ?>/admin.php/Main/mywork/p/<?php echo ($p); ?>','当前位置:网站首页设置>我的作品')"/>

            </li>
        </div>
    <script src="<?php echo ($base_url); ?>/flash/admin/js/jquery.1.4.2.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                selectPicSingle('img_item',1,$("#picurl"),$("#showpic"));


            })

        </script>




</div>