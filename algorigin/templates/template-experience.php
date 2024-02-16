<?php
/**
* Template Name: Experience page
*/
?>

<?php get_header(); ?>


<?php
    $has_heading = get_field('display_block_page_heading');
    if($has_heading) {
        $block_attr = [];
        get_template_part('templates/blocks/page-heading', null, $block_attr);
    }
?>


<div class="page-content">
     
    <?php if(!$has_heading) : ?>
    <h1 class="page-content__title h1"><?php the_title(); ?></h1>    
    <?php endif; ?>

    <div class="editor-content">
        <?php the_content(); ?>
    </div>

    <?php
        if(get_field('display_block_ambassadors')) {
            $block_attr = [];
            get_template_part('templates/blocks/ambassadors', null, $block_attr);
        }
    ?>

</div>


<?php get_footer(); ?>