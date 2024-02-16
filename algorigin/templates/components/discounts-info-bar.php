<?php
    /**
     * DISCOUNTS INFO BAR
     * @param block_classes string (optional) - pass additional classes for the block
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = get_field('discounts_info', 'options');
?>


<?php if(!empty($block_data)) : ?>
<div class="message-bar<?php echo $block_classes; ?>">
    <?php
        if ( USER_REGION === 'CH' ) {
            if(!empty($block_data['quantity_text_ch'])) {
                echo $block_data['quantity_text_ch'];
            }
            if(!empty($block_data['delivery_text_ch'])) {
                echo '<br>' . $block_data['delivery_text_ch'];
            }
        } else {
            if(!empty($block_data['quantity_text'])) {
                echo $block_data['quantity_text'];
            }
            if(!empty($block_data['delivery_text'])) {
                echo '<br>' . $block_data['delivery_text'];
            }
        }
    ?>
</div>
<?php endif; ?>