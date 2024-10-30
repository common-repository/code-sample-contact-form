<?php

/**
 ** A base module for the following types of tags:
 ** 	[text] and [text*]		# Single-line text
 ** 	[email] and [email*]	# Email address
 ** 	[url] and [url*]		# URL
 ** 	[tel] and [tel*]		# Telephone number
 **/

?>
<?php
$required = $list_attr['required'] == 1 ? 'required' : '';
$value = !empty($_POST) ? sanitize_textarea_field($_POST[$list_attr['name']]) : $list_attr['default_value'];
?>
<div class="field_textarea cs_field">
    <span class="field_label">
        <?php echo esc_html($list_attr['label']); ?>
        <?php echo !empty($required) ? '<i class="icon_required">*</i>' : ''; ?>
    </span>
    <div class="main_field">
        <textarea class="<?php echo esc_attr($list_attr['class_field']); ?>" name="<?php echo esc_attr($list_attr['name']); ?>" rows="4" cols="50"><?php echo esc_textarea($value); ?></textarea>
    </div>
    <span class="error_message"></span>
</div>