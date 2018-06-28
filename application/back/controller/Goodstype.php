<?php

namespace app\back\controller;

use think\Controller;
use think\facade\Request;
use think\Db;
class Goodstype extends Base
{
    function add_goods_type(){


    	return $this->fetch('Add_goods_type',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl]);

        
    	

    }
    function toadd_goods_type(Request $request){
        $shopname=Request::param('shopname');
//        print_r($shopname);
        $selshop=Db::table('category')->where('class_name',$shopname)->find();
        if(empty($selshop)){
            $arr['class_name']=$shopname;          
//            print_r($arr);
            Db::name('category')->insert($arr);
            return 1;  
            
            die;                                           //查出来为空   没有这个商品名称
        }else{
            return 0; die;                                              //有这个商品名称
        }
    }
    function del_goods_type(){

         $arr = Db::table('category')
            ->select();
            // dump($arr);die;
    	return $this->fetch('Del_goods_type',['admin_name'=>$this->admin_name,'arr'=>$arr,'ddurl'=>$this->ddurl]);
    }
    function updel_goods_type(){
        $class_id=Request::param('id');
       
        $data=Db::table('category')->where('class_id',$class_id)->delete();
        if(empty($data)){
            return 0;
        }else{
        	return 1;
        }
       
    }
}
