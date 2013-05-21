$.getScript('js/index.js');
$.getScript('js/superfish.js');
$.getScript('js/jquery.hoverIntent.minified.js');
$.getScript('js/FF-cash.js');
$.getScript('js/tms-0.4.1.js');
$.getScript('js/uCarousel.js');
$.getScript('js/jquery.easing.1.3.js');
$.getScript('js/jquery.tools.min.js');
$.getScript('js/jquery.jqtransform.js');
$.getScript('js/jquery.quicksand.js');
$.getScript('js/jquery.snippet.min.js');
$.getScript('js/jquery-ui-1.8.17.custom.min.js');
$.getScript('js/jquery.cycle.all.min.js');
$.getScript('js/jquery.cookie.js');
$.getScript('js/jquery.backgroundPosition.js');
$(function(){
	$('.meta-control').toggle(
		function(){
			$(this).animate({right:-40, backgroundPosition:'0 -30px'}, 100)
			$('.meta-row').delay(400).animate({height:40}, 100)
		},
		function(){
			$('.meta-row').animate({height:0}, 200)
			$('.meta-control').delay(200).animate({right:0, backgroundPosition:'0 0'}, 100)
		}
	)
	// if($('.mp-tabs-nav').length)$(".mp-tabs-nav").tabs(".mp-tab-content");
	//if($('.mp-tweet').length)$.include('js/jquery.tweet.js');
	//if($('#mp-contact-form').length)$.include('js/forms.js');
	//$('#select-car').jqTransform({imgPath:'images/'});
	// if($('.car-gallery').length)$('.car-gallery')._TMS({
	// 	show:0,
	// 	pauseOnHover:true,
	// 	prevBu:'gall-prev',
	// 	nextBu:'gall-next',
	// 	playBu:false,
	// 	pagNums:false,
	// 	numStatus:false,
	// 	duration:1000,
	// 	preset:'simpleFade',
	// 	items:'.gall-items>li',
	// 	bannerCl:false,
	// 	pagination:$('.car-gallery-pags').uCarousel({show:4,shift:0,buttonClass:'gall-btn', pageStep:1,axis:'y'}),
	// 	paginationCl:'gall-pags',
	// 	slideshow:5000,
	// 	banners:false,// fromLeft, fromRight, fromTop, fromBottom
	// 	waitBannerAnimation:false,
	// 	progressBar:false})
	//if($('#contact-form').length)$.include('js/forms.js');
	
	//if($('.pro_tweet').length)$.include('js/jquery.tweet.js');
	//if($('.lightbox-image').length)$.include('js/jquery.prettyPhoto.js');
	//if($('#pro_contact-form').length)$.include('js/forms.js');
	//if($('.pro_kwicks').length)$.include('js/kwicks-1.5.1.pack.js');
	//if($('#pro_counter').length)$.include('js/jquery.countdown.js');
	//if($('.fixedtip').length||$('.clicktip').length||$('.normaltip').length)$.include('js/jquery.atooltip.pack.js')
// Code
	//$("pre.pro_htmlCode2").snippet("html",{style:"print",showNum:false,menu:false});
	//$("pre.pro_jsCode2").snippet("javascript",{style:"print",showNum:false,menu:false});
// SlideDown
	//$(".pro_description-box dd").show()
	//$("pre.pro_htmlCode").snippet("html",{style:"print"});			
	//$("pre.pro_cssCode").snippet("css",{style:"print"});			
	//$("pre.pro_jsCode").snippet("javascript",{style:"print"});
	//$(".pro_description-box dd").hide()	
	/*$(".pro_description-box dt").click(function(){
		$(this).toggleClass("active").parent(".pro_description-box").find("dd").slideToggle(400);					
	});
	$(".pro_slide-down-box dt").click(function(){$(this).toggleClass("active").parent(".pro_slide-down-box").find("dd").slideToggle(200);});
	$(".pro_slide-down-box2 dt").click(function(){$(this).toggleClass("active").parent(".pro_slide-down-box2").find("dd").slideToggle(200);});	
	*/
// Tabs
	// $(".pro_tabs1 ul").tabs(".pro_tabs1 .pro_tab-content");
	// $(".pro_tabs2 ul").tabs(".pro_tabs2 .pro_tab-content");
	// $(".pro_tabs3 ul").tabs(".pro_tabs3 .pro_tab-content");
	// $(".pro_tabs4 ul").tabs(".pro_tabs4 .pro_tab-content");
	// $(".pro_tabs5 ul").tabs(".pro_tabs5 .pro_tab-content");
	// $(".pro_tabs-horz-top ul.pro_tabs-nav").tabs(".pro_tabs-horz-top .pro_tab-content");
	// $(".pro_tabs-horz-bottom ul.pro_tabs-nav").tabs(".pro_tabs-horz-bottom .pro_tab-content");
	// $(".pro_tabs-horz-top2 ul.pro_tabs-nav").tabs(".pro_tabs-horz-top2 .pro_tab-content");
	// $(".pro_tabs-horz-bottom2 ul.pro_tabs-nav").tabs(".pro_tabs-horz-bottom2 .pro_tab-content");
	// $(".pro_tabs-vert-left ul.pro_tabs-nav").tabs(".pro_tabs-vert-left .pro_tab-content");
	// $(".pro_tabs-vert-right ul.pro_tabs-nav").tabs(".pro_tabs-vert-right .pro_tab-content");	
// Forms
	//$('#pro_form2').jqTransform({imgPath:'images/'});
// Carausel
	// $('.pro_list-car').uCarousel({show:4,buttonClass:'pro_car-button', pageStep:1, shift:false})
	// $('.pro_carousel').uCarousel({show:4,buttonClass:'pro_car-button'})
// Slider
	// $('.pro_slider')._TMS({
	// 	show:0,
	// 	pauseOnHover:false,
	// 	prevBu:'.pro_prev',
	// 	nextBu:'.pro_next',
	// 	playBu:'.pro_play',
	// 	items:'.pro_items>li',
	// 	duration:1000,
	// 	preset:'simpleFade',
	// 	bannerCl:'pro_banner',
	// 	numStatusCl:'pro_numStatus',
	// 	pauseCl:'pro_paused',
	// 	pagination:true,
	// 	paginationCl:'pro_pagination',
	// 	pagNums:false,
	// 	slideshow:7000,
	// 	numStatus:true,
	// 	banners:'fade',// fromLeft, fromRight, fromTop, fromBottom
	// 	waitBannerAnimation:false,
	// 	progressBar:'<div class="pro_progbar"></div>'})	
// Simple Gallery
	// $('.pro_simple_gallery')._TMS({
	// 		show:0,
	// 		pauseOnHover:true,
	// 		prevBu:false,
	// 		nextBu:false,
	// 		playBu:false,
	// 		pagNums:false,
	// 		numStatus:false,
	// 		duration:1000,
	// 		preset:'simpleFade',
	// 		items:'.pro_items>li',
	// 		bannerCl:'pro_banner',
	// 		pagination:$('.pro_img-pags').uCarousel({show:10,shift:0,buttonClass:'pro_btn'}),
	// 		paginationCl:'pro_gal-pags',
	// 		slideshow:5000,
	// 		banners:'fade',// fromLeft, fromRight, fromTop, fromBottom
	// 		waitBannerAnimation:false,
	// 		progressBar:'<div class="pro_progbar"></div>'})		
// Ranges	
//$("#pro_font-size-slider").change(function(e) {$(".pro_icons.pro_basic li a").css("font-size", $(this).val() + "px");});
//$(".pro_color-slider").change(function(e) {$(".pro_icons.pro_basic li a").css("color", "hsla(" + $("#pro_color-slider-1").val() + ", " + $("#pro_color-slider-2").val() + "%, " + $("#pro_color-slider-3").val() + "%, 1)");	});
//$(".pro_shadow-slider").change(function(e) {	$(".pro_icons.pro_basic li a").css("text-shadow", $("#pro_shadow-slider-1").val() + "px " + $("#pro_shadow-slider-2").val() + "px " + $("#pro_shadow-slider-3").val() + "px black");	 });
// Testimonials
	//$('#pro_testimonials').cycle({fx:'fade', height:'auto',timeout:0,next:'#pro_next_testim',prev:'#pro_prev_testim', after: onAfter });
// Buttons
	//$(".pro_notClicked").click(function(event) {event.preventDefault();});
})
// Panel
// $(function(){
// 	$(window).scroll(function(){if ($(this).scrollTop() > 0) {$("#advanced").css({position:'fixed'});} else {$("#advanced").css({position:'relative'});}});
// 	$.cookie("panel");	
// 	$.cookie("panel2");	
// 	var strCookies = $.cookie("panel");
// 	var strCookies2 = $.cookie("panel2");
// 	if(strCookies=='boo')
// 	{
// 		if(strCookies2=='opened'){$("#advanced").css({marginTop:'0px'}).removeClass('closed')}else{$("#advanced").css({marginTop:'-40px'}).addClass('closed')}
// 		$("#advanced .trigger").toggle(function(){
// 			$(this).find('strong').animate({opacity:0}).parent().parent('#advanced').removeClass('closed').animate({marginTop:'0px'},"fast");
// 			strCookies2=$.cookie("panel2",'opened');
// 			strCookies=$.cookie("panel",null);},
// 		function(){
// 			$(this).find('strong').animate({opacity:1}).parent().parent('#advanced').addClass('closed').animate({marginTop:'-40px'},"fast")
// 			strCookies2=$.cookie("panel2",null);
// 			strCookies=$.cookie("panel",'boo');});
// 		if ($(window).scrollTop() > 0) {$("#advanced").css({position:'fixed'});}else {$("#advanced").css({position:'relative'});}
// 	}
// 	else
// 	{
// 		$("#advanced").css({marginTop:'0px'}).removeClass('closed');
// 		$("#advanced .trigger").toggle(function(){
// 			$(this).find('strong').animate({opacity:1}).parent().parent('#advanced').addClass('closed').animate({marginTop:'-40px'},"fast");
// 			strCookies2=$.cookie("panel2",null);
// 			strCookies=$.cookie("panel",'boo');},
// 		function(){
// 			$(this).find('strong').animate({opacity:0}).parent().parent('#advanced').removeClass('closed').animate({marginTop:'0px'},"fast")
// 			strCookies2=$.cookie("panel2",'opened');
// 			strCookies=$.cookie("panel",null);});
// 		if ($(window).scrollTop() > 0) {$("#advanced").css({position:'fixed'});} else {$("#advanced").css({position:'relative'});}
// 	}
// });
// function onAfter(curr, next, opts, fwd){var $ht=$(this).height();$(this).parent().animate({height:$ht})}
