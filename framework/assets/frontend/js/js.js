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


/* - - - - - - - - - - ↓注册页面JS↓ - - - - - - - - - - */
    $(function(){
        //移动端使用touchend
        var event = navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) ? 'touchend' : 'click';

        // 选择器
        var Q = function (id) {
            return document.getElementById(id)
        };

        //方向控制
        //右
        if($("title").text() == "首页"){
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
                if(user_Boolean && password_Boolean && varconfirm_Boolean && emaile_Boolean && Mobile_Boolean){
                    var url = "index/index/register.html";
                    var vun = $(".reg_user").val();
                    var vps = $(".reg_password").val();
                    var vem = $(".reg_email").val();
                    var vmb = $(".reg_mobile").val();

                    $.post(
                        url,
                        {
                            action: "register",
                            username: vun,
                            password: vps,
                            email: vem,
                            mobile: vmb
                        },
                        function(data){
                            if(data == "true"){
                                _right.close();
                                _child.open();
                            } else if(data == "false"){
                                alert("注册失败了");
                            } else if(data == "username repeat"){
                                alert("用户名重复");
                            }
                        }

                    );
                    
                } else {
                    alert("请完善信息");
                }

            });
        }

    });

/* - - - - - - - - - - ↓登录事件JS↓ - - - - - - - - - - */
    $(function(){
        // 登录
        $(".login").click(function(){
            var url = "index/index/login.html";
            var vun = $(".telinput").val();
            var vps = $(".codenput").val();

            $.post(
                url,
                {
                    username: vun,
                    password: vps
                },
                function(data){
                    if(data == "false"){
                        alert("登录失败！");
                    } else {
                        window.location.reload();
                    }
                }
            );
        });

        // 退出登录
        $(".logout").click(function(){
            var url = "index/index/logout.html";

            $.post(
                url,
                {
                    action: "logout"
                },
                function(data){
                    if(data == "true"){
                        window.location.reload();
                    } else {
                        alert("无法退出!");
                    }
                }
            );
        });

    });


/* - - - - - - - - - - ↓navIng自动上JS↓ - - - - - - - - - - */

    $(function(){
        var myTitle = $("title").text();
        $("li>a:contains('" + myTitle + "')").parent().addClass("navIng");
    });
