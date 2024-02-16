<?php

    // Get block data
    $block_data = get_field('block_featured_course');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
    
?>


<section class="featured-course">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container featured-course__outer">  
        <h1 class="featured-course__title"><?php echo $block_data['title']; ?></h1>
        <div class="featured-course__inner container--sm">
            <div class="featured-course__left">
                <img src="<?php echo $block_data['image']; ?>">
            </div>
            <div class="featured-course__right editor-content">
                <h3><?php echo $block_data['course_title']; ?></h3>
                <?php echo $block_data['content']; ?>
            </div>
        </div>
    </div>
</section>