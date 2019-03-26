<?php
/*
Plugin Name: Custom Syntax Highlighter
Plugin URI: http://ahfakt.com
Description: Highlighter based on http://prismjs.com/
Author: ahfakt
Version: 1.0
Author URI: http://ahfakt.com
*/

defined('ABSPATH') or die('You are not allowed to call this page directly.');

class CustomSyntaxHighlighter {
	public static function ShortCode($atts, $content) {
			return isset($atts['lang']) ?
				'<pre class="wp-block-code"><code class="lang-'.$atts['lang'].' line-numbers">'.$content.'</code></pre>':
				'<pre class="wp-block-code"><code class="lang-none">'.$content.'</code></pre>';
	}
	public static function CallClient() {
		wp_register_style('cushl', plugin_dir_url(__FILE__).'prism.css');
		wp_register_script('cushl', plugin_dir_url(__FILE__).'prism.js');
		wp_enqueue_style('cushl');
		wp_enqueue_script('cushl');
	}
}

add_shortcode('sh', 'CustomSyntaxHighlighter::ShortCode');
add_action('wp_enqueue_scripts', 'CustomSyntaxHighlighter::CallClient');
add_filter('run_wptexturize', '__return_false');
