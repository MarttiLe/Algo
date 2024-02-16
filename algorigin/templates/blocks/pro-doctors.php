<?php

    // Get block data
    $block_data = get_field('block_doctors');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
    
?>


<section class="doctors<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--sm">
        <div class="doctors__inner">
            <div class="doctors__left editor-content">
                <h2><?php echo $block_data['content']['column_1']['title']; ?></h2>
                <p><?php echo $block_data['content']['column_1']['text']; ?></p>
            </div>
            <div class="doctors__right">
                <h3><?php echo $block_data['content']['column_2']['title']; ?></h3>
                <img class="doctors__image" src="<?php echo $block_data['content']['column_2']['logo']; ?>">
            </div>
            <div class="doctors__bottom">
                <a href="<?php echo $block_data['link']; ?>" target="_blank"><button class="button button--color-accent"><?php echo $block_data['button']; ?></button></a>
            </div>
        </div>
    </div>
</section>