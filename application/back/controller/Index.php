<?php
namespace app\back\controller;
use think\Controller;
use think\facade\Session;
use think\Request;
class Index extends Base
{
    public function index()
    {   
        
        return $this->fetch('index',['admin_name'=>$this->admin_name,'dzurl'=>$this->ddurl]);

    }
}
