<?php 
    /**
     * FEATURED PRODUCTS
     * @param block_classes string (optional) - pass additional classes for the block
     * @param products array (optional) - pass an array of product IDs
     * @param title string (optional) - pass to override the title
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = [
        'title'     => __( 'Featured in this article', 'algorigin-theme' ),
        'items'     => ''
    ];
    
    if(!empty($args['title'])) {
        $block_data['title'] = $args['title'];
    }

    if(!empty($args['products'])) {
        $block_data['items'] = $args['products'];
    }
?>


<div class="sidebar-featured-products<?php echo $block_classes; ?>">
    <div class="sidebar-featured-products__title"><?php echo $block_data['title']; ?>:</div>

    <?php if(!empty($block_data['items'])) : ?>
    <ul class="sidebar-featured-products__items">
        <?php foreach($block_data['items'] as $product_item) : ?>
        <li class="sidebar-featured-products__item">
            <?php get_template_part('templates/components/card-product', null, ['post_id' => $product_item]); ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>