<?php

    // Get block data
    $block_data = get_field('block_courses');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
    
?>


<section class="courses<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container">
        <h3 class="courses__title"><?php echo $block_data['courses_title']; ?></h3>  

        <ul class="course-items">
            <?php if(!empty($block_data['items'])) : ?>
                <?php foreach($block_data['items'] as $item) : ?>
                    <li class="course-item">
                    <div class="course-item__outer">
                        <img class="course-item__image" src="<?php echo $item['image']; ?>">
                            <div class="course-item__inner">
                                <h4 class="course-item__title"><?php echo $item['title']; ?></h4>
                                <p class="course-item__description"><?php echo $item['description']; ?></p>
                                <a href="<?php echo $item['link']; ?>" target="_blank" class="course-item__link"><?php echo $item['button']; ?></a>
                            </div>
                    </div>
                </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</section>