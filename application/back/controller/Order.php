<?php

namespace app\back\controller;

use think\Controller;
use app\back\model\Goods_order;
use think\facade\Request;
use think\Db;
class Order extends Base
{       public $goods_order;
    function __construct(\think\App $app=null){
        parent::__construct($app);
        $this->goods_order=new Goods_order;
    }
    function comporder(){
        
       $comorder= $this->goods_order->complateorder();
       // dump($comorder);die;
       $comorder=json_encode($comorder);
        // echo $comorder;die;
       return $this->fetch('Goods_list',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'comorder'=>$comorder]);
       
    }
    function unfilledorders(){
    	$comorder= $this->goods_order->unfilledorder();
       
       
    	return $this->fetch('unfilledorder',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'comorder'=>$comorder]);
    }
    function deliveredorders(){
    	$comorder= $this->goods_order->deliveredorder();
         
    	return $this->fetch('deliveredorder',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'comorder'=>$comorder]);
    }
    function del_order(){
        $order_cn=Request::param('id');
        $data=Db::table('goods_order')->where('order_sn',$order_cn)->delete();
         if(empty($data)){
            return 0;
        }else{
           return $this->comporder();
        }
    }
     function upd_order_status(){
        $order_cn=Request::param('id');
        $data=Db::table('goods_order')->where('order_sn', $order_cn)->update(['order_state' =>1]);
         if(empty($data)){
            return 0;
        }else{
           return $this->unfilledorders();
        }
    }
    function offorder(){

       $comorder= $this->goods_order->oforder();
         
        return $this->fetch('offorder',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'comorder'=>$comorder]);
    }
    function del_offoder(){
       $order_cn=Request::param('id');
         $data=Db::table('goods_order')->where('order_sn',$order_cn)->delete();
         if(empty($data)){
            return 0;
        }else{
           return $this->offorder();
        } 
    }
}
