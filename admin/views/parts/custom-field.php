<?php
    $fields = contact_fields_default();
?>
<div class="cs-contact-list-wrap" id="">
    <ul class="cs-contact-thead">
        <li class="li-field-label">Field Label</li>
        <li class="li-field-name">Field Name</li>
        <li class="li-field-type">Field Type</li>
    </ul>
    <div id="fieldList">
        <?php foreach($fields as $key => $item): ?>
        <div id="<?php echo esc_attr($item['id']); ?>" class="cs-contact-list lineitem">
            <div class="handle">
                <ul class="cs-body">
                    <li class="li-field-label">
                        <strong><?php echo esc_html($item['label']); ?></strong>
                        <div class="row-options">
                            <a class="edit-field" href="#" data-meta="<?php echo esc_attr($item['id']); ?>">Edit</a>
                            <a class="delete-field" href="#">Delete</a>
                        </div>
                    </li>
                    <li class="li-field-name"><?php echo esc_html($item['name']); ?></li>
                    <li class="li-field-type"><?php echo esc_html($item['type']); ?></li>
                </ul>
            </div>
            <div class="cs-meta">
                <input id="<?php echo esc_attr($item['id']); ?>" class="meta_fields" name="fields[]" type="hidden" value="<?php echo str_replace('=', ':', http_build_query($item, '', ',')); ?>">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <ul class="cs-contact-hl cs-contact-tfoot">
        <li class="cs-contact-fr">
            <a href="javascript:void(0)" class="button button-primary button-large add-field">+ Add Field</a>
            <a href="#TB_inline=true&width=550&height=650&inlineId=form_content" class="thickbox"
                style="display:none"></a>
        </li>
    </ul>
</div>
