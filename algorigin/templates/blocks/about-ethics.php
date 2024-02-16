<?php
    /**
     * ABOUT PAGE ETHICS BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_ethics');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(!empty($block_data['content']['column_1']['image'])) {
        $block_data['content']['column_1']['image'] = wp_get_attachment_image_url($block_data['content']['column_1']['image'], '720p');
    }
    if(!empty($block_data['content']['column_2']['image'])) {
        $block_data['content']['column_2']['image'] = wp_get_attachment_image_url($block_data['content']['column_2']['image'], '720p');
    }
?>


<section class="ethics<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--sm">
        <div class="ethics__inner">
            <?php if(!empty($block_data['content'])) : ?>
            <h2 class="ethics__title h2"><?php echo $block_data['title']; ?></h2>
            <?php endif; ?>

            <?php if(!empty($block_data['content'])) : ?>
            <p class="ethics__subtitle"><?php echo $block_data['subtitle']; ?></p>
            <?php endif; ?>
        </div>

        <div class="ethics__cols">
            <?php if(!empty($block_data['content']['column_1']['text'])) : ?>
            <div class="ethics__col">
                <div class="ethics__image" style="background-image:url(<?php echo $block_data['content']['column_1']['image']; ?>);">&nbsp;</div>

                <?php if(!empty($block_data['content']['column_1']['title'])) : ?>
                <h3 class="ethics__lead"><?php echo $block_data['content']['column_1']['title']; ?></h3>
                <?php endif; ?>

                <div class="ethics__text editor-content">
                    <?php echo $block_data['content']['column_1']['text']; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($block_data['content']['column_2']['text'])) : ?>
            <div class="ethics__col">
                <div class="ethics__image" style="background-image:url(<?php echo $block_data['content']['column_2']['image']; ?>);">&nbsp;</div>

                <?php if(!empty($block_data['content']['column_2']['title'])) : ?>
                <h3 class="ethics__lead"><?php echo $block_data['content']['column_2']['title']; ?></h3>
                <?php endif; ?>
                
                <div class="ethics__text editor-content">
                    <?php echo $block_data['content']['column_2']['text']; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>