<?php

// LOAD THEME
require_once( 'theme/theme.php' );

// INITIALIZE THEME
if(function_exists( 'theme_init')) {
	add_action( 'after_setup_theme', 'theme_init' );
}

/* ***************************************************************************** */
/* THEME CUSTOM FUNCTIONS                                                        */
/* ***************************************************************************** */


// CUSTOM LABEL FIELDS FOR WOOCOMMERCE PRODUCTS
// Displayed on product cards
function theme_woocommerce_product_custom_fields () {
	global $woocommerce, $post;
	echo '<div class=" product_custom_field ">';
    woocommerce_wp_text_input(
		[
			'id'          => '_algo_product_label1',
			'label'       => __( 'Label text #1', 'algorigin-theme' ),
		]
    );
    woocommerce_wp_text_input(
		[
			'id'          => '_algo_product_label2',
			'label'       => __( 'Label text #2', 'algorigin-theme' ),
		]
    );
  	echo '</div>';
}
function theme_woocommerce_product_custom_fields_save($post_id) {
	$algo_product_label1_field = $_POST['_algo_product_label1'];
	if (!empty($algo_product_label1_field)) {
		update_post_meta($post_id, '_algo_product_label1', esc_attr($algo_product_label1_field));
	}
	$algo_product_label2_field = $_POST['_algo_product_label2'];
	if (!empty($algo_product_label2_field)) {
		update_post_meta($post_id, '_algo_product_label2', esc_attr($algo_product_label2_field));
	}
}
add_action( 'woocommerce_product_options_general_product_data', 'theme_woocommerce_product_custom_fields' );
add_action( 'woocommerce_process_product_meta', 'theme_woocommerce_product_custom_fields_save' );


// REMOVE COUPONS FROM CHECKOUT
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


// RENAME WC PRODUCT TAGS
function theme_change_wc_product_tag_name() {
	global $wp_taxonomies;
	$labels = $wp_taxonomies['product_tag']->labels;
	$labels->name = __( 'Algae types', 'algorigin-theme' );
	$labels->singular_name = __( 'Algae type', 'algorigin-theme' );
	$labels->add_new = __( 'Add algae', 'algorigin-theme' );
	$labels->add_new_item = __( 'Add algae', 'algorigin-theme' );
	$labels->edit_item = __( 'Edit algae', 'algorigin-theme' );
	$labels->new_item = __( 'Algae', 'algorigin-theme' );
	$labels->view_item = __( 'View algaes', 'algorigin-theme' );
	$labels->all_items = __( 'All algaes', 'algorigin-theme' );
	$labels->menu_name = __( 'Algae types', 'algorigin-theme' );
	$labels->name_admin_bar = __( 'Algae types', 'algorigin-theme' );
}
add_action( 'init', 'theme_change_wc_product_tag_name' );


// GET TOTAL AMOUNT OF WC PRODUCTS
function theme_get_total_product_count() {
	$count_posts = wp_count_posts( 'product' );
	return $count_posts->publish;
}


// MODIFY ACF ICON PLUGIN PATH
function theme_acf_icon_path_suffix( $path_suffix ) {
    return 'assets/icons/';
}
add_filter( 'acf_icon_path_suffix', 'theme_acf_icon_path_suffix' );


// BLOG LOADMORE
function theme_ajax_blog_loadmore() {
	if(!isset($_POST['args']) || empty($_POST['args'])) {
		die(json_encode([
			'success' 	=> false,
			'message' 	=> __('Error - invalid arguments provided', 'algorigin-theme')
		]));
	}

	$args = $_POST['args'];
	$args['paged'] = (int)$args['paged'];
	$args['posts_per_page'] = (int)$args['posts_per_page'];

	$blog_items = new WP_Query($args);
	$animation_delay = 0;

	ob_start();
	if($blog_items->have_posts()) {
		while($blog_items->have_posts()) {
			$blog_items->the_post();
			echo '<li class="blog-list__item" data-sal="slide-up" data-sal-delay="'. $animation_delay .'">';
			get_template_part('templates/components/card-blog');
			echo '</li>';
			$animation_delay += 200;
			if($animation_delay > 400) {
				$animation_delay = 0;
			}
		}
	}
	wp_reset_postdata();
	$output = ob_get_clean();

	$is_final_page = false;
	if($args['paged'] == $blog_items->max_num_pages) {
		$is_final_page = true;
	}

	if(empty($output)) {
		die(json_encode([
			'success' 	=> false,
			'message' 	=> __('Error - something went wrong when attempting to retrieve posts', 'algorigin-theme'),
			'debug'		=> $args
		]));
	} else {
		die(json_encode([
			'output'	=> $output,
			'final'		=> $is_final_page,
			'success' 	=> true,
			'message' 	=> __('Post fetch succeeded', 'algorigin-theme'),
			'debug'		=> $args
		]));
	}
}
add_action('wp_ajax_nopriv_theme_ajax_blog_loadmore', 'theme_ajax_blog_loadmore');
add_action('wp_ajax_theme_ajax_blog_loadmore', 'theme_ajax_blog_loadmore');


// CUSTOM HEADER MENU WALKER
class Theme_Mega_Menu extends Walker {

		/**
	 * What the class handles.
	 *
	 * @since 3.0.0
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 *
	 * @see Walker::$db_fields
	 */
	public $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		// Custom
		if($depth === 0) {
			$output .= '<div class="menu__mega mega-menu"><div class="container container--xl"><div class="mega-menu__inner">';
		}

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat( $t, $depth );
		$output .= "$indent</ul>{$n}";

		if($depth === 0) {
			$output .= '<img src="" class="mega-menu__hover-img js-megamenu-img"></div></div></div>';
		}
	}

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS classes applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria-current The aria-current attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of page. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

}


// ADD HOVER IMAGE URLS TO PRODUCTS IN HEADER MENU
add_filter( 'nav_menu_link_attributes', 'theme_add_product_hover_images_to_nav', 10, 4 );
function theme_add_product_hover_images_to_nav( $atts, $item, $args ) {
	if( $args->theme_location == 'primary-nav' ) {
		if( $item->object === 'product') {
			$product_item = wc_get_product($item->object_id);
			$product_gallery = $product_item->get_gallery_image_ids();
			$hover_image = '';
            $product_type = $product_item->get_type();
            if ( $product_type === 'woosb' ) {
                $image_id = $product_item->get_image_id();
                if($image_id)
                $hover_image = wp_get_attachment_image_url($image_id, 'product-thumb');
            }else if(array_key_exists(1, $product_gallery)) {
                $hover_image = wp_get_attachment_image_url($product_gallery[1], 'product-thumb');
			}
			$atts['data-hover-image'] = $hover_image;
		}
	}

	return $atts;
}


// REMOVE ITEMS FROM WOOCOMMERCE DASHBOARD MENU
function theme_remove_wc_navigation_items( $items ) {
    unset($items['downloads']);

    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'theme_remove_wc_navigation_items' );


// GET PRODUCT PRICE DATA
function theme_get_product_price_data($product, $append_currency = false, $is_regional_product = null, $regional_variation_data = false) {
	if(is_int($product)) {
		$product_data = wc_get_product($product);
	} else {
		$product_data = $product;
	}

	if($is_regional_product && !$product->is_type( 'woosb' )) {
		if($regional_variation_data) {
			$regional_variation = $regional_variation_data;
		}
	} else if($is_regional_product === null) {
		$is_regional_product = $product->get_attribute('regional-product');
		if($is_regional_product && !$product->is_type( 'woosb' ) && !$product->is_type( 'simple' )) {
			$regional_variation = theme_get_regional_variation_data($product_data);
		}
	}

	$price = [
		'regular_price'		=> 0,
		'sale_price'		=> 0,
		'final_price'		=> 0,
		'currency'			=> '€',
		'currency_position' => 'right',
		'is_variable'		=> false,
	];

	if($is_regional_product && !$product->is_type( 'woosb' ) && !$product->is_type( 'simple' )) {
		// Custom regional products'
		$price = [
			'regular_price'		=> trim_trailing_zeroes($regional_variation['price_regular']),
			'sale_price'		=> trim_trailing_zeroes($regional_variation['price_sale']),
			'final_price'		=> trim_trailing_zeroes($regional_variation['price_final']),
			'currency'			=> get_woocommerce_currency_symbol(),
			'currency_position'	=> get_option( 'woocommerce_currency_pos' ),
			'is_variable'		=> false
		];
	} else {
		// Standard products
		if($product_data->is_type('variable')) {
			$variation_prices = [];
			$product_variations = $product_data->get_available_variations();
			foreach($product_variations as $variation) {
				array_push($variation_prices, $variation['display_price']);
			}
			$price = [
				'regular_price'		=> trim_trailing_zeroes(min($variation_prices)),
				'sale_price'		=> '',
				'final_price'		=> __( 'fr.', 'algorigin-theme' ) . ' ' . trim_trailing_zeroes(min($variation_prices)),
				'currency'			=> get_woocommerce_currency_symbol(),
				'currency_position'	=> get_option( 'woocommerce_currency_pos' ),
				'is_variable'		=> true
			];
		} else {
			$price = [
				'regular_price'		=> trim_trailing_zeroes($product_data->get_regular_price()),
				'sale_price'		=> trim_trailing_zeroes($product_data->get_sale_price()),
				'final_price'		=> trim_trailing_zeroes($product_data->get_price()),
				'currency'			=> get_woocommerce_currency_symbol(),
				'currency_position'	=> get_option( 'woocommerce_currency_pos' ),
				'is_variable'		=> false
			];
		}
	}

	if($append_currency) {
		if(!empty($price['regular_price'])) {
			switch($price['currency_position']) {
				case 'left':
					$price['regular_price'] = $price['currency'] . $price['regular_price'];
					break;
				case 'right':
					$price['regular_price'] .= $price['currency'];
					break;
				case 'left_space':
					$price['regular_price'] = $price['currency'] . ' ' . $price['regular_price'];
					break;
				case 'right_space':
					$price['regular_price'] = $price['regular_price'] . ' ' . $price['currency'];
					break;
			}
		}
		if(!empty($price['sale_price'])) {
			switch($price['currency_position']) {
				case 'left':
					$price['sale_price'] = $price['currency'] . $price['sale_price'];
					break;
				case 'right':
					$price['sale_price'] .= $price['currency'];
					break;
				case 'left_space':
					$price['sale_price'] = $price['currency'] . ' ' . $price['sale_price'];
					break;
				case 'right_space':
					$price['sale_price'] = $price['sale_price'] . ' ' . $price['currency'];
					break;
			}
		}
		if(!empty($price['final_price'])) {
			switch($price['currency_position']) {
				case 'left':
					$price['final_price'] = $price['currency'] . $price['final_price'];
					break;
				case 'right':
					$price['final_price'] .= $price['currency'];
					break;
				case 'left_space':
					$price['final_price'] = $price['currency'] . ' ' . $price['final_price'];
					break;
				case 'right_space':
					$price['final_price'] = $price['final_price'] . ' ' . $price['currency'];
					break;
			}
		} else {
			$price['final_price'] = __('Free!', 'algorigin-theme');
		}
	}

	return $price;
}
/****/
$region_version = 2;

if ( current_user_can('administrator') ) {
    $region_version = 2;
}

// USER REGION SELECT
add_action( 'wp_loaded', function() {
    if ( ! strpos( $_SERVER['REQUEST_URI'], "wp-admin" ) && ! strpos( $_SERVER['REQUEST_URI'], "wp-cron" ) && ! strpos( $_SERVER['REQUEST_URI'], "wp-json" ) && php_sapi_name() !== 'cli' ) {
        global $woocommerce;

        if ( isset(WC()->session) && ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }

        $default_country = 'CH';

        $change_region_to = $_COOKIE['change_region_to'];

        if ( ! empty( $change_region_to ) ) {

            $woocommerce->cart->empty_cart();

            $countries = new WC_Countries();
            $allowed_countries = $countries->get_allowed_countries();

            $match_found = false;

            foreach ( $allowed_countries as $iso_code => $country_name ) {
                if ( $iso_code === $change_region_to ) {
                    $woocommerce->customer->set_billing_country( $iso_code );
                    define( 'USER_REGION', $iso_code );
                    $match_found = true;
                    break;
                }
            }

            if ( ! $match_found ) {
                $woocommerce->customer->set_billing_country( $default_country );
                define( 'USER_REGION', $default_country );
            }

            //unset( $_COOKIE['change_region_to'] );
            setcookie( 'change_region_to', null, -1, '/' );

        } else {

            $billing_country = $woocommerce->customer->get_billing_country();

            if ( empty( $billing_country ) ) {

                $geoip = geoip_detect2_get_info_from_current_ip();
                $country_iso_code = $geoip->raw['country']['iso_code'];

                if ( empty( $country_iso_code ) ) {
                    $woocommerce->customer->set_billing_country( $default_country );
                    define( 'USER_REGION', $default_country );
                    //header('Location: '.$_SERVER['REQUEST_URI']);
                    //die();
                } else {
                    $countries = new WC_Countries();
                    $allowed_countries = $countries->get_allowed_countries();

                    $match_found = false;

                    foreach ( $allowed_countries as $iso_code => $country_name ) {
                        if ( $iso_code === $country_iso_code ) {
                            $woocommerce->customer->set_billing_country( $iso_code );
                            define( 'USER_REGION', $iso_code );
                            $match_found = true;
                            break;
                        }
                    }

                    if ( !$match_found ) {
                        $woocommerce->customer->set_billing_country( $default_country );
                        define( 'USER_REGION', $default_country );
                    }
                }

            } else {
                define( 'USER_REGION', $billing_country );
            }

        }

        add_filter( 'wcml_client_currency', function( $currency ) {
            if ( USER_REGION === 'CH' ) {
                return 'CHF';
            } else {
                return 'EUR';
            }
        }, 20, 1 );

    }
});



// REDIRECT TO CH TERMS PAGE

// ID's of translation pages
// 4818 - CH terms
// 1322 - original terms

add_action('template_redirect', 'regional_terms');

function regional_terms()
{
	// Get id of post according current WPML language
	$global_terms_page_id = apply_filters( 'wpml_object_id', 1322, 'post' );
	$ch_terms_page_id = apply_filters( 'wpml_object_id', 4818, 'post' );

	if ( USER_REGION === 'CH' ) {
		if ( is_page( $global_terms_page_id ) ) {
			wp_redirect( get_permalink( $ch_terms_page_id ) );
			exit();
		}
	} else {
		if ( is_page( $ch_terms_page_id ) ) {
			wp_redirect( get_permalink( $global_terms_page_id ) );
			exit();
		}
	}
}

//CHANGE LANGUAGE DEPENDS ON IP
add_action('wp_loaded', 'ip_language');

function ip_language()
{
    $geoip = geoip_detect2_get_info_from_current_ip();
    $country_iso_code = $geoip->raw['country']['iso_code'];

    global $sitepress, $region_version;

    if ( ! isset( $_COOKIE['Lang'] ) ) {

        if ( $region_version == 2 ) {
            if ( USER_REGION === "CH" ) {
                $lang = 'fr-ch';
                $sitepress->switch_lang( $lang, true );
            } else if ( USER_REGION === "FR" ) {
                $lang = 'fr';
                $sitepress->switch_lang( $lang, true );
            } else if ( USER_REGION === "DE" || USER_REGION === "AT" ) {
                $lang = 'de';
                $sitepress->switch_lang( $lang, true );
            } else {
                $lang = 'en';
                $sitepress->switch_lang( $lang, true );
            }

            setcookie( 'Lang', 1, time()+8640000 ); //100 days

            if ( empty( $_SERVER['QUERY_STRING'] ) && $_SERVER['REQUEST_URI'] === '/' ) {
                if ( USER_REGION === "CH" ) {
                    wp_safe_redirect( get_site_url() . "/{$lang}" );
                    die();
                } else {
                    if ( $lang !== 'en' ) {
                        wp_safe_redirect( get_site_url() . "/{$lang}" );
                        die();
                    }
                }
            }
        } else {
            if ( USER_REGION === "CH" || USER_REGION === "FR" ) {
                $lang = 'fr';
                $sitepress->switch_lang( $lang, true );
            } else if ( USER_REGION === "DE" || USER_REGION === "AT" ) {
                $lang = 'de';
                $sitepress->switch_lang( $lang, true );
            } else {
                $lang = 'en';
                $sitepress->switch_lang( $lang, true );
            }

            setcookie( 'Lang', 1, time()+8640000 ); //100 days

            if ( empty( $_SERVER['QUERY_STRING'] ) && $_SERVER['REQUEST_URI'] === '/' ) {
                if ( $lang !== 'en' ) {
                    wp_safe_redirect( get_site_url() . "/{$lang}" );
                    die();
                }
            }
        }

    } else {
        if ( ! strpos( $_SERVER['REQUEST_URI'], "wp-login" ) && ! strpos( $_SERVER['REQUEST_URI'], "wp-admin" ) && ! strpos( $_SERVER['REQUEST_URI'], "wp-cron" ) && ! strpos( $_SERVER['REQUEST_URI'], "wp-json" ) && php_sapi_name() !== 'cli' ) {
            if ( $region_version == 2 ) {
                $current_lang = $sitepress->get_current_language();

                if ( USER_REGION && USER_REGION === "CH" ) {
                    $allowed_langs = [ 'en-ch', 'fr-ch', 'de-ch' ];

                    if ( !in_array( $current_lang, $allowed_langs ) ) {
                        wp_safe_redirect( get_site_url() . "/fr-ch/" );
                        die();
                    }
                } else {
                    $restricted_langs = [ 'en-ch', 'fr-ch', 'de-ch' ];

                    if ( in_array( $current_lang, $restricted_langs ) ) {
                        wp_safe_redirect( get_site_url() . "/" );
                        die();
                    }
                }
            }
        }
    }
}

add_filter( 'woocommerce_shipping_fields', function ( $shipping_fields ) {
    $readonly = ['readonly' => 'readonly'];
    $shipping_fields['shipping_country']['custom_attributes'] = $readonly;

    return $shipping_fields;
}, 100, 1 );

add_filter( 'woocommerce_billing_fields', function ( $billing_fields ) {
    $readonly = ['readonly' => 'readonly'];
    $billing_fields['billing_country']['custom_attributes'] = $readonly;

    return $billing_fields;
}, 100, 1 );


// REGION AND VARIATION MAPPING
// Returns the required variation slug for the user's region
// These variations must match the WooCommerce product attribute "Regional product" terms
function theme_get_region_variation_slug() {
	switch(USER_REGION) {
		case 'CH':
			$variation_slug = 'swiss';
			break;
		default:
			$variation_slug = 'global';
			break;
	}

	return $variation_slug;
}


// GET REGIONAL PRODUCT VARIATION DATA
// Returns formatted information from the product variation that matches the user's region
function theme_get_regional_variation_data($product = false) {
	if(!$product) {
		global $product;
	}
	$current_region = theme_get_region_variation_slug();

	$is_regional_product = $product->get_attribute('regional-product');
	if(!$is_regional_product) {
		return false;
	}

	$product_regional_variations = [];
	foreach($product->get_available_variations() as $variation) {
		$region_slug = $variation['attributes']['attribute_pa_regional-product'];
		$product_regional_variations[$region_slug] = $variation;
	}

	$final_price = $product_regional_variations[$current_region]['display_regular_price'];
	if(!empty($product_regional_variations[$current_region]['display_price']) && $product_regional_variations[$current_region]['display_price'] < $product_regional_variations[$current_region]['display_regular_price']) {
		$final_price = $product_regional_variations[$current_region]['display_price'];
	}

    $sale_price = 0;

    if ( $product_regional_variations[$current_region]['display_regular_price'] != $product_regional_variations[$current_region]['display_price'] ) {
        $sale_price = $product_regional_variations[$current_region]['display_price'];
    }

	$variation_data = [
		'id'				=> $product_regional_variations[$current_region]['variation_id'],
		'sku'				=> $product_regional_variations[$current_region]['sku'],
		'description'		=> $product_regional_variations[$current_region]['variation_description'],
		'price_regular'		=> $product_regional_variations[$current_region]['display_regular_price'],
		'price_sale'		=> $sale_price,
		'price_final'		=> $final_price,
		'cart_url'			=> '?add-to-cart='. $product_regional_variations[$current_region]['variation_id']
	];

	return $variation_data;
}


// USE PAYPAL STANDARD ( SHOULD BE SWITCHED TO NEW IN THE FUTURE )
add_filter( 'woocommerce_should_load_paypal_standard', '__return_true' );


// DISPLAY DISCOUNTS IN THE CART
add_filter( 'woocommerce_cart_item_price', 'algo_change_cart_table_price_display', 30, 3 );
function algo_change_cart_table_price_display( $price, $values, $cart_item_key ) {
   $slashed_price = $values['data']->get_price_html();
   $is_on_sale = $values['data']->is_on_sale();
   if ( $is_on_sale ) {
      $price = $slashed_price;
   }
   return $price;
}


// BULK DISCOUNTS
add_action( 'woocommerce_before_calculate_totals', 'algo_quantity_based_pricing', 9999 );
function algo_quantity_based_pricing( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;

    // Define discount rules and thresholds
    $threshold1 = 2; // Change price if items > 2
    $discount1 = 0.05; // Reduce unit price by 5%
    $threshold2 = 3; // Change price if items > 3
    $discount2 = 0.1; // Reduce unit price by 10%

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		$product = $cart_item['data'];

		if( $product->is_type( 'variation' ) || $product->is_type( 'simple' )) {
			if ( $cart_item['quantity'] >= $threshold1 && $cart_item['quantity'] < $threshold2  ) {
				$price = round( $cart_item['data']->get_regular_price() * ( 1 - $discount1 ), 2 );
				$price_sale = round( $cart_item['data']->get_sale_price() * ( 1 - $discount1 ), 2 );
				$cart_item['data']->set_price( $price );
				$cart_item['data']->set_sale_price( $price_sale );
			} elseif ( $cart_item['quantity'] >= $threshold2 ) {
				$price = round( $cart_item['data']->get_regular_price() * ( 1 - $discount2 ), 2 );
				$price_sale = round( $cart_item['data']->get_sale_price() * ( 1 - $discount1 ), 2 );
				$cart_item['data']->set_price( $price );
				$cart_item['data']->set_sale_price( $price_sale );
			}
		}

    }
}


// HIDE SHIPPING FROM CART
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );


// DISPLAY ONLY FREE SHIPPING WHEN AVAILABLE
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );



// 1. Switch PayPal email for CH

add_filter( 'woocommerce_paypal_args' , 'bbloomer_switch_paypal_email_based_product', 9999, 2 );

function bbloomer_switch_paypal_email_based_product( $paypal_args, $order ) {
// ENTER PRODUCT ID HERE
    if ( USER_REGION == 'CH' ) {
        // ENTER OTHER PAYPAL EMAIL HERE
        $paypal_args['business'] = 'compta@algorigin.co';
    }
    return $paypal_args;
}

// -------------------
// 2. Avoid IPN Failure after switching PayPal email for Product ID

require_once WC()->plugin_path() . '/includes/gateways/paypal/includes/class-wc-gateway-paypal-ipn-handler.php';

class WC_Gateway_Paypal_IPN_Handler_Switch extends WC_Gateway_Paypal_IPN_Handler {

    protected function validate_receiver_email( $order, $receiver_email ) {

        if ( strcasecmp( trim( $receiver_email ), trim( $this->receiver_email ) ) !== 0 ) {

            // ENTER HERE SAME PAYPAL EMAIL USED ABOVE
            if ( $receiver_email != 'compta@algorigin.co' && $receiver_email != 'compta@algorigin.com') {

                WC_Gateway_Paypal::log( "IPN Response is for another account: {$receiver_email}. Your email is {$this->receiver_email}" );
                $order->update_status( 'on-hold', sprintf( __( 'Validation error: PayPal IPN response from a different email address (%s).', 'woocommerce' ), $receiver_email ) );
                exit;

            }

        }

    }

}

new WC_Gateway_Paypal_IPN_Handler_Switch();

function example_callbackkk( ) {
    $woosb_bundles_before_text = __( get_option( '_woosb_bundles_before_text' ), 'algorigin-theme' );
    return $woosb_bundles_before_text;
}
add_filter( 'woosb_bundles_before_text', 'example_callbackkk' );
