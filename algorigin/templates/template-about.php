<?php
    /**
    * Template Name: About page
    */

    $page_data = get_field('contact_options');
?>


<?php get_header(); ?>


<?php
    $has_heading = get_field('display_block_page_heading');
    if($has_heading) {
        $block_attr = [];
        get_template_part('templates/blocks/page-heading', null, $block_attr);
    }
?>


<div class="about">
    <div class="sticky-nav-wrap">

        <?php
            if(get_field('display_block_sticky_navigation_bar')) {
                $block_attr = [];
                get_template_part('templates/blocks/sticky-navigation', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_who_we_are')) {
                $block_attr = [];
                get_template_part('templates/blocks/about-who', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_quality')) {
                $block_attr = [];
                get_template_part('templates/blocks/about-quality', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_ethics')) {
                $block_attr = [];
                get_template_part('templates/blocks/about-ethics', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_responsibility')) {
                $block_attr = [];
                get_template_part('templates/blocks/about-responsibility', null, $block_attr);
            }
        ?>

    </div>
</div>


<?php get_footer(); ?>