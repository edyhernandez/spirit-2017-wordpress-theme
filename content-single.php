<div class="blog-post">
    <h2 class="blog-post-title"><?php the_title(); ?></h2>
    <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    
<!-- The following adds a featured image if there is one selected in the wordpress admin before the main content of a single post -->
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    } ?>

    <?php the_content(); ?>

</div><!-- /.blog-post -->