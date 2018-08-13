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
            time: "3000"
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

var user_Boolean = false;
var password_Boolean = false;
var varconfirm_Boolean = false;
var emaile_Boolean = false;
var Mobile_Boolean = false;
$('.reg_user').blur(function(){
  if ((/^[a-z0-9_-]{4,8}$/).test($(".reg_user").val())){
    $('.user_hint').html("✔").css("color","green");
    user_Boolean = true;
  }else {
    $('.user_hint').html("×").css("color","red");
    user_Boolean = false;
  }
});
// password
$('.reg_password').blur(function(){
  if ((/^[a-z0-9_-]{6,16}$/).test($(".reg_password").val())){
    $('.password_hint').html("✔").css("color","green");
    password_Boolean = true;
  }else {
    $('.password_hint').html("×").css("color","red");
    password_Boolean = false;
  }
});


// password_confirm
$('.reg_confirm').blur(function(){
  if (($(".reg_password").val())==($(".reg_confirm").val())){
    $('.confirm_hint').html("✔").css("color","green");
    varconfirm_Boolean = true;
  }else {
    $('.confirm_hint').html("×").css("color","red");
    varconfirm_Boolean = false;
  }
});


// Email
$('.reg_email').blur(function(){
  if ((/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/).test($(".reg_email").val())){
    $('.email_hint').html("✔").css("color","green");
    emaile_Boolean = true;
  }else {
    $('.email_hint').html("×").css("color","red");
    emaile_Boolean = false;
  }
});


// Mobile
$('.reg_mobile').blur(function(){
  if ((/^1[34578]\d{9}$/).test($(".reg_mobile").val())){
    $('.mobile_hint').html("✔").css("color","green");
    Mobile_Boolean = true;
  }else {
    $('.mobile_hint').html("×").css("color","red");
    Mobile_Boolean = false;
  }
});


// click
$('.register').click(function(){
  if(user_Boolean && password_Boolean && varconfirm_Boolean && emaile_Boolean && Mobile_Boolean == true){
    alert("注册成功");
  }else {
    alert("请完善信息");
  }
});
