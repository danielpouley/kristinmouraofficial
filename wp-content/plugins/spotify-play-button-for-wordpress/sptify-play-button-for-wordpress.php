<?php
/**
* Plugin Name: Sp*tify Play Button for WordPress
* Plugin URI: https://plugins.followmedarling.se/spotify-play-button-for-wordpress/
* Description: Show Spotify Play Button in any page or post with a Gutenberg block, or with a simple hook (visit https://plugins.followmedarling.se/spotify-play-button-for-wordpress/ for examples).
* Version: 2.05
* Author: Jonk @ Follow me Darling
* Author URI: https://plugins.followmedarling.se/
* Domain Path: /languages
* Text Domain: sptifyplaybutton_text
**/

$spotifyplaybutton_path = plugin_dir_url( __FILE__ );

function spotifyplaybutton_load_textdomain() {
	load_plugin_textdomain( 'sptifyplaybutton_text', false, WP_LANG_DIR ); 
}
add_action( 'plugins_loaded', 'spotifyplaybutton_load_textdomain' ); //plugins_loaded

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'spotifyplaybutton_settings_link' );
function spotifyplaybutton_settings_link( $links ) {
	$links[] = '<a href="' . admin_url( 'options-general.php?page=spotifyplaybutton_settings' ) . '">' . __( 'Settings' ) . '</a>';
	return $links;
}

function spotifyplaybutton_menu() {
	add_options_page('Sp*tify Play Button settings', 'Sp*tify Play Button settings', 'manage_options', 'spotifyplaybutton_settings', 'spotifyplaybutton_options');
}
add_action('admin_menu', 'spotifyplaybutton_menu');

function spotifyplaybutton_options() {
	global $spotifyplaybutton_Order;
	global $spotifyplaybutton_OrderType;

	if( isset($_POST['save_spotifyplaybutton_settings'] )) {

        update_option('spotifyplaybutton_size', $_POST['spotifyplaybutton_size'] );
        update_option('spotifyplaybutton_sizetype', $_POST['spotifyplaybutton_sizetype'] );
        update_option('spotifyplaybutton_link', $_POST['spotifyplaybutton_link'] );

		echo "<div id=\"message\" class=\"updated fade\"><p>Your settings are now updated</p></div>\n";
		
	}
	$spotifyplaybutton_size = stripslashes( get_option( 'spotifyplaybutton_size' ) );
	$spotifyplaybutton_sizetype = stripslashes( get_option( 'spotifyplaybutton_sizetype' ) );
	$spotifyplaybutton_link = stripslashes( get_option( 'spotifyplaybutton_link' ) );	
	?>
  <div class="wrap">
	<h2>Sp*tify Play Button settings</h2>
	<form method="post">
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Max width</th>
				<td>
					<input type="text" style="width:200px;" name="spotifyplaybutton_size" id="spotifyplaybutton_size" value="<?php if (isset($spotifyplaybutton_size) && $spotifyplaybutton_size != '') { print($spotifyplaybutton_size); } else { print('0'); } ?>"/>
					<br/><span style="font-style:italic;">Example: 500, enter 0 for full responsive mode, ie 100% width (recommended)</span>
				</td> 
			</tr>
			<tr valign="top">
				<th scope="row">Size type</th>
				<td>
					<select style="width:200px;" name="spotifyplaybutton_sizetype" id="spotifyplaybutton_sizetype">
						<option <?php if ($spotifyplaybutton_sizetype == 'big') { echo 'selected="selected"'; } ?> value="big">Big</option>
						<option <?php if ($spotifyplaybutton_sizetype == 'compact') { echo 'selected="selected"'; } ?> value="compact">Compact</option>
					</select>
					<br/><span style="font-style:italic;">Big has the playlist or coverart visible. Compact shows the current song.</span>
				</td> 
			</tr>
			<tr valign="top">
				<th scope="row">Link</th>
				<td>
					<select style="width:200px;" name="spotifyplaybutton_link" id="spotifyplaybutton_link">
						<option <?php if ($spotifyplaybutton_link == 'yes') { echo 'selected="selected"'; } ?> value="">Yes</option>
						<option <?php if ($spotifyplaybutton_link == 'no') { echo 'selected="selected"'; } ?> value="no">No</option>
					</select>
					<br/><span style="font-style:italic;">Shows a link to the playlist below</span>
				</td> 
			</tr>
		</table>

		<div class="submit">
			<input type="submit" name="save_spotifyplaybutton_settings" value="<?php _e('Save Settings') ?>" class="button-primary" />
		</div>		
	</form>
  </div>
<?php
}

function spotifyplaybutton_func( $atts ) {
	extract( shortcode_atts( array(
		'play' => 'spotify:user:jonk:playlist:2ImDreMyt1Py2iXKtmEStW',
		'size' => get_option('spotifyplaybutton_size',0),
		'sizetype' => get_option('spotifyplaybutton_sizetype','big'),
		'link' => get_option('spotifyplaybutton_link','yes'),
	), $atts ) );
	
	$size = round($size);
	$width = '100%';
	$min_height = '';
	if ($size != 0) {
		$width = $size;
	}
	if ($sizetype == "compact") {
		$height = 80;
		$min_height = "min-height:{$height}px;";
	} else {
		if ($size == 0) {
			$height = '500';
		} else {
			$height = $size+80;
		}
	}
	$open_spotify_link = '';
	if ( $link != 'no' ) {
		if ( strpos( $play, 'https://' ) !== false ) {
			$url = $play;
		} else {
			$url = str_replace( ":", "/", $play );
			$url = str_replace( "spotify/", "https://open.spotify.com/", $url );
		}
		$open_spotify_link = "<p><a href=\"" . $url . "\" target=\"_blank\">" . __("Open in Spotify", "sptifyplaybutton_text") . "</a></p>";
	}

	return "<iframe src=\"https://open.spotify.com/embed?uri={$play}\" width=\"{$width}\" height=\"{$height}\" frameborder=\"0\" allowTransparency=\"true\" allow=\"encrypted-media\" style=\"max-width:{$width}px;max-height:{$height}px;{$min_height}\"></iframe>" . $open_spotify_link;
}
add_shortcode( 'spotifyplaybutton', 'spotifyplaybutton_func' );

function spotifyplaybutton_tinymce_button($context){
	printf( "<a href=\"#TB_inline?&inlineId=spotifyplaybutton_tinymce_popup&width=600&height=550\" class=\"button thickbox\" id=\"spotifyplaybutton_tinymce_popup_button\" title=\"Add Sp*tify Play Button\"><img src=\"" . plugin_dir_url( __FILE__ ) . "sptify-play-button-for-wordpress-icon.png\" alt=\"Add Sp*tify Play Button\" style=\"width:auto;height:16px;vertical-align:text-top;display:inline-block;margin:0;\"></a>");
}
add_action('media_buttons', 'spotifyplaybutton_tinymce_button');

function spotifyplaybutton_tinymce_popup(){ 
?>
<div id="spotifyplaybutton_tinymce_popup" style="display:none;">
	<div class="wrap" style="position:absolute;">
		<div>
			<div class="my_shortcode_add">
				<p>
					<input type="text" id="spotifyplaybutton_tinymce_popup_playlist" placeholder="<?php _e("Spotify URI", "sptifyplaybutton_text"); ?> *" style="width:100%;">
				</p>
				<p>
					<button class="button-primary" id="spotifyplaybutton_tinymce_popup_insert_button"><?php _e("Insert the Sp*tify Play Button", "sptifyplaybutton_text"); ?></button>
				</p>
				<p>
					* <?php _e("Right-click on a playlist or album in Spotify, choose Share, click URI and then paste the result in the box above. Finish by clicking the button.", "sptifyplaybutton_text"); ?>
				</p>
				<hr>
				<p>
					<a href="<?php menu_page_url( 'spotifyplaybutton_settings', true ); ?>"><?php _e("Edit general settings for Sp*tify Play Button", "sptifyplaybutton_text"); ?></a> <?php _e("or add parameters to your shortcode if you want to make this one special.", "sptifyplaybutton_text"); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<?php
}
add_action('admin_footer', 'spotifyplaybutton_tinymce_popup');

function my_shortcode_add_shortcode_to_editor(){?>
<script>
jQuery('#spotifyplaybutton_tinymce_popup_insert_button').on('click',function(){
	var user_content = jQuery('#spotifyplaybutton_tinymce_popup_playlist').val();
	var shortcode = '[spotifyplaybutton play="'+user_content+'"]';
	if( !tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
		jQuery('textarea#content').val(shortcode);
	} else {
		tinyMCE.execCommand('mceInsertContent', false, shortcode);
	}
	self.parent.tb_remove();
});
</script>
<?php
}
add_action('admin_footer','my_shortcode_add_shortcode_to_editor');

function spotifyplaybuttonBlockFiles() {
	wp_enqueue_script(
		'spotify-play-button-for-wordpress',
		plugin_dir_url( __FILE__ ) . 'js/sptify-play-button-for-wordpress-admin.js',
		array( 'wp-blocks', 'wp-i18n' ),
		true
	);
	wp_enqueue_style(
		'spotify-play-button-for-wordpress',
		plugin_dir_url( __FILE__ ) . 'css/sptify-play-button-for-wordpress-admin.css',
		null,
		false
	);
}
add_action( 'enqueue_block_editor_assets', 'spotifyplaybuttonBlockFiles' );

function spotifyplaybutton_block_do_shortcode( $attr ) {
	$spotifyUri = "";
	$size = "";
	$sizetype = "";
	$link = "";
	if ( isset( $attr['spotifyUri'] ) && $attr['spotifyUri'] != "" ) {
		$spotifyUri = 'play="' . $attr['spotifyUri'] . '" ';
	}
	if ( isset( $attr['size'] ) && $attr['size'] != "" ) {
		$size = 'size="' . $attr['size'] . '" ';
	}
	if ( isset( $attr['sizetype'] ) && $attr['sizetype'] != "" ) {
		$sizetype = 'sizetype="' . $attr['sizetype'] . '" ';
	}
	if ( isset( $attr['link'] ) && $attr['link'] != "" ) {
		$link = 'link="' . $attr['link'] . '" ';
	}
	return do_shortcode( '[spotifyplaybutton ' . $spotifyUri . $size . $sizetype . $link . ']' );
}

register_block_type( 'spotify-play-button-for-wordpress/play-button', array(
	'render_callback' => 'spotifyplaybutton_block_do_shortcode',
	'attributes' => [
		'spotifyUri' => [
			'type' => 'string'
		],
		'size' => [
			'type' => 'string',
		],
		'sizetype' => [
			'type' => 'string',
		],
		'link' => [
			'type' => 'string',
		],
	]
) );
