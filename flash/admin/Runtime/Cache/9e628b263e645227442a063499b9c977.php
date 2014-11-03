<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($base_url); ?>/flash/home/css/style_popular.css" media="all" rel="stylesheet" >
<div>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>

        <div class="content">

            <ul id="myworks">
    <?php if(is_array($works_arr)): foreach($works_arr as $key=>$vo): ?><li>
        <?php echo ($vo["subject"]); ?>--<span style="font-size: 12px;"><?php echo ($vo["post_time"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="删除" class="del" onclick="getContent('<?php echo ($base_url); ?>/admin.php/Mainajax/delWorks/p/'+$('.pagebar .cur').text(),$('.position').text(),'#myworks',{ 'id':<?php echo ($vo["id"]); ?> })"/>
        <input type="submit" value="修改" class="edit" onclick="getContent('<?php echo ($base_url); ?>/admin.php/Mainajax/editWorks/p/'+$('.pagebar .cur').text(),$('.position').text(),'',{ 'id':<?php echo ($vo["id"]); ?> })"/>
    <li><?php endforeach; endif; ?>

    <li>
        <div class="page" >
    <ul class="pagebar" >
        <?php if(is_array($pagebar)): foreach($pagebar as $key=>$vo): ?><li class="<?php echo ($vo["cur"]); ?>" onclick="getContent('<?php echo ($vo["url"]); ?>',$('.position').text(),'<?php echo ($vo["box_id"]); ?>')"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
        <div class="clear"></div>
    </ul>
    <div class="clear"></div>
</div>
    </li>
</ul>

            <li>
                <input type="submit" value="去发布我的作品" class="normal_submit" onclick="getContent('<?php echo ($base_url); ?>/admin.php/Main/addmywork','当前位置:网站首页设置>我的作品')" />
            </li>
        </div>




</div>