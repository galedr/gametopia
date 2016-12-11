function doFirst(){
	var cardHeight= $('.cartList .listItem .prodImage').css('width');
	$('#card_content').css('height', cardHeight);

	$(window).resize(function(){

		var cardHeight= $('.cartList .listItem .prodImage').css('width');
		$('#card_content').css('height', cardHeight);
		
	});

};
window.addEventListener('load', doFirst, false);