<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/images.css" rel="stylesheet"/>
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