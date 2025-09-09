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
$id = 'info-blocks-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}


// Create class attribute allowing for custom "className" and "align" values.
$classes = 'info-blocks';
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

<?php /* style for Preview Only */ ?>
<?php if ($is_preview): ?>
<style type="text/css">
	<?php echo '#' . $id; ?> {
		overflow: hidden;
	}
</style>
<?php endif ?>

<?php if (isset( $block['data']['preview_image_help'] )  ): ?>
	<?php 
	$fileUrl = str_replace(get_stylesheet_directory(), '', dirname(__FILE__), );
	echo '<img src="' . get_stylesheet_directory_uri() . $fileUrl . '/' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
	?>
<?php else: ?>
<section id="<?php echo esc_attr( $id ); ?>" <?php echo $wrapper_attributes; ?>>
	<?php if ( have_rows( 'items' ) ) : ?>
		<ul class="info-blocks__list">
			<?php while ( have_rows( 'items' ) ) : the_row(); ?>
				<?php $icon = get_sub_field( 'icon' ); ?>
				<li class="info-blocks-item">
					<div class="info-blocks-item__head">
						<?php if (get_sub_field( 'title' )): ?>
							<div class="info-blocks-item__title"><?php echo get_sub_field( 'title' ); ?></div>
						<?php endif ?>
						<div class="info-blocks-item__visual">
							<?php if ( $icon ) : ?>
								<div class="info-blocks-item__icon">
									<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php if (get_sub_field( 'value' )): ?>
						<div class="info-blocks-item__value"><?php echo get_sub_field( 'value' ); ?></div>
					<?php endif ?>
					<?php if (get_sub_field( 'description' )): ?>
						<div class="info-blocks-item__description"><?php echo get_sub_field( 'description' ); ?></div>
					<?php endif ?>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</section>
<?php endif; ?>