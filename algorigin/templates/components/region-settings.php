<?php
    /**
     * REGION & LANGUAGE SETTINGS
     * @param block_classes string (optional) - pass additional classes for the block
    **/

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $region_select_title = __( 'Select your region', 'algorigin-theme' );
    $lang_select_title = __( 'Select your language', 'algorigin-theme' );

    $countries = new WC_Countries();
    $selling_countries = $countries->get_allowed_countries();

    $current_region = USER_REGION;
?>


<div class="region-settings<?php echo $block_classes; ?>">
    
    <?php if(!empty($selling_countries)) : ?>
        <div class="region-settings__region">
            <label for="select-region" class="region-settings__label"><?php echo $region_select_title; ?></label>
            <select name="select-region" id="select-region">
                <option value=""><?php echo __( 'Select a region', 'algorigin-theme' ); ?></option>
                <?php foreach($selling_countries as $key => $country) : ?>
                    <?php
                        $is_current = '';
                        if($key === $current_region) {
                            $is_current = ' selected';
                        }
                    ?>
                    <option value="<?php echo $key; ?>"<?php echo $is_current; ?>><?php echo $country; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <?php if(function_exists('icl_object_id')) : ?>
    <div class="region-settings__language">
        <label for="select-language" class="region-settings__label"><?php echo $lang_select_title; ?></label>
        <?php theme_language_switcher(); ?>
    </div>
    <?php endif; ?>

    <div class="region-settings__currency"><?php echo __( 'Currency', 'algorigin-theme' ); ?>: <?php echo get_woocommerce_currency(); ?> (<?php echo get_woocommerce_currency_symbol(); ?>)</div>

</div>

<script>
    $("#select-region").change(function () {
        let iso_code = this.value;

        Cookies.set('change_region_to', iso_code);
        location.reload();
    });
</script>