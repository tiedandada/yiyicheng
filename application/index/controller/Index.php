<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    { 
      // $data =Db::table('goods')->select(); //查询全部商品
       $data =Db::table('goods')->where('class_id',1)->select();//根据商品的分类查询该分类下的所有商品
       
       //将数组遍历出来  取值 将值中的goods_id根据逗号进行拆分 然后让$v的goods_img字段等于拆分数组的第一个图片
       foreach($data as &$v){

         $goods_img_arr = explode(",", $v['goods_img']);
         $v['goods_img']= $goods_img_arr[0];
         
        
         
  }

       
       return $this->fetch('index',['aa'=>$data]);
       
      
    }
    
    


 
}
