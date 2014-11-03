<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class LoginModel{
    var $session=array("admin_username"=>"admin_username","admin_uid"=>"admin_uid");
    //登陆
    // 0验证码错误 1成功 2密码错误 3用户名不正确
    function login($username,$password,$auth){
        if(!$this->verifyYanzhengma($auth)){
            //验证码错误
            return 0;
        }
        $user = M('blog_users');
        $row=$user->where('username ="'.$username.'"')->field('password,username,uid')->find();
        if($row['username']&&$row['password']==md5($password)){
            //成功
            session($this->session['admin_username'],$row['username']);
            session($this->session['admin_uid'],$row['uid']);
            return 1;
        }else{
            if(!$row['username']){
                //用户名不正确
                return 3;
            }else{
                //密码错误
                return 2;
            }
        }

    }

    /*
     * 检测验证码
     * */
     function verifyYanzhengma($auth){
      //   ECHO session('yanzhengma');
         if($auth==session('yanzhengma')||strtolower($auth)==session('yanzhengma')){
             return 1;
         }else{
             return 0;
         }
     }




}