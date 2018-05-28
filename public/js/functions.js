$(document).ready(function () {
    init();
    navCollapseControl();
    domilampLightTextOnImage();
    windowsResize();
    productOptionsSelection();
    productOption();
    headerCartCountDisplay();
    calculateCartPrice();
    checkout();
});

/**
 * 初始化
 */
function init() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

/**
 * 窗口尺寸发生变化
 */
function windowsResize() {
    $(window).on('resize', function () {
        navCollapseControl();
        let select = jQuery('.select2');
        if (select.length > 0) {
            select.css('width', select.parent('.form-group').width());
        }
    });
}

/**
 * 滚动控制
 */
function navCollapseControl() {
    let navbar = $('.navbar-collapse');
    if ($(window).width() <= 977) {
        navbar.addClass('collapse');
    } else {
        navbar.removeClass('collapse');
    }
}

/**
 * DomiLamp Light 图片上的位置控制
 */
function domilampLightTextOnImage() {
    let light = $('.domilamp-overview-light');
    if (light.length > 0) {
        let zoomRate = light.find('img').width() / 1440;
        let introMark = $('.intro-block-lights');
        introMark.css('margin-top', zoomRate * (540 + 70));
        introMark.css('padding-left', zoomRate * 70);
        introMark.css('padding-right', zoomRate * 70);
        introMark.find('span').each(function (index, element) {
            $(element).css('width', zoomRate * 260);
            $(element).css('padding-left', zoomRate * 10);
            $(element).css('padding-right', zoomRate * 10);
        });
    }

}

/**
 * 产品SKU选择
 */
function productOptionsSelection() {
    $('.product-option').on('click', function () {
        if (!$(this).hasClass('selected')) {
            $(this).addClass('selected');
            $(this).siblings('div').each(function (index, ele) {
                $(ele).removeClass('selected');
            })
        }

        let selected = $('.product-option.selected');
        if (selected.length === $('.product-option-group').length) {
            opts = [];
            selected.each(function (index, ele) {
                opts[index] = $(ele).data('opt-id');
            });
            $.ajax({
                type: 'POST',
                url: $(this).data('query-url'),
                data: {'is_ajax': true, 'p_id': $('.product-id').data('product-id'), 'options': opts},
                success: function (data) {
                    if (data.status) {
                        $('.product-original-price').addClass('line-through');
                        $('.product-price').html(data.data.currency + ': ' + data.data.cur_symbol + parseFormatNum(data.data.price / 100, 2));
                    } else {
                        alert('Getting product price error.')
                    }
                },
                error: function () {
                    alert('Getting product price error.')
                }
            })
        }
    });
}

/**
 * 将产品添加到购物车
 */
function productOption() {
    $('.add-to-cart-btn').on('click', function (e) {
        let option = $('.product-option.selected');
        if (option.length !== $('.product-option-group').length) {
            alert('select the option first!');
        } else {
            let opts = [];
            option.each(function (index, element) {
                opts.push($(element).data('opt-id'));
            });
            let sku = $.base64.encode(JSON.stringify({'product': $('.product-id').data('product-id'), 'option': opts}));
            location.href=$(this).data('url') + '?product=' + sku;
        }
    });
}

/**
 * 一级header 购物车 icon 的数字
 */
function headerCartCountDisplay() {
    let addToCartResult = $('.add-to-cart-result');
    if (addToCartResult.length > 0 && addToCartResult.data('items-count') > 0) {
        $('.quick-cart').find('.badge.badge-aqua.badge-corner').html(addToCartResult.data('items-count'));
    }
}

/**
 * 计算购物车价格
 */
function calculateCartPrice() {
    $('.item-count').on('change', function () {
        if ($(this).val() > 99) {
            alert('请输入1-99之间的数字！');
            $(this).val(99);
        } else if ($(this).val() < 1) {
            alert('请输入1-99之间的数字！');
            $(this).val(1);
        }

        $.ajax({
            type: 'POST',
            url: $(this).data('update-url'),
            data: {'count': $(this).val(), 'delivery': $('.cart-delivery-country').val()},
            success: function (data) {
                callback(data);
            },
            error: function () {
                alert('request error happened.')
            },
        });
    });
    $('.cart-delivery-country').on('change', function () {
        $.ajax({
            type: 'POST',
            url: $(this).data('update-url'),
            data: {'delivery': $(this).val()},
            success: function (data) {
                callback(data);
            },
            error: function () {
                alert('request error happened.')
            },
        });
    });

    $('.cart-delete-item').on('click', function () {
        let self = $(this);
        let cartCountContainer = $('.badge.badge-aqua.badge-corner');
        $.ajax({
            type: 'POST',
            url: $(this).data('update-url'),
            data: {'delivery': $('.cart-delivery-country').val(), 'action': 'delete'},
            success: function (data) {
                if (data.status) {
                    if (data.data.total === 0)  {
                        self.parents('.cart-form').remove();
                        cartCountContainer.html('');
                        $('.card.card-default.hide-cart-default').removeClass('hide-cart-default');
                    } else  {
                        self.parents('tr').remove();

                        $('.badge.badge-aqua.badge-corner').html(cartCountContainer.html() - 1);
                    }
                }
                callback(data);
            },
            error: function () {
                alert('request error happened.')
            },
        });
    });
    function callback(response) {
        if (response.status) {
            $('.total-budget > span').html(parseFormatNum(response.data.subtotal / 100, 2));
            $('.discount > span').html(parseFormatNum(response.data.discount / 100, 2));
            $('.shipping > span').html(parseFormatNum(response.data.shipping / 100, 2));
            $('.pay-amount > strong > span').html(parseFormatNum(response.data.total / 100, 2));
            $('.item-count').each(function (index, element) {
                $(element).parents('tr').find('.item-price').html(parseFormatNum($(element).val() * $(element).data('sku-price') / 100, 2));
            });
        } else {
            alert(response.message);
        }
    }
}

/**
 * checkout
 */
function checkout() {
    $('.cart-form').on('submit', function () {
        return false;
    });
    $('.cart-checkout-button').on('click', function () {
        let placeholder = $('.self-placeholder');
        placeholder.removeClass('hide');
        let data = {'delivery' : $('.cart-delivery-country').val(), 'data': []};
        $('.item-count').each(function (index, element) {
            data.data.push({'sku': $(element).data('sku'), 'count': $(element).val()});
        });
        $.ajax({
            type: 'POST',
            url: $(this).data('create-order-url'),
            data: data,
            success: function (data) {
                if (data.status) {
                    location.href = data.data.url;
                } else {
                    alert(data.message);
                    placeholder.addClass('hide');
                }
            },
            error: function () {
                alert('Invalid request.');
                placeholder.addClass('hide');

            }
        })
    });
}

/**
 * 金额数字格式化
 * @param number
 * @param n
 * @returns {string}
 */
function parseFormatNum(number, n){
    if(n !== 0 ){
        n = (n > 0 && n <= 20) ? n : 2;
    }
    number = parseFloat((number + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
    let sub_val = number.split(".")[0].split("").reverse();
    let sub_xs = number.split(".")[1];

    let show_html = "";
    for (i = 0; i < sub_val.length; i++){
        show_html += sub_val[i] + ((i + 1) % 3 === 0 && (i + 1) !== sub_val.length ? "," : "");
    }

    if(n === 0 ){
        return show_html.split("").reverse().join("");
    }else{
        return show_html.split("").reverse().join("") + "." + sub_xs;
    }

}

/**
 * over write functions
 * @private
 */
function _topNav() {
    window.scrollTop 		= 0;
    window._cmScroll 		= 0;
    let _header_el 			= jQuery("#header");

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
    let addActiveClass 	= false;
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

    // Page Menu [scrollTo]
    jQuery("#page-menu ul.menu-scrollTo>li").bind("click", function(e) {

        // calculate padding-top for scroll offset
        let _href 	= jQuery('a', this).attr('href');

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
            let _el 					= jQuery("#topNav div.nav-main-collapse"),
                _data_switch_default 	= _el.attr('data-switch-default') 	|| '',
                _data_switch_scroll 	= _el.attr('data-switch-scroll') 	|| '';
        }
        jQuery(window).scroll(function() {
            let _scrollTop 	= jQuery(document).scrollTop();
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
        let didScroll;
        let lastScrollTop 	= 0;
        let delta 			= 5;
        let _header_H 		= _header_el.outerHeight() || 0;
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
            let st = $(this).scrollTop();
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
            let _scrollTop 	= jQuery(document).scrollTop();
            _header_H 	= _header_el.outerHeight() || 0;
            _header_el.addClass('fixed');
        }
        jQuery(window).scroll(function() {
            if((window.width > 992 && _topBar_H < 1) || _topBar_H > 0) { // 992 to disable on mobile
                let _scrollTop 	= jQuery(document).scrollTop();
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
        let is_ie9 = jQuery('html').hasClass('ie9') ? true : false;
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
                let _pos = "left";
            } else
            if(parseInt(_paddingStatusR) < 0) {
                let _pos = "right";
            }
            else {
                let _pos = "left";
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

function _form() {
    /** Form Validate
     LOAD PLUGIN ONLY!
     ************************ **/
    if(jQuery('form.validate-plugin').length > 0) {

        loadScript(plugin_path + 'form.validate/jquery.form.min.js', function() {
            loadScript(plugin_path + 'form.validate/jquery.validation.min.js');
        });

    }

    /** Form Validate
     ************************ **/
    if(jQuery('form.validate').length > 0) {

        loadScript(plugin_path + 'form.validate/jquery.form.min.js', function() {
            loadScript(plugin_path + 'form.validate/jquery.validation.min.js', function() {

                if(jQuery().validate) {

                    jQuery('form.validate').each(function() {

                        let _t 			= jQuery(this);

                        // Append 'is_ajax' hidden input field!
                        _t.append('<input type="hidden" name="is_ajax" value="true" />');

                        _t.validate({
                            submitHandler: function(form) {

                                // Show spin icon
                                jQuery(form).find('.input-group-addon').find('.fa-envelope').removeClass('fa-envelope').addClass('fa-refresh fa-spin');

                                jQuery(form).ajaxSubmit({

                                    target: jQuery(form).find('.validate-result').length > 0 ? jQuery(form).find('.validate-result') : '',

                                    error: function(data) {
                                        jQuery(form).append(alertGenerator("Sent Failed!", false));
                                    },

                                    success: function(data) {
                                        let result = true;

                                        if (data.status) {
                                            // Remove spin icon
                                            jQuery(form).find('.input-group-addon').find('.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-envelope');

                                            // Clear the form
                                            jQuery(form).find('input.form-control').val('');

                                        } else  {
                                            result = false;
                                        }

                                        let alertArea = jQuery('.ajax-form-alert');
                                        alertArea.html('');
                                        alertArea.append(alertGenerator(data.message, result));
                                    }
                                });

                            }
                        });

                    });

                }

            });
        });

    }

    /** Masked Input
     ************************ **/
    let _container = jQuery('input.masked');
    if(_container.length > 0) {

        loadScript(plugin_path + 'form.masked/jquery.maskedinput.js', function() {

            _container.each(function() {

                let _t 				= jQuery(this);
                _format 		= _t.attr('data-format') 		|| '(999) 999-999999',
                    _placeholder 	= _t.attr('data-placeholder') 	|| 'X';

                jQuery.mask.definitions['f'] = "[A-Fa-f0-9]";
                _t.mask(_format, {placeholder:_placeholder});

            });

        });

    }

    function alertGenerator(message, type) {
        let status = type ? 'success' : 'danger';
        let html = '<div class="self-alert alert alert-' + status + ' alert-mini alert-dismissable">';
        html += '<button type="button" class="close btn btn-sm" data-dismiss="alert" aria-hidden="true">&times;</button>';
        html += message + '</div>';
        return html;
    }

}

