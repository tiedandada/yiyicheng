<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use think\Db;
use think\facade\Session;
class GoodsCar extends Base
{      

    
    //根据商品id 查询商品的名字价格 数量并且判断商品数量是不是大于数据库中的商品数量  
    //如果大于可添加到购物车（执行插入语句 插入到购物车表中 插入用户id 商品的id 商品的名字数量 价格  以及状态）
    // 如果小于则添加失败 提示用户商品不足
    public function rece_good(Request $request){
      
        $user_id=Session::get('user_id');//定义用户id为1  整合时改成 $_SESSIO读取 判断 如果$_SESSIO有读取用户id 如果没有跳转到登录界面进行登录
        $goods_id=Request::param('id');//商品id
        
            
            $num = Request::param('num');//商品数量
            $data=Db::table('goods')->where('goods_id',$goods_id)->find();
            $goods_num = Db::table('car')->where(['goods_id'=>$goods_id,'user_id'=>$user_id])->value('goods_num');

            //加入数量大于库存数量
            if($num>$data['goods_num']){
               return 0;
            } 
            //如果购物车内有该商品 不进行插入 只增加数量
            if($goods_num > 0){
                //更新

                $res = Db::name('car')
                    ->where('goods_id',$goods_id)
                    ->setInc('goods_num',$num);//setInc/setDec方法自增或自减一个字段的值（ 如不加第二个参数，默认步长为1）

            }else{
                //新增
                $cr = ['user_id' => $user_id,
                       'goods_id'=>$goods_id,
                       'goods_num'=>$num
                       ];
                $res=Db::name('car')->insert($cr);

            }

            if($res){
                return 1; 
            } else {
                return 2;  
            }

         
            
        }

       
    //查看购物车
    public function buycar(){
         
        $user_id=Session::get('user_id');//在$_SESSION中调用这个方法读取用户的id 根据id查询购物车表
        
        $data=Db::table('car')
                ->join('goods','car.goods_id=goods.goods_id')
                ->where('user_id',$user_id)
                ->field('car.id,goods.goods_name,goods.goods_price,goods.goods_img,car.goods_num,goods.goods_id')
                ->select();
//       if(empty($data)){
//           $this->error('购物车为空','/index/index/index');
//       }
        $zj=0;
        foreach($data as &$v){
            $goods_img_arr = explode(",", $v['goods_img']);
            $v['goods_img']= $goods_img_arr[0];
            $zj+= $v['goods_num']*$v['goods_price'];
        }   
        
        return $this->fetch('buycar',['key'=>$data,'zj'=>$zj,'header'=> $this->header()]);
                
 }
         
    public function delete_goods(Request $request){
        $user_id=Session::get('user_id');//用户id
        $goods_id=Request::param('id');//商品id
        $data =Db::table('car')->where(['user_id'=>$user_id,'goods_id'=>$goods_id])->delete();
        if($data){
            return 1;
        } else {
            return 2;
        }
        
        
        
    }
    
      
      
    
    
}
