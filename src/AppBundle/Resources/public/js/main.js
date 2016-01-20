//
/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT / GPLv2 License.*/(function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),k=Math.abs(l.z),(!a.orientation||a.orientation===180)&&(i>7||(k>6&&j<8||k<8&&j>6)&&i>5)?h&&n():h||m()}var b=navigator.userAgent;if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1))return;var c=a.document;if(!c.querySelector)return;var d=c.querySelector("meta[name=viewport]"),e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0,i,j,k,l;if(!d)return;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)})(this);


var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1;


/* Modernizr 2.7.0 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-csstransitions-prefixed-testprop-testallprops-domprefixes
 */
;window.Modernizr=function(a,b,c){function w(a){i.cssText=a}function x(a,b){return w(prefixes.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b){for(var d in a){var e=a[d];if(!z(e,"-")&&i[e]!==c)return b=="pfx"?e:!0}return!1}function B(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}function C(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+m.join(d+" ")+d).split(" ");return y(b,"string")||y(b,"undefined")?A(e,b):(e=(a+" "+n.join(d+" ")+d).split(" "),B(e,b,c))}var d="2.7.0",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l="Webkit Moz O ms",m=l.split(" "),n=l.toLowerCase().split(" "),o={},p={},q={},r=[],s=r.slice,t,u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=s.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(s.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(s.call(arguments)))};return e}),o.csstransitions=function(){return C("transition")};for(var D in o)v(o,D)&&(t=D.toLowerCase(),e[t]=o[D](),r.push((e[t]?"":"no-")+t));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},w(""),h=j=null,e._version=d,e._domPrefixes=n,e._cssomPrefixes=m,e.testProp=function(a){return A([a])},e.testAllProps=C,e.prefixed=function(a,b,c){return b?C(a,b,c):C(a,"pfx")},e}(this,this.document);

$(document).ready(function(){
	
	//RFLEX TOGGLE HELP
	$(".rflex .candidateBoard .form-input-help .ico-help").click(function(){
		$(this).next().toggleClass('open');	
		return false;
	});
	
	// ANIMATION
	$('.animation-container').addClass('has-js');
	$('.animation-container .togglebox .box-head').on('click',function(){
		$(this).parent().toggleClass('open');
	});
	
	//SLIDER
	$(".slider-caption").on("click",function(){
		var links = $(this).parent().find("a");
		if(links.length > 0){
			links.eq(0).click();
		}else{
			return false;	
		}
	});
	
	/////////////////////NAV MOBILE
	var agentID = ua.match(/(iphone|ipod|ipad)/);
	var onEvent = (agentID) ? "touchend" : "click";
	//Create nav (menu + worldwide)
	var worldwide = $('.toolbarNavigation .worlwideMenu ul.title').clone();
	worldwide.find('.subNav').remove();
	$('.mobile-navigation-worldwide > li').eq(0).html('<a href="#" id="side-nav-mobile"></a>');
	$('.mobile-navigation-worldwide > li #side-nav-mobile').html(worldwide.text()+' <i class="toto"></i>');
	
	//OPEN / CLOSE worlwideMenu menu
	$(".toolbarNavigation .worlwideMenu .title > li > span, .toolbarNavigation .selectMenu > li .btnCell").on(onEvent,function(event){
		event.preventDefault();
		event.stopPropagation();
		$("#mainNav li.is-open").removeClass('is-open');
		if(!$(this).parent().hasClass('is-open')){
			$(".toolbarNavigation li.is-open").removeClass('is-open');
			$(this).parent().addClass('is-open');
			$(this).parent().removeClass('is-closed');
		}else{
			$(".toolbarNavigation li.is-open").removeClass('is-open');
			$(this).parent().addClass('is-closed');
		}
		return false;
	});
	
	//TOGGLE FILTERBOX
	if($(".filter-container").length){
		$(".filter-container").find(".boxTitle").append("<i class='ico-toggle'></i>");
		var classNameInit='';
		if(readCookie('search-filter')!=null && readCookie('search-filter')=='open'){
			classNameInit = "filter-open";
		}
		$(".filter-container").addClass("filter-container-js "+classNameInit);
		$(".filter-container .boxTitle").on("click",function(){
			$(this).parent().toggleClass("filter-open");
			createCookie('search-filter','close',0);
			if($(this).parent().hasClass("filter-open")){
				createCookie('search-filter','open',0);
			}
		});
	}
	
	//SITEMAP
	$(".sitemap-open-close").on('click',function(event){
		event.preventDefault();
		event.stopPropagation();
		if($(".siteMap .sitemap-header, .siteMap .sitemap-data").hasClass('sitemap-open')){
			$(".siteMap .sitemap-header, .siteMap .sitemap-data").removeClass('sitemap-open');
			$(".siteMap .sitemap-data").css({'max-height':0});
		}else {
			$(".siteMap .sitemap-header, .siteMap .sitemap-data").addClass('sitemap-open');
			$(".siteMap .sitemap-data").css({'max-height':9999});
		}
		return false;
	});

	$(".siteMap").addClass("siteMapJs");
	$(".siteMap .sitemap-header, .siteMap .sitemap-data").addClass('sitemap-open');
	$(".siteMap .sitemap-header").append('<i class="ico-toggle"></i>');
	$(".siteMap .sitemap-header").on('click',function(event){
		event.preventDefault();
		event.stopPropagation();
		if($(this).hasClass('sitemap-open')){
			$(this).removeClass('sitemap-open');
			$(this).next().removeClass('sitemap-open').css({'max-height':0});
		}else{
			$(this).addClass('sitemap-open');
			$(this).next().addClass('sitemap-open').css({'max-height':9999});
		}
		return false;	
	});

	//SIDE MENU
	$('.site-container').attr('id','content').addClass('snap-content');
	$('.side-nav-mobile').addClass('snap-drawers');
	$('.side-nav-mobile .worlwideMenu').addClass('snap-drawer snap-drawer-right');

	//Init toggle Lang
	$('.mobile-navigation-worldwide li').eq(1).on(onEvent,function(event){
		event.preventDefault();
		event.stopPropagation();
		$(this).toggleClass('open');
		if($(this).hasClass('open')){
			//menu
			if($(".mobile-navigation .btn-toggle-menu").hasClass('open')){
				$(".mobile-navigation .btn-toggle-menu").removeClass('open');
				$(".mobile-navigation .main-nav-mobile").removeClass('is-open');
			}
			//search
			if($('.mobile-navigation .btn-toggle-search').hasClass('open')){
				$('.mobile-navigation .btn-toggle-search').removeClass('open');
				$('.mobile-search').removeClass('mobile-search-open');
			}
		}
		$('.subNavlanguage').toggleClass('open');
		return false;
	});	
	
	//
	if(readCookie('mobile-search')=='open'){
		$(".mobile-navigation .btn-toggle-search").addClass('open');
		$('.mobile-search').addClass('mobile-search-open');
	}
	
	//Init toggle search
	$('.mobile-navigation .btn-toggle-search').on(onEvent,function(event){
		event.preventDefault();
		event.stopPropagation();
		$(this).toggleClass('open');
		createCookie('mobile-search','',0);
		
		if($(this).hasClass('open')){
			createCookie('mobile-search','open',0);
			//menu
			if($(".mobile-navigation .btn-toggle-menu").hasClass('open')){
				$(".mobile-navigation .btn-toggle-menu").removeClass('open');
				$(".mobile-navigation .main-nav-mobile").removeClass('is-open');
			}
			//Lang
			if($('.mobile-navigation-worldwide li').eq(1).hasClass('open')){
				$('.mobile-navigation-worldwide li').eq(1).removeClass('open');
				$('.subNavlanguage').removeClass('open')
			}
		}
		$('.mobile-search').toggleClass('mobile-search-open');
		return false;
	});	

	//TOGGLE MOBILE NAVIGATION 
	$(".mobile-navigation .btn-toggle-menu").on('click',ToggleMenuEvent);

	function ToggleMenuEvent(ev){
            ev.preventDefault();
		$(this).toggleClass('open');
		if($(this).hasClass('open')){
			//search
			if($('.mobile-navigation .btn-toggle-search').hasClass('open')){
				$('.mobile-navigation .btn-toggle-search').removeClass('open');
				$('.mobile-search').removeClass('mobile-search-open');
			}
			//Lang
			if($('.mobile-navigation-worldwide li').eq(1).hasClass('open')){
				$('.mobile-navigation-worldwide li').eq(1).removeClass('open');
				$('.subNavlanguage').removeClass('open')
			}
		}
		if(!$(".mobile-navigation .main-nav-mobile").hasClass('is-open')){
			//Init Nav
			var sitemap = $("#mainNav");
			var subNav = $('<ul></<ul>').addClass('main-nav-mobile');
		
			if(sitemap.find('li.current').length ==0 ){
				initMenu = sitemap;
				initMenuElts = initMenu.find('>li');
			}else{
				if(sitemap.find('li.current').parent().hasClass('mappingList')){
					var label = sitemap.find('li.current').parentsUntil('li.selected').last().parent().find('.btnNav').text();
					subNav.append('<li class="return"><a href="/" class="ico-menu-home"></a><span><i></i>'+label+'</span></li>');
					initMenu = sitemap.find('li.current').parentsUntil('li.selected').last().parent().find('.mappingList');
					initMenuElts = initMenu.find('> li');
				}else{
					var label = sitemap.find('li.current').parent().parent().find('>a').text();
					subNav.append('<li class="return"><a href="/" class="ico-menu-home"></a><span><i></i>'+label+'</span></li>');
					initMenu = sitemap.find('li.current').parent();
					initMenuElts = initMenu.find('> li');
				}	
			}
			menu = initMenu;
			
			initMenuElts.each(function(){
					//if($(this).find('>a span.btnHome').length > 0 || $(this).find('>a').length > 0){ //ERREUR dans les sous memnus -> display none sur tous les menus
					if($(this).find('>a span.btnHome').length > 0 ){
						var myLink = $(this).find('>a');
						subNav.append('<li style="display:none"><span><i></i><a href="'+myLink.attr('href')+'">'+myLink.text()+'</a></span></li>');	
					}
					else {
                                                if($(this).find('>i').attr("class")){
                                                    iclass =  $(this).find('>i').attr("class");
                                                }else{
                                                    iclass = "";
                                                }
						if($(this).find('>a').length > 0 ){
                                                        
							subNav.append('<li><i class="' + iclass + '"></i><a href="'+$(this).find('>a').attr("href")+'">'+$(this).find('>a').text()+'</a></li>');
						}else {
							subNav.append('<li><i class="' + iclass + '"></i>'+$(this).find('>span.btnNav').text()+'</li>');	
						}						
					}
					if($(this).find('ul').length > 0){
						subNav.find('>li:last-child').addClass('subnav');
					}
			});
			$('.mobile-navigation .main-nav-mobile').eq(0).remove();
			subNav.insertAfter($('.mobile-navigation .mobile-navigation-btn'));

			$(".mobile-navigation .main-nav-mobile").addClass('is-open')
		}else{
			$(".mobile-navigation .main-nav-mobile").removeClass('is-open');
		}
		$(this).parent().blur();
		$("#header").focus();		
	}
	
	//NAVIGATION IN SUBNAV
	var menuMobile = $("#mainNav");
	var menu = $("#mainNav");
	$('.mobile-navigation').delegate(".main-nav-mobile li", onEvent, function(ev){
	ev.preventDefault();
	ev.stopPropagation();
	if($(ev.target).hasClass('ico-menu-home')){location.href = $(ev.target).attr('href'); return false;}
	if(ev.target.tagName.toLowerCase() == "span" && $(ev.target).parent()[0].tagName.toLowerCase() == "a" ){location.href = $(ev.target).parent().attr('href'); return false;}
	if(ev.target.tagName.toLowerCase() == "a" ){location.href = $(ev.target).attr('href'); return false;}
	if($(this).hasClass('subnav')){
		self = this; 
		var delayMenu;
		if($(".mobile-navigation-btn i").offset().top < 0 ){
			delayMenu = 400;
			$('#content').animate({scrollTop:52,scrollLeft: 0},400);
		}else {
			delayMenu = 0;	
		}
		
		function buildMenu(obj){
			 var indexSubNav = $('.mobile-navigation .main-nav-mobile > li:not(.return)').index($(obj));
			 var newMenu = menu.find('>li').eq(indexSubNav);
			 var label = $(obj).text();
			 if(newMenu.children('div.subNav').length > 0){
				 menu = newMenu.find('ul.mappingList');
			 }else {
				 menu = newMenu.find('> ul');
			 }
			 var subNav = $('<ul></ul>').addClass('main-nav-mobile mobile-navigation-from-right');
			 subNav.append('<li class="return"><a href="/" class="ico-menu-home"></a><span><i></i>'+label+'</span></li>');
			 menu.find('>li').each(function(){
					if($(this).find('ul').length > 0){
						subNav.append('<li class="subnav"><span><i></i>'+$(this).find('>a').text()+'</span></li>');
					}else {
						var myLink = $(this).find('>a');
						subNav.append('<li><span><i></i><a href="'+myLink.attr('href')+'">'+myLink.html()+'</a></span></li>');	
					}
			 });
		 
			 var menuAdd = subNav.insertAfter($('.mobile-navigation .mobile-navigation-btn'));
			 var menuRemove = $('.mobile-navigation .main-nav-mobile.is-open').eq(0);
			 subNav.addClass('is-open').addClass('submenu-transition-in');
			 menuRemove.addClass('submenu-transition-out');
			 		 
			 var removeMenu = (function(m,n){
					var t = m;
					var u = n;
					return function(){
						t.remove();
						u.removeClass('mobile-navigation-from-right submenu-transition-in');
					}
			 })(menuRemove,subNav);
			 window.setTimeout(removeMenu,300);
			 ///return false;			
		}
		var test = $.proxy(buildMenu,{},self);
		window.setTimeout(test,delayMenu);
		///return false;
	 
	}else{
		if($(this).hasClass('return')){
			var sitemap = $("#mainNav");
			var subNav = $('<ul></<ul>').addClass('main-nav-mobile');
			if(menu.parent().parent().hasClass('linksList')){
				newMenu = menu.parent().parent();
				var label = newMenu.parent().find('>a').text();
				subNav.append('<li class="return"><a href="/" class="ico-menu-home"></a><span><i></i>'+label+'</span></li>');
			}
			if(menu.parent().parent().hasClass('mappingList')){
				newMenu = menu.parentsUntil('.subNav','.subNavContent').find('.mappingList');
				var label = newMenu.parentsUntil('#mainNav').last().find('.btnNav').text();
				subNav.append('<li class="return"><a href="/" class="ico-menu-home"></a><span><i></i>'+label+'</span></li>');
			}
			if(menu.parent().parent().hasClass('subNavContent')){
				newMenu = sitemap;
			}
			menu = newMenu;
			newMenuElts = newMenu.find('>li');
			
			newMenuElts.each(function(){
				if($(this).find('>a span.btnHome').length > 0){
					var myLink = $(this).find('>a');
					subNav.append('<li style="display:none"><span><i></i><a href="'+myLink.attr('href')+'">'+myLink.text()+'</a></span></li>');	
				}else{
					if($(this).find('ul').length > 0){
						subNav.append('<li><i></i>'+$(this).find('>a, >span.btnNav').text()+'</li>');
						subNav.find('>li:last-child').addClass('subnav');
					}else {
						if($(this).find('>a').length > 0){
							var myLink = $(this).find('>a');
							subNav.append('<li><span><i></i><a href="'+myLink.attr('href')+'">'+myLink.text()+'</a></span></li>');	
						}	
					}
					
					/*
					if($(this).find('>a').length > 0){
						var myLink = $(this).find('>a');
						subNav.append('<li><span><i></i><a href="'+myLink.attr('href')+'">'+myLink.text()+'</a></span></li>');	
					}
					else {
						subNav.append('<li><i></i>'+$(this).find('>a, >span.btnNav').text()+'</li>');
					}*/
										
				}
			});
			//END INIT SUBMENU
		
		 var menuRemove = $('.mobile-navigation .main-nav-mobile').eq(0).addClass('mobile-navigation-out-right');
		 subNav.insertAfter($('.mobile-navigation .mobile-navigation-btn')).addClass('mobile-navigation-from-left is-open');
		 var removeMenu = (function(m){
				var t = m;
				return function(){
					t.remove();
					$('.mobile-navigation .main-nav-mobile').eq(0).removeClass('mobile-navigation-from-left');
				}
			})(menuRemove);
		 window.setTimeout(removeMenu,310);
		 
 		///return false;				
		}	
	}
	return false;
});	
	
//Return nav

var snapper = new Snap({
    element: document.getElementById('content'),
		touchToDrag: false,
		addBodyClasses: true,
		disable: "left"
});
var addEvent = function addEvent(element, eventName, func) {
	if (element) {
		if (element.addEventListener) {
			return element.addEventListener(eventName, func, false);
		} else if (element.attachEvent) {
			return element.attachEvent("on" + eventName, func);
		}
	}
}; 
addEvent(document.getElementById('side-nav-mobile'), onEvent, function(event){ event.preventDefault(); event.stopPropagation(); snapper.open('right'); }); 

//var ua = navigator.userAgent;
if( ua.indexOf("android") >= 0)
{
	$("body").addClass('androidfix');
	var match = ua.match(/android\s([0-9\.]*)/);
  var androidversion = match[1]; 

  if (version_compare(androidversion,"2.4","<"))
  {
      // FIXING Android 2.3
			$("html").css('overflow','auto');
			$("body").css({overflow:'auto', height:'auto'});
			$("#content").css('overflow','visible');
			$("#content").css('position','relative');
			$("#content").css('bottom','auto');
			$("#content").css('display','block');
			$("body").css('background-color','#3095B4');
			$(".snap-drawer-right").css('border-left','1px solid #FFFFFF');
			$(".snap-drawer-right").css('overflow','visible');
			// fixing select
			// see: http://wil.to/android-positioning/fixed.html
			$("#snap-scene select").on("click", function(){
					//alert("Select clicked");
					$("#snap-scene").css('position','relative');
					return false;
      });
			//
			$("#snap-scene select").on("blur", function(){
					//alert("Select clicked");
					$("#snap-scene").css('position','absolute');
					return false;
      });
  }
}

/*FILTER*/

$(".rflex .filter-container .filter-header").prepend('<i></i>');
if($(".mobile-navigation").css('display')=="block" && readCookie('search-filter')==null) {
	$(".rflex .filter-container").toggleClass('filter-container-closed');
}
$(".rflex .filter-container .filter-header").on("click",function(){
	var transitionName = Modernizr.prefixed('transition');
	var style = {};
	var toggleBox = $(this).parent();
	var toggleBoxBody = toggleBox.find('.filter-body');
	style[transitionName] = "";
	style["maxHeight"] = toggleBoxBody.height();
	toggleBoxBody.css(style);
	if (toggleBox.hasClass("filter-container-closed")){
		style[transitionName] = "1s linear max-height";
		style["maxHeight"] = 1000;
		toggleBoxBody.css(style);
		createCookie('search-filter','open',0);
	}else{
		style[transitionName] = toggleBoxBody.height()/1000+"s linear max-height";
		style["maxHeight"] = 0;
		toggleBoxBody.css(style);
		createCookie('search-filter','close',0);
	}
	toggleBox.toggleClass('filter-container-closed');
});
if(readCookie('search-filter')){
	if(readCookie('search-filter')!='open'){
		$(".rflex .filter-container").toggleClass('filter-container-closed');
	}
}


/*lightbox*/
var lightBoxTouchStartX,lightBoxTouchStartY;
$("body").delegate("#lightbox-container-image-box","touchstart",function(e){
	var orig = e.originalEvent;
	var touchPoints = (typeof orig.changedTouches != 'undefined') ? orig.changedTouches : [orig]; /*IE FIX*/
	// record the starting touch x, y coordinates
	lightBoxTouchStartX = touchPoints[0].pageX;
	lightBoxTouchStartY = touchPoints[0].pageY;
});
$("body").delegate("#lightbox-container-image-box","touchmove",function(e){});
$("body").delegate("#lightbox-container-image-box","touchend",function(e){
	var orig = e.originalEvent;
	var touchPoints = (typeof orig.changedTouches != 'undefined') ? orig.changedTouches : [orig]; /*IE FIX*/
	// record the starting touch x, y coordinates
	endTouchX = touchPoints[0].pageX;
	endTouchY = touchPoints[0].pageY;
	//console.log((lightBoxTouchStartX-endTouchX) + " / " +(lightBoxTouchStartY-endTouchY));
	if(lightBoxTouchStartX-endTouchX < -50){
		$("#lightbox-nav #lightbox-nav-btnPrev").click();
	}else {
		if(lightBoxTouchStartX-endTouchX > 50){
			$("#lightbox-nav #lightbox-nav-btnNext").click();
		}	
	}
});
	
});//End Ready


eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('7(A 3c.3q!=="9"){3c.3q=9(e){9 t(){}t.5S=e;p 5R t}}(9(e,t,n){h r={1N:9(t,n){h r=c;r.$k=e(n);r.6=e.4M({},e.37.2B.6,r.$k.v(),t);r.2A=t;r.4L()},4L:9(){9 r(e){h n,r="";7(A t.6.33==="9"){t.6.33.R(c,[e])}l{1A(n 38 e.d){7(e.d.5M(n)){r+=e.d[n].1K}}t.$k.2y(r)}t.3t()}h t=c,n;7(A t.6.2H==="9"){t.6.2H.R(c,[t.$k])}7(A t.6.2O==="2Y"){n=t.6.2O;e.5K(n,r)}l{t.3t()}},3t:9(){h e=c;e.$k.v("d-4I",e.$k.2x("2w")).v("d-4F",e.$k.2x("H"));e.$k.z({2u:0});e.2t=e.6.q;e.4E();e.5v=0;e.1X=14;e.23()},23:9(){h e=c;7(e.$k.25().N===0){p b}e.1M();e.4C();e.$S=e.$k.25();e.E=e.$S.N;e.4B();e.$G=e.$k.17(".d-1K");e.$K=e.$k.17(".d-1p");e.3u="U";e.13=0;e.26=[0];e.m=0;e.4A();e.4z()},4z:9(){h e=c;e.2V();e.2W();e.4t();e.30();e.4r();e.4q();e.2p();e.4o();7(e.6.2o!==b){e.4n(e.6.2o)}7(e.6.O===j){e.6.O=4Q}e.19();e.$k.17(".d-1p").z("4i","4h");7(!e.$k.2m(":3n")){e.3o()}l{e.$k.z("2u",1)}e.5O=b;e.2l();7(A e.6.3s==="9"){e.6.3s.R(c,[e.$k])}},2l:9(){h e=c;7(e.6.1Z===j){e.1Z()}7(e.6.1B===j){e.1B()}e.4g();7(A e.6.3w==="9"){e.6.3w.R(c,[e.$k])}},3x:9(){h e=c;7(A e.6.3B==="9"){e.6.3B.R(c,[e.$k])}e.3o();e.2V();e.2W();e.4f();e.30();e.2l();7(A e.6.3D==="9"){e.6.3D.R(c,[e.$k])}},3F:9(){h e=c;t.1c(9(){e.3x()},0)},3o:9(){h e=c;7(e.$k.2m(":3n")===b){e.$k.z({2u:0});t.18(e.1C);t.18(e.1X)}l{p b}e.1X=t.4d(9(){7(e.$k.2m(":3n")){e.3F();e.$k.4b({2u:1},2M);t.18(e.1X)}},5x)},4B:9(){h e=c;e.$S.5n(\'<L H="d-1p">\').4a(\'<L H="d-1K"></L>\');e.$k.17(".d-1p").4a(\'<L H="d-1p-49">\');e.1H=e.$k.17(".d-1p-49");e.$k.z("4i","4h")},1M:9(){h e=c,t=e.$k.1I(e.6.1M),n=e.$k.1I(e.6.2i);7(!t){e.$k.I(e.6.1M)}7(!n){e.$k.I(e.6.2i)}},2V:9(){h t=c,n,r;7(t.6.2Z===b){p b}7(t.6.48===j){t.6.q=t.2t=1;t.6.1h=b;t.6.1s=b;t.6.1O=b;t.6.22=b;t.6.1Q=b;t.6.1R=b;p b}n=e(t.6.47).1f();7(n>(t.6.1s[0]||t.2t)){t.6.q=t.2t}7(t.6.1h!==b){t.6.1h.5g(9(e,t){p e[0]-t[0]});1A(r=0;r<t.6.1h.N;r+=1){7(t.6.1h[r][0]<=n){t.6.q=t.6.1h[r][1]}}}l{7(n<=t.6.1s[0]&&t.6.1s!==b){t.6.q=t.6.1s[1]}7(n<=t.6.1O[0]&&t.6.1O!==b){t.6.q=t.6.1O[1]}7(n<=t.6.22[0]&&t.6.22!==b){t.6.q=t.6.22[1]}7(n<=t.6.1Q[0]&&t.6.1Q!==b){t.6.q=t.6.1Q[1]}7(n<=t.6.1R[0]&&t.6.1R!==b){t.6.q=t.6.1R[1]}}7(t.6.q>t.E&&t.6.46===j){t.6.q=t.E}},4r:9(){h n=c,r,i;7(n.6.2Z!==j){p b}i=e(t).1f();n.3d=9(){7(e(t).1f()!==i){7(n.6.O!==b){t.18(n.1C)}t.5d(r);r=t.1c(9(){i=e(t).1f();n.3x()},n.6.45)}};e(t).44(n.3d)},4f:9(){h e=c;e.2g(e.m);7(e.6.O!==b){e.3j()}},43:9(){h t=c,n=0,r=t.E-t.6.q;t.$G.2f(9(i){h s=e(c);s.z({1f:t.M}).v("d-1K",3p(i));7(i%t.6.q===0||i===r){7(!(i>r)){n+=1}}s.v("d-24",n)})},42:9(){h e=c,t=e.$G.N*e.M;e.$K.z({1f:t*2,T:0});e.43()},2W:9(){h e=c;e.40();e.42();e.3Z();e.3v()},40:9(){h e=c;e.M=1F.4O(e.$k.1f()/e.6.q)},3v:9(){h e=c,t=(e.E*e.M-e.6.q*e.M)*-1;7(e.6.q>e.E){e.D=0;t=0;e.3z=0}l{e.D=e.E-e.6.q;e.3z=t}p t},3Y:9(){p 0},3Z:9(){h t=c,n=0,r=0,i,s,o;t.J=[0];t.3E=[];1A(i=0;i<t.E;i+=1){r+=t.M;t.J.2D(-r);7(t.6.12===j){s=e(t.$G[i]);o=s.v("d-24");7(o!==n){t.3E[n]=t.J[i];n=o}}}},4t:9(){h t=c;7(t.6.2a===j||t.6.1v===j){t.B=e(\'<L H="d-5A"/>\').5m("5l",!t.F.15).5c(t.$k)}7(t.6.1v===j){t.3T()}7(t.6.2a===j){t.3S()}},3S:9(){h t=c,n=e(\'<L H="d-4U"/>\');t.B.1o(n);t.1u=e("<L/>",{"H":"d-1n",2y:t.6.2U[0]||""});t.1q=e("<L/>",{"H":"d-U",2y:t.6.2U[1]||""});n.1o(t.1u).1o(t.1q);n.w("2X.B 21.B",\'L[H^="d"]\',9(e){e.1l()});n.w("2n.B 28.B",\'L[H^="d"]\',9(n){n.1l();7(e(c).1I("d-U")){t.U()}l{t.1n()}})},3T:9(){h t=c;t.1k=e(\'<L H="d-1v"/>\');t.B.1o(t.1k);t.1k.w("2n.B 28.B",".d-1j",9(n){n.1l();7(3p(e(c).v("d-1j"))!==t.m){t.1g(3p(e(c).v("d-1j")),j)}})},3P:9(){h t=c,n,r,i,s,o,u;7(t.6.1v===b){p b}t.1k.2y("");n=0;r=t.E-t.E%t.6.q;1A(s=0;s<t.E;s+=1){7(s%t.6.q===0){n+=1;7(r===s){i=t.E-t.6.q}o=e("<L/>",{"H":"d-1j"});u=e("<3N></3N>",{4R:t.6.39===j?n:"","H":t.6.39===j?"d-59":""});o.1o(u);o.v("d-1j",r===s?i:s);o.v("d-24",n);t.1k.1o(o)}}t.35()},35:9(){h t=c;7(t.6.1v===b){p b}t.1k.17(".d-1j").2f(9(){7(e(c).v("d-24")===e(t.$G[t.m]).v("d-24")){t.1k.17(".d-1j").Z("2d");e(c).I("2d")}})},3e:9(){h e=c;7(e.6.2a===b){p b}7(e.6.2e===b){7(e.m===0&&e.D===0){e.1u.I("1b");e.1q.I("1b")}l 7(e.m===0&&e.D!==0){e.1u.I("1b");e.1q.Z("1b")}l 7(e.m===e.D){e.1u.Z("1b");e.1q.I("1b")}l 7(e.m!==0&&e.m!==e.D){e.1u.Z("1b");e.1q.Z("1b")}}},30:9(){h e=c;e.3P();e.3e();7(e.B){7(e.6.q>=e.E){e.B.3K()}l{e.B.3J()}}},55:9(){h e=c;7(e.B){e.B.3k()}},U:9(e){h t=c;7(t.1E){p b}t.m+=t.6.12===j?t.6.q:1;7(t.m>t.D+(t.6.12===j?t.6.q-1:0)){7(t.6.2e===j){t.m=0;e="2k"}l{t.m=t.D;p b}}t.1g(t.m,e)},1n:9(e){h t=c;7(t.1E){p b}7(t.6.12===j&&t.m>0&&t.m<t.6.q){t.m=0}l{t.m-=t.6.12===j?t.6.q:1}7(t.m<0){7(t.6.2e===j){t.m=t.D;e="2k"}l{t.m=0;p b}}t.1g(t.m,e)},1g:9(e,n,r){h i=c,s;7(i.1E){p b}7(A i.6.1Y==="9"){i.6.1Y.R(c,[i.$k])}7(e>=i.D){e=i.D}l 7(e<=0){e=0}i.m=i.d.m=e;7(i.6.2o!==b&&r!=="4e"&&i.6.q===1&&i.F.1x===j){i.1t(0);7(i.F.1x===j){i.1L(i.J[e])}l{i.1r(i.J[e],1)}i.2r();i.4l();p b}s=i.J[e];7(i.F.1x===j){i.1T=b;7(n===j){i.1t("1w");t.1c(9(){i.1T=j},i.6.1w)}l 7(n==="2k"){i.1t(i.6.2v);t.1c(9(){i.1T=j},i.6.2v)}l{i.1t("1m");t.1c(9(){i.1T=j},i.6.1m)}i.1L(s)}l{7(n===j){i.1r(s,i.6.1w)}l 7(n==="2k"){i.1r(s,i.6.2v)}l{i.1r(s,i.6.1m)}}i.2r()},2g:9(e){h t=c;7(A t.6.1Y==="9"){t.6.1Y.R(c,[t.$k])}7(e>=t.D||e===-1){e=t.D}l 7(e<=0){e=0}t.1t(0);7(t.F.1x===j){t.1L(t.J[e])}l{t.1r(t.J[e],1)}t.m=t.d.m=e;t.2r()},2r:9(){h e=c;e.26.2D(e.m);e.13=e.d.13=e.26[e.26.N-2];e.26.5f(0);7(e.13!==e.m){e.35();e.3e();e.2l();7(e.6.O!==b){e.3j()}}7(A e.6.3y==="9"&&e.13!==e.m){e.6.3y.R(c,[e.$k])}},X:9(){h e=c;e.3A="X";t.18(e.1C)},3j:9(){h e=c;7(e.3A!=="X"){e.19()}},19:9(){h e=c;e.3A="19";7(e.6.O===b){p b}t.18(e.1C);e.1C=t.4d(9(){e.U(j)},e.6.O)},1t:9(e){h t=c;7(e==="1m"){t.$K.z(t.2z(t.6.1m))}l 7(e==="1w"){t.$K.z(t.2z(t.6.1w))}l 7(A e!=="2Y"){t.$K.z(t.2z(e))}},2z:9(e){p{"-1G-1a":"2C "+e+"1z 2s","-1W-1a":"2C "+e+"1z 2s","-o-1a":"2C "+e+"1z 2s",1a:"2C "+e+"1z 2s"}},3H:9(){p{"-1G-1a":"","-1W-1a":"","-o-1a":"",1a:""}},3I:9(e){p{"-1G-P":"1i("+e+"V, C, C)","-1W-P":"1i("+e+"V, C, C)","-o-P":"1i("+e+"V, C, C)","-1z-P":"1i("+e+"V, C, C)",P:"1i("+e+"V, C,C)"}},1L:9(e){h t=c;t.$K.z(t.3I(e))},3L:9(e){h t=c;t.$K.z({T:e})},1r:9(e,t){h n=c;n.29=b;n.$K.X(j,j).4b({T:e},{54:t||n.6.1m,3M:9(){n.29=j}})},4E:9(){h e=c,r="1i(C, C, C)",i=n.56("L"),s,o,u,a;i.2w.3O="  -1W-P:"+r+"; -1z-P:"+r+"; -o-P:"+r+"; -1G-P:"+r+"; P:"+r;s=/1i\\(C, C, C\\)/g;o=i.2w.3O.5i(s);u=o!==14&&o.N===1;a="5z"38 t||t.5Q.4P;e.F={1x:u,15:a}},4q:9(){h e=c;7(e.6.27!==b||e.6.1U!==b){e.3Q();e.3R()}},4C:9(){h e=c,t=["s","e","x"];e.16={};7(e.6.27===j&&e.6.1U===j){t=["2X.d 21.d","2N.d 3U.d","2n.d 3V.d 28.d"]}l 7(e.6.27===b&&e.6.1U===j){t=["2X.d","2N.d","2n.d 3V.d"]}l 7(e.6.27===j&&e.6.1U===b){t=["21.d","3U.d","28.d"]}e.16.3W=t[0];e.16.2K=t[1];e.16.2J=t[2]},3R:9(){h t=c;t.$k.w("5y.d",9(e){e.1l()});t.$k.w("21.3X",9(t){p e(t.1d).2m("5C, 5E, 5F, 5N")})},3Q:9(){9 s(e){7(e.2b!==W){p{x:e.2b[0].2c,y:e.2b[0].41}}7(e.2b===W){7(e.2c!==W){p{x:e.2c,y:e.41}}7(e.2c===W){p{x:e.52,y:e.53}}}}9 o(t){7(t==="w"){e(n).w(r.16.2K,a);e(n).w(r.16.2J,f)}l 7(t==="Q"){e(n).Q(r.16.2K);e(n).Q(r.16.2J)}}9 u(n){h u=n.3h||n||t.3g,a;7(u.5a===3){p b}7(r.E<=r.6.q){p}7(r.29===b&&!r.6.3f){p b}7(r.1T===b&&!r.6.3f){p b}7(r.6.O!==b){t.18(r.1C)}7(r.F.15!==j&&!r.$K.1I("3b")){r.$K.I("3b")}r.11=0;r.Y=0;e(c).z(r.3H());a=e(c).2h();i.2S=a.T;i.2R=s(u).x-a.T;i.2P=s(u).y-a.5o;o("w");i.2j=b;i.2L=u.1d||u.4c}9 a(o){h u=o.3h||o||t.3g,a,f;r.11=s(u).x-i.2R;r.2I=s(u).y-i.2P;r.Y=r.11-i.2S;7(A r.6.2E==="9"&&i.3C!==j&&r.Y!==0){i.3C=j;r.6.2E.R(r,[r.$k])}7((r.Y>8||r.Y<-8)&&r.F.15===j){7(u.1l!==W){u.1l()}l{u.5L=b}i.2j=j}7((r.2I>10||r.2I<-10)&&i.2j===b){e(n).Q("2N.d")}a=9(){p r.Y/5};f=9(){p r.3z+r.Y/5};r.11=1F.3v(1F.3Y(r.11,a()),f());7(r.F.1x===j){r.1L(r.11)}l{r.3L(r.11)}}9 f(n){h s=n.3h||n||t.3g,u,a,f;s.1d=s.1d||s.4c;i.3C=b;7(r.F.15!==j){r.$K.Z("3b")}7(r.Y<0){r.1y=r.d.1y="T"}l{r.1y=r.d.1y="3i"}7(r.Y!==0){u=r.4j();r.1g(u,b,"4e");7(i.2L===s.1d&&r.F.15!==j){e(s.1d).w("3a.4k",9(t){t.4S();t.4T();t.1l();e(t.1d).Q("3a.4k")});a=e.4N(s.1d,"4V").3a;f=a.4W();a.4X(0,0,f)}}o("Q")}h r=c,i={2R:0,2P:0,4Y:0,2S:0,2h:14,4Z:14,50:14,2j:14,51:14,2L:14};r.29=j;r.$k.w(r.16.3W,".d-1p",u)},4j:9(){h e=c,t=e.4m();7(t>e.D){e.m=e.D;t=e.D}l 7(e.11>=0){t=0;e.m=0}p t},4m:9(){h t=c,n=t.6.12===j?t.3E:t.J,r=t.11,i=14;e.2f(n,9(s,o){7(r-t.M/20>n[s+1]&&r-t.M/20<o&&t.34()==="T"){i=o;7(t.6.12===j){t.m=e.4p(i,t.J)}l{t.m=s}}l 7(r+t.M/20<o&&r+t.M/20>(n[s+1]||n[s]-t.M)&&t.34()==="3i"){7(t.6.12===j){i=n[s+1]||n[n.N-1];t.m=e.4p(i,t.J)}l{i=n[s+1];t.m=s+1}}});p t.m},34:9(){h e=c,t;7(e.Y<0){t="3i";e.3u="U"}l{t="T";e.3u="1n"}p t},4A:9(){h e=c;e.$k.w("d.U",9(){e.U()});e.$k.w("d.1n",9(){e.1n()});e.$k.w("d.19",9(t,n){e.6.O=n;e.19();e.32="19"});e.$k.w("d.X",9(){e.X();e.32="X"});e.$k.w("d.1g",9(t,n){e.1g(n)});e.$k.w("d.2g",9(t,n){e.2g(n)})},2p:9(){h e=c;7(e.6.2p===j&&e.F.15!==j&&e.6.O!==b){e.$k.w("57",9(){e.X()});e.$k.w("58",9(){7(e.32!=="X"){e.19()}})}},1Z:9(){h t=c,n,r,i,s,o;7(t.6.1Z===b){p b}1A(n=0;n<t.E;n+=1){r=e(t.$G[n]);7(r.v("d-1e")==="1e"){4s}i=r.v("d-1K");s=r.17(".5b");7(A s.v("1J")!=="2Y"){r.v("d-1e","1e");4s}7(r.v("d-1e")===W){s.3K();r.I("4u").v("d-1e","5e")}7(t.6.4v===j){o=i>=t.m}l{o=j}7(o&&i<t.m+t.6.q&&s.N){t.4w(r,s)}}},4w:9(e,n){9 o(){e.v("d-1e","1e").Z("4u");n.5h("v-1J");7(r.6.4x==="4y"){n.5j(5k)}l{n.3J()}7(A r.6.2T==="9"){r.6.2T.R(c,[r.$k])}}9 u(){i+=1;7(r.2Q(n.3l(0))||s===j){o()}l 7(i<=2q){t.1c(u,2q)}l{o()}}h r=c,i=0,s;7(n.5p("5q")==="5r"){n.z("5s-5t","5u("+n.v("1J")+")");s=j}l{n[0].1J=n.v("1J")}u()},1B:9(){9 s(){h r=e(n.$G[n.m]).2G();n.1H.z("2G",r+"V");7(!n.1H.1I("1B")){t.1c(9(){n.1H.I("1B")},0)}}9 o(){i+=1;7(n.2Q(r.3l(0))){s()}l 7(i<=2q){t.1c(o,2q)}l{n.1H.z("2G","")}}h n=c,r=e(n.$G[n.m]).17("5w"),i;7(r.3l(0)!==W){i=0;o()}l{s()}},2Q:9(e){h t;7(!e.3M){p b}t=A e.4D;7(t!=="W"&&e.4D===0){p b}p j},4g:9(){h t=c,n;7(t.6.2F===j){t.$G.Z("2d")}t.1D=[];1A(n=t.m;n<t.m+t.6.q;n+=1){t.1D.2D(n);7(t.6.2F===j){e(t.$G[n]).I("2d")}}t.d.1D=t.1D},4n:9(e){h t=c;t.4G="d-"+e+"-5B";t.4H="d-"+e+"-38"},4l:9(){9 a(e){p{2h:"5D",T:e+"V"}}h e=c,t=e.4G,n=e.4H,r=e.$G.1S(e.m),i=e.$G.1S(e.13),s=1F.4J(e.J[e.m])+e.J[e.13],o=1F.4J(e.J[e.m])+e.M/2,u="5G 5H 5I 5J";e.1E=j;e.$K.I("d-1P").z({"-1G-P-1P":o+"V","-1W-4K-1P":o+"V","4K-1P":o+"V"});i.z(a(s,10)).I(t).w(u,9(){e.3m=j;i.Q(u);e.31(i,t)});r.I(n).w(u,9(){e.36=j;r.Q(u);e.31(r,n)})},31:9(e,t){h n=c;e.z({2h:"",T:""}).Z(t);7(n.3m&&n.36){n.$K.Z("d-1P");n.3m=b;n.36=b;n.1E=b}},4o:9(){h e=c;e.d={2A:e.2A,5P:e.$k,S:e.$S,G:e.$G,m:e.m,13:e.13,1D:e.1D,15:e.F.15,F:e.F,1y:e.1y}},3G:9(){h r=c;r.$k.Q(".d d 21.3X");e(n).Q(".d d");e(t).Q("44",r.3d)},1V:9(){h e=c;7(e.$k.25().N!==0){e.$K.3r();e.$S.3r().3r();7(e.B){e.B.3k()}}e.3G();e.$k.2x("2w",e.$k.v("d-4I")||"").2x("H",e.$k.v("d-4F"))},5T:9(){h e=c;e.X();t.18(e.1X);e.1V();e.$k.5U()},5V:9(t){h n=c,r=e.4M({},n.2A,t);n.1V();n.1N(r,n.$k)},5W:9(e,t){h n=c,r;7(!e){p b}7(n.$k.25().N===0){n.$k.1o(e);n.23();p b}n.1V();7(t===W||t===-1){r=-1}l{r=t}7(r>=n.$S.N||r===-1){n.$S.1S(-1).5X(e)}l{n.$S.1S(r).5Y(e)}n.23()},5Z:9(e){h t=c,n;7(t.$k.25().N===0){p b}7(e===W||e===-1){n=-1}l{n=e}t.1V();t.$S.1S(n).3k();t.23()}};e.37.2B=9(t){p c.2f(9(){7(e(c).v("d-1N")===j){p b}e(c).v("d-1N",j);h n=3c.3q(r);n.1N(t,c);e.v(c,"2B",n)})};e.37.2B.6={q:5,1h:b,1s:[60,4],1O:[61,3],22:[62,2],1Q:b,1R:[63,1],48:b,46:b,1m:2M,1w:64,2v:65,O:b,2p:b,2a:b,2U:["1n","U"],2e:j,12:b,1v:j,39:b,2Z:j,45:2M,47:t,1M:"d-66",2i:"d-2i",1Z:b,4v:j,4x:"4y",1B:b,2O:b,33:b,3f:j,27:j,1U:j,2F:b,2o:b,3B:b,3D:b,2H:b,3s:b,1Y:b,3y:b,3w:b,2E:b,2T:b}})(67,68,69)',62,382,'||||||options|if||function||false|this|owl||||var||true|elem|else|currentItem|||return|items|||||data|on|||css|typeof|owlControls|0px|maximumItem|itemsAmount|browser|owlItems|class|addClass|positionsInArray|owlWrapper|div|itemWidth|length|autoPlay|transform|off|apply|userItems|left|next|px|undefined|stop|newRelativeX|removeClass||newPosX|scrollPerPage|prevItem|null|isTouch|ev_types|find|clearInterval|play|transition|disabled|setTimeout|target|loaded|width|goTo|itemsCustom|translate3d|page|paginationWrapper|preventDefault|slideSpeed|prev|append|wrapper|buttonNext|css2slide|itemsDesktop|swapSpeed|buttonPrev|pagination|paginationSpeed|support3d|dragDirection|ms|for|autoHeight|autoPlayInterval|visibleItems|isTransition|Math|webkit|wrapperOuter|hasClass|src|item|transition3d|baseClass|init|itemsDesktopSmall|origin|itemsTabletSmall|itemsMobile|eq|isCss3Finish|touchDrag|unWrap|moz|checkVisible|beforeMove|lazyLoad||mousedown|itemsTablet|setVars|roundPages|children|prevArr|mouseDrag|mouseup|isCssFinish|navigation|touches|pageX|active|rewindNav|each|jumpTo|position|theme|sliding|rewind|eachMoveUpdate|is|touchend|transitionStyle|stopOnHover|100|afterGo|ease|orignalItems|opacity|rewindSpeed|style|attr|html|addCssSpeed|userOptions|owlCarousel|all|push|startDragging|addClassActive|height|beforeInit|newPosY|end|move|targetElement|200|touchmove|jsonPath|offsetY|completeImg|offsetX|relativePos|afterLazyLoad|navigationText|updateItems|calculateAll|touchstart|string|responsive|updateControls|clearTransStyle|hoverStatus|jsonSuccess|moveDirection|checkPagination|endCurrent|fn|in|paginationNumbers|click|grabbing|Object|resizer|checkNavigation|dragBeforeAnimFinish|event|originalEvent|right|checkAp|remove|get|endPrev|visible|watchVisibility|Number|create|unwrap|afterInit|logIn|playDirection|max|afterAction|updateVars|afterMove|maximumPixels|apStatus|beforeUpdate|dragging|afterUpdate|pagesInArray|reload|clearEvents|removeTransition|doTranslate|show|hide|css2move|complete|span|cssText|updatePagination|gestures|disabledEvents|buildButtons|buildPagination|mousemove|touchcancel|start|disableTextSelect|min|loops|calculateWidth|pageY|appendWrapperSizes|appendItemsSizes|resize|responsiveRefreshRate|itemsScaleUp|responsiveBaseWidth|singleItem|outer|wrap|animate|srcElement|setInterval|drag|updatePosition|onVisibleItems|block|display|getNewPosition|disable|singleItemTransition|closestItem|transitionTypes|owlStatus|inArray|moveEvents|response|continue|buildControls|loading|lazyFollow|lazyPreload|lazyEffect|fade|onStartup|customEvents|wrapItems|eventTypes|naturalWidth|checkBrowser|originalClasses|outClass|inClass|originalStyles|abs|perspective|loadContent|extend|_data|round|msMaxTouchPoints|5e3|text|stopImmediatePropagation|stopPropagation|buttons|events|pop|splice|baseElWidth|minSwipe|maxSwipe|dargging|clientX|clientY|duration|destroyControls|createElement|mouseover|mouseout|numbers|which|lazyOwl|appendTo|clearTimeout|checked|shift|sort|removeAttr|match|fadeIn|400|clickable|toggleClass|wrapAll|top|prop|tagName|DIV|background|image|url|wrapperWidth|img|500|dragstart|ontouchstart|controls|out|input|relative|textarea|select|webkitAnimationEnd|oAnimationEnd|MSAnimationEnd|animationend|getJSON|returnValue|hasOwnProperty|option|onstartup|baseElement|navigator|new|prototype|destroy|removeData|reinit|addItem|after|before|removeItem|1199|979|768|479|800|1e3|carousel|jQuery|window|document'.split('|'),0,{}))

//main js
eGauss = {

	load: function(){
		$.support.cors = true;
		this.setWidgets();
		this.setRolloverTabs();
		this.setLinkList();
		this.setAccordions();
		this.setVideoDetailsPlayer();
		this.setHeightVideo();
		this.setPopupVideo();
		this.setPopupFlash();
		this.setStructureSlideshow();
		this.setFlashDiaporama();
		this.setVideoCoverflow();
		//this.setLightbox();
		this.setFancyBox();
		this.setSearchBoxBehavior();
		this.setTools();
		this.setDownloadForm();
		this.setCoverflowCorp();
		this.setCoverflow();
		this.setHomeJobSearch();
		this.setTwitter();
		this.setAutoStock();
		this.removeImgAttributes();
                this.searchMobileSwitchEngine();
                this.iframeSetWidth();
	},
	iframeSetWidth: function(){
            $('iframe').css('width','100%');
        },
        searchMobileSwitchEngine: function() {
            if($(".mobile-search .searchMobileSwitchEngine").length > 1){
                $(".mobile-search .searchMobileSwitchEngine").bind("click", function() {
                    var searchEngine = $(this).attr("id");
                    $(".mobile-search .formSearchEngine").hide();
                    $(".mobile-search ." + searchEngine + "").show();
                
                });
                if(typeof isRflexPage != 'undefined'){
                    $(".mobile-search .searchMobileSwitchEngine").attr("checked","checked");
                    $(".mobile-search .formSearchEngine").hide();
                    $(".mobile-search .searchrflex").show();
                }
            }
            
        },
	removeImgAttributes: function() {
		$('.col01 img').removeAttr('width').removeAttr('height');
		$('.col02 img').removeAttr('width').removeAttr('height');
		$('.col03 img').removeAttr('width').removeAttr('height');
	},
			
	setAutoStock: function(){
		$(".stockBlocJS").each(function(index){
			var urlXml = $(this).attr("rel");
			var timerReload = $(this).attr("time");
			var timer = 0;
			var elt = $(this);
			timerReload <= 60 ? timer = 60000 : timer = timerReload*1000;
			if ($.browser.msie && window.XDomainRequest) {
				// Use Microsoft XDR
				var xdr = new XDomainRequest();
				xdr.open("get", urlXml);
				xdr.onload = function () {
					var data = xdr.responseText;
					
					eGauss.parseXml(data,elt);
					window.setTimeout("eGauss.setAutoStock()", timer);
				};
				xdr.onprogress = function(){ };
				xdr.ontimeout = function(){ };
				xdr.onerror = function () { };
				setTimeout(function(){
					xdr.send();
				}, 0);
			}else{
				$.ajax({ 
					mode: 'queue', 
					type: "GET", 
					url: urlXml, 
					dataType: "xml", 
					//timeout: 5000,
					async: false,
				
					success: function(data){					
						eGauss.parseXml(data,elt);
						window.setTimeout("eGauss.setAutoStock()", timer);
														
					},
					error: function(e, jqxhr, settings, exception){
					}
				}); 
			}
			
			 
		});
	},
	StringtoXML: function(text){
                if (window.ActiveXObject){
                  var doc=new ActiveXObject('Microsoft.XMLDOM');
                  doc.async='false';
                  doc.loadXML(text);
                } else {
                  var parser=new DOMParser();
                  var doc=parser.parseFromString(text,'text/xml');
                }
                return doc;
            },
	parseXml: function(xml,elt){ 
		var vpos = "";
		var vchange = "";
		var vindice = "";
		var vdate = "";
		var vtime = "";
		if ($.browser.msie && window.XDomainRequest) {
			xml = eGauss.StringtoXML(xml);
		}
		$(xml).find("dayQuote").each(function(){ 
			vchange = $(this).find("changePreviousInPct change").text();
			vindice = $(this).find("lastKnownQuote quote").text();
			vdate = $(this).find("quoteDate date").text();
			vtime = $(this).find("quoteDate time").text();
			vindice = Math.round(vindice*100)/100;
			// force 2 digit after decimal and transform it to String
			vindice = vindice.toFixed(2).toString();
			
			//var d = new Date(vdate);
			var jour = vdate.substring(8,10);
			var mois = vdate.substring(5,7);
			var annee = vdate.substring(0,4);
			var heure = vtime.substring(0,2);
			var minutes = vtime.substring(3,5);
			var seconde = vtime.substring(6,8);
			var t = new Date(annee,mois-1,jour,heure,minutes,seconde);
			//var t = new Date(vdate+' '+vtime);
			var datetime = t.strftime('%d %b %Y - ');
			var period = t.strftime('%I.%M %p');
			if(vchange > 0){
				vpos = "+"
			}
			if(document.getElementsByTagName('html') && document.getElementsByTagName('html')[0].lang == "fr"){
				vchange = vchange.replace(".",",");
				
				vindice = vindice.replace(".",",");
				datetime = t.strftime("%d %b %Y - ");
				period = t.strftime('%Hh%M');
			}
			period = period.toString();
			if(period.indexOf("0") == 0){
				period = period.substring(1);
			}
			
			elt.find(".stockBoxProg").text(vpos+vchange + "%");
			elt.find(".stockBoxValue").text(vindice + "€");
			elt.find(".stockPlaceDate").text(datetime);
			elt.find(".stockPlaceDatePeriod").text(period);
		}); 
	}, 
	
	setHomeJobSearch: function() {
		$("#formHomeSearch .criteria").bind("focus", function(e) {
			if (!$.data(this, "cleaned")) {
				$(this).val("");
				$.data(this, "cleaned", true);
			}
		});
		$("#formHomeSearch input[type=submit]").click(function(){
			createCookie('mobile-search','open',0);
		});
		
	},
	setWidgets: function(){
		$.widget("ui.eGaussSlideshow", eGauss.widgets.slideshow);
		$.widget("ui.eGaussDialog", eGauss.dialog);
		$.widget("ui.diaporama",DiaporamaManager);
		$(".slideshow").eGaussSlideshow();
	},
	setTools: function(){
		$('.btnPrint').click(function(){
			window.print();
		});
		$('.btnSend').click(function(){
			return addthis_sendto('email');
		});
	},
	/**
	* If resolution <980, desactivate lightbox.
	* Lightbox plugin used : http://lokeshdhakar.com/projects/lightbox2/
	*/
	setLightbox: function(){
		if($('a[rel*="lightbox"]').length > 0 && $(window).width()<980){
			$('a[rel*="lightbox"]').each(function(){
				$(this).attr('rel','desactivatedLightbox');
			});
		}
	},
	setFancyBox: function() {
		if($('a[rel*="lightbox"]').length > 0 && $(window).width()>980){
			$('a[rel*="lightbox"]').each(function(){
				$(this).fancybox();
			});
		}
	},
	setRolloverTabs: function(){
		$(".btnTabContainer .tabCol").click(function(){
			var index = $(".btnTabContainer .tabCol").index(this) + 1;
			var container = $(this).parent().parent().parent();
			container.find("a.btnCell").removeClass("active");
			$(this).children("a").addClass("active");
			container.children("div:not(.btnTabContainer)").hide();
			container.children(".contentTab"+index).show();
		});
	},

	setLinkList: function(){
		$(".selectLinksForm a").click(function(){
			form = $(this).parent();
			if(($(form).children(".selectLinks").val().indexOf("javascript") != -1) || ($(form).children(".selectLinks").val().indexOf("http") != -1) ){
				url = $(form).children(".selectLinks").val();
			}else{
				url = 'http://' + window.location.hostname + '/' + $(form).children(".selectLinks").val();
			}
			
			window.location = url;
		});
	},

	setAccordions: function(){
		$(".accordion").accordion({
			collapsible : true,
			active : false,
			autoHeight:false
		});
		$(".accordion .accordionTitle:first").addClass("firstItem");
		$(".accordion .accordionTitle:last").addClass("lastItem");
	},

	setExpandable: function(id, height){
		$("#"+id).prepend('<ul class="tabNavigation"></ul>');
		nbElt = $("#"+id+" .tabContent .contentPadding h3").size();
		cssClass = "";
		if(nbElt > 0){
			/* Tab configuration */
			$("#"+id+" .tabContent .contentPadding h3").each(function(index){
				/*
				if(index == 0) cssClass="selected firstTab";
				else if(index == nbElt - 1) cssClass="lastTab";
				$("#"+id+" .tabNavigation").append('<li class="'+cssClass+'"><a href="javascript:;">'+$(this).html()+'</a></li>');
				 */
				cssClass ="";
				if(index == 0) cssClass="selected firstTab";
				else if(index == nbElt - 1) cssClass="lastTab";			
				$("#"+id+" .tabNavigation").append('<li><a href="javascript:;">'+$(this).html()+'</a></li>');
				$("#"+id+" .tabNavigation li").eq(index).addClass(cssClass);			
				$(this).remove();
			});
			$("#"+id+" .tabNavigation li a").each(function(index){
				$(this).click(function(){
					$("#"+id+" .tabContent:not(:eq("+index+"))").hide();
					$("#"+id+" .tabContent:not(:eq("+index+")) .contentPadding .tabContentExpandable").height(height);
					$("#"+id+" .tabContent:not(:eq("+index+")) .contentPadding .deployBox").show();
					$("#"+id+" .tabContent:eq("+index+")").show();
					$("#"+id+" .tabNavigation li").removeClass("selected");
					$(this).parent().addClass("selected");
				});
			});

			/* Sizing configuration */
			$("#"+id+" .tabContent .contentPadding .tabContentExpandable").height(height);
			$("#"+id+" .tabContent:not(:first)").hide();

			/* Deploy button */
			$("#"+id+" .tabContent .contentPadding a.btnDeploy").click(function(){
				p = $(this).parents(".contentPadding");
				div = $(p[1]).find(".tabContentExpandable");
				div.height("");
				$(this).parents(".deployBox").hide();
			});
		}
	},
	
	setVideoDetailsPlayer : function(){
		this.setVideoDetailsAccordeon();
		var videoDetailsPlayers = $(".videoDetailsPlayer");
		var params = {
			allowFullScreen:"true",
			menu: "false",
			scale: "noScale",
			wmode: "transparent"
		};
		$.each(videoDetailsPlayers,function(i,val){
			var videoId = $(val).attr("videoid");
			var containerId = $(val).attr("id");
			var videoWidth = $(val).attr("videoWidth");
			var videoHeight = (typeof(videoWidth) == "undefined") ? 405 : videoWidth;  //Math.ceil(videoWidth/1.34);
			videoWidth = (typeof(videoWidth) == "undefined") ? 544 : videoWidth;
			var flashvars = {
				playerURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/player.swf",
				playerClassRef : "org.coreplayer.view.components.CorePlayer",
				controlsURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/controls.swf",
				skinURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/skin.swf",
				accessibilityURL : '/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/accessibility.xml',
				sessionId : 1,
				userId : 1,
				playHandler : "eGauss.updateView",
				videoId : parseInt(videoId),
				gatewayURL : '/?type=900'

			};
			if(swfobject.hasFlashPlayerVersion("9.0"))
			{
				swfobject.embedSWF( "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/preloader.swf", containerId, videoWidth, videoHeight, "9.0.0", "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/install/expressInstall.swf", flashvars, params );
			}
		});
	},
	setHeightVideo : function(){
		$('.videoPlayer,.paraVideoContainer').each(function(i,e){
			$(e).height($(e).width()*3/4);
			$('html,body,.site-container').animate({scrollTop: 0}, 200);
		});
	},
	setDownloadForm: function(){
		$(".downloadForm").click(function(e){
			var link = $(this).attr('href');
			$('<div id="downloadFormPopup"></div>')
			.load('/?type=102', function(){
				var popup = this;
				$("#downloadForm").validate({
					invalidHandler: function(form, validator){
						var errors = validator.numberOfInvalids();
						if (errors) {
							$("#downloadForm .error").show();
						} else {
							$("#downloadForm .error").hide();
						}
					},
					errorPlacement: function(error, element) {}
				});
				$('#downloadForm').submit(function(){
					var fields = $('#downloadForm').serializeArray();
					$.ajax({
						type: 'POST',
						url: '/?type=102',
						data: fields,
						success: function(data){
							$(popup).dialog("close");
							window.location = link;
						},
						dataType: "json"
					});
					return false;
				});
			})
			.dialog({
				modal: true,
				width: 630
			});
			return false;
		});
	},

	fixImageSizeInVideoList : function()
	{
		var imagesTofix = $(".virtualColBody .videolistImg");
		if(imagesTofix.length==0) return;
		imagesTofix.attr("width",93);
		imagesTofix.attr("height",73);
		/*remove video's description too*/
		$(".virtualColBody .videoDesc").remove();
	},

	eGaussVideosView : [],
	updateView : function(videoId)
	{
		if(videoId=="undefined") return false;
		if($.inArray(videoId,this.eGaussVideosView) >= 0 ) return false; //vidéo déja vue par l'utilisateur uniquement pour la session
		var self = this;
		var data = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail.idVideo = videoId;
		var ajaxUrl = $(".videoPlayer").eq(0).attr("ajaxViewUpdate");
		$.ajax({
			url : ajaxUrl,
			data: data,
			success : function(responseData){
				if(responseData.success) self.eGaussVideosView.push(videoId);
			}
		});
	},
	setFlashDiaporama : function()
	{
		var allDiapos = $(".diaporamaFlash");
		var params = {
			allowFullScreen:"true",
			menu: "false",
			scale: "noScale",
			wmode: "transparent"
		};
		$.each(allDiapos,function(i, diapoContainer){
			var albumId = $(diapoContainer).attr("albumId");
			var containerId = $(diapoContainer).attr("id");
			var zoomText = $(diapoContainer).attr("zoomText");
			var flashvars = {
				sessionId:1,
				userId:1,
				albumId:parseInt(albumId),
				zoomText:zoomText,
				gateway:'/?type=900'
			};
			if(swfobject.hasFlashPlayerVersion("9.0"))
			{
				swfobject.embedSWF( "/typo3conf/ext/lp_eGauss/Resources/Public/swf/Diaporama.swf", containerId, "490", "250", "9.0.0", "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/install/expressInstall.swf", flashvars, params );
			}

		
		});
	},

	setVideoCoverflow : function()
	{
		var allItems = $(".videoCoverFlow");
		var params = {
			allowFullScreen:"true",
			menu: "false",
			scale: "noScale",
			wmode: "transparent"
		};
		$.each(allItems,function(i,coverFlowContener){
			var coverFlowId = $(coverFlowContener).attr("id");
			var cObId = parseInt(coverFlowId.replace("videoCoverFlow_",""));
			var flashvars = {
				sessionId : 1,
				userId : 1,
				albumId : parseInt(cObId),
				gateway : '/?type=900'
			};
			if(swfobject.hasFlashPlayerVersion("9.0"))
			{
				swfobject.embedSWF( "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/diapo/Diaporama_sans_liens.swf", coverFlowId, "490", "250", "9.0.0", "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/install/expressInstall.swf", flashvars, params );
			}
		
		});

	},

	setVideoDetailsAccordeon : function()
	{
		$("#accordion1").accordion({
			active: 1 ,
			'autoHeight' : false,
			//'fillSpace' : true
			'clearStyle' :true
		});
	},
	
	setPopupVideo : function()
	{
		var allVideos = $(".showInPopup");
		var self = this;
		allVideos.bind("click",function(e){
			$("body").append("<div id='popupContent'></div>");
			isAppleMobileDevice = $(this).hasClass("html5Player");
			var videoId =  $(this).attr("videoid");
			var videoTitle = $(this).attr("videotitle");
			var closeCaption = $(".videoClose").eq(0).text();
			if(isAppleMobileDevice)
			{
				var openCallback = self.initHtml5Player.call(this,videoId,videoTitle);				
			}
			else
			{
//				var openCallback = self.initPopupPlayer.call(this,videoId, videoTitle);
				var openCallback = self.initHtml5Player.call(this,videoId,videoTitle);
			}
			$("#popupContent").eGaussDialog({
				modal:true,
				title: videoTitle,
				minWidth:495,
				closeText:closeCaption,
				open : openCallback
			});
		});
	},
	setPopupFlash : function()
	{
		var allVideos = $('.flashInPopup');
		if(allVideos.length > 0 && swfobject.hasFlashPlayerVersion("9.0")){
			$("body").append("<div id='flashPopin'><div id='flash'></div>");
			//add active zone to click over the flash in IE7 and IE8
			allVideos.each(function(i,e){ 
				//zone_activeHeight = $(e).attr('flashheight');
				if($(this).attr('popin') != 'nopopin'){
					$(this).prepend('<div class="zone_active" style="height:'+zone_activeHeight+'px"></div>'); 
				}
			});
		}
		
		allVideos.bind("click",function(e){      
	
			flashTitle = $(this).attr("flashtitle");
			flashWidth = $(this).attr("flashWidth");
			flashHeight = $(this).attr("flashHeight");
			flashPath = $(this).attr("flashPath");
			closeCaption = $(".videoClose").eq(0).text();
			flashvars = jQuery.parseJSON($(this).children(".flashvars").html());
			
			if($(this).attr("popin") != 'nopopin'){
				if(swfobject.hasFlashPlayerVersion("9.0"))
				{
					var params = {
						allowFullScreen:"true",
						menu: "false",
						scale: "noScale",
						wmode: "transparent"
					};
					swfobject.embedSWF( flashPath, "flash", flashWidth, flashHeight, "9.0.0", "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/install/expressInstall.swf", flashvars, params );
					$("#flashPopin").dialog({
						modal:true,
						title: flashTitle,
						width:parseInt(flashWidth)+parseInt(2),
						closeText:closeCaption,
						close: function(event, ui) {
							$(this).parent().detach();
							$("body").append("<div id='flashPopin'><div id='flash'></div>");
						},
						position:['center',0]
					});
				}
			}
            
		});
		$("body").delegate(".ui-widget-overlay","click",function(e){
			$("#flashPopin").dialog( "close" );
		});
		
	},

	setStructureSlideshow: function() {
		// -- hide all implantations
		$($("ul.entities-implantations>li")).hide();
		// -- select first entity
		$("ul#entities-carousel li:first div.pictureBox").addClass("selected");
		// -- display first entity implantations
		$($("ul.entities-implantations").children().get(0)).show();
		// -- add onclick event to entities image a
		$("ul#entities-carousel li div.pictureBox div.imgBox a").click(
			function() {
				// -- remove selected to all pictureBox
				$("div.pictureBox").removeClass("selected");
				// -- add selected class to clicked pictureBox
				$(this).parents("div.pictureBox").addClass("selected");
				// -- hide all entities implantations
				$("ul.entities-implantations>li").hide();
				// -- show entity implantation li matching current entity li index
				$($("ul.entities-implantations").children().get($("ul#entities-carousel li").index($(this).parents("li")))).show();
			}
			);

		// -- create carousel
		var jCarouselOptions = new Object();
		if ($("ul#entities-carousel li").length <= 3) {
			jCarouselOptions.buttonPrevHTML = null;
			jCarouselOptions.buttonNextHTML = null;
		}
		$(".tabCol:eq(1)").click(function(){
			$("ul.jcarousel-skin-eGauss").jcarousel(jCarouselOptions);
		});
		$("div.contentTab2").hide();
	},

	setSearchBoxBehavior: function() {
		var searchInput = $("input#inputSearch");
		$("input#inputSearch").val($('#formDisplayOffersKeyWords .inputTxt').val());
		jQuery.data(searchInput, "cleaned", false)
		if (searchInput) {
			searchInput.bind("focus", function(e) {
				if (!jQuery.data(this, "cleaned")) {
					$("input#inputSearch").val("");
					jQuery.data(this, "cleaned", true);
				}
			});
		}
	},

	setHeaderPromo: function(){

		$("#headerPromo .framesGallery li").each(function(i, el){
			if(i==0) $(el).addClass("selected");
			$(el).attr("itempos", i);
			supertitle = $(el).find(".supertitle").text();
			link = $(el).find("a").attr("href");
			title = $(el).find(".title").text();
			thumbnail = $(el).find("img").attr("thumbsrc");
			isSelected = "";
			var item = [];	
			var imageLink = [];
			imageLink.push("<a href=\""+link+"\"><span></span></a>");
			if(i==0) isSelected = "selected";
			item.push("<div class=\"navigationGalleryItem\"><div class=\"galleryThumbnail\"><a href=\""+link+"\"><img src=\""+thumbnail+"\"></a></div><div class=\"caption\"><a href=\""+link+"\"><strong>"+supertitle+"</strong></a><a href=\""+link+"\">"+title+"</a></div>");
			itemHTML = $('<li/>', {
				'class': isSelected,
				html: item.join('')
			});
			imageLinkHTML = $('<div/>', {
				'class': 'link',
				html: imageLink.join('')
			});
			$(el).find(".description.png_bg").append(imageLinkHTML);
			$("#headerPromo .navigationGallery").append(itemHTML);
		});
				
		
		var headerPromoInterval = setInterval(headerPromoNextSlide, 6000);
		var headerPromoCurrentPage = 0;
		var headerPromoNbPage = $("#headerPromo .framesGallery li").length;
		if (headerPromoNbPage > 4) headerPromoNbPage = 4; 
		var headerPromoSpeed = 400;		

/*		
		$("#headerPromo").touchwipe({
			preventDefaultEvents:false,
			wipeLeft: function() { 
				index = $("#headerPromo .navigationGallery li").index($("#headerPromo .navigationGallery li.selected"));
				if(index == headerPromoNbPage-1){
					index = 0;	
				}else {
					index++;
				}
				$("#headerPromo .navigationGallery li").removeClass("selected");
				$("#headerPromo .navigationGallery li").eq(index).addClass("selected");	
				$("#headerPromo .framesGallery li").css({
						'z-index':400
					})
					$("#headerPromo .framesGallery li").eq(index).css({
						'z-index':410
					}).fadeIn(1000);
			},
			wipeRight: function() { 
				index = $("#headerPromo .navigationGallery li").index($("#headerPromo .navigationGallery li.selected"))
				if(index == 0){
					index = headerPromoNbPage-1;	
				}else {
					index--;
				}
				$("#headerPromo .navigationGallery li").removeClass("selected");
				$("#headerPromo .navigationGallery li").eq(index).addClass("selected");	
				$("#headerPromo .framesGallery li").css({
					'z-index':400
				})
				$("#headerPromo .framesGallery li").eq(index).css({
					'z-index':410
				}).fadeIn(1000);
			}
		});
*/		
			
		//navigation
		$("#headerPromo .navigationGallery li").each(function(i, el){
			
			$(el).on("touchstart",function(event){
				if($(this).attr('class') != "selected"){
					$("#headerPromo .navigationGallery li").removeClass("selected");
					$(this).addClass("selected");	
					$("#headerPromo .framesGallery li").css({
						'z-index':400
					})
					$("#headerPromo .framesGallery li").eq(i).css({
						'z-index':410
					}).fadeIn(1000);
					return false;
				}			
			});
			
			if(!isAndroid){
				$(el).hover(
					function(elt){
						clearInterval(headerPromoInterval);
						headerPromoCurrentPage = i;
						$("#headerPromo .navigationGallery li").removeClass("selected");
						$("#headerPromo .navigationGallery li").eq(i).addClass("selected");
	
						$("#headerPromo .framesGallery li").css({
							'z-index':400
						})
						$("#headerPromo .framesGallery li").eq(i).css({
							'z-index':410
						}).fadeIn(1000);
					},
					function(elt){
						//clearInterval(headerPromoInterval);	
						headerPromoInterval = setInterval(headerPromoNextSlide, 6000);
					}
				)
			}
		});
		

		
		//autoSlide
		function headerPromoNextSlide(){
			var headerPromoSpeed = 1000;
			oldPage = headerPromoCurrentPage;
			headerPromoCurrentPage++;			
			if (headerPromoCurrentPage > headerPromoNbPage-1) headerPromoCurrentPage = 0;
			goPage = headerPromoCurrentPage;
			//change slide
			$("#headerPromo .navigationGallery li").removeClass("selected");
			$("#headerPromo .navigationGallery li").eq(goPage).addClass("selected");
			
			$("#headerPromo .framesGallery li").css({
				'z-index':400
			})
			$("#headerPromo .framesGallery li").eq(goPage).css({
				'z-index':410
			}).fadeIn(headerPromoSpeed);
			//$("#headerPromo .framesGallery li").eq(oldPage).delay(headerPromoSpeed).fadeOut(0);
		}	
	},
	
	setCoverflowCorp : function(){
		//Coverflow Corp
		if ($('#mycarousel2 .carouselItem').length > 1){
			$('#mycarousel2').owlCarousel({ 
				navigation : true, // Show next and prev buttons
				slideSpeed : 300,
				autoPlay : 6000,
				paginationSpeed : 400,
				singleItem:true,
				navigationText: false
			});
		}	
	},
	setCoverflow : function(){
		$(".jcarousel-skin-tango").each(function(i, el){
			
			id = $(el).attr("id");
			
			if ($(el).find("li").length > 1){
				$('#'+id).bxSlider({
					//auto: true,
					pager: true,
					prevText: "",
					nextText: ""
				});
			}
		});
	//Coverflow Corp
		
	},
	twitterCounter:0,
	setTwitter : function(){			
		var self = this;
		/*
		var ticker = function() {
			setTimeout(function() {
				eGauss.twitterCounter++;
				self.setAnitwitt(47);
				ticker();
			}, 5000);
		};
		ticker();*/
		$("#tweets").marquee();
	},
	
	setAnitwitt : function(step){
		if(eGauss.twitterCounter == $(".twtr-tweet").length ){
			eGauss.twitterCounter = 0;
			$(".twitterPost").first().animate({
				"marginTop":"-=" + step + "px"
			}, "slow");
			$(".twitterPost").first().queue(function(){
				$(this).css("marginTop","0px");
				$(this).dequeue();
			});
		}else{			
			$(".twitterPost").first().animate({
				"marginTop":"-=" + step + "px",
				opacity:0
			}, "slow");
			$(".twitterPost").first().queue(function(){
				$(this).css("opacity",1);
				$(this).dequeue();
			});
		}			
	},

	initPopupPlayer : function(videoId, videoTitle)
	{
		var videoId = parseInt(videoId);
		var videoTitle = videoTitle;
		return function(e){
			var params = {
				allowFullScreen:"true",
				menu: "false",
				scale: "noScale",
				wmode: "transparent"
			};
			var flashvars = {
				playerURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/player.swf",
				playerClassRef : "org.coreplayer.view.components.CorePlayer",
				controlsURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/controls.swf",
				skinURL : "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/skin.swf",
				accessibilityURL : '/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/accessibility.xml',
				sessionId : 1,
				userId : 1,
				videoId : videoId,
				playHandler : "eGauss.updateView",
				gatewayURL : '/?type=900'

			};
			if(swfobject.hasFlashPlayerVersion("9.0"))
			{
				swfobject.embedSWF( "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/preloader.swf", "popupContent", "490", "333", "9.0.0", "/typo3conf/ext/lp_webtvcreator/Resources/Public/swf/video/player/install/expressInstall.swf", flashvars, params );
			}
		}
	},

	initHtml5Player : function(videoId, videoTitle)
	{
		var videoTitle = videoTitle; 
		return function(e)
		{
			var videoC = $("#kplayer_"+videoId).clone();
			var videoC = videoC.html().replace(/sigKey/g,videoId);
			$("#popupContent").append(videoC);
			kitd.html5loader("flash_kplayer_"+videoId,"http://api.kewego.com/video/getHTML5Thumbnail/?playerKey=c9321eb16ce9&sig="+videoId);
			$("#popupContent .flash_kplayer").css({'height':$("#popupContent .playButton").height()+'px','width':$("#popupContent").width()+'px'});
		}
	},

	widgets: {
		slideshow: {
			// default options
			options: {

			},
			slides: [],
			current: 1,
			_create: function(){
				myself = this;
				this.element.find(".homeTabContainer li.tab").each(function(i, tab){
					myself._setTab(i, tab);
				});
			},
			_setTab: function(i, tab){
				$(tab).children("a").click({
					widget: this,
					tab: tab
				},this._tabClicked);
				if(i==0) $(tab).children("a").click();
			},
			_tabClicked: function(e){
				e.data.widget.slides = [];
				// Display clicked tab as selected
				$(e.data.tab).siblings("li").removeClass("selected");
				$(e.data.tab).addClass("selected");
				// Init slideshow with good content
				e.data.widget.element.find(".tabContent .slideshowArea").html($(e.data.tab).find(".slideshowArea").html());
				e.data.widget.element.find(".tabContent .slideshowArea .pictureBox").each(function(i, el){
					e.data.widget.slides.push(el)
				});
				e.data.widget.element.find(".tabContent .slideshowArea .pictureBox").remove();
				e.data.widget._moveTo(1);
				// Init arrows
				e.data.widget.element.find(".tabContent .slideshowArea .btnPrev").click({
					widget: e.data.widget,
					tab: e.data.tab
				}, e.data.widget._prevArrowClicked);
				e.data.widget.element.find(".tabContent .slideshowArea .btnNext").click({
					widget: e.data.widget,
					tab: e.data.tab
				}, e.data.widget._nextArrowClicked);
				return false;
			},
			_prevArrowClicked: function(e){
				e.data.widget._moveTo(e.data.widget.current - 1);
			},
			_nextArrowClicked: function(e){
				e.data.widget._moveTo(e.data.widget.current + 1);
			},
			_thumbnailClicked: function(e){
				e.data.widget._moveTo(e.data.pos);
			},
			_moveTo: function(newPos){
				if (newPos < 0) newPos = this.slides.length - 1;
				if(newPos > this.slides.length - 1) newPos = 0;
				this.current = newPos;

				if (this.current - 1 < 0) first = this.slides.length - 1; else first = this.current - 1;
				if(this.current + 1 > this.slides.length - 1) last = 0; else last = this.current + 1;

				$(this.slides).removeClass("selected");
				$(this.slides[this.current]).addClass("selected");

				var container = this.element.find(".tabContent .slideshowArea .slideshowPictures .pictureBoxes");
				container.html(this.slides[first]);
				container.append(this.slides[this.current]);
				container.append(this.slides[last]);
				container.find(".imgBox:eq(0)").click({
					widget: this,
					pos: first
				}, this._thumbnailClicked);
				container.find(".imgBox:eq(2)").click({
					widget: this,
					pos: last
				}, this._thumbnailClicked);
			},
			destroy: function(){
				$.Widget.prototype.destroy.apply(this, arguments);
			}
		}
	}
}

var MainMenuManager = {

	options : {
		mainNavID : "mainNav",
		itemClass : "btnNav",
		firstItem : "firstItem",
		subNavClass : "subNav",
		subNavColClass : "subNavCol",
		subMainClass : "subNavContent",
		grayColClass : "subNavColGrey",
		colMaxSize : "subNav3Col",
		colMax : 3
	},

	init : function(userOptions){
		if(!userOptions) userOptions = {};
		this.options = $.extend(this.options,userOptions);
		this.o = this.options;
		if(is_touch_device()) $('body').addClass("touch-device");
		this.bindEvents();
		this.a =0;
	},

	handleClickedMenuItem : function(e){
		var isFirstItem = this.isFirstItem(e);
		//if(isFirstItem) return false; //first Item
		/*otherwhise*/
		this.fixMenuSize(e);
	},

	bindEvents : function(){
		var selectedField = "#"+this.o.mainNavID +" ."+this.o.itemClass;
		//if(is_touch_device())	$(selectedField).bind("click",$.proxy(this.handleClickedMenuItem, this));
		//else
		$(selectedField).bind("mouseover click",$.proxy(this.handleClickedMenuItem, this));
		$(selectedField).bind("mouseleave",$.proxy(function(e){
			var obj = $(e.currentTarget).parent();
			this.a = window.setTimeout(function() {
				$(obj).removeClass("is-open");
				//subMenu.addClass(options.offClass);
			}, 200); 
		}, this));
	},

	isFirstItem : function(e){
		var mainTarget = e.currentTarget;
		var parent = $(mainTarget).parent(".firstItem");
		return parent.length;
	},
	fixMenuSize : function(e){
		var mainTarget = e.currentTarget;
 
		if(is_touch_device()){
			if(!$(mainTarget).parent().hasClass('is-open')){
				$("#mainNav li.is-open").removeClass('is-open');
				$(mainTarget).parent().addClass('is-open');
				$(mainTarget).parent().removeClass('is-closed');
			}else{
				//$("#mainNav li.is-open").removeClass('is-open');
				//$(mainTarget).parent().addClass('is-closed');
			}
		}
		//$(mainTarget).parent().addClass('is-open');
		
		var menuItemContainer = $(mainTarget).next("."+this.o.subNavClass).css({
			left:""
		});
		var subNavContent = $(menuItemContainer).find("."+this.o.subMainClass);
		var topCol = $(subNavContent).children("."+this.o.subNavColClass).length;
		var bottomCol = $(menuItemContainer).find("."+this.o.grayColClass+" ."+this.o.subNavColClass).length;
		var mainColNb = Math.max(topCol,bottomCol);
		mainColNb = (mainColNb > 0) ? mainColNb : 0;
		var newItemClass = (mainColNb < 4) ? "subNav"+mainColNb+"Col" : this.o.colMaxSize;
		/*fix size subNav4Col*/
		$(menuItemContainer).removeClass("subNavFullWidth");
		$(subNavContent).addClass(newItemClass);
		calculteWidth = $("#"+this.o.mainNavID).width()/this.o.colMax*mainColNb;
		$(subNavContent).parent().css("width",calculteWidth);
		this.calculatePosition(mainTarget, subNavContent,calculteWidth);
	},

	calculatePosition : function(mainTarget,subnavContent){
		/*si la taille de la boite est supérieure à la longueur de la nav - longueur de la nav au point cliqué - compenser -left  */
		/*offset : relatif au document*/
		var mainNavleft = $("#"+this.o.mainNavID).offset().left;
		var mainNavWidth = $("#"+this.o.mainNavID).width(); //935
		var navItemLeft = $(mainTarget).offset().left;
		var subNavWidth = calculteWidth;

		var availableSpace = mainNavWidth - (navItemLeft - mainNavleft);

		if(subNavWidth > availableSpace)
		{
			var newLeft = subNavWidth - availableSpace +2;
			$(subnavContent).parent(".subNav").css({
				left:"-"+newLeft+"px"
			});
		}
	}
};

var DiaporamaManager = {
    
	options : {
		prevBtnCls : "btnPrev",
		nextBtnCls : "btnNext",
		imgContainer : "imageContainer",
		imgDataContainer : "imgData",
		imgItemClass : "pictureBox",
		downloadList : "downloadList",
		minItem : 3,
		enableLightbox : true,
		lightBoxClass : "enableLightBox",
		linkMoreDownloadClass : "linkMoreDownload",
		lightBoxSettings : {
			imageLoading: '/fileadmin/templates/main/img/lightBox/lightbox-ico-loading.gif',
			imageBtnPrev: '/fileadmin/templates/main/img/lightBox/lightbox-btn-prev.gif',
			imageBtnNext: '/fileadmin/templates/main/img/lightBox/lightbox-btn-next.gif',
			imageBtnClose: '/fileadmin/templates/main/img/lightBox/lightbox-btn-close.gif',
			imageBlank: '/fileadmin/templates/main/img/lightBox/lightbox-blank.gif',
                        txtImage : "",
                        txtOf: "/"
		}
	},
	widgetKey : null,
	currentPage : 1,
	selectedItem : 2,
	imgData: [],
	_init : function(){},

	_create: function(){
		this.o = this.options;
		this.el = this.element;
		/*setwidgetKey*/
		this.widgetKey = Math.floor(Math.random()*101531);
		/*data*/
		this.imgData = eval($(this.el).find(" ."+this.o.imgDataContainer).val());

		/*masquer la pagination*/
		if((this.imgData) && this.imgData.length < 2)
		{
			$(this.el).find("."+this.o.prevBtnCls).hide();
			$(this.el).find("."+this.o.nextBtnCls).hide();
		}
      
		/*updateImagePath*/
		this.updateImgPath();

		/*updateIds*/
		this.updateImgsId();

		/*lightBox*/
		if(this.o.enableLightbox) this.initLightBox();

		/*events*/
		this.bindEvents();
	},
	_setOption: function( key, value ) {
		this.options[key] = value;
		this._super( "_setOption", key, value );
	},


	updateImgPath : function(){
		var self = this;
		var links = $(this.el).find("."+this.o.lightBoxClass);
		$.each(links,function(i,link){
			var newMainImgPath = $(link).find(".resizedMainPhoto").attr("src");
			//update link path
			$(link).attr("href",newMainImgPath);
		});
	},

	zoom: function(image, path)
	{
		if(path=="false") return;
		/*videoCoverflow*/
		var videoUriPattern = /::videoCoverflow/;
		var isVideo = videoUriPattern.test(path);
		if(isVideo)
		{
			this.goToVideo(path);
			return;
		}
		/*album coverflow*/
		jQuery('<a class="enableFlashLightBox" title="'+image+'" href="'+path+'"></a>').appendTo("body");
		this.initFlashLighBox();
		$(".enableFlashLightBox").trigger("click");
		/*remove the close btn*/
		$("#lightbox-secNav-btnClose").attr("href","javascript:;").find("img").remove();
	},

	goToVideo : function(videoUri)
	{
		var videoUri = videoUri.replace("::videoCoverflow","");
		var videoDetails = $(".videoDetailsLinks").eq(0).attr("href");
		if(videoDetails.length==0) return;
		var videoDetailsLink = videoDetails.replace(".html","/title/"+videoUri+".html");
		document.location.href = "/"+videoDetailsLink;
	},

	/*
	* Warning. Obsolete. Lightbox v2 can't be configured this way.
	*/
	initFlashLighBox : function()
	{
		$(".enableFlashLightBox").lightBox({
			imageLoading: '/fileadmin/templates/main/img/lightBox/lightbox-ico-loading.gif',
			imageBtnPrev: '/fileadmin/templates/main/img/lightBox/lightbox-btn-prev.gif',
			imageBtnNext: '/fileadmin/templates/main/img/lightBox/lightbox-btn-next.gif',
			imageBtnClose: '/fileadmin/templates/main/img/lightBox/lightbox-btn-close.gif',
			imageBlank: '/fileadmin/templates/main/img/lightBox/lightbox-blank.gif',
			closeCallback: function(){
				$(".enableFlashLightBox").remove();
			}
		});
	},

	/*
	* Warning. Obsolete. Lightbox v2 can't be triggered this way.
	*/
	initLightBox : function()
	{
		var items = $(this.el).find("."+this.o.lightBoxClass);
		$(this.el).find("."+this.o.lightBoxClass).lightBox(this.o.lightBoxSettings);
	},

	updateImgsId : function()
	{
		var self = this;
		var images = $(this.el).find("."+this.o.imgItemClass);
		$.each(images,function(i,imgItem){
			var oldKey = parseInt($(imgItem).attr("id").replace("pic_","")); //ne lancer qu'une fois
			$(imgItem).attr("id","pic_"+self.widgetKey+"_"+oldKey);
		});

	},

	bindEvents : function(){
		$(this.el).find("."+this.o.prevBtnCls).bind("click",$.proxy(this.prevBtnHandler,this));
		$(this.el).find("."+this.o.nextBtnCls).bind("click",$.proxy(this.nextBtnHandler,this));
		/*click on item*/
		$(this.el).find("."+this.o.imgItemClass).bind("click", $.proxy(this.clickOnImgHandler,this));
        
	},
	prevBtnHandler : function(e)
	{
		this.currentPage = this.currentPage - 1;
		var nextItems = this.getNextItems();
		this.showItems(nextItems);
		return false;
	},
	nextBtnHandler : function(e)
	{
		this.currentPage = this.currentPage + 1;
		var nextItems = this.getNextItems();
		this.showItems(nextItems);
		return false;
	},
	clickOnImgHandler : function(e)
	{
		if($(e.target).hasClass("linkMoreDownload")) return true;
		if(!this.o.enableLightbox) return true;
		var selectedImgId = parseInt($(e.currentTarget).attr("id").replace("pic_"+this.widgetKey+"_",""));
		this.showItemLinks(selectedImgId);
		return false;
	},

	getNextItems : function()
	{
		var nextPage = (this.currentPage > this.imgData.length)? 1: (this.currentPage <= 0)? this.imgData.length : this.currentPage;
		var nextItems = this.imgData[nextPage-1];
		this.currentPage = nextPage;
		return nextItems;
	},

	showItems : function(itemsToShow){
		//masquer toutes les images
		var self = this;
		this.hideAllImages();
		//afficher les image de la page suivante
		$.each(itemsToShow,function(i,picData){
			var itemsClass = i+1;
			var items = $("#pic_"+self.widgetKey+"_"+picData.uid);
			$("#pic_"+self.widgetKey+"_"+picData.uid).addClass("pictureBox"+itemsClass).show();
			if(itemsClass == 2){
				self.showItemLinks(picData.uid);
			}
		});
	},

	showItemLinks : function(selectedImgId)
	{
		/*masquer la selection précédente et picture legende*/
		$(this.el).find("#pic_"+this.widgetKey+"_"+this.selectedItem).removeClass("selected");
		$(this.el).find(".pictureLegend").hide();
		$(this.el).find("."+this.o.downloadList).hide();
		$(this.el).find("#downloadList_"+selectedImgId).show();
		$(this.el).find("#pic_"+this.widgetKey+"_"+selectedImgId).addClass("selected");
		/*show legend*/
		$("#pic_"+this.widgetKey+"_"+selectedImgId +" .pictureLegend").show();
		this.selectedItem = selectedImgId;
	},

	hideAllImages : function(){
		$(this.el).find("."+this.o.imgContainer+" ."+this.o.imgItemClass).removeClass("pictureBox1 pictureBox2 pictureBox3");
	}


};


var RateManager = {
	url : null,
	currentEl : null,
	options :{
		readOnlyRateClass : "readOnlyRate",
		readOnlyItemClass : "voteStar",
		rateAllowedClass : "enableRate",
		normalItemClass : "voteStar"
	},

	init : function(initOptions){
		this.options = $.extend(this.options,initOptions);
		this.o = this.options;
		this.enableReadOnlyRate();
		this.enableRate();
	},

	enableReadOnlyRate : function(){
		var allEls = $("."+this.o.readOnlyRateClass);
		var self = this;
		$.each(allEls,function(i,el){
			var itemId = $(el).attr("id");
			$("#"+itemId +" ."+self.o.readOnlyItemClass).rating({
				'readOnly':true
			});
		});
	},
	enableRate : function(){
		var allEls = $("."+this.o.rateAllowedClass);
		var self = this;
		$.each(allEls,function(i,el){
			var itemId = $(el).attr("id");
			var videoId = $(el).attr("videoid");
			var ajaxUrl = $(el).attr("ajaxUrl");
			var updateRateFunc = self.updateRate.call(self,videoId,ajaxUrl,el);
			$("#"+itemId +" ."+self.o.normalItemClass).rating({
				callback : updateRateFunc
			});
		});
	},
	handlerVote : function(response){
		if(!response) return false;
		var mainContainer = $(this.currentEl).parents("."+this.o.rateAllowedClass);
		var itemId = $(mainContainer).attr("id");
		var currentRate = $(mainContainer).attr("currentRate");
		var currentVote = parseInt($(mainContainer).find(".voteCtn").html());
		if(response.message.length != 0){
			//alert(response.message);
			$("#"+itemId +" ."+this.o.normalItemClass).rating("select",parseInt(currentRate));
		}else{
			$(mainContainer).find(".voteCtn").html(currentVote + 1);
		}
		$("#"+itemId +" ."+this.o.normalItemClass).rating("readOnly");
		return false;
	},

	updateRate : function(videoId, ajaxUrl,mainEl)
	{
		var videoId = videoId;
		var ajaxUrl = ajaxUrl;
		var mainEl = mainEl;
		var self = this;
		return function(userRate, el){
			var mainContainer = mainEl;
			if($(mainContainer).data('hasVoted')==1) return;
			$(mainContainer).data('hasVoted',1);
			self.currentEl = el;
			self.rateVideo(userRate,videoId, ajaxUrl);
		}
	},

	rateVideo : function(userRate,videoId,ajaxUrl){
		var self = this;
		var data = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail.userRate = userRate;
		data.tx_lpwebtvcreator_videoplayerwithdetail.idVideo = videoId;

		$.ajax({
			url : ajaxUrl,
			data :data,
			success : $.proxy(self.handlerVote,self)
		});
	}
};



$(document).ready(function(){
	eGauss.load();
	MainMenuManager.init();
	RateManager.init();
});

/**
 * pretty Date
 * http://ejohn.org/files/pretty.js
 */
eGauss.prettyDate = {

	options :{
		prettyDateCls:'prettyDate',
		now :"Just now",
		oneMinuteAgo :"1 minute ago",
		oneHourAgo :"1 hour ago",
		yesterday :"YesterDay",
		daysAgo :"days ago",
		minutesAgo : "minutes ago",
		hoursAgo :"hours ago",
		weeksAgo :"weeks ago",
		prefix :""
	},

	init : function(userOptions){

		this.options = $.extend(this.options, userOptions);
		this.options.now = $("#"+this.options.now).html();
		this.options.oneMinuteAgo = $("#"+this.options.oneMinuteAgo).html();
		this.options.oneHourAgo = $("#"+this.options.oneHourAgo).html();
		this.options.yesterday = $("#"+this.options.yesterday).html();
		this.options.daysAgo = $("#"+this.options.daysAgo).html();
		this.options.minutesAgo = $("#"+this.options.minutesAgo).html();
		this.options.hoursAgo = $("#"+this.options.hoursAgo).html();
		this.options.weeksAgo = $("#"+this.options.weeksAgo).html();
		this.options.prefix = $("#"+this.options.prefix).html();

		this.o = this.options;
		var self = this;
		this.initPrettyDate();

		setInterval(function(){
			self.initPrettyDate();
		},10000);
	},

	initPrettyDate : function(){
		var self = this;
		var els = $("."+this.o.prettyDateCls);
		$.each(els,function(i, el){
			var prettyDate = self.prettyDate($(el).attr("title"));
			$(el).html(prettyDate);
		});
	},

	prettyDate : function(time){
		var messages = this.o;
		var date = new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," ")),
		diff = (((new Date()).getTime() - date.getTime()) / 1000),
		day_diff = Math.floor(diff / 86400);
		if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
			return;

		return day_diff == 0 && (
			diff < 60 && messages.now ||
			diff < 120 && messages.oneMinuteAgo ||
			diff < 3600 && messages.prefix+' '+Math.floor( diff / 60 ) + ' '+messages.minutesAgo ||
			diff < 7200 && messages.oneHourAgo ||
			diff < 86400 && messages.prefix+' '+Math.floor( diff / 3600 ) + ' '+messages.hoursAgo) ||
		day_diff == 1 && messages.yesterday ||
		day_diff < 7 && messages.prefix+' '+day_diff + " "+messages.daysAgo ||
		day_diff < 31 && messages.prefix+' '+Math.ceil( day_diff / 7 ) + " "+messages.weeksAgo;
	}




};

eGauss.dialog = {
	blueTemplate : "<div classs='blueTemplate'></div>",
	yellowTemplate : '<div class="popupContainer">'
	+'<div class="popupHeader"><p class="eGaussDialogTitle">Title</p><a class="btnClose" href="javascript:;">Fermer</a></div>'
	+'<div class="popupContent">'
	+'</div>'
	+'</div>',

	overlay : "<div class='popupBackground'></div>",
	overlayCss : {
		position : "fixed",
		top : 0,
		left : 0,
		width : '100%',
		height: '100%',
		opacity : '0.5',
		zIndex : '10000'
	},

	isOpen : false,

	options : {
		enableResize : true,
		enableDraggable : true,
		maxHeight : 100,
		maxWidth : 100,
		minWidth: 100,
		minHeight : 100,
		modal : true,
		closeText : "Close",
		title :"popup title"
	},

	_create : function(){
		
		var options = this.options;
		var yellowTemplate = $(this.yellowTemplate).clone();
		yellowTemplate.find(".eGaussDialogTitle").html(options.title);
		yellowTemplate.find(".btnClose").html(options.closeText);
		this.uiDialog = yellowTemplate;
		$(yellowTemplate).find(".popupContent").css({
			padding:'2px'
		}).append(this.element)
		$(yellowTemplate).hide();
		$("body").append(yellowTemplate);
		/*bindEvents*/
		this._bindEvents();
		if(options.enableResize) $(yellowTemplate).resizable();
		if(options.enableDraggable) $(yellowTemplate).draggable({
			handle :'.popupHeader',
			cursor:'pointer'
		});
	},
	_init : function(){
		//console.log("inside init");
		if(!this._isOpen()) this.open();
	},

	open : function(){
		var options = this.options;
		if(options.modal){
			var screenHeight = $(document).height();
			this.overlay = $(this.overlay).css({
				height:screenHeight+"px"
			});
			$("body").append($(this.overlay));
		}
		var position = this._getDialogPosition();
		this.uiDialog.css({
			height : options.minHeight+'px',
			width : options.minWidth+'px',
			top : position.top,
			left : position.left,
			position: "absolute"
		}).show();
		this.isOpen = true;
		this._trigger("open",{
			ui : this.uiDialog
		});
	},
	
	_getDialogPosition : function()
	{
		/*permet de centrer*/
		var options = this.options;
		var height = options.minHeight;
		var width = options.minWidth;
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = height;
		var popupWidth = width;
		var top = windowHeight/2-popupHeight/2;
		var left = windowWidth/2-popupWidth/2;
		var scrollTop = (document.documentElement && document.documentElement.scrollTop) || window.pageYOffset || self.pageYOffset || document.body.scrollTop;
		var scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || window.pageXOffset || self.pageXOffset || document.body.scrollLeft;
		left = left + scrollLeft;
		top = top + scrollTop;

        
		var position = {};
		position.top = top;
		position.left = left;
		return position;
	},

	_isOpen : function(){
		return  this.isOpen;
	},

	_bindEvents : function(){
		this.uiDialog.find(".btnClose").bind("click",$.proxy(this._close,this));
	},

	_close : function(){
		var options = this.options;
		this.uiDialog.hide();
		this.isOpen = false;
		if(options.modal) $(this.overlay).hide();
		//this._trigger("close");
		$(this.uiDialog).remove();
		$(this.overlay).remove();
	},

	destroy : function()
	{
        
	/*var self = this;
        self.uiDialog.unbind(".bntClose");
        $(self.uiDialog).remove();
        $(self.overlay).remove();*/
	}
};

/*commentManager*/
eGauss.commentsManager = {

	options :{
		newCommentCls : "addNewComment",
		relatedCommentCls : "addRelatedComment",
		commentItemCls : "commentItem",
		templateId : "commentTemplate",
		ajaxFieldId : "commentAjaxUrl",
		commentEditorId : "commentEditor",
		mainContainerId :"mainContainerComment",
		saveCommentBtn : "commentSubmitBtn",
		cancelCommentBtn : "commentCancelBtn",
		editFieldCls :"editField",
		editorFields : [{
			id:"commentNameField",
			check:"notEmpty"
		},{
			id:"commentEmailField",
			check:"email"
		},{
			id:"commentContentField",
			check:"notEmpty"
		}]
	},
	ajaxUrl : null,
	commentTemplate : null,
	editorTemplate : null,
	videoId : null,
	emailPattern : /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/,
	pCommentId : 0,

	init : function(userOptions){
		this.options = $.extend(userOptions,this.options);
		this.o = this.options;

		/*set ajaxUrl*/
		this.ajaxUrl = $('.commentsVideo:first').attr(this.o.ajaxFieldId);

		/*set commentTemplate*/
		this.commentTemplate = $("#"+this.o.templateId).clone();

		/*set commentEditorId*/
		this.editTemplate = $("#"+this.o.commentEditorId).clone();
		$("#"+this.o.commentEditorId).remove();

		/*clearFieldIfErrors*/
		$("."+this.o.editFieldCls).live("click",function(e){
			$(this).removeClass("fieldError");
		});

		/*set videoId*/
		this.videoId = $('.commentsVideo:first').attr("videoId");
		this.bindEvents();
	},
	bindEvents : function(){
		var self = this;
		$("."+this.o.relatedCommentCls).live('click',$.proxy(this.handleNewRelatedComment,this));
		$("."+this.o.newCommentCls).live('click',$.proxy(this.handleNewComment,this));
		$("#"+this.o.saveCommentBtn).live('click',$.proxy(this.saveComment,this));
		$("#"+this.o.cancelCommentBtn).live('click',function(e){
			if($("#editorCnt")) $("#editorCnt").html("");
			if($("#commentEditor")) $("#commentEditor").remove();
		});
	},

	checkFields : function(){
		var errors = [];
		var self = this;
		$.each(this.o.editorFields,function(i,field){
			if(field.check=="notEmpty")
			{
				var fieldVal = $("#"+field.id).val();
				if(fieldVal=="") errors.push({
					field:field.id,
					msg:""
				});
			}
			if(field.check=="email")
			{
				var emailVal = $("#"+field.id).val();
				if(self.emailPattern.test(emailVal) == false) errors.push({
					field:field.id,
					msg:""
				});
			}

		});
		return errors;
	},
	showErrors : function(errors)
	{
		$.each(errors,function(i,error){
			$("#"+error.field).addClass("fieldError");
		});
	},
	saveComment : function(e){
		/*check fields*/
		var errors = this.checkFields();
		if(errors.length >0){
			this.showErrors(errors);
			return false;
		}
		var self = this;
		var pCommentId =  this.pCommentId;
		data = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail = {};
		data.tx_lpwebtvcreator_videoplayerwithdetail.idVideo = this.videoId;
		data.tx_lpwebtvcreator_videoplayerwithdetail.pCommentId = pCommentId;
		data.tx_lpwebtvcreator_videoplayerwithdetail.name = $("#commentNameField").val();
		data.tx_lpwebtvcreator_videoplayerwithdetail.email = $("#commentEmailField").val();
		data.tx_lpwebtvcreator_videoplayerwithdetail.content = $("#commentContentField").val();

		/*unbind once button clicked*/
		$("#"+this.o.saveCommentBtn).die();

		$.ajax({
			url : this.ajaxUrl,
			data : data,
			success : function(response){
				if(response.success)
				{
					if(pCommentId==0)
					{
						$("#editorCnt").before(response.comment);
						$("#editorCnt").html("");
					}
					else{
						$("#commentEditor").replaceWith(response.comment);
					}
					var currentNbCommentVal = parseInt($("#commentNb").html());
					$("#commentNb").html(currentNbCommentVal+1);
				}

			}
		});

	},

	showEditor : function(e){
		$("#"+this.o.saveCommentBtn).die().live('click',$.proxy(this.saveComment,this));
		this._cleanEditorsFields();
		if(!e){
			this.pCommentId = 0;
			$("#editorCnt").html("").append($(this.editTemplate).show());
		}
		else{
			var pCommentId = $(e.currentTarget).parents(".commentItem").attr("id");
			pCommentId = parseInt(pCommentId.replace("comment_",""));
			this.pCommentId = pCommentId;
			$(e.currentTarget).parents(".commentItem").after($(this.editTemplate).attr("pCommentId",pCommentId).show());
		}
	},

	_cleanEditorsFields : function()
	{
		$(this.editTemplate).find("#commentNameField").removeClass("fieldError").val("");
		$(this.editTemplate).find("#commentEmailField").removeClass("fieldError").val("");
		$(this.editTemplate).find("#commentContentField").removeClass("fieldError").val("");
	},

	handleNewRelatedComment : function(e){
		this.showEditor(e);
	},

	handleNewComment :function(e){
		this.showEditor();
	}

};

// To translate date informations : Stock Quotation
Date.ext.locales['fr'] = {
	a: ['dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam'],
	A: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
	b: ['jan', 'fév', 'mar', 'avr', 'mai', 'jun', 'jui', 'aoû', 'sep', 'oct', 'nov', 'déc'],
	B: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
	c: '%a %d %b %Y %T %Z',
	p: ['', ''],
	P: ['', ''],
	x: '%d.%m.%Y',
	X: '%T'
};

function is_touch_device() {
  try {  
    document.createEvent("TouchEvent");  
    return true;  
  } catch (e) {  
    return false;  
  } 
}

$(window).resize(function(){$("#mainNav li.is-open").removeClass('is-open');});

/*Slider*/
$(window).load(function() {
	if($('.slider-image .bxslider').length > 0){
		$('.slider-image .bxslider').owlCarousel({
				beforeInit: function(){
					var sliderCaption = $("<div/>").addClass("slider-caption").append("<ul/>");
					this.$elem.find(".slider-container .slider-caption .caption-data").each(function(){
						sliderCaption.find(">ul").append($("<li/>").append(this));
					});
					sliderCaption.find(">ul>li:not(:eq(0))").css("display","none");
					this.$elem.after(sliderCaption);
				},
				beforeMove: function(){
					this.$elem.next().find("ul li").css("display","none");
				},
				afterMove: function(){
					this.$elem.next().find("ul li").eq(this.$elem.find(".owl-item.active").index()).css("display","block");
					
				},
				autoPlay : 6000,
				navigation : true, // Show next and prev buttons
				slideSpeed : 300,
				addClassActive  : true,
				paginationSpeed : 400,
				//autoPlay:1000,
				singleItem:true,
				navigationText: false,
				afterInit:function(){
				var newHeight = this.$elem.height();
				this.$owlItems.css({height: newHeight});
				},
				afterUpdate:function(){
				var newHeight = this.$elem.height();
				this.$owlItems.css({height: newHeight});
				}
			});
	}
});

function version_compare (v1, v2, operator) {
  // From: http://phpjs.org/functions
  // +      original by: Philippe Jausions (http://pear.php.net/user/jausions)
  // +      original by: Aidan Lister (http://aidanlister.com/)
  // + reimplemented by: Kankrelune (http://www.webfaktory.info/)
  // +      improved by: Brett Zamir (http://brett-zamir.me)
  // +      improved by: Scott Baker
  // +      improved by: Theriault
  // *        example 1: version_compare('8.2.5rc', '8.2.5a');
  // *        returns 1: 1
  // *        example 2: version_compare('8.2.50', '8.2.52', '<');
  // *        returns 2: true
  // *        example 3: version_compare('5.3.0-dev', '5.3.0');
  // *        returns 3: -1
  // *        example 4: version_compare('4.1.0.52','4.01.0.51');
  // *        returns 4: 1
  // BEGIN REDUNDANT
  this.php_js = this.php_js || {};
  this.php_js.ENV = this.php_js.ENV || {};
  // END REDUNDANT
  // Important: compare must be initialized at 0.
  var i = 0,
    x = 0,
    compare = 0,
    // vm maps textual PHP versions to negatives so they're less than 0.
    // PHP currently defines these as CASE-SENSITIVE. It is important to
    // leave these as negatives so that they can come before numerical versions
    // and as if no letters were there to begin with.
    // (1alpha is < 1 and < 1.1 but > 1dev1)
    // If a non-numerical value can't be mapped to this table, it receives
    // -7 as its value.
    vm = {
      'dev': -6,
      'alpha': -5,
      'a': -5,
      'beta': -4,
      'b': -4,
      'RC': -3,
      'rc': -3,
      '#': -2,
      'p': 1,
      'pl': 1
    },
    // This function will be called to prepare each version argument.
    // It replaces every _, -, and + with a dot.
    // It surrounds any nonsequence of numbers/dots with dots.
    // It replaces sequences of dots with a single dot.
    //    version_compare('4..0', '4.0') == 0
    // Important: A string of 0 length needs to be converted into a value
    // even less than an unexisting value in vm (-7), hence [-8].
    // It's also important to not strip spaces because of this.
    //   version_compare('', ' ') == 1
    prepVersion = function (v) {
      v = ('' + v).replace(/[_\-+]/g, '.');
      v = v.replace(/([^.\d]+)/g, '.$1.').replace(/\.{2,}/g, '.');
      return (!v.length ? [-8] : v.split('.'));
    },
    // This converts a version component to a number.
    // Empty component becomes 0.
    // Non-numerical component becomes a negative number.
    // Numerical component becomes itself as an integer.
    numVersion = function (v) {
      return !v ? 0 : (isNaN(v) ? vm[v] || -7 : parseInt(v, 10));
    };
  v1 = prepVersion(v1);
  v2 = prepVersion(v2);
  x = Math.max(v1.length, v2.length);
  for (i = 0; i < x; i++) {
    if (v1[i] == v2[i]) {
      continue;
    }
    v1[i] = numVersion(v1[i]);
    v2[i] = numVersion(v2[i]);
    if (v1[i] < v2[i]) {
      compare = -1;
      break;
    } else if (v1[i] > v2[i]) {
      compare = 1;
      break;
    }
  }
  if (!operator) {
    return compare;
  }

  // Important: operator is CASE-SENSITIVE.
  // "No operator" seems to be treated as "<."
  // Any other values seem to make the function return null.
  switch (operator) {
  case '>':
  case 'gt':
    return (compare > 0);
  case '>=':
  case 'ge':
    return (compare >= 0);
  case '<=':
  case 'le':
    return (compare <= 0);
  case '==':
  case '=':
  case 'eq':
    return (compare === 0);
  case '<>':
  case '!=':
  case 'ne':
    return (compare !== 0);
  case '':
  case '<':
  case 'lt':
    return (compare < 0);
  default:
    return null;
  }
}


function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}