<?php

namespace app\index\model;

use think\Model;

class goods extends Model
{
    public function timeshopping(){
         return Goods::where('goods_time','2018-06-14 04:08:04')->select();
    }
   
}
