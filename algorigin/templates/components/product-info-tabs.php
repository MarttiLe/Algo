<?php
    /**
     * PRODUCT ADDITIONAL INFO TABS
     * @param block_classes string (optional) - pass additional classes for the block
     * @param product_id int (optional) - pass in the id of a specific product
    **/

    if(!empty($args['product_id']) && is_int($args['product_id'])) {
        $product_id = $args['product_id'];
        $product = wc_get_product($product_id);
    } else {
        global $product;
        $product_id = get_the_ID();
    }

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $block_data = get_field('block_product_info_tabs');
?>


<?php if(!empty($block_data['tab_1']['content']) || !empty($block_data['tab_2']['content']) || !empty($block_data['tab_3']['content']) || !empty($block_data['tab_4']['content']) || !empty($block_data['tab_5']['content'])) : ?>
<div class="product-info<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <ul class="product-info__nav nav-tabs">

        <?php if(!empty($block_data['tab_5']['title'])) : ?>
            <?php
                if(empty($block_data['tab_5']['tab_title'])) {
                    $block_data['tab_5']['tab_title'] = __( 'Benefits', 'algorigin-theme' );
                }
                if(empty($block_data['tab_5']['icon'])) {
                    $block_data['tab_5']['icon'] = 'thumbs-up';
                }
            ?>
            <li class="nav-tabs__item">
                <button class="nav-tabs__anchor js-nav-tab is-active" data-tabs-id="product-info" data-tabs-content-id="1"><?php echo icon_svg($block_data['tab_5']['icon'], 'nav-tabs__icon'); ?><?php echo $block_data['tab_5']['tab_title']; ?></button>
            </li>
        <?php endif; ?>

        <?php if(!empty($block_data['tab_1']['image'])) : ?>
            <?php
                if(empty($block_data['tab_1']['tab_title'])) {
                    $block_data['tab_1']['tab_title'] = __( 'Quality', 'algorigin-theme' );
                }
                if(empty($block_data['tab_1']['icon'])) {
                    $block_data['tab_1']['icon'] = 'quality';
                }
            ?>
            <li class="nav-tabs__item">
                <button class="nav-tabs__anchor js-nav-tab is-active" data-tabs-id="product-info" data-tabs-content-id="2"><?php echo icon_svg($block_data['tab_1']['icon'], 'nav-tabs__icon'); ?><?php echo $block_data['tab_1']['tab_title']; ?></button>
            </li>
        <?php endif; ?>

        <?php if(!empty($block_data['tab_2']['box']['title']) && !empty($block_data['tab_2']['content'])) : ?>
            <?php
                if(empty($block_data['tab_2']['tab_title'])) {
                    $block_data['tab_2']['tab_title'] = __( 'Dosage', 'algorigin-theme' );
                }
                if(empty($block_data['tab_2']['icon'])) {
                    $block_data['tab_2']['icon'] = 'pill';
                }
            ?>
            <li class="nav-tabs__item">
                <button class="nav-tabs__anchor js-nav-tab" data-tabs-id="product-info" data-tabs-content-id="3"><?php echo icon_svg($block_data['tab_2']['icon'], 'nav-tabs__icon'); ?><?php echo $block_data['tab_2']['tab_title']; ?></button>
            </li>
        <?php endif; ?>

        <?php if(!empty($block_data['tab_3']['title'])) : ?>
            <?php
                if(empty($block_data['tab_3']['tab_title'])) {
                    $block_data['tab_3']['tab_title'] = __( 'Composition', 'algorigin-theme' );
                }
                if(empty($block_data['tab_3']['icon'])) {
                    $block_data['tab_3']['icon'] = 'structure';
                }
            ?>
            <li class="nav-tabs__item">
                <button class="nav-tabs__anchor js-nav-tab" data-tabs-id="product-info" data-tabs-content-id="4"><?php echo icon_svg($block_data['tab_3']['icon'], 'nav-tabs__icon'); ?><?php echo $block_data['tab_3']['tab_title']; ?></button>
            </li>
        <?php endif; ?>

        <?php if(!empty($block_data['tab_4']['title'])) : ?>
            <?php
                if(empty($block_data['tab_4']['tab_title'])) {
                    $block_data['tab_4']['tab_title'] = __( 'Benefits', 'algorigin-theme' );
                }
                if(empty($block_data['tab_4']['icon'])) {
                    $block_data['tab_4']['icon'] = 'thumbs-up';
                }
            ?>
            <li class="nav-tabs__item">
                <button class="nav-tabs__anchor js-nav-tab" data-tabs-id="product-info" data-tabs-content-id="5"><?php echo icon_svg($block_data['tab_4']['icon'], 'nav-tabs__icon'); ?><?php echo $block_data['tab_4']['tab_title']; ?></button>
            </li>
        <?php endif; ?>

        
    </ul>

    <div class="product-info__content">
        <div class="nav-tabs-content">
            
            <?php if(!empty($block_data['tab_1']['image'])) : ?>
                <?php $block_data['tab_1']['image'] = theme_get_wp_image($block_data['tab_1']['image'], 'product-thumb', 'product-quality__img'); ?>

                <div class="tab-content tab-content--dissolve-mobile js-nav-tab-content is-active" data-tabs-id="product-info" data-tabs-content-id="2">
                    <div class="product-quality">
                        
                        <h3 class="product-quality__title"><?php echo $block_data['tab_1']['title']; ?></h3>
                        <p class="product-quality__description"><?php echo $block_data['tab_1']['description']; ?></p>
                        <div class="product-quality__inner">
                            <div class="product-quality__image"><?php echo $block_data['tab_1']['image']; ?></div>

                            <div class="product-quality__content">
                                <div class="product-quality__left">
                                    <?php if(!empty($block_data['tab_1']['column_1']['title']) && !empty($block_data['tab_1']['column_1']['text'])) : ?>
                                    <div class="product-quality__col">
                                        <h3 class="product-quality__subtitle"><?php echo $block_data['tab_1']['column_1']['title']; ?></h3>
                                        <p class="product-quality__text"><?php echo $block_data['tab_1']['column_1']['text']; ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty($block_data['tab_1']['column_2']['title']) && !empty($block_data['tab_1']['column_2']['text'])) : ?>
                                    <div class="product-quality__col">
                                        <h3 class="product-quality__subtitle"><?php echo $block_data['tab_1']['column_2']['title']; ?></h3>
                                        <p class="product-quality__text"><?php echo $block_data['tab_1']['column_2']['text']; ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="product-quality__right">
                                    <?php if(!empty($block_data['tab_1']['column_3']['title']) && !empty($block_data['tab_1']['column_3']['text'])) : ?>
                                    <div class="product-quality__col">
                                        <h3 class="product-quality__subtitle"><?php echo $block_data['tab_1']['column_3']['title']; ?></h3>
                                        <p class="product-quality__text"><?php echo $block_data['tab_1']['column_3']['text']; ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty($block_data['tab_1']['column_4']['title']) && !empty($block_data['tab_1']['column_4']['text'])) : ?>
                                    <div class="product-quality__col">
                                        <h3 class="product-quality__subtitle"><?php echo $block_data['tab_1']['column_4']['title']; ?></h3>
                                        <p class="product-quality__text"><?php echo $block_data['tab_1']['column_4']['text']; ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(!empty($block_data['tab_2']['box']['title']) && !empty($block_data['tab_2']['content'])) : ?>
                <?php 
                    $box_icon = 'dosage';
                    if(!empty($block_data['tab_2']['box']['icon'])) {
                        $box_icon = $block_data['tab_2']['box']['icon'];
                    }
                ?>
                <div class="tab-content tab-content--dissolve-mobile js-nav-tab-content" data-tabs-id="product-info" data-tabs-content-id="3">
                    <div class="product-dosage">
                        <div class="product-dosage__col">
                            <div class="product-dosage__box">
                                <?php icon_svg($box_icon, 'product-dosage__icon'); ?>
                                <h3 class="product-dosage__box-title"><?php echo $block_data['tab_2']['box']['title']; ?></h3>
                                <div class="product-dosage__text editor-content"><?php echo $block_data['tab_2']['box']['text']; ?></div>
                            </div>
                        </div>

                        <div class="product-dosage__col">
                            <div class="product-dosage__content">
                                <?php if(!empty($block_data['tab_2']['content'])) : ?>
                                    <?php foreach($block_data['tab_2']['content'] as $content_block) : ?>
                                        <div class="product-dosage__block">
                                            <h3 class="product-dosage__title h3"><?php echo $content_block['title']; ?></h3>
                                            <div class="product-dosage__text editor-content"><?php echo $content_block['text']; ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(!empty($block_data['tab_3']['title'])) : ?>
            <div class="tab-content tab-content--dissolve-mobile js-nav-tab-content" data-tabs-id="product-info" data-tabs-content-id="4">
                <div class="product-composition">
                    <h3 class="product-composition__title"><?php echo $block_data['tab_3']['title']; ?></h3>
                    <p class="product-benefits__subtitle"><?php echo $block_data['tab_3']['ingredients']; ?></p>

                    <?php if(!empty($block_data['tab_3']['table'])) : ?>
                        <table class="product-composition__table">
                            <?php if(!empty($block_data['tab_3']['table']['header'])) : ?>
                                <thead>
                                    <tr>
                                        <?php foreach($block_data['tab_3']['table']['header'] as $th) : ?>
                                            <th>
                                                <?php echo $th['c']; ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                            <?php endif; ?>

                            <?php if(!empty($block_data['tab_3']['table']['body'])) : ?>
                                <tbody>
                                    <?php foreach($block_data['tab_3']['table']['body'] as $tr) : ?>
                                        <tr>
                                            <?php foreach($tr as $td) : ?>
                                                <td>
                                                    <?php echo $td['c']; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php endif; ?>
                        </table>
                    <?php endif; ?>

                    <div class="product-composition__bottom editor-content">
                        <?php echo $block_data['tab_3']['bottom_text']; ?>
                    </div>
                </div>

            </div>
            <?php endif; ?>

            <?php if(!empty($block_data['tab_4']['title'])) : ?>
            <div class="tab-content tab-content--dissolve-mobile js-nav-tab-content" data-tabs-id="product-info" data-tabs-content-id="5">
                <div class="product-benefits">
                    <h3 class="product-benefits__title"><?php echo $block_data['tab_4']['title']; ?></h3>
                    <p class="product-benefits__subtitle"><?php echo $block_data['tab_4']['subtitle']; ?></p>
                    
                    <?php if(!empty($block_data['tab_4']['items'])) : ?>
                        <ul class="product-benefits__items">
                            <?php foreach($block_data['tab_4']['items'] as $block_item) : ?>
                                <li class="product-benefits__item"><?php echo $block_item['text']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="product-benefits__actions">
                        <a href="<?php echo $block_data['tab_4']['link']['url']; ?>" class="more-link" target="<?php echo $block_data['tab_4']['link']['target']; ?>" data-text="<?php echo $block_data['tab_4']['link']['title']; ?>"><?php echo $block_data['tab_4']['link']['title']; ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- This is an extra field for the bundled products -->

            <?php if(!empty($block_data['tab_5']['title'])) : ?>

   
            <div class="tab-content tab-content--dissolve-mobile js-nav-tab-content is-active" data-tabs-id="product-info" data-tabs-content-id="1">
                <div class="bundle-benefits">
                    <h3 class="bundle-benefits__title"><?php echo $block_data['tab_5']['title']; ?></h3>
                    <p class="bundle-benefits__subtitle"><?php echo $block_data['tab_5']['subtitle']; ?></p>
                    
                    <?php if(!empty($block_data['tab_5']['items'])) : ?>
                        <ul class="bundle-benefits__items">
                            <?php foreach($block_data['tab_5']['items'] as $block_item) : ?>
                                <li class="bundle-benefits__item">
                                    <img src="<?php echo $block_item['image']; ?>">
                                    <h3 class="bundle-benefits__heading"><?php echo $block_item['title']; ?></h3>
                                    <div class="bundle-benefits__text editor-content"><?php echo $block_item['text']; ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- End extra field -->
        </div>
    </div>
</div>
<?php endif; ?>