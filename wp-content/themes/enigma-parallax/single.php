<?php
/**
 * The Template for displaying all single posts.
 *
 * @package enigma-parallax
 */

get_header();
$class            = ''; 
$page_header = absint(get_theme_mod( 'page_header', 1 ));
if ( $page_header == 1 ) {
	get_template_part('breadcrums');
} else {
	$class = 'no-page-header';
} 
?>
<div class="container">	
	<?php $project_cpt_service_Font_Icon_Value= get_post_meta( $post->ID, '_enigma_parallax_sidebar_layout', true ); ?>
	<div class="row enigma_blog_wrapper <?php echo esc_attr( $class ); ?>">
      
		<?php if (   $project_cpt_service_Font_Icon_Value === "left-sidebar") : ?>
			<?php get_sidebar(); ?>	
		<div class="col-md-8">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				get_template_part('template-parts/post','content'); 
			endwhile; 
			else : 
				get_template_part('template-parts/nocontent');
			endif;
			enigma_parallax_navigation_posts();
			
			?>
			<?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
		</div>
		<?php endif; ?>


		<?php if (   $project_cpt_service_Font_Icon_Value === "right-sidebar") : ?>
			
		<div class="col-md-8">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				get_template_part('template-parts/post','content'); 
			endwhile; 
			else : 
				get_template_part('template-parts/nocontent');
			endif;
			enigma_parallax_navigation_posts();
			
			?>
			<?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
		</div>
		<?php get_sidebar(); ?>	
		<?php endif; ?>


          <?php if (   $project_cpt_service_Font_Icon_Value == null) : ?>
			
		<div class="col-md-8">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				get_template_part('template-parts/post','content'); 
			endwhile; 
			else : 
				get_template_part('template-parts/nocontent');
			endif;
			enigma_parallax_navigation_posts();
			
			?>
			<?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
		</div>
		<?php get_sidebar(); ?>	
		<?php endif; ?>


		<?php if (   $project_cpt_service_Font_Icon_Value === "no-sidebar") : ?>
			
		<div class="col-md-12">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				get_template_part('template-parts/post','content'); 
			endwhile; 
			else : 
				get_template_part('template-parts/nocontent');
			endif;
			enigma_parallax_navigation_posts();
			
			?>
			<?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
		</div>
		<?php endif; ?>
	</div> <!-- row div end here -->	
</div><!-- container div end here -->
<?php get_footer(); ?>