<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta charset="<?php bloginfo('charset'); ?>" />
    <base href="/">
	<?php wp_head(); ?>
</head>
<body <?php  $box_layout = absint(get_theme_mod('box_layout', '1')) ; if (  $box_layout == '2' ) { body_class('boxed'); } else body_class(); ?>>
<?php   
if ( function_exists( 'wp_body_open' ) )
wp_body_open();
?>
<div>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'enigma-parallax' ); ?></a>
	<!-- Header Section -->
	<div class=" home-menu-list">
	<div class="header_section affix-top transition">
		<div class="container" id="header">
			<!-- Logo & Contact Info -->
			<div class="row ">
				<?php 
				$title_position = absint(get_theme_mod('title_position'));
				if ( $title_position == 1 ) { ?>
					<div class="col-md-6 col-sm-12 wl_rtl" >					
						<div claSS="logo logocenter">		
						
						<?php
						if ( has_custom_logo() ) {  
							the_custom_logo(); 
					    } 
						if ( display_header_text()==true ) { ?>  
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					 			<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
					 		</a>
						<?php } ?>
						
						<?php if ( display_header_text()==true ) { ?>
							<p><?php  bloginfo( 'description' ) ; ?></p>
						<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-md-6 col-sm-12 wl_rtl" >					
						<div claSS="logo">						
							<?php 
							if ( has_custom_logo() ) { 
								the_custom_logo();  
							}  
							if ( display_header_text()==true ) {
							?> 
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							 	<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1></a>
							 <?php }  ?>
							
							<?php if ( display_header_text() == true ) { ?>
								<p><?php  bloginfo( 'description' ) ; ?></p>
							<?php } ?>
						</div>
					</div>
				<?php }  ?>
				<div class="col-md-6 col-sm-12">
					<?php 
					$email_id = get_theme_mod('email_id');
	                $phone_no = get_theme_mod('phone_no');
					if ( ! empty ( $email_id ) || ! empty ( $phone_no ) ) { ?>
						<ul class="head-contact-info">
							<?php if ( ! empty ( $email_id ) ) { ?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr( $email_id  ); ?>"><?php echo esc_html( $email_id  ); ?></a></li><?php } ?>
							<?php if ( ! empty ( $phone_no ) ) { ?><li><i class="fa fa-phone"></i><a href="tel:<?php echo esc_attr( $phone_no); ?>"><?php echo esc_html( $phone_no ); ?></a></li><?php } ?>
						</ul>
					<?php } 
					$header_social_media_in_enabled = absint(get_theme_mod( 'header_social_media_in_enabled', 1 ));
					if ( $header_social_media_in_enabled == 1 ) { ?>
						<ul class="social">
							<?php 
							$fb_link = get_theme_mod('fb_link');
							if ( ! empty ( $fb_link ) ) { ?>
							   <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Facebook",'enigma-parallax') ?>"><a  href="<?php echo esc_url( get_theme_mod( 'fb_link' ) ); ?>"><i class="fab fa-facebook-f"></i></a></li>
							<?php } 
							$twitter_link = get_theme_mod('twitter_link');
							if ( ! empty ( $twitter_link ) ) { ?>
								<li class="twitter" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Twitter",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'twitter_link' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
							<?php } 
							$linkedin_link = get_theme_mod('linkedin_link');
							if ( ! empty ( $linkedin_link ) ) { ?>					
								<li class="linkedin" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Linkedin",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'linkedin_link' ) ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
							<?php } 
							$youtube_link = get_theme_mod('youtube_link');
							if ( ! empty ( $youtube_link ) ) { ?>
								<li class="youtube" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Youtube",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'youtube_link' ) ) ; ?>"><i class="fab fa-youtube"></i></a></li>
			                <?php } 
			                $instagram = get_theme_mod('instagram');
			                if ( ! empty ( $instagram ) ) { ?>
								<li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("instagram",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'instagram' ) ) ; ?>"><i class="fab fa-instagram"></i></a></li>
			                <?php } 
			                $vk_link = get_theme_mod('vk_link');
			                if ( ! empty ( $vk_link ) ) { ?>
								<li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("vk",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'vk_link' ) ) ; ?>"><i class="fab fa-vk"></i></a></li>
			                <?php } 
			                $qq_link = get_theme_mod('qq_link');
			                if ( ! empty ( $qq_link ) ) { ?>
								<li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("qq",'enigma-parallax') ?>"><a href="<?php echo esc_url( get_theme_mod( 'qq_link' ) ) ; ?>"><i class="fab fa-qq"></i></a></li>
							<?php } ?>
						</ul>
					<?php } ?>	
					<?php 
					if ( get_theme_mod( 'search_box' ) == 1 ) { ?>
						<div class="col-md-6 col-sm-12 header_search">
						 	<?php get_search_form(); ?>
						</div>
					<?php } ?>
				</div>
				
			</div>
			<!-- /Logo & Contact Info -->
		</div>	
	</div>	
	<!-- /Header Section -->
	<!-- Navigation  menus -->
	<?php
	if ( get_theme_mod( 'side_menu_option' )  == "both" || get_theme_mod( 'side_menu_option' ) == 'both_id' || get_theme_mod( 'side_menu_option' ) == "main" || has_nav_menu( 'primary' ) ) {
	?>
		<div class="navigation_menu transition"   id="enigma_nav_top">
			<span id="header_shadow"></span>
			
			<div class="container navbar-container" >
				<nav id="site-navigation" class="main-navigation navbar" role="navigation">
	                <div class="navbar-header">
	                    <button id="nav-tog" type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu" aria-controls="#menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','enigma-parallax')?>">
	                        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'enigma-parallax'); ?></span>
	                        <span class="fas fa-bars"></span>
	                    </button>
	                </div>
	                <div id="menu" class="collapse navbar-collapse ">
	                     <?php
	                    wp_nav_menu( array(
	                        'theme_location' => 'primary',
	                        'menu_id'        => 'primary-menu',
	                        'fallback_cb'    => 'enigma_parallax_fallback_page_menu',
	                        'walker'         => new enigma_parallax_nav_walker(),
	                    ) );
	                    ?>
	                </div>
	            </nav>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php
	if ( get_theme_mod('side_menu_option')  == "both" || get_theme_mod( 'side_menu_option' ) == "side" || has_nav_menu( "SIDEER" ) ) {
		?>
	
			<div class="home_menu">
				<div id="scroll_menu">
					<div id='cssmenu'>
						<?php			  
							wp_nav_menu( array(
								'theme_location' => 'SIDEER',
								'menu_class'     => 'side-menu',
								'menu'           => 'side', // This will be different for you.
								'walker'         => new enigma_parallax_Menu_Maker_Walker()
								)
							);	
						?>
					</div>
				</div>
				<div class="scroll_toggle">
					<i class="far fa-arrow-alt-circle-right" id="bt1" onclick="setVisibility( 'scroll_menu' ); "></i>
				</div>
			</div><!--class=home_menu-->
	
		
		<?php
		
	} elseif ( get_theme_mod( 'side_menu_option' )  == "side_id" || get_theme_mod( 'side_menu_option' ) == 'both_id' ) {
	?>
		<div class="home_menu-2">
			<div id="scroll_menu-2">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" data-toggle="tooltip" title="Home"><i class="fa fa-home"></i></a><br />
				<?php 
				$slider_home = absint(get_theme_mod( 'slider_home', 1 ));
				if ( $slider_home == 1 ) { ?>
					<a href="<?php if ( !is_home() ) { echo esc_url( home_url( '/' ) ); } ?>#slider" class="btn " data-toggle="tooltip" title="<?php esc_attr_e("Slider",'enigma-parallax'); ?>"><i class="far fa-caret-square-right"></i></i></a><br />
				<?php } 
				$services_home = absint(get_theme_mod( 'services_home', 1 ));
				if ( $services_home == 1 ) { ?>
					<a href="<?php if ( !is_home() ) { echo esc_url( home_url( '/' ) ); } ?>#service" class="btn " data-toggle="tooltip" title="<?php esc_attr_e("Service",'enigma-parallax'); ?>"><i class="fab fa-yelp"></i></a><br />
				<?php } 
				$portfolio_home = absint(get_theme_mod( 'portfolio_home', 1 ));
				if ( $portfolio_home == 1 ) { ?>
					<a href="<?php if ( !is_home() ) { echo esc_url( home_url( '/' ) ); } ?>#portfolio" class="btn " data-toggle="tooltip" title="<?php esc_attr_e("Portfolio",'enigma-parallax'); ?>"><i class="far fa-image"></i></a><br />
				<?php }
				$blog_home = absint(get_theme_mod( 'blog_home', 1 )); 
				if ( $blog_home == 1 ) { ?>
					<a href="<?php if ( !is_home() ) { echo esc_url( home_url( '/' ) ); } ?>#blog" class="btn" data-toggle="tooltip" title="<?php esc_attr_e("Blog",'enigma-parallax'); ?>"><i class="fa fa-book"></i></a><br />
				<?php } 
				$team_home = absint(get_theme_mod( 'team_home', 1 ));
				if ( $team_home == 1 ) { ?>
					<a href="<?php if ( !is_home() ) { echo esc_url( home_url( '/' ) ); } ?>#team" class="btn " data-toggle="tooltip" title="<?php esc_attr_e("Team",'enigma-parallax'); ?>"><i class="fa fa-users"></i></a><br/>
				<?php } ?>		
			</div>	
			<div class="scroll_toggle-2">
				<i class="far fa-arrow-alt-circle-right" id="bt1" onclick="setVisibility( 'scroll_menu-2' ); "></i>
			</div>
		</div><!--class=home_menu-->	
	<?php
	} ?>
	<div id="content" class="site-content">