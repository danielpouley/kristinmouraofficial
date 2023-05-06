<?php
/**
 * The template for displaying Tags Posts
 *
 * @package enigma-parallax
 */

get_header();
$class            = '';
$breadcrumb = absint(get_theme_mod( 'page_header', 1 ));
if ( $breadcrumb == 1 ) {
	get_template_part('breadcrums'); 
} else {
	$class = 'no-page-header';
} 
?>
<div class="container">	
	<div class="row enigma_blog_wrapper <?php echo esc_attr( $class ); ?>">
		<div class="col-md-8">
			<?php 
			if ( have_posts()): 
			while ( have_posts() ): the_post();
				get_template_part('template-parts/post','content'); ?>	
			<?php endwhile; 
			endif; 
			?>
			<div class="text-center wl-theme-pagination">
		        <?php the_posts_pagination() ; ?>
		        <div class="clearfix"></div>
		    </div>
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>