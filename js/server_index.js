function getStart(){
	var showTab = 0; 
	var $default = $('div.pageList a').eq(showTab).addClass('active');
	$($default.find('a').attr('href')).siblings().hide();

	$('.pageList a').click(function(){

		var $this = $(this);
		var clickTab = $this.attr('href');
		console.log(clickTab);

		$this.addClass('active').siblings('.active').removeClass('active');

		$(clickTab).stop(false,true).fadeIn().siblings().hide();

		return false;

	}).find('a').focus(function(){
		this.blur();
	});
}

// 商品管理
function productRow(){

	$.ajax({
		url: "function/server_index_productRow.php",
		type: "POST",
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#proInfoHolder').html(data['data']);
				$('#proPages').html(data['pages']);
			}
		}
	})

}

function proPageReload(pages){

	$.ajax({

		url: "function/server_index_productRow.php",
		type: "POST",
		data: {pages:pages},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#proInfoHolder').html(data['data']);
				$('#proPages').html(data['pages']);
			}
		}

	})

}

function proUpdate(proId){
	console.log(proId);
	$('#productUpdate').attr('value',proId);

}

function proDelete(proId){

	alert('已成功刪除商品');
	location.reload();

	$.ajax({
		url: "function/server_productUpdate.php",
		type: "POST",
		data: {deleteProId:proId,delete:'true'},
		dataType: "JSON",

	})

}

// 訂單管理
function orderRow(){

	$.ajax({
		url: "function/server_orderManager.php",
		type: "POST",
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#orderInfoHolder').html(data['data']);
				$('#orderPages').html(data['pages']);
			}
		}
	})

}

function orderPageReload(pages){

	$.ajax({

		url: "function/server_orderManager.php",
		type: "POST",
		data: {pages:pages},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#orderInfoHolder').html(data['data']);
				$('#orderPages').html(data['pages']);
			}
		}

	})
}

function orderDetail(orderId){

	$.ajax({
		url: "function/server_orderDetail.php",
		type: "POST",
		data: {orderId:orderId},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#orderDetailRow').html(data['data']);
			}
		}
	})

}

function orderShipOut(orderId){

	$.ajax({
		url: "function/server_dealOrder.php",
		type: "POST",
		data: {orderId:orderId},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				orderRow();
			}
		}
	})

}

// 新聞管理
function newsRow(){

	$.ajax({
		url: "function/server_newsManager.php",
		type: "POST",
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#newsInfoHolder').html(data['data']);
				$('#newsPages').html(data['pages']);
			}
		}
	})

}

function newsUpdate(newsId){

	$('#newsId_update').attr('value',newsId);

}

function newsDelete(newsId){

	alert('已成功刪除新聞');
	newsRow();

	$.ajax({
		url: "function/server_newsUpdate.php",
		type: "POST",
		data: {deleteNewsId:newsId,delete:'true'},
		dataType: "JSON",
	})

}

function newsPageReload(pages){

	$.ajax({
		url: "function/server_newsManager.php",
		type: "POST",
		data: {pages:pages},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				$('#newsInfoHolder').html(data['data']);
				$('#newsPages').html(data['pages']);
			}
		}
	})

}

//檢舉管理
function reportRow(){

	comReportRow();
	replyReportRow();

}

function comReportRow(){

	$.ajax({
		url: "function/server_reportManager.php",
		type:"POST",
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#comReportHolder').html(data['data']);
				$('#comPages').html(data['pages']);
			}
		}
	})

}

function replyReportRow(){

	$.ajax({
		url: "function/server_replyManager.php",
		type:"POST",
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#replyReportHolder').html(data['data']);
				$('#replyPages').html(data['pages']);
			}
		}
	})

}

function comPageReload(pages){

	$.ajax({
		url: "function/server_reportManager.php",
		type:"POST",
		data: {pages:pages},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#comReportHolder').html(data['data']);
				$('#comPages').html(data['pages']);
			}
		}
	})

}

function replyPageReload(pages){

	$.ajax({
		url: "function/server_replyManager.php",
		type:"POST",
		data: {pages:pages},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#replyReportHolder').html(data['data']);
				$('#replyPages').html(data['pages']);
			}
		}
	})

}

function comInfo(comId){

	$.ajax({
		url: "function/server_reportDetail.php",
		type: "POST",
		data: {reportType:'comments',comId:comId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#reportContent').html(data["data"]);
			} 
		}
	})

}

function replyInfo(replyId){

	$.ajax({
		url: "function/server_reportDetail.php",
		type: "POST",
		data: {reportType:'reply',replyId:replyId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				$('#reportContent').html(data["data"]);
			} 
		}
	})

}

function comRestore(comId){

	

	$.ajax({
		url: "function/server_reportRestore.php",
		type: "POST",
		data: {reportType:'comments',comId:comId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				alert('恢復成功');
				reportRow();
			}
		}
	})

}

function replyRestore(replyId){

	

	$.ajax({
		url: "function/server_reportRestore.php",
		type: "POST",
		data: {reportType:'reply',replyId:replyId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				alert('恢復成功');
				reportRow();
			}
		}
	})

}

function comDelete(comId){

	$.ajax({
		url: "function/server_reportDelete.php",
		type: "POST",
		data: {reportType:'comments',comId:comId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				alert('刪除成功');
				reportRow();
			}
		}
	})

}

function replyDelete(replyId){

	$.ajax({
		url: "function/server_reportDelete.php",
		type: "POST",
		data: {reportType:'reply',replyId:replyId},
		dataType: "JSON",
		success: function(data){
			if(data["status"] == "success"){
				alert('刪除成功');
				reportRow();
			}
		}
	})

}

//banner 管理

window.addEventListener("load", getStart, false);
window.addEventListener("load", productRow, false);
