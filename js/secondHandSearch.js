//取得搜尋列的值
$(document).ready(function(){
	$('#gameConsole').change(function(){
		var gameConsole = $(this).val();
		$('input[name="gameConsole"]').val(gameConsole);	
	})
	$('#gameType').change(function(){
		var gameType = $(this).val();
		$('input[name="gameType"]').val(gameType);
	})
	$('#searchBtn').click(function(){
		var searchInfo = $('#search').val();
		$('input[name="searchInfo"]').val(searchInfo);
		searchResult();
	})
	$("#addCart").attr("style","cursor:pointer;");
	$("#addCart").click(function(){
		var proId = $('input[name="proId"]').val();
		$.ajax({
			url:"function/sessionCartAdd.php",
			type:"POST",
			data:{proId:proId,quantity:1},
			dataType:"JSON"
		})
	})
})

function searchResult(){
	var gameConsole = $('input[name="gameConsole"]').val();
	var gameType = $('input[name="gameType"]').val();
	var searchInfo = $('input[name="searchInfo"]').val();
	$.ajax({
		url:"function/secondHandSearch.php",
		type:"POST",
		data:{gameConsole:gameConsole,gameType:gameType,searchInfo:searchInfo},
		dataType:"JSON",
		success: function(data){
			$(".SH_products").html(data);
			searchAndAddCart();
		}
	})
}

function searchAndAddCart(proId){
	
		$.ajax({
			url:"function/sessionCartAdd.php",
			type:"POST",
			data:{proId:proId,quantity:1},
			dataType:"JSON"
		})
}