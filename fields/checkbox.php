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
$post_value = [];

if(!empty($_POST[$list_attr['name']]) && is_array($_POST[$list_attr['name']])) {
    $post_value = $_POST[$list_attr['name']];
    array_walk($post_value, function($val, $key) {
        $val = sanitize_text_field($val);
    });
}

$value = !empty($post_value) ? $post_value : $option_default;
?>
<div class="field_checkbox cs_field">
    <span class="field_label">
        <?php echo $list_attr['label']; ?>
        <?php echo !empty($required) ? '<i class="icon_required">*</i>' : ''; ?>
    </span>
    <div class="main_field">
        <ul>
            <?php foreach ($options as $val) : ?>
                <?php $checked = in_array($val, $value) ? 'checked = "checked"' : ''; ?>
                <li>
                    <input class="<?php echo esc_attr($list_attr['class_field']); ?>" type="checkbox" name="<?php echo esc_attr($list_attr['name']); ?>[]" value="<?php echo esc_attr($val); ?>" <?php echo $checked; ?> <?php echo $required; ?> />
                    <span><?php echo esc_html($val); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <span class="error_message"></span>
</div>