<?php

namespace app\index\controller;
use think\Controller;
use think\facade\Request;
use think\Db;
use think\facade\Session;
class Personalcenter extends Base
{    
    //查看订单
    public function my_order(){
       $user_id=Session::get('user_id');
       $goods_order=Db::table('goods_order')->where('user_id',$user_id)->select();
      
        return $this->fetch('member_order',['goods_order'=>$goods_order,'header'=> $this->header()]);
        
    }    
    
//根据订单id查询订单详情表
//       $gooda_order_det=Db::table('goods_order_details')->where('order_id',$order_id)->select();
//       //根据查询出的商品id查询商品表
//
//       foreach($gooda_order_det as $v){
//          $aa=Db::table('goods')->where('goods_id',$v['goods_id'])->select(); 
//          dump($aa);
//       } 
    //查看订单详情
    public function order_details (Request $request){
        
       $order_id=Request::param('order_id');
       //根据订单id查询订单表
       $goods_order=Db::table('goods_order')->where('order_id',$order_id)->find();
       //根据订单id 查询 订单详情表和商品表 关联字段  goods_id
       $goods_details=Db::table('goods_order_details')
               ->alias('d')
               ->join('goods','d.goods_id=goods.goods_id')
               ->where('order_id',$order_id)
               ->select();

     //将数组遍历出来  取值 将值中的goods_img根据逗号进行拆分 然后让$v的goods_img字段等于拆分数组的第一个图片
        foreach($goods_details as &$v){

         $goods_img_arr = explode(",", $v['goods_img']);
         $v['goods_img']= $goods_img_arr[0];

        }
         return $this->fetch('order_details',['goods_order'=>$goods_order,'goods_details'=>$goods_details,'header'=> $this->header()]);
         
    }


    //删除订单
    public function delete_goods_order(Request $request){
        $user_id=Session::get('user_id');//用户id
        $order_id=Request::param('order_id');//订单id
        $data = Db::table('goods_order')->where('order_id',$order_id)->delete();
        
        if($data){
            return  1;
        } else {
            return  2;
        }
    
}

   //确认收货ajax
   public function affirm(Request $request){
       
    $order_id=Request::param('order_id');//订单id
     
    $data=Db::name('goods_order')
            ->where('order_id',$order_id)
            ->data(['order_state' => '3'])
            ->update();
        if($data){
            return  1;
        } else {
            return  2;
        }

   }
   
   //取消订单 ajax
   public function cancel(Request $request){
       $order_id=Request::param('order_id');

        $data=Db::table('goods_order')
              ->where('order_id',$order_id)  
              ->data(['order_state' => '2'])
              ->update();

              if($data){
                 return  1;
             } else {
                 return  2;
             }
       
   }
   
       //收货地址
    public function shipping_add(){
        $user_id=Session::get('user_id');
       $data=Db::table('address')->where('user_id',$user_id)->select();
   
         return $this->fetch('member_address',['shipping_add'=>$data]);
         
    }

    //设置地址默认值
    public function defauit_settings(Request $request){
        
        $address_id=Request::param('address_id');
        //先更改数据库中默认状态为默认的 改为不默认
        $datas= Db::table('address')
            ->where('is_defauit',1)    
            ->data(['is_defauit'=>'2'])
            ->update();
        //在根据地址id更改 默认值
        $data=Db::table('address')
              ->where('address_id',$address_id)  
              ->data(['is_defauit' => '1'])
              ->update();
        
            if($data){
                 return  1;
             } else {
                 return  2;
             }
       
    }
    
    
    //删除用户地址
    public function delete_add(Request $request){
        
        $address_id=Request::param('address_id');
        
        $data = Db::table('address')->where('address_id',$address_id)->delete();
        
        if($data){
            return  1;
        } else {
            return  2;
        }
        
    }
    
      

    //添加地址  接受表单传过来的值 插入到数据库
    public function add_address(){
        
        $user_id=Session::get('user_id');
        $province =Request::param('province');
        $city=Request::param('city');
        $contry=Request::param('contry');
        $link_man=Request::param('link_man');
        $link_phone=Request::param('link_phone');
        $sit=Request::param('sit');
        $email=Request::param('email');
       
       
       $data=[
           'user_id'=>$user_id,
           'province'=>$province,
           'city'=>$city,
           'contry'=>$contry,
           'address_name'=>$sit,
           'link_man'=>$link_man,
           'link_phone'=>$link_phone,
           'is_defauit'=>2,
           'email'=>$email,
       ];
       $aa=Db::table('address')->insert($data);
       if($aa){
           $this->success('新增成功','/index/Personalcenter/shipping_add');
       } else {
          $this->error('新增失败'); 
       }
       
       return $this->fetch('add_address'); 
    }
    
    //进入到添加界面  设置一个一个地址的方法
    public function tj(){
        
       return $this->fetch('add_address'); 
       
    }
    
    
     //修改地址
    public function xg_address(){
        
       return $this->fetch('xg_address'); 
    }
     
    
    
     //账户安全 
     //
     //更改用户名和 密码
    public function safety(){
       $user_id=Session::get('user_id');
       $aa=Db::table('user')->where('user_id',$user_id)->find();
       return $this->fetch('member_safe',['aa'=>$aa]); 
    }
    
    //换手机号
    
    public function change_phone(){
       $user_id=Session::get('user_id');
       $phone=Request::param('phone');
       if(empty($phone)){
           $this->error('新增失败');
         }
       
       
       $data=Db::table('user')
            ->where('user_id',$user_id)  
            ->data(['user_phone' => $phone])
            ->update();
       if($data){
           $this->success('修改成功', '/index/Personalcenter/safety');
       }
    
    }
    
    //换邮箱
    
    public function change_mailbox(){
       $user_id=Session::get('user_id');
       $email=Request::param('email');
       if(empty($email)){
           $this->error('修改失败');
         }
         
       $data=Db::table('user')
            ->where('user_id',$user_id)  
            ->data(['user_email' => $email])
            ->update();
       if($data){
           $this->success('修改成功', '/index/Personalcenter/safety');
       }
        
    }
 
    //更换密码 ajax
    
    public function change_paw(){
        
        
    }
    
}   
    
       