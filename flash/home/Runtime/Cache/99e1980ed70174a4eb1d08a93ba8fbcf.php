<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/images.css" rel="stylesheet"/>
<div class="images" style="margin-top: 20px;">
    <?php if(is_array($imagelist)): foreach($imagelist as $key=>$vo): ?><div class="lie">
            <?php if(is_array($vo)): foreach($vo as $key=>$v): ?><div class="img_item">
                    <img src="<?php echo ($v["picurl"]); ?>">
                </div><?php endforeach; endif; ?>
        </div><?php endforeach; endif; ?>
    <div class="clear"></div>
    
    <div class="clear"></div>
</div>