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
    function updapwd($yuanpwd,$xianpwd,$quexianpwd){
        $dangadminname=Session::get('admin_name');
        $adm=Admin::where('name',$dangadminname)->find();
        // echo $xianpwd;die;
        // echo $quexianpwd;die;
        if (empty($adm)) {
            return false;
        }elseif ($adm['pwd']==$yuanpwd) {
            if ($xianpwd==$quexianpwd) {
            $acc=Admin::where('name', $dangadminname)->update(['pwd' => $quexianpwd]);
            if ($acc==1) {
               return true;
            }else{
                return false;
            }
            }else{
                return false;
            }
        }else{
            return false;
        }

        
    }
}
