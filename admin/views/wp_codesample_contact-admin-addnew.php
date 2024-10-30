<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>">
        <div id="poststuff" class="poststuff">
            <div id="post-body" class="meta-box-holder columns-2">
                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <label class="screen-reader-text" id="title-prompt-text" for="title">Add title</label>
                            <input type="text" name="post_title" size="30" value="" id="title" spellcheck="true" autocomplete="off">
                        </div>
                    </div>

                    <div id="pods-labels" class="postbox">
                        <!-- Tab links -->
                        <div class="tab">
                            <div class="tablinks active" data-link="add_fields">Fields</div>
                            <div class="tablinks" data-link="mail">Config</div>
                        </div>

                        <!-- Tab content -->
                        <div id="add_fields" class="tabcontent active">
                            <?php
                            $custom_field = plugin_dir_path(__FILE__) . '/parts/custom-field.php';
                            if (file_exists($custom_field)) {
                                include($custom_field);
                            }
                            ?>
                        </div>

                        <div id="mail" class="tabcontent">
                            <?php
                            $config = plugin_dir_path(__FILE__) . '/parts/config.php';
                            if (file_exists($config)) {
                                include($config);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Right column -->
                <div id="postbox-container-1" class="postbox-container">
                    <div id="submitdiv" class="postbox">
                        <h3>Status</h3>
                        <div class="inside">
                            <div class="submitbox" id="submitpost">
                                <div id="major-publishing-actions">
                                    <div class="hidden-field">
                                        <input type="hidden" name="submit_type" value="create">
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