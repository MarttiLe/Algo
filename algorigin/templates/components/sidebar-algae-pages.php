<div class="sidebar-page-nav">
    <div class="sidebar-page-nav__title"><?php echo __( 'Algae science', 'algorigin-theme' ); ?></div>

    <nav class="sidebar-nav">
        <?php
            wp_nav_menu([
                'menu' => __( 'Algae sidebar navigation', 'algorigin-theme' ),
                'container' => false,
                'menu_class' => 'sidebar-nav__items menu js-sidebar-nav',
                'theme_location' => 'algae-sidebar-nav',
            ]);
        ?>
    </nav>
</div>