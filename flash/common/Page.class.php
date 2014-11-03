<?php


/**
 * 分页类
 *
 */
class Page
{
    /**
     * 当前页
     *
     * @var int
     */
    var $current;
    
    /**
     * 总记录数
     *
     * @var int 
     */
    var $totalItems;
    
    /**
     * 总页数
     *
     * @var int
     */
    var $totalPages;
    
    /**
     * 第页记录数
     *
     * @var int
     */
    var $pageSize;

    /**
     * 构造函数
     *
     * @param int $total
     * @param int $current
     * @param int $pageSize
     * @return void
     */
    function Page( $total, $current, $pageSize )
    {
        $this->totalItems = $total;
        $this->current    = $current;
        $this->pageSize   = $pageSize;

        $this->totalPages = ceil( $this->totalItems / $this->pageSize );
        //echo  $this->totalPages;
        $this->current >= $this->totalPages && $this->current = $this->totalPages;

        $this->current <= 1 && $this->current = 1;
       // echo     $this->current;
        $this->totalPages <= 1 && $this->totalPages = 1;
    }

    /**
     * 取得上一页
     *
     * @return int
     */
    function getPreviewLink()
    {
        return ( $this->current > 1 ) ? ( $this->current - 1 ) : 1;
    }

    /**
     * 取得下一页
     *
     * @return int
     */
    function getNextLink()
    {
        return ( $this->current < $this->totalPages ) ? ( $this->current + 1 ) : $this->totalPages;
    }

    /**
     * 取得当前页编号
     *
     * @return int
     */
    function getCurrent()
    {
        return $this->current;
    }

    /**
     * 取得总页数
     *
     * @return int
     */
    function getTotalPages()
    {
        return $this->totalPages;
    }
}