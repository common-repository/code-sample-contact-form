var cs_contactJS = function() {};
var selectType = ['selectbox', 'checkbox', 'radio'];

cs_contactJS.prototype.construct = function() {
    var that = this;
    jQuery('document').ready(function() {
        that.csTab();
        that.addFields();
        that.deleteField();
        that.editField();
        that.loadFormModal();
        // Set id for field list
        that.sortableFields();
        that.handleEventChangeType();
    })
}

cs_contactJS.prototype.sortableFields = function() {
    jQuery("#fieldList").sortable({
        placeholder: "sortable-placeholder",
        revert: false,
        tolerance: "pointer",
        attribute: 'data-id'
    });
}

cs_contactJS.prototype.csTab = function() {

    jQuery(document).on('click', '.tablinks', function(e) {
        e.preventDefault();
        var type = jQuery(this).data('link');

        jQuery('.tablinks').removeClass('active');
        jQuery(this).toggleClass('active');
        jQuery('.tabcontent').removeClass('active');
        document.getElementById(type).classList.add("active");
    })
}

cs_contactJS.prototype.addFields = function() {
    var that = this;

    jQuery(document).on('click', '.btnSubmit', function(e) {
        e.preventDefault();
        var check = that.validateFields();
        if (check.length > 0) {
            jQuery('#error-message').html('')
            check.map(item => {
                jQuery('#error-message').append('<br>' + item + '</br>');
            })
            return;
        }

        var id = jQuery('input[name="field_id"]').val();
        var data = that.getDataFormModal();
        var html = that.fieldAttribute(data);

        if (id == '') {
            jQuery('#fieldList').append(html);
            jQuery('#TB_closeWindowButton').click();
        } else {
            jQuery('#fieldList').find('#' + id).replaceWith(html);
            jQuery('#TB_closeWindowButton').click();
        }

    })
}

cs_contactJS.prototype.fieldAttribute = function(data) {

    var toString = JSON.stringify(data).replace(/"|}|{/g, '');
    var html = '<div id="' + data.id + '" class="cs-contact-list lineitem">';
    html += '<div class="handle">';
    html += '<ul class="cs-body">';
    html += '<li class="li-field-name"><strong>' + data.label + '</strong>';
    html += '<div class="row-options"><a class="edit-field" data-meta="' + data.id + '" href="#">Edit</a><a class="delete-field" href="#">Delete</a></div></li>';
    html += '<li class="li-field-slug">' + data.name + '</li><li class="li-field-type">' + data.type + '</li></ul></div>';
    html += '<div class="cs-meta">';
    html += '<input id="' + data.id + '" class="meta_field" name="fields[]" type="hidden" value="' + toString + '">';
    html += '</div></div>';

    return html;
}

cs_contactJS.prototype.getDataFormModal = function() {

    var data = {
        'id': (+new Date).toString(36),
        'label': jQuery('.cs-contact-table').find('#cs-contact-label').val(),
        'name': "_"+jQuery('.cs-contact-table').find('#cs-contact-label').val().toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, ''),
        'type': jQuery('.cs-contact-table').find('select#cs-contact-type').val(),
        'required': jQuery('.cs-contact-table').find('#cs-contact-required').prop("checked") == true ? 1 : 0,
        'minlength': jQuery('.cs-contact-table').find('#cs-contact-minlength').val(),
        'maxlength': jQuery('.cs-contact-table').find('#cs-contact-maxlength').val(),
        'default_value': jQuery('.cs-contact-table').find('#cs-contact-default_value').val(),
        'placeholder': jQuery('.cs-contact-table').find('#cs-contact-placeholder').val(),
        'options': jQuery('.cs-contact-table').find('textarea.option_list').val().replace(/\r\n|\r|\n/g, "|"),
        'option_default': jQuery('.cs-contact-table').find('textarea.option_default').val().replace(/\r\n|\r|\n/g, "|"),
        'class_field': jQuery('.cs-contact-table').find('#cs-contact-class').val()
    };

    return data;
}

cs_contactJS.prototype.deleteField = function() {
    jQuery(document).on('click', '.delete-field', function(e) {
        e.preventDefault();
        jQuery(this).parents('.cs-contact-list').remove();
    })
}

cs_contactJS.prototype.editField = function() {
    var that = this;
    jQuery(document).on('click', '.edit-field', function(e) {
        e.preventDefault();
        var meta_id = jQuery(this).data('meta');
        var meta_data = jQuery('.cs-meta').find('#' + meta_id).val();
        var data = [];

        if (meta_data.split(',').length > 0) {
            meta_data.split(',').map(item => {
                var args = item.split(':');
                data[args[0]] = args[1];
            });
        }

        if (selectType.includes(data['type']) === false) {
            jQuery('.cs-contact-settings').find('.options').hide();
        } else {
            jQuery('.cs-contact-settings').find('.options').show();
        }

        jQuery('#form_content .field-label').val(data['label']);
        jQuery('select.field-type').val(data['type']);
        jQuery('#form_content .field-id').val(data['id']);
        if (data['required'] == '1') {
            jQuery('#form_content .field-required').attr('checked', 'checked');
        }
        jQuery('#form_content .field-default_value').val(data['default_value']);
        jQuery('#form_content .field-placeholder').val(data['placeholder']);
        jQuery('#form_content .field-minlength').val(data['minlength']);
        jQuery('#form_content .field-maxlength').val(data['maxlength']);
        jQuery('textarea.option_list').val(data['options'].replaceAll('|', '\n')) || jQuery('textarea.option_list').val('');
        jQuery('textarea.option_default').val(data['option_default'].replaceAll('|', '\n')) || jQuery('textarea.option_default').val('');
        jQuery('#form_content .field-class').val(data['class_field']);
        jQuery('#error-message').html('');
        jQuery('a.thickbox').click();
    })
}

cs_contactJS.prototype.loadFormModal = function() {
    jQuery(document).on('click', '.add-field', function() {
        jQuery('#form_content .field-label').val('');
        jQuery('#form_content .field-id').val('');
        jQuery('#form_content .field-default_value').val('');
        jQuery('tr.options').hide();
        jQuery('#option-value textarea').val('');
        jQuery('select.field-type').val(0);
        jQuery('#form_content .field-required').removeAttr('checked');
        jQuery('#form_content .field-class').val('');
        jQuery('#form_content .field-maxlength').val('');
        jQuery('#form_content .field-minlength').val('');
        jQuery('#error-message').html('');
        jQuery('a.thickbox').click();
    })
}

cs_contactJS.prototype.validateFields = function() {
    var error = [];
    var field_require = jQuery('.field_required');
    field_require.each(function() {
        if (jQuery(this).val() == '' || jQuery(this).val() === null || jQuery(this).val() == '0') {
            var field_name = jQuery(this).data('field');
            var message = field_name + ' is required !';
            error.push(message);
        }
    })

    return error;
}

cs_contactJS.prototype.handleEventChangeType = function() {
    jQuery(document).on('change', '#cs-contact-type', function(e) {
        e.preventDefault();
        let type = jQuery(this).val();

        if (selectType.includes(type)) {
            jQuery('tr.options').show()
        } else {
            jQuery('tr.options').hide()
        }
    })
}

/*
 *
 */
var contactJS = new cs_contactJS();
contactJS.construct();