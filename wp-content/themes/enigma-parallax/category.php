<?php
/**
 * The template for displaying Category Posts
 *
 * @package enigma-parallax
 */

get_header();
$class            = '';
$page_header = absint(get_theme_mod( 'page_header', 1 ));
if ( $page_header == 1 ) {  
?>
<div class="enigma_header_breadcrum_title">	
	<div class="container">
		<div class="row">
		<?php if(have_posts()) :?>
			<div class="col-md-12">
			<h1><?php /* translators: %s: category name */
			printf( esc_html__( 'Category Archives: %s', 'enigma-parallax' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			</h1>
			</div>
		<?php endif; ?>	
		</div>
	</div>	
</div>
<?php } else {
	$class = 'no-page-header';
} ?>
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