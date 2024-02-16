<!doctype html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Site meta -->
		<?php // Title gets automatically loaded by wp_head(); ?>
		<meta name="Keywords" content="Algorigin, Swiss, Algae, Experts, Quality, Health, Spirulina">

		<!-- Mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Favicons and themes -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() . '/assets/favicons/apple-touch-icon.png'; ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() . '/assets/favicons/favicon-32x32.png'; ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() . '/assets/favicons/favicon-16x16.png'; ?>">
		<link rel="manifest" href="<?php echo get_template_directory_uri() . '/assets/favicons/site.webmanifest'; ?>">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri() . '/assets/favicons/safari-pinned-tab.svg'; ?>" color="#263938">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/assets/favicons/favicon.ico'; ?>">
		<meta name="msapplication-TileColor" content="#263938">
		<meta name="msapplication-config" content="<?php echo get_template_directory_uri() . '/assets/favicons/browserconfig.xml'; ?>">
		<meta name="theme-color" content="#263938">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php /*if ( function_exists('cn_cookies_accepted') && cn_cookies_accepted() ) :*/ ?>
		<!-- Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118693535-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-118693535-1');
            gtag('config', 'G-LRF8JMJFFD');
		</script> 
		<?php /*endif; */?>




		<!-- WordPress head -->
		<?php wp_head(); ?>
	</head>

	<?php
		// Cart data
		global $woocommerce;
		$cart_product_amount = $woocommerce->cart->cart_contents_count;

		// Page references
		$page_refs = get_field('page_refs', 'options');
		$contact_info = get_field('contacts', 'options');
		$header_data = get_field('header', 'options');

		// User data
		global $current_user;
		$is_logged_in = is_user_logged_in();
		$user_name = $current_user->display_name;
		$login_button_text = __( 'Login / register', 'algorigin-theme' );
		if($is_logged_in) {
			$login_button_text = __( 'My profile', 'algorigin-theme' );
		}

		// Region data
		$current_region = USER_REGION;
		if(!empty($current_region)) {
			$region_flag_url = get_template_directory_uri() . '/assets/flags/' . strtolower($current_region) . '.svg';
		}
	?>

	<body <?php body_class(); ?>>

    <!-- pop up-->
    <?php
    $block_data = get_field('pop-up', 'options');
    if($block_data['display_pop_up'] && !isset($_COOKIE["PopUp"])) { ?>
        <script>
            // MODAL
            jQuery(window).load(function(){
                setTimeout(function (){
					$('.popup').css({
						'display' : 'block',
						'position' : 'fixed',
						'z-index'	: 99
					});

                }, 10000)
            });

            function ClosePopUp(){
                $('.popup').fadeOut(1000, function() {
                    $('.popup').css({
						'display' : 'none',
						'position' : 'relative',
						'z-index'	: 0
					});
                });
                document.cookie = "PopUp=1; path=/; expires=Tue, 19 Jan 2038 03:14:07 GMT"
            }

        </script>
        <div class="popup">
            <div class="popup__inner">
                <div class="popup__close"><button onclick="ClosePopUp()">X</button></div>
                <div class="popup__left">
                    <div class="popup__image" style="background-image:  url('<?php echo ($block_data['background_image']['url']); ?>')";></div>
                </div>
                <div class="popup__right">
                    <div class="popup__content">
                        <h3 class="expanded-product-card__title"><?php echo ($block_data['title']); ?></h3>
                        <?php echo do_shortcode($block_data['form_shortcode']); ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
			//setcookie("pop-up", 1, time()+8640000);//100 day
		}
    ?>

    <!--end pop up-->

		<!-- Site header -->
		<header class="header">
		
			<div class="header__top top-bar">
				<div class="container container--xl">
					<div class="top-bar__inner">
						<?php if(!empty($header_data['message_slider'])) : ?>
							<ul class="top-bar__messages message-slider js-topbar-message-slider">
								<?php if (USER_REGION == 'CH'): ?>
									<?php foreach($header_data['message_slider_ch'] as $key=> $slide) : ?>
									<li class="message-slider__item<?php if($key === 0) { echo ' is-active'; } ?>"><?php echo $slide['text']; ?></li>
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach($header_data['message_slider'] as $key=> $slide) : ?>
									<li class="message-slider__item<?php if($key === 0) { echo ' is-active'; } ?>"><?php echo $slide['text']; ?></li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<div class="top-bar__main">
							<div class="top-bar__region region-toggle">
								<button class="region-toggle__button has-icon-left js-region-settings-toggle"><?php icon_svg('globe'); ?><?php echo __( 'Region & language', 'algorigin-theme' ); ?></button>

								<?php if(!empty($current_region)) : ?>
								<div class="region-toggle__flag">
									<img src="<?php echo $region_flag_url; ?>" alt="<?php echo __( 'Country flag', 'algorigin-theme' ); ?> &mdash; <?php echo $current_region; ?>" class="region-toggle__img">
								</div>
								<?php endif; ?>

								<div class="top-bar__region-dropdown js-region-settings">
									<div class="top-bar__region-inner">
										<?php get_template_part('templates/components/region-settings'); ?>
									</div>
								</div>
							</div>
							<?php if (USER_REGION == 'CH'): ?>
								<a href="tel:<?php echo theme_get_formatted_tel($contact_info['phone_ch']); ?>" class="top-bar__call has-icon-left"><?php icon_svg('phone'); ?><?php echo $contact_info['phone_ch']; ?></a>
							<?php else: ?>
								<a href="tel:<?php echo theme_get_formatted_tel($contact_info['phone']); ?>" class="top-bar__call has-icon-left"><?php icon_svg('phone'); ?><?php echo $contact_info['phone']; ?></a>
							<?php endif; ?>
							<a href="<?php echo get_permalink($page_refs['account']); ?>" class="top-bar__login has-icon-left"><?php icon_svg('account'); ?><?php echo $login_button_text; ?></a>

							<a href="<?php echo wc_get_cart_url(); ?>" class="top-bar__cart cart-button" title="<?php _e('Your cart', 'algorigin-theme'); ?>">
								<?php icon_svg('cart'); ?>
								<div class="cart-button__amount js-cart-amount"><?php echo $cart_product_amount; ?></div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="header__main">
				<div class="container container--xl">
					<div class="header__inner">
						<div class="header__content">
							<div class="header__logo header-logo">
								<a href="<?php echo home_url(); ?>" class="header-logo__anchor"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" title="<?php echo __( 'Return to homepage', 'algorigin-theme' ); ?>" alt="Algorigin logo" class="header-logo__img" /></a>
							</div>

							<div class="header__menu">
								<nav class="header__nav header-nav">
									<?php
										wp_nav_menu([
											'menu' => __( 'Main navigation', 'algorigin-theme' ),
											'container' => false,
											'menu_class' => 'header-nav__items menu',
											'theme_location' => 'primary-nav',
											'walker'	=> new Theme_Mega_Menu()
										]);
									?>
								</nav>
							</div>
						</div>

						<ul class="header__actions actions">
							<?php if(!empty($header_data['espace_pro_link'])) : ?>
							<li class="actions__item header__espace"><a href="<?php echo $header_data['espace_pro_link']; ?>" rel="noopener" class="header__button button"><?php echo __( 'Espace PRO', 'algorigin-theme' ); ?></a></li>
							<?php endif; ?>
							<li class="actions__item"><button class="header__button button button--icon-only js-searchbar-toggle" title="<?php echo __( 'Search', 'algorigin-theme' ); ?>"><?php icon_svg('search'); ?></button></li>
						</ul>

						<ul class="header__secondary-actions actions actions--gaps-lg">
							<li class="actions__item header__secondary-account-button">
								<a href="<?php echo get_permalink($page_refs['account']); ?>" class="header__account-button" title="<?php echo $login_button_text; ?>"><?php icon_svg('account-thick'); ?></a>
							</li>

							<li class="actions__item header__secondary-region-toggle region-toggle region-toggle--mobile">
								<?php if(!empty($current_region)) : ?>
								<div class="region-toggle__flag">
									<img src="<?php echo $region_flag_url; ?>" alt="<?php echo __( 'Country flag', 'algorigin-theme' ); ?> &mdash; <?php echo $current_region; ?>" class="region-toggle__img">
								</div>
								<?php endif; ?>

								<button class="header__region-button js-region-settings-toggle" title="<?php echo __( 'Choose region', 'algorigin-theme' ); ?>"><?php icon_svg('globe'); ?></button>
							</li>

							<li class="actions__item">
								<a href="<?php echo wc_get_cart_url(); ?>" class="cart-button" title="<?php _e('Your cart', 'algorigin-theme'); ?>">
									<?php icon_svg('cart'); ?>
									<div class="cart-button__amount js-cart-amount"><?php echo $cart_product_amount; ?></div>
								</a>
							</li>

							<li class="actions__item header__secondary-search-button">
								<button class="header__search-button js-searchbar-toggle" title="<?php echo __( 'Search', 'algorigin-theme' ); ?>"><?php icon_svg('search'); ?></button>
							</li>
						</ul>

						<button class="header__mobile-toggle mobile-menu-toggle js-mobile-menu-toggle">
							<div class="mobile-menu-toggle__inner">
								<div class="mobile-menu-toggle__open">
									<span>&nbsp;</span>
									<span>&nbsp;</span>
									<span>&nbsp;</span>
								</div>
								<div class="mobile-menu-toggle__close">
									<span>&nbsp;</span>
									<span>&nbsp;</span>
								</div>
							</div>
						</button>
					</div>
				</div>
			</div>

			<div class="header__searchbar js-header-search">
				<div class="container container--xl">

					<form role="search" method="get" id="search-form" class="search-form search-form--header" action="<?php echo home_url( '/' ); ?>">
						<div class="text-field search-form__field">
							<input type="search" id="s" class="search-form__input text-field__input has-no-border" name="s" value="" placeholder="<?php echo __('Search for a product or page...', 'algorigin-theme'); ?>" />
							<label for="s" class="search-form__label text-field__placeholder"><?php echo __('Search for a product or page...', 'algorigin-theme'); ?></label>
						</div>

						<button type="submit" id="search-submit" class="search-form__submit button button--color-accent button--icon-mobile-only-bgless">
							<?php echo __('Enter search', 'algorigin-theme'); ?>
							<?php icon_svg('search'); ?>
						</button>
					</form>

				</div>
			</div>

			<div class="header__cart-notification notification-popup notification-popup--is-link js-notification-popup" data-notification-id="add-cart">
				<div class="container container--xl">
					<a href="<?php echo wc_get_cart_url(); ?>" class="notification-popup__inner">
						<div class="notification-popup__icons">
							<?php icon_svg('tick', 'notification-popup__icon'); ?>
						</div>
						<p class="notification-popup__text">&nbsp;</p>
					</a>
				</div>
			</div>
			<div class="notification-focus-overlay js-notification-focus-overlay">&nbsp;</div>
				
		</header>




		<!-- Site content -->
		<main class="main">
			<div class="header-offset">&nbsp;</div>
