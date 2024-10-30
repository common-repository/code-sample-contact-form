var cs_public_contactJS = function () { };

cs_public_contactJS.prototype.construct = function () {
    var that = this;
    jQuery('document').ready(function () {
        that.validateFields();
    })
}

cs_public_contactJS.prototype.validateFields = function () {
    var that = this;
    jQuery('#cs_contact_form').on('submit', (evt) => {
        if (jQuery("div.g-recaptcha").length > 0) {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                jQuery('.field_captcha .error_message').text('Your Captcha is Empty. Please try again')
                evt.preventDefault();
                return false;
            }
        }
    })
}

/*
 *
 */
var contactJS = new cs_public_contactJS();
contactJS.construct();