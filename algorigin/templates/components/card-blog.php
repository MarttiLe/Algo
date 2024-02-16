<?php
    /**
     * BLOG POST CARD
     * @param post_id int (optional) - pass post ID to get a specific post, otherwise global wp $post object will be used
     * @param block_classes string (optional) - pass additional classes for the element
    **/

    if(!empty($args['post_id']) && is_int($args['post_id'])) {
        $post = get_post($args['post_id']);
        $id = $args['post_id'];
    } else {
        global $post;
        $id = $post->ID;
    }
    if(empty($post) || is_wp_error($post)) {
        return;
    }

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    $featured_img = get_post_thumbnail_id($id);
    if(!empty($featured_img)) {
        $featured_img = theme_get_wp_image($featured_img, 'blog-thumb', 'blog-card__img', __('Blog post photo', 'algorigin-theme'));
    } else {
        $featured_img = theme_get_wp_image(get_field('placeholder_img_blog', 'options'), 'blog-thumb', 'blog-card__img', __('Blog post photo', 'algorigin-theme'));
    }

    $categories = get_the_terms($id, 'category');

    $post_data = [
        'id'                => $id,
        'title'             => $post->post_title,
        'excerpt'           => theme_get_excerpt(false, 175),
        'url'               => get_permalink($id),
        'image'             => $featured_img,
        'categories'        => $categories
    ];
?>


<div class="blog-card<?php echo $block_classes; ?>">
    <div class="blog-card__inner">

        <div class="blog-card__image">
            <a href="<?php echo $post_data['url']; ?>" class="blog-card__anchor"><?php echo $post_data['image']; ?></a>
        </div>

        <?php if(!empty($post_data['categories'])) : ?>
        <ul class="blog-card__categories label-list">
            <?php foreach($post_data['categories'] as $category) : ?>
            <li class="label-list__item"><div class="label"><?php echo $category->name; ?></div></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <h3 class="blog-card__title h4"><?php echo $post_data['title']; ?></h3>
        <p class="blog-card__excerpt"><?php echo $post_data['excerpt']; ?></p>

        <div class="blog-card__actions actions">
            <div class="actions__item">
                <a href="<?php echo $post_data['url']; ?>" class="blog-card__more button button--color-accent button--icon-right button--icon-animated"><?php echo __( 'Read more', 'algorigin-theme' ); ?><?php icon_svg('arrow-right'); ?></a>
            </div>
        </div>

    </div>
</div>