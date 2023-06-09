<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="enigma_blog_full">
	<?php if ( has_post_thumbnail() ): 
	$defalt_arg = array('class' => "enigma_img_responsive"); 
	?>
		<div class="enigma_blog_thumb_wrapper_showcase">						
			<div class="enigma_blog-img">
			<?php the_post_thumbnail( 'enigma-parallax-page-thumb', $defalt_arg ); ?>						
			</div>						
		</div>
	<?php endif; ?>
	<div class="enigma_blog_post_content">
		<?php the_content( esc_html__( 'Read More' , 'enigma-parallax' ) ); 
		wp_link_pages( ); ?>
	</div>
</div>	
<div class="push-right">
	<hr class="blog-sep header-sep">
</div>
<?php comments_template( '', true );
endwhile;
endif;
?>