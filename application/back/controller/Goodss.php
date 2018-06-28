<?php

namespace app\back\controller;
use think\facade\Request;
use think\Controller;
use app\back\model\Category;
use app\back\model\Goods;
class Goodss extends Base
{     
	public $categor;
	public $newgoods;
	function __construct(\think\App $app=null){
		parent::__construct($app);
		$this->categor=new Category;
		$this->newgoods=new Goods;
	}
    function add_goods(){
    	$goodclass=$this->categor->sumclass();
    	// dump($goodclass);die;
    	return $this->fetch('Add_goods',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'goodclass'=>$goodclass]);
    }
    function goods_list(){

    	 $comorder= $this->newgoods->goodslist();
       
          $comorder=json_encode($comorder);
          // echo $comorder;die;
    	return $this->fetch('Goods_list',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'comorder'=>$comorder]);
    }
    function goods_add(){
    	$goods_name=Request::param('goods_name');
    	$goods_type=Request::param('goods_type');
    	// echo $goods_type;die;
    	$goods_price=Request::param('goods_price');
    	$goods_num=Request::param('goods_num');
    	$goods_property=Request::param('goods_property');
    	$goods_xq=Request::param('goods_xq');
    	$goods_img =request()->file('goods_img');
    	$info = $goods_img->move('front/upload');
    	if ($info) {
	    	$goods_img='/front/upload/'.$info->getSaveName();  
	      	$new_goods_img=str_replace("\\",'/',$goods_img);
    	}
    	$goods = new Goods;
		$goods->goods_name = $goods_name;
		$goods->class_id = $goods_type;
		$goods->goods_price = $goods_price;
		$goods->goods_num = $goods_num;
		$goods->goods_property = $goods_property;
		$goods->goods_xq = $goods_xq;
		$goods->goods_img=$new_goods_img;
		$goods->save();
		return $this->goods_list();
    }
}
