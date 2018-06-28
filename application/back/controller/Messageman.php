<?php

namespace app\back\controller;
use app\back\model\Comment;
use think\Controller;

class Messageman extends Base
{    
    public $comment;
    function __construct(\think\App $app=null){
        parent::__construct($app);
        $this->comment=new Comment;
    }
    function message_list(){
        $selectcommsum=json_encode($this->comment->selectcomment());
        // echo $selectcommsum;die;
        return $this->fetch('messagelist',['admin_name'=>$this->admin_name,'comorder'=>$selectcommsum,'ddurl'=>$this->ddurl]);
    }
}
