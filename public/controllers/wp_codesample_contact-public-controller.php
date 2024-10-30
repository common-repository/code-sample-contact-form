<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/public/partials
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

class Wp_codesample_contact_public_controller
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
    public function __construct()
    {
        add_action('init', array($this, 'ob_start'));
        add_shortcode('cs-contact', array($this, 'load_cs_contact_form'));
    }

    public function ob_start()
    {
        ob_start();
    }

    public function load_cs_contact_form($atts = [], $content = null)
    {
        // Remove POST
        if (!isset($_SESSION)) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['postdata'] = $_POST;
            unset($_POST);
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (@$_SESSION['postdata']) {
            $_POST = $_SESSION['postdata'];
            unset($_SESSION['postdata']);
        }

        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        $code = CODE_ERROR;
        $error = new WP_Error();
        $post_id = $atts['id'];
        $message = [];
        if (!empty($post_id)) {
            $data = get_post($post_id);
            $fields = unserialize($data->post_content);
            $rule_arr = $this->get_rules($fields);
            $validation = new validation($rule_arr, $code, $error);

            $meta_data = get_post_meta($post_id, 'config', true);
            $options = unserialize(get_option('cs_contact'));

            if ($_POST) {

                // Remove some thing unnecessary from POST
                if (!empty($meta_data['option']['show_captcha']) && sanitize_text_field($_POST['g-recaptcha-response']) == '') {
                    wp_redirect(home_url('/contact'), 301);
                    exit;
                }
                $unset = ['_wpnonce', '_wp_http_referer', 'submit_form', 'g-recaptcha-response'];
                $info = $this->sanitize_data($fields, array_diff_key($_POST, array_flip($unset)));

                // Check validate form
                $validation->check_validate($info);
                if (is_wp_error($error)) {
                    $error_message = $error->get_error_messages($code);
                }

                if (empty($error_message)) {
                    $args = array(
                        'recipient' => $meta_data['mail_recipient'],
                        'subject' => $meta_data['mail_subject'],
                        'cc' => !empty($meta_data['mail_cc']) ? $meta_data['mail_cc'] : '',
                        'info' => $info
                    );

                    $mail = new cs_mail($args);
                    if ($mail->cs_send_mail()) {
                        $message['mes_sendmail'] = $meta_data['mail_send_success'];
                    } else {
                        $message['mes_sendmail_fail'] = $meta_data['mail_send_unsuccess'];
                    }
                } else {
                    $message = $error_message;
                }
            }
            // Only display form
            require(plugin_dir_path(__FILE__) . '../views/single_form/cs_contact_form.php');
        }
    }

    public function get_rules($fields = [])
    {
        $rule_arr = [];
        if (!empty($fields)) {
            foreach ($fields as $key => $item) {
                $arrs = parse_attr_to_array($item);

                if ($arrs['required'] == 1) {
                    $rule_arr[$arrs['name']][] = 'required';
                }
                if ($arrs['type'] == 'number') {
                    $rule_arr[$arrs['name']][] = 'number';
                }
                if ($arrs['type'] == 'email') {
                    $rule_arr[$arrs['name']][] = 'email';
                }
                if ($arrs['type'] == 'tel') {
                    $rule_arr[$arrs['name']][] = 'tel';
                }
                if ($arrs['type'] == 'url') {
                    $rule_arr[$arrs['name']][] = 'url';
                }
            }
        }

        return $rule_arr;
    }

    public function sanitize_data($fields = [], $data = [])
    {
        $text_type = [];
        foreach ($fields as $key => $item) {
            $arrs = parse_attr_to_array($item);
            $text_type[$arrs['name']] = $arrs['type'];
        }
        foreach ($data as $k => $v) {
            switch ($text_type[$k]) {
                case 'text':
                    $data[$k] = sanitize_text_field($v);
                    break;
                case 'textarea':
                    $data[$k] = nl2br(sanitize_textarea_field($v));
                    break;
                case 'email':
                    $data[$k] = sanitize_email($v);
                    break;
                case 'url':
                    $data[$k] = sanitize_url($v);
                    break;
            }
        }

        return $data;
    }
}

new Wp_codesample_contact_public_controller();
