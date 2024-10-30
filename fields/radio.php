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
$attr = format_atts($list_attr);
$options = !empty($list_attr['options']) ? explode('|', $list_attr['options']) : [];
$option_default = !empty($list_attr['option_default']) ? explode('|', $list_attr['option_default']) : [];
$required = $list_attr['required'] == '1' ? 'required' : '';
$post_value = !empty($_POST[$list_attr['name']]) ? sanitize_text_field($_POST[$list_attr['name']]) : '';
$value = !empty($_POST) ? $post_value : $option_default[0];
?>
<div class="field_radio cs_field">
    <span class="field_label">
        <?php echo esc_html($list_attr['label']); ?>
        <?php echo !empty($required) ? '<i class="icon_required">*</i>' : ''; ?>
    </span>
    <div class="main_field">
        <ul>
            <?php foreach ($options as $val) : ?>
                <?php $checked = strtolower($val) == strtolower($value) ? 'checked = "checked"' : ''; ?>
                <li>
                    <input class="<?php echo esc_attr($list_attr['class_field']); ?>" type="radio" name="<?php echo esc_attr($list_attr['name']); ?>" value="<?php echo strtolower(esc_attr($val)); ?>" <?php echo $checked; ?> <?php echo $required; ?> />
                    <span><?php echo ucfirst($val); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <span class="error_message"></span>
</div>