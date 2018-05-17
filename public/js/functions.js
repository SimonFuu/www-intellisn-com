$(document).ready(function () {
    navCollapseControl();
    windowsResize();
});

function windowsResize() {
    $(window).on('resize', function () {
        navCollapseControl();
    });

}

function navCollapseControl() {
    let navbar = $('.navbar-collapse');
    if ($(window).width() <= 977) {
        navbar.addClass('collapse');
    } else {
        navbar.removeClass('collapse');
    }
}
/**
 * over write _topNav Function
 * @private
 */
function _topNav() {
    window.scrollTop 		= 0;
    window._cmScroll 		= 0;
    var _header_el 			= jQuery("#header");

    jQuery(window).scroll(function() {
        _toTop();
    });
    function _toTop() {
        _scrollTop = jQuery(document).scrollTop();
        if(_scrollTop > 100) {
            if(jQuery("#toTop").is(":hidden")) {
                jQuery("#toTop").show();
            }
        } else {

            if(jQuery("#toTop").is(":visible")) {
                jQuery("#toTop").hide();
            }
        }
    }
    // Mobile Submenu
    var addActiveClass 	= false;
    jQuery("#topMain a.dropdown-toggle").bind("click", function(e) {
        if(jQuery(this).attr('href') == "#") {
            e.preventDefault();
        }
        addActiveClass = jQuery(this).parent().hasClass("resp-active");
        jQuery("#topMain").find(".resp-active").removeClass("resp-active");
        if(!addActiveClass) {
            jQuery(this).parents("li").addClass("resp-active");
        }
        return;
    });
    jQuery('li.search i.fa').click(function () {
        if(jQuery('#header .search-box').is(":visible")) {
            jQuery('#header .search-box').fadeOut(300);
        } else {
            jQuery('.search-box').fadeIn(300);
            jQuery('#header .search-box form input').focus();
            if (jQuery('#header li.quick-cart div.quick-cart-box').is(":visible")) {
                jQuery('#header li.quick-cart div.quick-cart-box').fadeOut(300);
            }
        }
    });
    if(jQuery('#header li.search i.fa').size() != 0) {
        jQuery('#header .search-box, #header li.search i.fa').on('click', function(e){
            e.stopPropagation();
        });
        jQuery('body').on('click', function() {
            if(jQuery('#header li.search .search-box').is(":visible")) {
                jQuery('#header .search-box').fadeOut(300);
            }
        });
    }

    jQuery(document).bind("click", function() {
        if(jQuery('#header li.search .search-box').is(":visible")) {
            jQuery('#header .search-box').fadeOut(300);
        }
    });
    // Close Fullscreen Search
    jQuery("#closeSearch").bind("click", function(e) {
        e.preventDefault();
        jQuery('#header .search-box').fadeOut(300);
    });
    // Page Menu [mobile]
    jQuery("button#page-menu-mobile").bind("click", function() {
        jQuery(this).next('ul').slideToggle(150);
    });
    // Quick Cart
    jQuery('li.quick-cart>a').click(function (e) {
        e.preventDefault();

        var _quick_cart_box = jQuery('li.quick-cart div.quick-cart-box');

        if(_quick_cart_box.is(":visible")) {
            _quick_cart_box.fadeOut(300);
        } else {
            _quick_cart_box.fadeIn(300);

            // close search if visible
            if(jQuery('li.search .search-box').is(":visible")) {
                jQuery('.search-box').fadeOut(300);
            }
        }
    });
    // close quick cart on body click
    if(jQuery('li.quick-cart>a').size() != 0) {
        jQuery('li.quick-cart').on('click', function(e){
            e.stopPropagation();
        });

        jQuery('body').on('click', function() {
            if (jQuery('li.quick-cart div.quick-cart-box').is(":visible")) {
                jQuery('li.quick-cart div.quick-cart-box').fadeOut(300);
            }
        });
    }
    // Page Menu [scrollTo]
    jQuery("#page-menu ul.menu-scrollTo>li").bind("click", function(e) {

        // calculate padding-top for scroll offset
        var _href 	= jQuery('a', this).attr('href');

        if(!jQuery('a', this).hasClass('external')) {
            e.preventDefault();

            jQuery("#page-menu ul.menu-scrollTo>li").removeClass('active');
            jQuery(this).addClass('active');

            if(jQuery(_href).length > 0) {

                _padding_top = 0;

                if(jQuery("#header").hasClass('sticky')) {
                    _padding_top = jQuery(_href).css('padding-top');
                    _padding_top = _padding_top.replace('px', '');
                }

                jQuery('html,body').animate({scrollTop: jQuery(_href).offset().top - _padding_top}, 800, 'easeInOutExpo');

            }

        }

    });
    // MOBILE TOGGLE BUTTON
    window.currentScroll = 0;
    jQuery("button.btn-mobile").bind("click", function(e) {
        e.preventDefault();
        jQuery(this).toggleClass('btn-mobile-active');
        jQuery('html').removeClass('noscroll');
        jQuery('#menu-overlay').remove();
        jQuery("#topNav div.nav-main-collapse").hide(0);
        if(jQuery(this).hasClass('btn-mobile-active')) {
            $('body').css('overflow', 'hidden');
            $('.shopping-bag-icon').addClass('hide');
            jQuery("#topNav div.nav-main-collapse").show(0);
            jQuery('body').append('<div id="menu-overlay"></div>');
            if(!jQuery("#topMain").hasClass('nav-onepage') || window.width > 960) { /* onepage fix */
                jQuery('html').addClass('noscroll');
                window.currentScroll = jQuery(window).scrollTop();
            }
        } else {
            $('body').css('overflow', 'auto');
            $('.shopping-bag-icon').removeClass('hide');

            if(!jQuery("#topMain").hasClass('nav-onepage') || window.width > 960) { /* onepage fix */
                jQuery('html,body').animate({scrollTop: currentScroll}, 300, 'easeInOutExpo');
            }
        }
    });

    // BOTTOM NAV
    if(_header_el.hasClass('bottom')) {

        // Add dropup class
        _header_el.addClass('dropup');
        window.homeHeight 	= jQuery(window).outerHeight() - 55;


        // sticky header
        if(_header_el.hasClass('sticky')) {
            window.isOnTop 		= true;


            // if scroll is > 60%, remove class dropup
            jQuery(window).scroll(function() {
                if(jQuery(document).scrollTop() > window.homeHeight / 2) {
                    _header_el.removeClass('dropup');
                } else {
                    _header_el.addClass('dropup');
                }
            });


            // Add fixed|not fixed & dropup|no dropup
            jQuery(window).scroll(function() {
                if(jQuery(document).scrollTop() > window.homeHeight) {
                    if(window.isOnTop === true) {
                        jQuery('#header').addClass('fixed');
                        _header_el.removeClass('dropup');
                        window.isOnTop = false;
                    }
                } else {
                    if(window.isOnTop === false) {
                        jQuery('#header').removeClass('fixed');
                        _header_el.addClass('dropup');
                        window.isOnTop = true;
                    }
                }
            });

            // get window height on resize
            jQuery(window).resize(function() {
                window.homeHeight = jQuery(window).outerHeight();
            });

        }

    } else

    // STICKY
    if(_header_el.hasClass('sticky')) {
        _topBar_H 	= jQuery("#topBar").outerHeight() || 0;
        if(_header_el.hasClass('transparent')) {
            var _el 					= jQuery("#topNav div.nav-main-collapse"),
                _data_switch_default 	= _el.attr('data-switch-default') 	|| '',
                _data_switch_scroll 	= _el.attr('data-switch-scroll') 	|| '';
        }
        jQuery(window).scroll(function() {
            var _scrollTop 	= jQuery(document).scrollTop();
            if((window.width > 992 && _topBar_H < 1)) { // 992 to disable on mobile
                if(_scrollTop > _topBar_H && _scrollTop > 60) {
                    _header_el.addClass('fixed');
                    _header_H = _header_el.outerHeight() || 0;
                    if(!_header_el.hasClass('sub-nav-header') && !_header_el.hasClass('transparent') && !_header_el.hasClass('translucent')) {
                        // jQuery('body').css({"padding-top":_header_H+"px"});
                    }
                } else {
                    if(!_header_el.hasClass('transparent') && !_header_el.hasClass('translucent')) {
                        jQuery('body').css({"padding-top":"0px"});
                    }
                    _header_el.removeClass('fixed');
                }
            } else {
                if (_scrollTop > _topBar_H && _scrollTop > 60) {
                    _header_el.addClass('fixed');
                } else  {
                    _header_el.removeClass('fixed');

                }
            }
            // SWITCH DROPDOWN MENU CLASS ON SCROLL
            if(_header_el.hasClass('transparent')) {
                if(_data_switch_default != '' || _data_switch_scroll != '') {
                    if(_scrollTop > 0) {
                        if(window._cmScroll < 1) {
                            _el.removeClass(_data_switch_default, _data_switch_scroll).addClass(_data_switch_scroll);
                            window._cmScroll = 1;
                        }
                    } else
                    if(_scrollTop < 1) {
                        _el.removeClass(_data_switch_default, _data_switch_scroll).addClass(_data_switch_default);
                        window._cmScroll = 0;
                    }
                }
            }
        });
    } else
    if(_header_el.hasClass('scroll')) {
        jQuery('body').addClass('header-scroll-reveal');
        var didScroll;
        var lastScrollTop 	= 0;
        var delta 			= 5;
        var _header_H 		= _header_el.outerHeight() || 0;
        // _header_H = 0;
        jQuery(window).scroll(function(event){
            didScroll = true;
        });
        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 100);

        function hasScrolled() {
            var st = $(this).scrollTop();
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            if (st > lastScrollTop && st > _header_H){
                _header_el.removeClass('nav-down').addClass('nav-up');
            } else {
                if(st + jQuery(window).height() < jQuery(document).height()) {
                    _header_el.removeClass('nav-up').addClass('nav-down');
                }
            }
            lastScrollTop = st;
        }
    } else
    if(_header_el.hasClass('static') && _header_el.hasClass('transparent')) {
        _topBar_H 	= jQuery("#topBar").outerHeight() || 0;
        if(window.width <= 992 && _topBar_H < 1) {
            var _scrollTop 	= jQuery(document).scrollTop();
            _header_H 	= _header_el.outerHeight() || 0;
            _header_el.addClass('fixed');
        }
        jQuery(window).scroll(function() {
            if((window.width > 992 && _topBar_H < 1) || _topBar_H > 0) { // 992 to disable on mobile
                var _scrollTop 	= jQuery(document).scrollTop();
                if(_scrollTop > _topBar_H) {
                    _header_el.addClass('fixed');
                    _header_H = _header_el.outerHeight() || 0;
                } else {
                    _header_el.removeClass('fixed');
                }
            }
        });
    } else
    if(_header_el.hasClass('static')) {
        // _header_H = _header_el.outerHeight() + "px";
        // jQuery('body').css({"padding-top":_header_H});
    }
    jQuery("#slidetop a.slidetop-toggle").bind("click", function() {
        jQuery("#slidetop .container").slideToggle(150, function() {
            if(jQuery("#slidetop .container").is(":hidden")) {
                jQuery("#slidetop").removeClass('active');
            } else {
                jQuery("#slidetop").addClass('active');
            }
        });
    });
    jQuery(document).keyup(function(e) {
        if(e.keyCode == 27) {
            if(jQuery("#slidetop").hasClass("active")) {
                jQuery("#slidetop .container").slideToggle(150, function() {
                    jQuery("#slidetop").removeClass('active');
                });
            }
        }
    });
    jQuery("a#sidepanel_btn").bind("click", function(e) {
        e.preventDefault();
        _pos = "right";
        if(jQuery("#sidepanel").hasClass('sidepanel-inverse')) {
            _pos = "left";
        }
        if(jQuery("#sidepanel").is(":hidden")) {
            jQuery("body").append('<span id="sidepanel_overlay"></span>');
            if(_pos == "left") {
                jQuery("#sidepanel").stop().show().animate({"left":"0px"}, 150);
            } else {
                jQuery("#sidepanel").stop().show().animate({"right":"0px"}, 150);
            }
        } else {
            jQuery("#sidepanel_overlay").remove();
            if(_pos == "left") {
                jQuery("#sidepanel").stop().animate({"left":"-300px"}, 300);
            } else {
                jQuery("#sidepanel").stop().animate({"right":"-300px"}, 300);
            }
            setTimeout(function() {
                jQuery("#sidepanel").hide();
            }, 500);
        }
        _sidepanel_overlay();
    });
    jQuery("#sidepanel_close").bind("click", function(e) {
        e.preventDefault();
        jQuery("a#sidepanel_btn").trigger('click');
    });
    function _sidepanel_overlay() {
        jQuery("#sidepanel_overlay").unbind();
        jQuery("#sidepanel_overlay").bind("click", function() {
            jQuery("a#sidepanel_btn").trigger('click');
        });
    }
    jQuery(document).keyup(function(e) {
        if(e.keyCode == 27) {
            if(jQuery("#sidepanel").is(":visible")) {
                jQuery("a#sidepanel_btn").trigger('click');
            }
        }
    });

    if(jQuery("#menu_overlay_open").length > 0) {
        var is_ie9 = jQuery('html').hasClass('ie9') ? true : false;
        if(is_ie9 == true) {
            jQuery("#topMain").hide();
        }
        jQuery("#menu_overlay_open").bind("click", function(e) {
            e.preventDefault();
            jQuery('body').addClass('show-menu');
            if(is_ie9 == true) {
                jQuery("#topMain").show();
            }
        });
        jQuery("#menu_overlay_close").bind("click", function(e) {
            e.preventDefault();
            if(jQuery('body').hasClass('show-menu')) {
                jQuery('body').removeClass('show-menu');
            }
            if(is_ie9 == true) {
                jQuery("#topMain").hide();
            }
        });
        jQuery(document).keyup(function(e) {
            if(e.keyCode == 27) {
                if(jQuery('body').hasClass('show-menu')) {
                    jQuery('body').removeClass('show-menu');
                }
                if(is_ie9 == true) {
                    jQuery("#topMain").hide();
                }
            }
        });
    }

    if(jQuery("#sidebar_vertical_btn").length > 0) {
        if(jQuery("body").hasClass('menu-vertical-hide')) {
            _paddingStatusL = jQuery("#mainMenu.sidebar-vertical").css('left');
            _paddingStatusR = jQuery("#mainMenu.sidebar-vertical").css('right');
            if(parseInt(_paddingStatusL) < 0) {
                var _pos = "left";
            } else
            if(parseInt(_paddingStatusR) < 0) {
                var _pos = "right";
            }
            else {
                var _pos = "left";
            }
            jQuery("#sidebar_vertical_btn").bind("click", function(e) {
                _paddingStatus = jQuery("#mainMenu.sidebar-vertical").css(_pos);
                if(parseInt(_paddingStatus) < 0) {
                    if(_pos == "right") {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"right":"0px"}, 200);
                    } else {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"left":"0px"}, 200);
                    }
                } else {
                    if(_pos == "right") {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"right":"-263px"}, 200);
                    } else {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"left":"-263px"}, 200);
                    }
                }
            });
            jQuery(window).scroll(function() {
                _paddingStatus = parseInt(jQuery("#mainMenu.sidebar-vertical").css(_pos));
                if(_paddingStatus >= 0) {
                    if(_pos == "right") {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"right":"-263px"}, 200);
                    } else {
                        jQuery("#mainMenu.sidebar-vertical").stop().animate({"left":"-263px"}, 200);
                    }
                }
            });
        }
    }
    if(jQuery("#topBar").length > 0) {
        jQuery("#topNav ul").addClass('has-topBar');
    }
    jQuery(window).scroll(function() {
        if(window.width < 769) {
            if (jQuery('#header li.quick-cart div.quick-cart-box').is(":visible")) {
                jQuery('#header li.quick-cart div.quick-cart-box').fadeOut(0);
            }
            if(jQuery('#header li.search .search-box').is(":visible")) {
                jQuery('#header .search-box').fadeOut(0);
            }
        }
    });
}

