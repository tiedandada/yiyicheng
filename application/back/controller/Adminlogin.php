<?php

namespace app\back\controller;

use think\Controller;
use think\facade\Request;
use app\back\model\Admin;
class Adminlogin extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function upd_admin_pwd()
    {   
        $cadmin;
        $this->cadmin=new Admin;
        $yuanpwd=Request::param('yuanpwd');
        $xianpwd=Request::param('xianpwd');
        $quexianpwd=Request::param('quexianpwd');
        return $this->cadmin->updapwd($yuanpwd,$xianpwd,$quexianpwd);
       
    }


}
