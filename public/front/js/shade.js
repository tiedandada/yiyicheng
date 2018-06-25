// JavaScript Document

function ShowDiv(show_div,bg_div){
	document.getElementById(show_div).style.display='block';
	document.getElementById(bg_div).style.display='block' ;
	var bgdiv = document.getElementById(bg_div);
	bgdiv.style.width = document.body.scrollWidth;
	// bgdiv.style.height = $(document).height();
	$("#"+bg_div).height($(document).height());
};

function CloseDiv(show_div,bg_div)
{
	document.getElementById(show_div).style.display='none';
	document.getElementById(bg_div).style.display='none';
};



//function ShowDiv_1(show_div,bg_div,id){
// 
//	document.getElementById(show_div).style.display='block';
//	document.getElementById(bg_div).style.display='block' ;
//	var bgdiv = document.getElementById(bg_div);
//	bgdiv.style.width = document.body.scrollWidth;
//	// bgdiv.style.height = $(document).height();
//	$("#"+bg_div).height($(document).height());
//        
////        $.get("/index/goods_car/rece_good",{id:id},function(data){
////                 if(data==1){
////                        msg = "加入成功";
////                    }else{
////                        msg ="名没有,请注册";
////                    }
////
//// 
////     });
//
//};
//�رյ�����
function CloseDiv_1(show_div,bg_div)
{
	document.getElementById(show_div).style.display='none';
	document.getElementById(bg_div).style.display='none';
};