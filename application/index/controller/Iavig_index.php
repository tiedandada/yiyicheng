<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
class Iavig_index extends Base
{
   
     public function iavig_index(){
         return $this->fetch('/index/index/index',['header'=> $this->header()]);   //往header传值
    }

  
}
