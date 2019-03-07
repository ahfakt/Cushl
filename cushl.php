<?php
/*
Plugin Name: Custom Syntax Highlighter
Plugin URI: http://ahfakt.com
Description: Highlighter based on http://prismjs.com/
Author: ahfakt
Version: 0.1
Author URI: http://ahfakt.com
*/

defined('ABSPATH') or die('You are not allowed to call this page directly.');

class CustomSyntaxHighlighter {
	public static function ShortCode($atts, $content) {
		if(is_null($atts['lang']))
			return $content;
		return '<code class="language-'.$atts['lang'].' line-numbers">'.$content.'</code>';
	}
	public static function AddQTagButton() {
		$args = array(
			'id' => 'sh',
			'display' => 'sh',
			'before' => '<pre>[sh lang=\"\"]',
			'after' => '[/sh]</pre>',
			'access_key' => 'p',
			'alt' => 'Code',
			'priority' => '9', // 1 - 9 = first, 11 - 19 = second ...
			'instance' => 'sh');
		echo '<script language="javascript" type="text/javascript" charset="utf-8">QTags.addButton("'.$args['id'].'", "'.$args['display'].'", "'.$args['before'].'", "'.$args['after'].'", "'.$args['access_key'].'", "'.$args['alt'].'");</script>';
	}
	public static function CallClient() {
		wp_register_style('cushl', plugin_dir_url(__FILE__).'prism.css');
		wp_register_script('cushl', plugin_dir_url(__FILE__).'prism.js');
		wp_enqueue_style('cushl');
		wp_enqueue_script('cushl');
	}
}

add_shortcode('sh', 'CustomSyntaxHighlighter::ShortCode');
add_action('admin_footer-post.php', 'CustomSyntaxHighlighter::AddQTagButton');
add_action('wp_enqueue_scripts', 'CustomSyntaxHighlighter::CallClient');
add_filter('run_wptexturize', '__return_false');
