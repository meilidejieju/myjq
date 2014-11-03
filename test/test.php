<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-6-11
 * Time: 下午10:07
 */

//$path = dirname(dirname(__FILE__));
//$files = scandir(str_replace("\\",'/',$path).'/flash/admin/plugin/examples/uploads');
//var_dump(is_dir(str_replace("\\",'/',$path).'/flash/admin/plugin/examples/uploads/'.$files[2]));
////print_r(scandir(str_replace("\\",'/',$path).'/flash/admin/plugin/examples/uploads'));
////print_r(dir('../admin/plugin/examples/uploads'));
$con = mysql_connect("localhost","root","123123");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('test',$con);
mysql_set_charset('utf8');


//$sql = sprintf("insert into blog_picture_center (picurl,post_time,author,belong_uid) values ('%s',%d,'%s',%d)",$filePath_utf8,time(),$username,$uid);
$temp=0;
echo 'hello';
for($i=400000;$i<409999;$i++){
    $data = file_get_contents("http://www.91wutong.com/index.php/anyinvest/zichan/1231/$i");
    file_put_contents('./jinfu.txt',$i);
    preg_match("/\n.*\%/","$data", $matches);
    $matches[0] = str_replace("\n\r","",$matches[0]);
    $matches[0] = trim($matches[0]);
    preg_match("/[0-9]+\.+[0-9]+/",$matches[0], $matches2);
    if($matches2[0]>$temp){
        $temp = $matches2[0];
        $ii=$i;
    }
    $sql = sprintf("insert into test3 (id) values ('%s')",$ii);
    mysql_query($sql);

}
echo $ii;
