<?php
    /**
     * NUTRITIONIST APPOINTMENT CTA
     * @param block_classes string (optional) - pass additional classes for the block
     * @param title string (optional) - pass to override the title
     * @param text string (optional) - pass to override the text
     * @param button_text string (optional) - pass to override the button text
     * @param button_link string (optional) - pass URL to override the button link
    **/

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $title = __( 'Not sure what to choose?', 'algorigin-theme' );
    $text = __( 'Our nutritional experts can help you decide which algae would be the best fit for you.', 'algorigin-theme' );
    $button_link = get_field('products', 'options');
    $button_text = __( 'Contact us', 'algorigin-theme' );
?>


<div class="nutritionist-cta<?php echo $block_classes; ?>">
    <div class="nutritionist-cta__inner">
        <h2 class="nutritionist-cta__title h3"><?php echo $title; ?></h2>
        <p class="nutritionist-cta__text"><?php echo $text; ?></p>

        <div class="nutritionist-cta__actions">
            <a href="<?php echo $button_link['nutritionist_cta_link']; ?>" rel="noopener" class="nutritionist__link button button--color-accent button--icon-left"><?php echo icon_svg('phone'); ?><?php echo $button_text; ?></a>
        </div>
    </div>
</div>