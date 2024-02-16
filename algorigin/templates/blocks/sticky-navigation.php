<?php
    /**
     * STICKY NAVIGATION BAR
     * @param block_classes string (optional) - pass additional classes for the element
    **/

    $block_data = get_field('block_sticky_navigation_bar');
    
    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<style>
    @media screen and (max-width: <?php echo $block_data['responsive_point']; ?>px) {
        .sticky-nav {
            display: none !important;
        }
    }
</style>
<div class="sticky-nav<?php echo $block_classes; ?> js-sticky-nav">
    <div class="container">
        <?php if(!empty($block_data['nav_items'])) : ?>
        <ul class="sticky-nav__items">
            <?php foreach($block_data['nav_items'] as $nav_item) : ?>
            <li class="sticky-nav__item">
                <a href="#<?php echo $nav_item['anchor']; ?>" class="sticky-nav__anchor"><?php echo $nav_item['title']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
