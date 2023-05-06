<?php
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses enigma_parallax_header_style()
 */
function enigma_parallax_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'enigma_parallax_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'enigma_parallax_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'enigma_parallax_custom_header_setup' );

if ( ! function_exists( 'enigma_parallax_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see wp_news_custom_header_setup().
 */
function enigma_parallax_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image      = get_header_image();
	$custom_css = "";
	
	    if ( ! display_header_text() ) {
	    	$custom_css = "
	            .logo h1,.logo h1:hover {
				color: rgba(241, 241, 241, 0);
				position:absolute;
				clip: rect(1px 1px 1px 1px);
				}
				.logo p {
				color: rgba(241, 241, 241, 0);
				position:absolute;
				clip: rect(1px 1px 1px 1px);
				}";
	    } else {
	    	$custom_css = ".logo h1, .logo p {
				color: #".esc_attr( $header_text_color ).";
			}";
	    }

	    if ( has_header_image() ) { 
	    	$custom_css .= ".header_section{
	    		background-image: url(".$header_image.");
	    		background-size:cover;
			}";
	    } 
	     wp_enqueue_style(
	        'custom-header-style1',
	        get_template_directory_uri() . '/css/custom-header-style.css'
	    );
	    wp_add_inline_style( 'custom-header-style1', $custom_css );
	} 
endif; 