<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Account extends Controller
{
 
    public function index()
    {

    }
        //    Db::table('think_artist')
        //      ->alias('a')
        //      ->join('work w','a.id = w.artist_id')
        //      ->join('card c','a.card_id = c.id')
        //      ->select();
    
    
//            $data=Db::table('car')
//                ->join('goods','car.goods_id=goods.goods_id')
//                ->where('user_id',$user_id)
//                ->field('goods.goods_name,goods.goods_price,goods.goods_img,car.goods_num,goods.goods_id')
//                ->select();
    public function confirm_settle(){
        $user_id=1;//在$_SESSION中调用这个方法读取用户的id 根据用户id查询购物车表中的数据遍历出来
        $data=Db::table('car')
                ->join('goods','car.goods_id=goods.goods_id')
                ->where('user_id',$user_id)
                ->field('goods.goods_name,goods.goods_price,goods.goods_img,car.goods_num as s,goods.goods_id')
                ->select();
        $ddzj=0;
        foreach($data as &$v){

            $goods_img_arr = explode(",", $v['goods_img']);
           //把大数组中的img字段拆分为一维数组，把数组中key值为0的（也就是第一张图片）
           //在写入到大数组中的key为img中  现在就是大数组中的图片都是第一张图片
            $v['goods_img']= $goods_img_arr[0];
            $ddzj+=$v['s']*$v['goods_price'];
        }
        
        
        return $this->fetch('buycar_two',['key'=>$data,'ddzj'=>$ddzj]);
    }

}
