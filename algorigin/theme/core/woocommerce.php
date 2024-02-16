<?php

if ( ! class_exists( 'AlgoriginWoo' ) ) {

    class AlgoriginWoo {

        public function __construct() {

            // hide from single product page
            add_action( 'template_redirect', array( $this, 'hide_from_single_product_page_callback' ) );

            // hide from shop ,cat,tag
            add_action( 'woocommerce_product_query', array( $this, 'hide_show_products_callback' ) );

            add_filter( 'wp_nav_menu_objects', array( $this, 'remove_regional_bundles_from_menu' ), 10, 2 );

            add_filter( 'woocommerce_product_variation_title_include_attributes', function( $boolean ) {
                return false;
            } );

            add_filter( 'woocommerce_is_attribute_in_product_name', function( $boolean ) {
                return true;
            } );

        }

        //  for single product page
        public function hide_from_single_product_page_callback()
        {

            if ( ! is_singular( 'product' ) ) {
                return;
            }

            $product_id = get_the_ID();
            if ( is_single( $product_id ) ) {

                $product = wc_get_product( $product_id );
                $product_type = $product->get_type();
                if ( $product_type !== 'woosb' && $product_type !== 'simple' ) {
                    return;
                }

                $attrs = $product->get_attribute( 'pa_regional-product' );

                if ( USER_REGION == 'CH' ) {
                    if ( $attrs === 'Swiss' ) {
                        return;
                    }
                } else {
                    if ( $attrs === 'Global' ) {
                        return;
                    }
                }

                $shop_url = get_permalink( wc_get_page_id( 'shop' ) );
                wp_safe_redirect( $shop_url );
                exit;

            }

        }

        public function hide_show_products_callback( $q ) {
            if ( USER_REGION == 'CH' ) {
                $exclude_region = ['global'];
            } else {
                $exclude_region = ['swiss'];
            }

            $args = array(
                'numberposts' => -1,
                'post_status' => array('publish'),
                'post_type' => array('product'),
                'fields' => 'ids',
                'tax_query'      => array(
                    array(
                        'taxonomy'        => 'pa_regional-product',
                        'field'           => 'slug',
                        'terms'           =>  $exclude_region,
                        'operator'        => 'IN',
                    ),
                    array(
                        'taxonomy' => 'product_type',
                        'field'    => 'slug',
                        'terms'    => ['woosb', 'simple'],
                        'operator' => 'IN'
                    ),
                )
            );

            $get_exclude_ids = get_posts( $args );

            if ( is_array( $get_exclude_ids ) && ( ! empty( $get_exclude_ids ) ) ) {
                $q->set( 'post__not_in', $get_exclude_ids );
            }
        }

        public function remove_regional_bundles_from_menu( $sorted_menu_objects, $args )
        {

            if ($args->theme_location != 'primary-nav')
                return $sorted_menu_objects;

            if ( USER_REGION == 'CH' ) {
                $exclude_region = ['global'];
            } else {
                $exclude_region = ['swiss'];
            }

            $args = array(
                'numberposts' => -1,
                'post_status' => array('publish'),
                'post_type' => array('product'),
                'fields' => 'ids',
                'tax_query'      => array(
                    array(
                        'taxonomy'        => 'pa_regional-product',
                        'field'           => 'slug',
                        'terms'           =>  $exclude_region,
                        'operator'        => 'IN',
                    ),
                    array(
                        'taxonomy' => 'product_type',
                        'field'    => 'slug',
                        'terms'    => ['woosb', 'simple'],
                        'operator' => 'IN'
                    ),
                )
            );

            $get_exclude_ids = get_posts( $args );

            if ( is_array( $get_exclude_ids ) && ( ! empty( $get_exclude_ids ) ) ) {
                foreach ($sorted_menu_objects as $key => $menu_object) {

                    $product_id = $menu_object->object_id;

                    if ( in_array_r( $product_id, $get_exclude_ids ) ) {
                        unset( $sorted_menu_objects[$key] );
                    }
                }
            }

            return $sorted_menu_objects;
        }

    }

    new AlgoriginWoo();
}