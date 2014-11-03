<?php
// 本类由系统自动生成，仅供测试用途
require_once ROOT_PATH.'/flash/common/commonfunctions.class.php';
class IndexAction extends Action {
    public function index(){

        echo '<script>window.location.href="http://115.29.249.116/index.php/Index/myinfo/cur/info"</script>';
    }
    function test(){
       echo  $_POST['simple-editor'];
    }
    /*
     * 获得照片墙
     * */
    function pictureBox(){

        $works = D('Works');
        $myworks = $works->getMyworks('','2 ');
      //  $zu_arr = $commonfunctions->intoRow($myworks,6);
        $this->assign('myworks',$myworks);
        $this->display("lib/pubuliu");
    }
    /*
     * 我的作品
     * */
    function mywork(){

        $works = D('Works');
        $this->getDatemenu($_GET['cur']);
        $starttime = strtotime($_GET['starttime']);
        $endtime = strtotime($_GET['endtime']);
        if($starttime){
            $where .= ' post_time >='.$starttime;
        }
        if($endtime){
            $where.= ' and post_time<='.$endtime;
        }
        $myworks = $works->getMyworks($where,'2 ');
        //  $zu_arr = $commonfunctions->intoRow($myworks,6);
        $this->assign('starttime',$_GET['starttime']);
        $this->assign('endtime',$_GET['endtime']);
        $this->assign('myworks',$myworks);
        $this->assign('act','mywork');
        $this->assign('cur'.$_GET['cur'],'cur');
        $this->assign('mywork_menu_class','selected');
        $this->assign('mywork_menu_down_class','block');
        $this->display("index");
    }

    /*
     * 个人信息
     * */
    function myinfo(){

        $myinfo = D('User');
        $this->getDatemenu();
        $info = $myinfo->getMyinfo('');
        $this->assign('myinfo',$info['content']);
        $this->assign('act','myinfo');
        $this->assign('cur'.$_GET['cur'],'cur');
        $this->display("index");
    }

    /*
     * 我的联系方式
     * */
    function mycontact(){

        $myinfo = D('User');
        $this->getDatemenu();
        $info = $myinfo->getMycontact('');
        $this->assign('mycontact',$info['content']);
        $this->assign('act','mycontact');
        $this->assign('cur'.$_GET['cur'],'cur');
        $this->display("index");
    }


    function getDatemenu($cur=''){
        $Datemenu = D('Datemenu');
        $info = $Datemenu->getDatemenu(' display = 1 ');
        $arr = array();
        foreach($info as $k=>$v){
            $v['starttime']=gmdate("Y-m-d",$v['starttime']);
            $v['endtime']=gmdate("Y-m-d",$v['endtime']);
            if($k+1==$cur){
                $v['cur']='cur';
            }

            $v['curvalue']=$k+1;
            $arr[]=$v;
        }
        $this->assign('datemenu',$arr);

    }

}