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
$id = 'cta-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

// wp_enqueue_style('block-cta');


// Create class attribute allowing for custom "className" and "align" values.
$classes = 'cta';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}

$wrapper_attributes = get_block_wrapper_attributes([
	'class' => $classes
]);

$template = array(
	
);

$allowed = array(
	
)

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
	<span class="cta__deco"></span>
	<span class="cta__deco"></span>
	<span class="cta__deco"></span>
	<span class="cta__deco"></span>
	<InnerBlocks class="cta__content" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" />
</section>

<script type="text/javascript">
	function resizeBoard(board) {
		const width = board.offsetWidth;
		const height = board.offsetHeight;
		const cols = Math.round(width / 34);
		const rows = Math.round(height / 34);
		const mcols = Math.round(width / 10);
		const mrows = Math.round(height / 10);
		board.style.setProperty('--cols', cols);
		board.style.setProperty('--rows', rows);
		board.style.setProperty('--mcols', mcols);
		board.style.setProperty('--mrows', mrows);
	}
	function initCheckerboards() {
		const boards = document.querySelectorAll('.cta');
		boards.forEach(board => resizeBoard(board));
	}
	window.addEventListener('resize', initCheckerboards);
	window.addEventListener('DOMContentLoaded', initCheckerboards);
</script>
<?php endif; ?>