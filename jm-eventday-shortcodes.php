<?php
/**
 * Plugin Name: Event Day Shortcodes
 * Plugin URI: http://github.com/joemcgill/jm-eventday-shortcodes
 * Description: Use shortcodes to create an event schedule
 * Version: The Plugin's Version Number, e.g.: 0.1
 * Author: Joe McGill
 * Author URI: http://twitter.com/joemcgill
 * License: GPL2
 */

// no direct links allowed
defined('ABSPATH') or die("No script kiddies please!");


// add shortcode
add_shortcode( 'jm-session', 'jm_session_shortcode' );

/**
 * Shortcode Function
 *
 * @author Joe McGill
 * @return html
 * @param array $atts
 * @param string $content
 **/
function jm_session_shortcode( $atts, $content = null ) {
	$a = array(
			'time' => ( array_key_exists('time', $atts) ) ? $atts['time'] : null,
			'title' => ( array_key_exists('title', $atts) ) ? $atts['title'] : null,
			'speaker' => ( array_key_exists('speaker', $atts) ) ? $atts['speaker'] : null,
			'speaker_img' => ( array_key_exists('speaker_img', $atts) ) ? $atts['speaker_img'] : null,
		);

	$html = "<div class=\"jm-session\">";
	// add time
	if ( $a['time'] ) {
		$html .= "  <time class=\"jm-session-time\">" . $a['time'] . "</time>";
	}
	// add speaker image
	if ( $a['speaker_img'] ) {
		$html .= "  <img class=\"jm-session-thumb\" src=\"" . $a['speaker_img'] . "\" />";
	}

	// begin content wrapper
	$html .= "	<div class=\"jm-session-content\">";

	// add session title
	if ( $a['title'] ) {
		$html .= "  	<h3 class=\"jm-session-title\">" . $a['title'] . "</h3>";
	}
	// add speaker name
	if ( $a['speaker'] ) {
		$html .= "  	<p class=\"jm-session-speaker\">" . $a['speaker'] . "</p>";
	}
	if ( $content ) {
		$html .= "  	<div class=\"jm-session-desc\">" . apply_filters( 'shortcode_content', $content ) . "</div>";
	}

	$html .= "	</div>";
	$html .= "</div>";

	return $html;
}

/* Apply filters to the shortcode content. */
	add_filter( 'shortcode_content', 'wpautop' );
	add_filter( 'shortcode_content', 'shortcode_unautop' );
	add_filter( 'shortcode_content', 'do_shortcode' );


// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_eventday_styles' );

/**
 * Register style sheet.
 */
function register_eventday_styles() {
	wp_register_style( 'jm-eventday-shortcodes', plugins_url( 'jm-eventday-shortcodes/shortcode-style.css' ) );
	wp_enqueue_style( 'jm-eventday-shortcodes' );
}

