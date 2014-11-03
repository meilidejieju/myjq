<?php if (!defined('THINK_PATH')) exit();?>
<link href="<?php echo ($base_url); ?>/flash/home/plugins/pubuliu/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo ($base_url); ?>/flash/home/plugins/pubuliu/css/lightbox.css" type="text/css" media="screen" />
<script src="<?php echo ($base_url); ?>/flash/home/plugins/pubuliu/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".zoom,.ilike").hide();

        $(".zoom").each(function(){ //遍历所有对象
            var src=$(this).siblings("img").attr("src");
            $(this).attr({href:src});
        });

        $("#nav li").click(function(){
            $("#nav a").removeClass("hover");
            $(this).find("a").addClass("hover");
        });

        $("#waterfall li").live("mouseover",function(){
            $(this).addClass("hover");
            $(this).find(".zoom,.ilike").show();
        });

        $("#waterfall li").live("mouseout",function(){
            $(this).removeClass("hover");
            $(this).find(".zoom,.ilike").hide();
        });
    });



</script>


<div id="main" style="width: 750px">

    <div id="nav">
        <ul>

            <li ><a href="javascript:changelist(3);"class="hover">默认</a></li>
            <li><a href="javascript:changelist(2);">II</a></li>
            <li><a href="javascript:changelist(1);">I</a></li>
            <div class="clear" style="clear: both;"></div>
        </ul>
        <div class="clear" style="clear: both;"></div>
    </div>

    <ul id="waterfall" >
<?php if(is_array($myworks)): foreach($myworks as $key=>$vo): ?><li>
    <div class="img_block">
        <img src="<?php echo ($vo["picurl"]); ?>" />
        <a href="#" rel="lightbox[plants]" title="<?php echo ($vo["subject"]); ?>" class="zoom">放大</a>

    </div>
    <h3><?php echo ($vo["subject"]); ?></h3>

    <p><?php echo ($vo["description"]); ?></p>
</li><?php endforeach; endif; ?>

</ul>
<br />
<div style="visibility:hidden" id=loading class=loading><p><img src="images/loading.gif"><IMG src="images/load.gif"></p></div>
<input type="hidden" value="2" id="pageid"/>
<div id="getmore" style="width: 200px;margin: 10px auto;line-height: 30px; text-align: center;background: #eee;border: 1px solid #999;cursor: pointer">点击加载更多</div>
</div>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/pubuliu/js/lightbox.js"></script>
<script src="<?php echo ($base_url); ?>/flash/home/plugins/pubuliu/js/masonry-docs.min.js"></script>
<script>
    $(function(){
        $("#pageid").val(2);
        var $waterfall = $('#waterfall');

        $waterfall.masonry({
            columnWidth: 150
        });
        changelist(3);
//        $(document).scroll(function(){
//           if($(document).scrollTop()>=$(document).height()-$(window).height()){
        $("#getmore").click(function(){
               var elems = [];
               var fragment = document.createDocumentFragment();
               var p = parseInt($("#pageid").val());

                var url = '<?php echo ($base_url); ?>/index.php/Mainajax/pictureBox/p/'+p+'/starttime/<?php echo ($starttime); ?>/endtime/{endtime}';
               var data={};
               $.ajax({
                   url:url,
                   type: "POST",
                   data:data,
                   dataType:'json',
                   success:function(e){
                       $("#pageid").val(p+1);
                        if(!e.length){
                            alert('没有更多了！');
                        }else{
                            e.forEach(function(obj){


                                var elem = document.createElement('li');
                                //  var  elem=$(document).html('<li>123</li>');
                                var width = $waterfall.find("li").css("width");
                                elem.className = '';
                                $(elem).html('<div class="img_block"><img src="'+obj.picurl+'"><a class="zoom" title="'+obj.subject+'" rel="lightbox[plants]" href="'+obj.picurl+'" style="display: none;">放大</a></div><h3>'+obj.subject+'</h3><p>'+obj.description+'</p>');
                                // $(elem).attr("id","123123");
                                $(elem).css("width",width);
                                $(elem).find("img").css("width",(parseInt(width)-20)+'px');
                                fragment.appendChild( elem );
                                elems.push( elem );
                            });
                            console.log(elems);
                            // prepend elements to container
                            //     $waterfall.insertBefore( fragment, $waterfall.firstChild );
                            // add and lay out newly prepended elements
                            //      $waterfall.masonry('appended', elems );

                            $waterfall.append( fragment );
                            // add and lay out newly appended elements
                            $waterfall.masonry('appended', elems );
                        }


                   },
                   error:
                           function(){
                               alert("error");
                           }
               });



        })


    });

    function changelist(item){
        var $waterfall = $('#waterfall');
        var itemwidth = parseInt(750/item);
        var itemwidth_in = itemwidth-10;
        $waterfall.find("li").css("width",itemwidth_in+"px");
        $waterfall.find("li").find("img").css("width",(itemwidth_in-20)+"px");
        $waterfall.masonry({
            columnWidth: itemwidth
        });


    }

    function loadlist(starttime,endtime){

        var $waterfall = $('#waterfall');
        var elems = [];
        var fragment = document.createDocumentFragment();
        var p = parseInt($("#pageid").val());

        var url = '<?php echo ($base_url); ?>/index.php/Mainajax/pictureBox/p/1/starttime/'+starttime+'/endtime/'+endtime;
        var data={};

        $waterfall.html("");
        $.ajax({
            url:url,
            type: "POST",
            data:data,
            dataType:'json',
            success:function(e){

                if(!e.length){
                    alert('该月暂无作品！');
                }else{
                    e.forEach(function(obj){


                        var elem = document.createElement('li');
                        //  var  elem=$(document).html('<li>123</li>');
                        var width = $waterfall.find("li").css("width");
                        elem.className = '';
                        $(elem).html('<div class="img_block"><img src="'+obj.picurl+'"><a class="zoom" title="'+obj.subject+'" rel="lightbox[plants]" href="'+obj.picurl+'" style="display: none;">放大</a></div><h3>'+obj.subject+'</h3><p>'+obj.description+'</p>');
                        // $(elem).attr("id","123123");
                        $(elem).css("width",width);
                        $(elem).find("img").css("width",(parseInt(width)-20)+'px');
                        fragment.appendChild( elem );
                        elems.push( elem );
                    });
                 //   console.log(elems);
                    // prepend elements to container
                    //     $waterfall.insertBefore( fragment, $waterfall.firstChild );
                    // add and lay out newly prepended elements
                    //      $waterfall.masonry('appended', elems );

                    $waterfall.append( fragment );
                    // add and lay out newly appended elements
                    $waterfall.masonry('appended', elems );

                }


            },
            error:
                    function(){
                        alert("error");
                    }
        });

    }
</script>