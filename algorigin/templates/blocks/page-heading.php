<?php
    /**
     * PAGE HEADING BLOCK
     * Values will be loaded in from management with get_field, but can be overriden via args if necessary
     * @param block_classes string (optional) - pass additional classes for the section element
     * @param skip_acf_data bool (optional) - whether to load data from acf fields or not, this is used if the target is not a page
     * @param page_id int (optional) - pass a page id to get heading block data from
     * @param title string (optional) - pass a title for the block
     * @param subtitle string (optional) - pass a subtitle for the block
     * @param color_scheme string (optional) - light/dark/neutral/custom
     * @param text_color string (optional, in case of custom color_scheme only) - pass in a hex color value for the text
     * @param background_color string (optional, in case of custom color_scheme only) - pass in a hex color value for the text
     * @param hide_breadcrumb bool (optional) - show/hide breadcrumb
    **/


    // Get block data
    $page_id = get_the_ID();
    if(!empty($args['page_id']) && is_int($args['page_id'])) {
        $page_id = $args['page_id'];
    }

    if(empty($args['skip_acf_data'])) {
        $block_data = get_field('block_page_heading', $page_id);
    } else {
        $block_data = [
            'title'             => '',
            'subtitle'          => '',
            'color_scheme'      => 'dark',
            'hide_breadcrumb'   => false
        ];
    }


    // Manage block details
    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(empty($block_data['title'])) {
        $block_data['title'] = get_the_title();
    }

    if(!empty($args['title'])) {
        $block_data['title'] = $args['title'];
    }

    if(!empty($args['subtitle'])) {
        $block_data['subtitle'] = $args['subtitle'];
    }

    if(!empty($args['image'])) {
        $block_data['image'] = $args['image'];
    }

    if(!empty($args['hide_breadcrumb'])) {
        $block_data['hide_breadcrumb'] = $args['hide_breadcrumb'];
    }

    if(!empty($args['color_scheme'])) {
        $block_data['color_scheme'] = $args['color_scheme'];
    }

    if(!empty($args['color_scheme']) && $args['color_scheme'] === 'custom' && !empty($args['text_color']) && !empty($args['background_color'])) {
        $block_data['custom_colors']['text'] = $args['text_color'];
        $block_data['custom_colors']['text'] = $args['background_color'];
    }

    $block_styles = ' style="';
    if(!empty($block_data['image'])) {
        $background_image = wp_get_attachment_image_url($block_data['image'], 'page-heading');
        $block_styles .= 'background-image: url('. $background_image .');';
    }

    switch($block_data['color_scheme']) {
        case 'light':
            $block_classes .= ' page-heading--light';
            break;
        case 'dark':
            $block_classes .= ' page-heading--dark';
            break;
        case 'neutral':
            $block_classes .= ' page-heading--neutral';
            break;
        case 'custom':
            $color = 'color: '. $block_data['custom_colors']['text'] .';';
            $background = 'background-color: '. $block_data['custom_colors']['background'] .';';
            $block_styles .= $color . $background;
            break;
    }
    $block_styles .= '"';
?>


<section class="page-heading<?php echo $block_classes; ?>"<?php echo $block_styles; ?>>  
    <div class="container container--sm">
        <div class="page-heading__inner">

            <h1 class="page-heading__title h1"><?php echo $block_data['title']; ?></h1>

            <?php if(!empty($block_data['subtitle'])) : ?>
            <p class="page-heading__lead"><?php echo $block_data['subtitle']; ?></p>
            <?php endif; ?>

            <?php if(!$block_data['hide_breadcrumb']) : ?>
            <div class="page-heading__breadcrumb">
                <?php echo theme_breadcrumbs_list(); ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>