<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class FileModel{
    /*
     * 追加内容
     * */
    function intoFile($file,$content,$type=FILE_APPEND){
        if($this->checkFileExists($file)){

            file_put_contents($file, $content, $type);
        }else{

        }
    }
    /*
     * 创建文件
     * */
    function createFile($file){
       // $filename="./123.txt";
        $filename=$file;
        $fp=fopen("$filename", "w+"); //打开文件指针，创建文件
        if ( !is_writable($filename) ){
            die("文件:" .$filename. "不可写，请检查！");
        }
        fclose($fp);  //关闭指针
    }
    /*
     * 检测文件是否存在
     * */
     function checkFileExists($filename){
         //$filename='./test.txt';
         if (file_exists($filename)) {
            return 1;
         } else {
             return 0;
         }

     }

}