<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class UserModel{
    var $base_path;
    function User(){
    //   $this->base_path = $base_path = str_replace("\\","/",dirname(dirname(dirname(__FILE__)))).'/plugin/examples/uploads';
    }

    /*
     * 获得我的个人信息
     * */
    function getMyinfo($where){
        $Myinfo = M('blog_myinfo');
        $info = $Myinfo->where($where)->order('time desc')->limit(1)->find();
        return $info;
    }
    /*
        * 获得我的联系方式
        * */
    function getMycontact($where){
        $Myinfo = M('blog_mycontact');
        $info = $Myinfo->where($where)->order('time desc')->limit(1)->find();
        return $info;
    }



}