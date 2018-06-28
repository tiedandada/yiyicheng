<?php

namespace app\back\model;

use think\Model;

class Comment extends Model
{
    function selecomment(){
    	return $this->select()->count();
    }
    function selectcomment(){
    	return $this->leftjoin('user','comment.user_id=user.user_id')->leftjoin('goods','comment.goods_id=goods.goods_id')->field('goods.goods_name,user.user_name,comment.comment_con,comment.comment_time')->select();
    }
}
// 'goods_order.order_sn,goods_order.link_phone,goods_order.order_money,user.user_name,goods_order.link_man,goods_order.add_time')->where('goods_order.order_state','1')