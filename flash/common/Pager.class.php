<?php
require_once dirname(__FILE__)."/Page.class.php";

class Pager extends Page
{
    /**
     * 当前脚本Url
     *
     * @var string
     */
    var $script = '';

    /**
     * 构造函数
     *
     */
    function Pager($script, $total, $current, $pageSize, $lang = null)
    {
        $this->script = $script;
        $this->lang = $lang;
        $this->Page($total, $current, $pageSize);
    }

    /**
     * 取得当前脚本URL
     *
     * @return string
     */
    function getScript()
    {
        return $this->script;
    }

    /**
     * 输出分页字串
     *
     * @return string
     */
    function output()
    {
        $output  = ($this->getCurrent() == 1) ? "<li>" . $this->lang['first_page'] . "</li>" : "<li><a href=\"" . $this->getScript() . "1\">" . $this->lang['first_page'] . "</a></li>";
        $output .= ($this->getCurrent() == 1) ? "<li>" . $this->lang['pre_page'] . "</li>" : "<li><a href=\"" . $this->getScript() . $this->getPreviewLink() . "\">" . $this->lang['pre_page'] . "</a></li>";
        $output .= ($this->getCurrent() == $this->getTotalPages()) ? "<li>" . $this->lang['next_page'] . "</li>" : "<li><a href=\"" . $this->getScript() . $this->getNextLink() . "\">" . $this->lang['next_page'] . "</a></li>";
        $output .= ($this->getCurrent() == $this->getTotalPages()) ? "<li>" . $this->lang['last_page'] . "</li>" : "<li><a href=\"" . $this->getScript() . $this->getTotalPages() . "\">" . $this->lang['last_page'] . "</a></li>";

        $output .= "<li style=\"width: 120px;\">| {$this->lang['forward']} ";
        $output .= "<select onchange=\"javascript:window.location='" . $this->getScript() . "'+this.options[this.selectedIndex].value;\">";
        if ( $this->getTotalPages() <= 1 )
        {
            $output .= "<option value=\"\">" . $this->lang['begin'] . " 1 " . $this->lang['page'] . "</option>";
        }
        else
        {
            for ( $i = 1; $i <= $this->getTotalPages(); $i++ )
            {
                $selected = ($i == $this->getCurrent()) ? " selected" : "";
                $output .= "<option value=\"{$i}\"$selected>{$this->lang['begin']} {$i} 
                {$this->lang['page']}</option>";
            }
        }
        $output .= "</select></li>";

        return $output;
    }
	
	    /**
     * 输出分页字串
     *
     * @return string
     */
    function outputPagination2011()
    {
		
        if ( $this->totalPages <= 1 )
        {
            $output .="<strong>1</strong>";
        }
        else
        {
			//先输出上一页			
			if($this->getCurrent() == 1){
				$output .="<span>上一页</span>";
			}else{
				$output .="<a href=\"".$this->script . ($this->getCurrent()-1)."\">上一页</a>";
			}
			
            for ( $i = 1; $i <= $this->totalPages; $i++ )
            {	
				if($this->getCurrent() == $i){
				//$output .="<a href=\"".$this->script . $i."\" class=\"current\">{$i}</a>";
				$output .="<strong>{$i}</strong>";
				}else{
				$output .="<a href=\"".$this->script . $i."\">{$i}</a>";
				}
				
            }
			
			//输出下一页
			if($this->getCurrent() == $this->totalPages){
				$output .="<span>下一页</span>";
			}else{
				$output .="<a href=\"".$this->script . ($this->getCurrent()+1)."\">下一页</a>";
			}
			
			
        }
       
	   // $output .= "</select></li>";

        return $output;
    }
	//2013-04-25新增
	function newOutputPagination2011()
    {
		$output = "";
		$output.="<style>";
	   	//$output.="#newPage{margin-top:10px;}";
	   	$output.="#newPage li{text-align:center;font-size:12px;font-weight:600;font-family:微软雅黑;line-height:18px;list-style:none;margin-left:2px;margin-right:2px;height:18px;width:18px;border:1px solid #db224e;float:left;}";
	   	$output.="</style>";
		$output.="<ul id='newPage'>";
        if ( $this->totalPages <= 1 )
        {
            $output .="<li class='currentpage'>1</li>";
        }
        else
        {
			//先输出上一页			
			if($this->getCurrent() == 1){
				$output .="<li class='disablepage' style='width:30px;background:gray;border:1px solid gray;color:white;'><<</li>";
			}else{
				$output .="<li class='lastpage style='width:30px;'><a href=\"".$this->script . ($this->getCurrent()-1)."\"><<</a></li>";
			}
			
            for ( $i = 1; $i <= $this->totalPages; $i++ )
            {	
				if($this->getCurrent() == $i){
				//$output .="<a href=\"".$this->script . $i."\" class=\"current\">{$i}</a>";
				$output .="<li class='currentpage' style='background:#db224e;color:white;'>{$i}</li>&nbsp;";
				}else{
				$output .="<li><a href=\"".$this->script . $i."\">{$i}</a></li>&nbsp;";
				}
				
            }
			
			//输出下一页
			if($this->getCurrent() == $this->totalPages){
				$output .="<li class='disablepage' style='width:30px;background:gray;border:1px solid gray;color:white;'>>></li>";
			}else{
				$output .="<li class='nextpage' style='width:30px;'><a href=\"".$this->script . ($this->getCurrent()+1)."\">>></a></li>";
			}
			
			
        }
       $output .="</ul>";
	  
	   // $output .= "</select></li>";

        return $output;
    }
	
	function outputPaginationCourse2014()
    {
//        <div class="pagination">
//  <ul>
//    <li><a href="#"><</a></li>
//    <li><a href="#">1</a></li>
//    <li><a href="#">2</a></li>
//    <li><a href="#">3</a></li>
//    <li><a href="#">4</a></li>
//    <li><a href="#">></a></li>
//  </ul>
//</div>

        $output="<style>.pagination ul >.currentpage a,.pagination ul >.currentpage a:hover{background: #ddd}</style>";
		$output.=' <div class="pagination"><ul>';
        if ( $this->totalPages <= 1 )
        {
         //   echo $this->totalPages;
            $output .="<li><a href='javascript:;'>1</a></li>";
        }
        else
        {
			//先输出上一页			
			if($this->getCurrent() == 1){
				$output .="<li><a href='javascript:;'><</a></li>";
			}else{
				$output .="<li><a href=\"".$this->script . ($this->getCurrent()-1)."\"><</a></li>";
			}

		//	echo '1'.$this->totalPages;
            for ( $i = 1; $i <= $this->totalPages; $i++ )
            {	
				if($this->getCurrent() == $i){
				//$output .="<a href=\"".$this->script . $i."\" class=\"current\">{$i}</a>";
				    $output .="<li class='currentpage'><a href='javascript:;'>{$i}</a></li>";
				}else{
				    $output .="<li><a href=\"".$this->script . $i."\">{$i}</a></li>";
				}
				
            }
			
			//输出下一页
			if($this->getCurrent() == $this->totalPages){
				$output .="<li><a href='javascript:;'>></a></li>";
			}else{
				$output .="<li><a href=\"".$this->script . ($this->getCurrent()+1)."\">></a></li>";
			}
			
			
        }
       $output .="</ul></div>";
	   // $output .= "</select></li>";

        return $output;
    }

}