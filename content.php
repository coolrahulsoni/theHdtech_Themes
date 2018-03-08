<div class="blog-post">
		
				
			<?php if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail() ) ) { 
				$post_thumbnail_id = get_post_thumbnail_id();
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
				?>
				<div class="post-image ">
					<img title="image title" alt="thumb image" class="wp-post-image pull-left paddingr20" src="<?php echo $post_thumbnail_url; ?>" width="285" height="285">
				</div>
			<?php } ?>
		<?php 
		
		
		/*
			if ( has_post_thumbnail() ) {
			the_post_thumbnail('thumbnail', array('class' => 'img-fluid img-responsive'));;
		} */
		?>
	<h4 class="blog-post-title fntjosefin"><a href="<?php //the_permalink(); ?>"><?php the_category(); ?></a></h4>
	<h2 class="blog-post-title fntjosefin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
	<a href="<?php comments_link(); ?>">
	<?php
	printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( 						get_comments_number() ) ); ?>
</a>
 <?php echo content(50); ?>

</div><!-- /.blog-post -->