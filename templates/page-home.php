<?php /* Template Name: Spirit Home Page Template */ ?>

<?php get_header(); ?>

<div class="content">
	<!-- The following brings in content from the Wordpress back end into the front end -->
	<?php
		if ( have_posts() ) while ( have_posts() )
		{
			the_post();
			the_content();
		}
	?>
</div>

<?php get_template_part('partials/footer-home'); ?>