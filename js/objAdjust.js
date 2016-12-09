window.addEventListener("load", adjustPos);
window.addEventListener("resize", adjustPos);
function adjustPos(){
	var consoleTitle = $("h1.consoleTitle");
	var consoleImg = $(".banner > img");
	if( $(window).width() > 970){
		switch($.trim(consoleTitle.text())){
		case "PLAYSTATION":
			consoleTitle.css("right", "151px");
			// consoleImg.css("top", "57px");
			break;
		case "WII":
			consoleTitle.css("right", "60px");
			consoleImg.css("top", "57px");
			break;
		case "XBOX":
			consoleTitle.css("right", "79px");
			consoleImg.css("top", "77px");
			break;
		case "MOBILE":
			consoleTitle.css("right", "100px");
			consoleImg.css("top", "53px");
			break;
		case "HANDHELD":
			consoleTitle.css("right", "128px");
			// consoleImg.css("top", "53px");
			break;
		case "PERSONAL COMPUTER":
			consoleTitle.css("right", "230px");
			consoleImg.css("top", "130px");
			break;
		}
	}
	if ( $(window).width() <= 767) {
		document.getElementsByClassName("prodItem")[3].style.display="none";
	}else{
		document.getElementsByClassName("prodItem")[3].style.display="block";
	}
	if( $(window).width() < 500 ){
		consoleImg.css("display", "none");
		$(".uiBtns .breadcrumbs").css("left","-6%");
	}else{
		consoleImg.css("display", "block");
	}
}