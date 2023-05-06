<div id="post-<?php the_ID(); ?>" <?php post_class('enigma_blog_full'); ?>>
	<ul class="blog-date-left">
		<li class="enigma_post_date">
			<span class="date"><?php the_date(); ?></span>
		</li>
		<li class="enigma_post_author"><?php echo wp_kses_post(get_avatar( get_the_author_meta( 'ID' ) ,96 )); ?></li>
		<li class="enigma_blog_comment"><i class="fa fa-comments-o"></i><h6><?php comments_popup_link( '0', '1', '%', '', '-'); ?></h6></li>
	</ul>
	<div class="post-content-wrap">
		<?php if ( has_post_thumbnail() ): 
		$img = array( 'class' => 'enigma_img_responsive' ); ?>
		<div class="enigma_blog_thumb_wrapper_showcase">						
			<div class="enigma_blog-img">
				<?php the_post_thumbnail( 'enigma-parallax-blog-2c-thumb', $img ); ?>					
			</div>
			<?php if ( is_home() ) : ?>
				<div class="enigma_blog_thumb_wrapper_showcase_overlay">
					<div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
						<div class="enigma_blog_thumb_wrapper_showcase_icons">
							<a href="<?php the_permalink() ; ?>">
								<i class="fa fa-link"></i>
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="enigma_fuul_blog_detail_padding">
		<h2><?php if ( ! is_single() ) { ?><a href="<?php the_permalink() ; ?>"><?php } ?><?php the_title(); ?></a></h2>
		<div class="row">
		<div class="col-md-6 col-sm-3">
		<?php if ( get_the_tag_list() != '' ) { ?>
		<p class="enigma_tags"><?php the_tags( __( 'Tags : ', 'enigma-parallax' ), '', '<br />' ); ?></p>
		<?php } ?>
		</div>
		<div class="col-md-6 col-sm-3">
		<?php if ( get_the_category_list() != '' ) { ?>
		<p class="enigma_cats"><?php echo esc_html__( "Category : ", 'enigma-parallax' );
		the_category(' , '); ?></p>
		<?php } ?>
		</div>
		</div>
		<?php the_content( esc_html__( 'Read More' , 'enigma-parallax' ) ); 
		$defaults = array(
              'before'           => '<div class="enigma_blog_pagination"><div class="enigma_blog_pagi">' . esc_html__( 'Pages:','enigma-parallax'  ),
              'after'            => '</div></div>',
	          'link_before'      => '',
	          'link_after'       => '',
	          'next_or_number'   => 'number',
	          'separator'        => ' ',
	          'nextpagelink'     => esc_html__( 'Next page'  ,'enigma-parallax' ),
	          'previouspagelink' => esc_html__( 'Previous page' ,'enigma-parallax'),
	          'pagelink'         => '%',
	          'echo'             => 1
	          );
	          wp_link_pages( $defaults ); ?>
		</div>
	</div>
</div>	
<div class="push-right">
<hr class="blog-sep header-sep">
</div>