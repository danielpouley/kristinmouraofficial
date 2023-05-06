<?php 
	function enigma_parallax_scripts() {      
		wp_enqueue_style('bootstrap', get_template_directory_uri() .'/css/bootstrap.css');
		/*
		$color=get_theme_mod('color_title');
        if($color==""){
        wp_enqueue_style('enigma-default', get_template_directory_uri() . '/css/default.css');
        }
        if($color=="green"){
        wp_enqueue_style('green', get_template_directory_uri() .'/css/colors/green.css');
            }
        if($color=="orange"){
        wp_enqueue_style('orange', get_template_directory_uri() .'/css/colors/orange.css');
            }

        if($color=="Blue"){
        wp_enqueue_style('Blue', get_template_directory_uri() .'/css/colors/Blue.css');
            }
        if($color=="Indigo"){
        wp_enqueue_style('Indigo', get_template_directory_uri() .'/css/colors/Indigo.css');
            }
        if($color=="Pink"){
        wp_enqueue_style('Pink', get_template_directory_uri() .'/css/colors/Pink.css');
            }
        if($color=="Yellow"){
        wp_enqueue_style('Yellow', get_template_directory_uri() .'/css/colors/Yellow.css');
            }
        if($color=="Red"){
        wp_enqueue_style('Red', get_template_directory_uri() .'/css/colors/Red.css');
            } */
       // if($color=="default"){
        wp_enqueue_style('enigma-default', get_template_directory_uri() . '/css/default.css');
        //} 

		wp_enqueue_style('enigma-parallax-theme', get_template_directory_uri() . '/css/enigma-theme.css');
		wp_enqueue_style('enigma-parallax-media-responsive', get_template_directory_uri() . '/css/media-responsive.css');
		wp_enqueue_style('enigma-parallax-animations', get_template_directory_uri() . '/css/animations.css');
		wp_enqueue_style('enigma-parallax-theme-animtae', get_template_directory_uri() . '/css/theme-animate.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome-5.11.2/css/all.css');
		wp_enqueue_style( '_FA611', get_template_directory_uri() . '/css/fa611/css/all.min.css' );
		wp_enqueue_style('swiper', get_template_directory_uri() .'/css/swiper.css'); 
		wp_enqueue_style('enigma-parallax-style-sheet', get_stylesheet_uri());
		/* Web Fonts */		
        wp_enqueue_style('enigma-parallax-google-fonts',esc_url(enigma_parallax_fonts_url()));
		
		// Js
		wp_enqueue_script('popper-js', get_template_directory_uri() .'/js/popper.js', array('jquery'), true, true );
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() .'/js/bootstrap.js', array('jquery'), true, true );
		// Load if  mobile
        if (  wp_is_mobile() ) {
			wp_enqueue_script( 'enigma-parallax-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), true, true );
		}
		wp_enqueue_script('enigma-parallax-menu', get_template_directory_uri() .'/js/menu.js', array('jquery'), true, true );
		wp_enqueue_script('enigma-parallax-enigma-theme-script', get_template_directory_uri() .'/js/enigma-theme-script.js', array('jquery'), true, true );

		if( ! is_home() && is_front_page() ) {

			/*PhotoBox JS*/
			wp_enqueue_script('enigma-parallax-photobox-js', get_template_directory_uri() .'/js/jquery.photobox.js', array('jquery'), true, true );
			wp_enqueue_style('enigma-parallax-photobox', get_template_directory_uri() . '/css/photobox.css', array('jquery'), true, true );

			/*Carofredsul Slides*/
			wp_enqueue_script('caroufredsel', get_template_directory_uri() .'/js/caroufredsel-6.2.1/jquery.caroufredsel-6.2.1.js', array('jquery'), true, true );
			wp_enqueue_script('caroufredsel-element', get_template_directory_uri() .'/js/caroufredsel-6.2.1/caroufredsel-element.js', array('jquery'), true, true );
			wp_enqueue_script('swiper', get_template_directory_uri() .'/js/swiper.js', array('jquery'), true, true );

			
			
			//Footer JS//
			wp_enqueue_script('enigma-parallax-footer-script', get_template_directory_uri() .'/js/enigma-footer-script.js', array('jquery'), true, true );	

			$slider_image_speed = get_theme_mod('slider_image_speed' );
			if ( ! empty ( $slider_image_speed ) ) {
	            $image_speed = absint(get_theme_mod( 'slider_image_speed', '1000' ));
	            $speed       = true;
	        } else {
	            $image_speed = '';
	            $speed       = false;
	        }

	        $ajax_data = array(
	            'blog_speed'    => absint(get_theme_mod( 'blog_speed', '2000' )),
	            'autoplay'      => absint(get_theme_mod( 'autoplay', 1 )),
	            'image_speed'   => $image_speed,
	            'sticky_header' => absint(get_theme_mod( 'sticky_header', 0)),
	            'speed'         => $speed,
	        );

	        wp_enqueue_script( 'enigma-ajax-front', get_template_directory_uri() . '/js/frontend-ajax.js', array( 'jquery' ), true, true );
	        wp_localize_script( 'enigma-ajax-front', 'ajax_admin', array(
	                'ajax_url'      => admin_url( 'admin-ajax.php' ),
	                'admin_nonce'   => wp_create_nonce( 'admin_ajax_nonce' ),
	                'ajax_data'     => $ajax_data,
	        ) );
	    }
	    wp_enqueue_script('waypoints', get_template_directory_uri() .'/js/waypoints.js', array('jquery'), true, true );				
		wp_enqueue_script('enigma-parallax-scroll', get_template_directory_uri() .'/js/scroll.js', array('jquery'), true, true );
	
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	}
	add_action('wp_enqueue_scripts', 'enigma_parallax_scripts');
	
	function enigma_parallax_upload_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload-media-widget', get_template_directory_uri(). '/js/upload-media.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }
	add_action('admin_enqueue_scripts', 'enigma_parallax_upload_scripts');

	if ( ! function_exists( 'enigma_parallax_fonts_url' ) ) :
    /**
     * Register Google fonts.
     *
     * Create your own enigma_parallax_fonts_url() function to override in a child theme.
     *
     * @since league 1.0
     *
     * @return string Google fonts URL for the theme.
     */
	    function enigma_parallax_fonts_url()
	    {
	        $fonts_url = '';
	        $fonts     = array();

	        if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'enigma-parallax' ) )
	        {
	            $fonts[] = 'Open+Sans:600,700';
	        }
	        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'enigma-parallax' ) )
	        {
	            $fonts[] = 'Roboto:700';
	        }
	        if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'enigma-parallax' ) )
	        {
	            $fonts[] = 'Raleway:600';
	        }
	        

	        if ( $fonts ) {
	            $fonts_url = add_query_arg( array(
	                'family' => urlencode( implode( '|', $fonts ) ),
	            ), 'https://fonts.googleapis.com/css' );
	        }

	        return esc_url_raw( $fonts_url );
	    }
	endif;