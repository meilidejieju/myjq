<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    /*
     * 默认登陆页
     * */
    public function index(){
      //  echo session('yanzhengma').'1';
       // $user = M();
    //    echo 1;

        $this->display();

    }

    public function yanzhengma(){
        $yanzhengma = D("YanZhengMa");



        $yanzhengma->doimg();
        $code_str = $yanzhengma->getCode();
     //   echo $code_str;
       session('yanzhengma',$code_str);

       // echo $code_str.'2';
        //   var_dump($img);
        //   $img = $yanzhengma->img;

    }
    public function login(){
        $Login = D("Login");
        // 0验证码错误 1成功 2密码错误 3用户名不正确
       $is_login = $Login->login( $_POST['username'], $_POST['password'], $_POST['yanzhengma']);
        switch($is_login){
            case 0:
                $this->error($this->langZh['yanzhengma_erro'],BASE_URL.'/admin.php',2);
                break;
            case 1:
                $this->error($this->langZh['login_success'],BASE_URL.'/admin.php/Main/main',2);
                break;
            case 2:
                $this->error($this->langZh['password_erro'],BASE_URL.'/admin.php',2);
                break;
            case 3:
                $this->error($this->langZh['username_erro'],BASE_URL.'/admin.php',2);
                break;
        }
    }


}