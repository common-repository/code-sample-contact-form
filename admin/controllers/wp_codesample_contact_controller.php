<?php
if (!defined('ABSPATH')) exit;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/admin
 * @author     Hung Truong <admin@codesamples.info>
 */
class Wp_codesample_contact_controller
{
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('init', array($this, 'ob_start'));
	}

	public function ob_start()
	{
		ob_start();
	}

	// Load view
	public static function view_list_contact()
	{
		if (!empty($_POST)) {
			$type = sanitize_text_field($_POST['submit_type']);
			$data_post = sanitize_post($_POST);
			$data['post_title'] = sanitize_text_field($_POST['post_title']);
			$data['post_content'] = !empty($data_post['fields']) ? serialize($data_post['fields']) : '';
			$data['config']['mail_recipient'] = is_email($_POST['mail_recipient']) ? sanitize_email($_POST['mail_recipient']) : get_option('admin_email');
			$data['config']['mail_cc'] = is_email($_POST['mail_cc']) ? sanitize_email($_POST['mail_cc']) : '';
			$data['config']['mail_subject'] = sanitize_text_field($_POST['mail_subject']);
			$data['config']['mail_send_success'] = sanitize_text_field($_POST['mail_send_success']);
			$data['config']['mail_send_unsuccess'] = sanitize_text_field($_POST['mail_send_unsuccess']);
			$data['config']['option']['show_captcha'] = isset($_POST['show_captcha']) ? sanitize_text_field($_POST['show_captcha']) : null;

			switch ($type) {
				case 'create':
					self::save_contact_form($data);
					break;
				case 'edit':
					self::update_contact_form(sanitize_text_field($_POST['post_id']), $data);
					break;
			}
		}

		$action = sanitize_text_field($_GET['action']);
		if ($action == 'delete') {
			self::delete_contact_form();
		}

		if ($action == 'edit') {
			$post_id = sanitize_text_field($_GET['post']);

			$contact = get_post($post_id);
			$meta_data = get_post_meta($post_id, 'config', true);
			require_once plugin_dir_path(__FILE__) . '../views/wp_codesample_contact-admin-edit.php';
		}

		if (empty($action)) {
			$args = array(
				'post_type' => 'cs_contact',
				'posts_per_page' => -1
			);
			$list_post = new WP_Query($args);

			require_once plugin_dir_path(__FILE__) . '../views/wp_codesample_contact-admin-list.php';
		}
	}

	public static function view_add_new_contact()
	{
		require_once plugin_dir_path(__FILE__) . '../views/wp_codesample_contact-admin-addnew.php';
	}

	public static function view_setting_contact()
	{
		if (!empty($_POST)) {
			$type = sanitize_text_field($_POST['submit_type']);

			if ($type == 'setting') {
				$option['setting']['captcha_site'] = sanitize_text_field($_POST['captcha-site-key']);
				$option['setting']['captcha_key'] = sanitize_text_field($_POST['captcha-secret-key']);

				$update = update_option('cs_contact', serialize($option));
				if ($update) {
					$message = 'Update-success';
					$redirect = add_query_arg('success', $message, admin_url('admin.php?page=setting_cs_contact', 'administrator'));
					wp_redirect($redirect);
					exit;
				}
			}
		}

		$data = unserialize(get_option('cs_contact', true));

		if (!empty($data)) {
			$capcha = $data['setting'];
		}
		require_once plugin_dir_path(__FILE__) . '../views/wp_codesample_contact-admin-setting.php';
	}

	public function save_contact_form($data)
	{
		$args = array(
			'post_title'    => wp_strip_all_tags($data['post_title']),
			'post_content'  => $data['post_content'],
			'post_status'   => 'publish',
			'post_type' => 'cs_contact'
		);

		$post_id = wp_insert_post($args);

		if (!empty($post_id)) {
			update_post_meta($post_id, 'config', $data['config']);
		}
	}

	public function update_contact_form($post_id, $data)
	{
		$args = array(
			'ID' =>  $post_id,
			'post_title'    => wp_strip_all_tags($data['post_title']),
			'post_content'  => $data['post_content'],
			'post_type' => 'cs_contact'
		);

		wp_update_post($args);

		if (!empty($post_id)) {
			update_post_meta($post_id, 'config', $data['config']);
		}
	}

	public function delete_contact_form()
	{
		$post_id = $_GET['post'];
		$action = sanitize_text_field($_GET['action']);

		if ($action == '-1') {
			$redirect = add_query_arg('error', 'Sorry,-you-must-select-an-action', admin_url('admin.php?page=cs_contact', 'administrator'));
			wp_redirect($redirect);
			exit;
		} else {
			if (!empty($post_id)) {
				if (is_array($post_id)) {
					foreach ($post_id as $id) {
						wp_delete_post($id, true);
					}
				} else {
					wp_delete_post($post_id, true);
				}

				$message = 'Delete-success';
				$redirect = add_query_arg('success', $message, admin_url('admin.php?page=cs_contact', 'administrator'));
				wp_redirect($redirect);
				exit;
			} else {
				$redirect = add_query_arg('error', 'Sorry,-you-must-select-contact-form', admin_url('admin.php?page=cs_contact', 'administrator'));
				wp_redirect($redirect);
				exit;
			}
		}
	}

	public function view_support_contact()
	{
		require_once plugin_dir_path(__FILE__) . '../views/wp_codesample_contact-admin-support.php';
	}
}
