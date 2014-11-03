<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class WorksModel{
    var $base_path;
    function Works(){
    //   $this->base_path = $base_path = str_replace("\\","/",dirname(dirname(dirname(__FILE__)))).'/plugin/examples/uploads';
    }

    /*
     * 获得我的作品数组
     * */
    function getMyworks($where,$limit){
        $Myworks = M('blog_myworks');
        $works = $Myworks->where($where)->order('post_time desc')->limit($limit)->select();
        $works_arr=array();
        foreach($works as $k=>$v){

            $v['post_time']=gmdate('Y-m-d H:i:s',$v['post_time']+8*3600);
            $works_arr[$k]=$v;
        }
        return $works_arr;
    }


}