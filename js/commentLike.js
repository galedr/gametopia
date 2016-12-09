function replyLikeAdd(memAccount,replyId,likeType){
	// var memAccount = $(this).attr("memaccount");
	// var replyId = $(this).attr('replyid');
	// var likeType = $(this).attr('liketype');
	console.log(memAccount);

	$.ajax({
		url: "function/commentLike.php",
		type: "POST",
		data: {memAccount:memAccount,replyId:replyId,likeType:likeType},
		dataType: "JSON",
		success: function(add){
			if(add['status'] == 'success'){
				
				location.reload();
				
			}else{
				alert('error');
			}
		}
	});

}

function replyLikeMiner(memAccount,replyId,likeType){
	// var memAccount = $(this).attr('memaccount');
	// var replyId = $(this).attr('replyid');
	// var likeType = $(this).attr('liketype');

	console.log(memAccount);

	$.ajax({
		url: "function/commentLike.php",
		type: "POST",
		data: {memAccount:memAccount,replyId:replyId,likeType:likeType},
		dataType: "JSON",
		success: function(miner){
			if(miner['status'] == 'success'){
				
				location.reload();
				
			}else{
				alert('error');
			}	
		}
	});
}

function comLikeAdd(){
	var memAccount = $('input[name="com_memAccount"]').val();
	var comId = $('input[name="comId"]').val();
	var likeType = $('input[name="comLike"]').val();

	$.ajax({
		url: "function/commentLike.php",
		type: "POST",
		data: {memAccount:memAccount,comId:comId,likeType:likeType},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				
				location.reload();
				
			}else{
				alert('error');
			}	
		}
	});
}

function comLikeMiner(){
	var memAccount = $('input[name="com_memAccount"]').val();
	var comId = $('input[name="comId"]').val();
	var likeType = $('input[name="comDis"]').val();

	$.ajax({
		url: "function/commentLike.php",
		type: "POST",
		data: {memAccount:memAccount,comId:comId,likeType:likeType},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				
				location.reload();
				
			}else{
				alert('error');
			}	
		}
	});
}

function comReport(){
	var comId = $('.comReport').attr('value');
	var reportFrom = 'comments';

	$.ajax({

		url: "function/forumReport.php",
		type: "POST",
		data: {comId:comId,reportFrom:reportFrom},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				alert('檢舉成功');
			}
		}

	})
}

function replyReport(replyId){
	var replyId = replyId;
	var reportFrom = 'reply';

	$.ajax({

		url: "function/forumReport.php",
		type: "POST",
		data: {replyId:replyId,reportFrom:reportFrom},
		dataType: "JSON",
		success: function(data){
			if(data['status'] == 'success'){
				alert('檢舉成功');
			}
		}

	})

}