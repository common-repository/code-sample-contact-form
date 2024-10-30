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
$minlength = !empty($list_attr['minlength']) ? 'minlength="' . $list_attr['minlength'] . '"' : '';
$maxlength = !empty($list_attr['maxlength']) ? 'maxlength="' . $list_attr['maxlength'] . '"' : '';
$value = !empty($_POST) ? sanitize_text_field($_POST[$list_attr['name']]) : $list_attr['default_value'];
?>
<div class="field_text cs_field">
    <span class="field_label">
        <?php echo esc_html($list_attr['label']); ?>
        <?php echo !empty($required) ? '<i class="icon_required">*</i>' : ''; ?>
    </span>
    <div class="main_field">
        <input class="<?php echo esc_attr($list_attr['class_field']); ?>" type="text" name="<?php echo esc_attr($list_attr['name']); ?>" placeholder="<?php echo esc_attr($list_attr['placeholder']); ?>" value="<?php echo esc_attr($value); ?>" <?php echo $minlength; ?> <?php echo $maxlength; ?> <?php echo $required; ?> />
    </div>
    <span class="error_message"></span>
</div>