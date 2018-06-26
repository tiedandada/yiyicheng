<?php

namespace app\back\controller;

use think\Controller;

class Goodstype extends Base
{
    function add_goods_type(){

    	return $this->fetch('Add_goods_type',['admin_name'=>$this->admin_name]);
    }
    function del_goods_type(){
    	return $this->fetch('Del_goods_type',['admin_name'=>$this->admin_name]);
    }
}
