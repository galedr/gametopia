
function init(){

	$('#R2').click(function(){
		// $(this).css('background','#ccc');
		$('.right').css('right','0').css('index',500);
	});

	$('#back_btn').click(function(){
		$('.right').css('right','-100%');
	}); 


	changeBar();
	getStart();
}
function setMailClick(){

	$('#mailBox_2 .mail').click(function(){
		$('.right').css('right','0').css('index',500);
	});

}

function changeBar(){
	// 初始化bar高度
	if ( $("#mailList_2").css("height") == $("#mailBox_2").css("height") ) {
		$('#Scrollbar-Handle_2').css('height', "100%");
	}else{
		$('#Scrollbar-Handle_2').css('height', "calc(100% / 9)");
	}
	if ( $("#rightMailList").css("height").split('p')[0]-60+'px' == $("#mailBox_3").css("height") ) {
		$('#Scrollbar-Handle_3').css('height', "calc(100% - 60px)");
	}else{
		$('#Scrollbar-Handle_3').css('height', "calc(100% / 9)");
	}

// ================scroll_2================

	// 調整透明度
	$('#dv_scroll_track_2').mouseover(function(){
		$('#Scrollbar-Handle_2').css('opacity', '0.5');
	}).mouseout(function(){
		$('#Scrollbar-Handle_2').css('opacity', '0');
	});

	// $('#Scrollbar-Handle_2').mousedown().mouseup();
	$('#Scrollbar-Handle_2').mousedown(function(){
		var barHeight_2= $('#Scrollbar-Handle_2').css('height').split('p')[0];
		var totalBarHeight_2= $('#dv_scroll_track_2').css('height').split('p')[0];
		// $('#Scrollbar-Handle_2').mousemove();
		$('#Scrollbar-Handle_2').mousemove(function(e){
			console.log(e);
			var mb= $('#mailBox_2').css('height').split('p')[0];
			var ml= $('#mailList_2').css('height').split('p')[0];
			if(e.pageY-60 > barHeight_2/2 && (e.pageY-60)+(barHeight_2/2) < totalBarHeight_2){
			// 上下拉動

				$('#Scrollbar-Handle_2').css('top', ( (e.pageY-60)-(barHeight_2/2) )+'px');

				// 信件總欄的移動量
				var a= -( (e.pageY-60) - (barHeight_2/2) )*( (mb-ml) / (totalBarHeight_2-barHeight_2) );
				$('#mailBox_2').css('top', a+'px');

			}
			if( (e.pageY-60)+(barHeight_2/2) >= totalBarHeight_2){
			// 拉到底

				$('#Scrollbar-Handle_2').css('top', totalBarHeight_2-barHeight_2+'px');

			}
			
		});
	}).mouseup(function(){
		// remove mousemove eventListener
		$('#Scrollbar-Handle_2').off('mousemove');
		if(e.pageY-60 > barHeight_2/2 && (e.pageY-60)+(barHeight_2/2) < totalBarHeight_2){
			$('#Scrollbar-Handle_2').css('top', ( (e.pageY-60)-(barHeight_2/2) )+'px');
		}
		if( (e.pageY-60)+(barHeight_2/2) >= totalBarHeight_2){
			$('#Scrollbar-Handle_2').css('top', totalBarHeight_2-barHeight_2+'px');
		}
	});

// ================scroll_3================

	$('#dv_scroll_track_3').mouseover(function(){
		$('#Scrollbar-Handle_3').css('opacity', '0.5');
	}).mouseout(function(){
		$('#Scrollbar-Handle_3').css('opacity', '0');
	});

	// $('#Scrollbar-Handle_3').mousedown().mouseup();
	$('#Scrollbar-Handle_3').mousedown(function(){
		var barHeight_3= $('#Scrollbar-Handle_3').css('height').split('p')[0];
		var totalBarHeight_3= $('#dv_scroll_track_3').css('height').split('p')[0];
		// $('#Scrollbar-Handle_3').mousemove();
		$('#Scrollbar-Handle_3').mousemove(function(e){
			console.log(e);
			var mb= $('.mailBox2').css('height').split('p')[0];
			var ml= $('.mailInfoList').css('height').split('p')[0];
			if(e.pageY-60 > barHeight_3/2 && (e.pageY-60)+(barHeight_3/2) < totalBarHeight_3-60){
			// 上下拉動

				$('#Scrollbar-Handle_3').css('bottom', totalBarHeight_3-( (e.pageY-60)+(barHeight_3/2) )+'px');

				// 信件內容的移動量
				var a= -( totalBarHeight_3-( (e.pageY-60)+(barHeight_3/2) )-60 )*( (mb-ml+60) / (totalBarHeight_3-barHeight_3-60) );
				$('.mailBox2').css('bottom', a+60+'px');

			}
			if( (e.pageY-60)+(barHeight_3/2) <= barHeight_3){
			// 拉到最上方

				$('#Scrollbar-Handle_2').css('bottom', totalBarHeight_3-barHeight_3+'px');

			}
			
		});
	}).mouseup(function(){
		// remove mousemove eventListener
		$('#Scrollbar-Handle_3').off('mousemove');
		if(e.pageY-60 > barHeight_3/2 && (e.pageY-60)+(barHeight_3/2) < totalBarHeight_3-60){
			$('#Scrollbar-Handle_3').css('bottom', totalBarHeight_3-( (e.pageY-60)+(barHeight_3/2) )+'px');
		}
		if( (e.pageY-60)+(barHeight_3/2) <= barHeight_3){
			$('#Scrollbar-Handle_3').css('bottom', totalBarHeight_3-barHeight_3+'px');
		}
	});


// ================mousewheel================
	document.getElementById('mailList_2').onwheel= twoWheel;
	document.getElementById('rightMailList').onwheel= threeWheel;


// ================輸入內文================
	$('.contenteditable').keyup(function(){
		var typedText= this.innerText;
		var ph= '#ph_'+ this.id.split('_')[1];
		if (typedText!= "") {
			$(ph).text("");
		}else{
			$(ph).text("請輸入內文");
		}

		var cont= '#mailContent_'+ this.id.split('_')[1];
		$(cont).val(typedText);
		console.log($(cont).val());
	});

// ================送出信件================
	$("#sendNewMail_1").click(function(){
		$("#form_1").submit();
	});
	$("#sendNewMail_2").click(function(){
		$("#form_2").submit();
	});

// ================控制手機板scrollBar位置================
	var TH= $('.totalConnectMessagesBetweenEachOther').height();
	var VH= $('#TCMBEO').height();
	$('#TCMBEO').scrollTop( (TH-VH) * (VH/ TH) * 2.5 );
	// 不懂為何*2, 所以不要問我

// ================控制手機板頁面切換================
	$('.oneML').click(function(){
		$('.twoColBox > div:nth-of-type(1)').css('animation', "leftHide 1s 0s linear forwards");
		$('.chat').css('animation', "rightPop 1s 0s linear forwards");
	});
	$('.twoColBox > div:nth-of-type(1) > span').click(function(){
		$('.twoColBox > div:nth-of-type(1)').css('animation', "leftHide 1s 0s linear forwards");
		$('.sendNewMailBlock').css('animation', "rightPop 1s 0s linear forwards");
	});
	$('#returnFromChatToAllMailList').click(function(){
		$('.twoColBox > div:nth-of-type(1)').css('animation', "leftPop 1s 0s linear forwards");
		$('.chat').css('animation', "rightHide 1s 0s linear forwards");
	});
	$('#returnFromSendNewMailBlockToAllMailList').click(function(){
		$('.twoColBox > div:nth-of-type(1)').css('animation', "leftPop 1s 0s linear forwards");
		$('.sendNewMailBlock').css('animation', "rightHide 1s 0s linear forwards");
	});


//======================================================================
}

function oneWheel(e){
	$('#Scrollbar-Handle_1').css('opacity', '0.5');

	var barHeight= $('#Scrollbar-Handle_1').css('height').split('p')[0];
	var totalBarHeight= $('#dv_scroll_track_1').css('height').split('p')[0];
	var mb= $('#mailBox_1').css('height').split('p')[0];
	var ml= $('#mailList_1').css('height').split('p')[0];
	var a;

	var direction= e.deltaY;// e.deltaY 往下滾為正
	var barPosition= $('#Scrollbar-Handle_1').css('top').split('p')[0];
	if ( direction>0 && !(barPosition>= totalBarHeight-barHeight) ){
	// 方向往下

		if ( barPosition-(-14) > totalBarHeight-barHeight ) {

			a= -( totalBarHeight-barHeight )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= totalBarHeight-barHeight+'px';

		}else {

			a= -( barPosition-(-14) )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-(-14)+'px';

		}
	}else if ( direction<0 && !(barPosition<= 0) ) {
	// 方向往上
		if ( barPosition-14 < 0 ) {
			a= '0px';
			barPosition= '0px';
		}else {

			a= -( barPosition-14 )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-14+'px';

		}
	}
	$('#Scrollbar-Handle_1').css('top', barPosition);
	$('#mailBox_1').css('top', a);
	// $('#Scrollbar-Handle_1').delay(3000).css('opacity', '0');===>not work
	$setTimeout(function(){
		$('#Scrollbar-Handle_1').css('opacity', '0');
	},1);
}
function twoWheel(e){
	$('#Scrollbar-Handle_2').css('opacity', '0.5');

	var barHeight= $('#Scrollbar-Handle_2').css('height').split('p')[0];
	var totalBarHeight= $('#dv_scroll_track_2').css('height').split('p')[0];
	var mb= $('#mailBox_2').css('height').split('p')[0];
	var ml= $('#mailList_2').css('height').split('p')[0];
	var a;

	var direction= e.deltaY;// e.deltaY 往下滾為正
	var barPosition= $('#Scrollbar-Handle_2').css('top').split('p')[0];
	if ( direction>0 && !(barPosition>= totalBarHeight-barHeight) ){
	// 方向往下

		if ( barPosition-(-14) > totalBarHeight-barHeight ) {

			a= -( totalBarHeight-barHeight )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= totalBarHeight-barHeight+'px';

		}else {

			a= -( barPosition-(-14) )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-(-14)+'px';

		}
	}else if ( direction<0 && !(barPosition<= 0) ) {
	// 方向往上
		if ( barPosition-14 < 0 ) {
			a= '0px';
			barPosition= '0px';
		}else {

			a= -( barPosition-14 )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-14+'px';

		}
	}
	$('#Scrollbar-Handle_2').css('top', barPosition);
	$('#mailBox_2').css('top', a);
	// $('#Scrollbar-Handle_2').delay(3000).css('opacity', '0');===>not work
	$setTimeout(function(){
		$('#Scrollbar-Handle_2').css('opacity', '0');
	},1);
}
function threeWheel(e){
	$('#Scrollbar-Handle_3').css('opacity', '0.5');

	var barHeight= $('#Scrollbar-Handle_3').css('height').split('p')[0];
	var totalBarHeight= $('#dv_scroll_track_3').css('height').split('p')[0];
	var mb= $('.mailBox2').css('height').split('p')[0];
	var ml= $('.mailInfoList').css('height').split('p')[0];
	var a;

	var direction= e.deltaY;// e.deltaY 往下滾為正
	var barPosition= $('#Scrollbar-Handle_3').css('bottom').split('p')[0];
	if ( direction<0 && !(barPosition>= totalBarHeight-barHeight) ){
	// 方向往上

		if ( barPosition-(-14) > totalBarHeight-barHeight ) {

			a= -( totalBarHeight-barHeight )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= totalBarHeight-barHeight+'px';

		}else {

			a= -( barPosition-(-14) )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-(-14)+'px';

		}
	}else if ( direction>0 && !(barPosition<= 0) ) {
	// 方向往下

		if ( barPosition-14 < 60 ) {
			a= '60px';
			barPosition= '60px';
		}else {

			a= -( barPosition-14 )*( (mb-ml) / (totalBarHeight-barHeight) )+'px';
			barPosition= barPosition-14+'px';

		}
	}
	$('#Scrollbar-Handle_3').css('bottom', barPosition);
	$('.mailBox2').css('bottom', a);
	// $('#Scrollbar-Handle_3').delay(3000).css('opacity', '0');===>not work
	$setTimeout(function(){
		$('#Scrollbar-Handle_3').css('opacity', '0');
	},1);
}

// mailGet!!!!!!!!!!!!!!


function getStart(){

	var mailType = 'beginning';
	var memAccount = $('input[name="forMemberAccount"]').val();

	$.ajax({
		url:"function/mailGet.php",
		type:"POST",
		data:{mailType:mailType,memAccount:memAccount},
		dataType:"JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('.unReadCount').text('('+data["unReadCount"]+')');
				$('#mailBox_2').html(data["data"]);
				setMailClick();
				changeBar();
			}else{
				alert('error');
			}
		}
	})

	setInterval("getStart()",60000);
}
//點擊左側會員頭像倒出右側訊息
function getMesFromMemberTriger(mailId){	

	getMesFromMember(mailId);
	getStart();
	
}

function getMesFromMember(mailId){

	var a = mailId;
	var mailFrom = $("#"+a).attr('mailFrom');
	// var mailId = $('.mail').attr('mailId');
	
	var mailTypeRight = 'memberOnClick';
	var memAccount = $('input[name="forMemberAccount"]').val();

	// console.log(mailFrom);
	// console.log(a);
	

	$.ajax({

		url: "function/mailGet.php",
		type: "POST",
		data: {mailType:mailTypeRight,mailId:mailId,mailFrom:mailFrom,memAccount:memAccount},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#mailBox_3').html(data['data']);
				//移植相關資料到回信INPUT欄位
				$('.mailTo').text(' '+data['mailFrom']);
				$('input[name="remail_mailTo"]').val(data['mailFrom']);
				$('input[name="remail_mailFrom"]').val(memAccount);
				$('input[name="remail_mailId"]').val(a);

				//移植相關資料到新寄信INPUT欄位
				$('input[name="newMail_mailFrom"]').val(memAccount);

				changeBar();
			}
		}

	})

	setInterval("getMesFromMember(mailId)",60000);

}

function replyMail(){
	var mailInfo = $('input[name="remail_mailInfo"]').val();
	var mailFrom = $('input[name="remail_mailFrom"]').val();
	var mailTo = $('input[name="remail_mailTo"]').val();
	var mailId = $('input[name="remail_mailId"]').val();
	var mailSource = 'reMail';

	

	$.ajax({
		url:"function/mailSend.php",
		data: {mailInfo:mailInfo,mailFrom:mailFrom,mailTo:mailTo,mailId:mailId,mailSource:mailSource},
		type: "POST",
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				
				$('#cont_1').text("");
				getMesFromMemberTriger(mailId);
			}
		}
	})
}


function newMail(){
	var mailTo = $('input[name="newMail_mailTo"]').val();
	var mailInfo = $('input[name="newMail_mailInfo"]').val();
	var mailFrom = $('input[name="newMail_mailFrom"]').val();
	var mailSource = 'newMail';

	$.ajax({

		url:"function/mailSend.php",
		type:"POST",
		data:{mailTo:mailTo,mailInfo:mailInfo,mailFrom:mailFrom,mailSource:mailSource},
		dataType:"JSON",
		success: function(data){
			if(data['status'] == 'success'){
				location.href='mail_1.php';
				changeBar();
			}
		}

	})


}

window.addEventListener('load', init, false);