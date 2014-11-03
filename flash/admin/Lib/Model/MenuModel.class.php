<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class MenuModel{
    var $action_content='';
    var $html_content='';

    function Menu(){

    }
    function getLeftMenu($parent_id=0,$level=0){
        $Menu=M("blog_leftmenu");
        $left_menu=array();
        $temp=$Menu->where('parent_id='.$parent_id.' and display=1')->order('list_order')->select();
        $level=$level+1;
        foreach($temp as $v){
            if(!empty($v)){
                $v['level']=$level;
                $left_menu[$v['menu_id']]['child']=$this->getLeftMenu($v['menu_id'],$level);
                $left_menu[$v['menu_id']]['info']=$v;
            }else{
                return array();
            }
        }
        return $left_menu;

    }

    function getLeftMenuHtml($left_menu){
        $html='';
        foreach($left_menu as $menu_id => $menu){
            $html.='<li><a level="'.$menu['info']['level'].'" href="#" au="'.BASE_URL.$menu['info']['link'].'">'.$menu['info']['menu_name'].'</a>';
            if($menu['child']){
                $html.='<ul class="ul">';
               $html.=$this->getLeftMenuHtml($menu['child']);
                $html.='</ul>';
            }else{

            }
            $html.='</li>';

        }

       // echo $html;
        return $html;
    }

    function getLeftMenuSetHtml($left_menu){
        $html='';
        foreach($left_menu as $menu_id => $menu){
            if($menu['info']['level']==1)$class='ul_area';
            $html.='<li class="'.$class.'"><a mid="'.$menu['info']['menu_id'].'" level="'.$menu['info']['level'].'" href="#" au="'.BASE_URL.$menu['info']['link'].'">'.$menu['info']['menu_name'].'</a>
            <div class="tools">
            <img class="plus" src="'.BASE_URL.'/flash/admin/images/plus_white.png"/>
            <img class="minus" src="'.BASE_URL.'/flash/admin/images/minus_white.png"/>
             <img class="up" src="'.BASE_URL.'/flash/admin/images/up_white.png"/>
              <img class="down" src="'.BASE_URL.'/flash/admin/images/down_white.png"/>
               </div>
            <div class="clear">
            </div>';
            if($menu['child']){
                $html.='<ul class="ul">';
                $html.=$this->getLeftMenuSetHtml($menu['child']);
                $html.='</ul>';
            }else{

            }
            $html.='</li>';

        }

        // echo $html;
        return $html;
    }

    /*
     * 设置菜单
     * */
    function setMenu($type,$mid,$cat_name='',$link=''){
        $Menu=M("blog_leftmenu");
        switch($type){
            case 'plus':
                $insert_id=$Menu->data(array('menu_name'=>$cat_name,'parent_id'=>$mid,'link'=>$link))->add();
                $Menu->where('menu_id='.$insert_id)->save(array("list_order"=>$insert_id));
                //初始化文件类
                $file=D("File");

                if($link&&DEVELOPER){
                    $link_explode=explode("/",$link);
                    $action_name=$link_explode[(count($link_explode)-1)];

                    //写入方法
                    $action_file=APP_PATH."Lib/Action/MainAction.class.php";
                    $old_file=file_get_contents($action_file);
                    $last_str=substr($old_file,strlen($old_file)-1,1);
                    if($last_str=='}'){
                        $old_file=substr($old_file,0,-1);
                    }
                    $this->action_content='

    public function '.$action_name.'(){
        $this->getPositon();
        $this->display();
    }

                    ';
                    $new_content=$old_file.$this->action_content.$last_str;

                    if($file->checkFileExists($action_file)){
                        $file->intoFile($action_file,$new_content,0);
                    }

                    //新建html模板
                    $html_file=APP_PATH."Tpl/main/".$action_name.".html";
                    if($file->checkFileExists($html_file)){

                    }else{
                        $file->createFile($html_file);
                        $file->intoFile($html_file,$this->html_content,0);
                    }

                }
                break;
            case 'minus':
                $Menu->where('menu_id='.$mid)->save(array("display"=>0));
                break;
            case 'up':
                $this_row=$Menu->where('menu_id='.$mid)->find();
                $row_up=$Menu->where('display =1 and parent_id='.intval($this_row['parent_id']).' and list_order <'.intval($this_row['list_order']))->field('list_order,menu_id')->order('list_order desc')->find();

                if($row_up){

                    $Menu->where('menu_id='.$mid)->save(array("list_order"=>$row_up['list_order']));
                    $Menu->where('menu_id='.$row_up['menu_id'])->save(array("list_order"=>$this_row['list_order']));
                }else{

                }
                break;
            case 'down':
                $this_row=$Menu->where('menu_id='.$mid)->find();
                $row_down=$Menu->where('display =1 and parent_id='.intval($this_row['parent_id']).' and list_order >'.intval($this_row['list_order']))->field('list_order,menu_id')->order('list_order asc')->find();
                if($row_down){
                    $Menu->where('menu_id='.$mid)->save(array("list_order"=>$row_down['list_order']));
                    $Menu->where('menu_id='.$row_down['menu_id'])->save(array("list_order"=>$this_row['list_order']));
                }else{

                }
                break;
            case 'update':
                $Menu->where('menu_id='.$mid)->save(array("menu_name"=>$cat_name,"link"=>$link));
                break;
            default:
                break;
        }
    }


}