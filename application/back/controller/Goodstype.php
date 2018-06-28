<?php

namespace app\back\controller;

use think\Controller;
use think\Request;
use think\Db;
class Goodstype extends Base
{
    function add_goods_type(){


    	return $this->fetch('Add_goods_type',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl]);

        
    	

    }
    function toadd_goods_type(Request $request){
        $shopname=$request->param('shopname');
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

         $arr = Db::table('goods')
            ->alias('c')
            ->join('category','c.class_id=category.class_id')
            ->select();

    	return $this->fetch('Del_goods_type',['admin_name'=>$this->admin_name,'arr'=>$arr,'ddurl'=>$this->ddurl]);
    }
    function updel_goods_type(){
        $arr['goods_id']=$_GET;
        $data=Db::table('goods')->where('goods_id', $arr['goods_id']['id'])->delete();
        if(empty($data)){
            return 1;die;
        }
       return $this->del_goods_type();
    }
}
