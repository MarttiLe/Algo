<?php
    /**
     * RELATED PRODUCTS
     * @param block_classes string (optional) - pass additional classes for the block
     * @param products array (optional) - pass an array of product IDs
     * @param title string (optional) - pass to override the title
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = [
        'title'     => __( 'Products often bought together', 'algorigin-theme' ),
        'items'     => ''
    ];

    if(!empty($args['title'])) {
        $block_data['title'] = $args['title'];
    }

    if(!empty($args['products'])) {
        $block_data['items'] = $args['products'];
    }
?>


<div class="related-products<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['title'])) : ?>
    <h2 class="related-products__title h3"><?php echo $block_data['title']; ?></h2>
    <?php endif; ?>

    <?php if(!empty($block_data['items'])) : ?>
    <ul class="product-list product-list--centered">
        <?php foreach($block_data['items'] as $item) : ?>
            <li class="product-list__item">
                <?php echo get_template_part('templates/components/card-product', null, ['post_id' => $item]); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>