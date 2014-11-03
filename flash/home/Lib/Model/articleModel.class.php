<?php
/**
 * 学习之用欢迎交流 QQ178340042.
 * User: yyy
 * Date: 14-5-12
 * Time: 下午10:01
 */
class articleModel{
    function articleModel(){

    }

    /*
     * 添加笔记
     * */

    function addArticle($data){
        $article = M('blog_article');
        $insert_id=$article->data($data)->add();
        return $insert_id;
    }
    /*
      * 获得笔记list
      * */

    function getArticle($where=''){
        $article = M('blog_article');
        $list=$article->where($where)->select();
        return $list;
    }

    function getArticleDetail($aid){
        $article = M('blog_article');
        $info=$article->where('id ='.$aid)->find();
        echo json_encode($info);
    }


}