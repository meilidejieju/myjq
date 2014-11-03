<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class DatemenuModel{
    var $base_path;
    function Datemenu(){
    //   $this->base_path = $base_path = str_replace("\\","/",dirname(dirname(dirname(__FILE__)))).'/plugin/examples/uploads';
    }

    /*
     * 获得我的个人信息
     * */
    function getDatemenu($where){
        $Myinfo = M('blog_datemenu');
        $info = $Myinfo->where($where)->order('listorder asc')->limit()->select();
        return $info;
    }



}