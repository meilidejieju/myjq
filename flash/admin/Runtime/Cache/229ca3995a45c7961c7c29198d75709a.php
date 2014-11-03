<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/webset.css" rel="stylesheet"/>
<div>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>
    <div class="content">


        <link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/images.css" rel="stylesheet"/>
        <div class="images" style="margin-top: 20px;">
            <?php if(is_array($imagelist)): foreach($imagelist as $key=>$vo): ?><div class="lie">
                    <?php if(is_array($vo)): foreach($vo as $key=>$v): ?><div class="img_item">
                            <img src="<?php echo ($v["value"]); ?>">
                        </div><?php endforeach; endif; ?>
                </div><?php endforeach; endif; ?>
            <div class="clear"></div>
            <div class="page" >
                <ul class="pagebar" >
                    <?php if(is_array($pagebar)): foreach($pagebar as $key=>$vo): ?><li class="<?php echo ($vo["cur"]); ?>" onclick="getContent('<?php echo ($vo["url"]); ?>','当前位置:网站首页设置>背景图片设置')"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>


    </div>
    <li>
        首页背景图片地址:<input style="width: 500px;" type="text" name="base_url"/>
    </li>



</div>