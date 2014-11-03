<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($base_url); ?>/flash/home/css/style_popular.css" media="all" rel="stylesheet" >
<div>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>
    <div class="content">
        <li>
            <!--(trumbowyg插件-->
<link rel="stylesheet" href="<?php echo ($base_url); ?>/flash/home/plugins/trumbowyg/design/css/trumbowyg.css">
<script src="<?php echo ($base_url); ?>/flash/home/plugins/jquery.min.js"></script>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/trumbowyg/trumbowyg.js"></script>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/trumbowyg/langs/fr.js"></script>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/trumbowyg/plugins/base64/trumbowyg.base64.js"></script>
<script>
    /** Default editor configuration **/
    $('#simple-editor').trumbowyg({
        lang: 'fr'
    });
</script>
<!--trumbowyg插件)-->


<div id="simple-editor">
<?php echo ($content); ?>
</div>
        </li>
        <li>
        <input type="submit" value="修改" class="normal_submit"  onclick="
                getContent('<?php echo ($base_url); ?>/admin.php/Mainajax/editmycontact','当前位置:网站首页设置>我的联系方式','#edit_time',
                {'content':$('#simple-editor').html()})"/><span style="font-size: 12px;margin-left: 20px;" id="edit_time"><?php echo ($last_time); ?></span>
        </li>
    </div>




</div>