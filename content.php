<div class="blog-post">
	<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a> - <a href="<?php comments_link(); ?>">
	<?php
            printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( 						get_comments_number() ) ); ?>
        </a></p>

<!-- This allows me to show the featured image as part of the blog post summary on the main blog page of my website! -->        
<?php if ( has_post_thumbnail() ) {?>
	<div class="row">
		<div class="medium-4 columns">
			<?php	the_post_thumbnail('thumbnail'); ?>
		</div>
		<div class="medium-6 columns">
			<?php the_excerpt(); ?>
		</div>
	</div>
	<?php } else { ?>
	<?php the_excerpt(); ?>
	<?php } ?>
<!-- End featured image as part of blog post summary code! -->

<!-- <?php the_excerpt(); ?> -->

</div><!-- /.blog-post -->
