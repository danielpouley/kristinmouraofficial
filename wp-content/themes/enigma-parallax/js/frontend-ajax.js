jQuery(document).ready(function () {
    'use strict';

    if ( ajax_admin.ajax_data.speed == true ) {
        jQuery(document ).ready(function( $ ) {
            jQuery("#myCarousel" ).carousel({
                interval:parseInt( ajax_admin.ajax_data.image_speed )
            });
        });
    }

    if ( ajax_admin.ajax_data.speed == true ) {
		var slide_autoplay = ajax_admin.ajax_data.image_speed;
	} else {
		var slide_autoplay = 2500;
	}

    var mySwiper = new Swiper ('.swiper-container', {
	    pagination: '.swiper-pagination',
		paginationClickable: true,
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		autoplay: slide_autoplay,
		loop: true,
		loopAdditionalSlides: 2,
		loopedSlides: 2,
		slidesPerView: 'auto',
		keyboardControl: true,
		mousewheelControl: true,
		mousewheelForceToAxis: true,
		watchSlidesVisibility: true,
		reloadImages: false,
		lazyLoading: true,
	});

	if ( ajax_admin.ajax_data.autoplay == '1' ) {
		var blog_autoplay = true;
	} else {
		var blog_autoplay = false;
	}

	var wl_caroufredsel = function () {             
	   // jQuery CarouFredSel  For blog                  
	    jQuery('#enigma_blog_section').wl_caroufredsel({
	        width: '100%',
	        responsive: true,
	       scroll : {
	            items : 1,
	            duration : ajax_admin.ajax_data.blog_speed,
	            timeoutDuration : 2000
	        },
	        circular: blog_autoplay,
	        direction: 'left',
	        items: {
	            height: 'variable',
				width: 380,
	            visible: {
	                min: 1,
	                max: 3
	            },
	            
	       },
	         prev: '#port-prev',
	        next: '#port-next',
	        auto: {
	            play: blog_autoplay,
	        }
	    });
	}
	jQuery(window).resize(function () {
	    wl_caroufredsel();
	});   
	jQuery(window).load(function () {
	    wl_caroufredsel();
	}); 

	if ( ajax_admin.ajax_data.sticky_header == '1' ) {
		jQuery(window).scroll(function () {
			if( jQuery(window).width() > 768) {
				if (jQuery(this).scrollTop() > 0) {
					jQuery('.home-menu-list').addClass('sticky-head');
				}
				else {
					jQuery('.home-menu-list').removeClass('sticky-head');
				}
			}
			else {
				if (jQuery(this).scrollTop() > 250) {
					jQuery('.home-menu-list').addClass('sticky-head');
				}else {
					jQuery('.home-menu-list').removeClass('sticky-head');
				}
			}				
		});
	}

});