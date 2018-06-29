<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\facade\Session;
class Account extends Base
{
 
    public function index()
    {

    }

    public function confirm_settle(){
        $user_id=Session::get('user_id');//在$_SESSION中调用这个方法读取用户的id 根据用户id查询购物车表中的数据遍历出来
//        echo $user_id;die;
        //查询购物车商品列表
        $goods_list = Db::table('car')
                ->join('goods','car.goods_id=goods.goods_id')
                ->where('user_id',$user_id)
                ->field('car.id,goods.goods_name,goods.goods_price,goods.goods_img,car.goods_num as s,goods.goods_id')
                ->select();
        $total_price=0;//订单总价初始值

        foreach($goods_list as &$v){
            $goods_img_arr = explode(",", $v['goods_img']);
           //把大数组中的img字段拆分为一维数组，把数组中key值为0的（也就是第一张图片）
           //在写入到大数组中的key为img中  现在就是大数组中的图片都是第一张图片
            $v['goods_img']= $goods_img_arr[0];
            $total_price += $v['s']*$v['goods_price'];
        }
   

        $address = Db::table('address')->where(['user_id'=>$user_id,'is_defauit'=>1])->find();


               
   
        return $this->fetch('buycar_two',['goods_list'=>$goods_list,'total_price'=>$total_price,'address'=>$address,'header'=> $this->header()]);
    }


}
