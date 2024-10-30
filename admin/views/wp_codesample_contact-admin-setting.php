<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin.php?page=setting_cs_contact', 'administrator')); ?>">
        <div id="poststuff" class="poststuff">

            <div id="post-body" class="meta-box-holder columns-2">

                <div id="post-body-content">
                    <?php $message = end(array_keys($_GET)); ?>
                    <?php if ($message == 'success') : ?>
                        <div class="updated">
                            <p><?php echo str_replace('-', ' ', sanitize_text_field($_GET[$message])); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($message == 'error') : ?>
                        <div class="error">
                            <p><?php echo str_replace('-', ' ',sanitize_text_field($_GET[$message])); ?></p>
                        </div>
                    <?php endif; ?>
                    <fieldset>
                        <legend>reCAPTCHA </legend>
                        <table class="cs-contact-table">
                            <tbody class="cs-contact-settings">
                                <tr>
                                    <td class="cs-contact-label">
                                        <label for="cs-site-key">Site Key</label>
                                    </td>
                                    <td class="cs-contact-input">
                                        <div class="cs-contact-input-wrap">
                                            <input type="text" name="captcha-site-key" id="cs-site-key" class="field-key" value="<?php echo esc_attr($capcha['captcha_site']); ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cs-contact-label">
                                        <label for="cs-secret-key">Secret Key</label>
                                    </td>
                                    <td class="cs-contact-input">
                                        <div class="cs-contact-input-wrap">
                                            <input type="text" name="captcha-secret-key" id="cs-secret-key" class="field-secret-key" value="<?php echo esc_attr($capcha['captcha_key']); ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <!-- Right column -->
                <div id="postbox-container-1" class="postbox-container">
                    <div id="submitdiv" class="postbox">
                        <h3>Status</h3>
                        <div class="inside">
                            <div class="submitbox" id="submitpost">
                                <div id="major-publishing-actions">
                                    <div class="hidden-field">
                                        <input type="hidden" name="submit_type" value="setting">
                                    </div>
                                    <div id="publishing-action">
                                        <span class="spinner"></span>
                                        <input type="submit" class="button-primary" name="cs-save" value="Save" onclick="this.form._wpnonce.value = '2a52a6f3fd'; this.form.action.value = 'save'; return true;">
                                    </div>
                                    <div class="clear"></div>
                                </div><!-- #major-publishing-actions -->
                            </div><!-- #submitpost -->
                        </div>
                    </div>
                </div>
            </div>
            <?php
            wp_nonce_field('contact-setting-save', 'contact-setting-message');
            ?>
    </form>
</div><!-- .wrap -->
<?php
$form_modal = plugin_dir_path(__FILE__) . '/parts/form-modal.php';
if (file_exists($form_modal)) {
    include($form_modal);
}
?>