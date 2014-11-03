<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" href="<?php echo ($base_url); ?>/flash/admin/css/setleftmenu.css" rel="stylesheet"/>
<div>
    <script>
        $(document).ready(function(){
            $(".setleftmenu").find("a").mouseover(function(){
                $("img").css("display","none");
                $(this).next(".tools").find("img").css("display","inline")
            });
            /*
            * 菜单项ajax
            * */
            $(".tools img,.addmenu").click(function(){
                var line=0;
                var type=$(this).attr("class");
                var link='';
                var cat_name='';
                var parent_id = $(this).parent("div").prev("a").attr("mid");

                if(!parent_id){
                    type='plus';
                    parent_id=0;
                }
                if(type=='plus'){
                    setPoping('',link,type,parent_id);
                }else if(type=='minus'){
                    if(confirm("确定删除此菜单吗?")){
                        setMenu(type,link,parent_id,cat_name);
                    }else{
                        return;
                    }

                }else if(type=='up'||type=='down'){
                    setMenu(type,link,parent_id,cat_name);
                }
            });
            $(".setleftmenu a").click(function(){
                var menu_name=$(this).text();
                var link = $(this).attr("au");
                link=link.replace("<?php echo ($base_url); ?>","");
                var type='update';
                var cat_name=menu_name;
                var parent_id=$(this).attr('mid');

                setPoping(menu_name,link,type,parent_id);
            })

        });


            function setPoping(menu_name,link,type,parent_id){
                var cat_name=menu_name;

                var poping_content='' +
                        '<p><span>输入菜单名</span>' +
                        ' <input id="menu_name" value="'+menu_name+'"/></p>' +
                        '<p><span>输入连接地址</span>' +
                        '<input id="link" value="'+link+'"/></p>' +
                        '<p><input type="button" class="submit" value="<?php echo ($langZh["submit"]); ?>"/></p>';
                $('#poping .poping_content').html(poping_content);
                $('#poping').reveal("fade");

                $(".submit").click(function(){
                    cat_name=$("#menu_name").val();
                    link=$("#link").val();
                    if(!cat_name){
                        alert("<?php echo ($langZh["finish_info"]); ?>");
                        return;
                    }else{
                        setMenu(type,link,parent_id,cat_name);
                    }
                });
        }


        function setMenu(type,link,parent_id,cat_name){
            $.ajax({
                url:"<?php echo ($base_url); ?>/admin.php/Mainajax/setleftmenu",
                type: "POST",
                data:{"type":type,"link":link,"mid":parent_id,"cat_name":cat_name},
                dataType:'text',
                success:function(e){
                 //   alert(2);

                    var url =$(".dropdown").find(".cur").attr("au");
                    var position=$("#position").text();
                    getContent(url,position);
                    $("#poping").css("visibility","hidden");
                    $('.reveal-modal-bg').fadeOut();
                },
                error:
                        function(){
                            alert("error");
                        }
            });
        }


    </script>
    <div class="position"><?php echo ($langZh["position"]); ?>:<span id="position"><?php echo ($position); ?></span></div>
    <div class="content">

            <ul class="setleftmenu">
                <?php echo ($leftmenu_set_html); ?>
                <li class="ul_area addmenu" style="color: #fff;font-size: 20px;font-weight: bold;text-align: center;cursor: pointer">
                    +
                </li>
            </ul>



    </div>




</div>