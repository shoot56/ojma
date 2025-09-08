<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ojma
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-footer__wrap">
				<div class="site-footer__logo">
					<?php the_custom_logo(); ?>
				</div>
				<div class="site-footer__menu">
					<?php
					if (has_nav_menu( 'footer-menu' )) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_id'        => '',
								'container'      => '',
								'menu_class'     => 'footer-menu',
							)
						);
					}
					?>
				</div>
				<?php if (get_field( 'footer_copy_text', 'option' )): ?>
					<div class="site-footer__copy"><?php the_field( 'footer_copy_text', 'option' ); ?></div>
				<?php endif ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
