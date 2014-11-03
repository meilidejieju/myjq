<?php
/**
 * Created by YYY.
 * User: Administrator
 * Date: 14-7-20
 * Time: 下午8:01
 * 
 */
class commonfunctions{
    /*
     * 检查是否为空
     * */
     function checkEmpty($arr=array()){
         foreach($arr as $v){
             if(empty($v)){
                 return $v;
             }
         }
         return 'fill_success';
     }

    /*
     * 分页数组
     * */
    function page($total_items,$item,$url,$page_id=1,$box_id=''){
        for($i=1;$i<=floor(($total_items-1)/$item)+1;$i++){
            if($i==$page_id){
                $pagebar[$i]['cur']='cur';
            }else{
                $pagebar[$i]['cur']='';
            }
            $pagebar[$i]['name']=$i;
            $pagebar[$i]['box_id']=$box_id;
            //$pagebar[$i]['url']=BASE_URL.'/admin.php/Main/shouyebgimg/p/'.($i);
            $pagebar[$i]['url']=$url.$i;
        }
        return $pagebar;
    }
    /*
     * 将数组进行分组
     * */
    function intoRow($arr=array(),$lie=6){
        if($lie<0){
            return array();
        }
        foreach($arr as $k=>$v){
            $yu=$k%(intval($lie));
            $img_arr[$yu][]=$v;
        }
        return $img_arr;
    }


}
 
?>