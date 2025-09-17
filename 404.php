<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ojma
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404">
			<div class="container">
				<header class="error-404__header">
					<div class="error-404__num">404</div>
					<h1 class="error-404__title h2"><?php esc_html_e( 'Page not found', 'ojma' ); ?></h1>
				</header>
				<div class="error-404__content">
					<p><?php esc_html_e( 'It may have been moved or no longer exists.  Try using the menu at the top to find what you are looking for.', 'ojma' ); ?></p>
					<div class="error-404__button">
						<a href="/" class="btn btn--primary">
							<span class="btn__icon"><?php sprite_svg('icon-arrow-right', '24', '24', false); ?></span>
							<span class="btn__text">Go to home page</span>
						</a>
					</div>
				</div>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
