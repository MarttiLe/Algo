<?php
/**
* Template Name: Algae page
*/
?>

<?php get_header(); ?>


<?php 
    // Redirect to the first child if /algae/ parent page
    global $post;
    if($post->post_parent === 0) {
        $pages = get_posts([
            'post_type'     => 'page',
            'numberposts'   => 1,
            'post_parent'   => $post->ID,
            'orderby'       => 'menu_order',
            'order'         => 'ASC'
        ]);
        if(!empty($pages)) {
            $redirect_url = get_permalink($pages[0]->ID);
        } else {
            $redirect_url = home_url();
        }
        
        wp_safe_redirect($redirect_url, 301);
        return;
    }
?>


<?php
    $has_heading = get_field('display_block_page_heading');
    if($has_heading) {
        $block_attr = [];
        get_template_part('templates/blocks/page-heading', null, $block_attr);
    }
?>


<div class="page-content page-content--has-sidebar page-content--mobile-sidebar-keep">
    <div class="container">

        <div class="page-content__inner">
            <div class="page-content__aside">
                <div class="drawer drawer--page-nav js-drawer" data-drawer-id="sidebar-nav">
                    <div class="drawer__inner">
                        <div class="drawer__content">

                            <div class="page-content__sidebar">
                                <?php
                                    get_template_part('templates/components/sidebar-algae-pages');
                                ?>
                            </div>

                        </div>

                        <button class="drawer__toggle js-drawer-toggle js-floating-drawer-toggle" data-drawer-id="sidebar-nav" title="<?php echo __( 'Open page navigation', 'algorigin-theme' ); ?>"><?php icon_svg('caron-left', 'drawer__open-icon'); ?><?php echo icon_svg('caron-down', 'drawer__close-icon'); ?></button>
                    </div>
                </div>
            </div>

            <div class="page-content__main">
                
                <?php if(!$has_heading) : ?>
                <h1 class="page-content__title h1"><?php the_title(); ?></h1>    
                <?php endif; ?>

                <div class="editor-content">
                    <?php the_content(); ?>
                </div>

                <?php
                    if(get_field('display_block_endorsement')) {
                        echo '<div class="separator separator--md">&nbsp;</div>';

                        $block_attr = [];
                        get_template_part('templates/components/endorsement', null, $block_attr);
                    }
                ?>

                <?php
                    if(get_field('display_block_article_blocks')) {
                        echo '<div class="separator separator--md">&nbsp;</div>';

                        $block_attr = [];
                        get_template_part('templates/components/article-blocks', null, $block_attr);
                    }
                ?>

                <?php
                    if(get_field('display_block_shop_preview')) {
                        echo '<div class="separator separator--lg">&nbsp;</div>';
                        
                        $block_attr = [
                            'block_classes'     => 'shop-preview--mini',
                            'skip_container'    => true
                        ];
                        get_template_part('templates/blocks/shop-preview', null, $block_attr);
                    }
                ?>

            </div>
        </div>

    </div>
</div>


<?php get_footer(); ?>