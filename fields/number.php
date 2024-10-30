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
$value = !empty($_POST) ? sanitize_text_field($_POST[$list_attr['name']]) : $list_attr['default_value'];
?>
<div class="field_number cs_field">
    <span class="field_label">
        <?php echo $list_attr['label']; ?>
        <?php echo !empty($required) ? '<i class="icon_required">*</i>': '';?>
    </span>
    <div class="main_field">
        <input class="<?php echo esc_attr($list_attr['class_field']); ?>" type="number" name="<?php echo esc_attr($list_attr['name']); ?>" placeholder="<?php echo esc_attr($list_attr['placeholder']); ?>" value="<?php echo esc_attr($value); ?>" <?php echo $required; ?> />
    </div>
    <span class="error_message"></span>
</div>