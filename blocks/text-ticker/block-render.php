<?php 
/**
 * Block template file: block-render.php
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-ticker-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'text-ticker';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}


$wrapper_attributes = get_block_wrapper_attributes([
	'class' => $classes
]);

?>

<?php if (isset( $block['data']['preview_image_help'] )  ): ?>
	<?php 
	$fileUrl = str_replace(get_stylesheet_directory(), '', dirname(__FILE__), );
	echo '<img src="' . get_stylesheet_directory_uri() . $fileUrl . '/' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
	?>
<?php else: ?>
<section id="<?php echo esc_attr( $id ); ?>" <?php echo $wrapper_attributes; ?>>
	<div class="customers-line">
		<?php if ( have_rows( 'items' ) ) : ?>
			<div class="customers-line__inner">
				<div class="customers-line__slide">
					<div class="customers-line__items-wrap" style="--speed: <?php the_field( 'animation_speed' ); ?>s;">
						<div class="customers-line__items marquee to-left">
							<?php while ( have_rows( 'items' ) ) : the_row(); ?>
								<?php if (get_sub_field( 'text' )): ?>
									<div class="customers-line__item">
										<div class="text-ticker__item"><?php echo get_sub_field( 'text' ); ?></div>
									</div>
								<?php endif ?>
							<?php endwhile; ?>
							<?php while ( have_rows( 'items' ) ) : the_row(); ?>
								<?php if (get_sub_field( 'text' )): ?>
									<div class="customers-line__item">
										<div class="text-ticker__item"><?php echo get_sub_field( 'text' ); ?></div>
									</div>
								<?php endif ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>