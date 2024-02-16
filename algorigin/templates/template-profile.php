<?php
/**
* Template Name: Profile page (Login, register, dashboard)
*/
?>


<?php get_header(); ?>


<div class="page-content profile">
    <div class="container">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

    </div>
</div>


<?php get_footer(); ?>