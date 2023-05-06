jQuery(document).ready(function() {
	
	
	jQuery('li.dropdown').find('.fa-angle-down').each(function(){
		jQuery(this).on('click', function(){
			if( jQuery(window).width() < 767) {
				jQuery(this).parent().next().slideToggle();
			}
			return false;
		});
	});
	});

	//sidemenu
	( function( jQuery ) {
	jQuery( document ).ready(function() {			
			jQuery('li.has-sub').find('.fa-angle-down').each(function(){
			jQuery(this).on('click', function(){			
				event.preventDefault()
				jQuery(this).parent().next().slideToggle();			
				//return false;
			
			});
		});

		jQuery('#cssmenu>ul>li.has-sub>a').append('<span class="holder"></span>');
	});

	jQuery(document).ready(function() {
      jQuery(".navbar").accessibleDropDown();
  	});

  	jQuery.fn.accessibleDropDown = function () {
    var el = jQuery(this);

    /* Make dropdown menus keyboard accessible */

      jQuery("a", el).focus(function() {
          jQuery(this).parents("li").addClass("focus");
      }).blur(function() {
          jQuery(this).parents("li").removeClass("focus");
      });
  	}

	function enigma_parallax_toggle_icon_burger() {

	    const list = document.querySelectorAll(".nav-menu li a");

        // get first element to be focused inside modal
        const firstFocusableElement = document.getElementById('nav-tog');
        
        const logo = document.querySelector('.logo a');
        // get last element to be focused inside modal
        const last = list[list.length - 1];
        const lastFocusableElement = last;

        document.addEventListener('keydown', function (e) {
            let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

            if (!isTabPressed) {
                return;
            }

            if(event.shiftKey && event.keyCode == 9 && document.activeElement === firstFocusableElement) { 
            	
            	logo.focus();
                e.preventDefault();
            }

            // if shift key pressed for shift + tab combination
            if (e.shiftKey) {
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus();
                    e.preventDefault();
                }
            } else {

                if (document.activeElement === lastFocusableElement) {

                    firstFocusableElement.focus();
                    e.preventDefault();
                }
            }
        });
	}
	enigma_parallax_toggle_icon_burger();
} )( jQuery );