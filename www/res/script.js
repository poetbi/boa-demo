function login(type){
	var url = '/index.php?m=user&c=oauth&a=login&type='+ type;
	if(self != top && type == "qq"){
		setCookie("goto", top.location.href, 3600);
		top.location.href = url;
	}else{
		location.href = url;
	}
}

function setCookie(key, val, ttl){
    var obj = new Date();
    obj.setTime(obj.getTime() + ttl * 1000);
    document.cookie = key + "="+ escape(val) + ";expires=" + obj.toGMTString() + ";path=/;";
}

function getCookie(key){
	var reg = new RegExp("(^| )"+ key +"=([^;]*)(;|$)");
	var arr = document.cookie.match(reg);
    if(arr){
		return unescape(arr[2]);
	}else{
		return null;
	}
}

function delCookie(key){
    setCookie(key, null, -1);
}

function avatar(obj, name){
	var size = 45;

	var color = getColor(name);
	var red = color[0];
	var green = color[1];
	var blue = color[2];

	var canvas = document.createElement("canvas");
	canvas.width = size;
    canvas.height = size;
 
	var context = canvas.getContext("2d");
	context.fillStyle = "rgb("+ red +", "+ green +", "+ blue +")";
	context.fillRect(0, 0, size, size);
	
	name = name.substr(0, 1);
	if(!name) name = 'B';
	context.font = "25px bold 黑体";
	context.fillStyle = "rgb("+ (255 - red) +", "+ (255 - green) +", "+ (255 - blue) +")";
	context.textAlign = "center";
	context.textBaseline = "middle";
	context.fillText(name, 22, 25);

	var uri = canvas.toDataURL("image/png");
	obj.src= uri;
}

function getColor(str){
	var color = [0, 0, 0];
	for(i=0; i<str.length; i=i+3){
		if(str[i]) color[0] = color[0] + str.charCodeAt(i);
		if(str[i+1]) color[1] = color[1] + str.charCodeAt(i+1);
		if(str[i+2]) color[2] = color[2] + str.charCodeAt(i+2);
	}
	for(i=0; i<3; i++){
		color[i] = color[i] % 255;
	}
	return color;
}

function getRandom(start, end, fixed = 0){
	var diff = end - start;
	var random = Math.random();
	return (start + diff * random).toFixed(fixed);
}

function checkMobile(s){
	var reg =/^[1][3-9][0-9]{9}$/;
	var re = new RegExp(reg);
	if(re.test(s)){
		return true;
	}else{
		return false;
	}
}

function countDown(obj, num){
	if(num < 1){
		obj.attr('number', 0);
		obj.html("发送");
	}else{
		obj.attr('number', num);
		obj.html("("+ num +" s)");
		num--;
		setTimeout(function(){ countDown(obj, num); }, 1000);
	}
}

function toast(txt){
	var obj = $(".bs_toast");
	if(obj.length == 0){
		var css_obj = "background:rgba(88,88,88,0.88);position:absolute;display:none;border-radius:8px;padding:12px;font-size:1.2rem;color:#FFF;z-index:999;min-width:11rem;"
		var div = $('<div class="bs_toast" style="'+ css_obj +'"></div>');
		$('body').append(div);
		var obj = $(".bs_toast");
	}

	obj.css('width', 'auto');
	obj.html(txt);
	obj.fadeIn();
	var w_width = $(window).width();
	var t_width = obj.width();
	obj.css('width', t_width +"px");
	obj.css('left', parseInt((w_width - t_width) / 2 - 12) +"px");
	var top = parseInt($(window).scrollTop() + ($(window).height() - obj.height()) / 2);
	obj.css('top', top +"px");
	
	var delay = 5;
	var len = txt.length;
	if(len > 10) delay = 5 + ((len - 10) / 2);
	window.setTimeout(function(){
		obj.fadeOut();
	}, delay * 1000);
	
	obj.on('click', function(){
		obj.fadeOut();
	});

	return false;
}

function showFrame(url){
	var css_btn = "position:absolute;right:0;margin-right:-0.75rem;margin-top:-0.75rem;display:block;background-color:#F00;line-height:1.5rem;width:1.5rem;height:1.5rem;border-radius:50%;text-align:center;color:#fff;cursor:pointer;box-sizing:border-box;";
	btn = '<span style="'+ css_btn +'">X</span>';

	var obj = $("#bs_frame");
	if(obj.length == 0){
		var css_obj = "position:fixed;display:none;background-color:#fff;z-index:999;top:20%;left:20%;width:60%;height:60%;border:solid 1px #ccc;";
		var div = $('<div id="bs_frame" style="'+ css_obj +'">'+ btn +'<iframe name="bs_frame" frameborder="0" width="100%" height="100%" src="about:blank"></iframe></div>');
		$('body').append(div);
		var obj = $("#bs_frame");
	}

	obj.find("IFRAME").attr("src", url);
	obj.fadeIn();

	$("#bs_frame > span").on("click", function(){
		obj.fadeOut();
	});
}

function hideFrame(){
	$("#bs_frame").fadeOut();
}

$(document).ready(function(){
	if(self != top){
		$("._hide_").hide();
	}
});