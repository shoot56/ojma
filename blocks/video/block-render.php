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
$id = 'video-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

$video_type = get_field('video_type');
$video_file = get_field( 'video_file' );

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'video-block';
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
	<div class="video-block__frame">
		<?php if ( $video_type == 'youtube' ): ?>
			<div class="video-block__youtube">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo get_field('youtube_video_id'); ?>?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
			</div>
		<?php else: ?>
			<?php if ( $video_file ): ?>
				<div class="video-block__video">
					<video src="<?php echo esc_url( $video_file['url'] ); ?>#t=0.001" loop></video>
					<span class="video-block__video-play-pause">
						
					</span>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	
</section>
<?php endif; ?>