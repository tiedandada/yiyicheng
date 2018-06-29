<?php

namespace app\index\model;

use think\Model;
//use think\Db;

class Goods extends Model
{
    public function goods_id($id){
        
    return $this->where('goods_id',$id)->find();  
    
    }
}
