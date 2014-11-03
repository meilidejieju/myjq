<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class UserModel{
    var $session=array("admin_username"=>"admin_username","admin_uid"=>"admin_uid");
    function User(){

    }
    function getSession(){
        $session_arr=array();

        foreach($this->session as $k=>$v){
            $session_arr[$v]=session($v);
        }

        return $session_arr;
    }




}