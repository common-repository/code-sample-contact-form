<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/includes
 * @author     Hung Truong <admin@codesamples.info>
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/mail.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/formatting.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/validation.php';

function load_field_type($list_attr = [])
{
	$dir = plugin_dir_path(dirname(__FILE__));
	$path = 'fields/' . $list_attr['type'] . '.php';
	if (empty($dir) or !is_dir($dir)) {
		return false;
	}

	$path = path_join($dir, ltrim($path, '/'));

	if (file_exists($path)) {
		include $path;
		return true;
	}
	return false;
}

function contact_fields_default()
{
	$fields = [
		[
			'id' => 'dfn1',
			'label' => 'Name',
			'name' => '_name',
			'type' => 'text',
			'required' => 1,
			'minlength' => '',
			'maxlength' => '',
			'default_value' => '',
			'options' => '',
			'option_default' => '',
			'placeholder' => '',
			'class_field' => ''
		],
		[
			'id' => 'dfe3',
			'label' => 'Email',
			'name' => '_email',
			'type' => 'email',
			'required' => 1,
			'minlength' => '',
			'maxlength' => '',
			'default_value' => '',
			'options' => '',
			'option_default' => '',
			'placeholder' => '',
			'class_field' => ''
		],
		[
			'id' => 'dfs2',
			'label' => 'Title',
			'name' => '_title',
			'type' => 'text',
			'required' => 1,
			'minlength' => '',
			'maxlength' => '',
			'default_value' => '',
			'options' => '',
			'option_default' => '',
			'placeholder' => '',
			'class_field' => ''
		],
		[
			'id' => 'dfc4',
			'label' => 'Message',
			'name' => '_message',
			'type' => 'textarea',
			'required' => 0,
			'default_value' => '',
			'options' => '',
			'option_default' => '',
			'placeholder' => '',
			'class_field' => ''
		]
	];

	return $fields;
}
