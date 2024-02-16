<form role="search" method="get" id="search-form" class="search-form" action="<?php echo home_url( '/' ); ?>">

    <label for="s" class="search-form__label screen-reader-text"><?php _e('Search for:', 'algorigin-theme'); ?></label>
    <input type="search" id="s" name="s" value="" />
    <button type="submit" id="search-submit" class="search-form__submit button"><?php _e('Search', 'algorigin-theme'); ?></button>

</form>