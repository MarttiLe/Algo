<?php
    /**
     * ABOUT PAGE QUALITY BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_quality');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(!empty($block_data['image'])) {
        $block_data['image'] = wp_get_attachment_image_url($block_data['image'], '720p');
    }
?>


<section class="quality<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--sm">
        <div class="quality__inner">
            <?php if(!empty($block_data['content'])) : ?>
            <h2 class="quality__title h2"><?php echo $block_data['title']; ?></h2>
            <?php endif; ?>

            <?php if(!empty($block_data['content'])) : ?>
            <p class="quality__subtitle"><?php echo $block_data['subtitle']; ?></p>
            <?php endif; ?>
        </div>

        <?php if(!empty($block_data['image'])) : ?>
        <div class="quality__image" style="background-image:url(<?php echo $block_data['image']; ?>);">&nbsp;</div>
        <?php endif; ?>

        <div class="quality__cols">
            <?php if(!empty($block_data['content']['column_1']['text'])) : ?>
            <div class="quality__col">
                <?php if(!empty($block_data['content']['column_1']['lead'])) : ?>
                <h3 class="quality__lead"><?php echo $block_data['content']['column_1']['lead']; ?></h3>
                <?php endif; ?>

                <div class="editor-content">
                    <?php echo $block_data['content']['column_1']['text']; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($block_data['content']['column_2']['text'])) : ?>
            <div class="quality__col">
                <?php if(!empty($block_data['content']['column_2']['lead'])) : ?>
                <h3 class="quality__lead"><?php echo $block_data['content']['column_2']['lead']; ?></h3>
                <?php endif; ?>
                
                <div class="editor-content">
                    <?php echo $block_data['content']['column_2']['text']; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($block_data['content']['column_3']['text'])) : ?>
            <div class="quality__col">
                <?php if(!empty($block_data['content']['column_3']['lead'])) : ?>
                <h3 class="quality__lead"><?php echo $block_data['content']['column_3']['lead']; ?></h3>
                <?php endif; ?>
                
                <div class="editor-content">
                    <?php echo $block_data['content']['column_3']['text']; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>