<?php

/* ***************************************************************************** */
/* THEME CUSTOM MENUS                                                            */
/* ***************************************************************************** */
/* Define all menus used by the theme here                                       */
/* All items should end with the suffix "-nav"                                   */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


function theme_custom_menus() {
	register_nav_menus([
        'primary-nav' => __( 'Main navigation', 'algorigin-theme' ),
        'footer-nav' => __( 'Footer navigation', 'algorigin-theme' ),
        'algae-sidebar-nav' => __( 'Algae sidebar navigation', 'algorigin-theme' ),
    ]);
}
add_action( 'init', 'theme_custom_menus' );

?>