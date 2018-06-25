<?php

namespace app\back\controller;

use think\Controller;

class Goods extends Base
{   

    function add_goods(){
    	return $this->fetch('Add_goods',['admin_name'=>$this->admin_name]);
    }
}
