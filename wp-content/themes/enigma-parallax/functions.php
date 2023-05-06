<?php
/** Theme Name    : Enigma-Parallax
 * Theme Core Functions and Codes
*/

/* Get the plugin */
if ( ! function_exists( 'enigma_parallax_theme_is_companion_active' ) ) {
    function enigma_parallax_theme_is_companion_active() {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active(  'weblizar-companion/IS-theme-companion.php' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**Includes required resources here**/
require( get_template_directory() . '/core/menu/default_menu_walker.php' );
require( get_template_directory() . '/core/menu/enigma_parallax_nav_walker.php' );
require( get_template_directory() . '/core/menu/enigma_parallax_nav_side_walker.php' );//side menu
require( get_template_directory() . '/core/scripts/css-js.php' ); //Enquiring Resources here
require( get_template_directory() . '/core/comment-function.php' );
require( get_template_directory() . '/class-tgm-plugin-activation.php' );
require get_template_directory()  . '/core/custom-header.php';
require get_template_directory()  . '/upgrade-to-pro/class-customize.php';



/*After Theme Setup*/
add_action( 'after_setup_theme', 'enigma_parallax_head_setup' );
function enigma_parallax_head_setup() {
	global $content_width;
	//content width
	if ( ! isset( $content_width ) ) {
		$content_width = 550;
	} //px

	 /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Theme Palace, use a find and replace
     * to change 'enigma-parallax' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'enigma-parallax' );

	/* Enable support for Woocommerce */
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	//Blogs thumbs
	add_image_size( 'enigma-parallax-page-thumb', 730, 350, true );
	add_image_size( 'enigma-parallax-blog-2c-thumb', 570, 350, true );
	add_theme_support( 'title-tag' );

	// Logo
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	// Load text domain for translation-ready

	add_theme_support( 'post-thumbnails' ); //supports featured image
	// This theme uses wp_nav_menu() in one location.

	// theme support
	$args = array( 'default-color' => '000000' );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );

	/* Gutenberg */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Add editor style. */
	add_theme_support( 'editor-styles' );
	add_theme_support( 'dark-editor-style' );

	/* Enable support for HTML5 */
	add_theme_support( 'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	*/
	add_editor_style( 'css/editor-style.css' );

}

// Read more tag to formatting in blog page
function enigma_parallax_content_more( $more ) {
	return '<div class="blog-post-details-item"><a class="enigma_blog_read_btn" href="' . esc_url( get_permalink() ) . '"><i class="fa fa-plus-circle"></i>"' . esc_html__( 'Read More', 'enigma-parallax' ) . '"</a></div>';
}

add_filter( 'the_content_more_link', 'enigma_parallax_content_more' );


// Replaces the excerpt "more" text by a link
function enigma_parallax_excerpt_more( $more ) {
	if ( is_admin() ) {
		return '';
	}
}

add_filter( 'excerpt_more', 'enigma_parallax_excerpt_more' );

/*
* enigma-parallax widget area
*/
add_action( 'widgets_init', 'enigma_parallax_widgets_init' );
function enigma_parallax_widgets_init() {
	/*sidebar*/
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'enigma-parallax' ),
		'id'            => 'sidebar-primary',
		'description'   => esc_html__( 'The primary widget area', 'enigma-parallax' ),
		'before_widget' => '<div class="enigma_sidebar_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="enigma_sidebar_widget_title"><h2>',
		'after_title'   => '</h2></div>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'enigma-parallax' ),
		'id'            => 'footer-widget-area',
		'description'   => esc_html__( 'footer widget area', 'enigma-parallax' ),
		'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="enigma_footer_widget_title">',
		'after_title'   => '<div class="enigma-footer-separator"></div></div>',
	) );
}

/* Breadcrumbs  */
function enigma_parallax_breadcrumbs() {
	$delimiter = '';
    $home = esc_html__('Home', 'enigma-parallax'); // text for the 'Home' link
   
    echo '<ul class="breadcrumb">';
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>' . esc_html($delimiter) . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
      
        echo '<li>' .  esc_html__("Archive by category","enigma-parallax")  . single_cat_title('', false) . '"' . '</li>';
        
    } elseif (is_day()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_time('d')) . '</li>';
    } elseif (is_month()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_time('F')) . '</li>';
    } elseif (is_year()) {
        echo '<li>' . esc_html(get_the_time('Y')) . '</li>';
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . esc_url($homeLink) . '/' . esc_url($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a></li> ' . esc_html($delimiter) . ' ';
            echo '<li>' . esc_html(get_the_title()) . '</li>';
        } else {
            echo '<li>' . wp_kses_post(get_the_title()) . '</li>';
        }

    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo '<li>' . esc_html($post_type->labels->singular_name) .'</li>';
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_page() && !$post->post_parent) {
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . wp_kses_post(get_the_title($page->ID)) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo wp_kses_post($crumb) . ' ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_search()) {
        echo '<li>' . esc_html_e("Search results for", "enigma-parallax") . get_search_query() . '"' . '</li>';

    } elseif (is_tag()) {
        echo '<li>' . esc_html_e('Tag', 'enigma-parallax') . single_tag_title('', false) . '</li>';
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo '<li>' . esc_html_e("Articles posted by", "enigma-parallax") . esc_html($userdata->display_name) . '</li>';
    } elseif (is_404()) {
        echo '<li>' . esc_html_e("Error 404", "enigma-parallax") . '</li>';
    }
    echo '</ul>';
}
/*===================================================================================
* Add Class Gravtar
* =================================================================================*/
add_filter( 'get_avatar', 'enigma_parallax_gravatar_class' );

function enigma_parallax_gravatar_class( $class ) {
	$class = str_replace( "class='avatar", "class='author_detail_img", $class );

	return $class;
}

/****--- Navigation for Author, Category , Tag , Archive ---***/
function enigma_parallax_navigation() { ?>
    <div class="enigma_blog_pagination">
        <div class="enigma_blog_pagi">
			<?php posts_nav_link(); ?>
        </div>
    </div>
<?php }

/****--- Navigation for Single ---***/
function enigma_parallax_navigation_posts() { ?>
    <div class="navigation_en">
        <nav id="wblizar_nav">
			<span class="nav-previous">
			<?php previous_post_link( '&laquo; %link' ); ?>
			</span>
            <span class="nav-next">
			<?php next_post_link( '%link &raquo;' ); ?>
			</span>
        </nav>
    </div>
	<?php
}


add_action( 'tgmpa_register', 'enigma_parallax_plugin_recommend' );
function enigma_parallax_plugin_recommend() {
	$plugins = array(
		array(
			'name'     => esc_html__('IS-theme-companion','enigma-parallax'),
			'slug'     => 'weblizar-companion',
			'required' => false,
		),
	);
	tgmpa( $plugins );
}

/*===================================================================================
	* DISPLAY LOCATION
	* =================================================================================*/
function enigma_parallax_register_my_menus() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'enigma-parallax' ) );
	register_nav_menus(
		array(
			'SIDEER' => esc_attr( 'SIDE MENU' ),
		)
	);
}

add_action( 'init', 'enigma_parallax_register_my_menus' );


/*
add_action( 'wp_enqueue_scripts', 'enigma_parallax_custom_css' );
function enigma_parallax_custom_css() {

	$output = '';

	$output .= ".swiper-slide-active .animation.animated-item-2 {
	    animation: 1200ms linear 900ms normal both 1 running " . get_theme_mod( 'animate_type_title' ) . ";
	    }
	.swiper-slide-active .animation.animated-item-3 {
	  animation: 1200ms linear 900ms normal both 1 running " . get_theme_mod( 'animate_type_desc' ) . ";
	  }";

	if ( get_theme_mod( 'slider_home', 1 ) != 1 ) {
		$output .= ".service__section{
			padding-top:240px !important;
		}";
	}

	if ( get_theme_mod( 'slider_home', 1 ) != 1 && get_theme_mod( 'service_home', 1 ) != 1 ) {
		$output .= ".portfolio__section{
			padding-top:240px !important;
		}";
	}

	if ( get_theme_mod( 'slider_home', 1 ) != 1 && get_theme_mod( 'service_home', 1 ) != 1 && get_theme_mod( 'portfolio_home', 1 ) != 1 ) {
		$output .= ".enigma_blog_area{
			padding-top:240px !important;
			border-top:0px solid !important;
		}";
	}

	if ( get_theme_mod( 'slider_home', 1 ) != 1 && get_theme_mod( 'service_home', 1 ) != 1 && get_theme_mod( 'portfolio_home', 1 ) != 1 && get_theme_mod( 'show_testimonial', 1 ) != 1 ) {
		$output .= ".enigma_team_section{
			padding-top:240px !important;
			border-top:0px solid !important;
		}";
	}

	if ( get_theme_mod( 'slider_home', 1 ) != 1 && get_theme_mod( 'service_home', 1 ) != 1 && get_theme_mod( 'portfolio_home', 1 ) != 1 && get_theme_mod( 'show_blog', 1 ) != 1 && get_theme_mod( 'show_team', 1 ) != 1 ) {
		$output .= ".enigma_callout_area{
			padding-top:240px !important;
			border-top:0px solid !important;
		}";
	}

	$output     .='
    .logo img{
        height:'.esc_attr(get_theme_mod('logo_height','55')).'px;
        width:'.esc_attr(get_theme_mod('logo_width','150')).'px;
    }';
    
	$output     .='
    .enigma_blog_area{
        background-image:url('.esc_url( get_theme_mod( 'upload__blog_image' ) ).');
    }';

	//custom css
	$custom_css = get_theme_mod( 'custom_css' );
	if ( ! empty ( $custom_css ) ) {
		$output .= get_theme_mod( 'custom_css' ) . "\n";
	}

	wp_register_style( 'custom-header-style', false );
	wp_enqueue_style( 'custom-header-style', get_template_directory_uri() . '/css/custom-header-style.css' );
	wp_add_inline_style( 'custom-header-style', $output );
}
 */










add_action('wp_enqueue_scripts', 'wp_enigna_parallax_custom_css');
function wp_enigna_parallax_custom_css()
{
    $Theme_Color_Enigma_Parallax = get_theme_mod( 'color_title', '#666' ); 

    $output = '';

    $output      .= '
    
    a,a:hover, .service a.ser-link,
    .enigma_fuul_blog_detail_padding h2 a,
    .wl-theme-pagination a.page-numbers,
    .wl-theme-pagination span.page-numbers,
    .enigma_service_area:hover .enigma_service_iocn i,
    .enigma_service_area:focus .enigma_service_iocn i,
    .enigma_service_iocn_2 i,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:hover,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:focus,.enigma_proejct_button a:hover,
.enigma_proejct_button a:focus,.enigma-project-detail-sidebar .launch-enigma-project a:hover,
.enigma-project-detail-sidebar .launch-enigma-project a:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a:hover,
.enigma_gallery_showcase .enigma_gallery_showcase_icons a:focus,.enigma_blog_thumb_wrapper h2 a,.enigma_blog_thumb_date li i,.enigma_blog_thumb_wrapper h2:hover a,.enigma_blog_thumb_date li i,.enigma_blog_thumb_wrapper h2:focus a ,.enigma_cats a i,.enigma_tags a i,.enigma_blog_thumb_wrapper span a i,.carousel-text .enigma_blog_read_btn:hover,
.carousel-text .enigma_blog_read_btn:focus,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:hover,
.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:focus,.enigma_blog_comment:hover h6,
.enigma_blog_comment:hover i,
.enigma_blog_comment:focus h6,
.enigma_blog_comment:focus i,
.enigma_fuul_blog_detail_padding h2,
.enigma_fuul_blog_detail_padding h2 a,
.enigma_fuul_blog_detail_padding h2 a:hover,
.enigma_fuul_blog_detail_padding h2 a:focus,
.enigma_recent_widget_post h3 a,
.enigma_sidebar_link p a:hover,.enigma_sidebar_widget ul li a:hover,
.enigma_sidebar_link p a:focus,.enigma_sidebar_widget ul li a:focus,.reply a,.breadcrumb li a,.enigma_testimonial_area i,
.enigma_footer_widget_column ul li a:hover,.enigma_footer_widget_column ul li a:focus,.enigma_carousel-next i,.enigma_carousel-prev i,.enigma_team_showcase .enigma_team_showcase_icons a:hover,
.enigma_team_showcase .enigma_team_showcase_icons a:focus,.enigma_contact_info li .desc,.enigma_dropcape_simple span,.enigma_blog_read_btn:hover, .enigma_blog_read_btn:focus,.scroll_toggle
{
        color: ' . esc_attr( $Theme_Color_Enigma_Parallax ) . ';
    }';


    $output      .='
    .header_section, .pos,
    #btn-to-top,.wl-theme-pagination span.page-numbers.current,.hd_cover,.collapse ul.nav li.current-menu-item .dropdown-toggle,
.collapse ul.nav li.current-menu-parent .dropdown-toggle,
.collapse ul.nav li.current_page_ancestor .dropdown-toggle,
.navbar-default .navbar-collapse ul.nav li.current-menu-item .dropdown-toggle .collapse ul.nav li.current_page_ancestor .dropdown-toggle,
.navbar-default .navbar-collapse ul.nav li.current-menu-parent .dropdown-toggle,.navbar-default .navbar-collapse ul.nav li.current_page_ancestor .dropdown-toggle,.enigma_service_iocn,.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a,.enigma_home_portfolio_caption:hover,
.enigma_home_portfolio_caption:focus,.img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption,.enigma_carousel-next:hover,
.enigma_carousel-prev:hover,
.enigma_carousel-next:focus,
.enigma_carousel-prev:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a,.enigma_cats a:hover,
.enigma_tags a:hover,
.enigma_cats a:focus,
.enigma_tags a:focus,.enigma_blog_read_btn,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a,
.enigma_post_date,.enigma_sidebar_widget_title,.enigma_widget_tags a:hover,.enigma_widget_tags a:focus,.tagcloud a:hover,.tagcloud a:focus,.enigma_author_detail_wrapper,.btn-search ,#enigma_send_button:hover,#enigma_send_button:focus,.enigma_send_button:hover,.enigma_send_button:focus,.pager a.selected,
.enigma_blog_pagi a.active,.enigma_blog_pagi a:hover,.enigma_blog_pagi a:focus,.nav-pills>li.active>a:focus,.nav-stacked>li.active>a,.nav-stacked>li.active>a:focus,
    .nav-stacked>li.active>a:hover,
    .nav-stacked>li.active>a:focus,.navbar-default .navbar-toggle:focus,
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus,
    .navbar-toggle,.enigma_client_next:hover,.enigma_client_next:focus,.enigma_client_prev:hover,
.enigma_client_prev:focus,.enigma_team_showcase .enigma_team_showcase_icons a,.enigma_team_caption:hover,.enigma_team_caption:focus,.enigma_team_wrapper:hover .enigma_team_caption,.enigma_callout_area,.enigma_footer_area,.enigma_dropcape_square span,.enigma_dropcape_circle span,.progress-bar,.btn-search,.dropdown-menu .active a, .navbar .nav-menu>.active>a, .navbar .nav-menu>.active>a:focus, .navbar .nav-menu>.active>a:hover, .navbar .nav-menu>.open>a, .navbar .nav-menu>.open>a:focus, .navbar .nav-menu>.open>a:hover, .navbar .nav-menu>li>a:focus, .navbar .nav-menu>li>a:hover,.carousel-list li,.main-navigation a:hover, .main-navigation li:focus-within a,.main-navigation ul ul,#cssmenu ul > li > a,#enigma_nav_top ul li.current-menu-parent, #enigma_nav_top ul li.current-menu-item
    {
        background-color:' . esc_attr( $Theme_Color_Enigma_Parallax ) . ';
    }';

    $output      .='#cssmenu ul > li > a
    {
    background: linear-gradient(' . esc_attr( $Theme_Color_Enigma_Parallax ) . ', ' . esc_attr( $Theme_Color_Enigma_Parallax ) . ');}
    ';

    $output      .='
        .service .enigma_service_detail:hover a.ser-link,
        .service .enigma_service_detail:focus a.ser-link 
    {
        background-color:' . esc_attr( $Theme_Color_Enigma_Parallax ) . ';
    }';



    $output      .='
        .btn-search
    {
        background:' . esc_attr( $Theme_Color_Enigma_Parallax ) .'!important'. ';
    }';

    $output      .='
    .enigma_con_textarea_control:focus,.enigma_contact_input_control:focus,.enigma_contact_textarea_control:focus,.enigma_panel-blue,.enigma_panel-blue>.panel-heading,#enigma_send_button,.enigma_send_button
    {
        border-color:' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .navigation_menu  
    {
        border-top:2px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

   
    
    $output      .='
    .img-circle, .img-circle:hover, .img-circle:focus  
    {
        border:10px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';




    $output      .='
    .img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption
    {
        border-left:1px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .enigma_sidebar_widget,.enigma_author_detail_wrapper,.enigma_blockquote_section blockquote
    {
        border-left:3px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .enigma_sidebar_widget
    {
        border-right:3px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption
    {
        border-right:1px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .enigma_heading_title h3,.enigma_heading_title2 h3,.enigma_home_portfolio_caption,.img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption,.enigma_blog_thumb_wrapper,.enigma_sidebar_widget
    {
        border-bottom:4px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .wl-theme-pagination span.page-numbers.current,.wl-theme-pagination a.page-numbers,.enigma_widget_tags a:hover,.enigma_widget_tags a:focus,.tagcloud a:hover,.tagcloud a:focus,.navbar-toggle
    {
        border:1px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' !important;
    }';

    $output      .='
    .enigma_testimonial_area img
    {
        border:10px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .=' 
    .enigma_send_button , #enigma_send_button,.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:hover,
.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:focus,.enigma_proejct_button a,
.enigma_carousel-next,.enigma_carousel-prev,
.enigma_proejct_button a:hover,
.enigma_carousel-next,.enigma_carousel-prev,
.enigma_proejct_button a:focus,.enigma_portfolio_detail_pagi li a,.enigma_portfolio_detail_pagi li a:hover,
.enigma_portfolio_detail_pagi li a:focus,.enigma-project-detail-sidebar .launch-enigma-project a,.enigma-project-detail-sidebar .launch-enigma-project a:hover,
.enigma-project-detail-sidebar .launch-enigma-project a:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a,.enigma_gallery_showcase .enigma_gallery_showcase_icons a:hover,
.enigma_gallery_showcase .enigma_gallery_showcase_icons a:focus,.enigma_blog_read_btn,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:hover,
.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:focus,#enigma_send_button:hover,#enigma_send_button:focus,.enigma_send_button:hover,.enigma_send_button:focus,.pager a,.pager a.selected,.enigma_client_next,.enigma_client_prev,.enigma_team_showcase .enigma_team_showcase_icons a,.enigma_team_showcase .enigma_team_showcase_icons a:hover,
.enigma_team_showcase .enigma_team_showcase_icons a:focus
    {
        border:2px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    .enigma_service_iocn,.enigma_service_iocn_2 i,.nav-pills>li>a,.nav-stacked>li>a ,.enigma_client_wrapper:hover,.enigma_client_wrapper:focus
    {
        border:4px solid' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';

    $output      .='
    
    {
        box-shadow: 0px 0px 12px ' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }'; 

    $output      .='
   
    {
        box-shadow: 0 0 14px 0 ' . esc_attr( $Theme_Color_Enigma_Parallax ) . ' ;
    }';
    
    $output     .='
    .logo img{
        height:'.esc_attr(get_theme_mod('logo_height','55')).'px;
        width:'.esc_attr(get_theme_mod('logo_width','150')).'px;
    }';


    //custom css
    $custom_css = get_theme_mod('custom_css') ; 
    if (!empty ($custom_css)) {
        $output .= get_theme_mod('custom_css') . "\n";
    }

    wp_register_style('custom-header-style', false);
    wp_enqueue_style('custom-header-style', get_template_directory_uri() . '/css/custom-header-style.css');
    wp_add_inline_style('custom-header-style', $output);
}








//////////////////////////////////////////////////////////////////////////////////////
//        sidebar
//////////////////////////////////////////////////////////////////////////////////////


function enigma_parallax_add_sidebar_layout_box(){
    $post_id   = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $template  = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = array( 'templates/blossom-portfolio.php' ); //@todo change the template accordingly if it's a raratheme's theme.
    
    //for post
    add_meta_box( 
        'enigma_parallax_sidebar_layout',
        __( 'Sidebar Layout', 'enigma_parallax' ),
        'enigma_parallax_sidebar_layout_callback', 
        'post',
        'normal',
        'high'
    );

    if( ! in_array( $template, $templates ) ){
        add_meta_box( 
            'enigma_parallax_sidebar_layout',
            __( 'Sidebar Layout', 'enigma_parallax' ),
            'enigma_parallax_sidebar_layout_callback', 
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'enigma_parallax_add_sidebar_layout_box' );

$enigma_parallax_sidebar_layout = array(    
    
    'no-sidebar'     => array(
         'value'     => 'no-sidebar',
         'label'     => __( 'Full Width', 'enigma_parallax' ),
         'thumbnail' => esc_url( get_stylesheet_directory_uri() . '/images/full-width.png' )
    ),
        
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
         'label'     => __( 'Left Sidebar', 'enigma_parallax' ),
         'thumbnail' => esc_url( get_stylesheet_directory_uri() . '/images/left-sidebar.png' )         
    ),
    'right-sidebar' => array(
         'value'     => 'right-sidebar',
         'label'     => __( 'Right Sidebar', 'enigma_parallax' ),
         'thumbnail' => esc_url( get_stylesheet_directory_uri() . '/images/right-sidebar.png' )         
     )    
);


function enigma_parallax_sidebar_layout_callback(){
    global $post , $enigma_parallax_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'enigma_parallax_nonce' ); ?> 
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'enigma_parallax' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php  
                    foreach( $enigma_parallax_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_enigma_parallax_sidebar_layout', true ); ?>

                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="enigma_parallax_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table> 
<?php 
}


function enigma_parallax_save_sidebar_layout( $post_id ){
    global $enigma_parallax_sidebar_layout;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'enigma_parallax_nonce' ] ) || !wp_verify_nonce( $_POST[ 'enigma_parallax_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    if( 'page' == $_POST['post_type'] ){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }

    $layout = isset( $_POST['enigma_parallax_sidebar_layout'] ) ? sanitize_key( $_POST['enigma_parallax_sidebar_layout'] ) : 'default-sidebar';

    if( array_key_exists( $layout, $enigma_parallax_sidebar_layout ) ){
        update_post_meta( $post_id, '_enigma_parallax_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, '_enigma_parallax_sidebar_layout' );
    }
}
add_action( 'save_post' , 'enigma_parallax_save_sidebar_layout' );




 
//Save meta box content.

// @param int $post_id Post ID
 
function enigma_parallax_Wp_Blog_Post_Sidebar_Type_Save_Value_Function( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!

   global $post;
 
    if(isset($_POST["project_font_icon"])):
         
        update_post_meta($post->ID, 'Project_Select_Option_Font_Icon_Meta_Key_Value', $_POST["project_font_icon"]);
     
    endif;
} 
add_action( 'save_post', 'enigma_parallax_Wp_Blog_Post_Sidebar_Type_Save_Value_Function' ); 