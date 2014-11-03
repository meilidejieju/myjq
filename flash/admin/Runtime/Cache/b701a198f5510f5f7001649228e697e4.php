<?php if (!defined('THINK_PATH')) exit();?><ul id="myworks">
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