<?php
    /**
     * ENDORSEMENT
     * @param block_classes string (optional) - pass additional classes for the block
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = get_field('block_endorsement');

    $bg_style = '';
    if(!empty($block_data['image'])) {
        $block_data['image'] = wp_get_attachment_image_url($block_data['image'], '720p');
        $bg_style = ' style="background-image: url('. $block_data['image'] .');"';
    }
?>


<div class="endorsement<?php echo $block_classes; ?>">
    <div class="endorsement__inner">
        <div class="endorsement__content">
            <blockquote class="endorsement__quote">
                <?php echo $block_data['text']; ?>
                <cite><?php echo $block_data['name']; ?></cite>
            </blockquote>
        </div>

        <?php if(!empty($block_data['image'])) : ?>
        <div class="endorsement__image"<?php echo $bg_style; ?>>&nbsp;</div>
        <?php endif; ?>
    </div>
</div>