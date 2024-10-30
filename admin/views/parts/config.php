<fieldset>
    <legend>Mail</legend>
    <table class="cs-contact-table">
        <tbody class="cs-contact-settings">
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-secret-key">Recipient</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" name="mail_recipient" id="cs-site-key" class="field-send_unsuccess" value="<?php echo !empty($meta_data['mail_recipient']) ? esc_attr($meta_data['mail_recipient']) : get_option('admin_email'); ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-secret-key">CC</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" name="mail_cc" id="cs-site-key" class="field-send_unsuccess" value="<?php echo !empty($meta_data['mail_cc']) ? esc_attr($meta_data['mail_cc']) : ''; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-secret-key">Subject</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" name="mail_subject" id="cs-site-key" class="field-send_unsuccess" value="<?php echo !empty($meta_data['mail_subject']) ? esc_attr($meta_data['mail_subject']) : 'Message from website contact' ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-site-key">Message Send Mail Success</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" name="mail_send_success" id="cs-site-key" class="field-send_success" value="<?php echo !empty($meta_data['mail_send_success']) ? esc_attr($meta_data['mail_send_success']) : 'Thank you for your message. It has been sent.' ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-secret-key">Message Send Mail Unsuccess</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" name="mail_send_unsuccess" id="cs-site-key" class="field-send_unsuccess" value="<?php echo !empty($meta_data['mail_send_unsuccess']) ? esc_attr($meta_data['mail_send_unsuccess']) : 'There was an error trying to send your message. Please try again later.' ?>">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>

<fieldset>
    <legend>Options </legend>
    <table class="cs-contact-table">
        <tbody class="cs-contact-settings">
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-captcha">Display reCAPTCHA</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <label class="switch">
                            <input type="checkbox" name="show_captcha" id="cs-show-captcha" value="1" <?php echo !empty($meta_data['option']['show_captcha']) && $meta_data['option']['show_captcha'] == 1 ? 'checked' : ''; ?>>
                            <span class="slider"></span>
                        </label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>