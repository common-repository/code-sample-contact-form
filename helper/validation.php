<?php

/**
 * All function proccess validate field form.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    validation
 * @subpackage Wp_codesample_contact/helper/validation
 */

/**
 * All function proccess validate field form.
 *
 *
 * @package    validation
 * @subpackage Wp_codesample_contact/helper/validation
 * @author     Hung Truong <admin@codesamples.info>
 */

class validation
{
    private $rule_args = array();
    private $error; // type of WP_Error
    private $code; // Code of WP_Error

    public function __construct($rule_args = [], $code, $error)
    {
        $this->rule_args = $rule_args;
        $this->error = $error;
        $this->code = $code;
    }

    public function check_validate($request = [])
    {
        $error = $this->error;
        $rules = $this->rule_args;

        if (!empty($request)) {
            $diff = array_diff_key($rules, $request);
            $message = [];
            if (!empty($diff)) {
                foreach ($diff as $field => $val) {
                    $name = upword_format($field);
                    $message = sprintf(__('<span class="field_name_validate">%s</span> is required', 'cs_contact'), $name);
                    $error->add($this->code, $message);
                }
            }

            foreach ($request as $key => $val) {
                if (!empty($rules[$key])) {
                    foreach ($rules[$key] as $rule) {
                        $field_name = upword_format($key);
                        switch (trim($rule)) {
                            case 'required':
                                if ($val == '' || empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> is required', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                            case 'email':
                                if (!is_email($val) && !empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> is incorrect format', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                            case 'number':
                                if (!$this->check_number($val) && !empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> must be numeric', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                            case 'tel':
                                if (!$this->check_tel($val) && !empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> is incorrect format', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                            case 'url':
                                if (!$this->check_url($val) && !empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> is incorrect format', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                            case 'date':
                                if (!$this->check_date($val) && !empty($val)) {
                                    $message = sprintf(__('<span class="field_name_validate">%s</span> is incorrect format', 'cs_contact'), $field_name);
                                    $error->add($this->code, $message);
                                }
                                break;
                        }
                    }
                }
            }
        }
    }

    /**
     * Checks text is a number.
     */
    public function check_number($text)
    {
        $result = false;
        $patterns = array(
            '/^[-]?[0-9]+(?:[eE][+-]?[0-9]+)?$/',
            '/^[-]?(?:[0-9]+)?[.][0-9]+(?:[eE][+-]?[0-9]+)?$/',
        );

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text)) {
                $result = true;
                break;
            }
        }
        return $result;
    }

    /**
     * Checks  text is a telephone number.
     */
    public function check_tel($text)
    {
        $text = preg_replace('%[()/.*#\s-]+%', '', $text);
        $result = preg_match('/^[+]?[0-9]+$/', $text);
        return $result;
    }

    /**
     * Checks text is a URL.
     */
    public function check_url($text)
    {
        if(!empty($text)) {

            $scheme = wp_parse_url(sanitize_url($text), PHP_URL_SCHEME);
            $result = $scheme && in_array($scheme, wp_allowed_protocols(), true);
            return $result;
        }
    }

    /**
     * Checks  text is a valid date.
     */
    public function check_date($text)
    {

        $result = preg_match('/^([0-9]{4,})-([0-9]{2})-([0-9]{2})$/', $text, $matches);

        if ($result) {
            $result = checkdate($matches[2], $matches[3], $matches[1]);
        }

        return $result;
    }
}
