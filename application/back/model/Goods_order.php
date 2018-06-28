<?php

namespace app\back\model;

use think\Model;

class Goods_order extends Model
{
    function seleorder(){
     return $this->select()->count('order_sn');
    }
    function complateorder(){
    	return $this->leftjoin('user','goods_order.user_id=user.user_id')->field('goods_order.order_sn,goods_order.link_phone,goods_order.order_money,user.user_name,goods_order.link_man,goods_order.add_time')->where('goods_order.order_state','3')->select();

    	// $this->join('comment','user.user_id=comment.user_id')->select()->count('comment.comment_id');
    	// return $this->where('order_state','4')->select();
    }
    function unfilledorder(){
    	return $this->leftjoin('user','goods_order.user_id=user.user_id')->field('goods_order.order_sn,goods_order.link_phone,goods_order.order_money,user.user_name,goods_order.link_man,goods_order.add_time')->where('goods_order.order_state','0')->select();

    }
    function deliveredorder(){
    	return $this->leftjoin('user','goods_order.user_id=user.user_id')->field('goods_order.order_sn,goods_order.link_phone,goods_order.order_money,user.user_name,goods_order.link_man,goods_order.add_time')->where('goods_order.order_state','1')->select();

    }
    function oforder(){
        return $this->leftjoin('user','goods_order.user_id=user.user_id')->field('goods_order.order_sn,goods_order.link_phone,goods_order.order_money,user.user_name,goods_order.link_man,goods_order.add_time')->where('goods_order.order_state','2')->select();
    }
}
