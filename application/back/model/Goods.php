<?php

namespace app\back\model;

use think\Model;

class Goods extends Model
{
    function goodslist(){
    	return $this->join('category','goods.class_id=category.class_id')->field('goods.goods_name,category.class_name,goods.goods_price')->select();
    }
}
