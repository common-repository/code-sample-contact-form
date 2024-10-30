<?php

/**
 * All function proccess mail.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    mail
 * @subpackage Wp_codesample_contact/helper/mail
 */

/**
 * All function proccess mail.
 *
 *
 * @package    mail
 * @subpackage Wp_codesample_contact/helper/mail
 * @author     Hung Truong <admin@codesamples.info>
 */

class cs_mail
{
    private $param = array();

    public function __construct($param = [])
    {
        $this->param = $param;
    }

    public function cs_send_mail()
    {
        try {
            $args = $this->param;
            $recipient = !empty($args['recipient']) ? $args['recipient'] : get_option('admin_email');
            $subject = $args['subject'];
            $body = $this->template_mail($args);
            $sender = $args['email'];
            $headers = 'From: ' . $sender . "\r\n";
            if(!empty($args['cc'])) {
                $headers = 'Cc: ' . $args['cc'] . "\r\n";
            }
            $headers .= "Content-Type: text/html\n";
            $headers .= "X-WPCF7-Content-Type: text/html\n";

            if (wp_mail($recipient, $subject, $body, $headers)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            throw new Exception($err);
        }
    }

    private function template_mail($args = [])
    {
        $body = '<table style="border-collapse: collapse; border: 1px solid #e5e5e5; width: 100%; background-color:#ffffff;">';
        if (!empty($args['info'])) :
            foreach ($args['info'] as $key => $val) :
                if (is_array($val)) {
                    $val = implode(', ', $val);
                }
                $body .= '<tr style="border-collapse: collapse; border: 1px solid #e5e5e5;"><td style="border-collapse: collapse; border: 1px solid #e5e5e5; padding: 10px;" width="15%"><b>' . esc_html(upword_format($key)) . '</b></td>';
                $body .= '<td style="padding: 10px;">' . $val . '</td>';
                $body .= '</tr>';
            endforeach;
        endif;
        $body .= '</table>';
        $wrapper = '<table style="width: 100%; border: 1px solid #e5e5e5;"><tr style="" ,width="100%"><td colspan="2" style="background-color: #69B03B; padding: 15px 5px; color: #ffffff; font-size: 24px; text-align: center">Customer send a message</td></tr><tr><td style="padding: 20px; background-color:#f7f7f7;">'. $body .'</td></tr></table>';
        $html = '<html xmlns="http://www.w3.org/1999/xhtml">';
        $html .= '<head><title>' . esc_html($args['subject']) . '</title></head>';
        $html .= '<body>' . $wrapper . '</body></html>';

        return $html;
    }
}
