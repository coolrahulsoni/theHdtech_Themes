<?php get_header(); ?>

	
		<div class="  blog-main">

			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
				get_template_part( 'content', get_post_format() );
  
			endwhile; 
			?>
			<nav>
	<ul class="pager">
		<li><?php next_posts_link( 'Previous' ); ?></li>
		<li><?php previous_posts_link( 'Next' ); ?></li>
	</ul>
</nav>
			<?php
			
			endif; 
			?>

		</div> <!-- /.blog-main -->

		<?php // get_sidebar(); ?>

	</div> <!-- /.col-lg-10 -->
	</div> <!-- /.row -->

<?php get_footer(); ?>

<?php //ref site http://themerail.com/wp/theme/appex/home-2/
//http://themerail.com/wp/theme/hillary/
 //?>