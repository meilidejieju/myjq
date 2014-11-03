<?php
// 本类由系统自动生成，仅供测试用途
if(!$_SESSION['admin_username']){
    echo '<script>window.location.href="'.BASE_URL.'/admin.php"</script>';
    exit;
}

class MainAction extends Action {

    /*
     * 视图输出类
     * */
    /*
     * 输出主界面
     * */
    public function Main(){
        $User=D('User');
        $session_arr=$User->getSession();
       // print_r($session_arr);
        if($session_arr[$User->session['admin_username']]){
            $this->assign('admin_username',$session_arr[$User->session['admin_username']]);
        }
        $Menu=D('Menu');
        $left_menu=$Menu->getLeftMenu(0);
        $left_menu_html=$Menu->getLeftMenuHtml($left_menu);
        $this->assign("left_menu",$left_menu_html);
        $this->display();
    }

    /*
     * 获得当前位置
     * */
    public function getPositon(){
        $this->assign("position",$_POST['position']);
    }
    /*
     * 网站设置
     * */
    public function webSet(){
        $this->getPositon();
        $this->display();
    }
    /*
     * 菜单设置
     * */
    public function setLeftMenu(){
        $this->getPositon();
        $Menu=D('Menu');
        $left_menu=$Menu->getLeftMenu(0);
        $leftmenu_set_html=$Menu->getLeftMenuSetHtml($left_menu);
        $this->assign("leftmenu_set_html",$leftmenu_set_html);
        $this->display();
    }

    /*
     * 首页背景图片设置
     * */
    public function shouyebgimg(){
        $this->getPositon();
        $BG=M('blog_index_config');
        $item=2;
        $page_id = $_GET['p']?$_GET['p']:1;
      //  $total_items=count($index_img);
        $total_items=$BG->where("type='index_bgimg' and uid =1 and display = 1")->count();
        $start_item=($page_id-1)*$item;
        $index_img = $BG->where("type='index_bgimg' and uid =1 and display = 1")->field('value')->limit($start_item,$item)->select();
        $img_arr=array();
        foreach($index_img as $k=>$img){
            $yu=$k%6;
            $img['value']=strstr($img['value'],'http')? $img['value']:BASE_URL.$img['value'];
            $img_arr[$yu][]=$img;
        }



        for($i=1;$i<=floor(($total_items-1)/$item)+1;$i++){
            if($i==$page_id){
                $pagebar[$i]['cur']='cur';
            }else{
                $pagebar[$i]['cur']='';
            }
            $pagebar[$i]['name']=$i;
            $pagebar[$i]['url']=BASE_URL.'/admin.php/Main/shouyebgimg/p/'.($i);
        }

        $this->assign("pagebar",$pagebar);
        $this->assign("imagelist",$img_arr);


        $this->display();
    }
    /*
 * 首页背景音乐设置
 * */
    public function shouyebgmusic(){
        $this->getPositon();

        $this->display();
    }




    public function piccenter(){
        $this->getPositon();
        $this->display();
        
    }



    public function uploadpic(){
        $this->getPositon();
        $Picturedata = M('blog_picture_center');
        $Picture = D('Picture');
        $depart = session('admin_uid');
        $p=$_GET['p']?$_GET['p']:1;
        $item = 3;

        //获得图片空间总条数
        $total_items=$Picturedata->where("belong_uid='".$depart."'")->count();
        //获得相应的条数
        $img_arr = $Picture-> getMyPics($depart,$p,$item);
        //获得分页
        require_once ROOT_PATH.'/flash/common/commonfunctions.class.php';
        $commonfunctions = new commonfunctions();
        $pagebar = $commonfunctions->page($total_items,$item,BASE_URL.'/admin.php/Mainajax/picturecenter/p/',$p,'#picturecenterbox');

        $this->assign("pagebar",$pagebar);
        $this->assign("imagelist",$img_arr);


        $this->display();
    }



    public function mywork(){
        $this->getPositon();

        $Works = D('Works');
        $Myworksdata = M('blog_myworks');
        $p=$_GET['p']?$_GET['p']:1;
        $item = 5;
        $total_items=$Myworksdata->where("uid='".session('admin_uid')."'")->count();
        //获得相应的条数
        $works_arr = $Works-> getMyworks('uid='.session('admin_uid'),($p-1)*$item.','.$item);

        //获得分页
        require_once ROOT_PATH.'/flash/common/commonfunctions.class.php';
        $commonfunctions = new commonfunctions();
        $pagebar = $commonfunctions->page($total_items,$item,BASE_URL.'/admin.php/Mainajax/mywork/p/',$p,'#myworks');

        $this->assign("pagebar",$pagebar);
        $this->assign("works_arr",$works_arr);


        $this->display();
    }
    public function addmywork(){
        $this->getPositon();

        $Picturedata = M('blog_picture_center');
        $Picture = D('Picture');
        $depart = session('admin_uid');
        $p=$_GET['p']?$_GET['p']:1;
        $item = 3;

        //获得图片空间总条数
        $total_items=$Picturedata->where("belong_uid='".$depart."'")->count();
        //获得相应的条数
        $img_arr = $Picture-> getMyPics($depart,$p,$item);
        //获得分页
        require_once ROOT_PATH.'/flash/common/commonfunctions.class.php';
        $commonfunctions = new commonfunctions();
        $pagebar = $commonfunctions->page($total_items,$item,BASE_URL.'/admin.php/Mainajax/picturecenter/p/',$p,'#picturecenterbox');

        $this->assign("pagebar",$pagebar);
        $this->assign("imagelist",$img_arr);

        $this->assign("act",'addMywork');
        $this->assign("time",gmdate("Y-m-d H:i:s",time()+8*3600));
        $this->assign("minpic_display",'none');
        $this->display();
    }
                    

    public function myinfo(){
        $this->getPositon();

        $Myinfo = M('blog_myinfo');
        $info = $Myinfo->where('uid='.session('admin_uid'))->find();
        $this->assign('last_time','上次修改时间'.gmdate('Y-m-d H:i:s',$info['time']+8*3600));
        $this->assign('content',$info['content']);
        $this->display();
    }

                    

    public function myshop(){
        $this->getPositon();
        $this->display();
    }
    /*
     * 我的联系方式
     * */
    public function mycontact(){
        $this->getPositon();

        $Myinfo = M('blog_mycontact');
        $info = $Myinfo->where('uid='.session('admin_uid'))->find();
        $this->assign('last_time','上次修改时间'.gmdate('Y-m-d H:i:s',$info['time']+8*3600));
        $this->assign('content',$info['content']);
        $this->display();
    }
}