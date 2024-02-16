<?php
    /**
    * Template Name: Espace PRO
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


<div class="espace">
    <div class="sticky-nav-wrap">

        <?php
            if(get_field('display_block_sticky_navigation_bar')) {
                $block_attr = [];
                get_template_part('templates/blocks/sticky-navigation', null, $block_attr);
            }
        ?>

        <?php
            if(get_field('display_block_featured_course')) {
                $block_attr = [];
                get_template_part('templates/blocks/pro-featured', null, $block_attr);
            }
        ?>

        <?php
            if(get_field('display_block_courses')) {
                $block_attr = [];
                get_template_part('templates/blocks/pro-courses', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_doctors')) {
                $block_attr = [];
                get_template_part('templates/blocks/pro-doctors', null, $block_attr);
            }
        ?>


        <?php
            if(get_field('display_block_vendors')) {
                $block_attr = [];
                get_template_part('templates/blocks/pro-vendors', null, $block_attr);
            }
        ?>

    </div>
</div>


<?php get_footer(); ?>