	function resizeFrame()
	{
		var bh = $("body").height();
		var bw = $("body").width();
		var sw = screen.width;
		bh += 20;
		var wh = $(window).height();
		if (wh >= bh) { myh = wh; } else { myh = bh; } 
		var w = $(window).width();
		var c = $('#page').width();
		if (w > sw) {
			var half = (sw - c) / 2;
		} else {
			var half = (w - c) / 2;
		}
		$("#leftpanel").css('height',myh);
		$("#leftpanel").css('width',half);
		$("#rightpanel").css('left',half+c);
		$("#rightpanel").css('width',half);
		$("#rightpanel").css('height',myh);
		$(".rightpane").css('margin-right:',half+5);
	}
	jQuery.event.add(window, "load", resizeFrame());
	jQuery.event.add(window, "resize", resizeFrame()); 
	$(document).ready(function() {
		resizeFrame();
	});
