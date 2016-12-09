function doFirst(){
	var tabs= document.getElementsByClassName('tab');
	// 頁籤增加事件
	for (var i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener('click', chooseTabs, false);
	}

// 偵測最新新聞區塊高度，取最高
	var NEWS_height= ["0"];
	var NEWS_height_object= ["0"];
	
	NEWS_height_object.push($('#lastNews_1'));
	NEWS_height_object.push($('#lastNews_2'));
	NEWS_height_object.push($('#lastNews_3'));
	NEWS_height_object.push($('#lastNews_4'));
	var k= 0;
	//內框
	NEWS_height.push(NEWS_height_object[1].height());
	NEWS_height.push(NEWS_height_object[2].height());
	NEWS_height.push(NEWS_height_object[3].height());
	NEWS_height.push(NEWS_height_object[4].height());
	// console.log(NEWS_height.length);
	for (var i = NEWS_height.length; i > 0; i--) {
		if (NEWS_height[i]> NEWS_height[0]) {
			NEWS_height[0]= NEWS_height[i];
			k= i;
		}else{
			continue;
		}
	}
	for (var i = 4; i > 0; i--) {
		// console.log(NEWS_height[0]+20);
		var outBox_obj= "#lastNewsPreview_"+ i;
		$(outBox_obj).height(NEWS_height[0]+20);
		if (k!= i) {
			NEWS_height_object[i].height(NEWS_height[0]);
		}
	}

	$(window).resize(function(){
		// console.log($(window).width());
		var NEWS_height= ["0"];
		var NEWS_height_object= ["0"];
		
		NEWS_height_object.push($('#lastNews_1'));
		NEWS_height_object.push($('#lastNews_2'));
		NEWS_height_object.push($('#lastNews_3'));
		NEWS_height_object.push($('#lastNews_4'));
		var k= 0;

		$(NEWS_height_object[1]).css('height','');
		$(NEWS_height_object[2]).css('height','');
		$(NEWS_height_object[3]).css('height','');
		$(NEWS_height_object[4]).css('height','');

		//內框
		NEWS_height.push(NEWS_height_object[1].height());
		NEWS_height.push(NEWS_height_object[2].height());
		NEWS_height.push(NEWS_height_object[3].height());
		NEWS_height.push(NEWS_height_object[4].height());
		// console.log(NEWS_height);
		for (var i = NEWS_height.length; i > 0; i--) {
			if (NEWS_height[i]> NEWS_height[0]) {
				NEWS_height[0]= NEWS_height[i];
				k= i;
			}else{
				continue;
			}
		}
		for (var i = 4; i > 0; i--) {
			// console.log(NEWS_height[0]+20);
			var outBox_obj= "#lastNewsPreview_"+ i;
			$(outBox_obj).height(NEWS_height[0]+20);
			if (k!= i) {
				NEWS_height_object[i].height(NEWS_height[0]);
			}
		}
	});
// 偵測其他新聞區塊高度，取最高
	var totalNEWS= document.getElementsByClassName('newsBox');
	var totalHeightest= 0;
	for (var i = 0; i < totalNEWS.length; i++) {
		// console.log($(totalNEWS[i]).height());
		if ( $(totalNEWS[i]).height() > totalHeightest ) {
			totalHeightest= $(totalNEWS[i]).height();
		}
	}
	for (var i = 0; i < totalNEWS.length; i++) {
		$(totalNEWS[i]).height(totalHeightest);
	}

	$(window).resize(function(){
		var totalNEWS= document.getElementsByClassName('newsBox');
		var totalHeightest= 0;
		for (var i = 0; i < totalNEWS.length; i++) {
			$(totalNEWS[i]).css('height', '');
			if ( $(totalNEWS[i]).height() > totalHeightest ) {
				totalHeightest= $(totalNEWS[i]).height();
			}
		}
		for (var i = 0; i < totalNEWS.length; i++) {
			$(totalNEWS[i]).height(totalHeightest);
		}
	});

}
function chooseTabs() {
	// 更換頁面
	var radioBtn= document.getElementsByName('tabs');
	if(this.id== 'tab_1')
		radioBtn[0].checked= true;
	else if(this.id== 'tab_2')
		radioBtn[1].checked= true;
	else if(this.id== 'tab_3')
		radioBtn[2].checked= true;
}
window.addEventListener('load', doFirst, false);