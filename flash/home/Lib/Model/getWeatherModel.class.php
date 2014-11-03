<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class getWeatherModel{
    function getWeatherModel(){

    }
    /*
     * 中国气象网
     * */
    public function  baiduApi($city_code='杭州'){
        //默认杭州
        $url='http://api.map.baidu.com/telematics/v3/weather?location='.$city_code.'&output=json&ak=AC6f2f88bce541a8c98ac6abe531bb89';
        $json_data=file_get_contents($url);
        $obj_data=json_decode($json_data);
        return $obj_data;
    }


}