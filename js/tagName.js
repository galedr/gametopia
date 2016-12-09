window.addEventListener("load", tagClass);

function tagClass(){
	var tags = document.getElementsByClassName("tagName");
	for(var i=0;i<tags.length;i++){
		switch(tags[i].innerText){
			case "PS4":
				tags[i].style.backgroundColor = "#0072BC";
				break;
			case "Wii":
				tags[i].style.backgroundColor = "#DAAB10";
				break;
			case "PC":
				tags[i].style.backgroundColor = "#A865A8";
				break;
			case "XBOX":
				tags[i].style.backgroundColor = "#7CC576";
				break;
			case "3DS":
				tags[i].style.backgroundColor = "#C05459";

		}
	}
	
	var cn = document.getElementsByClassName("catName");
	var ct = document.getElementsByClassName("catTarget");
	console.log("Name:"+cn.length+", Target:"+ct.length);
	for(var i=0;i<cn.length;i++){
		console.log(cn[i].innerText);
		switch(cn[i].innerText){
			case "即時射擊":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-dot-circle-o";
				break;
			case "角色扮演":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-gavel";
				break;
			case "多人合作":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-users";
				break;
			case "動作驚險":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-flash";
				break;
			case "競速刺激":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-motorcycle";
				break;
			case "策略多謀":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-lightbulb-o";
				break;
			case "運動休閒":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-futbol-o";
				break;
			case "冒險犯難":
				cn[i].getElementsByClassName("catTarget")[0].className = "fa fa-exclamation-triangle";
				break;
		}
	}
		
}