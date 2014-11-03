<?php
// 本类由系统自动生成，仅供测试用途
class MainajaxAction extends Action {

  /*
   * ajax请求处理类
   * */
    public function Mainajax(){

    }
    /*
     * 菜单设置ajax请求
     * */
    public function setLeftmenu(){
        $Menu=D('Menu');
        $Menu->action_content=$this->base_config['action_content'];
        $Menu->html_content=$this->base_config['html_content'];
        $Menu->setMenu($_POST['type'],$_POST['mid'],$_POST['cat_name'],$_POST['link'],time());
    }
    /*
     * 图片空间box
     * */
    public function picturecenter(){

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
        $this->assign("position",$_POST['position']);

        $this->display('lib/picturecenterbox');

    }
    /*
    * 添加我的作品
    * */
    public function addMywork(){
        $subject = $_POST['subject'];
        $post_time = strtotime($_POST['post_time'])?strtotime($_POST['post_time']):time();
        $description = $_POST['description'];
        $picurl = $_POST['picurl'];
        $Mywork = M('blog_myworks');
        //新增
        $insert_id=$Mywork->data(array(
            'subject'=>$subject,
            'post_time'=>$post_time,
            'description'=>$description,
            'picurl'=>$picurl,
            'author'=>session('admin_username'),
            'uid'=>session('admin_uid')
        ))->add();

        //读取我的作品列表
        if($insert_id){
            $this->assign("position",$_POST['position']);
            $Works = D('Works');
            $Myworksdata = M('blog_myworks');
            $p=intval($_GET['p'])?intval($_GET['p']):1;
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
            $this->display('Main/mywork');
        }

    }

    /*
     * 我的作品
     * */
    public function mywork(){


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
        $this->display('lib/myworks');
    }
    /*
     * 删除作品
     * */
    function  delWorks(){
        $id=$_POST['id'];
        $Myworksdata = M('blog_myworks');
        $Myworksdata->where('id = '.$id)->delete();
        $this->mywork();


    }

    /*
     * 编辑作品
     * */
    function editWorks(){

        $this->assign("position",$_POST['position']);
        $Workdata = M('blog_myworks');
        $workinfo = $Workdata->where('id='.$_POST['id'])->find();

        $this->assign("time",gmdate('Y-m-d H:i:s',$workinfo['post_time']+3600*8));
        $this->assign("workinfo",$workinfo);
        $this->assign("act",'editmyworkdata');
        $this->assign("id",$_POST['id']);


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


        $this->assign("p",$p);
        $this->display('Main/addmywork');
    }
    /*
     * 修改作品信息
     * */
    function editmyworkdata(){
        $subject = $_POST['subject'];
        $post_time = strtotime($_POST['post_time'])?strtotime($_POST['post_time']):time();
        $description = $_POST['description'];
        $picurl = $_POST['picurl'];
        $Mywork = M('blog_myworks');
        $id=$_GET['id'];
        //新增
        $Mywork->where('id='.$id)->data(array(
            'subject'=>$subject,
            'post_time'=>$post_time,
            'description'=>$description,
            'picurl'=>$picurl,
            'author'=>session('admin_username'),
            'uid'=>session('admin_uid')
        ))->save();

        //读取我的作品列表

            $this->assign("position",$_POST['position']);
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
            $this->display('Main/mywork');

    }
    /*
     * 修改个人简介
     * */
    function editmyinfo(){
        $Myinfo = M('blog_myinfo');

        $data = array(
            'content'=>$_POST['content'],
            'time'=>time(),
            'author'=>session('admin_username'),
            'uid'=>session('admin_uid')

        );
        //修改信息
        if($Myinfo->where('uid='.session('admin_uid'))->find()){
            $Myinfo->where('uid='.session('admin_uid'))->data($data)->save();
        }else{
            $Myinfo->data($data)->add();
        }
        echo '修改成功：'.gmdate('Y-m-d H:i:s',time()+8*3600);

    }
    /*
        * 修改个人联系方式
        * */
    function editmycontact(){
        $Myinfo = M('blog_mycontact');

        $data = array(
            'content'=>$_POST['content'],
            'time'=>time(),
            'author'=>session('admin_username'),
            'uid'=>session('admin_uid')

        );
        //修改信息
        if($Myinfo->where('uid='.session('admin_uid'))->find()){
            $Myinfo->where('uid='.session('admin_uid'))->data($data)->save();
        }else{
            $Myinfo->data($data)->add();
        }
        echo '修改成功：'.gmdate('Y-m-d H:i:s',time()+8*3600);

    }
}