<?php //Template Name:Full-Width Page
get_header();
$class = ''; 
$page_header = absint(get_theme_mod( 'page_header', 1 ));
if ( $page_header == 1 ) { 
	get_template_part('page_header'); 
} else { 
	$class = 'no-page-header';
} ?>
<div class="container">
	<div class="row enigma_blog_wrapper <?php echo esc_attr( $class ); ?>">
	<div class="col-md-12">
	<?php get_template_part('template-parts/post','page'); ?>	
	</div>		
	</div>
</div>	
<?php get_footer(); ?>