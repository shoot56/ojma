<?php 
/**
 * Block template file: block-render.php
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$id = 'btn-group-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}
// reset attributes for editor
if ($is_preview) {
	$wrapper_attributes = '';
}
?>

<?php /* style for Preview Only */ ?>
<?php if ($is_preview): ?>
<style type="text/css">
	<?php echo '#' . $id; ?> a {
		pointer-events: none;
	}
</style>
<?php endif ?>

<?php if (isset( $block['data']['preview_image_help'] )  ): ?>
	<?php 
	$fileUrl = str_replace(get_stylesheet_directory(), '', dirname(__FILE__), );
	echo '<img src="' . get_stylesheet_directory_uri() . $fileUrl . '/' . $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
	?>
<?php else: ?>
<div class="btn-group btn-group--<?php the_field( 'direction' ); ?> btn-group--<?php the_field( 'alignment' ); ?>" style="--gap:<?php the_field( 'gap' ); ?>px;">
	<?php if ( have_rows( 'buttons' ) ) : ?>
		<?php $counter = 0; ?>
		<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
			<div class="btn-group__item">
				<?php $button = get_sub_field( 'button' ); ?>
				<?php $button_icon = get_sub_field( 'button_icon' ); ?>
				<?php if ( $button ) : ?>
					<a class="btn btn--<?php the_sub_field( 'button_style' ); ?>" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>">
						<span class="btn__text"><?php echo esc_html( $button['title'] ); ?></span>
						<?php $button_icon = get_sub_field( 'button_icon' ); ?>
						<?php if ( $button_icon ) : ?>
							<span class="btn__icon btn__icon--<?php the_sub_field( 'icon_position' ); ?>"><?php sprite_svg($button_icon['ID'], '24', '24') ?></span>
						<?php endif; ?>
					</a>
				<?php endif; ?>
				
			</div>
			<?php $counter++; ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php endif; ?>