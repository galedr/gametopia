window.addEventListener("load", init);
window.addEventListener("load", sliderFunc);
window.addEventListener("resize", resizeSlider);

function init(){
	btnLeft = document.getElementById("btnLeft");
	btnRight = document.getElementById("btnRight");
	btnLeft.addEventListener("click", slideCtrl);
	btnRight.addEventListener("click", slideCtrl);
	slides = document.querySelectorAll("#sliderBox .slide");
	current = 0;

	resizeSlider();
}

function resizeSlider(){
	console.log(window.innerWidth);
	if(window.innerWidth >= 768){ /*動態改變SLIDER大小與SVG相符*/
		var svgPath = document.getElementsByTagName("path")[0];
	    var pathWidth = svgPath.getBoundingClientRect().width*.63;
	    var pathHeight = svgPath.getBoundingClientRect().height*.79;

	    document.getElementById("sliderBox").style.width = pathWidth+"px";
	    document.getElementById("sliderBox").style.height = pathHeight+"px";
	}else{
		document.getElementById("sliderBox").style.width = "100%";
	    document.getElementById("sliderBox").style.height = "100%";
	}

	if(window.innerWidth < 550){ /*動態變更banner高度*/
		console.log("slider img height:"+$("#sliderBox .slide img").height());
		$(".productsBox .banner").css("height",$("#sliderBox .slide img").height());
	}else if(window.innerWidth >= 550 && window.innerWidth < 768){
		$(".productsBox .banner").css("height", "350px");
	}else if(window.innerWidth >=768 && window.innerWidth < 1200){
		$(".productsBox .banner").css("height", "400px");
	}else{
		$(".productsBox .banner").css("height", "550px");
	}
	
	if(window.innerWidth == 768){
		$("#btnLeft").css("left","11%");
		$("#btnRight").css("right","11%");
	}
	if(window.innerWidth == 970){
		$("#btnLeft").css("left","17%");
		$("#btnRight").css("right","17%");
		$("#sliderBox").css("top", "-12px");
	}
	if(window.innerWidth == 1024){
		$("#btnLeft").css("left","14%");
		$("#btnRight").css("right","14%");
		$(".sliderArr").css("top","130px");
		$("#sliderBox").css("top", "-5px");
	}
}

function sliderFunc(){
		
	slideInterval = setInterval( nextSlide, 3500 );

}

function nextSlide(){
	slides[current].className = "slide"; /*把上一張的show拿掉*/
	current >= slides.length-1 ? current = 0:current++; /*當大於最大張數-1的時候回到slides[0]否則就繼續+1*/
    slides[current].className = "slide show"; /*將下一張加入show class讓他出現*/
    // console.log("Current:" + current);
}

function slideCtrl(){
	if(this == btnLeft){
		clearInterval( slideInterval );
		gotoSlide(current-1);
		sliderFunc();
	}

	if(this == btnRight){
		clearInterval( slideInterval )
		gotoSlide(current+1);
		sliderFunc();
	}
}

function gotoSlide(n){
	slides[current].className = "slide"; /*把上一張的show拿掉*/
	current = ( n + slides.length ) % slides.length;
    slides[current].className = "slide show"; /*將下一張加入show class讓他出現*/
}