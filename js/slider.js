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
	if(window.innerWidth>=768){
		var svgPath = document.getElementsByTagName("path")[0];
	    var pathWidth = svgPath.getBoundingClientRect().width*.63;
	    var pathHeight = svgPath.getBoundingClientRect().height*.79;

	    document.getElementById("sliderBox").style.width = pathWidth+"px";
	    document.getElementById("sliderBox").style.height = pathHeight+"px";
	}else{
		document.getElementById("sliderBox").style.width = "100%";
	    document.getElementById("sliderBox").style.height = "100%";
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