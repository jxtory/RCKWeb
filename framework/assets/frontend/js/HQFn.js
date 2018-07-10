
(function($){
	//首页资源收集
	//$(".head-login .login-right").slide({trigger:"click",titCell:".fan0508-hdnav li" ,mainCell:".fan0508-bdnav"})
	$('.fan0508-hdnav ul li').click(function(){
		//console.log($(this).index())
		$(this).siblings().removeClass('on');
		$(this).addClass('on');
		var index = $(this).index();
		//$('.fan0508-bdnav > div').siblings().css('display','none')
		$('.fan0508-bdnav > div').siblings().css('display', 'none');
		//var _num = $('.fan0508-bdnav > div').eq(index).fadeOut('display','block');
		$('.fan0508-bdnav > div').eq(index).css('display', 'block');
		//console.log(_num)
	})
	regFn({id:'reg',notNeedName:true,accuntHref:webAccount.TT});
	regFn_SY({id:'SYreg',notNeedName:true});
	HQ();
	$(".data-productTab").slide({mainCell:".bd ul",autoPlay:true,effect:"leftLoop",vis:6,scroll:1,trigger:"click"});
	$(".head-login .login-right").slide({trigger:"click",titCell:".fan0508-hdnav li" ,mainCell:".fan0508-bdnav"});
})(jQuery)