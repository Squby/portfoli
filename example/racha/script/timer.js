(function(){var _id="7f1078007a93dd84b0fd2b66104e5160";
	while(document.getElementById("timer"+_id))_id=_id+"0";
	document.write("<div id='timer"+_id+"' style='min-width:112px;height:112px;'></div>");
	var _t=document.createElement("script");_t.src="http://raya2days.phuket7dimension.ru/timeradd.js";
	var _f=function(_k){var l=new MegaTimer(_id, {"view":[0,0,0,1],"type":{"currentType":"2","params":{"startByFirst":true,"days":"0","hours":"0","minutes":"1","utc":0}},
		"design":{"type":"circle","params":{"width":"3","radius":"52","line":"solid","line-color":"#ffffff","background":"opacity","direction":"direct",
		"number-font-family":{"family":"Comfortaa","link":"<link href='http://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic'
		 rel='stylesheet' type='text/css'>"},"number-font-size":"60","number-font-color":"#ffffff","separator-margin":"20",
		 "separator-on":false,"separator-text":":","text-on":false,"text-font-family":{"family":"Arial"},
		 "text-font-size":"12","text-font-color":"red"}},"designId":5,"theme":"white","width":112,"height":112});
	if(_k!=null)l.run();};_t.onload=_f;_t.onreadystatechange=function(){if(_t.readyState=="loaded")_f(1);};
		var _h=document.head||document.getElementsByTagName("head")[0];_h.appendChild(_t);}).call(this);
