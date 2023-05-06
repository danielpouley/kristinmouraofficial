<?php get_header();
$class            = ''; 
$page_header = absint(get_theme_mod( 'page_header', 1 )); 
if ( $page_header == 1 ) {
	get_template_part('breadcrums'); 
} else {
	$class = 'no-page-header';
} ?>
<?php //echo get_theme_mod('font_family2'); ?>
<?php $project_cpt_service_Font_Icon_Value= get_post_meta( $post->ID, '_enigma_parallax_sidebar_layout', true ); 
   ?>
<div class="container">
	<div class="row enigma_blog_wrapper <?php echo esc_attr( $class ); ?>">
		<?php if (   $project_cpt_service_Font_Icon_Value === "left-sidebar") : ?>
        		
        			<?php get_sidebar(); ?>
        	
		<div class="col-md-8">
			<?php get_template_part('template-parts/post','page'); ?>	
		</div>
		<?php endif;?>


		<?php if (   $project_cpt_service_Font_Icon_Value === "right-sidebar") : ?>
        		
        			
		<div class="col-md-8">
			<?php get_template_part('template-parts/post','page'); ?>	
		</div>
		<?php get_sidebar(); ?>
        	
		<?php endif;?>


        <?php if (   $project_cpt_service_Font_Icon_Value == null) : ?>
        		
        			
		<div class="col-md-8">
			<?php get_template_part('template-parts/post','page'); ?>	
		</div>
		<?php get_sidebar(); ?>
        	
		<?php endif;?>     

		<?php if (   $project_cpt_service_Font_Icon_Value === "no-sidebar") : ?>
        		
        			
		<div class="col-md-12">
			<?php get_template_part('template-parts/post','page'); ?>	
		</div>
        	
		<?php endif;?>
	</div>
</div>	
<?php get_footer(); ?>