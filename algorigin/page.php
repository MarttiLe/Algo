<?php get_header(); ?>

    
<?php
    $has_heading = get_field('display_block_page_heading');
    if($has_heading) {
        $block_attr = [];
        get_template_part('templates/blocks/page-heading', null, $block_attr);
    }
?>


<div class="page-content">
    <div class="container">

        <div class="editor-content">
            <?php if(!$has_heading) : ?>
            <h1 class="page-content__title h1"><?php the_title(); ?></h1>    
            <?php endif; ?>

            <?php the_content(); ?>
        </div>

    </div>
</div>


<?php get_footer(); ?>