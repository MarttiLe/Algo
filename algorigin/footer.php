		</main>


		<?php
			$instagram_data = get_field('instagram_block', 'options');
			$page_id = get_the_ID();

			if(!empty($instagram_data['display_block_instagram']) && in_array($page_id, $instagram_data['display_on_pages'])) {
				$block_attr = [];
				get_template_part('templates/blocks/instagram', null, $block_attr);
			}
		?>


		<!-- Site footer -->
		<?php
			$footer_data = get_field('footer', 'options');

			$assurances_classes = '';
			if(is_front_page()) {
				$assurances_classes = ' has-no-border-top has-no-margin-top';
			}
		?>
		<footer class="footer">
			<div class="footer__container container container--lg">

				<div class="footer__assurances<?php echo $assurances_classes; ?>">
					<ul class="footer__assurances-items assurances">
						<?php if(!empty($footer_data['assurances']['payment']['title']) && !empty($footer_data['assurances']['payment']['text'])) : ?>
						<li class="assurances__item">
							<?php icon_svg('shield', 'assurances__icon'); ?>
							<h4 class="assurances__title"><?php echo $footer_data['assurances']['payment']['title']; ?></h4>
							<p class="assurances__text"><?php echo $footer_data['assurances']['payment']['text']; ?></p>
						</li>
						<?php endif; ?>
						
						
						<?php if(!empty($footer_data['assurances']['shipping']['title']) && !empty($footer_data['assurances']['shipping']['text'])) : ?>
						<li class="assurances__item">
							<?php icon_svg('delivery', 'assurances__icon assurances__icon--lg'); ?>
							<?php if (USER_REGION == 'CH'): ?>
								<h4 class="assurances__title"><?php echo $footer_data['assurances']['shipping_ch']['title']; ?></h4>
								<p class="assurances__text"><?php echo $footer_data['assurances']['shipping_ch']['text']; ?></p>
							<?php else: ?>
								<h4 class="assurances__title"><?php echo $footer_data['assurances']['shipping']['title']; ?></h4>
								<p class="assurances__text"><?php echo $footer_data['assurances']['shipping']['text']; ?></p>
							<?php endif; ?>
						</li>
						<?php endif; ?>
						

						<?php if(!empty($footer_data['assurances']['service']['title']) && !empty($footer_data['assurances']['service']['text'])) : ?>
						<li class="assurances__item">
							<?php icon_svg('chat', 'assurances__icon'); ?>
							<h4 class="assurances__title"><?php echo $footer_data['assurances']['service']['title']; ?></h4>
							<p class="assurances__text"><?php echo $footer_data['assurances']['service']['text']; ?></p>
						</li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="footer__main">
					<div class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php echo $footer_data['copyright_text']; ?></div>

					<nav class="footer__nav inline-nav">
					
							<?php if(USER_REGION === 'CH') : ?>
							<?php
								wp_nav_menu([
									'menu' => __( 'Footer navigation ch', 'algorigin-theme' ),
									'container' => false,
									'menu_class' => 'inline-nav__items menu',
								]);
							?>
							<?php else : ?>
							<?php
								wp_nav_menu([
									'menu' => __( 'Footer navigation', 'algorigin-theme' ),
									'container' => false,
									'menu_class' => 'inline-nav__items menu',
									'theme_location' => 'footer-nav',
								]);
							?>
							<?php endif; ?>
						
					</nav>
				</div>
			
			</div>
		</footer>

		<!-- WP footer -->
		<?php wp_footer(); ?>

	</body>

</html>