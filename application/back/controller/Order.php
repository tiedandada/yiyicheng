<?php

namespace app\back\controller;

use think\Controller;
use app\back\model\Goods_order;
class Order extends Base
{       public $goods_order;
    function __construct(\think\App $app=null){
        parent::__construct($app);
        $this->goods_order=new Goods_order;
    }
    function comporder(){
        
       $comorder= $this->goods_order->complateorder();
       
       $comorder=json_encode($comorder);
      
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
}
