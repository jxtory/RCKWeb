$(window).scroll(function(event) {
			//规则;
			var topHeight = 60;
			var topWidth = 180;
			var topNavMarginTop = 11;

			//滚动到多少像素时发生
			var trans_position = 60;

			/* 事件 */
			var scrollTop = $(window).scrollTop();
			if(scrollTop > trans_position){
				$('.top,.topContent,.topLogo,.topBg').css('height', topHeight);
				$('.topLogo').css('width', topWidth);
				$('.navMarginTop').css('margin-top', topNavMarginTop);

			} else {
				//最顶部时候
				$('.top,.topContent,.topLogo,.topBg').css('height', 90);
				$('.topLogo').css('width', 270);
				$('.navMarginTop').css('margin-top', 41);

			}
		});


$(document).ready(function(){
	$('.number').each(function(){
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		},{
			duration: 2000,
			easing: 'swing',
			step: function (now){
				$(this).text(Math.ceil(now));
			}
		});
	});
});

	// S动态控制.content Height
//	$(function(){
//		var cLeft = $(".cLeft").css("height");
//		var cRight = $(".cRight").css("height");
//		var commHeight = 0;
//
//		commHeight = parseInt(cLeft) > parseInt(cRight) ? cLeft : cRight;
//
//		$(".content").css("height", commHeight);
//
//	});
	// E动态控制.content Height

    $(function(){
        //移动端使用touchend
        var event = navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) ? 'touchend' : 'click';

        // 选择器
        var Q = function (id) {
            return document.getElementById(id)
        };

        //方向控制
        //右
        var _right = new mSlider({
            dom: ".layerRight",
            direction: "top"
        });
        var _child = new mSlider({
            dom: ".layerChild",
            direction: "top",
            time: "1000"
        });

        Q("Right").addEventListener(event, function (e) {
            _right.open();
        });

        Q("Close").addEventListener(event, function (e) {
            _right.close();
        });

        Q("btnChild").addEventListener(event, function (e) {
            _right.close();
            _child.open();
        })
    });