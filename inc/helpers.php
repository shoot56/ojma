<?php 

function sprite_svg( $spriteName, $svgWidth = '24', $svgHeight = '24', $return = '' ) {
	$svg = get_stylesheet_directory_uri() . '/images/icons.svg?ver='. filemtime(get_template_directory() . '/images/icons.svg') .'#' . $spriteName;
	$elWidth = '';
	$elHeight = '';
	if (isset($svgWidth)) {
		$elWidth = 'width="' . $svgWidth . '"';
	}
	if (isset($svgHeight)) {
		$elHeight = 'height="' . $svgHeight . '"';
	}
	$iconHtml = '<svg class="svg-icon '. $spriteName .'" '.$elWidth.' '.$elHeight.' ><use xlink:href="' . $svg . '"></use></svg>';
	if ($return) {
		return $iconHtml;
	} else {
		echo $iconHtml;
	}
}

// Plugin ACF Svg icon field
add_filter( 'acf/fields/svg_icon/file_path', 'tc_acf_svg_icon_file_path' );
function tc_acf_svg_icon_file_path( $file_path ) {
	return get_theme_file_path( '/images/icons.svg' );
}


// Allow svg to upload
add_filter( 'upload_mimes', 'allow_svg' );
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

// Allow svg to display
add_filter( 'wp_kses_allowed_html', 'kses_allowed_svg' );


/**
 * Allow SVG.
 *
 * @param $types
 *
 * @return array
 */
function allow_svg( $types ): array {
	$new_types         = [];
	$new_types['svg']  = 'image/svg+xml';
	$new_types['svgz'] = 'image/svg+xml';

	return array_merge( $types, $new_types );
}

/**
 * Fix SVG mime type
 *
 * @param $data
 * @param $file
 * @param $filename
 * @param $mimes
 * @param string $real_mime
 *
 * @return mixed
 */
function fix_svg_mime_type( $data, $file, $filename, $mimes, string $real_mime = '' ) {
	// WP 5.1 +
	if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ], true );
	} else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, - 4 ) ) );
	}
	if ( $dosvg ) {
		if ( current_user_can( 'manage_options' ) ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		} else {
			$data['ext']  = false;
			$data['type'] = false;
		}
	}

	return $data;
}

/**
 * Allow SVG attributes.
 *
 * @param $tags
 *
 * @return mixed
 */
function kses_allowed_svg( $tags ) {
	$tags['svg']  = [
		'width'       => [],
		'height'      => [],
		'xmlns'       => [],
		'fill'        => [],
		'viewbox'     => [],
		'role'        => [],
		'aria-hidden' => [],
		'focusable'   => [],
		'class'       => [],
	];
	$tags['path'] = [
		'd'    => [],
		'fill' => [],
	];
	$tags['use']  = [
		'xlink:href' => [],
	];
	$tags['mask'] = [];
	$tags['g']    = [];

	return $tags;
}

function get_excerpt_trim($num_words='20', $more='...', $post_id = ''){
	$excerpt = get_the_excerpt($post_id);
	$excerpt = wp_trim_words( $excerpt, $num_words , $more );
	return $excerpt;
}

// remove <br> and <p> from CF7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Adjust contact form 7 radios and checkboxes to match bootstrap 4 custom radio structure.
 */
add_filter('wpcf7_form_elements', function ($content) {
    $content = preg_replace('/<label><input type="(checkbox|radio)" name="(.*?)" value="(.*?)" \/><span class="wpcf7-list-item-label">/i', '<label class="checkbox-holder"><input type="\1" name="\2" value="\3" class="checkbox-holder__input"><span class="checkbox-item">&nbsp;</span><span class="checkbox-holder__label">', $content);

    return $content;
});


function extract_youtube_id($url) {
	$pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
	preg_match($pattern, $url, $matches);
	return $matches[1] ?? null;
}