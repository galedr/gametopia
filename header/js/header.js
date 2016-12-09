$(document).ready(function(){

//控制漢寶寶
			
		$('.header2-control').click(function(){
			$(this).toggleClass('open');
			$('.header2-meun-all-2').toggleClass('go');
		});


//摸到換圖案
		$('#sm-li a').hover(function(){
			$('#sm-icon').attr('src','header/images/supermarket-bag-2.png');
		},function(){
			$('#sm-icon').attr('src','header/images/supermarket-bag.png');
			
			}
		);

		$('#gb-li a').hover(function(){
			$('#gb-icon').attr('src','header/images/giftbox-2.png');
		},function(){
			$('#gb-icon').attr('src','header/images/giftbox.png');
			
			}
		);


		$('#sh-li a').hover(function(){
			$('#sh-icon').attr('src','header/images/bag-2.png');
		},function(){
			$('#sh-icon').attr('src','header/images/bag.png');
			
			}
		);

		$('#gm-li a').hover(function(){
			$('#gm-icon').attr('src','header/images/newspaper-report-2.png');
		},function(){
			$('#gm-icon').attr('src','header/images/newspaper-report.png');
			
			}
		);

		$('#fo-li a').hover(function(){
			$('#fo-icon').attr('src','header/images/chat-2.png');
		},function(){
			$('#fo-icon').attr('src','header/images/chat.png');
			
			}
		);

	
});