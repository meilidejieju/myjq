<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/js/piccenter.js"></script>
<script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/js/works.js"></script>
<div>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>
    <div class="content">
        <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<title>Plupload - Custom example</title>

<!-- production -->
<script type="text/javascript" src="<?php echo ($base_url); ?>/flash/admin/plugin/js/plupload.full.min.js"></script>


</head>
<body style="font: 13px Verdana; background: #eee; color: #333">

<h1>图片空间</h1>

<p>目前支持的格式为jpg,gif,png 大小限制8M以内</p>

<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
    <a id="pickfiles" href="javascript:;"><div class="sel_pic_btn">选择文件</div></a>
    <a id="uploadfiles" href="javascript:;"><div class="up_pic_btn">开始上传</div></a>
</div>

<br />
<pre id="console"></pre>




<script type="text/javascript">
// Custom example logic

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : '<?php echo ($base_url); ?>/flash/admin/plugin/examples/upload.php',
	flash_swf_url : '<?php echo ($base_url); ?>/flash/admin/plugin/js/Moxie.swf',
	silverlight_xap_url : '<?php echo ($base_url); ?>/flash/admin/plugin/js/Moxie.xap',
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"}
		//	,{title : "Zip files", extensions : "zip,rar"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();

</script>
</body>
</html>

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
        <div>
            当前图片地址为：<span id="current_url"></span>
        </div>
    </div>
    <script src="<?php echo ($base_url); ?>/flash/admin/js/jquery.1.4.2.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            showPicUrl2('img_item',$('#current_url'));

        });



    </script>
</div>