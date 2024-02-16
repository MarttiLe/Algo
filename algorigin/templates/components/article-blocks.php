<?php
    /**
     * ARTICLE BLOCKS
     * @param block_classes string (optional) - pass additional classes for the block
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = get_field('block_article_blocks');
?>


<div class="article-blocks<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['items'])) : ?>
    <ul class="article-blocks__items">
        <?php foreach($block_data['items'] as $item) : ?>

            <?php 
                if(empty($item['link']['title'])) {
                    $item['link']['title'] = __( 'Read more', 'algorigin-theme' );
                }

                $item['image'] = wp_get_attachment_image_url($item['image'], 'product-thumb-lg');
            ?>

            <li class="article-blocks__item">
                <div class="article-block">
                    <div class="article-block__image" style="background-image: url(<?php echo $item['image']; ?>)">&nbsp;</div>

                    <div class="article-block__inner">
                        <h3 class="article-block__title"><?php echo $item['title']; ?></h3>

                        <div class="article-block__content editor-content">
                            <?php echo $item['text']; ?>
                        </div>

                        <div class="article-block__actions">
                            <a href="<?php echo $item['link']['url']; ?>" class="more-link" target="<?php echo $item['link']['target']; ?>" data-text="<?php echo $item['link']['title']; ?>"><?php echo $item['link']['title']; ?></a>
                        </div>
                    </div>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>