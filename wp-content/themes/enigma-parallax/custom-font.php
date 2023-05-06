<style> 	

 	<?php $font_enable = absint(get_theme_mod('enigma_parallax_show_Google_Fonts', 1));
 	//echo $font_enable;
 	     if($font_enable==1) { ?>
/*  for body css */
body, input, textarea, p {
font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
}
/*  for heading css */
h1, h2, h3, h4, h5, h6 {
   font-family: <?php echo esc_attr(get_theme_mod('font_family')); ?>!important;

}
.menu li a{
	font-family: <?php echo esc_attr(get_theme_mod('font_family')); ?>!important;
}
.enigma_blog_thumb_wrapper h2{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family')); ?>!important;
 }
 .enigma_blog_thumb_wrapper p{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family')); ?>!important;
 }
 .wp-block-group__inner-container{
		font-family: <?php echo esc_attr(get_theme_mod('font_family')); ?>!important;
	}
.enigma_sidebar_widget ul li a {
	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;

	}
	
 .carousel-text h1 .animated{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;

 }
 .carousel-list li{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;

 }
.enigma_footer_area p{
	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
}
 .enigma_service_detail h3 a{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 .enigma_service_detail p{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 .customize-unpreviewable{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 
 a .enigma_blog_read_btn{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 .enigma_team_section .pos{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 h3 .team_{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 .enigma_callout_area p{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 .enigma_callout_btn{
 	font-family: <?php echo esc_attr(get_theme_mod('font_family2')); ?>!important;
 }
 
<?php } ?>


</style>
