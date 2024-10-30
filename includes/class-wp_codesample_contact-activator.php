<?php

/**
 * Fired during plugin activation
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/includes
 * @author     Hung Truong <admin@codesamples.info>
 */
class Wp_codesample_contact_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		$args = [
			'labels' => [
				'name' => 'CS Contact'
			],
			'description' => 'CS Contact Custom Post',
			'supports' => [
				'title',
				'editor',
				'excerpt',
				'author',
			],
			'public' => true
		];
		$result = register_post_type('cs_contact', $args);
	}
}
