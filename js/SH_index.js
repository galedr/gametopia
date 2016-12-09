window.addEventListener("load", init);

function init(){

if($(window).width() > 1200) {

	var notDefault = $("button").not("#default");
	notDefault.hover(
		function(){ /*mouseEnter*/
		$("button#default").removeClass("default");
	}, function(){ /*mouseLeave*/
		$("button#default").addClass("default");
	});

	$("button.megami").on('mouseenter',function(){
  
		$(".consoleImg").addClass('SH_indexImg');
		$(".iconAExp").addClass('SH_indexImg');
		$(".iconImages").attr("src","images/SH_indexgive.png");	
		$(".iconPro").html("只要向女神許願，即可隨機撈出一項寶物唷！");
		// $(".consoleImg").attr("src","images/SH_indexbg.png");

	});
	$("button.SH_search").on('mouseenter',function(){
		$(".consoleImg").addClass('SH_indexImg');
		$(".iconAExp").addClass('SH_indexImg');
		$(".iconImages").attr("src","images/SH_searchproduct.png");	
		$(".iconPro").html("在這裡可以直接搜尋到您心目中的商品！");
		// $(".consoleImg").attr("src","images/SH_indexbg.png");

	});
	$("button.sell").on('mouseenter',function(){
    
		$(".consoleImg").addClass('SH_indexImg');
		$(".iconAExp").addClass('SH_indexImg');
		$(".iconImages").attr("src","images/SH_sell.png");	
		$(".iconPro").html("您可以在這裡賣出您的寶物哦！");
		// $(".consoleImg").attr("src","images/SH_indexbg.png");

	});



	$("button.optionBar").on('mouseleave',function(){
		$(".consoleImg").removeClass('SH_indexImg');
		$(".iconAExp").removeClass('SH_indexImg');
		$(".iconImages").attr("src","images/SH_indexgive.png");	
		$(".iconPro").html("只要向女神許願，即可隨機撈出一項寶物唷！");
		$(".consoleImg").attr("src","images/SH_indexbg.png");


  	});
		
}		


	// $("button.optionBar").sparkle();
	// $(".container").sparkle();



	// if ("<?php echo $memAccount?>"== "") {
	// 	$('#toUsedPost').removeAttr('form');
	// 	$('#toUsedPost').click(function(){
	// 		alert("請先登入會員");
	// 	});
	// }else{
	// 	$('#toUsedPost').attr('form', "SH_search");
	// }

}


// 原本的CODE 

// $(".consoleImg").addClass('SH_indexImg');
// $(".consoleImg").addClass('iconAExp'); //這行寫錯人拉 
// $(".iconImages").attr("src","images/SH_sell.png");	
// $(".iconPro").html("您可以在這裡賣出您的寶物哦！");
// $(".consoleImg").attr("src","images/SH_indexbg.png");


//CSS 要做動畫的話控制ICONAEXP就好了 其他兩個不用單獨控制
// 然後你的物件一開始就設定動畫了  再加上動畫的CLASS ＝ 根本不會動...

// BY CHIAO 2016.11.30 03.02