<?php

/* ***************************************************************************** */
/* THEME CONFIGURATION                                                           */
/* ***************************************************************************** */
/* Quickly configure the theme here. For more in-depth changes, edit the         */
/* necessary component files directly.                                           */
/* ***************************************************************************** */


// jQuery
// Note: jQuery inclusion must also be noted in the gulpfile
define('ENABLE_JQUERY', true);


// Cleanup options
define('ENABLE_ADMIN_BAR', true);
define('SET_REVISION_LIMIT', 10);
define('ENABLE_COMMENTS', true);
define('ENABLE_POSTS', true);
define('ENABLE_SANITIZE_UPLOAD_FILENAMES', true);
define('ENABLE_WP_RESPONSIVE_IMAGES', false);


// Security options
define('ENABLE_ANTISPAMBOT_EMAILS', true);


// Editor options
define('ENABLE_GUTENBERG_STYLES', false);
define('ENABLE_FRONTEND_STYLES_IN_TINYMCE', true);
define('ENABLE_FRONTEND_STYLES_IN_GUTENBERG', false);


// WooCommerce settings
define('IS_WOOCOMMERCE_PROJECT', true);
define('ENABLE_WOOCOMMERCE_STYLES', false);


// Vendor settings
define('ENABLE_LOGIC_GDPR', false);

?>