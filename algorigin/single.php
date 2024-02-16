<?php get_header(); ?>


<?php
    $featured_image = ''; //get_post_thumbnail_id();

    $sidebar_title = get_field('featured_products_title');
    $featured_products = get_field('featured_products');
    $sidebar_classes = '';
    if(!empty($featured_products)) {
        $featured_products_count = count($featured_products);
        if($featured_products_count === 1) {
            $sidebar_classes = ' page-content--sidebar-sticky';
        }
    }


    // PAGE HEADING
    $block_attr = [
        'skip_acf_data'     => true,
        'title'             => get_the_title(),
        'color_scheme'      => 'light',
        'image'             => $featured_image
    ];
    get_template_part('templates/blocks/page-heading', null, $block_attr);
?>


<?php if(empty($featured_products)) : ?>

    <div class="page-content">
        <div class="container container--sm">

            <div class="editor-content">
                <?php the_content(); ?>
            </div>

            <div class="page-content__socials">
                <?php get_template_part('templates/components/social-share'); ?>
            </div>

        </div>
    </div>

<?php else : ?>

    <div class="page-content page-content--has-sidebar page-content--sidebar-right page-content--mobile-sidebar-keep<?php echo $sidebar_classes; ?>">
        <div class="container container--md">
            <div class="page-content__inner">

                <div class="page-content__aside">
                    <div class="page-content__sidebar">
                        <?php
                            $block_attr = [
                                'products'  => $featured_products,
                                'title'     => $sidebar_title,
                            ];
                            get_template_part('templates/components/sidebar-featured-products', null, $block_attr);
                        ?>
                    </div>
                </div>

                <div class="page-content__main">
                    <div class="editor-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="page-content__socials">
                        <?php get_template_part('templates/components/social-share'); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php endif; ?>

<?php get_template_part('templates/blocks/related-posts'); ?>


<?php get_footer(); ?>