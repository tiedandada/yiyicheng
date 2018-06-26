<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Orderlay extends Controller
{
   
    public function confirm_order(){
        //
    
        $address_id = $this->request->param('address_id');
        $user_id=1;
        //计算商品总价
        $goods_list = Db::table('car')
            ->join('goods','car.goods_id=goods.goods_id')
            ->field('car.goods_num as s,goods.goods_price,car.goods_id')
            ->where('user_id',$user_id)
            ->select();
        $total_price = 0 ;
            foreach ($goods_list as $v){   
                $total_price += $v['s']*$v['goods_price']; 
            }
        //查询地址表
        $address = Db::table('address')->where('address_id',$address_id)->find();
        //生成唯一订单号的函数
        $order_sn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
       
        
             //执行插入同时并删除的事务 
           Db::startTrans();
               try {
                                        //插入到订单表
                 $order_info = [
                    'order_sn'=>$order_sn,
                    'user_id'=>$user_id,
                    'link_phone'=>$address['link_phone'],
                    'link_man'=>$address['link_man'],
                    'order_state'=>0,//未付款
                    'order_money'=>$total_price,
                    'add_time' => date('Y-m-d H:i:s')
                ];
                 //插入并返回主键id
                $order_id = Db::table('goods_order')->insertGetid($order_info);

                //获取购物车中的商品并且插入到详情表
                if($order_id){
                    foreach($goods_list as $key => $vv){
                        $order_details[$key] = [
                            'order_id' => $order_id,
                            'goods_id' => $vv['goods_id'],
                            'goods_price' => $vv['goods_price'],
                            'buy_num' => $vv['s'],
                        ];
                    }
                }

                $order_details_res = Db::table('goods_order_details')->insertAll($order_details);
                    //如果$order_details_res有返回值 进行插入时间戳
                    if($order_details_res){
                       $goods_order_log=[
                            'order_id'=>$order_id,
                            'order_state'=>0
                       ];

                    $goods_order_log_res=Db::table('goods_order_log')->insert($goods_order_log);
                    }
                   Db::name('car')->where('user_id',$user_id)->delete();
                   
                   Db::commit();
                   //提交事务   
                    $template='buycar_three';
                 } catch (\Exception $e) {
                    // echo $e->getMessage();//获取异常报错信息
                    //程序异常回滚事务 提交事务失败
                   Db::rollback();
                 $template='buycar_four';
                }
                //根据订单id 查询订单表中的订单编号
           $order_snn=Db::table('goods_order')->where('order_id',$order_id)->find();
   
           return $this->fetch($template,['total_price'=>$total_price,'order_snn'=>$order_snn]);
        
    }
}
