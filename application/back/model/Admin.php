<?php

namespace app\back\model;
use think\facade\Session;
use think\Model;

class Admin extends Model
{
    function duanadmin($adname,$adpwd){
    	$adm=Admin::where('name',$adname)->find();

    	if (empty($adm)) {
    		return false;
    	}elseif($adm['pwd']==$adpwd){
    		 Session::set('admin_name',$adname);
    		 return true;
    	}else{
    		return false;
    	}
    }
}
