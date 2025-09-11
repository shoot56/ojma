<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ojma
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ojma' ); ?></a>
	<?php 
	if (get_field( 'header_style' )) {
		$header_style = 'site-header--' . get_field( 'header_style' );
	} else {
		$header_style = '';
	}
	?>
	<header id="masthead" class="site-header <?php echo $header_style; ?>">
		<?php if ( get_field( 'show_header_row_info', 'option' ) == 1 ) : ?>
			<div class="site-header__row">
				<div class="container">
					<div class="site-header__row-info">
						<div class="site-header__row-text"><?php the_field( 'header_row_info_text', 'option' ); ?></div>
						<div class="site-header__row-button">
							<?php $header_row_button = get_field( 'header_row_button', 'option' ); ?>
							<?php if ( $header_row_button ) : ?>
								<a class="btn site-header__row-btn" href="<?php echo esc_url( $header_row_button['url'] ); ?>" target="<?php echo esc_attr( $header_row_button['target'] ); ?>"><span class="btn__text"><?php echo esc_html( $header_row_button['title'] ); ?></span></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="site-header__frame">
			<div class="container">
				<div class="site-header__wrap">
					<div class="header-logo header-logo--desktop">
						<?php the_custom_logo(); ?>
					</div>
					<button aria-label="Mobile navigation" class="nav-opener"><span></span></button>
					<nav class="main-navigation">
						<div class="main-navigation__menu">
							<?php
							if (has_nav_menu( 'header-menu' )) {
								wp_nav_menu(
									array(
										'theme_location' => 'header-menu',
										'menu_id'        => '',
										'container'      => '',
										'menu_class'     => 'header-menu',
									)
								);
							}
							?>
						</div>
						<div class="main-navigation__button">
							<?php $header_contact_button = get_field( 'header_contact_button', 'option' ); ?>
							<?php if ( $header_contact_button ) : ?>
								<a href="<?php echo esc_url( $header_contact_button['url'] ); ?>" target="<?php echo esc_attr( $header_contact_button['target'] ); ?>" class="btn btn--primary">
									<span class="btn__icon"><?php sprite_svg('icon-arrow-right', '24', '24', false); ?></span>
									<span class="btn__text"><?php echo esc_html( $header_contact_button['title'] ); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
