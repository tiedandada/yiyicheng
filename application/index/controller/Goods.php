<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Request;

class Goods extends Controller
{
    public function index()
    {
      // return $this->fetch();
    }
    public function goodss(){
      
        
    }

    public function goods_details(Request $request){
       $id = (int)Request::param('id');
       $data=Db::name('goods')->where('goods_id',$id)->find();
       $goods_img_arr = explode(",", $data['goods_img']);//将字符串拆分为数组 将数组赋值给大数组中的名字段
       $data['goods_img']= $goods_img_arr;//变成数组
     
       
       //商品评论
       //根据商品id 两表联查  用户的头像 名称 评论内容   商品评论表 用户表 
       
        $comment=Db::table('comment')
                ->join('goods','goods.goods_id=comment.goods_id')
                ->join('user','comment.user_id=user.user_id')
                ->where('goods.goods_id',$id)
                ->field('user_img,user_name,comment_con,comment_time')
                ->select();
        
        return $this->fetch('product',['xq'=>$data,'pl'=>$comment]);


    }


    
    

}
