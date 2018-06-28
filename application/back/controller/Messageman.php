<?php

namespace app\back\controller;
use app\back\model\Comment;
use think\Controller;
use think\facade\Request;
use think\Db;
class Messageman extends Base
{    
    public $comment;
    function __construct(\think\App $app=null){
        parent::__construct($app);
        $this->comment=new Comment;
    }
    function message_list(){
        $selectcommsum=$this->comment->selectcomment();
        // dump($selectcommsum);die;
        $selectcommsum=json_encode($selectcommsum);
        
        return $this->fetch('messagelist',['admin_name'=>$this->admin_name,'comorder'=>$selectcommsum,'ddurl'=>$this->ddurl]);
    }
    function del_goods(){
        $comment_id=Request::param('id');
        $data=Db::table('comment')->where('comment_id',$comment_id)->delete();
         if(empty($data)){
            return 0;
        }else{
           return $this->message_list();
        }
    }
}
