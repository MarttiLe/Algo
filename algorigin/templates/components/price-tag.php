<?php
    /**
     * PRICE TAG
     * @param block_classes string (optional) - pass additional classes for the block
     * @param product_id int (optional) - pass to get data from a specific product via ID
     * @param title string (optional) - pass to show a title 
     * @param hide_old_price bool (optional) - pass to hide the old price in the event that the product is discounted
     * 
    **/

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $price_data = '';
    if(!empty($args['price_data'])) {
        $price_data = $args['price_data'];
    } else {
        if(!empty($args['product_id'])) {
            $price_data = theme_get_product_price_data($args['product_id'], true);
        } else {
            global $post;
            $price_data = theme_get_product_price_data($post->ID, true);
        }
    }

    $title = false;
    if(!empty($args['title'])) {
        $title = $args['title'];
    }

    $hide_old_price = false;
    if(!empty($args['hide_old_price'])) {
        $hide_old_price = true;
    }
?>


<div class="price<?php echo $block_classes; ?>">
    <?php if(!empty($title)) : ?>
        <div class="price__title"><?php echo $title; ?>:</div>
    <?php endif; ?>

    <div class="price__main">
        <?php if(!empty($price_data['sale_price'])) : ?>
            <span class="price__new"><?php echo $price_data['final_price']; ?></span>
            
            <?php if(!$hide_old_price) : ?>
                <del class="price__old"><?php echo $price_data['regular_price']; ?></del>
            <?php endif; ?>
        <?php else : ?>
            <span class="price__standard"><?php echo $price_data['final_price']; ?></span>
            
        <?php endif; ?>
    </div>
</div>