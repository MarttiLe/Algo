<?php

    // Get block data
    $block_data = get_field('block_vendors');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
    
?>


<section class="vendors<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--sm">
        <div class="vendors__inner">
            <h3 class="vendors__title"><?php echo $block_data['content']['column_2']['title']; ?></h3>
            <div class="vendors__left">
                <img class="course-item__image" src="<?php echo $block_data['content']['column_1']['image']; ?>">
            </div>
            <div class="vendors__right editor-content">
                <p><?php echo $block_data['content']['column_2']['text']; ?></p>
                <a href="mailto:<?php echo $block_data['content']['column_2']['link']; ?>" target="_blank"><button class="button button--color-accent"><?php echo $block_data['content']['column_2']['button']; ?></button></a>
            </div>
        </div>
    </div>
</section>