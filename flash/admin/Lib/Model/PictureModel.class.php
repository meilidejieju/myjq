<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class PictureModel{
    var $base_path;
    function Picture(){
       $this->base_path = $base_path = str_replace("\\","/",dirname(dirname(dirname(__FILE__)))).'/plugin/examples/uploads';
    }
    /*
     * 获得个人的图片空间
     * */
    function getMyPics($depart,$page_id=1,$item=2){
        $depart=$depart?$depart:session('admin_uid');
        $BG=M('blog_picture_center');

//        $total_items=$BG->where("belong_uid='".$depart."'")->count();
        $start_item=($page_id-1)*$item;
        $index_img = $BG->where("belong_uid='".$depart."'")->limit($start_item,$item)->select();
        $img_arr=array();
        foreach($index_img as $k=>$img){
            $yu=$k%6;
            $img['value']=strstr($img['picurl'],'http')? $img['picurl']:BASE_URL.'/flash/admin/plugin/examples/'.$img['picurl'];
            $img_arr[$yu][]=$img;
        }
        return $img_arr;
    }


}