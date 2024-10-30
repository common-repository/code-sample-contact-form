<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>">
        <input type="hidden" name="post_id" value="<?php echo esc_html($contact->ID); ?>">
        <div id="poststuff" class="poststuff">
            <div id="post-body" class="meta-box-holder columns-2">
                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <label class="screen-reader-text" id="title-prompt-text" for="title">Add title</label>
                            <input type="text" name="post_title" size="30" value="<?php echo esc_html($contact->post_title); ?>" id="title" spellcheck="true" autocomplete="off">
                        </div>
                    </div>
                    <div class="inside">
                        <p class="description">
                            <span class="shortcode wp-ui-highlight">
                                <input type="text" id="cs-shortcode" onfocus="this.select();" readonly="readonly" class="large-text code" value="[cs-contact id=<?php echo esc_html($contact->ID); ?>]"></span>
                            <label for="cs-shortcode">Copy this shortcode and paste it into your post, page, or text
                                widget content</label>
                        </p>
                    </div>
                    <div id="pods-labels" class="postbox">
                        <!-- Tab links -->
                        <div class="tab">
                            <div class="tablinks active" data-link="add_fields">Fields</div>
                            <div class="tablinks" data-link="mail">Config</div>
                        </div>

                        <!-- Tab content -->
                        <div id="add_fields" class="tabcontent active">
                            <div class="cs-contact-list-wrap" id="">
                                <ul class="cs-contact-thead">
                                    <li class="li-field-label">Name</li>
                                    <li class="li-field-name">Slug</li>
                                    <li class="li-field-type">Type</li>
                                </ul>
                                <div id="fieldList">
                                    <?php
                                    if (!empty($contact->post_content)) :
                                        $content = unserialize($contact->post_content);
                                        foreach ($content as $key => $val) :
                                            parse_str(str_replace(',', '&', str_replace(':', '=', $val)), $contact);
                                    ?>
                                            <div id="<?php echo $contact['id'] ?>" class="cs-contact-list lineitem">
                                                <div class="handle">
                                                    <ul class="cs-body">
                                                        <li class="li-field-name">
                                                            <strong><?php echo esc_html($contact['label']); ?></strong>
                                                            <div class="row-options">
                                                                <a class="edit-field" href="#" data-meta="<?php echo esc_html($contact['id']); ?>">Edit</a>
                                                                <a class="delete-field" href="#">Delete</a>
                                                            </div>
                                                        </li>
                                                        <li class="li-field-slug"><?php echo esc_html($contact['name']); ?></li>
                                                        <li class="li-field-type"><?php echo esc_html($contact['type']); ?></li>
                                                    </ul>
                                                </div>
                                                <div class="cs-meta">
                                                    <input id="<?php echo esc_html($contact['id']); ?>" class="meta_fields" name="fields[]" type="hidden" value="<?php echo esc_html($val); ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <ul class="cs-contact-hl cs-contact-tfoot">
                                    <li class="cs-contact-fr">
                                        <a href="javascript:void(0)" class="button button-primary button-large add-field">+ Add Field</a>
                                        <a href="#TB_inline=true&width=550&height=650&inlineId=form_content" class="thickbox" style="display:none"></a>
                                    </li>
                                </ul>
                            </div>
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
                                        <input type="hidden" name="submit_type" value="edit">
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