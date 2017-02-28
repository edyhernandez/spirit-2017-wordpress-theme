<?php get_header(); ?>

	<div class="row">

		<div class="small-12 large-12 columns">

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
					get_template_part( 'content', get_post_format() );
  
				endwhile; endif; 
			?>

		</div> <!-- /.col -->

	</div> <!-- /.row -->

<?php get_footer(); ?>