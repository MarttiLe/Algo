<?php
    /**
     * FAQs
     * @param block_classes string (optional) - pass additional classes for the section element
    **/

    // Get block data
    $block_data = get_field('block_faqs');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<div class="faq<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <?php if(!empty($block_data['title'])) : ?>
    <h2 class="faq__title h3"><?php echo $block_data['title']; ?></h2>
    <?php endif; ?>

    <?php if(!empty($block_data['items'])) : ?>
    <ul class="faq__items">
        <?php foreach($block_data['items'] as $key => $faq_item) : ?>
            <?php
                $faq_question = get_the_title($faq_item);
                $faq_answer = get_field('answer', $faq_item);
            ?>
            <li class="faq__item faq-item">
                <div class="faq-item__toggle accordion-toggle js-accordion-toggle" data-accordion-id="faq-item-<?php echo $key; ?>"><?php echo $faq_question; ?></div>
                <div class="faq-item__content editor-content accordion-content js-accordion-content" data-accordion-id="faq-item-<?php echo $key; ?>"><?php echo $faq_answer; ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>