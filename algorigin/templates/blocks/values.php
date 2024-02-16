<?php
    /**
     * VALUES BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_values');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<section class="values<?php echo $block_classes; ?>" data-sal="slide-up">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <div class="container">
        <div class="values__inner">
            <h2 class="values__title h3"><?php echo $block_data['title']; ?></h2>

            <?php if(!empty($block_data['items'])) : ?>
                <ul class="values__items">

                    <?php foreach($block_data['items'] as $item) : ?>
                    <li class="values__item" data-sal="slide-up" data-sal-delay="100">
                        <a href="<?php echo $item['link']['url']; ?>" <?php if(!empty($item['link']['target'])) { echo 'target="_blank" rel="noopener"'; } ?> class="values__anchor logo">
                            <img src="<?php echo wp_get_attachment_image_url($item['logo'], 'full'); ?>" alt="<?php echo $item['name']; ?>" title="<?php echo $item['name']; ?>" class="logo__img">
                        </a>
                    </li>
                    <?php endforeach; ?>

                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>