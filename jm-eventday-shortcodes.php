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


/**
 * // SHORTCODE INPUT EXAMPL
 * [jm-session time="9 AM" title="What I Want" speaker="Joe McGIll" speaker_img="http://placehold.it/150"]
 * 	This is a description of the session, you can put HTML or anything into this section.
 * [/jm-session]
 *
 * // SHORTCODE OUTPUT EXAMPLE
 * <div class="jm-session">
 *	<time class="jm-session-time">9 AM</time>
 *	<img class="jm-session-thumb" src="http://placehold.it/150" alt="Joe McGill" />
 *	<h3 class="jm-session-title">What I Want</h3>
 *	<p class="jm-session-speaker">Joe McGill</p>
 *	<div class="jm-session-desc">
 *		// ... HTML GOES HERE
 *	</div>
 * </div>
 *
 */


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
			'time' => ($atts['time']) ? $atts['time'] : null,
			'title' => ($atts['title']) ? $atts['title'] : null,
			'speaker' => ($atts['speaker']) ? $atts['speaker'] : null,
			'speaker_img' => ($atts['speaker_img']) ? $atts['speaker_img'] : null,
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
	// add session title
	if ( $a['title'] ) {
		$html .= "  <h3 class=\"jm-session-title\">" . $a['title'] . "</h3>";
	}
	// add speaker name
	if ( $a['speaker'] ) {
		$html .= "  <p class=\"jm-session-speaker\">" . $a['speaker'] . "</p>";
	}
	if ( $content ) {
		$html .= "  <div class=\"jm-session-desc\">" . apply_filters( 'shortcode_content', $content ) . "</div>";
	}

	$html .= "</div>";

	return $html;
}

add_shortcode( 'jm-session', 'jm_session_shortcode' );


/* Apply filters to the shortcode content. */
		add_filter( 'shortcode_content', 'wpautop' );
		add_filter( 'shortcode_content', 'shortcode_unautop' );
		add_filter( 'shortcode_content', 'do_shortcode' );